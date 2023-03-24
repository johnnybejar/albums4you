<?php 
    include('includes/header.php');
    include('includes/menu.php'); 
?>
<form method="post" action="register.php">
    <fieldset>
        <legend>Register</legend>
        <label>Username: </label>
        <input name="username" id="username" type="text">
        <label>Password: </label>
        <input name="password" id="password" type="password">
        <label>Verify Password: </label>
        <input name="pass-verify" id="pass-verify" type="password">
        <label>Email: </label>
        <input name="email" id="email" type="text">

    </fieldset>
</form>
<?php
    include('includes/footer.php');
?>