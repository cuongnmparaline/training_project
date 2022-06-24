<?php
require_once "models/BaseModel.php";

class DetailTeamModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'chi_tiet_nhom';
        $this->db = DB::getInstance();
    }

    public function getNumEmployeeByTeamCode($teamCode){
        $where = "WHERE ma_nhom = :teamCode AND del_flag =:del_flag";
        $sth = $this->db->prepare("SELECT count(nhan_vien_id) as numberEmployee
        FROM $this->table
        {$where}");
        $sth->bindValue('teamCode', $teamCode);
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->execute();;
        $check = $sth->rowCount();
        return ($check > 0) ? $sth->fetch(PDO::FETCH_ASSOC) : false;
    }

    public function getAllByCode($teamCode){
        $where = "WHERE del_flag =:del_flag";
        $sth = $this->db->prepare("SELECT *
        FROM $this->table
        {$where}");
//        $sth->bindValue('teamCode', $teamCode);
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->execute();;
        $check = $sth->rowCount();
        return ($check > 0) ? $sth->fetch(PDO::FETCH_ASSOC) : false;
    }
}