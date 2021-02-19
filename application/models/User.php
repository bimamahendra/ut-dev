<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function getAll(){
        $res = $this->db->get('USERS')->result();
        return $res;
    }
    public function get($param){
        $filter = !empty($param['filter'])? $param['filter'] : '';
        $res    = $this->db->get_where('USERS', $filter)->result();
        return $res;
    }
    public function insert($param){
        $this->db->insert('USERS', $param);
        return $this->db->insert_id();
    }
    public function update($param){
        $this->db->where('ID_USERS', $param['ID_USERS'])->update('USERS', $param);
        return true;
    }
    public function delete($param){
        $this->db->where($param)->delete('USERS');
        return true;
    }
}