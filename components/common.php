<?php

require_once('models/AccountModel.php');

if (!function_exists('getAccountInfo')) {
    function getAccountInfo($email)
    {
        $accountModel = new AccountModel();
        return $accountModel->getAccountInfo($email);
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

if (!function_exists('generateCode')) {
    function generateCode($type)
    {
        switch ($type) {
            case 'department':
                return "MPB" . time();
                break;
            case 2:
                return "Banned";
                break;
            default:
                return "Not found";
        }
    }
}
