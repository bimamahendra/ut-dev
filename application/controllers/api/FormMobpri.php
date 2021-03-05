<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class FormMobpri extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library(array('upload', 'image_lib'));
    }

    public function index_post(){
        $param = $this->post();
        if(!empty($param['idUser']) && !empty($param['idMapping']) && !empty($param['peminjam']) && !empty($param['pengemudi']) && !empty($param['tglPinjam']) && !empty($param['tglKembali']) && !empty($param['divDept']) && !empty($param['nopol']) && !empty($param['jamBerangkat']) && !empty($param['jamPulang']) ){
            $user       = $this->db->get_where('USERS', ['ID_USERS' => $param['idUser']])->result();
            $mapping    = $this->db->get_where('MAPPING', ['ID_MAPPING' => $param['idMapping']])->result();
            if($user != null && $mapping != null){
                $idTrans        = 'TRANS_'.substr(md5(time()."trans"), 0, 14);
                $idMobpri       = 'MOBPRI_'.substr(md5(time()."mobpri"), 0, 13);
                
                $storeTransaksi['ID_TRANS']         = $idTrans;
                $storeTransaksi['ID_USERS']         = $param['idUser'];
                $storeTransaksi['ID_MAPPING']       = $param['idMapping'];
                $this->db->insert('TRANSACTION', $storeTransaksi);

                $storeMobpri['ID_MOBPRI']           = $idMobpri;
                $storeMobpri['ID_TRANS']            = $idTrans;
                $storeMobpri['PEMINJAM_MOBPRI']     = $param['peminjam'];
                $storeMobpri['PENGEMUDI_MOBPRI']    = $param['pengemudi'];
                $storeMobpri['TGLPINJAM_MOBPRI']    = $param['tglPinjam'];
                $storeMobpri['TGLAMBIL_MOBPRI']     = $param['tglKembali'];
                $storeMobpri['DD_MOBPRI']           = $param['divDept'];
                $storeMobpri['NOPOL_MOBPRI']        = $param['nopol'];
                $storeMobpri['JAMBERANGKAT_MOBPRI'] = $param['jamBerangkat'];
                $storeMobpri['JAMPULANG_MOBPRI']    = $param['jamPulang'];
                $this->db->insert('FORM_MOBPRI', $storeMobpri);
                
                $flow = $this->db->get_where('FLOW', ['ID_MAPPING' => $mapping[0]->ID_MAPPING])->result_array();
                for($i = 1; $i <= 15; $i++){
                    if(!empty($flow[0]['APP_'.$i]) && $flow[0]['APP_'.$i] != null){
                        $this->db->insert('DETAIL_APPROVAL', ['ID_TRANS' => $idTrans, 'ROLE_APP' => $flow[0]['APP_'.$i]]);
                    }
                }
                
                $this->ContentPdf->generate(['idTrans' => $idTrans]);
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
