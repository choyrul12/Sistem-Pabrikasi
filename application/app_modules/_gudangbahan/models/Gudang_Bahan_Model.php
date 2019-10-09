<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gudang_Bahan_Model extends CI_Model{
  #=========================Get Code Function (Start)=========================#
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

  public function generateGudangApalCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_gd_apal,3)) AS kode FROM gudang_apal
                                 WHERE SUBSTRING(kd_gd_apal,4,6) = DATE_FORMAT(NOW(),'%y%m%d')");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "00";
      }
      $tempCode = "00".(intval($arrMaxCode->kode)+1);
      $fixCode = "APL".date("ymd").substr($tempCode,(strlen($tempCode)-3));
    }
    return $fixCode;
  }

  public function generateGudangSparePartCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_spare_part,3)) AS kode FROM spare_part
                                 WHERE SUBSTRING(kd_spare_part,4,6) = DATE_FORMAT(NOW(),'%y%m%d')");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "00";
      }
      $tempCode = "00".(intval($arrMaxCode->kode)+1);
      $fixCode = "SPR".date("ymd").substr($tempCode,(strlen($tempCode)-3));
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

  public function generateKodePermintaanSparePart(){
    $idUser = $this->session->userdata("fabricationIdUser");
    $idUserLen = strlen($idUser);
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_permintaan_spare_part,3)) AS kode FROM transaksi_permintaan_spare_part
                                 WHERE SUBSTRING(kd_permintaan_spare_part,4,4) = DATE_FORMAT(NOW(),'%y%m')
                                 AND SUBSTRING(kd_permintaan_spare_part,8,$idUserLen)");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "00";
      }
      $tempCode = "00".(intval($arrMaxCode->kode)+1);
      $fixCode = "PRS".date("ym").$idUser.substr($tempCode,(strlen($tempCode)-3));
    }
    return $fixCode;
  }
  #=========================Get Code Function (Finish)=========================#

  #=========================Insert Function (Start)=========================#
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

  public function insertPermintaanBarang($param, $param2){
    if(array_key_exists("rowid",$param)){
      unset($param["rowid"]);
    }
    $this->db->trans_begin();
    $jumlahPermintaan = 0;
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

    if($param2 == "MINYAK"){
      $arrMinyak = array("SMT","IPA","REDUSER-SABLON-FR001");
      $QCheck = "SELECT UCASE(nm_barang) AS nm_barang FROM gudang_bahan WHERE kd_gd_bahan = '$param[kd_gd_bahan]'";
      $resultMinyak = $this->db->query($QCheck)->result_array();
      switch ($resultMinyak[0]["nm_barang"]) {
        case 'SMT'                  : $jumlahPermintaan = floatval($param["jumlah_permintaan"]) * 160;
                                      break;
        case 'IPA'                  : $jumlahPermintaan = floatval($param["jumlah_permintaan"]) * 160;
                                      break;
        case 'REDUSER-SABLON-FR001' : $jumlahPermintaan = floatval($param["jumlah_permintaan"]) * 15;
                                      break;

        default: $jumlahPermintaan = floatval($param["jumlah_permintaan"]) * 170;
          break;
      }
    }else{
      $jumlahPermintaan = $param["jumlah_permintaan"];
    }
    $this->db->set("kd_permintaan_barang",$param["kd_permintaan"]);
    $this->db->set("kd_gd_bahan",$param["kd_gd_bahan"]);
    $this->db->set("jumlah_permintaan",$jumlahPermintaan);
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

  public function insertTransaksiPermintaanSparePart($param){
    if(array_key_exists("rowid",$param)){
      unset($param["rowid"]);
    }
    $this->db->trans_begin();
    $checkTransaksi = $this->db->query("SELECT kd_permintaan_spare_part
                                        FROM transaksi_permintaan_spare_part
                                        WHERE kd_permintaan_spare_part='$param[kd_permintaan_spare_part]'")->num_rows();
    if($checkTransaksi <= 0){
      $this->db->set("kd_permintaan_spare_part",$param["kd_permintaan_spare_part"]);
      $this->db->set("id_user",$param["id_user"]);
      $this->db->set("tgl_permintaan",$param["tgl_permintaan"]);
      $this->db->set("bagian",$param["bagian"]);
      $this->db->insert("transaksi_permintaan_spare_part");
    }

    $this->db->set("kd_permintaan_spare_part",$param["kd_permintaan_spare_part"]);
    $this->db->set("kd_spare_part",$param["kd_spare_part"]);
    $this->db->set("jumlah_permintaan",$param["jumlah_permintaan"]);
    $this->db->set("keterangan",$param["keterangan"]);
    $this->db->insert("transaksi_detail_permintaan_spare_part");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }

  }

  public function insertGudangApal($param){
    $this->db->trans_begin();
    $this->db->insert("gudang_apal",$param);
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertTransaksiGudangApal($param){
    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(status_lock) AS count_lock FROM transaksi_detail_history_apal
                                   WHERE YEAR(tgl_transaksi)=YEAR('$param[tgl_transaksi]')
                                   AND MONTH(tgl_transaksi)=MONTH('$param[tgl_transaksi]')
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["count_lock"] > 0){
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

  public function insertTransaksiSparePart($param){
    $this->db->trans_begin();
    $checkLock = $this->db->query("SELECT COUNT(status_lock) AS count_lock FROM transaksi_detail_spare_part
                                   WHERE YEAR(tgl_transaksi)=YEAR('$param[tgl_transaksi]')
                                   AND MONTH(tgl_transaksi)=MONTH('$param[tgl_transaksi]')
                                   AND status_lock='TRUE'")->result_array();
    if($checkLock[0]["count_lock"] > 0){
      return "Lock";
    }else{
      $this->db->insert("transaksi_detail_spare_part",$param);
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }
  }

  public function insertGudangSparePart($param){
    $this->db->trans_begin();
    $this->db->query("INSERT INTO spare_part(kd_spare_part,id_user,kd_accurate,nm_spare_part,kode,ukuran,stok,stok_aktual,tgl_masuk)
                      VALUES('$param[kd_spare_part]','$param[id_user]','$param[kd_accurate]','$param[nm_spare_part]',
                             '$param[kode]','$param[ukuran]','$param[stok]','$param[stok]','$param[tgl_masuk]')");

    $this->db->query("INSERT INTO transaksi_detail_spare_part(kd_spare_part,id_user,tgl_transaksi,jumlah,keterangan_history,sts_history,sts_transaksi,status_lock)
                      VALUES ('$param[kd_spare_part]','$param[id_user]','$param[tgl_masuk]','$param[stok]',
                              '$param[keterangan_history]','$param[sts_history]','$param[sts_transaksi]','TRUE')");
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
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

  public function insertDataAwalSparePartPending($param){
    $this->db->trans_begin();
    // $Q = "SELECT COUNT(status_lock) AS Counter
    //       FROM transaksi_detail_spare_part
    //       WHERE deleted='FALSE'
    //       AND status_lock='TRUE'";
    // $checkLock = $this->db->query($Q)->result_array();
    // if($checkLock[0]["Counter"] > 0){
    //
    // }else{
        $this->db->insert("transaksi_detail_spare_part",$param);
    // }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }

  }
  #=========================Insert Function (Finish)=========================#

  #=========================Select Function (Start)=========================#
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

  public function selectComboBoxValueApal(){
    $result = $this->db->query("SELECT * FROM gudang_apal WHERE deleted='FALSE' LIMIT 20");
    return json_encode($result->result_array());
  }

  public function selectComboBoxValueApalSearch($param){
    $result = $this->db->query("SELECT * FROM gudang_apal WHERE kd_gd_apal LIKE '%$param%' OR
                                jenis LIKE '%$param%' OR sub_jenis LIKE '%$param%' AND deleted='FALSE'");
    return json_encode($result->result_array());
  }

  public function selectDetailBarangBahan($param){
    $result = $this->db->query("SELECT * FROM gudang_bahan WHERE kd_gd_bahan='$param' AND deleted = 'FALSE'");
    return json_encode($result->result_array());
  }

  public function selectListGudangBahanDatatable($param){
    $this->datatables->select("kd_gd_bahan,kd_accurate,nm_barang,CONCAT(stok,' ',satuan) AS stok,warna");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("deleted='FALSE' AND jenis=",$param);
    return $this->datatables->generate();
  }

  public function selectListTrashGudangBahanDatatable(){
    $this->datatables->select("kd_gd_bahan,kd_accurate,nm_barang,CONCAT(stok,' ',satuan) AS stok,warna,jenis");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("deleted='TRUE'");
    return $this->datatables->generate();
  }

  public function selectListTrashSparePartDatatable(){
    $this->datatables->select("kd_spare_part,kd_accurate,nm_spare_part,stok,stok_aktual,ukuran");
    $this->datatables->from("spare_part");
    $this->datatables->where("deleted='TRUE'");
    return $this->datatables->generate();
  }

  public function selectListTrashTransaksiGudangBahanDatatable(){
    $this->datatables->select("TGB.id,TGB.kd_gd_bahan,TGB.tgl_permintaan,GB.nm_barang,TGB.jumlah_permintaan,TGB.keterangan_history,TGB.status_history");
    $this->datatables->from("transaksi_gudang_bahan TGB");
    $this->datatables->join("gudang_bahan GB","TGB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->where("TGB.deleted='TRUE'");
    return $this->datatables->generate();
  }

  public function selectListTrashTransaksiGudangApalDatatable(){
    $this->datatables->select("TDHA.id,TDHA.kd_gd_apal,TDHA.tgl_transaksi,TDHA.nama,TDHA.jumlah_apal,TDHA.keterangan_history,TDHA.status_history,GA.jenis,GA.sub_jenis");
    $this->datatables->from("transaksi_detail_history_apal TDHA");
    $this->datatables->join("gudang_apal GA","TDHA.kd_gd_apal = GA.kd_gd_apal","INNER");
    $this->datatables->where("TDHA.deleted='TRUE'");
    return $this->datatables->generate();
  }

  public function selectListTrashTransaksiSparePartDatatable(){
    $this->datatables->select("TDSP.id,TDSP.tgl_transaksi,TDSP.kd_spare_part,TDSP.jumlah,TDSP.keterangan_history,TDSP.sts_history,SP.nm_spare_part");
    $this->datatables->from("transaksi_detail_spare_part TDSP");
    $this->datatables->join("spare_part SP","TDSP.kd_spare_part = SP.kd_spare_part","INNER");
    $this->datatables->where("TDSP.deleted='TRUE'");
    return $this->datatables->generate();
  }

  public function selectCountTrashGudangBahan($param){
    $this->db->select("COUNT(kd_gd_bahan) AS jumlah");
    $this->db->where("deleted=",$param);
    $this->db->from("gudang_bahan");
    $result = $this->db->get();
    return $result->result_array();
  }

  public function selectCountTrashGudangSparePart($param){
    $this->db->select("COUNT(kd_spare_part) AS jumlah");
    $this->db->where("deleted=",$param);
    $this->db->from("spare_part");
    $result = $this->db->get();
    return $result->result_array();
  }

  public function selectCountTrashTransaksiGudangBahan($param){
    $this->db->select("COUNT(id) AS jumlah");
    $this->db->where("deleted=",$param);
    $this->db->from("transaksi_gudang_bahan");
    $result = $this->db->get();
    return $result->result_array();
  }

  public function selectCountTrashTransaksiGudangApal($param){
    $this->db->select("COUNT(id) AS jumlah");
    $this->db->where("deleted=",$param);
      $this->db->from("transaksi_detail_history_apal");
    $result = $this->db->get();
    return $result->result_array();
  }

  public function selectCountTrashTransaksiGudangSparePart($param){
    $this->db->select("COUNT(id) AS jumlah");
    $this->db->where("deleted=",$param);
    $this->db->from("transaksi_detail_spare_part");
    $result = $this->db->get();
    return $result->result_array();
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

  public function selectSaldoAwalBulanGudangApal($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $saldoAwal = $this->db->query("SELECT (
                                           SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',jumlah_apal,0))-
                                           SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',jumlah_apal,0))
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

  public function selectSaldoAwalBulanSparePart($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $saldoAwal = $this->db->query("SELECT (
                                           SUM(IF(sts_history='MASUK' AND tgl_transaksi < '$param[tglAwal]',jumlah,0))-
                                           SUM(IF(sts_history='KELUAR' AND tgl_transaksi < '$param[tglAwal]',jumlah,0))
                                          )
                                AS saldo_awal
                                FROM transaksi_detail_spare_part
                                WHERE kd_spare_part = '$param[kdSparePart]'
                                AND tgl_transaksi BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                AND deleted='FALSE'
                                AND sts_transaksi = 'FINISH'")->result_array();

    $totalPerPeriode = $this->db->query("SELECT SUM(IF(sts_history='MASUK',jumlah,0)) AS total_masuk_per_periode,
                                                SUM(IF(sts_history='KELUAR',jumlah,0)) AS total_keluar_per_periode
                                         FROM transaksi_detail_spare_part
                                         WHERE kd_spare_part = '$param[kdSparePart]'
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
                                AND TGB.bagian='GUDANG BAHAN'
                                AND SUBSTRING(TGB.keterangan_history,1,7) = 'KOREKSI'");
    return $result->result_array();
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
                                AND TGB.bagian = 'GUDANG BAHAN'
                                AND (SUBSTRING(TGB.keterangan_history,1,11) = 'PENGAMBILAN'
                                OR SUBSTRING(TGB.keterangan_history,1,11) = 'PENGELUARAN')");
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

  public function selectListGudangApalDatatable(){
    $this->datatables->select("kd_gd_apal,kd_accurate,jenis,sub_jenis,FORMAT(stok,2) stok");
    $this->datatables->from("gudang_apal");
    $this->datatables->where("deleted='FALSE'");
    $this->db->order_by("jenis","ASC");
    return $this->datatables->generate();
  }

  public function selectDetailGudangApal($param){
    $arrData = $this->db->query("SELECT * FROM gudang_apal WHERE kd_gd_apal='$param'");
    return $arrData->result_array();
  }

  public function selectPenjualanApalTemp(){
    $arrData = $this->db->query("SELECT TDHA.id,TDHA.kd_gd_apal,TDHA.tgl_transaksi,TDHA.nama,FORMAT(TDHA.jumlah_apal,2) AS jumlah_apal,
                                        GA.jenis,GA.sub_jenis,TDHA.status_history
                                 FROM transaksi_detail_history_apal TDHA
                                 INNER JOIN gudang_apal GA ON TDHA.kd_gd_apal = GA.kd_gd_apal
                                 WHERE TDHA.deleted = 'FALSE' AND
                                       GA.deleted = 'FALSE' AND
                                       TDHA.sts_transaksi = 'PENDING'AND
                                       SUBSTRING(TDHA.keterangan_history,1,14) = 'PENJUALAN APAL'");
    return json_encode($arrData->result_array());
  }

  public function selectDetailTransaksiGudangApal($param){
    $result = $this->db->query("SELECT TDHA.*, GA.jenis,GA.sub_jenis FROM transaksi_detail_history_apal TDHA
                                INNER JOIN gudang_apal GA ON TDHA.kd_gd_apal = GA.kd_gd_apal
                                WHERE TDHA.deleted='FALSE'
                                AND TDHA.id='$param'
                                AND GA.deleted='FALSE'");
    return json_encode($result->result_array());
  }

  public function selectKoreksiApalTemp(){
    $arrData = $this->db->query("SELECT TDHA.id,TDHA.kd_gd_apal,TDHA.tgl_transaksi,TDHA.nama,FORMAT(TDHA.jumlah_apal,2) AS jumlah_apal,
                                        GA.jenis,GA.sub_jenis,TDHA.status_history,TDHA.keterangan_history
                                 FROM transaksi_detail_history_apal TDHA
                                 INNER JOIN gudang_apal GA ON TDHA.kd_gd_apal = GA.kd_gd_apal
                                 WHERE TDHA.deleted = 'FALSE' AND
                                       GA.deleted = 'FALSE' AND
                                       TDHA.sts_transaksi = 'PENDING' AND
                                       SUBSTRING(TDHA.keterangan_history,1,7) = 'KOREKSI'");
    return json_encode($arrData->result_array());
  }

  public function selectDataAwalApal($param){
    $arrData = $this->db->query("SELECT TDHA.id,GA.jenis,GA.sub_jenis,TDHA.jumlah_apal,TDHA.tgl_transaksi,TDHA.kd_gd_apal
                                 FROM transaksi_detail_history_apal TDHA
                                 INNER JOIN gudang_apal GA ON TDHA.kd_gd_apal = GA.kd_gd_apal
                                 WHERE TDHA.kd_gd_apal='$param'
                                 AND TDHA.keterangan_history='DATA AWAL'")->result_array();
    return json_encode($arrData);
  }

  public function selectListSparePartDatatable(){
    $this->datatables->select("kd_spare_part,kd_accurate,nm_spare_part,stok,stok_aktual,ukuran");
    $this->datatables->from("spare_part");
    $this->datatables->where("deleted='FALSE'");
    return $this->datatables->generate();
  }

  public function selectDetailSparePart($param){
    $arrData = $this->db->query("SELECT * FROM spare_part WHERE kd_spare_part='$param'");
    return json_encode($arrData->result_array());
  }

  public function selectComboBoxValueSparePart(){
    $result = $this->db->query("SELECT * FROM spare_part WHERE deleted='FALSE' LIMIT 20");
    return json_encode($result->result_array());
  }

  public function selectComboBoxValueSparePartSearch($param){
    $result = $this->db->query("SELECT * FROM spare_part WHERE (kd_spare_part LIKE '%$param%' OR
                                nm_spare_part LIKE '%$param%' OR ukuran LIKE '%$param%' OR
                                kode LIKE '%$param%') AND deleted='FALSE'");
    return json_encode($result->result_array());
  }

  public function selectListHistorySparePart($param){
    $tglAwalPlus1 = date("Y-m-d",strtotime("+1 days",strtotime($param["tglAwal"])));
    $this->datatables->select("id,tgl_transaksi,FORMAT(jumlah,2) AS jumlah,
                              keterangan_history,sts_history,sts_transaksi,status_lock");
    $this->datatables->from("transaksi_detail_spare_part");
    $this->datatables->where("tgl_transaksi BETWEEN '$tglAwalPlus1' AND
                              '$param[tglAkhir]' AND
                              deleted='FALSE' AND
                              `sts_transaksi`='FINISH' AND
                              kd_spare_part=",$param['kdSparePart']);
    $this->db->order_by('tgl_transaksi','DESC');
    return $this->datatables->generate();
  }

  public function selectPengeluaranSparePartTemp(){
    $result = $this->db->query("SELECT TDSP.tgl_transaksi,
                                       SP.nm_spare_part,
                                       FORMAT(TDSP.jumlah,2) AS jumlah,
                                       TDSP.keterangan_history,
                                       TDSP.sts_history,
                                       TDSP.id,
                                       TDSP.kd_spare_part
                                FROM transaksi_detail_spare_part TDSP
                                INNER JOIN spare_part SP ON TDSP.kd_spare_part = SP.kd_spare_part
                                WHERE TDSP.`sts_transaksi` = 'PENDING'
                                AND TDSP.deleted = 'FALSE'
                                AND SP.deleted = 'FALSE'
                                AND SUBSTRING(TDSP.keterangan_history,1,11) = 'PENGELUARAN'");
    return $result->result_array();
  }

  public function selectDetailTransaksiSparePart($param){
    $result = $this->db->query("SELECT TDSP.*,SP.nm_spare_part FROM transaksi_detail_spare_part TDSP
                                INNER JOIN spare_part SP ON TDSP.kd_spare_part = SP.kd_spare_part
                                WHERE TDSP.id='$param'");
    return json_encode($result->result_array());
  }

  public function selectKoreksiSparePartTemp(){
    $result = $this->db->query("SELECT TDSP.tgl_transaksi,
                                       SP.nm_spare_part,
                                       FORMAT(TDSP.jumlah,2) AS jumlah,
                                       TDSP.keterangan_history,
                                       TDSP.sts_history,
                                       TDSP.id,
                                       TDSP.kd_spare_part
                                FROM transaksi_detail_spare_part TDSP
                                INNER JOIN spare_part SP ON TDSP.kd_spare_part = SP.kd_spare_part
                                WHERE TDSP.`sts_transaksi` = 'PENDING'
                                AND TDSP.deleted = 'FALSE'
                                AND SP.deleted = 'FALSE'
                                AND SUBSTRING(TDSP.keterangan_history,1,7) = 'KOREKSI'");
    return $result->result_array();
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

  public function selectTransaksiGudangApalForApproveDataTable(){
    $this->datatables->select("TDHA.tgl_transaksi,GA.jenis,GA.sub_jenis,FORMAT(TDHA.jumlah_apal,2) jumlah_apal,TDHA.id, TDHA.bagian, TDHA.status_history");
    $this->datatables->from("transaksi_detail_history_apal TDHA");
    $this->datatables->join("gudang_apal GA","TDHA.kd_gd_apal = GA.kd_gd_apal","INNER");
    $this->datatables->where("TDHA.sts_transaksi='PROGRESS' AND TDHA.keterangan_history='KIRIMAN APAL' AND TDHA.deleted='FALSE' AND GA.deleted='FALSE'");
    $this->db->order_by("TDHA.bagian","ASC");
    return $this->datatables->generate();
  }

  public function selectPembelianGudangBahanForApproveDataTable($param){
    $this->datatables->select("TGB.tgl_permintaan,GB.nm_barang,GB.warna,GB.jenis,FORMAT(TGB.jumlah_permintaan,2) AS jumlah_permintaan,TGB.id,TGB.status_history");
    $this->datatables->from("transaksi_gudang_bahan TGB");
    $this->datatables->join("gudang_bahan GB","TGB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->where("TGB.bagian='GUDANG BAHAN' AND TGB.status='WAITING APPROVE' AND GB.jenis='$param' AND TGB.deleted='FALSE' AND GB.deleted='FALSE'");
    return $this->datatables->generate();
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

  public function selectCountAlertApal(){
    $arrData = $this->db->query("SELECT COUNT(TDHA.id) AS Jumlah FROM transaksi_detail_history_apal TDHA
                                 INNER JOIN gudang_apal GA ON TDHA.kd_gd_apal = GA.kd_gd_apal
                                 WHERE TDHA.sts_transaksi = 'PROGRESS'
                                 AND TDHA.deleted='FALSE'
                                 AND GA.deleted='FALSE'");
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

  public function selectGudangBahanPembelianForApprove($param){
    $arrData = $this->db->query("SELECT TGB.id, TGB.kd_gd_bahan, TGB.jumlah_permintaan, TGB.status_history, TGB.`status`
                                 FROM transaksi_gudang_bahan TGB
                                 INNER JOIN gudang_bahan GB ON TGB.kd_gd_bahan = GB.kd_gd_bahan
                                 WHERE TGB.bagian='GUDANG BAHAN'
                                 AND TGB.`status` = 'WAITING APPROVE'
                                 AND GB.jenis = '$param'
                                 AND TGB.keterangan_history = 'PEMBELIAN BARANG'
                                 AND TGB.deleted='FALSE'
                                 AND GB.deleted='FALSE'")->result_array();
    return $arrData;
  }

  public function selectGudangApalDataForApprove(){
    $arrData = $this->db->query("SELECT TDHA.id, TDHA.kd_gd_apal, TDHA.jumlah_apal, TDHA.status_history, TDHA.sts_transaksi
                                 FROM transaksi_detail_history_apal TDHA
                                 INNER JOIN gudang_apal GA ON TDHA.kd_gd_apal = GA.kd_gd_apal
                                 WHERE TDHA.sts_transaksi='PROGRESS'
                                 AND TDHA.keterangan_history='KIRIMAN APAL'
                                 AND TDHA.deleted='FALSE'
                                 AND GA.deleted='FALSE'")->result_array();
    return $arrData;
  }

  public function getListBonPermintaan($jenis,$tglAwal,$tglAkhir){
    $data = $this->db->query("SELECT TGB.id, TGB.kd_gd_bahan, TGB.nama, TGB.jumlah_permintaan, TGB.tgl_permintaan, GB.nm_barang, GB.satuan, GB.warna, GB.jenis FROM transaksi_gudang_bahan TGB JOIN gudang_bahan GB on TGB.kd_gd_bahan = GB.kd_gd_bahan WHERE GB.jenis = '$jenis' and TGB.tgl_permintaan BETWEEN '$tglAwal' and '$tglAkhir' and TGB.deleted = 'FALSE' and TGB.status = 'PENDING'")->result_array();
    return json_encode($data);
  }

  public function getListBonPermintaanSP($jenis,$tglAwal,$tglAkhir){
    $data = $this->db->query("SELECT TDSP.id, TDSP.kd_spare_part, TDSP.tgl_transaksi, TDSP.jumlah, TDSP.tgl_transaksi, SP.nm_spare_part, SP.ukuran FROM transaksi_detail_spare_part TDSP JOIN spare_part SP on TDSP.kd_spare_part = SP.kd_spare_part WHERE TDSP.tgl_transaksi BETWEEN '$tglAwal' and '$tglAkhir' and TDSP.deleted = 'FALSE' and TDSP.sts_transaksi = 'PENDING'")->result_array();
    return json_encode($data);
  }

  public function selectPermintaanBarang($param){
    $this->datatables->select("TPB.kd_permintaan_barang, TPB.tgl_permintaan, TPB.status_permintaan, USR.username");
    $this->datatables->from("transaksi_permintaan_barang TPB");
    $this->datatables->join("users USR","TPB.id_user = USR.id_user","INNER");
    $this->datatables->where("TPB.bagian IN ('$param[bagian]','PURCHASING') AND
                              TPB.deleted = 'FALSE' AND
                              TPB.status_permintaan NOT IN ('FINISH')");
    $this->db->order_by("TPB.tgl_permintaan","DESC");
    return $this->datatables->generate();
  }

  public function selectPermintaanSparePart($param){
    $this->datatables->select("TPB.kd_permintaan_spare_part, TPB.tgl_permintaan, TPB.status_permintaan, USR.username");
    $this->datatables->from("transaksi_permintaan_spare_part TPB");
    $this->datatables->join("users USR","TPB.id_user = USR.id_user","INNER");
    $this->datatables->where("TPB.bagian IN ('$param[bagian]','PURCHASING') AND
                              TPB.deleted = 'FALSE' AND
                              TPB.status_permintaan NOT IN ('FINISH')");
    $this->db->order_by("TPB.tgl_permintaan","DESC");
    return $this->datatables->generate();
  }

  public function selectDetailPermintaanBaru($param){
    $this->datatables->select("GB.nm_barang, GB.warna, TDPB.jumlah_permintaan, (TDPB.jumlah_permintaan - TDPB.jumlah_terima) AS sisa,
                               TDPB.keterangan, TDPB.status_permintaan, TDPB.id_dpb, GB.jenis,
                               TDPB.kd_permintaan_barang, TDPB.keterangan_purchasing, TPB.tgl_permintaan");
    $this->datatables->from("transaksi_detail_permintaan_barang TDPB");
    $this->datatables->join("gudang_bahan GB","TDPB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->join("transaksi_permintaan_barang TPB","TDPB.kd_permintaan_barang = TPB.kd_permintaan_barang","INNER");
    if(empty($param["idPermintaan"])){
      $this->datatables->where("TPB.bagian IN ('$param[bagian]','PURCHASING') AND
                                TDPB.deleted='FALSE' AND
                                TDPB.status_permintaan NOT IN('FINISH') AND
                                GB.deleted='FALSE'");
    }else{
      $this->datatables->where("TPB.bagian IN ('$param[bagian]','PURCHASING') AND
                                TPB.kd_permintaan_barang = '$param[idPermintaan]' AND
                                TDPB.deleted='FALSE' AND
                                TDPB.status_permintaan NOT IN('FINISH') AND
                                GB.deleted='FALSE'");
    }
    $this->db->order_by("TPB.tgl_permintaan","DESC");
    return $this->datatables->generate();
  }

  public function selectDetailPermintaanSparePartBaru($param){
    $this->datatables->select("GB.nm_spare_part, GB.ukuran, TDPB.jumlah_permintaan, (TDPB.jumlah_permintaan - TDPB.jumlah_terima) AS sisa,
                               TDPB.keterangan, TDPB.status_permintaan, TDPB.id_dpsp,
                               TDPB.kd_permintaan_spare_part, TDPB.keterangan_purchasing, TPB.tgl_permintaan");
    $this->datatables->from("transaksi_detail_permintaan_spare_part TDPB");
    $this->datatables->join("spare_part GB","TDPB.kd_spare_part = GB.kd_spare_part","INNER");
    $this->datatables->join("transaksi_permintaan_spare_part TPB","TDPB.kd_permintaan_spare_part = TPB.kd_permintaan_spare_part","INNER");
    if(empty($param["idPermintaan"])){
      $this->datatables->where("TPB.bagian IN ('$param[bagian]','PURCHASING') AND
                                TDPB.deleted='FALSE' AND
                                TDPB.status_permintaan NOT IN('FINISH') AND
                                GB.deleted='FALSE'");
    }else{
      $this->datatables->where("TPB.bagian IN ('$param[bagian]','PURCHASING') AND
                                TPB.kd_permintaan_spare_part = '$param[idPermintaan]' AND
                                TDPB.deleted='FALSE' AND
                                TDPB.status_permintaan NOT IN('FINISH') AND
                                GB.deleted='FALSE'");
    }
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
    $Q = "SELECT GB.nm_barang, GB.warna, TDPB.jumlah_permintaan, GB.jenis,
                 TDPB.keterangan, TDPB.status_permintaan, TDPB.id_dpb,
                 TDPB.kd_permintaan_barang
          FROM transaksi_detail_permintaan_barang TDPB
          INNER JOIN gudang_bahan GB ON TDPB.kd_gd_bahan = GB.kd_gd_bahan
          INNER JOIN transaksi_permintaan_barang TPB ON TDPB.kd_permintaan_barang = TPB.kd_permintaan_barang
          WHERE TPB.kd_permintaan_barang = '$param' AND
                TDPB.deleted='FALSE' AND
                GB.deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return $result;
  }

  public function selectPermintaanSparePart_Print($param){
    $Q = "SELECT TPB.kd_permintaan_spare_part, TPB.tgl_permintaan, TPB.status_permintaan, USR.username, TPB.bagian
          FROM transaksi_permintaan_spare_part TPB
          INNER JOIN users USR ON TPB.id_user = USR.id_user
          WHERE TPB.kd_permintaan_spare_part = '$param'";
    $result = $this->db->query($Q)->result_array();
    return $result;
  }

  public function selectDetailPermintaanSparePartBaru_Print($param){
    $Q = "SELECT GB.nm_spare_part, GB.ukuran, TDPB.jumlah_permintaan,
                 TDPB.keterangan, TDPB.status_permintaan, TDPB.id_dpsp,
                 TDPB.kd_permintaan_spare_part
          FROM transaksi_detail_permintaan_spare_part TDPB
          INNER JOIN spare_part GB ON TDPB.kd_spare_part = GB.kd_spare_part
          INNER JOIN transaksi_permintaan_spare_part TPB ON TDPB.kd_permintaan_spare_part = TPB.kd_permintaan_spare_part
          WHERE TPB.kd_permintaan_spare_part = '$param' AND
                TDPB.deleted='FALSE' AND
                GB.deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return $result;
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

  public function selectDataPermintaanUntukInputTransaksiSparePart($param){
    $Q = "SELECT TDPSP.kd_spare_part, (TDPSP.jumlah_permintaan - TDPSP.jumlah_terima) AS jumlah_permintaan
          FROM transaksi_detail_permintaan_spare_part TDPSP
          INNER JOIN transaksi_permintaan_spare_part TPSP ON TDPSP.kd_permintaan_spare_part = TPSP.kd_permintaan_spare_part
          WHERE TDPSP.id_dpsp = '$param'
          AND TDPSP.deleted='FALSE'
          AND TPSP.deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return $result;
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

  public function selectDetailDataAwalPending($param){
    $Q = "SELECT * FROM transaksi_gudang_bahan
          WHERE id = '$param'
          AND deleted = 'FALSE'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
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

  public function selectListDataAwalSparePartPending($param){
    $Q = "SELECT TDSP.id, CONCAT(SP.nm_spare_part,' ',SP.ukuran) AS nm_spare_part, TDSP.jumlah, TDSP.kd_spare_part
          FROM transaksi_detail_spare_part TDSP
          INNER JOIN spare_part SP ON TDSP.kd_spare_part = SP.kd_spare_part
          WHERE TDSP.deleted='FALSE'
          AND SP.deleted='FALSE'
          AND TDSP.keterangan_history='DATA AWAL'
          AND TDSP.sts_transaksi = 'PENDING'
          AND TDSP.sts_history = 'MASUK'
          AND TDSP.id_user = '$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectDetailDataAwalSparePart($param){
    $Q = "SELECT * FROM transaksi_detail_spare_part
          WHERE kd_spare_part = '$param'
          AND keterangan_history = 'DATA AWAL'
          AND sts_history='MASUK'
          AND sts_transaksi='FINISH'
          AND deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }
  #=========================Select Function (Finish)=========================#

  #=========================Update Function (Start)=========================#
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

  public function updateGudangApal($param){
    $this->db->trans_begin();
    $this->db->where("kd_gd_apal",$param["kd_gd_apal"]);
    $this->db->update("gudang_apal",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateSparePart($param){
    $this->db->trans_begin();
    $this->db->where("kd_spare_part",$param["kd_spare_part"]);
    $this->db->update("spare_part",$param);
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

  public function updateTransaksiGudangApal($param){
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

  public function updateTransaksiSparePart($param){
    $this->db->trans_begin();
    $this->db->where("id",$param["id"]);
    $this->db->update("transaksi_detail_spare_part",$param);
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

  public function updateTransaksiGudangApalAndStok($param){
    $this->db->trans_begin();
    $this->db->query("UPDATE transaksi_detail_history_apal SET sts_transaksi='$param[status]'
                      WHERE id='$param[id]'");
    if($param["statusHistory"] == "MASUK"){
      $this->db->query("UPDATE gudang_apal SET stok = stok + $param[jumlah]
                        WHERE kd_gd_apal = '$param[kdGdApal]'");
    }else{
      $this->db->query("UPDATE gudang_apal SET stok = stok - $param[jumlah]
                        WHERE kd_gd_apal = '$param[kdGdApal]'");
    }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function updateTransaksiSparePartAndStok($param){
    $this->db->trans_begin();
    $this->db->query("UPDATE transaksi_detail_spare_part SET sts_transaksi='$param[status]'
                      WHERE id='$param[id]'");
    if($param["statusHistory"] == "MASUK"){
      $this->db->query("UPDATE spare_part SET stok = stok + $param[jumlah]
                        WHERE kd_spare_part = '$param[kdSparePart]'");
    }else{
      $this->db->query("UPDATE spare_part SET stok = stok - $param[jumlah]
                        WHERE kd_spare_part = '$param[kdSparePart]'");
    }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
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

  function countPermintaanMinyakSablon(){
    $data = $this->db->query("SELECT a.id FROM transaksi_gudang_bahan a
                              JOIN gudang_bahan b ON a.kd_gd_bahan = b.kd_gd_bahan
                              WHERE (a.bagian ='SABLON'
                              AND a.status = 'WAITING APPROVE'
                              AND a.status_history = 'KELUAR'
                              AND a.keterangan_history = 'PENGELUARAN KE SABLON'
                              AND a.deleted='FALSE'
                              AND b.jenis = 'Minyak')
                              OR (a.bagian ='SABLON'
                              AND a.status = 'WAITING APPROVE'
                              AND a.status_history = 'KELUAR'
                              AND a.keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))'
                              AND a.deleted='FALSE'
                              AND b.jenis = 'Minyak')");
    return $data->num_rows();
  }

  public function getDataPermintaanBahanSablon($jenis){
    $data = $this->db->query("SELECT a.id, a.kd_gd_bahan, a.jumlah_permintaan,
                                     a.tgl_permintaan, b.nm_barang, b.warna, b.jenis
                              FROM transaksi_gudang_bahan a
                              JOIN gudang_bahan b ON a.kd_gd_bahan = b.kd_gd_bahan
                              WHERE (a.bagian ='SABLON'
                              AND a.status = 'WAITING APPROVE'
                              AND a.status_history = 'KELUAR'
                              AND a.keterangan_history = 'PENGELUARAN KE SABLON'
                              AND a.deleted='FALSE'
                              AND b.jenis = '$jenis')
                              OR (a.bagian ='SABLON'
                              AND a.status = 'WAITING APPROVE'
                              AND a.status_history = 'KELUAR'
                              AND a.keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))' and a.deleted='FALSE' and b.jenis = '$jenis')")->result_array();
    return json_encode($data);
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

  public function approvePermintaanBahanSablon($jenis){
    $this->db->trans_begin();

    $data = $this->db->query("select  a.kd_gd_bahan, a.jumlah_permintaan from transaksi_gudang_bahan a join gudang_bahan b on a.kd_gd_bahan = b.kd_gd_bahan where (a.bagian ='SABLON' and a.status = 'WAITING APPROVE' and a.status_history = 'KELUAR' and a.keterangan_history = 'PENGELUARAN KE SABLON' and a.deleted='FALSE' and b.jenis = '$jenis') or (a.bagian ='SABLON' and a.status = 'WAITING APPROVE' and a.status_history = 'KELUAR' and a.keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))' and a.deleted='FALSE' and b.jenis = '$jenis')");

    foreach ($data->result_array() as $value) {
      $this->db->set("stok","`stok`-$value[jumlah_permintaan]",FALSE);
      $this->db->where("kd_gd_bahan",$value["kd_gd_bahan"]);
      $this->db->update("gudang_bahan");
    }

    $this->db->query("update transaksi_gudang_bahan a join gudang_bahan b on a.kd_gd_bahan = b.kd_gd_bahan set a.status = 'FINISH' where (a.bagian ='SABLON' and a.status = 'WAITING APPROVE' and a.status_history = 'KELUAR' and a.keterangan_history = 'PENGELUARAN KE SABLON' and a.deleted='FALSE' and b.jenis = '$jenis') or (a.bagian ='SABLON' and a.status = 'WAITING APPROVE' and a.status_history = 'KELUAR' and a.keterangan_history = 'PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))' and a.deleted='FALSE' and b.jenis = '$jenis')");

    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
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

  public function updateDeleteAndRestorePermintaanSparePart($param){
    $this->db->trans_begin();
    $this->db->where("kd_permintaan_spare_part",$param["kd_permintaan_spare_part"]);
    $this->db->update("transaksi_permintaan_spare_part",$param);

    $this->db->where("kd_permintaan_spare_part",$param["kd_permintaan_spare_part"]);
    $this->db->update("transaksi_detail_permintaan_spare_part",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function updateDeleteAndRestoreDetailPermintaanBarang($param){
    $this->db->trans_begin();
    $this->db->set("deleted",$param["deleted"]);
    $this->db->where("id_dpb",$param["idTransaksi"]);
    $this->db->update("transaksi_detail_permintaan_barang");

    $Q = "SELECT COUNT(id_dpb) AS counter
          FROM transaksi_detail_permintaan_barang
          WHERE kd_permintaan_barang = '$param[kdPermintaan]'
          AND deleted='TRUE'";

    $Q2 = "SELECT COUNT(id_dpb) AS counter
           FROM transaksi_detail_permintaan_barang
           WHERE kd_permintaan_barang = '$param[kdPermintaan]'
           AND deleted='FALSE'";
    $arrCounter1 = $this->db->query($Q)->result_array();
    $arrCounter2 = $this->db->query($Q2)->result_array();
    if($arrCounter1[0]["counter"] >= $arrCounter2[0]["counter"]){
      $this->db->set("deleted",$param["deleted"]);
      $this->db->where("kd_permintaan_barang",$param["kdPermintaan"]);
      $this->db->update("transaksi_permintaan_barang");
    }else if($arrCounter2[0]["counter"] >= $arrCounter1[0]["counter"]){
      $this->db->set("deleted",$param["deleted"]);
      $this->db->where("kd_permintaan_barang",$param["kdPermintaan"]);
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

  public function updateDeleteAndRestoreDetailPermintaanSparePart($param){
    $this->db->trans_begin();
    $this->db->set("deleted",$param["deleted"]);
    $this->db->where("id_dpsp",$param["idTransaksi"]);
    $this->db->update("transaksi_detail_permintaan_spare_part");

    $Q = "SELECT COUNT(id_dpsp) AS counter
          FROM transaksi_detail_permintaan_spare_part
          WHERE kd_permintaan_spare_part = '$param[kdPermintaan]'
          AND deleted='TRUE'";

    $Q2 = "SELECT COUNT(id_dpsp) AS counter
           FROM transaksi_detail_permintaan_spare_part
           WHERE kd_permintaan_spare_part = '$param[kdPermintaan]'
           AND deleted='FALSE'";
    $arrCounter1 = $this->db->query($Q)->result_array();
    $arrCounter2 = $this->db->query($Q2)->result_array();
    if($arrCounter1[0]["counter"] >= $arrCounter2[0]["counter"]){
      $this->db->set("deleted",$param["deleted"]);
      $this->db->where("kd_permintaan_spare_part",$param["kdPermintaan"]);
      $this->db->update("transaksi_permintaan_spare_part");
    }else if($arrCounter2[0]["counter"] >= $arrCounter1[0]["counter"]){
      $this->db->set("deleted",$param["deleted"]);
      $this->db->where("kd_permintaan_spare_part",$param["kdPermintaan"]);
      $this->db->update("transaksi_permintaan_spare_part");
    }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
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

  public function updateTerimaSparePartFull($param){
    $this->db->trans_begin();
    $QCheckLock = "SELECT COUNT(id) AS counter
                   FROM transaksi_detail_spare_part
                   WHERE MONTH(tgl_transaksi) = '".date("m",strtotime($param["TDSP"]["tgl_transaksi"]))."'
                   AND YEAR(tgl_transaksi) = '".date("Y",strtotime($param["TDSP"]["tgl_transaksi"]))."'
                   AND status_lock = 'TRUE'
                   AND deleted = 'FALSE'";
    $arrCheckLock = $this->db->query($QCheckLock)->result_array();
    if($arrCheckLock[0]["counter"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert("transaksi_detail_spare_part",$param["TDSP"]);
      $this->db->insert("transaksi_bukti_penerimaan_spare_part",$param["TBPSP"]);

      $this->db->set("stok","stok + ".$param["TDSP"]["jumlah"], FALSE);
      $this->db->where("kd_spare_part",$param["TDSP"]["kd_spare_part"]);
      $this->db->update("spare_part");

      $arrDetailPermintaan = $this->db->query("SELECT (jumlah_permintaan - jumlah_terima) AS jumlah_permintaan
                                               FROM transaksi_detail_permintaan_spare_part
                                               WHERE id_dpsp = '".$param["TDPSP"]["id_dpsp"]."'")->result_array();
      $this->db->set("status_permintaan","FINISH");
      $this->db->set("jumlah_terima","jumlah_terima + ".$arrDetailPermintaan[0]["jumlah_permintaan"], FALSE);
      $this->db->where("id_dpsp",$param["TDPSP"]["id_dpsp"]);
      $this->db->update("transaksi_detail_permintaan_spare_part");

      $QCheckTotalItemTDPSP = "SELECT COUNT(id_dpsp) AS counter
                              FROM transaksi_detail_permintaan_spare_part
                              WHERE kd_permintaan_spare_part = '".$param["TDPSP"]["kd_permintaan_spare_part"]."'
                              AND deleted='FALSE'
                              AND status_permintaan != 'CANCEL'";

      $QCheckTotalItemFinishTDPSP = "SELECT COUNT(id_dpsp) AS counter
                                    FROM transaksi_detail_permintaan_spare_part
                                    WHERE kd_permintaan_spare_part = '".$param["TDPSP"]["kd_permintaan_spare_part"]."'
                                    AND deleted='FALSE'
                                    AND status_permintaan = 'FINISH'";

      $arrTotalItemTDPSP = $this->db->query($QCheckTotalItemTDPSP)->result_array();
      $arrTotalItemFinishTDPSP = $this->db->query($QCheckTotalItemFinishTDPSP)->result_array();

      if($arrTotalItemFinishTDPSP[0]["counter"] >= $arrTotalItemTDPSP[0]["counter"]){
        $this->db->set("status_permintaan","FINISH");
        $this->db->where("kd_permintaan_spare_part",$param["TDPSP"]["kd_permintaan_spare_part"]);
        $this->db->update("transaksi_permintaan_spare_part");
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

  public function updateTerimaSparePartSetengah($param){
    $this->db->trans_begin();
    $QCheckLock = "SELECT COUNT(id) AS counter
                   FROM transaksi_detail_spare_part
                   WHERE MONTH(tgl_transaksi) = '".date("m",strtotime($param["TDSP"]["tgl_transaksi"]))."'
                   AND YEAR(tgl_transaksi) = '".date("Y",strtotime($param["TDSP"]["tgl_transaksi"]))."'
                   AND status_lock = 'TRUE'
                   AND deleted = 'FALSE'";
    $arrCheckLock = $this->db->query($QCheckLock)->result_array();
    if($arrCheckLock[0]["counter"] > 0){
      $this->db->trans_rollback();
      return "Lock";
    }else{
      $this->db->insert("transaksi_detail_spare_part",$param["TDSP"]);
      $this->db->insert("transaksi_bukti_penerimaan_spare_part",$param["TBPSP"]);

      $this->db->set("stok","stok + ".$param["TDSP"]["jumlah"], FALSE);
      $this->db->where("kd_spare_part",$param["TDSP"]["kd_spare_part"]);
      $this->db->update("spare_part");

      $arrDetailPermintaan = $this->db->query("SELECT jumlah_permintaan
                                               FROM transaksi_detail_permintaan_spare_part
                                               WHERE id_dpsp = '".$param["TDPSP"]["id_dpsp"]."'")->result_array();

      $this->db->set("jumlah_terima","jumlah_terima + ".$param["TDPSP"]["jumlah_terima"], FALSE);
      $this->db->where("id_dpsp",$param["TDPSP"]["id_dpsp"]);
      $this->db->update("transaksi_detail_permintaan_spare_part");

      $QCheckJumlahPermintaan = "SELECT IF(jumlah_terima >= jumlah_permintaan,'TRUE','FALSE') AS indikator
                                 FROM transaksi_detail_permintaan_spare_part
                                 WHERE id_dpsp = '".$param["TDPSP"]["id_dpsp"]."'";
      $arrCheckJumlahPermintaan = $this->db->query($QCheckJumlahPermintaan)->result_array();

      if($arrCheckJumlahPermintaan[0]["indikator"] == "TRUE"){
        $this->db->set("status_permintaan","FINISH");
        $this->db->where("id_dpsp",$param["TDPSP"]["id_dpsp"]);
        $this->db->update("transaksi_detail_permintaan_spare_part");
      }

      $QCheckTotalItemTDPSP = "SELECT COUNT(id_dpsp) AS counter
                              FROM transaksi_detail_permintaan_spare_part
                              WHERE kd_permintaan_spare_part = '".$param["TDPSP"]["kd_permintaan_spare_part"]."'
                              AND deleted='FALSE'
                              AND status_permintaan != 'CANCEL'";

      $QCheckTotalItemFinishTDPSP = "SELECT COUNT(id_dpsp) AS counter
                                    FROM transaksi_detail_permintaan_spare_part
                                    WHERE kd_permintaan_spare_part = '".$param["TDPSP"]["kd_permintaan_spare_part"]."'
                                    AND deleted='FALSE'
                                    AND status_permintaan = 'FINISH'";

      $arrTotalItemTDPSP = $this->db->query($QCheckTotalItemTDPSP)->result_array();
      $arrTotalItemFinishTDPSP = $this->db->query($QCheckTotalItemFinishTDPSP)->result_array();

      if($arrTotalItemFinishTDPSP[0]["counter"] >= $arrTotalItemTDPSP[0]["counter"]){
        $this->db->set("status_permintaan","FINISH");
        $this->db->where("kd_permintaan_spare_part",$param["TDPSP"]["kd_permintaan_spare_part"]);
        $this->db->update("transaksi_permintaan_spare_part");
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

  public function updateSelesaiPermintaanSparePart($param){
    $this->db->trans_begin();
    $this->db->set("status_permintaan","FINISH");
    $this->db->where("id_dpsp",$param["id_dpsp"]);
    $this->db->update("transaksi_detail_permintaan_spare_part");

    $QCheckTotalItemTDPSP = "SELECT COUNT(id_dpsp) AS counter
                            FROM transaksi_detail_permintaan_spare_part
                            WHERE kd_permintaan_spare_part = '$param[kd_permintaan_spare_part]'
                            AND deleted='FALSE'
                            AND status_permintaan != 'CANCEL'";

    $QCheckTotalItemFinishTDPSP = "SELECT COUNT(id_dpsp) AS counter
                                  FROM transaksi_detail_permintaan_spare_part
                                  WHERE kd_permintaan_spare_part = '$param[kd_permintaan_spare_part]'
                                  AND deleted='FALSE'
                                  AND status_permintaan = 'FINISH'";

    $arrTotalItemTDPSP = $this->db->query($QCheckTotalItemTDPSP)->result_array();
    $arrTotalItemFinishTDPSP = $this->db->query($QCheckTotalItemFinishTDPSP)->result_array();

    if($arrTotalItemFinishTDPSP[0]["counter"] >= $arrTotalItemTDPSP[0]["counter"]){
      $this->db->set("status_permintaan","FINISH");
      $this->db->where("kd_permintaan_spare_part",$param["kd_permintaan_spare_part"]);
      $this->db->update("transaksi_permintaan_spare_part");
    }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
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

  public function updateStokDataAwalSparePartBaru($param){
    $this->db->trans_begin();
    for ($i=0; $i < count($param); $i++) {
      $this->db->set("stok","stok + ".$param[$i]["jumlah"],FALSE);
      $this->db->where("kd_spare_part", $param[$i]["kd_spare_part"]);
      $this->db->update("spare_part");

      $this->db->set("sts_transaksi","FINISH");
      $this->db->where("sts_transaksi", "PENDING");
      $this->db->where("keterangan_history","DATA AWAL");
      $this->db->where("deleted", "FALSE");
      $this->db->where("kd_spare_part", $param[$i]["kd_spare_part"]);
      $this->db->update("transaksi_detail_spare_part");
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateStokDataAwalSparePartLama($param){
    $this->db->trans_begin();
    $this->db->set("stok","stok + ".$param["jumlah"],FALSE);
    $this->db->where("kd_spare_part", $param["kd_spare_part"]);
    $this->db->update("spare_part");

    $this->db->set("jumlah",$param["jumlahBaru"]);
    $this->db->where("id",$param["id"]);
    $this->db->update("transaksi_detail_spare_part");
    if($this->db->trans_status() === FALSE){
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
