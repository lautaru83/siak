<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Institusi_model extends CI_Model
{
    public function ambil_data()
    {
        return $this->db->get('institusis')->result_array();
    }
    // data untuk kontoller lain
    public function data_institusi()
    {
        $this->db->select('id,institusi');
        $query = $this->db->get('institusis');
        return $query->result_array();
        //return $this->db->query("select id,institusi from institusis")->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db->get_where('institusis', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db->get_where('units', ['institusi_id' => $id])->row_array();
    }
    public function hapus($id, $info)
    {
        $this->db->delete('institusis', ['id' => $id]);
        $tipe = "hapus";
        $desc = $id . "-" . $info;
        $this->_log($tipe, $desc);
    }
    public function simpan()
    {
        $data = array(
            'institusi' => htmlspecialchars($this->input->post('institusi')),
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        );
        $this->db->insert('institusis', $data);
        $tipe = "simpan";
        $desc = htmlspecialchars($this->input->post('institusi')) . "-" . htmlspecialchars($this->input->post('keterangan'));
        $this->_log($tipe, $desc);
    }
    public function ubah($id)
    {
        $data = array(
            'institusi' => htmlspecialchars($this->input->post('institusi')),
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        );
        $this->db->where('id', $id);
        $this->db->update('institusis', $data);
        $tipe = "ubah";
        $desc = $id . "-" . htmlspecialchars($this->input->post('institusi')) . "-" . htmlspecialchars($this->input->post('keterangan'));
        $this->_log($tipe, $desc);
    }
    private function _log($tipe, $desc)
    {
        $log_data = array(
            'user_id' => $this->session->userdata('xyz'),
            'user_name' => $this->session->userdata('nama_user'),
            'log_addr' => "institusi",
            'log_type' => $tipe,
            'log_desc' => $desc
        );
        $this->db->insert('userlogs', $log_data);
    }
}
