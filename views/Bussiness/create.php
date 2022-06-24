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
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="bussinessCode" value="<?php echo generateCode('bussiness') ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Chọn nhân viên<span style="color: red;">*</span> : </label>
                                        <select class="form-control" name="employee">
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
                                        <label for="exampleInputEmail1">Ngày bắt đầu<span style="color: red;">*</span>: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" name="dayStart" value="<?= isset($post['dayStart']) ? $post['dayStart'] : date('Y-m-d')?>">
                                    </div>
                                    <?=flash_error('errorCreate', 'dayStart')?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày kết thúc<span style="color: red;">*</span>: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" name="dayEnd" value="<?= isset($post['dayEnd']) ? $post['dayEnd'] : ''?>">
                                    </div>
                                    <?=flash_error('errorCreate', 'dayEnd')?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Địa điểm công tác<span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="location" placeholder="Vui lòng nhập địa điểm" value="<?= isset($post['location']) ? $post['location'] : ''?>">
                                    </div>
                                    <?=flash_error('errorCreate', 'location')?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mục đích công tác: </label>
                                        <textarea id="editor1" rows="10" cols="80" name="purpose" <?= isset($post['purpose']) ? $post['purpose'] : ''?>>
                                    </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ghi chú: </label>
                                        <textarea id="editor" class="form-control" name="description"><?= isset($post['name']) ? $post['name'] : ''?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Người tạo: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" value="<?=getFullName($accountInfo['ho'], $accountInfo['ten'])?>" name="nguoiTao" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày tạo: </label>
                                        <input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="ngayTao" readonly>
                                    </div>
                                    <!-- /.form-group -->
                                    <button type='submit' class='btn btn-primary' name='save'><i class='fa fa-plus'></i> Thêm công tác</button>
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
