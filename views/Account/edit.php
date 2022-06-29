<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tài khoản
            </h1>
            <ol class="breadcrumb">
                <li><a href="home"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
                <li><a href="tai-khoan">Tài khoản</a></li>
                <li class="active">Chỉnh sửa tài khoản</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tạo tài khoản</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" method="POST" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chọn ảnh: </label>
                                    <input type="file" class="form-control" id="exampleInputEmail1" name="avatar">
                                    <p class="help-block">Vui lòng chọn file đúng định dạng: jpg, jpeg, png, gif.</p>
                                </div>
                                <?=flash_error('errorEdit', 'avatar')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Họ: <b style="color: red;">*</b></label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                           placeholder="Nhập họ" name="lastName" value="<?php echo $account['ho']; ?>">
                                </div>
                                <?=flash_error('errorEdit', 'lastName')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên: <b style="color: red;">*</b></label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                           placeholder="Nhập tên" name="firstName" value="<?php echo $account['ten']; ?>">
                                </div>
                                <?=flash_error('errorEdit', 'firstName')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email: <b style="color: red;">*</b></label>
                                    <input type="email" class="form-control" id="exampleInputPassword1"
                                           placeholder="Nhập email" name="email" value="<?php echo $account['email']; ?>">
                                </div>
                                <?=flash_error('errorEdit', 'email')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại:</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                           placeholder="Nhập số điện thoại" name="phone"
                                           value="<?php echo $account['so_dt']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Quyền hạn:</label>
                                    <div class="col-md-12">
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
                                <?=flash_error('errorEdit', 'role')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái:</label>
                                    <div class="col-md-12">
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
                                <?=flash_error('errorEdit', 'status')?>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type='submit' class='btn btn-warning' name='save'><i class='fa fa-save'></i> Lưu lại</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

<?php
require_once('views/layouts/footer.php');
?>