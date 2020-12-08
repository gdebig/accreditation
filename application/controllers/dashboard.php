<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('login')!==true) redirect(base_url('login'));
	}
	public function index()
	{
        $data = [
            'title' => "D!Acreditation | Dashboard",
			'name' => $this->session->userdata('name'),
			'login_SSO' => $this->session->userdata('login_SSO'),
            'page' => 'Dashboard'

        ];
		$this->load->view('page_view', $data);
	}
	
	public function user()
	{
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$data = [
				'title' => "D!Acreditation | Manajemen User",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Manajemen User',
				'alluser' => $this->usersmodel->getAll()	
			];
			$this->load->view('manuser', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}
	
	public function createuser()
	{
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$data = [
				'title' => "D!Acreditation | Buat User Baru",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Buat User Baru',
				'alluser' => $this->usersmodel->getAll()	
			];
			$this->load->view('create_user', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}
	
	public function docreateuser()
	{
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$btncreate = $this->input->post("btncreate");
			if ($btncreate == "buat"){
				$this->load->library('form_validation');
	
				$this->form_validation->set_rules('namalengkap', 'Nama Lengkap', 'required',
							array('required' => 'Field %s tidak boleh kosong'));
				$this->form_validation->set_rules('email', 'Email (Username)', 'required|valid_email|callback_username_check',
							array('required' => 'Field %s tidak boleh kosong', 'valid_email' => 'Field %s tidak memenuhi format email yang valid'));
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]',
							array('required' => 'Field %s tidak boleh kosong', 'min_length' => 'Jumlah karakter minimal 8'));
	
				if ($this->form_validation->run() == FALSE){
					$data = [
						'title' => "D!Acreditation | Buat User Baru",
						'name' => $this->session->userdata('name'),
						'login_SSO' => $this->session->userdata('login_SSO'),
						'page' => 'Buat User Baru',
						'status' => 'gagal'	
					];
					$this->load->view('create_user_err', $data);
				} else {
					$namalengkap = $this->input->post('namalengkap');
					$gelardepan = $this->input->post('gelardepan');
					$gelarbelakang = $this->input->post('gelarbelakang');
					$nip = $this->input->post('nip');
					$username = $this->input->post('email');
					$email = $this->input->post('email');
					$password = $this->input->post('password');
					$nohp = $this->input->post('nohp');
					$prodi = $this->input->post('prodi');

					$role0 = strval($this->input->post('role0'));
					$role1 = strval($this->input->post('role1'));
					$role2 = strval($this->input->post('role2'));
					$role3 = strval($this->input->post('role3'));
					$role4 = strval($this->input->post('role4'));
					$role5 = strval($this->input->post('role5'));
					$role6 = strval($this->input->post('role6'));

					$role = $role0.$role1.$role2.$role3.$role4.$role5.$role6;

					$data = array(
						'name' => $namalengkap,
						'gelar_depan' => $gelardepan,
						'gelar_belakang' => $gelarbelakang,
						'NIP' => $nip,
						'username' => $username,
						'email' => $email,
						'password' => md5($password),
						'no_HP' => $nohp,
						'status' => 'new',
						'prodi' => $prodi,
						'login_SSO' => 'no',
						'role' => $role,
						'non_DTE' => "0",
						'pensiun' => "0",
						'date_created' => date("Y-m-d h:i:s"),
						'date_modified' => date("Y-m-d h:i:s")
					);

					$this->db->insert('tbl_users', $data);
					redirect(base_url('dashboard/user'));
				}
			} else {
				redirect(base_url('dashboard/user'));
			}
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function username_check($str){
		$this->load->model('usersmodel');
		$res = $this->usersmodel->checkUsername($str);

		if ($res >= 1){
			$this->form_validation->set_message('username_check', 'Username sudah ada yang menggunakan. Ganti username yang lain.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function hapususer($id){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$this->db->where('user_id', $id);
			$this->db->delete('tbl_users');
			redirect(base_url('dashboard/user'));
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function ubahuser($id){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$datauser = $this->usersmodel->byId($id);
			$data = [
				'title' => "D!Acreditation | Ubah User",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Ubah User'
			];

			foreach ($datauser as $a){
				$data['user_id'] = $a->user_id;
				$data['name'] = $a->name;
				$data['gelardepan'] = $a->gelar_depan;
				$data['gelarbelakang'] = $a->gelar_belakang;
				$data['nip'] = $a->NIP;
				$data['username'] = $a->username;
				$data['email'] = $a->email;
				$data['nohp'] = $a->no_HP;
				$data['role'] = $a->role;
				$data['prodi'] = $a->prodi;
			}
			$this->load->view('ubah_user', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}
	
	public function doubahuser()
	{
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$btncreate = $this->input->post("btncreate");
			if ($btncreate == "ubah"){
				$this->load->library('form_validation');

				$this->form_validation->set_rules('password', 'Password', 'callback_notempty_password');
	
				if ($this->form_validation->run() == FALSE){
					$user_id = $this->input->post('user_id');
					$datauser = $this->usersmodel->byId($user_id);
					$data = [
						'title' => "D!Acreditation | Ubah User",
						'name' => $this->session->userdata('name'),
						'login_SSO' => $this->session->userdata('login_SSO'),
						'page' => 'Ubah User',
						'status' => 'gagal'	
					];

					foreach ($datauser as $a){
						$data['username'] = $a->username;
					}
					$this->load->view('ubah_user_err', $data);
				} else {
					$user_id = $this->input->post('user_id');
					$namalengkap = $this->input->post('namalengkap');
					$gelardepan = $this->input->post('gelardepan');
					$gelarbelakang = $this->input->post('gelarbelakang');
					$nip = $this->input->post('nip');
					$password = $this->input->post('password');
					$nohp = $this->input->post('nohp');
					$prodi = $this->input->post('prodi');

					$role0 = strval($this->input->post('role0'));
					$role1 = strval($this->input->post('role1'));
					$role2 = strval($this->input->post('role2'));
					$role3 = strval($this->input->post('role3'));
					$role4 = strval($this->input->post('role4'));
					$role5 = strval($this->input->post('role5'));
					$role6 = strval($this->input->post('role6'));

					$role = $role0.$role1.$role2.$role3.$role4.$role5.$role6;

					if (!empty($password)){

						$data = array(
							'name' => $namalengkap,
							'gelar_depan' => $gelardepan,
							'gelar_belakang' => $gelarbelakang,
							'NIP' => $nip,
							'password' => md5($password),
							'no_HP' => $nohp,
							'status' => 'new',
							'prodi' => $prodi,
							'login_SSO' => 'no',
							'role' => $role,
							'non_DTE' => "0",
							'pensiun' => "0",
							'date_modified' => date("Y-m-d h:i:s")
						);

					} else {

						$data = array(
							'name' => $namalengkap,
							'gelar_depan' => $gelardepan,
							'gelar_belakang' => $gelarbelakang,
							'NIP' => $nip,
							'no_HP' => $nohp,
							'status' => 'new',
							'prodi' => $prodi,
							'login_SSO' => 'no',
							'role' => $role,
							'non_DTE' => "0",
							'date_modified' => date("Y-m-d h:i:s")
						);

					}
					$this->db->where('user_id', $user_id);
					$this->db->update('tbl_users', $data);
					redirect(base_url('dashboard/user'));
				}
			} else {
				redirect(base_url('dashboard/user'));
			}
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function notempty_password($str){
		if (empty($str)){
			return TRUE;
		} elseif (strlen($str) < 8){
			$this->form_validation->set_message('notempty_password', 'Password minimal 8 karakter');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
