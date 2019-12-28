<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Role_model extends CI_Model
{
    public function ambil_data()
    {
        $user_id = $this->session->userdata('xyz');
        if ($user_id == 1) {
            return $this->db->get('roles')->result_array();
        } else {
            return $this->db->query("select * from roles where id>2")->result_array();
        }
    }
    public function tes_data()
    {
        return $this->db->get('roles');
    }
    public function ambil_data_id($id)
    {
        return $this->db->get_where('roles', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db->get_where('users', ['role_id' => $id])->row_array();
    }
    public function hapus($id, $info)
    {
        $this->db->delete('roles', ['id' => $id]);
        $tipe = "hapus";
        $desc = $id . "-" . $info;
        $this->_log($tipe, $desc);
    }
    public function simpan()
    {
        $data = array(
            'role' => htmlspecialchars($this->input->post('role')),
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        );
        $this->db->insert('roles', $data);
        $tipe = "simpan";
        $desc = htmlspecialchars($this->input->post('role')) . "-" . htmlspecialchars($this->input->post('keterangan'));
        $this->_log($tipe, $desc);
    }
    public function ubah($id)
    {
        $data = array(
            'role' => htmlspecialchars($this->input->post('role')),
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        );
        $this->db->where('id', $id);
        $this->db->update('roles', $data);
        $tipe = "ubah";
        $desc = $id . "-" . htmlspecialchars($this->input->post('role')) . "-" . htmlspecialchars($this->input->post('keterangan'));
        $this->_log($tipe, $desc);
    }
    private function _log($tipe, $desc)
    {
        $log_data = array(
            'user_id' => $this->session->userdata('xyz'),
            'user_name' => $this->session->userdata('nama_user'),
            'log_addr' => "role",
            'log_type' => $tipe,
            'log_desc' => $desc
        );
        $this->db->insert('userlogs', $log_data);
    }
}
