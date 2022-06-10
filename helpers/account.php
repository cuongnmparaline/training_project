<?php

function setRole($role)
{
    switch ($role) {
        case 1:
            return "Quản trị viên";
            break;
        case 0:
            return "Nhân viên";
            break;
        default:
            return "";
    }
}

function set_status($status)
{
    if (!empty($status)) {
        switch ($status) {
            case 1:
                return "Active";
                break;
            case 2:
                return "Banned";
                break;
            default:
                return "Not found";
        }
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

function getFullName($firstName, $lastName)
{
    return $firstName . " " . $lastName;
}

