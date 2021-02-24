<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class Transaction extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library(array('notification'));
    }

    public function tes_post(){
        $notif['title'] = 'Tes';
        $notif['message'] = 'tesciuysdf';
        $notif['regisIds'][0] = 'cLOifR2CTxmvJkFBkGGxY7:APA91bH6ezExw1rh-39OEDRn8KymCgudla_hmjZ1RxSdOUVCq53PTC2Xq7f_O2Java4prvaq8d-H23p4FfW6ptTkGp-5mQ1Dy9EKpc8p7F5wyd8SH1K3u8x5nJHIUbWYrAZ0LTll7rjj';
        $this->notification->push($notif);
    }
    public function index_get($username){
        $param = $this->get();
        if(!empty($param['limit'])){
            $user = $this->db->get_where('USERS', ['USER_USERS' => $username])->result();
            if($user != null){
                $this->db->order_by('TS_TRANS', 'DESC');
                $limit = $param['limit'] != '-1'? $param['limit'] : '';
                if($user[0]->ROLE_USERS == 'Staff'){
                    $trans = $this->db->get_where('V_TRANSACTION', ['ID_USERS' => $user[0]->ID_USERS], $limit)->result();
                }else{
                    $trans = $this->db->not_like('STAT_TRANS', '0')->get_where('V_TRANSACTION_APPROVAL', ['ROLE_APP' => $user[0]->ROLE_USERS], $limit)->result();
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
            $transaction    = $this->db->get_where('V_TRANSACTION', ['ID_TRANS' => $param['idTrans']])->result();
            if($user != null && $transaction != null){
                if($transaction[0]->STAT_TRANS == '1' && $transaction[0]->CONFIRM_STATE_TRANS == $user[0]->ROLE_USERS){
                    if($param['isApprove'] == "2"){
                        $flow               = $this->db->get_where('FLOW', ['ID_MAPPING' => $transaction[0]->ID_MAPPING])->result_array();
                        $flowWillApprove    = $transaction[0]->FLAG_TRANS + 2; 
                        if(!empty($flow[0]['APP_'.$flowWillApprove]) && $flow[0]['APP_'.$flowWillApprove] != null){

                            $this->db->query('UPDATE TRANSACTION SET FLAG_TRANS = FLAG_TRANS+1 WHERE ID_TRANS = "'.$param['idTrans'].'"');
                            $this->db->where(['ID_TRANS' => $param['idTrans'], 'ROLE_APP' => $user[0]->ROLE_USERS])->update('DETAIL_APPROVAL', ['ID_USERS' => $user[0]->ID_USERS, 'ISAPPROVE_APP' => '1']);
                            $userReceiveNotifs = $this->db->get_where('USERS', ['ROLE_USERS' => $flow[0]['APP_'.$flowWillApprove]])->result_array();
                            
                            $notif['title']     = 'Pengajuan '.$transaction[0]->NAMA_FORM;
                            $notif['message']   = 'Pengajuan form baru';
                            $notif['regisIds']  = $userReceiveNotifs;
                            $res = $this->notification->push($notif);
                            $this->response(['status' => true, 'message' => 'Data berhasil disetujui'], 200);
                        }else{
                            $this->db->query('UPDATE TRANSACTION SET FLAG_TRANS = FLAG_TRANS+1, STAT_TRANS = "2" WHERE ID_TRANS = "'.$param['idTrans'].'"');
                            $this->db->where(['ID_TRANS' => $param['idTrans'], 'ROLE_APP' => $user[0]->ROLE_USERS])->update('DETAIL_APPROVAL', ['ID_USERS' => $user[0]->ID_USERS, 'ISAPPROVE_APP' => '1']);
                        }
                        $this->response(['status' => true, 'message' => 'Data berhasil disetujui'], 200);
                    }else{
                        $this->db->where('ID_TRANS', $param['idTrans'])->update('TRANSACTION', ['STAT_TRANS' => '3']);
                        if(!empty($param['keterangan'])){
                            $this->db->query('UPDATE TRANSACTION SET FLAG_TRANS = FLAG_TRANS+1, STAT_TRANS = "3" WHERE ID_TRANS = "'.$param['idTrans'].'"');
                            $this->db->where(['ID_TRANS' => $param['idTrans'], 'ROLE_APP' => $user[0]->ROLE_USERS])->update('DETAIL_APPROVAL', ['ID_USERS' => $user[0]->ID_USERS, 'ISAPPROVE_APP' => '0', 'KETERANGAN' => $param['keterangan']]);
                            
                            $this->response(['status' => true, 'message' => 'Data berhasil ditolak'], 200);
                        }else{
                            $this->response(['status' => false, 'message' => 'Field keterangan wajib diisi'], 200);
                        }
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
