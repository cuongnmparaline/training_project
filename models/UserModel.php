<?php

require_once ('BaseModel.php');

class UserModel extends BaseModel{

    function __construct()
    {
        $this->table = 'users';
        $this->db = DB::getInstance();
    }

    public function pagging($conditionSearch = [])
    {
        $name = isset($conditionSearch['name']) ? $conditionSearch['name'] : '';
        $email = isset($conditionSearch['email']) ? $conditionSearch['email'] : '';
        $page = isset($conditionSearch['page_id']) ? $conditionSearch['page_id'] : 1;
        $order = isset($conditionSearch['order']) ? $conditionSearch['order'] : 'id';
        $sort = isset($conditionSearch['sort']) && $conditionSearch['sort'] == 'DESC' ? 'ASC' : 'DESC';
        $conditionSearch = [
            'name' => $name,
            'email' => $email,
            'order' => $order,
            'sort' => $sort,
            'page' => $page
        ];
        $fields = ['id', 'avatar', 'name', 'email', 'status'];
        $results = $this->get($fields, $conditionSearch);
        return $results;
    }

    public function getUserByEmail($email){
        $del_cond = DEL_FALSE;
        $where = "WHERE email = :email AND del_flag = {$del_cond}";
        $sth = $this->db->prepare(
            "SELECT id, name, facebook_id, email, avatar, status
            FROM $this->table {$where}"
        );
        $sth->bindValue('email', $email);
        if($sth->execute()){
            return $sth->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function checkFbIdExisted($facebook_id){
        $del_cond = DEL_FALSE;
        $where = "WHERE facebook_id = :facebook_id AND del_flag = {$del_cond}";
        $sth = $this->db->prepare(
            "SELECT facebook_id
            FROM $this->table {$where}"
        );
        $sth->bindValue('facebook_id', $facebook_id);
        $sth->execute();
        $check = $sth->rowCount();
        return ($check > 0) ? true : false;
    }

    public function getUserByFbId($facebook_id){
        $del_cond = DEL_FALSE;
        $where = "WHERE facebook_id = :facebook_id AND del_flag = {$del_cond}";
        $db = DB::getInstance();
        $sth = $db->prepare(
            "SELECT id, name, facebook_id, email, avatar, status
            FROM $this->table {$where}"
        );
        $sth->bindValue('facebook_id', $facebook_id);
        if($sth->execute()){
            return $sth->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
    public function checkLogin($email, $password){
        $del_cond = DEL_FALSE;
        $where = "WHERE email = :email AND password = :password AND del_flag = {$del_cond}";
        $sth = $this->db->prepare("SELECT id, email, status
        FROM $this->table
        {$where}");
        $sth->bindValue('email', $email);
        $sth->bindValue(':password', $password);
        $sth->execute();
        $check = $sth->rowCount();
        return ($check > 0) ? $sth->fetch(PDO::FETCH_OBJ) : false;
    }

}

?>