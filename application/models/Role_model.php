<?php
class Role_model extends CI_model
{
    public function getRoleUserById($id)
    {
        return $this->db->get_where('users', ['role_id' => $id])->row_array();
    }
    public function hapusRole($id)
    {
        $this->db->delete('mahasiswa', ['id' => $id]);
    }
}
