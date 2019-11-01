<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Submenu_model extends CI_Model
{
    public function ambil_data()
    {
        $sql = "select submenus.id as id,submenus.menu_id as menu_id,submenus.submenu as submenu,menus.menu as menu,submenus.url as url,submenus.icon as icon,submenus.is_active as is_active from submenus join menus where menus.id=submenus.menu_id order by submenus.menu_id,submenus.id ASC";
        $data = $this->db->query($sql);
        return $data->result_array();
    }
    public function ambil_data_id($id)
    {
        return $this->db->get_where('submenus', ['id' => $id])->row_array();
    }
    public function cek_hapus($id)
    {
        return $this->db->get_where('accesses', ['submenu_id' => $id])->row_array();
    }
    public function hapus($id)
    {
        $this->db->delete('submenus', ['id' => $id]);
    }
    public function simpan()
    {
        $data = array(
            'submenu' => $this->input->post('submenu'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => 1
        );
        $this->db->insert('submenus', $data);
    }
    public function ubah($id)
    {
        $data = array(
            'submenu' => $this->input->post('submenu'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => 1
        );
        $this->db->where('id', $id);
        $this->db->update('submenus', $data);
    }
}
