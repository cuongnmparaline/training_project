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
                <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
                <li><a href="tao-tai-khoan.php?p=account&a=add-account">Tài khoản</a></li>
                <li class="active">Tạo mới tài khoản</li>
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
                                <?=flash_error('errorCreate', 'avatar')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Họ: <b style="color: red;">*</b></label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nhập họ" name="lastName" value="<?= isset($post['lastName']) ? $post['lastName'] : ''?>">
                                </div>
                                <?=flash_error('errorCreate', 'lastName')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tên: <b style="color: red;">*</b></label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nhập tên" name="firstName" value="<?= isset($post['firstName']) ? $post['firstName'] : ''?>">
                                </div>
                                <?=flash_error('errorCreate', 'firstName')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email: <b style="color: red;">*</b></label>
                                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Nhập email" name="email" value="<?= isset($post['email']) ? $post['email'] : ''?>">
                                </div>
                                <?=flash_error('errorCreate', 'email')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mật khẩu: <b style="color: red;">*</b></label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nhập mật khẩu" name="password">
                                </div>
                                <?=flash_error('errorCreate', 'password')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhập lại mật khẩu: <b style="color: red;">*</b></label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nhập lại mật khẩu" name="password_verify">
                                </div>
                                <?=flash_error('errorCreate', 'passwordVerify')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại:</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nhập số điện thoại" name="phone" value="<?= isset($post['phone']) ? $post['phone'] : ''?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Quyền hạn:</label>
                                    <div class="col-md-12">
                                        <label>
                                            <input type="radio" name="role" class="minimal" value="1" checked>
                                            Quản trị viên
                                        </label>
                                        <label>
                                            <input type="radio" name="role" class="minimal" value="0" <?= isset($post['role']) && $post['role'] == '0' ? 'checked' : ''?>>
                                            Nhân viên
                                        </label>
                                    </div>
                                </div>
                                <?=flash_error('errorCreate', 'role')?>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái:</label>
                                    <div class="col-md-12">
                                        <label>
                                            <input type="radio" name="status" class="minimal" value="1" checked>
                                            Đang hoạt động
                                        </label>
                                        <label>
                                            <input type="radio" name="status" class="minimal" value="0" <?= isset($post['status']) && $post['status'] == '0' ? 'checked' : ''?>>
                                            Ngừng hoạt động
                                        </label>
                                    </div>
                                </div>
                                <?=flash_error('errorCreate', 'status')?>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type='submit' class='btn btn-primary' name='save'><i class='fa fa-plus'></i> Tạo tài khoản mới</button>
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