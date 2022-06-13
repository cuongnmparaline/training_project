<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Chức vụ
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
            <li><a href="chuc-vu.php?p=staff&a=position">Chức vụ</a></li>
            <li class="active">Chỉnh sửa chức vụ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chỉnh sửa chức vụ</h3>
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
                                        <label for="exampleInputEmail1">Mã chức vụ: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="positionCode" value="<?= $ma_chuc_vu ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên chức vụ: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên chức vụ" value="<?= $ten_chuc_vu ?>" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Lương ngày: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập lương/ngày" value="<?= $luong_ngay ?>" name="salary">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả: </label>
                                        <textarea id="editor1" rows="10" cols="80" name="description"><?= $ghi_chu ?>
                      </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Người tạo: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?=getInsertedName($nguoi_tao)?>" name="personCreate" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày sửa: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo date('d-m-Y H:i:s'); ?>" name="dateCreate" readonly>
                                    </div>
                                    <!-- /.form-group -->
                                    <button type="submit" class="btn btn-warning" name="save"><i class="fa fa-save"></i> Lưu lại </button>
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
