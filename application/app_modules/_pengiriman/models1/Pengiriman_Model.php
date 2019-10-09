<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pengiriman_Model extends CI_Model{
  //============ Generated Code (Start) ============//
  //============ Generated Code (Finish) ============//

  //============ Insert Function (Start) ============//
  //============ Insert Function (Finish) ============//

  //============ Select Function (Start) ============//
  public function selectListDataOrderCabangSiapDikirim(){
    $this->datatables->select("P.tgl_pesan, P.tgl_estimasi, P.nm_pemesan, PD.jumlah, P.no_order,
                               PD.jumlah_kirim, (PD.jumlah - PD.jumlah_kirim) AS sisa,
                               GH.ukuran, GH.warna_plastik, PD.merek, PD.sts_pesanan, PD.id_dp,
                               PD.kd_gd_hasil, PD.kd_gd_bahan, GB.warna, GB.nm_barang");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->where("P.deleted='FALSE' AND
                              PD.deleted='FALSE' AND
                              GH.deleted='FALSE' AND
                              P.approve_cabang='TRUE' AND
                              PD.sts_kirim != 'TERKIRIM' AND
                              P.sts_pesanan IN ('PROGRESS','PACKING')");
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->db->order_by("P.tgl_pesan","DESC");

    return $this->datatables->generate();
  }

  public function selectListDataOrderMarketingSiapDikirim($param){
    $this->datatables->select("P.tgl_pesan, P.tgl_estimasi, P.nm_pemesan, PD.jumlah, P.no_order,
                               PD.jumlah_kirim, (PD.jumlah - PD.jumlah_kirim) AS sisa,
                               GH.ukuran, GH.warna_plastik, PD.merek, PD.sts_pesanan, PD.id_dp,
                               PD.kd_gd_hasil, PD.kd_gd_bahan, GB.warna, GB.nm_barang");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->where("P.deleted='FALSE' AND
                              PD.deleted='FALSE' AND
                              GH.deleted='FALSE' AND
                              P.approve_cabang='FALSE' AND
                              P.jns_order='$param' AND
                              PD.sts_kirim != 'TERKIRIM' AND
                              P.sts_pesanan IN ('PROGRESS','PACKING')");
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->db->order_by("P.tgl_pesan","DESC");

    return $this->datatables->generate();
  }

  public function selectListOrderBaruCabang(){
    $this->datatables->select("no_order, tgl_pesan, nm_pemesan, sts_pesanan");
    $this->datatables->from("pesanan");
    $this->datatables->where("approve_cabang='TRUE' AND
                              sts_pesanan='WAITING' AND
                              deleted='FALSE'");
    $this->db->order_by("tgl_pesan","DESC");
    return $this->datatables->generate();
  }

  public function selectListPantauOrderCabangGlobal(){
    $this->datatables->select("no_order, tgl_pesan, nm_pemesan, sts_pesanan, no_po");
    $this->datatables->from("pesanan");
    $this->datatables->where("approve_cabang='TRUE' AND
                              deleted='FALSE'");
    $this->db->order_by("tgl_pesan","DESC");
    return $this->datatables->generate();
  }

  public function selectListDetailPesanan($param){
    $this->datatables->select("GH.ukuran, PD.merek, GH.warna_plastik, PD.warna_cetak,
                               GB.warna, PD.kd_gd_hasil, PD.kd_gd_bahan, PD.sm,
                               PD.dll, PD.jumlah, PD.satuan, PD.keterangan, PD.sts_pesanan,
                               PD.id_dp");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->datatables->where("P.deleted='FALSE' AND
                              PD.deleted='FALSE' AND
                              PD.no_order = '$param'");
    $this->db->order_by("PD.id_dp","ASC");
    return $this->datatables->generate();
  }

  public function selectDetailPesanan($param){
    $result = $this->db->query("SELECT * FROM pesanan_detail WHERE id_dp='$param' AND deleted='FALSE'")->result_array();
    return json_encode($result);
  }

  public function selectGudangHasilLike($param){
    $param2 = explode('|',trim($param));

    if(strtolower($param2[0])=="cat" OR strtolower($param2[0])=="minyak"){
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
      if(strpos($param, "|") === FALSE){
        $arrGudangHasilLike = $this->db->query("SELECT kd_gd_hasil,ukuran,warna_plastik,tebal,merek,jns_permintaan,jns_brg
                                                FROM gudang_hasil
                                                WHERE kd_gd_hasil LIKE '%$param%' OR
                                                ukuran LIKE '%$param%' OR
                                                warna_plastik LIKE '%$param%' OR
                                                tebal LIKE '%$param%' OR
                                                merek LIKE '%$param%' OR
                                                jns_permintaan LIKE '%$param%' OR
                                                jns_brg LIKE '%$param%'
                                                AND deleted='FALSE'");
      }else{
        $arrKey = explode("|",$param);
        $arrGudangHasilLike = $this->db->query("SELECT kd_gd_hasil,ukuran,warna_plastik,tebal,merek,jns_permintaan,jns_brg
                                                FROM gudang_hasil
                                                WHERE ukuran LIKE '%$arrKey[0]%'
                                                AND merek LIKE '%$arrKey[1]%'
                                                AND warna_plastik LIKE '%$arrKey[2]%'
                                                AND deleted='FALSE'");
      }
      $result = $arrGudangHasilLike->result_array();
      return $result;
    }
  }

  public function selectGudangHasilLimit20(){
    $this->db->select("kd_gd_hasil,warna_plastik,tebal,merek,jns_permintaan,jns_brg,ukuran");
    $this->db->limit(20);
    $arrGudangHasilLimit20 = $this->db->get_where("gudang_hasil",array("deleted"=>"FALSE"));
    return $arrGudangHasilLimit20->result_array();
  }

  public function selectListPantauOrderCabang(){
    $this->datatables->select("PD.id_dp, P.tgl_pesan, P.nm_pemesan, PD.jumlah, PD.jumlah_kirim,
                               (PD.jumlah - PD.jumlah_kirim) AS sisa, GH.ukuran, GH.warna_plastik,
                               PD.merek, PD.dll, PD.sts_pesanan, GB.nm_barang, GB.warna,
                               PD.kd_gd_hasil, PD.kd_gd_bahan, PD.satuan, P.no_po");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->datatables->where("PD.deleted='FALSE' AND
                              P.deleted='FALSE' AND
                              P.approve_cabang='TRUE' AND
                              PD.sts_pesanan NOT IN ('WAITING')");
    $this->db->order_by("P.tgl_pesan","DESC");

    return $this->datatables->generate();
  }

  public function selectListPantauOrderMarketing(){
    $this->datatables->select("PD.id_dp, P.tgl_pesan, P.nm_pemesan, PD.jumlah, PD.jumlah_kirim,
                               (PD.jumlah - PD.jumlah_kirim) AS sisa, GH.ukuran, GH.warna_plastik,
                               PD.merek, PD.dll, PD.sts_pesanan, GB.nm_barang, GB.warna,
                               PD.kd_gd_hasil, PD.kd_gd_bahan, PD.satuan, P.no_po");
    $this->datatables->from("pesanan_detail PD");
    $this->datatables->join("pesanan P","PD.no_order = P.no_order","INNER");
    $this->datatables->join("gudang_hasil GH","PD.kd_gd_hasil = GH.kd_gd_hasil","LEFT");
    $this->datatables->join("gudang_bahan GB","PD.kd_gd_bahan = GB.kd_gd_bahan","LEFT");
    $this->datatables->where("PD.deleted='FALSE' AND
                              P.deleted='FALSE' AND
                              P.approve_cabang='FALSE' AND
                              PD.sts_pesanan NOT IN ('WAITING')");
    $this->db->order_by("P.tgl_pesan","DESC");

    return $this->datatables->generate();
  }

  public function selectPesananForPrintOrder($param){
    $result = $this->db->query("SELECT P.tgl_pesan, P.nm_pemesan, C.alamat, P.no_po,
                                       C.hp_purchasing, C.tlp_kantor, C.tlp_lainnya,
                                       P.no_order
                                FROM pesanan P
                                INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                WHERE P.deleted = 'FALSE'
                                AND P.no_order='$param'
                                AND C.deleted='FALSE'")->result_array();
    $result2 = $this->db->query("SELECT PD.jumlah, GH.ukuran, PD.merek, GH.warna_plastik,
                                        PD.warna_cetak, PD.sm, PD.dll, PD.keterangan, GB.warna,
                                        PD.kd_gd_hasil
                                 FROM pesanan_detail PD
                                 INNER JOIN pesanan P ON PD.no_order = P.no_order
                                 LEFT JOIN gudang_hasil GH ON PD.kd_gd_hasil = GH.kd_gd_hasil
                                 LEFT JOIN gudang_bahan GB ON PD.kd_gd_bahan = GB.kd_gd_bahan
                                 WHERE PD.deleted='FALSE'
                                 AND PD.no_order='$param'")->result_array();
    $data = array("Pesanan" => $result,
                  "PesananDetail" => $result2);
    return $data;
  }

  public function selectListHistoryOrderCabangGlobal($param){
    $this->datatables->select("no_order, tgl_pesan, nm_pemesan, sts_pesanan, no_po");
    $this->datatables->from("pesanan");
    $this->datatables->where("approve_cabang='TRUE' AND
                              tgl_pesan BETWEEN '$param[tglAwal]' AND '$param[tglAkhir]' AND
                              deleted='FALSE'");
    $this->db->order_by("tgl_pesan","DESC");
    return $this->datatables->generate();
  }

  public function selectCountOrderBaruCabang(){
    $result = $this->db->query("SELECT COUNT(no_order) AS counter
                                FROM pesanan
                                WHERE approve_cabang='TRUE'
                                AND sts_pesanan='WAITING'
                                AND deleted='FALSE'")->result_array();
    return json_encode($result);
  }
  //============ Select Function (Finish) ============//

  //============ Update Function (Start) ============//
  public function updatePesananDetail($param){
    $this->db->trans_begin();
    $this->db->where("id_dp",$param["id_dp"]);
    $this->db->update("pesanan_detail", $param);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateDeleteAndRestorePesanan($param){
    $this->db->trans_begin();
    $this->db->where("id_dp",$param["id_dp"]);
    $this->db->update("pesanan_detail", $param);
    $arrCountDeleted = $this->db->query("SELECT COUNT(id_dp) AS counter
                                         FROM pesanan_detail
                                         WHERE deleted='TRUE'
                                         AND no_order='$param[no_order]'")->result_array();
    $arrCountTotalDetail = $this->db->query("SELECT COUNT(id_dp) AS counter
                                             FROM pesanan_detail
                                             WHERE no_order='$param[no_order]'")->result_array();
    if($arrCountDeleted[0]["counter"] >= $arrCountTotalDetail[0]["counter"]){
      $this->db->set("deleted","TRUE");
      $this->db->where("no_order",$param["no_order"]);
      $this->db->update("pesanan");
    }else{
      $this->db->set("deleted","FALSE");
      $this->db->where("no_order",$param["no_order"]);
      $this->db->update("pesanan");
    }
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function saveApproveOrder($param){
    $this->db->trans_begin();
    $arrCounter = $this->db->query("SELECT COUNT(id_dp) AS counter
                                    FROM pesanan_detail
                                    WHERE deleted='FALSE'
                                    AND no_order='$param'")->result_array();
    if($arrCounter[0]["counter"] > 0){
      $this->db->set("sts_pesanan","OPEN");
      $this->db->where("no_order",$param);
      $this->db->update("pesanan");

      $this->db->set("sts_pesanan","OPEN");
      $this->db->where("no_order",$param);
      $this->db->update("pesanan_detail");

      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        return "Gagal";
      }else{
        $this->db->trans_commit();
        return "Berhasil";
      }
    }else{
      return "Data Kosong";
    }
  }

  public function updateKirimPesanan($param){
    $this->db->trans_begin();
    $tglKirim = date("Y-m-d H:i:s");
    $this->db->where("id_dp",$param["id_dp"]);
    $this->db->update("pesanan_detail",$param);
    $counterFinish = $this->db->query("SELECT COUNT(id_dp) AS counter
                                       FROM pesanan_detail
                                       WHERE no_order='$param[no_order]'
                                       AND sts_kirim='TERKIRIM'
                                       AND deleted='FALSE'
                                       AND sts_pesanan='FINISH'")->result_array();
    $counterTotal = $this->db->query("SELECT COUNT(id_dp) AS counter
                                      FROM pesanan_detail
                                      WHERE no_order='$param[no_order]'
                                      AND deleted='FALSE'")->result_array();
    if($counterFinish[0]["counter"] == $counterTotal[0]["counter"]){
      $this->db->query("UPDATE pesanan SET sts_pesanan='FINISH', tgl_kirim='$tglKirim'
                        WHERE no_order='$param[no_order]'");
    }
    if($this->db->trans_status === FALSE){
      $this->db->trans_rollback();
      return FALSE;
    }else{
      $this->db->trans_commit();
      return TRUE;
    }
  }

  public function updateKirimPesananFullBatch($param){
    $this->db->trans_begin();
    for ($i=0; $i < count($param); $i++) {
      $tglKirim = date("Y-m-d H:i:s");
      $this->db->where("id_dp",$param[$i]["id_dp"]);
      $this->db->update("pesanan_detail",$param[$i]);
      $noOrder = $param[$i]["no_order"];
      $counterFinish = $this->db->query("SELECT COUNT(id_dp) AS counter
                                         FROM pesanan_detail
                                         WHERE no_order='$noOrder'
                                         AND sts_kirim='TERKIRIM'
                                         AND deleted='FALSE'
                                         AND sts_pesanan='FINISH'")->result_array();
      $counterTotal = $this->db->query("SELECT COUNT(id_dp) AS counter
                                        FROM pesanan_detail
                                        WHERE no_order='$noOrder'
                                        AND deleted='FALSE'")->result_array();
      if($counterFinish[0]["counter"] == $counterTotal[0]["counter"]){
        $this->db->query("UPDATE pesanan SET sts_pesanan='FINISH', tgl_kirim='$tglKirim'
                          WHERE no_order='$noOrder'");
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
  //============ Update Function (Finish) ============//

  //============ Delete Function (Start) ============//
  //============ Delete Function (Finish) ============//
}
?>
