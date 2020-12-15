<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen extends CI_Controller {

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
	
	//Modul Pengaturan Manajemen
	public function index()
	{
		$this->load->model('usersmodel');
		$this->load->model('mandte');
		if ($this->usersmodel->checkAdmin()){
			$data = [
				'title' => "D!Acreditation | Pengaturan Manajemen DTE",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Pengaturan Manajemen DTE'
			];

			$number = $this->mandte->getNumMan();
			if ($number <= 0){
				$data['allman'] = "kosong";
			} else {
				$data['allman'] = $this->mandte->getAll();
			}

			$this->load->view('view_mandte', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function createman(){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$data = [
				'title' => "D!Acreditation | Form Menambah Manajemen DTE",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Form Menambah Manajemen DTE',
				'alluser' => $this->usersmodel->getAll()
			];

			$this->load->view('create_mandte', $data);
		} else {
			redirect(base_url('dashboard'));
		}		
	}

	public function docreatemandte(){		
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$btn = $this->input->post('btncreate');
			if ($btn == "buat"){
				$title = $this->input->post('inputJabatan');
				$prodi = $this->input->post('prodi');
				$staff = $this->input->post('inputStaff');

				$data = array(
					'title' => $title,
					'prodi' => $prodi,
					'user_id' => $staff,
					'date_created' => date("Y-m-d h:i:s"),
					'date_modified' => date("Y-m-d h:i:s")
				);
				$this->db->insert('tbl_man', $data);
				$this->usersmodel->updateRole($staff, 'manajemen');
				redirect(base_url('manajemen'));

			} else {
				redirect(base_url('manajemen'));
			}
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function hapus($man_id, $user_id){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin()){
			$this->db->where('man_id', $man_id);
			$this->db->delete('tbl_man');
			$this->usersmodel->updateRole($user_id, 'nonman');
			redirect(base_url('manajemen'));
		} else {
			redirect(base_url('dashboard'));
		}
	}

	//Modul Manajemen Tim Kurikulum
	public function timkurikulum(){
		$this->load->model('usersmodel');
		$this->load->model('timkurdtemodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$data = [
				'title' => "D!Acreditation | Tim Kurikulum DTE",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Tim Kurikulum DTE'
			];

			$number = $this->timkurdtemodel->getNumTim();
			if ($number <= 0){
				$data['alltimkur'] = "kosong";
			} else {
				$data['alltimkur'] = $this->timkurdtemodel->getAll();
			}

			$this->load->view('view_mantimkur', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function createtimkur(){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$data = [
				'title' => "D!Acreditation | Form Membuat Tim Kurikulum",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Form Membuat Tim Kurikulum'
			];

			$this->load->view('create_timkur', $data);
		} else {
			redirect(base_url('dashboard'));
		}		
	}

	public function docreatetimkur(){		
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$btn = $this->input->post('btncreate');
			if ($btn == "buat"){

				$this->load->library('form_validation');
	
				$this->form_validation->set_rules('inputNamaTim', 'Nama Tim', 'required',
							array('required' => 'Field %s tidak boleh kosong'));	
				$this->form_validation->set_rules('inputTahun', 'Tahun', 'required',
							array('required' => 'Field %s tidak boleh kosong'));

				if ($this->form_validation->run() == FALSE){
					$data = [
						'title' => "D!Acreditation | Form Membuat Tim Kurikulum",
						'name' => $this->session->userdata('name'),
						'login_SSO' => $this->session->userdata('login_SSO'),
						'page' => 'Form Membuat Tim Kurikulum',
						'status' => 'gagal'
					];
		
					$this->load->view('create_timkur_err', $data);
				} else {
					$namatim = $this->input->post('inputNamaTim');
					$tahun = $this->input->post('inputTahun');
					$semester = $this->input->post('inputSemester');
					$status = $this->input->post('inputStatus');

					$data = array(
						'nama_tim' => $namatim,
						'tahun' => $tahun,
						'semester' => $semester,
						'status' => $status,
						'date_created' => date("Y-m-d h:i:s"),
						'date_modified' => date("Y-m-d h:i:s")

					);
					$this->db->insert('tbl_timkur', $data);
					redirect(base_url('manajemen/timkurikulum'));
				}
			} else {
				redirect(base_url('manajemen/timkurikulum'));
			}
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function hapustimkur($id){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$this->db->where('timkur_id', $id);
			$this->db->delete('tbl_timkur');
			//$this->usersmodel->updateRole($user_id, 'nonman');
			redirect(base_url('manajemen/timkurikulum'));
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function ubahtimkur($id){
		$this->load->model('usersmodel');
		$this->load->model('timkurdtemodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$timkur = $this->timkurdtemodel->getByID($id);
			$data = [
				'title' => "D!Acreditation | Form Mengubah Tim Kurikulum",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Form Mengubah Tim Kurikulum'
			];

			foreach ($timkur as $t){
				$data['timkur_id'] = $t->timkur_id;
				$data['namatim'] = $t->nama_tim;
				$data['tahun'] = $t->tahun;
				$data['semester'] = $t->semester;
				$data['status'] = $t->status;
			}

			$this->load->view('ubah_timkur', $data);
		} else {
			redirect(base_url('dashboard'));
		}		
	}

	public function doubahtimkur(){		
		$this->load->model('usersmodel');
		$this->load->model('timkurdtemodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$btn = $this->input->post('btncreate');
			$timkur_id = $this->input->post('timkur_id');
			if ($btn == "buat"){

				$this->load->library('form_validation');
	
				$this->form_validation->set_rules('inputNamaTim', 'Nama Tim', 'required',
							array('required' => 'Field %s tidak boleh kosong'));	
				$this->form_validation->set_rules('inputTahun', 'Tahun', 'required',
							array('required' => 'Field %s tidak boleh kosong'));

				if ($this->form_validation->run() == FALSE){
					$data = [
						'title' => "D!Acreditation | Form Mengubah Tim Kurikulum",
						'name' => $this->session->userdata('name'),
						'login_SSO' => $this->session->userdata('login_SSO'),
						'page' => 'Form Mengubah Tim Kurikulum',
						'timkur_id' => $timkur_id,
						'status' => 'gagal'
					];
		
					$this->load->view('ubah_timkur_err', $data);
				} else {
					$timkur_id = $this->input->post('timkur_id');
					$namatim = $this->input->post('inputNamaTim');
					$tahun = $this->input->post('inputTahun');
					$semester = $this->input->post('inputSemester');
					$status = $this->input->post('inputStatus');

					$data = array(
						'nama_tim' => $namatim,
						'tahun' => $tahun,
						'semester' => $semester,
						'status' => $status,
						'date_created' => date("Y-m-d h:i:s"),
						'date_modified' => date("Y-m-d h:i:s")

					);
					$this->db->where('timkur_id', $timkur_id);
					$this->db->update('tbl_timkur', $data);
					redirect(base_url('manajemen/timkurikulum'));
				}
			} else {
				redirect(base_url('manajemen/timkurikulum'));
			}
		} else {
			redirect(base_url('dashboard'));
		}
	}

	//Modul anggota tim kurikulum
	public function anggotatimkur($id){
		$this->load->model('usersmodel');
		$this->load->model('timkurdtemodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$data = [
				'title' => "D!Acreditation | Anggota Tim Kurikulum DTE",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'timkur_id' => $id,
				'page' => 'Anggota Tim Kurikulum DTE'
			];

			$number = $this->timkurdtemodel->getNumAnggotaTim($id);
			if ($number <= 0){
				$data['anggotatimkur'] = "kosong";
			} else {
				$data['anggotatimkur'] = $this->timkurdtemodel->getAllAnggotaTim($id);
			}

			$this->load->view('view_anggotatimkur', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function createanggotatimkur($id){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$data = [
				'title' => "D!Acreditation | Form Menambah Anggota Tim Kurikulum",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Form Menambah Anggota Tim Kurikulum',
				'timkur_id' => $id,
				'alluser' => $this->usersmodel->getAll()
			];

			$this->load->view('create_anggotatimkur', $data);
		} else {
			redirect(base_url('dashboard'));
		}			
	}

	public function docreateanggotatimkur(){	
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$btn = $this->input->post('btncreate');
			$timkur_id = $this->input->post('timkur_id');
			if ($btn == "buat"){
				$staff = $this->input->post('inputStaff');
				$jabatan = $this->input->post('inputJabatan');

				$data = array(
					'timkur_id' => $timkur_id,
					'user_id' => $staff,
					'jabatan' => $jabatan,
					'date_created' => date("Y-m-d h:i:s"),
					'date_modified' => date("Y-m-d h:i:s")

				);
				$this->db->insert('tbl_anggotatimkur', $data);
				$this->usersmodel->updateRole($staff, 'timkur');
				redirect(base_url('manajemen/anggotatimkur/'.$timkur_id));
			} else {
				redirect(base_url('manajemen/anggotatimkur/'.$timkur_id));
			}
		} else {
			redirect(base_url('dashboard'));
		}		
	}

	public function hapusanggotatimkur($user_id, $timkur_id, $anggota_id){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$this->db->where('timkur_id', $timkur_id);
			$this->db->where('anggota_id', $anggota_id);
			$this->db->delete('tbl_anggotatimkur');
			$this->usersmodel->updateRole($user_id, 'nontimkur');
			redirect(base_url('manajemen/anggotatimkur/'.$timkur_id));
		} else {
			redirect(base_url('dashboard'));
		}
	}

	//Modul Manajemen Tim PDCA
	public function timpdca(){
		$this->load->model('usersmodel');
		$this->load->model('timpdcamodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$data = [
				'title' => "D!Acreditation | Tim PDCA DTE",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Tim PDCA DTE'
			];

			$number = $this->timpdcamodel->getNumTim();
			if ($number <= 0){
				$data['alltimpdca'] = "kosong";
			} else {
				$data['alltimpdca'] = $this->timpdcamodel->getAll();
			}

			$this->load->view('view_mantimpdca', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function createtimpdca(){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$data = [
				'title' => "D!Acreditation | Form Membuat Tim PDCA",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Form Membuat Tim PDCA'
			];

			$this->load->view('create_timpdca', $data);
		} else {
			redirect(base_url('dashboard'));
		}		
	}

	public function docreatetimpdca(){		
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$btn = $this->input->post('btncreate');
			if ($btn == "buat"){

				$this->load->library('form_validation');
	
				$this->form_validation->set_rules('inputNamaTim', 'Nama Tim', 'required',
							array('required' => 'Field %s tidak boleh kosong'));	
				$this->form_validation->set_rules('inputTahun', 'Tahun', 'required',
							array('required' => 'Field %s tidak boleh kosong'));

				if ($this->form_validation->run() == FALSE){
					$data = [
						'title' => "D!Acreditation | Form Membuat Tim PDCA",
						'name' => $this->session->userdata('name'),
						'login_SSO' => $this->session->userdata('login_SSO'),
						'page' => 'Form Membuat Tim PDCA',
						'status' => 'gagal'
					];
		
					$this->load->view('create_timpdca_err', $data);
				} else {
					$namatim = $this->input->post('inputNamaTim');
					$tahun = $this->input->post('inputTahun');
					$semester = $this->input->post('inputSemester');
					$status = $this->input->post('inputStatus');

					$data = array(
						'nama_tim' => $namatim,
						'tahun' => $tahun,
						'semester' => $semester,
						'status' => $status,
						'date_created' => date("Y-m-d h:i:s"),
						'date_modified' => date("Y-m-d h:i:s")

					);
					$this->db->insert('tbl_timpdca', $data);
					redirect(base_url('manajemen/timpdca'));
				}
			} else {
				redirect(base_url('manajemen/timpdca'));
			}
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function hapustimpdca($id){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$this->db->where('timpdca_id', $id);
			$this->db->delete('tbl_timpdca');
			//$this->usersmodel->updateRole($user_id, 'nonman');
			redirect(base_url('manajemen/timpdca'));
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function ubahtimpdca($id){
		$this->load->model('usersmodel');
		$this->load->model('timpdcamodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$timpdca = $this->timpdcamodel->getByID($id);
			$data = [
				'title' => "D!Acreditation | Form Mengubah Tim PDCA",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Form Mengubah Tim PDCA'
			];

			foreach ($timpdca as $t){
				$data['timpdca_id'] = $t->timpdca_id;
				$data['namatim'] = $t->nama_tim;
				$data['tahun'] = $t->tahun;
				$data['semester'] = $t->semester;
				$data['status'] = $t->status;
			}

			$this->load->view('ubah_timpdca', $data);
		} else {
			redirect(base_url('dashboard'));
		}		
	}

	public function doubahtimpdca(){		
		$this->load->model('usersmodel');
		$this->load->model('timpdcamodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$btn = $this->input->post('btncreate');
			$timpdca_id = $this->input->post('timpdca_id');
			if ($btn == "buat"){

				$this->load->library('form_validation');
	
				$this->form_validation->set_rules('inputNamaTim', 'Nama Tim', 'required',
							array('required' => 'Field %s tidak boleh kosong'));	
				$this->form_validation->set_rules('inputTahun', 'Tahun', 'required',
							array('required' => 'Field %s tidak boleh kosong'));

				if ($this->form_validation->run() == FALSE){
					$data = [
						'title' => "D!Acreditation | Form Mengubah Tim PDCA",
						'name' => $this->session->userdata('name'),
						'login_SSO' => $this->session->userdata('login_SSO'),
						'page' => 'Form Mengubah Tim PDCA',
						'timpdca_id' => $timpdca_id,
						'status' => 'gagal'
					];
		
					$this->load->view('ubah_timpdca_err', $data);
				} else {
					$timpdca_id = $this->input->post('timpdca_id');
					$namatim = $this->input->post('inputNamaTim');
					$tahun = $this->input->post('inputTahun');
					$semester = $this->input->post('inputSemester');
					$status = $this->input->post('inputStatus');

					$data = array(
						'nama_tim' => $namatim,
						'tahun' => $tahun,
						'semester' => $semester,
						'status' => $status,
						'date_created' => date("Y-m-d h:i:s"),
						'date_modified' => date("Y-m-d h:i:s")

					);
					$this->db->where('timpdca_id', $timpdca_id);
					$this->db->update('tbl_timpdca', $data);
					redirect(base_url('manajemen/timpdca'));
				}
			} else {
				redirect(base_url('manajemen/timpdca'));
			}
		} else {
			redirect(base_url('dashboard'));
		}
	}

	//Modul anggota tim PDCA
	public function anggotatimpdca($id){
		$this->load->model('usersmodel');
		$this->load->model('timpdcamodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$data = [
				'title' => "D!Acreditation | Anggota Tim PDCA DTE",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'timpdca_id' => $id,
				'page' => 'Anggota Tim PDCA DTE'
			];

			$number = $this->timpdcamodel->getNumAnggotaTim($id);
			if ($number <= 0){
				$data['anggotatimpdca'] = "kosong";
			} else {
				$data['anggotatimpdca'] = $this->timpdcamodel->getAllAnggotaTim($id);
			}

			$this->load->view('view_anggotatimpdca', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}

	public function createanggotatimpdca($id){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$data = [
				'title' => "D!Acreditation | Form Menambah Anggota Tim PDCA",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Form Menambah Anggota Tim PDCA',
				'timpdca_id' => $id,
				'alluser' => $this->usersmodel->getAll()
			];

			$this->load->view('create_anggotatimpdca', $data);
		} else {
			redirect(base_url('dashboard'));
		}			
	}

	public function docreateanggotatimpdca(){	
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$btn = $this->input->post('btncreate');
			$timpdca_id = $this->input->post('timpdca_id');
			if ($btn == "buat"){
				$staff = $this->input->post('inputStaff');
				$jabatan = $this->input->post('inputJabatan');

				$data = array(
					'timpdca_id' => $timpdca_id,
					'user_id' => $staff,
					'jabatan' => $jabatan,
					'date_created' => date("Y-m-d h:i:s"),
					'date_modified' => date("Y-m-d h:i:s")

				);
				$this->db->insert('tbl_anggotatimpdca', $data);
				$this->usersmodel->updateRole($staff, 'timpdca');
				redirect(base_url('manajemen/anggotatimpdca/'.$timpdca_id));
			} else {
				redirect(base_url('manajemen/anggotatimpdca/'.$timpdca_id));
			}
		} else {
			redirect(base_url('dashboard'));
		}		
	}

	public function hapusanggotatimpdca($user_id, $timpdca_id, $anggota_id){
		$this->load->model('usersmodel');
		if ($this->usersmodel->checkAdmin() || $this->usersmodel->checkManProdi()){
			$this->db->where('timpdca_id', $timpdca_id);
			$this->db->where('anggota_id', $anggota_id);
			$this->db->delete('tbl_anggotatimpdca');
			$this->usersmodel->updateRole($user_id, 'nontimpdca');
			redirect(base_url('manajemen/anggotatimpdca/'.$timpdca_id));
		} else {
			redirect(base_url('dashboard'));
		}
	}

	//Modul Koordinator MK
	public function koordinatormk()
	{
		$this->load->model('usersmodel');
		$this->load->model('mandte');
		if ($this->usersmodel->checkAdmin()){
			$data = [
				'title' => "D!Acreditation | Pengaturan Manajemen DTE",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Pengaturan Manajemen DTE'
			];

			$number = $this->mandte->getNumMan();
			if ($number <= 0){
				$data['allman'] = "kosong";
			} else {
				$data['allman'] = $this->mandte->getAll();
			}

			$this->load->view('view_mandte', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}

	//Modul Pengampu MK
	public function pengampumk()
	{
		$this->load->model('usersmodel');
		$this->load->model('mandte');
		if ($this->usersmodel->checkAdmin()){
			$data = [
				'title' => "D!Acreditation | Pengaturan Manajemen DTE",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Pengaturan Manajemen DTE'
			];

			$number = $this->mandte->getNumMan();
			if ($number <= 0){
				$data['allman'] = "kosong";
			} else {
				$data['allman'] = $this->mandte->getAll();
			}

			$this->load->view('view_mandte', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}

	//Modul Dosen Peer MK
	public function dosenpeer()
	{
		$this->load->model('usersmodel');
		$this->load->model('mandte');
		if ($this->usersmodel->checkAdmin()){
			$data = [
				'title' => "D!Acreditation | Pengaturan Manajemen DTE",
				'name' => $this->session->userdata('name'),
				'login_SSO' => $this->session->userdata('login_SSO'),
				'page' => 'Pengaturan Manajemen DTE'
			];

			$number = $this->mandte->getNumMan();
			if ($number <= 0){
				$data['allman'] = "kosong";
			} else {
				$data['allman'] = $this->mandte->getAll();
			}

			$this->load->view('view_mandte', $data);
		} else {
			redirect(base_url('dashboard'));
		}
	}
}
