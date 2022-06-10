<?php


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