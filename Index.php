<?php
session_start();
if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/database.php";
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>

<html>
  <head>
    <title>Visualusor</title>
    <link rel="stylesheet" href="style.css" onclick="login.php">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="minilogo.png">
    <link rel="icon" href="index.php">
  </head>
  <body>
    <div class="banner">
      <video autoplay loop muted plays-inline class="background-clip">
        <source src="video.mp4" type="video/mp4">
      </video>
      <div class="navbar">
        <a href="index.php"><img src="logo.png" class="logo"></a>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="projects.html">Projects</a></li>
          <li><a href="tutorials.html">Tutorials</a></li>
          <li><a href="patches.html">Patches</a></li>
        </ul>
      </div>
      <div class="content">
        <?php if (isset($user)): ?>
        <h1>WELCOME <?= htmlspecialchars($user["name"]) ?></h1>
        <p>هذا الموقع تحت العمل</p>
        <div>
          <button type="button" name="button" onclick="location.href='logout.php'"><span></span>LOG OUT</button>
          <?php else: ?>
            <button type="button" name="button" onclick="location.href='login.php'"><span></span>LOG IN</button>
            <button type="button" name="button" onclick="location.href='signup.html'"><span></span>SIGN UP</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </body>
</html>
