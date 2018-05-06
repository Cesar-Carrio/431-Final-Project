<?php
    session_start();
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