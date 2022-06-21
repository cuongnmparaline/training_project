<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/employee.php');
require_once('models/AccountModel.php');
require_once('models/employee/DepartmentModel.php');
require_once('models/employee/EmployeeModel.php');
require_once('models/employee/PositionModel.php');
require_once('models/SalaryModel.php');

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Home';
        parent::__construct();
        $this->accountModel = new AccountModel();
        $this->departmentModel = new DepartmentModel();
        $this->employeeModel = new EmployeeModel();
        $this->positionModel = new PositionModel();
        $this->salaryModel = new SalaryModel();
    }

    public function index()
    {
        $dataView = [
            'departments' => $this->departmentModel->getAll(),
            'positions' => $this->positionModel->getAll(),
            'monthlySalary' => $this->salaryModel->getMonthly(),
            'statistical' => [
                'totalAccount' => count($this->accountModel->getAll()),
                'totalDepartment' => count($this->departmentModel->getAll()),
                'totalEmployee' => count($this->employeeModel->getAll()),
                'totalRetiredEmployee' => count($this->employeeModel->allRetired())
            ]
        ];
        $this->render('index', $dataView);
    }

    public function listEmployee(){

        $employee = $this->employeeModel->getAll();
        $this->render('listEmployee', ['employees' => $employee]);
    }

    public function listAccount(){
        $accounts = $this->accountModel->getAll();
        $this->render('listAccount', ['accounts' => $accounts]);
    }
}
