<?php
/*
 * File: removebook.php
 * Description: this script deletes a game from the database.
 *
 */

// Initial Page Requirements
$pageTitle = "Game Details";
require('header.php');

# Deny entry for unauthorized users
if ($_SESSION['role'] != 1) {
    raiseError("Direct Access to this page is forbidden");
}

// Connect to Database
connect();

// Retrieve and validate game id
$id = getValidation(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);


// Execute query with statement
/** @var $tableGames */
$query = runQuery("DELETE FROM $tableGames WHERE id=$id");

// Error clause
if (!$query) {
    disconnect();
    raiseError("Deletion failed");
}

echo "<p>The game has been successfully deleted from the database.</p>";
disconnect();
require_once 'footer.php';