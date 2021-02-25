<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Snack extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function getData($param){
        switch ($param['namaForm']) {
            case 'value':
                break;
            default:
                break;
        }
    }
    public function getData($param){	        
		$filter = !empty($param['filter'])? $param['filter'] : '';
		$this->db->join('FORM_SNACK','DETAIL_SNACK.ID_SNACK = FORM_SNACK.ID_SNACK');
		$this->db->join('TRANSACTION','TRANSACTION.ID_TRANS = FORM_SNACK.ID_TRANS'); 
		$this->db->join('USERS','TRANSACTION.ID_USERS = USERS.ID_USERS');
        $res    = $this->db->get_where('DETAIL_SNACK', $filter)->result();
        return $res;
		
    }
}