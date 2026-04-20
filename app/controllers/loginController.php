<?php

//in the file routes.php, this function is used to display the login/register
function showForm()
{
    //so the login/register view is needed
    require RACINE . '/app/views/login/loginRegisterView.php';
}

//in the files routes.php, this fonction is used to login
function login()
{
    //reusing this variable to connect with the database
    global $dbConnector;

    //trim() removes spaces or other parasite characters in the string
    $email    = trim($_POST['email']);
    //$_POST get the entered password in the form, the method POST is used
    $password = $_POST['password'];
    //findByEmail() is defined in the file loginModel.php, looks for the email in the database
    $user = findByEmail($email);

    //is the user(email) isn't founded, an error is displayed and the login/register view is showed again
    if (!$user) {
        $error = "Email ou mot de passe incorrect."; //it's highly recommended not to show which error occurs
        require RACINE . '/app/views/login/loginRegisterView.php';
        return; //close condition
    }

    //if the password entered isn't the same registered in the database, an error is displayed and the login/register view is showed again
    if (!password_verify($password, $user['password'])) {
        $error = "Email ou mot de passe incorrect.";
        require RACINE . '/app/views/login/loginRegisterView.php';
        return;
    }

    /*if everything's ok : 
    * if the user is a regular member of the website : the home page is displayed
    * if the user is the admin : the dashboard is displayed
    */
    $_SESSION['user'] = $user;

    if ($user['role'] === 'admin') {
        header('Location: ' . BASE_URL . '/index.php?action=dashboard');
    } else {
        header('Location: ' . BASE_URL . '/index.php?action==default');
    }
    exit;
}

//creates a new user
function register()
{
    //gathers every data entered in the form using the POST method and trim() removes spaces or other parasite characters in the string
    $name     = trim($_POST['name']);
    $surname  = trim($_POST['surname']);
    $email    = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    /*the following conditions are used to verify the data entered in each fields
    * if any error is intercepted, a message is showed ($error), and the login/register view is showed to try again
    */
    //every field has to be filled
    if (empty($name) || empty($surname) || empty($email) || empty($username) || empty($password)) {
        $error = "Tous les champs sont obligatoires.";
        require RACINE . '/app/views/login/loginRegisterView.php';
        return;
    }

    //password's length has to be at least 8 or more
    if (strlen($password) < 8) {
        $error = "Le mot de passe doit contenir au moins 8 caractères.";
        require RACINE . '/app/views/login/loginRegisterView.php';
        return;
    }

    //password has to contain at least a capital letter, the '/.../' are used to delimit possible characters
    if (!preg_match('/[A-Z]/', $password)) {
        $error = "Le mot de passe doit contenir au moins une majuscule.";
        require RACINE . '/app/views/login/loginRegisterView.php';
        return;
    }

    //password has to contain at least a number, between 0 and 9
    if (!preg_match('/[0-9]/', $password)) {
        $error = "Le mot de passe doit contenir au moins un chiffre.";
        require RACINE . '/app/views/login/loginRegisterView.php';
        return;
    }

    //looking if the email entered is already used
    if (findByEmail($email)) {
        $error = "Cet email est déjà utilisé.";
        require RACINE . '/app/views/login/loginRegisterView.php';
        return;
    }

    if (!isset($_POST['acceptTerms'])) {
        $error = "Tu dois accepter les politiques de confidentialité pour t'inscrire.";
        require RACINE . '/app/views/auth/loginRegisterView.php';
        return;
    }

    //$data is an array meant to be used by createUser() as parameter
    $data = [
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
        'username' => $username,
        'password' => $password,
    ];

    //if everything's ok : creates a new user
    createUser($data);
    header('Location: ' . BASE_URL . '/index.php?action=loginPage'); //redirects towards the login page so the newly registered user can login 
    exit;
}

//deconnects user
function logout()
{
    //if the user isn't logged, shows the login page
    if (!isset($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php?action=loginPage');
        exit;
    }

    //else, if the user is logged and clicks on "deconnexion" button, deletes the session and the user is disconnected
    session_destroy();
    header('Location: ' . BASE_URL . '/index.php?action=default');
    exit;
}
