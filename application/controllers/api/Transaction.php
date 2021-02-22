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
        
    }
    public function index_get($username){
        $param = $this->get();
        if(!empty($param['limit'])){
            $user = $this->db->get_where('USERS', ['USER_USERS' => $username])->result();
            if($user != null){
                $this->db->order_by('TS_TRANS', 'DESC');
                if($user[0]->ROLE_USERS == 'Staff'){
                    $limit = $param['limit'] != '-1'? $param['limit'] : '';
                    $trans = $this->db->get_where('V_TRANSACTION', ['ID_USERS' => $user[0]->ID_USERS], $limit)->result();
                }else{
                    $limit = $param['limit'] != '-1'? $param['limit'] : '';
                    $trans = $this->db->get('V_TRANSACTION', $limit)->result();
                }
                if($trans != null){
                    $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $trans], 200);
                }else{
                    $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);
                }
            }else{
                $this->response(['status' => false, 'message' => 'Data user tidak ditemukan'], 200);
            }
        }else{
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }
    public function confirm_put(){
        $param = $this->put();
        if(!empty($param['username']) && !empty($param['idTrans']) && !empty($param['isApprove'])){
            $user           = $this->db->get_where('USERS', ['USER_USERS' => $param['username']])->result();
            $transaction    = $this->db->get_where('TRANSACTION', ['ID_TRANS' => $param['idTrans']])->result();
            if($user != null && $transaction != null){
                if($user[0]->ROLE_USERS != "Staff"){
                    if($param['isApprove'] == "true"){
                        $this->db->query('UPDATE TRANSACTION SET FLAG_TRANS = FLAG_TRANS+1 WHERE ID_TRANS = "'.$param['idTrans'].'"');
                        $this->response(['status' => true, 'message' => 'Data berhasil di setujui'], 200);
                    }else{
                        $this->db->where('ID_TRANS', $param['idTrans'])->update('TRANSACTION', ['STAT_TRANS' => '3']);
                        $this->response(['status' => true, 'message' => 'Data berhasil di tolak'], 200);
                    }
                }else{
                    $this->response(['status' => false, 'message' => 'Anda tidak diijinkan untuk melakukan aksi ini'], 200);
                }
            }else{
                $this->response(['status' => false, 'message' => 'Data user atau transaksi tidak ditemukan'], 200);
            }
        }else{
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }
}
