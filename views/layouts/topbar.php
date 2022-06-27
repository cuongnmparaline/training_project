<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index.php?p=index&a=statistic" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>P</b>ARALINE</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>PARALINE</b>CORP</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= IMG_LOCATION .'account/'.$accountInfo['hinh_anh']?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?= getFullName($accountInfo['ho'], $accountInfo['ten']) ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?= IMG_LOCATION .'account/'.$accountInfo['hinh_anh']?>" class="img-circle" alt="User Image">

                                <p>
                                    <?= getFullName($accountInfo['ho'], $accountInfo['ten']) ?>
                                    <?=setRole($accountInfo['quyen'])?>
                                    <small>
                                        <?= "Lượt truy cập: " . $accountInfo['truy_cap']; ?>
                                    </small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="thong-tin-tai-khoan.php?p=account&a=profile" class="btn btn-default btn-flat">Thông tin</a>
                                </div>
                                <div class="pull-right">
                                    <a href="logout" class="btn btn-default btn-flat">Đăng xuất</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>