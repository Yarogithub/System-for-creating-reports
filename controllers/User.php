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

    public function listJsonUsers()
    {
        $list = $this->view->userList = $this->model->userList();
        echo json_encode(['data' => $list]);
        die;
    }


    public function create()
    {
        $users = new Users();
        $users ->setLogin($_POST['login']);
        $users ->setPassword($_POST['password']);
        $users ->setRole($_POST['role']);
        $users ->setToken(uniqid() . uniqid());

        $userValidator = new UserValidator();
        $errors = $userValidator->validateUser($users);

        if (!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors' => $errors]);
            die;
        }

        $subject = 'Set First Password';
        $body = 'http://localhost/reports/user/setFirstPassword?token='.$users->getToken();


        $mailer = new Mailer();
        $mailer->mailerSend($_POST['login'],$subject,$body);

        $this->model->create($users);
        die;
    }

    public function setFirstPassword()
    {

        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $this->view->render('user/setFirstPassword');
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

            $this->model->setFirstPassword($user);
        }

    }


    public function edit($userid)
    {
        $userEdit = new Users();
        $userEdit->setUserId($userid);
        $userEdit ->setLogin($_POST['login']);
        $userEdit ->setPassword($_POST['password']);
        $userEdit ->setRole($_POST['role']);

        $userValidator = new UserValidator();
        $errors = $userValidator->validateUser($userEdit);

        if (!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors' => $errors]);
            die;
        }

        $this->model->edit($userEdit);
        die;
    }

    public function delete($userid)
    {
        $this->model->delete($userid);
        die;
    }

}