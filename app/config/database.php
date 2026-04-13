<?php

//"global" put the variable reachable for the whole code
global $dbConnector;

  try {
    //connecting to the database
    $dbConnector = new PDO("mysql:dbname=" . $_ENV['DB_NAME'] . "; host=" . $_ENV['DB_HOST'] . ":" . $_ENV['DB_PORT'] . "; charset=utf8", $_ENV['DB_LOGIN'],$_ENV['DB_PASSWORD']);
    //on définit une option de config, ici ATTR_ERRMODE pour contrôler la gestion des erreurs, et ERRMODE_EXCEPTION pour déclencher des exceptions
    $dbConnector->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }

  //if catches an error, displays a message
  catch (Exception $e){
    die($e->getMessage());
  }
?>