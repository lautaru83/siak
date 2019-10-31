<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Role_model extends CI_Model
{
    public function ambil_data()
    {
        return $this->db->get('roles')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db->get_where('roles', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db->get_where('users', ['role_id' => $id])->row_array();
    }
    public function hapus($id)
    {
        $this->db->delete('roles', ['id' => $id]);
    }
    public function simpan()
    {
        $data = array(
            'role' => $this->input->post('role'),
            'keterangan' => $this->input->post('keterangan')
        );
        $this->db->insert('roles', $data);
    }
    public function ubah($id)
    {
        $data = array(
            'role' => $this->input->post('role'),
            'keterangan' => $this->input->post('keterangan')
        );
        $this->db->where('id', $id);
        $this->db->update('roles', $data);
    }
}
