<?php

function sort_table()
{
    $sortOption = [];
    $icon = isset($_GET['sort']) && $_GET['sort'] == 'DESC' ? '-up' : '-down';
    $order = isset($_GET['order']) ? $_GET['order'] : 'id';
    $sort = isset($_GET['sort']) && $_GET['sort'] == 'DESC' ? 'ASC' : 'DESC';
    $sortOption = [
        'icon' => $icon,
        'order' => $order,
        'sort' => $sort
    ];
    return $sortOption;
}