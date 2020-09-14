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
            'role'=>$data->getRole(),
            'token'=>$data->getToken(),
            ]);
    }

    public function setFirstPassword(Users $data)
    {
        $this->db->update('user',
            [
                'password'=>password_hash($data->getPassword(),PASSWORD_DEFAULT),
            ],
            '`token` ="'.$data->getToken().'"' );

    }

    public function setNewPassword(Users $data)
    {
        $this->db->update('user',
            [
                'password'=>password_hash($data->getPassword(),PASSWORD_DEFAULT),
            ],
            '`token` ="'.$data->getToken().'"' );
    }

    public function forgotPassword(Users $data)
    {
        $this->db->update('user',
            [
                'token'=>$data->getToken(),
            ],
            '`login` ="'.$data->getLogin().'"' );
    }


    public function edit(Users $data)
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
//        $sth = $this->db->prepare('SELECT role FROM user WHERE userid = :userid');
//        $sth->execute(
//            [
//                ':userid' => $userid
//            ]);
//        $data = $sth->fetch();
//        if ($data['role'] == 'admin')
//        {
//            return false;
//        }


        $this->db->delete('user', "userid = $userid", 1);
    }

    /**
     * @param $login
     * @return mixed
     */
    public function getUserByLogin($login)
    {
        return $this->db->selectOne('SELECT * FROM user WHERE login = :login', [
            'login'=>$login,
        ]);

    }

}