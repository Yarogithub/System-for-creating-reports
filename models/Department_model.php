<?php


class Department_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->db->selectAll('SELECT departments.id, divisions.name as divisionName, departments.name as name FROM departments JOIN divisions WHERE divisions.id=departments.divisionid');
    }

    public function create(Departments $data)
    {
        $this->db->insert('departments',
            [
                'name'=>$data->getName(),
                'divisionid'=>$data->getDivisionId(),
            ]);
    }

    public function edit(Departments $data)
    {
        $this->db->update('departments',
            [
                'name'=>$data->getName(),
                'divisionid'=>$data->getDivisionId(),
            ],
            "`id` =" . $data->getId());
    }

    public function delete($departmentid)
    {
        $this->db->delete('departments', "id = $departmentid", 1);
    }

    public function getDivisions()
    {
        return $this->db->selectAll('SELECT id, name FROM divisions');
    }

    public function getActiveDivisions(Departments $data)
    {
        return $this->db->selectAll("SELECT divisions.id, divisions.name FROM divisions WHERE divisions.id IN (SELECT departments.divisionid FROM departments WHERE id = :id)",
            [
                'id'=>$data->getId()
            ]);
    }
}