<?php
require_once ('models/ModelInterface.php');

class BaseModel implements ModelInterface {

    protected $table;

    public function get($condition)
    {
        $db = DB::getInstance();
        $sth = $db->prepare("SELECT *
        FROM $this->table {$condition}");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $db = DB::getInstance();
        $sth = $db->prepare(
            "SELECT *
            FROM $this->table
            WHERE id = :id"
        );
        $sth->bindValue('id', $id);
        if($sth->execute()){
            return $sth->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function update($data, $id)
    {
        $key = array_keys($data);
        $dsn = "";
        foreach ($key as $field){
            $dsn = $dsn."$field = :$field, ";
        }
        $dsn = substr($dsn, 0, -2);
        $db = DB::getInstance();
        $sth = $db->prepare("UPDATE $this->table SET {$dsn} WHERE id = :id");
        $sth->bindValue(':id', $id);
        foreach ($data as $field => $value){
            $sth->bindValue(":$field", $value);
        }
        if($sth->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $db = DB::getInstance();
        $sth = $db->prepare("UPDATE $this->table SET del_flag = 1 WHERE id = :id");
        $sth->bindValue(':id', $id);
        if($sth->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function add($data){
        $key = array_keys($data);
        $fields = implode(', ', $key);
        $values = implode(', :', $key);
        $db = DB::getInstance();
        $sth = $db->prepare("INSERT INTO $this->table ({$fields})
                    VALUES (:{$values})");
        foreach ($data as $field => $value){
            $sth->bindValue(":$field", $value);
        }
        if($sth->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function check_login($email, $password){
        $db = DB::getInstance();
        $sth = $db->prepare("SELECT id
        FROM $this->table
        WHERE email = :email AND password = :password");
        $sth->bindValue('email', $email);
        $sth->bindValue(':password', $password);
        $sth->execute();
        $check = $sth->rowCount();
        if($check > 0)
            return true;
        return false;
    }

}