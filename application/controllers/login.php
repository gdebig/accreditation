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
}
