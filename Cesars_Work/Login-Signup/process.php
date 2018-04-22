<?php
  session_start();
  require_once('new-connection.php');
  $_SESSION['reg_errors'] = [];
  $_SESSION['login_errors'] = [];

  // registration form
  if (isset($_POST['action']) && $_POST['action'] == 'register'){
    if (empty($_POST['first_name'])){
      $_SESSION['reg_errors'][] = "First Name is required";
    } else if (strlen($_POST['first_name']) < 2){
      $_SESSION['reg_errors'][] = "First Name must be at least 2 characters";
    } else if (!ctype_alpha($_POST['first_name'])){
      $_SESSION['reg_errors'][] = "First Name can only contain letters";
    }
    if (empty($_POST['last_name'])){
      $_SESSION['reg_errors'][] = "Last Name is required";
    } else if (strlen($_POST['last_name']) < 2){
      $_SESSION['reg_errors'][] = "Last Name must be at least 2 characters";
    } else if (!ctype_alpha($_POST['last_name'])){
      $_SESSION['reg_errors'][] = "Last Name can only contain letters";
    }
    if (empty($_POST['email'])){
      $_SESSION['reg_errors'][] = "Email is required";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $_SESSION['reg_errors'][] = "Email is invalid";
    }
    if (empty($_POST['password'])){
      $_SESSION['reg_errors'][] = "Password is required";
    } else if (strlen($_POST['password']) < 8){
      $_SESSION['reg_errors'][] = "Password must be at least 8 characters";
    } else if ($_POST['password'] != $_POST['c_password']){
      $_SESSION['reg_errors'][] = "Passwords must match";
    }

    if (count($_SESSION['reg_errors']) > 0){
      //we have errors, let's send them back
      header('location: /');
      die();
    } else {
      //we don't have errors, let's do one extra bonus check to see if the email is already taken
      $query = "SELECT id FROM users WHERE email = '{$_POST['email']}'";
      $user = fetch_record($query);
      if (!empty($user)){
        $_SESSION['reg_errors'][] = "Email already taken";
        header('location: /');
        die();
      } else {
        //no user with that email, save!
        //but first let's escape any malicious strings
        $first_name = escape_this_string($_POST['first_name']);
        $last_name = escape_this_string($_POST['last_name']);
        $email = escape_this_string($_POST['email']);
        $password = escape_this_string($_POST['password']);
        //and create a salt
        $salt = bin2hex(openssl_random_pseudo_bytes(22));
        //and encrypt the password with md5 and the salt
        $enc_password = md5($password .''. $salt);

        $query = "INSERT INTO users (first_name, last_name, email, password, salt) VALUES ('{$first_name}', '{$last_name}', '{$email}', '{$enc_password}', '{$salt}')";
        $last_row_id = run_mysql_query($query);

        if ($last_row_id > 0){
          //success! we saved properly
          $_SESSION['user_id'] = $last_row_id;
          $_SESSION['email'] = $email;
          header('location: success.php');
          die();
        } else {
          die('The INSERT failed for this user');
        }
      }
    }

  // login form
  } else if (isset($_POST['action']) && $_POST['action'] == 'login'){
    $email = escape_this_string($_POST['email']);
    $password = escape_this_string($_POST['password']);
    //find a user based on email alone
    $query = "SELECT * FROM users WHERE email = '{$email}'";
    $user = fetch_record($query);
    //if we find a user, THEN compare passwords and do some encryption comparisons
    if (!empty($user)){
      $enc_password = md5($password .''. $user['salt']);
      if ($user['password'] == $enc_password){
        //great, we can save the email and user_id in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        header('location: success.php');
        die();
      } else {
        //that password didn't match
        $_SESSION['login_errors'][] = "Email/Password Combination Failed";
        header('location: /');
        die();
      }
    } else {
      //that email was never found but we shouldn't give this away to people trying to hack us
      $_SESSION['login_errors'][] = "Email/Password Combination Failed";
      header('location: /');
      die();
    }

  // logout form
  } else if (isset($_POST['action']) && $_POST['action'] == 'logout'){
    session_destroy();
    header('location: /');
    die();

  // no form :)
  } else {
    // someone got to process.php without submitting a valid form
    header('location: /');
    die();
  }
 ?>
