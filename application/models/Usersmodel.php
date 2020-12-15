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
		$this->db->order_by('name', 'ASC');
		$getAll = $this->db->get('tbl_users');
		return $getAll->result();
	}

	public function checkUsername($username) {
		$checkUsername = $this->db->get_where('tbl_users', ['username' => $username])->num_rows();
		return $checkUsername;
	}

	public function checkPassword($username, $password){
		$checkPassword = $this->db->get_where('tbl_users', ['username' => $username, 'password' => md5($password)])->num_rows();
		return $checkPassword;
	}

	public function byId($id) {
		$byId = $this->db->get_where('tbl_users', ['user_id' => $id]);
		return $byId->result();
	}

	public function byUserName($username){
		$res = $this->db->limit(1)->where('username',$username)->get('tbl_users')->result();
		return $res;
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

	public function checkAdmin(){
		$role = $this->session->userdata('role');
		if ($role[0] == "1"){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkTimKurikulum(){
		$role = $this->session->userdata('role');
		if ($role[1] == "1"){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkManProdi(){
		$role = $this->session->userdata('role');
		if ($role[2] == "1"){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkKoordintaro(){
		$role = $this->session->userdata('role');
		if ($role[3] == "1"){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkPengajar(){
		$role = $this->session->userdata('role');
		if ($role[4] == "1"){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkPeer(){
		$role = $this->session->userdata('role');
		if ($role[5] == "1"){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkPDCA(){
		$role = $this->session->userdata('role');
		if ($role[6] == "1"){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function updateRole($id, $man){
		$this->db->select('role');
		$this->db->from('tbl_users');
		$this->db->limit('1');
		$this->db->where('user_id', $id);
		$role = get_object_vars($this->db->get()->row());

		if ($man == "manajemen"){
			$role = substr_replace($role, '1', 2, 1);
		}
		if ($man == "nonman"){
			$role = substr_replace($role, '0', 2, 1);
		}
		if ($man == "timkur"){
			$role = substr_replace($role, '1', 1, 1);			
		}
		if ($man == "nontimkur"){
			$role = substr_replace($role, '0', 1, 1);			
		}
		if ($man == "timpdca"){
			$role = substr_replace($role, '1', 6, 1);			
		}
		if ($man == "nontimpdca"){
			$role = substr_replace($role, '0', 6, 1);			
		}
		
		$data = array(
			'role' => implode($role)
		);
		$this->db->where('user_id', $id);
		$this->db->update('tbl_users', $data);
	}
}