
<?php
require_once('views/layouts/header.php');
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="form-search" id="form-search">
                <form action="?controller=admin&action=index" method="GET">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="">
                    <?php echo form_error('name')?>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value=""> <br> <br>
                    <a href="?controller=admin&action=index" class="btn btn-primary">Reset</a>
                    <input type="submit" id="search-button" name="btn-search" class="btn btn-success" value="Search" />
                </form>
                <br> <br>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <nav aria-label="Page navigation example">
                            <?= $str_pagging ?>
                        </nav>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
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
                                <td><?= check_role($admin['role_type']) ?></td>
                                <td>
                                        <a href="?controller=admin&action=edit&id=<?=$admin['id']?>">Edit</a> ||
                                        <a href="?controller=admin&action=delete&id=<?=$admin['id']?>" id="delete-admin">Delete</a>
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
