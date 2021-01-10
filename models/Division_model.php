<?php


class Division_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->db->selectAll('SELECT id, name FROM divisions');
    }

    public function create(Divisions $data)
    {
        $this->db->insert('divisions',
            [
                'name'=>$data->getName(),
            ]);
    }

    public function edit(Divisions $data)
    {
        $this->db->update('divisions',
            [
                'name'=>$data->getName(),
            ],
            "`id` =" . $data->getId());
    }

    public function delete($divisionid)
    {
        $this->db->delete('divisions', "id = $divisionid", 1);
    }
}