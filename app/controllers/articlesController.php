<?php

function showBlog()
{
    $limit   = 10;
    $page    = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset  = ($page - 1) * $limit;

    if (!empty($_GET['search'])) {
        $keyword    = trim($_GET['search']);
        $articles   = searchArticles($keyword);
        $totalPages = 1;
    } else {
        $total      = countArticles();
        $totalPages = ceil($total / $limit);
        $articles   = getAllArticles($limit, $offset);
    }

    require RACINE . '/app/views/articles/indexArtView.php';
}

function showCategory()
{
    $category   = $_GET['category'];
    $categories = ['mode', 'maquillage', 'chaussures', 'cheveux', 'skincare', 'lifestyle'];

    if (!in_array($category, $categories)) {
        header('Location: /projet-final/index.php?action=blog');
        exit;
    }

    $limit      = 10;
    $page       = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset     = ($page - 1) * $limit;
    $total      = countArticlesByCategory($category);
    $totalPages = ceil($total / $limit);
    $articles   = getArticlesByCategory($category, $limit, $offset);

    require RACINE . '/app/views/articles/indexArtView.php';
}

function showArticle()
{
    $id       = $_GET['id'];
    $article  = getArticleById($id);
    $comments = getCommentsByArticleId($id);
    $likes    = countLikesArticle($id);
    $hasLiked = isset($_SESSION['user']) ? hasLikedArticle($_SESSION['user']['id_user'], $id) : false;

    if (!$article) {
        header('Location: /projet-final/index.php?action=blog');
        exit;
    }

    require RACINE . '/app/views/articles/showArtView.php';
}

function showCreateArticle()
{
    //if the user is NOT logged in OR the user hasn't 'admin' as role, the function leads it to the login page
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    //if the user is logged in AND has 'admin' as role, the function leads the admin to the article creation page 
    require RACINE . '/app/views/articles/createArtView.php';
}


function submitArticle()
{
    //if the user is NOT logged in OR the user hasn't 'admin' as role, the function leads it to the login page
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    //getting the data from the form in createArtView.php and trimming strings to avoid any errors
    $title   = trim($_POST['title']);
    $content = trim($_POST['content']);
    $status  = $_POST['status'];

    //both title and content are required
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

    //variable initialized as empty in case the admin doesn't put any image
    $article_image = '';

    //if an image is selected by the admin
    if (!empty($_FILES['article_image']['name'])) {
        //path used by the server
        $uploadDir  = RACINE . '/app/public/images/';

        /*gives an unique ID to the image and stick it's "real" name to it,
        ex : 4b3403665fea6_image1.png
        */
        $fileName = uniqid() . '_' . basename($_FILES['article_image']['name']);
        $uploadPath = $uploadDir . $fileName;

        move_uploaded_file($_FILES['article_image']['tmp_name'], $uploadPath);
        //path used by the web browser
        $article_image = '/projet-final/app/public/images/' . $fileName;
    }

    $data = [
        'id_user' => $_SESSION['user']['id_user'],
        'title' => $title,
        'content' => $content,
        'status' => $status,
        'category' => $_POST['category'],
        'article_image' => $article_image
    ];

    //creating a new article, createArticle() defined in articlesModel.php and it parameter $data defined above
    createArticle($data);

    //then the admin is leaded to it's dashboard
    header('Location: /projet-final/index.php?action=blog');
    exit;
}

function showEditArticle()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    $id = $_GET['id'];
    $article = getArticleById($id);

    if (!$article) {
        header('Location: /projet-final/index.php?action=dashboard');
        exit;
    }

    require RACINE . '/app/views/articles/editArtView.php';
}

function submitEditArticle()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    $id = $_POST['id_article'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $status = $_POST['status'];

    if (empty($title) || empty($content)) {
        $error   = "Le titre et le contenu sont obligatoires.";
        $article = getArticleById($id);
        require RACINE . '/app/views/articles/editArtView.php';
        return;
    }

    $article = getArticleById($id);
    $article_image = $article['article_image'];

    if (!empty($_FILES['article_image']['name'])) {
        $fileName = uniqid() . '_' . basename($_FILES['article_image']['name']);
        move_uploaded_file($_FILES['article_image']['tmp_name'], RACINE . '/app/public/images/' . $fileName);
        $article_image = '/projet-final/app/public/images/' . $fileName;
    }

    $data = [
        'title' => $title,
        'content' => $content,
        'status' => $status,
        'article_image' => $article_image
    ];

    updateArticle($id, $data);
    header('Location: /projet-final/index.php?action=dashboard');
    exit;
}

function submitDeleteArticle()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    $id = $_GET['id'];
    deleteArticle($id); // ← appelle la fonction du model
    header('Location: /projet-final/index.php?action=dashboard');
    exit;
}

function submitArchiveArticle()
{
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    $id = $_GET['id'];
    archiveArticle($id); // ← appelle la fonction du model
    header('Location: /projet-final/index.php?action=dashboard');
    exit;
}


function toggleLikeArticle()
{
    if (!isset($_SESSION['user'])) {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    $id_article = $_GET['id_article'];
    $id_user    = $_SESSION['user']['id_user'];

    if (hasLikedArticle($id_user, $id_article)) {
        unlikeArticle($id_user, $id_article);
    } else {
        likeArticle($id_user, $id_article);
    }

    header('Location: /projet-final/index.php?action=showArticle&id=' . $id_article);
    exit;
}