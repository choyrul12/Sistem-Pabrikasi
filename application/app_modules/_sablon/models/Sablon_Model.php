<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sablon_Model extends CI_Model{

	public function getDataRencanaPIC()
	{
		$this->datatables->select("*");
		$this->datatables->from("rencana_ppic");
		$this->datatables->where("(YEAR(tgl_rencana) = YEAR(NOW()) AND MONTH(NOW())
															AND bagian = 'SABLON'
															AND sts_pengerjaan = 'PENDING'
															AND deleted='FALSE')
															OR (YEAR(tgl_rencana) = YEAR(NOW())
															AND MONTH(NOW())
															AND bagian = 'SABLON'
															AND sts_pengerjaan = 'PROGRESS'
															AND sisa >0
															AND deleted='FALSE')");
		$this->db->order_by("tgl_rencana asc");

		return $this->datatables->generate();
	}

  public function getDataSearchRencanaPIC($tgl1,$tgl2)
  {
    $this->datatables->select("*");
    $this->datatables->from("rencana_ppic");
    $this->datatables->where("tgl_rencana between '$tgl1' and '$tgl2' and bagian = 'SABLON' and sts_pengerjaan != 'FINISH' and sisa >0 AND deleted='FALSE'");
    $this->db->order_by("tgl_rencana asc");

    return $this->datatables->generate();
  }

	function getDataConversi($key)
	{
		$data = $this->db->query("select kd_ppic, ukuran, jumlah_permintaan, berat, tebal, satuan_kilo from rencana_ppic where kd_ppic = '$key'");
		return $data;
	}

	function convertKG($key,$kg)
	{
		$this->db->trans_begin();
		$this->db->set('satuan_kilo',$kg);
	  $this->db->where('kd_ppic',$key);
		$this->db->update('rencana_ppic');

	    if($this->db->trans_status() === FALSE){
	      $this->db->trans_rollback();
	      return "Gagal";
	    }else{
	      $this->db->trans_commit();
	      return "Berhasil";
	    }
	}

	function getDataRencana($key)
	{
		$data = $this->db->query("select * from rencana_ppic where kd_ppic = '$key'");
		return $data;
	}

	function codeSablon(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_sablon,4)) AS kode FROM rencana_sablon");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "000";
      }
      $tempCode = "000".(intval($arrMaxCode->kode)+1);
      $fixCode = "SBL".date("ymd").substr($tempCode,(strlen($tempCode)-4));
    }

    return $fixCode;
  }

	function getDataRencanaTemp($id)
	{
		$this->datatables->select("*");
    $this->datatables->from("rencana_sablon");
    $this->datatables->where("sts_pengerjaan='PENDING'");

    return $this->datatables->generate();
	}

	function insertRencana($data,$sisa)
	{
		$this->db->trans_begin();

    $this->db->set('sisa',$sisa);
    $this->db->where('kd_ppic',$data['kd_ppic']);
    $this->db->update('rencana_ppic');

		$this->db->insert('rencana_sablon',$data);
		if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
	}

  function insertRencanaSusulan($data)
  {
    $this->db->trans_begin();

    $this->db->insert('rencana_sablon',$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

	function deleteRencana($key,$sisa,$kd_ppic)
	{
		$this->db->trans_begin();

		$this->db->where('kd_sablon', $key);
    $this->db->delete('rencana_sablon');

		$this->db->set('sisa',$sisa);
    $this->db->where('kd_ppic',$kd_ppic);
    $this->db->update('rencana_ppic');

		if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
	}

	function getDataRencanaSablon($key)
	{
		$data =  $this->db->query("select * from rencana_sablon where kd_sablon = '$key'");
		return $data;
	}

	function updateRencana($kd_ppic,$kd_sablon,$data,$sisa)
	{
		$this->db->trans_begin();

		$this->db->where('kd_sablon', $kd_sablon);
    $this->db->update('rencana_sablon', $data);

		$this->db->set('sisa',$sisa);
    $this->db->where('kd_ppic',$kd_ppic);
    $this->db->update('rencana_ppic');

		if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
	}

	function saveRencana($kd_ppic)
	{
		$this->db->trans_begin();

		$this->db->set('sts_pengerjaan','PROGRESS');
    $this->db->where('sts_pengerjaan','PENDING');
    $this->db->update('rencana_sablon');

		$this->db->set('sts_pengerjaan','PROGRESS');
    $this->db->where('sts_pengerjaan','PENDING');
		$this->db->where('kd_ppic',$kd_ppic);
    $this->db->update('rencana_ppic');

		if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
	}

	function getDataRencanaMandorSablon()
	{
		$this->datatables->select(" kd_sablon, tgl_rencana, customer, merek, ukuran, warna_plastik, warna_sablon, jml_rencana, jml_sisa");
    $this->datatables->from("rencana_sablon");
    $this->datatables->where("sts_pengerjaan='PROGRESS' and jml_sisa != 0 and deleted = 'FALSE'");

    return $this->datatables->generate();
	}

	function getItemRencanaSablon($key)
	{
		$data =  $this->db->query("select * from rencana_sablon  where kd_sablon = '$key' and deleted ='FALSE'");
		return $data;
	}

	function saveHasilSablon($hasil,$cat,$minyak,$jml_sisa,$jml_hasil,$kd_ppic)
	{
		$this->db->trans_begin();

		$this->db->insert('transaksi_hasil_sablon',$hasil);
		$this->db->insert_batch("transaksi_penggunaan_bahan_sablon",$cat);
    $this->db->insert("transaksi_penggunaan_bahan_sablon",$minyak);

		$this->db->set('jml_sisa',$jml_sisa);
		$this->db->set('jml_hasil',$jml_hasil);
    $this->db->where('kd_sablon',$hasil['kd_sablon']);
    $this->db->update('rencana_sablon');

		$check_sisa = $this->db->query("select jml_sisa from rencana_sablon where kd_sablon = '$hasil[kd_sablon]'")->result_array();
		$check_sisa = $check_sisa[0]['jml_sisa'];
		if ($check_sisa <= 0) {
			$this->db->set('sts_pengerjaan','FINISH');
	    $this->db->where('kd_sablon',$hasil['kd_sablon']);
      $this->db->update('rencana_sablon');
		}

		$sumHasil = $this->db->query("SELECT SUM(jml_hasil) as total from rencana_sablon WHERE kd_ppic = '$kd_ppic'");
		foreach ($sumHasil->result_array() as $sum) {
			$totHasil = $sum['total'];
		}

		$checkPermintaan = $this->db->query("SELECT `satuan_kilo` FROM `rencana_ppic` WHERE `kd_ppic` = '$kd_ppic'");
		foreach ($checkPermintaan->result_array() as $total) {
			$totalPermintaan = $total['satuan_kilo'];
		}

		$checkSisa = $totalPermintaan - $totHasil;

		if ($checkSisa <= 0) {
			$this->db->set('sts_pengerjaan','FINISH');
	    $this->db->where('kd_ppic',$kd_ppic);
	    $this->db->update('rencana_ppic');
		}

		if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
	}

	function getCat()
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where jenis = 'CAT MURNI' ")->result_array();
    return json_encode($data);
  }

  function searchCat($key)
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where jenis = 'CAT MURNI' and concat(nm_barang,' ',warna) REGEXP '$key'")->result_array();
    return json_encode($data);
  }

	function getCatCampur()
	{
		$data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where jenis = 'CAT CAMPUR' ");
		return $data;
	}

	function getMinyak()
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, status from gudang_bahan where jenis = 'MINYAK' ")->result_array();
    return json_encode($data);
  }

  function searchMinyak($key)
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, status from gudang_bahan where jenis = 'MINYAK' and nm_barang like '%$key%'")->result_array();
    return json_encode($data);
  }

	function codeHasilSablon(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_hasil_sablon,4)) AS kode FROM transaksi_hasil_sablon");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "000";
      }
      $tempCode = "000".(intval($arrMaxCode->kode)+1);
      $fixCode = "HSS".date("ymd").substr($tempCode,(strlen($tempCode)-4));
    }

    return $fixCode;
	}

	function getDataHasilSablonTemp($id)
	{
		$this->datatables->select("*");
    $this->datatables->from("transaksi_hasil_sablon");
    $this->datatables->where("kd_hasil_sablon = '$id' and status='PENDING' and deleted = 'FALSE'");

    return $this->datatables->generate();
	}

	function test()
	{
		$test = $this->db->query("SELECT a.customer, a.merek, a.ukuran, a.warna_plastik, a.warna_sablon, b.hasil_lembar, b.hasil_berat, b.jns_brg, group_concat(c.jumlah_pengambilan) as jumlah_pengambilan , group_concat(c.sisa_pengambilan) as sisa_pengambilan, group_concat(d.warna) as warna, group_concat(d.nm_barang) as nm_barang FROM rencana_sablon a join transaksi_hasil_sablon b on a.kd_sablon = b.kd_sablon JOIN transaksi_penggunaan_bahan_sablon c on b.kd_hasil_sablon = c.kd_hasil_sablon JOIN gudang_bahan d on d.kd_gd_bahan = c.kd_gd_bahan");
		return $test;
	}

	function getDataHasilSablon()
	{
		$date = date("Y-m");
		$this->datatables->select("a.customer , b.*");
		$this->datatables->from("rencana_sablon a");
		$this->datatables->join("transaksi_hasil_sablon b","a.kd_sablon = b.kd_sablon");
		$this->datatables->where("DATE_FORMAT(`tanggal`, '%Y-%m')= '$date'");
	  return $this->datatables->generate();
	}

	function getHasilSablonPerTgl($tgl1,$tgl2)
	{
		$this->datatables->select("a.customer , b.*");
		$this->datatables->from("rencana_sablon a");
		$this->datatables->join("transaksi_hasil_sablon b","a.kd_sablon = b.kd_sablon");
		$this->datatables->where("b.tanggal between '$tgl1' and '$tgl2'");

	  return $this->datatables->generate();
	}

  function getBonHasilSablonPerTgl($tgl)
  {
    $this->datatables->select("a.customer , b.*");
    $this->datatables->from("rencana_sablon a");
    $this->datatables->join("transaksi_hasil_sablon b","a.kd_sablon = b.kd_sablon");
    $this->datatables->where("b.tanggal ='$tgl'");

    return $this->datatables->generate();
  }

  function getListBonHasilSablon($tgl)
  {
    $data = $this->db->query("select a.customer , b.* from rencana_sablon a join transaksi_hasil_sablon b on a.kd_sablon = b.kd_sablon where b.tanggal ='$tgl'");

    return $data;
  }

	function checkHasilSablon($tgl1,$tgl2)
	{
		$check = $this->db->query("select a.customer , b.* from rencana_sablon a join transaksi_hasil_sablon b on a.kd_sablon = b.kd_sablon where b.tanggal between '$tgl1' and '$tgl2'");
		return $check->num_rows();
	}

	function checkBonHasilSablon($tgl)
	{
		$check = $this->db->query("select a.customer , b.* from rencana_sablon a join transaksi_hasil_sablon b on a.kd_sablon = b.kd_sablon where b.tanggal = '$tgl'");
		return $check->num_rows();
	}

	function detail_hasil($kd_hasil_sablon)
	{
		$data = $this->db->query("select * from transaksi_hasil_sablon where kd_hasil_sablon ='$kd_hasil_sablon'");
		return $data;
	}

	function detail_bahan($kd_hasil_sablon)
	{
		$data = $this->db->query("select a.*, b.nm_barang, b.jenis, b.warna from transaksi_penggunaan_bahan_sablon a join gudang_bahan b on a.kd_gd_bahan = b.kd_gd_bahan where a.kd_hasil_sablon = '$kd_hasil_sablon'");
		return $data;
	}

	function getDataKirimSablon($tgl)
	{
		$data = $this->db->query("SELECT a.*, b.customer, c.jns_permintaan, c.jns_brg FROM transaksi_hasil_sablon a inner join rencana_sablon b on a.kd_sablon = b.kd_sablon inner join gudang_hasil c on a.kd_gd_hasil = c.kd_gd_hasil where a.tanggal = '$tgl' and a.status_bon = 'FALSE'")->result_array();
		 return json_encode($data);
	}

  function getDataPenggunaanBahanSablon($tgl)
  {
    $data = $this->db->query("SELECT a.kd_hasil_sablon, a.kd_gd_bahan, a.jumlah_pengambilan, a.sisa_pengambilan, b.id_user, b.tanggal  from transaksi_penggunaan_bahan_sablon a join transaksi_hasil_sablon b on a.kd_hasil_sablon = b.kd_hasil_sablon where b.status_bon = 'FALSE' and b.tanggal = '$tgl'")->result_array();
     return json_encode($data);
  }

	function kirimHasilSablon($data,$tgl)
	{
		$this->db->trans_begin();
		$this->db->insert_batch('transaksi_gudang_hasil',$data);
    // $this->db->insert_batch('transaksi_gudang_bahan',$bahan);

    $penggunaanBahan = $this->db->query("SELECT a.kd_hasil_sablon, a.kd_gd_bahan, a.jumlah_pengambilan, a.sisa_pengambilan, b.id_user, b.tanggal  from transaksi_penggunaan_bahan_sablon a join transaksi_hasil_sablon b on a.kd_hasil_sablon = b.kd_hasil_sablon where b.status_bon = 'FALSE' and b.tanggal = '$tgl'");

    foreach ($penggunaanBahan->result_array() as $value) {
      $jummlaPenggunaan = $value["jumlah_permintaan"]-$value["sisa_pengambilan"];
      $this->db->set("stok", "`stok`-$jummlaPenggunaan",FALSE);
      $this->db->where("kd_gd_bahan",$value["kd_gd_bahan"]);
      $this->db->update("gudang_bahan_sablon");
    }

		$this->db->set('status_bon','TRUE');
    $this->db->set('status','FINISH');
    $this->db->where('tanggal',$tgl);
	  $this->db->update('transaksi_hasil_sablon');

		if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
	}

  function getBarangHD()
  {
    $data = $this->db->query("select kd_gd_hasil, warna_plastik, ukuran from gudang_hasil where merek = 'HD'")->result_array();
    return json_encode($data);
  }

  function searchBarangHD($key)
  {
    $data = $this->db->query("select kd_gd_hasil, warna_plastik, ukuran from gudang_hasil where merek ='hd' and concat(ukuran,' ',warna_plastik) REGEXP '$key'")->result_array();
    return json_encode($data);
  }

  function getDetailHD($key)
  {
    $data = $this->db->query("select * from gudang_hasil where kd_gd_hasil = '$key'");
    return $data;
  }

  function addDataPengembalianHD($data)
  {
    $this->db->trans_begin();
    $this->db->insert('transaksi_gudang_hasil',$data);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  function getDataPengembalianHD()
  {
    $this->datatables->select("tgl_transaksi, customer, id_permintaan_jadi, kd_gd_hasil, merek, ukuran, warna, jumlah_berat, jumlah_lembar");
    $this->datatables->from("transaksi_gudang_hasil");
    $this->datatables->where("keterangan_history='KEMBALIAN DARI SABLON' and sts_approve = 'FALSE' and status_transaksi = 'PENDING'");

    return $this->datatables->generate();
  }

  function deleteListKembalianHD($key)
  {
    $this->db->trans_begin();
    $this->db->query("delete from transaksi_gudang_hasil where id_permintaan_jadi = '$key'");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  function getDataPengembalianHDById($key)
  {
    $data = $this->db->query("select id_permintaan_jadi, customer, kd_gd_hasil, tgl_transaksi, ukuran, warna, jumlah_berat, jumlah_lembar from transaksi_gudang_hasil where id_permintaan_jadi = '$key'")->result_array();
    return json_encode($data);
  }

  function kirimPengembalianHD()
  {
    $this->db->trans_begin();
    $this->db->set('status_transaksi','PROGRESS');
    $this->db->where('status_transaksi','PENDING');
    $this->db->update('transaksi_gudang_hasil');

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  function getMerekSablon()
  {
    $data = $this->db->query("select kd_gd_hasil, ukuran, warna_plastik, merek from gudang_hasil where jns_brg = 'SABLON' and jns_permintaan = 'CETAK'")->result_array();
    return json_encode($data);
  }

  function searchMerekSablon($key)
  {
    $data = $this->db->query("select kd_gd_hasil, ukuran, warna_plastik, merek from gudang_hasil where jns_brg = 'SABLON' and jns_permintaan = 'CETAK' and concat(merek,'' ,ukuran,' ', warna_plastik) REGEXP '$key'")->result_array();
    return json_encode($data);
  }

  function getUkuranSablonBuffer()
  {
    $data = $this->db->query("select kd_gd_hasil, warna_plastik, ukuran, merek, sts_brg from gudang_hasil where jns_brg = 'SABLON' and jns_permintaan = 'POLOS'")->result_array();
    return json_decode($data);
  }

  function searchUkuranSablonBuffer($key)
  {
    $data = $this->db->query("select kd_gd_hasil, warna_plastik, ukuran, merek, sts_brg from gudang_hasil where jns_brg = 'SABLON' and jns_permintaan = 'POLOS' and concat(kd_gd_hasil,' ',ukuran,' ',merek,' ',warna_plastik,' ',sts_brg) REGEXP '$key'")->result_array();
    return json_decode($data);
  }

  function updateListPengembalianHD($data)
  {
    $this->db->trans_begin();
    $this->db->set('customer',$data["customer"]);
    $this->db->set('jumlah_lembar',$data["jumlah_lembar"]);
    $this->db->set('jumlah_berat',$data["jumlah_berat"]);
    $this->db->set('tgl_transaksi', $data["tgl_transaksi"]);
    $this->db->where('id_permintaan_jadi',$data["id"]);
    $this->db->update('transaksi_gudang_hasil');

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  function getDataPenggunaanBahanSablonById($id)
  {
    $data = $this->db->query("select a.id_penggunaan_sablon, a.kd_hasil_sablon, a.kd_gd_bahan, a.jumlah_pengambilan, a.sisa_pengambilan, b.nm_barang, b.warna, b.jenis from transaksi_penggunaan_bahan_sablon a join gudang_bahan b on a.kd_gd_bahan = b.kd_gd_bahan where id_penggunaan_sablon = '$id'")->result_array();
    return json_encode($data);
  }

  function updatePenggunaanBahanSablon($data)
  {
    $this->db->trans_begin();
    $this->db->set('jumlah_pengambilan',$data["jumlah_pengambilan"]);
    $this->db->set('sisa_pengambilan',$data["sisa_pengambilan"]);
    $this->db->where('id_penggunaan_sablon',$data["id"]);
    $this->db->update('transaksi_penggunaan_bahan_sablon');

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  function getDataHasilSablonById($id)
  {
    $data = $this->db->query("select kd_hasil_sablon, kd_sablon, tanggal, ukuran, merek, warna_plastik, warna_cat, hasil_lembar, hasil_berat from transaksi_hasil_sablon where kd_hasil_sablon = '$id'")->result_array();
    return json_encode($data);
  }

  function updateDataHasilSablon($data)
  {
    $this->db->trans_begin();

    $rencana_sablon = $this->db->query("select jml_sisa, jml_hasil from rencana_sablon where kd_sablon = '$data[kd_sablon]'")->result_array();
    $jml_sisa = $rencana_sablon[0]['jml_sisa'];
    $jml_hasil= $rencana_sablon[0]['jml_hasil'];
    $re_hasil = $jml_hasil - $data["hasil_awal"];
    $new_hasil= $re_hasil + $data["lembar"];
    $re_sisa  = $jml_sisa + $data["hasil_awal"];
    $new_sisa = $re_sisa - $data["lembar"];

    if ($new_sisa > 0) {
      $this->db->set('jml_sisa', $new_sisa);
      $this->db->set('jml_hasil',$new_hasil);
      $this->db->set('sts_pengerjaan','PROGRESS');
      $this->db->where('kd_sablon',$data["kd_sablon"]);
      $this->db->update('rencana_sablon');
    }else{
      $this->db->set('jml_sisa', $new_sisa);
      $this->db->set('jml_hasil',$new_hasil);
      $this->db->set('sts_pengerjaan','FINISH');
      $this->db->where('kd_sablon',$data["kd_sablon"]);
      $this->db->update('rencana_sablon');
    }

    $this->db->set('hasil_lembar', $data["lembar"]);
    $this->db->set('hasil_berat',$data["berat"]);
    $this->db->where('kd_hasil_sablon',$data["kd_hasil"]);
    $this->db->update('transaksi_hasil_sablon');

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  function deleteHasilSablon($idSablon,$idHasil)
  {
    $this->db->trans_begin();
    $hasil = $this->db->query("select hasil_lembar from transaksi_hasil_sablon where kd_hasil_sablon = '$idHasil'")->result_array();
    $hasil = $hasil[0]["hasil_lembar"];

    $rencana  = $this->db->query("select jml_sisa, jml_hasil from rencana_sablon where kd_sablon = '$idSablon'")->result_array();
    $jml_sisa = $rencana[0]["jml_sisa"];
    $jml_hasil= $rencana[0]["jml_hasil"];

    $re_sisa = $jml_sisa + $hasil;
    $re_hasil= $jml_hasil - $hasil;

    $this->db->set('jml_sisa',$re_sisa);
    $this->db->set('jml_hasil',$re_hasil);
    $this->db->set('sts_pengerjaan','PROGRESS');
    $this->db->where('kd_sablon',$idSablon);
    $this->db->update('rencana_sablon');

    $this->db->query("delete from transaksi_penggunaan_bahan_sablon where kd_hasil_sablon = '$idHasil'");
    $this->db->query("delete from transaksi_hasil_sablon where kd_hasil_sablon = '$idHasil'");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }
}
