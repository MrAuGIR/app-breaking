<?php
/**
 * Allows users to create an account in the users table
 */
$pageTitle = "Signup";
include("header.php");
checkSignup();
?>
<!--Page Specific Content Starts-->
<section class="signup-container">
    <div class="content-box">
        <h2>Create an Account</h2>
        <h3>Please enter your credentials to sign up.</h3>
        <form action="includes/authentication/signup.inc.php" method="post">
            <div class="input-group">
                <input type="text" name="firstname" maxlength="50" placeholder="Firstname..." required/>
            </div>
            <div class="input-group">
                <input type="text" name="lastname" maxlength="50" placeholder="Lastname..." required/>
            </div>
            <div class="input-group">
                <input type="email" name="email" maxlength="50" placeholder="Email..." required/>
            </div>
            <div class="input-group">
                <input type="text" name="username" maxlength="50" placeholder="Username..." required/>
            </div>
            <div class="input-group">
                <input type="password" name="password" maxlength="255" placeholder="Password..." required/>
            </div>
            <button type="submit" name="Submit">Sign Up</button>
        </form>
    </div>
</section>
<!--Page Specific Content Ends-->
<?php
include("footer.php");
?>
