<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MX_Controller{
  public function __construct(){
		parent::__construct();
		$this->load->model("Extruder_Model");
	}

  public function index(){
    $isLogin = $this->isLogin();
    if($isLogin){
       $data["Data"] = array("Title"=>"RENCANA KERJA DARI PPIC ");
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
       ($this->session->userdata("fabricationGroup")=="extruder"||
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
          array("Content"=>"Data Rencana PPIC","Link"=>"_extruder/main","Name"=>"Data_Rencana_PPIC","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Data_Rencana_PPIC"),
          array("Content"=>"Data Rencana Mandor","Link"=>"_extruder/main/data_rencana_mandor","Name"=>"Data_Rencana_Mandor","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Data_Rencana_Mandor"),
          array("Content"=>"Laporan Rencana Mandor","Link"=>"_extruder/main/laporan_rencana_mandor","Name"=>"Laporan_Rencana_Mandor","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Laporan_Rencana_Mandor"),
          array("Content"=>"Hasil Extruder","Link"=>"_extruder/main/hasil_extruder","Name"=>"Hasil_Extruder","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Hasil_Extruder"),
          array("Content"=>"Kirim Hasil Extruder","Link"=>"_extruder/main/kirim_hasil_extruder","Name"=>"Kirim_Hasil_Extruder","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Kirim_Hasil_Extruder"),
          array("Content"=>"Rencana Kerja Mandor (Selesai)","Link"=>"_extruder/main/rencana_kerja_mandor_selesai","Name"=>"Rencana_Kerja_Mandor_Selesai","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Rencana_Kerja_Mandor_Selesai"),
          array("Content"=>"Data Bon Roll Polos","Link"=>"_extruder/main/data_bon_roll_polos","Name"=>"Data_Bon_Roll_Polos","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Data_Bon_Roll_Polos"),
          array("Content"=>"Detail Bon Roll Polos","Link"=>"_extruder/main/detail_bon_roll_polos","Name"=>"Detail_Bon_Roll_Polos","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Detail_Bon_Roll_Polos"),
          array("Content"=>"Data Bon Apal","Link"=>"_extruder/main/data_bon_apal","Name"=>"Data_Bon_Apal","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Data_Bon_Apal"),
          array("Content"=>"Bahan Baku Lokal","Link"=>"_extruder/main/bahan_baku_lokal","Name"=>"Bahan_Baku_Lokal","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Bahan_Baku_Lokal"),
          array("Content"=>"Bahan Baku Export","Link"=>"_extruder/main/bahan_baku_export","Name"=>"Bahan_Baku_Export","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Bahan_Baku_Export"),
          array("Content"=>"Kembalian Bahan Baku","Link"=>"_extruder/main/kembalian_bahan_baku","Name"=>"Kembalian_Bahan_Baku","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Kembalian_Bahan_Baku"),
          array("Content"=>"Biji Warna","Link"=>"_extruder/main/biji_warna","Name"=>"Biji_Warna","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Biji_Warna"),
          array("Content"=>"Kembalian Biji Warna","Link"=>"_extruder/main/kembalian_biji_warna","Name"=>"Kembalian_Biji_Warna","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Kembalian_Biji_Warna"),
          array("Content"=>"Laporan Bahan Baku","Link"=>"_extruder/main/laporan_bahan_baku","Name"=>"Laporan_Bahan_Baku","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Laporan_Bahan_Baku"),
          array("Content"=>"Laporan Ke Pak Amin","Link"=>"_extruder/main/laporan_ke_pak_amin","Name"=>"Laporan_Ke_Pak_Amin","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Laporan_Ke_Pak_Amin"),
          array("Content"=>"Barang Yang Diambil Potong","Link"=>"_extruder/main/barang_yang_diambil_potong","Name"=>"Barang_Yang_Diambil_Potong","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Barang_Yang_Diambil_Potong"),
          array("Content"=>"Barang Yang Diambil Cetak","Link"=>"_extruder/main/barang_yang_diambil_cetak","Name"=>"Barang_Yang_Diambil_Cetak","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Barang_Yang_Diambil_Cetak")
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
      $data["Data"] = array("Title"=>"RENCANA KERJA MANDOR EXTRUDER ");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_data_rencana_extruder",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function laporan_rencana_mandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"LAPORAN RENCANA MANDOR");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_laporan_rencana_mandor",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function hasil_extruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"HASIL EXTRUDER");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_hasil_extruder",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function kirim_hasil_extruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"KIRIM HASIL EXTRUDER");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_kirim_hasil_extruder",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function rencana_kerja_mandor_selesai(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"RENCANA KERJA MANDOR(SELESAI)");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_rencana_kerja_mandor_selesai",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function data_bon_roll_polos(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"DATA BON ROLL POLOS");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_data_bon_roll_polos",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function detail_bon_roll_polos(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"DETAIL BON ROLL POLOS");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_detail_bon_roll_polos",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function data_bon_apal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"DATA BON APAL");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_data_bon_apal",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bahan_baku_lokal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"BAHAN BAKU LOKAL");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_bahan_baku_lokal",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bahan_baku_export(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"BAHAN BAKU EXPORT");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_bahan_baku_export",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function kembalian_bahan_baku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"KEMBALIAN BAHAN BAKU");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_kembalian_bahan_baku",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function biji_warna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"BIJI WARNA");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_biji_warna",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function kembalian_biji_warna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"KEMBALIAN BIJI WARNA");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_kembalian_biji_warna",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function laporan_bahan_baku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"LAPORAN BAHAN BAKU");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_laporan_bahan_baku",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function laporan_ke_pak_amin(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"LAPORAN KE PAK AMIN");
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

  public function barang_yang_diambil_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"BARANG YANG DIAMBIL POTONG");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_pengambilan_potong",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function barang_yang_diambil_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"BARANG YANG DIAMBIL CETAK");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_pengambilan_cetak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function input_hasil($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"INPUT HASIL");
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

  public function input_hasil_tertinggal($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"INPUT HASIL");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_input_hasil_tertinggal",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function buat_rencana_extruder($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"BUAT RENCANA KERJA EXTRUDER");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_buat_rencana_mandor",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGenerateExtruderCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Code"] = $this->Extruder_Model->generateExtruderCode();
      echo json_encode($data);
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
        $result = $this->Extruder_Model->selectComboBoxValueGudangRoll($data);
      }else{
        $data = array("JnsPermintaan" => $param,
                      "Key" => $Key);
        $result = $this->Extruder_Model->selectComboBoxValueGudangRollSearch($data);
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListDataRencanaPPIC(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      if(empty($tglAwal) || empty($tglAkhir)){
        $data = array("tglAwal" => "",
                      "tglAkhir" => "");
      }else{
        $data = array("tglAwal" => $tglAwal,
                      "tglAkhir" => $tglAkhir);
      }
      $result = $this->Extruder_Model->selectListDataRencanaPPIC($data);
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
      $result = $this->Extruder_Model->selectDetailRencanaPPIC($kdPpic);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKonversiBerat(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kdPpic");
      $satuanKilo = $this->input->post("satuanKilo");

      if(empty($kdPpic) || $satuanKilo==""){
        echo "Data Kosong";
      }else{
        $data = array("kd_ppic" => $kdPpic,
                      "satuan_kilo" => $satuanKilo,
                      "sisa" => $satuanKilo);
        $result = $this->Extruder_Model->updateRencanaPpic($data);
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

  public function saveStatusPengerjaan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kdPpic");
      $statusPengerjaan = $this->input->post("statusPengerjaan");
      if(empty($kdPpic) || empty($statusPengerjaan)){
        echo "Data Kosong";
      }else{
        $data = array("kd_ppic" => $kdPpic,
                      "sts_pengerjaan" => $statusPengerjaan);
        $result = $this->Extruder_Model->updateRencanaPpic($data);
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

  public function getListRencanaExtruderPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->selectListRencanaExtruderPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListRencanaExtruderSusulanPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->selectListRencanaExtruderSusulanPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueMesin(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->selectComboBoxValueMesin();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAddRencanaExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdExtruder = $this->input->post("kdExtruder");#
      $kdPpic = $this->input->post("kdPpic");##
      $kdGdRoll = $this->input->post("kdGdRoll");##
      $kdMesin = $this->input->post("kdMesin");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $nmCust = $this->input->post("nmCust");#
      $jnsMesin = $this->input->post("jnsMesin");#
      $merek = $this->input->post("merek");#
      $ukuran = $this->input->post("ukuran");#
      $warna = $this->input->post("warna");#
      $tebal = $this->input->post("tebal");#
      $jmlPermintaan = $this->input->post("jumlahPermintaan");#
      $stokPermintaan = $this->input->post("jumlahPermintaan");#
      $strip = $this->input->post("strip");#
      $tglRencana = $this->input->post("tglRencana");#
      $motoran = $this->input->post("motoran");
      $extruder = $this->input->post("extruder");
      $berat = $this->input->post("berat");#
      $bahan = $this->input->post("bahan");#
      $prioritas = $this->input->post("prioritas");

      if(empty($kdExtruder)||empty($kdPpic)||empty($kdGdRoll)||empty($kdMesin)||empty($idUser)||
         empty($nmCust)||empty($merek)||empty($ukuran)||empty($warna)||$tebal==""||
         empty($jmlPermintaan)||empty($stokPermintaan)||empty($strip)||empty($tglRencana)||
         $berat==""||$bahan==""
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_extruder"      => $kdExtruder,
                       "kd_ppic"          => $kdPpic,
                       "kd_gd_roll"       => $kdGdRoll,
                       "kd_mesin"         => $kdMesin,
                       "id_user"          => $idUser,
                       "nm_cust"          => $nmCust,
                       "merek"            => $merek,
                       "ukuran"           => $ukuran,
                       "warna"            => $warna,
                       "tebal"            => $tebal,
                       "jml_permintaan"   => $jmlPermintaan,
                       "stok_permintaan"  => $stokPermintaan,
                       "strip"            => $strip,
                       "tgl_rencana"      => $tglRencana,
                       "sts_pengerjaan"   => "PENDING",
                       "motoran"          => $motoran,
                       "extruder"         => $extruder,
                       "berat"            => $berat,
                       "bahan"            => $bahan,
                       "prioritas"        => $prioritas,
                       "jns_mesin"        => $jnsMesin);
        $result = $this->Extruder_Model->insertRencanaExtruder($data);
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

  public function saveAddRencanaExtruderSusulan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdExtruder = $this->input->post("kdExtruder");#
      $kdGdRoll = $this->input->post("kdGdRoll");##
      $kdMesin = $this->input->post("kdMesin");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $nmCust = $this->input->post("nmCust");#
      $jnsMesin = $this->input->post("jnsMesin");#
      $merek = $this->input->post("merek");#
      $ukuran = $this->input->post("ukuran");#
      $warna = $this->input->post("warna");#
      $tebal = $this->input->post("tebal");#
      $jmlPermintaan = $this->input->post("jumlahPermintaan");#
      $stokPermintaan = $this->input->post("jumlahPermintaan");#
      $strip = $this->input->post("strip");#
      $tglRencana = date("Y-m-d");#
      $motoran = $this->input->post("motoran");
      $extruder = $this->input->post("extruder");
      $ketMerek = $this->input->post("ketMerek");
      $berat = $this->input->post("berat");#
      $bahan = $this->input->post("bahan");#
      $prioritas = $this->input->post("prioritas");

      if(empty($kdExtruder)||empty($kdGdRoll)||empty($kdMesin)||empty($idUser)||
         empty($nmCust)||empty($merek)||empty($ukuran)||empty($warna)||empty($tebal)||
         empty($jmlPermintaan)||empty($stokPermintaan)||empty($strip)||empty($tglRencana)||empty($bahan)
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_extruder"      => $kdExtruder,
                       "kd_ppic"          => $kdPpic,
                       "kd_gd_roll"       => $kdGdRoll,
                       "kd_mesin"         => $kdMesin,
                       "id_user"          => $idUser,
                       "nm_cust"          => $nmCust,
                       "merek"            => $merek,
                       "ukuran"           => $ukuran,
                       "warna"            => $warna,
                       "tebal"            => $tebal,
                       "jml_permintaan"   => $jmlPermintaan,
                       "stok_permintaan"  => $stokPermintaan,
                       "strip"            => $strip,
                       "tgl_rencana"      => $tglRencana,
                       "sts_pengerjaan"   => "PENDING",
                       "motoran"          => $motoran,
                       "extruder"         => $extruder,
                       "ket_merek"        => $ketMerek,
                       "berat"            => $berat,
                       "bahan"            => $bahan,
                       "prioritas"        => $prioritas,
                       "jns_mesin"        => $jnsMesin);
        $result = $this->Extruder_Model->insertRencanaExtruder($data);
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

  public function getDetailRencanaExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdExtruder = $this->input->post("kdExtruder");
      $result = $this->Extruder_Model->selectDetailRencanaExtruder($kdExtruder);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editRencanaExtruderPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdExtruder = $this->input->post("kdExtruder");#
      $kdPpic = $this->input->post("kdPpic");##
      $kdGdRoll = $this->input->post("kdGdRoll");##
      $kdMesin = $this->input->post("kdMesin");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $nmCust = $this->input->post("nmCust");#
      $jnsMesin = $this->input->post("jnsMesin");#
      $merek = $this->input->post("merek");#
      $ukuran = $this->input->post("ukuran");#
      $warna = $this->input->post("warna");#
      $tebal = $this->input->post("tebal");#
      $jmlPermintaan = $this->input->post("jumlahPermintaan");#
      $stokPermintaan = $this->input->post("jumlahPermintaan");#
      $strip = $this->input->post("strip");#
      $tglRencana = $this->input->post("tglRencana");#
      $motoran = $this->input->post("motoran");
      $extruder = $this->input->post("extruder");
      $berat = $this->input->post("berat");#
      $bahan = $this->input->post("bahan");#
      $prioritas = $this->input->post("prioritas");

      if(empty($kdExtruder)||empty($kdMesin)||empty($idUser)||
         empty($nmCust)||empty($merek)||empty($ukuran)||empty($warna)||$tebal==""||
         $jmlPermintaan==""||$stokPermintaan==""||empty($strip)||empty($tglRencana)||
         $berat==""||empty($bahan)
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_extruder"      => $kdExtruder,
                       "kd_mesin"         => $kdMesin,
                       "id_user"          => $idUser,
                       "nm_cust"          => $nmCust,
                       "merek"            => $merek,
                       "ukuran"           => $ukuran,
                       "warna"            => $warna,
                       "tebal"            => $tebal,
                       "jml_permintaan"   => $jmlPermintaan,
                       "stok_permintaan"  => $stokPermintaan,
                       "strip"            => $strip,
                       "tgl_rencana"      => $tglRencana,
                       "sts_pengerjaan"   => "PENDING",
                       "motoran"          => $motoran,
                       "extruder"         => $extruder,
                       "berat"            => $berat,
                       "bahan"            => $bahan,
                       "prioritas"        => $prioritas,
                       "jns_mesin"        => $jnsMesin);
        $result = $this->Extruder_Model->updateRencanaExtruder($data);
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

  public function editRencanaExtruderSusulanPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdExtruder = $this->input->post("kdExtruder");#
      $kdGdRoll = $this->input->post("kdGdRoll");##
      $kdMesin = $this->input->post("kdMesin");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $nmCust = $this->input->post("nmCust");#
      $jnsMesin = $this->input->post("jnsMesin");#
      $merek = $this->input->post("merek");#
      $ukuran = $this->input->post("ukuran");#
      $warna = $this->input->post("warna");#
      $tebal = $this->input->post("tebal");#
      $jmlPermintaan = $this->input->post("jumlahPermintaan");#
      $stokPermintaan = $this->input->post("jumlahPermintaan");#
      $strip = $this->input->post("strip");#
      $tglRencana = date("Y-m-d");#
      $motoran = $this->input->post("motoran");
      $extruder = $this->input->post("extruder");
      $ketMerek = $this->input->post("ketMerek");
      $berat = $this->input->post("berat");#
      $bahan = $this->input->post("bahan");#
      $prioritas = $this->input->post("prioritas");

      if(empty($kdExtruder)||empty($kdMesin)||empty($idUser)||
         empty($nmCust)||empty($ukuran)||empty($tebal)||
         empty($jmlPermintaan)||empty($stokPermintaan)||empty($strip)||empty($tglRencana)||empty($bahan)
       ){
         echo "Data Kosong";
       }else{
         if(empty($kdGdRoll)){
           $data = array("kd_extruder"      => $kdExtruder,
                         "kd_mesin"         => $kdMesin,
                         "id_user"          => $idUser,
                         "nm_cust"          => $nmCust,
                         "ukuran"           => $ukuran,
                         "tebal"            => $tebal,
                         "jml_permintaan"   => $jmlPermintaan,
                         "stok_permintaan"  => $stokPermintaan,
                         "strip"            => $strip,
                         "tgl_rencana"      => $tglRencana,
                         "sts_pengerjaan"   => "PENDING",
                         "motoran"          => $motoran,
                         "extruder"         => $extruder,
                         "ket_merek"        => $ketMerek,
                         "berat"            => $berat,
                         "bahan"            => $bahan,
                         "prioritas"        => $prioritas,
                         "jns_mesin"        => $jnsMesin);
         }else{
           $data = array("kd_extruder"      => $kdExtruder,
                         "kd_gd_roll"       => $kdGdRoll,
                         "kd_mesin"         => $kdMesin,
                         "id_user"          => $idUser,
                         "nm_cust"          => $nmCust,
                         "merek"            => $merek,
                         "ukuran"           => $ukuran,
                         "warna"            => $warna,
                         "tebal"            => $tebal,
                         "jml_permintaan"   => $jmlPermintaan,
                         "stok_permintaan"  => $stokPermintaan,
                         "strip"            => $strip,
                         "tgl_rencana"      => $tglRencana,
                         "sts_pengerjaan"   => "PENDING",
                         "motoran"          => $motoran,
                         "extruder"         => $extruder,
                         "ket_merek"        => $ketMerek,
                         "berat"            => $berat,
                         "bahan"            => $bahan,
                         "prioritas"        => $prioritas,
                         "jns_mesin"        => $jnsMesin);
         }
        $result = $this->Extruder_Model->updateRencanaExtruder($data);
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

  public function deleteAndRestoreRencanaExtruderPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdExtruder = $this->input->post("kdExtruder");
      $deleted = $this->input->post("deleted");
      if(empty($kdExtruder) || empty($deleted)){
        echo "Data Kosong";
      }else{
        $data = array("kd_extruder" => $kdExtruder,
                      "deleted" => $deleted);
        $result = $this->Extruder_Model->updateDeleteAndRestoreRencanaExtruder($data);
        if($result) {
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

  public function saveRencanaExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrData = json_decode($this->Extruder_Model->selectListRencanaExtruderPending(),TRUE);
      $jumlahData = count($arrData);
      $jumlahSuccess = 0;
      if($jumlahData <= 0){
        echo "Data Kosong";
      }else{
        foreach ($arrData as $arrValue) {
          $data = array("kd_extruder" => $arrValue["kd_extruder"],
                        "kd_ppic" => $arrValue["kd_ppic"],
                        "sts_pengerjaan" => "PROGRESS");
          $booleanResult = $this->Extruder_Model->updateStatusRencana($data);
          if($booleanResult){
            $jumlahSuccess++;
          }else{
            break;
          }
        }
      }
      if($jumlahSuccess == $jumlahData){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveRencanaExtruderSusulan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrData = json_decode($this->Extruder_Model->selectListRencanaExtruderSusulanPending(),TRUE);
      $jumlahData = count($arrData);
      $jumlahSuccess = 0;
      if($jumlahData <= 0){
        echo "Data Kosong";
      }else{
        foreach ($arrData as $arrValue) {
          $data = array("kd_extruder" => $arrValue["kd_extruder"],
                        "sts_pengerjaan" => "PROGRESS");
          $booleanResult = $this->Extruder_Model->updateRencanaExtruder($data);
          if($booleanResult){
            $jumlahSuccess++;
          }else{
            break;
          }
        }
      }
      if($jumlahSuccess == $jumlahData){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListRencanaExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $stsPengerjaan = $this->input->post("stsPengerjaan");
      $jnsMesin = $this->input->post("jnsMesin");
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      if(empty($stsPengerjaan)){
        echo "Data Kosong";
      }else{
        if(empty($tglAwal) && empty($tglAkhir)){
          $data = array("sts_pengerjaan" => $stsPengerjaan,
                        "jns_mesin" => $jnsMesin);
        }else{
          $data = array("sts_pengerjaan" => $stsPengerjaan,
                        "jns_mesin" => $jnsMesin,
                        "tgl_awal" => $tglAwal,
                        "tgl_akhir" => $tglAkhir);
        }
        $result = $this->Extruder_Model->selectListRencanaExtruder($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editStatusRencanaExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdExtruder = $this->input->post("kodeExtruder");
      $stsPengerjaan = $this->input->post("stsPengerjaan");
      $kdPpic = $this->input->post("kdPpic");
      $idUser = $this->session->userdata("fabricationIdUser");
      if(empty($kdExtruder) || empty($stsPengerjaan)){
        echo "Data Kosong";
      }else{
        $data = array("kd_extruder" => $kdExtruder,
                      "sts_pengerjaan" => $stsPengerjaan,
                      "id_user" => $idUser,
                      "kd_ppic" => $kdPpic);
        $result = $this->Extruder_Model->updateStatusRencanaExtruder($data);
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

  public function editGantiMesin(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdExtruder = $this->input->post("kdExtruder");
      $kdMesin = $this->input->post("kdMesin");
      $jnsMesin = $this->input->post("jnsMesin");

      if(empty($kdExtruder) || empty($kdMesin) || empty($jnsMesin)){
        echo "Data Kosong";
      }else{
        $data = array("kd_extruder" => $kdExtruder,
                      "kd_mesin" => $kdMesin,
                      "jns_mesin" => $jnsMesin);
        $result = $this->Extruder_Model->updateRencanaExtruder($data);
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

  public function getComboBoxValueBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $warna = $this->input->post("warna");
      $result = $this->Extruder_Model->selectComboBoxValueGudangBahan(array("jenis"=>"BIJI WARNA", "warna"=>$warna));
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getRencanaExtruderUntukInputHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Extruder_Model->selectRencanaExtruderUntukInputHasil($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveHasilExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdExtruder = $this->input->post("kdExtruder");#
      $kdGdRoll = $this->input->post("kdGdRoll");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $warnaPlastik = $this->input->post("warnaPlastik");#
      $tglPengerjaan = $this->input->post("tglPengerjaan");#
      $tglJadi = date("Y-m-d");#
      $noMesin = $this->input->post("noMesin");
      $merek = $this->input->post("merek");#
      $jenisBarang = $this->input->post("jnsBarang");#
      $jenisPermintaan = $this->input->post("jnsPermintaan");#
      $bijiWarna = $this->input->post("bijiWarna");#
      $namaBijiWarna = $this->input->post("namaBijiWarna");
      $komposisi = $this->input->post("komposisi");
      $keterangan = $this->input->post("keterangan");#
      $ketMerek = $this->input->post("ketMerek");
      $ukuran = $this->input->post("ukuran");#
      $tebal = $this->input->post("tebal");#
      $berat = $this->input->post("berat");#
      $strip = $this->input->post("strip");#
      $jenisRoll = $this->input->post("jenisRoll");#
      $shift = $this->input->post("shift");#
      $hasil = $this->input->post("hasil");#
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $jumlahTransaksiSuccess = 0;
      $jumlahBijiWarna = 0;
      if(empty($kdExtruder)      || empty($kdGdRoll)      || empty($idUser)          ||
         empty($warnaPlastik)    || empty($tglPengerjaan) || empty($tglJadi)         ||
         empty($merek)           || empty($jenisBarang)   || empty($jenisPermintaan) ||
         empty($bijiWarna)       || $komposisi==""        || empty($keterangan)      ||
         empty($ukuran)          || $strip==""            || $hasil==""            || empty($jenisRoll)
       ){
         echo "Data Kosong";
       }else{
         $arrQuote = array("'",'"');
         $explodePanjang = explode("x",$ukuran);
         $panjang = str_replace($arrQuote,"in",$explodePanjang[0]);
         switch ($jenisRoll){
           case "BOBIN"          : $panjangPlastik = str_replace(",",".",$this->input->post("panjangPlastik"));
                                   $doubleSingle = $this->input->post("doubleSingle");
                                   $rumusRoll = $this->input->post("rumusRoll");
                                   $jumlahBobin = $this->input->post("jumlahBobin");
                                   $payung = 0;
                                   $payungKuning = 0;
                                   if(substr_count(strtoupper($ketMerek), "PON") > 0) { #Check Jenis Ukuran PON / Bukan
                                     $arrPanjangPlastik = explode("+",$panjangPlastik);
                                     if(count($arrPanjangPlastik) == 2){ #untuk memisahkan ukuran lipatan atau bukan
                                       if(floatval($arrPanjangPlastik[0]) >= 20 && floatval($arrPanjangPlastik[0]) < 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + 5;
                                       }else if(floatval($arrPanjangPlastik[0]) >= 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + 5.5;
                                       }else{
                                         $TPanjangPlastik = 0;
                                       }
                                     }else{
                                       if(floatval($arrPanjangPlastik[0]) >= 20 && floatval($arrPanjangPlastik[0]) < 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + 5;
                                       }else if(floatval($arrPanjangPlastik[0]) >= 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + 5.5;
                                       }else{
                                         $TPanjangPlastik = 0;
                                       }
                                     }
                                   }else{
                                     if(strpos($panjangPlastik,"+") === FALSE){
                                       if(strpos($panjangPlastik,"in") !== FALSE){
                                         $TPanjangPlastik = floatval($panjangPlastik) * 2.54;
                                       }else{
                                         $TPanjangPlastik = floatval($panjangPlastik);
                                       }
                                     }else{
                                       if(strpos($panjangPlastik,"in") !== FALSE){
                                         $arrPanjangPlastik = explode("+",$panjangPlastik);
                                         switch (count($arrPanjangPlastik)) {
                                           case 2: $TPanjangPlastik = (floatval($arrPanjangPlastik[0]) * 2.54) + floatval($arrPanjangPlastik[1]);
                                                   break;
                                           case 3: $TPanjangPlastik = (floatval($arrPanjangPlastik[0]) * 2.54) + (floatval($arrPanjangPlastik[1]) * 2.54) + floatval($arrPanjangPlastik[2]);
                                                   break;

                                           default: $TPanjangPlastik = floatval($arrPanjangPlastik) * 2.54;
                                             break;
                                         }
                                       }else{
                                         $arrPanjangPlastik = explode("+",$panjangPlastik);
                                         switch (count($arrPanjangPlastik)) {
                                           case 2: $TPanjangPlastik = floatval($arrPanjangPlastik[0])+ floatval($arrPanjangPlastik[1]);
                                                   break;
                                           case 3: $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + floatval($arrPanjangPlastik[2]);
                                                   break;

                                           default: $TPanjangPlastik = floatval($arrPanjangPlastik);
                                             break;
                                         }
                                       }
                                     }
                                   }
                                   $rollPipa = ($TPanjangPlastik * $doubleSingle * $rumusRoll * $jumlahBobin) / 1000;
                                   $rollLembar = $jumlahBobin;
                                   break;

           case "PAYUNG"         : $panjangPlastik = 0;
                                   $doubleSingle = 0;
                                   $rumusRoll = $this->input->post("rumusRoll");
                                   $jumlahBobin = 0;
                                   $payung = $this->input->post("payung");
                                   $payungKuning = 0;
                                   $rollPipa = ($payung * $rumusRoll) / 1000;
                                   $rollLembar = $payung;
                                   break;

           case "PAYUNG_KUNING"  : $panjangPlastik = 0;
                                   $doubleSingle = 0;
                                   $rumusRoll = $this->input->post("rumusRoll");
                                   $jumlahBobin = 0;
                                   $payung = 0;
                                   $payungKuning = $this->input->post("payungKuning");
                                   $rollPipa = ($payungKuning * $rumusRoll) / 1000;
                                   $rollLembar = $payungKuning;
                                   break;

           default               : $panjangPlastik = 0;
                                   $doubleSingle = 0;
                                   $rumusRoll = 0;
                                   $jumlahBobin = 0;
                                   $payung = 0;
                                   $payungKuning = 0;
                                   $rollPipa = 0;
                                   $rollLembar = 0;
                                   break;
         }

         if($bijiWarna != "putih"){
           $jumlahBijiWarna = ($hasil - $rollPipa) / 25 * $komposisi / 1000;
           $data = array("kd_gd_bahan" => $bijiWarna,
                         "kd_extruder" => $kdExtruder,
                         "stok" => $jumlahBijiWarna,
                         "id_user" => $idUser,
                         "nama" => "EXTRUDER",
                         "tgl_transaksi" => $tglPengerjaan,
                         "bagian" => "EXTRUDER",
                         "keterangan_history" => "PEMAKAIAN EXTRUDER");
           $booleanResult = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data);
           if($booleanResult){
             $jumlahTransaksiSuccess++;
           }
         }
         if($keterangan == "STRIP"){
           $warnaStrip = $this->input->post("warnaStrip");
           switch($warnaStrip){
             case "MP" : $jumlahSelesaiPutihSusu = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $kdGdBahanPutihSusu = "BHN170612028";
                         $kdGdBahanMerah = "BHN170612020";
                         $pemakaianStrip = implode("#",array($jumlahSelesaiPutihSusu,$jumlahSelesaiMerah));
                         $data1 = array("kd_gd_bahan" => $kdGdBahanPutihSusu,
                                       "kd_extruder" => $kdExtruder,
                                       "stok" => $jumlahSelesaiPutihSusu,
                                       "id_user" => $idUser,
                                       "nama" => "EXTRUDER",
                                       "tgl_transaksi" => $tglPengerjaan,
                                       "bagian" => "EXTRUDER",
                                       "keterangan_history" => "PEMAKAIAN STRIP");

                         $data2 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                        "kd_extruder" => $kdExtruder,
                                        "stok" => $jumlahSelesaiMerah,
                                        "id_user" => $idUser,
                                        "nama" => "EXTRUDER",
                                        "tgl_transaksi" => $tglPengerjaan,
                                        "bagian" => "EXTRUDER",
                                        "keterangan_history" => "PEMAKAIAN STRIP");

                         $booleanResult1 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data1);
                         $booleanResult2 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data2);

                         if($booleanResult1 && $booleanResult2){
                           $jumlahTransaksiSuccess++;
                         }
                         break;

             case "MO" : $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $jumlahSelesaiOrange = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $kdGdBahanMerah = "BHN170612020";
                         $kdGdBahanOrange = "BHN170612022";
                         $pemakaianStrip = implode("#",array($jumlahSelesaiMerah,$jumlahSelesaiOrange));
                         $data1 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                       "kd_extruder" => $kdExtruder,
                                       "stok" => $jumlahSelesaiMerah,
                                       "id_user" => $idUser,
                                       "nama" => "EXTRUDER",
                                       "tgl_transaksi" => $tglPengerjaan,
                                       "bagian" => "EXTRUDER",
                                       "keterangan_history" => "PEMAKAIAN STRIP");

                         $data2 = array("kd_gd_bahan" => $kdGdBahanOrange,
                                        "kd_extruder" => $kdExtruder,
                                        "stok" => $jumlahSelesaiOrange,
                                        "id_user" => $idUser,
                                        "nama" => "EXTRUDER",
                                        "tgl_transaksi" => $tglPengerjaan,
                                        "bagian" => "EXTRUDER",
                                        "keterangan_history" => "PEMAKAIAN STRIP");

                         $booleanResult1 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data1);
                         $booleanResult2 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data2);

                         if($booleanResult1 && $booleanResult2){
                           $jumlahTransaksiSuccess++;
                         }
                         break;

             case "MB" : $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $jumlahSelesaiBiru = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $kdGdBahanMerah = "BHN170612020";
                         $kdGdBahanBiru = "BHN170612019";
                         $pemakaianStrip = implode("#",array($jumlahSelesaiMerah,$jumlahSelesaiBiru));
                         $data1 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                       "kd_extruder" => $kdExtruder,
                                       "stok" => $jumlahSelesaiMerah,
                                       "id_user" => $idUser,
                                       "nama" => "EXTRUDER",
                                       "tgl_transaksi" => $tglPengerjaan,
                                       "bagian" => "EXTRUDER",
                                       "keterangan_history" => "PEMAKAIAN STRIP");

                         $data2 = array("kd_gd_bahan" => $kdGdBahanBiru,
                                        "kd_extruder" => $kdExtruder,
                                        "stok" => $jumlahSelesaiBiru,
                                        "id_user" => $idUser,
                                        "nama" => "EXTRUDER",
                                        "tgl_transaksi" => $tglPengerjaan,
                                        "bagian" => "EXTRUDER",
                                        "keterangan_history" => "PEMAKAIAN STRIP");

                         $booleanResult1 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data1);
                         $booleanResult2 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data2);

                         if($booleanResult1 && $booleanResult2){
                           $jumlahTransaksiSuccess++;
                         }
                         break;

             case "MERAH / TS" : $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                 // $jumlahSelesaiBiru = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                 $kdGdBahanMerah = "BHN170612020";
                                 // $kdGdBahanBiru = "BHN170612019";
                                 $pemakaianStrip = implode("#",array($jumlahSelesaiMerah,0));
                                 $data1 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                               "kd_extruder" => $kdExtruder,
                                               "stok" => $jumlahSelesaiMerah,
                                               "id_user" => $idUser,
                                               "nama" => "EXTRUDER",
                                               "tgl_transaksi" => $tglPengerjaan,
                                               "bagian" => "EXTRUDER",
                                               "keterangan_history" => "PEMAKAIAN STRIP");

                                 // $data2 = array("kd_gd_bahan" => $kdGdBahanBiru,
                                 //                "kd_extruder" => $kdExtruder,
                                 //                "stok" => $jumlahSelesaiBiru,
                                 //                "id_user" => $idUser,
                                 //                "nama" => "EXTRUDER",
                                 //                "tgl_transaksi" => $tglPengerjaan,
                                 //                "bagian" => "EXTRUDER",
                                 //                "keterangan_history" => "PEMAKAIAN STRIP");

                                 $booleanResult1 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data1);
                                 // $booleanResult2 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data2);

                                 if($booleanResult1){
                                   $jumlahTransaksiSuccess++;
                                 }
                                 break;

               case "ORANGE / TS" : $jumlahSelesaiOrange = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                   // $jumlahSelesaiBiru = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                   $kdGdBahanOrange = "BHN170612022";
                                   // $kdGdBahanBiru = "BHN170612019";
                                   $pemakaianStrip = implode("#",array($jumlahSelesaiOrange,0));
                                   $data1 = array("kd_gd_bahan" => $kdGdBahanOrange,
                                                 "kd_extruder" => $kdExtruder,
                                                 "stok" => $jumlahSelesaiOrange,
                                                 "id_user" => $idUser,
                                                 "nama" => "EXTRUDER",
                                                 "tgl_transaksi" => $tglPengerjaan,
                                                 "bagian" => "EXTRUDER",
                                                 "keterangan_history" => "PEMAKAIAN STRIP");

                                   // $data2 = array("kd_gd_bahan" => $kdGdBahanBiru,
                                   //                "kd_extruder" => $kdExtruder,
                                   //                "stok" => $jumlahSelesaiBiru,
                                   //                "id_user" => $idUser,
                                   //                "nama" => "EXTRUDER",
                                   //                "tgl_transaksi" => $tglPengerjaan,
                                   //                "bagian" => "EXTRUDER",
                                   //                "keterangan_history" => "PEMAKAIAN STRIP");

                                   $booleanResult1 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data1);
                                   // $booleanResult2 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data2);

                                   if($booleanResult1){
                                     $jumlahTransaksiSuccess++;
                                   }
                                   break;

             default: if($warnaStrip == "PUTIH"){
                       $kdBahanStrip = $warnaStrip;
                       $jumlahSelesaiStrip = ($hasil - $rollPipa) * 0.0015;
                       $pemakaianStrip = $jumlahSelesaiStrip;
                       $data = array("kd_extruder" => $kdExtruder,
                                     "stok" => $jumlahSelesaiStrip,
                                     "id_user" => $idUser,
                                     "nama" => "EXTRUDER",
                                     "tgl_transaksi" => $tglPengerjaan,
                                     "bagian" => "EXTRUDER",
                                     "keterangan_history" => "PEMAKAIAN STRIP");
                       $booleanResult = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data);
                       if($booleanResult){
                         $jumlahTransaksiSuccess++;
                       }
                     }else{
                       $kdBahanStrip = $warnaStrip;
                       $jumlahSelesaiStrip = (($hasil - $rollPipa)-$jumlahBijiWarna) * 0.0015;
                       $pemakaianStrip = $jumlahSelesaiStrip;
                       $data = array("kd_gd_bahan" => $kdBahanStrip,
                                     "kd_extruder" => $kdExtruder,
                                     "stok" => $jumlahSelesaiStrip,
                                     "id_user" => $idUser,
                                     "nama" => "EXTRUDER",
                                     "tgl_transaksi" => $tglPengerjaan,
                                     "bagian" => "EXTRUDER",
                                     "keterangan_history" => "PEMAKAIAN STRIP");
                       $booleanResult = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data);
                       if($booleanResult){
                         $jumlahTransaksiSuccess++;
                       }
                     }
                     break;
           }
         }

         $data = array("kd_extruder" => $kdExtruder,
                       "kd_gd_roll" => $kdGdRoll,
                       "id_user" => $idUser,
                       "tgl_rencana" => $tglPengerjaan,
                       "tgl_jadi" => $tglJadi,
                       "jumlah_selesai" => $hasil,
                       "jns_permintaan" => $jenisPermintaan,
                       "biji_warna" => $namaBijiWarna,
                       "jumlah_biji_warna" => $jumlahBijiWarna,
                       "pemakaian_strip" => $pemakaianStrip,
                       "warna_plastik" => $warnaPlastik,
                       "hasil_ukuran" => $ukuran,
                       "panjang" => $panjang,
                       "hasil_berat" => $berat,
                       "roll_pipa" => $rollPipa,
                       "roll_lembar" => $rollLembar,
                       "jenis_roll" => $jenisRoll,
                       "keterangan" => $keterangan,
                       "shift" => $shift,
                       "merek" => $merek,
                       "jns_brg" => $jenisBarang,
                       "jumlahPermintaan" => $jumlahPermintaan);
          $result = $this->Extruder_Model->insertHasilExtruder($data);
          if($result){
            $jumlahTransaksiSuccess++;
          }
          if($jumlahTransaksiSuccess > 0){
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

  public function saveHasilExtruderTertinggal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdExtruder = $this->input->post("kdExtruder");#
      $kdGdRoll = $this->input->post("kdGdRoll");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $warnaPlastik = $this->input->post("warnaPlastik");#
      $tglPengerjaan = $this->input->post("tglPengerjaan");#
      $tglJadi = date("Y-m-d");#
      $noMesin = $this->input->post("noMesin");
      $merek = $this->input->post("merek");#
      $jenisBarang = $this->input->post("jnsBarang");#
      $jenisPermintaan = $this->input->post("jnsPermintaan");#
      $bijiWarna = $this->input->post("bijiWarna");#
      $namaBijiWarna = $this->input->post("namaBijiWarna");
      $komposisi = $this->input->post("komposisi");
      $keterangan = $this->input->post("keterangan");#
      $ketMerek = $this->input->post("ketMerek");
      $ukuran = $this->input->post("ukuran");#
      $tebal = $this->input->post("tebal");#
      $berat = $this->input->post("berat");#
      $strip = $this->input->post("strip");#
      $jenisRoll = $this->input->post("jenisRoll");#
      $shift = $this->input->post("shift");#
      $hasil = $this->input->post("hasil");#
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $jumlahTransaksiSuccess = 0;
      $jumlahBijiWarna = 0;
      if(empty($kdExtruder)      || empty($kdGdRoll)      || empty($idUser)          ||
         empty($warnaPlastik)    || empty($tglPengerjaan) || empty($tglJadi)         ||
         empty($merek)           || empty($jenisBarang)   || empty($jenisPermintaan) ||
         empty($bijiWarna)       || $komposisi==""        || empty($keterangan)      ||
         empty($ukuran)          || $strip==""            || $hasil==""            || empty($jenisRoll)
       ){
         echo "Data Kosong";
       }else{
         $arrQuote = array("'",'"');
         $explodePanjang = explode("x",$ukuran);
         $panjang = str_replace($arrQuote,"in",$explodePanjang[0]);
         switch ($jenisRoll){
           case "BOBIN"          : $panjangPlastik = str_replace(",",".",$this->input->post("panjangPlastik"));
                                   $doubleSingle = $this->input->post("doubleSingle");
                                   $rumusRoll = $this->input->post("rumusRoll");
                                   $jumlahBobin = $this->input->post("jumlahBobin");
                                   $payung = 0;
                                   $payungKuning = 0;
                                   if(substr_count(strtoupper($ketMerek), "PON") > 0) { #Check Jenis Ukuran PON / Bukan
                                     $arrPanjangPlastik = explode("+",$panjangPlastik);
                                     if(count($arrPanjangPlastik) == 2){ #untuk memisahkan ukuran lipatan atau bukan
                                       if(floatval($arrPanjangPlastik[0]) >= 20 && floatval($arrPanjangPlastik[0]) < 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + 5;
                                       }else if(floatval($arrPanjangPlastik[0]) >= 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + 5.5;
                                       }else{
                                         $TPanjangPlastik = 0;
                                       }
                                     }else{
                                       if(floatval($arrPanjangPlastik[0]) >= 20 && floatval($arrPanjangPlastik[0]) < 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + 5;
                                       }else if(floatval($arrPanjangPlastik[0]) >= 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + 5.5;
                                       }else{
                                         $TPanjangPlastik = 0;
                                       }
                                     }
                                   }else{
                                     if(strpos($panjangPlastik,"+") === FALSE){
                                       if(strpos($panjangPlastik,"in") !== FALSE){
                                         $TPanjangPlastik = floatval($panjangPlastik) * 2.54;
                                       }else{
                                         $TPanjangPlastik = floatval($panjangPlastik);
                                       }
                                     }else{
                                       if(strpos($panjangPlastik,"in") !== FALSE){
                                         $arrPanjangPlastik = explode("+",$panjangPlastik);
                                         switch (count($arrPanjangPlastik)) {
                                           case 2: $TPanjangPlastik = (floatval($arrPanjangPlastik[0]) * 2.54) + floatval($arrPanjangPlastik[1]);
                                                   break;
                                           case 3: $TPanjangPlastik = (floatval($arrPanjangPlastik[0]) * 2.54) + (floatval($arrPanjangPlastik[1]) * 2.54) + floatval($arrPanjangPlastik[2]);
                                                   break;

                                           default: $TPanjangPlastik = floatval($arrPanjangPlastik) * 2.54;
                                             break;
                                         }
                                       }else{
                                         $arrPanjangPlastik = explode("+",$panjangPlastik);
                                         switch (count($arrPanjangPlastik)) {
                                           case 2: $TPanjangPlastik = floatval($arrPanjangPlastik[0])+ floatval($arrPanjangPlastik[1]);
                                                   break;
                                           case 3: $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + floatval($arrPanjangPlastik[2]);
                                                   break;

                                           default: $TPanjangPlastik = floatval($arrPanjangPlastik);
                                             break;
                                         }
                                       }
                                     }
                                   }
                                   $rollPipa = ($TPanjangPlastik * $doubleSingle * $rumusRoll * $jumlahBobin) / 1000;
                                   $rollLembar = $jumlahBobin;
                                   break;

           case "PAYUNG"         : $panjangPlastik = 0;
                                   $doubleSingle = 0;
                                   $rumusRoll = $this->input->post("rumusRoll");
                                   $jumlahBobin = 0;
                                   $payung = $this->input->post("payung");
                                   $payungKuning = 0;
                                   $rollPipa = ($payung * $rumusRoll) / 1000;
                                   $rollLembar = $payung;
                                   break;

           case "PAYUNG_KUNING"  : $panjangPlastik = 0;
                                   $doubleSingle = 0;
                                   $rumusRoll = $this->input->post("rumusRoll");
                                   $jumlahBobin = 0;
                                   $payung = 0;
                                   $payungKuning = $this->input->post("payungKuning");
                                   $rollPipa = ($payungKuning * $rumusRoll) / 1000;
                                   $rollLembar = $payungKuning;
                                   break;

           default               : $panjangPlastik = 0;
                                   $doubleSingle = 0;
                                   $rumusRoll = 0;
                                   $jumlahBobin = 0;
                                   $payung = 0;
                                   $payungKuning = 0;
                                   $rollPipa = 0;
                                   $rollLembar = 0;
                                   break;
         }

         if($bijiWarna != "putih"){
           $jumlahBijiWarna = ($hasil - $rollPipa) / 25 * $komposisi / 1000;
           $data = array("kd_gd_bahan" => $bijiWarna,
                         "kd_extruder" => $kdExtruder,
                         "stok" => $jumlahBijiWarna,
                         "id_user" => $idUser,
                         "nama" => "EXTRUDER",
                         "tgl_transaksi" => $tglPengerjaan,
                         "bagian" => "EXTRUDER",
                         "keterangan_history" => "PEMAKAIAN EXTRUDER");
           $booleanResult = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data);
           if($booleanResult){
             $jumlahTransaksiSuccess++;
           }
         }
         if($keterangan == "STRIP"){
           $warnaStrip = $this->input->post("warnaStrip");
           switch($warnaStrip){
             case "MP" : $jumlahSelesaiPutihSusu = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $kdGdBahanPutihSusu = "BHN170612028";
                         $kdGdBahanMerah = "BHN170612020";
                         $pemakaianStrip = implode("#",array($jumlahSelesaiPutihSusu,$jumlahSelesaiMerah));
                         $data1 = array("kd_gd_bahan" => $kdGdBahanPutihSusu,
                                       "kd_extruder" => $kdExtruder,
                                       "stok" => $jumlahSelesaiPutihSusu,
                                       "id_user" => $idUser,
                                       "nama" => "EXTRUDER",
                                       "tgl_transaksi" => $tglPengerjaan,
                                       "bagian" => "EXTRUDER",
                                       "keterangan_history" => "PEMAKAIAN STRIP");

                         $data2 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                        "kd_extruder" => $kdExtruder,
                                        "stok" => $jumlahSelesaiMerah,
                                        "id_user" => $idUser,
                                        "nama" => "EXTRUDER",
                                        "tgl_transaksi" => $tglPengerjaan,
                                        "bagian" => "EXTRUDER",
                                        "keterangan_history" => "PEMAKAIAN STRIP");

                         $booleanResult1 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data1);
                         $booleanResult2 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data2);

                         if($booleanResult1 && $booleanResult2){
                           $jumlahTransaksiSuccess++;
                         }
                         break;

             case "MO" : $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $jumlahSelesaiOrange = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $kdGdBahanMerah = "BHN170612020";
                         $kdGdBahanOrange = "BHN170612022";
                         $pemakaianStrip = implode("#",array($jumlahSelesaiMerah,$jumlahSelesaiOrange));
                         $data1 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                       "kd_extruder" => $kdExtruder,
                                       "stok" => $jumlahSelesaiMerah,
                                       "id_user" => $idUser,
                                       "nama" => "EXTRUDER",
                                       "tgl_transaksi" => $tglPengerjaan,
                                       "bagian" => "EXTRUDER",
                                       "keterangan_history" => "PEMAKAIAN STRIP");

                         $data2 = array("kd_gd_bahan" => $kdGdBahanOrange,
                                        "kd_extruder" => $kdExtruder,
                                        "stok" => $jumlahSelesaiOrange,
                                        "id_user" => $idUser,
                                        "nama" => "EXTRUDER",
                                        "tgl_transaksi" => $tglPengerjaan,
                                        "bagian" => "EXTRUDER",
                                        "keterangan_history" => "PEMAKAIAN STRIP");

                         $booleanResult1 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data1);
                         $booleanResult2 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data2);

                         if($booleanResult1 && $booleanResult2){
                           $jumlahTransaksiSuccess++;
                         }
                         break;

             case "MB" : $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $jumlahSelesaiBiru = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $kdGdBahanMerah = "BHN170612020";
                         $kdGdBahanBiru = "BHN170612019";
                         $pemakaianStrip = implode("#",array($jumlahSelesaiMerah,$jumlahSelesaiBiru));
                         $data1 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                       "kd_extruder" => $kdExtruder,
                                       "stok" => $jumlahSelesaiMerah,
                                       "id_user" => $idUser,
                                       "nama" => "EXTRUDER",
                                       "tgl_transaksi" => $tglPengerjaan,
                                       "bagian" => "EXTRUDER",
                                       "keterangan_history" => "PEMAKAIAN STRIP");

                         $data2 = array("kd_gd_bahan" => $kdGdBahanBiru,
                                        "kd_extruder" => $kdExtruder,
                                        "stok" => $jumlahSelesaiBiru,
                                        "id_user" => $idUser,
                                        "nama" => "EXTRUDER",
                                        "tgl_transaksi" => $tglPengerjaan,
                                        "bagian" => "EXTRUDER",
                                        "keterangan_history" => "PEMAKAIAN STRIP");

                         $booleanResult1 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data1);
                         $booleanResult2 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data2);

                         if($booleanResult1 && $booleanResult2){
                           $jumlahTransaksiSuccess++;
                         }
                         break;

             case "MERAH / TS" : $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                 // $jumlahSelesaiBiru = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                 $kdGdBahanMerah = "BHN170612020";
                                 // $kdGdBahanBiru = "BHN170612019";
                                 $pemakaianStrip = implode("#",array($jumlahSelesaiMerah,0));
                                 $data1 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                               "kd_extruder" => $kdExtruder,
                                               "stok" => $jumlahSelesaiMerah,
                                               "id_user" => $idUser,
                                               "nama" => "EXTRUDER",
                                               "tgl_transaksi" => $tglPengerjaan,
                                               "bagian" => "EXTRUDER",
                                               "keterangan_history" => "PEMAKAIAN STRIP");

                                 // $data2 = array("kd_gd_bahan" => $kdGdBahanBiru,
                                 //                "kd_extruder" => $kdExtruder,
                                 //                "stok" => $jumlahSelesaiBiru,
                                 //                "id_user" => $idUser,
                                 //                "nama" => "EXTRUDER",
                                 //                "tgl_transaksi" => $tglPengerjaan,
                                 //                "bagian" => "EXTRUDER",
                                 //                "keterangan_history" => "PEMAKAIAN STRIP");

                                 $booleanResult1 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data1);
                                 // $booleanResult2 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data2);

                                 if($booleanResult1){
                                   $jumlahTransaksiSuccess++;
                                 }
                                 break;

               case "ORANGE / TS" : $jumlahSelesaiOrange = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                   // $jumlahSelesaiBiru = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                   $kdGdBahanOrange = "BHN170612022";
                                   // $kdGdBahanBiru = "BHN170612019";
                                   $pemakaianStrip = implode("#",array($jumlahSelesaiOrange,0));
                                   $data1 = array("kd_gd_bahan" => $kdGdBahanOrange,
                                                 "kd_extruder" => $kdExtruder,
                                                 "stok" => $jumlahSelesaiOrange,
                                                 "id_user" => $idUser,
                                                 "nama" => "EXTRUDER",
                                                 "tgl_transaksi" => $tglPengerjaan,
                                                 "bagian" => "EXTRUDER",
                                                 "keterangan_history" => "PEMAKAIAN STRIP");

                                   // $data2 = array("kd_gd_bahan" => $kdGdBahanBiru,
                                   //                "kd_extruder" => $kdExtruder,
                                   //                "stok" => $jumlahSelesaiBiru,
                                   //                "id_user" => $idUser,
                                   //                "nama" => "EXTRUDER",
                                   //                "tgl_transaksi" => $tglPengerjaan,
                                   //                "bagian" => "EXTRUDER",
                                   //                "keterangan_history" => "PEMAKAIAN STRIP");

                                   $booleanResult1 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data1);
                                   // $booleanResult2 = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data2);

                                   if($booleanResult1){
                                     $jumlahTransaksiSuccess++;
                                   }
                                   break;

             default: if($warnaStrip == "PUTIH"){
                       $kdBahanStrip = $warnaStrip;
                       $jumlahSelesaiStrip = ($hasil - $rollPipa) * 0.0015;
                       $pemakaianStrip = $jumlahSelesaiStrip;
                       $data = array("kd_extruder" => $kdExtruder,
                                     "stok" => $jumlahSelesaiStrip,
                                     "id_user" => $idUser,
                                     "nama" => "EXTRUDER",
                                     "tgl_transaksi" => $tglPengerjaan,
                                     "bagian" => "EXTRUDER",
                                     "keterangan_history" => "PEMAKAIAN STRIP");
                       $booleanResult = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data);
                       if($booleanResult){
                         $jumlahTransaksiSuccess++;
                       }
                     }else{
                       $kdBahanStrip = $warnaStrip;
                       $jumlahSelesaiStrip = (($hasil - $rollPipa)-$jumlahBijiWarna) * 0.0015;
                       $pemakaianStrip = $jumlahSelesaiStrip;
                       $data = array("kd_gd_bahan" => $kdBahanStrip,
                                     "kd_extruder" => $kdExtruder,
                                     "stok" => $jumlahSelesaiStrip,
                                     "id_user" => $idUser,
                                     "nama" => "EXTRUDER",
                                     "tgl_transaksi" => $tglPengerjaan,
                                     "bagian" => "EXTRUDER",
                                     "keterangan_history" => "PEMAKAIAN STRIP");
                       $booleanResult = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data);
                       if($booleanResult){
                         $jumlahTransaksiSuccess++;
                       }
                     }
                     break;
           }
         }

         $data = array("kd_extruder" => $kdExtruder,
                       "kd_gd_roll" => $kdGdRoll,
                       "id_user" => $idUser,
                       "tgl_rencana" => $tglPengerjaan,
                       "tgl_jadi" => $tglJadi,
                       "jumlah_selesai" => $hasil,
                       "jns_permintaan" => $jenisPermintaan,
                       "biji_warna" => $namaBijiWarna,
                       "jumlah_biji_warna" => $jumlahBijiWarna,
                       "pemakaian_strip" => $pemakaianStrip,
                       "warna_plastik" => $warnaPlastik,
                       "hasil_ukuran" => $ukuran,
                       "panjang" => $panjang,
                       "hasil_berat" => $berat,
                       "roll_pipa" => $rollPipa,
                       "roll_lembar" => $rollLembar,
                       "jenis_roll" => $jenisRoll,
                       "keterangan" => $keterangan,
                       "shift" => $shift,
                       "merek" => $merek,
                       "jns_brg" => $jenisBarang,
                       "status_transaksi" => "TRUE",
                       "jumlahPermintaan" => $jumlahPermintaan);
          $result = $this->Extruder_Model->insertHasilExtruder($data);
          if($result){
            $jumlahTransaksiSuccess++;
          }
          if($jumlahTransaksiSuccess > 0){
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

  public function saveAddPermintaanBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nama = $this->session->userdata("fabricationGroup");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $tglPermintaan = $this->input->post("tglPermintaan");
      $shift = $this->input->post("shift");
      $bagian = $this->session->userdata("fabricationGroup");
      $statusHistory = "KELUAR";
      $keteranganHistory = "PERMINTAAN EXTRUDER";

      if(empty($kdGdBahan) || empty($idUser) || empty($nama) || empty($jumlahPermintaan)||
         empty($tglPermintaan) || empty($bagian) || empty($statusHistory) || empty($keteranganHistory)
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_gd_bahan" => $kdGdBahan,
                       "id_user" => $idUser,
                       "nama" => strtoupper($nama),
                       "jumlah_permintaan" => $jumlahPermintaan,
                       "tgl_permintaan" => $tglPermintaan,
                       "bagian" => "EXTRUDER",
                       "status_history" => $statusHistory,
                       "shift" => $shift,
                       "keterangan_history" => $keteranganHistory);
        $result = $this->Extruder_Model->insertTransaksiGudangBahan($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->selectComboBoxValueGudangBahan(array("jenis"=>"BAHAN BAKU","status"=>"LOKAL"));
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPermintaanExtruderPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = $this->input->post("jenis");
      $status = $this->input->post("status");
      $data = array("jenis"=>$jenis,
                    "status" => $status);
      $result = $this->Extruder_Model->selectPermintaanExtruderPending($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailTransaksiGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Extruder_Model->selectDetailTransaksiGudangBahan($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editPermintaanExtruderPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tglPermintaan = $this->input->post("tglPermintaan");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");

      if(empty($idTransaksi) || empty($idUser) || empty($tglPermintaan) ||
         empty($kdGdBahan) || empty($jumlahPermintaan)
       ){
         echo "Data Kosong";
       }else{
         $data = array("id"                 => $idTransaksi,
                       "id_user"            => $idUser,
                       "tgl_permintaan"     => $tglPermintaan,
                       "kd_gd_bahan"        => $kdGdBahan,
                       "jumlah_permintaan"  => $jumlahPermintaan);
        $result = $this->Extruder_Model->updateTransaksiGudangBahan($data);
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

  public function deleteAndRestorePermintaanExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");

      $data = array("id" => $idTransaksi,
                    "deleted" => $deleted);

      $result = $this->Extruder_Model->updateTransaksiGudangBahan($data);
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

  public function savePermintaanBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = $this->input->post("jenis");
      $status = $this->input->post("status");
      $data = array("jenis"=>$jenis,
                    "status" => $status);
      $result = json_decode($this->Extruder_Model->selectPermintaanExtruderPending($data),TRUE);
      $jumlahData = count($result);
      $jumlahSuccess = 0;
      foreach ($result as $resultValue) {
        $data2 = array("id" => $resultValue["id"],
                       "status" => "PROGRESS");
        $result2 = $this->Extruder_Model->updateTransaksiGudangBahan($data2);
        if($result2){
          $jumlahSuccess++;
        }else{
          break;
        }
      }
      if($jumlahSuccess == $jumlahData){
        echo "Berhasil";
      }else{
        echo "Gagal ";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getJumlahPenambahanBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->selectJumlahPenambahanBahanBaku();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAddBijiWarnaPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nama = strtoupper($this->session->userdata("fabricationGroup"));
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $tglPermintaan = $this->input->post("tglPermintaan");
      $bagian = strtoupper($this->session->userdata("fabricationGroup"));
      $statusHistory = "KELUAR";
      $keteranganHistory = "PERMINTAAN EXTRUDER (DATA AWAL EXTRUDER)";

      if(empty($kdGdBahan) || $jumlahPermintaan=="" || empty($tglPermintaan)){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_bahan" => $kdGdBahan,
                      "id_user" => $idUser,
                      "nama" => $nama,
                      "jumlah_permintaan" => $jumlahPermintaan,
                      "tgl_permintaan" => $tglPermintaan,
                      "bagian" => $bagian,
                      "status_history" => $statusHistory,
                      "keterangan_history" => $keteranganHistory);

        $data2 = array("kd_gd_bahan" => $kdGdBahan,
                       "jumlah_stok" => $jumlahPermintaan,
                       "jenis" => "BIJI WARNA");

        $result1 = $this->Extruder_Model->insertTransaksiGudangBahan($data);
        if($result1=="Berhasil"){
          $result2 = $this->Extruder_Model->insertGudangBufferExtruder($data2);
          if($result2){
            echo "Berhasil";
          }else{
            echo "Gagal2";
          }
        }else if($result1 == "Gagal"){
          echo "Gagal1";
        }else{
          echo $result1;
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getTambahBijiWarnaPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->selectTambahBijiWarnaPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestoreTambahBijiWarnaPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $idGudangBuffer = $this->input->post("idGudangBuffer");
      $deleted = $this->input->post("deleted");

      $data1 = array("id" => $idTransaksi,
                     "deleted" => $deleted);

      $data2 = array("id" => $idGudangBuffer,
                     "deleted" => $deleted);
      $result = $this->Extruder_Model->updateTransaksiGudangBahan($data1);
      if($result){
        $result2 = $this->Extruder_Model->updateGudangBufferExtruder($data2);
        if($result2){
          echo "Berhasil";
        }else{
          echo "Gagal2";
        }
      }else{
        echo "Gagal1";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editBijiWarnaBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $idGudangBufferExtruder = $this->input->post("idGudangBuffer");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $tanggal = $this->input->post("tglPermintaan");
      if(empty($kdGdBahan) || empty($jumlahPermintaan) || empty($tanggal)){
        echo "Data Kosong";
      }else{
        $data1 = array("id" => $idTransaksi,
                       "tgl_permintaan" => $tanggal,
                       "kd_gd_bahan" => $kdGdBahan,
                       "jumlah_permintaan" => $jumlahPermintaan);

        $data2 = array("id" => $idGudangBufferExtruder,
                       "kd_gd_bahan" => $kdGdBahan,
                       "jumlah_stok" => $jumlahPermintaan);

        $result = $this->Extruder_Model->updateTransaksiGudangBahan($data1);
        if($result){
          $result2 = $this->Extruder_Model->updateGudangBufferExtruder($data2);
          if($result2){
            echo "Berhasil";
          }else{
            echo "Gagal2";
          }
        }else{
          echo "Gagal1";
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveBijiWarnaBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = json_decode($this->Extruder_Model->selectTambahBijiWarnaPending(),TRUE);
      $jumlahData = count($result);
      $jumlahSuccess = 0;
      if($jumlahData > 0){
        foreach ($result as $arr) {
          $data = array("id" => $arr["id"],
                        "status" => "PROGRESS");
          $booleanResult = $this->Extruder_Model->updateTransaksiGudangBahan($data);
          if($booleanResult) {
            $jumlahSuccess++;
          }else{
            break;
          }
        }

        if($jumlahSuccess == $jumlahData){
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

  public function getBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->selectBijiWarna();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getBijiWarnaGudangBufferExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $warna = $this->input->post("warnaPlastik");
      $result = $this->Extruder_Model->selectBijiWarnaGudangBufferExtruder($warna);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAddPermintaanBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nama = strtoupper($this->session->userdata("fabricationGroup"));
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $tglPermintaan = $this->input->post("tglPermintaan");
      $statusHistory = "KELUAR";
      $keteranganHistory = "PERMINTAAN EXTRUDER";

      if(empty($kdGdBahan) || $jumlahPermintaan=="" || empty($tglPermintaan)){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_bahan" => $kdGdBahan,
                      "id_user" => $idUser,
                      "nama" => $nama,
                      "jumlah_permintaan" => $jumlahPermintaan,
                      "tgl_permintaan" => $tglPermintaan,
                      "bagian" => "EXTRUDER",
                      "status_history" => $statusHistory,
                      "keterangan_history" => $keteranganHistory);

        $result1 = $this->Extruder_Model->insertTransaksiGudangBahan($data);
        echo $result1;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPermintaanBijiWarnaPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->selectPermintaanBijiWarnaPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editPermintaanBijiWarnaPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $tglPermintaan = $this->input->post("tglPermintaan");
      $idTransaksi = $this->input->post("idTransaksi");
      if(empty($kdGdBahan) || $jumlahPermintaan=="" || empty($tglPermintaan)){
        echo "Data Kosong";
      }else{
        $data = array("id" => $idTransaksi,
                      "kd_gd_bahan" => $kdGdBahan,
                      "id_user" => $idUser,
                      "jumlah_permintaan" => $jumlahPermintaan,
                      "tgl_permintaan" => $tglPermintaan);

        $result1 = $this->Extruder_Model->updateTransaksiGudangBahan($data);
        if($result1){
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

  public function savePermintaanBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = json_decode($this->Extruder_Model->selectPermintaanBijiWarnaPending(),TRUE);
      $jumlahData = count($result);
      $jumlahSuccess = 0;
      if($jumlahData > 0){
        foreach ($result as $data) {
          $data = array("id" => $data["id"],
                        "status" => "PROGRESS");
          $booleanResult = $this->Extruder_Model->updateTransaksiGudangBahan($data);
          if($booleanResult){
            $jumlahSuccess++;
          }else{
            break;
          }
        }
        if($jumlahSuccess == $jumlahData){
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

  public function getHasilJobExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsBrg = $this->input->post("jnsBrg");
      $result = $this->Extruder_Model->selectHasilJobExtruder($jnsBrg);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDataHasilJobExtruderFinal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsBrg = $this->input->post("jnsBrg");
      $result = $this->Extruder_Model->selectDataHasilJobExtruderFinal($jnsBrg);
      echo $result;
      // print_r($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveHasilJobExtruderFinal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $sisaBijiKemarin = $this->input->post("sisaBijiKemarin");
      $penambahanBijiBaru = $this->input->post("penambahanBijiBaru");
      $penguranganBiji = $this->input->post("penguranganBiji");
      $bijiWarna = $this->input->post("bijiWarna");
      $corong = $this->input->post("corong");
      $sisaBahan = $this->input->post("sisaBahan");
      $sisa = $this->input->post("sisa");
      $total = $this->input->post("total");
      $berat = $this->input->post("berat");
      $apal = $this->input->post("apal");
      $rollPipa = $this->input->post("rollPipa");
      $plusMinus = $this->input->post("plusMinus");
      $jnsBrg = $this->input->post("jnsBrg");
      $shift = $this->input->post("shift");

      if($sisaBijiKemarin=="" || $penambahanBijiBaru=="" || $penguranganBiji=="" ||
         $bijiWarna=="" || $corong=="" || $sisaBahan=="" || $sisa=="" ||
         $total=="" || $berat=="" || $apal=="" || $rollPipa=="" || $plusMinus==""
        ){
          echo "Data Kosong";
        }else{
          $data = array("id_user" => $this->session->userdata("fabricationIdUser"),
                        "sisaBijiKemarin" => $sisa,
                        "penambahanBijiBaru" => $penambahanBijiBaru,
                        "penguranganBiji" => $penguranganBiji,
                        "corong" => $corong,
                        "sisaBahan" => $sisaBahan,
                        "plusMinus" => $plusMinus,
                        "totalBijiWarna" => $bijiWarna,
                        "total" => $total,
                        "jumlahApal" => $apal,
                        "jnsBrg" => $jnsBrg,
                        "shift" => $shift);
          $booleanResult = $this->Extruder_Model->updateHasilJobExtruderFinal($data);
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

  public function getDataLaporanRencanaMandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $shift = $this->input->post("shift");
      $jenisMesin = $this->input->post("jnsMesin");
      $tglRencana = $this->input->post("tglRencana");
      $data = array("tgl_rencana" => $tglRencana,
                    "jns_brg" => $jenisMesin,
                    "shift" => $shift);
      $result = $this->Extruder_Model->selectDataLaporanRencanaMandor($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDataHasilExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $shift = $this->input->post("shift");
      $jnsBrg = $this->input->post("jnsBrg");
      $tglRencana = $this->input->post("tglRencana");

      $data = array("tgl_rencana" => $tglRencana,
                    "jns_brg" => $jnsBrg,
                    "shift" => $shift);

      $result = $this->Extruder_Model->selectDataHasilExtruder($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailTransaksiHasilJobExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Extruder_Model->selectDetailTransaksiHasilJobExtruder("$idTransaksi");
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editHasilJobExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");#
      $kdExtruder = $this->input->post("kdExtruder");#
      $jnsBrg = $this->input->post("jnsBrg");#
      $bijiWarna = $this->input->post("bijiWarna");
      $namaBijiWarna = $this->input->post("namaBijiWarna");
      $ukuran = $this->input->post("ukuran");
      $komposisi =  $this->input->post("komposisi");
      $jenisRoll = $this->input->post("jenisRoll");#
      $shift = $this->input->post("shift");#
      $keterangan = $this->input->post("keterangan");#
      $ketMerek = $this->input->post("ketMerek");
      $hasil = $this->input->post("jumlahHasil");#
      $jumlahBijiWarnaFromDb = $this->input->post("jumlahBijiWarna");
      $tglTransaksi = $this->input->post("tglTransaksi");
      $pemakaianStrip = $this->input->post("pemakaianStrip");
      $jumlahTransaksiSuccess = 0;
      $jumlahBijiWarna = 0;
      $arrForReplace = array("in",'"',"'","*");

      if(empty($idTransaksi) || empty($kdExtruder) || empty($jnsBrg) || empty($bijiWarna) ||
         empty($jenisRoll) || empty($shift) || empty($keterangan) || empty($hasil)
       ){
         echo "Data Kosong";
      }else{
        switch ($jenisRoll){
          case "BOBIN"          : $panjangPlastik = str_replace(",",".",$this->input->post("panjangPlastik"));
                                  $doubleSingle = $this->input->post("doubleSingle");
                                  $rumusRoll = $this->input->post("rumusRoll");
                                  $jumlahBobin = $this->input->post("jumlahBobin");
                                  $payung = 0;
                                  $payungKuning = 0;
                                  if(substr_count(strtoupper($ketMerek), "PON") > 0) { #Check Jenis Ukuran PON / Bukan
                                    $arrPanjangPlastik = explode("+",$panjangPlastik);
                                    if(count($arrPanjangPlastik) == 2){ #untuk memisahkan ukuran lipatan atau bukan
                                      if(floatval($arrPanjangPlastik[0]) >= 20 && floatval($arrPanjangPlastik[0]) < 26.5){
                                        $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + 5;
                                      }else if(floatval($arrPanjangPlastik[0]) >= 26.5){
                                        $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + 5.5;
                                      }else{
                                        $TPanjangPlastik = 0;
                                      }
                                    }else{
                                      if(floatval($arrPanjangPlastik[0]) >= 20 && floatval($arrPanjangPlastik[0]) < 26.5){
                                        $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + 5;
                                      }else if(floatval($arrPanjangPlastik[0]) >= 26.5){
                                        $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + 5.5;
                                      }else{
                                        $TPanjangPlastik = 0;
                                      }
                                    }
                                  }else{
                                    if(strpos($panjangPlastik,"+") === FALSE){
                                      if(strpos($panjangPlastik,"in") !== FALSE){
                                        $TPanjangPlastik = floatval($panjangPlastik) * 2.54;
                                      }else{
                                        $TPanjangPlastik = floatval($panjangPlastik);
                                      }
                                    }else{
                                      if(strpos($panjangPlastik,"in") !== FALSE){
                                        $arrPanjangPlastik = explode("+",$panjangPlastik);
                                        switch (count($arrPanjangPlastik)) {
                                          case 2: $TPanjangPlastik = (floatval($arrPanjangPlastik[0]) * 2.54) + floatval($arrPanjangPlastik[1]);
                                                  break;
                                          case 3: $TPanjangPlastik = (floatval($arrPanjangPlastik[0]) * 2.54) + (floatval($arrPanjangPlastik[1]) * 2.54) + floatval($arrPanjangPlastik[2]);
                                                  break;

                                          default: $TPanjangPlastik = floatval($arrPanjangPlastik) * 2.54;
                                            break;
                                        }
                                      }else{
                                        $arrPanjangPlastik = explode("+",$panjangPlastik);
                                        switch (count($arrPanjangPlastik)) {
                                          case 2: $TPanjangPlastik = floatval($arrPanjangPlastik[0])+ floatval($arrPanjangPlastik[1]);
                                                  break;
                                          case 3: $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + floatval($arrPanjangPlastik[2]);
                                                  break;

                                          default: $TPanjangPlastik = floatval($arrPanjangPlastik);
                                            break;
                                        }
                                      }
                                    }
                                  }
                                  $rollPipa = ($TPanjangPlastik * $doubleSingle * $rumusRoll * $jumlahBobin) / 1000;
                                  $rollLembar = $jumlahBobin;
                                  break;

          case "PAYUNG"         : $panjangPlastik = 0;
                                  $doubleSingle = 0;
                                  $rumusRoll = $this->input->post("rumusRoll");
                                  $jumlahBobin = 0;
                                  $payung = $this->input->post("jumlahPayung");
                                  $payungKuning = 0;
                                  $rollPipa = ($payung * $rumusRoll) / 1000;
                                  $rollLembar = $payung;
                                  break;

          case "PAYUNG_KUNING"  : $panjangPlastik = 0;
                                  $doubleSingle = 0;
                                  $rumusRoll = $this->input->post("rumusRoll");
                                  $jumlahBobin = 0;
                                  $payung = 0;
                                  $payungKuning = $this->input->post("jumlahPayung");
                                  $rollPipa = ($payungKuning * $rumusRoll) / 1000;
                                  $rollLembar = $payungKuning;
                                  break;

          default               : $panjangPlastik = 0;
                                  $doubleSingle = 0;
                                  $rumusRoll = 0;
                                  $jumlahBobin = 0;
                                  $payung = 0;
                                  $payungKuning = 0;
                                  $rollPipa = 0;
                                  $rollLembar = 0;
                                  break;
        }

        if(!empty($bijiWarna)){
          if($bijiWarna != "putih"){
            $jumlahBijiWarna = ($hasil - $rollPipa) / 25 * $komposisi / 1000;

            $dataForCheckGudangBufferExtruder = array("tgl_transaksi" => $tglTransaksi,
                                                      "kd_extruder" => $kdExtruder,
                                                      "jumlah"  => $jumlahBijiWarnaFromDb);

            $resultGudangBufferExtruder = $this->Extruder_Model->selectCheckPemakaianExtruder($dataForCheckGudangBufferExtruder);

            if($bijiWarna == $resultGudangBufferExtruder[0]["kd_gd_bahan"]){
              $data1 = array("jumlah" => $resultGudangBufferExtruder[0]["jumlah"],
              "stok" => $jumlahBijiWarna,
              "id" => $resultGudangBufferExtruder[0]["id"],
              "id_hasil_extruder" => $idTransaksi);
              $booleanResult = $this->Extruder_Model->updatePemakaianExtruderTrue($data1);
            }else{
              $data1 = array("jumlah" => $resultGudangBufferExtruder[0]["jumlah"],
              "kd_gd_bahan_lama" => $resultGudangBufferExtruder[0]["kd_gd_bahan"],
              "kd_gd_bahan_baru" => $bijiWarna,
              "id" => $resultGudangBufferExtruder[0]["id"],
              "stok" => $jumlahBijiWarna,
              "nama_biji_warna" => $namaBijiWarna,
              "idTransaksi" => $idTransaksi);
              $booleanResult = $this->Extruder_Model->updatePemakaianExtruderFalse($data1);
            }
          }

          if($booleanResult){
            $jumlahTransaksiSuccess++;
          }
        }

        if($keterangan == "STRIP"){
            $warnaStrip = $this->input->post("warnaStrip");
            if(!empty($warnaStrip)){
              $dataForCheckStrip = array("kd_extruder" => $kdExtruder,
                                         "tgl_transaksi" => $tglTransaksi,
                                         "jumlah" => $pemakaianStrip);
              $resultPemakaianStrip = $this->Extruder_Model->selectCheckPemakaianStrip($dataForCheckStrip);

              switch($warnaStrip){
                case "MP" : $jumlahSelesaiPutihSusu = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                            $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                            $kdGdBahanPutihSusu = "BHN170612028";
                            $kdGdBahanMerah = "BHN170612020";
                            #=====Mendapatkan Jumlah Pemakaian Strip Sebelumnya=====#
                            $jumlahSelesaiPutihSusu_Sebelumnya = $resultPemakaianStrip[0]["jumlah"];
                            $jumlahSelesaiMerah_Sebelumnya = $resultPemakaianStrip[1]["jumlah"];
                            $kdGdBahanPutihSusu_Sebelumnya = $resultPemakaianStrip[0]["kd_gd_bahan"];
                            $kdGdBahanMerah_Sebelumnya = $resultPemakaianStrip[1]["kd_gd_bahan"];
                            $idTransaksiGudangBufferExtruder = $resultPemakaianStrip[0]["id"];
                            #=====Mendapatkan Jumlah Pemakaian Strip Sebelumnya=====#

                            $pemakaianStrip = implode("#",array($jumlahSelesaiPutihSusu,$jumlahSelesaiMerah));
                            $data1 = array("kd_gd_bahan" => $kdGdBahanPutihSusu,
                                           "kd_extruder" => $kdExtruder,
                                           "stok" => $jumlahSelesaiPutihSusu,
                                           "id_user" => $idUser,
                                           "nama" => "EXTRUDER",
                                           "tgl_transaksi" => $tglPengerjaan,
                                           "bagian" => "EXTRUDER",
                                           "keterangan_history" => "PEMAKAIAN STRIP",
                                           "kdGdBahan_Sebelumnya" => $kdGdBahanPutihSusu_Sebelumnya,
                                           "stokBahan_Sebelumnya" => $jumlahSelesaiPutihSusu_Sebelumnya,
                                           "idTransaksi" => $idTransaksiGudangBufferExtruder);

                            $data2 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                           "kd_extruder" => $kdExtruder,
                                           "stok" => $jumlahSelesaiMerah,
                                           "id_user" => $idUser,
                                           "nama" => "EXTRUDER",
                                           "tgl_transaksi" => $tglPengerjaan,
                                           "bagian" => "EXTRUDER",
                                           "keterangan_history" => "PEMAKAIAN STRIP",
                                           "kdGdBahan_Sebelumnya" => $kdGdBahanMerah_Sebelumnya,
                                           "stokBahan_Sebelumnya" => $jumlahSelesaiMerah_Sebelumnya,
                                           "idTransaksi" => $idTransaksiGudangBufferExtruder);

                            $booleanResult1 = $this->Extruder_Model->updateTransaksiGudangBufferExtruder($data1);
                            $booleanResult2 = $this->Extruder_Model->updateTransaksiGudangBufferExtruder($data2);

                            if($booleanResult1 && $booleanResult2){
                              $jumlahTransaksiSuccess++;
                            }
                            break;

                case "MO" : $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                            $jumlahSelesaiOrange = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                            $kdGdBahanMerah = "BHN170612020";
                            $kdGdBahanOrange = "BHN170612022";
                            #=====Mendapatkan Jumlah Pemakaian Strip Sebelumnya=====#
                            $jumlahSelesaiMerah_Sebelumnya = $resultPemakaianStrip[0]["jumlah"];
                            $jumlahSelesaiOrange_Sebelumnya = $resultPemakaianStrip[1]["jumlah"];
                            $kdGdBahanMerah_Sebelumnya = $resultPemakaianStrip[0]["kd_gd_bahan"];
                            $kdGdBahanOrange_Sebelumnya = $resultPemakaianStrip[1]["kd_gd_bahan"];
                            $idTransaksiGudangBufferExtruder = $resultPemakaianStrip[0]["id"];
                            #=====Mendapatkan Jumlah Pemakaian Strip Sebelumnya=====#

                            $pemakaianStrip = implode("#",array($jumlahSelesaiMerah,$jumlahSelesaiOrange));
                            $data1 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                          "kd_extruder" => $kdExtruder,
                                          "stok" => $jumlahSelesaiMerah,
                                          "id_user" => $idUser,
                                          "nama" => "EXTRUDER",
                                          "tgl_transaksi" => $tglPengerjaan,
                                          "bagian" => "EXTRUDER",
                                          "keterangan_history" => "PEMAKAIAN STRIP",
                                          "kdGdBahan_Sebelumnya" => $kdGdBahanMerah_Sebelumnya,
                                          "stokBahan_Sebelumnya" => $jumlahSelesaiMerah_Sebelumnya,
                                          "idTransaksi" => $idTransaksiGudangBufferExtruder);

                            $data2 = array("kd_gd_bahan" => $kdGdBahanOrange,
                                           "kd_extruder" => $kdExtruder,
                                           "stok" => $jumlahSelesaiOrange,
                                           "id_user" => $idUser,
                                           "nama" => "EXTRUDER",
                                           "tgl_transaksi" => $tglPengerjaan,
                                           "bagian" => "EXTRUDER",
                                           "keterangan_history" => "PEMAKAIAN STRIP",
                                           "kdGdBahan_Sebelumnya" => $kdGdBahanOrange_Sebelumnya,
                                           "stokBahan_Sebelumnya" => $jumlahSelesaiOrange_Sebelumnya,
                                           "idTransaksi" => $idTransaksiGudangBufferExtruder);

                            $booleanResult1 = $this->Extruder_Model->updateTransaksiGudangBufferExtruder($data1);
                            $booleanResult2 = $this->Extruder_Model->updateTransaksiGudangBufferExtruder($data2);

                            if($booleanResult1 && $booleanResult2){
                              $jumlahTransaksiSuccess++;
                            }
                            break;

                case "MB" : $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                            $jumlahSelesaiBiru = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                            $kdGdBahanMerah = "BHN170612020";
                            $kdGdBahanBiru = "BHN170612019";
                            #=====Mendapatkan Jumlah Pemakaian Strip Sebelumnya=====#
                            $jumlahSelesaiMerah_Sebelumnya = $resultPemakaianStrip[0]["jumlah"];
                            $jumlahSelesaiBiru_Sebelumnya = $resultPemakaianStrip[1]["jumlah"];
                            $kdGdBahanMerah_Sebelumnya = $resultPemakaianStrip[0]["kd_gd_bahan"];
                            $kdGdBahanBiru_Sebelumnya = $resultPemakaianStrip[1]["kd_gd_bahan"];
                            $idTransaksiGudangBufferExtruder = $resultPemakaianStrip[0]["id"];
                            #=====Mendapatkan Jumlah Pemakaian Strip Sebelumnya=====#

                            $pemakaianStrip = implode("#",array($jumlahSelesaiMerah,$jumlahSelesaiBiru));
                            $data1 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                          "kd_extruder" => $kdExtruder,
                                          "stok" => $jumlahSelesaiMerah,
                                          "id_user" => $idUser,
                                          "nama" => "EXTRUDER",
                                          "tgl_transaksi" => $tglPengerjaan,
                                          "bagian" => "EXTRUDER",
                                          "keterangan_history" => "PEMAKAIAN STRIP",
                                          "kdGdBahan_Sebelumnya" => $kdGdBahanMerah_Sebelumnya,
                                          "stokBahan_Sebelumnya" => $jumlahSelesaiMerah_Sebelumnya,
                                          "idTransaksi" => $idTransaksiGudangBufferExtruder);

                            $data2 = array("kd_gd_bahan" => $kdGdBahanBiru,
                                           "kd_extruder" => $kdExtruder,
                                           "stok" => $jumlahSelesaiBiru,
                                           "id_user" => $idUser,
                                           "nama" => "EXTRUDER",
                                           "tgl_transaksi" => $tglPengerjaan,
                                           "bagian" => "EXTRUDER",
                                           "keterangan_history" => "PEMAKAIAN STRIP",
                                           "kdGdBahan_Sebelumnya" => $kdGdBahanBiru_Sebelumnya,
                                           "stokBahan_Sebelumnya" => $jumlahSelesaiBiru_Sebelumnya,
                                           "idTransaksi" => $idTransaksiGudangBufferExtruder);

                            $booleanResult1 = $this->Extruder_Model->updateTransaksiGudangBufferExtruder($data1);
                            $booleanResult2 = $this->Extruder_Model->updateTransaksiGudangBufferExtruder($data2);

                            if($booleanResult1 && $booleanResult2){
                              $jumlahTransaksiSuccess++;
                            }
                            break;

                default: if($warnaStrip == "PUTIH"){
                          $kdBahanStrip = $warnaStrip;
                          $jumlahSelesaiStrip = ($hasil - $rollPipa) * 0.0015;
                          $pemakaianStrip = $jumlahSelesaiStrip;
                          $data = array("kd_extruder" => $kdExtruder,
                                        "stok" => $jumlahSelesaiStrip,
                                        "id_user" => $idUser,
                                        "nama" => "EXTRUDER",
                                        "tgl_transaksi" => $tglPengerjaan,
                                        "bagian" => "EXTRUDER",
                                        "keterangan_history" => "PEMAKAIAN STRIP");
                          $booleanResult = $this->Extruder_Model->insertTransaksiGudangBufferExtruder($data);
                          if($booleanResult){
                            $jumlahTransaksiSuccess++;
                          }
                        }else{
                          $kdBahanStrip = $warnaStrip;
                          $jumlahSelesaiStrip = (($hasil - $rollPipa)-$jumlahBijiWarna) * 0.0015;
                          #=====Mendapatkan Jumlah Pemakaian Strip Sebelumnya=====#
                          $jumlahSelesaiStrip_Sebelumnya = $resultPemakaianStrip[0]["jumlah"];
                          $kdBahanStrip_Sebelumnya = $resultPemakaianStrip[0]["kd_gd_bahan"];
                          $idTransaksiGudangBufferExtruder = $resultPemakaianStrip[0]["id"];
                          #=====Mendapatkan Jumlah Pemakaian Strip Sebelumnya=====#

                          $pemakaianStrip = $jumlahSelesaiStrip;
                          $data = array("kd_gd_bahan" => $kdBahanStrip,
                                        "kd_extruder" => $kdExtruder,
                                        "stok" => $jumlahSelesaiStrip,
                                        "id_user" => $idUser,
                                        "nama" => "EXTRUDER",
                                        "tgl_transaksi" => $tglPengerjaan,
                                        "bagian" => "EXTRUDER",
                                        "keterangan_history" => "PEMAKAIAN STRIP",
                                        "kdGdBahan_Sebelumnya" => $kdBahanStrip_Sebelumnya,
                                        "stokBahan_Sebelumnya" => $jumlahSelesaiStrip_Sebelumnya,
                                        "idTransaksi" => $idTransaksiGudangBufferExtruder);
                          $booleanResult = $this->Extruder_Model->updateTransaksiGudangBufferExtruder($data);
                          if($booleanResult){
                            $jumlahTransaksiSuccess++;
                          }
                        }
                        break;
              }
          }
        }

        $data = array("id_hasil_extruder" => $idTransaksi,
                      "kd_extruder" => $kdExtruder,
                      "jumlah_selesai" => $hasil,
                      "biji_warna" => $namaBijiWarna,
                      "jumlah_biji_warna" => $jumlahBijiWarna,
                      "pemakaian_strip" => $pemakaianStrip,
                      "hasil_ukuran" => $ukuran,
                      "hasil_berat" => $berat,
                      "roll_pipa" => $rollPipa,
                      "roll_lembar" => $rollLembar,
                      "jenis_roll" => $jenisRoll,
                      "keterangan" => $keterangan,
                      "shift" => $shift,
                      "jumlahPermintaan" => $jumlahPermintaan);
         $result = $this->Extruder_Model->updateHasilExtruder($data);
         if($result){
           $jumlahTransaksiSuccess++;
         }
         if($jumlahTransaksiSuccess > 0){
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

  public function deleteHasilJobExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $kdExtruder = $this->input->post("kdExtruder");
      $deleted = $this->input->post("deleted");

    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDataKirimHasilExtruderKePpic(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglRencana = $this->input->post("tglRencana");
      $jnsBrg = $this->input->post("jnsBrg");
      $shift = $this->input->post("shift");
      $data = array("tgl_rencana" => $tglRencana,
                    "jns_brg" => $jnsBrg,
                    "shift" => $shift);
      $result = $this->Extruder_Model->selectDataKirimHasilExtruderKePpic($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKirimHasilKePpic(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kirimKePpic = $this->input->post("kirimKePpic");
      $idData = $this->input->post("idData");
      $data = array("kirim_ke_ppic" => $kirimKePpic,
                    "id_data" => $idData);
      $result = $this->Extruder_Model->updateKirimDanBatalKirimHasilExtruder($data);
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

  public function getDataRencanaMandorSelesai(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");

      $data = array("tglAwal"   => $tglAwal,
                    "tglAkhir"  => $tglAkhir);
      $result = $this->Extruder_Model->selectDataRencanaMandorSelesai($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDataBonRollPolos(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $result = $this->Extruder_Model->selectDataBonRollPolos($tanggal);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKirimDataBonRollPolos(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $result = json_decode($this->Extruder_Model->selectDataBonRollPolos($tanggal),TRUE);
      $dataContainer = array("tglRencana" => $tanggal,
                             "Data" => array());
      if(count($result) > 0){
        foreach ($result as $arrResult) {
          switch ($arrResult["jenis_roll"]) {
            case "BOBIN": $data = array("kd_gd_roll" => $arrResult["kd_gd_roll"],
                                        "id_user" => $this->session->userdata("fabricationIdUser"),
                                        "jns_permintaan" => "POLOS",
                                        "tgl_transaksi" => $arrResult["tgl_rencana"],
                                        "bagian" => "EXTRUDER",
                                        "keterangan_transaksi" => "Hasil Extruder Tanggal ".$arrResult["tgl_rencana"],
                                        "status_history" => "MASUK",
                                        "status_transaksi" => "PROGRESS",
                                        "keterangan_history" => "HASIL EXTRUDER",
                                        "berat" => $arrResult["jumlah_selesai"],
                                        "bobin" => $arrResult["roll_lembar"],
                                        "payung" => 0,
                                        "payung_kuning" => 0,
                                        "shift" => $arrResult["shift"]);
                                        break;

            case "PAYUNG": $data = array("kd_gd_roll" => $arrResult["kd_gd_roll"],
                                         "id_user" => $this->session->userdata("fabricationIdUser"),
                                         "jns_permintaan" => "POLOS",
                                         "tgl_transaksi" => $arrResult["tgl_rencana"],
                                         "bagian" => "EXTRUDER",
                                         "keterangan_transaksi" => "Hasil Extruder Tanggal ".$arrResult["tgl_rencana"],
                                         "status_history" => "MASUK",
                                         "status_transaksi" => "PROGRESS",
                                         "keterangan_history" => "HASIL EXTRUDER",
                                         "berat" => $arrResult["jumlah_selesai"],
                                         "bobin" => 0,
                                         "payung" => $arrResult["roll_lembar"],
                                         "payung_kuning" => 0,
                                         "shift" => $arrResult["shift"]);
                                         break;
            case "PAYUNG_KUNING": $data = array("kd_gd_roll" => $arrResult["kd_gd_roll"],
                                                "id_user" => $this->session->userdata("fabricationIdUser"),
                                                "jns_permintaan" => "POLOS",
                                                "tgl_transaksi" => $arrResult["tgl_rencana"],
                                                "bagian" => "EXTRUDER",
                                                "keterangan_transaksi" => "Hasil Extruder Tanggal ".$arrResult["tgl_rencana"],
                                                "status_history" => "MASUK",
                                                "status_transaksi" => "PROGRESS",
                                                "keterangan_history" => "HASIL EXTRUDER",
                                                "berat" => $arrResult["jumlah_selesai"],
                                                "bobin" => 0,
                                                "payung" => 0,
                                                "payung_kuning" => $arrResult["roll_lembar"],
                                                "shift" => $arrResult["shift"]);
                                                break;

            default: break;
          }
          if($arrResult["sts_pengiriman"] == "FALSE"){
            array_push($dataContainer["Data"], $data);
          }
        }
        $result = $this->Extruder_Model->insertKirimDataBonRollPolos($dataContainer);
        echo $result;
        // echo "<pre>";
        // print_r($dataContainer);
        // echo "</pre>";
      }else{
        echo "Data Kosong";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printDataBonRollPolos($tanggal){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result["Data"] = json_decode($this->Extruder_Model->selectDataBonRollPolos($tanggal),TRUE);
      $result["Tanggal"] = date("d F Y",strtotime($tanggal));
      // $css = "assets/bootstrap/css/bootstrap.min.css";
      // $page = $this->load->view("frm_print_data_bon_roll_polos",$result,true);
      $this->load->view("frm_print_data_bon_roll_polos",$result);
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

  public function getDetailBonRollPolos(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglRencana = $this->input->post("tglRencana");
      $merek = $this->input->post("merek");
      $shift = $this->input->post("shift");

      $data = array("tglRencana" => $tglRencana,
                    "merek" => $merek,
                    "shift" => $shift);
      $result = $this->Extruder_Model->selectDetailBonRollPolos($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printDetailBonRollPolos($tanggal,$merek,$shift){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglRencana" => $tanggal,
                    "merek" => str_replace("%20"," ",$merek),
                    "shift" => $shift);
      $result["Data"] = json_decode($this->Extruder_Model->selectDetailBonRollPolos($data),TRUE);
      $result["Tanggal"] = date("d F Y",strtotime($tanggal));
      // $css = "assets/bootstrap/css/bootstrap.min.css";
      // $page = $this->load->view("frm_print_detail_bon_roll_polos",$result,true);
      $this->load->view("frm_print_detail_bon_roll_polos",$result);
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

  public function getComboBoxGudangApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->selectComboBoxValueGudangApal();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveTambahApalPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jumlahApal = $this->input->post("jumlahApal");
      $kdGdApal = $this->input->post("kdGdApal");
      $shift = $this->input->post("shift");
      $tglTransaksi = $this->input->post("tglTransaksi");
      $jnsApal = $this->input->post("jnsApal");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nama = $this->session->userdata("fabricationUsername");

      if(empty($jumlahApal) || empty($kdGdApal) || $shift=="" || empty($tglTransaksi)){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_apal" => $kdGdApal,
                      "id_user" => $idUser,
                      "nama" => $nama,
                      "tgl_transaksi" => $tglTransaksi,
                      "merek" => $jnsApal,
                      "warna" => $jnsApal,
                      "bagian" => "EXTRUDER",
                      "jumlah_apal" => $jumlahApal,
                      "keterangan_history" => "KIRIMAN APAL",
                      "shift" => $shift,
                      "status_history" => "MASUK");
        $result = $this->Extruder_Model->insertTransaksiDetailHistoryApal($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDataBonApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $result  = $this->Extruder_Model->selectDataBonApal($tanggal);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestoreDataBonApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      $data = array("id" => $idTransaksi,
                    "deleted" => $deleted);
      $result = $this->Extruder_Model->updateTransaksiDetailHistoryApal($data);
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

  public function getDataBonApalPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Extruder_Model->selectDataBonApalId($idTransaksi);

      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editApalPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $jumlahApal = $this->input->post("jumlahApal");
      $kdGdApal = $this->input->post("kdGdApal");
      $shift = $this->input->post("shift");
      $tglTransaksi = $this->input->post("tglTransaksi");
      $jnsApal = $this->input->post("jnsApal");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nama = $this->session->userdata("fabricationUsername");

      if(empty($jumlahApal) || empty($kdGdApal) || $shift=="" || empty($tglTransaksi)){
        echo "Data Kosong";
      }else{
        $data = array("id" => $idTransaksi,
                      "kd_gd_apal" => $kdGdApal,
                      "id_user" => $idUser,
                      "nama" => $nama,
                      "tgl_transaksi" => $tglTransaksi,
                      "merek" => $jnsApal,
                      "warna" => $jnsApal,
                      "jumlah_apal" => $jumlahApal,
                      "shift" => $shift);
        $result = $this->Extruder_Model->updateTransaksiDetailHistoryApal($data);
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

  public function saveKirimDataBonApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $result = $this->Extruder_Model->updateKirimDataBonApal($tanggal);
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

  public function printDataBonApal($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result["Data"] = json_decode($this->Extruder_Model->selectDataBonApal($param),TRUE);
      $result["Tanggal"] = date("d F Y",strtotime($param));
      // $page = $this->load->view("frm_print_data_bon_apal",$result,true);
      $this->load->view("frm_print_data_bon_apal",$result);
      // $css = "assets/bootstrap/css/bootstrap.min.css";
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

  public function getHistoryPermintaanBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);

      $result = $this->Extruder_Model->selectHistoryPermintaanBahanBaku($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAddKembalianBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nama = $this->session->userdata("fabricationGroup");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $tglPermintaan = $this->input->post("tgl");
      $bagian = "EXTRUDER";
      $statusHistory = "MASUK";
      $keteranganHistory = "KEMBALIAN EXTRUDER";

      if(empty($kdGdBahan) || $jumlahPermintaan==""){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_bahan" => $kdGdBahan,
                      "id_user" => $idUser,
                      "nama" => strtoupper($nama),
                      "jumlah_permintaan" => $jumlahPermintaan,
                      "tgl_permintaan" => $tglPermintaan,
                      "bagian" => $bagian,
                      "status_history" => $statusHistory,
                      "keterangan_history" => $keteranganHistory);
        $result = $this->Extruder_Model->insertTransaksiGudangBahan($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getKembalianBahanBakuPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->selectKembalianBahanBakuPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailKembalianBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Extruder_Model->selectDetailKembalianBahanBaku($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editKembalianBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $idUser = $this->session->userdata("fabricationIdUser");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");

      if(empty($kdGdBahan) || empty($jumlahPermintaan)){
        echo "Data Kosong";
      }else{
        $data = array("id" => $idTransaksi,
                      "id_user" => $idUser,
                      "kd_gd_bahan" => $kdGdBahan,
                      "jumlah_permintaan" => $jumlahPermintaan);
        $result = $this->Extruder_Model->updateTransaksiGudangBahan($data);
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

  public function deletedAndRestoreKembalianBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");

      $data = array("id" => $idTransaksi,
                    "deleted" => $deleted);
      $result = $this->Extruder_Model->updateTransaksiGudangBahan($data);
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

  public function saveKirimKembalianBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->updateKirimKembalianBahanBaku();
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

  public function getHistoryKembalianBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Extruder_Model->selectHistoryKembalianBahanBaku($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getHistoryBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "kdGdBahan" => $kdGdBahan);
      $result = $this->Extruder_Model->selectHistoryBijiWarna($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getHistoryBijiWarna_GudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "kdGdBahan" => $kdGdBahan);
      $result = $this->Extruder_Model->selectHistoryBijiWarna_GudangBahan($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAddKembalianBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nama = $this->session->userdata("fabricationGroup");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $tglPermintaan = $this->input->post("tglTransaksi");
      $bagian = "EXTRUDER";
      $statusHistory = "MASUK";
      $keteranganHistory = "KEMBALIAN EXTRUDER";

      if(empty($kdGdBahan) || $jumlahPermintaan==""){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_bahan" => $kdGdBahan,
                      "id_user" => $idUser,
                      "nama" => strtoupper($nama),
                      "jumlah_permintaan" => $jumlahPermintaan,
                      "tgl_permintaan" => $tglPermintaan,
                      "bagian" => $bagian,
                      "status_history" => $statusHistory,
                      "keterangan_history" => $keteranganHistory);
        $result = $this->Extruder_Model->insertTransaksiGudangBahan($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getKembalianBijiWarnaPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->selectKembalianBijiWarnaPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailKembalianBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Extruder_Model->selectDetailKembalianBahanBaku($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editKembalianBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $idUser = $this->session->userdata("fabricationIdUser");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $tglTransaksi = $this->input->post("tglTransaksi");

      if(empty($kdGdBahan) || empty($jumlahPermintaan) || empty($tglTransaksi)){
        echo "Data Kosong";
      }else{
        $data = array("id" => $idTransaksi,
                      "id_user" => $idUser,
                      "kd_gd_bahan" => $kdGdBahan,
                      "jumlah_permintaan" => $jumlahPermintaan,
                      "tgl_permintaan" => $tglTransaksi);
        $result = $this->Extruder_Model->updateTransaksiGudangBahan($data);
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

  public function deletedAndRestoreKembalianBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");

      $data = array("id" => $idTransaksi,
                    "deleted" => $deleted);
      $result = $this->Extruder_Model->updateTransaksiGudangBahan($data);
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

  public function saveKirimKembalianBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Extruder_Model->updateKirimKembalianBijiWarna();
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

  public function getHistoryKembalianBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Extruder_Model->selectHistoryKembalianBijiWarna($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editHasilExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idHasilExtruder = $this->input->post("idHasilExtruder");
      $kdExtruder = $this->input->post("kdExtruder");#
      $kdGdRoll = $this->input->post("kdGdRoll");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $warnaPlastik = $this->input->post("warnaPlastik");#
      $tglPengerjaan = $this->input->post("tglPengerjaan");#
      $tglJadi = date("Y-m-d");#
      $noMesin = $this->input->post("noMesin");
      $merek = $this->input->post("merek");#
      $jenisBarang = $this->input->post("jnsBarang");#
      $jenisPermintaan = $this->input->post("jnsPermintaan");#
      $bijiWarna = $this->input->post("bijiWarna");#
      $namaBijiWarna = $this->input->post("namaBijiWarna");
      $komposisi = $this->input->post("komposisi");
      $keterangan = $this->input->post("keterangan");#
      $ketMerek = $this->input->post("ketMerek");
      $ukuran = $this->input->post("ukuran");#
      $tebal = $this->input->post("tebal");#
      $berat = $this->input->post("berat");#
      $strip = $this->input->post("strip");#
      $jenisRoll = $this->input->post("jenisRoll");#
      $shift = $this->input->post("shift");#
      $hasil = $this->input->post("hasil");#
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $jumlahTransaksiSuccess = 0;
      $jumlahBijiWarna = 0;
      $kdExtruderBaru = $this->input->post("kdExtruderBaru");
      $kdPpicBaru = $this->input->post("kdPpicBaru");
      $kdGdRollBaru = $this->input->post("kdGdRollBaru");
      $ukuranBaru = $this->input->post("ukuranBaru");
      $merekBaru = $this->input->post("merekBaru");
      $warnaPlastikBaru = $this->input->post("warnaPlastikBaru");
      if(empty($kdExtruder)      || empty($kdGdRoll)      || empty($idUser)          ||
         empty($warnaPlastik)    || empty($tglPengerjaan) || empty($tglJadi)         ||
         empty($jenisBarang)   || empty($jenisPermintaan) || empty($jenisRoll)       ||
         empty($bijiWarna)       || $komposisi==""        || empty($keterangan)      ||
         empty($ukuran)          || $strip==""            || $hasil==""
       ){
         echo "Data Kosong";
       }else{
         $dataHasil = array("THE" => array(),
                            "TGBE_PS" => array(),
                            "TGBE_PE" => array());
         $arrQuote = array("'",'"');
         $explodePanjang = explode("x",$ukuran);
         $panjang = str_replace($arrQuote,"in",$explodePanjang[0]);
         switch ($jenisRoll){
           case "BOBIN"          : $panjangPlastik = str_replace(",",".",$this->input->post("panjangPlastik"));
                                   $doubleSingle = $this->input->post("doubleSingle");
                                   $rumusRoll = $this->input->post("rumusRoll");
                                   $jumlahBobin = $this->input->post("jumlahBobin");
                                   $payung = 0;
                                   $payungKuning = 0;
                                   if(substr_count(strtoupper($ketMerek), "PON") > 0) { #Check Jenis Ukuran PON / Bukan
                                     $arrPanjangPlastik = explode("+",$panjangPlastik);
                                     if(count($arrPanjangPlastik) == 2){ #untuk memisahkan ukuran lipatan atau bukan
                                       if(floatval($arrPanjangPlastik[0]) >= 20 && floatval($arrPanjangPlastik[0]) < 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + 5;
                                       }else if(floatval($arrPanjangPlastik[0]) >= 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + 5.5;
                                       }else{
                                         $TPanjangPlastik = 0;
                                       }
                                     }else{
                                       if(floatval($arrPanjangPlastik[0]) >= 20 && floatval($arrPanjangPlastik[0]) < 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + 5;
                                       }else if(floatval($arrPanjangPlastik[0]) >= 26.5){
                                         $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + 5.5;
                                       }else{
                                         $TPanjangPlastik = 0;
                                       }
                                     }
                                   }else{
                                     if(strpos($panjangPlastik,"+") === FALSE){
                                       if(strpos($panjangPlastik,"in") !== FALSE){
                                         $TPanjangPlastik = floatval($panjangPlastik) * 2.54;
                                       }else{
                                         $TPanjangPlastik = floatval($panjangPlastik);
                                       }
                                     }else{
                                       if(strpos($panjangPlastik,"in") !== FALSE){
                                         $arrPanjangPlastik = explode("+",$panjangPlastik);
                                         switch (count($arrPanjangPlastik)) {
                                           case 2: $TPanjangPlastik = (floatval($arrPanjangPlastik[0]) * 2.54) + floatval($arrPanjangPlastik[1]);
                                                   break;
                                           case 3: $TPanjangPlastik = (floatval($arrPanjangPlastik[0]) * 2.54) + (floatval($arrPanjangPlastik[1]) * 2.54) + floatval($arrPanjangPlastik[2]);
                                                   break;

                                           default: $TPanjangPlastik = floatval($arrPanjangPlastik) * 2.54;
                                             break;
                                         }
                                       }else{
                                         $arrPanjangPlastik = explode("+",$panjangPlastik);
                                         switch (count($arrPanjangPlastik)) {
                                           case 2: $TPanjangPlastik = floatval($arrPanjangPlastik[0])+ floatval($arrPanjangPlastik[1]);
                                                   break;
                                           case 3: $TPanjangPlastik = floatval($arrPanjangPlastik[0]) + floatval($arrPanjangPlastik[1]) + floatval($arrPanjangPlastik[2]);
                                                   break;

                                           default: $TPanjangPlastik = floatval($arrPanjangPlastik);
                                             break;
                                         }
                                       }
                                     }
                                   }
                                   $rollPipa = ($TPanjangPlastik * $doubleSingle * $rumusRoll * $jumlahBobin) / 1000;
                                   $rollLembar = $jumlahBobin;
                                   break;

           case "PAYUNG"         : $panjangPlastik = 0;
                                   $doubleSingle = 0;
                                   $rumusRoll = $this->input->post("rumusRoll");
                                   $jumlahBobin = 0;
                                   $payung = $this->input->post("payung");
                                   $payungKuning = 0;
                                   $rollPipa = ($payung * $rumusRoll) / 1000;
                                   $rollLembar = $payung;
                                   break;

           case "PAYUNG_KUNING"  : $panjangPlastik = 0;
                                   $doubleSingle = 0;
                                   $rumusRoll = $this->input->post("rumusRoll");
                                   $jumlahBobin = 0;
                                   $payung = 0;
                                   $payungKuning = $this->input->post("payungKuning");
                                   $rollPipa = ($payungKuning * $rumusRoll) / 1000;
                                   $rollLembar = $payungKuning;
                                   break;

           default               : $panjangPlastik = 0;
                                   $doubleSingle = 0;
                                   $rumusRoll = 0;
                                   $jumlahBobin = 0;
                                   $payung = 0;
                                   $payungKuning = 0;
                                   $rollPipa = 0;
                                   $rollLembar = 0;
                                   break;
         }

         if($bijiWarna != "putih"){
           $jumlahBijiWarna = ($hasil - $rollPipa) / 25 * $komposisi / 1000;
           $data = array("kd_gd_bahan" => $bijiWarna,
                         "kd_extruder" => $kdExtruder,
                         "stok" => $jumlahBijiWarna,
                         "id_user" => $idUser,
                         "nama" => "EXTRUDER",
                         "tgl_transaksi" => $tglPengerjaan,
                         "bagian" => "EXTRUDER",
                         "keterangan_history" => "PEMAKAIAN EXTRUDER");
           array_push($dataHasil["TGBE_PE"],$data);
         }else{
           $data = array("kd_extruder" => $kdExtruder,
                         "stok" => 0,
                         "id_user" => $idUser,
                         "nama" => "EXTRUDER",
                         "tgl_transaksi" => $tglPengerjaan,
                         "bagian" => "EXTRUDER",
                         "keterangan_history" => "PEMAKAIAN EXTRUDER");
           array_push($dataHasil["TGBE_PE"],$data);
         }
         if($keterangan == "STRIP"){
           $warnaStrip = $this->input->post("warnaStrip");
           switch($warnaStrip){
             case "MP" : $jumlahSelesaiPutihSusu = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $kdGdBahanPutihSusu = "BHN170612028";
                         $kdGdBahanMerah = "BHN170612020";
                         $pemakaianStrip = implode("#",array($jumlahSelesaiPutihSusu,$jumlahSelesaiMerah));
                         $data1 = array("kd_gd_bahan" => $kdGdBahanPutihSusu,
                                       "kd_extruder" => $kdExtruder,
                                       "stok" => $jumlahSelesaiPutihSusu,
                                       "id_user" => $idUser,
                                       "nama" => "EXTRUDER",
                                       "tgl_transaksi" => $tglPengerjaan,
                                       "bagian" => "EXTRUDER",
                                       "keterangan_history" => "PEMAKAIAN STRIP");

                         $data2 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                        "kd_extruder" => $kdExtruder,
                                        "stok" => $jumlahSelesaiMerah,
                                        "id_user" => $idUser,
                                        "nama" => "EXTRUDER",
                                        "tgl_transaksi" => $tglPengerjaan,
                                        "bagian" => "EXTRUDER",
                                        "keterangan_history" => "PEMAKAIAN STRIP");

                         array_push($dataHasil["TGBE_PS"],$data1);
                         array_push($dataHasil["TGBE_PS"],$data2);
                         break;

             case "MO" : $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $jumlahSelesaiOrange = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $kdGdBahanMerah = "BHN170612020";
                         $kdGdBahanOrange = "BHN170612022";
                         $pemakaianStrip = implode("#",array($jumlahSelesaiMerah,$jumlahSelesaiOrange));
                         $data1 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                       "kd_extruder" => $kdExtruder,
                                       "stok" => $jumlahSelesaiMerah,
                                       "id_user" => $idUser,
                                       "nama" => "EXTRUDER",
                                       "tgl_transaksi" => $tglPengerjaan,
                                       "bagian" => "EXTRUDER",
                                       "keterangan_history" => "PEMAKAIAN STRIP");

                         $data2 = array("kd_gd_bahan" => $kdGdBahanOrange,
                                        "kd_extruder" => $kdExtruder,
                                        "stok" => $jumlahSelesaiOrange,
                                        "id_user" => $idUser,
                                        "nama" => "EXTRUDER",
                                        "tgl_transaksi" => $tglPengerjaan,
                                        "bagian" => "EXTRUDER",
                                        "keterangan_history" => "PEMAKAIAN STRIP");

                         array_push($dataHasil["TGBE_PS"],$data1);
                         array_push($dataHasil["TGBE_PS"],$data2);
                         break;

             case "MB" : $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $jumlahSelesaiBiru = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                         $kdGdBahanMerah = "BHN170612020";
                         $kdGdBahanBiru = "BHN170612019";
                         $pemakaianStrip = implode("#",array($jumlahSelesaiMerah,$jumlahSelesaiBiru));
                         $data1 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                       "kd_extruder" => $kdExtruder,
                                       "stok" => $jumlahSelesaiMerah,
                                       "id_user" => $idUser,
                                       "nama" => "EXTRUDER",
                                       "tgl_transaksi" => $tglPengerjaan,
                                       "bagian" => "EXTRUDER",
                                       "keterangan_history" => "PEMAKAIAN STRIP");

                         $data2 = array("kd_gd_bahan" => $kdGdBahanBiru,
                                        "kd_extruder" => $kdExtruder,
                                        "stok" => $jumlahSelesaiBiru,
                                        "id_user" => $idUser,
                                        "nama" => "EXTRUDER",
                                        "tgl_transaksi" => $tglPengerjaan,
                                        "bagian" => "EXTRUDER",
                                        "keterangan_history" => "PEMAKAIAN STRIP");

                         array_push($dataHasil["TGBE_PS"],$data1);
                         array_push($dataHasil["TGBE_PS"],$data2);
                         break;

             case "MERAH / TS" : $jumlahSelesaiMerah = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                 // $jumlahSelesaiBiru = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                 $kdGdBahanMerah = "BHN170612020";
                                 // $kdGdBahanBiru = "BHN170612019";
                                 $pemakaianStrip = implode("#",array($jumlahSelesaiMerah,0));
                                 $data1 = array("kd_gd_bahan" => $kdGdBahanMerah,
                                               "kd_extruder" => $kdExtruder,
                                               "stok" => $jumlahSelesaiMerah,
                                               "id_user" => $idUser,
                                               "nama" => "EXTRUDER",
                                               "tgl_transaksi" => $tglPengerjaan,
                                               "bagian" => "EXTRUDER",
                                               "keterangan_history" => "PEMAKAIAN STRIP");
                                  array_push($dataHasil["TGBE_PS"],$data1);
                                 break;

               case "ORANGE / TS" : $jumlahSelesaiOrange = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                   // $jumlahSelesaiBiru = (($hasil - $rollPipa) - $jumlahBijiWarna) * 0.00075;
                                   $kdGdBahanOrange = "BHN170612022";
                                   // $kdGdBahanBiru = "BHN170612019";
                                   $pemakaianStrip = implode("#",array($jumlahSelesaiOrange,0));
                                   $data1 = array("kd_gd_bahan" => $kdGdBahanOrange,
                                                 "kd_extruder" => $kdExtruder,
                                                 "stok" => $jumlahSelesaiOrange,
                                                 "id_user" => $idUser,
                                                 "nama" => "EXTRUDER",
                                                 "tgl_transaksi" => $tglPengerjaan,
                                                 "bagian" => "EXTRUDER",
                                                 "keterangan_history" => "PEMAKAIAN STRIP");

                                   array_push($dataHasil["TGBE_PS"],$data1);
                                   break;

             default: if($warnaStrip == "PUTIH"){
                       $kdBahanStrip = $warnaStrip;
                       $jumlahSelesaiStrip = ($hasil - $rollPipa) * 0.0015;
                       $pemakaianStrip = $jumlahSelesaiStrip;
                       $data = array("kd_extruder" => $kdExtruder,
                                     "stok" => $jumlahSelesaiStrip,
                                     "id_user" => $idUser,
                                     "nama" => "EXTRUDER",
                                     "tgl_transaksi" => $tglPengerjaan,
                                     "bagian" => "EXTRUDER",
                                     "keterangan_history" => "PEMAKAIAN STRIP");
                       array_push($dataHasil["TGBE_PS"],$data);
                     }else{
                       $kdBahanStrip = $warnaStrip;
                       $jumlahSelesaiStrip = (($hasil - $rollPipa)-$jumlahBijiWarna) * 0.0015;
                       $pemakaianStrip = $jumlahSelesaiStrip;
                       $data = array("kd_gd_bahan" => $kdBahanStrip,
                                     "kd_extruder" => $kdExtruder,
                                     "stok" => $jumlahSelesaiStrip,
                                     "id_user" => $idUser,
                                     "nama" => "EXTRUDER",
                                     "tgl_transaksi" => $tglPengerjaan,
                                     "bagian" => "EXTRUDER",
                                     "keterangan_history" => "PEMAKAIAN STRIP");
                       array_push($dataHasil["TGBE_PS"],$data);
                     }
                     break;
           }
         }

         $data = array("id_hasil_extruder" => $idHasilExtruder,
                       "kd_extruder" => $kdExtruder,
                       "kd_gd_roll" => $kdGdRoll,
                       "id_user" => $idUser,
                       "tgl_rencana" => $tglPengerjaan,
                       "jumlah_selesai" => $hasil,
                       "jns_permintaan" => $jenisPermintaan,
                       "biji_warna" => $namaBijiWarna,
                       "jumlah_biji_warna" => $jumlahBijiWarna,
                       "pemakaian_strip" => $pemakaianStrip,
                       // "warna_plastik" => $warnaPlastik,
                       "hasil_ukuran" => $ukuran,
                       "panjang" => $panjang,
                       "hasil_berat" => $berat,
                       "roll_pipa" => $rollPipa,
                       "roll_lembar" => $rollLembar,
                       "jenis_roll" => $jenisRoll,
                       "keterangan" => $keterangan,
                       "shift" => $shift,
                       // "merek" => $merek,
                       "jns_brg" => $jenisBarang,
                       "kdExtruderBaru" => $kdExtruderBaru,
                       "kdPpicBaru" => $kdPpicBaru,
                       "kdGdRollBaru" => $kdGdRollBaru,
                       "ukuranBaru" => $ukuranBaru,
                       "merekBaru" => $merekBaru,
                       "warnaPlastik" => $warnaPlastikBaru);
          array_push($dataHasil["THE"],$data);
          $booleanResult = $this->Extruder_Model->updateLaporanRencanaMandor($dataHasil);
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

  public function editDataJobExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $bijiWarna = $this->input->post("bijiWarna");
      $total = $this->input->post("total");
      $apal = $this->input->post("apal");
      $plusminus = $this->input->post("plusminus");
      $sisaBahan = $this->input->post("sisaBahan");
      $penambahanBiji = $this->input->post("penambahanBiji");
      $penguranganBiji = $this->input->post("penguranganBiji");
      $sisa = $this->input->post("sisa");
      if($bijiWarna=="" || $total==""||
         $apal=="" || $plusminus=="" || $sisaBahan=="" ||
         $penambahanBiji == "" || $penguranganBiji == "" || $sisa==""){
        echo "Data Kosong";
      }else{
        $data = array("id_data" => $idTransaksi,
                      "total_biji_warna" => $bijiWarna,
                      "total" => $total,
                      "jumlah_apal" => $apal,
                      "plusminus" => $plusminus,
                      "sisa_bahan" => $sisaBahan,
                      "penambahan_biji" => $penambahanBiji,
                      "pengurangan_biji" => $penguranganBiji,
                      "sisa_biji_kemarin" => $sisa);
        $result = $this->Extruder_Model->updateDataJobExtruder($data);
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

  public function getPengambilanPotongExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $result = $this->Extruder_Model->selectPengambilanPotongExtruder($tanggal);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPengambilanCetakExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $result = $this->Extruder_Model->selectPengambilanCetakExtruder($tanggal);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printHasilExtruder($shift, $jnsBrg, $tglRencana){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tgl_rencana" => $tglRencana,
                    "jns_brg" => $jnsBrg,
                    "shift" => $shift);
      $result["Data"] = json_decode($this->Extruder_Model->selectDataHasilExtruder($data), TRUE);
      $result["Tanggal"] = date("d F Y",strtotime($tglRencana));
      // $page = $this->load->view("frm_print_hasil_extruder",$result,true);
      $this->load->view("frm_print_hasil_extruder",$result);
      // $css = "assets/bootstrap/css/bootstrap.min.css";
      // $this->load->library('m_pdf');
      // $this->mpdf->mPDF("utf-8","A4-P",0,"",5,5,8,8,5,3);
      // $this->mpdf->setFooter("Page ".'{PAGENO}');
      // $this->mpdf->WriteHTML(file_get_contents($css),1);
      // $this->mpdf->WriteHTML($page);
      // $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPenambahanBahanBakuUntukJob(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $shift = $this->input->post("shift");
      $data = array("tanggal" => $tanggal,
                    "shift" => $shift);
      $result = $this->Extruder_Model->selectJumlahPenambahanBahanBakuUntukJob($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboRencanaMandorExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $key = $this->input->get("q");
      $result = $this->Extruder_Model->selectComboRencanaMandorExtruder($key);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestoreHasilExtruderTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      if(empty($idTransaksi) || empty($deleted)){
        echo "Data Kosong";
      }else{
        $data = array("id_hasil_extruder" => $idTransaksi,
                      "deleted" => $deleted);
        $result = $this->Extruder_Model->updateDeleteAndRestoreHasilExtruderTemp($data);
        // echo $result;
        print_r($result);
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
}
?>
