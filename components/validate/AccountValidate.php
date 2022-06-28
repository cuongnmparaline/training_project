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

        if(!empty($data['avatar']['name']) && $data['avatar']['name'] != ''){
            $this->checkAvatar($data['avatar']);
        }
        $this->checkEmpty($data['lastName'], 'lastName', NAME_BLANK, 'errorCreate');
        $this->checkEmpty($data['firstName'], 'firstName', NAME_BLANK, 'errorCreate');
        $this->checkEmpty($data['email'], 'email', EMAIL_BLANK, 'errorCreate');
        $this->checkEmpty($data['role'], 'role', ROLE_BLANK, 'errorCreate');
        $this->checkEmpty($data['status'], 'status', STATUS_BLANK, 'errorCreate');
        $this->checkPassword($data['password']);
        $this->checkPasswordVerify($data['password'], $data['password_verify']);

        if(empty($_SESSION['errorCreate'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function validateEdit($data){
        $validateStatus = false;

        if(!empty($data['avatar']['name']) && $data['avatar']['name'] != ''){
            $this->checkAvatar($data['avatar']);
        }
        $this->checkEmpty($data['lastName'], 'lastName', NAME_BLANK, 'errorEdit');
        $this->checkEmpty($data['firstName'], 'firstName', NAME_BLANK, 'errorEdit');
        $this->checkEmpty($data['role'], 'role', ROLE_BLANK, 'errorEdit');
        $this->checkEmpty($data['status'], 'status', STATUS_BLANK, 'errorEdit');

        if(empty($_SESSION['errorEdit'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function validateChangePass($data){
        if (empty($data['oldPass'])) {
            flash_error('errorChangePass', 'oldPass', PASS_BLANK);
        } elseif (!$this->isPassword($data['oldPass'])) {
            flash_error('errorChangePass', 'oldPass', PASS_VALIDATE);
        }

        $account = $this->accountModel->checkLogin($_SESSION['account']['account_email'],md5($data['oldPass']));

        if(empty($account) && empty($_SESSION['errorChangePass'])){
            flash_error('errorChangePass', 'oldPass', PASSWORD_INCORRECT);
        }

        $this->checkPassword($data['password'], 'errorChangePass');
        $this->checkPasswordVerify($data['password'], $data['passwordVerify'], 'errorChangePass');

        if(empty($_SESSION['errorChangePass'])){
            return true;
        }
        return false;
    }

}