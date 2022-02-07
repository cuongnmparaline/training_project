<?php
require_once('models/UserModel.php');
abstract class BaseController
{
    protected $folder;
    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->model = $this->autoloadModel();
    }

    protected function render($file, $data = array())
    {
        $view_file = 'views/' . $this->folder . '/' . $file . '.php';
        if (is_file($view_file)) {
            extract($data);
            ob_start();
            require_once($view_file);
            $content = ob_get_clean();
            require_once('views/layouts/application.php');
        } else {
            header('Location: search.php?controller=pages&action=error');
        }
    }

    protected function loadModel($model){
        require_once 'models/' . $model . '.php';
        return new $model();
    }

    protected function autoloadModel(){
        $model = $this->folder . 'Model';
        require_once 'models/' . $model . '.php';
        return new $model();
    }

    protected function getParams(){
        $data = !empty($_POST) ? $_POST : '';
        $data['avatar'] = isset($_FILES) ? $_FILES : '';
        return $data;
    }
}