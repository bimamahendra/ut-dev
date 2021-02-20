<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormController extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Form');
    }
    public function vForm(){
        $datas['tables'] = $this->Form->getTables();
        $datas['forms'] = $this->Form->getAll();

        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/master_form/form', $datas);
		$this->load->view('template/admin/modal');
		$this->load->view('template/admin/footer');
    }

    public function vFormEdit($id){
        $datas['tables'] = $this->Form->getTables();
        $datas['form'] = $this->Form->get(['filter' => ['ID_MAPPING' => $id]]);

        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/master_form/form_edit', $datas);
		$this->load->view('template/admin/modal');
		$this->load->view('template/admin/footer');
    }

    public function store(){
        $datas = $_POST;
        $datas['ID_MAPPING']      = 'MAPP_'.substr(md5(time()), 0, 45);

        $retId = $this->Form->insert($datas);
        redirect('form');
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
        $datas['flows'] = $this->Form->getFlowAll();

        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/master_form/list_approval', $datas);
		$this->load->view('template/admin/modal');
		$this->load->view('template/admin/footer');
    }
}