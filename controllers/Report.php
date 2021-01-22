<?php


class Report extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    public function index()
    {

        $this->view->title = 'Daily reports';
        $this->view->reportsAdminList = $this->model->reportsAdminList();
        $this->view->hourlyRate = $this->model->hourlyRate($_SESSION['userid']);

        $this->view->users = $this->model->usersList();
        $this->view->reportsEmployeeList = $this->model->reportsEmployeeList($_SESSION['userid']);
        $this->view->render('report/index');
    }

    public function getJSONTasks()
    {
        $list = $this->view->tasks = $this->model->getTasks($_SESSION['userid'],$_GET['query']);
        echo(json_encode([
            'query' => 'Unit',
            'suggestions'=>$list
        ]));
        die;
    }


    public function getForUser($userid)
    {
            $list = $this->model->getForUser($userid);
            echo json_encode(['data' => $list]);
            die;
    }

    public function getFromRange()
    {
        $role = $_SESSION['role'];

//        print_r($role);
//        die;
        if($role == 'admin')
        {
            $list = $this->model->getFromRangeAdmin($_GET['from'],$_GET['to']);
            echo json_encode(['data' => $list]);
            die;
        }
        else
        {
            $list = $this->model->getFromRange($_GET['from'],$_GET['to'],$_SESSION['userid']);
            echo json_encode(['data' => $list]);
            die;
        }

    }

    public function editJSON($reportid)
    {
        $report = new  ReportEnt();
        $report->setReportid($reportid);

        $list = $this->model->editJSON($report);
        echo json_encode(['data' => $list]);
        die;
    }


    public function listJson()
    {
        $role = $_SESSION['role'];
        if($role == 'admin')
        {
            $list = $this->view->reportsAdminList = $this->model->reportsAdminList();
            echo json_encode(['data' => $list]);
            die;
        }
        else
        {
            $list = $this->model->reportsEmployeeList($_SESSION['userid']);
            echo json_encode(['data' => $list]);
            die;
        }
    }

    function logout()
    {
        Session::destroy();
        header('location: ' . URL .  'login');
        exit;
    }

     public function create()
     {
        $numberOfHours = array_sum(array_column($_POST['completedTasks'],'time'));
        $report = new ReportEnt();
        $report ->setCompletedTasks($_POST['completedTasks']);
        $report ->setUserid($_SESSION['userid']);
        $report ->setNumberOfHours($numberOfHours);
        $report ->setReportDate($_POST['reportDate']);

//         $reportValidator = new ReportValidator();
//         $errors = $reportValidator->validateReport($report);
//
//         if (!empty($errors))
//         {
//             header('HTTP/1.1 400 Bad Request');
//             echo json_encode(['errors' => $errors]);
//             die;
//         }

        $this->model->create($report);
        die;
     }


    public function edit($reportId)
    {
        $numberOfHours = array_sum(array_column($_POST['completedTasks'],'time'));
        $report = new ReportEnt();
        $report ->setCompletedTasks($_POST['completedTasks']);
        $report ->setReportid($reportId);
        $report ->setNumberOfHours($numberOfHours);
        $report ->setReportDate($_POST['reportDate']);

//        $reportValidator = new ReportValidator();
//        $errors = $reportValidator->validateReport($report);
//
//        if (!empty($errors))
//        {
//            header('HTTP/1.1 400 Bad Request');
//            echo json_encode(['errors' => $errors]);
//            die;
//        }

        $this->model->edit($report);
        die;
    }



    public function delete($reportId)
    {
        $this->model->delete($reportId);
        die;
    }


//    public function listJsonAdmin()
//    {
//        $list = $this->view->reportsAdminList = $this->model->reportsAdminList();
//        echo json_encode(['data' => $list]);
//        die;
//    }

}