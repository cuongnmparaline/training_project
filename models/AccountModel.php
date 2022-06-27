<?php
require_once "BaseModel.php";

class AccountModel extends BaseModel
{

    public function __construct()
    {
        $this->table = 'tai_khoan';
        $this->db = DB::getInstance();
    }

}