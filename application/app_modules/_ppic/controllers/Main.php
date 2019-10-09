<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model("Ppic_Model");
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
       ($this->session->userdata("fabricationGroup")=="ppic"||
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
          array("Content"=>"Cek Gudang","Link"=>"#","Name"=>"Cek_Gudang","Status"=>"Parent","Icon"=>"fa fa-check","Id"=>"Cek-Gudang-Parent-Menu"),
          array("Content"=>"Order","Link"=>"#","Name"=>"Order","Status"=>"Parent","Icon"=>"fa fa-shopping-cart","Id"=>"Order-Parent-Menu"),
          array("Content"=>"Extruder","Link"=>"#","Name"=>"Extruder","Status"=>"Parent","Icon"=>"fa fa-folder","Id"=>"Extruder-Parent-Menu"),
          array("Content"=>"Potong","Link"=>"#","Name"=>"Potong","Status"=>"Parent","Icon"=>"fa fa-folder","Id"=>"Potong-Parent-Menu"),
          array("Content"=>"Cetak","Link"=>"#","Name"=>"Cetak","Status"=>"Parent","Icon"=>"fa fa-folder","Id"=>"Cetak-Parent-Menu"),
          array("Content"=>"Sablon","Link"=>"#","Name"=>"Sablon","Status"=>"Parent","Icon"=>"fa fa-folder","Id"=>"Sablon-Parent-Menu"),
        );
        $listMenu["childMenu"] = array(
          #=======Cek Gudang Child Menu (Start)=======#
          array("Content"=>"Gudang Roll","Link"=>"_ppic/main/cek_gudang_roll","Parent"=>"Cek_Gudang","Id"=>"Gudang-Roll-Child-Menu"),
          array("Content"=>"Gudang Hasil","Link"=>"_ppic/main/cek_gudang_hasil","Parent"=>"Cek_Gudang","Id"=>"Gudang-Hasil-Child-Menu"),
          #=======Cek Gudang Child Menu (Finish)=======#

          #=======Order Child Menu (Start)=======#
          array("Content"=>"Order Marketing","Link"=>"_ppic/main/order_marketing","Parent"=>"Order","Id"=>"Order-Dalam-Kota-Child-Menu"),
          array("Content"=>"Order Cabang","Link"=>"_ppic/main/order_cabang","Parent"=>"Order","Id"=>"Order-Luar-Kota-Child-Menu"),
          #=======Order Child Menu (Finish)=======#

          #=======Extruder Child Menu (Start)=======#
          array("Content"=>"Rencana Kerja Extruder","Link"=>"_ppic/main/rencana_kerja_extruder","Parent"=>"Extruder","Id"=>"Rencana-Kerja-Extruder-Child-Menu"),
          array("Content"=>"Rencana Kerja Mandor","Link"=>"_ppic/main/rencana_kerja_mandor_extruder","Parent"=>"Extruder","Id"=>"Rencana-Kerja-Mandor-Extruder-Child-Menu"),
          array("Content"=>"Hasil Global Extruder","Link"=>"_ppic/main/hasil_global_extruder","Parent"=>"Extruder","Id"=>"Hasil-Global-Extruder-Child-Menu"),
          array("Content"=>"Laporan Hasil Extruder","Link"=>"_ppic/main/laporan_hasil_extruder","Parent"=>"Extruder","Id"=>"Laporan-Hasil-Extruder-Child-Menu"),
          array("Content"=>"History PPIC (Extruder)","Link"=>"_ppic/main/history_pic_extruder","Parent"=>"Extruder","Id"=>"History-Pic-Extruder-Child-Menu"),
          #=======Extruder Child Menu (Finish)=======#

          #=======Potong Child Menu (Start)=======#
          array("Content"=>"Rencana Kerja Potong","Link"=>"_ppic/main/rencana_kerja_potong","Parent"=>"Potong","Id"=>"Rencana-Kerja-Potong-Child-Menu"),
          array("Content"=>"Rencana Kerja Mandor","Link"=>"_ppic/main/rencana_kerja_mandor_potong","Parent"=>"Potong","Id"=>"Rencana-Kerja-Mandor-Potong-Child-Menu"),
          array("Content"=>"Hasil Global Potong","Link"=>"_ppic/main/hasil_global_potong","Parent"=>"Potong","Id"=>"Hasil-Global-Potong-Child-Menu"),
          array("Content"=>"Laporan Pak Rantam","Link"=>"_ppic/main/laporan_pak_rantam","Parent"=>"Potong","Id"=>"Laporan-Pak-Rantam-Child-Menu"),
          array("Content"=>"Hasil Potong","Link"=>"_ppic/main/hasil_potong","Parent"=>"Potong","Id"=>"Hasil-Potong"),
          // array("Content"=>"Apal Global Potong","Link"=>"_ppic/main/apal_global_potong","Parent"=>"Potong","Id"=>"Apal-Global-Potong-Child-Menu"),
          #=======Potong Child Menu (Finish)=======#

          #=======Cetak Child Menu (Start)=======#
          array("Content"=>"Rencana Kerja Cetak","Link"=>"_ppic/main/rencana_kerja_cetak","Parent"=>"Cetak","Id"=>"Rencana-Kerja-Cetak-Child-Menu"),
          array("Content"=>"Rencana Kerja Mandor","Link"=>"_ppic/main/rencana_kerja_mandor_cetak","Parent"=>"Cetak","Id"=>"Rencana-Kerja-Mandor-Cetak-Child-Menu"),
          array("Content"=>"Hasil Cetak","Link"=>"_ppic/main/hasil_cetak","Parent"=>"Cetak","Id"=>"Hasil-Cetak-Child-Menu"),
          #=======Cetak Child Menu (Finish)=======#

          #=======Sablon Child Menu (Start)=======#
          array("Content"=>"Rencana Kerja Sablon","Link"=>"_ppic/main/rencana_kerja_sablon","Parent"=>"Sablon","Id"=>"Rencana-Kerja-Sablon-Child-Menu"),
          array("Content"=>"Rencana Kerja Mandor","Link"=>"_ppic/main/rencana_kerja_mandor_sablon","Parent"=>"Sablon","Id"=>"Rencana-Kerja-Mandor-Sablon-Child-Menu"),
          array("Content"=>"Hasil Sablon","Link"=>"_ppic/main/hasil_sablon","Parent"=>"Sablon","Id"=>"Hasil-Sablon-Child-Menu"),
          #=======Sablon Child Menu (Finish)=======#
        );
        return $listMenu;
      }else{
        $listMenu["parentMenu"] = array();
        $listMenu["childMenu"] = array();
        return $listMenu;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cek_gudang_roll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"CEK GUDANG ROLL");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_gudang_roll",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cek_gudang_hasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"CEK GUDANG HASIL");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_gudang_hasil",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function order_marketing(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"ORDER MARKETING");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_order_marketing",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function order_cabang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"ORDER CABANG");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_order_cabang",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function rencana_kerja_extruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"RENCANA KERJA EXTRUDER");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_rencana_extruder",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function rencana_kerja_mandor_extruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"RENCANA KERJA MANDOR EXTRUDER");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_rencana_kerja_mandor_extruder",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function hasil_global_extruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"HASIL GLOBAL EXTRUDER");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_hasil_global_extruder",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function laporan_hasil_extruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"LAPORAN HASIL EXTRUDER");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_laporan_hasil_extruder",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function history_pic_extruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"HISTORY PIC (EXTRUDER)");
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
  public function rencana_kerja_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"RENCANA KERJA POTONG");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_rencana_cutting",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function rencana_kerja_mandor_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"RENCANA KERJA MANDOR POTONG");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_rencana_kerja_mandor_cutting",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function hasil_global_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"HASIL GLOBAL POTONG");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_laporan_hasil_global_cutting",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function laporan_pak_rantam(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"LAPORAN PAK RANTAM");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_laporan_hasil_cutting_pak_rantam",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function apal_global_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"APAL GLOBAL POTONG");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_laporan_apal_global_cutting",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function rencana_kerja_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"RENCANA KERJA CETAK");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_rencana_printing",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function rencana_kerja_mandor_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"RENCANA KERJA MANDOR CETAK");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_rencana_kerja_mandor_printing",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function hasil_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"HASIL CETAK");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_laporan_hasil_printing",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function rencana_kerja_sablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"RENCANA KERJA SABLON");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_rencana_sablon",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function rencana_kerja_mandor_sablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"RENCANA KERJA MANDOR SABLON");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_rencana_kerja_mandor_sablon",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function hasil_sablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"HASIL SABLON");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_laporan_hasil_sablon",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function hasil_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"HASIL POTONG");
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

  public function getGeneratedCodePpic(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Code"] = $this->Ppic_Model->generatePpicCode();
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getStokBarangRoll($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      echo $this->Ppic_Model->selectStokBarangRoll($param);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getStokBarangHasil($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      echo $this->Ppic_Model->selectStokBarangHasil($param);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueRoll($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $query = $this->input->get("q");
      if (!empty($query)) {
        $data = array("jns_permintaan"=>$param,
        "key"=>$query);
        $result = $this->Ppic_Model->selectComboBoxValueRollSearch($data);
      }else{
        $data = array("jns_permintaan"=>$param,
        "key"=>"");
        $result = $this->Ppic_Model->selectComboBoxValueRoll($data);
      }
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueHasil($param,$param2=""){
    $isLogin = $this->isLogin();
    if($isLogin){
      $query = $this->input->get("q");
      if ($query != "") {
        $data = array("jns_brg"=>$param,
                      "jns_permintaan" => $param2,
                      "key"=>$query);
        $result = $this->Ppic_Model->selectComboBoxValueHasilSearch($data);
      }else{
        $data = array("jns_brg"=>$param,
                      "jns_permintaan" => $param2,
                      "key"=>"");
        $result = $this->Ppic_Model->selectComboBoxValueHasil($data);
      }
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountPesananGlobalBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = $this->Ppic_Model->selectCountPesananGlobalBaru();
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountPesananMarketingBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = $this->Ppic_Model->selectCountPesananMarketingBaru();
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountPesananCabangBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = $this->Ppic_Model->selectCountPesananCabangBaru();
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getOrderMarketing(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $thnBln = $this->input->post("thn_bln");
      $data = $this->Ppic_Model->selectOrderMarketing($thnBln);
      echo $data;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getOrderMarketingTerkirim(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = $this->Ppic_Model->selectOrderMarketingTerkirim();
      echo $data;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getOrderCabang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $thnBln = $this->input->post("thn_bln");
      $data = $this->Ppic_Model->selectOrderCabang($thnBln);
      echo $data;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getOrderCabangTerkirim(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = $this->Ppic_Model->selectOrderCabangTerkirim();
      echo $data;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printOutPesanan(){
    $isLogin = $this->isLogin();
    if ($isLogin) {
      $noOrder = $this->input->post("no_order");
      if(empty($noOrder)){
        echo "No.Order Tidak Ada!";
      }else{
        $data = array("no_order"=>$noOrder,"sts_print"=>"TRUE");
        $stsDetailPesanan = $this->Ppic_Model->updatePesananDetail($data);
        if($stsDetailPesanan == "Berhasil"){
          $stsPesanan = $this->Ppic_Model->updatePesanan($data);
          echo $stsPesanan;
        }else{
          echo "Gagal Pada Update Pesanan Detail";
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getOrderDetail(){
    $isLogin = $this->isLogin();
    if ($isLogin) {
      $param = $this->input->post("no_order");
      $data = $this->Ppic_Model->selectOrderDetail($param);
      echo $data;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function updateKirimKeGudang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("no_order");
      $stsPesanan = $this->input->post("sts_pesanan");
      if($stsPesanan=="PROGRESS"){
        $tglKirimGudang = date("Y-m-d H:i:s");
      }else{
        $tglKirimGudang = NULL;
      }
      $data = array("no_order"=>$noOrder,
                    "sts_pesanan"=>$stsPesanan,
                    "tgl_kirim_gudang"=>$tglKirimGudang);
      $result = $this->Ppic_Model->updatePesananDetail($data);
      if($result == "Berhasil"){
        $data = array("no_order"=>$noOrder,
                      "sts_pesanan" => $stsPesanan);
        $result = $this->Ppic_Model->updatePesanan($data);
        echo $result;
      }else{
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailBarangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGudangRoll = $this->input->post("kd_gd_roll");
      $result = $this->Ppic_Model->selectDetailBarangRoll($kdGudangRoll);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailBarangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGudangHasil = $this->input->post("kd_gd_hasil");
      $result = $this->Ppic_Model->selectDetailBarangHasil($kdGudangHasil);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveSpkExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kd_ppic");#
      $nmCust = $this->input->post("nm_cust");#
      $tglRencana = $this->input->post("tgl_rencana");#
      $kdGdRoll = $this->input->post("kd_gd_roll");#
      $merek = $this->input->post("merek");#
      $ketMerek = $this->input->post("ket_merek");
      $warnaPlastik = $this->input->post("warna_plastik");#
      $permintaan = $this->input->post("permintaan");#
      $ketPermintaan = $this->input->post("ket_permintaan");
      $ukuran = $this->input->post("ukuran");#
      $tebal = $this->input->post("tebal");#
      $berat = $this->input->post("berat");#
      $jmlPermintaan = $this->input->post("jml_permintaan");#
      $satuan = $this->input->post("satuan");#
      $strip = $this->input->post("strip");#
      $status = $this->input->post("status");#
      $keterangan = $this->input->post("keterangan");
      $gambar = str_replace(" ","_",$this->input->post("gambar"));

      $idUser = $this->session->userdata("fabricationIdUser");
      if(empty($kdPpic)||empty($nmCust)||empty($kdGdRoll)||empty($tglRencana)||
         empty($merek)||empty($warnaPlastik)||empty($permintaan)||
         empty($ukuran)||$tebal==""||$berat==""||$jmlPermintaan==""||
         empty($satuan)||$strip=="#"||empty($status)
       ){
         echo "<script>alert('Kolom Kuning Tidak Boleh Kosong!');</script>";
       }else{
         if($satuan == "KG"){
           $data = array("kd_ppic"=>$kdPpic,
                         "kd_gd_roll"=>$kdGdRoll,
                         "id_user"=>$idUser,
                         "nm_cust"=>$nmCust,
                         "tgl_rencana"=>$tglRencana,
                         "bagian"=>"EXTRUDER",
                         "jns_permintaan"=>$permintaan,
                         "merek"=>$merek,
                         "ukuran"=>$ukuran,
                         "ket_merek"=>$ketMerek,
                         "ket_permintaan"=>$ketPermintaan,
                         "warna_plastik"=>$warnaPlastik,
                         "tebal"=>$tebal,
                         "berat"=>$berat,
                         "jumlah_permintaan"=>$jmlPermintaan,
                         "satuan"=>$satuan,
                         "strip"=>$strip,
                         "prioritas"=>$status,
                         "sisa"=>$jmlPermintaan,
                         "keterangan"=>$keterangan,
                         "foto_depan"=>$gambar,
                         "satuan_kilo"=>$jmlPermintaan);
         }else{
           $data = array("kd_ppic"=>$kdPpic,
                         "kd_gd_roll"=>$kdGdRoll,
                         "id_user"=>$idUser,
                         "nm_cust"=>$nmCust,
                         "tgl_rencana"=>$tglRencana,
                         "bagian"=>"EXTRUDER",
                         "jns_permintaan"=>$permintaan,
                         "merek"=>$merek,
                         "ukuran"=>$ukuran,
                         "ket_merek"=>$ketMerek,
                         "ket_permintaan"=>$ketPermintaan,
                         "warna_plastik"=>$warnaPlastik,
                         "tebal"=>$tebal,
                         "berat"=>$berat,
                         "jumlah_permintaan"=>$jmlPermintaan,
                         "satuan"=>$satuan,
                         "strip"=>$strip,
                         "prioritas"=>$status,
                         "sisa"=>$jmlPermintaan,
                         "keterangan"=>$keterangan,
                         "foto_depan"=>$gambar);
         }
        $result = $this->Ppic_Model->insertSpk($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveSpkCutting(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kd_ppic");#
      $nmCust = $this->input->post("nm_cust");#
      $tglRencana = $this->input->post("tgl_rencana");#
      $kdGdHasil = $this->input->post("kd_gd_hasil");#
      $merek = $this->input->post("merek");#
      $warnaPlastik = $this->input->post("warna_plastik");#
      $ukuran = $this->input->post("ukuran");#
      $permintaan = $this->input->post("permintaan");#
      $tebal = $this->input->post("tebal");#
      $berat = $this->input->post("berat");#
      $jmlMesin = $this->input->post("jml_mesin");#
      $jmlPermintaan = $this->input->post("jml_permintaan");#
      $satuan = $this->input->post("satuan");#
      $strip = $this->input->post("strip");#
      $status = $this->input->post("status");#
      $keterangan = $this->input->post("keterangan");
      $ketMerek = $this->input->post("ketMerek");
      $ketPermintaan = $this->input->post("ketPermintaan");
      $gambar = str_replace(" ","_",$this->input->post("gambar"));

      $idUser = $this->session->userdata("fabricationIdUser");
      if(empty($kdPpic)||empty($nmCust)||empty($tglRencana)||empty($kdGdHasil)||
         empty($merek)||empty($warnaPlastik)||empty($ukuran)||$tebal==""||$berat==""||$jmlPermintaan==""||
         empty($satuan)||empty($strip)||empty($status)||$jmlMesin==""||empty($permintaan)
       ){
         echo "<script>alert('Kolom Kuning Tidak Boleh Kosong!');</script>";
       }else{
         if($satuan == "KG"){
           $data = array("kd_ppic"            => $kdPpic,
                         "kd_gd_hasil"        => $kdGdHasil,
                         "id_user"            => $idUser,
                         "nm_cust"            => $nmCust,
                         "tgl_rencana"        => $tglRencana,
                         "bagian"             => "POTONG",
                         "jns_permintaan"     => $permintaan,
                         "merek"              => $merek,
                         "ukuran"             => $ukuran,
                         "warna_plastik"      => $warnaPlastik,
                         "tebal"              => $tebal,
                         "berat"              => $berat,
                         "jumlah_permintaan"  => $jmlPermintaan,
                         "satuan"             => $satuan,
                         "strip"              => $strip,
                         "prioritas"          => $status,
                         "sisa"               => $jmlPermintaan,
                         "satuan_kilo"        => $jmlPermintaan,
                         "keterangan"         => $keterangan,
                         "ket_merek"          => $ketMerek,
                         "ket_permintaan"     => $ketPermintaan,
                         "foto_depan"         => $gambar,
                         "permintaan_mesin"   => $jmlMesin);
         }else{
           $data = array("kd_ppic"            => $kdPpic,
                         "kd_gd_hasil"        => $kdGdHasil,
                         "id_user"            => $idUser,
                         "nm_cust"            => $nmCust,
                         "tgl_rencana"        => $tglRencana,
                         "bagian"             => "POTONG",
                         "jns_permintaan"     => $permintaan,
                         "merek"              => $merek,
                         "ukuran"             => $ukuran,
                         "warna_plastik"      => $warnaPlastik,
                         "tebal"              => $tebal,
                         "berat"              => $berat,
                         "jumlah_permintaan"  => $jmlPermintaan,
                         "satuan"             => $satuan,
                         "strip"              => $strip,
                         "prioritas"          => $status,
                         "sisa"               => $jmlPermintaan,
                         "keterangan"         => $keterangan,
                         "ket_merek"          => $ketMerek,
                         "ket_permintaan"     => $ketPermintaan,
                         "foto_depan"         => $gambar,
                         "permintaan_mesin"   => $jmlMesin);
         }

        $result = $this->Ppic_Model->insertSpk($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveSpkPrinting(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kd_ppic");#
      $nmCust = $this->input->post("nm_cust");#
      $tglRencana = $this->input->post("tgl_rencana");#
      $kdGdRoll = $this->input->post("kd_gd_roll");#
      $merek = $this->input->post("merek");#
      $warnaPlastik = $this->input->post("warna_plastik");#
      $permintaan = $this->input->post("permintaan");#
      $ukuran = $this->input->post("ukuran");#
      $tebal = $this->input->post("tebal");#
      $berat = $this->input->post("berat");#
      $jmlPermintaan = $this->input->post("jml_permintaan");#
      $satuan = $this->input->post("satuan");#
      $strip = $this->input->post("strip");#
      $status = $this->input->post("status");#
      $warnaCat = $this->input->post("warna_cat");#
      $keterangan = $this->input->post("keterangan");
      $ketMerek = $this->input->post("ketMerek");
      $ketPermintaan = $this->input->post("ketPermintaan");
      $gambar = str_replace(" ","_",$this->input->post("gambar"));
      $gambar2 = str_replace(" ","_",$this->input->post("gambar2"));

      $idUser = $this->session->userdata("fabricationIdUser");
      if(empty($kdPpic)||empty($nmCust)||empty($kdGdRoll)||empty($tglRencana)||
         empty($merek)||empty($warnaPlastik)||empty($permintaan)||
         empty($ukuran)||$tebal==""||$berat==""||$jmlPermintaan==""||
         empty($satuan)||empty($strip)||empty($status)||empty($warnaCat)){
           echo "Data Kosong";
      }else{
        if($satuan=="KG"){
          $data = array("kd_ppic"           => $kdPpic,
                        "kd_gd_roll"        => $kdGdRoll,
                        "id_user"           => $idUser,
                        "nm_cust"           => $nmCust,
                        "tgl_rencana"       => $tglRencana,
                        "bagian"            => "CETAK",
                        "jns_permintaan"    => $permintaan,
                        "merek"             => $merek,
                        "ukuran"            => $ukuran,
                        "warna_plastik"     => $warnaPlastik,
                        "tebal"             => $tebal,
                        "berat"             => $berat,
                        "jumlah_permintaan" => $jmlPermintaan,
                        "satuan"            => $satuan,
                        "satuan_kilo"       => $jmlPermintaan,
                        "strip"             => $strip,
                        "prioritas"         => $status,
                        "warna_cat"         => $warnaCat,
                        "sisa"              => $jmlPermintaan,
                        "keterangan"        => $keterangan,
                        "ket_merek"         => $ketMerek,
                        "ket_permintaan"    => $ketPermintaan,
                        "foto_depan"        => $gambar,
                        "foto_belakang"     => $gambar2);
        }else{
          $data = array("kd_ppic"           => $kdPpic,
                        "kd_gd_roll"        => $kdGdRoll,
                        "id_user"           => $idUser,
                        "nm_cust"           => $nmCust,
                        "tgl_rencana"       => $tglRencana,
                        "bagian"            => "CETAK",
                        "jns_permintaan"    => $permintaan,
                        "merek"             => $merek,
                        "ukuran"            => $ukuran,
                        "warna_plastik"     => $warnaPlastik,
                        "tebal"             => $tebal,
                        "berat"             => $berat,
                        "jumlah_permintaan" => $jmlPermintaan,
                        "satuan"            => $satuan,
                        "strip"             => $strip,
                        "prioritas"         => $status,
                        "warna_cat"         => $warnaCat,
                        "sisa"              => $jmlPermintaan,
                        "keterangan"        => $keterangan,
                        "ket_merek"         => $ketMerek,
                        "ket_permintaan"    => $ketPermintaan,
                        "foto_depan"        => $gambar,
                        "foto_belakang"     => $gambar2);
        }

       $result = $this->Ppic_Model->insertSpk($data);
       echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveSpkSablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kd_ppic");#
      $nmCust = $this->input->post("nm_cust");#
      $tglRencana = $this->input->post("tgl_rencana");#
      $kdGdHasil = $this->input->post("kd_gd_hasil");#
      $merek = $this->input->post("merek");#
      $warnaPlastik = $this->input->post("warna_plastik");#
      $permintaan = $this->input->post("permintaan");#
      $ukuran = $this->input->post("ukuran");#
      $tebal = $this->input->post("tebal");#
      $berat = $this->input->post("berat");#
      $jmlPermintaan = $this->input->post("jml_permintaan");#
      $satuan = $this->input->post("satuan");#
      $warnaCetak = $this->input->post("warna_cetak");#
      $strip = $this->input->post("strip");#
      $status = $this->input->post("status");#
      $keterangan = $this->input->post("keterangan");
      $gambar = str_replace(" ","_",$this->input->post("gambar"));

      $idUser = $this->session->userdata("fabricationIdUser");
      if(empty($kdPpic)||empty($nmCust)||empty($kdGdHasil)||empty($tglRencana)||
         empty($merek)||empty($warnaPlastik)||empty($permintaan)||
         empty($ukuran)||$tebal==""||$berat==""||$jmlPermintaan==""||empty($warnaCetak)||
         empty($satuan)||empty($strip)||empty($status)
       ){
         echo "<script>alert('Kolom Kuning Tidak Boleh Kosong!');</script>";
       }else{
         if($satuan == "KG"){
           $data = array("kd_ppic"=>$kdPpic,"kd_gd_hasil"=>$kdGdHasil,"id_user"=>$idUser,
                         "nm_cust"=>$nmCust,"tgl_rencana"=>$tglRencana,"bagian"=>"SABLON",
                         "jns_permintaan"=>$permintaan,"merek"=>$merek,"ukuran"=>$ukuran,
                         "warna_plastik"=>$warnaPlastik,"tebal"=>$tebal,"berat"=>$berat,
                         "jumlah_permintaan"=>$jmlPermintaan,"satuan"=>$satuan,
                         "strip"=>$strip,"prioritas"=>$status,"sisa"=>$jmlPermintaan,"satuan_kilo"=>$jmlPermintaan,
                         "keterangan"=>$keterangan,"warna_cetak"=>$warnaCetak,"foto_depan"=>$gambar);
         }else{
           $data = array("kd_ppic"=>$kdPpic,"kd_gd_hasil"=>$kdGdHasil,"id_user"=>$idUser,
                         "nm_cust"=>$nmCust,"tgl_rencana"=>$tglRencana,"bagian"=>"SABLON",
                         "jns_permintaan"=>$permintaan,"merek"=>$merek,"ukuran"=>$ukuran,
                         "warna_plastik"=>$warnaPlastik,"tebal"=>$tebal,"berat"=>$berat,
                         "jumlah_permintaan"=>$jmlPermintaan,"satuan"=>$satuan,
                         "strip"=>$strip,"prioritas"=>$status,"sisa"=>$jmlPermintaan,
                         "keterangan"=>$keterangan,"warna_cetak"=>$warnaCetak,"foto_depan"=>$gambar);
         }

        $result = $this->Ppic_Model->insertSpk($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editSpkExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kd_ppic");#
      $nmCust = $this->input->post("nm_cust");#
      $tglRencana = $this->input->post("tgl_rencana");#
      $kdGdRoll = $this->input->post("kd_gd_roll");
      $merek = $this->input->post("merek");#
      $ketMerek = $this->input->post("ket_merek");
      $warnaPlastik = $this->input->post("warna_plastik");#
      $permintaan = $this->input->post("permintaan");#
      $ketPermintaan = $this->input->post("ket_permintaan");
      $ukuran = $this->input->post("ukuran");#
      $tebal = $this->input->post("tebal");#
      $berat = $this->input->post("berat");#
      $jmlPermintaan = $this->input->post("jml_permintaan");#
      $satuan = $this->input->post("satuan");#
      $strip = $this->input->post("strip");#
      $status = $this->input->post("status");#
      $keterangan = $this->input->post("keterangan");
      $gambar = str_replace(" ","_",$this->input->post("gambar"));

      $idUser = $this->session->userdata("fabricationIdUser");
      if(empty($kdPpic)||empty($nmCust)||empty($merek)||empty($warnaPlastik)||empty($permintaan)||
         empty($ukuran)||$tebal==""||$berat==""||$jmlPermintaan==""||
         empty($satuan)||$strip=="#"||empty($status)
       ){
         echo "<script>alert('Kolom Kuning Tidak Boleh Kosong!');</script>";
       }else{
         if(empty($kdGdRoll)){
           if(empty($gambar)){
             $data = array("kd_ppic"=>$kdPpic,"id_user"=>$idUser,
                           "nm_cust"=>$nmCust,"tgl_rencana"=>$tglRencana,"bagian"=>"EXTRUDER",
                           "jns_permintaan"=>$permintaan,"merek"=>$merek,"ukuran"=>$ukuran,
                           "ket_merek"=>$ketMerek,"ket_permintaan"=>$ketPermintaan,"warna_plastik"=>$warnaPlastik,
                           "tebal"=>$tebal,"berat"=>$berat,"jumlah_permintaan"=>$jmlPermintaan,
                           "satuan"=>$satuan,"strip"=>$strip,"prioritas"=>$status,"sisa"=>$jmlPermintaan,
                           "keterangan"=>$keterangan);
           }else{
             $data = array("kd_ppic"=>$kdPpic,"id_user"=>$idUser,
                           "nm_cust"=>$nmCust,"tgl_rencana"=>$tglRencana,"bagian"=>"EXTRUDER",
                           "jns_permintaan"=>$permintaan,"merek"=>$merek,"ukuran"=>$ukuran,
                           "ket_merek"=>$ketMerek,"ket_permintaan"=>$ketPermintaan,"warna_plastik"=>$warnaPlastik,
                           "tebal"=>$tebal,"berat"=>$berat,"jumlah_permintaan"=>$jmlPermintaan,
                           "satuan"=>$satuan,"strip"=>$strip,"prioritas"=>$status,"sisa"=>$jmlPermintaan,
                           "keterangan"=>$keterangan,"foto_depan"=>$gambar);
           }

         }else{
           if(empty($gambar)){
             $data = array("kd_ppic"=>$kdPpic,"kd_gd_roll"=>$kdGdRoll,"id_user"=>$idUser,
                           "nm_cust"=>$nmCust,"tgl_rencana"=>$tglRencana,"bagian"=>"EXTRUDER",
                           "jns_permintaan"=>$permintaan,"merek"=>$merek,"ukuran"=>$ukuran,
                           "ket_merek"=>$ketMerek,"ket_permintaan"=>$ketPermintaan,"warna_plastik"=>$warnaPlastik,
                           "tebal"=>$tebal,"berat"=>$berat,"jumlah_permintaan"=>$jmlPermintaan,
                           "satuan"=>$satuan,"strip"=>$strip,"prioritas"=>$status,"sisa"=>$jmlPermintaan,
                           "keterangan"=>$keterangan);
           }else{
             $data = array("kd_ppic"=>$kdPpic,"kd_gd_roll"=>$kdGdRoll,"id_user"=>$idUser,
                           "nm_cust"=>$nmCust,"tgl_rencana"=>$tglRencana,"bagian"=>"EXTRUDER",
                           "jns_permintaan"=>$permintaan,"merek"=>$merek,"ukuran"=>$ukuran,
                           "ket_merek"=>$ketMerek,"ket_permintaan"=>$ketPermintaan,"warna_plastik"=>$warnaPlastik,
                           "tebal"=>$tebal,"berat"=>$berat,"jumlah_permintaan"=>$jmlPermintaan,
                           "satuan"=>$satuan,"strip"=>$strip,"prioritas"=>$status,"sisa"=>$jmlPermintaan,
                           "keterangan"=>$keterangan,"foto_depan"=>$gambar);
           }
         }

        $result = $this->Ppic_Model->updateSpk($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editSpkCutting(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kd_ppic");#
      $nmCust = $this->input->post("nm_cust");#
      $tglRencana = $this->input->post("tgl_rencana");#
      $kdGdHasil = $this->input->post("kd_gd_hasil");#
      $merek = $this->input->post("merek");#
      $warnaPlastik = $this->input->post("warna_plastik");#
      $ukuran = $this->input->post("ukuran");#
      $permintaan = $this->input->post("permintaan");#
      $tebal = $this->input->post("tebal");#
      $berat = $this->input->post("berat");#
      $jmlMesin = $this->input->post("jml_mesin");#
      $jmlPermintaan = $this->input->post("jml_permintaan");#
      $satuan = $this->input->post("satuan");#
      $strip = $this->input->post("strip");#
      $status = $this->input->post("status");#
      $keterangan = $this->input->post("keterangan");
      $ketMerek = $this->input->post("ketMerek");
      $ketPermintaan = $this->input->post("ketPermintaan");
      $gambar = str_replace(" ","_",$this->input->post("gambar"));

      $idUser = $this->session->userdata("fabricationIdUser");
      if(empty($kdPpic)||empty($nmCust)||empty($tglRencana)||
         empty($merek)||empty($warnaPlastik)||empty($ukuran)||$tebal==""||$berat==""||$jmlPermintaan==""||
         empty($satuan)||empty($strip)||empty($status)||$jmlMesin==""||empty($permintaan)
       ){
         echo "<script>alert('Kolom Kuning Tidak Boleh Kosong!');</script>";
       }else{
         if(empty($kdGdRoll)){
           if(empty($gambar)){
             $data = array("kd_ppic"            => $kdPpic,
                           "id_user"            => $idUser,
                           "nm_cust"            => $nmCust,
                           "tgl_rencana"        => $tglRencana,
                           "bagian"             => "POTONG",
                           "jns_permintaan"     => $permintaan,
                           "merek"              => $merek,
                           "ukuran"             => $ukuran,
                           "warna_plastik"      => $warnaPlastik,
                           "tebal"              => $tebal,
                           "berat"              => $berat,
                           "jumlah_permintaan"  => $jmlPermintaan,
                           "satuan"             => $satuan,
                           "strip"              => $strip,
                           "prioritas"          => $status,
                           "sisa"               => $jmlPermintaan,
                           "keterangan"         => $keterangan,
                           "ket_merek"          => $ketMerek,
                           "ket_permintaan"     => $ketPermintaan,
                           "permintaan_mesin"   => $jmlMesin);
           }else{
             $data = array("kd_ppic"            => $kdPpic,
                           "id_user"            => $idUser,
                           "nm_cust"            => $nmCust,
                           "tgl_rencana"        => $tglRencana,
                           "bagian"             => "POTONG",
                           "jns_permintaan"     => $permintaan,
                           "merek"              => $merek,
                           "ukuran"             => $ukuran,
                           "warna_plastik"      => $warnaPlastik,
                           "tebal"              => $tebal,
                           "berat"              => $berat,
                           "jumlah_permintaan"  => $jmlPermintaan,
                           "satuan"             => $satuan,
                           "strip"              => $strip,
                           "prioritas"          => $status,
                           "sisa"               => $jmlPermintaan,
                           "keterangan"         => $keterangan,
                           "ket_merek"          => $ketMerek,
                           "ket_permintaan"     => $ketPermintaan,
                           "foto_depan"         => $gambar,
                           "permintaan_mesin"   => $jmlMesin);
           }

         }else{
           if(empty($gambar)){
             $data = array("kd_ppic"            => $kdPpic,
                           "kd_gd_hasil"        => $kdGdHasil,
                           "id_user"            => $idUser,
                           "nm_cust"            => $nmCust,
                           "tgl_rencana"        => $tglRencana,
                           "bagian"             => "POTONG",
                           "jns_permintaan"     => $permintaan,
                           "merek"              => $merek,
                           "ukuran"             => $ukuran,
                           "warna_plastik"      => $warnaPlastik,
                           "tebal"              => $tebal,
                           "berat"              => $berat,
                           "jumlah_permintaan"  => $jmlPermintaan,
                           "satuan"             => $satuan,
                           "strip"              => $strip,
                           "prioritas"          => $status,
                           "sisa"               => $jmlPermintaan,
                           "keterangan"         => $keterangan,
                           "ket_merek"          => $ketMerek,
                           "ket_permintaan"     => $ketPermintaan,
                           "permintaan_mesin"   => $jmlMesin);
           }else{
             $data = array("kd_ppic"            => $kdPpic,
                           "kd_gd_hasil"        => $kdGdHasil,
                           "id_user"            => $idUser,
                           "nm_cust"            => $nmCust,
                           "tgl_rencana"        => $tglRencana,
                           "bagian"             => "POTONG",
                           "jns_permintaan"     => $permintaan,
                           "merek"              => $merek,
                           "ukuran"             => $ukuran,
                           "warna_plastik"      => $warnaPlastik,
                           "tebal"              => $tebal,
                           "berat"              => $berat,
                           "jumlah_permintaan"  => $jmlPermintaan,
                           "satuan"             => $satuan,
                           "strip"              => $strip,
                           "prioritas"          => $status,
                           "sisa"               => $jmlPermintaan,
                           "keterangan"         => $keterangan,
                           "ket_merek"          => $ketMerek,
                           "ket_permintaan"     => $ketPermintaan,
                           "foto_depan"         => $gambar,
                           "permintaan_mesin"   => $jmlMesin);
           }
         }

        $result = $this->Ppic_Model->updateSpk($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editSpkPrinting(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kd_ppic");#
      $nmCust = $this->input->post("nm_cust");#
      $tglRencana = $this->input->post("tgl_rencana");#
      $kdGdRoll = $this->input->post("kd_gd_roll");#
      $merek = $this->input->post("merek");#
      $warnaPlastik = $this->input->post("warna_plastik");#
      $permintaan = $this->input->post("permintaan");#
      $ukuran = $this->input->post("ukuran");#
      $tebal = $this->input->post("tebal");#
      $berat = $this->input->post("berat");#
      $jmlPermintaan = $this->input->post("jml_permintaan");#
      $satuan = $this->input->post("satuan");#
      $strip = $this->input->post("strip");#
      $status = $this->input->post("status");#
      $warnaCat = $this->input->post("warna_cat");#
      $keterangan = $this->input->post("keterangan");
      $ketMerek = $this->input->post("ketMerek");
      $ketPermintaan = $this->input->post("ketPermintaan");
      $gambar = str_replace(" ","_",$this->input->post("gambar"));
      $gambar2 = str_replace(" ","_",$this->input->post("gambar2"));

      $idUser = $this->session->userdata("fabricationIdUser");
      if(empty($kdPpic)||empty($nmCust)||empty($tglRencana)||
         empty($merek)||empty($warnaPlastik)||empty($permintaan)||
         empty($ukuran)||$tebal==""||$berat==""||$jmlPermintaan==""||
         empty($satuan)||empty($strip)||empty($status)||empty($warnaCat)
       ){
         echo "Data Kosong";
       }else{
         if(empty($kdGdRoll)){
           if(empty($gambar)){
             if (empty($gambar2)) {
               $data = array("kd_ppic"            => $kdPpic,
                             "id_user"            => $idUser,
                             "nm_cust"            => $nmCust,
                             "tgl_rencana"        => $tglRencana,
                             "bagian"             => "CETAK",
                             "jns_permintaan"     => $permintaan,
                             "merek"              => $merek,
                             "ukuran"             => $ukuran,
                             "warna_plastik"      => $warnaPlastik,
                             "tebal"              => $tebal,
                             "berat"              => $berat,
                             "jumlah_permintaan"  => $jmlPermintaan,
                             "satuan"             => $satuan,
                             "strip"              => $strip,
                             "prioritas"          => $status,
                             "sisa"               => $jmlPermintaan,
                             "warna_cat"          => $warnaCat,
                             "keterangan"         => $keterangan,
                             "ket_merek"          => $ketMerek,
                             "ket_permintaan"     => $ketPermintaan);
             }else{
               $data = array("kd_ppic"            => $kdPpic,
                             "id_user"            => $idUser,
                             "nm_cust"            => $nmCust,
                             "tgl_rencana"        => $tglRencana,
                             "bagian"             => "CETAK",
                             "jns_permintaan"     => $permintaan,
                             "merek"              => $merek,
                             "ukuran"             => $ukuran,
                             "warna_plastik"      => $warnaPlastik,
                             "tebal"              => $tebal,
                             "berat"              => $berat,
                             "jumlah_permintaan"  => $jmlPermintaan,
                             "satuan"             => $satuan,
                             "strip"              => $strip,
                             "prioritas"          => $status,
                             "sisa"               => $jmlPermintaan,
                             "warna_cat"          => $warnaCat,
                             "keterangan"         => $keterangan,
                             "ket_merek"          => $ketMerek,
                             "ket_permintaan"     => $ketPermintaan,
                             "foto_belakang"      => $gambar2);
             }
           }else{
             $data = array("kd_ppic"            => $kdPpic,
                           "id_user"            => $idUser,
                           "nm_cust"            => $nmCust,
                           "tgl_rencana"        => $tglRencana,
                           "bagian"             => "CETAK",
                           "jns_permintaan"     => $permintaan,
                           "merek"              => $merek,
                           "ukuran"             => $ukuran,
                           "warna_plastik"      => $warnaPlastik,
                           "tebal"              => $tebal,
                           "berat"              => $berat,
                           "jumlah_permintaan"  => $jmlPermintaan,
                           "satuan"             => $satuan,
                           "strip"              => $strip,
                           "prioritas"          => $status,
                           "sisa"               => $jmlPermintaan,
                           "warna_cat"          => $warnaCat,
                           "keterangan"         => $keterangan,
                           "ket_merek"          => $ketMerek,
                           "ket_permintaan"     => $ketPermintaan,
                           "foto_depan"         => $gambar);
           }

         }else{
           if(empty($gambar)){
             if (empty($gambar2)) {
               $data = array("kd_ppic"            => $kdPpic,
                             "id_user"            => $idUser,
                             "kd_gd_roll"         => $kdGdRoll,
                             "nm_cust"            => $nmCust,
                             "tgl_rencana"        => $tglRencana,
                             "bagian"             => "CETAK",
                             "jns_permintaan"     => $permintaan,
                             "merek"              => $merek,
                             "ukuran"             => $ukuran,
                             "warna_plastik"      => $warnaPlastik,
                             "tebal"              => $tebal,
                             "berat"              => $berat,
                             "jumlah_permintaan"  => $jmlPermintaan,
                             "satuan"             => $satuan,
                             "strip"              => $strip,
                             "prioritas"          => $status,
                             "sisa"               => $jmlPermintaan,
                             "warna_cat"          => $warnaCat,
                             "keterangan"         => $keterangan,
                             "ket_merek"          => $ketMerek,
                             "ket_permintaan"     => $ketPermintaan);
             }else{
               $data = array("kd_ppic"            => $kdPpic,
                             "id_user"            => $idUser,
                             "kd_gd_roll"         => $kdGdRoll,
                             "nm_cust"            => $nmCust,
                             "tgl_rencana"        => $tglRencana,
                             "bagian"             => "CETAK",
                             "jns_permintaan"     => $permintaan,
                             "merek"              => $merek,
                             "ukuran"             => $ukuran,
                             "warna_plastik"      => $warnaPlastik,
                             "tebal"              => $tebal,
                             "berat"              => $berat,
                             "jumlah_permintaan"  => $jmlPermintaan,
                             "satuan"             => $satuan,
                             "strip"              => $strip,
                             "prioritas"          => $status,
                             "sisa"               => $jmlPermintaan,
                             "warna_cat"          => $warnaCat,
                             "keterangan"         => $keterangan,
                             "ket_merek"          => $ketMerek,
                             "ket_permintaan"     => $ketPermintaan,
                             "foto_belakang"      => $gambar2);
             }
           }else{
             $data = array("kd_ppic"            => $kdPpic,
                           "id_user"            => $idUser,
                           "kd_gd_roll"         => $kdGdRoll,
                           "nm_cust"            => $nmCust,
                           "tgl_rencana"        => $tglRencana,
                           "bagian"             => "CETAK",
                           "jns_permintaan"     => $permintaan,
                           "merek"              => $merek,
                           "ukuran"             => $ukuran,
                           "warna_plastik"      => $warnaPlastik,
                           "tebal"              => $tebal,
                           "berat"              => $berat,
                           "jumlah_permintaan"  => $jmlPermintaan,
                           "satuan"             => $satuan,
                           "strip"              => $strip,
                           "prioritas"          => $status,
                           "sisa"               => $jmlPermintaan,
                           "warna_cat"          => $warnaCat,
                           "keterangan"         => $keterangan,
                           "ket_merek"          => $ketMerek,
                           "ket_permintaan"     => $ketPermintaan,
                           "foto_depan"         => $gambar,
                           "foto_belakang"      => $gambar2);
           }
         }

        $result = $this->Ppic_Model->updateSpk($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editSpkSablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kd_ppic");#
      $nmCust = $this->input->post("nm_cust");#
      $tglRencana = $this->input->post("tgl_rencana");#
      $kdGdHasil = $this->input->post("kd_gd_hasil");#
      $merek = $this->input->post("merek");#
      $warnaPlastik = $this->input->post("warna_plastik");#
      $permintaan = $this->input->post("permintaan");#
      $ukuran = $this->input->post("ukuran");#
      $tebal = $this->input->post("tebal");#
      $berat = $this->input->post("berat");#
      $jmlPermintaan = $this->input->post("jml_permintaan");#
      $satuan = $this->input->post("satuan");#
      $warnaCetak = $this->input->post("warna_cetak");#
      $strip = $this->input->post("strip");#
      $status = $this->input->post("status");#
      $keterangan = $this->input->post("keterangan");
      $gambar = str_replace(" ","_",$this->input->post("gambar"));

      $idUser = $this->session->userdata("fabricationIdUser");
      if(empty($kdPpic)||empty($nmCust)||empty($merek)||empty($warnaPlastik)||empty($permintaan)||
         empty($ukuran)||$tebal==""||$berat==""||$jmlPermintaan==""||empty($tglRencana)||empty($warnaCetak)||
         empty($satuan)||empty($strip)||empty($status)||empty($permintaan)
       ){
         echo "<script>alert('Kolom Kuning Tidak Boleh Kosong!');</script>";
       }else{
         if(empty($kdGdHasil)){
           if(empty($gambar)){
             $data = array("kd_ppic"=>$kdPpic,"id_user"=>$idUser,
                           "nm_cust"=>$nmCust,"tgl_rencana"=>$tglRencana,"bagian"=>"SABLON",
                           "jns_permintaan"=>$permintaan,"merek"=>$merek,"ukuran"=>$ukuran,
                           "warna_plastik"=>$warnaPlastik,"tebal"=>$tebal,"berat"=>$berat,
                           "jumlah_permintaan"=>$jmlPermintaan,"satuan"=>$satuan,
                           "strip"=>$strip,"prioritas"=>$status,"sisa"=>$jmlPermintaan,
                           "keterangan"=>$keterangan,"warna_cetak"=>$warnaCetak);
           }else{
             $data = array("kd_ppic"=>$kdPpic,"id_user"=>$idUser,
                           "nm_cust"=>$nmCust,"tgl_rencana"=>$tglRencana,"bagian"=>"SABLON",
                           "jns_permintaan"=>$permintaan,"merek"=>$merek,"ukuran"=>$ukuran,
                           "warna_plastik"=>$warnaPlastik,"tebal"=>$tebal,"berat"=>$berat,
                           "jumlah_permintaan"=>$jmlPermintaan,"satuan"=>$satuan,
                           "strip"=>$strip,"prioritas"=>$status,"sisa"=>$jmlPermintaan,
                           "keterangan"=>$keterangan,"warna_cetak"=>$warnaCetak,"foto_depan"=>$gambar);
           }

         }else{
           if (empty($gambar)) {
             $data = array("kd_ppic"=>$kdPpic,"kd_gd_hasil"=>$kdGdHasil,"id_user"=>$idUser,
                           "nm_cust"=>$nmCust,"tgl_rencana"=>$tglRencana,"bagian"=>"SABLON",
                           "jns_permintaan"=>$permintaan,"merek"=>$merek,"ukuran"=>$ukuran,
                           "warna_plastik"=>$warnaPlastik,"tebal"=>$tebal,"berat"=>$berat,
                           "jumlah_permintaan"=>$jmlPermintaan,"satuan"=>$satuan,
                           "strip"=>$strip,"prioritas"=>$status,"sisa"=>$jmlPermintaan,
                           "keterangan"=>$keterangan,"warna_cetak"=>$warnaCetak);
           }else{
             $data = array("kd_ppic"=>$kdPpic,"kd_gd_hasil"=>$kdGdHasil,"id_user"=>$idUser,
                           "nm_cust"=>$nmCust,"tgl_rencana"=>$tglRencana,"bagian"=>"SABLON",
                           "jns_permintaan"=>$permintaan,"merek"=>$merek,"ukuran"=>$ukuran,
                           "warna_plastik"=>$warnaPlastik,"tebal"=>$tebal,"berat"=>$berat,
                           "jumlah_permintaan"=>$jmlPermintaan,"satuan"=>$satuan,
                           "strip"=>$strip,"prioritas"=>$status,"sisa"=>$jmlPermintaan,
                           "keterangan"=>$keterangan,"warna_cetak"=>$warnaCetak,"foto_depan"=>$gambar);
           }

         }

        $result = $this->Ppic_Model->updateSpk($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editStatusPengerjaan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_ppic = $this->input->post("kd_ppic");
      $sts_pengerjaan = $this->input->post("sts_pengerjaan");
      $ket_stop = $this->input->post("ket_stop");
      $data = array("kd_ppic"=>$kd_ppic,
                    "sts_pengerjaan"=>$sts_pengerjaan,
                    "ket_stop"=>$ket_stop);
      $result = $this->Ppic_Model->updateSpk($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListSpk(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $periode = $this->input->post("periode");
      $bagian = $this->input->post("bagian");
      if(empty($periode)){
        echo $this->Ppic_Model->selectListSpk($bagian);
      }else{
        $data = explode("#",$periode);
        $param = array("tgl_awal"=>$data[0],"tgl_akhir"=>$data[1],"bagian"=>$bagian);
        echo $this->Ppic_Model->selectListSpkPeriode($param);
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailSpk(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPpic = $this->input->post("kd_ppic");
      $result = $this->Ppic_Model->selectDetailSpk($kdPpic);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function removeSpk(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_ppic = $this->input->post("kd_ppic");
      $data = array("kd_ppic" => $kd_ppic,
                    "deleted" => "TRUE");
      $result = $this->Ppic_Model->updateSpk($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function restoreSpk(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_ppic = $this->input->post("kd_ppic");
      $data = array("kd_ppic" => $kd_ppic,
                    "deleted" => "FALSE");
      $result = $this->Ppic_Model->updateSpk($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountRencanaTrash(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Ppic_Model->selectCountRencanaTrash();
      echo $result[0]["total"];
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListTrashSpk(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Ppic_Model->selectListTrashSpk();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistorySpk(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $bulan = $this->input->post("bulan");
      $tahun = $this->input->post("tahun");
      $bagian = $this->input->post("bagian");
      if(empty($bulan) && empty($tahun)){
        echo $this->Ppic_Model->selectListHistorySpk($bagian);
      }else{
        $param = array("bulan"=>$bulan,"tahun"=>$tahun,"bagian"=>$bagian);
        echo $this->Ppic_Model->selectListHistorySpkPeriode($param);
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListRencanaPerBagian(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $bagian = $this->input->post("bagian");
      $data = array("tanggal"=>$this->input->post("tanggal"));
      switch ($bagian) {
        case 'EXTRUDER': $result = $this->Ppic_Model->selectListRencanaExtruder($data);break;
        case 'CUTTING': $result = $this->Ppic_Model->selectListRencanaCutting($data);break;
        case 'PRINTING': $result = $this->Ppic_Model->selectListRencanaPrinting($data);break;
        case 'SABLON': $result = $this->Ppic_Model->selectListRencanaSablon($data);break;

        default:$result = "";break;
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function uploadFoto(){
    $isLogin = $this->isLogin();
    if($isLogin){
      if(isset($_FILES["gambar"])){
        $namaGambar = str_replace(" ","_",$_FILES["gambar"]["name"]);
        if(!empty($namaGambar)){
          $config_image['upload_path'] = './assets/images/upload/';
          $config_image['allowed_types'] = 'jpg|jpeg|png';
          $config_image['max_size'] = 1024;
          $config_image['overwrite'] = TRUE;
          $config_image['file_name'] = $namaGambar;
          $this->load->library('upload',$config_image);
          $this->upload->initialize($config_image);
          if($this->upload->do_upload("gambar")){
            echo "Berhasil";
          }else{
            echo "Gagal";;
          }
        }
      }else{
        echo "Gambar Kosong";
      }

      if(isset($_FILES["gambar2"])){
        $namaGambar2 = str_replace(" ","_",$_FILES["gambar2"]["name"]);
        if(!empty($namaGambar2)){
          $config_image['upload_path'] = './assets/images/upload/';
          $config_image['allowed_types'] = 'jpg|jpeg|png';
          $config_image['max_size'] = 1024;
          $config_image['overwrite'] = TRUE;
          $config_image['file_name'] = $namaGambar2;
          $this->load->library('upload',$config_image);
          $this->upload->initialize($config_image);
          if($this->upload->do_upload("gambar2")){
            echo "Berhasil";
          }else{
            echo "Gagal";;
          }
        }
      }else{
        echo "Gambar Kosong";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  // private function cetakFakturHeader($param){
  //   $this->fpdf->SetFont('Arial','B',15);
  //   $this->fpdf->Ln(-3);
  //   $this->fpdf->Image(base_url()."assets/images/logo_plastik_black.png",5,5,13);
  //   $this->fpdf->Cell(8);
	//   $this->fpdf->Cell(37,5,'KLIP PLASTIK',0,0,'L');
  //   $this->fpdf->SetFont('Arial','',10);
  //   $this->fpdf->Ln(-3);
  //   $this->fpdf->Cell(44);
  //   $this->fpdf->Cell(5,5,iconv("UTF-8", "ISO-8859-1", "®"),0,1,'C',0);
  //   $this->fpdf->Ln(-1);
  //   $this->fpdf->Cell(8);
  //   $this->fpdf->Ln(3);
  //   $this->fpdf->Cell(8);
  //   $this->fpdf->SetFont('Arial','B',6);
  //   $this->fpdf->Cell(70,4,'Jl. Yos Sudarso No.115 A, Batu Ceper - Tangerang',0,0,'L');
  //   $this->fpdf->Ln(3);
  //   $this->fpdf->Cell(8);
  //   $this->fpdf->Cell(70,4,'Telp.:5518899 (Hunting), 5404656, 5404657 Fax:5513905',0,0,'L');
  //   $this->fpdf->Ln(3);
  //   $this->fpdf->Cell(8);
  //   $this->fpdf->Cell(70,4,'Homepage : http://www.klipplastik.co.id',0,0,'L');
  //   $this->fpdf->Ln(3);
  //   $this->fpdf->Cell(8);
  //   $this->fpdf->Cell(70,4,'E-mail : sales@klipplastik.co.id',0,0,'L');
  //   $this->fpdf->Ln(-17);
  //   $this->fpdf->Cell(75);
  //   $this->fpdf->SetFont('Times','B',12);
  //   $this->fpdf->Cell(50,6,'SURAT - PESANAN',1,0,'C');
  //   $this->fpdf->Ln(-1);
  //   $this->fpdf->Cell(135);
  //   $this->fpdf->Cell(35,6,'KETERANGAN : ',1,0,'C');
  //   $this->fpdf->Ln();
  //   $this->fpdf->Cell(135);
  //   $this->fpdf->SetFont('Arial','',8);
  //   $this->fpdf->Cell(55,4,'Setiap order selalu ada toleransi ukuran',0,0,'L');
  //   $this->fpdf->Ln();
  //   $this->fpdf->Cell(135);
  //   $this->fpdf->Cell(55,4,'dan jumlah pesanan',0,0,'L');
  //   $this->fpdf->Ln();
  //   $this->fpdf->Cell(135);
  //   $this->fpdf->Cell(35,4,'PERLU/TIDAK ( PROOF ) : ',0 ,0,'L');
  //   $this->fpdf->Cell(25,4,$param[0]['proof'],'B' ,0,'L');
  //   $this->fpdf->Ln(-5);
  //   $this->fpdf->Cell(75);
  //   $this->fpdf->SetFont('Arial','',11);
  //   $this->fpdf->Cell(50,6,$param[0]['no_order']."  ".$param[0]['pajak']."  ".$param[0]['jns_order'],0,0,'C');
  //   $this->fpdf->SetLineWidth(0.4);
  //   $this->fpdf->Line(206,24,5,24);
  // }
  //
  // private function cetakFakturSidebar($param){
  //   $this->fpdf->SetFont('Times','',9);
  //   $this->fpdf->SetY(25);
  //   $this->fpdf->SetX(165);
  //   $this->fpdf->Cell(16,5,"Ekspedisi : ",0,0,"L");
  //   $this->fpdf->Ln();
  //   $this->fpdf->SetX(165);
  //   $this->fpdf->MultiCell(38,3,$param[0]['expedisi'],0,"L");
  //   if(empty($param[0]['foto_1'])){
  //     $foto = "sample.png";
  //   }else{
  //     $foto = "upload/".$param[0]['foto_1'];
  //   }
  //   $this->fpdf->Image(base_url()."assets/images/".$foto,180,55,25,"","",base_url()."assets/images/".$foto);
  //   $this->fpdf->RoundedRect(163, 25, 42, 115, 5, '1234', 'D');
  // }
  //
  // private function cetakFakturTableHeaderProduksi($param){
  //   $this->fpdf->Ln(14);
  //   $this->fpdf->SetX(5);
  //   $this->fpdf->SetLineWidth(0.1);
  //   #$this->fpdf->Cell(201,20,'',"TLR",0,'L');
  //   $this->fpdf->SetFont('Times','B',9);
  //   $this->fpdf->SetY(26);
  //   $this->fpdf->SetX(5);
  //   $this->fpdf->Cell(28,5,'TANGGAL',0,0,'L');
  //   $this->fpdf->Cell(3,5,':',0,0,'L');
  //   $this->fpdf->SetFont('Times','',10);
  //   $this->fpdf->Cell(28,5,$param[0]['tgl_pesan'],"B",0,'L');
  //   $this->fpdf->SetY(26);
  //   $this->fpdf->SetX(105);
  //   $this->fpdf->SetFont('Times','B',10);
  //   $this->fpdf->Cell(15,5,'No. PO.',0,0,'L');
  //   $this->fpdf->Cell(2,5,':',0,0,'L');
  //   $this->fpdf->SetFont('Times','',10);
  //   $this->fpdf->Cell(38,5,$param[0]['no_po'],'B',0,'L');
  //   $this->fpdf->Ln();
  //   $this->fpdf->SetY(31);
  //   $this->fpdf->SetX(5);
  //   $this->fpdf->SetFont('Times','B',9);
  //   $this->fpdf->Cell(28,5,'NAMA PEMESAN',0,0,'L');
  //   $this->fpdf->Cell(2,5,':',0,0,'L');
  //   $this->fpdf->SetFont('Times','',10);
  //   $this->fpdf->Cell(28,5,$param[0]['nm_perusahaan'],'B',0,'L');
  //   $this->fpdf->SetY(31);
  //   $this->fpdf->SetX(105);
  //   $this->fpdf->Cell(15,5,'No. Telp.',0,0,'L');
  //   $this->fpdf->Cell(2,5,':',0,0,'L');
  //   $this->fpdf->SetFont('Times','',10);
  //   $this->fpdf->Cell(28,5,$param[0]['tlp_kantor'],'B',0,'L');
  //   $this->fpdf->Line(35,36,100,36);
  //   $this->fpdf->Ln();
  //   $this->fpdf->SetY(36);
  //   $this->fpdf->SetX(5);
  //   $this->fpdf->SetFont('Times','B',9);
  //   $this->fpdf->Cell(28,5,'ALAMAT',0,0,'L');
  //   $this->fpdf->Cell(2,5,':',0,0,'L');
  //   $this->fpdf->SetFont('Times','',10);
  //   $this->fpdf->MultiCell(115,5,str_replace("<p>","",str_replace("</p>","",$param[0]['alamat'])),"B","L");
  // }
  //
  // private function cetakFakturDataProduksi($param){
  //   $this->fpdf->SetX(5);
  //   $this->fpdf->SetY(45);
  //   $this->fpdf->SetX(5);
  //   $this->fpdf->SetFont('Times','',8);
  //   $this->fpdf->Cell(19,8,'BANYAKNYA','TBL',0,'C');
  //   $this->fpdf->Cell(20,5,'UKURAN (cm)','TLB',0,'C');
  //   $this->fpdf->Cell(41,8,'MERK','TLB',0,'C');
  //   $this->fpdf->Cell(25,8,'NAMA PRODUK','TLB',0,'C');
  //   $this->fpdf->Cell(25,5,'WARNA','TLB',0,'C');
  //   $this->fpdf->Cell(25,5,'ATAS KLIP','TLRB',0,'C');
  //   $this->fpdf->Ln();
  //   $this->fpdf->SetX(24);
  //   $this->fpdf->Cell(10,3,'P','BL',0,'C');
  //   $this->fpdf->Cell(10,3,'L','BL',0,'C');
  //   $this->fpdf->SetX(110);
  //   $this->fpdf->Cell(12.5,3,'PLASTIK','BL',0,'C');
  //   $this->fpdf->Cell(12.5,3,'CETAK','BL',0,'C');
  //   $this->fpdf->Cell(10,3,'SM','BL',0,'C');
  //   $this->fpdf->Cell(15,3,'DLL','BLR',0,'C');
  //   $this->fpdf->Ln();
  //   $this->fpdf->SetWidths(array(19,10,10,41,25,12.5,12.5,10,15));
  //   $this->fpdf->SetAligns(array('L','C','C','L','L','L','L','C','C','C'));
  //   for($i=0;$i<count($param);$i++){
  //     $this->fpdf->setX(5);
  //     $this->fpdf->Row(array_values($param[$i]));
  //   }
  // }
  //
  // private function cetakFakturFooterProduksi($param){
  //   $this->fpdf->SetFont('Times','',9);
  //   $this->fpdf->SetY(105);
  //   #$this->fpdf->Cell(19,5,'Uang Muka : ',0,0,'L');
  //   #$this->fpdf->Cell(35,5,$param[0]['mata_uang']." ".$param[0]['dp'],'B',0,'L');
  //   $this->fpdf->Ln();
  //   $this->fpdf->SetX(10);
  //   $this->fpdf->Cell(66,5,'( Uang muka tidak dapat dikembalikan apabila',0,0,'L');
  //   $this->fpdf->Ln();
  //   $this->fpdf->SetX(10);
  //   $this->fpdf->Cell(66,5,'Order dibatalkan oleh Pemesan )',0,0,'L');
  //   $this->fpdf->SetY(105);
  //   $this->fpdf->SetX(85);
  //   $this->fpdf->Cell(27,5,'Tgl. Penyerahan     : ',0,0,'L');
  //   $this->fpdf->Cell(46,5,$param[0]['tgl_estimasi'],'B',0,'L');
  //   $this->fpdf->Ln(8);
  //   $this->fpdf->SetX(85);
  //   $this->fpdf->Cell(27,5,'Syarat Pembayaran : ',0,0,'L');
  //   $this->fpdf->Cell(46,5,$param[0]['payment_method'],'B',0,'L');
  //   $this->fpdf->SetLineWidth(0.2);
  //   $this->fpdf->RoundedRect(5, 120, 153, 20, 5, '1234', 'D');
  //   $this->fpdf->SetY(-15);
  //   $this->fpdf->SetX(7);
  //   $this->fpdf->Line(7,133,77,133);
  //   $this->fpdf->Cell(70,4,$param[0]['nm_pemesan'],0,0,'C');
  //   $this->fpdf->Cell(5);
  //   $this->fpdf->Line(82,133,152,133);
  //   $this->fpdf->Cell(70,4,'Salesman ( '.$param[0]["username"]." )",0,0,'C');
  //   $this->fpdf->SetY(-7);
  //   $this->fpdf->SetX(7);
  //   $this->fpdf->Cell(100,4,'Uang muka harap ditulis jika ditanggung sepenuhnya oleh pemesan',0,0,'L');
  //   $this->fpdf->SetY(85);
  //   $this->fpdf->SetX(162);
  //   $this->fpdf->Cell(10,5,"Note : ",0,0,"L");
  //   $this->fpdf->Ln();
  //   $this->fpdf->SetX(162);
  //   $this->fpdf->WriteHTML($param[0]['note']);
  // }

  public function cetakFakturProduksi($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrDataPesanan = $this->Ppic_Model->selectFakturPesanan($param);
      $arrDataPesananDetail = $this->Ppic_Model->selectFakturPesananDetailProduksi($param);
      $result = array("arrDataPesanan" => $arrDataPesanan,
                      "arrDataPesananDetail" => $arrDataPesananDetail);
      // $css = "assets/bootstrap/css/bootstrap.min.css";
      // $page = $this->load->view("frm_print_faktur_produksi",$result,true);
      $this->load->view("frm_print_faktur_produksi",$result);
      // $this->load->library('m_pdf');
      // $this->mpdf->mPDF("utf-8","A5-L",0,"",2,2,5,5,0,0);
      // $this->mpdf->SetDisplayPreferences("/FullScreen/FitWindow");
      // $this->mpdf->showImageErrors = true;
      // $this->mpdf->WriteHTML(file_get_contents($css),1);
      // $this->mpdf->WriteHTML($page);
      // $this->mpdf->use_kwt = true;
      // $this->mpdf->shrink_tables_to_fit = 1;
      // $this->mpdf->setFooter("Page ".'{PAGENO}');
      // $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cetakFakturProduksiMarketing($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrDataPesanan = $this->Ppic_Model->selectFakturPesanan($param);
      $arrDataPesananDetail = $this->Ppic_Model->selectFakturPesananDetailProduksi($param);
      $result = array("arrDataPesanan" => $arrDataPesanan,
                      "arrDataPesananDetail" => $arrDataPesananDetail);
      $css = "assets/bootstrap/css/bootstrap.min.css";
      $page = $this->load->view("frm_print_faktur_produksi_marketing",$result,true);
      // $this->load->view("frm_print_faktur_produksi",$result);
      $this->load->library('m_pdf');
      $this->mpdf->mPDF("utf-8","A5-L",0,"",2,2,5,5,0,0);
      $this->mpdf->SetDisplayPreferences("/FullScreen/FitWindow");
      $this->mpdf->showImageErrors = true;
      $this->mpdf->WriteHTML(file_get_contents($css),1);
      $this->mpdf->WriteHTML($page);
      $this->mpdf->use_kwt = true;
      $this->mpdf->shrink_tables_to_fit = 1;
      $this->mpdf->setFooter("Page ".'{PAGENO}');
      $this->mpdf->Output();
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

      $result = $this->Ppic_Model->selectDataHasilExtruder($data);
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
      $result["Data"] = json_decode($this->Ppic_Model->selectDataHasilExtruder($data), TRUE);
      $result["Tanggal"] = date("d F Y",strtotime($tglRencana));
      $page = $this->load->view("frm_print_hasil_extruder",$result,true);
      $css = "assets/bootstrap/css/bootstrap.min.css";
      $this->load->library('m_pdf');
      $this->mpdf->mPDF("utf-8","A4-P",0,"",5,5,8,8,5,3);
      $this->mpdf->setFooter("Page ".'{PAGENO}');
      $this->mpdf->WriteHTML(file_get_contents($css),1);
      $this->mpdf->WriteHTML($page);
      $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getLaporanHasilExtruderGlobal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $jnsBrg = $this->input->post("jnsBrg");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "jnsBrg" => $jnsBrg);
      $result = $this->Ppic_Model->selectLaporanHasilExtruderGlobal($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryRencanaPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPotong = $this->input->post("kdPotong");
      $result = $this->Ppic_Model->selectListHistoryRencanaPotong($kdPotong);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function cariHasilGlobalPotong()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal  = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $result = $this->Ppic_Model->getHasilGlobalPotong($tglAwal,$tglAkhir);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function cariHasilGlobalPotongDanApal()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal  = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $result = $this->Ppic_Model->getHasilGlobalPotongDanApal($tglAwal,$tglAkhir);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function cariHasilGlobalSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal  = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $result = $this->Ppic_Model->getHasilGlobalSablon($tglAwal,$tglAkhir);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function cariApalGlobalPotong()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal  = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $result = $this->Ppic_Model->getApalGlobalPotong($tglAwal,$tglAkhir);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function cariHasilGlobalCetak()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal  = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $result = $this->Ppic_Model->getHasilGlobalCetak($tglAwal,$tglAkhir);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cetakFakturPesananProduksi($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrDataPesanan = $this->Ppic_Model->selectFakturPesananMarketing($param);
      $arrDataPesananDetail = $this->Ppic_Model->selectFakturPesananDetailProduksiMarketing($param);
      $result = array("arrDataPesanan" => $arrDataPesanan,
                      "arrDataPesananDetail" => $arrDataPesananDetail);
      $css = "assets/bootstrap/css/bootstrap.min.css";
      $page = $this->load->view("frm_print_faktur_produksi_m",$result,true);
      $this->load->library('m_pdf');
      $this->mpdf->mPDF("utf-8","A5-L",0,"",2,2,5,5,0,0);
      $this->mpdf->SetDisplayPreferences("/FullScreen/FitWindow");
      $this->mpdf->showImageErrors = true;
      $this->mpdf->WriteHTML(file_get_contents($css),1);
      $this->mpdf->WriteHTML($page);
      $this->mpdf->use_kwt = true;
      $this->mpdf->shrink_tables_to_fit = 1;
      $this->mpdf->setFooter("Page ".'{PAGENO}');
      $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListDetailPesananTerkirim(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDp = $this->input->post("idDp");
      $result = $this->Ppic_Model->selectListDetailPengiriman($idDp);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getHasilJobPotong(){
    $shift = $this->input->post("shift");
    $tglAwal = $this->input->post("tglAwal");
    $tglAkhir = $this->input->post("tglAkhir");
    $data = array("shift" => $shift,
                  "tglAwal" => $tglAwal,
                  "tglAkhir" => $tglAkhir);
    $result = $this->Ppic_Model->selectHasilJobPotong($data);
    echo $result;
  }
}
?>
