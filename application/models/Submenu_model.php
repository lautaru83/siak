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
    public function hapus($id, $info)
    {
        $this->db->delete('submenus', ['id' => $id]);
        $tipe = "hapus";
        $desc = $id . "-" . $info;
        $this->_log($tipe, $desc);
    }
    public function simpan()
    {
        $submenu = $this->input->post('submenu');
        $menu_id = $this->input->post('menu_id');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');
        $data = array(
            'submenu' => $submenu,
            'menu_id' => $menu_id,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active
        );
        $this->db->insert('submenus', $data);
        $tipe = "simpan";
        $desc = $submenu . "-" . $menu_id . "-" . $url . "-" . $icon . "-" . $is_active;
        $this->_log($tipe, $desc);
    }
    public function ubah($id)
    {
        $submenu = $this->input->post('submenu');
        $menu_id = $this->input->post('menu_id');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');
        $data = array(
            'submenu' => $submenu,
            'menu_id' => $menu_id,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active
        );
        $this->db->where('id', $id);
        $this->db->update('submenus', $data);
        $tipe = "ubah";
        $desc = $id . "-" . $submenu . "-" . $menu_id . "-" . $url . "-" . $icon . "-" . $is_active;
        $this->_log($tipe, $desc);
    }
    private function _log($tipe, $desc)
    {
        $log_data = array(
            'user_id' => $this->session->userdata('xyz'),
            'user_name' => $this->session->userdata('nama_user'),
            'log_addr' => "submenu",
            'log_type' => $tipe,
            'log_desc' => $desc
        );
        $this->db->insert('userlogs', $log_data);
    }
}
