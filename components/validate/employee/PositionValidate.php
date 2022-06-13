<?php
require_once('components/validate/employee/BaseEmployeeValidate.php');

class PositionValidate extends BaseEmployeeValidate {

    public function validateCreate($data){
        $validateStatus = false;
        $this->checkName($data['name']);
        $this->checkSalary($data['salary']);

        if(empty($_SESSION['errorCreate'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function validateEdit($data){
        $validateStatus = false;
        $this->checkName($data['name'], 'errorEdit');
        $this->checkSalary($data['salary']);

        if(empty($_SESSION['errorEdit'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }
}