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
        <?php if(isset($errors['email'])) echo "<p class='error'>{$errors['email']}</p>" ?>
        <input type="password" name="password" id="password" placeholder="Password">
        <?php if(isset($errors['password'])) echo "<p class='error'>{$errors['password']}</p>" ?>
        <input type="submit" name="btn-login" value="Login" id="btn-login">
        <?php if(isset($errors['account'])) echo "<p class='error'>{$errors['account']}</p>" ?>
    </form>
</div>
</body>



