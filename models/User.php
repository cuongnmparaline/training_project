<?php

require_once ('BaseModel.php');

class User extends BaseModel{

    function __construct()
    {
        $this->table = 'users';
    }

    public function addFbAccount($data)
    {
        $db = DB::getInstance();
        $sth = $db->prepare("INSERT INTO $this->table (name, facebook_id, email, avatar, 
                    status, ins_id, ins_datetime) 
                    VALUES (:name,:facebook_id,:email,:avatar,:status,:ins_id,:ins_datetime)");
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


    public function check_mail_existed($email){
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

    public function getUserByEmail($email){
        $db = DB::getInstance();
        $sth = $db->prepare(
            "SELECT *
            FROM $this->table
            WHERE email = :email"
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
            "SELECT facebook_id
            FROM $this->table
            WHERE facebook_id = :facebook_id"
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
            "SELECT *
            FROM $this->table
            WHERE facebook_id = :facebook_id"
        );
        $sth->bindValue('facebook_id', $facebook_id);
        if($sth->execute()){
            return $sth->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }


}

?>