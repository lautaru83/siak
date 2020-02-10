
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
            // $userAccess = $ci->db->get_where('accesses', [
            //     'role_id' => $role_id,
            //     'submenu_id' => $submenu_id
            // ]);
            // if ($userAccess->num_rows() < 1) {
            //     redirect('auth/blocked');
            // }
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
function cek_akun($tran_id, $akun_id)
{
    $ci = get_instance();
    $result = $ci->db->query("select siak_akuntansi.akun_transaksis.id as id from siak_akuntansi.akun_transaksis where siak_akuntansi.akun_transaksis.jenis_transaksi_id='$tran_id' and siak_akuntansi.akun_transaksis.a6level_id='$akun_id'");
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
function txt_gender($gender)
{
    if ($gender == "L") {
        return "Laki-laki";
    } else {
        return "Perempuan";
    }
}
function txt_roman($angka)
{
    if ($angka == 1) {
        return "I";
    } elseif ($angka == 2) {
        return "II";
    } elseif ($angka == 3) {
        return "III";
    } elseif ($angka == 4) {
        return "IV";
    } elseif ($angka == 5) {
        return "V";
    } elseif ($angka == 6) {
        return "VI";
    } elseif ($angka == 7) {
        return "VII";
    } elseif ($angka == 8) {
        return "VIII";
    } elseif ($angka == 9) {
        return "IX";
    } elseif ($angka == 10) {
        return "X";
    } else {
        return "-";
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
function posisi_akun($posisi)
{
    if ($posisi == "D") {
        return "Debet";
    } elseif ($posisi == "K") {
        return "Kredit";
    } else {
        return "Akumulasi";
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
function ambilsaldo($thbukuid, $akunid, $posisi)
{
    $ci = get_instance();
    $ci->db2 = $ci->load->database('akuntansi', TRUE);
    // $akun = $ci->db2->query("select posisi from a6levels where id='$akunid'")->row_array();
    // $posisi=$akun['posisi'];
    $result = $ci->db2->query("select * from saldoawals where tahun_pembukuan_id='$thbukuid' and a6level_id='$akunid'")->row_array();
    if ($result) {
        $debet = $result['debet'];
        $kredit = $result['kredit'];
        if ($posisi == "D") {
            $saldoawal = $debet - $kredit;
        } else {
            $saldoawal = $kredit - $debet;
        }
        echo rupiah_positif($saldoawal);
    } else {
        echo "0,00";
    }
}
function saldoAwalAbttInstitusi($a2level_id)
{
    $ci = get_instance();
    $ci->db2 = $ci->load->database('akuntansi', TRUE);
    $institusi_id = $ci->session->userdata('idInstitusi');
    $tahun_buku = $ci->session->userdata('tahun_buku');
    $hasil = $ci->db2->query("SELECT a.posisi, SUM(b.debet) AS debet, SUM(b.kredit) AS kredit FROM view_kodeperkiraans AS a JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id = '$a2level_id' AND a.institusi_id = '$institusi_id' AND b.tahun_buku = '$tahun_buku' AND b.jurnal = 'SA' GROUP BY a.a2level_id")->result_array();
    $saldoAwal = 0;
    if ($hasil) {
        $debet = 0;
        $kredit = 0;
        foreach ($hasil as $dataHasil) :
            $posisi = $dataHasil['posisi'];
            $debet = $dataHasil['debet'];
            $kredit = $dataHasil['kredit'];
            if ($posisi == "D") {
                $saldoAwal = $debet - $kredit;
            } else {
                $saldoAwal = $kredit - $debet;
            }
        endforeach;
        return $saldoAwal;
    } else {
        return $saldoAwal;
    }
}
function saldoAwalAbttKonsolidasi($a2level_id)
{
    $ci = get_instance();
    $ci->db2 = $ci->load->database('akuntansi', TRUE);
    //$institusi_id = $ci->session->userdata('idInstitusi');
    $tahun_buku = $ci->session->userdata('tahun_buku');
    $hasil = $ci->db2->query("SELECT a.posisi, SUM(b.debet) AS debet, SUM(b.kredit) AS kredit FROM view_kodeperkiraans AS a JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a2level_id = '$a2level_id' AND b.tahun_buku = '$tahun_buku' AND b.jurnal = 'SA' GROUP BY a.a2level_id")->result_array();
    $saldoAwal = 0;
    if ($hasil) {
        $debet = 0;
        $kredit = 0;
        foreach ($hasil as $dataHasil) :
            $posisi = $dataHasil['posisi'];
            $debet = $dataHasil['debet'];
            $kredit = $dataHasil['kredit'];
            if ($posisi == "D") {
                $saldoAwal = $debet - $kredit;
            } else {
                $saldoAwal = $kredit - $debet;
            }
        endforeach;
        return $saldoAwal;
    } else {
        return $saldoAwal;
    }
}
function saldoAwalKasInstitusi($a3level_id)
{
    $ci = get_instance();
    $ci->db2 = $ci->load->database('akuntansi', TRUE);
    $institusi_id = $ci->session->userdata('idInstitusi');
    $tahun_buku = $ci->session->userdata('tahun_buku');
    $hasil = $ci->db2->query("SELECT a.posisi, SUM(b.debet) AS debet, SUM(b.kredit) AS kredit FROM view_kodeperkiraans AS a JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a3level_id = '$a3level_id' AND a.institusi_id = '$institusi_id' AND b.tahun_buku = '$tahun_buku' AND b.jurnal = 'SA' GROUP BY a.a3level_id")->result_array();
    $saldoAwal = 0;
    if ($hasil) {
        $debet = 0;
        $kredit = 0;
        foreach ($hasil as $dataHasil) :
            $posisi = $dataHasil['posisi'];
            $debet = $dataHasil['debet'];
            $kredit = $dataHasil['kredit'];
            if ($posisi == "D") {
                $saldoAwal = $debet - $kredit;
            } else {
                $saldoAwal = $kredit - $debet;
            }
        endforeach;
        return $saldoAwal;
    } else {
        return $saldoAwal;
    }
}
function saldoAwalKasKonsolidasi($a3level_id)
{
    $ci = get_instance();
    $ci->db2 = $ci->load->database('akuntansi', TRUE);
    //$institusi_id = $ci->session->userdata('idInstitusi');
    $tahun_buku = $ci->session->userdata('tahun_buku');
    $hasil = $ci->db2->query("SELECT a.posisi, SUM(b.debet) AS debet, SUM(b.kredit) AS kredit FROM view_kodeperkiraans AS a JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a3level_id = '$a3level_id' AND b.tahun_buku = '$tahun_buku' AND b.jurnal = 'SA' GROUP BY a.a3level_id")->result_array();
    $saldoAwal = 0;
    if ($hasil) {
        $debet = 0;
        $kredit = 0;
        foreach ($hasil as $dataHasil) :
            $posisi = $dataHasil['posisi'];
            $debet = $dataHasil['debet'];
            $kredit = $dataHasil['kredit'];
            if ($posisi == "D") {
                $saldoAwal = $debet - $kredit;
            } else {
                $saldoAwal = $kredit - $debet;
            }
        endforeach;
        return $saldoAwal;
    } else {
        return $saldoAwal;
    }
}
function saldoAkun6Laporan($tanggal, $idakun3)
{
    $ci = get_instance();
    $ci->db2 = $ci->load->database('akuntansi', TRUE);
    $institusi_id = $ci->session->userdata('idInstitusi');
    $akun = $ci->db2->query("select a6level_id,level6 from view_kodeperkiraans where institusi_id='$institusi_id' and a3level_id='$idakun3'")->row_array();
    $akun_id = $akun['a6level_id'];
    if ($akun) {
        $akun_id = $akun['a6level_id'];
    } else {
        $akun_id = "";
    }
    $awal_periode = tanggal_input($ci->session->userdata('buku_awal'));
    $tahun_buku = $ci->session->userdata('tahun_buku');
    $akhir_periode = tanggal_input($tanggal);
    $hasil = $ci->db2->query("select  a6level_id,posisi,sum(debet) as debet,sum(kredit) as kredit from view_detailtransaksis WHERE a6level_id='$akun_id' AND tanggal_transaksi BETWEEN '$awal_periode' AND '$akhir_periode' AND tahun_buku='$tahun_buku' GROUP BY a6level_id")->result_array();
    if ($hasil) {
        $debet = 0;
        $kredit = 0;
        $saldo = 0;
        foreach ($hasil as $hasilData) :
            $posisi = $hasilData['posisi'];
            $debet = $hasilData['debet'];
            $kredit = $hasilData['kredit'];
            if ($posisi == "D") {
                $saldo = $debet - $kredit;
            } else {
                $saldo = $kredit - $debet;
            }
        endforeach;
        return $saldo;
    } else {
        return $saldo;
    }
}
function asetbersihTb($tanggal)
{
    //Mengambil aset bersih tidak terikat tahun berjalan per institusi
    $ci = get_instance();
    $ci->db2 = $ci->load->database('akuntansi', TRUE);
    $institusi_id = $ci->session->userdata('idInstitusi');
    $buku_awal = $ci->session->userdata('buku_awal');
    $tahun_buku = $ci->session->userdata('tahun_buku');
    $akhir_periode = tanggal_input($tanggal);
    // $ci->db->where('submenu_id', $submenu_id);
    $hasil = $ci->db2->query("SELECT a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit,b.tanggal_transaksi as tanggal_transaksi FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a1level_id BETWEEN '400' AND '700' AND b.tahun_buku='$tahun_buku' AND a.institusi_id='$institusi_id' AND b.tanggal_transaksi BETWEEN '$buku_awal' AND '$akhir_periode' AND is_valid BETWEEN 1 AND 2 GROUP BY b.tahun_buku")->result_array();
    $debet = 0;
    $kredit = 0;
    $jumlah = 0;
    if ($hasil) {
        foreach ($hasil as $dataHasil) :
            $debet = $dataHasil['debet'];
            $kredit = $dataHasil['kredit'];
            $jumlah = $kredit - $debet;
        endforeach;
        return $jumlah;
    } else {
        return $jumlah;
    }
}
function asetbersihTbKonsolidasi($tanggal)
{
    //Mengambil aset bersih tidak terikat tahun berjalan per institusi
    $ci = get_instance();
    $ci->db2 = $ci->load->database('akuntansi', TRUE);
    $buku_awal = $ci->session->userdata('buku_awal');
    $tahun_buku = $ci->session->userdata('tahun_buku');
    $akhir_periode = tanggal_input($tanggal);
    // $ci->db->where('submenu_id', $submenu_id);
    $hasil = $ci->db2->query("SELECT a.posisi as posisi, SUM(b.debet) as debet, SUM(b.kredit) as kredit,b.tanggal_transaksi as tanggal_transaksi FROM view_kodeperkiraans AS a INNER JOIN view_transaksis AS b ON a.a6level_id = b.a6level_id WHERE a.a1level_id BETWEEN '400' AND '700' AND b.tahun_buku='$tahun_buku' AND b.tanggal_transaksi BETWEEN '$buku_awal' AND '$akhir_periode' AND is_valid BETWEEN 1 AND 2 GROUP BY b.tahun_buku")->result_array();
    $debet = 0;
    $kredit = 0;
    $jumlah = 0;
    if ($hasil) {
        foreach ($hasil as $dataHasil) :
            $debet = $dataHasil['debet'];
            $kredit = $dataHasil['kredit'];
            $jumlah = $kredit - $debet;
        endforeach;
        return $jumlah;
    } else {
        return $jumlah;
    }
}
function rupiah($angka)
{
    $hasil_rupiah = number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
function input_uang($uang)
{
    $uang1 = str_replace(".", "", $uang);
    $uang2 = str_replace(",", ".", $uang1);
    return $uang2;
}
function notransaksi()
{
    $ci = get_instance();
    $th = $ci->session->userdata('tahun_buku');
    $ints = $ci->session->userdata('idInstitusi');
    $char = substr($th, 2, 2) . $ints;
    $hasil = $ci->db->query("select max(a.notran) as maxnotran from siak_akuntansi.transaksis a join siak_setting.units b on b.id=a.unit_id join siak_setting.institusis c on c.id=b.institusi_id where a.tahun_buku='2019' and c.id=$ints")->row_array();
    if ($hasil) {
        $nomor = $hasil['maxnotran'];
        $noUrut = (int) substr($nomor, 4, 6);
        $noUrut++;
        $notran = $char . sprintf("%06s", $noUrut);
    } else {
        $notran = $char . "000001";
    }
    return $notran;
}
function no_tran($jurnal)
{
    $ci = get_instance();
    $th = $ci->session->userdata('tahun_buku');
    $ints = $ci->session->userdata('idInstitusi');
    $char = $jurnal . substr($th, 2, 2) . $ints;
    $hasil = $ci->db->query("select max(a.notran) as maxnotran from siak_akuntansi.transaksis a join siak_setting.units b on b.id=a.unit_id join siak_setting.institusis c on c.id=b.institusi_id where a.tahun_buku='2019' and a.jurnal='$jurnal' and c.id='$ints'")->row_array();
    if ($hasil) {
        $nomor = $hasil['maxnotran'];
        $noUrut = (int) substr($nomor, 6, 4);
        $noUrut++;
        $notran = $char . sprintf("%04s", $noUrut);
    } else {
        $notran = $char . "0001";
    }
    return $notran;
}
function padding_akun($posisi)
{
    if ($posisi == "D") {
        echo "";
    } else {
        echo "class='pl-5'";
    }
}
function cek_combo($opt1, $opt2)
{
    if ($opt1 == $opt2) {
        echo "selected";
    }
}
function rupiah_positif($angka)
{
    if ($angka < 0) {
        $angka_positif = abs($angka);
        echo "(" . rupiah($angka_positif) . ")";
    } elseif ($angka == 0) {
        echo "-";
    } else {
        echo rupiah($angka);
    }
}
function sembunyikan_input($institusi)
{
    if ($institusi == "01") {
        echo "class='form-check form-check-inline mx-sm-2 mb-2'";
    } else {
        echo "class='form-check form-check-inline mx-sm-2 mb-2 invisible'";
    }
}
