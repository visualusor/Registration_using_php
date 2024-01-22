<?php
$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
            header("Location: index.php");
            exit;
        }
    }
    $is_invalid = true;
}
?>

<html>
  <head>
    <title>Visualusor - Login</title>
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
        <a href="index.html"><img src="logo.png" class="logo"></a>
      </div>
      <form method="post">
        <div class="container">
          <h1>Login</h1><br>

          <label for="email">Email</label>
          <input type="email" name="email" id="email"
                 value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

          <label for="password">Password</label>
          <input type="password" name="password" id="password">
          <br> <p>New to Visualusor? <a href="signup.html" style="color: dodgerblue">Join Now</a></p>
          <br>
          <button>Log in</button>
        </div>
      </form>
    </div>
  </body>
</html>
