<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketing_Models extends CI_Model{
#===========================================GENERATE CODE METHOD START===========================================
  public function getMaxCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_cust,6)) AS kode FROM customer");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "00000";
      }
      $tempCode = "00000".(intval($arrMaxCode->kode)+1);
      $fixCode = "CUST".date("y").substr($tempCode,(strlen($tempCode)-6))."XX";
    }
    return $fixCode;
  }

  public function getMaxNoOrder(){
    $sessionId = $this->session->userdata("fabricationIdUser");
    $sessionLength = strlen($sessionId);
    $maxCode = $this->db->query("SELECT MAX(RIGHT(no_order,2)) AS kode FROM pesanan WHERE SUBSTRING(no_order,3,6) = DATE_FORMAT(CURDATE(),'%y%m%d') AND SUBSTRING(no_order,9,$sessionLength) = '$sessionId'");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "00";
      }
      $tempCode = "0".($arrMaxCode->kode+1);
      $fixCode = "NO".date("ymd").$sessionId.substr($tempCode,(strlen($tempCode)-2));
    }
    return $fixCode;
  }
#===========================================GENERATE CODE METHOD END===========================================

#===========================================SELECT METHOD START===========================================
  public function selectKabupaten(){
    $this->db->select("nama");
    $arrKabupaten = $this->db->get("wilayah_kabupaten");
    return $arrKabupaten->result_array();
  }

  public function selectProvinsi(){
    $this->db->select("nama");
    $arrProvinsi = $this->db->get("wilayah_provinsi");
    return $arrProvinsi->result_array();
  }

  public function selectNegara(){
    $this->db->select("nm_negara");
    $arrNegara = $this->db->get("wilayah_negara");
    return $arrNegara->result_array();
  }

  public function selectCustomer(){
    $this->db->select("kd_cust,nm_perusahaan,nm_owner,nm_purchasing,tlp_kantor,alamat,kota,kode_pos");
    $this->db->where("deleted","FALSE");
    $arrCustomer = $this->db->get("customer");
    return $arrCustomer->result_array();
  }

  public function selectCustomerId($param){
    $arrCustomerId = $this->db->get_where("customer",array("kd_cust"=>$param,"deleted"=>"FALSE"));
    return $arrCustomerId->result_array();
  }

  public function selectProductService($param){
    $arrProductService = $this->db->get_where("servis_produk",array('kd_cust' => $param));
    return $arrProductService->result_array();
  }

  public function selectNoteProductService($param){
    $this->db->select("note");
    $arrNoteProductService = $this->db->get_where("servis_produk",array("id_sp" => $param));
    return $arrNoteProductService->result_array();
  }

  public function selectNoteCustomer($param){
    $this->db->select("note");
    $arrNoteCustomer = $this->db->get_where("customer",array("kd_cust" => $param));
    return $arrNoteCustomer->result_array();
  }

  public function selectProductServiceId($param){
    $arrProductService = $this->db->get_where("servis_produk",array("id_sp" => $param));
    return $arrProductService->result_array();
  }

  public function selectCustomerLike($param){
    $arrCustomerLike = $this->db->query("SELECT kd_cust,IF(nm_perusahaan_update IS NULL, nm_perusahaan, nm_perusahaan_update) AS nm_perusahaan
                                         FROM customer
                                         WHERE (nm_perusahaan LIKE '%$param%'
                                                OR kd_cust LIKE '%$param%'
                                                OR nm_purchasing LIKE '%$param%'
                                                OR nm_perusahaan_update LIKE '%$param%'
                                                OR nm_purchasing_update LIKE '%$param%')
                                         AND deleted='FALSE'");
    return $arrCustomerLike->result_array();
  }

  public function selectCustomerLimit20(){
    $arrCustomerLike = $this->db->query("SELECT kd_cust,IF(nm_perusahaan_update IS NULL, nm_perusahaan, nm_perusahaan_update) AS nm_perusahaan FROM customer WHERE deleted='FALSE' ORDER BY kd_cust ASC LIMIT 20");
    return $arrCustomerLike->result_array();
  }

  public function selectPesananDetailsTemp($param,$param2){
    $Q = "SELECT DPT.id_dp, DPT.jumlah, DPT.satuan, DPT.harga, DPT.merek, DPT.mata_uang, GH.ukuran, DPT.warna_cetak, DPT.sm, DPT.dll
          FROM pesanan_detail_temp DPT
          LEFT JOIN gudang_hasil GH ON DPT.kd_gd_hasil = GH.kd_gd_hasil
          LEFT JOIN gudang_bahan GB ON DPT.kd_gd_bahan = GB.kd_gd_bahan
          WHERE (DPT.kd_gd_hasil = GH.kd_gd_hasil OR
                 DPT.kd_gd_bahan = GB.kd_gd_bahan) AND
                 DPT.no_order = '$param' AND
                 DPT.kd_cust = '$param2'
          ORDER BY DPT.id_dp DESC ";
    $arrPesananDetailsTemp = $this->db->query($Q);
    return $arrPesananDetailsTemp->result_array();
  }

  public function selectPesananDetails($param){
    $Q = "SELECT DP.id_dp, DP.jumlah, DP.satuan, DP.harga, DP.merek, DP.mata_uang, GH.ukuran, DP.warna_cetak, DP.sm, DP.dll,
                 DP.tgl_kirim_gudang, DP.sts_pesanan
          FROM pesanan_detail DP
          LEFT JOIN gudang_hasil GH ON DP.kd_gd_hasil = GH.kd_gd_hasil
          LEFT JOIN gudang_bahan GB ON DP.kd_gd_bahan = GB.kd_gd_bahan
          WHERE (DP.kd_gd_hasil = GH.kd_gd_hasil OR
                 DP.kd_gd_bahan = DP.kd_gd_bahan) AND
                 DP.no_order = '$param' AND
                 DP.deleted = 'FALSE'
                 ORDER BY DP.id_dp ASC";
    $arrPesananDetails = $this->db->query($Q);
    return $arrPesananDetails->result_array();
  }

  public function selectPesananDetailsTempId($param){
    $arrPesananDetailsTempId = $this->db->get_where("pesanan_detail_temp",array("id_dp"=>$param));
    return $arrPesananDetailsTempId->result_array();
  }

  public function selectPesananDetailsId($param){
    $arrPesananDetailsTempId = $this->db->get_where("pesanan_detail",array("id_dp"=>$param,"deleted"=>"FALSE"));
    return $arrPesananDetailsTempId->result_array();
  }

  public function selectGudangHasilLike($param){
    $param2 = explode('|',trim($param));

    if(strtolower($param2[0])=="cat" || strtolower($param2[0])=="minyak"){
      if(strtolower($param2[0])=="cat"){
        $jenis = "CAT MURNI";
      }else{
        $jenis = "MINYAK";
      }
      if(!empty($param2[1])){
        $clause = "AND
        (kd_gd_bahan LIKE '%$param2[1]%' OR
        nm_barang LIKE '%$param2[1]%' OR
        warna LIKE '%$param2[1]%') AND
        deleted='FALSE'";
      }else{
        $clause = "AND deleted ='FALSE'";
      }
      $arrGudangHasilLike = $this->db->query("SELECT kd_gd_bahan, nm_barang, warna, `status`, jenis
                                              FROM gudang_bahan
                                              WHERE `status`='LOKAL' AND jenis='$jenis' $clause");
      $result = $arrGudangHasilLike->result_array();
      return $result;
    }else{
      if(strpos($param,"|") !== FALSE){
        $param3 = explode("|",$param);
        $arrGudangHasilLike = $this->db->query("SELECT kd_gd_hasil,ukuran,warna_plastik,tebal,merek,jns_permintaan,jns_brg
                                                FROM gudang_hasil
                                                WHERE (merek LIKE '%$param3[0]%'
                                                AND ukuran LIKE '%$param3[1]%'
                                                AND warna_plastik LIKE '%$param3[2]%'
                                                AND deleted='FALSE')
                                                AND CONCAT(jns_permintaan,' ',jns_brg) != 'POLOS SABLON'");
      }else{
        $arrGudangHasilLike = $this->db->query("SELECT kd_gd_hasil,ukuran,warna_plastik,tebal,merek,jns_permintaan,jns_brg
                                                FROM gudang_hasil
                                                WHERE ((kd_gd_hasil LIKE '%$param%' OR
                                                ukuran LIKE '%$param%' OR
                                                merek LIKE '%$param%')
                                                AND deleted='FALSE')
                                                AND CONCAT(jns_permintaan,' ',jns_brg) != 'POLOS SABLON'");
      }
      $result = $arrGudangHasilLike->result_array();
      return $result;
    }


  }

  public function selectGudangHasilLimit20(){
    $this->db->select("kd_gd_hasil,warna_plastik,tebal,merek,jns_permintaan,jns_brg,ukuran");
    $this->db->where("deleted='FALSE'");
    $this->db->where("CONCAT(jns_permintaan,' ',jns_brg) != 'POLOS SABLON'");
    $arrGudangHasilLimit20 = $this->db->get("gudang_hasil");
    return $arrGudangHasilLimit20->result_array();
  }

  public function selectFakturPesanan($param){
    $arrFakturPesanan = $this->db->query("SELECT P.no_order,P.proof,DATE_FORMAT(P.tgl_pesan,'%d-%M-%Y') AS tgl_pesan,
                                                 DATE_FORMAT(P.tgl_estimasi,'%d-%M-%Y') AS tgl_estimasi, P.nm_pemesan,
                                                 P.no_po,P.note,P.foto_1,P.foto_2,P.expedisi,P.payment_method,P.expedisi,
                                                 IF(P.pajak='TRUE','P','N') pajak,P.jns_order,P.ket_proof, P.mata_uang, P.sales,
                                                 P.dp,C.alamat,C.tlp_kantor,IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan,
                                                 U.username,U.ttd
                                          FROM pesanan P
                                          INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                          INNER JOIN users U ON P.id_user = U.id_user
                                          WHERE P.no_order = '$param' AND P.deleted='FALSE'");
    return $arrFakturPesanan->result_array();
  }

  public function selectFakturPesananDetail($param){
    $arrFakturPesananDetail = $this->db->query("SELECT FORMAT(PD.jumlah,1) AS jumlah,PD.satuan,
                                                       GH.ukuran,PD.merek,PD.harga,GH.merek AS merekProduk,
                                                       GH.warna_plastik,PD.warna_cetak,PD.sm,PD.dll,PD.cn,GH.jns_brg,
                                                       PD.potongan, PD.diskon,
                                                       CONCAT(CONVERT(FORMAT(PD.omset_kg,2) USING utf8),'=',CONVERT(FORMAT(PD.omset_lembar,2) USING utf8)) AS omset
                                                FROM pesanan_detail PD
                                                LEFT JOIN gudang_hasil GH ON PD.kd_gd_hasil = GH.kd_gd_hasil
                                                LEFT JOIN gudang_bahan GB ON PD.kd_gd_bahan = GB.kd_gd_bahan
                                                WHERE PD.no_order = '$param' AND PD.deleted='FALSE'");
    return $arrFakturPesananDetail->result_array();
  }

  public function selectFakturPesananDetailProduksi($param){
    $arrFakturPesananDetail = $this->db->query("SELECT FORMAT(PD.jumlah,1) AS jumlah,PD.satuan,
                                                       GH.ukuran,PD.merek,GH.merek AS nm_brg,GH.jns_brg,
                                                       GH.warna_plastik,PD.warna_cetak,PD.sm,PD.dll
                                                FROM pesanan_detail PD
                                                LEFT JOIN gudang_hasil GH ON PD.kd_gd_hasil = GH.kd_gd_hasil
                                                LEFT JOIN gudang_bahan GB ON PD.kd_gd_bahan = GB.kd_gd_bahan
                                                WHERE PD.no_order = '$param' AND PD.deleted='FALSE'");
    return $arrFakturPesananDetail->result_array();
  }

  public function selectApproveUserNoOrder($param){
    $this->db->select("kd_cust,approve_1,approve_2,approve_3,approve_4,approve_5");
    $arrApproveUserNoOrder = $this->db->get_where("pesanan",array("no_order"=>$param));
    return $arrApproveUserNoOrder->result_array();
  }

  public function selectPesananEdit($param){
    $arrPesananEdit = $this->db->query("SELECT P.no_order,P.kd_order,P.kd_cust,P.no_po,
                                               P.nm_pemesan,P.tgl_pesan,P.tgl_estimasi,P.payment_method,
                                               P.expedisi,P.pajak,P.jns_order,P.dp,P.mata_uang,P.note,
                                               P.foto_1,P.foto_2,P.proof,P.ket_proof,P.sts_pesanan,
                                               C.nm_perusahaan
                                        FROM pesanan P
                                        INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                        WHERE P.no_order = '$param' AND P.deleted='FALSE'");
    return $arrPesananEdit->result_array();
  }

  public function selectLihatPesanan($param){
    $arrPesananEdit = $this->db->query("SELECT P.no_order,P.kd_order,P.kd_cust,P.no_po,
                                               P.nm_pemesan,DATE_FORMAT(P.tgl_pesan,'%d-%M-%Y') AS tgl_pesan,
                                               DATE_FORMAT(P.tgl_estimasi,'%d-%M-%Y') AS tgl_estimasi,P.payment_method,
                                               P.expedisi,P.pajak,P.jns_order,P.dp,P.mata_uang,P.note,DATE_FORMAT(P.diperbarui,'%d-%M-%Y %H:%i:%s') AS diperbarui,
                                               P.foto_1,P.foto_2,P.proof,P.ket_proof,
                                               IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan,
                                               IF(C.nm_owner_update IS NULL, C.nm_owner, C.nm_owner_update) AS nm_owner,
                                               IF(C.nm_purchasing_update IS NULL, C.nm_purchasing, C.nm_purchasing_update) AS nm_purchasing,
                                               U.username
                                        FROM pesanan P
                                        INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                        INNER JOIN users U ON P.id_user = U.id_user
                                        WHERE P.no_order = '$param' AND P.deleted='FALSE'");
    return $arrPesananEdit->result_array();
  }

  public function selectStatistikCustomerGlobalJson(){
    $this->datatables->select("C.kd_cust,IF(C.nm_perusahaan_update IS NULL,C.nm_perusahaan,C.nm_perusahaan_update) AS nm_perusahaan,
                               SUM((IF(PD.satuan = 'KG',PD.jumlah,0))) AS KG,
                               SUM((IF(PD.satuan = 'LEMBAR',ROUND(PD.jumlah),0))) AS LEMBAR,
                               SUM((IF(PD.satuan = 'BAL', ROUND(PD.jumlah),0))) AS BAL");
    $this->datatables->from("customer C");
    $this->datatables->where("P.deleted = 'FALSE' AND
                              PD.deleted = 'FALSE'");
    $this->datatables->join("pesanan P","P.kd_cust = C.kd_cust","INNER");
    $this->datatables->join("pesanan_detail PD","PD.no_order = P.no_order","INNER");
    $this->datatables->group_by("C.kd_cust");
    return $this->datatables->generate();
  }

  public function selectHistoryOrderJson($param){
    $this->datatables->select('DATE_FORMAT(P.tgl_pesan,"%d %M %Y") AS tgl_pesan,DATE_FORMAT(P.tgl_estimasi,"%d %M %Y") AS tgl_estimasi,
                               P.kd_cust,
                               IF(C.nm_owner_update IS NULL, C.nm_owner, C.nm_owner_update) AS nm_owner,
                               IF(C.nm_purchasing_update IS NULL, C.nm_purchasing, C.nm_purchasing_update) AS nm_purchasing,
                               PD.jumlah,GH.ukuran,
                               P.payment_method,PD.harga,PD.merek,GH.warna_plastik,PD.warna_cetak, PD.sm,PD.satuan,
                               PD.dll, PD.kd_hrg, P.no_order');
    // $this->datatables->add_column("action","<a href='#' class='btn btn-xs btn-info print-out' title='Print Out' data-toggle='modal' data-target='#print-out'><i class='fa fa-print'></i></a>","C.nm_perusahaan");
    $this->datatables->from('pesanan_detail PD')->where("P.deleted='FALSE' AND PD.deleted='FALSE' AND P.kd_cust = ",$param);
    $this->datatables->join('pesanan P','PD.no_order = P.no_order','LEFT');
    $this->datatables->join('customer C','P.kd_cust = C.kd_cust','LEFT');
    $this->datatables->join('gudang_hasil GH','PD.kd_gd_hasil = GH.kd_gd_hasil','LEFT');
    $this->datatables->join('gudang_bahan GB','PD.kd_gd_bahan = GB.kd_gd_bahan','LEFT');
    $this->db->order_by("P.tgl_pesan","DESC");
    return $this->datatables->generate();
  }

  public function selectHistoryOrderJsonLama($param){
    $Q = "SELECT no_cust, nm_perusahaan, nm_purchasing, nm_owner FROM customer WHERE kd_cust='$param[kdCust]'";
    $arrCustomer = $this->db->query($Q)->result_array();
    $noCust = $arrCustomer[0]["no_cust"];
    $nmPerusahaan = $arrCustomer[0]["nm_perusahaan"];
    $nmPurchasing = $arrCustomer[0]["nm_purchasing"];
    $nmOwner = $arrCustomer[0]["nm_owner"];
    $flags = "";
    $clause = "";
    for ($i=0; $i < count($arrCustomer); $i++) {
      if(!empty($arrCustomer[$i]["no_cust"])){
        $flags .= "1";
      }
      if(!empty($arrCustomer[$i]["nm_perusahaan"])){
        $flags .= "2";
      }
      if(!empty($arrCustomer[$i]["nm_purchasing"])){
        $flags .= "3";
      }
      if(!empty($arrCustomer[$i]["nm_owner"])){
        $flags .= "4";
      }
    }
    $arrPrefix = str_split($flags);
    if(count($arrPrefix) > 1){
      $j = count($arrPrefix)-1;
      for ($i=0; $i < count($arrPrefix); $i++) {
        switch ($arrPrefix[$i]) {
          case '1':$clause .= " no_customer='$noCust'"; break;
          case '2':$clause .= " nm_perusahaan='$nmPerusahaan'"; break;
          case '3':$clause .= " nm_purchasing='$nmPurchasing'"; break;
          case '4':$clause .= " nm_owner='$nmOwner'"; break;

          default:$clause = " -1"; break;
        }
        if($j > 0){
          $clause .= " AND";
        }
        $j--;
      }
    }else{
      switch ($arrPrefix[0]) {
        case '1':$clause = " no_customer='$noCust'"; break;
        case '2':$clause = " nm_perusahaan='$nmPerusahaan'"; break;
        case '3':$clause = " nm_purchasing='$nmPurchasing'"; break;
        case '4':$clause = " nm_owner='$nmOwner'"; break;

        default:$clause = " -1"; break;
      }
    }
    $Q2 = "SELECT kd_customer FROM customer_lama WHERE".$clause;
    $arrKodeCustomer = $this->db->query($Q2)->result_array();
    $this->datatables->select('DATE_FORMAT(P.tgl_pesan,"%d %M %Y") AS tgl_pesan,DATE_FORMAT(P.tgl_estimasi,"%d %M %Y") AS tgl_estimasi,
                               P.kd_customer,C.nm_owner,C.nm_purchasing,PD.jumlah,GH.ukuran,
                               P.term_payment,PD.harga,PD.merek,GH.warna_plastik,PD.cetak, PD.sm,PD.satuan,
                               PD.dll, PD.kd_harga, P.no_order');
    // $this->datatables->add_column("action","<a href='#' class='btn btn-xs btn-info print-out' title='Print Out' data-toggle='modal' data-target='#print-out'><i class='fa fa-print'></i></a>","C.nm_perusahaan");
    $this->datatables->from('pesanan_details_lama PD')->where("P.kd_customer = ",$arrKodeCustomer[0]['kd_customer']);
    $this->datatables->join('pesanan_lama P','PD.no_order = P.no_order','INNER');
    $this->datatables->join('customer_lama C','P.kd_customer = C.kd_customer','INNER');
    $this->datatables->join('gudang_hasil_lama GH','PD.kd_hasil = GH.kd_hasil','LEFT');
    $this->datatables->join('gudang_bahan_lama GB','PD.kd_hasil = GB.kd_bahan','LEFT');
    $this->db->order_by("P.tgl_pesan","DESC");
    return $this->datatables->generate();
  }

  public function selectProductServiceJson($param){
    $this->datatables->select("PS.id_sp,PS.servis_produk,PS.term_payment,PS.ukuran,PS.harga,PS.merek,PS.foto");
    $this->datatables->from("servis_produk PS")->where("PS.kd_cust=",$param);
    $this->datatables->join("customer C","PS.kd_cust = C.kd_cust","INNER");
    return $this->datatables->generate();
  }

  public function selectProdukServisNoteJson($param){
    $data = $this->db->query("SELECT note FROM servis_produk WHERE id_sp='$param'");
    return json_encode($data->result_array());
  }

  public function selectCustomerListJson(){
    $this->datatables->select('C.kd_cust,
                               IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan,
                               IF(C.nm_owner_update IS NULL, C.nm_owner, C.nm_owner_update) AS nm_owner,
                               IF(C.nm_purchasing_update IS NULL, C.nm_purchasing, C.nm_purchasing_update) AS nm_purchasing,
                               IF(C.no_cust_update IS NULL, C.no_cust, C.no_cust_update) AS no_cust,
                               CONCAT(C.tlp_kantor," / ",C.tlp_lainnya) AS tlp_kantor,
                               CONCAT(C.alamat," / ",C.alamat_lainnya) AS alamat,C.kota,C.kode_pos,
                               IF(YEAR(NOW())-YEAR(MAX(P.tgl_pesan))>=1,"TIDAK_AKTIF","AKTIF") AS status_customer');
    $this->datatables->add_column("action","<a href='edit_customer/$1' class='btn btn-xs btn-warning'><i class='fa fa-edit'></i> Ubah</a>",
       "kd_cust");
    $this->datatables->from('customer C')->where("C.deleted=",'FALSE');
    $this->datatables->join("pesanan P","P.kd_cust = C.kd_cust","LEFT");
    $this->datatables->group_by("C.kd_cust");
    $this->db->having("C.kd_cust>''");
    return $this->datatables->generate();
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

  public function selectDetailStatistikCustomerJson($param){
    $this->datatables->select("PD.no_order,PD.kd_gd_hasil,PD.kd_gd_bahan,PD.omset_kg,FORMAT(ROUND(PD.omset_lembar),0,0) AS omset_lembar,P.tgl_pesan,
                               GH.merek,GH.ukuran,GH.warna_plastik,GB.nm_barang");
    $this->datatables->from("pesanan_detail PD")->where("PD.deleted='FALSE' AND P.deleted='FALSE' AND (PD.kd_gd_hasil !='NULL' OR PD.kd_gd_bahan != 'NULL') AND P.kd_cust=",$param);
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    return $this->datatables->generate();
  }

  public function selectDetailStatistikCustomerTanggalJson($param){
    $this->datatables->select("PD.no_order,PD.kd_gd_hasil,PD.kd_gd_bahan,PD.omset_kg,FORMAT(ROUND(PD.omset_lembar),0,0) AS omset_lembar,P.tgl_pesan,
                               GH.merek,GH.ukuran,GH.warna_plastik,GB.nm_barang");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->where("PD.deleted='FALSE' AND P.deleted='FALSE' AND
                              (PD.kd_gd_hasil !='NULL' OR PD.kd_gd_bahan != 'NULL') AND
                              P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                              P.kd_cust=",$param['kd_cust']);
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    return $this->datatables->generate();
  }

  public function selectChartDataOrderKg($param){
    $arrDataOrderKg = $this->db->query("SELECT SUM(IF(PD.satuan='KG',PD.jumlah,0)) AS jumlah_kg,
                                               DATE_FORMAT(P.tgl_pesan,'%M') AS bulan
                                        FROM pesanan_detail PD
                                        INNER JOIN pesanan P ON PD.no_order = P.no_order
                                        INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                        WHERE P.kd_cust='$param[kd_cust]' AND
                                              P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                              P.deleted = 'FALSE' AND
                                              PD.deleted = 'FALSE' AND
                                              C.deleted = 'FALSE'
                                        GROUP BY YEAR(P.tgl_pesan),MONTH(P.tgl_pesan)");
    return $arrDataOrderKg->result_array();
  }

  public function selectChartDataOrderLembar($param){
    $arrDataOrderLembar = $this->db->query("SELECT SUM(IF(PD.satuan='LEMBAR',PD.jumlah,0)) AS jumlah_lembar,
                                               DATE_FORMAT(P.tgl_pesan,'%M') AS bulan
                                        FROM pesanan_detail PD
                                        INNER JOIN pesanan P ON PD.no_order = P.no_order
                                        INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                        WHERE P.kd_cust='$param[kd_cust]' AND
                                              P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                              P.deleted = 'FALSE' AND
                                              PD.deleted = 'FALSE' AND
                                              C.deleted = 'FALSE'
                                        GROUP BY YEAR(P.tgl_pesan),MONTH(P.tgl_pesan)");
    return $arrDataOrderLembar->result_array();
  }

  public function selectChartDataOrderBal($param){
    $arrDataOrderBal = $this->db->query("SELECT SUM(IF(PD.satuan='BAL',PD.jumlah,0)) AS jumlah_bal,
                                               DATE_FORMAT(P.tgl_pesan,'%M') AS bulan
                                        FROM pesanan_detail PD
                                        INNER JOIN pesanan P ON PD.no_order = P.no_order
                                        INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                        WHERE P.kd_cust='$param[kd_cust]' AND
                                              P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                              P.deleted = 'FALSE' AND
                                              PD.deleted = 'FALSE' AND
                                              C.deleted = 'FALSE'
                                        GROUP BY YEAR(P.tgl_pesan),MONTH(P.tgl_pesan)");
    return $arrDataOrderBal->result_array();
  }

  public function selectChartDataOrderKaleng($param){
    $arrDataOrderKaleng = $this->db->query("SELECT SUM(IF(PD.satuan='KALENG',PD.jumlah,0)) AS jumlah_kaleng,
                                                   DATE_FORMAT(P.tgl_pesan,'%M') AS bulan
                                            FROM pesanan_detail PD
                                            INNER JOIN pesanan P ON PD.no_order = P.no_order
                                            INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                            WHERE P.kd_cust='$param[kd_cust]' AND
                                                  P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                                  P.deleted = 'FALSE' AND
                                                  PD.deleted = 'FALSE' AND
                                                  C.deleted = 'FALSE'
                                            GROUP BY YEAR(P.tgl_pesan),MONTH(P.tgl_pesan)");
    return $arrDataOrderKaleng->result_array();
  }

  public function selectChartDataOmsetOrderKg($param){
    $arrDataOmsetOrderKg = $this->db->query("SELECT SUM(PD.omset_kg) AS omset_kg,
                                                   DATE_FORMAT(P.tgl_pesan,'%M') AS bulan
                                            FROM pesanan_detail PD
                                            INNER JOIN pesanan P ON PD.no_order = P.no_order
                                            INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                            WHERE P.kd_cust='$param[kd_cust]' AND
                                                  P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                                  P.deleted = 'FALSE' AND
                                                  PD.deleted = 'FALSE' AND
                                                  C.deleted = 'FALSE'
                                            GROUP BY YEAR(P.tgl_pesan),MONTH(P.tgl_pesan)");
    return $arrDataOmsetOrderKg->result_array();
  }

  public function selectChartDataOmsetOrderLembar($param){
    $arrDataOmsetOrderLembar = $this->db->query("SELECT SUM(PD.omset_lembar) AS omset_lembar,
                                                   DATE_FORMAT(P.tgl_pesan,'%M') AS bulan
                                            FROM pesanan_detail PD
                                            INNER JOIN pesanan P ON PD.no_order = P.no_order
                                            INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                            WHERE P.kd_cust='$param[kd_cust]' AND
                                                  P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                                  P.deleted = 'FALSE' AND
                                                  PD.deleted = 'FALSE' AND
                                                  C.deleted = 'FALSE'
                                            GROUP BY YEAR(P.tgl_pesan),MONTH(P.tgl_pesan)");
    return $arrDataOmsetOrderLembar->result_array();
  }

  public function selectChartDataOrderKgPerTanggal($param){
    $arrDataOrderKgPerTanggal = $this->db->query("SELECT SUM(IF(PD.satuan='KG',PD.jumlah,0)) AS jumlah_kg,
                                                         DATE_FORMAT(P.tgl_pesan,'%d-%m-%Y') AS tanggal
                                                  FROM pesanan_detail PD
                                                  INNER JOIN pesanan P ON PD.no_order = P.no_order
                                                  INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                                  WHERE P.kd_cust='$param[kd_cust]' AND
                                                        P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                                        P.deleted = 'FALSE' AND
                                                        PD.deleted = 'FALSE' AND
                                                        C.deleted = 'FALSE'
                                                  GROUP BY P.tgl_pesan");
    return $arrDataOrderKgPerTanggal->result_array();
  }

  public function selectChartDataOrderLembarPerTanggal($param){
    $arrDataOrderLembarPerTanggal = $this->db->query("SELECT SUM(IF(PD.satuan='LEMBAR',PD.jumlah,0)) AS jumlah_lembar,
                                                             DATE_FORMAT(P.tgl_pesan,'%d-%m-%Y') AS tanggal
                                                      FROM pesanan_detail PD
                                                      INNER JOIN pesanan P ON PD.no_order = P.no_order
                                                      INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                                      WHERE P.kd_cust='$param[kd_cust]' AND
                                                            P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                                            P.deleted = 'FALSE' AND
                                                            PD.deleted = 'FALSE' AND
                                                            C.deleted = 'FALSE'
                                                      GROUP BY P.tgl_pesan");
    return $arrDataOrderLembarPerTanggal->result_array();
  }

  public function selectChartDataOrderBalPerTanggal($param){
    $arrDataOrderBalPerTanggal = $this->db->query("SELECT SUM(IF(PD.satuan='BAL',PD.jumlah,0)) AS jumlah_bal,
                                                          DATE_FORMAT(P.tgl_pesan,'%d-%m-%Y') AS tanggal
                                                   FROM pesanan_detail PD
                                                   INNER JOIN pesanan P ON PD.no_order = P.no_order
                                                   INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                                   WHERE P.kd_cust='$param[kd_cust]' AND
                                                         P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                                         P.deleted = 'FALSE' AND
                                                         PD.deleted = 'FALSE' AND
                                                         C.deleted = 'FALSE'
                                                   GROUP BY P.tgl_pesan");
    return $arrDataOrderBalPerTanggal->result_array();
  }

  public function selectChartDataOrderKalengPerTanggal($param){
    $arrDataOrderKalengPerTanggal = $this->db->query("SELECT SUM(IF(PD.satuan='KALENG',PD.jumlah,0)) AS jumlah_kaleng,
                                                             DATE_FORMAT(P.tgl_pesan,'%d-%m-%Y') AS tanggal
                                                      FROM pesanan_detail PD
                                                      INNER JOIN pesanan P ON PD.no_order = P.no_order
                                                      INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                                      WHERE P.kd_cust='$param[kd_cust]' AND
                                                            P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                                            P.deleted = 'FALSE' AND
                                                            PD.deleted = 'FALSE' AND
                                                            C.deleted = 'FALSE'
                                                      GROUP BY P.tgl_pesan");
    return $arrDataOrderKalengPerTanggal->result_array();
  }

  public function selectChartDataOmsetOrderKgPerTanggal($param){
    $arrDataOmsetOrderKgPerTanggal = $this->db->query("SELECT SUM(PD.omset_kg) AS omset_kg,
                                                              DATE_FORMAT(P.tgl_pesan,'%d-%m-%Y') AS tanggal
                                                       FROM pesanan_detail PD
                                                       INNER JOIN pesanan P ON PD.no_order = P.no_order
                                                       INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                                       WHERE P.kd_cust='$param[kd_cust]' AND
                                                             P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                                             P.deleted = 'FALSE' AND
                                                             PD.deleted = 'FALSE' AND
                                                             C.deleted = 'FALSE'
                                                       GROUP BY P.tgl_pesan");
    return $arrDataOmsetOrderKgPerTanggal->result_array();
  }

  public function selectChartDataOmsetOrderLembarPerTanggal($param){
    $arrDataOmsetOrderLembar = $this->db->query("SELECT SUM(PD.omset_lembar) AS omset_lembar,
                                                   DATE_FORMAT(P.tgl_pesan,'%d-%m-%Y') AS tanggal
                                            FROM pesanan_detail PD
                                            INNER JOIN pesanan P ON PD.no_order = P.no_order
                                            INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                            WHERE P.kd_cust='$param[kd_cust]' AND
                                                  P.tgl_pesan BETWEEN '$param[tgl_awal]' AND '$param[tgl_akhir]' AND
                                                  P.deleted = 'FALSE' AND
                                                  PD.deleted = 'FALSE' AND
                                                  C.deleted = 'FALSE'
                                            GROUP BY P.tgl_pesan");
    return $arrDataOmsetOrderLembar->result_array();
  }

  public function selectCountTrash(){
    $arrCountTrash = $this->db->query("SELECT COUNT(no_order) AS jumlah_terhapus FROM pesanan WHERE deleted='TRUE'");
    return $arrCountTrash->result_array();
  }

  public function selectPesananTrash(){
    $this->datatables->select("no_order,nm_pemesan,diperbarui");
    $this->datatables->from("pesanan")->where("deleted=","TRUE");
    return $this->datatables->generate();
  }

  public function selectPencarian(){
    $this->datatables->select('PD.no_order,C.kd_cust,GH.kd_gd_hasil,C.nm_perusahaan,
                               GH.ukuran,PD.merek,GH.merek AS nm_brg,
                               CONCAT(PD.mata_uang," ",CONVERT(FORMAT(PD.harga,0) USING utf8)) AS harga,
                               CONCAT(PD.jumlah," ",PD.satuan) AS jumlah_pesanan,
                               PD.kd_hrg,PD.warna_cetak,GH.warna_plastik,
                               P.tgl_pesan,P.sts_pesanan, PD.deleted');
    //$this->datatables->add_column("action","<a href='#' class='btn btn-xs btn-info print-out' title='Print Out' data-toggle='modal' data-target='#print-out'><i class='fa fa-print'></i></a>","C.nm_perusahaan");
    $this->datatables->from('pesanan_detail PD');
    $this->datatables->join('pesanan P','PD.no_order = P.no_order','INNER');
    $this->datatables->join('customer C','P.kd_cust = C.kd_cust','INNER');
    $this->datatables->join('gudang_hasil GH','PD.kd_gd_hasil = GH.kd_gd_hasil','LEFT');
    return $this->datatables->generate();
  }

  public function selectNotePesanan($param){
    $result = $this->db->query("SELECT note FROM pesanan WHERE no_order='$param'")->result_array();
    return json_encode($result);
  }

  public function selectNotePesananLama($param){
    $result = $this->db->query("SELECT note FROM pesanan_lama WHERE no_order='$param'")->result_array();
    return json_encode($result);
  }

  public function selectOrderListJson(){
    $this->datatables->select("P.no_order, P.kd_order, P.nm_pemesan, DATE_FORMAT(P.tgl_pesan,'%d-%m-%Y') AS tgl_pesan,
                               DATE_FORMAT(P.tgl_estimasi,'%d-%m-%Y') AS tgl_estimasi,
                               P.sts_pesanan, IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan,
                               IF(C.nm_purchasing_update IS NULL, C.nm_purchasing, C.nm_purchasing_update) AS nm_purchasing,
                               P.approve_1, P.approve_2, P.approve_3, P.approve_4, P.approve_5, P.approve_6");
    if($this->session->userdata("fabricationStatus") == 1){
      $this->datatables->add_column("action","<a href='#' style='float:left;'  class='btn btn-xs btn-info print-out' title='Print Out' data-toggle='modal' data-target='#print-out'><i class='fa fa-print'></i></a>
                                              <a style='float:left;' class='btn btn-xs btn-warning edit-pesanan'><i class='fa fa-pencil-square-o' title='Edit Pesanan'></i></a>
                                              <a href='#' style='float:left;'  class='btn btn-xs btn-info print-out-produksi' title='Print Out Produksi' data-toggle='modal' data-target='#print-out'><i class='fa fa-print'></i></a>
                                              <a href='#' style='float:left;'  class='btn btn-xs btn-danger trash-pesanan' title='Hapus Pesanan'><i class='fa fa-trash'></i></a>",
                                    "P.kd_cust");
    }else{
      $this->datatables->add_column("action","<a href='#' style='float:left;' class='btn btn-xs btn-info print-out' title='Print Out' data-toggle='modal' data-target='#print-out'><i class='fa fa-print'></i></a>
                                              <a style='float:left;' class='btn btn-xs btn-warning edit-pesanan'><i class='fa fa-pencil-square-o' title='Edit Pesanan'></i></a>
                                              <a href='#' style='float:left;' class='btn btn-xs btn-info print-out-produksi' title='Print Out Produksi' data-toggle='modal' data-target='#print-out'><i class='fa fa-print'></i></a>",
                                    "P.kd_cust");
    }
    $this->datatables->from('pesanan P')->where("P.sts_pesanan != 'FINISH' AND P.sts_pesanan != 'WAITING' AND P.approve_cabang = 'FALSE' AND P.deleted=","FALSE");
    $this->datatables->join('customer C','P.kd_cust = C.kd_cust','INNER');
    return $this->datatables->generate();
  }

  public function selectClosedOrderListJson(){
    $this->datatables->select('P.no_order, P.kd_order, P.nm_pemesan, P.tgl_pesan,
                               P.tgl_estimasi, P.sts_pesanan,
                               IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan,
                               IF(C.nm_purchasing_update IS NULL, C.nm_purchasing, C.nm_purchasing_update) AS nm_purchasing,
                               P.approve_1, P.approve_2, P.approve_3, P.approve_4,
                               P.approve_5, P.approve_6,P.tgl_kirim');
    $this->datatables->add_column("action","<a href='#' class='btn btn-xs btn-info print-out' title='Print Out' data-toggle='modal' data-target='#print-out'><i class='fa fa-print'></i></a>
       <a href='#' class='btn btn-xs btn-info' title='Print Out Produksi'><i class='fa fa-print'></i></a>",
       "kd_cust");
    $this->datatables->from('pesanan P')->where("P.sts_pesanan='FINISH' AND (P.tgl_kirim !='NULL' OR P.tgl_kirim != '') AND P.approve_cabang = 'FALSE' AND P.deleted=","FALSE");
    $this->datatables->join('customer C','P.kd_cust = C.kd_cust','INNER');
    return $this->datatables->generate();
  }

  public function selectOrderDeadline(){
    $this->datatables->select("no_order, kd_order, nm_pemesan,
                               DATE_FORMAT(tgl_pesan,'%d-%m-%Y') AS tgl_pesan,
                               DATE_FORMAT(tgl_estimasi,'%d-%m-%Y') AS tgl_estimasi,
                               sts_pesanan,
                               IF(nm_perusahaan_update IS NULL, nm_perusahaan, nm_perusahaan_update) AS nm_perusahaan,
                               IF(nm_purchasing_update IS NULL, nm_purchasing, nm_purchasing_update) AS nm_purchasing,
                               approve_1, approve_2, approve_3, approve_4, approve_5, approve_6");
    $this->datatables->from('pesanan');
    $this->datatables->where("pesanan.sts_pesanan != 'FINISH'
                              AND pesanan.sts_pesanan != 'WAITING'
                              AND pesanan.approve_cabang = 'FALSE'
                              AND pesanan.tgl_estimasi < NOW()
                              AND pesanan.deleted=","FALSE");
    $this->datatables->join('customer','pesanan.kd_cust = customer.kd_cust','INNER');
    return $this->datatables->generate();
  }

  public function selectTglEstimasi($param){
    $Q = "SELECT tgl_estimasi FROM pesanan WHERE no_order='$param' AND deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    return json_encode($result);
  }

  public function selectCountOrderDeadline(){
    $Q = "SELECT COUNT(P.no_order) AS counter FROM pesanan P
          INNER JOIN customer C ON P.kd_cust = C.kd_cust
          WHERE P.tgl_estimasi < NOW()
          AND P.tgl_estimasi IS NOT NULL
          AND P.deleted='FALSE'
          AND P.sts_pesanan NOT IN ('FINISH','WAITING')
          AND P.approve_cabang = 'FALSE'
          AND P.deleted='FALSE'";
    $result = $this->db->query($Q)->result_array();
    $dataForReturned = array("Counter" => $result[0]["counter"]);
    return json_encode($dataForReturned);
  }

  public function getDataOrderPerHari($jenis,$tgl)
  {
    if(empty($tgl)){
      $this->datatables->select("P.no_order, P.kd_order, P.nm_pemesan,
                                 DATE_FORMAT(P.tgl_pesan,'%d-%m-%Y') AS tgl_pesan,
                                 DATE_FORMAT(P.tgl_estimasi,'%d-%m-%Y') AS tgl_estimasi,
                                 P.sts_pesanan,
                                 IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan,
                                 IF(C.nm_purchasing_update IS NULL, C.nm_purchasing, C.nm_purchasing_update) AS nm_purchasing");
      $this->datatables->from("pesanan P");
      $this->datatables->join("customer C","P.kd_cust = C.kd_cust","INNER");
      // $this->datatables->join("pesanan_detail PD","P.no_order = PD.no_order","INNER");
      if ($jenis=="LK") {
        $this->datatables->where("P.jns_order ='LK' and P.deleted='FALSE' and DATE(P.tgl_pesan)=CURDATE() and P.approve_cabang = 'FALSE'");
      }else if ($jenis=="DK"){
        $this->datatables->where("P.jns_order ='DK' and P.deleted='FALSE' and DATE(P.tgl_pesan)=CURDATE() and P.approve_cabang = 'FALSE'");
      }else if ($jenis=="CBG"){
        $this->datatables->where("P.deleted='FALSE' and DATE(P.tgl_pesan)=CURDATE() and P.approve_cabang = 'TRUE'");
      }
      return $this->datatables->generate();
    }else{
      $this->datatables->select("P.no_order, P.kd_order, P.nm_pemesan,
                                 DATE_FORMAT(P.tgl_pesan,'%d-%m-%Y') AS tgl_pesan,
                                 DATE_FORMAT(P.tgl_estimasi,'%d-%m-%Y') AS tgl_estimasi,
                                 P.sts_pesanan,
                                 IF(C.nm_perusahaan_update IS NULL, C.nm_perusahaan, C.nm_perusahaan_update) AS nm_perusahaan,
                                 IF(C.nm_purchasing_update IS NULL, C.nm_purchasing, C.nm_purchasing_update) AS nm_purchasing");
      $this->datatables->from("pesanan P");
      $this->datatables->join("customer C","P.kd_cust = C.kd_cust","INNER");
      // $this->datatables->join("pesanan_detail PD","P.no_order = PD.no_order","INNER");
      if ($jenis=="LK") {
        $this->datatables->where("P.jns_order ='LK' and P.deleted='FALSE' and P.tgl_pesan='$tgl' and P.approve_cabang = 'FALSE'");
      }else if ($jenis=="DK"){
        $this->datatables->where("P.jns_order ='DK' and P.deleted='FALSE' and P.tgl_pesan='$tgl' and P.approve_cabang = 'FALSE'");
      }else if ($jenis=="CBG"){
        $this->datatables->where("P.deleted='FALSE' and P.tgl_pesan='$tgl' and P.approve_cabang = 'TRUE'");
      }
      return $this->datatables->generate();
    }

  }

  public function getTotalOrderPerHari($jenis,$tgl)
  {
    if (empty($tgl)) {
      if ($jenis=="CBG") {
        $data = $this->db->query("SELECT FORMAT(SUM(b.jumlah),2) as jumlah , b.satuan FROM `pesanan` a join pesanan_detail b on a.no_order = b.no_order WHERE  DATE(a.tgl_pesan)=CURDATE() and a.deleted = 'FALSE' and a.approve_cabang = 'TRUE' GROUP by b.satuan")->result_array();
        return json_encode($data);
      }else{
        $data = $this->db->query("SELECT FORMAT(SUM(b.jumlah),2) as jumlah , b.satuan FROM `pesanan` a join pesanan_detail b on a.no_order = b.no_order WHERE  DATE(a.tgl_pesan)=CURDATE() and a.jns_order = '$jenis' and a.deleted = 'FALSE' and a.approve_cabang = 'FALSE' GROUP by b.satuan")->result_array();
        return json_encode($data);
      }
    }else{
      if ($jenis=="CBG") {
        $data = $this->db->query("SELECT FORMAT(SUM(b.jumlah),2) as jumlah , b.satuan FROM `pesanan` a join pesanan_detail b on a.no_order = b.no_order WHERE a.tgl_pesan = '$tgl' and a.deleted = 'FALSE' and a.approve_cabang = 'TRUE' GROUP by b.satuan")->result_array();
        return json_encode($data);
      }else{
       $data = $this->db->query("SELECT FORMAT(SUM(b.jumlah),2) as jumlah , b.satuan FROM `pesanan` a join pesanan_detail b on a.no_order = b.no_order WHERE a.tgl_pesan = '$tgl' and a.jns_order = '$jenis' and a.deleted = 'FALSE' and a.approve_cabang = 'FALSE' GROUP by b.satuan")->result_array();
      }
      return json_encode($data);
    }
  }

  public function getDataChartOrder($tgl_awal,$tgl_akhir,$jenis)
  {
    if ($jenis=="CBG") {
      $data = $this->db->query("SELECT SUM(IF(b.satuan = 'Bal',b.jumlah,0)) AS Bal ,
                                       SUM(IF(b.satuan = 'Kg',b.jumlah,0)) AS Kg ,
                                       SUM(IF(b.satuan = 'Lembar',b.jumlah,0)) AS Lembar ,
                                       b.satuan, a.tgl_pesan
                                FROM `pesanan` a
                                JOIN pesanan_detail b ON a.no_order = b.no_order
                                WHERE a.tgl_pesan
                                BETWEEN '$tgl_awal' AND '$tgl_akhir'
                                AND a.approve_cabang = 'TRUE'
                                AND a.deleted = 'FALSE'
                                GROUP BY a.tgl_pesan")->result_array();
      return json_encode($data);
    }else{
      $data = $this->db->query("SELECT SUM(IF(b.satuan = 'Bal',b.jumlah,0)) AS Bal ,
                                       SUM(IF(b.satuan = 'Kg',b.jumlah,0)) AS Kg ,
                                       SUM(IF(b.satuan = 'Lembar',b.jumlah,0)) AS Lembar ,
                                       b.satuan, a.tgl_pesan
                                FROM `pesanan` a
                                JOIN pesanan_detail b ON a.no_order = b.no_order
                                WHERE a.tgl_pesan
                                BETWEEN '$tgl_awal' AND '$tgl_akhir'
                                AND a.jns_order = '$jenis'
                                AND a.deleted = 'FALSE'
                                AND a.approve_cabang = 'FALSE'
                                GROUP BY a.tgl_pesan")->result_array();
      return json_encode($data);
    }
  }

  public function selectPasswordOri($param){
    $arrData = $this->db->query("SELECT password_ori FROM users WHERE id_user='$param[id_user]'")->result_array();
    if($arrData[0]["password_ori"] == $param["password_lama"]){
      echo "TRUE";
    }else{
      echo "FALSE";
    }
  }

#===========================================SELECT METHOD END===========================================

#===========================================INSERT METHOD START===========================================
  public function insertCustomer($param){
    $this->db->trans_begin();
    $this->db->insert("customer",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertProductServices($param){
    $this->db->trans_begin();
    $this->db->insert("servis_produk",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertPesananDetailTemp($param){
    $this->db->trans_begin();
    $this->db->insert("pesanan_detail_temp",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertPesananDetail($param){
    $this->db->trans_begin();
    $this->db->insert("pesanan_detail",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function insertPesananFinal($param){
    $this->db->trans_begin();
    $this->db->insert("pesanan",$param);
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return "PGM";
    }else{
      $this->db->trans_commit();
      $this->db->trans_begin();
      $pesananDetailTemp = $this->db->select("id_dp,no_order,kd_gd_hasil,kd_gd_bahan,merek,jumlah,satuan,harga,mata_uang,warna_cetak,dll,sm,kd_hrg,omset_lembar,omset_kg,potongan,diskon,cn")
                                    ->get_where("pesanan_detail_temp",array("no_order"=>$param["no_order"]))
                                    ->result_array();
      for ($i=0; $i < count($pesananDetailTemp); $i++) {
        $this->db->insert("pesanan_detail",array_splice($pesananDetailTemp[$i],1,count($pesananDetailTemp[$i])));
        $this->db->where("id_dp",$pesananDetailTemp[$i]["id_dp"])->delete("pesanan_detail_temp");
      }
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "DPGM";
      }else{
        $this->db->trans_commit();
        return "DPM";
      }
    }
  }
#===========================================INSERT METHOD END===========================================

#===========================================UPDATE METHOD START===========================================
  public function updateCustomer($param){
    $this->db->trans_begin();
    $this->db->where("kd_cust",$param["kd_cust"]);
    $this->db->update("customer",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateProductServices($param){
    $this->db->trans_begin();
    // $Q = "SELECT foto FROM servis_produk WHERE id_sp='$param[id_sp]'";
    // $foto = $this->db->query($Q);
    /*foreach ($foto->result_array() as $arrFoto) {
      if ($arrFoto['foto'] != "Tidak Tersedia") {
        $url = FCPATH."assets/images/upload/".$arrFoto['foto'];
        unlink($url);
      }
    }*/
    $this->db->where("id_sp",$param["id_sp"]);
    $this->db->update("servis_produk",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updatePesananDetailTemp($param){
    $this->db->trans_begin();
    $this->db->where("id_dp",$param["id_dp"]);
    $this->db->update("pesanan_detail_temp",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updatePesananDetail($param){
    $this->db->trans_begin();
    $this->db->where("id_dp",$param["id_dp"]);
    $this->db->update("pesanan_detail",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updatePesanan($param){
    $this->db->trans_begin();
    $this->db->where("no_order",$param["no_order"]);
    $this->db->update("pesanan",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updatePesananApprove($param){
    $this->db->trans_begin();
    $this->db->set($param);
    $this->db->set("jumlah_approve","jumlah_approve + 1",FALSE);
    $this->db->where("no_order",$param["no_order"]);
    $this->db->update("pesanan");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updatePulihkanPesananTrash($param){
    $this->db->trans_begin();
    $this->db->where("no_order",$param);
    $this->db->update("pesanan",array("deleted"=>"FALSE","diperbarui"=>date("Y-m-d H:i:s")));
    $this->db->where("no_order",$param);
    $this->db->update("pesanan_detail",array("deleted"=>"FALSE"));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Pesanan Gagal Dipulihkan";
    }else{
      $this->db->trans_commit();
      return "Pesanan Berhasil Dipulihkan";
    }
  }

  public function updatePasswordUser($param){
    $this->db->trans_begin();
    $this->db->where("id_user",$param["id_user"]);
    $this->db->update("users",$param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }
#===========================================UPDATE METHOD END===========================================

#===========================================DELETE METHOD START===========================================
  public function deleteProductServices($param){
    $this->db->trans_begin();
    $this->db->where("id_sp",$param);
    $this->db->delete("servis_produk");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function deletePesananDetailTemp($param){
    $this->db->trans_begin();
    $this->db->where("id_dp",$param);
    $this->db->delete("pesanan_detail_temp");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function deletePesananDetail($param){
    $this->db->trans_begin();
    $this->db->where("id_dp",$param);
    $this->db->update("pesanan_detail",array("deleted"=>"TRUE"));
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function trashPesananFinal($param){
    $this->db->trans_begin();
    $this->db->where("no_order",$param);
    $this->db->update("pesanan",array("deleted"=>"TRUE","diperbarui"=>date("Y-m-d H:i:s")));
    if($this->db->trans_status()===FALSE){
      $this->db->trans_rollback();
      return "Gagal Delete Pesanan";
    }else{
      $this->db->trans_commit();
      $this->db->trans_begin();
      $this->db->where("no_order",$param);
      $this->db->update("pesanan_detail",array("deleted"=>"TRUE"));
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal Delete Item Pesanan";
      }else{
        $this->db->trans_commit();
        return "Delete Berhasil";
      }
    }
  }
#===========================================DELETE METHOD END===========================================
}
?>
