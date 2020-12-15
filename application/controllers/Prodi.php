<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {

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
		$this->load->model('usersmodel');
		$this->load->model('prodimodel');
		if ($this->usersmodel->checkAdmin()){
			$data = [
				'title' => "D!Acreditation | Pengaturan Kode Program Studi",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Pengaturan Kode Program Studi'
			];

			$number = $this->prodimodel->getNumProdi();
			if ($number <= 0){
				$data['allprodi'] = "kosong";
			} else {
				$data['allprodi'] = $this->prodimodel->getAll();
			}

			$this->load->view('view_prodi', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function create(){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$data = [
				'title' => "D!Acreditation | Form Membuat Kode Prodi",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Form Membuat Kode Prodi'
			];

			$this->load->view('create_prodi', $data);
		} else {
			redirect(base_url('dashboard'));
		}		
	}

	public function docreate(){		
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$btn = $this->input->post('btncreate');
			if ($btn == "buat"){

				$this->load->library('form_validation');
	
				$this->form_validation->set_rules('kodeprodi', 'Kode Prodi', 'required',
							array('required' => 'Field %s tidak boleh kosong'));

				if ($this->form_validation->run() == FALSE){
					$data = [
						'title' => "D!Acreditation | Form Membuat Kode Prodi",
						'name' => $this->session->userdata('name'),
						'login_SSO' => $this->session->userdata('login_SSO'),
						'page' => 'Form Membuat Kode Prodi',
						'status' => 'gagal'	
					];
		
					$this->load->view('create_prodi_err', $data);
				} else {
					$prodi = $this->input->post('prodi');
					$jenjang = $this->input->post('inputJenjang');
					$kodeprodi = $this->input->post('kodeprodi');
	
					$data = array(
						'nama' => $prodi,
						'jenjang' => $jenjang,
						'kode_prodi' => $kodeprodi,
						'date_created' => date("Y-m-d h:i:s"),
						'date_modified' => date("Y-m-d h:i:s")
					);
					$this->db->insert('tbl_prodi', $data);
					redirect(base_url('prodi'));

				}

			} else {
				redirect(base_url('prodi'));
			}
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function hapus($id){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$this->db->where('prodi_id', $id);
			$this->db->delete('tbl_prodi');
			redirect(base_url('prodi'));
		} else {
			redirect(base_url('dashboard'));
		}
	}
}
