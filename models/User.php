<?php

require_once ('BaseModel.php');

class User extends BaseModel{

    public function get($condition)
    {
        $db = DB::getInstance();
        $sth = $db->prepare("SELECT *
        FROM users {$condition}");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($data)
    {
        $db = DB::getInstance();
        $sth = $db->prepare('INSERT INTO users (name, password, email, avatar, 
                    status, ins_id, ins_datetime) 
                    VALUES (:name,:password,:email,:avatar,:status,:ins_id,:ins_datetime)');
        $sth->bindValue(':name', $data['name']);
        $sth->bindValue(':password', $data['password']);
        $sth->bindValue(':email', $data['email']);
        $sth->bindValue(':avatar', $data['avatar']);
        $sth->bindValue(':status', $data['status']);
        $sth->bindValue(':ins_id', $data['ins_id']);
        $sth->bindValue(':ins_datetime', $data['ins_datetime']);
        if($sth->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($data)
    {
        // TODO: Implement update() method.
    }

    public function check_mail_existed($email){
        $db = DB::getInstance();
        $sth = $db->prepare(
            'SELECT email
            FROM users
            WHERE email = :email');
        $sth->bindParam('email', $email);
        $sth->execute();
        $check = $sth->rowCount();
        if($check > 0)
            return true;
        return false;
    }

}

?>