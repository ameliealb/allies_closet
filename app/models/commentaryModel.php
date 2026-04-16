<?php

function getCommentById($id)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("SELECT * FROM COMMENTARY WHERE id_comment = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getCommentsByArticleId($id_article)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT COMMENTARY.*, USER_.username
        FROM COMMENTARY
        JOIN USER_ ON COMMENTARY.id_user = USER_.id_user
        WHERE COMMENTARY.id_article = ?
        ORDER BY COMMENTARY.date_of_sending ASC
    ");
    $stmt->execute([$id_article]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function createComment($data)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        INSERT INTO COMMENTARY (id_user, id_article, content, date_of_sending)
        VALUES (?, ?, ?, NOW())
    ");
    return $stmt->execute([
        $data['id_user'],
        $data['id_article'],
        $data['content']
    ]);
}

function deleteComment($id)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("DELETE FROM COMMENTARY WHERE id_comment = ?");
    return $stmt->execute([$id]);
}
