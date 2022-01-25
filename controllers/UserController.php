<?php
require_once('controllers/BaseController.php');
require_once('vendor/autoload.php');
require_once ('components/FbLoginComponent.php');
class UserController extends BaseController
{
    function __construct()
    {
        $this->folder = 'User';
        parent::__construct();
        $this->ValidationComponent = new ValidationComponent();
        $this->FbLoginComponent = new FbLoginComponent();
    }

    public function profile()
    {
        if(isset($_SESSION['facebook_id'])){
            $facebook_id = $_SESSION['facebook_id'];
            $user = $this->model->getUserByFbId($facebook_id);
            $dataView['user'] = $user;
        }
        if(isset($_SESSION['user']['user_email'])){
            $email = $_SESSION['user']['user_email'];
            $user = $this->model->getUserByEmail($email);
            $dataView = [
                'user' => $user
            ];
        }
       $this->render('profile', $dataView);
    }

    public function login(){
        if($this->isLoggedIn()){
            redirect_to('profile');
        }

        if (isset($_POST['btn-login'])) {
            // step 1. Validate
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $validate = $this->ValidationComponent->checkLogin($email, $password, 'user');
            // step 2. check login
            if ($validate['status'] == false) {
                $dataView = [
                    'email' => $email,
                    'errors' => $validate['errors']
                ];
                $this->render('login', $dataView);
            } else {
                $_SESSION['user'] = [
                    'is_user_login' => true,
                    'user_email' => $email,
                ];
                redirect_to("profile");
            }
        }
        $login_url = $this->FbLoginComponent->getLoginFb();
        $dataView['login_url'] = $login_url;
        $this->render('login', $dataView);
    }

    public function logout(){
        unset($_SESSION['user']);
        unset($_SESSION['access_token']);
        unset($_SESSION['facebook_id']);
        redirect_to("/login");
    }

    public function isLoggedIn(){
        if(isset($_SESSION['user']['is_user_login'])){
            return true;
        } else {
            return false;
        }
    }
}