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

	/**
	* Responsable for auto load the model
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dinas_model');
		$this->load->library(array('ion_auth','form_validation'));
		// verifikasi pangilan
		if ( ! $this->ion_auth->in_group('Dinas'))
		{
			redirect('auth/logout');
		}
	}

	public function home()
	{
		$data['attributeFooter'] = array(
			'chartJS' => TRUE,
			'dataTable' => TRUE,
			'JqueryValidation' => FALSE,
			'bootstrapSelect' => FALSE
		);
		$data['main_content'] = 'dinas/home';
		$this->load->view('dinas/includes/template', $data);
	}

	public function logout()
	{
		redirect('auth/logout');
	}

	public function list_jalurInfo()
	{
		$data['attributeFooter'] = array(
			'chartJS' => FALSE,
			'dataTable' => FALSE,
			'JqueryValidation' => FALSE,
			'bootstrapSelect' => FALSE
		);
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
		$data['main_content'] = 'dinas/list_setting';
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
		$data['attributeFooter'] = array(
			'chartJS' => FALSE,
			'dataTable' => FALSE,
			'JqueryValidation' => TRUE,
			'bootstrapSelect' => FALSE
		);
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
		$data['main_content'] = 'dinas/edit_setting';
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
		$data['attributeFooter'] = array(
			'chartJS' => FALSE,
			'dataTable' => FALSE,
			'JqueryValidation' => TRUE,
			'bootstrapSelect' => FALSE
		);
		$data['dhead'] = array(
			'nama_kolom_jalurInfo', 'keterangan_kolom_jalurInfo'
		);
		$data['thead'] = array(
			'Jalur Informasi', 'Keterangan'
		);
		$data['header'] = 'Tambah Jalur Informasi';
		$data['contrl_url'] = 'add_jalurInfo';
		$data['cancel_url'] = 'list_jalurInfo';
		$data['main_content'] = 'dinas/add_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function list_hslPemeriksaan()
	{
		$data['attributeFooter'] = array(
			'chartJS' => FALSE,
			'dataTable' => FALSE,
			'JqueryValidation' => FALSE,
			'bootstrapSelect' => FALSE
		);
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
		$data['main_content'] = 'dinas/list_setting';
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
		$data['attributeFooter'] = array(
			'chartJS' => FALSE,
			'dataTable' => FALSE,
			'JqueryValidation' => TRUE,
			'bootstrapSelect' => FALSE
		);
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
		$data['main_content'] = 'dinas/edit_setting';
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
		$data['attributeFooter'] = array(
			'chartJS' => FALSE,
			'dataTable' => FALSE,
			'JqueryValidation' => TRUE,
			'bootstrapSelect' => FALSE
		);
		$data['dhead'] = array(
			'nama_kolom_hslPemeriksaan', 'keterangan_kolom_hslPemeriksaan'
		);
		$data['thead'] = array(
			'Hasil Pemeriksaan', 'Keterangan'
		);
		$data['header'] = 'Tambah Hasil Pemeriksaan';
		$data['contrl_url'] = 'add_hslPemeriksaan';
		$data['cancel_url'] = 'list_hslPemeriksaan';
		$data['main_content'] = 'dinas/add_setting';
		$this->load->view('dinas/includes/template', $data);
	}

	public function list_statusGedung()
	{
		$data['attributeFooter'] = array(
			'chartJS' => FALSE,
			'dataTable' => FALSE,
			'JqueryValidation' => FALSE,
			'bootstrapSelect' => FALSE
		);
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
		$data['main_content'] = 'dinas/list_setting';
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
		$data['attributeFooter'] = array(
			'chartJS' => FALSE,
			'dataTable' => FALSE,
			'JqueryValidation' => TRUE,
			'bootstrapSelect' => TRUE
		);
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
		$data['main_content'] = 'dinas/edit_setting_statGedung';
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
		$data['attributeFooter'] = array(
			'chartJS' => FALSE,
			'dataTable' => FALSE,
			'JqueryValidation' => TRUE,
			'bootstrapSelect' => TRUE
		);
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
		$data['main_content'] = 'dinas/add_setting_statGedung';
		$this->load->view('dinas/includes/template', $data);
	}








	public function database_operation()
	{
		$data['attributeFooter'] = array(
			'chartJS' => FALSE,
			'dataTable' => FALSE,
			'JqueryValidation' => FALSE,
			'bootstrapSelect' => FALSE
		);
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
		$data['message']='sukses';
		$data['main_content'] = 'dinas/database';
		$this->load->view('dinas/includes/template', $data);
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
		$data['message']='sukses';
		$data['main_content'] = 'dinas/database';
		$this->load->view('dinas/includes/template', $data);
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
		$data['message']='sukses';
		$data['main_content'] = 'dinas/database';
		$this->load->view('dinas/includes/template', $data);
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
		$data['message']='sukses';
		$data['main_content'] = 'dinas/database';
		$this->load->view('dinas/includes/template', $data);
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

}
