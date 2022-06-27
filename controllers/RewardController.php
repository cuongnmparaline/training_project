<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/employee.php');
require_once('models/RewardTypeModel.php');

class RewardController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Reward';
        parent::__construct();
        $this->rewardTypeModel = new RewardTypeModel();
    }

    public function index(){
        $rewards = $this->model->getAllReward();
        return $this->render('index', ['rewards' => $rewards]);
    }

    public function type(){

        $types = $this->rewardTypeModel->getAllRewardType();
        return $this->render('type', ['types' => $types]);
    }
}
