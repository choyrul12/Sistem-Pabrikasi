<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
		parent::__construct();
		$this->load->model("Cabang_Model");
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
       ($this->session->userdata("fabricationGroup")=="cabang"||
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
          array("Content"=>"Approve Permintaan","Link"=>"_cabang/main/approve_permintaan","Name"=>"Approve_Permintaan","Status"=>"Single","Icon"=>"fa fa-check","Id"=>"M_Approve_Permintaan"),
          array("Content"=>"Pantau Order","Link"=>"_cabang/main/pantau_order","Name"=>"Order","Status"=>"Single","Icon"=>"fa fa-desktop","Id"=>""),
          array("Content"=>"History Order","Link"=>"_cabang/main/history_order","Name"=>"History","Parent"=>"History","Status"=>"Single","Icon"=>"fa fa-history","Id"=>""),
        );
        return $listMenu;
      }else if($status==2) {
        $listMenu["parentMenu"] = array(
          array("Content"=>"Orderan","Link"=>"_cabang/main/order_baru","Name"=>"Data_Customer","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
          array("Content"=>"Pantau Order","Link"=>"_cabang/main/pantau_order","Name"=>"Order","Status"=>"Single","Icon"=>"fa fa-desktop","Id"=>""),
          array("Content"=>"History Order","Link"=>"_cabang/main/history_order","Name"=>"History","Parent"=>"History","Status"=>"Single","Icon"=>"fa fa-history","Id"=>""),
        );
        return $listMenu;
      }else{

      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function approve_permintaan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"ORDER BARU ");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $data["NoOrder"] = $this->Cabang_Model->getMaxNoOrder();
      $data["NoPo"] = $this->Cabang_Model->getMaxNoPo();
      $data["DataCust"] = $this->Cabang_Model->getDefaultPemesan();
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_approve_permintaan",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function order_baru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"ORDER BARU ");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $data["NoOrder"] = $this->Cabang_Model->getMaxNoOrder();
      $data["NoPo"] = $this->Cabang_Model->getMaxNoPo();
      $data["DataCust"] = $this->Cabang_Model->getDefaultPemesan();
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_order",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pantau_order(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"PANTAU ORDER ");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_pantau_order",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function history_order(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"HISTORY ORDER ");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_cari_history",$data);
      $this->load->view("footer");
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
       $data = $this->Cabang_Model->selectGudangHasilLike($param);
     }else{
       $data = $this->Cabang_Model->selectGudangHasilLimit20();
     }
     echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGudangHasilDetailId(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kode = $this->input->post("kode");
      $data = $this->Cabang_Model->selectGudangHasilDetailId($kode);
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function savePesananDetaiTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("no_order");
      $kdCust = $this->input->post("kd_cust");
      $kdBarang = $this->input->post("kd_barang");
      $merek = $this->input->post("merek");
      $strip = $this->input->post("strip");
      $jenis = $this->input->post("jenis");
      $warnaCetak = $this->input->post("warna_cetak");
      $tebal = $this->input->post("tebal");
      $jumlah = $this->input->post("jumlah");
      $satuan = $this->input->post("satuan");
      $keterangan = $this->input->post("ket");

      if($noOrder==""||$kdBarang==""||
         $merek==""||$strip==""||$jenis==""||
         $warnaCetak==""||$tebal==""||$jumlah==""||
         $satuan==""){
           echo "Data Kosong";
         }else{
           if(substr($kdBarang,0,3) == "BHN"){
             $kode = "kd_gd_bahan";
           }else{
             $kode = "kd_gd_hasil";
           }
           $data = array("no_order"=>$noOrder,"kd_cust"=>$kdCust,
                         $kode=>$kdBarang,"merek"=>$merek,
                         "sm"=>$strip,"jenis"=>$jenis,
                         "warna_cetak"=>$warnaCetak,"dll"=>$tebal,
                         "jumlah"=>$jumlah,"satuan"=>$satuan,"keterangan"=>$keterangan,
                         "sts_pesanan"=>"WAITING");

          $result = $this->Cabang_Model->insertPesananDetailTemp($data);
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

  public function getDatatablesPesananTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("no_order");
      $kdCust = $this->input->post("kd_cust");
      $data = $this->Cabang_Model->selectPesananDetailsTempDatatables($noOrder,$kdCust);
      echo $data;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDatatablesPantauOrder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cabang_Model->selectPantauOrderDatatables();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDatatablesApproveOrder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cabang_Model->selectOrderApprove();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDatatablesDetailOrder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $result = $this->Cabang_Model->selectPesananDetailsDatatables($noOrder);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDatatablesDetailOrderTrash(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cabang_Model->selectPesananDetailsTrashDatatables();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDatatablesCariHistory(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $status = $this->input->post("status");
      if($tglAwal != "" && $tglAkhir != "" && $status != ""){
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "stsPesanan"=>$status);
        $result = $this->Cabang_Model->selectCariHistoryDatatables($data);
        echo $result;
      }else{
        echo "Data Kosong";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function removePesananDetailTempId(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDp = $this->input->post("id");
      $result = $this->Cabang_Model->deletePesananDetailTempId($idDp);
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

  public function savePesananFinal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $kdCust = $this->input->post("kdCust");
      $noPo = $this->input->post("noPo");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nmPemesan = $this->input->post("nmCust");
      $tglPesan = $this->input->post("tglPesan");
      $tglEstimasi = NULL;
      switch ($this->session->userdata("fabricationSubGroup")) {
        case 'jatinegara': $jnsOrder = "DK"; break;
        case 'ganefo': $jnsOrder = "DK"; break;
        case 'semarang' : $jnsOrder = "LK"; break;
        case 'brebes' : $jnsOrder = "LK"; break;
        case 'surabaya' : $jnsOrder = "LK"; break;
        case 'medan' : $jnsOrder = "LK"; break;
        case 'bandung' : $jnsOrder = "LK"; break;
        default:$jnsOrder = ""; break;
      }
      $stsPesanan = "WAITING";
      if($noOrder!=""||$kdCust!=""||$noPo!=""||$idUser!=""||
         $nmPemesan!=""||$tglPesan!=""||$jnsOrder!=""||$stsPesanan!=""){
        $data = array("no_order"=>$noOrder,"kd_cust"=>$kdCust,
                      "no_po"=>$noPo,"id_user"=>$idUser,
                      "nm_pemesan"=>$nmPemesan,"tgl_pesan"=>$tglPesan,
                      "tgl_estimasi"=>$tglEstimasi,"jns_order"=>$jnsOrder,
                      "sts_pesanan"=>$stsPesanan);
        $result = $this->Cabang_Model->insertPesananFinal($data);
        echo $result;
      }else{
        echo "Data Kosong";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function updatePesananPrintOut(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      if($noOrder != ""){
        $data = array("no_order"=>$noOrder,
                      "sts_print_cabang"=>"TRUE");
        $result = $this->Cabang_Model->updatePesanan($data);
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

  public function getCountPesananApprove(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cabang_Model->selectCountOrderApprove();
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountTrash(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Cabang_Model->selectCountTrash();
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPesananDetailId(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDp = $this->input->post("idDp");
      if($idDp != ""){
        $result = $this->Cabang_Model->selectPesananDetailId($idDp);
        echo $result;
      }else{
        echo "Data Kosong";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function modifyDetailOrder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDp = $this->input->post("idDp");
      $kdBarang = $this->input->post("kdBarang");
      $merek = $this->input->post("merek");
      $strip = $this->input->post("strip");
      $jenis = $this->input->post("jenis");
      $warnaCetak = $this->input->post("warnaCetak");
      $dll = $this->input->post("dll");
      $jumlah = $this->input->post("jumlah");
      $satuan = $this->input->post("satuan");
      $keterangan =$this->input->post("ket");

      if($idDp==""||$merek==""||$strip==""||$jenis==""||
         $warnaCetak==""||$dll==""||
         $jumlah==""||$satuan==""
       ){
         echo "Data Kosong";
       }else{
         if($kdBarang != ""){
           if(substr($kdBarang,0,3) == "BHN"){
             $data = array("kd_gd_bahan"=>$kdBarang,"merek"=>$merek,
                           "sm"=>$strip,"jenis"=>$jenis,
                           "warna_cetak"=>$warnaCetak,"dll"=>$dll,
                           "jumlah"=>$jumlah,"satuan"=>$satuan,
                           "keterangan"=>$keterangan,"id_dp"=>$idDp);
           }else{
             $data = array("kd_gd_hasil"=>$kdBarang,"merek"=>$merek,
                           "sm"=>$strip,"jenis"=>$jenis,
                           "warna_cetak"=>$warnaCetak,"dll"=>$dll,
                           "jumlah"=>$jumlah,"satuan"=>$satuan,
                           "keterangan"=>$keterangan,"id_dp"=>$idDp);
           }
         }else{
           $data = array("merek"=>$merek,
                         "sm"=>$strip,"jenis"=>$jenis,
                         "warna_cetak"=>$warnaCetak,"dll"=>$dll,
                         "jumlah"=>$jumlah,"satuan"=>$satuan,
                         "keterangan"=>$keterangan,"id_dp"=>$idDp);
         }
         $result = $this->Cabang_Model->updateDetailPesanan($data);
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

  public function deleteDetailOrder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $idDp = $this->input->post("idDp");
      $data = array("id_dp"=>$idDp,"deleted"=>"TRUE");
      $result = $this->Cabang_Model->updateDetailPesanan($data);
      if($result){
        $resultCount = $this->Cabang_Model->selectCountDetailOrderActive($noOrder);
        if($resultCount[0]["jumlah"] == 0){
          $data2 = array("no_order"=>$noOrder,"deleted"=>"TRUE");
          $result2 = $this->Cabang_Model->updatePesanan($data2);
          if($result2){
            echo "Berhasil";
          }else{
            echo "Gagal";
          }
        }else{
          echo "Berhasil";
        }
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function restoreDetailOrder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $idDp = $this->input->post("idDp");
      $data = array("id_dp"=>$idDp,"deleted"=>"FALSE");
      $result = $this->Cabang_Model->updateDetailPesanan($data);
      if($result){
        $resultCount = $this->Cabang_Model->selectCountDetailOrderDeactive($noOrder);
        if($resultCount[0]["jumlah"] == 0){
          $data2 = array("no_order"=>$noOrder,"deleted"=>"FALSE");
          $result2 = $this->Cabang_Model->updatePesanan($data2);
          if($result2){
            echo "Berhasil";
          }else{
            echo "Gagal";
          }
        }else{
          echo "Berhasil";
        }
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function modifyApproveOrder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $data = array("no_order"=>$noOrder,"approve_cabang"=>"TRUE","sts_pesanan"=>"OPEN");
      $result = $this->Cabang_Model->updateApproveOrder($data);
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

  public function cetakFaktur($param){
    $isLogin = $this->isLogin();
    if ($isLogin) {
      $arrDataPesanan = $this->Cabang_Model->selectFakturPesanan($param);
      $arrDataPesananDetail = $this->Cabang_Model->selectFakturPesananDetailProduksi($param);
      $this->fpdf->SetAutoPageBreak(false);
      $this->fpdf->AddPage("L","A5");
      $this->cetakFakturHeader($arrDataPesanan);
      $this->cetakFakturSidebar($arrDataPesanan);
      $this->cetakFakturTableHeaderProduksi($arrDataPesanan);
      $this->cetakFakturDataProduksi($arrDataPesananDetail);
      $this->cetakFakturFooterProduksi($arrDataPesanan);
      $this->fpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  private function cetakFakturHeader($param){
    $this->fpdf->SetFont('Arial','B',15);
    $this->fpdf->Ln(-3);
    $this->fpdf->Image(base_url()."assets/images/logo_plastik_black.png",5,5,13);
    $this->fpdf->Cell(8);
	  $this->fpdf->Cell(37,5,'KLIP PLASTIK',0,0,'L');
    $this->fpdf->SetFont('Arial','',10);
    $this->fpdf->Ln(-3);
    $this->fpdf->Cell(44);
    $this->fpdf->Cell(5,5,iconv("UTF-8", "ISO-8859-1", "®"),0,1,'C',0);
    $this->fpdf->Ln(-1);
    $this->fpdf->Cell(8);
    $this->fpdf->Ln(3);
    $this->fpdf->Cell(8);
    $this->fpdf->SetFont('Arial','B',6);
    $this->fpdf->Cell(70,4,'Jl. Yos Sudarso No.115 A, Batu Ceper - Tangerang',0,0,'L');
    $this->fpdf->Ln(3);
    $this->fpdf->Cell(8);
    $this->fpdf->Cell(70,4,'Telp.:5518899 (Hunting), 5404656, 5404657 Fax:5513905',0,0,'L');
    $this->fpdf->Ln(3);
    $this->fpdf->Cell(8);
    $this->fpdf->Cell(70,4,'Homepage : http://www.klipplastik.co.id',0,0,'L');
    $this->fpdf->Ln(3);
    $this->fpdf->Cell(8);
    $this->fpdf->Cell(70,4,'E-mail : sales@klipplastik.co.id',0,0,'L');
    $this->fpdf->Ln(-17);
    $this->fpdf->Cell(75);
    $this->fpdf->SetFont('Times','B',12);
    $this->fpdf->Cell(50,6,'SURAT - PESANAN',1,0,'C');
    $this->fpdf->Ln(-1);
    $this->fpdf->Cell(135);
    $this->fpdf->Cell(35,6,'KETERANGAN : ',1,0,'C');
    $this->fpdf->Ln();
    $this->fpdf->Cell(135);
    $this->fpdf->SetFont('Arial','',8);
    $this->fpdf->Cell(55,4,'Setiap order selalu ada toleransi ukuran',0,0,'L');
    $this->fpdf->Ln();
    $this->fpdf->Cell(135);
    $this->fpdf->Cell(55,4,'dan jumlah pesanan',0,0,'L');
    $this->fpdf->Ln();
    $this->fpdf->Cell(135);
    $this->fpdf->Cell(35,4,'PERLU/TIDAK ( PROOF ) : ',0 ,0,'L');
    $this->fpdf->Cell(25,4,$param[0]['proof'],'B' ,0,'L');
    $this->fpdf->Ln(-5);
    $this->fpdf->Cell(75);
    $this->fpdf->SetFont('Arial','',11);
    $this->fpdf->Cell(50,6,$param[0]['no_order']."  ".$param[0]['pajak']."  ".$param[0]['jns_order'],0,0,'C');
    $this->fpdf->SetLineWidth(0.4);
    $this->fpdf->Line(206,24,5,24);
  }

  private function cetakFakturTableHeaderProduksi($param){
    $this->fpdf->Ln(14);
    $this->fpdf->SetX(5);
    $this->fpdf->SetLineWidth(0.1);
    #$this->fpdf->Cell(201,20,'',"TLR",0,'L');
    $this->fpdf->SetFont('Times','B',9);
    $this->fpdf->SetY(26);
    $this->fpdf->SetX(5);
    $this->fpdf->Cell(28,5,'TANGGAL',0,0,'L');
    $this->fpdf->Cell(3,5,':',0,0,'L');
    $this->fpdf->SetFont('Times','',10);
    $this->fpdf->Cell(28,5,$param[0]['tgl_pesan'],"B",0,'L');
    $this->fpdf->SetY(26);
    $this->fpdf->SetX(105);
    $this->fpdf->SetFont('Times','B',10);
    $this->fpdf->Cell(15,5,'No. PO.',0,0,'L');
    $this->fpdf->Cell(2,5,':',0,0,'L');
    $this->fpdf->SetFont('Times','',10);
    $this->fpdf->Cell(38,5,$param[0]['no_po'],'B',0,'L');
    $this->fpdf->Ln();
    $this->fpdf->SetY(31);
    $this->fpdf->SetX(5);
    $this->fpdf->SetFont('Times','B',9);
    $this->fpdf->Cell(28,5,'NAMA PEMESAN',0,0,'L');
    $this->fpdf->Cell(2,5,':',0,0,'L');
    $this->fpdf->SetFont('Times','',10);
    $this->fpdf->Cell(28,5,$param[0]['nm_perusahaan'],'B',0,'L');
    $this->fpdf->SetY(31);
    $this->fpdf->SetX(105);
    $this->fpdf->Cell(15,5,'No. Telp.',0,0,'L');
    $this->fpdf->Cell(2,5,':',0,0,'L');
    $this->fpdf->SetFont('Times','',10);
    $this->fpdf->Cell(28,5,$param[0]['tlp_kantor'],'B',0,'L');
    $this->fpdf->Line(35,36,100,36);
    $this->fpdf->Ln();
    $this->fpdf->SetY(36);
    $this->fpdf->SetX(5);
    $this->fpdf->SetFont('Times','B',9);
    $this->fpdf->Cell(28,5,'ALAMAT',0,0,'L');
    $this->fpdf->Cell(2,5,':',0,0,'L');
    $this->fpdf->SetFont('Times','',10);
    $this->fpdf->MultiCell(115,5,str_replace("<p>","",str_replace("</p>","",$param[0]['alamat'])),"B","L");
  }

  private function cetakFakturDataProduksi($param){
    $this->fpdf->SetX(5);
    $this->fpdf->SetY(45);
    $this->fpdf->SetX(5);
    $this->fpdf->SetFont('Times','',8);
    $this->fpdf->Cell(19,8,'BANYAKNYA','TBL',0,'C');
    $this->fpdf->Cell(20,5,'UKURAN (cm)','TLB',0,'C');
    $this->fpdf->Cell(41,8,'MERK','TLB',0,'C');
    $this->fpdf->Cell(25,8,'NAMA PRODUK','TLB',0,'C');
    $this->fpdf->Cell(25,5,'WARNA','TLB',0,'C');
    $this->fpdf->Cell(25,5,'ATAS KLIP','TLRB',0,'C');
    $this->fpdf->Ln();
    $this->fpdf->SetX(24);
    $this->fpdf->Cell(10,3,'P','BL',0,'C');
    $this->fpdf->Cell(10,3,'L','BL',0,'C');
    $this->fpdf->SetX(110);
    $this->fpdf->Cell(12.5,3,'PLASTIK','BL',0,'C');
    $this->fpdf->Cell(12.5,3,'CETAK','BL',0,'C');
    $this->fpdf->Cell(10,3,'SM','BL',0,'C');
    $this->fpdf->Cell(15,3,'DLL','BLR',0,'C');
    $this->fpdf->Ln();
    $this->fpdf->SetWidths(array(19,10,10,41,25,12.5,12.5,10,15));
    $this->fpdf->SetAligns(array('L','C','C','L','L','L','L','C','C','C'));
    for($i=0;$i<count($param);$i++){
      $this->fpdf->setX(5);
      $this->fpdf->Row(array_values($param[$i]));
    }
  }

  private function cetakFakturSidebar($param){
    $this->fpdf->SetFont('Times','',9);
    $this->fpdf->SetY(25);
    $this->fpdf->SetX(165);
    $this->fpdf->Cell(16,5,"Ekspedisi : ",0,0,"L");
    $this->fpdf->Ln();
    $this->fpdf->SetX(165);
    $this->fpdf->MultiCell(38,3,$param[0]['expedisi'],0,"L");
    if(empty($param[0]['foto_1'])){
      $foto = "sample.png";
    }else{
      $foto = "upload/".$param[0]['foto_1'];
    }
    $this->fpdf->Image(base_url()."assets/images/".$foto,180,55,25,"","",base_url()."assets/images/".$foto);
    $this->fpdf->RoundedRect(163, 25, 42, 115, 5, '1234', 'D');
  }

  private function cetakFakturFooterProduksi($param){
    $this->fpdf->SetFont('Times','',9);
    $this->fpdf->SetY(105);
    #$this->fpdf->Cell(19,5,'Uang Muka : ',0,0,'L');
    #$this->fpdf->Cell(35,5,$param[0]['mata_uang']." ".$param[0]['dp'],'B',0,'L');
    $this->fpdf->Ln();
    $this->fpdf->SetX(10);
    $this->fpdf->Cell(66,5,'( Uang muka tidak dapat dikembalikan apabila',0,0,'L');
    $this->fpdf->Ln();
    $this->fpdf->SetX(10);
    $this->fpdf->Cell(66,5,'Order dibatalkan oleh Pemesan )',0,0,'L');
    $this->fpdf->SetY(105);
    $this->fpdf->SetX(85);
    $this->fpdf->Cell(27,5,'Tgl. Penyerahan     : ',0,0,'L');
    $this->fpdf->Cell(46,5,$param[0]['tgl_estimasi'],'B',0,'L');
    $this->fpdf->Ln(8);
    $this->fpdf->SetX(85);
    $this->fpdf->Cell(27,5,'Syarat Pembayaran : ',0,0,'L');
    $this->fpdf->Cell(46,5,$param[0]['payment_method'],'B',0,'L');
    $this->fpdf->SetLineWidth(0.2);
    $this->fpdf->RoundedRect(5, 120, 153, 20, 5, '1234', 'D');
    $this->fpdf->SetY(-15);
    $this->fpdf->SetX(7);
    $this->fpdf->Line(7,133,77,133);
    $this->fpdf->Cell(70,4,$param[0]['nm_pemesan'],0,0,'C');
    $this->fpdf->Cell(5);
    $this->fpdf->Line(82,133,152,133);
    $this->fpdf->Cell(70,4,'Salesman ( '.$param[0]["username"]." )",0,0,'C');
    $this->fpdf->SetY(-7);
    $this->fpdf->SetX(7);
    $this->fpdf->Cell(100,4,'Uang muka harap ditulis jika ditanggung sepenuhnya oleh pemesan',0,0,'L');
    $this->fpdf->SetY(85);
    $this->fpdf->SetX(162);
    $this->fpdf->Cell(10,5,"Note : ",0,0,"L");
    $this->fpdf->Ln();
    $this->fpdf->SetX(162);
    $this->fpdf->WriteHTML($param[0]['note']);
  }
}
?>
