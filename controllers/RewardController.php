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

        $dataInsertEmployee = [
            'ma_nv' => isset($_POST['employeeCode']) ? $_POST['employeeCode'] : '',
            'ten_nv' => isset($_POST['name']) ? $_POST['name'] : '',
            'biet_danh' => isset($_POST['nickName']) ? $_POST['nickName'] : '',
            'hon_nhan_id' => isset($_POST['marriage']) ? $_POST['marriage'] : '',
            'so_cmnd' => isset($_POST['identify']) ? $_POST['identify'] : '',
            'ngay_cap_cmnd' => isset($_POST['identify_time']) ? $_POST['identify_time'] : '',
            'noi_cap_cmnd' => isset($_POST['identify_place']) ? $_POST['identify_place'] : '',
            'quoc_tich_id' => isset($_POST['nationality']) ? $_POST['nationality'] : '',
            'ton_giao_id' => isset($_POST['religion']) ? $_POST['religion'] : '',
            'dan_toc_id' => isset($_POST['ethnic']) ? $_POST['ethnic'] : '',
            'loai_nv_id' => isset($_POST['type']) ? $_POST['type'] : '',
            'bang_cap_id' => isset($_POST['degree']) ? $_POST['degree'] : '',
            'trang_thai' => isset($_POST['status']) ? $_POST['status'] : '',
            'hinh_anh' => isset($imageName) ? $imageName : '',
            'gioi_tinh' => isset($_POST['gender']) ? $_POST['gender'] : '',
            'ngay_sinh' => isset($_POST['birthday']) ? $_POST['birthday'] : '',
            'noi_sinh' => isset($_POST['placeOfBirth']) ? $_POST['placeOfBirth'] : '',
            'nguyen_quan' => isset($_POST['domicile']) ? $_POST['domicile'] : '',
            'ho_khau' => isset($_POST['residence']) ? $_POST['residence'] : '',
            'tam_tru' => isset($_POST['tabernacle']) ? $_POST['tabernacle'] : '',
            'phong_ban_id' => isset($_POST['department']) ? $_POST['department'] : '',
            'chuc_vu_id' => isset($_POST['position']) ? $_POST['position'] : '',
            'trinh_do_id' => isset($_POST['education']) ? $_POST['education'] : '',
            'chuyen_mon_id' => isset($_POST['technique']) ? $_POST['technique'] : '',
        ];
        if ($this->employeeModel->create($dataInsertEmployee)) {
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
            flash("success_message", EMPLOYEE_CREATED);
            return redirect_to('/nhan-vien');
        }
    }
}
