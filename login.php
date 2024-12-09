<?php
/**
 * Allows users to login to their accounts from the user table
 */
$pageTitle = "Login";
include("header.php");
checkLogin();
?>
<!--Page Specific Content Starts-->
<section class="login-container">
    <div class="content-box">
        <h2>Login to Your Account</h2>
        <p class="sub-heading">Please enter your username and password to login.</p>
        <form action="includes/authentication/login.inc.php" method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" maxlength="50" placeholder="Enter your username" required />
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" maxlength="255" placeholder="Enter your password" required />
            </div>
            <button type="submit" name="Submit">Login</button>
        </form>
        <p class="signup-link">Don't have an account? <a href="signup.php">Create one here</a></p>
    </div>
</section>

<!--Page Specific Content Ends-->
<?php
include("footer.php");
?>
