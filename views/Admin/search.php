
<?php
require_once('views/layouts/header.php');

?>
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="form-search" id="form-search">
                <form action="management/search" method="GET" enctype="multipart/form-data">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php if(isset($getData['name'])) echo $getData['name']?>"> <br> <br>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php if(isset($getData['email'])) echo $getData['email']?>"> <br> <br>
                    <a href="management/search" class="btn btn-primary">Reset</a>
                    <input type="submit" id="search-button" name="btn-search" class="btn btn-success" value="Search" />
                </form>
                <br> <br>
            </div>
            <div class="section" id="detail-page">
                <?php flash('admin_message'); ?>
                <div class="section-detail">
                    <div class="table-responsive">
                        <nav aria-label="Page navigation example">
                            <?php $page = isset($getData['page_id']) ? $getData['page_id'] : 1; ?>
                            <?= str_pagging($page, $totalNumberPage, 'admin'); ?>
                        </nav>
                        <table class="table" id="admin-table">
                            <?php $sortOption = sort_table(); ?>
                            <thead>
                            <tr>
                                <th>
                                    <a class="column-sort" id="id" href="management/search?order=id&sort=<?= isset($sortOption['sort']) ? $sortOption['sort'] : ''?>">ID <i class="fa fas fa-sort<?= $sortOption['order'] == 'id' ? $sortOption['icon'] : ''?>"></i><a/>
                                </th>
                                <th scope="col">Avatar</th>
                                <th scope="col">
                                    <a class="column-sort" id="id" href="management/search?order=name&sort=<?= isset($sortOption['sort']) ? $sortOption['sort'] : ''?>">Name <i class="fa fas fa-sort<?= $sortOption['order'] == 'name' ? $sortOption['icon'] : ''?>"></i><a/>
                                </th>
                                <th scope="col">
                                    <a class="column-sort" id="id" href="management/search?order=email&sort=<?= isset($sortOption['sort']) ? $sortOption['sort'] : ''?>">Email <i class="fa fas fa-sort<?= $sortOption['order'] == 'email' ? $sortOption['icon'] : ''?>"></i><a/>
                                </th>
                                <th scope="col">
                                    <a class="column-sort" id="id" href="management/search?order=role_type&sort=<?= isset($sortOption['sort']) ? $sortOption['sort'] : ''?>">Role <i class="fa fas fa-sort<?= $sortOption['order'] == 'role_type' ? $sortOption['icon'] : ''?>"></i><a/>
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
