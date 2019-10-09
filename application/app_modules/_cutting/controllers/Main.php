<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
		parent::__construct();
		$this->load->model("Cutting_Model");
	}

  public function index(){
    $isLogin = $this->isLogin();
    if($isLogin){
       $data["Data"] = array("Title"=>"SELAMAT DATANG ".strtoupper($this->session->userdata("fabricationUsername")));
       $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
       $this->load->view("header");
       $this->load->view("sidebar",$this->checkStatus());
       $this->load->view("frm_data_rencana_ppic",$data);
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
       ($this->session->userdata("fabricationGroup")=="cutting"||
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
          array("Content"=>"Data Rencana PPIC","Link"=>"_cutting/main","Name"=>"Data_Rencana_PPIC","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Data_Rencana_PPIC"),
          array("Content"=>"Data Rencana Mandor","Link"=>"_cutting/main/data_rencana_mandor","Name"=>"Data_Rencana_Mandor","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Data_Rencana_Mandor"),
          array("Content"=>"Laporan Rencana PPIC","Link"=>"_cutting/main/laporan_rencana_ppic","Name"=>"Laporan_Rencana_PPIC","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Laporan_Rencana_PPIC"),
          array("Content"=>"Hasil Cutting","Link"=>"_cutting/main/hasil_cutting","Name"=>"Hasil_cutting","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Hasil_Cutting"),
          array("Content"=>"History PPIC (Extruder)","Link"=>"_cutting/main/history_ppic_extruder","Name"=>"History_PPIC_Extruder","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_History_PPIC_Extruder"),
          array("Content"=>"Bon Hasil Jadi","Link"=>"_cutting/main/bon_hasil_jadi","Name"=>"Bon_Hasil_Jadi","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Bon_Hasil_Jadi"),
          array("Content"=>"Bon Hasil Jadi (Global)","Link"=>"_cutting/main/bon_hasil_jadi_global","Name"=>"Bon_Hasil_Jadi_Global","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Bon_Hasil_Jadi_Global"),
          array("Content"=>"Pengambilan Potong (Extruder)","Link"=>"_cutting/main/pengambilan_potong_extruder","Name"=>"Pengambilan_Potong_Extruder","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Pengambilan_Potong_Extruder"),
          array("Content"=>"Pengambilan Potong (Cetak)","Link"=>"_cutting/main/pengambilan_potong_cetak","Name"=>"Pengambilan_Potong_Cetak","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Pengambilan_Potong_Cetak"),
          array("Content"=>"History Sisa","Link"=>"_cutting/main/history_sisa","Name"=>"History_Sisa","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_History_Sisa"),
          // array("Content"=>"Pengembalian Operator","Link"=>"_cutting/main/pengembalian_operator","Name"=>"Pengembalian_Operator","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Pengembalian_Operator"),
          array("Content"=>"Laporan Hasil Potong","Link"=>"_cutting/main/laporan_hasil_potong","Name"=>"Laporan_Hasil_Potong","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Laporan_Hasil_Potong"),
          array("Content"=>"Laporan Bon Apal","Link"=>"_cutting/main/laporan_bon_apal","Name"=>"Laporan_Bon_Apal","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Laporan_Bon_Apal")
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

  public function data_rencana_mandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"List Rencana Kerja Mandor");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_data_rencana_mandor",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function laporan_rencana_ppic(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Laporan Rencana PPIC");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_laporan_rencana_ppic",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function hasil_cutting(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Hasil Cutting");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_hasil_cutting",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function history_ppic_extruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"History PPIC Extruder");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_history_ppic_extruder",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bon_hasil_jadi(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Bon Hasil Jadi");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_bon_hasil_jadi",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bon_hasil_jadi_global(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Bon Hasil Jadi Global");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_bon_hasil_jadi_global",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pengambilan_potong_extruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pengambilan Potong Extruder");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_pengambilan_potong_extruder",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pengambilan_potong_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pengambilan Potong Cetak");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_pengambilan_potong_cetak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function history_sisa(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"History Sisa");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_history_sisa",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pengembalian_operator(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pengembalian Operator");
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

  public function laporan_hasil_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Laporan Hasil Potong");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_laporan_hasil_cutting",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function laporan_bon_apal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Laporan Bon Apal");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_laporan_bon_apal",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function input_hasil($param,$param2,$param3,$param4){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Input Hasil");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_input_hasil",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGeneratePotongCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Code"] = $this->Cutting_Model->generatePotongCode();
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueGudangRoll($param,$param2,$param3,$param4){
    $isLogin = $this->isLogin();
    if($isLogin){
      $Key = $this->input->get("q");
      if(empty($Key)){
        $data = array("JnsPermintaan" => $param,
                      "panjangPlastik" => $param2,
                      "merek" => str_replace("_"," ",$param3),
                      "warnaPlastik" => $param4);
        $result = $this->Cutting_Model->selectComboBoxValueGudangRoll($data);
      }else{
        $data = array("JnsPermintaan" => $param,
                      "panjangPlastik" => $param2,
                      "Key" => $Key);
        $result = $this->Cutting_Model->selectComboBoxValueGudangRollSearch($data);
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $Key = $this->input->get("q");
      if(empty($Key)){
        $result = $this->Cutting_Model->selectComboBoxValueGudangHasil();
      }else{
        $result = $this->Cutting_Model->selectComboBoxValueGudangHasilSearch($Key);
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListRencanaPpicPotongDatatables(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      // $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Cutting_Model->selectRencanaPpicPotong($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailRencanaPPIC(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kdPpic");
      $result = $this->Cutting_Model->selectDetailRencanaPPIC($kdPpic);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getRencanaPotongPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cutting_Model->selectRencanaPotongPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveTambahRencanaPotongPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $kdPpic = $this->input->post("kdPpic");
      $kdGdHasil = $this->input->post("kdGdHasil");
      $kdGdRoll = $this->input->post("kdGdRoll");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tglRencana = $this->input->post("tglRencana");
      $customer = $this->input->post("customer");
      $ukuran = $this->input->post("ukuran");
      $warnaPlastik = $this->input->post("warnaPlastik");
      $strip = $this->input->post("strip");
      $tebal = $this->input->post("tebal");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $jmlPermintaan = $this->input->post("jmlPermintaan");
      $stokPermintaan = $this->input->post("stokPermintaan");
      $satuan = $this->input->post("satuan");
      $merek = $this->input->post("merek");
      $noMesin = $this->input->post("noMesin");
      $jmlMesin = $this->input->post("jmlMesin");
      $shift = $this->input->post("shift");
      $berat = $this->input->post("berat");
      $ketMerek = $this->input->post("ketMerek");
      $ketBarang = $this->input->post("ketBarang");

      if(empty($kdPotong) || empty($kdPpic) || empty($kdGdHasil) || empty($kdGdRoll) ||
         empty($idUser) || empty($tglRencana) || empty($customer) || empty($ukuran) ||
         empty($warnaPlastik) || empty($strip) || $tebal=="" || empty($jnsPermintaan) ||
         $jmlPermintaan=="" || $stokPermintaan=="" || empty($satuan) || empty($merek) ||
         empty($noMesin) || empty($jmlMesin) || empty($shift) || $berat==""){
        echo "Data Kosong";
      }else{
        $data = array("kd_potong"         => $kdPotong,
                      "kd_ppic"           => $kdPpic,
                      "kd_gd_hasil"       => $kdGdHasil,
                      "kd_gd_roll"        => $kdGdRoll,
                      "id_user"           => $idUser,
                      "tgl_rencana"       => $tglRencana,
                      "customer"          => $customer,
                      "ukuran"            => $ukuran,
                      "warna_plastik"     => $warnaPlastik,
                      "strip"             => strtoupper($strip),
                      "tebal"             => $tebal,
                      "jns_permintaan"    => $jnsPermintaan,
                      "jml_permintaan"    => ($satuan == "BAL" ? $stokPermintaan : $jmlPermintaan),
                      "stok_permintaan"   => $stokPermintaan,
                      "satuan"            => $satuan,
                      "merek"             => $merek,
                      "no_mesin"          => $noMesin,
                      "jml_mesin"         => $jmlMesin,
                      "shift"             => $shift,
                      "berat"             => $berat,
                      "ket_merek"         => $ketMerek,
                      "ket_barang"        => $ketBarang);
        $booleanResult = $this->Cutting_Model->insertRencanaPotongPending($data);
        if($booleanResult){
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

  public function deleteAndRestoreRencanaPotongPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $deleted = $this->input->post("deleted");

      $data = array("kd_potong" => $kdPotong,
                    "deleted" => $deleted);
      $booleanResult = $this->Cutting_Model->updateRencanaPotong($data);
      if($booleanResult){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailRencanaPotongPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $result = $this->Cutting_Model->selectDetailRencanaPotongPending($kdPotong);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editRencanaPotongPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $kdGdRoll = $this->input->post("kdGdRoll");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tglRencana = $this->input->post("tglRencana");
      $customer = $this->input->post("customer");
      $ukuran = $this->input->post("ukuran");
      $strip = $this->input->post("strip");
      $tebal = $this->input->post("tebal");
      $stokPermintaan = $this->input->post("stokPermintaan");
      $noMesin = $this->input->post("noMesin");
      $jmlMesin = $this->input->post("jmlMesin");
      $shift = $this->input->post("shift");
      $ketBarang = $this->input->post("ketBarang");

      if(empty($kdPotong) || empty($idUser) || empty($tglRencana) || empty($customer) ||
         empty($ukuran) || empty($strip) || $tebal=="" || $stokPermintaan=="" ||
         empty($noMesin) || empty($jmlMesin) || empty($shift)){
        echo "Data Kosong";
      }else{
        if(empty($kdGdRoll)){
          $data = array("kd_potong"         => $kdPotong,
                        "id_user"           => $idUser,
                        "tgl_rencana"       => $tglRencana,
                        "customer"          => $customer,
                        "ukuran"            => $ukuran,
                        "strip"             => $strip,
                        "tebal"             => $tebal,
                        "stok_permintaan"   => $stokPermintaan,
                        "merek"             => $merek,
                        "no_mesin"          => $noMesin,
                        "jml_mesin"         => $jmlMesin,
                        "shift"             => $shift,
                        "ket_barang"        => $ketBarang);
        }else{
          $data = array("kd_potong"         => $kdPotong,
                        "kd_gd_roll"        => $kdGdRoll,
                        "id_user"           => $idUser,
                        "tgl_rencana"       => $tglRencana,
                        "customer"          => $customer,
                        "ukuran"            => $ukuran,
                        "strip"             => $strip,
                        "tebal"             => $tebal,
                        "stok_permintaan"   => $stokPermintaan,
                        "merek"             => $merek,
                        "no_mesin"          => $noMesin,
                        "jml_mesin"         => $jmlMesin,
                        "shift"             => $shift,
                        "ket_barang"        => $ketBarang);
        }
        $booleanResult = $this->Cutting_Model->updateRencanaPotong($data);
        if($booleanResult){
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

  public function saveRencanaPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cutting_Model->updateSaveRencanaPotong();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getKeteranganMandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kdPpic");
      $result = $this->Cutting_Model->selectKeteranganMandor($kdPpic);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editKeteranganMandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kdPpic");
      $ketMandor = $this->input->post("ketMandor");
      if(empty($ketMandor)){
        echo "Data Kosong";
      }else{
        $data = array("kd_ppic" => $kdPpic,
                      "ket_mandor" => $ketMandor);
        $booleanResult = $this->Cutting_Model->updateRencanaPpic($data);
        if($booleanResult){
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

  public function editStatusPengerjaan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kdPpic");
      $stsPengerjaan = $this->input->post("stsPengerjaan");

      if(empty($stsPengerjaan)){
        echo "Data Kosong";
      }else{
        $data = array("kd_ppic" => $kdPpic,
                      "sts_pengerjaan" => $stsPengerjaan);
        $booleanResult = $this->Cutting_Model->updateRencanaPpic($data);
        if($booleanResult){
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

  public function getMesinRencanaPpic(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kdPpic");
      $result = $this->Cutting_Model->selectMesinRencanaPpic($kdPpic);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editMesinRencanaPpic(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kdPpic");
      $noMesin = $this->input->post("noMesin");

      if(empty($noMesin)){
        echo "Data Kosong";
      }else{
        $data = array("kd_ppic" => $kdPpic,
                      "no_mesin" => $noMesin);
        $booleanResult = $this->Cutting_Model->updateMesin($data);
        if($booleanResult){
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

  public function getRencanaMandorPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglRencana = $this->input->post("tglRencana");
      $result = $this->Cutting_Model->selectRencanaMandorPotong($tglRencana);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printRencanaMandorPotong($kd_roll, $tglRencana){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("kd_gd_roll"=>$kd_roll,
                    "tglRencana" => $tglRencana);
      $result["Data"] = $this->Cutting_Model->selectprintRencanaMandorPotong($data);
      // $css = "assets/bootstrap/css/bootstrap.min.css";
      // $page = $this->load->view("frm_print_rencana_job_potong",$result,true);
      // $this->load->library('m_pdf');
      // $this->mpdf->mPDF("utf-8","A5-L",0,"",5,5,8,8,5,3);
      // $this->mpdf->setFooter("Page ".'{PAGENO}');
      // $this->mpdf->WriteHTML(file_get_contents($css),1);
      // $this->mpdf->WriteHTML($page);
      // // $this->mpdf->SetJS("print(); close();");
      // $this->mpdf->Output();
      $this->load->view("frm_print_rencana_job_potong",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editMerekRencana(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $kdPpic = $this->input->post("kdPpic");
      $kdGdHasil = $this->input->post("kdGdHasil");
      $idUser = $this->session->userdata("fabricationIdUser");
      $ukuran = $this->input->post("ukuran");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $merek = $this->input->post("merek");
      $warnaPlastik = $this->input->post("warnaPlastik");
      if(empty($kdPotong) || empty($kdGdHasil) || empty($idUser) ||
         empty($ukuran) || empty($jnsPermintaan) || empty($merek) ||
         empty($warnaPlastik)){
        echo "Data Kosong";
      }else{
        $data = array("kd_potong" => $kdPotong,
                      "kd_ppic" => $kdPpic,
                      "kd_gd_hasil" => $kdGdHasil,
                      "id_user" => $idUser,
                      "ukuran" => $ukuran,
                      "jns_permintaan" => $jnsPermintaan,
                      "merek" => $merek,
                      "warna_plastik" => $warnaPlastik);
        $booleanResult = $this->Cutting_Model->updateEditMerekRencana($data);
        if($booleanResult){
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

  public function getTanggalRencanaMandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $result = $this->Cutting_Model->selectTanggalRencanaMandor($kdPotong);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editTanggalRencanaMandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tglRencana = $this->input->post("tglRencana");

      if(empty($tglRencana) || empty($kdPotong) || empty($idUser)){
        echo "Data Kosong";
      }else{
        $data = array("kd_potong" => $kdPotong,
                      "id_user" => $idUser,
                      "tgl_rencana" => $tglRencana);

        $booleanResult = $this->Cutting_Model->updateTanggalRencana($data);
        if($booleanResult){
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

  public function deleteAndRestoreRencanaMandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $deleted = $this->input->post("deleted");
      $data = array("kd_potong" => $kdPotong,
                    "deleted" => $deleted);
      $booleanResult = $this->Cutting_Model->updateRencanaPotong($data);
      if($booleanResult){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getMesinRencanaMandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $result = $this->Cutting_Model->selectMesinRencanaMandor($kdPotong);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editGantiMesinMandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $kdPpic = $this->input->post("kdPpic");
      $idUser = $this->session->userdata("fabricationIdUser");
      $noMesin = $this->input->post("noMesin");
      if(empty($kdPotong) || empty($idUser) || empty($noMesin)){
        echo "Data Kosong";
      }else{
        $data = array("kd_potong" => $kdPotong,
                      "kd_ppic" => $kdPpic,
                      "id_user" => $idUser,
                      "no_mesin" => $noMesin);
        $booleanResult = $this->Cutting_Model->updateGantiMesinMandor($data);
        if($booleanResult){
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

  public function saveTambahRencanaPotongSusulanPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $kdGdHasil = $this->input->post("kdGdHasil");
      $kdGdRoll = $this->input->post("kdGdRoll");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tglRencana = $this->input->post("tglRencana");
      $customer = $this->input->post("customer");
      $ukuran = $this->input->post("ukuran");
      $warnaPlastik = $this->input->post("warnaPlastik");
      $strip = $this->input->post("strip");
      $tebal = $this->input->post("tebal");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $jmlPermintaan = $this->input->post("jmlPermintaan");
      $stokPermintaan = $this->input->post("stokPermintaan");
      $satuan = $this->input->post("satuan");
      $merek = $this->input->post("merek");
      $noMesin = $this->input->post("noMesin");
      $jmlMesin = $this->input->post("jmlMesin");
      $shift = $this->input->post("shift");
      $berat = $this->input->post("berat");
      $ketMerek = $this->input->post("ketMerek");
      $ketBarang = $this->input->post("ketBarang");

      if(empty($kdPotong) || empty($kdGdHasil) || empty($kdGdRoll) ||
         empty($idUser) || empty($tglRencana) || empty($customer) || empty($ukuran) ||
         empty($warnaPlastik) || empty($strip) || $tebal=="" || empty($jnsPermintaan) ||
         $jmlPermintaan=="" || $stokPermintaan=="" || empty($satuan) || empty($merek) ||
         empty($noMesin) || empty($jmlMesin) || empty($shift)){
        echo "Data Kosong";
      }else{
        $data = array("kd_potong"         => $kdPotong,
                      "kd_gd_hasil"       => $kdGdHasil,
                      "kd_gd_roll"        => $kdGdRoll,
                      "id_user"           => $idUser,
                      "tgl_rencana"       => $tglRencana,
                      "customer"          => $customer,
                      "ukuran"            => $ukuran,
                      "warna_plastik"     => $warnaPlastik,
                      "strip"             => strtoupper($strip),
                      "tebal"             => $tebal,
                      "jns_permintaan"    => $jnsPermintaan,
                      "jml_permintaan"    => $jmlPermintaan,
                      "stok_permintaan"   => $stokPermintaan,
                      "satuan"            => $satuan,
                      "merek"             => $merek,
                      "no_mesin"          => $noMesin,
                      "jml_mesin"         => $jmlMesin,
                      "shift"             => $shift,
                      "berat"             => $berat,
                      "ket_merek"         => $ketMerek,
                      "ket_barang"        => $ketBarang);
        $booleanResult = $this->Cutting_Model->insertRencanaPotong($data);
        if($booleanResult){
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

  public function getRencanaMandorPotongSusulanPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cutting_Model->selectRencanaMandorPotongSusulanPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editRencanaPotongSusulanPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $tglRencana = $this->input->post("tglRencana");
      $noMesin = $this->input->post("noMesin");
      $jmlMesin = $this->input->post("jmlMesin");
      $customer = $this->input->post("customer");
      $kdGdHasil = $this->input->post("kdGdHasil");
      $ketMerek = $this->input->post("ketMerek");
      $kdGdRoll = $this->input->post("kdGdRoll");
      $tebal = $this->input->post("tebal");
      $stokPermintaan = $this->input->post("stokPermintaan");
      $jmlPermintaan = $this->input->post("stokPermintaan");
      $satuan = $this->input->post("satuan");
      $shift = $this->input->post("shift");
      $berat = $this->input->post("berat");
      $ketBarang = $this->input->post("ketBarang");
      $idUser = $this->session->userdata("fabricationIdUser");
      $ukuran = $this->input->post("ukuran");
      $warnaPlastik = $this->input->post("warnaPlastik");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $merek = $this->input->post("merek");
      $strip = $this->input->post("strip");

      if(empty($kdPotong) || empty($idUser) || empty($tglRencana) || empty($customer) ||
         empty($strip) || $tebal=="" || $stokPermintaan=="" ||
         empty($noMesin) || empty($jmlMesin) || empty($shift)){
        echo "Data Kosong";
      }else{
        if(empty($kdGdHasil)){
          $data = array("kd_potong"         => $kdPotong,
                        "tgl_rencana"       => $tglRencana,
                        "no_mesin"          => $noMesin,
                        "jml_mesin"         => $jmlMesin,
                        "customer"          => $customer,
                        "ket_merek"         => $ketMerek,
                        "tebal"             => $tebal,
                        "stok_permintaan"   => $stokPermintaan,
                        "jml_permintaan"    => $jmlPermintaan,
                        "satuan"            => $satuan,
                        "shift"             => $shift,
                        "berat"             => $berat,
                        "ket_barang"        => $ketBarang,
                        "id_user"           => $idUser,
                        "strip"             => $strip);
        }else{
          $data = array("kd_potong"         => $kdPotong,
                        "tgl_rencana"       => $tglRencana,
                        "no_mesin"          => $noMesin,
                        "jml_mesin"         => $jmlMesin,
                        "customer"          => $customer,
                        "kd_gd_hasil"       => $kdGdHasil,
                        "ket_merek"         => $ketMerek,
                        "kd_gd_roll"        => $kdGdRoll,
                        "tebal"             => $tebal,
                        "stok_permintaan"   => $stokPermintaan,
                        "jml_permintaan"    => $jmlPermintaan,
                        "satuan"            => $satuan,
                        "shift"             => $shift,
                        "berat"             => $berat,
                        "ket_barang"        => $ketBarang,
                        "id_user"           => $idUser,
                        "ukuran"            => $ukuran,
                        "warna_plastik"     => $warnaPlastik,
                        "jns_permintaan"    => $jnsPermintaan,
                        "merek"             => $merek,
                        "strip"             => $strip);
        }
        $booleanResult = $this->Cutting_Model->updateRencanaPotong($data);
        if($booleanResult){
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

  public function saveRencanaPotongSusulan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrItem = json_decode($this->Cutting_Model->selectRencanaMandorPotongSusulanPending(), TRUE);
      if(count($arrItem) > 0){
        $result = $this->Cutting_Model->updateSaveRencanaPotongSusulan();
        if($result){
          echo "Berhasil";
        }else{
          echo "Gagal";
        }
      }else{
        echo "Data Kosong";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getUkuranPengembalianPotong($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $key = $this->input->get("q");
      if(empty($key)){
        $data = array("jnsPermintaan" => $param,
                      "Key" => "");
      }else{
        $data = array("jnsPermintaan" => $param,
                      "Key" => $key);
      }
      $result = $this->Cutting_Model->selectUkuranPengembalianPotong($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveTambahSisaPengambilanPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
        $kdCutting = $this->input->post("kdCutting");
        $kdGdRoll = $this->input->post("kdGdRoll");
        $idUser = $this->session->userdata("fabricationIdUser");
        $jnsPermintaan = $this->input->post("jnsPermintaan");
        $tglAwal = $this->input->post("tglAwal");
        $tglAkhir = $this->input->post("tglAkhir");
        $bagian = "POTONG";
        $berat = $this->input->post("berat");
        $bobin = $this->input->post("bobin");
        $payung = $this->input->post("payung");
        $payungKuning = $this->input->post("payungKuning");
        $shift = $this->input->post("shift");
        $keteranganHistory = $this->input->post("keteranganHistory");

        $ukuran = $this->input->post("ukuran");
        $panjangPlastik = $this->input->post("panjangPlastik");
        $merek = $this->input->post("merek");
        $warnaPlastik = $this->input->post("warnaPlastik");
        $ketBarang = $this->input->post("ketBarang");

        $kdGdRollTumpuk = $this->input->post("kdGdRollTumpuk");
        $jnsPermintaanTumpuk = $this->input->post("jnsPermintaanTumpuk");
        $beratTumpuk = $this->input->post("beratTumpuk");
        $bobinTumpuk = $this->input->post("bobinTumpuk");
        $payungTumpuk = $this->input->post("payungTumpuk");
        $payungKuningTumpuk = $this->input->post("payungKuningTumpuk");

        $ukuranTumpuk = $this->input->post("ukuranTumpuk");
        $panjangPlastikTumpuk = $this->input->post("panjangPlastikTumpuk");
        $merekTumpuk = $this->input->post("merekTumpuk");
        $warnaPlastikTumpuk = $this->input->post("warnaPlastikTumpuk");

        if(strpos(strtoupper($ketBarang),"TUMPUK") === FALSE){
          $data["TUMPUK"] = "NO";
          $data["tglCheck"] = date("Y-m",strtotime($tglAwal));
          $data["JnsPermintaan"] = $jnsPermintaan;
          if($keteranganHistory == "POTONG BESOK"){
            $data["TGR_IN"] = array("kd_gd_roll"            => $kdGdRoll,
                                    "id_user"               => $idUser,
                                    "jns_permintaan"        => $jnsPermintaan,
                                    "tgl_transaksi"         => $tglAwal,
                                    "bagian"                => $bagian,
                                    "keterangan_transaksi"  => "MASUK DARI POTONG",
                                    "status_history"        => "MASUK",
                                    "keterangan_history"    => "OPERATOR(SISA SEMALAM)",
                                    "berat"                 => $berat,
                                    "bobin"                 => $bobin,
                                    "payung"                => $payung,
                                    "payung_kuning"         => $payungKuning,
                                    "shift"                 => $shift);

            $data["TGR_OUT"] = array("kd_gd_roll"            => $kdGdRoll,
                                     "id_user"               => $idUser,
                                     "jns_permintaan"        => $jnsPermintaan,
                                     "tgl_transaksi"         => $tglAkhir,
                                     "bagian"                => $bagian,
                                     "keterangan_transaksi"  => "KELUAR KE POTONG",
                                     "status_history"        => "KELUAR",
                                     "keterangan_history"    => "OPERATOR(SISA SEMALAM)",
                                     "berat"                 => $berat,
                                     "bobin"                 => $bobin,
                                     "payung"                => $payung,
                                     "payung_kuning"         => $payungKuning,
                                     "shift"                 => $shift);

            $data["TBPR"] = array("kd_gd_roll" => $kdGdRoll,
                              "id_user"         => $idUser,
                              "kd_potong"       => $kdCutting,
                              "shift"           => $shift,
                              "sisa"            => $berat,
                              "payung"          => $payung,
                              "payung_kuning"   => $payungKuning,
                              "bobin"           => $bobin,
                              "keterangan"      => $keteranganHistory,
                              "tgl_sisa"        => $tglAwal,
                              "tgl_potong"      => $tglAkhir);

            $data["TDPP"] = array("kd_gd_roll" => $kdGdRoll,
                                  "kd_potong" => $kdCutting,
                                  "id_user" => $idUser,
                                  "ukuran" => $ukuran,
                                  "panjang" => $panjangPlastik,
                                  "merek" => $merek,
                                  "warna_plastik" => $warnaPlastik,
                                  "jns_permintaan" => $jnsPermintaan,
                                  "tgl_sisa" => $tglAwal,
                                  "tgl_potong" => $tglAkhir,
                                  "status" => "KEMBALI KE GUDANG(SISA SEMALAM)",
                                  "berat" => $berat,
                                  "bobin" => $bobin,
                                  "payung" => $payung,
                                  "payung_kuning" => $payungKuning);
          }else{
            $data["TGR"] = array("kd_gd_roll"            => $kdGdRoll,
                                 "id_user"               => $idUser,
                                 "jns_permintaan"        => $jnsPermintaan,
                                 "tgl_transaksi"         => $tglAwal,
                                 "bagian"                => $bagian,
                                 "keterangan_transaksi"  => "MASUK DARI POTONG",
                                 "status_history"        => "MASUK",
                                 "keterangan_history"    => "OPERATOR(SISA MESIN)",
                                 "berat"                 => $berat,
                                 "bobin"                 => $bobin,
                                 "payung"                => $payung,
                                 "payung_kuning"         => $payungKuning,
                                 "shift"                 => $shift);

            $data["TBPR"] = array("kd_gd_roll" => $kdGdRoll,
                              "id_user"         => $idUser,
                              "kd_potong"       => $kdCutting,
                              "shift"           => $shift,
                              "sisa"            => $berat,
                              "payung"          => $payung,
                              "payung_kuning"   => $payungKuning,
                              "bobin"           => $bobin,
                              "keterangan"      => $keteranganHistory,
                              "tgl_sisa"        => $tglAwal,
                              "tgl_potong"      => $tglAkhir);

            $data["TDPP"] = array("kd_gd_roll" => $kdGdRoll,
                                  "kd_potong" => $kdCutting,
                                  "id_user" => $idUser,
                                  "ukuran" => $ukuran,
                                  "panjang" => $panjangPlastik,
                                  "merek" => $merek,
                                  "warna_plastik" => $warnaPlastik,
                                  "jns_permintaan" => $jnsPermintaan,
                                  "tgl_sisa" => $tglAwal,
                                  "tgl_potong" => $tglAkhir,
                                  "status" => "KEMBALI KE GUDANG(SISA MESIN)",
                                  "berat" => $berat,
                                  "bobin" => $bobin,
                                  "payung" => $payung,
                                  "payung_kuning" => $payungKuning);
          }
        }else{
          $data["TUMPUK"] = "YES";
          $data["tglCheck"] = date("Y-m",strtotime($tglAwal));
          $data["JnsPermintaan"] = $jnsPermintaan;
          $data["JnsPermintaanTumpuk"] = $jnsPermintaanTumpuk;
          if($keteranganHistory == "POTONG BESOK"){
            $data["TGR_IN"] = array(array("kd_gd_roll"            => $kdGdRoll,
                                          "id_user"               => $idUser,
                                          "jns_permintaan"        => $jnsPermintaan,
                                          "tgl_transaksi"         => $tglAwal,
                                          "bagian"                => $bagian,
                                          "keterangan_transaksi"  => "MASUK DARI POTONG",
                                          "status_history"        => "MASUK",
                                          "keterangan_history"    => "OPERATOR(SISA SEMALAM)",
                                          "berat"                 => $berat,
                                          "bobin"                 => $bobin,
                                          "payung"                => $payung,
                                          "payung_kuning"         => $payungKuning,
                                          "shift"                 => $shift),

                                    array("kd_gd_roll"            => $kdGdRollTumpuk,
                                          "id_user"               => $idUser,
                                          "jns_permintaan"        => $jnsPermintaanTumpuk,
                                          "tgl_transaksi"         => $tglAwal,
                                          "bagian"                => $bagian,
                                          "keterangan_transaksi"  => "MASUK DARI POTONG",
                                          "status_history"        => "MASUK",
                                          "keterangan_history"    => "OPERATOR(SISA SEMALAM)",
                                          "berat"                 => $beratTumpuk,
                                          "bobin"                 => $bobinTumpuk,
                                          "payung"                => $payungTumpuk,
                                          "payung_kuning"         => $payungKuningTumpuk,
                                          "shift"                 => $shift));

            $data["TGR_OUT"] = array(array("kd_gd_roll"            => $kdGdRoll,
                                          "id_user"               => $idUser,
                                          "jns_permintaan"        => $jnsPermintaan,
                                          "tgl_transaksi"         => $tglAkhir,
                                          "bagian"                => $bagian,
                                          "keterangan_transaksi"  => "KELUAR KE POTONG",
                                          "status_history"        => "KELUAR",
                                          "keterangan_history"    => "OPERATOR(SISA SEMALAM)",
                                          "berat"                 => $berat,
                                          "bobin"                 => $bobin,
                                          "payung"                => $payung,
                                          "payung_kuning"         => $payungKuning,
                                          "shift"                 => $shift),

                                    array("kd_gd_roll"            => $kdGdRollTumpuk,
                                          "id_user"               => $idUser,
                                          "jns_permintaan"        => $jnsPermintaanTumpuk,
                                          "tgl_transaksi"         => $tglAkhir,
                                          "bagian"                => $bagian,
                                          "keterangan_transaksi"  => "KELUAR KE POTONG",
                                          "status_history"        => "KELUAR",
                                          "keterangan_history"    => "OPERATOR(SISA SEMALAM)",
                                          "berat"                 => $beratTumpuk,
                                          "bobin"                 => $bobinTumpuk,
                                          "payung"                => $payungTumpuk,
                                          "payung_kuning"         => $payungKuningTumpuk,
                                          "shift"                 => $shift));

            $data["TBPR"] = array(array("kd_gd_roll" => $kdGdRoll,
                                        "id_user"         => $idUser,
                                        "kd_potong"       => $kdCutting,
                                        "shift"           => $shift,
                                        "sisa"            => $berat,
                                        "payung"          => $payung,
                                        "payung_kuning"   => $payungKuning,
                                        "bobin"           => $bobin,
                                        "keterangan"      => $keteranganHistory,
                                        "tgl_sisa"        => $tglAwal,
                                        "tgl_potong"      => $tglAkhir),

                                  array("kd_gd_roll" => $kdGdRollTumpuk,
                                        "id_user"         => $idUser,
                                        "kd_potong"       => $kdCutting,
                                        "shift"           => $shift,
                                        "sisa"            => $beratTumpuk,
                                        "payung"          => $payungTumpuk,
                                        "payung_kuning"   => $payungKuningTumpuk,
                                        "bobin"           => $bobinTumpuk,
                                        "keterangan"      => $keteranganHistory,
                                        "tgl_sisa"        => $tglAwal,
                                        "tgl_potong"      => $tglAkhir));

            $data["TDPP"] = array(array("kd_gd_roll"      => $kdGdRoll,
                                        "kd_potong"       => $kdCutting,
                                        "id_user"         => $idUser,
                                        "ukuran"          => $ukuran,
                                        "panjang"         => $panjangPlastik,
                                        "merek"           => $merek,
                                        "warna_plastik"   => $warnaPlastik,
                                        "jns_permintaan"  => $jnsPermintaan,
                                        "tgl_sisa"        => $tglAwal,
                                        "tgl_potong"      => $tglAkhir,
                                        "status"          => "KEMBALI KE GUDANG(SISA SEMALAM)",
                                        "berat"           => $berat,
                                        "bobin"           => $bobin,
                                        "payung"          => $payung,
                                        "payung_kuning"   => $payungKuning),

                                  array("kd_gd_roll"      => $kdGdRollTumpuk,
                                        "kd_potong"       => $kdCutting,
                                        "id_user"         => $idUser,
                                        "ukuran"          => $ukuranTumpuk,
                                        "panjang"         => $panjangPlastikTumpuk,
                                        "merek"           => $merekTumpuk,
                                        "warna_plastik"   => $warnaPlastikTumpuk,
                                        "jns_permintaan"  => $jnsPermintaanTumpuk,
                                        "tgl_sisa"        => $tglAwal,
                                        "tgl_potong"      => $tglAkhir,
                                        "status"          => "KEMBALI KE GUDANG(SISA SEMALAM)",
                                        "berat"           => $beratTumpuk,
                                        "bobin"           => $bobinTumpuk,
                                        "payung"          => $payungTumpuk,
                                        "payung_kuning"   => $payungKuningTumpuk));
          }else{
            $data["TGR"] = array(array("kd_gd_roll"            => $kdGdRoll,
                                       "id_user"               => $idUser,
                                       "jns_permintaan"        => $jnsPermintaan,
                                       "tgl_transaksi"         => $tglAwal,
                                       "bagian"                => $bagian,
                                       "keterangan_transaksi"  => "MASUK DARI POTONG",
                                       "status_history"        => "MASUK",
                                       "keterangan_history"    => "OPERATOR(SISA MESIN)",
                                       "berat"                 => $berat,
                                       "bobin"                 => $bobin,
                                       "payung"                => $payung,
                                       "payung_kuning"         => $payungKuning,
                                       "shift"                 => $shift),

                                 array("kd_gd_roll"            => $kdGdRollTumpuk,
                                       "id_user"               => $idUser,
                                       "jns_permintaan"        => $jnsPermintaanTumpuk,
                                       "tgl_transaksi"         => $tglAwal,
                                       "bagian"                => $bagian,
                                       "keterangan_transaksi"  => "MASUK DARI POTONG",
                                       "status_history"        => "MASUK",
                                       "keterangan_history"    => "OPERATOR(SISA MESIN)",
                                       "berat"                 => $beratTumpuk,
                                       "bobin"                 => $bobinTumpuk,
                                       "payung"                => $payungTumpuk,
                                       "payung_kuning"         => $payungKuningTumpuk,
                                       "shift"                 => $shift));

            $data["TBPR"] = array(array("kd_gd_roll"      => $kdGdRoll,
                                        "id_user"         => $idUser,
                                        "kd_potong"       => $kdCutting,
                                        "shift"           => $shift,
                                        "sisa"            => $berat,
                                        "payung"          => $payung,
                                        "payung_kuning"   => $payungKuning,
                                        "bobin"           => $bobin,
                                        "keterangan"      => $keteranganHistory,
                                        "tgl_sisa"        => $tglAwal,
                                        "tgl_potong"      => $tglAkhir),
                                  array("kd_gd_roll"      => $kdGdRollTumpuk,
                                        "id_user"         => $idUser,
                                        "kd_potong"       => $kdCutting,
                                        "shift"           => $shift,
                                        "sisa"            => $beratTumpuk,
                                        "payung"          => $payungTumpuk,
                                        "payung_kuning"   => $payungKuningTumpuk,
                                        "bobin"           => $bobinTumpuk,
                                        "keterangan"      => $keteranganHistory,
                                        "tgl_sisa"        => $tglAwal,
                                        "tgl_potong"      => $tglAkhir));

            $data["TDPP"] = array(array("kd_gd_roll"      => $kdGdRoll,
                                        "kd_potong"       => $kdCutting,
                                        "id_user"         => $idUser,
                                        "ukuran"          => $ukuran,
                                        "panjang"         => $panjangPlastik,
                                        "merek"           => $merek,
                                        "warna_plastik"   => $warnaPlastik,
                                        "jns_permintaan"  => $jnsPermintaan,
                                        "tgl_sisa"        => $tglAwal,
                                        "tgl_potong"      => $tglAkhir,
                                        "status"          => "KEMBALI KE GUDANG(SISA MESIN)",
                                        "berat"           => $berat,
                                        "bobin"           => $bobin,
                                        "payung"          => $payung,
                                        "payung_kuning"   => $payungKuning),

                                  array("kd_gd_roll"      => $kdGdRollTumpuk,
                                        "kd_potong"       => $kdCutting,
                                        "id_user"         => $idUser,
                                        "ukuran"          => $ukuranTumpuk,
                                        "panjang"         => $panjangPlastikTumpuk,
                                        "merek"           => $merekTumpuk,
                                        "warna_plastik"   => $warnaPlastikTumpuk,
                                        "jns_permintaan"  => $jnsPermintaanTumpuk,
                                        "tgl_sisa"        => $tglAwal,
                                        "tgl_potong"      => $tglAkhir,
                                        "status"          => "KEMBALI KE GUDANG(SISA MESIN)",
                                        "berat"           => $beratTumpuk,
                                        "bobin"           => $bobinTumpuk,
                                        "payung"          => $payungTumpuk,
                                        "payung_kuning"   => $payungKuningTumpuk));
          }
        }
        $result = $this->Cutting_Model->insertSisaPengambilanPotong($data);
        echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getSisaPengambilan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $result = $this->Cutting_Model->selectSisaPengambilan($jnsPermintaan);
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
      $result = $this->Cutting_Model->selectDataRencanaForInputHasil($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveSisaPengambilanPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $booleanResult = $this->Cutting_Model->updateSaveSisaPengambilanPotong($jnsPermintaan);
      if($booleanResult){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getUkuranPengambilanPotong($jnsPermintaan, $tglRencana){
    $isLogin = $this->isLogin();
    if($isLogin){
      $Key = $this->input->get("q");
      $data = array("jnsPermintaan" => $jnsPermintaan,
                    "tglRencana"    => $tglRencana,
                    "Key"           => $Key);
      $result = $this->Cutting_Model->selectUkuranPengambilanPotong($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function savePengambilanPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $tglPengambilan = $this->input->post("tglPengambilan");
      $tglPotong = $this->input->post("tglPotong");
      $berat = $this->input->post("berat");
      $payung = $this->input->post("payung");
      $payungKuning = $this->input->post("payungKuning");
      $bobin = $this->input->post("bobin");
      $keteranganWaktu = $this->input->post("keteranganWaktu");
      $statusPengambilan = $this->input->post("statusPengambilan");
      $keteranganTransaksi = "KELUAR KE POTONG";
      $statusHistory = "KELUAR";
      $keteranganHistory = "MANDOR POTONG (".$statusPengambilan.")";
      $ketBarang = $this->input->post("ketBarang");
      $beratTumpuk = $this->input->post("beratTumpuk");
      $payungTumpuk = $this->input->post("payungTumpuk");
      $payungKuningTumpuk = $this->input->post("payungKuningTumpuk");
      $bobinTumpuk = $this->input->post("bobinTumpuk");

      #======= Data Hasil Split Dari Combo Box Ukuran Extruder=======#
      $panjangPlastik = $this->input->post("panjangPlastik");
      $merek = $this->input->post("merek");
      $warnaPlastik = $this->input->post("warnaPlastik");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $kdCutting = $this->input->post("kdCutting");
      $kdGdRoll = $this->input->post("kdGdRoll");

      $kdGdRollTumpuk = $this->input->post("kdGdRollTumpuk");
      $panjangPlastikTumpuk = $this->input->post("panjangPlastikTumpuk");
      $merekTumpuk = $this->input->post("merekTumpuk");
      $warnaPlastikTumpuk = $this->input->post("warnaPlastikTumpuk");
      $jnsPermintaanTumpuk = $this->input->post("jnsPermintaanTumpuk");
      #======= Data Hasil Split Dari Combo Box Ukuran Extruder=======#

      if(empty($tglPengambilan) || empty($tglPotong) || $berat=="" ||
         $payung=="" || $payungKuning=="" || $bobin=="" ||
         empty($keteranganWaktu) || empty($statusPengambilan) || empty($kdCutting) ||
         empty($kdGdRoll)){
        echo "Data Kosong";
      }else{
        if(strpos(strtoupper($ketBarang),"TUMPUK") !== FALSE){
          $data["TGR"] = array(array("kd_gd_roll"             => $kdGdRoll,
                                     "id_user"                => $idUser,
                                     "jns_permintaan"         => $jnsPermintaan,
                                     "tgl_transaksi"          => $tglPotong,
                                     "bagian"                 => "POTONG",
                                     "status_history"         => $statusHistory,
                                     "status_transaksi"       => "PROGRESS",
                                     "keterangan_history"     => $keteranganHistory,
                                     "berat"                  => $berat,
                                     "bobin"                  => $bobin,
                                     "payung"                 => $payung,
                                     "payung_kuning"          => $payungKuning,
                                     "keterangan_waktu"       => $keteranganWaktu,
                                     "keterangan_transaksi"   => $keteranganTransaksi,
                                     "keterangan_pengambilan" => $tglPengambilan),

                               array("kd_gd_roll"             => $kdGdRollTumpuk,
                                     "id_user"                => $idUser,
                                     "jns_permintaan"         => $jnsPermintaanTumpuk,
                                     "tgl_transaksi"          => $tglPotong,
                                     "bagian"                 => "POTONG",
                                     "status_history"         => $statusHistory,
                                     "status_transaksi"       => "PROGRESS",
                                     "keterangan_history"     => ($jnsPermintaanTumpuk == "POLOS") ? "MANDOR POTONG (EXTRUDER)" : $keteranganHistory,
                                     "berat"                  => $beratTumpuk,
                                     "bobin"                  => $bobinTumpuk,
                                     "payung"                 => $payungTumpuk,
                                     "payung_kuning"          => $payungKuningTumpuk,
                                     "keterangan_waktu"       => $keteranganWaktu,
                                     "keterangan_transaksi"   => $keteranganTransaksi,
                                     "keterangan_pengambilan" => $tglPengambilan)
                             );

          $data["TDPP"] = array(array("kd_gd_roll"      => $kdGdRoll,
                                      "kd_potong"       => $kdCutting,
                                      "id_user"         => $idUser,
                                      "ukuran"          => $panjangPlastik,
                                      "panjang"         => $panjangPlastik,
                                      "merek"           => $merek,
                                      "warna_plastik"   => $warnaPlastik,
                                      "jns_permintaan"  => $jnsPermintaan,
                                      "tgl_sisa"        => $tglPengambilan,
                                      "tgl_potong"      => $tglPotong,
                                      "status"          => $keteranganHistory,
                                      "berat"           => $berat,
                                      "bobin"           => $bobin,
                                      "payung"          => $payung,
                                      "payung_kuning"   => $payungKuning,
                                      "sts_transaksi"   => "PROGRESS"),

                                array("kd_gd_roll"      => $kdGdRollTumpuk,
                                      "kd_potong"       => $kdCutting,
                                      "id_user"         => $idUser,
                                      "ukuran"          => $panjangPlastikTumpuk,
                                      "panjang"         => $panjangPlastikTumpuk,
                                      "merek"           => $merekTumpuk,
                                      "warna_plastik"   => $warnaPlastikTumpuk,
                                      "jns_permintaan"  => $jnsPermintaanTumpuk,
                                      "tgl_sisa"        => $tglPengambilan,
                                      "tgl_potong"      => $tglPotong,
                                      "status"          => ($jnsPermintaanTumpuk == "POLOS") ? "MANDOR POTONG (EXTRUDER)" : $keteranganHistory,
                                      "berat"           => $beratTumpuk,
                                      "bobin"           => $bobinTumpuk,
                                      "payung"          => $payungTumpuk,
                                      "payung_kuning"   => $payungKuningTumpuk,
                                      "sts_transaksi"   => "PROGRESS")
                              );
        }else{
          $data["TGR"] = array(array("kd_gd_roll"             => $kdGdRoll,
                                     "id_user"                => $idUser,
                                     "jns_permintaan"         => $jnsPermintaan,
                                     "tgl_transaksi"          => $tglPotong,
                                     "bagian"                 => "POTONG",
                                     "status_history"         => $statusHistory,
                                     "status_transaksi"       => "PROGRESS",
                                     "keterangan_history"     => $keteranganHistory,
                                     "berat"                  => $berat,
                                     "bobin"                  => $bobin,
                                     "payung"                 => $payung,
                                     "payung_kuning"          => $payungKuning,
                                     "keterangan_waktu"       => $keteranganWaktu,
                                     "keterangan_transaksi"   => $keteranganTransaksi,
                                     "keterangan_pengambilan" => $tglPengambilan)
                             );

          $data["TDPP"] = array(array("kd_gd_roll"      => $kdGdRoll,
                                      "kd_potong"       => $kdCutting,
                                      "id_user"         => $idUser,
                                      "ukuran"          => $panjangPlastik,
                                      "panjang"         => $panjangPlastik,
                                      "merek"           => $merek,
                                      "warna_plastik"   => $warnaPlastik,
                                      "jns_permintaan"  => $jnsPermintaan,
                                      "tgl_sisa"        => $tglPengambilan,
                                      "tgl_potong"      => $tglPotong,
                                      "status"          => $keteranganHistory,
                                      "berat"           => $berat,
                                      "bobin"           => $bobin,
                                      "payung"          => $payung,
                                      "payung_kuning"   => $payungKuning,
                                      "sts_transaksi"   => "PROGRESS")
                              );
        }
        $result = $this->Cutting_Model->insertPengambilanPotong($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function savePengambilanPotongTertinggal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $tglPengambilan = $this->input->post("tglPengambilan");
      $tglPotong = $this->input->post("tglPotong");
      $berat = $this->input->post("berat");
      $payung = $this->input->post("payung");
      $payungKuning = $this->input->post("payungKuning");
      $bobin = $this->input->post("bobin");
      $keteranganWaktu = $this->input->post("keteranganWaktu");
      $statusPengambilan = $this->input->post("statusPengambilan");
      $keteranganTransaksi = "KELUAR KE POTONG";
      $statusHistory = "KELUAR";
      $keteranganHistory = "MANDOR POTONG (".$statusPengambilan.")";

      #======= Data Hasil Split Dari Combo Box Ukuran Extruder=======#
      $panjangPlastik = $this->input->post("panjangPlastik");
      $merek = $this->input->post("merek");
      $warnaPlastik = $this->input->post("warnaPlastik");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $kdCutting = $this->input->post("kdCutting");
      $kdGdRoll = $this->input->post("kdGdRoll");
      #======= Data Hasil Split Dari Combo Box Ukuran Extruder=======#

      if(empty($tglPengambilan) || empty($tglPotong) || $berat=="" ||
         $payung=="" || $payungKuning=="" || $bobin=="" ||
         empty($keteranganWaktu) || empty($statusPengambilan) || empty($kdCutting) ||
         empty($kdGdRoll)){
        echo "Data Kosong";
      }else{
        $data["TGR"] = array("kd_gd_roll"             => $kdGdRoll,
                             "id_user"                => $idUser,
                             "jns_permintaan"         => $jnsPermintaan,
                             "tgl_transaksi"          => $tglPotong,
                             "bagian"                 => "POTONG",
                             "status_history"         => $statusHistory,
                             "status_transaksi"       => "FINISH",
                             "keterangan_history"     => $keteranganHistory,
                             "berat"                  => $berat,
                             "bobin"                  => $bobin,
                             "payung"                 => $payung,
                             "payung_kuning"          => $payungKuning,
                             "keterangan_waktu"       => $keteranganWaktu,
                             "keterangan_transaksi"   => $keteranganTransaksi,
                             "keterangan_pengambilan" => $tglPengambilan);

        $data["TDPP"] = array("kd_gd_roll"      => $kdGdRoll,
                              "kd_potong"       => $kdCutting,
                              "id_user"         => $idUser,
                              "ukuran"          => $panjangPlastik,
                              "panjang"         => $panjangPlastik,
                              "merek"           => $merek,
                              "warna_plastik"   => $warnaPlastik,
                              "jns_permintaan"  => $jnsPermintaan,
                              "tgl_sisa"        => $tglPotong,
                              "tgl_potong"      => $tglPotong,
                              "status"          => $keteranganHistory,
                              "berat"           => $berat,
                              "bobin"           => $bobin,
                              "payung"          => $payung,
                              "payung_kuning"   => $payungKuning,
                              "sts_transaksi"   => "FINISH");

        $result = $this->Cutting_Model->insertPengambilanPotongTertinggal($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPengambilanPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $bagian = $this->input->post("bagian");
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("bagian" => $bagian,
                    "tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Cutting_Model->selectPengambilanPotong($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveInputHasilPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $idUser = $this->session->userdata("fabricationIdUser");
      $ketBarang = $this->input->post("ketBarang");
      $ketMerek = $this->input->post("ketMerek");
      $tglRencana = $this->input->post("tglRencana");
      $tglJadi = date("Y-m-d");
      $merek = $this->input->post("merek");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $warnaPlastik = $this->input->post("warnaPlastik");
      // $arrCustomer = $this->input->post("arrCustomer");
      $arrLembar = array_column($this->input->post("arrLembar"),"value");
      $arrBerat = array_column($this->input->post("arrBerat"),"value");
      // $arrTebal = $this->input->post("arrTebal");
      // $arrUkuran = $this->input->post("arrUkuran");
      // $arrJnsGudang = $this->input->post("arrJnsGudang");
      // $arrStrip = $this->input->post("arrStrip");
      // $arrNoMesin = $this->input->post("arrNoMesin");
      $arrKdCutting = array_column($this->input->post("arrKdCutting"),"value");
      $arrKdGdHasil = array_column($this->input->post("arrKdGdHasil"),"value");
      $arrKdGdRoll = array_column($this->input->post("arrKdGdRoll"),"value");
      $beratBagian = $this->input->post("beratBagian");
      $bobinBagian = $this->input->post("bobinBagian");
      $payungBagian = $this->input->post("payungBagian");
      $payungKuningBagian = $this->input->post("payungKuningBagian");
      $beratBagianTumpuk = $this->input->post("beratBagianTumpuk");
      $bobinBagianTumpuk = $this->input->post("bobinBagianTumpuk");
      $payungBagianTumpuk = $this->input->post("payungBagianTumpuk");
      $payungKuningBagianTumpuk = $this->input->post("payungKuningBagianTumpuk");
      $beratSisaSemalam = $this->input->post("beratSisaSemalam");
      $bobinSisaSemalam = $this->input->post("bobinSisaSemalam");
      $payungSisaSemalam = $this->input->post("payungSisaSemalam");
      $payungKuningSisaSemalam = $this->input->post("payungKuningSisaSemalam");
      $beratSisaSemalamTumpuk = $this->input->post("beratSisaSemalamTumpuk");
      $bobinSisaSemalamTumpuk = $this->input->post("bobinSisaSemalamTumpuk");
      $payungSisaSemalamTumpuk = $this->input->post("payungSisaSemalamTumpuk");
      $payungKuningSisaSemalamTumpuk = $this->input->post("payungKuningSisaSemalamTumpuk");
      $beratPengambilan = $this->input->post("beratPengambilan");
      $bobinPengambilan = $this->input->post("bobinPengambilan");
      $payungPengambilan = $this->input->post("payungPengambilan");
      $payungKuningPengambilan = $this->input->post("payungKuningPengambilan");
      $beratPengambilanTumpuk = $this->input->post("beratPengambilanTumpuk");
      $bobinPengambilanTumpuk = $this->input->post("bobinPengambilanTumpuk");
      $payungPengambilanTumpuk = $this->input->post("payungPengambilanTumpuk");
      $payungKuningPengambilanTumpuk = $this->input->post("payungKuningPengambilanTumpuk");
      $beratSisaHariIni = $this->input->post("beratSisaHariIni");
      $bobinSisaHariIni = $this->input->post("bobinSisaHariIni");
      $payungSisaHariIni = $this->input->post("payungSisaHariIni");
      $payungKuningSisaHariIni = $this->input->post("payungKuningSisaHariIni");
      $beratSisaHariIniTumpuk = $this->input->post("beratSisaHariIniTumpuk");
      $bobinSisaHariIniTumpuk = $this->input->post("bobinSisaHariIniTumpuk");
      $payungSisaHariIniTumpuk = $this->input->post("payungSisaHariIniTumpuk");
      $payungKuningSisaHariIniTumpuk = $this->input->post("payungKuningSisaHariIniTumpuk");
      $hasilLembar = $this->input->post("hasilLembar");
      $hasilBeratBersih = $this->input->post("hasilBeratBersih");
      $hasilBeratKotor = $this->input->post("hasilBeratKotor");
      $beratApal = $this->input->post("beratApal");
      $jnsRollPipa = $this->input->post("jnsRollPipa");
      $payung = $this->input->post("payung");
      $payungKuning = $this->input->post("payungKuning");
      $bobin = $this->input->post("bobin");
      $shift = $this->input->post("shift");
      $keterangan = $this->input->post("keterangan");
      $rollPipa = $this->input->post("rollPipa");
      $plusMinus = $this->input->post("plusMinus");
      $kdGdRollTumpuk = $this->input->post("kdGdRollTumpuk");

      if( $idTransaksi == ""                   || $idUser == ""                        || $tglRencana == ""                    ||
          $tglJadi == ""                       ||
          $merek == ""                         || $jnsPermintaan == ""                 || $warnaPlastik == ""                  ||
          count($arrLembar) <= 0               || count($arrBerat) <= 0                || count($arrKdCutting) <= 0            ||
          count($arrKdGdHasil) <= 0            || count($arrKdGdRoll) <= 0             || $beratBagian == ""                   ||
          $bobinBagian == ""                   || $payungBagian == ""                  || $payungKuningBagian == ""            ||
          $beratBagianTumpuk == ""             || $bobinBagianTumpuk == ""             || $payungBagianTumpuk == ""            ||
          $payungKuningBagianTumpuk == ""      || $beratSisaSemalam == ""              || $bobinSisaSemalam == ""              ||
          $payungSisaSemalam == ""             || $payungKuningSisaSemalam == ""       || $beratSisaSemalamTumpuk == ""        ||
          $bobinSisaSemalamTumpuk == ""        || $payungSisaSemalamTumpuk == ""       || $payungKuningSisaSemalamTumpuk == "" ||
          $beratPengambilan == ""              || $bobinPengambilan == ""              || $payungPengambilan == ""             ||
          $payungKuningPengambilan == ""       || $beratPengambilanTumpuk == ""        || $bobinPengambilanTumpuk == ""        ||
          $payungPengambilanTumpuk == ""       || $payungKuningPengambilanTumpuk == "" || $beratSisaHariIni == ""              ||
          $bobinSisaHariIni == ""              || $payungSisaHariIni == ""             || $payungKuningSisaHariIni == ""       ||
          $beratSisaHariIniTumpuk == ""        || $bobinSisaHariIniTumpuk == ""        || $payungSisaHariIniTumpuk == ""       ||
          $payungKuningSisaHariIniTumpuk == "" || $hasilLembar == ""                   || $hasilBeratBersih == ""              ||
          $hasilBeratKotor == ""               || $beratApal == ""                     || $jnsRollPipa == ""                   ||
          $shift == ""                         || $keterangan == ""                    || $rollPipa == ""                      ||
          $plusMinus == ""                     || $kdGdRollTumpuk == ""
        ){
          if($payung == "" || $payungKuning == "" || $bobin == ""){
            echo "Data Kosong";
          }else{
            echo "Data Kosong";
          }
        }else{
          $data["THP"] = array("kd_hasil_potong"      => $idTransaksi,
                               "id_user"              => $idUser,
                               "tgl_rencana"          => $tglRencana,
                               "tgl_jadi"             => $tglJadi,
                               "hasil_lembar"         => $hasilLembar,
                               "hasil_berat_bersih"   => $hasilBeratBersih,
                               "hasil_berat_kotor"    => $hasilBeratKotor,
                               "jumlah_apal_global"   => $beratApal,
                               "jenis_roll_pipa"      => $jnsRollPipa,
                               "jumlah_payung"        => $payung,
                               "jumlah_payung_kuning" => $payungKuning,
                               "jumlah_bobin"         => $bobin,
                               "shift"                => $shift,
                               "keterangan"           => $keterangan,
                               "jumlah_roll_pipa"     => $rollPipa,
                               "plusminus"            => $plusMinus);
          $data["TSHP"] = array();
          if((count($arrKdCutting) == count($arrLembar)) &&
             (count($arrKdCutting) == count($arrBerat)) &&
             (count($arrKdCutting) == count($arrKdGdHasil)) &&
             (count($arrKdCutting) == count($arrKdGdRoll))
            ){
              if(strpos(strtoupper($ketBarang),"TUMPUK") !== FALSE || strpos(strtoupper($ketMerek),"TUMPUK") !== FALSE){
                for ($i=0; $i < count($arrKdCutting); $i++) {
                  array_push($data["TSHP"], array("kd_hasil_potong" => $idTransaksi,
                                                  "kd_potong" => $arrKdCutting[$i],
                                                  "kd_gd_hasil" => $arrKdGdHasil[$i],
                                                  "kd_gd_roll" => $arrKdGdRoll[$i],
                                                  "kd_gd_roll_tumpuk" => $kdGdRollTumpuk,
                                                  "jumlah_lembar" => str_replace(",","",$arrLembar[$i]),
                                                  "jumlah_berat" => str_replace(",","",$arrBerat[$i])));
                }
              }else{
                for ($i=0; $i < count($arrKdCutting); $i++) {
                  array_push($data["TSHP"], array("kd_hasil_potong" => $idTransaksi,
                                                  "kd_potong" => $arrKdCutting[$i],
                                                  "kd_gd_hasil" => $arrKdGdHasil[$i],
                                                  "kd_gd_roll" => $arrKdGdRoll[$i],
                                                  "jumlah_lembar" => str_replace(",","",$arrLembar[$i]),
                                                  "jumlah_berat" => str_replace(",","",$arrBerat[$i])));
                }
              }
            }

          if(strpos(strtoupper($ketBarang),"TUMPUK") !== FALSE || strpos(strtoupper($ketMerek),"TUMPUK") !== FALSE){
            $data["TPHP"] = array("kd_hasil_potong" => $idTransaksi,
                                  "berat_pengambilan_bagian" => $beratBagian,
                                  "bobin_pengambilan_bagian" => $bobinBagian,
                                  "payung_pengambilan_bagian" => $payungBagian,
                                  "payung_kuning_pengambilan_bagian" => $payungKuningBagian,
                                  "berat_sisa_semalam" => $beratSisaSemalam,
                                  "bobin_sisa_semalam" => $bobinSisaSemalam,
                                  "payung_sisa_semalam" => $payungSisaSemalam,
                                  "payung_kuning_sisa_semalam" => $payungKuningSisaSemalam,
                                  "berat_pengambilan_gudang" => $beratPengambilan,
                                  "bobin_pengambilan_gudang" => $bobinPengambilan,
                                  "payung_pengambilan_gudang" => $payungPengambilan,
                                  "payung_kuning_pengambilan_gudang" => $payungKuningPengambilan,
                                  "berat_sisa_hari_ini" => $beratSisaHariIni,
                                  "bobin_sisa_hari_ini" => $bobinSisaHariIni,
                                  "payung_sisa_hari_ini" => $payungSisaHariIni,
                                  "payung_kuning_sisa_hari_ini" => $payungKuningSisaHariIni,
                                  "berat_pengambilan_bagian_tumpuk" => $beratBagianTumpuk,
                                  "bobin_pengambilan_bagian_tumpuk" => $bobinBagianTumpuk,
                                  "payung_pengambilan_bagian_tumpuk" => $payungBagianTumpuk,
                                  "payung_kuning_pengambilan_bagian_tumpuk" => $payungKuningBagianTumpuk,
                                  "berat_sisa_semalam_tumpuk" => $beratSisaSemalamTumpuk,
                                  "bobin_sisa_semalam_tumpuk" => $bobinSisaSemalamTumpuk,
                                  "payung_sisa_semalam_tumpuk" => $payungSisaSemalamTumpuk,
                                  "payung_kuning_sisa_semalam_tumpuk" => $payungKuningSisaSemalamTumpuk,
                                  "berat_pengambilan_gudang_tumpuk" => $beratPengambilanTumpuk,
                                  "bobin_pengambilan_gudang_tumpuk" => $bobinPengambilanTumpuk,
                                  "payung_pengambilan_gudang_tumpuk" => $payungPengambilanTumpuk,
                                  "payung_kuning_pengambilan_gudang_tumpuk" => $payungKuningPengambilanTumpuk,
                                  "berat_sisa_hari_ini_tumpuk" => $beratSisaHariIniTumpuk,
                                  "bobin_sisa_hari_ini_tumpuk" => $bobinSisaHariIniTumpuk,
                                  "payung_sisa_hari_ini_tumpuk" => $payungSisaHariIniTumpuk,
                                  "payung_kuning_sisa_hari_ini_tumpuk" => $payungKuningSisaHariIniTumpuk);

            $data["TGR"] = array(array("kd_gd_roll" => $data["TSHP"][0]["kd_gd_roll"],
                                       "id_user" => $idUser,
                                       "jns_permintaan" => $jnsPermintaan,
                                       "tgl_transaksi" => $tglRencana,
                                       "bagian" => "POTONG",
                                       "keterangan_transaksi" => "KELUAR KE POTONG",
                                       "status_history" => "KELUAR",
                                       "keterangan_history" => "OPERATOR POTONG",
                                       "berat" => $beratPengambilan,
                                       "bobin" => $bobinPengambilan,
                                       "payung" => $payungPengambilan,
                                       "payung_kuning" => $payungKuningPengambilan,
                                       "shift" => $shift),
                                 array("kd_gd_roll" => $kdGdRollTumpuk,
                                       "id_user" => $idUser,
                                       "jns_permintaan" => $jnsPermintaan,
                                       "tgl_transaksi" => $tglRencana,
                                       "bagian" => "POTONG",
                                       "keterangan_transaksi" => "KELUAR KE POTONG",
                                       "status_history" => "KELUAR",
                                       "keterangan_history" => "OPERATOR POTONG",
                                       "berat" => $beratPengambilanTumpuk,
                                       "bobin" => $bobinPengambilanTumpuk,
                                       "payung" => $payungPengambilanTumpuk,
                                       "payung_kuning" => $payungKuningPengambilanTumpuk,
                                       "shift" => $shift)
                                );
            // $data["TBPR"] = array(array("kd_gd_roll" => $data["TSHP"][0]["kd_gd_roll"],
            //                             "id_user" => $idUser,
            //                             "kd_potong" => $arrKdCutting[0],
            //                             "shift" => $shift,
            //                             "sisa" => $beratPengambilan,
            //                             "payung" => $payungPengambilan,
            //                             "payung_kuning" => $payungKuningPengambilan,
            //                             "bobin" => $bobinPengambilan,
            //                             "keterangan" => "OPERATOR POTONG",
            //                             "tgl_sisa" => $tglRencana,
            //                             "tgl_potong" => $tglRencana),
            //                       array("kd_gd_roll" => $kdGdRollTumpuk,
            //                             "id_user" => $idUser,
            //                             "kd_potong" => $arrKdCutting[0],
            //                             "shift" => $shift,
            //                             "sisa" => $beratPengambilanTumpuk,
            //                             "payung" => $payungPengambilanTumpuk,
            //                             "payung_kuning" => $payungKuningPengambilanTumpuk,
            //                             "bobin" => $bobinPengambilanTumpuk,
            //                             "keterangan" => "OPERATOR POTONG",
            //                             "tgl_sisa" => $tglRencana,
            //                             "tgl_potong" => $tglRencana),
            //                           );
          }else{
            $data["TPHP"] = array("kd_hasil_potong" => $idTransaksi,
                                  "berat_pengambilan_bagian" => $beratBagian,
                                  "bobin_pengambilan_bagian" => $bobinBagian,
                                  "payung_pengambilan_bagian" => $payungBagian,
                                  "payung_kuning_pengambilan_bagian" => $payungKuningBagian,
                                  "berat_sisa_semalam" => $beratSisaSemalam,
                                  "bobin_sisa_semalam" => $bobinSisaSemalam,
                                  "payung_sisa_semalam" => $payungSisaSemalam,
                                  "payung_kuning_sisa_semalam" => $payungKuningSisaSemalam,
                                  "berat_pengambilan_gudang" => $beratPengambilan,
                                  "bobin_pengambilan_gudang" => $bobinPengambilan,
                                  "payung_pengambilan_gudang" => $payungPengambilan,
                                  "payung_kuning_pengambilan_gudang" => $payungKuningPengambilan,
                                  "berat_sisa_hari_ini" => $beratSisaHariIni,
                                  "bobin_sisa_hari_ini" => $bobinSisaHariIni,
                                  "payung_sisa_hari_ini" => $payungSisaHariIni,
                                  "payung_kuning_sisa_hari_ini" => $payungKuningSisaHariIni,
                                  // "berat_pengambilan_bagian_tumpuk" => $beratBagianTumpuk,
                                  // "bobin_pengambilan_bagian_tumpuk" => $bobinBagianTumpuk,
                                  // "payung_pengambilan_bagian_tumpuk" => $payungBagianTumpuk,
                                  // "payung_kuning_pengambilan_bagian_tumpuk" => $payungKuningBagianTumpuk,
                                  // "berat_sisa_semalam_tumpuk" => $beratSisaSemalamTumpuk,
                                  // "bobin_sisa_semalam_tumpuk" => $bobinSisaSemalamTumpuk,
                                  // "payung_sisa_semalam_tumpuk" => $payungSisaSemalamTumpuk,
                                  // "payung_kuning_sisa_semalam_tumpuk" => $payungKuningSisaSemalamTumpuk,
                                  // "berat_pengambilan_gudang_tumpuk" => $beratPengambilanTumpuk,
                                  // "bobin_pengambilan_gudang_tumpuk" => $bobinPengambilanTumpuk,
                                  // "payung_pengambilan_gudang_tumpuk" => $payungPengambilanTumpuk,
                                  // "payung_kuning_pengambilan_gudang_tumpuk" => $payungKuningPengambilanTumpuk,
                                  // "berat_sisa_hari_ini_tumpuk" => $beratSisaHariIniTumpuk,
                                  // "bobin_sisa_hari_ini_tumpuk" => $bobinSisaHariIniTumpuk,
                                  // "payung_sisa_hari_ini_tumpuk" => $payungSisaHariIniTumpuk,
                                  // "payung_kuning_sisa_hari_ini_tumpuk" => $payungKuningSisaHariIniTumpuk
                                );
            $data["TGR"] = array(array("kd_gd_roll" => $data["TSHP"][0]["kd_gd_roll"],
                                       "id_user" => $idUser,
                                       "jns_permintaan" => $jnsPermintaan,
                                       "tgl_transaksi" => $tglRencana,
                                       "bagian" => "POTONG",
                                       "keterangan_transaksi" => "KELUAR KE POTONG",
                                       "status_history" => "KELUAR",
                                       "keterangan_history" => "OPERATOR POTONG",
                                       "berat" => $beratPengambilan,
                                       "bobin" => $bobinPengambilan,
                                       "payung" => $payungPengambilan,
                                       "payung_kuning" => $payungKuningPengambilan,
                                       "shift" => $shift));
            // $data["TBPR"] = array(array("kd_gd_roll" => $data["TSHP"][0]["kd_gd_roll"],
            //                             "id_user" => $idUser,
            //                             "kd_potong" => $arrKdCutting[0],
            //                             "shift" => $shift,
            //                             "sisa" => $beratPengambilan,
            //                             "payung" => $payungPengambilan,
            //                             "payung_kuning" => $payungKuningPengambilan,
            //                             "bobin" => $bobinPengambilan,
            //                             "keterangan" => "OPERATOR POTONG",
            //                             "tgl_sisa" => $tglRencana,
            //                             "tgl_potong" => $tglRencana));
          }
          $result = $this->Cutting_Model->insertInputHasil($data);
          echo $result;
        }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListLaporanRencanaPpic(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglRencana = $this->input->post("tglRencana");
      $result = $this->Cutting_Model->selectLaporanRencanaPpicPotong($tglRencana);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getHasilJobPotongPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cutting_Model->selectHasilJobPotongPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveHasilJobPotong(){
    $tglJadi = $this->input->post("tglJadi");
    $result = $this->Cutting_Model->updateSaveHasilJobPotong($tglJadi);
    if($result){
      echo "Berhasil";
    }else{
      echo "Gagal";
    }
  }

  public function getHasilJobPotong(){
    $shift = $this->input->post("shift");
    $tglJadi = $this->input->post("tglJadi");
    $data = array("shift" => $shift,
                  "tglJadi" => $tglJadi);
    $result = $this->Cutting_Model->selectHasilJobPotong($data);
    echo $result;
  }

  public function printHasilPotong($shift,$tglJadi){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("shift" => $shift,
                    "tglJadi" => $tglJadi);
      $result["Data"] = $this->Cutting_Model->selectHasilJobPotongPrint($data);
      // $css = "assets/bootstrap/css/bootstrap.min.css";
      // $page = $this->load->view("frm_print_hasil_cutting",$result,true);
      $this->load->view("frm_print_hasil_cutting",$result);
      // $this->load->library('m_pdf');
      // $this->mpdf->mPDF("utf-8","A4-L",0,"",5,5,8,8,5,3);
      // $this->mpdf->setFooter("Page ".'{PAGENO}');
      // $this->mpdf->WriteHTML(file_get_contents($css),1);
      // $this->mpdf->WriteHTML($page);
      // $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryPPICExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $bulan = $this->input->post("bulan");
      $tahun = $this->input->post("tahun");
      $param = $tahun."-".$bulan;
      $result = $this->Cutting_Model->selectListHistoryPPICExtruder($param);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListBonHasilJadi(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsBrg = $this->input->post("jnsBrg");
      $merek = $this->input->post("merek");
      $tglJadi = $this->input->post("tglJadi");

      $data = array("jnsBrg"    => $jnsBrg,
                    "merek"     => str_replace("%20"," ",$merek),
                    "tglJadi"   => $tglJadi);
      $result = $this->Cutting_Model->selectListBonHasilJadi($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printListBonHasilJadi($jnsBrg,$merek,$tglJadi){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("jnsBrg"    => $jnsBrg,
                    "merek"     => str_replace("%20"," ",$merek),
                    "tglJadi"   => $tglJadi);
      $result["Data"] = json_decode($this->Cutting_Model->selectListBonHasilJadi($data),TRUE);
      // $css = "assets/bootstrap/css/bootstrap.min.css";
      // $page = $this->load->view("frm_print_bon_hasil_jadi",$result,true);
      $this->load->view("frm_print_bon_hasil_jadi",$result);
      // $this->load->library('m_pdf');
      // $this->mpdf->mPDF("utf-8","A5-L",0,"",5,5,8,8,5,3);
      // $this->mpdf->setFooter("Page ".'{PAGENO}');
      // $this->mpdf->WriteHTML(file_get_contents($css),1);
      // $this->mpdf->WriteHTML($page);
      // $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListBonHasilJadiGlobal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsBrg = $this->input->post("jnsBrg");
      $tglJadi = $this->input->post("tglJadi");

      $data = array("jnsBrg"    => $jnsBrg,
                    "tglJadi"   => $tglJadi);
      $result = $this->Cutting_Model->selectListBonHasilJadiGlobal($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printListBonHasilJadiGlobal($jnsBrg,$tglJadi){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("jnsBrg"    => $jnsBrg,
                    "tglJadi"   => $tglJadi);
      $result["Data"] = json_decode($this->Cutting_Model->selectListBonHasilJadiGlobal($data),TRUE);
      // $css = "assets/bootstrap/css/bootstrap.min.css";
      // $page = $this->load->view("frm_print_bon_hasil_jadi_global",$result,true);
      // $this->load->library('m_pdf');
      // $this->mpdf->mPDF("utf-8","A5-L",0,"",5,5,8,8,5,3);
      // $this->mpdf->setFooter("Page ".'{PAGENO}');
      // $this->mpdf->WriteHTML(file_get_contents($css),1);
      // $this->mpdf->WriteHTML($page);
      // $this->mpdf->Output();
      $this->load->view("frm_print_bon_hasil_jadi_global",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKirimBonHasilJadiGlobal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsBrg = $this->input->post("jnsBrg");
      $tglJadi = $this->input->post("tglJadi");
      $arrDataBon["DataBon"] = array();
      $arrDataBon["Parameter"] = array("jnsBrg" => $jnsBrg,
                                       "tglJadi" => $tglJadi);
      $data = array("jnsBrg"    => $jnsBrg,
                    "tglJadi"   => $tglJadi);
      $result = json_decode($this->Cutting_Model->selectListBonHasilJadiGlobal($data),TRUE);
      if(count($result) > 0){
        for ($i=0; $i < count($result); $i++) {
          if($result[$i]["status_bon"] == "FALSE"){
            $tempArrDataBon = array("kd_gd_hasil"         => $result[$i]["kd_gd_hasil"],
                                    "id_user"             => $this->session->userdata("fabricationIdUser"),
                                    "ukuran"              => $result[$i]["ukuran"],
                                    "jumlah_berat"        => str_replace(",","",$result[$i]["jumlah_berat"]),
                                    "jumlah_lembar"       => str_replace(",","",$result[$i]["jumlah_lembar"]),
                                    "warna"               => $result[$i]["warna_plastik"],
                                    "customer"            => $result[$i]["customer"],
                                    "bagian"              => "POTONG",
                                    "tgl_transaksi"       => $result[$i]["tgl_rencana"],
                                    "merek"               => $result[$i]["merek"],
                                    "jns_permintaan"      => $result[$i]["jns_permintaan"],
                                    "sts_barang"          => $result[$i]["jns_brg"],
                                    "status_history"      => "MASUK",
                                    "status_transaksi"    => "PROGRESS",
                                    "keterangan_history"  => "MASUK DARI POTONG",
                                    "keterangan_barang"   => $result[$i]["ket_barang"]);
            array_push($arrDataBon["DataBon"], $tempArrDataBon);
          }
        }
        $result = $this->Cutting_Model->insertKirimBonHasilJadiGlobal($arrDataBon);
        echo $result;
      }else{
        echo "Data Kosong";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getHistorySisaPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal"=>$tglAwal,
                    "tglAkhir"=>$tglAkhir);
      $result = $this->Cutting_Model->selectHistorySisaPotong($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getUkuranPengembalianPotongTertinggal($param,$param2, $param3){
    $isLogin = $this->isLogin();
    if($isLogin){
      $key = $this->input->get("q");
      if(empty($key)){
        $data = array("jnsPermintaan" => $param,
                      "tglAwal" => $param2,
                      "tglAkhir" => $param3,
                      "Key" => "");
      }else{
        $data = array("jnsPermintaan" => $param,
                      "tglAwal" => $param2,
                      "tglAkhir" => $param3,
                      "Key" => $key);
      }
      $result = $this->Cutting_Model->selectUkuranPengembalianPotongTertinggal($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getLaporanHasilPotongGlobal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglJadi = $this->input->post("tglJadi");
      $result = $this->Cutting_Model->selectLaporanHasilPotongGlobal($tglJadi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getLaporanBonApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglJadi = $this->input->post("tglJadi");
      $jnsPermintaan = $this->input->post("jnsPermintaan");

      $data = array("tglJadi"       => $tglJadi,
                    "jnsPermintaan" => $jnsPermintaan);

      $result = $this->Cutting_Model->selectLaporanBonApal($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGudangApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $result = $this->Cutting_Model->selectGudangApal($jnsPermintaan);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveTambahBonApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdApal = $this->input->post("kdGdApal");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nama = "MANDOR POTONG";
      $tglTransaksi = $this->input->post("tglTransaksi");
      $merek = $this->input->post("merek");
      $warna = $this->input->post("warna");
      $bagian = "POTONG";
      $jumlahApal = $this->input->post("jumlahApal");
      $keterangan = 'KIRIMAN APAL';
      $statusHistory = "MASUK";

      if($kdGdApal=="" || $jumlahApal==""){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_apal" => $kdGdApal,
                      "id_user" => $idUser,
                      "nama" => $nama,
                      "tgl_transaksi" => $tglTransaksi,
                      "merek" => $merek,
                      "warna" => $warna,
                      "bagian" => $bagian,
                      "jumlah_apal" => $jumlahApal,
                      "keterangan_history" => $keterangan,
                      "status_history" => $statusHistory);
        $result = $this->Cutting_Model->insertTransaksiDetailHistoryApal($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListDataBonApalPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cutting_Model->selectListDataBonApalPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailBonApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Cutting_Model->selectDetailBonApal($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editTambahBonApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdApal = $this->input->post("kdGdApal");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nama = "MANDOR POTONG";
      $tglTransaksi = $this->input->post("tglTransaksi");
      $merek = $this->input->post("merek");
      $warna = $this->input->post("warna");
      $bagian = "POTONG";
      $jumlahApal = $this->input->post("jumlahApal");
      $keterangan = 'KIRIMAN APAL';
      $statusHistory = "MASUK";
      $idTransaksi = $this->input->post("idTransaksi");

      if($kdGdApal=="" || $jumlahApal==""){
        echo "Data Kosong";
      }else{
        $data = array("id" => $idTransaksi,
                      "kd_gd_apal" => $kdGdApal,
                      "id_user" => $idUser,
                      "nama" => $nama,
                      "tgl_transaksi" => $tglTransaksi,
                      "merek" => $merek,
                      "warna" => $warna,
                      "bagian" => $bagian,
                      "jumlah_apal" => $jumlahApal,
                      "keterangan_history" => $keterangan,
                      "status_history" => $statusHistory);
        $result = $this->Cutting_Model->updateTransaksiDetailHistoryApal($data);
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

  public function deleteAndRestoreTambahBonApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");

      $data = array("id" => $idTransaksi,
                    "deleted" => $deleted);
      $result = $this->Cutting_Model->updateTransaksiDetailHistoryApal($data);
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

  public function saveTransaksiDetailHistoryApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cutting_Model->updateSaveTransaksiDetailHistoryApal();
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

  public function getBuatBon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglJadi = $this->input->post("tglJadi");
      $jnsPermintaan = $this->input->post("jnsPermintaan");

      $data = array("tglJadi"       => $tglJadi,
                    "jnsPermintaan" => $jnsPermintaan);

      $result = json_decode($this->Cutting_Model->selectLaporanBonApal($data),TRUE);
      $result2 = $this->Cutting_Model->selectJumlahPerSubApal($data);
      $data = array("ListBon" => $result,
                    "ListTotalSubBon" => $result2);
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printListBonApal($jnsPermintaan,$tglJadi){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglJadi"       => $tglJadi,
                    "jnsPermintaan" => $jnsPermintaan);
      $result["ListBon"] = json_decode($this->Cutting_Model->selectLaporanBonApal($data),TRUE);
      $result["ListTotalSubBon"] = $this->Cutting_Model->selectJumlahPerSubApal($data);
      $css = "assets/bootstrap/css/bootstrap.min.css";
      // $page = $this->load->view("frm_print_bon_apal",$result,true);
      $this->load->view("frm_print_bon_apal",$result);
      // $this->load->library('m_pdf');
      // $this->mpdf->mPDF("utf-8","A5-L",0,"",5,5,8,8,5,3);
      // $this->mpdf->setFooter("Page ".'{PAGENO}');
      // $this->mpdf->WriteHTML(file_get_contents($css),1);
      // $this->mpdf->WriteHTML($page);
      // $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDataForUpdateHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Cutting_Model->selectDataForUpdateHasil($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editHasilCutting(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $kdHasilPotong = $this->input->post("kdHasilPotong");
      $tglRencana = $this->input->post("tglRencana");
      $tglJadi = $this->input->post("tglJadi");
      $arrKode = explode("#",$this->input->post("kdGdHasil"));
      $kdPotong = $arrKode[0];
      $permintaan = $this->input->post("permintaan");
      $totalJumlahApalBaru = $this->input->post("totalJumlahApalBaru");
      $totalJumlahBeratKotorBaru = $this->input->post("totalJumlahBeratKotorBaru");
      $totalJumlahBeratBersihBaru = $this->input->post("totalJumlahBeratBersihBaru");
      $totalJumlahLembarBaru = $this->input->post("totalJumlahLembarBaru");
      $jumlahSubLembarBaru = $this->input->post("jumlahSubLembarBaru");
      $jumlahSubBeratBaru = $this->input->post("jumlahSubBeratBaru");
      $plusminusBaru = $this->input->post("plusminusBaru");
      $idUser = $this->session->userdata("fabricationIdUser");
      $rollPipa = $this->input->post("rollPipa");

      $bahan = $this->input->post("bahan");
      $bobin = $this->input->post("bobin");
      $payung = $this->input->post("payung");
      $payungKuning = $this->input->post("payungKuning");

      $beratSisaSemalam = $this->input->post("beratSisaSemalam");
      $bobinSisaSemalam = $this->input->post("bobinSisaSemalam");
      $payungSisaSemalam = $this->input->post("payungSisaSemalam");
      $payungKuningSisaSemalam = $this->input->post("payungKuningSisaSemalam");

      $beratPengambilan = $this->input->post("beratPengambilan");
      $bobinPengambilan = $this->input->post("bobinPengambilan");
      $payungPengambilan = $this->input->post("payungPengambilan");
      $payungKuningPengambilan = $this->input->post("payungKuningPengambilan");

      $sisa = $this->input->post("sisa");
      $bobinSisa = $this->input->post("bobinSisa");
      $payungSisa = $this->input->post("payungSisa");
      $payungKuningSisa = $this->input->post("payungKuningSisa");

      $bahanTumpuk = $this->input->post("bahanTumpuk");
      $bobinBahanTumpuk = $this->input->post("bobinBahanTumpuk");
      $payungBahanTumpuk = $this->input->post("payungBahanTumpuk");
      $payungKuningBahanTumpuk = $this->input->post("payungKuningBahanTumpuk");

      $beratSisaSemalamTumpuk = $this->input->post("beratSisaSemalamTumpuk");
      $bobinSisaSemalamTumpuk = $this->input->post("bobinSisaSemalamTumpuk");
      $payungSisaSemalamTumpuk = $this->input->post("payungSisaSemalamTumpuk");
      $payungKuningSisaSemalamTumpuk = $this->input->post("payungKuningSisaSemalamTumpuk");

      $beratPengambilanTumpuk = $this->input->post("beratPengambilanTumpuk");
      $bobinPengambilanTumpuk = $this->input->post("bobinPengambilanTumpuk");
      $payungPengambilanTumpuk = $this->input->post("payungPengambilanTumpuk");
      $payungKuningPengambilanTumpuk = $this->input->post("payungKuningPengambilanTumpuk");

      $sisaTumpuk = $this->input->post("sisaTumpuk");
      $bobinSisaTumpuk = $this->input->post("bobinSisaTumpuk");
      $payungSisaTumpuk = $this->input->post("payungSisaTumpuk");
      $payungKuningSisaTumpuk = $this->input->post("payungKuningSisaTumpuk");

      $jnsRollPipa = $this->input->post("jnsRollPipa");
      $rollPayung = $this->input->post("rollPayung");
      $rollPayungKuning = $this->input->post("rollPayungKuning");
      $rollBobin = $this->input->post("rollBobin");

      if($idTransaksi=="" || $tglRencana=="" || $tglJadi=="" ||
         $permintaan=="" || $totalJumlahApalBaru=="" || $kdHasilPotong=="" ||
         $totalJumlahBeratKotorBaru=="" || $totalJumlahBeratBersihBaru=="" ||
         $totalJumlahLembarBaru=="" || $jumlahSubLembarBaru=="" ||
         $jumlahSubBeratBaru=="" || $plusminusBaru=="" || $rollPipa=="" ||
         $jnsRollPipa=="" || $bahan == "" || $bobin == "" || $payung == "" || $payungKuning == "" ||
         $beratSisaSemalam == "" || $bobinSisaSemalam == "" || $payungSisaSemalam == "" || $payungKuningSisaSemalam == "" ||
         $beratPengambilan == "" || $bobinPengambilan == "" || $payungPengambilan == "" || $payungKuningPengambilan == "" ||
         $sisa == "" || $bobinSisa == "" || $payungSisa == "" || $payungKuningSisa == "" ||
         $bahanTumpuk == "" || $bobinBahanTumpuk == "" || $payungBahanTumpuk == "" || $payungKuningBahanTumpuk == "" ||
         $beratSisaSemalamTumpuk == "" || $bobinSisaSemalamTumpuk == "" || $payungSisaSemalamTumpuk == "" || $payungKuningSisaSemalamTumpuk == "" ||
         $beratPengambilanTumpuk == "" || $bobinPengambilanTumpuk == "" || $payungPengambilanTumpuk == "" || $payungKuningPengambilanTumpuk == "" ||
         $sisaTumpuk == "" || $bobinSisaTumpuk == "" || $payungSisaTumpuk == "" || $payungKuningSisaTumpuk == "" ||
         $rollPayung == "" || $rollPayungKuning == "" || $rollBobin == ""
       ){
         echo "Data Kosong";
       }else{
         $data["THP"] = array("kd_hasil_potong"       => $kdHasilPotong,
                              "id_user"               => $idUser,
                              "tgl_rencana"           => $tglRencana,
                              "tgl_jadi"              => $tglJadi,
                              "hasil_lembar"          => $totalJumlahLembarBaru,
                              "hasil_berat_bersih"    => $totalJumlahBeratBersihBaru,
                              "hasil_berat_kotor"     => $totalJumlahBeratKotorBaru,
                              "jumlah_apal_global"    => $totalJumlahApalBaru,
                              "plusminus"             => $plusminusBaru,
                              "jenis_roll_pipa"       => $jnsRollPipa,
                              "jumlah_payung"         => $rollPayung,
                              "jumlah_payung_kuning"  => $rollPayungKuning,
                              "jumlah_bobin"          => $rollBobin,
                              "jumlah_roll_pipa"      => $rollPipa);

         $data["TPHP"] = array("kd_hasil_potong"                          => $kdHasilPotong,
                               "berat_pengambilan_gudang"                 => $beratPengambilan,
                               "bobin_pengambilan_gudang"                 => $bobinPengambilan,
                               "payung_pengambilan_gudang"                => $payungPengambilan,
                               "payung_kuning_pengambilan_gudang"         => $payungKuningPengambilan,
                               "berat_pengambilan_gudang_tumpuk"          => $beratPengambilanTumpuk,
                               "bobin_pengambilan_gudang_tumpuk"          => $bobinPengambilanTumpuk,
                               "payung_pengambilan_gudang_tumpuk"         => $payungPengambilanTumpuk,
                               "payung_kuning_pengambilan_gudang_tumpuk"  => $payungKuningPengambilanTumpuk
                             );
         if(empty($kdPotong)){
          $data["TSHP"] = array("id_transaksi"    => $idTransaksi,
                                "jumlah_lembar"   => $jumlahSubLembarBaru,
                                "jumlah_berat"    => $jumlahSubBeratBaru);
         }else{
           $data["TSHP"] = array("id_transaksi"   => $idTransaksi,
                                 "kd_potong"      => $kdPotong,
                                 "jumlah_lembar"  => $jumlahSubLembarBaru,
                                 "jumlah_berat"   => $jumlahSubBeratBaru);
         }
         $result = $this->Cutting_Model->updateHasilCutting($data);
         echo $result;
         // print_r($result);
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailPengambilanPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Cutting_Model->selectDetailPengambilanPotong($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editPengambilanPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $bagian = $this->input->post("bagian");
      $tglSisa = $this->input->post("tglSisa");
      $tglPotong = $this->input->post("tglPotong");
      $berat = $this->input->post("berat");
      $payung = $this->input->post("payung");
      $payungKuning = $this->input->post("payungKuning");
      $bobin = $this->input->post("bobin");
      $keteranganWaktu = $this->input->post("keteranganWaktu");
      $kdCutting = $this->input->post("kdCutting");
      $kdGdRoll = $this->input->post("kdGdRoll");
      $ukuran = $this->input->post("ukuran");
      $panjangPlastik = $this->input->post("panjangPlastik");
      $merek = $this->input->post("merek");
      $warnaPlastik = $this->input->post("warnaPlastik");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $doubleSingle = $this->input->post("doubleSingle");

      if(empty($idTransaksi) || empty($tglSisa) || empty($tglPotong) ||
         $berat=="" || $payung=="" || $payungKuning=="" ||
         $bobin=="" || empty($keteranganWaktu) || empty($idUser) || $doubleSingle==""
       ){
        echo "Data Kosong";
      }else{
        if(empty($kdCutting) || empty($kdGdRoll)){
          $data = array("id"               => $idTransaksi,
                        "bagian"           => $bagian,
          	            "id_user"          => $idUser,
          	            "tgl_sisa"         => $tglSisa,
          	            "tgl_potong"       => $tglPotong,
          	            "berat"            => $berat,
          	            "bobin"            => $bobin,
          	            "payung"           => $payung,
          	            "payung_kuning"    => $payungKuning,
                        "doubleSingle"     => $doubleSingle
                      );
        }else{
          $data = array("id"               => $idTransaksi,
                        "bagian"           => $bagian,
          	            "kd_gd_roll"       => $kdGdRoll,
          	            "kd_potong"        => $kdCutting,
          	            "id_user"          => $idUser,
          	            "ukuran"           => $ukuran,
          	            "panjang"          => $panjangPlastik,
          	            "merek"            => $merek,
          	            "warna_plastik"    => $warnaPlastik,
          	            "jns_permintaan"   => $jnsPermintaan,
          	            "tgl_sisa"         => $tglSisa,
          	            "tgl_potong"       => $tglPotong,
          	            "berat"            => $berat,
          	            "bobin"            => $bobin,
          	            "payung"           => $payung,
          	            "payung_kuning"    => $payungKuning,
                        "doubleSingle"     => $doubleSingle
                      );
        }
        $result = $this->Cutting_Model->updatePengambilanPotong($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailHistorySisa(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $result = $this->Cutting_Model->selectDetailHistorySisa($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editHistorySisa(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $berat = $this->input->post("berat");
      $payung = $this->input->post("payung");
      $payungKuning = $this->input->post("payungKuning");
      $bobin = $this->input->post("bobin");
      $doubleSingle = $this->input->post("doubleSingle");

      if(empty($idTransaksi) || $berat=="" || $payung=="" ||
         $payungKuning=="" || $bobin=="" || $doubleSingle==""
       ){
        $result = "Data Kosong";
      }else{
        $arrData = array("id"             => $idTransaksi,
                         "berat"          => $berat,
                         "bobin"          => $bobin,
                         "payung"         => $payung,
                         "payung_kuning"  => $payungKuning,
                         "doubleSingle"   => $doubleSingle);
        $result = $this->Cutting_Model->updateHistorySisa($arrData);
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDataForUpdateHasilTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Cutting_Model->selectDataForUpdateHasilTemp($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editHasilPotongTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $idTransaksiTSHP = $this->input->post("idTransaksiTSHP");
      $idUser = $this->session->userdata("fabricationIdUser");
      $ketBarang = $this->input->post("ketBarang");
      $ketMerek = $this->input->post("ketMerek");
      $tglRencana = $this->input->post("tglRencana");
      $tglJadi = date("Y-m-d");
      $merek = $this->input->post("merek");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $warnaPlastik = $this->input->post("warnaPlastik");
      // $arrCustomer = $this->input->post("arrCustomer");
      $arrLembar = array_column($this->input->post("arrLembar"),"value");
      $arrBerat = array_column($this->input->post("arrBerat"),"value");
      // $arrTebal = $this->input->post("arrTebal");
      // $arrUkuran = $this->input->post("arrUkuran");
      // $arrJnsGudang = $this->input->post("arrJnsGudang");
      // $arrStrip = $this->input->post("arrStrip");
      // $arrNoMesin = $this->input->post("arrNoMesin");
      $arrKdCutting = array_column($this->input->post("arrKdCutting"),"value");
      $arrKdGdHasil = array_column($this->input->post("arrKdGdHasil"),"value");
      $arrKdGdRoll = array_column($this->input->post("arrKdGdRoll"),"value");
      $beratBagian = $this->input->post("beratBagian");
      $bobinBagian = $this->input->post("bobinBagian");
      $payungBagian = $this->input->post("payungBagian");
      $payungKuningBagian = $this->input->post("payungKuningBagian");
      $beratBagianTumpuk = $this->input->post("beratBagianTumpuk");
      $bobinBagianTumpuk = $this->input->post("bobinBagianTumpuk");
      $payungBagianTumpuk = $this->input->post("payungBagianTumpuk");
      $payungKuningBagianTumpuk = $this->input->post("payungKuningBagianTumpuk");
      $beratSisaSemalam = $this->input->post("beratSisaSemalam");
      $bobinSisaSemalam = $this->input->post("bobinSisaSemalam");
      $payungSisaSemalam = $this->input->post("payungSisaSemalam");
      $payungKuningSisaSemalam = $this->input->post("payungKuningSisaSemalam");
      $beratSisaSemalamTumpuk = $this->input->post("beratSisaSemalamTumpuk");
      $bobinSisaSemalamTumpuk = $this->input->post("bobinSisaSemalamTumpuk");
      $payungSisaSemalamTumpuk = $this->input->post("payungSisaSemalamTumpuk");
      $payungKuningSisaSemalamTumpuk = $this->input->post("payungKuningSisaSemalamTumpuk");
      $beratPengambilan = $this->input->post("beratPengambilan");
      $bobinPengambilan = $this->input->post("bobinPengambilan");
      $payungPengambilan = $this->input->post("payungPengambilan");
      $payungKuningPengambilan = $this->input->post("payungKuningPengambilan");
      $beratPengambilanTumpuk = $this->input->post("beratPengambilanTumpuk");
      $bobinPengambilanTumpuk = $this->input->post("bobinPengambilanTumpuk");
      $payungPengambilanTumpuk = $this->input->post("payungPengambilanTumpuk");
      $payungKuningPengambilanTumpuk = $this->input->post("payungKuningPengambilanTumpuk");
      $beratSisaHariIni = $this->input->post("beratSisaHariIni");
      $bobinSisaHariIni = $this->input->post("bobinSisaHariIni");
      $payungSisaHariIni = $this->input->post("payungSisaHariIni");
      $payungKuningSisaHariIni = $this->input->post("payungKuningSisaHariIni");
      $beratSisaHariIniTumpuk = $this->input->post("beratSisaHariIniTumpuk");
      $bobinSisaHariIniTumpuk = $this->input->post("bobinSisaHariIniTumpuk");
      $payungSisaHariIniTumpuk = $this->input->post("payungSisaHariIniTumpuk");
      $payungKuningSisaHariIniTumpuk = $this->input->post("payungKuningSisaHariIniTumpuk");
      $hasilLembar = $this->input->post("hasilLembar");
      $hasilBeratBersih = $this->input->post("hasilBeratBersih");
      $hasilBeratKotor = $this->input->post("hasilBeratKotor");
      $beratApal = $this->input->post("beratApal");
      $jnsRollPipa = $this->input->post("jnsRollPipa");
      $payung = $this->input->post("payung");
      $payungKuning = $this->input->post("payungKuning");
      $bobin = $this->input->post("bobin");
      $shift = $this->input->post("shift");
      $keterangan = $this->input->post("keterangan");
      $rollPipa = $this->input->post("rollPipa");
      $plusMinus = $this->input->post("plusMinus");
      $kdGdRollTumpuk = $this->input->post("kdGdRollTumpuk");

      if( $idTransaksi == ""                   || $idUser == ""                        || $ketBarang == ""                     ||
          $ketMerek == ""                      || $tglRencana == ""                    || $tglJadi == ""                       ||
          $merek == ""                         || $jnsPermintaan == ""                 || $warnaPlastik == ""                  ||
          count($arrLembar) <= 0               || count($arrBerat) <= 0                || count($arrKdCutting) <= 0            ||
          count($arrKdGdHasil) <= 0            || count($arrKdGdRoll) <= 0             || $beratBagian == ""                   ||
          $bobinBagian == ""                   || $payungBagian == ""                  || $payungKuningBagian == ""            ||
          $beratBagianTumpuk == ""             || $bobinBagianTumpuk == ""             || $payungBagianTumpuk == ""            ||
          $payungKuningBagianTumpuk == ""      || $beratSisaSemalam == ""              || $bobinSisaSemalam == ""              ||
          $payungSisaSemalam == ""             || $payungKuningSisaSemalam == ""       || $beratSisaSemalamTumpuk == ""        ||
          $bobinSisaSemalamTumpuk == ""        || $payungSisaSemalamTumpuk == ""       || $payungKuningSisaSemalamTumpuk == "" ||
          $beratPengambilan == ""              || $bobinPengambilan == ""              || $payungPengambilan == ""             ||
          $payungKuningPengambilan == ""       || $beratPengambilanTumpuk == ""        || $bobinPengambilanTumpuk == ""        ||
          $payungPengambilanTumpuk == ""       || $payungKuningPengambilanTumpuk == "" || $beratSisaHariIni == ""              ||
          $bobinSisaHariIni == ""              || $payungSisaHariIni == ""             || $payungKuningSisaHariIni == ""       ||
          $beratSisaHariIniTumpuk == ""        || $bobinSisaHariIniTumpuk == ""        || $payungSisaHariIniTumpuk == ""       ||
          $payungKuningSisaHariIniTumpuk == "" || $hasilLembar == ""                   || $hasilBeratBersih == ""              ||
          $hasilBeratKotor == ""               || $beratApal == ""                     || $jnsRollPipa == ""                   ||
          $shift == ""                         || $keterangan == ""                    || $rollPipa == ""                      ||
          $plusMinus == ""                     || $kdGdRollTumpuk == ""
        ){
          if($payung == "" || $payungKuning == "" || $bobin == ""){
            echo "Data Kosong";
          }else{
            echo "Data Kosong";
          }
        }else{
          $data["THP"] = array("kd_hasil_potong"      => $idTransaksi,
                               "id_user"              => $idUser,
                               "tgl_rencana"          => $tglRencana,
                               "tgl_jadi"             => $tglJadi,
                               "hasil_lembar"         => $hasilLembar,
                               "hasil_berat_bersih"   => $hasilBeratBersih,
                               "hasil_berat_kotor"    => $hasilBeratKotor,
                               "jumlah_apal_global"   => $beratApal,
                               "jenis_roll_pipa"      => $jnsRollPipa,
                               "jumlah_payung"        => $payung,
                               "jumlah_payung_kuning" => $payungKuning,
                               "jumlah_bobin"         => $bobin,
                               "shift"                => $shift,
                               "keterangan"           => $keterangan,
                               "jumlah_roll_pipa"     => $rollPipa,
                               "plusminus"            => $plusMinus);
          $data["TSHP"] = array();
          if((count($arrKdCutting) == count($arrLembar)) &&
             (count($arrKdCutting) == count($arrBerat)) &&
             (count($arrKdCutting) == count($arrKdGdHasil)) &&
             (count($arrKdCutting) == count($arrKdGdRoll))
            ){
              if(strpos(strtoupper($ketBarang),"TUMPUK") !== FALSE || strpos(strtoupper($ketMerek),"TUMPUK") !== FALSE){
                for ($i=0; $i < count($arrKdCutting); $i++) {
                  array_push($data["TSHP"], array("id_transaksi" => $idTransaksiTSHP,
                                                  "kd_hasil_potong" => $idTransaksi,
                                                  "kd_potong" => $arrKdCutting[$i],
                                                  "kd_gd_hasil" => $arrKdGdHasil[$i],
                                                  "kd_gd_roll" => $arrKdGdRoll[$i],
                                                  "kd_gd_roll_tumpuk" => $kdGdRollTumpuk,
                                                  "jumlah_lembar" => str_replace(",","",$arrLembar[$i]),
                                                  "jumlah_berat" => str_replace(",","",$arrBerat[$i])));
                }
              }else{
                for ($i=0; $i < count($arrKdCutting); $i++) {
                  array_push($data["TSHP"], array("id_transaksi" => $idTransaksiTSHP,
                                                  "kd_hasil_potong" => $idTransaksi,
                                                  "kd_potong" => $arrKdCutting[$i],
                                                  "kd_gd_hasil" => $arrKdGdHasil[$i],
                                                  "kd_gd_roll" => $arrKdGdRoll[$i],
                                                  "jumlah_lembar" => str_replace(",","",$arrLembar[$i]),
                                                  "jumlah_berat" => str_replace(",","",$arrBerat[$i])));
                }
              }
            }

          if(strpos(strtoupper($ketBarang),"TUMPUK") !== FALSE || strpos(strtoupper($ketMerek),"TUMPUK") !== FALSE){
            $data["TPHP"] = array("kd_hasil_potong" => $idTransaksi,
                                  "berat_pengambilan_bagian" => $beratBagian,
                                  "bobin_pengambilan_bagian" => $bobinBagian,
                                  "payung_pengambilan_bagian" => $payungBagian,
                                  "payung_kuning_pengambilan_bagian" => $payungKuningBagian,
                                  "berat_sisa_semalam" => $beratSisaSemalam,
                                  "bobin_sisa_semalam" => $bobinSisaSemalam,
                                  "payung_sisa_semalam" => $payungSisaSemalam,
                                  "payung_kuning_sisa_semalam" => $payungKuningSisaSemalam,
                                  "berat_pengambilan_gudang" => $beratPengambilan,
                                  "bobin_pengambilan_gudang" => $bobinPengambilan,
                                  "payung_pengambilan_gudang" => $payungPengambilan,
                                  "payung_kuning_pengambilan_gudang" => $payungKuningPengambilan,
                                  "berat_sisa_hari_ini" => $beratSisaHariIni,
                                  "bobin_sisa_hari_ini" => $bobinSisaHariIni,
                                  "payung_sisa_hari_ini" => $payungSisaHariIni,
                                  "payung_kuning_sisa_hari_ini" => $payungKuningSisaHariIni,
                                  "berat_pengambilan_bagian_tumpuk" => $beratBagianTumpuk,
                                  "bobin_pengambilan_bagian_tumpuk" => $bobinBagianTumpuk,
                                  "payung_pengambilan_bagian_tumpuk" => $payungBagianTumpuk,
                                  "payung_kuning_pengambilan_bagian_tumpuk" => $payungKuningBagianTumpuk,
                                  "berat_sisa_semalam_tumpuk" => $beratSisaSemalamTumpuk,
                                  "bobin_sisa_semalam_tumpuk" => $bobinSisaSemalamTumpuk,
                                  "payung_sisa_semalam_tumpuk" => $payungSisaSemalamTumpuk,
                                  "payung_kuning_sisa_semalam_tumpuk" => $payungKuningSisaSemalamTumpuk,
                                  "berat_pengambilan_gudang_tumpuk" => $beratPengambilanTumpuk,
                                  "bobin_pengambilan_gudang_tumpuk" => $bobinPengambilanTumpuk,
                                  "payung_pengambilan_gudang_tumpuk" => $payungPengambilanTumpuk,
                                  "payung_kuning_pengambilan_gudang_tumpuk" => $payungKuningPengambilanTumpuk,
                                  "berat_sisa_hari_ini_tumpuk" => $beratSisaHariIniTumpuk,
                                  "bobin_sisa_hari_ini_tumpuk" => $bobinSisaHariIniTumpuk,
                                  "payung_sisa_hari_ini_tumpuk" => $payungSisaHariIniTumpuk,
                                  "payung_kuning_sisa_hari_ini_tumpuk" => $payungKuningSisaHariIniTumpuk);

            $data["TGR"] = array(array("kd_gd_roll" => $data["TSHP"][0]["kd_gd_roll"],
                                       "id_user" => $idUser,
                                       "jns_permintaan" => $jnsPermintaan,
                                       "tgl_transaksi" => $tglRencana,
                                       "bagian" => "POTONG",
                                       "keterangan_transaksi" => "KELUAR KE POTONG",
                                       "status_history" => "KELUAR",
                                       "keterangan_history" => "OPERATOR POTONG",
                                       "berat" => $beratPengambilan,
                                       "bobin" => $bobinPengambilan,
                                       "payung" => $payungPengambilan,
                                       "payung_kuning" => $payungKuningPengambilan,
                                       "shift" => $shift),
                                 array("kd_gd_roll" => $kdGdRollTumpuk,
                                       "id_user" => $idUser,
                                       "jns_permintaan" => $jnsPermintaan,
                                       "tgl_transaksi" => $tglRencana,
                                       "bagian" => "POTONG",
                                       "keterangan_transaksi" => "KELUAR KE POTONG",
                                       "status_history" => "KELUAR",
                                       "keterangan_history" => "OPERATOR POTONG",
                                       "berat" => $beratPengambilanTumpuk,
                                       "bobin" => $bobinPengambilanTumpuk,
                                       "payung" => $payungPengambilanTumpuk,
                                       "payung_kuning" => $payungKuningPengambilanTumpuk,
                                       "shift" => $shift)
                                );
          }else{
            $data["TPHP"] = array("kd_hasil_potong" => $idTransaksi,
                                  "berat_pengambilan_bagian" => $beratBagian,
                                  "bobin_pengambilan_bagian" => $bobinBagian,
                                  "payung_pengambilan_bagian" => $payungBagian,
                                  "payung_kuning_pengambilan_bagian" => $payungKuningBagian,
                                  "berat_sisa_semalam" => $beratSisaSemalam,
                                  "bobin_sisa_semalam" => $bobinSisaSemalam,
                                  "payung_sisa_semalam" => $payungSisaSemalam,
                                  "payung_kuning_sisa_semalam" => $payungKuningSisaSemalam,
                                  "berat_pengambilan_gudang" => $beratPengambilan,
                                  "bobin_pengambilan_gudang" => $bobinPengambilan,
                                  "payung_pengambilan_gudang" => $payungPengambilan,
                                  "payung_kuning_pengambilan_gudang" => $payungKuningPengambilan,
                                  "berat_sisa_hari_ini" => $beratSisaHariIni,
                                  "bobin_sisa_hari_ini" => $bobinSisaHariIni,
                                  "payung_sisa_hari_ini" => $payungSisaHariIni,
                                  "payung_kuning_sisa_hari_ini" => $payungKuningSisaHariIni,
                                  // "berat_pengambilan_bagian_tumpuk" => $beratBagianTumpuk,
                                  // "bobin_pengambilan_bagian_tumpuk" => $bobinBagianTumpuk,
                                  // "payung_pengambilan_bagian_tumpuk" => $payungBagianTumpuk,
                                  // "payung_kuning_pengambilan_bagian_tumpuk" => $payungKuningBagianTumpuk,
                                  // "berat_sisa_semalam_tumpuk" => $beratSisaSemalamTumpuk,
                                  // "bobin_sisa_semalam_tumpuk" => $bobinSisaSemalamTumpuk,
                                  // "payung_sisa_semalam_tumpuk" => $payungSisaSemalamTumpuk,
                                  // "payung_kuning_sisa_semalam_tumpuk" => $payungKuningSisaSemalamTumpuk,
                                  // "berat_pengambilan_gudang_tumpuk" => $beratPengambilanTumpuk,
                                  // "bobin_pengambilan_gudang_tumpuk" => $bobinPengambilanTumpuk,
                                  // "payung_pengambilan_gudang_tumpuk" => $payungPengambilanTumpuk,
                                  // "payung_kuning_pengambilan_gudang_tumpuk" => $payungKuningPengambilanTumpuk,
                                  // "berat_sisa_hari_ini_tumpuk" => $beratSisaHariIniTumpuk,
                                  // "bobin_sisa_hari_ini_tumpuk" => $bobinSisaHariIniTumpuk,
                                  // "payung_sisa_hari_ini_tumpuk" => $payungSisaHariIniTumpuk,
                                  // "payung_kuning_sisa_hari_ini_tumpuk" => $payungKuningSisaHariIniTumpuk
                                );
            $data["TGR"] = array(array("kd_gd_roll" => $data["TSHP"][0]["kd_gd_roll"],
                                       "id_user" => $idUser,
                                       "jns_permintaan" => $jnsPermintaan,
                                       "tgl_transaksi" => $tglRencana,
                                       "bagian" => "POTONG",
                                       "keterangan_transaksi" => "KELUAR KE POTONG",
                                       "status_history" => "KELUAR",
                                       "keterangan_history" => "OPERATOR POTONG",
                                       "berat" => $beratPengambilan,
                                       "bobin" => $bobinPengambilan,
                                       "payung" => $payungPengambilan,
                                       "payung_kuning" => $payungKuningPengambilan,
                                       "shift" => $shift));
          }
          $result = $this->Cutting_Model->updateHasilCuttingTemp($data);
          echo $result;
        }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editStatusPrint(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $stsPrint = $this->input->post("stsPrint");

      $data = array("kd_potong" => $kdPotong,
                    "sts_print" => $stsPrint);
      $result = $this->Cutting_Model->updateStatusPrint($data);
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

  //  public function getDataRencanaPpic_Konversi(){
  //   $isLogin = $this->isLogin();
  //   if($isLogin){
  //     $kdPpic = $this->input->post("kdPpic");
  //     $result = $this->Cutting_Model->selectDataRencanaPpic_Konversi($kdPpic);
  //     echo $result;
  //   }else{
  //     echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
  //     redirect("_main/main","refresh");
  //   }
  // }

  function countKirimanBalikGudangHasil()
  {
    $result = $this->Cutting_Model->countKirimanBalikGudangHasil();
    echo $result;
  }

  function getDataKirimanBalikGudangHasil()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cutting_Model->getDataKirimanBalikGudangHasil();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListKirimanBalikPerId()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Cutting_Model->getListKirimanBalikPerId($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function kirimUlangKiriman(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["id"]    = $this->input->post("id");
      $data["berat"] = $this->input->post("berat");
      $data["lembar"]= $this->input->post("lembar");
      $result = $this->Cutting_Model->kirimUlangKiriman($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailDataSisaPengambilan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Cutting_Model->selectDetailDataSisaPengambilan($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetaiRencanaForEdit(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $result = $this->Cutting_Model->selectDetailRencanaPotongPending($kdPotong);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editRencana(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kdPpic");
      $kdPotong = $this->input->post("kdPotong");
      $tglRencana = $this->input->post("tglRencana");
      $noMesin = $this->input->post("noMesin");
      $jumlahMesin = $this->input->post("jumlahMesin");
      $kdGdHasil = $this->input->post("kdGdHasil");
      $kdGdRoll = $this->input->post("kdGdRoll");
      $nmCust = $this->input->post("nmCust");
      $tebal = $this->input->post("tebal");
      $ketMerek = $this->input->post("ketMerek");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $satuan = $this->input->post("satuan");
      $shift = $this->input->post("shift");
      $beratRencana = $this->input->post("beratRencana");
      $keterangan = $this->input->post("keterangan");
      $warnaStrip = $this->input->post("warnaStrip");

      if(empty($kdPotong) || empty($tglRencana) || $noMesin=="" ||
         $jumlahMesin=="" || empty($nmCust) || $tebal=="" ||
         $jumlahPermintaan=="" || empty($satuan) || empty($shift) ||
         empty($warnaStrip)
       ){
         echo "Data Kosong";
       }else{
         if(empty($kdPpic)){
           if(empty($kdGdHasil)){
             $data = array("kd_potong"        => $kdPotong,
                           "tgl_rencana"      => $tglRencana,
                           "no_mesin"         => $noMesin,
                           "jml_mesin"        => $jumlahMesin,
                           "customer"         => $nmCust,
                           "tebal"            => $tebal,
                           "ket_merek"        => $ketMerek,
                           "jml_permintaan"   => $jumlahPermintaan,
                           "stok_permintaan"  => $jumlahPermintaan,
                           "satuan"           => $satuan,
                           "shift"            => $shift,
                           "ket_barang"       => $keterangan,
                           "strip"            => $warnaStrip,
                           "berat"            => $beratRencana);
           }else{
             $data = array("kd_potong"        => $kdPotong,
                           "kd_gd_roll"       => $kdGdRoll,
                           "kd_gd_hasil"      => $kdGdHasil,
                           "tgl_rencana"      => $tglRencana,
                           "no_mesin"         => $noMesin,
                           "jml_mesin"        => $jumlahMesin,
                           "customer"         => $nmCust,
                           "tebal"            => $tebal,
                           "ket_merek"        => $ketMerek,
                           "jml_permintaan"   => $jumlahPermintaan,
                           "stok_permintaan"  => $jumlahPermintaan,
                           "satuan"           => $satuan,
                           "shift"            => $shift,
                           "ket_barang"       => $keterangan,
                           "strip"            => $warnaStrip,
                           "berat"            => $beratRencana);
           }
         }else{
           if(empty($kdGdHasil)){
             $data = array("kd_potong"        => $kdPotong,
                           "kd_ppic"          => $kdPpic,
                           "tgl_rencana"      => $tglRencana,
                           "no_mesin"         => $noMesin,
                           "jml_mesin"        => $jumlahMesin,
                           "customer"         => $nmCust,
                           "tebal"            => $tebal,
                           "ket_merek"        => $ketMerek,
                           "jml_permintaan"   => $jumlahPermintaan,
                           "stok_permintaan"  => $jumlahPermintaan,
                           "satuan"           => $satuan,
                           "shift"            => $shift,
                           "ket_barang"       => $keterangan,
                           "strip"            => $warnaStrip,
                           "berat"            => $beratRencana);
           }else{
             $data = array("kd_potong"        => $kdPotong,
                           "kd_ppic"          => $kdPpic,
                           "kd_gd_roll"       => $kdGdRoll,
                           "kd_gd_hasil"      => $kdGdHasil,
                           "tgl_rencana"      => $tglRencana,
                           "no_mesin"         => $noMesin,
                           "jml_mesin"        => $jumlahMesin,
                           "customer"         => $nmCust,
                           "tebal"            => $tebal,
                           "ket_merek"        => $ketMerek,
                           "jml_permintaan"   => $jumlahPermintaan,
                           "stok_permintaan"  => $jumlahPermintaan,
                           "satuan"           => $satuan,
                           "shift"            => $shift,
                           "ket_barang"       => $keterangan,
                           "strip"            => $warnaStrip,
                           "berat"            => $beratRencana);
           }
         }
       }
       $result = $this->Cutting_Model->editRencana($data);
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

  public function getGenerateInputHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Code"] = $this->Cutting_Model->generateInputHasilCode();
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getUkuranEditHasilCutting($param,$param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $key = $this->input->get("q");
      if(empty($key)){
        $data = array("jnsPermintaan" => $param,
                      "Tanggal" => $param2,
                      "Key" => "");
      }else{
        $data = array("jnsPermintaan" => $param,
                      "Tanggal" => $param2,
                      "Key" => $key);
      }
      $result = $this->Cutting_Model->selectUkuranEditHasilCutting($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestorePengambilanPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      $idUser = $this->session->userdata("fabricationIdUser");
      $data = array("idTransaksi" => $idTransaksi,
                    "deleted" => $deleted,
                    "idUser" => $idUser);
      $result = $this->Cutting_Model->updateDeleteAndRestorePengambilanPotong($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestoreSisaPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      $idUser = $this->session->userdata("fabricationIdUser");
      $data = array("idTransaksi" => $idTransaksi,
                    "deleted" => $deleted,
                    "idUser" => $idUser);
      $result = $this->Cutting_Model->updateDeleteAndRestoreSisaPotong($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
}
?>
