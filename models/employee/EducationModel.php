<?php
require_once "models/BaseModel.php";

class EducationModel extends BaseModel
{
    public function __construct()
    {
        $this->table = 'trinh_do';
        $this->db = DB::getInstance();
    }

}