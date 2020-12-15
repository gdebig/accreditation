<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timpdcamodel extends CI_Model {

	public function getNumTim(){
		$number = $this->db->get('tbl_timpdca')->num_rows();
		return $number;
	}

	public function getAll() {
		$this->db->select('*');
        $this->db->from('tbl_timpdca');
        $this->db->order_by('tahun', 'ASC');
        $this->db->order_by('semester', 'ASC');
		$getAll = $this->db->get();
		return $getAll->result();
	}

	public function getByID($id) {
		$this->db->select('*');
        $this->db->from('tbl_timpdca');
        $this->db->limit('1');
		$this->db->where('timpdca_id', $id);
		$getTimKur = $this->db->get();
		return $getTimKur->result();
    }
    
    public function getNumAnggotaTim($id){
        $this->db->where('timpdca_id', $id);
		$number = $this->db->get('tbl_anggotatimpdca')->num_rows();
		return $number;
    }

	public function getAllAnggotaTim($id) {
		$this->db->select('*');
		$this->db->from('tbl_anggotatimpdca');
		$this->db->join('tbl_timpdca', 'tbl_anggotatimpdca.timpdca_id = tbl_timpdca.timpdca_id');
		$this->db->join('tbl_users', 'tbl_anggotatimpdca.user_id = tbl_users.user_id');
		$this->db->where('tbl_anggotatimpdca.timpdca_id', $id);
        $this->db->order_by('tahun', 'ASC');
        $this->db->order_by('semester', 'ASC');
		$getAll = $this->db->get();
		return $getAll->result();
	}
}