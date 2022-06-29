<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Chỉnh sửa nhân viên
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
            <li><a href="nhan-vien">Nhân viên</a></li>
            <li class="active">Chỉnh sửa thông tin nhân viên</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Chỉnh sửa thông tin nhân viên</h3> &emsp;
                        <small>Những ô nhập có dấu <span style="color: red;">*</span> là bắt buộc</small>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mã nhân viên: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="employeeCode" value="<?php echo $employee['ma_nv']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên nhân viên <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên nhân viên" name="name" value="<?php echo $employee['ten_nv']; ?>">
                                    </div>
                                    <?=flash_error('errorEdit', 'name')?>
                                    <div class="form-group">
                                        <label>Biệt danh: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập biệt danh" name="nickName" value="<?php echo $employee['biet_danh']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tình trạng hôn nhân <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="marriage">
                                            <option value="">--- Chọn tình trạng hôn nhân ---</option>
                                            <?php
                                            foreach ($marriages as $marriage)
                                            { ?>
                                                <option <?= (isset($employee['hon_nhan_id']) && $employee['hon_nhan_id'] == $marriage['id']) ? "selected='selected'" : ''?> value="<?=$marriage['id']?>"><?=$marriage['ten_tinh_trang']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorEdit', 'marriage')?>
                                    <div class="form-group">
                                        <label>Số CMND <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số CMND" name="identify" value="<?php echo $employee['so_cmnd']; ?>">
                                    </div>
                                    <?=flash_error('errorEdit', 'identify')?>
                                    <div class="form-group">
                                        <label>Ngày cấp <span style="color: red;">*</span>: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Nhập nơi cấp" name="identify_time" value="<?php echo $employee['ngay_cap_cmnd']; ?>">
                                    </div>
                                    <?=flash_error('errorEdit', 'identify_time')?>
                                    <div class="form-group">
                                        <label>Nơi cấp <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập nơi cấp" name="identify_place" value="<?php echo $employee['noi_cap_cmnd']; ?>">
                                    </div>
                                    <?=flash_error('errorEdit', 'identify_place')?>
                                    <div class="form-group">
                                        <label>Quốc tịch <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="nationality">
                                            <option value="">--- Chọn quốc tịch ---</option>
                                            <?php
                                            foreach ($nationalities as $nationality)
                                            { ?>
                                                <option <?= (isset($employee['quoc_tich_id']) && $employee['quoc_tich_id'] == $nationality['id']) ? "selected='selected'" : ''?> value="<?=$nationality['id']?>"><?=$nationality['ten_quoc_tich']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorEdit', 'nationality')?>
                                    <div class="form-group">
                                        <label>Tôn giáo: </label>
                                        <select class="form-control" name="religion">
                                            <?php
                                            foreach ($religions as $religion)
                                            { ?>
                                                <option <?= (isset($employee['ton_giao_id']) && $employee['ton_giao_id'] == $religion['id']) ? "selected='selected'" : ''?> value="<?=$religion['id']?>"><?=$religion['ten_ton_giao']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Dân tộc <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="ethnic">
                                            <option value="">--- Chọn dân tộc ---</option>
                                            <?php
                                            foreach ($ethnics as $ethnic)
                                            { ?>
                                                <option <?= (isset($employee['dan_toc_id']) && $employee['dan_toc_id'] == $ethnic['id']) ? "selected='selected'" : ''?> value="<?=$ethnic['id']?>"><?=$ethnic['ten_dan_toc']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorEdit', 'ethnic')?>
                                    <div class="form-group">
                                        <label>Loại nhân viên <span style="color: red;">*</span> : </label>
                                        <select class="form-control" name="type">
                                            <option value="">--- Chọn loại nhân viên ---</option>
                                            <?php
                                            foreach ($types as $type)
                                            { ?>
                                                <option <?= (isset($employee['loai_nv_id']) && $employee['loai_nv_id'] == $type['id']) ? "selected='selected'" : ''?> value="<?=$type['id']?>"><?=$type['ten_loai_nv']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorEdit', 'type')?>
                                    <div class="form-group">
                                        <label>Bằng cấp: </label>
                                        <select class="form-control" name="degree">
                                            <?php
                                            foreach ($degrees as $degree)
                                            { ?>
                                                <option <?= (isset($employee['bang_cap_id']) && $employee['bang_cap_id'] == $degree['id']) ? "selected='selected'" : ''?> value="<?=$degree['id']?>"><?=$degree['ten_bang_cap']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="status">
                                            <option value="">--- Chọn trạng thái ---</option>
                                            <option <?= (isset($employee['trang_thai']) && $employee['trang_thai'] == 1) ? "selected='selected'" : ''?> value="1">Đang làm việc</option>
                                            <option <?= (isset($employee['trang_thai']) && $employee['trang_thai'] == 0) ? "selected='selected'" : ''?> value="0">Đã nghỉ việc</option>
                                        </select>
                                    </div>
                                    <?=flash_error('errorEdit', 'status')?>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ảnh 3x4 (Nếu có): </label>
                                        <input type="file" class="form-control" id="exampleInputEmail1" name="avatar">
                                    </div>
                                    <?=flash_error('errorEdit', 'avatar')?>
                                    <div class="form-group">
                                        <label>Giới tính <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="gender">
                                            <option value="">--- Chọn giới tính ---</option>
                                            <option <?= (isset($employee['gioi_tinh']) && $employee['gioi_tinh'] == 1) ? "selected='selected'" : ''?> value="1">Nam</option>
                                            <option <?= (isset($employee['gioi_tinh']) && $employee['gioi_tinh'] == 0) ? "selected='selected'" : ''?> value="0">Nữ</option>
                                        </select>
                                    </div>
                                    <?=flash_error('errorEdit', 'gender')?>
                                    <div class="form-group">
                                        <label>Ngày sinh: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" name="birthday" value="<?php echo $employee['ngay_sinh']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Nơi sinh: </label>
                                        <textarea class="form-control" name="placeOfBirth"><?php echo $employee['noi_sinh']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Nguyên quán: </label>
                                        <textarea class="form-control" name="domicile"><?php echo $employee['nguyen_quan']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Hộ khẩu <span style="color: red;">*</span>: </label>
                                        <textarea class="form-control" name="residence"><?php echo $employee['ho_khau']; ?></textarea>
                                    </div>
                                    <?=flash_error('errorEdit', 'residence')?>
                                    <div class="form-group">
                                        <label>Tạm trú: </label>
                                        <textarea class="form-control" name="tabernacle"><?php echo $employee['tam_tru']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Phòng ban <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="department">
                                            <option value="">--- Chọn phòng ban ---</option>
                                            <?php
                                            foreach ($departments as $department)
                                            { ?>
                                                <option <?= (isset($employee['phong_ban_id']) && $employee['phong_ban_id'] == $department['id']) ? "selected='selected'" : ''?> value="<?=$department['id']?>"><?=$department['ten_phong_ban']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorEdit', 'department')?>
                                    <div class="form-group">
                                        <label>Chức vụ <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="position">
                                            <option value="">--- Chọn chức vụ ---</option>
                                            <?php
                                            foreach ($positions as $position)
                                            { ?>
                                                <option <?= (isset($employee['chuc_vu_id']) && $employee['chuc_vu_id'] == $position['id']) ? "selected='selected'" : ''?> value="<?=$position['id']?>"><?=$position['ten_chuc_vu']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorEdit', 'position')?>
                                    <div class="form-group">
                                        <label>Trình độ <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="education">
                                            <option value="">--- Chọn trình độ ---</option>
                                            <?php
                                            foreach ($educations as $education)
                                            { ?>
                                                <option <?= (isset($employee['trinh_do_id']) && $employee['trinh_do_id'] == $education['id']) ? "selected='selected'" : ''?> value="<?=$education['id']?>"><?=$education['ten_trinh_do']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorEdit', 'education')?>
                                    <div class="form-group">
                                        <label>Chuyên môn: </label>
                                        <select class="form-control" name="technique">
                                            <?php
                                            foreach ($techniques as $technique)
                                            { ?>
                                                <option <?= (isset($employee['chuyen_mon_id']) && $employee['chuyen_mon_id'] == $technique['id']) ? "selected='selected'" : ''?> value="<?=$technique['id']?>"><?=$technique['ten_chuyen_mon']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <button type='submit' class='btn btn-warning' name='save'><i class='fa fa-save'></i> Lưu lại thông tin</button>
                        </form>
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
