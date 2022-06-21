<?php
require_once ('components/validate/BaseValidate.php');

class SalaryValidate extends BaseValidate {

    public function validateCreate($data){
        $validateStatus = false;

        $this->checkEmpty($data['employee'], 'employee', EMPLOYEE_BLANK, 'errorCreate');
        $this->checkEmpty($data['workingDay'], 'workingDay', WORKING_DAY_BLANK, 'errorCreate');
        if(isset($data['workingDay']) && $data['workingDay'] > 31 || (isset($data['workingDay']) && !$this->isNumber($data['workingDay']))) {
            flash_error('errorCreate', 'workingDay', WORKING_DAY_VALIDATE);
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
        }
    }


//    public function checkRole($role, $type = 'errorCreate'){
//        if (empty($role)) {
//            flash_error( $type, 'role', ROLE_BLANK);
//        }
//
//        return $role;
//    }

}