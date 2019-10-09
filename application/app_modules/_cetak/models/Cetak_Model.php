<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cetak_Model extends CI_Model{
  #=========================Get Code Function (Start)=========================#
  public function generatePotongCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_cetak,4)) AS kode FROM rencana_cetak WHERE SUBSTRING(kd_cetak,4,6) = DATE_FORMAT(NOW(),'%y%m%d')");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "000";
      }
      $tempCode = "000".(intval($arrMaxCode->kode)+1);
      $fixCode = "CTK".date("ymd").substr($tempCode,(strlen($tempCode)-4));
    }
    return $fixCode;
  }

  public function generateInputHasilCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_hasil_cetak,4)) AS kode FROM transaksi_hasil_cetak WHERE SUBSTRING(kd_hasil_cetak,4,6) = DATE_FORMAT(NOW(),'%y%m%d')");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "000";
      }
      $tempCode = "000".(intval($arrMaxCode->kode)+1);
      $fixCode = "TRC".date("ymd").substr($tempCode,(strlen($tempCode)-4));
    }
    return $fixCode;
  }
  #=========================Get Code Function (Finish)=========================#

  #=========================Insert Function (Start)=========================#
  function insertRencanaCetak($param){
    $this->db->trans_begin();
    $this->db->insert("rencana_cetak", $param);
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  function insertHasilCetak($param){
    $this->db->trans_begin();
    $this->db->insert("transaksi_hasil_cetak",$param["THC"]);
    $this->db->insert("transaksi_detail_hasil_cetak",$param["TDHC"]);
    $this->db->insert_batch("transaksi_penggunaan_bahan_cetak",$param["TPBC"]);

    #============ Update Jumlah Permintaan Rencana Cetak (Start)============#
    $this->db->set("jml_permintaan","jml_permintaan-".$param["THC"]["jumlah_selesai"], FALSE);
    $this->db->where("kd_cetak",$param["THC"]["kd_cetak"]);
    $this->db->update("rencana_cetak");
    #============ Update Jumlah Permintaan Rencana Cetak (Finish)============#

    #============ Update Jumlah Permintaan Rencana PPIC (Start)============#
    $arrKodePPIC = $this->db->query("SELECT kd_ppic FROM rencana_cetak WHERE kd_cetak='".$param["THC"]["kd_cetak"]."'")->result_array();
    if(!empty($arrKodePPIC[0]["kd_ppic"])){
      $this->db->set("sisa","sisa-".$param["THC"]["jumlah_selesai"], FALSE);
      $this->db->where("kd_ppic",$arrKodePPIC[0]["kd_ppic"]);
      $this->db->update("rencana_ppic");
    }
    #============ Update Jumlah Permintaan Rencana PPIC (Finish)============#

    $arrJumlahPermintaan = $this->db->query("SELECT jml_permintaan FROM rencana_cetak WHERE kd_cetak='".$param["THC"]["kd_cetak"]."'")->result_array();
    if($arrJumlahPermintaan[0]["jml_permintaan"] <= 0){
      $this->db->set("sts_pengerjaan","FINISH");
      $this->db->where("kd_cetak",$param["THC"]["kd_cetak"]);
      $this->db->update("rencana_cetak");

      if(!empty($arrKodePPIC[0]["kd_ppic"])){
        $this->db->set("sts_pengerjaan","FINISH");
        $this->db->where("kd_ppic",$arrKodePPIC[0]["kd_ppic"]);
        $this->db->update("rencana_ppic");
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

  public function insertKirimHasilCetak($param){
    $this->db->trans_begin();
    $dateTemp = $param["HasilCetak"][0]["tgl_transaksi"];
    $date = date("Y-m", strtotime($dateTemp));
    $periode = $param["periode"];
    $checkLock = $this->db->query("SELECT COUNT(id) AS counter
                                   FROM transaksi_gudang_roll
                                   WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$date'
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["counter"] > 0){
      return "Lock";
    }else{
      $this->db->insert_batch("transaksi_gudang_roll", $param["HasilCetak"]);
      $this->db->insert_batch("transaksi_gudang_roll", $param["PengambilanPolos"]);
      if(count($param["Apal"]) > 0){
        $this->db->insert_batch("transaksi_detail_history_apal", $param["Apal"]);
      }
      $this->db->query("UPDATE transaksi_detail_hasil_cetak TDHC
                        INNER JOIN transaksi_hasil_cetak THC ON TDHC.kd_hasil_cetak = THC.kd_hasil_cetak
                        SET TDHC.status_bon = 'TRUE'
                        WHERE THC.tgl_transaksi BETWEEN '$periode[tglAwal]' AND '$periode[tglAkhir]'");
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function insertKirimBonPengambilan($param){
    $this->db->trans_begin();
    $tglAwal = $param["Parameter"]["tglAwal"];
    $tglAkhir = $param["Parameter"]["tglAkhir"];
    $jenis = $param["Parameter"]["jenis"];
    $periodeLock = date("Y-m", strtotime($tglAwal));
    $checkLock = $this->db->query("SELECT COUNT(id) AS counter
                                   FROM transaksi_detail_history_apal
                                   WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m') = $periodeLock
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["counter"] > 0){
      return "Lock";
    }else{
      $this->db->insert_batch("transaksi_gudang_bahan",$param["Data"]);
      $this->db->query("UPDATE transaksi_penggunaan_bahan_cetak TPBC
                        INNER JOIN gudang_bahan GB ON TPBC.kd_gd_bahan = GB.kd_gd_bahan
                        SET TPBC.status_bon='TRUE'
                        WHERE TPBC.tgl_pengambilan BETWEEN '$tglAwal' AND '$tglAkhir'
                        AND GB.jenis='$jenis'");
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function insertKirimBonPengembalian($param){
    $this->db->trans_begin();
    $tglAwal = $param["Parameter"]["tglAwal"];
    $tglAkhir = $param["Parameter"]["tglAkhir"];
    $periodeLock = date("Y-m", strtotime($tglAwal));
    $checkLock = $this->db->query("SELECT COUNT(id) AS counter
                                   FROM transaksi_detail_history_apal
                                   WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m') = $periodeLock
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["counter"] > 0){
      return "Lock";
    }else{
      $this->db->insert_batch("transaksi_gudang_bahan",$param["Data"]);
      $this->db->query("UPDATE transaksi_penggunaan_bahan_cetak TPBC
                        INNER JOIN gudang_bahan GB ON TPBC.kd_gd_bahan = GB.kd_gd_bahan
                        SET TPBC.status_bon_sisa='TRUE'
                        WHERE TPBC.tgl_pengambilan BETWEEN '$tglAwal' AND '$tglAkhir'
                        AND GB.jenis='CAT CAMPUR'");
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function insertPengambilanCetakExtruder($param){
    $this->db->trans_begin();
    $periode = date("Y-m");
    $arrCounter = $this->db->query("SELECT COUNT(id) AS counter
                                    FROM transaksi_gudang_roll
                                    WHERE DATE_FORMAT(tgl_transaksi,'%Y-%m') = '$periode'
                                    AND status_lock = 'TRUE'")->result_array();
    if($arrCounter[0]["counter"] > 0){
      return "Lock";
    }else{
      $this->db->insert("transaksi_detail_pengambilan_cetak",$param["TDPC"]);
      $this->db->insert("transaksi_gudang_roll",$param["TGR"]);
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
  public function selectRencanaPPIC($param){
    $this->datatables->select("RP.kd_ppic, RP.tgl_rencana, RP.nm_cust, RP.merek, RP.berat, RP.ukuran, RP.warna_plastik,
                               RP.warna_cat, RP.strip, RP.tebal, RP.jumlah_permintaan, RP.sisa, RP.sts_pengerjaan,
                               RP.prioritas, RP.keterangan, RP.satuan, RP.satuan_kilo");
    $this->datatables->from("rencana_ppic RP");
    $this->datatables->join("gudang_roll GR","RP.kd_gd_roll = GR.kd_gd_roll","INNER");
    $this->datatables->where("RP.bagian='CETAK' AND RP.deleted='FALSE'
                              AND RP.sts_pengerjaan IN('PENDING','PROGRESS')
                              AND GR.deleted='FALSE'
                              AND MONTH(RP.tgl_rencana)='$param[bulan]'
                              AND YEAR(RP.tgl_rencana)='$param[tahun]'");
    $this->db->order_by("RP.tgl_rencana", "DESC");
    return $this->datatables->generate();
  }

  public function selectDetailRencanaPPIC($param){
    $result = $this->db->query("SELECT RP.*, GR.jns_brg FROM rencana_ppic RP
                                INNER JOIN gudang_roll GR ON RP.kd_gd_roll = GR.kd_gd_roll
                                WHERE RP.kd_ppic='$param'")->result_array();
    return json_encode($result);
  }

  public function selectMesin(){
    $result = $this->db->query("SELECT no_mesin FROM mesin ORDER BY kd_mesin ASC LIMIT 11")->result_array();
    return json_encode($result);
  }

  public function selectComboBoxValueGudangRoll($param){
    $panjang = 0;
    if(strpos(strtolower($param["panjangPlastik"]),"pon") !== FALSE){
      $arrX = array("pon"," ");
      $UkuranTemp = str_replace($arrX,"",strtolower($param["panjangPlastik"]));
      $arrUkuranTemp = explode("x",strtolower($UkuranTemp));
      $arrPanjangTemp = explode("+",strtolower($arrUkuranTemp[0]));
    }else{
      $UkuranTemp = str_replace(" ","",strtolower($param["panjangPlastik"]));
      $arrUkuranTemp = explode("x",strtolower($UkuranTemp));
      $arrPanjangTemp = explode("+",strtolower($arrUkuranTemp[0]));
    }
    if(count($arrPanjangTemp) > 2){
      for ($i=0; $i < 2; $i++) {
        $panjang += floatval($arrPanjangTemp[$i]);
      }
    }

    if($panjang > 0){
      $Av = " OR ukuran LIKE '%$panjang%'";
    }else{
      $Av = "";
    }

    if(strpos(strtolower($param["panjangPlastik"]),"%20") !== FALSE){
      $arrUkuran = explode("%20",$param["panjangPlastik"]);
      $clause = "(ukuran LIKE '%$arrUkuran[0]%' OR ukuran LIKE '%$arrUkuran[1]%') $Av";
    }else{
      $clause = "ukuran LIKE '%$param[panjangPlastik]%' $Av";
    }
    $arrData = $this->db->query("SELECT * FROM gudang_roll
                                 WHERE jns_permintaan='$param[JnsPermintaan]'
                                 AND merek NOT LIKE '%zipper%'
                                 AND $clause
                                 AND deleted='FALSE'
                                 LIMIT 20")->result_array();
    return json_encode($arrData);
  }

  public function selectComboBoxValueGudangRollSearch($param){
    $panjang = 0;
    if(strpos(strtolower($param["panjangPlastik"]),"pon") !== FALSE){
      $arrX = array("pon"," ");
      $UkuranTemp = str_replace($arrX,"",strtolower($param["panjangPlastik"]));
      $arrUkuranTemp = explode("x",strtolower($UkuranTemp));
      $arrPanjangTemp = explode("+",strtolower($arrUkuranTemp[0]));
    }else{
      $UkuranTemp = str_replace(" ","",strtolower($param["panjangPlastik"]));
      $arrUkuranTemp = explode("x",strtolower($UkuranTemp));
      $arrPanjangTemp = explode("+",strtolower($arrUkuranTemp[0]));
    }
    if(count($arrPanjangTemp) > 2){
      for ($i=0; $i < 2; $i++) {
        $panjang += floatval($arrPanjangTemp[$i]);
      }
    }

    if($panjang > 0){
      $Av = " OR ukuran LIKE '%$panjang%'";
    }else{
      $Av = "";
    }

    if(strpos(strtolower($param["panjangPlastik"]),"%20") !== FALSE){
      $arrUkuran = explode("%20",$param["panjangPlastik"]);
      $clause = "(ukuran LIKE '%$arrUkuran[0]%' OR ukuran LIKE '%$arrUkuran[1]%' $Av)";
    }else{
      $clause = "ukuran LIKE '%$param[panjangPlastik]%' $Av";
    }
    if(strpos($param["Key"],"|") === FALSE){
      $arrData = $this->db->query("SELECT * FROM gudang_roll WHERE jns_permintaan='$param[JnsPermintaan]'
                                   AND deleted = 'FALSE'
                                   AND (kd_gd_roll LIKE '%$param[Key]%' OR
                                        ukuran LIKE '%$param[Key]%' OR
                                        warna_plastik LIKE '%$param[Key]%' OR
                                        merek LIKE '%$param[Key]%')
                                   AND merek NOT LIKE '%zipper%'
                                   AND $clause")->result_array();
    }else{
      $KeySplit = explode("|",$param["Key"]);
      $arrData = $this->db->query("SELECT * FROM gudang_roll WHERE jns_permintaan='$param[JnsPermintaan]'
                                   AND deleted='FALSE'
                                   AND (ukuran LIKE '%$KeySplit[0]%' AND
                                        warna_plastik LIKE '%$KeySplit[2]%' AND
                                        merek LIKE '%$KeySplit[1]%')
                                   AND merek NOT LIKE '%zipper%'
                                   AND $clause")->result_array();
    }
    return json_encode($arrData);
  }

  public function selectComboBoxValueGudangCetak(){
    $arrData = $this->db->query("SELECT * FROM gudang_roll
                                 WHERE jns_permintaan='CETAK'
                                 AND merek NOT LIKE '%zipper%'
                                 AND deleted='FALSE'
                                 LIMIT 20")->result_array();
    return json_encode($arrData);
  }

  public function selectComboBoxValueGudangCetakSearch($param){
    if(strpos($param["Key"],"|") === FALSE){
      $arrData = $this->db->query("SELECT * FROM gudang_roll WHERE jns_permintaan='CETAK'
                                   AND deleted = 'FALSE'
                                   AND (kd_gd_roll LIKE '%$param[Key]%' OR
                                        ukuran LIKE '%$param[Key]%' OR
                                        warna_plastik LIKE '%$param[Key]%' OR
                                        merek LIKE '%$param[Key]%')
                                   AND merek NOT LIKE '%zipper%'")->result_array();
    }else{
      $KeySplit = explode("|",$param["Key"]);
      $arrData = $this->db->query("SELECT * FROM gudang_roll WHERE jns_permintaan='CETAK'
                                   AND deleted='FALSE'
                                   AND (ukuran LIKE '%$KeySplit[0]%' AND
                                        warna_plastik LIKE '%$KeySplit[2]%' AND
                                        merek LIKE '%$KeySplit[1]%')
                                   AND merek NOT LIKE '%zipper%'")->result_array();
    }
    return json_encode($arrData);
  }

  public function selectRencanaMandorPending(){
    $Q = "SELECT RC.kd_cetak, RC.no_mesin, RC.merek, RC.ukuran, RC.warna_plastik,
                 RC.tebal, RC.jml_permintaan, RC.strip, RC.kd_ppic
          FROM rencana_cetak RC
          INNER JOIN rencana_ppic RP ON RC.kd_ppic = RP.kd_ppic
          INNER JOIN gudang_roll GR ON RC.kd_gd_cetak = GR.kd_gd_roll
          WHERE RC.deleted='FALSE'
          AND RP.deleted='FALSE'
          AND GR.deleted='FALSE'
          AND RC.sts_pengerjaan='PENDING'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectRencanaMandorSusulanPending(){
    $Q = "SELECT RC.kd_cetak, RC.no_mesin, RC.merek, RC.ukuran, RC.warna_plastik, RC.warna_cat,
                 RC.tebal, RC.jml_permintaan, RC.strip, RC.kd_ppic, RC.customer
          FROM rencana_cetak RC
          INNER JOIN gudang_roll GR ON RC.kd_gd_cetak = GR.kd_gd_roll
          WHERE RC.deleted='FALSE'
          AND RC.kd_ppic IS NULL
          AND GR.deleted='FALSE'
          AND RC.sts_pengerjaan='PENDING'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectDetailRencanaMandorPending($param){
    $QRencanaMandor = "SELECT RC.*, RP.prioritas FROM rencana_cetak RC
                       INNER JOIN rencana_ppic RP ON RC.kd_ppic = RP.kd_ppic
                       WHERE kd_cetak='$param[kdCetak]'";
    $QRencanaPPIC = "SELECT * FROM rencana_ppic WHERE kd_ppic='$param[kdPPIC]'";
    $arrDetailRencanaMandor = $this->db->query($QRencanaMandor)->result_array();
    $arrDetailRencanaPPIC = $this->db->query($QRencanaPPIC)->result_array();
    $arrData = array("DetailRencanaMandor" => $arrDetailRencanaMandor,
                     "DetailRencanaPPIC"   => $arrDetailRencanaPPIC);
    return json_encode($arrData);
  }

  public function selectListRencanaMandor(){
    $this->datatables->select("RC.kd_cetak, RC.tgl_rencana, RC.no_mesin, RC.customer, RC.merek,
                               RC.ukuran, RC.warna_plastik, RC.warna_cat, RC.tebal,
                               RC.stok_permintaan, RC.jml_permintaan, RC.sts_pengerjaan, RP.keterangan,
                               RP.sts_pengerjaan AS sts_pengerjaan_ppic");
    $this->datatables->from("rencana_cetak RC");
    $this->datatables->join("rencana_ppic RP","RC.kd_ppic = RP.kd_ppic","LEFT");
    $this->datatables->where("RC.deleted='FALSE' AND
                              RC.sts_pengerjaan IN ('PROGRESS','PENDING')");
    return $this->datatables->generate();
  }

  public function selectDetailRencana($param){
    $Q = "SELECT * FROM rencana_cetak WHERE kd_cetak='$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListCatMurni(){
    $result = $this->db->query("SELECT kd_gd_bahan, nm_barang FROM gudang_bahan WHERE jenis='CAT MURNI' AND deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectListCatCampur(){
    $result = $this->db->query("SELECT kd_gd_bahan, warna FROM gudang_bahan WHERE jenis='CAT CAMPUR' AND deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectListMinyak(){
    $result = $this->db->query("SELECT kd_gd_bahan, nm_barang FROM gudang_bahan WHERE jenis='MINYAK' AND deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectJenisApal(){
    $result = $this->db->query("SELECT kd_gd_apal, sub_jenis FROM gudang_apal WHERE jenis='CETAK' AND deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectDetailRencanaForInpurHasil($param){
    $Q = "SELECT RC.*, CONCAT(GR.ukuran,' ',GR.merek,' ',GR.warna_plastik) AS merek_bahan
          FROM rencana_cetak RC
          INNER JOIN gudang_roll GR ON RC.kd_gd_roll = GR.kd_gd_roll
          WHERE RC.kd_cetak='$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectPengambilanCetakExtruder($param){
    $result = $this->db->query("SELECT SUM(berat) AS berat, SUM(bobin) AS bobin, SUM(payung) AS payung, SUM(payung_kuning) AS payung_kuning
                                FROM transaksi_detail_pengambilan_cetak
                                WHERE kd_cetak = '$param[kdCetak]'
                                AND tgl_rencana = '$param[tglRencana]'
                                AND status = 'MANDOR CETAK (EXTRUDER)'
                                AND deleted = 'FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectHasilJobCetakPending(){
    $Q = "SELECT RC.customer, RC.merek, RC.ukuran, RC.warna_plastik, TDHC.jumlah_berat_pengambilan,
                 TDHC.jumlah_payung_pengambilan, TDHC.jumlah_payung_kuning_pengambilan,
                 TDHC.jumlah_bobin_pengambilan, TDHC.jumlah_sisa_pengambilan, TDHC.jumlah_apal,
                 THC.jumlah_selesai, THC.payung, THC.payung_kuning, THC.bobin,
                 THC.berat_roll, THC.plusminus, THC.kd_hasil_cetak
          FROM transaksi_hasil_cetak THC
          INNER JOIN rencana_cetak RC ON THC.kd_cetak = RC.kd_cetak
          INNER JOIN transaksi_detail_hasil_cetak TDHC ON TDHC.kd_hasil_cetak = THC.kd_hasil_cetak
          WHERE THC.sts_transaksi='PENDING'
          AND THC.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND TDHC.deleted='FALSE'";
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

  public function selectListHasilCetak($param){
    $this->datatables->select("RC.customer, RC.merek, RC.ukuran, RC.warna_plastik, RC.tgl_rencana,
                               RC.warna_cat, TDHC.jumlah_berat_pengambilan,
                               TDHC.jumlah_bobin_pengambilan, TDHC.jumlah_payung_pengambilan,
                               TDHC.jumlah_payung_kuning_pengambilan, TDHC.jumlah_hasil_selesai,
                               TDHC.jumlah_hasil_bobin, TDHC.jumlah_hasil_payung,
                               TDHC.jumlah_hasil_payung_kuning, THC.berat_roll, TDHC.jumlah_apal,
                               THC.plusminus, THC.kd_hasil_cetak, THC.tgl_transaksi");
    $this->datatables->from("transaksi_hasil_cetak THC");
    $this->datatables->join("transaksi_detail_hasil_cetak TDHC","TDHC.kd_hasil_cetak = THC.kd_hasil_cetak","INNER");
    $this->datatables->join("rencana_cetak RC","THC.kd_cetak = RC.kd_cetak","INNER");
    $this->datatables->where("THC.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
                              AND THC.deleted='FALSE'
                              AND TDHC.deleted='FALSE'
                              AND RC.deleted='FALSE'");
    return $this->datatables->generate();
  }

  public function selectEditDetailJobCetak($param){
    $Q = "SELECT RC.kd_cetak, RC.customer, RC.merek, RC.ukuran, RC.warna_plastik,
                 THC.tgl_transaksi, TDHC.jumlah_berat_pengambilan, TDHC.jumlah_payung_pengambilan,
                 TDHC.jumlah_payung_kuning_pengambilan, TDHC.jumlah_bobin_pengambilan,
                 TDHC.jumlah_hasil_selesai, TDHC.jumlah_hasil_payung, TDHC.jumlah_hasil_payung_kuning,
                 TDHC.jumlah_hasil_bobin, TDHC.jumlah_apal, TDHC.jumlah_payung_terbuang,
                 TDHC.jumlah_bobin_terbuang, TDHC.jumlah_payung_kuning_terbuang, TDHC.jumlah_sisa_pengambilan,
                 TDHC.jenis_roll, THC.berat_roll, THC.plusminus
          FROM transaksi_hasil_cetak THC
          INNER JOIN transaksi_detail_hasil_cetak TDHC ON TDHC.kd_hasil_cetak = THC.kd_hasil_cetak
          INNER JOIN rencana_cetak RC ON THC.kd_cetak = RC.kd_cetak
          WHERE THC.kd_hasil_cetak='$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectBonApal($param){
    $Q = "SELECT THC.tgl_transaksi, RC.merek, RC.ukuran, RC.warna_plastik, TDHC.jumlah_apal, RC.customer
          FROM transaksi_detail_hasil_cetak TDHC
          INNER JOIN transaksi_hasil_cetak THC ON TDHC.kd_hasil_cetak = THC.kd_hasil_cetak
          INNER JOIN rencana_cetak RC ON THC.kd_cetak = RC.kd_cetak
          WHERE THC.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND THC.deleted='FALSE'
          AND TDHC.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND TDHC.jumlah_apal > 0";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListDataBonHasil($param){
    $Q = "SELECT RC.merek, RC.ukuran, RC.warna_plastik, THC.jumlah_selesai, THC.bobin,
                 THC.payung, THC.payung_kuning, RC.jns_brg, THC.nama_operator, TDHC.status_bon,
                 TDHC.kd_gd_roll_cetak, TDHC.kd_gd_roll_polos, TDHC.kd_gd_apal, TDHC.jumlah_apal,
                 TDHC.jumlah_berat_pengambilan_extruder, TDHC.jumlah_payung_pengambilan_extruder, TDHC.jumlah_payung_kuning_pengambilan_extruder,
                 TDHC.jumlah_berat_pengambilan, TDHC.jumlah_payung_pengambilan, TDHC.jumlah_payung_kuning_pengambilan,
                 TDHC.jumlah_bobin_pengambilan, TDHC.jumlah_bobin_pengambilan_extruder, TDHC.jumlah_sisa_pengambilan, THC.tgl_transaksi,
                 GA.sub_jenis
          FROM transaksi_detail_hasil_cetak TDHC
          INNER JOIN transaksi_hasil_cetak THC ON TDHC.kd_hasil_cetak = THC.kd_hasil_cetak
          INNER JOIN rencana_cetak RC ON THC.kd_cetak = RC.kd_cetak
          LEFT JOIN gudang_apal GA ON TDHC.kd_gd_apal = GA.kd_gd_apal
          WHERE THC.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND THC.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND TDHC.deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListPenggunaanBahan($param){
    $Q = "SELECT RC.merek, RC.ukuran, RC.warna_plastik, GB.nm_barang, GB.warna, RC.kd_gd_cetak,
                 TPBC.kd_gd_bahan, TPBC.jumlah_pengambilan, GB.jenis, TPBC.status_bon,
                 TPBC.tgl_pengambilan
          FROM transaksi_penggunaan_bahan_cetak TPBC
          INNER JOIN transaksi_hasil_cetak THC ON TPBC.kd_hasil_cetak = THC.kd_hasil_cetak
          INNER JOIN rencana_cetak RC ON THC.kd_cetak = RC.kd_cetak
          INNER JOIN gudang_bahan GB ON TPBC.kd_gd_bahan = GB.kd_gd_bahan
          WHERE TPBC.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND THC.deleted='FALSE'
          AND GB.deleted='FALSE'
          AND GB.jenis='$param[jenis]'
          AND THC.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListPengembalianCatCampur($param){
    $Q = "SELECT RC.merek, RC.ukuran, RC.warna_plastik, GB.nm_barang, GB.warna, RC.kd_gd_cetak,
                 TPBC.kd_gd_bahan, TPBC.sisa_pengambilan, GB.jenis, TPBC.status_bon_sisa,
                 TPBC.tgl_pengambilan
          FROM transaksi_penggunaan_bahan_cetak TPBC
          INNER JOIN transaksi_hasil_cetak THC ON TPBC.kd_hasil_cetak = THC.kd_hasil_cetak
          INNER JOIN rencana_cetak RC ON THC.kd_cetak = RC.kd_cetak
          INNER JOIN gudang_bahan GB ON TPBC.kd_gd_bahan = GB.kd_gd_bahan
          WHERE TPBC.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND THC.deleted='FALSE'
          AND GB.deleted='FALSE'
          AND GB.jenis='CAT CAMPUR'
          AND THC.tgl_transaksi BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListBarangDiambilPotong(){
    $this->datatables->select("TGR.tgl_transaksi, GR.ukuran, GR.merek, GR.warna_plastik,
                               TGR.berat, TGR.bobin, TGR.payung, TGR.payung_kuning, TGR.id");
    $this->datatables->from("transaksi_gudang_roll TGR");
    $this->datatables->join("gudang_roll GR","TGR.kd_gd_roll = GR.kd_gd_roll","INNER");
    $this->datatables->where("TGR.deleted='FALSE' AND
                              GR.deleted='FALSE' AND
                              TGR.jns_permintaan='CETAK' AND
                              TGR.bagian='POTONG' AND
                              TGR.status_history='KELUAR' AND
                              TGR.keterangan_history='MANDOR POTONG (CETAK)'");
    $this->db->order_by("TGR.tgl_transaksi","DESC");
    return $this->datatables->generate();
  }

  public function selectUkuranPengambilanCetak($param){
    if($param["Key"]==""){
      $Q = "SELECT kd_cetak, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, ukuran,
                   merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
            FROM rencana_cetak
            WHERE tgl_rencana = '$param[tglRencana]'
            AND deleted = 'FALSE'
            AND sts_pengerjaan !='FINISH'";
    }else{
      $Q = "SELECT kd_cetak, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, ukuran,
                   merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
            FROM rencana_cetak
            WHERE tgl_rencana = '$param[tglRencana]'
            AND deleted = 'FALSE'
            AND sts_pengerjaan !='FINISH'
            AND (SUBSTRING_INDEX(ukuran, 'x',1) LIKE '%$param[Key]%'
            OR customer LIKE '%$param[Key]%'
            OR merek LIKE '%$param[Key]%'
            OR warna_plastik LIKE '%$param[Key]%'
            OR tgl_rencana LIKE '%$param[Key]%')";
    }
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListPengambilanExtruder(){
    $this->datatables->select("TDPC.id, TDPC.tgl_rencana, RC.ukuran, RC.merek, RC.warna_plastik,
                               RC.tebal, TDPC.berat, TDPC.bobin, TDPC.payung, TDPC.payung_kuning,
                               TDPC.shift, TDPC.sts_transaksi");
    $this->datatables->from("transaksi_detail_pengambilan_cetak TDPC");
    $this->datatables->join("rencana_cetak RC","TDPC.kd_cetak = RC.kd_cetak","INNER");
    $this->datatables->where("TDPC.deleted='FALSE' AND
                              RC.deleted='FALSE'");
    $this->db->order_by("TDPC.tgl_pengambilan","DESC");
    return $this->datatables->generate();
  }

  public function selectDetailPengambilanCetakExtruder($param){
    $result = $this->db->query("SELECT * FROM transaksi_detail_pengambilan_cetak WHERE id='$param'")->result_array();
    return json_encode($result);
  }

  public function selectPenggunaanBahanCetak($param){
    $result = $this->db->query("SELECT TPBC.jumlah_pengambilan, TPBC.sisa_pengambilan, TPBC.kd_gd_bahan,
                                       GB.jenis
                                FROM transaksi_penggunaan_bahan_cetak TPBC
                                INNER JOIN gudang_bahan GB ON TPBC.kd_gd_bahan = GB.kd_gd_bahan
                                WHERE TPBC.id_penggunaan_cetak = '$param'")->result_array();
    return json_encode($result);
  }

  public function selectPengambilanGudangRoll($param){
    $Q = "SELECT TDHC.kd_gd_roll_polos, TDHC.jumlah_berat_pengambilan, TDHC.jumlah_payung_pengambilan,
                 TDHC.jumlah_payung_kuning_pengambilan, TDHC.jumlah_bobin_pengambilan,
                 RC.merek, RC.ukuran, RC.warna_plastik
          FROM transaksi_detail_hasil_cetak TDHC
          INNER JOIN transaksi_hasil_cetak THC ON TDHC.kd_hasil_cetak = THC.kd_hasil_cetak
          INNER JOIN rencana_cetak RC ON THC.kd_cetak = RC.kd_cetak
          WHERE RC.deleted = 'FALSE'
          AND TDHC.deleted='FALSE'
          AND THC.deleted='FALSE'
          AND RC.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          ORDER BY RC.tgl_rencana ASC, RC.merek ASC, CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(RC.ukuran,'x',1),'+',1) AS UNSIGNED) ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }
  #=========================Select Function (Finish)=========================#

  #=========================Update Function (Start)=========================#
  public function updateRencanaPPIC($param){
    $this->db->trans_begin();
    $this->db->where("kd_ppic",$param["kd_ppic"]);
    $this->db->update("rencana_ppic",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateSaveRencanaCetak($param){
    $this->db->trans_begin();
    if(count($param) <= 0){
      return "Data Kosong";
    }else{
      $this->db->update_batch("rencana_ppic",$param,"kd_ppic");
      $this->db->query("UPDATE rencana_cetak SET sts_pengerjaan='PROGRESS' WHERE sts_pengerjaan='PENDING'");
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function updateRencanaCetakPending($param){
    $this->db->trans_begin();
    $this->db->where("kd_cetak",$param["kd_cetak"]);
    $this->db->update("rencana_cetak",$param);
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateRencanaCetakSusulanPending(){
    $this->db->trans_begin();
    $this->db->query("UPDATE rencana_cetak SET sts_pengerjaan='PROGRESS'
                      WHERE deleted='FALSE'
                      AND kd_ppic IS NULL
                      AND sts_pengerjaan='PENDING'");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateDeleteAndRestoreHasilJobCetak($param){
    $this->db->trans_begin();
    $this->db->where("kd_hasil_cetak",$param["kd_hasil_cetak"]);
    $this->db->update("transaksi_hasil_cetak",$param);

    $this->db->where("kd_hasil_cetak",$param["kd_hasil_cetak"]);
    $this->db->update("transaksi_detail_hasil_cetak",$param);

    $this->db->where("kd_hasil_cetak",$param["kd_hasil_cetak"]);
    $this->db->update("transaksi_penggunaan_bahan_cetak",$param);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateSelesaiHasilJobCetak(){
    $this->db->trans_begin();
    $Q = "UPDATE transaksi_hasil_cetak
          SET sts_transaksi='FINISH'
          WHERE sts_transaksi='PENDING'
          AND deleted='FALSE'";
    $this->db->query($Q);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateDetailJobCetak($param){
    $this->db->trans_begin();
    $this->db->where("kd_hasil_cetak",$param["THC"]["kd_hasil_cetak"]);
    $this->db->update("transaksi_hasil_cetak",$param["THC"]);

    $this->db->where("kd_hasil_cetak",$param["TDHC"]["kd_hasil_cetak"]);
    $this->db->update("transaksi_detail_hasil_cetak",$param["TDHC"]);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updatePengambilanCetak($param){
    $this->db->trans_begin();
    $idTransaksi = $param["TDPC"]["id"];
    $check = $this->db->query("SELECT * FROM transaksi_detail_pengambilan_cetak
                               WHERE id='$idTransaksi'")->result_array();
    $kd_gd_roll = $check[0]["kd_gd_roll"];
    $berat = $check[0]["berat"];
    $bobin = $check[0]["bobin"];
    $payung = $check[0]["payung"];
    $payungKuning = $check[0]["payung_kuning"];
    $shift = $check[0]["shift"];
    $tglTransaksi = $param["TDPC"]["tgl_rencana"];

    $idTransaksiGdRoll = $this->db->query("SELECT id, status_transaksi, kd_gd_roll,
                                                  berat, bobin, payung, payung_kuning
                                           FROM transaksi_gudang_roll
                                           WHERE kd_gd_roll = '$kd_gd_roll'
                                           AND berat = '$berat'
                                           AND bobin = '$bobin'
                                           AND payung = '$payung'
                                           AND payung_kuning = '$payungKuning'
                                           AND shift = '$shift'
                                           AND tgl_transaksi = '$tglTransaksi'
                                           AND keterangan_history='MANDOR CETAK (EXTRUDER)'
                                           AND bagian = 'CETAK'
                                           AND keterangan_transaksi='KELUAR KE CETAK'
                                           AND status_history = 'KELUAR'")->result_array();
    $this->db->where("id",$param["TDPC"]["id"]);
    $this->db->update("transaksi_detail_pengambilan_cetak", $param["TDPC"]);
    if($idTransaksiGdRoll[0]["status_transaksi"] == "FINISH"){
      $kdGdRoll = $idTransaksiGdRoll[0]["kd_gd_roll"];
      $beratLama = $idTransaksiGdRoll[0]["berat"];
      $bobinLama = $idTransaksiGdRoll[0]["bobin"];
      $payungLama = $idTransaksiGdRoll[0]["payung"];
      $payungKuningLama = $idTransaksiGdRoll[0]["payung_kuning"];

      $this->db->set("stok","stok + ".($beratLama - $param["TGR"]["berat"]), FALSE);
      $this->db->set("bobin","bobin + ".($bobinLama - $param["TGR"]["bobin"]), FALSE);
      $this->db->set("payung","payung + ".($payungLama - $param["TGR"]["payung"]), FALSE);
      $this->db->set("payung_kuning","payung_kuning + ".($payungKuningLama - $param["TGR"]["payung_kuning"]), FALSE);

      $this->db->where("kd_gd_roll",$kdGdRoll);
      $this->db->update("gudang_roll");
    }
    $this->db->where("id", $idTransaksiGdRoll[0]["id"]);
    $this->db->update("transaksi_gudang_roll", $param["TGR"]);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updatePenggunaanBahanCetak($param){
    $this->db->trans_begin();
    $this->db->where("id_penggunaan_cetak",$param["id_penggunaan_cetak"]);
    $this->db->update("transaksi_penggunaan_bahan_cetak", $param);
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
