<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Thông tin tài khoản
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
                <li><a href="thong-tin-tai-khoan.php?p=account&a=profile">Tài khoản</a></li>
                <li class="active">Thông tin tài khoản</li>
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
                                <?= setRole($account['quyen']) ?>
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
                                    <b>Trạng thái:</b> <a class="pull-right">
                                        <?= setAccountStatus($account['trang_thai']);
                                        ?>
                                    </a>
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
                            <li class="active"><a href="#settings" data-toggle="tab">Thay đổi thông tin</a></li>
                        </ul>
                        <div class="tab-content">
                            <?php flash('success_message'); ?>
                            <?php flash('error_message'); ?>
                            <div class="active tab-pane" id="settings">
                                <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Chọn ảnh: </label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="inputName" name="avatar">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Họ <b style="color: red;">*</b></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" placeholder="Nhập họ" value="<?php echo $account['ho']; ?>" name="lastName">
                                        </div>
                                    </div>
                                    <?=flash_error('errorEdit', 'lastName')?>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Tên <b style="color: red;">*</b></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputEmail" placeholder="Nhập tên" value="<?php echo $account['ten']; ?>" name="firstName">
                                        </div>
                                    </div>
                                    <?=flash_error('errorEdit', 'firstName')?>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName"  value="<?php echo $account['email']; ?>" name="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Số điện thoại</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputEmail" placeholder="Nhập số điện thoại" name="phone" value="<?php echo $account['so_dt']; ?>">
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <label for="inputExperience" class="col-sm-2 control-label">Quyền hạn</label>
                                            <div class="col-sm-10">
                                                <label>
                                                    <input type="radio" name="role" class="minimal" value="1" <?= $account['quyen'] == 1 ? 'checked' : '' ?>>
                                                    Quản trị viên
                                                </label>
                                                <label>
                                                    <input type="radio" name="role" class="minimal" value="0"<?= $account['quyen'] == 0 ? 'checked' : '' ?>>
                                                    Nhân viên
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputExperience" class="col-sm-2 control-label">Trạng thái</label>
                                            <div class="col-sm-10">
                                                <label>
                                                    <input type="radio" name="status" class="minimal" value="1" <?= $account['trang_thai'] == 1 ? 'checked' : '' ?>>
                                                    Đang hoạt động
                                                </label>
                                                <label>
                                                    <input type="radio" name="status" class="minimal" value="0" <?= $account['trang_thai'] == 0 ? 'checked' : '' ?>>
                                                    Không hoạt động
                                                </label>
                                            </div>
                                        </div>
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