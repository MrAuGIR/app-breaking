<?php
/**
 * checkout.php: Displays the checkout page for user to empty their carts
 */

// Initial Page Requirements
$pageTitle = "Checkout";
require('header.php');

// Prompt user to login in order to checkout
if (!isset($_SESSION['login'])) {
    $_SESSION['login_status'] = 4;
    header("Location: login.php");
    exit();
}

$_SESSION['cart'] = array();
?>
    <div class="container">
        <h2>Checkout</h2>
        <p>Thank you for shopping with us. Your business is greatly appreciated. You will
            be notified once your items are shipped.
        </p>

<?php
include("footer.php");