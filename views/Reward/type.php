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
                    <input type="hidden" name="id">
                    Bạn có thực sự muốn xóa loại khen thưởng này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <a href="" class="btn btn-primary deleteButton">Xóa</a>
                </div>
            </form>
        </div>
    </div>
</div>
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
                        <h3 class="box-title">Tạo loại khen thưởng</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <a href="" class="btn btn-primary deleteButton">Xóa</a>
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
                                        <label for="exampleInputEmail1">Mã loại: </label>
                                        <input type="text" class="form-control" name="rewardTypeCode" value="<?=generateCode('rewardType')?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên loại<span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên loại" name="name">
                                    </div>
                                    <?=flash_error('errorCreate', 'name')?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả: </label>
                                        <textarea id="editor1" rows="10" cols="80" name="description"><?= isset($post['description']) ? $post['description'] : ''?>
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
                                    <button type='submit' class='btn btn-primary' name='taoLoai'><i class='fa fa-plus'></i> Tạo loại khen thưởng</button>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </form>
                    </div>
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
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $type['ma_loai']; ?></td>
                                    <td><?php echo $type['ten_loai']; ?></td>
                                    <td><?php echo $type['ghi_chu']; ?></td>
                                    <td><?php echo getInsertedName($type['nguoi_tao']); ?></td>
                                    <td><?php echo $type['ngay_tao']; ?></td>
                                    <td><?php echo getInsertedName($type['nguoi_sua']) ; ?></td>
                                    <td><?php echo $type['ngay_sua']; ?></td>
                                    <th>
                                        <a href="khen-thuong/sua-loai/<?=$type['id']?>" class='btn bg-orange btn-flat'><i class='fa fa-edit'></i></a>
                                    </th>
                                    <th>
                                        <button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever="khen-thuong/xoa-loai/<?=$type['id']?>"><i class='fa fa-trash'></i></button>
                                    </th>
                                </tr>
                                <?php
                                $count++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <?php
    require_once('function.php');
    ?>
</div>

<?php
require_once('views/layouts/footer.php');
?>
