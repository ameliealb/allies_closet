<?php

//displays forum's page, paging and all the messages (topics and replies) in the database ; works with JavaScript on the affected page (indexForumView.php)
function showForum()
{
    $limit = 6; //6 messages per page max 
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; //gets page's number ; if none, page 1 by default
    $offset = ($page - 1) * $limit; //starting point in the database, like : page 2 -> offset = (2-1)*6=6, so starts at the 7th message
    $total = countMessages(); //counts total number of messages in the database
    $totalPages = ceil($total / $limit); //ceil() rounds to the superior number, like 11 messages / 6 = 1.8333 -> rounded to 2 pages
    $messages = getAllMessages($limit, $offset); //only gets messages from the current page 
    $lastReplies = getLastReplies();

    require RACINE . '/app/views/forum/indexForumView.php';
}

function showForumCategory()
{
    $category = $_GET['category'];
    $categories = ['mode', 'maquillage', 'chaussures', 'cheveux', 'skincare', 'lifestyle'];

    if (!in_array($category, $categories)) {
        header('Location: ' . BASE_URL . '/index.php?action=forum');
        exit;
    }

    //same thing as showForum() paging 
    $limit = 6;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    $total = countMessagesByCategory($category);
    $totalPages = ceil($total / $limit);
    $messages = getMessagesByCategory($category, $limit, $offset);
    $lastReplies = getLastReplies();

    require RACINE . '/app/views/forum/indexForumView.php';
}

//displays topic's page selected by the user
function showMessage()
{
    $id = $_GET['id'];
    $message = getMessageById($id);
    $replies = getRepliesByMessageId($id);
    $likes = countLikesMessage($id);
    $hasLiked = isset($_SESSION['user']) ? hasLikedMessage($_SESSION['user']['id_user'], $id) : false; //checks if the logged user has already liked the topic, to display the right symbol (empty or filled heart). if not logged, false by default 

    require RACINE . '/app/views/forum/showMessView.php';
}

//allows to create a new message
function showCreateMessage()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
        exit;
    }
    require RACINE . '/app/views/forum/createMessView.php';
}

//allows to submit a topic
function submitMessage()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
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
    'content' => $content,
    'category' => $_POST['category']
];

    createMessage($data);
    header('Location: ' . BASE_URL . '/index.php?action=forum');
    exit;
}

//allows to submit a reply to a topic
function submitReply()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
        exit;
    }

    $id_reply = $_POST['id_reply'];
    $topic_id = $_POST['topic_id'];
    $content = trim($_POST['content']);

    if (empty($content)) {
        $error = "La réponse ne peut pas être vide.";
        $message = getMessageById($topic_id);
        $replies = getRepliesByMessageId($topic_id);
        require RACINE . '/app/views/forum/showMessView.php';
        return;
    }

    $data = [
        'id_user' => $_SESSION['user']['id_user'],
        'id_reply' => $id_reply,
        'content' => $content
    ];

    createReply($data);
    header('Location: ' . BASE_URL . '/index.php?action=showMessage&id=' . $topic_id);
    exit;
}

function toggleLikeMessage()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
        exit;
    }

    $id_message = $_GET['id_message'];
    $id_user = $_SESSION['user']['id_user'];

    if (hasLikedMessage($id_user, $id_message)) {
        unlikeMessage($id_user, $id_message); //if the user has already liked and clicks, takes off the like
    } else {
        likeMessage($id_user, $id_message); //if the user hasn't liked yet and click, puts a like 
    }

    header('Location: ' . BASE_URL . '/index.php?action=showMessage&id=' . $id_message); //reload the message page
    exit;
}