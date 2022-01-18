<html>

<head>
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/import/login.css">
</head>

<body>
<div id="wp-form-login">
    <?php flash('user_message'); ?>
    <form action="/login" method="POST" id="form-login">
        <input type="text" name="email" id="email" placeholder="Email" value="">
        <?php echo form_error('email'); ?>
        <input type="password" name="password" id="password" placeholder="Password">
        <a href="<?php if(isset($data['login_url'])) echo $data['login_url']; ?>">Login via Facebook</a>
        <?php echo form_error('password'); ?>
        <input type="submit" name="btn-login" value="Login" id="btn-login">
        <?php echo form_error('account'); ?>
    </form>

</div>
</body>



