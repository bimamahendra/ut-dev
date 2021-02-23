<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PdfSnack extends CI_Controller {
    public function index()
    {
        $this->load->library('pdfgenerator');        
		
        $this->data['title_pdf'] = 'Form Permintaan Snack';        
        $file_pdf = 'form_permintaan_snack';
		
        $paper = 'A4';
        $orientation = "portrait";
        
		$html = $this->load->view('pdf_template/form_snack',$this->data, true);	    
        
        $this->pdfgenerator->generate($html, $file_pdf,$paper,$orientation);
    }
}