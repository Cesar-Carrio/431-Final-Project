<?php
    session_start();
    $_SESSION['username'] = htmlspecialchars($_POST['username']);
    chk_login_button(htmlspecialchars($_POST['login_submit']));
    $login_status = chk_creds(htmlspecialchars($_SESSION['username']));

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
<header>Average Joes League Stat Tracker</header>