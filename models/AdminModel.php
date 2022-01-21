<?php
require_once "BaseModel.php";

class AdminModel extends BaseModel
{

    function __construct()
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

    function getCurrentAdmin($email, $password)
    {
        $sth = $this->db->prepare("SELECT id, role_type, email
            FROM $this->table
            WHERE email = :email AND password = :password");

        $sth->bindValue('email', $email);
        $sth->bindValue('password', $password);
        if (!$sth->execute()) {
            return false;
        }

        $check = $sth->rowCount();
        if ($check > 0) {
            return $sth->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

}