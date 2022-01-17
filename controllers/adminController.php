

<?php
require_once('controllers/baseController.php');
require_once('assets/libraries/validation.php');
require_once('models/Admin.php');
require_once('models/User.php');
require_once('assets/helper/url.php');
require_once('assets/helper/layout.php');
require_once('assets/helper/account.php');
class AdminController extends BaseController
{
    function __construct()
    {
        $this->folder = 'admin';
    }

    // Admin Action

    public function search(){
        if($_SESSION['role_type'] == 2){
            redirect_to('management/search-user');
            flash('user_message', 'Only Super Admin could access Admin Management! You are in User Management');
        }
        if(isset($_GET['btn-search'])) {
            $name = $_GET['name'];
            $email = $_GET['email'];
        } else {
            $name = "";
            $email = "";
        }

        // Get all admin account

        // Pagging
        $condition = "WHERE email LIKE '%{$email}%' AND del_flag != 1 OR name LIKE '%{$name}%' AND del_flag != 1";
        $total_row = Admin::get($condition);
        $num_per_page = 3;
        $total_num_row = count($total_row);
        $num_page = ceil($total_num_row / $num_per_page);
        $page_num = (int) !empty($_GET['page_id']) ? $_GET['page_id'] : 1;
        $start = ($page_num - 1) * $num_per_page;

        // Sort
        if(isset($_GET['order'])){
            $order = $_GET['order'];
        } else {
            $order = 'id';
        }
        if(isset($_GET['sort'])){
            $sort = $_GET['sort'];
        } else {
            $sort = 'DESC';
        }
        $sort_option = [
            'order' => $order,
            'sort' => $sort
        ];
        $condition = "WHERE email LIKE '%{$email}%' AND del_flag != 1 OR name LIKE '%{$name}%' AND del_flag != 1 ORDER BY {$order} {$sort} LIMIT {$start}, {$num_per_page}";
        $admins = Admin::get($condition);

        // String pagging
        $page_prev = $page_num - 1;

        $str_pagging = "<ul class='pagination'>";
        if($page_num > 1){
            $page_prev = $page_num-1;
            $str_pagging .= "<li class='page-item'><a class='page-link' href = 'management/search/{$page_prev}'>Previous</a></li>";
        }
        for($i = 1; $i <= $num_page; $i++){
            $active = "";
            if($page_num == $i){
                $active = "class = 'active-num-page'";
            }
            $str_pagging .= "<li class='page-item' {$active}><a class='page-link' href = 'management/search/{$i}'>$i</a></li>";
        }
        $page_next = $page_num + 1;
        if($page_num < $num_page){
            $page_next = $page_num+1;
            $str_pagging .= "<li class='page-item'><a class='page-link' href = 'management/search/{$page_next}'>Next</a></li>";
        }
        $str_pagging .= "</ul>";
        $data = [
            'sort_option' => $sort_option,
            'admins' => $admins,
            'str_pagging' => $str_pagging
        ];
        $this->render('index', $data);


    }

