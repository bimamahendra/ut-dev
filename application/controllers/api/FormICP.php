<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class FormICP extends RestController {
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
                $idTrans        = 'TRANS_'.substr(md5(time()."trans"), 0, 14);
                $idICP          = 'ICP_'.substr(md5(time()."icp"), 0, 16);
                
                $storeTransaksi['ID_TRANS']         = $idTrans;
                $storeTransaksi['ID_USERS']         = $param['idUser'];
                $storeTransaksi['ID_MAPPING']       = $param['idMapping'];
                $this->db->insert('TRANSACTION', $storeTransaksi);
                
                $storeICP['ID_POND']        = $idICP;
                $storeICP['ID_TRANS']       = $idTrans;
                $storeICP['TGL_POND']       = $param['tgl'];
                $storeICP['PONDA_POND']     = $param['pondA'];
                $storeICP['PONDB_POND']     = $param['pondB'];
                $storeICP['PONDC_POND']     = $param['pondC'];
                $storeICP['PONDD_POND']     = $param['pondD'];
                $storeICP['CATATAN_POND']   = $param['catatan'];

                $arr = array();
                foreach ($param['checking'] as $item) {
                    array_push($arr, $item['status']);
                }
                $storeICP['CHECKING_POND'] = implode(';', $arr);
                
                $arr = array();
                foreach ($param['runningTest'] as $item) {
                    array_push($arr, $item['status']);
                }
                $storeICP['RUNNING_POND'] = implode(';', $arr);
                $this->db->insert('FORM_POND', $storeICP);
                
                $flow = $this->db->get_where('FLOW', ['ID_MAPPING' => $mapping[0]->ID_MAPPING])->result_array();
                for($i = 1; $i <= 15; $i++){
                    if(!empty($flow[0]['APP_'.$i]) && $flow[0]['APP_'.$i] != null){
                        $this->db->insert('DETAIL_APPROVAL', ['ID_TRANS' => $idTrans, 'ROLE_APP' => $flow[0]['APP_'.$i]]);
                    }
                }
                
                $this->ContentPdf->generate(['idTrans' => $idTrans, 'orientation' => 'potrait']);
                $this->pusherjs->push();
                $this->response(['status' => true, 'message' => 'Data berhasil ditambahkan'], 200);
                $this->response(['status' => true, 'message' => 'Data berhasil ditambahkan', 'data' => $storeICAK], 200);
            }else{
                $this->response(['status' => false, 'message' => 'Data user atau mapping tidak ditemukan'], 200);
            }
        }else{
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }
}
