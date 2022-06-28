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
        $validateStatus = $this->employeeValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('edit', $dataView);
        }

        $imageName = $employee['hinh_anh'];

        if(!empty($data['avatar']['name']) && $data['avatar']['name'] != ''){
            if(!empty($_FILES['avatar']['name'])){
                $target_dir = IMG_LOCATION . 'employee/';
                $path = $_FILES['avatar']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $imageName = time() . "." . $ext;
                $target_file = $target_dir . $imageName;
            }
        }

        $dataEditEmployee = [
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

        if ($this->employeeModel->update($dataEditEmployee, $id)) {
            if(isset($target_file)){
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
            }
            flash("success_message", EMPLOYEE_UPDATED);
            redirect_to('/nhan-vien');
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
