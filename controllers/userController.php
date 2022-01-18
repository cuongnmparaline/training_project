<?php
require_once('controllers/baseController.php');
require_once('vendor/autoload.php');

class UserController extends BaseController
{
    private $userModel;
    function __construct()
    {
        $this->folder = 'user';
        $this->userModel = new User();
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
        global $error, $email;
        if (isset($_POST['btn-login'])) {
            $error = [];
            # Check email
            if (empty($_POST['email'])) {
                $error['email'] = EMAIL_BLANK;
            }
            if (!is_email($_POST['email'])) {
                $error['email'] = EMAIL_VALIDATE;
            } else {
                $email = $_POST['email'];
            }

            # Check password
            if (empty($_POST['password'])) {
                $error['password'] = PASS_BLANK;
            }
            if (!is_password($_POST['password'])) {
                $error['password'] = PASS_VALIDATE;
            } else {
                $password = md5($_POST['password']);
            }

            # Conclude
            if (empty($error)) {
                if ($this->userModel->checkLogin($email, $password)) {
                    $_SESSION['is_user_login'] = true;
                    $_SESSION['user_login'] = $email;
                    redirect_to("/profile");
                } else {
                    $error['account'] = ACCOUNT_INCORRECT;
                }
            }
        }

        $fb = new \Facebook\Facebook([
            'app_id' => API_ID,
            'app_secret' => APP_SECRET,
            'default_graph_version' => 'v12.0'
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $login_url = $helper->getLoginUrl("https://paralinetraining.com/?controller=user&action=login");

        try {
            $accessToken = $helper->getAccessToken();
            if(isset($accessToken)){
                $_SESSION['access_token'] = (string)$accessToken;
                redirect_to('/login');
            }
        }catch (Exception $exc){
            echo $exc->getMessage();
        }

        if(isset($_SESSION['access_token'])){
            try {
                $fb->setDefaultAccessToken($_SESSION['access_token']);
                $response = $fb->get("/me?fields=id, name, email, picture.type(large)", $accessToken);
                $user = $response->getGraphUser();
                $picture_url = $user->getPicture()->getUrl();
                $name = $user['name'];
                $email = $user['email'];
                $facebook_id = $user['id'];

                if($this->userModel->checkFbIdExisted($facebook_id)){
                    $_SESSION['is_user_login'] = true;
                    $_SESSION['facebook_id'] = $facebook_id;
                    redirect_to('/profile');
                } else {
                    $data_insert = [
                        'name' => $name,
                        'facebook_id' => $facebook_id,
                        'avatar' => $picture_url,
                        'email' => $email,
                        'status' => 1,
                        'ins_id' => 0,
                        'ins_datetime' => date('d/m/yy')
                    ];
                    if($this->userModel->add($data_insert)){
                        $_SESSION['is_user_login'] = true;
                        $_SESSION['facebook_id'] = $facebook_id;
                        redirect_to('/profile');
                    } else {
                        flash('user_message', ST_WRONG, 'alert alert-success');
                    }
                }
            }catch (Exception $exc){
                echo $exc->getMessage();
            }
        }
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