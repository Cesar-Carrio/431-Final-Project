<?php

//
//    function chk_creds($username_cred){
//        if (!isset($username_cred) || $username_cred == ''){
//            header("Location: ../index.php");
//            exit();
//        } else {
//            return true;
//        }
//    }
//
//    function chk_login_button($login_submit){
//        if (!isset($login_submit)){
//            header("Location: ../index.php");
//            exit();
//        } else {
//            return true;
//        }
//    }

session_start();

if (isset($_POST['submit'])){

    include '../../private/db_credentials.php';

    $Username   = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Username']));
    $pwd        = mysqli_real_escape_string($conn, htmlspecialchars($_POST['pwd']));

    //error handlers
    //check if inputs are empty
    if (empty($Username) || empty($pwd)){
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        $sql = "select * from Accounts where Username=?";

        //create a prepared statement
        $stmt = mysqli_stmt_init($conn);
        //prepare the prepared statement
        if (!mysqli_stmt_prepare($stmt,$sql)){
            echo "Sql statement failed!";
        } else {
            //bind params to the place holder
            mysqli_stmt_bind_param($stmt, "s", $Username);
            //Run params inside database
            mysqli_stmt_execute($stmt);

            //checks
            $result = mysqli_stmt_get_result($stmt);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck < 1){
                header("Location: ../index.php?login=error");
                exit();
            } else {
                if ($row = mysqli_fetch_assoc($result)){
                    //De-hashing
                    $hashedPwdCheck = password_verify($pwd, $row['PassHash']);
                    if ($hashedPwdCheck == false) {
                        header("Location: ../index.php?login=error");
                        exit();
                    } elseif($hashedPwdCheck == true) {
                        //log in the user here
                        $_SESSION['Username'] = $row['Username'];
                        $_SESSION['first'] = $row['Name_First'];
                        $_SESSION['last'] = $row['Name_Last'];
                        $_SESSION['email'] = $row['Email'];
                        $_SESSION['role'] = $row['Acc_role'];
                        header("Location: ../Logged_In_Files/index.php?login=success");
                        exit();

                    }
                }
            }
        }
    }

} else {
    header("Location: ../index.php?login=error");
    exit();
}