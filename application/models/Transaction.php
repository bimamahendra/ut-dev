<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function getAll(){
        $res = $this->db->get('V_TRANSACTION')->result();
        return $res;
    }
    public function get($param){
        $filter = !empty($param['filter'])? $param['filter'] : '';
        $res    = $this->db->get_where('V_TRANSACTION', $filter)->result();
        return $res;
    }
    public function insert($param){
        $this->db->insert('TRANSACTION', $param);
        return $this->db->insert_id();
    }
    public function update($param){
        $this->db->where('ID_TRANS', $param['ID_TRANS'])->update('TRANSACTION', $param);
        return true;
    }
    public function delete($param){
        $this->db->where($param)->delete('TRANSACTION');
        return true;
    }
}