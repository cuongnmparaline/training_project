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
                        <input type="hidden" name="maLuong">
                        Bạn có thực sự muốn xóa record lương này?
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
                Tính lương nhân viên
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
                <li><a href="bang-luong.php?p=salary&a=salary">Bảng lương</a></li>
                <li class="active">Tính lương nhân viên</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>SAL</h3>
                            <p>Tính lương</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money"></i>
                        </div>
                        <a href="tinh-luong.php?p=salary&a=salary" class="small-box-footer">
                            Nhấn vào để tính lương <i class="fa fa-arrow-circle-right"></i>
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
                        <a href="export-bang-luong.php" class="small-box-footer">
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
                            <h3 class="box-title">Bảng lương</h3>
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
                                        <th>Mã lương</th>
                                        <th>Tên nhân viên</th>
                                        <th>Chức vụ</th>
                                        <th>Lương tháng</th>
                                        <th>Ngày công</th>
                                        <th>Thực lãnh</th>
                                        <th>Ngày chấm</th>
                                        <th>Chi tiết</th>
                                        <th>Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($salaries as $salary)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $salary['ma_luong']; ?></td>
                                            <td><?php echo $salary['ten_nv']; ?></td>
                                            <td><?php echo $salary['ten_chuc_vu']; ?></td>
                                            <td><?php echo number_format($salary['luong_thang'])."vnđ"; ?></td>
                                            <td class="text-center"><?php echo $salary['ngay_cong']; ?></td>
                                            <td style="color: blue; font-weight: bold;"><?php echo number_format($salary['thuc_lanh'])."vnđ"; ?></td>
                                            <td class="text-center">
                                                <?php echo date_format(date_create($salary['ngay_cham']), "d-m-Y"); ?>
                                            </td>
                                            <th>
                                                <a href="luong/<?=$salary['nhanvien_id']?>" class='btn btn-primary btn-flat'><i class='fa fa-edit'></i></a>
                                            </th>
                                            <th>
                                                <button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever="/luong/xoa-luong/<?=$salary['id']?>"><i class='fa fa-trash'></i></button>
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