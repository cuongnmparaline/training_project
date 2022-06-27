
<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once ('components/validate/AccountValidate.php');

class AccountController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Account';
        parent::__construct();
        $this->accountValidate = new AccountValidate();
    }

    public function detail(){
        $id = $_SESSION['account']['account_id'];
        $account = $this->model->getById($id);

        if (empty($account)) {
            flash("error_message", CANT_FOUND_ACC, 'alert alert-danger');
            redirect_to('/home');
        }
        if (empty($_POST)) {
            return $this->render('detail', ['account' => $account]);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->accountValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('detail', ['account' => $account]);
        }

        $imageName = $account['hinh_anh'];

        if(!empty($data['avatar']['name']) && $data['avatar']['name'] != ''){
            if(!empty($_FILES['avatar']['name'])){
                $target_dir = IMG_LOCATION . 'account/';
                $path = $_FILES['avatar']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $imageName = time() . "." . $ext;
                $target_file = $target_dir . $imageName;
            }
        }

        $dataEditAccount = [
            'ho' => $_POST['lastName'],
            'ten' => $_POST['firstName'],
            'hinh_anh' => $imageName,
            'email' => $_POST['email'],
            'so_dt' => $_POST['phone'],
            'quyen' => $_POST['role'],
            'trang_thai' => $_POST['status'],
        ];

        if ($this->model->update($dataEditAccount, $id)) {
            if(isset($target_file)){
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
            }
            flash("success_message", ACCOUNT_UPDATED);
            redirect_to('/tai-khoan/thong-tin');
        }

    }

    public function create(){
        $dataView = [];

        if (empty($_POST)) {
            return $this->render('create');
        }

        $validatePostData = $this->getParams();

        $validateStatus = $this->accountValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            var_dump($_SESSION);
            die;
            $dataView['post'] = $_POST;
            return $this->render('create', $dataView);
        }

        die('pass');
        $imageName = '';
        if(!empty($_FILES['avatar']['name'])){
            $target_dir = IMG_LOCATION . 'employee/';
            $path = $_FILES['avatar']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $imageName = time() . "." . $ext;
            $target_file = $target_dir . $imageName;
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
