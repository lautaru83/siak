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
    public function hapus($id, $info)
    {
        $this->db->delete('menus', ['id' => $id]);
        $tipe = "hapus";
        $desc = $id . "-" . $info;
        $this->_log($tipe, $desc);
    }
    public function simpan()
    {
        $data = array(
            'menu' => htmlspecialchars($this->input->post('menu')),
            'icon' => htmlspecialchars($this->input->post('icon')),
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        );
        $this->db->insert('menus', $data);
        $tipe = "simpan";
        $desc = htmlspecialchars($this->input->post('menu')) . "-" . htmlspecialchars($this->input->post('icon')) . "-" . htmlspecialchars($this->input->post('keterangan'));
        $this->_log($tipe, $desc);
    }
    public function ubah($id)
    {
        $data = array(
            'menu' => htmlspecialchars($this->input->post('menu')),
            'icon' => htmlspecialchars($this->input->post('icon')),
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        );
        $this->db->where('id', $id);
        $this->db->update('menus', $data);
        $tipe = "ubah";
        $desc = $id . "-" . htmlspecialchars($this->input->post('menu')) . "-" . htmlspecialchars($this->input->post('icon')) . "-" . htmlspecialchars($this->input->post('keterangan'));
        $this->_log($tipe, $desc);
    }
    private function _log($tipe, $desc)
    {
        $log_data = array(
            'user_id' => $this->session->userdata('xyz'),
            'user_name' => $this->session->userdata('nama_user'),
            'log_addr' => "menu",
            'log_type' => $tipe,
            'log_desc' => $desc
        );
        $this->db->insert('userlogs', $log_data);
    }
}
