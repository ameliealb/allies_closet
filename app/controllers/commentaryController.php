<?php

function submitComment()
{
    if (!isset($_SESSION['user'])) {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    $id_article = $_POST['id_article'];
    $content    = trim($_POST['content']);

    if (empty($content)) {
        $error    = "Le commentaire ne peut pas être vide.";
        $article  = getArticleById($id_article);
        $comments = getCommentsByArticleId($id_article);
        require RACINE . '/app/views/articles/showArtView.php';
        return;
    }

    $data = [
        'id_user'    => $_SESSION['user']['id_user'],
        'id_article' => $id_article,
        'content'    => $content
    ];

    createComment($data);
    header('Location: /projet-final/index.php?action=showArticle&id=' . $id_article);
    exit;
}

function submitDeleteComment()
{
    if (!isset($_SESSION['user'])) {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    $id_comment = $_GET['id_comment'];
    $id_article = $_GET['id_article'];

    $comment = getCommentById($id_comment);

    if ($comment['id_user'] !== $_SESSION['user']['id_user'] && $_SESSION['user']['role'] !== 'admin') {
        header('Location: /projet-final/index.php?action=showArticle&id=' . $id_article);
        exit;
    }

    deleteComment($id_comment);
    header('Location: /projet-final/index.php?action=showArticle&id=' . $id_article);
    exit;
}