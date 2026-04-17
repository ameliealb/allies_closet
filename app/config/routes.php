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
            default:
                show404();
                break;

            case "default":
                require RACINE . "/app/controllers/homeController.php";
                break;

            case "contact":
                require RACINE . "/app/controllers/contactController.php";
                break;

            case "aPropos":
                require RACINE . "/app/controllers/aboutController.php";
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

            case "showArticle":
                showArticle();
                break;

            case "toggleLikeArticle":
                toggleLikeArticle();
                break;


            case "submitComment":
                submitComment();
                break;

            case "deleteComment":
                submitDeleteComment();
                break;

            case "createArticle":
                showCreateArticle();
                break;

            case "submitArticle":
                submitArticle();
                break;

            case "showEditArticle":
                showEditArticle();
                break;

            case "submitEditArticle":
                submitEditArticle();
                break;

            case "deleteArticle":
                submitDeleteArticle();
                break;

            case "archiveArticle":
                submitArchiveArticle();
                break;

            case "forum":
                showForum();
                break;

            case "showCategory":
                showCategory();
                break;

            case "showForumCategory":
                showForumCategory();
                break;

            case "showMessage":
                showMessage();
                break;

            case "toggleLikeMessage":
                toggleLikeMessage();
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

            case "showProfile":
                showProfile();
                break;

            case "editProfile":
                showEditProfile();
                break;

            case "submitProfile":
                submitProfile();
                break;

            case "legal":
                showLegal();
                break;

            case "privacy":
                showPrivacy();
                break;
        }


        //how it works : URL => action => switch => executing function
    }
}
