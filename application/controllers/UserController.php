<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('User');
    }
    public function vUser(){
        $data['listData'] = $this->User->getAll();

        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/master_user/user', $data);
		$this->load->view('template/admin/modal');
		$this->load->view('template/admin/footer');
    }

    public function vUserEdit($id){
        $data['dataUser'] = $this->User->get(['filter' => ['ID_USERS' => $id]]);

        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/master_user/user_edit', $data);
		$this->load->view('template/admin/modal');
		$this->load->view('template/admin/footer');
    }

    public function store(){
        $datas                  = $_POST;
        $datas['ID_USERS']      = substr(md5(time()), 0, 8);
        $datas['PASS_USERS']    = hash('sha256', md5($datas['PASS_USERS']));

        $this->User->insert($datas);
        redirect('user');
    }
    public function update(){
        $datas = $_POST;
        $this->User->update($datas);
        redirect('user');
    }
    public function destroy(){
        $datas = $_POST;
        $this->User->delete($datas);
        redirect('user');
    }
    public function resetPassword(){
        $datas = $_POST;
        $datas['PASS_USERS']    = hash('sha256', md5('123ut456'));
        $this->User->update($datas);

        $notif['status'] = 'Success';
        $notif['message'] = 'Berhasil reset password.';

        redirect('user', $this->session->set_flashdata('notif', ['status' => 'Success', 'message' => 'Berhasil reset password.']));
    }
}