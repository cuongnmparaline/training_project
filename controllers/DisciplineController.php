<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/employee.php');
require_once('models/DisciplineTypeModel.php');
require_once('models/EmployeeModel.php');
require_once('components/validate/DisciplineValidate.php');

class DisciplineController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Discipline';
        parent::__construct();
        $this->disciplineTypeModel = new DisciplineTypeModel();
        $this->employeeModel = new EmployeeModel();
        $this->disciplineValidate = new DisciplineValidate();
    }

    public function index(){
        $disciplines = $this->model->getAllDiscipline();
        return $this->render('index', ['disciplines' => $disciplines]);
    }

    public function type(){
        $types = $this->disciplineTypeModel->getAllDisciplineType();
        if (empty($_POST)) {
            return $this->render('type', ['types' => $types]);
        }

        $validatePostData = $this->getParams();

        $validateStatus = $this->disciplineValidate->validateCreateType($validatePostData);
        if (!$validateStatus) {
            $dataView['post'] = $_POST;
            return $this->render('type', $dataView);
        }

        $dataInsertTypeReward = [
            'ma_loai' => $_POST['disciplineTypeCode'],
            'ten_loai' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
            'flag' => 0,
        ];

        if ($this->disciplineTypeModel->create($dataInsertTypeReward)) {
            flash("success_message", DISCIPLINE_TYPE_CREATED);
            return redirect_to('/ky-luat/loai-ky-luat');
        }

    }

    public function create(){
        $dataView = [
            'employees' => $this->employeeModel->getAll(),
            'disciplines' => $this->model->getAllDiscipline(),
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
            'so_qd' => $_POST['decisionNumber'],
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

    public function edit(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_REWARD, 'alert alert-danger');
            redirect_to('/khen-thuong/them-khen-thuong');
        }

        $id = (int)$_GET['id'];

        $reward = $this->model->getById($id);

        if (empty($reward)) {
            flash("error_message", CANT_FOUND_REWARD, 'alert alert-danger');
            redirect_to('/khen-thuong/them-khen-thuong');
        }
        $dataView = [
            'employees' => $this->employeeModel->getAll(),
            'rewardTypes' => $this->rewardTypeModel->getAllRewardType(),
            'reward' => $reward,
        ];

        if (empty($_POST)) {
            return $this->render('edit', $dataView);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->rewardValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            return $this->render('editType', $dataView);
        }

        $dataUpdateReward = [
            'ma_kt' => $_POST['rewardCode'],
            'so_qd' => $_POST['decisionNumber'],
            'ngay_qd' => $_POST['decisionDay'],
            'ten_khen_thuong' => $_POST['name'],
            'nhanvien_id' => $_POST['employee'],
            'loai_kt_id' => (int)$_POST['rewardType'],
            'hinh_thuc' => $_POST['form'],
            'so_tien' => $_POST['rewardNumber'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->model->update($dataUpdateReward, $id)) {
            flash("success_message", REWARD_UPDATED);
            redirect_to('/khen-thuong/them-khen-thuong');
        }
    }

    public function delete(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG, 'alert alert-danger');
        }
        $id = $_GET['id'];
        if ($this->model->delete($id)) {
            flash('success_message', REWARD_REMOVED);
        }
        return redirect_to('/khen-thuong/them-khen-thuong');
    }

    public function editType(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_REWARD_TYPE, 'alert alert-danger');
            redirect_to('/ky-luat/loai-ky-luat');
        }

        $id = (int)$_GET['id'];
        $disciplineType = $this->disciplineTypeModel->getById($id);
        if (empty($disciplineType)) {
            flash("error_message", CANT_FOUND_DISCIPLINE_TYPE, 'alert alert-danger');
            redirect_to('/ky-luat/loai-ky-luat');
        }


        if (empty($_POST)) {
            return $this->render('editType', ['disciplineType' => $disciplineType]);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->disciplineValidate->validateCreateType($validatePostData);
        if (!$validateStatus) {
            return $this->render('editType', ['disciplineType' => $disciplineType]);
        }

        $dataEditRewardType = [
            'ten_loai' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->disciplineTypeModel->update($dataEditRewardType, $id)) {
            flash("success_message", DISCIPLINE_TYPE_UPDATED);
            redirect_to('/ky-luat/loai-ky-luat');
        }
    }

    public function deleteType(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG, 'alert alert-danger');
        }
        $id = $_GET['id'];
        if ($this->disciplineTypeModel->delete($id)) {
            flash('success_message', DISCIPLINE_TYPE_REMOVED);
        }
        return redirect_to('/ky-luat/loai-ky-luat');
    }
}
