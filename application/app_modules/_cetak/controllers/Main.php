<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
		parent::__construct();
		$this->load->model("Cetak_Model");
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
       ($this->session->userdata("fabricationGroup")=="cetak"||
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
          array("Content"=>"Data Rencana PPIC","Link"=>"_cetak/main/data_rencana_ppic","Name"=>"Approve_Permintaan","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Data_Rencana_PPIC"),
          array("Content"=>"Data Rencana Mandor","Link"=>"_cetak/main/data_rencana_mandor","Name"=>"","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Data_Rencana_Mandor"),
          array("Content"=>"Hasil Cetak","Link"=>"_cetak/main/hasil_cetak","Name"=>"","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Hasil_Cetak"),
          array("Content"=>"Bon Apal","Link"=>"_cetak/main/bon_apal","Name"=>"","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Bon_Apal"),
          array("Content"=>"Bon Hasil Cetak","Link"=>"_cetak/main/bon_hasil_cetak","Name"=>"","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Bon_Hasil_Cetak"),
          array("Content"=>"Bon Pengambilan","Link"=>"#","Name"=>"Pengambilan","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Bon_Pengambilan"),
          array("Content"=>"Bon Pengembalian","Link"=>"#","Name"=>"Pengembalian","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Bon_Pengembalian"),
          array("Content"=>"Barang Yang Diambil Potong","Link"=>"_cetak/main/barang_diambil_potong","Name"=>"","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Barang_Yang_Diambil_Potong"),
          array("Content"=>"Pengambilan Extruder","Link"=>"_cetak/main/pengambilan_extruder","Name"=>"","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Barang_Pengambilan_Extruder")
        );
        $listMenu["childMenu"] = array(
          #============Bon Pengambilan (Start)============#
          array("Content"=>"Bon Pengambilan Minyak","Link"=>"_cetak/main/bon_pengambilan_minyak","Parent"=>"Pengambilan","Id"=>"Bon_Pengambilan_Minyak"),
          array("Content"=>"Bon Pengambilan Cat Campur","Link"=>"_cetak/main/bon_pengambilan_cat_campur","Parent"=>"Pengambilan","Id"=>"Bon_Pengambilan_Cat_Campur"),
          array("Content"=>"Bon Pengambilan Cat Murni","Link"=>"_cetak/main/bon_pengambilan_cat_murni","Parent"=>"Pengambilan","Id"=>"Bon_Pengambilan_Cat_Murni"),
          array("Content"=>"Bon Pengambilan Gudang (Polos)","Link"=>"_cetak/main/bon_pengambilan_gudang_roll_polos","Parent"=>"Pengambilan","Id"=>"Bon_Pengambilan_Gudang"),
          #============Bon Pengambilan (Finish)============#
          #============Bon Pengembalian (Start)============#
          array("Content"=>"Bon Pengembalian Cat Campur","Link"=>"_cetak/main/bon_pengembalian_cat_campur","Parent"=>"Pengembalian","Id"=>"Bon_Pemngembalian_Cat_Campur"),
          #============Bon Pengembalian (Start)============#
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

  public function data_rencana_ppic(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Data Rencana PPIC");
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

  public function data_rencana_mandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Data Rencana Mandor");
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

  public function hasil_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Hasil Cetak");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_hasil_cetak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bon_apal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Data Bon Apal");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_bon_apal",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bon_hasil_cetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Bon Hasil Cetak");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_bon_hasil_cetak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bon_pengambilan_minyak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Bon Pengambilan Minyak");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_bon_pengambilan_minyak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bon_pengambilan_cat_campur(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Bon Pengambilan Cat Campur");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_bon_pengambilan_cat_campur",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bon_pengambilan_cat_murni(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Bon Pengambilan Cat Murni");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_bon_pengambilan_cat_murni",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bon_pengembalian_cat_campur(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Bon Pengembalian Cat Campur");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_bon_pengembalian_cat_campur",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function barang_diambil_potong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Barang Yang Diambil Potong");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_barang_diambil_potong",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pengambilan_extruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pengambilan Extruder");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_data_pengambilan_extruder",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function bon_pengambilan_gudang_roll_polos(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pengambilan Gudang Roll Polos");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_bon_pengambilan_gudang_roll_polos",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGenerateCetakCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->generatePotongCode();
      echo json_encode(array("Code"=>$result));
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getRencanaPPIC(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $bulan = $this->input->post("bulan");
      $tahun = $this->input->post("tahun");
      if(empty($bulan) || empty($tahun)){
        $data = array("bulan" => date("m"),
                      "tahun" => date("Y"));
      }else{
        $data = array("bulan" => $bulan,
                      "tahun" => $tahun);
      }
      $result = $this->Cetak_Model->selectRencanaPPIC($data);
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
      $result = $this->Cetak_Model->selectDetailRencanaPPIC($kdPpic);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAndEditKonversi(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $jumlahKonversi = $this->input->post("jumlahKonversi");
      if($jumlahKonversi==""){
        echo "Data Kosong";
      }else{
        $data = array("kd_ppic" => $idTransaksi,
                      "satuan_kilo" => $jumlahKonversi,
                      "sisa" => $jumlahKonversi);
        $result = $this->Cetak_Model->updateRencanaPPIC($data);
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

  public function getListMesin(){
    $result = $this->Cetak_Model->selectMesin();
    echo $result;
  }

  public function getComboBoxValueGudangRoll($param,$param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $Key = $this->input->get("q");
      if(empty($Key)){
        $data = array("JnsPermintaan" => $param,
                      "panjangPlastik" => $param2);
        $result = $this->Cetak_Model->selectComboBoxValueGudangRoll($data);
      }else{
        $data = array("JnsPermintaan" => $param,
                      "panjangPlastik" => $param2,
                      "Key" => $Key);
        $result = $this->Cetak_Model->selectComboBoxValueGudangRollSearch($data);
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getRencanaPPICPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->selectRencanaMandorPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveRencanaCetakPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idRencanaPPIC = $this->input->post("idRencanaPPIC");
      $idRencanaCetak = $this->input->post("idRencanaCetak");
      $kdGdRollCetak = $this->input->post("kdGdRollCetak");
      $kdGdRollPolos = $this->input->post("kdGdRollPolos");
      $customer = $this->input->post("customer");
      $merek = $this->input->post("merek");
      $ukuran = $this->input->post("ukuran");
      $warnaPlastik = $this->input->post("warnaPlastik");
      $warnaCat = $this->input->post("warnaCat");
      $tglRencana = $this->input->post("tglRencana");
      $noMesin = $this->input->post("noMesin");
      $tebal = $this->input->post("tebal");
      $jmlPermintaan = $this->input->post("jmlPermintaan");
      $jnsBrg = $this->input->post("jnsBrg");
      $strip = $this->input->post("strip");
      $idUser = $this->session->userdata("fabricationIdUser");

      if(empty($idRencanaCetak) || empty($kdGdRollCetak) || empty($kdGdRollPolos) ||
         empty($customer) || empty($merek) || empty($ukuran) || empty($warnaPlastik) ||
         empty($warnaCat) || empty($tglRencana) || empty($noMesin) || $tebal=="" ||
         $jmlPermintaan=="" || empty($jnsBrg) || empty($strip) || empty($idUser)
       ){
         echo "Data Kosong";
       }else{
         $data = array(
           "kd_cetak" => $idRencanaCetak,
           "kd_ppic" => $idRencanaPPIC,
           "kd_gd_cetak" => $kdGdRollCetak,
           "kd_gd_roll" => $kdGdRollPolos,
           "id_user" => $idUser,
           "customer" => $customer,
           "merek" => $merek,
           "ukuran" => $ukuran,
           "warna_plastik" => $warnaPlastik,
           "warna_cat" => $warnaCat,
           "tgl_rencana" => $tglRencana,
           "no_mesin" => $noMesin,
           "tebal" => $tebal,
           "jml_permintaan" => $jmlPermintaan,
           "stok_permintaan" => $jmlPermintaan,
           "jns_brg" => $jnsBrg,
           "strip" => $strip
         );
         $result = $this->Cetak_Model->insertRencanaCetak($data);
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

  public function saveRencanaCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrResult = json_decode($this->Cetak_Model->selectRencanaMandorPending(),TRUE);
      $arrData = array();
      foreach ($arrResult as $valueResult) {
        array_push($arrData,array("kd_ppic"=>$valueResult["kd_ppic"],
                                  "sts_pengerjaan"=>"PROGRESS"));
      }
      $result = $this->Cetak_Model->updateSaveRencanaCetak($arrData);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailRencanaMandorPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdCetak = $this->input->post("kdCetak");
      $kdPPIC = $this->input->post("kdPPIC");
      $data = array("kdCetak" => $kdCetak,
                    "kdPPIC" => $kdPPIC);
      $result = $this->Cetak_Model->selectDetailRencanaMandorPending($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editRencanaMandorPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idRencanaPPIC = $this->input->post("idRencanaPPIC");
      $idRencanaCetak = $this->input->post("idRencanaCetak");
      $kdGdRollCetak = $this->input->post("kdGdRollCetak");
      $kdGdRollPolos = $this->input->post("kdGdRollPolos");
      $customer = $this->input->post("customer");
      $merek = $this->input->post("merek");
      $ukuran = $this->input->post("ukuran");
      $warnaPlastik = $this->input->post("warnaPlastik");
      $warnaCat = $this->input->post("warnaCat");
      $tglRencana = $this->input->post("tglRencana");
      $noMesin = $this->input->post("noMesin");
      $tebal = $this->input->post("tebal");
      $jmlPermintaan = $this->input->post("jmlPermintaan");
      $jnsBrg = $this->input->post("jnsBrg");
      $strip = $this->input->post("strip");
      $idUser = $this->session->userdata("fabricationIdUser");

      if(empty($idRencanaCetak) || empty($kdGdRollCetak) ||
         empty($customer) || empty($merek) || empty($ukuran) || empty($warnaPlastik) ||
         empty($warnaCat) || empty($tglRencana) || empty($noMesin) || $tebal=="" ||
         $jmlPermintaan=="" || empty($jnsBrg) || empty($strip) || empty($idUser)
       ){
         echo "Data Kosong";
       }else{
         if(empty($kdGdRollPolos)){
           $data = array(
             "kd_cetak" => $idRencanaCetak,
             "kd_ppic" => $idRencanaPPIC,
             "kd_gd_cetak" => $kdGdRollCetak,
             "id_user" => $idUser,
             "customer" => $customer,
             "merek" => $merek,
             "ukuran" => $ukuran,
             "warna_plastik" => $warnaPlastik,
             "warna_cat" => $warnaCat,
             "tgl_rencana" => $tglRencana,
             "no_mesin" => $noMesin,
             "tebal" => $tebal,
             "jml_permintaan" => $jmlPermintaan,
             "stok_permintaan" => $jmlPermintaan,
             "jns_brg" => $jnsBrg,
             "strip" => $strip
           );
         }else{
           $data = array(
             "kd_cetak" => $idRencanaCetak,
             "kd_ppic" => $idRencanaPPIC,
             "kd_gd_cetak" => $kdGdRollCetak,
             "kd_gd_roll" => $kdGdRollPolos,
             "id_user" => $idUser,
             "customer" => $customer,
             "merek" => $merek,
             "ukuran" => $ukuran,
             "warna_plastik" => $warnaPlastik,
             "warna_cat" => $warnaCat,
             "tgl_rencana" => $tglRencana,
             "no_mesin" => $noMesin,
             "tebal" => $tebal,
             "jml_permintaan" => $jmlPermintaan,
             "stok_permintaan" => $jmlPermintaan,
             "jns_brg" => $jnsBrg,
             "strip" => $strip
           );
         }
         $result = $this->Cetak_Model->updateRencanaCetakPending($data);
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

  public function deleteAndRestoreRencanaMandorPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      $data = array("kd_cetak" => $idTransaksi,
                    "deleted" => $deleted);
      $result = $this->Cetak_Model->updateRencanaCetakPending($data);
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

  public function getListRencanaMandor(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->selectListRencanaMandor();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueGudangCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $Key = $this->input->get("q");
      if(empty($Key)){
        $result = $this->Cetak_Model->selectComboBoxValueGudangCetak();
      }else{
        $data = array("Key" => $Key);
        $result = $this->Cetak_Model->selectComboBoxValueGudangCetakSearch($data);
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveTambahRencanaSusulanPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idRencanaCetak = $this->input->post("idRencanaCetak");
      $kdGdRollCetak = $this->input->post("kdGdRollCetak");
      $kdGdRollPolos = $this->input->post("kdGdRollPolos");
      $customer = $this->input->post("customer");
      $merek = $this->input->post("merek");
      $ukuran = $this->input->post("ukuran");
      $warnaPlastik = $this->input->post("warnaPlastik");
      $warnaCat = $this->input->post("warnaCat");
      $tglRencana = $this->input->post("tglRencana");
      $noMesin = $this->input->post("noMesin");
      $tebal = $this->input->post("tebal");
      $jmlPermintaan = $this->input->post("jmlPermintaan");
      $jnsBrg = $this->input->post("jnsBrg");
      $strip = $this->input->post("strip");
      $idUser = $this->session->userdata("fabricationIdUser");

      if(empty($idRencanaCetak) || empty($kdGdRollCetak) || empty($kdGdRollPolos) ||
         empty($customer) || empty($merek) || empty($ukuran) || empty($warnaPlastik) ||
         empty($warnaCat) || empty($tglRencana) || empty($noMesin) || $tebal=="" ||
         $jmlPermintaan=="" || empty($jnsBrg) || empty($strip) || empty($idUser)
       ){
         echo "Data Kosong";
       }else{
         $data = array(
           "kd_cetak" => $idRencanaCetak,
           "kd_gd_cetak" => $kdGdRollCetak,
           "kd_gd_roll" => $kdGdRollPolos,
           "id_user" => $idUser,
           "customer" => $customer,
           "merek" => $merek,
           "ukuran" => $ukuran,
           "warna_plastik" => $warnaPlastik,
           "warna_cat" => $warnaCat,
           "tgl_rencana" => $tglRencana,
           "no_mesin" => $noMesin,
           "tebal" => $tebal,
           "jml_permintaan" => $jmlPermintaan,
           "stok_permintaan" => $jmlPermintaan,
           "jns_brg" => $jnsBrg,
           "strip" => $strip
         );
         $result = $this->Cetak_Model->insertRencanaCetak($data);
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

  public function getRencanaSusulanPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->selectRencanaMandorSusulanPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailRencanaSusulan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Cetak_Model->selectDetailRencana($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editTambahRencanaSusulanPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idRencanaCetak = $this->input->post("idRencanaCetak");
      $kdGdRollCetak = $this->input->post("kdGdRollCetak");
      $kdGdRollPolos = $this->input->post("kdGdRollPolos");
      $customer = $this->input->post("customer");
      $merek = $this->input->post("merek");
      $ukuran = $this->input->post("ukuran");
      $warnaPlastik = $this->input->post("warnaPlastik");
      $warnaCat = $this->input->post("warnaCat");
      $tglRencana = $this->input->post("tglRencana");
      $noMesin = $this->input->post("noMesin");
      $tebal = $this->input->post("tebal");
      $jmlPermintaan = $this->input->post("jmlPermintaan");
      $jnsBrg = $this->input->post("jnsBrg");
      $strip = $this->input->post("strip");
      $idUser = $this->session->userdata("fabricationIdUser");

      if(empty($idRencanaCetak) || empty($customer) || empty($warnaCat) ||
         empty($tglRencana) || empty($noMesin) || $tebal=="" ||
         $jmlPermintaan=="" || empty($strip) || empty($idUser)
       ){
         echo "Data Kosong";
       }else{
         if(empty($kdGdRollCetak) || empty($kdGdRollPolos)){
           $data = array(
             "kd_cetak" => $idRencanaCetak,
             "id_user" => $idUser,
             "customer" => $customer,
             "warna_cat" => $warnaCat,
             "tgl_rencana" => $tglRencana,
             "no_mesin" => $noMesin,
             "tebal" => $tebal,
             "jml_permintaan" => $jmlPermintaan,
             "stok_permintaan" => $jmlPermintaan,
             "strip" => $strip
           );
         }else{
           $data = array(
             "kd_cetak" => $idRencanaCetak,
             "kd_gd_cetak" => $kdGdRollCetak,
             "kd_gd_roll" => $kdGdRollPolos,
             "id_user" => $idUser,
             "customer" => $customer,
             "merek" => $merek,
             "ukuran" => $ukuran,
             "warna_plastik" => $warnaPlastik,
             "warna_cat" => $warnaCat,
             "tgl_rencana" => $tglRencana,
             "no_mesin" => $noMesin,
             "tebal" => $tebal,
             "jml_permintaan" => $jmlPermintaan,
             "stok_permintaan" => $jmlPermintaan,
             "jns_brg" => $jnsBrg,
             "strip" => $strip
           );
         }
         $result = $this->Cetak_Model->updateRencanaCetakPending($data);
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

  public function saveRencanaCetakSusulan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrData = json_decode($this->Cetak_Model->selectRencanaMandorSusulanPending(),TRUE);
      if(count($arrData) <= 0){
        echo "Data Kosong";
      }else{
        $result = $this->Cetak_Model->updateRencanaCetakSusulanPending();
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

  public function editStatusPengerjaan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $stsPengerjaan = $this->input->post("stsPengerjaan");
      if(empty($stsPengerjaan)){
        echo "Data Kosong";
      }else{
        $data = array("kd_cetak" => $idTransaksi,
                      "sts_pengerjaan" => $stsPengerjaan);
        $result = $this->Cetak_Model->updateRencanaCetakPending($data);
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
      $idTransaksi = $this->input->post("idTransaksi");
      $noMesin = $this->input->post("noMesin");
      if(empty($noMesin)){
        echo "Data Kosong";
      }else{
        $data = array("kd_cetak" => $idTransaksi,
                      "no_mesin" => $noMesin);
        $result = $this->Cetak_Model->updateRencanaCetakPending($data);
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

  public function getListCatMurni(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->selectListCatMurni();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListCatCampur(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->selectListCatCampur();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListMinyak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->selectListMinyak();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->selectJenisApal();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGenerateInputHasilCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->generateInputHasilCode();
      echo json_encode(array("Code"=>$result));
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailRencanaForInpurHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Cetak_Model->selectDetailRencanaForInpurHasil($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPengambilanCetakExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdCetak = $this->input->post("kdCetak");
      $tglRencana = $this->input->post("tglRencana");
      $data = array("kdCetak" => $kdCetak,
                    "tglRencana" => $tglRencana);
      $result = $this->Cetak_Model->selectPengambilanCetakExtruder($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveInputHasilCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $idRencanaCetak = $this->input->post("idRencanaCetak");
      $namaOperator = $this->input->post("namaOperator");
      $tglTransaksi = $this->input->post("tglTransaksi");
      $jumlahHasilBerat = $this->input->post("jumlahHasilBerat");
      $jumlahHasilBobin = $this->input->post("jumlahHasilBobin");
      $jumlahHasilPayung = $this->input->post("jumlahHasilPayung");
      $jumlahHasilPayungKuning = $this->input->post("jumlahHasilPayungKuning");
      $beratRoll = $this->input->post("beratRoll");
      $plusMinus = $this->input->post("plusMinus");
      $kdGdRollCetak = $this->input->post("kdGdRollCetak");
      $kdGdRollPolos = $this->input->post("kdGdRollPolos");
      $jumlahBeratPengambilanExtruder = $this->input->post("jumlahBeratPengambilanExtruder");
      $jumlahPayungPengambilanExtruder = $this->input->post("jumlahPayungPengambilanExtruder");
      $jumlahPayungKuningPengambilanExtruder = $this->input->post("jumlahPayungKuningPengambilanExtruder");
      $jumlahBobinPengambilanExtruder = $this->input->post("jumlahBobinPengambilanExtruder");
      $jumlahBeratPengambilan = $this->input->post("jumlahBeratPengambilan");
      $jumlahPayungPengambilan = $this->input->post("jumlahPayungPengambilan");
      $jumlahPayungKuningPengambilan = $this->input->post("jumlahPayungKuningPengambilan");
      $jumlahBobinPengambilan = $this->input->post("jumlahBobinPengambilan");
      $jumlahSisaPengambalian = $this->input->post("jumlahSisaPengambalian");
      $jumlahBeratHasilCetak = $this->input->post("jumlahBeratHasilCetak");
      $jumlahPayungHasilCetak = $this->input->post("jumlahPayungHasilCetak");
      $jumlahPayungKuningHasilCetak = $this->input->post("jumlahPayungKuningHasilCetak");
      $jumlahBobinHasilCetak = $this->input->post("jumlahBobinHasilCetak");
      $jumlahPayungTerbuang = $this->input->post("jumlahPayungTerbuang");
      $jumlahPayungKuningTerbuang = $this->input->post("jumlahPayungKuningTerbuang");
      $jumlahBobinTerbuang = $this->input->post("jumlahBobinTerbuang");
      $kdGdApal = $this->input->post("kdGdApal");
      $jumlahApal = $this->input->post("jumlahApal");
      $jenisRoll = $this->input->post("jenisRoll");
      $arrCatMurni = $this->input->post("arrCatMurni");
      $arrCatCampur = $this->input->post("arrCatCampur");
      $arrMinyak = $this->input->post("arrMinyak");
      $idUser = $this->session->userdata("fabricationIdUser");
      if(empty($idTransaksi)             || empty($idRencanaCetak)           || empty($namaOperator)                   || empty($tglTransaksi)                      ||
         $jumlahHasilBerat==""           || $jumlahHasilBobin==""            || $jumlahHasilPayung==""                 || $jumlahHasilPayungKuning==""              ||
         $beratRoll==""                  || $plusMinus==""                   || empty($kdGdRollCetak)                  || empty($kdGdRollPolos)                     ||
         $jumlahBeratPengambilan==""     || $jumlahPayungPengambilan==""     || $jumlahPayungKuningPengambilan==""     || $jumlahBobinPengambilan==""               ||
         $jumlahSisaPengambalian==""     || $jumlahBeratHasilCetak==""       || $jumlahPayungHasilCetak==""            || $jumlahPayungKuningHasilCetak==""         ||
         $jumlahBobinHasilCetak==""      || $jumlahPayungTerbuang==""        || $jumlahPayungKuningTerbuang==""        || $jumlahBobinTerbuang==""                  ||
         empty($kdGdApal)                || $jumlahApal==""                  || $jenisRoll==""                         || empty($idUser)
       ){
         echo "Data Kosong";
       }else{
         $data["THC"] = array("kd_hasil_cetak"  => $idTransaksi,
                              "kd_cetak"        => $idRencanaCetak,
                              "kd_gd_roll"      => $kdGdRollCetak,
                              "id_user"         => $idUser,
                              "nama_operator"   => $namaOperator,
                              "tgl_transaksi"   => $tglTransaksi,
                              "jumlah_selesai"  => $jumlahHasilBerat,
                              "bobin"           => $jumlahHasilBobin,
                              "payung"          => $jumlahHasilPayung,
                              "payung_kuning"   => $jumlahHasilPayungKuning,
                              "berat_roll"      => $beratRoll,
                              "plusminus"       => $plusMinus);

         $data["TDHC"] = array("kd_hasil_cetak" => $idTransaksi,
                               "kd_gd_roll_cetak" => $kdGdRollCetak,
                               "kd_gd_roll_polos" => $kdGdRollPolos,
                               "kd_gd_apal" => $kdGdApal,
                               "id_user" => $idUser,
                               "jumlah_berat_pengambilan_extruder" => $jumlahBeratPengambilanExtruder,
                               "jumlah_payung_pengambilan_extruder" => $jumlahPayungPengambilanExtruder,
                               "jumlah_payung_kuning_pengambilan_extruder" => $jumlahPayungKuningPengambilanExtruder,
                               "jumlah_bobin_pengambilan_extruder" => $jumlahBobinPengambilanExtruder,
                               "jumlah_berat_pengambilan" => $jumlahBeratPengambilan,
                               "jumlah_payung_pengambilan" => $jumlahPayungPengambilan,
                               "jumlah_payung_kuning_pengambilan" => $jumlahPayungKuningPengambilan,
                               "jumlah_bobin_pengambilan" => $jumlahBobinPengambilan,
                               "jumlah_sisa_pengambilan" => $jumlahSisaPengambalian,
                               "jumlah_hasil_selesai" => $jumlahBeratHasilCetak,
                               "jumlah_hasil_payung" => $jumlahPayungHasilCetak,
                               "jumlah_hasil_payung_kuning" => $jumlahPayungKuningHasilCetak,
                               "jumlah_hasil_bobin" => $jumlahBobinHasilCetak,
                               "jumlah_payung_terbuang" => $jumlahPayungTerbuang,
                               "jumlah_payung_kuning_terbuang" => $jumlahPayungKuningTerbuang,
                               "jumlah_bobin_terbuang" => $jumlahBobinTerbuang,
                               "jumlah_apal" => $jumlahApal,
                               "jenis_roll" => $jenisRoll);

         $data["TPBC"] = array();
         foreach ($arrCatMurni as $valueCatMurni) {
           $tempArray = array("kd_hasil_cetak" => $idTransaksi,
                              "kd_gd_bahan" => $valueCatMurni["kdGdBahan"],
                              "id_user" => $idUser,
                              "tgl_pengambilan" => $tglTransaksi,
                              "jumlah_pengambilan" => $valueCatMurni["jumlah"],
                              "sisa_pengambilan" => $valueCatMurni["sisa"]);
           array_push($data["TPBC"], $tempArray);
         }

         foreach ($arrCatCampur as $valueCatCampur) {
           $tempArray = array("kd_hasil_cetak" => $idTransaksi,
                              "kd_gd_bahan" => $valueCatCampur["kdGdBahan"],
                              "id_user" => $idUser,
                              "tgl_pengambilan" => $tglTransaksi,
                              "jumlah_pengambilan" => $valueCatCampur["jumlah"],
                              "sisa_pengambilan" => $valueCatCampur["sisa"]);
           array_push($data["TPBC"], $tempArray);
         }

         foreach ($arrMinyak as $valueMinyak) {
           $tempArray = array("kd_hasil_cetak" => $idTransaksi,
                              "kd_gd_bahan" => $valueMinyak["kdGdBahan"],
                              "id_user" => $idUser,
                              "tgl_pengambilan" => $tglTransaksi,
                              "jumlah_pengambilan" => $valueMinyak["jumlah"],
                              "sisa_pengambilan" => $valueMinyak["sisa"]);
           array_push($data["TPBC"], $tempArray);
         }
         $result = $this->Cetak_Model->insertHasilCetak($data);
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

  public function getHasilJobCetakPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->selectHasilJobCetakPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestoreHasilJobCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      if(empty($idTransaksi) || empty($deleted)){
        echo "Data Kosong";
      }else{
        $data = array("kd_hasil_cetak" => $idTransaksi,
                      "deleted" => $deleted);
        $result = $this->Cetak_Model->updateDeleteAndRestoreHasilJobCetak($data);
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

  public function getListPemakaianBahanCetakId(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Cetak_Model->selectListPemakaianBahanCetakId($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveHasilJobCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->updateSelesaiHasilJobCetak();
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

  public function getListHasilCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Cetak_Model->selectListHasilCetak($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getEditDetailJobCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Cetak_Model->selectEditDetailJobCetak($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editDetailJobCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $jumlahBeratPengambilan = $this->input->post("jumlahBeratPengambilan");
      $jumlahPayungPengambilan = $this->input->post("jumlahPayungPengambilan");
      $jumlahPayungKuningPengambilan = $this->input->post("jumlahPayungKuningPengambilan");
      $jumlahBobinPengambilan = $this->input->post("jumlahBobinPengambilan");
      $jumlahSisaPengambilan = $this->input->post("jumlahSisaPengambilan");
      $jumlahBeratHasil = $this->input->post("jumlahBeratHasil");
      $jumlahPayungHasil = $this->input->post("jumlahPayungHasil");
      $jumlahPayungKuningHasil = $this->input->post("jumlahPayungKuningHasil");
      $jumlahBobinHasil = $this->input->post("jumlahBobinHasil");
      $jumlahApal = $this->input->post("jumlahApal");
      $jumlahPayungTerbuang = $this->input->post("jumlahPayungTerbuang");
      $jumlahPayungKuningTerbuang = $this->input->post("jumlahPayungKuningTerbuang");
      $jumlahBobinTerbuang = $this->input->post("jumlahBobinTerbuang");
      $rollPipa = $this->input->post("rollPipa");
      $plusminus = $this->input->post("plusminus");
      $tglTransaksi = $this->input->post("tglTransaksi");
      $idUser = $this->session->userdata("fabricationIdUser");

      if($idTransaksi == "" || $jumlahBeratPengambilan == "" || $jumlahPayungPengambilan == "" ||
         $jumlahPayungKuningPengambilan == "" || $jumlahBobinPengambilan == "" || $jumlahSisaPengambilan == "" ||
         $jumlahBeratHasil == "" || $jumlahPayungHasil == "" || $jumlahPayungKuningHasil == "" ||
         $jumlahBobinHasil == "" || $jumlahApal == "" || $jumlahPayungTerbuang == "" ||
         $jumlahPayungKuningTerbuang == "" || $jumlahBobinTerbuang == "" || $rollPipa == "" ||
         $plusminus == "" || $tglTransaksi == "" || empty($idUser)
       ){
         echo "Data Kosong";
       }else{
          $data = array("THC" => array("kd_hasil_cetak"   => $idTransaksi,
                                       "id_user"          => $idUser,
                                       "tgl_transaksi"    => $tglTransaksi,
                                       "jumlah_selesai"   => $jumlahBeratHasil,
                                       "bobin"            => $jumlahBobinHasil,
                                       "payung"           => $jumlahPayungHasil,
                                       "payung_kuning"    => $jumlahPayungKuningHasil,
                                       "berat_roll"       => $rollPipa,
                                       "plusminus"        => $plusminus),
                        "TDHC" => array("kd_hasil_cetak"                    => $idTransaksi,
                                        "id_user"                           => $idUser,
                                        "jumlah_berat_pengambilan"          => $jumlahBeratPengambilan,
                                        "jumlah_payung_pengambilan"         => $jumlahPayungPengambilan,
                                        "jumlah_payung_kuning_pengambilan"  => $jumlahPayungKuningPengambilan,
                                        "jumlah_bobin_pengambilan"          => $jumlahBobinPengambilan,
                                        "jumlah_sisa_pengambilan"           => $jumlahSisaPengambilan,
                                        "jumlah_hasil_selesai"              => $jumlahBeratHasil,
                                        "jumlah_hasil_payung"               => $jumlahPayungHasil,
                                        "jumlah_hasil_payung_kuning"        => $jumlahPayungKuningHasil,
                                        "jumlah_hasil_bobin"                => $jumlahBobinHasil,
                                        "jumlah_payung_terbuang"            => $jumlahPayungTerbuang,
                                        "jumlah_payung_kuning_terbuang"     => $jumlahPayungKuningTerbuang,
                                        "jumlah_bobin_terbuang"             => $jumlahBobinTerbuang,
                                        "jumlah_apal"                       => $jumlahApal)
                       );
          $result = $this->Cetak_Model->updateDetailJobCetak($data);
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

  public function getListBonApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal"   => $tglAwal,
                    "tglAkhir"  => $tglAkhir);
      $result = $this->Cetak_Model->selectBonApal($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printListBonApal($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $param1;
      $tglAkhir = $param2;
      $data = array("tglAwal"   => $tglAwal,
                    "tglAkhir"  => $tglAkhir);
      $result["Data"] = json_decode($this->Cetak_Model->selectBonApal($data), TRUE);
      $css = "assets/bootstrap/css/bootstrap.min.css";
      $page = $this->load->view("frm_print_bon_apal",$result,true);
      $this->load->library('m_pdf');
      $this->mpdf->mPDF("utf-8","A5-L",0,"",5,5,8,8,5,3);
      $this->mpdf->setFooter("Page ".'{PAGENO}');
      $this->mpdf->WriteHTML(file_get_contents($css),1);
      $this->mpdf->WriteHTML($page);
      $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListDataBonHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Cetak_Model->selectListDataBonHasil($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printListBonHasilCetak($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $param1;
      $tglAkhir = $param2;
      $data = array("tglAwal"   => $tglAwal,
                    "tglAkhir"  => $tglAkhir);
      $result["Data"] = json_decode($this->Cetak_Model->selectListDataBonHasil($data), TRUE);
      $css = "assets/bootstrap/css/bootstrap.min.css";
      $page = $this->load->view("frm_print_bon_hasil_cetak",$result,true);
      $this->load->library('m_pdf');
      $this->mpdf->mPDF("utf-8","A4-L",0,"",5,5,8,8,5,3);
      $this->mpdf->setFooter("Page ".'{PAGENO}');
      $this->mpdf->WriteHTML(file_get_contents($css),1);
      $this->mpdf->WriteHTML($page);
      $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKirimHasilCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $idUser = $this->session->userdata("fabricationIdUser");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = json_decode($this->Cetak_Model->selectListDataBonHasil($data), TRUE);
      $data2 = array("periode"=> $data,
                     "HasilCetak" => array(),
                     "PengambilanPolos" => array(),
                     "Apal" => array());
      foreach ($result as $value) {
        if($value["status_bon"] == "FALSE"){
          $hasilCetak = array("kd_gd_roll" => $value["kd_gd_roll_cetak"],
                              "id_user" => $idUser,
                              "jns_permintaan" => "CETAK",
                              "tgl_transaksi" => $value["tgl_transaksi"],
                              "bagian" => "CETAK",
                              "keterangan_transaksi" => "MASUK DARI CETAK",
                              "status_history" => "MASUK",
                              "status_transaksi" => "PROGRESS",
                              "keterangan_history" => "HASIL CETAK",
                              "berat" => $value["jumlah_selesai"],
                              "bobin" => $value["bobin"],
                              "payung" => $value["payung"],
                              "payung_kuning" => $value["payung_kuning"]);
          array_push($data2["HasilCetak"],$hasilCetak);

          $pengambilanPolos = array("kd_gd_roll" => $value["kd_gd_roll_polos"],
                                    "id_user" => $idUser,
                                    "jns_permintaan" => "POLOS",
                                    "tgl_transaksi" => $value["tgl_transaksi"],
                                    "bagian" => "CETAK",
                                    "keterangan_transaksi" => "KELUAR KE CETAK",
                                    "status_history" => "KELUAR",
                                    "status_transaksi" => "PROGRESS",
                                    "keterangan_history" => "OPERATOR CETAK",
                                    "berat" => $value["jumlah_berat_pengambilan"],
                                    "bobin" => $value["jumlah_bobin_pengambilan"],
                                    "payung" => $value["jumlah_payung_pengambilan"],
                                    "payung_kuning" => $value["jumlah_payung_kuning_pengambilan"]);
          array_push($data2["PengambilanPolos"],$pengambilanPolos);

          if(!empty($value["kd_gd_apal"]) && $value["jumlah_apal"] > 0){
            $apal = array("kd_gd_apal" => $value["kd_gd_apal"],
                          "id_user" => $idUser,
                          "nama" => "MANDOR CETAK",
                          "tgl_transaksi" => $value["tgl_transaksi"],
                          "merek" => $value["sub_jenis"],
                          "warna" => $value["sub_jenis"],
                          "bagian" => "CETAK",
                          "jumlah_apal" => $value["jumlah_apal"],
                          "sts_transaksi" => "PROGRESS",
                          "keterangan_history" => "KIRIMAN APAL",
                          "status_history" => "MASUK");
            array_push($data2["Apal"], $apal);
          }
        }else{
          $result = "Data Kosong";
        }
      }
      $result = $this->Cetak_Model->insertKirimHasilCetak($data2);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPenggunaanBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $jenis = $this->input->post("jenis");

      $data = array("tglAwal"   => $tglAwal,
                    "tglAkhir"  => $tglAkhir,
                    "jenis"     => str_replace("_"," ",$jenis));
      $result = $this->Cetak_Model->selectListPenggunaanBahan($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printListBonPengambilan($param1, $param2, $param3){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $param1;
      $tglAkhir = $param2;
      $jenis = str_replace("_"," ",$param3);
      $data = array("tglAwal"   => $tglAwal,
                    "tglAkhir"  => $tglAkhir,
                    "jenis"     => $jenis);
      $result["Data"] = json_decode($this->Cetak_Model->selectListPenggunaanBahan($data), TRUE);
      $result["jenis"] = $jenis;
      $css = "assets/bootstrap/css/bootstrap.min.css";
      $page = $this->load->view("frm_print_bon_pengambilan",$result,true);
      $this->load->library('m_pdf');
      $this->mpdf->mPDF("utf-8","A4-L",0,"",5,5,8,8,5,3);
      $this->mpdf->setFooter("Page ".'{PAGENO}');
      $this->mpdf->WriteHTML(file_get_contents($css),1);
      $this->mpdf->WriteHTML($page);
      $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKirimBonPengambilan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $jenis = str_replace("_"," ",$this->input->post("jenis"));
      $idUser = $this->session->userdata("fabricationIdUser");
      $param = array("tglAwal"   => $tglAwal,
                     "tglAkhir"  => $tglAkhir,
                     "jenis"     => $jenis);
      $result = json_decode($this->Cetak_Model->selectListPenggunaanBahan($param), TRUE);
      if(count($result) > 0){
        $data = array("Parameter" => $param,
                      "Data" => array());
        foreach ($result as $value) {
          if($value["status_bon"] == "FALSE"){
            $data2 = array("kd_gd_bahan"=>$value["kd_gd_bahan"],
                           "id_user" => $idUser,
                           "nama" => "MANDOR CETAK",
                           "jumlah_permintaan" => $value["jumlah_pengambilan"],
                           "tgl_permintaan" => $value["tgl_pengambilan"],
                           "bagian" => "CETAK",
                           "status" => "PROGRESS",
                           "status_history" => "KELUAR",
                           "keterangan_history" => "PEMAKAIAN CETAK");
            array_push($data["Data"], $data2);
          }
        }
        if(count($data["Data"]) > 0){
          $finalResult = $this->Cetak_Model->insertKirimBonPengambilan($data);
        }else{
          $finalResult = "Data Kosong";
        }
        echo $finalResult;
      }else{
        echo "Data Kosong";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPengembalianCatCampur(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");

      $data = array("tglAwal"   => $tglAwal,
                    "tglAkhir"  => $tglAkhir);
      $result = $this->Cetak_Model->selectListPengembalianCatCampur($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printListBonPengembalianCatCampur($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $param1;
      $tglAkhir = $param2;
      $data = array("tglAwal"   => $tglAwal,
                    "tglAkhir"  => $tglAkhir,
                    "jenis" => "Cat Campur");
      $result["Data"] = json_decode($this->Cetak_Model->selectListPengembalianCatCampur($data), TRUE);
      $result["jenis"] = $jenis;
      $css = "assets/bootstrap/css/bootstrap.min.css";
      $page = $this->load->view("frm_print_bon_pengembalian",$result,true);
      $this->load->library('m_pdf');
      $this->mpdf->mPDF("utf-8","A4-L",0,"",5,5,8,8,5,3);
      $this->mpdf->setFooter("Page ".'{PAGENO}');
      $this->mpdf->WriteHTML(file_get_contents($css),1);
      $this->mpdf->WriteHTML($page);
      $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKirimBonPengembalianCatCampur(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $idUser = $this->session->userdata("fabricationIdUser");
      $param = array("tglAwal"   => $tglAwal,
                     "tglAkhir"  => $tglAkhir);
      $result = json_decode($this->Cetak_Model->selectListPengembalianCatCampur($param), TRUE);
      if(count($result) > 0){
        $data = array("Parameter" => $param,
                      "Data" => array());
        foreach ($result as $value) {
          if($value["status_bon_sisa"] == "FALSE"){
            $data2 = array("kd_gd_bahan"=>$value["kd_gd_bahan"],
                           "id_user" => $idUser,
                           "nama" => "MANDOR CETAK",
                           "jumlah_permintaan" => $value["sisa_pengambilan"],
                           "tgl_permintaan" => $value["tgl_pengambilan"],
                           "bagian" => "CETAK",
                           "status" => "PROGRESS",
                           "status_history" => "MASUK",
                           "keterangan_history" => "SISA PEMAKAIAN CETAK");
            array_push($data["Data"], $data2);
          }
        }
        if(count($data["Data"]) > 0){
          $finalResult = $this->Cetak_Model->insertKirimBonPengembalian($data);
        }else{
          $finalResult = "Data Kosong";
        }
        echo $finalResult;
      }else{
        echo "Data Kosong";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListBarangDiambilPotong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->selectListBarangDiambilPotong();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getUkuranPengambilanCetak($param = ""){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglRencana = $param;
      $key = $this->input->get("q");
      $data = array("tglRencana" => $tglRencana,
                    "Key" => $key);
      $result = $this->Cetak_Model->selectUkuranPengambilanCetak($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function savePengambilanCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglRencana = $this->input->post("tglRencana");
      $berat = $this->input->post("berat");
      $bobin = $this->input->post("bobin");
      $payung = $this->input->post("payung");
      $payungKuning = $this->input->post("payungKuning");
      $shift = $this->input->post("shift");
      $kdCetak = $this->input->post("kdCetak");
      $kdGdRoll = $this->input->post("kdGdRoll");
      $idUser = $this->session->userdata("fabricationIdUser");

      if(empty($tglRencana) || $berat == "" || $bobin == "" || $payung == "" ||
         $payungKuning == "" || empty($shift) || empty($kdCetak) || empty($kdGdRoll) ||
         empty($idUser)
        ){
        echo "Data Kosong";
      }else{
        $data = array("TDPC" => array("kd_gd_roll"        => $kdGdRoll,
                                      "kd_cetak"          => $kdCetak,
                                      "id_user"           => $idUser,
                                      "tgl_rencana"       => $tglRencana,
                                      "tgl_pengambilan"   => date("Y-m-d"),
                                      "status"            => "MANDOR CETAK (EXTRUDER)",
                                      "berat"             => $berat,
                                      "bobin"             => $bobin,
                                      "payung"            => $payung,
                                      "payung_kuning"     => $payungKuning,
                                      "sts_transaksi"     => "PROGRESS",
                                      "shift"             => $shift),
                      "TGR"  => array("kd_gd_roll" => $kdGdRoll,
                                      "id_user" => $idUser,
                                      "jns_permintaan" => "POLOS",
                                      "tgl_transaksi" => $tglRencana,
                                      "bagian" => "CETAK",
                                      "keterangan_transaksi" => "KELUAR KE CETAK",
                                      "status_history" => "KELUAR",
                                      "status_transaksi" => "PROGRESS",
                                      "keterangan_history" => "MANDOR CETAK (EXTRUDER)",
                                      "berat" => $berat,
                                      "bobin" => $bobin,
                                      "payung" => $payung,
                                      "payung_kuning" => $payungKuning,
                                      "shift" => $shift,
                                      "keterangan_pengambilan" => $tglRencana)
                      );
        $result = $this->Cetak_Model->insertPengambilanCetakExtruder($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPengambilanExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cetak_Model->selectListPengambilanExtruder();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailPengambilanCetakExtruder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Cetak_Model->selectDetailPengambilanCetakExtruder($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editPengambilanCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglRencana = $this->input->post("tglRencana");
      $berat = $this->input->post("berat");
      $bobin = $this->input->post("bobin");
      $payung = $this->input->post("payung");
      $payungKuning = $this->input->post("payungKuning");
      $shift = $this->input->post("shift");
      $kdCetak = $this->input->post("kdCetak");
      $kdGdRoll = $this->input->post("kdGdRoll");
      $idTransaksi = $this->input->post("idTransaksi");
      $idUser = $this->session->userdata("fabricationIdUser");

      if(empty($tglRencana) || $berat == "" || $bobin == "" ||
         $payung == "" || $payungKuning == "" || empty($shift) ||
         empty($idTransaksi) || empty($idUser)
        ){
         echo "Data Kosong";
       }else{
         if(empty($kdGdRoll) || empty($kdCetak)){
           $data = array("TDPC" => array("id"             => $idTransaksi,
                                         "id_user"        => $idUser,
                                         "tgl_rencana"    => $tglRencana,
                                         "berat"          => $berat,
                                         "bobin"          => $bobin,
                                         "payung"         => $payung,
                                         "payung_kuning"  => $payungKuning,
                                         "shift"          => $shift),

                         "TGR" => array("id_user"         => $idUser,
                                        "berat"           => $berat,
                                        "bobin"           => $bobin,
                                        "payung"          => $payung,
                                        "payung_kuning"   => $payungKuning,
                                        "shift"           => $shift)
                        );
         }else{
           $data = array("TDPC" => array("id"             => $idTransaksi,
                                         "kd_cetak"       => $kdCetak,
                                         "kd_gd_roll"     => $kdGdRoll,
                                         "id_user"        => $idUser,
                                         "tgl_rencana"    => $tglRencana,
                                         "berat"          => $berat,
                                         "bobin"          => $bobin,
                                         "payung"         => $payung,
                                         "payung_kuning"  => $payungKuning,
                                         "shift"          => $shift),

                         "TGR" => array("id_user"         => $idUser,
                                        "kd_gd_roll"      => $kdGdRoll,
                                        "berat"           => $berat,
                                        "bobin"           => $bobin,
                                        "payung"          => $payung,
                                        "payung_kuning"   => $payungKuning,
                                        "shift"           => $shift)
                        );
         }
         $result = $this->Cetak_Model->updatePengambilanCetak($data);
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

  public function deleteAndRestorePengambilanCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      $data = array("TDPC" => array("id" => $idTransaksi,
                                    "deleted" => $deleted),
                    "TGR" => array("deleted" => $deleted));
                    $result = $this->Cetak_Model->updatePengambilanCetak($data);
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

  public function deleteAndRestorePenggunaanBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      $data = array("id_penggunaan_cetak" => $idTransaksi,
                    "deleted" => $deleted);
      $result = $this->Cetak_Model->updatePenggunaanBahanCetak($data);
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

  public function getPenggunaanBahanCetak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Cetak_Model->selectPenggunaanBahanCetak($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editPenggunaanBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $jumlahPenggunaan = $this->input->post("jumlahPenggunaan");
      $sisaPenggunaan = $this->input->post("sisaPenggunaan");

      if(empty($idTransaksi) || empty($kdGdBahan) || $jumlahPenggunaan=="" || $sisaPenggunaan==""){
        echo "Data Kosong";
      }else{
        $data = array("id_penggunaan_cetak" => $idTransaksi,
                      "kd_gd_bahan"         => $kdGdBahan,
                      "jumlah_pengambilan"  => $jumlahPenggunaan,
                      "sisa_pengambilan"    => $sisaPenggunaan);
        $result = $this->Cetak_Model->updatePenggunaanBahanCetak($data);
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

  public function getPengambilanGudangRoll(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result =$this->Cetak_Model->selectPengambilanGudangRoll($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printListBonPengambilanGudangRoll($param1, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $param1;
      $tglAkhir = $param2;
      $data = array("tglAwal"   => $tglAwal,
                    "tglAkhir"  => $tglAkhir);
      $result["Data"] = json_decode($this->Cetak_Model->selectPengambilanGudangRoll($data), TRUE);
      $this->load->view("frm_print_bon_pengambilan_gudang_roll",$result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editStatusRencanaPpic(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdPPIC = $this->input->post("kdPpic");
      $stsPengerjaan = $this->input->post("stsPengerjaan");
      if(empty($kdPPIC) || empty($stsPengerjaan)){
        echo "Data Kosong";
      }else{
        $data = array("kd_ppic" => $kdPPIC,
                      "sts_pengerjaan" => $stsPengerjaan);
        $result = $this->Cetak_Model->updateRencanaPPIC($data);
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
