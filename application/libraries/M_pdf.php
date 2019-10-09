<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'/third_party/mpdf60/mpdf.php';

class M_pdf {
    public function __construct(){
      $pdf = new mPDF();
      $CI =& get_instance();
  		$CI->mpdf = $pdf;
    }
}
