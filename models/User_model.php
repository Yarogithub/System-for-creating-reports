<?php


class User_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function userList()
    {
        return $this->db->selectAll('SELECT userid, login, role, name, lastName, hourlyRate FROM user');
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
            'name'=>$data->getName(),
            'lastName'=>$data->getLastName(),
            'phoneNumber'=>$data->getPhoneNumber(),
            'postalCode'=>$data->getPostalCode(),
            'country'=>$data->getCountry(),
            'city'=>$data->getCity(),
            'hourlyRate'=>$data->getHourlyRate(),
            'departmentid'=>$data->getDepartmentid(),
            'positionid'=>$data->getPositionid()
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

    public function setNewPassword($data)
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
              'role'=>$data->getRole(),
              'name'=>$data->getName(),
              'lastName'=>$data->getLastName(),
              'phoneNumber'=>$data->getPhoneNumber(),
              'postalCode'=>$data->getPostalCode(),
              'country'=>$data->getCountry(),
              'city'=>$data->getCity(),
              'hourlyRate'=>$data->getHourlyRate(),
              'departmentid'=>$data->getDepartmentid(),
              'positionid'=>$data->getPositionid()
          ],
          "`userid` =" . $data->getUserId());
    }



    public function delete($userid)
    {
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

    public function getDepartments()
    {
        return $this->db->selectAll('SELECT id, name FROM departments');
    }

    public function getPositions()
    {
        return $this->db->selectAll('SELECT id, name FROM positions');
    }

    public function getActiveDepartmentsPositions(Users $data)
    {
        $department = $this->db->selectAll("SELECT departments.id, departments.name FROM departments WHERE departments.id IN (SELECT user.departmentid FROM user WHERE userid = :userid)",
            [
                'userid'=>$data->getUserId()
            ]);
        $position = $this->db->selectAll("SELECT positions.id, positions.name FROM positions WHERE positions.id IN (SELECT user.positionid FROM user WHERE userid = :userid)",
            [
                'userid'=>$data->getUserId()
            ]);

        $user = $this->db->selectAll("SELECT name, lastName, phoneNumber, postalCode, country, city, hourlyRate FROM user WHERE userid=:userid ",
            [
                'userid'=>$data->getUserId()
            ]);

        return [
            'department'=> $department,
            'position'=> $position,
            'user'=> $user,
            ];

    }

}