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

    public function userSingleList($userid)
    {
        return $this->db->selectOne('SELECT userid, login, role FROM user WHERE userid = :userid',
            [
                ':userid' => $userid
            ]);
    }

    public function create(Users $data)
    {
        $this->db->insert('user',
            [
            'login'=>$data->getLogin(),
            'password'=>password_hash($data->getPassword(),PASSWORD_DEFAULT),
            'role'=>$data->getRole()
            ]);
    }


    public function editSave(Users $data)
    {
      $this->db->update('user',
          [
              'login'=>$data->getLogin(),
              'password'=>password_hash($data->getPassword(),PASSWORD_DEFAULT),
              'role'=>$data->getRole()
          ],
          "`userid` =" . $data->getUserId());
    }

    public function delete($userid)
    {
        $sth = $this->db->prepare('SELECT role FROM user WHERE userid = :userid');
        $sth->execute(
            [
                ':userid' => $userid
            ]);
        $data = $sth->fetch();
        if ($data['role'] == 'admin')
        {
            return false;
        }


        $this->db->delete('user', "userid = $userid");
    }

}