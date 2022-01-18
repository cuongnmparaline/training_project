<?php
require_once ('views/layouts/header.php');
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <div id="content" class="fl-right">
            <div class="section" id="title-admin">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Create User</h3>
                </div>
            </div>
            <div class="section" id="detail-add-admin">
                <div class="section-detail">
                    <form method="POST"  enctype="multipart/form-data">
                        <?= flash('user_message') ?>
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
                        <label for="role">Status*</label> <br>
                        <input type="radio" id="active" name="status" value="1">
                        <label for="active" class="status">Active</label>
                        <input type="radio" class="status" id="banned" name="status" value="2">
                        <label for="banned" class="status">Banned</label>
                        <?php echo form_error('status')?>
                        <br> <br>
                        <a href="management/create-user" class="btn btn-primary">Reset</a>
                        <button type="submit" name="btn-add-user" id="btn-submit" class="btn btn-secondary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

