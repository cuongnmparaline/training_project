<?php
require_once ('models/AdminModel.php');
require_once ('models/UserModel.php');
class ValidationComponent {

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->userModel = new userModel();
    }

    public function checkLogin($email, $password, $type = 'admin')
    {
        $result = [
            'status' => false,
            'errors' => []
        ];
        if (empty($email)) {
            $result['errors']['email'] = EMAIL_BLANK;
        }elseif (!$this->is_email($email)) {
            $result['errors']['email'] = EMAIL_VALIDATE;
        }
        // Check password
        if (empty($password)) {
            $result['errors']['password'] = PASS_BLANK;
        } elseif (!$this->is_password($password)) {
            $result['errors']['password'] = PASS_VALIDATE;
        }
        if($type == 'admin' && !$this->adminModel->checkLogin($email,$password)){
            $result['errors']['account'] = ACCOUNT_INCORRECT;
        }
        if($type == 'user' && !$this->userModel->checkLogin($email,$password)){
            $result['errors']['account'] = ACCOUNT_INCORRECT;
        }
        if(empty($result['errors'])){
            $result = [
                'status' => true
            ];
        }
        return $result;
    }

    public function ValidateCreateAdmin($data){

        $result = [
            'status' => false,
            'errors' => []
        ];
        // Check name

        if(empty($data['post']['name'])){
            $result['errors']['name'] = NAME_BLANK;
        } elseif ((strlen($data['post']['name']) <= MIN_LENGHT || strlen($data['post']['name']) >= MAX_LENGHT)) {
            $result['errors']['name'] = NAME_VALIDATE;
        }
        $name = $data['post']['name'];

        // Check password
        if (!$this->is_password($data['post']['password'])) {
            $result['errors']['password'] = PASS_VALIDATE;
        }
        $password = md5($data['post']['password']);

        // Check password verify
        if (!$this->is_password($data['post']['password'])) {
            $result['errors']['password'] = PASS_VALIDATE;
        }
        if ($data['post']['password'] != $data['post']['password_verify']) {
            $result['errors']['password_verify'] = VERIFY_INCORRECT;
        }

        // Check email
        if (!$this->is_email($data['post']['email'])) {
            $result['errors']['email'] = EMAIL_VALIDATE;
        }
        if ($this->adminModel->checkMailExisted($data['post']['email'])) {
            $result['errors']['email'] = EMAIL_EXISTED;
        }
        $email = $data['post']['email'];

        // Check avatar
        if (empty($data['file']['files']['name'][0])) {
            $result['errors']['avatar'] = AVATAR_BLANK;
        }
        $upload_dir = IMG_LOCATION;
        $avatar = $upload_dir . $_FILES['files']['name'][0];

        // check role
        if (empty($data['post']['role'])) {
            $result['errors']['role'] = ROLE_BLANK;
            $role = '';
        } else {
            $role = $data['post']['role'];
        }
        if(empty($result['errors'])){
            $result = [
                'status' => true,
                'admin' => [
                    'name' => $name,
                    'avatar' => $avatar,
                    'password' => $password,
                    'email' => $email,
                    'role_type' => $role
                ]
            ];
        }
        return $result;
    }

    public function ValidateEditAdmin($data){
        $result = [
            'status' => false,
            'errors' => []
        ];

        // Check name
        if(empty($data['post']['name'])){
            $result['errors']['name'] = NAME_BLANK;
        } elseif ((strlen($data['post']['name']) <= MIN_LENGHT || strlen($data['post']['name']) >= MAX_LENGHT)) {
            $result['errors']['name'] = NAME_VALIDATE;
        }
        $name = $data['post']['name'];


        // Check password
        if(empty($data['post']['password'])){
            $password = $data['admin']['password'];
        } else {
            if (!$this->is_password($data['post']['password'])) {
                $result['errors']['password'] = PASS_VALIDATE;
            }
            $password = md5($data['post']['password']);
        }

        // Check password verify
        if (!empty($data['post']['password_verify'])) {
            if (!$this->is_password($data['post']['password'])) {
                $result['errors']['password'] = PASS_VALIDATE;
            }
            if($data['post']['password'] != $data['post']['password_verify']){
                $result['errors']['password_verify'] = VERIFY_INCORRECT;
            }
        }

        // Check email
        if (!$this->is_email($data['post']['email'])) {
            $result['errors']['email'] = EMAIL_VALIDATE;
        }
        $email = $data['post']['email'];

        // Check avatar
        if(!empty($_FILES['files']['name'][0])){
            $upload_dir = IMG_LOCATION;
            $avatar = $upload_dir . $_FILES['files']['name'][0];
        } else {
            $avatar = $data['admin']['avatar'];
        }

        // Check role
        if (empty($data['post']['role'])) {
            $result['errors']['role'] = ROLE_BLANK;
        }
        $role = $data['post']['role'];
        if(empty($result['errors'])){
            $result = [
                'status' => true,
                'admin' => [
                    'name' => $name,
                    'avatar' => $avatar,
                    'password' => $password,
                    'email' => $email,
                    'role_type' => $role
                ]
            ];
        }
        return $result;
    }

    public function ValidateCreateUser($data){
        $result = [
            'status' => false,
            'errors' => []
        ];
        // Check name


        if(empty($data['post']['name'])){
            $result['errors']['name'] = NAME_BLANK;
        } elseif ((strlen($data['post']['name']) <= MIN_LENGHT || strlen($data['post']['name']) >= MAX_LENGHT)) {
            $result['errors']['name'] = NAME_VALIDATE;
        }
        $name = $data['post']['name'];

        // Check password
        if (!$this->is_password($data['post']['password'])) {
            $result['errors']['password'] = PASS_VALIDATE;
        }
        $password = md5($data['post']['password']);

        // Check password verify
        if (!$this->is_password($data['post']['password'])) {
            $result['errors']['password'] = PASS_VALIDATE;
        }
        if ($data['post']['password'] != $data['post']['password_verify']) {
            $result['errors']['password_verify'] = VERIFY_INCORRECT;
        }

        // Check email
        if (!$this->is_email($data['post']['email'])) {
            $result['errors']['email'] = EMAIL_VALIDATE;
        }
        if ($this->adminModel->checkMailExisted($data['post']['email'])) {
            $result['errors']['email'] = EMAIL_EXISTED;
        }
        $email = $data['post']['email'];

        // Check avatar
        if (empty($data['file']['files']['name'][0])) {
            $result['errors']['avatar'] = AVATAR_BLANK;
        }
        $upload_dir = IMG_LOCATION;
        $avatar = $upload_dir . $_FILES['files']['name'][0];

        // check status
        if (empty($data['post']['status'])) {
            $result['errors']['status'] = ROLE_BLANK;
            $status = '';
        } else {
            $status = $data['post']['status'];
        }
        if(empty($result['errors'])){
            $result = [
                'status' => true,
                'user' => [
                    'name' => $name,
                    'avatar' => $avatar,
                    'password' => $password,
                    'email' => $email,
                    'status' => $status
                ]
            ];
        }
        return $result;
    }

    public function ValidateEditUser($data){
        $result = [
            'status' => false,
            'errors' => []
        ];

        // Check name
        if(empty($data['post']['name'])){
            $result['errors']['name'] = NAME_BLANK;
        } elseif ((strlen($data['post']['name']) <= MIN_LENGHT || strlen($data['post']['name']) >= MAX_LENGHT)) {
            $result['errors']['name'] = NAME_VALIDATE;
        }
        $name = $data['post']['name'];


        // Check password
        if(empty($data['post']['password'])){
            $password = $data['user']['password'];
        } else {
            if (!$this->is_password($data['post']['password'])) {
                $result['errors']['password'] = PASS_VALIDATE;
            }
            $password = md5($data['post']['password']);
        }

        // Check password verify
        if (!empty($data['post']['password_verify'])) {
            if (!$this->is_password($data['post']['password'])) {
                $result['errors']['password'] = PASS_VALIDATE;
            }
            if($data['post']['password'] != $data['post']['password_verify']){
                $result['errors']['password_verify'] = VERIFY_INCORRECT;
            }
        }

        // Check email
        if (!$this->is_email($data['post']['email'])) {
            $result['errors']['email'] = EMAIL_VALIDATE;
        }
        $email = $data['post']['email'];

        // Check avatar
        if(!empty($_FILES['files']['name'][0])){
            $upload_dir = IMG_LOCATION;
            $avatar = $upload_dir . $_FILES['files']['name'][0];
        } else {
            $avatar = $data['user']['avatar'];
        }

        // Check role
        if (empty($data['post']['status'])) {
            $result['errors']['status'] = STATUS_BLANK;
        }
        $status = $data['post']['status'];
        if(empty($result['errors'])){
            $result = [
                'status' => true,
                'user' => [
                    'name' => $name,
                    'avatar' => $avatar,
                    'password' => $password,
                    'email' => $email,
                    'status' => $status
                ]
            ];
        }
        return $result;
    }

    function is_email($email){
        $pattern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
        if (!preg_match($pattern, $_POST['email'], $matchs)) {
            return false;
        } else {
            return true;
        }
    }

    function is_password($password){
        $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
        if (!preg_match($partten, $_POST['password'], $matchs)) {
            return false;
        } else {
            return true;
        }
    }

}