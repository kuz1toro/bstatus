<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prainspeksi_gedung extends CI_Controller {

	/**
	* name of the folder responsible for the views
	* which are manipulated by this controller
	* @constant string
	*/
	const VIEW_FOLDER = 'prainspeksi/gedung';

	/* pagination setting */
	private $per_page = 8;

	/**
	* Responsable for auto load the model
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('gedung_model');
		$this->load->library(array('ion_auth','form_validation'));
		$this->config->load('pagination', TRUE);
		$this->load->helper('site_helper');

		if ( ! $this->ion_auth->in_group('prainspeksi'))
		{
			redirect('auth/logout');
		}
	}

	public function home()
	{
		$this->load->view('prainspeksi/includes/header');
		$this->load->view('prainspeksi/home');
		$this->load->view('prainspeksi/includes/footer');
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
