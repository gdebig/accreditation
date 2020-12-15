<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodimodel extends CI_Model {

	public function getNumProdi(){
		$number = $this->db->get('tbl_prodi')->num_rows();
		return $number;
	}

	public function getAll() {
		$this->db->select('*');
		$this->db->from('tbl_prodi');
		$this->db->order_by('kode_prodi', 'ASC');
		$getAll = $this->db->get();
		return $getAll->result();
	}

	public function getByID($id) {
		$this->db->select('*');
		$this->db->from('tbl_prodi');
		$this->db->join('tbl_users', 'tbl_man.user_id = tbl_users.user_id');
		$this->db->where('tbl_man.man_id', $id);
		$this->db->order_by('man_id', 'ASC');
		$getMan = $this->db->get();
		return $getMan->result();
	}
}