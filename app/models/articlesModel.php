<?php

//the user visits the blog, the functions show every single published article 
function getAllArticles()
{
    //connection to the database
    global $dbConnector;

    //request prepared, get every published article and order them by date in disorder (the most recent to the last recent)
    $stmt = $dbConnector->prepare(" SELECT * FROM ARTICLE WHERE status = 'published' ORDER BY date_of_creation DESC ");
    //execute request
    $stmt->execute();
    //return an associative array, for the articlesController
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//the user wants to search article by keyword
function searchArticles($keyword)
{
    global $dbConnector;

    //'%'. _ .'%' is used to find a value (keyword) at any position in the field
    $search = '%' . $keyword . '%';

    //requested prepared, keyword has to be founded either in the title or the content, then order the results by date in disorder
    $stmt = $dbConnector->prepare("
        SELECT * FROM ARTICLE 
        WHERE status = 'published'
        AND (title LIKE ? OR content LIKE ?)
        ORDER BY date_of_creation DESC
    ");
    //$search is used as both parameters, because the keyword is looked for in both title and content
    $stmt->execute([$search, $search]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//admin wants to create an article
function createArticle($data)
{
    global $dbConnector;

    //request prepared, NOW() for date_of_creation defines hour,date as the current's
    $stmt = $dbConnector->prepare("
        INSERT INTO ARTICLE (id_user, title, content, status, article_image, date_of_creation)
        VALUES (?, ?, ?, ?, ?, NOW())
    ");
    return $stmt->execute([
        $data['id_user'],
        $data['title'],
        $data['content'],
        $data['status'],
        $data['article_image']
    ]);
}
