<?php
require_once "models/BaseModel.php";

class EthnicModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'dan_toc';
        $this->db = DB::getInstance();
    }

}