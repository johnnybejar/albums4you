<?php
    session_start();
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $message = "Welcome back $username";
        $message2 = 'You are now logged in';
    } else {
        $message = 'You have reached this page in error.';
        $message2 = 'Please use the menu on the left.';
    }
    require 'includes/header.php';
    require 'includes/menu.php';

    echo "<section class=\"form-success\">";
    echo '<h2>'.$message.'</h2>';
	echo '<h3>'.$message2.'</h3>';
    echo "</section>";

    include 'includes/footer.php';
?>
