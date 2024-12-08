<?php
/**
 * Updates a game in the games table
 */

// Init functions
require_once('../functions.inc.php');

// Kill the script if POST data is not detected
if (!$_POST) {
    raiseError("Direct access to this script is not allowed.");
}

// Retrieve game id
$id = getValidation(INPUT_POST, "id");

// Init database
require_once('../database.inc.php');

// Connect to Database and declare connection
connect();
global $connection;

//Define MySQL Update statement
/** @var $tableGames */
$query = runQuery
("UPDATE $tableGames
              SET 
                  title='".$_POST['title']."', 
                  genre='".$_POST['genre']."', 
                  developer='".$_POST['developer']."', 
                  publisher='".$_POST['publisher']."', 
                  rating='".$_POST['rating']."', 
                  esrb='".$_POST['esrb']."', 
                  image='".$_POST['image']."', 
                  release_date='".$_POST['release_date']."', 
                  price='".$_POST['price']."', 
                  description='".$_POST['description']."'
              WHERE id=".$_POST['id']
);

// Disconnect from Database and return
disconnect();
header("Location: ../../gamedetails.php?id=$id&m=update");
