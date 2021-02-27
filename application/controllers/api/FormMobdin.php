<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class FormMobdin extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library(array('upload', 'image_lib'));
    }

    public function index_post(){
        $param = $this->post();
        if(!empty($param['idUser']) && !empty($param['idMapping']) && !empty($param['pengemudi']) && !empty($param['tglPinjam']) && !empty($param['tglKembali']) && !empty($param['divDept']) && !empty($param['nopol']) && !empty($param['jamBerangkat']) && !empty($param['jamPulang']) && $param['kmAwal'] != '' && $param['kmAkhir'] != '' && !empty($param['catatan']) && !empty($param['detMobdin'])){
            $user       = $this->db->get_where('USERS', ['ID_USERS' => $param['idUser']])->result();
            $mapping    = $this->db->get_where('MAPPING', ['ID_MAPPING' => $param['idMapping']])->result();
            if($user != null && $mapping != null){
                $idTrans        = 'TRANS_'.substr(md5(time()."trans"), 0, 14);
                $idMobdin       = 'MOBDIN_'.substr(md5(time()."snack"), 0, 13);
                
                $storeTransaksi['ID_TRANS']         = $idTrans;
                $storeTransaksi['ID_USERS']         = $param['idUser'];
                $storeTransaksi['ID_MAPPING']       = $param['idMapping'];
                $this->db->insert('TRANSACTION', $storeTransaksi);

                $storeMobdin['ID_MOBDIN']           = $idMobdin;
                $storeMobdin['ID_TRANS']            = $idTrans;
                $storeMobdin['PEMINJAM_MOBDIN']     = $user[0]->NAMA_USERS;
                $storeMobdin['PENGEMUDI_MOBDIN']    = $param['pengemudi'];
                $storeMobdin['TGLPINJAM_MOBDIN']    = $param['tglPinjam'];
                $storeMobdin['TGLAMBIL_MOBDIN']     = $param['tglKembali'];
                $storeMobdin['DD_MOBDIN']           = $param['divDept'];
                $storeMobdin['NOPOL_MOBDIN']        = $param['nopol'];
                $storeMobdin['JAMBERANGKAT_MOBDIN'] = $param['jamBerangkat'];
                $storeMobdin['JAMPULANG_MOBDIN']    = $param['jamPulang'];
                $storeMobdin['KMAWAL_MOBDIN']       = $param['kmAwal'];
                $storeMobdin['KMAKHIR_MOBDIN']      = $param['kmAkhir'];
                $storeMobdin['CATATAN_MOBDIN']      = $param['catatan'];
                $this->db->insert('FORM_MOBDIN', $storeMobdin);

                foreach($param['detMobdin'] as $item){
                    $storeDetMobdin['ID_MOBDIN']        = $idMobdin;
                    $storeDetMobdin['TUJUAN_MOBDIN']    = $item['tujuan'];
                    $storeDetMobdin['KEPERLUAN_MOBDIN'] = $item['keperluan'];
                    $this->db->insert('DETAIL_MOBDIN', $storeDetMobdin);
                }
                
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
