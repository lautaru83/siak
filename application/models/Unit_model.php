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
    public function hapus($id, $info)
    {
        $this->db->delete('units', ['id' => $id]);
        $tipe = "hapus";
        $desc = $id . "-" . $info;
        $this->_log($tipe, $desc);
    }
    public function simpan()
    {
        $id = $this->input->post('id');
        $unit = htmlspecialchars($this->input->post('unit'));
        $institusi_id = $this->input->post('institusi_id');
        $data = array(
            'id' => $id,
            'institusi_id' => $institusi_id,
            'unit' => $unit
        );
        $this->db->insert('units', $data);
        $tipe = "simpan";
        $desc = $id . "-" . $unit . "-" . $institusi_id;
        $this->_log($tipe, $desc);
    }
    public function ubah($id)
    {
        $unit = htmlspecialchars($this->input->post('unit'));
        $institusi_id = $this->input->post('institusi_id');
        $data = array(
            'institusi_id' => $institusi_id,
            'unit' => $unit
        );
        $this->db->where('id', $id);
        $this->db->update('units', $data);
        $tipe = "ubah";
        $desc =  $id . "-" . $unit . "-" . $institusi_id;
        $this->_log($tipe, $desc);
    }
    private function _log($tipe, $desc)
    {
        $log_data = array(
            'user_id' => $this->session->userdata('xyz'),
            'user_name' => $this->session->userdata('nama_user'),
            'log_addr' => "unit",
            'log_type' => $tipe,
            'log_desc' => $desc
        );
        $this->db->insert('userlogs', $log_data);
    }
}
