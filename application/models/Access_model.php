<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Access_model extends CI_Model
{
    public function simpan($data = array())
    {
        $this->db->insert('accesses', $data);
    }
    public function hapus($data = array())
    {
        $this->db->delete('accesses', $data);
    }
    public function cek_data($data = array())
    {
        return $this->db->get_where('accesses', $data)->row_array();
    }
    private function _log($tipe, $desc)
    {
        $log_data = array(
            'user_id' => $this->session->userdata('xyz'),
            'user_name' => $this->session->userdata('nama_user'),
            'log_addr' => "Role/Access",
            'log_type' => $tipe,
            'log_desc' => $desc
        );
        $this->db->insert('userlogs', $log_data);
    }
}
