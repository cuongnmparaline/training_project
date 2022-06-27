<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <span style="font-size: 18px;">Thông báo</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="maNhom">
                        Bạn có thực sự muốn xóa nhân viên này ra khỏi nhóm?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                        <a href="" class="btn btn-primary deleteButton">Xóa</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Quản lý nhóm
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
                <li><a href="danh-sach-nhom.php?p=group&a=list-group">Danh sách nhóm</a></li>
                <li class="active">Quản lý nhóm</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Thao tác nhóm</h3>
                        </div>
                        <?php flash('success_message'); ?>
                        <?php flash('error_message'); ?>
                        <div class="box-body">
                            <a  href="nhom/chi-tiet-nhom/<?=$team['id']?>/sua" class="btn btn-app">
                                <i class="fa fa-edit"></i> Chỉnh sửa nhóm
                            </a>
                            <a href="nhom/chi-tiet-nhom/<?=$team['id']?>/them-nhan-vien" class="btn btn-app">
                                <i class="fa fa-plus"></i> Thêm nhân viên
                            </a>
                            <a  href="nhom/chi-tiet-nhom/<?=$team['id']?>" class="btn btn-app">
                                <i class="fa fa-close"></i> Hủy bỏ
                            </a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <?php
                            if(isset($isEdit) && $isEdit==true){
                                ?>
                                <div class="box-header with-border">
                                    <h3 class="box-title">Chỉnh sửa thông tin nhóm</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form action="" method="POST">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Mã nhóm: </label>
                                                    <input type="text" class="form-control" name="teamCode" value="<?= $team['ma_nhom']?>" readonly>
                                                    <input type="hidden" class="form-control" name="id" value="<?= $team['id']?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tên nhóm <span style="color: red;">*</span>: </label>
                                                    <input type="text" class="form-control" placeholder="Nhập tên nhóm" name="name" value="<?php echo $team['ten_nhom']; ?>">
                                                </div>
                                                <?=flash_error('errorCreate', 'name')?>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Mô tả: </label>
                                                    <textarea id="editor1" rows="10" cols="80" name="description"><?php echo $team['mo_ta']; ?>
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
                                                <button type='submit' class='btn btn-warning' name="btn-edit"><i class='fa fa-save'></i>Lưu lại thông tin</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </form>
                                </div>
                                <?php
                            }
                        ?>
                        <?php
                        if(isset($isAddEmployee) && $isAddEmployee==true){
                            ?>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Thêm nhân viên vào nhóm</h3>
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
                                                    <label for="exampleInputEmail1">Mã nhóm: </label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" name="teamCode" value="<?= $team['ma_nhom']?>" readonly>
                                                    <input type="hidden" class="form-control" name="id" value="<?= $team['id']?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Chọn nhân viên: </label>
                                                    <select class="form-control" name="employee">
                                                        <option value="">--- Chọn nhân viên ---</option>
                                                        <?php
                                                        foreach ($allEmployee as $employee) { ?>
                                                            <option <?= (isset($post['employee']) && $post['employee'] == $employee['id']) ? "selected='selected'" : ''?> value="<?= $employee['id'] ?>"><?=$employee['ma_nv'] . ' - ' . $employee['ten_nv'] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <?=flash_error('errorCreate', 'employee')?>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Người thêm: </label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?=getFullName($accountInfo['ho'], $accountInfo['ten'])?>" name="nguoiTao" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Ngày thêm: </label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo date('d-m-Y H:i:s'); ?>" name="ngayTao" readonly>
                                                </div>
                                                <!-- /.form-group -->
                                                <button type='submit' class='btn btn-primary' name='btn-add'><i class='fa fa-plus'></i> Thêm nhân viên</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </form>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <?php
                        }
                        ?>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <?php
                    require_once('listEmployee.php');
                    ?>
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