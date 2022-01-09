
<?php
session_start();
ob_start();

$controllers = array(
    'admin' => ['index', 'login', 'logout', 'create', 'add_avatar', 'search', 'edit'],
    'pages' => ['home', 'error'],
    'users' => ['index', 'login'],
    'posts' => ['index']
); // Các controllers trong hệ thống và các action có thể gọi ra từ controller đó.

// Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
// thì trang báo lỗi sẽ được gọi ra.
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'pages';
    $action = 'error';
}


if(!isset($_SESSION['is_login']) && $action != 'login'){
    redirect_to('?controller=admin&action=login');
}

// Nhúng file định nghĩa controller vào để có thể dùng được class định nghĩa trong file đó
include_once('controllers/' . $controller . 'Controller.php');
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();