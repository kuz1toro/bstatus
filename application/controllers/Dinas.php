<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dinas extends CI_Controller {

	/**
	* name of the folder responsible for the views
	* which are manipulated by this controller
	* @constant string
	*/
	const VIEW_FOLDER = 'dinas';

	/* pagination setting */
	private $per_page = 8;
	var $attributeFooter = array(
			'chartJS' => FALSE,
			'dataTable' => FALSE,
			'JqueryValidation' => FALSE,
			'bootstrapSelect' => FALSE,
			'datetimePicker' => FALSE,
			'kecamatanKelurahan' => FALSE
		);

	/**
	* Responsable for auto load the model
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dinas_model');
		$this->load->model('pelengkap_model');
		$this->load->library(array('ion_auth','form_validation'));
		// verifikasi pangilan
		if ( ! $this->ion_auth->in_group('Dinas'))
		{
			redirect('auth/logout');
		}
	}

	public function home()
	{
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['chartJS'] = TRUE;
		$attributeFooter['dataTable'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['main_content'] = 'dinas/home';
		$this->load->view('dinas/includes/template', $data);
	}

	public function logout()
	{
		redirect('auth/logout');
	}

	public function list_jalurInfo()
	{
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['thead'] = array(
			'No','Jalur Informasi', 'Keterangan', 'Aksi'
		);
		$data['dhead'] = array(
			'nama_kolom_jalurInfo', 'keterangan_kolom_jalurInfo'
		);
		$data['id_table'] = 'id_kolom_jalurInfo';
		$data['header'] = 'Jalur Informasi';
		$data['edit_url'] = 'edit_jalurInfo';
		$data['delete_url'] = 'delete_jalurInfo';
		$data['add_url'] = 'add_jalurInfo';
		$nama_table = 'tabel_kolom_jalurInfo';
		$data['data_jalurInfo'] = $this->dinas_model->get_all_setting($nama_table);
		$data['main_content'] = 'dinas/setting_input/list_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function edit_jalurInfo()
	{
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_jalurInfo';
		$id_table = 'id_kolom_jalurInfo';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('nama_kolom_jalurInfo', 'nama_kolom_jalurInfo', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'nama_kolom_jalurInfo' => $this->input->post('nama_kolom_jalurInfo'),
					'keterangan_kolom_jalurInfo' => $this->input->post('keterangan_kolom_jalurInfo')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->update_setting($nama_table, $id_table, $id, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'updated');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_jalurInfo');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'nama_kolom_jalurInfo', 'keterangan_kolom_jalurInfo'
		);
		$data['thead'] = array(
			'Jalur Informasi', 'Keterangan'
		);
		$data['header'] = 'Edit Jalur Informasi';
		$data['contrl_url'] = 'edit_jalurInfo';
		$data['cancel_url'] = 'list_jalurInfo';
		$data['data_jalurInfo'] = $this->dinas_model->get_setting_byId($nama_table, $id_table, $id);
		$data['main_content'] = 'dinas/setting_input/edit_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function delete_jalurInfo()
	{
		//product id
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_jalurInfo';
		$id_table = 'id_kolom_jalurInfo';
		if ($this->dinas_model->soft_delete_setting($nama_table, $id_table, $id)){
			$this->session->set_flashdata('flash_message', 'deleted');
		}
		else{
			$this->session->set_flashdata('flash_message', 'failed');
		}
		redirect('dinas/list_jalurInfo');
	}

	public function add_jalurInfo()
	{
		$nama_table = 'tabel_kolom_jalurInfo';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('nama_kolom_jalurInfo', 'nama_kolom_jalurInfo', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'nama_kolom_jalurInfo' => $this->input->post('nama_kolom_jalurInfo'),
					'keterangan_kolom_jalurInfo' => $this->input->post('keterangan_kolom_jalurInfo')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->add_setting($nama_table, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'sukses');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_jalurInfo');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'nama_kolom_jalurInfo', 'keterangan_kolom_jalurInfo'
		);
		$data['thead'] = array(
			'Jalur Informasi', 'Keterangan'
		);
		$data['header'] = 'Tambah Jalur Informasi';
		$data['contrl_url'] = 'add_jalurInfo';
		$data['cancel_url'] = 'list_jalurInfo';
		$data['main_content'] = 'dinas/setting_input/add_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function list_fungsiGedung()
	{
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['thead'] = array(
			'No','Fungsi Gedung', 'Keterangan', 'Aksi'
		);
		$data['dhead'] = array(
			'fungsi_gedung', 'keterangan_fungsiGdg'
		);
		$data['id_table'] = 'id_fungsi_gedung';
		$data['header'] = 'Daftar Fungsi Gedung';
		$data['edit_url'] = 'edit_fungsiGedung';
		$data['delete_url'] = 'delete_fungsiGedung';
		$data['add_url'] = 'add_fungsiGedung';
		$nama_table = 'tabel_kolom_fungsi_gedung';
		$data['data_jalurInfo'] = $this->dinas_model->get_all_setting($nama_table);
		$data['main_content'] = 'dinas/setting_input/list_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function edit_fungsiGedung()
	{
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_fungsi_gedung';
		$id_table = 'id_fungsi_gedung';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('fungsi_gedung', 'fungsi_gedung', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'fungsi_gedung' => $this->input->post('fungsi_gedung'),
					'keterangan_fungsiGdg' => $this->input->post('keterangan_fungsiGdg')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->update_setting($nama_table, $id_table, $id, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'updated');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_fungsiGedung');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'fungsi_gedung', 'keterangan_fungsiGdg'
		);
		$data['thead'] = array(
			'Fungsi Gedung', 'Keterangan'
		);
		$data['header'] = 'Edit Fungsi Gedung';
		$data['contrl_url'] = 'edit_fungsiGedung';
		$data['cancel_url'] = 'list_fungsiGedung';
		$data['data_jalurInfo'] = $this->dinas_model->get_setting_byId($nama_table, $id_table, $id);
		$data['main_content'] = 'dinas/setting_input/edit_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function add_fungsiGedung()
	{
		$nama_table = 'tabel_kolom_fungsi_gedung';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('fungsi_gedung', 'fungsi_gedung', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'fungsi_gedung' => $this->input->post('fungsi_gedung'),
					'keterangan_fungsiGdg' => $this->input->post('keterangan_fungsiGdg')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->add_setting($nama_table, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'sukses');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_fungsiGedung');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'fungsi_gedung', 'keterangan_fungsiGdg'
		);
		$data['thead'] = array(
			'Fungsi Gedung', 'Keterangan'
		);
		$data['header'] = 'Tambah Fungsi Gedung';
		$data['contrl_url'] = 'add_fungsiGedung';
		$data['cancel_url'] = 'list_fungsiGedung';
		$data['main_content'] = 'dinas/setting_input/add_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function delete_fungsiGedung()
	{
		//product id
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_fungsi_gedung';
		$id_table = 'id_fungsi_gedung';
		if ($this->dinas_model->soft_delete_setting($nama_table, $id_table, $id)){
			$this->session->set_flashdata('flash_message', 'deleted');
		}
		else{
			$this->session->set_flashdata('flash_message', 'failed');
		}
		redirect('dinas/list_fungsiGedung');
	}

	public function list_kepemilknGedung()
	{
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['thead'] = array(
			'No','Kepemilikkan Gedung', 'Keterangan', 'Aksi'
		);
		$data['dhead'] = array(
			'kepemilikkan_gedung', 'keterangan_kepemilikkan_gedung'
		);
		$data['id_table'] = 'id_kepemilikkan_gedung';
		$data['header'] = 'Daftar Kepemilikkan Gedung';
		$data['edit_url'] = 'edit_kepemilknGedung';
		$data['delete_url'] = 'delete_kepemilknGedung';
		$data['add_url'] = 'add_kepemilknGedung';
		$nama_table = 'tabel_kolom_kepemilikkan_gedung';
		$data['data_jalurInfo'] = $this->dinas_model->get_all_setting($nama_table);
		$data['main_content'] = 'dinas/setting_input/list_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function edit_kepemilknGedung()
	{
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_kepemilikkan_gedung';
		$id_table = 'id_kepemilikkan_gedung';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('kepemilikkan_gedung', 'kepemilikkan_gedung', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'kepemilikkan_gedung' => $this->input->post('kepemilikkan_gedung'),
					'keterangan_kepemilikkan_gedung' => $this->input->post('keterangan_kepemilikkan_gedung')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->update_setting($nama_table, $id_table, $id, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'updated');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_kepemilknGedung');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'kepemilikkan_gedung', 'keterangan_kepemilikkan_gedung'
		);
		$data['thead'] = array(
			'Kepemilikkan Gedung', 'Keterangan'
		);
		$data['header'] = 'Edit Kepemilikkan Gedung';
		$data['contrl_url'] = 'edit_kepemilknGedung';
		$data['cancel_url'] = 'list_kepemilknGedung';
		$data['data_jalurInfo'] = $this->dinas_model->get_setting_byId($nama_table, $id_table, $id);
		$data['main_content'] = 'dinas/setting_input/edit_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function add_kepemilknGedung()
	{
		$nama_table = 'tabel_kolom_kepemilikkan_gedung';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('kepemilikkan_gedung', 'kepemilikkan_gedung', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'kepemilikkan_gedung' => $this->input->post('kepemilikkan_gedung'),
					'keterangan_kepemilikkan_gedung' => $this->input->post('keterangan_kepemilikkan_gedung')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->add_setting($nama_table, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'sukses');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_kepemilknGedung');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'kepemilikkan_gedung', 'keterangan_kepemilikkan_gedung'
		);
		$data['thead'] = array(
			'Kepemilikkan Gedung', 'Keterangan'
		);
		$data['header'] = 'Tambah Kepemilikkan Gedung';
		$data['contrl_url'] = 'add_kepemilknGedung';
		$data['cancel_url'] = 'list_kepemilknGedung';
		$data['main_content'] = 'dinas/setting_input/add_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function delete_kepemilknGedung()
	{
		//product id
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_kepemilikkan_gedung';
		$id_table = 'id_kepemilikkan_gedung';
		if ($this->dinas_model->soft_delete_setting($nama_table, $id_table, $id)){
			$this->session->set_flashdata('flash_message', 'deleted');
		}
		else{
			$this->session->set_flashdata('flash_message', 'failed');
		}
		redirect('dinas/list_fungsiGedung');
	}

	public function list_hslPemeriksaan()
	{
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['thead'] = array(
			'No','Hasil Pemeriksaan', 'Keterangan', 'Aksi'
		);
		$data['dhead'] = array(
			'nama_kolom_hslPemeriksaan', 'keterangan_kolom_hslPemeriksaan'
		);
		$data['id_table'] = 'id_kolom_hslPemeriksaan';
		$data['header'] = 'Hasil Pemeriksaan';
		$data['edit_url'] = 'edit_hslPemeriksaan';
		$data['delete_url'] = 'delete_hslPemeriksaan';
		$data['add_url'] = 'add_hslPemeriksaan';
		$nama_table = 'tabel_kolom_hslPemeriksaan';
		$data['data_jalurInfo'] = $this->dinas_model->get_all_setting($nama_table);
		$data['main_content'] = 'dinas/setting_input/list_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function edit_hslPemeriksaan()
	{
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_hslPemeriksaan';
		$id_table = 'id_kolom_hslPemeriksaan';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('nama_kolom_hslPemeriksaan', 'nama_kolom_hslPemeriksaan', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'nama_kolom_hslPemeriksaan' => $this->input->post('nama_kolom_hslPemeriksaan'),
					'keterangan_kolom_hslPemeriksaan' => $this->input->post('keterangan_kolom_hslPemeriksaan')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->update_setting($nama_table, $id_table, $id, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'updated');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_hslPemeriksaan');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'nama_kolom_hslPemeriksaan', 'keterangan_kolom_hslPemeriksaan'
		);
		$data['thead'] = array(
			'Hasil Pemeriksaan', 'Keterangan'
		);
		$data['header'] = 'Edit Hasil Pemeriksaan';
		$data['contrl_url'] = 'edit_hslPemeriksaan';
		$data['cancel_url'] = 'list_hslPemeriksaan';
		$data['data_jalurInfo'] = $this->dinas_model->get_setting_byId($nama_table, $id_table, $id);
		$data['main_content'] = 'dinas/setting_input/edit_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function delete_hslPemeriksaan()
	{
		//product id
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_hslPemeriksaan';
		$id_table = 'id_kolom_hslPemeriksaan';
		if ($this->dinas_model->soft_delete_setting($nama_table, $id_table, $id)){
			$this->session->set_flashdata('flash_message', 'deleted');
		}
		else{
			$this->session->set_flashdata('flash_message', 'failed');
		}
		redirect('dinas/list_hslPemeriksaan');
	}

	public function add_hslPemeriksaan()
	{
		$nama_table = 'tabel_kolom_hslPemeriksaan';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('nama_kolom_hslPemeriksaan', 'nama_kolom_hslPemeriksaan', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'nama_kolom_hslPemeriksaan' => $this->input->post('nama_kolom_hslPemeriksaan'),
					'keterangan_kolom_hslPemeriksaan' => $this->input->post('keterangan_kolom_hslPemeriksaan')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->add_setting($nama_table, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'sukses');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_hslPemeriksaan');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'nama_kolom_hslPemeriksaan', 'keterangan_kolom_hslPemeriksaan'
		);
		$data['thead'] = array(
			'Hasil Pemeriksaan', 'Keterangan'
		);
		$data['header'] = 'Tambah Hasil Pemeriksaan';
		$data['contrl_url'] = 'add_hslPemeriksaan';
		$data['cancel_url'] = 'list_hslPemeriksaan';
		$data['main_content'] = 'dinas/setting_input/add_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function list_statusGedung()
	{
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['thead'] = array(
			'No','Status Gedung', 'Kategori Keselamatan Kebakaran', 'Keterangan', 'Aksi'
		);
		$data['dhead'] = array(
			'nama_kolom_statusGedung', 'kategori_kolomHslPemeriksaan', 'keterangan_kolom_statusGedung'
		);
		$data['id_table'] = 'id_kolom_statusGedung';
		$data['header'] = 'Status Gedung';
		$data['edit_url'] = 'edit_statusGedung';
		$data['delete_url'] = 'delete_statusGedung';
		$data['add_url'] = 'add_statusGedung';
		$nama_table = 'tabel_kolom_statusGedung';
		$data['data_jalurInfo'] = $this->dinas_model->get_all_setting($nama_table);
		$data['main_content'] = 'dinas/setting_input/list_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function edit_statusGedung()
	{
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_statusGedung';
		$id_table = 'id_kolom_statusGedung';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('nama_kolom_statusGedung', 'nama_kolom_statusGedung', 'required');
			$this->form_validation->set_rules('kategori_kolomHslPemeriksaan', 'kategori_kolomHslPemeriksaan', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'nama_kolom_statusGedung' => $this->input->post('nama_kolom_statusGedung'),
					'kategori_kolomHslPemeriksaan' => $this->input->post('kategori_kolomHslPemeriksaan'),
					'keterangan_kolom_statusGedung' => $this->input->post('keterangan_kolom_statusGedung')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->update_setting($nama_table, $id_table, $id, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'updated');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_statusGedung');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$attributeFooter['bootstrapSelect'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'nama_kolom_statusGedung', 'kategori_kolomHslPemeriksaan', 'keterangan_kolom_statusGedung'
		);
		$data['thead'] = array(
			'Status Gedung', 'Kategori Keselamatan Kebakaran', 'Keterangan'
		);
		$data['header'] = 'Edit Status Gedung';
		$data['contrl_url'] = 'edit_statusGedung';
		$data['cancel_url'] = 'list_statusGedung';
		$data['data_hslPemeriksaan'] = $this->dinas_model->get_hslPemeriksaan('tabel_kolom_hslPemeriksaan', 'nama_kolom_hslPemeriksaan');
		$data['data_jalurInfo'] = $this->dinas_model->get_setting_byId($nama_table, $id_table, $id);
		$data['main_content'] = 'dinas/setting_input/edit_setting_statGedung';
		$this->load->view('dinas/includes/template', $data);
	}

	public function delete_statusGedung()
	{
		//product id
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_statusGedung';
		$id_table = 'id_kolom_statusGedung';
		if ($this->dinas_model->soft_delete_setting($nama_table, $id_table, $id)){
			$this->session->set_flashdata('flash_message', 'deleted');
		}
		else{
			$this->session->set_flashdata('flash_message', 'failed');
		}
		redirect('dinas/list_statusGedung');
	}

	public function add_statusGedung()
	{
		$nama_table = 'tabel_kolom_statusGedung';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('nama_kolom_statusGedung', 'nama_kolom_statusGedung', 'required');
			$this->form_validation->set_rules('kategori_kolomHslPemeriksaan', 'kategori_kolomHslPemeriksaan', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'nama_kolom_statusGedung' => $this->input->post('nama_kolom_statusGedung'),
					'kategori_kolomHslPemeriksaan' => $this->input->post('kategori_kolomHslPemeriksaan'),
					'keterangan_kolom_statusGedung' => $this->input->post('keterangan_kolom_statusGedung')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->add_setting($nama_table, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'sukses');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}
				redirect('dinas/list_statusGedung');
			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$attributeFooter['bootstrapSelect'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'nama_kolom_statusGedung', 'kategori_kolomHslPemeriksaan', 'keterangan_kolom_statusGedung'
		);
		$data['thead'] = array(
			'Status Gedung', 'Kategori Keselamatan Kebakaran', 'Keterangan'
		);
		$data['header'] = 'Tambah Status Gedung';
		$data['contrl_url'] = 'add_statusGedung';
		$data['cancel_url'] = 'list_statusGedung';
		$data['data_hslPemeriksaan'] = $this->dinas_model->get_hslPemeriksaan('tabel_kolom_hslPemeriksaan', 'nama_kolom_hslPemeriksaan');
		$data['main_content'] = 'dinas/setting_input/add_setting_statGedung';
		$this->load->view('dinas/includes/template', $data);
	}

	public function list_penyebabFire()
	{
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['thead'] = array(
			'No','Jenis Penyebab', 'Keterangan', 'Aksi'
		);
		$data['dhead'] = array(
			'penyebab', 'keterangan_penyebab'
		);
		$data['id_table'] = 'id_penyebabFire';
		$data['header'] = 'Daftar Penyebab Kebakaran';
		$data['edit_url'] = 'edit_penyebabFire';
		$data['delete_url'] = 'delete_penyebabFire';
		$data['add_url'] = 'add_penyebabFire';
		$nama_table = 'tabel_kolom_penyebabFire';
		$data['data_jalurInfo'] = $this->dinas_model->get_all_setting($nama_table);
		$data['main_content'] = 'dinas/setting_input/list_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function edit_penyebabFire()
	{
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_penyebabFire';
		$id_table = 'id_penyebabFire';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('penyebab', 'penyebab', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'penyebab' => $this->input->post('penyebab'),
					'keterangan_penyebab' => $this->input->post('keterangan_penyebab')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->update_setting($nama_table, $id_table, $id, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'updated');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_penyebabFire');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'penyebab', 'keterangan_penyebab'
		);
		$data['thead'] = array(
			'Jenis Penyebab', 'Keterangan'
		);
		$data['header'] = 'Edit Data Penyebab Kebakaran';
		$data['contrl_url'] = 'edit_penyebabFire';
		$data['cancel_url'] = 'list_penyebabFire';
		$data['data_jalurInfo'] = $this->dinas_model->get_setting_byId($nama_table, $id_table, $id);
		$data['main_content'] = 'dinas/setting_input/edit_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function delete_penyebabFire()
	{
		//product id
		$id = $this->uri->segment(3);
		$nama_table = 'tabel_kolom_penyebabFire';
		$id_table = 'id_penyebabFire';
		if ($this->dinas_model->soft_delete_setting($nama_table, $id_table, $id)){
			$this->session->set_flashdata('flash_message', 'deleted');
		}
		else{
			$this->session->set_flashdata('flash_message', 'failed');
		}
		redirect('dinas/list_penyebabFire');
	}

	public function add_penyebabFire()
	{
		$nama_table = 'tabel_kolom_penyebabFire';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('penyebab', 'penyebab', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'penyebab' => $this->input->post('penyebab'),
					'keterangan_penyebab' => $this->input->post('keterangan_penyebab')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->add_setting($nama_table, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'sukses');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_penyebabFire');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'penyebab', 'keterangan_penyebab'
		);
		$data['thead'] = array(
			'Jenis Penyebab', 'Keterangan'
		);
		$data['header'] = 'Tambah Penyebab Kebakaran';
		$data['contrl_url'] = 'add_penyebabFire';
		$data['cancel_url'] = 'list_penyebabFire';
		$data['main_content'] = 'dinas/setting_input/add_setting';
		$this->load->view('dinas/includes/template', $data);
	}



	public function list_pokja()
	{
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['thead'] = array(
			'No','Nama Pokja', 'Ketua Pokja', 'Aksi'
		);
		$data['dhead'] = array(
			'nama_pokja', 'ketua_pokja'
		);
		$data['id_table'] = 'id_pokja';
		$data['header'] = 'Daftar Pokja';
		$data['edit_url'] = 'edit_pokja';
		$data['delete_url'] = 'delete_pokja';
		$data['add_url'] = 'add_pokja';
		$nama_table = 'pokja_dinas';
		$data['data'] = $this->dinas_model->get_all_setting($nama_table);
		$data['main_content'] = 'dinas/pokja/list_pokja';
		$this->load->view('dinas/includes/template', $data);
	}

	public function add_pokja()
	{
		$nama_table = 'pokja_dinas';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('nama_pokja', 'nama_pokja', 'required');
			$this->form_validation->set_rules('ketua_pokja', 'ketua_pokja', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'nama_pokja' => $this->input->post('nama_pokja'),
					'ketua_pokja' => $this->input->post('ketua_pokja'),
					'anggota_1' => $this->input->post('anggota_1'),
					'anggota_2' => $this->input->post('anggota_2'),
					'anggota_3' => $this->input->post('anggota_3'),
					'anggota_4' => $this->input->post('anggota_4'),
					'anggota_5' => $this->input->post('anggota_5'),
					'anggota_6' => $this->input->post('anggota_6')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->add_setting($nama_table, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'sukses');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_pokja');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'nama_pokja', 'ketua_pokja', 'anggota_1', 'anggota_2', 'anggota_3', 'anggota_4', 'anggota_5', 'anggota_6'
		);
		$data['thead'] = array(
			'Nama Pokja', 'Ketua Pokja', 'Anggota 1', 'Anggota 2', 'Anggota 3', 'Anggota 4', 'Anggota 5', 'Anggota 6'
		);
		$data['header'] = 'Tambah Data Pokja';
		$data['contrl_url'] = 'add_pokja';
		$data['cancel_url'] = 'list_pokja';
		$data['main_content'] = 'dinas/pokja/add_pokja';
		$this->load->view('dinas/includes/template', $data);
	}

	public function edit_pokja()
	{
		$id = $this->uri->segment(3);
		$nama_table = 'pokja_dinas';
		$id_table = 'id_pokja';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('nama_pokja', 'nama_pokja', 'required');
			$this->form_validation->set_rules('ketua_pokja', 'ketua_pokja', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'nama_pokja' => $this->input->post('nama_pokja'),
					'ketua_pokja' => $this->input->post('ketua_pokja'),
					'anggota_1' => $this->input->post('anggota_1'),
					'anggota_2' => $this->input->post('anggota_2'),
					'anggota_3' => $this->input->post('anggota_3'),
					'anggota_4' => $this->input->post('anggota_4'),
					'anggota_5' => $this->input->post('anggota_5'),
					'anggota_6' => $this->input->post('anggota_6')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->update_setting($nama_table, $id_table, $id, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'updated');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_pokja');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'nama_pokja', 'ketua_pokja', 'anggota_1', 'anggota_2', 'anggota_3', 'anggota_4', 'anggota_5', 'anggota_6'
		);
		$data['thead'] = array(
			'Nama Pokja', 'Ketua Pokja', 'Anggota 1', 'Anggota 2', 'Anggota 3', 'Anggota 4', 'Anggota 5', 'Anggota 6'
		);
		$data['header'] = 'Edit Data Pokja';
		$data['contrl_url'] = 'edit_pokja';
		$data['cancel_url'] = 'list_pokja';
		$data['data'] = $this->dinas_model->get_setting_byId($nama_table, $id_table, $id);
		$data['main_content'] = 'dinas/pokja/edit_pokja';
		$this->load->view('dinas/includes/template', $data);
	}

	public function delete_pokja()
	{
		$id = $this->uri->segment(3);
		$nama_table = 'pokja_dinas';
		$id_table = 'id_pokja';
		if ($this->dinas_model->soft_delete_setting($nama_table, $id_table, $id)){
			$this->session->set_flashdata('flash_message', 'deleted');
		}
		else{
			$this->session->set_flashdata('flash_message', 'failed');
		}
		redirect('dinas/list_pokja');
	}

	public function list_fireHist()
	{
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['thead'] = array(
			'No','Gedung', 'Tanggal Kejadian', 'Waktu Kejadian', 'Penyebab', 'Jumlah Unit yang diturunkan', 'Keterangan', 'Aksi'
		);
		$data['dhead'] = array(
			'nama_gedung', 'tgl_kejadian', 'waktu_kejadian', 'penyebab', 'jumlah_unit', 'keterangan'
		);
		$data['id_table'] = 'id_fireHistDinas';
		$data['header'] = 'Riwayat Kebakaran';
		$data['edit_url'] = 'edit_fireHist';
		$data['delete_url'] = 'delete_fireHist';
		$data['add_url'] = 'add_fireHist';
		$table_fireHist = 'riwayat_kebakaran_gdd_dinas';
		$table_gedung = 'gedung_dinas';
		$table_penyebabFire = 'tabel_kolom_penyebabFire';
		$data['data'] = $this->dinas_model->get_list_fireHist($table_fireHist, $table_gedung, $table_penyebabFire);
		$data['main_content'] = 'dinas/fire_hist/list_fireHist';
		$this->load->view('dinas/includes/template', $data);
	}

	public function add_fireHist()
	{
		/** 
		$this->load->helper('date');
		$datestring = 'Year: %Y Month: %m Day: %d - %h:%i %a';
		$time = now('Asia/Jakarta');
		$testDate = '08-Februari-2019';
		$testTime = '22:20';
		$time2 = strtotime($testDate);
		$time2 = date('Y-m-d',$time2);
		$time3 = strtotime($testTime);
		$time3 = date('H:i',$time3);
		$unix = human_to_unix($time3);
		$timezone = new DateTimeZone('Asia/Jakarta');
		$date     = DateTime::createFromFormat('d-F-Y', $testDate, $timezone);
		//$dtUtcDate = strtotime($testDate. ' '. $timezone);
		//$dtUtcDate = date('Y-m-d',$date);
		//$timestamp = $date->format('U');
		$time5 = htmlDate2sqlDate($testDate);
		$time5 = sqlDate2html($time5);
		$data['testDate'] = $time5;
		*/
		
		$table_fireHist = 'riwayat_kebakaran_gdd_dinas';
		$table_gedung = 'gedung_dinas';
		$table_penyebab = 'tabel_kolom_penyebabFire';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('no_gedung', 'no_gedung', 'required');
			$this->form_validation->set_rules('tgl_kejadian', 'tgl_kejadian', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$tglKejadian = $this->input->post('tgl_kejadian');
				$tglKejadian = htmlDate2sqlDate($tglKejadian);
				$data_to_store = array(
					'no_gedung' => $this->input->post('no_gedung'),
					'tgl_kejadian' => $tglKejadian,
					'waktu_kejadian' => $this->input->post('waktu_kejadian'),
					'dugaan_penyebab' => $this->input->post('dugaan_penyebab'),
					'jumlah_unit' => $this->input->post('jumlah_unit'),
					'keterangan' => $this->input->post('keterangan')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->add_setting($table_fireHist, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'sukses');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_fireHist');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$attributeFooter['bootstrapSelect'] = TRUE;
		$attributeFooter['datetimePicker'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'no_gedung', 'tgl_kejadian', 'waktu_kejadian', 'dugaan_penyebab', 'jumlah_unit', 'keterangan'
		);
		$data['thead'] = array(
			'Gedung', 'Tanggal Kejadian', 'Waktu Kejadian', 'Penyebab', 'Jumlah Unit yang diturunkan', 'Keterangan'
		);
		$data['header'] = 'Tambah Riwayat Kebakaran';
		$data['contrl_url'] = 'add_fireHist';
		$data['cancel_url'] = 'list_fireHist';
		$column_penyebab = array ('id_penyebabFire', 'penyebab');
		$data['list_penyebab'] = $this->dinas_model->get_hslPemeriksaan($table_penyebab, $column_penyebab);
		$column_gedung = array ('no_gedung', 'nama_gedung');
		$data['list_gedung'] = $this->dinas_model->get_hslPemeriksaan($table_gedung, $column_gedung);
		$data['main_content'] = 'dinas/fire_hist/add_fireHist';
		$this->load->view('dinas/includes/template', $data);
	}

	public function edit_fireHist()
	{
		$id = $this->uri->segment(3);
		$table_fireHist = 'riwayat_kebakaran_gdd_dinas';
		$table_gedung = 'gedung_dinas';
		$table_penyebab = 'tabel_kolom_penyebabFire';
		$id_table = 'id_fireHistDinas';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('no_gedung', 'no_gedung', 'required');
			$this->form_validation->set_rules('tgl_kejadian', 'tgl_kejadian', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$tglKejadian = $this->input->post('tgl_kejadian');
				$tglKejadian = htmlDate2sqlDate($tglKejadian);
				//console_log($tglKejadian);
				$data_to_store = array(
					'no_gedung' => $this->input->post('no_gedung'),
					'tgl_kejadian' => $tglKejadian,
					'waktu_kejadian' => $this->input->post('waktu_kejadian'),
					'dugaan_penyebab' => $this->input->post('dugaan_penyebab'),
					'jumlah_unit' => $this->input->post('jumlah_unit'),
					'keterangan' => $this->input->post('keterangan')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->update_setting($table_fireHist, $id_table, $id, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'updated');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_fireHist');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$attributeFooter['bootstrapSelect'] = TRUE;
		$attributeFooter['datetimePicker'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'no_gedung', 'tgl_kejadian', 'waktu_kejadian', 'dugaan_penyebab', 'jumlah_unit', 'keterangan'
		);
		$data['thead'] = array(
			'Gedung', 'Tanggal Kejadian', 'Waktu Kejadian', 'Penyebab', 'Jumlah Unit yang diturunkan', 'Keterangan'
		);
		$data['header'] = 'Edit Riwayat Kebakaran';
		$data['contrl_url'] = 'edit_fireHist';
		$data['cancel_url'] = 'list_fireHist';
		$data['data'] = $this->dinas_model->get_setting_byId($table_fireHist, $id_table, $id);
		$column_penyebab = array ('id_penyebabFire', 'penyebab');
		$data['list_penyebab'] = $this->dinas_model->get_hslPemeriksaan($table_penyebab, $column_penyebab);
		$column_gedung = array ('no_gedung', 'nama_gedung');
		$data['list_gedung'] = $this->dinas_model->get_hslPemeriksaan($table_gedung, $column_gedung);
		$data['main_content'] = 'dinas/fire_hist/edit_fireHist';
		$this->load->view('dinas/includes/template', $data);
	}

	public function delete_fireHist()
	{
		$id = $this->uri->segment(3);
		$nama_table = 'riwayat_kebakaran_gdd_dinas';
		$id_table = 'id_fireHistDinas';
		if ($this->dinas_model->soft_delete_setting($nama_table, $id_table, $id)){
			$this->session->set_flashdata('flash_message', 'deleted');
		}
		else{
			$this->session->set_flashdata('flash_message', 'failed');
		}
		redirect('dinas/list_fireHist');
	}

	public function list_gedung()
	{
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['dataTable'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		//console_log( $attributeFooter );
		$data['thead'] = array(
			'No','No Gdg', 'Nama Gedung', 'Alamat', 'Wilayah', 'Fungsi', 'Kepemilikkan', 'Aksi'
		);
		$data['dhead'] = array(
			'no_gedung', 'nama_gedung', 'alamat_gedung', 'wilayah', 'fungsi_gedung', 'kepemilikkan_gedung'
		);
		$id_gedung = 'id_gdg_dinas';
		$data['id_table'] = $id_gedung;
		$data['header'] = 'Data Gedung';
		$data['read_url'] = 'read_gedung';
		$data['edit_url'] = 'edit_gedung';
		$data['delete_url'] = 'delete_gedung';
		$data['add_url'] = 'add_gedung';
		$table_gedung = 'gedung_dinas';
		$coulum_table_gedung = array ('id_gdg_dinas', 'no_gedung', 'nama_gedung', 'alamat_gedung', 'wilayah', 'fungsi', 'kepemilikan');
		$table_fungsi = 'tabel_kolom_fungsi_gedung';
		$table_kepemilikkan = 'tabel_kolom_kepemilikkan_gedung';
		$data['data'] = $this->dinas_model->get_list_gedung($table_gedung, $table_fungsi, $table_kepemilikkan, $coulum_table_gedung);

		//load the view
		$data['main_content'] = 'dinas/gedung/list_gedung';
		$this->load->view('dinas/includes/template', $data);
	}

	public function read_gedung()
	{
		$id = $this->uri->segment(3);
		//$user = $this->ion_auth->user()->row();
		//$userName = $user->username;
		$attributeFooter = $this->attributeFooter;
		//$attributeFooter['dataTable'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		//console_log( $attributeFooter );
		$data['gnames'] = array(
			'No Gedung', 'Nama Gedung', 'Alamat', 'Wilayah', 'Kecamatan', 'Kelurahan', 'Kodepos','Fungsi', 'Kepemilikkan', 'Jumlah Tower', 'Jumlah Lantai', 'Jumlah Basement', 'Ketinggian', 'Penginput', 'Waktu Input', 'Pengedit', 'Waktu Edit'
		);
		$data['gcontents'] = array(
			'no_gedung', 'nama_gedung', 'alamat_gedung', 'wilayah', 'kecamatan', 'kelurahan', 'kodepos', 'fungsi_gedung', 'kepemilikkan_gedung', 'jml_tower', 'jml_lantai', 'jml_basement', 'tinggi_gedung', 'created_by', 'create_at', 'edit_by', 'edit_at'
		);
		$data['pnames'] = array(
			'Nama Pengelola', 'Alamat Pengelola', 'No Telp Pengelola', 'Jalur Info', 'Hasil Pemeriksaan', 'Status Gedung', 'Tanggal Berlaku', 'Tanggal Habis', 'Catatan Pemeriksaan', 'Pokja Pemeriksa'
		);
		$data['pcontents'] = array(
			'nama_pengelola', 'alamat_pengelola', 'no_telp_pengelola', 'nama_kolom_jalurInfo', 'nama_kolom_hslPemeriksaan', 'nama_kolom_statusGedung', 'tgl_berlaku', 'tgl_expired', 'catatan', 'pokja'
		);
		$data['fsm_names'] = array(
			'Nama FSM', 'Alamat FSM', 'No Telp FSM', 'No Sertifikat FSM', 'Tanggal Berlaku', 'Tanggal Expired'
		);
		$data['fsm_contents'] = array(
			'nama_FSM', 'alamat_FSM', 'no_telp_FSM', 'no_sert_FSM', 'tgl_sert_berlaku', 'tgl_sert_expired'
		);
		$data['fire_names'] = array(
			'No', 'Tanggal Kejadian', 'Waktu', 'Penyebab', 'Jumlah Unit', 'Keterangan'
		);
		$data['fire_contents'] = array(
			'tgl_kejadian', 'waktu_kejadian', 'dugaan_penyebab', 'jumlah_unit', 'keterangan'
		);

		$id_gedung = 'id_gdg_dinas';
		$no_gedung_tblPemeriksaan = 'no_gedung';
		$data['header1'] = 'Data Gedung';
		$data['header2'] = 'Data Pemeriksaan';
		$data['header3'] = 'Data FSM';
		$data['header4'] = 'Data Riwayat Kebakaran';
		$data['list_url'] = 'list_gedung';
		$data['read_url'] = 'read_gedung';
		$data['edit_url'] = 'edit_gedung';
		$data['delete_url'] = 'delete_gedung';
		$data['add_url'] = 'add_gedung';
		$table_gedung = 'gedung_dinas';
		$table_fungsi = 'tabel_kolom_fungsi_gedung';
		$table_kepemilikkan = 'tabel_kolom_kepemilikkan_gedung';
		$data['data_gedung'] = $this->dinas_model->get_list_gedung_byId($table_gedung, $table_fungsi, $table_kepemilikkan, $id_gedung, $id);
		$no_gedung = $this->dinas_model->get_no_gdg_byId($table_gedung, $id_gedung, $id);
		$table_pemeriksaan = 'pemeriksaan_dinas';
		$table_jalurInfo = 'tabel_kolom_jalurInfo';
		$table_hslPemeriksaan = 'tabel_kolom_hslPemeriksaan';
		$table_statusGdg = 'tabel_kolom_statusGedung';
		$data['data_pemeriksaan'] = $this->dinas_model->get_list_pemeriksaan_byNoGdg($table_pemeriksaan, $table_jalurInfo, $table_hslPemeriksaan, $table_statusGdg, $no_gedung_tblPemeriksaan, $no_gedung[0]['no_gedung']);
		$table_fsm ='FSM_dinas';
		$data['data_fsm'] = $this->dinas_model->get_all_byNoGdg($table_fsm, $no_gedung[0]['no_gedung']);
		$table_fireHist ='riwayat_kebakaran_gdd_dinas';
		$data['fireHist'] = $this->dinas_model->get_all_byNoGdg($table_fireHist, $no_gedung[0]['no_gedung']);

		//load the view
		$data['main_content'] = 'dinas/gedung/read_gedung';
		$this->load->view('dinas/includes/template', $data);
	}

	public function no_gedung($id_wilayah,$id_kepemilikkan,$id_fungsi)
	{
		$table_gedung = 'gedung_dinas';
		$kode1 = $this->dinas_model->get_kodeGdg_byId('tabel_wilayah', 'kode1', 'id', $id_wilayah);
		$kode2 = $this->dinas_model->get_kodeGdg_byId('tabel_kolom_kepemilikkan_gedung', 'kode2', 'id_kepemilikkan_gedung', $id_kepemilikkan);
		$kode3 = $this->dinas_model->get_kodeGdg_byId('tabel_kolom_fungsi_gedung', 'kode3', 'id_fungsi_gedung', $id_fungsi);
		$kode1stPart = $kode1['kode1'].$kode2['kode2'].$kode3['kode3'];
		//$list_noGedung = $this->dinas_model->get_listKodeGdg_by1stPart($table_gedung, $kode1stPart);
		//$kode2ndPart = substr($list_noGedung['no_gedung'], 5);
		//$kode2ndPart = (int)$kode2ndPart + 1;
		$list_noGedung = $this->dinas_model->get_hslPemeriksaan($table_gedung, 'no_gedung');
		$kode2ndPart_array = array();
		foreach($list_noGedung as $row)
		{
			$kode2ndPartExist = substr($row['no_gedung'], 5);
			$kode2ndPartExist = (int)$kode2ndPartExist;
			array_push($kode2ndPart_array, $kode2ndPartExist);
		}
		$max_exist_kode2ndPart = max($kode2ndPart_array);
		$kode2ndPart = $max_exist_kode2ndPart + 1;
		if(strlen($kode2ndPart) ==1)
		{
			$kode2ndPart = '000'.$kode2ndPart;
		}elseif (strlen($kode2ndPart) ==2)
		{
			$kode2ndPart = '00'.$kode2ndPart;
		}elseif (strlen($kode2ndPart) ==3)
		{
			$kode2ndPart = '0'.$kode2ndPart;
		}else
		{
			$kode2ndPart = NULL;
		}
		$noGedung = $kode1stPart.'-'.$kode2ndPart;
		return $noGedung;
	}

	public function add_gedung()
	{
		$this->load->helper('date');
		$table_gedung = 'gedung_dinas';
		$table_fungsi = 'tabel_kolom_fungsi_gedung';
		$table_kepemilikkan = 'tabel_kolom_kepemilikkan_gedung';
		$table_statusGdg = 'tabel_kolom_statusGedung';
		$table_wilayah = 'tabel_wilayah';
		$id_wilayah = $this->dinas_model->get_id_byWilayah($this->input->post('wilayah'));
		//if (is_null(NULL)){$tes = 'kus';}else{$tes = 'wan'; }
		$list_noGedung = $this->dinas_model->get_hslPemeriksaan($table_gedung, 'no_gedung');
		$kode2ndPart_array = array();
		foreach($list_noGedung as $row)
		{
			$kode2ndPart = substr($row['no_gedung'], 5);
			$kode2ndPart = (int)$kode2ndPart;
			array_push($kode2ndPart_array, $kode2ndPart);
		}
		$max_exist_noGdg = max($kode2ndPart_array);
		$data['tes'] = $max_exist_noGdg;
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			//$this->form_validation->set_rules('no_gedung', 'no_gedung', 'required');
			$this->form_validation->set_rules('nama_gedung', 'nama_gedung', 'required');
			$this->form_validation->set_rules('alamat_gedung', 'alamat_gedung', 'required');
			$this->form_validation->set_rules('wilayah', 'wilayah', 'required');
			$this->form_validation->set_rules('fungsi_gedung', 'fungsi', 'required');
			$this->form_validation->set_rules('kepemilikkan_gedung', 'kepemilikan', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				//no_gedung logic
				$id_kepemilikkan = $this->input->post('kepemilikkan_gedung');
				$id_fungsi = $this->input->post('fungsi_gedung');
				$noGedung = $this ->no_gedung($id_wilayah['id'],$id_kepemilikkan,$id_fungsi);
				$userName = $this->ion_auth->user()->row()->username;
				$my_time = date("Y-m-d H:i:s", now('Asia/Jakarta'));
				$data_to_store = array(
					'no_gedung' => $noGedung,
					'nama_gedung' => isZonk($this->input->post('nama_gedung')),
					'alamat_gedung' => isZonk($this->input->post('alamat_gedung')),
					'wilayah' => isZonk($this->input->post('wilayah')),
					'kecamatan' => isZonk($this->input->post('kecamatan')),
					'kelurahan' => isZonk($this->input->post('kelurahan')),
					'kodepos' => isZonk($this->input->post('kodepos')),
					'fungsi' => isZonk($this->input->post('fungsi_gedung')),
					'kepemilikan' => isZonk($this->input->post('kepemilikkan_gedung')),
					'jml_tower' => isZonk($this->input->post('jml_tower')),
					'jml_lantai' => isZonk($this->input->post('jml_lantai')),
					'jml_basement' => isZonk($this->input->post('jml_basement')),
					'tinggi_gedung' => isZonk($this->input->post('tinggi_gedung')),
					'latitude' => isZonk($this->input->post('latitude')),
					'longitude' => isZonk($this->input->post('longitude')),
					'catatan_gedung' => isZonk($this->input->post('catatan_gedung')),
					'created_by' => $userName,
					'create_at' => $my_time
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->add_setting($table_gedung, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'sukses');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('dinas/list_gedung');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$attributeFooter['bootstrapSelect'] = TRUE;
		$attributeFooter['kecamatanKelurahan'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'nama_gedung', 'alamat_gedung', 'wilayah', 'kecamatan', 'kelurahan', 'kodepos', 'fungsi_gedung', 'kepemilikkan_gedung', 'jml_tower', 'jml_lantai', 'jml_basement', 'tinggi_gedung', 'catatan_gedung', 'latitude', 'longitude'
		);
		$data['thead'] = array(
			'Nama Gedung*', 'Alamat*', 'Wilayah*', 'Kecamatan', 'Kelurahan', 'Kodepos','Fungsi*', 'Kepemilikan*', 'Jumlah Tower', 'Jumlah Lantai', 'Jumlah Basement', 'Ketinggian', 'Catatan', 'latitude', 'longitude'
		);
		$data['header'] = 'Tambah Data Gedung';
		$data['contrl_url'] = 'add_gedung';
		$data['cancel_url'] = 'list_gedung';
		$column_fungsi = array ('id_fungsi_gedung', 'fungsi_gedung');
		$data['list_fungsi'] = $this->dinas_model->get_hslPemeriksaan($table_fungsi, $column_fungsi);
		$column_kepemilikkan = array ('id_kepemilikkan_gedung', 'kepemilikkan_gedung');
		$data['list_kepemilikkan'] = $this->dinas_model->get_hslPemeriksaan($table_kepemilikkan, $column_kepemilikkan);
		$column_wilayah = 'Wilayah';
		$data['list_wil'] = $this->dinas_model->get_hslPemeriksaan($table_wilayah, $column_wilayah);
		$data['main_content'] = 'dinas/gedung/add_gedung';
		$this->load->view('dinas/includes/template', $data);
	}

	public function edit_no_gedung($id_wilayah,$id_kepemilikkan,$id_fungsi,$existingKode)
	{
		$table_gedung = 'gedung_dinas';
		$kode1 = $this->dinas_model->get_kodeGdg_byId('tabel_wilayah', 'kode1', 'id', $id_wilayah);
		$kode2 = $this->dinas_model->get_kodeGdg_byId('tabel_kolom_kepemilikkan_gedung', 'kode2', 'id_kepemilikkan_gedung', $id_kepemilikkan);
		$kode3 = $this->dinas_model->get_kodeGdg_byId('tabel_kolom_fungsi_gedung', 'kode3', 'id_fungsi_gedung', $id_fungsi);
		$kode1stPart = $kode1['kode1'].$kode2['kode2'].$kode3['kode3'];
		//$list_noGedung = $this->dinas_model->get_listKodeGdg_by1stPart($table_gedung, $kode1stPart);
		$kode2ndPart = substr($existingKode, 5);
		//$kode2ndPart = (int)$kode2ndPart + 1;
		$noGedung = $kode1stPart.'-'.$kode2ndPart;
		return $noGedung;
	}

	public function edit_gedung()
	{
		$this->load->helper('date');
		$id = $this->uri->segment(3);
		$table_gedung = 'gedung_dinas';
		$table_fungsi = 'tabel_kolom_fungsi_gedung';
		$table_kepemilikkan = 'tabel_kolom_kepemilikkan_gedung';
		$table_statusGdg = 'tabel_kolom_statusGedung';
		$table_wilayah = 'tabel_wilayah';
		$id_wilayah = $this->dinas_model->get_id_byWilayah($this->input->post('wilayah'));
		$id_table = 'id_gdg_dinas';
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('nama_gedung', 'nama_gedung', 'required');
			$this->form_validation->set_rules('alamat_gedung', 'alamat_gedung', 'required');
			$this->form_validation->set_rules('wilayah', 'wilayah', 'required');
			$this->form_validation->set_rules('fungsi_gedung', 'fungsi', 'required');
			$this->form_validation->set_rules('kepemilikkan_gedung', 'kepemilikan', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				//no_gedung logic
				$id_kepemilikkan = $this->input->post('kepemilikkan_gedung');
				$id_fungsi = $this->input->post('fungsi_gedung');
				$existingKode = $this->input->post('no_gedung');
				$noGedung = $this ->edit_no_gedung($id_wilayah['id'],$id_kepemilikkan,$id_fungsi,$existingKode);
				$userName = $this->ion_auth->user()->row()->username;
				$my_time = date("Y-m-d H:i:s", now('Asia/Jakarta'));
				$data_to_store = array(
					'no_gedung' => $noGedung,
					'nama_gedung' => isZonk($this->input->post('nama_gedung')),
					'alamat_gedung' => isZonk($this->input->post('alamat_gedung')),
					'wilayah' => isZonk($this->input->post('wilayah')),
					'kecamatan' => isZonk($this->input->post('kecamatan')),
					'kelurahan' => isZonk($this->input->post('kelurahan')),
					'kodepos' => isZonk($this->input->post('kodepos')),
					'fungsi' => isZonk($this->input->post('fungsi_gedung')),
					'kepemilikan' => isZonk($this->input->post('kepemilikkan_gedung')),
					'jml_tower' => isZonk($this->input->post('jml_tower')),
					'jml_lantai' => isZonk($this->input->post('jml_lantai')),
					'jml_basement' => isZonk($this->input->post('jml_basement')),
					'tinggi_gedung' => isZonk($this->input->post('tinggi_gedung')),
					'latitude' => isZonk($this->input->post('latitude')),
					'longitude' => isZonk($this->input->post('longitude')),
					'catatan_gedung' => isZonk($this->input->post('catatan_gedung')),
					'edit_by' => $userName,
					'edit_at' => $my_time
				);
				//console_log($id);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->update_setting($table_gedung, $id_table, $id, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'updated');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				//redirect('dinas/list_gedung');
				redirect('dinas/read_gedung/'.$id);

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$attributeFooter['bootstrapSelect'] = TRUE;
		$attributeFooter['kecamatanKelurahan'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'nama_gedung', 'alamat_gedung', 'wilayah', 'kecamatan', 'kelurahan', 'kodepos', 'fungsi_gedung', 'kepemilikkan_gedung', 'jml_tower', 'jml_lantai', 'jml_basement', 'tinggi_gedung', 'catatan_gedung', 'latitude', 'longitude', 'no_gedung'
		);
		$data['thead'] = array(
			'Nama Gedung*', 'Alamat*', 'Wilayah*', 'Kecamatan', 'Kelurahan', 'Kodepos','Fungsi*', 'Kepemilikan*', 'Jumlah Tower', 'Jumlah Lantai', 'Jumlah Basement', 'Ketinggian', 'Catatan', 'latitude', 'longitude'
		);
		$data['header'] = 'Edit Data Gedung';
		$data['contrl_url'] = 'edit_gedung';
		$data['cancel_url'] = 'list_gedung';
		$column_fungsi = array ('id_fungsi_gedung', 'fungsi_gedung');
		$data['list_fungsi'] = $this->dinas_model->get_hslPemeriksaan($table_fungsi, $column_fungsi);
		$column_kepemilikkan = array ('id_kepemilikkan_gedung', 'kepemilikkan_gedung');
		$data['list_kepemilikkan'] = $this->dinas_model->get_hslPemeriksaan($table_kepemilikkan, $column_kepemilikkan);
		$column_wilayah = 'Wilayah';
		$data['list_wil'] = $this->dinas_model->get_hslPemeriksaan($table_wilayah, $column_wilayah);
		$data['data_gedung'] = $this->dinas_model->get_list_gedung_byId($table_gedung, $table_fungsi, $table_kepemilikkan, $id_table, $id);
		$data['main_content'] = 'dinas/gedung/edit_gedung';
		$this->load->view('dinas/includes/template', $data);
	}

	public function delete_gedung()
	{
		$id = $this->uri->segment(3);
		$nama_table = 'gedung_dinas';
		$id_table = 'id_gdg_dinas';
		if ($this->dinas_model->hard_delete($nama_table, $id_table, $id)){
			$this->session->set_flashdata('flash_message', 'deleted');
		}
		else{
			$this->session->set_flashdata('flash_message', 'failed');
		}
		redirect('dinas/list_gedung');
	}














	public function database_operation()
	{
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['message']='none';
		$data['main_content'] = 'dinas/database';
		$this->load->view('dinas/includes/template', $data);
	}

	public function jalurInfo_operation()
	{
		$data_jalurInfo = $this->dinas_model->get_migrateData();
		//$count = 0;
		//print_r($data_jalurInfo);
		 
		foreach ($data_jalurInfo as $row)
		{
			$id = $row['id_pemeriksaan_dinas'];
			$jalur_info1 = $row['jalur_info1'];
			if($jalur_info1=='Permintaan Gedung')
			{
				$jalur_info = 1;
			}
			elseif($jalur_info1=='Pemeriksaan DAMKAR')
			{
				$jalur_info = 2;
			}
			else
			{
				$jalur_info = NULL;
			}
			$data_to_store = array(
				'jalur_info' => $jalur_info
			);
			$this->dinas_model->fill_column($id, $data_to_store);
		} 
		redirect('dinas/database_operation');
	}

	public function hasilPemeriksaan_operation()
	{
		$data_pemeriksaan = $this->dinas_model->get_migrateData();		 
		foreach ($data_pemeriksaan as $row)
		{
			$id = $row['id_pemeriksaan_dinas'];
			$hasil_pemeriksaan1 = $row['hasil_pemeriksaan1'];
			if($hasil_pemeriksaan1=='Memenuhi')
			{
				$hasil_pemeriksaan = 1;
			}
			elseif($hasil_pemeriksaan1=='Tidak Memenuhi')
			{
				$hasil_pemeriksaan = 2;
			}
			else
			{
				$hasil_pemeriksaan = NULL;
			}
			$data_to_store = array(
				'hasil_pemeriksaan' => $hasil_pemeriksaan
			);
			$this->dinas_model->fill_column($id, $data_to_store);
		} 
		redirect('dinas/database_operation');
	}

	public function statusGedung_operation()
	{
		$data_pemeriksaan = $this->dinas_model->get_migrateData();		 
		foreach ($data_pemeriksaan as $row)
		{
			$id = $row['id_pemeriksaan_dinas'];
			$status_gedung1 = $row['status_gedung1'];
			if($status_gedung1=='LHP Min')
			{
				$status_gedung = 1;
			}
			elseif($status_gedung1=='LHP Plus')
			{
				$status_gedung = 2;
			}
			elseif($status_gedung1=='Penangguhan SKK')
			{
				$status_gedung = 3;
			}
			elseif($status_gedung1=='Penangguhan SLF')
			{
				$status_gedung = 4;
			}
			elseif($status_gedung1=='Pengawasan')
			{
				$status_gedung = 5;
			}
			elseif($status_gedung1=='SKK')
			{
				$status_gedung = 6;
			}
			elseif($status_gedung1=='SLF')
			{
				$status_gedung = 7;
			}
			elseif($status_gedung1=='SP1')
			{
				$status_gedung = 8;
			}
			elseif($status_gedung1=='SP2')
			{
				$status_gedung = 9;
			}
			elseif($status_gedung1=='SP3')
			{
				$status_gedung = 10;
			}
			else
			{
				$status_gedung = NULL;
			}
			$data_to_store = array(
				'status_gedung' => $status_gedung
			);
			$this->dinas_model->fill_column($id, $data_to_store);
		} 
		redirect('dinas/database_operation');
	}

	public function tglBerlakuExpired_operation()
	{
		$data_pemeriksaan = $this->dinas_model->get_migrateTgl();
		$count = 0;		 
		foreach ($data_pemeriksaan as $row)
		{
			$id = $row['id_pemeriksaan_dinas'];
			$hasil_pemeriksaan1 = $row['tgl_berlaku1'];
			$hasil_pemeriksaan2 = $row['tgl_expired1'];
			$time1 = strtotime($hasil_pemeriksaan1);
			$time2 = strtotime($hasil_pemeriksaan2);
			$time1 = date('Y-m-d',$time1);
			$time2 = date('Y-m-d',$time2);
			$data_to_store = array(
				'tgl_berlaku' => $time1,
				'tgl_expired' => $time2
			);
			$this->dinas_model->fill_column($id, $data_to_store);
		} 
		redirect('dinas/database_operation');
	}

	public function fungsiGedung_operation()
	{
		$nama_table1 ='gedung_dinas';
		$id_table = 'id_gdg_dinas';
		$nama_table2 ='tabel_kolom_fungsi_gedung';
		$data_gedung = $this->dinas_model->get_all_setting($nama_table1);
		$data_fungsiGedung = $this->dinas_model->get_all_setting($nama_table2);
		$count = 0;		 
		foreach ($data_gedung as $gedung)
		{
			$id_gdg = $gedung['id_gdg_dinas'];
			foreach ($data_fungsiGedung as $fungsi)
			{
				$id_fungsi = $fungsi['id_fungsi_gedung'];
				if($gedung['peruntukan']==$fungsi['fungsi_gedung'])
				{
					$data_to_store = array(
						'fungsi' => $id_fungsi
					);
					$this->dinas_model->update_setting($nama_table1, $id_table, $id_gdg, $data_to_store);
				}
			}
		} 
		redirect('dinas/database_operation');
	}
	
	public function kepemilikkan_operation()
	{
		$nama_table1 ='gedung_dinas';
		$id_table = 'id_gdg_dinas';
		$nama_table2 ='tabel_kolom_kepemilikkan_gedung';
		$data_gedung = $this->dinas_model->get_all_setting($nama_table1);
		$data_kepemilikkanGedung = $this->dinas_model->get_all_setting($nama_table2);
		$count = 0;		 
		foreach ($data_gedung as $gedung)
		{
			$id_gdg = $gedung['id_gdg_dinas'];
			foreach ($data_kepemilikkanGedung as $pemilk)
			{
				$id_pemilk = $pemilk['id_kepemilikkan_gedung'];
				if($gedung['kepemilikan1']==$pemilk['kepemilikkan_gedung'])
				{
					$data_to_store = array(
						' 	kepemilikan' => $id_pemilk
					);
					$this->dinas_model->update_setting($nama_table1, $id_table, $id_gdg, $data_to_store);
				}
			}
		} 
		redirect('dinas/database_operation');
	}

	/**
	* Load the main view with all the current model model's data.
	* @return void
	*/
	public function index()
	{
		//load gedung library
		$this->load->library('gedung');
		//all the posts sent by the view
		$search_string = $this->input->get('search_string');
		$search_in = $this->input->get('search_in');
		$order = $this->input->get('order');
		$order_type = $this->input->get('order_type');
		//console_log( var_dump($order_type) );

		//pagination settings
		$config['per_page'] = $this->per_page;
		$config['base_url'] = base_url().'prainspeksi_gedung/index';

		//limit end
		$page = $this->uri->segment(3);

		//use gedung lib untuk paginasi
		$data = $this->gedung->list_gedung($search_string, $search_in, $order, $order_type, $this->uri->segment(3), $config['per_page']);

		$config['total_rows'] = $data['count_gedungs'];

		//initializate the panination helper
		$this->pagination->initialize($config);

		//load the view
		$data['main_content'] = 'prainspeksi/gedung/list';
		$this->load->view('prainspeksi/includes/template', $data);

	}//index

	public function add()
	{
		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{

			//form validation
			$this->form_validation->set_rules('NamaGedung', 'NamaGedung', 'required');
			$this->form_validation->set_rules('Alamat', 'Alamat', 'required');
			$this->form_validation->set_rules('Status', 'Status', 'required');
			$this->form_validation->set_rules('Fungsi', 'Fungsi', 'required');
			$this->form_validation->set_rules('JmlMasaBang', 'JmlMasaBang', 'required');
			$this->form_validation->set_rules('Lantai', 'Lantai', 'required');
			$this->form_validation->set_rules('Basement', 'Basement', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

			//$tglImb = $this->input->post('TglImb');
			//$tgl_imb = date('Y-m-d',strtotime("$tglImb"));


			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'NamaGedung' => $this->input->post('NamaGedung'),
					'Alamat' => $this->input->post('Alamat'),
					'Kecamatan' => $this->input->post('Kecamatan'),
					'Kelurahan' => $this->input->post('Kelurahan'),
					'Wilayah' => $this->input->post('Wilayah'),
					'KodePos' => $this->input->post('KodePos'),
					'NoImb' => $this->input->post('NoImb'),
					'TglImb' => htmlDate2sqlDate($this->input->post('TglImb')),
					'NoRekomtekAkhir' => $this->input->post('NoRekomtekAkhir'),
					'TglRekomtekAkhir' => htmlDate2sqlDate($this->input->post('TglRekomtekAkhir')),
					'NoSlfAkhir' => $this->input->post('NoSlfAkhir'),
					'TglSlfAkhir' => htmlDate2sqlDate($this->input->post('TglSlfAkhir')),
					'NoSkkAkhir' => $this->input->post('NoSkkAkhir'),
					'TglSkkAkhir' => htmlDate2sqlDate($this->input->post('TglSkkAkhir')),
					'NoLhp' => $this->input->post('NoLhp'),
					'TglLhp' => htmlDate2sqlDate($this->input->post('TglLhp')),
					'Status' => $this->input->post('Status'),
					'Fungsi' => $this->input->post('Fungsi'),
					'JmlMasaBang' => $this->input->post('JmlMasaBang'),
					'Lantai' => $this->input->post('Lantai'),
					'LuasLantai' => $this->input->post('LuasLantai'),
					'Basement' => $this->input->post('Basement'),
					'Keterangan' => $this->input->post('Keterangan')
				);
				//if the insert has returned true then we show the flash message
				if($this->gedung_model->store_gedung($data_to_store)){
					//$data['flash_message'] = TRUE;
					$this->session->set_flashdata('flash_message', 'added');
					$per_page = $this->per_page;
					$num_buiding = $this->gedung_model->count_gedung();
					$page = ceil($num_buiding/$per_page);
					redirect('Prainspeksi_gedung/index/'.$page.'');
				}else{
					$data['flash_message'] = FALSE;
				}

			}

		}
		//load the view
		$data['main_content'] = 'prainspeksi/gedung/add';
		$this->load->view('prainspeksi/includes/template', $data);
	}

	/**
	* Update item by his id
	* @return void
	*/
	public function update()
	{
		//product id
		$id = $this->uri->segment(3);

		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('NamaGedung', 'NamaGedung', 'required');
			$this->form_validation->set_rules('Alamat', 'Alamat', 'required');
			$this->form_validation->set_rules('Status', 'Status', 'required');
			$this->form_validation->set_rules('Fungsi', 'Fungsi', 'required');
			$this->form_validation->set_rules('JmlMasaBang', 'JmlMasaBang', 'required');
			$this->form_validation->set_rules('Lantai', 'Lantai', 'required');
			$this->form_validation->set_rules('Basement', 'Basement', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{

				$data_to_store = array(
					'NamaGedung' => $this->input->post('NamaGedung'),
					'Alamat' => $this->input->post('Alamat'),
					'Kecamatan' => $this->input->post('Kecamatan'),
					'Kelurahan' => $this->input->post('Kelurahan'),
					'Wilayah' => $this->input->post('Wilayah'),
					'KodePos' => $this->input->post('KodePos'),
					'NoImb' => $this->input->post('NoImb'),
					'TglImb' => htmlDate2sqlDate($this->input->post('TglImb')),
					'NoRekomtekAkhir' => $this->input->post('NoRekomtekAkhir'),
					'TglRekomtekAkhir' => htmlDate2sqlDate($this->input->post('TglRekomtekAkhir')),
					'NoSlfAkhir' => $this->input->post('NoSlfAkhir'),
					'TglSlfAkhir' => htmlDate2sqlDate($this->input->post('TglSlfAkhir')),
					'NoSkkAkhir' => $this->input->post('NoSkkAkhir'),
					'TglSkkAkhir' => htmlDate2sqlDate($this->input->post('TglSkkAkhir')),
					'NoLhp' => $this->input->post('NoLhp'),
					'TglLhp' => htmlDate2sqlDate($this->input->post('TglLhp')),
					'Status' => $this->input->post('Status'),
					'Fungsi' => $this->input->post('Fungsi'),
					'JmlMasaBang' => $this->input->post('JmlMasaBang'),
					'Lantai' => $this->input->post('Lantai'),
					'LuasLantai' => $this->input->post('LuasLantai'),
					'Basement' => $this->input->post('Basement'),
					'Keterangan' => $this->input->post('Keterangan')
				);
				//if the insert has returned true then we show the flash message
				if($this->gedung_model->update_gedung($id, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'updated');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}

				// next page setup
				if (strlen($_SESSION['search_string_selected'])==0){
					$next_page = $_SESSION['hal_skr'];
				} else {
					$next_page = ''.$_SESSION['hal_skr'].'?search_string='.$_SESSION['search_string_selected'].'&search_in='.$_SESSION['search_in_field'].'&order='.$_SESSION['order'].'&order_type='.$_SESSION['order_type'].'';
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect($next_page);

			}//validation run

		}

		//if we are updating, and the data did not pass trough the validation
		//the code below wel reload the current data

		//product data
		$data['gedungs'] = $this->gedung_model->get_gedung_by_id($id);
		//load the view
		$data['main_content'] = 'prainspeksi/gedung/edit';
		$this->load->view('prainspeksi/includes/template', $data);

	}//update

	/**
	* Delete product by his id
	* @return void
	*/
	public function delete()
	{
		//product id
		$id = $this->uri->segment(3);
		$this->gedung_model->delete_gedung($id);
		// page setup
		if (strlen($_SESSION['search_string_selected'])==0){
			$next_page = $_SESSION['hal_skr'];
		} else {
			$next_page = ''.$_SESSION['hal_skr'].'?search_string='.$_SESSION['search_string_selected'].'&search_in='.$_SESSION['search_in_field'].'&order='.$_SESSION['order'].'&order_type='.$_SESSION['order_type'].'';
		}
		redirect($next_page);
		//redirect('prainspeksi/gedung');
	}//delete

	public function tutorial()
	{
		$this->load->view('prainspeksi/includes/header');
		$this->load->view('prainspeksi/tutorial');
		$this->load->view('prainspeksi/includes/footer');
	}

	public function bagi()
	{
		$pokja = array('udiyono', 'bambang', 'miyanto', 'sidik', 'suparman');
		$stack = array();
		for ($i = 0; $i <= 4; $i++){
			$daftarGedung = $this->gedung_model->get_gedung_pokja($pokja[$i]);
			foreach($daftarGedung as $gedung)
			{
				//$var = $this->gedung_model->find_gedung_pokja($search_string);
				if($this->gedung_model->find_gedung_pokja($gedung[$pokja[$i]]) == TRUE){
					$id = $this->gedung_model->find_gedung_pokja($gedung[$pokja[$i]]);
					$data_to_update = array('inspector' => $pokja[$i]);
					$this->gedung_model->update_gedung($id[0]['id'], $data_to_update);
				}else{
					$array = array('pokja' => $pokja[$i], 'gedung' => $gedung[$pokja[$i]]);
					array_push($stack, $array);
				}
			}
		}
		$data['stack'] = $stack;
		$data['main_content'] = 'prainspeksi/gedung/pembagianGedung';
		$this->load->view('prainspeksi/includes/template', $data);
	}

	public function loadData()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];
		//$this->load->model('model');
		$result=$this->pelengkap_model->getData($loadType,$loadId);
		$HTML=null;

		if($loadType=='kodepos'){
			foreach($result->result() as $list){
				$HTML.="".$list->name.""; }
			}
		else if($result->num_rows() > 0){
			foreach($result->result() as $list){
				$HTML.="<option value='".$list->name."'>".$list->name."</option>";
			}
		}
		echo $HTML;
	}

}
