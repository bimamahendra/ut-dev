<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class FormMaterial extends RestController {
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
                $idMaterial = 'MAT_'.substr(md5(time()."snack"), 0, 16);
                
                $storeTransaksi['ID_TRANS']         = $idTrans;
                $storeTransaksi['ID_USERS']         = $param['idUser'];
                $storeTransaksi['ID_MAPPING']       = $param['idMapping'];
                $this->db->insert('TRANSACTION', $storeTransaksi);

                $storeMaterial['ID_MATERIAL']       = $idMaterial;
                $storeMaterial['ID_TRANS']          = $idTrans;
                $storeMaterial['TGL_MATERIAL']      = $param['tgl'];
                $this->db->insert('FORM_MATERIAL', $storeMaterial);

                foreach($param['detMaterial'] as $item){
                    $storeDetMaterial['ID_MATERIAL']        = $idMaterial;
                    $storeDetMaterial['BARANG_MATERIAL']    = $item['nama'];
                    $storeDetMaterial['JML_MATERIAL']       = $item['jml'];
                    $storeDetMaterial['GUNA_MATERIAL']      = $item['dipergunakan'];
                    $storeDetMaterial['KET_MATERIAL']       = $item['keterangan'];
                    $this->db->insert('DETAIL_MATERIAL', $storeDetMaterial);
                }
                
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
