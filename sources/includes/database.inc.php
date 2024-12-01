<?php
/**
 * Author: Jalen Vaughn
 * Date: 11/12/23
 * File: database.inc.php
 * Description: Procedural-style functions for handling MySQL database interactions.
 */

// Database connection properties
$connection = null;
$queryData = null;
$tableGames = 'games';
$tableEsrbs = 'esrbs';
$tableGenres = 'genres';
$tablePublishers = 'publishers';
$tableDevelopers = 'developers';
$tableUsers = 'users';

/**
 * Connect to the database.
 * @param string $dbHost Database host.
 * @param string $dbUser Database username.
 * @param string $dbPassword Database password.
 * @param string $dbName Database name.
 */
function connect($dbHost = 'localhost', $dbUser = 'phpuser', $dbPassword = 'phpuser', $dbName = 'videogame_db')
{
    global $connection;

    $connection = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    // Check for connection errors
    if ($connection->connect_error) {
        raiseError("There was an error connecting to the database.");
    }
}

/**
 * Run a SQL query.
 * @param string $sql_statement SQL query statement.
 * @return mixed Query result.
 */
function runQuery($sql_statement)
{
    global $connection;

    if (is_null($connection)) {
        raiseError("There is not an active connection to the database.");
    }

    $result = @$connection->query($sql_statement);

    if ($connection->error) {
        raiseError("There was an issue running the query . $connection->error");
    }

    return $result;
}

/**
 * Fetch data from the query result.
 * @param mixed $queryResult Query result.
 * @return array Fetched rows.
 */
function fetchData($queryResult)
{

    if (!$queryResult) {
        raiseError("There was an error fetching data from the query.");
    }


    // Fetch data and store in an array
    $rows = [];
    while ($row = $queryResult->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows;
}

/**
 * Close the database connection.
 * @return void
 */
function disconnect()
{
    global $connection;
    // Disconnect from Database
    $connection->close();
}

/**
 * Search for games based on search terms.
 * @param string $searchTerm Search term or terms.
 * @return array Search results.
 */
function searchGames($searchTerm)
{
    global $tableGames;

    // SQL statement
    $sql = "SELECT id, title, genre, esrb, price FROM $tableGames WHERE ";

    // Split search terms
    $terms = explode(' ', $searchTerm);

    foreach ($terms as $t) {
        $sql .= "title LIKE '%$t%' AND ";
    }

    $sql = rtrim($sql, 'AND ');

    // Run the query then fetch and return the results
    return fetchData(runQuery($sql));
}

/**
 * Runs a query on the item IDs found in the cart.
 * @param string $sql_statement SQL query statement.
 * @return mixed Query result.
 */
function findItems($sql_statement)
{
    // Declare the cart variable
    global $cart;

    // If cart isn't an array, display error
    if (!is_array($cart))
        raiseError("There was an error initializing the cart correctly.");

    // Build sql statement to retrieve all items in cart from db
    foreach (array_keys($cart) as $id) {
        $sql_statement .= " OR id=$id";
    }

    // run the query with the complete sql statement
    return runQuery($sql_statement);
}