<?php

function check_role($role){
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