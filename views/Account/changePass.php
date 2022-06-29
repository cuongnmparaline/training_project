<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Đổi mật khẩu
            </h1>
            <ol class="breadcrumb">
                <li><a href="home"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
                <li><a href="tai-khoan/thong-tin">Tài khoản</a></li>
                <li class="active">Đổi mật khẩu</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="<?= !empty($account['hinh_anh']) ? IMG_LOCATION . 'account/' . $account['hinh_anh'] : IMG_ACCOUNT_DEFAULT ?>" alt="User profile picture">

                            <h3 class="profile-username text-center"><?=getFullName($account['ho'], $account['ten'])?></h3>

                            <p class="text-muted text-center">
                                <?=setRole($account['quyen'])
                                ?>
                            </p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Lượt truy cập:</b> <a class="pull-right"><?php echo number_format($account['truy_cap']); ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Ngày tạo:</b> <a class="pull-right">
                                        <?php
                                        $date_cre = date_create($account['ngay_tao']);
                                        echo date_format($date_cre, 'd/m/Y');
                                        ?>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Ngày sửa:</b> <a class="pull-right">
                                        <?php
                                        $date_edi = date_create($account['ngay_sua']);
                                        echo date_format($date_edi, 'd/m/Y');
                                        ?>
                                    </a>
                                </li>
                                <li class="list-group-item">
                                    <b>Trạng thái:</b> <a class="pull-right">Đang hoạt động</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#settings" data-toggle="tab">Đổi mật khẩu</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="settings">
                                <form class="form-horizontal" method="POST">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Nhập mật khẩu cũ <b style="color: red;">*</b></label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputName" placeholder="Nhập mật khẩu cũ" name="oldPass" value="">
                                        </div>
                                    </div>
                                    <?=flash_error('errorChangePass', 'oldPass')?>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Nhập mật khẩu mới <b style="color: red;">*</b></label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputEmail" placeholder="Nhập mật khẩu mới" name="password" value="">
                                        </div>
                                    </div>
                                    <?=flash_error('errorChangePass', 'password')?>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Nhập lại mật khẩu mới <b style="color: red;">*</b></label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="inputName" placeholder="Nhập lại mật khẩu mới" name="passwordVerify" value="">
                                        </div>
                                    </div>
                                    <?=flash_error('errorChangePass', 'passwordVerify')?>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary" name="save"><i class="fa fa-save"></i> Lưu lại</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>

<?php
require_once('views/layouts/footer.php');
?>