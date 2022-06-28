<?php
require_once "BaseModel.php";

class AuthModel extends BaseModel
{

    public function __construct()
    {
        $this->table = 'tai_khoan';
        $this->db = DB::getInstance();
    }

    public function checkLogin($email, $password){
        $where = "WHERE email = :email AND mat_khau = :mat_khau AND del_flag =:del_flag";
        $sth = $this->db->prepare("SELECT id, ho, ten, email, quyen, truy_cap
        FROM $this->table
        {$where}");
        $sth->bindValue('email', $email);
        $sth->bindValue(':mat_khau', $password);
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->execute();
        $check = $sth->rowCount();
        return ($check > 0) ? $sth->fetch(PDO::FETCH_OBJ) : false;
    }

}