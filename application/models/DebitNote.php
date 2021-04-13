<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class DebitNote extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->library('pdfgenerator');
        $this->load->library('datefunction');
    }

    public function getAll($param){
        $res = $this->db->order_by('TGLOUT_DEBITNOTE', 'DESC')->get_where('DEBITNOTE', $param)->result();
        return $res;
    }
    public function get($param){
        $res    = $this->db->get_where('DEBITNOTE', $param)->result();
        return $res;
    }
    public function insert($param){
        $this->db->insert('DEBITNOTE', $param);
        return $this->db->insert_id();
    }
    public function insertBatch($param){
        return $this->db->insert_batch('DEBITNOTE', $param);
    }
    public function update($param){
        $this->db->where('ID_DEBITNOTE', $param['ID_DEBITNOTE'])->update('DEBITNOTE', $param);
        return true;
    }
    public function delete($param){
        $this->db->where($param)->delete('DEBITNOTE');
        return true;
    }

    public function generate($param){
        $debitnote = $this->db->get_where('DEBITNOTE', ['ID_DEBITNOTE' => $param['ID_DEBITNOTE']])->result();
        $data['list']       = $debitnote;
        $data['getMonth']   = $this->datefunction->getMonth();
		       
        $file_pdf = $debitnote[0]->NOFAKTUR_DEBITNOTE.'_'.$debitnote[0]->NAMAPERUSAHAAN_DEBITNOTE;
        $path_pdf = 'uploads/debitnote/'.$file_pdf.'.pdf';
		
        $paper = 'A4';
        $orientation = 'landscape';
        
		$html = $this->load->view('pdf_template/debit_note', $data, true);	    

        $resPdf = $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        if(!is_dir('./uploads/debitnote')){
            mkdir('./uploads/debitnote', 0777, TRUE);
        }
        file_put_contents($path_pdf, $resPdf);

        $param['PATH_DEBITNOTE'] = base_url($path_pdf);
        $this->update($param);
        
        return true;
    }
}