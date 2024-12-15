<?php

// Init functions
require_once('../functions.inc.php');

// Init database
require_once('../database.inc.php');

//init badge
require_once('../badge/DetectSqlBreaking.php');
$alerte = '';

// Connect to Database and declare connection
connect();
global $connection;

/** @var $commentTable */
$query = runQuery("DELETE FROM comments WHERE id = {$_GET['id']}");

$detectSqlBreaking = new DetectSqlBreaking();

$sqlInString = $detectSqlBreaking->detectSqlInjection($_GET['id'], 'int');
$multipleRowTouched = is_countable($query) && $detectSqlBreaking->detectNotExpectedSqlTransaction(1, $query);

if ($sqlInString || $multipleRowTouched) {
    $alerte = 'SQL_INJECTION';
}

$idGame = $_GET['game'];
disconnect();
$url = "Location: ../../gamedetails.php?id=$idGame&m=deleteComment&alerte=$alerte";
header($url);