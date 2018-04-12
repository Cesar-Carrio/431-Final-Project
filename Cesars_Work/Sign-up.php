<?php
/**
 * Created by PhpStorm.
 * User: zar
 * Date: 4/12/18
 * Time: 12:20 AM
 */?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../w3.css">
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    * {box-sizing: border-box}
</style>

<body >
<div class="w3-container center-div">
    <form action="">
        <div class="w3-container w3-indigo w3-round-xxlarge">
            <h1 class="w3-myfont">Sign Up</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" 
class="w3-round-xxlarge" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" 
name="psw" class="w3-round-xxlarge" required>

            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" 
name="psw-repeat" class="w3-round-xxlarge" required>

            <label>
                <input type="checkbox" checked="checked" name="remember" 
style="margin-bottom:15px"> Remember me
            </label>

            <p>By creating an account you agree to our <a href="#" 
style="color:dodgerblue">Terms & Privacy</a>.</p>

            <div class="clearfix">
                <button type="button" class="cancelbtn-su 
w3-round-xxlarge">Cancel</button>
                <button type="submit" class="signupbtn-su 
w3-round-xxlarge">Sign Up</button>
            </div>
        </div>
    </form>
</div>

</body>
</html>


