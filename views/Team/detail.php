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
                        <div class="box-body">
                            <a  href="" class="btn btn-app">
                                <i class="fa fa-edit"></i> Chỉnh sửa nhóm
                            </a>
                            <a href="" class="btn btn-app">
                                <i class="fa fa-plus"></i> Thêm nhân viên
                            </a>
                            <a  href="" class="btn btn-app">
                                <i class="fa fa-close"></i> Hủy bỏ
                            </a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Nhân viên trong nhóm</h3>
                        </div>
                        <!-- /.box-header -->
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
                                        <th>Năm sinh</th>
                                        <th>Chức vụ</th>
                                        <th>Phòng ban</th>
                                        <th>Ngày thêm</th>
                                        <th>Trạng thái</th>
                                        <th>Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($arrNV as $nv)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $nv['ma_nv']; ?></td>
                                            <td><img src="../uploads/staffs/<?php echo $nv['hinh_anh']; ?>" width="80"></td>
                                            <td><?php echo $nv['ten_nv']; ?></td>
                                            <td>
                                                <?php
                                                if($nv['gioi_tinh'] == 1)
                                                {
                                                    echo "Nam";
                                                }
                                                else
                                                {
                                                    echo "Nữ";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $date = date_create($nv['ngay_sinh']);
                                                echo date_format($date, 'd-m-Y');
                                                ?>
                                            </td>
                                            <td><?php echo $nv['ten_chuc_vu']; ?></td>
                                            <td><?php echo $nv['ten_phong_ban']; ?></td>
                                            <td>
                                                <?php
                                                $ngayThem = date_create($nv['ngay_tao']);
                                                echo date_format($ngayThem, 'd-m-Y');
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($nv['trang_thai'] == 1)
                                                {
                                                    echo '<span class="badge bg-blue"> Đang làm việc </span>';
                                                }
                                                else
                                                {
                                                    echo '<span class="badge bg-red"> Đã nghỉ việc </span>';
                                                }
                                                ?>
                                            </td>
                                            <th>
                                                <?php
                                                if($row_acc['quyen'] == 1)
                                                {
                                                    echo "<button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever='".$nv['id']."'><i class='fa fa-trash'></i></button>";
                                                }
                                                else
                                                {
                                                    echo "<button type='button' class='btn bg-maroon btn-flat' disabled><i class='fa fa-trash'></i></button>";
                                                }
                                                ?>
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