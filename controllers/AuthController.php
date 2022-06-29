
<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once ('components/validate/AccountValidate.php');

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Auth';
        parent::__construct();
        $this->accountValidate = new AccountValidate();
    }
    // Admin Action
    public function login()
    {
        if ($this->isLoggedIn()) {
            redirect_to('home');
        }
//        Luồng rẽ nhánh: nếu người dùng đăng nhập rồi, redirect luôn về trang home
        if(empty($_POST)){
            return $this->render('login');
//            1. Hiển thị form đăng nhập
        }
//        2. Click nút đăng nhập
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? ($_POST['password']) : '';
        $admin = $this->accountValidate->checkLogin($email, $password);
//        3. Xác thực
        if (empty($admin)) {
            return $this->render('login');
//            Luồng rẽ nhánh: Quay về hiện thị form đăng nhập
        }

        $_SESSION['account'] = [
            'is_login' => true,
            'account_email' => $admin->email,
            'account_name' => $admin->ho." ".$admin->ten,
            'account_id' => $admin->id,
            'role_type' => $admin->quyen
        ];
        $access = $admin->truy_cap + 1;
        $dataEditAccount = [
            'truy_cap' => $access
        ];
        $this->model->update($dataEditAccount, $admin->id);
        redirect_to('home');
//        4. Rẽ nhánh đến trang phù hợp
    }

    public function logout()
    {
        unset($_SESSION['account']);
        redirect_to('login');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['is_admin_login'])) {
            return true;
        } else {
            return false;
        }
    }

}
