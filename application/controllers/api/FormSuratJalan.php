<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class FormSuratJalan extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library(array('upload', 'image_lib', 'datefunction'));
    }

    public function index_post(){
        $param = $this->post();
        if(!empty($param['idUser']) && !empty($param['idMapping'])){
            $user       = $this->db->get_where('USERS', ['ID_USERS' => $param['idUser']])->result();
            $mapping    = $this->db->get_where('MAPPING', ['ID_MAPPING' => $param['idMapping']])->result();
            if($user != null && $mapping != null){
                $idTrans    = 'TRANS_'.substr(md5(time()."trans"), 0, 14);
                $idJalan     = 'JALAN_'.substr(md5(time()."jalan"), 0, 15);
                
                $storeTransaksi['ID_TRANS']         = $idTrans;
                $storeTransaksi['ID_USERS']         = $param['idUser'];
                $storeTransaksi['ID_MAPPING']       = $param['idMapping'];
                $this->db->insert('TRANSACTION', $storeTransaksi);

                $storeJalan['ID_JALAN']        = $idJalan;
                $storeJalan['ID_TRANS']        = $idTrans;
                $storeJalan['NAMA_JALAN']      = $param['nama'];
                $storeJalan['TGL_JALAN']       = $param['tgl'];
                $storeJalan['KENDARAAN_JALAN'] = $param['kendaraan'];
                $storeJalan['KEPERLUAN_JALAN'] = $param['keperluan'];
                
                $lastData 	            = $this->db->order_by('TGLOUT_JALAN', 'desc')->get('FORM_JALAN', 2)->row();
                $monthRomawi            = $this->datefunction->getMonthRomawi();
                $romawiMonth            = $this->datefunction->getRomawiMonth();
                if($lastData != null){
                    $numberLast = explode('/', $lastData->NO_JALAN)[0];
                    $monthLast  = explode('/', $lastData->NO_JALAN)[1];
                    $noJalan    = ($romawiMonth[$monthLast] == date('n') ? sprintf("%03d", (int)$numberLast + 1) : sprintf("%03d", 1));
                }else{
                    $noJalan = sprintf("%03d", 1);
                }
                $storeJalan['NO_JALAN'] = $noJalan.'/'.$monthRomawi[date('n')].'/9972/'.date('Y');
                $this->db->insert('FORM_JALAN', $storeJalan);
                
                $flow = $this->db->get_where('FLOW', ['ID_MAPPING' => $mapping[0]->ID_MAPPING])->result_array();
                for($i = 1; $i <= 15; $i++){
                    if(!empty($flow[0]['APP_'.$i]) && $flow[0]['APP_'.$i] != null){
                        $this->db->insert('DETAIL_APPROVAL', ['ID_TRANS' => $idTrans, 'ROLE_APP' => $flow[0]['APP_'.$i]]);
                    }else if($flow[0]['APP_1'] == null){
                        $this->db->where('ID_TRANS', $idTrans)->update('TRANSACTION', ['STAT_TRANS' => '2']);
                    }
                }
                
                $resLinkGenerated = $this->ContentPdf->generate(['idTrans' => $idTrans, 'orientation' => 'portrait']);
                $this->db->where('ID_TRANS', $idTrans)->update('TRANSACTION', ['PATH_TRANS' => base_url($resLinkGenerated)]);
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
