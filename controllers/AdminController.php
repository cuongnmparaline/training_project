
<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/pagging.php');
require_once('helpers/sort.php');
require_once ('components/validate/AdminValidate.php');
require_once ('components/validate/UserValidate.php');

class AdminController extends BaseController
{
    function __construct()
    {
        $this->folder = 'Admin';
        parent::__construct();
        $this->check_role();
        $this->check_page();
        $this->adminValidate = new AdminValidate();
        $this->userValidate = new UserValidate();
    }
    // Admin Action
    public function login()
    {
        if ($this->isLoggedIn()) {
            redirect_to('search');
        }
        if(empty($_POST)){
           return $this->render('login');
        }
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? ($_POST['password']) : '';
        $admin = $this->adminValidate->checkLogin($email, $password, 'admin');
        // step 2. check login
        if (empty($admin)) {
            flash_error('errorLogin', 'account', ST_WRONG);
            return $this->render('login');
        }
        $_SESSION['admin'] = [
            'is_admin_login' => true,
            'admin_login' => $admin->email,
            'admin_id' => $admin->id,
            'role_type' => $admin->role_type
        ];
        if($this->isSuperAdmin()){
            redirect_to('search');
        } else {
            redirect_to('search-user');
        }
    }

    public function logout()
    {
        unset($_SESSION['admin']);
        redirect_to('/management/login');
    }

    public function search()
    {
        $fields = ['id', 'avatar', 'name', 'email', 'role_type'];
        $totalAdmins = $this->model->get($fields);
        $numPerPage = NUM_PER_PAGE;
        $adminNumber = count($totalAdmins);
        $totalNumberPage = ceil($adminNumber / $numPerPage);
        $conditionSearch = $_GET;
        $listAdmin = $this->model->pagging($conditionSearch);
        $dataView = [
            'admins' => $listAdmin,
            'getData' => isset($_GET) ? $_GET : [],
            'totalNumberPage' => $totalNumberPage
        ];
        // step 2. set data to view
        $this->render('search', $dataView);
    }

    public function create()
    {
        if (empty($_POST)) {
            return $this->render('create');
        }
        $validatePostData = [
            'post' => $_POST,
            'file' => $_FILES,
        ];
        $validate = $this->adminValidate->validateCreate($validatePostData);
        if (!$validate['status']) {
            return $this->render('create', $_POST);
        } else {
            $admin = $validate['admin'];
            if ($this->model->create($admin)) {
                flash("admin_message", ADMIN_CREATED);
                redirect_to('/management/search');
            }
        }
    }

    public function edit()
    {
        if (!isset($_GET['id'])) {
            flash("admin_message", CANT_FOUND_ACC);
            redirect_to('/management/search');
        }
        $id = (int)$_GET['id'];
        $fields = ['id', 'avatar', 'name', 'password', 'email', 'role_type'];
        $admin = $this->model->getById($fields, $id);
        if (empty($admin)) {
            flash("error_message", CANT_FOUND_ACC);
        }
        if (empty($_POST)) {
            return $this->render('edit', $admin);
        }
        $validatePostData = [
            'admin' => $admin,
            'post' => $_POST,
            'file' => $_FILES
        ];
        $validate = $this->adminValidate->validateEdit($validatePostData);
        if (!$validate['status']) {
            return $this->render('edit', $admin);
        }
        $admin = $validate['admin'];
        if ($this->model->update($admin, $id)) {
            flash("admin_message", ADMIN_UPDATED);
            redirect_to('/management/search');
        }

    }

    public function delete()
    {
        if (!isset($_GET['id'])) {
            flash('admin_message', ST_WRONG, 'alert alert-success');
        }
        $id = $_GET['id'];
        if ($this->model->delete($id)) {
            flash('admin_message', ADMIN_REMOVED);
        }
        redirect_to('/management/search');
    }

