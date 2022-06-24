<?php

function getBussinessStatus($dayStart, $dayEnd){
    $currentDay = date("Y-m-d H:i:s");
    if($currentDay > $dayStart && $currentDay < $dayEnd){
        return '<td><span class="badge bg-blue"> Đang công tác </span></td>';
    } else if($currentDay < $dayStart && $currentDay < $dayEnd){
        return '<td><span class="badge bg-yellow"> Đang chờ </span></td>';
    } else if($currentDay > $dayStart && $currentDay > $dayEnd ){
        return '<td><span class="badge bg-red"> Đã hết hạn </span></td>';
    }

}