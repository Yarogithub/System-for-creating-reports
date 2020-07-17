<?php


class Login extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
       // echo Hash::create('sha256', 'test', HASH_PASSWORD_KEY);
        $this->view->title = 'Login';
        $this->view->render('login/index');
    }

    function run()
    {
        $Users = new Users();
        $Users ->setLogin($_POST['login']);
        $Users ->setPassword($_POST['password']);
        $Users ->setRole($_POST['role']);
        $this->model->run($Users);
    }

//    function reportRun()
//    {
//        $Reports = new ReportEnt();
//        $Reports ->setContent($_POST['content']);
//        $this->model->reportRun($Reports);
//
//    }
}