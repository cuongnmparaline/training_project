

<?php
require_once('views/layouts/header.php');
?>

<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="form-search" id="form-search">
                <form action="management/search-user" method="GET">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php if(isset($getData['name'])) echo $getData['name']?>"> <br> <br>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php if(isset($getData['email'])) echo $getData['email']?>"> <br> <br>
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
                            <?php $page = isset($getData['page_id']) ? $getData['page_id'] : 1; ?>
                            <?= str_pagging($page, $totalNumberPage, 'user'); ?>
                        </nav>
                        <?php $sortOption = sort_table(); ?>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    <a class="column-sort" id="id" href="management/search-user?order=id&sort=<?= isset($sortOption['sort']) ? $sortOption['sort'] : ''?>">ID <i class="fa fas fa-sort<?= $sortOption['order'] == 'id' ? $sortOption['icon'] : ''?>"></i><a/>
                                </th>
                                <th scope="col">Avatar</th>
                                <th scope="col">
                                    <a class="column-sort" id="id" href="management/search-user?order=name&sort=<?= isset($sortOption['sort']) ? $sortOption['sort'] : ''?>">Name <i class="fa fas fa-sort<?= $sortOption['order'] == 'name' ? $sortOption['icon'] : ''?>"></i><a/>
                                </th>
                                <th scope="col">
                                    <a class="column-sort" id="id" href="management/search-user?order=email&sort=<?= isset($sortOption['sort']) ? $sortOption['sort'] : ''?>">Email <i class="fa fas fa-sort<?= $sortOption['order'] == 'email' ? $sortOption['icon'] : ''?>"></i><a/>
                                </th>
                                <th scope="col">
                                    <a class="column-sort" id="id" data-order="desc" href="management/search-user?order=status&sort=<?= isset($sortOption['sort']) ? $sortOption['sort'] : ''?>">Status <i class="fa fas fa-sort<?= $sortOption['order'] == 'status' ? $sortOption['icon'] : ''?>"></i><a/>
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
