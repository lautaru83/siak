<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        if ($role_id != 1) {
            $visitLink = $ci->uri->segment(1);
            $queryControl = $ci->db->get_where('submenus', ['url' => $visitLink])->row_array();
            $submenu_id = $queryControl['id'];
            $userAccess = $ci->db->get_where('accesses', [
                'role_id' => $role_id,
                'submenu_id' => $submenu_id
            ]);
            if ($userAccess->num_rows() < 1) {
                redirect('auth/blocked');
            }
        }
    }
}

function cek_access($role_id, $submenu_id)
{
    $ci = get_instance();
    $ci->db->where('role_id', $role_id);
    $ci->db->where('submenu_id', $submenu_id);
    $result = $ci->db->get('accesses');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
function txt_status($txt)
{
    if ($txt == 0) {
        return "Non Aktif";
    } else {
        return "Aktif";
    }
}
function icon_aktif($nilai)
{
    if ($nilai == 1) {
        return "style='color: teal'";
    } else {
        return "style='color: grey'";
    }
}
function tanggal_indo($tgl)
{
    $tanggal = date('d-m-Y', strtotime($tgl));
    return $tanggal;
}
function tanggal_input($tgl)
{
    $tanggal = date('Y-m-d', strtotime($tgl));
    return $tanggal;
}
function userLog($type, $desc)
{
    $ci = get_instance();
    $user_id = $ci->session->userdata('xyz');
    $nama_user = $ci->session->userdata('nama_user');
    $log_addr = $ci->uri->segment(1);
    // log data parameter
    $log_data = array(
        'user_id' =>  $user_id,
        'user_name' => $nama_user,
        'log_addr' => $log_addr,
        'log_type' => $type,
        'log_desc' => $desc
    );
    //save to database
    $ci->db->insert('userlogs', $log_data);
}
