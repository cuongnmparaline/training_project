<?php
require_once ('components/validate/BaseValidate.php');

class AdminValidate extends BaseValidate {

    public function validateCreate($data){
        $result['status'] = false;
        $avatar = $this->checkAvatar($data['file']);
        $name = $this->checkName($data['post']['name']);
        $email = $this->checkEmail($data['post']['email']);
        $password = $this->checkPassword($data['post']['password']);
        $this->checkPasswordVerify($data['post']['password'], $data['post']['password_verify']);
        $role = isset($data['post']['role_type']) ? $data['post']['role_type'] : '';
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

    public function validateEdit($data){
        $result['status'] = false;
        $role = isset($data['post']['role_type']) ? $data['post']['role_type'] : '';
        $name = $this->checkName($data['post']['name'], 'errorEdit');
        $email = $data['admin']['email'];
        if($email != $data['post']['email']){
            $email = $this->checkEmail($data['post']['email'], 'errorEdit');
        }
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

    public function checkRole($role, $type = 'errorCreate'){
        if (empty($role)) {
            die('okoeke');
            flash_error( $type, 'role', ROLE_BLANK);
        }

        return $role;
    }

}