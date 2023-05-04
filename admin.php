<?php
    include('includes/header.php');
    require('includes/menu.php');

    // This page is ONLY accessible by admins and admins can ONLY be set
    // directly through the database by setting the admin value to 1

    // The purpose of this admin page is to be able to easily delete posts
    // directly from the website with a single click rather than having
    // to do so directly through the database
    echo '<div>';
    if (isset($_GET['id'])) {
        require_once '../../../mysqli_connect.php';
        $postID = $_GET['id'];
        $query = "DELETE FROM A4Y_Posts WHERE postid = $postID";
        if (mysqli_query($dbc, $query)) {
            echo "<h2>Successfully deleted post with id $postID!</h2>";
            require 'includes/footer.php';
            exit;
        } else {
            echo "<h2>Unable to delete post with id $postID!</h2>";
            require 'includes/footer.php';
            exit;
        }
    }

    // Non-admin users should never have the admin session initialized but in case it
    // is, we also check to make sure the admin value
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
        echo '<span>You have reached this page in error!</span>';
        require 'includes/footer.php';
        exit;
    } else {
        require_once '../../../mysqli_connect.php';
        $query = 'SELECT authorun, postid FROM A4Y_Posts ORDER BY postid';
        $result = mysqli_query($dbc, $query);
        $rows = mysqli_fetch_all($result);
        echo '<form method="get" action="admin.php">';
        foreach ($rows as $post) {
            echo '<label> Delete Post: ' . $post[1] . ' by ' . $post[0];
            echo "<input type=\"submit\" name=\"id\" value=\"$post[1]\">";
            echo '</label>';
        }
        echo '</form>';
    }
?>
    
<?php
    require 'includes/footer.php';
?>