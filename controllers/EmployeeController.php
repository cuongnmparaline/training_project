<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/employee.php');
require_once('models/DepartmentModel.php');
require_once('models/EducationModel.php');
require_once('models/EmployeeModel.php');
require_once('models/PositionModel.php');
require_once('components/validate/employee/DepartmentValidate.php');
require_once('components/validate/employee/EducationValidate.php');

class EmployeeController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Employee';
        parent::__construct();
        $this->departmentModel = new DepartmentModel();
        $this->educationModel = new EducationModel();
        $this->employeeModel = new EmployeeModel();
        $this->positionModel = new PositionModel();
        $this->departmentValidate = new DepartmentValidate();
        $this->educationValidate = new EducationValidate();
    }

    public function index()
    {
        $employee = $this->employeeModel->getAll();
        $this->render('index', ['employees' => $employee]);
    }

    public function department(){
        $departments = $this->departmentModel->getAll();

        if(!isset($_POST['save'])){
            return $this->render('department/listDepartment', ['departments' => $departments]);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->departmentValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            return $this->render('department/listDepartment', $_POST);
        }
        $dataInsertAdmin = [
            'ma_phong_ban' => $_POST['departmentCode'],
            'ten_phong_ban' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->departmentModel->create($dataInsertAdmin)) {
            flash("success_message", DEPARTMENT_CREATED);
            redirect_to('/nhan-vien/phong-ban');
        }
    }

    public function editDepartment(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_DEPARTMENT);
            redirect_to('nhan-vien/phong-ban');
        }

        $id = (int)$_GET['id'];

        $department = $this->departmentModel->getById($id);
        if (empty($department)) {
            flash("error_message", CANT_FOUND_DEPARTMENT);
            redirect_to('nhan-vien/phong-ban');
        }
        if (empty($_POST)) {
            return $this->render('department/editDepartment', $department);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->departmentValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('department/editDepartment', $department);
        }

        $dataEditAdmin = [
            'ma_phong_ban' => $_POST['departmentCode'],
            'ten_phong_ban' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->departmentModel->update($dataEditAdmin, $id)) {
            flash("success_message", DEPARTMENT_UPDATED);
            redirect_to('/nhan-vien/phong-ban');
        }
    }

    public function deleteDepartment(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG);
        }
        $id = $_GET['id'];
        if ($this->departmentModel->delete($id)) {
            flash('success_message', DEPARTMENT_REMOVED);
        }
        redirect_to('/nhan-vien/phong-ban');
    }

    public function education(){
        $educations = $this->educationModel->getAll();

        if(!isset($_POST['save'])){
            return $this->render('education/listEducation', ['educations' => $educations]);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->departmentValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            return $this->render('department/listDepartment', $_POST);
        }
        $dataInsertAdmin = [
            'ma_trinh_do' => $_POST['positionCode'],
            'ten_trinh_do' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->educationModel->create($dataInsertAdmin)) {
            flash("success_message", EDUCATION_CREATED);
            redirect_to('/nhan-vien/trinh-do');
        }
    }

    public function editEducation(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_EDUCATION);
            redirect_to('nhan-vien/trinh-do');
        }

        $id = (int)$_GET['id'];

        $education = $this->educationModel->getById($id);
        if (empty($education)) {
            flash("error_message", CANT_FOUND_EDUCATION);
            redirect_to('nhan-vien/trinh-do');
        }
        if (empty($_POST)) {
            return $this->render('education/editEducation', $education);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->departmentValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('education/editEducation', $education);
        }

        $dataEditAdmin = [
            'ma_phong_ban' => $_POST['departmentCode'],
            'ten_phong_ban' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->departmentModel->update($dataEditAdmin, $id)) {
            flash("success_message", DEPARTMENT_UPDATED);
            redirect_to('/nhan-vien/phong-ban');
        }
    }

}
