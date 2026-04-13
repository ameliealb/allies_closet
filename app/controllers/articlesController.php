<?php

function showBlog()
{
    //if the search bar is NOT empty (completed so), 
    if (!empty($_GET['search'])) {
        //then the function get the text typed and trims it 
        $keyword  = trim($_GET['search']);
        $articles = searchArticles($keyword);
    } else {
        //uses getAllArticles() defined in articlesModel.php in order to show every articles, in case no keyword has been given
        $articles = getAllArticles();
    }

    require RACINE . '/app/views/articles/indexArtView.php';
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

    //variable initialized as empty in case the admin doesn't put any image
    $article_image = '';

    //if an image is selected by the admin
    if (!empty($_FILES['article_image']['name'])) {
        //path used by the server
        $uploadDir  = RACINE . '/app/public/images/';

        /*gives an unique ID to the image and stick it's "real" name to it,
        ex : 4b3403665fea6_image1.png
        */
        $fileName   = uniqid() . '_' . basename($_FILES['article_image']['name']);
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
        'article_image' => $article_image
    ];

    //creating a new article, createArticle() defined in articlesModel.php and it parameter $data defined above
    createArticle($data);

    //then the admin is leaded to it's dashboard
    header('Location: /projet-final/index.php?action=blog');
    exit;
}
