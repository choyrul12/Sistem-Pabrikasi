<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cutting_Model extends CI_Model{
  #=========================Get Code Function (Start)=========================#
  public function generatePotongCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_potong,4)) AS kode FROM rencana_potong WHERE SUBSTRING(kd_potong,4,6) = DATE_FORMAT(NOW(),'%y%m%d')");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "000";
      }
      $tempCode = "000".(intval($arrMaxCode->kode)+1);
      $fixCode = "PTG".date("ymd").substr($tempCode,(strlen($tempCode)-4));
    }
    return $fixCode;
  }

  public function generateInputHasilCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_hasil_potong,4)) AS kode FROM transaksi_hasil_potong WHERE SUBSTRING(kd_hasil_potong,4,6) = DATE_FORMAT(NOW(),'%y%m%d')");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "000";
      }
      $tempCode = "000".(intval($arrMaxCode->kode)+1);
      $fixCode = "TRX".date("ymd").substr($tempCode,(strlen($tempCode)-4));
    }
    return $fixCode;
  }
  #=========================Get Code Function (Finish)=========================#

  #=========================Insert Function (Start)=========================#
  public function insertRencanaPotongPending($param){
    $this->db->trans_begin();
    $this->db->insert("rencana_potong",$param);
    $this->db->query("UPDATE rencana_ppic
                      SET no_mesin='$param[no_mesin]',
                          satuan_kilo='$param[stok_permintaan]',
                          sisa='$param[stok_permintaan]'
                      WHERE kd_ppic='$param[kd_ppic]'");
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertRencanaPotong($param){
    $this->db->trans_begin();
    $this->db->insert("rencana_potong",$param);
    $this->db->query("UPDATE rencana_ppic SET satuan_kilo='$param[stok_permintaan]' WHERE kd_ppic='$param[kd_ppic]'");
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertSisaPengambilanPotong($param){
    $this->db->trans_begin();
    if($param["TUMPUK"] == "NO"){
      $QCheck = "SELECT COUNT(id) AS Counter FROM transaksi_gudang_roll
                 WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m')='$param[tglCheck]'
                 AND status_lock = 'TRUE'
                 AND jns_permintaan = '$param[JnsPermintaan]'
                 AND deleted='FALSE'";
      $checkLock = $this->db->query($QCheck)->result_array();
    }else{
      $QCheck = "SELECT COUNT(id) AS Counter FROM transaksi_gudang_roll
                 WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m')='$param[tglCheck]'
                 AND status_lock = 'TRUE'
                 AND jns_permintaan IN ('$param[JnsPermintaan]','$param[JnsPermintaanTumpuk]')
                 AND deleted='FALSE'";
      $checkLock = $this->db->query($QCheck)->result_array();
    }
    if($checkLock[0]["Counter"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      if($param["TUMPUK"] == "NO"){
        if(array_key_exists("TGR_IN", $param)) {
          $this->db->insert("transaksi_gudang_roll", $param["TGR_IN"]);
          $this->db->insert("transaksi_gudang_roll", $param["TGR_OUT"]);

          $this->db->insert("transaksi_berat_pengambilan_roll", $param["TBPR"]);
          $this->db->insert("transaksi_detail_pengambilan_potong", $param["TDPP"]);
        }else{
          $this->db->insert("transaksi_gudang_roll", $param["TGR"]);
          $this->db->insert("transaksi_berat_pengambilan_roll", $param["TBPR"]);
          $this->db->insert("transaksi_detail_pengambilan_potong", $param["TDPP"]);
        }
      }else{
        if(array_key_exists("TGR_IN", $param)) {
          $this->db->insert_batch("transaksi_gudang_roll", $param["TGR_IN"]);
          $this->db->insert_batch("transaksi_gudang_roll", $param["TGR_OUT"]);

          $this->db->insert_batch("transaksi_berat_pengambilan_roll", $param["TBPR"]);
          $this->db->insert_batch("transaksi_detail_pengambilan_potong", $param["TDPP"]);
        }else{
          $this->db->insert_batch("transaksi_gudang_roll", $param["TGR"]);
          $this->db->insert_batch("transaksi_berat_pengambilan_roll", $param["TBPR"]);
          $this->db->insert_batch("transaksi_detail_pengambilan_potong", $param["TDPP"]);
        }
      }
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function insertPengambilanPotong($param){
    $this->db->trans_begin();
    $periodeLock = date("Y-m",strtotime($param["TGR"]["tgl_transaksi"]));
    $counterLock = $this->db->query("SELECT COUNT(id) jumlah FROM transaksi_gudang_roll WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$periodeLock' AND status_lock='TRUE'")->result_array();
    if($counterLock[0]["jumlah"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert_batch("transaksi_gudang_roll",$param["TGR"]);
      $this->db->insert_batch("transaksi_detail_pengambilan_potong", $param["TDPP"]);
      // for ($i=0; $i < count($param["TGR"]); $i++) {
      //   $this->db->set("stok","stok - ".$param["TGR"][$i]["berat"], FALSE);
      //   $this->db->set("bobin","bobin - ".$param["TGR"][$i]["bobin"], FALSE);
      //   $this->db->set("payung","payung - ".$param["TGR"][$i]["payung"], FALSE);
      //   $this->db->set("payung_kuning","payung_kuning - ".$param["TGR"][$i]["payung_kuning"], FALSE);
      //   $this->db->where("kd_gd_roll",$param["TGR"][$i]["kd_gd_roll"]);
      //   $this->db->update("gudang_roll");
      // }
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function insertPengambilanPotongTertinggal($param){
    $this->db->trans_begin();
    $periodeLock = date("Y-m",strtotime($param["TGR"]["tgl_transaksi"]));
    $counterLock = $this->db->query("SELECT COUNT(id) jumlah FROM transaksi_gudang_roll WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$periodeLock' AND status_lock='TRUE'")->result_array();
    if($counterLock[0]["jumlah"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert("transaksi_gudang_roll",$param["TGR"]);
      $this->db->insert("transaksi_detail_pengambilan_potong", $param["TDPP"]);
      $kdPotong = $param["TDPP"]["kd_potong"];
      $QGetKdHasilPotong = "SELECT kd_hasil_potong FROM transaksi_sub_hasil_potong
                            WHERE kd_potong='$kdPotong'";
      $arrKdHasilPotong = $this->db->query($QGetKdHasilPotong)->result_array();
      $kdHasilPotong = $arrKdHasilPotong[0]["kd_hasil_potong"];
      $berat = $param["TDPP"]["berat"];
      $bobin = $param["TDPP"]["bobin"];
      $payung = $param["TDPP"]["payung"];
      $payungKuning = $param["TDPP"]["payung_kuning"];
      $QUpdateTransaksiPengambilanHasilPotong = "UPDATE transaksi_pengambilan_hasil_potong
                                                 SET berat_pengambilan_bagian = berat_pengambilan_bagian + $berat,
                                                     bobin_pengambilan_bagian = bobin_pengambilan_bagian + $bobin,
                                                     payung_pengambilan_bagian = payung_pengambilan_bagian + $payung,
                                                     payung_kuning_pengambilan_bagian = payung_kuning_pengambilan_bagian + $payungKuning
                                                 WHERE kd_hasil_potong = '$kdHasilPotong'";
      $this->db->query($QUpdateTransaksiPengambilanHasilPotong);
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function insertInputHasil($param){
    $this->db->trans_begin();
    $tglRencana = $param["THP"]["tgl_rencana"];
    $tglJadi = $param["THP"]["tgl_jadi"];
    $idTransaksi = $param["THP"]["kd_hasil_potong"];
    $QCheck_THP = "SELECT COUNT(kd_hasil_potong) AS jumlahKode
                   FROM transaksi_hasil_potong
                   WHERE tgl_rencana = '$tglRencana'
                   AND tgl_jadi = '$tglJadi'
                   AND kd_hasil_potong = '$idTransaksi'";
    $arrJumlahKode = $this->db->query($QCheck_THP)->result_array();
    if($arrJumlahKode[0]["jumlahKode"] > 0){
      $this->db->trans_rollback();
      return "Data Ada";
    }else{
      $this->db->insert("transaksi_hasil_potong", $param["THP"]);
      $this->db->insert_batch("transaksi_sub_hasil_potong", $param["TSHP"]);
      $this->db->insert("transaksi_pengambilan_hasil_potong", $param["TPHP"]);
      $this->db->insert_batch("transaksi_gudang_roll", $param["TGR"]);
      for ($i=0; $i < count($param["TSHP"]); $i++) {
        $kdPotong = $param["TSHP"][$i]["kd_potong"];
        $QCheck_RC = "SELECT kd_potong, kd_ppic, satuan FROM rencana_potong WHERE kd_potong = '$kdPotong'";
        $arrCheck_RC = $this->db->query($QCheck_RC)->result_array();

        if(strtoupper($arrCheck_RC[0]["satuan"]) == "LEMBAR"){ #Pengecekan satuan dari rencana_potong
          $this->db->set("jml_permintaan", "jml_permintaan - ".$param["TSHP"][$i]["jumlah_lembar"], FALSE);
          $this->db->where("kd_potong",$kdPotong);
          $this->db->update("rencana_potong");

          if(!empty($arrCheck_RC[0]["kd_ppic"])){ #Pengecekan apakah kode ppic tersedia atau tidak
            // $this->db->set("jumlah_permintaan", "jumlah_permintaan - ".$param["TSHP"][$i]["jumlah_lembar"], FALSE);
            $this->db->set("sisa","sisa - ".$param["TSHP"][$i]["jumlah_lembar"], FALSE);
            $this->db->where("kd_ppic",$arrCheck_RC[0]["kd_ppic"]);
            $this->db->update("rencana_ppic");
          }

          $QCheckJumlahPermintaan_RC = "SELECT jml_permintaan FROM rencana_potong WHERE kd_potong = '$kdPotong'";
          $arrJumlahPermintaan_RC = $this->db->query($QCheckJumlahPermintaan_RC)->result_array();

          if($arrJumlahPermintaan_RC[0]["jml_permintaan"] <= 0){ #Pengecekan apakah jumlah permintaan lebih kecil atau sama dengan nol
            $this->db->set("sts_pengerjaan","FINISH");
            $this->db->where("kd_potong",$kdPotong);
            $this->db->update("rencana_potong");

            if(!empty($arrCheck_RC[0]["kd_ppic"])){ #Pengecekan apakah kode ppic tersedia atau tidak
              $this->db->set("sts_pengerjaan","FINISH");
              $this->db->where("kd_ppic",$arrCheck_RC[0]["kd_ppic"]);
              $this->db->update("rencana_ppic");
            }
          }
        }else{
          // $this->db->set("jml_permintaan", "jml_permintaan - ".$param["TSHP"][$i]["jumlah_berat"], FALSE);
          $this->db->set("jml_permintaan", "jml_permintaan - ".$param["TSHP"][$i]["jumlah_berat"], FALSE);
          $this->db->where("kd_potong",$kdPotong);
          $this->db->update("rencana_potong");

          if(!empty($arrCheck_RC[0]["kd_ppic"])){
            // $this->db->set("jumlah_permintaan", "jumlah_permintaan - ".$param["TSHP"][$i]["jumlah_berat"], FALSE);
            $this->db->set("sisa", "sisa - ".$param["TSHP"][$i]["jumlah_berat"], FALSE);
            $this->db->where("kd_ppic",$arrCheck_RC[0]["kd_ppic"]);
            $this->db->update("rencana_ppic");
          }

          $QCheckJumlahPermintaan_RC = "SELECT jml_permintaan FROM rencana_potong WHERE kd_potong = '$kdPotong'";
          $arrJumlahPermintaan_RC = $this->db->query($QCheckJumlahPermintaan_RC)->result_array();

          if($arrJumlahPermintaan_RC[0]["jml_permintaan"] <= 0){ #Pengecekan apakah jumlah permintaan lebih kecil atau sama dengan nol
            $this->db->set("sts_pengerjaan","FINISH");
            $this->db->where("kd_potong",$kdPotong);
            $this->db->update("rencana_potong");

            if(!empty($arrCheck_RC[0]["kd_ppic"])){ #Pengecekan apakah kode ppic tersedia atau tidak
              $this->db->set("sts_pengerjaan","FINISH");
              $this->db->where("kd_ppic",$arrCheck_RC[0]["kd_ppic"]);
              $this->db->update("rencana_ppic");
            }
          }
        }
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

  public function insertKirimBonHasilJadiGlobal($param){
    $tglJadi = $param["Parameter"]["tglJadi"];
    $jnsBrg = $param["Parameter"]["jnsBrg"];
    if($jnsBrg == "CAMPUR_STANDARD"){
      $where = "AND GH.jns_brg IN('CAMPUR','STANDARD')";
    }else{
      $where = "AND GH.jns_brg='$jnsBrg'";
    }
    $bulanTahun = date("Y-m",strtotime($tglJadi));
    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(id_permintaan_jadi) AS jumlahLock
                                   FROM transaksi_gudang_hasil
                                   WHERE DATE_FORMAT(tgl_transaksi,'%Y-%m') = '$bulanTahun'
                                   AND status_lock='TRUE'
                                   AND deleted = 'FALSE'")->result_array();
    if($checkLock[0]["jumlahLock"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert_batch("transaksi_gudang_hasil",$param["DataBon"]);
      $this->db->query("UPDATE transaksi_hasil_potong THP
                        JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
                        JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
                        JOIN gudang_hasil GH ON TSHP.kd_gd_hasil = GH.kd_gd_hasil
                        SET THP.status_bon = 'TRUE'
                        WHERE THP.status_bon='FALSE'
                        AND THP.tgl_rencana = '$tglJadi'".$where);
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
    $tglCheck = date("Y-m");
    $checkLock = $this->db->query("SELECT COUNT(id) jumlah FROM transaksi_detail_history_apal
                                   WHERE deleted='TRUE' AND DATE_FORMAT(tgl_transaksi,'%Y-m') = '$tglCheck'")->result_array();
    if($checkLock[0]["jumlah"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert("transaksi_detail_history_apal", $param);

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
  public function selectRencanaPpicPotong($param){
    $this->datatables->select("kd_ppic,tgl_rencana,nm_cust,jns_permintaan,ukuran,no_mesin,
                               warna_plastik,permintaan_mesin,merek,ket_merek,berat,satuan,prioritas,tebal,satuan,
                               FORMAT(ROUND(jumlah_permintaan),0) AS jumlah_permintaan,FORMAT(ROUND(sisa),0) AS sisa,
                               strip,ket_mandor,keterangan,sts_pengerjaan,permintaan_mesin,foto_depan,foto_belakang,warna_cetak,warna_cat");
    $this->datatables->from("rencana_ppic");
    if(empty($param["tglAwal"])){
      $date = date("Y-m-d");
      $this->datatables->where("deleted='FALSE' AND sts_pengerjaan != 'FINISH' AND tgl_rencana = '$date' AND bagian=","POTONG");
    }else{
      $this->datatables->where("deleted='FALSE' AND sts_pengerjaan != 'FINISH' AND tgl_rencana = '$param[tglAwal]' AND bagian=","POTONG");
    }
    $this->db->order_by("tgl_rencana DESC,kd_ppic DESC");
    return $this->datatables->generate();
  }

  public function selectDetailRencanaPPIC($param){
    $Q = "SELECT * FROM rencana_ppic WHERE kd_ppic='$param'";
    $result = $this->db->query($Q)->result_array();
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

    $arrMerek = array("KLIP","KP","MP","ZIPPIN","PON","KANTONG","CB","KLIP IN");
    if(in_array(strtoupper($param["merek"]), $arrMerek)){
      if(strtoupper($param["merek"])=="PON" || strtoupper($param["merek"])=="KLIP" || strtoupper($param["merek"])=="KANTONG"){
        $clause2 = " AND merek IN ('Klip','PON','Kantong')
                     AND warna_plastik = '$param[warnaPlastik]'";
      }else{
        $clause2 = " AND merek = '$param[merek]'
                     AND warna_plastik = '$param[warnaPlastik]'";
      }
    }else{
      $clause2="";
    }

    if(strpos($param["panjangPlastik"],"pon") !== FALSE){
      $prefix = substr($param["panjangPlastik"],0,3);
      $postfix = substr(str_replace(" ","",$param["panjangPlastik"]),strlen($prefix));
      if($param["JnsPermintaan"]=="CETAK-POLOS" || $param["JnsPermintaan"]=="POLOS-CETAK"){
        $clause = "";
      }else{
        $clause = "jns_permintaan='$param[JnsPermintaan]' AND";
      }
      $arrData = $this->db->query("SELECT * FROM gudang_roll
                                   WHERE $clause merek NOT LIKE '%zipper%'
                                   AND (ukuran LIKE '%$prefix%' OR ukuran LIKE '%$postfix%' $Av)
                                   $clause2
                                   AND deleted='FALSE'
                                   LIMIT 20")->result_array();
    }else{
      $arrData = $this->db->query("SELECT * FROM gudang_roll
                                   WHERE $clause merek NOT LIKE '%zipper%'
                                   AND (ukuran LIKE '%$param[panjangPlastik]%' $Av)
                                   $clause2
                                   AND deleted='FALSE'
                                   LIMIT 20")->result_array();
    }
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

    if(strpos($param["panjangPlastik"],"pon") !== FALSE){
      $prefix = substr($param["panjangPlastik"],0,3);
      $postfix = substr(str_replace(" ","",$param["panjangPlastik"]),strlen($prefix));
      $clause2 = "AND (ukuran LIKE '%$prefix%' OR ukuran LIKE '%$postfix%' $Av)";
    }else{
      $clause2 = "AND (ukuran LIKE '%$param[panjangPlastik]%' $Av)";
    }

    if(strpos($param["Key"],"|") === FALSE){
      if($param["JnsPermintaan"]=="CETAK/POLOS" || $param["JnsPermintaan"]=="POLOS/CETAK"){
        $clause = "";
      }else{
        $clause = "jns_permintaan='$param[JnsPermintaan]'
        AND";
      }
      $arrData = $this->db->query("SELECT * FROM gudang_roll WHERE $clause deleted = 'FALSE'
                                   AND (kd_gd_roll LIKE '%$param[Key]%' OR
                                        ukuran LIKE '%$param[Key]%' OR
                                        warna_plastik LIKE '%$param[Key]%' OR
                                        merek LIKE '%$param[Key]%')
                                   AND merek NOT LIKE '%zipper%'
                                   $clause2")->result_array();
    }else{
      $KeySplit = explode("|",$param["Key"]);
      $arrData = $this->db->query("SELECT * FROM gudang_roll WHERE $clause deleted='FALSE'
                                   AND (ukuran LIKE '%$KeySplit[0]%' AND
                                        warna_plastik LIKE '%$KeySplit[2]%' AND
                                        merek LIKE '%$KeySplit[1]%')
                                   AND merek NOT LIKE '%zipper%'
                                   $clause2")->result_array();
    }
    return json_encode($arrData);
  }

  public function selectComboBoxValueGudangHasil(){
    $Q = "SELECT * FROM gudang_hasil WHERE deleted='FALSE' AND CONCAT(jns_permintaan, ' ', jns_brg) != 'POLOS SABLON' LIMIT 20";
    $arrData = $this->db->query($Q)->result_array();
    return json_encode($arrData);
  }

  public function selectComboBoxValueGudangHasilSearch($param){
    if(strpos($param, "|") === FALSE){
      $Q = "SELECT * FROM gudang_hasil
            WHERE deleted='FALSE'
            AND CONCAT(jns_permintaan, ' ', jns_brg) != 'POLOS SABLON'
            AND (kd_gd_hasil LIKE '%$param%' OR
                 ukuran LIKE '%$param%' OR
                 warna_plastik LIKE '%$param%' OR
                 merek LIKE '%$param%' OR
                 jns_permintaan LIKE '%$param%' OR
                 sts_brg LIKE '%$param%')";
    }else{
      $KeySplit = explode("|",$param);
      $Q = "SELECT * FROM gudang_hasil
            WHERE deleted='FALSE'
            AND CONCAT(jns_permintaan, ' ', jns_brg) != 'POLOS SABLON'
            AND ukuran LIKE '%$KeySplit[0]%'
            AND merek LIKE '%$KeySplit[1]%'
            AND warna_plastik LIKE '%$KeySplit[2]%'";
    }
    $arrData = $this->db->query($Q)->result_array();
    return json_encode($arrData);
  }

  public function selectRencanaPotongPending(){
    $Q = "SELECT kd_potong, no_mesin, customer, merek, ukuran, warna_plastik, tebal, stok_permintaan, jml_permintaan, strip
          FROM rencana_potong WHERE deleted='FALSE' AND sts_pengerjaan='PENDING'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectDetailRencanaPotongPending($param){
    $Q = "SELECT * FROM rencana_potong WHERE kd_potong='$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectKeteranganMandor($param){
    $Q = "SELECT ket_mandor FROM rencana_ppic WHERE kd_ppic='$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectMesinRencanaPpic($param){
    $Q = "SELECT no_mesin FROM rencana_ppic WHERE kd_ppic = '$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectRencanaMandorPotong($param){
    $this->datatables->select("RC.kd_gd_roll, RC.tgl_rencana, RC.no_mesin, RC.customer, RC.merek, RC.ukuran, RC.warna_plastik, RC.satuan, RC.kd_gd_roll,
                               RC.tebal, RC.strip, RC.stok_permintaan, RC.jml_permintaan, RC.ket_merek, RC.ket_barang, RC.sts_print,
                               RP.foto_depan AS gambar_dari_ppic, RC.kd_potong, RP.kd_ppic, RC.gambar, RP.satuan AS satuan_ppic");
    $this->datatables->from("rencana_potong RC");
    $this->datatables->join("rencana_ppic RP","RC.kd_ppic = RP.kd_ppic","LEFT");
    if(empty($param)){
      $dateNow = date("Y-m-d");
      $last2Weeks = date("Y-m-d",strtotime("-2 weeks"));
      $this->datatables->where("RC.deleted='FALSE' AND RC.sts_pengerjaan='PROGRESS' AND RC.tgl_rencana < '$dateNow' AND RC.tgl_rencana > '$last2Weeks'");
    }else{
      $this->datatables->where("RC.deleted='FALSE' AND RC.sts_pengerjaan='PROGRESS' AND RC.tgl_rencana='$param'");
    }
    $this->db->order_by("RC.tgl_rencana DESC, RC.merek ASC");
    return $this->datatables->generate();
  }

  public function selectprintRencanaMandorPotong($param){
    $Q = "SELECT merek, tebal, strip, ukuran, no_mesin, berat, warna_plastik, customer
          FROM rencana_potong
          WHERE kd_gd_roll = '$param[kd_gd_roll]'
          AND tgl_rencana='$param[tglRencana]'
          AND deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return $result;
  }

  public function selectTanggalRencanaMandor($param){
    $Q = "SELECT tgl_rencana FROM rencana_potong WHERE kd_potong='$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectMesinRencanaMandor($param){
    $Q = "SELECT no_mesin FROM rencana_potong WHERE kd_potong='$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectRencanaMandorPotongSusulanPending(){
    $Q = "SELECT kd_potong, no_mesin, customer, ukuran, warna_plastik, tebal,
                 stok_permintaan, satuan, strip
          FROM rencana_potong
          WHERE kd_ppic IS NULL
          AND sts_pengerjaan = 'PENDING'
          AND deleted = 'FALSE'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectUkuranPengembalianPotong($param){
    $last7Days = date("Y-m-d",strtotime("-2 Days"));
    $dateNow = date("Y-m-d");
    if($param["jnsPermintaan"] == "CETAK"){
      $clause = "(jns_permintaan = '$param[jnsPermintaan]' OR jns_permintaan = 'CETAK/POLOS')";
    }else{
      $clause = "(jns_permintaan = '$param[jnsPermintaan]' OR jns_permintaan = 'POLOS/CETAK')";
    }
    if($param["Key"]==""){
      $Q = "SELECT kd_potong, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, jns_permintaan, ukuran,
                   ket_barang, merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
            FROM rencana_potong
            WHERE $clause
            AND tgl_rencana  BETWEEN '$last7Days' AND '$dateNow'
            AND deleted = 'FALSE'
            GROUP BY panjang, warna_plastik, merek
            ORDER BY DATE_FORMAT(tgl_rencana,'%Y-%m-%d') DESC";
    }else{
      if(strpos($param["Key"],"|") !== FALSE){
        $arrKey = explode("|",$param["Key"]);
        $Q = "SELECT kd_potong, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, jns_permintaan, ukuran,
                     ket_barang, merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
              FROM rencana_potong
              WHERE $clause
              -- AND tgl_rencana BETWEEN '$last7Days' AND '$dateNow'
              AND deleted = 'FALSE'
              AND DATE_FORMAT(tgl_rencana, '%m-%d') LIKE '%$arrKey[0]%'
              AND SUBSTRING_INDEX(ukuran, 'x',1) LIKE '%$arrKey[1]%'
              AND merek LIKE '%$arrKey[2]%'
              AND warna_plastik LIKE '%$arrKey[3]%'
              GROUP BY panjang, warna_plastik, merek
              ORDER BY DATE_FORMAT(tgl_rencana,'%Y-%m-%d') DESC";
      }else{
        $Q = "SELECT kd_potong, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, jns_permintaan, ukuran,
                     ket_barang, merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
              FROM rencana_potong
              WHERE $clause
              AND tgl_rencana BETWEEN '$last7Days' AND '$dateNow'
              AND deleted = 'FALSE'
              AND (SUBSTRING_INDEX(ukuran, 'x',1) LIKE '%$param[Key]%'
              OR customer LIKE '%$param[Key]%'
              OR merek LIKE '%$param[Key]%'
              OR warna_plastik LIKE '%$param[Key]%'
              OR tgl_rencana LIKE '%$param[Key]%')
              GROUP BY panjang, warna_plastik, merek
              ORDER BY DATE_FORMAT(tgl_rencana,'%Y-%m-%d') DESC";
      }
    }
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectUkuranEditHasilCutting($param){
    $last7Days = date("Y-m-d",strtotime("-7 Days",strtotime($param["Tanggal"])));
    $dateNow = date("Y-m-d");
    if($param["jnsPermintaan"] == "CETAK"){
      $clause = "(jns_permintaan = '$param[jnsPermintaan]' OR jns_permintaan = 'CETAK/POLOS')";
    }else{
      $clause = "(jns_permintaan = '$param[jnsPermintaan]' OR jns_permintaan = 'POLOS/CETAK')";
    }
    if($param["Key"]==""){
      $Q = "SELECT kd_potong, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, jns_permintaan, ukuran,
                   ket_barang, merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
            FROM rencana_potong
            WHERE $clause
            AND tgl_rencana  BETWEEN '$last7Days' AND '$dateNow'
            AND deleted = 'FALSE'
            GROUP BY panjang, warna_plastik, merek
            ORDER BY DATE_FORMAT(tgl_rencana,'%Y-%m-%d') DESC";
    }else{
      if(strpos($param["Key"],"|") !== FALSE){
        $arrKey = explode("|",$param["Key"]);
        $Q = "SELECT kd_potong, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, jns_permintaan, ukuran,
                     ket_barang, merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
              FROM rencana_potong
              WHERE $clause
              AND tgl_rencana BETWEEN '$last7Days' AND '$dateNow'
              AND deleted = 'FALSE'
              AND SUBSTRING_INDEX(ukuran, 'x',1) LIKE '%$arrKey[0]%'
              AND merek LIKE '%$arrKey[1]%'
              AND warna_plastik LIKE '%$arrKey[2]%'
              GROUP BY panjang, warna_plastik, merek, tgl_rencana
              ORDER BY DATE_FORMAT(tgl_rencana,'%Y-%m-%d') DESC";
      }else{
        $Q = "SELECT kd_potong, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, jns_permintaan, ukuran,
                     ket_barang, merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
              FROM rencana_potong
              WHERE $clause
              AND tgl_rencana BETWEEN '$last7Days' AND '$dateNow'
              AND deleted = 'FALSE'
              AND (SUBSTRING_INDEX(ukuran, 'x',1) LIKE '%$param[Key]%'
              OR customer LIKE '%$param[Key]%'
              OR merek LIKE '%$param[Key]%'
              OR warna_plastik LIKE '%$param[Key]%'
              OR tgl_rencana LIKE '%$param[Key]%')
              GROUP BY panjang, warna_plastik, merek, tgl_rencana
              ORDER BY DATE_FORMAT(tgl_rencana,'%Y-%m-%d') DESC";
      }
    }
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectSisaPengambilan($param){
    $Q = "SELECT TBPR.id,
                 TBPR.sisa,
                 TBPR.payung,
                 TBPR.payung_kuning,
                 TBPR.bobin,
                 TBPR.keterangan,
                 TBPR.shift,

                 GR.ukuran,
                 GR.merek,
                 GR.warna_plastik,
                 GR.jns_permintaan
          FROM transaksi_berat_pengambilan_roll TBPR
          INNER JOIN gudang_roll GR ON TBPR.kd_gd_roll = GR.kd_gd_roll
          WHERE GR.jns_permintaan = '$param'
          AND TBPR.deleted='FALSE'
          AND GR.deleted='FALSE'
          AND TBPR.sts_transaksi='PENDING'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectUkuranPengambilanPotong($param){
    if($param["jnsPermintaan"] == "CETAK"){
      $clause = "(jns_permintaan = '$param[jnsPermintaan]' OR jns_permintaan = 'CETAK/POLOS')";
    }else{
      $clause = "(jns_permintaan = '$param[jnsPermintaan]' OR jns_permintaan = 'POLOS/CETAK')";
    }
    if($param["Key"]==""){
      $Q = "SELECT kd_potong, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, jns_permintaan, ukuran,
                   ket_barang, merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
            FROM rencana_potong
            WHERE $clause
            AND tgl_rencana = '$param[tglRencana]'
            AND deleted = 'FALSE'";
    }else{
      $Q = "SELECT kd_potong, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, jns_permintaan, ukuran,
                   ket_barang, merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
            FROM rencana_potong
            WHERE $clause
            AND tgl_rencana = '$param[tglRencana]'
            AND deleted = 'FALSE'
            AND (SUBSTRING_INDEX(ukuran, 'x',1) LIKE '%$param[Key]%'
            OR customer LIKE '%$param[Key]%'
            OR merek LIKE '%$param[Key]%'
            OR warna_plastik LIKE '%$param[Key]%'
            OR tgl_rencana LIKE '%$param[Key]%')";
    }
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectDataRencanaForInputHasil($param){
    $currentDate = date("Y-m-d");
    $Q = "SELECT RC.*, GH.jns_brg, RP.ket_merek AS ket_merek_ppic FROM rencana_potong RC
          INNER JOIN gudang_hasil GH ON RC.kd_gd_hasil = GH.kd_gd_hasil
          LEFT JOIN rencana_ppic RP ON RC.kd_ppic = RP.kd_ppic
          WHERE RC.kd_gd_roll='$param[kdGdRoll]'
          AND RC.tgl_rencana = '$param[tglRencana]'
          AND RC.deleted='FALSE'
          AND GH.deleted='FALSE'";
    $detailRencana = $this->db->query($Q)->result_array();
    $kdPotong = $detailRencana[0]["kd_potong"];
    if($detailRencana[0]["jns_permintaan"] == "CETAK" || $detailRencana[0]["jns_permintaan"] == "CETAK/POLOS"){
      $QSumPengambilanPotong = "SELECT SUM(berat) AS jumlahBerat,
                                       SUM(bobin) AS jumlahBobin,
                                       SUM(payung) AS jumlahPayung,
                                       SUM(payung_kuning) AS jumlahPayungKuning
                                FROM transaksi_detail_pengambilan_potong
                                WHERE kd_gd_roll = '$param[kdGdRoll]'
                                AND tgl_potong = '$param[tglRencana]'
                                AND status = 'MANDOR POTONG (CETAK)'
                                AND deleted = 'FALSE'";
    }else{
      $QSumPengambilanPotong = "SELECT SUM(berat) AS jumlahBerat,
                                       SUM(bobin) AS jumlahBobin,
                                       SUM(payung) AS jumlahPayung,
                                       SUM(payung_kuning) AS jumlahPayungKuning
                                FROM transaksi_detail_pengambilan_potong
                                WHERE kd_gd_roll = '$param[kdGdRoll]'
                                AND tgl_potong = '$param[tglRencana]'
                                AND status = 'MANDOR POTONG (EXTRUDER)'
                                AND deleted = 'FALSE'";
    }

    $QSumSisaPengambilanPotongSemalam = "SELECT SUM(TBPR.sisa) AS jumlahSisa,
                                                SUM(TBPR.payung) AS jumlahPayung,
                                                SUM(TBPR.payung_kuning) AS jumlahPayungKuning,
                                                SUM(TBPR.bobin) AS jumlahBobin
                                         FROM transaksi_berat_pengambilan_roll TBPR
                                         INNER JOIN gudang_roll GR ON TBPR.kd_gd_roll = GR.kd_gd_roll
                                         WHERE GR.kd_gd_roll = '$param[kdGdRoll]'
                                         AND TBPR.tgl_potong='$param[tglRencana]'
                                         AND TBPR.keterangan IN ('POTONG BESOK')
                                         AND GR.deleted = 'FALSE'
                                         AND TBPR.deleted = 'FALSE'";
    $QSumSisaPengambilanPotongHariIni = "SELECT SUM(TBPR.sisa) AS jumlahSisa,
                                                SUM(TBPR.payung) AS jumlahPayung,
                                                SUM(TBPR.payung_kuning) AS jumlahPayungKuning,
                                                SUM(TBPR.bobin) AS jumlahBobin
                                         FROM transaksi_berat_pengambilan_roll TBPR
                                         INNER JOIN gudang_roll GR ON TBPR.kd_gd_roll = GR.kd_gd_roll
                                         WHERE GR.kd_gd_roll = '$param[kdGdRoll]'
                                         AND TBPR.tgl_sisa='$param[tglRencana]'
                                         AND TBPR.keterangan IN ('POTONG BESOK','KEMBALI GUDANG')
                                         AND GR.deleted = 'FALSE'
                                         AND TBPR.deleted = 'FALSE'";
    $pengambilanPotong = $this->db->query($QSumPengambilanPotong)->result_array();
    $sisaPengambilanPotongSemalam = $this->db->query($QSumSisaPengambilanPotongSemalam)->result_array();
    $sisaPengambilanPotongHariIni = $this->db->query($QSumSisaPengambilanPotongHariIni)->result_array();
    $idTransaksi = Cutting_Model::generateInputHasilCode();

    $result = array("DetailRencana" => $detailRencana,
                    "PengambilanPotong" => $pengambilanPotong,
                    "SisaPengambilanPotongSemalam" => $sisaPengambilanPotongSemalam,
                    "SisaPengambilanPotongHariIni" => $sisaPengambilanPotongHariIni,
                    "IdTransaksi" => $idTransaksi);
    return json_encode($result);
  }

  public function selectPengambilanPotong($param){
    if(empty($param["tglAwal"]) || empty($param["tglAkhir"])){
      $tglAwal = date("Y-m-d",strtotime("-2 days"));
      $tglAkhir = date("Y-m-d",strtotime("+2 days"));
      $clause=" AND TDPP.tgl_potong BETWEEN '$tglAwal' AND '$tglAkhir'";
    }else{
      $tglAwal = $param["tglAwal"];
      $tglAkhir = $param["tglAkhir"];
      $clause = " AND TDPP.tgl_potong BETWEEN '$tglAwal' AND '$tglAkhir'";
    }
    $this->datatables->select("TDPP.*, TGR.keterangan_waktu, TGR.tgl_transaksi");
    $this->datatables->from("transaksi_detail_pengambilan_potong TDPP");
    $this->datatables->join("transaksi_gudang_roll TGR","TGR.kd_gd_roll = TDPP.kd_gd_roll","INNER");
    $this->datatables->where("TDPP.status = 'MANDOR POTONG ($param[bagian])'
                              AND TDPP.deleted='FALSE'
                              AND TGR.keterangan_history = TDPP.status".$clause);
    $this->datatables->group_by("TDPP.id");
    $this->db->order_by("TDPP.id","DESC");
    return $this->datatables->generate();
  }

  public function selectLaporanRencanaPpicPotong($param){
    $this->datatables->select("kd_ppic,tgl_rencana,nm_cust,jns_permintaan,ukuran,no_mesin,
                               warna_plastik,permintaan_mesin,merek,ket_merek,berat,satuan,prioritas,tebal,satuan,
                               FORMAT(ROUND(jumlah_permintaan),0) AS jumlah_permintaan,FORMAT(ROUND(sisa),0) AS sisa,
                               strip,keterangan,sts_pengerjaan,permintaan_mesin,foto_depan,foto_belakang,warna_cetak,warna_cat");
    $this->datatables->from("rencana_ppic");
    $this->datatables->where("deleted='FALSE' AND tgl_rencana='$param' AND bagian=","POTONG");
    $this->db->order_by("tgl_rencana DESC,kd_ppic DESC");
    return $this->datatables->generate();
  }

  public function selectHasilJobPotongPending(){
    $this->datatables->select("THP.kd_hasil_potong, THP.tgl_rencana, RC.no_mesin,
                               RC.customer, RC.merek, RC.tebal, RC.ukuran, TSHP.id_transaksi,
                               RC.warna_plastik, FORMAT(TSHP.jumlah_lembar,'0') AS jumlah_lembar, FORMAT(TSHP.jumlah_berat,'2') AS jumlah_berat,
                               FORMAT(THP.jumlah_apal_global,'2') AS jumlah_apal_global, FORMAT(THP.jumlah_roll_pipa,'2') AS jumlah_roll_pipa, FORMAT(THP.plusminus,'2') AS plusminus,
                               FORMAT(TPHP.berat_sisa_hari_ini,'2') AS berat_sisa_hari_ini, THP.shift,
                               (TPHP.berat_pengambilan_bagian + TPHP.berat_pengambilan_gudang + TPHP.berat_pengambilan_bagian_tumpuk + TPHP.berat_pengambilan_gudang_tumpuk) AS berat");
    $this->datatables->from("transaksi_hasil_potong THP");
    $this->datatables->join("transaksi_sub_hasil_potong TSHP","TSHP.kd_hasil_potong = THP.kd_hasil_potong","INNER");
    $this->datatables->join("transaksi_pengambilan_hasil_potong TPHP","TPHP.kd_hasil_potong = THP.kd_hasil_potong","INNER");
    $this->datatables->join("rencana_potong RC","TSHP.kd_potong = RC.kd_potong","INNER");
    $this->datatables->where("THP.status_transaksi='PENDING'
                              AND THP.deleted='FALSE'
                              AND TSHP.deleted='FALSE'
                              AND TPHP.deleted='FALSE'
                              AND RC.deleted='FALSE'
                              AND THP.status_bon='FALSE'");
    $this->db->order_by("THP.kd_hasil_potong","DESC");
    return $this->datatables->generate();
  }

  public function selectHasilJobPotong($param){
    $this->datatables->select("RC.no_mesin,TSHP.kd_gd_hasil,THP.kd_hasil_potong,
                 RC.customer, RC.merek, RC.ukuran, RC.jns_permintaan, GH.jns_brg,
                 FORMAT(THP.hasil_lembar,'0') AS hasil_lembar, FORMAT(THP.hasil_berat_bersih,'2') AS hasil_berat_bersih,
                 FORMAT(THP.hasil_berat_kotor,'2') AS hasil_berat_kotor, TSHP.id_transaksi,
                 RC.warna_plastik, FORMAT(TSHP.jumlah_lembar,'0') AS jumlah_lembar, FORMAT(TSHP.jumlah_berat,'2') AS jumlah_berat,
                 FORMAT(THP.jumlah_apal_global,'2') AS jumlah_apal_global, FORMAT(THP.jumlah_roll_pipa,'2') AS jumlah_roll_pipa, FORMAT(THP.plusminus,'2') AS plusminus,
                 FORMAT((TPHP.berat_pengambilan_bagian + TPHP.berat_pengambilan_gudang + TPHP.berat_pengambilan_bagian_tumpuk + TPHP.berat_pengambilan_gudang_tumpuk),0) AS berat");
    $this->datatables->from("transaksi_hasil_potong THP");
    $this->datatables->join("transaksi_sub_hasil_potong TSHP","TSHP.kd_hasil_potong = THP.kd_hasil_potong","INNER");
    $this->datatables->join("transaksi_pengambilan_hasil_potong TPHP","TPHP.kd_hasil_potong = THP.kd_hasil_potong","INNER");
    $this->datatables->join("rencana_potong RC","TSHP.kd_potong = RC.kd_potong","INNER");
    $this->datatables->join("gudang_hasil GH","RC.kd_gd_hasil = GH.kd_gd_hasil","INNER");
    $this->datatables->where("THP.status_transaksi='FINISH'
                              AND THP.deleted='FALSE'
                              AND TSHP.deleted='FALSE'
                              AND TPHP.deleted='FALSE'
                              AND RC.deleted='FALSE'
                              AND GH.deleted='FALSE'
                              AND THP.shift = '$param[shift]'
                              AND THP.tgl_rencana = '$param[tglJadi]'");
    $this->db->order_by("THP.kd_hasil_potong","DESC");
    return $this->datatables->generate();
  }

  public function selectHasilJobPotongPrint($param){
    $Q = "SELECT RC.no_mesin,
                 RC.customer,
                 RC.merek,
                 RC.ukuran,
                 RC.jns_permintaan,
                 RC.warna_plastik,

                 TSHP.kd_gd_hasil,

                 GH.jns_brg,

                 FORMAT(THP.hasil_lembar,'0') AS hasil_lembar,
                 FORMAT(THP.hasil_berat_bersih,'2') AS hasil_berat_bersih,
                 FORMAT(THP.hasil_berat_kotor,'2') AS hasil_berat_kotor,
                 FORMAT(TSHP.jumlah_lembar,'0') AS jumlah_lembar,
                 FORMAT(TSHP.jumlah_berat,'2') AS jumlah_berat,
                 FORMAT(THP.jumlah_apal_global,'2') AS jumlah_apal_global,
                 FORMAT(THP.jumlah_roll_pipa,'2') AS jumlah_roll_pipa,
                 FORMAT(THP.plusminus,'2') AS plusminus,

                 (TPHP.berat_pengambilan_bagian + TPHP.berat_pengambilan_gudang + TPHP.berat_pengambilan_bagian_tumpuk + TPHP.berat_pengambilan_gudang_tumpuk) AS berat
          FROM transaksi_hasil_potong THP
          INNER JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN transaksi_pengambilan_hasil_potong TPHP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          INNER JOIN gudang_hasil GH ON RC.kd_gd_hasil = GH.kd_gd_hasil
          WHERE THP.status_transaksi='FINISH'
          AND THP.deleted='FALSE'
          AND TSHP.deleted='FALSE'
          AND TPHP.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND GH.deleted='FALSE'
          AND THP.shift = '$param[shift]'
          AND THP.tgl_rencana = '$param[tglJadi]'
          ORDER BY THP.kd_hasil_potong DESC";
    $result = $this->db->query($Q)->result_array();
    return $result;
  }

  public function selectListHistoryPPICExtruder($param){
    $this->datatables->select("kd_ppic, tgl_rencana, nm_cust, merek, ket_merek,
                               jns_permintaan, ukuran, warna_plastik, tebal,
                               berat, FORMAT(jumlah_permintaan,2) AS jumlah_permintaan, satuan,
                               FORMAT(sisa,2) AS sisa, strip,
                               sts_pengerjaan, prioritas, foto_depan, keterangan, diperbarui");
    $this->datatables->from("rencana_ppic RP");
    $this->datatables->where("bagian = 'EXTRUDER' AND deleted='FALSE' AND DATE_FORMAT(tgl_rencana,'%Y-%m') = '$param'");
    $this->db->order_by("tgl_rencana","DESC");
    return $this->datatables->generate();
  }

  public function selectListBonHasilJadi($param){
    if(strtoupper($param["merek"]) == "CETAK"){
      $where = "AND RC.merek NOT IN('Zippin','MP','KP','Klip','Kantong','CB','PON','Klip In')";
    }else{
  	  if($param['merek']=="Klip"){
  		    $where = "AND (RC.merek='$param[merek]' OR RC.merek IN('PON','POLOS','KLIPPOLOS'))";
  	  }else{
  		    $where = "AND RC.merek='$param[merek]'";
  	  }
    }
    $Q = "SELECT RC.merek,
                 RC.tebal,
                 RC.ukuran,
                 RC.warna_plastik,
                 RC.customer,

                 FORMAT(TSHP.jumlah_lembar,0) AS jumlah_lembar,
                 FORMAT(TSHP.jumlah_berat,2) AS jumlah_berat,

                 GH.jns_brg,

                 THP.tgl_jadi
          FROM transaksi_sub_hasil_potong TSHP
          INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          INNER JOIN gudang_hasil GH ON TSHP.kd_gd_hasil = GH.kd_gd_hasil
          WHERE TSHP.deleted='FALSE'
          AND THP.status_transaksi='FINISH'
          AND GH.jns_brg='$param[jnsBrg]'
          AND THP.tgl_rencana='$param[tglJadi]' ".$where.
          " ORDER BY CAST(SUBSTRING_INDEX(LCASE(RC.ukuran),'x',1) AS UNSIGNED) ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListBonHasilJadiGlobal($param){
    if($param['jnsBrg'] == "CAMPUR_STANDARD"){
      $where = "AND GH.jns_brg IN('CAMPUR','STANDARD')";
    }else{
      $where = "AND GH.jns_brg='$param[jnsBrg]'";
    }
    $Q = "SELECT RC.merek,
                 RC.tebal,
                 RC.ukuran,
                 RC.warna_plastik,
                 RC.customer,
                 RC.jns_permintaan,
                 RC.ket_barang,

                 THP.status_bon,
                 THP.tgl_rencana,

                 TSHP.kd_gd_hasil,

                 FORMAT(TSHP.jumlah_lembar,0) AS jumlah_lembar,
                 FORMAT(TSHP.jumlah_berat,2) AS jumlah_berat,

                 GH.jns_brg
          FROM transaksi_sub_hasil_potong TSHP
          INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          INNER JOIN gudang_hasil GH ON TSHP.kd_gd_hasil = GH.kd_gd_hasil
          WHERE TSHP.deleted='FALSE'
          AND THP.deleted='FALSE'
          AND THP.status_transaksi='FINISH'
          AND RC.deleted='FALSE'
          AND GH.deleted='FALSE'
          AND THP.tgl_rencana='$param[tglJadi]' $where
          ORDER BY merek DESC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectHistorySisaPotong($param){
    if(empty($param["tglAwal"]) || empty($param["tglAkhir"])){
       $tglAwal = date("Y-m-d");
       $tglAkhir = date("Y-m-d");
    }else{
      $tglAwal = $param["tglAwal"];
      $tglAkhir = $param["tglAkhir"];
    }
    // $this->datatables->select("TGR.id AS id_tgr, TGR.kd_gd_roll, TDPP.tgl_sisa, TDPP.tgl_potong,
    //                            TDPP.ukuran, TDPP.warna_plastik, TDPP.merek,
    //                            TGR.berat, TGR.payung, TGR.payung_kuning, TGR.bobin,
    //                            TGR.keterangan_history,TDPP.id AS id_tdpp,
    //                            TBPR.id AS id_tbpr");
    // $this->datatables->from("transaksi_gudang_roll TGR");
    // $this->datatables->join("gudang_roll GR","TGR.kd_gd_roll = GR.kd_gd_roll","INNER");
    // $this->datatables->join("transaksi_detail_pengambilan_potong TDPP","TDPP.kd_gd_roll = GR.kd_gd_roll","INNER");
    // $this->datatables->join("transaksi_berat_pengambilan_roll TBPR","TBPR.kd_gd_roll = GR.kd_gd_roll","INNER");
    // $this->datatables->where("TGR.bagian='POTONG'
    //                           AND TGR.keterangan_history IN('OPERATOR(SISA SEMALAM)','OPERATOR(SISA MESIN)')
    //                           AND TGR.status_history='MASUK'
    //                           AND TDPP.tgl_sisa = TGR.tgl_transaksi
    //                           AND TBPR.tgl_sisa = TDPP.tgl_sisa
    //                           AND TGR.tgl_transaksi BETWEEN '$tglAwal' AND '$tglAkhir'");
    // $this->db->group_by("TGR.id");
    $this->datatables->select("TDPP.id, TDPP.kd_gd_roll, TDPP.tgl_sisa, TDPP.tgl_potong,
                               TDPP.ukuran, TDPP.warna_plastik, TDPP.merek, TDPP.berat, TDPP.payung, TDPP.payung_kuning,
                               TDPP.bobin, TDPP.status");
    $this->datatables->from("transaksi_detail_pengambilan_potong TDPP");
    $this->datatables->where("TDPP.status NOT IN('MANDOR POTONG (EXTRUDER)','MANDOR POTONG (CETAK)')
                              AND TDPP.tgl_sisa BETWEEN '$tglAwal' AND '$tglAkhir'
                              AND TDPP.deleted = 'FALSE'");
    $this->db->order_by("TDPP.tgl_sisa","DESC");
    return $this->datatables->generate();
  }

  public function selectUkuranPengembalianPotongTertinggal($param){
    if($param["jnsPermintaan"] == "CETAK"){
      $clause = "(jns_permintaan = '$param[jnsPermintaan]' OR jns_permintaan = 'CETAK/POLOS')";
    }else{
      $clause = "(jns_permintaan = '$param[jnsPermintaan]' OR jns_permintaan = 'POLOS/CETAK')";
    }
    if($param["Key"]==""){
      $Q = "SELECT kd_potong, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, jns_permintaan, ukuran,
                   ket_barang, merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
            FROM rencana_potong
            WHERE $clause
            AND tgl_rencana  BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
            AND deleted = 'FALSE'
            GROUP BY panjang, warna_plastik, merek
            ORDER BY DATE_FORMAT(tgl_rencana,'%Y-%m-%d') DESC";
    }else{
      $Q = "SELECT kd_potong, kd_gd_roll, customer, SUBSTRING_INDEX(ukuran, 'x',1) AS panjang, jns_permintaan, ukuran,
                   ket_barang, merek, warna_plastik, DATE_FORMAT(tgl_rencana, '%d %M %Y') AS tgl_rencana
            FROM rencana_potong
            WHERE $clause
            AND tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
            AND deleted = 'FALSE'
            AND (SUBSTRING_INDEX(ukuran, 'x',1) LIKE '%$param[Key]%'
            OR customer LIKE '%$param[Key]%'
            OR merek LIKE '%$param[Key]%'
            OR warna_plastik LIKE '%$param[Key]%'
            OR tgl_rencana LIKE '%$param[Key]%')
            GROUP BY panjang, warna_plastik, merek
            ORDER BY DATE_FORMAT(tgl_rencana,'%Y-%m-%d') DESC";
    }
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectLaporanHasilPotongGlobal($param){
    $Q = "SELECT FORMAT(SUM(IF(GR.jns_permintaan = 'POLOS',TSHP.jumlah_lembar,0)),0) AS jumlahLembarPolos,
                 FORMAT(SUM(IF(GR.jns_permintaan = 'POLOS',TSHP.jumlah_berat,0)),2) AS jumlahBeratPolos,
                 FORMAT(SUM(IF(GR.jns_permintaan = 'CETAK',TSHP.jumlah_lembar,0)),0) AS jumlahLembarCetak,
                 FORMAT(SUM(IF(GR.jns_permintaan = 'CETAK',TSHP.jumlah_berat,0)),2) AS jumlahBeratCetak
          FROM transaksi_sub_hasil_potong TSHP
          INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN gudang_roll GR ON TSHP.kd_gd_roll = GR.kd_gd_roll
          WHERE THP.tgl_rencana = '$param'
          AND THP.deleted='FALSE'
          AND TSHP.deleted='FALSE'
          AND GR.deleted='FALSE'";

    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectLaporanBonApal($param){
    if($param["jnsPermintaan"] == "CETAK"){
      $clause = "RC.jns_permintaan IN('$param[jnsPermintaan]','CETAK/POLOS')";
    }else{
      $clause = "RC.jns_permintaan = '$param[jnsPermintaan]'";
    }
    $Q = "SELECT RC.customer,
                 RC.merek,
                 RC.no_mesin,
                 LCASE(RC.warna_plastik) AS warna_plastik,
                 RC.ukuran,
                 RC.jns_permintaan,

                 FORMAT(THP.jumlah_apal_global,2) AS apal
          FROM transaksi_hasil_potong THP
          INNER JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          WHERE THP.tgl_rencana='$param[tglJadi]'
          AND $clause
          AND RC.deleted='FALSE'
          AND THP.deleted='FALSE'
          AND TSHP.deleted='FALSE'
          GROUP BY RC.kd_gd_roll";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectGudangApal($param){
    $result = $this->db->query("SELECT kd_gd_apal, jenis, sub_jenis
                                FROM gudang_apal
                                WHERE deleted='FALSE'
                                AND jenis='$param'
                                OR jenis IN ('HD','KANTONG SAK','SAPUAN','STRIP','TEPUNG')")->result_array();
    return json_encode($result);
  }

  public function selectListDataBonApalPending(){
    $Q = "SELECT id, merek, FORMAT(jumlah_apal,2) jumlah_apal, tgl_transaksi FROM transaksi_detail_history_apal
          WHERE bagian='POTONG'
          AND sts_transaksi='PENDING'
          AND keterangan_history = 'KIRIMAN APAL'
          AND deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectDetailBonApal($param){
    $result = $this->db->query("SELECT * FROM transaksi_detail_history_apal WHERE id='$param'")->result_array();
    return json_encode($result);
  }

  public function selectJumlahPerSubApal($param){
    $Q = "SELECT SUM(TDHA.jumlah_apal) AS jumlah, GA.sub_jenis, GA.jenis FROM transaksi_detail_history_apal TDHA
          INNER JOIN gudang_apal GA ON TDHA.kd_gd_apal = GA.kd_gd_apal
          WHERE (TDHA.tgl_transaksi='$param[tglJadi]'
                    AND GA.jenis = '$param[jnsPermintaan]'
                    AND TDHA.bagian='POTONG'
                    AND TDHA.deleted='FALSE')
                    OR (TDHA.tgl_transaksi='$param[tglJadi]'
                    AND GA.jenis = 'STRIP'
                    AND TDHA.bagian='POTONG'
                    AND TDHA.deleted='FALSE')
          GROUP BY TDHA.kd_gd_apal";
    $result = $this->db->query($Q)->result_array();
    return $result;
  }

  public function selectDataForUpdateHasil($param){
    $Q = "SELECT THP.tgl_rencana,
                 THP.tgl_jadi,
                 THP.jumlah_apal_global,
                 THP.hasil_berat_bersih,
                 THP.hasil_lembar,
                 THP.hasil_berat_kotor,
                 THP.jenis_roll_pipa,
                 THP.jumlah_payung,
                 THP.jumlah_bobin,
                 THP.jumlah_payung_kuning,
                 THP.jumlah_roll_pipa,
                 THP.plusminus,
                 THP.kd_hasil_potong,

                 TSHP.kd_gd_hasil,
                 TSHP.jumlah_lembar,
                 TSHP.jumlah_berat,

                 GH.jns_permintaan,
                 GH.jns_brg,


                 RC.customer,
                 RC.tebal,
                 RC.ukuran,
                 RC.strip,
                 RC.no_mesin,
                 RC.ket_merek,
                 RC.ket_barang,
                 RC.kd_ppic,

                 TPHP.berat_pengambilan_bagian,
                 TPHP.bobin_pengambilan_bagian,
                 TPHP.payung_pengambilan_bagian,
                 TPHP.payung_kuning_pengambilan_bagian,

                 TPHP.berat_sisa_semalam,
                 TPHP.bobin_sisa_semalam,
                 TPHP.payung_sisa_semalam,
                 TPHP.payung_kuning_sisa_semalam,

                 TPHP.berat_pengambilan_gudang,
                 TPHP.bobin_pengambilan_gudang,
                 TPHP.payung_pengambilan_gudang,
                 TPHP.payung_kuning_pengambilan_gudang,

                 TPHP.berat_sisa_hari_ini,
                 TPHP.bobin_sisa_hari_ini,
                 TPHP.payung_sisa_hari_ini,
                 TPHP.payung_kuning_sisa_hari_ini,

                 TPHP.berat_pengambilan_bagian_tumpuk,
	               TPHP.bobin_pengambilan_bagian_tumpuk,
                 TPHP.payung_pengambilan_bagian_tumpuk,
                 TPHP.payung_kuning_pengambilan_bagian_tumpuk,

                 TPHP.berat_sisa_semalam_tumpuk,
	               TPHP.bobin_sisa_semalam_tumpuk,
                 TPHP.payung_sisa_semalam_tumpuk,
                 TPHP.payung_kuning_sisa_semalam_tumpuk,

                 TPHP.berat_pengambilan_gudang_tumpuk,
                 TPHP.bobin_pengambilan_gudang_tumpuk,
                 TPHP.payung_pengambilan_gudang_tumpuk,
                 TPHP.payung_kuning_pengambilan_gudang_tumpuk,

                 TPHP.berat_sisa_hari_ini_tumpuk,
                 TPHP.bobin_sisa_hari_ini_tumpuk,
                 TPHP.payung_sisa_hari_ini_tumpuk,
                 TPHP.payung_kuning_sisa_hari_ini_tumpuk
          FROM transaksi_sub_hasil_potong TSHP
          INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN transaksi_pengambilan_hasil_potong TPHP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          INNER JOIN gudang_hasil GH ON TSHP.kd_gd_hasil = GH.kd_gd_hasil
          WHERE TSHP.id_transaksi = '$param'
          AND TSHP.deleted = 'FALSE'
          AND THP.deleted = 'FALSE'
          AND TPHP.deleted = 'FALSE'
          AND RC.deleted = 'FALSE'
          AND GH.deleted = 'FALSE'";

    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectDetailPengambilanPotong($param){
    $Q = "SELECT TDPP.id,
                 TDPP.kd_gd_roll,
                 TDPP.kd_potong,
                 TDPP.tgl_sisa,
                 TDPP.tgl_potong,
                 TDPP.berat,
                 TDPP.bobin,
                 TDPP.payung,
                 TDPP.payung_kuning,
                 TDPP.status,

                 TGR.keterangan_waktu
          FROM transaksi_detail_pengambilan_potong TDPP
          INNER JOIN transaksi_gudang_roll TGR ON TDPP.kd_gd_roll = TGR.kd_gd_roll
          AND TDPP.status = TGR.keterangan_history
          WHERE TDPP.id = '$param'
          AND TDPP.deleted = 'FALSE'
          AND TGR.deleted = 'FALSE'";
    $arrData = $this->db->query($Q)->result_array();
    return json_encode($arrData);
  }

  public function selectDetailHistorySisa($param){
    $Q = "SELECT TDPP.*, GR.ukuran, GR.merek, GR.merek, GR.warna_plastik, GR.jns_permintaan
          FROM transaksi_detail_pengambilan_potong TDPP
          INNER JOIN gudang_roll GR ON TDPP.kd_gd_roll = GR.kd_gd_roll
          WHERE TDPP.id = '$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectDataForUpdateHasilTemp($param){
    $Q = "SELECT THP.tgl_rencana,
                 THP.tgl_jadi,
                 THP.jumlah_apal_global,
                 THP.hasil_berat_bersih,
                 THP.hasil_lembar,
                 THP.hasil_berat_kotor,
                 THP.jenis_roll_pipa,
                 THP.jumlah_payung,
                 THP.jumlah_bobin,
                 THP.jumlah_payung_kuning,
                 THP.jumlah_roll_pipa,
                 THP.plusminus,
                 THP.kd_hasil_potong,
                 THP.shift,
                 THP.keterangan,

                 TSHP.kd_gd_hasil,
                 TSHP.kd_gd_roll,
                 TSHP.kd_gd_roll_tumpuk,
                 TSHP.jumlah_lembar,
                 TSHP.jumlah_berat,

                 TPHP.berat_pengambilan_gudang,
                 TPHP.bobin_pengambilan_gudang,
                 TPHP.payung_pengambilan_gudang,
                 TPHP.payung_kuning_pengambilan_gudang,
                 TPHP.berat_pengambilan_gudang_tumpuk,
                 TPHP.bobin_pengambilan_gudang_tumpuk,
                 TPHP.payung_pengambilan_gudang_tumpuk,
                 TPHP.payung_kuning_pengambilan_gudang_tumpuk,

                 GH.jns_permintaan,
                 GH.jns_brg,
                 GH.merek,
                 GH.warna_plastik,

                 RC.customer,
                 RC.kd_potong,
                 RC.tebal,
                 RC.ukuran,
                 RC.strip,
                 RC.no_mesin,
                 RC.kd_ppic,
                 RC.ket_merek,
                 RC.jns_permintaan,
                 RC.ket_barang
          FROM transaksi_sub_hasil_potong TSHP
          INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN transaksi_pengambilan_hasil_potong TPHP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
          INNER JOIN gudang_hasil GH ON TSHP.kd_gd_hasil = GH.kd_gd_hasil
          WHERE TSHP.id_transaksi = '$param'
          AND TSHP.deleted = 'FALSE'
          AND THP.deleted = 'FALSE'
          AND TPHP.deleted = 'FALSE'
          AND RC.deleted = 'FALSE'
          AND GH.deleted = 'FALSE'";
    $detailRencana = $this->db->query($Q)->result_array();

    $kdGdRoll = $detailRencana[0]["kd_gd_roll"];
    $kdGdRollTumpuk = $detailRencana[0]["kd_gd_roll_tumpuk"];
    $tglRencana = $detailRencana[0]["tgl_rencana"];

    if($detailRencana[0]["jns_permintaan"] == "POLOS"){
      $QSumPengambilanPotong = "SELECT SUM(berat) AS jumlahBerat,
                                       SUM(bobin) AS jumlahBobin,
                                       SUM(payung) AS jumlahPayung,
                                       SUM(payung_kuning) AS jumlahPayungKuning
                                FROM transaksi_detail_pengambilan_potong
                                WHERE kd_gd_roll = '$kdGdRoll'
                                AND tgl_potong = '$tglRencana'
                                AND status = 'MANDOR POTONG (EXTRUDER)'
                                AND deleted = 'FALSE'";
    }else{
      $QSumPengambilanPotong = "SELECT SUM(berat) AS jumlahBerat,
                                       SUM(bobin) AS jumlahBobin,
                                       SUM(payung) AS jumlahPayung,
                                       SUM(payung_kuning) AS jumlahPayungKuning
                                FROM transaksi_detail_pengambilan_potong
                                WHERE kd_gd_roll = '$kdGdRoll'
                                AND tgl_potong = '$tglRencana'
                                AND status = 'MANDOR POTONG (CETAK)'
                                AND deleted = 'FALSE'";
    }

    $QSumSisaPengambilanPotongSemalam = "SELECT SUM(TBPR.sisa) AS jumlahSisa,
                                                SUM(TBPR.payung) AS jumlahPayung,
                                                SUM(TBPR.payung_kuning) AS jumlahPayungKuning,
                                                SUM(TBPR.bobin) AS jumlahBobin
                                         FROM transaksi_berat_pengambilan_roll TBPR
                                         INNER JOIN gudang_roll GR ON TBPR.kd_gd_roll = GR.kd_gd_roll
                                         WHERE GR.kd_gd_roll = '$kdGdRoll'
                                         AND TBPR.tgl_potong='$tglRencana'
                                         AND TBPR.keterangan IN ('POTONG BESOK')
                                         AND GR.deleted = 'FALSE'
                                         AND TBPR.deleted = 'FALSE'";
    $QSumSisaPengambilanPotongHariIni = "SELECT SUM(TBPR.sisa) AS jumlahSisa,
                                                SUM(TBPR.payung) AS jumlahPayung,
                                                SUM(TBPR.payung_kuning) AS jumlahPayungKuning,
                                                SUM(TBPR.bobin) AS jumlahBobin
                                         FROM transaksi_berat_pengambilan_roll TBPR
                                         INNER JOIN gudang_roll GR ON TBPR.kd_gd_roll = GR.kd_gd_roll
                                         WHERE GR.kd_gd_roll = '$kdGdRoll'
                                         AND TBPR.tgl_sisa='$tglRencana'
                                         AND TBPR.keterangan IN ('POTONG BESOK','KEMBALI GUDANG')
                                         AND GR.deleted = 'FALSE'
                                         AND TBPR.deleted = 'FALSE'";
    $pengambilanPotong = $this->db->query($QSumPengambilanPotong)->result_array();
    $sisaPengambilanPotongSemalam = $this->db->query($QSumSisaPengambilanPotongSemalam)->result_array();
    $sisaPengambilanPotongHariIni = $this->db->query($QSumSisaPengambilanPotongHariIni)->result_array();

    $result = array("DetailRencana" => $detailRencana,
                    "PengambilanPotong" => $pengambilanPotong,
                    "SisaPengambilanPotongSemalam" => $sisaPengambilanPotongSemalam,
                    "SisaPengambilanPotongHariIni" => $sisaPengambilanPotongHariIni);
    return json_encode($result);
  }

  public function countKirimanBalikGudangHasil(){
    $data = $this->db->query("SELECT id_permintaan_jadi FROM transaksi_gudang_hasil WHERE status_transaksi='SEND BACK' AND deleted='FALSE'");
    return $data->num_rows();
  }

  public function getDataKirimanBalikGudangHasil()
  {
    $data = $this->db->query("select id_permintaan_jadi, ukuran, warna, merek, customer, jumlah_lembar, jumlah_berat, tgl_transaksi, sts_barang, note_gudanghasil from transaksi_gudang_hasil where status_transaksi='SEND BACK' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function getListKirimanBalikPerId($id)
  {
    $data = $this->db->query("select id_permintaan_jadi, ukuran, warna, merek, customer, jumlah_lembar, jumlah_berat, tgl_transaksi, sts_barang, note_gudanghasil from transaksi_gudang_hasil where id_permintaan_jadi = '$id' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function selectDetailDataSisaPengambilan($param){
    $Q = "SELECT TBPR.kd_gd_roll,
                 TBPR.kd_potong,
                 TBPR.sisa,
                 TBPR.payung,
                 TBPR.payung_kuning,
                 TBPR.bobin,
                 TBPR.keterangan,
                 TBPR.shift,
                 TBPR.tgl_sisa,
                 TBPR.tgl_potong,

                 RC.ukuran,
                 RC.merek,
                 RC.warna_plastik,

                 GR.jns_permintaan
          FROM transaksi_berat_pengambilan_roll TBPR
          INNER JOIN rencana_potong RC ON TBPR.kd_potong = RC.kd_potong
          INNER JOIN gudang_roll GR ON TBPR.kd_gd_roll = GR.kd_gd_roll
          WHERE TBPR.deleted='FALSE'
          AND RC.deleted='FALSE'
          AND TBPR.id='$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  // public function selectDataRencanaPpic_Konversi($param){
  //   $Q = "SELECT jumlah_permintaan, satuan, ukuran, berat, tebal, satuan_kilo
  //         FROM rencana_ppic
  //         WHERE kd_ppic='$param'";
  //   $result = $this->db->query($Q)->result_array();
  //   return json_encode($result);
  // }
  #=========================Select Function (Finish)=========================#

  #=========================Update Function (Start)=========================#
  public function kirimUlangKiriman($data){
    $this->db->trans_begin();

    $Q1 = "SELECT kd_gd_hasil, tgl_transaksi, jumlah_berat, jumlah_lembar
           FROM transaksi_gudang_hasil
           WHERE id_permintaan_jadi = '$data[id]'
           AND deleted='FALSE'";
    $arrQ1 = $this->db->query($Q1)->result_array();

    $Q2 = "SELECT TSHP.id_transaksi, TSHP.kd_hasil_potong, TSHP.kd_potong, TSHP.kd_gd_hasil
           FROM transaksi_sub_hasil_potong TSHP
           INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
           WHERE TSHP.kd_gd_hasil = '".$arrQ1[0]["kd_gd_hasil"]."'
           AND THP.tgl_rencana = '".$arrQ1[0]["tgl_transaksi"]."'
           AND TSHP.jumlah_lembar = '".$arrQ1[0]["jumlah_lembar"]."'
           AND TSHP.jumlah_berat = '".$arrQ1[0]["jumlah_berat"]."'
           AND THP.deleted = 'FALSE'
           AND TSHP.deleted = 'FALSE'";
    $arrQ2 = $this->db->query($Q2)->result_array();

    $this->db->set("jumlah_lembar", $data["lembar"]);
    $this->db->set("jumlah_berat", $data["berat"]);
    $this->db->where("id_transaksi",$arrQ2[0]["id_transaksi"]);
    $this->db->update("transaksi_sub_hasil_potong");

    $selisihLembar = floatval($arrQ1[0]["jumlah_lembar"]) - floatval($data["lembar"]);
    $selisihBeratKotor = floatval($arrQ1[0]["jumlah_berat"]) - floatval($data["lembar"]);

    $this->db->set("hasil_lembar","hasil_lembar + ".$selisihLembar, FALSE);
    $this->db->set("hasil_berat_kotor","hasil_berat_kotor + ".$selisihBeratKotor, FALSE);
    $this->db->where("kd_hasil_potong", $arrQ1[0]["kd_gd_hasil"]);
    $this->db->update("transaksi_hasil_potong");

    $this->db->set("status_transaksi","PROGRESS");
    $this->db->set("jumlah_berat",$data["berat"]);
    $this->db->set("jumlah_lembar",$data["lembar"]);
    $this->db->where("id_permintaan_jadi",$data['id']);
    $this->db->update("transaksi_gudang_hasil");

    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function updateRencanaPotong($param){
    $this->db->trans_begin();
    $this->db->where("kd_potong",$param["kd_potong"]);
    $this->db->update("rencana_potong",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateRencanaPpic($param){
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

  public function updateSaveRencanaPotong(){
    $this->db->trans_begin();
    $resultCounter = $this->db->query("SELECT COUNT(kd_potong) AS counter FROM rencana_potong WHERE sts_pengerjaan='PENDING'")->result_array();
    if($resultCounter[0]["counter"] > 0){
      $this->db->query("UPDATE rencana_potong SET sts_pengerjaan='PROGRESS'
                        WHERE sts_pengerjaan='PENDING'
                        AND deleted='FALSE'");
      $this->db->query("UPDATE rencana_ppic SET sts_pengerjaan='PROGRESS'
                        WHERE sts_pengerjaan='PENDING'
                        AND bagian='POTONG'
                        AND (satuan_kilo IS NOT NULL OR satuan_kilo !='')
                        AND (sisa IS NOT NULL OR sisa !='')
                        AND (no_mesin IS NOT NULL OR no_mesin !='')");
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }else{
      $this->db->trans_rollback();
      return "Data Kosong";
    }
  }

  public function updateMesin($param){
    $this->db->trans_begin();
    $this->db->where("kd_ppic",$param["kd_ppic"]);
    $this->db->update("rencana_ppic",$param);

    $this->db->where("kd_ppic",$param["kd_ppic"]);
    $this->db->update("rencana_potong",$param);

    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateEditMerekRencana($param){
    $this->db->trans_begin();
    if(empty($param["kd_ppic"])){
      $this->db->where("kd_potong",$param["kd_potong"]);
      $this->db->update("rencana_potong",$param);
    }else{
      $this->db->where("kd_potong",$param["kd_potong"]);
      $this->db->update("rencana_potong",$param);
      $this->db->where("kd_ppic",$param["kd_ppic"]);
      $this->db->update("rencana_ppic",array_diff_key($param,array_flip(array("kd_potong"))));
    }
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateGantiMesinMandor($param){
    $this->db->trans_begin();
    if(empty($param["kd_ppic"])){
      $this->db->where("kd_potong",$param["kd_potong"]);
      $this->db->update("rencana_potong",$param);
    }else{
      $this->db->where("kd_ppic",$param["kd_ppic"]);
      $this->db->update("rencana_ppic",array_diff_key($param,array_flip(array("kd_potong"))));

      $this->db->where("kd_potong",$param["kd_potong"]);
      $this->db->update("rencana_potong",$param);
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateSaveRencanaPotongSusulan(){
    $this->db->trans_begin();
    $Q = "UPDATE rencana_potong SET sts_pengerjaan='PROGRESS'
          WHERE kd_ppic IS NULL
          AND sts_pengerjaan = 'PENDING'
          AND deleted = 'FALSE'";
    $this->db->query($Q);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateSaveSisaPengambilanPotong($param){
    $this->db->trans_begin();
    $Q = "UPDATE transaksi_berat_pengambilan_roll TBPR
          JOIN gudang_roll GR ON TBPR.kd_gd_roll = GR.kd_gd_roll
          SET TBPR.sts_transaksi='PROGRESS'
          WHERE TBPR.sts_transaksi='PENDING'
          AND GR.jns_permintaan='$param'";
    $Q2 = "UPDATE transaksi_detail_pengambilan_potong
           SET sts_transaksi='PROGRESS'
           WHERE sts_transaksi='PENDING'
           AND jns_permintaan='$param'";
    $Q3 = "UPDATE transaksi_gudang_roll
           SET status_transaksi='PROGRESS'
           WHERE status_transaksi='PENDING'
           AND bagian='POTONG'
           AND jns_permintaan = '$param'";
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

  public function updateSaveHasilJobPotong($param){
    $this->db->trans_begin();
    $this->db->set("status_transaksi","FINISH");
    $this->db->where("status_transaksi='PENDING'");
    $this->db->update("transaksi_hasil_potong");
    $this->db->query("UPDATE transaksi_gudang_roll SET status_transaksi='PROGRESS'
                      WHERE bagian='POTONG'
                      AND status_transaksi='PENDING'
                      AND keterangan_history='OPERATOR POTONG'");
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

  public function updateSaveTransaksiDetailHistoryApal(){
    $this->db->trans_begin();
    $this->db->query("UPDATE transaksi_detail_history_apal SET sts_transaksi='PROGRESS' WHERE sts_transaksi='PENDING'");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateHasilCutting($param){
    $this->db->trans_begin();
    $kdHasilPotong = $param["THP"]["kd_hasil_potong"];
    $idTransaksi = $param["TSHP"]["id_transaksi"];
    $kdPotongBaru = $param["TSHP"]["kd_potong"];
    $periodeLock = date("Y-m",strtotime($param["THP"]["tgl_rencana"]));
    $QCheckLock = "SELECT COUNT(id_permintaan_jadi) AS counterLock FROM transaksi_gudang_hasil
                   WHERE status_lock='TRUE'
                   AND DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$periodeLock'";
    $arrCheckLock = $this->db->query($QCheckLock)->result_array();
    if($arrCheckLock[0]["counterLock"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $QDataLama = "SELECT THP.tgl_rencana,
                           THP.tgl_jadi,
                           THP.jumlah_apal_global,
                           THP.hasil_berat_bersih,
                           THP.hasil_lembar,
                           THP.hasil_berat_kotor,
                           THP.jenis_roll_pipa,
                           THP.jumlah_payung,
                           THP.jumlah_bobin,
                           THP.jumlah_payung_kuning,
                           THP.jumlah_roll_pipa,
                           THP.plusminus,
                           THP.kd_hasil_potong,

                           TSHP.kd_gd_hasil,
                           TSHP.jumlah_lembar,
                           TSHP.jumlah_berat,
                           TSHP.kd_gd_roll,
                           TSHP.kd_gd_roll_tumpuk,

                           GH.jns_permintaan,
                           GH.jns_brg,

                           RC.customer,
                           RC.tebal,
                           RC.ukuran,
                           RC.strip,
                           RC.no_mesin,
                           RC.ket_merek,
                           RC.ket_barang,
                           RC.kd_ppic,
                           RC.kd_potong,
                           RC.kd_gd_hasil,

                           TPHP.berat_pengambilan_bagian,
                           TPHP.bobin_pengambilan_bagian,
                           TPHP.payung_pengambilan_bagian,
                           TPHP.payung_kuning_pengambilan_bagian,
                           TPHP.berat_sisa_semalam,
                           TPHP.bobin_sisa_semalam,
                           TPHP.payung_sisa_semalam,
                           TPHP.payung_kuning_sisa_semalam,
                           TPHP.berat_pengambilan_gudang,
                           TPHP.bobin_pengambilan_gudang,
                           TPHP.payung_pengambilan_gudang,
                           TPHP.payung_kuning_pengambilan_gudang,
                           TPHP.berat_sisa_hari_ini,
                           TPHP.bobin_sisa_hari_ini,
                           TPHP.payung_sisa_hari_ini,
                           TPHP.payung_kuning_sisa_hari_ini,
                           TPHP.berat_pengambilan_bagian_tumpuk,
                           TPHP.bobin_pengambilan_bagian_tumpuk,
                           TPHP.payung_pengambilan_bagian_tumpuk,
                           TPHP.payung_kuning_pengambilan_bagian_tumpuk,
                           TPHP.berat_sisa_semalam_tumpuk,
                           TPHP.bobin_sisa_semalam_tumpuk,
                           TPHP.payung_sisa_semalam_tumpuk,
                           TPHP.payung_kuning_sisa_semalam_tumpuk,
                           TPHP.berat_pengambilan_gudang_tumpuk,
                           TPHP.bobin_pengambilan_gudang_tumpuk,
                           TPHP.payung_pengambilan_gudang_tumpuk,
                           TPHP.payung_kuning_pengambilan_gudang_tumpuk,
                           TPHP.berat_sisa_hari_ini_tumpuk,
                           TPHP.bobin_sisa_hari_ini_tumpuk,
                           TPHP.payung_sisa_hari_ini_tumpuk,
                           TPHP.payung_kuning_sisa_hari_ini_tumpuk
                    FROM transaksi_sub_hasil_potong TSHP
                    INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
                    INNER JOIN transaksi_pengambilan_hasil_potong TPHP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
                    INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong
                    INNER JOIN gudang_hasil GH ON TSHP.kd_gd_hasil = GH.kd_gd_hasil
                    WHERE TSHP.id_transaksi = '$idTransaksi'
                    AND TSHP.deleted = 'FALSE'
                    AND THP.deleted = 'FALSE'
                    AND TPHP.deleted = 'FALSE'
                    AND RC.deleted = 'FALSE'
                    AND GH.deleted = 'FALSE'";

      $arrDataLama = $this->db->query($QDataLama)->result_array();

      #============================== Proses Update Transaksi Gudang Roll Dan Stok Roll ==============================#
      $QCheckTransaksiGudangRoll = "SELECT id, status_transaksi FROM transaksi_gudang_roll
                                    WHERE keterangan_history = 'OPERATOR POTONG'
                                    AND bagian='POTONG'
                                    AND status_history='KELUAR'
                                    AND keterangan_transaksi = 'KELUAR KE POTONG'
                                    AND kd_gd_roll = '".$arrDataLama[0]["kd_gd_roll"]."'
                                    AND tgl_transaksi = '".$arrDataLama[0]["tgl_rencana"]."'
                                    AND berat = '".$arrDataLama[0]["berat_pengambilan_gudang"]."'
                                    AND bobin = '".$arrDataLama[0]["bobin_pengambilan_gudang"]."'
                                    AND payung = '".$arrDataLama[0]["payung_pengambilan_gudang"]."'
                                    AND payung_kuning = '".$arrDataLama[0]["payung_kuning_pengambilan_gudang"]."'
                                    AND deleted='FALSE'";
      $arrDataTransaksiGudangRoll = $this->db->query($QCheckTransaksiGudangRoll)->result_array();
      if(count($arrDataTransaksiGudangRoll) > 0){
        if($arrDataTransaksiGudangRoll[0]["status_transaksi"] == "FINISH"){
          $beratPengambilanLama = floatval($arrDataLama[0]["berat_pengambilan_gudang"]);
          $bobinPengambilanLama = floatval($arrDataLama[0]["bobin_pengambilan_gudang"]);
          $payungPengambilanLama = floatval($arrDataLama[0]["payung_pengambilan_gudang"]);
          $payungKuningPengambilanLama = floatval($arrDataLama[0]["payung_kuning_pengambilan_gudang"]);

          $beratPengambilanBaru = floatval($param["TPHP"]["berat_pengambilan_gudang"]);
          $bobinPengambilanBaru = floatval($param["TPHP"]["bobin_pengambilan_gudang"]);
          $payungPengambilanBaru = floatval($param["TPHP"]["payung_pengambilan_gudang"]);
          $payungKuningPengambilanBaru = floatval($param["TPHP"]["payung_kuning_pengambilan_gudang"]);

          $beratPengambilanSelisih = $beratPengambilanLama - $beratPengambilanBaru;
          $bobinPengambilanSelisih = $bobinPengambilanLama - $bobinPengambilanBaru;
          $payungPengambilanSelisih = $payungPengambilanLama - $payungPengambilanBaru;
          $payungKuningPengambilanSelisih = $payungKuningPengambilanLama - $payungKuningPengambilanBaru;

          $this->db->set("stok","stok + $beratPengambilanSelisih",FALSE);
          $this->db->set("bobin","bobin + $bobinPengambilanSelisih",FALSE);
          $this->db->set("payung","payung + $payungPengambilanSelisih",FALSE);
          $this->db->set("payung_kuning","payung_kuning + $payungKuningPengambilanSelisih",FALSE);
          $this->db->set("id_user",$param["THP"]["id_user"]);
          $this->db->where("kd_gd_roll",$arrDataLama[0]["kd_gd_roll"]);
          $this->db->update("gudang_roll");

          $this->db->set("berat",$beratPengambilanBaru);
          $this->db->set("bobin",$bobinPengambilanBaru);
          $this->db->set("payung",$payungPengambilanBaru);
          $this->db->set("payung_kuning",$payungKuningPengambilanBaru);
          $this->db->set("id_user",$param["THP"]["id_user"]);
          $this->db->where("id",$arrDataTransaksiGudangRoll[0]["id"]);
          $this->db->update("transaksi_gudang_roll");
        }else{
          $beratPengambilanBaru = $param["TPHP"]["berat_pengambilan_gudang"];
          $bobinPengambilanBaru = $param["TPHP"]["bobin_pengambilan_gudang"];
          $payungPengambilanBaru = $param["TPHP"]["payung_pengambilan_gudang"];
          $payungKuningPengambilanBaru = $param["TPHP"]["payung_kuning_pengambilan_gudang"];

          $this->db->set("berat",$beratPengambilanBaru);
          $this->db->set("bobin",$bobinPengambilanBaru);
          $this->db->set("payung",$payungPengambilanBaru);
          $this->db->set("payung_kuning",$payungKuningPengambilanBaru);
          $this->db->set("id_user",$param["THP"]["id_user"]);
          $this->db->where("id",$arrDataTransaksiGudangRoll[0]["id"]);
          $this->db->update("transaksi_gudang_roll");
        }
      }

      if(!empty($arrDataLama[0]["kd_gd_roll_tumpuk"])){
        $QCheckTransaksiGudangRollTumpuk = "SELECT id, status_transaksi FROM transaksi_gudang_roll
                                            WHERE keterangan_history = 'OPERATOR POTONG'
                                            AND bagian='POTONG'
                                            AND status_history='KELUAR'
                                            AND keterangan_transaksi = 'KELUAR KE POTONG'
                                            AND kd_gd_roll = '".$arrDataLama[0]["kd_gd_roll_tumpuk"]."'
                                            AND tgl_transaksi = '".$arrDataLama[0]["tgl_rencana"]."'
                                            AND berat = '".$arrDataLama[0]["berat_pengambilan_gudang_tumpuk"]."'
                                            AND bobin = '".$arrDataLama[0]["bobin_pengambilan_gudang_tumpuk"]."'
                                            AND payung = '".$arrDataLama[0]["payung_pengambilan_gudang_tumpuk"]."'
                                            AND payung_kuning = '".$arrDataLama[0]["payung_kuning_pengambilan_gudang_tumpuk"]."'
                                            AND deleted='FALSE'";
        $arrDataTransaksiGudangRollTumpuk = $this->db->query($QCheckTransaksiGudangRollTumpuk)->result_array();
        if(count($arrDataTransaksiGudangRollTumpuk) > 0){
          if($arrDataTransaksiGudangRollTumpuk[0]["status_transaksi"] == "FINISH"){
            $beratPengambilanLamaTumpuk = floatval($arrDataLama[0]["berat_pengambilan_gudang_tumpuk"]);
            $bobinPengambilanLamaTumpuk = floatval($arrDataLama[0]["bobin_pengambilan_gudang_tumpuk"]);
            $payungPengambilanLamaTumpuk = floatval($arrDataLama[0]["payung_pengambilan_gudang_tumpuk"]);
            $payungKuningPengambilanLamaTumpuk = floatval($arrDataLama[0]["payung_kuning_pengambilan_gudang_tumpuk"]);

            $beratPengambilanBaruTumpuk = floatval($param["TPHP"]["berat_pengambilan_gudang_tumpuk"]);
            $bobinPengambilanBaruTumpuk = floatval($param["TPHP"]["bobin_pengambilan_gudang_tumpuk"]);
            $payungPengambilanBaruTumpuk = floatval($param["TPHP"]["payung_pengambilan_gudang_tumpuk"]);
            $payungKuningPengambilanBaruTumpuk = floatval($param["TPHP"]["payung_kuning_pengambilan_gudang_tumpuk"]);

            $beratPengambilanSelisihTumpuk = $beratPengambilanLamaTumpuk - $beratPengambilanBaruTumpuk;
            $bobinPengambilanSelisihTumpuk = $bobinPengambilanLamaTumpuk - $bobinPengambilanBaruTumpuk;
            $payungPengambilanSelisihTumpuk = $payungPengambilanLamaTumpuk - $payungPengambilanBaruTumpuk;
            $payungKuningPengambilanSelisihTumpuk = $payungKuningPengambilanLamaTumpuk - $payungKuningPengambilanBaruTumpuk;

            $this->db->set("stok","stok + $beratPengambilanSelisihTumpuk",FALSE);
            $this->db->set("bobin","bobin + $bobinPengambilanSelisihTumpuk",FALSE);
            $this->db->set("payung","payung + $payungPengambilanSelisihTumpuk",FALSE);
            $this->db->set("payung_kuning","payung_kuning + $payungKuningPengambilanSelisihTumpuk",FALSE);
            $this->db->set("id_user",$param["THP"]["id_user"]);
            $this->db->where("kd_gd_roll",$arrDataLama[0]["kd_gd_roll_tumpuk"]);
            $this->db->update("gudang_roll");

            $this->db->set("berat","$beratPengambilanBaruTumpuk");
            $this->db->set("bobin","$bobinPengambilanBaruTumpuk");
            $this->db->set("payung","$payungPengambilanBaruTumpuk");
            $this->db->set("payung_kuning","$payungKuningPengambilanBaruTumpuk");
            $this->db->set("id_user",$param["THP"]["id_user"]);
            $this->db->where("id",$arrDataTransaksiGudangRollTumpuk[0]["id"]);
            $this->db->update("transaksi_gudang_roll");
          }else{
            $beratPengambilanBaruTumpuk = $param["TPHP"]["berat_pengambilan_gudang_tumpuk"];
            $bobinPengambilanBaruTumpuk = $param["TPHP"]["bobin_pengambilan_gudang_tumpuk"];
            $payungPengambilanBaruTumpuk = $param["TPHP"]["payung_pengambilan_gudang_tumpuk"];
            $payungKuningPengambilanBaruTumpuk = $param["TPHP"]["payung_kuning_pengambilan_gudang_tumpuk"];

            $this->db->set("berat","$beratPengambilanBaruTumpuk");
            $this->db->set("bobin","$bobinPengambilanBaruTumpuk");
            $this->db->set("payung","$payungPengambilanBaruTumpuk");
            $this->db->set("payung_kuning","$payungKuningPengambilanBaruTumpuk");
            $this->db->set("id_user",$param["THP"]["id_user"]);
            $this->db->where("id",$arrDataTransaksiGudangRoll[0]["id"]);
            $this->db->update("transaksi_gudang_roll");
          }
        }
      }
      #============================== Proses Update Transaksi Gudang Roll Dan Stok Roll ==============================#

      #============================== Proses Update Transaksi Gudang Hasil Dan Stok Hasil ==============================#
      $QCheckTransaksiGudangHasil = "SELECT id_permintaan_jadi, status_transaksi FROM transaksi_gudang_hasil
                                     WHERE bagian = 'POTONG'
                                     AND status_history = 'MASUK'
                                     AND keterangan_history = 'MASUK DARI POTONG'
                                     AND kd_gd_hasil = '".$arrDataLama[0]["kd_gd_hasil"]."'
                                     AND tgl_transaksi = '".$arrDataLama[0]["tgl_rencana"]."'
                                     AND jumlah_berat = '".$arrDataLama[0]["jumlah_berat"]."'
                                     AND jumlah_lembar = '".$arrDataLama[0]["jumlah_lembar"]."'
                                     AND deleted = 'FALSE'";
      $arrDataTransaksiGudangHasil = $this->db->query($QCheckTransaksiGudangHasil)->result_array();
      if(count($arrDataTransaksiGudangHasil) > 0){
        if($arrDataTransaksiGudangHasil[0]["status_transaksi"] == "FINISH"){
          $jumlahBeratLama = floatval($arrDataLama[0]["jumlah_berat"]);
          $jumlahLembarLama = floatval($arrDataLama[0]["jumlah_lembar"]);

          $jumlahBeratBaru = floatval($param["TSHP"]["jumlah_berat"]);
          $jumlahLembarBaru = floatval($param["TSHP"]["jumlah_lembar"]);

          $jumlahBeratSelisih = $jumlahBeratLama - $jumlahBeratBaru;
          $jumlahLembarSelisih = $jumlahLembarLama - $jumlahLembarBaru;

          $this->db->set("stok_berat","stok_berat + $jumlahBeratSelisih", FALSE);
          $this->db->set("stok_lembar","stok_lembar + $jumlahLembarSelisih", FALSE);
          $this->db->where("kd_gd_hasil",$arrDataLama[0]["kd_gd_hasil"]);
          $this->db->update("gudang_hasil");

          $this->db->set("jumlah_berat",$jumlahBeratBaru);
          $this->db->set("jumlah_lembar",$jumlahLembarBaru);
          $this->db->where("id_permintaan_jadi",$arrDataTransaksiGudangHasil[0]["id_permintaan_jadi"]);
          $this->db->update("transaksi_gudang_hasil");
        }else{
          $jumlahBeratBaru = floatval($param["TSHP"]["jumlah_berat"]);
          $jumlahLembarBaru = floatval($param["TSHP"]["jumlah_lembar"]);

          $this->db->set("jumlah_berat",$jumlahBeratBaru);
          $this->db->set("jumlah_lembar",$jumlahLembarBaru);
          $this->db->where("id_permintaan_jadi",$arrDataTransaksiGudangHasil[0]["id_permintaan_jadi"]);
          $this->db->update("transaksi_gudang_hasil");
        }
      }

      $this->db->where("kd_hasil_potong",$param["THP"]["kd_hasil_potong"]);
      $this->db->update("transaksi_hasil_potong",$param["THP"]);

      $this->db->where("kd_hasil_potong",$param["THP"]["kd_hasil_potong"]);
      $this->db->update("transaksi_pengambilan_hasil_potong",$param["TPHP"]);
      #============================== Proses Update Transaksi Gudang Hasil Dan Stok Hasil ==============================#
      if(array_key_exists("kd_potong", $param["TSHP"])){
        $QCheckRencanaPotongBaru = "SELECT RC.*, GH.jns_brg FROM rencana_potong RC
                                    INNER JOIN gudang_hasil GH ON RC.kd_gd_hasil = GH.kd_gd_hasil
                                    WHERE RC.kd_potong='".$param["TSHP"]["kd_potong"]."' AND RC.deleted='FALSE' AND GH.deleted='FALSE'";
        $arrDataRencanaBaru = $this->db->query($QCheckRencanaPotongBaru)->result_array();

        $jumlahBeratLama = floatval($arrDataLama[0]["jumlah_berat"]);
        $jumlahLembarLama = floatval($arrDataLama[0]["jumlah_lembar"]);

        $jumlahBeratBaru = floatval($param["TSHP"]["jumlah_berat"]);
        $jumlahLembarBaru = floatval($param["TSHP"]["jumlah_lembar"]);

        $this->db->set("kd_gd_hasil",$arrDataRencanaBaru[0]["kd_gd_hasil"]);
        $this->db->set("ukuran", $arrDataRencanaBaru[0]["ukuran"]);
        $this->db->set("customer",$arrDataRencanaBaru[0]["customer"]);
        $this->db->set("merek",$arrDataRencanaBaru[0]["merek"]);
        $this->db->set("jns_permintaan",$arrDataRencanaBaru[0]["jns_permintaan"]);
        $this->db->set("sts_barang",$arrDataRencanaBaru[0]["jns_brg"]);
        $this->db->where("id_permintaan_jadi",$arrDataTransaksiGudangHasil[0]["id_permintaan_jadi"]);
        $this->db->update("transaksi_gudang_hasil");

        $this->db->set("stok_berat","stok_berat - $jumlahBeratLama",FALSE);
        $this->db->set("stok_lembar","stok_lembar - $jumlahLembarLama",FALSE);
        $this->db->where("kd_gd_hasil",$arrDataLama[0]["kd_gd_hasil"]);
        $this->db->update("gudang_hasil");

        $this->db->set("stok_berat","stok_berat + $jumlahBeratBaru",FALSE);
        $this->db->set("stok_lembar","stok_lembar + $jumlahLembarBaru",FALSE);
        $this->db->where("kd_gd_hasil",$arrDataRencanaBaru[0]["kd_gd_hasil"]);
        $this->db->update("gudang_hasil");

        $this->db->set("jumlah_lembar",$jumlahLembarBaru);
        $this->db->set("jumlah_berat",$jumlahBeratBaru);
        $this->db->set("kd_potong",$param["TSHP"]["kd_potong"]);
        $this->db->set("kd_gd_hasil",$arrDataRencanaBaru[0]["kd_gd_hasil"]);
        $this->db->where("id_transaksi",$param["TSHP"]["id_transaksi"]);
        $this->db->update("transaksi_sub_hasil_potong");
      }else{
        $jumlahBeratBaru = floatval($param["TSHP"]["jumlah_berat"]);
        $jumlahLembarBaru = floatval($param["TSHP"]["jumlah_lembar"]);

        $this->db->set("jumlah_lembar",$jumlahLembarBaru);
        $this->db->set("jumlah_berat",$jumlahBeratBaru);
        $this->db->where("id_transaksi",$param["TSHP"]["id_transaksi"]);
        $this->db->update("transaksi_sub_hasil_potong");
      }

        $Q = "SELECT tgl_rencana, tgl_jadi, hasil_lembar, hasil_berat_bersih, hasil_berat_kotor,
                     jumlah_apal_global, jumlah_roll_pipa, plusminus, status_transaksi, status_bon
              FROM transaksi_hasil_potong
              WHERE kd_hasil_potong = '$kdHasilPotong'
              AND deleted = 'FALSE'";
        $Q2 = "SELECT kd_potong, kd_gd_hasil, kd_gd_roll, kd_gd_roll_tumpuk, jumlah_lembar,
                      ROUND(jumlah_berat,2) AS jumlah_berat
               FROM transaksi_sub_hasil_potong
               WHERE id_transaksi='$idTransaksi'
               AND deleted='FALSE'";
        $Q4 = "SELECT kd_potong, kd_ppic, kd_gd_hasil, kd_gd_roll, satuan FROM rencana_potong WHERE kd_potong='$kdPotongBaru'";

        $arrDataTHP = $this->db->query($Q)->result_array();
        $arrDataTSHP = $this->db->query($Q2)->result_array();
        $arrDataRencanaBaru = $this->db->query($Q4)->result_array();

        $kdPotongLama = $arrDataTSHP[0]["kd_potong"];
        $Q3 = "SELECT kd_ppic, satuan FROM rencana_potong WHERE kd_potong='$kdPotongLama' AND deleted='FALSE'";
        $arrKdPpic = $this->db->query($Q3)->result_array();

        $kdGdHasilLama = $arrDataTSHP[0]["kd_gd_hasil"];
        $jumlahSubBeratLama = $arrDataTSHP[0]["jumlah_berat"];
        $jumlahSubLembarLama = $arrDataTSHP[0]["jumlah_lembar"];
        $tglTransaksi = $arrDataTHP[0]["tgl_rencana"];

        $Q4 = "SELECT id_permintaan_jadi, status_transaksi FROM transaksi_gudang_hasil
               WHERE kd_gd_hasil = '$kdGdHasilLama'
               AND jumlah_berat = '".round($jumlahSubBeratLama,2)."'
               AND jumlah_lembar = '".round($jumlahSubLembarLama,2)."'
               AND bagian = 'POTONG'
               AND tgl_transaksi = '$tglTransaksi'
               AND status_history = 'MASUK'
               AND keterangan_history = 'MASUK DARI POTONG'
               AND deleted='FALSE'";
        $arrIdPermintaanJadi = $this->db->query($Q4)->result_array();
        $idPermintaanJadi = $arrIdPermintaanJadi[0]["id_permintaan_jadi"];
        $statusTransaksiGudangHasil = $arrIdPermintaanJadi[0]["status_transaksi"];
        //============ Update Rencana PPIC (Sisa Berat Rencana) ============//
        if($arrKdPpic[0]["satuan"] == "LEMBAR"){
          $kdPpic = $arrKdPpic[0]["kd_ppic"];
          $jumlahLembarBaru = $jumlahSubLembarLama - $param["TSHP"]["jumlah_lembar"];
          $this->db->query("UPDATE rencana_ppic SET sisa = sisa + $jumlahLembarBaru WHERE kd_ppic='$kdPpic'");
        }else if($arrKdPpic[0]["satuan"] == "KG"){
          $kdPpic = $arrKdPpic[0]["kd_ppic"];
          $jumlahBeratBaru = $jumlahSubBeratLama - $param["TSHP"]["jumlah_berat"];
          $this->db->query("UPDATE rencana_ppic SET sisa = sisa + $jumlahBeratBaru WHERE kd_ppic='$kdPpic'");
        }else{

        }
        //============ Update Rencana PPIC (Sisa Berat Rencana) ============//

        //============ Update Rencana Potong (Sisa Berat Rencana) ============//
        if($arrKdPpic[0]["satuan"] == "LEMBAR"){
          $jumlahLembarBaru = $jumlahSubLembarLama - $param["TSHP"]["jumlah_lembar"];
          $this->db->query("UPDATE rencana_potong SET jml_permintaan = jml_permintaan + $jumlahLembarBaru WHERE kd_potong='$kdPotong'");
        }else if($arrKdPpic[0]["satuan"] == "KG"){
          $jumlahBeratBaru = $jumlahSubBeratLama - $param["TSHP"]["jumlah_berat"];
          $this->db->query("UPDATE rencana_potong SET jml_permintaan = jml_permintaan + $jumlahBeratBaru WHERE kd_potong='$kdPotong'");
        }else{

        }
        //============ Update Rencana Potong (Sisa Berat Rencana) ============//

        //============ Update Transaksi Gudang Hasil (History) ============//
        if(!empty($idPermintaanJadi)){
          $jumlahLembarBaru = $param["TSHP"]["jumlah_lembar"];
          $jumlahBeratBaru = $param["TSHP"]["jumlah_berat"];
          $this->db->query("UPDATE transaksi_gudang_hasil SET jumlah_berat = '$jumlahBeratBaru',
                                   jumlah_lembar = '$jumlahLembarBaru'
                            WHERE id_permintaan_jadi = '$idPermintaanJadi'");
        }
        //============ Update Transaksi Gudang Hasil (History) ============//

        //============ Update Stok Gudang Hasil (Berat Dan Lembar Stok Master) ============//
        if($statusTransaksiGudangHasil == "FINISH"){
          if(array_key_exists("kd_potong", $param["TSHP"])){
            //======= Update Stok Barang Baru (Jika Ada Perubahan Kode Barang Hasil) =======//
            $this->db->set("stok_lembar","stok_lembar + ".$param["TSHP"]["jumlah_lembar"],FALSE);
            $this->db->set("stok_berat","stok_berat + ".$param["TSHP"]["jumlah_berat"],FALSE);
            $this->db->where("kd_gd_hasil",$arrDataRencanaBaru[0]["kd_gd_hasil"]);
            $this->db->where("deleted","FALSE");
            $this->db->update("gudang_hasil");
            //======= Update Stok Barang Baru (Jika Ada Perubahan Kode Barang Hasil) =======//

            //======= Update Stok Barang Lama (Jika Ada Perubahan Kode Barang Hasil) =======//
            $this->db->set("stok_lembar","stok_lembar - ".$jumlahSubLembarLama,FALSE);
            $this->db->set("stok_berat","stok_berat - ".$jumlahSubBeratLama,FALSE);
            $this->db->where("kd_gd_hasil",$kdGdHasilLama);
            $this->db->where("deleted","FALSE");
            $this->db->update("gudang_hasil");
            //======= Update Stok Barang Lama (Jika Ada Perubahan Kode Barang Hasil) =======//

            //======= Update Rencana Potong (Jika Ada Perubahan Kode Barang Hasil) =======//
            $this->db->set("jml_permintaan", "jml_permintaan - ".$param["TSHP"]["jumlah_lembar"]);
            $this->db->where("kd_potong", $kdPotong);
            $this->db->update("rencana_potong");
            //======= Update Rencana Potong (Jika Ada Perubahan Kode Barang Hasil) =======//

            //======= Update Rencana PPIC (Jika Ada Perubahan Kode Barang Hasil) =======//
            $kdPpic = $arrKdPpic[0]["kd_ppic"];
            $this->db->set("kd_gd_hasil", $param["TSHP"]["kd_gd_hasil"]);
            $this->db->where("kd_ppic",$kdPpic);
            $this->db->update("rencana_ppic");
            //======= Update Rencana PPIC (Jika Ada Perubahan Kode Barang Hasil) =======//
          }else{
            //======= Update Stok Barang Lama (Jika Tidak Ada Perubahan Kode Barang Hasil) =======//
            $this->db->set("stok_lembar","stok_lembar - ".($jumlahSubLembarLama - $param["TSHP"]["jumlah_lembar"]),FALSE);
            $this->db->set("stok_berat","stok_berat - ".($jumlahSubBeratLama - $param["TSHP"]["jumlah_berat"]),FALSE);
            $this->db->where("kd_gd_hasil",$kdGdHasilLama);
            $this->db->where("deleted","FALSE");
            $this->db->update("gudang_hasil");
            //======= Update Stok Barang Lama (Jika Tidak Ada Perubahan Kode Barang Hasil) =======//
          }
        }
        //============ Update Stok Gudang Hasil (Berat Dan Lembar Stok Master) ============//

        //============ Update Transaksi Hasil Potong ============//
        $this->db->where("kd_hasil_potong",$param["THP"]["kd_hasil_potong"]);
        $this->db->update("transaksi_hasil_potong", $param["THP"]);
        //============ Update Transaksi Hasil Potong ============//

        //============ Update Transaksi Sub Hasil Potong ============//
        $this->db->where("id_transaksi",$param["TSHP"]["id_transaksi"]);
        $this->db->update("transaksi_sub_hasil_potong",$param["TSHP"]);
        //============ Update Transaksi Sub Hasil Potong ============//
        if($this->db->trans_status() === FALSE){
          $this->db->trans_rollback();
          return "Gagal";
        }else{
          $this->db->trans_commit();
          return "Berhasil";
        }
      }
    }

    public function updatePengambilanPotong($param){
      $this->db->trans_begin();
      $periodeLock = date("Y-m", strtotime($param["tgl_potong"]));
      $QCheckLock = "SELECT COUNT(id) AS counter FROM transaksi_gudang_roll
                     WHERE DATE_FORMAT(tgl_transaksi,'%Y-%m') = '$periodeLock'
                     AND deleted = 'FALSE'
                     AND status_lock='TRUE'";
      $arrCheckLock = $this->db->query($QCheckLock)->result_array();
      if($arrCheckLock[0]["counter"] > 0){
        $this->db->trans_rollback();
        return "Lock";
      }else{
        $Q = "SELECT TDPP.id,
                     TDPP.berat,
                     TDPP.bobin,
                     TDPP.payung,
                     TDPP.payung_kuning,
                     TDPP.kd_gd_roll,
                     TDPP.status,
                     TDPP.kd_potong,
                     TDPP.tgl_potong,
                     TDPP.panjang,

                     THP.kd_hasil_potong,
                     THP.jumlah_roll_pipa,
                     THP.plusminus,
                     THP.jumlah_bobin,
                     THP.jumlah_payung,
                     THP.jumlah_payung_kuning,
                     THP.jumlah_apal_global,
                     THP.hasil_berat_bersih,
                     THP.jenis_roll_pipa,

                     TSHP.id_transaksi,
                     TSHP.kd_gd_roll AS kdGdRoll,
                     TSHP.kd_gd_roll_tumpuk AS kdGdRollTumpuk,
                     TPHP.id_transaksi AS idTPHP,

                     TPHP.berat_pengambilan_bagian,
                     TPHP.bobin_pengambilan_bagian,
                     TPHP.payung_pengambilan_bagian,
                     TPHP.payung_kuning_pengambilan_bagian,
                     TPHP.berat_pengambilan_bagian_tumpuk,
                     TPHP.bobin_pengambilan_bagian_tumpuk,
                     TPHP.payung_pengambilan_bagian_tumpuk,
                     TPHP.payung_kuning_pengambilan_bagian_tumpuk,

                     TPHP.berat_pengambilan_gudang,
                     TPHP.bobin_pengambilan_gudang,
                     TPHP.payung_pengambilan_gudang,
                     TPHP.payung_kuning_pengambilan_gudang,
                     TPHP.berat_pengambilan_gudang_tumpuk,
                     TPHP.bobin_pengambilan_gudang_tumpuk,
                     TPHP.payung_pengambilan_gudang_tumpuk,
                     TPHP.payung_kuning_pengambilan_gudang_tumpuk,

                     TPHP.berat_sisa_semalam,
                     TPHP.bobin_sisa_semalam,
                     TPHP.payung_sisa_semalam,
                     TPHP.payung_kuning_sisa_semalam,
                     TPHP.berat_sisa_semalam_tumpuk,
                     TPHP.bobin_sisa_semalam_tumpuk,
                     TPHP.payung_sisa_semalam_tumpuk,
                     TPHP.payung_kuning_sisa_semalam_tumpuk,

                     TPHP.berat_sisa_hari_ini,
                     TPHP.bobin_sisa_hari_ini,
                     TPHP.payung_sisa_hari_ini,
                     TPHP.payung_kuning_sisa_hari_ini,
                     TPHP.berat_sisa_hari_ini_tumpuk,
                     TPHP.bobin_sisa_hari_ini_tumpuk,
                     TPHP.payung_sisa_hari_ini_tumpuk,
                     TPHP.payung_kuning_sisa_hari_ini_tumpuk,

                     RC.ket_barang,
                     RC.ket_merek,
                     RC.ukuran
              FROM transaksi_detail_pengambilan_potong TDPP
              INNER JOIN rencana_potong RC ON TDPP.kd_potong = RC.kd_potong
              LEFT JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_potong = RC.kd_potong
              LEFT JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
              LEFT JOIN transaksi_pengambilan_hasil_potong TPHP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
              WHERE TDPP.id = '$param[id]'";
        $arrData = $this->db->query($Q)->result_array();
        $counterArrData = count($arrData);
        $bagian = $param["bagian"];
        $arrParameter = array("kdGdRoll" => $arrData[0]["kd_gd_roll"],
                              "kdPotong" => $arrData[0]["kd_potong"],
                              "status" => "MANDOR POTONG ($bagian)",
                              "deleted" => "FALSE",
                              "stsTransaksi" => "FINISH");
        $Q2 = "SELECT SUM(berat) AS totalBerat, SUM(bobin) AS totalBobin, SUM(payung) AS totalPayung,
                      SUM(payung_kuning) AS totalPayungKuning
               FROM transaksi_detail_pengambilan_potong
               WHERE kd_gd_roll = '$arrParameter[kdGdRoll]'
               AND kd_potong = '$arrParameter[kdPotong]'
               AND status = '$arrParameter[status]'
               AND deleted = '$arrParameter[deleted]'";
        $arrJumlahTDPP = $this->db->query($Q2)->result_array();

        $beratLama = $arrData[0]["berat"];
        $bobinLama = $arrData[0]["bobin"];
        $payungLama = $arrData[0]["payung"];
        $payungKuningLama = $arrData[0]["payung_kuning"];
        $kdGdRollLama = $arrData[0]["kd_gd_roll"];
        $status = $arrData[0]["status"];
        $tglTransaksi = $arrData[0]["tgl_potong"];
        $kdGdRollTSHP = $arrData[0]["kdGdRoll"];
        $kdGdRollTumpukTSHP = $arrData[0]["kdGdRollTumpuk"];

        $beratPengambilanTumpukLama = round($arrData[0]["berat_pengambilan_bagian_tumpuk"],2);
        $bobinPengambilanTumpukLama = $arrData[0]["bobin_pengambilan_bagian_tumpuk"];
        $payungPengambilanTumpukLama = $arrData[0]["payung_pengambilan_bagian_tumpuk"];
        $payungKuningPengambilanTumpukLama = $arrData[0]["payung_kuning_pengambilan_bagian_tumpuk"];
        // $kdGdRollTumpukLama = $arrData[0]["kd_gd_roll"];

        $beratPengambilanLama = round($arrData[0]["berat_pengambilan_bagian"],2);
        $bobinPengambilanLama = $arrData[0]["bobin_pengambilan_bagian"];
        $payungPengambilanLama = $arrData[0]["payung_pengambilan_bagian"];
        $payungKuningPengambilanLama = $arrData[0]["payung_kuning_pengambilan_bagian"];

        $beratSumTDPP = $arrJumlahTDPP[0]["totalBerat"];
        $bobinSumTDPP = $arrJumlahTDPP[0]["totalBobin"];
        $payungSumTDPP = $arrJumlahTDPP[0]["totalPayung"];
        $payungKuningSumTDPP = $arrJumlahTDPP[0]["totalPayungKuning"];
        // $kdGdRollTumpukLama = $arrData[0]["kd_gd_roll"];

        $QCheckTGR = "SELECT id, status_transaksi FROM transaksi_gudang_roll
                      WHERE kd_gd_roll='$kdGdRollLama'
                      AND bagian='POTONG'
                      AND keterangan_transaksi = 'KELUAR KE POTONG'
                      AND status_history = 'KELUAR'
                      AND keterangan_history = 'MANDOR POTONG ($bagian)'
                      AND berat = '$beratLama'
                      AND bobin = '$bobinLama'
                      AND payung = '$payungLama'
                      AND payung_kuning = '$payungKuningLama'
                      AND tgl_transaksi = '$tglTransaksi'
                      AND deleted = 'FALSE'";
        $arrCheckTGR = $this->db->query($QCheckTGR)->result_array();

        //============ Update Transaksi Detail Pengambilan Potong ============//
        $this->db->where("id", $param["id"]);
        $this->db->update("transaksi_detail_pengambilan_potong", array_diff_key($param,array_flip(array("bagian","doubleSingle"))));
        //============ Update Transaksi Detail Pengambilan Potong ============//
        //============ Update Transaksi Gudang Roll ============//
        // $this->db->set("kd_gd_roll",$param["kd_gd_roll"]);
        $this->db->set("tgl_transaksi", $param["tgl_potong"]);
        $this->db->set("berat", $param["berat"]);
        $this->db->set("bobin", $param["bobin"]);
        $this->db->set("payung", $param["payung"]);
        $this->db->set("payung_kuning", $param["payung_kuning"]);

        $this->db->where("id",$arrCheckTGR[0]["id"]);
        $this->db->update("transaksi_gudang_roll");

        if($arrCheckTGR[0]["status_transaksi"] == "FINISH"){
          //======= Update Stok Gudang Roll (Barang Lama) =======//
          $this->db->set("stok","stok + ".($beratLama - $param["berat"]), FALSE);
          $this->db->set("bobin","bobin + ".($bobinLama - $param["bobin"]), FALSE);
          $this->db->set("payung","payung + ".($payungLama - $param["payung"]), FALSE);
          $this->db->set("payung_kuning","payung_kuning + ".($payungKuningLama - $param["payung_kuning"]), FALSE);

          $this->db->where("kd_gd_roll",$kdGdRollLama);
          $this->db->update("gudang_roll");
          //======= Update Stok Gudang Roll (Barang Lama) =======//

          //======= Update Stok Gudang Roll (Barang Baru) =======//
          // $this->db->set("stok","stok - ".$param["berat"], FALSE);
          // $this->db->set("bobin","bobin - ".$param["bobin"], FALSE);
          // $this->db->set("payung","payung - ".$param["payung"], FALSE);
          // $this->db->set("payung_kuning - ".$param["payung_kuning"], FALSE);
          //
          // $this->db->where("kd_gd_roll",$param["kd_gd_roll"]);
          // $this->db->update("gudang_roll");
          //======= Update Stok Gudang Roll (Barang Baru) =======//
        }
          //============ Update Transaksi Gudang Roll ============//

        if($counterArrData > 0){
          if($kdGdRollLama == $kdGdRollTSHP){
            $beratSelisih = round($param["berat"],2) - $beratLama;
            $bobinSelisih = $param["bobin"] - $bobinLama;
            $payungSelisih = $param["payung"] - $payungLama;
            $payungKuningSelisih = $param["payung_kuning"] - $payungKuningLama;

            $beratPengambilanBagianBaru = round($param["berat"],2);
            $bobinPengambilanBagianBaru = $param["bobin"];
            $payungPengambilanBagianBaru = $param["payung"];
            $payungKuningPengambilanBagianBaru = $param["payung_kuning"];
            $totalRollPengambilanBagianBaru = $bobinPengambilanBagianBaru + $payungPengambilanBagianBaru + $payungKuningPengambilanBagianBaru;

            $beratPengambilanBagianTumpukLama = $arrData[0]["berat_pengambilan_bagian_tumpuk"];
            $bobinPengambilanBagianTumpukLama = $arrData[0]["bobin_pengambilan_bagian_tumpuk"];
            $payungPengambilanBagianTumpukLama = $arrData[0]["payung_pengambilan_bagian_tumpuk"];
            $payungKuningPengambilanBagianTumpukLama = $arrData[0]["payung_kuning_pengambilan_bagian_tumpuk"];
            $totalRollPengambilanBagianTumpukLama = $bobinPengambilanBagianTumpukLama + $payungPengambilanBagianTumpukLama + $payungKuningPengambilanBagianTumpukLama;

            $beratPengambilanGudangLama = $arrData[0]["berat_pengambilan_gudang"];
            $bobinPengambilanGudangLama = $arrData[0]["bobin_pengambilan_gudang"];
            $payungPengambilanGudangLama = $arrData[0]["payung_pengambilan_gudang"];
            $payungKuningPengambilanGudangLama = $arrData[0]["payung_kuning_pengambilan_gudang"];
            $totalRollPengambilanGudangLama = $bobinPengambilanGudangLama + $payungPengambilanGudangLama + $payungKuningPengambilanGudangLama;

            $beratPengambilanGudangTumpukLama = $arrData[0]["berat_pengambilan_gudang_tumpuk"];
            $bobinPengambilanGudangTumpukLama = $arrData[0]["bobin_pengambilan_gudang_tumpuk"];
            $payungPengambilanGudangTumpukLama = $arrData[0]["payung_pengambilan_gudang_tumpuk"];
            $payungKuningPengambilanGudangTumpukLama = $arrData[0]["payung_kuning_pengambilan_gudang_tumpuk"];
            $totalRollPengambilanGudangTumpukLama = $bobinPengambilanGudangTumpukLama + $payungPengambilanGudangTumpukLama + $payungKuningPengambilanGudangTumpukLama;

            $beratSisaSemalamLama = $arrData[0]["berat_sisa_semalam"];
            $bobinSisaSemalamLama = $arrData[0]["bobin_sisa_semalam"];
            $payungSisaSemalamLama = $arrData[0]["payung_sisa_semalam"];
            $payungKuningSisaSemalamLama = $arrData[0]["payung_kuning_sisa_semalam"];
            $totalRollSisaSemalamLama = $bobinSisaSemalamLama + $payungSisaSemalamLama + $payungKuningSisaSemalamLama;

            $beratSisaSemalamTumpukLama = $arrData[0]["berat_sisa_semalam_tumpuk"];
            $bobinSisaSemalamTumpukLama = $arrData[0]["bobin_sisa_semalam_tumpuk"];
            $payungSisaSemalamTumpukLama = $arrData[0]["payung_sisa_semalam_tumpuk"];
            $payungKuningSisaSemalamTumpukLama = $arrData[0]["payung_kuning_sisa_semalam_tumpuk"];
            $totalRollSisaSemalamTumpukLama = $bobinSisaSemalamTumpukLama + $payungSisaSemalamTumpukLama + $payungKuningSisaSemalamTumpukLama;

            $beratSisaHariIniLama = $arrData[0]["berat_sisa_hari_ini"];
            $bobinSisaHariIniLama = $arrData[0]["bobin_sisa_hari_ini"];
            $payungSisaHariIniLama = $arrData[0]["payung_sisa_hari_ini"];
            $payungKuningSisaHariIniLama = $arrData[0]["payung_kuning_sisa_hari_ini"];
            $totalRollSisaHariIniLama = $bobinSisaHariIniLama + $payungSisaHariIniLama + $payungKuningSisaHariIniLama;

            $beratSisaHariIniTumpukLama = $arrData[0]["berat_sisa_hari_ini_tumpuk"];
            $bobinSisaHariIniTumpukLama = $arrData[0]["bobin_sisa_hari_ini_tumpuk"];
            $payungSisaHariIniTumpukLama = $arrData[0]["payung_sisa_hari_ini_tumpuk"];
            $payungKuningSisaHariIniTumpukLama = $arrData[0]["payung_kuning_sisa_hari_ini_tumpuk"];
            $totalRollSisaHariIniTumpukLama = $bobinSisaHariIniTumpukLama + $payungSisaHariIniTumpukLama + $payungKuningSisaHariIniTumpukLama;

            $ukuranPlastik = $arrData[0]["ukuran"];
            $panjangPlastik = $arrData[0]["panjang"];
            $ketBarang = $arrData[0]["ket_barang"];
            $ketMerek = $arrData[0]["ket_merek"];

            $jenisRoll = $arrData[0]["jenis_roll_pipa"];

            $arrDataForPanjangPlastik = array("jenisPipa"   => $jenisRoll,
                                              "ukuran"      => $ukuranPlastik,
                                              "panjang"     => $panjangPlastik,
                                              "ketMerek"    => $ketMerek,
                                              "ketBarang"   => $ketBarang);

            $hasilPanjangPlastik = CustomClass::hitungPanjangPlastik($arrDataForPanjangPlastik);

            $arrDataForBeratRoll = array("jenisPipa"            => $jenisRoll,
                                         "doubleSingle"         => $param["doubleSingle"],
                                         "panjangPlastik"       => $hasilPanjangPlastik,
                                         "jumlahPayung"         => ((($payungPengambilanBagianBaru +
                                                                   $payungPengambilanBagianTumpukLama) +
                                                                   (($payungPengambilanGudangLama - $payungSelisih) +
                                                                   $payungPengambilanGudangTumpukLama) +
                                                                   ($payungSisaSemalamLama +
                                                                   $payungSisaSemalamTumpukLama)) -
                                                                   ($payungSisaHariIniLama +
                                                                   $payungSisaHariIniTumpukLama)
                                                                  ),
                                         "jumlahPayungKuning"   => ((($payungKuningPengambilanBagianBaru +
                                                                   $payungKuningPengambilanBagianTumpukLama) +
                                                                   (($payungKuningPengambilanGudangLama - $payungKuningSelisih) +
                                                                   $payungKuningPengambilanGudangTumpukLama) +
                                                                   ($payungKuningSisaSemalamLama +
                                                                   $payungKuningSisaSemalamTumpukLama)) -
                                                                   ($payungKuningSisaHariIniLama +
                                                                   $payungKuningSisaHariIniTumpukLama)
                                                                  ),
                                         "jumlahBobin"          => ((($bobinPengambilanBagianBaru +
                                                                   $bobinPengambilanBagianTumpukLama) +
                                                                   (($bobinPengambilanGudangLama - $bobinSelisih) +
                                                                   $bobinPengambilanGudangTumpukLama) +
                                                                   ($bobinSisaSemalamLama +
                                                                   $bobinSisaSemalamTumpukLama)) -
                                                                   ($bobinSisaHariIniLama +
                                                                   $bobinSisaHariIniTumpukLama)
                                                                  )
                                        );
            $hasilBeratRollBaru = CustomClass::hitungBeratRoll($arrDataForBeratRoll);

            $arrDataForPlusMinusBaru = array("beratPengambilan"         => (($beratPengambilanGudangLama - $beratSelisih) + $beratPengambilanGudangTumpukLama),
                                             "beratPengambilanBagian"   => ($beratPengambilanBagianBaru + $beratPengambilanBagianTumpukLama),
                                             "beratSisaSemalam"         => ($beratSisaSemalamLama + $beratSisaSemalamTumpukLama),
                                             "beratSisaHariIni"         => ($beratSisaHariIniLama + $beratSisaHariIniTumpukLama),
                                             "beratBersih"              => $arrData[0]["hasil_berat_bersih"],
                                             "beratApal"                => $arrData[0]["jumlah_apal_global"],
                                             "beratRollPipa"            => $hasilBeratRollBaru);

            $hasilPlusMinusbaru = CustomClass::hitungPlusMinus($arrDataForPlusMinusBaru);
            //============ Update Data Transaksi Gudang Roll Dengan Status OPERATOR POTONG ============//
            $this->db->set("berat", "berat - ".$beratSelisih, FALSE);
            $this->db->set("bobin", "bobin - ".$bobinSelisih, FALSE);
            $this->db->set("payung", "payung - ".$payungSelisih, FALSE);
            $this->db->set("payung_kuning", "payung_kuning - ".$payungKuningSelisih, FALSE);

            $this->db->where("kd_gd_roll",$kdGdRollLama);
            $this->db->where("keterangan_history","OPERATOR POTONG");
            $this->db->where("berat",$beratPengambilanGudangLama);
            $this->db->where("bobin",$bobinPengambilanGudangLama);
            $this->db->where("payung",$payungPengambilanGudangLama);
            $this->db->where("payung_kuning",$payungKuningPengambilanGudangLama);
            $this->db->where("tgl_transaksi",$tglTransaksi);
            $this->db->where("deleted","FALSE");
            $this->db->update("transaksi_gudang_roll");
            //============ Update Data Transaksi Gudang Roll Dengan Status OPERATOR POTONG ============//

            $this->db->set("berat_pengambilan_bagian","berat_pengambilan_bagian + ".$beratSelisih, FALSE);
            $this->db->set("bobin_pengambilan_bagian","bobin_pengambilan_bagian + ".$bobinSelisih, FALSE);
            $this->db->set("payung_pengambilan_bagian","payung_pengambilan_bagian + ".$payungSelisih, FALSE);
            $this->db->set("payung_kuning_pengambilan_bagian", "payung_kuning_pengambilan_bagian + ".$payungKuningSelisih, FALSE);

            $this->db->set("berat_pengambilan_gudang", "berat_pengambilan_gudang - ".$beratSelisih,FALSE);
            $this->db->set("bobin_pengambilan_gudang","bobin_pengambilan_gudang - ".$bobinSelisih, FALSE);
            $this->db->set("payung_pengambilan_gudang","payung_pengambilan_gudang - ".$payungSelisih, FALSE);
            $this->db->set("payung_kuning_pengambilan_gudang", "payung_kuning_pengambilan_gudang - ".$payungKuningSelisih, FALSE);

            $this->db->where("id_transaksi",$arrData[0]["idTPHP"]);
            $this->db->update("transaksi_pengambilan_hasil_potong");

            $this->db->set("jumlah_roll_pipa",$hasilBeratRollBaru);
            $this->db->set("plusminus",$hasilPlusMinusbaru);
            $this->db->set("jumlah_payung","jumlah_payung + ".$payungSelisih, FALSE);
            $this->db->set("jumlah_payung_kuning","jumlah_payung_kuning + ".$payungKuningSelisih, FALSE);
            $this->db->set("jumlah_bobin","jumlah_bobin + ".$bobinSelisih, FALSE);
            $this->db->where("kd_hasil_potong",$arrData[0]["kd_hasil_potong"]);
            $this->db->update("transaksi_hasil_potong");
          }else if($kdGdRollLama == $kdGdRollTumpukTSHP){
            $beratSelisih = round($param["berat"],2) - $beratLama;
            $bobinSelisih = $param["bobin"] - $bobinLama;
            $payungSelisih = $param["payung"] - $payungLama;
            $payungKuningSelisih = $param["payung_kuning"] - $payungKuningLama;

            $beratPengambilanBagianTumpukBaru = round($param["berat"],2);
            $bobinPengambilanBagianTumpukBaru = $param["bobin"];
            $payungPengambilanBagianTumpukBaru = $param["payung"];
            $payungKuningPengambilanBagianTumpukBaru = $param["payung_kuning"];
            $totalRollPengambilanBagianTumpukBaru = $bobinPengambilanBagianTumpukBaru + $payungPengambilanBagianTumpukBaru + $payungKuningPengambilanBagianTumpukBaru;

            $beratPengambilanBagianLama = $arrData[0]["berat_pengambilan_bagian"];
            $bobinPengambilanBagianLama = $arrData[0]["bobin_pengambilan_bagian"];
            $payungPengambilanBagianLama = $arrData[0]["payung_pengambilan_bagian"];
            $payungKuningPengambilanBagianLama = $arrData[0]["payung_kuning_pengambilan_bagian"];
            $totalRollPengambilanBagianLama = $bobinPengambilanBagianLama + $payungPengambilanBagianLama + $payungKuningPengambilanBagianLama;

            $beratPengambilanGudangLama = $arrData[0]["berat_pengambilan_gudang"];
            $bobinPengambilanGudangLama = $arrData[0]["bobin_pengambilan_gudang"];
            $payungPengambilanGudangLama = $arrData[0]["payung_pengambilan_gudang"];
            $payungKuningPengambilanGudangLama = $arrData[0]["payung_kuning_pengambilan_gudang"];
            $totalRollPengambilanGudangLama = $bobinPengambilanGudangLama + $payungPengambilanGudangLama + $payungKuningPengambilanGudangLama;

            $beratPengambilanGudangTumpukLama = $arrData[0]["berat_pengambilan_gudang_tumpuk"];
            $bobinPengambilanGudangTumpukLama = $arrData[0]["bobin_pengambilan_gudang_tumpuk"];
            $payungPengambilanGudangTumpukLama = $arrData[0]["payung_pengambilan_gudang_tumpuk"];
            $payungKuningPengambilanGudangTumpukLama = $arrData[0]["payung_kuning_pengambilan_gudang_tumpuk"];
            $totalRollPengambilanGudangTumpukLama = $bobinPengambilanGudangTumpukLama + $payungPengambilanGudangTumpukLama + $payungKuningPengambilanGudangTumpukLama;

            $beratSisaSemalamLama = $arrData[0]["berat_sisa_semalam"];
            $bobinSisaSemalamLama = $arrData[0]["bobin_sisa_semalam"];
            $payungSisaSemalamLama = $arrData[0]["payung_sisa_semalam"];
            $payungKuningSisaSemalamLama = $arrData[0]["payung_kuning_sisa_semalam"];
            $totalRollSisaSemalamLama = $bobinSisaSemalamLama + $payungSisaSemalamLama + $payungKuningSisaSemalamLama;

            $beratSisaSemalamTumpukLama = $arrData[0]["berat_sisa_semalam_tumpuk"];
            $bobinSisaSemalamTumpukLama = $arrData[0]["bobin_sisa_semalam_tumpuk"];
            $payungSisaSemalamTumpukLama = $arrData[0]["payung_sisa_semalam_tumpuk"];
            $payungKuningSisaSemalamTumpukLama = $arrData[0]["payung_kuning_sisa_semalam_tumpuk"];
            $totalRollSisaSemalamTumpukLama = $bobinSisaSemalamTumpukLama + $payungSisaSemalamTumpukLama + $payungKuningSisaSemalamTumpukLama;

            $beratSisaHariIniLama = $arrData[0]["berat_sisa_hari_ini"];
            $bobinSisaHariIniLama = $arrData[0]["bobin_sisa_hari_ini"];
            $payungSisaHariIniLama = $arrData[0]["payung_sisa_hari_ini"];
            $payungKuningSisaHariIniLama = $arrData[0]["payung_kuning_sisa_hari_ini"];
            $totalRollSisaHariIniLama = $bobinSisaHariIniLama + $payungSisaHariIniLama + $payungKuningSisaHariIniLama;

            $beratSisaHariIniTumpukLama = $arrData[0]["berat_sisa_hari_ini_tumpuk"];
            $bobinSisaHariIniTumpukLama = $arrData[0]["bobin_sisa_hari_ini_tumpuk"];
            $payungSisaHariIniTumpukLama = $arrData[0]["payung_sisa_hari_ini_tumpuk"];
            $payungKuningSisaHariIniTumpukLama = $arrData[0]["payung_kuning_sisa_hari_ini_tumpuk"];
            $totalRollSisaHariIniTumpukLama = $bobinSisaHariIniTumpukLama + $payungSisaHariIniTumpukLama + $payungKuningSisaHariIniTumpukLama;

            $ukuranPlastik = $arrData[0]["ukuran"];
            $panjangPlastik = $arrData[0]["panjang"];
            $ketBarang = $arrData[0]["ket_barang"];
            $ketMerek = $arrData[0]["ket_merek"];

            $jenisRoll = $arrData[0]["jenis_roll_pipa"];

            $arrDataForPanjangPlastik = array("jenisPipa"   => $jenisRoll,
                                              "ukuran"      => $ukuranPlastik,
                                              "panjang"     => $panjangPlastik,
                                              "ketMerek"    => $ketMerek,
                                              "ketBarang"   => $ketBarang);

            $hasilPanjangPlastik = CustomClass::hitungPanjangPlastik($arrDataForPanjangPlastik);

            $arrDataForBeratRoll = array("jenisPipa"            => $jenisRoll,
                                         "panjangPlastik"       => $hasilPanjangPlastik,
                                         "jumlahPayung"         => ((($payungPengambilanBagianTumpukBaru +
                                                                   $payungPengambilanBagianLama) +
                                                                   ($payungPengambilanGudangLama +
                                                                   ($payungPengambilanGudangTumpukLama - $payungSelisih)) +
                                                                   ($payungSisaSemalamLama +
                                                                   $payungSisaSemalamTumpukLama)) -
                                                                   ($payungSisaHariIniLama +
                                                                   $payungSisaHariIniTumpukLama)
                                                                  ),
                                         "jumlahPayungKuning"   => ((($payungKuningPengambilanBagianTumpukBaru +
                                                                   $payungKuningPengambilanBagianLama) +
                                                                   ($payungKuningPengambilanGudangLama +
                                                                   ($payungKuningPengambilanGudangTumpukLama - $payungKuningSelisih)) +
                                                                   ($payungKuningSisaSemalamLama +
                                                                   $payungKuningSisaSemalamTumpukLama)) -
                                                                   ($payungKuningSisaHariIniLama +
                                                                   $payungKuningSisaHariIniTumpukLama)
                                                                  ),
                                         "jumlahBobin"          => ((($bobinPengambilanBagianTumpukBaru +
                                                                   $bobinPengambilanBagianLama) +
                                                                   ($bobinPengambilanGudangLama +
                                                                   ($bobinPengambilanGudangTumpukLama - $bobinSelisih)) +
                                                                   ($bobinSisaSemalamLama +
                                                                   $bobinSisaSemalamTumpukLama)) -
                                                                   ($bobinSisaHariIniLama +
                                                                   $bobinSisaHariIniTumpukLama)
                                                                  )
                                        );
            $hasilBeratRollBaru = CustomClass::hitungBeratRoll($arrDataForBeratRoll);

            $arrDataForPlusMinusBaru = array("beratPengambilan"         => ($beratPengambilanGudangLama +
                                                                           ($beratPengambilanGudangTumpukLama - $beratSelisih)),
                                             "beratPengambilanBagian"   => ($beratPengambilanBagianTumpukBaru +
                                                                           $beratPengambilanBagianLama),
                                             "beratSisaSemalam"         => ($beratSisaSemalamLama +
                                                                           $beratSisaSemalamTumpukLama),
                                             "beratSisaHariIni"         => ($beratSisaHariIniLama +
                                                                           $beratSisaHariIniTumpukLama),
                                             "beratBersih"              => $arrData[0]["hasil_berat_bersih"],
                                             "beratApal"                => $arrData[0]["jumlah_apal_global"],
                                             "beratRollPipa"            => $hasilBeratRollBaru);

            $hasilPlusMinusbaru = CustomClass::hitungPlusMinus($arrDataForPlusMinusBaru);
            //============ Update Data Transaksi Gudang Roll Dengan Status OPERATOR POTONG ============//
            $this->db->set("berat", "berat - ".$beratSelisih, FALSE);
            $this->db->set("bobin", "bobin - ".$bobinSelisih, FALSE);
            $this->db->set("payung", "payung - ".$payungSelisih, FALSE);
            $this->db->set("payung_kuning", "payung_kuning - ".$payungKuningSelisih, FALSE);

            $this->db->where("kd_gd_roll",$kdGdRollLama);
            $this->db->where("keterangan_history","OPERATOR POTONG");
            $this->db->where("berat",$beratPengambilanGudangTumpukLama);
            $this->db->where("bobin",$bobinPengambilanGudangTumpukLama);
            $this->db->where("payung",$payungPengambilanGudangTumpukLama);
            $this->db->where("payung_kuning",$payungKuningPengambilanGudangTumpukLama);
            $this->db->where("tgl_transaksi",$tglTransaksi);
            $this->db->where("deleted","FALSE");
            $this->db->update("transaksi_gudang_roll");
            //============ Update Data Transaksi Gudang Roll Dengan Status OPERATOR POTONG ============//

            $this->db->set("berat_pengambilan_bagian_tumpuk","berat_pengambilan_bagian_tumpuk - ".$beratSelisih, FALSE);
            $this->db->set("bobin_pengambilan_bagian_tumpuk","bobin_pengambilan_bagian_tumpuk - ".$bobinSelisih, FALSE);
            $this->db->set("payung_pengambilan_bagian_tumpuk","payung_pengambilan_bagian_tumpuk - ".$payungSelisih, FALSE);
            $this->db->set("payung_kuning_pengambilan_bagian_tumpuk","payung_kuning_pengambilan_bagian_tumpuk - ".$payungKuningSelisih, FALSE);

            $this->db->set("berat_pengambilan_gudang", "berat_pengambilan_gudang_tumpuk - ".$beratSelisih,FALSE);
            $this->db->set("bobin_pengambilan_gudang","bobin_pengambilan_gudang_tumpuk - ".$bobinSelisih, FALSE);
            $this->db->set("payung_pengambilan_gudang","payung_pengambilan_gudang_tumpuk - ".$payungSelisih, FALSE);
            $this->db->set("payung_kuning_pengambilan_gudang", "payung_kuning_pengambilan_gudang_tumpuk - ".$payungKuningSelisih, FALSE);

            $this->db->where("id_transaksi",$arrData[0]["idTPHP"]);
            $this->db->update("transaksi_pengambilan_hasil_potong");

            $this->db->set("jumlah_roll_pipa",$hasilBeratRollBaru);
            $this->db->set("plusminus",$hasilPlusMinusbaru);
            $this->db->set("jumlah_payung","jumlah_payung + ".$payungSelisih, FALSE);
            $this->db->set("jumlah_payung_kuning","jumlah_payung_kuning + ".$payungKuningSelisih, FALSE);
            $this->db->set("jumlah_bobin","jumlah_bobin + ".$bobinSelisih, FALSE);
            $this->db->where("kd_hasil_potong",$arrData[0]["kd_hasil_potong"]);
            $this->db->update("transaksi_hasil_potong");
          }else{

          }
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

    public function updateHistorySisa($param){
      $this->db->trans_begin();
      $QCheckTGR = "SELECT * FROM transaksi_gudang_roll WHERE id='$param[id]'";
      $arrCheckTGR = $this->db->query($QCheckTGR)->result_array();
      $periodeLock = date("Y-m",strtotime($arrCheckTGR[0]["tgl_transaksi"]));
      $QCheckLockTGR = "SELECT COUNT(id) AS counter
                        FROM transaksi_gudang_roll
                        WHERE DATE_FORMAT(tgl_transaksi, '%Y-%m') = $periodeLock
                        AND status_lock = 'TRUE'";
      if($QCheckLockTGR[0]["counter"] > 0){
        $this->db->trans_rollback();
        return "LOCK";
      }else{
        $QTDPP = "SELECT TDPP.id,
                     TDPP.berat,
                     TDPP.bobin,
                     TDPP.payung,
                     TDPP.payung_kuning,
                     TDPP.kd_gd_roll,
                     TDPP.status,
                     TDPP.kd_potong,
                     TDPP.tgl_potong,
                     TDPP.tgl_sisa,
                     TDPP.panjang,
                     TDPP.status,

                     THP.kd_hasil_potong,
                     THP.jumlah_roll_pipa,
                     THP.plusminus,
                     THP.jumlah_bobin,
                     THP.jumlah_payung,
                     THP.jumlah_payung_kuning,
                     THP.jumlah_apal_global,
                     THP.hasil_berat_bersih,
                     THP.jenis_roll_pipa,

                     TSHP.id_transaksi,
                     TPHP.id_transaksi AS idTPHP,

                     TPHP.berat_pengambilan_bagian,
                     TPHP.berat_pengambilan_bagian_tumpuk,
                     TPHP.bobin_pengambilan_bagian,
                     TPHP.bobin_pengambilan_bagian_tumpuk,
                     TPHP.payung_pengambilan_bagian,
                     TPHP.payung_pengambilan_bagian_tumpuk,
                     TPHP.payung_kuning_pengambilan_bagian,
                     TPHP.payung_kuning_pengambilan_bagian_tumpuk,

                     TPHP.berat_pengambilan_gudang,
                     TPHP.berat_pengambilan_gudang_tumpuk,
                     TPHP.bobin_pengambilan_gudang,
                     TPHP.bobin_pengambilan_gudang_tumpuk,
                     TPHP.payung_pengambilan_gudang,
                     TPHP.payung_pengambilan_gudang_tumpuk,
                     TPHP.payung_kuning_pengambilan_gudang,
                     TPHP.payung_kuning_pengambilan_gudang_tumpuk,

                     TPHP.berat_sisa_semalam,
                     TPHP.bobin_sisa_semalam,
                     TPHP.payung_sisa_semalam,
                     TPHP.payung_kuning_sisa_semalam,
                     TPHP.berat_sisa_semalam_tumpuk,
                     TPHP.bobin_sisa_semalam_tumpuk,
                     TPHP.payung_sisa_semalam_tumpuk,
                     TPHP.payung_kuning_sisa_semalam_tumpuk,

                     TPHP.berat_sisa_hari_ini,
                     TPHP.bobin_sisa_hari_ini,
                     TPHP.payung_sisa_hari_ini,
                     TPHP.payung_kuning_sisa_hari_ini,
                     TPHP.berat_sisa_hari_ini_tumpuk,
                     TPHP.bobin_sisa_hari_ini_tumpuk,
                     TPHP.payung_sisa_hari_ini_tumpuk,
                     TPHP.payung_kuning_sisa_hari_ini_tumpuk,

                     RC.tgl_rencana,
                     RC.ket_barang,
                     RC.ket_merek,
                     RC.ukuran
              FROM transaksi_detail_pengambilan_potong TDPP
              INNER JOIN rencana_potong RC ON TDPP.kd_potong = RC.kd_potong
              LEFT JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_potong = RC.kd_potong
              LEFT JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
              LEFT JOIN transaksi_pengambilan_hasil_potong TPHP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
              WHERE TDPP.id = '$param[id]'";

              $arrData = $this->db->query($QTDPP)->result_array();
              $counterArrData = count($arrData);
              $arrParameter = array("kdGdRoll" => $arrData[0]["kd_gd_roll"],
                                    "kdPotong" => $arrData[0]["kd_potong"],
                                    "status" => $arrData[0]["status"],
                                    "deleted" => "FALSE",
                                    "stsTransaksi" => "FINISH");
              $Q2 = "SELECT SUM(berat) AS totalBerat, SUM(bobin) AS totalBobin, SUM(payung) AS totalPayung,
                            SUM(payung_kuning) AS totalPayungKuning, tgl_sisa, tgl_potong
                     FROM transaksi_detail_pengambilan_potong
                     WHERE kd_gd_roll = '$arrParameter[kdGdRoll]'
                     AND kd_potong = '$arrParameter[kdPotong]'
                     AND status = '$arrParameter[status]'
                     AND deleted = '$arrParameter[deleted]'
                     GROUP BY tgl_sisa
                     ORDER BY tgl_sisa ASC";
              $arrJumlahTDPP = $this->db->query($Q2)->result_array();

              //============ Data Rencana Mandor Potong ============//
              $tglRencana = $arrData[0]["tgl_rencana"];
              $ukuranPlastik = $arrData[0]["ukuran"];
              $panjangPlastik = $arrData[0]["panjang"];
              $ketBarang = $arrData[0]["ket_barang"];
              $ketMerek = $arrData[0]["ket_merek"];

              $jenisRoll = $arrData[0]["jenis_roll_pipa"];
              //============ Data Rencana Mandor Potong ============//

              //============ Data Sisa Per Item Lama ============//
              $beratLama = $arrData[0]["berat"];
              $bobinLama = $arrData[0]["bobin"];
              $payungLama = $arrData[0]["payung"];
              $payungKuningLama = $arrData[0]["payung_kuning"];
              $kdGdRollLama = $arrData[0]["kd_gd_roll"];
              $status = $arrData[0]["status"];
              $tglPotong = $arrData[0]["tgl_potong"];
              $tglSisa = $arrData[0]["tgl_sisa"];
              //============ Data Sisa Per Item Lama ============//

              //============ Data Berat Sisa Semalam Tumpuk ============//
              $beratSisaSemalamTumpukLama = round($arrData[0]["berat_sisa_semalam_tumpuk"],2);
              $bobinSisaSemalamTumpukLama = $arrData[0]["bobin_sisa_semalam_tumpuk"];
              $payungSisaSemalamTumpukLama = $arrData[0]["payung_sisa_semalam_tumpuk"];
              $payungKuningSisaSemalamTumpukLama = $arrData[0]["payung_kuning_sisa_semalam_tumpuk"];
              $totalRollSisaSemalamTumpukLama = $bobinSisaSemalamTumpukLama + $payungSisaSemalamTumpukLama + $payungKuningSisaSemalamTumpukLama;
              //============ Data Berat Sisa Semalam Tumpuk ============//

              //============ Data Berat Sisa Hari Ini Tumpuk ============//
              $beratSisaHariIniTumpukLama = round($arrData[0]["berat_sisa_hari_ini_tumpuk"],2);
              $bobinSisaHariIniTumpukLama = $arrData[0]["bobin_sisa_hari_ini_tumpuk"];
              $payungSisaHariIniTumpukLama = $arrData[0]["payung_sisa_hari_ini_tumpuk"];
              $payungKuningSisaHariIniTumpukLama = $arrData[0]["payung_kuning_sisa_hari_ini_tumpuk"];
              $totalRollSisaHariIniTumpukLama = $bobinSisaHariIniTumpukLama + $payungSisaHariIniTumpukLama + $payungKuningSisaHariIniTumpukLama;
              //============ Data Berat Sisa Hari Ini Tumpuk ============//

              //============ Data Berat Pengambilan Tumpuk (Gudang Dan Perbagian) ============//
              $beratPengambilanBagianTumpukLama = $arrData[0]["berat_pengambilan_bagian_tumpuk"];
              $bobinPengambilanBagianTumpukLama = $arrData[0]["bobin_pengambilan_bagian_tumpuk"];
              $payungPengambilanBagianTumpukLama = $arrData[0]["payung_pengambilan_bagian_tumpuk"];
              $payungKuningPengambilanBagianTumpukLama = $arrData[0]["payung_kuning_pengambilan_bagian_tumpuk"];
              $totalRollPengambilanBagianTumpukLama = $bobinPengambilanBagianTumpukLama + $payungPengambilanBagianTumpukLama + $payungKuningPengambilanBagianTumpukLama;

              $beratPengambilanGudangTumpukLama = $arrData[0]["berat_pengambilan_gudang_tumpuk"];
              $bobinPengambilanGudangTumpukLama = $arrData[0]["bobin_pengambilan_gudang_tumpuk"];
              $payungPengambilanGudangTumpukLama = $arrData[0]["payung_pengambilan_gudang_tumpuk"];
              $payungKuningPengambilanGudangTumpukLama = $arrData[0]["payung_kuning_pengambilan_gudang_tumpuk"];
              $totalRollPengambilanGudangTumpukLama = $bobinPengambilanGudangTumpukLama + $payungPengambilanGudangTumpukLama + $payungKuningPengambilanGudangTumpukLama;
              //============ Data Berat Pengambilan Tumpuk (Gudang Dan Perbagian) ============//

              //============ Data Berat Sisa Semalam ============//
              $beratSisaSemalamLama = round($arrData[0]["berat_sisa_semalam"],2);
              $bobinSisaSemalamLama = $arrData[0]["bobin_sisa_semalam"];
              $payungSisaSemalamLama = $arrData[0]["payung_sisa_semalam"];
              $payungKuningSisaSemalamLama = $arrData[0]["payung_kuning_sisa_semalam"];
              $totalRollSisaSemalamLama = $bobinSisaSemalamLama + $payungSisaSemalamLama + $payungKuningSisaSemalamLama;
              //============ Data Berat Sisa Semalam ============//

              //============ Data Berat Sisa Hari Ini ============//
              $beratSisaHariIniLama = round($arrData[0]["berat_sisa_hari_ini"],2);
              $bobinSisaHariIniLama = $arrData[0]["bobin_sisa_hari_ini"];
              $payungSisaHariIniLama = $arrData[0]["payung_sisa_hari_ini"];
              $payungKuningSisaHariIniLama = $arrData[0]["payung_kuning_sisa_hari_ini"];
              $totalRollSisaHariIniLama = $bobinSisaHariIniLama + $payungSisaHariIniLama + $payungKuningSisaHariIniLama;
              //============ Data Berat Sisa Hari Ini ============//

              //============ Data Berat Pengambilan (Gudang Dan Perbagian) ============//
              $beratPengambilanBagianLama = $arrData[0]["berat_pengambilan_bagian"];
              $bobinPengambilanBagianLama = $arrData[0]["bobin_pengambilan_bagian"];
              $payungPengambilanBagianLama = $arrData[0]["payung_pengambilan_bagian"];
              $payungKuningPengambilanBagianLama = $arrData[0]["payung_kuning_pengambilan_bagian"];
              $totalRollPengambilanBagianLama = $bobinPengambilanBagianLama + $payungPengambilanBagianLama + $payungKuningPengambilanBagianLama;

              $beratPengambilanGudangLama = $arrData[0]["berat_pengambilan_gudang"];
              $bobinPengambilanGudangLama = $arrData[0]["bobin_pengambilan_gudang"];
              $payungPengambilanGudangLama = $arrData[0]["payung_pengambilan_gudang"];
              $payungKuningPengambilanGudangLama = $arrData[0]["payung_kuning_pengambilan_gudang"];
              $totalRollPengambilanGudangLama = $bobinPengambilanGudangLama + $payungPengambilanGudangLama + $payungKuningPengambilanGudangLama;
              //============ Data Berat Pengambilan (Gudang Dan Perbagian) ============//

              //============ Data Jumlah Berat Sisa ============//
              for ($i=0; $i < count($arrJumlahTDPP); $i++) {
                if($arrJumlahTDPP[$i]["tgl_potong"] == $tglRencana && $arrJumlahTDPP[$i]["totalBerat"]==$beratSisaSemalamLama){
                  $beratSumTDPP = $arrJumlahTDPP[$i]["totalBerat"];
                  $bobinSumTDPP = $arrJumlahTDPP[$i]["totalBobin"];
                  $payungSumTDPP = $arrJumlahTDPP[$i]["totalPayung"];
                  $payungKuningSumTDPP = $arrJumlahTDPP[$i]["totalPayungKuning"];
                }else if($arrJumlahTDPP[$i]["tgl_sisa"] == $tglRencana && $arrJumlahTDPP[$i]["totalBerat"]==$beratSisaHariIniLama){
                  $beratSumTDPP = $arrJumlahTDPP[$i]["totalBerat"];
                  $bobinSumTDPP = $arrJumlahTDPP[$i]["totalBobin"];
                  $payungSumTDPP = $arrJumlahTDPP[$i]["totalPayung"];
                  $payungKuningSumTDPP = $arrJumlahTDPP[$i]["totalPayungKuning"];
                }
              }
              //============ Data Jumlah Berat Sisa ============//

              if($arrParameter["status"] == "KEMBALI KE GUDANG(SISA SEMALAM)"){
                $keteranganHistory = "OPERATOR(SISA SEMALAM)";
              }else{
                $keteranganHistory = "OPERATOR(SISA MESIN)";
              }
              $QCheckTGR = "SELECT id, status_transaksi FROM transaksi_gudang_roll
                            WHERE kd_gd_roll='$kdGdRollLama'
                            AND bagian='POTONG'
                            AND keterangan_history = '$keteranganHistory'
                            AND berat = '$beratLama'
                            AND bobin = '$bobinLama'
                            AND payung = '$payungLama'
                            AND payung_kuning = '$payungKuningLama'
                            AND deleted = 'FALSE'";
              $arrCheckTGR = $this->db->query($QCheckTGR)->result_array();

              $QCheckTBPR = "SELECT id,keterangan FROM transaksi_berat_pengambilan_roll
                             WHERE kd_gd_roll = '$kdGdRollLama'
                             AND sisa = '$beratLama'
                             AND payung = '$payungLama'
                             AND payung_kuning = '$payungKuningLama'
                             AND bobin = '$bobinLama'
                             AND tgl_sisa = '$tglSisa'";
              $arrCheckTBPR = $this->db->query($QCheckTBPR)->result_array();

              //============ Update Transaksi Detail Pengambilan Potong ============//
              $this->db->where("id", $param["id"]);
              $this->db->update("transaksi_detail_pengambilan_potong", array_diff_key($param,array_flip(array("bagian","doubleSingle"))));
              //============ Update Transaksi Detail Pengambilan Potong ============//

              //============ Update Transaksi Berat Pengambilan Potong ============//
              $this->db->set("sisa",$param["berat"]);
              $this->db->set("payung",$param["payung"]);
              $this->db->set("payung_kuning",$param["payung_kuning"]);
              $this->db->set("bobin",$param["bobin"]);
              $this->db->where("id", $arrCheckTBPR[0]["id"]);
              $this->db->update("transaksi_berat_pengambilan_roll");
              //============ Update Transaksi Berat Pengambilan Potong ============//

              //============ Update Transaksi Gudang Roll ============//
              $this->db->set("berat", $param["berat"]);
              $this->db->set("bobin", $param["bobin"]);
              $this->db->set("payung", $param["payung"]);
              $this->db->set("payung_kuning", $param["payung_kuning"]);

              $this->db->where("kd_gd_roll",$kdGdRollLama);
              $this->db->where("keterangan_history",$keteranganHistory);
              $this->db->where("berat",$beratLama);
              $this->db->where("bobin",$bobinLama);
              $this->db->where("payung",$payungLama);
              $this->db->where("payung_kuning",$payungKuningLama);
              $this->db->where("deleted","FALSE");
              $this->db->update("transaksi_gudang_roll");

              if($arrCheckTGR[0]["status_transaksi"] == "FINISH"){
                //======= Update Stok Gudang Roll (Barang Lama) =======//
                if($arrCheckTBPR[0]["keterangan"] == "KEMBALI GUDANG"){
                  $this->db->set("stok","stok + ".($param["berat"] - $beratLama), FALSE);
                  $this->db->set("bobin","bobin + ".($param["bobin"] - $bobinLama), FALSE);
                  $this->db->set("payung","payung + ".($param["payung"] - $payungLama), FALSE);
                  $this->db->set("payung_kuning","payung_kuning + ".($param["payung_kuning"] - $payungKuningLama), FALSE);

                  $this->db->where("kd_gd_roll",$kdGdRollLama);
                  $this->db->update("gudang_roll");
                }else{
                  $this->db->set("stok","stok + ".($beratLama - $param["berat"]), FALSE);
                  $this->db->set("bobin","bobin + ".($bobinLama - $param["bobin"]), FALSE);
                  $this->db->set("payung","payung + ".($payungLama - $param["payung"]), FALSE);
                  $this->db->set("payung_kuning","payung_kuning + ".($payungKuningLama - $param["payung_kuning"]), FALSE);

                  $this->db->where("kd_gd_roll",$kdGdRollLama);
                  $this->db->update("gudang_roll");
                }
                //======= Update Stok Gudang Roll (Barang Lama) =======//
              }
            //============ Update Transaksi Gudang Roll ============//

            //============ Update Transaksi Hasil Potong Dan Transaksi Pengambilan Hasil Potong ============//
            if($counterArrData > 0){
              if($tglPotong == $tglRencana){
                if($beratSumTDPP == $beratSisaSemalamLama){
                  $beratSelisih = round($param["berat"],2) - $beratLama;
                  $bobinSelisih = $param["bobin"] - $bobinLama;
                  $payungSelisih = $param["payung"] - $payungLama;
                  $payungKuningSelisih = $param["payung_kuning"] - $payungKuningLama;

                  $beratSisaSemalamBaru = round($param["berat"],3);
                  $bobinSisaSemalamBaru = $param["bobin"];
                  $payungSisaSemalamBaru = $param["payung"];
                  $payungKuningSisaSemalamBaru = $param["payung_kuning"];
                  $totalRollSisaSemalamBaru = $bobinSisaSemalamBaru + $payungSisaSemalamBaru + $payungKuningSisaSemalamBaru;

                  $arrDataForPanjangPlastik = array("jenisPipa"   => $jenisRoll,
                                                    "ukuran"      => $ukuranPlastik,
                                                    "panjang"     => $panjangPlastik,
                                                    "ketMerek"    => $ketMerek,
                                                    "ketBarang"   => $ketBarang);

                  $hasilPanjangPlastik = CustomClass::hitungPanjangPlastik($arrDataForPanjangPlastik);

                  $arrDataForBeratRoll = array("jenisPipa"            => $jenisRoll,
                                               "doubleSingle"         => $param["doubleSingle"],
                                               "panjangPlastik"       => $hasilPanjangPlastik,
                                               "jumlahPayung"         => ((($payungPengambilanBagianLama +
                                                                         $payungPengambilanBagianTumpukLama) +
                                                                         (($payungPengambilanGudangLama - $payungSelisih) +
                                                                         $payungPengambilanGudangTumpukLama) +
                                                                         ($payungSisaSemalamBaru +
                                                                         $payungSisaSemalamTumpukLama)) -
                                                                         ($payungSisaHariIniLama +
                                                                         $payungSisaHariIniTumpukLama)
                                                                        ),
                                               "jumlahPayungKuning"   => ((($payungKuningPengambilanBagianLama +
                                                                         $payungKuningPengambilanBagianTumpukLama) +
                                                                         (($payungKuningPengambilanGudangLama - $payungKuningSelisih) +
                                                                         $payungKuningPengambilanGudangTumpukLama) +
                                                                         ($payungKuningSisaSemalamBaru +
                                                                         $payungKuningSisaSemalamTumpukLama)) -
                                                                         ($payungKuningSisaHariIniLama +
                                                                         $payungKuningSisaHariIniTumpukLama)
                                                                        ),
                                               "jumlahBobin"          => ((($bobinPengambilanBagianLama +
                                                                         $bobinPengambilanBagianTumpukLama) +
                                                                         (($bobinPengambilanGudangLama - $bobinSelisih) +
                                                                         $bobinPengambilanGudangTumpukLama) +
                                                                         ($bobinSisaSemalamBaru +
                                                                         $bobinSisaSemalamTumpukLama)) -
                                                                         ($bobinSisaHariIniLama +
                                                                         $bobinSisaHariIniTumpukLama)
                                                                        )
                                              );
                  $hasilBeratRollBaru = CustomClass::hitungBeratRoll($arrDataForBeratRoll);
                  $arrDataForPlusMinusBaru = array("beratPengambilan"         => (($beratPengambilanGudangLama - $beratSelisih) + $beratPengambilanGudangTumpukLama),
                                                   "beratPengambilanBagian"   => ($beratPengambilanBagianLama + $beratPengambilanBagianTumpukLama),
                                                   "beratSisaSemalam"         => ($beratSisaSemalamBaru + $beratSisaSemalamTumpukLama),
                                                   "beratSisaHariIni"         => ($beratSisaHariIniLama + $beratSisaHariIniTumpukLama),
                                                   "beratBersih"              => $arrData[0]["hasil_berat_bersih"],
                                                   "beratApal"                => $arrData[0]["jumlah_apal_global"],
                                                   "beratRollPipa"            => $hasilBeratRollBaru);

                  $hasilPlusMinusbaru = CustomClass::hitungPlusMinus($arrDataForPlusMinusBaru);
                  //============ Update Data Transaksi Gudang Roll Dengan Status OPERATOR POTONG ============//
                  $this->db->set("berat", "berat - ".$beratSelisih, FALSE);
                  $this->db->set("bobin", "bobin - ".$bobinSelisih, FALSE);
                  $this->db->set("payung", "payung - ".$payungSelisih, FALSE);
                  $this->db->set("payung_kuning", "payung_kuning - ".$payungKuningSelisih, FALSE);

                  $this->db->where("kd_gd_roll",$kdGdRollLama);
                  $this->db->where("keterangan_history","OPERATOR POTONG");
                  $this->db->where("berat",$beratPengambilanGudangLama);
                  $this->db->where("bobin",$bobinPengambilanGudangLama);
                  $this->db->where("payung",$payungPengambilanGudangLama);
                  $this->db->where("payung_kuning",$payungKuningPengambilanGudangLama);
                  $this->db->where("tgl_transaksi",$tglRencana);
                  $this->db->where("deleted","FALSE");
                  $this->db->update("transaksi_gudang_roll");
                  //============ Update Data Transaksi Gudang Roll Dengan Status OPERATOR POTONG ============//

                  $this->db->set("berat_sisa_semalam","berat_sisa_semalam + ".$beratSelisih, FALSE);
                  $this->db->set("bobin_sisa_semalam","bobin_sisa_semalam + ".$bobinSelisih, FALSE);
                  $this->db->set("payung_sisa_semalam","payung_sisa_semalam + ".$payungSelisih, FALSE);
                  $this->db->set("payung_kuning_sisa_semalam", "payung_kuning_sisa_semalam - ".$payungKuningSelisih, FALSE);

                  $this->db->set("berat_pengambilan_gudang", "berat_pengambilan_gudang - ".$beratSelisih,FALSE);
                  $this->db->set("bobin_pengambilan_gudang","bobin_pengambilan_gudang - ".$bobinSelisih, FALSE);
                  $this->db->set("payung_pengambilan_gudang","payung_pengambilan_gudang - ".$payungSelisih, FALSE);
                  $this->db->set("payung_kuning_pengambilan_gudang", "payung_kuning_pengambilan_gudang - ".$payungKuningSelisih, FALSE);

                  $this->db->where("id_transaksi",$arrData[0]["idTPHP"]);
                  $this->db->update("transaksi_pengambilan_hasil_potong");

                  $this->db->set("jumlah_roll_pipa",$hasilBeratRollBaru);
                  $this->db->set("plusminus",$hasilPlusMinusbaru);
                  $this->db->set("jumlah_payung","jumlah_payung + ".$payungSelisih, FALSE);
                  $this->db->set("jumlah_payung_kuning","jumlah_payung_kuning + ".$payungKuningSelisih, FALSE);
                  $this->db->set("jumlah_bobin","jumlah_bobin + ".$bobinSelisih, FALSE);
                  $this->db->where("kd_hasil_potong",$arrData[0]["kd_hasil_potong"]);
                  $this->db->update("transaksi_hasil_potong");
                }else{
                  $beratSelisih = round($param["berat"],2) - $beratLama;
                  $bobinSelisih = $param["bobin"] - $bobinLama;
                  $payungSelisih = $param["payung"] - $payungLama;
                  $payungKuningSelisih = $param["payung_kuning"] - $payungKuningLama;

                  $beratSisaSemalamTumpukBaru = round($param["berat"],3);
                  $bobinSisaSemalamTumpukBaru = $param["bobin"];
                  $payungSisaSemalamTumpukBaru = $param["payung"];
                  $payungKuningSisaSemalamTumpukBaru = $param["payung_kuning"];
                  $totalRollSisaSemalamTumpukBaru = $bobinSisaSemalamTumpukBaru + $payungSisaSemalamTumpukBaru + $payungKuningSisaSemalamTumpukBaru;

                  $arrDataForPanjangPlastik = array("jenisPipa"   => $jenisRoll,
                                                    "ukuran"      => $ukuranPlastik,
                                                    "panjang"     => $panjangPlastik,
                                                    "ketMerek"    => $ketMerek,
                                                    "ketBarang"   => $ketBarang);

                  $hasilPanjangPlastik = CustomClass::hitungPanjangPlastik($arrDataForPanjangPlastik);

                  $arrDataForBeratRoll = array("jenisPipa"            => $jenisRoll,
                                               "doubleSingle"         => $param["doubleSingle"],
                                               "panjangPlastik"       => $hasilPanjangPlastik,
                                               "jumlahPayung"         => ((($payungPengambilanBagianLama +
                                                                         $payungPengambilanBagianTumpukLama) +
                                                                         ($payungPengambilanGudangLama +
                                                                         ($payungPengambilanGudangTumpukLama - $payungSelisih)) +
                                                                         ($payungSisaSemalamLama +
                                                                         $payungSisaSemalamTumpukBaru)) -
                                                                         ($payungSisaHariIniLama +
                                                                         $payungSisaHariIniTumpukLama)
                                                                        ),
                                               "jumlahPayungKuning"   => ((($payungKuningPengambilanBagianLama +
                                                                         $payungKuningPengambilanBagianTumpukLama) +
                                                                         ($payungKuningPengambilanGudangLama +
                                                                         ($payungKuningPengambilanGudangTumpukLama - $payungKuningSelisih)) +
                                                                         ($payungKuningSisaSemalamLama +
                                                                         $payungKuningSisaSemalamTumpukBaru)) -
                                                                         ($payungKuningSisaHariIniLama +
                                                                         $payungKuningSisaHariIniTumpukLama)
                                                                        ),
                                               "jumlahBobin"          => ((($bobinPengambilanBagianLama +
                                                                         $bobinPengambilanBagianTumpukLama) +
                                                                         ($bobinPengambilanGudangLama +
                                                                         ($bobinPengambilanGudangTumpukLama - $bobinSelisih)) +
                                                                         ($bobinSisaSemalamLama +
                                                                         $bobinSisaSemalamTumpukbaru)) -
                                                                         ($bobinSisaHariIniLama +
                                                                         $bobinSisaHariIniTumpukLama)
                                                                        )
                                              );
                  $hasilBeratRollBaru = CustomClass::hitungBeratRoll($arrDataForBeratRoll);
                  $arrDataForPlusMinusBaru = array("beratPengambilan"         => ($beratPengambilanGudangLama + ($beratPengambilanGudangTumpukLama - $beratSelisih)),
                                                   "beratPengambilanBagian"   => ($beratPengambilanBagianLama + $beratPengambilanBagianTumpukLama),
                                                   "beratSisaSemalam"         => ($beratSisaSemalamLama + $beratSisaSemalamTumpukBaru),
                                                   "beratSisaHariIni"         => ($beratSisaHariIniLama + $beratSisaHariIniTumpukLama),
                                                   "beratBersih"              => $arrData[0]["hasil_berat_bersih"],
                                                   "beratApal"                => $arrData[0]["jumlah_apal_global"],
                                                   "beratRollPipa"            => $hasilBeratRollBaru);

                  $hasilPlusMinusbaru = CustomClass::hitungPlusMinus($arrDataForPlusMinusBaru);
                  //============ Update Data Transaksi Gudang Roll Dengan Status OPERATOR POTONG ============//
                  $this->db->set("berat", "berat - ".$beratSelisih, FALSE);
                  $this->db->set("bobin", "bobin - ".$bobinSelisih, FALSE);
                  $this->db->set("payung", "payung - ".$payungSelisih, FALSE);
                  $this->db->set("payung_kuning", "payung_kuning - ".$payungKuningSelisih, FALSE);

                  $this->db->where("kd_gd_roll",$kdGdRollLama);
                  $this->db->where("keterangan_history","OPERATOR POTONG");
                  $this->db->where("berat",$beratPengambilanGudangTumpukLama);
                  $this->db->where("bobin",$bobinPengambilanGudangTumpukLama);
                  $this->db->where("payung",$payungPengambilanGudangTumpukLama);
                  $this->db->where("payung_kuning",$payungKuningPengambilanGudangTumpukLama);
                  $this->db->where("tgl_transaksi",$tglRencana);
                  $this->db->where("deleted","FALSE");
                  $this->db->update("transaksi_gudang_roll");
                  //============ Update Data Transaksi Gudang Roll Dengan Status OPERATOR POTONG ============//

                  $this->db->set("berat_sisa_semalam_tumpuk","berat_sisa_semalam_tumpuk + ".$beratSelisih, FALSE);
                  $this->db->set("bobin_sisa_semalam_tumpuk","bobin_sisa_semalam_tumpuk + ".$bobinSelisih, FALSE);
                  $this->db->set("payung_sisa_semalam_tumpuk","payung_sisa_semalam_tumpuk + ".$payungSelisih, FALSE);
                  $this->db->set("payung_kuning_sisa_semalam_tumpuk", "payung_kuning_sisa_semalam_tumpuk + ".$payungKuningSelisih, FALSE);

                  $this->db->set("berat_pengambilan_gudang_tumpuk", "berat_pengambilan_gudang_tumpuk - ".$beratSelisih,FALSE);
                  $this->db->set("bobin_pengambilan_gudang_tumpuk","bobin_pengambilan_gudang_tumpuk - ".$bobinSelisih, FALSE);
                  $this->db->set("payung_pengambilan_gudang_tumpuk","payung_pengambilan_gudang_tumpuk - ".$payungSelisih, FALSE);
                  $this->db->set("payung_kuning_pengambilan_gudang_tumpuk", "payung_kuning_pengambilan_gudang_tumpuk - ".$payungKuningSelisih, FALSE);

                  $this->db->where("id_transaksi",$arrData[0]["idTPHP"]);
                  $this->db->update("transaksi_pengambilan_hasil_potong");

                  $this->db->set("jumlah_roll_pipa",$hasilBeratRollBaru);
                  $this->db->set("plusminus",$hasilPlusMinusbaru);
                  $this->db->set("jumlah_payung","jumlah_payung + ".$payungSelisih, FALSE);
                  $this->db->set("jumlah_payung_kuning","jumlah_payung_kuning + ".$payungKuningSelisih, FALSE);
                  $this->db->set("jumlah_bobin","jumlah_bobin + ".$bobinSelisih, FALSE);
                  $this->db->where("kd_hasil_potong",$arrData[0]["kd_hasil_potong"]);
                  $this->db->update("transaksi_hasil_potong");
                }
              }else if($tglSisa == $tglRencana){
                if($beratSumTDPP == $beratSisaHariIniLama){
                  $beratSelisih = round($param["berat"],2) - $beratLama;
                  $bobinSelisih = $param["bobin"] - $bobinLama;
                  $payungSelisih = $param["payung"] - $payungLama;
                  $payungKuningSelisih = $param["payung_kuning"] - $payungKuningLama;

                  $beratSisaHariIniBaru = round($param["berat"],3);
                  $bobinSisaHariIniBaru = $param["bobin"];
                  $payungSisaHariIniBaru = $param["payung"];
                  $payungKuningSisaHariIniBaru = $param["payung_kuning"];
                  $totalRollSisaHariIniBaru = $bobinSisaHariIniBaru + $payungSisaHariIniBaru + $payungKuningSisaHariIniBaru;

                  $arrDataForPanjangPlastik = array("jenisPipa"   => $jenisRoll,
                                                    "ukuran"      => $ukuranPlastik,
                                                    "panjang"     => $panjangPlastik,
                                                    "ketMerek"    => $ketMerek,
                                                    "ketBarang"   => $ketBarang);

                  $hasilPanjangPlastik = CustomClass::hitungPanjangPlastik($arrDataForPanjangPlastik);

                  $arrDataForBeratRoll = array("jenisPipa"            => $jenisRoll,
                                               "doubleSingle"         => $param["doubleSingle"],
                                               "panjangPlastik"       => $hasilPanjangPlastik,
                                               "jumlahPayung"         => ((($payungPengambilanBagianLama +
                                                                         $payungPengambilanBagianTumpukLama) +
                                                                         ($payungPengambilanGudangLama +
                                                                         $payungPengambilanGudangTumpukLama) +
                                                                         ($payungSisaSemalamLama +
                                                                         $payungSisaSemalamTumpukLama)) -
                                                                         ($payungSisaHariIniBaru +
                                                                         $payungSisaHariIniTumpukLama)
                                                                        ),
                                               "jumlahPayungKuning"   => ((($payungKuningPengambilanBagianLama +
                                                                         $payungKuningPengambilanBagianTumpukLama) +
                                                                         ($payungKuningPengambilanGudangLama +
                                                                         $payungKuningPengambilanGudangTumpukLama) +
                                                                         ($payungKuningSisaSemalamLama +
                                                                         $payungKuningSisaSemalamTumpukLama)) -
                                                                         ($payungKuningSisaHariIniBaru +
                                                                         $payungKuningSisaHariIniTumpukLama)
                                                                        ),
                                               "jumlahBobin"          => ((($bobinPengambilanBagianLama +
                                                                         $bobinPengambilanBagianTumpukLama) +
                                                                         ($bobinPengambilanGudangLama +
                                                                         $bobinPengambilanGudangTumpukLama) +
                                                                         ($bobinSisaSemalamLama +
                                                                         $bobinSisaSemalamTumpukLama)) -
                                                                         ($bobinSisaHariIniBaru +
                                                                         $bobinSisaHariIniTumpukLama)
                                                                        )
                                              );
                  $hasilBeratRollBaru = CustomClass::hitungBeratRoll($arrDataForBeratRoll);
                  $arrDataForPlusMinusBaru = array("beratPengambilan"         => ($beratPengambilanGudangLama + $beratPengambilanGudangTumpukLama),
                                                   "beratPengambilanBagian"   => ($beratPengambilanBagianLama + $beratPengambilanBagianTumpukLama),
                                                   "beratSisaSemalam"         => ($beratSisaSemalamLama + $beratSisaSemalamTumpukLama),
                                                   "beratSisaHariIni"         => ($beratSisaHariIniBaru + $beratSisaHariIniTumpukLama),
                                                   "beratBersih"              => $arrData[0]["hasil_berat_bersih"],
                                                   "beratApal"                => $arrData[0]["jumlah_apal_global"],
                                                   "beratRollPipa"            => $hasilBeratRollBaru);

                  $hasilPlusMinusbaru = CustomClass::hitungPlusMinus($arrDataForPlusMinusBaru);

                  $this->db->set("berat_sisa_hari_ini","berat_sisa_hari_ini + ".$beratSelisih, FALSE);
                  $this->db->set("bobin_sisa_hari_ini","bobin_sisa_hari_ini + ".$bobinSelisih, FALSE);
                  $this->db->set("payung_sisa_hari_ini","payung_sisa_hari_ini + ".$payungSelisih, FALSE);
                  $this->db->set("payung_kuning_sisa_hari_ini", "payung_kuning_sisa_hari_ini + ".$payungKuningSelisih, FALSE);

                  $this->db->where("id_transaksi",$arrData[0]["idTPHP"]);
                  $this->db->update("transaksi_pengambilan_hasil_potong");

                  $this->db->set("jumlah_roll_pipa",$hasilBeratRollBaru);
                  $this->db->set("plusminus",$hasilPlusMinusbaru);

                  $this->db->set("jumlah_payung","jumlah_payung - ".$payungSelisih, FALSE);
                  $this->db->set("jumlah_payung_kuning","jumlah_payung_kuning - ".$payungKuningSelisih, FALSE);
                  $this->db->set("jumlah_bobin","jumlah_bobin - ".$bobinSelisih, FALSE);

                  $this->db->where("kd_hasil_potong",$arrData[0]["kd_hasil_potong"]);
                  $this->db->update("transaksi_hasil_potong");
                }else{
                  $beratSelisih = round($param["berat"],2) - $beratLama;
                  $bobinSelisih = $param["bobin"] - $bobinLama;
                  $payungSelisih = $param["payung"] - $payungLama;
                  $payungKuningSelisih = $param["payung_kuning"] - $payungKuningLama;

                  $beratSisaHariIniTumpukBaru = round($param["berat"],3);
                  $bobinSisaHariIniTumpukBaru = $param["bobin"];
                  $payungSisaHariIniTumpukBaru = $param["payung"];
                  $payungKuningSisaHariIniTumpukBaru = $param["payung_kuning"];
                  $totalRollSisaHariIniTumpukBaru = $bobinSisaHariIniTumpukBaru + $payungSisaHariIniTumpukBaru + $payungKuningSisaHariIniTumpukBaru;

                  $arrDataForPanjangPlastik = array("jenisPipa"   => $jenisRoll,
                                                    "ukuran"      => $ukuranPlastik,
                                                    "panjang"     => $panjangPlastik,
                                                    "ketMerek"    => $ketMerek,
                                                    "ketBarang"   => $ketBarang);

                  $hasilPanjangPlastik = CustomClass::hitungPanjangPlastik($arrDataForPanjangPlastik);

                  $arrDataForBeratRoll = array("jenisPipa"            => $jenisRoll,
                                               "doubleSingle"         => $param["doubleSingle"],
                                               "panjangPlastik"       => $hasilPanjangPlastik,
                                               "jumlahPayung"         => ((($payungPengambilanBagianLama +
                                                                         $payungPengambilanBagianTumpukLama) +
                                                                         ($payungPengambilanGudangLama +
                                                                         $payungPengambilanGudangTumpukLama) +
                                                                         ($payungSisaSemalamLama +
                                                                         $payungSisaSemalamTumpukLama)) -
                                                                         ($payungSisaHariIniLama +
                                                                         $payungSisaHariIniTumpukBaru)
                                                                        ),
                                               "jumlahPayungKuning"   => ((($payungKuningPengambilanBagianLama +
                                                                         $payungKuningPengambilanBagianTumpukLama) +
                                                                         ($payungKuningPengambilanGudangLama +
                                                                         $payungKuningPengambilanGudangTumpukLama) +
                                                                         ($payungKuningSisaSemalamLama +
                                                                         $payungKuningSisaSemalamTumpukLama)) -
                                                                         ($payungKuningSisaHariIniLama +
                                                                         $payungKuningSisaHariIniTumpukBaru)
                                                                        ),
                                               "jumlahBobin"          => ((($bobinPengambilanBagianLama +
                                                                         $bobinPengambilanBagianTumpukLama) +
                                                                         ($bobinPengambilanGudangLama +
                                                                         $bobinPengambilanGudangTumpukLama) +
                                                                         ($bobinSisaSemalamLama +
                                                                         $bobinSisaSemalamTumpukLama)) -
                                                                         ($bobinSisaHariIniLama +
                                                                         $bobinSisaHariIniTumpukBaru)
                                                                        )
                                              );
                  $hasilBeratRollBaru = CustomClass::hitungBeratRoll($arrDataForBeratRoll);
                  $arrDataForPlusMinusBaru = array("beratPengambilan"         => ($beratPengambilanGudangLama + $beratPengambilanGudangTumpukLama),
                                                   "beratPengambilanBagian"   => ($beratPengambilanBagianLama + $beratPengambilanBagianTumpukLama),
                                                   "beratSisaSemalam"         => ($beratSisaSemalamLama + $beratSisaSemalamTumpukLama),
                                                   "beratSisaHariIni"         => ($beratSisaHariIniLama + $beratSisaHariIniTumpukBaru),
                                                   "beratBersih"              => $arrData[0]["hasil_berat_bersih"],
                                                   "beratApal"                => $arrData[0]["jumlah_apal_global"],
                                                   "beratRollPipa"            => $hasilBeratRollBaru);

                  $hasilPlusMinusbaru = CustomClass::hitungPlusMinus($arrDataForPlusMinusBaru);
                  $this->db->set("berat_sisa_hari_ini_tumpuk","berat_sisa_hari_ini_tumpuk + ".$beratSelisih, FALSE);
                  $this->db->set("bobin_sisa_hari_ini_tumpuk","bobin_sisa_hari_ini_tumpuk + ".$bobinSelisih, FALSE);
                  $this->db->set("payung_sisa_hari_ini_tumpuk","payung_sisa_hari_ini_tumpuk + ".$payungSelisih, FALSE);
                  $this->db->set("payung_kuning_sisa_hari_ini_tumpuk", "payung_kuning_sisa_hari_ini_tumpuk + ".$payungKuningSelisih, FALSE);
                  $this->db->where("id_transaksi",$arrData[0]["idTPHP"]);
                  $this->db->update("transaksi_pengambilan_hasil_potong");

                  $this->db->set("jumlah_roll_pipa",$hasilBeratRollBaru);
                  $this->db->set("plusminus",$hasilPlusMinusbaru);

                  $this->db->set("jumlah_payung","jumlah_payung - ".$payungSelisih, FALSE);
                  $this->db->set("jumlah_payung_kuning","jumlah_payung_kuning - ".$payungKuningSelisih, FALSE);
                  $this->db->set("jumlah_bobin","jumlah_bobin - ".$bobinSelisih, FALSE);

                  $this->db->where("kd_hasil_potong",$arrData[0]["kd_hasil_potong"]);
                  $this->db->update("transaksi_hasil_potong");
                }
              }else{

              }
              //============ Update Transaksi Hasil Potong Dan Transaksi Pengambilan Hasil Potong ============//
            }
      }
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }

    public function updateHasilCuttingTemp($param){
      $this->db->trans_begin();
      $kdHasilPotong = $param["THP"]["kd_hasil_potong"];
      $periodeLock = date("Y-m",strtotime($param["THP"]["tgl_rencana"]));
      $QCheckLock = "SELECT COUNT(id) AS counter
                     FROM transaksi_gudang_roll
                     WHERE status_lock='TRUE'
                     AND DATE_FORMAT(tgl_transaksi,'%Y-%m') = '$periodeLock'
                     AND deleted='FALSE'";
      $QCheckPengambilanGudang = "SELECT TPHP.berat_pengambilan_gudang,
                                         TPHP.bobin_pengambilan_gudang,
                                         TPHP.payung_pengambilan_gudang,
                                         TPHP.payung_kuning_pengambilan_gudang,

                                         TPHP.berat_pengambilan_gudang_tumpuk,
                                         TPHP.bobin_pengambilan_gudang_tumpuk,
                                         TPHP.payung_pengambilan_gudang_tumpuk,
                                         TPHP.payung_kuning_pengambilan_gudang_tumpuk
                                  FROM transaksi_pengambilan_hasil_potong TPHP
                                  INNER JOIN transaksi_hasil_potong THP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
                                  WHERE TPHP.kd_hasil_potong = '$kdHasilPotong'";
      $arrCheckLock = $this->db->query($QCheckLock)->result_array();
      if($arrCheckLock[0]["counter"] > 0){
        $this->db->trans_rollback();
        return "Lock";
      }else{
        $arrCheckPengambilanGudang = $this->db->query($QCheckPengambilanGudang)->result_array();
        $beratPengambilanGudangLama = $arrCheckPengambilanGudang[0]["berat_pengambilan_gudang"];
        $bobinPengambilanGudangLama = $arrCheckPengambilanGudang[0]["bobin_pengambilan_gudang"];
        $payungPengambilanGudangLama = $arrCheckPengambilanGudang[0]["payung_pengambilan_gudang"];
        $payungKuningPengambilanGudangLama = $arrCheckPengambilanGudang[0]["payung_kuning_pengambilan_gudang"];

        $beratPengambilanGudangTumpukLama = $arrCheckPengambilanGudang[0]["berat_pengambilan_gudang_tumpuk"];
        $bobinPengambilanGudangTumpukLama = $arrCheckPengambilanGudang[0]["bobin_pengambilan_gudang_tumpuk"];
        $payungPengambilanGudangTumpukLama = $arrCheckPengambilanGudang[0]["payung_pengambilan_gudang_tumpuk"];
        $payungKuningPengambilanGudangTumpukLama = $arrCheckPengambilanGudang[0]["payung_kuning_pengambilan_gudang_tumpuk"];

        if(array_key_exists("kd_gd_roll_tumpuk",$param["TSHP"][0])){
          $kdGdRollTumpuk = $param["TSHP"][0]["kd_gd_roll_tumpuk"];
          $kdGdRoll = $param["TSHP"][0]["kd_gd_roll"];
          $tglRencana = $param["THP"]["tgl_rencana"];
          $QCheckTGR = "SELECT id FROM transaksi_gudang_roll
                        WHERE (kd_gd_roll = '$kdGdRoll' AND
                               berat = '$beratPengambilanGudangLama' AND
                               bobin = '$bobinPengambilanGudangLama' AND
                               payung = '$payungPengambilanGudangLama' AND
                               payung_kuning = '$payungKuningPengambilanGudangLama' AND
                               tgl_transaksi = '$tglRencana' AND
                               bagian = 'POTONG' AND
                               keterangan_transaksi = 'KELUAR KE POTONG' AND
                               status_history = 'KELUAR' AND
                               keterangan_history = 'OPERATOR POTONG' AND
                               deleted='FALSE')
                        OR (kd_gd_roll = '$kdGdRollTumpuk' AND
                               berat = '$beratPengambilanGudangTumpukLama' AND
                               bobin = '$bobinPengambilanGudangTumpukLama' AND
                               payung = '$payungPengambilanGudangTumpukLama' AND
                               payung_kuning = '$payungKuningPengambilanGudangTumpukLama' AND
                               tgl_transaksi = '$tglRencana' AND
                               bagian = 'POTONG' AND
                               keterangan_transaksi = 'KELUAR KE POTONG' AND
                               status_history = 'KELUAR' AND
                               keterangan_history = 'OPERATOR POTONG' AND
                               deleted='FALSE')
                        ORDER BY id ASC";
        }else{
          $kdGdRoll = $param["TSHP"][0]["kd_gd_roll"];
          $tglRencana = $param["THP"]["tgl_rencana"];
          $QCheckTGR = "SELECT id FROM transaksi_gudang_roll
                        WHERE  kd_gd_roll = '$kdGdRoll' AND
                               berat = '$beratPengambilanGudangLama' AND
                               bobin = '$bobinPengambilanGudangLama' AND
                               payung = '$payungPengambilanGudangLama' AND
                               payung_kuning = '$payungKuningPengambilanGudangLama' AND
                               tgl_transaksi = '$tglRencana' AND
                               bagian = 'POTONG' AND
                               keterangan_transaksi = 'KELUAR KE POTONG' AND
                               status_history = 'KELUAR' AND
                               keterangan_history = 'OPERATOR POTONG' AND
                               deleted='FALSE'
                        ORDER BY id ASC";
        }
        $arrCheckTGR = $this->db->query($QCheckTGR)->result_array();
        #============ Update Transaksi Gudang Roll (Start)============#
        for ($i=0; $i < count($arrCheckTGR); $i++) {
          $this->db->set("berat",$param["TGR"][$i]["berat"]);
          $this->db->set("bobin",$param["TGR"][$i]["bobin"]);
          $this->db->set("payung",$param["TGR"][$i]["payung"]);
          $this->db->set("payung_kuning",$param["TGR"][$i]["payung_kuning"]);
          $this->db->set("id_user",$param["TGR"][$i]["id_user"]);

          $this->db->where("id",$arrCheckTGR[0]["id"]);
          $this->db->update("transaksi_gudang_roll");
        }
        #============ Update Transaksi Gudang Roll (Finish)============#

        #============ Update Transaksi Sub Hasil Potong (Start)============#
        $this->db->set("jumlah_lembar",$param["TSHP"][0]["jumlah_lembar"]);
        $this->db->set("jumlah_berat",$param["TSHP"][0]["jumlah_berat"]);

        $this->db->where("id_transaksi",$param["TSHP"][0]["id_transaksi"]);
        $this->db->update("transaksi_sub_hasil_potong");
        #============ Update Transaksi Sub Hasil Potong (Finish)============#

        #============ Update Transaksi Pengambilan Hasil Potong (Start)============#
        $this->db->where('kd_hasil_potong',$param["TPHP"]["kd_hasil_potong"]);
        $this->db->update("transaksi_pengambilan_hasil_potong",$param["TPHP"]);
        #============ Update Transaksi Pengambilan Hasil Potong (Finish)============#

        #============ Update Transaksi Hasil Potong (Start)============#
        $this->db->where("kd_hasil_potong", $param["THP"]["kd_hasil_potong"]);
        $this->db->update("transaksi_hasil_potong",$param["THP"]);
        #============ Update Transaksi Hasil Potong (Start)============#
      }
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }

    public function updateTanggalRencana($param){
      $this->db->trans_begin();
      $Q = "SELECT tgl_rencana FROM rencana_potong WHERE kd_potong='$param[kd_potong]'";
      $arrTglRencana = $this->db->query($Q)->result_array();
      $tglRencanaAwal = $arrTglRencana[0]["tgl_rencana"];
      $QInsert = "INSERT INTO transaksi_history_rencana_potong(id_user, kd_potong, tgl_rencana_awal, tgl_rencana_sekarang)
                  VALUES('$param[id_user]','$param[kd_potong]','$tglRencanaAwal','$param[tgl_rencana]')";
      $this->db->query($QInsert);
      $this->db->set("id_user",$param["id_user"]);
      $this->db->set("tgl_rencana",$param["tgl_rencana"]);
      $this->db->set("sts_print","FALSE");
      $this->db->where("kd_potong",$param["kd_potong"]);
      $this->db->update("rencana_potong",$param);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return FALSE;
      }else{
        $this->db->trans_commit();
        return TRUE;
      }
    }

    public function editRencana($param){
      $this->db->trans_begin();
      if(array_key_exists("kd_ppic",$param)){
        $this->db->where("kd_potong", $param["kd_potong"]);
        $this->db->update("rencana_potong",$param);

        $this->db->set("satuan_kilo",$param["jml_permintaan"]);
        $this->db->set("sisa",$param["jml_permintaan"]);
        $this->db->where("kd_ppic",$param["kd_ppic"]);
        $this->db->update("rencana_ppic");
      }else{
        $this->db->where("kd_potong", $param["kd_potong"]);
        $this->db->update("rencana_potong",$param);
      }
      if($this->db->trans_status()===FALSE){
        $this->db->trans_rollback();
        return FALSE;
      }else{
        $this->db->trans_commit();
        return TRUE;
      }
    }

    public function updateStatusPrint($param){
      $this->db->trans_begin();
      $Q = "SELECT kd_gd_roll FROM rencana_potong WHERE kd_potong='$param[kd_potong]'";
      $arrData = $this->db->query($Q)->result_array();
      $this->db->set("sts_print",$param["sts_print"]);
      $this->db->where("kd_gd_roll",$arrData[0]["kd_gd_roll"]);
      $this->db->update("rencana_potong");
      if($this->db->trans_status()===FALSE){
        $this->db->trans_rollback();
        return FALSE;
      }else{
        $this->db->trans_commit();
        return TRUE;
      }
    }

    public function updateDeleteAndRestorePengambilanPotong($param){
      $this->db->trans_begin();
      $QCheckTDPP = "SELECT kd_gd_roll, tgl_potong, status, berat, bobin, payung,
                            payung_kuning, jns_permintaan, tgl_sisa
                     FROM transaksi_detail_pengambilan_potong
                     WHERE id='$param[idTransaksi]'
                     AND deleted='FALSE'";
      $arrDataTDPP = $this->db->query($QCheckTDPP)->result_array();
      $periodeLock = date("m",strtotime($arrDataTDPP[0]["tgl_sisa"]));
      $QCountLock = "SELECT COUNT(id) AS counter
                     FROM transaksi_gudang_roll
                     WHERE DATE_FORMAT(tgl_transaksi, '%m') = '$periodeLock'
                     AND status_lock = 'TRUE'
                     AND deleted='FALSE'";
      $arrCounterLock = $this->db->query($QCountLock)->result_array();
      if($arrCounterLock[0]["counter"] > 0){
        $this->db->trans_rollback();
        return "Lock";
      }else{
        $QCheckTGR = "SELECT id, status_transaksi
                      FROM transaksi_gudang_roll
                      WHERE bagian='POTONG'
                      AND keterangan_transaksi='KELUAR KE POTONG'
                      AND status_history='KELUAR'
                      AND kd_gd_roll = '".$arrDataTDPP[0]["kd_gd_roll"]."'
                      AND tgl_transaksi = '".$arrDataTDPP[0]["tgl_potong"]."'
                      AND keterangan_history = '".$arrDataTDPP[0]["status"]."'
                      AND berat = '".$arrDataTDPP[0]["berat"]."'
                      AND bobin = '".$arrDataTDPP[0]["bobin"]."'
                      AND payung = '".$arrDataTDPP[0]["payung"]."'
                      AND payung_kuning = '".$arrDataTDPP[0]["payung_kuning"]."'
                      AND deleted='FALSE'";
        $arrDataTGR = $this->db->query($QCheckTGR)->result_array();

        #============ DELETE TRANSAKSI DETAIL PENGAMBILAN POTONG ============#
        $this->db->set("deleted",$param["deleted"]);
        $this->db->set("id_user",$param["idUser"]);
        $this->db->where("id",$param["idTransaksi"]);

        $this->db->update("transaksi_detail_pengambilan_potong");
        #============ DELETE TRANSAKSI DETAIL PENGAMBILAN POTONG ============#

        #============ DELETE TRANSAKSI DETAIL GUDANG ROLL ============#
        $this->db->set("deleted",$param["deleted"]);
        $this->db->set("id_user",$param["idUser"]);
        $this->db->where("id",$arrDataTGR[0]["id"]);

        $this->db->update("transaksi_gudang_roll");
        #============ DELETE TRANSAKSI DETAIL GUDANG ROLL ============#

        if($param["deleted"] == "TRUE"){
          if($arrDataTGR[0]["status_transaksi"] == "FINISH"){
            $this->db->set("stok","stok + ".$arrDataTDPP[0]["berat"], FALSE);
            $this->db->set("bobin","bobin + ".$arrDataTDPP[0]["bobin"], FALSE);
            $this->db->set("payung","payung + ".$arrDataTDPP[0]["payung"], FALSE);
            $this->db->set("payung_kuning","payung_kuning + ".$arrDataTDPP[0]["payung_kuning"], FALSE);
            $this->db->where("kd_gd_roll",$arrDataTDPP[0]["kd_gd_roll"]);
          }
        }else{
          if($arrDataTGR[0]["status_transaksi"] == "FINISH"){
            $this->db->set("stok","stok - ".$arrDataTDPP[0]["berat"], FALSE);
            $this->db->set("bobin","bobin - ".$arrDataTDPP[0]["bobin"], FALSE);
            $this->db->set("payung","payung - ".$arrDataTDPP[0]["payung"], FALSE);
            $this->db->set("payung_kuning","payung_kuning - ".$arrDataTDPP[0]["payung_kuning"], FALSE);
            $this->db->where("kd_gd_roll",$arrDataTDPP[0]["kd_gd_roll"]);
          }
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

    public function updateDeleteAndRestoreSisaPotong($param){
      $this->db->trans_begin();
      $QCheckTDPP = "SELECT kd_gd_roll, kd_potong, jns_permintaan, tgl_sisa, tgl_potong,
                            status, berat, bobin, payung, payung_kuning
                     FROM transaksi_detail_pengambilan_potong
                     WHERE id='$param[idTransaksi]'
                     AND deleted='FALSE'";
      $arrDataTDPP = $this->db->query($QCheckTDPP)->result_array();

      $periodeLock = date("m",strtotime($arrDataTDPP[0]["tgl_sisa"]));
      $jnsPermintaan = $arrDataTDPP[0]["jns_permintaan"];

      $QCheckLock = "SELECT COUNT(id) AS counter FROM transaksi_gudang_roll
                     WHERE status_lock='TRUE'
                     AND jns_permintaan='$jnsPermintaan'
                     AND DATE_FORMAT(tgl_transaksi,'%m') = '$periodeLock'
                     AND deleted='FALSE'";
      $arrDataLock = $this->db->query($QCheckLock)->result_array();
      if($arrDataLock[0]["counter"] > 0){
        $this->db->trans_rollback();
        return "Lock";
      }else{
        if($arrDataTDPP[0]["status"] == "KEMBALI KE GUDANG(SISA MESIN)"){
          $status = "KEMBALI GUDANG";
          $keteranganHistory = "OPERATOR(SISA MESIN)";
        }else if($arrDataTDPP[0]["status"] == "KEMBALI KE GUDANG(SISA SEMALAM)"){
          $status = "POTONG BESOK";
          $keteranganHistory = "OPERATOR(SISA SEMALAM)";
        }else{
          $status = "";
          $keteranganHistory = "";
        }
        $QCheckTBPR = "SELECT id FROM transaksi_berat_pengambilan_roll
                       WHERE kd_gd_roll = '".$arrDataTDPP[0]["kd_gd_roll"]."'
                       AND kd_potong = '".$arrDataTDPP[0]["kd_potong"]."'
                       AND sisa = '".$arrDataTDPP[0]["berat"]."'
                       AND bobin = '".$arrDataTDPP[0]["bobin"]."'
                       AND payung = '".$arrDataTDPP[0]["payung"]."'
                       AND payung_kuning = '".$arrDataTDPP[0]["payung_kuning"]."'
                       AND keterangan = '".$status."'
                       AND deleted='FALSE'
                       ORDER BY id DESC LIMIT 1";
        $arrDataTBPR = $this->db->query($QCheckTBPR)->result_array();

        if($keteranganHistory == "OPERATOR(SISA SEMALAM)"){
          $QCheckTGR_IN = "SELECT id FROM transaksi_gudang_roll
                           WHERE kd_gd_roll = '".$arrDataTDPP[0]["kd_gd_roll"]."'
                           AND berat = '".$arrDataTDPP[0]["berat"]."'
                           AND bobin = '".$arrDataTDPP[0]["bobin"]."'
                           AND payung = '".$arrDataTDPP[0]["payung"]."'
                           AND payung_kuning = '".$arrDataTDPP[0]["payung_kuning"]."'
                           AND keterangan_history = '".$keteranganHistory."'
                           AND status_history = 'MASUK'
                           AND deleted='FALSE'
                           ORDER BY id DESC LIMIT 1";
          $arrDataTGR_IN = $this->db->query($QCheckTGR_IN)->result_array();
          $QCheckTGR_OUT = "SELECT id FROM transaksi_gudang_roll
                            WHERE kd_gd_roll = '".$arrDataTDPP[0]["kd_gd_roll"]."'
                            AND berat = '".$arrDataTDPP[0]["berat"]."'
                            AND bobin = '".$arrDataTDPP[0]["bobin"]."'
                            AND payung = '".$arrDataTDPP[0]["payung"]."'
                            AND payung_kuning = '".$arrDataTDPP[0]["payung_kuning"]."'
                            AND keterangan_history = '".$keteranganHistory."'
                            AND status_history = 'KELUAR'
                            AND deleted='FALSE'
                            ORDER BY id DESC LIMIT 1";
          $arrDataTGR_OUT = $this->db->query($QCheckTGR_OUT)->result_array();

          $this->db->set("deleted",$param["deleted"]);
          $this->db->set("id_user",$param["idUser"]);
          $this->db->where("id",$arrDataTGR_IN[0]["id"]);
          $this->db->update("transaksi_gudang_roll");

          $this->db->set("deleted",$param["deleted"]);
          $this->db->set("id_user",$param["idUser"]);
          $this->db->where("id",$arrDataTGR_OUT[0]["id"]);
          $this->db->update("transaksi_gudang_roll");
        }else{
          $QCheckTGR_IN = "SELECT id,status_transaksi FROM transaksi_gudang_roll
                           WHERE kd_gd_roll = '".$arrDataTDPP[0]["kd_gd_roll"]."'
                           AND berat = '".$arrDataTDPP[0]["berat"]."'
                           AND bobin = '".$arrDataTDPP[0]["bobin"]."'
                           AND payung = '".$arrDataTDPP[0]["payung"]."'
                           AND payung_kuning = '".$arrDataTDPP[0]["payung_kuning"]."'
                           AND keterangan_history = '".$keteranganHistory."'
                           AND status_history = 'MASUK'
                           AND deleted='FALSE'
                           ORDER BY id DESC LIMIT 1";
          $arrDataTGR_IN = $this->db->query($QCheckTGR_IN)->result_array();
          if($arrDataTGR_IN[0]["status_transaksi"] == "FINISH"){
            if($param["deleted"] == "TRUE"){
              $this->db->set("stok","stok - ".$arrDataTDPP[0]["berat"],FALSE);
              $this->db->set("bobin","bobin - ".$arrDataTDPP[0]["bobin"],FALSE);
              $this->db->set("payung","payung - ".$arrDataTDPP[0]["payung"],FALSE);
              $this->db->set("payung_kuning","payung_kuning - ".$arrDataTDPP[0]["payung_kuning"],FALSE);
            }else{
              $this->db->set("stok","stok + ".$arrDataTDPP[0]["berat"],FALSE);
              $this->db->set("bobin","bobin + ".$arrDataTDPP[0]["bobin"],FALSE);
              $this->db->set("payung","payung + ".$arrDataTDPP[0]["payung"],FALSE);
              $this->db->set("payung_kuning","payung_kuning + ".$arrDataTDPP[0]["payung_kuning"],FALSE);
            }
            $this->db->where("kd_gd_roll",$arrDataTDPP[0]["kd_gd_roll"]);
            $this->db->update("gudang_roll");
          }
          $this->db->set("deleted",$param["deleted"]);
          $this->db->set("id_user",$param["idUser"]);
          $this->db->where("id",$arrDataTGR_IN[0]["id"]);
          $this->db->update("transaksi_gudang_roll");
        }

        $this->db->set("deleted",$param["deleted"]);
        $this->db->set("id_user",$param["idUser"]);
        $this->db->where("id",$param["idTransaksi"]);
        $this->db->update("transaksi_detail_pengambilan_potong");

        $this->db->set("deleted",$param["deleted"]);
        $this->db->set("id_user",$param["idUser"]);
        $this->db->where("id",$arrDataTBPR[0]["id"]);
        $this->db->update("transaksi_berat_pengambilan_roll");
      }
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }

  #=========================Update Function (Finish)=========================#
}

class CustomClass {
  public function hitungPanjangPlastik($param){
    if(is_array($param)){
      $jenisPipa = $param["jenisPipa"];
      $ukuran = strtoupper($param["ukuran"]);
      $panjang = strtoupper($param["panjang"]);
      $ketMerek = strtoupper($param["ketMerek"]);
      $ketBarang = strtoupper($param["ketBarang"]);
      $arrPanjang = explode("+",str_replace(" ","",str_replace(",",".",$panjang)));

      if(strpos($panjang,"PON") !== FALSE ||
         strpos($ketMerek,"PON") !== FALSE ||
         strpos($ketBarang,"PON") !== FALSE ||
         strpos($ukuran, "PON") !== FALSE
       ){
       switch (count($arrPanjang)) {
         case 2 :
           if(floatval($arrPanjang[0]) >= 20 && floatval($arrPanjang[0]) < 26.5){
             if(strpos($arrPanjang[0],"IN") !== FALSE){
               $TPanjangPlastik = ((floatval($arrPanjang[0]) * 2.54) + 5);
             }else{
               $TPanjangPlastik = (floatval($arrPanjang[0]) + 5);
             }
           }else if(floatval($arrPanjang[0]) > 26.5){
             if(strpos($arrPanjang[0],"IN") !== FALSE){
               $TPanjangPlastik = ((floatval($arrPanjang[0]) * 2.54) + 5.5);
             }else{
               $TPanjangPlastik = (floatval($arrPanjang[0]) + 5.5);
             }
           }else{
             $TPanjangPlastik = 0;
           }
         break;

         case 3 :
           if(floatval($arrPanjang[0]) >= 20 && floatval($arrPanjang[0]) < 26.5){
             if($arrPanjang[1] > 1){
               if(strpos($arrPanjang[0],"IN") !== FALSE){
                 $TPanjangPlastik = ((floatval($arrPanjang[0]) * 2.54) + (floatval($arrPanjang[0]) + 5));
               }else{
                 $TPanjangPlastik = ((floatval($arrPanjang[0])) + (floatval($arrPanjang[0]) + 5));
               }
             }else{
               if(strpos($arrPanjang[0],"IN") !== FALSE){
                 $TPanjangPlastik = ((floatval($arrPanjang[0]) * 2.54) + (floatval($arrPanjang[2]) + 5));
               }else{
                 $TPanjangPlastik = ((floatval($arrPanjang[0])) + (floatval($arrPanjang[2]) + 5));
               }
             }
           }else if(floatval($arrPanjang[0]) > 26.5){
             if($arrPanjang[1] > 1){
               if(strpos($arrPanjang[0],"IN") !== FALSE){
                 $TPanjangPlastik = ((floatval($arrPanjang[0]) * 2.54) + (floatval($arrPanjang[0]) + 5.5));
               }else{
                 $TPanjangPlastik = ((floatval($arrPanjang[0])) + (floatval($arrPanjang[0]) + 5.5));
               }
             }else{
               if(strpos($arrPanjang[0],"IN") !== FALSE){
                 $TPanjangPlastik = ((floatval($arrPanjang[0]) * 2.54) + (floatval($arrPanjang[2]) + 5.5));
               }else{
                 $TPanjangPlastik = ((floatval($arrPanjang[0])) + (floatval($arrPanjang[2]) + 5.5));
               }
             }
           }else{
             $TPanjangPlastik = 0;
           }
         break;

         default:
           $TPanjangPlastik = 0;
           break;
       }
     }else{
       switch (count($arrPanjang)) {
         case 2 :
           if(strpos($arrPanjang[0],"IN") !== FALSE){
             $TPanjangPlastik = ((floatval($arrPanjang[0]) * 2.54) + floatval($arrPanjang[1]));
           }else{
             $TPanjangPlastik = (floatval($arrPanjang[0]) + floatval($arrPanjang[1]));
           }
         break;

         case 3 :
           if(strpos($arrPanjang[0],"IN") !== FALSE){
             $TPanjangPlastik = ((floatval($arrPanjang[0]) * 2.54) + floatval($arrPanjang[1]) + floatval($arrPanjang[2]));
           }else{
             $TPanjangPlastik = (floatval($arrPanjang[0]) + floatval($arrPanjang[1]) + floatval($arrPanjang[2]));
           }
         break;

         default:
          if(strpos($arrPanjang[0],"IN") !== FALSE){
            $TPanjangPlastik = ((floatval($arrPanjang[0]) * 2.54));
          }else{
            $TPanjangPlastik = (floatval($arrPanjang[0]));
          }
        break;
       }
     }
     return $TPanjangPlastik;
    }else{
      return -1;
    }
  }

  public function hitungBeratRoll($param){
    if(is_array($param)){
      $jenisPipa = $param["jenisPipa"];
      $panjangPlastik = $param["panjangPlastik"];

      if($jenisPipa == "PAYUNG"){
        $jumlahPayung = $param["jumlahPayung"];
        if($panjangPlastik < 6){
          $rumusRoll = 5000;
        }else if($panjangPlastik >= 6 && $panjangPlastik <= 40){
          $rumusRoll = 6000;
        }else{
          $rumusRoll = 7000;
        }
        $beratRoll = $jumlahPayung * $rumusRoll;
      }else if($jenisPipa == "PAYUNG_KUNING"){
        $jumlahPayung = $param["jumlahPayungKuning"];
        if($panjangPlastik <= 40){
          $rumusRoll = 4000;
        }else{
          $rumusRoll = 5000;
        }
        $beratRoll = $jumlahPayung * $rumusRoll;
      }else if($jenisPipa == "PAYUNG_KUNING_PAYUNG"){
        $jumlahPayung = $param["jumlahPayung"];
        $jumlahPayungKuning = $param["jumlahPayungKuning"];
        if($panjangPlastik < 6){
          $rumusRoll = 5000;
        }else if($panjangPlastik >= 6 && $panjangPlastik <= 40){
          $rumusRoll = 6000;
        }else{
          $rumusRoll = 7000;
        }

        if($panjangPlastik <= 40){
          $rumusRollKuning = 4000;
        }else{
          $rumusRollKuning = 5000;
        }
        $beratRoll = ($jumlahPayung * $rumusRoll) + ($jumlahPayungKuning * $rumusRollKuning);
      }else if($jenisPipa == "BOBIN"){
        $jumlahBobin = $param["jumlahBobin"];
        $doubleSingle = $param["doubleSingle"];
        $beratRoll = ($panjangPlastik * $doubleSingle * 30 * $jumlahBobin);
      }else if($jenisPipa == "BOBIN_PAYUNG"){
        $jumlahBobin = $param["jumlahBobin"];
        $jumlahPayung = $param["jumlahPayung"];
        $doubleSingle = $param["doubleSingle"];
        if($panjangPlastik < 6){
          $rumusRoll = 5000;
        }else if($panjangPlastik >= 6 && $panjangPlastik <= 40){
          $rumusRoll = 6000;
        }else{
          $rumusRoll = 7000;
        }
        $rollPipaBobin = ($panjangPlastik * $doubleSingle * 30 * $jumlahBobin);
        $rollPipaPayung = ($jumlahPayung * $rumusRoll);
        $beratRoll = $rollPipaBobin + $rollPipaPayung;
      }else if($jenisPipa == "BOBIN_PAYUNG_KUNING"){
        $jumlahBobin = $param["jumlahBobin"];
        $jumlahPayungKuning = $param["jumlahPayungKuning"];
        $doubleSingle = $param["doubleSingle"];
        if($panjangPlastik <= 40){
          $rumusRoll = 4000;
        }else{
          $rumusRoll = 5000;
        }
        $rollPipaBobin = ($panjangPlastik * $doubleSingle * 30 * $jumlahBobin);
        $rollPipaPayungKuning = ($jumlahPayungKuning * $rumusRoll);
        $beratRoll = $rollPipaBobin + $rollPipaPayungKuning;
      }else if($jenisPipa == "BOBIN_PAYUNG_KUNING_PAYUNG"){
        $jumlahBobin = $param["jumlahBobin"];
        $jumlahPayungKuning = $param["jumlahPayungKuning"];
        $jumlahPayung = $param["jumlahPayung"];
        $doubleSingle = $param["doubleSingle"];

        if($panjangPlastik <= 40){
          $rumusRollPayungKuning = 4000;
        }else{
          $rumusRollPayungKuning = 5000;
        }

        if($panjangPlastik < 6){
          $rumusRoll = 5000;
        }else if($panjangPlastik >= 6 && $panjangPlastik <= 40){
          $rumusRoll = 6000;
        }else{
          $rumusRoll = 7000;
        }

        $rollPipaBobin = ($panjangPlastik * $doubleSingle * 30 * $jumlahBobin);
        $rollPipaPayungKuning = ($jumlahPayungKuning * $rumusRollPayungKuning);
        $rollPipaPayung = ($jumlahPayung * $rumusRoll);
        $beratRoll = $rollPipaBobin + $rollPipaPayungKuning + $rollPipaPayung;
      }else{
        $beratRoll = 0;
      }
      return $beratRoll;
    }else{
      return -1;
    }
  }

  public function hitungPlusMinus($param){
    if(is_array($param)){
      $beratPengambilan = $param["beratPengambilan"] * 1000;
      $beratPengambilanBagian = $param["beratPengambilanBagian"] * 1000;
      $beratSisaSemalam = $param["beratSisaSemalam"] * 1000;
      $beratSisaHariIni = $param["beratSisaHariIni"] * 1000;
      $beratBersih = $param["beratBersih"] * 1000;
      $beratApal = $param["beratApal"] * 1000;
      $beratRollPipa = $param["beratRollPipa"];

      $beratTotal = ($beratPengambilan + $beratPengambilanBagian + $beratSisaSemalam) - $beratSisaHariIni;
      $plusMinus = ($beratBersih + $beratApal + $beratRollPipa) - $beratTotal;
      return $plusMinus;
    }else{
      return -1;
    }
  }
}
?>
