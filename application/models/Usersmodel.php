<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usersmodel extends CI_Model {
	public function login($data) {
		$username = $data['username'];
		$password = md5($data['password']);
		$dologin = $this->db->query("select * from tbl_users where username = '$username' and password = '$password' and password != '' and password is not null and status = 'active'");
		// $t = "select * from users where username = '$username' and password = '$password' and status = 'active' ".$data['password'];
		// die($t);
		// $dologin = $this->db->query("select * from users where username = '$username' and password = '$password' and status = 'active'");
		return $dologin;
	}

	public function register($data) {
		$doregister = $this->db->insert('tbl_users', $data);
		$user = $this->db->get_where('tbl_users', ['id' => $this->db->insert_id()]);
		return $user;
	}

	public function getAll() {
		$getAll = $this->db->get('tbl_users');
		return $getAll->result();
	}

	public function checkUsername($username) {
		$checkUsername = $this->db->get_where('tbl_users', ['username' => $username])->num_rows();
		return $checkUsername;
	}

	public function byId($id) {
		$byId = $this->db->get_where('tbl_users', ['id' => $id]);
		return $byId->row();
	}

	public function byUserName($username){
		$res = $this->db->limit(1)->where('username',$u['username'])->get('tbl_users')->result();
		return $res;
	}

	public function update($data, $id) {
		$this->db->set($data);
		$this->db->where('id', $id);
		$update = $this->db->update('tbl_users');
		return $update;
	}

	public function delete($id) {
		$this->db->where('id', $id);
		$delete = $this->db->delete('tbl_users');
		return $delete;
	}
	public function getOrInsert($u){
		$res = $this->db->limit(1)->where('username',$u['username'])->get('tbl_users')->result();
		if ( count($res) == 0 ){ // if not exist, create one
			if(!isset($u['peran_user'])){echo 'Maaf, ada yang aneh dengan akun SSO Anda. Silakan hubungi Admin.<br><br><pre>';var_dump($u);die();}
			$role = $u['peran_user'] == 'staff' ? 'dosen' : 'mahasiswa';
			$data = array();
			$data['NIP'] = $u['nip'];
			$data['username'] = $u['username'];
			$data['name'] = $u['nama'];
			$data['email'] = $u['username'].'@ui.ac.id';
			$data['login_SSO'] = 'yes';
			$data['status'] = 'new';
			$data['date_created'] = date('Y-m-d h:i:s');
			/*
			Bit role:
			1. Admin
			2. Tim Kurikulum
			3. Manajemen Prodi
			4. Dosen Koordinator
			5. Dosen Pengajar
			6. Dosen Peer
			7. Tim PDCA
			*/
			$data['role'] = '0000100';
			$this->db->insert('tbl_users', $data);
			$res = $this->db->limit(1)->where('username',$u['username'])->get('tbl_users')->result();
			// $data['id'] = $this->db->insert_id();
			// $res[0]=$data;
		}
		// echo '<pre>';print_r($res[0]);die();
		return $res[0];
	}
	public function byNameOrMail($k){
		$s = "SELECT id,name,email FROM users WHERE (name LIKE '%$k%' OR email LIKE '%$k%') ORDER BY name ASC";
		$r = $this->db->query($s);
		$list = array();
		$key=0;
		foreach($r->result() as $e){
			$list[$key]['id'] = $e->id;
			$list[$key]['text'] = $e->name.' ('.$e->email.')'; 
			$key++;
		}
		echo json_encode($list);
	}
	public function byMeeting($k){ //get invited users in a meeting
		$s = "SELECT user as id,name,email FROM meeting_participants WHERE name !='' AND meeting = $k 
			UNION SELECT p.user as id, u.name,u.email FROM meeting_participants p JOIN users u ON u.id=p.user WHERE p.meeting = $k 
			ORDER BY name ASC";
		$r = $this->db->query($s);
		$list = array();
		$key=0;
		foreach($r->result() as $e){
			$list[$key]['id'] = $e->id==0 ? $e->name : $e->id;
			$list[$key]['text'] = $e->email=='' ? $e->name : $e->name.' ('.$e->email.')'; 
			$key++;
		}
		echo json_encode($list);
	}
	public function byMeeting2($k){ //get invited users in a meeting
		$s = "SELECT meeting_participants.id, user as uid,name,email,status FROM meeting_participants WHERE name !='' AND meeting = $k
			UNION SELECT p.id,p.user as uid, u.name,u.email,p.status FROM meeting_participants p JOIN users u ON u.id=p.user WHERE p.meeting = $k 
			ORDER BY name ASC;";
		return $this->db->query($s)->result();
	}
	public function getByJabatan($jabatan){ //jabatan from table user_jabatan
		return $this->db->query("SELECT id, name, trim(concat(gelar_depan, ' ', name, ', ', gelar_belakang)) fullname, email from users where id=(SELECT user from user_jabatan where jabatan='$jabatan')")->row();
	}
	public function getById($id){
		return $this->db->query("SELECT name, email, trim(concat(gelar_depan, ' ', name, ', ', gelar_belakang)) fullname, no_HP from users where id=$id")->row();
	}
}