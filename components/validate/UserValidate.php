<?php
require_once ('components/validate/UserValidate.php');
require_once ('models/UserModel.php');

class UserValidate extends BaseValidate {

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function ValidateCreate($data){
        unset($_SESSION['errorCreate']);
        $result['status'] = false;
        $status = isset($data['post']['status']) ? $data['post']['status'] : '';
        $avatar = $this->checkAvatar($data['file']);
        $name = $this->checkName($data['post']['name']);
        $email = $this->checkEmail($data['post']['email']);
        $password = $this->checkPassword($data['post']['password']);
        $this->checkPasswordVerify($data['post']['password'], $data['post']['password_verify']);
        $this->checkStatus($status);
        if(empty($_SESSION['errorCreate'])){
            $result = [
                'status' => true,
                'user' => [
                    'name' => $name,
                    'avatar' => $avatar,
                    'password' => $password,
                    'email' => $email,
                    'status' => $status
                ]
            ];
        }
        return $result;
    }

    public function ValidateEdit($data){
        unset($_SESSION['errorEdit']);
        $result['status'] = false;
        $status = isset($data['post']['status']) ? $data['post']['status'] : '';
        $name = $this->checkName($data['post']['name'], 'errorEdit');
        $email = $this->checkEmail($data['post']['email'], 'errorEdit');
        $password = $data['user']['password'];
        if (!empty($data['post']['password'])) {
            $password = $this->checkPassword($data['post']['password'], 'errorEdit');
            $this->checkPasswordVerify($data['post']['password'], $data['post']['password_verify'], 'errorEdit');
        }
        $avatar = $data['user']['avatar'];
        if(!empty($data['file']['file']['name'])){
            $avatar = $this->checkAvatar($data['file'], 'errorEdit');
        }
        $status = $this->checkStatus($status, 'errorEdit');

        if(empty($_SESSION['errorEdit'])){
            $result = [
                'status' => true,
                'user' => [
                    'name' => $name,
                    'avatar' => $avatar,
                    'password' => $password,
                    'email' => $email,
                    'status' => $status
                ]
            ];
        }
        return $result;
    }

    public function checkLogin($email, $password){
        if (empty($email)) {
            flash_error('errorLogin', 'email', EMAIL_BLANK);
        }elseif (!$this->is_email($email)) {
            flash_error('errorLogin', 'email', EMAIL_VALIDATE);
        }
        // Check password
        if (empty($password)) {
            flash_error('errorLogin', 'password', PASS_BLANK);
        } elseif (!$this->is_password($password)) {
            flash_error('errorLogin', 'password', EMAIL_BLANK);
        }
        if(!$this->userModel->checkLogin($email,$password)){
            $result['errors']['account'] = ACCOUNT_INCORRECT;
        }
        if(empty($result['errors'])){
            return true;
        }
        return false;
    }

    public function checkEmail($email, $type = 'errorCreate')
    {
        if (!$this->is_email($email)) {
            flash_error($type, 'email', EMAIL_VALIDATE);
        }
        if ($this->userModel->checkMailExisted($email)) {
            flash_error('$type', 'email', EMAIL_EXISTED);
        }
        return $email;
    }

    public function checkStatus($status, $type = 'errorCreate'){
        if (empty($status)) {
            flash_error( $type, 'status', STATUS_BLANK);
        }
        return $status;
    }
}