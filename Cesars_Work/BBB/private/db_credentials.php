<?php
    define("DB_SERVER",'localhost');
    define("DB_USER",'root');
    define("DB_PASS",'password');
    define("DB_NAME",'ProjectBasketball431');

    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);