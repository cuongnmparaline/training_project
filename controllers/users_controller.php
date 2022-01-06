

<?php
require_once('controllers/base_controller.php');

class UsersController extends BaseController
{
    function __construct()
    {
        $this->folder = 'users';
    }

    public function login()
    {
        $this->render('login');
    }

    public function index(){
        echo "Trang chu";



    }

}