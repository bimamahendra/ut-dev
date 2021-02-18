<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{
    public function vDashboard(){
        $this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('template/admin/topbar');
		$this->load->view('admin/index');
		$this->load->view('template/admin/modal');
		$this->load->view('template/admin/footer');
    }
}