<?php
require_once ('views/layouts/header.php');
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="title-admin">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Create Admin</h3>
                </div>
            </div>
            <div class="section" id="detail-add-admin">
                <div class="section-detail">
                    <form method="POST"  enctype="multipart/form-data">
                        <?= flash('admin_message') ?>
                        <label>Avatar*</label>
                        <input type="file" id='files' name="files[]" multiple><br> <br>
                        <div id="preview">
                        </div>
                        <input type="button" id="upload_avatar" value='Upload'>
                        <?php echo form_error('avatar') ?>
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" value="<?= set_value('name') ?>">
                        <?php echo form_error('name')?>
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" value="<?= set_value('email') ?>">
                        <?php echo form_error('email')?>
                        <label for="password">Password*</label>
                        <input type="password" name="password" id="password">
                        <?php echo form_error('password')?>
                        <label for="password">Password Verify*</label>
                        <input type="password" name="password_verify" id="password_verify">
                        <?php echo form_error('password_verify')?>
                        <label for="role">Role*</label> <br>
                        <input type="radio" id="super_admin" name="role" value="1">
                        <label for="super_admin" class="role">Super Admin</label>
                        <input type="radio" class="role" id="admin" name="role" value="2">
                        <label for="admin" class="role">Admin</label>
                        <?php echo form_error('role')?>
                        <br> <br>
                        <a href="management/create" class="btn btn-primary">Reset</a>
                        <button type="submit" name="btn-add-admin" id="btn-submit" class="btn btn-secondary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

