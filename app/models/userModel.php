<?php

//looks for an user by his email
function findByEmail($email)
{
    //global variable used to connect with the database
    global $dbConnector;

    //making a request, asking for the user's email
    $stmt = $dbConnector->prepare("SELECT * FROM USER_ WHERE email = ?");
    $stmt->execute([$email]);
    //return an associative array
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//creates a new user using the $data array (see in loginController.php)
function createUser($data)
{
    //connects to the database for another request
    global $dbConnector;

    //making a request, inserting a new user (password, name, surname, username, email, role)
    //'role' is automatically "member", because the client is and wants to be the only admin on the website
    $stmt = $dbConnector->prepare("INSERT INTO USER_ (password, name, surname, username, email, role) VALUES (?, ?, ?, ?, ?, 'member')");
    return $stmt->execute([
        password_hash($data['password'], PASSWORD_BCRYPT), //password's hash absolutely needed
        $data['name'],
        $data['surname'],
        $data['username'],
        $data['email']
    ]);
}

//when clicks on the username, redirects to the user page
function findById($id)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("SELECT * FROM USER_ WHERE id_user = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//allows to change avatar and/or description
function updateProfile($id, $data)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        UPDATE USER_ 
        SET profile_description = ?, avatar = ?
        WHERE id_user = ?
    ");
    return $stmt->execute([
        $data['profile_description'],
        $data['avatar'],
        $id
    ]);
}

function getAllUsers()
{
    global $dbConnector;
    $stmt = $dbConnector->prepare("SELECT * FROM USER_ ORDER BY id_user DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}