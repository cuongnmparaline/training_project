<?php
require_once "models/BaseModel.php";

class DegreeModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'bang_cap';
        $this->db = DB::getInstance();
    }

}