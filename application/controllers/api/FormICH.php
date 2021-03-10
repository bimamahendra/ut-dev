<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class FormICH extends RestController {
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
                $idICH          = 'ICH_'.substr(md5(time()."ich"), 0, 15);
                
                $storeTransaksi['ID_TRANS']         = $idTrans;
                $storeTransaksi['ID_USERS']         = $param['idUser'];
                $storeTransaksi['ID_MAPPING']       = $param['idMapping'];
                $this->db->insert('TRANSACTION', $storeTransaksi);
                
                $storeICH['ID_HYDRANT']         = $idICH;
                $storeICH['ID_TRANS']           = $idTrans;
                $storeICH['TGL_HYDRANT']        = $param['tgl'];
                $storeICH['LOKASI_HYDRANT']     = $param['lokasi'];
                $storeICH['KEBOCORAN_PIPA']     = $param['kebocoranPipa']['status'].";".$param['kebocoranPipa']['catatan'];
                $storeICH['FLANGE_PIPA']        = $param['flangePipa']['status'].";".$param['flangePipa']['catatan'];
                $storeICH['POSISI_VALVE']       = $param['posisiValve']['status'].";".$param['posisiValve']['catatan'];
                $storeICH['GATE_JOCKEY']        = $param['gateJockey']['status'].";".$param['gateJockey']['catatan'];
                $storeICH['KIPAS_JOCKEY']       = $param['kipasJockey']['status'].";".$param['kipasJockey']['catatan'];
                $storeICH['POWER_JOCKEY']       = $param['powerJockey']['status'].";".$param['powerJockey']['catatan'];
                $storeICH['MOTOR_JOCKEY']       = $param['motorJockey']['status'].";".$param['motorJockey']['catatan'];
                $storeICH['GATE_ELECTRIC']      = $param['gateElectric']['status'].";".$param['gateElectric']['catatan'];
                $storeICH['KIPAS_ELECTRIC']     = $param['kipasElectric']['status'].";".$param['kipasElectric']['catatan'];
                $storeICH['POWER_ELECTRIC']     = $param['powerElectric']['status'].";".$param['powerElectric']['catatan'];
                $storeICH['MOTOR_ELECTRIC']     = $param['motorElectric']['status'].";".$param['motorElectric']['catatan'];
                $storeICH['GATE_DIESEL']        = $param['gateDiesel']['status'].";".$param['gateDiesel']['catatan'];
                $storeICH['RADIATOR_DIESEL']    = $param['radiatorDiesel']['status'].";".$param['radiatorDiesel']['catatan'];
                $storeICH['OLI_DIESEL']         = $param['oliDiesel']['status'].";".$param['oliDiesel']['catatan'];
                $storeICH['FANBELT_DIESEL']     = $param['fanbeltDiesel']['status'].";".$param['fanbeltDiesel']['catatan'];
                $storeICH['BATTERY_DIESEL']     = $param['batteryDiesel']['status'].";".$param['batteryDiesel']['catatan'];
                $storeICH['RPM_DIESEL']         = $param['rpmDiesel']['status'].";".$param['rpmDiesel']['catatan'];
                $storeICH['RUNNING_DIESEL']     = $param['runningDiesel']['status'].";".$param['runningDiesel']['catatan'];
                $storeICH['SWITCH_PANEL']       = $param['switchPanel']['status'].";".$param['switchPanel']['catatan'];
                $storeICH['INDIKATOR_PANEL']    = $param['indikatorPanel']['status'].";".$param['indikatorPanel']['catatan'];
                $storeICH['VOLTMETER_PANEL']    = $param['voltmeterPanel']['status'].";".$param['voltmeterPanel']['catatan'];
                $storeICH['AMPERE_PANEL']       = $param['amperePanel']['status'].";".$param['amperePanel']['catatan'];
                $storeICH['KONEKTOR_PANEL']     = $param['konektorPanel']['status'].";".$param['konektorPanel']['catatan'];                     
                $storeICH['CATATAN_HYDRANT']    = $param['catatan'];
                $this->db->insert('FORM_HYDRANT', $storeICH);
                
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
