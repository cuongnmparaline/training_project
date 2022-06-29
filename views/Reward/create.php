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
                    Bạn có thực sự muốn xóa khen thưởng này?
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
                        <h3 class="box-title">Tạo khen thưởng</h3>
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
                                        <label for="exampleInputEmail1">Mã khen thưởng: </label>
                                        <input type="text" class="form-control" name="rewardCode" value="<?=generateCode('reward') ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số quyết định <span style="color: red;">*</span>: </label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Nhập số quyết định" name="decisionNumber" value="">
                                    </div>
                                    <?=flash_error('errorCreate', 'decisionNumber')?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ngày quyết định <span style="color: red;">*</span>: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên loại" value="<?php echo date('Y-m-d'); ?>" name="decisionDay">
                                    </div>
                                    <?=flash_error('errorCreate', 'decisionDay')?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên khen thưởng <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên khen thưởng" name="name">
                                    </div>
                                    <?=flash_error('errorCreate', 'name')?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Chọn nhân viên <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="employee">
                                            <option value="">--- Chọn nhân viên ---</option>
                                            <?php
                                            foreach($employees as $employee)
                                            { ?>
                                                <option <?= (isset($post['employee']) && $post['employee'] == $employee['id']) ? "selected='selected'" : ''?> value="<?= $employee['id'] ?>"><?=$employee['ma_nv'] . ' - ' . $employee['ten_nv'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorCreate', 'employee')?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Loại khen thưởng<span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="rewardType">
                                            <option value="">--- Chọn khen thưởng ---</option>
                                            <?php
                                            foreach($rewardTypes as $rewardType)
                                            { ?>
                                                <option <?= (isset($post['employee']) && $post['employee'] == $rewardType['id']) ? "selected='selected'" : ''?> value="<?= $rewardType['id'] ?>"><?=$rewardType['ma_loai'] . ' - ' . $rewardType['ten_loai'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorCreate', 'rewardType')?>
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
                                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Nhập số tiền thưởng" name="rewardNumber" value="">
                                    </div>
                                    <?=flash_error('errorCreate', 'rewardNumber')?>
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
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách khen thưởng</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã khen thưởng</th>
                                        <th>Tên khen thưởng</th>
                                        <th>Tên nhân viên</th>
                                        <th>Số quyết định</th>
                                        <th>Ngày quyết định</th>
                                        <th>Tên loại</th>
                                        <th>Hình thức</th>
                                        <th>Số tiền</th>
                                        <th>Ngày khen thưởng</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($rewards as $reward)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $reward['ma_kt']; ?></td>
                                            <td><?php echo $reward['ten_khen_thuong']; ?></td>
                                            <td><?php echo getEmployeeInfo($reward['nhanvien_id'])['ten_nv'] ?></td>
                                            <td><?php echo $reward['so_qd']; ?></td>
                                            <td><?php echo date_format(date_create($reward['ngay_qd']), "d-m-Y"); ?></td>
                                            <td><?php echo getRewardTypeInfo($reward['loai_kt_id'])['ten_loai']; ?></td>
                                            <td>
                                                <?php
                                                if($reward['hinh_thuc'] == 1)
                                                {
                                                    echo "Chuyển khoản qua thẻ";
                                                }
                                                else
                                                {
                                                    echo "Gửi tiền mặt";
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo "<span style='color: blue; font-weight: bold;'>". number_format($reward['so_tien'])."vnđ </span>"; ?></td>
                                            <td><?php echo date_format(date_create($reward['ngay_qd']), "d-m-Y"); ?></td>
                                            <th>
                                                <a href="khen-thuong/<?=$reward['id']?>" class='btn bg-orange btn-flat'><i class='fa fa-edit'></i></a>
                                            </th>
                                            <th>
                                                <button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever="khen-thuong/xoa/<?=$reward['id']?>"><i class='fa fa-trash'></i></button>
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
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require_once('views/layouts/footer.php');
?>
