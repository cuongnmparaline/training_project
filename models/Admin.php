
<?php
require_once "BaseModel.php";

class Admin extends BaseModel
{
    public $id;
    public $email;
    public $password;

    function __construct($id, $email, $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    public function get(){

    }

    public function add($data){

        $db = DB::getInstance();
        $sth = $db->prepare('INSERT INTO admins (name, password, email, avatar, 
                    role_type, ins_id, ins_datetime) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)');
//        $sth->bindValue(':adminName', $data['name'], PDO::PARAM_STR_CHAR);
//        $sth->bindValue(':password', $data['password'],PDO::PARAM_STR_CHAR);
//        $sth->bindValue(':email', $data['email'],PDO::PARAM_STR_CHAR);
//        $sth->bindValue(':avatar', $data['avatar'],PDO::PARAM_STR_CHAR);
//        $sth->bindValue(':role_type', $data['role_type'],PDO::PARAM_STR_CHAR);
//        $sth->bindValue(':ins_id', $data['ins_id'],PDO::PARAM_INT);
//        $sth->bindValue(':ins_datetime', $data['ins_datetime']);
        if($sth->execute([$data['name'], $data['password'], $data['email'], $data['avatar'], $data['role_type'], $data['ins_id'], $data['ins_datetime']])){
            return true;
        } else {
            return false;
        }
    }

    public function delete(){

    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    function check_login($email, $password){
        $db = DB::getInstance();
        $sth = $db->prepare('SELECT id
        FROM admins
        WHERE email = :email AND password = :password');
        $sth->bindValue('email', $email);
        $sth->bindValue(':password', $password);
        $sth->execute();
        $check = $sth->rowCount();
        if($check > 0)
            return true;
        return false;
    }

    function get_id_current_admin($email, $password){
        $db = DB::getInstance();
        $sth = $db->prepare('SELECT id
        FROM admins
        WHERE email = :email AND password = :password');
        $sth->bindValue('email', $email);
        $sth->bindValue('password', $password);
        if($sth->execute()){
            return $sth->fetch(PDO::FETCH_OBJ);
        } else {
            return false;
        }


    }

    function check_mail_existed($email){
        $db = DB::getInstance();
        $sth = $db->prepare(
            'SELECT email
            FROM admins
            WHERE email = :email');
        $sth->bindParam('email', $email);
        $sth->execute();
        $check = $sth->rowCount();
        if($check > 0)
            return true;
        return false;
    }
}