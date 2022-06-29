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
                        <input type="hidden" name="idRoom">
                        Bạn có thực sự muốn xóa loại nhân viên này?
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
                Phòng ban
            </h1>
            <ol class="breadcrumb">
                <li><a href="home"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
                <li><a href="nhan-vien/loai">Loại nhân viên</a></li>
                <li class="active">Tạo loại nhân viên</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tạo loại nhân viên</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <?php flash('success_message'); ?>
                            <?php flash('error_message'); ?>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mã loại nhân viên: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="typeCode" value="<?= generateCode('type')?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên loại nhân viên: </label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên loại" name="name" value="<?= isset($post['name']) ? $post['name'] : ''?>">
                                        </div>
                                        <?=flash_error('errorCreate', 'name')?>
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
                                            <input type="text" class="form-control" id="exampleInputEmail1" value="<?= date('d-m-Y H:i:s'); ?>" name="dateCreate" readonly>
                                        </div>
                                        <button type='submit' class='btn btn-primary' name='save'><i class='fa fa-plus'></i> Tạo phòng ban</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách loại nhân viên</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã loại</th>
                                        <th>Tên loại</th>
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
                                    foreach ($types as $type)
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $count; ?></td>
                                            <td><?= $type['ma_loai_nv']; ?></td>
                                            <td><?= $type['ten_loai_nv']; ?></td>
                                            <td><?= $type['ghi_chu']; ?></td>
                                            <td><?= getInsertedName($type['nguoi_tao']) ?></td>
                                            <td><?= $type['ngay_tao']; ?></td>
                                            <td><?= getInsertedName($type['nguoi_sua']) ?></td>
                                            <td><?= $type['ngay_sua']; ?></td>
                                            <th>
                                                <a href="/nhan-vien/loai/<?=$type['id']?>" class='btn bg-orange btn-flat'><i class='fa fa-edit'></i></a>
                                            </th>
                                            <th>
                                                <button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever="/nhan-vien/xoa-loai/<?=$type['id']?>"><i class='fa fa-trash'></i></button>
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