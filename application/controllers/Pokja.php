<?php
class Pokja extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'pokja';
 
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
        //$this->load->helper('kint');

        if ( ! $this->ion_auth->in_group('pokja'))
        {
            redirect('auth/logout');
        }
    }
 
	public function home(){
		$this->load->view('pokja/includes/header');
		$this->load->view('pokja/home');
		$this->load->view('pokja/includes/footer');
	}
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        $search_string = $this->input->post('search_string'); 
		$search_in = $this->input->post('search_in');
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 8;

        $config['base_url'] = base_url().'pokja/permohonan';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">'; 
		$config['full_tag_close'] = '</ul>'; 
		$config['num_tag_open'] = '<li>'; 
		$config['num_tag_close'] = '</li>'; 
		$config['cur_tag_open'] = '<li class="active"><span>'; 
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>'; 
		$config['prev_tag_open'] = '<li>'; 
		$config['prev_tag_close'] = '</li>'; 
		$config['next_tag_open'] = '<li>'; 
		$config['next_tag_close'] = '</li>'; 
		$config['first_link'] = '&laquo;'; 
		$config['prev_link'] = '&lsaquo;'; 
		$config['last_link'] = '&raquo;'; 
		$config['next_link'] = '&rsaquo;'; 
		$config['first_tag_open'] = '<li>'; 
		$config['first_tag_close'] = '</li>'; 
		$config['last_tag_open'] = '<li>'; 
		$config['last_tag_close'] = '</li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        
		$pokja = $this->session->userdata('user_name');
		$status = 3;

        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
				$filter_session_data['search_in_field'] = $search_in;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
				$search_in = $this->session->userdata('search_in_field');
            }
            $data['search_string_selected'] = $search_string;
			$data['search_in_field'] = $search_in;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data['count_products']= $this->permohonan_model->count_permohonan_inspeksi($search_string, $search_in, $order, $pokja, $status);
            $config['total_rows'] = $data['count_products'];
			
            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['manufacturers'] = $this->permohonan_model->get_permohonan_inspeksi($search_string, $search_in, $order, $order_type, $config['per_page'],$limit_end, $pokja, $status);        
                }else{
                    $data['manufacturers'] = $this->permohonan_model->get_permohonan_inspeksi($search_string, $search_in, '', $order_type, $config['per_page'],$limit_end, $pokja, $status);           
                }
            }else{
                if($order){
                    $data['manufacturers'] = $this->permohonan_model->get_permohonan_inspeksi('', $search_in, $order, $order_type, $config['per_page'],$limit_end, $pokja, $status);        
                }else{
                    $data['manufacturers'] = $this->permohonan_model->get_permohonan_disposisi('', $search_in, '', $order_type, $config['per_page'],$limit_end, $pokja, $status);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
			$filter_session_data['search_in_field'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
			$data['search_in_field'] = 'NamaPengelola';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->permohonan_model->count_permohonan_inspeksi('','NamaPengelola', '', $pokja, $status);
            $data['manufacturers'] = $this->permohonan_model->get_permohonan_inspeksi('', 'NamaPengelola', '', $order_type, $config['per_page'],$limit_end, $pokja, $status);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'pokja/inspeksi/list';
        $this->load->view('pokja/includes/template', $data);  

    }//index
	
	public function Add_inspeksi_step2()
    {
		//product id 
        $id = $this->uri->segment(4);
        $data['manufacture'] = $this->permohonan_model->get_permohonan_dan_gedung_by_id($id);
        //load the view
        $data['main_content'] = 'pokja/inspeksi/step2';
        $this->load->view('pokja/includes/template', $data);
	}
	
	public function Add_inspeksi_step3()
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
            $this->form_validation->set_rules('Potensi_Keb', 'Potensi_Keb', 'required');
			$this->form_validation->set_rules('StatusGedung', 'StatusGedung', 'required');
			//$this->form_validation->set_rules('Kecamatan', 'Kecamatan', 'required');
			//$this->form_validation->set_rules('Kelurahan', 'Kelurahan', 'required');
			//$this->form_validation->set_rules('Wilayah', 'Wilayah', 'required');
			//$this->form_validation->set_rules('NoImb', 'NoImb', 'required');
			//$this->form_validation->set_rules('TglImb', 'TglImb', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store1 = array(
                    'NoSrtTugas' => $this->input->post('NoSrtTugas'),
					'TglSrtTugas' => htmlDate2sqlDate($this->input->post('TglSrtTugas')),
					'TglBA' => htmlDate2sqlDate($this->input->post('TglBA')),
					'Potensi_Keb_permhn' => $this->input->post('Potensi_Keb'),
					'lhp_permhn' => $this->input->post('tempLHP'),
					'statusGedungPermhn' => $this->input->post('StatusGedung'),
					'KetInsp' => $this->input->post('KetInsp'),
					'StatusPermhn' => $this->input->post('StatusPermhn')
				);
				$data_to_store2 = array(
                    'Status' => $this->input->post('Status'),
					'Fungsi' => $this->input->post('Fungsi'),
					'JmlMasaBang' => $this->input->post('JmlMasaBang'),
					'Lantai' => $this->input->post('Lantai'),
					'Basement' => $this->input->post('Basement'),
					'LuasLantai' => $this->input->post('LuasLantai'),
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
					'Potensi_Keb' => $this->input->post('Potensi_Keb'),
					'tglBA_last' => htmlDate2sqlDate($this->input->post('TglBA')),
					'LHP' => $this->input->post('tempLHP'),
					'StatusGedung' => $this->input->post('StatusGedung')
					);
				$permhn_id = $this->input->post('permhn_id');
				$ged_id = $this->input->post('ged_id');
                //if the insert has returned true then we show the flash message
                if($this->permohonan_model->update_permohonan($permhn_id, $data_to_store1) && $this->gedung_model->update_gedung($ged_id, $data_to_store2)){
                    $this->session->set_flashdata('flash_message', 'updated');
					$data['myflash_message'] = TRUE; 
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
					$data['myflash_message'] = FALSE;
                }
            
			}

        }
        //load the view
        $data['main_content'] = 'pokja/inspeksi/result';
        $this->load->view('pokja/includes/mytemplate', $data);
		//redirect('prainspeksi/Add_lhp_step1');
	}
	
	public function rekap_inspeksi()
    {

        //all the posts sent by the view
        $search_string = $this->input->post('search_string'); 
		$search_in = $this->input->post('search_in');
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 8;

        $config['base_url'] = base_url().'pokja/rekap_inspeksi';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">'; 
		$config['full_tag_close'] = '</ul>'; 
		$config['num_tag_open'] = '<li>'; 
		$config['num_tag_close'] = '</li>'; 
		$config['cur_tag_open'] = '<li class="active"><span>'; 
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>'; 
		$config['prev_tag_open'] = '<li>'; 
		$config['prev_tag_close'] = '</li>'; 
		$config['next_tag_open'] = '<li>'; 
		$config['next_tag_close'] = '</li>'; 
		$config['first_link'] = '&laquo;'; 
		$config['prev_link'] = '&lsaquo;'; 
		$config['last_link'] = '&raquo;'; 
		$config['next_link'] = '&rsaquo;'; 
		$config['first_tag_open'] = '<li>'; 
		$config['first_tag_close'] = '</li>'; 
		$config['last_tag_open'] = '<li>'; 
		$config['last_tag_close'] = '</li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        
		$pokja = $this->session->userdata('user_name');
		$status = 4;

        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
				$filter_session_data['search_in_field'] = $search_in;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
				$search_in = $this->session->userdata('search_in_field');
            }
            $data['search_string_selected'] = $search_string;
			$data['search_in_field'] = $search_in;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data['count_products']= $this->permohonan_model->count_permohonan_inspeksi($search_string, $search_in, $order, $pokja, $status);
            $config['total_rows'] = $data['count_products'];
			
            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['manufacturers'] = $this->permohonan_model->get_permohonan_inspeksi($search_string, $search_in, $order, $order_type, $config['per_page'],$limit_end, $pokja, $status);        
                }else{
                    $data['manufacturers'] = $this->permohonan_model->get_permohonan_inspeksi($search_string, $search_in, '', $order_type, $config['per_page'],$limit_end, $pokja, $status);           
                }
            }else{
                if($order){
                    $data['manufacturers'] = $this->permohonan_model->get_permohonan_inspeksi('', $search_in, $order, $order_type, $config['per_page'],$limit_end, $pokja, $status);        
                }else{
                    $data['manufacturers'] = $this->permohonan_model->get_permohonan_disposisi('', $search_in, '', $order_type, $config['per_page'],$limit_end, $pokja, $status);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
			$filter_session_data['search_in_field'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
			$data['search_in_field'] = 'NamaPengelola';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->permohonan_model->count_permohonan_inspeksi('','NamaPengelola', '', $pokja, $status);
            $data['manufacturers'] = $this->permohonan_model->get_permohonan_inspeksi('', 'NamaPengelola', '', $order_type, $config['per_page'],$limit_end, $pokja, $status);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'pokja/rekap/list';
        $this->load->view('pokja/includes/template', $data);  

    }
	
	public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('NoSrtTugas', 'NoSrtTugas', 'required');
			//$this->form_validation->set_rules('NoPermhn', 'NoPermhn', 'required');
            //$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'NoSrtTugas' => $this->input->post('NoSrtTugas'),
					'NoBA' => $this->input->post('NoBA'),
					'TglSrtTugas' => htmlDate2sqlDate($this->input->post('TglSrtTugas')),
					'TglBA' => htmlDate2sqlDate($this->input->post('TglBA')),
					'TglJdwlIns' => htmlDate2sqlDate($this->input->post('TglJdwlIns')),
					'RiskClass' => $this->input->post('RiskClass'),
					'JmlhTower' => $this->input->post('JmlhTower'),
					'JmlhLantai' => $this->input->post('JmlhLantai'),
					'LuasLantai' => $this->input->post('LuasLantai'),
					'JmlhLapisBismen' => $this->input->post('JmlhLapisBismen'),
					'NilaiEval' => $this->input->post('NilaiEval'),
					'TglPerbalLhp' => htmlDate2sqlDate($this->input->post('TglPerbalLhp')),
					'EvalKeslKebakrn' => $this->input->post('EvalKeslKebakrn'),
					'KetInsp' => $this->input->post('KetInsp')
                );
                //if the insert has returned true then we show the flash message
                if($this->permohonan_model->update_permohonan($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('pokja/rekap_inspeksi');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('pokja/rekap_inspeksi/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['manufacture'] = $this->permohonan_model->get_permohonan_by_id($id);
        //load the view
        $data['main_content'] = 'pokja/rekap/edit';
        $this->load->view('pokja/includes/template', $data);            

    }//update

    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);
        $this->permohonan_model->delete_permohonan($id);
        redirect('disposisi/permohonan');
    }//edit
	
	public function update_gedung_step1()
    {

        if($this->session->userdata('user_name')=='pokja 1'){
			$inspector = 'udiyono';
		} else if ($this->session->userdata('user_name')=='pokja 2'){
			$inspector = 'bambang';
		} else if ($this->session->userdata('user_name')=='pokja 3'){
			$inspector = 'sidik';
		} else if ($this->session->userdata('user_name')=='pokja 4'){
			$inspector = 'miyanto';
		} else if ($this->session->userdata('user_name')=='pokja 5'){
			$inspector = 'suparman';
		}
		//all the posts sent by the view
        $search_string = $this->input->post('search_string'); 
		$search_in = $this->input->post('search_in');
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 8;

        $config['base_url'] = base_url().'pokja/gedung';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">'; 
		$config['full_tag_close'] = '</ul>'; 
		$config['num_tag_open'] = '<li>'; 
		$config['num_tag_close'] = '</li>'; 
		$config['cur_tag_open'] = '<li class="active"><span>'; 
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>'; 
		$config['prev_tag_open'] = '<li>'; 
		$config['prev_tag_close'] = '</li>'; 
		$config['next_tag_open'] = '<li>'; 
		$config['next_tag_close'] = '</li>'; 
		$config['first_link'] = '&laquo;'; 
		$config['prev_link'] = '&lsaquo;'; 
		$config['last_link'] = '&raquo;'; 
		$config['next_link'] = '&rsaquo;'; 
		$config['first_tag_open'] = '<li>'; 
		$config['first_tag_close'] = '</li>'; 
		$config['last_tag_open'] = '<li>'; 
		$config['last_tag_close'] = '</li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
				$filter_session_data['search_in_field'] = $search_in;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
				$search_in = $this->session->userdata('search_in_field');
            }
            $data['search_string_selected'] = $search_string;
			$data['search_in_field'] = $search_in;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data['count_products']= $this->gedung_model->count_gedung_base_pokja($search_string, $search_in, $order, $inspector);
            $config['total_rows'] = $data['count_products'];
			
            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['manufacturers'] = $this->gedung_model->get_gedung_base_pokja($search_string, $search_in, $order, $order_type, $config['per_page'],$limit_end, $inspector);        
                }else{
                    $data['manufacturers'] = $this->gedung_model->get_gedung_base_pokja($search_string, $search_in, '', $order_type, $config['per_page'],$limit_end, $inspector);           
                }
            }else{
                if($order){
                    $data['manufacturers'] = $this->gedung_model->get_gedung_base_pokja('', $search_in, $order, $order_type, $config['per_page'],$limit_end, $inspector);        
                }else{
                    $data['manufacturers'] = $this->gedung_model->get_gedung_base_pokja('', $search_in, '', $order_type, $config['per_page'],$limit_end, $inspector);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
			$filter_session_data['search_in_field'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
			$data['search_in_field'] = 'NamaGedung';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->gedung_model->count_gedung_base_pokja(NULL, 'NamaGedung', NULL, $inspector);
            $data['manufacturers'] = $this->gedung_model->get_gedung_base_pokja('', 'NamaGedung', '', $order_type, $config['per_page'],$limit_end, $inspector);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'pokja/update_gedung/list';
		$this->load->view('pokja/includes/template', $data);
	}
	
	public function update_gedung_step2()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('NamaGedung', 'NamaGedung', 'required');
			$this->form_validation->set_rules('Alamat', 'Alamat', 'required');
			//$this->form_validation->set_rules('Kecamatan', 'Kecamatan', 'required');
			//$this->form_validation->set_rules('Kelurahan', 'Kelurahan', 'required');
			//$this->form_validation->set_rules('Wilayah', 'Wilayah', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
			//checkbox
			$keleng_doc = array("gambar_scematik"=>$this->input->post('gambar_scematik'), 
								"gambar_siteplan"=>$this->input->post('gambar_siteplan'), 
								"dokumen_mkkg"=>$this->input->post('dokumen_mkkg'), 
								"fc_slf"=>$this->input->post('fc_slf'), 
								"fc_imb"=>$this->input->post('fc_imb'), 
								"fc_skk"=>$this->input->post('fc_skk'), 
								"fc_lhp"=>$this->input->post('fc_lhp'));
			$keleng_doc = serialize($keleng_doc);
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'NamaGedung' => $this->input->post('NamaGedung'),
					'Alamat' => $this->input->post('Alamat'),
					'Kecamatan' => $this->input->post('Kecamatan'),
					'Kelurahan' => $this->input->post('Kelurahan'),
					'Wilayah' => $this->input->post('Wilayah'),
					'KodePos' => $this->input->post('KodePos'),
					'namaGedung_google' => $this->input->post('namaGedung_google'),
					'Status' => $this->input->post('Status'),
					'Fungsi' => $this->input->post('Fungsi'),
					'JmlMasaBang' => $this->input->post('JmlMasaBang'),
					'Lantai' => $this->input->post('Lantai'),
					'Basement' => $this->input->post('Basement'),
					'Potensi_Keb' => $this->input->post('Potensi_Keb'),
					'LHP' => $this->input->post('tempLHP'),
					'StatusGedung' => $this->input->post('StatusGedung'),
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
					'Keterangan' => $this->input->post('Keterangan'),
					'keleng_doc' => $keleng_doc,
					'pokja_updated' => $this->input->post('pokja_updated')
				);
                //if the insert has returned true then we show the flash message
                if($this->gedung_model->update_gedung($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
				}else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('pokja/gedung/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['manufacture'] = $this->gedung_model->get_gedung_by_id($id);
        //load the view
		$data['main_content'] = 'pokja/update_gedung/edit';
        $this->load->view('pokja/includes/template', $data);
		         

    }//update
	
    public function rekap_update_gedung()
    {
        if($this->session->userdata('user_name')=='pokja 1'){
           $inspector = 'udiyono';
       } else if ($this->session->userdata('user_name')=='pokja 2'){
           $inspector = 'bambang';
       } else if ($this->session->userdata('user_name')=='pokja 3'){
           $inspector = 'sidik';
       } else if ($this->session->userdata('user_name')=='pokja 4'){
           $inspector = 'miyanto';
       } else if ($this->session->userdata('user_name')=='pokja 5'){
           $inspector = 'suparman';
       }
		//all the posts sent by the view
       $search_string = $this->input->post('search_string'); 
       $search_in = $this->input->post('search_in');
       $order = $this->input->post('order'); 
       $order_type = $this->input->post('order_type'); 

        //pagination settings
       $config['per_page'] = 8;

       $config['base_url'] = base_url().'pokja/rekap_update_gedung';
       $config['use_page_numbers'] = TRUE;
       $config['num_links'] = 10;
       $config['full_tag_open'] = '<ul class="pagination">'; 
       $config['full_tag_close'] = '</ul>'; 
       $config['num_tag_open'] = '<li>'; 
       $config['num_tag_close'] = '</li>'; 
       $config['cur_tag_open'] = '<li class="active"><span>'; 
       $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>'; 
       $config['prev_tag_open'] = '<li>'; 
       $config['prev_tag_close'] = '</li>'; 
       $config['next_tag_open'] = '<li>'; 
       $config['next_tag_close'] = '</li>'; 
       $config['first_link'] = '&laquo;'; 
       $config['prev_link'] = '&lsaquo;'; 
       $config['last_link'] = '&raquo;'; 
       $config['next_link'] = '&rsaquo;'; 
       $config['first_tag_open'] = '<li>'; 
       $config['first_tag_close'] = '</li>'; 
       $config['last_tag_open'] = '<li>'; 
       $config['last_tag_close'] = '</li>';

        //limit end
       $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
       $limit_end = ($page * $config['per_page']) - $config['per_page'];
       if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){ 

            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
                $filter_session_data['search_in_field'] = $search_in;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
                $search_in = $this->session->userdata('search_in_field');
            }
            $data['search_string_selected'] = $search_string;
            $data['search_in_field'] = $search_in;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }

            //fetch sql data into arrays
            $data['count_products']= $this->gedung_model->count_gedung_base_pokja($search_string, $search_in, $order, $inspector, "1");
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['manufacturers'] = $this->gedung_model->get_gedung_base_pokja($search_string, $search_in, $order, $order_type, $config['per_page'],$limit_end, $inspector, "1");        
                }else{
                    $data['manufacturers'] = $this->gedung_model->get_gedung_base_pokja($search_string, $search_in, '', $order_type, $config['per_page'],$limit_end, $inspector, "1");           
                }
            }else{
                if($order){
                    $data['manufacturers'] = $this->gedung_model->get_gedung_base_pokja('', $search_in, $order, $order_type, $config['per_page'],$limit_end, $inspector, "1");        
                }else{
                    $data['manufacturers'] = $this->gedung_model->get_gedung_base_pokja('', $search_in, '', $order_type, $config['per_page'],$limit_end, $inspector, "1");        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['search_in_field'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['search_in_field'] = 'NamaGedung';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->gedung_model->count_gedung_base_pokja(NULL, 'NamaGedung', NULL, $inspector, "1");
            $data['manufacturers'] = $this->gedung_model->get_gedung_base_pokja('', 'NamaGedung', '', $order_type, $config['per_page'],$limit_end, $inspector, "1");        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'pokja/update_gedung/list';
        $this->load->view('pokja/includes/template', $data);
    }

    
        


}
