<?php defined('BASEPATH') OR exit('No direct script access allowed');
// require APPPATH . '/libraries/REST_Controller.php';
use chriskacerguis\RestServer\RestController;

class User extends RestController {
    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->library(array('upload', 'image_lib'));
    }

    public function index_get(){
        
    }

    public function login_post(){
        $config = array(
            [
                'field'     => 'username',
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Username wajib diisi',
                ]
            ],
            [
                'field'     => 'password',
                'rules'     => 'required|min_length[8]',
                'errors'    => [
                    'required'      => 'Password wajib diisi',
                    'min_length'    => 'Password minimal 8 karakter'
                ]
            ],
            [
                'field'     => 'token',
                'rules'     => 'required',
                'errors'    => [
                    'required'      => 'Token wajib diisi',
                ]
            ]
        );

        $data = $this->input->post();
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()==FALSE){
            $this->response(['status' => false, 'message' => $this->form_validation->error_array()], 200);
        }else{
            $resLogin = $this->db->get_where(
                'USERS', 
                ['USER_USERS' => $data['username'], 'PASS_USERS' => hash('sha256', md5($data['password']))]
            )->result();

            if($resLogin != null){
                $this->db->where('USER_USERS', $data['username'])->update('USERS', ['LOGIN_USERS' => 1, 'TOKEN_USERS' => $data['token']]);
                $resLogin[0]->LOGIN_USERS = '1';
                $resLogin[0]->TOKEN_USERS = $data['token'];
                $this->response(['status' => true, 'message' => 'Data berhasil ditemukan' , 'data' => $resLogin[0]], 200);
            }else{
                $this->response(['status' => false, 'message' => 'Username atau password salah' ], 200);
            }
        }

    }

    public function logout_post(){
        $config = array(
            [
                'field'     => 'idUser',
                'rules'     => 'required',
                'errors'    => [
                    'required' => 'Id User wajib diisi',
                ]
            ]
        );

        $data = $this->input->post();
        $this->form_validation->set_rules($config);
        if($this->form_validation->run()==FALSE){
            $this->response(['status' => false, 'message' => $this->form_validation->error_array()], 200);
        }else{
            $this->db->where('ID_USERS', $data['idUser'])->update('USERS', ['LOGIN_USERS' => 0, 'TOKEN_USERS' => null]);
            $this->response(['status' => true, 'message' => 'Berhasil logout'], 200);
        }
    }

}
