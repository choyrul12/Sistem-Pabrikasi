<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
		parent::__construct();
		#$this->load->model("Cabang_Model");
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
        $this->session->userdata("fabricationGroup")=="it_departement"||
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

  public function function_name(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Title");
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
}
?>
