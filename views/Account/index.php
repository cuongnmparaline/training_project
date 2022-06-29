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
                        <input type="hidden" name="idAccount">
                        Bạn có thực sự muốn xóa tài khoản này?
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
                Tài khoản
            </h1>
            <ol class="breadcrumb">
                <li><a href=""><i class="fa fa-dashboard"></i> Tổng quan</a></li>
                <li><a href="tai-khoan">Tài khoản</a></li>
                <li class="active">Danh sách tài khoản</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách tài khoản</h3>
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
                                        <th>Ảnh</th>
                                        <th>Họ</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Truy cập</th>
                                        <th>Điện thoại</th>
                                        <th>Quyền hạn</th>
                                        <th>Trạng thái</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($accounts as $account)
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><img src="<?= !empty($account['hinh_anh']) ? IMG_LOCATION . 'account/' . $account['hinh_anh'] : IMG_ACCOUNT_DEFAULT ?>" width="80"></td>
                                            <td><?php echo $account['ho']; ?></td>
                                            <td><?php echo $account['ten']; ?></td>
                                            <td><?php echo $account['email']; ?></td>
                                            <td><?php echo number_format($account['truy_cap']); ?></td>
                                            <td><?php echo $account['so_dt']; ?></td>
                                            <th>
                                                <?= setRole($account['quyen'])
                                                ?>
                                            </th>
                                            <th>
                                                <?= setAccountStatus($account['trang_thai']) ?>
                                            </th>
                                            <th>
                                                <a href="tai-khoan/sua/<?=$account['id']?>" class='btn bg-orange btn-flat'><i class='fa fa-edit'></i></a>
                                            </th>
                                            <th>
                                                <button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever="tai-khoan/xoa/<?=$account['id']?>"><i class='fa fa-trash'></i></button>
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