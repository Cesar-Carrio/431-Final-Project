<?php
  //written by Todd Enders, 2017
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Registration</title>
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>
    <div>
      <h1>Register</h1>
<?php if (isset($_SESSION['reg_errors'])){
        foreach ($_SESSION['reg_errors'] as $error) { ?>
      <p class="error"><?= $error ?></p>
<?php   }
      }   ?>
      <form action="process.php" method="post">
        <input type="hidden" name="action" value="register">
        <label for="first_name">First Name:</label>
        <input id="first_name" type="text" name="first_name">
        <label for="last_name">Last Name:</label>
        <input id="last_name" type="text" name="last_name">
        <label for="email">Email:</label>
        <input id="email" type="text" name="email">
        <label for="password">Password:</label>
        <input id="password" type="password" name="password">
        <label for="c_password">Confirm Password:</label>
        <input id="c_password" type="password" name="c_password">
        <input type="submit" value="Register">
      </form>
    </div>
    <div>
      <h1>Login</h1>
<?php if (isset($_SESSION['login_errors'])){
        foreach ($_SESSION['login_errors'] as $error) { ?>
      <p class="error"><?= $error ?></p>
<?php   }
      }   ?>
      <form action="process.php" method="post">
        <input type="hidden" name="action" value="login">
        <label for="email">Email:</label>
        <input id="email" type="text" name="email">
        <label for="password">Password:</label>
        <input id="password" type="password" name="password">
        <input type="submit" value="Login">
      </form>
    </div>
  </body>
</html>
