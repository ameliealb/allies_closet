<?php

//allows any logged user to submit a comment under an article
function submitComment()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
        exit;
    }

    $id_article = $_POST['id_article'];
    $content = trim($_POST['content']);

    if (empty($content)) {
        $error = "Le commentaire ne peut pas être vide.";
        $article = getArticleById($id_article);
        $comments = getCommentsByArticleId($id_article);
        require RACINE . '/app/views/articles/showArtView.php';
        return;
    }

    $data = [
        'id_user' => $_SESSION['user']['id_user'],
        'id_article' => $id_article,
        'content' => $content
    ];

    createComment($data);
    header('Location: ' . BASE_URL . '/index.php?action=showArticle&id=' . $id_article);
    exit;
}

//allows any logged user to delete its comments
function submitDeleteComment()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
        exit;
    }

    $id_comment = $_GET['id_comment'];
    $id_article = $_GET['id_article'];

    $comment = getCommentById($id_comment);

    if ($comment['id_user'] !== $_SESSION['user']['id_user'] && $_SESSION['user']['role'] !== 'admin') {
        header('Location: ' . BASE_URL . '/index.php?action=showArticle&id=' . $id_article);
        exit;
    }

    deleteComment($id_comment);
    header('Location: ' . BASE_URL . '/index.php?action=showArticle&id=' . $id_article);
    exit;
}