<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class FormIWO extends RestController {
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
                $idIWO = 'IWO_'.substr(md5(time()."IWO"), 0, 16);
                
                $storeTransaksi['ID_TRANS']         = $idTrans;
                $storeTransaksi['ID_USERS']         = $param['idUser'];
                $storeTransaksi['ID_MAPPING']       = $param['idMapping'];
                $this->db->insert('TRANSACTION', $storeTransaksi);

                $storeIWO['ID_IWO']             = $idIWO;
                $storeIWO['ID_TRANS']           = $idTrans;
                $storeIWO['TT_IWO']             = $param['troubTicket'];
                $storeIWO['TGL_IWO']            = $param['tgl'];
                $storeIWO['MULAI_IWO']          = $param['tglMulai'];
                $storeIWO['SELESAI_IWO']        = $param['tglSelesai'];
                $storeIWO['NAMA_PEMOHON']       = $param['namaPemohon'];
                $storeIWO['DIVISI_PEMOHON']     = $param['div'];
                $storeIWO['EKST_PEMOHON']       = $param['ext'];
                $storeIWO['NAMA_PENERIMA']      = $param['namaPenerima'];
                $storeIWO['JENIS_PERBAIKAN']    = $param['jenPerbaikan']['pengBaru'].';'.$param['jenPerbaikan']['pengSebagian'].';'.$param['jenPerbaikan']['perbaikan'];
                $storeIWO['KET_PERBAIKAN']      = $param['ketPerbaikan'];
                $storeIWO['ALASAN_PERBAIKAN']   = $param['alsnPerbaikan'];
                $this->db->insert('FORM_IWO', $storeIWO);

                foreach($param['detKebutuhan'] as $item){
                    $storeDetIWO['ID_IWO']     = $idIWO;
                    $storeDetIWO['BARANG_IWO'] = $item['nama'];
                    $storeDetIWO['QTY_IWO']    = $item['quant'];
                    $storeDetIWO['MUS_IWO']    = $item['musNo'];
                    $this->db->insert('DETAIL_IWO', $storeDetIWO);
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