<?php
require_once "models/BaseModel.php";

class SalaryModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'luong';
        $this->db = DB::getInstance();
    }

    public function getMonthly(){
        $recentMonth = date_format(date_create(date("Y-m-d H:i:s")), "m");
        $recentYear = date_format(date_create(date("Y-m-d H:i:s")), "Y");
        $where = "WHERE luong.nhanvien_id = nhanvien.id AND month(ngay_cham) =:recentMonth AND year(ngay_cham) =:recentYear AND luong.del_flag =:del_flag AND nhanvien.del_flag =:del_flag";
        $sth = $this->db->prepare("SELECT *
        FROM $this->table, nhanvien {$where}");
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->bindValue(':recentMonth', $recentMonth);
        $sth->bindValue(':recentYear', $recentYear);
        if($sth->execute()){
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}