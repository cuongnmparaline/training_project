<?php

function setRole($role)
{
    switch ($role) {
        case 1:
            return "<span class='label label-primary'>Quản trị viên</span>";
            break;
        case 0:
            return "<span class='label label-info'>Nhân viên</span>";
            break;
        default:
            return "";
    }
}

function setAccountStatus($status)
{
    switch ($status) {
        case 1:
            return "<span class='label label-success'>Đang hoạt động</span>";
            break;
        case 0:
            return "<span class='label label-danger'>Ngưng hoạt động</span>";
            break;
        default:
            return "Not found";
    }
}

function setAccountGender($gender)
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

