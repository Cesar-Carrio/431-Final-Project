<?php
    //dont know if the session from previous page
    //carries over. So not sure if i put session_start(); again.
?>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../w3.css">
        <link rel="stylesheet" href="styles.css">
    </head>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        * {
            box-sizing: border-box
        }
    </style>

<body>
        <?php if (isset($_SESSION['reg_errors'])){
                foreach ($_SESSION['reg_errors'] as $error) { ?>
                    <p class="error"><?= $error ?></p>
        <?php   }
            }   ?>

        <div class="w3-container center-div">
            <form action="process.php" method="post">
                <div class="w3-container w3-indigo w3-round-xxlarge">
                    <h1 class="w3-myfont">Sign Up</h1>
                    <p>Please fill in this form to create an account.</p>
                    <hr>

                    <input type="hidden" name="action" value="register">

                    <label for="first_name"><b>First Name</b></label>
                    <input id="first_name" type="text" placeholder="Enter First Name" name="first_name" class="w3-round-xxlarge" required>

                    <label for="last_name"><b>Last Name</b></label>
                    <input id="last_name" type="text" placeholder="Enter Last Name" name="last_name" class="w3-round-xxlarge" required>

                    <label for="email"><b>Email</b></label>
                    <input id="email" type="text" placeholder="Enter Email" name="email" class="w3-round-xxlarge" required>

                    <label for="password"><b>Password</b></label>
                    <input id="password" type="password" placeholder="Enter Password" name="password" class="w3-round-xxlarge" required>

                    <label for="c_password"><b>Repeat Password</b></label>
                    <input id="c_password" type="password" placeholder="Confirm Password" name="c_password" class="w3-round-xxlarge" required>

                    <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>

                    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                    <div class="clearfix">
                        <button type="button" class="cancelbtn-su w3-round-xxlarge">Cancel</button>
                        <button type="submit" value="Register"class=" signupbtn-su w3-round-xxlarge">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>

</body>

</html>
