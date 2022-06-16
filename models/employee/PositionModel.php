<?php
require_once "models/BaseModel.php";

class PositionModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'chuc_vu';
        $this->db = DB::getInstance();
    }

}