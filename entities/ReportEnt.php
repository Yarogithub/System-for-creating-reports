<?php


class ReportEnt
{
    protected $completedTasks;
    protected $numberOfHours;
    protected $updatedAt;
    protected $createdAt;
    protected $userid;
    protected $reportid;

    /**
     * @return mixed
     */
    public function getCompletedTasks()
    {
        return $this->completedTasks;
    }

    /**
     * @param mixed $completedTasks
     */
    public function setCompletedTasks($completedTasks)
    {
        $this->completedTasks = $completedTasks;
    }

    /**
     * @return mixed
     */
    public function getNumberOfHours()
    {
        return $this->numberOfHours;
    }

    /**
     * @param mixed $numberOfHours
     */
    public function setNumberOfHours($numberOfHours)
    {
        $this->numberOfHours = $numberOfHours;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getReportid()
    {
        return $this->reportid;
    }

    /**
     * @param mixed $reportid
     */
    public function setReportid($reportid)
    {
        $this->reportid = $reportid;
    }


    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}