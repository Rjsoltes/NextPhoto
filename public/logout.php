<!-- Logout Page -->
<?php
    // Sets all the user info session variables to null, destroys the session, and redirects to the login page.
    require_once("../resources/config.php");

    $_SESSION['username'] = null;
    $_SESSION['fname'] = null;
    $_SESSION['lname'] = null;
    $_SESSION['email'] = null;
    $_SESSION['user_role'] = null;
    $_SESSION['user_id'] = null;

    session_destroy();
    redirect("../index.php");
?>
