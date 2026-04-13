<?php

//our router
class Route
{
    //stocks every single action possible (login, logout, sign in, write a topic...)
    public $action;

    //an action will be found in the URL address (something like : 'action=default')
    public function __construct()
    {
        if (isset($_GET["action"])) {
            $this->action = $_GET["action"];
        } else {
            $this->action = "default";
        }
    }

    public function route()
    {

        switch ($this->action) {
            case "default":
                require RACINE . "/app/controllers/homeController.php";
                break;

            case "loginPage":
                showForm();
                break;

            case "login":
                login();
                break;

            case "register":
                register();
                break;

            case "logout":
                logout();
                break;

            case "blog":
                showBlog();
                break;

            case "dashboard":
                showDashboard();
                break;

            case "createArticle":
                showCreateArticle();
                break;

            case "submitArticle":
                submitArticle();
                break;

            case "forum":
                showForum();
                break;

            case "showMessage":
                showMessage();
                break;

            case "createMessage":
                showCreateMessage();
                break;

            case "submitMessage":
                submitMessage();
                break;

            case "submitReply":
                submitReply();
                break;
        }
        //how it works : URL => action => switch => executing function
    }
}
