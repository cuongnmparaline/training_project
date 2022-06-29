<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/bussiness.php');
require_once('models/EmployeeModel.php');
require_once('components/validate/BussinessValidate.php');

class BussinessController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Bussiness';
        parent::__construct();
        $this->employeeModel = new EmployeeModel();
        $this->bussinessValidate = new BussinessValidate();

    }

    public function index(){
        $bussinesses = $this->model->getAll();
        $this->render('index', ['bussinesses' => $bussinesses]);
    }

    public function create(){
        $dataView = [
            'employees' => $this->employeeModel->getAll(),
            'bussinesses' => $this->model->getAll()
        ];
        if (empty($_POST)) {
            return $this->render('create', $dataView);
        }

        $validatePostData = $this->getParams();

        $validateStatus = $this->bussinessValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            $dataView['post'] = $_POST;
            return $this->render('create', $dataView);
        }

        $dataInsertBussiness = [
            'ma_cong_tac' => isset($_POST['bussinessCode']) ? $_POST['bussinessCode'] : '',
            'nhanvien_id' => isset($_POST['employee']) ? $_POST['employee'] : '',
            'ngay_bat_dau' => isset($_POST['dayStart']) ? $_POST['dayStart'] : '',
            'ngay_ket_thuc' => isset($_POST['dayEnd']) ? $_POST['dayEnd'] : '',
            'dia_diem' => isset($_POST['location']) ? $_POST['location'] : '',
            'muc_dich' => isset($_POST['purpose']) ? $_POST['purpose'] : '',
            'ghi_chu' => isset($_POST['description']) ? $_POST['description'] : '',
        ];
        if ($this->model->create($dataInsertBussiness)) {
            flash("success_message", BUSSINESS_CREATED);
            return redirect_to('/cong-tac');
        }
    }

    public function edit(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_BUSSINESS, 'alert alert-danger');
            redirect_to('/cong-tac');
        }

        $id = (int)$_GET['id'];
        $bussiness = $this->model->getById($id);
        $bussiness['employee'] = getEmployeeInfo($bussiness['nhanvien_id']);

        if (empty($bussiness)) {
            flash("error_message", CANT_FOUND_BUSSINESS, 'alert alert-danger');
            redirect_to('/cong-tac');
        }


        if (empty($_POST)) {
            return $this->render('edit', ['bussiness' => $bussiness]);
        }
        $validatePostData = $this->getParams();

        $validateStatus = $this->bussinessValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            return $this->render('edit', ['bussiness' => $bussiness]);
        }

        $dataEditBussiness = [
            'ma_cong_tac' => isset($_POST['bussinessCode']) ? $_POST['bussinessCode'] : '',
            'nhanvien_id' => isset($_POST['employee']) ? $_POST['employee'] : '',
            'ngay_bat_dau' => isset($_POST['dayStart']) ? $_POST['dayStart'] : '',
            'ngay_ket_thuc' => isset($_POST['dayEnd']) ? $_POST['dayEnd'] : '',
            'dia_diem' => isset($_POST['location']) ? $_POST['location'] : '',
            'muc_dich' => isset($_POST['purpose']) ? $_POST['purpose'] : '',
            'ghi_chu' => isset($_POST['description']) ? $_POST['description'] : '',
        ];

        if ($this->model->update($dataEditBussiness, $id)) {
            flash("success_message", BUSSINESS_UPDATED);
            redirect_to('/cong-tac');
        }
    }

    public function delete(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG, 'alert alert-danger');
        }
        $id = $_GET['id'];
        if ($this->model->delete($id)) {
            flash('success_message', BUSSINESS_REMOVED);
        }
        return redirect_to('/cong-tac');
    }

}
