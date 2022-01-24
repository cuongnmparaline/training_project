
<?php
session_start();
ob_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");
$controllers = array(
    'admin' => ['search', 'login', 'logout', 'create', 'add_avatar',
        'search', 'edit', 'delete', 'create_user', 'search_user',
        'edit_user', 'delete_user'],
    'pages' => ['home', 'error'],
    'user' => ['index', 'login', 'logout', 'profile']
); // Các controllers trong hệ thống và các action có thể gọi ra từ controller đó.

// Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
// thì trang báo lỗi sẽ được gọi ra.
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'pages';
    $action = 'error';
}
if($controller == 'admin'){
    if(!isset($_SESSION['admin']['is_admin_login']) && $action != 'login'){
        redirect_to('/management/login');
    }
}
//
//if($controller == 'user'){
//    if(!isset($_SESSION['user']['is_user_login']) && $action != 'login'){
//        redirect_to('/login');
//    }
//}

// Nhúng file định nghĩa controller vào để có thể dùng được class định nghĩa trong file đó
include_once('controllers/' . $controller . 'Controller.php');
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();




