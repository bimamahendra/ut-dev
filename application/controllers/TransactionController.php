<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransactionController extends CI_Controller
{
    function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('ROLE_USERS')) || $this->session->userdata('ROLE_USERS') != 'Admin GA'){
            redirect('login');
        }
        $this->load->model('Transaction');
        $this->load->library('notification');
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
        $param                  = $_POST;
        $param['STAT_TRANS']    = '1';
        $this->Transaction->update($param);

        $transaction        = $this->Transaction->get(['filter' => ['ID_TRANS' => $param['ID_TRANS']]]);
        $notif['title']     = 'Pengajuan Baru';
        $notif['message']   = 'Terdapat Pengajuan Form '.$transaction[0]->NAMA_FORM;
        $notif['regisIds']  = $this->db->get_where('USERS', ['ROLE_USERS' => $transaction[0]->CONFIRM_STATE_TRANS])->result_array();
        $this->notification->push($notif);
        
        $notif['title']     = 'Info Pengajuan Form';
        $notif['message']   = 'Pengajuan Form '.$transaction[0]->NAMA_FORM.' Telah Diverifikasi';
        $notif['regisIds']  = $this->db->get_where('USERS', ['ID_USERS' => $transaction[0]->ID_USERS])->result_array();
        $this->notification->push($notif);
        redirect('transaction');
    }
    public function reject(){
        $param                  = $_POST;
        $param['STAT_TRANS']    = '3';
        $this->Transaction->update($param);

        $transaction        = $this->Transaction->get(['filter' => ['ID_TRANS' => $param['ID_TRANS']]]);
        $notif['title']     = 'Info Pengajuan Form';
        $notif['message']   = 'Pengajuan Form '.$transaction[0]->NAMA_FORM.' Ditolak';
        $notif['regisIds']  = $this->db->get_where('USERS', ['ID_USERS' => $transaction[0]->ID_USERS])->result_array();
        $this->notification->push($notif);
        redirect('transaction');
    }
}