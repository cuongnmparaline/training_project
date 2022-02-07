<?php

?>

<!DOCTYPE html>
<html>
<head>
    <base href="<?=BASE_URL?>">
    <title>User Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
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
            <div class="wp-inner clearfix" id="header">
                <ul id="main-menu" class="fl-right">
                    <li>
                        <a href="logout" title="">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="title-admin">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">My Profile</h3>
                </div>
            </div>
            <div class="section">
                <div class="section-detail">
                    <?php
                        if(!empty($id)){
                            ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <td scope="col">ID</td>
                                    <td scope="col"><?= $id?></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td scope="col">Avatar</td>
                                    <td scope="col"><img src="<?= $avatar?>" alt="" width="100px"></a></td>
                                </tr>
                                <tr>
                                    <td scope="col">Name</td>
                                    <td scope="col"><?= $name?></td>
                                </tr>
                                <tr>
                                    <td scope="col">Email</td>
                                    <td scope="col"><?= $email?></td>
                                </tr>
                                </tbody>
                            </table>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>