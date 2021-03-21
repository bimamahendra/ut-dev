<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class FormEvaluasi extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library(array('upload', 'image_lib'));
    }

    public function index_post(){
        $param = $this->post();
        if(!empty($param['idUser']) && !empty($param['idMapping'])){
            $user       = $this->db->get_where('USERS', ['ID_USERS' => $param['idUser']])->result();
            $mapping    = $this->db->get_where('MAPPING', ['ID_MAPPING' => $param['idMapping']])->result();
            if($user != null && $mapping != null){
                $idTrans    = 'TRANS_'.substr(md5(time()."trans"), 0, 14);
                $idEval     = 'EVAL_'.substr(md5(time()."evaluasi"), 0, 15);
                
                $storeTransaksi['ID_TRANS']         = $idTrans;
                $storeTransaksi['ID_USERS']         = $param['idUser'];
                $storeTransaksi['ID_MAPPING']       = $param['idMapping'];
                $this->db->insert('TRANSACTION', $storeTransaksi);

                $storeEvaluasi['ID_EVALUASI']      = $idEval;
                $storeEvaluasi['ID_TRANS']         = $idTrans;
                $storeEvaluasi['PERIODE']          = $param['periode'];
                $storeEvaluasi['NAMA_VENDOR']      = $param['namaVendor'];
                $storeEvaluasi['NAMA_PEKERJAAN']   = $param['namaPekerjaan'];
                $storeEvaluasi['SPK_EVALUASI']     = $param['spkNo'];
                $storeEvaluasi['TGL_SPK']          = $param['tglSpk'];
                $storeEvaluasi['TT_EVALUASI']      = $param['referensi']['troubTicket'];
                $storeEvaluasi['EWO_EVALUASI']     = $param['referensi']['ewo'];
                $storeEvaluasi['KESIMPULAN']       = $param['kesimpulan'];

                $arr = array();
                foreach ($param['hasilPenilaian'] as $item) {
                    array_push($arr, $item);
                }
                $storeEvaluasi['HASIL_PENILAIAN']  = implode(';', $arr);
                $this->db->insert('FORM_EVALUASI', $storeEvaluasi);
                
                $flow = $this->db->get_where('FLOW', ['ID_MAPPING' => $mapping[0]->ID_MAPPING])->result_array();
                for($i = 1; $i <= 15; $i++){
                    if(!empty($flow[0]['APP_'.$i]) && $flow[0]['APP_'.$i] != null){
                        $this->db->insert('DETAIL_APPROVAL', ['ID_TRANS' => $idTrans, 'ROLE_APP' => $flow[0]['APP_'.$i]]);
                    }
                }
                
                $this->ContentPdf->generate(['idTrans' => $idTrans, 'orientation' => 'portrait']);
                $this->pusherjs->push();
                $this->response(['status' => true, 'message' => 'Data berhasil ditambahkan'], 200);
            }else{
                $this->response(['status' => false, 'message' => 'Data user atau mapping tidak ditemukan'], 200);
            }
        }else{
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }
}
