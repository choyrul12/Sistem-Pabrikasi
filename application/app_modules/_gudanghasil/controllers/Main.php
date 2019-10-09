<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
		parent::__construct();
		$this->load->model("Gudang_Hasil_Model");
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
       ($this->session->userdata("fabricationGroup")=="gudang hasil"||
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
          array("Content"=>"Data Order Marketing","Link"=>"#","Name"=>"Data_Order_Marketing","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Data_Order_Marketing"),
          array("Content"=>"Stok Barang","Link"=>"#","Name"=>"Stok_Barang","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Stok_Barang"),
          array("Content"=>"Pengeluaran Barang","Link"=>"#","Name"=>"Pengeluaran_Barang","Status"=>"Parent","Icon"=>"fa fa-book","Id"=>"M_Pengeluaran_Barang"),
          array("Content"=>"Detail Hasil Jadi","Link"=>"_gudanghasil/main/detail_hasil_jadi","Name"=>"Detail_Hasil_Jadi","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Detail_Hasil_Jadi"),
          array("Content"=>"Stok Cat Murni","Link"=>"_gudanghasil/main/stok_cat_murni","Name"=>"Stok_Cat_Murni","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Stok_Cat_Murni"),
          array("Content"=>"Permintaan Cat Murni","Link"=>"_gudanghasil/main/permintaan_cat_murni","Name"=>"Permintaan_Cat_Murni","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Permintaan_Cat_Murni"),
          array("Content"=>"Cek Kartu Stok","Link"=>"_gudanghasil/main/cek_kartu_stok","Name"=>"Cek_Kartu_Stok","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Cek_Kartu_Stok")
        );

        $listMenu["childMenu"] = array(
          array("Content"=>"Data Order Terkirim","Link"=>"_gudanghasil/main/data_order_terkirim","Parent"=>"Data_Order_Marketing","Id"=>""),
          array("Content"=>"Data Sisa Order Belum Terkirim","Link"=>"_gudanghasil/main/data_sisa_order_belum_terkirim","Parent"=>"Data_Order_Marketing","Id"=>""),
          array("Content"=>"Pengiriman Baru","Link"=>"_gudanghasil/main/pengiriman_baru","Parent"=>"Data_Order_Marketing","Id"=>""),

          array("Content"=>"Stok Barang Campur","Link"=>"_gudanghasil/main/stok_barang_campur","Parent"=>"Stok_Barang","Id"=>""),
          array("Content"=>"Stok Barang Kantong","Link"=>"_gudanghasil/main/stok_barang_kantong","Parent"=>"Stok_Barang","Id"=>""),
          array("Content"=>"Stok Barang Sablon (Buffer)","Link"=>"_gudanghasil/main/stok_barang_sablon_buffer","Parent"=>"Stok_Barang","Id"=>""),
          array("Content"=>"Stok Barang Sablon (Hasil)","Link"=>"_gudanghasil/main/stok_barang_sablon_hasil","Parent"=>"Stok_Barang","Id"=>""),
          array("Content"=>"Stok Barang Standard","Link"=>"_gudanghasil/main/stok_barang_standard","Parent"=>"Stok_Barang","Id"=>""),

          array("Content"=>"Pengeluaran Barang Campur","Link"=>"_gudanghasil/main/pengeluaran_barang_campur","Parent"=>"Pengeluaran_Barang","Id"=>""),
          // array("Content"=>"Pengeluaran Barang Kantong","Link"=>"_gudanghasil/main/pengeluaran_barang_kantong","Parent"=>"Pengeluaran_Barang","Id"=>""),
          array("Content"=>"Pengeluaran Barang Sablon","Link"=>"_gudanghasil/main/pengeluaran_barang_sablon","Parent"=>"Pengeluaran_Barang","Id"=>""),
          array("Content"=>"Pengeluaran Barang Standard","Link"=>"_gudanghasil/main/pengeluaran_barang_standard","Parent"=>"Pengeluaran_Barang","Id"=>""),
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

  public function data_order_terkirim(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Data Order Terkirim");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_data_order_terkirim",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function data_sisa_order_belum_terkirim(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Data Sisa Order Belum Terkirim");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_data_sisa_order_belum_terkirim",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pengiriman_baru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pengiriman Baru");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_data_pengiriman_baru",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_barang_campur(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Stok Barang Campur");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_barang_campur",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_barang_kantong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Stok Barang Kantong");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_barang_kantong",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_barang_sablon_buffer(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Stok Barang Sablon (Buffer)");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_barang_sablon_buffer",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_barang_sablon_hasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Stok Barang Sablon (Hasil)");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_barang_sablon_hasil",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function stok_barang_standard(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Stok Barang Standard");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_stok_barang_standard",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pengeluaran_barang_campur(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pengeluaran Barang Campur");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_list_pengeluaran_barang_campur",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pengeluaran_barang_kantong(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pengeluaran Barang Kantong");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_list_pengeluaran_barang_campur",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pengeluaran_barang_sablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pengeluaran Barang Sablon");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_list_pengeluaran_barang_sablon",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function pengeluaran_barang_standard(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Pengeluaran Barang Standard");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_list_pengeluaran_barang_standard",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function detail_hasil_jadi(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Detail Hasil Jadi");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_detail_hasil_jadi",$data);
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

  public function permintaan_cat_murni(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Permintaan Cat Murni");
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

  public function cek_kartu_stok(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Cek Kartu Stok");
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

  public function getGeneratedGudangHasilCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jns_brg = $this->input->post("jns_brg");
      $jns_permintaan = $this->input->post("jns_permintaan");
      $data = array("jns_brg"        => $jns_brg,
                    "jns_permintaan" => $jns_permintaan);
      $result['Code'] = $this->Gudang_Hasil_Model->generateGudangHasilCode($data);
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountTrashGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectCountTrashBarangGudangHasil();
      $result_1 = $this->Gudang_Hasil_Model->selectCountTrashTransaksiGudangHasil();
      $data["Jumlah"] = $result[0]["Jumlah"]+$result_1[0]["Jumlah"];
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueHasil($param,$param2=""){
    $isLogin = $this->isLogin();
    if($isLogin){
      $keyword = $this->input->get("q");
      if(empty($keyword)){
        $data = array("jenis"=>$param,
                      "jns_permintaan"=>$param2);
        $result = $this->Gudang_Hasil_Model->selectComboBoxValueHasil($data);
      }else{
        $data = array("jenis"=>$param,
                      "jns_permintaan"=>$param2,
                      "key"=>$keyword);
        $result = $this->Gudang_Hasil_Model->selectComboBoxValueHasilSearch($data);
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValueHasilHd(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectComboBoxValueGudangHasilHd();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPengirimanBaruDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $key   = $this->input->post("key");
      $result = $this->Gudang_Hasil_Model->selectListPengirimanBaruDatatable($key);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPesananTerkirim(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $key = $this->input->post("key");
      $result = $this->Gudang_Hasil_Model->selectListPesananTerkirim($key);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPesananBelumTerkirim(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectListPesananBelumTerkirim();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getNotePesanan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $idDp = $this->input->post("idDP");
      $data = array("noOrder" => $noOrder,
                    "idDP" => $idDp);
      $result = $this->Gudang_Hasil_Model->selectPesananData($data);
      echo json_encode($result);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPesananDetailData(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("idDp");
      $result = $this->Gudang_Hasil_Model->selectPesananDetailData($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function addPengirimanBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdHasil = $this->input->post("kdGdHasil");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $idDp = $this->input->post("idDp");
      $customer = $this->input->post("customer");
      $tglPengiriman = $this->input->post("tglPengiriman");
      $jumlahPesanan = $this->input->post("jumlahPesanan");
      $jumlahBerat = $this->input->post("jumlahBerat");
      $jumlahLembar = $this->input->post("jumlahLembar");
      $jumlahDikirim = $this->input->post("jumlahDikirim");
      $warna = $this->input->post("warna");
      $statusPengiriman = $this->input->post("statusPengiriman");
      $jenisJumlah = $this->input->post("jenisJumlah");
      $keterangan = $this->input->post("keterangan");

      if(empty($idUser)||empty($idDp)||
         empty($customer)||empty($tglPengiriman)||$jumlahPesanan==""||$jumlahBerat==""||
         $jumlahLembar==""||empty($warna)||empty($statusPengiriman)||empty($jenisJumlah) || $jumlahDikirim==""
       ){
           echo "Data Kosong";
         }else{
           if(empty($kdGdHasil)&&empty($kdGdBahan)){
             echo "Data Kosong";
           }else{
             $data = array("kdGdHasil"=>$kdGdHasil,               "kdGdBahan"=>$kdGdBahan,
                           "idDp"=>$idDp,                         "idUser"=>$idUser,
                           "customer"=>$customer,                 "tglPengiriman"=>$tglPengiriman,
                           "jumlahPesanan"=>$jumlahPesanan,       "jumlahKg"=>$jumlahBerat,
                           "jumlahLembar"=>$jumlahLembar,         "warna"=>$warna,
                           "statusPengiriman"=>$statusPengiriman, "jenisJumlah"=>$jenisJumlah,
                           "keterangan"=>$keterangan,             "jumlahDikirim"=>$jumlahDikirim);
            $result = $this->Gudang_Hasil_Model->insertAddPengirimanBaru($data);
            if($result){
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

  public function getListPengirimanBaruTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectListPengirimanBaruTemp();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deletePengirimanBaruTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idDetailPengiriman");
      $result = $this->Gudang_Hasil_Model->updateDetailPengiriman(array("id_detail_pengiriman"=>$idTransaksi,"deleted"=>"TRUE"));
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

  public function savePengirimanBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = json_decode($this->Gudang_Hasil_Model->selectListPengirimanBaruTemp(),TRUE);
      $jumlahItemArray = count($result);
      $jumlahTransaksiSuccess = 0;
      $jumlahPengirimanSuccess = 0;
      if(empty($result)){
        echo "Item Kosong";
      }else{
        for ($i=0; $i < count($result); $i++) {
          if(empty($result[$i]["kd_gd_hasil"])){
            $data = array("no_order"=>$result[$i]["no_order"],
                          "kd_gd_bahan"=>$result[$i]["kd_gd_bahan"],
                          "id_user"=>$result[$i]["id_user"],
                          "id_detail_pengiriman"=>$result[$i]["id_detail_pengiriman"],
                          "id_dp"=>$result[$i]["id_dp"],
                          "nama"=>$result[$i]["customer"],
                          "jumlah_permintaan"=>$result[$i]["jumlah_kg"],
                          "tgl_permintaan"=>$result[$i]["tgl_pengiriman"],
                          "bagian"=>"PENJUALAN",
                          "status"=>"FINISH",
                          "status_history"=>"KELUAR",
                          "keterangan_history"=>$result[$i]["keterangan"],
                          "jumlah_terkirim"=>$result[$i]["jumlah_terkirim"]);
            $result2 = $this->Gudang_Hasil_Model->insertTransaksiGudangBahan_Pengiriman($data);
            if($result2){
              $jumlahTransaksiSuccess++;
            }
          }else{
            $data = array("no_order"=>$result[$i]["no_order"],
                          "kd_gd_hasil"=>$result[$i]["kd_gd_hasil"],
                          "id_user"=>$result[$i]["id_user"],
                          "id_dp"=>$result[$i]["id_dp"],
                          "id_detail_pengiriman"=>$result[$i]["id_detail_pengiriman"],
                          "ukuran"=>$result[$i]["ukuran"],
                          "jumlah_berat"=>$result[$i]["jumlah_kg"],
                          "jumlah_lembar"=>$result[$i]["jumlah_lembar"],
                          "warna"=>$result[$i]["warna"],
                          "customer"=>$result[$i]["customer"],
                          "tgl_transaksi"=>$result[$i]["tgl_pengiriman"],
                          "merek"=>$result[$i]["merek"],
                          "jns_permintaan"=>$result[$i]["jns_permintaan"],
                          "sts_barang"=>$result[$i]["sts_pengiriman"],
                          "status_history"=>"KELUAR",
                          "status_transaksi"=>"FINISH",
                          "keterangan_history"=>$result[$i]["keterangan"],
                          "keterangan_barang"=>"PENGIRIMAN",
                          "keterangan"=>"Barang Telah Dikirim Ke Bagian Pengiriman Pada : ".date("d-m-Y H:i:s"),
                          "jumlah_terkirim"=>$result[$i]["jumlah_terkirim"]);
            $result2 = $this->Gudang_Hasil_Model->insertTransaksiGudangHasil_Pengiriman($data);
            if($result2){
              $jumlahTransaksiSuccess++;
            }
          }
          $data2 = array("id_detail_pengiriman"=>$result[$i]["id_detail_pengiriman"],
                         "status"=>"FINISH");
          $result3 = $this->Gudang_Hasil_Model->updateDetailPengiriman($data2);
          if($result3){
            $jumlahPengirimanSuccess++;
          }
        }
        if($jumlahTransaksiSuccess == $jumlahItemArray){
          if($jumlahPengirimanSuccess == $jumlahItemArray){
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

  public function getListDetailPesananTerkirim(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDp = $this->input->post("idDp");
      $result = $this->Gudang_Hasil_Model->selectListDetailPengiriman($idDp);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("jns_brg" => $this->input->post("jnsBrg"),
                    "jns_permintaan" => $this->input->post("jnsPermintaan"));
      $result = $this->Gudang_Hasil_Model->selectListGudangHasilDatatable($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getTrashListGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectTrashListGudangHasilDatatable();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getTrashListTransaksiGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectTrashListTransaksiGudangHasil();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveBarangBaruGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdHasil = $this->input->post("kdGdHasil");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $kdAccurate = $this->input->post("kdAccurate");
      $tglBuat = $this->input->post("tglBuat");#
      $warnaPlastik = $this->input->post("warnaPlastik");#
      $tebal = $this->input->post("tebal");#
      $ukuran = $this->input->post("ukuran");#
      $stokBerat = $this->input->post("stokBerat");#
      $stokLembar = $this->input->post("stokLembar");#
      $merek = $this->input->post("merek");#
      $jnsPermintaan = $this->input->post("jnsPermintaan");#
      $jnsBarang = $this->input->post("jnsBarang");#
      $stsBarang = $this->input->post("stsBarang");#
      $keterangan = $this->input->post("keterangan");
      if(empty($kdGdHasil)||empty($idUser)||empty($tglBuat)||empty($warnaPlastik)||$tebal==""||empty($ukuran)||
         $stokBerat==""||$stokLembar==""||empty($merek)||empty($jnsPermintaan)||empty($jnsBarang)||empty($stsBarang)
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_gd_hasil"    => $kdGdHasil,
                       "id_user"        => $idUser,
                       "kd_accurate"    => $kdAccurate,
                       "tgl_buat"       => $tglBuat,
                       "warna_plastik"  => $warnaPlastik,
                       "tebal"          => $tebal,
                       "ukuran"         => str_replace(',','.',$ukuran),
                       "stok_berat"     => $stokBerat,
                       "stok_lembar"    => $stokLembar,
                       "merek"          => $merek,
                       "jns_permintaan" => $jnsPermintaan,
                       "jns_brg"        => $jnsBarang,
                       "sts_brg"        => $stsBarang,
                       "keterangan"     => $keterangan);
        $result = $this->Gudang_Hasil_Model->insertGudangHasil($data);
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

  public function deleteBarangGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdHasil = $this->input->post("kdGdHasil");
      $data = array("kd_gd_hasil" => $kdGdHasil,
                    "deleted" => "TRUE");
      $result = $this->Gudang_Hasil_Model->updateGudangHasil($data);
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

  public function deleteAndRestoreBarangGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdHasil = $this->input->post("kdGdHasil");
      $deleted = $this->input->post("deleted");
      $data = array("kd_gd_hasil" => $kdGdHasil,
                    "deleted" => $deleted);
      $result = $this->Gudang_Hasil_Model->updateGudangHasil($data);
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

  public function getListHistoryGudangHasilMasukDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdHasil = $this->input->post("kdGdHasil");

      if(empty($tglAwal)||empty($tglAkhir)||empty($kdGdHasil)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdGdHasil"=>$kdGdHasil);
        $result = $this->Gudang_Hasil_Model->selectListHistoryGudangHasilMasukDatatable($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryGudangHasilBufferMasukDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdHasil = $this->input->post("kdGdHasil");

      if(empty($tglAwal)||empty($tglAkhir)||empty($kdGdHasil)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdGdHasil"=>$kdGdHasil);
        $result = $this->Gudang_Hasil_Model->selectListHistoryGudangHasilBufferMasukDatatable($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryGudangHasilKeluarDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdHasil = $this->input->post("kdGdHasil");

      if(empty($tglAwal)||empty($tglAkhir)||empty($kdGdHasil)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdGdHasil"=>$kdGdHasil);
        $result = $this->Gudang_Hasil_Model->selectListHistoryGudangHasilKeluarDatatable($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListHistoryGudangBufferKeluarDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdHasil = $this->input->post("kdGdHasil");

      if(empty($tglAwal)||empty($tglAkhir)||empty($kdGdHasil)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdGdHasil"=>$kdGdHasil);
        $result = $this->Gudang_Hasil_Model->selectListHistoryGudangBufferKeluarDatatable($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getSaldoAwalGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdHasil = $this->input->post("kdGdHasil");

      if(empty($tglAwal)||empty($tglAkhir)||empty($kdGdHasil)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdGdHasil"=>$kdGdHasil);
        $result = $this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangHasil($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getSaldoAwalGudangHasilBuffer(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdHasil = $this->input->post("kdGdHasil");

      if(empty($tglAwal)||empty($tglAkhir)||empty($kdGdHasil)){
        echo "Data Kosong";
      }else{
        $data = array("tglAwal"=>$tglAwal,
                      "tglAkhir"=>$tglAkhir,
                      "kdGdHasil"=>$kdGdHasil);
        $result = $this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangHasilBuffer($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailBarangGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdHasil = $this->input->post("kdGdHasil");
      $result = $this->Gudang_Hasil_Model->selectDetailBarangGudangHasil($kdGdHasil);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editBarangGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdHasil = $this->input->post("kdGdHasil");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $kdAccurate = $this->input->post("kdAccurate");
      $tglBuat = $this->input->post("tglBuat");#
      $warnaPlastik = $this->input->post("warnaPlastik");#
      $tebal = $this->input->post("tebal");#
      $ukuran = $this->input->post("ukuran");#
      $merek = $this->input->post("merek");#
      $jnsPermintaan = $this->input->post("jnsPermintaan");#
      $stsBarang = $this->input->post("stsBarang");#
      $keterangan = $this->input->post("keterangan");
      if(empty($kdGdHasil)||empty($idUser)||empty($tglBuat)||empty($warnaPlastik)||$tebal==""||empty($ukuran)||
         empty($merek)||empty($jnsPermintaan)||empty($stsBarang)
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_gd_hasil"    => $kdGdHasil,
                       "id_user"        => $idUser,
                       "kd_accurate"    => $kdAccurate,
                       "tgl_buat"       => $tglBuat,
                       "warna_plastik"  => $warnaPlastik,
                       "tebal"          => $tebal,
                       "ukuran"         => $ukuran,
                       "merek"          => $merek,
                       "jns_permintaan" => $jnsPermintaan,
                       "sts_brg"        => $stsBarang,
                       "keterangan"     => $keterangan);
        $result = $this->Gudang_Hasil_Model->updateGudangHasil($data);
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

  public function getDetailTransaksiGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Gudang_Hasil_Model->selectDetailTransaksiGudangHasil($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editHistoryGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $kdGdHasil1 = $this->input->post("kdGdHasil1"); #Kode Hasil Jika Tidak Ingin Memindahakan Barang
      $kdGdHasil2 = $this->input->post("kdGdHasil2"); #Kode Hasil Jika Ingin Memindahkan Barang
      $tanggal = $this->input->post("tanggal");
      $berat = $this->input->post("berat");
      $lembar = $this->input->post("lembar");
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $jumlahPengiriman = $this->input->post("jumlahPengiriman");

      if(empty($idTransaksi)||$berat==""||$lembar==""||
         empty($tglAwal)||empty($tglAkhir)
       ){
           echo "Data Kosong";
      }else{
        if(empty($kdGdHasil2)){
          if($jumlahPengiriman==""){
            $data = array("id_permintaan_jadi"=>$idTransaksi,
                          "jumlah_berat"=>$berat,
                          "jumlah_lembar"=>$lembar,
                          "tgl_transaksi"=>$tanggal);
          }else{
            $data = array("id_permintaan_jadi"=>$idTransaksi,
                          "jumlah_berat"=>$berat,
                          "jumlah_lembar"=>$lembar,
                          "jumlah_terkirim"->$jumlahPengiriman,
                          "tgl_transaksi"=>$tanggal);
          }
          $result = $this->Gudang_Hasil_Model->updateTransaksiGudangHasilAndDetailPengiriman($data);
          if($result){
            $data_1 = array("tglAwal"=>$tglAwal,
                            "tglAkhir"=>$tglAkhir,
                            "kdGdHasil"=>$kdGdHasil1);
            $arrSaldo = json_decode($this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangHasil($data_1),TRUE);
            $dataForUpdateMaster = array("stok_berat"=>str_replace(",","",$arrSaldo["saldoAkhirBerat"]),
                                         "stok_lembar"=>str_replace(",","",$arrSaldo["saldoAkhirLembar"]),
                                         "kd_gd_hasil"=>$kdGdHasil1);
            $result_1 = $this->Gudang_Hasil_Model->updateGudangHasil($dataForUpdateMaster);
            if($result_1){
              echo "Berhasil";
            }else{
              echo "Update Stok Master Gagal";
            }
          }else{
            echo "Gagal";
          }
        }else{
          if($jumlahPengiriman == ""){
            $data = array("id_permintaan_jadi"=>$idTransaksi,
                          "kd_gd_hasil"=>$kdGdHasil2,
                          "jumlah_berat"=>$berat,
                          "jumlah_lembar"=>$lembar,
                          "tgl_transaksi"=>$tanggal);
          }else{
            $data = array("id_permintaan_jadi"=>$idTransaksi,
                          "kd_gd_hasil"=>$kdGdHasil2,
                          "jumlah_berat"=>$berat,
                          "jumlah_lembar"=>$lembar,
                          "jumlah_terkirim"=>$jumlahPengiriman,
                          "tgl_transaksi"=>$tanggal);
          }
          $result = $this->Gudang_Hasil_Model->updateTransaksiGudangHasilAndDetailPengiriman($data);
          if($result){
            $data_1 = array("tglAwal"=>$tglAwal,
                            "tglAkhir"=>$tglAkhir,
                            "kdGdHasil"=>$kdGdHasil1); #Data Untuk Mencari History Barang Pertama

            $data_2 = array("tglAwal"=>$tglAwal,
                            "tglAkhir"=>$tglAkhir,
                            "kdGdHasil"=>$kdGdHasil2); #Data Untuk Mencari History Barang Kedua

            $arrSaldo_1 = json_decode($this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangHasil($data_1),TRUE); #Data Hasil History Barang Pertama
            $arrSaldo_2 = json_decode($this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangHasil($data_2),TRUE); #Data Hasil History Barang Kedua

            $dataForUpdateMaster_1 = array("stok_berat"=>str_replace(",","",$arrSaldo_1["saldoAkhirBerat"]),
                                           "stok_lembar"=>str_replace(",","",$arrSaldo_1["saldoAkhirLembar"]),
                                           "kd_gd_hasil"=>$kdGdHasil1);
            $dataForUpdateMaster_2 = array("stok_berat"=>str_replace(",","",$arrSaldo_2["saldoAkhirBerat"]),
                                           "stok_lembar"=>str_replace(",","",$arrSaldo_2["saldoAkhirLembar"]),
                                           "kd_gd_hasil"=>$kdGdHasil2);

            $result_1 = $this->Gudang_Hasil_Model->updateGudangHasil($dataForUpdateMaster_1); #Update Data Master Barang Pertama
            $result_2 = $this->Gudang_Hasil_Model->updateGudangHasil($dataForUpdateMaster_2); #Update Data Master Barang Kedua

            if($result_1 && $result_2){
              echo "Berhasil";
            }else{
              echo "Update Stok Master Gagal";
            }
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

  public function deleteAndRestoreTransaksiGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDetailTransaksi = $this->input->post("idTransaksi");
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $kdGdHasil = $this->input->post("kdGdHasil");
      $deleted = $this->input->post("deleted");

      $data = array("id_permintaan_jadi" => $idDetailTransaksi,
                    "deleted"=>$deleted);
      $result = $this->Gudang_Hasil_Model->updateTransaksiGudangHasil($data);
      if($result){
        $data_1 = array("tglAwal" => $tglAwal,
                        "tglAkhir" => $tglAkhir,
                        "kdGdHasil" => $kdGdHasil);
        $arrSaldo = json_decode($this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangHasil($data_1),TRUE);

        $dataForUpdateMaster = array("stok_berat" => str_replace(",","",$arrSaldo["saldoAkhirBerat"]),
                                     "stok_lembar" => str_replace(",","",$arrSaldo["saldoAkhirLembar"]),
                                     "kd_gd_hasil" => $kdGdHasil);
        $result_1 = $this->Gudang_Hasil_Model->updateGudangHasil($dataForUpdateMaster);
        if($result_1){
          echo "Berhasil";
        }else{
          echo "Update Data Master Gagal";
        }
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function addPengambilanSablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tanggal = $this->input->post("tanggal");
      $idUser = $this->session->userdata("fabricationIdUser");
      $kdGdHasil = $this->input->post("kdGdHasil");
      $kdGdSablonBuffer = $this->input->post("kdGdSablonBuffer");
      $jumlahLembar = $this->input->post("jumlahLembar");
      $jumlahBerat = $this->input->post("jumlahBerat");
      $keterangan = $this->input->post("keterangan");

      if(empty($tanggal) || empty($idUser) || $jumlahLembar == "" || $jumlahBerat ==""){
        echo "Data Kosong";
      }else{
        if(empty($kdGdSablonBuffer)){
          $data = array("kd_gd_hasil" => $kdGdHasil,
                        "tgl_pengambilan"=>$tanggal,
                        "id_user" => $idUser,
                        "jumlah_lembar" => $jumlahLembar,
                        "jumlah_berat" => $jumlahBerat,
                        "keterangan" => $keterangan);
        }else{
          $data = array("kd_gd_hasil" => $kdGdHasil,
                        "kd_gd_hasil_secondary" => $kdGdSablonBuffer,
                        "tgl_pengambilan"=>$tanggal,
                        "id_user" => $idUser,
                        "jumlah_lembar" => $jumlahLembar,
                        "jumlah_berat" => $jumlahBerat,
                        "keterangan" => $keterangan);
        }
        $result = $this->Gudang_Hasil_Model->insertTransaksiPengambilanSablon($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPengambilanSablonTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectListPengambilanSablonTemp();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestorePengambilanSablonTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idPengambilanSablon");
      $deleted = $this->input->post("deleted");
      $data = array("id_pengambilan_sablon" => $idTransaksi,
                    "deleted" => $deleted);
      $result = $this->Gudang_Hasil_Model->updateTransaksiPengambilanSablon($data);
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

  public function savePengambilanSablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrData = json_decode($this->Gudang_Hasil_Model->selectListPengambilanSablonTemp(),TRUE);
      $jumlahDataPengambilan = count($arrData);
      $jumlahDataSelesai = 0;
      if(empty($arrData)){
        echo "Item Kosong";
      }else{
        foreach ($arrData as $data) {
          $newArrData = array("kd_gd_hasil"=>$data["kd_gd_hasil"],
                              "kd_gd_hasil_secondary"=>$data["kd_gd_hasil_secondary"],
                              "id_user" => $data["id_user"],
                              "ukuran" => $data["ukuran"],
                              "jumlah_berat" => $data["jumlah_berat"],
                              "jumlah_lembar" => $data["jumlah_lembar"],
                              "warna" => $data["warna_plastik"],
                              "customer" => "GUDANG HASIL",
                              "bagian" => "SABLON",
                              "tgl_transaksi" => $data["tgl_pengambilan"],
                              "merek" => $data["merek"],
                              "jns_permintaan" => $data["jns_permintaan"],
                              "sts_barang" => $data["jns_brg"],
                              "sts_approve" => "TRUE",
                              "status_history" => "KELUAR",
                              "status_transaksi" => "FINISH",
                              "keterangan_history" => "PENGAMBILAN SABLON ($data[jns_brg])",
                              "keterangan_barang" => $data["keterangan"],
                              "id_pengambilan_sablon" => $data["id_pengambilan_sablon"]);
          $result = $this->Gudang_Hasil_Model->insertTransaksiGudangHasil_PengambilanSablon($newArrData);
          if($result){
            $jumlahDataSelesai++;
          }
        }
        if($jumlahDataSelesai == $jumlahDataPengambilan){
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

  public function saveAddPengirimanGudangTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $tanggal = $this->input->post("tanggal");
      $namaCustomer = $this->input->post("namaCustomer");
      $kdGdHasil = $this->input->post("kdGdHasil");
      $jumlahBerat = $this->input->post("jumlahBerat");
      $jumlahLembar = $this->input->post("jumlahLembar");
      $keterangan = $this->input->post("keterangan");
      $statusPengiriman = $this->input->post("statusPengiriman");

      if(empty($idUser) || empty($tanggal) || empty($namaCustomer) || empty($kdGdHasil) ||
         $jumlahBerat=="" || $jumlahLembar=="" || empty($statusPengiriman)
       ){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_hasil" => $kdGdHasil,
                      "id_user" => $idUser,
                      "customer" => $namaCustomer,
                      "tgl_pengiriman" => $tanggal,
                      "jumlah_pesanan" => 0,
                      "jumlah_kg" => $jumlahBerat,
                      "jumlah_lembar" => $jumlahLembar,
                      "jumlah_terkirim" => 0,
                      "keterangan" => $keterangan,
                      "sts_pengiriman" => $statusPengiriman);
        $result = $this->Gudang_Hasil_Model->insertAddPengirimanGudang($data);
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

  public function getListPengirimanGudangTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $stsPengiriman = $this->input->post("stsPengiriman");
      $result = $this->Gudang_Hasil_Model->selectListPengirimanGudangTemp($stsPengiriman);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailPengirimanGudangTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idDetailPengiriman = $this->input->post("idDetailPengiriman");
      $result = $this->Gudang_Hasil_Model->selectDetailPengirimanGudangTemp($idDetailPengiriman);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editPengirimanGudangTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tanggal = $this->input->post("tanggal");
      $namaCustomer = $this->input->post("namaCustomer");
      $jumlahBerat = $this->input->post("jumlahBerat");
      $jumlahLembar = $this->input->post("jumlahLembar");
      $keterangan = $this->input->post("keterangan");

      if(empty($idUser) || empty($tanggal) || empty($namaCustomer) ||
         $jumlahBerat=="" || $jumlahLembar==""
       ){
        echo "Data Kosong";
      }else{
        $data = array("id_detail_pengiriman" => $idTransaksi,
                      "id_user" => $idUser,
                      "customer" => $namaCustomer,
                      "tgl_pengiriman" => $tanggal,
                      "jumlah_kg" => $jumlahBerat,
                      "jumlah_lembar" => $jumlahLembar,
                      "keterangan" => $keterangan);
        $result = $this->Gudang_Hasil_Model->updateDetailPengiriman($data);
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

  public function deleteAndRestorePengirimanGudangTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      if(empty($idTransaksi) || empty($deleted)){
        echo "Data Kosong";
      }else{
        $data = array("id_detail_pengiriman" => $idTransaksi,
                      "deleted" => $deleted);
        $result = $this->Gudang_Hasil_Model->updateDetailPengiriman($data);
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

  public function savePengirimanGudang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $stsPengiriman = $this->input->post("stsPengiriman");
      $arrData = json_decode($this->Gudang_Hasil_Model->selectListPengirimanGudangTemp($stsPengiriman),TRUE);
      $jumlahData = count($arrData);
      $jumlahTransaksiSuccess = 0;
      foreach ($arrData as $data) {
        $newArrData = array("kd_gd_hasil"=>$data["kd_gd_hasil"],
                            "id_user" => $data["id_user"],
                            "ukuran" => $data["ukuran"],
                            "jumlah_berat" => $data["jumlah_kg"],
                            "jumlah_lembar" => $data["jumlah_lembar"],
                            "warna" => $data["warna_plastik"],
                            "customer" => strtoupper($data["customer"]),
                            "bagian" => "GUDANG HASIL",
                            "tgl_transaksi" => $data["tgl_pengiriman"],
                            "merek" => $data["merek"],
                            "jns_permintaan" => $data["jns_permintaan"],
                            "sts_barang" => $data["sts_pengiriman"],
                            "sts_approve" => "TRUE",
                            "status_history" => "KELUAR",
                            "status_transaksi" => "FINISH",
                            "keterangan_history" => $data["keterangan"],
                            "keterangan_barang" => $data["keterangan"],
                            "keterangan" => $data["keterangan"]." (".strtoupper($data["customer"]).")",
                            "id_detail_pengiriman" => $data["id_detail_pengiriman"]);
        $result = $this->Gudang_Hasil_Model->insertTransaksiGudangHasil_PengirimanGudang($newArrData);
        if($result == "Lock"){
          break;
          $jumlahTransaksiSuccess = -1;
        }else if($result == "Berhasil"){
          $jumlahTransaksiSuccess++;
        }
      }
      if($jumlahTransaksiSuccess == -1){
        echo "Lock";
      }else if($jumlahTransaksiSuccess == $jumlahData){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getComboBoxValuetGudangApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectComboBoxValueGudangApal();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAddKirimanApalTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdApal = $this->input->post("kdGdApal");
      $idUser = $this->session->userdata("fabricationIdUser");
      $nama = $this->session->userdata("fabricationUsername");
      $tanggal = $this->input->post("tglTransaksi");
      $warna = $this->input->post("warna");
      $bagian = $this->session->userdata("fabricationGroup");
      $jumlahApal = $this->input->post("jumlahApal");
      $keteranganHistory = $this->input->post("keterangan");
      $statusHistory = "MASUK";

      if(empty($kdGdApal) || empty($idUser) || empty($tanggal) || empty($bagian) ||
         empty($jumlahApal)
        ){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_apal" => $kdGdApal,
                      "id_user" => $idUser,
                      "nama" => $nama,
                      "tgl_transaksi" => $tanggal,
                      "warna" => $warna,
                      "bagian" => $bagian,
                      "jumlah_apal" => $jumlahApal,
                      "keterangan_history" => $keteranganHistory,
                      "status_history" => $statusHistory);
        $result = $this->Gudang_Hasil_Model->insertTransaksiDetailHistoryApal($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListKirimanApalTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectListKirimanApalTemp();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deletedAndRestoreTransaksiDetailHistoryApalTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      if(empty($idTransaksi) || empty($deleted)){
        echo "Data Kosong";
      }else{
        $data = array("id" => $idTransaksi,
                      "deleted" => $deleted);
        $result = $this->Gudang_Hasil_Model->updateTransaksiDetailHistoryApal($data);
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

  public function saveKirimanApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = json_decode($this->Gudang_Hasil_Model->selectListKirimanApalTemp(),TRUE);
      $jumlahData = count($result);
      $jumlahSelesai = 0;
      foreach ($result as $resultValue) {
        $resultStatus = $this->Gudang_Hasil_Model->updateTransaksiDetailHistoryApal(array("id"=>$resultValue["id"],"sts_transaksi"=>"PROGRESS"));
        if($resultStatus){
          $jumlahSelesai++;
        }else{
          break;
        }
      }
      if($jumlahSelesai == $jumlahData){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAddPengembalianGudang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdHasil = $this->input->post("kdGdHasil");#
      $idUser = $this->session->userdata("fabricationIdUser");
      $namaCustomer = $this->input->post("namaCustomer");#
      $tanggal = $this->input->post("tglTransaksi");#
      $jumlahBerat = $this->input->post("jumlahBerat");#
      $jumlahLembar = $this->input->post("jumlahLembar");#
      $keterangan = $this->input->post("keterangan");#
      $jnsPermintaan = $this->input->post("jenisPermintaan");
      $statusBarang = $this->input->post("statusBarang");
      $merek = $this->input->post("merek");
      $ukuran = $this->input->post("ukuran");
      $warna = $this->input->post("warna");
      $bagian = "GUDANG HASIL";
      $statusHistory = "MASUK";
      $keteranganHistory = "PENGEMBALIAN BARANG";
      $keteranganBarang = "PENGEMBALIAN ".$statusBarang;

      if(empty($kdGdHasil)||empty($idUser)||empty($namaCustomer)||empty($tanggal)||$jumlahBerat==""||$jumlahLembar==""||
         empty($keterangan)||empty($jnsPermintaan)||empty($bagian)||empty($statusBarang)||empty($statusHistory)||empty($keteranganHistory)||
         empty($keteranganBarang)
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_gd_hasil"          => $kdGdHasil,
                       "id_user"              => $idUser,
                       "ukuran"               => $ukuran,
                       "jumlah_berat"         => $jumlahBerat,
                       "jumlah_lembar"        => $jumlahLembar,
                       "warna"                => $warna,
                       "customer"             => $namaCustomer,
                       "bagian"               => $bagian,
                       "tgl_transaksi"        => $tanggal,
                       "merek"                => $merek,
                       "jns_permintaan"       => $jnsPermintaan,
                       "sts_barang"           => $statusBarang,
                       "sts_approve"          => "TRUE",
                       "status_history"       => $statusHistory,
                       "keterangan_history"   => $keteranganHistory,
                       "keterangan_barang"    => $keteranganBarang,
                       "keterangan"           => $keterangan);
          $result = $this->Gudang_Hasil_Model->insertTransaksiGudangHasil($data);
          echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPengembalianBarang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $statusBarang = $this->input->post("statusBarang");
      $result = $this->Gudang_Hasil_Model->selectListPengembalianBarang($statusBarang);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function deleteAndRestorePengembalianGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");

      if(empty($idTransaksi) || empty($deleted)){
        echo "Data Kosong";
      }else{
        $data = array("id_permintaan_jadi" => $idTransaksi,
                      "deleted" => $deleted);
        $result = $this->Gudang_Hasil_Model->updateTransaksiGudangHasil($data);
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

  public function saveKembalianGudang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $statusBarang = $this->input->post("statusBarang");
      $result = json_decode($this->Gudang_Hasil_Model->selectListPengembalianBarang($statusBarang),TRUE);
      $jumlahData = count($result);
      $jumlahTerkirim = 0;
      if($jumlahData > 0){
        for ($i=0; $i < $jumlahData; $i++) {
          $booleanResult = $this->Gudang_Hasil_Model->updateTransaksiGudangHasil(array("id_permintaan_jadi"=>$result[$i]["id_permintaan_jadi"], "status_transaksi"=>"FINISH"));
          if($booleanResult){
            $data = array("kdGdHasil" => $result[$i]["kd_gd_hasil"],
                          "tglAwal" => date("Y-m-t",strtotime("-1 months",strtotime(date("Y-m-d")))),
                          "tglAkhir" => date("Y-m-t",strtotime(date("Y-m-d")))
                         );
            $arrSaldo = json_decode($this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangHasil($data),TRUE);

            $dataForUpdateMaster = array("kd_gd_hasil" => $result[$i]["kd_gd_hasil"],
                                         "stok_berat" => str_replace(",","",$arrSaldo["saldoAkhirBerat"]),
                                         "stok_lembar" => str_replace(",","",$arrSaldo["saldoAkhirLembar"])
                                        );
            $booleanResultMaster = $this->Gudang_Hasil_Model->updateGudangHasil($dataForUpdateMaster);
            if($booleanResultMaster){
              $jumlahTerkirim++;
            }else{
              break;
              echo "BreakInMaster";
            }
          }else{
            break;
            echo "BreakInTransaction";
          }
        }
         if($jumlahTerkirim == $jumlahData){
           echo "Berhasil";
         }else{
           echo "Gagal";
         }
      }else{
        echo "Item Kosong";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAddPembelianHd(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdHasil = $this->input->post("kdGdHasil");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $ukuran = $this->input->post("ukuran");
      $jumlahBerat = $this->input->post("jumlahBerat");#
      $jumlahLembar = $this->input->post("jumlahLembar");#
      $warna = $this->input->post("warna");
      $customer = $this->input->post("namaCustomer");
      $bagian = "GUDANG HASIL";#
      $tanggal = $this->input->post("tanggal");#
      $merek = $this->input->post("merek");
      $jenisPermintaan = $this->input->post("jnsPermintaan");#
      $statusBarang = $this->input->post("statusBarang");#
      $statusApprove = "TRUE";#
      $statusHistory = "MASUK";#
      $keteranganHistory = "PEMBELIAN BARANG";
      $keteranganBarang = "PEMBELIAN BARANG (HD)";

      if(empty($kdGdHasil)||empty($idUser)||empty($jumlahBerat)||$jumlahLembar==""||empty($bagian)||
         empty($tanggal)||empty($jenisPermintaan)||empty($statusBarang)||empty($statusApprove)||empty($statusHistory)
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_gd_hasil"          => $kdGdHasil,
                       "id_user"              => $idUser,
                       "ukuran"               => $ukuran,
                       "jumlah_berat"         => $jumlahBerat,
                       "jumlah_lembar"        => $jumlahLembar,
                       "warna"                => $warna,
                       "customer"             => $customer,
                       "bagian"               => $bagian,
                       "tgl_transaksi"        => $tanggal,
                       "merek"                => $merek,
                       "jns_permintaan"       => $jenisPermintaan,
                       "sts_barang"           => $statusBarang,
                       "sts_approve"          => $statusApprove,
                       "status_history"       => $statusHistory,
                       "keterangan_history"   => $keteranganHistory,
                       "keterangan_barang"    => $keteranganBarang
                      );
        $result = $this->Gudang_Hasil_Model->insertTransaksiGudangHasil($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPembelianBarangHdTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectListPembelianBarangHd();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function savePembelianHd(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = json_decode($this->Gudang_Hasil_Model->selectListPembelianBarangHd(),TRUE);
      $jumlahData = count($result);
      $jumlahTerkirim = 0;
      if($jumlahData > 0){
        for ($i=0; $i < $jumlahData; $i++) {
          $booleanResult = $this->Gudang_Hasil_Model->updateTransaksiGudangHasil(array("id_permintaan_jadi"=>$result[$i]["id_permintaan_jadi"], "status_transaksi"=>"FINISH"));
          if($booleanResult){
            $data = array("kdGdHasil" => $result[$i]["kd_gd_hasil"],
                          "tglAwal" => date("Y-m-t",strtotime("-1 months",strtotime(date("Y-m-d")))),
                          "tglAkhir" => date("Y-m-t",strtotime(date("Y-m-d")))
                         );
            $arrSaldo = json_decode($this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangHasil($data),TRUE);

            $dataForUpdateMaster = array("kd_gd_hasil" => $result[$i]["kd_gd_hasil"],
                                         "stok_berat" => str_replace(",","",$arrSaldo["saldoAkhirBerat"]),
                                         "stok_lembar" => str_replace(",","",$arrSaldo["saldoAkhirLembar"])
                                        );
            $booleanResultMaster = $this->Gudang_Hasil_Model->updateGudangHasil($dataForUpdateMaster);
            if($booleanResultMaster){
              $jumlahTerkirim++;
            }else{
              break;
              echo "BreakInMaster";
            }
          }else{
            break;
            echo "BreakInTransaction";
          }
        }
         if($jumlahTerkirim == $jumlahData){
           echo "Berhasil";
         }else{
           echo "Gagal";
         }
      }else{
        echo "Item Kosong";
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
      $kdGdApal = $this->input->post("kdGdApal");

      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "kdGdApal" => $kdGdApal);
      $result = $this->Gudang_Hasil_Model->selectListHistoryGudangApal($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAddKoreksiGudangBuffer(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdHasil = $this->input->post("kdGdHasil");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $ukuran = $this->input->post("ukuran");
      $jumlahBerat = $this->input->post("jumlahBerat");#
      $jumlahLembar = $this->input->post("jumlahLembar");#
      $warna = $this->input->post("warna");
      $customer = strtoupper($this->session->userdata("fabricationGroup"));
      $bagian = $this->session->userdata("fabricationGroup");#
      $tglTransaksi = $this->input->post("tglTransaksi");#
      $merek = $this->input->post("merek");
      $jnsPermintaan = $this->input->post("jnsPermintaan");#
      $stsBarang = $this->input->post("stsBarang");#
      $stsApprove = "TRUE";#
      $jenisKoreksi = $this->input->post("jenisKoreksi");#
      $statusHistori = ($jenisKoreksi == "PLUS" ? "MASUK" : "KELUAR");#
      $keteranganHistory = "KOREKSI BARANG (".$jenisKoreksi.")";
      $keteranganBarang = "KOREKSI BARANG ".strtoupper($jnsPermintaan);
      $keterangan = strtoupper($this->input->post("keterangan"));

      if(empty($kdGdHasil)||empty($idUser)||$jumlahBerat==""||$jumlahLembar==""||empty($bagian)||
         empty($tglTransaksi)||empty($jnsPermintaan)||empty($stsBarang)||empty($jenisKoreksi)||empty($statusHistori)
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_gd_hasil" => $kdGdHasil,
                       "id_user" => $idUser,
                       "ukuran" => $ukuran,
                       "jumlah_berat" => $jumlahBerat,
                       "jumlah_lembar" => $jumlahLembar,
                       "warna" => $warna,
                       "customer" => $customer,
                       "bagian" => $bagian,
                       "tgl_transaksi" => $tglTransaksi,
                       "merek" => $merek,
                       "jns_permintaan" => $jnsPermintaan,
                       "sts_barang" => $stsBarang,
                       "sts_approve" => $stsApprove,
                       "status_history" => $statusHistori,
                       "keterangan_history" => $keteranganHistory,
                       "keterangan_barang" => $keteranganBarang,
                       "keterangan" => $keterangan);
        $result = $this->Gudang_Hasil_Model->insertTransaksiGudangHasil($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListKoreksiGudangBufferTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectListKoreksiGudangBufferTemp();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editKoreksiGudangBufferTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $kdGdHasil = $this->input->post("kdGdHasil");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $ukuran = $this->input->post("ukuran");
      $jumlahBerat = $this->input->post("jumlahBerat");#
      $jumlahLembar = $this->input->post("jumlahLembar");#
      $warna = $this->input->post("warna");
      $customer = strtoupper($this->session->userdata("fabricationGroup"));
      $bagian = $this->session->userdata("fabricationGroup");#
      $tglTransaksi = $this->input->post("tglTransaksi");#
      $merek = $this->input->post("merek");
      $jnsPermintaan = $this->input->post("jnsPermintaan");#
      $stsBarang = $this->input->post("stsBarang");#
      $stsApprove = "TRUE";#
      $jenisKoreksi = $this->input->post("jenisKoreksi");#
      $statusHistori = ($jenisKoreksi == "PLUS" ? "MASUK" : "KELUAR");#
      $keteranganHistory = "KOREKSI BARANG (".$jenisKoreksi.")";
      $keteranganBarang = "KOREKSI BARANG ".strtoupper($jnsPermintaan);
      $keterangan = strtoupper($this->input->post("keterangann"));

      if(empty($idUser)||$jumlahBerat==""||$jumlahLembar==""||empty($bagian)||
         empty($tglTransaksi)||empty($stsBarang)||empty($jenisKoreksi)||empty($statusHistori)
       ){
         echo "Data Kosong";
       }else{
         if(empty($kdGdHasil)){
           $data = array("id_permintaan_jadi" => $idTransaksi,
                         "id_user" => $idUser,
                         "jumlah_berat" => $jumlahBerat,
                         "jumlah_lembar" => $jumlahLembar,
                         "customer" => $customer,
                         "bagian" => $bagian,
                         "tgl_transaksi" => $tglTransaksi,
                         "sts_barang" => $stsBarang,
                         "sts_approve" => $stsApprove,
                         "status_history" => $statusHistori,
                         "keterangan_history" => $keteranganHistory,
                         "keterangan_barang" => $keteranganBarang,
                         "keterangan" => $keterangan);
         }else{
           $data = array("id_permintaan_jadi" => $idTransaksi,
                         "kd_gd_hasil" => $kdGdHasil,
                         "id_user" => $idUser,
                         "ukuran" => $ukuran,
                         "jumlah_berat" => $jumlahBerat,
                         "jumlah_lembar" => $jumlahLembar,
                         "warna" => $warna,
                         "customer" => $customer,
                         "bagian" => $bagian,
                         "tgl_transaksi" => $tglTransaksi,
                         "merek" => $merek,
                         "jns_permintaan" => $jnsPermintaan,
                         "sts_barang" => $stsBarang,
                         "sts_approve" => $stsApprove,
                         "status_history" => $statusHistori,
                         "keterangan_history" => $keteranganHistory,
                         "keterangan_barang" => $keteranganBarang,
                         "keterangan" => $keterangan);
         }
        $result = $this->Gudang_Hasil_Model->updateTransaksiGudangHasil($data);
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

  public function deleteAndRestoreTransaksiGudangBufferTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      $data = array("id_permintaan_jadi" => $idTransaksi,
                    "deleted" => $deleted);
      $result = $this->Gudang_Hasil_Model->updateTransaksiGudangHasil($data);
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

  public function saveKoreksiGudangBuffer(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = json_decode($this->Gudang_Hasil_Model->selectListKoreksiGudangBufferTemp(),TRUE);
      $jumlahData = count($result);
      $jumlahTerkirim = 0;
      if($jumlahData > 0){
        for ($i=0; $i < count($result); $i++) {
          $booleanResult = $this->Gudang_Hasil_Model->updateTransaksiGudangHasil(array("id_permintaan_jadi"=>$result[$i]["id_permintaan_jadi"], "status_transaksi"=>"FINISH"));
          if($booleanResult){
            $data = array("kdGdHasil" => $result[$i]["kd_gd_hasil"],
                          "tglAwal" => date("Y-m-t",strtotime("-1 months",strtotime(date("Y-m-d")))),
                          "tglAkhir" => date("Y-m-t",strtotime(date("Y-m-d")))
                         );
            $arrSaldo = json_decode($this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangHasil($data),TRUE);

            $dataForUpdateMaster = array("kd_gd_hasil" => $result[$i]["kd_gd_hasil"],
                                         "stok_berat" => str_replace(",","",$arrSaldo["saldoAkhirBerat"]),
                                         "stok_lembar" => str_replace(",","",$arrSaldo["saldoAkhirLembar"])
                                        );
            $booleanResultMaster = $this->Gudang_Hasil_Model->updateGudangHasil($dataForUpdateMaster);
            if($booleanResultMaster){
              $jumlahTerkirim++;
            }else{
              break;
              echo "BreakInMaster";
            }
          }else{
            break;
            echo "BreakInTransaction";
          }
        }
      }else{
        echo "Item Kosong";
      }
      if($jumlahTerkirim == $jumlahData){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListComboBoxCustom(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $ukuran = $this->input->post("ukuran");
      $warna = $this->input->post("warna");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $jnsBarang = $this->input->post("jnsBarang");

      if(empty($ukuran)||empty($warna)||empty($jnsPermintaan)||empty($jnsBarang)){
        echo "Data Kosong";
      }else{
        $data = array("ukuran" => $ukuran,
                      "warna_plastik" => $warna,
                      "jns_permintaan" => $jnsPermintaan,
                      "jns_brg" => $jnsBarang);
        $result = $this->Gudang_Hasil_Model->selectGudangHasilCustom($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveAddPengembalianKeGudangStandard(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGudangSablon = $this->input->post("kdGudangSablon");#
      $kdGudangStandard = $this->input->post("kdGudangStandard");#
      $idUser = $this->session->userdata("fabricationIdUser");#
      $ukuran = $this->input->post("ukuran");
      $jumlahBerat = $this->input->post("jumlahBerat");#
      $jumlahLembar = $this->input->post("jumlahLembar");#
      $warna = $this->input->post("warna");
      $namaCustomer = $this->input->post("namaCustomer");
      $bagian = strtoupper($this->session->userdata("fabricationGroup"));
      $tanggal = $this->input->post("tglTransaksi");#
      $merek = $this->input->post("merek");
      $jnsPermintaan = $this->input->post("jnsPermintaan");#
      $stsBarang = $this->input->post("stsBarang");#
      $stsApprove = "TRUE";
      $keteranganHistory = "PENGEMBALIAN BARANG";
      $keteranganBarang = "PENGEMBALIAN ".$stsBarang;
      $keterangan = $this->input->post("keterangan");

      if(empty($kdGudangSablon)||empty($kdGudangStandard)||empty($idUser)||empty($jumlahBerat)||
         empty($jumlahLembar)||empty($tanggal)||empty($jnsPermintaan)||empty($stsBarang)
       ){
         echo "Data Kosong";
       }else{
         $data = array("kd_gd_hasil" => $kdGudangSablon,
                       "kd_gd_hasil_secondary" => $kdGudangStandard,
                       "id_user" => $idUser,
                       "ukuran" => $ukuran,
                       "jumlah_berat" => $jumlahBerat,
                       "jumlah_lembar" => $jumlahLembar,
                       "warna" => $warna,
                       "customer" => $namaCustomer,
                       "bagian" => $bagian,
                       "tgl_transaksi" => $tanggal,
                       "merek" => $merek,
                       "jns_permintaan" => $jnsPermintaan,
                       "sts_barang" => $stsBarang,
                       "sts_approve" => $stsApprove,
                       "status_history" => "KELUAR",
                       "keterangan_history" => $keteranganHistory,
                       "keterangan_barang" => $keteranganBarang,
                       "keterangan" => $keterangan);

        $result = $this->Gudang_Hasil_Model->insertTransaksiGudangHasil($data);
        echo $result;
       }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPengembalianBarangGudangBufferKeStandardTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->selectListPengembalianBarangGudangBufferKeStandardTemp();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function savePengembalianKeGudangStandard(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrData = json_decode($this->Gudang_Hasil_Model->selectListPengembalianBarangGudangBufferKeStandardTemp(),TRUE);
      $jumlahData = count($arrData);
      $jumlahSelesai = 0;
      for ($i=0; $i < $jumlahData; $i++) {
        $booleanResult = $this->Gudang_Hasil_Model->updateTransaksiGudangHasil(array("id_permintaan_jadi"=>$arrData[$i]["id_permintaan_jadi"],"status_transaksi"=>"FINISH"));
        if($booleanResult){
          $dataGudangBuffer = array("kdGdHasil" => $arrData[$i]["kd_gd_hasil"],
                                    "tglAwal" => date("Y-m-t",strtotime("-1 months")),
                                    "tglAkhir" => date("Y-m-t")
                                  );# Data Untuk Menjumlahkan Saldo Akhir Dari Gudang Buffer Sablon
          # Proses Penghitungan Saldo Akhir
          $arrSaldoGudangBuffer  = json_decode($this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangHasilBuffer($dataGudangBuffer),TRUE);

          # Persiapan Data Untuk Update Stok Barang Master Seletelah Perhitungan Saldo Akhir
          $dataForUpdateMasterGudangBuffer = array("kd_gd_hasil" => $arrData[$i]["kd_gd_hasil"],
                                                   "stok_berat" => str_replace(",","",$arrSaldoGudangBuffer["saldoAkhirBerat"]),
                                                   "stok_lembar" => str_replace(",","",$arrSaldoGudangBuffer["saldoAkhirLembar"])
                                                  );
          $dataForInsertTransaksiGudangHasilStandard = array("kd_gd_hasil" => $arrData[$i]["kd_gd_hasil_secondary"],
                                                             "id_user" => $arrData[$i]["id_user"],
                                                             "ukuran" => $rrData[$i]["ukuran"],
                                                             "jumlah_berat" => $arrData[$i]["jumlah_berat"],
                                                             "jumlah_lembar" => $arrData[$i]["jumlah_lembar"],
                                                             "warna" => $arrData[$i]["warna"],
                                                             "customer" => $arrData[$i]["customer"],
                                                             "bagian" => $arrData[$i]["bagian"],
                                                             "tgl_transaksi" => $arrData[$i]["tgl_transaksi"],
                                                             "merek" => $arrData[$i]["merek"],
                                                             "jns_permintaan" => $arrData[$i]["jns_permintaan"],
                                                             "sts_barang" => "STANDARD",
                                                             "status_history" => "MASUK",
                                                             "status_transaksi" => "FINISH",
                                                             "keterangan_history" => "PENGEMBALIAN BARANG",
                                                             "keterangan_barang" => $arrData[$i]["keterangan_barang"],
                                                             "keterangan" => "PENGEMBALIAN DARI GUDANG BUFFER SABLON");

            $result = $this->Gudang_Hasil_Model->insertTransaksiGudangHasil($dataForInsertTransaksiGudangHasilStandard);
            if($result == "Berhasil"){
              #Proses Update Data Master
              $booleanResultGudangBuffer = $this->Gudang_Hasil_Model->updateGudangHasil($dataForUpdateMasterGudangBuffer);
            }else if($result == "Lock"){
              break;
              echo "Lock";
            }else{
              break;
              echo "Gagal";
            }

          if($booleanResultGudangBuffer){
            $jumlahSelesai++;
          }else{
            break;
            echo "UpdateMasterGagal";
          }
        }else{
          echo "UpdateTransaksiGagal";
        }
      }

      if($jumlahSelesai == $jumlahData){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListPengeluaranGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jnsBrg = $this->input->post("jnsBrg");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $data = array("jnsBrg" => $jnsBrg,
                    "jnsPermintaan" => $jnsPermintaan);
      echo $this->Gudang_Hasil_Model->selectListPengeluaranGudangHasil($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListKirimanDariBagian(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $stsBarang = $this->input->post("stsBarang");
      $bagian = $this->input->post("bagian");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $data = array("bagian" => $bagian,
                    "statusBarang" => $stsBarang,
                    "jnsPermintaan" => $jnsPermintaan);
      $result = $this->Gudang_Hasil_Model->selectListKirimanDariBagian($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveApproveKirimanDariBagian(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $stsBarang = $this->input->post("stsBarang");
      $bagian = $this->input->post("bagian");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $data = array("bagian" => $bagian,
                    "statusBarang" => $stsBarang,
                    "jnsPermintaan" => $jnsPermintaan);
      $result = $this->Gudang_Hasil_Model->updateApproveKirimanDariBagian($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListKirimanUntukBufferSablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $stsBarang = $this->input->post("stsBarang");
      $data = array("stsBarang" => $stsBarang);
      $result = $this->Gudang_Hasil_Model->selectListKirimanUntukBufferSablon($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveApproveKirimanUntukBufferSablon(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $stsBarang = $this->input->post("stsBarang");
      $data = array("stsBarang" => $stsBarang);
      $result = $this->Gudang_Hasil_Model->updateApproveKirimanUntukBufferSablon($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListKembalianHDSablon()
  {
    $result = $this->Gudang_Hasil_Model->getListKembalianHDSablon();
    echo $result;
  }

  public function approveKembalianHDSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->approveKembalianHDSablon();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListDataBarangRetur()
  {
    $stsBarang = $this->input->post("stsBarang");
    $result = $this->Gudang_Hasil_Model->getListDataBarangRetur($stsBarang);
    echo $result;
  }

  function approveReturBarang()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis  = $this->input->post("param");
      $result = $this->Gudang_Hasil_Model->approveReturBarang($jenis);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function countReturBarang()
  {
    $jenis  = $this->input->post("jenis");
    $result = $this->Gudang_Hasil_Model->countReturBarang($jenis);
    echo $result;
  }

  function getBahanSablon($jenis)
  {
    $key = $this->input->get("q");
    if(empty($key)){
      $result = $result = $this->Gudang_Hasil_Model->getBahanSablon(str_replace("%20", " ", $jenis));
      echo $result;
    }else{
      $result = $this->Gudang_Hasil_Model->searchBahanSablon($key,str_replace("%20", " ", $jenis));
      echo $result;
    }
  }

  function getBahanSablonFull($jenis)
  {
    $key = $this->input->get("q");
    if(empty($key)){
      $result = $result = $this->Gudang_Hasil_Model->getBahanSablonFull(str_replace("%20", " ", $jenis));
      echo $result;
    }else{
      $result = $this->Gudang_Hasil_Model->searchBahanSablonFull($key,str_replace("%20", " ", $jenis));
      echo $result;
    }
  }

  function genKodeBahanSablon()
  {
    $result = $this->Gudang_Hasil_Model->genKodeBahanSablon();
    echo $result;
  }

  function addBahanSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $bahan = explode(",", $this->input->post("nama"));
      $data = array();
      $data["kd_bahan_sablon"] = $this->input->post("kode");
      $data["kd_gd_bahan"] = $bahan[0];
      $data["nm_bahan"] = $bahan[1];
      $data["warna"] = $bahan[2];
      $data["status_barang"] = $bahan[3];
      $data["jenis"] = $bahan[4];
      $data["stok"] = $this->input->post("stok");
      $data["tanggal"] = $this->input->post("tgl");
      $result = $this->Gudang_Hasil_Model->addBahanSablon($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getTempDataBahanSablon()
  {
    $result = $this->Gudang_Hasil_Model->getTempDataBahanSablon();
    echo $result;
  }

  function countListTambahBahanSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->countListTambahBahanSablon();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function deleteListTempBahanSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Gudang_Hasil_Model->deleteListTempBahanSablon($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function saveBahanSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->saveBahanSablon();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListBahanSablon()
  {
    $result = $this->Gudang_Hasil_Model->getListBahanSablon();
    echo $result;
  }

  function countKirimanBahanSablon()
  {
    $result = $this->Gudang_Hasil_Model->countKirimanBahanSablon();
    echo $result;
  }

  function getDataKirimanBahanSablon()
  {
    $result = $this->Gudang_Hasil_Model->getDataKirimanBahanSablon();
    echo $result;
  }

  function approveKirimanBahanSablon()
  {
    $result = $this->Gudang_Hasil_Model->approveKirimanBahanSablon();
    echo $result;
  }

  function deleteBahanSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Gudang_Hasil_Model->deleteBahanSablon($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function editListBahanSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Gudang_Hasil_Model->getDataBahanSablonPerId($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function updateListBahanSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $stok = $this->input->post("stok");
      $result = $this->Gudang_Hasil_Model->updateListBahanSablon($id,$stok);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListHistoryBahanSablonKeluar()
  {
    $data = array();
    $data["tglAwal"]  = $this->input->post("tglAwal");
    $data["tglAkhir"] = $this->input->post("tglAkhir");
    $data["nm_bahan"] = $this->input->post("nm_bahan");

    $result = $this->Gudang_Hasil_Model->getListHistoryBahanSablonKeluar($data);
    echo $result;
  }

  function getListHistoryBahanSablonMasuk()
  {
    $data = array();
    $data["tglAwal"]  = $this->input->post("tglAwal");
    $data["tglAkhir"] = $this->input->post("tglAkhir");
    $data["nm_bahan"] = $this->input->post("nm_bahan");

    $result = $this->Gudang_Hasil_Model->getListHistoryBahanSablonMasuk($data);
    echo $result;
  }

  function getDetailHistoryBahanSablon()
  {
    $data = array();
    $data["tglAwal"]  = $this->input->post("tglAwal");
    $data["tglAkhir"] = $this->input->post("tglAkhir");
    $data["nm_bahan"] = $this->input->post("bahan");

    $result = $this->Gudang_Hasil_Model->getDetailHistoryBahanSablon($data);
    echo $result;
  }

  function addPermintaanBahanSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = $this->input->post("jenis");
      $data = array();
      $data["kd_gd_bahan"] = $this->input->post("nmBahan");
      $data["id_user"]     = $this->session->userdata("fabricationIdUser");
      $data["jumlah_permintaan"] = $this->input->post("jumlah");
      $data["tgl_permintaan"] = $this->input->post("tanggal");
      $data["bagian"] = "SABLON";
      $data["status_history"] = "KELUAR";
      if ($jenis == "Minyak") {
        $data["keterangan_history"] = "PENGELUARAN (PENGAMBILAN SABLON (HAPUS CETAKAN))";
      }else{
        $data["keterangan_history"] = "PENGELUARAN KE SABLON";
      }
      $result = $this->Gudang_Hasil_Model->addPermintaanBahanSablon($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getPermintaanBahanSablon($jenis)
  {
    $key = $this->input->get("q");
    if(empty($key)){
      $result = $result = $this->Gudang_Hasil_Model->getPermintaanBahanSablon(str_replace("%20", " ", $jenis));
      echo $result;
    }else{
      $result = $this->Gudang_Hasil_Model->searchPermintaanBahanSablon($key,str_replace("%20", " ", $jenis));
      echo $result;
    }
  }

  function getTempDataPermintaanBahanSablon()
  {
    $result = $this->Gudang_Hasil_Model->getTempDataPermintaanBahanSablon();
    echo $result;
  }

  function countPermintaanBahanSablonPending()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->countPermintaanBahanSablonPending();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function deleteListPermintaanBahanSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Gudang_Hasil_Model->deleteListPermintaanBahanSablon($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }


  function kirimPermintaanBahanSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->kirimPermintaanBahanSablon();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function deletedListRetur()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Gudang_Hasil_Model->deletedListRetur($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getListDetailHasilJadi()
  {
    $tglAwal  = $this->input->post("tglAwal");
    $tglAkhir = $this->input->post("tglAkhir");
    $result = $this->Gudang_Hasil_Model->getListDetailHasilJadi($tglAwal,$tglAkhir);
    echo $result;
  }

  function getKirimanPotongPerId()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Gudang_Hasil_Model->getKirimanPotongPerId($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function kirimBalikKiriman()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $note = $this->input->post("note");
      $result = $this->Gudang_Hasil_Model->kirimBalikKiriman($id,$note);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function countKirimanBarangKeGudangBuffer()
  {
    $result = $this->Gudang_Hasil_Model->countKirimanBarangKeGudangBuffer();
    echo $result;
  }

  function countKirimanBarang()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["stsBarang"] = $this->input->post("stsBarang");
      $data["bagian"]    = $this->input->post("bagian");
      $data["jnsPermintaan"] = $this->input->post("jnsPermintaan");

      $result = $this->Gudang_Hasil_Model->countKirimanBarang($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function countKembalianHDSablon()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Gudang_Hasil_Model->countKembalianHDSablon();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailDataOrderTerkirim(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $result = $this->Gudang_Hasil_Model->selectDetailDataOrderTerkirim($idTransaksi);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function updateDataOrderTerkirim()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["id"] = $this->input->post("id");
      $data["jumlah_berat"]  = str_replace(",", "",  $this->input->post("jumlah_berat"));
      $data["jumlah_lembar"] = str_replace(",", "", $this->input->post("jumlah_lembar"));
      $data["jumlah_kirim"]  = $this->input->post("jumlah_kirim");
      $data["jumlah_sebelum"]= $this->input->post("jumlah_sebelum");
      $result = $this->Gudang_Hasil_Model->updateDataOrderTerkirim($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function deleteDataOrderTerkirim()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $id = $this->input->post("id");
      $result = $this->Gudang_Hasil_Model->deleteDataOrderTerkirim($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function updateStatus()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $id = $this->input->post("id");
      $status = $this->input->post("status");
      $result = $this->Gudang_Hasil_Model->updateStatus($id,$status);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getDataStokMaster()
  {
    $kd_gd_hasil = $this->input->post("kdGdHasil");
    $result = $this->Gudang_Hasil_Model->selectDataStokMaster($kd_gd_hasil);
    echo $result;
  }

  public function getListGudangBahanDatatable(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = str_replace("_"," ",$this->input->post("jenis"));
      $result = $this->Gudang_Hasil_Model->selectListGudangBahanDatatable($param);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getGeneratedGudangBahanCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result["Code"] = $this->Gudang_Hasil_Model->generateGudangBahanCode();
      echo json_encode($result);
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
      $nama = "GUDANG HASIL";
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
        $result = $this->Gudang_Hasil_Model->insertGudangBahan($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailBarangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGudangBahan = $this->input->post("kd_gd_bahan");
      $result = $this->Gudang_Hasil_Model->selectDetailBarangBahan($kdGudangBahan);
      echo $result;
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
        $result = $this->Gudang_Hasil_Model->updateGudangBahan($data);
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
      $result = $this->Gudang_Hasil_Model->updateGudangBahan($data);
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

  public function getGeneratedRequestCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrData["Code"] = $this->Gudang_Hasil_Model->generateKodePermintaan();
      echo json_encode($arrData);
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
        $result = $this->Gudang_Hasil_Model->selectComboBoxValueBahanSearch($data);
      }else{
        $data = array("jenis"=>str_replace("_"," ",$param),
        "key"=>"");
        $result = $this->Gudang_Hasil_Model->selectComboBoxValueBahan($data);
      }
      echo $result;
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
          $result = $this->Gudang_Hasil_Model->insertPermintaanBarang($data[$i]);
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
        $result = $this->Gudang_Hasil_Model->selectListHistoryGudangBahan($data);
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
        $result = $this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangBahan($data);
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
      $result = $this->Gudang_Hasil_Model->selectKoreksiGudangBahan($jenis);
      echo json_encode($result);
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
      $bagian = "GUDANG HASIL";
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
                         "bagian"=>$bagian,
                         "nama"=>$bagian,
                         );
          $result = $this->Gudang_Hasil_Model->insertTransaksiGudangBahan($data);
          echo $result;
         }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailKoreksi(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $result = $this->Gudang_Hasil_Model->selectDetailTransaksiGudangBahan($idTransaksi);
      echo $result;
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
      $bagian = "GUDANG HASIL";
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
                           "bagian"=>$bagian,
                           "nama"=>$bagian,
                         );
           }else{
             $data = array("id"=>$id,
                           "kd_gd_bahan"=>$kdGdBahan,
                           "id_user"=>$idUser,
                           "tgl_permintaan"=>$tanggal,
                           "jumlah_permintaan"=>$jumlahKoreksi,
                           "keterangan_history"=>$keteranganHistory,
                           "status_history"=>$statusHistory,
                           "bagian"=>$bagian,
                           "nama"=>$bagian,
                         );
           }
          $result = $this->Gudang_Hasil_Model->updateTransaksiGudangBahan($data);
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

  public function deleteTransaksiGudangBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = $this->input->post("id");
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = date("Y-m-d");
      $kdGdBahan = $this->input->post("kdGdBahan");
      $data = array("id"=>$param,
                    "deleted"=>"TRUE");
      $result = $this->Gudang_Hasil_Model->updateTransaksiGudangBahan($data);
      if($result){
        $data2 = array("kdGdBahan"=>$kdGdBahan,
                       "tglAwal"=>$tglAwal,
                       "tglAkhir"=>$tglAkhir);
        $saldo = json_decode($this->Gudang_Hasil_Model->selectSaldoAwalBulanGudangBahan($data2),TRUE);
        $result2 = $this->Gudang_Hasil_Model->updateGudangBahan(array("kd_gd_bahan"=>$kdGdBahan,"stok"=>str_replace(",","",$saldo["saldoAkhir"])));
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

  public function getPengeluaranGudangBahanTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = str_replace("_"," ",$this->input->post("jenis"));
      $result = $this->Gudang_Hasil_Model->selectPengeluaranGudangBahan($jenis);
      echo json_encode($result);
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
      $bagian = "GUDANG HASIL";
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
        $result = $this->Gudang_Hasil_Model->insertTransaksiGudangBahan($data);
        echo $result;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailPengeluaran(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("id");
      $result = $this->Gudang_Hasil_Model->selectDetailTransaksiGudangBahan($idTransaksi);
      echo $result;
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
      $bagian = "GUDANG HASIL";
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
        $result = $this->Gudang_Hasil_Model->updateTransaksiGudangBahan($data);
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
      $result = $this->Gudang_Hasil_Model->selectPengeluaranGudangBahan($jenis);
      if(empty($result)){
        echo "Data Kosong";
      }else{
        foreach($result as $arrResult){
          $data = array("id" => $arrResult["id"],
                        "kdGdBahan" => $arrResult["kd_gd_bahan"],
                        "jumlah" => str_replace(",","",$arrResult["jumlah_permintaan"]),
                        "statusHistory" => $arrResult["status_history"],
                        "status" => "FINISH");
          $response = $this->Gudang_Hasil_Model->updateTransaksiGudangBahanAndStok($data);
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

  public function saveKoreksi(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis = str_replace("_"," ",$this->input->post("jenis"));
      $result = $this->Gudang_Hasil_Model->selectKoreksiGudangBahan($jenis);
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
          $response = $this->Gudang_Hasil_Model->updateTransaksiGudangBahanAndStok($data);
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

  public function getCountAlert(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $bagian = $this->input->post("bagian");
      $jenis = $this->input->post("jenis");
      $data = array("bagian"=>$bagian,
                    "jenis"=>$jenis);
      $result = $this->Gudang_Hasil_Model->selectCountAlert($data);
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
      $result = $this->Gudang_Hasil_Model->selectCountAlertPembelianGudangBahan($jenis);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function countPermintaanCatSablon(){
    $result = $this->Gudang_Hasil_Model->countPermintaanCatSablon();
    echo $result;
  }

  public function getPermintaanBarang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $bagian = $this->session->userdata("fabricationGroup");
      $data = array("idUser" => $idUser,
                    "bagian" => $bagian);
      $result = $this->Gudang_Hasil_Model->selectPermintaanBarang($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function printBonPermintaanBarang($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("DataPermintaan" => $this->Gudang_Hasil_Model->selectPermintaanBarang_Print($param),
                    "DataDetailPermintaan" => $this->Gudang_Hasil_Model->selectDetailPermintaanBaru_Print($param));
      $this->load->view("frm_print_bon_permintaan_barang",$data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailPermintaanBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idPermintaan = $this->input->post("idPermintaan");
      $idUser = $this->session->userdata("fabricationIdUser");
      $bagian = $this->session->userdata("fabricationGroup");
      $data = array("idUser" => $idUser,
                    "bagian" => $bagian,
                    "idPermintaan" => $idPermintaan);
      $result = $this->Gudang_Hasil_Model->selectDetailPermintaanBaru($data);
      echo $result;
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
      $arrData = $this->Gudang_Hasil_Model->selectDataPermintaanUntukInputTransaksiGudangBahan($idDPB);
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
      $result = $this->Gudang_Hasil_Model->updateTerimaBarangFull($Data);
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
      $arrData = $this->Gudang_Hasil_Model->selectDataPermintaanUntukInputTransaksiGudangBahan($idDPB);
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
      $result = $this->Gudang_Hasil_Model->updateTerimaBarangSetengah($Data);
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
      $result = $this->Gudang_Hasil_Model->updateSelesaiPermintaan($data);
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

  public function deleteAndRestorePermintaanBarang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $deleted = $this->input->post("deleted");
      $data = array("kd_permintaan_barang" => $idTransaksi,
                    "deleted" => $deleted);
      $result = $this->Gudang_Hasil_Model->updateDeleteAndRestorePermintaanBarang($data);
      echo $result;
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
        $result = $this->Gudang_Hasil_Model->selectTransaksiGudangBahanForApproveDataTable($data);
        echo $result;
      }
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
        $result = $this->Gudang_Hasil_Model->selectGudangBahanDataForApprove($data);
        if(empty($result)){
          echo "Item Kosong";
        }else{
          for ($i=0; $i < count($result); $i++) {
            $param = array("id"=>$result[$i]["id"],
                           "kdGdBahan"=>$result[$i]["kd_gd_bahan"],
                           "jumlah"=>$result[$i]["jumlah_permintaan"],
                           "statusHistory"=>$result[$i]["status_history"],
                           "status"=>"FINISH");
            $result2 = $this->Gudang_Hasil_Model->updateTransaksiGudangBahanAndStok($param);
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

  public function getListDataAwalPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $jenis = $this->input->post("jenis");
      $data = array("idUser" => $idUser,
                    "jenis" => $jenis);
      $result = $this->Gudang_Hasil_Model->selectListDataAwalPending($data);
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
        $result = $this->Gudang_Hasil_Model->insertDataAwalPending($data);
        echo $result;
      }
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

      $result = $this->Gudang_Hasil_Model->updateTransaksiGudangBahan($data);
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
      $data = json_decode($this->Gudang_Hasil_Model->selectListDataAwalPending($param),TRUE);
      $data2 = array();
      foreach ($data as $arrData) {
        $tempData = array("jumlah" => $arrData["jumlah_permintaan"],
                          "kd_gd_bahan" => $arrData["kd_gd_bahan"]);
        array_push($data2,$tempData);
      }
      $result = $this->Gudang_Hasil_Model->updateStokDataAwalBaru($data2);
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
      $result = $this->Gudang_Hasil_Model->selectDetailDataAwal($kdGdBahan);
      echo $result;
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

      $data = json_decode($this->Gudang_Hasil_Model->selectDetailDataAwal($kdBarang),TRUE);

      $data2 = array("id" => $idTransaksi,
                     "kd_gd_bahan" => $kdBarang,
                     "jumlah" => $jumlahBaru - $data[0]["jumlah_permintaan"],
                     "jumlahBaru" => $jumlahBaru);
      $result = $this->Gudang_Hasil_Model->updateStokDataAwalLama($data2);

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

  public function getCekKartuStok(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $stsBarang = $this->input->post("stsBarang");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "stsBarang" => $stsBarang);
      if($stsBarang != "SABLON_POLOS"){
        $result = $this->Gudang_Hasil_Model->selectCekKartuStok($data);
      }else{
        $result = "";
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailDataAwalGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdHasil = $this->input->post("kdGdHasil");
      $result = $this->Gudang_Hasil_Model->selectDetailDataAwalGudangHasil($kdGdHasil);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getListDataAwalGudangHasilPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $stsBarang = $this->input->post("stsBarang");
      $result = $this->Gudang_Hasil_Model->selectListDataAwalGudangHasilPending($stsBarang);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function addDataAwalGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdGdHasil = $this->input->post("kdGdHasil");
      $ukuran = $this->input->post("ukuran");
      $warna = $this->input->post("warna");
      $merek = $this->input->post("merek");
      $jnsPermintaan = $this->input->post("jnsPermintaan");
      $stsBarang = $this->input->post("stsBarang");
      $jumlahBerat = $this->input->post("jumlahBerat");
      $jumlahLembar = $this->input->post("jumlahLembar");
      $idUser = $this->session->userdata("fabricationIdUser");
      $customer = strtoupper($this->session->userdata("fabricationGroup"));
      $tglTransaksi = "2015-09-30";
      if(empty($kdGdHasil) || empty($jumlahBerat) || empty($jumlahLembar)){
        echo "Data Kosong";
      }else{
        $data = array("kd_gd_hasil" => $kdGdHasil,
                      "id_user" => $idUser,
                      "ukuran" => $ukuran,
                      "jumlah_berat" => $jumlahBerat,
                      "jumlah_lembar" => $jumlahLembar,
                      "warna" => $warna,
                      "customer" => $customer,
                      "bagian" => $customer,
                      "tgl_transaksi" => $tglTransaksi,
                      "merek" => $merek,
                      "jns_permintaan" => $jnsPermintaan,
                      "sts_barang" => $stsBarang,
                      "sts_approve" => "TRUE",
                      "status_history" => "MASUK",
                      "keterangan_history" => "DATA AWAL",
                      "keterangan" => strtolower($jnsPermintaan)
                    );
        $result = $this->Gudang_Hasil_Model->insertDataAwalGudangHasilPending($data);
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

  public function saveDataAwalGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $stsBarang = $this->input->post("stsBarang");
      $arrData = array();
      $arrResult = json_decode($this->Gudang_Hasil_Model->selectListDataAwalGudangHasilPending($stsBarang), TRUE);
      if(count($arrResult) <= 0){
        echo "Data Kosong";
      }else{
        foreach ($arrResult as $arrValue) {
          $tempArray = array("kd_gd_hasil" => $arrValue["kd_gd_hasil"],
                             "stok_berat" => $arrValue["jumlah_berat"],
                             "stok_lembar" => $arrValue["jumlah_lembar"]);
          array_push($arrData, $tempArray);
        }
        $result = $this->Gudang_Hasil_Model->updateStokDataAwalGudangHasilBaru($arrData);
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

  public function deleteAndRestoreDataAwalGudangHasilPending(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $idTransaksi = $this->input->post("id");
      $deleted = $this->input->post("deleted");

      $data = array("id_user" => $idUser,
                    "id_permintaan_jadi" => $idTransaksi,
                    "deleted" => $deleted);

      $result = $this->Gudang_Hasil_Model->updateTransaksiGudangHasil($data);
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

  public function editDataAwalGudangHasil(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idTransaksi = $this->input->post("idTransaksi");
      $kdBarang = $this->input->post("kdBarang");
      $jumlahBerat = $this->input->post("jumlahBerat");
      $jumlahLembar = $this->input->post("jumlahLembar");
      $idUser = $this->session->userdata("fabricationIdUser");

      $arrResult = json_decode($this->Gudang_Hasil_Model->selectDetailDataAwalGudangHasil($kdBarang), TRUE);

      $arrData = array("id_permintaan_jadi" => $idTransaksi,
                       "kd_gd_hasil" => $kdBarang,
                       "jumlah_berat" => $jumlahBerat - $arrResult[0]["jumlah_berat"],
                       "jumlah_lembar" => $jumlahLembar - $arrResult[0]["jumlah_lembar"],
                       "jumlahBeratBaru" => $jumlahBerat,
                       "jumlahLembarBaru" => $jumlahLembar,
                       "idUser" => $idUser);
      $result = $this->Gudang_Hasil_Model->updateStokDataAwalGudangHasilLama($arrData);
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

  public function getCekKartuStokSort(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tglAwal = $this->input->post("tglAwal");
      $tglAkhir = $this->input->post("tglAkhir");
      $stsBarang = $this->input->post("stsBarang");
      $havingStokMaster = $this->input->post("havingStokMaster");
      $havingStokAwal = $this->input->post("havingStokAwal");
      $havingStokAkhir = $this->input->post("havingStokAkhir");
      $data = array("tglAwal" => $tglAwal,
                    "tglAkhir" => $tglAkhir,
                    "stsBarang" => $stsBarang,
                    "havingStokMaster" => $havingStokMaster,
                    "havingStokAwal" => $havingStokAwal,
                    "havingStokAkhir" => $havingStokAkhir);
      if($stsBarang != "SABLON_POLOS"){
        $result = $this->Gudang_Hasil_Model->selectCekKartuStokSort($data);
      }else{
        $result = "";
      }
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
}
?>
