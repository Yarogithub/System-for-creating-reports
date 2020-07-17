<?php


class Login_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

//    public function reportRun(ReportEnt $value)
//    {
//        $sth = $this->db->prepare("SELECT reportid, userid FROM report as r, user as u where r.userid = u.userid and content = :content ");
//        $sth->execute(array(
//            ':content' => $value->getContent()
//        ));
//
//        $data = $sth->fetch();
//
//        Session::init();
//        //Session::set('role', $data['role']);
//        Session::set('loggedIn', true);
//        Session::set('reportid', $data['reportid']);
//        Session::set('userid', $data['userid']);
//
//    }

    public function run(Users $values)
    {
        $sth = $this->db->prepare("SELECT userid, role FROM user WHERE 	login = :login AND password = :password");
        $sth->execute(array(
            ':login' => $values->getLogin(),
            ':password' => $values->getPassword(),
        ));

        $data = $sth->fetch();

        $count =  $sth->rowCount();
        if ($count > 0) {
                // login
                Session::init();
                Session::set('role', $data['role']);
                Session::set('loggedIn', true);
                Session::set('userid', $data['userid']);
                header('location: ../Report');

        } else {
            header('location: ../Login');
        }

    }

}