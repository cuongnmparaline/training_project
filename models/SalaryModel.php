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
        $where = "WHERE luong.nhanvien_id = nhanvien.id AND month(ngay_cham) =:recentMonth AND year(ngay_cham) =:recentYear AND luong.del_flag =:del_flag AND nhanvien.del_flag =:del_flag ORDER BY luong.id DESC";
        $sth = $this->db->prepare("SELECT *
        FROM $this->table, nhanvien {$where}");
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->bindValue(':recentMonth', $recentMonth);
        $sth->bindValue(':recentYear', $recentYear);
        if($sth->execute()){
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getAllByEmpId($employeeId){
        $where = "WHERE luong.nhanvien_id = nhanvien.id AND chuc_vu.id = nhanvien.chuc_vu_id AND luong.del_flag =:del_flag AND nhanvien.del_flag =:del_flag AND chuc_vu.del_flag =:del_flag AND luong.nhanvien_id =:id ORDER BY luong.id DESC";
        $sth = $this->db->prepare("SELECT *
        FROM $this->table, nhanvien, chuc_vu {$where}");
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->bindValue(':id', $employeeId);
        if($sth->execute()){
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getAll(){
        $where = "WHERE luong.nhanvien_id = nhanvien.id AND chuc_vu.id = nhanvien.chuc_vu_id AND luong.del_flag =:del_flag AND nhanvien.del_flag =:del_flag AND chuc_vu.del_flag =:del_flag ORDER BY luong.id DESC";
        $sth = $this->db->prepare("SELECT *
        FROM $this->table, nhanvien, chuc_vu {$where}");
        $sth->bindValue(':del_flag', DEL_FALSE);
        if($sth->execute()){
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}