<?php


class Position_model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        return $this->db->selectAll('SELECT id, name  FROM positions');
    }

    public function create(Positions $data)
    {
        $this->db->insert('positions',
            [
                'name'=>$data->getName(),
            ]);
    }

    public function edit(Positions $data)
    {
        $this->db->update('positions',
            [
                'name'=>$data->getName(),
            ],
            "`id` =" . $data->getId());
    }

    public function delete($positionid)
    {
        $this->db->delete('positions', "id = $positionid", 1);
    }
}