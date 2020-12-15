<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timkurdtemodel extends CI_Model {

	public function getNumTim(){
		$number = $this->db->get('tbl_timkur')->num_rows();
		return $number;
	}

	public function getAll() {
		$this->db->select('*');
        $this->db->from('tbl_timkur');
        $this->db->order_by('tahun', 'ASC');
        $this->db->order_by('semester', 'ASC');
		$getAll = $this->db->get();
		return $getAll->result();
	}

	public function getByID($id) {
		$this->db->select('*');
        $this->db->from('tbl_timkur');
        $this->db->limit('1');
		$this->db->where('timkur_id', $id);
		$getTimKur = $this->db->get();
		return $getTimKur->result();
    }
    
    public function getNumAnggotaTim($id){
        $this->db->where('timkur_id', $id);
		$number = $this->db->get('tbl_anggotatimkur')->num_rows();
		return $number;
    }

	public function getAllAnggotaTim($id) {
		$this->db->select('*');
		$this->db->from('tbl_anggotatimkur');
		$this->db->join('tbl_timkur', 'tbl_anggotatimkur.timkur_id = tbl_timkur.timkur_id');
		$this->db->join('tbl_users', 'tbl_anggotatimkur.user_id = tbl_users.user_id');
		$this->db->where('tbl_anggotatimkur.timkur_id', $id);
        $this->db->order_by('tahun', 'ASC');
        $this->db->order_by('semester', 'ASC');
		$getAll = $this->db->get();
		return $getAll->result();
	}
}