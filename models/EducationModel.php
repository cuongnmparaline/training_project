<?php
require_once "BaseModel.php";

class EducationModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'trinh_do';
        $this->db = DB::getInstance();
    }

}