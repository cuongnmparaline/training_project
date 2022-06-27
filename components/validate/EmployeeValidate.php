<?php
require_once ('components/validate/BaseValidate.php');

class EmployeeValidate extends BaseValidate {

    public function validateCreate($data){
        $validateStatus = false;

        if(!empty($data['avatar']['name']) && $data['avatar']['name'] != ''){
            $this->checkAvatar($data['avatar']);
        }

        $this->checkName($data['name']);
        $this->checkEmpty($data['marriage'], 'marriage', MARRIAGE_BLANK, 'errorCreate');
        $this->checkEmpty($data['identify'], 'identify', IDENTIFY_BLANK, 'errorCreate');
        $this->checkEmpty($data['identify_time'], 'identify_time', IDENTIFY_TIME_BLANK, 'errorCreate');
        $this->checkEmpty($data['identify_place'], 'identify_place', IDENTIFY_PLACE_BLANK, 'errorCreate');
        $this->checkEmpty($data['nationality'], 'nationality', NATIONALITY_BLANK, 'errorCreate');
        $this->checkEmpty($data['ethnic'], 'ethnic', ETHNIC_BLANK, 'errorCreate');
        $this->checkEmpty($data['type'], 'type', TYPE_BLANK, 'errorCreate');
        $this->checkEmpty($data['status'], 'status', STATUS_BLANK, 'errorCreate');
        $this->checkEmpty($data['gender'], 'gender', GENDER_BLANK, 'errorCreate');
        $this->checkEmpty($data['residence'], 'residence', RESIDENCE_BLANK, 'errorCreate');
        $this->checkEmpty($data['department'], 'department', DEPARTMENT_BLANK, 'errorCreate');
        $this->checkEmpty($data['education'], 'education', EDUCATION_BLANK, 'errorCreate');
        $this->checkEmpty($data['position'], 'position', POSITION_BLANK, 'errorCreate');

        if(empty($_SESSION['errorCreate'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function validateEdit($data){
        $validateStatus = false;

        if(!empty($data['avatar']['name']) && $data['avatar']['name'] != ''){
            $this->checkAvatar($data['avatar']);
        }

        $this->checkName($data['name']);
        $this->checkEmpty($data['marriage'], 'marriage', MARRIAGE_BLANK, 'errorEdit');
        $this->checkEmpty($data['identify'], 'identify', IDENTIFY_BLANK, 'errorEdit');
        $this->checkEmpty($data['identify_time'], 'identify_time', IDENTIFY_TIME_BLANK, 'errorEdit');
        $this->checkEmpty($data['identify_place'], 'identify_place', IDENTIFY_PLACE_BLANK, 'errorEdit');
        $this->checkEmpty($data['nationality'], 'nationality', NATIONALITY_BLANK, 'errorEdit');
        $this->checkEmpty($data['ethnic'], 'ethnic', ETHNIC_BLANK, 'errorEdit');
        $this->checkEmpty($data['type'], 'type', TYPE_BLANK, 'errorEdit');
        $this->checkEmpty($data['status'], 'status', STATUS_BLANK, 'errorEdit');
        $this->checkEmpty($data['gender'], 'gender', GENDER_BLANK, 'errorEdit');
        $this->checkEmpty($data['residence'], 'residence', RESIDENCE_BLANK, 'errorEdit');
        $this->checkEmpty($data['department'], 'department', DEPARTMENT_BLANK, 'errorEdit');
        $this->checkEmpty($data['education'], 'education', EDUCATION_BLANK, 'errorEdit');
        $this->checkEmpty($data['position'], 'position', POSITION_BLANK, 'errorEdit');

        if(empty($_SESSION['errorEdit'])){
            $validateStatus = true;
        }
        return $validateStatus;
    }

    public function checkEmpty($data, $field, $message, $type){
        if (empty($data) && $data !== '0') {
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