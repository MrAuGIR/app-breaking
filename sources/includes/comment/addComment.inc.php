<?php

// Init functions
require_once('../functions.inc.php');

// Kill the script if POST data is not detected
if (!$_POST) {
    raiseError("Direct access to this script is not allowed.");
}

// Init database
require_once('../database.inc.php');

// Connect to Database and declare connection
connect();
global $connection;

/** @var $commentTable */
$query = runQuery
("INSERT INTO $commentTable
              VALUES 
                  (
                  NULL, 
                  '".$_POST['comment']."', 
                  '".$_POST['username']."',
                  '".(int)$_POST['id_game']."'
                  )"
);
$idGame =$_POST['id_game'];
// Determine game id
$id = $connection->insert_id;

// Disconnect from Database and return
disconnect();
header("Location: ../../gamedetails.php?id=$idGame&m=addcomment");