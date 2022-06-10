
<?php
require_once('database.php');
require_once('config/messages.php');
require_once ('helpers/message.php');
require_once ('helpers/url.php');
require_once('config/config.php');
require_once('config/const.php');
require_once('components/common.php');


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