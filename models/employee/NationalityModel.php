<?php
require_once "models/BaseModel.php";

class NationalityModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'quoc_tich';
        $this->db = DB::getInstance();
    }

}