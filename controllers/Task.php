<?php


class Task extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        Auth::handleLogin();
    }

    public function index()
    {
        $this->view->title = 'Tasks';
        $this->view->get = $this->model->get();
        $this->view->departments = $this->model->getDepartments();
        $this->view->render('tasks/index');
    }

    public function getJSON()
    {
        $list = $this->view->get = $this->model->get();
        echo json_encode(['data' => $list]);
        die;
    }

    public function create()
    {
        $task = new Tasks();
        $task ->setName($_POST['name']);

        $taskValidator = new TaskValidator();
        $errors = $taskValidator->validateTask($task);

        if (!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors' => $errors]);
            die;
        }

        $taskid = $this->model->create($task);

        $departmentsTasks = new DepartmentsTasks();
        $departmentsTasks->setTaskid($taskid['id']);
        $departmentsTasks->setDepartmentid($_POST['departmentsId']);

        $this->model->createDepartmentsTasks($departmentsTasks);
        die;
    }

    public function editJSON($taskid)
    {
        $departmentsTasks = new DepartmentsTasks();
        $departmentsTasks->setTaskid($taskid);
        $list = $this->view->getActiveDepartments = $this->model->getActiveDepartments($departmentsTasks);
        echo json_encode(['data' => $list]);
        die;
    }


    public function edit($taskid)
    {
        $task = new Tasks();
        $task ->setName($_POST['name']);
        $task ->setId($taskid);

        $taskValidator = new TaskValidator();
        $errors = $taskValidator->validateTask($task);

        if (!empty($errors))
        {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(['errors' => $errors]);
            die;
        }

        $this->model->edit($task);

        $departmentsTasks = new DepartmentsTasks();
        $departmentsTasks->setTaskid($taskid);
        $departmentsTasks->setDepartmentid($_POST['departmentsId']);

        $this->model->editDepartmentsTasks($departmentsTasks);
        die;
    }

    public function delete($taskid)
    {
        $this->model->delete($taskid);
        die;
    }
}