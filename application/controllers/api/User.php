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
        $data = $this->input->post();
        if(!empty($data['username']) && !empty($data['password'])){
            $checkData = $this->db->get_where('USERS', ['USER_USERS' => $data['username']])->result();
            if($checkData != null){
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
            }else{
                $this->response(['status' => false, 'message' => 'Data user tidak ditemukan' ], 200);
            }
        }else{
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok' ], 200);
        }
    }

    public function logout_post(){
        $data = $this->input->post();
        if(!empty($data['idUser'])){
            $checkData = $this->db->get_where('USERS', ['ID_USERS' => $data['idUser']])->result();
            if($checkData != null){
                $this->db->where('ID_USERS', $data['idUser'])->update('USERS', ['LOGIN_USERS' => 0, 'TOKEN_USERS' => null]);
                $this->response(['status' => true, 'message' => 'Berhasil logout'], 200);
            }else{
                $this->response(['status' => false, 'message' => 'Id User tidak ditemukan'], 200);
            }
        }else{
            $this->response(['status' => false, 'message' => 'Parameter tidak cocok'], 200); 
        }
    }

}