    public function login()
    {
        global $email, $password, $error;
        if (isset($_POST['btn_login'])) {
            $error = array();
            # Check email
            if (empty($_POST['email'])) {
                $error['email'] = 'Email can not be blank';
            } else {
                if (!is_email($_POST['email'])) {
                    $error['email'] = "Wrong email format, try again";
                } else {
                    $email = $_POST['email'];
                }
            }
            # Check password
            if (empty($_POST['password'])) {
                $error['password'] = 'Password can not be blank';
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = "Wrong password format, try again";
                } else {
                    $password = md5($_POST['password']);
                }
            }
            # Conclude
            if (empty($error)) {
                if (Admin::check_login($email, $password)) {
                    $admin = Admin::get_id_current_admin($email, $password);
                    $_SESSION['is_admin_login'] = true;
                    $_SESSION['admin_login'] = $email;
                    $_SESSION['admin_id'] = $admin->id;
                    $_SESSION['role_type'] = $admin->role_type;
                    redirect_to("search");
                } else {
                    $error['account'] = "Incorrect email or password";
                }
            }

        }
        $this->render('login');
    }

    public function logout(){
        unset($_SESSION['is_admin_login']);
        unset($_SESSION['admin_login']);
        redirect_to('management/login');
    }

    public function create(){
        if($_SESSION['role_type'] == 2){
            redirect_to('/management/create-user');
            flash('user_message', 'Only Super Admin could access Admin Management! You are in User Management');
        }
        global $name, $email, $error, $role;
        if (isset($_POST['btn-add-admin'])) {

            $error = array();
            if (empty($_POST['name'])) {
                $error['name'] = 'Name can not be blank';
            } else {
                if (!(strlen($_POST['name']) >= 0 && strlen($_POST['name']) <= 128)) {
                    $error['name'] = 'Name must be 0 to 128 characters';
                } else {
                    $name = $_POST['name'];
                }
            }
            if (empty($_POST['password'])) {
                $error['password'] = 'Password can be blank';
            } else {
                    if (!is_password($_POST['password'])) {
                        $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                    } else {
                        $password = md5($_POST['password']);
                    }
            }

            if (empty($_POST['password_verify'])) {
                $error['password_verify'] = 'Please verify your password';
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                } else {
                    if($_POST['password'] == $_POST['password_verify']){
                        $password_verify = md5($_POST['password_verify']);
                    } else {
                        $error['password_verify'] = "Password verify is not match";
                    }
                }
            }
            if (empty($_POST['email'])) {
                $error['email'] = 'email can not be blank';
            } else {
                if(Admin::check_mail_existed($_POST['email'])){
                    $error['email'] = "Email is existed";
                } else {
                    $email = $_POST['email'];
                }
            }

            // check avatar

            if(!empty($_FILES['files']['name'][0])){
                $upload_dir = 'assets/images/';
                $avatar = $upload_dir . $_FILES['files']['name'][0];
            } else {
                $error['avatar'] = "Please upload your avatar";
            }

            // check role
            if (empty($_POST['role'])) {
                $error['role'] = 'You have to choose admin role';
            } else {
                $role = $_POST['role'];
            }

            // get insertor id ( current admin id )

            $ins_id = $_SESSION['admin_id'];


            // check not error
            if (empty($error)) {
                $data = array(
                    'name' => $name,
                    'password' => $password,
                    'email' => $email,
                    'avatar' => $avatar,
                    'role_type' => $role,
                    'ins_id' => $ins_id,
                    'ins_datetime' => date('d/m/yy'),
                );
                if(Admin::add($data)){

                    flash('admin_message', "Add new ADMIN success!" . "<br>" . "<a href='management/search'>Return to list ADMIN</a>");
//                    flash('') = "Add new ADMIN success!" . "<br>" . "<a href='?controller=admin&action=index'>Return to list ADMIN</a>";
                }
            } else {
                flash ('admin_message', 'Something wrong happened!');
            }
        }
        $this->render('create');
    }

    public function edit(){
        if(isset($_POST['btn-update-admin'])){
            global $email, $name, $error, $success;
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $admin = Admin::getAdminById($id);
            }
            $error = [];
            $success = [];
            if (empty($_POST['name'])) {
                $error['name'] = 'Name can not be blank';
            } else {
                if (!(strlen($_POST['name']) >= 0 && strlen($_POST['name']) <= 128)) {
                    $error['name'] = 'Name must be 0 to 128 characters';
                } else {
                    $name = $_POST['name'];
                }
            }

            if(empty($_POST['password'])){
                $password = $admin['password'];
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                } else {
                    if(empty($_POST['password_verify'])){
                        $error['password_verify'] = "Please enter your password verify";
                    } else {
                        if (!is_password($_POST['password'])) {
                            $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                        } else {
                            if($_POST['password'] == $_POST['password_verify']){
                                $password = md5($_POST['password']);
                            } else {
                                $error['password_verify'] = "Password verify is not match";
                            }
                        }
                    }
                }
            }


            if (!empty($_POST['password'])) {
                if (!is_password($_POST['password'])) {
                    $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                } else {
                    $password = md5($_POST['password']);
                }
            } else {


                $password = $admin['password'];
            }

            if (!empty($_POST['password_verify'])) {
                if (!is_password($_POST['password'])) {
                    $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                } else {
                    if($_POST['password'] == $_POST['password_verify']){
                        $password_verify = md5($_POST['password_verify']);
                    } else {
                        $error['password_verify'] = "Password verify is not match";
                    }
                }
            }
            if (empty($_POST['email'])) {
                $error['email'] = 'email can not be blank';
            } else {
                $email = $_POST['email'];
            }

            // check avatar

            if(!empty($_FILES['files']['name'][0])){
                $upload_dir = 'assets/images/';
                $avatar = $upload_dir . $_FILES['files']['name'][0];
            } else {
                $avatar = $admin['avatar'];
            }
            // check role
            if (empty($_POST['role'])) {
                $error['role'] = 'You have to choose admin role';
            } else {
                $role = $_POST['role'];
            }

            // get update id ( current admin id )
            $upd_id = $_SESSION['admin_id'];
            if(empty($error)){
                $data = array(
                    'id' => $id,
                    'name' => $name,
                    'password' => $password,
                    'email' => $email,
                    'avatar' => $avatar,
                    'role_type' => $role,
                    'upd_id' => $upd_id,
                    'upd_datetime' => date('d/m/y'),
                );
                if(Admin::update($data)){
                    flash('admin_message', "Update ADMIN success!" . "<br>" . "<a href='management/search'>Return to list ADMIN</a>");
//                    $success['admin'] = "Update ADMIN success" . "<br>" . "<a href='?controller=admin&action=index'>Return to list ADMIN</a>";
                } else {
                    flash('admin_message', 'Something wrong happened!');
                }
            }
            $admin = Admin::getAdminById($id);
            $data = ['admin' => $admin];
            $this->render('edit', $data);
        } else {
            if(isset($_GET['id'])){
                $id = (int)$_GET['id'];
                $admin = Admin::getAdminById($id);
                $data = ['admin' => $admin];
                $this->render('edit', $data);
            }
        }

    }

    public function delete(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if(Admin::delete($id)){
                flash('admin_message', 'Admin Removed');
                redirect_to('/management/search');
            } else {
                flash('admin_message', 'Something Wrong Happened!');
            }
        } else {
            redirect_to('/management/search');
        }
    }

    // User Action

    public function search_user(){
        if(isset($_GET['btn-search-user'])) {
            $name = $_GET['name'];
            $email = $_GET['email'];
        } else {
            $name = "";
            $email = "";
        }

        // Get all admin account

        // Pagging
        $condition = "WHERE email LIKE '%{$email}%' AND del_flag != 1 OR name LIKE '%{$name}%' AND del_flag != 1";
        $total_row = User::get($condition);
        $num_per_page = 3;
        $total_num_row = count($total_row);
        $num_page = ceil($total_num_row / $num_per_page);
        $page_num = (int) !empty($_GET['page_id']) ? $_GET['page_id'] : 1;
        $start = ($page_num - 1) * $num_per_page;
        $condition = "WHERE email LIKE '%{$email}%' AND del_flag != 1 OR name LIKE '%{$name}%' AND del_flag != 1 LIMIT {$start}, {$num_per_page}";
        $users = User::get($condition);

        // String pagging
        $page_prev = $page_num - 1;
        $str_pagging = "<ul class='pagination'>";
        if($page_num > 1){
            $page_prev = $page_num-1;
            $str_pagging .= "<li class='page-item'><a class='page-link' href = 'management/search-user/{$page_prev}'>Previous</a></li>";
        }
        for($i = 1; $i <= $num_page; $i++){
            $active = "";
            if($page_num == $i){
                $active = "class = 'active-num-page'";
            }
            $str_pagging .= "<li class='page-item' {$active}><a class='page-link' href = 'management/search-user/{$i}'>$i</a></li>";
        }
        $page_next = $page_num + 1;
        if($page_num < $num_page){
            $page_next = $page_num+1;
            $str_pagging .= "<li class='page-item'><a class='page-link' href = 'management/search-user/$page_next}'>Next</a></li>";
        }
        $str_pagging .= "</ul>";
        $data = [
            'users' => $users,
            'str_pagging' => $str_pagging
        ];
        $this->render('search_user', $data);

    }

    public function create_user(){

        global $name, $email, $error;
        if (isset($_POST['btn-add-user'])) {
            $error = array();
            if (empty($_POST['name'])) {
                $error['name'] = 'Name can not be blank';
            } else {
                if (!(strlen($_POST['name']) >= 0 && strlen($_POST['name']) <= 128)) {
                    $error['name'] = 'Name must be 0 to 128 characters';
                } else {
                    $name = $_POST['name'];
                }
            }
            if (empty($_POST['password'])) {
                $error['password'] = 'Password can be blank';
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                } else {
                    $password = md5($_POST['password']);
                }
            }

            if (empty($_POST['password_verify'])) {
                $error['password_verify'] = 'Please verify your password';
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                } else {
                    if($_POST['password'] == $_POST['password_verify']){
                        $password_verify = md5($_POST['password_verify']);
                    } else {
                        $error['password_verify'] = "Password verify is not match";
                    }
                }
            }
            if (empty($_POST['email'])) {
                $error['email'] = 'email can not be blank';
            } else {
                if(User::check_mail_existed($_POST['email'])){
                    $error['email'] = "Email is existed";
                } else {
                    $email = $_POST['email'];
                }
            }

            // check avatar

            if(!empty($_FILES['files']['name'][0])){
                $upload_dir = 'assets/images/';
                $avatar = $upload_dir . $_FILES['files']['name'][0];
            } else {
                $error['avatar'] = "Please upload your avatar";
            }

            // check role
            if (empty($_POST['status'])) {
                $error['status'] = 'You have to choose admin role';
            } else {
                $status = $_POST['status'];
            }

            // get insertor id ( current admin id )

            $ins_id = $_SESSION['admin_id'];

            // check not error
            if (empty($error)) {
                $data = array(
                    'name' => $name,
                    'password' => $password,
                    'email' => $email,
                    'avatar' => $avatar,
                    'status' => $status,
                    'ins_id' => $ins_id,
                    'ins_datetime' => date('d/m/yy'),
                );
                if(User::add($data)){
                    flash('user_message', "Add new USER success!" . "<br>" . "<a href='management/search-user'>Return to list ADMIN</a>");
//                    flash('') = "Add new ADMIN success!" . "<br>" . "<a href='?controller=admin&action=index'>Return to list ADMIN</a>";
                }
            } else {
                flash ('user_message', 'Something wrong happened!');
            }
        }
        $this->render('create_user');
    }

    public function edit_user(){

        if(isset($_POST['btn-update-admin'])){
            global $email, $name, $error, $success;
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $admin = User::getUserById($id);
            }
            $error = [];
            $success = [];
            if (empty($_POST['name'])) {
                $error['name'] = 'Name can not be blank';
            } else {
                if (!(strlen($_POST['name']) >= 0 && strlen($_POST['name']) <= 128)) {
                    $error['name'] = 'Name must be 0 to 128 characters';
                } else {
                    $name = $_POST['name'];
                }
            }

            if(empty($_POST['password'])){
                $password = $admin['password'];
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                } else {
                    if(empty($_POST['password_verify'])){
                        $error['password_verify'] = "Please enter your password verify";
                    } else {
                        if (!is_password($_POST['password'])) {
                            $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                        } else {
                            if($_POST['password'] == $_POST['password_verify']){
                                $password = md5($_POST['password']);
                            } else {
                                $error['password_verify'] = "Password verify is not match";
                            }
                        }
                    }
                }
            }


            if (!empty($_POST['password'])) {
                if (!is_password($_POST['password'])) {
                    $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                } else {
                    $password = md5($_POST['password']);
                }
            } else {


                $password = $admin['password'];
            }

            if (!empty($_POST['password_verify'])) {
                if (!is_password($_POST['password'])) {
                    $error['password'] = 'Password include letter, numberic, symbol, from 6 to 32 letter, upcase in the first letter';
                } else {
                    if($_POST['password'] == $_POST['password_verify']){
                        $password_verify = md5($_POST['password_verify']);
                    } else {
                        $error['password_verify'] = "Password verify is not match";
                    }
                }
            }
            if (empty($_POST['email'])) {
                $error['email'] = 'email can not be blank';
            } else {
                $email = $_POST['email'];
            }

            // check avatar

            if(!empty($_FILES['files']['name'][0])){
                $upload_dir = 'assets/images/';
                $avatar = $upload_dir . $_FILES['files']['name'][0];
            } else {
                $avatar = $admin['avatar'];
            }
            // check role
            if (empty($_POST['status'])) {
                $error['status'] = 'You have to choose user status';
            } else {
                $status = $_POST['status'];
            }

            // get update id ( current admin id )
            $upd_id = $_SESSION['admin_id'];
            if(empty($error)){
                $data = array(
                    'id' => $id,
                    'name' => $name,
                    'password' => $password,
                    'email' => $email,
                    'avatar' => $avatar,
                    'status' => $status,
                    'upd_id' => $upd_id,
                    'upd_datetime' => date('d/m/y'),
                );
                if(User::update($data)){
                    flash('user_message', "Update USER success!" . "<br>" . "<a href='management/search-user'>Return to list USER</a>");
//                    $success['admin'] = "Update ADMIN success" . "<br>" . "<a href='?controller=admin&action=index'>Return to list ADMIN</a>";
                } else {
                    flash('user_message', 'Something wrong happened!');
                }
            }
            $user = User::getUserById($id);
            $data = ['user' => $user];
            $this->render('edit_user', $data);
        } else {
            if(isset($_GET['id'])){
                $id = (int)$_GET['id'];
                $user = User::getUserById($id);
                $data = ['user' => $user];
                $this->render('edit_user', $data);
            }
        }

    }

    public function delete_user(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if(User::delete($id)){
                flash('user_message', 'User Removed');
                redirect_to('/management/search-user');
            } else {
                flash('user_message', 'Something Wrong Happened!');
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
        $upload_location = "assets/images/";

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

}