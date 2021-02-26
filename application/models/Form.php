<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function getAll(){
        $res = $this->db->get('MAPPING')->result();
        return $res;
    }
    public function get($param){
        $filter = !empty($param['filter'])? $param['filter'] : '';
        $res    = $this->db->get_where('MAPPING', $filter)->result();
        return $res;
    }
    public function getTables(){
        $res = $this->db->query("SELECT table_name FROM information_schema.tables WHERE table_type = 'base table' AND table_schema='ut_dev' AND table_name REGEXP 'form.*'")->result();
        return $res;
    }
    public function insert($param){
        $this->db->insert('MAPPING', $param);
        return $this->db->insert_id();
    }
    public function update($param){
        $this->db->where('ID_MAPPING', $param['ID_MAPPING'])->update('MAPPING', $param);
        return true;
    }
    public function delete($param){
        $this->db->where($param)->delete('MAPPING');
        return true;
    }
    public function getFlowAll(){
        $res = $this->db->get('V_FLOW')->result();
        return $res;
    }
    public function getFlow($param){
        $filter = !empty($param['filter'])? $param['filter'] : '';
        $res    = $this->db->get_where('V_FLOW', $filter)->result();
        return $res;
    }
    public function insertFlow($param){
        $this->db->insert('FLOW', $param);
        return $this->db->insert_id();
    }
    public function updateFlow($param){
        $this->db->where('ID_FLOW', $param['ID_FLOW'])->update('FLOW', $param);
        return true;
    }
    public function deleteFlow($param){        
        $this->db->set($param['APP'], null);
        $this->db->where('ID_FLOW', $param['ID_FLOW']);
        $this->db->update('FLOW');

        return true;
    }
    public function editFlow($param){        
        $this->db->set($param['APP'], $param['ROLE']);
        $this->db->where('ID_FLOW', $param['ID_FLOW']);
        $this->db->update('FLOW');

        return true;
    }
}