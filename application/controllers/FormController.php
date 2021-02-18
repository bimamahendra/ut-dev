<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormController extends CI_Controller
{
    public function vForm(){
        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/master_form/form');
		$this->load->view('template/admin/modal');
		$this->load->view('template/admin/footer');
    }

    public function vFormEdit(){
        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/master_form/form_edit');
		$this->load->view('template/admin/modal');
		$this->load->view('template/admin/footer');
    }

    public function store(){

    }
    public function update(){

    }
    public function destroy(){

    }
}