<?php


class ReportEnt
{
    protected $content;
    protected $createdAt;
    protected $userid;
    protected $reportid;

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
    public function getContent()
    {
        return $this->content;
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

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}