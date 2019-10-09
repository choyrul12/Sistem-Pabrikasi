<?php
class Locking_Model extends CI_Model{
  #=========================Select Function (Start)=========================#
  public function selectListGudangHasil($param){
    $Q = "SELECT TGH.kd_gd_hasil, TGH.customer, TGH.merek, TGH.ukuran, TGH.warna,
                 GROUP_CONCAT(TGH.tgl_transaksi SEPARATOR '|') AS tgl_transaksi,
                 GROUP_CONCAT(TGH.jumlah_berat SEPARATOR '|') AS jumlah_berat,
                 GROUP_CONCAT(TGH.jumlah_lembar SEPARATOR '|') AS jumlah_lembar,
                 SUM(TGH.jumlah_berat) AS total_jumlah_berat,
                 SUM(TGH.jumlah_lembar) AS total_jumlah_lembar
          FROM transaksi_gudang_hasil TGH
          INNER JOIN gudang_hasil GH ON TGH.kd_gd_hasil = GH.kd_gd_hasil
          WHERE GH.deleted='FALSE'
          AND TGH.deleted='FALSE'
          AND TGH.sts_barang='$param[stsBarang]'
          AND TGH.status_history='MASUK'
          AND TGH.status_transaksi='FINISH'
          AND TGH.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          GROUP BY TGH.kd_gd_hasil
          ORDER BY TGH.tgl_transaksi ASC";

    $Q2 = "SELECT COUNT(TGH.id_permintaan_jadi) AS CounterLock
          FROM transaksi_gudang_hasil TGH
          INNER JOIN gudang_hasil GH ON TGH.kd_gd_hasil = GH.kd_gd_hasil
          WHERE GH.deleted='FALSE'
          AND TGH.deleted='FALSE'
          AND TGH.sts_barang='$param[stsBarang]'
          AND TGH.status_history='MASUK'
          AND TGH.status_transaksi='FINISH'
          AND TGH.status_lock = 'FALSE'
          AND TGH.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          GROUP BY TGH.kd_gd_hasil
          ORDER BY TGH.tgl_transaksi ASC";

    $Q3 = "SELECT COUNT(TGH.id_permintaan_jadi) AS CounterTotalItem
          FROM transaksi_gudang_hasil TGH
          INNER JOIN gudang_hasil GH ON TGH.kd_gd_hasil = GH.kd_gd_hasil
          WHERE GH.deleted='FALSE'
          AND TGH.deleted='FALSE'
          AND TGH.sts_barang='$param[stsBarang]'
          AND TGH.status_history='MASUK'
          AND TGH.status_transaksi='FINISH'
          AND TGH.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          GROUP BY TGH.kd_gd_hasil
          ORDER BY TGH.tgl_transaksi ASC";
    $result = $this->db->query($Q)->result_array();
    $result2 = $this->db->query($Q2)->result_array();
    $result3 = $this->db->query($Q3)->result_array();
    $data = array("TransaksiGudangHasil" => $result,
                  "CounterLock" => $result2,
                  "CounterTotalItem" => $result3);

    return json_encode($data);
  }

  public function selectListTransaksiGudangRollPolos($param){
    $Q = "SELECT TGR.tgl_transaksi, TGR.berat, TGR.bobin, TGR.payung, TGR.payung_kuning,
                 TGR.keterangan_history, TGR.keterangan_transaksi,
                 CONCAT(GR.ukuran, ' ',GR.merek, ' ',GR.warna_plastik) AS barang
          FROM transaksi_gudang_roll TGR
          INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
          WHERE TGR.deleted='FALSE'
          AND GR.deleted='FALSE'
          AND TGR.jns_permintaan='POLOS'
          AND TGR.keterangan_transaksi NOT IN('MASUK DARI CETAK')
          AND TGR.keterangan_history NOT IN('HASIL EXTRUDER')
          AND TGR.jns_permintaan = 'POLOS'
          AND TGR.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'";

    $Q2 = "SELECT TGR.tgl_transaksi, TGR.berat, TGR.bobin, TGR.payung, TGR.payung_kuning,
                 TGR.keterangan_history, TGR.keterangan_transaksi, TGR.shift,
                 CONCAT(GR.ukuran, ' ',GR.merek, ' ',GR.warna_plastik) AS barang
          FROM transaksi_gudang_roll TGR
          INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
          WHERE TGR.deleted='FALSE'
          AND TGR.jns_permintaan='POLOS'
          AND GR.deleted='FALSE'
          AND TGR.keterangan_history IN('HASIL EXTRUDER')
          AND TGR.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'";

     $Q3 = "SELECT COUNT(id) AS CounterLock FROM transaksi_gudang_roll TGR
            INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
            WHERE TGR.deleted='FALSE'
            AND TGR.jns_permintaan='POLOS'
            AND GR.deleted='FALSE'
            AND TGR.status_lock = 'TRUE'
            AND TGR.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'";

     $Q4 = "SELECT COUNT(id) AS CounterTotalItem FROM transaksi_gudang_roll TGR
            INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
            WHERE TGR.deleted='FALSE'
            AND TGR.jns_permintaan='POLOS'
            AND GR.deleted='FALSE'
            AND TGR.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'";

    $result = $this->db->query($Q)->result_array();
    $result2 = $this->db->query($Q2)->result_array();
    $result3 = $this->db->query($Q3)->result_array();
    $result4 = $this->db->query($Q4)->result_array();

    $array = array("TransaksiGudangRoll" => $result,
                   "TransaksiHasilExtruder" => $result2,
                   "CounterLock" => $result3[0]["CounterLock"],
                   "CounterTotalItem" => $result4[0]["CounterTotalItem"]);
    return json_encode($array);
  }

