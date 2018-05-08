<?php
if (!isset($page_title)) {
    $page_title = 'Average Joes';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $page_title ?></title>
</head>
<body>
<header>
    <h1>Average Joes League Stat Tracker </h1>
    <div>
        <?php
        if (isset($_SESSION['Username'])){
            echo '<form action="../../forms/logout.php" method="post">
            <button type="submit" name="submit">Logout</button>
            </form>';

            //closing connection so i can connect to db with correct creds
            db_disconnect($conn);
            //Section is for getting the correct user role
            //This section means they have logged in and that
            //there are session variables we can use

            define("DB_SERVER",'localhost');
            define("DB_USER",'431login');
            define("DB_PASS",'bishop567');
            define("DB_NAME",'ProjectBasketball431');


            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

            $role = mysqli_real_escape_string($conn, htmlspecialchars($_SESSION['role']));

            $sql = "select Account_name from Roles where Role = ?";
            //creating a prepared statement
            $stmt = mysqli_stmt_init($conn);
            //prepare the prepared statement
            if (!mysqli_stmt_prepare($stmt,$sql)){
                echo "Sql statement failed!";
            } else {
                //binding params to the place holder
                mysqli_stmt_bind_param($stmt,"s",$role);
                //Run params inside database
                mysqli_stmt_execute($stmt);
                //get results
                $results = mysqli_stmt_get_result($stmt);
                //
                //
                //
                //left off here
                db_disconnect($conn);
                if ($row = mysqli_fetch_assoc($results)){
                    //getting db_user
                    define("DB_SERVER2",'localhost');
                    define("DB_USER2",$row['Account_name']);
                    if ($row['Account_name'] == '431obs'){
                        define("DB_PASS2",'pawn012');
                    } elseif ($row['Account_name'] == '431user'){
                        define("DB_PASS2",'knight890');
                    }elseif ($row['Account_name'] == '431exec'){
                        define("DB_PASS2",'rook456');
                    } else {
                        header("Location: ../../public/index.php?db=error");
                        exit();
                    }
                    define("DB_NAME2",'ProjectBasketball431');
                    $conn = mysqli_connect(DB_SERVER2, DB_USER2, DB_PASS2, DB_NAME2);
                    //need to manually hash users and managers
                }
            }

        } else {
            echo '<h1>LOGIN!</h1>
                <form action="../func_files/login_funcs.php" method="post">
                    Username: <br>
                    <input type="text" name="Username">
                    <br>
                    Password: <br>
                    <input type="password" name="pwd" >
                    <br><br>
                    <button type="submit" value="submit" name="submit">Login</button>
                    <br><br>
                </form>';
        }
        ?>


    </div>

</header>