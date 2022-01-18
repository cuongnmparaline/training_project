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
                    <form method="POST"  enctype="multipart/form-data">
                        <?= flash('user_message') ?>
                        <p>ID: <?= $user['id']?></p>
                        <label>Avatar*</label>
                        <input type="file" id='files' name="files[]" multiple>
                        <div id="preview">
                            <img src="<?= $user['avatar']?>" width="100px;" height="100px">
                        </div>
                        <input type="button" id="upload_avatar" value='Upload'>
                        <?php echo form_error('avatar') ?>
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" value="<?= $user['name'] ?>">
                        <?php echo form_error('name')?>
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" value="<?= $user['email'] ?>">
                        <?php echo form_error('email')?>
                        <label for="password">Password*</label>
                        <input type="password" name="password" id="password">
                        <?php echo form_error('password')?>
                        <label for="password">Password Verify*</label>
                        <input type="password" name="password_verify" id="password_verify">
                        <?php echo form_error('password_verify')?>
                        <label for="role">Role*</label> <br>
                        <input <?php if($user['status'] == 1) echo "checked";?> type="radio" id="active" name="status" value="1">
                        <label for="active" class="status">Active</label>
                        <input <?php if($user['status'] == 2) echo "checked";?> type="radio" class="role" id="banned" name="status" value="2">
                        <label for="banned" class="status">Banned</label>
                        <?php echo form_error('status')?>
                        <br> <br>
                        <a href="management/edit-user/<?=$user['id']?>" class="btn btn-primary">Reset</a>
                        <button type="submit" name="btn-update-admin" id="btn-submit" class="btn btn-secondary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

