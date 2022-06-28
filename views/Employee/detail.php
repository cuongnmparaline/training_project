<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thông tin nhân viên
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
            <li><a href="danh-sach-nhan-vien.php?p=staff&a=list-staff">Danh sách nhân viên</a></li>
            <li class="active">Thông tin nhân viên</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mã nhân viên: <?php echo $employee['ma_nv']; ?></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-2">
                                <img src="<?= !empty($employee['hinh_anh']) ? IMG_LOCATION . 'employee/' . $employee['hinh_anh'] : IMG_EMPLOYEE_DEFAULT ?>" width="100%">
                            </div>
                            <div class="col-lg-5 col-sm-5 col-md-6 col-xs-12">
                                <p class="box-title">Tên nhân viên: <b><?php echo $employee['ten_nv']; ?></b></p>
                                <p class="box-title">Biệt danh:
                                    <?php if($employee['biet_danh'] == ""){ echo "Không có"; } else { echo $employee['biet_danh']; } ?>
                                </p>
                                <p class="box-title">Giới tính:
                                    <?= setGender($employee['gioi_tinh']) ?>
                                </p>
                                <p class="box-title">Ngày sinh:
                                    <b><?php $date = date_create($employee['ngay_sinh']); echo date_format($date, 'd-m-Y'); ?></b>
                                </p>
                                <p class="box-title">Nơi sinh:
                                    <?php echo $employee['noi_sinh']; ?>
                                </p>
                                <p class="box-title">Tình trạng hôn nhân:
                                    <?php
                                    foreach ($marriages as $marriage)
                                    { ?>
                                        <?= (isset($employee['hon_nhan_id']) && $employee['hon_nhan_id'] == $marriage['id']) ? $marriage['ten_tinh_trang'] : ''?>
                                        <?php
                                    }
                                    ?>
                                </p>
                                <p class="box-title">Số CMND:
                                    <b> <?php echo $employee['so_cmnd']; ?> </b>
                                </p>
                                <p class="box-title">Ngày cấp:
                                    <?php $ngayCap = date_create($employee['ngay_cap_cmnd']); echo date_format($ngayCap, 'd-m-Y'); ?>
                                </p>
                                <p class="box-title">Nơi cấp:
                                    <?php echo $employee['noi_cap_cmnd']; ?>
                                </p>
                                <p class="box-title">Nguyên quán:
                                    <?php echo $employee['noi_cap_cmnd']; ?>
                                </p>
                                <p class="box-title">Quốc tịch:
                                    <?php
                                    foreach ($nationalities as $nationality)
                                    { ?>
                                        <?= (isset($employee['quoc_tich_id']) && $employee['quoc_tich_id'] == $nationality['id']) ? $nationality['ten_quoc_tich'] : ''?>
                                        <?php
                                    }
                                    ?>
                                </p>
                                <p class="box-title">Dân tộc:
                                    <?php
                                    foreach ($religions as $religions)
                                    { ?>
                                        <?= (isset($employee['ton_giao_id']) && $employee['ton_giao_id'] == $religions['id']) ? $religions['ten_ton_giao'] : ''?>
                                        <?php
                                    }
                                    ?>
                                </p>
                                <p class="box-title">Tôn giáo:
                                    <?php
                                    foreach ($ethnics as $ethnic)
                                    { ?>
                                        <?= (isset($employee['dan_toc_id']) && $employee['dan_toc_id'] == $ethnic['id']) ? $ethnic['ten_dan_toc'] : ''?>
                                        <?php
                                    }
                                    ?>
                                </p>
                            </div>
                            <!-- col-5 -->
                            <div class="col-lg-5 col-sm-5 col-md-6 col-xs-12">
                                <p class="box-title">Hộ khẩu:
                                    <b> <?php echo $employee['ho_khau']; ?> </b>
                                </p>
                                <p class="box-title">Tạm trú:
                                    <?php echo $employee['tam_tru']; ?>
                                </p>
                                <p class="box-title">Loại nhân viên:
                                    <b>
                                    <?php
                                    foreach ($types as $type)
                                    { ?>
                                        <?= (isset($employee['loai_nv_id']) && $employee['loai_nv_id'] == $type['id']) ? $type['ten_loai_nv'] : ''?>
                                        <?php
                                    }
                                    ?></b>
                                </p>
                                <p class="box-title">Trình độ:
                                    <b>
                                    <?php
                                    foreach ($educations as $education)
                                    { ?>
                                        <?= (isset($employee['trinh_do_id']) && $employee['trinh_do_id'] == $education['id']) ? $education['ten_trinh_do'] : ''?>
                                        <?php
                                    }
                                    ?></b>
                                </p>
                                <p class="box-title">Chuyên môn:
                                    <b>
                                    <?php
                                    foreach ($techniques as $technique)
                                    { ?>
                                        <?= (isset($employee['chuyen_mon_id']) && $employee['chuyen_mon_id'] == $technique['id']) ? $technique['ten_chuyen_mon'] : ''?>
                                        <?php
                                    }
                                    ?></b>
                                </p>
                                <p class="box-title">Bằng cấp:
                                    <b><?php
                                        foreach ($degrees as $degree)
                                        { ?>
                                            <?= (isset($employee['bang_cap_id']) && $employee['bang_cap_id'] == $degree['id']) ? $degree['ten_bang_cap'] : ''?>
                                            <?php
                                        }
                                        ?></b>
                                </p>
                                <p class="box-title">Phòng ban:
                                    <b><?php
                                        foreach ($departments as $department)
                                        { ?>
                                            <?= (isset($employee['phong_ban_id']) && $employee['phong_ban_id'] == $department['id']) ? $department['ten_phong_ban'] : ''?>
                                            <?php
                                        }
                                        ?></b>
                                </p>
                                <p class="box-title">Chức vụ:
                                    <b><?php
                                        foreach ($positions as $position)
                                        { ?>
                                            <?= (isset($employee['chuc_vu_id']) && $employee['chuc_vu_id'] == $position['id']) ? $position['ten_chuc_vu'] : ''?>
                                            <?php
                                        }
                                        ?></b>
                                </p>
                                <p class="box-title">Trạng thái:
                                    <?= setEmployeeStatus($employee['trang_thai']) ?>
                                    </span>
                                </p>
                            </div>
                            <!-- col-5 -->
                        </div>
                        <!-- row -->
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
