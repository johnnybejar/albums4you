<?php 
  session_start();
	include './includes/title.php';
  $currentPage = basename($_SERVER['SCRIPT_FILENAME']);
  if ($_SESSION['username'] || $currentPage == 'create_post.php' || $currentPage == 'register.php' || $currentPage == 'login.php') {
    include 'secure_conn.php';
  } else {
    include 'reg_conn.php';
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- John Bejar -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap"
      rel="stylesheet"
    >
    <title><?="$title &ndash; "?>Albums4You</title>
  </head>
  <body>
    <header>
      <a href="index.php">
        <img src="assets/icon.png" id="icon" alt="website-icon">
        <h1 id="title">Albums4You</h1>
      </a>
    </header>
    <main>