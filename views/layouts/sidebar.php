<?php
$page = getPage();
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= IMG_LOCATION .'account/'.$accountInfo['hinh_anh']?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                    <?= getFullName($accountInfo['ho'], $accountInfo['ten']) ?>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i>
                    <?=setRole($accountInfo['quyen'])?>
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
            <li class="<?=($page['controller'] == 'home') ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Tổng quan</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="<?=($page['controller'] == 'home') ? 'active' : '' ?> treeview-menu">
                    <li class="<?=($page['controller'] == 'home' && $page['action'] == 'index') ? 'active' : '' ?>"><a href="home"><i class="fa fa-circle-o"></i> Thống kê</a></li>
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
                    <li class="<?=($page['controller'] == 'employee' && $page['action'] == 'position') ? 'active' : '' ?>"><a href="nhan-vien/chuc-vu"><i class="fa fa-circle-o"></i> Chức vụ</a></li>
                    <li class="<?=($page['controller'] == 'employee' && $page['action'] == 'education') ? 'active' : '' ?>"><a href="nhan-vien/trinh-do"><i class="fa fa-circle-o"></i> Trình độ</a></li>
                    <li class="<?=($page['controller'] == 'employee' && $page['action'] == 'technique') ? 'active' : '' ?>"><a href="nhan-vien/chuyen-mon"><i class="fa fa-circle-o"></i> Chuyên môn</a></li>
                    <li class="<?=($page['controller'] == 'employee' && $page['action'] == 'degree') ? 'active' : '' ?>"><a href="nhan-vien/bang-cap"><i class="fa fa-circle-o"></i> Bằng cấp</a></li>
                    <li class="<?=($page['controller'] == 'employee' && $page['action'] == 'type') ? 'active' : '' ?>"><a href="nhan-vien/loai"><i class="fa fa-circle-o"></i> Loại nhân viên</a></li>
                    <li class="<?=($page['controller'] == 'employee' && $page['action'] == 'create') ? 'active' : '' ?>"><a href="nhan-vien/them-moi"><i class="fa fa-circle-o"></i> Thêm mới nhân viên</a></li>
                    <li class="<?=($page['controller'] == 'employee' && $page['action'] == 'index') ? 'active' : '' ?>"><a href="nhan-vien"><i class="fa fa-circle-o"></i> Danh sách nhân viên</a></li>
                </ul>
            </li>
            <li class="<?=($page['controller'] == 'salary') ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Quản lý lương</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=($page['controller'] == 'salary' && $page['action'] == 'index') ? 'active' : '' ?>"><a href="luong/bang-luong"><i class="fa fa-circle-o"></i> Bảng tính lương</a></li>
                    <li class="<?=($page['controller'] == 'salary' && $page['action'] == 'calculate') ? 'active' : '' ?>"><a href="luong/tinh-luong"><i class="fa fa-circle-o"></i> Tính lương</a></li>
                </ul>
            </li>
            <li class="<?=($page['controller'] == 'bussiness') ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Quản lý công tác</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=($page['controller'] == 'bussiness' && $page['action'] == 'create') ? 'active' : '' ?>"><a href="tao-cong-tac"><i class="fa fa-circle-o"></i> Tạo công tác</a></li>
                    <li class="<?=($page['controller'] == 'bussiness' && $page['action'] == 'index') ? 'active' : '' ?>"><a href="cong-tac"><i class="fa fa-circle-o"></i> Danh sách công tác</a></li>
                </ul>
            </li>
            <li class="<?=($page['controller'] == 'team') ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Nhóm nhân viên</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=($page['controller'] == 'team' && $page['action'] == 'create') ? 'active' : '' ?>"><a href="tao-nhom"><i class="fa fa-circle-o"></i> Tạo nhóm</a></li>
                    <li class="<?=($page['controller'] == 'team' && $page['action'] == 'index') ? 'active' : '' ?>"><a href="nhom"><i class="fa fa-circle-o"></i> Danh sách nhóm</a></li>
                </ul>
            </li>
            <li class="<?=($page['controller'] == 'reward' || $page['controller'] == 'discipline') ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-star"></i> <span>Khen thưởng - Kỷ luật</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=($page['controller'] == 'reward') ? 'active' : '' ?>"><a href="khen-thuong"><i class="fa fa-circle-o"></i>Khen thưởng</a></li>
                    <li class="<?=($page['controller'] == 'discipline') ? 'active' : '' ?>"><a href="ky-luat"><i class="fa fa-circle-o"></i> Kỷ luật</a></li>
                </ul>
            </li>
            <li class="<?=($page['controller'] == 'account') ? 'active' : '' ?> treeview">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Tài khoản</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=($page['controller'] == 'account' && $page['action'] == 'detail') ? 'active' : '' ?>"><a href="tai-khoan/thong-tin"><i class="fa fa-circle-o"></i> Thông tin tài khoản</a></li>
                    <?php
                        if(isAdmin()){
                            ?>
                            <li class="<?=($page['controller'] == 'account' && $page['action'] == 'create') ? 'active' : '' ?>"><a href="tai-khoan/tao-tai-khoan"><i class="fa fa-circle-o"></i> Tạo tài khoản</a></li>
                            <li class="<?=($page['controller'] == 'account' && $page['action'] == 'index') ? 'active' : '' ?>"><a href="tai-khoan"><i class="fa fa-circle-o"></i> Danh sách tài khoản</a></li>
                    <?php
                        }
                    ?>
                    <li class="<?=($page['controller'] == 'account' && $page['action'] == 'changePass') ? 'active' : '' ?>"><a href="tai-khoan/doi-mat-khau"><i class="fa fa-circle-o"></i> Đổi mật khẩu</a></li>
                    <li><a href="logout"><i class="fa fa-circle-o"></i> Đăng xuất</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>