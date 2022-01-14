<?php

    // include autoload file
require 'vendor/autoload.php';

$fb = new \Facebook\Facebook([
    'app_id' => '465482708377639',
    'app_secret' => '2c68a5f3c1882b39c5b713e184891817',
    'default_graph_version' => 'v12.0'
]);

$helper = $fb->getRedirectLoginHelper();
$login_url = $helper->getLoginUrl("https://paralinetraining.com/?controller=user&action=login");

try {
    $accessToken = $helper->getAccessToken();
    if(isset($accessToken)){
        $_SESSION['access_token'] = (string)$accessToken;
        redirect_to('index.php?controller=user&action=login');
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

    }catch (Exception $exc){
        echo $exc->getMessage();
    }
}
?>
