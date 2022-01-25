<?php
//require_once('models/UserModel.php');
require_once('components/ValidationComponent.php');
require_once('components/ValidationComponent.php');
abstract class BaseController
{
    protected $folder;
    public function __construct()
    {
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

    protected function model($model){
        require_once 'models/' . $model . '.php';
        return new $model();
    }

    protected function autoloadModel(){
        $model = $this->folder . 'Model';
        require_once 'models/' . $model . '.php';
        return new $model();
    }
}