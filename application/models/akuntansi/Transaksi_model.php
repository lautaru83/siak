<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Transaksi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('akuntansi', TRUE);
        $this->db3 = $this->load->database('akademik', TRUE);
    }
    public function cektranuser($jurnal)
    {
        $user_id = $this->session->userdata('xyz');
        $thbuku_id = $this->session->userdata('tahun_buku');
        return $this->db2->get_where('transaksis', ['tahun_buku' => $thbuku_id, 'jurnal' => $jurnal, 'user_id' => $user_id, 'is_valid' => 0])->row_array();
    }
    public function cektransaldo($thbuku_id, $unit_id)
    {
        return $this->db2->get_where('transaksis', ['tahun_buku' => $thbuku_id, 'unit_id' => $unit_id])->row_array();
    }
    public function cek_nobukti($nobukti)
    {
        return $this->db2->get_where('transaksis', ['nobukti' => $nobukti])->num_rows();
    }
    public function detailtransaksi($tran_id)
    {
        return $this->db2->query("select a.id as id,a.a6level_id as a6level_id,b.level6 as level6,a.posisi_akun as posisi,a.jumlah as jumlah,a.debet as debet,a.kredit as kredit,a.is_anggaran as is_anggaran from detail_transaksis a join a6levels b on b.id=a.a6level_id where a.transaksi_id=$tran_id")->result_array();
    }
    public function detailtransaksi_by_id($id)
    {
        return $this->db2->get_where('detail_transaksis', ['id' => $id])->row_array();
    }
    public function riwayat_transaksi($jurnal)
    {
        $user_id = $this->session->userdata('xyz');
        return $this->db2->query("SELECT * FROM transaksis where jurnal='$jurnal' and is_valid=1 and user_id=$user_id order by id desc LIMIT 0, 5 ")->result_array();
    }
    public function ceksaldotransaksi($akun_id)
    {
        $tahun_buku = $this->session->userdata('tahun_buku');
        $tgl1 = tanggal_input($this->session->userdata('buku_awal'));
        $tgl2 = tanggal_input($this->input->post('tgl2'));
        return $this->db2->query("select a6level_id,level6,posisi,tanggal_transaksi,sum(debet) as debet,sum(kredit) as kredit from view_detailtransaksis WHERE a6level_id='$akun_id' AND is_valid BETWEEN 1 AND 2  AND tahun_buku='$tahun_buku' AND tanggal_transaksi BETWEEN '$tgl1' AND '$tgl2' GROUP BY a6level_id")->result_array();
    }
    public function simpantransaksi($thbuku_id, $notran, $unit_id)
    {
        $jurnal = "SA";
        $keterangan = "Saldo Awal";
        $accounting = "system";
        $tanggal_transaksi = $thbuku_id . "-01-01";
        $user_id = $this->session->userdata('xyz');
        //$notran="";
        $data = array(
            'tahun_buku' => $thbuku_id,
            'jurnal' => $jurnal,
            'notran' => $notran,
            'nobukti' => $notran,
            'tanggal_transaksi' => $tanggal_transaksi,
            'accounting' => $accounting,
            'keterangan' => $keterangan,
            'unit_id' => $unit_id,
            'total_transaksi' => 0,
            'is_valid' => 2,
            'user_id' => $user_id
        );
        $this->db2->insert('transaksis', $data);
        // endforeach
    }
    public function simpan()
    {
        $accounting = $this->session->userdata('nama_user');
        $user_id = $this->session->userdata('xyz');
        $unit_id = $this->input->post('unit_id');
        $tahun_buku = $this->input->post('tahun_buku');
        $jurnal = $this->input->post('jurnal');
        $noref = $this->input->post('noref');
        $notran = no_tran($jurnal);
        $tanggal_transaksi = tanggal_input($this->input->post('tanggal_transaksi'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $nobukti = htmlspecialchars($this->input->post('nobukti'));
        $data = array(
            'tahun_buku' => $tahun_buku,
            'jurnal' => $jurnal,
            'notran' => $notran,
            'nobukti' => $nobukti,
            'noref' => $noref,
            'tanggal_transaksi' => $tanggal_transaksi,
            'accounting' => $accounting,
            'keterangan' => $keterangan,
            'unit_id' => $unit_id,
            'total_transaksi' => 0,
            'is_valid' => 0,
            'user_id' => $user_id
        );
        $this->db2->insert('transaksis', $data);
    }
    public function ubah($id)
    {
        $unit_id = $this->input->post('unit_id');
        $noref = $this->input->post('noref');
        $tanggal_transaksi = tanggal_input($this->input->post('tanggal_transaksi'));
        $keterangan = htmlspecialchars($this->input->post('keterangan'));
        $nobukti = htmlspecialchars($this->input->post('nobukti'));
        $data = array(
            'nobukti' => $nobukti,
            'tanggal_transaksi' => $tanggal_transaksi,
            'keterangan' => $keterangan,
            'noref' => $noref,
            'unit_id' => $unit_id
        );
        $this->db2->where('id', $id);
        $this->db2->update('transaksis', $data);
    }
    public function auditCekId()
    {
        $idtran = $this->input->post('id');
        $jurnal = $this->input->post('jurnal');
        $notran = $this->input->post('notran');
        return $this->db2->get_where('transaksis', ['id' => $idtran])->num_rows();
    }
    public function auditHapus()
    {
        $idtran = $this->input->post('id');
        $jurnal = $this->input->post('jurnal');
        $notran = $this->input->post('notran');
        if ($jurnal == "PM") {
            $this->db2->query("insert into audits(transaksi_id,jurnal,tahun_buku,notran,nobukti,noref,tanggal_transaksi,keterangan,accounting,date_created,is_valid,total_transaksi,unit_id,user_id) select * from transaksis where id='$idtran'");
            $hasilOpm = $this->db3->get_where('operasionals', ['notran' => $notran])->row_array();
            $idOpm = $hasilOpm['id'];
            $this->db3->query("insert into audits(operasional_id,jurnal,perak_id,notran,nobukti,noref,tanggal_transaksi,jenis,keterangan,accounting,date_created,is_valid,unit_id,user_id,mahasiswa_id,total_transaksi) select * from operasionals where id='$idOpm'");
            $this->db2->delete('transaksis', ['id' => $idtran]);
            $this->db3->delete('operasionals', ['id' => $idOpm]);
            $hasilTran = $this->db2->get_where('detail_transaksis', ['transaksi_id' => $idtran])->result_array();
            if ($hasilTran) {
                foreach ($hasilTran as $dataHasilTran) :
                    $idDetailTran = $dataHasilTran['id'];
                    $this->db2->query("insert into detail_audits(transaksi_id,a6level_id,posisi_akun,debet,kredit,is_anggaran,jumlah) SELECT transaksi_id,a6level_id,posisi_akun,debet,kredit,is_anggaran,jumlah from detail_transaksis where id='$idDetailTran'");
                endforeach;
                $this->db2->delete('detail_transaksis', ['transaksi_id' => $idtran]);
            }
            $hasilOpm2 = $this->db2->get_where('detail_transaksis', ['transaksi_id' => $idtran])->result_array();
            if ($hasilOpm2) {
                foreach ($hasilOpm2 as $dataHasilOpm2) :
                    $idDetailOpm = $dataHasilOpm2['id'];
                    $this->db2->query("insert into detail_audits(transaksi_id,a6level_id,posisi_akun,debet,kredit,is_anggaran,jumlah) SELECT transaksi_id,a6level_id,posisi_akun,debet,kredit,is_anggaran,jumlah from detail_transaksis where id='$idDetailOpm'");
                endforeach;
                $this->db3->delete('detail_operasionals', ['operasional_id' => $idDetailOpm]);
            }
        } else {
            // ->result()
            $this->db2->query("insert into audits(transaksi_id,jurnal,tahun_buku,notran,nobukti,noref,tanggal_transaksi,keterangan,accounting,date_created,is_valid,total_transaksi,unit_id,user_id) select * from transaksis where id='$idtran'");
            $this->db2->delete('transaksis', ['id' => $idtran]);
            $hasil = $this->db2->get_where('detail_transaksis', ['transaksi_id' => $idtran])->result_array();
            if ($hasil) {
                foreach ($hasil as $dataHasil) :
                    $idDetail = $dataHasil['id'];
                    $this->db2->query("insert into detail_audits(transaksi_id,a6level_id,posisi_akun,debet,kredit,is_anggaran,jumlah) SELECT transaksi_id,a6level_id,posisi_akun,debet,kredit,is_anggaran,jumlah from detail_transaksis where id='$idDetail'");
                endforeach;
                $this->db2->delete('detail_transaksis', ['transaksi_id' => $idtran]);
            }
        }
    }
    public function cek_akunubah($akun_id, $tran_id)
    {
        return $this->db2->query("select a6level_id,transaksi_id from detail_transaksis where a6level_id='$akun_id' and transaksi_id=$tran_id")->result_array();
    }
    public function hapusdetailsaldo($id)
    {
        $this->db2->delete('detail_transaksis', ['transaksi_id' => $id]);
    }
    public function simpandetailsaldo($tran_id, $a6level_id, $posisi, $jumlah, $debet, $kredit)
    {
        $data = array(
            'transaksi_id' => $tran_id,
            'a6level_id' => $a6level_id,
            'posisi_akun' => $posisi,
            'debet' => $debet,
            'kredit' => $kredit,
            'jumlah' => $jumlah
        );
        $this->db2->insert('detail_transaksis', $data);
    }
    public function ubahdetail($id)
    {
        $a6level_id = $this->input->post('a6level_id');
        $posisi = $this->input->post('posisi_akun');
        $jurnal = $this->input->post('idjt');
        $jumlah = input_uang($this->input->post('jumlah'));
        $anggaran = $this->input->post('is_anggaran');
        // $is_anggaran = 0;
        // if ($jurnal <> "NN") {
        //     $is_anggaran = $anggaran;
        // }
        $is_anggaran = $anggaran;
        if ($posisi == "D") {
            $debet = $jumlah;
            $kredit = 0;
        } else {
            $debet = 0;
            $kredit = $jumlah;
        }
        $data = array(
            'a6level_id' => $a6level_id,
            'posisi_akun' => $posisi,
            'debet' => $debet,
            'kredit' => $kredit,
            'jumlah' => $jumlah,
            'is_anggaran' => $is_anggaran
        );
        $this->db2->where('id', $id);
        $this->db2->update('detail_transaksis', $data);
    }
    public function simpandetail()
    {
        $tran_id = $this->input->post('transaksi_id');
        $a6level_id = $this->input->post('a6level_id');
        $posisi = $this->input->post('posisi_akun');
        $jumlah = input_uang($this->input->post('jumlah'));
        $jurnal = $this->input->post('idjt');
        $anggaran = $this->input->post('is_anggaran');
        //$is_anggaran = 0;
        // if ($jurnal <> "NN") {
        // $is_anggaran = $anggaran;
        // }
        $is_anggaran = $anggaran;
        if ($posisi == "D") {
            $debet = $jumlah;
            $kredit = 0;
        } else {
            $debet = 0;
            $kredit = $jumlah;
        }
        $data = array(
            'transaksi_id' => $tran_id,
            'a6level_id' => $a6level_id,
            'posisi_akun' => $posisi,
            'debet' => $debet,
            'kredit' => $kredit,
            'is_anggaran' => $is_anggaran,
            'jumlah' => $jumlah
        );
        $this->db2->insert('detail_transaksis', $data);
    }
    public function hapusdetailtransaksi($id)
    {
        $this->db2->delete('detail_transaksis', ['id' => $id]);
    }
    public function cektotaltransaksi($id)
    {
        return $this->db2->query("Select sum(debet)as debet,sum(kredit) as kredit from detail_transaksis where transaksi_id=$id group by transaksi_id")->row_array();
    }
    public function selesaitransaksi()
    {
        $id = $this->input->post('transaksi_id');
        $total = $this->input->post('total_transaksi');
        $data = array(
            'is_valid' => 1,
            'total_transaksi' => input_uang($total)
        );
        $this->db2->where('id', $id);
        $this->db2->update('transaksis', $data);
        //return "ok";
    }
}
