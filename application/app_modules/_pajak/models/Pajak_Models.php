<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pajak_Models extends CI_Model{

	public function getDataOrderPajak($jenis)
	{
    $this->datatables->select("P.no_order, P.kd_order, P.nm_pemesan, DATE_FORMAT(P.tgl_pesan,'%d-%m-%Y') AS tgl_pesan, DATE_FORMAT(P.tgl_estimasi,'%d-%m-%Y') AS tgl_estimasi, P.sts_pesanan, C.nm_perusahaan, C.nm_purchasing");
    $this->datatables->from("pesanan P");
    $this->datatables->join("customer C","P.kd_cust = C.kd_cust","INNER");
    if ($jenis=="DK") {
      $this->datatables->where("`P`.`jns_order` ='DK' AND `P`.`sts_pesanan` != 'FINISH' AND `P`.`sts_pesanan` != 'WAITING' AND `P`.`pajak` = 'TRUE' AND `P`.`deleted` = 'FALSE'");
    }else if($jenis=="LK"){
       $this->datatables->where("`P`.`jns_order` ='LK' AND `P`.`sts_pesanan` != 'FINISH' AND `P`.`sts_pesanan` != 'WAITING' AND `P`.`pajak` = 'TRUE' AND `P`.`deleted` = 'FALSE'");
    }else if($jenis=="CBG"){
      $this->datatables->where("`P`.`approve_cabang` = 'TRUE' AND `P`.`sts_pesanan` != 'FINISH' AND `P`.`sts_pesanan` != 'WAITING' AND `P`.`pajak` = 'TRUE' AND `P`.`deleted` = 'FALSE'");
    }		
		return $this->datatables->generate();
	}

	public function selectLihatPesanan($param){
    $arrPesananEdit = $this->db->query("SELECT P.no_order,P.kd_order,P.kd_cust,P.no_po,
                                               P.nm_pemesan,DATE_FORMAT(P.tgl_pesan,'%d-%M-%Y') AS tgl_pesan,
                                               DATE_FORMAT(P.tgl_estimasi,'%d-%M-%Y') AS tgl_estimasi,P.payment_method,
                                               P.expedisi,P.pajak,P.jns_order,P.dp,P.mata_uang,P.note,DATE_FORMAT(P.diperbarui,'%d-%M-%Y %H:%i:%s') AS diperbarui,
                                               P.foto_1,P.foto_2,P.proof,P.ket_proof,
                                               C.nm_perusahaan,C.nm_owner,C.nm_purchasing,U.username
                                        FROM pesanan P
                                        INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                        INNER JOIN users U ON P.id_user = U.id_user
                                        WHERE P.no_order = '$param' AND P.deleted='FALSE'");
    return $arrPesananEdit->result_array();
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

  public function selectFakturPesanan($param){
    $arrFakturPesanan = $this->db->query("SELECT P.no_order,P.proof,DATE_FORMAT(P.tgl_pesan,'%d-%M-%Y') AS tgl_pesan,
                                                 DATE_FORMAT(P.tgl_estimasi,'%d-%M-%Y') AS tgl_estimasi, P.nm_pemesan,
                                                 P.no_po,P.note,P.foto_1,P.foto_2,P.expedisi,P.payment_method,P.expedisi,
                                                 IF(P.pajak='TRUE','P','N') pajak,P.jns_order,P.ket_proof, P.mata_uang, P.sales,
                                                 P.dp,C.alamat,C.tlp_kantor,C.nm_perusahaan,U.username,U.ttd
                                          FROM pesanan P
                                          INNER JOIN customer C ON P.kd_cust = C.kd_cust
                                          INNER JOIN users U ON P.id_user = U.id_user
                                          WHERE P.no_order = '$param' AND P.deleted='FALSE'");
    return $arrFakturPesanan->result_array();
  }

  public function selectFakturPesananDetail($param){
    $arrFakturPesananDetail = $this->db->query("SELECT FORMAT(PD.jumlah,1) AS jumlah,PD.satuan,
                                                       GH.ukuran,PD.merek,PD.harga,GH.merek AS merekProduk,
                                                       GH.warna_plastik,PD.warna_cetak,PD.sm,PD.dll,PD.cn,
                                                       PD.potongan, PD.diskon,
                                                       CONCAT(CONVERT(FORMAT(PD.omset_kg,2) USING utf8),'=',CONVERT(FORMAT(PD.omset_lembar,2) USING utf8)) AS omset
                                                FROM pesanan_detail PD
                                                LEFT JOIN gudang_hasil GH ON PD.kd_gd_hasil = GH.kd_gd_hasil
                                                LEFT JOIN gudang_bahan GB ON PD.kd_gd_bahan = GB.kd_gd_bahan
                                                WHERE PD.no_order = '$param' AND PD.deleted='FALSE'");
    return $arrFakturPesananDetail->result_array();
  }
}
?>