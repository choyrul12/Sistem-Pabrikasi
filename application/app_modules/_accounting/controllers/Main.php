<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
		parent::__construct();
		$this->load->model("Accounting_Model");
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
       ($this->session->userdata("fabricationGroup")=="accounting"||
        $this->session->userdata("fabricationGroup")=="it_department"||
        $this->session->userdata("fabricationGroup")=="SYSTEM")
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
          array("Content"=>"Gudang Roll Polos","Link"=>"#","Name"=>"M_Gudang_Roll_Polos","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Gudang_Roll_Polos"),
          array("Content"=>"Gudang Roll Cetak","Link"=>"#","Name"=>"M_Gudang_Roll_Cetak","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Gudang_Roll_Cetak"),
          array("Content"=>"Gudang Hasil","Link"=>"#","Name"=>"M_Gudang_Hasil","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Gudang_Hasil"),
          array("Content"=>"Gudang Bahan","Link"=>"#","Name"=>"M_Gudang_Bahan","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Gudang_Bahan"),
          array("Content"=>"Potong","Link"=>"#","Name"=>"M_Potong","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Potong"),
          array("Content"=>"Cetak","Link"=>"#","Name"=>"M_Cetak","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Cetak"),
          array("Content"=>"Sablon","Link"=>"#","Name"=>"M_Sablon","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Sablon"),
          array("Content"=>"Kuantitas Gudang Hasil","Link"=>"#","Name"=>"kuantitas_gudang_hasil","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"kuantitas_gudang_hasil"),
          array("Content"=>"Kuantitas Gudang Roll","Link"=>"#","Name"=>"kuantitas_gudang_roll","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"kuantitas_gudang_roll"),
          array("Content"=>"Kuantitas Gudang Bahan","Link"=>"#","Name"=>"kuantitas_gudang_bahan","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"kuantitas_gudang_bahan"),
          array("Content"=>"Pantau Order","Link"=>"_accounting/main/pantau_order","Name"=>"pantau_order","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"pantau_order"),
        );

        $listMenu["childMenu"] = array(
          array("Content"=>"Extruder => Roll Polos","Link"=>"_accounting/main/extruder_roll_polos","Status"=>"Child","Parent"=>"M_Gudang_Roll_Polos","Name"=>"MI_Extruder_Roll_Polos","Id"=>"MI_Extruder_Roll_Polos"),
          array("Content"=>"Roll Polos => Potong","Link"=>"_accounting/main/roll_polos_potong","Status"=>"Child","Parent"=>"M_Gudang_Roll_Polos","Name"=>"MI_Roll_Polos_Potong","Id"=>"MI_Roll_Polos_Potong"),
          array("Content"=>"Potong => Roll Polos","Link"=>"_accounting/main/potong_roll_polos","Status"=>"Child","Parent"=>"M_Gudang_Roll_Polos","Name"=>"MI_Potong_Roll_Polos","Id"=>"MI_Potong_Roll_Polos"),
          array("Content"=>"Roll Polos => Cetak","Link"=>"_accounting/main/roll_polos_cetak","Status"=>"Child","Parent"=>"M_Gudang_Roll_Polos","Name"=>"MI_Roll_Polos_Cetak","Id"=>"MI_Roll_Polos_Cetak"),

          array("Content"=>"Roll Polos => Roll Cetak","Link"=>"_accounting/main/roll_polos_roll_cetak","Status"=>"Child","Parent"=>"M_Gudang_Roll_Cetak","Name"=>"MI_Extruder_Roll_Polos","Id"=>"MI_Extruder_Roll_Polos"),
          array("Content"=>"Roll Cetak => Potong","Link"=>"_accounting/main/roll_cetak_potong","Status"=>"Child","Parent"=>"M_Gudang_Roll_Cetak","Name"=>"MI_Roll_Polos_Potong","Id"=>"MI_Roll_Polos_Potong"),
          array("Content"=>"Potong => Roll Cetak","Link"=>"_accounting/main/potong_roll_cetak","Status"=>"Child","Parent"=>"M_Gudang_Roll_Cetak","Name"=>"MI_Potong_Roll_Polos","Id"=>"MI_Potong_Roll_Polos"),

          array("Content"=>"Barang Campur","Link"=>"_accounting/main/barang_campur","Status"=>"Child","Parent"=>"M_Gudang_Hasil","Name"=>"MI_Barang_Campur","Id"=>"MI_Barang_Campur"),
          array("Content"=>"Barang Standard","Link"=>"_accounting/main/barang_standard","Status"=>"Child","Parent"=>"M_Gudang_Hasil","Name"=>"MI_Barang_Standard","Id"=>"MI_Barang_Standard"),
          array("Content"=>"Barang Kantong","Link"=>"_accounting/main/barang_kantong","Status"=>"Child","Parent"=>"M_Gudang_Hasil","Name"=>"MI_Barang_Kantong","Id"=>"MI_Barang_Kantong"),
          array("Content"=>"Barang Campur(Khusus Sablon)","Link"=>"_accounting/main/barang_campur_khusus_sablon","Status"=>"Child","Parent"=>"M_Gudang_Hasil","Name"=>"MI_Barang_Campur_Khusus_Sablon","Id"=>"MI_Barang_Campur_Khusus_Sablon"),
          array("Content"=>"Barang Standard Keluar","Link"=>"_accounting/main/barang_standard_keluar","Status"=>"Child","Parent"=>"M_Gudang_Hasil","Name"=>"MI_Barang_Standard_Keluar","Id"=>"MI_Barang_Standard_Keluar"),

          array("Content"=>"Bahan Baku","Link"=>"_accounting/main/bahan_baku","Status"=>"Child","Parent"=>"M_Gudang_Bahan","Name"=>"MI_Bahan_Baku","Id"=>"MI_Bahan_Baku"),
          array("Content"=>"Biji Warna","Link"=>"_accounting/main/biji_warna","Status"=>"Child","Parent"=>"M_Gudang_Bahan","Name"=>"MI_Biji_Warna","Id"=>"MI_Biji_Warna"),
          array("Content"=>"Minyak","Link"=>"_accounting/main/minyak","Status"=>"Child","Parent"=>"M_Gudang_Bahan","Name"=>"MI_Minyak","Id"=>"MI_Minyak"),
          array("Content"=>"Cat Campur","Link"=>"_accounting/main/cat_campur","Status"=>"Child","Parent"=>"M_Gudang_Bahan","Name"=>"MI_Cat_Campur","Id"=>"MI_Cat_Campur"),
          array("Content"=>"Cat Murni","Link"=>"_accounting/main/cat_murni","Status"=>"Child","Parent"=>"M_Gudang_Bahan","Name"=>"MI_Cat_Murni","Id"=>"MI_Cat_Murni"),
          array("Content"=>"Spare Part","Link"=>"_accounting/main/spare_part","Status"=>"Child","Parent"=>"M_Gudang_Bahan","Name"=>"MI_Spare_Part","Id"=>"MI_Spare_Part"),

          array("Content"=>"Job Potong","Link"=>"_accounting/main/job_potong","Status"=>"Child","Parent"=>"M_Potong","Name"=>"MI_Job_Potong","Id"=>"MI_Job_Potong"),

          array("Content"=>"Job Cetak","Link"=>"_accounting/main/job_cetak","Status"=>"Child","Parent"=>"M_Cetak","Name"=>"MI_Job_Cetak","Id"=>"MI_Job_Cetak"),

          array("Content"=>"Job Sablon","Link"=>"_accounting/main/job_sablon","Status"=>"Child","Parent"=>"M_Sablon","Name"=>"MI_Job_Sablon","Id"=>"MI_Job_Sablon"),

          array("Content"=>"Kuantitas Barang Standard","Link"=>"_accounting/main/kuantitas_gudang_hasil/Standard","Status"=>"Child","Parent"=>"kuantitas_gudang_hasil","Name"=>"Kuantitas_Barang_Standar","Id"=>"Kuantitas_Barang_Standar"),
          array("Content"=>"Kuantitas Barang Campur","Link"=>"_accounting/main/kuantitas_gudang_hasil/Campur","Status"=>"Child","Parent"=>"kuantitas_gudang_hasil","Name"=>"Kuantitas_Barang_Campur","Id"=>"Kuantitas_Barang_Campur"),
          array("Content"=>"Kuantitas Barang Sablon","Link"=>"_accounting/main/kuantitas_gudang_hasil/Sablon","Status"=>"Child","Parent"=>"kuantitas_gudang_hasil","Name"=>"Kuantitas_Barang_Sablon","Id"=>"Kuantitas_Barang_Sablon"),
           array("Content"=>"Kuantitas Barang Kantong","Link"=>"_accounting/main/kuantitas_gudang_hasil/Kantong","Status"=>"Child","Parent"=>"kuantitas_gudang_hasil","Name"=>"Kuantitas_Barang_Kantong","Id"=>"Kuantitas_Barang_Kantong"),

           array("Content"=>"Kuantitas Roll Polos","Link"=>"_accounting/main/kuantitas_gudang_roll/Polos","Status"=>"Child","Parent"=>"kuantitas_gudang_roll","Name"=>"kuantitas_roll_polos","Id"=>"kuantitas_roll_polos"),
           array("Content"=>"Kuantitas Roll Cetak","Link"=>"_accounting/main/kuantitas_gudang_roll/Cetak","Status"=>"Child","Parent"=>"kuantitas_gudang_roll","Name"=>"kuantitas_roll_cetak","Id"=>"kuantitas_roll_cetak"),

           array("Content"=>"Kuantitas Bahan Baku","Link"=>"_accounting/main/kuantitas_gudang_bahan/Bahan_Baku","Status"=>"Child","Parent"=>"kuantitas_gudang_bahan","Name"=>"kuantitas_bahan_baku","Id"=>"kuantitas_bahan_baku"),
           array("Content"=>"Kuantitas Biji Warna","Link"=>"_accounting/main/kuantitas_gudang_bahan/Biji_Warna","Status"=>"Child","Parent"=>"kuantitas_gudang_bahan","Name"=>"kuantitas_biji_warna","Id"=>"kuantitas_biji_warna"),
           array("Content"=>"Kuantitas Minyak","Link"=>"_accounting/main/kuantitas_gudang_bahan/Minyak","Status"=>"Child","Parent"=>"kuantitas_gudang_bahan","Name"=>"kuantitas_minyak","Id"=>"kuantitas_minyak"),
           array("Content"=>"Kuantitas Cat Murni","Link"=>"_accounting/main/kuantitas_gudang_bahan/Cat_Murni","Status"=>"Child","Parent"=>"kuantitas_gudang_bahan","Name"=>"kuantitas_cat_murni","Id"=>"kuantitas_cat_murni"),
           array("Content"=>"Kuantitas Cat Campur","Link"=>"_accounting/main/kuantitas_gudang_bahan/Cat_Campur","Status"=>"Child","Parent"=>"kuantitas_gudang_bahan","Name"=>"kuantitas_cat_campur","Id"=>"kuantitas_cat_campur"),
           array("Content"=>"Kuantitas Spare Part","Link"=>"_accounting/main/kuantitas_spare_part/Spare_Part","Status"=>"Child","Parent"=>"kuantitas_gudang_bahan","Name"=>"kuantitas_spare_part","Id"=>"kuantitas_spare_part"),
           array("Content"=>"Kuantitas Apal","Link"=>"_accounting/main/kuantitas_apal/Apal","Status"=>"Child","Parent"=>"kuantitas_gudang_bahan","Name"=>"kuantitas_apal","Id"=>"kuantitas_apal"),
        );
        return $listMenu;
      }else if($status==2) {
        // $listMenu["parentMenu"] = array(
        //   array("Content"=>"Orderan","Link"=>"_cabang/main/order_baru","Name"=>"Data_Customer","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
        //   array("Content"=>"Pantau Order","Link"=>"_cabang/main/pantau_order","Name"=>"Order","Status"=>"Single","Icon"=>"fa fa-desktop","Id"=>""),
        //   array("Content"=>"History Order","Link"=>"_cabang/main/history_order","Name"=>"History","Parent"=>"History","Status"=>"Single","Icon"=>"fa fa-history","Id"=>""),
        // );
        // return $listMenu;
      }else{

      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function extruder_roll_polos(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Extruder Ke Roll Polos");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_extruder_roll_polos",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function roll_polos_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Roll Polos Ke Potong");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_roll_polos_potong",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function potong_roll_polos(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Potong Ke Roll Polos");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_potong_roll_polos",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function roll_polos_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Roll Polos Ke Cetak");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_roll_polos_cetak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function roll_polos_roll_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Hasil Cetak");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_roll_polos_roll_cetak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function roll_cetak_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Roll Cetak Ke Potong");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_roll_cetak_potong",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function potong_roll_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Potong Ke Roll Cetak");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_potong_roll_cetak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function barang_campur(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cari History Barang Campur");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_barang_campur",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function barang_standard(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cari History Barang Standard");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_barang_standard",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function barang_kantong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cari History Barang Kantong");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_barang_kantong",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function barang_campur_khusus_sablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cari History Barang Sablon");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_barang_campur_khusus_sablon",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function barang_standard_keluar(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cari History Barang Standard Keluar");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_barang_standard_keluar",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function job_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Laporan Job Potong");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_job_potong",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function job_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Laporan Job Cetak");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_job_cetak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function job_sablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Laporan Job Sablon");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_job_sablon",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bahan_baku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cari History Bahan Baku");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_gudang_bahan",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function biji_warna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cari History Biji Warna");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_gudang_bahan",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function minyak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cari History Minyak");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_gudang_bahan",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cat_campur(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cari History Cat Campur");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_gudang_bahan",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cat_murni(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cari History Cat Murni");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_gudang_bahan",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function spare_part(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cari History Spare Part");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_gudang_spare_part",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getHasilExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $key = $this->input->post("key");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "key" => $key);
      $result = $this->Accounting_Model->selectHasilExtruder($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportHasilExtruderKeExcel($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2);
      $result["NamaFile"] = "Laporan Hasil Extruder ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectHasilExtruder($data),TRUE);
      $this->load->view("frm_extruder_roll_polos_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListRollPolosKePotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $key = $this->input->post("key");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "jnsPermintaan" => "POLOS",
                    "key" => $key);
      $result = $this->Accounting_Model->selectPengeluaranGudangRollKePotong($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListRollPolos_PotongKeExcel($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2,
                    "jnsPermintaan" => "POLOS");
      $result["NamaFile"] = "Laporan Roll Polos Ke Potong ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectPengeluaranGudangRollKePotong($data),TRUE);
      $this->load->view("frm_roll_polos_potong_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPotongKeRollPolos(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $key = $this->input->post("key");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "jnsPermintaan" => "POLOS",
                    "key" => $key);
      $result = $this->Accounting_Model->selectPengembalianPotongKeGudangRoll($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListPotong_RollPolosKeExcel($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2,
                    "jnsPermintaan" => "POLOS");
      $result["NamaFile"] = "Laporan Ke Roll Polos ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectPengembalianPotongKeGudangRoll($data),TRUE);
      $this->load->view("frm_potong_roll_polos_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListRollPolosKeCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $key = $this->input->post("key");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "key" => $key);
      $result = $this->Accounting_Model->selectListRollPolosKeCetak($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListRollPolos_CetakKeExcel($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2);
      $result["NamaFile"] = "Laporan Roll Polos Ke Cetak ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectListRollPolosKeCetak($data),TRUE);
      $this->load->view("frm_roll_polos_cetak_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListRollPolosKeRollCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $key = $this->input->post("key");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "key" => $key);
      $result = $this->Accounting_Model->selectListRollPolosKeRollCetak($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListRollPolos_RollCetakKeExcel($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2);
      $result["NamaFile"] = "Laporan Roll Polos Ke Roll Cetak ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectListRollPolosKeRollCetak($data),TRUE);
      $this->load->view("frm_roll_polos_roll_cetak_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListRollCetakKePotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $key = $this->input->post("key");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "jnsPermintaan" => "CETAK",
                    "key" => $key);
      $result = $this->Accounting_Model->selectPengeluaranGudangRollKePotong($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListRollCetak_PotongKeExcel($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2,
                    "jnsPermintaan" => "CETAK");
      $result["NamaFile"] = "Laporan Roll Cetak Ke Potong ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectPengeluaranGudangRollKePotong($data),TRUE);
      $this->load->view("frm_roll_cetak_potong_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPotongKeRollCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $key = $this->input->post("key");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "jnsPermintaan" => "CETAK",
                    "key" => $key);
      $result = $this->Accounting_Model->selectPengembalianPotongKeGudangRoll($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListPotong_RollCetakKeExcel($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2,
                    "jnsPermintaan" => "CETAK");
      $result["NamaFile"] = "Laporan Potong Ke Roll Cetak ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectPengembalianPotongKeGudangRoll($data),TRUE);
      $this->load->view("frm_potong_roll_cetak_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryBarangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $stsBarang = $this->input->post("stsBarang");
      $key = $this->input->post("key");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "stsBarang" => $stsBarang,
                    "key" => $key);
      $result = $this->Accounting_Model->selectListHistoryBarangHasil($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListHistoryBarangHasilToExcel($param1, $param2, $param3){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2,
                    "stsBarang" => $param3);
      $result["NamaFile"] = "Laporan Hasil Yang Masuk Ke Gudang ".$param3." ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectListHistoryBarangHasil($data), TRUE);
      $this->load->view("frm_barang_campur_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryPengeluaranBarangStandard(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $key = $this->input->post("key");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "key" => $key);
      $result = $this->Accounting_Model->selectListHistoryPengeluaranBarangStandard($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListHistoryPengeluaranBarangStandard($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2);
      $result["NamaFile"] = "Laporan Pengeluaran Gudang Standard ".$param3." ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectListHistoryPengeluaranBarangStandard($data), TRUE);
      $this->load->view("frm_barang_campur_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryJobPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Accounting_Model->selectListHistoryJobPotong($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListHistoryJobPotong($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2);
      $result["NamaFile"] = "Laporan Job Potong ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectListHistoryJobPotong($data), TRUE);
      $this->load->view("frm_job_potong_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryJobCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Accounting_Model->selectListHistoryJobCetak($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListHistoryJobCetak($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2);
      $result["NamaFile"] = "Laporan Job Cetak ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectListHistoryJobCetak($data), TRUE);
      $this->load->view("frm_job_cetak_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPemakaianBahanCetakId(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Accounting_Model->selectListPemakaianBahanCetakId($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryJobSablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Accounting_Model->selectListHistoryJobSablon($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListHistoryJobSablon($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2);
      $result["NamaFile"] = "Laporan Job Sablon ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectListHistoryJobSablon($data), TRUE);
      $this->load->view("frm_job_sablon_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $jenis = $this->input->post("jenis");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "jenis" => $jenis);
      $result = $this->Accounting_Model->selectListHistoryGudangBahan($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListHistoryGudangBahan($param1, $param2, $param3){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2,
                    "jenis" => str_replace("_"," ",$param3));
      $result["NamaFile"] = "Laporan Gudang Bahan "."(".str_replace("_"," ",$param3).")".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectListHistoryGudangBahan($data), TRUE);
      $this->load->view("frm_gudang_bahan_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryGudangSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Accounting_Model->selectListHistorySparePart($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function exportListHistoryGudangSparePart($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $param1,
                    "tglAkhir" => $param2);
      $result["NamaFile"] = "Laporan Gudang Spare Part ".date("d/F/Y",strtotime($param1))." - ".date("d/F/Y",strtotime($param2));
      $result["Data"] = json_decode($this->Accounting_Model->selectListHistorySparePart($data), TRUE);
      $this->load->view("frm_gudang_spare_part_print",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function kuantitas_gudang_hasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Kuantitas Barang");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_kuantitas_gudang_hasil",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListDataKuantitasGudangHasil()
  {
    $param  = $this->input->post("jns_brg");
    $result = $this->Accounting_Model->getListDataKuantitasGudangHasil($param);
    echo $result;
  }

  public function kuantitas_gudang_roll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Kuantitas Roll");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_kuantitas_gudang_roll",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListDataKuantitasGudangRoll()
  {
    $param  = $this->input->post("jns_brg");
    $result = $this->Accounting_Model->getListDataKuantitasGudangRoll($param);
    echo $result;
  }

  public function kuantitas_gudang_bahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Kuantitas ");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_kuantitas_gudang_bahan",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListDataKuantitasGudangBahan()
  {
    $param  = $this->input->post("jns_brg");
    $result = $this->Accounting_Model->getListDataKuantitasGudangBahan($param);
    echo $result;
  }

  public function kuantitas_spare_part(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Kuantitas ");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_kuantitas_spare_part",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListDataKuantitasSparePart()
  {
    $result = $this->Accounting_Model->getListDataKuantitasSparePart();
    echo $result;
  }

  public function kuantitas_apal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Kuantitas ");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_kuantitas_apal",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListDataKuantitasApal()
  {
    $result = $this->Accounting_Model->getListDataKuantitasApal();
    echo $result;
  }

  function exportKuantitasGudangHasil($param)
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["title"] = "Data Kuantitas Gudang Hasil ".$param;
      $data["gudang_bahan"] = $this->Accounting_Model->exportKuantitasGudangHasil($param);
      $this->load->view("frm_kuantitas_gudang_hasil_excel",$data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function exportKuantitasGudangRoll($param)
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["title"] = "Data Kuantitas Gudang Roll ".$param;
      $data["gudang_bahan"] = $this->Accounting_Model->exportKuantitasGudangRoll($param);
      $this->load->view("frm_kuantitas_gudang_roll_excel",$data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function exportKuantitasGudangBahan($param)
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $barang = str_replace("_", " ", $param);
      $data["title"] = "Data Kuantitas ".$barang;
      $data["gudang_bahan"] = $this->Accounting_Model->exportKuantitasGudangBahan($barang);
      $this->load->view("frm_kuantitas_gudang_bahan_excel",$data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function exportKuantitasSparePart()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["title"] = "Data Kuantitas Spare Part";
      $data["gudang_bahan"] = $this->Accounting_Model->exportKuantitasSparePart();
      $this->load->view("frm_kuantitas_gudang_sparepart_excel",$data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function exportKuantitasApal()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["title"] = "Data Kuantitas Apal";
      $data["gudang_bahan"] = $this->Accounting_Model->exportKuantitasApal();
      $this->load->view("frm_kuantitas_apal_excel",$data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListDataKeluarMasukSparePart()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["id"]     = $this->input->post("kd_spare_part");
      $data["tglAwal"] = $this->input->post("tglAwal");
      $data["tglAkhir"] = $this->input->post("tglAkhir");
      $result = $this->Accounting_Model->getListDataKeluarMasukSparePart($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListDataKeluarMasukBahan()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["id"]     = $this->input->post("kd_gd_bahan");
      $data["tglAwal"] = $this->input->post("tglAwal");
      $data["tglAkhir"] = $this->input->post("tglAkhir");
      $result = $this->Accounting_Model->getListDataKeluarMasukBahan($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function exportExcelDetailHistorySparePart($param1,$param2,$param3,$param4)
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["id"]       = $param1;
      $data["tglAwal"]  = $param2;
      $data["tglAkhir"] = $param3;
      $result["title"]  = "Detail History Spare Part";
      $result["nm_barang"] = $param4;
      $result["history"] = json_decode($this->Accounting_Model->getListDataKeluarMasukSparePart($data),TRUE);
      $this->load->view("frm_detail_history_sparepart_excel",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function exportExcelDetailHistoryBahan($param1,$param2,$param3,$param4)
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["id"]     = $param1;
      $data["tglAwal"] = $param2;
      $data["tglAkhir"] = $param3;
      $result["title"] = "Detail History Spare Part";
      $result["nm_barang"] = $param4;
      $result["history"] = json_decode($this->Accounting_Model->getListDataKeluarMasukBahan($data),TRUE);
      $this->load->view("frm_detail_history_bahan_excel",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getBarangSablon()
  {
    $key = $this->input->get("q");
      if(empty($key)){
        $result = $result = $this->Accounting_Model->getBarangSablon();
        echo $result;
      }else{
        $result = $this->Accounting_Model->searchBarangSablon($key);
        echo $result;
      }
  }

  function searchHistoryBarangSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["kd_gd_hasil"] = $this->input->post("kd_gd_hasil");
      $data["tglAwal"]     = $this->input->post("tglAwal");
      $data["tglAkhir"]    = $this->input->post("tglAkhir");
      $result = $this->Accounting_Model->searchHistoryBarangSablon($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListDataBarangSablonMasuk()
  {
    $data = array();
    $data["kode"]     = $this->input->post("kode");
    $data["tglAwal"]  = $this->input->post("tglAwal");
    $data["tglAkhir"] = $this->input->post("tglAkhir");
    $result = $this->Accounting_Model->getListDataBarangSablonMasuk($data);
    echo $result;
  }

  function getListDataBarangSablonKeluar()
  {
    $data = array();
    $data["kode"]     = $this->input->post("kode");
    $data["tglAwal"]  = $this->input->post("tglAwal");
    $data["tglAkhir"] = $this->input->post("tglAkhir");
    $result = $this->Accounting_Model->getListDataBarangSablonKeluar($data);
    echo $result;
  }

  function saldoAwalSablon()
  {
    $data = array();
    $data["kode"]     = $this->input->post("kd_gd_hasil");
    $data["tglAwal"]  = $this->input->post("tglAwal");
    $data["tglAkhir"] = $this->input->post("tglAkhir");
    $result = $this->Accounting_Model->saldoAwalSablon($data);
    echo $result;
  }

  function pantau_order()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
       $data["Data"] = array("Title"=>"Daftar Order");
       $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
       $this->load->view("header");
       $this->load->view("sidebar",$this->checkStatus());
       $this->load->view("frm_list_order",$data);
       $this->load->view("footer");
     }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
     }
  }

  function getDataOrder()
  {
    $jenis    = $this->input->post("jenis");
    $tglAwal  = $this->input->post("tgl1");
    $tglAkhir = $this->input->post("tgl2");
    $result   = $this->Accounting_Model->getDataOrder($jenis,$tglAwal,$tglAkhir);
    echo $result;
  }

  public function getLihatPesanan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $no_order = $this->input->post("no_order");
      echo json_encode($this->Accounting_Model->selectLihatPesanan($no_order));
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getLihatPesananDetail(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $no_order = $this->input->get("no_order");
      echo $this->Accounting_Model->selectLihatPesananDetails($no_order);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cetakFakturPesanan($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrDataPesanan = $this->Accounting_Model->selectFakturPesanan($param);
      $arrDataPesananDetail = $this->Accounting_Model->selectFakturPesananDetail($param);
      $result = array("arrDataPesanan" => $arrDataPesanan,
                      "arrDataPesananDetail" => $arrDataPesananDetail);
      $css = "assets/bootstrap/css/bootstrap.min.css";
      $page = $this->load->view("frm_print_faktur",$result,true);
      $this->load->library('m_pdf');
      $this->mpdf->mPDF("utf-8","B5-L",0,"",2,2,5,5,0,0);
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
}
?>
