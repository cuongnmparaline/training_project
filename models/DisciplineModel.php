<?php
require_once "models/BaseModel.php";

class DisciplineModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'khen_thuong_ky_luat';
        $this->db = DB::getInstance();
    }

    public function getAllDiscipline(){
        $where = "WHERE del_flag =:del_flag AND flag =:flag  ORDER BY id DESC";
        $sth = $this->db->prepare("SELECT *
        FROM $this->table {$where}");
        $sth->bindValue(':del_flag', DEL_FALSE);
        $sth->bindValue(':flag', IS_DISCIPLINE);
        if($sth->execute()){
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}