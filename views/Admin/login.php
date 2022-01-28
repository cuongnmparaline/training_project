<html>
<head>
    <base href="<?=BASE_URL?>">
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="assets/css/import/login.css">
</head>
<body>
<div id="wp-form-login">
    <form action="" method="POST" id="form-login">
        <input type="text" name="email" id="email" placeholder="Email" value="<?php if(isset($email)) echo $email?>">
        <?=flash_error('errorLogin', 'email')?>
        <input type="password" name="password" id="password" placeholder="Password">
        <?=flash_error('errorLogin', 'password')?>
        <input type="submit" name="btn-login" value="Login" id="btn-login">
        <?=flash_error('errorLogin', 'account')?>
    </form>
</div>
</body>



