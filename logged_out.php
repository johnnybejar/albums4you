<?php
    require 'includes/header.php';
    require 'includes/menu.php';
    if (isset($_SESSION['email'])) {
        $username = $_SESSION['usernames'];

        // Deleting the session
        $_SESSION = array();
        session_destroy();
        setcookie('PHPSESSID', '', time()-3600, '/');

        $message = "You are now logged out $username";
        $message2 = 'See you next time';
    } else {
        $message = 'You have reached this page in error.';
        $message2 = 'Please use the menu on the left.';
    }
    
    echo "<section class=\"form-success\">";
    echo '<h2>'.$message.'</h2>';
	echo '<h3>'.$message2.'</h3>';
    echo "</section>";

    include 'includes/footer.php';
?>