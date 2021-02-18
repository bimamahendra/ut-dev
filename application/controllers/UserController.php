<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    public function vUser(){
        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/master_user/user');
		$this->load->view('template/admin/modal');
		$this->load->view('template/admin/footer');
    }

    public function vUserEdit(){
        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/master_user/user_edit');
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