<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends CI_Model
{
    public function ambil_data()
    {
        $user_id = $this->session->userdata('xyz');
        if ($user_id == 1) {
            $sql = "select users.id as id,users.institusi_id as institusi_id,users.role_id as role_id,users.nama as nama,users.email as email,institusis.institusi as institusi,roles.role as role,users.is_active as is_active from users join institusis on institusis.id=users.institusi_id join roles on roles.id=users.role_id order by institusis.id,users.id ASC";
        } else {
            $sql = "select users.id as id,users.institusi_id as institusi_id,users.role_id as role_id,users.nama as nama,users.email as email,institusis.institusi as institusi,roles.role as role,users.is_active as is_active from users join institusis on institusis.id=users.institusi_id join roles on roles.id=users.role_id where users.id>2 order by institusis.id,users.id ASC";
        }
        $data = $this->db->query($sql);
        return $data->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db->get_where('siak_akuntansi.transaksis', ['transaksis.user_id' => $id])->row_array();
    }
    public function hapus($id, $info)
    {
        $this->db->delete('users', ['id' => $id]);
        $tipe = "hapus";
        $desc = $id . "-" . $info;
        $this->_log($tipe, $desc);
    }
    public function simpan()
    {
        $nama = htmlspecialchars($this->input->post('nama'));
        $role_id = $this->input->post('role_id');
        $institusi_id = $this->input->post('institusi_id');
        $email = htmlspecialchars($this->input->post('email'));
        $is_active = $this->input->post('is_active');
        $sandi = $this->input->post('sandi');
        $image = "default.jpg";
        $data = array(
            'nama' => $nama,
            'role_id' => $role_id,
            'institusi_id' => $institusi_id,
            'email' => $email,
            'sandi' => password_hash($sandi, PASSWORD_DEFAULT),
            'image' => $image,
            'is_active' => $is_active
        );
        $this->db->insert('users', $data);
        $tipe = "simpan";
        $desc = $nama . "-" . $role_id . "-" . $institusi_id . "-" . $email;
        $this->_log($tipe, $desc);
    }
    public function ubah($id)
    {
        $nama = htmlspecialchars($this->input->post('nama'));
        $role_id = $this->input->post('role_id');
        $institusi_id = $this->input->post('institusi_id');
        $email = htmlspecialchars($this->input->post('email'));
        $is_active = $this->input->post('is_active');
        $sandi = $this->input->post('sandi');
        if ($this->input->post('sandi')) {
            $data = array(
                'nama' => $nama,
                'role_id' => $role_id,
                'institusi_id' => $institusi_id,
                // 'email' => $email,
                'sandi' => password_hash($sandi, PASSWORD_DEFAULT),
                'is_active' => $is_active
            );
        } else {
            $data = array(
                'nama' => $nama,
                'role_id' => $role_id,
                'institusi_id' => $institusi_id,
                // 'email' => $email,
                'is_active' => $is_active
            );
        }
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        $tipe = "ubah";
        $desc = $id . "-" . $nama . "-" . $role_id . "-" . $institusi_id . "-" . $is_active;
        $this->_log($tipe, $desc);
    }
    private function _log($tipe, $desc)
    {
        $log_data = array(
            'user_id' => $this->session->userdata('xyz'),
            'user_name' => $this->session->userdata('nama_user'),
            'log_addr' => "user",
            'log_type' => $tipe,
            'log_desc' => $desc
        );
        $this->db->insert('userlogs', $log_data);
    }
}
