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

			} else {
				redirect(base_url('dashboard/user'));
			}
			/*$data = [
				'title' => "D!Acreditation | Buat User Baru",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Buat User Baru',
				'alluser' => $this->usersmodel->getAll()	
			];
			$this->load->view('create_user', $data);*/
		} else {
			redirect(base_url('dashboard'));
		}
	}
}
