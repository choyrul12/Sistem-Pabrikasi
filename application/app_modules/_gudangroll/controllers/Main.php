<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MX_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model("Gudang_Roll_Model");
  }

  public function index(){
    $isLogin = $this->isLogin();
    if($isLogin){
       $data["Data"] = array("Title"=>"SELAMAT DATANG ".strtoupper($this->session->userdata("fabricationUsername")));
       $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
       $this->load->view("header");
       $this->load->view("sidebar",$this->checkStatus());
       $this->load->view("frm_main",$data);
       $this->load->view("footer");
     }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
     }
  }

  private function isLogin(){
    if(!empty($this->session->userdata("fabricationIdUser"))&&
       !empty($this->session->userdata("fabricationUsername"))&&
       !empty($this->session->userdata("fabricationStatus"))&&
       !empty($this->session->userdata("fabricationGroup"))&&
       !empty($this->session->userdata("fabricationIpAddress"))&&
       ($this->session->userdata("fabricationGroup")=="gudang roll"||
        $this->session->userdata("fabricationGroup")=="it_department"||
        $this->session->userdata("fabricationGroup")=="SYSTEM"||
        $this->session->userdata("fabricationGroup")=="administrator")
     ){
       return TRUE;
     }else{
       return FALSE;
     }
  }

  public function checkStatus(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $status = $this->session->userdata("fabricationStatus");
      if($status==1){
        $listMenu["parentMenu"] = array(
          array("Content"=>"Stok Barang (Polos)","Link"=>"_gudangroll/main/stok_barang_polos","Name"=>"Stok_Barang_Polos","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Stok_Barang_Polos"),
          array("Content"=>"Stok Barang (Cetak)","Link"=>"_gudangroll/main/stok_barang_cetak","Name"=>"Stok_Barang_Cetak","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Stok_Barang_Cetak"),
          #array("Content"=>"Pengambilan Polos Potong","Link"=>"_gudangroll/main/pengambilan_polos_potong","Name"=>"Pengambilan_Polos_Potong","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Pengambilan_Polos_Potong"),
          #array("Content"=>"Pengambilan Cetak Potong","Link"=>"_gudangroll/main/pengambilan_cetak_potong","Name"=>"Pengambilan_Cetak_Potong","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Pengambilan_Cetak_Potong"),
          array("Content"=>"Hasil Job Potong","Link"=>"_gudangroll/main/hasil_job_potong","Name"=>"Hasil_Job_Potong","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Hasil_Job_Potong"),
          array("Content"=>"Cari Hasil Job Potong","Link"=>"_gudangroll/main/cari_hasil_job_potong","Name"=>"Cari_Hasil_Job_Potong","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Cari_Hasil_Job_Potong"),
          array("Content"=>"Cek Kartu Stok","Link"=>"_gudangroll/main/cek_kartu_stok","Name"=>"Cek_Kartu_Stok","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Cek_Kartu_Stok"),
          array("Content"=>"Cetak Kartu Stok","Link"=>"_gudangroll/main/cetak_kartu_stok","Name"=>"Cetak_Kartu_Stok","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Cetak_Kartu_Stok")
        );
        return $listMenu;
      }else if($status==2) {
        $listMenu["parentMenu"] = array();
        return $listMenu;
      }else{

      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_barang_polos(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"STOK BARANG POLOS");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_barang_polos",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_barang_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"STOK BARANG CETAK");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_barang_cetak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pengambilan_polos_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"BARANG YANG DIAMBIL OPERATOR POTONG (POLOS)");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_pengambilan_polos_potong",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pengambilan_cetak_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"BARANG YANG DIAMBIL OPERATOR POTONG (POLOS)");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_pengambilan_polos_potong",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function hasil_job_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"HASIL JOB POTONG");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_hasil_job_potong",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cari_hasil_job_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"CARI HASIL JOB POTONG");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_cari_hasil_job_potong",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cek_kartu_stok(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"CEK KARTU STOK");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_cek_kartu_stok",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cetak_kartu_stok(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"CEK KARTU STOK");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_cetak_kartu_stok",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $result = $this->Gudang_Roll_Model->selectListGudangRoll($jnsPermintaan);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function generateCodeGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      if($jnsPermintaan == "POLOS"){
        $result = array("Code" => $this->Gudang_Roll_Model->generateGudangRollPolosCode());
      }else{
        $result = array("Code" => $this->Gudang_Roll_Model->generateGudangRollCetakCode());
      }
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueGudangRoll($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $Key = $this->input->get("q");
      if(empty($Key)){
        $data = array("JnsPermintaan" => $param);
        $result = $this->Gudang_Roll_Model->selectComboBoxValueGudangRoll($data);
      }else{
        $data = array("JnsPermintaan" => $param,
                      "Key" => $Key);
        $result = $this->Gudang_Roll_Model->selectComboBoxValueGudangRollSearch($data);
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function checkDataAwal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdRoll = $this->input->post("kdGdRoll");
      $result = $this->Gudang_Roll_Model->selectCheckDataAwal($kdGdRoll);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountTrashGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Roll_Model->selectCountTrashGudangRoll();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListTrashGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Roll_Model->selectTrashGudangRoll();
      echo $result;
    }else{
    echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
    redirect("_main/main","refresh");
    }
  }

  public function getListTrashTransaksiGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Roll_Model->selectTrashTransaksiGudangRoll();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdRoll = $this->input->post("kdGdRoll");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $kdAccurate = $this->input->post("kdAccurate");
      $strip = $this->input->post("strip");#
      $jnsPermintaan = $this->input->post("jnsPermintaan");#
      $warnaPlastik = $this->input->post("warnaPlastik");#
      $tebal = $this->input->post("tebal");#
      $ukuran = $this->input->post("ukuran");#
      $stok = $this->input->post("stok");#
      $bobin = $this->input->post("bobin");#
      $payung = $this->input->post("payung");#
      $merek = $this->input->post("merek");#
      $tglBuat = $this->input->post("tglBuat");#
      $jnsBarang = $this->input->post("jnsBarang");#
      $bagian = "GUDANG ROLL";#
      $statusHistory = "MASUK";
      $keteranganHistory = "DATA AWAL";

      if(empty($kdGdRoll)||empty($idUser)||empty($jnsPermintaan)||empty($warnaPlastik)||$tebal==""||empty($ukuran)||
         $stok==""||$bobin==""||$payung==""||empty($merek)||empty($tglBuat)||empty($jnsBarang)||empty($bagian)
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_gd_roll" => $kdGdRoll,
                       "id_user" => $idUser,
                       "kd_accurate" => $kdAccurate,
                       "strip" => $strip,
                       "jns_permintaan" => $jnsPermintaan,
                       "warna_plastik" => $warnaPlastik,
                       "tebal" => $tebal,
                       "ukuran" => str_replace(',','.',$ukuran),
                       "stok" => $stok,
                       "bobin" => $bobin,
                       "payung" => $payung,
                       "merek" => $merek,
                       "tgl_buat" => $tglBuat,
                       "jns_brg" => $jnsBarang,
                       "bagian" => $bagian,
                       "status_history" => $statusHistory,
                       "keterangan_history" => $keteranganHistory,
                       "keterangan_transaksi" => "ADMIN GUDANG ROLL");
         $result = $this->Gudang_Roll_Model->insertGudangRoll($data);
         if($result){
           echo "Berhasil";
         }else{
           echo "Gagal";
         }
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAddDataAwalGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdRoll = $this->input->post("kdGdRoll");#
      $idUser = $this->session->userdata("fabricationIdUser");
      $jnsPermintaan = $this->input->post("jnsPermintaan");#
      $tglTransaksi = $this->input->post("tglTransaksi");#
      $berat = $this->input->post("berat");#
      $bobin = $this->input->post("bobin");#
      $payung = $this->input->post("payung");#
      $bagian = "GUDANG ROLL";
      $keteranganTransaksi = "ADMIN GUDANG ROLL";
      $statusHistory = "MASUK";
      $keteranganHistory = "DATA AWAL";

      if(empty($kdGdRoll)||empty($jnsPermintaan)||empty($tglTransaksi)||
         $berat==""||$bobin==""||$payung==""
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_gd_roll" => $kdGdRoll,
                       "id_user" => $idUser,
                       "jns_permintaan" => $jnsPermintaan,
                       "tgl_transaksi" => $tglTransaksi,
                       "bagian" => $bagian,
                       "keterangan_transaksi" => $keteranganTransaksi,
                       "status_history" => $statusHistory,
                       "keterangan_history" => $keteranganHistory,
                       "berat" => $berat,
                       "bobin" => $bobin,
                       "payung" => $payung,
                       "status_lock" => "TRUE");
         $result = $this->Gudang_Roll_Model->insertTransaksiGudangRoll_DataAwal($data);
         if($result){
           echo "Berhasil";
         }else{
           echo "Gagal";
         }
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListDataAwalTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $result = $this->Gudang_Roll_Model->selectListDataAwalTemp($jnsPermintaan);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGudangRollDetail(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdRoll = $this->input->post("kdGdRoll");
      $result = $this->Gudang_Roll_Model->selectGudangRollDetail($kdGdRoll);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdRoll = $this->input->post("kdGdRoll");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $kdAccurate = $this->input->post("kdAccurate");
      $strip = $this->input->post("strip");#
      $jnsPermintaan = $this->input->post("jnsPermintaan");#
      $warnaPlastik = $this->input->post("warnaPlastik");#
      $tebal = $this->input->post("tebal");#
      $ukuran = $this->input->post("ukuran");#
      $merek = $this->input->post("merek");#
      $tglBuat = $this->input->post("tglBuat");#
      $jnsBarang = $this->input->post("jnsBarang");#

      if(empty($kdGdRoll)||empty($idUser)|| $strip==""||empty($jnsPermintaan)||empty($warnaPlastik)||$tebal==""||empty($ukuran)||
         empty($merek)||empty($tglBuat)||empty($jnsBarang)
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_gd_roll" => $kdGdRoll,
                       "id_user" => $idUser,
                       "kd_accurate" => $kdAccurate,
                       "strip" => $strip,
                       "jns_permintaan" => $jnsPermintaan,
                       "warna_plastik" => $warnaPlastik,
                       "tebal" => $tebal,
                       "ukuran" => $ukuran,
                       "merek" => $merek,
                       "tgl_buat" => $tglBuat,
                       "jns_brg" => $jnsBarang);
         $result = $this->Gudang_Roll_Model->updateGudangRoll($data);
         if($result){
           echo "Berhasil";
         }else{
           echo "Gagal";
         }
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestoreGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdRoll = $this->input->post("kdGdRoll");
      $deleted = $this->input->post("deleted");

      if(empty($kdGdRoll) || empty($deleted)){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_roll" => $kdGdRoll,
                      "deleted" => $deleted);
        $result = $this->Gudang_Roll_Model->updateGudangRoll($data);
        if($result){
          echo "Berhasil";
        }else{
          echo "Gagal";
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestoreListDataAwalTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      if(empty($id) || empty($deleted)){
        echo "Data Kosong";
      }else{
        $data = array("id" => $id,
                      "deleted" => $deleted);
        $result = $this->Gudang_Roll_Model->updateTransaksiGudangRoll($data);
        if($result){
          echo "Berhasil";
        }else{
          echo "Gagal";
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveTambahSelisihBarang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["kd_gd_roll"] = $this->input->post("kdGdRoll");#
      $data["id_user"] = $this->session->userdata("fabricationIdUser");
      $data["jns_permintaan"] = $this->input->post("jnsPermintaan");#
      $data["tgl_transaksi"] = $this->input->post("tglTransaksi");#
      $data["bagian"] = "GUDANG ROLL";
      $jenisSelisih = $this->input->post("jenisSelisih");#
      if($jenisSelisih == "PENAMBAHAN"){
        $data["status_history"] = "MASUK";
        $data["keterangan_history"] = "MASUK KE GUDANG (SELISIH TAMBAH)";
      }else{
        $data["status_history"] = "KELUAR";
        $data["keterangan_history"] = "MASUK KE GUDANG (SELISIH KURANG)";
      }
      $data["berat"] = $this->input->post("berat");#
      $data["bobin"] = $this->input->post("bobin");#
      $data["payung"] = $this->input->post("payung");#
      $data["payung_kuning"] = $this->input->post("payungKuning");#
      $data["keterangan_transaksi"] = $this->input->post("ketarangan");#
      $data["status_transaksi"] = "FINISH";

      if(empty($data["kd_gd_roll"])||empty( $data["jns_permintaan"])||empty($data["tgl_transaksi"])||empty($jenisSelisih)||
         $data["payung"]==""||$data["berat"]==""||$data["bobin"]==""||empty($data["keterangan_transaksi"])
       ){
         echo "Data Kosong";
       }else{
        $result = $this->Gudang_Roll_Model->insertTambahSelisihBarang($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getHasilJob(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $result = $this->Gudang_Roll_Model->selectHasilJob($tanggal);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCariHasilJob(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $jnsBrg = $this->input->post("jnsBrg");
      $kdGdRoll = $this->input->post("kdGdRoll");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "jnsBrg" => $jnsBrg,
                    "kdGdRoll" => $kdGdRoll);

      $result = $this->Gudang_Roll_Model->selectCariHasilJob($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdRoll = $this->input->post("kdGdRoll");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "kdGdRoll" => $kdGdRoll);
      $result = $this->Gudang_Roll_Model->selectListHistoryGudangRoll($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryGudangRollExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdRoll = $this->input->post("kdGdRoll");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "kdGdRoll" => $kdGdRoll);
      $result = $this->Gudang_Roll_Model->selectListHistoryGudangRollExtruder($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryGudangRollPotongCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdRoll = $this->input->post("kdGdRoll");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "kdGdRoll" => $kdGdRoll);
      $result = $this->Gudang_Roll_Model->selectListHistoryGudangRollPotongCetak($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getSaldoGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdRoll = $this->input->post("kdGdRoll");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "kdGdRoll" => $kdGdRoll);
      $result = $this->Gudang_Roll_Model->selectSaldoGudangRoll($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPengembalianPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $result = $this->Gudang_Roll_Model->selectPengembalianPotong($jnsPermintaan);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getSisaPotongHariIni(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $result = $this->Gudang_Roll_Model->selectSisaPotongHariIni($jnsPermintaan);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailPengembalianPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Gudang_Roll_Model->selectDetailPengembalianPotong($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailPengambilanCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Gudang_Roll_Model->selectDetailPengambilanCetak($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editTransaksiPengembalianPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdRollHide = $this->input->post("kdGdRollHide");
      $kdPotongHide = $this->input->post("kdPotongHide");
      $sisaHide = $this->input->post("sisaHide");
      $bobinHide = $this->input->post("bobinHide");
      $payungHide = $this->input->post("payungHide");
      $payungKuningHide = $this->input->post("payungKuningHide");
      $tglSisaHide = $this->input->post("tglSisaHide");
      $tglPotongHide = $this->input->post("tglPotongHide");
      $ukuranHide = $this->input->post("ukuranHide");
      $jnsPermintaanHide = $this->input->post("jnsPermintaanHide");
      $merekHide = $this->input->post("merekHide");
      $warnaPlastikHide = $this->input->post("warnaPlastikHide");
      $idTransaksi = $this->input->post("idTransaksi");
      $kdGdRoll = $this->input->post("kdGdRoll");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $sisa = $this->input->post("sisa");
      $bobin = $this->input->post("bobin");
      $payung = $this->input->post("payung");
      $payungKuning = $this->input->post("payungKuning");
      $keterangan = $this->input->post("keterangan");
      $ukuran = $this->input->post("ukuran");
      $panjang = $this->input->post("panjang");
      $merek = $this->input->post("merek");
      $warnaPlastik = $this->input->post("warnaPlastik");

      if(empty($idTransaksi) || empty($jnsPermintaan) || $sisa=="" ||
         $bobin=="" || $payung=="" || $payungKuning=="" || empty($keterangan)
       ){
         echo "Data Kosong";
       }else{
         if(empty($kdGdRoll)){
          $data["TBPR"] = array("id"              => $idTransaksi,
                                "sisa"            => $sisa,
                                "bobin"           => $bobin,
                                "payung"          => $payung,
                                "payung_kuning"   => $payungKuning);

          $data["TDPP"] = array("kdGdRollHide"       => $kdGdRollHide,
                                "kdPotongHide"       => $kdPotongHide,
                                "ukuranHide"         => $ukuranHide,
                                "merekHide"          => $merekHide,
                                "warnaPlastikHide"   => $warnaPlastikHide,
                                "jnsPermintaanHide"  => $jnsPermintaanHide,
                                "tglSisaHide"        => $tglSisaHide,
                                "tglPotongHide"      => $tglPotongHide,
                                "status"             => ($keterangan=="POTONG BESOK" ? "KEMBALI KE GUDANG(SISA SEMALAM)" : "KEMBALI KE GUDANG(SISA MESIN)"),
                                "sisaHide"           => $sisaHide,
                                "bobinHide"          => $bobinHide,
                                "payungHide"         => $payungHide,
                                "payungKuningHide"   => $payungKuningHide,
                                "sisa"               => $sisa,
                                "bobin"              => $bobin,
                                "payung"             => $payung,
                                "payungKuning"       => $payungKuning);

          if($keterangan=="POTONG BESOK"){
            $data["TGR_IN"] = array("kdGdRollHide"           => $kdGdRollHide,
                                    "jnsPermintaanHide"      => $jnsPermintaanHide,
                                    "tglSisaHide"            => $tglSisaHide,
                                    "bagian"                 => "POTONG",
                                    "keterangan_transaksi"   => "MASUK DARI POTONG",
                                    "status_history"         => "MASUK",
                                    "keterangan_history"     => "OPERATOR(SISA SEMALAM)",
                                    "sisaHide"               => $sisaHide,
                                    "bobinHide"              => $bobinHide,
                                    "payungHide"             => $payungHide,
                                    "payungKuningHide"       => $payungKuningHide,
                                    "sisa"                   => $sisa,
                                    "bobin"                  => $bobin,
                                    "payung"                 => $payung,
                                    "payungKuning"           => $payungKuning);

            $data["TGR_OUT"] = array("kdGdRollHide"           => $kdGdRollHide,
                                     "jnsPermintaanHide"      => $jnsPermintaanHide,
                                     "tglSisaHide"            => $tglPotongHide,
                                     "bagian"                 => "POTONG",
                                     "keterangan_transaksi"   => "KELUAR KE POTONG",
                                     "status_history"         => "KELUAR",
                                     "keterangan_history"     => "OPERATOR(SISA SEMALAM)",
                                     "sisaHide"               => $sisaHide,
                                     "bobinHide"              => $bobinHide,
                                     "payungHide"             => $payungHide,
                                     "payungKuningHide"       => $payungKuningHide,
                                     "sisa"                   => $sisa,
                                     "bobin"                  => $bobin,
                                     "payung"                 => $payung,
                                     "payungKuning"           => $payungKuning);
          }else{
            $data["TGR_IN"] = array("kdGdRollHide"           => $kdGdRollHide,
                                    "jnsPermintaanHide"      => $jnsPermintaanHide,
                                    "tglSisaHide"            => $tglPotongHide,
                                    "bagian"                 => "POTONG",
                                    "keterangan_transaksi"   => "MASUK DARI POTONG",
                                    "status_history"         => "MASUK",
                                    "keterangan_history"     => "OPERATOR(SISA MESIN)",
                                    "sisaHide"               => $sisaHide,
                                    "bobinHide"              => $bobinHide,
                                    "payungHide"             => $payungHide,
                                    "payungKuningHide"       => $payungKuningHide,
                                    "sisa"                   => $sisa,
                                    "bobin"                  => $bobin,
                                    "payung"                 => $payung,
                                    "payungKuning"           => $payungKuning);
          }
         }else{
           $data["TBPR"] = array("id"              => $idTransaksi,
                                 "kd_gd_roll"      => $kdGdRoll,
                                 "sisa"            => $sisa,
                                 "bobin"           => $bobin,
                                 "payung"          => $payung,
                                 "payung_kuning"   => $payungKuning);

           $data["TDPP"] = array("kdGdRollHide"       => $kdGdRollHide,
                                 "kdPotongHide"       => $kdPotongHide,
                                 "ukuranHide"         => $ukuranHide,
                                 "merekHide"          => $merekHide,
                                 "warnaPlastikHide"   => $warnaPlastikHide,
                                 "jnsPermintaanHide"  => $jnsPermintaanHide,
                                 "tglSisaHide"        => $tglSisaHide,
                                 "tglPotongHide"      => $tglPotongHide,
                                 "status"             => ($keterangan=="POTONG BESOK" ? "KEMBALI KE GUDANG(SISA SEMALAM)" : "KEMBALI KE GUDANG(SISA MESIN)"),
                                 "sisaHide"           => $sisaHide,
                                 "bobinHide"          => $bobinHide,
                                 "payungHide"         => $payungHide,
                                 "payungKuningHide"   => $payungKuningHide,
                                 "kdGdRoll"           => $kdGdRoll,
                                 "ukuran"             => $ukuran,
                                 "panjang"            => $panjang,
                                 "merek"              => $merek,
                                 "warnaPlastik"       => $warnaPlastik,
                                 "jnsPermintaan"      => $jnsPermintaan,
                                 "sisa"               => $sisa,
                                 "bobin"              => $bobin,
                                 "payung"             => $payung,
                                 "payungKuning"       => $payungKuning);

           if($keterangan=="POTONG BESOK"){
             $data["TGR_IN"] = array("kdGdRollHide"           => $kdGdRollHide,
                                     "jnsPermintaanHide"      => $jnsPermintaanHide,
                                     "tglSisaHide"            => $tglSisaHide,
                                     "bagian"                 => "POTONG",
                                     "keterangan_transaksi"   => "MASUK DARI POTONG",
                                     "status_history"         => "MASUK",
                                     "keterangan_history"     => "OPERATOR(SISA SEMALAM)",
                                     "sisaHide"               => $sisaHide,
                                     "bobinHide"              => $bobinHide,
                                     "payungHide"             => $payungHide,
                                     "payungKuningHide"       => $payungKuningHide,
                                     "kdGdRoll"               => $kdGdRoll,
                                     "sisa"                   => $sisa,
                                     "bobin"                  => $bobin,
                                     "payung"                 => $payung,
                                     "payungKuning"           => $payungKuning);

             $data["TGR_OUT"] = array("kdGdRollHide"           => $kdGdRollHide,
                                      "jnsPermintaanHide"      => $jnsPermintaanHide,
                                      "tglSisaHide"            => $tglPotongHide,
                                      "bagian"                 => "POTONG",
                                      "keterangan_transaksi"   => "KELUAR KE POTONG",
                                      "status_history"         => "KELUAR",
                                      "keterangan_history"     => "OPERATOR(SISA SEMALAM)",
                                      "sisaHide"               => $sisaHide,
                                      "bobinHide"              => $bobinHide,
                                      "payungHide"             => $payungHide,
                                      "payungKuningHide"       => $payungKuningHide,
                                      "kdGdRoll"               => $kdGdRoll,
                                      "sisa"                   => $sisa,
                                      "bobin"                  => $bobin,
                                      "payung"                 => $payung,
                                      "payungKuning"           => $payungKuning);
           }else{
             $data["TGR_IN"] = array("kdGdRollHide"           => $kdGdRollHide,
                                     "jnsPermintaanHide"      => $jnsPermintaanHide,
                                     "tglSisaHide"            => $tglPotongHide,
                                     "bagian"                 => "POTONG",
                                     "keterangan_transaksi"   => "MASUK DARI POTONG",
                                     "status_history"         => "MASUK",
                                     "keterangan_history"     => "OPERATOR(SISA MESIN)",
                                     "sisaHide"               => $sisaHide,
                                     "bobinHide"              => $bobinHide,
                                     "payungHide"             => $payungHide,
                                     "payungKuningHide"       => $payungKuningHide,
                                     "kdGdRoll"               => $kdGdRoll,
                                     "sisa"                   => $sisa,
                                     "bobin"                  => $bobin,
                                     "payung"                 => $payung,
                                     "payungKuning"           => $payungKuning);
           }
         }
       }
       $result = $this->Gudang_Roll_Model->updateTransaksiPengembalianPotong($data);
       echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestorePengembalianPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      if(empty($idTransaksi) || empty($deleted)){
        echo "Data Kosong";
      }else{
        $data = array("id" => $idTransaksi,
                      "deleted" => $deleted);
        $result = $this->Gudang_Roll_Model->updateDeleteAndRestorePengembalianPotong($data);
        if($result){
          echo "Berhasil";
        }else{
          echo "Gagal";
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveApprovePengembalianPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $result = $this->Gudang_Roll_Model->updateApprovePengembalianPotong($jnsPermintaan);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPengambilanCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $result = $this->Gudang_Roll_Model->selectPengambilanCetak($jnsPermintaan);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getHasilExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Roll_Model->selectHasilExtruder();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveApproveHasilExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Roll_Model->updateApproveHasilExtruder();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveApprovePengambilanCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Roll_Model->updatePengambilanCetak();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getHasilCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Roll_Model->selectHasilCetak();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveApproveHasilCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Roll_Model->updateApproveHasilCetak();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDataInputHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $panjangPlastik = $this->input->post("panjangPlastik");
      $warnaPlastik = $this->input->post("warnaPlastik");
      $kdGdRoll = $this->input->post("kdGdRoll");
      $tglRencana = $this->input->post("tglRencana");

      $data = array("panjangPlastik" => $panjangPlastik,
                    "warnaPlastik" => $warnaPlastik,
                    "kdGdRoll" => $kdGdRoll,
                    "tglRencana" => $tglRencana);
      $result = $this->Gudang_Roll_Model->selectDataRencanaForInputHasil($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function countPermintaanRoll(){
    $jenis  = $this->input->post("jenis");
    $result = $this->Gudang_Roll_Model->countPermintaanRoll($jenis);
    echo $result;
  }

  public function countHasilCetak(){
    $result = $this->Gudang_Roll_Model->countHasilCetak();
    echo $result;
  }

  public function countHasilExtruder(){
    $result = $this->Gudang_Roll_Model->countHasilExtruder();
    echo $result;
  }

  public function deleteAndRestoreRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      $idUser = $this->session->userdata("fabricationIdUser");

      $data = array("idTransaksi" => $idTransaksi,
                    "deleted" => $deleted,
                    "idUser" => $idUser);
      $result = $this->Gudang_Roll_Model->updateDeleteAndRestoreRoll($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailTransaksiGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Gudang_Roll_Model->selectDetailTransaksiGudangRoll($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editTransaksiGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tanggal = $this->input->post("tanggal");

      $data = array("id" => $id,
                    "id_user" => $idUser,
                    "tgl_transaksi" => $tanggal);
      $result = $this->Gudang_Roll_Model->updateTransaksiGudangRoll($data);
      if($result){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDataKartuStok(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $jnsPermintaan = $this->input->post("jnsPermintaan");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "jnsPermintaan" => $jnsPermintaan);
      $result = $this->Gudang_Roll_Model->selectDataKartuStok($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDataKartuStokSort(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $stokMaster = $this->input->post("stokMaster");
      $stokAwal = $this->input->post("stokAwal");
      $stokAkhir = $this->input->post("stokAkhir");

      $data = array("tglAwal"           => $tglAwal,
                    "tglAkhir"          => $tglAkhir,
                    "jnsPermintaan"     => $jnsPermintaan,
                    "havingStokMaster"  => $stokMaster,
                    "havingStokAwal"    => $stokAwal,
                    "havingStokAkhir"   => $stokAkhir);
      $result = $this->Gudang_Roll_Model->selectDataKartuStokSort($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCetakKartuStok(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdRoll = $this->input->post("kdGdRoll");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "kdGdRoll" => $kdGdRoll);
      $result = $this->Gudang_Roll_Model->selectCetakKartuStok($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
}
?>
