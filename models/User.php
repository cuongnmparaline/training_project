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
        $sth = $db->prepare('INSERT INTO users (name, facebook_id, email, avatar, 
                    status, ins_id, ins_datetime) 
                    VALUES (:name,:facebook_id,:email,:avatar,:status,:ins_id,:ins_datetime)');
        $sth->bindValue(':name', $data['name']);
        $sth->bindValue(':facebook_id', $data['facebook_id']);
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
        $db = DB::getInstance();
        $sth = $db->prepare('UPDATE users SET del_flag = 1 WHERE id = :id');
        $sth->bindValue(':id', $id);
        if($sth->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function update($data)
    {
        $db = DB::getInstance();
        $sth = $db->prepare('UPDATE users SET name = :name, email = :email, avatar = :avatar,
                                   password = :password, status = :status, upd_id = :upd_id,
                                   upd_datetime = :upd_datetime WHERE id = :id');
        $sth->bindValue(':id', $data['id']);
        $sth->bindValue(':name', $data['name']);
        $sth->bindValue(':password', $data['password']);
        $sth->bindValue(':email', $data['email']);
        $sth->bindValue(':avatar', $data['avatar']);
        $sth->bindValue(':status', $data['status']);
        $sth->bindValue(':upd_id', $data['upd_id']);
        $sth->bindValue(':upd_datetime', $data['upd_datetime']);
        if($sth->execute()){
            return true;
        } else {
            return false;
        }

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

    public function getUserById($id){
        $db = DB::getInstance();
        $sth = $db->prepare(
            'SELECT *
            FROM users
            WHERE id = :id'
        );
        $sth->bindValue('id', $id);
        if($sth->execute()){
            return $sth->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getUserByEmail($email){
        $db = DB::getInstance();
        $sth = $db->prepare(
            'SELECT *
            FROM users
            WHERE email = :email'
        );
        $sth->bindValue('email', $email);
        if($sth->execute()){
            return $sth->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
    public function checkFbIdExisted($facebook_id){
        $db = DB::getInstance();
        $sth = $db->prepare(
            'SELECT facebook_id
            FROM users
            WHERE facebook_id = :facebook_id'
        );
        $sth->bindValue('facebook_id', $facebook_id);
        $sth->execute();
        $check = $sth->rowCount();
        if($check > 0)
            return true;
        return false;
    }

    public function getUserByFbId($facebook_id){
        $db = DB::getInstance();
        $sth = $db->prepare(
            'SELECT *
            FROM users
            WHERE facebook_id = :facebook_id'
        );
        $sth->bindValue('facebook_id', $facebook_id);
        if($sth->execute()){
            return $sth->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function check_login($email, $password){
        $db = DB::getInstance();
        $sth = $db->prepare('SELECT id
        FROM users
        WHERE email = :email AND password = :password');
        $sth->bindValue('email', $email);
        $sth->bindValue(':password', $password);
        $sth->execute();
        $check = $sth->rowCount();
        if($check > 0)
            return true;
        return false;
    }

}

?>