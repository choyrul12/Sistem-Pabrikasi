<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Accounting_Model extends CI_Model{
  //============SELECT METHOD (START)============//
  public function selectHasilExtruder($param){
    $Q = "SELECT SUM(jumlah_selesai) AS total,
                 SUM(roll_pipa) AS totalRoll,
                 kd_gd_roll, merek, panjang, tgl_jadi,
                 GROUP_CONCAT(warna_plastik) AS warnaPlastik,
                 GROUP_CONCAT(DATE_FORMAT(tgl_jadi, '%d %M %Y')) AS tgl_kirim,
                 GROUP_CONCAT(jumlah_selesai) AS jumlahSelesai,
                 GROUP_CONCAT(roll_pipa) AS rollPipa,
                 GROUP_CONCAT(jenis_roll) AS jenisRoll,
                 GROUP_CONCAT(shift) AS shift
                 FROM transaksi_hasil_extruder
                 WHERE tgl_jadi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
                 AND status_transaksi='TRUE'
                 GROUP BY kd_gd_roll
                 ORDER BY hasil_ukuran, merek, warna_plastik ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectPengeluaranGudangRollKePotong($param){
    $Q = "SELECT THP.tgl_rencana, RC.ukuran, RC.warna_plastik, RC.merek, RC.jns_permintaan,
                 (TPHP.berat_pengambilan_bagian + TPHP.berat_pengambilan_gudang + TPHP.berat_sisa_semalam) AS totalBeratPengambilan,
                 (TPHP.bobin_pengambilan_bagian + TPHP.bobin_pengambilan_gudang + TPHP.bobin_sisa_semalam) AS totalBobinPengambilan,
                 (TPHP.payung_pengambilan_bagian + TPHP.payung_pengambilan_gudang + TPHP.payung_sisa_semalam) AS totalPayungPengambilan,
                 (TPHP.payung_kuning_pengambilan_bagian + TPHP.payung_kuning_pengambilan_gudang + TPHP.payung_kuning_sisa_semalam) AS totalPayungKuningPengambilan
          FROM transaksi_pengambilan_hasil_potong TPHP
          INNER JOIN transaksi_hasil_potong THP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          WHERE THP.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND TPHP.deleted='FALSE'
          AND THP.deleted='FALSE'
          AND TSHP.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND RC.jns_permintaan='$param[jnsPermintaan]'
          GROUP BY SUBSTRING_INDEX(RC.ukuran,'x',1), RC.warna_plastik, RC.merek
          ORDER BY RC.tgl_rencana ASC, RC.merek ASC, SUBSTRING_INDEX(RC.ukuran,'x',1) ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectPengembalianPotongKeGudangRoll($param){
    $Q = "SELECT THP.tgl_rencana, RC.ukuran, RC.warna_plastik, RC.merek, RC.jns_permintaan,
                 (TPHP.berat_sisa_hari_ini) AS totalBeratSisa,
                 (TPHP.bobin_sisa_hari_ini) AS totalBobinSisa,
                 (TPHP.payung_sisa_hari_ini) AS totalPayungSisa,
                 (TPHP.payung_kuning_sisa_hari_ini) AS totalPayungKuningSisa
          FROM transaksi_pengambilan_hasil_potong TPHP
          INNER JOIN transaksi_hasil_potong THP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          WHERE THP.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND TPHP.deleted='FALSE'
          AND THP.deleted='FALSE'
          AND TSHP.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND RC.jns_permintaan='$param[jnsPermintaan]'
          GROUP BY SUBSTRING_INDEX(RC.ukuran,'x',1), RC.warna_plastik, RC.merek
          ORDER BY RC.tgl_rencana ASC, RC.merek ASC, SUBSTRING_INDEX(RC.ukuran,'x',1) ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListRollPolosKeCetak($param){
    $Q = "SELECT THC.tgl_transaksi, GR.ukuran, GR.jns_permintaan, GR.merek, GR.warna_plastik,
                 (TDHC.jumlah_berat_pengambilan_extruder + TDHC.jumlah_berat_pengambilan) AS totalBeratPengambilan,
                 (TDHC.jumlah_bobin_pengambilan_extruder + TDHC.jumlah_bobin_pengambilan) AS totalBobinPengambilan,
                 (TDHC.jumlah_payung_pengambilan_extruder + TDHC.jumlah_payung_pengambilan) AS totalPayungPengambilan,
                 (TDHC.jumlah_payung_kuning_pengambilan_extruder + TDHC.jumlah_payung_kuning_pengambilan) AS totalPayungKuningPengambilan
          FROM transaksi_detail_hasil_cetak TDHC
          INNER JOIN transaksi_hasil_cetak THC ON TDHC.kd_hasil_cetak = THC.kd_hasil_cetak
          INNER JOIN gudang_roll GR ON TDHC.kd_gd_roll_polos = GR.kd_gd_roll
          WHERE GR.deleted='FALSE'
          AND TDHC.deleted='FALSE'
          AND THC.deleted='FALSE'
          AND THC.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListRollPolosKeRollCetak($param){
    $Q = "SELECT THC.kd_gd_roll, THC.tgl_transaksi, RC.ukuran, RC.merek, RC.warna_plastik,
                 THC.jumlah_selesai, THC.bobin, THC.payung, THC.payung_kuning
          FROM transaksi_hasil_cetak THC
          INNER JOIN rencana_cetak RC ON THC.kd_cetak = RC.kd_cetak
          WHERE THC.sts_transaksi='FINISH'
          AND THC.deleted='FALSE'
          AND RC.deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListHistoryBarangHasil($param){
    $Q = "SELECT kd_gd_hasil, customer, merek, ukuran, warna,
                 GROUP_CONCAT(jumlah_berat) AS arrJumlahBerat,
                 GROUP_CONCAT(jumlah_lembar) AS arrJumlahLembar,
                 GROUP_CONCAT(DATE_FORMAT(tgl_transaksi,'%d %M %Y')) AS arrTglTransaksi,
                 SUM(jumlah_berat) totalJumlahBerat,
                 SUM(jumlah_lembar) AS totalJumlahLembar
          FROM transaksi_gudang_hasil
          WHERE deleted='FALSE'
          AND sts_barang='$param[stsBarang]'
          AND tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND status_history='MASUK'
          AND status_transaksi='FINISH'
          AND keterangan_history IN('MASUK DARI POTONG','MASUK DARI SABLON')
          AND deleted='FALSE'
          GROUP BY kd_gd_hasil
          ORDER BY tgl_transaksi ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListHistoryPengeluaranBarangStandard($param){
    $Q = "SELECT kd_gd_hasil, customer, merek, ukuran, warna,
                 GROUP_CONCAT(jumlah_berat) AS arrJumlahBerat,
                 GROUP_CONCAT(jumlah_lembar) AS arrJumlahLembar,
                 GROUP_CONCAT(DATE_FORMAT(tgl_transaksi,'%d %M %Y')) AS arrTglTransaksi,
                 SUM(jumlah_berat) totalJumlahBerat,
                 SUM(jumlah_lembar) AS totalJumlahLembar
          FROM transaksi_gudang_hasil
          WHERE deleted='FALSE'
          AND sts_barang='STANDARD'
          AND tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND status_history='KELUAR'
          AND status_transaksi='FINISH'
          AND deleted='FALSE'
          GROUP BY kd_gd_hasil
          ORDER BY tgl_transaksi ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListHistoryJobPotong($param){
    $Q = "SELECT GROUP_CONCAT(THP.tgl_jadi) AS arrTglJadi,
                 GROUP_CONCAT(RC.customer) AS arrCustomer,
                 RC.ukuran, RC.warna_plastik, RC.merek,
                 GROUP_CONCAT(TSHP.jumlah_lembar) AS arrJumlahLembar,
                 THP.hasil_berat_kotor, THP.hasil_berat_bersih,
                 (TPHP.berat_pengambilan_bagian + TPHP.berat_pengambilan_gudang + TPHP.berat_sisa_semalam) AS beratPengambilan,
                 (TPHP.bobin_pengambilan_bagian + TPHP.bobin_pengambilan_gudang + TPHP.bobin_sisa_semalam) AS bobinPengambilan,
                 (TPHP.payung_pengambilan_bagian + TPHP.payung_pengambilan_gudang + TPHP.payung_sisa_semalam) AS payungPengambilan,
                 (TPHP.payung_kuning_pengambilan_bagian + TPHP.payung_kuning_pengambilan_gudang + TPHP.payung_kuning_sisa_semalam) AS payungKuningPengambilan,
                 TPHP.berat_sisa_hari_ini, TPHP.bobin_sisa_hari_ini, TPHP.payung_sisa_hari_ini,
                 TPHP.payung_kuning_sisa_hari_ini, THP.jumlah_apal_global,
                 THP.jumlah_roll_pipa, THP.plusminus
          FROM transaksi_sub_hasil_potong TSHP
          INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN transaksi_pengambilan_hasil_potong TPHP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          WHERE THP.tgl_jadi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND RC.deleted = 'FALSE'
          AND THP.deleted = 'FALSE'
          AND TSHP.deleted = 'FALSE'
          AND TPHP.deleted = 'FALSE'
          AND THP.status_transaksi = 'FINISH'
          GROUP BY SUBSTRING_INDEX(RC.ukuran,'x',1), RC.warna_plastik, RC.merek
          ORDER BY THP.tgl_jadi ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListHistoryJobCetak($param){
    $Q = "SELECT RC.customer, RC.merek, RC.ukuran, RC.warna_plastik,
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
    $saldoAwal = $this->db->query("SELECT GB.nm_barang, GB.warna, (
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
                                SUM(IF(TDSP.sts_history='KELUAR',TDSP.jumlah,0)) AS total_keluar_per_periode
                                FROM transaksi_detail_spare_part TDSP
                                INNER JOIN spare_part SP ON TDSP.kd_spare_part = SP.kd_spare_part
                                WHERE TDSP.tgl_transaksi BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                AND TDSP.deleted='FALSE'
                                AND TDSP.sts_transaksi = 'FINISH'
                                GROUP BY TDSP.kd_spare_part")->result_array();
    return json_encode($saldoAwal);
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
