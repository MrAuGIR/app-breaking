<?php

require_once("./includes/functions.inc.php");

# declare required db
require_once("./includes/database.inc.php");

# Get db connection
connect();
global $connection;

$sql = file_get_contents(__DIR__."/videogame_db.sql");
$query = runQuery($sql);

?>

<div>Database refreshed</div>