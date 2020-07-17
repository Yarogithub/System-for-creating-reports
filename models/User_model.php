<?php


class User_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function userList()
    {
        return $this->db->selectAll('SELECT userid, login, role FROM user');

    }

    public function create(Users $data)
    {
        $this->db->insert('user', array(
            'login'=>$data->getLogin(),
            'password'=>$data->getPassword(),
            'role'=>$data->getRole()
        ));
        header('location:../User');
    }

}