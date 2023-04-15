<?php 
    include('includes/header.php');
    include('includes/menu.php');

    if (isset($_POST['submit'])) {
        $errors = array();

        $email = filter_var(trim($_POST['email']));

        if (empty($email)) {
            $errors['email'] = 'An email address is required:';
        } else {
            $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if ($valid_email) {
                $email = $valid_email;
            } else {
                $errors['email'] = 'A valid email address is required:';
            }
        }

        $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($password)) {
            $errors['password'] = 'A password is required:';
        }

        if (!$errors) {
            require_once '../../../mysqli_connect.php';
            $sql = "SELECT username, email, pass FROM A4Y_Users WHERE email = ?";
            $stmt = mysqli_prepare($dbc, $sql);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            $rows = mysqli_num_rows($result);
            if ($rows==0) {
                $errors['emailNotFound'] = "That email address wasn't found";
            } else {
                $result2 = mysqli_fetch_assoc($result);
                $pw_hash = $result2['pass'];
                $folder = $result2['folder'];
                if (password_verify($password, $pw_hash)) {
                    $username = $result2['username'];
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['folder'] = $folder;
                    header("Location: logged_in.php");
                    exit;
                } else {
                    $errors['password'] = "That isn't the correct password";
                }
            }
        }
    }

?>
<form method="post" action="login.php" class="form">
    <fieldset>
        <legend>Login</legend>
        <?php if (!empty($errors)) echo "<span class=\"warning\">Please fix the item(s) indicated below.</span>"?>
        <?php if (isset($errors['email'])) echo "<span class=\"warning\">{$errors['email']}</span>" ?>
        <?php if (isset($errors['emailNotFound'])) echo "<span class=\"warning\">{$errors['emailNotFound']}</span>" ?>
        <label for="email">Email: </label>
        <input name="email" id="email" type="text"
        <?php 
            if (isset($username)) echo ' value="' . htmlspecialchars($username) . '"';
        ?>
        >

        <?php if (isset($errors['password'])) echo "<span class=\"warning\">{$errors['password']}</span>" ?>
        <label for="password">Password: </label>
        <input name="password" id="password" type="text">

        <input name="submit" id="submit" type="submit" value="Login">
    </fieldset>
</form>
<?php
    include('includes/footer.php');
?>