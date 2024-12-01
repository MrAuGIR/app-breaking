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

// Check each POST variable and kill the script if any of them aren't detected.
if (!filter_has_var(INPUT_POST, 'title') ||
    !filter_has_var(INPUT_POST, 'genre') ||
    !filter_has_var(INPUT_POST, 'developer') ||
    !filter_has_var(INPUT_POST, 'publisher') ||
    !filter_has_var(INPUT_POST, 'rating') ||
    !filter_has_var(INPUT_POST, 'esrb') ||
    !filter_has_var(INPUT_POST, 'image') ||
    !filter_has_var(INPUT_POST, 'release_date') ||
    !filter_has_var(INPUT_POST, 'price') ||
    !filter_has_var(INPUT_POST, 'description')) {

    raiseError("There was an error retrieving game details. Game cannot be added.");
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

// Declare MySQL insert statement
/** @var $tableGames */
$query = runQuery
("INSERT INTO $tableGames
              VALUES 
                  (
                  NULL, 
                  '$title', 
                  '$genre', 
                  '$developer',
                  '$publisher', 
                  '$rating', 
                  '$esrb', 
                  '$image', 
                  '$release_date', 
                  '$price',
                  '$description'
                  )"
);

// Determine game id
$id = $connection->insert_id;

// Disconnect from Database and return
disconnect();
header("Location: ../../gamedetails.php?id=$id&m=insert");
