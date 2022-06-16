<?php
require_once "models/BaseModel.php";

class MarriageModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'tinh_trang_hon_nhan';
        $this->db = DB::getInstance();
    }

}