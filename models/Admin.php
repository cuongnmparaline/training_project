
<?php
require_once "BaseModel.php";

class Admin extends BaseModel
{

    function __construct()
    {
        $this->table = 'admins';
    }



    function get_id_current_admin($email, $password){
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

    function check_mail_existed($email){
        $db = DB::getInstance();
        $sth = $db->prepare(
            "SELECT email
            FROM $this->table
            WHERE email = :email");
        $sth->bindParam('email', $email);
        $sth->execute();
        $check = $sth->rowCount();
        if($check > 0)
            return true;
        return false;
    }

}