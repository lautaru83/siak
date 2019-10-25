<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Submenu_model extends CI_Model
{
    public function submenu_data()
    {
        $sql = "select submenus.id as id,submenus.menu_id as menu_id,submenus.submenu as submenu,menus.menu as menu,submenus.url as url,submenus.icon as icon,submenus.is_active as is_active from submenus join menus where menus.id=submenus.menu_id order by submenus.menu_id,submenus.id ASC";
        $data = $this->db->query($sql);
        return $data->result_array();
    }
}
