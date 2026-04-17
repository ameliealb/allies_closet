<?php
session_start();

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define("RACINE", __DIR__);

define("BASE_URL", "/projet-final");

require_once RACINE . "/app/config/database.php";
require_once RACINE . "/app/models/userModel.php";
require_once RACINE . "/app/models/articlesModel.php";
require_once RACINE . "/app/models/messageModel.php";
require_once RACINE . "/app/controllers/loginController.php";
require_once RACINE . "/app/controllers/articlesController.php";
require_once RACINE . "/app/controllers/adminController.php";
require_once RACINE . "/app/controllers/messageController.php";
require_once RACINE . "/app/controllers/userController.php";
require_once RACINE . "/app/models/commentaryModel.php";
require_once RACINE . "/app/controllers/commentaryController.php";
require_once RACINE . "/app/controllers/errorController.php";
require_once RACINE . "/app/controllers/legalController.php";

require_once RACINE . "/app/config/routes.php";

$route = new Route;
$route->route();