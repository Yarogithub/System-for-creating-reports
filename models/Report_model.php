<?php


class Report_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function reportsList()
    {
        return $this->db->selectAll('SELECT raportid,content FROM report where user.userid=report.userid');

        /*$sth = $this->db->prepare('SELECT userid, login, role FROM user');
        $sth->execute();
        return $sth->fetchAll();*/
    }

}