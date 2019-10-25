<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends CI_Model
{
    public function user_data()
    {
        $sql = "select users.id as id,users.unit_id as unit_id,users.role_id as role_id,users.nama as nama,users.email as email,units.unit as unit,roles.role as role,users.is_active as is_active from users join units on units.id=users.unit_id join roles on roles.id=users.role_id order by units.id,users.id ASC";
        $data = $this->db->query($sql);
        return $data->result_array();
    }
}
