<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Unit_model extends CI_Model
{
    public function unit_data()
    {
        $sql = "select units.id as id,units.institusi_id as institusi_id,units.unit as unit,institusis.institusi as institusi from units join institusis where institusis.id=units.institusi_id";
        $data = $this->db->query($sql);
        return $data->result_array();
    }
}
