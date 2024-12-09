<?php
/**
 * Logs users out of their accounts
 */
$pageTitle = "Logout";
include ('header.php');

# start session
checkSession();

# unset all session variables
$_SESSION = [];

# delete session cookies
setcookie(session_name(), "", time() - 3600);

# destroy session
session_destroy();
?>
<section>
    <div class="container">
        <h2>Logout</h2>
        <p>You're now logged out of your account.</p>
    </div>
</section>


<?php
include ('footer.php');
?>

