<?php 
    include('includes/header.php');
    include('includes/menu.php'); 

    if (isset($_POST['submit'])) {
        $errors = array();

        if (!empty($_POST['username'])) {
            $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        } else {
            $errors['username'] = 'Please enter a username';
        }

        if (!empty($_POST['email'])) {
            $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
            $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if ($valid_email) {
                $email = $valid_email;
            } else {
                $errors['email'] = 'Please enter a valid email address';
            }
        } else {
            $errors['email'] = 'Please enter an email address';
        }

        if (!empty($_POST['password'])) {
            $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $verify = filter_var(trim($_POST['pass-verify']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($password != $verify) {
                $errors['password'] = 'Your passwords must match';
            }
        } else {
            $errors['password'] = 'You did not enter a password';
        }

        require_once '../../../mysqli_connect.php';
        $sql = 'SELECT email from A4Y_Users where email = ?';
        $stmt = mysqli_prepare($dbc, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) >=1) {
            $errors['exists'] = 'That email already exists in the database. Please log in or enter a different email.';
        }
        mysqli_free_result($result);

        if (!empty($_POST['subscribe'])) {
            $subscribe = 1;
        } else {
            $subscribe = 0;
        }
        if (!$errors) {
            $folder = preg_replace("/[^a-zA-Z0-9]/","", $email);
		    $folder = strtolower($folder);

            $sql2 = "INSERT INTO A4Y_Users (username, email, pass, folder, subscribe) VALUES (?, ?, ?, ?, ?)";
            $stmt2 = mysqli_prepare($dbc, $sql2);
            $pwHash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt2, 'ssssi', $username, $email, $pwHash, $folder, $subscribe);
            mysqli_stmt_execute($stmt2);
            echo "<section class=\"register-success\">";
            if (mysqli_stmt_affected_rows($stmt2)) {
                if ($subscribe == 1) {
                    echo "<h2>Thank you for registering with us, $username! You have chosen to subscribe to our newsletter!</h2>";
                } else {
                    echo "<h2>Thank you for registering with us, $username! You did not subscribe to our newsletter.</h2>";
                }
                echo "<h3>You can now post on our forum.</h3>";
            } else {
                echo "<h2>We're sorry. We are unable to add your account at this time.</h2><h3>Please try again later</h3>";
            }
            echo "</section>";
            include 'includes/footer.php'; 
            exit;
        }
    }

?>
<form method="post" action="register.php" id="form">
    <fieldset class="register-field">
        <legend>Register</legend>
            <?php if (isset($errors)) echo'<h3 class="warning">Please fix the item(s) indicated.</h3>'; ?>

            <?php if (isset($errors['username'])) echo "<h5>$errors[username]</h5>";  ?>
            <label for="username">Username: </label>
            <input name="username" id="username" type="text"
            <?php if (isset($username)) echo ' value="' . htmlspecialchars($username) . '"'?>>

            <?php 
            if (isset($errors['email'])) echo "<h5>$errors[email]</h5>"; 
            if (isset($errors['exists'])) echo "<h5>$errors[exists]</h5>";
            ?>
            <label for="email">Email: </label>
            <input name="email" id="email" type="text"
            <?php if (isset($email)) echo ' value="' . htmlspecialchars($email) . '"'?>>

            <?php if (isset($errors['password'])) echo "<h5>$errors[password]</h5>";  ?>
            <label for="password">Password: </label>
            <input name="password" id="password" type="password">
            <label for="pass-verify">Verify Password: </label>
            <input name="pass-verify" id="pass-verify" type="password">

            <label for="subscribe">Subscribe to Our Newsletter for New Music?</label>
            <input name="subscribe" id="subscribe" type="checkbox">

            <input name="submit" id="submit" type="submit">
    </fieldset>
</form>
<?php
    include('includes/footer.php');
?>