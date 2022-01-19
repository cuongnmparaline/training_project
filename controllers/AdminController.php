
<?php
require_once('controllers/BaseController.php');
require_once('models/Admin.php');
require_once('assets/helper/url.php');
require_once('assets/helper/account.php');
class AdminController extends BaseController
{
    private $adminModel;
    private $userModel;
    function __construct()
    {
        $this->folder = 'admin';
        $this->adminModel = new Admin();
        $this->userModel = new User();
    }

    // Admin Action

    public function search()
    {
        $_SESSION['current_page'] = 'search';
        check_role($_SESSION['role_type']);
        if (isset($_GET['btn-search'])) {
            $name = $_GET['name'];
            $email = $_GET['email'];
        } else {
            $name = "";
            $email = "";
        }

        // Sort
        if (isset($_GET['order'])) {
            $order = $_GET['order'];
        } else {
            $order = 'id';
        }
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];

        } else {
            $sort = 'DESC';
        }
        if($sort == 'DESC'){
            $icon['id'] = 'fa fa-fw fa-angle-down';
        } else {
            $icon['id'] = 'fa fa-fw fa-angle-up';
        }
        $icon['id'] = 'fa fa-fw fa-angle-down';
        $icon['name'] = 'fa fa-fw fa-angle-down';
        $icon['email'] = 'fa fa-fw fa-angle-down';
        $icon['role_type'] = 'fa fa-fw fa-angle-down';
        switch ($order) {
            case 'id':
                if($sort == 'DESC'){
                    $icon['id'] = 'fa fa-fw fa-angle-down';
                } else {
                    $icon['id'] = 'fa fa-fw fa-angle-up';
                }
                break;
            case 'name':
                if($sort == 'DESC'){
                    $icon['name'] = 'fa fa-fw fa-angle-down';
                } else {
                    $icon['name'] = 'fa fa-fw fa-angle-up';
                }
                break;
            case 'email':
                if($sort == 'DESC'){
                    $icon['email'] = 'fa fa-fw fa-angle-down';
                } else {
                    $icon['email'] = 'fa fa-fw fa-angle-up';
                }
                break;
            case 'role_type':
                if($sort == 'DESC'){
                    $icon['role_type'] = 'fa fa-fw fa-angle-down';
                } else {
                    $icon['role_type'] = 'fa fa-fw fa-angle-up';
                }
                break;
        }
        $sort_option = [
            'order' => $order,
            'sort' => $sort,
            'icon' => $icon,
        ];

        // Get all admin account
        $condition = [
            'del_flag' => DEL_FALSE,
            'name' => $name,
            'email' => $email,
            'order' => $order,
            'sort' => $sort,
            'pagging' => ""
        ];

        $fields = ['id', 'avatar', 'name', 'email', 'role_type'];
        $totalRow = $this->adminModel->get($fields, $condition);

        // Pagging
        $numPerPage = NUM_PER_PAGE;
        $totalNumRow = count($totalRow);
        $numPage = ceil($totalNumRow / $numPerPage);
        $pageNum = (int)!empty($_GET['page_id']) ? $_GET['page_id'] : 1;
        $start = ($pageNum - 1) * $numPerPage;

        $condition = [
            'del_flag' => DEL_FALSE,
            'name' => $name,
            'email' => $email,
            'order' => $order,
            'sort' => $sort,
            'pagging' => "LIMIT {$start}, {$numPerPage}"
        ];
        $fields = ['id', 'avatar', 'name', 'email', 'role_type'];
        $admins = $this->adminModel->get($fields, $condition);

        // String pagging
        $pagePrev = $pageNum - 1;
        $strPagging = "<ul class='pagination'>";
        if ($pageNum > 1) {
            $pagePrev = $pageNum - 1;
            $strPagging .= "<li class='page-item'><a class='page-link' href = 'management/search/{$pagePrev}'><<</a></li>";
        }
        for ($i = 1; $i <= $numPage; $i++) {
            $active = "";
            if ($pageNum == $i) {
                $active = "active";
            }
            $strPagging .= "<li class='page-item'><a class='page-link {$active}' href = 'management/search/{$i}'>$i</a></li>";
        }
        $pageNext = $pageNum + 1;
        if ($pageNum < $numPage) {
            $pageNext = $pageNum + 1;
            $strPagging .= "<li class='page-item'><a class='page-link' href = 'management/search/{$pageNext}'>>></a></li>";
        }
        $strPagging .= "</ul>";

        $data = [
            'name' => $name,
            'email' => $email,
            'sort_option' => $sort_option,
            'admins' => $admins,
            'str_pagging' => $strPagging
        ];
        $this->render('search', $data);
    }

    public function login()
    {
        if($this->isLoggedIn()){
            redirect_to('search');
        }
        if (isset($_POST['btn_login'])) {
            $error = [];
            // Check email
            if (empty($_POST['email'])) {
                $error['email'] = EMAIL_BLANK;
            }elseif (!is_email($_POST['email'])) {
                $error['email'] = EMAIL_VALIDATE;
            } else {
                $email = $_POST['email'];
            }

            // Check password
            if (empty($_POST['password'])) {
                $error['password'] = PASS_BLANK;
            } elseif (!is_password($_POST['password'])) {
                $error['password'] = PASS_VALIDATE;
            } else {
                $password = md5($_POST['password']);
            }

            // Conclude
            if (empty($error)) {
                if ($this->adminModel->checkLogin($email, $password)) {
                    $admin = $this->adminModel->getCurrentAdmin($email, $password);
                    $_SESSION['is_admin_login'] = true;
                    $_SESSION['admin_login'] = $admin->email;
                    $_SESSION['admin_id'] = $admin->id;
                    $_SESSION['role_type'] = $admin->role_type;
                    redirect_to("search");
                } else {
                    $error['account'] = ACCOUNT_INCORRECT;
                }
            } else {
                $data = [
                    'email' => $_POST['email'],
                    'error' => $error
                ];
                $this->render('login', $data);
            }
        }
        $this->render('login');
    }

    public function logout(){
        unset($_SESSION['is_admin_login']);
        unset($_SESSION['admin_login']);
        redirect_to('/management/login');
    }

    public function create()
    {
        $_SESSION['current_page'] = 'search';
        check_role($_SESSION['role_type']);
        if (isset($_POST['btn-add-admin'])) {
            $error = [];
            // Check name
            if (empty($_POST['name'])) {
                $error['name'] = NAME_BLANK;
            } elseif (!(strlen($_POST['name']) >= MIN_LENGHT && strlen($_POST['name']) <= MAX_LENGHT)) {
                $error['name'] = NAME_VALIDATE;
            } else {
                $name = $_POST['name'];
            }

            // Check password
            if (empty($_POST['password'])) {
                $error['password'] = PASS_BLANK;
            } elseif (!is_password($_POST['password'])) {
                $error['password'] = PASS_VALIDATE;
            } else {
                $password = md5($_POST['password']);
            }

            // Check password verify
            if (empty($_POST['password_verify'])) {
                $error['password_verify'] = PASS_VERIFY_BLANK;
            } elseif (!is_password($_POST['password'])) {
                $error['password'] = PASS_VALIDATE;
            }
            if ($_POST['password'] != $_POST['password_verify']) {
                $error['password_verify'] = VERIFY_INCORRECT;
            }

            // Check email
            if (empty($_POST['email'])) {
                $error['email'] = EMAIL_BLANK;
            }elseif (!is_email($_POST['email'])) {
                $error['email'] = EMAIL_VALIDATE;
            }
            if ($this->adminModel->checkMailExisted($_POST['email'])) {
                $error['email'] = EMAIL_EXISTED;
            } else {
                $email = $_POST['email'];
            }

            // Check avatar
            if (!empty($_FILES['files']['name'][0])) {
                $upload_dir = IMG_LOCATION;
                $avatar = $upload_dir . $_FILES['files']['name'][0];
            } else {
                $error['avatar'] = AVATAR_BLANK;
            }

            // check role
            if (empty($_POST['role'])) {
                $error['role'] = ROLE_BLANK;
                $role = '';
            } else {
                $role = $_POST['role'];
            }

            // get insertor id ( current admin id )
            $ins_id = $_SESSION['admin_id'];

            // check not error
            if (empty($error)) {
                $data = [
                    'name' => $name,
                    'password' => $password,
                    'email' => $email,
                    'avatar' => $avatar,
                    'role_type' => $role,
                    'ins_id' => $ins_id,
                    'ins_datetime' => date(DATE_FORMAT),
                ];
                if ($this->adminModel->add($data)) {
                    flash('admin_message', ADMIN_CREATED . "<br>" . "<a href='management/search'>Return to list ADMIN</a>");
                }
            } else {
                $data = [
                    'name' => $_POST['name'],
                    'email' => $_POST['email'],
                    'role_type' => $role,
                    'error' => $error
                ];
                $this->render('create', $data);
            }
        }
        $this->render('create');
    }

    public function edit()
    {
        $_SESSION['current_page'] = 'search';
        check_role($_SESSION['role_type']);
        if (isset($_POST['btn-update-admin'])) {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $fields = ['id', 'avatar', 'name', 'password', 'email', 'role_type'];
                $admin = $this->adminModel->getById($fields, $id);
            }
            $error = [];

            // Check name
            if (empty($_POST['name'])) {
                $error['name'] = NAME_BLANK;
            }
            if (!(strlen($_POST['name']) >= MIN_LENGHT && strlen($_POST['name']) <= MAX_LENGHT)) {
                $error['name'] = NAME_VALIDATE;
            } else {
                $name = $_POST['name'];
            }

            // Check password
            if (empty($_POST['password'])) {
                $password = $admin['password'];
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = PASS_VALIDATE;
                } else {
                    $password = md5($_POST['password']);
                }
            }

            // Check verify password
            if (!empty($_POST['password_verify'])) {
                if (!is_password($_POST['password'])) {
                    $error['password'] = PASS_VALIDATE;
                }
                if ($_POST['password'] != $_POST['password_verify']) {
                    $error['password_verify'] = VERIFY_INCORRECT;
                }
            }

            // Check email
            if (empty($_POST['email'])) {
                $error['email'] = EMAIL_BLANK;
            } elseif (!is_email($_POST['email'])) {
                $error['email'] = EMAIL_VALIDATE;
            } else {
                $email = $_POST['email'];
            }

            // Check avatar
            if (!empty($_FILES['files']['name'][0])) {
                $upload_dir = IMG_LOCATION;
                $avatar = $upload_dir . $_FILES['files']['name'][0];
            } else {
                $avatar = $admin['avatar'];
            }

            // Check role
            if (empty($_POST['role'])) {
                $error['role'] = ROLE_BLANK;
            } else {
                $role = $_POST['role'];
            }

            // get Update id ( current admin id )
            $updId = $_SESSION['admin_id'];
            if (empty($error)) {
                $data = [
                    'name' => $name,
                    'password' => $password,
                    'email' => $email,
                    'avatar' => $avatar,
                    'role_type' => $role,
                    'upd_id' => $updId,
                    'upd_datetime' => date(DATE_FORMAT)
                ];
                if ($this->adminModel->update($data, $id)) {
                    $_SESSION['edit_success'] = "Edit thành công";
//                    flash('admin_message', ADMIN_UPDATED . "<br>" . "<a href='management/search'>Return to list ADMIN</a>");
                    redirect_to('/management/search');
                }
//                redirect_to('/management/search');
            }
            $fields = ['id', 'avatar', 'name', 'password', 'email', 'role_type'];
            $admin = $this->adminModel->getById($fields, $id);
            $data = [
                'admin' => $admin,
                'error' => $error
            ];
            $this->render('edit', $data);
        }
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $fields = ['id', 'avatar', 'name', 'password', 'email', 'role_type'];
            $admin = $this->adminModel->getById($fields, $id);
            if(empty($admin)){
//                flash("admin_message", CANT_FOUND_ACC);
                $this->render('edit');
            } else {
                $data = ['admin' => $admin];
                $this->render('edit', $data);
            }
        }
    }

    public function delete()
    {
        $_SESSION['current_page'] = 'search';
       check_role($_SESSION['role_type']);
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

    // User Action

    public function search_user(){
        $_SESSION['current_page'] = 'search_user';
        if (isset($_GET['btn-search-user'])) {
            $name = $_GET['name'];
            $email = $_GET['email'];
        } else {
            $name = "";
            $email = "";
        }

        // Sort
        if (isset($_GET['order'])) {
            $order = $_GET['order'];
        } else {
            $order = 'id';
        }
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];

        } else {
            $sort = 'DESC';
        }
        if($sort == 'DESC'){
            $icon['id'] = 'fa fa-fw fa-angle-down';
        } else {
            $icon['id'] = 'fa fa-fw fa-angle-up';
        }
        $icon['id'] = 'fa fa-fw fa-angle-down';
        $icon['name'] = 'fa fa-fw fa-angle-down';
        $icon['email'] = 'fa fa-fw fa-angle-down';
        $icon['status'] = 'fa fa-fw fa-angle-down';
        switch ($order) {
            case 'id':
                if($sort == 'DESC'){
                    $icon['id'] = 'fa fa-fw fa-angle-down';
                } else {
                    $icon['id'] = 'fa fa-fw fa-angle-up';
                }
                break;
            case 'name':
                if($sort == 'DESC'){
                    $icon['name'] = 'fa fa-fw fa-angle-down';
                } else {
                    $icon['name'] = 'fa fa-fw fa-angle-up';
                }
                break;
            case 'email':
                if($sort == 'DESC'){
                    $icon['email'] = 'fa fa-fw fa-angle-down';
                } else {
                    $icon['email'] = 'fa fa-fw fa-angle-up';
                }
                break;
            case 'status':
                if($sort == 'DESC'){
                    $icon['status'] = 'fa fa-fw fa-angle-down';
                } else {
                    $icon['status'] = 'fa fa-fw fa-angle-up';
                }
                break;
        }
        $sort_option = [
            'order' => $order,
            'sort' => $sort,
            'icon' => $icon,
        ];

        // Get all admin account
        $condition = [
            'del_flag' => DEL_FALSE,
            'name' => $name,
            'email' => $email,
            'order' => $order,
            'sort' => $sort,
            'pagging' => ""
        ];
        $fields = ['id', 'avatar', 'name', 'email', 'status'];
        $totalRow = $this->userModel->get($fields, $condition);

        // Pagging
        $numPerPage = NUM_PER_PAGE;
        $totalNumRow = count($totalRow);
        $numPage = ceil($totalNumRow / $numPerPage);
        $pageNum = (int)!empty($_GET['page_id']) ? $_GET['page_id'] : 1;
        $start = ($pageNum - 1) * $numPerPage;

        $condition = [
            'del_flag' => DEL_FALSE,
            'name' => $name,
            'email' => $email,
            'order' => $order,
            'sort' => $sort,
            'pagging' => "LIMIT {$start}, {$numPerPage}"
        ];
        $fields = ['id', 'avatar', 'name', 'email', 'status'];
        $users = $this->userModel->get($fields, $condition);

        // String pagging
        $pagePrev = $pageNum - 1;
        $strPagging = "<ul class='pagination'>";
        if ($pageNum > 1) {
            $pagePrev = $pageNum - 1;
            $strPagging .= "<li class='page-item'><a class='page-link' href = 'management/search-user/{$pagePrev}'><<</a></li>";
        }
        for ($i = 1; $i <= $numPage; $i++) {
            $active = "";
            if ($pageNum == $i) {
                $active = "active";
            }
            $strPagging .= "<li class='page-item'><a class='page-link {$active}' href = 'management/search-user/{$i}'>$i</a></li>";
        }
        $pageNext = $pageNum + 1;
        if ($pageNum < $numPage) {
            $pageNext = $pageNum + 1;
            $strPagging .= "<li class='page-item'><a class='page-link' href = 'management/search-user/{$pageNext}'>>></a></li>";
        }
        $strPagging .= "</ul>";
        $data = [
            'users' => $users,
            'str_pagging' => $strPagging,
            'sort_option' => $sort_option,
            'name' => $name,
            'email' => $email
        ];
        $this->render('search_user', $data);
    }

    public function create_user(){
        $_SESSION['current_page'] = 'search_user';
        if (isset($_POST['btn-add-user'])) {
            $error = [];
            // Check name
            if (empty($_POST['name'])) {
                $error['name'] = NAME_BLANK;
            }
            if (!(strlen($_POST['name']) >= MIN_LENGHT && strlen($_POST['name']) <= MAX_LENGHT)) {
                $error['name'] = NAME_VALIDATE;
            } else {
                $name = $_POST['name'];
            }

            // Check password
            if (empty($_POST['password'])) {
                $error['password'] = PASS_BLANK;
            }elseif (!is_password($_POST['password'])) {
                $error['password'] = PASS_VALIDATE;
            } else {
                $password = md5($_POST['password']);
            }

            // Check password verfiy
            if (empty($_POST['password_verify'])) {
                $error['password_verify'] = PASS_VERIFY_BLANK;
            }
            if (!is_password($_POST['password'])) {
                $error['password'] = PASS_VALIDATE;
            }
            if($_POST['password'] != $_POST['password_verify']){
                $error['password_verify'] = VERIFY_INCORRECT;
            }

            // Check email
            if (empty($_POST['email'])) {
                $error['email'] = EMAIL_BLANK;
            }
            if($this->userModel->checkMailExisted($_POST['email'])){
                $error['email'] = EMAIL_EXISTED;
            } else {
                $email = $_POST['email'];
            }

            // check avatar
            if(!empty($_FILES['files']['name'][0])){
                $upload_dir = IMG_LOCATION;
                $avatar = $upload_dir . $_FILES['files']['name'][0];
            } else {
                $error['avatar'] = AVATAR_BLANK;
            }

            // check role
            if (empty($_POST['status'])) {
                $error['status'] = STATUS_BLANK;
                $status = '';
            } else {
                $status = $_POST['status'];
            }

            // get insertor id ( current admin id )
            $ins_id = $_SESSION['admin_id'];

            // check not error
            if (empty($error)) {
                $data = [
                    'name' => $name,
                    'password' => $password,
                    'email' => $email,
                    'avatar' => $avatar,
                    'status' => $status,
                    'ins_id' => $ins_id,
                    'ins_datetime' => date(DATE_FORMAT)
                ];
                if($this->userModel->add($data)){
                    flash('user_message', USER_CREATED . "<br>" . "<a href='management/search-user'>Return to list ADMIN</a>");
                }
            } else {
                $data = [
                    'name' => $_POST['name'],
                    'password' => $_POST['password'],
                    'email' => $_POST['email'],
                    'status' => $status,
                    'error' => $error
                ];
                $this->render('create_user', $data);
            }
        }
        $this->render('create_user');
    }

    public function edit_user(){
        $_SESSION['current_page'] = 'search_user';
        if(isset($_POST['btn-update-admin'])){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $fields = ['id', 'avatar', 'name','password', 'email', 'status'];
                $user = $this->userModel->getById($fields, $id);
            }
            $error = [];
            // Check name
            if (empty($_POST['name'])) {
                $error['name'] = NAME_BLANK;
            }
            if (!(strlen($_POST['name']) >= MIN_LENGHT && strlen($_POST['name']) <= MAX_LENGHT)) {
                $error['name'] = NAME_VALIDATE;
            } else {
                $name = $_POST['name'];
            }

            // Check password
            if(empty($_POST['password'])){
                $password = $user['password'];
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = PASS_VALIDATE;
                }
                if(empty($_POST['password_verify'])){
                    $error['password_verify'] = PASS_VERIFY_BLANK;
                }
                if (!is_password($_POST['password'])) {
                    $error['password'] = PASS_VALIDATE;
                }
                if($_POST['password'] == $_POST['password_verify']){
                    $password = md5($_POST['password']);
                } else {
                    $error['password_verify'] = VERIFY_INCORRECT;
                }
            }

            // Check password verify
            if (!empty($_POST['password_verify'])) {
                if (!is_password($_POST['password'])) {
                    $error['password'] = PASS_VALIDATE;
                }
                if($_POST['password'] != $_POST['password_verify']){
                    $error['password_verify'] = VERIFY_INCORRECT;
                }
            }

            // Check mail
            if (empty($_POST['email'])) {
                $error['email'] = EMAIL_BLANK;
            }
            if (!is_email($_POST['email'])) {
                $error['email'] = EMAIL_VALIDATE;
            } else {
                $email = $_POST['email'];
            }

            // Check avatar
            if(!empty($_FILES['files']['name'][0])){
                $upload_dir = IMG_LOCATION;
                $avatar = $upload_dir . $_FILES['files']['name'][0];
            } else {
                $avatar = $user['avatar'];
            }
            // check role
            if (empty($_POST['status'])) {
                $error['status'] = STATUS_BLANK;
            } else {
                $status = $_POST['status'];
            }

            // get update id ( current admin id )
            $upd_id = $_SESSION['admin_id'];
            if(empty($error)){
                $data = [
                    'name' => $name,
                    'password' => $password,
                    'email' => $email,
                    'avatar' => $avatar,
                    'status' => $status,
                    'upd_id' => $upd_id,
                    'upd_datetime' => date(DATE_FORMAT)
                ];
                if($this->userModel->update($data, $id)){
                    flash('user_message', USER_UPDATED . "<br>" . "<a href='management/search-user'>Return to list USER</a>");
                } else {
                    flash('user_message', ST_WRONG, 'alert alert-success');
                }
            }
            $fields = ['id', 'avatar', 'name', 'password', 'email', 'status'];
            $user = $this->userModel->getById($fields, $id);
            $data = [
                'user' => $user,
                'error' => $error
            ];
            $this->render('edit_user', $data);
        } else {
            if(!isset($_GET['id'])){
                flash('user_message', ST_WRONG);
                $this->render('edit_user');
            }
            $id = (int)$_GET['id'];
            $fields = ['id', 'avatar', 'name', 'email', 'password', 'status'];
            $user = $this->userModel->getById($fields, $id);
            if(empty($user)){
                flash('user_message', CANT_FOUND_ACC);
                $this->render('edit_user');
            } else {
                $data = ['user' => $user];
                $this->render('edit_user', $data);
            }
        }

    }

    public function delete_user(){
        $_SESSION['current_page'] = 'search_user';
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if($this->userModel->delete($id)){
                flash('user_message', USER_REMOVED);
                redirect_to('/management/search-user');
            } else {
                flash('user_message', ST_WRONG, 'alert alert-success');
                redirect_to('/management/search-user');
            }
        } else {
            redirect_to('/management/search-user');
        }
    }
    function add_avatar()
    {
        // Count total files
        $countfiles = count($_FILES['files']['name']);
        // Upload directory
        $upload_location = IMG_LOCATION;
        // To store uploaded files path
        $files_arr = array();
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

    public function isLoggedIn(){
        if(isset($_SESSION['is_admin_login'])){
            return true;
        } else {
            return false;
        }
    }
}