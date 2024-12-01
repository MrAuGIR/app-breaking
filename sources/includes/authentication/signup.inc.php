<?php
/**
 * Validates signup info
 * If good: redirects to login page
 * If bad: redirects back to signup page
 * @var $tableUsers
 */
# Declare required functions
require_once("../functions.inc.php");

// Kill the script if POST data is not detected
if (!$_POST) {
    raiseError("Direct access to this script is not allowed.");
}

# Declare required database, connection, and session
require_once("../database.inc.php");
connect();
global $connection;
checkSession();

# Securely set attributes from POST
$firstname = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING)));
$lastname = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING)));
$email = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)));
$username = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)));
$password = $connection->real_escape_string(trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));
$role = 2;  //regular user

# Before inserting, check if user already exists in the database
// Run query matching the username
$query = runQuery
("SELECT * 
              FROM $tableUsers
              WHERE username='$username'
              ");

// If username already exists return back to signup screen
if ($query->fetch_assoc()) {
    $_SESSION['signup_status'] = 1;
    header("Location: ../../signup.php");
    exit();
}

# Before inserting, check if email already exists in the database
// Run query matching the username
$query = runQuery
("SELECT * 
              FROM $tableUsers
              WHERE email='$email'
              ");

// If email already exists return back to signup screen
if ($query->fetch_assoc()) {
    $_SESSION['signup_status'] = 2;
    header("Location: ../../signup.php");
    exit();
}


// Hash password
$password_encrypted = password_hash($password, PASSWORD_DEFAULT);

//execute the insert query
$query = runQuery
(
    "INSERT INTO $tableUsers 
                 VALUES 
                 (
                  NULL, 
                  '$firstname',
                  '$lastname',
                  '$email',
                  '$username',
                  '$password_encrypted',
                  '$role'
                  )"
);

# Handle potential error
if (!$query) {
    raiseError("There was an error inserting registry.");
}

# Disconnect from Database
disconnect();

# Set session
checkSession();

$_SESSION["login"] = $username;
$_SESSION["name"] = "$firstname $lastname";
$_SESSION["role"] = 2;


$_SESSION["login_status"] = 3;

header("Location: ../../login.php");