<?php
require_once ('components/validate/BaseValidate.php');

class TeamValidate extends BaseValidate {

    public function validateCreate($data){
        $validateStatus = false;
        $this->checkName($data['name']);

        if(empty($_SESSION['errorCreate'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function validateEdit($data){
        $validateStatus = false;
        $this->checkName($data['name'], 'errorEdit');

        if(empty($_SESSION['errorEdit'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function validateAddEmployee($data){
        $validateStatus = false;
        $this->checkEmpty($data['employee'], 'employee', EMPLOYEE_BLANK, 'errorCreate');

        if(empty($_SESSION['errorCreate'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

}