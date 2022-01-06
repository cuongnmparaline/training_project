<?php

function form_error($label_field){
    global $error;
    if(!empty($error[$label_field])) return "<p class='error'>{$error[$label_field]}</p>";
}

function is_email($email){
    $pattern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (!preg_match($pattern, $_POST['email'], $matchs)) {
        return false;
    } else {
        return true;
    }
}

function is_password($password){
    $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if (!preg_match($partten, $_POST['password'], $matchs)) {
        return false;
    } else {
       return true;
    }
}