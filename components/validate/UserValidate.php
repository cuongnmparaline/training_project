<?php
require_once ('components/validate/BaseValidate.php');
require_once ('models/UserModel.php');
require_once ('models/AdminModel.php');

class UserValidate extends BaseValidate {

    public function validateCreate($data){
        $result['status'] = false;
        $status = isset($data['post']['status']) ? $data['post']['status'] : '';
        $avatar = $this->checkAvatar($data['file']);
        $name = $this->checkName($data['post']['name']);

        $email = $this->checkEmail($data['post']['email'], 'errorCreate', 'user');
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

    public function validateEdit($data){
        $result['status'] = false;
        $status = isset($data['post']['status']) ? $data['post']['status'] : '';
        $name = $this->checkName($data['post']['name'], 'errorEdit');
        $email = $data['user']['email'];
        if($email != $data['post']['email']){
            $email = $this->checkEmail($data['post']['email'], 'errorEdit', 'user');
        }
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

    public function checkStatus($status, $type = 'errorCreate'){
        if (empty($status)) {
            flash_error( $type, 'status', STATUS_BLANK);
        }
        return $status;
    }
}