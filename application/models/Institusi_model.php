<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Institusi_model extends CI_Model
{
    // public function unit_data()
    // {
    //     $sql = "select units.id as id,units.institusi_id as institusi_id,units.unit as unit,institusis.institusi as institusi from units join institusis where institusis.id=units.institusi_id";
    //     $data = $this->db->query($sql);
    //     return $data->result_array();
    // }
    public function ambil_data()
    {
        return $this->db->get('institusis')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db->get_where('institusis', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db->get_where('units', ['institusi_id' => $id])->row_array();
    }
    public function hapus($id)
    {
        $this->db->delete('institusis', ['id' => $id]);
    }
    public function simpan()
    {
        $data = array(
            'institusi' => $this->input->post('institusi'),
            'keterangan' => $this->input->post('keterangan')
        );
        $this->db->insert('institusis', $data);
    }
    public function ubah($id)
    {
        $data = array(
            'institusi' => $this->input->post('institusi'),
            'keterangan' => $this->input->post('keterangan')
        );
        $this->db->where('id', $id);
        $this->db->update('institusis', $data);
    }
}
