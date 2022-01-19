<?php
require_once ('models/ModelInterface.php');

class BaseModel implements ModelInterface {
    protected $table;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function get($fields, $condition)
    {
        $where = "WHERE email LIKE '%{$condition['email']}%' AND del_flag = {$condition['del_flag']}
         OR name LIKE '%{$condition['email']}%' AND del_flag = {$condition['del_flag']} ORDER BY {$condition['order']} {$condition['sort']} {$condition['pagging']}";
        $fields = implode(', ', $fields);
        $sth = $this->db->prepare("SELECT $fields
        FROM $this->table {$where}");
        if($sth->execute()){
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;

    }

    public function getById($fields, $id)
    {
        $fields = implode(', ', $fields);
        $sth = $this->db->prepare(
            "SELECT $fields
            FROM $this->table
            WHERE id = :id"
        );
        $sth->bindValue('id', $id);
        if($sth->execute()){
            return $sth->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }

    public function update($data, $id)
    {
        $key = array_keys($data);
        $setValue = "";
        foreach ($key as $field){
            $setValue = $setValue."$field = :$field, ";
        }
        $setValue = substr($setValue, 0, -2);
        $sth = $this->db->prepare("UPDATE $this->table SET {$setValue} WHERE id = :id");
        $sth->bindValue(':id', $id);
        foreach ($data as $field => $value){
            $sth->bindValue(":$field", $value);
        }
        if($sth->execute()){
            return true;
        }
        return false;

    }

    public function delete($id){
        $sth = $this->db->prepare("UPDATE $this->table SET del_flag = 1 WHERE id = :id");
        $sth->bindValue(':id', $id);
        if($sth->execute()){
            return true;
        }
        return false;

    }

    public function add($data){
        $key = array_keys($data);
        $fields = implode(', ', $key);
        $values = implode(', :', $key);
        $sth = $this->db->prepare("INSERT INTO $this->table ({$fields})
                    VALUES (:{$values})");
        foreach ($data as $field => $value){
            $sth->bindValue(":$field", $value);
        }
        if($sth->execute()){
            return true;
        }
        return false;
    }

    public function checkLogin($email, $password){
        $sth = $this->db->prepare("SELECT id
        FROM $this->table
        WHERE email = :email AND password = :password");
        $sth->bindValue('email', $email);
        $sth->bindValue(':password', $password);
        $sth->execute();
        $check = $sth->rowCount();
        return ($check > 0) ? true : false;
    }

    function checkMailExisted($email){
        $sth = $this->db->prepare(
            "SELECT email
            FROM $this->table
            WHERE email = :email");
        $sth->bindParam('email', $email);
        $sth->execute();
        $check = $sth->rowCount();
        return ($check > 0) ? true : false;
    }

}