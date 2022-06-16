<?php
require_once "models/BaseModel.php";

class EmployeeModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'nhanvien';
        $this->db = DB::getInstance();
    }

    public function allRetired(){
        $where = "WHERE trang_thai =:trang_thai AND del_flag =:del_flag";
        $sth = $this->db->prepare("SELECT id
        FROM $this->table {$where}");
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->bindValue(':trang_thai', RETIRED);
        if($sth->execute()){
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }

}