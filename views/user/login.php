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
        <input type="text" name="email" id="email" placeholder="Email" value="<?php if(isset($email)) echo $email?>">
        <?php if(isset($error['email'])) echo "<p class='error'>{$error['email']}</p>" ?>
        <input type="password" name="password" id="password" placeholder="Password">
        <?php if(isset($error['password'])) echo "<p class='error'>{$error['password']}</p>" ?>
        <a href="<?php if(isset($data['login_url'])) echo $data['login_url']; ?>">Login via Facebook</a>
        <input type="submit" name="btn-login" value="Login" id="btn-login">
        <?php if(isset($error['account'])) echo "<p class='error'>{$error['account']}</p>" ?>
    </form>

</div>
</body>



