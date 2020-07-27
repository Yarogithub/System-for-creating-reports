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

    public function reportsSingleRecord($reportid)
    {
        return $this->db->selectOne('SELECT reportid, content FROM report WHERE reportid = :reportid',
            [
                ':reportid' => $reportid
            ]);
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

    public function editSave(ReportEnt $reportEdit)
    {
        if(!$reportEdit->getReportid())
        {
           return;
        }
            $this->db->update('report',
                [
                    'userid'=> $reportEdit->getUserid(),
                    'content'=> $reportEdit->getContent(),
                    'createdAt'=>$reportEdit->getCreatedAt()->format('Y-m-d H:i:s')
                ],
                "`reportid` =" . $reportEdit->getReportid());


    }

    public function delete($reportId)
    {
    $this->db->delete('report', "reportid = $reportId", 1);
//    delete from report where reportid=5

    }


}