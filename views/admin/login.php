
<html>

<head>
    <base href="<?=BASE_URL?>">
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/import/login.css">
</head>

<body>
<div id="wp-form-login">
    <!--    <h1 class="page_title">Đăng nhập</h1>-->
    <form action="" method="POST" id="form-login">
        <input type="text" name="email" id="email" placeholder="Email" value="">
                <?php echo form_error('email'); ?>
        <input type="password" name="password" id="password" placeholder="Password">
                <?php echo form_error('password'); ?>
        <input type="submit" name="btn_login" value="Login" id="btn-login">
                <?php echo form_error('account'); ?>

    </form>
</div>
</body>



