<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/employee.php');
require_once('models/DepartmentModel.php');
require_once('models/EmployeeModel.php');
require_once('models/PositionModel.php');

class EmployeeController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Employee';
        parent::__construct();
        $this->departmentModel = new DepartmentModel();
        $this->employeeModel = new EmployeeModel();
        $this->positionModel = new PositionModel();
    }

    public function index()
    {
        $employee = $this->employeeModel->getAll();
        $this->render('index', ['employees' => $employee]);
    }

    public function department(){
        $departments = $this->departmentModel->getAll();

        if(!isset($_POST['save'])){
            return $this->render('listDepartment', ['departments' => $departments]);
        }


    }

//    public function listEmployee(){
//
//        $employee = $this->employeeModel->getAll();
//        $this->render('listEmployee', ['employees' => $employee]);
//    }
//
//    public function listAccount(){
//        $accounts = $this->accountModel->getAll();
//        $this->render('listAccount', ['accounts' => $accounts]);
//    }
}
