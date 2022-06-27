<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/employee.php');
require_once('models/DetailTeamModel.php');
require_once('models/EmployeeModel.php');
require_once('components/validate/TeamValidate.php');

class TeamController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Team';
        parent::__construct();
        $this->teamValidate = new TeamValidate();
        $this->detailTeamModel = new DetailTeamModel();
        $this->employeeModel = new EmployeeModel();
    }

    public function index(){
        $teams = $this->model->getAll();
        $this->render('index', ['teams' => $teams]);
    }

    public function create(){
        if (empty($_POST)) {
            return $this->render('create');
        }

        $validatePostData = $this->getParams();

        $validateStatus = $this->teamValidate->validateCreate($validatePostData);
        if (!$validateStatus) {
            $dataView['post'] = $_POST;
            return $this->render('create', $dataView);
        }
        $dataInsertTeam = [
            'ma_nhom' => isset($_POST['teamCode']) ? $_POST['teamCode'] : '',
            'ten_nhom' => isset($_POST['name']) ? $_POST['name'] : '',
            'mo_ta' => isset($_POST['description']) ? $_POST['description'] : '',

        ];
        if ($this->model->create($dataInsertTeam)) {
            flash("success_message", TEAM_CREATED);
            return redirect_to('/nhom');
        }
    }

    public function detail(){
        if (!isset($_GET['id'])) {
            flash("error_message", CANT_FOUND_TEAM, 'alert alert-danger');
            return redirect_to('/nhom');
        }

        $id = (int)$_GET['id'];

        $team = $this->model->getById($id);
        if (empty($team)) {
            flash("error_message", CANT_FOUND_TEAM, 'alert alert-danger');
            return redirect_to('/nhom');
        }

        $teamCode = $team['ma_nhom'];
        $teamDetails = $this->detailTeamModel->getAllByCode($teamCode);
        $employees = [];
        foreach ($teamDetails as $teamDetail){
            $id = $teamDetail['nhan_vien_id'];
            $employees[] = array_merge(getEmployeeInfo($id), ['teamDetailId' => $teamDetail['id']]);
        }
        $dataView = [
            'team' => $team,
            'employees' => $employees,
        ];
        if(isset($_GET['isEdit'])){
            $dataView['isEdit'] = true;
        }
        if(isset($_GET['isAddEmployee'])){
            $dataView['isAddEmployee'] = true;
            $dataView['allEmployee'] = $this->employeeModel->getAll();
        }

        if (empty($_POST)) {
            return $this->render('detail', $dataView);
        }

        if (isset($_POST['btn-edit'])){
            $id = $_POST['id'];
            $validatePostData = $this->getParams();
            $validateStatus = $this->teamValidate->validateEdit($validatePostData);
            if (!$validateStatus) {
                return $this->render("/nhom/chi-tiet-nhom/$id/sua", $team);
            }
            $dataEditTeam = [
                'ma_nhom' => $_POST['teamCode'],
                'ten_nhom' => $_POST['name'],
                'mo_ta' => $_POST['description'],
            ];

            if ($this->model->update($dataEditTeam, $id)) {
                flash("success_message", TEAM_UPDATED);
                return redirect_to("/nhom/chi-tiet-nhom/$id/sua");
            }
        }
        if (isset($_POST['btn-add'])){
            $id = $_POST['id'];
            $validatePostData = $this->getParams();
            $validateStatus = $this->teamValidate->validateAddEmployee($validatePostData);
            if (!$validateStatus) {
                return $this->render("/nhom/chi-tiet-nhom/$id/them-nhan-vien", $team);
            }
            $dataAddEmployee = [
                'ma_nhom' => $_POST['teamCode'],
                'nhan_vien_id' => $_POST['employee'],
            ];

            if ($this->detailTeamModel->create($dataAddEmployee)) {
                flash("success_message", EMPLOYEE_ADDED);
                return redirect_to("/nhom/chi-tiet-nhom/$id/them-nhan-vien");
            }
        }
    }

    public function delete(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG, 'alert alert-danger');
        }
        $id = $_GET['id'];
        if ($this->model->delete($id)) {
            flash('success_message', TEAM_REMOVED);
        }
        return redirect_to('/nhom');
    }

    public function deleteEmployee(){
        if (!isset($_GET['id'])) {
            flash('error_message', ST_WRONG, 'alert alert-danger');
        }
        $id = $_GET['id'];
        if ($this->detailTeamModel->delete($id)) {
            flash('success_message', EMPLOYEE_MOVED);
        }
        if(isset($_GET['teamId'])){
            $teamId = $_GET['teamId'];
            return redirect_to("/nhom/chi-tiet-nhom/$teamId");
        }
        flash('error_message', ST_WRONG, 'alert alert-danger');
        return redirect_to("/nhom");

    }

}
