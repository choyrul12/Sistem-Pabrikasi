<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Purchase_Model extends CI_Model{

  public function generateGudangBahanCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_gd_bahan,3)) AS kode FROM gudang_bahan");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "00";
      }
      $tempCode = "00".(intval($arrMaxCode->kode)+1);
      $fixCode = "BHN".date("ymd").substr($tempCode,(strlen($tempCode)-3));
    }
    return $fixCode;
  }

  public function getDataMasterBahanBaku()
  {
    $this->datatables->select("kd_gd_bahan, nm_barang, warna, stok, satuan");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("jenis = 'Bahan Baku' and deleted='FALSE'");
    $this->db->order_by("nm_barang asc");

    return $this->datatables->generate();
  }

  public function getDataMasterBijiWarna()
  {
    $this->datatables->select("kd_gd_bahan, nm_barang, warna, stok, satuan");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("jenis = 'Biji Warna' and deleted='FALSE'");
    $this->db->order_by("nm_barang asc");

    return $this->datatables->generate();
  }

  public function getDataMasterMinyak()
  {
    $this->datatables->select("kd_gd_bahan, nm_barang, warna, stok, satuan");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("jenis = 'Minyak' and deleted='FALSE'");
    $this->db->order_by("nm_barang asc");

    return $this->datatables->generate();
  }

  public function getDataMasterCatMurni()
  {
    $this->datatables->select("kd_gd_bahan, nm_barang, warna, stok, satuan");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("jenis = 'Cat Murni' and deleted='FALSE'");
    $this->db->order_by("nm_barang asc");

    return $this->datatables->generate();
  }

  public function getDataMasterCatCampur()
  {
    $this->datatables->select("kd_gd_bahan, nm_barang, warna, stok, satuan");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("jenis = 'Cat Campur' and deleted='FALSE'");
    $this->db->order_by("nm_barang asc");

    return $this->datatables->generate();
  }

  public function getDataMasterApal()
  {
    $this->datatables->select("kd_gd_apal, jenis, sub_jenis, stok");
    $this->datatables->from("gudang_apal");
    $this->datatables->where("deleted = 'FALSE'");
    $this->db->order_by("jenis asc");

    return $this->datatables->generate();
  }

  public function getDataMasterSparePart()
  {
    $this->datatables->select("kd_spare_part,kd_accurate,nm_spare_part,kode,ukuran,stok,stok_aktual,tgl_masuk");
    $this->datatables->from("spare_part");
    $this->datatables->where("deleted = 'FALSE'");
    $this->db->order_by("nm_spare_part asc");

    return $this->datatables->generate();
  }

  public function getPermintaanBarang($param)
  {
    $data = $this->db->query("SELECT TPB.kd_permintaan_barang, TPB.tgl_permintaan, TDPB.jumlah_permintaan,
                                     GB.nm_barang, TPB.bagian, GB.warna
                              FROM transaksi_permintaan_barang TPB
                              INNER JOIN transaksi_detail_permintaan_barang TDPB ON TDPB.kd_permintaan_barang = TPB.kd_permintaan_barang
                              INNER JOIN gudang_bahan GB ON TDPB.kd_gd_bahan = GB.kd_gd_bahan
                              WHERE GB.jenis='$param'
                              AND TPB.deleted='FALSE'
                              AND TPB.status_permintaan='PENDING'
                              AND TPB.status_approve='FALSE'")->result_array();
    return json_encode($data);
  }

  public function getPermintaanSparePart()
  {
    $data = $this->db->query("select a.id, a.kd_spare_part, a.tgl_transaksi, a.jumlah, b.nm_spare_part, b.ukuran from transaksi_detail_spare_part a join spare_part b on a.kd_spare_part = b.kd_spare_part where a.keterangan_history = 'PEMBELIAN BARANG' and a.sts_transaksi = 'PENDING' and a.deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function checkRencanaPembelianBahan($param)
  {
    $data = $this->db->query("select a.kd_gd_bahan, b.jenis from transaksi_gudang_bahan a join gudang_bahan b on a.kd_gd_bahan = b.kd_gd_bahan where a.keterangan_history = 'PEMBELIAN BARANG' and a.status = 'PROGRESS' and a.deleted = 'FALSE' and b.jenis='$param'");
    return $data->num_rows();
  }

  public function checkStokSparePart()
  {
    $data = $this->db->query("SELECT kd_spare_part FROM `spare_part` WHERE `stok`<`stok_aktual`*0.5 and deleted ='FALSE'");
    return $data->num_rows();
  }

  public function checkPermintaanSparePart()
  {
    $data = $this->db->query("SELECT id from transaksi_detail_spare_part where sts_transaksi = 'PENDING' and deleted = 'FALSE'");
    return $data->num_rows();
  }

  public function deletePermintaanBahan($id)
  {
    $this->db->trans_begin();
    $this->db->query("delete from transaksi_gudang_bahan where id = '$id'");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function deletePermintaanSparePart($id)
  {
    $this->db->trans_begin();
    $this->db->query("delete from transaksi_detail_spare_part where id = '$id'");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function updatePermintaanBahan($id,$jumlah)
  {
    $this->db->trans_begin();
    $this->db->set('jumlah_permintaan',$jumlah);
    $this->db->where('id',$id);
    $this->db->update('transaksi_gudang_bahan');
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function updatePermintaanSparePart($id,$jumlah)
  {
    $this->db->trans_begin();
    $this->db->set('jumlah',$jumlah);
    $this->db->where('id',$id);
    $this->db->update('transaksi_detail_spare_part');
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function approvePermintaanBahan($param)
  {
    $this->db->trans_begin();
    $this->db->query("UPDATE transaksi_gudang_bahan a
                      JOIN gudang_bahan b ON a.kd_gd_bahan = b.kd_gd_bahan SET a.status = 'PROGRESS'
                      WHERE a.keterangan_history = 'PEMBELIAN BARANG'
                      AND a.status = 'PENDING'
                      AND b.jenis='$param'");
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function approvePermintaanSparePart()
  {
    $this->db->trans_begin();
      $this->db->set("sts_transaksi","OPEN");
      $this->db->where("sts_transaksi","PENDING");
      $this->db->update("transaksi_detail_spare_part");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }
  public function getRencanaPembelianBarang($param)
  {
    $data = $this->db->query("select a.id, a.kd_gd_bahan, a.nama, a.jumlah_permintaan, a.tgl_permintaan, a.bagian, b.nm_barang, b.warna, b.jenis from transaksi_gudang_bahan a join gudang_bahan b on a.kd_gd_bahan = b.kd_gd_bahan where a.keterangan_history = 'PEMBELIAN BARANG' and a.status = 'PROGRESS' and a.deleted = 'FALSE' and b.jenis='$param'")->result_array();
    return json_encode($data);
  }

  public function getRencanaPembelianBahanPerId($id)
  {
    $data = $this->db->query("select a.id, a.kd_gd_bahan, a.nama, a.jumlah_permintaan, a.tgl_permintaan, a.bagian, b.nm_barang, b.warna from transaksi_gudang_bahan a join gudang_bahan b on a.kd_gd_bahan = b.kd_gd_bahan where a.keterangan_history = 'PEMBELIAN BARANG' and a.status = 'PROGRESS' and a.deleted = 'FALSE' and a.id = '$id' ")->result_array();
    return json_encode($data);
  }

  public function kirimHasilPembelianBahan($data)
  {
    $this->db->trans_begin();
    $this->db->set('jumlah_permintaan',$data['jum_pembelian']);
    $this->db->set('tgl_permintaan',$data['tgl_pembelian']);
    $this->db->set('status','WAITING APPROVE');
    $this->db->where('id',$data['id']);
    $this->db->update('transaksi_gudang_bahan');
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function getBahanBaku()
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where jenis = 'BAHAN BAKU' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function searchBahanBaku($key)
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where concat(nm_barang,' ',warna,' ',status) REGEXP '$key' and jenis = 'BAHAN BAKU' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function getBijiWarna()
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where jenis = 'BIJI WARNA' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function searchBijiWarna($key)
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where concat(nm_barang,' ',warna,' ',status) REGEXP '$key' and jenis = 'BIJI WARNA' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function getMinyak()
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where jenis = 'MINYAK' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function searchMinyak($key)
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where concat(nm_barang) REGEXP '$key' and jenis = 'MINYAK' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function getCatMurni()
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where jenis = 'CAT MURNI' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function searchCatMurni($key)
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where concat(nm_barang,' ',warna,' ',status) REGEXP '$key' and jenis = 'CAT MURNI' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function getCatCampur()
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where jenis = 'CAT CAMPUR' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function searchCatCampur($key)
  {
    $data = $this->db->query("select kd_gd_bahan, nm_barang, warna, status from gudang_bahan where concat(nm_barang,' ',warna,' ',status) REGEXP '$key' and jenis = 'CAT CAMPUR' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function getSparePart()
  {
    $data = $this->db->query("select kd_spare_part, nm_spare_part, ukuran from spare_part where deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function searchSparePart($key)
  {
    $data = $this->db->query("select kd_spare_part, nm_spare_part, ukuran from spare_part where concat(nm_spare_part,' ',ukuran) REGEXP '$key' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }
  public function simpanRencanaPembelianBahan($data)
  {
    $this->db->trans_begin();
    $this->db->insert("transaksi_gudang_bahan",$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function addBahanBaku($data)
  {
    $this->db->trans_begin();
    $this->db->insert("gudang_bahan",$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function deleteStokBahan($id)
  {
    $this->db->trans_begin();

    $this->db->set("deleted","TRUE");
    $this->db->where("kd_gd_bahan",$id);
    $this->db->update("gudang_bahan");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function getDataStokBahanPerId($id)
  {
    $data = $this->db->query("select * from gudang_bahan where kd_gd_bahan = '$id'")->result_array();
    return json_encode($data);
  }

  public function updateStokBahan($data)
  {
    $this->db->trans_begin();

    $this->db->set("nm_barang",$data['nm_barang']);
    $this->db->set("warna",$data['warna']);
    $this->db->set("stok",$data['stok']);
    $this->db->where("kd_gd_bahan",$data['kd_gd_bahan']);
    $this->db->update("gudang_bahan");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }
  public function getLowStockSparePart()
  {
    $this->datatables->select("kd_spare_part, nm_spare_part, stok, stok_aktual, ukuran");
    $this->datatables->from("spare_part");
    $this->datatables->where("stok<stok_aktual*'0.5' and deleted = 'FALSE'");
    $this->db->order_by("nm_spare_part asc");
    return $this->datatables->generate();
  }

  public function simpanRencanaPembelianSparePart($data)
  {
    $this->db->trans_begin();
    $this->db->insert("transaksi_detail_spare_part",$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function checkRencanaPembelianSparePart()
  {
    $data = $this->db->query("select kd_spare_part from transaksi_detail_spare_part where sts_history = 'MASUK' and  sts_transaksi='OPEN' and deleted = 'FALSE'");
    return $data->num_rows();
  }

  public function getListRencanaSparePart()
  {
    $this->datatables->select("a.id, a.kd_spare_part, a.jumlah, a.tgl_transaksi, b.nm_spare_part, b.ukuran");
    $this->datatables->from("transaksi_detail_spare_part a");
    $this->datatables->join("spare_part b","a.kd_spare_part = b.kd_spare_part");
    $this->datatables->where("a.keterangan_history = 'PEMBELIAN SPARE PART' and a.sts_history = 'MASUK' and a.sts_transaksi='OPEN' and a.deleted = 'FALSE' and b.deleted='FALSE'");
    $this->db->order_by("nm_spare_part asc");
    return $this->datatables->generate();
  }

  public function deleteRencanaPembelianSparePart($id)
  {
    $this->db->trans_begin();

    $this->db->set("deleted","TRUE");
    $this->db->where("id",$id);
    $this->db->update("transaksi_detail_spare_part");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function getDataRencanaPembelianSparePartPerId($id)
  {
    $data = $this->db->query("select a.id, a.kd_spare_part, a.tgl_transaksi, a.jumlah, b.nm_spare_part, b.ukuran from transaksi_detail_spare_part a join spare_part b on a.kd_spare_part = b.kd_spare_part where id='$id'")->result_array();
    return json_encode($data);
  }

  public function kirimHasilPembelianSparePart($data)
  {
    $this->db->trans_begin();

    $this->db->set("jumlah",$data['jumlah']);
    $this->db->set("tgl_transaksi",$data['tanggal']);
    $this->db->set("sts_transaksi","PROGRESS");
    $this->db->where("id",$data['id']);
    $this->db->update("transaksi_detail_spare_part");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function generateGudangSparePartCode(){
    $maxCode = $this->db->query("SELECT MAX(RIGHT(kd_spare_part,3)) AS kode FROM spare_part");
    foreach ($maxCode->result() as $arrMaxCode) {
      if($arrMaxCode->kode == NULL){
        $tempCode = "00";
      }
      $tempCode = "00".(intval($arrMaxCode->kode)+1);
      $fixCode = "SPR".date("ymd").substr($tempCode,(strlen($tempCode)-3));
    }
    return $fixCode;
  }

  public function add_SparePart($data)
  {
    $this->db->trans_begin();
    $this->db->insert("spare_part",$data);
    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function deleteSparePart($id)
  {
    $this->db->trans_begin();
    $this->db->set("deleted","TRUE");
    $this->db->where("kd_spare_part",$id);
    $this->db->update("spare_part");

    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function getStokSparePartPerId($id)
  {
    $data = $this->db->query("select kd_spare_part, nm_spare_part, ukuran, kode, stok, stok_aktual from spare_part where kd_spare_part='$id'")->result_array();
    return json_encode($data);
  }

  public function updateStokSparePart($data)
  {
    $this->db->trans_begin();
    $this->db->set("nm_spare_part",$data['nm_spare_part']);
    $this->db->set("ukuran",$data['ukuran']);
    $this->db->set("stok",$data['stok_sekarang']);
    $this->db->set("stok_aktual",$data['stok_awal']);
    $this->db->set("kode",$data['kode']);
    $this->db->where("kd_spare_part",$data['kd_spare_part']);
    $this->db->update("spare_part");

    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function getHistoryBahanBaku($tgl_awal,$tgl_akhir,$kd_bahan)
  {
    $this->datatables->select("id, kd_gd_bahan, jumlah_permintaan, tgl_permintaan, keterangan_history, status_history");
    $this->datatables->from("transaksi_gudang_bahan");
    $this->datatables->where("tgl_permintaan between '$tgl_awal' and '$tgl_akhir' and kd_gd_bahan = '$kd_bahan' and deleted='FALSE' and jumlah_permintaan !='0' and status='FINISH'");
    $this->db->order_by("tgl_permintaan asc");
    return $this->datatables->generate();
  }

  public function getTotalMasukBahanBaku($tgl_awal,$tgl_akhir,$kd_bahan)
  {
    $data = $this->db->query("select sum(jumlah_permintaan) as total from transaksi_gudang_bahan where tgl_permintaan between '$tgl_awal' and '$tgl_akhir' and kd_gd_bahan = '$kd_bahan' and status_history='MASUK' and deleted='FALSE' and status='FINISH'")->result_array();
    return json_encode($data);
  }

  public function getTotalKeluarBahanBaku($tgl_awal,$tgl_akhir,$kd_bahan)
  {
    $data = $this->db->query("select sum(jumlah_permintaan) as total from transaksi_gudang_bahan where tgl_permintaan between '$tgl_awal' and '$tgl_akhir' and kd_gd_bahan = '$kd_bahan' and status_history='KELUAR' and deleted='FALSE' and status='FINISH'")->result_array();
    return json_encode($data);
  }

  public function getHistorySparePart($tgl_awal,$tgl_akhir,$kd_bahan)
  {
    $this->datatables->select("id, kd_spare_part, jumlah, tgl_transaksi, keterangan_history, sts_history");
    $this->datatables->from("transaksi_detail_spare_part");
    $this->datatables->where("tgl_transaksi between '$tgl_awal' and '$tgl_akhir' and kd_spare_part = '$kd_bahan' and deleted='FALSE' and jumlah !='0' and sts_transaksi = 'FINISH'");
    $this->db->order_by("tgl_transaksi asc");
    return $this->datatables->generate();
  }

  public function getHistoryApal($tgl_awal,$tgl_akhir,$kd_apal)
  {
    $this->datatables->select("id, kd_gd_apal, jumlah_apal, tgl_transaksi, keterangan_history, status_history");
    $this->datatables->from("transaksi_detail_history_apal");
    $this->datatables->where("tgl_transaksi between '$tgl_awal' and '$tgl_akhir' and kd_gd_apal = '$kd_apal' and deleted='FALSE' and jumlah_apal !='0' and sts_transaksi = 'FINISH'");
    $this->db->order_by("tgl_transaksi asc");
    return $this->datatables->generate();
  }

  public function getTotalMasukSparePart($tgl_awal,$tgl_akhir,$kd_bahan)
  {
    $data = $this->db->query("select sum(jumlah) as total from transaksi_detail_spare_part where tgl_transaksi between '$tgl_awal' and '$tgl_akhir' and kd_spare_part = '$kd_bahan' and sts_history='MASUK' and deleted='FALSE' and sts_transaksi='FINISH'")->result_array();
    return json_encode($data);
  }

  public function getTotalKeluarSparePart($tgl_awal,$tgl_akhir,$kd_bahan)
  {
    $data = $this->db->query("select sum(jumlah) as total from transaksi_detail_spare_part where tgl_transaksi between '$tgl_awal' and '$tgl_akhir' and kd_spare_part = '$kd_bahan' and sts_history='KELUAR' and deleted='FALSE' and sts_transaksi='FINISH'")->result_array();
    return json_encode($data);
  }

  public function getDataTrashBahanBaku()
  {
    $this->datatables->select("kd_gd_bahan, nm_barang, warna, stok, satuan");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("jenis = 'Bahan Baku' and deleted='TRUE'");
    $this->db->order_by("nm_barang asc");

    return $this->datatables->generate();
  }

  public function getDataTrashBijiWarna()
  {
    $this->datatables->select("kd_gd_bahan, nm_barang, warna, stok, satuan");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("jenis = 'Biji Warna' and deleted='TRUE'");
    $this->db->order_by("nm_barang asc");

    return $this->datatables->generate();
  }

  public function getDataTrashMinyak()
  {
    $this->datatables->select("kd_gd_bahan, nm_barang, warna, stok, satuan");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("jenis = 'Minyak' and deleted='TRUE'");
    $this->db->order_by("nm_barang asc");

    return $this->datatables->generate();
  }

  public function getDataTrashCatMurni()
  {
    $this->datatables->select("kd_gd_bahan, nm_barang, warna, stok, satuan");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("jenis = 'Cat Murni' and deleted='TRUE'");
    $this->db->order_by("nm_barang asc");

    return $this->datatables->generate();
  }

  public function getDataTrashCatCampur()
  {
    $this->datatables->select("kd_gd_bahan, nm_barang, warna, stok, satuan");
    $this->datatables->from("gudang_bahan");
    $this->datatables->where("jenis = 'Cat Campur' and deleted='TRUE'");
    $this->db->order_by("nm_barang asc");

    return $this->datatables->generate();
  }

  public function getDataTrashApal()
  {
    $this->datatables->select("kd_gd_apal, jenis, sub_jenis, stok");
    $this->datatables->from("gudang_apal");
    $this->datatables->where("deleted = 'TRUE'");
    $this->db->order_by("jenis asc");

    return $this->datatables->generate();
  }

  public function getDataTrashSparePart()
  {
    $this->datatables->select("kd_spare_part,kd_accurate,nm_spare_part,kode,ukuran,stok,stok_aktual,tgl_masuk");
    $this->datatables->from("spare_part");
    $this->datatables->where("deleted = 'TRUE'");
    $this->db->order_by("nm_spare_part asc");

    return $this->datatables->generate();
  }

  public function restoreBahan($id)
  {
    $this->db->trans_begin();
    $this->db->set("deleted","FALSE");
    $this->db->where("kd_gd_bahan",$id);
    $this->db->update("gudang_bahan");

    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function restoreApal($id)
  {
    $this->db->trans_begin();
    $this->db->set("deleted","FALSE");
    $this->db->where("kd_gd_apal",$id);
    $this->db->update("gudang_apal");

    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function restoreSparePart($id)
  {
    $this->db->trans_begin();
    $this->db->set("deleted","FALSE");
    $this->db->where("kd_spare_part",$id);
    $this->db->update("spare_part");

    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function deleteStokApal($id)
  {
    $this->db->trans_begin();
    $this->db->set("deleted","TRUE");
    $this->db->where("kd_gd_apal",$id);
    $this->db->update("gudang_apal");

    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function getStokApalPerId($id)
  {
    $data = $this->db->query("select kd_gd_apal, jenis, sub_jenis, stok from gudang_apal where kd_gd_apal = '$id'")->result_array();
    return json_encode($data);
  }

  public function updateStokApal($id,$stok)
  {
    $this->db->trans_begin();
    $this->db->set("stok",$stok);
    $this->db->where("kd_gd_apal",$id);
    $this->db->update("gudang_apal");

    if ($this->db->trans_status===FALSE) {
      $this->db->trans_rollback();
      return "Failed";
    }else{
      $this->db->trans_commit();
      return "Success";
    }
  }

  public function countTrashPurceshing()
  {
    $countGudangBahan = $this->db->query("select kd_gd_bahan from gudang_bahan where deleted = 'TRUE'")->num_rows();
    $countGudangApal  = $this->db->query("select kd_gd_apal from gudang_apal where deleted = 'TRUE'")->num_rows();
    $countSparePart   = $this->db->query("select kd_spare_part from spare_part where deleted='TRUE'")->num_rows();

    $total = $countGudangBahan+$countGudangApal+$countSparePart;
    return $total;
  }

  public function getApal()
  {
    $data = $this->db->query("select kd_gd_apal, jenis, sub_jenis, stok from gudang_apal where deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function searchApal($key)
  {
    $data = $this->db->query("select kd_gd_apal, jenis, sub_jenis, stok from gudang_apal where sub_jenis REGEXP '$key' and deleted = 'FALSE'")->result_array();
    return json_encode($data);
  }

  public function getTotalMasukApal($tgl_awal,$tgl_akhir,$kd_apal)
  {
    $data = $this->db->query("select sum(jumlah_apal) as total from transaksi_detail_history_apal where tgl_transaksi between '$tgl_awal' and '$tgl_akhir' and kd_gd_apal = '$kd_apal' and status_history='MASUK' and deleted='FALSE' and sts_transaksi='FINISH'")->result_array();
    return json_encode($data);
  }

  public function getTotalKeluarApal($tgl_awal,$tgl_akhir,$kd_apal)
  {
    $data = $this->db->query("select sum(jumlah_apal) as total from transaksi_detail_history_apal where tgl_transaksi between '$tgl_awal' and '$tgl_akhir' and kd_gd_apal = '$kd_apal' and status_history='KELUAR' and deleted='FALSE' and sts_transaksi='FINISH'")->result_array();
    return json_encode($data);
  }

  public function checkPermintaanBahan(){
    $data = $this->db->query("SELECT COUNT(kd_permintaan_barang) AS counter
                              FROM transaksi_permintaan_barang
                              WHERE status_permintaan='PENDING'
                              AND deleted='FALSE'")->result_array();
    $data2 = $this->db->query("SELECT COUNT(kd_permintaan_spare_part) AS counter
                              FROM transaksi_permintaan_spare_part
                              WHERE status_permintaan='PENDING'
                              AND deleted='FALSE'")->result_array();
    $result = array("PermintaanBarang" => $data[0]["counter"],
                    "PermintaanSparePart" => $data2[0]["counter"]);
    return json_encode($result);
  }

  public function selectPermintaanBarang(){
    $this->datatables->select("TPB.kd_permintaan_barang, TPB.tgl_permintaan, TPB.status_permintaan, USR.username, GB.jenis");
    $this->datatables->from("transaksi_permintaan_barang TPB");
    $this->datatables->join("users USR","TPB.id_user = USR.id_user","INNER");
    $this->datatables->join("transaksi_detail_permintaan_barang TDPB","TDPB.kd_permintaan_barang = TPB.kd_permintaan_barang","INNER");
    $this->datatables->join("gudang_bahan GB","TDPB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->where("TPB.deleted = 'FALSE' AND TPB.status_permintaan NOT IN ('FINISH')");
    $this->db->order_by("TPB.tgl_permintaan DESC, FIELD(GB.jenis, 'BAHAN BAKU','BIJI WARNA','CAT MURNI'), FIELD(TPB.status_permintaan,'PENDING','PROGRESS')");
    $this->db->group_by("TPB.kd_permintaan_barang");
    return $this->datatables->generate();
  }

  public function selectPermintaanSparePart($param){
    $this->datatables->select("TPB.kd_permintaan_spare_part, TPB.tgl_permintaan, TPB.status_permintaan, USR.username");
    $this->datatables->from("transaksi_permintaan_spare_part TPB");
    $this->datatables->join("users USR","TPB.id_user = USR.id_user","INNER");
    $this->datatables->where("TPB.deleted = 'FALSE' AND
                              TPB.status_permintaan NOT IN ('FINISH')");
    $this->db->order_by("TPB.tgl_permintaan DESC, FIELD(TPB.status_permintaan,'PENDING','PROGRESS')");
    $this->db->group_by("TPB.kd_permintaan_spare_part");
    return $this->datatables->generate();
  }

  public function selectDetailPermintaanBaru($param){
    $this->datatables->select("GB.nm_barang, GB.warna, TDPB.jumlah_permintaan,
                               TDPB.keterangan, TDPB.status_permintaan, TDPB.id_dpb,
                               TDPB.kd_permintaan_barang, TDPB.keterangan_purchasing");
    $this->datatables->from("transaksi_detail_permintaan_barang TDPB");
    $this->datatables->join("gudang_bahan GB","TDPB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->join("transaksi_permintaan_barang TPB","TDPB.kd_permintaan_barang = TPB.kd_permintaan_barang","INNER");
    $this->datatables->where("TPB.kd_permintaan_barang = '$param' AND
                              TDPB.deleted='FALSE' AND
                              GB.deleted='FALSE'");
    return $this->datatables->generate();
  }

  public function selectDetailPermintaanSparePartBaru($param){
    $this->datatables->select("GB.nm_spare_part, GB.ukuran, TDPB.jumlah_permintaan,
                               TDPB.keterangan, TDPB.status_permintaan, TDPB.id_dpsp,
                               TDPB.kd_permintaan_spare_part, TDPB.keterangan_purchasing");
    $this->datatables->from("transaksi_detail_permintaan_spare_part TDPB");
    $this->datatables->join("spare_part GB","TDPB.kd_spare_part = GB.kd_spare_part","INNER");
    $this->datatables->join("transaksi_permintaan_spare_part TPB","TDPB.kd_permintaan_spare_part = TPB.kd_permintaan_spare_part","INNER");
    $this->datatables->where("TPB.kd_permintaan_spare_part = '$param' AND
                              TDPB.deleted='FALSE' AND
                              GB.deleted='FALSE'");
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
    $Q = "SELECT GB.nm_barang, GB.warna, TDPB.jumlah_permintaan,
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

  public function updateBatalkanPermintaanBarang($param){
    $this->db->trans_begin();

    $this->db->set("keterangan_purchasing",$param["keteranganPurchasing"]);
    $this->db->set("status_permintaan","CANCEL");
    $this->db->where("id_dpb",$param["idTransaksi"]);
    $this->db->update("transaksi_detail_permintaan_barang");

    $arrTotalItem = $this->db->query("SELECT COUNT(id_dpb) AS counter
                                      FROM transaksi_detail_permintaan_barang
                                      WHERE kd_permintaan_barang='$param[idPermintaan]'
                                      AND deleted='FALSE'")->result_array();

    $arrTotalItemBatal = $this->db->query("SELECT COUNT(id_dpb) AS counter
                                           FROM transaksi_detail_permintaan_barang
                                           WHERE kd_permintaan_barang='$param[idPermintaan]'
                                           AND deleted='FALSE'
                                           AND keterangan_purchasing IS NOT NULL
                                           AND status_permintaan='CANCEL'")->result_array();

    if($arrTotalItemBatal[0]["counter"] >= $arrTotalItem[0]["counter"]){
      $this->db->set("status_permintaan","CANCEL");
      $this->db->where("kd_permintaan_barang",$param["idPermintaan"]);
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

  public function updateAktifkanPermintaanBarang($param){
    $this->db->trans_begin();

    $this->db->set("keterangan_purchasing",NULL);
    $this->db->set("status_permintaan",$param["statusPermintaan"]);
    $this->db->where("id_dpb",$param["idTransaksi"]);
    $this->db->update("transaksi_detail_permintaan_barang");

    $arrTotalItem = $this->db->query("SELECT COUNT(id_dpb) AS counter
                                      FROM transaksi_detail_permintaan_barang
                                      WHERE kd_permintaan_barang='$param[idPermintaan]'
                                      AND deleted='FALSE'")->result_array();

    $arrTotalItemBatal = $this->db->query("SELECT COUNT(id_dpb) AS counter
                                           FROM transaksi_detail_permintaan_barang
                                           WHERE kd_permintaan_barang='$param[idPermintaan]'
                                           AND deleted='FALSE'
                                           AND keterangan_purchasing IS NOT NULL
                                           AND status_permintaan='CANCEL'")->result_array();

    if($arrTotalItemBatal[0]["counter"] < $arrTotalItem[0]["counter"]){
      $this->db->set("status_permintaan",$param["statusPermintaan"]);
      $this->db->where("kd_permintaan_barang",$param["idPermintaan"]);
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

  public function updateBatalkanPermintaanSparePart($param){
    $this->db->trans_begin();

    $this->db->set("keterangan_purchasing",$param["keteranganPurchasing"]);
    $this->db->set("status_permintaan","CANCEL");
    $this->db->where("id_dpsp",$param["idTransaksi"]);
    $this->db->update("transaksi_detail_permintaan_spare_part");

    $arrTotalItem = $this->db->query("SELECT COUNT(id_dpsp) AS counter
                                      FROM transaksi_detail_permintaan_spare_part
                                      WHERE kd_permintaan_spare_part='$param[idPermintaan]'
                                      AND deleted='FALSE'")->result_array();

    $arrTotalItemBatal = $this->db->query("SELECT COUNT(id_dpsp) AS counter
                                           FROM transaksi_detail_permintaan_spare_part
                                           WHERE kd_permintaan_spare_part='$param[idPermintaan]'
                                           AND deleted='FALSE'
                                           AND keterangan_purchasing IS NOT NULL
                                           AND status_permintaan='CANCEL'")->result_array();

    if($arrTotalItemBatal[0]["counter"] >= $arrTotalItem[0]["counter"]){
      $this->db->set("status_permintaan","CANCEL");
      $this->db->where("kd_permintaan_spare_part",$param["idPermintaan"]);
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

  public function updateAktifkanPermintaanSparePart($param){
    $this->db->trans_begin();

    $this->db->set("keterangan_purchasing",NULL);
    $this->db->set("status_permintaan",$param["statusPermintaan"]);
    $this->db->where("id_dpsp",$param["idTransaksi"]);
    $this->db->update("transaksi_detail_permintaan_spare_part");

    $arrTotalItem = $this->db->query("SELECT COUNT(id_dpsp) AS counter
                                      FROM transaksi_detail_permintaan_spare_part
                                      WHERE kd_permintaan_spare_part='$param[idPermintaan]'
                                      AND deleted='FALSE'")->result_array();

    $arrTotalItemBatal = $this->db->query("SELECT COUNT(id_dpsp) AS counter
                                           FROM transaksi_detail_permintaan_spare_part
                                           WHERE kd_permintaan_spare_part='$param[idPermintaan]'
                                           AND deleted='FALSE'
                                           AND keterangan_purchasing IS NOT NULL
                                           AND status_permintaan='CANCEL'")->result_array();

    if($arrTotalItemBatal[0]["counter"] < $arrTotalItem[0]["counter"]){
      $this->db->set("status_permintaan",$param["statusPermintaan"]);
      $this->db->where("kd_permintaan_spare_part",$param["idPermintaan"]);
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

  public function updateSetujuiPermintaanBarang($param){
    $this->db->trans_begin();
    $this->db->set("status_permintaan","PROGRESS");
    $this->db->set("status_approve","TRUE");
    $this->db->where("kd_permintaan_barang",$param);
    $this->db->where("deleted","FALSE");
    $this->db->update("transaksi_permintaan_barang");

    $this->db->set("status_permintaan","PROGRESS");
    $this->db->where("kd_permintaan_barang",$param);
    $this->db->where("status_permintaan","PENDING");
    $this->db->where("deleted","FALSE");
    $this->db->update("transaksi_detail_permintaan_barang");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function updateSetujuiPermintaanSparePart($param){
    $this->db->trans_begin();
    $this->db->set("status_permintaan","PROGRESS");
    $this->db->set("status_approve","TRUE");
    $this->db->where("kd_permintaan_spare_part",$param);
    $this->db->where("deleted","FALSE");
    $this->db->update("transaksi_permintaan_spare_part");

    $this->db->set("status_permintaan","PROGRESS");
    $this->db->where("kd_permintaan_spare_part",$param);
    $this->db->where("status_permintaan","PENDING");
    $this->db->where("deleted","FALSE");
    $this->db->update("transaksi_detail_permintaan_spare_part");

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "Gagal";
    }else{
      $this->db->trans_commit();
      return "Berhasil";
    }
  }

  public function selectBuktiPenerimaanBarang(){
    $this->datatables->select("TBPB.kd_bpb, TBPB.tgl_terima, TBPB.sts_print,
                               TPB.kd_permintaan_barang,GB.nm_barang,TDPB.jumlah_permintaan,
                               TBPB.jumlah_terima,USR.username,GB.warna,GB.jenis");
    $this->datatables->from("transaksi_bukti_penerimaan_barang TBPB");
    $this->datatables->join("transaksi_detail_permintaan_barang TDPB","TBPB.id_dpb = TDPB.id_dpb","INNER");
    $this->datatables->join("transaksi_permintaan_barang TPB","TDPB.kd_permintaan_barang = TPB.kd_permintaan_barang","INNER");
    $this->datatables->join("users USR","TBPB.id_user = USR.id_user","INNER");
    $this->datatables->join("gudang_bahan GB","TDPB.kd_gd_bahan = GB.kd_gd_bahan","INNER");
    $this->datatables->where("TBPB.deleted = 'FALSE' AND TDPB.deleted='FALSE'
                              AND TPB.deleted='FALSE' AND GB.deleted='FALSE'");
    return $this->datatables->generate();
  }

  public function selectBuktiPenerimaanSparePart(){
    $this->datatables->select("TBPSP.kd_bpsp, TBPSP.tgl_terima, TBPSP.sts_print,
                               TPSP.kd_permintaan_spare_part,SP.nm_spare_part,TDPSP.jumlah_permintaan,
                               TBPSP.jumlah_terima,USR.username,SP.ukuran");
    $this->datatables->from("transaksi_bukti_penerimaan_spare_part TBPSP");
    $this->datatables->join("transaksi_detail_permintaan_spare_part TDPSP","TBPSP.id_dpsp = TDPSP.id_dpsp","INNER");
    $this->datatables->join("transaksi_permintaan_spare_part TPSP","TDPSP.kd_permintaan_spare_part = TPSP.kd_permintaan_spare_part","INNER");
    $this->datatables->join("users USR","TBPSP.id_user = USR.id_user","INNER");
    $this->datatables->join("spare_part SP","TDPSP.kd_spare_part = SP.kd_spare_part","INNER");
    $this->datatables->where("TBPSP.deleted = 'FALSE' AND TDPSP.deleted='FALSE'
                              AND TPSP.deleted='FALSE' AND SP.deleted='FALSE'");
    return $this->datatables->generate();
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

  public function selectDetailBarangBahan($param){
    $result = $this->db->query("SELECT * FROM gudang_bahan WHERE kd_gd_bahan='$param' AND deleted = 'FALSE'");
    return json_encode($result->result_array());
  }

  public function insertPermintaanBarang($param){
    if(array_key_exists("rowid",$param)){
      unset($param["rowid"]);
    }
    $this->db->trans_begin();
    $this->db->set("kd_permintaan_barang",$param["kd_permintaan"]);
    $this->db->set("id_user",$param["id_user"]);
    $this->db->set("tgl_permintaan",$param["tgl_permintaan"]);
    $this->db->set("bagian",$param["bagian"]);
    $this->db->insert("transaksi_permintaan_barang");

    $this->db->set("kd_permintaan_barang",$param["kd_permintaan"]);
    $this->db->set("kd_gd_bahan",$param["kd_gd_bahan"]);
    $this->db->set("jumlah_permintaan",$param["jumlah_permintaan"]);
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

}
