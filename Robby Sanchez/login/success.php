<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Successful Login/Reg</title>
  </head>
  <body>
    <h1>Successfully logged in or registered!</h1>
    <p>Your Email: <?= $_SESSION['email'] ?></p>
    <p>Your User ID: <?= $_SESSION['user_id'] ?></p>
    <form action="process.php" method="post">
      <input type="hidden" name="action" value="logout">
      <input type="submit" value="Logout">
    </form>
  </body>
</html>
