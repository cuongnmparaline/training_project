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
                        <input type="button" id="upload_avatar" value='Upload'> <br> <br>
                        <?php if(isset($error['avatar'])) echo "<p class='error'>{$error['avatar']}</p>" ?>
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" value="<?php if(isset($name)) echo $name?>">
                        <?php if(isset($error['name'])) echo "<p class='error'>{$error['name']}</p>" ?>
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" value="<?php if(isset($email)) echo $email?>">
                        <?php if(isset($error['email'])) echo "<p class='error'>{$error['email']}</p>" ?>
                        <label for="password">Password*</label>
                        <input type="password" name="password" id="password">
                        <?php if(isset($error['password'])) echo "<p class='error'>{$error['password']}</p>" ?>
                        <label for="password">Password Verify*</label>
                        <input type="password" name="password_verify" id="password_verify">
                        <?php if(isset($error['password_verify'])) echo "<p class='error'>{$error['password_verify']}</p>" ?>
                        <label for="role">Role*</label> <br>
                        <input type="radio" id="super_admin" name="role" value="1" <?php if(!empty($role_type) && $role_type == 1) echo "checked" ?>>
                        <label for="super_admin" class="role">Super Admin</label>
                        <input type="radio" class="role" id="admin" name="role" value="2"<?php if(!empty($role_type) && $role_type == 2) echo "checked" ?>>
                        <label for="admin" class="role">Admin</label>
                       <?php if(isset($error['role'])) echo "<p class='error'>{$error['role']}</p>" ?>
                        <br> <br>
                        <a href="management/create" class="btn btn-primary">Reset</a>
                        <button type="submit" name="btn-add-admin" id="btn-submit" class="btn btn-secondary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

