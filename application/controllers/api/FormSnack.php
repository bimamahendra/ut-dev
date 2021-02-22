<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class FormSnack extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library(array('upload', 'image_lib'));
    }

    public function detail_get($idSnack){
        $detSnacks = $this->db->get_where('V_DETAIL_SNACK', ['ID_SNACK' => $idSnack])->result();
        if($detSnacks != null){
            $res['PATH_TRANS']      = $detSnacks[0]->PATH_TRANS;
            $res['DETAIL_SNACK']    = $detSnacks;
            $this->response(['status' => true, 'message' => 'Data berhasil ditemukan', 'data' => $res], 200);
        }else{
            $this->response(['status' => false, 'message' => 'Data tidak ditemukan'], 200);
        }
    }

    public function index_post(){
        $param = $this->post();
        if(!empty($param['idUser']) && !empty($param['idMapping']) && !empty($param['tglSnack']) && !empty($param['divisiSnack']) && !empty($param['keperluanSnack']) && !empty($param['detSnack'])){
            $user       = $this->db->get_where('USERS', ['ID_USERS' => $param['idUser']])->result();
            $mapping    = $this->db->get_where('MAPPING', ['ID_MAPPING' => $param['idMapping']])->result();
            if($user != null && $mapping != null){
                $idTransaksi    = 'TRANS_'.substr(md5(time()), 0, 14);
                $idSnack        = 'SNACK_'.substr(md5(time()), 0, 14);
                
                $storeTransaksi['ID_TRANS']         = $idTransaksi;
                $storeTransaksi['ID_USERS']         = $param['idUser'];
                $storeTransaksi['ID_MAPPING']       = $param['idMapping'];
                $this->db->insert('TRANSACTION', $storeTransaksi);

                $storeFrmSnack['ID_SNACK']          = $idSnack;
                $storeFrmSnack['ID_TRANS']          = $idTransaksi;
                $storeFrmSnack['TGL_SNACK']         = $param['tglSnack'];
                $storeFrmSnack['DIVISI_SNACK']      = $param['divisiSnack'];
                $storeFrmSnack['KEPERLUAN_SNACK']   = $param['keperluanSnack'];
                $storeFrmSnack['TGLOUT_SNACK']      = date('Y-m-d');
                $this->db->insert('FORM_SNACK', $storeFrmSnack);

                foreach($param['detSnack'] as $item){
                    $storeDetFrmSnack['ID_SNACK']       = $idSnack;
                    $storeDetFrmSnack['JENIS_SNACK']    = $item['jenisSnack'];
                    $storeDetFrmSnack['JML_SNACK']      = $item['jmlSnack'];
                    $this->db->insert('DETAIL_SNACK', $storeDetFrmSnack);
                }
                $this->response(['status' => true, 'message' => 'Data berhasil ditambahkan'], 200);
            }else{
                $this->response(['status' => false, 'message' => 'Data user atau mapping tidak ditemukan'], 200);
            }
        }else{
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200);
        }
    }
}