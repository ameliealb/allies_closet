<?php

//shows user's profile when clicks on the username
function showProfile()
{
    $id = $_GET['id'];
    $profile = findById($id);

    //if no id founded, redirects to the home page 
    if (!$profile) {
        header('Location: ' . BASE_URL . '/index.php?action=default');
        exit;
    }

    //if id founded, shows the user's profile
    require RACINE . '/app/views/user/profileView.php';
}


function showEditProfile()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
        exit;
    }

    $profile = findById($_SESSION['user']['id_user']);
    require RACINE . '/app/views/user/profileView.php';
}

//allows to modify user's profile
function submitProfile()
{
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
        exit;
    }

    $profile_description = trim($_POST['profile_description']);
    $avatar = $_SESSION['user']['avatar'];

    if (!empty($_FILES['avatar']['name'])) {
    $fileName    = uniqid() . '_' . basename($_FILES['avatar']['name']);
    $destPath    = RACINE . '/public/images/' . $fileName;
    $fileContent = file_get_contents($_FILES['avatar']['tmp_name']);

    if (file_put_contents($destPath, $fileContent) !== false) {
        $avatar = BASE_URL . '/public/images/' . $fileName;
    }
}

    $data = [
        'profile_description' => $profile_description,
        'avatar' => $avatar
    ];

    updateProfile($_SESSION['user']['id_user'], $data);

    // updating avatar and/or description on the user's profile
    $_SESSION['user']['profile_description'] = $profile_description;
    $_SESSION['user']['avatar'] = $avatar;

    header('Location: ' . BASE_URL . '/index.php?action=showProfile&id=' . $_SESSION['user']['id_user']);
    exit;
}