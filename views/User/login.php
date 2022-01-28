<html>

<head>
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="assets/css/import/login.css">
    <base href="<?=BASE_URL?>">
</head>

<body>
<div id="wp-form-login">
    <?php flash('user_message'); ?>
    <form action="/login" method="POST" id="form-login">
        <input type="text" name="email" id="email" placeholder="Email" value="<?php if(isset($email)) echo $email?>">
        <?=flash_error('errorLogin', 'email')?>
        <input type="password" name="password" id="password" placeholder="Password">
        <?=flash_error('errorLogin', 'password')?>
        <a href="<?php if(isset($data['login_url'])) echo $data['login_url']; ?>">Login via Facebook</a>
        <input type="submit" name="btn-login" value="Login" id="btn-login">
        <?=flash_error('errorLogin', 'account')?>
    </form>

</div>
</body>



