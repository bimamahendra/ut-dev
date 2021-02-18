<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    public function vlogin() {
        $this->load->view('template/header');
		$this->load->view('login');
		$this->load->view('template/footer');
    }
    public function login(){
        redirect('dashboard');
    }
    
    public function logout(){
        redirect('/');
    }
}