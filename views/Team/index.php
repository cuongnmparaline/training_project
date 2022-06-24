<?php
require_once('views/layouts/header.php');
require_once('views/layouts/topbar.php');
require_once('views/layouts/sidebar.php');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Quản lý nhóm
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php?p=index&a=statistic"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
            <li class="active">Quản lý nhóm</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <?php flash('success_message'); ?>
                <?php flash('error_message'); ?>
            </div>
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <?php
            foreach ($teams as $team)
            {
                ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?=getNumberEmployeeByTeamId($team['ma_nhom'])?></h3>
                            <h5 style="font-weight: bold;"><?php echo $team['ten_nhom']; ?></h5>
                            <p><a href="nhom/chi-tiet-nhom/<?= $team['id']; ?>" class="small-box-footer" style='color: #fff;'>Chi tiết nhóm <i class="fa fa-arrow-circle-right"></i></a></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a onclick="return confirm('Bạn có thực sự muốn xóa nhóm này?')" href="nhom/xoa-nhom/<?= $team['id']; ?>" class="small-box-footer">Xóa nhóm <i class="fa fa-trash"></i></a>
                    </div>
                </div>
                <?php
            }
            ?>

            <!-- ./col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<?php
require_once('views/layouts/footer.php');
?>
