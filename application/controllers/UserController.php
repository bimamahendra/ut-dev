<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('ROLE_USERS')) || $this->session->userdata('ROLE_USERS') != 'Admin GA'){
            redirect('login');
        }
        $this->load->model('User');
        $this->load->library(array('upload', 'notification'));
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
        $imageTtd = $this->upload_image();

        $param                  = $_POST;
        $param['ID_USERS']      = substr(md5(time()), 0, 8);
        $param['PASS_USERS']    = hash('sha256', md5($param['PASS_USERS']));        
        $param['PATH_TTD']      = $imageTtd;

        $this->User->insert($param);
        redirect('user');
    }
    public function update(){
        $param = $_POST;
        $this->User->update($param);
        redirect('user');
    }
    public function destroy(){
        $param = $_POST;
        $this->User->delete($param);
        redirect('user');
    }
    public function verif(){
        $param                  = $_POST;
        $param['STAT_USERS']    = 1;

        $this->User->update($param);

        $notif['title']     = 'Konfirmasi Akun';
        $notif['message']   = 'Selamat Akun Anda Berhasil Terverifikasi !';
        $notif['regisIds']  = $this->db->get_where('USERS', ['ID_USERS' => $param['ID_USERS']])->result_array();
        $this->notification->push($notif);

        redirect('user');
    }
    public function register(){
        $this->form_validation->set_rules('USER_USERS', 'USER_USERS','is_unique[USERS.USER_USERS]');

        if ($this->form_validation->run()==true)
	   	{
            $imageTtd = $this->upload_image();

            $param                  = $_POST;
            $param['ID_USERS']      = substr(md5(time()), 0, 8);
            $param['PASS_USERS']    = hash('sha256', md5($param['PASS_USERS']));        
            $param['PATH_TTD']      = $imageTtd;

            $this->User->insert($param);
            $this->session->set_flashdata('success_register','Proses Pendaftaran User Berhasil');

            redirect('register');
        }else
		{
            $this->session->set_flashdata('error','Username telah digunakan');
			redirect('register');
		}
    }
    public function resetPassword(){
        $param = $_POST;
        $param['PASS_USERS']    = hash('sha256', md5('123ut456'));
        $this->User->update($param);

        $notif['status'] = 'Success';
        $notif['message'] = 'Berhasil reset password.';

        redirect('user', $this->session->set_flashdata('notif', ['status' => 'Success', 'message' => 'Berhasil reset password.']));
    }
    function upload_image(){
        $config['upload_path'] = './images/ttd/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['encrypt_name'] = TRUE; //Enkripsi nama yang terupload
 
        $this->upload->initialize($config);
        if(!empty($_FILES['imageTtd']['name'])){
 
            if ($this->upload->do_upload('imageTtd')){
                $gbr = $this->upload->data();
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image']='./images/ttd/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= true;
                // $config['quality']= '100%';
                $config['width']= 600;
                // $config['height']= 400;
                $config['new_image']= './images/ttd/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
 
                $gambar=$gbr['file_name'];

                return base_url('images/ttd/'.$gambar);
            }
                      
        }else{
            return base_url('images/ttd/default.png');
        }         
    }
}