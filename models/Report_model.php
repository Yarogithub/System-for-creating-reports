<?php


class Report_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function reportsEmployeeList($userid)
    {
        $reports =  $this->db->selectAll('SELECT r.reportid, r.numberOfHours, r.reportDate, r.createdAt, r.updatedAt, dailyTasks.timeForTask, dailyTasks.name FROM report as r,user as u JOIN dailyTasks where r.reportid=dailyTasks.reportid AND u.userid=r.userid AND u.userid = :userid ORDER BY r.reportid ASC',
            [
                ':userid' => $userid
            ]);

        $listOfReports = [];

        foreach ($reports as $key=>$value)
        {

            $listOfReports[] = [
                'reportid'=>$value['reportid'],
                'numberOfHours'=>$value['numberOfHours'],
                'tasks'=>[$value['name'].' - '.$value['timeForTask'].'h'],
                'reportDate'=>$value['reportDate'],
                'createdAt'=>$value['createdAt'],
                'updatedAt'=>$value['updatedAt'],
            ];
            if ($key > 0)
            {
                if($listOfReports[$key]['reportid'] == $listOfReports[$key-1]['reportid'])
                {
                    array_push($listOfReports[$key]['tasks'],$listOfReports[$key-1]['tasks'][0]);

                    $listOfReports[$key]['tasks'][0] = implode('<br/>',$listOfReports[$key]['tasks']);
                    unset($listOfReports[$key-1]);
                }
            }
        }

        foreach ($listOfReports as $value1)
        {
            $value1['tasks']=$value1['tasks'][0];
            $list[] = $value1;

        }

        return $list;
    }

    public function getFromRange($start,$end,$userid)
    {
        $reports =  $this->db->selectAll('SELECT r.reportid, r.numberOfHours, r.reportDate, r.createdAt, r.updatedAt, dailyTasks.timeForTask, dailyTasks.name FROM report as r,user as u JOIN dailyTasks where r.reportid=dailyTasks.reportid AND reportDate BETWEEN :start AND :end AND u.userid=r.userid AND u.userid = :userid ORDER BY r.reportid ASC',
            [
                ':userid' => $userid,
                'start' => $start,
                'end' => $end
            ]);

        $listOfReports = [];

        foreach ($reports as $key=>$value)
        {

            $listOfReports[] = [
                'reportid'=>$value['reportid'],
                'numberOfHours'=>$value['numberOfHours'],
                'tasks'=>[$value['name'].' - '.$value['timeForTask'].'h'],
                'reportDate'=>$value['reportDate'],
                'createdAt'=>$value['createdAt'],
                'updatedAt'=>$value['updatedAt'],
            ];
            if ($key > 0)
            {
                if($listOfReports[$key]['reportid'] == $listOfReports[$key-1]['reportid'])
                {
                    array_push($listOfReports[$key]['tasks'],$listOfReports[$key-1]['tasks'][0]);

                    $listOfReports[$key]['tasks'][0] = implode('<br/>',$listOfReports[$key]['tasks']);
                    unset($listOfReports[$key-1]);
                }
            }
        }

        foreach ($listOfReports as $value1)
        {
            $value1['tasks']=$value1['tasks'][0];
            $list[] = $value1;

        }

        return $list;
    }


    public function reportsAdminList()
    {
        return $this->db->selectAll('SELECT * FROM report as r,user as u where u.userid=r.userid ');

    }

    public function getTasks($userid,$keyword)
    {
        return $this->db->selectAll("SELECT tasks.id, tasks.name as value FROM tasks WHERE tasks.name LIKE '%' :keyword '%' AND tasks.id IN (SELECT departments_tasks.taskid FROM departments_tasks WHERE departments_tasks.departmentid IN (SELECT user.departmentid FROM user WHERE user.userid=:userid))",
            [
                'keyword' => $keyword,
                'userid' => $userid,
            ]);
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
            'numberOfHours'=> $report->getNumberOfHours(),
            'createdAt'=>$report->getCreatedAt()->format('Y-m-d H:i:s'),
            'reportDate'=>$report->getReportDate(),
        ]);

        $reportid =  $this->db->selectOne('SELECT reportid FROM report WHERE reportDate = :reportDate',
            [
               'reportDate' =>$report->getReportDate()
            ]);

        foreach ($report->getCompletedTasks() as $value)
        {
            $dataToSave[] = [
                'reportid'=>$reportid['reportid'],
                'timeForTask'=>$value['time'],
                'name'=>$value['task']
            ];
        }

        $datafields = ['reportid','timeForTask','name'];

        $this->db->insertMultiple('dailyTasks', $dataToSave,$datafields);
    }

    public function edit(ReportEnt $reportEdit)
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
    }


}