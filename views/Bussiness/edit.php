<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Công tác
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
            <li><a href="cong-tac.php?p=collaborate&a=add-collaborate">Công tác</a></li>
            <li class="active">Thêm công tác</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm công tác</h3>
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
                                        <label for="exampleInputEmail1">Mã công tác: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="maCongTac" value="<?php echo $bussiness['ma_cong_tac']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nhân viên: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="maNhanVien" value="<?php echo $bussiness['employee']['ma_nv']; ?> - <?php echo $bussiness['employee']['ten_nv']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày bắt đầu<span style="color: red;">*</span>: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" name="ngayBatDau" value="<?php echo date_format(date_create($bussiness['ngay_bat_dau']), 'Y-m-d'); ?>">
                                        <small style="color: red;"><?php if(isset($error['loiNgay'])){ echo 'Ngày bắt đầu <b> không được sau </b> ngày kết thúc';} ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày kết thúc<span style="color: red;">*</span>: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" name="ngayKetThuc" value="<?php echo date_format(date_create($bussiness['ngay_ket_thuc']), 'Y-m-d'); ?>">
                                        <small style="color: red;"><?php if(isset($error['ngayKetThuc'])){ echo 'Vui lòng chọn ngày kết thúc';} ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Địa điểm công tác<span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="diaDiem" placeholder="Vui lòng nhập địa điểm" value="<?php echo $bussiness['dia_diem']; ?>">
                                        <small style="color: red;"><?php if(isset($error['diaDiem'])){ echo 'Vui lòng nhập địa điểm công tác';} ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mục đích công tác: </label>
                                        <textarea id="editor1" rows="10" cols="80" name="mucDich"><?php echo $bussiness['muc_dich']; ?>
                      </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ghi chú: </label>
                                        <textarea id="editor" class="form-control" name="ghiChu"></textarea><?php echo $bussiness['ghi_chu']; ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Người tạo: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?=getInsertedName($bussiness['nguoi_tao'])?>" name="nguoiTao" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày tạo: </label>
                                        <input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="ngayTao" readonly>
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
