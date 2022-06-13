<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/employee.php');
require_once('models/DepartmentModel.php');
require_once('models/EducationModel.php');
require_once('models/EmployeeModel.php');
require_once('models/PositionModel.php');
require_once('models/TechniqueModel.php');
require_once('components/validate/employee/BaseEmployeeValidate.php');
require_once('components/validate/employee/PositionValidate.php');

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
        $this->techniqueModel = new TechniqueModel();
        $this->baseEmployeeValidate = new BaseEmployeeValidate();
        $this->positionValidate = new PositionValidate();
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
        $validateStatus = $this->baseEmployeeValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            return $this->render('department/listDepartment', ['departments' => $departments, 'post' => $_POST]);
        }
        $dataInsertDepartment = [
            'ma_phong_ban' => $_POST['departmentCode'],
            'ten_phong_ban' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->departmentModel->create($dataInsertDepartment)) {
            flash("success_message", DEPARTMENT_CREATED);
            return redirect_to('/nhan-vien/phong-ban');
        }
    }

    public function editDepartment(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_DEPARTMENT, 'alert alert-danger');
            redirect_to('/nhan-vien/phong-ban');
        }

        $id = (int)$_GET['id'];

        $department = $this->departmentModel->getById($id);
        if (empty($department)) {
            flash("error_message", CANT_FOUND_DEPARTMENT, 'alert alert-danger');
            redirect_to('/nhan-vien/phong-ban');
        }
        if (empty($_POST)) {
            return $this->render('department/editDepartment', $department);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->baseEmployeeValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('department/editDepartment', $department);
        }

        $dataEditDepartment = [
            'ma_phong_ban' => $_POST['departmentCode'],
            'ten_phong_ban' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->departmentModel->update($dataEditDepartment, $id)) {
            flash("success_message", DEPARTMENT_UPDATED);
            redirect_to('/nhan-vien/phong-ban');
        }
    }

    public function deleteDepartment(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG, 'alert alert-danger');
        }
        $id = $_GET['id'];
        if ($this->departmentModel->delete($id)) {
            flash('success_message', DEPARTMENT_REMOVED);
        }
        return redirect_to('/nhan-vien/phong-ban');
    }

    public function education(){
        $educations = $this->educationModel->getAll();

        if(!isset($_POST['save'])){
            return $this->render('education/listEducation', ['educations' => $educations]);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->baseEmployeeValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            return $this->render('department/listDepartment', ['educations' => $educations, 'post' => $_POST]);
        }
        $dataInsertEducation = [
            'ma_trinh_do' => $_POST['educationCode'],
            'ten_trinh_do' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->educationModel->create($dataInsertEducation)) {
            flash("success_message", EDUCATION_CREATED);
            redirect_to('/nhan-vien/trinh-do');
        }
    }

    public function editEducation(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_EDUCATION, 'alert alert-danger');
            return redirect_to('nhan-vien/trinh-do');
        }

        $id = (int)$_GET['id'];

        $education = $this->educationModel->getById($id);
        if (empty($education)) {
            flash("error_message", CANT_FOUND_EDUCATION, 'alert alert-danger');
            return redirect_to('/nhan-vien/trinh-do');
        }
        if (empty($_POST)) {
            return $this->render('education/editEducation', $education);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->baseEmployeeValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('education/editEducation', $education);
        }

        $dataEditEducation = [
            'ma_trinh_do' => $_POST['educationCode'],
            'ten_trinh_do' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->educationModel->update($dataEditEducation, $id)) {
            flash("success_message", EDUCATION_UPDATED);
            redirect_to('/nhan-vien/trinh-do');
        }
    }

    public function deleteEducation(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG);
        }
        $id = $_GET['id'];
        if ($this->educationModel->delete($id)) {
            flash('success_message', EDUCATION_REMOVED);
        }
        return redirect_to('/nhan-vien/trinh-do');
    }

    public function position(){
        $positions = $this->positionModel->getAll();
        if(!isset($_POST['save'])){
            return $this->render('position/listPosition', ['positions' => $positions]);
        }


        $validatePostData = $this->getParams();
        $validateStatus = $this->positionValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            return $this->render('position/listPosition', ['positions' => $positions, 'post' => $_POST]);
        }
        $dataInsertPosition = [
            'ma_chuc_vu' => $_POST['positionCode'],
            'ten_chuc_vu' => $_POST['name'],
            'luong_ngay' => $_POST['salary'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->positionModel->create($dataInsertPosition)) {
            flash("success_message", POSITION_CREATED);
            return redirect_to('/nhan-vien/chuc-vu');
        }
    }

    public function editPosition(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_POSITION, 'alert alert-danger');
            return redirect_to('/nhan-vien/chuc-vu');
        }

        $id = (int)$_GET['id'];

        $position = $this->positionModel->getById($id);
        if (empty($position)) {
            flash("error_message", CANT_FOUND_POSITION, 'alert alert-danger');
            return redirect_to('/nhan-vien/chuc-vu');
        }

        if (empty($_POST)) {
            return $this->render('position/editPosition', $position);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->positionValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('position/editPosition', $position);
        }

        $dataEditPosition = [
            'ma_chuc_vu' => $_POST['positionCode'],
            'ten_chuc_vu' => $_POST['name'],
            'luong_ngay' => $_POST['salary'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->positionModel->update($dataEditPosition, $id)) {
            flash("success_message", POSITION_UPDATED);
            return redirect_to('/nhan-vien/chuc-vu');
        }
    }

    public function deletePosition(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG);
        }
        $id = $_GET['id'];
        if ($this->positionModel->delete($id)) {
            flash('success_message', POSITION_REMOVED);
        }
        return redirect_to('/nhan-vien/chuc-vu');
    }

    public function technique(){
        $techniques = $this->techniqueModel->getAll();
        if(!isset($_POST['save'])){
            return $this->render('technique/listTechnique', ['techniques' => $techniques]);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->baseEmployeeValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            return $this->render('technique/listTechnique', ['techniques' => $techniques, 'post' => $_POST]);
        }
        $dataInsertTechnique = [
            'ma_chuyen_mon' => $_POST['techniqueCode'],
            'ten_chuyen_mon' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->techniqueModel->create($dataInsertTechnique)) {
            flash("success_message", TECHNIQUE_CREATED);
            redirect_to('/nhan-vien/chuyen-mon');
        }
    }

    public function editTechnique(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_TECHNIQUE, 'alert alert-danger');
            return redirect_to('nhan-vien/chuyen-mon');
        }

        $id = (int)$_GET['id'];

        $technique = $this->techniqueModel->getById($id);
        if (empty($technique)) {
            flash("error_message", CANT_FOUND_TECHNIQUE, 'alert alert-danger');
            return redirect_to('/nhan-vien/chuyen-mon');
        }
        if (empty($_POST)) {
            return $this->render('technique/editTechnique', $technique);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->baseEmployeeValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('technique/editTechnique', $technique);
        }

        $dataEditTechnique = [
            'ma_chuyen_mon' => $_POST['techniqueCode'],
            'ten_chuyen_mon' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->techniqueModel->update($dataEditTechnique, $id)) {
            flash("success_message", TECHNIQUE_UPDATED);
            redirect_to('/nhan-vien/chuyen-mon');
        }
    }

    public function deleteTechnique(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG);
        }
        $id = $_GET['id'];
        if ($this->techniqueModel->delete($id)) {
            flash('success_message', TECHNIQUE_REMOVED);
        }
        return redirect_to('/nhan-vien/chuyen-mon');
    }
}
