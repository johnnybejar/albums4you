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

        if (!empty($_POST['subscribe'])) {
            $subscribe = $_POST['subscribe'];
        }

        if (!$errors) {
            echo "Thank you for registering with us, $username!<br>";
            if (isset($subscribe)) {
                echo "Your email is $email and you have chosen to subscribe to our newsletter!<br>";
            } else {
                echo "Your email is $email and you did not subscribe to our newsletter.<br><br>";
            }
            echo "You can now post on our forum.";
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

            <?php if (isset($errors['email'])) echo "<h5>$errors[email]</h5>";  ?>
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