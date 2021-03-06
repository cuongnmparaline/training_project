<?php

abstract class BaseValidate{

    abstract public function validateCreate($data);
    abstract public function validateEdit($data);

    public function __construct()
    {
        $this->accountModel = new AuthModel();
        $this->userModel = new UserModel();
    }


    protected function checkEmail($email, $errorType = 'errorCreate', $typeModel = 'admin'){
        if (!$this->isEmail($email)) {
            flash_error($errorType, 'email', EMAIL_VALIDATE);
        }
        if($typeModel == 'user' && $this->userModel->checkMailExisted($email)){
            flash_error($errorType, 'email', EMAIL_EXISTED);
        }
        if($typeModel == 'admin' && $this->adminModel->checkMailExisted($email)){
            flash_error($errorType, 'email', EMAIL_EXISTED);
        }
        return $email;
    }

    protected function checkAvatar($file , $type = 'errorCreate'){

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

    protected function checkSalary($salary , $type = 'errorCreate'){
        if(empty($salary)){
            flash_error($type, 'salary', SALARY_BLANK);
        } elseif (!$this->isNumber($salary)) {
            flash_error($type, 'salary', SALARY_VALIDATE);
        }
        return $salary;
    }

    protected function checkPassword($password, $type = 'errorCreate'){
        if (empty($password)) {
            flash_error($type, 'password', PASS_BLANK);
        }
        if (!$this->isPassword($password)) {
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


    protected function isEmail($email){
        $pattern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
        if (!preg_match($pattern, $email, $matchs)) {
            return false;
        } else {
            return true;
        }
    }

    protected function isPassword($password){
        $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
        if (!preg_match($partten, $password, $matchs)) {
            return false;
        } else {
            return true;
        }
    }

    protected function isNumber($number){
        $partten = "/^[0-9]+$/";
        if (!preg_match($partten, $number, $matchs)) {
            return false;
        } else {
            return true;
        }
    }

    public function checkEmpty($data, $field, $message, $type){
        if (empty($data) && $data != '0') {
            flash_error($type, $field, $message);
        }
    }
}