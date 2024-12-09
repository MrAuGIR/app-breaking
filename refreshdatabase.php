<?php

require_once("./includes/functions.inc.php");

# declare required db
require_once("./includes/database.inc.php");

# Get db connection
connect();
global $connection;

$sql = file_get_contents(__DIR__."/videogame_db.sql");
$query = runQuery($sql);

$pageTitle = "Add game";
require_once 'header.php';
?>

<div>Database refreshed</div>


<?php
require_once 'footer.php';