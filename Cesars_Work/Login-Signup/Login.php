<?php
    session_start();
 ?>
    <html>

    <head>
        <title>Login Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../w3.css">
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>

        <header>
            <div class="w3-row">
                <div class="w3-indigo w3-container ">
                    <h1 class="w3-center w3-jumbo w3-myfont">Average Joe's Basketball League</h1>
                </div>
            </div>
        </header>

        <div class="w3-container w3-red">
            <h2 class="w3-center w3-myfont"><strong><em>Please Login or Sign-Up</em></strong></h2>
        </div>

        <?php if (isset($_SESSION['login_errors'])){
      foreach ($_SESSION['login_errors'] as $error) { ?>
        <p class="error">
            <?= $error ?>
        </p>
        <?php   }
    }   ?>


        <form class="w3-container" action="" method="post">
            <div class="imgcontainer">
                <img src="../nba-logo.jpg" alt="Avatar" class="avatar">
            </div>

            <div class="w3-container w3-dark-gray center-div w3-round-xxlarge" style="padding:30px">
                <div class="w3-container">
                    <input type="hidden" name="action" value="login">
                    <label for="email"><strong class="w3-large">Email</strong></label>
                    <input type="text" id="email" name="email" placeholder="Enter Email" class="box w3-round-xxlarge" /><br /><br />
                    <label for="uname"><strong class="w3-large">Username</strong></label>
                    <input type="text" name="username" placeholder="Enter Username" class="box w3-round-xxlarge" /><br /><br />
                    <label for="password"><strong class="w3-large">Password</strong></label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" class="box w3-round-xxlarge" /><br/><br />
                    <button class="w3-indigo w3-hover-red w3-round-xxlarge" type="submit" value="Login"><strong class="w3-xlarge w3-myfont">Login</strong></button>
                    <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
                    <a href="Sign-up.php"><button type="button" class="signupbtn w3-round-xxlarge">Sign-Up!</button></a>
                    <span class="psw w3-hover-text-light-blue"><a href="#">Forgot password?</a></span>
                </div>
            </div>
        </form>



    </body>

    </html>