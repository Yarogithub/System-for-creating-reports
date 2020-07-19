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
        $users = new Users();
        $users ->setLogin($_POST['login']);
        $users ->setPassword($_POST['password']);
        $users ->setRole($_POST['role']);
        $this->model->run($users);
    }

//    function reportRun()
//    {
//        $Reports = new ReportEnt();
//        $Reports ->setContent($_POST['content']);
//        $this->model->reportRun($Reports);
//
//    }
}