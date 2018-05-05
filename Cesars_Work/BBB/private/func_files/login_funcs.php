<?php


    function chk_creds($username_cred){
        if (!isset($username_cred) || $username_cred == ''){
            header("Location: ../index.php");
            exit();
        } else {
            return true;
        }
    }

    function chk_login_button($login_submit){
        if (!isset($login_submit)){
            header("Location: ../index.php");
            exit();
        } else {
            return true;
        }
    }