<?php
$page = getPage();
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= IMG_LOCATION .'account/'.$accountInfo->hinh_anh?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                    <?= getFullName($accountInfo->ho, $accountInfo->ten) ?>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i>
                    <?=setRole($accountInfo->quyen)?>
                </a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Tìm kiếm...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">CƠ SỞ DỮ LIỆU</li>
            <li class="<?=($page['controller'] == 'home') ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Tổng quan</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="<?=($page['controller'] == 'home') ? 'active' : '' ?> treeview-menu">
                    <li class="<?=($page['controller'] == 'home' && $page['action'] == 'index') ? 'active' : '' ?>"><a href="home"><i class="fa fa-circle-o"></i> Thống kê</a></li>
                    <li class="<?=($page['controller'] == 'home' && $page['action'] == 'listEmployee') ? 'active' : '' ?>"><a a href="home/ds-nhanvien"><i class="fa fa-circle-o"></i> Danh sách nhân viên</a></li>
                    <li class="<?=($page['controller'] == 'home' && $page['action'] == 'listAccount') ? 'active' : '' ?>"><a href="home/ds-taikhoan"><i class="fa fa-circle-o"></i> Danh sách tài khoản</a></li>
                </ul>
            </li>
            <li class="<?=($page['controller'] == 'employee') ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Nhân viên</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=($page['controller'] == 'employee' && $page['action'] == 'department') ? 'active' : '' ?>"><a href="nhan-vien/phong-ban"><i class="fa fa-circle-o"></i> Phòng ban</a></li>
                    <li class=""><a href="chuc-vu.php?p=staff&a=position"><i class="fa fa-circle-o"></i> Chức vụ</a></li>
                    <li class=""><a href="trinh-do.php?p=staff&a=level"><i class="fa fa-circle-o"></i> Trình độ</a></li>
                    <li class=""><a href="chuyen-mon.php?p=staff&a=specialize"><i class="fa fa-circle-o"></i> Chuyên môn</a></li>
                    <li class=""><a href="bang-cap.php?p=staff&a=certificate"><i class="fa fa-circle-o"></i> Bằng cấp</a></li>
                    <li class=""><a href="loai-nhan-vien.php?p=staff&a=employee-type"><i class="fa fa-circle-o"></i> Loại nhân viên</a></li>
                    <li class=""><a href="them-nhan-vien.php?p=staff&a=add-staff"><i class="fa fa-circle-o"></i> Thêm mới nhân viên</a></li>
                    <li class="<?=($page['controller'] == 'employee' && $page['action'] == 'index') ? 'active' : '' ?>"><a href="nhan-vien"><i class="fa fa-circle-o"></i> Danh sách nhân viên</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Quản lý lương</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="bang-luong.php?p=salary&a=salary"><i class="fa fa-circle-o"></i> Bảng tính lương</a></li>
                    <li class=""><a href="tinh-luong.php?p=salary&a=calculator"><i class="fa fa-circle-o"></i> Tính lương</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Quản lý công tác</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="cong-tac.php?p=collaborate&a=add-collaborate"><i class="fa fa-circle-o"></i> Tạo công tác</a></li>
                    <li class=""><a href="danh-sach-cong-tac.php?p=collaborate&a=list-collaborate"><i class="fa fa-circle-o"></i> Danh sách công tác</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Nhóm nhân viên</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="tao-nhom.php?p=group&a=add-group"><i class="fa fa-circle-o"></i> Tạo nhóm</a></li>
                    <li class=""><a href="danh-sach-nhom.php?p=group&a=list-group"><i class="fa fa-circle-o"></i> Danh sách nhóm</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-star"></i> <span>Khen thưởng - Kỷ luật</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="khen-thuong.php?p=bonus-discipline&a=bonus"><i class="fa fa-circle-o"></i>Khen thưởng</a></li>
                    <li class=""><a href="ky-luat.php?p=bonus-discipline&a=discipline"><i class="fa fa-circle-o"></i> Kỷ luật</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Tài khoản</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="thong-tin-tai-khoan.php?p=account&a=profile"><i class="fa fa-circle-o"></i> Thông tin tài khoản</a></li>
                    <li class=""><a href="tao-tai-khoan.php?p=account&a=add-account"><i class="fa fa-circle-o"></i> Tạo tài khoản</a></li>
                    <li class=""><a href="ds-tai-khoan.php?p=account&a=list-account"><i class="fa fa-circle-o"></i> Danh sách tài khoản</a></li>
                    <li class=""><a href="doi-mat-khau.php?p=account&a=changepass"><i class="fa fa-circle-o"></i> Đổi mật khẩu</a></li>
                    <li><a href="dang-xuat.php"><i class="fa fa-circle-o"></i> Đăng xuất</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>