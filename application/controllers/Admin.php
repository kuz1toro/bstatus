<?php
class Admin extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin';

    var $attributeFooter = array(
        'chartJS' => FALSE,
        'highcharts' => FALSE,
        'dataTable' => FALSE,
        'JqueryValidation' => FALSE,
        'bootstrapSelect' => FALSE,
        'datetimePicker' => FALSE,
        'kecamatanKelurahan' => FALSE,
        'ckeEditorBasic' => FALSE,
        'jspdf' => FALSE,
        'bootstrapNotify' => FALSE,
        'mapLeaflet' => FALSE
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
		$this->load->model('ion_auth_model');
        $this->load->library(array('ion_auth','form_validation'));
        //$this->config->load('pagination', TRUE);
        $this->load->helper('site_helper');
        $this->load->helper('kint');
        ini_set('max_execution_time', 300);

        if ( ! $this->ion_auth->in_group('admin'))
        {
            redirect('auth/login');
        }
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
		$data['main_content'] = 'admin/setting_input/list_setting';
		$this->load->view('admin/includes/template', $data);
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
				redirect('admin/list_jalurInfo');

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
		$data['main_content'] = 'admin/setting_input/edit_setting';
		$this->load->view('admin/includes/template', $data);
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
		redirect('admin/list_jalurInfo');
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
				redirect('admin/list_jalurInfo');

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
		$data['main_content'] = 'admin/setting_input/add_setting';
		$this->load->view('admin/includes/template', $data);
	}


    public function list_fungsiGedung()
	{
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['thead'] = array(
			'No','Fungsi Gedung', 'Kode', 'Keterangan', 'Aksi'
		);
		$data['dhead'] = array(
			'fungsi_gedung', 'kode3', 'keterangan_fungsiGdg'
		);
		$data['id_table'] = 'id_fungsi_gedung';
		$data['header'] = 'Daftar Fungsi Gedung';
		$data['edit_url'] = 'edit_fungsiGedung';
		$data['delete_url'] = 'delete_fungsiGedung';
		$data['add_url'] = 'add_fungsiGedung';
		$nama_table = 'tabel_kolom_fungsi_gedung';
		$data['data_jalurInfo'] = $this->dinas_model->get_all_setting($nama_table);
		$data['main_content'] = 'admin/setting_input/list_setting_fungsi';
		$this->load->view('admin/includes/template', $data);
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
			$this->form_validation->set_rules('kode3', 'kode3', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'fungsi_gedung' => $this->input->post('fungsi_gedung'),
					'kode3' => $this->input->post('kode3'),
					'keterangan_fungsiGdg' => $this->input->post('keterangan_fungsiGdg')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->update_setting($nama_table, $id_table, $id, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'updated');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('admin/list_fungsiGedung');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'fungsi_gedung', 'kode3', 'keterangan_fungsiGdg'
		);
		$data['thead'] = array(
			'Fungsi Gedung', 'Kode', 'Keterangan'
		);
		$data['header'] = 'Edit Fungsi Gedung';
		$data['contrl_url'] = 'edit_fungsiGedung';
		$data['cancel_url'] = 'list_fungsiGedung';
		$data['data_jalurInfo'] = $this->dinas_model->get_setting_byId($nama_table, $id_table, $id);
		$data['main_content'] = 'admin/setting_input/edit_setting_fungsi';
		$this->load->view('admin/includes/template', $data);
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
					'kode3' => $this->input->post('kode3'),
					'keterangan_fungsiGdg' => $this->input->post('keterangan_fungsiGdg')
				);
				//if the insert has returned true then we show the flash message
				if($this->dinas_model->add_setting($nama_table, $data_to_store)){
					$this->session->set_flashdata('flash_message', 'sukses');
				}else{
					$this->session->set_flashdata('flash_message', 'failed');
				}

				//redirect('Prainspeksi_gedung/update/'.$id.'');
				redirect('admin/list_fungsiGedung');

			}//validation run

		}
		$attributeFooter = $this->attributeFooter;
		$attributeFooter['JqueryValidation'] = TRUE;
		$data['attributeFooter'] = $attributeFooter;
		$data['dhead'] = array(
			'fungsi_gedung', 'kode3', 'keterangan_fungsiGdg'
		);
		$data['thead'] = array(
			'Fungsi Gedung', 'Kode', 'Keterangan'
		);
		$data['header'] = 'Tambah Fungsi Gedung';
		$data['contrl_url'] = 'add_fungsiGedung';
		$data['cancel_url'] = 'list_fungsiGedung';
		$data['main_content'] = 'admin/setting_input/add_setting';
		$this->load->view('admin/includes/template', $data);
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
		redirect('admin/list_fungsiGedung');
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
		$data['main_content'] = 'admin/setting_input/list_setting';
		$this->load->view('admin/includes/template', $data);
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
				redirect('admin/list_kepemilknGedung');

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
		$data['main_content'] = 'admin/setting_input/edit_setting';
		$this->load->view('admin/includes/template', $data);
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
				redirect('admin/list_kepemilknGedung');

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
		$data['main_content'] = 'admin/setting_input/add_setting';
		$this->load->view('admin/includes/template', $data);
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
		redirect('admin/list_fungsiGedung');
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
		$data['main_content'] = 'admin/setting_input/list_setting';
		$this->load->view('admin/includes/template', $data);
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
				redirect('admin/list_hslPemeriksaan');

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
		$data['main_content'] = 'admin/setting_input/edit_setting';
		$this->load->view('admin/includes/template', $data);
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
		redirect('admin/list_hslPemeriksaan');
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
				redirect('admin/list_hslPemeriksaan');

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
		$data['main_content'] = 'admin/setting_input/add_setting';
		$this->load->view('admin/includes/template', $data);
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
		$data['main_content'] = 'admin/setting_input/list_setting';
		$this->load->view('admin/includes/template', $data);
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
				redirect('admin/list_statusGedung');

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
		$data['main_content'] = 'admin/setting_input/edit_setting_statGedung';
		$this->load->view('admin/includes/template', $data);
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
		redirect('admin/list_statusGedung');
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
				redirect('admin/list_statusGedung');
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
		$data['main_content'] = 'admin/setting_input/add_setting_statGedung';
		$this->load->view('admin/includes/template', $data);
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
		$data['main_content'] = 'admin/setting_input/list_setting';
		$this->load->view('admin/includes/template', $data);
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
				redirect('admin/list_penyebabFire');

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
		$data['main_content'] = 'admin/setting_input/edit_setting';
		$this->load->view('admin/includes/template', $data);
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
		redirect('admin/list_penyebabFire');
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
				redirect('admin/list_penyebabFire');

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
		$data['main_content'] = 'admin/setting_input/add_setting';
		$this->load->view('admin/includes/template', $data);
    }
    
    /* DATABASE OPERATION */


    

	public function database_operation()
	{
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['message']='none';
		$data['main_content'] = 'admin/database';
		$this->load->view('admin/includes/template', $data);
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
		redirect('admin/database_operation');
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
		redirect('admin/database_operation');
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
		redirect('admin/database_operation');
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
		redirect('admin/database_operation');
	}

	public function fungsiGedung_operation()
	{
		$nama_table1 =$this->config->item('nama_tabel_gedung');
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
		redirect('admin/database_operation');
	}
	
	public function kepemilikkan_operation()
	{
		$nama_table1 =$this->config->item('nama_tabel_gedung');
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
		redirect('admin/database_operation');
    }
    
    
	public function rubahKodeStatusGdg_operation()
	{
		$data_statusGedung = $this->dinas_model->get_statusGedung();		 
		foreach ($data_statusGedung as $row)
		{
			$id = $row['id_gdg_dinas'];
			$old_status = $row['last_status'];
			if($old_status==7)
			{
				$new_status = 1;
			}
			elseif($old_status==6)
			{
				$new_status = 2;
			}
			elseif($old_status==2)
			{
				$new_status = 3;
			}
			elseif($old_status==1)
			{
				$new_status = 4;
			}
			elseif($old_status==8)
			{
				$new_status = 5;
			}
			elseif($old_status==9)
			{
				$new_status = 6;
			}
			elseif($old_status==10)
			{
				$new_status = 7;
			}
			elseif($old_status==3)
			{
				$new_status = 9;
			}
			elseif($old_status==4)
			{
				$new_status = 10;
			}
			elseif($old_status==5)
			{
				$new_status = 11;
			}
			else
			{
				$new_status = NULL;
			}
			$data_to_store = array(
				'last_status' => $new_status
			);
			$this->dinas_model->fill_gdg($id, $data_to_store);
		} 
		$data_statusPemeriksaan = $this->dinas_model->get_statusPemeriksaan();		 
		foreach ($data_statusPemeriksaan as $rowP)
		{
			$idP = $rowP['id_pemeriksaan_dinas'];
			$old_status = $rowP['status_gedung'];
			if($old_status==7)
			{
				$new_status = 1;
			}
			elseif($old_status==6)
			{
				$new_status = 2;
			}
			elseif($old_status==2)
			{
				$new_status = 3;
			}
			elseif($old_status==1)
			{
				$new_status = 4;
			}
			elseif($old_status==8)
			{
				$new_status = 5;
			}
			elseif($old_status==9)
			{
				$new_status = 6;
			}
			elseif($old_status==10)
			{
				$new_status = 7;
			}
			elseif($old_status==3)
			{
				$new_status = 9;
			}
			elseif($old_status==4)
			{
				$new_status = 10;
			}
			elseif($old_status==5)
			{
				$new_status = 11;
			}
			else
			{
				$new_status = NULL;
			}
			$data_to_storeP = array(
				'status_gedung' => $new_status
			);
			$this->dinas_model->fill_column($idP, $data_to_storeP);
		}
		redirect('admin/database_operation');
	}
	/*
	public function rubahKodeStatusGdg_operation1()
	{
		$data_statusGedung = $this->dinas_model->get_statusGedung();		 
		foreach ($data_statusGedung as $row)
		{
			$id = $row['id_gdg_dinas'];
			$old_status = $row['last_status'];
			if($old_status==8)
			{
				$new_status = 9;
			}
			elseif($old_status==9)
			{
				$new_status = 10;
			}
			elseif($old_status==10)
			{
				$new_status = 11;
			}
			$data_to_store = array(
				'last_status' => $new_status
			);
			if($old_status==8 || $old_status==9 || $old_status==10)
			{
				$this->dinas_model->fill_gdg($id, $data_to_store);
			}
		} 
		$data_statusPemeriksaan = $this->dinas_model->get_statusPemeriksaan();		 
		foreach ($data_statusPemeriksaan as $rowP)
		{
			$idP = $rowP['id_pemeriksaan_dinas'];
			$old_status = $rowP['status_gedung'];
			if($old_status==8)
			{
				$new_status = 9;
			}
			elseif($old_status==9)
			{
				$new_status = 10;
			}
			elseif($old_status==10)
			{
				$new_status = 11;
			}
			$data_to_storeP = array(
				'status_gedung' => $new_status
			);
			if($old_status==8 || $old_status==9 || $old_status==10)
			{
				$this->dinas_model->fill_column($idP, $data_to_storeP);
			}
		}
		redirect('admin/database_operation');
	}
	*/

	public function fillid_gdg_dinas()
	{
		$noGdgs = $this->dinas_model->getNoGdgDkGdg();
		$i = 0;
		foreach($noGdgs as $noGdg)
		{
			$nama_table = 'dk_data_gedung';
			$id_table = 'no_gedung';
			$id = $noGdg['no_gedung'];
			$data = array( 'id_gdg_dinas' => $i);
			$this->dinas_model->update_setting($nama_table, $id_table, $id, $data);
			$i++;
		}
		redirect('admin/database_operation');
	}

	public function copyDkGdgToGdgDinas()
	{
		$dkGdgs = $this->dinas_model->getAllGdgDkGdg();
		foreach($dkGdgs as $dkGdg)
		{
			$nama_table = 'gedung_dinas_new';
			$data = array( 
				'no_gedung' => $dkGdg['no_gedung'],
				'nama_gedung' => $dkGdg['nama_gedung'],
				'alamat_gedung' => $dkGdg['alamat_gedung'],
				'wilayah' => $dkGdg['id_wilayah'],
				'kecamatan' => $dkGdg['id_kecamatan'],
				'kelurahan' => $dkGdg['id_kelurahan'],
				'kodeKelurahan' => $dkGdg['kodeKelurahan'],
				'peruntukan' => $dkGdg['id_peruntukan'],
				'kepemilikan1' => $dkGdg['id_kepemilikan'],
				'jml_lantai' => $dkGdg['jml_lantai'],
				'jml_basement' => $dkGdg['jml_basement'],
				'latitude' => $dkGdg['latitude'],
				'longitude' => $dkGdg['longitude'],
				'link_location' => $dkGdg['link_location']
			);
			$this->dinas_model->add_setting($nama_table, $data);
		}
		redirect('admin/database_operation');
	}

	public function updateGdgDinas()
	{
		$fungsi = array( 
			'01' => 1,
			'02' => 2,
			'03' => 3,
			'04' => 4,
			'11' => 5,
			'12' => 6,
			'13' => 7,
			'14' => 8,
			'21' => 9,
			'22' => 10,
			'23' => 11
		);
		$kepemilik = array( 
			'D' => 1,
			'P' => 2,
			'S' => 3
		);
		$dkGdgs = $this->dinas_model->getAllGdgDkGdg('gedung_dinas_new');
		$nama_table = 'gedung_dinas_new';
		$id_table = 'id_gdg_dinas';
		$success = 0;
		foreach($dkGdgs as $dkGdg)
		{
			if (array_key_exists($dkGdg['peruntukan'], $fungsi) && array_key_exists($dkGdg['kepemilikan1'], $kepemilik) )
			{
				$id = $dkGdg['id_gdg_dinas'];
				$data = array( 	'fungsi' => $fungsi[$dkGdg['peruntukan']],
								'kepemilikan' => $kepemilik[$dkGdg['kepemilikan1']]
				);
				if ( $this->dinas_model->update_setting($nama_table, $id_table, $id, $data))
				{
					$success++;
				}
			}
		}

		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['message']= $success;
		$data['main_content'] = 'admin/database';
		$this->load->view('admin/includes/template', $data);
	}
	

	public function copyDkPmrToPmrDinas()
	{
		$tblGdg = 'dk_data_pemeriksaan';
		$nama_table = 'pemeriksaan_dinas_ng';
		$dkpmrs = $this->dinas_model->getAllGdgDkGdg($tblGdg);
		foreach($dkpmrs as $dkGdg)
		{
			$data = array( 
				'no_gedungP' => $dkGdg['no_gedung'],
				'jalur_info1' => $dkGdg['jalur_informasi'],
				'hasil_pemeriksaan1' => $dkGdg['hasil_pemeriksaan'],
				'status_gedung1' => $dkGdg['status_gedung'],
				'tgl_berlaku' => $dkGdg['mulai_berlaku'],
				'tgl_expired' => $dkGdg['sampai_dengan'],
				'catatan' => $dkGdg['catatan'],
				'created_atP' => $dkGdg['created_date'],
				'edit_atP' => $dkGdg['updated_date']
			);
			$this->dinas_model->add_setting($nama_table, $data);
		}
		redirect('admin/database_operation');
	}

	public function updatePmrDinas()
	{
		$listJlrInfo = array( 
			'pemeriksaan' => 2,
			'permintaan' => 1
		);
		$hslPemrks = array( 
			'memenuhi' => 1,
			'tidak_memenuhi' => 2
		);
		$statusGdg = array( 
			'LHP_min' => 4,
			'LHP_plus' => 3,
			'penangguhan_SKK' => 9,
			'penangguhan_SLF' => 10,
			'pengawasan' => 11,
			'SKK' => 2,
			'SLF' => 1,
			'SP1' => 5,
			'SP2' => 6,
			'SP3' => 7,
			'SP4' => 8
		);
		$listStatP = $this->dinas_model->getStatP();
		$nama_table = 'pemeriksaan_dinas_ng';
		$id_table = 'id_pemeriksaan_dinas';
		$success = 0;
		foreach($listStatP as $stat)
		{
			if (array_key_exists($stat['jalur_info1'], $listJlrInfo) && array_key_exists($stat['hasil_pemeriksaan1'], $hslPemrks) && array_key_exists($stat['status_gedung1'], $statusGdg))
			{
				$id = $stat['id_pemeriksaan_dinas'];
				$data = array( 	'jalur_info' => $listJlrInfo[$stat['jalur_info1']],
								'hasil_pemeriksaan' => $hslPemrks[$stat['hasil_pemeriksaan1']],
								'status_gedung' => $statusGdg[$stat['status_gedung1']],
				);
				if ( $this->dinas_model->update_setting($nama_table, $id_table, $id, $data))
				{
					$success++;
				}
			}
		}
		$attributeFooter = $this->attributeFooter;
		$data['attributeFooter'] = $attributeFooter;
		$data['message']= $success;
		$data['main_content'] = 'admin/database';
		$this->load->view('admin/includes/template', $data);
	}














    public function bagi()
	{
		$pokja = array('udiyono', 'bambang', 'miyanto', 'sidik', 'suparman');
		$pokjaNew = array(1, 2, 3, 4, 5);
		$stack = array();
		for ($i = 0; $i <= 4; $i++){
			$daftarGedung = $this->gedung_model->get_gedung_pokja($pokja[$i]);
			foreach($daftarGedung as $gedung)
			{
				//$var = $this->gedung_model->find_gedung_pokja($search_string);
				if($this->gedung_model->find_gedung_pokja($gedung[$pokja[$i]]) == TRUE){
					$id = $this->gedung_model->find_gedung_pokja($gedung[$pokja[$i]]);
					$data_to_update = array('pokja' => $pokjaNew[$i]);
					$this->gedung_model->update_gedung($id[0]['id_gdg_dinas'], $data_to_update);
				}else{
					$array = array('pokja' => $pokja[$i], 'gedung' => $gedung[$pokja[$i]]);
					array_push($stack, $array);
				}
			}
		}
		//$data['stack'] = $stack;
		//$data['main_content'] = 'prainspeksi/gedung/pembagianGedung';
		//$this->load->view('prainspeksi/includes/template', $data);
	}






















































































    public function import(){
        $path = 'xml/tes.html';
        //$files = glob('xml/*.{html}', GLOB_BRACE);
        $imported_arr = $this->import_from_word($path);
        $key_val_arr = $imported_arr['key_val_array1'] ;
        $result_arr = $imported_arr['result_arr'] ;
        $result_ujicoba_arr = $imported_arr['result_ujicoba'] ;
        $main_result_arr = $this->main_data_imported($result_arr, $result_ujicoba_arr);

        //$data['data'] = $imported_arr['result_arr'];
        $data['data'] = $result_ujicoba_arr;
        $data['main_content'] = 'admin/import_from_msword';
        $this->load->view('admin/includes/template', $data);
    }

    public function save_imported()
    {
        $files = glob('xhtml/*.{xhtml}', GLOB_BRACE);
        $keys = array('nama bangunan', 'pengelola', 'alamat', 'klasifikasi bangunan', 'tinggi bangunan', 'luas bangunan', 'luas total', 'penggunaan bangunan', 'imb', 'sertifikat keselamatan kebakaran', 'klasifikasi sistem', 'tanggal', 'mkkg', 'sistem pipa tegak dan slang kebakaran', 'sistem springkler', 'sistem deteksi', 'komunikasi darurat', 'pencahayaan darurat', 'kipas penekan asap', 'lif kebakaran', 'kepala dinas');
        $save_log = array();
        foreach($files as $file) {
            $imported_arr = $this->import_from_word($file);
            $key_val_arr = $imported_arr['key_val_array1'] ;
            $result_arr = $imported_arr['result_arr'] ;
            $result_ujicoba_arr = $imported_arr['result_ujicoba'] ;
            $main_result_arr = $this->main_data_imported($result_arr, $result_ujicoba_arr);

            foreach ($keys as $key) {
                if (!isset($main_result_arr[$key])) {
                    $main_result_arr[$key] = '' ;
                }
            }
            
            $data_to_store = array(
                'nama_bangunan' => $main_result_arr['nama bangunan'],
                'pengelola' => $main_result_arr['pengelola'],
                'alamat' => $main_result_arr['alamat'],
                'klasif_bang' => $main_result_arr['klasifikasi bangunan'],
                'tinggi_bang' => $main_result_arr['tinggi bangunan'],
                'luas_bang' => $main_result_arr['luas bangunan'],
                'luas_total' => $main_result_arr['luas total'],
                'penggunaan' => $main_result_arr['penggunaan bangunan'],
                'no_imb' => $main_result_arr['imb'],
                'no_sertikat' => $main_result_arr['sertifikat keselamatan kebakaran'],
                'klasif_sistem' => $main_result_arr['klasifikasi sistem'],
                'tanggal' => $main_result_arr['tanggal'],
                'mkkg' => $main_result_arr['mkkg'],
                'sis_pipa_tegak' => $main_result_arr['sistem pipa tegak dan slang kebakaran'],
                'sis_springkler' => $main_result_arr['sistem springkler'],
                'sis_deteksi' => $main_result_arr['sistem deteksi'],
                'komunikasi' => $main_result_arr['komunikasi darurat'],
                'pencahayaan' => $main_result_arr['pencahayaan darurat'],
                'press_fan' => $main_result_arr['kipas penekan asap'],
                'lift_fire' => $main_result_arr['lif kebakaran'],
                'kadis' => $main_result_arr['kepala dinas'],

                'key_val_arr' => json_encode($key_val_arr),
                'result_arr' => json_encode($result_arr),
                'result_ujicoba_arr' => json_encode($result_ujicoba_arr)
            );
            if($this->admin_model->store_imported_data($data_to_store)){
                $message = $file.' => Sukses di simpan' ;
                array_push($save_log, $message);
            }else{
                $message = $file.' => Gagal di simpan' ;
                array_push($save_log, $message);
            }

        }

        $data['data'] = $save_log;
        $data['main_content'] = 'admin/import_from_msword';
        $this->load->view('admin/includes/template', $data);

    }

    public function import_from_word($path)
    {
        $xmlReader = new XMLReader();
        $xmlReader->open($path);
        $lap_ins = array();
        $ori = array();
        $ori1 = array();
        $i=0;
        $temp = 'kuswantoro';
        $temp2= 'dsdsadadwede';
        while($xmlReader->read()) {
            if($xmlReader->nodeType == XMLReader::ELEMENT) {
                if($xmlReader->localName == 'span') {
                    $xmlReader->read();
                    //delete spasi
                    $first = preg_replace('/\s+/u', ' ', $xmlReader->value);
                    $output = preg_replace('/^\W*/iu', '', $first);
                    //$output = preg_replace('/^\s+/u', '', $output);
                    $output = preg_replace('/\s*$/u', '', $output);
                    $output = preg_replace('/^\-+/u', '', $output);
                    $output = preg_replace('/[:;.(]$/u', '', $output);
                    $output = preg_replace('/\W{3,}$/u', '', $output);
                    $output = preg_replace('/^[a-z]{2}\.\w\.\w\W+|^[a-z]{3}\.\W*|^[a-z]{2}\.\W*|^\w\.(?!\d)|^\=\s/iu', '', $output);
                    $output = preg_replace('/^ii|^iii|^iv|^vi|^vii|^viii/iu', '', $output);
                    $output1 = preg_replace('/^\w\s+/iu', '', $output);
                    //filter empty element
                    $ori1[$i] =$output1;
                    if(!empty($output1) && !is_null($output1) && strlen($output1)>1 ){
                        //filter duplicate element
                        $comp1 = preg_replace('/\W/u', '', $output1);
                        $temp1 = preg_replace('/\W/u', '', $temp);
                        if (preg_match('/^\W*'.$temp1.'\s*\W*/iu', $comp1)){
                            if (strlen($comp1)==strlen($temp1)) {
                                $not_d = FALSE;
                            }
                        }else {
                            $not_d = TRUE;
                        }
                        if($not_d){
                            $lap_ins[$i]['span'] = $output1;
                            $temp = $output1;
                        }
                    }
                    if(!empty($first) && !is_null($first) && strlen($first)>1 ){
                        //filter duplicate element
                        $comp1 = preg_replace('/\W/u', '', $first);
                        $temp1 = preg_replace('/\W/u', '', $temp2);
                        if (stripos($comp1, $temp1) !== false) {
                            $not_d = FALSE;
                        }else {
                            $not_d = TRUE;
                        }
                        if($not_d){
                            $ori[$i] = $first;
                            $temp2 = $first;
                        }
                    }
                }
                $i++;
            }
        }
        //d($lap_ins);
        //!d($ori1);
        //console_log(count($lap_ins));
        //$val_array = $lap_ins;
        //remove key from val_array
        $myRegex = array( 'sambungan dinas pemadam kebakaran', 'data bangunan', 'nama bangunan', 'pengelola', 'klasifikasi bangunan', 'tinggi bangunan', 'luas bangunan', 'luas total', 'penggunaan bangunan', 'konstruksi bangunan', 'sistem pasokan daya listrik', 'sistem pasokan daya darurat', 'nomor imb', 'imb', 'ipb', 'rekomendasi dinas', 'kmb', 'slf', 'sertifikat keselamatan kebakaran', 'sistem proteksi kebakaran', 'sistem pipa tegak dan slang Kebakaran serta Hidran Kebakaran', 'sistem pipa tegak', 'data air', 'data pompa', 'operasi pompa', 'diameter perpipaan', 'hidran gedung', 'kopling pasukan dinas pemadam kebakaran', 'hidran halaman', 'sambungan dinas', 'siamesse connection', 'sistem springkler otomatis', 'klasifikasi sistem', 'diameter perpipaan', 'katup kendali utama', 'kepala springkler','flow switch & kran pengetesan' ,'sistem deteksi dan alarm kebakaran' ,'panel kontrol' ,'detektor' ,'detektor panas' , 'detektor asap', 'titik panggil' ,'komunikasi darurat' ,'alat pemadam api ringan' ,'sarana penyelamatan jiwa' ,'tangga kebakaran' ,'sistem pengendali asap' ,'kipas penekan asap' ,'kipas penghisap udara' ,'penunjuk arah darurat' ,'exit sign' ,'pencahayaan darurat' ,'lif kebakaran' ,'manajemen keselamatan kebakaran gedung' ,'akses pemadam kebakaran' ,'hasil uji coba' ,'sistem pipa tegak dan slang kebakaran' ,'sistem springkler' ,'sistem deteksi' ,'komunikasi darurat' ,'pencahayaan darurat' ,'kipas penekan asap' ,'lif kebakaran' ,'catatan' ,'kepala dinas');
        $sub_regex = array('kerangka', 'dinding', 'atap', 'sumber air', 'volume reservoir', 'merk\/tipe', 'kapasitas', 'total head', 'penggerak', 'sistem pengisapan', 'penempatan', 'tekanan statis', 'stand by tekanan', 'hidup', 'mati', 'pipa hisap', 'pipa penyalur', 'pipa tegak', 'jumlah titik', 'ketahanan api', 'diameter keluaran', 'pompa pacu', 'pompa utama', 'pompa cadangan', 'kelengkapan', 'jarak antar titik', 'temperatur kerja', 'jenis kopling', 'diameter masukan', 'pipa pembagi', 'pipa cabang', 'diameter', 'sistem hisap', 'volume ruangan', 'temperatur', 'jarak antar', 'tekanan', 'daya listrik', 'warna', 'sumber daya', 'jumlah akses', 'lebar akses', 'jumlah zone', 'jumlah nozzle', 'muara tangga', 'tinggi anak tangga', 'lebar anak tangga', 'tinggi railing', 'ukuran tangga', 'pintu tangga', 'penerangan tangga', 'kondisi tangga', 'area perkerasan', 'tinggi', 'lebar jalan', 'stand by', 'radius putaran', 'perkerasan', 'kopling', 'jarak', 'putaran', 'Merk \/ Type', 'merk\/ tipe', 'merk \/tipe', 'merk \/ tipe', 'main control valve', 'saklar aliran air', 'flow switch', 'merk', 'lebar', 'head', 'jumlah', 'start', 'stop', 'volume', 'ukuran', 'pintu', 'penerangan', 'kondisi', 'penggunaan', 'genset');
        $allRegex = array_merge($myRegex, $sub_regex);
        $val_array = array();
        $key_val_array = array();
        $k = 1;
        foreach($lap_ins as $row){
            foreach($myRegex as $row1){
                $val_array [$k]= $row['span'];
                $key_val_array [$k]= $row['span'];
                if (preg_match('/^\W*'.$row1.'\s*\W*/iu', $row['span'])){
                    $val_array [$k]= preg_replace( '/^\W*'.$row1.'\s*\W*/iu' , '', $row['span']);
                    break;
                }
                                
            }
            $k++;
        }
        //save nama jalan
        $val_array1 = array();
        $key_val_array1 = array();
        $j=1;
        for ($i=1; $i <=count($key_val_array) ; $i++) {
            if (array_key_exists($j, $key_val_array)) {
                if (preg_match('/^\W*jln\s*|^\W*jalan\s*/iu', $key_val_array[$j])){
                    $nama_jln = $key_val_array[$j];
                    $j++;
                        //unset($key_val_array[$i]);
                        //unset($val_array[$i]);
                        //break;
                }
                if (preg_match('/^\W*Landing Valve\s*/iu', $key_val_array[$j])){
                    $j++;
                }
                if (preg_match('/(2012|2013|2014|2015|2016|2017)\W*$/iu', $key_val_array[$j])){
                    $tanggal = $key_val_array[$j];
                    $j++;
                }
                $val_array1 [$i]= $val_array[$j];
                $key_val_array1 [$i]= $key_val_array[$j];
            }
            $j++;
        }
        //echo '<br><br>';
        //print_r($key_val_array);
        //echo count($val_array);
        //echo $nama_jln;
        //echo $tanggal;

        // build array
        $result_arr = array();
        $key = 0;
        $result_arr = array($key =>array());
        $trash_arr = array();
        $jml_regexs = count($myRegex);
        $jml_subregexs = count($sub_regex);
        $a = 1;
        for ($i=1; $i <=count($key_val_array1) ; $i++) {
            $key_val = $key_val_array1[$i];
            $val = $val_array1[$i];
            $tambah = TRUE;
            //echo "loop $i,";
            for ($j=0; $j <= $jml_regexs ; $j++){
                if (array_key_exists($j, $myRegex)) {
                    //echo "array_key_exists,";
                    //$current_regex = current($myRegex);
                    if (preg_match('/^\W*'.$myRegex[$j].'\s*\W*/iu', $key_val)) {
                        //$next_regex = next($myRegex);
                        $key = $myRegex[$j];
                        $key1 = $myRegex[$j].'.1';
                        $key2 = $myRegex[$j].'.2';
                        $key3 = $myRegex[$j].'.3';
                        if (array_key_exists($key2, $result_arr)) {
                            $key = $key3;
                            $result_arr[$key] = array();
                        }else if (array_key_exists($key1, $result_arr)) {
                            $key = $key2;
                            $result_arr[$key] = array();
                        }else if (array_key_exists($myRegex[$j], $result_arr)) {
                            $key = $myRegex[$j].'.1';
                            $result_arr[$key] = array();
                        }else{
                            $result_arr[$key] = array();
                        }
                        unset($myRegex[$j]);
                        if (strlen($val)>1) {
                            //echo 'strlen,';
                            $tambah1 = TRUE;
                            for ($k=0; $k <= $jml_subregexs ; $k++){
                                if (array_key_exists($k, $sub_regex)) {
                                    if (preg_match('/^\W*'.$sub_regex[$k].'\s*\W*/iu', $val)) {
                                        $sub_key = $sub_regex[$k];
                                        $sub_key1 = $sub_key.'.1';
                                        $sub_key2 = $sub_key.'.2';
                                        $sub_key3 = $sub_key.'.3';
                                        if( array_key_exists($sub_key2, $result_arr[$key]) ){
                                            $result_arr[$key][$sub_key3] = $val;
                                        }else if( array_key_exists($sub_key1, $result_arr[$key]) ){
                                            $result_arr[$key][$sub_key2] = $val;
                                        }else if (array_key_exists($sub_key, $result_arr[$key])) {
                                            $result_arr[$key][$sub_key.'.1'] = $val;
                                        }else{
                                            $result_arr[$key][$sub_key] = $val;
                                        }
                                        $tambah1 = FALSE;
                                        break;
                                    }
                                }
                            }
                            if ($tambah1) {
                                array_push($result_arr[$key], $val);
                            }
                            $tambah = FALSE;
                            break;
                        }
                        break;
                    }
                }
                //echo "for loop,";
            }
            if ($tambah) {
                for ($k=0; $k <= $jml_subregexs ; $k++){
                    if (array_key_exists($k, $sub_regex)) {
                        if (preg_match('/^\W*'.$sub_regex[$k].'\s*\W*/iu', $key_val)) {
                            $sub_key = $sub_regex[$k];
                            $sub_key1 = $sub_key.'.1';
                            $sub_key2 = $sub_key.'.2';
                            $sub_key3 = $sub_key.'.3';
                            if( array_key_exists($sub_key2, $result_arr[$key]) ){
                                $result_arr[$key][$sub_key3] = $val;
                            }else if( array_key_exists($sub_key1, $result_arr[$key]) ){
                                $result_arr[$key][$sub_key2] = $val;
                            }else if (array_key_exists($sub_key, $result_arr[$key])) {
                                $result_arr[$key][$sub_key.'.1'] = $val;
                            }else{
                                $result_arr[$key][$sub_key] = $val;
                            }
                            $tambah = FALSE;
                            break;
                        }
                    }
                }
            }
            if ($tambah) {
                if (strlen($val)>1) {
                        array_push($result_arr[$key], $val);
                }
            }else{
                $trash_arr[$i] = $key_val;
            }
        }
        if (isset($nama_jln)){
            $result_arr['nama jalan'][0] = $nama_jln;
            //echo $nama_jln;
        }
        if (isset($tanggal)){
            $result_arr['tanggal'][0] = $tanggal;
            //echo $tanggal;
        }
        /*********** save hasil uji coba ********/
        $ujicoba_regex = array('sistem pipa tegak dan slang kebakaran' ,'sistem springkler' ,'sistem deteksi' ,'komunikasi darurat' ,'pencahayaan darurat' ,'kipas penekan asap' ,'lif kebakaran' ,'catatan' ,'kepala dinas', 'sistem pipa tegak');
        $jml_ujicoba_regex = count($ujicoba_regex);
        $result_ujicoba = array();
        //$key = 0;
        //$result_ujicoba['hasil uji coba'][$key]='';
        $loop_on = FALSE;
        $not_first = FALSE;
        for ($i=1; $i <=count($key_val_array1) ; $i++) {
            $key_val = $key_val_array1[$i];
            $val = $val_array1[$i];
            $tambah = TRUE;
            //echo "loop $i,";
            if (preg_match('/^\W*hasil uji coba\s*\W*/iu', $key_val) || $loop_on) {
                $loop_on = TRUE;
                for ($j=0; $j <= $jml_ujicoba_regex ; $j++){
                    if (array_key_exists($j, $ujicoba_regex)) {
                        if (preg_match('/^\W*'.$ujicoba_regex[$j].'\s*\W*/iu', $key_val)) {
                            $key = $ujicoba_regex[$j];
                            $result_ujicoba['hasil uji coba'][$key] = '';
                            unset($ujicoba_regex[$j]);
                            $tambah = FALSE;
                            break;
                        }
                    }
                }
                if ($tambah && $not_first) {
                    $result_ujicoba['hasil uji coba'][$key] = $result_ujicoba['hasil uji coba'][$key].' '.$val;
                }
                $not_first = TRUE;
            }
        }
        
        $return_arr['key_val_array1'] = $key_val_array1;
        $return_arr['result_arr'] = $result_arr;
        $return_arr['result_ujicoba'] = $result_ujicoba;
        return $return_arr ;
        
    }

    public function main_data_imported($result_arr, $result_ujicoba)
    {
        // data utama
        $main_result = array();
        $main_result['nama bangunan'] = '';
        $main_result['pengelola'] = '';
        $main_result['mkkg'] = '';
        if (isset($result_arr['nama bangunan'][0])) {
            for ($i=0; $i < (count($result_arr['nama bangunan'])-1) ; $i++) { 
                if ($i==0) {
                    $main_result['nama bangunan'] .= $result_arr['nama bangunan'][$i] ;
                }else if(isset($result_arr['nama bangunan'][$i])) {
                    $main_result['nama bangunan'] = $main_result['nama bangunan'].' '.$result_arr['nama bangunan'][$i] ;
                }
            }
            if(isset($result_arr['nama bangunan'][count($result_arr['nama bangunan'])-1])) {
                $main_result['alamat'] = $result_arr['nama bangunan'][count($result_arr['nama bangunan'])-1] ;
            }
        }
        if (isset($result_arr['pengelola'][0])) {
            for ($i=0; $i < count($result_arr['pengelola']) ; $i++) { 
                if ($i==0) {
                    $main_result['pengelola'] .= $result_arr['pengelola'][$i] ;
                }else if(isset($result_arr['pengelola'][$i])) {
                    $main_result['pengelola'] = $main_result['pengelola'].' '.$result_arr['pengelola'][$i] ;
                }
            }
        }
        if (isset($result_arr['klasifikasi bangunan'][0])) {
            $main_result['klasifikasi bangunan'] = $result_arr['klasifikasi bangunan'][0] ;
        }
        if (isset($result_arr['tinggi bangunan'][0])) {
            if (preg_match('/\d+/iu', $result_arr['tinggi bangunan'][0])) {
                $main_result['tinggi bangunan'] = $result_arr['tinggi bangunan'][0] ;
            }else{
                $main_result['tinggi bangunan'] = '';
            }
        }
        if (isset($result_arr['luas bangunan'][0])) {
            if (preg_match('/\d+/iu', $result_arr['luas bangunan'][0])) {
                $main_result['luas bangunan'] = $result_arr['luas bangunan'][0] ;
            }else{
                $main_result['luas bangunan'] = '';
            }
        }
        if (isset($result_arr['luas total'][0])) {
            if (preg_match('/\d+/iu', $result_arr['luas total'][0])) {
                $main_result['luas total'] = $result_arr['luas total'][0] ;
            }else{
                $main_result['luas total'] = '';
            }
        }
        if (isset($result_arr['penggunaan bangunan'][0])) {
            $main_result['penggunaan bangunan'] = $result_arr['penggunaan bangunan'][0] ;
        }else{
            $main_result['penggunaan bangunan'] = '';
        }
        if (isset($result_arr['imb'][0])) {
            $main_result['imb'] = $result_arr['imb'][0] ;
        }else{
            $main_result['imb'] = '';
        }
        if (isset($result_arr['sertifikat keselamatan kebakaran'][0])) {
            $main_result['sertifikat keselamatan kebakaran'] = $result_arr['sertifikat keselamatan kebakaran'][0] ;
        }else{
            $main_result['sertifikat keselamatan kebakaran'] = '';
        }
        if (isset($result_arr['klasifikasi sistem'])) {
            if (count($result_arr['klasifikasi sistem']) > 1) {
                $main_result['klasifikasi sistem'] = $result_arr['klasifikasi sistem'][0].' '.$result_arr['klasifikasi sistem'][1] ;
            }else{
                $main_result['klasifikasi sistem'] = $result_arr['klasifikasi sistem'][0] ;
            }
            
        }else{
            $main_result['klasifikasi sistem'] = '';
        }
        if (isset($result_arr['manajemen keselamatan kebakaran gedung'][0])) {
            for ($i=0; $i < count($result_arr['manajemen keselamatan kebakaran gedung']) ; $i++) { 
                if ($i==0) {
                    $main_result['mkkg'] .= $result_arr['manajemen keselamatan kebakaran gedung'][$i] ;
                }else if(isset($result_arr['manajemen keselamatan kebakaran gedung'][$i])) {
                    $main_result['mkkg'] = $main_result['mkkg'].' '.$result_arr['manajemen keselamatan kebakaran gedung'][$i] ;
                }
            }
        }
        if (isset($result_arr['tanggal'][0])) {
            $main_result['tanggal'] = $result_arr['tanggal'][0];
        }else{
            $main_result['tanggal'] = '';
        }
        if (isset($result_ujicoba['catatan'])) {
            if (preg_match('/belum dapat|tidak dapat/iu', $result_ujicoba['catatan'])){
                $main_result['kesimpulan'] = 'Belum dapat diberikan Sertifikat Keselamatan Kebakaran';
            }else{
                $main_result['kesimpulan'] = 'Dapat diberikan Sertifikat Keselamatan Kebakaran';
            }
        }
        //merge result
        $main_result = array_merge($main_result, $result_ujicoba);
        return $main_result;
    }

    

}