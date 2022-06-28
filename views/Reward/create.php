<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Khen thưởng
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
            <li><a href="khen-thuong">Khen thưởng</a></li>
            <li class="active">Khen thưởng nhân viên</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php
                require_once('function.php');
                ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tạo khen thưởng</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mã khen thưởng: </label>
                                        <input type="text" class="form-control" name="rewardCode" value="<?=generateCode('reward') ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số quyết định <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số quyết định" name="decisionNumber" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày quyết định: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên loại" value="<?php echo date('Y-m-d'); ?>" name="decisionDay">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên khen thưởng <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khen thưởng" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Chọn nhân viên: </label>
                                        <select class="form-control" name="employee">
                                            <option value="chon">--- Chọn nhân viên ---</option>
                                            <?php
                                            foreach($employees as $employee)
                                            { ?>
                                                <option <?= (isset($post['employee']) && $post['employee'] == $employee['id']) ? "selected='selected'" : ''?> value="<?= $employee['id'] ?>"><?=$employee['ma_nv'] . ' - ' . $employee['ten_nv'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Loại khen thưởng: </label>
                                        <select class="form-control" name="rewardType">
                                            <option value="">--- Chọn khen thưởng ---</option>
                                            <?php
                                            foreach($rewards as $reward)
                                            { ?>
                                                <option <?= (isset($post['employee']) && $post['employee'] == $reward['id']) ? "selected='selected'" : ''?> value="<?= $reward['id'] ?>"><?=$reward['ma_kt'] . ' - ' . $reward['ten_khen_thuong'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình thức: </label>
                                        <select class="form-control" name="form">
                                            <option value="chon">--- Chọn hình thức ---</option>
                                            <option value="1">Chuyển khoản qua thẻ</option>
                                            <option value="0">Gửi tiền mặt</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số tiền thưởng <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số tiền thưởng" name="rewardNumber" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả: </label>
                                        <textarea class="form-control" id="editor1" name="description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Người tạo: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?=getFullName($accountInfo['ho'], $accountInfo['ten'])?>" name="nguoiTao" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày tạo: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo date('d-m-Y H:i:s'); ?>" name="ngayTao" readonly>
                                    </div>
                                    <!-- /.form-group -->
                                    <button type='submit' class='btn btn-primary' name='taoKhenThuong'><i class='fa fa-plus'></i> Tạo khen thưởng</button>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require_once('views/layouts/footer.php');
?>
