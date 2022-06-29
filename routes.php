
<?php
session_start();
ob_start();

date_default_timezone_set("Asia/Ho_Chi_Minh");
$controllers = array(
    'auth' => ['login', 'logout'],
    'home' => ['index', 'listEmployee', 'listAccount'],
    'employee' => ['index', 'create', 'edit', 'delete', 'detail', 'export',
        'department', 'editDepartment', 'deleteDepartment',
        'education', 'editEducation', 'deleteEducation',
        'position', 'editPosition', 'deletePosition',
        'technique', 'editTechnique', 'deleteTechnique',
        'degree', 'editDegree', 'deleteDegree',
        'type', 'editType', 'deleteType',
    ],
    'salary' => ['index', 'calculate', 'calculateAllowance', 'detail', 'delete', 'export'],
    'bussiness' => ['index', 'create', 'edit', 'delete'],
    'account' => ['index', 'create', 'delete', 'edit', 'detail', 'changePass'],
    'reward' => ['index', 'type', 'create', 'editType', 'edit', 'deleteType', 'delete'],
    'discipline' => ['index', 'type', 'create', 'editType', 'edit', 'deleteType', 'delete'],
    'team' => ['index', 'create', 'delete', 'edit', 'detail', 'deleteEmployee'],
    'pages' => ['home', 'error'],
); // Các controllers trong hệ thống và các action có thể gọi ra từ controller đó.

// Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
// thì trang báo lỗi sẽ được gọi ra.
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
    $controller = 'pages';
    $action = 'error';
}

if(!isset($_SESSION['account']['is_login']) && $action != 'login'){
    redirect_to('login');
}

include_once('controllers/' . $controller . 'Controller.php');
$klass = str_replace('_', '', ucwords($controller, '_')) . 'Controller';
$controller = new $klass;
$controller->$action();




