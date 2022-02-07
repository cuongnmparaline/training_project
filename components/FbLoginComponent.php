<?php
require_once ('models/UserModel.php');
class FbLoginComponent{

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getLoginFb(){
        $fb = new \Facebook\Facebook([
            'app_id' => API_ID,
            'app_secret' => APP_SECRET,
            'default_graph_version' => 'v12.0'
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $baseUrl = BASE_URL;
        $login_url = $helper->getLoginUrl("{$baseUrl}/?controller=user&action=login");

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
                    $_SESSION['user']['is_user_login'] = true;
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
                        'ins_datetime' => date(DATE_FORMAT)
                    ];
                    if($this->userModel->create($data_insert)){
                        $_SESSION['user']['is_user_login'] = true;
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

        return $login_url;
    }
}

?>