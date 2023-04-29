<?php
  include('includes/header.php');
  require('includes/menu.php');

  require_once '../../../mysqli_connect.php';
  $query = 'SELECT * FROM A4Y_Posts';
  $result = mysqli_query($dbc, $query);

  // We'll store all the info from a single row, store it into an array,
  // and store that one into this array
  $posts = array();
?>

<!-- Here, we use a 3D array to store all the posts  -->

<div id="forum-container">
  <?php
    while ($post = mysqli_fetch_assoc($result)) {
      $postInfo['username'] = $post['authorun'];

      $postInfo['id'] = $post['postid'];

      // First album
      $album1['image'] = $post['image1'];
      $album1['title'] = $post['title1'];
      $album1['artist'] = $post['artist1'];
      $albums['album1'] = $album1;

      // Second album
      $album2['image'] = $post['image2'];
      $album2['title'] = $post['title2'];
      $album2['artist'] = $post['artist2'];
      $albums['album2'] = $album2;

      // Third album
      $album3['image'] = $post['image3'];
      $album3['title'] = $post['title3'];
      $album3['artist'] = $post['artist3'];
      $albums['album3'] = $album3;

      // Fourth album
      $album4['image'] = $post['image4'];
      $album4['title'] = $post['title4'];
      $album4['artist'] = $post['artist4'];
      $albums['album4'] = $album4;

      $postInfo['albums'] = $albums;

      // Push all of the post info into the posts array and grab the next post
      $posts[] = $postInfo;
      
    }
    
    // Loop through all the posts
    foreach ($posts as $post) {
      echo '<div class="post">';
      echo "<span class=\"profile-name\">@{$post['username']}</span>";
      echo '<div class="post-albums">';

      // Loop through all the albums in the post
      foreach ($post['albums'] as $album) {

        $imagePath = "../a4y_uploads/{$post['username']}/{$post['id']}/{$album['image']}";
        if (!(file_exists($imagePath) && is_file($imagePath))) {
          $imagePath = 'assets/image-error.jpg';
        }

        // header('Content-Type: image/jpeg');
        // readfile($imagePath);

        echo '<figure class="album-figure">';

        echo "<img class=\"album-cover\" src=$imagePath alt=\"album-cover\">";
        // echo "<img class=\"album-cover\" src=\"../../../a4y_uploads/johnnyb/1/the-cold-vein.jpg\" alt=\"album-cover\">";

        echo '<figcaption class="album-caption">';
        echo "<span class=\"album-name\">{$album['title']}</span>";
        echo "<span class=\"album-artist\">- {$album['artist']}</span>";
        echo '</figcaption>';
        echo '</figure>';
      }
      echo '</div>';
      echo '</div>';
    }
  ?>
</div>

<?php
  include('includes/footer.php');
?>
