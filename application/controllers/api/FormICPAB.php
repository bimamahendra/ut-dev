<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class FormICPAB extends RestController {
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
                $idTrans        = 'TRANS_'.md5(time()."trans");
                $idICPAB        = 'ICPAB_'.md5(time()."icpab");
                
                $storeTransaksi['ID_TRANS']         = $idTrans;
                $storeTransaksi['ID_USERS']         = $param['idUser'];
                $storeTransaksi['ID_MAPPING']       = $param['idMapping'];
                $this->db->insert('TRANSACTION', $storeTransaksi);
                
                $storeICPAB['ID_POMPA']             = $idICPAB;
                $storeICPAB['ID_TRANS']             = $idTrans;
                $storeICPAB['TGL_POMPA']            = $param['tgl'];
                $storeICPAB['LOKASI_POMPA']         = $param['lokasi'];
                $storeICPAB['TGLCEK1_POMPA']        = $param['cek1']['tgl'];
                $storeICPAB['TGLCEK2_POMPA']        = $param['cek2']['tgl'];
                $storeICPAB['TGLCEK3_POMPA']        = $param['cek3']['tgl'];
                $storeICPAB['TGLCEK4_POMPA']        = $param['cek4']['tgl'];
                
                $arr['kondAir']         = array();
                $arr['airPancingan']    = array();
                $arr['indikator']       = array();
                $arr['tekUdara']        = array();
                $arr['flowMeter']       = array();
                $arr['supplyAir']       = array();
                $arr['manSupply']       = array();
                $arr['fungsiPanel']     = array();
                for($x = 1; $x <= 4; $x++){
                    array_push($arr['kondAir'], $param['cek'.$x]['kondAir']['status']);
                    array_push($arr['kondAir'], $param['cek'.$x]['kondAir']['keterangan']);
                    
                    array_push($arr['airPancingan'], $param['cek'.$x]['airPancingan']['status']);
                    array_push($arr['airPancingan'], $param['cek'.$x]['airPancingan']['keterangan']);
                    
                    array_push($arr['indikator'], $param['cek'.$x]['indikator']['status']);
                    array_push($arr['indikator'], $param['cek'.$x]['indikator']['keterangan']);
                    
                    array_push($arr['tekUdara'], $param['cek'.$x]['tekUdara']['status']);
                    array_push($arr['tekUdara'], $param['cek'.$x]['tekUdara']['keterangan']);
                    
                    array_push($arr['flowMeter'], $param['cek'.$x]['flowMeter']['status']);
                    array_push($arr['flowMeter'], $param['cek'.$x]['flowMeter']['keterangan']);
                    
                    array_push($arr['supplyAir'], $param['cek'.$x]['supplyAir']['status']);
                    array_push($arr['supplyAir'], $param['cek'.$x]['supplyAir']['keterangan']);
                    
                    array_push($arr['manSupply'], $param['cek'.$x]['manSupply']['status']);
                    array_push($arr['manSupply'], $param['cek'.$x]['manSupply']['keterangan']);
                    
                    array_push($arr['fungsiPanel'], $param['cek'.$x]['fungsiPanel']['status']);
                    array_push($arr['fungsiPanel'], $param['cek'.$x]['fungsiPanel']['keterangan']);
                }
                $storeICPAB['KONDISIAIR_POMPA']     = implode(';', $arr['kondAir']);
                $storeICPAB['AIRPANCINGAN_POMPA']   = implode(';', $arr['airPancingan']);
                $storeICPAB['INDIKATOR_POMPA']      = implode(';', $arr['indikator']);
                $storeICPAB['TEKANANUDARA_POMPA']   = implode(';', $arr['tekUdara']);
                $storeICPAB['FLOWMETER_POMPA']      = implode(';', $arr['flowMeter']);
                $storeICPAB['SUPPLYAIR_POMPA']      = implode(';', $arr['supplyAir']);
                $storeICPAB['MANUALSUPPLY_POMPA']   = implode(';', $arr['manSupply']);
                $storeICPAB['FUNGSIPANEL_POMPA']    = implode(';', $arr['fungsiPanel']);
                $this->db->insert('FORM_POMPA', $storeICPAB);

                
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
