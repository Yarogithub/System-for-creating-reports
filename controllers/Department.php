<?php


class Department extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    public function index()
    {
        $this->view->title = 'Departments';
        $this->view->get = $this->model->get();
        $this->view->divisions = $this->model->getDivisions();
//        echo '<pre>';
//        print_r($this->view->divisions);
//        die;
        $this->view->render('departments/index');
    }

    public function getJSON()
    {
        $list = $this->view->get = $this->model->get();
        echo json_encode(['data' => $list]);
        die;
    }

    public function create()
    {
        $department = new Departments();
        $department ->setName($_POST['name']);
        $department ->setDivisionId($_POST['divisionId']);

        $departmentValidator = new DepartmentValidator();
        $errors = $departmentValidator->validateDepartment($department);

        if (!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors' => $errors]);
            die;
        }

        $this->model->create($department);
        die;
    }

    public function editJSON($departmentid)
    {
        $department = new Departments();
        $department->setId($departmentid);
        $list = $this->view->getActiveDepartments = $this->model->getActiveDivisions($department);
        echo json_encode(['data' => $list]);
        die;
    }

    public function edit($departmentid)
    {
        $department = new Departments();
        $department->setId($departmentid);
        $department ->setName($_POST['name']);
        $department ->setDivisionId($_POST['divisionId']);

        $departmentValidator = new DepartmentValidator();
        $errors = $departmentValidator->validateDepartment($department);

        if (!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors' => $errors]);
            die;
        }

        $this->model->edit($department);
        die;
    }

    public function delete($departmentid)
    {
        $this->model->delete($departmentid);
        die;
    }
}