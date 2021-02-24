<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransactionController extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Transaction');
    }
    public function vTrans(){
        $datas['trans'] = $this->Transaction->getAll();

        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/master_transaksi/transaksi', $datas);
		$this->load->view('template/admin/modal');
		$this->load->view('template/admin/footer');
    }

    public function store(){
    }
    public function update(){
    }
    public function destroy(){
    }

    public function approve(){
        
    }
    public function reject(){

    }
}