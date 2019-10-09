<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
		parent::__construct();
		$this->load->model("Pengiriman_Model");
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
       ($this->session->userdata("fabricationGroup")=="pengiriman"||
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
          array("Content"=>"Order","Link"=>"#","Name"=>"Order","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Order"),
          array("Content"=>"Pantau Order","Link"=>"#","Name"=>"PantauOrder","Status"=>"Parent","Icon"=>"fa fa-desktop","Id"=>"M_PantauOrder"),
          array("Content"=>"Input Order Cabang","Link"=>"_pengiriman/main/input_order_cabang","Name"=>"InputOrderCabang","Parent"=>"InputOrderCabang","Status"=>"Single","Icon"=>"fa fa-edit","Id"=>"M_InputOrderCabang"),
          array("Content"=>"Order Baru Cabang","Link"=>"_pengiriman/main/order_baru_cabang","Name"=>"OrderBaruCabang","Parent"=>"OrderBaruCabang","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_OrderBaruCabang"),
          array("Content"=>"History Order Cabang","Link"=>"_pengiriman/main/history_order_cabang","Name"=>"HistoryOrderCabang","Parent"=>"HistoryOrderCabang","Status"=>"Single","Icon"=>"fa fa-history","Id"=>"MI_HistoryOrderCabang"),
        );
        $listMenu["childMenu"] = array(
          array("Content" => "Order Cabang", "Link"=>"_pengiriman/main/order_cabang", "Parent"=>"Order", "Id"=>"MI_OrderCabang"),
          array("Content" => "Order Marketing Dalam Kota", "Link"=>"_pengiriman/main/order_marketing_dalam_kota", "Parent"=>"Order", "Id"=>"MI_OrderMarketingDalamKota"),
          array("Content" => "Order Marketing Luar Kota", "Link"=>"_pengiriman/main/order_marketing_luar_kota", "Parent"=>"Order", "Id"=>"MI_OrderMarketingLuarKota"),

          array("Content" => "Pantau Order Cabang", "Link"=>"_pengiriman/main/pantau_order_cabang", "Parent"=>"PantauOrder", "Id"=>"MI_PantauOrderCabang"),
          array("Content" => "Pantau Order Marketing", "Link"=>"_pengiriman/main/pantau_order_marketing", "Parent"=>"PantauOrder", "Id"=>"MI_PantauOrderMarketing"),
          array("Content" => "Pantau Order Cabang (Global)", "Link"=>"_pengiriman/main/pantau_order_cabang_global", "Parent"=>"PantauOrder", "Id"=>"MI_PantauOrderCabangGlobal"),
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

  public function order_cabang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Order Cabang");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_order_cabang",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function order_marketing_dalam_kota(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Order Marketing Dalam Kota");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_order_marketing_dalam_kota",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function order_marketing_luar_kota(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Order Marketing Luar Kota");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_order_marketing_luar_kota",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pantau_order_cabang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pantau Order Cabang");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_pantau_order_cabang",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pantau_order_marketing(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pantau Order Marketing");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_pantau_order_marketing",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pantau_order_cabang_global(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pantau Order Cabang Global");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_pantau_order_cabang_global",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function input_order_cabang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Input Order Cabang");
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

  public function order_baru_cabang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Order Baru Cabang");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_order_baru_cabang",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function history_order_cabang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"History Order Cabang");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_history_order_cabang",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListDataOrderCabangSiapDikirim(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Pengiriman_Model->selectListDataOrderCabangSiapDikirim();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListDataOrderMarketingSiapDikirim(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsOrder = $this->input->post("jnsOrder");
      $result = $this->Pengiriman_Model->selectListDataOrderMarketingSiapDikirim($jnsOrder);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListOrderBaruCabang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Pengiriman_Model->selectListOrderBaruCabang();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPantauOrderCabangGlobal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Pengiriman_Model->selectListPantauOrderCabangGlobal();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListDetailPesanan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $result = $this->Pengiriman_Model->selectListDetailPesanan($noOrder);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailPesanan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDetail = $this->input->post("idDetail");
      $result = $this->Pengiriman_Model->selectDetailPesanan($idDetail);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueHasil(){
   $isLogin = $this->isLogin();
   if($isLogin){
     $param = $this->input->get("q");
     if (!empty($param)) {
       $data = $this->Pengiriman_Model->selectGudangHasilLike($param);
     }else{
       $data = $this->Pengiriman_Model->selectGudangHasilLimit20();
     }
     echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editPesananDetail(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $kdBarang = $this->input->post("kdBarang");
      $warnaCetak = $this->input->post("warnaCetak");
      $warnaStrip = $this->input->post("warnaStrip");
      $jenis = $this->input->post("jenis");
      $tebal = $this->input->post("tebal");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $satuan = $this->input->post("satuan");
      $keterangan = $this->input->post("keterangan");
      if(empty($idTransaksi)||empty($warnaCetak)||empty($warnaStrip)||
         empty($jenis)||empty($tebal)||empty($jumlahPermintaan)||
         empty($satuan)
       ){
         echo "Data Kosong";
       }else{
         if(empty($kdBarang)){
           $data = array("id_dp" => $idTransaksi,
                         "warna_cetak" => $warnaCetak,
                         "sm" => $warnaStrip,
                         "jenis" => $jenis,
                         "dll" => $tebal,
                         "jumlah" => $jumlahPermintaan,
                         "satuan" => $satuan,
                         "keterangan" => $keterangan);
         }else{
           if(strpos($kdBarang,"BHN") === FALSE){
             $data = array("id_dp" => $idTransaksi,
                           "kd_gd_hasil" => $kdBarang,
                           "kd_gd_bahan" => NULL,
                           "warna_cetak" => $warnaCetak,
                           "sm" => $warnaStrip,
                           "jenis" => $jenis,
                           "dll" => $tebal,
                           "jumlah" => $jumlahPermintaan,
                           "satuan" => $satuan,
                           "keterangan" => $keterangan);
           }else{
             $data = array("id_dp" => $idTransaksi,
                           "kd_gd_bahan" => $kdBarang,
                           "kd_gd_hasil" => NULL,
                           "warna_cetak" => $warnaCetak,
                           "sm" => $warnaStrip,
                           "jenis" => $jenis,
                           "dll" => $tebal,
                           "jumlah" => $jumlahPermintaan,
                           "satuan" => $satuan,
                           "keterangan" => $keterangan);
           }
         }
         $result = $this->Pengiriman_Model->updatePesananDetail($data);
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

  function deleteAndRestoreDetailPesanan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $idDp = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");

      if(empty($noOrder) || empty($idDp) || empty($deleted)){
        echo "Data Kosong";
      }else{
        $data = array("no_order" => $noOrder,
                      "id_dp" => $idDp,
                      "deleted" => $deleted);
        $result = $this->Pengiriman_Model->updateDeleteAndRestorePesanan($data);
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

  public function saveApproveOrder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $result = $this->Pengiriman_Model->saveApproveOrder($noOrder);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKirimPesananFull(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDp = $this->input->post("idDp");
      $noOrder = $this->input->post("noOrder");
      if(empty($idDp) || empty($noOrder)){
        echo "Data Kosong";
      }else{
        $data = array("id_dp" => $idDp,
                      "no_order" => $noOrder,
                      "sts_kirim" => "TERKIRIM",
                      "sts_pesanan" => "FINISH",
                      "tgl_kirim" => date("Y-m-d H:i:s"));
        $result = $this->Pengiriman_Model->updateKirimPesanan($data);
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

  public function saveKirimPesananFullBatch(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrIdDp = array_column($this->input->post("arrIdDp"),"value");
      $arrData = array();
      if(count($arrIdDp) <= 0){
        echo "Item Kosong";
      }else{
        for ($i=0; $i < count($arrIdDp); $i++) {
          $arrTempId = explode("#",$arrIdDp[$i]);
          $tempData = array("id_dp" => $arrTempId[0],
                            "no_order" => $arrTempId[1],
                            "sts_kirim" => "TERKIRIM",
                            "sts_pesanan" => "FINISH",
                            "tgl_kirim" => date("Y-m-d H:i:s"));
          array_push($arrData, $tempData);
        }
        $result = $this->Pengiriman_Model->updateKirimPesananFullBatch($arrData);
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

  public function getListPantauOrderCabang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Pengiriman_Model->selectListPantauOrderCabang();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPantauOrderMarketing(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Pengiriman_Model->selectListPantauOrderMarketing();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printOrderSheet($noOrder){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Pengiriman_Model->selectPesananForPrintOrder($noOrder);
      $css = "assets/bootstrap/css/bootstrap.min.css";
      $page = $this->load->view("frm_print_order",$result,true);
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

  public function getListHistoryOrderCabangGlobal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir);
      $result = $this->Pengiriman_Model->selectListHistoryOrderCabangGlobal($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountOrderBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Pengiriman_Model->selectCountOrderBaruCabang();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKirimPesananSetengah(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDp = $this->input->post("idDp");
      $noOrder = $this->input->post("noOrder");
      if(empty($idDp) || empty($noOrder)){
        echo "Data Kosong";
      }else{
        $data = array("id_dp" => $idDp,
                      "no_order" => $noOrder,
                      "sts_kirim" => "TERKIRIM SETENGAH",
                      "tgl_kirim" => date("Y-m-d H:i:s"));
        $result = $this->Pengiriman_Model->updateKirimPesanan($data);
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
