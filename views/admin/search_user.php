

<?php
require_once('views/layouts/header.php');
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="form-search" id="form-search">
                <form action="?controller" method="GET">
                    <input type="hidden" id="controller" name="controller" value="admin">
                    <input type="hidden" id="action" name="action" value="search_user">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value=""> <br> <br>
                    <?php echo form_error('name')?>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value=""> <br> <br>
                    <a href="?controller=admin&action=search_user" class="btn btn-primary">Reset</a>
                    <input type="submit" id="search-button" name="btn-search-user" class="btn btn-success" value="Search" />
                </form>
                <br> <br>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <?php flash('user_message'); ?>
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
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($users)){
                                foreach ($users as $user){
                                    ?>
                                    <tr>
                                        <th scope="row"><?= $user['id']?></th>
                                        <td><a href="$controlle=admin&action=edit"><img src="<?= $user['avatar'] ?>" alt="" id="admin-avatar"></a></td>
                                        <td><?= $user['name']?></td>
                                        <td><?= $user['email']?></td>
                                        <td><?= set_status($user['status']) ?></td>
                                        <td>
                                            <a href="?controller=admin&action=edit&id=<?=$user['id']?>">Edit</a> ||
                                            <a href="?controller=admin&action=delete&id=<?=$user['id']?>" onclick="return confirm('Are you sure?');">Delete</a>
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
