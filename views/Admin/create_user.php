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
                        <div class="form_group clearfix">
                            <label for="detail">Avatar*</label><br/><br/>
                            <input type="file" name="file" id="file"><br/>
                            <input id="thumbnail_url" type ="hidden" name="thumbnail_url" value="" />
                            <div id="show_list_file" >
                            </div>
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                        </div>
                        <?php if(isset($errors['avatar'])) echo "<p class='error'>{$errors['avatar']}</p>" ?>
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" value="<?php if(isset($name)) echo $name?>">
                        <?php if(isset($errors['name'])) echo "<p class='error'>{$errors['name']}</p>" ?>
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" value="<?php if(isset($email)) echo $email?>">
                        <?php if(isset($errors['email'])) echo "<p class='error'>{$errors['email']}</p>" ?>
                        <label for="password">Password*</label>
                        <input type="password" name="password" id="password">
                        <?php if(isset($errors['password'])) echo "<p class='error'>{$errors['password']}</p>" ?>
                        <label for="password">Password Verify*</label>
                        <input type="password" name="password_verify" id="password_verify">
                        <?php if(isset($errors['password_verify'])) echo "<p class='error'>{$errors['password_verify']}</p>" ?>
                        <label for="role">Status*</label> <br>
                        <input type="radio" id="active" name="status" value="1" <?php if(!empty($status) && $status == 1) echo "checked" ?>>
                        <label for="active" class="status">Active</label>
                        <input type="radio" class="status" id="banned" name="status" value="2" <?php if(!empty($status) && $status == 2) echo "checked" ?>>
                        <label for="banned" class="status">Banned</label>
                        <?php if(isset($errors['status'])) echo "<p class='error'>{$errors['status']}</p>" ?>
                        <br> <br>
                        <a href="management/create-user" class="btn btn-primary">Reset</a>
                        <button type="submit" name="btn-add-user" id="btn-submit" class="btn btn-secondary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

