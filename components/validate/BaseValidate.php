<?php

abstract class BaseValidate{
    abstract public function checkEmail($email, $type);
    abstract public function validateCreate($data);
    abstract public function validateEdit($data);
    abstract public function checkLogin($email, $password);

    protected function checkAvatar($file , $type = 'errorCreate'){
        if (empty($file['file']['name'])) {
            flash_error($type, 'avatar', AVATAR_BLANK);
        }

        $type_file = pathinfo($file['file']['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
        if (!in_array(strtolower($type_file), $type_fileAllow)) {
            flash_error('errorCreate', 'avatar', FORMAT_FILE_ERROR);
        }
        $size_file = $file['file']['size'];
        if ($size_file > MAX_FILE_SIZE) {
            flash_error('errorCreate', 'avatar', SIZE_FILE_ERROR);
        }
        $upload_dir = IMG_LOCATION;
        $avatar = $upload_dir . $file['file']['name'];
        return $avatar;

    }

    protected function checkName($name , $type = 'errorCreate'){
        if(empty($name)){
            flash_error($type, 'name', NAME_BLANK);
        } elseif ((strlen($name) <= MIN_LENGHT || strlen($name) >= MAX_LENGHT)) {
            flash_error($type, 'name', NAME_VALIDATE);
        }
        return $name;
    }

    protected function checkPassword($password, $type = 'errorCreate'){
        if (!$this->is_password($password)) {
            flash_error($type, 'password', PASS_BLANK);
        }
        if (!$this->is_password($password)) {
            flash_error($type, 'password', PASS_VALIDATE);
        }
        return md5($password);
    }

    protected function checkPasswordVerify($password, $passwordVerify , $type = 'errorCreate'){
        if ($password != $passwordVerify) {
            flash_error($type, 'passwordVerify', VERIFY_INCORRECT);
        }
        return $password;
    }


    public function is_email($email){
        $pattern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
        if (!preg_match($pattern, $_POST['email'], $matchs)) {
            return false;
        } else {
            return true;
        }
    }

    protected function is_password($password){
        $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
        if (!preg_match($partten, $_POST['password'], $matchs)) {
            return false;
        } else {
            return true;
        }
    }

}