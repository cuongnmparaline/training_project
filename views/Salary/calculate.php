<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tính lương
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
                <li><a href="tinh-luong.php?p=salary&a=salary">Tính lương</a></li>
                <li class="active">Tính lương nhân viên</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tính lương nhân viên</h3>
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
                                            <label for="exampleInputEmail1">Mã lương: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="salaryCode" value="<?=generateCode('salary')?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nhân viên<span style="color: red;">*</span>: </label>
                                            <select class="form-control" name="employee" id="idNhanVien">
                                                <option value="">--- Chọn nhân viên ---</option>
                                                <?php
                                                foreach ($employees as $employee) { ?>
                                                    <option <?= (isset($post['employee']) && $post['employee'] == $employee['id']) ? "selected='selected'" : ''?> value="<?= $employee['id'] ?>"><?=$employee['ma_nv'] . ' - ' . $employee['ten_nv'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <?=flash_error('errorCreate', 'employee')?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Số ngày công<span style="color: red;">*</span> : </label>
                                            <input type="number" class="form-control" placeholder="Nhập số ngày công" name="workingDay" value="" id="soNgayCong">
                                        </div>
                                        <?=flash_error('errorCreate', 'workingDay')?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phụ cấp (Phụ cấp chức vụ, xăng xe, ăn trưa,...): </label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" placeholder="Chọn 'tính phụ cấp' để biết số tiền phụ cấp" name="allowance" id="phuCap">
                                                </div>
                                                <div class="col-md-8">
                                                    <button type="button" class="btn btn-primary btn-flat" id="tinhPhuCap"><i class="fa fa-calculator"></i> Tính phụ cấp</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Số giờ làm thêm: </label>
                                            <input type="number" class="form-control" placeholder="Nhập số giờ làm thêm" name="overtime" value="" id="overtime">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tạm ứng: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="advance" placeholder="Nhập số tiền muốn tạm ứng" value="0">
                                        </div>
                                        <?=flash_error('errorCreate', 'advance')?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ngày tính lương: </label>
                                            <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Nhập số tiền phụ cấp" name="calculateTime" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mô tả: </label>
                                            <textarea id="editor1" rows="10" cols="80" name="description" class="ckeditor">
                      </textarea>
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
                                        <button type='submit' class='btn btn-primary' name='tinhLuong'><i class='fa fa-money'></i> Tính lương nhân viên</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
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