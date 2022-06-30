
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

    public function index(){
        if(!$this->checkRole()){
            return redirect_to('tai-khoan/thong-tin');
        }
        $accounts = $this->model->getAll();
        $this->render('index', ['accounts' => $accounts]);
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
        if(!$this->checkRole()){
            return redirect_to('tai-khoan/thong-tin');
        }
        $dataView = [];

        if (empty($_POST)) {
            return $this->render('create');
        }

        $validatePostData = $this->getParams();

        $validateStatus = $this->accountValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            $dataView['post'] = $_POST;
            return $this->render('create', $dataView);
        }

        $imageName = '';
        if(!empty($_FILES['avatar']['name'])){
            $target_dir = IMG_LOCATION . 'account/';
            $path = $_FILES['avatar']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $imageName = time() . "." . $ext;
            $target_file = $target_dir . $imageName;
        }

        $dataInsertAccount = [
            'ho' => $_POST['lastName'],
            'ten' => $_POST['firstName'],
            'hinh_anh' => $imageName,
            'email' => $_POST['email'],
            'so_dt' => $_POST['phone'],
            'quyen' => $_POST['role'],
            'trang_thai' => $_POST['status'],
        ];
        if ($this->model->create($dataInsertAccount)) {
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
            flash("success_message", ACCOUNT_CREATED);
            return redirect_to('/tai-khoan');
        }
    }

    public function edit(){
        if(!$this->checkRole()){
            return redirect_to('tai-khoan/thong-tin');
        }
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_ACC, 'alert alert-danger');
            return redirect_to('/tai-khoan');
        }

        $id = (int)$_GET['id'];

        $account = $this->model->getById($id);

        if (empty($account)) {
            flash("error_message", CANT_FOUND_ACC, 'alert alert-danger');
            return redirect_to('/tai-khoan');
        }
        if (empty($_POST)) {
            return $this->render('edit', ['account' => $account]);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->accountValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('education/editEducation', ['account' => $account]);
        }

        $imageName = $account['hinh_anh'];

        if(!empty($_FILES['avatar']['name'])){
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
            redirect_to('/tai-khoan');
        }
    }

    public function delete(){
        if(!$this->checkRole()){
            return redirect_to('tai-khoan/thong-tin');
        }
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG);
        }
        $id = $_GET['id'];
        if ($this->model->delete($id)) {
            flash('success_message', ACCOUNT_REMOVED);
        }
        return redirect_to('/tai-khoan');
    }

    public function changePass(){
        $id = $_SESSION['account']['account_id'];
        $account = $this->model->getById($id);

        if (empty($account)) {
            flash("error_message", CANT_FOUND_ACC, 'alert alert-danger');
            redirect_to('/home');
        }
        if (empty($_POST)) {
            return $this->render('changePass', ['account' => $account]);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->accountValidate->validateChangePass($validatePostData);
        if (!$validateStatus) {
            return $this->render('changePass', ['account' => $account]);
        }

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
            'mat_khau' => md5($_POST['password'])
        ];

        if ($this->model->update($dataEditAccount, $id)) {
            flash("success_message", PASSWORD_UPDATED);
            redirect_to('/tai-khoan/thong-tin');
        }
    }

    public function checkRole(){
        if($_SESSION['account']['role_type'] != ADMIN){
            flash("error_message", ROLE_ALERT, 'alert alert-danger');
            return false;
        }
        return true;
    }
}
