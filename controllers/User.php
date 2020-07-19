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
        $users = new Users();
        $users ->setLogin($_POST['login']);
        $users ->setPassword($_POST['password']);
        $users ->setRole($_POST['role']);
        $this->model->create($users);
        header('location: ' . URL . 'user');
    }

    public function edit($userid)
    {
        $this->view->title = 'User: Edit';
        $this->view->user = $this->model->userSingleList($userid);
        $this->view->render('user/edit');
    }

    public function editSave($userid)
    {
        $userEdit = new Users();
        $userEdit->setUserId($userid);
        $userEdit ->setLogin($_POST['login']);
        $userEdit ->setPassword($_POST['password']);
        $userEdit ->setRole($_POST['role']);
        $this->model->editSave($userEdit);
        header('location: ' . URL . 'User');
    }

    public function delete($userid)
    {
        $this->model->delete($userid);
        header('location: ' . URL . 'user');
    }

}