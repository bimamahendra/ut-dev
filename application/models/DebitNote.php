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
        $res    = $this->db->get_where('DEBITNOTE', $param)->row();
        return $res;
    }
    public function getdn(){
        $sql = "SELECT sum(GRANDTOTAL_DEBITNOTE) as total FROM DEBITNOTE";
        $result = $this->db->query($sql);
        return $result->row()->total;
    }
    public function getovddn(){
        $sql = "SELECT sum(GRANDTOTAL_DEBITNOTE) as total FROM DEBITNOTE WHERE STAT_DEBITNOTE=5";
        $result = $this->db->query($sql);
        return $result->row()->total;
    }
    public function getmonthlydn(){
        $sql = "SELECT SUM(GRANDTOTAL_DEBITNOTE) as TOTAL, MONTH(TGLPESANAN_DEBITNOTE) as BULAN FROM DEBITNOTE GROUP BY MONTH(TGLPESANAN_DEBITNOTE)";
        $result = $this->db->query($sql)->result();
        return $result;
    }
    public function getBulanFinishDN(){
        $sql = "SELECT SUM(GRANDTOTAL_DEBITNOTE) as TOTAL, MONTH(TGLPESANAN_DEBITNOTE) as BULAN
        FROM DEBITNOTE WHERE STAT_DEBITNOTE = 6
      GROUP BY MONTH(TGLPESANAN_DEBITNOTE)";
        $result = $this->db->query($sql)->result();
        return $result;
    }
    public function getrcvdn(){
        $sql = "SELECT sum(GRANDTOTAL_DEBITNOTE) as total FROM DEBITNOTE WHERE STAT_DEBITNOTE=6";
        $result = $this->db->query($sql);
        return $result->row()->total;
    }
    public function getReminder($param){
        if(!empty($param['whereIn'])){
            $this->db->where_in($param['whereIn']['table'], $param['whereIn']['values']);
            unset($param['whereIn']);
        }
        if(!empty($param['orderBy'])){
            $this->db->order_by($param['orderBy']);
            unset($param['orderBy']);
        }

        $this->db->where($param);
        $res = $this->db->get('DEBITNOTE')->result();
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
    public function updateStatusMulti($param){
        $this->db->where_in('ID_DEBITNOTE', $param['ID_DEBITNOTES'])->update('DEBITNOTE', ['STAT_DEBITNOTE' => $param['STATUS']]);
        return true;
    }
    public function delete($param){
        $this->db->where($param)->delete('DEBITNOTE');
        return true;
    }

    public function generate($param){
        $debitnote = $this->db->get_where('DEBITNOTE', ['ID_DEBITNOTE' => $param['ID_DEBITNOTE']])->result();
        $approvals = $this->db->get_where('V_DEBITNOTE_APPROVAL', ['ID_DEBITNOTE' => $param['ID_DEBITNOTE']])->result();
        $data['list']       = $debitnote;
        $data['approvals']  = $approvals;
        $data['getMonth']   = $this->datefunction->getMonth();
		       
        $file_pdf = $debitnote[0]->NOFAKTUR_DEBITNOTE.'_'.$debitnote[0]->NAMAPERUSAHAAN_DEBITNOTE.'_'.time();
        $path_pdf = 'uploads/debitnote/generated/'.$debitnote[0]->EMAIL_DEBITNOTE.'/'.$file_pdf.'.pdf';
		
        $paper = 'A4';
        $orientation = 'portrait';
        
		$html = $this->load->view('pdf_template/debit_note', $data, true);	    

        $resPdf = $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
        if(!is_dir('./uploads/debitnote/generated/'.$debitnote[0]->EMAIL_DEBITNOTE)){
            mkdir('./uploads/debitnote/generated/'.$debitnote[0]->EMAIL_DEBITNOTE, 0777, TRUE);
        }
        file_put_contents($path_pdf, $resPdf);

        $param['PATH_DEBITNOTE'] = base_url($path_pdf);
        $this->update($param);
        
        return true;
    }
    public function generateMulti($param){
        foreach($param as $item){
            $debitnote = $this->db->get_where('DEBITNOTE', ['ID_DEBITNOTE' => $item])->result();
            $approvals = $this->db->get_where('V_DEBITNOTE_APPROVAL', ['ID_DEBITNOTE' => $item])->result();
            $data['list']       = $debitnote;
            $data['approvals']  = $approvals;
            $data['getMonth']   = $this->datefunction->getMonth();
                   
            $file_pdf = $debitnote[0]->NOFAKTUR_DEBITNOTE.'_'.$debitnote[0]->NAMAPERUSAHAAN_DEBITNOTE.'_'.time();
            $path_pdf = 'uploads/debitnote/generated/'.$debitnote[0]->EMAIL_DEBITNOTE.'/'.$file_pdf.'.pdf';
            
            $paper = 'A4';
            $orientation = 'portrait';
            
            $html = $this->load->view('pdf_template/debit_note', $data, true);	    
    
            $resPdf = $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
            if(!is_dir('./uploads/debitnote/generated/'.$debitnote[0]->EMAIL_DEBITNOTE)){
                mkdir('./uploads/debitnote/generated/'.$debitnote[0]->EMAIL_DEBITNOTE, 0777, TRUE);
            }
            file_put_contents($path_pdf, $resPdf);
            
            $dataUpdate['ID_DEBITNOTE']     = $item;
            $dataUpdate['STAT_DEBITNOTE']   = '1';
            $dataUpdate['PATH_DEBITNOTE']   = base_url($path_pdf);
            $this->update($dataUpdate);
        }
        
        return true;
    }
}