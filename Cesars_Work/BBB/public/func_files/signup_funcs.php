<?php

if (isset($_POST['submit'])){


    include_once '../../private/db_credentials.php';

    $Name_first     = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Name_first']));
    $Name_last      = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Name_last']));
    $Username       = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Username']));
    $Email          = mysqli_real_escape_string($conn, htmlspecialchars($_POST['Email']));
    $pwd            = mysqli_real_escape_string($conn, htmlspecialchars($_POST['pwd']));
    $Acc_role       = mysqli_real_escape_string($conn, 'observer');
    //Any other account roles have to be added through either a user or manager


    //error handlers
    //check for empty fields
    if (empty($Name_first) || empty($Name_last) || empty($Email) || empty($Username) || empty($pwd)){
        header("Location: ../signup.php?signup=empty");
        exit();
    } else {
        //check if input characters are valid
        if (!preg_match("/^[a-zA-Z]*$/", $Name_first) || !preg_match("/^[a-zA-Z]*$/", $Name_last)){
            header("Location: ../signup.php?signup=invalid");
            exit();
        } else {
            //check if email is valid
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
                header("Location: ../signup.php?signup=email");
                exit();
            } else {
                //checking to see if username is taken
                $sql = "SELECT * FROM Accounts WHERE Username = ?;";
                //create a prepared statement
                $stmt = mysqli_stmt_init($conn);
                //prepare the prepared statement
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    echo "Sql statement failed";
                } else {
                    //bind params to the place holder
                    mysqli_stmt_bind_param($stmt, "s",$Username);
                    //Run params inside database
                    mysqli_stmt_execute($stmt);

                    //checks
                    $result = mysqli_stmt_get_result($stmt);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0){
                        header("Location: ../signup.php?signup=usertaken");
                        exit();
                    } else {
                        //hashing the password
                        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                        //Inserting the user into the database
                        //preventing sql injection using mysqli_real_escape_string() used above in code
                        $sql = "insert into Accounts(Username, Acc_role, Email, PassHash, Name_First, Name_last) values (?,?,?,?,?,?);";

                        $stmt = mysqli_stmt_init($conn);
                        //prepare the prepared statement
                        if (!mysqli_stmt_prepare($stmt,$sql)){
                            echo "Sql statement failed";
                        } else {
                            //bind params to the place holders
                            mysqli_stmt_bind_param($stmt,"ssssss", $Username,$Acc_role, $Email, $hashedPwd, $Name_first, $Name_last);
                            //Run params inside database
                            mysqli_stmt_execute($stmt);

                            header("Location: ../index.php?signup=success");
                            exit();
                        }
                    }
                }
            }
        }
    }

} else {
    header("Location: ../signup.php");
    exit();
}


