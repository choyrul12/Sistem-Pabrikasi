<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_Model extends CI_Model{

	public function loginModel($param){
		$hasil = $this->db->get_where('users',$param);
		$arrHasil = $hasil->result_array();
		if(count($hasil->result())>0){
			return array("isTrue"=>TRUE,
									 "id_user"=>$arrHasil[0]['id_user'],
									 "username"=>$arrHasil[0]['username'],
									 "status"=>$arrHasil[0]['status'],
									 "group"=>$arrHasil[0]['group'],
								 	 "sub_group"=>$arrHasil[0]['sub_group']);
		}else{
			return array("isTrue"=>FALSE);
		}
	}
}
?>
