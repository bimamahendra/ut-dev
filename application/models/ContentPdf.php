<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class ContentPdf extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library('pdfgenerator');
    }

    public function generate($param){
        $trans      = $this->db->get_where('V_TRANSACTION', ['ID_TRANS' => $param['idTrans']])->result();
        $mappPdf    = $this->db->get_where('V_MAPPING_PDF', ['ID_MAPPING' => $trans[0]->ID_MAPPING])->result();
        $user       = $this->db->get_where('USERS', ['ID_USERS' => $trans[0]->ID_USERS])->result();
        
        $data['list']                   = $this->get(['table' => $mappPdf[0]->NAMA_TABEL, 'idTrans' => $param['idTrans']]);				
        $data['title_pdf']              = $mappPdf[0]->NAMA_FORM;
        $data['user']                   = $user[0];	
		       
        $file_pdf = $trans[0]->NAMA_USERS.'_'.$mappPdf[0]->NAMA_FORM.'_'.time();
        $path_pdf = 'uploads/transaction/'.$user[0]->USER_USERS.'/'.$file_pdf.'.pdf';
		
        $paper = 'A4';
        $orientation = "portrait";
        
		$html = $this->load->view($mappPdf[0]->PATH_TEMPLATE_PDF, $data, true);	    

        $resPdf = $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        if(!is_dir('./uploads/transaction/'.$user[0]->USER_USERS)){
            mkdir('./uploads/transaction/'.$user[0]->USER_USERS, 0777, TRUE);
        }
        file_put_contents($path_pdf, $resPdf);
        $this->db->where('ID_TRANS', $param['idTrans'])->update('TRANSACTION', ['PATH_TRANS' => $path_pdf]);
        return true;
    }

    public function get($param){
        $detailForms = $this->db->get_where('V_'.$param['table'].'_DETAIL', ['ID_TRANS' => $param['idTrans']])->result();
        return $detailForms;
    }
}