<?php

require_once('models/AccountModel.php');
require_once('helpers/account.php');

if (!function_exists('getAccountInfo')) {
    function getAccountInfo($id)
    {
        $accountModel = new AccountModel();
        return $accountModel->getById($id);
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
            default:
                return "Not found";
        }
    }
}
