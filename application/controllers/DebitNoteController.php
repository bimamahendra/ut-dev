<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DebitNoteController extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('DebitNote');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }
    public function vDN(){
		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_raw');
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNGenerated(){
		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_generate');
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNApproved(){
		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_approved');
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNRejected(){
		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_rejected');
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNProgress(){
		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_progress');
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNOverdue(){
		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_overdue');
		$this->load->view('template/admin_dn/footer');
    }
    public function vDNFinished(){
		$this->load->view('template/admin_dn/header');
		$this->load->view('template/admin_dn/sidebar');
		$this->load->view('template/admin_dn/topbar');
		$this->load->view('admin_dn/master_dn/dn_finished');
		$this->load->view('template/admin_dn/footer');
    }



    public function vDNEdit($id){
    }

    public function store(){        
        if(isset($_POST['EXCEL'])){
			$filename = $_FILES['file']['name'];

			$config['upload_path'] = './uploads/debitnote/';
			$config['file_name'] = $filename;
			$config['allowed_types'] = 'xls|xlsx|csv';

			$this->load->library('upload');
			$this->upload->initialize($config);

			if(! $this->upload->do_upload('file')){
				$this->upload->display_errors();	
			}else {
				echo "Uploaded";
			}
			

			$media = $this->upload->data('FILEDN');
			$inputFileName = './uploads/'.$filename;

			// try {
            //     $inputFileType = IOFactory::identify($inputFileName);
            //     $objReader = IOFactory::createReader($inputFileType);
            //     $objPHPExcel = $objReader->load($inputFileName);
            // } catch(Exception $e) {
            //     die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            // }

            // $sheet = $objPHPExcel->getSheet(0);
            // $highestRow = $sheet->getHighestRow();
            // $highestColumn = $sheet->getHighestColumn();

            // for($row = 5; $row <= $highestRow; $row++){
            // 	$rowData = $sheet->rangeToArray('B' . $row . ':' . $highestColumn . $row,
            //                                     NULL,
            //                                     TRUE,
            //                                     FALSE);
            // 	// print_r($rowData[0][0]);
            // 	// $rData = explode(";", $rowData[0][0]);
            // 	// print_r($rData);
            // 	// echo "<br>";
            //  //    echo "<br>";
            	

            // 	$data = array(
            // 		"no_invoice"=> $rowData[0][0],
            // 		"no_sp2d"=> $rowData[0][1],
            // 		"jenis_spm"=> $rowData[0][2],
            // 		"tgl_upload"=> $this->parseDate($rowData[0][3]),
            // 		"wkt_upload"=> $rowData[0][4],
            // 		"tgl_pd"=> $this->parseDate($rowData[0][5]),
            // 		"wkt_pd"=> $rowData[0][6],
            // 		"tgl_bank"=> $this->parseDate($rowData[0][7]),
            // 		"wkt_bank"=> $rowData[0][8],
            // 		"durasi"=> $rowData[0][9],
            // 		"jumlah"=> $rowData[0][10]
            // 	);

            // 	// print_r($data);

            // 	$this->Import_csv->insert($data);
            // }
		}
        // redirect('form');
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

    public function vFlow($id){
        $datas['flows'] = $this->Form->getFlow(['filter' => ['ID_MAPPING' => $id]]);

        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/master_form/list_approval', $datas);
		$this->load->view('template/admin/modal');
		$this->load->view('template/admin/footer');
    }

    public function updateFlow(){
        $datas = $_POST;
        
        $this->Form->updateFlow($datas);
        redirect('form/flow/'.$datas['ID_MAPPING']);
    }

    public function deleteFlow(){
        $datas = $_POST;
        
        $this->Form->deleteFlow($datas);
        redirect('form/flow/'.$datas['ID_MAPPING']);
    }

    public function editFlow(){
        $datas = $_POST;
        
        $this->Form->editFlow($datas);
        redirect('form/flow/'.$datas['ID_MAPPING']);
    }
}