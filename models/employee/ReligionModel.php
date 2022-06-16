<?php
require_once "models/BaseModel.php";

class ReligionModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'ton_giao';
        $this->db = DB::getInstance();
    }

}