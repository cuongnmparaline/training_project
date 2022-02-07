<?php
require_once "BaseModel.php";

class AdminModel extends BaseModel
{

    public function __construct()
    {
        $this->table = 'admins';
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
        $fields = ['id', 'avatar', 'name', 'email', 'role_type'];
        $results = $this->get($fields, $conditionSearch);
        return $results;
    }

    public function getCurrentAdmin($email, $password)
    {
        $where = "WHERE email = :email AND password = :password AND del_flag =:del_flag";
        $sth = $this->db->prepare("SELECT id, role_type, email
            FROM $this->table {$where}");
        $sth->bindValue('email', $email);
        $sth->bindValue('password', $password);
        $sth->bindValue('del_flag', DEL_FALSE);
        if (!$sth->execute()) {
            return false;
        }

        $check = $sth->rowCount();
        if ($check > 0) {
            return $sth->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

    public function checkLogin($email, $password){
        $where = "WHERE email = :email AND password = :password AND del_flag =:del_flag";
        $sth = $this->db->prepare("SELECT id, email, role_type
        FROM $this->table
        {$where}");
        $sth->bindValue('email', $email);
        $sth->bindValue(':password', $password);
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->execute();
        $check = $sth->rowCount();
        return ($check > 0) ? $sth->fetch(PDO::FETCH_OBJ) : false;
    }

}