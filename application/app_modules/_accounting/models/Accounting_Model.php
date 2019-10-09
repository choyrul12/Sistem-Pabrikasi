<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accounting_Model extends CI_Model{
  //============SELECT METHOD (START)============//
  public function selectHasilExtruder($param){
    if(empty($param["key"])){
      $clause = "";
    }else{
      $clause = " AND a.tgl_rencana LIKE '%$param[key]%'";
    }
    $this->db->simple_query("SET SESSION group_concat_max_len = 1000000000000000");
    $Q = "SELECT SUM(a.jumlah_selesai) AS total,
                 SUM(a.roll_pipa) AS totalRoll,
                 a.kd_gd_roll, a.merek, a.panjang, a.tgl_rencana,
                 GROUP_CONCAT(a.warna_plastik) AS warnaPlastik,
                 GROUP_CONCAT(DATE_FORMAT(a.tgl_jadi, '%d %M %Y')) AS tgl_kirim,
                 GROUP_CONCAT(a.jumlah_selesai) AS jumlahSelesai,
                 GROUP_CONCAT(a.roll_pipa) AS rollPipa,
                 GROUP_CONCAT(a.jenis_roll) AS jenisRoll,
                 GROUP_CONCAT(a.shift) AS shift,
                 GROUP_CONCAT(a.diperbarui) AS diperbarui,
                 GROUP_CONCAT(b.username) AS username
                 FROM transaksi_hasil_extruder a JOIN users b ON a.id_user = b.id_user
                 WHERE a.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
                 AND status_transaksi='TRUE'
                 $clause
                 GROUP BY kd_gd_roll
                 ORDER BY hasil_ukuran, merek, warna_plastik ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectPengeluaranGudangRollKePotong($param){
    if($param["jnsPermintaan"]=="CETAK"){
      $clause = " AND RC.jns_permintaan IN('CETAK','CETAK/POLOS','POLOS/CETAK')";
    }else{
      $clause = " AND RC.jns_permintaan='$param[jnsPermintaan]'";
    }

    if(empty($param["key"])){
      $clause2 = "";
    }else{
      $clause2 = " AND THP.tgl_rencana LIKE '%$param[key]%'";
    }
    $Q = "SELECT THP.tgl_rencana, RC.ukuran, RC.warna_plastik, GR.merek, RC.jns_permintaan,
                 (TPHP.berat_pengambilan_bagian + TPHP.berat_pengambilan_gudang + TPHP.berat_sisa_semalam) AS totalBeratPengambilan,
                 (TPHP.bobin_pengambilan_bagian + TPHP.bobin_pengambilan_gudang + TPHP.bobin_sisa_semalam) AS totalBobinPengambilan,
                 (TPHP.payung_pengambilan_bagian + TPHP.payung_pengambilan_gudang + TPHP.payung_sisa_semalam) AS totalPayungPengambilan,
                 (TPHP.payung_kuning_pengambilan_bagian + TPHP.payung_kuning_pengambilan_gudang + TPHP.payung_kuning_sisa_semalam) AS totalPayungKuningPengambilan, TPHP.diperbarui, TU.username
          FROM transaksi_pengambilan_hasil_potong TPHP
          INNER JOIN transaksi_hasil_potong THP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          INNER JOIN gudang_roll GR ON TSHP.kd_gd_roll = GR.kd_gd_roll
          INNER JOIN users TU ON TU.id_user = THP.id_user
          WHERE THP.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND TPHP.deleted='FALSE'
          AND THP.deleted='FALSE'
          AND TSHP.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND GR.deleted='FALSE'
          $clause
          $clause2
          GROUP BY SUBSTRING_INDEX(RC.ukuran,'x',1), RC.warna_plastik, RC.merek
          ORDER BY RC.tgl_rencana ASC, RC.merek ASC, SUBSTRING_INDEX(RC.ukuran,'x',1) ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectPengembalianPotongKeGudangRoll($param){
    if($param["jnsPermintaan"]=="CETAK"){
      $clause = " AND RC.jns_permintaan IN('CETAK','CETAK/POLOS','POLOS/CETAK')";
    }else{
      $clause = " AND RC.jns_permintaan='$param[jnsPermintaan]'";
    }

    if(empty($param["key"])){
      $clause2 = "";
    }else{
      $clause2 = " AND THP.tgl_rencana LIKE '%$param[key]%'";
    }
    $Q = "SELECT THP.tgl_rencana, RC.ukuran, RC.warna_plastik, GR.merek, RC.jns_permintaan,
                 (TPHP.berat_sisa_hari_ini) AS totalBeratSisa,
                 (TPHP.bobin_sisa_hari_ini) AS totalBobinSisa,
                 (TPHP.payung_sisa_hari_ini) AS totalPayungSisa,
                 (TPHP.payung_kuning_sisa_hari_ini) AS totalPayungKuningSisa, TPHP.diperbarui, TU.username
          FROM transaksi_pengambilan_hasil_potong TPHP
          INNER JOIN transaksi_hasil_potong THP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          INNER JOIN gudang_roll GR ON TSHP.kd_gd_roll = GR.kd_gd_roll
          INNER JOIN users TU ON TU.id_user = THP.id_user
          WHERE THP.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND TPHP.deleted='FALSE'
          AND THP.deleted='FALSE'
          AND TSHP.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND GR.deleted='FALSE'
          $clause
          $clause2
          GROUP BY SUBSTRING_INDEX(RC.ukuran,'x',1), RC.warna_plastik, RC.merek
          ORDER BY RC.tgl_rencana ASC, RC.merek ASC, SUBSTRING_INDEX(RC.ukuran,'x',1) ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListRollPolosKeCetak($param){
    if(empty($param["key"])){
      $clause2 = "";
    }else{
      $clause2 = " AND THC.tgl_transaksi LIKE '%$param[key]%'";
    }

    $Q = "SELECT THC.tgl_transaksi, GR.ukuran, GR.jns_permintaan, GR.merek, GR.warna_plastik,
                 (TDHC.jumlah_berat_pengambilan_extruder + TDHC.jumlah_berat_pengambilan) AS totalBeratPengambilan,
                 (TDHC.jumlah_bobin_pengambilan_extruder + TDHC.jumlah_bobin_pengambilan) AS totalBobinPengambilan,
                 (TDHC.jumlah_payung_pengambilan_extruder + TDHC.jumlah_payung_pengambilan) AS totalPayungPengambilan,
                 (TDHC.jumlah_payung_kuning_pengambilan_extruder + TDHC.jumlah_payung_kuning_pengambilan) AS totalPayungKuningPengambilan, TDHC.diperbarui, TU.username
          FROM transaksi_detail_hasil_cetak TDHC
          INNER JOIN transaksi_hasil_cetak THC ON TDHC.kd_hasil_cetak = THC.kd_hasil_cetak
          INNER JOIN gudang_roll GR ON TDHC.kd_gd_roll_polos = GR.kd_gd_roll
          INNER JOIN users TU ON TU.id_user = TDHC.id_user
          WHERE GR.deleted='FALSE'
          AND TDHC.deleted='FALSE'
          AND THC.deleted='FALSE'
          AND THC.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          $clause2";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListRollPolosKeRollCetak($param){
    if(empty($param["key"])){
      $clause2 = "";
    }else{
      $clause2 = " AND THC.tgl_transaksi LIKE '%$param[key]%'";
    }

    $Q = "SELECT THC.kd_gd_roll, THC.tgl_transaksi, RC.ukuran, RC.merek, RC.warna_plastik,
                 THC.jumlah_selesai, THC.bobin, THC.payung, THC.payung_kuning, THC.diperbarui, TU.username
          FROM transaksi_hasil_cetak THC
          INNER JOIN rencana_cetak RC ON THC.kd_cetak = RC.kd_cetak
          INNER JOIN users TU ON TU.id_user = THC.id_user
          WHERE THC.sts_transaksi='FINISH'
          AND THC.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND THC.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          $clause2";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListHistoryBarangHasil($param){
    if(empty($param["key"])){
      $clause2 = "";
    }else{
      $clause2 = " AND a.tgl_transaksi LIKE '%$param[key]%'";
    }

    $this->db->simple_query("SET SESSION group_concat_max_len = 9000000000000000");
    $Q = "SELECT a.kd_gd_hasil, a.customer, a.merek, a.ukuran, a.warna,
                 GROUP_CONCAT(FORMAT(a.jumlah_berat,2) SEPARATOR '#') AS arrJumlahBerat,
                 GROUP_CONCAT(FORMAT(a.jumlah_lembar,0) SEPARATOR '#') AS arrJumlahLembar,
                 GROUP_CONCAT(DATE_FORMAT(a.tgl_transaksi,'%d %M %Y') SEPARATOR '#') AS arrTglTransaksi,
                 GROUP_CONCAT(a.diperbarui SEPARATOR '#') AS diperbarui,
                 GROUP_CONCAT(b.username SEPARATOR '#') AS username,
                 SUM(a.jumlah_berat) totalJumlahBerat,
                 SUM(a.jumlah_lembar) AS totalJumlahLembar
          FROM transaksi_gudang_hasil a
          INNER JOIN users b on a.id_user = b.id_user
          WHERE a.deleted='FALSE'
          AND a.sts_barang='$param[stsBarang]'
          AND a.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND a.status_history='MASUK'
          AND a.status_transaksi='FINISH'
          AND a.keterangan_history IN('MASUK DARI POTONG','MASUK DARI SABLON')
          $clause2
          GROUP BY a.kd_gd_hasil
          ORDER BY a.tgl_transaksi ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListHistoryPengeluaranBarangStandard($param){
    if(empty($param["key"])){
      $clause2 = "";
    }else{
      $clause2 = " AND a.tgl_transaksi LIKE '%$param[key]%'";
    }

    $this->db->simple_query("SET SESSION group_concat_max_len = 9000000000000000");
    $Q = "SELECT a.kd_gd_hasil, a.customer, a.merek, a.ukuran, a.warna,
                 GROUP_CONCAT(FORMAT(a.jumlah_berat,2) SEPARATOR '#') AS arrJumlahBerat,
                 GROUP_CONCAT(FORMAT(a.jumlah_lembar,0) SEPARATOR '#') AS arrJumlahLembar,
                 GROUP_CONCAT(DATE_FORMAT(a.tgl_transaksi,'%d %M %Y') SEPARATOR '#') AS arrTglTransaksi,
                 SUM(a.jumlah_berat) totalJumlahBerat,
                 SUM(a.jumlah_lembar) AS totalJumlahLembar,
                 GROUP_CONCAT(a.diperbarui SEPARATOR '#') AS diperbarui,
                 GROUP_CONCAT(b.username SEPARATOR '#') AS username
          FROM transaksi_gudang_hasil a
          INNER JOIN users b on a.id_user = b.id_user
          WHERE a.deleted='FALSE'
          AND a.sts_barang='STANDARD'
          AND a.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          $clause2
          AND a.status_history='KELUAR'
          AND status_transaksi='FINISH'
          GROUP BY a.kd_gd_hasil
          ORDER BY a.tgl_transaksi ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListHistoryJobPotong($param){
    $this->db->simple_query("SET SESSION group_concat_max_len = 9000000000000000");
    $Q = "SELECT THP.tgl_rencana,
                 RC.customer,
                 RC.ukuran, RC.warna_plastik, RC.merek,
                 TSHP.jumlah_lembar,
                 THP.hasil_berat_kotor, THP.hasil_berat_bersih,

                 (TPHP.berat_pengambilan_bagian + TPHP.berat_pengambilan_gudang + TPHP.berat_sisa_semalam +
                  TPHP.berat_pengambilan_bagian_tumpuk + TPHP.berat_pengambilan_gudang_tumpuk + TPHP.berat_sisa_semalam_tumpuk) AS beratPengambilan,

                 (TPHP.bobin_pengambilan_bagian + TPHP.bobin_pengambilan_gudang + TPHP.bobin_sisa_semalam +
                  TPHP.bobin_pengambilan_bagian_tumpuk + TPHP.bobin_pengambilan_gudang_tumpuk + TPHP.bobin_sisa_semalam_tumpuk) AS bobinPengambilan,

                 (TPHP.payung_pengambilan_bagian + TPHP.payung_pengambilan_gudang + TPHP.payung_sisa_semalam +
                  TPHP.payung_pengambilan_bagian_tumpuk + TPHP.payung_pengambilan_gudang_tumpuk + TPHP.payung_sisa_semalam_tumpuk) AS payungPengambilan,

                 (TPHP.payung_kuning_pengambilan_bagian + TPHP.payung_kuning_pengambilan_gudang + TPHP.payung_kuning_sisa_semalam +
                  TPHP.payung_kuning_pengambilan_bagian_tumpuk + TPHP.payung_kuning_pengambilan_gudang_tumpuk + TPHP.payung_kuning_sisa_semalam_tumpuk) AS payungKuningPengambilan,

                 (TPHP.berat_sisa_hari_ini + TPHP.berat_sisa_hari_ini_tumpuk) AS berat_sisa_hari_ini, (TPHP.bobin_sisa_hari_ini + TPHP.bobin_sisa_hari_ini_tumpuk) AS bobin_sisa_hari_ini,
                 (TPHP.payung_sisa_hari_ini + TPHP.payung_sisa_hari_ini_tumpuk) AS payung_sisa_hari_ini, (TPHP.payung_kuning_sisa_hari_ini + TPHP.payung_kuning_sisa_hari_ini_tumpuk) AS payung_kuning_sisa_hari_ini,
                 THP.jumlah_apal_global, THP.jumlah_roll_pipa, THP.plusminus
          FROM transaksi_sub_hasil_potong TSHP
          INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN transaksi_pengambilan_hasil_potong TPHP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          WHERE THP.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND RC.deleted = 'FALSE'
          AND THP.deleted = 'FALSE'
          AND TSHP.deleted = 'FALSE'
          AND TPHP.deleted = 'FALSE'
          AND THP.status_transaksi = 'FINISH'
          ORDER BY THP.tgl_rencana ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListHistoryJobCetak($param){
    $Q = "SELECT RC.customer, RC.merek, RC.ukuran, RC.warna_plastik, THC.tgl_transaksi,
                 (TDHC.jumlah_berat_pengambilan_extruder + TDHC.jumlah_berat_pengambilan) AS beratPengambilan,
                 (TDHC.jumlah_bobin_pengambilan_extruder + TDHC.jumlah_bobin_pengambilan) AS bobinPengambilan,
                 (TDHC.jumlah_payung_pengambilan_extruder + TDHC.jumlah_payung_pengambilan) AS payungPengambilan,
                 (TDHC.jumlah_payung_kuning_pengambilan_extruder + TDHC.jumlah_payung_kuning_pengambilan) AS payungKuningPengambilan,
                 TDHC.jumlah_hasil_selesai, TDHC.jumlah_hasil_bobin, TDHC.jumlah_hasil_payung, TDHC.jumlah_hasil_payung_kuning,
                 TDHC.jumlah_sisa_pengambilan, TDHC.jumlah_apal, THC.berat_roll, THC.plusminus,
                 TDHC.jumlah_bobin_terbuang, TDHC.jumlah_payung_terbuang, TDHC.jumlah_payung_kuning_terbuang, TDHC.kd_hasil_cetak
          FROM transaksi_detail_hasil_cetak TDHC
          INNER JOIN transaksi_hasil_cetak THC ON TDHC.kd_hasil_cetak = THC.kd_hasil_cetak
          INNER JOIN rencana_cetak RC ON THC.kd_cetak = RC.kd_cetak
          WHERE TDHC.deleted = 'FALSE'
          AND THC.deleted = 'FALSE'
          AND RC.deleted = 'FALSE'
          AND THC.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND THC.sts_transaksi = 'FINISH'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListPemakaianBahanCetakId($param){
    $Q = "SELECT GB.kd_gd_bahan, GB.nm_barang, GB.warna, GB.jenis,
                 TPBC.sisa_pengambilan, TPBC.jumlah_pengambilan, TPBC.id_penggunaan_cetak
          FROM transaksi_penggunaan_bahan_cetak TPBC
          INNER JOIN transaksi_hasil_cetak THC ON TPBC.kd_hasil_cetak = THC.kd_hasil_cetak
          INNER JOIN gudang_bahan GB ON TPBC.kd_gd_bahan = GB.kd_gd_bahan
          WHERE TPBC.deleted = 'FALSE'
          AND GB.deleted = 'FALSE'
          AND TPBC.kd_hasil_cetak='$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListHistoryJobSablon($param){
    $Q = "SELECT THS.tanggal, RS.customer, RS.merek, RS.ukuran, RS.warna_plastik,
                 RS.warna_sablon, THS.hasil_lembar, THS.hasil_berat
          FROM transaksi_hasil_sablon THS
          INNER JOIN rencana_sablon RS ON THS.kd_sablon = RS.kd_sablon
          WHERE THS.deleted='FALSE'
          AND RS.deleted='FALSE'
          AND THS.tanggal BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND status='FINISH'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListHistoryGudangBahan($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $saldoAwal = $this->db->query("SELECT GB.kd_gd_bahan, GB.nm_barang, GB.warna, (
                                           SUM(IF(TGB.status_history='MASUK' AND TGB.tgl_permintaan <= '$param[tglAwal]',TGB.jumlah_permintaan,0))-
                                           SUM(IF(TGB.status_history='KELUAR' AND TGB.tgl_permintaan <= '$param[tglAwal]',TGB.jumlah_permintaan,0))
                                          )
                                AS saldo_awal,
                                SUM(IF(TGB.status_history='MASUK',TGB.jumlah_permintaan,0)) AS total_masuk_per_periode,
                                SUM(IF(TGB.status_history='KELUAR',TGB.jumlah_permintaan,0)) AS total_keluar_per_periode
                                FROM transaksi_gudang_bahan TGB
                                INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                WHERE GB.jenis = '$param[jenis]'
                                AND TGB.tgl_permintaan BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                AND TGB.deleted='FALSE'
                                AND TGB.status = 'FINISH'
                                GROUP BY TGB.kd_gd_bahan")->result_array();
    return json_encode($saldoAwal);
  }

  public function selectListHistorySparePart($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $saldoAwal = $this->db->query("SELECT SP.nm_spare_part, (
                                           SUM(IF(TDSP.sts_history='MASUK' AND TDSP.tgl_transaksi <= '$param[tglAwal]',TDSP.jumlah,0))-
                                           SUM(IF(TDSP.sts_history='KELUAR' AND TDSP.tgl_transaksi <= '$param[tglAwal]',TDSP.jumlah,0))
                                          )
                                AS saldo_awal,
                                SUM(IF(TDSP.sts_history='MASUK',TDSP.jumlah,0)) AS total_masuk_per_periode,
                                SUM(IF(TDSP.sts_history='KELUAR',TDSP.jumlah,0)) AS total_keluar_per_periode,
                                SP.kd_accurate, SP.kd_spare_part
                                FROM transaksi_detail_spare_part TDSP
                                INNER JOIN spare_part SP ON TDSP.kd_spare_part = SP.kd_spare_part
                                WHERE TDSP.tgl_transaksi BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                AND TDSP.deleted='FALSE'
                                AND TDSP.sts_transaksi = 'FINISH'
                                GROUP BY TDSP.kd_spare_part")->result_array();
    return json_encode($saldoAwal);
  }

  public function getListDataKuantitasGudangHasil($param)
  {
    $this->datatables->select("kd_gd_hasil, kd_accurate, warna_plastik, ukuran, stok_berat, stok_lembar, merek, sts_brg, diperbarui");
    $this->datatables->from("gudang_hasil");
    $this->datatables->where(" jns_brg = '$param' and deleted='FALSE'");
    $this->db->order_by("ukuran asc");

    return $this->datatables->generate();
  }

  public function getListDataKuantitasGudangRoll($param)
  {
    $this->datatables->select("kd_gd_roll, kd_accurate, warna_plastik, ukuran, stok, payung, payung_kuning, bobin, merek, jns_brg, diperbarui");
    $this->datatables->from("gudang_roll");
    $this->datatables->where(" jns_permintaan = '$param' and deleted='FALSE'");
    $this->db->order_by("ukuran asc");

    return $this->datatables->generate();
  }

  public function getListDataKuantitasGudangBahan($param)
  {
    $this->datatables->select("kd_gd_bahan, kd_accurate, nm_barang, warna, stok, diperbarui");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where(" jenis = '$param' and deleted='FALSE'");
    $this->db->order_by("nm_barang asc");

    return $this->datatables->generate();
  }

  public function getListDataKuantitasSparePart()
  {
    $this->datatables->select("kd_spare_part, nm_spare_part, kode, ukuran, stok, diperbarui");
    $this->datatables->from("spare_part");
    $this->datatables->where("deleted='FALSE'");
    $this->db->order_by("nm_spare_part asc");

    return $this->datatables->generate();
  }

  public function getListDataKuantitasApal()
  {
    $this->datatables->select("kd_gd_apal, sub_jenis, jenis, stok, diperbarui");
    $this->datatables->from("gudang_apal");
    $this->datatables->where("deleted='FALSE'");
    $this->db->order_by("sub_jenis asc");

    return $this->datatables->generate();
  }

  public function exportKuantitasGudangHasil($param)
  {
    $data = $this->db->query("select kd_gd_hasil, kd_accurate, warna_plastik, ukuran, stok_berat, stok_lembar, merek, sts_brg from gudang_hasil where jns_brg = '$param' and deleted='FALSE' order by ukuran asc ");
    return $data;
  }

  public function exportKuantitasGudangRoll($param)
  {
    $data = $this->db->query("select kd_gd_roll, kd_accurate, warna_plastik, ukuran, stok, payung, payung_kuning, bobin, merek, jns_brg, diperbarui from gudang_roll where jns_permintaan = '$param' and deleted='FALSE' order by ukuran asc");
    return $data;
  }

  public function exportKuantitasGudangBahan($param)
  {
    $data = $this->db->query("select kd_gd_bahan, kd_accurate, nm_barang, warna, stok, diperbarui from gudang_bahan where jenis = '$param' and deleted='FALSE' order by nm_barang asc ");
    return $data;
  }

  public function exportKuantitasSparePart()
  {
    $data = $this->db->query("select kd_spare_part, nm_spare_part, kode, ukuran, stok, diperbarui from spare_part where deleted = 'FALSE' order by nm_spare_part asc");
    return $data;
  }

  public function exportKuantitasApal()
  {
    $data = $this->db->query("select kd_gd_apal, sub_jenis, jenis, stok, diperbarui from gudang_apal where deleted = 'FALSE' order by sub_jenis asc");
    return $data;
  }

  public function getListDataKeluarMasukSparePart($data)
  {
    $this->db->trans_begin();

    $saldo = $this->db->query("SELECT @a:=SUM(IF(`sts_history`='masuk',`jumlah`,0)) AS totalDebit, @b:=SUM(IF(`sts_history`='keluar',`jumlah`,0)) AS totalKredit FROM `transaksi_detail_spare_part` where kd_spare_part = '$data[id]' and tgl_transaksi < '$data[tglAwal]' and sts_transaksi = 'FINISH' and deleted = 'FALSE'")->result_array();

    $saldo = $saldo[0]['totalDebit'] - $saldo[0]["totalKredit"];

    $result = array();
    array_push($result, $this->db->query("SELECT SUM(IF(`sts_history`='MASUK',`jumlah`,0)) as totalmasuk, SUM(IF(`sts_history`='KELUAR',`jumlah`,0)) as totalkeluar from `transaksi_detail_spare_part` WHERE `kd_spare_part` = '$data[id]' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and `sts_transaksi` = 'finish' and deleted = 'FALSE'")->result_array());

    array_push($result, $this->db->query("set @s:='$saldo'"));
    array_push($result, $this->db->query("select @d:=if(`sts_history`='masuk',`jumlah`,0) as debit,@k:=if(`sts_history`='keluar',`jumlah`,0) as kredit, @s:=@s+@d-@k as saldo, tgl_transaksi from transaksi_detail_spare_part where `kd_spare_part` = '$data[id]' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and `sts_transaksi` = 'finish' and deleted = 'FALSE'")->result_array());

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return json_encode($result);
    }
  }

  public function getListDataKeluarMasukBahan($data)
  {
    $this->db->trans_begin();

    $saldo = $this->db->query("SELECT @a:=SUM(IF(`status_history`='masuk',`jumlah_permintaan`,0)) AS totalDebit, @b:=SUM(IF(`status_history`='keluar',`jumlah_permintaan`,0)) AS totalKredit FROM `transaksi_gudang_bahan` where kd_gd_bahan = '$data[id]' and tgl_permintaan < '$data[tglAwal]' and status = 'FINISH' and deleted = 'FALSE'")->result_array();

    $saldo = $saldo[0]['totalDebit'] - $saldo[0]["totalKredit"];

    $result = array();
    array_push($result, $this->db->query("SELECT SUM(IF(`status_history`='MASUK',`jumlah_permintaan`,0)) as totalmasuk, SUM(IF(`status_history`='KELUAR',`jumlah_permintaan`,0)) as totalkeluar from `transaksi_gudang_bahan` WHERE `kd_gd_bahan` = '$data[id]' and tgl_permintaan BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and `status` = 'finish' and deleted = 'FALSE'")->result_array());

    array_push($result, $this->db->query("set @s:='$saldo'"));
    array_push($result, $this->db->query("select @d:=if(`status_history`='masuk',`jumlah_permintaan`,0) as debit,@k:=if(`status_history`='keluar',`jumlah_permintaan`,0) as kredit, @s:=@s+@d-@k as saldo, tgl_permintaan from transaksi_gudang_bahan where `kd_gd_bahan` = '$data[id]' and tgl_permintaan BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and `status` = 'finish' and deleted = 'FALSE'")->result_array());

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return json_encode($result);
    }
  }

  public function getBarangSablon()
  {
    $data = $this->db->query("select kd_gd_hasil, ukuran, merek, warna_plastik from gudang_hasil where jns_brg = 'sablon' and jns_permintaan = 'polos' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function searchBarangSablon($key)
  {
    $data = $this->db->query("select kd_gd_hasil, ukuran, merek, warna_plastik from gudang_hasil where jns_brg = 'sablon' and jns_permintaan = 'polos' and concat(kd_gd_hasil,' ',ukuran,' ',merek,' ',warna_plastik) regexp '$key' and deleted = 'FALSE' ")->result_array();
    return json_encode($data);
  }

  public function getListDataBarangSablonMasuk($data)
  {
    $this->datatables->select("kd_gd_hasil, tgl_transaksi, ukuran, merek, warna, jumlah_berat, jumlah_lembar, keterangan_history");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("(deleted = 'FALSE' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and kd_gd_hasil_secondary = '$data[kode]' and keterangan_history = 'pengambilan sablon (standard)' and status_transaksi='finish') or (deleted = 'FALSE' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and kd_gd_hasil_secondary = '$data[kode]' and keterangan_history = 'pengambilan sablon (campur)' and status_transaksi='finish') or (deleted = 'FALSE' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and kd_gd_hasil = '$data[kode]' and keterangan_history = 'pengembalian barang' and keterangan != 'PENGEMBALIAN KE GUDANG STANDARD' and sts_barang = 'sablon' and status_transaksi='finish')");
    return $this->datatables->generate();
  }

  public function getListDataBarangSablonKeluar($data)
  {
    $this->datatables->select("kd_gd_hasil, tgl_transaksi, ukuran, merek, warna, jumlah_berat, jumlah_lembar, keterangan_history");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("(deleted = 'FALSE' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and kd_gd_hasil_secondary = '$data[kode]' and keterangan_history = 'pengambilan sablon (sablon)' and status_transaksi='finish') or (deleted = 'FALSE' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and kd_gd_hasil = '$data[kode]' and keterangan_history = 'pengembalian barang' and keterangan_barang = 'pengembalian sablon' and keterangan ='PENGEMBALIAN KE GUDANG STANDARD' and status_transaksi='finish')");
    return $this->datatables->generate();
  }

  public function saldoAwalSablon($data)
  {
    $awalMasuk = $this->db->query("SELECT SUM(`jumlah_berat`) as totalBeratMasuk, SUM(`jumlah_lembar`) as totalLembarMasuk  from  transaksi_gudang_hasil WHERE (deleted = 'FALSE' and kd_gd_hasil_secondary = '$data[kode]' and keterangan_history = 'data awal' and status_transaksi='finish') or (deleted = 'FALSE' and tgl_transaksi < '$data[tglAwal]' and kd_gd_hasil_secondary = '$data[kode]' and keterangan_history = 'pengambilan sablon (standard)' and status_transaksi='finish') or (deleted = 'FALSE' and tgl_transaksi < '$data[tglAwal]' and kd_gd_hasil_secondary = '$data[kode]' and keterangan_history = 'pengambilan sablon (campur)' and status_transaksi='finish') or (deleted = 'FALSE' and tgl_transaksi < '$data[tglAwal]' and kd_gd_hasil = '$data[kode]' and keterangan_history = 'pengembalian barang' and keterangan != 'PENGEMBALIAN KE GUDANG STANDARD' and sts_barang = 'sablon' and status_transaksi='finish')")->result_array();

    $awalKeluar = $this->db->query("SELECT SUM(`jumlah_berat`) as totalBeratKeluar, SUM(`jumlah_lembar`) as totalLembarKeluar  from  transaksi_gudang_hasil WHERE (deleted = 'FALSE' and tgl_transaksi < '$data[tglAwal]' and kd_gd_hasil_secondary = '$data[kode]' and keterangan_history = 'pengambilan sablon (sablon)' and status_transaksi='finish') or (deleted = 'FALSE' and tgl_transaksi < '$data[tglAwal]' and kd_gd_hasil = '$data[kode]' and keterangan_history = 'pengembalian barang' and keterangan_barang = 'pengembalian sablon' and keterangan ='PENGEMBALIAN KE GUDANG STANDARD' and status_transaksi='finish')")->result_array();

    $totalMasuk = $this->db->query("SELECT SUM(`jumlah_berat`) as totalBeratMasuk, SUM(`jumlah_lembar`) as totalLembarMasuk  from  transaksi_gudang_hasil WHERE (deleted = 'FALSE' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and kd_gd_hasil_secondary = '$data[kode]' and keterangan_history = 'pengambilan sablon (standard)' and status_transaksi='finish') or (deleted = 'FALSE' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and kd_gd_hasil_secondary = '$data[kode]' and keterangan_history = 'pengambilan sablon (campur)' and status_transaksi='finish') or (deleted = 'FALSE' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and kd_gd_hasil = '$data[kode]' and keterangan_history = 'pengembalian barang' and keterangan != 'PENGEMBALIAN KE GUDANG STANDARD' and sts_barang = 'sablon' and status_transaksi='finish')")->result_array();

    $totalKeluar = $this->db->query("SELECT SUM(`jumlah_berat`) as totalBeratKeluar, SUM(`jumlah_lembar`) as totalLembarKeluar  from  transaksi_gudang_hasil WHERE (deleted = 'FALSE' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and kd_gd_hasil_secondary = '$data[kode]' and keterangan_history = 'pengambilan sablon (sablon)' and status_transaksi='finish') or (deleted = 'FALSE' and tgl_transaksi BETWEEN '$data[tglAwal]' and '$data[tglAkhir]' and kd_gd_hasil = '$data[kode]' and keterangan_history = 'pengembalian barang' and keterangan_barang = 'pengembalian sablon' and keterangan ='PENGEMBALIAN KE GUDANG STANDARD' and status_transaksi='finish')")->result_array();

    $result = array();
    $result["dataAwalBerat"]      = $awalMasuk[0]["totalBeratMasuk"] - $awalKeluar[0]["totalBeratKeluar"];
    $result["dataAwalLembar"]     = $awalMasuk[0]["totalLembarMasuk"] - $awalKeluar[0]["totalLembarKeluar"];
    $result["totalBeratMasuk"]    = $totalMasuk[0]["totalBeratMasuk"];
    $result["totalLembarMasuk"]   = $totalMasuk[0]["totalLembarMasuk"];
    $result["totalBeratKeluar"]   = $totalKeluar[0]["totalBeratKeluar"];
    $result["totalLembarKeluar"]  = $totalKeluar[0]["totalLembarKeluar"];
    $result["saldoBerat"]         = $result["dataAwalBerat"] + $totalMasuk[0]["totalBeratMasuk"] - $totalKeluar[0]["totalBeratKeluar"];
    $result["saldoLembar"]        = $result["dataAwalLembar"] + $totalMasuk[0]["totalLembarMasuk"] - $totalKeluar[0]["totalLembarKeluar"];
    return json_encode($result);
  }

  public function getDataOrder($jenis,$tglAwal,$tglAkhir)
  {
    $this->datatables->select("P.no_order, P.kd_order, P.nm_pemesan, DATE_FORMAT(P.tgl_pesan,'%d-%m-%Y') AS tgl_pesan, DATE_FORMAT(P.tgl_estimasi,'%d-%m-%Y') AS tgl_estimasi, P.sts_pesanan, C.nm_perusahaan, C.nm_purchasing");
    $this->datatables->from("pesanan P");
    $this->datatables->join("customer C","P.kd_cust = C.kd_cust","INNER");

    if ($jenis=="CBG") {
      $this->datatables->where("P.deleted='FALSE' and P.tgl_pesan BETWEEN '$tglAwal' and '$tglAkhir'and P.approve_cabang = 'TRUE'");
    }else{
      $this->datatables->where("P.jns_order ='$jenis' and P.deleted='FALSE' and P.tgl_pesan BETWEEN '$tglAwal' and '$tglAkhir' and P.approve_cabang = 'FALSE'");
    }
    return $this->datatables->generate();
  }

  public function selectFakturPesanan($param){
    $arrFakturPesanan = $this->db->query("SELECT P.no_order,P.proof,DATE_FORMAT(P.tgl_pesan,'%d-%M-%Y') AS tgl_pesan,
                                                 DATE_FORMAT(P.tgl_estimasi,'%d-%M-%Y') AS tgl_estimasi, P.nm_pemesan,
                                                 P.no_po,P.note,P.foto_1,P.foto_2,P.expedisi,P.payment_method,P.expedisi,
                                                 IF(P.pajak='TRUE','P','N') pajak,P.jns_order,P.ket_proof, P.mata_uang, P.sales,
                                                 P.dp,C.alamat,C.tlp_kantor,C.nm_perusahaan,U.username,U.ttd
                                          FROM pesanan P
                                          INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                          INNER JOIN users U ON P.id_user = U.id_user
                                          WHERE P.no_order = '$param' AND P.deleted='FALSE'");
    return $arrFakturPesanan->result_array();
  }

  public function selectFakturPesananDetail($param){
    $arrFakturPesananDetail = $this->db->query("SELECT FORMAT(PD.jumlah,1) AS jumlah,PD.satuan,
                                                       GH.ukuran,PD.merek,PD.harga,GH.merek AS merekProduk,
                                                       GH.warna_plastik,PD.warna_cetak,PD.sm,PD.dll,PD.cn,
                                                       PD.potongan, PD.diskon,
                                                       CONCAT(CONVERT(FORMAT(PD.omset_kg,2) USING utf8),'=',CONVERT(FORMAT(PD.omset_lembar,2) USING utf8)) AS omset
                                                FROM pesanan_detail PD
                                                LEFT JOIN gudang_hasil GH ON PD.kd_gd_hasil = GH.kd_gd_hasil
                                                LEFT JOIN gudang_bahan GB ON PD.kd_gd_bahan = GB.kd_gd_bahan
                                                WHERE PD.no_order = '$param' AND PD.deleted='FALSE'");
    return $arrFakturPesananDetail->result_array();
  }

  public function selectLihatPesananDetails($param){
    $this->datatables->select("DP.id_dp, FORMAT(DP.jumlah,0) AS jumlah, DP.satuan,
                               DP.mata_uang,DP.satuan,FORMAT((DP.jumlah - DP.jumlah_kirim),0) AS sisa,
                               FORMAT(DP.harga,0) AS harga, DP.merek, DP.mata_uang,
                               GH.ukuran,GH.warna_plastik,
                               DP.warna_cetak, DP.sm, DP.dll, DP.kd_hrg,DP.sts_pesanan,DP.sts_kirim");
    $this->datatables->from("pesanan_detail DP");
    $this->datatables->where("(DP.kd_gd_hasil = GH.kd_gd_hasil OR
                              DP.kd_gd_bahan = DP.kd_gd_bahan) AND
                              DP.no_order = '$param' AND
                              DP.deleted = 'FALSE'");
    $this->datatables->join("gudang_hasil GH","DP.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","DP.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    return $this->datatables->generate();
  }

  public function selectLihatPesanan($param){
    $arrPesananEdit = $this->db->query("SELECT P.no_order,P.kd_order,P.kd_cust,P.no_po,
                                               P.nm_pemesan,DATE_FORMAT(P.tgl_pesan,'%d-%M-%Y') AS tgl_pesan,
                                               DATE_FORMAT(P.tgl_estimasi,'%d-%M-%Y') AS tgl_estimasi,P.payment_method,
                                               P.expedisi,P.pajak,P.jns_order,P.dp,P.mata_uang,P.note,DATE_FORMAT(P.diperbarui,'%d-%M-%Y %H:%i:%s') AS diperbarui,
                                               P.foto_1,P.foto_2,P.proof,P.ket_proof,
                                               C.nm_perusahaan,C.nm_owner,C.nm_purchasing,U.username
                                        FROM pesanan P
                                        INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                        INNER JOIN users U ON P.id_user = U.id_user
                                        WHERE P.no_order = '$param' AND P.deleted='FALSE'");
    return $arrPesananEdit->result_array();
  }

  //============SELECT METHOD (FINISH)============//

  //============INSERT METHOD (START)============//

  //============INSERT METHOD (FINISH)============//

  //============UPDATE METHOD (START)============//

  //============UPDATE METHOD (FINISH)============//

  //============DELETE METHOD (START)============//

  //============DELETE METHOD (FINISH)============//
}
?>
