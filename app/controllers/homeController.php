<?php

function showHome()
{

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    // gets last article
    $lastArticle = getLastArticle();

    // gets last 3 articles
    $latestArticles = getLatestArticles(5);

    require RACINE . '/app/views/homeView.php';
}

showHome();
