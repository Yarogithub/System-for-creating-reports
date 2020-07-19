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

        $sth = $this->db->prepare("SELECT * FROM user WHERE 	login = :login");
        $sth->execute(
            [
            ':login' => $values->getLogin()
            ]);


        $data = $sth->fetch();


        if (!(password_verify($values->getPassword(), $data['password'])))
        {

        }

        $count =  $sth->rowCount();
        if ($count > 0) {
                // login
                Session::init();
                Session::set('role', $data['role']);
                Session::set('loggedIn', true);
                Session::set('userid', $data['userid']);
                header('location: ../Index');

        } else {
            header('location: ../Login');
        }

    }

}