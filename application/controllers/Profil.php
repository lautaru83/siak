
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(array('User_model' => 'User_model', 'Role_model' => 'Role_model', 'Unit_model' => 'Unit_model', 'Institusi_model' => 'Institusi_model'));
    }
    public function index()
    {
        $data['kontenmenu'] = "Dashboard";
        $data['kontensubmenu'] = "Profil User";
        $data['user'] = $this->User_model->ambil_detail_id();
        $this->load->view('theme/header');
        $this->load->view('theme/topbar');
        $this->load->view('theme/sidebar');
        $this->load->view('setting/profil/index', $data);
        $this->load->view('theme/sidebar-info');
        $this->load->view('theme/footer');
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $response = array(
                'status' => 'gagal',
                'sandi_error' => form_error('sandi'),
                'pass1_error' => form_error('pass1'),
                'pass2_error' => form_error('pass2')
            );
        } else {
            $this->User_model->ubahsandi();
            $response = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($response);
    }
    public function cek_sandi()
    {
        $hasil = $this->db->get_where('users', ['email' => $this->input->post('email')])->row_array();
        $sandi = $this->input->post('sandi');
        $kunci = $hasil['sandi'];
        if (!password_verify($sandi, $kunci)) {
            return false;
        } else {
            return true;
        }
    }
    private function _validate()
    {
        $this->form_validation->set_rules('sandi', 'Pasword Lama', 'required|trim|callback_cek_sandi', [
            'cek_sandi' => 'Password Salah!!'
        ]);
        $this->form_validation->set_rules('pass1', 'Password Baru', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('pass2', 'Ulangi Password Baru', 'trim|required|min_length[6]|matches[pass1]', [
            'matches' => 'Password Baru tidak sama!!'
        ]);
    }
}
