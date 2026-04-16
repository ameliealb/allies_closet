<?php

//the user visits the blog, the functions show every single published article 
function getAllArticles($limit, $offset)
{
    global $dbConnector;

    $limit  = (int)$limit;
    $offset = (int)$offset;

    $stmt = $dbConnector->prepare("
        SELECT * FROM ARTICLE 
        WHERE status = 'published'
        ORDER BY date_of_creation DESC
        LIMIT $limit OFFSET $offset
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getArticlesByCategory($category, $limit, $offset)
{
    global $dbConnector;

    $limit  = (int)$limit;
    $offset = (int)$offset;

    $stmt = $dbConnector->prepare("
        SELECT * FROM ARTICLE 
        WHERE status = 'published'
        AND category = ?
        ORDER BY date_of_creation DESC
        LIMIT $limit OFFSET $offset
    ");
    $stmt->execute([$category]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countArticlesByCategory($category)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT COUNT(*) as total 
        FROM ARTICLE 
        WHERE status = 'published'
        AND category = ?
    ");
    $stmt->execute([$category]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function getAllArticlesAdmin()
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT * FROM ARTICLE 
        ORDER BY date_of_creation DESC
    ");
    $stmt->execute();
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

function getArticleById($id)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("SELECT * FROM ARTICLE WHERE id_article = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//admin wants to create an article
function createArticle($data)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        INSERT INTO ARTICLE (id_user, title, content, status, category, article_image, date_of_creation, date_of_alteration)
        VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
    ");
    return $stmt->execute([
        $data['id_user'],
        $data['title'],
        $data['content'],
        $data['status'],
        $data['category'],
        $data['article_image']
    ]);
}

function updateArticle($id, $data)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        UPDATE ARTICLE 
        SET title = ?, content = ?, status = ?, article_image = ?, date_of_alteration = NOW()
        WHERE id_article = ?
    ");
    return $stmt->execute([
        $data['title'],
        $data['content'],
        $data['status'],
        $data['article_image'],
        $id
    ]);
}

function deleteArticle($id)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("DELETE FROM ARTICLE WHERE id_article = ?");
    return $stmt->execute([$id]);
}

function archiveArticle($id)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("UPDATE ARTICLE SET status = 'archived' WHERE id_article = ?");
    return $stmt->execute([$id]);
}

function countArticles()
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT COUNT(*) as total 
        FROM ARTICLE 
        WHERE status = 'published'
    ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

function likeArticle($id_user, $id_article)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        INSERT INTO LIKE_ (id_user, id_article) VALUES (?, ?)
    ");
    return $stmt->execute([$id_user, $id_article]);
}

function unlikeArticle($id_user, $id_article)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        DELETE FROM LIKE_ WHERE id_user = ? AND id_article = ?
    ");
    return $stmt->execute([$id_user, $id_article]);
}

function hasLikedArticle($id_user, $id_article)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT COUNT(*) as total FROM LIKE_ WHERE id_user = ? AND id_article = ?
    ");
    $stmt->execute([$id_user, $id_article]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] > 0;
}

function countLikesArticle($id_article)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT COUNT(*) as total FROM LIKE_ WHERE id_article = ?
    ");
    $stmt->execute([$id_article]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}