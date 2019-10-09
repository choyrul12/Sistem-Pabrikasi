<?php
class Extruder_Model extends CI_Model{
  #=========================Get Code Function (Start)=========================#
  public function generateExtruderCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_extruder,4)) AS kode FROM rencana_extruder WHERE SUBSTRING(kd_extruder,4,6) = DATE_FORMAT(NOW(),'%y%m%d')");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "000";
      }
      $tempCode = "000".(intval($arrMaxCode->kode)+1);
      $fixCode = "EXT".date("ymd").substr($tempCode,(strlen($tempCode)-4));
    }
    return $fixCode;
  }
  #=========================Get Code Function (Finish)=========================#

  #=========================Insert Function (Start)=========================#
  public function insertRencanaExtruder($param){
    $this->db->trans_begin();
    $this->db->insert("rencana_extruder",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertTransaksiGudangBahan($data){
    $periode = date("Y-m", strtotime($data['tgl_permintaan']));
    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(id) AS jumlahLock
                                   FROM transaksi_gudang_bahan
                                   WHERE DATE_FORMAT(tgl_permintaan,'%Y-%m') = '$periode'
                                   AND status_lock='TRUE'
                                   AND deleted='FALSE'")->result_array();
    if($checkLock[0]["jumlahLock"] > 0){
      return "Lock";
    }else{
      $this->db->insert("transaksi_gudang_bahan",$data);
      if($this->db->trans_status()===FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function insertGudangBufferExtruder($param){
    $this->db->trans_begin();
    $this->db->insert("gudang_buffer_extruder",$param);
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertTransaksiGudangBufferExtruder($param){
    $this->db->trans_begin();
    // $QCheck = "SELECT id FROM transaksi_gudang_buffer_extruder
    //            WHERE kd_extruder='$param[kd_extruder]'
    //            AND tgl_transaksi='$param[tgl_transaksi]'
    //            AND jumlah = '$param[stok]'
    //            AND kd_gd_bahan = '$param[kd_gd_bahan]'
    //            AND keterangan_history='$param[keterangan_history]'";
    // $resultCheck = $this->db->query($QCheck)->num_rows();
    // if($resultCheck > 0){
    //   return FALSE;
    // }else{
    $periodeLock = date("Y-m",strtotime($param["tgl_transaksi"]));
    $QCheckLock = $this->db->query("SELECT COUNT(id) AS Counter FROM transaksi_gudang_roll
                                    WHERE status_lock = 'TRUE'
                                    AND jns_permintaan = 'POLOS'
                                    AND deleted='FALSE'
                                    AND DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$periodeLock'")->result_array();
    if($QCheckLock[0]["Counter"] > 0){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      if(array_key_exists("kd_gd_bahan",$param)){
        $this->db->query("UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok - $param[stok]
          WHERE kd_gd_bahan = '$param[kd_gd_bahan]'");
          $this->db->query("INSERT INTO transaksi_gudang_buffer_extruder (kd_gd_bahan, kd_extruder, id_user, tgl_transaksi, jumlah, bagian, keterangan_history)
          VALUES ('$param[kd_gd_bahan]','$param[kd_extruder]','$param[id_user]','$param[tgl_transaksi]','$param[stok]','$param[bagian]','$param[keterangan_history]')");
        }else{
          $this->db->query("INSERT INTO transaksi_gudang_buffer_extruder (kd_extruder, id_user, tgl_transaksi, jumlah, bagian, keterangan_history)
          VALUES ('$param[kd_extruder]','$param[id_user]','$param[tgl_transaksi]','$param[stok]','$param[bagian]','$param[keterangan_history]')");
        }
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return FALSE;
        }else{
          $this->db->trans_commit();
          return FALSE;
        }
    }
    //}
  }

  public function insertHasilExtruder($param){
    $this->db->trans_begin();
    $clearArrayKey = array("jumlahPermintaan");
    $beratBersih = $param["jumlah_selesai"]-$param["roll_pipa"];
    $periodeLock = date("Y-m",strtotime($param["tgl_rencana"]));
    $QCheckLock = $this->db->query("SELECT COUNT(*) AS Counter FROM transaksi_gudang_roll
                                    WHERE status_lock = 'TRUE'
                                    AND jns_permintaan='POLOS'
                                    AND DATE_FORMAT(tgl_transaksi,'%Y-%m') = '$periodeLock'
                                    AND deleted='FALSE'")->result_array();
    if($QCheckLock[0]["Counter"] > 0){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->insert("transaksi_hasil_extruder",array_diff_key($param,array_flip($clearArrayKey)));
      $this->db->query("UPDATE rencana_extruder SET jml_permintaan = jml_permintaan-$beratBersih, shift = '$param[shift]'
                        WHERE kd_extruder = '$param[kd_extruder]'");
      $checkJmlPermintaan = $this->db->query("SELECT kd_ppic,jml_permintaan FROM rencana_extruder WHERE kd_extruder='$param[kd_extruder]'")->result_array();
      $kdPpic = $checkJmlPermintaan[0]["kd_ppic"];
      $this->db->query("UPDATE rencana_ppic SET sisa = sisa-$beratBersih
                        WHERE kd_ppic='$kdPpic'");
      if($checkJmlPermintaan[0]["jml_permintaan"] <= 0){
        $this->db->query("UPDATE rencana_extruder SET sts_pengerjaan='COMPLETE' WHERE kd_extruder='$param[kd_extruder]'");
        $this->db->query("UPDATE rencana_ppic SET sts_pengerjaan='FINISH' WHERE kd_ppic='$kdPpic'");
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

  public function insertKirimDataBonRollPolos($param){
    $this->db->trans_begin();
    $tglTransaksi = date("Y-m",strtotime($param["Data"][0]["tgl_transaksi"]));
    $checkLock = $this->db->query("SELECT COUNT(status_lock) AS Jumlah
                                   FROM transaksi_gudang_roll
                                   WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$tglTransaksi'
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["Jumlah"] > 0){
      return "Lock";
      $this->db->trans_rollback();
    }else{
      $this->db->insert_batch("transaksi_gudang_roll",$param["Data"]);
      $this->db->query("UPDATE transaksi_hasil_extruder SET sts_pengiriman = 'TRUE'
                        WHERE tgl_rencana = '$param[tglRencana]' AND sts_pengiriman='FALSE'");
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function insertTransaksiDetailHistoryApal($param){
    $this->db->trans_begin();
    $tglTransaksi = date("Y-m",strtotime($param["tgl_transaksi"]));
    $checkLock = $this->db->query("SELECT COUNT(id) AS Jumlah
                                   FROM transaksi_detail_history_apal
                                   WHERE DATE_FORMAT(tgl_transaksi,'%Y-%m') = '$tglTransaksi'
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["Jumlah"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert("transaksi_detail_history_apal",$param);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }
  #=========================Insert Function (Finish)=========================#

  #=========================Select Function (Start)=========================#
  public function selectComboBoxValueGudangRoll($param){
    $arrData = $this->db->query("SELECT * FROM gudang_roll
                                 WHERE jns_permintaan='$param[JnsPermintaan]'
                                 AND merek NOT IN ('zipper','pon')
                                 AND deleted='FALSE'
                                 LIMIT 20")->result_array();
    return json_encode($arrData);
  }

  public function selectComboBoxValueGudangRollSearch($param){
    if(strpos($param["Key"],"|") === FALSE){
      $arrData = $this->db->query("SELECT * FROM gudang_roll WHERE jns_permintaan='$param[JnsPermintaan]'
                                   AND (kd_gd_roll LIKE '%$param[Key]%' OR
                                        ukuran LIKE '%$param[Key]%' OR
                                        warna_plastik LIKE '%$param[Key]%' OR
                                        merek LIKE '%$param[Key]%')
                                   AND merek NOT IN ('zipper','pon')
                                   AND deleted='FALSE'")->result_array();
    }else{
      $KeySplit = explode("|",$param["Key"]);
      $arrData = $this->db->query("SELECT * FROM gudang_roll WHERE jns_permintaan='$param[JnsPermintaan]'
                                   AND (ukuran LIKE '%$KeySplit[0]%' AND
                                        warna_plastik LIKE '%$KeySplit[2]%' AND
                                        merek LIKE '%$KeySplit[1]%')
                                   AND merek NOT LIKE '%zipper%'
                                   AND deleted='FALSE'")->result_array();
    }
    return json_encode($arrData);
  }

  public function selectListDataRencanaPPIC($param){
    $this->datatables->select("RP.kd_ppic, RP.kd_gd_roll, RP.nm_cust, DATE_FORMAT(RP.tgl_rencana,'%d %M %Y') AS tgl_rencana,
                               RP.jns_permintaan, RP.merek, RP.ket_merek, RP.ket_permintaan,
                               RP.ukuran, RP.warna_plastik, RP.tebal,RP.berat, FORMAT(RP.jumlah_permintaan,2) AS jumlah_permintaan,
                               RP.satuan, RP.satuan_kilo, RP.sisa,
                               LCASE(RP.strip) AS strip, LCASE(RP.sts_pengerjaan) AS sts_pengerjaan, LCASE(RP.prioritas) AS prioritas, RP.keterangan,
                               RP.permintaan_mesin");
    $this->datatables->from("rencana_ppic RP");
    $this->datatables->join("gudang_roll GR","RP.kd_gd_roll = GR.kd_gd_roll","INNER");
    if($param["tglAwal"]=="" && $param["tglAkhir"]==""){
      $this->datatables->where("RP.sts_pengerjaan NOT IN ('FINISH') AND RP.deleted='FALSE' AND GR.deleted='FALSE'
                                AND RP.bagian='EXTRUDER'");
    }else{
      $this->datatables->where("RP.sts_pengerjaan NOT IN ('FINISH') AND RP.deleted='FALSE' AND GR.deleted='FALSE'
                                AND RP.bagian='EXTRUDER'
                                AND RP.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'");
    }
    $this->db->order_by("RP.tgl_rencana","DESC");
    return $this->datatables->generate();
  }

  public function selectDetailRencanaPPIC($param){
    $arrData = $this->db->query("SELECT * FROM rencana_ppic WHERE kd_ppic='$param'")->result_array();
    return json_encode($arrData);
  }

  public function selectListRencanaExtruderPending(){
    $arrData = $this->db->query("SELECT RE.*, CONCAT(MSN.no_mesin,' ',MSN.sts_mesin) AS mesin
                                 FROM rencana_extruder RE
                                 INNER JOIN mesin MSN ON RE.kd_mesin = MSN.kd_mesin
                                 WHERE RE.sts_pengerjaan='PENDING' AND RE.deleted='FALSE'
                                 AND RE.deleted='FALSE'")->result_array();
    return json_encode($arrData);
  }

  public function selectListRencanaExtruderSusulanPending(){
    $arrData = $this->db->query("SELECT RE.*, CONCAT(MSN.no_mesin,' ',MSN.sts_mesin) AS mesin FROM rencana_extruder RE
                                 INNER JOIN mesin MSN ON RE.kd_mesin = MSN.kd_mesin
                                 WHERE RE.sts_pengerjaan='PENDING' AND RE.deleted='FALSE'
                                 AND (RE.kd_ppic ='' OR RE.kd_ppic IS NULL)")->result_array();
    return json_encode($arrData);
  }

  public function selectComboBoxValueMesin(){
    $arrData = $this->db->query("SELECT * FROM mesin")->result_array();
    return json_encode($arrData);
  }

  public function selectDetailRencanaExtruder($param){
    $arrData = $this->db->query("SELECT * FROM rencana_extruder WHERE kd_extruder = '$param'")->result_array();
    return json_encode($arrData);
  }

  public function selectListRencanaExtruder($param){
    $this->datatables->select("EX.kd_extruder, DATE_FORMAT(EX.tgl_rencana,'%d %M %Y') AS tgl_rencana, EX.nm_cust, EX.merek, EX.kd_mesin, EX.jns_mesin,
                               EX.ukuran, EX.warna, EX.tebal, EX.berat, LCASE(EX.strip) AS strip,
                               EX.jml_permintaan, EX.stok_permintaan, LCASE(EX.sts_pengerjaan) AS sts_pengerjaan, EX.kd_ppic,
                               LCASE(EX.prioritas) AS prioritas, EX.shift, PPIC.keterangan, CONCAT(MSN.no_mesin,' ',MSN.sts_mesin) mesin");
    $this->datatables->from("rencana_extruder EX");
    $this->datatables->join("rencana_ppic PPIC","EX.kd_ppic = PPIC.kd_ppic","LEFT");
    $this->datatables->join("mesin MSN","EX.kd_mesin = MSN.kd_mesin","INNER");
    $this->datatables->join("gudang_roll GR","EX.kd_gd_roll = GR.kd_gd_roll","INNER");
    if(array_key_exists("jns_mesin",$param) && !empty($param["jns_mesin"])){
      if(array_key_exists("tgl_awal",$param) && array_key_exists("tgl_akhir",$param)){
        $this->datatables->where("EX.deleted='FALSE' AND EX.sts_pengerjaan='$param[sts_pengerjaan]'
                                  AND EX.jns_mesin='$param[jns_mesin]'
                                  AND EX.tgl_rencana BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]'");
      }else{
        $this->datatables->where("EX.deleted='FALSE' AND EX.sts_pengerjaan='$param[sts_pengerjaan]'
                                  AND EX.jns_mesin='$param[jns_mesin]'");
      }
    }else{
      if(array_key_exists("tgl_awal",$param) && array_key_exists("tgl_akhir",$param)){
        $this->datatables->where("EX.deleted='FALSE' AND EX.sts_pengerjaan='$param[sts_pengerjaan]'
                                  AND EX.tgl_rencana '$param[tgl_awal]' AND '$param[tgl_akhir]'");
      }else{
        $this->datatables->where("EX.deleted='FALSE' AND EX.sts_pengerjaan='$param[sts_pengerjaan]'");
      }
    }
    $this->db->order_by("EX.tgl_rencana","DESC");
    return $this->datatables->generate();
  }

  public function selectComboBoxValueGudangBahan($param){
    if(array_key_exists("status",$param) && !empty($param["status"])){
      $result = $this->db->query("SELECT * FROM gudang_bahan WHERE jenis='$param[jenis]' AND status='$param[status]' AND deleted='FALSE'")->result_array();
    }else{
      if(!empty($param["warna"])){
        if(strtolower($param["warna"])=="merah"){
          $Q = "SELECT * FROM gudang_bahan WHERE jenis='$param[jenis]' AND warna LIKE '%merah strip' AND deleted='FALSE'";
        }else{
          $Q = "SELECT * FROM gudang_bahan WHERE jenis='$param[jenis]' AND warna LIKE '%$param[warna]%' AND deleted='FALSE'";
        }
        $result = $this->db->query($Q)->result_array();
      }else{
        $result = $this->db->query("SELECT * FROM gudang_bahan WHERE jenis='$param[jenis]' AND deleted='FALSE'")->result_array();
      }
    }
    return json_encode($result);
  }

  public function selectPermintaanExtruderPending($param){
    $result = $this->db->query("SELECT TGB.*, GB.nm_barang FROM transaksi_gudang_bahan TGB
                                INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                WHERE TGB.bagian='EXTRUDER'
                                AND TGB.status='PENDING'
                                AND TGB.status_history='KELUAR'
                                AND TGB.keterangan_history='PERMINTAAN EXTRUDER'
                                AND TGB.deleted='FALSE'
                                AND GB.deleted='FALSE'
                                AND GB.jenis='$param[jenis]'
                                AND GB.status = '$param[status]'")->result_array();
    return json_encode($result);
  }

  public function selectDetailTransaksiGudangBahan($param){
    $result = $this->db->query("SELECT * FROM transaksi_gudang_bahan WHERE id='$param'")->result_array();
    return json_encode($result);
  }

  public function selectJumlahPenambahanBahanBaku(){
    $tglSekarang = date("Y-m-d");
    $result = $this->db->query("SELECT SUM(jumlah_permintaan) AS jumlah_permintaan
                                FROM transaksi_gudang_bahan
                                WHERE bagian = 'EXTRUDER'
                                AND tgl_permintaan = '$tglSekarang'
                                AND status = 'FINISH'
                                AND status_history = 'KELUAR'
                                AND keterangan_history = 'PERMINTAAN EXTRUDER'
                                AND deleted='FALSE'
                                AND shift IS NOT NULL")->result_array();

    $result2 = $this->db->query("SELECT sisa_biji_kemarin
                                 FROM transaksi_data_job_extruder
                                 WHERE jns_brg='LOKAL'
                                 ORDER BY id_data DESC LIMIT 1")->result_array();
    return json_encode(array("permintaan" => $result, "bahanBaku" => $result2));
  }

  public function selectJumlahPenambahanBahanBakuUntukJob($param){
    $result = $this->db->query("SELECT SUM(jumlah_permintaan) AS jumlah_permintaan
                                FROM transaksi_gudang_bahan
                                WHERE bagian = 'EXTRUDER'
                                AND tgl_permintaan = '$param[tanggal]'
                                AND shift = '$param[shift]'
                                AND status IN ('PROGRESS','FINISH')
                                AND status_history = 'KELUAR'
                                AND keterangan_history = 'PERMINTAAN EXTRUDER'
                                AND deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectJumlahPenguranganBahanBaku(){
    $tglSekarang = date("Y-m-d");
    $result = $this->db->query("SELECT SUM(jumlah_permintaan) AS jumlah_permintaan
                                FROM transaksi_gudang_bahan
                                WHERE bagian = 'EXTRUDER'
                                AND tgl_permintaan = '$tglSekarang'
                                AND status = 'FINISH'
                                AND status_history = 'MASUK'
                                AND keterangan_history = 'KEMBALIAN EXTRUDER'
                                AND deleted='FALSE'")->result_array();

    $result2 = $this->db->query("SELECT FORMAT(jumlah_stok,2) AS jumlah_stok
                                 FROM gudang_buffer_extruder
                                 WHERE jenis='BAHAN BAKU'
                                 AND status='LOKAL'")->result_array();
    return json_encode(array("permintaan" => $result, "bahanBaku" => $result2));
  }

  public function selectTambahBijiWarnaPending(){
    $result = $this->db->query("SELECT TGB.id, TGB.jumlah_permintaan, GB.nm_barang, GB.warna, GBE.id AS idGudangBuffer
                                FROM transaksi_gudang_bahan TGB
                                INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                INNER JOIN gudang_buffer_extruder GBE ON GBE.kd_gd_bahan = GB.kd_gd_bahan
                                WHERE TGB.deleted='FALSE'
                                AND TGB.bagian = 'EXTRUDER'
                                AND TGB.status = 'PENDING'
                                AND TGB.status_history = 'KELUAR'
                                AND TGB.keterangan_history = 'PERMINTAAN EXTRUDER (DATA AWAL EXTRUDER)'")->result_array();
    return json_encode($result);
  }

  public function selectBijiWarna(){
    $result = $this->db->query("SELECT GBE.id, FORMAT(GBE.jumlah_stok,2) AS jumlah_stok, GB.nm_barang, GB.warna, TGB.id AS idTransaksi
                                FROM gudang_buffer_extruder GBE
                                INNER JOIN gudang_bahan GB ON GBE.kd_gd_bahan = GB.kd_gd_bahan
                                INNER JOIN transaksi_gudang_bahan TGB ON TGB.kd_gd_bahan = GBE.kd_gd_bahan
                                WHERE TGB.status='FINISH'
                                AND GBE.deleted='FALSE'
                                AND GB.deleted='FALSE'
                                AND TGB.deleted='FALSE'
                                AND TGB.keterangan_history='PERMINTAAN EXTRUDER (DATA AWAL EXTRUDER)'")->result_array();
    return json_encode($result);
  }

  public function selectBijiWarnaGudangBufferExtruder($param=""){
    if(empty($param)){
      $result = $this->db->query("SELECT GB.* FROM gudang_bahan GB
                                  INNER JOIN gudang_buffer_extruder GBE ON GB.kd_gd_bahan = GBE.kd_gd_bahan
                                  WHERE GB.deleted = 'FALSE'
                                  AND GBE.deleted='FALSE'")->result_array();
    }else{
      $result = $this->db->query("SELECT GB.* FROM gudang_bahan GB
                                  INNER JOIN gudang_buffer_extruder GBE ON GB.kd_gd_bahan = GBE.kd_gd_bahan
                                  WHERE GB.deleted = 'FALSE'
                                  AND GBE.deleted='FALSE'
                                  AND GB.warna LIKE '%$param%'")->result_array();
    }
    return json_encode($result);
  }

  public function selectPermintaanBijiWarnaPending(){
    $result = $this->db->query("SELECT TGB.id, TGB.jumlah_permintaan, GB.nm_barang, GB.warna, GBE.id AS idGudangBuffer, TGB.tgl_permintaan
                                FROM transaksi_gudang_bahan TGB
                                INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                INNER JOIN gudang_buffer_extruder GBE ON GBE.kd_gd_bahan = GB.kd_gd_bahan
                                WHERE TGB.deleted='FALSE'
                                AND TGB.bagian = 'EXTRUDER'
                                AND TGB.status = 'PENDING'
                                AND TGB.status_history = 'KELUAR'
                                AND TGB.keterangan_history = 'PERMINTAAN EXTRUDER'
                                AND TGB.deleted='FALSE'
                                AND GBE.deleted='FALSE'
                                AND GB.deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectRencanaExtruderUntukInputHasil($param){
    $Q = "SELECT RE.*, CONCAT(MSN.no_mesin,'(',MSN.ukuran_min,' - ',MSN.ukuran_maks,')') AS mesin,
                 RP.jns_permintaan, RP.ket_merek AS ket_merek_ppic, GR.jns_permintaan AS jns_permintaan_roll, GR.jns_brg
          FROM rencana_extruder RE
          LEFT JOIN rencana_ppic RP ON RP.kd_ppic = RE.kd_ppic
          INNER JOIN mesin MSN ON RE.kd_mesin = MSN.kd_mesin
          INNER JOIN gudang_roll GR ON RE.kd_gd_roll = GR.kd_gd_roll
          WHERE RE.kd_extruder='$param'
          AND RE.deleted='FALSE'
          AND GR.deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectHasilJobExtruder($param){
    $Q = "SELECT HE.biji_warna, HE.hasil_ukuran, E.berat, HE.roll_pipa, HE.jumlah_selesai, E.merek, HE.tgl_rencana,
                 CONCAT(MSN.no_mesin, ' ', MSN.sts_mesin) AS no_mesin, HE.id_hasil_extruder, HE.kd_extruder, HE.shift
          FROM transaksi_hasil_extruder HE
          INNER JOIN rencana_extruder E ON HE.kd_extruder = E.kd_extruder
          INNER JOIN mesin MSN ON E.kd_mesin = MSN.kd_mesin
          AND HE.jns_brg='$param'
          AND HE.status_transaksi='FALSE'
          AND HE.deleted='FALSE'
          AND E.deleted='FALSE'
          ORDER BY id_hasil_extruder DESC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectDataHasilJobExtruderFinal($param){
    $Q = "SELECT sisa_biji_kemarin FROM transaksi_data_job_extruder WHERE jns_brg='$param'  ORDER BY `id_data` DESC LIMIT 1";
    $Q2 = "SELECT (SUM(HE.jumlah_biji_warna) + (SUM(pemakaian_strip) + SUM(IF(pemakaian_strip LIKE '%#%',pemakaian_strip,0)))) AS jumlah_biji_warna,
                  SUM(HE.jumlah_selesai) AS jumlah_selesai,
                  SUM(HE.roll_pipa) AS roll_pipa
          FROM transaksi_hasil_extruder HE
          INNER JOIN rencana_extruder E ON HE.kd_extruder = E.kd_extruder
          INNER JOIN mesin MSN ON E.kd_mesin = MSN.kd_mesin
          AND HE.jns_brg='$param'
          AND HE.status_transaksi='FALSE'
          AND HE.deleted='FALSE'
          AND E.deleted='FALSE'";
    $resultSisaBijiKemarin = $this->db->query($Q)->result_array();
    $resultDataJumlah = $this->db->query($Q2)->result_array();
    $resultPenambahanBiji = json_decode($this->selectJumlahPenambahanBahanBaku(),TRUE);
    $resultPenguranganBiji = json_decode($this->selectJumlahPenguranganBahanBaku(), TRUE);
    $returnResult = array("resultSisaBijiKemarin" => $resultSisaBijiKemarin,
                          "resultDataJumlah"      => $resultDataJumlah,
                          "penambahanBijiBaru"    => $resultPenambahanBiji["permintaan"][0]["jumlah_permintaan"],
                          "penguranganBijiBaru"   => $resultPenguranganBiji["permintaan"][0]["jumlah_permintaan"]);
    return json_encode($returnResult);
  }

  public function selectDataLaporanRencanaMandor($param){
    $dataExtruder = $this->db->query("SELECT HE.*, CONCAT(MSN.no_mesin, ' ', MSN.sts_mesin) AS mesin
                                      FROM transaksi_hasil_extruder HE
                                      INNER JOIN rencana_extruder RE ON HE.kd_extruder = RE.kd_extruder
                                      INNER JOIN mesin MSN ON RE.kd_mesin = MSN.kd_mesin
                                      WHERE HE.tgl_rencana = '$param[tgl_rencana]'
                                      AND HE.shift = '$param[shift]'
                                      AND HE.jns_brg = '$param[jns_brg]'
                                      AND HE.deleted = 'FALSE'
                                      AND RE.deleted='FALSE'
                                      AND HE.status_transaksi='TRUE'
                                      ORDER BY HE.merek ASC, HE.hasil_ukuran ASC, HE.biji_warna ASC")->result_array();

    if($param["shift"] == "1"){
      $Q3 = "SELECT sisa_biji_kemarin
            FROM transaksi_data_job_extruder
            WHERE shift = '3'
            AND jns_brg = '$param[jns_brg]'
            AND tgl_rencana < '$param[tgl_rencana]'
            AND deleted = 'FALSE'
            ORDER BY tgl_rencana DESC
            LIMIT 1";
      $sisaBijiKemarin = $this->db->query($Q3)->result_array();
    }else if($param["shift"] == "2"){
      $Q3 = "SELECT sisa_biji_kemarin
            FROM transaksi_data_job_extruder
            WHERE shift = '1'
            AND jns_brg = '$param[jns_brg]'
            AND tgl_rencana = '$param[tgl_rencana]'
            AND deleted = 'FALSE'
            ORDER BY tgl_rencana DESC
            LIMIT 1";
      $sisaBijiKemarin = $this->db->query($Q3)->result_array();
    }else{
      $Q3 = "SELECT sisa_biji_kemarin
            FROM transaksi_data_job_extruder
            WHERE shift = '2'
            AND jns_brg = '$param[jns_brg]'
            AND tgl_rencana = '$param[tgl_rencana]'
            AND deleted = 'FALSE'
            ORDER BY tgl_rencana DESC
            LIMIT 1";
      $sisaBijiKemarin = $this->db->query($Q3)->result_array();
    }

    $dataJobExtruder = $this->db->query("SELECT * FROM transaksi_data_job_extruder
                                         WHERE jns_brg = '$param[jns_brg]'
                                         AND tgl_rencana = '$param[tgl_rencana]'
                                         AND shift = '$param[shift]'
                                         AND deleted='FALSE'")->result_array();

    $returnResult = array("tableDataExtruder" => $dataExtruder,
                          "sisaBijiKemarin" => $sisaBijiKemarin,
                          "dataJobExtruder" => $dataJobExtruder);
    return json_encode($returnResult);
  }

  public function selectDataHasilExtruder($param){
    $Q = "SELECT HE.keterangan, HE.jumlah_selesai, HE.biji_warna, HE.hasil_ukuran,
                 HE.hasil_berat, HE.roll_pipa, HE.jumlah_biji_warna, HE.merek,
                 HE.roll_lembar, HE.shift, HE.jenis_roll, HE.pemakaian_strip,
                 RE.tebal, RP.ket_merek
          FROM transaksi_hasil_extruder HE
          INNER JOIN rencana_extruder RE ON HE.kd_extruder = RE.kd_extruder
          LEFT JOIN rencana_ppic RP ON RE.kd_ppic = RP.kd_ppic
          WHERE HE.tgl_rencana = '$param[tgl_rencana]'
          AND HE.shift = '$param[shift]'
          AND HE.jns_brg = '$param[jns_brg]'
          AND HE.deleted = 'FALSE'
          AND RE.deleted='FALSE'
          AND HE.status_transaksi='TRUE'
          ORDER BY HE.merek ASC, HE.hasil_ukuran ASC, HE.biji_warna ASC";

    $Q2 = "SELECT biji_warna, jumlah_biji_warna
           FROM transaksi_hasil_extruder
           WHERE tgl_rencana = '$param[tgl_rencana]'
           AND shift = '$param[shift]'
           AND jns_brg = '$param[jns_brg]'
           AND biji_warna NOT IN ('PUTIH')
           AND deleted='FALSE'
           ORDER BY biji_warna DESC";

     if($param["shift"] == "1"){
       $Q3 = "SELECT sisa_biji_kemarin
             FROM transaksi_data_job_extruder
             WHERE shift = '3'
             AND jns_brg = '$param[jns_brg]'
             AND tgl_rencana < '$param[tgl_rencana]'
             AND deleted = 'FALSE'
             ORDER BY tgl_rencana DESC
             LIMIT 1";
       $sisaBijiKemarin = $this->db->query($Q3)->result_array();
     }else if($param["shift"] == "2"){
       $Q3 = "SELECT sisa_biji_kemarin
             FROM transaksi_data_job_extruder
             WHERE shift = '1'
             AND jns_brg = '$param[jns_brg]'
             AND tgl_rencana = '$param[tgl_rencana]'
             AND deleted = 'FALSE'
             ORDER BY tgl_rencana DESC
             LIMIT 1";
       $sisaBijiKemarin = $this->db->query($Q3)->result_array();
     }else{
       $Q3 = "SELECT sisa_biji_kemarin
             FROM transaksi_data_job_extruder
             WHERE shift = '2'
             AND jns_brg = '$param[jns_brg]'
             AND tgl_rencana = '$param[tgl_rencana]'
             AND deleted = 'FALSE'
             ORDER BY tgl_rencana DESC
             LIMIT 1";
       $sisaBijiKemarin = $this->db->query($Q3)->result_array();
     }
     if(count($sisaBijiKemarin) <= 0){
       $sisaBijiKemarin = array(array("sisa_biji_kemarin" => "0.00"));
     }

     $dataJobExtruder = $this->db->query("SELECT * FROM transaksi_data_job_extruder
                                          WHERE jns_brg = '$param[jns_brg]'
                                          AND tgl_rencana = '$param[tgl_rencana]'
                                          AND shift = '$param[shift]'
                                          AND deleted='FALSE'")->result_array();

    $resultHasilExtruder = $this->db->query($Q)->result_array();
    $resultBijiWarna = $this->db->query($Q2)->result_array();
    $returnResult = array("dataHasilExtruder" => $resultHasilExtruder,
                          "dataBijiWarna" => $resultBijiWarna,
                          "sisaBijiKemarin" => $sisaBijiKemarin,
                          "dataJobExtruder" => $dataJobExtruder);
    return json_encode($returnResult);
  }

  public function selectDetailTransaksiHasilJobExtruder($param){
    $Q = "SELECT THE.*, E.strip AS warna_strip, CONCAT(MSN.no_mesin, ' ', MSN.sts_mesin) AS no_mesin,
                 RP.ket_merek AS ket_merek_ppic, E.ket_merek, E.tebal, E.jml_permintaan
          FROM transaksi_hasil_extruder THE
          INNER JOIN rencana_extruder E ON THE.kd_extruder = E.kd_extruder
          INNER JOIN mesin MSN ON E.kd_mesin = MSN.kd_mesin
          LEFT JOIN rencana_ppic RP ON E.kd_ppic = RP.kd_ppic
          WHERE THE.id_hasil_extruder='$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectCheckPemakaianExtruder($param){
    $Q = "SELECT * FROM transaksi_gudang_buffer_extruder
          WHERE kd_extruder='$param[kd_extruder]'
          AND tgl_transaksi = '$param[tgl_transaksi]'
          AND jumlah = '$param[jumlah]'
          AND keterangan_history = 'PEMAKAIAN EXTRUDER'
          AND deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return $result;
  }

  public function selectCheckPemakaianStrip($param){
    if(strpos("#",$param["pemakaian_strip"]) === FALSE){
      $Q = "SELECT * FROM transaksi_gudang_buffer_extruder
            WHERE kd_extruder = '$param[kd_extruder]'
            AND tgl_transaksi = '$param[tgl_transaksi]'
            AND jumlah = '$param[pemakaian_strip]'
            AND keterangan_history = 'PEMAKAIAN STRIP'
            AND deleted='FALSE'";
    }else{
      $arrPemakaianStrip = explode("#",$param["pemakaian_strip"]);
      $Q = "SELECT * FROM transaksi_gudang_buffer_extruder
            WHERE kd_extruder = '$param[kd_extruder]'
            AND tgl_transaksi = '$param[tgl_transaksi]'
            AND jumlah IN ('$arrPemakaianStrip[0]','$arrPemakaianStrip[1]')
            AND keterangan_history = 'PEMAKAIAN STRIP'
            AND deleted='FALSE'
            ORDER BY FIELD(jumlah, '$arrPemakaianStrip[0]','$arrPemakaianStrip[1]')";
    }
    $result = $this->db->query($Q)->result_array();
    return $result;
  }

  public function selectDataKirimHasilExtruderKePpic($param){
    $result = $this->db->query("SELECT TDJE.id_data, TDJE.tgl_rencana, SUM(THE.jumlah_selesai) AS total, TDJE.jumlah_apal, TDJE.shift, TDJE.jns_brg, TDJE.kirim_ke_ppic
                                FROM transaksi_data_job_extruder TDJE
                                INNER JOIN transaksi_hasil_extruder THE ON TDJE.tgl_rencana = THE.tgl_rencana
                                AND TDJE.jns_brg = THE.jns_brg
                                AND TDJE.shift = THE.shift
                                WHERE TDJE.tgl_rencana = '$param[tgl_rencana]'
                                AND TDJE.jns_brg = '$param[jns_brg]'
                                AND TDJE.shift = '$param[shift]'")->result_array();
    return json_encode($result);
  }

  public function selectDataRencanaMandorSelesai($param){
    $this->datatables->select("RE.*, CONCAT(MSN.no_mesin, ' ',MSN.sts_mesin) AS no_mesin,
                               RP.keterangan, RP.ket_merek");
    $this->datatables->from("rencana_extruder RE");
    $this->datatables->join("rencana_ppic RP","RE.kd_ppic = RP.kd_ppic","LEFT");
    $this->datatables->join("mesin MSN","RE.kd_mesin = MSN.kd_mesin","INNER");
    $this->datatables->where("RE.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
                              AND RE.sts_pengerjaan = 'COMPLETE'
                              AND RE.deleted = 'FALSE'");
    $this->db->order_by("RE.tgl_rencana","DESC");
    return $this->datatables->generate();
  }

  public function selectDataBonRollPolos($param){
    $result = $this->db->query("SELECT RE.tebal, THE.kd_gd_roll, THE.hasil_ukuran, THE.jumlah_selesai, THE.warna_plastik, THE.roll_lembar,THE.tgl_rencana,
                                       THE.roll_pipa, THE.jenis_roll, THE.jns_brg, THE.shift, THE.sts_pengiriman, THE.merek, THE.tgl_jadi
                                FROM transaksi_hasil_extruder THE
                                INNER JOIN rencana_extruder RE ON THE.kd_extruder = RE.kd_extruder
                                WHERE THE.tgl_rencana = '$param'
                                AND THE.deleted = 'FALSE'
                                AND RE.deleted = 'FALSE'
                                ORDER BY THE.shift ASC")->result_array();
    return json_encode($result);
  }

  public function selectDetailBonRollPolos($param){
    if($param["merek"] == "Klip"){
      $clause = "AND THE.merek IN ('$param[merek]','Export','PON','Klip Pon','Klipon') ";
    }else{
      $clause = "AND THE.merek = '$param[merek]' ";
    }
    $result = $this->db->query("SELECT RE.tebal, THE.kd_gd_roll, THE.hasil_ukuran, THE.jumlah_selesai, THE.warna_plastik, THE.roll_lembar,
                                       THE.roll_pipa, THE.jenis_roll, THE.jns_brg, THE.shift, THE.sts_pengiriman, THE.merek, THE.tgl_jadi
                                FROM transaksi_hasil_extruder THE
                                INNER JOIN rencana_extruder RE ON THE.kd_extruder = RE.kd_extruder
                                WHERE THE.tgl_rencana = '$param[tglRencana]'
                                AND THE.deleted = 'FALSE'
                                AND RE.deleted = 'FALSE'
                                $clause
                                AND THE.shift = '$param[shift]'
                                ORDER BY THE.shift ASC")->result_array();
    return json_encode($result);
  }

  public function selectComboBoxValueGudangApal(){
    $result = $this->db->query("SELECT kd_gd_apal, jenis, sub_jenis FROM gudang_apal WHERE deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectDataBonApal($param){
    $result = $this->db->query("SELECT id, tgl_transaksi, warna, jumlah_apal, shift, sts_transaksi
                                FROM transaksi_detail_history_apal
                                WHERE tgl_transaksi='$param'
                                AND bagian='EXTRUDER'
                                AND keterangan_history = 'KIRIMAN APAL'
                                AND status_history = 'MASUK'
                                AND deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectDataBonApalId($param){
    $result = $this->db->query("SELECT * FROM transaksi_detail_history_apal WHERE id='$param'")->result_array();
    return json_encode($result);
  }

  public function selectHistoryPermintaanBahanBaku($param){
    $this->datatables->select("TGB.id, TGB.tgl_permintaan, GB.nm_barang, GB.warna, TGB.jumlah_permintaan");
    $this->datatables->from("transaksi_gudang_bahan TGB");
    $this->datatables->join("gudang_bahan GB","TGB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->where("TGB.tgl_permintaan BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
                              AND TGB.bagian = 'EXTRUDER'
                              AND TGB.status='FINISH'
                              AND GB.jenis = 'BAHAN BAKU'
                              AND TGB.status_history ='KELUAR'
                              AND TGB.keterangan_history LIKE '%PERMINTAAN EXTRUDER%'
                              AND TGB.deleted='FALSE'
                              AND GB.deleted='FALSE'");
    $this->db->order_by("TGB.tgl_permintaan","DESC");
    return $this->datatables->generate();
  }

  public function selectKembalianBahanBakuPending(){
    $result = $this->db->query("SELECT TGB.id, TGB.tgl_permintaan, GB.nm_barang, GB.warna, TGB.jumlah_permintaan
                                FROM transaksi_gudang_bahan TGB
                                INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                WHERE TGB.bagian = 'EXTRUDER'
                                AND GB.jenis = 'BAHAN BAKU'
                                AND TGB.status = 'PENDING'
                                AND TGB.status_history = 'MASUK'
                                AND TGB.keterangan_history = 'KEMBALIAN EXTRUDER'
                                AND TGB.deleted='FALSE'
                                AND GB.deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectDetailKembalianBahanBaku($param){
    $result = $this->db->query("SELECT * FROM transaksi_gudang_bahan WHERE id='$param'")->result_array();
    return json_encode($result);
  }

  public function selectHistoryKembalianBahanBaku($param){
    $this->datatables->select("TGB.id, TGB.tgl_permintaan, GB.nm_barang, GB.warna, TGB.jumlah_permintaan");
    $this->datatables->from("transaksi_gudang_bahan TGB");
    $this->datatables->join("gudang_bahan GB","TGB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->where("TGB.tgl_permintaan BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
                              AND TGB.bagian = 'EXTRUDER'
                              AND GB.jenis = 'BAHAN BAKU'
                              AND TGB.status='FINISH'
                              AND TGB.status_history ='MASUK'
                              AND TGB.keterangan_history='KEMBALIAN EXTRUDER'
                              AND TGB.deleted='FALSE'
                              AND GB.deleted='FALSE'");
    $this->db->order_by("TGB.tgl_permintaan","DESC");
    return $this->datatables->generate();
  }

  public function selectHistoryBijiWarna($param){
    $this->datatables->select("TGBE.id, TGBE.tgl_transaksi, GB.nm_barang, GB.warna, TGBE.jumlah, TGBE.keterangan_history");
    $this->datatables->from("transaksi_gudang_buffer_extruder TGBE");
    $this->datatables->join("gudang_bahan GB","TGBE.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->where("TGBE.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
                              AND TGBE.kd_gd_bahan = '$param[kdGdBahan]'
                              AND TGBE.deleted='FALSE'
                              AND GB.deleted='FALSE'");
    $this->db->order_by("TGBE.tgl_transaksi","DESC");
    return $this->datatables->generate();
  }

  public function selectHistoryBijiWarna_GudangBahan($param){
    $this->datatables->select("TGB.id, TGB.tgl_permintaan, GB.nm_barang, GB.warna, TGB.jumlah_permintaan, TGB.keterangan_history");
    $this->datatables->from("transaksi_gudang_bahan TGB");
    $this->datatables->join("gudang_bahan GB","TGB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->where("TGB.tgl_permintaan BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
                              AND TGB.kd_gd_bahan = '$param[kdGdBahan]'
                              AND TGB.bagian='EXTRUDER'
                              AND TGB.status = 'FINISH'
                              AND status_history = 'KELUAR'
                              AND keterangan_history = 'PERMINTAAN EXTRUDER'
                              AND TGB.deleted='FALSE'
                              AND GB.deleted='FALSE'");
    $this->db->order_by("TGB.tgl_permintaan","DESC");
    return $this->datatables->generate();
  }

  public function selectKembalianBijiWarnaPending(){
    $result = $this->db->query("SELECT TGB.id, TGB.tgl_permintaan, GB.nm_barang, GB.warna, TGB.jumlah_permintaan
                                FROM transaksi_gudang_bahan TGB
                                INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                WHERE TGB.bagian = 'EXTRUDER'
                                AND GB.jenis='BIJI WARNA'
                                AND TGB.status = 'PENDING'
                                AND TGB.status_history = 'MASUK'
                                AND TGB.keterangan_history = 'KEMBALIAN EXTRUDER'
                                AND TGB.deleted='FALSE'
                                AND GB.deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectHistoryKembalianBijiWarna($param){
    $this->datatables->select("TGB.id, TGB.tgl_permintaan, GB.nm_barang, GB.warna, TGB.jumlah_permintaan");
    $this->datatables->from("transaksi_gudang_bahan TGB");
    $this->datatables->join("gudang_bahan GB","TGB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->where("TGB.tgl_permintaan BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
                              AND TGB.bagian = 'EXTRUDER'
                              AND GB.jenis = 'BIJI WARNA'
                              AND TGB.status='FINISH'
                              AND TGB.status_history ='MASUK'
                              AND TGB.keterangan_history='KEMBALIAN EXTRUDER'
                              AND TGB.deleted='FALSE'
                              AND GB.deleted='FALSE'");
    $this->db->order_by("TGB.tgl_permintaan","DESC");
    return $this->datatables->generate();
  }

  public function selectPengambilanPotongExtruder($param){
    $result = $this->db->query("SELECT tgl_sisa, warna_plastik, ukuran, merek, berat, bobin, payung, payung_kuning
                                FROM transaksi_detail_pengambilan_potong
                                WHERE tgl_sisa = '$param'
                                AND status = 'MANDOR POTONG (EXTRUDER)'
                                AND jns_permintaan = 'POLOS'
                                AND deleted = 'FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectPengambilanCetakExtruder($param){
    $result = $this->db->query("SELECT TDPC.tgl_pengambilan, GR.warna_plastik, GR.ukuran, GR.merek,
                                       TDPC.berat, TDPC.bobin, TDPC.payung, TDPC.payung_kuning
                                FROM transaksi_detail_pengambilan_cetak TDPC
                                INNER JOIN gudang_roll GR ON TDPC.kd_gd_roll = GR.kd_gd_roll
                                WHERE TDPC.tgl_pengambilan = '$param'
                                AND TDPC.status = 'MANDOR CETAK (EXTRUDER)'
                                AND TDPC.deleted = 'FALSE'
                                AND GR.deleted = 'FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectComboRencanaMandorExtruder($param=""){
    if(empty($param)){
      $Q = "SELECT CONCAT(kd_extruder,'#',COALESCE(kd_ppic,''),'#',kd_gd_roll) AS kode, nm_cust, ukuran, merek, warna, LCASE(strip) AS strip
            FROM rencana_extruder
            WHERE deleted='FALSE'
            ORDER BY kd_extruder DESC
            LIMIT 20";
    }else{
      if(strpos($param,"|") !== FALSE){
        $arrKey = explode("|",$param);
        $Q = "SELECT CONCAT(kd_extruder,'#',COALESCE(kd_ppic,''),'#',kd_gd_roll) AS kode, nm_cust, ukuran, merek, warna, LCASE(strip) AS strip
              FROM rencana_extruder
              WHERE (nm_cust LIKE '%$arrKey[0]%' AND
                     ukuran LIKE '%$arrKey[1]%' AND
                     merek LIKE '%$arrKey[2]%' AND
                     warna LIKE '%$arrKey[3]%' AND
                     strip LIKE '%$arrKey[4]%')
              AND deleted='FALSE'
              ORDER BY kd_extruder DESC";
      }else{
        $Q = "SELECT CONCAT(kd_extruder,'#',COALESCE(kd_ppic,''),'#',kd_gd_roll) AS kode, nm_cust, ukuran, merek, warna, LCASE(strip) AS strip
              FROM rencana_extruder
              WHERE (nm_cust LIKE '%$param%' OR
                     ukuran LIKE '%$param%' OR
                     merek LIKE '%$param%' OR
                     warna LIKE '%$param%' OR
                     strip LIKE '%$param%' OR
                     CONCAT(kd_extruder,'#',COALESCE(kd_ppic,''),'#',kd_gd_roll) LIKE '%$param%')
              AND deleted='FALSE'
              ORDER BY kd_extruder DESC";
      }
    }
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  #=========================Select Function (Finish)=========================#

  #=========================Update Function (Start)=========================#
  public function updateRencanaPpic($param){
    $this->db->trans_begin();
    $this->db->where("kd_ppic", $param["kd_ppic"]);
    $this->db->update("rencana_ppic", $param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateRencanaExtruder($param){
    $this->db->trans_begin();
    $this->db->where("kd_extruder",$param["kd_extruder"]);
    $this->db->update("rencana_extruder",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateDeleteAndRestoreRencanaExtruder($param){
    $this->db->trans_begin();
    $Q = "SELECT kd_ppic FROM rencana_extruder WHERE kd_extruder='$param[kd_extruder]'";
    $arrKdPpic = $this->db->query($Q)->result_array();
    if(empty($arrKdPpic[0]["kd_ppic"])){
      $this->db->where("kd_extruder",$param["kd_extruder"]);
      $this->db->update("rencana_extruder",$param);
    }else{
      if($param["deleted"] == "FALSE"){
        $this->db->set("sts_pengerjaan","PROGRESS");
      }else{
        $this->db->set("sts_pengerjaan","PENDING");
      }
      $this->db->where("kd_ppic",$arrKdPpic[0]["kd_ppic"]);
      $this->db->update("rencana_ppic");

      $this->db->where("kd_extruder",$param["kd_extruder"]);
      $this->db->update("rencana_extruder",$param);
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateStatusRencana($param){
    $this->db->trans_begin();
    $this->db->query("UPDATE rencana_extruder SET sts_pengerjaan = '$param[sts_pengerjaan]' WHERE kd_extruder='$param[kd_extruder]'");
    $this->db->query("UPDATE rencana_ppic SET sts_pengerjaan = '$param[sts_pengerjaan]' WHERE kd_ppic='$param[kd_ppic]'");
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

  public function updateGudangBufferExtruder($param){
    $this->db->trans_begin();
    $this->db->where("id",$param["id"]);
    $this->db->update("gudang_buffer_extruder",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateHasilJobExtruderFinal($param){
    $this->db->trans_begin();
    $arrTglRencana = $this->db->query("SELECT tgl_rencana
                                       FROM transaksi_hasil_extruder
                                       WHERE status_transaksi='FALSE'
                                       ORDER BY tgl_rencana DESC
                                       LIMIT 1")->result_array(); #Ambil Tanggal Rencana yang terakhir di input dengan status transaksi FALSE#
    $tglRencana = $arrTglRencana[0]["tgl_rencana"];
    $check = $this->db->query("SELECT id_data FROM transaksi_data_job_extruder WHERE tgl_rencana='$tglRencana' AND shift='$param[shift]'"); /* Melakukan pengecekan data job extruder
                                                                                                                     yang sudah ada dengan tanggal rencana
                                                                                                                     yang didapat dari query sebelumnya */
    $arrIdData = $check->result_array();
    $idData = $arrIdData[0]["id_data"];
    if($check->num_rows() > 0){   #Jika data sudah ada maka melakukan update data yang telah ada
      $Q = "UPDATE transaksi_data_job_extruder
            SET id_user = '$param[id_user]',
                tgl_rencana = '$tglRencana',
                sisa_biji_kemarin = '$param[sisaBijiKemarin]',
                penambahan_biji = '$param[penambahanBijiBaru]',
                pengurangan_biji = '$param[penguranganBiji]',
                corong = '$param[corong]',
                sisa_bahan = '$param[sisaBahan]',
                plusminus = '$param[plusMinus]',
                total_biji_warna = '$param[totalBijiWarna]',
                total = '$param[total]',
                jumlah_apal = '$param[jumlahApal]'
            WHERE id_data = '$idData'";
    }else{ #Jika tidak ada maka melakukan insert data baru
      $Q = "INSERT INTO transaksi_data_job_extruder
            (id_user,tgl_rencana, sisa_biji_kemarin, penambahan_biji, pengurangan_biji,
             corong, sisa_bahan, plusminus, total_biji_warna, total, jumlah_apal, shift)
            VALUES ('$param[id_user]','$tglRencana','$param[sisaBijiKemarin]','$param[penambahanBijiBaru]',
                    '$param[penguranganBiji]','$param[corong]','$param[sisaBahan]','$param[plusMinus]','$param[totalBijiWarna]',
                    '$param[total]','$param[jumlahApal]','$param[shift]')";
    }
    $Q2 = "UPDATE transaksi_hasil_extruder
          SET status_transaksi = 'TRUE'
          WHERE jns_brg='$param[jnsBrg]'
          AND status_transaksi='FALSE'";

    $Q3 = "UPDATE gudang_buffer_extruder SET jumlah_stok = '$param[sisa]'
           WHERE jenis='BAHAN BAKU' AND status='$param[jnsBrg]'";
    $this->db->query($Q);
    $this->db->query($Q2);
    $this->db->query($Q3);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updatePemakaianExtruderTrue($param){
    $this->db->trans_begin();
    $QUpdate1 = "UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok + $param[jumlah]
                 WHERE kd_gd_bahan = '$param[kd_gd_bahan]'";
    $QUpdate2 = "UPDATE transaksi_gudang_buffer_extruder SET jumlah = '$param[stok]'
                 WHERE id = '$param[id]'";
    $QUpdate3 = "UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok - $param[stok]
                 WHERE kd_gd_bahan = '$param[kd_gd_bahan]'";
    $QUpdate4 = "UPDATE transaksi_hasil_extruder SET jumlah_biji_warna = '$param[stok]'
                 WHERE id_hasil_extruder = '$param[id_hasil_extruder]'";

    $this->db->query($QUpdate1);
    $this->db->query($QUpdate2);
    $this->db->query($QUpdate3);
    $this->db->query($QUpdate4);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updatePemakaianExtruderFalse($param){
    $this->db->trans_begin();
    $QUpdate1 = "UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok + $param[jumlah]
                 WHERE kd_gd_bahan = '$param[kd_gd_bahan_lama]'";
    $QUpdate2 = "UPDATE transaksi_gudang_buffer_extruder SET jumlah = '$param[stok]', kd_gd_bahan='$param[kd_gd_bahan_baru]'
                 WHERE id = '$param[id]'";
    $QUpdate3 = "UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok - $param[stok]
                 WHERE kd_gd_bahan = '$param[kd_gd_bahan_baru]'";
    $QUpdate4 = "UPDATE transaksi_hasil_extruder SET jumlah_biji_warna = '$param[stok]',biji_warna='$param[nama_biji_warna]'
                 WHERE id_hasil_extruder = '$param[idTransaksi]'";

    if(!empty($param["kd_gd_bahan_lama"])){
      $this->db->query($QUpdate1);
    }
    $this->db->query($QUpdate2);
    $this->db->query($QUpdate3);
    $this->db->query($QUpdate4);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateTransaksiGudangBufferExtruder($param){
    $this->db->trans_begin();
    $QUpdate1 = "UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok + $param[stokBahan_Sebelumnya]
                 WHERE kd_gd_bahan = '$param[kdGdBahan_Sebelumnya]'";
    $QUpdate2 = "UPDATE transaksi_gudang_buffer_extruder SET jumlah = '$param[stok], kd_gd_bahan='$param[kd_gd_bahan]'
                 WHERE id='$param[idTransaksi]'";
    $QUpdate3 = "UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok - $param[stok]
                 WHERE kd_gd_bahan = '$param[kd_gd_bahan]'";

    $this->db->query($QUpdate1)->result_array();
    $this->db->query($QUpdate2)->result_array();
    $this->db->query($QUpdate3)->result_array();

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateHasilExtruder($param){
    $this->db->trans_begin();
    $clearArrayKey = array("jumlahPermintaan");
    $QgetBeratBersihSebelumnya = "SELECT (jumlah_selesai - roll_pipa) AS beratBersihSebelumnya
                                  FROM transaksi_hasil_extruder
                                  WHERE id_hasil_extruder = '$param[id_hasil_extruder]'";
    $resutBeratBersihSebelumnya = $this->db->query($QgetBeratBersihSebelumnya)->result_array();
    $beratBersihSebelumnya = $resutBeratBersihSebelumnya[0]["beratBersihSebelumnya"];
    $beratBersih = $param["jumlah_selesai"]-$param["roll_pipa"];

    $this->db->query("UPDATE rencana_extruder SET jml_permintaan = jml_permintaan + $beratBersihSebelumnya, shift = '$param[shift]'
                      WHERE kd_extruder = '$param[kd_extruder]'");

    $this->db->query("UPDATE rencana_extruder SET jml_permintaan = jml_permintaan-$beratBersih, shift = '$param[shift]'
                      WHERE kd_extruder = '$param[kd_extruder]'");

    $checkJmlPermintaan = $this->db->query("SELECT kd_ppic,jml_permintaan FROM rencana_extruder WHERE kd_extruder='$param[kd_extruder]'")->result_array();
    $kdPpic = $checkJmlPermintaan[0]["kd_ppic"];

    $this->db->query("UPDATE rencana_ppic SET sisa = sisa+$beratBersihSebelumnya
                      WHERE kd_ppic='$kdPpic'");

    $this->db->query("UPDATE rencana_ppic SET sisa = sisa-$beratBersih
                      WHERE kd_ppic='$kdPpic'");
    if($checkJmlPermintaan[0]["jml_permintaan"] <= 0){
      $this->db->query("UPDATE rencana_extruder SET sts_pengerjaan='COMPLETE' WHERE kd_extruder='$param[kd_extruder]'");
      $this->db->query("UPDATE rencana_ppic SET sts_pengerjaan='FINISH' WHERE kd_ppic='$checkJmlPermintaan[0][kd_ppic]'");
    }

    $this->db->where("id_hasil_extruder",$param["id_hasil_extruder"]);
    $this->db->update("transaksi_hasil_extruder",array_diff_key($param,array_flip($clearArrayKey)));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateKirimDanBatalKirimHasilExtruder($param){
    $this->db->trans_begin();
    if($param["kirim_ke_ppic"] == "TRUE"){
      $Q = "UPDATE transaksi_data_job_extruder SET kirim_ke_ppic='$param[kirim_ke_ppic]'
            WHERE id_data = '$param[id_data]'
            AND kirim_ke_ppic = 'FALSE'";
    }else{
      $Q = "UPDATE transaksi_data_job_extruder SET kirim_ke_ppic='$param[kirim_ke_ppic]'
            WHERE id_data = '$param[id_data]'
            AND kirim_ke_ppic = 'TRUE'";
    }
    $this->db->query($Q);
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

  public function updateKirimDataBonApal($param){
    $this->db->trans_begin();
    $this->db->query("UPDATE transaksi_detail_history_apal SET sts_transaksi='PROGRESS'
                      WHERE tgl_transaksi = '$param'
                      AND sts_transaksi='PENDING'");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateKirimKembalianBahanBaku(){
    $this->db->trans_begin();
    $this->db->query("UPDATE transaksi_gudang_bahan TGB
                      INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                      SET TGB.status='PROGRESS'
                      WHERE TGB.status='PENDING'
                      AND GB.jenis='BAHAN BAKU'");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateKirimKembalianBijiWarna(){
    $this->db->trans_begin();
    $this->db->query("UPDATE transaksi_gudang_bahan TGB
                      INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                      SET TGB.status='PROGRESS'
                      WHERE TGB.status='PENDING'
                      AND GB.jenis='BIJI WARNA'");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateLaporanRencanaMandor($param){
    $this->db->trans_begin();
    $idHasilExtruder = $param["THE"][0]["id_hasil_extruder"];
    $dataHasilExtruder = $this->db->query("SELECT kd_extruder, tgl_rencana, jumlah_biji_warna,
                                                  pemakaian_strip, sts_pengiriman, jumlah_selesai,
                                                  roll_lembar, jenis_roll, roll_pipa, shift
                                           FROM transaksi_hasil_extruder
                                           WHERE deleted='FALSE'
                                           AND id_hasil_extruder='$idHasilExtruder'")->result_array();
    //============ Update Pemakaian Strip ============//
    $pemakaianStrip = explode("#",$dataHasilExtruder[0]["pemakaian_strip"]);
    for ($i=0; $i < count($pemakaianStrip); $i++) {
      //=======Select Kode Bahan=======//
      $this->db->select("kd_gd_bahan");
      $this->db->from("transaksi_gudang_buffer_extruder");
      $this->db->where("kd_extruder",$dataHasilExtruder[0]["kd_extruder"]);
      $this->db->where("tgl_transaksi",$dataHasilExtruder[0]["tgl_rencana"]);
      $this->db->where("jumlah", $pemakaianStrip[$i]);
      $this->db->where("keterangan_history", "PEMAKAIAN STRIP");
      $this->db->where("deleted","FALSE");
      $kodeBahan = $this->db->get()->result_array();
      //=======Select Kode Bahan=======//

      //=======Update Gudang Buffer Extruder=======//
      if(!empty($kodeBahan[0]["kd_gd_bahan"])){
        $this->db->set("jumlah_stok","jumlah_stok + ".$pemakaianStrip[$i], FALSE);
        $this->db->where("kd_gd_bahan",$kodeBahan[0]["kd_gd_bahan"]);
        $this->db->update("gudang_buffer_extruder");

        $this->db->set("jumlah_stok","jumlah_stok - ".$param["TGBE_PS"][$i]["stok"], FALSE);
        $this->db->where("kd_gd_bahan",$param["TGBE_PS"][$i]["kd_gd_bahan"]);
        $this->db->update("gudang_buffer_extruder");
      }

      //=======Update Gudang Buffer Extruder=======//

      //=======Update Transaksi Gudang Buffer Extruder=======//
      $this->db->set("kd_gd_bahan", $param["TGBE_PS"][$i]["kd_gd_bahan"]);
      $this->db->set("tgl_transaksi", $param["TGBE_PS"][$i]["tgl_transaksi"]);
      $this->db->set("jumlah", $param["TGBE_PS"][$i]["stok"]);
      $this->db->where("kd_extruder",$dataHasilExtruder[0]["kd_extruder"]);
      $this->db->where("tgl_transaksi",$dataHasilExtruder[0]["tgl_rencana"]);
      $this->db->where("jumlah", $pemakaianStrip[$i]);
      $this->db->where("keterangan_history", "PEMAKAIAN STRIP");
      $this->db->where("deleted","FALSE");
      $this->db->update("transaksi_gudang_buffer_extruder");
      //=======Update Transaksi Gudang Buffer Extruder=======//
    }
    //============ Update Pemakaian Strip ============//

    //============ Update Pemakaian Extruder ============//
    //=======Select Kode Bahan=======//
    $this->db->select("kd_gd_bahan");
    $this->db->from("transaksi_gudang_buffer_extruder");
    $this->db->where("kd_extruder",$dataHasilExtruder[0]["kd_extruder"]);
    $this->db->where("tgl_transaksi",$dataHasilExtruder[0]["tgl_rencana"]);
    $this->db->where("jumlah", $dataHasilExtruder[0]["jumlah_biji_warna"]);
    $this->db->where("keterangan_history", "PEMAKAIAN EXTRUDER");
    $this->db->where("deleted","FALSE");
    $kodeBahan = $this->db->get()->result_array();
    //=======Select Kode Bahan=======//

    //=======Update Gudang Buffer Extruder=======//
    if(count($kodeBahan) > 0){
      $this->db->set("jumlah_stok","jumlah_stok + ".$dataHasilExtruder[0]["jumlah_biji_warna"], FALSE);
      if(array_key_exists("kd_gd_bahan",$param["TGBE_PE"][0])){
        $this->db->where("kd_gd_bahan",NULL);
      }else{
        $this->db->where("kd_gd_bahan",$kodeBahan[0]["kd_gd_bahan"]);
      }
      $this->db->update("gudang_buffer_extruder");

      $this->db->set("jumlah_stok","jumlah_stok - ".$param["TGBE_PE"][0]["stok"], FALSE);
      if(array_key_exists("kd_gd_bahan",$param["TGBE_PE"][0])){
        $this->db->where("kd_gd_bahan",$param["TGBE_PE"][0]["kd_gd_bahan"]);
      }else{
        $this->db->where("kd_gd_bahan",NULL);
      }
      $this->db->update("gudang_buffer_extruder");
    }else{
      if(array_key_exists("kd_gd_bahan",$param["TGBE_PE"][0])){
        $this->db->query("UPDATE gudang_buffer_extruder SET jumlah_stok = jumlah_stok -".$param["TGBE_PE"][0]["stok"]."
                          WHERE kd_gd_bahan = '".$param["TGBE_PE"][0]["kd_gd_bahan"]."'");
        $this->db->query("INSERT INTO transaksi_gudang_buffer_extruder (kd_gd_bahan, kd_extruder, id_user, tgl_transaksi, jumlah, bagian, keterangan_history)
                          VALUES ('".$param["TGBE_PE"][0]["kd_gd_bahan"]."','"
                          .$param["TGBE_PE"][0]["kd_extruder"]."','"
                          .$param["TGBE_PE"][0]["id_user"]."','"
                          .$param["TGBE_PE"][0]["tgl_transaksi"]."','"
                          .$param["TGBE_PE"][0]["stok"]."','"
                          .$param["TGBE_PE"][0]["bagian"]."','"
                          .$param["TGBE_PE"][0]["keterangan_history"]."')");
      }else{
        $this->db->query("INSERT INTO transaksi_gudang_buffer_extruder (kd_extruder, id_user, tgl_transaksi, jumlah, bagian, keterangan_history)
                          VALUES ('".$param["TGBE_PE"][0]["kd_extruder"]."','"
                          .$param["TGBE_PE"][0]["id_user"]."','"
                          .$param["TGBE_PE"][0]["tgl_transaksi"]."','"
                          .$param["TGBE_PE"][0]["stok"]."','"
                          .$param["TGBE_PE"][0]["bagian"]."','"
                          .$param["TGBE_PE"][0]["keterangan_history"]."')");
      }
    }
    //=======Update Gudang Buffer Extruder=======//

    //=======Update Transaksi Gudang Buffer Extruder=======//
    $this->db->set("kd_gd_bahan", $param["TGBE_PE"][0]["kd_gd_bahan"]);
    $this->db->set("tgl_transaksi", $param["TGBE_PE"][0]["tgl_transaksi"]);
    $this->db->set("jumlah", $param["TGBE_PE"][0]["stok"]);
    $this->db->where("kd_extruder",$dataHasilExtruder[0]["kd_extruder"]);
    $this->db->where("tgl_transaksi",$dataHasilExtruder[0]["tgl_rencana"]);
    $this->db->where("jumlah", $dataHasilExtruder[0]["jumlah_biji_warna"]);
    $this->db->where("keterangan_history", "PEMAKAIAN EXTRUDER");
    $this->db->where("deleted","FALSE");
    $this->db->update("transaksi_gudang_buffer_extruder");
    //=======Update Transaksi Gudang Buffer Extruder=======//

    //============ Update Pemakaian Extruder ============//

    //============ Update Transaksi Gudang Roll Jika Status Pengiriman TRUE ===========//
    if($dataHasilExtruder[0]["sts_pengiriman"] == "TRUE"){
      if($dataHasilExtruder[0]["jenis_roll"] == "PAYUNG"){
        $clause = "payung = '".$dataHasilExtruder[0]["roll_lembar"]."'";
      }else if($dataHasilExtruder[0]["jenis_roll"] == "PAYUNG_KUNING"){
        $clause = "payung_kuning = '".$dataHasilExtruder[0]["roll_lembar"]."'";
      }else{
        $clause = "bobin = '".$dataHasilExtruder[0]["roll_lembar"]."'";
      }
      $QCheckApprove = "SELECT id, kd_gd_roll,status_transaksi,berat, bobin,payung,payung_kuning FROM transaksi_gudang_roll
                        WHERE tgl_transaksi = '".$dataHasilExtruder[0]["tgl_rencana"]."'
                        AND bagian = 'EXTRUDER'
                        AND keterangan_transaksi = 'Hasil Extruder Tanggal ".$dataHasilExtruder[0]["tgl_rencana"]."'
                        AND status_history = 'MASUK'
                        AND keterangan_history = 'HASIL EXTRUDER'
                        AND berat = '".$dataHasilExtruder[0]["jumlah_selesai"]."'
                        AND ".$clause."
                        AND deleted='FALSE'";
      $resultCheckApprove = $this->db->query($QCheckApprove)->result_array();
      if($resultCheckApprove[0]["status_transaksi"] == "PROGRESS"){
        $this->db->set("berat", $param["THE"][0]["jumlah_selesai"]);
        if($param["THE"][0]["jenis_roll"] == "PAYUNG"){
          $this->db->set("payung", $param["THE"][0]["roll_lembar"]);
        }else if($param["THE"][0]["jenis_roll"] == "PAYUNG_KUNING"){
          $this->db->set("payung_kuning", $param["THE"][0]["roll_lembar"]);
        }else{
          $this->db->set("bobin", $param["THE"][0]["roll_lembar"]);
        }
        $this->db->where("id",$resultCheckApprove[0]["id"]);
        // $this->db->where("tgl_transaksi",$dataHasilExtruder[0]["tgl_rencana"]);
        // $this->db->where("bagian","EXTRUDER");
        // $this->db->where("keterangan_transaksi","Hasil Extruder Tanggal ".$dataHasilExtruder[0]["tgl_rencana"]);
        // $this->db->where("status_history","MASUK");
        // $this->db->where("keterangan_history","HASIL EXTRUDER");
        // $this->db->where("berat",$dataHasilExtruder[0]["jumlah_selesai"]);
        // $this->db->where("deleted","FALSE");
        // if($dataHasilExtruder[0]["jenis_roll"] == "PAYUNG"){
        //   $this->db->where("payung",$dataHasilExtruder[0]["roll_lembar"]);
        // }else if($dataHasilExtruder[0]["jenis_roll"] == "PAYUNG_KUNING"){
        //   $this->db->where("payung_kuning",$dataHasilExtruder[0]["roll_lembar"]);
        // }else{
        //   $this->db->where("bobin",$dataHasilExtruder[0]["roll_lembar"]);
        // }
        $this->db->update("transaksi_gudang_roll");
      }else if($resultCheckApprove[0]["status_transaksi"] == "FINISH"){
        $this->db->set("stok","stok + ".($dataHasilExtruder[0]["jumlah_selesai"]-$param["THE"][0]["jumlah_selesai"]), FALSE);
        if($param["THE"][0]["jenis_roll"] == "PAYUNG"){
          $this->db->set("payung", "payung + ".($dataHasilExtruder[0]["roll_lembar"]-$param["THE"][0]["roll_lembar"]), FALSE);
        }else if($param["THE"][0]["jenis_roll"] == "PAYUNG_KUNING"){
          $this->db->set("payung_kuning", "payung_kuning + ".($dataHasilExtruder[0]["roll_lembar"]-$param["THE"][0]["roll_lembar"]), FALSE);
        }else{
          $this->db->set("bobin", "bobin + ".($dataHasilExtruder[0]["roll_lembar"]-$param["THE"][0]["roll_lembar"]),FALSE);
        }
        $this->db->where("kd_gd_roll",$resultCheckApprove[0]["kd_gd_roll"]);
        $this->db->update("gudang_roll");

        $this->db->set("berat", $param["THE"][0]["jumlah_selesai"]);
        if($param["THE"][0]["jenis_roll"] == "PAYUNG"){
          $this->db->set("payung", $param["THE"][0]["roll_lembar"]);
        }else if($param["THE"][0]["jenis_roll"] == "PAYUNG_KUNING"){
          $this->db->set("payung_kuning", $param["THE"][0]["roll_lembar"]);
        }else{
          $this->db->set("bobin", $param["THE"][0]["roll_lembar"]);
        }
        $this->db->where("id",$resultCheckApprove[0]["id"]);
        // $this->db->where("tgl_transaksi",$dataHasilExtruder[0]["tgl_rencana"]);
        // $this->db->where("bagian","EXTRUDER");
        // $this->db->where("keterangan_transaksi","Hasil Extruder Tanggal ".$dataHasilExtruder[0]["tgl_rencana"]);
        // $this->db->where("status_history","MASUK");
        // $this->db->where("keterangan_history","HASIL EXTRUDER");
        // $this->db->where("berat",$dataHasilExtruder[0]["jumlah_selesai"]);
        // $this->db->where("deleted","FALSE");
        // if($dataHasilExtruder[0]["jenis_roll"] == "PAYUNG"){
        //   $this->db->where("payung",$dataHasilExtruder[0]["roll_lembar"]);
        // }else if($dataHasilExtruder[0]["jenis_roll"] == "PAYUNG_KUNING"){
        //   $this->db->where("payung_kuning",$dataHasilExtruder[0]["roll_lembar"]);
        // }else{
        //   $this->db->where("bobin",$dataHasilExtruder[0]["roll_lembar"]);
        // }
        $this->db->update("transaksi_gudang_roll");
      }
    }
    //============ Update Transaksi Gudang Roll Jika Status Pengiriman TRUE ===========//

    //============ Update Transaksi Data Job Extruder ============//
    $jumlahBijiWarnaLama = $dataHasilExtruder[0]["jumlah_biji_warna"];
    $jumlahBijiWarnaBaru = $param["THE"][0]["jumlah_biji_warna"];
    for ($i=0; $i < count($pemakaianStrip); $i++) {
      $jumlahStrip = ($param["TGBE_PS"][$i]["stok"] - $pemakaianStrip[$i]);
    }
    $jumlahTotalBijiWarna = ($jumlahBijiWarnaBaru - $jumlahBijiWarnaLama);
    $this->db->set("total_biji_warna","total_biji_warna + ".($jumlahTotalBijiWarna + $jumlahStrip), FALSE);
    $this->db->where("tgl_rencana",$param["THE"][0]["tgl_rencana"]);
    $this->db->where("shift",$dataHasilExtruder[0]["shift"]);
    $this->db->update("transaksi_data_job_extruder");
    //============ Update Transaksi Data Job Extruder ============//

    //============ Update Jumlah Sisa Permintaan ============//
    $kdExtruder = $param["THE"][0]["kd_extruder"];
    $arrKdPpic = $this->db->query("SELECT kd_ppic FROM rencana_extruder WHERE kd_extruder='$kdExtruder'")->result_array();
    $kdPpic = $arrKdPpic[0]["kd_ppic"];
    $beratBersihLama = $dataHasilExtruder[0]["jumlah_selesai"] - $dataHasilExtruder[0]["roll_pipa"];
    $beratBersihBaru = $param["THE"][0]["jumlah_selesai"] - $param["THE"][0]["roll_pipa"];
    //======= Update Rencana Extruder =======//
    $this->db->set("jml_permintaan","jml_permintaan + ".($beratBersihLama-$beratBersihBaru), FALSE);
    $this->db->where("kd_extruder",$kdExtruder);
    $this->db->update("rencana_extruder");
    //======= Update Rencana Extruder =======//

    //======= Update Rencana Extruder =======//
    $this->db->set("sisa","sisa + ".($beratBersihLama-$beratBersihBaru), FALSE);
    $this->db->where("kd_ppic",$kdPpic);
    $this->db->update("rencana_ppic");
    //======= Update Rencana Extruder =======//

    //============ Update Jumlah Sisa Permintaan ============//

    //============ Update Transaksi Hasil Extruder ============//
    $clearArrayKey = array("kdExtruderBaru","kdPpicBaru","kdGdRollBaru","ukuranBaru","merekBaru","warnaPlastik");
    $this->db->where("id_hasil_extruder", $idHasilExtruder);
    $this->db->update("transaksi_hasil_extruder", array_diff_key($param["THE"][0],array_flip($clearArrayKey)));
    //============ Update Transaksi Hasil Extruder ============//

    //============ Update Perpindahan Transaksi Hasil Extruder ============//
    if(!empty($param["THE"][0]["kdExtruderBaru"])){
      $dataHasilExtruder2 = $this->db->query("SELECT kd_extruder, tgl_rencana, jumlah_biji_warna,
                                                    pemakaian_strip, sts_pengiriman, jumlah_selesai,
                                                    roll_lembar, jenis_roll, roll_pipa, shift
                                             FROM transaksi_hasil_extruder
                                             WHERE deleted='FALSE'
                                             AND id_hasil_extruder='$idHasilExtruder'")->result_array();

       if($dataHasilExtruder2[0]["jenis_roll"] == "PAYUNG"){
         $clause2 = "payung = '".$dataHasilExtruder2[0]["roll_lembar"]."'";
       }else if($dataHasilExtruder[0]["jenis_roll"] == "PAYUNG_KUNING"){
         $clause2 = "payung_kuning = '".$dataHasilExtruder2[0]["roll_lembar"]."'";
       }else{
         $clause2 = "bobin = '".$dataHasilExtruder2[0]["roll_lembar"]."'";
       }
       $QCheckApprove2 = "SELECT id, kd_gd_roll,status_transaksi,berat, bobin,payung,payung_kuning FROM transaksi_gudang_roll
                         WHERE tgl_transaksi = '".$dataHasilExtruder2[0]["tgl_rencana"]."'
                         AND bagian = 'EXTRUDER'
                         AND keterangan_transaksi = 'Hasil Extruder Tanggal ".$dataHasilExtruder2[0]["tgl_rencana"]."'
                         AND status_history = 'MASUK'
                         AND keterangan_history = 'HASIL EXTRUDER'
                         AND berat = '".$dataHasilExtruder2[0]["jumlah_selesai"]."'
                         AND ".$clause2."
                         AND deleted='FALSE'";
       $resultCheckApprove2 = $this->db->query($QCheckApprove2)->result_array();
      //============ Pindah Dari Kode Lama Ke Kode Baru ============//
      $this->db->set("kd_extruder",$param["THE"][0]["kdExtruderBaru"]);
      $this->db->set("kd_gd_roll",$param["THE"][0]["kdGdRollBaru"]);
      $this->db->where("id_hasil_extruder", $idHasilExtruder);
      $this->db->update("transaksi_hasil_extruder");
      //============ Pindah Dari Kode Lama Ke Kode Baru ============//

      //============ Pindah Kode Transaksi Gudang Roll Jika Sudah Dikirim ============//
      if($dataHasilExtruder2[0]["sts_pengiriman"] == "TRUE"){
        if($resultCheckApprove2[0]["status_transaksi"] == "PROGRESS"){
          $this->db->set("kd_gd_roll",$param["THE"][0]["kdGdRollBaru"]);
          $this->db->where("id",$resultCheckApprove2[0]["id"]);
          $this->db->update("transaksi_gudang_roll");
        }else if($resultCheckApprove2[0]["status_transaksi"] == "FINISH"){
          $this->db->set("stok","stok - ".$resultCheckApprove2[0]["berat"],FALSE);
          $this->db->set("bobin","bobin - ".$resultCheckApprove2[0]["bobin"],FALSE);
          $this->db->set("payung","payung - ".$resultCheckApprove2[0]["payung"],FALSE);
          $this->db->set("payung_kuning","payung_kuning - ".$resultCheckApprove2[0]["payung_kuning"],FALSE);
          $this->db->where("kd_gd_roll",$resultCheckApprove2[0]["kd_gd_roll"]);
          $this->db->update("gudang_roll");

          $this->db->set("stok","stok + ".$param["THE"][0]["jumlah_selesai"],FALSE);
          if($param["THE"][0]["jenis_roll"] == "PAYUNG"){
            $this->db->set("payung", "payung + ".$param["THE"][0]["roll_lembar"], FALSE);
          }else if($param["THE"][0]["jenis_roll"] == "PAYUNG_KUNING"){
            $this->db->set("payung_kuning", "payung_kuning + ".$param["THE"][0]["roll_lembar"], FALSE);
          }else{
            $this->db->set("bobin", "bobin + ".$param["THE"][0]["roll_lembar"],FALSE);
          }
          $this->db->where("kd_gd_roll",$param["THE"][0]["kdGdRollBaru"]);
          $this->db->update("gudang_roll");

          $this->db->set("kd_gd_roll",$param["THE"][0]["kdGdRollBaru"]);
          $this->db->where("id",$resultCheckApprove2[0]["id"]);
          $this->db->update("transaksi_gudang_roll");
        }
      }

      $this->db->set("kd_extruder",$param["THE"][0]["kdExtruderBaru"]);
      $this->db->set("kd_gd_roll",$param["THE"][0]["kdGdRollBaru"]);
      $this->db->set("warna_plastik",$param["THE"][0]["warnaPlastik"]);
      $this->db->set("hasil_ukuran",$param["THE"][0]["ukuranBaru"]);
      $this->db->set("merek",$param["THE"][0]["merekBaru"]);
      $this->db->where("id_hasil_extruder",$param["THE"][0]["id_hasil_extruder"]);
      $this->db->update("transaksi_hasil_extruder");

      $this->db->set("jml_permintaan","jml_permintaan + ".($dataHasilExtruder2[0]["jumlah_selesai"] - $dataHasilExtruder2[0]["roll_pipa"]),FALSE);
      $this->db->where("kd_extruder",$dataHasilExtruder2[0]["kd_extruder"]);
      $this->db->update("rencana_extruder");

      $this->db->set("sisa","sisa + ".($dataHasilExtruder2[0]["jumlah_selesai"] - $dataHasilExtruder2[0]["roll_pipa"]),FALSE);
      $this->db->where("kd_ppic",$kdPpic);
      $this->db->update("rencana_ppic");


      $this->db->set("jml_permintaan","jml_permintaan - ".($dataHasilExtruder2[0]["jumlah_selesai"] - $dataHasilExtruder2[0]["roll_pipa"]),FALSE);
      $this->db->where("kd_extruder",$param["THE"][0]["kdExtruderBaru"]);
      $this->db->update("rencana_extruder");

      $this->db->set("sisa","sisa - ".($dataHasilExtruder2[0]["jumlah_selesai"] - $dataHasilExtruder2[0]["roll_pipa"]),FALSE);
      $this->db->where("kd_ppic",$param["THE"][0]["kdPpicBaru"]);
      $this->db->update("rencana_ppic");

      $kdExtruderLama = $dataHasilExtruder2[0]["kd_extruder"];
      $kdExtruderBaru = $param["THE"][0]["kdExtruderBaru"];
      $checkStatusRencanaLama = $this->db->query("SELECT jml_permintaan FROM rencana_extruder WHERE kd_extruder='$kdExtruderLama'")->result_array();
      $checkStatusRencanaBaru = $this->db->query("SELECT jml_permintaan FROM rencana_extruder WHERE kd_extruder='$kdExtruderBaru'")->result_array();

      if($checkStatusRencanaLama[0]["jml_permintaan"] <= 0){
        $this->db->set("sts_pengerjaan","COMPLETE");
        $this->db->where("kd_extruder",$kdExtruderLama);
        $this->db->update("rencana_extruder");

        $this->db->set("sts_pengerjaan","FINISH");
        $this->db->where("kd_ppic",$kdPpic);
        $this->db->update("rencana_ppic");
      }else{
        $this->db->set("sts_pengerjaan","PROGRESS");
        $this->db->where("kd_extruder",$kdExtruderLama);
        $this->db->update("rencana_extruder");

        $this->db->set("sts_pengerjaan","PROGRESS");
        $this->db->where("kd_ppic",$kdPpic);
        $this->db->update("rencana_ppic");
      }

      if($checkStatusRencanaBaru[0]["jml_permintaan"] <= 0){
        $this->db->set("sts_pengerjaan","COMPLETE");
        $this->db->where("kd_extruder",$kdExtruderBaru);
        $this->db->update("rencana_extruder");
      }else{
        $this->db->set("sts_pengerjaan","PROGRESS");
        $this->db->where("kd_extruder",$kdExtruderBaru);
        $this->db->update("rencana_extruder");
      }
    }
    //============ Update Perpindahan Transaksi Hasil Extruder ============//
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  function updateDataJobExtruder($param){
    $this->db->trans_begin();
    $this->db->where("id_data", $param["id_data"]);
    $this->db->update("transaksi_data_job_extruder",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateDeleteAndRestoreHasilExtruderTemp($param){
    $this->db->trans_begin();
    $QDataHasilExtruder = "SELECT * FROM transaksi_hasil_extruder
                           WHERE id_hasil_extruder='$param[id_hasil_extruder]'";
    $arrDataHasilExtruder = $this->db->query($QDataHasilExtruder)->result_array();

    $QDataGudangBufferExtruder = "SELECT * FROM transaksi_gudang_buffer_extruder
                                  WHERE kd_extruder = '".$arrDataHasilExtruder[0]["kd_extruder"]."'
                                  AND tgl_transaksi = '".$arrDataHasilExtruder[0]["tgl_rencana"]."'
                                  AND deleted='FALSE'";
    $arrDataGudangBufferExtruder = $this->db->query($QDataGudangBufferExtruder)->result_array();

    $beratKotor = floatval($arrDataHasilExtruder[0]["jumlah_selesai"]);
    $rollPipa = floatval($arrDataHasilExtruder[0]["roll_pipa"]);
    $kdExtruder = $arrDataHasilExtruder[0]["kd_extruder"];
    $tglRencana = $arrDataHasilExtruder[0]["tgl_rencana"];
    $beratBersih = $beratKotor - $rollPipa;

    if($param["deleted"] == "TRUE"){
      foreach ($arrDataGudangBufferExtruder as $key) {
        $this->db->set("stok","stok + ".$key["jumlah"],FALSE);
        $this->db->where("kd_gd_bahan",$key["kd_gd_bahan"]);
        $this->db->update("gudang_bahan");
      }
      $this->db->set("deleted","TRUE");
      $this->db->where("kd_extruder",$kdExtruder);
      $this->db->where("tgl_transaksi",$tglRencana);
      $this->db->update("transaksi_gudang_buffer_extruder");

      $QDetailRencanaExtruder = "SELECT * FROM rencana_extruder WHERE kd_extruder='$kdExtruder'";
      $arrDetailRencanaExtruder = $this->db->query($QDetailRencanaExtruder)->result_array();

      $this->db->set("jml_permintaan","jml_permintaan + ".$beratBersih,FALSE);
      if(floatval($arrDetailRencanaExtruder[0]["jml_permintaan"]) + $beratBersih > 0){
        $this->db->set("sts_pengerjaan","PROGRESS");
      }
      $this->db->where("kd_extruder",$kdExtruder);
      $this->db->update("rencana_extruder");

      if(!empty($arrDetailRencanaExtruder[0]["kd_ppic"])){
        $this->db->set("sisa","sisa + ".$beratBersih,FALSE);
        if(floatval($arrDetailRencanaExtruder[0]["jml_permintaan"]) + $beratBersih > 0){
          $this->db->set("sts_pengerjaan","PROGRESS");
        }
        $this->db->where("kd_ppic",$arrDetailRencanaExtruder[0]["kd_ppic"]);
        $this->db->update("rencana_ppic");
      }

      $this->db->where("id_hasil_extruder",$param["id_hasil_extruder"]);
      $this->db->update("transaksi_hasil_extruder",$param);
    }else{
      foreach ($arrDataGudangBufferExtruder as $key) {
        $this->db->set("stok","stok - ".$key["jumlah"],FALSE);
        $this->db->where("kd_gd_bahan",$key["kd_gd_bahan"]);
        $this->db->update("gudang_bahan");
      }
      $this->db->set("deleted","FALSE");
      $this->db->where("kd_extruder",$kdExtruder);
      $this->db->where("tgl_transaksi",$tglRencana);
      $this->db->update("transaksi_gudang_buffer_extruder");

      $QDetailRencanaExtruder = "SELECT * FROM rencana_extruder WHERE kd_extruder='$kdExtruder'";
      $arrDetailRencanaExtruder = $this->db->query($QDetailRencanaExtruder)->result_array();

      $this->db->set("jml_permintaan","jml_permintaan - ".$beratBersih,FALSE);
      if(floatval($arrDetailRencanaExtruder[0]["jml_permintaan"]) - $beratBersih <= 0){
        $this->db->set("sts_pengerjaan","COMPLETE");
      }
      $this->db->where("kd_extruder",$kdExtruder);
      $this->db->update("rencana_extruder");

      if(!empty($arrDetailRencanaExtruder[0]["kd_ppic"])){
        $this->db->set("sisa","sisa - ".$beratBersih,FALSE);
        if(floatval($arrDetailRencanaExtruder[0]["jml_permintaan"]) - $beratBersih <= 0){
          $this->db->set("sts_pengerjaan","FINISH");
        }
        $this->db->where("kd_ppic",$arrDetailRencanaExtruder[0]["kd_ppic"]);
        $this->db->update("rencana_ppic");
      }

      $this->db->where("id_hasil_extruder",$param["id_hasil_extruder"]);
      $this->db->update("transaksi_hasil_extruder",$param);
    }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function updateStatusRencanaExtruder($param){
    $this->db->trans_begin();
    $this->db->query("UPDATE rencana_extruder SET sts_pengerjaan = '$param[sts_pengerjaan]',id_user='$param[id_user]' WHERE kd_extruder='$param[kd_extruder]'");
    if(!empty($param["sts_pengerjaan"])){
      $this->db->query("UPDATE rencana_ppic SET sts_pengerjaan = 'FINISH',id_user='$param[id_user]' WHERE kd_ppic='$param[kd_ppic]'");
    }
    if($this->db->trans_status() === FALSE){
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
