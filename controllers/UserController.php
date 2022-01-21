<?php
require_once('controllers/BaseController.php');
require_once('vendor/autoload.php');
require_once ('components/FbLoginComponent.php');
class UserController extends BaseController
{
    private $userModel;
    function __construct()
    {
        $this->folder = 'user';
        $this->userModel = new UserModel();
        $this->ValidationComponent = new ValidationComponent();
        $this->FbLoginComponent = new FbLoginComponent();
    }

    public function profile()
    {
        if(isset($_SESSION['facebook_id'])){
            $facebook_id = $_SESSION['facebook_id'];
            $user = $this->userModel->getUserByFbId($facebook_id);
            $data = [
                'user' => $user
            ];
        }
        if(isset($_SESSION['user_login'])){
            $email = $_SESSION['user_login'];
            $user = $this->userModel->getUserByEmail($email);
            $data = [
                'user' => $user
            ];
        }
       $this->render('profile', $data);
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
                $data = [
                    'email' => $_POST['email'],
                    'errors' => $validate['errors']
                ];
                $this->render('login', $data);
            } else {
                $_SESSION['user'] = [
                    'is_user_login' => true,
                    'user_login' => $email,
                ];
                redirect_to("profile");
            }

        }
        $login_url = $this->FbLoginComponent->getLoginFb();
        $data = [
            'login_url' => $login_url
        ];
        $this->render('login', $data);
    }

    public function logout(){
        unset($_SESSION['is_user_login']);
        unset($_SESSION['access_token']);
        unset($_SESSION['user_login']);
        redirect_to("/login");
    }

    public function isLoggedIn(){
        if(isset($_SESSION['is_user_login'])){
            return true;
        } else {
            return false;
        }
    }
}