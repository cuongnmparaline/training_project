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
                        <?php if(isset($admin)){
                            ?>
                        <p>ID: <?= $admin['id']?></p>
                        <label>Avatar*</label>
                        <input type="file" id='files' name="files[]" multiple>
                        <div id="preview">
                            <img src="<?= $admin['avatar']?>" width="100px;" height="100px">
                        </div>
                        <input type="button" id="upload_avatar" value='Upload'>
                            <?php if(isset($errors['avatar'])) echo "<p class='error'>{$errors['avatar']}</p>" ?>
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" value="<?= $admin['name'] ?>">
                            <?php if(isset($errors['name'])) echo "<p class='error'>{$errors['name']}</p>" ?>
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" value="<?= $admin['email'] ?>">
                            <?php if(isset($errors['email'])) echo "<p class='error'>{$errors['email']}</p>" ?>
                        <label for="password">Password*</label>
                        <input type="password" name="password" id="password">
                            <?php if(isset($errors['password'])) echo "<p class='error'>{$errors['password']}</p>" ?>
                        <label for="password">Password Verify*</label>
                        <input type="password" name="password_verify" id="password_verify">
                            <?php if(isset($errors['password_verify'])) echo "<p class='error'>{$errors['password_verify']}</p>" ?>
                        <label for="role">Role*</label> <br>
                        <input <?php if($admin['role_type'] == 1) echo "checked";?> type="radio" id="super_admin" name="role" value="1">
                        <label for="super_admin" class="role">Super Admin</label>
                        <input <?php if($admin['role_type'] == 2) echo "checked";?> type="radio" class="role" id="admin" name="role" value="2">
                        <label for="admin" class="role">Admin</label>
                            <?php if(isset($errors['role'])) echo "<p class='error'>{$errors['role']}</p>" ?>
                        <br> <br>
                        <a href="management/edit/<?=$admin['id']?>" class="btn btn-primary">Reset</a>
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

