<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/employee.php');
require_once('models/RewardTypeModel.php');
require_once('models/EmployeeModel.php');
require_once('components/validate/RewardValidate.php');

class RewardController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Reward';
        parent::__construct();
        $this->rewardTypeModel = new RewardTypeModel();
        $this->employeeModel = new EmployeeModel();
        $this->rewardValidate = new RewardValidate();
    }

    public function index(){
        $rewards = $this->model->getAllReward();
        return $this->render('index', ['rewards' => $rewards]);
    }

    public function type(){
        $types = $this->rewardTypeModel->getAllRewardType();
        if (empty($_POST)) {
            return $this->render('type', ['types' => $types]);
        }

        $validatePostData = $this->getParams();

        $validateStatus = $this->rewardValidate->validateCreateType($validatePostData);
        if (!$validateStatus) {
            $dataView['post'] = $_POST;
            return $this->render('type', $dataView);
        }

        $dataInsertTypeReward = [
            'ma_loai' => $_POST['rewardTypeCode'],
            'ten_loai' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
            'flag' => 1,
        ];

        if ($this->rewardTypeModel->create($dataInsertTypeReward)) {
            flash("success_message", REWARD_TYPE_CREATED);
            return redirect_to('/khen-thuong/loai-khen-thuong');
        }

    }

    public function create(){
        $dataView = [
            'employees' => $this->employeeModel->getAll(),
            'rewards' => $this->model->getAllReward(),
        ];

        if (empty($_POST)) {
            return $this->render('create', $dataView);
        }

        $validatePostData = $this->getParams();

        $validateStatus = $this->rewardValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            $dataView['post'] = $_POST;
            return $this->render('create', $dataView);
        }
        $dataInsertReward = [
            'ma_kt' => $_POST['rewardCode'],
            'so_qd' => 'DHK/'.$_POST['decisionNumber'],
            'ngay_qd' => $_POST['decisionDay'],
            'ten_khen_thuong' => $_POST['name'],
            'nhanvien_id' => $_POST['employee'],
            'loai_kt_id' => (int)$_POST['rewardType'],
            'hinh_thuc' => $_POST['form'],
            'so_tien' => $_POST['rewardNumber'],
            'ghi_chu' => $_POST['description'],
            'flag' => 1,
        ];
        if ($this->model->create($dataInsertReward)) {
            flash("success_message", REWARD_CREATED);
            return redirect_to('/khen-thuong/them-khen-thuong');
        }
    }
}
