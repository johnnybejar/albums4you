<?php 
    include('includes/header.php');
    include('includes/menu.php'); 
?>
<form method="post" action="register.php" id="form">
    <fieldset class="register-field">
        <legend>Register</legend>
            <label for="username">Username: </label>
            <input name="username" id="username" type="text">
            <label for="password">Password: </label>
            <input name="password" id="password" type="password">
            <label for="pass-verify">Verify Password: </label>
            <input name="pass-verify" id="pass-verify" type="password">
            <label for="email">Email: </label>
            <input name="email" id="email" type="text">
            <label>Subscribe to Our Newsletter for New Music?</label>
            <input name="subscribe" id="subscribe" type="checkbox">
    </fieldset>
</form>
<?php
    include('includes/footer.php');
?>