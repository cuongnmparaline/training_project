
<?php
require_once('controllers/BaseController.php');

class PagesController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'pages';
    }

    public function error()
    {
        $this->render('error');
    }
}