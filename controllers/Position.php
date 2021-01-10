<?php


class Position extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    public function index()
    {
        $this->view->title = 'Positions';
        $this->view->get = $this->model->get();
        $this->view->render('positions/index');
    }

    public function getJSON()
    {
        $list = $this->view->get = $this->model->get();
        echo json_encode(['data' => $list]);
        die;
    }

    public function create()
    {
        $position = new Positions();
        $position ->setName($_POST['name']);

        $positionValidator = new PositionValidator();
        $errors = $positionValidator->validatePosition($position);

        if (!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors' => $errors]);
            die;
        }

        $this->model->create($position);
        die;
    }

    public function edit($positionid)
    {
        $position = new Positions();
        $position->setId($positionid);
        $position->setName($_POST['name']);

        $positionValidator = new PositionValidator();
        $errors = $positionValidator->validatePosition($position);

        if (!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors' => $errors]);
            die;
        }

        $this->model->edit($position);
        die;
    }

    public function delete($positionid)
    {
        $this->model->delete($positionid);
        die;
    }
}