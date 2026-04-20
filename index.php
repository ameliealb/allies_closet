<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define("RACINE", __DIR__);

define("BASE_URL", "/amelie-bourdin/allies_closet");

require_once RACINE . "/config/database.php";
require_once RACINE . "/app/models/userModel.php";
require_once RACINE . "/app/models/articlesModel.php";
require_once RACINE . "/app/models/messageModel.php";
require_once RACINE . "/app/models/commentaryModel.php";
require_once RACINE . "/config/routes.php";

$route = new Route;
$route->route();