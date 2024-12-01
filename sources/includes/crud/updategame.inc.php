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

// Securely grab the information
$title = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
$genre = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'genre', FILTER_DEFAULT)));
$developer = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'developer', FILTER_DEFAULT)));
$publisher = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'publisher', FILTER_DEFAULT)));
$rating = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_STRING)));
$esrb = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'esrb', FILTER_DEFAULT)));
$image = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
$release_date = $connection->real_escape_string(filter_input(INPUT_POST, 'release_date', FILTER_DEFAULT));
$price = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING)));
$description = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));

//Define MySQL Update statement
/** @var $tableGames */
$query = runQuery
("UPDATE $tableGames
              SET 
                  title='$title', 
                  genre='$genre', 
                  developer='$developer',
                  publisher='$publisher', 
                  rating='$rating', 
                  esrb='$esrb', 
                  image='$image', 
                  release_date='$release_date', 
                  price='$price',
                  description='$description'
              WHERE id=$id"
);

// Disconnect from Database and return
disconnect();
header("Location: ../../gamedetails.php?id=$id&m=update");
