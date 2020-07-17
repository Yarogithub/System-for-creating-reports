<?php


class User extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    public function index()
    {
        $this->view->title = 'User';
        $this->view->userList = $this->model->userList();
        $this->view->render('user/index');
    }


    public function create()
    {
        $Users = new Users();
        $Users ->setLogin($_POST['login']);
        $Users ->setPassword($_POST['password']);
        $Users ->setRole($_POST['role']);
//        $Users ->setUserId($_POST['id']);
        $this->model->create($Users);
    }

}