<?php


class Login_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }


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