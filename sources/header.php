<?php
/**
 * Header split from page content. Includes navigation bar
 * @var string $pageTitle
 */
require("includes/functions.inc.php");
require("includes/database.inc.php");

// Declare session var
checkSession();

if (!isset($_SESSION['login_status'])) {
    $_SESSION['login_status'] = null;
}

if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = null;
}

// Declare amount of items in cart through session var
$count = 0;
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    if ($cart) {
        $count = array_sum($cart);
    }
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="www/css/main.css"/>
    <title>Game 'n Go: <?php echo $pageTitle ?></title>

</head>
<!-- Body Tag Starts -->
<body>

<!-- Nav Bar Starts -->
<nav>

    <!-- Logo -->

    <div class="header">
        <div class="logo">
            <a href="index.php"><img src="www/img/logo.png" alt="Logo"></a>
        </div>

        <div class="nav">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="listgames.php">Games</a></li>
                <?php
                # Display different messages based on cart status
                if ($count == 0) {
                    echo "<li><a href='showcart.php'>Cart</a></li>";
                } elseif ($count == 1) {
                    echo "<li><a href='showcart.php'>Cart: $count item</a></li>";
                } else {
                    echo "<li><a href='showcart.php'>Cart: $count items</a></li>";
                }
                ?>

                <?php
                // Display different Navigation buttons based on user role
                # Nobody logged in
                if (!$_SESSION['login_status']) {
                    echo "<li><a href='signup.php'>Sign Up</a></li>";
                    echo "<li><a href='login.php'>Login</a></li>";
                }

                # Admin detected
                if ($_SESSION['role'] == 1) {
                    echo "<li><a href='addgame.php'>Add Games</a></li>";
                }

                # User logged in
                if ($_SESSION['login_status']) {
                    echo "<li><a href='logout.php'>Logout</a></li>";
                }
                ?>


            </ul>
        </div>

        <!-- Search bar -->
        <div class="search">
            <form action="searchresults.php" method="get">
                <input type="text" name="q" maxlength="50" placeholder="Search..." required>
                <input type="submit" name="Submit" id="Submit" value="Search Game">
            </form>
        </div>
    </div>

</nav>
<!-- Nav Bar Ends -->