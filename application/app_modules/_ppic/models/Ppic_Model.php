<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ppic_Model extends CI_Model{
  #=======Automatic Generate Code (Start)=======#
  public function generatePpicCode(){
    $sessionId = $this->session->userdata("fabricationIdUser");
    $sessionLength = strlen($sessionId);
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_ppic,3)) AS kode FROM rencana_ppic WHERE SUBSTRING(kd_ppic,5,6) = DATE_FORMAT(NOW(),'%y%m%d') AND SUBSTRING(kd_ppic,11,$sessionLength) = '$sessionId'");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "00";
      }
      $tempCode = "00".(intval($arrMaxCode->kode)+1);
      $fixCode = "PPIC".date("ymd").$sessionId.substr($tempCode,(strlen($tempCode)-3));
    }
    return $fixCode;
  }
  #=======Automatic Generate Code (Finish)=======#

  #=======Insert Method (Start)=======#
  public function insertSpk($param){
    $this->db->trans_begin();
    $this->db->insert("rencana_ppic",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }
  #=======Insert Method (Finish)=======#

  #=======Select Method (Start)=======#
  public function selectStokBarangRoll($param){
    $this->datatables->select("kd_gd_roll,ukuran,tebal,FORMAT(stok,0) AS stok,bobin,payung,warna_plastik,merek,jns_brg");
    $this->datatables->from("gudang_roll");
    $this->datatables->where("jns_permintaan='$param' AND deleted='FALSE'");
    return $this->datatables->generate();
  }

  public function selectStokBarangHasil($param){
    $this->datatables->select("kd_gd_hasil,ukuran,tebal,stok_berat,FORMAT(stok_lembar,0) AS stok_lembar,warna_plastik,merek,sts_brg,jns_brg");
    $this->datatables->from("gudang_hasil");
    $this->datatables->where("jns_brg='$param' AND deleted='FALSE'");
    return $this->datatables->generate();
  }

  public function selectComboBoxValueRoll($param){
    $arrData = $this->db->query("SELECT kd_gd_roll,ukuran,merek,warna_plastik,jns_permintaan,jns_brg
                                 FROM gudang_roll
                                 WHERE jns_permintaan='$param[jns_permintaan]'
                                 AND deleted='FALSE'
                                 LIMIT 20");
    return $arrData->result_array();
  }

  public function selectComboBoxValueRollSearch($param){
    if(strpos($param["key"],"|") === FALSE){
      $arrData = $this->db->query("SELECT kd_gd_roll,ukuran,merek,warna_plastik,jns_permintaan,jns_brg
                                   FROM gudang_roll
                                   WHERE jns_permintaan='$param[jns_permintaan]'
                                   AND deleted='FALSE'
                                   AND
                                   (kd_gd_roll LIKE '%$param[key]%' OR
                                    ukuran LIKE '%$param[key]%' OR
                                    merek LIKE '%$param[key]%' OR
                                    warna_plastik LIKE '%$param[key]%'OR
                                    jns_brg LIKE '%$param[key]%')
                                   ORDER BY ukuran ASC, merek ASC, warna_plastik ASC
                                   LIMIT 20");
    }else{
      $Key = explode("|",$param["key"]);
      $arrData = $this->db->query("SELECT kd_gd_roll,ukuran,merek,warna_plastik,jns_permintaan,jns_brg
                                   FROM gudang_roll
                                   WHERE jns_permintaan='$param[jns_permintaan]'
                                   AND deleted='FALSE'
                                   AND
                                   (ukuran LIKE '%$Key[0]%' AND
                                    merek LIKE '%$Key[1]%' AND
                                    warna_plastik LIKE '%$Key[2]%')
                                   ORDER BY ukuran ASC, merek ASC, warna_plastik ASC");
    }

    return $arrData->result_array();
  }

  public function selectComboBoxValueHasil($param){
    if($param['jns_brg'] == "ALL"){
      $arrData = $this->db->query("SELECT kd_gd_hasil,ukuran,merek,warna_plastik,jns_permintaan,sts_brg,jns_brg
                                   FROM gudang_hasil WHERE jns_brg != 'SABLON'
                                   AND deleted='FALSE'
                                   ORDER BY ukuran ASC, merek ASC, warna_plastik ASC
                                   LIMIT 10");
    }else{
      if(empty($param["jns_permintaan"])){
        $arrData = $this->db->query("SELECT kd_gd_hasil,ukuran,merek,warna_plastik,jns_permintaan,sts_brg,jns_brg
                                     FROM gudang_hasil
                                     WHERE jns_brg='$param[jns_brg]'
                                     AND deleted='FALSE'
                                     ORDER BY ukuran ASC, merek ASC, warna_plastik ASC
                                     LIMIT 10");
      }else{
        $arrData = $this->db->query("SELECT kd_gd_hasil,ukuran,merek,warna_plastik,jns_permintaan,sts_brg,jns_brg
                                     FROM gudang_hasil
                                     WHERE jns_brg='$param[jns_brg]'
                                     AND jns_permintaan = '$param[jns_permintaan]'
                                     AND deleted='FALSE'
                                     ORDER BY ukuran ASC, merek ASC, warna_plastik ASC
                                     LIMIT 10");
      }
    }

    return $arrData->result_array();
  }

  public function selectComboBoxValueHasilSearch($param){
    if($param["jns_brg"] == "ALL"){
      if(strpos($param["key"],"|") === FALSE){
        $arrData = $this->db->query("SELECT kd_gd_hasil,ukuran,merek,warna_plastik,jns_permintaan,sts_brg,jns_brg
                                     FROM gudang_hasil
                                     WHERE jns_brg != 'SABLON'
                                     AND deleted='FALSE'
                                     AND
                                      (kd_gd_hasil LIKE '%$param[key]%' OR
                                      ukuran LIKE '%$param[key]%' OR
                                      merek LIKE '%$param[key]%' OR
                                      warna_plastik LIKE '%$param[key]%' OR
                                      jns_permintaan LIKE '%$param[key]%' OR
                                      sts_brg LIKE '%$param[key]%' OR
                                      jns_brg LIKE '%$param[key]%')
                                     ORDER BY ukuran ASC, merek ASC, warna_plastik ASC");
      }else{
        $KeySplit = explode("|",$param["key"]);
        $arrData = $this->db->query("SELECT kd_gd_hasil,ukuran,merek,warna_plastik,jns_permintaan,sts_brg,jns_brg
                                     FROM gudang_hasil
                                     WHERE jns_brg != 'SABLON'
                                     AND deleted='FALSE'
                                     AND ukuran LIKE '%$KeySplit[0]%'
                                     AND merek LIKE '%$KeySplit[1]%'
                                     AND warna_plastik LIKE '%$KeySplit[2]%'
                                     ORDER BY ukuran ASC, merek ASC, warna_plastik ASC");
      }
    }else{
      if(empty($param["jns_permintaan"])){
        if(strpos($param["key"],"|") === FALSE){
          $arrData = $this->db->query("SELECT kd_gd_hasil,ukuran,merek,warna_plastik,jns_permintaan,sts_brg,jns_brg
                                       FROM gudang_hasil
                                       WHERE jns_brg='$param[jns_brg]'
                                       AND deleted='FALSE'
                                       AND
                                       (kd_gd_hasil LIKE '%$param[key]%' OR
                                        ukuran LIKE '%$param[key]%' OR
                                        merek LIKE '%$param[key]%' OR
                                        warna_plastik LIKE '%$param[key]%' OR
                                        jns_permintaan LIKE '%$param[key]%' OR
                                        sts_brg LIKE '%$param[key]%' OR
                                        jns_brg LIKE '%$param[key]%')
                                       ORDER BY ukuran ASC, merek ASC, warna_plastik ASC");
        }else{
          $KeySplit = explode("|",$param["key"]);
          $arrData = $this->db->query("SELECT kd_gd_hasil,ukuran,merek,warna_plastik,jns_permintaan,sts_brg,jns_brg
                                       FROM gudang_hasil
                                       WHERE jns_brg='$param[jns_brg]'
                                       AND deleted='FALSE'
                                       AND ukuran LIKE '%$KeySplit[0]%'
                                       AND merek LIKE '%$KeySplit[1]%'
                                       AND warna_plastik LIKE '%$KeySplit[2]%'
                                       ORDER BY ukuran ASC, merek ASC, warna_plastik ASC");
        }
      }else{
        if(strpos($param["key"],"|") === FALSE) {
          $arrData = $this->db->query("SELECT kd_gd_hasil,ukuran,merek,warna_plastik,jns_permintaan,sts_brg,jns_brg
                                       FROM gudang_hasil
                                       WHERE jns_brg='$param[jns_brg]'
                                       AND deleted='FALSE'
                                       AND
                                       jns_permintaan = '$param[jns_permintaan]' AND
                                       (kd_gd_hasil LIKE '%$param[key]%' OR
                                        ukuran LIKE '%$param[key]%' OR
                                        merek LIKE '%$param[key]%' OR
                                        warna_plastik LIKE '%$param[key]%' OR
                                        jns_permintaan LIKE '%$param[key]%' OR
                                        sts_brg LIKE '%$param[key]%' OR
                                        jns_brg LIKE '%$param[key]%')
                                       ORDER BY ukuran ASC, merek ASC, warna_plastik ASC");
        }else{
          $KeySplit = explode("|",$param["key"]);
          $arrData = $this->db->query("SELECT kd_gd_hasil,ukuran,merek,warna_plastik,jns_permintaan,sts_brg,jns_brg
                                       FROM gudang_hasil
                                       WHERE jns_brg='$param[jns_brg]'
                                       AND deleted='FALSE'
                                       AND ukuran LIKE '%$KeySplit[0]%'
                                       AND merek LIKE '%$KeySplit[1]%'
                                       AND warna_plastik LIKE '%$KeySplit[2]%'
                                       ORDER BY ukuran ASC, merek ASC, warna_plastik ASC");
        }
      }
    }
    return $arrData->result_array();
  }

  public function selectCountPesananGlobalBaru(){
    $now = date("Y-m-d");
    $arrData = $this->db->query("SELECT COUNT(no_order) AS jumlah_pesanan FROM pesanan WHERE sts_pesanan = 'OPEN' AND (jumlah_approve >= 2 AND deleted='FALSE' OR approve_cabang = 'TRUE' AND deleted='FALSE')");
    return $arrData->result_array();
  }

  public function selectCountPesananMarketingBaru(){
    $now = date("Y-m-d");
    $arrData = $this->db->query("SELECT COUNT(no_order) AS jumlah_pesanan FROM pesanan WHERE sts_pesanan = 'OPEN' AND jumlah_approve >= 2 AND approve_cabang = 'FALSE' AND deleted='FALSE'");
    return $arrData->result_array();
  }

  public function selectCountPesananCabangBaru(){
    $now = date("Y-m-d");
    $arrData = $this->db->query("SELECT COUNT(no_order) AS jumlah_pesanan FROM pesanan WHERE sts_pesanan = 'OPEN' AND approve_cabang = 'TRUE' AND deleted='FALSE'");
    return $arrData->result_array();
  }

  public function selectFakturPesanan($param){
    $arrFakturPesanan = $this->db->query("SELECT P.no_order,P.proof,DATE_FORMAT(P.tgl_pesan,'%d-%M-%Y') AS tgl_pesan,
                                                 DATE_FORMAT(P.tgl_estimasi,'%d-%M-%Y') AS tgl_estimasi, P.nm_pemesan,
                                                 P.no_po,P.note,P.foto_1,P.foto_2,P.expedisi,P.payment_method,P.expedisi,
                                                 IF(P.pajak='TRUE','P','N') pajak,P.jns_order,P.ket_proof, P.mata_uang, P.sales,
                                                 P.dp,C.alamat,C.tlp_kantor,
                                                 IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan,
                                                 U.username,U.ttd,PD.keterangan,P.approve_cabang
                                          FROM pesanan P
                                          INNER JOIN pesanan_detail PD ON P.no_order = PD.no_order
                                          INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                          INNER JOIN users U ON P.id_user = U.id_user
                                          WHERE P.no_order = '$param' AND P.deleted='FALSE'");
    return $arrFakturPesanan->result_array();
  }

  public function selectFakturPesananDetailProduksi($param){
    $arrFakturPesananDetail = $this->db->query("SELECT FORMAT(PD.jumlah,1) AS jumlah,PD.satuan,
                                                       GH.ukuran,PD.merek,GH.merek AS nm_brg,
                                                       GH.warna_plastik,PD.warna_cetak,PD.sm,PD.dll,PD.keterangan,P.note
                                                FROM pesanan_detail PD
                                                LEFT JOIN pesanan P ON P.no_order = PD.no_order
                                                LEFT JOIN gudang_hasil GH ON PD.kd_gd_hasil = GH.kd_gd_hasil
                                                LEFT JOIN gudang_bahan GB ON PD.kd_gd_bahan = GB.kd_gd_bahan
                                                WHERE PD.no_order = '$param' AND PD.deleted='FALSE'");
    return $arrFakturPesananDetail->result_array();
  }

  public function selectOrderMarketing($param){
    $this->datatables->select("P.no_order,P.kd_order,P.tgl_pesan,P.foto_1,P.foto_2,
                               CONCAT(ROUND(PD.jumlah),' ',PD.satuan) AS jumlah,PD.merek, GH.merek as nm_barang,
                               GH.ukuran,GH.warna_plastik,PD.warna_cetak,PD.sm,PD.dll,P.note,
                               IF(PD.tgl_kirim_gudang IS NULL,'FALSE','TRUE') AS kirim_gudang,P.sts_print,GH.jns_brg,
                               IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->where("P.deleted='FALSE' AND
                              PD.deleted='FALSE' AND
                              P.sts_pesanan != 'TERKIRIM' AND
                              PD.sts_kirim = 'BELUM TERKIRIM' AND
                              PD.tgl_kirim IS NULL AND
                              P.tgl_kirim IS NULL AND
                              P.jumlah_approve >= 2 AND
                              DATE_FORMAT(P.tgl_pesan,'%Y-%m')='$param'");
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("customer C","P.kd_cust = C.kd_cust","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->db->order_by("P.tgl_pesan DESC,P.no_order ASC");
    return $this->datatables->generate();
  }

  public function selectOrderMarketingTerkirim(){
    $this->datatables->select("P.tgl_pesan,P.nm_pemesan,P.no_order,P.kd_order,CONCAT(PD.jumlah,' ',PD.satuan) AS jumlah,PD.sts_pesanan,
                               CONCAT(PD.jumlah_kirim,' ',PD.satuan) AS jumlah_kirim,CONCAT(PD.jumlah - PD.jumlah_kirim,' ',PD.satuan) AS sisa,PD.jumlah_kirim as jml_kirim,
                               GH.ukuran,GH.warna_plastik,PD.id_dp,PD.merek,PD.dll,PD.sts_pesanan,
                               IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) nm_perusahaan,PD.sts_pesanan,GH.jns_brg");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->where("P.deleted = 'FALSE' AND PD.deleted = 'FALSE' AND PD.tgl_kirim_gudang IS NOT NULL AND P.approve_cabang='FALSE'");
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("customer C","P.kd_cust = C.kd_cust","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->db->order_by("P.tgl_pesan DESC,P.no_order ASC");
    return $this->datatables->generate();
  }

  public function selectOrderDetail($param){
    $this->datatables->select("P.no_order,P.kd_order,P.tgl_pesan,P.nm_pemesan,
                               CONCAT(ROUND(PD.jumlah),' ',PD.satuan) AS jumlah,PD.merek,
                               GH.ukuran,GH.warna_plastik,PD.warna_cetak,PD.sm,PD.dll,P.note,
                               IF(PD.tgl_kirim_gudang IS NULL,'FALSE','TRUE') AS kirim_gudang,P.sts_print,
                               IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->where("P.deleted='FALSE' AND
                              PD.deleted='FALSE' AND
                              P.sts_pesanan != 'TERKIRIM' AND
                              P.no_order=",$param);
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("customer C","P.kd_cust = C.kd_cust","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->db->order_by("P.tgl_pesan DESC,P.no_order ASC");
    return $this->datatables->generate();
  }

  public function selectOrderCabang($param){
    $this->datatables->select("P.no_order,P.no_po,P.tgl_pesan,P.nm_pemesan,
                               CONCAT(ROUND(PD.jumlah),' ',PD.satuan) AS jumlah,PD.merek,
                               GH.ukuran,GH.warna_plastik,PD.warna_cetak,PD.sm,PD.dll,P.note,
                               IF(PD.tgl_kirim_gudang IS NULL,'FALSE','TRUE') AS kirim_gudang,P.sts_print,
                               C.nm_perusahaan,PD.keterangan,GH.jns_brg");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->where("P.deleted='FALSE' AND
                              PD.deleted='FALSE' AND
                              P.sts_pesanan != 'TERKIRIM' AND
                              PD.sts_kirim = 'BELUM TERKIRIM' AND
                              PD.tgl_kirim IS NULL AND
                              P.tgl_kirim IS NULL AND
                              P.approve_cabang = 'TRUE' AND
                              P.sts_pesanan != 'WAITING' AND
                              DATE_FORMAT(P.tgl_pesan,'%Y-%m')='$param'");
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("customer C","P.kd_cust = C.kd_cust","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->db->order_by("P.tgl_pesan DESC,P.no_order ASC");
    return $this->datatables->generate();
  }

  public function selectOrderCabangTerkirim(){
    $this->datatables->select("P.tgl_pesan,P.nm_pemesan,P.no_order,P.no_po,CONCAT(PD.jumlah,' ',PD.satuan) AS jumlah,
                               CONCAT(PD.jumlah_kirim,' ',PD.satuan) AS jumlah_kirim,CONCAT(PD.jumlah - PD.jumlah_kirim,' ',PD.satuan) AS sisa,PD.jumlah_kirim as jml_kirim,
                               GH.ukuran,GH.warna_plastik,PD.id_dp,PD.merek,PD.dll,PD.sts_pesanan,C.nm_perusahaan,PD.sts_pesanan");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->where("P.deleted = 'FALSE' AND PD.deleted = 'FALSE' AND PD.tgl_kirim_gudang IS NOT NULL AND P.approve_cabang='TRUE'");
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("customer C","P.kd_cust = C.kd_cust","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->db->order_by("P.tgl_pesan DESC,P.no_order ASC");
    return $this->datatables->generate();
  }

  public function selectOrderDetailCabang($param){
    $this->datatables->select("P.no_order,P.no_po,P.tgl_pesan,P.nm_pemesan,
                               CONCAT(ROUND(PD.jumlah),' ',PD.satuan) AS jumlah,PD.merek,
                               GH.ukuran,GH.warna_plastik,PD.warna_cetak,PD.sm,PD.dll,P.note,
                               IF(PD.tgl_kirim_gudang IS NULL,'FALSE','TRUE') AS kirim_gudang,P.sts_print,
                               C.nm_perusahaan");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->where("P.deleted='FALSE' AND
                              PD.deleted='FALSE' AND
                              P.sts_pesanan != 'TERKIRIM' AND
                              P.approve_cabang = 'TRUE' AND
                              P.sts_pesanan != 'WAITING' AND
                              DATE_FORMAT(P.tgl_pesan,'%Y-%m')=DATE_FORMAT(NOW(),'%Y-%m') AND P.no_order=",$param);
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("customer C","P.kd_cust = C.kd_cust","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->db->order_by("P.tgl_pesan DESC,P.no_order ASC");
    return $this->datatables->generate();
  }

  public function selectDetailBarangRoll($param){
    $result = $this->db->query("SELECT merek,warna_plastik,jns_permintaan,ukuran FROM gudang_roll WHERE kd_gd_roll = '$param'");
    return json_encode($result->result_array());
  }

  public function selectDetailBarangHasil($param){
    $result = $this->db->query("SELECT merek,warna_plastik,jns_permintaan,ukuran,jns_brg,sts_brg
                                FROM gudang_hasil WHERE kd_gd_hasil = '$param'");
    return json_encode($result->result_array());
  }

  public function selectListSpk($param){
    if($param == "POTONG"){
      $dateNow = date("Y-m-d",strtotime("+1 Days"));
    }else{
      $dateNow = date("Y-m-d");
    }
    $this->datatables->select("kd_ppic,tgl_rencana,nm_cust,jns_permintaan,ukuran,
                               warna_plastik,tebal,merek,ket_merek,berat,satuan,prioritas,
                               FORMAT(ROUND(jumlah_permintaan),0) AS jumlah_permintaan,FORMAT(ROUND(sisa),0) AS sisa,
                               strip,keterangan,sts_pengerjaan,permintaan_mesin,
                               foto_depan,foto_belakang,warna_cetak,warna_cat,ket_mandor");
    $this->datatables->from("rencana_ppic");
    $this->datatables->where("deleted='FALSE' AND tgl_rencana='$dateNow' AND bagian=",$param);
    $this->db->order_by("LENGTH(kd_ppic) DESC, kd_ppic DESC");
    return $this->datatables->generate();
  }

  public function selectListSpkPeriode($param){
    $this->datatables->select("kd_ppic,tgl_rencana,nm_cust,jns_permintaan,ukuran,
                               warna_plastik,tebal,merek,ket_merek,berat,satuan,prioritas,
                               ROUND(jumlah_permintaan) AS jumlah_permintaan,ROUND(sisa) AS sisa,
                               strip,keterangan,sts_pengerjaan,permintaan_mesin,
                               foto_depan,foto_belakang,warna_cetak,warna_cat,ket_mandor");
    $this->datatables->from("rencana_ppic");
    $this->datatables->where("tgl_rencana BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND deleted='FALSE' AND bagian=",$param["bagian"]);
    $this->db->order_by("LENGTH(kd_ppic) DESC, kd_ppic DESC");
    return $this->datatables->generate();
  }

  public function selectListHistorySpk($param){
    $date = date("Y-m-d",strtotime("-40 days"));
    $this->datatables->select("kd_ppic,tgl_rencana,nm_cust,jns_permintaan,ukuran,
                               warna_plastik,tebal,merek,ket_merek,berat,satuan,prioritas,
                               FORMAT(ROUND(jumlah_permintaan),0) AS jumlah_permintaan,FORMAT(ROUND(sisa),0) AS sisa,
                               strip,keterangan,sts_pengerjaan,permintaan_mesin,foto_depan,foto_belakang,warna_cetak,warna_cat,
                               diperbarui");
    $this->datatables->from("rencana_ppic");
    $this->datatables->where("deleted='FALSE' AND tgl_rencana='$date' AND bagian=",$param);
    $this->db->order_by("tgl_rencana DESC,kd_ppic DESC");
    return $this->datatables->generate();
  }

  public function selectListHistorySpkPeriode($param){
    $this->datatables->select("kd_ppic,tgl_rencana,nm_cust,jns_permintaan,ukuran,
                               warna_plastik,tebal,merek,ket_merek,berat,satuan,prioritas,
                               ROUND(jumlah_permintaan) AS jumlah_permintaan,ROUND(sisa) AS sisa,
                               strip,keterangan,sts_pengerjaan,permintaan_mesin,foto_depan,foto_belakang,warna_cetak,warna_cat,
                               diperbarui");
    $this->datatables->from("rencana_ppic");
    $this->datatables->where("MONTH(tgl_rencana)='$param[bulan]' AND YEAR(tgl_rencana)='$param[tahun]' AND deleted='FALSE' AND bagian=",$param["bagian"]);
    $this->db->order_by("tgl_rencana DESC");
    return $this->datatables->generate();
  }

  public function selectDetailSpk($param){
    $result = $this->db->query("SELECT * FROM rencana_ppic WHERE kd_ppic = '$param'");
    return json_encode($result->result_array());
  }

  public function selectCountRencanaTrash(){
    $result = $this->db->query("SELECT COUNT('kd_ppic') AS total FROM rencana_ppic WHERE deleted='TRUE'");
    return $result->result_array();
  }

  public function selectListTrashSpk(){
    $this->datatables->select("kd_ppic,tgl_rencana,nm_cust,merek,jns_permintaan,ukuran,warna_plastik,bagian");
    $this->datatables->from("rencana_ppic");
    $this->datatables->where("deleted=","TRUE");
    return $this->datatables->generate();
  }

  public function selectListRencanaExtruder($param){
    $this->datatables->select("EXT.kd_extruder,EXT.tgl_rencana,CONCAT(MSN.no_mesin,' ',MSN.sts_mesin) AS mesin,EXT.berat,EXT.nm_cust,EXT.merek,EXT.ukuran,EXT.warna,EXT.tebal,EXT.strip,EXT.jml_permintaan,PPIC.sisa,EXT.sts_pengerjaan,PPIC.keterangan");
    $this->datatables->from("rencana_extruder EXT");
    $this->datatables->where("(EXT.sts_pengerjaan ='PROGRESS' OR EXT.sts_pengerjaan ='PENDING')  AND EXT.deleted=","FALSE");
    $this->datatables->join("rencana_ppic PPIC","EXT.kd_ppic = PPIC.kd_ppic","LEFT");
    $this->datatables->join("mesin MSN","EXT.kd_mesin = MSN.kd_mesin","LEFT");
    $this->db->order_by("EXT.kd_extruder DESC");
    return $this->datatables->generate();
  }

  public function selectListRencanaCutting($param){
    $this->datatables->select("CUT.kd_potong,CUT.tgl_rencana,CUT.no_mesin,CUT.customer,CUT.merek,CUT.ukuran,CUT.warna_plastik,CUT.berat,CUT.tebal,CUT.strip,CONCAT(CUT.jml_permintaan,' ',CUT.satuan) AS jml_permintaan,PPIC.sisa,CUT.sts_pengerjaan,PPIC.keterangan");
    $this->datatables->from("rencana_potong CUT");
    $this->datatables->where("CUT.tgl_rencana = '$param[tanggal]' AND CUT.deleted=","FALSE");
    $this->datatables->join("rencana_ppic PPIC","CUT.kd_ppic = PPIC.kd_ppic","LEFT");
    $this->db->order_by("CUT.kd_potong DESC");
    return $this->datatables->generate();
  }

  public function selectListRencanaPrinting($param){
    $this->datatables->select("PRT.kd_cetak,PRT.tgl_rencana,PRT.no_mesin,PRT.customer,PRT.merek,PRT.ukuran,PRT.warna_plastik,PRT.tebal,PRT.strip,CONCAT(PRT.jml_permintaan,' ',PPIC.satuan) AS jml_permintaan,PPIC.sisa,PRT.sts_pengerjaan,PPIC.keterangan");
    $this->datatables->from("rencana_cetak PRT");
    $this->datatables->where("PRT.tgl_rencana = '$param[tanggal]' AND PRT.deleted=","FALSE");
    $this->datatables->join("rencana_ppic PPIC","PRT.kd_ppic = PPIC.kd_ppic","LEFT");
    $this->db->order_by("PRT.kd_cetak DESC");
    return $this->datatables->generate();
  }

  public function selectListRencanaSablon($param){
    $this->datatables->select("SBN.kd_sablon,SBN.tgl_rencana,SBN.customer,SBN.merek,PPIC.jns_permintaan,SBN.ukuran,SBN.warna_plastik,SBN.warna_sablon,CONCAT(SBN.jml_rencana,' ',PPIC.satuan) AS jml_rencana,SBN.sts_pengerjaan");
    $this->datatables->from("rencana_sablon SBN");
    $this->datatables->where("SBN.tgl_rencana = '$param[tanggal]' AND SBN.deleted=","FALSE");
    $this->datatables->join("rencana_ppic PPIC","SBN.kd_ppic = PPIC.kd_ppic","LEFT");
    $this->db->order_by("SBN.kd_sablon DESC");
    return $this->datatables->generate();
  }

  public function selectDataHasilExtruder($param){
    $Q = "SELECT HE.keterangan, HE.jumlah_selesai, HE.biji_warna, HE.hasil_ukuran,
                 HE.hasil_berat, HE.roll_pipa, HE.jumlah_biji_warna, HE.merek,
                 HE.roll_lembar, HE.shift, HE.jenis_roll,
                 RE.tebal, RP.ket_merek
          FROM transaksi_hasil_extruder HE
          INNER JOIN rencana_extruder RE ON HE.kd_extruder = RE.kd_extruder
          INNER JOIN rencana_ppic RP ON RE.kd_ppic = RP.kd_ppic
          WHERE HE.tgl_rencana = '$param[tgl_rencana]'
          AND HE.shift = '$param[shift]'
          AND HE.jns_brg = '$param[jns_brg]'
          AND HE.deleted = 'FALSE'
          AND RE.deleted='FALSE'
          ORDER BY HE.biji_warna ASC";

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

  public function selectLaporanHasilExtruderGlobal($param){
    $Q = "SELECT TDJE.tgl_rencana, SUM(THE.jumlah_selesai) AS totalGlobal, SUM(TDJE.jumlah_apal) AS totalApalGlobal
          FROM transaksi_data_job_extruder TDJE
          JOIN transaksi_hasil_extruder THE ON TDJE.tgl_rencana = THE.tgl_rencana
          AND TDJE.jns_brg = THE.jns_brg
          AND TDJE.shift = THE.shift
          WHERE TDJE.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'
          AND TDJE.jns_brg = '$param[jnsBrg]'
          AND TDJE.shift IN ('1','2','3')
          GROUP BY TDJE.tgl_rencana
          ORDER BY TDJE.tgl_rencana ASC";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectListHistoryRencanaPotong($param){
    $this->datatables->select("THRP.id_history, THRP.tgl_rencana_awal, THRP.tgl_rencana_sekarang,
                               TSHP.jumlah_lembar, TSHP.jumlah_berat, CONCAT(U.username, ' ', THRP.diperbarui) AS diperbarui");
    $this->datatables->from("transaksi_history_rencana_potong THRP");
    $this->datatables->join("rencana_potong RC","THRP.kd_potong = RC.kd_potong","INNER");
    $this->datatables->join("transaksi_sub_hasil_potong TSHP","TSHP.kd_potong = RC.kd_potong","LEFT");
    $this->datatables->join("users U","THRP.id_user = U.id_user","INNER");
    $this->datatables->where("THRP.kd_potong = '$param' AND
                              THRP.deleted='FALSE' AND
                              RC.deleted='FALSE'");
    $this->db->order_by("THRP.id_history","ASC");
    return $this->datatables->generate();
  }

  public function selectHasilJobPotong($param){
    $this->datatables->select("RC.no_mesin,TSHP.kd_gd_hasil,THP.kd_hasil_potong,THP.status_bon,THP.tgl_rencana,
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
                              AND THP.tgl_rencana BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]'");
    $this->db->order_by("THP.kd_hasil_potong","DESC");
    return $this->datatables->generate();
  }
  #=======Select Method (Finish)=======#

  #=======Update Method (Start)=======#
  public function updatePesanan($param){
    $this->db->trans_begin();
    $this->db->where("no_order",$param["no_order"]);
    $this->db->update("pesanan",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function updatePesananDetail($param){
    $this->db->trans_begin();
    $this->db->where("no_order",$param["no_order"]);
    $this->db->update("pesanan_detail",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function updateSpk($param){
    $this->db->trans_begin();
    $this->db->where("kd_ppic",$param["kd_ppic"]);
    $this->db->update("rencana_ppic",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function getHasilGlobalPotong($tglAwal,$tglAkhir)
  {
    $Q = "SELECT FORMAT(SUM(IF(GR.jns_permintaan = 'POLOS',TSHP.jumlah_lembar,0)),0) AS jumlahLembarPolos,
                 FORMAT(SUM(IF(GR.jns_permintaan = 'POLOS',TSHP.jumlah_berat,0)),2) AS jumlahBeratPolos,
                 FORMAT(SUM(IF(GR.jns_permintaan = 'CETAK',TSHP.jumlah_lembar,0)),0) AS jumlahLembarCetak,
                 FORMAT(SUM(IF(GR.jns_permintaan = 'CETAK',TSHP.jumlah_berat,0)),2) AS jumlahBeratCetak,
                 THP.tgl_rencana
          FROM transaksi_sub_hasil_potong TSHP
          INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN gudang_roll GR ON TSHP.kd_gd_roll = GR.kd_gd_roll
          WHERE THP.tgl_rencana BETWEEN '$tglAwal' and '$tglAkhir'
          AND THP.deleted='FALSE'
          AND TSHP.deleted='FALSE'
          AND GR.deleted='FALSE' GROUP BY THP.tgl_rencana";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function getHasilGlobalPotongDanApal($tglAwal,$tglAkhir)
  {
    $result = array();
    $Q = "SELECT FORMAT(SUM(IF(GR.jns_permintaan = 'POLOS',TSHP.jumlah_berat,0)),2) AS jumlahBeratPolos,
                 FORMAT(SUM(IF(GR.jns_permintaan = 'CETAK',TSHP.jumlah_berat,0)),2) AS jumlahBeratCetak,
                 (FORMAT(SUM(IF(GR.jns_permintaan = 'POLOS',TSHP.jumlah_berat,0))+SUM(IF(GR.jns_permintaan = 'CETAK',TSHP.jumlah_berat,0)),2)) as totalBerat,
                 THP.tgl_rencana
          FROM transaksi_sub_hasil_potong TSHP
          INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN gudang_roll GR ON TSHP.kd_gd_roll = GR.kd_gd_roll
          WHERE THP.tgl_rencana BETWEEN '$tglAwal' and '$tglAkhir'
          AND THP.deleted='FALSE'
          AND TSHP.deleted='FALSE'
          AND GR.deleted='FALSE' GROUP BY THP.tgl_rencana";
    array_push($result,$this->db->query($Q)->result_array());

    // $Q2 = "SELECT FORMAT(SUM(jumlah_apal_global),2) as apal from(SELECT RC.customer, RC.merek, RC.no_mesin, RC.warna_plastik, RC.ukuran,THP.jumlah_apal_global,THP.tgl_rencana FROM transaksi_hasil_potong THP INNER JOIN transaksi_sub_hasil_potong TSHP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong INNER JOIN rencana_potong RC ON TSHP.kd_potong = RC.kd_potong WHERE (THP.tgl_rencana between '$tglAwal' and '$tglAkhir' and RC.jns_permintaan = 'POLOS' AND RC.deleted='FALSE' AND THP.deleted='FALSE' AND TSHP.deleted='FALSE') or (THP.tgl_rencana between '$tglAwal' and '$tglAkhir' and RC.jns_permintaan IN('CETAK','CETAK/POLOS') AND RC.deleted='FALSE' AND THP.deleted='FALSE' AND TSHP.deleted='FALSE') GROUP BY RC.kd_gd_roll, THP.tgl_rencana ) AS test GROUP BY tgl_rencana";

    $Q2 = "SELECT SUM(`jumlah_apal`) as apal FROM `transaksi_detail_history_apal` WHERE `bagian` = 'potong' and `tgl_transaksi` BETWEEN '$tglAwal' AND '$tglAkhir' AND deleted = 'FALSE' GROUP BY tgl_transaksi";

    array_push($result,$this->db->query($Q2)->result_array());
    return json_encode($result);
  }

  public function getHasilGlobalSablon($tglAwal,$tglAkhir)
  {
    $data = $this->db->query("select a.customer , b.* from rencana_sablon a join transaksi_hasil_sablon b on a.kd_sablon = b.kd_sablon where b.tanggal BETWEEN '$tglAwal' and '$tglAkhir' and b.status = 'FINISH'")->result_array();
    return json_encode($data);
  }

  public function getApalGlobalPotong($tglAwal,$tglAkhir)
  {
    $Q = "SELECT THP.tgl_jadi, FORMAT(SUM(THP.jumlah_apal_global),2) as jumlah_apal_global, GR.jns_permintaan
          FROM transaksi_sub_hasil_potong TSHP
          INNER JOIN transaksi_hasil_potong THP ON TSHP.kd_hasil_potong = THP.kd_hasil_potong
          INNER JOIN gudang_roll GR ON TSHP.kd_gd_roll = GR.kd_gd_roll
          WHERE THP.tgl_jadi BETWEEN '$tglAwal' and '$tglAkhir'
          AND THP.deleted='FALSE'
          AND TSHP.deleted='FALSE'
          AND GR.deleted='FALSE' GROUP BY THP.tgl_jadi";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function getHasilGlobalCetak($tglAwal,$tglAkhir)
  {
    $q = "select RC.customer, RC.merek, RC.ukuran, RC.warna_plastik,
                 RC.warna_cat, TDHC.jumlah_berat_pengambilan,
                 TDHC.jumlah_bobin_pengambilan, TDHC.jumlah_payung_pengambilan,
                 TDHC.jumlah_payung_kuning_pengambilan, TDHC.jumlah_hasil_selesai,
                 TDHC.jumlah_hasil_bobin, TDHC.jumlah_hasil_payung,
                 TDHC.jumlah_hasil_payung_kuning, THC.berat_roll, TDHC.jumlah_apal,
                 FORMAT(THC.plusminus,2) as plusminus, THC.kd_hasil_cetak, THC.tgl_transaksi
          from transaksi_hasil_cetak THC
          inner join transaksi_detail_hasil_cetak TDHC on TDHC.kd_hasil_cetak = THC.kd_hasil_cetak
          inner join rencana_cetak RC on THC.kd_cetak = RC.kd_cetak
          where THC.tgl_transaksi BETWEEN '$tglAwal' AND '$tglAkhir'
                AND THC.deleted='FALSE'
                AND TDHC.deleted='FALSE'
                AND RC.deleted='FALSE'";
    $data = $this->db->query($q)->result_array();
    return json_encode($data);
  }

  public function selectFakturPesananMarketing($param){
    $arrFakturPesanan = $this->db->query("SELECT P.no_order,P.proof,DATE_FORMAT(P.tgl_pesan,'%d-%M-%Y') AS tgl_pesan,
                                                 DATE_FORMAT(P.tgl_estimasi,'%d-%M-%Y') AS tgl_estimasi, P.nm_pemesan,
                                                 P.no_po,P.note,P.foto_1,P.foto_2,P.expedisi,P.payment_method,P.expedisi,
                                                 IF(P.pajak='TRUE','P','N') pajak,P.jns_order,P.ket_proof, P.mata_uang, P.sales,
                                                 P.dp,C.alamat,C.tlp_kantor,
                                                 IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan,
                                                 U.username,U.ttd
                                          FROM pesanan P
                                          INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                          INNER JOIN users U ON P.id_user = U.id_user
                                          WHERE P.no_order = '$param' AND P.deleted='FALSE'");
    return $arrFakturPesanan->result_array();
  }

  public function selectFakturPesananDetailProduksiMarketing($param){
    $arrFakturPesananDetail = $this->db->query("SELECT PD.keterangan, FORMAT(PD.jumlah,1) AS jumlah,PD.satuan,
                                                       GH.ukuran,PD.merek,GH.merek AS nm_brg,
                                                       GH.warna_plastik,PD.warna_cetak,PD.sm,PD.dll
                                                FROM pesanan_detail PD
                                                LEFT JOIN gudang_hasil GH ON PD.kd_gd_hasil = GH.kd_gd_hasil
                                                LEFT JOIN gudang_bahan GB ON PD.kd_gd_bahan = GB.kd_gd_bahan
                                                WHERE PD.no_order = '$param' AND PD.deleted='FALSE'");
    return $arrFakturPesananDetail->result_array();
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
  #=======Update Method (Finish)=======#

  #=======Delete Method (Start)=======#

  #=======Delete Method (Finish)=======#
}
?>
