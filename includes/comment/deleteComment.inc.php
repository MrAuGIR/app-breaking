<?php

// Init functions
require_once('../functions.inc.php');

// Init database
require_once('../database.inc.php');

// Connect to Database and declare connection
connect();
global $connection;

/** @var $commentTable */
$query = runQuery("DELETE FROM comments WHERE id = '{$_GET['id']}'");


$idGame = $_GET['game'];
disconnect();
header("Location: ../../gamedetails.php?id=$idGame&m=deleteComment");