<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Unit_model extends CI_Model
{
    public function ambil_data()
    {
        $sql = "select units.id as id,units.institusi_id as institusi_id,units.unit as unit,institusis.institusi as institusi from units join institusis where institusis.id=units.institusi_id";
        $data = $this->db->query($sql);
        return $data->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db->get_where('units', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db->get_where('users', ['unit_id' => $id])->row_array();
    }
    public function hapus($id)
    {
        $this->db->delete('units', ['id' => $id]);
    }
    public function simpan()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'institusi_id' => $this->input->post('institusi_id'),
            'unit' => $this->input->post('unit')
        );
        $this->db->insert('units', $data);
    }
    public function ubah($id)
    {
        $data = array(
            'unit' => $this->input->post('unit'),
            'institusi_id' => $this->input->post('institusi_id')
        );
        $this->db->where('id', $id);
        $this->db->update('units', $data);
    }
}
