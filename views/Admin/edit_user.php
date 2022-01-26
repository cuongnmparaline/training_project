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
                        <?php if(isset($user)){
                        ?>
                        <p>ID: <?= $user['id']?></p>
                        <div class="form_group clearfix">
                            <label for="detail">Avatar*</label><br/><br/>
                            <input type="file" name="file" id="file"><br/>
                            <input id="thumbnail_url" type ="hidden" name="thumbnail_url" value="" />
                            <div id="show_list_file" >
                                <img src="<?= $user['avatar']?>" width="100px;" height="100px">
                            </div>
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                        </div>
                        <?php if(isset($errors['avatar'])) echo "<p class='error'>{$errors['avatar']}</p>" ?>
                        <?php if(isset($error['avatar'])) echo "<p class='error'>{$error['avatar']}</p>" ?>
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" value="<?= $user['name'] ?>">
                            <?php if(isset($error['name'])) echo "<p class='error'>{$error['name']}</p>" ?>
                        <label for="email">Email*</label>
                        <input type="email" name="email" id="email" value="<?= $user['email'] ?>">
                            <?php if(isset($error['email'])) echo "<p class='error'>{$error['email']}</p>" ?>
                        <label for="password">Password*</label>
                        <input type="password" name="password" id="password">
                            <?php if(isset($error['password'])) echo "<p class='error'>{$error['password']}</p>" ?>
                        <label for="password">Password Verify*</label>
                        <input type="password" name="password_verify" id="password_verify">
                            <?php if(isset($error['password_verify'])) echo "<p class='error'>{$error['password_verify']}</p>" ?>
                        <label for="role">Role*</label> <br>
                        <input <?php if($user['status'] == 1) echo "checked";?> type="radio" id="active" name="status" value="1">
                        <label for="active" class="status">Active</label>
                        <input <?php if($user['status'] == 2) echo "checked";?> type="radio" class="role" id="banned" name="status" value="2">
                        <label for="banned" class="status">Banned</label>
                            <?php if(isset($error['status'])) echo "<p class='error'>{$error['status']}</p>" ?>
                        <br> <br>
                        <a href="management/edit-user/<?=$user['id']?>" class="btn btn-primary">Reset</a>
                        <button type="submit" name="btn-update-user" id="btn-submit" class="btn btn-secondary">Save</button>
                        <?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