    // UserModel Action
    function add_avatar()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // Create file dir
            $target_dir = IMG_LOCATION;
            $target_file = $target_dir . basename($_FILES['file']['name']);
            // Check format image
            $type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
            if (!in_array(strtolower($type_file), $type_fileAllow)) {
                $error = FORMAT_FILE_ERROR;
            }
            // Check file size
            $size_file = $_FILES['file']['size'];
            if ($size_file > MAX_FILE_SIZE) {
                $error = SIZE_FILE_ERROR;
            }
            // Check file existed
//            if (file_exists($target_file)) {
//                $error['file'] = "File existed";
//            }
            // Conclude
            if (empty($error)) {
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                    $flag = true;
                    echo json_encode(array('status' => 'true','file_path' => $target_file));
                } else {
                    echo json_encode(array('status' => 'error'));
                }
            } else {
                echo json_encode(
                    array('status' => 'error', 'error' => $error)
                );
            }
        }
    }

    // UserModel function

    public function search_user()
    {
        $fields = ['id', 'avatar', 'name', 'email', 'status'];
        $totalUsers = $this->userModel->get($fields);
        $numPerPage = NUM_PER_PAGE;
        $userNumber = count($totalUsers);
        $totalNumberPage = ceil($userNumber / $numPerPage);
        $conditionSearch = $_GET;
        $listUser = $this->userModel->pagging($conditionSearch);
        $dataView = [
            'users' => $listUser,
            'getData' => isset($_GET) ? $_GET : [],
            'totalNumberPage' => $totalNumberPage
        ];
        // step 2. set data to view
        $this->render('search_user', $dataView);
    }

    public function create_user()
    {
        if (empty($_POST)) {
            return $this->render('create_user');
        }
        $validatePostData = [
            'post' => $_POST,
            'file' => $_FILES,
        ];
        $validate = $this->userValidate->validateCreate($validatePostData);
        if (!$validate['status']) {
            return $this->render('create_user', $_POST);
        } else {
            $user = $validate['user'];
            if ($this->userModel->create($user)) {
                flash("user_message", USER_CREATED);
                redirect_to('/management/search-user');
            }
        }

    }

    public function edit_user()
    {
        if (!isset($_GET['id'])) {
            flash("user_message", CANT_FOUND_ACC);
            redirect_to('/management/search-user');
        }
        $id = (int)$_GET['id'];
        $fields = ['id', 'avatar', 'name', 'password', 'email', 'status'];
        $user = $this->userModel->getById($fields, $id);
        if (empty($user)) {
            flash("error_message", CANT_FOUND_ACC);
        }
        if (empty($_POST)) {
            return $this->render('edit_user', $user);
        }
        $validatePostData = [
            'user' => $user,
            'post' => $_POST,
            'file' => $_FILES
        ];
        $validate = $this->userValidate->validateEdit($validatePostData);
        if (!$validate['status']) {
           return $this->render('edit_user', $user);
        }
        $user = $validate['user'];
        if ($this->userModel->update($user, $id)) {
            flash("user_message", USER_UPDATED);
            redirect_to('/management/search-user');
        }

    }

    public function delete_user()
    {
        if (!isset($_GET['id'])) {
            flash('user_message', ST_WRONG, 'alert alert-danger');
        }
        $id = $_GET['id'];
        if ($this->userModel->delete($id)) {
            flash('user_message', USER_REMOVED);
        }
        redirect_to('/management/search-user');
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['is_admin_login'])) {
            return true;
        } else {
            return false;
        }
    }

    public function check_role()
    {
        $adminCanNotAccess = ['search', 'create', 'edit', 'delete'];
        if (!$this->isSuperAdmin() && in_array($_GET['action'], $adminCanNotAccess)) {
            flash("user_message", ROLE_ALERT);
            redirect_to('/management/search-user');
        }
    }

    public function isSuperAdmin(){
        if(isset($_SESSION['admin']['role_type']) && $_SESSION['admin']['role_type'] == SUPER_ADMIN){
            return true;
        }
        return false;
    }

    public function check_page()
    {
        $page = isset($_GET['action']) ? $_GET['action'] : '';
        $adminPage = ['search', 'create', 'edit', 'delete'];
        if (!empty($page)) {
            if (in_array($page, $adminPage)) {
                $_SESSION['current_page'] = 'search';
            } else {
                $_SESSION['current_page'] = 'search_user';
            }
        }
    }
}
