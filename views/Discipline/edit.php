<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kỷ luật
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
            <li><a href="khen-thuong">Kỷ luật</a></li>
            <li class="active">Kỷ luật nhân viên</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chỉnh sửa kỷ luật</h3>
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
                                        <label for="exampleInputEmail1">Mã kỷ luật: </label>
                                        <input type="text" class="form-control" name="rewardCode" value="<?php echo $discipline['ma_kt']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số quyết định <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số quyết định" name="decisionNumber" value="<?php echo $discipline['so_qd']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày quyết định: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên loại" value="<?php echo date_format(date_create($discipline['ngay_qd']), 'Y-m-d'); ?>" name="decisionDay">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên kỷ luật <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên kỷ luật" name="name" value="<?php echo $discipline['ten_khen_thuong']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Chọn nhân viên: </label>
                                        <select class="form-control" name="employee">
                                            <option value="">--- Chọn nhân viên ---</option>
                                            <?php
                                            foreach($employees as $employee)
                                            { ?>
                                                <option <?= (isset($discipline['nhanvien_id']) && $discipline['nhanvien_id'] == $employee['id']) ? "selected='selected'" : ''?> value="<?= $employee['id'] ?>"><?=$employee['ma_nv'] . ' - ' . $employee['ten_nv'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Loại kỷ luật: </label>
                                        <select class="form-control" name="rewardType">
                                            <option value="">--- Chọn loại kỷ luật ---</option>
                                            <?php
                                            foreach($disciplineTypes as $disciplineType)
                                            { ?>
                                                <option <?= (isset($discipline['loai_kt_id']) && $discipline['loai_kt_id'] == $disciplineType['id']) ? "selected='selected'" : ''?> value="<?= $disciplineType['id'] ?>"><?=$disciplineType['ma_loai'] . ' - ' . $disciplineType['ten_loai'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình thức: </label>
                                        <select class="form-control" name="form">
                                            <option value="chon">--- Chọn hình thức ---</option>
                                            <option <?= isset($discipline['hinh_thuc']) && $discipline['hinh_thuc'] == 1 ? "selected='selected'" : ''?> value="1">Chuyển khoản qua thẻ</option>
                                            <option <?= isset($discipline['hinh_thuc']) && $discipline['hinh_thuc'] == 0 ? "selected='selected'" : ''?> value="0">Gửi tiền mặt</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số tiền thưởng <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số tiền thưởng" name="rewardNumber" value="<?=$discipline['so_tien']?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả: </label>
                                        <textarea class="form-control" id="editor1" name="description"><?=$discipline['ghi_chu']?></textarea>

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
                                    <button type='submit' class='btn btn-warning' name='save'><i class='fa fa-save'></i> Lưu lại</button>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>

<?php
require_once('views/layouts/footer.php');
?>
