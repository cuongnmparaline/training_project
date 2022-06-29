<?php
require_once ('components/validate/BaseValidate.php');

class DisciplineValidate extends BaseValidate {

    public function validateCreate($data){
        $validateStatus = false;

        $this->checkEmpty($data['decisionNumber'], 'decisionNumber', DECISION_NUMBER_BLANK, 'errorCreate');
        $this->checkEmpty($data['decisionDay'], 'decisionDay', DECISION_DAY_BLANK, 'errorCreate');
        $this->checkEmpty($data['name'], 'name', REWARD_NAME_BLANK, 'errorCreate');
        $this->checkEmpty($data['employee'], 'employee', EMPLOYEE_BLANK, 'errorCreate');
        $this->checkEmpty($data['rewardType'], 'rewardType', REWARD_NAME_BLANK, 'errorCreate');
        $this->checkEmpty($data['rewardNumber'], 'rewardNumber', REWARD_TYPE_BLANK, 'errorCreate');

        if(empty($_SESSION['errorCreate'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function validateCreateType($data){
        unset($_SESSION['errorCreate']);
        $validateStatus = false;
        $this->checkName($data['name']);

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


}