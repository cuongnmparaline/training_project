<?php
require_once "models/BaseModel.php";

class TeamModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'nhom';
        $this->db = DB::getInstance();
    }
}