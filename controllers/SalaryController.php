
<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('models/employee/EmployeeModel.php');
require_once('models/employee/PositionModel.php');
require_once('components/validate/SalaryValidate.php');

class SalaryController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Salary';
        parent::__construct();
        $this->employeeModel = new EmployeeModel();
        $this->positionModel = new PositionModel();
        $this->salaryValidate = new SalaryValidate();
    }

    public function index()
    {
        $salaries = $this->model->getAll();
        return $this->render('index', ['salaries' => $salaries]);
    }

    public function calculate(){

        $employees = $this->employeeModel->getAll();

        if (empty($_POST)) {
            return $this->render('calculate', ['employees' => $employees]);
        }

        $validatePostData = $this->getParams();

        $validateStatus = $this->salaryValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            return $this->render('calculate', ['employees' => $employees, 'post' => $_POST]);
        }

        $position = $this->positionModel->getByEmployeeId($_POST['employee']);
        $salaryOfDay = $position['luong_ngay'];
        $workingDay = isset($_POST['workingDay']) ? $_POST['workingDay'] : 0;
        $allowance = isset($_POST['allowance']) ? $_POST['allowance'] : 0;
        $overtime = isset($_POST['overtime']) ? $_POST['overtime'] : 0;
        $advance = isset($_POST['advance']) ? $_POST['advance'] : 0;

        if($workingDay <= BONUS_DAY) {
            $salaryOfMonth = $workingDay * $salaryOfDay;
        } else {
            $salaryOfMonth = (BONUS_DAY + ($workingDay - BONUS_DAY)*2) * $salaryOfDay;
        }

        $overtime = ( $salaryOfDay / WORKING_TIME ) * $overtime * 2;

        $tax = $this->calculateTax($salaryOfMonth);

        if((2/3*$salaryOfMonth) <= $advance)
        {
            flash_error('errorCreate', 'advance', ADVANCE_VALIDATE);
            return $this->render('calculate', ['employees' => $employees, 'post' => $_POST]);
        }

        $salary = $salaryOfMonth + $allowance + $overtime - $tax - $advance;

        $dataInsertSalary = [
            'ma_luong' => $_POST['salaryCode'],
            'nhanvien_id' => $_POST['employee'],
            'luong_thang' =>  $salaryOfMonth,
            'ngay_cong' => $_POST['workingDay'],
            'phu_cap' => $_POST['allowance'],
            'khoan_nop' => $tax,
            'tam_ung' => $advance,
            'thuc_lanh' => $salary,
            'ngay_cham' => $_POST['calculateTime'],
            'ghi_chu' => $_POST['description'],
        ];
        if ($this->model->create($dataInsertSalary)) {
            flash("success_message", SALARY_CREATED);
            redirect_to('/luong/bang-luong');
        }

    }

    public function calculateAllowance(){
        if(isset($_POST["idNhanVien"]) && isset($_POST["soNgayCong"]))
        {
            $employeeId = $_POST['idNhanVien'];
            $workingDay = $_POST['soNgayCong'];

            $position = $this->positionModel->getByEmployeeId($employeeId);
            $positionCode = $position['ma_chuc_vu'];

            if($positionCode == 'MCV1569203773') // giam doc
                $allowance = 1000000 + ($workingDay * 45000);
            else if($positionCode == 'MCV1569203762') // pho giam doc
                $allowance = 800000 + ($workingDay * 45000);
            else if($positionCode == 'MCV1569985216' || $positionCode == 'MCV1569985261') // TP, PP
                $allowance = 500000 + ($workingDay * 45000);
            else if($positionCode == 'MCV1569204007') // nhan vien
                // neu ngay cong lon hon 25 ngay
                if($workingDay > 25)
                    $allowance = 300000 + ($workingDay * 45000);
                else
                    $allowance = 0;
            else
                $allowance = 0;

            echo $allowance;
        }
    }

    public function calculateTax($salary){
        $socialInsurance = $salary * (8/100);
        $healthInsurance = $salary * (1.5/100);
        $unemploymentInsurance = $salary * (1/100);

        return (int)($socialInsurance + $healthInsurance + $unemploymentInsurance);
    }

}
