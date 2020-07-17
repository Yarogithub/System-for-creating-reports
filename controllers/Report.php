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
        $this->view->reportsList = $this->model->reportsList();
        $this->view->render('report/index');
    }

    function logout()
    {
        Session::destroy();
        header('location: ' . URL .  'login');
        exit;
    }
}