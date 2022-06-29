<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/employee.php');
require_once('models/employee/DepartmentModel.php');
require_once('models/employee/EducationModel.php');
require_once('models/EmployeeModel.php');
require_once('models/employee/PositionModel.php');
require_once('models/employee/TechniqueModel.php');
require_once('models/employee/DegreeModel.php');
require_once('models/employee/TypeModel.php');
require_once('models/employee/NationalityModel.php');
require_once('models/employee/EthnicModel.php');
require_once('models/employee/ReligionModel.php');
require_once('models/employee/MarriageModel.php');
require_once('components/validate/EmployeeValidate.php');
require_once('components/validate/employee/BaseEmployeeValidate.php');
require_once('components/validate/employee/PositionValidate.php');
require_once('components/PHPExcel/Classes/PHPExcel.php');

class EmployeeController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Employee';
//        parent::__construct();
        $this->departmentModel = new DepartmentModel();
        $this->educationModel = new EducationModel();
        $this->employeeModel = new EmployeeModel();
        $this->positionModel = new PositionModel();
        $this->techniqueModel = new TechniqueModel();
        $this->degreeModel = new DegreeModel();
        $this->typeModel = new TypeModel();
        $this->nationalityModel = new NationalityModel();
        $this->ethnicModel = new EthnicModel();
        $this->religionModel = new ReligionModel();
        $this->marriageModel = new MarriageModel();
        $this->marriageModel = new MarriageModel();
        $this->employeeValidate = new EmployeeValidate();
        $this->baseEmployeeValidate = new BaseEmployeeValidate();
        $this->positionValidate = new PositionValidate();
    }

    public function index()
    {
        $employee = $this->employeeModel->getAll();
        $this->render('index', ['employees' => $employee]);
    }

    public function create()
    {
        $dataView = [
            'departments' => $this->departmentModel->getAll(),
            'educations' => $this->educationModel->getAll(),
            'employees' => $this->employeeModel->getAll(),
            'positions' => $this->positionModel->getAll(),
            'techniques' => $this->techniqueModel->getAll(),
            'degrees' => $this->degreeModel->getAll(),
            'types' => $this->typeModel->getAll(),
            'nationalities' => $this->nationalityModel->getAll(),
            'ethnics' => $this->ethnicModel->getAll(),
            'religions' => $this->religionModel->getAll(),
            'marriages' => $this->marriageModel->getAll(),
        ];
        if (empty($_POST)) {
            return $this->render('create', $dataView);
        }

        $validatePostData = $this->getParams();

        $validateStatus = $this->employeeValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            $dataView['post'] = $_POST;
            return $this->render('create', $dataView);
        }
        $imageName = '';
        if(!empty($_FILES['avatar']['name'])){
            $target_dir = IMG_LOCATION . 'employee/';
            $path = $_FILES['avatar']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $imageName = time() . "." . $ext;
            $target_file = $target_dir . $imageName;
        }

        $dataInsertEmployee = [
            'ma_nv' => isset($_POST['employeeCode']) ? $_POST['employeeCode'] : '',
            'ten_nv' => isset($_POST['name']) ? $_POST['name'] : '',
            'biet_danh' => isset($_POST['nickName']) ? $_POST['nickName'] : '',
            'hon_nhan_id' => isset($_POST['marriage']) ? $_POST['marriage'] : '',
            'so_cmnd' => isset($_POST['identify']) ? $_POST['identify'] : '',
            'ngay_cap_cmnd' => isset($_POST['identify_time']) ? $_POST['identify_time'] : '',
            'noi_cap_cmnd' => isset($_POST['identify_place']) ? $_POST['identify_place'] : '',
            'quoc_tich_id' => isset($_POST['nationality']) ? $_POST['nationality'] : '',
            'ton_giao_id' => isset($_POST['religion']) ? $_POST['religion'] : '',
            'dan_toc_id' => isset($_POST['ethnic']) ? $_POST['ethnic'] : '',
            'loai_nv_id' => isset($_POST['type']) ? $_POST['type'] : '',
            'bang_cap_id' => isset($_POST['degree']) ? $_POST['degree'] : '',
            'trang_thai' => isset($_POST['status']) ? $_POST['status'] : '',
            'hinh_anh' => isset($imageName) ? $imageName : '',
            'gioi_tinh' => isset($_POST['gender']) ? $_POST['gender'] : '',
            'ngay_sinh' => isset($_POST['birthday']) ? $_POST['birthday'] : '',
            'noi_sinh' => isset($_POST['placeOfBirth']) ? $_POST['placeOfBirth'] : '',
            'nguyen_quan' => isset($_POST['domicile']) ? $_POST['domicile'] : '',
            'ho_khau' => isset($_POST['residence']) ? $_POST['residence'] : '',
            'tam_tru' => isset($_POST['tabernacle']) ? $_POST['tabernacle'] : '',
            'phong_ban_id' => isset($_POST['department']) ? $_POST['department'] : '',
            'chuc_vu_id' => isset($_POST['position']) ? $_POST['position'] : '',
            'trinh_do_id' => isset($_POST['education']) ? $_POST['education'] : '',
            'chuyen_mon_id' => isset($_POST['technique']) ? $_POST['technique'] : '',
        ];
        if ($this->employeeModel->create($dataInsertEmployee)) {
            move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
            flash("success_message", EMPLOYEE_CREATED);
            return redirect_to('/nhan-vien');
        }
    }

    public function edit(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_EMPLOYEE, 'alert alert-danger');
            redirect_to('/nhan-vien');
        }

        $id = (int)$_GET['id'];
        $employee = $this->employeeModel->getById($id);

        if (empty($employee)) {
            flash("error_message", CANT_FOUND_EMPLOYEE, 'alert alert-danger');
            redirect_to('/nhan-vien');
        }

        $dataView = [
            'departments' => $this->departmentModel->getAll(),
            'educations' => $this->educationModel->getAll(),
            'employee' => $this->employeeModel->getById($id),
            'positions' => $this->positionModel->getAll(),
            'techniques' => $this->techniqueModel->getAll(),
            'degrees' => $this->degreeModel->getAll(),
            'types' => $this->typeModel->getAll(),
            'nationalities' => $this->nationalityModel->getAll(),
            'ethnics' => $this->ethnicModel->getAll(),
            'religions' => $this->religionModel->getAll(),
            'marriages' => $this->marriageModel->getAll(),
        ];

        if (empty($_POST)) {
            return $this->render('edit', $dataView);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->employeeValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('edit', $dataView);
        }

        $imageName = $employee['hinh_anh'];
        if(!empty($_FILES['avatar']['name'])){
            $target_dir = IMG_LOCATION . 'employee/';
            $path = $_FILES['avatar']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $imageName = time() . "." . $ext;
            $target_file = $target_dir . $imageName;
        }

        $dataEditEmployee = [
            'ma_nv' => isset($_POST['employeeCode']) ? $_POST['employeeCode'] : '',
            'ten_nv' => isset($_POST['name']) ? $_POST['name'] : '',
            'biet_danh' => isset($_POST['nickName']) ? $_POST['nickName'] : '',
            'hon_nhan_id' => isset($_POST['marriage']) ? $_POST['marriage'] : '',
            'so_cmnd' => isset($_POST['identify']) ? $_POST['identify'] : '',
            'ngay_cap_cmnd' => isset($_POST['identify_time']) ? $_POST['identify_time'] : '',
            'noi_cap_cmnd' => isset($_POST['identify_place']) ? $_POST['identify_place'] : '',
            'quoc_tich_id' => isset($_POST['nationality']) ? $_POST['nationality'] : '',
            'ton_giao_id' => isset($_POST['religion']) ? $_POST['religion'] : '',
            'dan_toc_id' => isset($_POST['ethnic']) ? $_POST['ethnic'] : '',
            'loai_nv_id' => isset($_POST['type']) ? $_POST['type'] : '',
            'bang_cap_id' => isset($_POST['degree']) ? $_POST['degree'] : '',
            'trang_thai' => isset($_POST['status']) ? $_POST['status'] : '',
            'hinh_anh' => isset($imageName) ? $imageName : '',
            'gioi_tinh' => isset($_POST['gender']) ? $_POST['gender'] : '',
            'ngay_sinh' => isset($_POST['birthday']) ? $_POST['birthday'] : '',
            'noi_sinh' => isset($_POST['placeOfBirth']) ? $_POST['placeOfBirth'] : '',
            'nguyen_quan' => isset($_POST['domicile']) ? $_POST['domicile'] : '',
            'ho_khau' => isset($_POST['residence']) ? $_POST['residence'] : '',
            'tam_tru' => isset($_POST['tabernacle']) ? $_POST['tabernacle'] : '',
            'phong_ban_id' => isset($_POST['department']) ? $_POST['department'] : '',
            'chuc_vu_id' => isset($_POST['position']) ? $_POST['position'] : '',
            'trinh_do_id' => isset($_POST['education']) ? $_POST['education'] : '',
            'chuyen_mon_id' => isset($_POST['technique']) ? $_POST['technique'] : '',
        ];

        if ($this->employeeModel->update($dataEditEmployee, $id)) {
            if(isset($target_file)){
                move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
            }
            flash("success_message", EMPLOYEE_UPDATED);
            redirect_to('/nhan-vien');
        }
    }

    public function detail(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_EMPLOYEE, 'alert alert-danger');
            redirect_to('/nhan-vien');
        }

        $id = (int)$_GET['id'];

        $dataView = [
            'departments' => $this->departmentModel->getAll(),
            'educations' => $this->educationModel->getAll(),
            'employee' => $this->employeeModel->getById($id),
            'positions' => $this->positionModel->getAll(),
            'techniques' => $this->techniqueModel->getAll(),
            'degrees' => $this->degreeModel->getAll(),
            'types' => $this->typeModel->getAll(),
            'nationalities' => $this->nationalityModel->getAll(),
            'ethnics' => $this->ethnicModel->getAll(),
            'religions' => $this->religionModel->getAll(),
            'marriages' => $this->marriageModel->getAll(),
        ];

        return $this->render('detail', $dataView);
    }

    public function delete(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG, 'alert alert-danger');
        }
        $id = $_GET['id'];
        if ($this->employeeModel->delete($id)) {
            flash('success_message', EMPLOYEE_REMOVED);
        }
        return redirect_to('/nhan-vien');
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

    public function degree(){
        $degrees = $this->degreeModel->getAll();
        if(!isset($_POST['save'])){
            return $this->render('degree/listDegree', ['degrees' => $degrees]);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->baseEmployeeValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            return $this->render('degree/listDegree', ['degrees' => $degrees, 'post' => $_POST]);
        }
        $dataInsertDegree = [
            'ma_bang_cap' => $_POST['degreeCode'],
            'ten_bang_cap' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->degreeModel->create($dataInsertDegree)) {
            flash("success_message", DEGREE_CREATED);
            redirect_to('/nhan-vien/bang-cap');
        }
    }

    public function editDegree(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_TECHNIQUE, 'alert alert-danger');
            return redirect_to('nhan-vien/chuyen-mon');
        }

        $id = (int)$_GET['id'];

        $degree = $this->degreeModel->getById($id);
        if (empty($degree)) {
            flash("error_message", CANT_FOUND_DEGREE, 'alert alert-danger');
            return redirect_to('/nhan-vien/bang-cap');
        }
        if (empty($_POST)) {
            return $this->render('degree/editDegree', $degree);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->baseEmployeeValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('technique/editDegree', $degree);
        }

        $dataEditDegree = [
            'ma_bang_cap' => $_POST['degreeCode'],
            'ten_bang_cap' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->degreeModel->update($dataEditDegree, $id)) {
            flash("success_message", DEGREE_UPDATED);
            redirect_to('/nhan-vien/bang-cap');
        }
    }

    public function deleteDegree(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG);
        }
        $id = $_GET['id'];
        if ($this->degreeModel->delete($id)) {
            flash('success_message', DEGREE_REMOVED);
        }
        return redirect_to('/nhan-vien/bang-cap');
    }

    public function type(){
        $types = $this->typeModel->getAll();
        if(!isset($_POST['save'])){
            return $this->render('type/listType', ['types' => $types]);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->baseEmployeeValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            return $this->render('type/listType', ['types' => $types, 'post' => $_POST]);
        }
        $dataInsertType = [
            'ma_loai_nv' => $_POST['typeCode'],
            'ten_loai_nv' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->typeModel->create($dataInsertType)) {
            flash("success_message", DEGREE_CREATED);
            redirect_to('/nhan-vien/loai');
        }
    }

    public function editType(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_TYPE, 'alert alert-danger');
            return redirect_to('nhan-vien/chuyen-mon');
        }

        $id = (int)$_GET['id'];

        $type = $this->typeModel->getById($id);
        if (empty($type)) {
            flash("error_message", CANT_FOUND_TYPE, 'alert alert-danger');
            return redirect_to('/nhan-vien/loai');
        }
        if (empty($_POST)) {
            return $this->render('type/editType', $type);
        }

        $validatePostData = $this->getParams();
        $validateStatus = $this->baseEmployeeValidate->validateEdit($validatePostData);
        if (!$validateStatus) {
            return $this->render('type/editType', $type);
        }

        $dataEditType = [
            'ma_loai_nv' => $_POST['typeCode'],
            'ten_loai_nv' => $_POST['name'],
            'ghi_chu' => $_POST['description'],
        ];

        if ($this->typeModel->update($dataEditType, $id)) {
            flash("success_message", TYPE_UPDATED);
            redirect_to('/nhan-vien/loai');
        }
    }

    public function deleteType(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG);
        }
        $id = $_GET['id'];
        if ($this->typeModel->delete($id)) {
            flash('success_message', TYPE_REMOVED);
        }
        return redirect_to('/nhan-vien/loai');
    }

    public function export()
    {
        $result = $this->employeeModel->getAll();
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $rowCount = 2;

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'STT')
            ->setCellValue('B1', 'Mã nhân viên')
            ->setCellValue('C1', 'Tên nhân viên');
        foreach($result as $row){
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $rowCount-1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['ma_nv']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['ten_nv']);
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('employee_export.xlsx');

        flash('success_message', EMPLOYEE_EXPORTED);
            return redirect_to('/nhan-vien');

    }
}
