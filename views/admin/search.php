
<?php
require_once('views/layouts/header.php');
?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="form-search" id="form-search">
                <form action="management/search" method="GET" enctype="multipart/form-data">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?=set_value('name')?>"> <br> <br>
                    <?php echo form_error('name')?>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?=set_value('email')?>"> <br> <br>
                    <a href="management/search" class="btn btn-primary">Reset</a>
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
                        <?php $sort_option['sort'] == 'DESC' ? $sort_option['sort'] = 'ASC' : $sort_option['sort'] = 'DESC'; ?>
                        <table class="table" id="admin-table">
                            <thead>
                            <tr>
                                <th>
                                    <a class="column-sort" id="id" data-order="desc" href="management/search?order=id&sort=<?=$sort_option['sort']?>">ID <i class="<?= $sort_option['icon']['id']?>"></i><a/>
                                </th>
                                <th scope="col">Avatar</th>
                                <th scope="col">
                                    <a class="column-sort" id="id" data-order="desc" href="management/search?order=name&sort=<?=$sort_option['sort']?>">Name <i class="<?= $sort_option['icon']['name']?>"></i><a/>
                                </th>
                                <th scope="col">
                                    <a class="column-sort" id="id" data-order="desc" href="management/search?order=email&sort=<?=$sort_option['sort']?>">Email <i class="<?= $sort_option['icon']['email']?>"></i><a/>
                                </th>
                                <th scope="col">
                                    <a class="column-sort" id="id" data-order="desc" href="management/search?order=role_type&sort=<?=$sort_option['sort']?>">Role <i class="<?= $sort_option['icon']['role_type']?>"></i><a/>
                                </th>
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
                                        <a href="management/edit/<?=$admin['id']?>">Edit</a> ||
                                        <a href="management/delete/<?=$admin['id']?>" onclick="return confirm('Are you sure?');">Delete</a>
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
