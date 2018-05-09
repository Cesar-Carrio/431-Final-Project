<?php
$joe = 'joe';
$toni = 'toni';


function hashy($pass){
    $hashedPassword = password_hash($pass,PASSWORD_DEFAULT);
    return $hashedPassword;
}

echo hashy($joe)."\n";
echo hashy($toni)."\n";