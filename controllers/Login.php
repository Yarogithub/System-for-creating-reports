<?php

require_once __DIR__ . "/../models/User_model.php";

class Login extends Controllers
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new User_model();
    }

    function index()
    {
        $this->view->title = 'Login';
        $this->view->render('login/index');
    }

    function run()
    {
        $errors = [];


        if (!$_POST['login']){
            $errors['login'] = 'You have to fill this field';
        }

        if (!$_POST['password']){
            $errors['password'] = 'You have to fill this field';
        }

        $user = $this->model->getUserByLogin($_POST['login']);

        if(!empty($user['login']))
        {

            $verify = (password_verify($_POST['password'], $user['password']));

            if ($verify == false)
            {
                $errors['password'] = 'Incorrect password';
            }
        }else{
            $errors['login'] = 'This user doesnt exist ';
        }



        if(!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors'=>$errors]);
            die;
        }

        Session::init();
        Session::set('role', $user['role']);
        Session::set('loggedIn', true);
        Session::set('userid', $user['userid']);

    }
}