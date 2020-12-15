<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mandte extends CI_Model {

	public function getNumMan(){
		$number = $this->db->get('tbl_man')->num_rows();
		return $number;
	}

	public function getAll() {
		$this->db->select('*');
		$this->db->from('tbl_man');
		$this->db->join('tbl_users', 'tbl_man.user_id = tbl_users.user_id');
		$this->db->order_by('man_id', 'ASC');
		$getAll = $this->db->get();
		return $getAll->result();
	}

	public function getByID($id) {
		$this->db->select('*');
		$this->db->from('tbl_man');
		$this->db->join('tbl_users', 'tbl_man.user_id = tbl_users.user_id');
		$this->db->where('tbl_man.man_id', $id);
		$this->db->order_by('man_id', 'ASC');
		$getMan = $this->db->get();
		return $getMan->result();
	}
}