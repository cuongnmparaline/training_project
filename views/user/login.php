<?php
//require './fb-init.php';
if(isset($_SESSION['picture'])){
    echo "<img src='{$_SESSION['picture']}' alt=''>";
}
if(isset($_SESSION['access_token'])) {
    echo "<a href='index.php?controller=user&action=logout'>Log out</a>";
} else {
    ?>

<html>

<head>
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/import/login.css">
</head>

<body>
<div id="wp-form-login">
    <?php flash('user_message'); ?>
    <!--    <h1 class="page_title">Đăng nhập</h1>-->
    <form action="index.php?controller=user&action=login" method="POST" id="form-login">
        <input type="text" name="email" id="email" placeholder="Email" value="">
        <?php echo form_error('email'); ?>
        <input type="password" name="password" id="password" placeholder="Password">
        <a href="<?php if(isset($data['login_url'])) echo $data['login_url']; } ?>">Login via Facebook</a>
        <?php echo form_error('password'); ?>
        <input type="submit" name="btn-login" value="Login" id="btn-login">
        <?php echo form_error('account'); ?>
    </form>

</div>
</body>



