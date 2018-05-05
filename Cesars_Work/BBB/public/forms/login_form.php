
<h1>LOGIN!</h1>
<form action="<?php echo url_for('Logged_In_Files/index.php');?>" method="post">
    Username: <br>
    <input type="text" name="username">
    <br>
    Password: <br>
    <input type="password" name="password" >
    <br><br>
    <button type="submit" value="submit" name="submit">Login</button>
    <br><br>
</form>