  public function selectListTransaksiGudangRollCetak($param){
    $Q = "SELECT TGR.tgl_transaksi, TGR.berat, TGR.bobin, TGR.payung, TGR.payung_kuning,
                 TGR.keterangan_history, TGR.keterangan_transaksi,
                 CONCAT(GR.ukuran, ' ',GR.merek, ' ',GR.warna_plastik) AS barang
          FROM transaksi_gudang_roll TGR
          INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
          WHERE TGR.deleted='FALSE'
          AND GR.deleted='FALSE'
          AND TGR.keterangan_transaksi NOT IN('MASUK DARI CETAK')
          AND TGR.keterangan_history NOT IN('HASIL EXTRUDER')
          AND TGR.jns_permintaan = 'CETAK'
          AND TGR.bagian = 'POTONG'
          AND TGR.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'";

    $Q2 = "SELECT TGR.tgl_transaksi, TGR.berat, TGR.bobin, TGR.payung, TGR.payung_kuning,
                 TGR.keterangan_history, TGR.keterangan_transaksi,
                 CONCAT(GR.ukuran, ' ',GR.merek, ' ',GR.warna_plastik) AS barang
          FROM transaksi_gudang_roll TGR
          INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
          WHERE TGR.deleted='FALSE'
          AND GR.deleted='FALSE'
          AND TGR.keterangan_history IN('HASIL EXTRUDER')
          AND TGR.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'";

    $Q3 = "SELECT TGR.tgl_transaksi, TGR.berat, TGR.bobin, TGR.payung, TGR.payung_kuning,
                 TGR.keterangan_history, TGR.keterangan_transaksi,
                 CONCAT(GR.ukuran, ' ',GR.merek, ' ',GR.warna_plastik) AS barang
          FROM transaksi_gudang_roll TGR
          INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
          WHERE TGR.deleted='FALSE'
          AND GR.deleted='FALSE'
          AND TGR.jns_permintaan = 'CETAK'
          AND TGR.bagian = 'CETAK'
          AND TGR.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'";

    $result = $this->db->query($Q)->result_array();
    $result2 = $this->db->query($Q2)->result_array();
    $result3 = $this->db->query($Q3)->result_array();

    $array = array("TransaksiPotong" => $result,
                   "TransaksiHasilExtruder" => $result2,
                   "TransaksiCetak" => $result3);
    return json_encode($array);
  }
  #=========================Select Function (Finish)=========================#

  #=========================Update Function (Start)=========================#
  public function updateTransaksiGudangRoll($param){
    $this->db->trans_begin();
    $this->db->query("UPDATE transaksi_gudang_roll SET status_lock='$param[statusLock]'
                      WHERE jns_permintaan='$param[jnsPermintaan]'
                      AND tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'");
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateTransaksiGudangHasil($param){
    $this->db->trans_begin();
    $this->db->query("UPDATE transaksi_gudang_hasil SET status_lock='$param[statusLock]'
                      WHERE sts_barang='$param[stsBarang]'
                      AND tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'");
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }
  #=========================Update Function (Finish)=========================#
}
?>
