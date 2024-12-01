<?php

/**
 * Error handling sequence that disconnects from the database, redirect user to the error page,
 * and terminates the script
 * @param string $error_string Error message.
 * @return void
 */
function raiseError($error_string)
{
    global $connection;

    // Disconnect from Database
    if ($connection) {
        disconnect();
    }

    // Redirect user to correct page depending on location
    if (file_exists('error.php')) {
        header("Location: error.php?m=$error_string");

    } elseif (file_exists('../../error.php')) {
        header("Location: ../../error.php?m=$error_string");
    }

    // Terminate the script
    die();
}

/**
 * Checks session status and initiates a session if there is not one already active.
 * @return void
 */
function checkSession()
{
    # If session doesn't exist
    if (session_status() == PHP_SESSION_NONE) {

        # If session fails to start call an error
        if (!session_start()) {
            raiseError("There was an error starting a new session.");
        }
    }
}

/**
 * Perform input validation.
 * @param int $input_type Input type (INPUT_GET || INPUT_POST).
 * @param string $var_name Variable name.
 * @param int|null $filter Filter type (FILTER_SANITIZE_(STRING || NUMBER_INT || null).
 * @return mixed Validated input.
 */
function getValidation($input_type, $var_name, $filter = null)
{
    // Check if the variable exists
    if (!filter_has_var($input_type, $var_name)) {
        raiseError("There was an error retrieving page identification");

    }

    // Check for what type of filter to use
    $output = false;
    switch ($filter) {
        case null:
            $output = filter_input($input_type, $var_name);
            break;
        case FILTER_SANITIZE_STRING:
        case FILTER_SANITIZE_NUMBER_INT:
            $output = filter_input($input_type, $var_name, $filter);
            break;
        default:
            raiseError("There was an error specifying a filter type.");
            break;
    }

    // Check if output exists
    if (!$output) {
        raiseError("There was an error during the filtering process.");
    }

    return $output;
}

/**
 * Checks login status from $_SESSION and displays the page based on $login_status.
 * @return void
 * @var $login_status = 1 Login Successful.
 * @var $login_status = 2 Login Failed.
 * @var $login_status = 3 Account Creation Successful.
 * @var $login_status = 4 Login to Check out Items.
 * Some conditions reset $login_status to empty if they only should be displayed once.
 * @var $login_status = '' Pass.
 */
function checkLogin()
{
    // Declare variable that will hold the value for session[login status]
    $login_status = '';

    # If session variable set
    if (isset($_SESSION['login_status'])) {

        # let variable hold the value for session
        $login_status = $_SESSION['login_status'];
    }

    # Success
    if ($login_status == 1) {
        echo "<div class='form-container'>";
        echo "<p>You are logged in as " . $_SESSION['login'] . ".</p>";
        echo "<button><a href='logout.php'>Log out</a></button><br />";
        include('footer.php');
        exit();
    }

    # Error
    if ($login_status == 2) {
        echo "<div class='form-container'>";
        echo "Username or password invalid. Please try again.";
        echo "</div>";
        $_SESSION["login_status"] = '';
    }

    # New account
    if ($login_status == 3) {
        echo "<div class='form-container'>";
        echo "<p>Thank you for registering with us. Your account has been created.</p>";
        echo "<p>You are logged in as " . $_SESSION['login'] . ".</p>";
        echo "<button><a href='logout.php'>Log out</a></button><br />";
        include('footer.php');
        $_SESSION["login_status"] = 1;
        exit();
    }

    # No account; trying to access checkout.php
    if ($login_status == 4) {
        echo "<div class='form-container'>";
        echo "Login to your account to checkout your items.";
        echo "</div>";
        $_SESSION["login_status"] = '';
    }
    # If none, run page without any errors
}

/**
 * Checks signup status from $_SESSION and displays the page based on $signup_status
 * @return void
 * @var $signup_status = 2 Signup Failed: Email taken.
 * Some conditions reset $signup_status to empty if they only should be displayed once.
 * @var $signup_status = '' Pass
 * @var $signup_status = 1 Signup Failed: Username taken.
 */
function checkSignup()
{
    // Declare variable that will hold the value for session[signup status]
    $signup_status = '';

    # If session variable set
    if (isset($_SESSION['signup_status'])) {

        # let signup status hold value for session
        $signup_status = $_SESSION['signup_status'];
    }

    # Username error
    if ($signup_status == 1) {
        echo "<div class='form-container'>";
        echo "Username is already taken. Please choose a different one.";
        echo "</div>";
        $_SESSION['signup_status'] = '';
    }

    # Email error
    if ($signup_status == 2) {
        echo "<div class='form-container'>";
        echo "Email is already registered under an account.";
        echo "</div>";
        $_SESSION['signup_status'] = '';
    }
    # If none, run page without any errors
}
