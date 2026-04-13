<?php
session_start();

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define("RACINE", __DIR__);

require_once RACINE . "/app/config/database.php";
require_once RACINE . "/app/models/loginModel.php";
require_once RACINE . "/app/models/articlesModel.php";
require_once RACINE . "/app/models/messageModel.php";
require_once RACINE . "/app/controllers/loginController.php";
require_once RACINE . "/app/controllers/articlesController.php";
require_once RACINE . "/app/controllers/adminController.php";
require_once RACINE . "/app/controllers/messageController.php";

require_once RACINE . "/app/config/routes.php";

$route = new Route;
$route->route();