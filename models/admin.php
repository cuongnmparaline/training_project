
<?php
class Admin
{
    public $id;
    public $email;
    public $password;

    function __construct($id, $email, $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    static function all()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM `admin`');

        foreach ($req->fetchAll() as $item) {
            $list[] = new Admin($item['id'], $item['email'], $item['password']);
        }

        return $list;
    }

    static function insert($data){

        $db = DB::getInstance();
        $fields = "(" . implode(", ", array_keys($data)) . ")";
        $values = "";
        foreach ($data as $field => $value) {
            if ($value === NULL)
                $values .= "NULL, ";
            else
                $values .= "'" . escape_string($value) . "', ";
        }
        $values = substr($values, 0, -2);
        $req = $db->query("INSERT INTO `admin` $fields VALUES($values)");
        $inserted_list = $req->fetchAll();
        return $inserted_list;
    }

    function check_login($email, $password){
        $list = [];
        $db = DB::getInstance();
        $req = $db->query("SELECT * FROM `admin` WHERE `email` = '{$email}' AND `password` = '{$password}'");
        $check = $req->rowCount();
        if($check > 0)
            return true;
        return false;
    }

    function check_mail_existed($email){
        $list = [];
        $db = DB::getInstance();
        $req = $db->query("SELECT * FROM `admin` WHERE `email` = '{$email}'");
        $check = $req->rowCount();
        if($check > 0)
            return true;
        return false;
    }
}