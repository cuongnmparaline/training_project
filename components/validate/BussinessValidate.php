<?php
require_once ('components/validate/BaseValidate.php');
require_once ('models/BussinessModel.php');

class BussinessValidate extends BaseValidate {

    public function validateCreate($data){
        $validateStatus = false;

        $this->checkEmpty($data['employee'], 'employee', EMPLOYEE_BLANK, 'errorCreate');
        $this->checkEmpty($data['dayStart'], 'dayStart', DAY_START_BLANK, 'errorCreate');
        $this->checkEmpty($data['dayEnd'], 'dayEnd', DAY_END_BLANK, 'errorCreate');
        $this->checkEmpty($data['location'], 'location', LOCATION_BLANK, 'errorCreate');

        if(empty($_SESSION['errorCreate'])){
            $bussinessModel = new BussinessModel();
            $check = $bussinessModel->checkEmployeeAlready( $data['employee'], $data['dayStart'], $data['dayEnd']);
            if($check){
                flash_error('errorCreate', 'employee', POSITION_EMPLOYEE_VALIDATE);
            }
        }

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

    public function checkEmpty($data, $field, $message, $type){
        if (empty($data)) {
            flash_error($type, $field, $message);
            return true;
        }
        return false;
    }

}