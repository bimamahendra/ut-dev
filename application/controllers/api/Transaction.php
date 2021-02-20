<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class Transaction extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library(array('upload', 'image_lib'));
    }

    public function index_post(){
        $datas = $this->input->post();
        if(!empty($datas['idUser']) && !empty($datas['idMapping'])){
            $checkUser      = $this->db->get_where('USERS', ['ID_USERS' => $datas['idUser']])->result();
            $checkMapping   = $this->db->get_where('MAPPING', ['ID_MAPPING' => $datas['idMapping']])->result();
            if($checkUser != null && $checkMapping != null){
                $dataStore['ID_TRANS']      = 'TRANS_'.substr(md5(time()), 0, 14);;
                $dataStore['ID_USERS']      = $datas['idUser'];
                $dataStore['ID_MAPPING']    = $datas['idMapping'];

                $this->db->insert('TRANSACTION', $dataStore);
                $this->response(['status' => true, 'message' => 'Data berhasil ditambahkan'], 200);
            }else{
                $this->response(['status' => false, 'message' => 'Data user atau mapping tidak ditemukan'], 200);
            }
        }else{
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }
}
