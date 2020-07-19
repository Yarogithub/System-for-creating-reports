<?php


class Report_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function reportsEmployeeList($userid)
    {
        return $this->db->selectAll('SELECT r.reportid,r.content,r.createdAt FROM report as r,user as u where u.userid=r.userid and u.userid = :userid',
            [
                ':userid' => $userid
            ]);
    }

    public function reportsAdminList()
    {
        return $this->db->selectAll('SELECT * FROM report as r,user as u where u.userid=r.userid ');

    }

    public function create(ReportEnt $report)
    {
        $this->db->insert('report',
        [
           'userid'=> $report->getUserid(),
           'content'=> $report->getContent(),
            'createdAt'=>$report->getCreatedAt()->format('Y-m-d H:i:s')
        ]);



    }


}