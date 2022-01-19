
<?php
require_once "BaseModel.php";

class Admin extends BaseModel
{

    function __construct()
    {
        $this->table = 'admins';
        $this->db = DB::getInstance();
    }

    function getCurrentAdmin($email, $password){
        $sth = $this->db->prepare("SELECT id, role_type, email
        FROM $this->table
        WHERE email = :email AND password = :password");
        $sth->bindValue('email', $email);
        $sth->bindValue('password', $password);
        if(!$sth->execute()){
            return false;
        }
        $check = $sth->rowCount();
        if($check > 0){
            return $sth->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

}