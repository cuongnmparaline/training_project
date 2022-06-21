<?php
require_once "models/BaseModel.php";

class PositionModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'chuc_vu';
        $this->db = DB::getInstance();
    }

    public function getByEmployeeId($id){
        $where = "WHERE chuc_vu.id = nhanvien.chuc_vu_id AND nhanvien.id =:id AND nhanvien.del_flag =:del_flag AND chuc_vu.del_flag =:del_flag";
        $sth = $this->db->prepare("SELECT ma_chuc_vu, ten_chuc_vu, luong_ngay
        FROM $this->table, nhanvien
        {$where}");
        $sth->bindValue('id', $id);
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->execute();
        $check = $sth->rowCount();
        return ($check > 0) ? $sth->fetch(PDO::FETCH_ASSOC) : false;

    }

}