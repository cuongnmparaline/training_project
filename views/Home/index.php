<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tổng quan
                <small>Bài tập lớn | Quản lý nhân sự tại công ty TNHH Paraline</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
                <li class="active">Thống kê</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?= $statistical['totalEmployee'] ?></h3>

                            <p>Nhân viên</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="danh-sach-nhan-vien.php?p=staff&a=list-staff" class="small-box-footer">Danh sách nhân
                            viên <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3><?= $statistical['totalDepartment'] ?></h3>

                            <p>Phòng ban</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-bank"></i>
                        </div>
                        <a href="phong-ban.php?p=staff&a=room" class="small-box-footer">Danh sách phòng ban <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= $statistical['totalAccount'] ?></h3>

                            <p>Tài khoản người dùng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="ds-tai-khoan.php?p=account&a=list-account" class="small-box-footer">Danh sách tài khoản
                            <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?= $statistical['totalRetiredEmployee'] ?></h3>
                            <p>Nhân viên nghỉ việc</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer" onclick="return false;">Danh sách nghỉ việc <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>EXCEL</h3>
                            <p>Xuất báo cáo</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file"></i>
                        </div>
                        <a href="export-nhan-vien.php" class="small-box-footer">Danh sách nhân viên <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>EXCEL</h3>
                            <p>Xuất báo cáo</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file"></i>
                        </div>
                        <a href="export-bang-luong.php" class="small-box-footer">Lương nhân viên <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách phòng ban</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã Phòng</th>
                                        <th>Tên phòng</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($departments as $department) {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $department['ma_phong_ban']; ?></td>
                                            <td><?php echo $department['ten_phong_ban']; ?></td>
                                            <td><?php echo $department['ngay_tao']; ?></td>
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
                <!-- col-lg-6 -->
                <div class="col-lg-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách chức vụ</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã chức vụ</th>
                                        <th>Tên chức vụ</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($positions as $position) {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $position['ma_chuc_vu']; ?></td>
                                            <td><?php echo $position['ten_chuc_vu']; ?></td>
                                            <td><?php echo $position['ngay_tao']; ?></td>
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
                <!-- col-lg-6 -->
                <div class="col-lg-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách lương
                                tháng: <?= date_format(date_create(date("Y-m-d H:i:s")), "m/Y") ?></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example4" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã nhân viên</th>
                                        <th>Ảnh</th>
                                        <th>Tên nhân viên</th>
                                        <th>Giới tính</th>
                                        <th>Lương tháng</th>
                                        <th>Ngày công</th>
                                        <th>Khoản nộp</th>
                                        <th>Thực lãnh</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($monthlySalary as $salary) {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $salary['ma_luong']; ?></td>
                                            <td><img src="<?= IMG_LOCATION . '/employee/' . $salary['hinh_anh']; ?>"
                                                     width="80"></td>
                                            <td><?php echo $salary['ten_nv']; ?></td>
                                            <td>
                                                <?= setGender($salary['gioi_tinh'])
                                                ?>
                                            </td>
                                            <td><?php echo number_format($salary['luong_thang']) . "vnđ"; ?></td>
                                            <td><?php echo $salary['ngay_cong']; ?></td>
                                            <td><?php echo "<span style='color: red; font-weight: bold;'>" . number_format($salary['khoan_nop']) . "vnđ </span>"; ?></td>
                                            <td><?php echo "<span style='color: blue; font-weight: bold;'>" . number_format($salary['thuc_lanh']) . "vnđ </span>"; ?></td>
                                            <td>
                                                <?php
                                                if ($salary['trang_thai'] == 1) {
                                                    echo '<span class="badge bg-blue"> Đang làm việc </span>';
                                                } else {
                                                    echo '<span class="badge bg-red"> Đã nghỉ việc </span>';
                                                }
                                                ?>
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
                <!-- col-lg-12 -->
            </div>
            <!-- /.row (main row) -->
        </section>
        <!-- /.content -->
    </div>

<?php
require_once('views/layouts/footer.php');
?>