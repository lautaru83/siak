<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends CI_Model
{
    public function ambil_data()
    {
        $sql = "select users.id as id,users.unit_id as unit_id,users.role_id as role_id,users.nama as nama,users.email as email,units.unit as unit,roles.role as role,users.is_active as is_active from users join units on units.id=users.unit_id join roles on roles.id=users.role_id order by units.id,users.id ASC";
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
    public function hapus($id)
    {
        $this->db->delete('users', ['id' => $id]);
    }
    public function simpan()
    {
        $data = array(
            'nama' => htmlspecialchars($this->input->post('nama')),
            'role_id' => $this->input->post('role_id'),
            'unit_id' => $this->input->post('unit_id'),
            'email' => htmlspecialchars($this->input->post('email')),
            'sandi' => password_hash($this->input->post('sandi'), PASSWORD_DEFAULT),
            'image' => 'default.jpg',
            'is_active' => 1,
            'date_created' => time()
        );
        $this->db->insert('users', $data);
    }
    public function ubah($id)
    {
        if ($this->input->post('sandi')) {
            $data = array(
                'nama' => htmlspecialchars($this->input->post('nama')),
                'role_id' => $this->input->post('role_id'),
                'unit_id' => $this->input->post('unit_id'),
                // 'email' => htmlspecialchars($this->input->post('email')),
                'sandi' => password_hash($this->input->post('sandi'), PASSWORD_DEFAULT)
            );
        } else {
            $data = array(
                'nama' => htmlspecialchars($this->input->post('nama')),
                'role_id' => $this->input->post('role_id'),
                'unit_id' => $this->input->post('unit_id')
                // 'email' => htmlspecialchars($this->input->post('email'))
            );
        }
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }
}
