<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User');
    }
    public function vlogin()
    {
        if (!empty($this->session->userdata('ROLE_USERS'))) {
            if ($this->session->userdata('ROLE_USERS') == 'Admin GA') {
                redirect('dashboard');
            } else if ($this->session->userdata('ROLE_USERS') == 'Admin Debitnote') {
                redirect('debitnote/dashboard');
            }
        }
        $this->load->view('template/header');
        $this->load->view('login');
        $this->load->view('template/footer');
    }
    public function login()
    {
        $datas = $_POST;
        print_r($datas);
        $user = $this->User->get(['filter' => ['USER_USERS' => $datas['USER_USERS']]]);

        if ($user != null) {
            if ($user[0]->ROLE_USERS == 'Admin Debitnote' || $user[0]->ROLE_USERS == 'Admin GA') {
                $pass = hash('sha256', md5($datas['PASSWORD_USERS']));

                if ($pass == $user[0]->PASS_USERS) {
                    $dataSession = array(
                        'ID_USERS'      => $user[0]->ID_USERS,
                        'NAMA_USERS'    => $user[0]->NAMA_USERS,
                        'USER_USERS'    => $user[0]->USER_USERS,
                        'ROLE_USERS'    => $user[0]->ROLE_USERS
                    );
                    $this->session->set_userdata($dataSession);

                    if ($user[0]->ROLE_USERS == 'Admin GA') {
                        redirect('dashboard');
                    } else {
                        redirect('debitnote/dashboard');
                    }
                } else {
                    redirect('login', $this->session->set_flashdata('error_login', 'Username/Password tidak cocok!'));
                }
            } else {
                redirect('login', $this->session->set_flashdata('error_login', 'Anda tidak memiliki hak akses!'));
            }
        }
        // redirect('login', $this->session->set_flashdata('error_login', 'Data user tidak ditemukan!'));
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
