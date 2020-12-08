<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
        $this->load->model('usersmodel');
    }

	public function index()
	{
        if($this->session->userdata('login')==true){
            redirect(base_url('welcome'));
        }
        $data['title'] = "D!Acreditation - Login";
		$this->load->view('login', $data);
	}

	public function dologin(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = [
			'username' => $username,
			'password' => $password
		];
		$dologin = $this->usersmodel->login($data);
        //var_dump($dologin);
		$logged_in = $dologin->row();
		if($dologin->num_rows() > 0) {
			// $data_session = [
				// 'username' => $username,
				// 'name' => $logged_in->name,
				// 'role' => $logged_in->role,
				// 'email' => $logged_in->email,
				// 'login' => true
			// ];
			$data_session = array();
			$data_session['id'] = $logged_in->user_id;
			$data_session['username'] = $username;
			$data_session['name'] = $logged_in->name;
			$data_session['email'] = $logged_in->email;
			$data_session['NIP'] = $logged_in->NIP;
			$data_session['login_SSO'] = $logged_in->login_SSO;
			$data_session['role'] = $logged_in->role;
			$data_session['status'] = $logged_in->status;	
			$data_session['login'] = true;
            $this->session->set_userdata($data_session);
        }

        if($this->input->post('remember_me')) {
          $this->load->helper('cookie');
          $cookie = $this->input->cookie('ci_session');
          $this->input->set_cookie('ci_session', $cookie, '31557600');
			echo json_encode(['success' => true]);
		}else{
			echo json_encode(['success' => false]);
        }
        
        redirect(base_url());
    }
    
	public function logout() {
		if($this->session->role_SSO!=''){
			$this->session->sess_destroy();
			$this->load->library('cas');
			$this->cas->logout(base_url());
		}else{
			$this->session->sess_destroy();
			redirect(base_url('login'));
		}
	}

	public function sso(){
		$ref=base_url('dashboard');
		if($this->input->get('ref')!==null){
			$ref=urldecode($this->input->get('ref'));
		}
		
    	$this->load->library('cas');
    	$this->cas->force_auth();
	
		$user = $this->cas->user();
		$u = $user->attributes;
		$u['username'] = $user->userlogin;
		$x = $this->usersmodel->getOrInsert( $u );
		$v = array();
		$v['id'] = $x->id;
		$v['username'] = $x->username;
		$v['name'] = $x->name;
		$v['email'] = $x->email;
		$v['login_SSO'] = $x->login_SSO;
		$v['role'] = $x->role;
		$v['status'] = $x->status;
		$v['login'] = true;
		$this->session->set_userdata($v);
		if($this->session->userdata('login') == true) {
			redirect('dashboard');
		}
	}

	public function gantiPass()
	{
        $data = [
            'title' => "D!Acreditation | Ganti Password",
			'name' => $this->session->userdata('name'),
			'login_SSO' => $this->session->userdata('login_SSO'),
            'page' => 'Ganti Password'

        ];
		$this->load->view('ganti_pass', $data);
	}

	public function doGantiPass()
	{
		$aksi = $this->input->post("aksi");
		if ($aksi == "batal"){
			redirect('dashboard');
		} else {
			$this->load->library('form_validation');

			$this->form_validation->set_rules('oldpassword', 'Password Lama', 'required|callback_password_check',
						array('required' => 'Field %s tidak boleh kosong'));
			$this->form_validation->set_rules('newpass', 'Password Baru', 'required|min_length[8]',
						array('required' => 'Field %s tidak boleh kosong', 'min_length' => 'Jumlah karakter minimal 8'));
			$this->form_validation->set_rules('confnewpass', 'Confirm Password Baru', 'required|matches[newpass]',
						array('required' => 'Field %s tidak boleh kosong', 'matches' => 'Isi harus sama dengan Field Password Baru'));

			if ($this->form_validation->run() == FALSE){
				$data = [
					'title' => "D!Acreditation | Ganti Password",
					'name' => $this->session->userdata('name'),
					'login_SSO' => $this->session->userdata('login_SSO'),
					'page' => 'Ganti Password',
					'status' => 'gagal'
				];
				$this->load->view('ganti_pass_err', $data);
			} else {
				$password = $this->input->post('newpass');
				$username = $this->session->userdata('username');
				$data = array(
					'password' => md5($password)
				);
				$this->db->where('username', $username);
				$this->db->update('tbl_users', $data);
				
				$data = [
					'title' => "D!Acreditation | Ganti Password",
					'name' => $this->session->userdata('name'),
					'login_SSO' => $this->session->userdata('login_SSO'),
					'page' => 'Ganti Password',
					'status' => 'sukses'
				];
				$this->load->view('ganti_pass_err', $data);
			}
		}
	}

	public function password_check($str){
		$username = $this->session->userdata('username');
		$res = $this->usersmodel->checkPassword($username, $str);

		if ($res <= 0){
			$this->form_validation->set_message('password_check', 'Password lama tidak sesuai');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	public function profile()
	{	
		$username = $this->session->userdata('username');	
		$datauser = $this->usersmodel->byUserName($username);
        $data = [
            'title' => "D!Acreditation | Profile",
			'name' => $this->session->userdata('name'),
			'login_SSO' => $this->session->userdata('login_SSO'),
			'datauser' => $datauser,
            'page' => 'Profile'

        ];

		foreach($datauser as $u){
			$data['namalengkap'] = $u->name;
			$data['gelar_depan'] = $u->gelar_depan;
			$data['gelar_belakang'] = $u->gelar_belakang;
			$data['NIP'] = $u->NIP;
			$data['username'] = $u->username;
			$data['email'] = $u->email;
			$data['no_HP'] = $u->no_HP;
			$data['prodi'] = $u->prodi;
		}
		$this->load->view('profile', $data);
	}

	public function doUpdateProfile(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'valid_email',
						array('valid_email' => 'Isian %s tidak memenuhi format email yang valid'));

		if ($this->form_validation->run() == FALSE){
			$data = [
				'title' => "D!Acreditation | Profile",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Profile',
				'status' => 'gagal'
			];
			$this->load->view('profile_err', $data);
		} else {
			$namalengkap = $this->input->post('namalengkap');
			$gelar_depan = $this->input->post('gelardepan');
			$gelar_belakang = $this->input->post('gelarbelakang');
			$nip = $this->input->post('nip');
			$email = $this->input->post('email');
			$no_HP = $this->input->post('nohp');
			$prodi = $this->input->post('prodi');
			$username = $this->session->userdata('username');
			$datauser = array(
				'name' => $namalengkap,
				'gelar_depan' => $gelar_depan,
				'gelar_belakang' => $gelar_belakang,
				'NIP' => $nip,
				'email' => $email,
				'no_HP' => $no_HP,
				'prodi' => $prodi,
				'date_modified' => date("Y-m-d h:i:s")
			);
			$this->db->where('username', $username);
			$this->db->update('tbl_users', $datauser);

			$data = [
				'title' => "D!Acreditation | Profile",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Profile',
				'status' => 'sukses'
			];
			$this->load->view('profile_err', $data);
		}
	}
}
