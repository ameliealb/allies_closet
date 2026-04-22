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
        require_once RACINE . "/app/controllers/errorController.php";
        
        switch ($this->action) {

            case "default":
                require_once RACINE . "/app/controllers/homeController.php";
                break;

            case "contact":
                require RACINE . "/app/controllers/contactController.php";
                break;

            case "sendContact":
                require RACINE . "/app/controllers/contactController.php";
                break;

            case "aPropos":
                require_once RACINE . "/app/controllers/aboutController.php";
                break;

            case "loginPage":
                require_once RACINE . "/app/controllers/loginController.php";
                showForm();
                break;

            case "login":
                require_once RACINE . "/app/controllers/loginController.php";
                login();
                break;

            case "register":
                require_once RACINE . "/app/controllers/loginController.php";
                register();
                break;

            case "logout":
                require_once RACINE . "/app/controllers/loginController.php";
                logout();
                break;

            case "blog":
                require_once RACINE . "/app/controllers/articlesController.php";
                showBlog();
                break;

            case "showCategory":
                require_once RACINE . "/app/controllers/articlesController.php";
                showCategory();
                break;

            case "showArticle":
                require_once RACINE . "/app/controllers/articlesController.php";
                showArticle();
                break;

            case "toggleLikeArticle":
                require_once RACINE . "/app/controllers/articlesController.php";
                toggleLikeArticle();
                break;

            case "createArticle":
                require_once RACINE . "/app/controllers/articlesController.php";
                showCreateArticle();
                break;

            case "submitArticle":
                require_once RACINE . "/app/controllers/articlesController.php";
                submitArticle();
                break;

            case "showEditArticle":
                require_once RACINE . "/app/controllers/articlesController.php";
                showEditArticle();
                break;

            case "submitEditArticle":
                require_once RACINE . "/app/controllers/articlesController.php";
                submitEditArticle();
                break;

            case "deleteArticle":
                require_once RACINE . "/app/controllers/articlesController.php";
                submitDeleteArticle();
                break;

            case "archiveArticle":
                require_once RACINE . "/app/controllers/articlesController.php";
                submitArchiveArticle();
                break;

            case "submitComment":
                require_once RACINE . "/app/controllers/commentaryController.php";
                submitComment();
                break;

            case "deleteComment":
                require_once RACINE . "/app/controllers/commentaryController.php";
                submitDeleteComment();
                break;

            case "dashboard":
                require_once RACINE . "/app/controllers/adminController.php";
                showDashboard();
                break;

            case "forum":
                require_once RACINE . "/app/controllers/messageController.php";
                showForum();
                break;

            case "showForumCategory":
                require_once RACINE . "/app/controllers/messageController.php";
                showForumCategory();
                break;

            case "showMessage":
                require_once RACINE . "/app/controllers/messageController.php";
                showMessage();
                break;

            case "toggleLikeMessage":
                require_once RACINE . "/app/controllers/messageController.php";
                toggleLikeMessage();
                break;

            case "createMessage":
                require_once RACINE . "/app/controllers/messageController.php";
                showCreateMessage();
                break;

            case "submitMessage":
                require_once RACINE . "/app/controllers/messageController.php";
                submitMessage();
                break;

            case "submitReply":
                require_once RACINE . "/app/controllers/messageController.php";
                submitReply();
                break;

            case "showProfile":
                require_once RACINE . "/app/controllers/userController.php";
                showProfile();
                break;

            case "editProfile":
                require_once RACINE . "/app/controllers/userController.php";
                showEditProfile();
                break;

            case "submitProfile":
                require_once RACINE . "/app/controllers/userController.php";
                submitProfile();
                break;

            case "legal":
                require_once RACINE . "/app/controllers/legalController.php";
                showLegal();
                break;

            case "privacy":
                require_once RACINE . "/app/controllers/legalController.php";
                showPrivacy();
                break;

            case "rules":
                require_once RACINE . "/app/controllers/rulesController.php";
                showRules();
                break;

            default:
                require_once RACINE . "/app/controllers/errorController.php";
                show404();
                break;
        }

        //how it works : URL => action => switch => executing function
    }
}
