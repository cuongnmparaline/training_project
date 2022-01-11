
<?php
require_once "BaseModel.php";

class Admin extends BaseModel
{
    private $db;
    function __construct()
    {
        $this->db =DB::getInstance();
    }

    public function get($condition){

        $db = DB::getInstance();
        $sth = $db->prepare("SELECT *
        FROM admins {$condition}");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
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

    public function delete($id){
        $db = DB::getInstance();
        $sth = $db->prepare('UPDATE admins SET del_flag = 1 WHERE id = :id');
        $sth->bindValue(':id', $id);
        if($sth->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data)
    {
        $db = DB::getInstance();
        $sth = $db->prepare('UPDATE admins SET name = :name, email = :email, avatar = :avatar,
                                   password = :password, role_type = :role_type, upd_id = :upd_id,
                                   upd_datetime = :upd_datetime WHERE id = :id');
        $sth->bindValue(':id', $data['id']);
        $sth->bindValue(':name', $data['name']);
        $sth->bindValue(':password', $data['password']);
        $sth->bindValue(':email', $data['email']);
        $sth->bindValue(':avatar', $data['avatar']);
        $sth->bindValue(':role_type', $data['role_type']);
        $sth->bindValue(':upd_id', $data['upd_id']);
        $sth->bindValue(':upd_datetime', $data['upd_datetime']);
        if($sth->execute()){
            return true;
        } else {
            return false;
        }

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

    function getAdminbyId($id){
        $db = DB::getInstance();
        $sth = $db->prepare(
            'SELECT *
            FROM admins
            WHERE id = :id'
        );
        $sth->bindValue('id', $id);
        if($sth->execute()){
            return $sth->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }


    }
}