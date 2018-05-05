<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Welcome!'; ?>
<?php include(SHARED_PATH . '/front_page_header.php'); ?>

<div>
    <?php include(WWW_ROOT . "forms/login_form.php"); ?>
    <div>
        <a href="<?php echo url_for('signup.php') ?>">Sign Up!</a>
    </div>
</div>


<?php include(SHARED_PATH.'/footer.php'); ?>