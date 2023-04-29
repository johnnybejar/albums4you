<ul id="nav-bar">
    <li <?php if ($currentPage == 'index.php') echo 'id="here"'; ?>><a href="index.php">Home</a></li>

    <?php
        if ($currentPage == 'logged_out.php' || isset($_SESSION['username'])) {
            if ($currentPage == 'logged_out.php') {
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li><a href="register.php">Register</a></li>';
            } else {
                if ($currentPage == 'create_post.php') {
                    echo '<li id="here"><a href="create_post.php">Create Post</a></li>';
                    echo '<li><a href="logged_out.php">Logout</a></li>';
                } else {
                    echo '<li><a href="create_post.php">Create Post</a></li>';
                    echo '<li><a href="logged_out.php">Logout</a></li>';
                }
            }
        } else {
            if ($currentPage == 'register.php') {
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li id="here"><a href="register.php">Register</a></li>';
            } else if ($currentPage == 'login.php') {
                echo '<li id="here"><a href="login.php">Login</a></li>';
                echo '<li><a href="register.php">Register</a></li>';
            } else {
                echo '<li><a href="login.php">Login</a></li>';
                echo '<li><a href="register.php">Register</a></li>';
            } 
        }
    ?>
    <li <?php if ($currentPage == 'about.php') echo 'id="here"'; ?>><a href="about.php">About</a></li>
</ul>