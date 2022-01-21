
<?php
require_once('controllers/BaseController.php');
require_once('models/AdminModel.php');
require_once('helpers/url.php');
require_once('helpers/account.php');
require_once('helpers/pagging.php');
require_once('helpers/sort.php');

class AdminController extends BaseController
{
    private $adminModel;
    private $userModel;

    function __construct()
    {
        $this->check_role();
        $this->folder = 'admin';
        $this->adminModel = new AdminModel();
        $this->userModel = new UserModel();
        $this->ValidationComponent = new ValidationComponent();
    }

    // Admin Action
    public function login()
    {
        if($this->isLoggedIn()){
            redirect_to('search');
        }
        if (isset($_POST['btn-login'])) {
            // step 1. Validate
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $validate = $this->ValidationComponent->checkLogin($email, $password);
            // step 2. check login
            if ($validate['status'] == false) {
                $data = [
                    'email' => $_POST['email'],
                    'errors' => $validate['errors']
                ];
                $this->render('login', $data);
            } else {
                $admin = $this->adminModel->getCurrentAdmin($email, $password);
                $_SESSION['admin'] = [
                    'is_admin_login' => true,
                    'admin_login' => $admin->email,
                    'admin_id' => $admin->id,
                    'role_type' => $admin->role_type
                ];
                redirect_to('search');
            }
        }
        $this->render('login');
    }

    public function logout(){
        unset($_SESSION['admin']);
        redirect_to('/management/login');
    }

    public function search()
    {
        $this->check_role();
        $_SESSION['current_page'] = 'search';
        $fields = ['id', 'avatar', 'name', 'email', 'role_type'];
        $totalAdmins = $this->adminModel->get($fields);
        $numPerPage = NUM_PER_PAGE;
        $adminNumber = count($totalAdmins);
        $totalNumberPage = ceil($adminNumber/$numPerPage);
        $conditionSearch = $_GET;
        $listAdmin = $this->adminModel->pagging($conditionSearch);
        $data = [
            'admins' => $listAdmin,
            'name' => isset($_GET['name']) ? $_GET['name'] :"",
            'email' => isset($_GET['email']) ? $_GET['email'] :"",
            'page' => isset($_GET['page_id']) ? $_GET['page_id'] : 1,
            'totalNumberPage' => $totalNumberPage
        ];
        // step 2. set data to view
        $this->render('search', $data);
    }

