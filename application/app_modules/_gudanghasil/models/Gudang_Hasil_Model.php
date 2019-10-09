<?php
class Gudang_Hasil_Model extends CI_Model{
  #=========================Get Code Function (Start)=========================#
  public function generateGudangHasilCode($param){
    switch($param["jns_brg"]) {
      case "CAMPUR"   : $prefix = "HSLC";
                        $flags = TRUE;
                        break;
      case "STANDARD" : $prefix = "HSLS";
                        $flags = TRUE;
                        break;
      case "KANTONG"  : $prefix = "HSLK";
                        $flags = TRUE;
                        break;
      case "SABLON"   : if($param["jns_permintaan"] == "POLOS"){
                          $prefix = "HSLP";
                          $flags = TRUE;
                        }else{
                          $prefix = "HSSB";
                          $flags = TRUE;
                        }
                        break;

      default         : $flags=FALSE;
                        break;
    }
    if($flags){
      $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_gd_hasil,4)) AS kode FROM gudang_hasil");
      foreach ($maxCode->result() as $arrMaxCode) {
        if($arrMaxCode->kode == NULL){
          $tempCode = "0000";
        }
        $tempCode = "0000".(intval($arrMaxCode->kode)+1);
        $fixCode = $prefix.date("ymd").substr($tempCode,(strlen($tempCode)-4));
      }
      return $fixCode;
    }else{

    }
  }

  public function generateGudangBahanCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_gd_bahan,3)) AS kode FROM gudang_bahan
                                 WHERE SUBSTRING(kd_gd_bahan,4,6) = DATE_FORMAT(NOW(),'%y%m%d')");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "00";
      }
      $tempCode = "00".(intval($arrMaxCode->kode)+1);
      $fixCode = "BHN".date("ymd").substr($tempCode,(strlen($tempCode)-3));
    }
    return $fixCode;
  }

  public function generateKodePermintaan(){
    $idUser = $this->session->userdata("fabricationIdUser");
    $idUserLen = strlen($idUser);
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_permintaan_barang,3)) AS kode FROM transaksi_permintaan_barang
                                 WHERE SUBSTRING(kd_permintaan_barang,3,4) = DATE_FORMAT(NOW(),'%y%m')
                                 AND SUBSTRING(kd_permintaan_barang,7,$idUserLen)");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "00";
      }
      $tempCode = "00".(intval($arrMaxCode->kode)+1);
      $fixCode = "PR".date("ym").$idUser.substr($tempCode,(strlen($tempCode)-3));
    }
    return $fixCode;
  }
  #=========================Get Code Function (Finish)=========================#

  #=========================Insert Function (Start)=========================#
  public function insertGudangHasil($param){
    $this->db->trans_begin();
    $this->db->insert("gudang_hasil",$param);
    if($param["jns_permintaan"]=="CETAK" && $param["jns_brg"]=="SABLON"){
      $this->db->query("INSERT INTO transaksi_gudang_hasil (kd_gd_hasil,kd_gd_hasil_secondary,id_user,ukuran,jumlah_berat,jumlah_lembar,warna,customer,tgl_transaksi,merek,
                                                            jns_permintaan,sts_barang,sts_approve,status_history,keterangan_history,keterangan,status_lock,status_transaksi)
                        VALUES ('$param[kd_gd_hasil]','$param[kd_gd_hasil]','$param[id_user]','$param[ukuran]','$param[stok_berat]','$param[stok_lembar]','$param[warna]','GUDANG HASIL','$param[tgl_buat]','$param[merek]','$param[jns_permintaan]',
                                '$param[jns_brg]','TRUE','MASUK','DATA AWAL','$param[keterangan]','TRUE','FINISH')");
    }else{
      $this->db->query("INSERT INTO transaksi_gudang_hasil (kd_gd_hasil,id_user,ukuran,jumlah_berat,jumlah_lembar,warna,customer,tgl_transaksi,merek,
                                                            jns_permintaan,sts_barang,sts_approve,status_history,status_transaksi,keterangan_history,keterangan,status_lock)
                        VALUES ('$param[kd_gd_hasil]','$param[id_user]','$param[ukuran]','$param[stok_berat]','$param[stok_lembar]','$param[warna_plastik]','GUDANG HASIL','$param[tgl_buat]','$param[merek]','$param[jns_permintaan]',
                                '$param[jns_brg]','TRUE','MASUK','FINISH','DATA AWAL','$param[keterangan]','TRUE')");
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertAddPengirimanBaru($param){
    $this->db->trans_begin();
    if(empty($param['kdGdHasil'])){
      $this->db->query("INSERT INTO transaksi_detail_pengiriman (kd_gd_bahan,id_dp,id_user,customer,tgl_pengiriman,jumlah_pesanan,jumlah_kg,jumlah_lembar,warna,keterangan,sts_pengiriman,jenis_jumlah,jumlah_terkirim)
                        VALUES ('$param[kdGdBahan]','$param[idDp]','$param[idUser]','$param[customer]','$param[tglPengiriman]','$param[jumlahPesanan]','$param[jumlahKg]','$param[jumlahLembar]','$param[warna]','$param[keterangan]',
                                '$param[statusPengiriman]','$param[jenisJumlah]','$param[jumlahDikirim]')");
    }else{
      $this->db->query("INSERT INTO transaksi_detail_pengiriman (kd_gd_hasil,id_dp,id_user,customer,tgl_pengiriman,jumlah_pesanan,jumlah_kg,jumlah_lembar,warna,keterangan,sts_pengiriman,jenis_jumlah,jumlah_terkirim)
                        VALUES ('$param[kdGdHasil]','$param[idDp]','$param[idUser]','$param[customer]','$param[tglPengiriman]','$param[jumlahPesanan]','$param[jumlahKg]','$param[jumlahLembar]','$param[warna]','$param[keterangan]',
                                '$param[statusPengiriman]','$param[jenisJumlah]','$param[jumlahDikirim]')");
    }
    // $arrResultIdDp = $this->db->query("SELECT id_detail_pengiriman FROM transaksi_detail_pengiriman WHERE id_dp = '$param[idDp]'")->result_array();
    // $this->db->query("INSERT INTO transaksi_gudang_hasil (kd_gd_hasil,kd_gd_hasil_secondary,id_dp,id_detail_pengiriman,ukuran,jumlah_berat,jumlah_lembar,warna,customer,tgl_transaksi,merek,jns_permintaan,sts_barang,keterangan_history,keterangan_barang,keterangan)
    //                   VALUES ('$param[kdGdHasil]','$param[kdGdHasilSablon]','$param[idDP]','$arrResultIdDp[0][id_detail_pengiriman]','$param[ukuran]','$param[jumlahKg]','$param[jumlahLembar]','$param[warna]','$param[customer]','$param[tglPengiriman]','$param[merek]','$param[jenisPermintaan]',
    //                           '$param[statusPengiriman]','$param[keteranganHistory]','$param[keteranganBarang]','$param[keterangan]')");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertAddPengirimanGudang($param){
    /*Secara Konsep Pengiriman Gudang Sama Seperti Pengiriman Baru Pada Order M_Data_Order_Marketing
      Hanya Perbedaan Terletak Pada ID Detail Pesanan */

    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(status_lock) AS count_lock FROM transaksi_gudang_hasil
                                   WHERE YEAR(tgl_transaksi)=YEAR('$param[tgl_pengiriman]')
                                   AND MONTH(tgl_transaksi)=MONTH('$param[tgl_pengiriman]')
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["count_lock"] > 0){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->insert("transaksi_detail_pengiriman",$param);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return FALSE;
      }else{
        $this->db->trans_commit();
        return TRUE;
      }
    }
  }

  public function insertTransaksiGudangHasil_Pengiriman($param){
    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(status_lock) AS count_lock FROM transaksi_gudang_hasil
                                   WHERE YEAR(tgl_transaksi)=YEAR('$param[tgl_transaksi]')
                                   AND MONTH(tgl_transaksi)=MONTH('$param[tgl_transaksi]')
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["count_lock"] > 0){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->insert("transaksi_gudang_hasil",array_diff_key($param,array_flip(array("jumlah_terkirim","no_order"))));
      $this->db->query("UPDATE gudang_hasil
                        SET stok_berat = stok_berat - $param[jumlah_berat],
                            stok_lembar = stok_lembar - $param[jumlah_lembar]
                        WHERE kd_gd_hasil='$param[kd_gd_hasil]'");

      $this->db->query("UPDATE pesanan_detail
                        SET jumlah_kirim = jumlah_kirim + $param[jumlah_terkirim]
                        WHERE id_dp = '$param[id_dp]'");

      $this->db->query("UPDATE pesanan_detail
                        SET sts_pesanan = 'PACKING'
                        WHERE id_dp = '$param[id_dp]' AND jumlah_kirim >= jumlah");
      $counterProgress = $this->db->query("SELECT COUNT(id_dp) AS counter
                                          FROM pesanan_detail
                                          WHERE deleted='FALSE'
                                          AND sts_pesanan IN('PROGRESS','OPEN')
                                          AND no_order='$param[no_order]'")->result_array();
      $counterItemPesanan = $this->db->query("SELECT COUNT(id_dp) AS counter
                                              FROM pesanan_detail
                                              WHERE deleted='FALSE'
                                              AND no_order='$param[no_order]'")->result_array();
      if($counterProgress[0]["counter"] <= 0){
        $this->db->query("UPDATE pesanan SET sts_pesanan='PACKING' WHERE no_order='$param[no_order]'");
      }
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return FALSE;
      }else{
        $this->db->trans_commit();
        return TRUE;
      }
    }
  }

  public function insertTransaksiGudangBahan_Pengiriman($param){
    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(status_lock) AS count_lock FROM transaksi_gudang_bahan
                                   WHERE YEAR(tgl_permintaan)=YEAR('$param[tgl_permintaan]')
                                   AND MONTH(tgl_permintaan)=MONTH('$param[tgl_permintaan]')
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["count_lock"] > 0){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->insert("transaksi_gudang_bahan",array_diff_key($param,array_flip(array("jumlah_terkirim","id_dp","no_order"))));
      $this->db->query("UPDATE gudang_bahan
                        SET stok = stok - $param[jumlah_permintaan]
                        WHERE kd_gd_bahan='$param[kd_gd_bahan]'");

      $this->db->query("UPDATE pesanan_detail
                        SET jumlah_kirim = jumlah_kirim + $param[jumlah_terkirim]
                        WHERE id_dp = '$param[id_dp]'");

      $this->db->query("UPDATE pesanan_detail
                        SET sts_pesanan = 'PACKING'
                        WHERE id_dp = '$param[id_dp]' AND jumlah_kirim >= jumlah");

      $counterPacking = $this->db->query("SELECT COUNT(id_dp) AS counter
                                          FROM pesanan_detail
                                          WHERE deleted='FALSE'
                                          AND sts_pesanan='PACKING'
                                          AND no_order='$param[no_order]'")->result_array();
      $counterItemPesanan = $this->db->query("SELECT COUNT(id_dp) AS counter
                                              FROM pesanan_detail
                                              WHERE deleted='FALSE'
                                              AND no_order='$param[no_order]'")->result_array();
      if($counterPacking[0]["counter"] == $counterItemPesanan[0]["counter"]){
        $this->db->query("UPDATE pesanan SET sts_pesanan='PACKING' WHERE no_order='$param[no_order]'");
      }
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return FALSE;
      }else{
        $this->db->trans_commit();
        return TRUE;
      }
    }
  }

  public function insertTransaksiGudangHasil_PengirimanGudang($param){
    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(status_lock) AS count_lock FROM transaksi_gudang_hasil
                                   WHERE YEAR(tgl_transaksi)=YEAR('$param[tgl_transaksi]')
                                   AND MONTH(tgl_transaksi)=MONTH('$param[tgl_transaksi]')
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["count_lock"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert("transaksi_gudang_hasil",$param);
      $this->db->where("id_detail_pengiriman",$param["id_detail_pengiriman"]);
      $this->db->update("transaksi_detail_pengiriman",array("status"=>"FINISH"));
      $this->db->query("UPDATE gudang_hasil
                        SET stok_berat = stok_berat - $param[jumlah_berat],
                            stok_lembar = stok_lembar - $param[jumlah_lembar]
                        WHERE kd_gd_hasil='$param[kd_gd_hasil]'");
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function insertTransaksiPengambilanSablon($param){
    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(status_lock) AS count_lock FROM transaksi_pengambilan_sablon
                                   WHERE YEAR(tgl_pengambilan)=YEAR('$param[tgl_pengambilan]')
                                   AND MONTH(tgl_pengambilan)=MONTH('$param[tgl_pengambilan]')
                                   AND status_lock='TRUE'")->result_array();
    $checkLock2 = $this->db->query("SELECT COUNT(status_lock) AS count_lock FROM transaksi_gudang_hasil
                                    WHERE YEAR(tgl_transaksi)=YEAR('$param[tgl_pengambilan]')
                                    AND MONTH(tgl_transaksi)=MONTH('$param[tgl_pengambilan]')
                                    AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["count_lock"] > 0 || $checkLock2[0]["count_lock"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert("transaksi_pengambilan_sablon",$param);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function insertTransaksiGudangHasil_PengambilanSablon($param){
    $this->db->trans_begin();
    #=======Insert Data Ke Tabel Transaksi Gudang Hasil Dari Tabel Transaksi Pengambilan Sablon (Start)=======#
    $this->db->insert("transaksi_gudang_hasil",array_diff_key($param,array_flip(array("id_pengambilan_sablon"))));
    $this->db->set("stok_lembar","stok_lembar - ".$param["jumlah_lembar"],FALSE);
    $this->db->set("stok_berat","stok_berat - ".$param["jumlah_berat"],FALSE);
    $this->db->where("kd_gd_hasil",$param["kd_gd_hasil_secondary"]);
    $this->db->update("gudang_hasil");
    #=======Insert Data Ke Tabel Transaksi Gudang Hasil Dari Tabel Transaksi Pengambilan Sablon (Finish)=======#

    #=======Update Status Pengambilan Menjadi True Pada Tabel Transaksi Pengambilan Sablon Saat Data Telah Masuk Ke Tabel Transaksi Gudang Hasil (Start)=======#
    $this->db->query("UPDATE transaksi_pengambilan_sablon
                      SET status_pengambilan='TRUE'
                      WHERE id_pengambilan_sablon = '$param[id_pengambilan_sablon]'");
    #=======Update Status Pengambilan Menjadi True Pada Tabel Transaksi Pengambilan Sablon Saat Data Telah Masuk Ke Tabel Transaksi Gudang Hasil (Finish)=======#

    #=======Update Stok Berat Dan Lembar Data Master Setelah Transaksi Di Atas Selesai (Start)=======#
    // $this->db->set("stok_berat","stok_berat - $param[jumlah_berat]",FALSE);
    // $this->db->set("stok_lembar","stok_lembar - $param[jumlah_lembar]",FALSE);
    // $this->db->where("kd_gd_hasil",$param["kd_gd_hasil_secondary"]);
    // $this->db->update("gudang_hasil");
    #=======Update Stok Berat Dan Lembar Data Master Setelah Transaksi Di Atas Selesai (Finish)=======#

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertTransaksiDetailHistoryApal($param){
    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(status_lock) AS count_lock FROM transaksi_detail_history_apal
                                   WHERE YEAR(tgl_transaksi)=YEAR('$param[tgl_transaksi]')
                                   AND MONTH(tgl_transaksi)=MONTH('$param[tgl_transaksi]')
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["count_lock"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert("transaksi_detail_history_apal",$param);
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function insertTransaksiGudangHasil($param){
    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(status_lock) AS count_lock FROM transaksi_gudang_hasil
                                   WHERE YEAR(tgl_transaksi)=YEAR('$param[tgl_transaksi]')
                                   AND MONTH(tgl_transaksi)=MONTH('$param[tgl_transaksi]')
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["count_lock"] > 0){
      $this->db->trans_rollback();
      echo "Lock";
    }else{
      $this->db->insert("transaksi_gudang_hasil",$param);
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function insertGudangBahan($param){
    $this->db->trans_begin();
    $this->db->query("INSERT INTO gudang_bahan (kd_gd_bahan,id_user,kd_accurate,nm_barang,stok,satuan,warna,tgl_masuk,status,jenis)
                      VALUES('$param[kd_gd_bahan]','$param[id_user]','$param[kd_accurate]','$param[nm_barang]','$param[stok]',
                             '$param[satuan]','$param[warna]','$param[tgl_masuk]','$param[status]','$param[jenis]')");
    $this->db->query("INSERT INTO transaksi_gudang_bahan(kd_gd_bahan,id_user,nama,jumlah_permintaan,tgl_permintaan,bagian,`status`,status_history,keterangan_history,status_lock)
                      VALUES ('$param[kd_gd_bahan]','$param[id_user]','$param[nama]','$param[stok]','$param[tgl_masuk]','$param[bagian]',
                              '$param[statusTransaksi]','$param[statusHistory]','$param[keteranganHistory]','TRUE')");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function insertPermintaanBarang($param){
    if(array_key_exists("rowid",$param)){
      unset($param["rowid"]);
    }
    $this->db->trans_begin();
    $checkTransaksi = $this->db->query("SELECT kd_permintaan_barang
                                        FROM transaksi_permintaan_barang
                                        WHERE kd_permintaan_barang='$param[kd_permintaan]'")->num_rows();
    if($checkTransaksi <= 0){
      $this->db->set("kd_permintaan_barang",$param["kd_permintaan"]);
      $this->db->set("id_user",$param["id_user"]);
      $this->db->set("tgl_permintaan",$param["tgl_permintaan"]);
      $this->db->set("bagian",$param["bagian"]);
      $this->db->insert("transaksi_permintaan_barang");
    }

    $this->db->set("kd_permintaan_barang",$param["kd_permintaan"]);
    $this->db->set("kd_gd_bahan",$param["kd_gd_bahan"]);
    $this->db->set("jumlah_permintaan",$param["jumlah_permintaan"]);
    $this->db->set("keterangan",$param["keterangan"]);
    $this->db->insert("transaksi_detail_permintaan_barang");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertTransaksiGudangBahan($param){
    if(array_key_exists("rowid",$param)){
      unset($param["rowid"]);
    }
    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(status_lock) AS count_lock FROM transaksi_gudang_bahan
                                   WHERE YEAR(tgl_permintaan)=YEAR('$param[tgl_permintaan]')
                                   AND MONTH(tgl_permintaan)=MONTH('$param[tgl_permintaan]')
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["count_lock"] > 0){
      return "Lock";
    }else{
      $this->db->insert("transaksi_gudang_bahan",$param);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function insertDataAwalPending($param){
    $this->db->trans_begin();
    // $Q = "SELECT COUNT(TGB.status_lock) AS Counter
    //       FROM transaksi_gudang_bahan TGB
    //       INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
    //       WHERE GB.jenis = '".$param["TGB"]["jenis"]."'
    //       AND TGB.deleted = 'FALSE'
    //       AND TGB.status_lock = 'TRUE'";
    // $checkLock = $this->db->query($Q)->result_array();
    // if($checkLock[0]["Counter"] > 0){
    //   $this->db->trans_rollback();
    //   return "Lock";
    // }else{
      $array = array("jenis");
      $this->db->insert("transaksi_gudang_bahan",array_diff_key($param["TGB"],array_flip($array)));
    // }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function insertDataAwalGudangHasilPending($param){
    $this->db->trans_begin();
    $this->db->insert("transaksi_gudang_hasil",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }
  #=========================Insert Function (Finish)=========================#

  #=========================Select Function (Start)=========================#
  public function selectComboBoxValueHasil($param){
    if(empty($param["jns_permintaan"])){
      $result = $this->db->query("SELECT * FROM gudang_hasil
                                  WHERE jns_brg = '$param[jenis]'
                                  AND deleted='FALSE'
                                  ORDER BY ukuran ASC, merek ASC, warna_plastik ASC
                                  LIMIT 20");
    }else{
      if($param["jns_permintaan"] == "POLOS"){
        $result = $this->db->query("SELECT * FROM gudang_hasil
                                    WHERE (jns_brg = '$param[jenis]'
                                    AND jns_permintaan = '$param[jns_permintaan]')
                                    AND deleted='FALSE' OR (merek IN('klip','kartunama')
                                    AND jns_brg='$param[jenis]')
                                    ORDER BY ukuran ASC, merek ASC, warna_plastik ASC
                                    LIMIT 20");
      }else{
        $result = $this->db->query("SELECT * FROM gudang_hasil
                                    WHERE jns_brg = '$param[jenis]'
                                    AND jns_permintaan = '$param[jns_permintaan]'
                                    AND deleted='FALSE'
                                    ORDER BY ukuran ASC, merek ASC, warna_plastik ASC
                                    LIMIT 20");
      }
    }
    return json_encode($result->result_array());
  }

  public function selectComboBoxValueHasilSearch($param){
    if(empty($param["jns_permintaan"])){
      if(strpos($param["key"],"|") === FALSE){
        $Q = "SELECT * FROM gudang_hasil WHERE jns_brg = '$param[jenis]'
              AND deleted = 'FALSE'
              AND (kd_gd_hasil LIKE '%$param[key]%' OR
                   ukuran LIKE '%$param[key]%' OR
                   merek LIKE '%$param[key]%' OR
                   warna_plastik LIKE '%$param[key]%')
              ORDER BY ukuran ASC, merek ASC, warna_plastik ASC";

      }else{
        $arrKey = explode("|",$param["key"]);
        $Q = "SELECT * FROM gudang_hasil WHERE jns_brg = '$param[jenis]'
              AND deleted = 'FALSE'
              AND ukuran LIKE '%$arrKey[0]%'
              AND merek LIKE '%$arrKey[1]%'
              AND warna_plastik LIKE '%$arrKey[2]%'
              ORDER BY ukuran ASC, merek ASC, warna_plastik ASC";
      }
      $result = $this->db->query($Q);
    }else{
      if(strpos($param["key"],"|") !== FALSE){
        $arrKey = explode("|",$param["key"]);
        $Q = "SELECT * FROM gudang_hasil
              WHERE ((jns_brg = '$param[jenis]'
              AND jns_permintaan = '$param[jns_permintaan]')
              OR (merek IN ('Klip','kartunama','kartu nama') AND jns_brg = '$param[jenis]'))
              AND deleted = 'FALSE'
              AND ukuran LIKE '%$arrKey[0]%'
              AND merek LIKE '%$arrKey[1]%'
              AND warna_plastik LIKE '%$arrKey[2]%'
              ORDER BY ukuran ASC, merek ASC, warna_plastik ASC";
      }else{
        $Q = "SELECT * FROM gudang_hasil
              WHERE ((jns_brg = '$param[jenis]'
              AND jns_permintaan = '$param[jns_permintaan]')
              OR (merek IN ('Klip','kartunama','kartu nama') AND jns_brg = '$param[jenis]'))
              AND deleted = 'FALSE'
              AND (kd_gd_hasil LIKE '%$param[key]%' OR
                   ukuran LIKE '%$param[key]%' OR
                   merek LIKE '%$param[key]%' OR
                   warna_plastik LIKE '%$param[key]%')
              ORDER BY ukuran ASC, merek ASC, warna_plastik ASC";
      }
      $result = $this->db->query($Q);
    }
    return json_encode($result->result_array());
  }

  public function selectGudangHasilCustom($param){
    $result = $this->db->query("SELECT * FROM gudang_hasil
                                WHERE ukuran = '$param[ukuran]'
                                AND warna_plastik = '$param[warna_plastik]'
                                AND jns_permintaan = '$param[jns_permintaan]'
                                AND jns_brg = '$param[jns_brg]'");
    return json_encode($result->result_array());
  }

  public function selectComboBoxValueGudangApal(){
    $this->db->select("kd_gd_apal, jenis, sub_jenis");
    $this->db->from("gudang_apal");
    $this->db->where("deleted=","FALSE");
    $result = $this->db->get()->result_array();
    return json_encode($result);
  }

  public function selectComboBoxValueGudangHasilHd(){
    $this->db->select("kd_gd_hasil, ukuran, merek, warna_plastik, jns_brg, sts_brg, jns_permintaan");
    $this->db->from("gudang_hasil");
    $this->db->where("merek='HD' AND jns_brg = 'CAMPUR' AND deleted=","FALSE");
    $result = $this->db->get()->result_array();
    return json_encode($result);
  }

  public function selectListPengirimanBaruDatatable($key){

    $this->datatables->select("IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan,
                               P.no_order,P.tgl_pesan,P.nm_pemesan,P.kd_order,P.no_po,P.note,
                               GH.ukuran,GH.warna_plastik,PD.satuan,
                               PD.merek,PD.dll,PD.jumlah, PD.jumlah_kirim,PD.keterangan,
                               (PD.jumlah - PD.jumlah_kirim) AS sisa, PD.sm, PD.id_dp");
    $this->datatables->from("pesanan P");
    if (empty($key)) {
      $this->datatables->where("P.sts_pesanan = 'PROGRESS' AND PD.sts_pesanan = 'PROGRESS' AND PD.sts_kirim != 'TERKIRIM'
                              AND P.deleted = 'FALSE' AND PD.deleted = 'FALSE' AND PD.tgl_kirim_gudang IS NOT NULL
                              AND (PD.jumlah - PD.jumlah_kirim) > 0");
    }else{
      $param = explode(" ", $key);
      $counter = count($param);
      for ($i=0; $i < $counter; $i++) {
        $query[] = "(IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) LIKE '%$param[$i]%'
                     OR P.tgl_pesan LIKE '%$param[$i]%'
                     OR P.no_order LIKE '%$param[$i]%'
                     OR P.no_po LIKE '%$param[$i]%'
                     OR P.nm_pemesan LIKE '%$param[$i]%'
                     OR GH.ukuran LIKE '%$param[$i]%'
                     OR PD.merek LIKE '%$param[$i]%'
                     OR GH.warna_plastik LIKE '%$param[$i]%'
                     OR PD.jumlah_kirim LIKE '%$param[$i]%')";
        if ($i < $counter-1) { $query[] .= "AND";};
      }
      $search = implode(" ", $query);
      $this->datatables->where(" $search and P.sts_pesanan = 'PROGRESS'
                                AND PD.sts_pesanan = 'PROGRESS'
                                AND PD.sts_kirim != 'TERKIRIM'
                                AND P.deleted = 'FALSE'
                                AND PD.deleted = 'FALSE'
                                AND PD.tgl_kirim_gudang IS NOT NULL
                                AND (PD.jumlah - PD.jumlah_kirim) > 0");
    }

    $this->datatables->join("customer C","C.kd_cust = P.kd_cust","INNER");
    $this->datatables->join("pesanan_detail PD","PD.no_order = P.no_order","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->db->order_by("P.tgl_pesan","DESC");

    return $this->datatables->generate();
  }

  public function selectListPesananTerkirim($key){
    $this->datatables->select("P.no_order,P.tgl_pesan,
                               IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan,
                               P.nm_pemesan,P.kd_order,P.no_po,P.note,
                               GH.ukuran,GH.warna_plastik,
                               GH.merek,PD.dll,CONCAT(PD.jumlah,' ',PD.satuan) AS jumlah, PD.jumlah_kirim,PD.satuan,
                               GB.nm_barang,GB.warna,
                               (PD.jumlah - PD.jumlah_kirim) AS sisa, PD.sm, PD.id_dp");
    $this->datatables->from("pesanan P");
    if (empty($key)) {
      $this->datatables->where("P.deleted = 'FALSE' AND PD.deleted = 'FALSE' AND PD.tgl_kirim_gudang IS NOT NULL AND PD.jumlah_kirim > 0");
    }else{
      $param = explode(" ", $key);
      $counter = count($param);
      for ($i=0; $i < $counter; $i++) {
        $query[] = "(P.tgl_pesan like '%$param[$i]%'
                     OR IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) like '%$param[$i]%'
                     OR P.no_order like '%$param[$i]%'
                     OR P.no_po like '%$param[$i]%'
                     OR P.kd_order like '%$param[$i]%'
                     OR P.nm_pemesan like '%$param[$i]%'
                     OR GH.ukuran like '%$param[$i]%'
                     OR PD.merek like '%$param[$i]%'
                     OR GH.warna_plastik like '%$param[$i]%'
                     OR PD.jumlah_kirim like '%$param[$i]%'
                     OR PD.jumlah like '%$param[$i]%'
                     OR PD.satuan like '%$param[$i]%') AND";
      }
      $search = implode(" ", $query);

      $this->datatables->where(" $search P.deleted = 'FALSE' AND PD.deleted = 'FALSE' AND PD.tgl_kirim_gudang IS NOT NULL AND PD.jumlah_kirim > 0");
    }
    $this->datatables->join("pesanan_detail PD","PD.no_order = P.no_order","INNER");
    $this->datatables->join("customer C","P.kd_cust = C.kd_cust","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->db->order_by("P.tgl_pesan","DESC");

    return $this->datatables->generate();
  }

  public function selectListPesananBelumTerkirim(){
    $this->datatables->select("P.no_order,P.tgl_pesan,P.nm_pemesan,P.tgl_estimasi,
                               GH.ukuran,GH.warna_plastik,GH.merek,
                               PD.dll,PD.jumlah,
                               GB.nm_barang,GB.warna,
                               (PD.jumlah - PD.jumlah_kirim) AS sisa, PD.sm, PD.id_dp, PD.satuan");
    $this->datatables->from("pesanan P");
    $this->datatables->where("P.sts_pesanan = 'PROGRESS' AND PD.sts_pesanan = 'PROGRESS' AND sts_kirim = 'BELUM TERKIRIM'
                              AND P.deleted = 'FALSE' AND PD.deleted = 'FALSE' AND PD.tgl_kirim_gudang IS NOT NULL
                              AND (PD.jumlah - PD.jumlah_kirim) > 0");
    $this->datatables->join("pesanan_detail PD","PD.no_order = P.no_order","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->db->order_by("P.tgl_pesan","DESC");

    return $this->datatables->generate();
  }

  public function selectPesananData($param){
    $arrData = $this->db->query("SELECT * FROM pesanan WHERE no_order='$param[noOrder]'")->result_array();
    if(empty($arrData[0]["note"])){
      $arrData = $this->db->query("SELECT keterangan AS note FROM pesanan_detail WHERE id_dp='$param[idDP]'")->result_array();
    }
    return $arrData;
  }

  public function selectPesananDetailData($param){
    $arrData = $this->db->query("SELECT PD.*,P.tgl_pesan,P.nm_pemesan,GH.ukuran,GH.warna_plastik,GB.warna,
                                        (PD.jumlah-PD.jumlah_kirim) AS sisa, GH.jns_brg, GB.jenis
                                 FROM pesanan_detail PD
                                 INNER JOIN pesanan P ON PD.no_order = P.no_order
                                 LEFT JOIN gudang_hasil GH ON PD.kd_gd_hasil = GH.kd_gd_hasil
                                 LEFT JOIN gudang_bahan GB ON PD.kd_gd_bahan = GB.kd_gd_bahan
                                 WHERE PD.id_dp = '$param' AND PD.deleted='FALSE' AND P.deleted='FALSE'")->result_array();
    return json_encode($arrData);
  }

  public function selectListPengirimanBaruTemp(){
    $arrData = $this->db->query("SELECT TDP.*,
                                        GH.ukuran,PD.merek,GH.jns_permintaan,PD.no_order
                                 FROM transaksi_detail_pengiriman TDP
                                 INNER JOIN pesanan_detail PD ON TDP.id_dp = PD.id_dp
                                 LEFT JOIN gudang_hasil GH ON TDP.kd_gd_hasil = GH.kd_gd_hasil
                                 LEFT JOIN gudang_bahan GB ON TDP.kd_gd_bahan = GB.kd_gd_bahan
                                 WHERE TDP.`status`='PENDING' AND TDP.deleted='FALSE' AND PD.deleted='FALSE'")->result_array();
    return json_encode($arrData);
  }

  public function selectListDetailPengiriman($param){
    $arrData = $this->db->query("SELECT TDP.*,
                                        GH.ukuran,PD.merek,GH.jns_permintaan, PD.satuan
                                 FROM transaksi_detail_pengiriman TDP
                                 INNER JOIN pesanan_detail PD ON TDP.id_dp = PD.id_dp
                                 LEFT JOIN gudang_hasil GH ON TDP.kd_gd_hasil = GH.kd_gd_hasil
                                 LEFT JOIN gudang_bahan GB ON TDP.kd_gd_bahan = GB.kd_gd_bahan
                                 WHERE TDP.`status`='FINISH' AND TDP.deleted='FALSE' AND PD.deleted='FALSE'
                                 AND TDP.id_dp = '$param'")->result_array();
    return json_encode($arrData);
  }

  public function selectListGudangHasilDatatable($param){
    $this->datatables->select("kd_gd_hasil,kd_accurate,ukuran,FORMAT(stok_berat,2) AS stok_berat,FORMAT(stok_lembar,0) AS stok_lembar,warna_plastik,merek,jns_permintaan,jns_brg");
    $this->datatables->from("gudang_hasil");
    if(empty($param["jns_permintaan"])){
      $this->datatables->where("jns_brg='$param[jns_brg]' AND deleted='FALSE'");
    }else{
      $this->datatables->where("jns_brg='$param[jns_brg]' AND jns_permintaan='$param[jns_permintaan]' AND deleted='FALSE'");
    }
    return $this->datatables->generate();
  }

  public function selectTrashListGudangHasilDatatable(){
    $this->datatables->select("kd_gd_hasil,kd_accurate,ukuran,stok_berat,stok_lembar,warna_plastik,merek,jns_permintaan,jns_brg");
    $this->datatables->from("gudang_hasil");
    $this->datatables->where("deleted='TRUE'");
    return $this->datatables->generate();
  }

  public function selectTrashListTransaksiGudangHasil(){
    $this->datatables->select("id_permintaan_jadi,kd_gd_hasil,tgl_transaksi,CONCAT(merek,' ',ukuran,' ', warna,' ',jns_permintaan, ' (',sts_barang, ')') AS merek,jumlah_berat,jumlah_lembar,keterangan_history,status_history");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("deleted='TRUE'");
    return $this->datatables->generate();
  }

  public function selectCountTrashBarangGudangHasil(){
    $this->db->select("COUNT(kd_gd_hasil) AS Jumlah");
    $this->db->from("gudang_hasil");
    $this->db->where("deleted='TRUE'");
    $result = $this->db->get();
    return $result->result_array();
  }

  public function selectCountTrashTransaksiGudangHasil(){
    $this->db->select("COUNT(id_permintaan_jadi) AS Jumlah");
    $this->db->from("transaksi_gudang_hasil");
    $this->db->where("deleted='TRUE'");
    $result = $this->db->get();
    return $result->result_array();
  }

  public function selectListHistoryGudangHasilMasukDatatable($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $this->datatables->select("id_permintaan_jadi,tgl_transaksi,FORMAT(jumlah_berat,2) AS jumlah_berat, FORMAT(jumlah_lembar,2) AS jumlah_lembar,
                              keterangan_history,status_history,status_lock,customer,keterangan_barang, keterangan");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("status_history = 'MASUK' AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND
                              '$param[tglAkhir]' AND
                              deleted='FALSE' AND
                              status_transaksi='FINISH' AND
                              kd_gd_hasil=",$param['kdGdHasil']);
    $this->db->order_by("FIELD(status_history,'MASUK','KELUAR')");
    $this->db->order_by('tgl_transaksi','DESC');
    return $this->datatables->generate();
  }

  public function selectListHistoryGudangHasilBufferMasukDatatable($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $this->datatables->select("id_permintaan_jadi,tgl_transaksi,FORMAT(jumlah_berat,2) AS jumlah_berat, FORMAT(jumlah_lembar,2) AS jumlah_lembar,
                              keterangan_history,status_history,status_lock,customer,keterangan_barang, keterangan");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("(status_history = 'KELUAR' OR status_history = 'MASUK') AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND
                              '$param[tglAkhir]' AND
                              deleted='FALSE' AND
                              keterangan_history != 'PENGAMBILAN SABLON (SABLON)' AND
                              status_transaksi='FINISH' AND
                              kd_gd_hasil_secondary=",$param['kdGdHasil']);
    $this->db->order_by('tgl_transaksi','DESC');
    return $this->datatables->generate();
  }

  public function selectListHistoryGudangHasilKeluarDatatable($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $this->datatables->select("id_permintaan_jadi,tgl_transaksi,FORMAT(jumlah_berat,2) AS jumlah_berat, FORMAT(jumlah_lembar,2) AS jumlah_lembar,
                              keterangan_history,status_history,status_lock,customer,keterangan_barang, keterangan");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("status_history = 'KELUAR' AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND
                              '$param[tglAkhir]' AND
                              deleted='FALSE' AND
                              status_transaksi='FINISH' AND
                              kd_gd_hasil=",$param['kdGdHasil']);
    $this->db->order_by("FIELD(status_history,'MASUK','KELUAR')");
    $this->db->order_by('tgl_transaksi','DESC');
    return $this->datatables->generate();
  }

  public function selectListHistoryGudangBufferKeluarDatatable($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $this->datatables->select("id_permintaan_jadi,tgl_transaksi,FORMAT(jumlah_berat,2) AS jumlah_berat, FORMAT(jumlah_lembar,2) AS jumlah_lembar,
                              keterangan_history,status_history,status_lock,customer,keterangan_barang, keterangan");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("status_history = 'KELUAR' AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND
                              '$param[tglAkhir]' AND
                              deleted='FALSE' AND
                              status_transaksi='FINISH' AND
                              keterangan_history = 'PENGAMBILAN SABLON (SABLON)' AND
                              kd_gd_hasil_secondary=",$param['kdGdHasil']);
    $this->db->order_by('tgl_transaksi','DESC');
    return $this->datatables->generate();
  }

  public function selectSaldoAwalBulanGudangHasil($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $saldoAwal = $this->db->query("SELECT (
                                           SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',jumlah_berat,0))-
                                           SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',jumlah_berat,0))
                                          )
                                AS saldo_awal_berat,
                                          (
                                           SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',jumlah_lembar,0))-
                                           SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',jumlah_lembar,0))
                                          )
                                AS saldo_awal_lembar
                                FROM transaksi_gudang_hasil
                                WHERE kd_gd_hasil = '$param[kdGdHasil]'
                                AND tgl_transaksi BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                AND deleted='FALSE'
                                AND status_transaksi = 'FINISH'")->result_array();

    $totalPerPeriode = $this->db->query("SELECT SUM(IF(status_history='MASUK',jumlah_berat,0)) AS total_masuk_berat_per_periode,
                                                SUM(IF(status_history='KELUAR',jumlah_berat,0)) AS total_keluar_berat_per_periode,
                                                SUM(IF(status_history='MASUK',jumlah_lembar,0)) AS total_masuk_lembar_per_periode,
                                                SUM(IF(status_history='KELUAR',jumlah_lembar,0)) AS total_keluar_lembar_per_periode
                                         FROM transaksi_gudang_hasil
                                         WHERE kd_gd_hasil = '$param[kdGdHasil]'
                                         AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                                         AND deleted='FALSE'
                                         AND status_transaksi = 'FINISH'
                                         AND keterangan_history !='DATA AWAL'")->result_array();
    $result = array("saldoAwalBerat"=>number_format($saldoAwal[0]["saldo_awal_berat"],2,".",","),
                    "saldoAwalLembar"=>number_format($saldoAwal[0]["saldo_awal_lembar"],2,".",","),
                    "saldoAkhirBerat"=>number_format($saldoAwal[0]["saldo_awal_berat"]+$totalPerPeriode[0]["total_masuk_berat_per_periode"]-$totalPerPeriode[0]["total_keluar_berat_per_periode"],2,".",","),
                    "saldoAkhirLembar"=>number_format($saldoAwal[0]["saldo_awal_lembar"]+$totalPerPeriode[0]["total_masuk_lembar_per_periode"]-$totalPerPeriode[0]["total_keluar_lembar_per_periode"],2,".",","),
                    "saldoMasukBerat"=>number_format($totalPerPeriode[0]["total_masuk_berat_per_periode"],2,".",","),
                    "saldoKeluarBerat"=>number_format($totalPerPeriode[0]["total_keluar_berat_per_periode"],2,".",","),
                    "saldoMasukLembar"=>number_format($totalPerPeriode[0]["total_masuk_lembar_per_periode"],2,".",","),
                    "saldoKeluarLembar"=>number_format($totalPerPeriode[0]["total_keluar_lembar_per_periode"],2,".",","));
    return json_encode($result);
  }

  public function selectSaldoAwalBulanGudangHasilBuffer($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $saldoAwal = $this->db->query("SELECT (
                                           SUM(IF((keterangan_history != 'PENGAMBILAN SABLON (SABLON)'
                                                  AND keterangan_history NOT LIKE '%PENGEMBALIAN BARANG%')
                                                  AND kd_gd_hasil_secondary='$param[kdGdHasil]'
                                                  AND tgl_transaksi <= '$param[tglAwal]',jumlah_berat,0))-
                                           SUM(IF((keterangan_history LIKE '%PENGEMBALIAN BARANG%'
                                                  OR keterangan_history = 'PENGAMBILAN SABLON (SABLON)')
                                                  AND kd_gd_hasil_secondary = '$param[kdGdHasil]'
                                                  AND tgl_transaksi <= '$param[tglAwal]',jumlah_berat,0))
                                          )
                                AS saldo_awal_berat,
                                          (
                                            SUM(IF((keterangan_history != 'PENGAMBILAN SABLON (SABLON)'
                                                   AND keterangan_history NOT LIKE '%PENGEMBALIAN BARANG%')
                                                   AND kd_gd_hasil_secondary='$param[kdGdHasil]'
                                                   AND tgl_transaksi <= '$param[tglAwal]',jumlah_lembar,0))-
                                            SUM(IF((keterangan_history LIKE '%PENGEMBALIAN BARANG%'
                                                   OR keterangan_history = 'PENGAMBILAN SABLON (SABLON)')
                                                   AND kd_gd_hasil_secondary = '$param[kdGdHasil]'
                                                   AND tgl_transaksi <= '$param[tglAwal]',jumlah_lembar,0))
                                          )
                                AS saldo_awal_lembar
                                FROM transaksi_gudang_hasil
                                WHERE (kd_gd_hasil_secondary = '$param[kdGdHasil]' OR kd_gd_hasil = '$param[kdGdHasil]')
                                AND kd_gd_hasil_secondary IS NOT NULL
                                AND tgl_transaksi BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                AND deleted='FALSE'
                                AND status_transaksi = 'FINISH'")->result_array();

    $totalPerPeriode = $this->db->query("SELECT SUM(IF(keterangan_history != 'PENGAMBILAN SABLON (SABLON)'
                                                       AND kd_gd_hasil_secondary='$param[kdGdHasil]',jumlah_berat,0)) AS total_masuk_berat_per_periode,
                                                SUM(IF(status_history='KELUAR' AND keterangan_history IN ('PENGEMBALIAN BARANG','PENGAMBILAN SABLON (SABLON)'),jumlah_berat,0)) AS total_keluar_berat_per_periode,
                                                SUM(IF(keterangan_history != 'PENGAMBILAN SABLON (SABLON)'
                                                    AND kd_gd_hasil_secondary='$param[kdGdHasil]',jumlah_lembar,0)) AS total_masuk_lembar_per_periode,
                                                SUM(IF(status_history='KELUAR' AND keterangan_history IN ('PENGEMBALIAN BARANG','PENGAMBILAN SABLON (SABLON)'),jumlah_lembar,0)) AS total_keluar_lembar_per_periode
                                         FROM transaksi_gudang_hasil
                                         WHERE (kd_gd_hasil_secondary = '$param[kdGdHasil]' OR kd_gd_hasil = '$param[kdGdHasil]')
                                         AND kd_gd_hasil_secondary IS NOT NULL
                                         AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                                         AND deleted='FALSE'
                                         AND status_transaksi = 'FINISH'
                                         AND keterangan_history !='DATA AWAL'")->result_array();
    $result = array("saldoAwalBerat"=>number_format($saldoAwal[0]["saldo_awal_berat"],2,".",","),
                    "saldoAwalLembar"=>number_format($saldoAwal[0]["saldo_awal_lembar"],2,".",","),
                    "saldoAkhirBerat"=>number_format($saldoAwal[0]["saldo_awal_berat"]+$totalPerPeriode[0]["total_masuk_berat_per_periode"]-$totalPerPeriode[0]["total_keluar_berat_per_periode"],2,".",","),
                    "saldoAkhirLembar"=>number_format($saldoAwal[0]["saldo_awal_lembar"]+$totalPerPeriode[0]["total_masuk_lembar_per_periode"]-$totalPerPeriode[0]["total_keluar_lembar_per_periode"],2,".",","),
                    "saldoMasukBerat"=>number_format($totalPerPeriode[0]["total_masuk_berat_per_periode"],2,".",","),
                    "saldoKeluarBerat"=>number_format($totalPerPeriode[0]["total_keluar_berat_per_periode"],2,".",","),
                    "saldoMasukLembar"=>number_format($totalPerPeriode[0]["total_masuk_lembar_per_periode"],2,".",","),
                    "saldoKeluarLembar"=>number_format($totalPerPeriode[0]["total_keluar_lembar_per_periode"],2,".",","));
    return json_encode($result);
  }

  public function selectDetailBarangGudangHasil($param){
    $this->db->select("*")->from("gudang_hasil")->where("kd_gd_hasil",$param);
    $result = $this->db->get()->result_array();
    return json_encode($result);
  }

  public function selectDetailTransaksiGudangHasil($param){
    $this->db->select("TGH.*,TDP.jumlah_terkirim,PD.satuan");
    $this->db->from("transaksi_gudang_hasil TGH");
    $this->db->where("TGH.id_permintaan_jadi",$param);
    $this->db->join("transaksi_detail_pengiriman TDP","TGH.id_detail_pengiriman = TDP.id_detail_pengiriman","LEFT");
    $this->db->join("pesanan_detail PD","TGH.id_dp = PD.id_dp","LEFT");
    $result = $this->db->get()->result_array();
    return json_encode($result);
  }

  public function selectListPengambilanSablonTemp(){
    $result = $this->db->query("SELECT TPS.*,GH.ukuran,GH.warna_plastik,GH.merek,GH.jns_permintaan,GH.jns_brg
                                FROM transaksi_pengambilan_sablon TPS
                                INNER JOIN gudang_hasil GH ON TPS.kd_gd_hasil = GH.kd_gd_hasil
                                WHERE TPS.status_pengambilan = 'FALSE'
                                AND TPS.deleted='FALSE'
                                AND GH.deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectListPengirimanGudangTemp($param){
    $arrData = $this->db->query("SELECT TDP.*,
                                        GH.ukuran,GH.merek,GH.jns_permintaan,GH.warna_plastik
                                 FROM transaksi_detail_pengiriman TDP
                                 LEFT JOIN gudang_hasil GH ON TDP.kd_gd_hasil = GH.kd_gd_hasil
                                 WHERE TDP.`status`='PENDING'
                                 AND TDP.deleted='FALSE'
                                 AND TDP.sts_pengiriman='$param'
                                 AND GH.deleted='FALSE'
                                 AND TDP.id_dp IS NULL")->result_array();
    return json_encode($arrData);
  }

  public function selectDetailPengirimanGudangTemp($param){
    $arrData = $this->db->query("SELECT *
                                 FROM transaksi_detail_pengiriman
                                 WHERE `status`='PENDING'
                                 AND deleted='FALSE'
                                 AND id_detail_pengiriman='$param'
                                 AND id_dp IS NULL")->result_array();
    return json_encode($arrData);
  }

  public function selectListKirimanApalTemp(){
    $arrData = $this->db->query("SELECT id, kd_gd_apal, jumlah_apal, warna, tgl_transaksi
                                 FROM transaksi_detail_history_apal
                                 WHERE sts_transaksi = 'PENDING'
                                 AND bagian = 'GUDANG HASIL'
                                 AND deleted='FALSE'")->result_array();
    return json_encode($arrData);
  }

  public function selectListPengembalianBarang($param){
    $arrData = $this->db->query("SELECT id_permintaan_jadi, kd_gd_hasil, tgl_transaksi, customer, ukuran, jumlah_berat, jumlah_lembar, warna, merek, jns_permintaan, keterangan
                                 FROM transaksi_gudang_hasil
                                 WHERE sts_barang='$param'
                                 AND status_transaksi='PENDING'
                                 AND keterangan_history = 'PENGEMBALIAN BARANG'
                                 AND keterangan != 'PENGEMBALIAN KE GUDANG STANDARD'
                                 AND deleted='FALSE'")->result_array();
    return json_encode($arrData);
  }

  public function selectListPembelianBarangHd(){
    $arrData = $this->db->query("SELECT id_permintaan_jadi, kd_gd_hasil, tgl_transaksi, customer, ukuran, jumlah_berat, jumlah_lembar, warna, merek, jns_permintaan
                                 FROM transaksi_gudang_hasil
                                 WHERE keterangan_history='PEMBELIAN BARANG'
                                 AND keterangan_barang='PEMBELIAN BARANG (HD)'
                                 AND status_transaksi ='PENDING'
                                 and deleted='FALSE'")->result_array();
    return json_encode($arrData);
  }

  public function selectListHistoryGudangApal($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $this->datatables->select("id,tgl_transaksi,bagian,nama,jumlah_apal,keterangan_history,status_history,status_lock");
    $this->datatables->from("transaksi_detail_history_apal");
    $this->datatables->where("tgl_transaksi BETWEEN '$tglAwalPlus1' AND
                              '$param[tglAkhir]' AND
                              deleted='FALSE' AND
                              sts_transaksi='FINISH' AND
                              kd_gd_apal=",$param['kdGdApal']);
    $this->db->order_by('tgl_transaksi','DESC');
    return $this->datatables->generate();
  }

  public function selectSaldoAwalBulanGudangApal($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $saldoAwal = $this->db->query("SELECT (
                                           SUM(IF(status_history='MASUK' AND tgl_transaksi < '$param[tglAwal]',jumlah_apal,0))-
                                           SUM(IF(status_history='KELUAR' AND tgl_transaksi < '$param[tglAwal]',jumlah_apal,0))
                                          )
                                AS saldo_awal
                                FROM transaksi_detail_history_apal
                                WHERE kd_gd_apal = '$param[kdGdApal]'
                                AND tgl_transaksi BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                AND deleted='FALSE'
                                AND sts_transaksi = 'FINISH'")->result_array();

    $totalPerPeriode = $this->db->query("SELECT SUM(IF(status_history='MASUK',jumlah_apal,0)) AS total_masuk_per_periode,
                                                SUM(IF(status_history='KELUAR',jumlah_apal,0)) AS total_keluar_per_periode
                                         FROM transaksi_detail_history_apal
                                         WHERE kd_gd_apal = '$param[kdGdApal]'
                                         AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                                         AND deleted='FALSE'
                                         AND sts_transaksi = 'FINISH'
                                         AND keterangan_history !='DATA AWAL'")->result_array();

    $result = array("saldoAwal"=>number_format($saldoAwal[0]["saldo_awal"],2,".",","),
                    "saldoAkhir"=>number_format($saldoAwal[0]["saldo_awal"]+$totalPerPeriode[0]["total_masuk_per_periode"]-$totalPerPeriode[0]["total_keluar_per_periode"],2,".",","),
                    "saldoMasuk"=>number_format($totalPerPeriode[0]["total_masuk_per_periode"],2,".",","),
                    "saldoKeluar"=>number_format($totalPerPeriode[0]["total_keluar_per_periode"],2,".",","));
    return json_encode($result);
  }

  public function selectListKoreksiGudangBufferTemp(){
    $arrData = $this->db->query("SELECT id_permintaan_jadi,kd_gd_hasil,tgl_transaksi,ukuran,jumlah_berat,jumlah_lembar,warna,merek,keterangan_history
                                 FROM transaksi_gudang_hasil
                                 WHERE status_transaksi='PENDING'
                                 AND SUBSTRING(keterangan_history,1,14) = 'KOREKSI BARANG'
                                 AND deleted = 'FALSE'")->result_array();
    return json_encode($arrData);
  }

  public function selectListPengembalianBarangGudangBufferKeStandardTemp(){
    $arrData = $this->db->query("SELECT *
                                  FROM transaksi_gudang_hasil
                                  WHERE kd_gd_hasil IS NOT NULL
                                  AND kd_gd_hasil_secondary IS NOT NULL
                                  AND status_history = 'KELUAR'
                                  AND status_transaksi = 'PENDING'
                                  AND keterangan_history = 'PENGEMBALIAN BARANG'
                                  AND keterangan = 'PENGEMBALIAN KE GUDANG STANDARD'
                                  AND deleted = 'FALSE'")->result_array();
    return json_encode($arrData);
  }

  public function selectListPengeluaranGudangHasil($param){
    $this->datatables->select("TPS.id_pengambilan_sablon, TPS.tgl_pengambilan, TPS.jumlah_lembar, TPS.jumlah_berat, TPS.keterangan,
                               GH.ukuran, GH.warna_plastik, GH.merek");
    $this->datatables->from("transaksi_pengambilan_sablon TPS");
    if(empty($param["jnsPermintaan"])){
      $this->datatables->where("TPS.deleted='FALSE' AND TPS.status_pengambilan = 'TRUE' AND GH.deleted='FALSE' AND GH.jns_brg=",$param["jnsBrg"]);
    }else{
      $this->datatables->where("TPS.deleted='FALSE' AND TPS.status_pengambilan = 'TRUE' AND GH.deleted='FALSE' AND GH.jns_brg='$param[jnsBrg]' AND jns_permintaan=",$param["jnsPermintaan"]);
    }
    $this->datatables->join("gudang_hasil GH", "TPS.kd_gd_hasil = GH.kd_gd_hasil", "INNER");
    $this->db->order_by("TPS.tgl_pengambilan","DESC");

    return $this->datatables->generate();
  }

  public function selectListKirimanDariBagian($param){
    $this->datatables->select("id_permintaan_jadi, kd_gd_hasil, tgl_transaksi,
                               ukuran, jumlah_berat, jumlah_lembar, warna,
                               merek, sts_barang, keterangan_history, jns_permintaan,
                               customer");
    $this->datatables->from("transaksi_gudang_hasil");
    if(empty($param["jnsPermintaan"])){
      $this->datatables->where("bagian='$param[bagian]' AND
                                status_history='MASUK' AND
                                status_transaksi='PROGRESS' AND
                                sts_approve='FALSE' AND
                                sts_barang='$param[statusBarang]' AND
                                merek !='HD' AND
                                deleted = 'FALSE'");
    }else{
      $this->datatables->where("bagian='$param[bagian]' AND
                                status_history='MASUK' AND
                                status_transaksi='PROGRESS' AND
                                sts_approve='FALSE' AND
                                sts_barang='$param[statusBarang]' AND
                                jns_permintaan = '$param[jnsPermintaan]' AND
                                merek !='HD' AND
                                deleted = 'FALSE'");
    }
    $this->db->order_by("tgl_transaksi","DESC");

    return $this->datatables->generate();
  }

  public function selectListKirimanUntukBufferSablon($param){
    $this->datatables->select("id_permintaan_jadi, kd_gd_hasil, kd_gd_hasil_secondary,
                               ukuran, jumlah_berat, jumlah_lembar, tgl_transaksi, warna,
                               merek, sts_barang, keterangan_history, jns_permintaan,
                               customer");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("kd_gd_hasil_secondary IS NOT NULL AND
                              customer='GUDANG HASIL' AND
                              bagian = 'SABLON' AND
                              jns_permintaan = 'POLOS' AND
                              sts_barang = '$param[stsBarang]' AND
                              sts_approve = 'FALSE' AND
                              status_history = 'KELUAR' AND
                              status_transaksi = 'PROGRESS' AND
                              keterangan_history = 'PENGAMBILAN SABLON ($param[stsBarang])' AND
                              deleted = 'FALSE'");
    $this->db->order_by("tgl_transaksi","DESC");
    return $this->datatables->generate();
  }

  public function countKirimanBarangKeGudangBuffer(){
    $data = $this->db->query("select id_permintaan_jadi from transaksi_gudang_hasil where (kd_gd_hasil_secondary IS NOT NULL AND
                                  customer='GUDANG HASIL' AND
                                  bagian = 'SABLON' AND
                                  jns_permintaan = 'POLOS' AND
                                  sts_barang = 'STANDARD' AND
                                  sts_approve = 'FALSE' AND
                                  status_history = 'KELUAR' AND
                                  status_transaksi = 'PROGRESS' AND
                                  keterangan_history = 'PENGAMBILAN SABLON (STANDARD)' AND
                                  deleted = 'FALSE') or (kd_gd_hasil_secondary IS NOT NULL AND
                                  customer='GUDANG HASIL' AND
                                  bagian = 'SABLON' AND
                                  jns_permintaan = 'POLOS' AND
                                  sts_barang = 'CAMPUR' AND
                                  sts_approve = 'FALSE' AND
                                  status_history = 'KELUAR' AND
                                  status_transaksi = 'PROGRESS' AND
                                  keterangan_history = 'PENGAMBILAN SABLON (CAMPUR)' AND
                                  deleted = 'FALSE')");
    return $data->num_rows();
  }

  public function selectDetailDataOrderTerkirim($param){
    $this->db->select("a.*, b.*");
    $this->db->from("transaksi_detail_pengiriman a");
    $this->db->join("gudang_hasil b","a.kd_gd_hasil = b.kd_gd_hasil","INNER");
    $this->db->where("a.id_detail_pengiriman",$param);
    $result = $this->db->get()->result_array();
    return json_encode($result);
  }

  public function selectDataStokMaster($kd_gd_hasil){
    $data = $this->db->query("select stok_berat, FORMAT(stok_lembar,2) as stok_lembar from gudang_hasil where kd_gd_hasil= '$kd_gd_hasil' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function selectListGudangBahanDatatable($param){
    $this->datatables->select("kd_gd_bahan,kd_accurate,nm_barang,CONCAT(stok,' ',satuan) AS stok,warna");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("deleted='FALSE' AND jenis=",$param);
    return $this->datatables->generate();
  }

  public function selectDetailBarangBahan($param){
    $result = $this->db->query("SELECT * FROM gudang_bahan WHERE kd_gd_bahan='$param' AND deleted = 'FALSE'");
    return json_encode($result->result_array());
  }

  public function selectComboBoxValueBahan($param){
    $result = $this->db->query("SELECT * FROM gudang_bahan WHERE jenis = '$param[jenis]' AND deleted='FALSE' LIMIT 20");
    return json_encode($result->result_array());
  }

  public function selectComboBoxValueBahanSearch($param){
    $result = $this->db->query("SELECT * FROM gudang_bahan WHERE jenis = '$param[jenis]'
                                AND deleted = 'FALSE'
                                AND (kd_gd_bahan LIKE '%$param[key]%' OR
                                     kd_accurate LIKE '%$param[key]%' OR
                                     nm_barang LIKE '%$param[key]%' OR
                                     warna LIKE '%$param[key]%')");
    return json_encode($result->result_array());
  }

  public function selectListHistoryGudangBahan($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $this->datatables->select("id,tgl_permintaan,FORMAT(jumlah_permintaan,2) AS jumlah_permintaan,
                              keterangan_history,status_history,status_lock,nama");
    $this->datatables->from("transaksi_gudang_bahan");
    $this->datatables->where("tgl_permintaan BETWEEN '$tglAwalPlus1' AND
                              '$param[tglAkhir]' AND
                              deleted='FALSE' AND
                              `status`='FINISH' AND
                              kd_gd_bahan=",$param['kdGdBahan']);
    $this->db->order_by('tgl_permintaan','DESC');
    return $this->datatables->generate();
  }

  public function selectSaldoAwalBulanGudangBahan($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $saldoAwal = $this->db->query("SELECT (
                                           SUM(IF(status_history='MASUK' AND tgl_permintaan <= '$param[tglAwal]',jumlah_permintaan,0))-
                                           SUM(IF(status_history='KELUAR' AND tgl_permintaan <= '$param[tglAwal]',jumlah_permintaan,0))
                                          )
                                AS saldo_awal
                                FROM transaksi_gudang_bahan
                                WHERE kd_gd_bahan = '$param[kdGdBahan]'
                                AND tgl_permintaan BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                AND deleted='FALSE'
                                AND `status` = 'FINISH'")->result_array();

    $totalPerPeriode = $this->db->query("SELECT SUM(IF(status_history='MASUK',jumlah_permintaan,0)) AS total_masuk_per_periode,
                                                SUM(IF(status_history='KELUAR',jumlah_permintaan,0)) AS total_keluar_per_periode
                                         FROM transaksi_gudang_bahan
                                         WHERE kd_gd_bahan = '$param[kdGdBahan]'
                                         AND tgl_permintaan BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                                         AND deleted='FALSE'
                                         AND `status` = 'FINISH'
                                         AND keterangan_history !='DATA AWAL'")->result_array();
    $result = array("saldoAwal"=>number_format($saldoAwal[0]["saldo_awal"],2,".",","),
                    "saldoAkhir"=>number_format($saldoAwal[0]["saldo_awal"]+$totalPerPeriode[0]["total_masuk_per_periode"]-$totalPerPeriode[0]["total_keluar_per_periode"],2,".",","),
                    "saldoMasuk"=>number_format($totalPerPeriode[0]["total_masuk_per_periode"],2,".",","),
                    "saldoKeluar"=>number_format($totalPerPeriode[0]["total_keluar_per_periode"],2,".",","));
    return json_encode($result);
  }

  public function selectKoreksiGudangBahan($param){
    $result = $this->db->query("SELECT TGB.tgl_permintaan,
                                       GB.nm_barang,
                                       GB.jenis,
                                       FORMAT(TGB.jumlah_permintaan,2) AS jumlah_permintaan,
                                       TGB.keterangan_history,
                                       TGB.status_history,
                                       TGB.id,
                                       TGB.kd_gd_bahan
                                FROM transaksi_gudang_bahan TGB
                                INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                WHERE TGB.`status` = 'PENDING'
                                AND TGB.deleted = 'FALSE'
                                AND GB.deleted = 'FALSE'
                                AND GB.jenis='$param'
                                AND TGB.bagian='GUDANG HASIL'
                                AND SUBSTRING(TGB.keterangan_history,1,7) = 'KOREKSI'");
    return $result->result_array();
  }

  public function selectDetailTransaksiGudangBahan($param){
    $result = $this->db->query("SELECT TGB.*, GB.warna, GB.nm_barang FROM transaksi_gudang_bahan TGB
                                INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                WHERE TGB.deleted='FALSE'
                                AND TGB.id='$param'
                                AND GB.deleted='FALSE'");
    return json_encode($result->result_array());
  }

  public function selectPengeluaranGudangBahan($param){
    $result = $this->db->query("SELECT TGB.tgl_permintaan,
                                       GB.nm_barang,
                                       GB.jenis,
                                       FORMAT(TGB.jumlah_permintaan,2) AS jumlah_permintaan,
                                       TGB.keterangan_history,
                                       TGB.status_history,
                                       TGB.id,
                                       TGB.kd_gd_bahan
                                FROM transaksi_gudang_bahan TGB
                                INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                WHERE TGB.`status` = 'PENDING'
                                AND TGB.deleted = 'FALSE'
                                AND GB.deleted = 'FALSE'
                                AND GB.jenis='$param'
                                AND TGB.nama = 'GUDANG HASIL'
                                AND (SUBSTRING(TGB.keterangan_history,1,11) = 'PENGAMBILAN'
                                OR SUBSTRING(TGB.keterangan_history,1,11) = 'PENGELUARAN')");
    return $result->result_array();
  }

  public function selectCountAlert($param){
    if(strpos($param['bagian'],"|")===FALSE){
      $arrData = $this->db->query("SELECT COUNT(TGB.id) AS Jumlah FROM transaksi_gudang_bahan TGB
                                   INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                   WHERE TGB.bagian='$param[bagian]' AND TGB.`status`='PROGRESS' AND GB.jenis='$param[jenis]'
                                   AND TGB.deleted='FALSE' AND GB.deleted='FALSE'");
    }else{
      $bagian = explode("|",$param["bagian"]);
      $arrData = $this->db->query("SELECT COUNT(TGB.id) AS Jumlah FROM transaksi_gudang_bahan TGB
                                   INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                   WHERE (TGB.bagian='$bagian[0]' OR TGB.bagian='$bagian[1]') AND TGB.`status`='PROGRESS' AND GB.jenis='$param[jenis]'
                                   AND TGB.deleted='FALSE' AND GB.deleted='FALSE'");
    }
    return json_encode($arrData->result_array());
  }

  public function selectCountAlertPembelianGudangBahan($param){
    $arrData = $this->db->query("SELECT COUNT(TGB.id) AS Jumlah FROM transaksi_gudang_bahan TGB
                                 INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                 WHERE TGB.bagian='GUDANG BAHAN' AND TGB.`status`='WAITING APPROVE' AND GB.jenis='$param'
                                 AND TGB.keterangan_history='PEMBELIAN BARANG'
                                AND TGB.deleted='FALSE' AND GB.deleted='FALSE'");
    return json_encode($arrData->result_array());
  }

  function countPermintaanCatSablon(){
    $data = $this->db->query("SELECT a.id FROM transaksi_gudang_bahan a
                              JOIN gudang_bahan b ON a.kd_gd_bahan = b.kd_gd_bahan
                              WHERE (a.bagian ='SABLON'
                              AND a.status = 'WAITING APPROVE'
                              AND a.status_history = 'KELUAR'
                              AND a.keterangan_history = 'PENGELUARAN KE SABLON'
                              AND a.deleted='FALSE'
                              AND b.jenis = 'Cat Murni')
                              OR (a.bagian ='SABLON'
                              AND a.status = 'WAITING APPROVE'
                              AND a.status_history = 'KELUAR'
                              AND a.keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))'
                              AND a.deleted='FALSE'
                              AND b.jenis = 'Cat Murni')");
    return $data->num_rows();
  }

  public function selectPermintaanBarang($param){
    $this->datatables->select("TPB.kd_permintaan_barang, TPB.tgl_permintaan, TPB.status_permintaan, USR.username");
    $this->datatables->from("transaksi_permintaan_barang TPB");
    $this->datatables->join("users USR","TPB.id_user = USR.id_user","INNER");
    $this->datatables->where("TPB.id_user = '$param[idUser]' AND
                              TPB.bagian = '$param[bagian]' AND
                              TPB.deleted = 'FALSE' AND
                              TPB.status_permintaan NOT IN ('FINISH')");
    $this->db->order_by("TPB.tgl_permintaan","DESC");
    return $this->datatables->generate();
  }

  public function selectPermintaanBarang_Print($param){
    $Q = "SELECT TPB.kd_permintaan_barang, TPB.tgl_permintaan, TPB.status_permintaan, USR.username, TPB.bagian
          FROM transaksi_permintaan_barang TPB
          INNER JOIN users USR ON TPB.id_user = USR.id_user
          WHERE TPB.kd_permintaan_barang = '$param'";
    $result = $this->db->query($Q)->result_array();
    return $result;
  }

  public function selectDetailPermintaanBaru_Print($param){
    $Q = "SELECT GB.nm_barang, GB.warna, TDPB.jumlah_permintaan,
                 TDPB.keterangan, TDPB.status_permintaan, TDPB.id_dpb,
                 TDPB.kd_permintaan_barang, TPB.tgl_permintaan
          FROM transaksi_detail_permintaan_barang TDPB
          INNER JOIN gudang_bahan GB ON TDPB.kd_gd_bahan = GB.kd_gd_bahan
          INNER JOIN transaksi_permintaan_barang TPB ON TDPB.kd_permintaan_barang = TPB.kd_permintaan_barang
          WHERE TPB.kd_permintaan_barang = '$param' AND
                TDPB.deleted='FALSE' AND
                GB.deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return $result;
  }

  public function selectDetailPermintaanBaru($param){
    $this->datatables->select("GB.nm_barang, GB.warna, TDPB.jumlah_permintaan, (TDPB.jumlah_permintaan - TDPB.jumlah_terima) AS sisa,
                               TDPB.keterangan, TDPB.status_permintaan, TDPB.id_dpb, TPB.tgl_permintaan,
                               TDPB.kd_permintaan_barang, TDPB.keterangan_purchasing");
    $this->datatables->from("transaksi_detail_permintaan_barang TDPB");
    $this->datatables->join("gudang_bahan GB","TDPB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->join("transaksi_permintaan_barang TPB","TDPB.kd_permintaan_barang = TPB.kd_permintaan_barang","INNER");
    if(empty($param["idPermintaan"])){
      $this->datatables->where("TPB.id_user = '$param[idUser]' AND
                                TPB.bagian = '$param[bagian]' AND
                                GB.jenis = 'CAT MURNI' AND
                                TDPB.deleted='FALSE' AND
                                GB.deleted='FALSE'");
    }else{
      $this->datatables->where("TPB.id_user = '$param[idUser]' AND
                                TPB.bagian = '$param[bagian]' AND
                                TPB.kd_permintaan_barang = '$param[idPermintaan]' AND
                                TDPB.deleted='FALSE' AND
                                GB.deleted='FALSE'");
    }
    return $this->datatables->generate();
  }

  public function selectDataPermintaanUntukInputTransaksiGudangBahan($param){
    $Q = "SELECT TDPB.kd_gd_bahan, (TDPB.jumlah_permintaan - TDPB.jumlah_terima) AS jumlah_permintaan,TPB.bagian
          FROM transaksi_detail_permintaan_barang TDPB
          INNER JOIN transaksi_permintaan_barang TPB ON TDPB.kd_permintaan_barang = TPB.kd_permintaan_barang
          WHERE TDPB.id_dpb = '$param'
          AND TPB.deleted='FALSE'
          AND TDPB.deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return $result;
  }

  public function selectTransaksiGudangBahanForApproveDataTable($param){
    if(strpos($param['bagian'],"|")===FALSE){
      $this->datatables->select("TGB.tgl_permintaan,GB.nm_barang,GB.warna,GB.jenis,FORMAT(TGB.jumlah_permintaan,2) AS jumlah_permintaan,TGB.id,TGB.status_history,TGB.bagian");
      $this->datatables->from("transaksi_gudang_bahan TGB");
      $this->datatables->join("gudang_bahan GB","TGB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
      $this->datatables->where("TGB.bagian='$param[bagian]' AND TGB.status='PROGRESS' AND GB.jenis='$param[jenis]' AND TGB.deleted='FALSE' AND GB.deleted='FALSE'");
      $this->db->order_by("TGB.bagian ASC, TGB.tgl_permintaan DESC");
    }else{
      $bagian = explode("|",$param["bagian"]);
      $this->datatables->select("TGB.tgl_permintaan,GB.nm_barang,GB.warna,GB.jenis,FORMAT(TGB.jumlah_permintaan,2) AS jumlah_permintaan,TGB.id,TGB.status_history,TGB.bagian");
      $this->datatables->from("transaksi_gudang_bahan TGB");
      $this->datatables->join("gudang_bahan GB","TGB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
      $this->datatables->where("(TGB.bagian='$bagian[0]' OR TGB.bagian='$bagian[1]') AND TGB.status='PROGRESS' AND GB.jenis='$param[jenis]' AND TGB.deleted='FALSE' AND GB.deleted='FALSE'");
      $this->db->order_by("TGB.bagian ASC, TGB.tgl_permintaan DESC");
    }
    return $this->datatables->generate();
  }

  public function selectGudangBahanDataForApprove($param){
    if(strpos($param['bagian'],"|")===FALSE){
      $arrData = $this->db->query("SELECT TGB.id, TGB.kd_gd_bahan, TGB.jumlah_permintaan, TGB.status_history, TGB.`status`
                                   FROM transaksi_gudang_bahan TGB
                                   INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                   WHERE TGB.bagian='$param[bagian]'
                                   AND TGB.`status` = 'PROGRESS'
                                   AND GB.jenis = '$param[jenis]'
                                   AND TGB.deleted='FALSE'
                                   AND GB.deleted='FALSE'")->result_array();
    }else{
      $bagian = explode("|",$param["bagian"]);
      $arrData = $this->db->query("SELECT TGB.id, TGB.kd_gd_bahan, TGB.jumlah_permintaan, TGB.status_history, TGB.`status`
                                   FROM transaksi_gudang_bahan TGB
                                   INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                   WHERE (TGB.bagian='$bagian[0]' OR TGB.bagian='$bagian[1]')
                                   AND TGB.`status` = 'PROGRESS'
                                   AND GB.jenis = '$param[jenis]'
                                   AND TGB.deleted='FALSE'
                                   AND GB.deleted='FALSE'")->result_array();
    }
    return $arrData;
  }

  public function selectListDataAwalPending($param){
    $Q = "SELECT TGB.id, GB.nm_barang, TGB.jumlah_permintaan, GB.warna, TGB.kd_gd_bahan
          FROM transaksi_gudang_bahan TGB
          INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
          WHERE TGB.deleted='FALSE'
          AND GB.deleted='FALSE'
          AND TGB.keterangan_history='DATA AWAL'
          AND TGB.status = 'PENDING'
          AND TGB.status_history = 'MASUK'
          AND TGB.id_user = '$param[idUser]'
          AND GB.jenis = '$param[jenis]'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectDetailDataAwal($param){
    $Q = "SELECT * FROM transaksi_gudang_bahan
          WHERE kd_gd_bahan = '$param'
          AND status_history = 'MASUK'
          AND keterangan_history = 'DATA AWAL'
          AND status = 'FINISH'
          AND deleted = 'FALSE'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectCekKartuStok($param){
    if($param["stsBarang"] == "SABLON_HASIL"){
      $clause = "sts_barang = 'SABLON' AND jns_permintaan='CETAK' ";
    }else{
      $clause = "sts_barang = '$param[stsBarang]' ";
    }
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $saldoAwal = $this->db->query("SELECT (
                                           SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',jumlah_berat,0))-
                                           SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',jumlah_berat,0))
                                          )
                                AS saldo_awal_berat,
                                          (
                                           SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',jumlah_lembar,0))-
                                           SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',jumlah_lembar,0))
                                          )
                                AS saldo_awal_lembar,
                                kd_gd_hasil
                                FROM transaksi_gudang_hasil
                                WHERE $clause
                                AND tgl_transaksi BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                AND deleted='FALSE'
                                AND status_transaksi = 'FINISH'
                                GROUP BY kd_gd_hasil")->result_array();

    $totalPerPeriode = $this->db->query("SELECT SUM(IF(status_history='MASUK',jumlah_berat,0)) AS total_masuk_berat_per_periode,
                                                SUM(IF(status_history='KELUAR',jumlah_berat,0)) AS total_keluar_berat_per_periode,
                                                SUM(IF(status_history='MASUK',jumlah_lembar,0)) AS total_masuk_lembar_per_periode,
                                                SUM(IF(status_history='KELUAR',jumlah_lembar,0)) AS total_keluar_lembar_per_periode,
                                                kd_gd_hasil
                                         FROM transaksi_gudang_hasil
                                         WHERE $clause
                                         AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                                         AND deleted='FALSE'
                                         AND status_transaksi = 'FINISH'
                                         AND keterangan_history !='DATA AWAL'
                                         GROUP BY kd_gd_hasil")->result_array();
    $dataMaster = $this->db->query("SELECT kd_gd_hasil, CONCAT(ukuran,' ',merek,' ',warna_plastik) AS nm_barang,
                                           stok_berat, stok_lembar
                                    FROM gudang_hasil
                                    WHERE deleted = 'FALSE'
                                    AND jns_brg = '$param[stsBarang]'
                                    ORDER BY merek ASC, CAST(SUBSTRING_INDEX(ukuran,'+',1) AS UNSIGNED) ASC")->result_array();
    $result = array("saldoAwal" => $saldoAwal,
                    "saldoPerPeriode" => $totalPerPeriode,
                    "dataMaster" => $dataMaster);
    return json_encode($result);
  }

  public function selectDetailDataAwalGudangHasil($param){
    $Q = "SELECT *
          FROM transaksi_gudang_hasil
          WHERE kd_gd_hasil = '$param'
          AND keterangan_history = 'DATA AWAL'
          AND status_transaksi = 'FINISH'
          AND deleted = 'FALSE'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListDataAwalGudangHasilPending($param){
    $Q = "SELECT CONCAT(ukuran,' ',merek,' ',warna) AS nm_barang,
                 jumlah_berat, jumlah_lembar, id_permintaan_jadi, kd_gd_hasil
          FROM transaksi_gudang_hasil
          WHERE keterangan_history = 'DATA AWAL'
          AND sts_barang = '$param'
          AND status_transaksi = 'PENDING'
          AND deleted = 'FALSE'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectCekKartuStokSort($param){
    if($param["stsBarang"] == "SABLON_HASIL"){
      $clause = "GH.jns_brg = 'SABLON' AND GH.jns_permintaan='CETAK' ";
    }else{
      $clause = "GH.jns_brg = '$param[stsBarang]' ";
    }
    $having = "";
    $flags = "";
    if(!empty($param["havingStokMaster"])){
      $flags .= "1";
    }

    if(!empty($param["havingStokAwal"])){
      $flags .= "2";
    }

    if(!empty($param["havingStokAkhir"])){
      $flags .= "3";
    }
    if(!empty($flags)){
      $having = " HAVING";
      $arrFlags = str_split($flags);
      $j = count($arrFlags)-1;
      for ($i=0; $i <count($arrFlags) ; $i++) {
        switch ($arrFlags[$i]) {
          case '1': $having .= " GH.stok_berat ".$param["havingStokMaster"];break;
          case '2': $having .= " saldoAwalBerat ".$param["havingStokAwal"];break;
          case '3': $having .= " saldoAkhirBerat ".$param["havingStokAkhir"];break;

          default: $having .=""; break;
        }

        if($j > 0){
          $having .= " AND";
        }
        $j--;
      }
    }
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $saldo = $this->db->query("SELECT GH.stok_berat, GH.stok_lembar, GH.kd_gd_hasil, CONCAT(GH.ukuran,' ',GH.merek,' ',GH.warna_plastik) AS nm_barang,
                                      (
                                       SUM(IF(TGH.status_history='MASUK' AND TGH.tgl_transaksi <= '$param[tglAwal]',TGH.jumlah_berat,0))-
                                       SUM(IF(TGH.status_history='KELUAR' AND TGH.tgl_transaksi <= '$param[tglAwal]',TGH.jumlah_berat,0))
                                      ) AS saldoAwalBerat,
                                      (
                                       SUM(IF(TGH.status_history='MASUK' AND TGH.tgl_transaksi <= '$param[tglAwal]',TGH.jumlah_lembar,0))-
                                       SUM(IF(TGH.status_history='KELUAR' AND TGH.tgl_transaksi <= '$param[tglAwal]',TGH.jumlah_lembar,0))
                                      ) AS saldoAwalLembar,

                                      SUM(IF(TGH.status_history='MASUK' AND
                                             TGH.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                             TGH.keterangan_history !='DATA AWAL',TGH.jumlah_berat,0)) AS totalBeratMasukPerPeriode,

                                      SUM(IF(TGH.status_history='KELUAR' AND
                                             TGH.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                             TGH.keterangan_history !='DATA AWAL',TGH.jumlah_berat,0)) AS totalBeratKeluarPerPeriode,

                                      SUM(IF(TGH.status_history='MASUK' AND
                                             TGH.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                             TGH.keterangan_history !='DATA AWAL',TGH.jumlah_lembar,0)) AS totalLembarMasukPerPeriode,

                                      SUM(IF(TGH.status_history='KELUAR' AND
                                             TGH.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                             TGH.keterangan_history !='DATA AWAL',TGH.jumlah_lembar,0)) AS totalLembarKeluarPerPeriode,
                                      (
                                        (
                                          SUM(IF(TGH.status_history='MASUK' AND TGH.tgl_transaksi <= '$param[tglAwal]',TGH.jumlah_berat,0))-
                                          SUM(IF(TGH.status_history='KELUAR' AND TGH.tgl_transaksi <= '$param[tglAwal]',TGH.jumlah_berat,0))
                                        ) -
                                        (
                                          (SUM(IF(TGH.status_history='MASUK' AND
                                                 TGH.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                                 TGH.keterangan_history !='DATA AWAL',TGH.jumlah_berat,0))) -
                                          (SUM(IF(TGH.status_history='KELUAR' AND
                                                 TGH.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                                 TGH.keterangan_history !='DATA AWAL',TGH.jumlah_berat,0)))
                                        )
                                      ) AS saldoAkhirBerat,

                                      (
                                        (
                                          SUM(IF(TGH.status_history='MASUK' AND TGH.tgl_transaksi <= '$param[tglAwal]',TGH.jumlah_lembar,0))-
                                          SUM(IF(TGH.status_history='KELUAR' AND TGH.tgl_transaksi <= '$param[tglAwal]',TGH.jumlah_lembar,0))
                                        ) -
                                        (
                                          (SUM(IF(TGH.status_history='MASUK' AND
                                                 TGH.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                                 TGH.keterangan_history !='DATA AWAL',TGH.jumlah_lembar,0))) -
                                          (SUM(IF(TGH.status_history='KELUAR' AND
                                                 TGH.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                                 TGH.keterangan_history !='DATA AWAL',TGH.jumlah_lembar,0)))
                                        )
                                      ) AS saldoAkhirLembar
                               FROM transaksi_gudang_hasil TGH
                               INNER JOIN gudang_hasil GH ON TGH.kd_gd_hasil = GH.kd_gd_hasil
                               WHERE $clause
                               AND TGH.tgl_transaksi BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                               AND TGH.deleted='FALSE'
                               AND TGH.status_transaksi = 'FINISH'
                               GROUP BY GH.kd_gd_hasil $having
                               ORDER BY GH.merek ASC, CAST(SUBSTRING_INDEX(GH.ukuran,'+',1) AS UNSIGNED) ASC")->result_array();

    $result = array("saldo" => $saldo);
    return json_encode($result);
  }
  #=========================Select Function (Finish)=========================#

  #=========================Update Function (Start)=========================#
  public function updateDetailPengiriman($param){
    $this->db->trans_begin();
    $this->db->where("id_detail_pengiriman",$param["id_detail_pengiriman"]);
    $this->db->update("transaksi_detail_pengiriman",$param);
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateGudangHasil($param){
    $this->db->trans_begin();
    $this->db->where("kd_gd_hasil",$param["kd_gd_hasil"]);
    $this->db->update("gudang_hasil",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateTransaksiGudangHasilAndDetailPengiriman($param){
    $this->db->trans_begin();
    #Check Pengiriman Atau Bukan
    $QCheckPengiriman = $this->db->query("SELECT id_detail_pengiriman FROM transaksi_gudang_hasil WHERE id_permintaan_jadi='$param[id_permintaan_jadi]'")->result_array();
    #Jika Pengiriman Maka Update Data Jumlah Berat Dan Jumlah Lembar Pada Tabel Transaksi_Detail_Pengiriman
    if(!empty($QCheckPengiriman[0]["id_detail_pengiriman"]) ||
       $QCheckPengiriman[0]["id_detail_pengiriman"] != "" ||
       $QCheckPengiriman[0]["id_detail_pengiriman"] != NULL ||
       $QCheckPengiriman[0]["id_detail_pengiriman"] != "NULL"
      ){
        if(array_key_exists("kd_gd_hasil",$param)){
          $idDetailPengiriman = $QCheckPengiriman[0]["id_detail_pengiriman"];
          if(array_key_exists("jumlah_terkirim",$param)){
            $this->db->query("UPDATE transaksi_detail_pengiriman SET kd_gd_hasil='$param[kd_gd_hasil]', jumlah_kg='$param[jumlah_berat]', jumlah_lembar='$param[jumlah_lembar]', jumlah_terkirim='$param[jumlah_terkirim]' WHERE id_detail_pengiriman='$idDetailPengiriman'");
          }else{
            $this->db->query("UPDATE transaksi_detail_pengiriman SET kd_gd_hasil='$param[kd_gd_hasil]', jumlah_kg='$param[jumlah_berat]', jumlah_lembar='$param[jumlah_lembar]' WHERE id_detail_pengiriman='$idDetailPengiriman'");
          }
        }else{
          $idDetailPengiriman = $QCheckPengiriman[0]["id_detail_pengiriman"];
          if(array_key_exists("jumlah_terkirim",$param)){
            $this->db->query("UPDATE transaksi_detail_pengiriman SET jumlah_kg='$param[jumlah_berat]', jumlah_lembar='$param[jumlah_lembar]', jumlah_terkirim='$param[jumlah_terkirim]' WHERE id_detail_pengiriman='$idDetailPengiriman'");
          }else{
            $this->db->query("UPDATE transaksi_detail_pengiriman SET jumlah_kg='$param[jumlah_berat]', jumlah_lembar='$param[jumlah_lembar]' WHERE id_detail_pengiriman='$idDetailPengiriman'");
          }
        }
    }
    $this->db->where("id_permintaan_jadi",$param["id_permintaan_jadi"]);
    $this->db->update("transaksi_gudang_hasil",array_diff_key($param,array_flip(array("jumlah_terkirim"))));
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
    $this->db->where("id_permintaan_jadi",$param["id_permintaan_jadi"]);
    $this->db->update("transaksi_gudang_hasil",$param);
    if($this->db->trans_status()==FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateTransaksiPengambilanSablon($param){
    $this->db->trans_begin();
    $this->db->where("id_pengambilan_sablon",$param["id_pengambilan_sablon"]);
    $this->db->update("transaksi_pengambilan_sablon",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateTransaksiDetailHistoryApal($param){
    $this->db->trans_begin();
    $this->db->where("id",$param["id"]);
    $this->db->update("transaksi_detail_history_apal",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateApproveKirimanDariBagian($param){
    $this->db->trans_begin();
    $errorCounter = 0;
    $successCounter = 0;
    $periodeLock = $this->db->query("SELECT DATE_FORMAT(tgl_transaksi, '%Y-%m') AS periode
                                     FROM transaksi_gudang_hasil
                                     WHERE bagian='$param[bagian]'
                                     AND status_history='MASUK'
                                     AND status_transaksi='PROGRESS'
                                     AND sts_approve='FALSE'
                                     AND sts_barang='$param[statusBarang]'
                                     AND merek !='HD'
                                     AND deleted = 'FALSE'
                                     GROUP BY DATE_FORMAT(tgl_transaksi, '%Y-%m')")->result_array();
    foreach ($periodeLock as $value) {
      $checkLock = $this->db->query("SELECT COUNT(id_permintaan_jadi) AS counter
                                     FROM transaksi_gudang_hasil
                                     WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$value[periode]'
                                     AND status_lock = 'TRUE'
                                     AND deleted='FALSE'")->result_array();
      if($checkLock[0]["counter"] > 0){
        $errorCounter++;
      }else{
        if(empty($param["jnsPermintaan"])){
          $arrDataForUpdateMaster = $this->db->query("SELECT id_permintaan_jadi, kd_gd_hasil,
                                                             jumlah_berat, jumlah_lembar,
                                                             status_history
                                                      FROM transaksi_gudang_hasil
                                                      WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$value[periode]'
                                                      AND deleted='FALSE'
                                                      AND status_transaksi='PROGRESS'
                                                      AND bagian = '$param[bagian]'
                                                      AND sts_barang = '$param[statusBarang]'
                                                      AND merek != 'HD'
                                                      AND sts_approve='FALSE'")->result_array();
        }else{
          $arrDataForUpdateMaster = $this->db->query("SELECT id_permintaan_jadi, kd_gd_hasil,
                                                             jumlah_berat, jumlah_lembar,
                                                             status_history
                                                      FROM transaksi_gudang_hasil
                                                      WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$value[periode]'
                                                      AND deleted='FALSE'
                                                      AND status_transaksi='PROGRESS'
                                                      AND bagian = '$param[bagian]'
                                                      AND sts_barang = '$param[statusBarang]'
                                                      AND jns_permintaan = '$param[jnsPermintaan]'
                                                      AND merek != 'HD'
                                                      AND sts_approve='FALSE'")->result_array();
        }
        foreach ($arrDataForUpdateMaster as $arrValue) {
          if($arrValue["status_history"] == "MASUK"){
            $this->db->set("stok_berat","stok_berat + ".$arrValue["jumlah_berat"], FALSE);
            $this->db->set("stok_lembar","stok_lembar + ".$arrValue["jumlah_lembar"], FALSE);
            $this->db->where("kd_gd_hasil",$arrValue["kd_gd_hasil"]);
            $this->db->update("gudang_hasil");
          }else{
            $this->db->set("stok_berat","stok_berat - ".$arrValue["jumlah_berat"], FALSE);
            $this->db->set("stok_lembar","stok_lembar - ".$arrValue["jumlah_lembar"], FALSE);
            $this->db->where("kd_gd_hasil",$arrValue["kd_gd_hasil"]);
            $this->db->update("gudang_hasil");
          }
        }

        $this->db->set("sts_approve", "TRUE");
        $this->db->set("status_transaksi", "FINISH");
        $this->db->where("deleted","FALSE");
        $this->db->where("status_transaksi","PROGRESS");
        $this->db->where("bagian","$param[bagian]");
        $this->db->where("sts_barang","$param[statusBarang]");
        if(!empty($param["jnsPermintaan"])){
          $this->db->where("jns_permintaan",$param["jnsPermintaan"]);
        }
        $this->db->where("merek != 'HD'");
        $this->db->where("sts_approve","FALSE");
        $this->db->where("DATE_FORMAT(tgl_transaksi, '%Y-%m') = ","$value[periode]");
        $this->db->update("transaksi_gudang_hasil");
        $successCounter++;
      }
    }

    if($successCounter > $errorCounter){
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }else if($successCounter == $errorCounter){
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil Beberapa";
      }
    }else{
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_rollback();
        return "Lock";
      }
    }
  }

  public function updateApproveKirimanUntukBufferSablon($param){
    $this->db->trans_begin();
    $errorCounter = 0;
    $successCounter = 0;
    $periodeLock = $this->db->query("SELECT DATE_FORMAT(tgl_transaksi,'%Y-%m') AS periode
                                     FROM transaksi_gudang_hasil
                                     WHERE kd_gd_hasil_secondary IS NOT NULL
                                     AND customer = 'GUDANG HASIL'
                                     AND bagian = 'SABLON'
                                     AND jns_permintaan = 'POLOS'
                                     AND sts_barang = '$param[stsBarang]'
                                     AND sts_approve = 'FALSE'
                                     AND status_history = 'KELUAR'
                                     AND status_transaksi = 'PROGRESS'
                                     AND keterangan_history = 'PENGAMBILAN SABLON ($param[stsBarang])'
                                     AND deleted = 'FALSE'
                                     GROUP BY DATE_FORMAT(tgl_transaksi,'%Y-%m')")->result_array();
    foreach ($periodeLock as $value) {
      $checkLock = $this->db->query("SELECT COUNT(id_permintaan_jadi) AS counter
                                     FROM transaksi_gudang_hasil
                                     WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$value[periode]'
                                     AND status_lock = 'TRUE'
                                     AND deleted='FALSE'")->result_array();
      if($checkLock[0]["periode"] > 0){
        $errorCounter++;
      }else{
        $arrDataForUpdateMaster = $this->db->query("SELECT id_permintaan_jadi, kd_gd_hasil, kd_gd_hasil_secondary,
                                                           ukuran, jumlah_berat, jumlah_lembar, tgl_transaksi, warna,
                                                           merek, sts_barang, keterangan_history, jns_permintaan,
                                                           customer
                                                    FROM transaksi_gudang_hasil
                                                    WHERE kd_gd_hasil_secondary IS NOT NULL
                                                    AND customer = 'GUDANG HASIL'
                                                    AND bagian = 'SABLON'
                                                    AND jns_permintaan = 'POLOS'
                                                    AND sts_barang = '$param[stsBarang]'
                                                    AND sts_approve = 'FALSE'
                                                    AND status_history = 'KELUAR'
                                                    AND status_transaksi = 'PROGRESS'
                                                    AND keterangan_history = 'PENGAMBILAN SABLON ($param[stsBarang])'
                                                    AND DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$value[periode]'
                                                    AND deleted = 'FALSE'")->result_array();
        foreach ($arrDataForUpdateMaster as $arrValue) {
          $this->db->set("stok_berat","stok_berat + ".$arrValue["jumlah_berat"], FALSE);
          $this->db->set("stok_lembar","stok_lembar + ".$arrValue["jumlah_lembar"], FALSE);
          $this->db->where("kd_gd_hasil", $arrValue["kd_gd_hasil_secondary"]);
          $this->db->update("gudang_hasil");

          $this->db->set("stok_berat","stok_berat - ".$arrValue["jumlah_berat"], FALSE);
          $this->db->set("stok_lembar","stok_lembar - ".$arrValue["jumlah_lembar"], FALSE);
          $this->db->where("kd_gd_hasil", $arrValue["kd_gd_hasil"]);
          $this->db->update("gudang_hasil");
        }
        $this->db->query("UPDATE transaksi_gudang_hasil
                          SET sts_approve='TRUE', status_transaksi='FINISH'
                          WHERE kd_gd_hasil_secondary IS NOT NULL
                          AND customer = 'GUDANG HASIL'
                          AND bagian = 'SABLON'
                          AND jns_permintaan = 'POLOS'
                          AND sts_barang = '$param[stsBarang]'
                          AND sts_approve = 'FALSE'
                          AND status_history = 'KELUAR'
                          AND status_transaksi = 'PROGRESS'
                          AND keterangan_history = 'PENGAMBILAN SABLON ($param[stsBarang])'
                          AND DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$value[periode]'
                          AND deleted = 'FALSE'");
        $successCounter++;
      }
    }

    if($successCounter > $errorCounter){
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }else if($successCounter == $errorCounter){
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil Beberapa";
      }
    }else{
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_rollback();
        return "Lock";
      }
    }
  }

  public function getListKembalianHDSablon(){
    $this->datatables->select("id_permintaan_jadi, tgl_transaksi, kd_gd_hasil, ukuran, warna, merek, jumlah_berat, jumlah_lembar");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("status_transaksi = 'PROGRESS' and sts_approve = 'FALSE' and merek ='HD' and   keterangan_history='KEMBALIAN DARI SABLON'");
    return $this->datatables->generate();
  }

  public function approveKembalianHDSablon(){
    $this->db->trans_begin();

    $hasil = $this->db->query("select kd_gd_hasil, jumlah_lembar, jumlah_berat from transaksi_gudang_hasil where keterangan_history='KEMBALIAN DARI SABLON' and sts_approve = 'FALSE' and status_transaksi = 'PROGRESS'");
      foreach ($hasil->result_array() as $value) {
        $kd_gd_hasil   = $value['kd_gd_hasil'];
        $jumlah_lembar = $value['jumlah_lembar'];
        $jumlah_berat  = $value['jumlah_berat'];
        $stok = $this->db->query("select kd_gd_hasil, stok_lembar, stok_berat from gudang_hasil where kd_gd_hasil = '$kd_gd_hasil'");
        foreach ($stok->result_array() as $s) {
          $kd_hasil     = $s['kd_gd_hasil'];
          $stok_berat   = $s['stok_berat'];
          $stok_lembar  = $s['stok_lembar'];

          $restok_berat  = $stok_berat + $jumlah_lembar;
          $restok_lembar = $stok_lembar + $jumlah_lembar;

          $this->db->set('stok_berat',$restok_berat);
          $this->db->set('stok_lembar',$restok_lembar);
          $this->db->where('kd_gd_hasil',$kd_hasil);
          $this->db->update('gudang_hasil');
        }
      }

    $this->db->query("update transaksi_gudang_hasil set sts_approve = 'TRUE', status_transaksi = 'FINISH' where keterangan_history='KEMBALIAN DARI SABLON' and sts_approve = 'FALSE' and status_transaksi = 'PROGRESS'");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      echo $restok_berat;
    }else{
      $this->db->trans_commit();
      echo $kd_hasil;
    }
  }

  public function getListDataBarangRetur($stsBarang){
    $this->datatables->select("id_permintaan_jadi, kd_gd_hasil, ukuran, merek, warna, jumlah_berat, jumlah_lembar, tgl_transaksi, customer, sts_barang");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("bagian='PENGIRIMAN' and status_transaksi = 'PROGRESS' and keterangan_history = 'PENGEMBALIAN BARANG' and deleted='FALSE' and sts_barang = '$stsBarang'");
    return $this->datatables->generate();
  }

  public function approveReturBarang($jenis){
    $this->db->trans_begin();

    $list = $this->db->query("select kd_gd_hasil, jumlah_berat, jumlah_lembar, sts_barang from transaksi_gudang_hasil where bagian='PENGIRIMAN' and status_transaksi = 'PROGRESS' and keterangan_history = 'PENGEMBALIAN BARANG' and deleted='FALSE' and sts_barang = '$jenis'");
    foreach ($list->result_array() as $value) {
      $this->db->set("stok_berat","`stok_berat`+$value[jumlah_berat]", FALSE);
      $this->db->set("stok_lembar","`stok_lembar`+$value[jumlah_lembar]", FALSE);
      $this->db->where("kd_gd_hasil",$value["kd_gd_hasil"]);
      $this->db->update("gudang_hasil");
    }

    $this->db->query("update transaksi_gudang_hasil set status_transaksi = 'FINISH' where bagian='PENGIRIMAN' and status_transaksi='PROGRESS' and keterangan_history='PENGEMBALIAN BARANG' and sts_barang='$jenis' and deleted='FALSE'");

    if ($this->db->trans_status()===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function countReturBarang($jenis){
    $data = $this->db->query("select kd_gd_hasil from transaksi_gudang_hasil where bagian='PENGIRIMAN' and status_transaksi = 'PROGRESS' and keterangan_history = 'PENGEMBALIAN BARANG' and deleted='FALSE' and sts_barang = '$jenis'");
    return $data->num_rows();
  }

  public function getBahanSablon($jenis){
    $data = $this->db->query("select a.kd_gd_bahan, a.nm_barang, a.warna, a.status, a.jenis from gudang_bahan a left join gudang_bahan_sablon b on a.kd_gd_bahan = b.kd_gd_bahan and a.deleted = 'FALSE' where a.jenis = '$jenis' and b.kd_gd_bahan is null ")->result_array();
    return json_encode($data);
  }

  public function searchBahanSablon($key,$jenis){
    $data = $this->db->query("select a.kd_gd_bahan, a.nm_barang, a.warna, a.status, a.jenis from gudang_bahan a left join gudang_bahan_sablon b on a.kd_gd_bahan = b.kd_gd_bahan and a.deleted = 'FALSE' where concat(a.kd_gd_bahan,' ',a.nm_barang,' ',a.warna,' ',a.status) REGEXP '$key' and a.jenis = '$jenis' and b.kd_gd_bahan is null order by a.nm_barang asc")->result_array();
    return json_encode($data);
  }

  public function getBahanSablonFull($jenis){
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status, jenis from gudang_bahan where jenis = '$jenis' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function searchBahanSablonFull($key,$jenis){
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status, jenis from gudang_bahan where concat(kd_gd_bahan,' ',nm_barang,' ',warna,' ',status) REGEXP '$key' and jenis = '$jenis' order by nm_barang asc")->result_array();
    return json_encode($data);
  }

  public function genKodeBahanSablon(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_bahan_sablon,3)) AS kode FROM gudang_bahan_sablon");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "00";
      }
      $tempCode = "00".(intval($arrMaxCode->kode)+1);
      $fixCode = "BHS".date("ymd").substr($tempCode,(strlen($tempCode)-3));
    }
    return $fixCode;
  }

  public function addBahanSablon($data){
    $this->db->trans_begin();
    $this->db->insert("gudang_bahan_sablon", $data);
    if ($this->db->trans_status()===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function getTempDataBahanSablon(){
    $data = $this->db->query("select kd_bahan_sablon, kd_gd_bahan, tanggal, nm_bahan, warna, status_barang, stok from gudang_bahan_sablon where status = 'pending'")->result_array();
    return json_encode($data);
  }

  public function countListTambahBahanSablon(){
    $data = $this->db->query("select kd_bahan_sablon, kd_gd_bahan, tanggal, nm_bahan, warna, status_barang, stok from gudang_bahan_sablon where status = 'pending'");
    return $data->num_rows();
  }

  public function deleteListTempBahanSablon($id){
    $this->db->trans_begin();
    $this->db->query("delete from gudang_bahan_sablon where kd_bahan_sablon = '$id'");
    if ($this->db->trans_status()===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function saveBahanSablon(){
    $this->db->trans_begin();
    $this->db->set("status","FINISH");
    $this->db->update("gudang_bahan_sablon");
    $this->db->where("status","PENDING");
    if ($this->db->trans_status()===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function getListBahanSablon(){
    $this->datatables->select("kd_bahan_sablon, kd_gd_bahan, nm_bahan, warna, status_barang, stok, jenis");
    $this->datatables->from("gudang_bahan_sablon");
    $this->datatables->where("status='FINISH' and deleted='FALSE'");

    return $this->datatables->generate();
  }

  public function countKirimanBahanSablon(){
    $data = $this->db->query("SELECT kd_gd_bahan
                              FROM transaksi_gudang_bahan
                              WHERE (bagian = 'gudang bahan'
                              AND status = 'WAITING APPROVE'
                              AND status_history = 'KELUAR'
                              AND keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))')
                              OR (bagian = 'gudang bahan'
                              AND status = 'WAITING APPROVE'
                              AND status_history = 'KELUAR'
                              AND keterangan_history = 'PENGELUARAN KE SABLON')
                              AND deleted='FALSE'");
    return $data->num_rows();
  }

  public function getDataKirimanBahanSablon(){
    $data = $this->db->query("select a.tgl_permintaan, a.jumlah_permintaan, b.kd_gd_bahan, b.nm_barang, b.jenis, b.status, b.warna from transaksi_gudang_bahan a join gudang_bahan b on a.kd_gd_bahan = b.kd_gd_bahan where (a.bagian = 'gudang bahan' and a.status = 'WAITING APPROVE' and a.status_history = 'KELUAR' and a.keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))' and a.deleted ='FALSE') or (a.bagian = 'gudang bahan' and a.status = 'WAITING APPROVE' and a.status_history = 'KELUAR' and a.keterangan_history = 'PENGELUARAN KE SABLON' and a.deleted ='FALSE' )")->result_array();
    return json_encode($data);
  }

  public function approveKirimanBahanSablon(){
    $this->db->trans_begin();

    $kiriman = $this->db->query("select a.id ,a.tgl_permintaan, a.jumlah_permintaan, b.kd_gd_bahan, b.nm_barang, b.jenis, b.status, b.warna from transaksi_gudang_bahan a join gudang_bahan b on a.kd_gd_bahan = b.kd_gd_bahan where (a.bagian = 'gudang bahan' and a.status = 'WAITING APPROVE' and a.status_history = 'KELUAR' and a.keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))' and a.deleted ='FALSE') or (a.bagian = 'gudang bahan' and a.status = 'WAITING APPROVE' and a.status_history = 'KELUAR' and a.keterangan_history = 'PENGELUARAN KE SABLON' and a.deleted='FALSE')");
    $bahanSablon = $this->db->query("select kd_gd_bahan from gudang_bahan_sablon where deleted='FALSE'");

    foreach ($kiriman->result_array() as $value) {
      foreach ($bahanSablon->result_array() as  $stok) {
        if ($value["kd_gd_bahan"]==$stok["kd_gd_bahan"]) {
          $this->db->set("stok", "`stok`+$value[jumlah_permintaan]",FALSE);
          $this->db->where("kd_gd_bahan",$value["kd_gd_bahan"]);
          $this->db->update("gudang_bahan_sablon");

          $this->db->set("status","FINISH");
          $this->db->where("id",$value["id"]);
          $this->db->update("transaksi_gudang_bahan");
        }
      }
    }

    if ($this->db->trans_status()===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function deleteBahanSablon($id){
    $this->db->trans_begin();
    $this->db->set("deleted","TRUE");
    $this->db->where("kd_bahan_sablon",$id);
    $this->db->update("gudang_bahan_sablon");

    if ($this->db->trans_status()===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function getDataBahanSablonPerId($id){
    $data = $this->db->query("SELECT kd_bahan_sablon, kd_gd_bahan, nm_bahan, warna, jenis, stok
                              FROM gudang_bahan_sablon
                              WHERE kd_bahan_sablon = '$id'")->result_array();
     return json_encode($data);
  }

  public function updateListBahanSablon($id,$stok){
    $this->db->trans_begin();

    $this->db->set("stok",$stok);
    $this->db->where("kd_bahan_sablon",$id);
    $this->db->update("gudang_bahan_sablon");

    if ($this->db->trans_status()===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function getListHistoryBahanSablonKeluar($data){
    $this->datatables->select("a.kd_hasil_sablon,a.kd_gd_bahan, a.jumlah_pengambilan, a.sisa_pengambilan, (a.jumlah_pengambilan-a.sisa_pengambilan) as pemakaian, b.nm_barang, c.ukuran, c.merek, c.tanggal");
    $this->datatables->from("transaksi_penggunaan_bahan_sablon a");
    $this->datatables->join("gudang_bahan b", "a.kd_gd_bahan = b.kd_gd_bahan", "INNER");
    $this->datatables->join("transaksi_hasil_sablon c"," a.kd_hasil_sablon = c.kd_hasil_sablon", "LEFT");
    $this->datatables->where("a.kd_gd_bahan='$data[nm_bahan]' AND c.tanggal between '$data[tglAwal]'
                              AND '$data[tglAkhir]' AND c.status_bon = 'TRUE'");
    return $this->datatables->generate();
  }

  public function getListHistoryBahanSablonMasuk($data){
    $this->datatables->select("kd_gd_bahan, jumlah_permintaan, tgl_permintaan, keterangan_history");
    $this->datatables->from("transaksi_gudang_bahan");
    $this->datatables->where("((bagian = 'gudang bahan' AND status = 'Finish'
                                AND status_history = 'KELUAR'
                                AND keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))'
                                AND kd_gd_bahan='$data[nm_bahan]'
                                AND tgl_permintaan between '$data[tglAwal]'
                                AND '$data[tglAkhir]')
                                OR (bagian = 'gudang bahan'
                                AND status = 'Finish'
                                AND status_history = 'KELUAR'
                                AND keterangan_history = 'PENGELUARAN KE SABLON'
                                AND kd_gd_bahan='$data[nm_bahan]'
                                AND tgl_permintaan between '$data[tglAwal]'
                                AND '$data[tglAkhir]'))");

    return $this->datatables->generate();
  }

  public function getDetailHistoryBahanSablon($data){
    $pengambilan = $this->db->query("SELECT SUM(jumlah_permintaan) AS pengambilanSablon
                                     FROM transaksi_gudang_bahan
                                     WHERE (bagian = 'gudang bahan'
                                     AND status = 'Finish'
                                     AND status_history = 'KELUAR'
                                     AND keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))'
                                     AND kd_gd_bahan='$data[nm_bahan]'
                                     AND tgl_permintaan BETWEEN '$data[tglAwal]' AND '$data[tglAkhir]')
                                     OR (bagian = 'gudang bahan'
                                     AND status = 'Finish'
                                     AND status_history = 'KELUAR'
                                     AND keterangan_history = 'PENGELUARAN KE SABLON'
                                     AND kd_gd_bahan='$data[nm_bahan]'
                                     AND tgl_permintaan BETWEEN '$data[tglAwal]' AND '$data[tglAkhir]')")->result_array();

    $pemakaian = $this->db->query("SELECT SUM(a.jumlah_pengambilan-a.sisa_pengambilan) AS totalPemakaian,
                                          SUM(a.jumlah_pengambilan) AS totalPengambilan,
                                          SUM(a.sisa_pengambilan) AS totalSisa, b.nm_barang, b.warna
                                   FROM `transaksi_penggunaan_bahan_sablon` a
                                   INNER JOIN gudang_bahan b ON a.kd_gd_bahan = b.kd_gd_bahan
                                   LEFT JOIN transaksi_hasil_sablon c ON a.`kd_hasil_sablon` = c.`kd_hasil_sablon`
                                   WHERE a.kd_gd_bahan='$data[nm_bahan]'
                                   AND c.tanggal BETWEEN '$data[tglAwal]' AND '$data[tglAkhir]'
                                   AND c.status_bon = 'TRUE'")->result_array();

    $lastPemakaian = $this->db->query("SELECT SUM(a.jumlah_pengambilan-a.sisa_pengambilan) AS totalPemakaian,
                                              SUM(a.jumlah_pengambilan) AS totalPengambilan,
                                              SUM(a.sisa_pengambilan) AS totalSisa,
                                              b.nm_barang, b.warna
                                       FROM `transaksi_penggunaan_bahan_sablon` a
                                       INNER JOIN gudang_bahan b ON a.kd_gd_bahan = b.kd_gd_bahan
                                       LEFT JOIN transaksi_hasil_sablon c ON a.`kd_hasil_sablon` = c.`kd_hasil_sablon`
                                       WHERE a.kd_gd_bahan='$data[nm_bahan]'
                                       AND c.tanggal < '$data[tglAwal]'
                                       AND c.status_bon = 'TRUE'")->result_array();

    $lastPengambilan = $this->db->query("SELECT SUM(jumlah_permintaan) AS pengambilanSablon
                                         FROM transaksi_gudang_bahan
                                         WHERE (bagian = 'gudang bahan'
                                         AND status = 'FINISH'
                                         AND status_history = 'KELUAR'
                                         AND keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))'
                                         AND kd_gd_bahan='$data[nm_bahan]'
                                         AND tgl_permintaan < '$data[tglAwal]')
                                         OR (bagian = 'gudang bahan'
                                         AND status = 'FINISH'
                                         AND status_history = 'KELUAR'
                                         AND keterangan_history = 'PENGELUARAN KE SABLON'
                                         AND kd_gd_bahan='$data[nm_bahan]'
                                         AND tgl_permintaan < '$data[tglAwal]')")->result_array();

    $result = array();
    $result["nm_bahan"]  = $pemakaian[0]["nm_barang"];
    $result["warna"]     = $pemakaian[0]["warna"];
    $result["saldoAwal"] = round($lastPengambilan[0]["pengambilanSablon"] - $lastPemakaian[0]["totalPemakaian"],2);
    $result["totalPengambilan"] = round($pengambilan[0]["pengambilanSablon"],2);
    $result["totalPemakaian"] = round($pemakaian[0]["totalPemakaian"],2);
    $result["saldoAkhir"] = round(($lastPengambilan[0]["pengambilanSablon"] - $lastPemakaian[0]["totalPemakaian"]) + $pengambilan[0]["pengambilanSablon"] -$pemakaian[0]["totalPemakaian"],2);
    return json_encode($result);
  }

  public function addPermintaanBahanSablon($data){
    $this->db->trans_begin();
    $this->db->insert("transaksi_gudang_bahan",$data);
    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function getPermintaanBahanSablon($jenis){
    $data = $this->db->query("SELECT a.kd_gd_bahan, a.nm_barang, a.warna, a.status, a.jenis
                              FROM gudang_bahan a
                              JOIN gudang_bahan_sablon b ON a.kd_gd_bahan = b.kd_gd_bahan
                              AND a.deleted = 'FALSE'
                              WHERE a.jenis = '$jenis'")->result_array();
    return json_encode($data);
  }

  public function searchPermintaanBahanSablon($key,$jenis){
    $data = $this->db->query("SELECT a.kd_gd_bahan, a.nm_barang, a.warna, a.status, a.jenis
                              FROM gudang_bahan a
                              JOIN gudang_bahan_sablon b ON a.kd_gd_bahan = b.kd_gd_bahan
                              AND a.deleted = 'FALSE'
                              WHERE concat(a.kd_gd_bahan,' ',a.nm_barang,' ',a.warna,' ',a.status) REGEXP '$key'
                              AND a.jenis = '$jenis'
                              ORDER BY a.nm_barang ASC")->result_array();
    return json_encode($data);
  }

  public function getTempDataPermintaanBahanSablon(){
    $data = $this->db->query("SELECT a.id, a.kd_gd_bahan, a.jumlah_permintaan,
                                     a.tgl_permintaan, b.nm_barang, b.warna, b.jenis
                              FROM transaksi_gudang_bahan a
                              JOIN gudang_bahan b ON a.kd_gd_bahan = b.kd_gd_bahan
                              WHERE (a.bagian ='SABLON'
                              AND a.status = 'PENDING'
                              AND a.status_history = 'KELUAR'
                              AND a.keterangan_history = 'PENGELUARAN KE SABLON'
                              AND a.deleted='FALSE')
                              OR (a.bagian ='SABLON'
                              AND a.status = 'PENDING'
                              AND a.status_history = 'KELUAR'
                              AND a.keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))'
                              AND a.deleted='FALSE')")->result_array();
    return json_encode($data);
  }

  public function countPermintaanBahanSablonPending(){
    $data = $this->db->query("SELECT a.id, a.kd_gd_bahan, a.jumlah_permintaan,
                                     a.tgl_permintaan, b.nm_barang, b.warna, b.jenis
                              FROM transaksi_gudang_bahan a
                              JOIN gudang_bahan b ON a.kd_gd_bahan = b.kd_gd_bahan
                              WHERE (a.bagian ='SABLON'
                              AND a.status = 'PENDING'
                              AND a.status_history = 'KELUAR'
                              AND a.keterangan_history = 'PENGELUARAN KE SABLON'
                              AND a.deleted='FALSE')
                              OR (a.bagian ='SABLON'
                              AND a.status = 'PENDING'
                              AND a.status_history = 'KELUAR'
                              AND a.keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))'
                              AND a.deleted='FALSE')");
    return $data->num_rows();
  }

  public function deleteListPermintaanBahanSablon($id){
    $this->db->trans_begin();
    $this->db->query("delete from transaksi_gudang_bahan where id = '$id'");
    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function kirimPermintaanBahanSablon(){
    $this->db->trans_begin();
    $this->db->query("update transaksi_gudang_bahan set status = 'WAITING APPROVE' where (bagian ='SABLON' and status = 'PENDING' and status_history = 'KELUAR' and keterangan_history = 'PENGELUARAN KE SABLON' and deleted='FALSE') or (bagian ='SABLON' and status = 'PENDING' and status_history = 'KELUAR' and keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))' and deleted='FALSE')");
    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function deletedListRetur($id){
    $this->db->trans_begin();
    $this->db->query("delete from transaksi_gudang_hasil where id_permintaan_jadi = '$id'");

    if ($this->db->trans_status()===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }

  }

  public function getListDetailHasilJadi($tglAwal,$tglAkhir){
    $this->datatables->select("id_permintaan_jadi, tgl_transaksi, kd_gd_hasil,
                               ukuran, merek, warna, jns_permintaan, customer,
                               jumlah_berat, jumlah_lembar, sts_barang, status_history, keterangan_history");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("status_transaksi = 'FINISH' AND deleted = 'FALSE' AND tgl_transaksi BETWEEN '$tglAwal' AND '$tglAkhir'");
    $this->db->order_by("ukuran, merek, warna, sts_barang, status_history");
    return $this->datatables->generate();
  }

  public function getKirimanPotongPerId($id){
    $data = $this->db->query("SELECT id_permintaan_jadi, ukuran, warna, merek,
                                     customer, jumlah_lembar, jumlah_berat,
                                     tgl_transaksi, sts_barang
                              FROM transaksi_gudang_hasil
                              WHERE id_permintaan_jadi = '$id'
                              AND deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function kirimBalikKiriman($id,$note){
    $this->db->trans_begin();

    $this->db->set("note_gudanghasil",$note);
    $this->db->set("status_transaksi","SEND BACK");
    $this->db->where("id_permintaan_jadi",$id);
    $this->db->update("transaksi_gudang_hasil");

    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function countKirimanBarang($data){
    if (empty($data["jnsPermintaan"])) {
      $data = $this->db->query("SELECT id_permintaan_jadi FROM transaksi_gudang_hasil WHERE bagian='$data[bagian]' AND
                                status_history='MASUK' AND
                                status_transaksi='PROGRESS' AND
                                sts_approve='FALSE' AND
                                sts_barang='$data[stsBarang]' AND
                                merek !='HD' AND
                                deleted = 'FALSE'");
      return $data->num_rows();
    }else{
      $data = $this->db->query("SELECT id_permintaan_jadi FROM transaksi_gudang_hasil WHERE bagian='$data[bagian]' AND
                                status_history='MASUK' AND
                                status_transaksi='PROGRESS' AND
                                sts_approve='FALSE' AND
                                sts_barang='$data[stsBarang]' AND
                                jns_permintaan = '$data[jnsPermintaan]' AND
                                merek !='HD' AND
                                deleted = 'FALSE'");
      return $data->num_rows();
    }
  }

  public function countKembalianHDSablon(){
    $data = $this->db->query("SELECT id_permintaan_jadi
                              FROM transaksi_gudang_hasil
                              WHERE status_transaksi = 'PROGRESS'
                              AND sts_approve = 'FALSE'
                              AND merek ='HD'
                              AND keterangan_history='KEMBALIAN DARI SABLON'");
    return $data->num_rows();
  }

  public function updateDataOrderTerkirim($data){
    $this->db->trans_begin();

    $pesanan = $this->db->query("SELECT a.jumlah_terkirim, a.id_detail_pengiriman,
                                        b.no_order, b.id_dp, b.jumlah, b.jumlah_kirim
                                 FROM transaksi_detail_pengiriman a
                                 JOIN pesanan_detail b ON a.id_dp = b.id_dp
                                 WHERE a.id_detail_pengiriman = '$data[id]'")->result_array();
    $jumlahOrder = $pesanan[0]["jumlah"];
    $jumlahKirim = $pesanan[0]["jumlah_kirim"];
    $newJumlahKirim = ($jumlahKirim - $data["jumlah_sebelum"]) + $data["jumlah_kirim"];

    if ($jumlahOrder > $newJumlahKirim) {
      $this->db->set("sts_pesanan","PROGRESS");
      $this->db->where("no_order",$pesanan[0]["no_order"]);
      $this->db->update("pesanan");
    }

    $this->db->set("jumlah_kirim",$newJumlahKirim);
    $this->db->where("id_dp",$pesanan[0]["id_dp"]);
    $this->db->update("pesanan_detail");

    $this->db->set("jumlah_kg",$data['jumlah_berat']);
    $this->db->set("jumlah_lembar",$data['jumlah_lembar']);
    $this->db->set("jumlah_terkirim",$data['jumlah_kirim']);
    $this->db->where("id_detail_pengiriman",$data['id']);
    $this->db->update("transaksi_detail_pengiriman");

    $this->db->set("jumlah_berat",$data['jumlah_berat']);
    $this->db->set("jumlah_lembar",$data['jumlah_lembar']);
    $this->db->where("id_detail_pengiriman",$pesanan[0]["id_detail_pengiriman"]);
    $this->db->update("transaksi_gudang_hasil");

    if ($this->db->trans_status===Failed) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function deleteDataOrderTerkirim($id){
    $this->db->trans_begin();

    $pesanan = $this->db->query("SELECT a.jumlah_terkirim, a.id_detail_pengiriman,
                                        b.no_order, b.id_dp, b.jumlah, b.jumlah_kirim
                                 FROM transaksi_detail_pengiriman a
                                 JOIN pesanan_detail b ON a.id_dp = b.id_dp
                                 WHERE a.id_detail_pengiriman = '$id'")->result_array();
    $jumlahOrder = $pesanan[0]["jumlah"];
    $newJumlahKirim = $pesanan[0]["jumlah_kirim"] - $pesanan[0]["jumlah_terkirim"];

    $this->db->set("jumlah_kirim",$newJumlahKirim);
    $this->db->set("sts_pesanan","PROGRESS");
    $this->db->where("id_dp",$pesanan[0]["id_dp"]);
    $this->db->update("pesanan_detail");

    $this->db->set("sts_pesanan","PROGRESS");
    $this->db->where("no_order",$pesanan[0]["no_order"]);
    $this->db->update("pesanan");

    $this->db->set("deleted","TRUE");
    $this->db->where("id_detail_pengiriman",$id);
    $this->db->update("transaksi_detail_pengiriman");

    $this->db->set("deleted","TRUE");
    $this->db->where("id_detail_pengiriman",$pesanan[0]["id_detail_pengiriman"]);
    $this->db->update("transaksi_gudang_hasil");

    if ($this->db->trans_status()===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function updateStatus($id,$status){
    $this->db->trans_begin();

    if ($status=="Open") {

    }else{
      $this->db->set("sts_kirim","TERKIRIM");
      $this->db->set("jumlah_kirim","`jumlah`",false);
      $this->db->where("id_dp",$id);
      $this->db->update("pesanan_detail");

      if ($this->db->trans_status()===FALSE) {
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function updateGudangBahan($param){
    $this->db->trans_begin();
    $this->db->where("kd_gd_bahan",$param["kd_gd_bahan"]);
    $this->db->update("gudang_bahan",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateTransaksiGudangBahan($param){
    $this->db->trans_begin();
    $this->db->where("id",$param["id"]);
    $this->db->update("transaksi_gudang_bahan",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateTransaksiGudangBahanAndStok($param){
    $this->db->trans_begin();
    $this->db->query("UPDATE transaksi_gudang_bahan SET `status`='$param[status]'
                      WHERE id='$param[id]'");
    if($param["statusHistory"] == "MASUK"){
      $this->db->query("UPDATE gudang_bahan SET stok = stok + $param[jumlah]
                        WHERE kd_gd_bahan = '$param[kdGdBahan]'");
    }else{
      $this->db->query("UPDATE gudang_bahan SET stok = stok - $param[jumlah]
                        WHERE kd_gd_bahan = '$param[kdGdBahan]'");
    }
    $QCheck = $this->db->query("SELECT kd_gd_bahan
                                FROM gudang_buffer_extruder
                                WHERE kd_gd_bahan='$param[kdGdBahan]'")->result_array();
    if(count($QCheck) > 0){
      if($param["statusHistory"] == "MASUK"){
        $this->db->query("UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok - $param[jumlah]
                          WHERE kd_gd_bahan='$param[kdGdBahan]'");
      }else{
        $this->db->query("UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok + $param[jumlah]
                          WHERE kd_gd_bahan='$param[kdGdBahan]'");
      }
    }else{
      if($param["statusHistory"] == "MASUK"){
        $this->db->query("UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok - $param[jumlah]
                          WHERE jenis='BAHAN BAKU' AND status='LOKAL'");
      }else{
        $this->db->query("UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok + $param[jumlah]
                          WHERE jenis='BAHAN BAKU' AND status='LOKAL'");
      }
    }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateTerimaBarangFull($param){
    $this->db->trans_begin();
    $arrJnsBarang = $this->db->query("SELECT jenis
                                      FROM gudang_bahan
                                      WHERE kd_gd_bahan = '".$param["TGB"]["kd_gd_bahan"]."'")->result_array();
    $QCheckLock = "SELECT COUNT(TGB.id) AS counter
                   FROM transaksi_gudang_bahan TGB
                   INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                   WHERE GB.jenis='".$arrJnsBarang[0]["jenis"]."'
                   AND MONTH(TGB.tgl_permintaan) = '".date("m",strtotime($param["TGB"]["tgl_permintaan"]))."'
                   AND YEAR(TGB.tgl_permintaan) = '".date("Y",strtotime($param["TGB"]["tgl_permintaan"]))."'
                   AND TGB.status_lock = 'TRUE'
                   AND TGB.deleted = 'FALSE'";
    $arrCheckLock = $this->db->query($QCheckLock)->result_array();
    if($arrCheckLock[0]["counter"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert("transaksi_gudang_bahan",$param["TGB"]);
      $this->db->insert("transaksi_bukti_penerimaan_barang",$param["TBPB"]);

      $this->db->set("stok","stok + ".$param["TGB"]["jumlah_permintaan"], FALSE);
      $this->db->where("kd_gd_bahan",$param["TGB"]["kd_gd_bahan"]);
      $this->db->update("gudang_bahan");

      $arrDetailPermintaan = $this->db->query("SELECT (jumlah_permintaan - jumlah_terima) AS jumlah_permintaan
                                               FROM transaksi_detail_permintaan_barang
                                               WHERE id_dpb = '".$param["TDPB"]["id_dpb"]."'")->result_array();
      $this->db->set("status_permintaan","FINISH");
      $this->db->set("jumlah_terima","jumlah_terima + ".$arrDetailPermintaan[0]["jumlah_permintaan"], FALSE);
      $this->db->where("id_dpb",$param["TDPB"]["id_dpb"]);
      $this->db->update("transaksi_detail_permintaan_barang");

      $QCheckTotalItemTDPB = "SELECT COUNT(id_dpb) AS counter
                              FROM transaksi_detail_permintaan_barang
                              WHERE kd_permintaan_barang = '".$param["TDPB"]["kd_permintaan_barang"]."'
                              AND deleted='FALSE'
                              AND status_permintaan != 'CANCEL'";

      $QCheckTotalItemFinishTDPB = "SELECT COUNT(id_dpb) AS counter
                                    FROM transaksi_detail_permintaan_barang
                                    WHERE kd_permintaan_barang = '".$param["TDPB"]["kd_permintaan_barang"]."'
                                    AND deleted='FALSE'
                                    AND status_permintaan = 'FINISH'";

      $arrTotalItemTDPB = $this->db->query($QCheckTotalItemTDPB)->result_array();
      $arrTotalItemFinishTDPB = $this->db->query($QCheckTotalItemFinishTDPB)->result_array();

      if($arrTotalItemFinishTDPB[0]["counter"] >= $arrTotalItemTDPB[0]["counter"]){
        $this->db->set("status_permintaan","FINISH");
        $this->db->where("kd_permintaan_barang",$param["TDPB"]["kd_permintaan_barang"]);
        $this->db->update("transaksi_permintaan_barang");
      }

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function updateTerimaBarangSetengah($param){
    $this->db->trans_begin();
    $arrJnsBarang = $this->db->query("SELECT jenis
                                      FROM gudang_bahan
                                      WHERE kd_gd_bahan = '".$param["TGB"]["kd_gd_bahan"]."'")->result_array();
    $QCheckLock = "SELECT COUNT(TGB.id) AS counter
                   FROM transaksi_gudang_bahan TGB
                   INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                   WHERE GB.jenis='".$arrJnsBarang[0]["jenis"]."'
                   AND MONTH(TGB.tgl_permintaan) = '".date("m",strtotime($param["TGB"]["tgl_permintaan"]))."'
                   AND YEAR(TGB.tgl_permintaan) = '".date("Y",strtotime($param["TGB"]["tgl_permintaan"]))."'
                   AND TGB.status_lock = 'TRUE'
                   AND TGB.deleted = 'FALSE'";
    $arrCheckLock = $this->db->query($QCheckLock)->result_array();
    if($arrCheckLock[0]["counter"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert("transaksi_gudang_bahan",$param["TGB"]);
      $this->db->insert("transaksi_bukti_penerimaan_barang",$param["TBPB"]);

      $this->db->set("stok","stok + ".$param["TGB"]["jumlah_permintaan"], FALSE);
      $this->db->where("kd_gd_bahan",$param["TGB"]["kd_gd_bahan"]);
      $this->db->update("gudang_bahan");

      $arrDetailPermintaan = $this->db->query("SELECT jumlah_permintaan
                                               FROM transaksi_detail_permintaan_barang
                                               WHERE id_dpb = '".$param["TDPB"]["id_dpb"]."'")->result_array();

      $this->db->set("jumlah_terima","jumlah_terima + ".$param["TDPB"]["jumlah_terima"], FALSE);
      $this->db->where("id_dpb",$param["TDPB"]["id_dpb"]);
      $this->db->update("transaksi_detail_permintaan_barang");

      $QCheckJumlahPermintaan = "SELECT IF(jumlah_terima >= jumlah_permintaan,'TRUE','FALSE') AS indikator
                                 FROM transaksi_detail_permintaan_barang
                                 WHERE id_dpb = '".$param["TDPB"]["id_dpb"]."'";
      $arrCheckJumlahPermintaan = $this->db->query($QCheckJumlahPermintaan)->result_array();

      if($arrCheckJumlahPermintaan[0]["indikator"] == "TRUE"){
        $this->db->set("status_permintaan","FINISH");
        $this->db->where("id_dpb",$param["TDPB"]["id_dpb"]);
        $this->db->update("transaksi_detail_permintaan_barang");
      }

      $QCheckTotalItemTDPB = "SELECT COUNT(id_dpb) AS counter
                              FROM transaksi_detail_permintaan_barang
                              WHERE kd_permintaan_barang = '".$param["TDPB"]["kd_permintaan_barang"]."'
                              AND deleted='FALSE'
                              AND status_permintaan != 'CANCEL'";

      $QCheckTotalItemFinishTDPB = "SELECT COUNT(id_dpb) AS counter
                                    FROM transaksi_detail_permintaan_barang
                                    WHERE kd_permintaan_barang = '".$param["TDPB"]["kd_permintaan_barang"]."'
                                    AND deleted='FALSE'
                                    AND status_permintaan = 'FINISH'";

      $arrTotalItemTDPB = $this->db->query($QCheckTotalItemTDPB)->result_array();
      $arrTotalItemFinishTDPB = $this->db->query($QCheckTotalItemFinishTDPB)->result_array();

      if($arrTotalItemFinishTDPB[0]["counter"] >= $arrTotalItemTDPB[0]["counter"]){
        $this->db->set("status_permintaan","FINISH");
        $this->db->where("kd_permintaan_barang",$param["TDPB"]["kd_permintaan_barang"]);
        $this->db->update("transaksi_permintaan_barang");
      }

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function updateSelesaiPermintaan($param){
    $this->db->trans_begin();
    $this->db->set("status_permintaan","FINISH");
    $this->db->where("id_dpb",$param["id_dpb"]);
    $this->db->update("transaksi_detail_permintaan_barang");

    $QCheckTotalItemTDPB = "SELECT COUNT(id_dpb) AS counter
                            FROM transaksi_detail_permintaan_barang
                            WHERE kd_permintaan_barang = '$param[kd_permintaan]'
                            AND deleted='FALSE'
                            AND status_permintaan != 'CANCEL'";

    $QCheckTotalItemFinishTDPB = "SELECT COUNT(id_dpb) AS counter
                                  FROM transaksi_detail_permintaan_barang
                                  WHERE kd_permintaan_barang = '$param[kd_permintaan]'
                                  AND deleted='FALSE'
                                  AND status_permintaan = 'FINISH'";

    $arrTotalItemTDPB = $this->db->query($QCheckTotalItemTDPB)->result_array();
    $arrTotalItemFinishTDPB = $this->db->query($QCheckTotalItemFinishTDPB)->result_array();

    if($arrTotalItemFinishTDPB[0]["counter"] >= $arrTotalItemTDPB[0]["counter"]){
      $this->db->set("status_permintaan","FINISH");
      $this->db->where("kd_permintaan_barang",$param["kd_permintaan"]);
      $this->db->update("transaksi_permintaan_barang");
    }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateDeleteAndRestorePermintaanBarang($param){
    $this->db->trans_begin();
    $this->db->where("kd_permintaan_barang",$param["kd_permintaan_barang"]);
    $this->db->update("transaksi_permintaan_barang",$param);

    $this->db->where("kd_permintaan_barang",$param["kd_permintaan_barang"]);
    $this->db->update("transaksi_detail_permintaan_barang",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function updateStokDataAwalBaru($param){
    $this->db->trans_begin();
    for ($i=0; $i < count($param); $i++) {
      $this->db->set("stok","stok + ".$param[$i]["jumlah"],FALSE);
      $this->db->where("kd_gd_bahan", $param[$i]["kd_gd_bahan"]);
      $this->db->update("gudang_bahan");

      $this->db->set("status","FINISH");
      $this->db->where("status", "PENDING");
      $this->db->where("keterangan_history","DATA AWAL");
      $this->db->where("deleted", "FALSE");
      $this->db->where("kd_gd_bahan", $param[$i]["kd_gd_bahan"]);
      $this->db->update("transaksi_gudang_bahan");
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateStokDataAwalLama($param){
    $this->db->trans_begin();
    $this->db->set("stok","stok + ".$param["jumlah"],FALSE);
    $this->db->where("kd_gd_bahan", $param["kd_gd_bahan"]);
    $this->db->update("gudang_bahan");

    $this->db->set("jumlah_permintaan",$param["jumlahBaru"]);
    $this->db->where("id",$param["id"]);
    $this->db->update("transaksi_gudang_bahan");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateStokDataAwalGudangHasilBaru($param){
    $this->db->trans_begin();
    for ($i=0; $i < count($param); $i++) {
      $this->db->set("stok_berat","stok_berat + ".$param[$i]["stok_berat"],FALSE);
      $this->db->set("stok_lembar","stok_lembar + ".$param[$i]["stok_lembar"],FALSE);
      $this->db->where("kd_gd_hasil", $param[$i]["kd_gd_hasil"]);
      $this->db->update("gudang_hasil");

      $this->db->set("status_transaksi","FINISH");
      $this->db->where("status_transaksi", "PENDING");
      $this->db->where("keterangan_history","DATA AWAL");
      $this->db->where("deleted", "FALSE");
      $this->db->where("kd_gd_hasil", $param[$i]["kd_gd_hasil"]);
      $this->db->update("transaksi_gudang_hasil");
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateStokDataAwalGudangHasilLama($param){
    $this->db->trans_begin();
    $this->db->set("stok_berat","stok_berat + ".$param["jumlah_berat"], FALSE);
    $this->db->set("stok_lembar","stok_lembar + ".$param["jumlah_lembar"], FALSE);
    $this->db->where("kd_gd_hasil",$param["kd_gd_hasil"]);
    $this->db->update("gudang_hasil");

    $this->db->set("jumlah_berat",$param["jumlahBeratBaru"]);
    $this->db->set("jumlah_lembar",$param["jumlahLembarBaru"]);
    $this->db->set("id_user",$param["idUser"]);
    $this->db->where("id_permintaan_jadi",$param["id_permintaan_jadi"]);
    $this->db->update("transaksi_gudang_hasil");
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }
  #=========================Update Function (Finish)=========================#

  #=========================Delete Function (Start)=========================#

  #=========================Delete Function (Finish)=========================#
}

?>
