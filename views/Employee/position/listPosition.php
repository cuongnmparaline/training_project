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
                        <input type="hidden" name="idPosition">
                        Bạn có thực sự muốn xóa chức vụ này?
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
                Chức vụ
            </h1>
            <ol class="breadcrumb">
                <li><a href="home"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
                <li><a href="nhan-vien/chuc-vu">Chức vụ</a></li>
                <li class="active">Thêm chức vụ</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Thêm chức vụ</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php flash('success_message'); ?>
                            <?php flash('error_message'); ?>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mã chức vụ: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="positionCode" value="<?= generateCode('position') ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên chức vụ: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên chức vụ" name="name" value="<?= isset($post['name']) ? $post['name'] : ''?>">
                                        </div>
                                        <?=flash_error('errorCreate', 'name')?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Lương ngày: </label>
                                            <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Nhập lương/ngày" name="salary" value="<?= isset($post['salary']) ? $post['salary'] : ''?>">
                                        </div>
                                        <?=flash_error('errorCreate', 'salary')?>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mô tả: </label>
                                            <textarea id="editor1" rows="10" cols="80" name="description">
                                                <?= isset($post['description']) ? $post['description'] : ''?>
                                        </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Người tạo: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?=getFullName($accountInfo['ho'], $accountInfo['ten'])?>" name="personCreate" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ngày tạo: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo date('d-m-Y H:i:s'); ?>" name="dateCreate" readonly>
                                        </div>
                                        <!-- /.form-group -->
                                        <button type='submit' class='btn btn-primary' name='save'><i class='fa fa-plus'></i> Thêm trình độ</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách chức vụ</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã chức vụ</th>
                                        <th>Tên chức vụ</th>
                                        <th>Lương ngày</th>
                                        <th>Mô tả</th>
                                        <th>Người tạo</th>
                                        <th>Ngày tạo</th>
                                        <th>Người sửa</th>
                                        <th>Ngày sửa</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($positions as $position)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $position['ma_chuc_vu']; ?></td>
                                            <td><?php echo $position['ten_chuc_vu']; ?></td>
                                            <td><?php echo number_format($position['luong_ngay']). "vnđ"; ?></td>
                                            <td><?php echo $position['ghi_chu']; ?></td>
                                            <td><?php echo getInsertedName($position['nguoi_tao']) ?></td>
                                            <td><?php echo $position['ngay_tao']; ?></td>
                                            <td><?php echo getInsertedName($position['nguoi_sua']); ?></td>
                                            <td><?php echo $position['ngay_sua']; ?></td>
                                            <th>
                                                <a href="/nhan-vien/chuc-vu/<?=$position['id']?>" class='btn bg-orange btn-flat'><i class='fa fa-edit'></i></a>
                                            </th>
                                            <th>
                                                <button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever="/nhan-vien/xoa-chuc-vu/<?=$position['id']?>"><i class='fa fa-trash'></i></button>
                                            </th>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
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