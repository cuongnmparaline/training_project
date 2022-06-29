<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thêm mới nhân viên
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
            <li><a href="nhan-vien/them-moi">Nhân viên</a></li>
            <li class="active">Thêm mới nhân viên</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới nhân viên</h3> &emsp;
                        <small>Những ô nhập có dấu <span style="color: red;">*</span> là bắt buộc</small>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mã nhân viên: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="employeeCode" value="<?= generateCode('employee')?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên nhân viên <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên nhân viên" name="name" value="<?= isset($post['name']) ? $post['name'] : ''?>">
                                    </div>
                                    <?=flash_error('errorCreate', 'name')?>
                                    <div class="form-group">
                                        <label>Biệt danh: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập biệt danh" name="nickName" value="<?= isset($post['nickName']) ? $post['nickName'] : ''?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Tình trạng hôn nhân <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="marriage">
                                            <option value="">--- Chọn tình trạng hôn nhân ---</option>
                                            <?php
                                            foreach ($marriages as $marriage)
                                            { ?>
                                                <option <?= (isset($post['marriage']) && $post['marriage'] == $marriage['id']) ? "selected='selected'" : ''?> value="<?=$marriage['id']?>"><?=$marriage['ten_tinh_trang']?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorCreate', 'marriage')?>
                                    <div class="form-group">
                                        <label>Số CMND <span style="color: red;">*</span>: </label>
                                        <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Nhập số CMND" name="identify" value="<?= isset($post['identify']) ? $post['identify'] : ''?>">
                                    </div>
                                    <?=flash_error('errorCreate', 'identify')?>
                                    <div class="form-group">
                                        <label>Ngày cấp <span style="color: red;">*</span>: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Nhập nơi cấp" name="identify_time" value="<?= isset($post['identify_time']) ? $post['identify_time'] : date("Y-m-d")?>">
                                    </div>
                                    <?=flash_error('errorCreate', 'identify_time')?>
                                    <div class="form-group">
                                        <label>Nơi cấp <span style="color: red;">*</span>: </label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập nơi cấp" name="identify_place" value="<?= isset($post['identify_place']) ? $post['identify_place'] : ''?>">
                                    </div>
                                    <?=flash_error('errorCreate', 'identify_place')?>
                                    <div class="form-group">
                                        <label>Quốc tịch <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="nationality">
                                            <option value="">--- Chọn quốc tịch ---</option>
                                            <?php
                                            foreach ($nationalities as $nationality)
                                            { ?>
                                                <option <?= (isset($post['marriage']) && $post['marriage'] == $nationality['id']) ? "selected='selected'" : ''?> value="<?=$nationality['id']?>"><?=$nationality['ten_quoc_tich']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorCreate', 'nationality')?>
                                    <div class="form-group">
                                        <label>Tôn giáo: </label>
                                        <select class="form-control" name="religion">
                                            <?php
                                            foreach ($religions as $religion)
                                            { ?>
                                                <option <?= (isset($post['marriage']) && $post['marriage'] == $religion['id']) ? "selected='selected'" : ''?> value="<?=$religion['id']?>"><?=$religion['ten_ton_giao']?></option>
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
                                                <option <?= (isset($post['marriage']) && $post['marriage'] == $ethnic['id']) ? "selected='selected'" : ''?> value="<?=$ethnic['id']?>"><?=$ethnic['ten_dan_toc']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorCreate', 'ethnic')?>
                                    <div class="form-group">
                                        <label>Loại nhân viên <span style="color: red;">*</span> : </label>
                                        <select class="form-control" name="type">
                                            <option value="">--- Chọn loại nhân viên ---</option>
                                            <?php
                                            foreach ($types as $type)
                                            { ?>
                                                <option <?= (isset($post['type']) && $post['type'] == $type['id']) ? "selected='selected'" : ''?> value="<?=$type['id']?>"><?=$type['ten_loai_nv']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorCreate', 'type')?>
                                    <div class="form-group">
                                        <label>Bằng cấp: </label>
                                        <select class="form-control" name="degree">
                                            <?php
                                            foreach ($degrees as $degree)
                                            { ?>
                                                <option <?= (isset($post['degree']) && $post['degree'] == $degree['id']) ? "selected='selected'" : ''?> value="<?=$degree['id']?>"><?=$degree['ten_bang_cap']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="status">
                                            <option value="">--- Chọn trạng thái ---</option>
                                            <option <?= (isset($post['status']) && $post['status'] == 1) ? "selected='selected'" : ''?> value="1">Đang làm việc</option>
                                            <option <?= (isset($post['status']) && $post['status'] == 0) ? "selected='selected'" : ''?> value="0">Đã nghỉ việc</option>
                                        </select>
                                    </div>
                                    <?=flash_error('errorCreate', 'status')?>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ảnh 3x4 (Nếu có): </label>
                                        <input type="file" class="form-control" id="exampleInputEmail1" name="avatar">
                                    </div>
                                    <?=flash_error('errorCreate', 'avatar')?>
                                    <div class="form-group">
                                        <label>Giới tính <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="gender">
                                            <option value="">--- Chọn giới tính ---</option>
                                            <option <?= (isset($post['gender']) && $post['gender'] == 1) ? "selected='selected'" : ''?> value="1">Nam</option>
                                            <option <?= (isset($post['gender']) && $post['gender'] == 0) ? "selected='selected'" : ''?> value="0">Nữ</option>
                                        </select>
                                    </div>
                                    <?=flash_error('errorCreate', 'gender')?>
                                    <div class="form-group">
                                        <label>Ngày sinh: </label>
                                        <input type="date" class="form-control" id="exampleInputEmail1" name="birthday" value="<?= isset($post['birthday']) ? $post['birthday'] : date("Y-m-d")?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Nơi sinh: </label>
                                        <textarea class="form-control" name="placeOfBirth"><?= isset($post['placeOfBirth']) ? $post['placeOfBirth'] : ''?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Nguyên quán: </label>
                                        <textarea class="form-control" name="domicile"><?= isset($post['domicile']) ? $post['domicile'] : ''?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Hộ khẩu <span style="color: red;">*</span>: </label>
                                        <textarea class="form-control" name="residence"><?= isset($post['residence']) ? $post['residence'] : ''?></textarea>
                                    </div>
                                    <?=flash_error('errorCreate', 'residence')?>
                                    <div class="form-group">
                                        <label>Tạm trú: </label>
                                        <textarea class="form-control" name="tabernacle"><?= isset($post['tabernacle']) ? $post['tabernacle'] : ''?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Phòng ban <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="department">
                                            <option value="">--- Chọn phòng ban ---</option>
                                            <?php
                                            foreach ($departments as $department)
                                            { ?>
                                                <option <?= (isset($post['department']) && $post['department'] == $department['id']) ? "selected='selected'" : ''?> value="<?=$department['id']?>"><?=$department['ten_phong_ban']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorCreate', 'department')?>
                                    <div class="form-group">
                                        <label>Chức vụ <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="position">
                                            <option value="">--- Chọn chức vụ ---</option>
                                            <?php
                                            foreach ($positions as $position)
                                            { ?>
                                                <option <?= (isset($post['position']) && $post['position'] == $position['id']) ? "selected='selected'" : ''?> value="<?=$position['id']?>"><?=$position['ten_chuc_vu']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorCreate', 'position')?>
                                    <div class="form-group">
                                        <label>Trình độ <span style="color: red;">*</span>: </label>
                                        <select class="form-control" name="education">
                                            <option value="">--- Chọn trình độ ---</option>
                                            <?php
                                            foreach ($educations as $education)
                                            { ?>
                                                <option <?= (isset($post['education']) && $post['education'] == $education['id']) ? "selected='selected'" : ''?> value="<?=$education['id']?>"><?=$education['ten_trinh_do']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <?=flash_error('errorCreate', 'education')?>
                                    <div class="form-group">
                                        <label>Chuyên môn: </label>
                                        <select class="form-control" name="technique">
                                            <?php
                                            foreach ($techniques as $technique)
                                            { ?>
                                                <option <?= (isset($post['technique']) && $post['technique'] == $technique['id']) ? "selected='selected'" : ''?> value="<?=$technique['id']?>"><?=$technique['ten_chuyen_mon']?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <button type='submit' class='btn btn-primary' name='save'><i class='fa fa-plus'></i> Thêm mới nhân viên</button>
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
