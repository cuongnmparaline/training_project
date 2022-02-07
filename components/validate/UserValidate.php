<?php
require_once ('components/validate/BaseValidate.php');
require_once ('models/UserModel.php');
require_once ('models/AdminModel.php');

class UserValidate extends BaseValidate {

    public function validateCreate($data){
        $validateStatus = false;
        $status = isset($data['status']) ? $data['status'] : '';
        $this->checkAvatar($data['avatar']);
        $this->checkName($data['name']);
        $this->checkEmail($data['email'], 'errorCreate', 'user');
        $this->checkPassword($data['password']);
        $this->checkPasswordVerify($data['password'], $data['password_verify']);
        $this->checkStatus($status);
        if(empty($_SESSION['errorCreate'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function validateEdit($data){
        $validateStatus = false;
        $status = isset($data['status']) ? $data['status'] : '';
        $this->checkName($data['name'], 'errorEdit');
        $email = $data['user']['email'];
        if($email != $data['email']){
            $this->checkEmail($data['email'], 'errorEdit', 'user');
        }
        if (!empty($data['password'])) {
            $this->checkPassword($data['password'], 'errorEdit');
            $this->checkPasswordVerify($data['password'], $data['password_verify'], 'errorEdit');
        }

        if(!empty($data['avatar']['file']['name'])){
            $this->checkAvatar($data['avatar'], 'errorEdit');
        }
        $this->checkStatus($status, 'errorEdit');

        if(empty($_SESSION['errorEdit'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function checkStatus($status, $type = 'errorCreate'){
        if (empty($status)) {
            flash_error( $type, 'status', STATUS_BLANK);
        }
        return $status;
    }
}