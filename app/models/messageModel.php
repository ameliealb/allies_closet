<?php

//displays every "messages" known as topics
function getAllMessages($limit, $offset)
{
    global $dbConnector;

    $limit  = (int)$limit;
    $offset = (int)$offset;

    $stmt = $dbConnector->prepare("
        SELECT MESSAGE.*, USER_.username 
        FROM MESSAGE 
        JOIN USER_ ON MESSAGE.id_user = USER_.id_user
        WHERE MESSAGE.id_reply IS NULL
        AND MESSAGE.status = 'active'
        ORDER BY MESSAGE.date_of_creation DESC
        LIMIT $limit OFFSET $offset
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/*displays a specific topic, founded with its id
/*for example, if a topic has 3 as id, the url is gonna be "...action=showMessage&id=3"
*/
function getMessageById($id)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
    SELECT MESSAGE.* , USER_.username 
    FROM MESSAGE
    JOIN USER_ ON MESSAGE.id_user = USER_.id_user
    WHERE MESSAGE.id_message = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getMessagesByCategory($category, $limit, $offset)
{
    global $dbConnector;

    $limit  = (int)$limit;
    $offset = (int)$offset;

    $stmt = $dbConnector->prepare("
        SELECT MESSAGE.*, USER_.username
        FROM MESSAGE
        JOIN USER_ ON MESSAGE.id_user = USER_.id_user
        WHERE MESSAGE.id_reply IS NULL
        AND MESSAGE.status = 'active'
        AND MESSAGE.category = ?
        ORDER BY MESSAGE.date_of_creation DESC
        LIMIT $limit OFFSET $offset
    ");
    $stmt->execute([$category]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countMessagesByCategory($category)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT COUNT(*) as total
        FROM MESSAGE
        WHERE id_reply IS NULL
        AND status = 'active'
        AND category = ?
    ");
    $stmt->execute([$category]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

//displays replies published below a topic
function getRepliesByMessageId($id)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT MESSAGE.*, USER_.username 
        FROM MESSAGE 
        JOIN USER_ ON MESSAGE.id_user = USER_.id_user
        WHERE MESSAGE.id_reply = ?
        ORDER BY MESSAGE.date_of_creation ASC
    ");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function countMessages()
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT COUNT(*) as total 
        FROM MESSAGE 
        WHERE id_reply IS NULL
        AND status = 'active'
    ");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}

//displays last replies known in the sidebar on the forum's page
function getLastReplies()
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT MESSAGE.*, USER_.username, TOPIC.title as topic_title
        FROM MESSAGE
        JOIN USER_ ON MESSAGE.id_user = USER_.id_user
        JOIN MESSAGE AS TOPIC ON MESSAGE.id_reply = TOPIC.id_message
        WHERE MESSAGE.id_reply IS NOT NULL
        AND TOPIC.id_reply IS NULL
        ORDER BY MESSAGE.date_of_creation DESC
        LIMIT 5
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//creates a new topic
function createMessage($data)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        INSERT INTO MESSAGE (id_user, title, content, category, date_of_creation)
        VALUES (?, ?, ?, ?, NOW())
    ");
    return $stmt->execute([
        $data['id_user'],
        $data['title'],
        $data['content'],
        $data['category']
    ]);
}

//creates a reply
function createReply($data)
{

    global $dbConnector;

    $stmt = $dbConnector->prepare("
    INSERT INTO MESSAGE(id_user, id_reply, content, date_of_creation)
    VALUES (?, ?, ?, NOW())
    ");
    return $stmt->execute([
        $data['id_user'],
        $data['id_reply'],
        $data['content']
    ]);
}

function likeMessage($id_user, $id_message)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        INSERT INTO LIKING (id_user, id_message) VALUES (?, ?)
    ");
    return $stmt->execute([$id_user, $id_message]);
}

function unlikeMessage($id_user, $id_message)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        DELETE FROM LIKING WHERE id_user = ? AND id_message = ?
    ");
    return $stmt->execute([$id_user, $id_message]);
}

function hasLikedMessage($id_user, $id_message)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT COUNT(*) as total FROM LIKING WHERE id_user = ? AND id_message = ?
    ");
    $stmt->execute([$id_user, $id_message]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'] > 0;
}

function countLikesMessage($id_message)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
        SELECT COUNT(*) as total FROM LIKING WHERE id_message = ?
    ");
    $stmt->execute([$id_message]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['total'];
}