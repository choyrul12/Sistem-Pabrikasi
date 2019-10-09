<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
		parent::__construct();
		$this->load->model("Gudang_Bahan_Model");
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
          array("Content"=>"Stok Bahan Baku","Link"=>"_gudangbahan/main/stok_bahan_baku","Name"=>"Stok_Bahan_Baku","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Stok_Bahan_Baku"),
          array("Content"=>"Stok Biji Warna","Link"=>"_gudangbahan/main/stok_biji_warna","Name"=>"Stok_Biji_Warna","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Stok_Biji_Warna"),
          array("Content"=>"Stok Minyak","Link"=>"_gudangbahan/main/stok_minyak","Name"=>"Stok_Minyak","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Stok_Minyak"),
          array("Content"=>"Stok Cat Campur","Link"=>"_gudangbahan/main/stok_cat_campur","Name"=>"Stok_Cat_Campur","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Stok_Cat_Campur"),
          // array("Content"=>"Stok Cat Murni","Link"=>"_gudangbahan/main/stok_cat_murni","Name"=>"Stok_Cat_Murni","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Stok_Cat_Murni"),
          array("Content"=>"Stok Apal","Link"=>"_gudangbahan/main/stok_apal","Name"=>"Stok_Apal","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Stok_Apal"),
          array("Content"=>"Spare Part","Link"=>"_gudangbahan/main/spare_part","Name"=>"Spare_Part","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Spare_Part"),
          array("Content"=>"Permintaan Barang","Link"=>"_gudangbahan/main/permintaan_barang","Name"=>"Permintaan_Barang","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Permintaan_Barang")
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

  public function stok_bahan_baku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Stok Bahan Baku");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_bahan_baku",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_biji_warna(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Stok Biji Warna");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_biji_warna",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_minyak(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Stok Minyak");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_minyak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_cat_campur(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Stok Cat Campur");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_cat_campur",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_cat_murni(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Stok Cat Murni");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_cat_murni",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_apal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Stok Apal");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_apal",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function spare_part(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Spare Part");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_spare_part",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function permintaan_barang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Permintaan Barang");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_permintaan_barang",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGeneratedGudangBahanCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result["Code"] = $this->Gudang_Bahan_Model->generateGudangBahanCode();
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGeneratedGudangApalCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result["Code"] = $this->Gudang_Bahan_Model->generateGudangApalCode();
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGeneratedGudangSparePartCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result["Code"] = $this->Gudang_Bahan_Model->generateGudangSparePartCode();
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueBahan($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $query = $this->input->get("q");
      if (!empty($query)) {
        $data = array("jenis"=>str_replace("_"," ",$param),
        "key"=>$query);
        $result = $this->Gudang_Bahan_Model->selectComboBoxValueBahanSearch($data);
      }else{
        $data = array("jenis"=>str_replace("_"," ",$param),
        "key"=>"");
        $result = $this->Gudang_Bahan_Model->selectComboBoxValueBahan($data);
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = $this->input->get("q");
      if(!empty($param)){
        $result = $this->Gudang_Bahan_Model->selectComboBoxValueApalSearch($param);
      }else{
        $result = $this->Gudang_Bahan_Model->selectComboBoxValueApal();
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = $this->input->get("q");
      if(!empty($param)){
        $result = $this->Gudang_Bahan_Model->selectComboBoxValueSparePartSearch($param);
      }else{
        $result = $this->Gudang_Bahan_Model->selectComboBoxValueSparePart();
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountTrashGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectCountTrashGudangBahan("TRUE");
      $result2 = $this->Gudang_Bahan_Model->selectCountTrashGudangSparePart("TRUE");
      $result3 = $this->Gudang_Bahan_Model->selectCountTrashTransaksiGudangBahan("TRUE");
      $result4 = $this->Gudang_Bahan_Model->selectCountTrashTransaksiGudangApal("TRUE");
      $result5 = $this->Gudang_Bahan_Model->selectCountTrashTransaksiGudangSparePart("TRUE");
      $data = array("Total"=>$result[0]["jumlah"]+
                             $result2[0]["jumlah"]+
                             $result3[0]["jumlah"]+
                             $result4[0]["jumlah"]+
                             $result5[0]["jumlah"]);
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListTrashGudangBahanDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectListTrashGudangBahanDatatable();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListTrashSparePartDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectListTrashSparePartDatatable();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListTrashTransaksiGudangBahanDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectListTrashTransaksiGudangBahanDatatable();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailBarangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGudangBahan = $this->input->post("kd_gd_bahan");
      $result = $this->Gudang_Bahan_Model->selectDetailBarangBahan($kdGudangBahan);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListGudangBahanDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = str_replace("_"," ",$this->input->post("jenis"));
      $result = $this->Gudang_Bahan_Model->selectListGudangBahanDatatable($param);
      echo $result;
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
      $kdGudangBahan = $this->input->post("kdGdBahan");
      if(empty($tglAwal) || empty($tglAkhir) || empty($kdGudangBahan)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdGdBahan"=>$kdGudangBahan);
        $result = $this->Gudang_Bahan_Model->selectListHistoryGudangBahan($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getSaldoAwalBulanGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGudangBahan = $this->input->post("kdGdBahan");
      if(empty($tglAwal) || empty($tglAkhir) || empty($kdGudangBahan)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdGdBahan"=>$kdGudangBahan);
        $result = $this->Gudang_Bahan_Model->selectSaldoAwalBulanGudangBahan($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $kdAccurate = $this->input->post("kdAccurate");
      $nmBarang = $this->input->post("nmBarang");
      $stok = $this->input->post("stok");
      $satuan = $this->input->post("satuan");
      $warna = $this->input->post("warna");
      $tglMasuk = $this->input->post("tglMasuk");
      $status = $this->input->post("status");
      $jenis = $this->input->post("jenis");
      $nama = "GUDANG BAHAN";
      $bagian = strtoupper($this->session->userdata("fabricationGroup"));
      $statusHistory = "MASUK";
      $statusTransaksi = "FINISH";
      $keteranganHistory = "DATA AWAL";

      if(empty($kdGdBahan)||empty($idUser)||empty($nmBarang)||$stok == ""||
         empty($satuan)||empty($tglMasuk)||empty($status)||empty($jenis)
       ){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_bahan"=>$kdGdBahan,
                      "id_user"=>$idUser,
                      "kd_accurate"=>$kdAccurate,
                      "nm_barang"=>$nmBarang,
                      "stok"=>$stok,
                      "satuan"=>$satuan,
                      "warna"=>$warna,
                      "tgl_masuk"=>$tglMasuk,
                      "status"=>$status,
                      "jenis"=>$jenis,
                      "nama"=>$nama,
                      "bagian"=>$bagian,
                      "statusTransaksi"=>$statusTransaksi,
                      "statusHistory"=>$statusHistory,
                      "keteranganHistory"=>$keteranganHistory);
        $result = $this->Gudang_Bahan_Model->insertGudangBahan($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $kdAccurate = $this->input->post("kdAccurate");
      $nmBarang = $this->input->post("nmBarang");
      $stok = $this->input->post("stok");
      $satuan = $this->input->post("satuan");
      $warna = $this->input->post("warna");
      $tglMasuk = $this->input->post("tglMasuk");
      $status = $this->input->post("status");
      if(empty($kdGdBahan)||empty($idUser)||empty($nmBarang)||
         empty($satuan)||empty($tglMasuk)||empty($status)
       ){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_bahan"=>$kdGdBahan,
                      "id_user"=>$idUser,
                      "kd_accurate"=>$kdAccurate,
                      "nm_barang"=>$nmBarang,
                      "satuan"=>$satuan,
                      "warna"=>$warna,
                      "tgl_masuk"=>$tglMasuk,
                      "status"=>$status);
        $result = $this->Gudang_Bahan_Model->updateGudangBahan($data);
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

  public function deleteGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = $this->input->post("kdGdBahan");
      $data = array("kd_gd_bahan"=>$param,
                    "deleted"=>"TRUE");
      $result = $this->Gudang_Bahan_Model->updateGudangBahan($data);
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

  public function deleteTransaksiGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = $this->input->post("id");
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = date("Y-m-d");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $data = array("id"=>$param,
                    "deleted"=>"TRUE");
      $result = $this->Gudang_Bahan_Model->updateTransaksiGudangBahan($data);
      if($result){
        $data2 = array("kdGdBahan"=>$kdGdBahan,
                       "tglAwal"=>$tglAwal,
                       "tglAkhir"=>$tglAkhir);
        $saldo = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanGudangBahan($data2),TRUE);
        $result2 = $this->Gudang_Bahan_Model->updateGudangBahan(array("kd_gd_bahan"=>$kdGdBahan,"stok"=>str_replace(",","",$saldo["saldoAkhir"])));
        if($result2){
          echo "Berhasil";
        }else{
          echo "Gagal";
        }
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function restoreGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = $this->input->post("kdGdBahan");
      $data = array("kd_gd_bahan"=>$param,
                    "deleted"=>"FALSE");
      $result = $this->Gudang_Bahan_Model->updateGudangBahan($data);
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

  public function restoreSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = $this->input->post("kdSparePart");
      $data = array("kd_spare_part"=>$param,
                    "deleted"=>"FALSE");
      $result = $this->Gudang_Bahan_Model->updateSparePart($data);
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

  public function restoreTransaksiGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $tglAwal = date("Y-m-d",strtotime("-1 days"));
      $tglAkhir = date("Y-m-d");
      $data = array("id" => $idTransaksi,
                    "deleted" => "FALSE");
      $result = $this->Gudang_Bahan_Model->updateTransaksiGudangBahan($data);
      if($result){
        $data2 = array("kdGdBahan"=>$kdGdBahan,
                       "tglAwal"=>$tglAwal,
                       "tglAkhir"=>$tglAkhir);
        $saldo = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanGudangBahan($data2),TRUE);
        $result2 = $this->Gudang_Bahan_Model->updateGudangBahan(array("kd_gd_bahan"=>$kdGdBahan,"stok"=>str_replace(",","",$saldo["saldoAkhir"])));
        if($result2){
          echo "Berhasil";
        }else{
          echo "Gagal";
        }
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function addPembelianGudangBahanTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tanggal = $this->input->post("tanggal");
      $namaBahan = $this->input->post("namaBahan");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $bagian = strtoupper($this->session->userdata("fabricationGroup"));
      $kdPermintaan = $this->input->post("kdPermintaan");
      $keterangan = $this->input->post("keterangan");
      $jenis = $this->input->post("jenis");
      $specialChar = array('(',')');
      if(empty($kdGdBahan)||empty($idUser)||empty($tanggal)||
         empty($jumlahPermintaan||empty($kdPermintaan))
        ){
        echo "Data Kosong";
      }else{
        $data = array("id"                  => $kdGdBahan,
                      "qty"                 => $jumlahPermintaan,
                      "price"               => $jumlahPermintaan,
                      "name"                => str_replace($specialChar,'',$namaBahan),
                      "namaBarang"          => str_replace($specialChar,'',$namaBahan),
                      "kd_permintaan"       => $kdPermintaan,
                      "kd_gd_bahan"         => $kdGdBahan,
                      "id_user"             => $idUser,
                      "bagian"              => $bagian,
                      "tgl_permintaan"      => $tanggal,
                      "jumlah_permintaan"   => $jumlahPermintaan,
                      "keterangan"          => $keterangan,
                      "prefix"              => "PEMBELIAN ".$jenis." IDUSER=".$idUser);
        $result = $this->cart->insert($data);
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

  public function addPembelianSparePartTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdSparePart");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tanggal = $this->input->post("tanggal");
      $namaBahan = $this->input->post("namaSparePart");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $bagian = strtoupper($this->session->userdata("fabricationGroup"));
      $kdPermintaan = $this->input->post("kdPermintaan");
      $keterangan = $this->input->post("keterangan");
      $jenis = "SPARE PART";
      $specialChar = array('(',')');
      if(empty($kdGdBahan)||empty($idUser)||empty($tanggal)||
         empty($jumlahPermintaan||empty($kdPermintaan))
        ){
        echo "Data Kosong";
      }else{
        $data = array("id"                        => $kdGdBahan,
                      "qty"                       => $jumlahPermintaan,
                      "price"                     => $jumlahPermintaan,
                      "name"                      => str_replace($specialChar,'',$namaBahan),
                      "namaBarang"                => str_replace($specialChar,'',$namaBahan),
                      "kd_permintaan_spare_part"  => $kdPermintaan,
                      "kd_spare_part"             => $kdGdBahan,
                      "id_user"                   => $idUser,
                      "bagian"                    => $bagian,
                      "tgl_permintaan"            => $tanggal,
                      "jumlah_permintaan"         => $jumlahPermintaan,
                      "keterangan"                => $keterangan,
                      "prefix"                    => "PEMBELIAN ".$jenis." IDUSER=".$idUser);
        $result = $this->cart->insert($data);
        if($result){
          echo "Berhasil";
        }else{
          echo "Gagal";
        }
        // print_r($data);
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function removePembelianTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $rowId = $this->input->post("rowId");
      $result = $this->cart->remove($rowId);
      if($result){
        if($this->cart->total_items() == 0){
          $this->cart->destroy();
        }
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPembelianGudangBahanTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = $this->input->post("jenis");
      $idUser = $this->session->userdata("fabricationIdUser");
      $data=array();
      foreach ($this->cart->contents() as $key) {
        if($key["prefix"] == "PEMBELIAN ".$jenis." IDUSER=".$idUser){
          array_push($data,$key);
        }
      }
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPembelianSparePartTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = "SPARE PART";
      $idUser = $this->session->userdata("fabricationIdUser");
      $data=array();
      foreach ($this->cart->contents() as $key) {
        if($key["prefix"] == "PEMBELIAN ".$jenis." IDUSER=".$idUser){
          array_push($data,$key);
        }
      }
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailItemPembelianGudangBahanTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $rowId = $this->input->post("rowId");
      $result = $this->cart->get_item($rowId);
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editPembelianGudangBahanTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $kdPermintaan = $this->input->post("kdPermintaan");
      $keterangan = $this->input->post("keterangan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tanggal = $this->input->post("tanggal");
      // $nama = $this->input->post("nama");
      $namaBahan = $this->input->post("namaBahan");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $bagian = strtoupper($this->session->userdata("fabricationGroup"));
      $rowId = $this->input->post("rowId");
      $specialChar = array('(',')');
      if(empty($idUser)||empty($tanggal)||empty($jumlahPermintaan)){
        echo "Data Kosong";
      }else{
        if(empty($kdGdBahan)){
          $data = array("qty"=>$jumlahPermintaan,
                        "rowid"=>$rowId,
                        "price"=>$jumlahPermintaan,
                        "name"=>str_replace($specialChar,'',$namaBahan),
                        "id_user" => $idUser,
                        "jumlah_permintaan" => $jumlahPermintaan,
                        "bagian" => $bagian,
                        "keterangan" => $keterangan,
                        "tgl_permintaan" => $tanggal);
        }else{
          $data = array("id"=>$kdGdBahan,
                        "rowid"=>$rowId,
                        "qty"=>$jumlahPermintaan,
                        "price"=>$jumlahPermintaan,
                        "name"=>str_replace($specialChar,'',$namaBahan),
                        "namaBarang"=>str_replace($specialChar,'',$namaBahan),
                        "kd_gd_bahan"=>$kdGdBahan,
                        "id_user" => $idUser,
                        "nama" => $nama,
                        "jumlah_permintaan" => $jumlahPermintaan,
                        "bagian" => $bagian,
                        "keterangan" => $keterangan,
                        "tgl_permintaan" => $tanggal);
        }
        $result = $this->cart->update($data);
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

  public function editPembelianSparePartTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdSparePart");
      $kdPermintaan = $this->input->post("kdPermintaan");
      $keterangan = $this->input->post("keterangan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tanggal = $this->input->post("tanggal");
      // $nama = $this->input->post("nama");
      $namaBahan = $this->input->post("namaBahan");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $bagian = strtoupper($this->session->userdata("fabricationGroup"));
      $rowId = $this->input->post("rowId");
      $specialChar = array('(',')');
      if(empty($idUser)||empty($tanggal)||empty($jumlahPermintaan)){
        echo "Data Kosong";
      }else{
        if(empty($kdGdBahan)){
          $data = array("qty"=>$jumlahPermintaan,
                        "rowid"=>$rowId,
                        "price"=>$jumlahPermintaan,
                        "name"=>str_replace($specialChar,'',$namaBahan),
                        "id_user" => $idUser,
                        "jumlah_permintaan" => $jumlahPermintaan,
                        "bagian" => $bagian,
                        "keterangan" => $keterangan,
                        "tgl_permintaan" => $tanggal);
        }else{
          $data = array("id"=>$kdGdBahan,
                        "rowid"=>$rowId,
                        "qty"=>$jumlahPermintaan,
                        "price"=>$jumlahPermintaan,
                        "name"=>str_replace($specialChar,'',$namaBahan),
                        "namaBarang"=>str_replace($specialChar,'',$namaBahan),
                        "kd_spare_part"=>$kdGdBahan,
                        "id_user" => $idUser,
                        "nama" => $nama,
                        "jumlah_permintaan" => $jumlahPermintaan,
                        "bagian" => $bagian,
                        "keterangan" => $keterangan,
                        "tgl_permintaan" => $tanggal);
        }
        $result = $this->cart->update($data);
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

  public function savePembelianGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = $this->input->post("jenis");
      $idUser = $this->session->userdata("fabricationIdUser");
      $data=array();
      $counter = 0;
      foreach ($this->cart->contents() as $key) {
        if($key["prefix"] == "PEMBELIAN ".$jenis." IDUSER=".$idUser){
          unset($key['id'],
                $key['qty'],
                $key['price'],
                $key['name'],
                $key['subtotal'],
                $key['namaBarang'],
                $key["prefix"]);
          array_push($data,$key);
        }
      }
      if(count($data) == 0){
        $result = "Data Kosong";
      }else{
        for($i=0; $i<count($data); $i++){
          $result = $this->Gudang_Bahan_Model->insertPermintaanBarang($data[$i],$jenis);
          $this->cart->remove($data[$i]["rowid"]);
          if($result){
            $counter++;
          }
        }
      }
      if($counter >= count($data)){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }

    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function savePembelianSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = "SPARE PART";
      $idUser = $this->session->userdata("fabricationIdUser");
      $data=array();
      $counter = 0;
      foreach ($this->cart->contents() as $key) {
        if($key["prefix"] == "PEMBELIAN ".$jenis." IDUSER=".$idUser){
          unset($key['id'],
                $key['qty'],
                $key['price'],
                $key['name'],
                $key['subtotal'],
                $key['namaBarang'],
                $key["prefix"]);
          array_push($data,$key);
        }
      }
      if(count($data) == 0){
        $result = "Data Kosong";
      }else{
        for($i=0; $i<count($data); $i++){
          $result = $this->Gudang_Bahan_Model->insertTransaksiPermintaanSparePart($data[$i]);
          $this->cart->remove($data[$i]["rowid"]);
          if($result){
            $counter++;
          }
        }
      }
      if($counter >= count($data)){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }

    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function addKoreksiTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tglKoreksi");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nmBahanBaku = $this->input->post("nmBahanBaku");
      $jumlahKoreksi = $this->input->post("jumlahKoreksi");
      $jenisKoreksi = $this->input->post("jenisKoreksi");
      $keterangan = $this->input->post("keterangan");
      $bagian = "GUDANG BAHAN";
      $specialChar = array("(",")");
      if(empty($tanggal)||empty($kdGdBahan)||
         empty($idUser)||empty($nmBahanBaku)||
         empty($jumlahKoreksi)||empty($jenisKoreksi)||
         $keterangan == "#"){
           echo "Data Kosong";
         }else{
           if($jenisKoreksi == "PLUS"){
             $keteranganHistory = $keterangan."(PLUS)";
             $statusHistory = "MASUK";
           }else{
             $keteranganHistory = $keterangan."(MINUS)";
             $statusHistory = "KELUAR";
           }

           $data = array("kd_gd_bahan"=>$kdGdBahan,
                         "id_user"=>$idUser,
                         "tgl_permintaan"=>$tanggal,
                         "jumlah_permintaan"=>$jumlahKoreksi,
                         "keterangan_history"=>$keteranganHistory,
                         "status_history"=>$statusHistory,
                         "bagian"=>"GUDANG BAHAN",
                         "nama"=>"GUDANG BAHAN",
                         );
          $result = $this->Gudang_Bahan_Model->insertTransaksiGudangBahan($data);
          echo $result;
         }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getKoreksiTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = str_replace("_"," ",$this->input->post("jenis"));
      $result = $this->Gudang_Bahan_Model->selectKoreksiGudangBahan($jenis);
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPengeluaranGudangBahanTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = str_replace("_"," ",$this->input->post("jenis"));
      $result = $this->Gudang_Bahan_Model->selectPengeluaranGudangBahan($jenis);
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailKoreksi(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $result = $this->Gudang_Bahan_Model->selectDetailTransaksiGudangBahan($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailPengeluaran(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $result = $this->Gudang_Bahan_Model->selectDetailTransaksiGudangBahan($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKoreksi(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = str_replace("_"," ",$this->input->post("jenis"));
      $result = $this->Gudang_Bahan_Model->selectKoreksiGudangBahan($jenis);
      if(empty($result)){
        echo "Data Kosong";
      }else{
        $result2 = "";
        foreach($result as $arrResult){
          $data = array("id" => $arrResult["id"],
                        "kdGdBahan" => $arrResult["kd_gd_bahan"],
                        "jumlah" => str_replace(",","",$arrResult["jumlah_permintaan"]),
                        "statusHistory" => $arrResult["status_history"],
                        "status" => "FINISH");
          $response = $this->Gudang_Bahan_Model->updateTransaksiGudangBahanAndStok($data);
        }
        if($response){
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

  public function editKoreksiTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $tanggal = $this->input->post("tglKoreksi");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nmBahanBaku = $this->input->post("nmBahanBaku");
      $jumlahKoreksi = $this->input->post("jumlahKoreksi");
      $jenisKoreksi = $this->input->post("jenisKoreksi");
      $keterangan = $this->input->post("keterangan");
      $bagian = "GUDANG BAHAN";
      $specialChar = array("(",")");
      if(empty($tanggal)||empty($idUser)||empty($nmBahanBaku)||empty($id)||
         empty($jumlahKoreksi)||empty($jenisKoreksi)||empty($keterangan)
        ){
          echo "Data Kosong";
         }else{
           if($jenisKoreksi == "PLUS"){
             $keteranganHistory = $keterangan."(PLUS)";
             $statusHistory = "MASUK";
           }else{
             $keteranganHistory = $keterangan."(MINUS)";
             $statusHistory = "KELUAR";
           }
           if (empty($kdGdBahan)) {
             $data = array("id"=>$id,
                           "id_user"=>$idUser,
                           "tgl_permintaan"=>$tanggal,
                           "jumlah_permintaan"=>$jumlahKoreksi,
                           "keterangan_history"=>$keteranganHistory,
                           "status_history"=>$statusHistory,
                           "bagian"=>"GUDANG BAHAN",
                           "nama"=>"GUDANG BAHAN",
                         );
           }else{
             $data = array("id"=>$id,
                           "kd_gd_bahan"=>$kdGdBahan,
                           "id_user"=>$idUser,
                           "tgl_permintaan"=>$tanggal,
                           "jumlah_permintaan"=>$jumlahKoreksi,
                           "keterangan_history"=>$keteranganHistory,
                           "status_history"=>$statusHistory,
                           "bagian"=>"GUDANG BAHAN",
                           "nama"=>"GUDANG BAHAN",
                         );
           }
          $result = $this->Gudang_Bahan_Model->updateTransaksiGudangBahan($data);
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

  public function editPengeluaranTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $tanggal = $this->input->post("tanggal");
      $jumlah = $this->input->post("jumlah");
      $keterangan = $this->input->post("keterangan");
      if(empty($id) || empty($tanggal) || empty($jumlah) || empty($keterangan)){
        echo "Data Kosong";
      }else{
        if(empty($kdGdBahan)){
          $data = array("id"=>$id,"tgl_permintaan"=>$tanggal,
                        "jumlah_permintaan"=>$jumlah,
                        "keterangan_history"=>$keterangan);
        }else{
          $data = array("id"=>$id,"tgl_permintaan"=>$tanggal,
                        "kd_gd_bahan"=>$kdGdBahan,
                        "jumlah_permintaan"=>$jumlah,
                        "keterangan_history"=>$keterangan);
        }
        $result = $this->Gudang_Bahan_Model->updateTransaksiGudangBahan($data);
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

  public function getDetailTransaksiGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $result = $this->Gudang_Bahan_Model->selectDetailTransaksiGudangBahan($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editHistoryGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $kdGdBahan2 = $this->input->post("kdGdBahan2");
      $tanggal = $this->input->post("tglTransaksi");
      $jumlah = $this->input->post("jumlah");
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      if(empty($idTransaksi) || $jumlah=="" || empty($tanggal)){
        echo "Data Kosong";
      }else{
        if(empty($kdGdBahan2)){
          $data = array("id"=>$idTransaksi,
                        "jumlah_permintaan"=>$jumlah,
                        "tgl_permintaan"=>$tanggal);
        }else{
          $data = array("id"=>$idTransaksi,
                        "kd_gd_bahan"=>$kdGdBahan2,
                        "jumlah_permintaan"=>$jumlah,
                        "tgl_permintaan"=>$tanggal);
        }
        $result = $this->Gudang_Bahan_Model->updateTransaksiGudangBahan($data);
        if($result){
          $data2 = array("kdGdBahan"=>$kdGdBahan2,
                         "tglAwal"=>$tglAwal,
                         "tglAkhir"=>$tglAkhir);
          $data2_1 = array("kdGdBahan"=>$kdGdBahan,
                        "tglAwal"=>$tglAwal,
                        "tglAkhir"=>$tglAkhir);

          $arrSaldo = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanGudangBahan($data2),TRUE); #Menghitung Saldo Barang Tujuan
          $arrSaldo2 = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanGudangBahan($data2_1),TRUE); #Menghitung Saldo Barang Asal

          $data3 = array("kd_gd_bahan"=>$kdGdBahan2,
                         "stok"=>str_replace(",","",$arrSaldo["saldoAkhir"]));

          $data3_1 = array("kd_gd_bahan"=>$kdGdBahan,
                        "stok"=>str_replace(",","",$arrSaldo2["saldoAkhir"]));
          $result2 = $this->Gudang_Bahan_Model->updateGudangBahan($data3);
          $result2_1 = $this->Gudang_Bahan_Model->updateGudangBahan($data3_1);
          if($result2 && $result2_1){
            echo "Berhasil";
          }else{
            echo "Gagal";
          }
        }else{
          echo "Gagal";
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function addPengeluaran(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $jumlah = $this->input->post("jumlah");
      $keterangan = $this->input->post("keterangan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $bagian = "GUDANG BAHAN";
      $statusHistory = "KELUAR";

      if(empty($tanggal) || empty($kdGdBahan) || empty($jumlah) || empty($idUser)){
        echo "Data Kosong";
      }else{
        if(empty($keterangan)){
          $keterangan = "PENGELUARAN (DEFAULT SYSTEM)";
        }else{
          if(substr($keterangan,0,11)!="PENGELUARAN"){
            $keterangan = "PENGELUARAN (".strtoupper($keterangan).")";
          }
        }
        $data = array("kd_gd_bahan" => $kdGdBahan,
                      "id_user" => $idUser,
                      "jumlah_permintaan" => $jumlah,
                      "tgl_permintaan" => $tanggal,
                      "bagian" => $bagian,
                      "nama" => $bagian,
                      "status_history" => $statusHistory,
                      "keterangan_history" => $keterangan);
        $result = $this->Gudang_Bahan_Model->insertTransaksiGudangBahan($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editPengeluaran(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $tanggal = $this->input->post("tanggal");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $jumlah = $this->input->post("jumlah");
      $keterangan = $this->input->post("keterangan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $bagian = "GUDANG BAHAN";
      $statusHistory = "KELUAR";

      if(empty($tanggal) || empty($jumlah) || empty($idUser)){
        echo "Data Kosong";
      }else{
        if(empty($kdGdBahan)){
          $data = array("id" => $idTransaksi,
                        "id_user" => $idUser,
                        "jumlah_permintaan" => $jumlah,
                        "tgl_permintaan" => $tanggal,
                        "bagian" => $bagian,
                        "nama" => $bagian,
                        "status_history" => $statusHistory,
                        "keterangan_history" => $keterangan);
        }else{
          $data = array("id" => $idTransaksi,
                        "kd_gd_bahan" => $kdGdBahan,
                        "id_user" => $idUser,
                        "jumlah_permintaan" => $jumlah,
                        "tgl_permintaan" => $tanggal,
                        "bagian" => $bagian,
                        "nama" => $bagian,
                        "status_history" => $statusHistory,
                        "keterangan_history" => $keterangan);
        }
        $result = $this->Gudang_Bahan_Model->updateTransaksiGudangBahan($data);
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

  public function savePengeluaran(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = str_replace("_"," ",$this->input->post("jenis"));
      $result = $this->Gudang_Bahan_Model->selectPengeluaranGudangBahan($jenis);
      if(empty($result)){
        echo "Data Kosong";
      }else{
        foreach($result as $arrResult){
          $data = array("id" => $arrResult["id"],
                        "kdGdBahan" => $arrResult["kd_gd_bahan"],
                        "jumlah" => str_replace(",","",$arrResult["jumlah_permintaan"]),
                        "statusHistory" => $arrResult["status_history"],
                        "status" => "FINISH");
          $response = $this->Gudang_Bahan_Model->updateTransaksiGudangBahanAndStok($data);
        }
        if($response){
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

  public function getListGudangApalDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectListGudangApalDatatable();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailGudangApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdApal = $this->input->post("kdGdApal");
      $result = $this->Gudang_Bahan_Model->selectDetailGudangApal($kdGdApal);
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdApal = $this->input->post("kdGdApal");
      $idUser = $this->session->userdata("fabricationIdUser");
      $kdAccurate = $this->input->post("kdAccurate");
      $jenis = $this->input->post("jenis");
      $subJenis = $this->input->post("subJenis");
      $stok = $this->input->post("stok");
      $tanggal = $this->input->post("tanggal");

      if(empty($kdGdApal)||empty($idUser)||empty($jenis)||$stok==""||empty($tanggal)){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_apal" => $kdGdApal,
                      "id_user" => $idUser,
                      "kd_accurate" => $kdAccurate,
                      "jenis" => $jenis,
                      "sub_jenis" => $subJenis,
                      "stok" => $stok,
                      "tanggal" => $tanggal);
        $result = $this->Gudang_Bahan_Model->insertGudangApal($data);
        if($result){
          $data2 = array("kd_gd_apal"=>$kdGdApal,
                         "id_user"=>$idUser,
                         "nama"=>"GUDANG APAL",
                         "tgl_transaksi"=>$tanggal,
                         "warna"=>$subJenis,
                         "bagian"=>"GUDANG APAL",
                         "jumlah_apal"=>$stok,
                         "keterangan_history"=>"DATA AWAL",
                         "status_history"=>"MASUK",
                         "status_lock"=>"TRUE",
                         "sts_transaksi"=>"FINISH");
          $result2 = $this->Gudang_Bahan_Model->insertTransaksiGudangApal($data2);
          echo $result2;
        }else{
          echo "Gagal";
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function addPenjualanApalTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $nama = $this->input->post("nama");
      $kdGdApal = $this->input->post("kdGdApal");
      $jumlah = $this->input->post("jumlah");
      $idUser = $this->session->userdata("fabricationIdUser");
      $bagian = "GUDANG APAL";
      $keteranganHistory = "PENJUALAN APAL";
      $statusHistory = "KELUAR";
      if(empty($tanggal)||empty($kdGdApal)||empty($jumlah)||empty($idUser)){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_apal"=>$kdGdApal,
                      "id_user"=>$idUser,
                      "nama"=>$nama,
                      "tgl_transaksi"=>$tanggal,
                      "bagian"=>$bagian,
                      "jumlah_apal"=>$jumlah,
                      "keterangan_history"=>$keteranganHistory,
                      "status_history"=>$statusHistory);
        $result = $this->Gudang_Bahan_Model->insertTransaksiGudangApal($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPenjualanApalTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectPenjualanApalTemp();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailTransaksiGudangApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $result = $this->Gudang_Bahan_Model->selectDetailTransaksiGudangApal($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editPenjualanApalTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $tanggal = $this->input->post("tanggal");
      $nama = $this->input->post("nama");
      $kdGdApal = $this->input->post("kdGdApal");
      $jumlah = $this->input->post("jumlah");
      $idUser = $this->session->userdata("fabricationIdUser");
      if(empty($id)||empty($tanggal)||empty($jumlah)||empty($idUser)){
        echo "Data Kosong";
      }else{
        if(!empty($kdGdApal)){
          $data = array("id"=>$id,
                        "kd_gd_apal"=>$kdGdApal,
                        "id_user"=>$idUser,
                        "tgl_transaksi"=>$tanggal,
                        "jumlah_apal"=>$jumlah);
        }else{
          $data = array("id"=>$id,
                        "id_user"=>$idUser,
                        "tgl_transaksi"=>$tanggal,
                        "jumlah_apal"=>$jumlah);
        }
        $result = $this->Gudang_Bahan_Model->updateTransaksiGudangApal($data);
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

  public function restoreTransaksiGudangApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $kdGdApal = $this->input->post("kdGdApal");
      $tglAwal = date("Y-m-d",strtotime("-1 days"));
      $tglAkhir = date("Y-m-d");
      $data = array("id" => $idTransaksi,
                    "deleted" => "FALSE");
      $result = $this->Gudang_Bahan_Model->updateTransaksiGudangApal($data);
      if($result){
        $data2 = array("kdGdApal"=>$kdGdApal,
                       "tglAwal"=>$tglAwal,
                       "tglAkhir"=>$tglAkhir);
        $saldo = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanGudangApal($data2),TRUE);
        $result2 = $this->Gudang_Bahan_Model->updateGudangApal(array("kd_gd_apal"=>$kdGdApal,"stok"=>str_replace(",","",$saldo["saldoAkhir"])));
        if($result2){
          echo "Berhasil";
        }else{
          echo "Gagal";
        }
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListTrashTransaksiGudangApalDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectListTrashTransaksiGudangApalDatatable();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function savePenjualanApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = json_decode($this->Gudang_Bahan_Model->selectPenjualanApalTemp(),TRUE);
      if(empty($result)){
        echo "Data Kosong";
      }else{
        foreach($result as $arrResult){
          $data = array("id"=>$arrResult["id"],
                        "kdGdApal"=>$arrResult["kd_gd_apal"],
                        "status"=>"FINISH",
                        "jumlah"=>str_replace(",","",$arrResult["jumlah_apal"]),
                        "statusHistory"=>$arrResult["status_history"]);
          $result2 = $this->Gudang_Bahan_Model->updateTransaksiGudangApalAndStok($data);
        }
        echo $result2;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryGudangApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGudangApal = $this->input->post("kdGdApal");
      if(empty($tglAwal) || empty($tglAkhir) || empty($kdGudangApal)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdGdApal"=>$kdGudangApal);
        $result = $this->Gudang_Bahan_Model->selectListHistoryGudangApal($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getSaldoAwalBulanGudangApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGudangApal = $this->input->post("kdGdApal");
      if(empty($tglAwal) || empty($tglAkhir) || empty($kdGudangApal)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdGdApal"=>$kdGudangApal);
        $result = $this->Gudang_Bahan_Model->selectSaldoAwalBulanGudangApal($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editHistoryGudangApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $kdGdApal = $this->input->post("kdGdApal");
      $kdGdApal2 = $this->input->post("kdGdApal2");
      $tanggal = $this->input->post("tglTransaksi");
      $jumlah = $this->input->post("jumlah");
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      if(empty($idTransaksi) || $jumlah=="" || empty($tanggal)){
        echo "Data Kosong";
      }else{
        if(empty($kdGdApal2)){
          $data = array("id"=>$idTransaksi,
                        "jumlah_apal"=>$jumlah,
                        "tgl_transaksi"=>$tanggal);
        }else{
          $data = array("id"=>$idTransaksi,
                        "kd_gd_apal"=>$kdGdApal2,
                        "jumlah_apal"=>$jumlah,
                        "tgl_transaksi"=>$tanggal);
        }
        $result = $this->Gudang_Bahan_Model->updateTransaksiGudangApal($data);
        if($result){
          $data2 = array("kdGdApal"=>$kdGdApal2,
                         "tglAwal"=>$tglAwal,
                         "tglAkhir"=>$tglAkhir);
          $data2_1 = array("kdGdApal"=>$kdGdApal,
                        "tglAwal"=>$tglAwal,
                        "tglAkhir"=>$tglAkhir);

          $arrSaldo = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanGudangApal($data2),TRUE); #Menghitung Saldo Barang Tujuan
          $arrSaldo2 = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanGudangApal($data2_1),TRUE); #Menghitung Saldo Barang Asal

          $data3 = array("kd_gd_apal"=>$kdGdApal2,
                         "stok"=>str_replace(",","",$arrSaldo["saldoAkhir"]));

          $data3_1 = array("kd_gd_apal"=>$kdGdApal,
                        "stok"=>str_replace(",","",$arrSaldo2["saldoAkhir"]));
          $result2 = $this->Gudang_Bahan_Model->updateGudangApal($data3);
          $result2_1 = $this->Gudang_Bahan_Model->updateGudangApal($data3_1);
          if($result2 && $result2_1){
            echo "Berhasil";
          }else{
            echo "Gagal";
          }
        }else{
          echo "Gagal";
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteTransaksiGudangApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = $this->input->post("id");
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = date("Y-m-d");
      $kdGdApal = $this->input->post("kdGdApal");
      $data = array("id"=>$param,
                    "deleted"=>"TRUE");
      $result = $this->Gudang_Bahan_Model->updateTransaksiGudangApal($data);
      if($result){
        $data2 = array("kdGdApal"=>$kdGdApal,
                       "tglAwal"=>$tglAwal,
                       "tglAkhir"=>$tglAkhir);
        $saldo = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanGudangApal($data2),TRUE);
        $result2 = $this->Gudang_Bahan_Model->updateGudangApal(array("kd_gd_apal"=>$kdGdApal,"stok"=>str_replace(",","",$saldo["saldoAkhir"])));
        if($result2){
          echo "Berhasil";
        }else{
          echo "Gagal";
        }
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKoreksiApalTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $kdGdApal = $this->input->post("kdGdApal");
      $idUser = $this->session->userdata("fabricationIdUser");
      $jumlah = $this->input->post("jumlah");
      $jenisKoreksi = $this->input->post("jenisKoreksi");
      $keterangan = strtoupper($this->input->post("keterangan"));
      $nama = "GUDANG APAL";
      if(empty($tanggal)||empty($kdGdApal)||empty($jumlah)||empty($jenisKoreksi)||empty($keterangan)){
        echo "Data Kosong";
      }else{
        if($jenisKoreksi == "PLUS"){
          $statusHistory = "MASUK";
          if(substr($keterangan,0,7) != "KOREKSI"){
            $keteranganHistory = "KOREKSI ".$keterangan."(PLUS)";
          }else{
            $keteranganHistory = $keterangan."(PLUS)";
          }
        }else{
          $statusHistory = "KELUAR";
          if(substr($keterangan,0,7) != "KOREKSI"){
            $keteranganHistory = "KOREKSI ".$keterangan."(MINUS)";
          }else{
            $keteranganHistory = $keterangan."(MINUS)";
          }
        }
        $data = array("kd_gd_apal"=>$kdGdApal,
                      "id_user"=>$idUser,
                      "nama"=>$nama,
                      "tgl_transaksi"=>$tanggal,
                      "bagian"=>$nama,
                      "jumlah_apal"=>$jumlah,
                      "keterangan_history"=>$keteranganHistory,
                      "status_history"=>$statusHistory);
        $result = $this->Gudang_Bahan_Model->insertTransaksiGudangApal($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getKoreksiApalTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectKoreksiApalTemp();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editKoreksiApalTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $tanggal = $this->input->post("tanggal");
      $kdGdApal = $this->input->post("kdGdApal");
      $idUser = $this->session->userdata("fabricationIdUser");
      $jumlah = $this->input->post("jumlah");
      $jenisKoreksi = $this->input->post("jenisKoreksi");
      $keterangan = strtoupper($this->input->post("keterangan"));
      $nama = "GUDANG APAL";
      if(empty($tanggal)||empty($id)||empty($jumlah)||
         empty($jenisKoreksi)||empty($keterangan)){
        echo "Data Kosong";
      }else{
        if($jenisKoreksi == "PLUS"){
          $statusHistory = "MASUK";
          if(substr($keterangan,0,7) != "KOREKSI"){
            $keteranganHistory = "KOREKSI ".$keterangan."(PLUS)";
          }else{
            $keteranganHistory = $keterangan."(PLUS)";
          }
        }else{
          $statusHistory = "KELUAR";
          if(substr($keterangan,0,7) != "KOREKSI"){
            $keteranganHistory = "KOREKSI ".$keterangan."(MINUS)";
          }else{
            $keteranganHistory = $keterangan."(MINUS)";
          }
        }
        if(empty($kdGdApal)){
          $data = array("id_user"=>$idUser,
                        "nama"=>$nama,
                        "tgl_transaksi"=>$tanggal,
                        "bagian"=>$nama,
                        "jumlah_apal"=>$jumlah,
                        "keterangan_history"=>$keteranganHistory,
                        "status_history"=>$statusHistory,
                        "id"=>$id);
        }else{
          $data = array("kd_gd_apal"=>$kdGdApal,
                        "id_user"=>$idUser,
                        "nama"=>$nama,
                        "tgl_transaksi"=>$tanggal,
                        "bagian"=>$nama,
                        "jumlah_apal"=>$jumlah,
                        "keterangan_history"=>$keteranganHistory,
                        "status_history"=>$statusHistory,
                        "id"=>$id);

        }
        $result = $this->Gudang_Bahan_Model->updateTransaksiGudangApal($data);
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

  public function saveKoreksiApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = json_decode($this->Gudang_Bahan_Model->selectKoreksiApalTemp(),TRUE);
      if(empty($result)){
        echo "Data Kosong";
      }else{
        $result2 = "";
        foreach($result as $arrResult){
          $data = array("id" => $arrResult["id"],
                        "kdGdApal" => $arrResult["kd_gd_apal"],
                        "jumlah" => str_replace(",","",$arrResult["jumlah_apal"]),
                        "statusHistory" => $arrResult["status_history"],
                        "status" => "FINISH");
          $response = $this->Gudang_Bahan_Model->updateTransaksiGudangApalAndStok($data);
        }
        if($response){
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

  public function getDataAwalApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("kdGdApal");
      $result = $this->Gudang_Bahan_Model->selectDataAwalApal($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editDataAwalApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $jumlah = $this->input->post("jumlah");
      $kdGdApal = $this->input->post("kdGdApal");
      if(empty($id)||$jumlah==""){
        echo "Data Kosong";
      }else{
        $data = array("id"=>$id,
                      "jumlah_apal"=>$jumlah);
        $result = $this->Gudang_Bahan_Model->updateTransaksiGudangApal($data);
        if($result){
          $data2 = array("kdGdApal"=>$kdGdApal,
                         "tglAwal"=>date("Y-m-d",strtotime("-1 days")),
                         "tglAkhir"=>date("Y-m-d"));
          $saldoAkhir = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanGudangApal($data2),TRUE);
          $result3 = $this->Gudang_Bahan_Model->updateGudangApal(array("kd_gd_apal"=>$kdGdApal,"stok"=>str_replace(",","",$saldoAkhir["saldoAkhir"])));
          if($result3){
            echo "Berhasil";
          }else{
            echo "Gagal";
          }
        }else{
          echo "Gagal";
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListGudangSparePartDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectListSparePartDatatable();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdSparePart = $this->input->post("kdSparePart");
      $idUser = $this->session->userdata("fabricationIdUser");
      $kdAccurate = $this->input->post("kdAccurate");
      $tanggal = $this->input->post("tanggal");
      $namaBarang = $this->input->post("namaBarang");
      $kode = $this->input->post("kode");
      $ukuran = $this->input->post("ukuran");
      $stok = $this->input->post("stok");
      $keteranganHistory = "DATA AWAL";
      $statusHistory = "MASUK";
      $statusTransaksi = "FINISH";

      if(empty($kdSparePart)||empty($tanggal)||empty($namaBarang)||$stok==""){
        echo "Data Kosong";
      }else{
        $data = array("kd_spare_part"=>$kdSparePart,
                      "id_user"=>$idUser,
                      "kd_accurate"=>$kdAccurate,
                      "nm_spare_part"=>$namaBarang,
                      "kode"=>$kode,
                      "ukuran"=>$ukuran,
                      "stok"=>$stok,
                      "tgl_masuk"=>$tanggal,
                      "keterangan_history"=>$keteranganHistory,
                      "sts_history"=>$statusHistory,
                      "sts_transaksi"=>$statusTransaksi);
        $result = $this->Gudang_Bahan_Model->insertGudangSparePart($data);
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

  public function getDetailSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdSparePart = $this->input->post("kdSparePart");
      $result = $this->Gudang_Bahan_Model->selectDetailSparePart($kdSparePart);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdSparePart = $this->input->post("kdSparePart");
      $idUser = $this->session->userdata("fabricationIdUser");
      $kdAccurate = $this->input->post("kdAccurate");
      $tanggal = $this->input->post("tanggal");
      $namaBarang = $this->input->post("namaBarang");
      $kode = $this->input->post("kode");
      $ukuran = $this->input->post("ukuran");

      if(empty($kdSparePart)||empty($tanggal)||empty($namaBarang)){
        echo "Data Kosong";
      }else{
        $data = array("kd_spare_part"=>$kdSparePart,
                      "id_user"=>$idUser,
                      "kd_accurate"=>$kdAccurate,
                      "nm_spare_part"=>$namaBarang,
                      "kode"=>$kode,
                      "ukuran"=>$ukuran,
                      "tgl_masuk"=>$tanggal);
        $result = $this->Gudang_Bahan_Model->updateSparePart($data);
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

  public function deleteSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdSparePart = $this->input->post("kdSparePart");
      $data = array("kd_spare_part"=>$kdSparePart,
                    "deleted"=>"TRUE");
      $result = $this->Gudang_Bahan_Model->updateSparePart($data);
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

  public function getSaldoAwalBulanSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdSparePart = $this->input->post("kdSparePart");
      if(empty($tglAwal) || empty($tglAkhir) || empty($kdSparePart)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdSparePart"=>$kdSparePart);
        $result = $this->Gudang_Bahan_Model->selectSaldoAwalBulanSparePart($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistorySparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdSparePart = $this->input->post("kdSparePart");

      if(empty($tglAwal)||empty($tglAkhir)||empty($kdSparePart)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdSparePart"=>$kdSparePart);
        $result = $this->Gudang_Bahan_Model->selectListHistorySparePart($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteTransaksiSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = $this->input->post("id");
      $tglAwal = date("Y-m-d",strtotime("-1 days"));
      $tglAkhir = date("Y-m-d");
      $kdSparePart = $this->input->post("kdSparePart");
      $data = array("id"=>$param,
                    "deleted"=>"TRUE");
      $result = $this->Gudang_Bahan_Model->updateTransaksiSparePart($data);
      if($result){
        $data2 = array("kdSparePart"=>$kdSparePart,
                       "tglAwal"=>$tglAwal,
                       "tglAkhir"=>$tglAkhir);
        $saldo = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanSparePart($data2),TRUE);
        $result2 = $this->Gudang_Bahan_Model->updateSparePart(array("kd_spare_part"=>$kdSparePart,"stok"=>str_replace(",","",$saldo["saldoAkhir"])));
        if($result2){
          echo "Berhasil";
        }else{
          echo "Gagal";
        }
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListTrashTransaksiSparePartDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectListTrashTransaksiSparePartDatatable();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function restoreTransaksiSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $kdGdApal = $this->input->post("kdGdSparePart");
      $tglAwal = date("Y-m-d",strtotime("-1 days"));
      $tglAkhir = date("Y-m-d");
      $data = array("id" => $idTransaksi,
                    "deleted" => "FALSE");
      $result = $this->Gudang_Bahan_Model->updateTransaksiSparePart($data);
      if($result){
        $data2 = array("kdSparePart"=>$kdGdApal,
                       "tglAwal"=>$tglAwal,
                       "tglAkhir"=>$tglAkhir);
        $saldo = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanSparePart($data2),TRUE);
        $result2 = $this->Gudang_Bahan_Model->updateSparePart(array("kd_spare_part"=>$kdGdApal,"stok"=>str_replace(",","",$saldo["saldoAkhir"])));
        if($result2){
          echo "Berhasil";
        }else{
          echo "Gagal";
        }
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function savePengeluaranSparePartTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $kdSparePart = $this->input->post("kdSparePart");
      $idUser = $this->session->userdata("fabricationIdUser");
      $jumlah = $this->input->post("jumlah");
      $keteranganHistory = $this->input->post("keteranganHistory");
      $statusHistory = "KELUAR";
      if(empty($tanggal)||empty($kdSparePart)||empty($idUser)||$jumlah==""||empty($keteranganHistory)){
        echo "Data Kosong";
      }else{
        $data = array("kd_spare_part"=>$kdSparePart,
                      "id_user"=>$idUser,
                      "tgl_transaksi"=>$tanggal,
                      "jumlah"=>$jumlah,
                      "keterangan_history"=>$keteranganHistory,
                      "sts_history"=>$statusHistory);
        $result = $this->Gudang_Bahan_Model->insertTransaksiSparePart($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPengeluaranSparePartTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectPengeluaranSparePartTemp();
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteTransaksiSparePartTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $data = array("id"=>$id,
                    "deleted"=>"TRUE");
      $result = $this->Gudang_Bahan_Model->updateTransaksiSparePart($data);
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

  public function getDetailTransaksiSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Gudang_Bahan_Model->selectDetailTransaksiSparePart($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editPengeluaranSparePartTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $kdSparePart = $this->input->post("kdSparePart");
      $idUser = $this->session->userdata("fabricationIdUser");
      $jumlah = $this->input->post("jumlah");
      $keteranganHistory = $this->input->post("keteranganHistory");

      if(empty($id)||$jumlah==""||empty($idUser)||empty($keteranganHistory)){
        echo "Data Kosong";
      }else{
        if(empty($kdSparePart)){
          $data = array("id"=>$id,
                        "id_user"=>$idUser,
                        "jumlah"=>$jumlah,
                        "keterangan_history"=>$keteranganHistory);
        }else{
          $data = array("id"=>$id,
                        "kd_spare_part"=>$kdSparePart,
                        "id_user"=>$idUser,
                        "jumlah"=>$jumlah,
                        "keterangan_history"=>$keteranganHistory);
        }
        $result = $this->Gudang_Bahan_Model->updateTransaksiSparePart($data);
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

  public function savePengeluaranSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectPengeluaranSparePartTemp();
      if(empty($result)){
        echo "Data Kosong";
      }else{
        foreach($result as $arrResult){
          $data = array("id" => $arrResult["id"],
                        "kdSparePart" => $arrResult["kd_spare_part"],
                        "jumlah" => str_replace(",","",$arrResult["jumlah"]),
                        "statusHistory" => $arrResult["sts_history"],
                        "status" => "FINISH");
          $response = $this->Gudang_Bahan_Model->updateTransaksiSparePartAndStok($data);
        }
        if($response){
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

  public function getKoreksiSparePartTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectKoreksiSparePartTemp();
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveKoreksiSparePartTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $kdSparePart = $this->input->post("kdSparePart");
      $idUser = $this->session->userdata("fabricationIdUser");
      $jumlah = $this->input->post("jumlah");
      $jenisKoreksi = $this->input->post("jenisKoreksi");
      $keteranganHistory = $this->input->post("keteranganHistory");
      if($jenisKoreksi=="PLUS"){
        $statusHistory = "MASUK";
      }else{
        $statusHistory = "KELUAR";
      }
      if(empty($tanggal)||empty($kdSparePart)||empty($idUser)||$jumlah==""||empty($keteranganHistory)||empty($jenisKoreksi)){
        echo "Data Kosong";
      }else{
        $data = array("kd_spare_part"=>$kdSparePart,
                      "id_user"=>$idUser,
                      "tgl_transaksi"=>$tanggal,
                      "jumlah"=>$jumlah,
                      "keterangan_history"=>$keteranganHistory."(".$jenisKoreksi.")",
                      "sts_history"=>$statusHistory);
        $result = $this->Gudang_Bahan_Model->insertTransaksiSparePart($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editKoreksiSparePartTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $kdSparePart = $this->input->post("kdSparePart");
      $idUser = $this->session->userdata("fabricationIdUser");
      $jumlah = $this->input->post("jumlah");
      $jenisKoreksi = $this->input->post("jenisKoreksi");
      $keteranganHistory = $this->input->post("keteranganHistory");
      $idTransaksi = $this->input->post("idTransaksi");
      if($jenisKoreksi=="PLUS"){
        $statusHistory = "MASUK";
      }else{
        $statusHistory = "KELUAR";
      }

      if(empty($tanggal)||empty($idUser)||$jumlah==""||empty($keteranganHistory)||empty($jenisKoreksi)){
        echo "Data Kosong";
      }else{
        if(empty($kdSparePart)){
          $data = array("id_user"=>$idUser,
                        "tgl_transaksi"=>$tanggal,
                        "jumlah"=>$jumlah,
                        "keterangan_history"=>$keteranganHistory."(".$jenisKoreksi.")",
                        "sts_history"=>$statusHistory,
                        "id"=>$idTransaksi);
        }else{
          $data = array("kd_spare_part"=>$kdSparePart,
                        "id_user"=>$idUser,
                        "tgl_transaksi"=>$tanggal,
                        "jumlah"=>$jumlah,
                        "keterangan_history"=>$keteranganHistory."(".$jenisKoreksi.")",
                        "sts_history"=>$statusHistory,
                        "id"=>$idTransaksi);
        }
        $result = $this->Gudang_Bahan_Model->updateTransaksiSparePart($data);
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

  public function saveKoreksiSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectKoreksiSparePartTemp();
      if(empty($result)){
        echo "Data Kosong";
      }else{
        foreach($result as $arrResult){
          $data = array("id" => $arrResult["id"],
                        "kdSparePart" => $arrResult["kd_spare_part"],
                        "jumlah" => str_replace(",","",$arrResult["jumlah"]),
                        "statusHistory" => $arrResult["sts_history"],
                        "status" => "FINISH");
          $response = $this->Gudang_Bahan_Model->updateTransaksiSparePartAndStok($data);
        }
        if($response){
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

  public function editHistorySparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $kdSparePart = $this->input->post("kdSparePart");
      $jumlah = $this->input->post("jumlah");
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdSparePart2 = $this->input->post("kdSparePart2");
      $idTransaksi = $this->input->post("id");

      if(empty($tanggal) || $jumlah==""){
        echo "Data Kosong";
      }else{
        if(empty($kdSparePart2)){
          $data = array("id"=>$idTransaksi,
                        "tgl_transaksi"=>$tanggal,
                        "jumlah"=>$jumlah);
        }else{
          $data = array("id"=>$idTransaksi,
                        "tgl_transaksi"=>$tanggal,
                        "jumlah"=>$jumlah,
                        "kd_spare_part"=>$kdSparePart2);
        }
        $result = $this->Gudang_Bahan_Model->updateTransaksiSparePart($data);
        if($result){
          $data2 = array("tglAwal"=>$tglAwal,
                         "tglAkhir"=>$tglAkhir,
                         "kdSparePart"=>$kdSparePart);

         $data2_1 = array("tglAwal"=>$tglAwal,
                        "tglAkhir"=>$tglAkhir,
                        "kdSparePart"=>$kdSparePart2);

          $arrSaldo = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanSparePart($data2),TRUE);
          $arrSaldo2 = json_decode($this->Gudang_Bahan_Model->selectSaldoAwalBulanSparePart($data2_1),TRUE);

          $data3 = array("kd_spare_part"=>$kdSparePart,
                         "stok"=>str_replace(",","",$arrSaldo["saldoAkhir"]));
          $data3_1 = array("kd_spare_part"=>$kdSparePart2,
                           "stok"=>str_replace(",","",$arrSaldo2["saldoAkhir"]));

          $result2 = $this->Gudang_Bahan_Model->updateSparePart($data3);
          $result2_1 = $this->Gudang_Bahan_Model->updateSparePart($data3_1);
          if($result2 && $result2_1){
            echo "Berhasil";
          }else{
            echo "Gagal";
          }
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getTransaksiGudangBahanForApproveDataTable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $bagian = $this->input->post("bagian");
      $jenis = $this->input->post("jenis");
      if(empty($bagian)||empty($jenis)){
        echo "Data Kosong";
      }else{
        $data = array("bagian"=>$bagian,
                      "jenis"=>$jenis);
        $result = $this->Gudang_Bahan_Model->selectTransaksiGudangBahanForApproveDataTable($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getTransaksiGudangApalForApproveDataTable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectTransaksiGudangApalForApproveDataTable();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPembelianGudangBahanForApproveDataTable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = $this->input->post("jenis");
      if(empty($jenis)){
        echo "Data Kosong";
      }else{
        $result = $this->Gudang_Bahan_Model->selectPembelianGudangBahanForApproveDataTable($jenis);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountAlert(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $bagian = $this->input->post("bagian");
      $jenis = $this->input->post("jenis");
      $data = array("bagian"=>$bagian,
                    "jenis"=>$jenis);
      $result = $this->Gudang_Bahan_Model->selectCountAlert($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountAlertApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Bahan_Model->selectCountAlertApal();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountAlertPembelianGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = $this->input->post("jenis");
      $result = $this->Gudang_Bahan_Model->selectCountAlertPembelianGudangBahan($jenis);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveApproveTransaksiGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = $this->input->post("jenis");
      $bagian = $this->input->post("bagian");
      $statusNumber = 0;
      if(empty($jenis) || empty($bagian)){
        echo "Data Kosong";
      }else{
        $data = array("bagian"=>$bagian,
                      "jenis"=>$jenis);
        $result = $this->Gudang_Bahan_Model->selectGudangBahanDataForApprove($data);
        if(empty($result)){
          echo "Item Kosong";
        }else{
          for ($i=0; $i < count($result); $i++) {
            $param = array("id"=>$result[$i]["id"],
                           "kdGdBahan"=>$result[$i]["kd_gd_bahan"],
                           "jumlah"=>$result[$i]["jumlah_permintaan"],
                           "statusHistory"=>$result[$i]["status_history"],
                           "status"=>"FINISH");
            $result2 = $this->Gudang_Bahan_Model->updateTransaksiGudangBahanAndStok($param);
            if($result2){
              $statusNumber++;
            }
          }
          if($statusNumber == count($result)){
            echo "Berhasil";
          }else{
            echo "Gagal";
          }
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editDataForApprove(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $jumlah = $this->input->post("jumlah");
      if(empty($idTransaksi) || empty($jumlah)){
        echo "Data Kosong";
      }else{
        $data = array("id"=>$idTransaksi,
                      "jumlah_permintaan"=>$jumlah);
        $result = $this->Gudang_Bahan_Model->updateTransaksiGudangBahan($data);
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

  public function editDataApalForApprove(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $jumlah = $this->input->post("jumlah");
      if(empty($idTransaksi) || empty($jumlah)){
        echo "Data Kosong";
      }else{
        $data = array("id"=>$idTransaksi,
                      "jumlah_apal"=>$jumlah);
        $result = $this->Gudang_Bahan_Model->updateTransaksiGudangApal($data);
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

  public function saveApprovePembelianGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = $this->input->post("jenis");
      $statusNumber = 0;
      if(empty($jenis)){
        echo "Data Kosong";
      }else{
        $result = $this->Gudang_Bahan_Model->selectGudangBahanPembelianForApprove($jenis);
        if(empty($result)){
          echo "Item Kosong";
        }else{
          for ($i=0; $i < count($result); $i++) {
            $param = array("id"=>$result[$i]["id"],
                           "kdGdBahan"=>$result[$i]["kd_gd_bahan"],
                           "jumlah"=>$result[$i]["jumlah_permintaan"],
                           "statusHistory"=>$result[$i]["status_history"],
                           "status"=>"FINISH");
            $result2 = $this->Gudang_Bahan_Model->updateTransaksiGudangBahanAndStok($param);
            if($result2){
              $statusNumber++;
            }
          }
          if($statusNumber == count($result)){
            echo "Berhasil";
          }else{
            echo "Gagal";
          }
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveApproveTransaksiGudangApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = $this->input->post("jenis");
      $bagian = $this->input->post("bagian");
      $statusNumber = 0;
      $result = $this->Gudang_Bahan_Model->selectGudangApalDataForApprove();
      if(empty($result)){
        echo "Item Kosong";
      }else{
        for ($i=0; $i < count($result); $i++) {
          $param = array("id"=>$result[$i]["id"],
                         "kdGdApal"=>$result[$i]["kd_gd_apal"],
                         "jumlah"=>$result[$i]["jumlah_apal"],
                         "statusHistory"=>$result[$i]["status_history"],
                         "status"=>"FINISH");
          $result2 = $this->Gudang_Bahan_Model->updateTransaksiGudangApalAndStok($param);
          if($result2){
            $statusNumber++;
          }
        }
        if($statusNumber == count($result)){
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

  function countPermintaanCatSablon(){
    $result = $this->Gudang_Bahan_Model->countPermintaanCatSablon();
    echo $result;
  }

  function countPermintaanMinyakSablon(){
    $result = $this->Gudang_Bahan_Model->countPermintaanMinyakSablon();
    echo $result;
  }

  function getDataPermintaanBahanSablon(){
    $jenis  = str_replace("%20", " ", $this->input->post("jenis"));
    $result = $this->Gudang_Bahan_Model->getDataPermintaanBahanSablon($jenis);
    echo $result;
  }

  function deleteListPermintaanBahanSablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Gudang_Bahan_Model->deleteListPermintaanBahanSablon($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function approvePermintaanBahanSablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = $this->input->post("jenis");
      $result = $this->Gudang_Bahan_Model->approvePermintaanBahanSablon($jenis);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function listBonPermintaan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal  = $this->input->post("tgl_awal");
      $tglAkhir = $this->input->post("tgl_akhir");
      $jenis    = $this->input->post("jenis");
      $result   = $this->Gudang_Bahan_Model->getListBonPermintaan($jenis,$tglAwal,$tglAkhir);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function listBonPermintaanSP(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal  = $this->input->post("tgl_awal");
      $tglAkhir = $this->input->post("tgl_akhir");
      $jenis    = $this->input->post("jenis");
      $result   = $this->Gudang_Bahan_Model->getListBonPermintaanSP($jenis,$tglAwal,$tglAkhir);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGeneratedRequestCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrData["Code"] = $this->Gudang_Bahan_Model->generateKodePermintaan();
      echo json_encode($arrData);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGeneratedRequestSparePartCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrData["Code"] = $this->Gudang_Bahan_Model->generateKodePermintaanSparePart();
      echo json_encode($arrData);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPermintaanBarang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $bagian = $this->session->userdata("fabricationGroup");
      $data = array("idUser" => $idUser,
                    "bagian" => $bagian);
      $result = $this->Gudang_Bahan_Model->selectPermintaanBarang($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPermintaanSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $bagian = $this->session->userdata("fabricationGroup");
      $data = array("idUser" => $idUser,
                    "bagian" => $bagian);
      $result = $this->Gudang_Bahan_Model->selectPermintaanSparePart($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailPermintaanBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idPermintaan = $this->input->post("idPermintaan");
      $bagian = $this->session->userdata("fabricationGroup");
      $data = array("idPermintaan" => $idPermintaan,
                    "bagian" => $bagian);
      $result = $this->Gudang_Bahan_Model->selectDetailPermintaanBaru($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailPermintaanSparePartBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idPermintaan = $this->input->post("idPermintaan");
      $bagian = $this->session->userdata("fabricationGroup");
      $data = array("idPermintaan" => $idPermintaan,
                    "bagian" => $bagian);
      $result = $this->Gudang_Bahan_Model->selectDetailPermintaanSparePartBaru($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestorePermintaanBarang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      $data = array("kd_permintaan_barang" => $idTransaksi,
                    "deleted" => $deleted);
      $result = $this->Gudang_Bahan_Model->updateDeleteAndRestorePermintaanBarang($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestorePermintaanSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      $data = array("kd_permintaan_spare_part" => $idTransaksi,
                    "deleted" => $deleted);
      $result = $this->Gudang_Bahan_Model->updateDeleteAndRestorePermintaanSparePart($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestoreDetailPermintaanBarang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $kdPermintaan = $this->input->post("kdPermintaan");
      $deleted = $this->input->post("deleted");
      $data = array("idTransaksi" => $idTransaksi,
                    "kdPermintaan" => $kdPermintaan,
                    "deleted" => $deleted);
      $result = $this->Gudang_Bahan_Model->updateDeleteAndRestoreDetailPermintaanBarang($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestoreDetailPermintaanSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $kdPermintaan = $this->input->post("kdPermintaan");
      $deleted = $this->input->post("deleted");
      $data = array("idTransaksi" => $idTransaksi,
                    "kdPermintaan" => $kdPermintaan,
                    "deleted" => $deleted);
      $result = $this->Gudang_Bahan_Model->updateDeleteAndRestoreDetailPermintaanSparePart($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printBonPermintaanBarang($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("DataPermintaan" => $this->Gudang_Bahan_Model->selectPermintaanBarang_Print($param),
                    "DataDetailPermintaan" => $this->Gudang_Bahan_Model->selectDetailPermintaanBaru_Print($param));
      $this->load->view("frm_print_bon_permintaan_barang",$data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printBonPermintaanSparePart($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("DataPermintaan" => $this->Gudang_Bahan_Model->selectPermintaanSparePart_Print($param),
                    "DataDetailPermintaan" => $this->Gudang_Bahan_Model->selectDetailPermintaanSparePartBaru_Print($param));
      $this->load->view("frm_print_bon_permintaan_spare_part",$data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function terimaBarangFull(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDPB = $this->input->post("idDpb");
      $idPermintaan = $this->input->post("idPermintaan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $namaSupplier = $this->input->post("namaSupplier");
      $tglTerima = $this->input->post("tglTerima");
      $arrData = $this->Gudang_Bahan_Model->selectDataPermintaanUntukInputTransaksiGudangBahan($idDPB);
      $Data = array("TGB" => array("kd_gd_bahan"        => $arrData[0]["kd_gd_bahan"],
                                   "id_user"            => $idUser,
                                   "nama"               => $namaSupplier,
                                   "jumlah_permintaan"  => $arrData[0]["jumlah_permintaan"],
                                   "tgl_permintaan"     => $tglTerima,
                                   "bagian"             => str_replace("_"," ",$arrData[0]["bagian"]),
                                   "status"             => "FINISH",
                                   "status_history"     => "MASUK",
                                   "keterangan_history" => "PEMBELIAN BARANG"
                                  ),
                    "TDPB" => array("id_dpb"                => $idDPB,
                                    "kd_permintaan_barang"  => $idPermintaan
                                   ),
                    "TBPB" => array("id_user"       => $idUser,
                                    "id_dpb"        => $idDPB,
                                    "supplier"      => $namaSupplier,
                                    "tgl_terima"    => $tglTerima,
                                    "jumlah_terima" => $arrData[0]["jumlah_permintaan"]
                                   )
                    );
      $result = $this->Gudang_Bahan_Model->updateTerimaBarangFull($Data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function terimaBarangSetengah(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDPB = $this->input->post("idDpb");
      $idPermintaan = $this->input->post("idPermintaan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $namaSupplier = $this->input->post("namaSupplier");
      $tglTerima = $this->input->post("tglTerima");
      $jumlahTerima = $this->input->post("jumlahTerima");
      $arrData = $this->Gudang_Bahan_Model->selectDataPermintaanUntukInputTransaksiGudangBahan($idDPB);
      $Data = array("TGB" => array("kd_gd_bahan"        => $arrData[0]["kd_gd_bahan"],
                                   "id_user"            => $idUser,
                                   "nama"               => $namaSupplier,
                                   "jumlah_permintaan"  => $jumlahTerima,
                                   "tgl_permintaan"     => $tglTerima,
                                   "bagian"             => str_replace("_"," ",$arrData[0]["bagian"]),
                                   "status"             => "FINISH",
                                   "status_history"     => "MASUK",
                                   "keterangan_history" => "PEMBELIAN BARANG"
                                  ),
                    "TDPB" => array("id_dpb"                => $idDPB,
                                    "kd_permintaan_barang"  => $idPermintaan,
                                    "jumlah_terima"         => $jumlahTerima),
                    "TBPB" => array("id_user"       => $idUser,
                                    "id_dpb"        => $idDPB,
                                    "supplier"      => $namaSupplier,
                                    "tgl_terima"    => $tglTerima,
                                    "jumlah_terima" => $jumlahTerima
                                   )
                    );
      $result = $this->Gudang_Bahan_Model->updateTerimaBarangSetengah($Data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function selesaiPermintaan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDpb = $this->input->post("idDpb");
      $idPermintaan = $this->input->post("idPermintaan");
      $data = array("id_dpb"        => $idDpb,
                    "kd_permintaan" => $idPermintaan);
      $result = $this->Gudang_Bahan_Model->updateSelesaiPermintaan($data);
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

  public function terimaSparePartFull(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDPSP = $this->input->post("idDpsp");
      $idPermintaan = $this->input->post("idPermintaan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $namaSupplier = $this->input->post("namaSupplier");
      $tglTerima = $this->input->post("tglTerima");
      $arrData = $this->Gudang_Bahan_Model->selectDataPermintaanUntukInputTransaksiSparePart($idDPSP);
      $Data = array("TDSP" => array("kd_spare_part"         => $arrData[0]["kd_spare_part"],
                                    "id_user"               => $idUser,
                                    "jumlah"                => $arrData[0]["jumlah_permintaan"],
                                    "tgl_transaksi"         => $tglTerima,
                                    "sts_transaksi"         => "FINISH",
                                    "sts_history"           => "MASUK",
                                    "keterangan_history"    => "PEMBELIAN SPARE PART (".strtoupper($namaSupplier).")"
                                    ),
                    "TDPSP" => array("id_dpsp"                  => $idDPSP,
                                    "kd_permintaan_spare_part"  => $idPermintaan),
                    "TBPSP" => array("id_user"       => $idUser,
                                     "id_dpsp"        => $idDPSP,
                                     "supplier"      => $namaSupplier,
                                     "tgl_terima"    => $tglTerima,
                                     "jumlah_terima" => $arrData[0]["jumlah_permintaan"]
                                    )
                    );
      $result = $this->Gudang_Bahan_Model->updateTerimaSparePartFull($Data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function terimaSparePartSetengah(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDPSP = $this->input->post("idDpsp");
      $idPermintaan = $this->input->post("idPermintaan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $namaSupplier = $this->input->post("namaSupplier");
      $tglTerima = $this->input->post("tglTerima");
      $jumlahTerima = $this->input->post("jumlahTerima");
      $arrData = $this->Gudang_Bahan_Model->selectDataPermintaanUntukInputTransaksiSparePart($idDPSP);
      $Data = array("TDSP" => array("kd_spare_part"         => $arrData[0]["kd_spare_part"],
                                    "id_user"               => $idUser,
                                    "jumlah"                => $jumlahTerima,
                                    "tgl_transaksi"         => $tglTerima,
                                    "sts_transaksi"         => "FINISH",
                                    "sts_history"           => "MASUK",
                                    "keterangan_history"    => "PEMBELIAN SPARE PART"
                                    ),
                    "TDPSP" => array("id_dpsp"                  => $idDPSP,
                                    "kd_permintaan_spare_part"  => $idPermintaan,
                                    "jumlah_terima"             => $jumlahTerima),
                    "TBPSP" => array("id_user"       => $idUser,
                                     "id_dpsp"        => $idDPSP,
                                     "supplier"      => $namaSupplier,
                                     "tgl_terima"    => $tglTerima,
                                     "jumlah_terima" => $jumlahTerima
                                    )
                    );
      $result = $this->Gudang_Bahan_Model->updateTerimaSparePartSetengah($Data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function selesaiPermintaanSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDpsp = $this->input->post("idDpsp");
      $idPermintaan = $this->input->post("idPermintaan");
      $data = array("id_dpsp"        => $idDpsp,
                    "kd_permintaan_spare_part" => $idPermintaan);
      $result = $this->Gudang_Bahan_Model->updateSelesaiPermintaanSparePart($data);
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

  public function getDetailDataAwal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $result = $this->Gudang_Bahan_Model->selectDetailDataAwal($kdGdBahan);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function addDataAwal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nama = $this->session->userdata("fabricationGroup");
      $jumlahPermintaan = $this->input->post("jumlahPermintaan");
      $tglPermintaan = "2015-10-31";
      $bagian = $this->session->userdata("fabricationGroup");
      $status = "PENDING";
      $statusHistory = "MASUK";
      $keteranganHistory = "DATA AWAL";
      $statusLock = "TRUE";
      $jenis = $this->input->post("jenis");

      if($kdGdBahan=="" || $jumlahPermintaan==""){
        echo "Data Kosong";
      }else{
        $data["TGB"] = array("kd_gd_bahan"          => $kdGdBahan,
                             "id_user"              => $idUser,
                             "nama"                 => $nama,
                             "jumlah_permintaan"    => $jumlahPermintaan,
                             "tgl_permintaan"       => $tglPermintaan,
                             "bagian"               => $bagian,
                             "status"               => $status,
                             "status_history"       => $statusHistory,
                             "keterangan_history"   => $keteranganHistory,
                             "status_lock"          => $statusLock,
                             "jenis"                => $jenis);
        $result = $this->Gudang_Bahan_Model->insertDataAwalPending($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListDataAwalPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $jenis = $this->input->post("jenis");
      $data = array("idUser" => $idUser,
                    "jenis" => $jenis);
      $result = $this->Gudang_Bahan_Model->selectListDataAwalPending($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestoreListDataAwalPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $idTransaksi = $this->input->post("id");
      $deleted = $this->input->post("deleted");

      $data = array("id_user" => $idUser,
                    "id" => $idTransaksi,
                    "deleted" => $deleted);

      $result = $this->Gudang_Bahan_Model->updateTransaksiGudangBahan($data);
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

  public function saveDataAwal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $jenis = $this->input->post("jenis");
      $param = array("idUser" => $idUser,
                     "jenis" => $jenis);
      $data = json_decode($this->Gudang_Bahan_Model->selectListDataAwalPending($param),TRUE);
      $data2 = array();
      foreach ($data as $arrData) {
        $tempData = array("jumlah" => $arrData["jumlah_permintaan"],
                          "kd_gd_bahan" => $arrData["kd_gd_bahan"]);
        array_push($data2,$tempData);
      }
      $result = $this->Gudang_Bahan_Model->updateStokDataAwalBaru($data2);
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

  public function editDataAwal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $kdBarang = $this->input->post("kdBarang");
      $jumlahBaru = $this->input->post("jumlah");

      $data = json_decode($this->Gudang_Bahan_Model->selectDetailDataAwal($kdBarang),TRUE);

      $data2 = array("id" => $idTransaksi,
                     "kd_gd_bahan" => $kdBarang,
                     "jumlah" => $jumlahBaru - $data[0]["jumlah_permintaan"],
                     "jumlahBaru" => $jumlahBaru);
      $result = $this->Gudang_Bahan_Model->updateStokDataAwalLama($data2);

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

  public function getListDataAwalSparePartPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $result = $this->Gudang_Bahan_Model->selectListDataAwalSparePartPending($idUser);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailDataAwalSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdSparePart = $this->input->post("kdSparePart");
      $result = $this->Gudang_Bahan_Model->selectDetailDataAwalSparePart($kdSparePart);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function addDataAwalSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdSparePart = $this->input->post("kdSparePart");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tglTransaksi = "2018-06-30";
      $jumlah = $this->input->post("jumlah");
      $keteranganHistory = "DATA AWAL";
      $statusHistory = "MASUK";
      $statusLock = "TRUE";

      if(empty($kdSparePart) || $jumlah==""){
        echo "Data Kosong";
      }else{
        $data = array("kd_spare_part"      => $kdSparePart,
                      "id_user"            => $idUser,
                      "tgl_transaksi"      => $tglTransaksi,
                      "jumlah"             => $jumlah,
                      "keterangan_history" => $keteranganHistory,
                      "sts_history"        => $statusHistory,
                      "status_lock"        => $statusLock);

      }
      $result = $this->Gudang_Bahan_Model->insertDataAwalSparePartPending($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestoreListDataAwalSparePartPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");

      $data = array("id_user" => $idUser,
                    "id" => $idTransaksi,
                    "deleted" => $deleted);

      $result = $this->Gudang_Bahan_Model->updateTransaksiSparePart($data);
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

  public function saveDataAwalSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $data = json_decode($this->Gudang_Bahan_Model->selectListDataAwalSparePartPending($idUser),TRUE);
      $data2 = array();
      foreach ($data as $arrData) {
        $tempData = array("jumlah" => $arrData["jumlah"],
                          "kd_spare_part" => $arrData["kd_spare_part"]);
        array_push($data2,$tempData);
      }
      $result = $this->Gudang_Bahan_Model->updateStokDataAwalSparePartBaru($data2);
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

  public function editDataAwalSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $kdSparePart = $this->input->post("kdSparePart");
      $jumlahBaru = $this->input->post("jumlah");

      $data = json_decode($this->Gudang_Bahan_Model->selectDetailDataAwalSparePart($kdSparePart),TRUE);

      $data2 = array("id" => $idTransaksi,
                     "kd_spare_part" => $kdSparePart,
                     "jumlah" => $jumlahBaru - $data[0]["jumlah"],
                     "jumlahBaru" => $jumlahBaru);
      $result = $this->Gudang_Bahan_Model->updateStokDataAwalSparePartLama($data2);

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
}
?>
