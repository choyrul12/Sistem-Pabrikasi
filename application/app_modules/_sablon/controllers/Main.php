<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{

	function __construct()
	{
		parent:: __construct();
		$this->load->model("Sablon_Model");
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
	       ($this->session->userdata("fabricationGroup")=="sablon"||
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
			  array("Content"=>"Data Rencana PIC","Link"=>"_sablon/main/data_rencana_pic","Name"=>"Data_Rencana_PIC","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
			  array("Content"=>"Data Rencana Mandor","Link"=>"_sablon/main/data_rencana_mandor","Name"=>"Data_Rencana_Mandor","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
			  array("Content"=>"Hasil Sablon","Link"=>"_sablon/main/hasil_sablon","Name"=>"Hasil_Sablon","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
			   array("Content"=>"Bon Sablon","Link"=>"_sablon/main/bon_sablon","Name"=>"Bon_Sablon","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
			  array("Content"=>"Pengembalian Barang HD","Link"=>"_sablon/main/data_barang_hd","Name"=>"Data_Barang_HD","Status"=>"Single","Icon"=>"fa fa-book","Id"=>"")
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

  	function data_rencana_pic()
  	{
	 	$isLogin = $this->isLogin();
	    if($isLogin){

			$data["Data"] = array("Title"=>"Data Rencana PIC");
			$data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
			$this->load->view("header");
			$this->load->view("sidebar",$this->checkStatus());
			$this->load->view("frm_data_rencana_pic",$data);
			$this->load->view("footer");

	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function getDataRencanaPIC()
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){
			$result = $this->Sablon_Model->getDataRencanaPIC();

			echo $result;
	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function getDataSearchRencanaPIC($tgl1,$tgl2)
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){
			$result = $this->Sablon_Model->getDataSearchRencanaPIC($tgl1,$tgl2);
			echo $result;
	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function getDataConversi()
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){
			$key  = $this->input->post('kd_ppic');
	    	$data = $this->Sablon_Model->getDataConversi($key);
	    	if ($data->num_rows()>0) {
	    		foreach ($data->result_array() as $c) {
	    			echo 	"
	    					<div class='form-group'>
	    						<label style='text-align: left;'>Ukuran : </label>
	    						<input type='text' class='form-control' id='ukuran' value='".$c['ukuran']."' name='ukuran' readonly>
	    					</div>
	    					<div class='form-group'>
	    						<label style='text-align: left;'>Permintaan : </label>
	    						<input type='hidden' name='kd_ppic' id='kd_ppic' value='".$c['kd_ppic']."'>
	    						<input type='text' class='form-control' id='permintaan' value='".round($c['jumlah_permintaan'])."'' name='permintaan' readonly>
	    					</div>
	    					<div class='form-group'>
	    						<label style='text-align: left;'>Berat : </label>
	    						<input type='text' class='form-control' id='berat' value='".$c['berat']."' name='berat' readonly>
	    					</div>
	    					<div class='form-group'>
	    						<label style='text-align: left;'>Tebal : </label>
	    						<input type='text' class='form-control' id='tebal' value='".$c['tebal']."' name='jumlah_permintaan' readonly>
	    					</div>
	    					<div class='form-group'>
	    						<label style='text-align: left;'>Konversi : </label>
	    						<input type='number' class='form-control' id='konversi' name='konversi' required>
	    					</div>";
	    		}
	    	}
	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function editDataConversi()
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){
			$key  = $this->input->post('kd_ppic');
	    	$data = $this->Sablon_Model->getDataConversi($key);
	    	if ($data->num_rows()>0) {
	    		foreach ($data->result_array() as $c) {
	    			echo 	"<div class='form-group'>
	    						<label>Permintaan : </label>
	    						<input type='hidden' name='kd_ppic' id='kd_ppic' value='".$c['kd_ppic']."'>
	    						<input type='text' class='form-control' id='permintaan' value='".$c['jumlah_permintaan']."'' name='permintaan' readonly>
	    					</div>
	    					<div class='form-group'>
	    						<label>Ukuran : </label>
	    						<input type='text' class='form-control' id='ukuran' value='".$c['ukuran']."' name='ukuran' readonly>
	    					</div>
	    					<div class='form-group'>
	    						<label>Berat : </label>
	    						<input type='text' class='form-control' id='berat' value='".$c['berat']."' name='berat' readonly>
	    					</div>
	    					<div class='form-group'>
	    						<label>Permintaan : </label>
	    						<input type='text' class='form-control' id='tebal' value='".$c['tebal']."' name='jumlah_permintaan readonly'>
	    					</div>
	    					<div class='form-group'>
	    						<label>Konversi : </label>
	    						<input type='text' class='form-control' id='konversi' value='".$c['satuan_kilo']."' name='konversi' required>
	    					</div>";
	    		}
	    	}

	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}


  	function convertKG()
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){

			$key = $this->input->post('kd_ppic');
			$kg  = $this->input->post('konversi');

			$result = $this->Sablon_Model->convertKG($key,$kg);
			echo $result;

	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}


  	function buatRencana()
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){
	    	$key 		= $this->input->post('kd_ppic');
			$data 		= $this->Sablon_Model->getDataRencana($key);
			$kd_sablon	= $this->Sablon_Model->codeSablon();

			foreach ($data->result_array() as $value) {
				$kd_ppic 	= $value['kd_ppic'];
				$kd_gd_hasil= $value['kd_gd_hasil'];
				$nm_cust 	= $value['nm_cust'];
				$merek 		= $value['merek'];
				$ukuran 	= $value['ukuran'];
				$sisa 		= $value['sisa'];
				$warna_plastik = $value['warna_plastik'];
				$warna_cetak   = $value['warna_cetak'];
				$jumlah_permintaan = $value['jumlah_permintaan'];
			}

		$content= "	<div class='table-responsive'>
			          <table class='table table-responsive table-striped' id=''>
			            <thead style='background-color:#E8E8E8;'>
			            	<th style='text-align:center;'>No</th>
			              	<th style='text-align:center;'>Customer</th>
			              	<th style='text-align:center;'>Permintaan</th>
			              	<th style='text-align:center;'>Satuan Kilo</th>
			              	<th style='text-align:center;'>Sisa</th>
			              	<th style='text-align:center;'>Ukuran</th>
			              	<th style='text-align:center;'>Merek</th>
			              	<th style='text-align:center;'>Warna Plastik</th>
			              	<th style='text-align:center;'>Warna Cetak</th>
			              	<th style='text-align:center;'>Strip</th>
			              	<th style='text-align:center;'>Berat</th>
			            </thead>";
			            $i=1; foreach ($data->result_array() as $value) {
						$content .=
						'<tbody><tr style="text-align:center;">
							<td>'.$i++.'</td>
							<td>'.$value['nm_cust'].'</td>
							<td>'.round($value['jumlah_permintaan']).'</td>
							<td>'.$value['satuan_kilo'].' Kg <input type="hidden" id="satuan_kilo" value="'.$value['satuan_kilo'].'"></td>
							<td>'.round($value['sisa']).'</td>
							<td>'.$value['ukuran'].'</td>
							<td>'.$value['merek'].'</td>
							<td>'.$value['warna_plastik'].'</td>
							<td>'.$value['warna_cetak'].'</td>
							<td>'.$value['strip'].'</td>
							<td>'.$value['berat'].'</td>
					  	</tr></tbody>' ;
						}
			        $content .="</table>
			        </div><br>

			        <div class='form-group col-md-6'>
			        	<label style='text-align:left;'>Kode Sablon :</label>
			        	<input type='text' class='form-control' placeholder='Kode Sablon' id='kd_sablon' name='kd_sablon' value='".$kd_sablon."' readonly>
			        	<input type='hidden' class='form-control' placeholder='Kode PPIC' id='kd_ppic' name='kd_ppic' value='".$kd_ppic."' readonly>
			        	<input type='hidden' class='form-control' placeholder='Sisa' id='sisa_sekarang' name='sisa_sekarang' value='".$sisa."' readonly>
			        	<input type='hidden' class='form-control' placeholder='Kode Hasil' id='kd_gd_hasil' name='kd_gd_hasil' value='".$kd_gd_hasil."' readonly>
			        	<input type='hidden' class='form-control' placeholder='Customer' id='customer' name='customer' value='".$nm_cust."' readonly>
			        	<input type='hidden' class='form-control' placeholder='Merek' id='merek' name='merek' value='".$merek."' readonly>
			        	<input type='hidden' class='form-control' placeholder='Ukuran' id='ukuran' name='ukuran' value='".$ukuran."' readonly>
			        	<input type='hidden' class='form-control' placeholder='Warna Plastik' id='warna_plastik' name='warna_plastik' value='".$warna_plastik."' readonly>
			        	<input type='hidden' class='form-control' placeholder='Warna Sablon' id='warna_sablon' name='warna_sablon' value='".$warna_cetak."' readonly>
			        </div>
			        <div class='form-group col-md-6'>
			        	<label>Tanggal Pengerjaan :</label>
				        <div class='input-group date'>
		                    <div class='input-group-addon'>
		                      <i class='fa fa-calendar'></i>
		                    </div>
		                    <input type='text' class='form-control' name='tgl_ren' id='tgl_rencana' placeholder='Tanggal Pengerjaan'>
		                </div>
		            </div>
			        <div class='form-group col-md-6'>
			        	<label style='text-align:left;'>Nama Operator :</label>
			        	<input type='text' class='form-control' placeholder='Nama Operator' id='nm_operator' name='nm_operator' required>
			        </div>
			        <div class='form-group col-md-6'>
			        	<label style='text-align:left;'>Rencana Mandor :</label>
			        	<input type='hidden' class='form-control' placeholder='jml_permintaan' name='jml_permintaan' id='jml_permintaan' value='".$sisa."' required>
			        	<input type='number' class='form-control' placeholder='Jumlah Rencana' name='jml_rencana' id='jml_rencana' required>
			        </div>

			        <div class='form-group col-md-12' style='text-align:center;'>
			        	<button class='btn btn-flat bg-navy' style='width:32%' onclick='addRencana()'>SIMPAN</button>
			        </div>
			        <div class='table-responsive col-md-12'>
			          <h3 style='text-align:center;'>List Perencanaan Kerja</h3>
			          <table class='table table-responsive table-striped' id='tableListRencana'>
			            <thead style='background-color:#E8E8E8; text-align:center;'>
			            	<th>No</th>
			              	<th>Nama Produk</th>
			              	<th>Ukuran</th>
			              	<th>Permintaan</th>
			              	<th>Warna Plastik</th>
			              	<th>Warna Cetak</th>
			              	<th>Jumlah Permintaan</th>
			              	<th colspan='2'>Action</th>
			            </thead>
			          </table>
			        </div>
			        <div class='form-group col-md-12' style='text-align:center;'>
			        	<button class='btn btn-flat bg-navy' style='width:30%;' onclick=saveRencana('".$kd_ppic."')>SELESAI</button>
			        </div>";

			        echo $content;
	    }else{
			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function addRencana()
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){
			$data = array();
			$data['kd_ppic']   	 	= $this->input->post('kd_ppic');
			$data['kd_sablon']   	= $this->input->post('kd_sablon');
			$data['kd_gd_hasil'] 	= $this->input->post('kd_gd_hasil');
			$data['customer']    	= $this->input->post('customer');
			$data['merek']   	 	= $this->input->post('merek');
			$data['tgl_rencana'] 	= $this->input->post('tgl_rencana');
			$data['ukuran']      	= $this->input->post('ukuran');
			$data['warna_plastik'] 	= $this->input->post('warna_plastik');
			$data['warna_sablon']   = $this->input->post('warna_sablon');
			$data['nm_operator'] 	= $this->input->post('nm_operator');
			$permintaan_ppic		= $this->input->post('jml_permintaan');
			$data['jml_rencana']	= $this->input->post('jml_rencana');
			$data['jml_sisa']		= $this->input->post('jml_rencana');
			$data['satuan_kilo']    = $this->input->post('satuan_kilo');
			$sisa_permintaan		= $permintaan_ppic - $data['jml_rencana'];

			$result = $this->Sablon_Model->insertRencana($data,$sisa_permintaan);
			echo $result;

	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}


  	function getDataRencanaTemp($id)
  	{
  		$result = $this->Sablon_Model->getDataRencanaTemp($id);
		echo $result;
  	}

  	function deleteRencana()
  	{
  		$key = $this->input->post('kd_sablon');
  		$sisa = $this->input->post('sisa');
  		$kd_ppic = $this->input->post('kd_ppic');

  		$result = $this->Sablon_Model->deleteRencana($key,$sisa,$kd_ppic);
	  	echo $result;
  	}

  	function editRencana()

  	{
  		$key = $this->input->post("kd_sablon");
  		$rencanaSablon = $this->Sablon_Model->getDataRencanaSablon($key);
  		foreach ($rencanaSablon->result_array() as $r) {
  			$kd_sablon   = $r['kd_sablon'];
  			$nm_operator = $r['nm_operator'];
  			$tgl_rencana = $r['tgl_rencana'];
  			$jml_rencana = $r['jml_rencana'];
  		}

  		$content = "<div class='form-group'>
			        	<label style='text-align:left;'>Kode Sablon :</label>
			        	<input type='text' class='form-control' value='".$kd_sablon."' placeholder='Kode Sablon' id='1' name='nm_operator' readonly required>
			        </div>
  					<div class='form-group'>
			        	<label style='text-align:left;'>Nama Operator :</label>
			        	<input type='text' class='form-control' value='".$nm_operator."' placeholder='Nama Operator' id='2' name='nm_operator' required>
			        </div>
			        <div class='form-group'>
			        	<label style='text-align:left;'>Jumlah Rencana :</label>
			        	<input type='text' class='form-control' value='".$jml_rencana."' placeholder='Jumlah Rencana' id='3' name='nm_operator' required>
			        	<input type='hidden' class='form-control' value='".$jml_rencana."' placeholder='Jumlah Rencana' id='5' name='nm_operator' required>
			        </div>
			        <div class='form-group'>
			        	<label style='text-align:left;'>Tanggal Pengerjaan :</label>
			        	<input type='date' class='form-control' value='".$tgl_rencana."' placeholder='Tanggal Pengerjaan' id='4' name='tgl_rencana' required>
			        </div>" ;

		echo $content;
  	}

  	function updateRencana()
  	{
  		$data = array();
  		$kd_ppic   = $this->input->post("kd_ppic");
  		$kd_sablon = $this->input->post("kd_sablon");
  		$data['nm_operator'] = $this->input->post("nm_operator");
  		$data['tgl_rencana'] = $this->input->post("tgl_rencana");
  		$data['jml_rencana'] = $this->input->post("jml_rencana");
  		$sisa = $this->input->post("sisa");

  		$result = $this->Sablon_Model->updateRencana($kd_ppic,$kd_sablon,$data,$sisa);
  		echo $result;
  	}

  	function saveRencana()
  	{
  		$kd_ppic = $this->input->post("kd_ppic");
  		$result  = $this->Sablon_Model->saveRencana($kd_ppic);
  		echo $result;
  	}

  	function data_rencana_mandor()
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){

			$data["Data"] = array("Title"=>"Data Rencana Sablon");
			$data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
			$data['kd_sablon'] = $this->Sablon_Model->codeSablon();

			$this->load->view("header");
			$this->load->view("sidebar",$this->checkStatus());
			$this->load->view("frm_data_rencana_sablon",$data);
			$this->load->view("footer");

	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function getCatMurni()
  	{
  		$key = $this->input->get("q");
		if(empty($key)){
			$result = $this->Sablon_Model->getCat();
  			echo $result;
		}else{
			$result = $this->Sablon_Model->searchCat($key);
			echo $result;
		}
  	}

  	function getMinyak()
  	{
	  	$key = $this->input->get("q");
		if(empty($key)){
			$result = $this->Sablon_Model->getMinyak();
  			echo $result;
		}else{
			$result = $this->Sablon_Model->searchMinyak($key);
			echo $result;
		}
	}

  	function getDataRencanaSablon()
  	{
  		$result = $this->Sablon_Model->getDataRencanaMandorSablon();
  		echo $result;
  	}

  	function inputHasil()
  	{
  		$key 	= $this->input->post("kd_sablon");
  		$result = $this->Sablon_Model->getItemRencanaSablon($key);
  		$cat 	= $this->Sablon_Model->getCat();
  		$catCampur = $this->Sablon_Model->getCatCampur();
  		$minyak    = $this->Sablon_Model->getMinyak();
  		$kd_hasilSablon = $this->Sablon_Model->codeHasilSablon();
  		foreach ($result->result_array() as $r) {
  			$kd_sablon   = $r["kd_sablon"];
  			$kd_ppic     = $r["kd_ppic"];
  			$kd_gd_hasil = $r["kd_gd_hasil"];
  			$customer 	 = $r["customer"];
  			$merek 		 = $r["merek"];
  			$tgl_rencana = $r["tgl_rencana"];
  			$ukuran 	 = $r["ukuran"];
  			$warna_plastik = $r["warna_plastik"];
  			$warna_sablon  = $r["warna_sablon"];
  			$id_user 	   = $this->session->userdata('fabricationIdUser');
  			$jml_rencana   = $r["jml_rencana"];
  			$jml_sisa  	   = $r["jml_sisa"];
  			$jml_hasil     = $r["jml_hasil"];
  		}

  		$form = "<div class='table-responsive'>
		          <table class='table table-responsive table-striped' id=''>
		            <thead style='background-color:#E8E8E8;'>
		            	<th style='text-align:center;'>No</th>
		              	<th style='text-align:center;'>Customer</th>
		              	<th style='text-align:center;'>Ukuran</th>
		              	<th style='text-align:center;'>Merek</th>
		              	<th style='text-align:center;'>Warna Plastik</th>
		              	<th style='text-align:center;'>Warna Sablon</th>
		              	<th style='text-align:center;'>Jumlah Rencana</th>
		              	<th style='text-align:center;'>Satuan Kg</th>
		             </thead>";
		            $i=1; foreach ($result->result_array() as $value) {
					$form .=
					'<tbody><tr style="text-align:center;">
						<td>'.$i++.'</td>
						<td>'.$value['customer'].'</td>
						<td>'.$value['ukuran'].'</td>
						<td>'.$value['merek'].'</td>
						<td>'.$value['warna_plastik'].'</td>
						<td>'.$value['warna_sablon'].'</td>
						<td>'.$value['jml_rencana'].'</td>
						<td>'.$value['satuan_kilo'].'</td>
				  	</tr></tbody>' ;
					}
		        $form .="</table>
		        </div>
		        <div class='box box-success'>
		        	<div class='box-header ui-sortable-handle' style='cursor: move;'>
		              <i class='fa fa-tint'></i>
		              <h3 class='box-title'>Pemakaian Bahan</h3>
		              <div class='pull-right box-tools'>
		                <button class='btn bg-navy pull-right' onClick='addInput()'><i class='fa fa-plus'> Tambah Cat</i></button>
		              </div>
		            </div>
		            <div class='box-body'>
		            	<div id='dynamicInput'>
	            			<input type='hidden' class='form-control' value='".$kd_ppic."' name='kd_ppic' id='kd_ppic' >
		            		<input type='hidden' class='form-control' value='".$kd_sablon."' name='kd_sablon' id='kd_sablon' >
			            	<input type='hidden' class='form-control' value='".$kd_gd_hasil."' name='kd_gd_hasil'id='kd_gd_hasil'>
				        	<input type='hidden' class='form-control' value='".$customer."' name='customer'id='customer'>
				        	<input type='hidden' class='form-control' value='".$merek."' name='merek'id='merek'>
				        	<input type='hidden' class='form-control' value='".$ukuran."' name='ukuran'id='ukuran'>
				        	<input type='hidden' class='form-control' value='".$warna_plastik."' name='warna_plastik'id='warna_plastik'>
				        	<input type='hidden' class='form-control' value='".$warna_sablon."' name='warna_sablon'id='warna_sablon'>
				        	<input type='hidden' class='form-control' value='".$id_user."' name='id_user'id='id_user'>
				        	<input type='hidden' class='form-control' value='".$jml_sisa."' name='jml_sisa'id='jml_sisa'>
				        	<input type='hidden' class='form-control' value='".$jml_hasil."' name='jml_hasil'id='jml_hasil'>
				        <div class='col-md-12'>
				        	<label>Cat :</label>
				        </div>
		  				<div class='form-group col-md-4'>
				        	<select class='form-control' name='warna_cat[]' id='warna_cat'>
				        		<option value=''>Warna Cat 1</option>
				        	</select>
				        </div>
				        <div class='form-group col-md-3' style='width:200px; padding-right:0px;'>
				        	<input type='number' class='form-control' value='' placeholder='Jumlah Cat 1' name='jum_cat[]' id='jum_cat' required>
				        </div>
				        <div class='form-group col-md-1' style='width:100px;'>
				        	<select class='form-control' name='satuan_cat[]' id='satuan_cat'>
				        		<option value='Kg'>Kg</option>
				        		<option value='Ons'>Ons</option>
				        	</select>
				        </div>
				        <div class='form-group col-md-3' style='width:200px; padding-right:0px;'>
				        	<input type='number' class='form-control' value='' placeholder='Sisa Cat 1' name='sisa_cat[]' id='sisa_cat' required>
				        </div>
				        <div class='form-group col-md-1' style='width:100px;'>
				        	<select class='form-control' name='satuan_sisaCat[]' id='satuan_sisaCat'>
				        		<option value='Kg'>Kg</option>
				        		<option value='Ons'>Ons</option>
				        	</select>
				        </div>
				        </div>
				        <div class='form-group col-md-4'>
				        <label>Minyak :</label>
				        	<select class='form-control' name='minyak[]' id='minyak' required>
				        		<option value=''>Minyak</option>
				        	</select>
				        </div>
				        <div class='form-group col-md-3' style='width:200px; padding-right:0px;'>
				        <label>&nbsp;</label>
				        	<input type='number' class='form-control' value='' placeholder='Jumlah Minyak' name='jum_minyak' id='jum_minyak' required>
				        </div>
				        <div class='form-group col-md-1' style='width:100px;'>
				        <label>&nbsp;</label>
				        	<select class='form-control' name='satuan_minyak' id='satuan_minyak'>
				        		<option value='Kg'>Kg</option>
				        		<option value='Ons'>Ons</option>
				        	</select>
				        </div>
				        <div class='form-group col-md-3' style='width:200px; padding-right:0px;'>
				        <label>&nbsp;</label>
				        	<input type='number' class='form-control' value='' placeholder='Sisa Minyak' name='sisa_minyak' id='sisa_minyak' required>
				        </div>
				        <div class='form-group col-md-1' style='width:100px;'>
				        <label>&nbsp;</label>
				        	<select class='form-control' name='satuan_sisaMinyak[]' id='satuan_sisaMinyak'>
				        		<option value='Kg'>Kg</option>
				        		<option value='Ons'>Ons</option>
				        	</select>
				        </div>
			        </div>
			    </div>
			    <div class='box box-success'>
		        	<div class='box-header ui-sortable-handle' style='cursor: move;'>
		              <i class='fa fa-cubes'></i>
		              <h3 class='box-title'>Input Hasil Sablon</h3>
		            </div>
		            <div class='box-body'>
		            	<div class='form-group col-md-4'>
		            		<label>Kode Hasil Sablon :</label>
				        	<input type='text' class='form-control' value='".$kd_hasilSablon."' placeholder='Kode Sablon' name='kd_hasil' id='kd_hasil' required readonly>
				        </div>
		  				<div class='form-group col-md-4'>
		  					<label>Hasil Jadi /Lembar :</label>
				        	<input type='number' class='form-control' value='' placeholder='Hasil Jadi Lembar' name='hasil_lembar' id='hasil_lembar' required>
				        </div>
				        <div class='form-group col-md-4'>
				       		<label>Hasil Jadi /Kg :</label>
				        	<input type='number' class='form-control' value='' placeholder='Hasil Jadi Berat' name='hasil_berat' id='hasil_berat' required>
				        </div>
				        <div class='form-group col-md-4'>
				        	<label>Jenis Barang :</label>
				        	<select class='form-control' name='jenis_barang' id='jenis_barang'>
				        		<option value=''>Pilih Jenis Barang</option>
				        		<option value='LOKAL'>LOKAL</option>
				        		<option value='EXPORT'>EXPORT</option>
				        	</select>
				        </div>
				        <div class='form-group col-md-4'>
				        	<label>Tanggal Pengerjaan :</label>
				        	<input type='date' class='form-control' value='".$tgl_rencana."' placeholder='Tanggal Pengerjaan' name='tgl_pengerjaan' id='tgl_pengerjaan' required>
				        </div>
				        <div class='form-group col-md-4'>
				        	<label>Keterangan</label>
				        	<input type='text' class='form-control' value='' placeholder='Keterangan' name='keterangan' id='keterangan' required>
				        </div>
				        <div class='form-group col-md-12' style='text-align:center;'>
				        	<button class='btn btn-flat bg-navy' style='width:30%;' onclick=saveHasilSablon()>SAVE</button>
				        </div>
			        </div>
			    </div>";
		echo $form;
  	}

  	function saveHasilSablon()
  	{
  		$hasil = array();
  		$hasil['kd_hasil_sablon'] = $this->input->post('kd_hasil');
  		$hasil['kd_sablon']    = $this->input->post('kd_sablon');
		$hasil['kd_gd_hasil']  = $this->input->post('kd_gd_hasil');
		$hasil['tanggal']      = $this->input->post('tgl_rencana');
		$hasil['ukuran'] 	   = $this->input->post('ukuran');
		$hasil['warna_plastik']= $this->input->post('w_plastik');
		$hasil['warna_cat']    = $this->input->post('w_sablon');
		$hasil['id_user'] 	   = $this->input->post('id_user');
		$hasil['hasil_lembar'] = $this->input->post('hasil_lembar');
		$hasil['hasil_berat']  = $this->input->post('hasil_berat');
		$hasil['keterangan']   = $this->input->post('keterangan');
		$hasil['jns_brg'] 	   = $this->input->post('jenis_barang');
		$hasil['merek'] 	   = $this->input->post('merek');

		$kd_hasil  			  = $this->input->post('kd_hasil');
		$warna_cat 			  = $this->input->post('warna_cat');
		$jum_cat   			  = $this->input->post('jum_cat');
		$satuan_cat   		  = $this->input->post('satuan_cat');
		$sisa_cat   		  = $this->input->post('sisa_cat');
		$satuan_sisaCat 	  = $this->input->post('satuan_sisaCat');
		$kd_minyak 			  = $this->input->post('minyak');
		$jum_minyak 		  = $this->input->post('jum_minyak');
		$satuan_minyak 		  = $this->input->post('satuan_minyak');
		$sisa_minyak 		  = $this->input->post('sisa_minyak');
		$satuan_sisaMinyak 	  = $this->input->post('satuan_sisaMinyak');
		$jml_sisa 			  = $this->input->post('sisa');
		$jml_hasil   		  = $this->input->post('totHasil');
		$kd_ppic			  = $this->input->post('kd_ppic');

	    $cat = array();
	    foreach($warna_cat AS $key => $val){
    	$satuan_cat[$key] == "Kg" ? $jumlah_cat[$key]=$jum_cat[$key] : $jumlah_cat[$key]=$jum_cat[$key]*0.1;
    	$satuan_sisaCat[$key] == "Kg" ? $sisaCat[$key]=$sisa_cat[$key] : $sisaCat[$key]=$sisa_cat[$key]*0.1;
			$cat[] = array(
			"kd_hasil_sablon" 	 => $kd_hasil,
			"kd_gd_bahan"  	  	 => $warna_cat[$key],
			"jumlah_pengambilan" => $jumlah_cat[$key],
			"sisa_pengambilan"   => $sisaCat[$key]
			);
	    }

	    $satuan_minyak == "Kg" ? $jumlah_minyak=$jum_minyak : $jumlah_minyak=$jum_minyak*0.1;
    	$satuan_sisaMinyak== "Kg" ? $sisaMinyak=$sisa_minyak : $sisaMinyak=$sisa_minyak*0.1;
    	$minyak = array();
    	$minyak["kd_hasil_sablon"] 	  = $kd_hasil;
    	$minyak["kd_gd_bahan"] 		  = $kd_minyak;
    	$minyak["jumlah_pengambilan"] = $jumlah_minyak;
    	$minyak["sisa_pengambilan"]   = $sisa_minyak;

		if (in_array('',$hasil) || in_array('',$warna_cat) || in_array('',$jum_cat) || in_array('',$sisa_cat) || in_array('',$minyak) || in_array('',$jum_minyak) || in_array('',$sisa_minyak)) {
			echo "Empty";
		}else{
			$result = $this->Sablon_Model->saveHasilSablon($hasil,$cat,$minyak,$jml_sisa,$jml_hasil,$kd_ppic);
			echo $result;
		}
  	}

  	function hasil_sablon()
  	{
	 	$isLogin = $this->isLogin();
	    if($isLogin){

			$data["Data"] = array("Title"=>"Data Hasil Sablon");
			$data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
			$this->load->view("header");
			$this->load->view("sidebar",$this->checkStatus());
			$this->load->view("frm_data_hasil_sablon",$data);
			$this->load->view("footer");

	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function getDataHasilSablon()
  	{
  		$result = $this->Sablon_Model->getDataHasilSablon();
  		echo $result;
  	}

  	function checkHasilSablon()
  	{
  		$tgl1 = $this->input->post('tgl1');
  		$tgl2 = $this->input->post('tgl2');
  		$result = $this->Sablon_Model->checkHasilSablon($tgl1, $tgl2);
  		echo $result;
  	}

  	function checkBonHasilSablon()
  	{
  		$tgl = $this->input->post('tgl');
  		$result = $this->Sablon_Model->checkBonHasilSablon($tgl);
  		echo $result;
  	}

  	function getHasilSablonPerTgl($tgl1,$tgl2)
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){
			$result = $this->Sablon_Model->getHasilSablonPerTgl($tgl1,$tgl2);
			echo $result;
	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function getBonHasilSablonPerTgl($tgl)
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){
			$result = $this->Sablon_Model->getBonHasilSablonPerTgl($tgl);
			echo $result;
	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function detailHasilSablon()
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){
			$kd_hasil_sablon = $this->input->post('id');
			$detail_hasil = $this->Sablon_Model->detail_hasil($kd_hasil_sablon);
			$detail_bahan = $this->Sablon_Model->detail_bahan($kd_hasil_sablon);
			foreach ($detail_hasil->result_array() as $dh) {
				$kd_hasil     = $dh['kd_hasil_sablon'];
				$tanggal 	  = $dh['tanggal'];
				$ukuran  	  = $dh['ukuran'];
				$merek   	  = $dh['merek'];
				$w_plastik    = $dh['warna_plastik'];
				$w_cat 		  = $dh['warna_cat'];
				$hasil_lembar = $dh['hasil_lembar'];
				$hasil_berat  = $dh['hasil_berat'];
				$status_bon   = $dh['status_bon'];
			}

			$detail="<div class='box box-success'>
	        			<div class='box-header ui-sortable-handle' style='cursor: move;'>
		              		<i class='fa fa-cubes'></i>
		              		<h3 class='box-title'>Hasil Sablon</h3>
		            	</div>
	            		<div class='box-body'>
							<table class='table table-responsive table-striped' id=''>
					            <thead style='background-color:#E8E8E8;'>
					            	<th style='text-align:center;'>Tanggal</th>
					              	<th style='text-align:center;'>Ukuran</th>
					              	<th style='text-align:center;'>Merek</th>
					              	<th style='text-align:center;'>Warna Plastik</th>
					              	<th style='text-align:center;'>Warna Cat</th>
					              	<th style='text-align:center;'>Hasil Lembar</th>
					              	<th style='text-align:center;'>Hasil Berat</th>";
					              	if ($status_bon == "FALSE") {
					              	$detail.="<th style='text-align:center;'>Option</th>";}
	            	$detail.= "</thead>
					            <tbody>
					             	<tr style='text-align:center;'>
										<td>".$tanggal."</td>
										<td>".$ukuran."</td>
										<td>".$merek."</td>
										<td>".$w_plastik."</td>
										<td>".$w_cat."</td>
										<td>".$hasil_lembar."</td>
										<td>".$hasil_berat."</td>";
										if ($status_bon == "FALSE") {
										$detail.="<td><button class='btn btn-sm btn-flat btn-primary' onclick=edit_detailHasilSablon('".$kd_hasil."') title='Input Hasil'><i class='fa fa-edit'> Edit</i></button></td>";}
						$detail.="</tr>
							  	</tbody>
							</table>
						</div>
					</div>
					<div class='box box-success'>
	        			<div class='box-header ui-sortable-handle' style='cursor: move;'>
		              		<i class='fa fa-tint'></i>
		              		<h3 class='box-title'>Detail Penggunaan Bahan</h3>
		            	</div>
	            		<div class='box-body'>
							<table class='table table-responsive table-striped' id=''>
					            <thead style='background-color:#E8E8E8;'>
					            	<th style='text-align:center;'>No</th>
					            	<th style='text-align:center;'>Jenis</th>
					              	<th style='text-align:center;'>Nama Barang</th>
					              	<th style='text-align:center;'>Warna</th>
					              	<th style='text-align:center;'>Jumlah</th>
					              	<th style='text-align:center;'>Sisa</th>";
					              	if ($status_bon == "FALSE") {
					              	$detail .="<th style='text-align:center;'>Option</th>";
					              	}
					  $detail.= "</thead>";
								$i=1; foreach ($detail_bahan->result_array() as $db) {
								$detail .=
								"<tbody>
									<tr style='text-align:center;'>
										<td>".$i++."</td>
										<td>".$db['jenis']."</td>
										<td>".$db['nm_barang']."</td>
										<td>".$db['warna']."</td>
										<td>".$db['jumlah_pengambilan']." Kg</td>
										<td>".$db['sisa_pengambilan']." Kg</td>";
										if ($status_bon == "FALSE") {
										$detail .="<td><button class='btn btn-sm btn-flat btn-primary' onclick=edit_detailBahanSablon('".$db['id_penggunaan_sablon']."') title='Edit'><i class='fa fa-edit'> Edit</i></button></td>";
										}

			  		$detail .= "</tr>
							  	</tbody>";}
			        $detail .="</table>
						</div>
					</div>";
			echo $detail;
	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function kirimHasilSablon()
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){
			$tgl = $this->input->post('tgl');
			if ($result = json_decode($this->Sablon_Model->getDataKirimSablon($tgl), TRUE)) {
				$data = array();
				foreach ($result as $value) {
					$data[] = array(
						"kd_gd_hasil" => $value['kd_gd_hasil'],
						"id_user" => $value['id_user'],
						"ukuran" => $value['ukuran'],
						"jumlah_berat" => $value['hasil_berat'],
						"jumlah_lembar" => $value['hasil_lembar'],
						"warna" => $value['warna_plastik'],
						"customer" => $value['customer'],
						"bagian" => "SABLON",
						"status_transaksi" => "PROGRESS",
						"tgl_transaksi" => $value['tanggal'],
						"merek" => $value['merek'],
						"jns_permintaan" => $value['jns_permintaan'],
						"sts_barang" => $value['jns_brg'],
						"keterangan_history" => "MASUK DARI SABLON");
				}
				// $dataBahan = json_decode($this->Sablon_Model->getDataPenggunaanBahanSablon($tgl), TRUE);
				// foreach ($dataBahan as $value) {
				// 	$bahan[] = array(
				// 		'kd_gd_bahan' => $value['kd_gd_bahan'],
				// 		'id_user' => $value['id_user'],
				// 		'nama' => 'MANDOR SABLON',
				// 		'jumlah_permintaan' => $value['jumlah_pengambilan'],
				// 		'tgl_permintaan' => $value['tanggal'],
				// 		'bagian' => 'SABLON',
				// 		'status' => 'PROGRESS',
				// 		'status_history' => 'KELUAR',
				// 		'keterangan_history' => 'PEMAKAIAN SABLON');
				// 	$bahan[] = array(
				// 		'kd_gd_bahan' => $value['kd_gd_bahan'],
				// 		'id_user' => $value['id_user'],
				// 		'nama' => 'MANDOR SABLON',
				// 		'jumlah_permintaan' => $value['sisa_pengambilan'],
				// 		'tgl_permintaan' => $value['tanggal'],
				// 		'bagian' => 'SABLON',
				// 		'status' => 'PROGRESS',
				// 		'status_history' => 'MASUK',
				// 		'keterangan_history' => 'PENGEMBALIAN SABLON');
				// }
				$result = $this->Sablon_Model->kirimHasilSablon($data,$tgl);
				echo $result;
			}else{
				echo "Sent";
			}
	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function bon_sablon()
  	{
  		$isLogin = $this->isLogin();
	    if($isLogin){

			$data["Data"] = array("Title"=>"Bon Hasil Sablon");
			$data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
			$this->load->view("header");
			$this->load->view("sidebar",$this->checkStatus());
			$this->load->view("frm_data_bon_sablon",$data);
			$this->load->view("footer");

	    }else{

			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
  	}

  	function printBonSablon($tgl){
	    $isLogin = $this->isLogin();
	    if($isLogin){
			$tgl = $tgl;
			$data['bon_sablon'] = $this->Sablon_Model->getListBonHasilSablon($tgl);
			$css = "assets/bootstrap/css/bootstrap.min.css";
			$page = $this->load->view("frm_print_bon_hasil_sablon",$data,true);
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

	function data_barang_hd()
	{
		$isLogin = $this->isLogin();
	    if($isLogin){
	      	$data["Data"] = array("Title"=>"Data Pengembalian Barang HD");
			$data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
			$this->load->view("header");
			$this->load->view("sidebar",$this->checkStatus());
			$this->load->view("frm_data_pengembalian_hd",$data);
			$this->load->view("footer");
	    }else{
			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
	}

	function getBarangHD()
	{
	  $key = $this->input->get("q");
      if(empty($key)){
        $result = $result = $this->Sablon_Model->getBarangHD();
        echo $result;
      }else{
        $result = $this->Sablon_Model->searchBarangHD($key);
        echo $result;
      }
	}

	function addDataPengembalianHD()
	{
		$isLogin = $this->isLogin();
		if($isLogin){
			$key  = $this->input->post('ukuran');
			$data = array();
			$data['tgl_transaksi'] 	= $this->input->post('tgl');
			$data['jumlah_berat'] 	= $this->input->post('berat');
			$data['jumlah_lembar'] 	= $this->input->post('lembar');
			$data['customer'] 	    = $this->input->post('customer');
			$data['bagian'] 		= "SABLON";
			$data['keterangan_history'] = "KEMBALIAN DARI SABLON";
			$data['id_user']		= $this->session->userdata('fabricationIdUser');
			$detail = $this->Sablon_Model->getDetailHD($key);
			foreach ($detail->result_array() as $hd) {
				$data['kd_gd_hasil'] = $hd['kd_gd_hasil'];
				$data['ukuran'] = $hd['ukuran'];
				$data['warna'] 	= $hd['warna_plastik'];
				$data['merek'] 	= $hd['merek'];
				$data['jns_permintaan'] = $hd['jns_permintaan'];
				$data['sts_barang'] = $hd['jns_brg'];
			}

			$result = $this->Sablon_Model->addDataPengembalianHD($data);
			echo $result;


	    }else{
			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
	}

	function getDataPengembalianHD()
	{
		$result = $this->Sablon_Model->getDataPengembalianHD();
		echo $result;
	}

	function deleteListKembalianHD()
	{
		$isLogin = $this->isLogin();
	    if($isLogin){
	    	$key = $this->input->post('key');
	      	$result = $this->Sablon_Model->deleteListKembalianHD($key);
	      	echo $result;
	    }else{
			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
	}

	function editKembalianHD()
	{
		$isLogin = $this->isLogin();
	    if($isLogin){
	    	$key = $this->input->post('id');
	      	$result = $this->Sablon_Model->getDataPengembalianHDById($key);

	      	echo $result;
	    }else{
			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
	}

	function kirimPengembalianHD()
	{
		$isLogin = $this->isLogin();
	    if($isLogin){
	      	$result = $this->Sablon_Model->kirimPengembalianHD();
	      	echo $result;
	    }else{
			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
	}

	function getMerekSablon()
	{
	 	$key = $this->input->get("q");
		if(empty($key)){
			$merek = $this->Sablon_Model->getMerekSablon();
			echo $merek;
		}else{
			$result = $this->Sablon_Model->searchMerekSablon($key);
			echo $result;
		}
	}

	function addRencanaSusulan()
	{
		$isLogin = $this->isLogin();
	    if($isLogin){
	      	$data = array();
	      	$data['kd_sablon'] = $this->input->post('kd_sablon');
	      	$merek = explode("|", $this->input->post('merek'));
	      	$data['kd_gd_hasil'] = $merek[0];
	      	$data['merek'] = $merek[1];
	      	$data['ukuran'] = $merek[2];
	      	$data['warna_plastik'] = $merek[3];
	      	$data['tgl_rencana'] = $this->input->post('tgl_rencana');
	      	$data['jml_rencana'] = $this->input->post('jml_rencana');
	      	$data['jml_sisa'] = $this->input->post('jml_rencana');
	      	$data['sts_pengerjaan'] = "PROGRESS";
	      	$data['customer'] = $this->input->post('customer');
	      	$data['tgl_rencana'] = $this->input->post('tgl_rencana');
	      	$data['warna_sablon'] = $this->input->post('warna_sablon');
	      	$data['nm_operator'] = $this->input->post('nm_operator');

	      	$result = $this->Sablon_Model->insertRencanaSusulan($data);
	      	echo $result;

	    }else{
			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
	}

	function getKdSablon()
	{
		$kd_sablon = $this->Sablon_Model->codeSablon();
		echo $kd_sablon;
	}

	function updateListPengembalianHD()
	{
		$data = array();
		$data["id"] =  $this->input->post("id");
		$data["jumlah_lembar"] = $this->input->post("lembar");
		$data["jumlah_berat"]  = $this->input->post("berat");
		$data["tgl_transaksi"] = $this->input->post("tanggal");
		$data["customer"]      = $this->input->post("customer");

		$result = $this->Sablon_Model->updateListPengembalianHD($data);
		echo $result;
	}

	function getDataPenggunaanBahanSablonById()
	{
		$id = $this->input->post("id");
		$result = $this->Sablon_Model->getDataPenggunaanBahanSablonById($id);
		echo $result;
	}

	function updatePenggunaanBahanSablon()
	{
		$isLogin = $this->isLogin();
	    if($isLogin){
	    	$satuan_pemakaian = $this->input->post("satuan_pemakaian");
	      	$satuan_sisa = $this->input->post("satuan_sisa");
	      	$jumlah_pengambilan = $this->input->post("jum_pemakaian");
	      	$sisa_pengambilan = $this->input->post("sisa_pemakaian");

	      	$data = array();
	      	$satuan_pemakaian == "Kg" ? $jumPengambilan=$jumlah_pengambilan : $jumPengambilan=$jumlah_pengambilan*0.1;
	      	$satuan_sisa == "Kg" ? $sisaPengambilan=$sisa_pengambilan : $sisaPengambilan=$sisa_pengambilan*0.1;
	      	$data["id"] = $this->input->post("id");
	      	$data["jumlah_pengambilan"] = $jumPengambilan;
	      	$data["sisa_pengambilan"]   = $sisaPengambilan;

	      	$result = $this->Sablon_Model->updatePenggunaanBahanSablon($data);
	      	echo $result;
	    }else{
			echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
			redirect("_main/main","refresh");
	    }
	}

	function getDataHasilSablonById()
	{
		$id = $this->input->post("id");
		$result = $this->Sablon_Model->getDataHasilSablonById($id);
		echo $result;
	}

	function updateDataHasilSablon()
	{
		$data = array();
		$data['kd_sablon'] = $this->input->post("kd_sablon");
		$data['kd_hasil']  = $this->input->post("kd_hasil_sablon");
		$data['berat']     = $this->input->post("hasil_berat");
		$data['lembar']    = $this->input->post("hasil_lembar");
		$data['hasil_awal']= $this->input->post("hasil_awal");

		$result = $this->Sablon_Model->updateDataHasilSablon($data);
		echo $result;
	}

	function deleteHasilSablon()
	{
		$idSablon = $this->input->post("idSablon");
		$idHasil  = $this->input->post("idHasil");
		$result = $this->Sablon_Model->deleteHasilSablon($idSablon,$idHasil);
		echo $result;
	}
}
