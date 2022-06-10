<?php
require_once "BaseModel.php";

class DepartmentModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'phong_ban';
        $this->db = DB::getInstance();
    }

}