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
                foreach ($employees as $employee)
                {
                    ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $employee['ma_nv']; ?></td>
                        <td><img src="<?= !empty($employee['hinh_anh']) ? IMG_LOCATION . 'employee/' . $employee['hinh_anh'] : IMG_EMPLOYEE_DEFAULT ?>" width="80"></td>
                        <td><?php echo $employee['ten_nv']; ?></td>
                        <td>
                            <?= setGender($employee['gioi_tinh']) ?>
                        </td>
                        <td>
                            <?php
                            $date = date_create($employee['ngay_sinh']);
                            echo date_format($date, 'd-m-Y');
                            ?>
                        </td>
                        <td><?=getPosition($employee['chuc_vu_id'])?></td>
                        <td><?=getDepartment($employee['phong_ban_id'])?></td>
                        <td>
                            <?php
                            $ngayThem = date_create($employee['ngay_tao']);
                            echo date_format($ngayThem, 'd-m-Y');
                            ?>
                        </td>
                        <td>
                            <?= setEmployeeStatus($employee['trang_thai'])?>
                        </td>
                        <th>
                            <button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever="/nhom/chi-tiet-nhom/xoa-nhan-vien/<?=$employee['teamDetailId'].'/'.$team['id']?>"><i class='fa fa-trash'></i></button>
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