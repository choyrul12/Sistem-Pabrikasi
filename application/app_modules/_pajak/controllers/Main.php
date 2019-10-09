<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
		parent::__construct();
		$this->load->model("Pajak_Models");
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
       ($this->session->userdata("fabricationGroup")=="pajak"||
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
          array("Content"=>"Daftar Order Dengan Pajak","Link"=>"_pajak/main/listOrderDenganPajak","Name"=>"Approve_Permintaan","Status"=>"Single","Icon"=>"fa fa-check","Id"=>"M_Approve_Permintaan"),
        );
        return $listMenu;
      }else if($status==2) {
        $listMenu["parentMenu"] = array(
          // array("Content"=>"Orderan","Link"=>"_cabang/main/order_baru","Name"=>"Data_Customer","Status"=>"Single","Icon"=>"fa fa-book","Id"=>""),
          // array("Content"=>"Pantau Order","Link"=>"_cabang/main/pantau_order","Name"=>"Order","Status"=>"Single","Icon"=>"fa fa-desktop","Id"=>""),
          // array("Content"=>"History Order","Link"=>"_cabang/main/history_order","Name"=>"History","Parent"=>"History","Status"=>"Single","Icon"=>"fa fa-history","Id"=>""),
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

  public function listOrderDenganPajak()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"List Order Dengan Pajak");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_order_pajak",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDataOrderPajak()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $jenis  = $this->input->post("jenis");
      $tgl    = $this->input->post("tgl");
      $result = $this->Pajak_Models->getDataOrderPajak($jenis);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getLihatPesanan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $no_order = $this->input->post("no_order");
      echo json_encode($this->Pajak_Models->selectLihatPesanan($no_order));
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getLihatPesananDetail(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $no_order = $this->input->get("no_order");
      echo $this->Pajak_Models->selectLihatPesananDetails($no_order);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cetakFakturPesanan($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrDataPesanan = $this->Pajak_Models->selectFakturPesanan($param);
      $arrDataPesananDetail = $this->Pajak_Models->selectFakturPesananDetail($param);
      $result = array("arrDataPesanan" => $arrDataPesanan,
                      "arrDataPesananDetail" => $arrDataPesananDetail);
      $css = "assets/bootstrap/css/bootstrap.min.css";
      $page = $this->load->view("frm_print_faktur",$result,true);
      $this->load->library('m_pdf');
      $this->mpdf->mPDF("utf-8","B5-L",0,"",2,2,5,5,0,0);
      $this->mpdf->SetDisplayPreferences("/FullScreen/FitWindow");
      $this->mpdf->showImageErrors = true;
      $this->mpdf->WriteHTML(file_get_contents($css),1);
      $this->mpdf->WriteHTML($page);
      $this->mpdf->use_kwt = true;
      $this->mpdf->shrink_tables_to_fit = 1;
      $this->mpdf->setFooter("Page ".'{PAGENO}');
      $this->mpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

}
?>
