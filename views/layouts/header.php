<!DOCTYPE html>
<html>
<head>
    <title>Account manager</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/reset.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/style.css" rel="stylesheet" type="text/css"/>
    <link href="assets/responsive.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="public/login.css">
    <script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="assets/js/customs.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
    <script src="assets/js/app.js"></script>
</head>
<body>
<div id="site">
    <div id="container">
        <div id="header-wp">
            <div class="wp-inner clearfix">
                <a href="?" title="" id="logo" class="fl-left">ACCOUNT MANAGEMENT</a>
                <ul id="main-menu" class="fl-left">
                    <li>
                        <a href="?mod=page" title="">Admin Management</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?controller=admin&action=search" title="">Search</a>
                            </li>
                            <li>
                                <a href="?controller=admin&action=create" title="">Create</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?mod=post" title="">User Management</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?mod=users&action=search" title="">Search</a>
                            </li>
                            <li>
                                <a href="?mod=users&action=add" title="">Create</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                    <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <div id="thumb-circle" class="fl-left">
                            <img src="assets/images/img-admin.png">
                        </div>
                        <h3 id="account" class="fl-right"><?php if(!empty($_SESSION['user_login'])) echo $_SESSION['user_login'] ?></h3>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="?mod=users&action=update" title="Thông tin cá nhân">Account Information</a></li>
                        <li><a href="?controller=admin&action=logout" title="Thoát">Log out</a></li>
                    </ul>
                </div>
            </div>
        </div>