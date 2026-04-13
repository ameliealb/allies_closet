<?php

//displays forum's page and all messages (topics and replies) in the database
function showForum()
{
    $messages = getAllMessages();
    require RACINE . '/app/views/forum/indexForumView.php';
}

//displays topic's page selected by the user
function showMessage()
{
    $id = $_GET['id'];
    $message = getMessageById($id);
    $replies = getRepliesByMessageId($id);
    require RACINE . '/app/views/forum/showMessView.php';
}

//allows to create a new message
function showCreateMessage()
{
    if (!isset($_SESSION['user'])) {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }
    require RACINE . '/app/views/forum/createMessView.php';
}

//allows to submit a topic
function submitMessage()
{
    if (!isset($_SESSION['user'])) {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (empty($title) || empty($content)) {
        $error = "Tous les champs sont obligatoires.";
        require RACINE . '/app/views/forum/createMessView.php';
        return;
    }

    $data = [
        'id_user' => $_SESSION['user']['id_user'],
        'title' => $title,
        'content' => $content
    ];

    createMessage($data);
    header('Location: /projet-final/index.php?action=forum');
    exit;
}

//allows to submit a reply to a topic
function submitReply()
{
    if (!isset($_SESSION['user'])) {
        header('Location: /projet-final/index.php?action=loginPage');
        exit;
    }

    $id_reply = $_POST['id_reply'];
    $content = trim($_POST['content']);

    if (empty($content)) {
        $error = "La réponse ne peut pas être vide.";
        $message = getMessageById($id_reply);
        $replies = getRepliesByMessageId($id_reply);
        require RACINE . '/app/views/forum/showMessView.php';
        return;
    }

    $data = [
        'id_user' => $_SESSION['user']['id_user'],
        'id_reply' => $id_reply,
        'content' => $content
    ];

    createReply($data);
    header('Location: /projet-final/index.php?action=showMessage&id=' . $id_reply);
    exit;
}