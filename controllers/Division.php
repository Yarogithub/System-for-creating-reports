<?php


class Division extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    public function index()
    {
        $this->view->title = 'Divisions';
        $this->view->get = $this->model->get();
        $this->view->render('divisions/index');
    }

    public function getJSON()
    {
        $list = $this->view->get = $this->model->get();
        echo json_encode(['data' => $list]);
        die;
    }

    public function create()
    {
        $division = new Divisions();
        $division ->setName($_POST['name']);

        $divisionValidator = new DivisionValidator();
        $errors = $divisionValidator->validateDivision($division);

        if (!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors' => $errors]);
            die;
        }

        $this->model->create($division);
        die;
    }

    public function edit($divisionid)
    {
        $division = new Divisions();
        $division->setId($divisionid);
        $division ->setName($_POST['name']);

        $divisionValidator = new DivisionValidator();
        $errors = $divisionValidator->validateDivision($division);

        if (!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors' => $errors]);
            die;
        }

        $this->model->edit($division);
        die;
    }

    public function delete($divisionid)
    {
        $this->model->delete($divisionid);
        die;
    }
}