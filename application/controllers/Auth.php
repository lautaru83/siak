<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->db2 = $this->load->database('akuntansi', TRUE);
        $this->load->model(array('akuntansi/Tahunanggaran_model' => 'Tahunanggaran_model', 'akuntansi/Tahunbuku_model' => 'Tahunbuku_model', 'akademik/Periodeakademik_model' => 'Periodeakademik_model'));
    }
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
        $data['title'] = "Login User";
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email harap diisi!',
            'valid_email' => 'Email tidak Valid!'
        ]);
        $this->form_validation->set_rules('sandi', 'Password', 'required|trim', [
            'required' => 'Password harap diisi!'
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view('login/login');
        } else {
            $this->_login();
        }
    }
    private function _sesibuku()
    {
        $tahun_buku = "0000";
        $pembukuan = $this->Tahunbuku_model->ambil_buku_aktif();
        if ($pembukuan) {
            $tahun_buku = $pembukuan['id'];
            $buku_awal = $pembukuan['awal_periode'];
            $buku_akhir = $pembukuan['akhir_periode'];
        }
        $akademik = $this->Periodeakademik_model->ambil_akademik_aktif();
        if ($akademik) {
            $idTahunAkademik = $akademik['tahunakademik_id'];
            $idPeriodeAkademik = $akademik['periodeakademik_id'];
            $akademik_awal = $akademik['awal_periode'];
            $akademik_akhir = $akademik['akhir_periode'];
            $semester_awal = $akademik['awal_semester'];
            $semester_akhir = $akademik['akhir_semester'];
            $tahunAkademik = $akademik['tahunakademik'];
            $periodeAkademik = $akademik['periodeakademik'];
        }
        $anggaran = $this->Tahunanggaran_model->ambil_anggaran_aktif();
        if ($anggaran) {
            $idTahunAnggaran = $anggaran['id'];
            $Tahun_Anggaran = $anggaran['tahunanggaran'];
            $anggaran_awal = $anggaran['awal_periode'];
            $anggaran_akhir = $anggaran['akhir_periode'];
        }
        $data = [
            'tahun_buku' => $tahun_buku,
            'buku_awal' => $buku_awal,
            'buku_akhir' => $buku_akhir,
            'anggaran_awal' => $anggaran_awal,
            'anggaran_akhir' => $anggaran_akhir,
            'idTahan' => $idTahunAnggaran,
            'tahun_anggaran' => $Tahun_Anggaran,
            'tahun_akademik' => $tahunAkademik,
            'periode_akademik' => $periodeAkademik,
            'idPerak' => $idPeriodeAkademik,
            'idTakad' => $idTahunAkademik,
            'akademik_awal' => $akademik_awal,
            'akademik_akhir' => $akademik_akhir,
            'semester_awal' => $semester_awal,
            'semester_akhir' => $semester_akhir,

        ];
        $this->session->set_userdata($data);
    }
    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('sandi');
        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        //var_dump($user);
        //die;
        //cek user
        if ($user) {
            //cek aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['sandi'])) {
                    //echo "Login Sukses!";
                    $institusi_id = $user['institusi_id'];
                    $data = [
                        'email' => $user['email'],
                        'xyz' => $user['id'],
                        'role_id' => $user['role_id'],
                        'nama_user' => $user['nama'],
                        'image' => $user['image'],
                        'idInstitusi' => $institusi_id
                    ];
                    $this->session->set_userdata($data);
                    $this->_sesibuku();
                    $log_type = "login";
                    $log_desc = "login User";
                    userLog($log_type, $log_desc);

                    if ($user['role_id'] == 1) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    login Admin Sukses!</div>');
                        redirect('dashboard');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    login User Sukses!</div>');
                        redirect('dashboard');
                    }
                    //$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    //login Sukses!</div>');

                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                User belum diaktivasi!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            User belum teregistrasi!</div>');
            redirect('auth');
        }
    }
    public function register()
    {
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
        $data['title'] = "Registrasi User";
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harap diisi!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
            'required' => 'Email harap diisi!',
            'valid_email' => 'Email tidak Valid!',
            'is_unique' => 'Alamat email telah Digunakan!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Password harap diisi!',
            'matches' => 'Password tidak sama!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('Auth/header', $data);
            $this->load->view('Auth/register');
            $this->load->view('Auth/footer');
        } else {
            //[echo 'Data berhasil ditambahkan';
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_BCRYPT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('users', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Selamat,akun anda berhasil dibuat. Silahkan Login!</div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('xyz');
        $this->session->unset_userdata('nama_user');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('idInstitusi');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Logout Berhasil!</div>');
        redirect('auth');
    }
    public function blocked()
    {
        echo "Anda tidak memiliki hak akses pada menu ini";
    }
}
