<?php
require_once "BaseModel.php";

class TechniqueModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'chuyen_mon';
        $this->db = DB::getInstance();
    }

}