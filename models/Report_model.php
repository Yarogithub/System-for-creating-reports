<?php


class Report_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function reportsEmployeeList($userid)
    {
        $reports =  $this->db->selectAll('SELECT r.reportid, r.numberOfHours, r.reportDate, r.createdAt, r.updatedAt FROM report as r,user as u WHERE u.userid=r.userid AND u.userid = :userid ORDER BY r.reportid ASC',
            [
                ':userid' => $userid
            ]);
//        $reports =  $this->db->selectAll('SELECT r.reportid, r.numberOfHours, r.reportDate, r.createdAt, r.updatedAt, dailyTasks.timeForTask, dailyTasks.name FROM report as r,user as u JOIN dailyTasks where r.reportid=dailyTasks.reportid AND u.userid=r.userid AND u.userid = :userid ORDER BY r.reportid ASC',
//            [
//                ':userid' => $userid
//            ]);
//
//        $listOfReports = [];
//
//        foreach ($reports as $key=>$value)
//        {
//
//            $listOfReports[] = [
//                'reportid'=>$value['reportid'],
//                'numberOfHours'=>$value['numberOfHours'],
//                'tasks'=>[$value['name'].' - '.$value['timeForTask'].'h'],
//                'reportDate'=>$value['reportDate'],
//                'createdAt'=>$value['createdAt'],
//                'updatedAt'=>$value['updatedAt'],
//            ];
//            if ($key > 0)
//            {
//                if($listOfReports[$key]['reportid'] == $listOfReports[$key-1]['reportid'])
//                {
//                    array_push($listOfReports[$key]['tasks'],$listOfReports[$key-1]['tasks'][0]);
//
//                    $listOfReports[$key]['tasks'][0] = implode('<br/>',$listOfReports[$key]['tasks']);
//                    unset($listOfReports[$key-1]);
//                }
//            }
//        }
//
//        foreach ($listOfReports as $value1)
//        {
//            $value1['tasks']=$value1['tasks'][0];
//            $list[] = $value1;
//
//        }

        return $reports;
    }



    public function getFromRange($start,$end,$userid)
    {

        $reports =  $this->db->selectAll('SELECT r.reportid, r.numberOfHours, r.reportDate, r.createdAt, r.updatedAt FROM report as r,user as u WHERE u.userid=r.userid AND reportDate BETWEEN :start AND :end AND u.userid = :userid ORDER BY r.reportid ASC',
            [
                ':userid' => $userid,
                'start' => $start,
                'end' => $end
            ]);
//        $reports =  $this->db->selectAll('SELECT r.reportid, r.numberOfHours, r.reportDate, r.createdAt, r.updatedAt, dailyTasks.timeForTask, dailyTasks.name FROM report as r,user as u JOIN dailyTasks where r.reportid=dailyTasks.reportid AND reportDate BETWEEN :start AND :end AND u.userid=r.userid AND u.userid = :userid ORDER BY r.reportid ASC',
//            [
//                ':userid' => $userid,
//                'start' => $start,
//                'end' => $end
//            ]);
//
//        $listOfReports = [];
//
//        foreach ($reports as $key=>$value)
//        {
//
//            $listOfReports[] = [
//                'reportid'=>$value['reportid'],
//                'numberOfHours'=>$value['numberOfHours'],
//                'tasks'=>[$value['name'].' - '.$value['timeForTask'].'h'],
//                'reportDate'=>$value['reportDate'],
//                'createdAt'=>$value['createdAt'],
//                'updatedAt'=>$value['updatedAt'],
//            ];
//            if ($key > 0)
//            {
//                if($listOfReports[$key]['reportid'] == $listOfReports[$key-1]['reportid'])
//                {
//                    array_push($listOfReports[$key]['tasks'],$listOfReports[$key-1]['tasks'][0]);
//
//                    $listOfReports[$key]['tasks'][0] = implode('<br/>',$listOfReports[$key]['tasks']);
//                    unset($listOfReports[$key-1]);
//                }
//            }
//        }
//
//        foreach ($listOfReports as $value1)
//        {
//            $value1['tasks']=$value1['tasks'][0];
//            $list[] = $value1;
//
//        }
//
        return $reports;
    }

    public function getFromRangeAdmin($start,$end)
    {

        $reports =  $this->db->selectAll('SELECT r.reportid, r.numberOfHours, r.reportDate, r.createdAt, r.updatedAt, u.name, u.lastName FROM report as r,user as u WHERE u.userid=r.userid AND reportDate BETWEEN :start AND :end ORDER BY r.reportid ASC',
            [
                'start' => $start,
                'end' => $end
            ]);
        return $reports;
    }


    public function reportsAdminList()
    {
        return $this->db->selectAll('SELECT r.reportid, r.numberOfHours, r.reportDate, r.createdAt, r.updatedAt, u.name, u.lastName FROM report as r,user as u WHERE u.userid=r.userid ORDER BY r.reportid ASC');
    }

    public function getForUser($userid)
    {
        return $this->db->selectAll('SELECT r.reportid, r.numberOfHours, r.reportDate, r.createdAt, r.updatedAt, u.name, u.lastName,u.hourlyRate FROM report as r,user as u WHERE u.userid=r.userid AND u.userid=:userid ORDER BY r.reportid ASC',[
            'userid'=>$userid
        ]);
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

        $reportid =  $this->db->selectOne('SELECT reportid FROM report WHERE reportDate = :reportDate AND userid=:userid',
            [
               'reportDate' =>$report->getReportDate(),
                'userid'=>$report->getUserid()
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

    public function editJSON(ReportEnt $data)
    {
        $report =  $this->db->selectAll('SELECT r.reportDate FROM report as r,user as u where u.userid=r.userid AND r.reportid = :reportid ORDER BY r.reportid ASC',
            [
                'reportid' => $data->getReportid()
            ]);

        $tasks = $this->db->selectAll('SELECT timeForTask, name FROM dailyTasks WHERE dailyTasks.reportid=:reportid',
            [
                'reportid' => $data->getReportid()
            ]);

        return [
          'report'=>$report,
          'tasks'=>$tasks
        ];
    }

    public function edit(ReportEnt $reportEdit)
    {
        $this->db->update('report',
            [
                'numberOfHours'=> $reportEdit->getNumberOfHours(),
                'reportDate'=>$reportEdit->getReportDate()
            ],
            "`reportid` =" . $reportEdit->getReportid());

        $dataToSave = [];
        $dailyTasks = $this->db->selectAll('SELECT *  FROM dailyTasks WHERE reportid=:reportid',
            [
                'reportid'=>$reportEdit->getReportid()
            ]);

        foreach ($dailyTasks as $key1=>$value1)
        {
            $check = array_search($value1['name'], array_column($reportEdit->getCompletedTasks(), 'task'));

            if ($check === false)
            {
                $this->db->delete('dailyTasks', "id =".$value1['id'], 1);
            }
        }

        foreach ($reportEdit->getCompletedTasks() as $key=>$value)
        {
            if (array_search($value['task'], array_column($dailyTasks, 'name')) === false)
            {
                $dataToSave[] = [
                    'reportid'=>$reportEdit->getReportid(),
                    'timeForTask'=>$value['time'],
                    'name'=>$value['task']
                ];
            }
        }

        if (!empty($dataToSave))
        {
            $datafields = ['reportid','timeForTask','name'];

            $this->db->insertMultiple('dailyTasks', $dataToSave,$datafields);
        }



    }

    public function delete($reportId)
    {
        $limit = $this->db->selectAll('SELECT *  FROM dailyTasks WHERE reportid=:reportid',
            [
                'reportid'=>$reportId
            ]);

        $this->db->delete('dailyTasks', "reportid = $reportId", count($limit));

        $this->db->delete('report', "reportid = $reportId", 1);
    }


    public function hourlyRate($userid)
    {
        return $this->db->selectOne('SELECT hourlyRate FROM user WHERE userid = :userid',
            [
                'userid' =>$userid
            ]);
    }

    public function usersList()
    {
        return $this->db->selectAll('SELECT userid,name,lastname  FROM user ');
    }

}