
<?php
require_once "BaseModel.php";

class Admin extends BaseModel
{

    function __construct()
    {
        $this->table = 'admins';
    }

    function getCurrentAdmin($email, $password){
        $db = DB::getInstance();
        $sth = $db->prepare("SELECT id, role_type
        FROM $this->table
        WHERE email = :email AND password = :password");
        $sth->bindValue('email', $email);
        $sth->bindValue('password', $password);
        if($sth->execute()){
            return $sth->fetch(PDO::FETCH_OBJ);
        } else {
            return false;
        }
    }

}