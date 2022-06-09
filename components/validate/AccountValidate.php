<?php
require_once ('components/validate/BaseValidate.php');

class AccountValidate extends BaseValidate {

    public function checkLogin($email, $password){
        if (empty($email)) {
            flash_error('errorLogin', 'email', EMAIL_BLANK);
        }elseif (!$this->isEmail($email)) {
            flash_error('errorLogin', 'email', EMAIL_VALIDATE);
        }
        // Check password
        if (empty($password)) {
            flash_error('errorLogin', 'password', PASS_BLANK);
        } elseif (!$this->isPassword($password)) {
            flash_error('errorLogin', 'password', PASS_VALIDATE);
        }

        $account = $this->accountModel->checkLogin($email,md5($password));

        if(empty($account) && empty($_SESSION['errorLogin'])){
            flash_error('errorLogin', 'account', ACCOUNT_INCORRECT);
        }

        if(empty($_SESSION['errorLogin'])){
            return $account;
        }

        return false;
    }

    public function validateCreate($data){
        $validateStatus = false;
        $this->checkAvatar($data['avatar']);
        $this->checkName($data['name']);
        $this->checkEmail($data['email']);
        $this->checkPassword($data['password']);
        $this->checkPasswordVerify($data['password'], $data['password_verify']);
        $role = isset($data['role_type']) ? $data['role_type'] : '';
        $this->checkRole($role);
        if(empty($_SESSION['errorCreate'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function validateEdit($data){
        $validateStatus = false;
        $role = isset($data['role_type']) ? $data['role_type'] : '';
        $this->checkName($data['name'], 'errorEdit');
        $email = $data['admin']['email'];
        if($email != $data['email']){
            $this->checkEmail($data['email'], 'errorEdit');
        }
        $data['admin']['password'];
        if (!empty($data['password'])) {
            $this->checkPassword($data['password'], 'errorEdit');
            $this->checkPasswordVerify($data['password'], $data['password_verify'], 'errorEdit');
        }

        if(!empty($data['avatar']['file']['name'])){
            $this->checkAvatar($data['avatar'], 'errorEdit');
        }
        $this->checkRole($role, 'errorEdit');

        if(empty($_SESSION['errorEdit'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function checkRole($role, $type = 'errorCreate'){
        if (empty($role)) {
            flash_error( $type, 'role', ROLE_BLANK);
        }

        return $role;
    }

}