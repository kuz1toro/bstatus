<?php defined('BASEPATH') OR exit('No direct script access allowed');
class PraInspeksi_permohonan extends CI_Controller {

	/**
	* name of the folder responsible for the views
	* which are manipulated by this controller
	* @constant string
	*/
	const VIEW_FOLDER = 'prainspeksi/permohonan';

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

		if ( ! $this->ion_auth->in_group('prainspeksi'))
		{
			redirect('auth/logout');
		}
	}

	public function search()
	{
		//search tabel gedung
		$search_string = $this->input->get('search_string');
		$data['gedungs']=$this->permohonan_model->searchAllGedung($search_string);
		$data['permohonans']=$this->permohonan_model->searchAllPermohonan($search_string);

		//load the view
		$data['main_content'] = 'prainspeksi/search_result';
		$this->load->view('prainspeksi/includes/template', $data);
	}

	/**
	* Load the main view with all the current model model's data.
	* @return void
	*/
	public function index()
	{
		//load permohonan library
		$this->load->library('permohonan');
		//all the posts sent by the view
		$search_string = $this->input->get('search_string');
		$search_in = $this->input->get('search_in');
		$order = $this->input->get('order');
		$order_type = $this->input->get('order_type');

		//pagination settings
		$config['per_page'] = $this->per_page;
		$config['base_url'] = base_url().'prainspeksi_permohonan/index';

		//limit end
		$page = $this->uri->segment(3);

		//use gedung lib untuk paginasi
		$data = $this->permohonan->list_permohonan($search_string, $search_in, $order, $order_type, $this->uri->segment(3), $config['per_page']);

		$config['total_rows'] = $data['count_permohonans'];

		//initializate the panination helper
		$this->pagination->initialize($config);

		//load the view
		$data['main_content'] = 'prainspeksi/permohonan/list';
		$this->load->view('prainspeksi/includes/template', $data);

	}//index

	public function Add_step1()
	{	//load permohonan library
		$this->load->library('gedung');
		//all the posts sent by the view
		$search_string = $this->input->get('search_string');
		$search_in = $this->input->get('search_in');
		$order = $this->input->get('order');
		$order_type = $this->input->get('order_type');

		//pagination settings
		$config['per_page'] = $this->per_page;
		$config['base_url'] = base_url().'prainspeksi_permohonan/Add_step1';
		/**
		if ($this->uri->segment(2)=='add_lhp_step1'){
			$config['base_url'] = base_url().'prainspeksi_permohonan/add_lhp_step1';
		}else{
			$config['base_url'] = base_url().'prainspeksi_permohonan/add_rekomtek_step1';
		} */
		$page = $this->uri->segment(3);

		//use gedung lib untuk paginasi
		$data = $this->gedung->list_gedung($search_string, $search_in, $order, $order_type, $this->uri->segment(3), $config['per_page']);

		$config['total_rows'] = $data['count_gedungs'];

		//initializate the panination helper
		$this->pagination->initialize($config);

		//load the view
		$data['main_content'] = 'prainspeksi/permohonan/Add/step1';
		$this->load->view('prainspeksi/includes/template', $data);

	}

	public function Add_step2()
	{
		//product id
		$id = $this->uri->segment(3);
		$data['gedungs'] = $this->gedung_model->get_gedung_by_id($id);
		//load the view
		$data['main_content'] = 'prainspeksi/permohonan/Add/step2';
		$this->load->view('prainspeksi/includes/template', $data);
	}

	public function Add_step3()
	{
		//product id
		$id = $this->uri->segment(3);
		// set status/ progress permohonan
		$StatusPermhn = 2;

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			//form validation
			$this->form_validation->set_rules('NamaPengelola', 'NamaPengelola', 'required');
			$this->form_validation->set_rules('TglSuratDiterima', 'TglSuratDiterima', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			$NamaGedung_id = $this->input->post('NamaGedung_id');

			//if the form has passed through the validation
			if ($this->form_validation->run())
			{
				$data_to_store1 = array(
					'NamaPengelola' => $this->input->post('NamaPengelola'),
					'AlamatPengelola' => $this->input->post('AlamatPengelola'),
					'NoTelpPengelola' => $this->input->post('NoTelpPengelola'),
					'NoPermhn' => $this->input->post('NoPermhn'),
					'TglSuratDiterima' => htmlDate2sqlDate($this->input->post('TglSuratDiterima')),
					'TglPermhn' => htmlDate2sqlDate($this->input->post('TglPermhn')),
					'TipePermhn' => $this->input->post('TipePermhn'),
					'SuratPermohonan' => $this->input->post('SuratPermohonan'),
					'DokTeknisGedung' => $this->input->post('DokTeknisGedung'),
					'DokInventarisApar' => $this->input->post('DokInventarisApar'),
					'DokMKKG' => $this->input->post('DokMKKG'),
					'FtcpSiteplan' => $this->input->post('FtcpSiteplan'),
					'FtcpGambarSchematic' => $this->input->post('FtcpGambarSchematic'),
					'FtcpRkkSlf' => $this->input->post('FtcpRkkSlf'),
					'FtcpIMB' => $this->input->post('FtcpIMB'),
					'FtcpSkkAkhir' => $this->input->post('FtcpSkkAkhir'),
					'KetPrainspeksi' => $this->input->post('KetPrainspeksi'),
					'NamaGedung_id' => $NamaGedung_id,
					'StatusPermhn' => $StatusPermhn
				);
				$data_to_store2 = array(
					'JmlMasaBang' => $this->input->post('JmlMasaBang'),
					'Lantai' => $this->input->post('Lantai'),
					'LuasLantai' => $this->input->post('LuasLantai'),
					'Basement' => $this->input->post('Basement'),
					'NoImb' => $this->input->post('NoImb'),
					'TglImb' => htmlDate2sqlDate($this->input->post('TglImb')),
					'NoSkkAkhir' => $this->input->post('NoSkkAkhir'),
					'TglSkkAkhir' => htmlDate2sqlDate($this->input->post('TglSkkAkhir')),
					'NoSlfAkhir' => $this->input->post('NoSlfAkhir'),
					'TglSlfAkhir' => htmlDate2sqlDate($this->input->post('TglSlfAkhir')),
					'NoRekomtekAkhir' => $this->input->post('NoRekomtekAkhir'),
					'TglRekomtekAkhir' => htmlDate2sqlDate($this->input->post('TglRekomtekAkhir')),
					'NoLhp' => $this->input->post('NoLhp'),
					'TglLhp' => htmlDate2sqlDate($this->input->post('TglLhp'))
				);
				//if the insert has returned true then we show the flash message
				if($this->permohonan_model->store_permohonan($data_to_store1) && $this->gedung_model->update_gedung($NamaGedung_id, $data_to_store2)){
					//$data['myflash_message'] = TRUE;
					$this->session->set_flashdata('flash_message', 'added');
				}else{
					$data['myflash_message'] = FALSE;
				}
			}else{
				$data['myflash_message'] = FALSE;
			}
		}
		//load the view
		redirect('prainspeksi_permohonan/index');
		//redirect('prainspeksi/Add_lhp_step1');
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
		$this->form_validation->set_rules('NamaPengelola', 'NamaPengelola', 'required');
		$this->form_validation->set_rules('TglSuratDiterima', 'TglSuratDiterima', 'required');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		// data gedung
		$NamaGedung_id = $this->input->post('NamaGedung_id');
		//if the form has passed through the validation
		if ($this->form_validation->run())
		{
			$data_to_store1 = array(
				'NamaPengelola' => $this->input->post('NamaPengelola'),
				'AlamatPengelola' => $this->input->post('AlamatPengelola'),
				'NoTelpPengelola' => $this->input->post('NoTelpPengelola'),
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
				'KetPrainspeksi' => $this->input->post('KetPrainspeksi')
			);
			$data_to_store2 = array(
				'JmlMasaBang' => $this->input->post('JmlMasaBang'),
				'Lantai' => $this->input->post('Lantai'),
				'LuasLantai' => $this->input->post('LuasLantai'),
				'Basement' => $this->input->post('Basement'),
				'NoImb' => $this->input->post('NoImb'),
				'TglImb' => htmlDate2sqlDate($this->input->post('TglImb')),
				'NoSkkAkhir' => $this->input->post('NoSkkAkhir'),
				'TglSkkAkhir' => htmlDate2sqlDate($this->input->post('TglSkkAkhir')),
				'NoSlfAkhir' => $this->input->post('NoSlfAkhir'),
				'TglSlfAkhir' => htmlDate2sqlDate($this->input->post('TglSlfAkhir')),
				'NoRekomtekAkhir' => $this->input->post('NoRekomtekAkhir'),
				'TglRekomtekAkhir' => htmlDate2sqlDate($this->input->post('TglRekomtekAkhir')),
				'NoLhp' => $this->input->post('NoLhp'),
				'TglLhp' => htmlDate2sqlDate($this->input->post('TglLhp'))
			);
			if (empty($NamaGedung_id) || $NamaGedung_id==null){
				if($this->permohonan_model->update_permohonan($id, $data_to_store1)){
					$this->session->set_flashdata('flash_message', 'updated');
					//redirect('prainspeksi/permohonan');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}
			}else{
				//if the insert has returned true then we show the flash message
				if($this->permohonan_model->update_permohonan($id, $data_to_store1) && $this->gedung_model->update_gedung($NamaGedung_id, $data_to_store2)){
					$this->session->set_flashdata('flash_message', 'updated');
					//redirect('prainspeksi/permohonan');
				}else{
					$this->session->set_flashdata('flash_message', 'not_updated');
				}
			}

			if (strlen($_SESSION['search_string_selected'])==0){
					$next_page = $_SESSION['hal_skr'];
				} else {
					$next_page = ''.$_SESSION['hal_skr'].'?search_string='.$_SESSION['search_string_selected'].'&search_in='.$_SESSION['search_in_field'].'&order='.$_SESSION['order'].'&order_type='.$_SESSION['order_type'].'';
				}

			//redirect('prainspeksi_permohonan/update/'.$id.'');
			redirect($next_page);

		}//validation run

	}

	//if we are updating, and the data did not pass trough the validation
	//the code below wel reload the current data

	//product data
	$data['permohonans'] = $this->permohonan_model->get_permohonan_by_id($id);
	$data['gedungs'] = $this->gedung_model->get_gedung_by_id($data['permohonans'][0]['NamaGedung_id']);
	//load the view
	$data['main_content'] = 'prainspeksi/permohonan/edit';
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
	if ($this->permohonan_model->delete_permohonan($id)){
		$this->session->set_flashdata('flash_message', 'deleted');
		// page setup
		if (strlen($_SESSION['search_string_selected'])==0){
			$next_page = $_SESSION['hal_skr'];
		} else {
			$next_page = ''.$_SESSION['hal_skr'].'?search_string='.$_SESSION['search_string_selected'].'&search_in='.$_SESSION['search_in_field'].'&order='.$_SESSION['order'].'&order_type='.$_SESSION['order_type'].'';
		}
		redirect($next_page);
		//redirect('prainspeksi_permohonan/index');
	}
}//delete


}
