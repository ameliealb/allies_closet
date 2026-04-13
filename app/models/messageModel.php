<?php

//displays every "messages" known as topics
function getAllMessages()
{

    global $dbConnector;

    $stmt = $dbConnector->prepare("
    SELECT MESSAGE.* , USER_.username 
    FROM MESSAGE
    JOIN USER_ ON MESSAGE.id_user = USER_.id_user
    ORDER BY date_of_creation DESC
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

//displays replies published below a topic
function getRepliesByMessageId($id)
{
    global $dbConnector;

    $stmt = $dbConnector->prepare("
    SELECT MESSAGE.* , USER_.username 
    FROM MESSAGE
    JOIN USER_ ON MESSAGE.id_user = USER_.id_user
    WHERE MESSAGE.id_reply = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//creates a new topic
function createMessage($data){

    global $dbConnector;

    $stmt = $dbConnector->prepare("
    INSERT INTO MESSAGE(id_user, title, content, date_of_creation)
    VALUES (?, ?, ?, NOW())
    ");
    return $stmt->execute([
        $data['id_user'],
        $data['title'],
        $data['content']
    ]);
}

//creates a reply
function createReply($data){

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