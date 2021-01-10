<?php


class Task_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->db->selectAll('SELECT id, name  FROM tasks');
    }

    public function create(Tasks $data)
    {
        $this->db->insert('tasks',
            [
                'name'=>$data->getName(),
            ]);
        return $this->db->selectOne('SELECT MAX(id) as id FROM tasks');
    }
    public function createDepartmentsTasks(DepartmentsTasks $data)
    {
        foreach ($data->getDepartmentid() as $value)
        {
            $dataToSave[] = [
              'taskid'=>$data->getTaskid(),
              'departmentid'=>$value
            ];
        }

        $datafields = ['taskid','departmentid'];

        $this->db->insertMultiple('departments_tasks', $dataToSave,$datafields);
    }

    public function edit(Tasks $data)
    {
        $this->db->update('tasks',
            [
                'name'=>$data->getName(),
            ],
            "`id` =" . $data->getId());
    }

    public function editDepartmentsTasks(DepartmentsTasks $data)
    {
        $dataToSave = [];
        $departmentsOfTask = $this->db->selectAll('SELECT *  FROM departments_tasks WHERE taskid=:taskid',
            [
                'taskid'=>$data->getTaskid()
            ]);

        foreach ($departmentsOfTask as $key1=>$value1)
        {
            $check = array_search($value1['departmentid'], $data->getDepartmentid());

            if ($check === false)
            {
                $this->db->delete('departments_tasks', "id =".$value1['id'], 1);
            }
        }

        foreach ($data->getDepartmentid() as $value)
        {
            if (array_search($value, array_column($departmentsOfTask, 'departmentid')) === false)
            {
                $dataToSave[] = [
                    'taskid'=>$data->getTaskid(),
                    'departmentid'=>$value
                ];
            }
        }

        if (!empty($dataToSave))
        {
            $datafields = ['taskid','departmentid'];
            $this->db->insertMultiple('departments_tasks', $dataToSave,$datafields);
        }
    }

    public function delete($taskid)
    {
        $limit = $this->db->selectAll('SELECT *  FROM departments_tasks WHERE taskid=:taskid',
            [
                'taskid'=>$taskid
            ]);

        $this->db->delete('departments_tasks', "taskid = $taskid", count($limit));
        $this->db->delete('tasks', "id = $taskid", 1);
    }

    public function getDepartments()
    {
        return $this->db->selectAll('SELECT id, name FROM departments');
    }

    public function getActiveDepartments(DepartmentsTasks $data)
    {
        return $this->db->selectAll("SELECT departments.id, departments.name FROM departments WHERE departments.id IN (SELECT departments_tasks.departmentid FROM departments_tasks WHERE taskid = :id)",
            [
                'id'=>$data->getTaskid()
            ]);
    }
}