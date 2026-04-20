<?php


function showBlog() //displays blog and paging
{
    $limit = 6;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    if (!empty($_GET['search'])) {
        $keyword = trim($_GET['search']);
        $articles = searchArticles($keyword);
        $totalPages = 1;
    } else {
        $total = countArticles();
        $totalPages = ceil($total / $limit);
        $articles = getAllArticles($limit, $offset);
    }

    require RACINE . '/app/views/articles/indexArtView.php';
}


function showCategory() //displays catogories, users are able to look for articles having a specific cat attached by clicking on the keyword
{
    $category = $_GET['category'];
    $categories = ['mode', 'maquillage', 'chaussures', 'cheveux', 'skincare', 'lifestyle'];

    if (!in_array($category, $categories)) {
        header('Location: ' . BASE_URL . '/index.php?action=blog');
        exit;
    }

    //paging
    $limit = 6;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    $total = countArticlesByCategory($category);
    $totalPages = ceil($total / $limit);
    $articles = getArticlesByCategory($category, $limit, $offset);

    require RACINE . '/app/views/articles/indexArtView.php';
}


function showArticle() //displays article's page
{
    $id = $_GET['id'];
    $article = getArticleById($id);
    $comments = getCommentsByArticleId($id);
    $likes = countLikesArticle($id);
    $hasLiked = isset($_SESSION['user']) ? hasLikedArticle($_SESSION['user']['id_user'], $id) : false;

    if (!$article) {
        header('Location: ' . BASE_URL . '/index.php?action=blog');
        exit;
    }

    require RACINE . '/app/views/articles/showArtView.php';
}


function showCreateArticle() //displays creation article page, only for the admin
{
    //if the user is NOT logged in OR the user hasn't 'admin' as role, the function leads it to the login page
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        show403();
        exit;
    }


    require RACINE . '/app/views/articles/createArtView.php'; //if the user is logged in AND has 'admin' as role, the function leads the admin to the article creation page 
}


function submitArticle()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        show403();
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '/index.php?action=dashboard');
        exit;
    }

    $title   = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $status  = $_POST['status'] ?? 'draft';


    if (empty($title) || empty($content)) {
        $error = "Le titre et le contenu sont obligatoires.";
        require RACINE . '/app/views/articles/createArtView.php';
        return;
    }

    if (strlen($title) > 200) {
        $error = "Le titre ne peut pas dépasser 200 caractères.";
        require RACINE . '/app/views/articles/createArtView.php';
        return;
    }


    $article_image = ''; //variable initialized as empty in case the admin doesn't put any image

    if (!empty($_FILES['article_image']['name'])) {
        $fileName = uniqid() . '_' . basename($_FILES['article_image']['name']);
        $destPath = RACINE . '/public/images/' . $fileName;
        $fileContent = file_get_contents($_FILES['article_image']['tmp_name']);

        if (file_put_contents($destPath, $fileContent) !== false) {
            $article_image = BASE_URL . '/public/images/' . $fileName;
        }
    }

    $data = [
        'id_user' => $_SESSION['user']['id_user'],
        'title' => $title,
        'content' => $content,
        'status' => $status,
        'category' => $_POST['category'],
        'article_image' => $article_image
    ];


    createArticle($data); //creating a new article, createArticle() defined in articlesModel.php and it parameter $data defined above


    header('Location: ' . BASE_URL . '/index.php?action=blog'); //then the admin is leaded to it's dashboard
    exit;
}


function showEditArticle()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        show403();
        exit;
    }

    // ← pas de check REQUEST_METHOD ici, c'est un GET normal

    $id = $_GET['id'];
    $article = getArticleById($id);

    if (!$article) {
        header('Location: ' . BASE_URL . '/index.php?action=dashboard');
        exit;
    }

    require RACINE . '/app/views/articles/editArtView.php';
}

function submitEditArticle()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        show403();
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . BASE_URL . '/index.php?action=dashboard');
        exit;
    }

    $id = $_POST['id_article'] ?? null;
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $status = $_POST['status'] ?? 'draft';

    if (!$id) {
        header('Location: ' . BASE_URL . '/index.php?action=dashboard');
        exit;
    }

    if (empty($title) || empty($content)) {
        $error = "Le titre et le contenu sont obligatoires.";
        $article = getArticleById($id);
        require RACINE . '/app/views/articles/editArtView.php';
        return;
    }

    $article = getArticleById($id);
    $article_image = $article['article_image'];

    if (!empty($_FILES['article_image']['name'])) {
        $fileName = uniqid() . '_' . basename($_FILES['article_image']['name']);
        $destPath = RACINE . '/public/images/' . $fileName;
        $fileContent = file_get_contents($_FILES['article_image']['tmp_name']);

        if (file_put_contents($destPath, $fileContent) !== false) {
            $article_image = BASE_URL . '/public/images/' . $fileName;
        }
    }

    $data = [
        'title' => $title,
        'content' => $content,
        'status' => $status,
        'article_image' => $article_image
    ];

    updateArticle($id, $data);
    header('Location: ' . BASE_URL . '/index.php?action=dashboard');
    exit;
}

//allows the admin to delete an article
function submitDeleteArticle()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        show403();
        exit;
    }

    $id = $_GET['id'];
    deleteArticle($id); // ← appelle la fonction du model
    header('Location: ' . BASE_URL . '/index.php?action=dashboard');
    exit;
}


function submitArchiveArticle() //allows the admin to archive an article
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') { //allowed only if admin
        show403();
        exit;
    }

    $id = $_GET['id'];

    archiveArticle($id); //calls for the model function 
    header('Location: ' . BASE_URL . '/index.php?action=dashboard'); //then redirects to the dashboard page
    exit;
}


function toggleLikeArticle() //allows users to like or unlike an article
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
        exit;
    }

    $id_article = $_GET['id_article'];
    $id_user = $_SESSION['user']['id_user'];

    if (hasLikedArticle($id_user, $id_article)) {
        unlikeArticle($id_user, $id_article);
    } else {
        likeArticle($id_user, $id_article);
    }

    header('Location: ' . BASE_URL . '/index.php?action=showArticle&id=' . $id_article);
    exit;
}
