
<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/employee.php');
require_once('models/EmployeeModel.php');
require_once('components/validate/SalaryValidate.php');
require_once('models/employee/DepartmentModel.php');
require_once('models/employee/EducationModel.php');
require_once('models/employee/PositionModel.php');
require_once('models/employee/TechniqueModel.php');
require_once('models/employee/DegreeModel.php');
require_once('models/employee/TypeModel.php');
require_once('models/employee/NationalityModel.php');
require_once('models/employee/EthnicModel.php');
require_once('models/employee/ReligionModel.php');
require_once('models/employee/MarriageModel.php');
require_once('components/PHPExcel/Classes/PHPExcel.php');

class SalaryController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Salary';
        parent::__construct();
        $this->employeeModel = new EmployeeModel();
        $this->positionModel = new PositionModel();
        $this->salaryValidate = new SalaryValidate();
        $this->departmentModel = new DepartmentModel();
        $this->educationModel = new EducationModel();
        $this->techniqueModel = new TechniqueModel();
        $this->degreeModel = new DegreeModel();
        $this->typeModel = new TypeModel();
        $this->nationalityModel = new NationalityModel();
        $this->ethnicModel = new EthnicModel();
        $this->religionModel = new ReligionModel();
        $this->marriageModel = new MarriageModel();
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

    public function detail(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_SALARY, 'alert alert-danger');
            redirect_to('/nhan-vien');
        }
        $id = (int)$_GET['id'];
        $employee = $this->employeeModel->getById($id);
        if (empty($employee)) {
            flash("error_message", CANT_FOUND_SALARY, 'alert alert-danger');
            redirect_to('/luong/bang-luong');
        }
        $dataView = [
            'departments' => $this->departmentModel->getAll(),
            'educations' => $this->educationModel->getAll(),
            'positions' => $this->positionModel->getAll(),
            'techniques' => $this->techniqueModel->getAll(),
            'degrees' => $this->degreeModel->getAll(),
            'types' => $this->typeModel->getAll(),
            'nationalities' => $this->nationalityModel->getAll(),
            'ethnics' => $this->ethnicModel->getAll(),
            'religions' => $this->religionModel->getAll(),
            'marriages' => $this->marriageModel->getAll(),
            'employee' => $employee,
            'salaries' => $this->model->getAllByEmpId($id)
        ];
        return $this->render('detail', $dataView);
    }

    public function export()
    {
        $result = $this->model->getAll();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $rowCount = 2;

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'STT')
            ->setCellValue('B1', 'M?? l????ng')
            ->setCellValue('C1', 'T??n nh??n vi??n')
            ->setCellValue('D1', 'L????ng th??ng')
            ->setCellValue('E1', 'Ng??y c??ng')
            ->setCellValue('F1', 'Th???c l??nh')
            ->setCellValue('G1', 'Ng??y ch???m');
        foreach($result as $row){
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $rowCount-1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['ma_luong']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, getEmployeeInfo($row['nhanvien_id'])['ten_nv']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['luong_thang']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $row['ngay_cong']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $row['thuc_lanh']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row['ngay_cham']);
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('salary_export.xlsx');

        flash('success_message', SALARY_EXPORTED);
        return redirect_to('/luong/bang-luong');

    }

    public function delete(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG, 'alert alert-danger');
        }
        $id = $_GET['id'];
        if ($this->model->delete($id)) {
            flash('success_message', SALARY_REMOVED);
        }
        return redirect_to('/luong/bang-luong');
    }

}
