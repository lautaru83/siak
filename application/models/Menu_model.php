<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Menu_model extends CI_Model
{
    public function ambil_data()
    {
        return $this->db->get('menus')->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db->get_where('menus', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db->get_where('submenus', ['menu_id' => $id])->row_array();
    }
    public function hapus($id)
    {
        $this->db->delete('menus', ['id' => $id]);
    }
    public function simpan()
    {
        $data = array(
            'menu' => $this->input->post('menu'),
            'icon' => $this->input->post('icon'),
            'keterangan' => $this->input->post('keterangan')
        );
        $this->db->insert('menus', $data);
    }
    public function ubah($id)
    {
        $data = array(
            'menu' => $this->input->post('menu'),
            'icon' => $this->input->post('icon'),
            'keterangan' => $this->input->post('keterangan')
        );
        $this->db->where('id', $id);
        $this->db->update('menus', $data);
    }
}
