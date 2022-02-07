<?php
require_once ('views/layouts/header.php');
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="title-admin">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Edit Admin</h3>
                </div>
            </div>
            <div class="section" id="detail-add-admin">
                <div class="section-detail">
                    <form method="POST"  enctype="multipart/form-data">
                        <?php if(isset($id)){
                            ?>
                        <p>ID: <?= $id?></p>
                        <div class="form_group clearfix">
                            <label for="detail">Avatar*</label><br/><br/>
                            <input type="file" name="file" id="file"><br/>
                            <input id="thumbnail_url" type ="hidden" name="thumbnail_url" value="" />
                            <div id="show_list_file" >
                                <img src="<?= $avatar ?>" width="100px;" height="100px">
                            </div>
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                        </div>
                            <?=flash_error('errorEdit', 'avatar')?>
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" value="<?= $name ?>">
                            <?=flash_error('errorEdit', 'name')?>
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" value="<?= $email ?>">
                            <?=flash_error('errorEdit', 'email')?>
                        <label for="password">Password*</label>
                        <input type="password" name="password" id="password">
                            <?=flash_error('errorEdit', 'password')?>
                        <label for="password">Password Verify*</label>
                        <input type="password" name="password_verify" id="password_verify">
                            <?=flash_error('errorEdit', 'passwordVerify')?>
                        <label for="role">Role*</label> <br>
                        <input <?php if($role_type == 1) echo "checked";?> type="radio" id="super_admin" name="role_type" value="1">
                        <label for="super_admin" class="role">Super Admin</label>
                        <input <?php if($role_type == 2) echo "checked";?> type="radio" class="role" id="admin" name="role_type" value="2">
                        <label for="admin" class="role">Admin</label>
                            <?=flash_error('errorEdit', 'role')?>
                        <br> <br>
                        <a href="management/edit/<?=$id?>" class="btn btn-primary">Reset</a>
                        <button type="submit" name="btn-update-admin" id="btn-submit" class="btn btn-secondary">Save</button>
                            <?php
                            }
                            echo flash("error_message");
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

