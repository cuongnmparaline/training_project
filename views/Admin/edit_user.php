<?php
require_once ('views/layouts/header.php');
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="title-admin">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Edit User</h3>
                </div>
            </div>
            <div class="section" id="detail-add-admin">
                <div class="section-detail">
                    <?= flash('error_message'); ?>
                    <form method="POST"  enctype="multipart/form-data">
                        <?php if(isset($id)){
                        ?>
                        <p>ID: <?= $id?></p>
                        <div class="form_group clearfix">
                            <label for="detail">Avatar*</label><br/><br/>
                            <input type="file" name="file" id="file"><br/>
                            <input id="thumbnail_url" type ="hidden" name="thumbnail_url" value="" />
                            <div id="show_list_file" >
                                <img src="<?= $avatar?>" width="100px;" height="100px">
                            </div>
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                        </div>
                            <?=flash_error('errorEdit', 'avatar')?>
                        <?php if(isset($error['avatar'])) echo "<p class='error'>{$error['avatar']}</p>" ?>
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
                        <input <?php if($status == 1) echo "checked";?> type="radio" id="active" name="status" value="1">
                        <label for="active" class="status">Active</label>
                        <input <?php if($status == 2) echo "checked";?> type="radio" class="role" id="banned" name="status" value="2">
                        <label for="banned" class="status">Banned</label>
                            <?=flash_error('errorEdit', 'status')?>
                        <br> <br>
                        <a href="management/edit-user/<?=$id?>" class="btn btn-primary">Reset</a>
                        <button type="submit" name="btn-update-user" id="btn-submit" class="btn btn-secondary">Save</button>
                        <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

