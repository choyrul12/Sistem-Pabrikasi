<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
		parent::__construct();
		$this->load->model("Locking_Model");
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
       ($this->session->userdata("fabricationGroup")=="gudang bahan"||
        $this->session->userdata("fabricationGroup")=="it_department"||
        $this->session->userdata("fabricationGroup")=="SYSTEM" ||
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
          array("Content"=>"Gudang Hasil","Link"=>"#","Name"=>"Gudang_Hasil","Status"=>"Parent","Icon"=>"fa fa-folder","Id"=>"M_Gudang_Hasil"),
          array("Content"=>"Gudang Roll","Link"=>"#","Name"=>"Gudang_Roll","Status"=>"Parent","Icon"=>"fa fa-folder","Id"=>"M_Gudang_Roll"),
          array("Content"=>"Gudang Bahan","Link"=>"#","Name"=>"Gudang_Bahan","Status"=>"Parent","Icon"=>"fa fa-folder","Id"=>"M_Gudang_Bahan"),
        );
        $listMenu["childMenu"] = array(
          #=======Gudang Hasil Child Menu (Start)=======#
          array("Content"=>"Gudang Campur","Link"=>"_locking/main/gudang_campur","Status"=>"Single","Parent"=>"Gudang_Hasil","Id"=>"MI_Gudang_Campur"),
          array("Content"=>"Gudang Standard","Link"=>"_locking/main/gudang_standard","Status"=>"Single","Parent"=>"Gudang_Hasil","Id"=>"MI_Gudang_Standard"),
          array("Content"=>"Gudang Sablon (Buffer)","Link"=>"_locking/main/gudang_sablon_buffer","Status"=>"Single","Parent"=>"Gudang_Hasil","Id"=>"MI_Gudang_Sablon_Buffer"),
          array("Content"=>"Gudang Sablon (Hasil)","Link"=>"_locking/main/gudang_sablon_hasil","Status"=>"Single","Parent"=>"Gudang_Hasil","Id"=>"MI_Gudang_Sablon_Hasil"),
          #=======Gudang Hasil Child Menu (Finish)=======#

          #=======Gudang Roll Child Menu (Start)=======#
          array("Content"=>"Gudang Roll Polos","Link"=>"_locking/main/gudang_roll_polos","Status"=>"Single","Parent"=>"Gudang_Roll","Id"=>"MI_Gudang_Roll_Polos"),
          array("Content"=>"Gudang Roll Cetak","Link"=>"_locking/main/gudang_roll_cetak","Status"=>"Single","Parent"=>"Gudang_Roll","Id"=>"MI_Gudang_Roll_Cetak"),
          #=======Gudang Roll Child Menu (Finish)=======#

          #=======Gudang Bahan Child Menu (Start)=======#
          array("Content"=>"Gudang Bahan Baku","Link"=>"_locking/main/gudang_bahan_baku","Status"=>"Single","Parent"=>"Gudang_Bahan","Id"=>"MI_Gudang_Bahan_Baku"),
          array("Content"=>"Gudang Biji Warna","Link"=>"_locking/main/gudang_biji_warna","Status"=>"Single","Parent"=>"Gudang_Bahan","Id"=>"MI_Gudang_Biji_Warna"),
          array("Content"=>"Gudang Minyak","Link"=>"_locking/main/gudang_minyak","Status"=>"Single","Parent"=>"Gudang_Bahan","Id"=>"MI_Gudang_Minyak"),
          array("Content"=>"Gudang Cat Campur","Link"=>"_locking/main/gudang_cat_campur","Status"=>"Single","Parent"=>"Gudang_Bahan","Id"=>"MI_Gudang_Cat_Campur"),
          array("Content"=>"Gudang Cat Murni","Link"=>"_locking/main/gudang_cat_murni","Status"=>"Single","Parent"=>"Gudang_Bahan","Id"=>"MI_Gudang_Cat_Murni"),
          array("Content"=>"Gudang Apal","Link"=>"_locking/main/gudang_apal","Status"=>"Single","Parent"=>"Gudang_Bahan","Id"=>"MI_Gudang_Apal"),
          array("Content"=>"Gudang Spare Part","Link"=>"_locking/main/gudang_spare_part","Status"=>"Single","Parent"=>"Gudang_Bahan","Id"=>"MI_Gudang_Spare_Part"),
          #=======Gudang Bahan Child Menu (Finish)=======#
        );
        return $listMenu;
      }else{

      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function gudang_campur(){
    $isLogin = $this->isLogin();
    if($isLogin){
       $data["Data"] = array("Title"=>"DETAIL GUDANG CAMPUR ");
       $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
       $this->load->view("header");
       $this->load->view("sidebar",$this->checkStatus());
       $this->load->view("frm_data_masuk_gudang_campur",$data);
       $this->load->view("footer");
     }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
     }
  }

  public function gudang_standard(){
    $isLogin = $this->isLogin();
    if($isLogin){
       $data["Data"] = array("Title"=>"DETAIL GUDANG STANDARD ");
       $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
       $this->load->view("header");
       $this->load->view("sidebar",$this->checkStatus());
       $this->load->view("frm_data_masuk_gudang_standard",$data);
       $this->load->view("footer");
     }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
     }
  }

  public function gudang_sablon_buffer(){
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

  public function gudang_sablon_hasil(){
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

  public function gudang_roll_polos(){
    $isLogin = $this->isLogin();
    if($isLogin){
       $data["Data"] = array("Title"=>"SELAMAT DATANG ".strtoupper($this->session->userdata("fabricationUsername")));
       $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
       $this->load->view("header");
       $this->load->view("sidebar",$this->checkStatus());
       $this->load->view("frm_data_transaksi_gudang_roll_polos",$data);
       $this->load->view("footer");
     }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
     }
  }

  public function gudang_roll_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
       $data["Data"] = array("Title"=>"SELAMAT DATANG ".strtoupper($this->session->userdata("fabricationUsername")));
       $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
       $this->load->view("header");
       $this->load->view("sidebar",$this->checkStatus());
       $this->load->view("frm_data_transaksi_gudang_roll_cetak",$data);
       $this->load->view("footer");
     }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
     }
  }

  public function gudang_bahan_baku(){
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

  public function gudang_biji_warna(){
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

  public function gudang_minyak(){
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

  public function gudang_cat_campur(){
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

  public function gudang_cat_murni(){
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

  public function gudang_apal(){
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

  public function gudang_spare_part(){
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
  public function getDataMasukGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $stsBarang = $this->input->post("stsBarang");

      $data = array("tglAwal"   => $tglAwal,
                    "tglAkhir"  => $tglAkhir,
                    "stsBarang" => $stsBarang);

      $result = $this->Locking_Model->selectListGudangHasil($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function getListTransaksiGudangRollPolos(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Locking_Model->selectListTransaksiGudangRollPolos($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function exportListTransaksiGudangRollPolos($tglAwal,$tglAkhir){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = json_decode($this->Locking_Model->selectListTransaksiGudangRollPolos($data),TRUE);
      $this->load->view("frm_data_transaksi_gudang_roll_polos_excel",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
  public function editLockAndUnlockGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $statusLock = $this->input->post("statusLock");
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      if(
        empty($statusLock)    ||
        empty($tglAwal)       ||
        empty($tglAkhir)      ||
        empty($jnsPermintaan)
      ){
        echo "Data Kosong";
      }else{
        $data = array("statusLock"      => $statusLock,
                      "jnsPermintaan"   => $jnsPermintaan,
                      "tglAwal"         => $tglAwal,
                      "tglAkhir"        => $tglAkhir);
        $result = $this->Locking_Model->updateTransaksiGudangRoll($data);
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

  public function editLockAndUnlockGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $statusLock = $this->input->post("statusLock");
      $stsBarang = $this->input->post("stsBarang");
      if(
        empty($statusLock)    ||
        empty($tglAwal)       ||
        empty($tglAkhir)      ||
        empty($stsBarang)
      ){
        echo "Data Kosong";
      }else{
        $data = array("statusLock"      => $statusLock,
                      "stsBarang"       => $stsBarang,
                      "tglAwal"         => $tglAwal,
                      "tglAkhir"        => $tglAkhir);
        $result = $this->Locking_Model->updateTransaksiGudangHasil($data);
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
}
?>
