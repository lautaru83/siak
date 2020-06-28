<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Institusi_model', 'Institusi_model', 'akuntansi/Tahunbuku_model', 'Tahunbuku_model');
        //$this->load->model('Role_model');
    }
    public function index()
    {
        //$data['user'] = $this->User_model->user_data();
        //$data['title'] = "Siak-Serulingmas";
        //$this->template->display('tes/index2');
        //$this->load->view('tes/index');
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = "Tahun Pembukuan";
        //$data['tahunbuku'] = $this->Tahunbuku_model->ambil_data();
        $this->template->display('tes/index', $data);
    }
    public function cetak()
    {
        $data['institusi'] = $this->Institusi_model->ambil_data();
        $this->load->view('tes/cetak', $data);
    }
    public function tes()
    {
        $tanggal_sekarang = "01-11-2019";
        $tanggal = date('Y-m-d', strtotime($tanggal_sekarang));
        $data['kontenmenu'] = "Master Pembukuan";
        $data['kontensubmenu'] = $tanggal;

        $data['tahunbuku'] = $this->Tahunbuku_model->ambil_data();
        $this->template->display('tes/index', $data);
        //$this->load->view('tes/index2');
        //echo json_encode($data);
    }

    public function ajax_data()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $role = $this->Role_model->tes_data();
        $data = array();
        $no = $start;
        foreach ($role->result() as $dataRole) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $dataRole->id;
            $row[] = $dataRole->role;
            $row[] =  $dataRole->keterangan;

            $data[] = $row;
            // $data[] = array(
            //     $dataRole->id,
            //     $dataRole->role,
            //     $dataRole->keterangan
            // );
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $role->num_rows(),
            "recordsFiltered" => $role->num_rows(),
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }
}
