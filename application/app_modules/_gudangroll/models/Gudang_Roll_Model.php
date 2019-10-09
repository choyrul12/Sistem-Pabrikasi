<?php
class Gudang_Roll_Model extends CI_Model{
  #=========================Get Code Function (Start)=========================#
  public function generateGudangRollPolosCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_gd_roll,4)) AS kode FROM gudang_roll WHERE SUBSTRING(kd_gd_roll,1,3) = 'RLP'");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "0000";
      }
      $tempCode = "0000".(intval($arrMaxCode->kode)+1);
      $fixCode = "RLP".date("ymd").substr($tempCode,(strlen($tempCode)-4));
    }
    return $fixCode;
  }

  public function generateGudangRollCetakCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_gd_roll,4)) AS kode FROM gudang_roll WHERE SUBSTRING(kd_gd_roll,1,3) = 'RLC'");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "0000";
      }
      $tempCode = "0000".(intval($arrMaxCode->kode)+1);
      $fixCode = "RLC".date("ymd").substr($tempCode,(strlen($tempCode)-4));
    }
    return $fixCode;
  }
  #=========================Get Code Function (Finish)=========================#

  #=========================Insert Function (Start)=========================#
  public function insertGudangRoll($param){
    $arrayDiff = array("bagian","status_history","keterangan_history","keterangan_transaksi");
    $this->db->trans_begin();
    $this->db->insert("gudang_roll",array_diff_key($param,array_flip($arrayDiff)));
    $this->db->query("INSERT INTO transaksi_gudang_roll (kd_gd_roll,id_user,jns_permintaan,tgl_transaksi,bagian,keterangan_transaksi,status_history,keterangan_history,berat,bobin,payung,status_lock,status_transaksi)
                      VALUES ('$param[kd_gd_roll]','$param[id_user]','$param[jns_permintaan]','$param[tgl_buat]','$param[bagian]','$param[sts_pengambilan]','$param[status_history]',
                              '$param[keterangan_history]','$param[stok]','$param[bobin]','$param[payung]','TRUE','FINISH')");
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertTransaksiGudangRoll_DataAwal($param){
    $this->db->trans_begin();
    $this->db->insert("transaksi_gudang_roll",$param);
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertTambahSelisihBarang($data){
    $this->db->trans_begin();

    $this->db->insert("transaksi_gudang_roll",$data);

    if ($data["status_history"]=="MASUK") {
      $this->db->set("stok","`stok`+$data[berat]",FALSE);
      $this->db->set("bobin","`bobin`+$data[bobin]",FALSE);
      $this->db->set("payung","`payung`+$data[payung]",FALSE);
      $this->db->set("payung_kuning","`payung_kuning`+$data[payung_kuning]",FALSE);
      $this->db->where("kd_gd_roll",$data["kd_gd_roll"]);
      $this->db->update("gudang_roll");
    }else if($data["status_history"]=="KELUAR"){
      $this->db->set("stok","`stok`-$data[berat]",FALSE);
      $this->db->set("bobin","`bobin`-$data[bobin]",FALSE);
      $this->db->set("payung","`payung`-$data[payung]",FALSE);
      $this->db->set("payung_kuning","`payung_kuning`-$data[payung_kuning]",FALSE);
      $this->db->where("kd_gd_roll",$data["kd_gd_roll"]);
      $this->db->update("gudang_roll");
    }

    if ($this->db->trans_status()==="FALSE") {
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }
  #=========================Insert Function (Finish)=========================#

  #=========================Select Function (Start)=========================#
  public function selectComboBoxValueGudangRoll($param){
    $arrData = $this->db->query("SELECT *
                                 FROM gudang_roll
                                 WHERE jns_permintaan='$param[JnsPermintaan]'
                                 AND merek NOT LIKE '%zipper%'
                                 AND deleted = 'FALSE'
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
                                   AND merek NOT LIKE '%zipper%'
                                   AND deleted='FALSE'")->result_array();
    }else{
      $KeySplit = explode("|",$param["Key"]);
      $arrData = $this->db->query("SELECT * FROM gudang_roll WHERE jns_permintaan='$param[JnsPermintaan]'
                                   AND (ukuran LIKE '%$KeySplit[0]%' AND
                                        warna_plastik LIKE '%$KeySplit[2]%' AND
                                        merek LIKE '%$KeySplit[1]%')
                                   AND merek NOT LIKE '%zipper%'
                                   AND deleted = 'FALSE' ")->result_array();
    }
    return json_encode($arrData);
  }

  public function selectCheckDataAwal($param){
    $arrData = $this->db->query("SELECT COUNT(kd_gd_roll) AS jumlah FROM transaksi_gudang_roll WHERE kd_gd_roll='$param' AND keterangan_history='DATA AWAL'")->result_array();
    if($arrData[0]["jumlah"] > 0){
      return "Ada";
    }else{
      return "Tidak";
    }
  }

  public function selectListGudangRoll($param){
    $this->datatables->select("kd_gd_roll, kd_accurate, warna_plastik, jns_permintaan, tebal, ukuran, stok, bobin, payung, payung_kuning, merek, jns_brg");
    $this->datatables->from("gudang_roll");
    $this->datatables->where("deleted='FALSE' AND merek NOT LIKE '%zipper%' AND jns_permintaan=",$param);

    return $this->datatables->generate();
  }

  public function selectListDataAwalTemp($param){
    $result = $this->db->query("SELECT TGR.id, TGR.tgl_transaksi, TGR.berat, TGR.bobin, TGR.payung, TGR.jns_permintaan,
                                       GR.ukuran, GR.warna_plastik, GR.merek, GR.jns_brg
                                FROM transaksi_gudang_roll TGR
                                INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
                                WHERE TGR.status_transaksi='PENDING'
                                AND TGR.keterangan_history='DATA AWAL'
                                AND GR.jns_permintaan = '$param'
                                AND TGR.deleted = 'FALSE'
                                AND GR.deleted = 'FALSE'");
    return json_encode($result->result_array());
  }

  public function selectGudangRollDetail($param){
    $arrData = $this->db->query("SELECT * FROM gudang_roll WHERE kd_gd_roll='$param'")->result_array();
    return json_encode($arrData);
  }

  public function selectCountTrashGudangRoll(){
    $arrData = $this->db->query("SELECT COUNT(kd_gd_roll) AS jumlah FROM gudang_roll WHERE deleted = 'TRUE'")->result_array();
    $arrData2 = $this->db->query("SELECT COUNT(kd_gd_roll) AS jumlah FROM transaksi_gudang_roll WHERE deleted='TRUE'")->result_array();
    $data = array("Total" => $arrData[0]["jumlah"] + $arrData2[0]["jumlah"]);
    return json_encode($data);
  }

  public function selectTrashGudangRoll(){
    $this->datatables->select("kd_gd_roll, kd_accurate, jns_permintaan, warna_plastik, ukuran, merek, jns_brg");
    $this->datatables->from("gudang_roll");
    $this->datatables->where("deleted=","TRUE");

    return $this->datatables->generate();
  }

  public function selectTrashTransaksiGudangRoll(){
    $this->datatables->select("TGR.id, TGR.tgl_transaksi, TGR.bagian, TGR.keterangan_history, TGR.status_history, TGR.keterangan_transaksi,
                               TGR.berat, TGR.bobin, TGR.payung,
                               GR.ukuran, GR.merek, GR.warna_plastik");
    $this->datatables->from("transaksi_gudang_roll TGR");
    $this->datatables->join("gudang_roll GR", "TGR.kd_gd_roll = GR.kd_gd_roll", "INNER");
    $this->datatables->where("TGR.deleted='TRUE'");
    $this->db->order_by("TGR.tgl_transaksi","DESC");

    return $this->datatables->generate();
  }

  public function selectHasilJob($param){
    $this->datatables->select("THP.kd_hasil_potong,
                               GROUP_CONCAT(IF(TSHP.deleted = 'FALSE', THP.tgl_rencana, NULL) SEPARATOR '#') AS tgl_rencana,
                               GROUP_CONCAT(IF(TSHP.deleted = 'FALSE', RC.customer, NULL) SEPARATOR '#') AS customer,
                               GROUP_CONCAT(IF(TSHP.deleted = 'FALSE', RC.ukuran, NULL) SEPARATOR '#') AS ukuran,
                               GROUP_CONCAT(IF(TSHP.deleted = 'FALSE', RC.jns_permintaan, NULL) SEPARATOR '#') AS jns_permintaan,
                               GROUP_CONCAT(IF(TSHP.deleted = 'FALSE', TSHP.jumlah_lembar, NULL) SEPARATOR '#') AS jumlah_lembar,
                               RC.warna_plastik,
                               RC.merek,RC.kd_gd_roll,

                               (TPHP.berat_pengambilan_bagian + TPHP.berat_pengambilan_gudang + TPHP.berat_sisa_semalam) AS berat_pengambilan,
                               (TPHP.payung_pengambilan_bagian + TPHP.payung_pengambilan_gudang + TPHP.payung_sisa_semalam) AS payung_pengambilan,
                               (TPHP.payung_kuning_pengambilan_bagian + TPHP.payung_kuning_pengambilan_gudang + TPHP.payung_kuning_sisa_semalam) AS payung_kuning_pengambilan,
                               (TPHP.bobin_pengambilan_bagian + TPHP.bobin_pengambilan_gudang + TPHP.bobin_sisa_semalam) AS bobin_pengambilan,

                               (TPHP.berat_sisa_hari_ini) AS berat_sisa,
                               (TPHP.bobin_sisa_hari_ini) AS bobin_sisa,
                               (TPHP.payung_sisa_hari_ini) AS payung_sisa,
                               (TPHP.payung_kuning_sisa_hari_ini) AS payung_kuning_sisa,

                               THP.jumlah_apal_global, THP.jumlah_roll_pipa,
                               THP.hasil_berat_bersih, THP.plusminus");
    $this->datatables->from("transaksi_hasil_potong THP");
    $this->datatables->join("transaksi_sub_hasil_potong TSHP","TSHP.kd_hasil_potong = THP.kd_hasil_potong","INNER");
    $this->datatables->join("rencana_potong RC","TSHP.kd_potong = RC.kd_potong","INNER");
    $this->datatables->join("transaksi_pengambilan_hasil_potong TPHP","TPHP.kd_hasil_potong = THP.kd_hasil_potong","INNER");
    $this->datatables->where("THP.tgl_rencana='$param' AND THP.deleted='FALSE' AND TSHP.deleted='FALSE' AND TPHP.deleted='FALSE'");
    $this->db->group_by("SUBSTRING_INDEX(RC.ukuran,'x',1), RC.warna_plastik, RC.merek");
    $this->db->order_by("RC.merek DESC");
    return $this->datatables->generate();
  }

  public function selectCariHasilJob($param){
    $this->datatables->select("THP.kd_hasil_potong,
                               GROUP_CONCAT(IF(TSHP.deleted = 'FALSE', THP.tgl_rencana,'') SEPARATOR '#') AS tgl_rencana,
                               GROUP_CONCAT(IF(TSHP.deleted = 'FALSE', RC.customer, '') SEPARATOR '#') AS customer,
                               GROUP_CONCAT(IF(TSHP.deleted = 'FALSE', RC.ukuran, '') SEPARATOR '#') AS ukuran,
                               GROUP_CONCAT(IF(TSHP.deleted = 'FALSE', RC.jns_permintaan,'') SEPARATOR '#') AS jns_permintaan,
                               GROUP_CONCAT(IF(TSHP.deleted = 'FALSE', TSHP.jumlah_lembar,'') SEPARATOR '#') AS jumlah_lembar,
                               RC.warna_plastik,
                               RC.merek,

                               FORMAT((TPHP.berat_pengambilan_bagian + TPHP.berat_pengambilan_gudang + TPHP.berat_sisa_semalam),2) AS berat_pengambilan,
                               FORMAT((TPHP.payung_pengambilan_bagian + TPHP.payung_pengambilan_gudang + TPHP.payung_sisa_semalam),0) AS payung_pengambilan,
                               FORMAT((TPHP.payung_kuning_pengambilan_bagian + TPHP.payung_kuning_pengambilan_gudang + TPHP.payung_kuning_sisa_semalam),0) AS payung_kuning_pengambilan,
                               FORMAT((TPHP.bobin_pengambilan_bagian + TPHP.bobin_pengambilan_gudang + TPHP.bobin_sisa_semalam),0) AS bobin_pengambilan,

                               FORMAT((TPHP.berat_sisa_hari_ini),2) AS berat_sisa,
                               FORMAT((TPHP.bobin_sisa_hari_ini),0) AS bobin_sisa,
                               FORMAT((TPHP.payung_sisa_hari_ini),0) AS payung_sisa,
                               FORMAT((TPHP.payung_kuning_sisa_hari_ini),0) AS payung_kuning_sisa,

                               FORMAT(THP.jumlah_apal_global,2) AS jumlah_apal_global, FORMAT(THP.jumlah_roll_pipa,2) AS jumlah_roll_pipa,
                               FORMAT(THP.hasil_berat_bersih,2) AS hasil_berat_bersih, FORMAT(THP.plusminus,2) AS plusminus");
    $this->datatables->from("transaksi_hasil_potong THP");
    $this->datatables->join("transaksi_sub_hasil_potong TSHP","TSHP.kd_hasil_potong = THP.kd_hasil_potong","INNER");
    $this->datatables->join("rencana_potong RC","TSHP.kd_potong = RC.kd_potong","INNER");
    $this->datatables->join("transaksi_pengambilan_hasil_potong TPHP","TPHP.kd_hasil_potong = THP.kd_hasil_potong","INNER");
    if($param["jnsBrg"] == 'POLOS_CETAK'){
      $this->datatables->where("THP.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
                                AND THP.deleted='FALSE'
                                AND TPHP.deleted = 'FALSE'");
    }else{
      $this->datatables->where("THP.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
                                AND TSHP.kd_gd_roll='$param[kdGdRoll]'
                                AND THP.deleted='FALSE'
                                AND TPHP.deleted = 'FALSE'");
    }
    $this->db->group_by("SUBSTRING_INDEX(RC.ukuran,'x',1), RC.warna_plastik, RC.merek");
    $this->db->order_by("RC.merek DESC");
    return $this->datatables->generate();
  }

  public function selectListHistoryGudangRoll($param){
    $tglAwalPlus1 = date("Y-m-d", strtotime("+1 Days", strtotime($param["tglAwal"])));
    $this->datatables->select("TGR.id, TGR.tgl_transaksi, TGR.berat, TGR.payung, TGR.bobin, TGR.status_lock,
                               TGR.payung_kuning, TGR.keterangan_transaksi, TGR.keterangan_history,
                               TGR.status_history, GR.ukuran, GR.merek, GR.warna_plastik");
    $this->datatables->from("transaksi_gudang_roll TGR");
    $this->datatables->join("gudang_roll GR","TGR.kd_gd_roll = GR.kd_gd_roll","INNER");
    $this->datatables->where("TGR.deleted='FALSE'
                              AND GR.deleted='FALSE'
                              AND TGR.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                              AND TGR.kd_gd_roll = '$param[kdGdRoll]'
                              AND TGR.keterangan_history NOT IN ('HASIL CETAK')
                              AND TGR.bagian IN ('POTONG','CETAK','GUDANG ROLL')
                              AND TGR.status_transaksi='FINISH'
                              ");
    $this->db->order_by("TGR.tgl_transaksi","DESC");
    return $this->datatables->generate();
  }

  public function selectListHistoryGudangRollExtruder($param){
    $tglAwalPlus1 = date("Y-m-d", strtotime("+1 Days", strtotime($param["tglAwal"])));
    $this->datatables->select("TGR.id, TGR.tgl_transaksi, TGR.berat, TGR.payung, TGR.bobin, TGR.status_lock,
                               TGR.payung_kuning, TGR.shift, TGR.keterangan_history,
                               TGR.status_history, GR.ukuran, GR.merek, GR.warna_plastik");
    $this->datatables->from("transaksi_gudang_roll TGR");
    $this->datatables->join("gudang_roll GR","TGR.kd_gd_roll = GR.kd_gd_roll","INNER");
    $this->datatables->where("TGR.deleted='FALSE'
                              AND GR.deleted='FALSE'
                              AND TGR.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                              AND TGR.kd_gd_roll = '$param[kdGdRoll]'
                              AND TGR.bagian IN ('EXTRUDER','GUDANG ROLL') AND TGR.keterangan_history not like '%MASUK KE GUDANG%'
                              AND TGR.status_transaksi='FINISH'
                              ");
    $this->db->order_by("TGR.tgl_transaksi","DESC");
    return $this->datatables->generate();
  }

  public function selectListHistoryGudangRollPotongCetak($param){
    $tglAwalPlus1 = date("Y-m-d", strtotime("+1 Days", strtotime($param["tglAwal"])));
    $this->datatables->select("TGR.id, TGR.tgl_transaksi, TGR.berat, TGR.payung, TGR.bobin, TGR.status_lock,
                               TGR.payung_kuning, TGR.shift, TGR.keterangan_history, TGR.keterangan_transaksi,
                               TGR.status_history, GR.ukuran, GR.merek, GR.warna_plastik");
    $this->datatables->from("transaksi_gudang_roll TGR");
    $this->datatables->join("gudang_roll GR","TGR.kd_gd_roll = GR.kd_gd_roll","INNER");
    $this->datatables->where("TGR.deleted='FALSE'
                              AND GR.deleted='FALSE'
                              AND TGR.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                              AND TGR.kd_gd_roll = '$param[kdGdRoll]'
                              AND TGR.bagian IN ('CETAK','GUDANG ROLL') AND TGR.keterangan_history not like '%MASUK KE GUDANG%'
                              AND TGR.status_transaksi='FINISH'
                              ");
    $this->db->order_by("TGR.tgl_transaksi","DESC");
    return $this->datatables->generate();
  }

  public function selectSaldoGudangRoll($param){
    $tglAwalPlus1 = date("Y-m-d", strtotime("+1 Days", strtotime($param["tglAwal"])));
    $arrSaldoAwal = $this->db->query("SELECT (
                                                SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',berat,0))-
                                                SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',berat,0))
                                             )  AS saldoAwalBerat,
                                             (
                                               SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',bobin,0))-
                                               SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',bobin,0))
                                             ) AS saldoAwalBobin,
                                             (
                                               SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',payung,0))-
                                               SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',payung,0))
                                             ) AS saldoAwalPayung,
                                             (
                                               SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',payung_kuning,0))-
                                               SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',payung_kuning,0))
                                             ) AS saldoAwalPayungKuning
                                      FROM transaksi_gudang_roll
                                      WHERE kd_gd_roll='$param[kdGdRoll]'
                                      AND tgl_transaksi BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                      AND deleted='FALSE'
                                      AND status_transaksi='FINISH'")->result_array();

    $arrTotalPerPeriode = $this->db->query("SELECT SUM(IF(status_history='MASUK',berat,0)) AS totalMasukBeratPerPeriode,
                                                   SUM(IF(status_history='MASUK',bobin,0)) AS totalMasukBobinPerPeriode,
                                                   SUM(IF(status_history='MASUK',payung,0)) AS totalMasukPayungPerPeriode,
                                                   SUM(IF(status_history='MASUK',payung_kuning,0)) AS totalMasukPayungKuningPerPeriode,
                                                   SUM(IF(status_history='KELUAR',berat,0)) AS totalKeluarBeratPerPeriode,
                                                   SUM(IF(status_history='KELUAR',bobin,0)) AS totalKeluarBobinPerPeriode,
                                                   SUM(IF(status_history='KELUAR',payung,0)) AS totalKeluarPayungPerPeriode,
                                                   SUM(IF(status_history='KELUAR',payung_kuning,0)) AS totalKeluarPayungKuningPerPeriode
                                            FROM transaksi_gudang_roll
                                            WHERE kd_gd_roll='$param[kdGdRoll]'
                                            AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                                            AND deleted='FALSE'
                                            AND keterangan_history != 'DATA AWAL'
                                            AND keterangan_history NOT IN ('HASIL CETAK')
                                            AND bagian IN ('POTONG','CETAK','GUDANG ROLL') AND status_transaksi='FINISH'")->result_array();

    if(strpos($param["kdGdRoll"], "RLP") !== FALSE){
      $arrTotalPerPeriodeBagian = $this->db->query("SELECT SUM(IF(status_history='MASUK',berat,0)) AS totalMasukBeratPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',bobin,0)) AS totalMasukBobinPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',payung,0)) AS totalMasukPayungPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',payung_kuning,0)) AS totalMasukPayungKuningPerPeriodeBagian
                                                    FROM transaksi_gudang_roll
                                                    WHERE kd_gd_roll='$param[kdGdRoll]'
                                                    AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                                                    AND deleted='FALSE'
                                                    AND keterangan_history != 'DATA AWAL'
                                                    AND bagian='EXTRUDER'")->result_array();
    }else{
      $arrTotalPerPeriodeBagian = $this->db->query("SELECT SUM(IF(status_history='MASUK',berat,0)) AS totalMasukBeratPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',bobin,0)) AS totalMasukBobinPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',payung,0)) AS totalMasukPayungPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',payung_kuning,0)) AS totalMasukPayungKuningPerPeriodeBagian
                                                    FROM transaksi_gudang_roll
                                                    WHERE kd_gd_roll='$param[kdGdRoll]'
                                                    AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                                                    AND deleted='FALSE'
                                                    AND keterangan_history != 'DATA AWAL'
                                                    AND bagian='CETAK'")->result_array();
    }
    $arrDataStokMaster = $this->db->query("SELECT stok, bobin, payung, payung_kuning FROM gudang_roll WHERE kd_gd_roll='$param[kdGdRoll]'")->result_array();

    $data = array("saldoAwalBerat" => number_format($arrSaldoAwal[0]["saldoAwalBerat"],2,'.',','),
                  "saldoAwalBobin" => number_format($arrSaldoAwal[0]["saldoAwalBobin"],0,'.',','),
                  "saldoAwalPayung" => number_format($arrSaldoAwal[0]["saldoAwalPayung"],0,'.',','),
                  "saldoAwalPayungKuning" => number_format($arrSaldoAwal[0]["saldoAwalPayungKuning"],0,'.',','),
                  "saldoAkhirBerat" => number_format(($arrSaldoAwal[0]["saldoAwalBerat"] + $arrTotalPerPeriodeBagian[0]["totalMasukBeratPerPeriodeBagian"]) +
                                       ($arrTotalPerPeriode[0]["totalMasukBeratPerPeriode"] - $arrTotalPerPeriode[0]["totalKeluarBeratPerPeriode"]),2,'.',','),
                  "saldoAkhirBobin" => number_format(($arrSaldoAwal[0]["saldoAwalBobin"] + $arrTotalPerPeriodeBagian[0]["totalMasukBobinPerPeriodeBagian"]) +
                                       ($arrTotalPerPeriode[0]["totalMasukBobinPerPeriode"] - $arrTotalPerPeriode[0]["totalKeluarBobinPerPeriode"]),0,'.',','),
                  "saldoAkhirPayung" => number_format(($arrSaldoAwal[0]["saldoAwalPayung"] + $arrTotalPerPeriodeBagian[0]["totalMasukPayungPerPeriodeBagian"]) +
                                        ($arrTotalPerPeriode[0]["totalMasukPayungPerPeriode"] - $arrTotalPerPeriode[0]["totalKeluarPayungPerPeriode"]),0,'.',','),
                  "saldoAkhirPayungKuning" => number_format(($arrSaldoAwal[0]["saldoAwalPayungKuning"] + $arrTotalPerPeriodeBagian[0]["totalMasukPayungKuningPerPeriodeBagian"]) +
                                              ($arrTotalPerPeriode[0]["totalMasukPayungKuningPerPeriode"] - $arrTotalPerPeriode[0]["totalKeluarPayungKuningPerPeriode"]),0,'.',','),
                  "totalBeratMasukPerPeriode" => number_format($arrTotalPerPeriode[0]["totalMasukBeratPerPeriode"],2,'.',','),
                  "totalBobinMasukPerPeriode" => number_format($arrTotalPerPeriode[0]["totalMasukBobinPerPeriode"],0,'.',','),
                  "totalPayungMasukPerPeriode" => number_format($arrTotalPerPeriode[0]["totalMasukPayungPerPeriode"],0,'.',','),
                  "totalPayungKuningMasukPerPeriode" => number_format($arrTotalPerPeriode[0]["totalMasukPayungKuningPerPeriode"],0,'.',','),
                  "totalBeratKeluarPerPeriode" => number_format($arrTotalPerPeriode[0]["totalKeluarBeratPerPeriode"],2,'.',','),
                  "totalBobinKeluarPerPeriode" => number_format($arrTotalPerPeriode[0]["totalKeluarBobinPerPeriode"],0,'.',','),
                  "totalPayungKeluarPerPeriode" => number_format($arrTotalPerPeriode[0]["totalKeluarPayungPerPeriode"],0,'.',','),
                  "totalPayungKuningKeluarPerPeriode" => number_format($arrTotalPerPeriode[0]["totalKeluarPayungKuningPerPeriode"],0,'.',','),
                  "totalBeratMasukPerPeriodeBagian" => number_format($arrTotalPerPeriodeBagian[0]["totalMasukBeratPerPeriodeBagian"],2,'.',','),
                  "totalBobinMasukPerPeriodeBagian" => number_format($arrTotalPerPeriodeBagian[0]["totalMasukBobinPerPeriodeBagian"],0,'.',','),
                  "totalPayungMasukPerPeriodeBagian" => number_format($arrTotalPerPeriodeBagian[0]["totalMasukPayungPerPeriodeBagian"],0,'.',','),
                  "totalPayungKuningMasukPerPeriodeBagian" => number_format($arrTotalPerPeriodeBagian[0]["totalMasukPayungKuningPerPeriodeBagian"],0,'.',','),
                  "stokMasterBerat" => number_format($arrDataStokMaster[0]["stok"],2,'.',','),
                  "stokMasterBobin" => number_format($arrDataStokMaster[0]["bobin"],0,'.',','),
                  "stokMasterPayung" => number_format($arrDataStokMaster[0]["payung"],0,'.',','),
                  "stokMasterPayungKuning" => number_format($arrDataStokMaster[0]["payung_kuning"]),0,'.',',');

    return json_encode($data);
  }

  public function selectPengembalianPotong($param){
    // $this->datatables->select("GR.ukuran, GR.merek, GR.warna_plastik, GR.jns_permintaan,
    //                            TBPR.sisa, TBPR.bobin, TBPR.payung, TBPR.payung_kuning,
    //                            TBPR.tgl_sisa, TBPR.keterangan, TBPR.id");
    // $this->datatables->from("transaksi_berat_pengambilan_roll TBPR");
    // $this->datatables->join("gudang_roll GR","TBPR.kd_gd_roll = GR.kd_gd_roll","INNER");
    // $this->datatables->where("GR.jns_permintaan='$param'
    //                           AND TBPR.sts_transaksi='PROGRESS'
    //                           AND TBPR.deleted='FALSE'
    //                           AND GR.deleted='FALSE'");
    // $this->db->order_by("TBPR.tgl_sisa","DESC");
    if($param=="POLOS"){
      $clause = "IN ('MANDOR POTONG (EXTRUDER)')";
    }else{
      $clause = "IN ('MANDOR POTONG (CETAK)')";
    }
    $tglSekarang = date("Y-m-d");
    $this->datatables->select("GR.ukuran, GR.merek, GR.warna_plastik, GR.jns_permintaan,
                               TGR.berat, TGR.bobin, TGR.payung, TGR.payung_kuning,
                               TGR.tgl_transaksi, TGR.keterangan_history, TGR.id");
    $this->datatables->from("transaksi_gudang_roll TGR");
    $this->datatables->join("gudang_roll GR","TGR.kd_gd_roll = GR.kd_gd_roll","INNER");
    $this->datatables->where("(((GR.jns_permintaan='$param' OR GR.jns_permintaan='CETAK/POLOS')
                              AND TGR.status_transaksi='PROGRESS'
                              AND TGR.bagian = 'POTONG'
                              AND TGR.status_history = 'MASUK'
                              AND TGR.keterangan_history IN ('OPERATOR(SISA MESIN)','OPERATOR(SISA SEMALAM)')
                              AND TGR.deleted='FALSE'
                              AND GR.deleted='FALSE')
                              OR ((GR.jns_permintaan='$param' OR GR.jns_permintaan='CETAK/POLOS')
                              AND TGR.status_transaksi='PROGRESS'
                              AND TGR.bagian = 'POTONG'
                              AND TGR.status_history = 'KELUAR'
                              AND TGR.keterangan_history IN ('OPERATOR POTONG')
                              AND TGR.deleted='FALSE'
                              AND GR.deleted='FALSE')
                              OR ((GR.jns_permintaan='$param' OR GR.jns_permintaan='CETAK/POLOS')
                              AND TGR.status_transaksi='PROGRESS'
                              AND TGR.bagian = 'POTONG'
                              AND TGR.status_history = 'KELUAR'
                              AND TGR.keterangan_history $clause
                              AND TGR.deleted='FALSE'
                              AND GR.deleted='FALSE'))");
    $this->db->order_by("TGR.tgl_transaksi","DESC");
    return $this->datatables->generate();
  }

  public function selectSisaPotongHariIni($param){
    // $this->datatables->select("GR.ukuran, GR.merek, GR.warna_plastik, GR.jns_permintaan,
    //                            TBPR.sisa, TBPR.bobin, TBPR.payung, TBPR.payung_kuning,
    //                            TBPR.tgl_sisa, TBPR.keterangan, TBPR.id");
    // $this->datatables->from("transaksi_berat_pengambilan_roll TBPR");
    // $this->datatables->join("gudang_roll GR","TBPR.kd_gd_roll = GR.kd_gd_roll","INNER");
    // $this->datatables->where("GR.jns_permintaan='$param'
    //                           AND TBPR.sts_transaksi='PROGRESS'
    //                           AND TBPR.deleted='FALSE'
    //                           AND GR.deleted='FALSE'");
    // $this->db->order_by("TBPR.tgl_sisa","DESC");
    $tglSekarang = date("Y-m-d");
    $this->datatables->select("GR.ukuran, GR.merek, GR.warna_plastik, GR.jns_permintaan,
                               TGR.berat, TGR.bobin, TGR.payung, TGR.payung_kuning,
                               TGR.tgl_transaksi, TGR.keterangan_history, TGR.id");
    $this->datatables->from("transaksi_gudang_roll TGR");
    $this->datatables->join("gudang_roll GR","TGR.kd_gd_roll = GR.kd_gd_roll","INNER");
    $this->datatables->where("((GR.jns_permintaan='$param'
                              AND TGR.status_transaksi='PROGRESS'
                              AND TGR.bagian = 'POTONG'
                              AND TGR.status_history = 'KELUAR'
                              AND TGR.keterangan_history IN ('OPERATOR(SISA SEMALAM)')
                              AND TGR.tgl_transaksi = '$tglSekarang'
                              AND TGR.deleted='FALSE'
                              AND GR.deleted='FALSE'))");
    $this->db->order_by("TGR.tgl_transaksi","DESC");
    return $this->datatables->generate();
  }

  public function selectDetailPengembalianPotong($param){
    $result = $this->db->query("SELECT TGR.*, GR.ukuran,GR.jns_permintaan, GR.merek, GR.warna_plastik
                                FROM transaksi_gudang_roll TGR
                                INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
                                WHERE TGR.id='$param'")->result_array();
    return json_encode($result);
  }

  public function selectDetailPengambilanCetak($param){
    $result = $this->db->query("SELECT TGR.*, GR.ukuran,GR.jns_permintaan, GR.merek, GR.warna_plastik
                                FROM transaksi_gudang_roll TGR
                                INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
                                WHERE TGR.id='$param'")->result_array();
    return json_encode($result);
  }

  public function selectPengambilanCetak($param){
    $this->datatables->select("GR.ukuran, GR.merek, GR.warna_plastik, TGR.berat,
                               TGR.bobin, TGR.payung, TGR.payung_kuning, TGR.tgl_transaksi,
                               TGR.keterangan_history, TGR.id, TGR.jns_permintaan");
    $this->datatables->from("transaksi_gudang_roll TGR");
    $this->datatables->join("gudang_roll GR","TGR.kd_gd_roll = GR.kd_gd_roll","INNER");
    $this->datatables->where("TGR.jns_permintaan='$param'
                              AND TGR.bagian='CETAK'
                              AND TGR.keterangan_transaksi='KELUAR KE CETAK'
                              AND TGR.status_history='KELUAR'
                              AND TGR.status_transaksi='PROGRESS'
                              AND TGR.deleted='FALSE'
                              AND GR.deleted='FALSE'");
    $this->db->order_by("TGR.tgl_transaksi","DESC");
    return $this->datatables->generate();
  }

  public function selectHasilExtruder(){
    $this->datatables->select("TGR.kd_gd_roll, RE.tebal, THE.hasil_ukuran, THE.panjang, TGR.tgl_transaksi,
                               THE.warna_plastik, TGR.berat, TGR.bobin, TGR.payung, TGR.payung_kuning,
                               TGR.shift, THE.merek, TGR.id, THE.id_hasil_extruder");
    $this->datatables->from("transaksi_gudang_roll TGR");
    $this->datatables->join("transaksi_hasil_extruder THE","TGR.kd_gd_roll = THE.kd_gd_roll
                                                            AND TGR.tgl_transaksi = THE.tgl_rencana
                                                            AND TGR.berat = THE.jumlah_selesai
                                                            AND TGR.shift = THE.shift", "INNER");
    $this->datatables->join("rencana_extruder RE","THE.kd_extruder = RE.kd_extruder","INNER");
    $this->datatables->where("THE.deleted='FALSE' AND
                              TGR.deleted='FALSE' AND
                              RE.deleted='FALSE'AND
                              TGR.status_transaksi = 'PROGRESS' AND
                              IF(THE.jenis_roll='BOBIN',`TGR`.`bobin` = `THE`.`roll_lembar`,
                                IF(`THE`.`jenis_roll`='PAYUNG',`TGR`.`payung` = `THE`.`roll_lembar`,
                                  IF(`THE`.`jenis_roll`='PAYUNG_KUNING',`TGR`.`payung_kuning` = `THE`.`roll_lembar`,'')))");
    $this->db->order_by("TGR.tgl_transaksi DESC, FIELD(TGR.shift,'1','2','3')");
    return $this->datatables->generate();
  }

  public function selectHasilCetak(){
    $this->datatables->select("GR.ukuran, GR.merek, GR.warna_plastik,
                               TGR.berat, TGR.bobin, TGR.payung, TGR.payung_kuning, TGR.tgl_transaksi,
                               TGR.keterangan_history, TGR.id, TGR.jns_permintaan");
    $this->datatables->from("transaksi_gudang_roll TGR");
    $this->datatables->join("gudang_roll GR","TGR.kd_gd_roll = GR.kd_gd_roll","INNER");
    $this->datatables->where("TGR.deleted = 'FALSE' AND
                              TGR.status_transaksi = 'PROGRESS' AND
                              TGR.bagian = 'CETAK' AND
                              TGR.status_history = 'MASUK' AND
                              TGR.keterangan_history = 'HASIL CETAK' AND
                              TGR.keterangan_transaksi = 'MASUK DARI CETAK' AND
                              GR.deleted = 'FALSE'");
    $this->db->order_by("TGR.tgl_transaksi","DESC");
    return $this->datatables->generate();
  }

  public function selectDataRencanaForInputHasil($param){
    $currentDate = date("Y-m-d");
    $Q = "SELECT RC.*, GH.jns_brg, RP.ket_merek,
                 TSHP.kd_hasil_potong, FORMAT(TSHP.jumlah_lembar,0) as jumlah_lembar, FORMAT(TSHP.jumlah_berat,1) as jumlah_berat,
                 THP.jumlah_roll_pipa, THP.plusminus, THP.keterangan, THP.hasil_lembar,
                 THP.hasil_berat_bersih, THP.hasil_berat_kotor, THP.jumlah_apal_global,
                 FORMAT(THP.jumlah_roll_pipa,0) as jumlah_roll_pipa, THP.shift, THP.jumlah_payung, THP.jumlah_payung_kuning,
                 THP.jumlah_bobin,
                 TPHP.berat_pengambilan_gudang, TPHP.bobin_pengambilan_gudang, TPHP.payung_pengambilan_gudang,
                 TPHP.payung_kuning_pengambilan_gudang,
                 TPHP.berat_pengambilan_gudang_tumpuk, TPHP.bobin_pengambilan_gudang_tumpuk,
                 TPHP.payung_pengambilan_gudang_tumpuk, TPHP.payung_kuning_pengambilan_gudang_tumpuk
          FROM rencana_potong RC
          INNER JOIN gudang_hasil GH ON RC.kd_gd_hasil = GH.kd_gd_hasil
          INNER JOIN transaksi_history_rencana_potong THRP ON THRP.kd_potong = RC.kd_potong
          INNER JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_potong = RC.kd_potong
          INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN transaksi_pengambilan_hasil_potong TPHP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
          LEFT JOIN rencana_ppic RP ON RC.kd_ppic = RP.kd_ppic
          WHERE RC.kd_gd_roll='$param[kdGdRoll]'
          AND THP.tgl_rencana = '$param[tglRencana]'
          AND RC.deleted='FALSE'
          AND GH.deleted='FALSE'";

    $QX = "SELECT RC.*, GH.jns_brg, RP.ket_merek,
                  TSHP.kd_hasil_potong, FORMAT(TSHP.jumlah_lembar,0) as jumlah_lembar, FORMAT(TSHP.jumlah_berat,1) as jumlah_berat,
                  FORMAT(THP.jumlah_roll_pipa,0) as jumlah_roll_pipa, THP.plusminus, THP.keterangan, THP.hasil_lembar,
                  THP.hasil_berat_bersih, THP.hasil_berat_kotor, THP.jumlah_apal_global,
                  THP.jenis_roll_pipa, THP.shift, THP.jumlah_payung, THP.jumlah_bobin,
                  THP.jumlah_payung_kuning,
                  TPHP.berat_pengambilan_gudang, TPHP.bobin_pengambilan_gudang, TPHP.payung_pengambilan_gudang,
                  TPHP.payung_kuning_pengambilan_gudang,
                  TPHP.berat_pengambilan_gudang_tumpuk, TPHP.bobin_pengambilan_gudang_tumpuk,
                  TPHP.payung_pengambilan_gudang_tumpuk, TPHP.payung_kuning_pengambilan_gudang_tumpuk
           FROM rencana_potong RC
           INNER JOIN gudang_hasil GH ON RC.kd_gd_hasil = GH.kd_gd_hasil
           INNER JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_potong = RC.kd_potong
           INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
           INNER JOIN transaksi_pengambilan_hasil_potong TPHP ON TPHP.kd_hasil_potong = THP.kd_hasil_potong
           LEFT JOIN rencana_ppic RP ON RC.kd_ppic = RP.kd_ppic
           WHERE RC.kd_gd_roll='$param[kdGdRoll]'
           AND RC.tgl_rencana = '$param[tglRencana]'
           AND THP.deleted='FALSE'
           AND TPHP.deleted='FALSE'
           AND TSHP.deleted='FALSE'
           AND RC.deleted='FALSE'
           AND GH.deleted='FALSE'";
    $count = $this->db->query($Q)->num_rows();
    if($count <= 0){
      $detailRencana = $this->db->query($QX)->result_array();
    }else{
      $detailRencana = $this->db->query($Q)->result_array();
    }
    $kdPotong = $detailRencana[0]["kd_potong"];
    if($detailRencana[0]["jns_permintaan"] == "POLOS"){
      $QSumPengambilanPotong = "SELECT SUM(berat) AS jumlahBerat,
                                       SUM(bobin) AS jumlahBobin,
                                       SUM(payung) AS jumlahPayung,
                                       SUM(payung_kuning) AS jumlahPayungKuning
                                FROM transaksi_detail_pengambilan_potong
                                WHERE kd_gd_roll = '$param[kdGdRoll]'
                                AND tgl_potong = '$param[tglRencana]'
                                AND status = 'MANDOR POTONG (EXTRUDER)'
                                AND deleted = 'FALSE'";
    }else{
      $QSumPengambilanPotong = "SELECT SUM(berat) AS jumlahBerat,
                                       SUM(bobin) AS jumlahBobin,
                                       SUM(payung) AS jumlahPayung,
                                       SUM(payung_kuning) AS jumlahPayungKuning
                                FROM transaksi_detail_pengambilan_potong
                                WHERE kd_gd_roll = '$param[kdGdRoll]'
                                AND tgl_potong = '$param[tglRencana]'
                                AND status = 'MANDOR POTONG (CETAK)'
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
                                         AND TBPR.keterangan = 'POTONG BESOK'
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
                                         AND TBPR.keterangan = 'POTONG BESOK'
                                         AND GR.deleted = 'FALSE'
                                         AND TBPR.deleted = 'FALSE'";
    $pengambilanPotong = $this->db->query($QSumPengambilanPotong)->result_array();
    $sisaPengambilanPotongSemalam = $this->db->query($QSumSisaPengambilanPotongSemalam)->result_array();
    $sisaPengambilanPotongHariIni = $this->db->query($QSumSisaPengambilanPotongHariIni)->result_array();

    $result = array("DetailRencana" => $detailRencana,
                    "PengambilanPotong" => $pengambilanPotong,
                    "SisaPengambilanPotongSemalam" => $sisaPengambilanPotongSemalam,
                    "SisaPengambilanPotongHariIni" => $sisaPengambilanPotongHariIni,
                    "IdTransaksi" => $detailRencana[0]["kd_hasil_potong"]);
    return json_encode($result);
  }

  public function countPermintaanRoll($jenis){
    $data = $this->db->query("SELECT id FROM transaksi_gudang_roll TGR
                              JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
                              WHERE ((GR.jns_permintaan='$jenis'
                                      AND TGR.status_transaksi='PROGRESS'
                                      -- AND TGR.bagian = 'POTONG'
                                      AND TGR.status_history = 'KELUAR'
                                      AND TGR.keterangan_history IN ('OPERATOR POTONG','OPERATOR(SISA SEMALAM)','OPERATOR CETAK')
                                      AND TGR.deleted='FALSE'
                                      AND GR.deleted='FALSE')
                                    OR(GR.jns_permintaan='$param'
                                       AND TGR.status_transaksi='PROGRESS'
                                       AND TGR.bagian = 'POTONG'
                                       AND TGR.status_history = 'MASUK'
                                       AND TGR.keterangan_history IN ('OPERATOR(SISA MESIN)')
                                       AND TGR.deleted='FALSE'
                                       AND GR.deleted='FALSE'))");
    return $data->num_rows();
  }

  public function countHasilCetak(){
    $data = $this->db->query("SELECT id FROM transaksi_gudang_roll TGR
                              INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
                              WHERE TGR.deleted = 'FALSE'
                              AND TGR.status_transaksi = 'PROGRESS'
                              AND TGR.bagian = 'CETAK'
                              AND TGR.status_history = 'MASUK'
                              AND  TGR.keterangan_history = 'HASIL CETAK'
                              AND  TGR.keterangan_transaksi = 'MASUK DARI CETAK'
                              AND  GR.deleted = 'FALSE'");
    return $data->num_rows();
  }

  public function countHasilExtruder(){
    $data = $this->db->query("SELECT id FROM transaksi_gudang_roll TGR
                              JOIN transaksi_hasil_extruder THE ON TGR.kd_gd_roll = THE.kd_gd_roll
                                   AND TGR.tgl_transaksi = THE.tgl_rencana
                                   AND TGR.berat = THE.jumlah_selesai
                                   AND TGR.shift = THE.shift
                              JOIN rencana_extruder RE ON THE.kd_extruder = RE.kd_extruder
                              WHERE THE.deleted='FALSE'
                              AND TGR.deleted='FALSE'
                              AND RE.deleted='FALSE'
                              AND TGR.status_transaksi = 'PROGRESS'
                              AND IF(THE.jenis_roll='BOBIN',`TGR`.`bobin` = `THE`.`roll_lembar`,
                                    IF(`THE`.`jenis_roll`='PAYUNG',`TGR`.`payung` = `THE`.`roll_lembar`,
                                      IF(`THE`.`jenis_roll`='PAYUNG_KUNING',`TGR`.`payung_kuning` = `THE`.`roll_lembar`,'')))"
                              );
    return $data->num_rows();
  }

  public function selectDetailTransaksiGudangRoll($param){
    $Q = "SELECT * FROM transaksi_gudang_roll WHERE id='$param'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectDataKartuStok($param){
    $tglAwalPlus1 = date("Y-m-d", strtotime("+1 Days", strtotime($param["tglAwal"])));
    $arrSaldoAwal = $this->db->query("SELECT (
                                                SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',berat,0))-
                                                SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',berat,0))
                                             )  AS saldoAwalBerat,
                                             (
                                               SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',bobin,0))-
                                               SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',bobin,0))
                                             ) AS saldoAwalBobin,
                                             (
                                               SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',payung,0))-
                                               SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',payung,0))
                                             ) AS saldoAwalPayung,
                                             (
                                               SUM(IF(status_history='MASUK' AND tgl_transaksi <= '$param[tglAwal]',payung_kuning,0))-
                                               SUM(IF(status_history='KELUAR' AND tgl_transaksi <= '$param[tglAwal]',payung_kuning,0))
                                             ) AS saldoAwalPayungKuning,
                                             kd_gd_roll
                                      FROM transaksi_gudang_roll
                                      WHERE jns_permintaan='$param[jnsPermintaan]'
                                      AND tgl_transaksi BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                      AND deleted='FALSE'
                                      AND status_transaksi='FINISH'
                                      GROUP BY kd_gd_roll")->result_array();

    $arrTotalPerPeriode = $this->db->query("SELECT SUM(IF(status_history='MASUK',berat,0)) AS totalMasukBeratPerPeriode,
                                                   SUM(IF(status_history='MASUK',bobin,0)) AS totalMasukBobinPerPeriode,
                                                   SUM(IF(status_history='MASUK',payung,0)) AS totalMasukPayungPerPeriode,
                                                   SUM(IF(status_history='MASUK',payung_kuning,0)) AS totalMasukPayungKuningPerPeriode,
                                                   SUM(IF(status_history='KELUAR',berat,0)) AS totalKeluarBeratPerPeriode,
                                                   SUM(IF(status_history='KELUAR',bobin,0)) AS totalKeluarBobinPerPeriode,
                                                   SUM(IF(status_history='KELUAR',payung,0)) AS totalKeluarPayungPerPeriode,
                                                   SUM(IF(status_history='KELUAR',payung_kuning,0)) AS totalKeluarPayungKuningPerPeriode,
                                                   kd_gd_roll
                                            FROM transaksi_gudang_roll
                                            WHERE jns_permintaan='$param[jnsPermintaan]'
                                            AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                                            AND deleted='FALSE'
                                            AND keterangan_history != 'DATA AWAL'
                                            AND keterangan_history NOT IN ('HASIL CETAK')
                                            AND bagian IN ('POTONG','CETAK','GUDANG ROLL')
                                            AND status_transaksi='FINISH'
                                            GROUP BY kd_gd_roll")->result_array();

    if($param["jnsPermintaan"] == "POLOS"){
      $arrTotalPerPeriodeBagian = $this->db->query("SELECT SUM(IF(status_history='MASUK',berat,0)) AS totalMasukBeratPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',bobin,0)) AS totalMasukBobinPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',payung,0)) AS totalMasukPayungPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',payung_kuning,0)) AS totalMasukPayungKuningPerPeriodeBagian,
                                                           kd_gd_roll
                                                    FROM transaksi_gudang_roll
                                                    WHERE jns_permintaan='$param[jnsPermintaan]'
                                                    AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                                                    AND deleted='FALSE'
                                                    AND keterangan_history != 'DATA AWAL'
                                                    AND bagian='EXTRUDER'
                                                    GROUP BY kd_gd_roll")->result_array();
    }else{
      $arrTotalPerPeriodeBagian = $this->db->query("SELECT SUM(IF(status_history='MASUK',berat,0)) AS totalMasukBeratPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',bobin,0)) AS totalMasukBobinPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',payung,0)) AS totalMasukPayungPerPeriodeBagian,
                                                           SUM(IF(status_history='MASUK',payung_kuning,0)) AS totalMasukPayungKuningPerPeriodeBagian,
                                                           kd_gd_roll
                                                    FROM transaksi_gudang_roll
                                                    WHERE jns_permintaan='$param[jnsPermintaan]'
                                                    AND tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]'
                                                    AND deleted='FALSE'
                                                    AND keterangan_history != 'DATA AWAL'
                                                    AND bagian='CETAK'
                                                    GROUP BY kd_gd_roll")->result_array();
    }
    $arrDataStokMaster = $this->db->query("SELECT stok, bobin, payung, payung_kuning,CONCAT(ukuran, ' ', merek, ' ', warna_plastik) AS nm_barang,
                                                  kd_gd_roll
                                           FROM gudang_roll
                                           WHERE jns_permintaan='$param[jnsPermintaan]'
                                           AND deleted='FALSE'
                                           GROUP BY kd_gd_roll
                                           ORDER BY merek ASC, CAST(REPLACE(SUBSTRING_INDEX(ukuran,'+',1),'in','') AS UNSIGNED) ASC")->result_array();

    // $data = array("saldoAwalBerat" => number_format($arrSaldoAwal[0]["saldoAwalBerat"],2,'.',','),
    //               "saldoAwalBobin" => number_format($arrSaldoAwal[0]["saldoAwalBobin"],0,'.',','),
    //               "saldoAwalPayung" => number_format($arrSaldoAwal[0]["saldoAwalPayung"],0,'.',','),
    //               "saldoAwalPayungKuning" => number_format($arrSaldoAwal[0]["saldoAwalPayungKuning"],0,'.',','),
    //               "saldoAkhirBerat" => number_format(($arrSaldoAwal[0]["saldoAwalBerat"] + $arrTotalPerPeriodeBagian[0]["totalMasukBeratPerPeriodeBagian"]) +
    //                                    ($arrTotalPerPeriode[0]["totalMasukBeratPerPeriode"] - $arrTotalPerPeriode[0]["totalKeluarBeratPerPeriode"]),2,'.',','),
    //               "saldoAkhirBobin" => number_format(($arrSaldoAwal[0]["saldoAwalBobin"] + $arrTotalPerPeriodeBagian[0]["totalMasukBobinPerPeriodeBagian"]) +
    //                                    ($arrTotalPerPeriode[0]["totalMasukBobinPerPeriode"] - $arrTotalPerPeriode[0]["totalKeluarBobinPerPeriode"]),0,'.',','),
    //               "saldoAkhirPayung" => number_format(($arrSaldoAwal[0]["saldoAwalPayung"] + $arrTotalPerPeriodeBagian[0]["totalMasukPayungPerPeriodeBagian"]) +
    //                                     ($arrTotalPerPeriode[0]["totalMasukPayungPerPeriode"] - $arrTotalPerPeriode[0]["totalKeluarPayungPerPeriode"]),0,'.',','),
    //               "saldoAkhirPayungKuning" => number_format(($arrSaldoAwal[0]["saldoAwalPayungKuning"] + $arrTotalPerPeriodeBagian[0]["totalMasukPayungKuningPerPeriodeBagian"]) +
    //                                           ($arrTotalPerPeriode[0]["totalMasukPayungKuningPerPeriode"] - $arrTotalPerPeriode[0]["totalKeluarPayungKuningPerPeriode"]),0,'.',','),
    //               "totalBeratMasukPerPeriode" => number_format($arrTotalPerPeriode[0]["totalMasukBeratPerPeriode"],2,'.',','),
    //               "totalBobinMasukPerPeriode" => number_format($arrTotalPerPeriode[0]["totalMasukBobinPerPeriode"],0,'.',','),
    //               "totalPayungMasukPerPeriode" => number_format($arrTotalPerPeriode[0]["totalMasukPayungPerPeriode"],0,'.',','),
    //               "totalPayungKuningMasukPerPeriode" => number_format($arrTotalPerPeriode[0]["totalMasukPayungKuningPerPeriode"],0,'.',','),
    //               "totalBeratKeluarPerPeriode" => number_format($arrTotalPerPeriode[0]["totalKeluarBeratPerPeriode"],2,'.',','),
    //               "totalBobinKeluarPerPeriode" => number_format($arrTotalPerPeriode[0]["totalKeluarBobinPerPeriode"],0,'.',','),
    //               "totalPayungKeluarPerPeriode" => number_format($arrTotalPerPeriode[0]["totalKeluarPayungPerPeriode"],0,'.',','),
    //               "totalPayungKuningKeluarPerPeriode" => number_format($arrTotalPerPeriode[0]["totalKeluarPayungKuningPerPeriode"],0,'.',','),
    //               "totalBeratMasukPerPeriodeBagian" => number_format($arrTotalPerPeriodeBagian[0]["totalMasukBeratPerPeriodeBagian"],2,'.',','),
    //               "totalBobinMasukPerPeriodeBagian" => number_format($arrTotalPerPeriodeBagian[0]["totalMasukBobinPerPeriodeBagian"],0,'.',','),
    //               "totalPayungMasukPerPeriodeBagian" => number_format($arrTotalPerPeriodeBagian[0]["totalMasukPayungPerPeriodeBagian"],0,'.',','),
    //               "totalPayungKuningMasukPerPeriodeBagian" => number_format($arrTotalPerPeriodeBagian[0]["totalMasukPayungKuningPerPeriodeBagian"],0,'.',','),
    //               "stokMasterBerat" => number_format($arrDataStokMaster[0]["stok"],2,'.',','),
    //               "stokMasterBobin" => number_format($arrDataStokMaster[0]["bobin"],0,'.',','),
    //               "stokMasterPayung" => number_format($arrDataStokMaster[0]["payung"],0,'.',','),
    //               "stokMasterPayungKuning" => number_format($arrDataStokMaster[0]["payung_kuning"]),0,'.',',');
    $data = array("saldoAwal" => $arrSaldoAwal,
                  "totalPerPeriode" => $arrTotalPerPeriode,
                  "totalPerPeriodeBagian" => $arrTotalPerPeriodeBagian,
                  "dataStokMaster" => $arrDataStokMaster);

    return json_encode($data);
  }

  public function selectDataKartuStokSort($param){
    $tglAwalPlus1 = date("Y-m-d", strtotime("+1 Days", strtotime($param["tglAwal"])));
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
          case '1': $having .= " GR.stok ".$param["havingStokMaster"];break;
          case '2': $having .= " saldoAwalBerat ".$param["havingStokAwal"];break;
          case '3': $having .= " saldoAkhir ".$param["havingStokAkhir"];break;

          default: $having .=""; break;
        }

        if($j > 0){
          $having .= " AND";
        }
        $j--;
      }
    }

    if($param["jnsPermintaan"] == "POLOS"){
      $bagian = "EXTRUDER";
    }else{
      $bagian = "CETAK";
    }

    $arrSaldoAkhir = $this->db->query("SELECT GR.stok, GR.kd_gd_roll,CONCAT(GR.ukuran, ' ', GR.merek, ' ', GR.warna_plastik) AS nm_barang,
                                              (
                                                SUM(IF(TGR.status_history='MASUK' AND TGR.tgl_transaksi <= '$param[tglAwal]',TGR.berat,0))-
                                                SUM(IF(TGR.status_history='KELUAR' AND TGR.tgl_transaksi <= '$param[tglAwal]',TGR.berat,0))
                                              )  AS saldoAwalBerat,

                                              (SUM(IF(TGR.status_history='MASUK' AND
                                                      TGR.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                                      TGR.keterangan_history != 'DATA AWAL' AND
                                                      TGR.keterangan_history NOT IN ('HASIL CETAK') AND
                                                      TGR.bagian IN ('POTONG','CETAK','GUDANG ROLL'),TGR.berat,0))
                                              ) AS totalMasukBeratPerPeriode,

                                              (SUM(IF(TGR.status_history='KELUAR' AND
                                                      TGR.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                                      TGR.keterangan_history != 'DATA AWAL' AND
                                                      TGR.keterangan_history NOT IN ('HASIL CETAK') AND
                                                      TGR.bagian IN ('POTONG','CETAK','GUDANG ROLL'),TGR.berat,0))
                                              ) AS totalKeluarBeratPerPeriode,

                                              (
                                                SUM(IF(TGR.status_history='MASUK' AND
                                                       TGR.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                                       TGR.keterangan_history != 'DATA AWAL' AND
                                                       TGR.bagian='$bagian',TGR.berat,0))
                                              ) AS totalMasukBeratPerPeriodeBagian,

                                              ((SUM(IF(TGR.status_history='MASUK' AND TGR.tgl_transaksi <= '$param[tglAwal]',TGR.berat,0))-
                                                SUM(IF(TGR.status_history='KELUAR' AND TGR.tgl_transaksi <= '$param[tglAwal]',TGR.berat,0))
                                              ) +
                                              (SUM(IF(TGR.status_history='MASUK' AND
                                                      TGR.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                                      TGR.keterangan_history != 'DATA AWAL' AND
                                                      TGR.keterangan_history NOT IN ('HASIL CETAK') AND
                                                      TGR.bagian IN ('POTONG','CETAK','GUDANG ROLL'),TGR.berat,0))
                                              ) +
                                              (
                                                SUM(IF(TGR.status_history='MASUK' AND
                                                       TGR.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                                       TGR.keterangan_history != 'DATA AWAL' AND
                                                       TGR.bagian='$bagian',TGR.berat,0))
                                              ) -
                                              (
                                                SUM(IF(TGR.status_history='KELUAR' AND
                                                       TGR.tgl_transaksi BETWEEN '$tglAwalPlus1' AND '$param[tglAkhir]' AND
                                                       TGR.keterangan_history != 'DATA AWAL' AND
                                                       TGR.keterangan_history NOT IN ('HASIL CETAK') AND
                                                       TGR.bagian IN ('POTONG','CETAK','GUDANG ROLL'),TGR.berat,0))
                                              )) AS saldoAkhir

                                       FROM gudang_roll GR
                                       LEFT JOIN transaksi_gudang_roll TGR ON TGR.kd_gd_roll = GR.kd_gd_roll
                                       WHERE GR.jns_permintaan='$param[jnsPermintaan]'
                                       AND TGR.tgl_transaksi BETWEEN '2015-01-01' AND '$param[tglAkhir]'
                                       AND TGR.deleted='FALSE'
                                       AND GR.deleted='FALSE'
                                       AND TGR.status_transaksi='FINISH'
                                       GROUP BY GR.kd_gd_roll $having
                                       ORDER BY GR.merek ASC, CAST(REPLACE(SUBSTRING_INDEX(GR.ukuran,'+',1),'in','') AS UNSIGNED) ASC")->result_array();

    $data = array("saldoAkhir" => $arrSaldoAkhir);

    return json_encode($data);
  }

  public function selectCetakKartuStok($param){
    $tglAwal = date("Y-m-d",strtotime($param["tglAwal"],strtotime("+1 Day")));
    $Q = "SELECT IF(TGR.status_history = 'MASUK', TGR.berat, 0) AS beratMasuk,
                 IF(TGR.status_history = 'KELUAR', TGR.berat, 0) AS beratKeluar,
                 IF(TGR.status_history = 'MASUK', TGR.bobin, 0) AS bobinMasuk,
                 IF(TGR.status_history = 'KELUAR', TGR.bobin, 0) AS bobinKeluar,
                 IF(TGR.status_history = 'MASUK', TGR.payung, 0) AS payungMasuk,
                 IF(TGR.status_history = 'KELUAR', TGR.payung, 0) AS payungKeluar,
                 IF(TGR.status_history = 'MASUK', TGR.payung_kuning, 0) AS payungKuningMasuk,
                 IF(TGR.status_history = 'KELUAR', TGR.payung_kuning, 0) AS payungKuningKeluar,
                 TGR.keterangan_history, TGR.tgl_transaksi
          FROM transaksi_gudang_roll TGR
          INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
          WHERE TGR.deleted='FALSE'
          AND GR.deleted = 'FALSE'
          AND GR.kd_gd_roll = '$param[kdGdRoll]'
          AND TGR.tgl_transaksi BETWEEN '$tglAwal' AND '$param[tglAkhir]'
          ORDER BY TGR.tgl_transaksi ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }
  #=========================Select Function (Finish)=========================#

  #=========================Update Function (Start)=========================#
  public function updateGudangRoll($param){
    $this->db->trans_begin();
    $this->db->where("kd_gd_roll", $param["kd_gd_roll"]);
    $this->db->update("gudang_roll",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateTransaksiGudangRoll($param){
    $this->db->trans_begin();
    $this->db->where("id", $param["id"]);
    $this->db->update("transaksi_gudang_roll",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateTransaksiPengembalianPotong($param){
    $this->db->trans_begin();
    $this->db->where("id" , $param["TBPR"]["id"]);
    $this->db->update("transaksi_berat_pengambilan_roll",$param["TBPR"]);

    if(array_key_exists("TGR_OUT", $param)){
      if(array_key_exists("kdGdRoll", $param["TDPP"])){
        $this->db->set("kd_gd_roll"      , $param["TDPP"]["kdGdRoll"]);
        $this->db->set("ukuran"          , $param["TDPP"]["ukuran"]);
        $this->db->set("panjang"         , $param["TDPP"]["panjang"]);
        $this->db->set("merek"           , $param["TDPP"]["merek"]);
        $this->db->set("warna_plastik"   , $param["TDPP"]["warnaPlastik"]);
        $this->db->set("jns_permintaan"  , $param["TDPP"]["jnsPermintaan"]);
        $this->db->set("berat"           , $param["TDPP"]["sisa"]);
        $this->db->set("bobin"           , $param["TDPP"]["bobin"]);
        $this->db->set("payung"          , $param["TDPP"]["payung"]);
        $this->db->set("payung_kuning"   , $param["TDPP"]["payungKuning"]);

        $this->db->where("kd_gd_roll"       , $param["TDPP"]["kdGdRollHide"]);
        $this->db->where("kd_potong"        , $param["TDPP"]["kdPotongHide"]);
        $this->db->where("ukuran"           , $param["TDPP"]["ukuranHide"]);
        $this->db->where("panjang"          , $param["TDPP"]["ukuranHide"]);
        $this->db->where("merek"            , $param["TDPP"]["merekHide"]);
        $this->db->where("warna_plastik"    , $param["TDPP"]["warnaPlastikHide"]);
        $this->db->where("jns_permintaan"   , $param["TDPP"]["jnsPermintaanHide"]);
        $this->db->where("tgl_sisa"         , $param["TDPP"]["tglSisaHide"]);
        $this->db->where("tgl_potong"       , $param["TDPP"]["tglPotongHide"]);
        $this->db->where("status"           , $param["TDPP"]["status"]);
        $this->db->where("berat"            , $param["TDPP"]["sisaHide"]);
        $this->db->where("bobin"            , $param["TDPP"]["bobinHide"]);
        $this->db->where("payung"           , $param["TDPP"]["payungHide"]);
        $this->db->where("payung_kuning"    , $param["TDPP"]["payungKuningHide"]);

        $this->db->update("transaksi_detail_pengambilan_potong");
      }else{
        $this->db->set("berat"           , $param["TDPP"]["sisa"]);
        $this->db->set("bobin"           , $param["TDPP"]["bobin"]);
        $this->db->set("payung"          , $param["TDPP"]["payung"]);
        $this->db->set("payung_kuning"   , $param["TDPP"]["payungKuning"]);

        $this->db->where("kd_gd_roll"       , $param["TDPP"]["kdGdRollHide"]);
        $this->db->where("kd_potong"        , $param["TDPP"]["kdPotongHide"]);
        $this->db->where("ukuran"           , $param["TDPP"]["ukuranHide"]);
        $this->db->where("panjang"          , $param["TDPP"]["ukuranHide"]);
        $this->db->where("merek"            , $param["TDPP"]["merekHide"]);
        $this->db->where("warna_plastik"    , $param["TDPP"]["warnaPlastikHide"]);
        $this->db->where("jns_permintaan"   , $param["TDPP"]["jnsPermintaanHide"]);
        $this->db->where("tgl_sisa"         , $param["TDPP"]["tglSisaHide"]);
        $this->db->where("tgl_potong"       , $param["TDPP"]["tglPotongHide"]);
        $this->db->where("status"           , $param["TDPP"]["status"]);
        $this->db->where("berat"            , $param["TDPP"]["sisaHide"]);
        $this->db->where("bobin"            , $param["TDPP"]["bobinHide"]);
        $this->db->where("payung"           , $param["TDPP"]["payungHide"]);
        $this->db->where("payung_kuning"    , $param["TDPP"]["payungKuningHide"]);

        $this->db->update("transaksi_detail_pengambilan_potong");
      }

      if(array_key_exists("kdGdRoll",$param["TGR_IN"])){
        $this->db->set("kd_gd_roll"     , $param["TGR_IN"]["kdGdRoll"]);
        $this->db->set("berat"          , $param["TGR_IN"]["sisa"]);
        $this->db->set("bobin"          , $param["TGR_IN"]["bobin"]);
        $this->db->set("payung"         , $param["TGR_IN"]["payung"]);
        $this->db->set("payung_kuning"  , $param["TGR_IN"]["payungKuning"]);

        $this->db->where("kd_gd_roll"             , $param["TGR_IN"]["kdGdRollHide"]);
        $this->db->where("jns_permintaan"         , $param["TGR_IN"]["jnsPermintaanHide"]);
        $this->db->where("tgl_transaksi"          , $param["TGR_IN"]["tglSisaHide"]);
        $this->db->where("bagian"                 , $param["TGR_IN"]["bagian"]);
        $this->db->where("keterangan_transaksi"   , $param["TGR_IN"]["keterangan_transaksi"]);
        $this->db->where("status_history"         , $param["TGR_IN"]["status_history"]);
        $this->db->where("keterangan_history"     , $param["TGR_IN"]["keterangan_history"]);
        $this->db->where("berat"                  , $param["TGR_IN"]["sisaHide"]);
        $this->db->where("bobin"                  , $param["TGR_IN"]["bobinHide"]);
        $this->db->where("payung"                 , $param["TGR_IN"]["payungHide"]);
        $this->db->where("payung_kuning"          , $param["TGR_IN"]["payungKuningHide"]);

        $this->db->update("transaksi_gudang_roll");
      }else{
        $this->db->set("berat"          , $param["TGR_IN"]["sisa"]);
        $this->db->set("bobin"          , $param["TGR_IN"]["bobin"]);
        $this->db->set("payung"         , $param["TGR_IN"]["payung"]);
        $this->db->set("payung_kuning"  , $param["TGR_IN"]["payungKuning"]);

        $this->db->where("kd_gd_roll"             , $param["TGR_IN"]["kdGdRollHide"]);
        $this->db->where("jns_permintaan"         , $param["TGR_IN"]["jnsPermintaanHide"]);
        $this->db->where("tgl_transaksi"          , $param["TGR_IN"]["tglSisaHide"]);
        $this->db->where("bagian"                 , $param["TGR_IN"]["bagian"]);
        $this->db->where("keterangan_transaksi"   , $param["TGR_IN"]["keterangan_transaksi"]);
        $this->db->where("status_history"         , $param["TGR_IN"]["status_history"]);
        $this->db->where("keterangan_history"     , $param["TGR_IN"]["keterangan_history"]);
        $this->db->where("berat"                  , $param["TGR_IN"]["sisaHide"]);
        $this->db->where("bobin"                  , $param["TGR_IN"]["bobinHide"]);
        $this->db->where("payung"                 , $param["TGR_IN"]["payungHide"]);
        $this->db->where("payung_kuning"          , $param["TGR_IN"]["payungKuningHide"]);

        $this->db->update("transaksi_gudang_roll");
      }

      if(array_key_exists("kdGdRoll",$param["TGR_OUT"])){
        $this->db->set("kd_gd_roll"     , $param["TGR_OUT"]["kdGdRoll"]);
        $this->db->set("berat"          , $param["TGR_OUT"]["sisa"]);
        $this->db->set("bobin"          , $param["TGR_OUT"]["bobin"]);
        $this->db->set("payung"         , $param["TGR_OUT"]["payung"]);
        $this->db->set("payung_kuning"  , $param["TGR_OUT"]["payungKuning"]);

        $this->db->where("kd_gd_roll"             , $param["TGR_OUT"]["kdGdRollHide"]);
        $this->db->where("jns_permintaan"         , $param["TGR_OUT"]["jnsPermintaanHide"]);
        $this->db->where("tgl_transaksi"          , $param["TGR_OUT"]["tglSisaHide"]);
        $this->db->where("bagian"                 , $param["TGR_OUT"]["bagian"]);
        $this->db->where("keterangan_transaksi"   , $param["TGR_OUT"]["keterangan_transaksi"]);
        $this->db->where("status_history"         , $param["TGR_OUT"]["status_history"]);
        $this->db->where("keterangan_history"     , $param["TGR_OUT"]["keterangan_history"]);
        $this->db->where("berat"                  , $param["TGR_OUT"]["sisaHide"]);
        $this->db->where("bobin"                  , $param["TGR_OUT"]["bobinHide"]);
        $this->db->where("payung"                 , $param["TGR_OUT"]["payungHide"]);
        $this->db->where("payung_kuning"          , $param["TGR_OUT"]["payungKuningHide"]);

        $this->db->update("transaksi_gudang_roll");
      }else{
        $this->db->set("berat"          , $param["TGR_OUT"]["sisa"]);
        $this->db->set("bobin"          , $param["TGR_OUT"]["bobin"]);
        $this->db->set("payung"         , $param["TGR_OUT"]["payung"]);
        $this->db->set("payung_kuning"  , $param["TGR_OUT"]["payungKuning"]);

        $this->db->where("kd_gd_roll"             , $param["TGR_OUT"]["kdGdRollHide"]);
        $this->db->where("jns_permintaan"         , $param["TGR_OUT"]["jnsPermintaanHide"]);
        $this->db->where("tgl_transaksi"          , $param["TGR_OUT"]["tglSisaHide"]);
        $this->db->where("bagian"                 , $param["TGR_OUT"]["bagian"]);
        $this->db->where("keterangan_transaksi"   , $param["TGR_OUT"]["keterangan_transaksi"]);
        $this->db->where("status_history"         , $param["TGR_OUT"]["status_history"]);
        $this->db->where("keterangan_history"     , $param["TGR_OUT"]["keterangan_history"]);
        $this->db->where("berat"                  , $param["TGR_OUT"]["sisaHide"]);
        $this->db->where("bobin"                  , $param["TGR_OUT"]["bobinHide"]);
        $this->db->where("payung"                 , $param["TGR_OUT"]["payungHide"]);
        $this->db->where("payung_kuning"          , $param["TGR_OUT"]["payungKuningHide"]);

        $this->db->update("transaksi_gudang_roll");
      }
    }else{ #Jika Tidak Ada Data TGR_OUT
      if(array_key_exists("kdGdRoll", $param["TDPP"])){
        $this->db->set("kd_gd_roll"      , $param["TDPP"]["kdGdRoll"]);
        $this->db->set("ukuran"          , $param["TDPP"]["ukuran"]);
        $this->db->set("panjang"         , $param["TDPP"]["panjang"]);
        $this->db->set("merek"           , $param["TDPP"]["merek"]);
        $this->db->set("warna_plastik"   , $param["TDPP"]["warnaPlastik"]);
        $this->db->set("jns_permintaan"  , $param["TDPP"]["jnsPermintaan"]);
        $this->db->set("berat"           , $param["TDPP"]["sisa"]);
        $this->db->set("bobin"           , $param["TDPP"]["bobin"]);
        $this->db->set("payung"          , $param["TDPP"]["payung"]);
        $this->db->set("payung_kuning"   , $param["TDPP"]["payungKuning"]);

        $this->db->where("kd_gd_roll"       , $param["TDPP"]["kdGdRollHide"]);
        $this->db->where("kd_potong"        , $param["TDPP"]["kdPotongHide"]);
        $this->db->where("ukuran"           , $param["TDPP"]["ukuranHide"]);
        $this->db->where("panjang"          , $param["TDPP"]["ukuranHide"]);
        $this->db->where("merek"            , $param["TDPP"]["merekHide"]);
        $this->db->where("warna_plastik"    , $param["TDPP"]["warnaPlastikHide"]);
        $this->db->where("jns_permintaan"   , $param["TDPP"]["jnsPermintaanHide"]);
        $this->db->where("tgl_sisa"         , $param["TDPP"]["tglSisaHide"]);
        $this->db->where("tgl_potong"       , $param["TDPP"]["tglPotongHide"]);
        $this->db->where("status"           , $param["TDPP"]["status"]);
        $this->db->where("berat"            , $param["TDPP"]["sisaHide"]);
        $this->db->where("bobin"            , $param["TDPP"]["bobinHide"]);
        $this->db->where("payung"           , $param["TDPP"]["payungHide"]);
        $this->db->where("payung_kuning"    , $param["TDPP"]["payungKuningHide"]);

        $this->db->update("transaksi_detail_pengambilan_potong");
      }else{
        $this->db->set("berat"           , $param["TDPP"]["sisa"]);
        $this->db->set("bobin"           , $param["TDPP"]["bobin"]);
        $this->db->set("payung"          , $param["TDPP"]["payung"]);
        $this->db->set("payung_kuning"   , $param["TDPP"]["payungKuning"]);

        $this->db->where("kd_gd_roll"       , $param["TDPP"]["kdGdRollHide"]);
        $this->db->where("kd_potong"        , $param["TDPP"]["kdPotongHide"]);
        $this->db->where("ukuran"           , $param["TDPP"]["ukuranHide"]);
        $this->db->where("panjang"          , $param["TDPP"]["ukuranHide"]);
        $this->db->where("merek"            , $param["TDPP"]["merekHide"]);
        $this->db->where("warna_plastik"    , $param["TDPP"]["warnaPlastikHide"]);
        $this->db->where("jns_permintaan"   , $param["TDPP"]["jnsPermintaanHide"]);
        $this->db->where("tgl_sisa"         , $param["TDPP"]["tglSisaHide"]);
        $this->db->where("tgl_potong"       , $param["TDPP"]["tglPotongHide"]);
        $this->db->where("status"           , $param["TDPP"]["status"]);
        $this->db->where("berat"            , $param["TDPP"]["sisaHide"]);
        $this->db->where("bobin"            , $param["TDPP"]["bobinHide"]);
        $this->db->where("payung"           , $param["TDPP"]["payungHide"]);
        $this->db->where("payung_kuning"    , $param["TDPP"]["payungKuningHide"]);

        $this->db->update("transaksi_detail_pengambilan_potong");
      }

      if(array_key_exists("kdGdRoll",$param["TGR_IN"])){
        $this->db->set("kd_gd_roll"     , $param["TGR_IN"]["kdGdRoll"]);
        $this->db->set("berat"          , $param["TGR_IN"]["sisa"]);
        $this->db->set("bobin"          , $param["TGR_IN"]["bobin"]);
        $this->db->set("payung"         , $param["TGR_IN"]["payung"]);
        $this->db->set("payung_kuning"  , $param["TGR_IN"]["payungKuning"]);

        $this->db->where("kd_gd_roll"             , $param["TGR_IN"]["kdGdRollHide"]);
        $this->db->where("jns_permintaan"         , $param["TGR_IN"]["jnsPermintaanHide"]);
        $this->db->where("tgl_transaksi"          , $param["TGR_IN"]["tglSisaHide"]);
        $this->db->where("bagian"                 , $param["TGR_IN"]["bagian"]);
        $this->db->where("keterangan_transaksi"   , $param["TGR_IN"]["keterangan_transaksi"]);
        $this->db->where("status_history"         , $param["TGR_IN"]["status_history"]);
        $this->db->where("keterangan_history"     , $param["TGR_IN"]["keterangan_history"]);
        $this->db->where("berat"                  , $param["TGR_IN"]["sisaHide"]);
        $this->db->where("bobin"                  , $param["TGR_IN"]["bobinHide"]);
        $this->db->where("payung"                 , $param["TGR_IN"]["payungHide"]);
        $this->db->where("payung_kuning"          , $param["TGR_IN"]["payungKuningHide"]);

        $this->db->update("transaksi_gudang_roll");
      }else{
        $this->db->set("berat"          , $param["TGR_IN"]["sisa"]);
        $this->db->set("bobin"          , $param["TGR_IN"]["bobin"]);
        $this->db->set("payung"         , $param["TGR_IN"]["payung"]);
        $this->db->set("payung_kuning"  , $param["TGR_IN"]["payungKuning"]);

        $this->db->where("kd_gd_roll"             , $param["TGR_IN"]["kdGdRollHide"]);
        $this->db->where("jns_permintaan"         , $param["TGR_IN"]["jnsPermintaanHide"]);
        $this->db->where("tgl_transaksi"          , $param["TGR_IN"]["tglSisaHide"]);
        $this->db->where("bagian"                 , $param["TGR_IN"]["bagian"]);
        $this->db->where("keterangan_transaksi"   , $param["TGR_IN"]["keterangan_transaksi"]);
        $this->db->where("status_history"         , $param["TGR_IN"]["status_history"]);
        $this->db->where("keterangan_history"     , $param["TGR_IN"]["keterangan_history"]);
        $this->db->where("berat"                  , $param["TGR_IN"]["sisaHide"]);
        $this->db->where("bobin"                  , $param["TGR_IN"]["bobinHide"]);
        $this->db->where("payung"                 , $param["TGR_IN"]["payungHide"]);
        $this->db->where("payung_kuning"          , $param["TGR_IN"]["payungKuningHide"]);

        $this->db->update("transaksi_gudang_roll");
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

  public function updateDeleteAndRestorePengembalianPotong($param){
    $this->db->trans_begin();
    $Q = "SELECT TBPR.kd_gd_roll, TBPR.kd_potong, TBPR.sisa, TBPR.payung, TBPR.payung_kuning,
                 TBPR.bobin, TBPR.keterangan, TBPR.tgl_sisa, TBPR.tgl_potong,
                 GR.jns_permintaan, GR.warna_plastik, GR.ukuran, GR.merek
          FROM transaksi_berat_pengambilan_roll TBPR
          INNER JOIN gudang_roll GR ON TBPR.kd_gd_roll = GR.kd_gd_roll
          WHERE id = '$param[id]'";
    $arrDataTBPR = $this->db->query($Q)->result_array();
    $this->db->where("id", $param["id"]);
    $this->db->update("transaksi_berat_pengambilan_roll", $param);

    $this->db->set("deleted",$param["deleted"]);
    $this->db->where("kd_gd_roll"       , $arrDataTBPR[0]["kd_gd_roll"]);
    $this->db->where("kd_potong"        , $arrDataTBPR[0]["kd_potong"]);
    $this->db->where("ukuran"           , $arrDataTBPR[0]["ukuran"]);
    $this->db->where("panjang"          , $arrDataTBPR[0]["ukuran"]);
    $this->db->where("merek"            , $arrDataTBPR[0]["merek"]);
    $this->db->where("warna_plastik"    , $arrDataTBPR[0]["warna_plastik"]);
    $this->db->where("jns_permintaan"   , $arrDataTBPR[0]["jns_permintaan"]);
    $this->db->where("tgl_sisa"         , $arrDataTBPR[0]["tgl_sisa"]);
    $this->db->where("tgl_potong"       , $arrDataTBPR[0]["tgl_potong"]);
    $this->db->where("status"           , ($arrDataTBPR[0]["keterangan"] == "POTONG BESOK" ? "KEMBALI KE GUDANG(SISA SEMALAM)" : "KEMBALI KE GUDANG(SISA MESIN)"));
    $this->db->where("berat"            , $arrDataTBPR[0]["sisa"]);
    $this->db->where("bobin"            , $arrDataTBPR[0]["bobin"]);
    $this->db->where("payung"           , $arrDataTBPR[0]["payung"]);
    $this->db->where("payung_kuning"    , $arrDataTBPR[0]["payung_kuning"]);
    $this->db->update("transaksi_detail_pengambilan_potong");

    if($arrDataTBPR[0]["keterangan"] == "POTONG BESOK"){
      $this->db->set("deleted",$param["deleted"]);
      $this->db->where("kd_gd_roll"             , $arrDataTBPR[0]["kd_gd_roll"]);
      $this->db->where("jns_permintaan"         , $arrDataTBPR[0]["jns_permintaan"]);
      $this->db->where("tgl_transaksi"          , $arrDataTBPR[0]["tgl_sisa"]);
      $this->db->where("bagian"                 , "POTONG");
      $this->db->where("keterangan_transaksi"   , "MASUK DARI POTONG");
      $this->db->where("status_history"         , "MASUK");
      $this->db->where("keterangan_history"     , "OPERATOR(SISA SEMALAM)");
      $this->db->where("berat"                  , $arrDataTBPR[0]["sisa"]);
      $this->db->where("bobin"                  , $arrDataTBPR[0]["bobin"]);
      $this->db->where("payung"                 , $arrDataTBPR[0]["payung"]);
      $this->db->where("payung_kuning"          , $arrDataTBPR[0]["payung_kuning"]);
      $this->db->update("transaksi_gudang_roll");

      $this->db->set("deleted",$param["deleted"]);
      $this->db->where("kd_gd_roll"             , $arrDataTBPR[0]["kd_gd_roll"]);
      $this->db->where("jns_permintaan"         , $arrDataTBPR[0]["jns_permintaan"]);
      $this->db->where("tgl_transaksi"          , $arrDataTBPR[0]["tgl_potong"]);
      $this->db->where("bagian"                 , "POTONG");
      $this->db->where("keterangan_transaksi"   , "KELUAR KE POTONG");
      $this->db->where("status_history"         , "KELUAR");
      $this->db->where("keterangan_history"     , "OPERATOR(SISA SEMALAM)");
      $this->db->where("berat"                  , $arrDataTBPR[0]["sisa"]);
      $this->db->where("bobin"                  , $arrDataTBPR[0]["bobin"]);
      $this->db->where("payung"                 , $arrDataTBPR[0]["payung"]);
      $this->db->where("payung_kuning"          , $arrDataTBPR[0]["payung_kuning"]);
      $this->db->update("transaksi_gudang_roll");
    }else{
      $this->db->set("deleted",$param["deleted"]);
      $this->db->where("kd_gd_roll"             , $arrDataTBPR[0]["kd_gd_roll"]);
      $this->db->where("jns_permintaan"         , $arrDataTBPR[0]["jns_permintaan"]);
      $this->db->where("tgl_transaksi"          , $arrDataTBPR[0]["tgl_potong"]);
      $this->db->where("bagian"                 , "POTONG");
      $this->db->where("keterangan_transaksi"   , "MASUK DARI POTONG");
      $this->db->where("status_history"         , "MASUK");
      $this->db->where("keterangan_history"     , "OPERATOR(SISA MESIN)");
      $this->db->where("berat"                  , $arrDataTBPR[0]["sisa"]);
      $this->db->where("bobin"                  , $arrDataTBPR[0]["bobin"]);
      $this->db->where("payung"                 , $arrDataTBPR[0]["payung"]);
      $this->db->where("payung_kuning"          , $arrDataTBPR[0]["payung_kuning"]);
      $this->db->update("transaksi_gudang_roll");
    }

    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateApprovePengembalianPotong($param){
    $this->db->trans_begin();
    $errorCounter = 0;
    $successCounter = 0;
    $Q = "SELECT DATE_FORMAT(TGR.tgl_transaksi , '%Y-%m') AS periodeLock
          FROM transaksi_gudang_roll TGR
          INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
          WHERE (GR.jns_permintaan = '$param' OR GR.jns_permintaan='CETAK/POLOS')
          AND TGR.status_transaksi = 'PROGRESS'
          AND TGR.deleted = 'FALSE'
          AND GR.deleted = 'FALSE'
          GROUP BY DATE_FORMAT(TGR.tgl_transaksi , '%Y-%m')
          ORDER BY TGR.tgl_transaksi ASC";
    $arrPeriodeLock = $this->db->query($Q)->result_array();
    foreach ($arrPeriodeLock as $valuePeriodeLock) {
      $arrCounterLock = $this->db->query("SELECT COUNT(id) AS counter FROM transaksi_gudang_roll
                                          WHERE DATE_FORMAT(tgl_transaksi,'%Y-%m')='$valuePeriodeLock[periodeLock]'
                                          AND deleted = 'FALSE'
                                          AND status_lock='TRUE'")->result_array();
      if($arrCounterLock[0]["counter"] > 0){
        $errorCounter++;
      }else{
        if($param=="POLOS"){
          $clause = "IN ('MANDOR POTONG (EXTRUDER)')";
        }else{
          $clause = "IN ('MANDOR POTONG (CETAK)')";
        }
        $arrData = $this->db->query("SELECT TGR.kd_gd_roll, TGR.berat, TGR.payung, TGR.payung_kuning, TGR.bobin, TGR.keterangan_history
                                     FROM transaksi_gudang_roll TGR
                                     INNER JOIN gudang_roll GR ON TGR.kd_gd_roll = GR.kd_gd_roll
                                     WHERE (((GR.jns_permintaan = '$param' OR GR.jns_permintaan='CETAK/POLOS')
                                     AND TGR.status_transaksi='PROGRESS'
                                     AND TGR.bagian = 'POTONG'
                                     AND TGR.status_history = 'MASUK'
                                     AND TGR.keterangan_history IN ('OPERATOR(SISA MESIN)','OPERATOR(SISA SEMALAM)')
                                     AND TGR.deleted='FALSE'
                                     AND GR.deleted='FALSE')
                                     OR ((GR.jns_permintaan = '$param' OR GR.jns_permintaan='CETAK/POLOS')
                                     AND TGR.status_transaksi='PROGRESS'
                                     AND TGR.bagian = 'POTONG'
                                     AND TGR.status_history = 'KELUAR'
                                     AND TGR.keterangan_history IN ('OPERATOR POTONG')
                                     AND TGR.deleted='FALSE'
                                     AND GR.deleted='FALSE')
                                     OR ((GR.jns_permintaan = '$param' OR GR.jns_permintaan='CETAK/POLOS')
                                     AND TGR.status_transaksi='PROGRESS'
                                     AND TGR.bagian = 'POTONG'
                                     AND TGR.status_history = 'KELUAR'
                                     AND TGR.keterangan_history $clause
                                     AND TGR.deleted='FALSE'
                                     AND GR.deleted='FALSE'))")->result_array();
                                     // ((GR.jns_permintaan='$param'
                                     // AND TGR.status_transaksi='PROGRESS'
                                     // AND TGR.bagian = 'POTONG'
                                     // AND TGR.status_history = 'KELUAR'
                                     // AND TGR.keterangan_history IN ('OPERATOR(SISA SEMALAM)')
                                     // AND TGR.tgl_transaksi < '$tglSekarang'
                                     // AND TGR.deleted='FALSE'
                                     // AND GR.deleted='FALSE')
                                     // OR (GR.jns_permintaan='$param'
                                     // AND TGR.status_transaksi='PROGRESS'
                                     // AND TGR.bagian = 'POTONG'
                                     // AND TGR.status_history = 'MASUK'
                                     // AND TGR.keterangan_history IN ('OPERATOR(SISA MESIN)')
                                     // AND TGR.deleted='FALSE'
                                     // AND GR.deleted='FALSE')
                                     // OR (GR.jns_permintaan='$param'
                                     // AND TGR.status_transaksi='PROGRESS'
                                     // AND TGR.bagian = 'POTONG'
                                     // AND TGR.status_history = 'KELUAR'
                                     // AND TGR.keterangan_history IN ('OPERATOR POTONG')
                                     // AND TGR.deleted='FALSE'
                                     // AND GR.deleted='FALSE')
                                     // OR (GR.jns_permintaan='$param'
                                     // AND TGR.status_transaksi='PROGRESS'
                                     // AND TGR.bagian = 'POTONG'
                                     // AND TGR.status_history = 'KELUAR'
                                     // AND TGR.keterangan_history IN ('MANDOR POTONG (EXTRUDER)','MANDOR POTONG (CETAK)')
                                     // AND TGR.deleted='FALSE'
                                     // AND GR.deleted='FALSE'))
        foreach ($arrData as $arrValue) {
          if($arrValue["keterangan_history"] == "OPERATOR POTONG"){
            $this->db->query("UPDATE gudang_roll
                              SET stok = stok - $arrValue[berat],
                                  bobin = bobin - $arrValue[bobin],
                                  payung = payung - $arrValue[payung],
                                  payung_kuning = payung - $arrValue[payung_kuning]
                              WHERE kd_gd_roll='$arrValue[kd_gd_roll]'");
          }
          if($arrValue["keterangan_history"] == "OPERATOR(SISA MESIN)"){
            $this->db->query("UPDATE gudang_roll
                              SET stok = stok + $arrValue[berat],
                                  bobin = bobin + $arrValue[bobin],
                                  payung = payung + $arrValue[payung],
                                  payung_kuning = payung + $arrValue[payung_kuning]
                              WHERE kd_gd_roll='$arrValue[kd_gd_roll]'");
          }
          if($arrValue["keterangan_history"] == "MANDOR POTONG (EXTRUDER)" || $arrValue["keterangan_history"] == "MANDOR POTONG (CETAK)"){
            $this->db->query("UPDATE gudang_roll
                              SET stok = stok + $arrValue[berat],
                                  bobin = bobin + $arrValue[bobin],
                                  payung = payung + $arrValue[payung],
                                  payung_kuning = payung + $arrValue[payung_kuning]
                              WHERE kd_gd_roll='$arrValue[kd_gd_roll]'");
          }
        }
        $this->db->query("UPDATE transaksi_berat_pengambilan_roll SET sts_transaksi='FINISH'
                          WHERE sts_transaksi='PROGRESS'
                          AND DATE_FORMAT(tgl_sisa, '%Y-%m') = '$valuePeriodeLock[periodeLock]'");
        $this->db->query("UPDATE transaksi_detail_pengambilan_potong SET sts_transaksi='FINISH'
                          WHERE sts_transaksi='PROGRESS'
                          AND DATE_FORMAT(tgl_sisa, '%Y-%m') = '$valuePeriodeLock[periodeLock]'
                          AND jns_permintaan='$param'");
        $this->db->query("UPDATE transaksi_gudang_roll SET status_transaksi='FINISH'
                          WHERE bagian='POTONG'
                          AND status_transaksi='PROGRESS'
                          AND DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$valuePeriodeLock[periodeLock]'
                          AND jns_permintaan='$param'");
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
        return "Terkunci";
      }
    }
  }

  public function updateApproveHasilExtruder(){
    $this->db->trans_begin();
    $arrPeriodeLock = $this->db->query("SELECT DATE_FORMAT(tgl_transaksi,'%Y-%m') AS periodeLock
                                        FROM transaksi_gudang_roll
                                        WHERE bagian='EXTRUDER'
                                        AND keterangan_history='HASIL EXTRUDER'
                                        AND status_history = 'MASUK'
                                        AND status_transaksi = 'PROGRESS'
                                        AND deleted = 'FALSE'
                                        GROUP BY DATE_FORMAT(tgl_transaksi,'%Y-%m')")->result_array();
    $counterTransaksi = 0;
    $jumlahPeriode = count($arrPeriodeLock);
    foreach ($arrPeriodeLock as $valuePeriodeLock) {
      $arrCounterLock = $this->db->query("SELECT COUNT(id) AS counter
                                          FROM transaksi_gudang_roll
                                          WHERE DATE_FORMAT(tgl_transaksi,'%Y-%m') = '$valuePeriodeLock[periodeLock]'
                                          AND deleted = 'FALSE'
                                          AND status_lock='TRUE'")->result_array();
      if($arrCounterLock[0]["counter"] > 0){

      }else{
        $arrDataForUpdateMaster = $this->db->query("SELECT kd_gd_roll, berat, bobin AS bobin1, payung AS payung1, payung_kuning AS payung_kuning1
                                                    FROM transaksi_gudang_roll
                                                    WHERE bagian='EXTRUDER'
                                                    AND keterangan_history='HASIL EXTRUDER'
                                                    AND status_history = 'MASUK'
                                                    AND status_transaksi='PROGRESS'
                                                    AND deleted = 'FALSE'
                                                    AND DATE_FORMAT(tgl_transaksi,'%Y-%m') = '$valuePeriodeLock[periodeLock]'")->result_array();
        foreach ($arrDataForUpdateMaster as $valueDataForUpdateMaster) {
          $this->db->set("stok","stok + ".$valueDataForUpdateMaster["berat"],FALSE);
          $this->db->set("bobin","bobin + ".$valueDataForUpdateMaster["bobin1"],FALSE);
          $this->db->set("payung","payung + ".$valueDataForUpdateMaster["payung1"],FALSE);
          $this->db->set("payung_kuning","payung_kuning + ".$valueDataForUpdateMaster["payung_kuning1"],FALSE);

          $this->db->where("kd_gd_roll",$valueDataForUpdateMaster["kd_gd_roll"]);
          $this->db->update("gudang_roll");
        }

        $this->db->set("status_transaksi","FINISH");
        $this->db->where("bagian","EXTRUDER");
        $this->db->where("keterangan_history","HASIL EXTRUDER");
        $this->db->where("status_history","MASUK");
        $this->db->where("status_transaksi","PROGRESS");
        $this->db->where("deleted","FALSE");
        $this->db->where("DATE_FORMAT(tgl_transaksi,'%Y-%m')","$valuePeriodeLock[periodeLock]");
        $this->db->update("transaksi_gudang_roll");
        $counterTransaksi++;
      }
    }

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      if($counterTransaksi == $jumlahPeriode && $counterTransaksi != 0){
        $this->db->trans_commit();
        return "Berhasil";
      }else if($counterTransaksi < $jumlahPeriode && $counterTransaksi != 0){
        $this->db->trans_commit();
        return "Setengah";
      }else{
        $this->db->trans_rollback();
        return "Lock";
      }
    }
  }

  public function updatePengambilanCetak(){
    $this->db->trans_begin();
    $errorCounter = 0;
    $successCounter = 0;
    $periodeLock = $this->db->query("SELECT DATE_FORMAT(tgl_transaksi, '%Y-%m') AS periode
                                     FROM transaksi_gudang_roll
                                     WHERE bagian = 'CETAK'
                                     AND keterangan_transaksi = 'KELUAR KE CETAK'
                                     AND status_history = 'KELUAR'
                                     AND status_transaksi = 'PROGRESS'
                                     AND deleted = 'FALSE'
                                     GROUP BY DATE_FORMAT(tgl_transaksi, '%Y-%m')")->result_array();
    foreach ($periodeLock as $value) {
      $checkLock = $this->db->query("SELECT COUNT(id) AS counter
                                     FROM transaksi_gudang_roll
                                     WHERE DATE_FORMAT(tgl_transaksi,'%Y-%m') = '$value[periode]'
                                     AND status_lock = 'TRUE'")->result_array();
      if($checkLock[0]["counter"] > 0){
        $errorCounter++;
      }else{
        $arrDataForUpdateMaster = $this->db->query("SELECT kd_gd_roll, berat, bobin, payung, payung_kuning
                                                    FROM transaksi_gudang_roll
                                                    WHERE bagian='CETAK'
                                                    AND keterangan_transaksi = 'KELUAR KE CETAK'
                                                    AND status_history = 'KELUAR'
                                                    AND status_transaksi = 'PROGRESS'
                                                    AND deleted='FALSE'
                                                    AND DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$value[periode]'")->result_array();
        foreach ($arrDataForUpdateMaster as $arrDataForUpdateMaster) {
          $this->db->set("stok","stok - ".$arrDataForUpdateMaster["berat"], FALSE);
          $this->db->set("bobin","bobin - ".$arrDataForUpdateMaster["bobin"], FALSE);
          $this->db->set("payung","payung - ".$arrDataForUpdateMaster["payung"], FALSE);
          $this->db->set("payung_kuning","payung_kuning - ".$arrDataForUpdateMaster["payung_kuning"], FALSE);

          $this->db->where("kd_gd_roll",$arrDataForUpdateMaster["kd_gd_roll"]);
          $this->db->update("gudang_roll");
        }

        $this->db->set("status_transaksi","FINISH");
        $this->db->where("bagian","CETAK");
        $this->db->where("keterangan_transaksi","KELUAR KE CETAK");
        $this->db->where("status_history","KELUAR");
        $this->db->where("status_transaksi","PROGRESS");
        $this->db->where("deleted","FALSE");
        $this->db->where("DATE_FORMAT(tgl_transaksi, '%Y-%m') = ",$value["periode"]);
        $this->db->update("transaksi_gudang_roll");
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

  public function updateApproveHasilCetak(){
    $this->db->trans_begin();
    $errorCounter = 0;
    $successCounter = 0;
    $periodeLock = $this->db->query("SELECT DATE_FORMAT(tgl_transaksi, '%Y-%m') AS periode
                                     FROM transaksi_gudang_roll
                                     WHERE bagian = 'CETAK'
                                     AND keterangan_transaksi = 'MASUK DARI CETAK'
                                     AND status_history = 'MASUK'
                                     AND status_transaksi = 'PROGRESS'
                                     AND keterangan_history = 'HASIL CETAK'
                                     AND deleted = 'FALSE'
                                     GROUP BY DATE_FORMAT(tgl_transaksi, '%Y-%m')")->result_array();
    foreach ($periodeLock as $value) {
      $checkLock = $this->db->query("SELECT COUNT(id) AS counter
                                     FROM transaksi_gudang_roll
                                     WHERE DATE_FORMAT(tgl_transaksi,'%Y-%m') = '$value[periode]'
                                     AND status_lock = 'TRUE'")->result_array();
      if($checkLock[0]["counter"] > 0){
        $errorCounter++;
      }else{
        $arrDataForUpdateMaster = $this->db->query("SELECT kd_gd_roll, berat, bobin, payung, payung_kuning
                                                    FROM transaksi_gudang_roll
                                                    WHERE bagian = 'CETAK'
                                                    AND keterangan_transaksi = 'MASUK DARI CETAK'
                                                    AND status_history = 'MASUK'
                                                    AND status_transaksi = 'PROGRESS'
                                                    AND keterangan_history = 'HASIL CETAK'
                                                    AND deleted = 'FALSE'
                                                    AND DATE_FORMAT(tgl_transaksi, '%Y-%m') = '$value[periode]'")->result_array();
        foreach ($arrDataForUpdateMaster as $arrDataForUpdateMaster) {
          $this->db->set("stok","stok + ".$arrDataForUpdateMaster["berat"], FALSE);
          $this->db->set("bobin","bobin + ".$arrDataForUpdateMaster["bobin"], FALSE);
          $this->db->set("payung","payung + ".$arrDataForUpdateMaster["payung"], FALSE);
          $this->db->set("payung_kuning","payung_kuning + ".$arrDataForUpdateMaster["payung_kuning"], FALSE);

          $this->db->where("kd_gd_roll",$arrDataForUpdateMaster["kd_gd_roll"]);
          $this->db->update("gudang_roll");
        }

        $this->db->set("status_transaksi","FINISH");
        $this->db->where("bagian","CETAK");
        $this->db->where("keterangan_transaksi","MASUK DARI CETAK");
        $this->db->where("status_history","MASUK");
        $this->db->where("status_transaksi","PROGRESS");
        $this->db->where("keterangan_history","HASIL CETAK");
        $this->db->where("deleted","FALSE");
        $this->db->where("DATE_FORMAT(tgl_transaksi, '%Y-%m') = ",$value["periode"]);
        $this->db->update("transaksi_gudang_roll");
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

  public function updateDeleteAndRestoreRoll($param){
    $this->db->trans_begin();
    $QCheckTGR = "SELECT * FROM transaksi_gudang_roll WHERE id='$param[idTransaksi]'";
    $arrDataTGR = $this->db->query($QCheckTGR)->result_array();
    if($arrDataTGR[0]["keterangan_history"] == "OPERATOR(SISA SEMALAM)"){
      $this->db->set("deleted",$param["deleted"]);
      $this->db->set("id_user",$param["idUser"]);
      $this->db->where("id",$param["idTransaksi"]);
      $this->db->update("transaksi_gudang_roll");
    }else{
      if($arrDataTGR[0]["status_history"] == "MASUK"){
        if($arrDataTGR[0]["status_transaksi"] == "FINISH"){
          if($param["deleted"] == "TRUE"){
            $this->db->set("stok","stok - ".$arrDataTGR[0]["berat"],FALSE);
            $this->db->set("bobin","bobin - ".$arrDataTGR[0]["bobin"],FALSE);
            $this->db->set("payung","payung - ".$arrDataTGR[0]["payung"],FALSE);
            $this->db->set("payung_kuning","payung_kuning - ".$arrDataTGR[0]["payung_kuning"],FALSE);
            $this->db->where("kd_gd_roll",$arrDataTGR[0]["kd_gd_roll"]);
            $this->db->update("gudang_roll");
          }else{
            $this->db->set("stok","stok + ".$arrDataTGR[0]["berat"],FALSE);
            $this->db->set("bobin","bobin + ".$arrDataTGR[0]["bobin"],FALSE);
            $this->db->set("payung","payung + ".$arrDataTGR[0]["payung"],FALSE);
            $this->db->set("payung_kuning","payung_kuning + ".$arrDataTGR[0]["payung_kuning"],FALSE);
            $this->db->where("kd_gd_roll",$arrDataTGR[0]["kd_gd_roll"]);
            $this->db->update("gudang_roll");
          }

          $this->db->set("deleted",$param["deleted"]);
          $this->db->set("id_user",$param["idUser"]);
          $this->db->where("id",$param["idTransaksi"]);
          $this->db->update("transaksi_gudang_roll");
        }else{
          $this->db->set("deleted",$param["deleted"]);
          $this->db->set("id_user",$param["idUser"]);
          $this->db->where("id",$param["idTransaksi"]);
          $this->db->update("transaksi_gudang_roll");
        }
      }else{
        if($arrDataTGR[0]["status_transaksi"] == "FINISH"){
          if($param["deleted"] == "TRUE"){
            $this->db->set("stok","stok + ".$arrDataTGR[0]["berat"],FALSE);
            $this->db->set("bobin","bobin + ".$arrDataTGR[0]["bobin"],FALSE);
            $this->db->set("payung","payung + ".$arrDataTGR[0]["payung"],FALSE);
            $this->db->set("payung_kuning","payung_kuning + ".$arrDataTGR[0]["payung_kuning"],FALSE);
            $this->db->where("kd_gd_roll",$arrDataTGR[0]["kd_gd_roll"]);
            $this->db->update("gudang_roll");
          }else{
            $this->db->set("stok","stok - ".$arrDataTGR[0]["berat"],FALSE);
            $this->db->set("bobin","bobin - ".$arrDataTGR[0]["bobin"],FALSE);
            $this->db->set("payung","payung - ".$arrDataTGR[0]["payung"],FALSE);
            $this->db->set("payung_kuning","payung_kuning - ".$arrDataTGR[0]["payung_kuning"],FALSE);
            $this->db->where("kd_gd_roll",$arrDataTGR[0]["kd_gd_roll"]);
            $this->db->update("gudang_roll");
          }

          $this->db->set("deleted",$param["deleted"]);
          $this->db->set("id_user",$param["idUser"]);
          $this->db->where("id",$param["idTransaksi"]);
          $this->db->update("transaksi_gudang_roll");
        }else{
          $this->db->set("deleted",$param["deleted"]);
          $this->db->set("id_user",$param["idUser"]);
          $this->db->where("id",$param["idTransaksi"]);
          $this->db->update("transaksi_gudang_roll");
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
  #=========================Update Function (Finish)=========================#
}

?>
