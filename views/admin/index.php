
<?php
require_once('views/layouts/header.php');
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="form-search" id="form-search">
                <form action="index.php?" method="GET" enctype="multipart/form-data">
                    <input type="hidden" id="controller" name="controller" value="admin">
                    <input type="hidden" id="action" name="action" value="search">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value=""> <br> <br>
                    <?php echo form_error('name')?>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value=""> <br> <br>
                    <a href="?controller=admin&action=search" class="btn btn-primary">Reset</a>
                    <input type="submit" id="search-button" name="btn-search" class="btn btn-success" value="Search" />
                </form>
                <br> <br>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php flash('admin_message'); ?>
                    <div class="table-responsive">
                        <nav aria-label="Page navigation example">
                            <?php if(!empty($str_pagging)) echo $str_pagging ?>
                        </nav>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    <b>ID</b>
<!--                                    <span class="glyphicon glyphicon-triangle-bottom"></span>-->
<!--                                    <span class="glyphicon glyphicon-triangle-top"></span>-->
<!--                                    <i class="fa fa-fw fa-sort"></i>-->
                                </th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($admins)){
                            foreach ($admins as $admin){
                            ?>
                            <tr>
                                <th scope="row"><?= $admin['id']?></th>
                                <td><a href="$controlle=admin&action=edit"><img src="<?= $admin['avatar'] ?>" alt="" id="admin-avatar"></a></td>
                                <td><?= $admin['name']?></td>
                                <td><?= $admin['email']?></td>
                                <td><?= set_role($admin['role_type']) ?></td>
                                <td>
                                        <a href="?controller=admin&action=edit&id=<?=$admin['id']?>">Edit</a> ||
                                        <a href="?controller=admin&action=delete&id=<?=$admin['id']?>" onclick="return confirm('Are you sure?');">Delete</a>
                                </td>
                            </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <th scope="row">No results found!</th>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
