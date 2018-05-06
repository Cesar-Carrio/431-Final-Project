<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Welcome!'; ?><?php
if (isset($_SESSION['Username'])){
    header("Location: Logged_In_Files/index.php");
}
?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div>
    <div>
        <a href="<?php echo url_for('signup.php') ?>">Sign Up!</a>
    </div>
</div>


<?php include(SHARED_PATH.'/footer.php'); ?>