<?php
require_once('models/employee/PositionModel.php');
require_once('models/employee/DepartmentModel.php');

function setStatus($status)
{
    switch ($status) {
        case WORKING:
            return "<span class='badge bg-blue'> Đang làm việc </span>";
            break;
        case RETIRED:
            return "<span class='badge bg-red'> Đã nghỉ việc </span>";
            break;
        default:
            return "";
    }
}

function setGender($gender)
{
    switch ($gender) {
        case 1:
            return "Nam";
            break;
        case 0:
            return "Nữ";
            break;
        default:
            return "";
    }
}

function getPosition($positionId){
    $positionModel = new PositionModel();
    $position = $positionModel->getById($positionId);
    return $position['ten_chuc_vu'];
}

function getDepartment($departmentId){
    $departmentModel = new DepartmentModel();
    $department = $departmentModel->getById($departmentId);
    return $department['ten_phong_ban'];
}