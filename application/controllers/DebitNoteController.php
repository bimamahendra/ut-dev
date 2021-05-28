<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class DebitNoteController extends CI_Controller
{
    function __construct(){
        parent::__construct();

        if(empty($this->session->userdata('ROLE_USERS')) || $this->session->userdata('ROLE_USERS') != 'Admin Debitnote'){
            redirect('login');
        }

        $this->load->model('DebitNote');
		$this->load->library(array('upload','emailing','notification','zip'));
        $this->load->helper('download');
    }
    public function vDN(){
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 0]);

		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_raw', $datas);
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNGenerated(){
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 1]);

		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_generate', $datas);
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNApproved(){
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 2]);

		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_approved', $datas);
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNRejected(){
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 3]);

		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_rejected', $datas);
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNProgress(){
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 4]);

		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_progress', $datas);
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNOverdue(){
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 5]);

		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_overdue', $datas);
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNFinished(){
        $datas['debitnotes'] = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 6]);

		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_finished', $datas);
		$this->load->view('template/admin_dn/footer');
    }

    public function vDNMonitor(){
        $datas['debitnotes']   = $this->DebitNote->getAll(['STAT_DEBITNOTE' => 6]);
        $datas['total']        = $this->DebitNote->getdn();
        $datas['ovdtotal']     = $this->DebitNote->getovddn();
        $datas['rcvtotal']     = $this->DebitNote->getrcvdn();
        $datas['monthly']      = $this->DebitNote->getmonthlydn();
        $datas['rentCharge']   = $this->DebitNote->getRentCharge();
        $datas['rentOverdue']  = $this->DebitNote->getRentOverdue();
        $datas['utilCharge']   = $this->DebitNote->getUtilCharge();
        $datas['utilOverdue']  = $this->DebitNote->getUtilOverdue();
        $datas['othersCharge'] = $this->DebitNote->getOthersCharge();
        $datas['othersOverdue']= $this->DebitNote->getOthersOverdue();
        $datas['tahunan']      = $this->DebitNote->getTahunanDN();
        $datas['tahunan2020']  = $this->DebitNote->getTahunanDN2020();
        $datas['tahunan2022']  = $this->DebitNote->getTahunanDN2022();
        $datas['tahunan2023']  = $this->DebitNote->getTahunanDN2023();
        $datas['tahunan2024']  = $this->DebitNote->getTahunanDN2024();
        $datas['tahunan2025']  = $this->DebitNote->getTahunanDN2025();
        $datas['totalTahunan'] = $this->DebitNote->grandTotal();
        $datas['received']     = $this->DebitNote->getBulanFinishDN();
        $datas['topTenants']   = $this->DebitNote->getTopTenantsDN();
        $datas['agingTiga']    = $this->DebitNote->getAgingTigaPuluh();
        $datas['agingTigaEnam']= $this->DebitNote->getAgingTigaEnam();
        $datas['agingEnam']    = $this->DebitNote->getAgingEnamPuluh();

        $this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_dashboard', $datas);
		$this->load->view('template/admin_dn/monitoringfooter',$datas);
    }



    public function vDNEdit($id){
    }

    public function store(){    
        $config['upload_path'] = './uploads/debitnote/fileUploaded/'; 
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['file_name'] = time();
 
        $this->upload->initialize($config);
        if(!empty($_FILES['FILEDN']['name'])){
            if($this->upload->do_upload('FILEDN')){
                $fileDN         = $this->upload->data();
                $filePath       = './uploads/debitnote/fileUploaded/'.$fileDN['file_name'];
                $spreadsheet    = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
                $arrSpreadsheet = $spreadsheet->getActiveSheet()->toArray();
                $highestRow     = $spreadsheet->getActiveSheet()->getHighestRow();

                $value = $spreadsheet->getActiveSheet()->getCell('B5')->getValue();
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value);

                $dataStore = array();
                for($i = 4; $i < $highestRow; $i++){
                    $date = date_create($arrSpreadsheet[$i][1]);

                    $data['ID_DEBITNOTE']               = 'DN_'.md5(time().$this->getRandString(5));
                    $data['NOFAKTUR_DEBITNOTE']         = $arrSpreadsheet[$i][0];
                    $data['TGLFAKTUR_DEBITNOTE']        = date('Y-m-d', strtotime($arrSpreadsheet[$i][1]));
                    $data['TGLJATUH_DEBITNOTE']         = date('Y-m-d', strtotime($arrSpreadsheet[$i][2]));
                    $data['NOFAKTURPAJAK_DEBITNOTE']    = $arrSpreadsheet[$i][3];
                    $data['KURSPAJAK_DEBITNOTE']        = $arrSpreadsheet[$i][4];
                    $data['NOPELANGGAN_DEBITNOTE']      = $arrSpreadsheet[$i][5];
                    $data['EMAIL_DEBITNOTE']            = $arrSpreadsheet[$i][6];
                    $data['NOPESANAN_DEBITNOTE']        = $arrSpreadsheet[$i][7];
                    $data['TGLPESANAN_DEBITNOTE']       = date('Y-m-d', strtotime($arrSpreadsheet[$i][8]));
                    $data['MATAUANG']                   = $arrSpreadsheet[$i][9]; 
                    $data['NAMAPERUSAHAAN_DEBITNOTE']   = $arrSpreadsheet[$i][10];
                    $data['ALAMATPERUSAHAAN_DEBITNOTE'] = $arrSpreadsheet[$i][11]; 
                    $data['NPWP_DEBITNOTE']             = $arrSpreadsheet[$i][12];
                    $data['BARANGJASA_DEBITNOTE']       = $arrSpreadsheet[$i][13];
                    $data['HARGAJUAL_DEBITNOTE']        = str_replace(',', '', $arrSpreadsheet[$i][14]);
                    $data['TOTHARGAJUAL_DEBITNOTE']     = str_replace(',', '', $arrSpreadsheet[$i][15]);
                    $data['POTHARGA_DEBITNOTE']         = str_replace(',', '', $arrSpreadsheet[$i][16]);
                    $data['UANGMUKA_DEBITNOTE']         = str_replace(',', '', $arrSpreadsheet[$i][17]);
                    $data['HARGAPOTONGAN_DEBITNOTE']    = str_replace(',', '', $arrSpreadsheet[$i][18]);
                    $data['DPP_DEBITNOTE']              = str_replace(',', '', $arrSpreadsheet[$i][19]);
                    $data['PPN_DEBITNOTE']              = str_replace(',', '', $arrSpreadsheet[$i][20]);
                    $data['GRANDTOTAL_DEBITNOTE']       = str_replace(',', '', $arrSpreadsheet[$i][21]);
                    $data['TIPE_DEBITNOTE']             = $arrSpreadsheet[$i][22];
                    array_push($dataStore, $data);
                }
                $this->DebitNote->insertBatch($dataStore);
            }else {
                echo $this->upload->display_errors();	
            }
        }
        redirect('debitnote');
    }
    public function update(){
        $datas = $_POST;
        
        $this->Form->update($datas);
        redirect('form');
    }
    public function destroy(){
        $datas = $_POST;
        $this->Form->delete($datas);
        redirect('form');
    }
    public function finish(){
        $datas = $_POST;

        $page = $datas['page'];
        unset($datas['page']);

        $this->DebitNote->update($datas);
        redirect('debitnote/'.$page);
    }
    public function finishMulti(){
        $param                  = $_POST;
        
        $page   = $param['page'];
        $datas['ID_DEBITNOTES'] = explode(',', $_POST['ID_DEBITNOTE']);
        $datas['STATUS']        = '6'; 

        $this->DebitNote->updateStatusMulti($datas);
        redirect('debitnote/'.$page);
    }

    public function downloadTemplate(){
        force_download('./assets/templates/DEBITNOTE_TEMPLATE.xlsx', NULL);
    }

    public function downloadPdf(){
        $param = $_POST;
        $path = str_replace(base_url(), '', $param['PATH_DEBITNOTE']);
        force_download($path, NULL);
    }

    public function getRandString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateDN(){
        $param =  $_POST;    

        $this->db->insert('DEBITNOTE_APPROVAL', ['ID_DEBITNOTE' => $param['ID_DEBITNOTE'], 'ROLE_APP' => 'Department Head']);
        $this->DebitNote->generate($param);

        $notif['title']     = 'Info Pengajuan Debit Note';
        $notif['message']   = 'Terdapat Pengajuan Debit Note';
        $notif['regisIds']  = $this->db->get_where('USERS', ['ROLE_USERS' => 'Department Head'])->result_array();
        $this->notification->push($notif);
        
        redirect('debitnote');
    }

    public function generateMultiDN() {
        $param      = explode(',', $_POST['ID_DEBITNOTE']);
        $dataStore  = array();

        foreach($param as $item){
            $temp['ID_DEBITNOTE']   = $item;
            $temp['ROLE_APP']       = 'Department Head';
            array_push($dataStore, $temp);
        }
        $this->db->insert_batch('DEBITNOTE_APPROVAL', $dataStore);
        $this->DebitNote->generateMulti($param);

        redirect('debitnote');
    }

    public function downloadMultiDN(){
        $param = explode(',', $_POST['ID_DEBITNOTE']);
        $debitNotes = $this->db->select('PATH_DEBITNOTE')->where_in('ID_DEBITNOTE', $param)->get('DEBITNOTE')->result();
        foreach ($debitNotes as $item) {
            $this->zip->read_file(str_replace(base_url(), '', $item->PATH_DEBITNOTE));
        }
        $this->zip->download(date('YmdHis').'_Download Debitnotes.zip');
    }

    public function updateProgress(){
        $date = date('Y-m-d');
        $debitNotes = $this->DebitNote->getAll(['STAT_DEBITNOTE' => '4']);

        if($debitNotes != null){
            foreach ($debitNotes as $item) {
                $dnDateEnd = date_create($item->TGLJATUH_DEBITNOTE);
                $dnDateEnd = date_format($dnDateEnd, 'Y-m-d');

                if($date > $dnDateEnd){
                    $this->DebitNote->update(['ID_DEBITNOTE' => $item->ID_DEBITNOTE, 'STAT_DEBITNOTE' => '5']);
                }
            }
        }
    }
}