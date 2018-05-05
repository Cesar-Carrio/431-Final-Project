<?php

    if (isset($_POST['submit'])){

        include_once '../db_credentials.php';

        $Name_first     = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Name_first']) );
        $Name_last      = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Name_last']));
        $Username       = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Username']));
        $Email          = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Email']));
        $pwd            = mysqli_real_escape_string($conn, htmlspecialchars($_POST['pwd']));
        $Acc_role       = mysqli_real_escape_string($conn, 'observer');
        //Any other account roles have to be added through either a user or manager

        //error handlers
        //check for empty fields
        if (empty($user_name) || empty($Email) || empty($pwd)){
            header("Location: ../signup.php?signup=empty");
            exit();
        } else {
            //check if input characters are valid
            if (!preg_match("/^[a-zA-Z*$]", $Name_first) || !preg_match("/^[a-zA-Z*$]", $Name_last)){
                header("Location: ../signup.php?signup=invalid");
                exit();
            } else {
                //check if email is valid
                if (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
                    header("Location: ../signup.php?signup=email");
                    exit();
                } else {
                    //checking to see if username is taken
                  $sql = "SELECT * FROM Accounts WHERE Username = '$Username'";
                  $result = mysqli_query($conn, $sql);
                  $resultCheck = mysqli_num_rows($result);

                  if ($resultCheck > 0){
                      header("Location: ../signup.php?signup=usertaken");
                      exit();
                  } else {
                      //hashing the password
                      $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                      //Inserting the user into the database
                      //preventing sql injection using mysqli_real_escape_string() used above in code
                      $sql = "INSERT INTO Accounts (Username, Acc_rol, Email, PassHash, Name_First, Name_Last) VALUES ('$Username','$Acc_role','$Email','$hashedPwd','$Name_first','$Name_last')";
                      $result = mysqli_query($conn,$sql);

                  }
                }
            }
        }

    } else {
        header("Location: ../signup.php");
        exit();
    }