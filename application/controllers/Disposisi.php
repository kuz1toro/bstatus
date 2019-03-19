<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Disposisi extends CI_Controller {

	/**
	* name of the folder responsible for the views
	* which are manipulated by this controller
	* @constant string
	*/
	const VIEW_FOLDER = 'disposisi';

	/* pagination setting */
	private $per_page = 8;

	/**
	* Responsable for auto load the model
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('permohonan_model');
		$this->load->model('gedung_model');
		$this->load->library(array('ion_auth','form_validation'));
		$this->config->load('pagination', TRUE);
		$this->load->helper('site_helper');

		if ( ! $this->ion_auth->in_group('disposisi'))
		{
			redirect('auth/logout');
		}
	}

	public function home()
	{
		$this->load->view('disposisi/includes/header');
		$this->load->view('disposisi/home');
		$this->load->view('disposisi/includes/footer');
	}

	public function list_gedung()
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
		$config['base_url'] = base_url().'disposisi/list_gedung';

		//limit end
		$page = $this->uri->segment(3);

		//use gedung lib untuk paginasi
		$data = $this->gedung->list_gedung($search_string, $search_in, $order, $order_type, $this->uri->segment(3), $config['per_page']);

		$config['total_rows'] = $data['count_gedungs'];

		//initializate the panination helper
		$this->pagination->initialize($config);

		//load the view
		$data['main_content'] = 'disposisi/gedung/list';
		$this->load->view('disposisi/includes/template', $data);

	}//list gedung

	public function update_gedung()
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

				//redirect('disposisi/update_gedung/'.$id.'');
				redirect($next_page);
				

			}//validation run

		}

		//if we are updating, and the data did not pass trough the validation
		//the code below wel reload the current data

		//product data
		$data['gedungs'] = $this->gedung_model->get_gedung_by_id($id);
		//load the view
		$data['main_content'] = 'disposisi/gedung/edit';
		$this->load->view('disposisi/includes/template', $data);

	}//update

	public function add_gedung()
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
					redirect('disposisi/list_gedung/'.$page.'');
				}else{
					$this->session->set_flashdata('flash_message', 'not added');
				}

			}

		}
		//load the view
		$data['main_content'] = 'disposisi/gedung/add';
		$this->load->view('disposisi/includes/template', $data);
	}

	/**
	* Delete gedung by his id
	* @return void
	*/
	public function delete_gedung()
	{
		//product id
		$id = $this->uri->segment(3);
		if ($this->gedung_model->delete_gedung($id)){
			$this->session->set_flashdata('flash_message', 'deleted');
			// page setup
			if (strlen($_SESSION['search_string_selected'])==0){
				$next_page = $_SESSION['hal_skr'];
			} else {
				$next_page = ''.$_SESSION['hal_skr'].'?search_string='.$_SESSION['search_string_selected'].'&search_in='.$_SESSION['search_in_field'].'&order='.$_SESSION['order'].'&order_type='.$_SESSION['order_type'].'';
			}
			redirect($next_page);
		}else{
			$this->session->set_flashdata('flash_message', 'not deleted');
		}
	}//delete

	/**
	* Load the main view with all the current model model's data.
	* @return void
	*/
	public function monitoring()
	{	$this->load->library('disposisi_permohonan');
		$for = 'monitoring';
		//all the posts sent by the view
		$search_string = $this->input->get('search_string');
		$search_in = $this->input->get('search_in');
		$order = $this->input->get('order');
		$order_type = $this->input->get('order_type');

		//pagination settings
		$config['per_page'] = $this->per_page;
		$config['base_url'] = base_url().'disposisi/monitoring';

		//limit end
		$page = $this->uri->segment(3);

		//use gedung lib untuk paginasi
		$data = $this->disposisi_permohonan->list_permohonan($search_string, $search_in, $order, $order_type, $this->uri->segment(3), $config['per_page'], $for);

		$config['total_rows'] = $data['count_permohonans'];

		//initializate the panination helper
		$this->pagination->initialize($config);

		//load the view
		$data['main_content'] = 'disposisi/permohonan/monitoring';
		$this->load->view('disposisi/includes/template', $data);
	}//monitoring

	public function update()
	{
		//product id
		$id = $this->uri->segment(3);

		//if save button was clicked, get the data sent via post
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('NamaPengelola', 'NamaPengelola', 'required');
			//$this->form_validation->set_rules('NoPermhn', 'NoPermhn', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store = array(
					'NamaPengelola' => $this->input->post('NamaPengelola'),
					'KetPrainspeksi' => $this->input->post('KetPrainspeksi'),
					'NoTelpPengelola' => $this->input->post('NoTelpPengelola'),
					'AlamatPengelola' => $this->input->post('AlamatPengelola'),
					'NoPermhn' => $this->input->post('NoPermhn'),
					'TglSuratDiterima' => htmlDate2sqlDate($this->input->post('TglSuratDiterima')),
					'TglPermhn' => htmlDate2sqlDate($this->input->post('TglPermhn')),
					'TipePermhn' => $this->input->post('TipePermhn'),
					'SuratPermohonan' => $this->input->post('SuratPermohonan'),
					'DokTeknisGedung' => $this->input->post('DokTeknisGedung'),
					'DokInventarisApar' => $this->input->post('DokInventarisApar'),
					'DokMKKG' => $this->input->post('DokMKKG'),
					'FtcpGambarSchematic' => $this->input->post('FtcpGambarSchematic'),
					'FtcpSiteplan' => $this->input->post('FtcpSiteplan'),
					'FtcpRkkSlf' => $this->input->post('FtcpRkkSlf'),
					'FtcpIMB' => $this->input->post('FtcpIMB'),
					'FtcpSkkAkhir' => $this->input->post('FtcpSkkAkhir'),
					'TglDisKadis' => htmlDate2sqlDate($this->input->post('TglDisKadis')),
					'TglDisKabid' => htmlDate2sqlDate($this->input->post('TglDisKabid')),
					'TglDisKasi' => htmlDate2sqlDate($this->input->post('TglDisKasi')),
					'TglPerbalST' => htmlDate2sqlDate($this->input->post('TglPerbalST')),
					'Pokja' => $this->input->post('Pokja'),
					'KaInsp' => $this->input->post('KaInsp'),
					'StatusPermhn' => $this->input->post('StatusPermhn'),
					'KetDisposisi' => $this->input->post('KetDisposisi')
				);
				//if the insert has returned true then we show the flash message
				if($this->permohonan_model->update_permohonan($id, $data_to_store) == TRUE){
					$this->session->set_flashdata('flash_message', 'updated');
					//redirect('disposisi/permohonan');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}
				// next page setup
				if (strlen($_SESSION['search_string_selected'])==0){
					$next_page = $_SESSION['hal_skr'];
				} else {
					$next_page = ''.$_SESSION['hal_skr'].'?search_string='.$_SESSION['search_string_selected'].'&search_in='.$_SESSION['search_in_field'].'&order='.$_SESSION['order'].'&order_type='.$_SESSION['order_type'].'';
				}

				//redirect('disposisi/update/'.$id.'');
				redirect($next_page);
				

			}//validation run

		}

		//if we are updating, and the data did not pass trough the validation
		//the code below wel reload the current data

		//product data
		//$data['manufacture'] = $this->permohonan_model->get_permohonan_dan_gedung_by_id($id);
		$data['permohonan'] = $this->permohonan_model->get_permohonan_by_id($id);
		$data['gedung'] = $this->gedung_model->get_gedung_by_id($data['permohonan'][0]['NamaGedung_id']);
		//load the view
		$data['main_content'] = 'disposisi/permohonan/edit';
		$this->load->view('disposisi/includes/template', $data);

	}//update

	/**
	* Delete product by his id
	* @return void
	*/
	public function delete()
	{
		//product id
		$id = $this->uri->segment(3);
		if ($this->permohonan_model->delete_permohonan($id)){
			$this->session->set_flashdata('flash_message', 'deleted');
			// page setup
			if (strlen($_SESSION['search_string_selected'])==0){
				$next_page = $_SESSION['hal_skr'];
			} else {
				$next_page = ''.$_SESSION['hal_skr'].'?search_string='.$_SESSION['search_string_selected'].'&search_in='.$_SESSION['search_in_field'].'&order='.$_SESSION['order'].'&order_type='.$_SESSION['order_type'].'';
			}
			redirect($next_page);
		}
	}//delete

	public function Add_disposisi_step1()
	{
		//all the posts sent by the view
		$this->load->library('disposisi_permohonan');
		$for = 'disposisi';
		//all the posts sent by the view
		$search_string = $this->input->get('search_string');
		$search_in = $this->input->get('search_in');
		$order = $this->input->get('order');
		$order_type = $this->input->get('order_type');

		//pagination settings
		$config['per_page'] = $this->per_page;
		$config['base_url'] = base_url().'disposisi/Add_disposisi_step1';

		//limit end
		$page = $this->uri->segment(3);

		//use gedung lib untuk paginasi
		$data = $this->disposisi_permohonan->list_permohonan($search_string, $search_in, $order, $order_type, $this->uri->segment(3), $config['per_page'], $for);

		$config['total_rows'] = $data['count_permohonans'];

		//initializate the panination helper
		$this->pagination->initialize($config);

		//load the view
		$data['main_content'] = 'disposisi/permohonan/step1';
		$this->load->view('disposisi/includes/template', $data);

	}

	public function Add_disposisi_step2()
	{
		//product id
		$id = $this->uri->segment(3);
		$data['permhn_n_gedung'] = $this->permohonan_model->get_permohonan_dan_gedung_by_id($id);
		//load the view
		$data['main_content'] = 'disposisi/permohonan/step2';
		$this->load->view('disposisi/includes/template', $data);
	}

	public function Add_disposisi_step3()
	{
		//echo "step 333333";
		//product id
		//$id = $this->uri->segment(4);
		//$id = "33";
		//$id = (string)$this->input->post('No_id');
		//$data['manufacture'] = $this->gedung_model->get_gedung_by_id($id);
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$StatusPermhn = $this->input->post('StatusPermhn');
			$id = $this->input->post('No_id');
			//form validation
			$this->form_validation->set_rules('Pokja', 'Pokja', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');


			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				if ($StatusPermhn == 1){
					$data_to_store = array(
						'NamaPengelola' => $this->input->post('NamaPengelola'),
						'KetPrainspeksi' => $this->input->post('KetPrainspeksi'),
						'NoTelpPengelola' => $this->input->post('NoTelpPengelola'),
						'AlamatPengelola' => $this->input->post('AlamatPengelola'),
						'NoPermhn' => $this->input->post('NoPermhn'),
						'TglSuratDiterima' => htmlDate2sqlDate($this->input->post('TglSuratDiterima')),
						'TglPermhn' => htmlDate2sqlDate($this->input->post('TglPermhn')),
						'TipePermhn' => $this->input->post('TipePermhn'),
						'SuratPermohonan' => $this->input->post('SuratPermohonan'),
						'DokTeknisGedung' => $this->input->post('DokTeknisGedung'),
						'DokInventarisApar' => $this->input->post('DokInventarisApar'),
						'DokMKKG' => $this->input->post('DokMKKG'),
						'FtcpGambarSchematic' => $this->input->post('FtcpGambarSchematic'),
						'FtcpSiteplan' => $this->input->post('FtcpSiteplan'),
						'FtcpRkkSlf' => $this->input->post('FtcpRkkSlf'),
						'FtcpIMB' => $this->input->post('FtcpIMB'),
						'FtcpSkkAkhir' => $this->input->post('FtcpSkkAkhir'),
						'TglDisKadis' => htmlDate2sqlDate($this->input->post('TglDisKadis')),
						'TglDisKabid' => htmlDate2sqlDate($this->input->post('TglDisKabid')),
						'TglDisKasi' => htmlDate2sqlDate($this->input->post('TglDisKasi')),
						'TglPerbalST' => htmlDate2sqlDate($this->input->post('TglPerbalST')),
						'StatusPermhn' => $StatusPermhn,
						'KetDisposisi' => $this->input->post('KetDisposisi')
					);
				}else if($StatusPermhn == 3){
					$data_to_store = array(
						'NamaPengelola' => $this->input->post('NamaPengelola'),
						'KetPrainspeksi' => $this->input->post('KetPrainspeksi'),
						'NoTelpPengelola' => $this->input->post('NoTelpPengelola'),
						'AlamatPengelola' => $this->input->post('AlamatPengelola'),
						'NoPermhn' => $this->input->post('NoPermhn'),
						'TglSuratDiterima' => htmlDate2sqlDate($this->input->post('TglSuratDiterima')),
						'TglPermhn' => htmlDate2sqlDate($this->input->post('TglPermhn')),
						'TipePermhn' => $this->input->post('TipePermhn'),
						'SuratPermohonan' => $this->input->post('SuratPermohonan'),
						'DokTeknisGedung' => $this->input->post('DokTeknisGedung'),
						'DokInventarisApar' => $this->input->post('DokInventarisApar'),
						'DokMKKG' => $this->input->post('DokMKKG'),
						'FtcpGambarSchematic' => $this->input->post('FtcpGambarSchematic'),
						'FtcpSiteplan' => $this->input->post('FtcpSiteplan'),
						'FtcpRkkSlf' => $this->input->post('FtcpRkkSlf'),
						'FtcpIMB' => $this->input->post('FtcpIMB'),
						'FtcpSkkAkhir' => $this->input->post('FtcpSkkAkhir'),
						'TglDisKadis' => htmlDate2sqlDate($this->input->post('TglDisKadis')),
						'TglDisKabid' => htmlDate2sqlDate($this->input->post('TglDisKabid')),
						'TglDisKasi' => htmlDate2sqlDate($this->input->post('TglDisKasi')),
						'TglPerbalST' => htmlDate2sqlDate($this->input->post('TglPerbalST')),
						'Pokja' => $this->input->post('Pokja'),
						'KaInsp' => $this->input->post('KaInsp'),
						'StatusPermhn' => $StatusPermhn,
						'KetDisposisi' => $this->input->post('KetDisposisi')
					);
				}else{

				}
								
				//if the insert has returned true then we show the flash message
				if($this->permohonan_model->update_permohonan($id, $data_to_store) == TRUE){
					$this->session->set_flashdata('flash_message', 'added');
				}else{
					$this->session->set_flashdata('flash_message', 'gagal');
				}

				// next page setup
				if (strlen($_SESSION['search_string_selected'])==0){
					$next_page = $_SESSION['hal_skr'];
				} else {
					$next_page = ''.$_SESSION['hal_skr'].'?search_string='.$_SESSION['search_string_selected'].'&search_in='.$_SESSION['search_in_field'].'&order='.$_SESSION['order'].'&order_type='.$_SESSION['order_type'].'';
				}

				//redirect('disposisi/update/'.$id.'');
				redirect($next_page);

			}

		}
		//load the view
		$data['main_content'] = 'disposisi/permohonan/result';
		$this->load->view('disposisi/includes/mytemplate', $data);
		//redirect('prainspeksi/Add_lhp_step1');
	}

	public function tes()
	{
		if((true && false)|| (true && false)){
			$var='true';
		}else{ $var='false';}
		$data['tes'] = $var;
		$data['main_content'] = 'disposisi/tes';
		$this->load->view('disposisi/includes/template', $data);
	}

	public function validasi()
	{
		//all the posts sent by the view
		$this->load->library('disposisi_permohonan');
		$for = 'validasi';
		//all the posts sent by the view
		$search_string = $this->input->get('search_string');
		$search_in = $this->input->get('search_in');
		$order = $this->input->get('order');
		$order_type = $this->input->get('order_type');

		//pagination settings
		$config['per_page'] = $this->per_page;
		$config['base_url'] = base_url().'disposisi/validasi';
		$page = $this->uri->segment(3);

		//use gedung lib untuk paginasi
		$data = $this->disposisi_permohonan->list_permohonan($search_string, $search_in, $order, $order_type, $this->uri->segment(3), $config['per_page'], $for);

		$config['total_rows'] = $data['count_permohonans'];

		//initializate the panination helper
		$this->pagination->initialize($config);

		//load the view
		$data['main_content'] = 'disposisi/permohonan/validasi';
		$this->load->view('disposisi/includes/template', $data);
	}

	public function validasi_step2()
	{
		//product id
		$id = $this->uri->segment(3);
		$data['permhn_n_gedung'] = $this->permohonan_model->get_permohonan_dan_gedung_by_id($id);
		//load the view
		$data['main_content'] = 'disposisi/permohonan/validasi_step2';
		$this->load->view('disposisi/includes/template', $data);
	}

	public function validasi_step3()
	{
		//echo "step 333333";
		//product id
		//$id = $this->uri->segment(4);
		//$id = "33";
		//$id = (string)$this->input->post('No_id');
		//$data['manufacture'] = $this->gedung_model->get_gedung_by_id($id);
		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('StatusPermhn', 'StatusPermhn', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');


			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$StatusPermhn = $this->input->post('StatusPermhn');
				$data_to_store = array(
					'StatusPermhn' => $StatusPermhn,
					'KetDisposisi' => $this->input->post('KetDisposisi')

				);
				$id = $this->input->post('No_id');
				//if the insert has returned true then we show the flash message
				if($this->permohonan_model->update_permohonan($id, $data_to_store) == TRUE){
					$status_val = TRUE;
				}else{
					$status_val = FALSE;
				}
				//setup flash message
				if($StatusPermhn==5 && $status_val){
					$this->session->set_flashdata('flash_message', 'validated_yes');
				}else if($StatusPermhn==3 && $status_val){
					$this->session->set_flashdata('flash_message', 'validated_no');
				}else{
					$this->session->set_flashdata('flash_message', 'not_validated');
				}
				// next page setup
				if (strlen($_SESSION['search_string_selected'])==0){
					$next_page = $_SESSION['hal_skr'];
				} else {
					$next_page = ''.$_SESSION['hal_skr'].'?search_string='.$_SESSION['search_string_selected'].'&search_in='.$_SESSION['search_in_field'].'&order='.$_SESSION['order'].'&order_type='.$_SESSION['order_type'].'';
				}
				redirect($next_page);
			}

		}
		//load the view
		$data['main_content'] = 'disposisi/permohonan/result_validasi';
		$this->load->view('disposisi/includes/template', $data);
		//redirect('prainspeksi/Add_lhp_step1');
	}

	public function validasi_yes()
	{
		$id = $this->uri->segment(3);
		$StatusPermhn = '5';
		$data_to_store = array(
			'StatusPermhn' => $StatusPermhn
		);
		if($this->permohonan_model->update_permohonan($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
		}else{
			$this->session->set_flashdata('flash_message', 'not_updated');
		}
		//$data['main_content'] = 'disposisi/validasi';
		//$this->load->view('disposisi/includes/mytemplate', $data);
		redirect('disposisi/validasi');
	}

	public function validasi_no()
	{
		$id = $this->uri->segment(3);
		$StatusPermhn = '3';
		$data_to_store = array(
			'StatusPermhn' => $StatusPermhn
		);
		if($this->permohonan_model->update_permohonan($id, $data_to_store) == TRUE){
			$this->session->set_flashdata('flash_message', 'updated');
		}else{
			$this->session->set_flashdata('flash_message', 'not_updated');
		}
		redirect('disposisi/validasi');
	}

	public function add_lantai()
	{
		$zero_lantai = $this->gedung_model->find_zero_lantai();
		foreach ($zero_lantai as $id)
		{
			$data_to_store = array(
				'Lantai' => '100'
			);
			$this->gedung_model->update_gedung($id['id'], $data_to_store);
		}
	}

}
