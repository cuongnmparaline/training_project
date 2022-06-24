<?php

require_once('models/AccountModel.php');
require_once('models/employee/EmployeeModel.php');
require_once('models/employee/PositionModel.php');
require_once('models/DetailTeamModel.php');
require_once('helpers/account.php');

if (!function_exists('getAccountInfo')) {
    function getAccountInfo($id)
    {
        $accountModel = new AccountModel();
        return $accountModel->getById($id);
    }
}

if (!function_exists('getEmployeeInfo')) {
    function getEmployeeInfo($id)
    {
        $employeeModel = new EmployeeModel();
        return $employeeModel->getById($id);
    }
}

if (!function_exists('getPositionInfo')) {
    function getPositionInfo($id)
    {
        $positionModel = new PositionModel();
        return $positionModel->getById($id);
    }
}


if (!function_exists('getPage')) {
    function getPage()
    {
        if (isset($_GET['controller']) && isset($_GET['action'])) {
            return [
                'controller' => $_GET['controller'],
                'action' => $_GET['action']
            ];
        }
    }
}

if (!function_exists('getInsertedName')) {
    function getInsertedName($id)
    {
        if(!empty($id)){
            $account = getAccountInfo($id);
            return getFullName($account['ho'], $account['ten']);
        }
        return  "";
    }
}

if (!function_exists('generateCode')) {
    function generateCode($type)
    {
        switch ($type) {
            case 'employee':
                return "MNV" . time();
                break;
            case 'department':
                return "MPB" . time();
                break;
            case 'position':
                return "MCV" . time();
                break;
            case 'education':
                return "MTD" . time();
                break;
            case 'technique':
                return "MCM" . time();
                break;
            case 'degree':
                return "MBC" . time();
                break;
            case 'type':
                return "LNV" . time();
                break;
            case 'salary':
                return "ML" . time();
                break;
            case 'bussiness':
                return "MCT" . time();
                break;
            case 'team':
                return "GRP" . time();
                break;
            default:
                return "Not found";
        }
    }
}

if (!function_exists('getEmployeeNameById')) {
    function getEmployeeNameById($id)
    {
        if(!empty($id)){
            $account = getEmployeeInfo($id);
            return $account['ten_nv'];
        }
        return  "";
    }
}

if (!function_exists('getEmployeePositionById')) {
    function getEmployeePositionById($id)
    {
        if(!empty($id)){
            $positionModel = new PositionModel();
            $position = $positionModel->getByEmployeeId($id);
            return $position['ten_chuc_vu'];
        }
        return  "";
    }
}

if (!function_exists('getNumberEmployeeByTeamId')) {
    function getNumberEmployeeByTeamId($teamCode)
    {
        if(!empty($teamCode)){
            $detailTeam = new DetailTeamModel();
            $teams = $detailTeam->getNumEmployeeByTeamCode($teamCode);
            return $teams['numberEmployee'];
        }
        return  "";
    }
}


