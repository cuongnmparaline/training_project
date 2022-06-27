<?php
require_once "models/BaseModel.php";

class RewardTypeModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'loai_khen_thuong_ky_luat';
        $this->db = DB::getInstance();
    }

    public function getAllRewardType(){
        $where = "WHERE del_flag =:del_flag AND flag =:flag ORDER BY id DESC";
        $sth = $this->db->prepare("SELECT *
        FROM $this->table {$where}");
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->bindValue(':flag', IS_REWARD);
        if($sth->execute()){
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}