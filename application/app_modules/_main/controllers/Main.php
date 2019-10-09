<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("Main_Model");
	}

	public function index(){
		$this->session_check();
	}

	public function session_check(){
		$id_user = $this->session->userdata("fabricationIdUser");
		$username = $this->session->userdata("fabricationUsername");
		$status = $this->session->userdata("fabricationStatus");
		$group = $this->session->userdata("fabricationGroup");
		$ip_address = $this->session->userdata("fabricationIpAddress");
		if(!empty($username) && !empty($ip_address) && !empty($id_user) && !empty($group) && !empty($status)){
			switch ($group) {
				case 'marketing':redirect("_marketing/main","refresh"); break;
				case 'extruder':redirect("_extruder/main","refresh"); break;
				case 'ppic':redirect("_ppic/main","refresh"); break;
				case 'gudang roll':redirect("_gudangroll/main","refresh"); break;
				case 'gudang hasil':redirect("_gudanghasil/main","refresh"); break;
				case 'gudang bahan':redirect("_gudangbahan/main","refresh"); break;
				case 'pengiriman':redirect("_pengiriman/main","refresh"); break;
				case 'cutting':redirect("_cutting/main","refresh"); break;
				case 'cetak':redirect("_cetak/main","refresh"); break;
				case 'sablon':redirect("_sablon/main","refresh"); break;
				case 'purchasing':redirect("_purchasing/main","refresh"); break;
				case 'accounting':redirect("_accounting/main","refresh"); break;
				case 'cabang':redirect("_cabang/main","refresh"); break;
				case 'it_department':redirect("_superuser/main","refresh"); break;
				case 'administrator':redirect("_superuser/main","refresh"); break;
				case 'pajak':redirect("_pajak/main","refresh"); break;


				default:echo "<script>alert('Maaf Anda Tidak Memiliki Hak Akses!')</script>";break;
			}
		}else{
			$this->load->view("header");
			$this->load->view("login");
			$this->load->view("footer");
		}
	}

	public function login(){
		$this->form_validation->set_rules('txt_username', 'Username', 'trim|required');
		$this->form_validation->set_rules('txt_password', 'Password', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			echo "<script>document.location('./')</script>";
		}else{
			$arrInputData = array('username'=>$this->input->post("txt_username"),"password"=>$this->input->post("txt_password"));
			$hasil = $this->Main_Model->loginModel($arrInputData);
			if($hasil['isTrue']){
				$sessionData = array(
									 "fabricationIdUser"=>$hasil['id_user'],
									 "fabricationUsername"=>$hasil['username'],
									 "fabricationStatus"=>$hasil['status'],
									 "fabricationGroup"=>$hasil['group'],
									 "fabricationIpAddress"=>$_SERVER['REMOTE_ADDR'],
									 "fabricationSubGroup"=>$hasil['sub_group']
									 );
				$this->session->set_userdata($sessionData);
				$this->session_check();
			}else{
				echo "<script>alert('Anda tidak terdaftar di database kami!');</script>";
				echo "<script>document.location='./'</script>";
			}
		}
	}

	public function logout(){
		$this->session->unset_userdata("fabricationIdUser");
		$this->session->unset_userdata("fabricationUsername");
		$this->session->unset_userdata("fabricationStatus");
		$this->session->unset_userdata("fabricationGroup");
		$this->session->unset_userdata("fabricationIpAddress");
		$this->session->sess_destroy();
		echo "<script>document.location='./'</script>";
	}
}
?>
