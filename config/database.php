<?php

//"global" put the variable reachable for the whole code
global $dbConnector;

  try {
    //connect to the database
    $dbConnector = new PDO("mysql:dbname=" . $_ENV['DB_NAME'] . "; host=" . $_ENV['DB_HOST'] ."; charset=utf8", $_ENV['DB_LOGIN'],$_ENV['DB_PASSWORD']);
    //define a config option, here ATTR_ERRMODE to manage errors and ERRMODE_EXCEPTION for exceptions
    $dbConnector->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }

  //if catches an error, displays a message
  catch (Exception $e){
    die($e->getMessage());
  }
?>