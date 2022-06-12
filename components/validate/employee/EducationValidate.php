<?php
require_once('components/validate/employee/BaseEmployeeValidate.php');

class EducationValidate extends BaseEmployeeValidate {

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

}