<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class Transaction extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("ContentPdf");
        $this->load->library(array('notification', 'pdfgenerator'));
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
                    $x = 0;
                    foreach ($trans as $item) {
                        $transNew[$x]['ID_TRANS']               = $item->ID_TRANS;
                        $transNew[$x]['ID_MAPPING']             = $item->ID_MAPPING;
                        $transNew[$x]['ID_USERS']               = $item->ID_USERS;
                        $transNew[$x]['NAMA_USERS']             = $item->NAMA_USERS;
                        $transNew[$x]['NAMA_FORM']              = $item->NAMA_FORM;
                        $transNew[$x]['PATH_TRANS']             = $item->PATH_TRANS;
                        $transNew[$x]['TS_TRANS']               = $item->TS_TRANS;
                        $transNew[$x]['FLAG_TRANS']             = $item->FLAG_TRANS;
                        $transNew[$x]['CONFIRM_STATE_TRANS']    = $item->CONFIRM_STATE_TRANS;
                        $transNew[$x]['STAT_TRANS']             = $item->ISAPPROVE_APP;
                        $x++;
                    }
                    $trans = $transNew;
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
    public function generate_get(){
        $param      = $this->get();
        $trans      = $this->db->get_where('V_TRANSACTION', ['ID_TRANS' => $param['idTrans']])->result();
        $mappPdf    = $this->db->get_where('V_MAPPING_PDF', ['ID_MAPPING' => $trans[0]->ID_MAPPING])->result();
        
        $data['list'] = $this->ContentPdf->get(['table' => $mappPdf[0]->NAMA_TABEL, 'idTrans' => $param['idTrans']]);				
        $data['title_pdf'] = $mappPdf[0]->NAMA_FORM;	
		       
        $file_pdf = $trans[0]->NAMA_USERS.'_'.$mappPdf[0]->NAMA_FORM.'_'.time();
		
        $paper = 'A4';
        $orientation = "portrait";
        
		$html = $this->load->view($mappPdf[0]->PATH_TEMPLATE_PDF, $data, true);	    

        $resPdf = $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        if(!is_dir('./uploads/transaction/'.$trans[0]->NAMA_USERS)){
            mkdir('./uploads/transaction/'.$trans[0]->NAMA_USERS, 0777, TRUE);
        }
        file_put_contents('./uploads/transaction/'.$trans[0]->NAMA_USERS.'/'.$file_pdf.'.pdf', $resPdf);

        // $res = $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        // $this->response($res, 200);
    }
    public function detail_get(){
        $param = $this->get();
        if(!empty($param['idTrans']) && !empty($param['username'])){
            $trans  = $this->db->get_where('TRANSACTION', ['ID_TRANS' => $param['idTrans']])->result();
            $user   = $this->db->get_where('USERS', ['USER_USERS' => $param['username']])->result();
            if($trans != null && $user != null){
                if($user[0]->ROLE_USERS != 'Staff'){
                    $transDetail = $this->db->get_where('V_TRANSACTION_APPROVAL_DETAIL', ['ID_TRANS' => $param['idTrans'], 'ROLE_APP' => $user[0]->ROLE_USERS])->result();
                }else{
                    $transDetail = $this->db->get_where('V_TRANSACTION_DETAIL', ['ID_TRANS' => $param['idTrans'], 'ID_USERS' => $user[0]->ID_USERS])->result();
                }
                if($transDetail != null){
                    $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $transDetail[0]], 200);
                }else{
                    $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);
                }
            }else{
                $this->response(['status' => false, 'message' => 'Data transaction / user tidak ditemukan'], 200);
            }
        }else{
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }
    public function confirm_put(){
        $param = $this->put();
        if(!empty($param['username']) && !empty($param['idTrans']) && !empty($param['isApprove']) && !empty($param['keterangan'])){
            $user           = $this->db->get_where('USERS', ['USER_USERS' => $param['username']])->result();
            $transaction    = $this->db->get_where('V_TRANSACTION', ['ID_TRANS' => $param['idTrans']])->result();
            if($user != null && $transaction != null){
                if($transaction[0]->STAT_TRANS == '1' && $transaction[0]->CONFIRM_STATE_TRANS == $user[0]->ROLE_USERS){
                    if($param['isApprove'] == "1"){
                        $flow               = $this->db->get_where('FLOW', ['ID_MAPPING' => $transaction[0]->ID_MAPPING])->result_array();
                        $flowWillApprove    = $transaction[0]->FLAG_TRANS + 2; 
                        if(!empty($flow[0]['APP_'.$flowWillApprove]) && $flow[0]['APP_'.$flowWillApprove] != null){

                            $this->db->query('UPDATE TRANSACTION SET FLAG_TRANS = FLAG_TRANS+1 WHERE ID_TRANS = "'.$param['idTrans'].'"');
                            $this->db->where(['ID_TRANS' => $param['idTrans'], 'ROLE_APP' => $user[0]->ROLE_USERS])->update('DETAIL_APPROVAL', ['ID_USERS' => $user[0]->ID_USERS, 'ISAPPROVE_APP' => '1']);
                            $userReceiveNotifs = $this->db->get_where('USERS', ['ROLE_USERS' => $flow[0]['APP_'.$flowWillApprove]])->result_array();
                            
                            $notif['title']     = 'Pengajuan Baru';
                            $notif['message']   = 'Terdapat Pengajuan Form '.$transaction[0]->NAMA_FORM;
                            $notif['regisIds']  = $userReceiveNotifs;
                            $res = $this->notification->push($notif);
                            $this->response(['status' => true, 'message' => 'Data berhasil disetujui'], 200);
                        }else{
                            $this->db->query('UPDATE TRANSACTION SET FLAG_TRANS = FLAG_TRANS+1, STAT_TRANS = "2" WHERE ID_TRANS = "'.$param['idTrans'].'"');
                            $this->db->where(['ID_TRANS' => $param['idTrans'], 'ROLE_APP' => $user[0]->ROLE_USERS])->update('DETAIL_APPROVAL', ['ID_USERS' => $user[0]->ID_USERS, 'ISAPPROVE_APP' => '1']);
                        }
                        // unlink($transaction[0]->PATH_TRANS);
                        $this->ContentPdf->generate(['idTrans' => $param['idTrans']]);
                        $this->response(['status' => true, 'message' => 'Data berhasil disetujui'], 200);
                    }else if("2"){
                        $this->db->where('ID_TRANS', $param['idTrans'])->update('TRANSACTION', ['STAT_TRANS' => '3']);
                        $this->db->query('UPDATE TRANSACTION SET FLAG_TRANS = FLAG_TRANS+1, STAT_TRANS = "3" WHERE ID_TRANS = "'.$param['idTrans'].'"');
                        $this->db->where(['ID_TRANS' => $param['idTrans'], 'ROLE_APP' => $user[0]->ROLE_USERS])->update('DETAIL_APPROVAL', ['ID_USERS' => $user[0]->ID_USERS, 'ISAPPROVE_APP' => '0']);
                        $this->db->where('ID_TRANS', $param['idTrans'])->update('TRANSACTION', ['KETERANGAN_TRANS' => $param['keterangan']]);
                        
                        $this->response(['status' => true, 'message' => 'Data berhasil ditolak'], 200);
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
