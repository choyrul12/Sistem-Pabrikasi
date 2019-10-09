 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MX_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model("Marketing_Models");
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
       ($this->session->userdata("fabricationGroup")=="marketing"||
        $this->session->userdata("fabricationGroup")=="it_department"||
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
          array("Content"=>"Data Customer","Link"=>"#","Name"=>"Data_Customer","Status"=>"Parent","Icon"=>"fa fa-users"),
          array("Content"=>"Order","Link"=>"#","Name"=>"Order","Status"=>"Parent","Icon"=>"fa fa-desktop"),
          array("Content"=>"History","Link"=>"_marketing/main/history","Name"=>"History","Parent"=>"History","Status"=>"Single","Icon"=>"fa fa-history"),
          array("Content"=>"Statistik Penjualan","Link"=>"#","Name"=>"Statistik","Status"=>"Parent","Icon"=>"fa fa-line-chart"),
        );
        $listMenu["childMenu"] = array(
          array("Content"=>"Tambah Data Customer","Link"=>"_marketing/main/add_customer","Parent"=>"Data_Customer"),
          array("Content"=>"List Data Customer","Link"=>"_marketing/main/list_customer","Parent"=>"Data_Customer"),
          array("Content"=>"Pantau Order","Link"=>"_marketing/main/pantau_order","Parent"=>"Order"),
          array("Content"=>"Order Baru","Link"=>"_marketing/main/order_baru","Parent"=>"Order"),
          array("Content"=>"Per Customer","Link"=>"_marketing/main/statistik_customer","Parent"=>"Statistik"),
          array("Content"=>"Order Per Hari","Link"=>"_marketing/main/order_per_hari","Parent"=>"Statistik"),
          array("Content"=>"Statistik Order","Link"=>"_marketing/main/statistik_order","Parent"=>"Statistik"),
          #array("Content"=>"Statistik Penjualan Global","Link"=>"_marketing/main/statistik_global","Parent"=>"Statistik"),
          #array("Content"=>"Statistik Penjualan Tahuan","Link"=>"_marketing/main/statistik_tahunan","Parent"=>"Statistik"),
        );
        return $listMenu;
      }else if($status==2) {
        $listMenu["parentMenu"] = array(
          array("Content"=>"Data Customer","Link"=>"#","Name"=>"Data_Customer","Status"=>"Parent","Icon"=>"fa fa-users"),
          array("Content"=>"Order","Link"=>"#","Name"=>"Order","Status"=>"Parent","Icon"=>"fa fa-desktop"),
          array("Content"=>"History","Link"=>"_marketing/main/history","Name"=>"History","Parent"=>"History","Status"=>"Single","Icon"=>"fa fa-history"),
          #array("Content"=>"Statistik Penjualan","Link"=>"#","Name"=>"Statistik","Status"=>"Parent","Icon"=>"fa fa-line-chart"),
        );
        $listMenu["childMenu"] = array(
          array("Content"=>"Tambah Data Customer","Link"=>"_marketing/main/add_customer","Parent"=>"Data_Customer"),
          array("Content"=>"List Data Customer","Link"=>"_marketing/main/list_customer","Parent"=>"Data_Customer"),
          array("Content"=>"Pantau Order","Link"=>"_marketing/main/pantau_order","Parent"=>"Order"),
          array("Content"=>"Order Baru","Link"=>"_marketing/main/order_baru","Parent"=>"Order"),
          #array("Content"=>"Statistik Penjualan Harian","Link"=>"_marketing/main/statistik_harian","Parent"=>"Statistik"),
          #array("Content"=>"Statistik Penjualan Bulanan","Link"=>"_marketing/main/statistik_bulanan","Parent"=>"Statistik"),
          #array("Content"=>"Statistik Penjualan Tahuan","Link"=>"_marketing/main/statistik_tahunan","Parent"=>"Statistik"),
        );
        return $listMenu;
      }else{

      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function list_customer(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Daftar Data Customer");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_customer",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function add_customer(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Header"] = "ADD";
      $data["CustCode"] = $this->Marketing_Models->getMaxCode();
      $data["Data"] = array("Title"=>"Tambah Data Customer Baru");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $data["Kabupaten"] = $this->Marketing_Models->selectKabupaten();
      $data["Provinsi"] = $this->Marketing_Models->selectProvinsi();
      $data["Negara"] = $this->Marketing_Models->selectNegara();
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_customer",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function product_service($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("Header"=>"ADD",
                    "Data"=>array("Title"=>"Tambah Data Produk Servis"),
                    "Link"=>array("Segment1"=>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2)),
                    "CustCode"=>$param,
                    "CustomerData"=>$this->Marketing_Models->selectCustomerId($param),
                    "ProductService"=>$this->Marketing_Models->selectProductService($param));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_product_service",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function order_baru($param="",$param2=""){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = array("Data"=>array("Title"=>"Buat Order Baru","KodeCust"=>$param,"NmCust"=>$param2),
                    "Link"=>array("Segment1"=>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2)),
                    "Value"=>array("NoOrder"=>$this->Marketing_Models->getMaxNoOrder()),
                    "DataCustomer"=>$this->Marketing_Models->selectCustomerId($param)
                  );
      if($param!=""){
        $data["ProductService"] = $this->Marketing_Models->selectProductService($param);
      }
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_order",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function history(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"History Order Customer");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("history_order",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function statistik_customer(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"History Order Customer");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_cust_stat",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function show_product_service_note($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = $this->Marketing_Models->selectNoteProductService($param);
      foreach ($data as $arrData) {
        echo "
          <div class='modal fade' id='myModal' role='dialog'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <a class='close' data-dismiss='modal'>&times;</a>
                  <h3>Note</h3>
                </div>
                <div class='modal-body'>
                  $arrData[note]
                </div>
                <div class='modal-footer'>
                </div>
              </div>
            </div>
          </div>
        ";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function edit_product_service($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = $this->Marketing_Models->selectProductServiceId($param);
      $url = base_url()."_marketing/main/modifyProductService/".$param;
      foreach ($data as $arrData) {
        echo "
          <div class='modal fade' id='product_service_modal_edit' role='dialog'>
            <div class='modal-dialog modal-lg'>
              <form action='$url' enctype='multipart/form-data' method='post' accept-charset='utf-8'>
                <input type='hidden' value='$arrData[kd_cust]' name='kd_cust'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                    <h4 class='modal-title' id='myModalLabel'>Ubah Produk Service</h4>
                  </div>
                  <div class='modal-body'>
                    <table class='table'>
                      <tr>
                        <td width='20%'>Nama Produk</td>
                        <td width='1%'>:</td>
                        <td>
                          <input type='text' id='txt_nm_produk' name='txt_nm_produk' class='form-control' placeholder='Masukan Nama Produk' value='$arrData[servis_produk]'>
                        </td>
                      </tr>
                      <tr>
                        <td>Ukuran</td>
                        <td>:</td>
                        <td>
                          <input type='text' id='txt_ukuran' name='txt_ukuran' class='form-control' placeholder='Masukan Ukuran Produk' value='$arrData[ukuran]'>
                        </td>
                      </tr>
                      <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td>
                          <input type='text' id='txt_harga' name='txt_harga' class='form-control' placeholder='Masukan Harga Produk' value='$arrData[harga]'>
                        </td>
                      </tr>
                      <tr>
                        <td>Term Payment</td>
                        <td>:</td>
                        <td>
                          <input type='text' id='txt_payment' name='txt_payment' class='form-control' placeholder='Masukan Term Payment' value='$arrData[term_payment]'>
                        </td>
                      </tr>
                      <tr>
                        <td>Merek</td>
                        <td>:</td>
                        <td>
                          <input type='text' id='txt_merek' name='txt_merek' class='form-control' placeholder='Masukan Merek Produk' value='$arrData[merek]'>
                        </td>
                      </tr>
                      <tr>
                        <td>Gambar</td>
                        <td>:</td>
                        <td>
                          <input type='file' id='txt_file' name='txt_file' class='form-control'>
                          <p class='text-danger'>Max. Size 1MB</p>
                          <p class='text-warning'>Abaikan jika tidak ingin mengubah foto</p>
                        </td>
                      </tr>
                      <tr>
                        <td>Note</td>
                        <td>:</td>
                        <td>
                          <textarea id='txt_note2' name='txt_note'>$arrData[note]</textarea>
                          <script>
                            var editor = CKEDITOR.instances.txt_note2;
                            if(typeof editor == 'undefined'){
                              CKEDITOR.replace('txt_note2');
                            }else{
                              var element = CKEDITOR.document.getById( 'txt_note2' );
                              element.remove();
                              CKEDITOR.replace('txt_note2');
                            }
                          </script>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class='modal-footer'>
                    <button type='button' class='btn btn-default pull-left' data-dismiss='modal'>Close</button>
                    <input type='submit' id='btn-edit' class='btn btn-primary' value='Ubah Data'>
                  </div>
                </div>
              </form>
            </div>
          </div>";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function edit_customer($kd_cust){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Header"] = "MODIFY";
      $data["Data"] = array("Title"=>"Ubah Data Customer");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $data["Kabupaten"] = $this->Marketing_Models->selectKabupaten();
      $data["Provinsi"] = $this->Marketing_Models->selectProvinsi();
      $data["Negara"] = $this->Marketing_Models->selectNegara();
      $data["Customer"] = $this->Marketing_Models->selectCustomerId($kd_cust);
      $data["ProductService"]=$this->Marketing_Models->selectProductService($kd_cust);
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_customer",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveCustomer(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $header = $this->input->post("header");
      $kd_cust = $this->input->post('txt_no_cust');
      $no_cust = $this->input->post("txt_kd_cust");
      $nm_perusahaan = $this->input->post('txt_nm_perusahaan');
      $bidang_perusahaan = $this->input->post('cmb_bidang');
      $nm_own = $this->input->post('txt_nm_owner');
      $hp_own = $this->input->post('txt_hp_own');
      $nm_purchasing = $this->input->post('txt_nm_purchasing');
      $hp_purchasing = $this->input->post('txt_hp_purchasing');
      $jenkel = $this->input->post('rb_jenkel');
      $telp_pri = $this->input->post('txt_telp_primary');
      $telp_sec = $this->input->post('txt_telp_secondary');
      $alamat_pri = $this->input->post('txt_alamat');
      $alamat_sec = $this->input->post('txt_alamat_secondary');
      $negara = $this->input->post('cmb_negara');
      $provinsi = $this->input->post('cmb_provinsi');
      $kota = $this->input->post('cmb_kota');
      $fax = $this->input->post('txt_fax');
      $kd_pos = $this->input->post('txt_kd_pos');
      $email_pri = $this->input->post('txt_email');
      $email_sec = $this->input->post('txt_email_secondary');
      $pajak = $this->input->post('rb_pajak');
      $web = $this->input->post('txt_web');
      $note = $this->input->post('txt_note');

      #validasi jika input kosong
      if(empty($kd_cust)||
         empty($nm_perusahaan)||
         empty($bidang_perusahaan)||
         empty($nm_purchasing)||
         empty($hp_purchasing)||
         empty($jenkel)||
         $telp_pri==""||
         empty($alamat_pri)||
         $pajak==""
       ){
         echo "<script>alert('Gagal,Semua data yang berbintang tidak boleh kosong!')</script>";
      }else{
        #inisialisasi array untuk di kirim ke Marketing_Models
        $data = array("kd_cust" => $kd_cust,
                      "nm_owner" => $nm_own,
                      "no_cust"=>$no_cust,
                      "nm_purchasing"=> $nm_purchasing,
                      "hp_purchasing"=> $hp_purchasing,
                      "gender"=> $jenkel,
                      "nm_perusahaan"=> $nm_perusahaan,
                      "hp_owner"=> $hp_own,
                      "bidang_perusahaan"=> $bidang_perusahaan,
                      "tlp_kantor"=> $telp_pri,
                      "tlp_lainnya"=> $telp_sec,
                      "alamat"=> $alamat_pri,
                      "alamat_lainnya"=> $alamat_sec,
                      "kota"=> $kota,
                      "negara"=> $negara,
                      "provinsi"=> $provinsi,
                      "no_fax"=> $fax,
                      "kode_pos"=> $kd_pos,
                      "email"=> $email_pri,
                      "email_lainnya"=> $email_sec,
                      "pajak"=> $pajak,
                      "note"=> $note,
                      "website"=> $web,
                      "diperbarui"=> Date("Y-m-d H:i:s")
                      );
        if($header == "ADD"){
          $data = array("kd_cust" => $kd_cust,
                        "nm_owner" => $nm_own,
                        "no_cust"=>$no_cust,
                        "nm_purchasing"=> $nm_purchasing,
                        "hp_purchasing"=> $hp_purchasing,
                        "gender"=> $jenkel,
                        "nm_perusahaan"=> $nm_perusahaan,
                        "hp_owner"=> $hp_own,
                        "bidang_perusahaan"=> $bidang_perusahaan,
                        "tlp_kantor"=> $telp_pri,
                        "tlp_lainnya"=> $telp_sec,
                        "alamat"=> $alamat_pri,
                        "alamat_lainnya"=> $alamat_sec,
                        "kota"=> $kota,
                        "negara"=> $negara,
                        "provinsi"=> $provinsi,
                        "no_fax"=> $fax,
                        "kode_pos"=> $kd_pos,
                        "email"=> $email_pri,
                        "email_lainnya"=> $email_sec,
                        "pajak"=> $pajak,
                        "note"=> $note,
                        "website"=> $web,
                        "diperbarui"=> Date("Y-m-d H:i:s")
                        );
          $status = $this->Marketing_Models->insertCustomer($data); #menangkap return value dari Marketing_Models
          if($status){
            echo "<script>alert('Selamat, Data customer baru berhasil diinput');</script>";
            // redirect("_marketing/main/add_customer","refresh");
          }else{
            echo "<script>alert('Maaf, Data customer baru gagal diinput');</script>";
            // redirect("_marketing/main/add_customer","refresh");
          }
        }elseif ($header == "MODIFY") {
          if(empty($nm_perusahaan) || strlen($nm_perusahaan)<=1){
            $nmPerusahaan = null;
          }else{
            $nmPerusahaan = $nm_perusahaan;
          }

          if(empty($nm_purchasing) || strlen($nm_purchasing)<=1){
            $nmPurchasing = null;
          }else{
            $nmPurchasing = $nm_purchasing;
          }

          if(empty($no_cust) || strlen($no_cust)<=1){
            $noCust = null;
          }else{
            $noCust = $no_cust;
          }

          if(empty($nm_own) || strlen($nm_own)<=1){
            $nmOwner = null;
          }else{
            $nmOwner = $nm_own;
          }
         $data = array("kd_cust" => $kd_cust,
                       "nm_owner_update" => $nmOwner,
                       "no_cust_update"=>$noCust,
                       "nm_purchasing_update"=> $nmPurchasing,
                       "hp_purchasing"=> $hp_purchasing,
                       "gender"=> $jenkel,
                       "nm_perusahaan_update"=> $nmPerusahaan,
                       "hp_owner"=> $hp_own,
                       "bidang_perusahaan"=> $bidang_perusahaan,
                       "tlp_kantor"=> $telp_pri,
                       "tlp_lainnya"=> $telp_sec,
                       "alamat"=> $alamat_pri,
                       "alamat_lainnya"=> $alamat_sec,
                       "kota"=> $kota,
                       "negara"=> $negara,
                       "provinsi"=> $provinsi,
                       "no_fax"=> $fax,
                       "kode_pos"=> $kd_pos,
                       "email"=> $email_pri,
                       "email_lainnya"=> $email_sec,
                       "pajak"=> $pajak,
                       "note"=> $note,
                       "website"=> $web,
                       "diperbarui"=> Date("Y-m-d H:i:s")
                     );
          $status = $this->Marketing_Models->updateCustomer($data); #menangkap return value dari Marketing_Models
          if($status){
            echo "<script>alert('Selamat, Data customer berhasil diubah');</script>";
            // redirect("_marketing/main/list_customer","refresh");
          }else{
            echo "<script>alert('Maaf, Data customer gagal diubah');</script>";
            // redirect("_marketing/main/list_customer","refresh");
          }
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveProductService($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $param;
      $servis_produk = $this->input->post("txt_nm_produk");
      $payment = $this->input->post("txt_payment");
      $ukuran = $this->input->post("txt_ukuran");
      $harga = $this->input->post("txt_harga");
      $merek = $this->input->post("txt_merek");
      $note = $this->input->post("txt_note");
      $foto = str_replace(" ", "_", $_FILES["txt_file"]["name"]);

      $config_image['upload_path'] = './assets/images/upload/';
  		$config_image['allowed_types'] = 'jpg|jpeg|png';
  		$config_image['max_size'] = 1024;
  		$config_image['overwrite'] = FALSE;
  		$config_image['file_name'] = $foto;
  		$this->load->library('upload',$config_image);
  		$this->upload->initialize($config_image);

      if(empty($kd_cust)&&
         empty($servis_produk)&&
         empty($payment)&&
         empty($ukuran)&&
         empty($harga)&&
         empty($merek)){
           echo "Data yang berbintang tidak boleh kosong!";
      }else{
        if ($this->upload->do_upload('txt_file')) {
          #======================Save Product Service With Image======================
          $data = array("kd_cust" => $kd_cust,
                        "servis_produk" => $servis_produk,
                        "term_payment" => $payment,
                        "ukuran" => $ukuran,
                        "harga" => $harga,
                        "merek" => $merek,
                        "note" => $note,
                        "foto" => $foto);
          $status = $this->Marketing_Models->insertProductServices($data);
          if($status){
            redirect(base_url()."_marketing/main/product_service/".$kd_cust,"refresh");
          }else{
            redirect(base_url()."_marketing/main/product_service/".$kd_cust,"refresh");
          }
        }else{
          #======================Save Product Service Without Image======================
          $data = array("kd_cust" => $kd_cust,
                         "servis_produk" => $servis_produk,
                         "term_payment" => $payment,
                         "ukuran" => $ukuran,
                         "harga" => $harga,
                         "merek" => $merek,
                         "note" => $note,
                         "foto" => "Tidak Tersedia");
          $status = $this->Marketing_Models->insertProductServices($data);
          if($status){
            redirect(base_url()."_marketing/main/product_service/".$kd_cust,"refresh");
          }else{
            redirect(base_url()."_marketing/main/product_service/".$kd_cust,"refresh");
          }
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function modifyProductService($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id_sp = $param;
      $kd_cust = $this->input->post("kd_cust");
      $servis_produk = $this->input->post("txt_nm_produk");
      $payment = $this->input->post("txt_payment");
      $ukuran = $this->input->post("txt_ukuran");
      $harga = $this->input->post("txt_harga");
      $merek = $this->input->post("txt_merek");
      $note = $this->input->post("txt_note");
      $foto = str_replace(" ", "_", $_FILES["txt_file"]["name"]);

      $config_image['upload_path'] = './assets/images/upload/';
   		$config_image['allowed_types'] = 'jpg|jpeg|png';
     	$config_image['max_size'] = 1024;
     	$config_image['overwrite'] = TRUE;
     	$config_image['file_name'] = $foto;
     	$this->load->library('upload',$config_image);
     	$this->upload->initialize($config_image);

      if(empty($id_sp)&&
        empty($servis_produk)&&
        empty($payment)&&
        empty($ukuran)&&
        empty($harga)&&
        empty($merek)){
          echo "Data yang berbintang tidak boleh kosong!";
      }else{
        if ($this->upload->do_upload('txt_file')) {
          #======================Modify Product Service With Image======================
           $data = array( "id_sp" => $id_sp,
                          "servis_produk" => $servis_produk,
                          "term_payment" => $payment,
                          "ukuran" => $ukuran,
                          "harga" => $harga,
                          "merek" => $merek,
                          "note" => $note,
                          "foto" => $foto);
           $status = $this->Marketing_Models->updateProductServices($data);
           if($status){
             redirect(base_url()."_marketing/main/product_service/".$kd_cust,"refresh");
           }else{
             redirect(base_url()."_marketing/main/product_service/".$kd_cust,"refresh");
           }
        }else{
          #======================Save Product Service Without Image======================
          $data = array( "id_sp" => $id_sp,
                        "servis_produk" => $servis_produk,
                        "term_payment" => $payment,
                        "ukuran" => $ukuran,
                        "harga" => $harga,
                        "merek" => $merek,
                        "note" => $note);
          $status = $this->Marketing_Models->updateProductServices($data);
          if($status){
           echo "<script>alert('Data Berhasil Diubah');</script>";
           redirect(base_url()."_marketing/main/product_service/".$kd_cust,"refresh");
          }else{
           echo "<script>alert('Data Gagal Diubah');</script>";
           redirect(base_url()."_marketing/main/product_service/".$kd_cust,"refresh");
          }
        }
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function removeProductService(){
   $isLogin = $this->isLogin();
   if($isLogin){
     $id_sp = $this->input->post("id_sp");
     $kd_cust = $this->input->post("kd_cust");
     $status = $this->Marketing_Models->deleteProductServices($id_sp);
     if($status){
       echo "Berhasil";
     }else{
       echo "Gagal";
     }
   }else{
     echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
     redirect("_main/main","refresh");
   }
  }

  public function getCustomerListJson(){
    $isLogin = $this->isLogin();
    if($isLogin){
      echo $this->Marketing_Models->selectCustomerListJson();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getProductServiceJson(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->get("kd_cust");
      echo $this->Marketing_Models->selectProductServiceJson($kd_cust);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getProdukServisNoteJson(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id_sp = $this->input->get("id_sp");
      echo $this->Marketing_Models->selectProdukServisNoteJson($id_sp);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getOrderListJson(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Marketing_Models->selectOrderListJson();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getClosedOrderListJson(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Marketing_Models->selectClosedOrderListJson();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getHistoryOrderJson(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->get("kd_cust");
      echo $this->Marketing_Models->selectHistoryOrderJson($kd_cust);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getHistoryOrderJsonLama(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kdCust = $this->input->post("kdCust");
      $data = array("kdCust" => $kdCust);
      $result = $this->Marketing_Models->selectHistoryOrderJsonLama($data);
      echo $result;

    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getStatistikCustomerGlobalJson(){
    $isLogin = $this->isLogin();
    if($isLogin){
      echo $this->Marketing_Models->selectStatistikCustomerGlobalJson();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getDetailStatistikCustomerJson($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $tgl_awal = $this->input->get("tgl_awal");
      $tgl_akhir = $this->input->get("tgl_akhir");
      if(empty($tgl_awal) || empty($tgl_akhir)){
        echo $this->Marketing_Models->selectDetailStatistikCustomerJson($param);
      }else{
        $data = array("tgl_awal" => $tgl_awal,
                      "tgl_akhir" => $tgl_akhir,
                      "kd_cust" => $param);
        echo $this->Marketing_Models->selectDetailStatistikCustomerTanggalJson($data);
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOrderKg(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOrderKg($arrData);
      $value = array("Bulan"=>array_column($data,'bulan'),
                     "Jumlah"=>array_column($data,'jumlah_kg'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOrderKgPerTanggal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOrderKgPerTanggal($arrData);
      $value = array("Bulan"=>array_column($data,'tanggal'),
                     "Jumlah"=>array_column($data,'jumlah_kg'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOrderLembar(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOrderLembar($arrData);
      $value = array("Bulan"=>array_column($data,'bulan'),
                     "Jumlah"=>array_column($data,'jumlah_lembar'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOrderLembarPerTanggal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOrderLembarPerTanggal($arrData);
      $value = array("Bulan"=>array_column($data,'tanggal'),
                     "Jumlah"=>array_column($data,'jumlah_lembar'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOrderBal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOrderBal($arrData);
      $value = array("Bulan"=>array_column($data,'bulan'),
                     "Jumlah"=>array_column($data,'jumlah_bal'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOrderBalPerTanggal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOrderBalPerTanggal($arrData);
      $value = array("Bulan"=>array_column($data,'tanggal'),
                     "Jumlah"=>array_column($data,'jumlah_bal'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOrderKaleng(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOrderKaleng($arrData);
      $value = array("Bulan"=>array_column($data,'bulan'),
                     "Jumlah"=>array_column($data,'jumlah_kaleng'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOrderKalengPerTanggal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOrderKalengPerTanggal($arrData);
      $value = array("Bulan"=>array_column($data,'tanggal'),
                     "Jumlah"=>array_column($data,'jumlah_kaleng'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOmsetOrderKg(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOmsetOrderKg($arrData);
      $value = array("Bulan"=>array_column($data,'bulan'),
                     "Jumlah"=>array_column($data,'omset_kg'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOmsetOrderKgPerTanggal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOmsetOrderKgPerTanggal($arrData);
      $value = array("Bulan"=>array_column($data,'tanggal'),
                     "Jumlah"=>array_column($data,'omset_kg'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOmsetOrderLembar(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOmsetOrderLembar($arrData);
      $bulan = array_column($data,'bulan');
      $value = array("Bulan"=>array_column($data,'bulan'),
                     "Jumlah"=>array_column($data,'omset_lembar'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getChartDataOmsetOrderLembarPerTanggal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $tgl_awal = $this->input->post("tgl_awal");
      $tgl_akhir = $this->input->post("tgl_akhir");
      $arrData = array("kd_cust"=>$kd_cust,
                       "tgl_awal"=>$tgl_awal,
                       "tgl_akhir"=>$tgl_akhir);
      $data=$this->Marketing_Models->selectChartDataOmsetOrderLembarPerTanggal($arrData);
      $bulan = array_column($data,'bulan');
      $value = array("Bulan"=>array_column($data,'tanggal'),
                     "Jumlah"=>array_column($data,'omset_lembar'));
      echo json_encode($value);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function detail_statistik($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Detail Statistik");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $data["CustomerData"] = $this->Marketing_Models->selectCustomerId($this->uri->rsegment(3));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_detail_stat_cust",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCustomerLike(){
    $isLogin = $this->isLogin();
    if($isLogin){
     $param = $this->input->get("q");
     if (!empty($param)) {
       $data = $this->Marketing_Models->selectCustomerLike($param);
     }else{
       $data = $this->Marketing_Models->selectCustomerLimit20();
     }
     echo json_encode($data);
   }else{
     echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
     redirect("_main/main","refresh");
   }
  }

  public function getGudangHasilLike(){
   $isLogin = $this->isLogin();
   if($isLogin){
     $param = $this->input->get("q");
     if (!empty($param)) {
       $data = $this->Marketing_Models->selectGudangHasilLike($param);
     }else{
       $data = $this->Marketing_Models->selectGudangHasilLimit20();
     }
     echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCustomerOrder(){
   $isLogin = $this->isLogin();
   if($isLogin){
     $param = $this->input->post("kd_cust");
     $data = $this->Marketing_Models->selectCustomerId($param);
     echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCustomerDetailJson(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $kd_cust = $this->input->post("kd_cust");
      $data = $this->Marketing_Models->selectCustomerId($kd_cust);
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function savePesananDetailTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $no_order = $this->input->post("no_order");
      $kd_cust = $this->input->post("kd_cust");
      $kd_gudang = $this->input->post("kd_gudang");
      $jumlah = $this->input->post("jumlah");
      $satuan = $this->input->post("satuan");
      $harga = $this->input->post("harga");
      $mata_uang = $this->input->post("mata_uang");
      $warna_cetak = $this->input->post("warna_cetak");
      $dll = $this->input->post("dll");
      $strip = $this->input->post("strip");
      $kd_harga = $this->input->post("kd_harga");
      $omset_kg = $this->input->post("omset_kg");
      $omset_lembar = $this->input->post("omset_lembar");
      $potongan = $this->input->post("potongan");
      $hsl_diskon = $this->input->post("hsl_diskon");
      $cn = $this->input->post("cn");
      $merek = $this->input->post("merek");
     if (empty($no_order) ||
         empty($kd_gudang) ||
         empty($jumlah) ||
         empty($satuan) ||
         empty($harga) ||
         empty($mata_uang) ||
         $dll == "" ||
         $strip == "" ||
         empty($kd_harga) ||
         $omset_kg == "" ||
         $omset_lembar == "" ||
         empty($merek) ||
         empty($kd_cust)
        ){
           echo "Data Tidak Boleh Kosong";
      }else{
        if(substr($kd_gudang,0,3)=="BHN"){
          $data = array("no_order"=>$no_order,
                        "kd_cust"=>$kd_cust,
                        "kd_gd_bahan"=>$kd_gudang,
                        "merek"=>$merek,
                        "jumlah"=>$jumlah,
                        "satuan"=>$satuan,
                        "harga"=>$harga,
                        "warna_cetak"=>$warna_cetak,
                        "dll"=>$dll,
                        "sm"=>$strip,
                        "kd_hrg"=>$kd_harga,
                        "omset_lembar"=>$omset_lembar,
                        "omset_kg"=>$omset_kg,
                        "potongan"=>$potongan,
                        "diskon"=>$hsl_diskon,
                        "cn"=>$cn);
        }else{
          $data = array("no_order"=>$no_order,
                        "kd_cust"=>$kd_cust,
                        "kd_gd_hasil"=>$kd_gudang,
                        "merek"=>$merek,
                        "jumlah"=>$jumlah,
                        "satuan"=>$satuan,
                        "harga"=>$harga,
                        "warna_cetak"=>$warna_cetak,
                        "dll"=>$dll,
                        "sm"=>$strip,
                        "kd_hrg"=>$kd_harga,
                        "omset_lembar"=>$omset_lembar,
                        "omset_kg"=>$omset_kg,
                        "potongan"=>$potongan,
                        "diskon"=>$hsl_diskon,
                        "cn"=>$cn);
        }
        $result = $this->Marketing_Models->insertPesananDetailTemp($data);
        if ($result) {
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

  public function savePesananDetail(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $no_order = $this->input->post("no_order");
      #$kd_cust = $this->input->post("kd_cust");
      $kd_gudang = $this->input->post("kd_gudang");
      $jumlah = $this->input->post("jumlah");
      $satuan = $this->input->post("satuan");
      $harga = $this->input->post("harga");
      $mata_uang = $this->input->post("mata_uang");
      $warna_cetak = $this->input->post("warna_cetak");
      $dll = $this->input->post("dll");
      $strip = $this->input->post("strip");
      $kd_harga = $this->input->post("kd_harga");
      $omset_kg = $this->input->post("omset_kg");
      $omset_lembar = $this->input->post("omset_lembar");
      $potongan = $this->input->post("potongan");
      $hsl_diskon = $this->input->post("hsl_diskon");
      $cn = $this->input->post("cn");
      $merek = $this->input->post("merek");
     if (empty($no_order) ||
         empty($kd_gudang) ||
         empty($jumlah) ||
         empty($satuan) ||
         empty($harga) ||
         empty($mata_uang) ||
         empty($dll) ||
         empty($strip) ||
         empty($kd_harga) ||
         empty($omset_kg) ||
         empty($omset_lembar) ||
         empty($merek) #||
         #empty($kd_cust)
        ){
           echo "Data Tidak Boleh Kosong";
      }else{
        if(substr($kd_gudang,0,3)=="BHN"){
          $data = array("no_order"=>$no_order,
                        #"kd_cust"=>$kd_cust,
                        "kd_gd_bahan"=>$kd_gudang,
                        "merek"=>$merek,
                        "jumlah"=>$jumlah,
                        "satuan"=>$satuan,
                        "harga"=>$harga,
                        "warna_cetak"=>$warna_cetak,
                        "dll"=>$dll,
                        "sm"=>$strip,
                        "kd_hrg"=>$kd_harga,
                        "omset_lembar"=>$omset_lembar,
                        "omset_kg"=>$omset_kg,
                        "potongan"=>$potongan,
                        "diskon"=>$hsl_diskon,
                        "cn"=>$cn);
        }else{
          $data = array("no_order"=>$no_order,
                        #"kd_cust"=>$kd_cust,
                        "kd_gd_hasil"=>$kd_gudang,
                        "merek"=>$merek,
                        "jumlah"=>$jumlah,
                        "satuan"=>$satuan,
                        "harga"=>$harga,
                        "warna_cetak"=>$warna_cetak,
                        "dll"=>$dll,
                        "sm"=>$strip,
                        "kd_hrg"=>$kd_harga,
                        "omset_lembar"=>$omset_lembar,
                        "omset_kg"=>$omset_kg,
                        "potongan"=>$potongan,
                        "diskon"=>$hsl_diskon,
                        "cn"=>$cn);
        }
        $result = $this->Marketing_Models->insertPesananDetail($data);
        if ($result) {
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

  public function getPesananDetailsTemp($param, $param2){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = $this->Marketing_Models->selectPesananDetailsTemp($param,$param2);
      $no = 1;
      foreach ($data as $arrData) {
        $url = base_url()."_marketing/main/modifyPesananDetailModal/".$arrData['id_dp'];
        echo "
        <tr>
          <td>$no</td>
          <td>$arrData[jumlah]</td>
          <td>$arrData[satuan]</td>
          <td>$arrData[harga]</td>
          <td>$arrData[mata_uang]</td>
          <td>$arrData[merek]</td>
          <td>$arrData[ukuran]</td>
          <td>$arrData[warna_cetak]</td>
          <td>$arrData[sm]</td>
          <td>$arrData[dll]</td>
          <td>
            <a href='#' class='btn btn-sm btn-warning btn-flat' data-toggle='modal' data-target='#edit-modal-pesanan-detail-temp' onclick='showModalEditPesananDetailTemp($arrData[id_dp])'><i class='fa fa-pencil-square-o'></i></a>
            <a href='#' class='btn btn-sm btn-danger btn-flat' onclick='deletePesananDetailTemp($arrData[id_dp])'><i class='fa fa-trash'></i></a>
            </td>
        </tr>";
        $no++;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPesananDetails($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = $this->Marketing_Models->selectPesananDetails($param);
      $no = 1;
      foreach ($data as $arrData) {
        if($arrData["sts_pesanan"]=="PROGRESS" && !empty($arrData["tgl_kirim_gudang"])){
          $disable = "disabled='disabled' title='Silahkan konfirmasi ke PPIC untuk membuka fitur ini'";
        }else{
          $disable = "";
        }
        $url = base_url()."_marketing/main/modifyPesananDetailModal/".$arrData['id_dp'];
        echo "
        <tr>
          <td>$no</td>
          <td>$arrData[jumlah]</td>
          <td>$arrData[satuan]</td>
          <td>$arrData[harga]</td>
          <td>$arrData[mata_uang]</td>
          <td>$arrData[merek]</td>
          <td>$arrData[ukuran]</td>
          <td>$arrData[warna_cetak]</td>
          <td>$arrData[sm]</td>
          <td>$arrData[dll]</td>
          <td>
            <a href='#' class='btn btn-sm btn-warning btn-flat' data-toggle='modal' data-target='#edit-modal-pesanan-detail' onclick='showModalEditPesananDetail($arrData[id_dp])' $disable><i class='fa fa-pencil-square-o'></i></a>
            <a href='#' class='btn btn-sm btn-danger btn-flat' onclick='deletePesananDetail($arrData[id_dp])' $disable><i class='fa fa-trash'></i></a>
            </td>
        </tr>";
        $no++;
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getModifyPesananDetailTempModal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = $this->input->post("id_dp");
      $data = $this->Marketing_Models->selectPesananDetailsTempId($param);
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getModifyPesananDetailModal(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $param = $this->input->post("id_dp");
      $data = $this->Marketing_Models->selectPesananDetailsId($param);
      echo json_encode($data);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function removePesananDetailTemp(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id_dp = $this->input->post("id");
      $status = $this->Marketing_Models->deletePesananDetailTemp($id_dp);
      if($status){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function removePesananDetail(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id_dp = $this->input->post("id");
      $status = $this->Marketing_Models->deletePesananDetail($id_dp);
      if($status){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function trashPesanan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id_dp = $this->input->post("id");
      $status = $this->Marketing_Models->trashPesananFinal($id_dp);
      echo $status;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getTotalTrash(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $status = $this->Marketing_Models->selectCountTrash();
      echo json_encode(array_column($status,'jumlah_terhapus'));
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPesananTrash(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $status = $this->Marketing_Models->selectPesananTrash();
      echo $status;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function updatePulihkanPesananTrash(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $no_order = $this->input->post("no_order");
      $status = $this->Marketing_Models->updatePulihkanPesananTrash($no_order);
      echo $status;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function show_customer_note($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $data = $this->Marketing_Models->selectNoteCustomer($param);
      foreach ($data as $arrData) {
        echo "
        <div class='modal fade' id='myModal' role='dialog'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <a class='close' data-dismiss='modal' data-target='#myModal'>&times;</a>
                <h3>Note</h3>
              </div>
              <div class='modal-body' style='height:500px; overflow-y:scroll;'>
                $arrData[note]
              </div>
              <div class='modal-footer'>
              </div>
            </div>
          </div>
        </div>";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function show_product_service($param){
    $isLogin = $this->isLogin();
    if($isLogin){
     $data = $this->Marketing_Models->selectProductService($param);
     foreach ($data as $arrData) {
       $url = base_url()."assets/images/upload/".$arrData['foto'];
       echo "
        <tr>
          <td>$arrData[servis_produk]</td>
          <td>$arrData[term_payment]</td>
          <td>$arrData[ukuran]</td>
          <td>$arrData[harga]</td>
          <td>$arrData[merek]</td>
          <td><img src='$url' width='50px' height='50px' alt='Tidak Ada' data-toggle='modal' data-target='#modalShowImage' onclick='showImage(this)'></td>
          <td><a href='#' class='btn btn-sm btn-info' onclick='showModalNoteProductServiceJson($arrData[id_sp])' data-toggle='modal' data-target='#show-note-modal'>Note</a></td>
        </tr>
       ";
     }
   }else{
     echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
     redirect("_main/main","refresh");
   }
  }

  public function show_product_service_note_json(){
    $isLogin = $this->isLogin();
    if($isLogin){
     $param = $this->input->post("id_sp");
     $data = $this->Marketing_Models->selectNoteProductService($param);
     echo json_encode($data);
   }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function savePesananFinal(){
    $isLogin = $this->isLogin();
    if ($isLogin) {
      $kd_cust = $this->input->post("kd_cust");#
      $no_order = $this->input->post("no_order");
      $tgl_pesan = $this->input->post("tgl_pesan");#
      $tgl_estimasi = $this->input->post("tgl_estimasi");#
      $no_po = $this->input->post("no_po");
      $nm_pemesan = $this->input->post("nm_pemesan");#
      $file_1 = str_replace(" ","_",$this->input->post("file_1"));
      $file_2 = str_replace(" ","_",$this->input->post("file_2"));
      $pajak = $this->input->post("pajak");#
      $jns_order = $this->input->post("jns_order");#
      $kd_order = $this->input->post("kd_order");
      $uang_muka = $this->input->post("uang_muka");
      $mata_uang = $this->input->post("mata_uang");#
      $ekspedisi = $this->input->post("ekspedisi");
      $payment = $this->input->post("payment");#
      $note = $this->input->post("note");
      $proof = $this->input->post("proof");#
      $ket_proof = $this->input->post("ket_proof");
      $sales = $this->input->post("sales");
      $diperbarui = date("Y-m-d H:i:s");

      if(!empty($kd_cust)&&
         !empty($tgl_pesan)&&
         !empty($tgl_estimasi)&&
         !empty($nm_pemesan)&&
         !empty($pajak)&&
         !empty($jns_order)&&
         !empty($mata_uang)&&
         !empty($payment)&&
         !empty($proof)&&
         !empty($sales)
       ){
         if($proof=="TIDAK"){
           $ketProof = NULL;
         }else{
           $ketProof  = $ket_proof;
         }
         $data = array("no_order" => $no_order,
                       "kd_order" => $kd_order,
                       "kd_cust" => $kd_cust,
                       "no_po" => $no_po,
                       "id_user" => $this->session->userdata("fabricationIdUser"),
                       "nm_pemesan" => $nm_pemesan,
                       "tgl_pesan" => $tgl_pesan,
                       "tgl_estimasi" => $tgl_estimasi,
                       "payment_method" => $payment,
                       "expedisi" => $ekspedisi,
                       "pajak" => $pajak,
                       "jns_order" => $jns_order,
                       "dp" => $uang_muka,
                       "mata_uang" => $mata_uang,
                       "note" => $note,
                       "foto_1" => $file_1,
                       "foto_2" => $file_2,
                       "proof" => $proof,
                       "sales" => $sales,
                       "ket_proof" => $ketProof,
                       "diperbarui" => $diperbarui);
        $result = $this->Marketing_Models->insertPesananFinal($data);
        if($result) {
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

  public function modifyPesananFinal(){
    $isLogin = $this->isLogin();
    if ($isLogin) {
      $kd_cust = $this->input->post("kd_cust");#
      $no_order = $this->input->post("no_order");
      $tgl_pesan = $this->input->post("tgl_pesan");#
      $tgl_estimasi = $this->input->post("tgl_estimasi");#
      $no_po = $this->input->post("no_po");
      $nm_pemesan = $this->input->post("nm_pemesan");#
      $file_1 = str_replace(" ","_",$this->input->post("file_1"));
      $file_2 = str_replace(" ","_",$this->input->post("file_2"));
      $pajak = $this->input->post("pajak");#
      $jns_order = $this->input->post("jns_order");#
      $kd_order = $this->input->post("kd_order");
      $uang_muka = $this->input->post("uang_muka");
      $mata_uang = $this->input->post("mata_uang");#
      $ekspedisi = $this->input->post("ekspedisi");
      $payment = $this->input->post("payment");#
      $note = $this->input->post("note");
      $proof = $this->input->post("proof");#
      $ket_proof = $this->input->post("ket_proof");
      $diperbarui = date("Y-m-d H:i:s");

      if(!empty($kd_cust)&&
         !empty($tgl_pesan)&&
         !empty($tgl_estimasi)&&
         !empty($nm_pemesan)&&
         !empty($pajak)&&
         !empty($jns_order)&&
         !empty($mata_uang)&&
         !empty($payment)&&
         !empty($proof)
       ){
         if(!empty($file_1)){
           $data = array("no_order" => $no_order,
                         "kd_order" => $kd_order,
                         "kd_cust" => $kd_cust,
                         "no_po" => $no_po,
                         "id_user" => $this->session->userdata("fabricationIdUser"),
                         "nm_pemesan" => $nm_pemesan,
                         "tgl_pesan" => $tgl_pesan,
                         "tgl_estimasi" => $tgl_estimasi,
                         "payment_method" => $payment,
                         "expedisi" => $ekspedisi,
                         "pajak" => $pajak,
                         "jns_order" => $jns_order,
                         "dp" => $uang_muka,
                         "mata_uang" => $mata_uang,
                         "note" => $note,
                         "foto_1" => $file_1,
                         "proof" => $proof,
                         "ket_proof" => $ket_proof,
                         "diperbarui" => $diperbarui);
         }else if(!empty($file_2)){
           $data = array("no_order" => $no_order,
                         "kd_order" => $kd_order,
                         "kd_cust" => $kd_cust,
                         "no_po" => $no_po,
                         "id_user" => $this->session->userdata("fabricationIdUser"),
                         "nm_pemesan" => $nm_pemesan,
                         "tgl_pesan" => $tgl_pesan,
                         "tgl_estimasi" => $tgl_estimasi,
                         "payment_method" => $payment,
                         "expedisi" => $ekspedisi,
                         "pajak" => $pajak,
                         "jns_order" => $jns_order,
                         "dp" => $uang_muka,
                         "mata_uang" => $mata_uang,
                         "note" => $note,
                         "foto_2" => $file_2,
                         "proof" => $proof,
                         "ket_proof" => $ket_proof,
                         "diperbarui" => $diperbarui);
         }else{
           $data = array("no_order" => $no_order,
                         "kd_order" => $kd_order,
                         "kd_cust" => $kd_cust,
                         "no_po" => $no_po,
                         "id_user" => $this->session->userdata("fabricationIdUser"),
                         "nm_pemesan" => $nm_pemesan,
                         "tgl_pesan" => $tgl_pesan,
                         "tgl_estimasi" => $tgl_estimasi,
                         "payment_method" => $payment,
                         "expedisi" => $ekspedisi,
                         "pajak" => $pajak,
                         "jns_order" => $jns_order,
                         "dp" => $uang_muka,
                         "mata_uang" => $mata_uang,
                         "note" => $note,
                         "proof" => $proof,
                         "ket_proof" => $ket_proof,
                         "diperbarui" => $diperbarui);
         }
        $result = $this->Marketing_Models->updatePesanan($data);
        if($result) {
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

  public function uploadFoto(){
    $isLogin = $this->isLogin();
    if ($isLogin) {
      $result = 1;
      if(isset($_FILES["file"])){
        $foto1 = str_replace(" ", "_", $_FILES["file"]["name"]);
        if(!empty($foto1)){
          $config_image['upload_path'] = './assets/images/upload/';
          $config_image['allowed_types'] = 'jpg|jpeg|png';
          $config_image['max_size'] = 1024;
          $config_image['overwrite'] = TRUE;
          $config_image['file_name'] = $foto1;
          $this->load->library('upload',$config_image);
          $this->upload->initialize($config_image);
          if($this->upload->do_upload("file")){
            $result = $result+1;
          }else{
            $result = 0;
          }
        }
      }

      if(isset($_FILES["file2"])){
        $foto2 = str_replace(" ", "_", $_FILES["file2"]["name"]);
        if(!empty($foto2)){
          $config_image['upload_path'] = './assets/images/upload/';
          $config_image['allowed_types'] = 'jpg|jpeg|png';
          $config_image['max_size'] = 1024;
          $config_image['overwrite'] = TRUE;
          $config_image['file_name'] = $foto2;
          $this->load->library('upload',$config_image);
          $this->upload->initialize($config_image);
          if($this->upload->do_upload("file2")){
            $result = $result+1;
          }else{
            $result = 0;
          }
        }
      }

      if($result > 0){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function modifyPesananDetailTemp(){
    $isLogin = $this->isLogin();
    if ($isLogin) {
      $id_dp = $this->input->post("id_dp");#
      $kd_gudang = $this->input->post("kd_gudang");#
      $jumlah = $this->input->post("jumlah");#
      $satuan = $this->input->post("satuan");#
      $harga = $this->input->post("harga");#
      $mata_uang = $this->input->post("mata_uang");#
      $warna = $this->input->post("warna");
      $dll = $this->input->post("dll");#
      $strip = $this->input->post("strip");#
      $kd_harga = $this->input->post("kd_harga");#
      $omset_kg = $this->input->post("omset_kg");#
      $omset_lembar = $this->input->post("omset_lembar");#
      $potongan = $this->input->post("potongan");
      $hsl_diskon = $this->input->post("hsl_diskon");
      $cn = $this->input->post("cn");
      $merek = $this->input->post("merek");#
      if(empty($id_dp) ||
         empty($jumlah) ||
         empty($satuan) ||
         empty($harga) ||
         empty($mata_uang) ||
         $dll == "" ||
         $strip == "" ||
         empty($kd_harga) ||
         $omset_kg == "" ||
         $omset_lembar == "" ||
         empty($merek)
       ){
         echo "Data Tidak Boleh Kosong";
     }else{
      if(!empty($kd_gudang)){
        if(substr($kd_gudang,0,3) == "BHN"){
          $data = array("id_dp" => $id_dp,
                        "kd_gd_bahan" => $kd_gudang,
                        "merek" => $merek,
                        "jumlah" => $jumlah,
                        "satuan" => $satuan,
                        "harga" => $harga,
                        "mata_uang" => $mata_uang,
                        "warna_cetak" => $warna,
                        "dll" => $dll,
                        "sm" => $strip,
                        "kd_hrg" => $kd_harga,
                        "omset_lembar" => $omset_lembar,
                        "omset_kg" => $omset_kg,
                        "potongan" => $potongan,
                        "diskon" => $hsl_diskon,
                        "cn" => $cn);
        }else{
          $data = array("id_dp" => $id_dp,
                        "kd_gd_hasil" => $kd_gudang,
                        "merek" => $merek,
                        "jumlah" => $jumlah,
                        "satuan" => $satuan,
                        "harga" => $harga,
                        "mata_uang" => $mata_uang,
                        "warna_cetak" => $warna,
                        "dll" => $dll,
                        "sm" => $strip,
                        "kd_hrg" => $kd_harga,
                        "omset_lembar" => $omset_lembar,
                        "omset_kg" => $omset_kg,
                        "potongan" => $potongan,
                        "diskon" => $hsl_diskon,
                        "cn" => $cn);
        }
      }else{
        $data = array("id_dp" => $id_dp,
                      "merek" => $merek,
                      "jumlah" => $jumlah,
                      "satuan" => $satuan,
                      "harga" => $harga,
                      "mata_uang" => $mata_uang,
                      "warna_cetak" => $warna,
                      "dll" => $dll,
                      "sm" => $strip,
                      "kd_hrg" => $kd_harga,
                      "omset_lembar" => $omset_lembar,
                      "omset_kg" => $omset_kg,
                      "potongan" => $potongan,
                      "diskon" => $hsl_diskon,
                      "cn" => $cn);
      }

      $result = $this->Marketing_Models->updatePesananDetailTemp($data);
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

  public function modifyPesananDetail(){
    $isLogin = $this->isLogin();
    if ($isLogin) {
      $id_dp = $this->input->post("id_dp");#
      $kd_gudang = $this->input->post("kd_gudang");#
      $jumlah = $this->input->post("jumlah");#
      $satuan = $this->input->post("satuan");#
      $harga = $this->input->post("harga");#
      $mata_uang = $this->input->post("mata_uang");#
      $warna = $this->input->post("warna");
      $dll = $this->input->post("dll");#
      $strip = $this->input->post("strip");#
      $kd_harga = $this->input->post("kd_harga");#
      $omset_kg = $this->input->post("omset_kg");#
      $omset_lembar = $this->input->post("omset_lembar");#
      $potongan = $this->input->post("potongan");
      $hsl_diskon = $this->input->post("hsl_diskon");
      $cn = $this->input->post("cn");
      $merek = $this->input->post("merek");#
      if(empty($id_dp) ||
      empty($jumlah) ||
      empty($satuan) ||
      empty($harga) ||
      empty($mata_uang) ||
      empty($dll) ||
      empty($strip) ||
      empty($kd_harga) ||
      empty($omset_kg) ||
      empty($omset_lembar) ||
      empty($merek)
    ){
      echo "Data Tidak Boleh Kosong";
    }else{
      if(empty($kd_gudang)){
        $data = array("id_dp" => $id_dp,
                      "merek" => $merek,
                      "jumlah" => $jumlah,
                      "satuan" => $satuan,
                      "harga" => $harga,
                      "mata_uang" => $mata_uang,
                      "warna_cetak" => $warna,
                      "dll" => $dll,
                      "sm" => $strip,
                      "kd_hrg" => $kd_harga,
                      "omset_lembar" => $omset_lembar,
                      "omset_kg" => $omset_kg,
                      "potongan" => $potongan,
                      "diskon" => $hsl_diskon,
                      "cn" => $cn);
      }else{
        if(substr($kd_gudang,0,3) == "BHN"){
          $data = array("id_dp" => $id_dp,
          "kd_gd_bahan" => $kd_gudang,
          "merek" => $merek,
          "jumlah" => $jumlah,
          "satuan" => $satuan,
          "harga" => $harga,
          "mata_uang" => $mata_uang,
          "warna_cetak" => $warna,
          "dll" => $dll,
          "sm" => $strip,
          "kd_hrg" => $kd_harga,
          "omset_lembar" => $omset_lembar,
          "omset_kg" => $omset_kg,
          "potongan" => $potongan,
          "diskon" => $hsl_diskon,
          "cn" => $cn);
        }else{
          $data = array("id_dp" => $id_dp,
          "kd_gd_hasil" => $kd_gudang,
          "merek" => $merek,
          "jumlah" => $jumlah,
          "satuan" => $satuan,
          "harga" => $harga,
          "mata_uang" => $mata_uang,
          "warna_cetak" => $warna,
          "dll" => $dll,
          "sm" => $strip,
          "kd_hrg" => $kd_harga,
          "omset_lembar" => $omset_lembar,
          "omset_kg" => $omset_kg,
          "potongan" => $potongan,
          "diskon" => $hsl_diskon,
          "cn" => $cn);
        }
      }
      $result = $this->Marketing_Models->updatePesananDetail($data);
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

  public function pantau_order(){
    $isLogin = $this->isLogin();
    if ($isLogin) {
      $data["Data"] = array("Title"=>"Daftar Data Order");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_order",$data);
      $this->load->view("footer");
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

  private function cetakFakturTableHeader($param){
    $this->fpdf->Ln(14);
    $this->fpdf->SetX(5);
    $this->fpdf->SetLineWidth(0.1);
    $this->fpdf->Cell(157,20,'',"TLR",0,'L');
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

  private function cetakFakturData($param){
    $this->fpdf->SetX(5);
    $this->fpdf->SetY(45);
    $this->fpdf->SetX(5);
    $this->fpdf->SetFont('Times','',8);
    $this->fpdf->Cell(19,8,'BANYAKNYA','TBL',0,'C');
    $this->fpdf->Cell(20,5,'UKURAN (cm)','TLB',0,'C');
    $this->fpdf->Cell(53,8,'MERK','TLB',0,'C');
    $this->fpdf->Cell(17.5,8,'HARGA','TLB',0,'C');
    $this->fpdf->Cell(25,5,'WARNA','TLB',0,'C');
    $this->fpdf->Cell(22.5,5,'ATAS KLIP','TLRB',0,'C');
    $this->fpdf->Ln();
    $this->fpdf->SetX(24);
    $this->fpdf->Cell(10,3,'P','BL',0,'C');
    $this->fpdf->Cell(10,3,'L','BL',0,'C');
    $this->fpdf->SetX(114.5);
    $this->fpdf->Cell(13,3,'PLASTIK','BL',0,'C');
    $this->fpdf->Cell(12,3,'CETAK','BL',0,'C');
    $this->fpdf->Cell(9,3,'SM','BL',0,'C');
    $this->fpdf->Cell(13.5,3,'DLL','BLR',0,'C');
    $this->fpdf->Ln();
    $this->fpdf->SetWidths(array(19,10,10,53,17.5,13,12,9,13.5,20));
    $this->fpdf->SetAligns(array('L','C','C','L','L','L','L','C','C','C','L'));
    for($i=0;$i<count($param);$i++){
      $this->fpdf->setX(5);
      $this->fpdf->Row(array_values($param[$i]));
    }
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

  private function cetakFakturFooter($param){
    $this->fpdf->SetFont('Times','',9);
    $this->fpdf->SetY(105);
    $this->fpdf->Cell(19,5,'Uang Muka : ',0,0,'L');
    $this->fpdf->Cell(35,5,$param[0]['mata_uang']." ".$param[0]['dp'],'B',0,'L');
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
    $this->fpdf->Cell(70,4,'Salesman ( '.(empty($param[0]["sales"]) ? $param[0]["username"] : $param[0]["sales"])." )",0,0,'C');
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
    $this->fpdf->Cell(70,4,'Salesman ( '.(empty($param[0]["sales"]) ? $param[0]["username"] : $param[0]["sales"])." )",0,0,'C');
    $this->fpdf->SetY(-7);
    $this->fpdf->SetX(7);
    $this->fpdf->Cell(100,4,'Uang muka harap ditulis jika ditanggung sepenuhnya oleh pemesan',0,0,'L');
    $this->fpdf->SetY(85);
    $this->fpdf->SetX(162);
    $this->fpdf->Cell(10,5,"Note : ",0,0,"L");
    $this->fpdf->Ln();
    $this->fpdf->SetX(162);
    $this->fpdf->WriteHTML(str_replace("&nbsp;"," ",$param[0]['note']));
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

  public function cetakFaktur($param){
    $isLogin = $this->isLogin();
    if ($isLogin) {
      $arrDataPesanan = $this->Marketing_Models->selectFakturPesanan($param);
      $arrDataPesananDetail = $this->Marketing_Models->selectFakturPesananDetail($param);
      $this->fpdf->SetAutoPageBreak(false);
      $this->fpdf->AddPage("L","A5");
      $this->cetakFakturHeader($arrDataPesanan);
      $this->cetakFakturTableHeader($arrDataPesanan);
      $this->cetakFakturSidebar($arrDataPesanan);
      $this->cetakFakturData($arrDataPesananDetail);
      $this->cetakFakturFooter($arrDataPesanan);
      $this->fpdf->Output();
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function cetakFakturPesanan($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrDataPesanan = $this->Marketing_Models->selectFakturPesanan($param);
      $arrDataPesananDetail = $this->Marketing_Models->selectFakturPesananDetail($param);
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

  public function cetakFakturPesananProduksi($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrDataPesanan = $this->Marketing_Models->selectFakturPesanan($param);
      $arrDataPesananDetail = $this->Marketing_Models->selectFakturPesananDetailProduksi($param);
      $result = array("arrDataPesanan" => $arrDataPesanan,
                      "arrDataPesananDetail" => $arrDataPesananDetail);
      $css = "assets/bootstrap/css/bootstrap.min.css";
      $page = $this->load->view("frm_print_faktur_produksi",$result,true);
      $this->load->library('m_pdf');
      $this->mpdf->mPDF("utf-8","A5-L",0,"",2,2,5,5,0,0);
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

  public function cetakFakturProduksi($param){
    $isLogin = $this->isLogin();
    if ($isLogin) {
      $arrDataPesanan = $this->Marketing_Models->selectFakturPesanan($param);
      $arrDataPesananDetail = $this->Marketing_Models->selectFakturPesananDetailProduksi($param);
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

  public function getCheckApproveUserNoOrder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $username = $this->session->userdata("fabricationUsername");
      $group = $this->session->userdata("fabricationGroup");
      $no_order = $this->input->post("no_order");
      $arrData = $this->Marketing_Models->selectApproveUserNoOrder($no_order);
      if($group == "marketing"){
        if($username == "didik" && $arrData[0]["approve_1"]=="TRUE"){
          echo json_encode(array("Approved"=>"TRUE","Kd_cust"=>$arrData[0]["kd_cust"]));
        }else if($username == "elly" && $arrData[0]["approve_5"]=="TRUE"){
          echo json_encode(array("Approved"=>"TRUE","Kd_cust"=>$arrData[0]["kd_cust"]));
        }else if($username == "farida" && $arrData[0]["approve_3"]=="TRUE"){
          echo json_encode(array("Approved"=>"TRUE","Kd_cust"=>$arrData[0]["kd_cust"]));
        }else if($username == "dicky" && $arrData[0]["approve_4"]=="TRUE"){
          echo json_encode(array("Approved"=>"TRUE","Kd_cust"=>$arrData[0]["kd_cust"]));
        }else if($username == "nina" && $arrData[0]["approve_6"]=="TRUE"){
          echo json_encode(array("Approved"=>"TRUE","Kd_cust"=>$arrData[0]["kd_cust"]));
        }else if($username == "egha" && $arrData[0]["approve_2"]=="TRUE"){
          echo json_encode(array("Approved"=>"TRUE","Kd_cust"=>$arrData[0]["kd_cust"]));
        }else{
          echo json_encode(array("Approved"=>"FALSE","Kd_cust"=>$arrData[0]["kd_cust"]));
        }
      }else{
        echo "<script>alert('Anda Tidak Memiliki Hak Akses!');</script>";
      }
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function saveApproveUserNoOrder(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $username = $this->session->userdata("fabricationUsername");
      $group = $this->session->userdata("fabricationGroup");
      $no_order = $this->input->post("no_order");
      if($username == "didik" && !empty($no_order)){
        $data = array("approve_1"=>"TRUE",
                      "no_order"=>$no_order,
                      "diperbarui"=>date("Y-m-d H:i:s"));
      }else if($username == "elly" && !empty($no_order)){
        $data = array("approve_5"=>"TRUE",
                      "no_order"=>$no_order,
                      "diperbarui"=>date("Y-m-d H:i:s"));
      }else if($username == "farida" && !empty($no_order)){
        $data = array("approve_3"=>"TRUE",
                      "no_order"=>$no_order,
                      "diperbarui"=>date("Y-m-d H:i:s"));
      }else if($username == "dicky" && !empty($no_order)){
        $data = array("approve_4"=>"TRUE",
                      "no_order"=>$no_order,
                      "diperbarui"=>date("Y-m-d H:i:s"));
      }else if($username == "nina" && !empty($no_order)){
        $data = array("approve_6"=>"TRUE",
                      "no_order"=>$no_order,
                      "diperbarui"=>date("Y-m-d H:i:s"));
      }else if($username == "egha" && !empty($no_order)){
        $data = array("approve_2"=>"TRUE",
                      "no_order"=>$no_order,
                      "diperbarui"=>date("Y-m-d H:i:s"));
      }else{
        echo "Error";
      }

      $result = $this->Marketing_Models->updatePesananApprove($data);
      if($result){
        echo "Berhasil";
      }else{
        echo "Gagal";
      }
    }else{
      echo "<script>alert('Anda Tidak Memiliki Hak Akses!');</script>";
    }
  }

  public function ubah_order($param){
    $isLogin = $this->isLogin();
    if($isLogin){
      $arrData = $this->Marketing_Models->selectPesananEdit($param);
      $data = array("Data"=>array("Title"=>"Ubah Order "),
                    "Link"=>array("Segment1"=>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2)),
                    "Value"=>array("NoOrder"=>$arrData[0]['no_order'],
                                   "KodeCust" => $arrData[0]['kd_cust'],
                                   "NmPerusahaan" => $arrData[0]['nm_perusahaan'],
                                   "TglPesan" => $arrData[0]['tgl_pesan'],
                                   "TglEstimasi" => $arrData[0]['tgl_estimasi'],
                                   "NoPo" => $arrData[0]['no_po'],
                                   "NmPemesan" => $arrData[0]['nm_pemesan'],
                                   "File1" => $arrData[0]['foto_1'],
                                   "Pajak" => $arrData[0]['pajak'],
                                   "JnsOrder" => $arrData[0]['jns_order'],
                                   "KodeOrder" => $arrData[0]['kd_order'],
                                   "UangMuka" => $arrData[0]['dp'],
                                   "MataUang" => $arrData[0]['mata_uang'],
                                   "Ekspedisi" => $arrData[0]['expedisi'],
                                   "File2" => $arrData[0]['foto_2'],
                                   "Payment" => $arrData[0]['payment_method'],
                                   "Proof" => $arrData[0]['proof'],
                                   "KetProof" => $arrData[0]['ket_proof'],
                                   "Note" => $arrData[0]['note'],
                                   "StsPesanan" => $arrData[0]['sts_pesanan']
                                   )
                  );
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("frm_order_edit",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getLihatPesanan(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $no_order = $this->input->post("no_order");
      echo json_encode($this->Marketing_Models->selectLihatPesanan($no_order));
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getLihatPesananDetail(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $no_order = $this->input->get("no_order");
      echo $this->Marketing_Models->selectLihatPesananDetails($no_order);
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getPencarian(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Marketing_Models->selectPencarian();
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
      $result = $this->Marketing_Models->selectNotePesanan($noOrder);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getNotePesananLama(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $result = $this->Marketing_Models->selectNotePesananLama($noOrder);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function removeImageProductService(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $id = $this->input->post("id");
      $data = array("id_sp" => $id,
                    "foto" => NULL);
      $result = $this->Marketing_Models->updateProductServices($data);
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

  public function getOrderDeadline(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Marketing_Models->selectOrderDeadline();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getTglEstimasi(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $result = $this->Marketing_Models->selectTglEstimasi($noOrder);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function getCountOrderDeadline(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $result = $this->Marketing_Models->selectCountOrderDeadline();
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function editTglEstimasi(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $noOrder = $this->input->post("noOrder");
      $idUser = $this->session->userdata("fabricationIdUser");
      $tglEstimasi = $this->input->post("tglEstimasi");
      if(empty($tglEstimasi)){
        echo "Data Kosong";
      }else{
        $data = array("no_order" => $noOrder,
                      "id_user" => $idUser,
                      "tgl_estimasi" => $tglEstimasi);
        $result = $this->Marketing_Models->updatePesanan($data);
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

  function order_per_hari()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Order Per Hari");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("list_order_perhari",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function statistik_order()
  {
    $isLogin = $this->isLogin();
    if($isLogin){
      $data["Data"] = array("Title"=>"Statistik Order");
      $data["Link"] = array("Segment1" =>$this->uri->rsegment(1),"Segment2"=>$this->uri->rsegment(2));
      $this->load->view("header");
      $this->load->view("sidebar",$this->checkStatus());
      $this->load->view("statistik_order_perhari",$data);
      $this->load->view("footer");
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  function getDataOrderPerHari()
  {
    $jenis  = $this->input->post("jenis");
    $tgl    = $this->input->post("tgl");
    $result = $this->Marketing_Models->getDataOrderPerHari($jenis,$tgl);
    echo $result;
  }

  function getTotalOrderPerHari()
  {
    $tgl = $this->input->post("tgl");
    $jenis = $this->input->post("jenis");
    $result = $this->Marketing_Models->getTotalOrderPerHari($jenis,$tgl);
    echo $result;
  }

  function getDataChart()
  {
    $tgl_awal  = $this->input->post("tgl_awal");
    $tgl_akhir = $this->input->post("tgl_akhir");
    $jenis = $this->input->post("jenis");
    $result = $this->Marketing_Models->getDataChartOrder($tgl_awal,$tgl_akhir,$jenis);
    echo $result;
  }

  public function getVerifikasiPasswordLama(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $passwordLama = $this->input->post("passwordLama");
      $data = array("id_user"       => $idUser,
                    "password_lama" => $passwordLama);
      $result = $this->Marketing_Models->selectPasswordOri($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }

  public function changePassword(){
    $isLogin = $this->isLogin();
    if($isLogin){
      $idUser = $this->session->userdata("fabricationIdUser");
      $passwordBaru = $this->input->post("passwordBaru");
      $data = array("id_user"       => $idUser,
                    "password"      => $passwordBaru,
                    "password_ori"  => $passwordBaru);
      $result = $this->Marketing_Models->updatePasswordUser($data);
      echo $result;
    }else{
      echo "<script>alert('Session anda habis atau anda tidak memiliki hak akses!');</script>";
      redirect("_main/main","refresh");
    }
  }
}
?>
