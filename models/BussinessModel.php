<?php
require_once "models/BaseModel.php";

class BussinessModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'cong_tac';
        $this->db = DB::getInstance();
    }

    public function getByEmployeeId($id){
        $where = "WHERE nhanvien_id = :id AND del_flag =:del_flag";
        $sth = $this->db->prepare("SELECT *
        FROM $this->table
        {$where}");
        $sth->bindValue('id', $id);
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->execute();
        $sth->debugDumpParams();
        die;
        $check = $sth->rowCount();
        return ($check > 0) ? $sth->fetch(PDO::FETCH_ASSOC) : false;
    }

    public function checkEmployeeAlready($id, $dayStart, $dayEnd){
        $where = "WHERE nhanvien_id = :id AND ((DATE(ngay_bat_dau) < '$dayStart' AND DATE(ngay_ket_thuc) > '$dayStart') || (DATE(ngay_bat_dau) < '$dayEnd' AND DATE(ngay_ket_thuc) > '$dayEnd')) AND del_flag =:del_flag";
        $sth = $this->db->prepare("SELECT *
        FROM $this->table
        {$where}");
        $sth->bindValue('id', $id);
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->execute();
        $check = $sth->rowCount();
        return ($check > 0) ? $sth->fetch(PDO::FETCH_ASSOC) : false;
    }
}