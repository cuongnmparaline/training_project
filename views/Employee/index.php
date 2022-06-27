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
                    <input type="hidden" name="idStaff">
                    Bạn có thực sự muốn xóa nhân viên này?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary" name="delete">Xóa</button>
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
            Nhân viên
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
            <li><a href="danh-sach-nhan-vien.php?p=staff&a=list-staff">Nhân viên</a></li>
            <li class="active">Danh sách nhân viên</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>STA</h3>
                        <p>Thêm nhân viên</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="them-nhan-vien.php?p=staff&a=add-staff" class="small-box-footer">
                        Nhấn vào thêm nhân viên mới <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>EXCEL</h3>
                        <p>Xuất Excel</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file"></i>
                    </div>
                    <a href="export-nhan-vien.php" class="small-box-footer">
                        Nhấn vào xuất file excel <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách nhân viên</h3>
                    </div>
                    <!-- /.box-header -->
                    <?php flash('success_message'); ?>
                    <?php flash('error_message'); ?>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã nhân viên</th>
                                    <th>Ảnh</th>
                                    <th>Tên nhân viên</th>
                                    <th>Giới tính</th>
                                    <th>Ngày sinh</th>
                                    <th>Nơi sinh</th>
                                    <th>Số CMND</th>
                                    <th>Tình trạng</th>
                                    <th>Xem</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($employees as $employee)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $employee['ma_nv']; ?></td>
                                        <td><img src=" <?= !empty($employee['hinh_anh']) ? IMG_LOCATION . 'employee/' . $employee['hinh_anh'] : IMG_EMPLOYEE_DEFAULT ?>" width="80"></td>
                                        <td><?php echo $employee['ten_nv']; ?></td>
                                        <td>
                                            <?=setGender($employee['gioi_tinh'])?>
                                        </td>
                                        <td>
                                            <?php
                                            $date = date_create($employee['ngay_sinh']);
                                            echo date_format($date, 'd-m-Y');
                                            ?>
                                        </td>
                                        <td><?php echo $employee['noi_sinh']; ?></td>
                                        <td><?php echo $employee['so_cmnd']; ?></td>
                                        <td>
                                            <?= setStatus($employee['trang_thai']) ?>
                                        </td>
                                        <td>
                                            <a href="nhan-vien/xem/<?=$employee['id']?>"class='btn btn-primary btn-flat'><i class='fa fa-eye'></i></a>
                                        </td>
                                        <td>
                                            <a href="nhan-vien/<?=$employee['id']?>" class='btn bg-orange btn-flat'><i class='fa fa-edit'></i></a>
                                        </td>
                                        <td>
                                            <button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever="<?=$employee['id']?>"><i class='fa fa-trash'></i></button>
                                        </td>
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
