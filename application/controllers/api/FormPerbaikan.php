<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class FormPerbaikan extends RestController {
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
                $idPermohonan   = 'PERMO_'.substr(md5(time()."permohonan"), 0, 14);
                
                $storeTransaksi['ID_TRANS']         = $idTrans;
                $storeTransaksi['ID_USERS']         = $param['idUser'];
                $storeTransaksi['ID_MAPPING']       = $param['idMapping'];
                $this->db->insert('TRANSACTION', $storeTransaksi);
                
                $storePermohonan['ID_PERMOHONAN']       = $idPermohonan;
                $storePermohonan['ID_TRANS']            = $idTrans;
                $storePermohonan['TGL_PERMOHONAN']      = $param['tgl'];
                $storePermohonan['WAKTU_PERMOHONAN']    = $param['waktu'];
                $storePermohonan['NAMA_PEMOHON']        = $param['namaDari'];
                $storePermohonan['DIV_PEMOHON']         = $param['divisi'];
                $storePermohonan['EXT_PEMOHON']         = $param['extension'];
                $storePermohonan['NAMA_PENERIMA']       = $param['namaDiterima'];
                $storePermohonan['TT_PENERIMA']         = $param['troubTicket'];
                $storePermohonan['JENIS_PERBAIKAN']     = $param['jenisPerbaikan'];
                $storePermohonan['ALASAN_PERBAIKAN']    = $param['alasan'];
                $storePermohonan['DIKERJAKAN']          = $param['dikerjakanOleh'];
                $storePermohonan['EST_WAKTU']           = $param['estWaktu'];
                $storePermohonan['EST_BIAYA']           = $param['estBiaya'];
                $this->db->insert('FORM_PERMOHONAN', $storePermohonan);
                
                $flow = $this->db->get_where('FLOW', ['ID_MAPPING' => $mapping[0]->ID_MAPPING])->result_array();
                for($i = 1; $i <= 15; $i++){
                    if(!empty($flow[0]['APP_'.$i]) && $flow[0]['APP_'.$i] != null){
                        $this->db->insert('DETAIL_APPROVAL', ['ID_TRANS' => $idTrans, 'ROLE_APP' => $flow[0]['APP_'.$i]]);
                    }
                }
                
                $this->ContentPdf->generate(['idTrans' => $idTrans, 'orientation' => 'potrait']);
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
