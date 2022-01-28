<?php
require_once ('components/validate/BaseValidate.php');
require_once 'models/AdminModel.php';
class AdminValidate extends BaseValidate {

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }
    public function ValidateCreate($data){
        unset($_SESSION['errorCreate']);
        $result['status'] = false;
        $role = isset($data['post']['role']) ? $data['post']['role'] : '';
        $avatar = $this->checkAvatar($data['file']);
        $name = $this->checkName($data['post']['name']);
        $email = $this->checkEmail($data['post']['email']);
        $password = $this->checkPassword($data['post']['password']);
        $this->checkPasswordVerify($data['post']['password'], $data['post']['password_verify']);
        $this->checkRole($role);
        if(empty($_SESSION['errorCreate'])){
            $result = [
                'status' => true,
                'admin' => [
                    'name' => $name,
                    'avatar' => $avatar,
                    'password' => $password,
                    'email' => $email,
                    'role_type' => $role
                ]
            ];
        }
        return $result;
    }

    public function ValidateEdit($data){
        unset($_SESSION['errorEdit']);
        $result['status'] = false;
        $role = isset($data['post']['role']) ? $data['post']['role'] : '';
        $name = $this->checkName($data['post']['name'], 'errorEdit');
        $email = $this->checkEmail($data['post']['email'], 'errorEdit');
        $password = $data['admin']['password'];
        if (!empty($data['post']['password'])) {
            $password = $this->checkPassword($data['post']['password'], 'errorEdit');
            $this->checkPasswordVerify($data['post']['password'], $data['post']['password_verify'], 'errorEdit');
        }
        $avatar = $data['admin']['avatar'];
        if(!empty($data['file']['file']['name'])){
            $avatar = $this->checkAvatar($data['file'], 'errorEdit');
        }
        $role = $this->checkRole($role, 'errorEdit');

        if(empty($_SESSION['errorEdit'])){
            $result = [
                'status' => true,
                'admin' => [
                    'name' => $name,
                    'avatar' => $avatar,
                    'password' => $password,
                    'email' => $email,
                    'role_type' => $role
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
        if(!$this->adminModel->checkLogin($email,$password)){
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
        if ($this->adminModel->checkMailExisted($email)) {
            flash_error('$type', 'email', EMAIL_EXISTED);
        }
        return $email;
    }

    public function checkRole($role, $type = 'errorCreate'){
        if (empty($role)) {
            flash_error( $type, 'role', ROLE_BLANK);
        }
        return $role;
    }

}