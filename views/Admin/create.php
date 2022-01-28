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
                        <div class="form_group clearfix">
                            <label for="detail">Avatar*</label><br/><br/>
                            <input type="file" name="file" id="file"><br/>
                            <input id="thumbnail_url" type ="hidden" name="thumbnail_url" value="" />
                            <div id="show_list_file" >
                            </div>
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                        </div>
                        <?=flash_error('errorCreate', 'avatar')?>
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" value="<?php if(isset($name)) echo $name?>">
                        <?=flash_error('errorCreate', 'name')?>
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" value="<?php if(isset($email)) echo $email?>">
                        <?=flash_error('errorCreate', 'email')?>
                        <label for="password">Password*</label>
                        <input type="password" name="password" id="password">
                        <?=flash_error('errorCreate', 'password')?>
                        <label for="password">Password Verify*</label>
                        <input type="password" name="password_verify" id="password_verify">
                        <?=flash_error('errorCreate', 'passwordVerify')?>
                        <label for="role">Role*</label> <br>
                        <input type="radio" id="super_admin" name="role" value="1" <?php if(!empty($role_type) && $role_type == 1) echo "checked" ?>>
                        <label for="super_admin" class="role">Super Admin</label>
                        <input type="radio" class="role" id="admin" name="role" value="2"<?php if(!empty($role_type) && $role_type == 2) echo "checked" ?>>
                        <label for="admin" class="role">Admin</label> <br>
                        <?=flash_error('errorCreate', 'role')?>
                        <br>
                        <a href="management/create" class="btn btn-primary">Reset</a>
                        <button type="submit" name="btn-add-admin" id="btn-submit" class="btn btn-secondary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

