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
                    Bạn có thực sự muốn xóa công tác này?
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
            Công tác
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
            <li><a href="danh-sach-cong-tac.php?p=collaborate&a=list-collaborate">Công tác</a></li>
            <li class="active">Danh sách công tác</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách công tác</h3>
                    </div>
                    <?php flash('success_message'); ?>
                    <?php flash('error_message'); ?>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã nhân viên</th>
                                    <th>Tên nhân viên</th>
                                    <th>Chức vụ</th>
                                    <th>Ngày bắt đầu</th>
                                    <th>Ngày kết thúc</th>
                                    <th>Địa điểm</th>
                                    <th>Mục đích</th>
                                    <th>Trạng thái</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $count = 1;
                                foreach ($bussinesses as $bussiness)
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $bussiness['ma_cong_tac']; ?></td>
                                        <td><?php echo getEmployeeNameById($bussiness['nhanvien_id']); ?></td>
                                        <td><?php echo getEmployeePositionById($bussiness['nhanvien_id']) ?></td>
                                        <td><?php echo date_format(date_create($bussiness['ngay_bat_dau']), 'd-m-Y'); ?></td>
                                        <td><?php echo date_format(date_create($bussiness['ngay_ket_thuc']), 'd-m-Y'); ?></td>
                                        <td><?php echo $bussiness['dia_diem']; ?></td>
                                        <td><?php echo $bussiness['muc_dich']; ?></td>
                                        <?= getBussinessStatus($bussiness['ngay_bat_dau'], $bussiness['ngay_ket_thuc']); ?>
                                        <td>
                                            <a href="cong-tac/<?=$bussiness['id']?>" class='btn bg-orange btn-flat'><i class='fa fa-edit'></i></a>
                                        </td>
                                        <td>
                                            <button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever="/cong-tac/xoa-cong-tac/<?=$bussiness['id']?>"><i class='fa fa-trash'></i></button>
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
