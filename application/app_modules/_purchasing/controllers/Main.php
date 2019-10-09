<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{

	function __construct()
	{
		parent:: __construct();
		$this->load->model("Purchase_Model");
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
	       ($this->session->userdata("fabricationGroup")=="purchasing"||
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
		  array("Content"=>"Stok Bahan Baku","Link"=>"_purchasing/main/master_bahan_baku","Name"=>"Master_Bahan_Baku","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
		  array("Content"=>"Stok Biji Warna","Link"=>"_purchasing/main/master_biji_warna","Name"=>"Master_Biji_Warna","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
		  array("Content"=>"Stok Minyak","Link"=>"_purchasing/main/master_minyak","Name"=>"Master_Minyak","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
		  array("Content"=>"Stok Cat Murni","Link"=>"_purchasing/main/master_cat_murni","Name"=>"Master_Cat_Murni","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
		  array("Content"=>"Stok Cat Campur","Link"=>"_purchasing/main/master_cat_campur","Name"=>"Master_Cat_Campur","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
		  array("Content"=>"Stok Apal","Link"=>"_purchasing/main/master_apal","Name"=>"Master_Apal","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
		  array("Content"=>"Spare Part","Link"=>"_purchasing/main/master_sparepart","Name"=>"Master_SparePart","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
			array("Content"=>"Permintaan Barang","Link"=>"_purchasing/main/permintaan_barang","Name"=>"Permintaan_Barang","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"Permintaan_Barang"),
			array("Content"=>"Bukti Penerimaan","Link"=>"_purchasing/main/bukti_penerimaan","Name"=>"Bukti_Penerimaan","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"M_Bukti_Penerimaan")
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

	function master_bahan_baku(){
		$isLogin = $this->isLogin();
		if($isLogin){
    	$data["Data"] = array("Title"=>"Stok Bahan Baku");
	    $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
    	$this->load->view("header");
    	$this->load->view("sidebar",$this->checkStatus());
    	$this->load->view("frm_data_stok_bahanbaku",$data);
    	$this->load->view("footer");
   	}else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
   	}
	}

	function getDataMasterBahanBaku(){
		$result = $this->Purchase_Model->getDataMasterBahanBaku();
		echo $result;
	}

	function master_biji_warna(){
		$isLogin = $this->isLogin();
		if($isLogin){
    	$data["Data"] = array("Title"=>"Stok Biji Warna");
	    $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
    	$this->load->view("header");
    	$this->load->view("sidebar",$this->checkStatus());
    	$this->load->view("frm_data_stok_biji_warna",$data);
    	$this->load->view("footer");
   	}else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
   	}
	}

	function getDataMasterBijiWarna(){
		$result = $this->Purchase_Model->getDataMasterBijiWarna();
		echo $result;
	}

	function master_minyak(){
		$isLogin = $this->isLogin();
		if($isLogin){
    	$data["Data"] = array("Title"=>"Stok Minyak");
	    $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
  		$this->load->view("header");
  		$this->load->view("sidebar",$this->checkStatus());
  		$this->load->view("frm_data_stok_minyak",$data);
  		$this->load->view("footer");
   	}else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
   	}
	}

	function getDataMasterMinyak(){
		$result = $this->Purchase_Model->getDataMasterMinyak();
		echo $result;
	}

	function master_cat_murni(){
		$isLogin = $this->isLogin();
		if($isLogin){
    	$data["Data"] = array("Title"=>"Stok Cat Murni");
	    $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
  		$this->load->view("header");
  		$this->load->view("sidebar",$this->checkStatus());
  		$this->load->view("frm_data_stok_cat_murni",$data);
  		$this->load->view("footer");
   	}else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
   	}
	}

	function getDataMasterCatMurni(){
		$result = $this->Purchase_Model->getDataMasterCatMurni();
		echo $result;
	}

	function master_cat_campur(){
		$isLogin = $this->isLogin();
		if($isLogin){
    	$data["Data"] = array("Title"=>"Stok Cat Campur");
	    $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
  		$this->load->view("header");
  		$this->load->view("sidebar",$this->checkStatus());
  		$this->load->view("frm_data_stok_cat_campur",$data);
  		$this->load->view("footer");
   	}else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
   	}
	}

	function getDataMasterCatCampur(){
		$result = $this->Purchase_Model->getDataMasterCatCampur();
		echo $result;
	}

	function master_apal(){
		$isLogin = $this->isLogin();
		if($isLogin){
    	$data["Data"] = array("Title"=>"Stok Apal");
    	$data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
    	$this->load->view("header");
    	$this->load->view("sidebar",$this->checkStatus());
    	$this->load->view("frm_data_stok_apal",$data);
    	$this->load->view("footer");
   	}else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
   	}
	}

	function getDataMasterApal(){
		$result = $this->Purchase_Model->getDataMasterApal();
		echo $result;
	}

	function master_sparepart(){
		$isLogin = $this->isLogin();
		if($isLogin){
    	$data["Data"] = array("Title"=>"Spare Part");
  		$data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
  		$this->load->view("header");
  		$this->load->view("sidebar",$this->checkStatus());
  		$this->load->view("frm_data_sparepart",$data);
  		$this->load->view("footer");
   	}else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
   	}
	}

	function bukti_penerimaan(){
		$isLogin = $this->isLogin();
		if($isLogin){
    	$data["Data"] = array("Title"=>"Bukti Penerimaan");
  		$data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
  		$this->load->view("header");
  		$this->load->view("sidebar",$this->checkStatus());
  		$this->load->view("frm_penerimaan_barang",$data);
  		$this->load->view("footer");
   	}else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
   	}
	}

	function getDataMasterSparePart(){
		$result = $this->Purchase_Model->getDataMasterSparePart();
		echo $result;
	}

	function listPermintaanPembelianBarang(){
		$isLogin = $this->isLogin();
		if($isLogin){
      	$param  = $this->input->post("param");
      	$result = $this->Purchase_Model->getPermintaanBarang($param);
      	echo $result;
   	}else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
   	}
	}

  function listPermintaanPembelianSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
        $result = $this->Purchase_Model->getPermintaanSparePart();
        echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function updatePermintaanSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $jumlah = $this->input->post("jumlah");
      $result = $this->Purchase_Model->updatePermintaanSparePart($id,$jumlah);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

	function checkPermintaanBahan(){
		$result = $this->Purchase_Model->checkPermintaanBahan();
		echo $result;
	}

	function deletePermintaanBahan(){
		$isLogin = $this->isLogin();
		if($isLogin){
      	$id = $this->input->post("id");
      	$result = $this->Purchase_Model->deletePermintaanBahan($id);
      	echo $result;
   	}else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
   	}
	}

  function deletePermintaanSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
        $id = $this->input->post("id");
        $result = $this->Purchase_Model->deletePermintaanSparePart($id);
        echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

	function updatePermintaanBahan(){
		$isLogin = $this->isLogin();
		if($isLogin){
      	$id = $this->input->post("id");
      	$jumlah = $this->input->post("jumlah");
      	$result = $this->Purchase_Model->updatePermintaanBahan($id,$jumlah);
      	echo $result;
   	}else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
   	}
	}

	function approvePermintaanBahan(){
		$isLogin = $this->isLogin();
		if($isLogin){
    	$param = $this->input->post("param");
    	$result = $this->Purchase_Model->approvePermintaanBahan($param);
    	echo $result;
   	}else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
   	}
	}

  function approve_permintaan_sp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Purchase_Model->approvePermintaanSparePart();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

	function checkRencanaPembelianBahan(){
		$param  = $this->input->post("param");
		$result = $this->Purchase_Model->checkRencanaPembelianBahan($param);
		echo $result;
	}

  function listRencanaPembelianBarang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param  = $this->input->post("param");
      $result = $this->Purchase_Model->getRencanaPembelianBarang($param);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getRencanaPembelianBahanPerId(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id  = $this->input->post("id");
      $result = $this->Purchase_Model->getRencanaPembelianBahanPerId($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function kirimHasilPembelianBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data['id']  = $this->input->post("id");
      $data['tgl_pembelian'] = $this->input->post("tgl_pembelian");
      $data['jum_pembelian'] = $this->input->post("jum_pembelian");
      $result = $this->Purchase_Model->kirimHasilPembelianBahan($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getBahanBaku(){
    $key = $this->input->get("q");
    if(empty($key)){
      $result = $result = $this->Purchase_Model->getBahanBaku();
      echo $result;
    }else{
      $result = $this->Purchase_Model->searchBahanBaku($key);
      echo $result;
    }
  }

  function getBijiWarna(){
    $key = $this->input->get("q");
    if(empty($key)){
      $result = $result = $this->Purchase_Model->getBijiWarna();
      echo $result;
    }else{
      $result = $this->Purchase_Model->searchBijiWarna($key);
      echo $result;
    }
  }

  function simpanRencanaPembelianBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
        $data = array();
        $data['kd_gd_bahan']       = $this->input->post("nm_barang");
        $data['id_user']           = $this->session->userdata("fabricationIdUser");
        $data['nama']              = $this->input->post("customer");
        $data['jumlah_permintaan'] = $this->input->post("jumlah");
        $data['tgl_permintaan']    = $this->input->post("tanggal");
        $data['bagian']            = "PURCHASING";
        $data['status']            = "PROGRESS";
        $data['status_history']    = "MASUK";
        $data['keterangan_history']= "PEMBELIAN BARANG";

        $result = $this->Purchase_Model->simpanRencanaPembelianBahan($data);
        echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function getGeneratedGudangBahanCode(){
    $result = $this->Purchase_Model->generateGudangBahanCode();
    echo $result;
  }

  function addBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data['kd_gd_bahan']  = $this->input->post("kd_bahan");
      $data['id_user']      = $this->session->userdata("fabricationIdUser");
      $data['kd_accurate']  = $this->input->post("kd_accurate");
      $data['nm_barang']    = $this->input->post("nm_barang");
      $data['stok']         = $this->input->post("stok");
      $data['satuan']       = $this->input->post("satuan");
      $data['warna']        = $this->input->post("warna");
      $data['tgl_masuk']    = $this->input->post("tanggal");
      $data['status']       = $this->input->post("status");
      $data['jenis']        = $this->input->post("jenis");
      $result = $this->Purchase_Model->addBahanBaku($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function deleteStokBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id  = $this->input->post("id");
      $result = $this->Purchase_Model->deleteStokBahan($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getDataStokBahanPerId(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id  = $this->input->post("id");
      $result = $this->Purchase_Model->getDataStokBahanPerId($id);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function updateStokBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["kd_gd_bahan"] = $this->input->post("kd_bahan");
      $data["nm_barang"]   = $this->input->post("nm_barang");
      $data["warna"]       = $this->input->post("warna");
      $data["stok"]        = $this->input->post("stok");
      $result = $this->Purchase_Model->updateStokBahan($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function listPermintaanPembelianBijiWarna(){
    $isLogin = $this->isLogin();
    if($isLogin){
        $param  = $this->input->post("param");
        $result = $this->Purchase_Model->getPermintaanBijiWarna($param);
        echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function getMinyak(){
    $key = $this->input->get("q");
    if(empty($key)){
      $result = $result = $this->Purchase_Model->getMinyak();
      echo $result;
    }else{
      $result = $this->Purchase_Model->searchMinyak($key);
      echo $result;
    }
  }

  function getCatMurni(){
    $key = $this->input->get("q");
    if(empty($key)){
      $result = $result = $this->Purchase_Model->getCatMurni();
      echo $result;
    }else{
      $result = $this->Purchase_Model->searchCatMurni($key);
      echo $result;
    }
  }

  function getCatCampur(){
    $key = $this->input->get("q");
    if(empty($key)){
      $result = $result = $this->Purchase_Model->getCatCampur();
      echo $result;
    }else{
      $result = $this->Purchase_Model->searchCatCampur($key);
      echo $result;
    }
  }

  function checkStokSparePart(){
    $result = $this->Purchase_Model->checkStokSparePart();
    echo $result;
  }

  function getLowStockSparePart(){
    $result = $this->Purchase_Model->getLowStockSparePart();
    echo $result;
  }

  function simpanRencanaPembelianSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["kd_spare_part"] = $this->input->post("kd_spare_part");
      $data["id_user"]       = $this->session->userdata("fabricationIdUser");
      $data["tgl_transaksi"] = $this->input->post("tanggal");
      $data["jumlah"]        = $this->input->post("jumlah");
      $data["keterangan_history"] = "PEMBELIAN SPARE PART";
      $data["sts_history"]   = "MASUK";
      $data["sts_transaksi"] = "OPEN";

      $result = $this->Purchase_Model->simpanRencanaPembelianSparePart($data);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function checkPermintaanSparePart(){
    $result = $this->Purchase_Model->checkPermintaanSparePart();
    echo $result;
  }

  function checkRencanaPembelianSparePart(){
    $result = $this->Purchase_Model->checkRencanaPembelianSparePart();
    echo $result;
  }

  function getListRencanaSparePart(){
    $result = $this->Purchase_Model->getListRencanaSparePart();
    echo $result;
  }

  function deleteRencanaPembelianSparePart(){
    $id = $this->input->post("id");
    $result = $this->Purchase_Model->deleteRencanaPembelianSparePart($id);
    echo $result;
  }

  function getDataRencanaPembelianSparePartPerId(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Purchase_Model->getDataRencanaPembelianSparePartPerId($id);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function kirimHasilPembelianSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data['id'] = $this->input->post("id");
      $data['tanggal'] = $this->input->post("tanggal");
      $data['jumlah']  = $this->input->post("jumlah");
      $result = $this->Purchase_Model->kirimHasilPembelianSparePart($data);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function getCodeSparePart(){
    $result = $this->Purchase_Model->generateGudangSparePartCode();
    echo $result;
  }

  function add_SparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data['kd_spare_part'] = $this->input->post("kd_spare_part");
      $data['id_user']       = $this->session->userdata("fabricationIdUser");
      $data['kd_accurate']   = $this->input->post("kd_accurate");
      $data['nm_spare_part'] = $this->input->post("nm_sparepart");
      $data['kode']          = $this->input->post("kode");
      $data['ukuran']        = $this->input->post("ukuran");
      $data['stok']          = $this->input->post("stok");
      $data['stok_aktual']   = $this->input->post("stok");
      $data['tgl_masuk']     = $this->input->post("tanggal");

      $result = $this->Purchase_Model->add_SparePart($data);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function deleteSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Purchase_Model->deleteSparePart($id);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function getStokSparePartPerId(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Purchase_Model->getStokSparePartPerId($id);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function updateStokSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array();
      $data["kd_spare_part"] = $this->input->post("kd_spare_part");
      $data["nm_spare_part"] = $this->input->post("nm_spare_part");
      $data["ukuran"]        = $this->input->post("ukuran");
      $data["stok_sekarang"] = $this->input->post("stok_sekarang");
      $data["stok_awal"]     = $this->input->post("stok_awal");
      $data["kode"]          = $this->input->post("kode");
      $result = $this->Purchase_Model->updateStokSparePart($data);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function getSparePart(){
    $key = $this->input->get("q");
    if(empty($key)){
      $result = $result = $this->Purchase_Model->getSparePart();
      echo $result;
    }else{
      $result = $this->Purchase_Model->searchSparePart($key);
      echo $result;
    }
  }

  function getHistoryBahanBaku(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tgl_awal  = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $kd_bahan  = $this->input->post("kd_bahan");

      $result = $this->Purchase_Model->getHistoryBahanBaku($tgl_awal,$tgl_akhir,$kd_bahan);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function getTotalMasukBahanBaku(){
    $tgl_awal  = $this->input->post("tgl_awal");
    $tgl_akhir = $this->input->post("tgl_akhir");
    $kd_bahan  = $this->input->post("kd_bahan");

    $result = $this->Purchase_Model->getTotalMasukBahanBaku($tgl_awal,$tgl_akhir,$kd_bahan);
    echo $result;
  }


  function getTotalKeluarBahanBaku(){
    $tgl_awal  = $this->input->post("tgl_awal");
    $tgl_akhir = $this->input->post("tgl_akhir");
    $kd_bahan  = $this->input->post("kd_bahan");

    $result = $this->Purchase_Model->getTotalKeluarBahanBaku($tgl_awal,$tgl_akhir,$kd_bahan);
    echo $result;
  }

  function getHistorySparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tgl_awal  = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $kd_bahan  = $this->input->post("kd_bahan");

      $result = $this->Purchase_Model->getHistorySparePart($tgl_awal,$tgl_akhir,$kd_bahan);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function getTotalMasukSparePart(){
    $tgl_awal  = $this->input->post("tgl_awal");
    $tgl_akhir = $this->input->post("tgl_akhir");
    $kd_bahan  = $this->input->post("kd_bahan");

    $result = $this->Purchase_Model->getTotalMasukSparePart($tgl_awal,$tgl_akhir,$kd_bahan);
    echo $result;
  }


  function getTotalKeluarSparePart(){
    $tgl_awal  = $this->input->post("tgl_awal");
    $tgl_akhir = $this->input->post("tgl_akhir");
    $kd_bahan  = $this->input->post("kd_bahan");

    $result = $this->Purchase_Model->getTotalKeluarSparePart($tgl_awal,$tgl_akhir,$kd_bahan);
    echo $result;
  }

  function getDataTrashBahanBaku(){
    $result = $this->Purchase_Model->getDataTrashBahanBaku();
    echo $result;
  }

  function getDataTrashBijiWarna(){
    $result = $this->Purchase_Model->getDataTrashBijiWarna();
    echo $result;
  }

  function getDataTrashMinyak(){
    $result = $this->Purchase_Model->getDataTrashMinyak();
    echo $result;
  }

  function getDataTrashCatMurni(){
    $result = $this->Purchase_Model->getDataTrashCatMurni();
    echo $result;
  }

  function getDataTrashCatCampur(){
    $result = $this->Purchase_Model->getDataTrashCatCampur();
    echo $result;
  }

  function getDataTrashApal(){
    $result = $this->Purchase_Model->getDataTrashApal();
    echo $result;
  }

  function getDataTrashSparePart(){
    $result = $this->Purchase_Model->getDataTrashSparePart();
    echo $result;
  }

  function restoreBahan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Purchase_Model->restoreBahan($id);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function restoreApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Purchase_Model->restoreApal($id);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function restoreSparePart(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Purchase_Model->restoreSparePart($id);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function deleteStokApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Purchase_Model->deleteStokApal($id);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function getStokApalPerId(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $result = $this->Purchase_Model->getStokApalPerId($id);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function updateStokApal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $stok = $this->input->post("stok");
      $result = $this->Purchase_Model->updateStokApal($id,$stok);
      echo $result;
    }else{
       echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
       redirect("_main/main","refresh");
    }
  }

  function countTrashPurceshing(){
    $result = $this->Purchase_Model->countTrashPurceshing();
    echo $result;
  }

  function getApal(){
    $key = $this->input->get("q");
    if(empty($key)){
      $result = $result = $this->Purchase_Model->getApal();
      echo $result;
    }else{
      $result = $this->Purchase_Model->searchApal($key);
      echo $result;
    }
  }

  function getHistoryApal(){
    $tgl_awal  = $this->input->post("tgl_awal");
    $tgl_akhir = $this->input->post("tgl_akhir");
    $kd_apal   = $this->input->post("kd_apal");
    $result = $this->Purchase_Model->getHistoryApal($tgl_awal,$tgl_akhir,$kd_apal);
    echo $result;
  }

  function getTotalMasukApal(){
    $tgl_awal  = $this->input->post("tgl_awal");
    $tgl_akhir = $this->input->post("tgl_akhir");
    $kd_apal   = $this->input->post("kd_apal");
    $result = $this->Purchase_Model->getTotalMasukApal($tgl_awal,$tgl_akhir,$kd_apal);
    echo $result;
  }

  function getTotalKeluarApal(){
    $tgl_awal  = $this->input->post("tgl_awal");
    $tgl_akhir = $this->input->post("tgl_akhir");
    $kd_apal   = $this->input->post("kd_apal");
    $result = $this->Purchase_Model->getTotalKeluarApal($tgl_awal,$tgl_akhir,$kd_apal);
    echo $result;
  }

	public function permintaan_barang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Permintaan Barang Dan Sparepart");
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

	public function getPermintaanBarang(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Purchase_Model->selectPermintaanBarang();
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
      $result = $this->Purchase_Model->selectPermintaanSparePart($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

	public function printBonPermintaanBarang($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("DataPermintaan" => $this->Purchase_Model->selectPermintaanBarang_Print($param),
                    "DataDetailPermintaan" => $this->Purchase_Model->selectDetailPermintaanBaru_Print($param));
      $this->load->view("frm_print_bon_permintaan_barang",$data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

	public function printBonPermintaanSparePart($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("DataPermintaan" => $this->Purchase_Model->selectPermintaanSparePart_Print($param),
                    "DataDetailPermintaan" => $this->Purchase_Model->selectDetailPermintaanSparePartBaru_Print($param));
      $this->load->view("frm_print_bon_permintaan_spare_part",$data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

	public function batalkanPermintaan(){
		$isLogin = $this->isLogin();
    if($isLogin){
			$idTransaksi = $this->input->post("idTransaksi");
			$idPermintaan = $this->input->post("idPermintaan");
			$keteranganPurchasing = $this->input->post("keteranganPurchasing");

			if(empty($keteranganPurchasing)){
				echo "Data Kosong";
			}else{
				$data = array("idTransaksi" => $idTransaksi,
											"idPermintaan" => $idPermintaan,
											"keteranganPurchasing" => $keteranganPurchasing);
				$result = $this->Purchase_Model->updateBatalkanPermintaanBarang($data);
				echo $result;
			}
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
	}

	public function aktifkanPermintaan(){
		$isLogin = $this->isLogin();
    if($isLogin){
			$idTransaksi = $this->input->post("idTransaksi");
			$idPermintaan = $this->input->post("idPermintaan");
			$statusPermintaan = $this->input->post("statusPermintaan");

			if(empty($statusPermintaan)){
				echo "Data Kosong";
			}else{
				$data = array("idTransaksi" => $idTransaksi,
											"idPermintaan" => $idPermintaan,
											"statusPermintaan" => $statusPermintaan);
				$result = $this->Purchase_Model->updateAktifkanPermintaanBarang($data);
				echo $result;
			}
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
	}

	public function batalkanPermintaanSparePart(){
		$isLogin = $this->isLogin();
    if($isLogin){
			$idTransaksi = $this->input->post("idTransaksi");
			$idPermintaan = $this->input->post("idPermintaan");
			$keteranganPurchasing = $this->input->post("keteranganPurchasing");

			if(empty($keteranganPurchasing)){
				echo "Data Kosong";
			}else{
				$data = array("idTransaksi" => $idTransaksi,
											"idPermintaan" => $idPermintaan,
											"keteranganPurchasing" => $keteranganPurchasing);
				$result = $this->Purchase_Model->updateBatalkanPermintaanSparePart($data);
				echo $result;
			}
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
	}

	public function aktifkanPermintaanSparePart(){
		$isLogin = $this->isLogin();
    if($isLogin){
			$idTransaksi = $this->input->post("idTransaksi");
			$idPermintaan = $this->input->post("idPermintaan");
			$statusPermintaan = $this->input->post("statusPermintaan");

			if(empty($statusPermintaan)){
				echo "Data Kosong";
			}else{
				$data = array("idTransaksi" => $idTransaksi,
											"idPermintaan" => $idPermintaan,
											"statusPermintaan" => $statusPermintaan);
				$result = $this->Purchase_Model->updateAktifkanPermintaanSparePart($data);
				echo $result;
			}
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
	}

	public function setujuiPermintaanBarang(){
		$isLogin = $this->isLogin();
    if($isLogin){
			$idPermintaan = $this->input->post("idPermintaan");
			$result = $this->Purchase_Model->updateSetujuiPermintaanBarang($idPermintaan);
			echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
	}

	public function setujuiPermintaanSparePart(){
		$isLogin = $this->isLogin();
    if($isLogin){
			$idPermintaan = $this->input->post("idPermintaan");
			$result = $this->Purchase_Model->updateSetujuiPermintaanSparePart($idPermintaan);
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
      $result = $this->Purchase_Model->selectDetailPermintaanSparePartBaru($idPermintaan);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

	public function getBuktiPenerimaanBarang(){
		$isLogin = $this->isLogin();
    if($isLogin){
			$result = $this->Purchase_Model->selectBuktiPenerimaanBarang();
			echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
	}

	public function getBuktiPenerimaanSparePart(){
		$isLogin = $this->isLogin();
    if($isLogin){
			$result = $this->Purchase_Model->selectBuktiPenerimaanSparePart();
			echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
	}

	public function getGeneratedRequestCode(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrData["Code"] = $this->Purchase_Model->generateKodePermintaan();
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
        $result = $this->Purchase_Model->selectComboBoxValueBahanSearch($data);
      }else{
        $data = array("jenis"=>str_replace("_"," ",$param),
        "key"=>"");
        $result = $this->Purchase_Model->selectComboBoxValueBahan($data);
      }
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
      $result = $this->Purchase_Model->selectDetailBarangBahan($kdGudangBahan);
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
          $result = $this->Purchase_Model->insertPermintaanBarang($data[$i]);
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

	public function getDetailPermintaanBaru(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idPermintaan = $this->input->post("idPermintaan");
      $result = $this->Purchase_Model->selectDetailPermintaanBaru($idPermintaan);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

}
