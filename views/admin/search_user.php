

<?php
require_once('views/layouts/header.php');
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="form-search" id="form-search">
                <form action="management/search-user" method="GET">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value=""> <br> <br>
                    <?php echo form_error('name')?>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value=""> <br> <br>
                    <a href="management/search-user" class="btn btn-primary">Reset</a>
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
                        <?php $sort_option['sort'] == 'DESC' ? $sort_option['sort'] = 'ASC' : $sort_option['sort'] = 'DESC'; ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    <a class="column-sort" id="id" data-order="desc" href="management/search-user?order=id&sort=<?=$sort_option['sort']?>">ID <i class="fa fa-fw fa-sort"></i><a/>
                                </th>
                                <th scope="col">Avatar</th>
                                <th scope="col">
                                    <a class="column-sort" id="id" data-order="desc" href="management/search-user?order=name&sort=<?=$sort_option['sort']?>">Name <i class="fa fa-fw fa-sort"></i><a/>
                                </th>
                                <th scope="col">
                                    <a class="column-sort" id="id" data-order="desc" href="management/search-user?order=email&sort=<?=$sort_option['sort']?>">Email <i class="fa fa-fw fa-sort"></i><a/>
                                </th>
                                <th scope="col">
                                    <a class="column-sort" id="id" data-order="desc" href="management/search-user?order=status&sort=<?=$sort_option['sort']?>">Status <i class="fa fa-fw fa-sort"></i><a/>
                                </th>
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
                                            <a href="management/edit-user/<?=$user['id']?>">Edit</a> ||
                                            <a href="management/delete-user/<?=$user['id']?>" onclick="return confirm('Are you sure?');">Delete</a>
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
