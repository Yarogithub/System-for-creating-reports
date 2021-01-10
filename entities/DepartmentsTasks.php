<?php


class DepartmentsTasks
{
    protected $id;
    protected $taskid;
    protected $departmentid;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTaskid()
    {
        return $this->taskid;
    }

    /**
     * @param mixed $taskid
     */
    public function setTaskid($taskid)
    {
        $this->taskid = $taskid;
    }

    /**
     * @return mixed
     */
    public function getDepartmentid()
    {
        return $this->departmentid;
    }

    /**
     * @param mixed $departmentid
     */
    public function setDepartmentid($departmentid)
    {
        $this->departmentid = $departmentid;
    }

}