    public function create()
    {
        $_SESSION['current_page'] = 'search';
        if(isset($_POST['btn-add-admin'])){
            $data = [
                'post' => $_POST,
                'file' => $_FILES,
            ];
            $validate = $this->ValidationComponent->ValidateCreateAdmin($data);
            if($validate['status'] == false){
                $data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'role_type' => isset($_POST['role']) ? $_POST['role'] : '',
                    'errors' => $validate['errors']
                ];
                $this->render('create', $data);
            } else {
                $admin = $validate['admin'];
                if($this->adminModel->create($admin)){
                    flash("admin_message", ADMIN_CREATED);
                    redirect_to('/management/search');
                }
            }
        }
        $this->render('create');

    }

    public function edit(){
        $_SESSION['current_page'] = 'search';
        if (!isset($_GET['id'])) {
            flash("admin_message", CANT_FOUND_ACC);
            redirect_to('/management/search');
        }
        $id = (int)$_GET['id'];
        $fields = ['id', 'avatar', 'name', 'password', 'email', 'role_type'];
        $admin = $this->adminModel->getById($fields, $id);
        if (empty($admin)) {
            flash("error_message", CANT_FOUND_ACC);
            $this->render('edit');
        } else {
            $data = ['admin' => $admin];
            $this->render('edit', $data);
        }

        if(isset($_POST['btn-update-admin'])){
            $data = [
                'admin' => $admin,
                'post' => $_POST,
                'file' => $_FILES
            ];

            $validate = $this->ValidationComponent->ValidateEditAdmin($data);
            if($validate['status'] == false){
                $data = [
                    'admin' => $admin,
                    'errors' => $validate['errors']
                ];
                $this->render('edit', $data);
            } else {
                $admin = $validate['admin'];
                if($this->adminModel->update($admin, $id)){
                    flash("admin_message", ADMIN_UPDATED);
                    redirect_to('/management/search');
                }
            }
        }
    }

    public function delete(){
        $_SESSION['current_page'] = 'search';
        if (!isset($_GET['id'])) {
            flash('admin_message', ST_WRONG, 'alert alert-success');
            return false;
        }
        $id = $_GET['id'];
        if ($this->adminModel->delete($id)) {
            flash('admin_message', ADMIN_REMOVED);
            redirect_to('/management/search');
        }
    }

    // UserModel Action
    function add_avatar()
    {
        // Count total files
        $countfiles = count($_FILES['files']['name']);
        // Upload directory
        $upload_location = IMG_LOCATION;
        // To store uploaded files path
        $files_arr = [];
        // Loop all files
        for ($index = 0; $index < $countfiles; $index++) {
            if (isset($_FILES['files']['name'][$index]) && $_FILES['files']['name'][$index] != '') {
                // File name
                $filename = $_FILES['files']['name'][$index];

                // Get extension
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                // Valid image extension
                $valid_ext = array("png", "jpeg", "jpg");

                // Check extension
                if (in_array($ext, $valid_ext)) {
                    // File path
                    $path = $upload_location . $filename;

                    // Upload file
                    if (move_uploaded_file($_FILES['files']['tmp_name'][$index], $path)) {
                        $files_arr[] = $path;
                    }
                }
            }
        }
        echo json_encode($files_arr);
    }

    // UserModel function

    public function search_user(){
        $_SESSION['current_page'] = 'search_user';
        $fields = ['id', 'avatar', 'name', 'email', 'status'];
        $totalUsers = $this->userModel->get($fields);
        $numPerPage = NUM_PER_PAGE;
        $userNumber = count($totalUsers);
        $totalNumberPage = ceil($userNumber/$numPerPage);
        $conditionSearch = $_GET;
        $listUser = $this->userModel->pagging($conditionSearch);
        $data = [
            'users' => $listUser,
            'name' => isset($_GET['name']) ? $_GET['name'] :"",
            'email' => isset($_GET['email']) ? $_GET['email'] :"",
            'page' => isset($_GET['page_id']) ? $_GET['page_id'] : 1,
            'totalNumberPage' => $totalNumberPage
        ];
        // step 2. set data to view
        $this->render('search_user', $data);
    }

    public function create_user(){
        $_SESSION['current_page'] = 'search_user';
        if(isset($_POST['btn-add-user'])){
            $data = [
                'post' => $_POST,
                'file' => $_FILES,
            ];
            $validate = $this->ValidationComponent->ValidateCreateUser($data);
            if($validate['status'] == false){
                $data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'status' => isset($_POST['status']) ? $_POST['status'] : '',
                    'errors' => $validate['errors']
                ];
                $this->render('create_user', $data);
            } else {
                $user = $validate['user'];
                if($this->userModel->create($user)){
                    flash("user_message", USER_CREATED);
                    redirect_to('/management/search-user');
                }
            }
        }
        $this->render('create_user');
    }

    public function edit_user(){
        $_SESSION['current_page'] = 'search_user';
        if (!isset($_GET['id'])) {
            flash("user_message", CANT_FOUND_ACC);
            redirect_to('/management/search-user');
        }
        $id = (int)$_GET['id'];
        $fields = ['id', 'avatar', 'name', 'password', 'email', 'status'];
        $user = $this->userModel->getById($fields, $id);
        if (empty($user)) {
            flash("error_message", CANT_FOUND_ACC);
            $this->render('edit_user');
        } else {
            $data = ['user' => $user];
            $this->render('edit_user', $data);
        }

        if(isset($_POST['btn-update-user'])){
            $data = [
                'user' => $user,
                'post' => $_POST,
                'file' => $_FILES
            ];

            $validate = $this->ValidationComponent->ValidateEditUser($data);
            if($validate['status'] == false){
                $data = [
                    'user' => $user,
                    'errors' => $validate['errors']
                ];
                $this->render('edit', $data);
            } else {
                $user = $validate['user'];
                if($this->userModel->update($user, $id)){
                    flash("user_message", USER_UPDATED);
                    redirect_to('/management/search-user');
                }
            }
        }
    }

    public function delete_user(){
        $_SESSION['current_page'] = 'search';
        if (!isset($_GET['id'])) {
            flash('user_message', ST_WRONG, 'alert alert-danger');
            return false;
        }
        $id = $_GET['id'];
        if ($this->userModel->delete($id)) {
            flash('user_message', USER_REMOVED);
            redirect_to('/management/search-user');
        }
    }

    public function isLoggedIn(){
        if(isset($_SESSION['is_admin_login'])){
            return true;
        } else {
            return false;
        }
    }

    public function check_role()
    {
        $role = isset($_SESSION['admin']['role_type']) ? $_SESSION['admin']['role_type'] : 2;
        $adminCanNotAccess = ['search', 'create', 'edit', 'delete'];
        if($role == 2 && in_array($_GET['action'], $adminCanNotAccess)){
            flash("user_message", ROLE_ALERT);
            redirect_to('/management/search-user');
        }
    }
}