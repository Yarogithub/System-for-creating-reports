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
//        die('sadadasda');
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

    public function forgotPassword()
    {
        $user = new Users();
        $user ->setLogin($_POST['loginCheck']);
        $user ->setToken(uniqid() . uniqid());


        $emailValidator = new EmailValidator();
        $errors = $emailValidator->validateEmail($user);


        if (!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors' => $errors]);
            die;
        }

        $subject = 'Set New Password';
        $body = 'http://localhost/reports/login/setNewPassword?token='.$user->getToken();


        $mailer = new Mailer();
        $mailer->mailerSend($_POST['loginCheck'],$subject,$body);

        $this->model->forgotPassword($user);
    }

    public function setNewPassword()
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $this->view->render('user/setNewPassword');
        }
        else
        {
            $token = $_GET['token'];
            $password = $_POST['setPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            $user = new Users();
            $user ->setPassword($password);
            $user ->setConfirmPassword($confirmPassword);
            $user ->setToken($token);

            $passwordValidator = new PasswordValidator();
            $errors = $passwordValidator->validateFirstPassword($user);

            if (!empty($errors))
            {
                header('HTTP/1.1 400 Bad Request');
                echo json_encode(['errors' => $errors]);
                die;
            }

            $this->model->setNewPassword($user);
        }
    }
}