<?php
require_once "models/BaseModel.php";

class TypeModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'loai_nv';
        $this->db = DB::getInstance();
    }

}