<?php

function set_role($role){
    if(!empty($role)){
        switch ($role) {
            case 1:
                return "Super Admin";
    break;
            case 2:
                return "Admin";
    break;
            default:
                return "Not found";
        }
    }
}

function set_status($status){
    if(!empty($status)){
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

function check_role($role){
    if($_SESSION['role_type'] == 2){
        redirect_to('/management/search-user');
        flash('user_message', 'Only Super Admin could access Admin Management! You are in User Management');
        return false;
    }
    return true;
}