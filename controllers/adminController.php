

<?php
require_once('controllers/baseController.php');
require_once('assets/libraries/validation.php');
require_once('models/Admin.php');
require_once('assets/helper/url.php');
require_once('assets/helper/layout.php');
require_once('assets/helper/user.php');
class AdminController extends BaseController
{
    function __construct()
    {
        $this->folder = 'admin';
    }

    public function index(){

        if(isset($_GET['btn-search'])) {
            $name = $_GET['name'];
            $email = $_GET['email'];
        } else {
            $name = "";
            $email = "";
        }

        // Get all admin account

        // Pagging
        $condition = "WHERE email LIKE '%{$email}%' OR name LIKE '%{$name}%' AND del_flag != 1";
        $total_row = Admin::get($condition);
        $num_per_page = 3;
        $total_num_row = count($total_row);
        $num_page = ceil($total_num_row / $num_per_page);
        $page_num = (int) !empty($_GET['page_id']) ? $_GET['page_id'] : 1;
        $start = ($page_num - 1) * $num_per_page;
        $condition = "WHERE email LIKE '%{$email}%' OR name LIKE '%{$name}%' AND del_flag != 1 LIMIT {$start}, {$num_per_page}";
        $admins = Admin::get($condition);

        // String pagging
        $page_prev = $page_num - 1;
        $str_pagging = "<ul class='pagination'>";
        $str_pagging .= "<li class='page-item'><a class='page-link' href = '?controller=admin&action=index&page_id={$page_prev}'>Previous</a></li>";
        for($i = 1; $i <= $num_page; $i++){
            $active = "";
            if($page_num == $i){
                $active = "class = 'active-num-page'";
            }
            $str_pagging .= "<li class='page-item' {$active}><a class='page-link' href = '?controller=admin&action=index&page_id={$i}'>$i</a></li>";
        }
        $page_next = $page_num + 1;
        $str_pagging .= "<li class='page-item'><a class='page-link' href = '?controller=admin&action=index&page_id={$page_next}'>Next</a></li>";

        $data = [
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
                if (!is_email($email)) {
                    $error['email'] = "Wrong email format, try again";
                } else {
                    $email = $_POST['email'];
                }
            }
            # Check password
            if (empty($_POST['password'])) {
                $error['password'] = 'Password can not be blank';
            } else {
                if (!is_password($password)) {
                    $error['password'] = "Wrong password format, try again";
                } else {
                    $password = md5($_POST['password']);
                }
            }
            # Conclude
            if (empty($error)) {
                if (Admin::check_login($email, $password)) {
                    $admin_id = Admin::get_id_current_admin($email, $password)->id;
                    $_SESSION['is_login'] = true;
                    $_SESSION['user_login'] = $email;
                    $_SESSION['admin_id'] = $admin_id;
                    redirect_to("?controller=admin&action=index");
                } else {
                    $error['account'] = "Incorrect email or password";
                }
            }

        }
        $this->render('login');
    }

    public function logout(){
        unset($_SESSION['is_login']);
        unset($_SESSION['user_login']);
        redirect_to('?controller=admin&action=login');
    }

    public function create(){

        global $name, $email, $error, $success;
        if (isset($_POST['btn-add-admin'])) {

            $success = array();
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
                    $success['admin'] = "Thêm ADMIN mới thành công" . "<br>" . "<a href='?controller=admin&controller=index'>Trở về danh sách ADMIN</a>";
                } else {
                    die('lỗi');
                }

            }
        }
        $this->render('create');
    }

    public function edit(){
        if(isset($_GET['id'])){
            $id = (int)$_GET['id'];
            $admin = Admin::getAdminById($id);
            $data = ['admin' => $admin];
            $this->render('edit', $data);
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