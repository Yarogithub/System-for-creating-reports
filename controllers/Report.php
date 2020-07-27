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

        $this->view->reportsEmployeeList = $this->model->reportsEmployeeList($_SESSION['userid']);
        $this->view->render('report/index');
    }

    function logout()
    {
        Session::destroy();
        header('location: ' . URL .  'login');
        exit;
    }
     public function create()
     {
        $report = new ReportEnt();
        $report ->setContent($_POST['content']);
        $report ->setUserid($_SESSION['userid']);
        $this->model->create($report);
        header('location: ' . URL . 'report');
     }

    public function edit($reportId)
    {
        $this->view->title = 'Report: Edit';
        $this->view->report = $this->model->reportsSingleRecord($reportId);
        $this->view->render('report/edit');
    }

    public function editSave($reportId)
    {
        $reportEdit = new ReportEnt();
        $reportEdit ->setContent($_POST['content']);
        $reportEdit ->setUserid($_SESSION['userid']);
        $reportEdit ->setReportid($reportId);
        $this->model->editSave($reportEdit);
        header('location: ' . URL . 'report');
    }

    public function delete($reportId)
    {
        $this->model->delete($reportId);
        header('location: ' . URL . 'report');
    }

}