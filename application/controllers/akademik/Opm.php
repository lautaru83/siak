<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Opm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->db3 = $this->load->database('akademik', TRUE);
        $this->load->model(array('akademik/Mahasiswa_model' => 'Mahasiswa_model', 'akademik/Opm_model' => 'Opm_model', 'akuntansi/Kodeperkiraan_model' => 'Kodeperkiraan_model', 'Unit_model' => 'Unit_model', 'Akademik/Bop_model' => 'Bop_model'));
    }
    public function index()
    {
        $institusi_id = $this->session->userdata('idInstitusi');
        $data['pembukuan_id'] = $this->session->userdata('tahun_buku');
        $data['kontenmenu'] = "Transaksi";
        $data['kontensubmenu'] = "Operasional Mahasiswa";
        $jrnl = "PM";
        $hasil = $this->Opm_model->cektranuser($jrnl);
        if ($hasil) {
            $idMahasiswa = $hasil['mahasiswa_id'];
            $mahasiswa = $this->Mahasiswa_model->ambil_data_id($idMahasiswa);
            $nim = $mahasiswa['nim'];
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                    Harap selesaikan transaksi terlebih dahulu!</div>');
            redirect('opm/data/' . $nim);
        } else {
            $this->template->display('akademik/opm/index', $data);
        }
    }
    public function data($nim)
    {
        $idInstitusi = $this->session->userdata('idInstitusi');
        $data['institusi_id'] = $idInstitusi;
        $data['pembukuan_id'] = $this->session->userdata('tahun_buku');
        $data['perak_id'] = $this->session->userdata('idPerak');
        $data['tahun_akademik'] = $this->session->userdata('tahun_akademik');
        $data['kontenmenu'] = "Transaksi";
        $data['kontensubmenu'] = "Operasional Mahasiswa";
        $data['mhs'] = $this->Mahasiswa_model->ambil_detail_nim($nim);
        $data['rtransaksi'] = "";
        $data['statusbayar'] = "";
        $jrnl = "PM";
        $data['jurnal'] = $jrnl;
        $data['rnotran'] = no_tran($jrnl);
        $djrnl = "OD";
        $data['djurnal'] = $djrnl;
        $pjrnl = "OP";
        $data['pjurnal'] = $pjrnl;
        $data['status'] = 0;
        $data['idTransaksi'] = "";
        $data['noref'] = "";
        $data['jenis'] = "R";
        //$data['keterangan'] = "";
        $data['nobukti'] = "";
        //$data['notran'] = "";
        $data['detail'] = "";
        $data['jml_transaksi'] = 0;
        $data['tanggal_transaksi'] = date("d/m/Y");
        $data['txtjenis'] = array(
            '0' => array('id' => 'R', 'jenis' => 'Reguler'),
            '1' => array('id' => 'P', 'jenis' => 'Piutang'),
            '2' => array('id' => 'D', 'jenis' => 'Dana Surplus')
        );
        $hasil = $this->Opm_model->cektranuser($jrnl);
        //var_dump($hasil);
        if ($hasil) {
            $idtransaksi = $hasil['id'];
            $data['status'] = 1;
            $data['idTransaksi'] = $hasil['id'];
            $data['noref'] = $hasil['noref'];
            $data['keterangan'] = $hasil['keterangan'];
            $data['nobukti'] = $hasil['nobukti'];
            $data['rnotran'] = $hasil['notran'];
            $data['jenis'] = $hasil['jenis'];
            $data['jml_transaksi'] = $this->Opm_model->cek_detail_operasional_id($idtransaksi);
            //$data['idMahasiswa'] = $hasil['mahasiswa_id'];
            $data['tanggal_transaksi'] = tanggal_indo($hasil['tanggal_transaksi']);
            //$data['totaltransaksi'] = $this->Transaksi_model->cektotaltransaksi($idtransaksi);
            $data['detail'] = $this->Opm_model->detailtransaksi($idtransaksi);
        }
        $this->template->display('akademik/opm/transaksi', $data);
    }
    public function cek_mahasiswa()
    {
        $nim = $this->input->post('nim');
        $hasil = $this->Mahasiswa_model->cek_nim($nim);
        if ($hasil > 0) {
            $data = array(
                'status' => 'sukses'
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function simpan()
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'nobukti_error' => form_error('nobukti'),
                'tanggal_error' => form_error('tanggal_transaksi'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Opm_model->simpan();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function simpandetail()
    {
        $this->_detailvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'akun_error' => form_error('akun_id'),
                'posisi_error' => form_error('posisi_akun'),
                'jumlah_error' => form_error('jumlah')
            );
        } else {
            $this->Opm_model->simpandetail();
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function ubahdetail()
    {
        $id = $this->input->post('idubah');
        $this->_detailvalidate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'akun_error' => form_error('akun_id'),
                'posisi_error' => form_error('posisi_akun'),
                'jumlah_error' => form_error('jumlah')
            );
        } else {
            $this->Opm_model->ubahdetail($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function bataltransaksi()
    {
        $this->Opm_model->bataltransaksi();
        $data = array(
            'status' => 'sukses'
        );
        echo json_encode($data);
    }
    public function edit_detail($id)
    {
        $hasil = $this->Opm_model->ambil_detailoperasional_id($id);
        if ($hasil) {
            $data = array(
                'status' => 'sukses',
                'id' => $hasil['id'],
                'jumlah' => rupiah($hasil['jumlah']),
                'detailbop_id' => $hasil['detailbop_id'],
                'a6level_id' => $hasil['a6level_id'],
                'anggaran' => $hasil['is_anggaran'],
                'posisi_akun' => $hasil['posisi_akun']
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function ubah($id)
    {
        $this->_validate();
        if ($this->form_validation->run() == false) {
            $data = array(
                'status' => 'gagal',
                'nobukti_error' => form_error('nobukti'),
                'tanggal_error' => form_error('tanggal_transaksi'),
                'keterangan_error' => form_error('keterangan')
            );
        } else {
            $this->Opm_model->ubah($id);
            $data = array(
                'status' => 'sukses'
            );
        }
        echo json_encode($data);
    }
    public function hapusdetail()
    {
        $this->Opm_model->hapusdetail();
        $data = array(
            'status' => 'sukses'
        );
        echo json_encode($data);
    }
    public function selesaitransaksi()
    {
        $hasil = $this->Opm_model->selesaitransaksi();
        if (!$hasil) {
            $data = array(
                'status' => 'sukses'
            );
        } else {
            $data = array(
                'status' => 'gagal'
            );
        }
        echo json_encode($data);
    }
    public function cek_tanggalakademik()
    {
        $tanggal = tanggal_input($this->input->post('tanggal_transaksi'));
        $awal_semester = $this->session->userdata['semester_awal'];
        $akhir_semester = $this->session->userdata['semester_akhir'];
        if ($tanggal < $awal_semester) {
            return false;
        } elseif ($tanggal > $akhir_semester) {
            return false;
        } else {
            return true;
        }
    }
    public function cek_tanggalbuku()
    {
        $tanggal = tanggal_input($this->input->post('tanggal_transaksi'));
        $awal_buku = $this->session->userdata['buku_awal'];
        $akhir_buku = $this->session->userdata['buku_akhir'];
        if ($tanggal < $awal_buku) {
            return false;
        } elseif ($tanggal > $akhir_buku) {
            return false;
        } else {
            return true;
        }
    }
    public function cek_jumlah()
    {
        $jumlah = input_uang($this->input->post('jumlah'));
        if ($jumlah <= 0 || !$jumlah) {
            return false;
        } else {
            return true;
        }
    }
    public function cek_saldo()
    {
        $jumlah = 0.00;
        $jumlah = $this->input->post('jumlah');
        $akun_id = $this->input->post('akun_id');
        $postran = $this->input->post('posisi_akun');
        $jenis_opm = $this->input->post('jenis_opm');
        if ($jumlah) {
            if ($akun_id) {
                $jumlahkewajiban = 0.00;
                $jumlahtransaksi = 0.00;
                $jumlahtransaksi = input_uang($jumlah);
                //$jumlahtransaksi = printf("%.2f", $jumlah);
                $akun = explode("/", $akun_id);
                $dbop_id = $akun['0'];
                $a6level_id = $akun['1'];
                $dataakunbop = $this->Opm_model->cek_akunkewajiban($a6level_id);
                //posakun dan posdata sama beda nama
                $posakun = $dataakunbop['posisi'];
                //$jeniskewajiban = $dataakunbop['jenis'];
                $datadbop = $this->Bop_model->ambil_detail_id($dbop_id);
                $jumlahkewajiban = $datadbop['jumlah'];
                //$kewajiban_id=$datadbop['kewajiban_id'];
                $jumlahdebet = 0.00;
                $jumlahkredit = 0.00;
                $maxbayar = 0.00;
                $terbayar = 0.00;
                $jmlterbayar = 0.00;
                if ($jenis_opm == "R") {
                    if ($posakun == "K") {
                        $dataterbayar = $this->Opm_model->ceksaldoreguler($a6level_id);
                    } else {
                        $dataterbayar = $this->Opm_model->ceksaldoperantara($a6level_id);
                    }
                } elseif ($jenis_opm == "P") {
                    if ($posakun == "SD") {
                        $dataterbayar = $this->Opm_model->ceksaldopiutang($a6level_id);
                    } else {
                        $dataterbayar = $this->Opm_model->ceksaldoperantara($a6level_id);
                    }
                } else {
                    if ($posakun == "SK") {
                        $dataterbayar = $this->Opm_model->ceksaldoreguler($a6level_id);
                    } else {
                        $dataterbayar = $this->Opm_model->ceksaldoperantara($a6level_id);
                    }
                }
                //bcadd($a, $b, 4)
                // bcdiv('105', '6.55957', 3)
                if ($dataterbayar) {
                    $posisidata = $dataterbayar['posakun'];
                    $jumlahdebet = $dataterbayar['debet'];
                    $jumlahkredit = $dataterbayar['kredit'];
                    if ($posisidata == "D" || $posisidata == "SD") {
                        $jmlterbayar = $jumlahdebet - $jumlahkredit;
                    } else {
                        $jmlterbayar = $jumlahkredit - $jumlahdebet;
                    }
                    if ($jumlahkewajiban > 0) {
                        $maxbayar = $jumlahkewajiban - $jmlterbayar;
                    } else {
                        $maxbayar = $jmlterbayar;
                    }
                } else {
                    $maxbayar = $jumlahkewajiban;
                }
                if ($jumlahkewajiban > 0 && $jenis_opm == "R") {
                    if ($postran == "K") {
                        if ($jumlahtransaksi <= $maxbayar) {
                            return true;
                            exit;
                        } else {
                            return false;
                        }
                    } else {
                        if ($jumlahtransaksi <= $jmlterbayar) {
                            return true;
                            exit;
                        } else {
                            return false;
                        }
                    }
                } else {
                    //saldo surplus
                    if ($posakun == "SK" || $posakun == "K") {
                        if ($postran == "K") {
                            return true;
                            exit;
                        } else {
                            if ($jumlahtransaksi <= $jmlterbayar) {
                                return true;
                                exit;
                            } else {
                                return false;
                            }
                        }
                        //piutang
                    } elseif ($posakun == "SD") {
                        if ($postran == "D") {
                            return true;
                            exit;
                        } else {
                            if ($jumlahtransaksi <= $jmlterbayar) {
                                return true;
                                exit;
                            } else {
                                return false;
                            }
                        }
                        //kas dan setara dengan kas
                    } else {
                        return true;
                        exit;
                    }
                }
                // return true;
                // exit;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function ceksaldo()
    {
        $jumlah = 0.00;
        $jumlah = "1.000.000,00";
        $akun_id = "2/211.01.01.01";
        $postran = "D";
        $jenis_opm = "P";
        if ($jumlah) {
            if ($akun_id) {
                // if ($this->input->post('akun_id')) {
                $jumlahkewajiban = 0.00;
                $jumlahtransaksi = 0.00;
                // $jumlahtransaksi = input_uang($this->input->post('jumlah'));
                $jumlahtransaksi = input_uang($jumlah);
                // $akun = explode("/", $this->input->post('akun_id'));
                $akun = explode("/", $akun_id);
                $dbop_id = $akun['0'];
                $a6level_id = $akun['1'];
                $dataakunbop = $this->Opm_model->cek_akunkewajiban($a6level_id);
                $posakun = $dataakunbop['posisi'];
                $jenisbop = $dataakunbop['jenis'];
                // $postran = $this->input->post('posisi_akun');
                $datadbop = $this->Bop_model->ambil_detail_id($dbop_id);
                $jumlahkewajiban = $datadbop['jumlah'];
                //$kewajiban_id=$datadbop['kewajiban_id'];
                //$jenis_opm = "R";
                // $jenis_opm = $this->input->post('jenis_opm');
                $jumlahdebet = 0.00;
                $jumlahkredit = 0.00;
                $maxbayar = 0.00;
                $terbayar = 0.00;
                $jmlterbayar = 0.00;
                if ($jenis_opm == "R") {
                    if ($posakun == "K") {
                        $dataterbayar = $this->Opm_model->ceksaldoreguler2($a6level_id);
                    } else {
                        $dataterbayar = $this->Opm_model->ceksaldoperantara2($a6level_id);
                    }
                } elseif ($jenis_opm == "P") {
                    if ($posakun == "SD") {
                        $dataterbayar = $this->Opm_model->ceksaldopiutang2($a6level_id);
                    } else {
                        $dataterbayar = $this->Opm_model->ceksaldoperantara2($a6level_id);
                    }
                } else {
                    if ($posakun == "SK") {
                        $dataterbayar = $this->Opm_model->ceksaldoreguler2($a6level_id);
                    } else {
                        $dataterbayar = $this->Opm_model->ceksaldoperantara2($a6level_id);
                    }
                }
                if ($dataterbayar) {
                    $posisidata = $dataterbayar['posakun'];
                    $jumlahdebet = $dataterbayar['debet'];
                    $jumlahkredit = $dataterbayar['kredit'];
                    if ($posisidata == "D" || $posisidata == "SD") {
                        $jmlterbayar = $jumlahdebet - $jumlahkredit;
                    } else {
                        $jmlterbayar = $jumlahkredit - $jumlahdebet;
                    }
                    if ($jumlahkewajiban > 0) {
                        $maxbayar = $jumlahkewajiban - $jmlterbayar;
                    } else {
                        $maxbayar = $jmlterbayar;
                    }
                } else {
                    $maxbayar = $jumlahkewajiban;
                }
                if ($jumlahkewajiban > 0 && $jenis_opm == "R") {
                    if ($postran == "K") {
                        if ($jumlahtransaksi <= $maxbayar) {
                            echo "posisi 1";
                            // return true;
                            // exit;
                        } else {
                            // return false;
                            echo "posisi 2";
                        }
                    } else {
                        if ($jumlahtransaksi <= $jmlterbayar) {
                            // return true;
                            // exit;
                            echo "posisi 3";
                        } else {
                            // return false;
                            echo "posisi 4";
                        }
                    }
                } else {
                    //saldo surplus dan pendapatan diterima dimuka selain reguler
                    if ($posakun == "SK" || $posakun == "K") {
                        if ($postran == "K") {
                            // return true;
                            // exit;
                            echo "posisi 5";
                        } else {
                            if ($jumlahtransaksi <= $jmlterbayar) {
                                // return true;
                                // exit;
                                echo "posisi 6";
                            } else {
                                // return false;
                                echo "posisi 7";
                            }
                        }
                        //piutang
                    } elseif ($posakun == "SD") {
                        if ($postran == "D") {
                            echo "posisi 8";
                            // return true;
                            // exit;
                        } else {
                            if ($jumlahtransaksi <= $jmlterbayar) {
                                // return true;
                                // exit;
                                echo "posisi 9";
                            } else {
                                // return false;
                                echo "posisi 10";
                            }
                        }
                        //kas dan setara dengan kas
                    } else {
                        echo "posisi 11";
                        // return true;
                        // exit;
                    }
                }

                // if ($jumlahkewajiban < 1) {
                //     //return true;
                //     echo "saldo kosong";
                //     echo $jumlahkewajiban;
                // } else {
                //     echo "saldo isi";
                //     echo $jumlahkewajiban;
                // }
            } else {
                return false;
                // echo "10";
            }
        } else {
            return false;
            // echo "11";
        }
    }
    public function tes_saldo()
    {
        $jumlahbayar = 0;
        // $jumlah = input_uang($this->input->post('jumlah'));
        $akun_id = "2/211.01.01.01";
        $postran = "K";
        $mahasiswa_id = "22";
        $jenis_opm = "R";

        $postran = $this->input->post('posisi_akun');
        // $postran = $this->input->post('posisi_akun');
        $akun = explode("/", $akun_id);
        $dbop_id = $akun['0'];
        $a6_id = $akun['1'];
        $akunkewajiban = $this->Opm_model->cek_posisiakun($a6_id);
        $posakun = $akunkewajiban['posisi'];
        $jumlahbayar = 1000000.00;
        $datadbop = $this->Opm_model->ambil_detail_dbop($dbop_id);
        $jumlahkewajiban = $datadbop['jumlah'];
        $jeniskewajiban = $datadbop['jenis'];
        $hasil = $this->Opm_model->ceksaldotransaksi($a6_id, $jenis_opm);
        //$saldo = 0;
        $terbayar = 0;
        if ($hasil) {
            foreach ($hasil as $dataHasil) :
                $posisi = $dataHasil['posakun'];
                $debet = $dataHasil['debet'];
                $kredit = $dataHasil['kredit'];
                $jmlkewajiban = $dataHasil['jumlahkewajiban'];
                if ($posisi == "D") {
                    $sal = $debet - $kredit;
                } elseif ($posisi == "SD") {
                    $sal = $debet - $kredit;
                } else {
                    $sal = $kredit - $debet;
                }
            endforeach;
            $terbayar = input_uang($sal);
        } else {
            $terbayar = 0;
        }
        //$terbayar=$saldo;
        $cekjumlah = 0;
        if ($posakun == "D") {
            return true;
        } elseif ($posakun == "K") {
            if ($postran == "K") {
                $cekjumlah = $terbayar + $jumlahbayar;
                if ($cekjumlah > $jumlahkewajiban) {
                    echo " return false 1 ";
                } else {
                    echo " return true 6 ";
                    // return true;
                }
            } else {
                $cekjml = 0;
                $cekjml = $terbayar - $jumlahbayar;
                if ($cekjml < 0) {
                    //return false;
                    echo $cekjml;
                    echo " > ";
                    echo $terbayar;
                    echo " return false 2 ";
                    echo $posakun;
                    echo $jumlahbayar;
                    var_dump($hasil);
                } else {
                    // return true;
                    echo " return true 5 ";
                }
            }
        } elseif ($posakun == "SK") {
            if ($postran == "K") {
                // return true;
                echo " return true 4 ";
            } else {
                $cekjumlah = $terbayar - $jumlahbayar;
                if ($cekjumlah < 0) {
                    //return false;
                    echo " return false 3 ";
                } else {
                    // return true;
                    echo " return true 3 ";
                }
            }
        } else {
            if ($postran == "D") {
                // return true;
                echo " return true 2 ";
            } else {
                $cekjumlah = $terbayar - $jumlahbayar;
                if ($cekjumlah < 0) {
                    // return false;
                    echo " return false 4 ";
                } else {
                    echo " return true 1 ";
                    // return true;
                }
            }
        }
    }
    public function cek_akunganda()
    {
        $akun_id = $this->input->post('akun_id');
        if ($akun_id) {
            $akun = explode("/", $this->input->post('akun_id'));
            //$dbop_id = $akun['0'];
            $a6_id = $akun['1'];
            $op_id = $this->input->post('operasional_id');
            $akun_lama = $this->input->post('akun_lama');
            if ($a6_id == $akun_lama) {
                $datadopm = 0;
            } else {
                $datadopm = $this->Opm_model->cek_akun6_dopm($op_id, $a6_id);
            }
            if ($datadopm > 0) {
                return false;
            } else {
                return true;
            }
        }
    }
    private function _validate()
    {
        $this->form_validation->set_rules('nobukti', 'No. Bukti', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
        $this->form_validation->set_rules('tanggal_transaksi', 'Tanggal', 'required|trim|callback_cek_tanggalakademik|callback_cek_tanggalbuku', [
            'cek_tanggalakademik' => 'Diluar periode semester aktif!!',
            'cek_tanggalbuku' => 'Diluar periode pembukuan aktif!!'
        ]);
    }
    private function _detailvalidate()
    {
        $this->form_validation->set_rules('akun_id', 'Akun', 'required|trim|callback_cek_akunganda', [
            'cek_akunganda' => 'Akun telah digunakan sebelumnya!!!!'
        ]);
        $this->form_validation->set_rules('posisi_akun', 'Posisi', 'required|trim');
        //$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim|callback_cek_jumlah|callback_cek_saldo', [
            'cek_jumlah' => 'jumlah transaksi tidak valid!!',
            'cek_saldo' => 'jumlah transaksi tidak sesuai!!'
        ]);
    }
}
