
<?php
require_once('database.php');
require_once('assets/helper/url.php');
require_once('assets/libraries/notific.php');
require_once('assets/libraries/config.php');


if (isset($_GET['controller'])) {
    $controller = $_GET['controller'];
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'index';
    }
} else {
    $controller = 'user';
    $action = 'profile';
}

require_once('routes.php');