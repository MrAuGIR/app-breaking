<?php
/**
 * Inserts a new game into the games table
 */


// Init functions
require_once('../functions.inc.php');

// Kill the script if POST data is not detected
if (!$_POST) {
    raiseError("Direct access to this script is not allowed.");
}

// Init database
require_once('../database.inc.php');

// Connect to Database
connect();

/* Retrieve game details.
 * For security purpose, call the built-in function real_escape_string to
 * escape special characters in a string for use in SQL statement.
 */
global $connection;

// Declare MySQL insert statement
/** @var $tableGames */
$query = runQuery
("INSERT INTO $tableGames
              VALUES 
                  (
                  NULL, 
                  '".$_POST['title']."', 
                  '".$_POST['genre']."',
                  '".$_POST['developer']."',
                  '".$_POST['publisher']."',
                  '".$_POST['rating']."',
                  '".$_POST['esrb']."',
                  '".$_POST['image']."',
                  '".$_POST['release_date']."', 
                  '".$_POST['price']."',
                  '".$_POST['description']."'
                  )"
);

// Determine game id
$id = $connection->insert_id;

// Disconnect from Database and return
disconnect();
header("Location: ../../gamedetails.php?id=$id&m=insert");
