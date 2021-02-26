<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotificationController extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('User');
        $this->load->library(array('upload', 'notification'));
    }
    public function getAll(){
        $datas['notifs']         = $this->db->get_where('V_TRANSACTION', ['IS_SEEN' => '0'], '5')->result();
        $datas['notifCount']     = $this->db->get_where('V_TRANSACTION', ['IS_SEEN' => '0'])->num_rows();
        
		$this->load->view('template/admin/notif', $datas);
	}
    public function read($id){
        $this->db->where('ID_TRANS', $id)->update('TRANSACTION', ['IS_SEEN' => '1']);
        redirect('transaction');
    }
    public function readAll(){
        $this->db->update('TRANSACTION', ['IS_SEEN' => '1']);
        redirect('transaction');
    }
}