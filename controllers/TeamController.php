<?php
require_once('controllers/BaseController.php');
require_once('helpers/message.php');
require_once('helpers/account.php');
require_once('helpers/employee.php');
require_once('models/DetailTeamModel.php');
require_once('components/validate/TeamValidate.php');

class TeamController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'Team';
        parent::__construct();
        $this->teamValidate = new TeamValidate();
        $this->detailTeamModel = new DetailTeamModel();

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
        $team = $this->model->getById($_GET['id']);
        $teamCode = $team['ma_nhom'];
        $employees = $this->detailTeamModel->getAllByCode($teamCode);
        var_dump($employees);
        die;
        $this->render('detail');
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

}
