<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Disposisi_permohonan
{
	protected $CI;
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		$this->CI->load->model('gedung_model');
		$this->CI->load->model('permohonan_model');
	}
	public function list_permohonan($search_string, $search_in, $order, $order_type, $uri3, $per_page, $for)
	{	//math to get the initial record to be select in the database
		$limit_end = ($uri3 * $per_page - $per_page);
		if ($limit_end < 0){
			$limit_end = 0;
		}

		//we must avoid a page reload with the previous session data
		//if any filter post was sent, then it's the first time we load the content
		//in this case we clean the session filter data
		//if any filter post was sent but we are in some page, we must load the session data

		//filtered && || paginated

		/*kemungkinan kondisi
		first load ; $search_string=null, $this->uri->segment(3) !== true
		click empty search;  $search_string='', $this->uri->segment(3) !== true
		click search; $search_string='xxx', $this->uri->segment(3) !== true
		click pagination; $search_string=null, $this->uri->segment(3) == true*/
		if($uri3 == null){
			if( $search_string == null && $search_string !== '' ){
				$search_string = '';
				$search_in = 'NamaGedung';
				$order ='id';
				$order_type ='Desc';
				//console_log( '1' );
			}else{
				//console_log( '2' );
			}
			$filter_session_data['search_string_selected'] = $search_string;
			$filter_session_data['search_in_field'] = $search_in;
			$filter_session_data['order'] = $order;
			$filter_session_data['order_type'] = $order_type;
			$this->CI->session->set_userdata($filter_session_data);
		}else {
			$search_string = $this->CI->session->userdata('search_string_selected');
			$search_in = $this->CI->session->userdata('search_in_field');
			$order = $this->CI->session->userdata('order');
			$order_type = $this->CI->session->userdata('order_type');
			//console_log( '3' );
		}

		$data['search_string_selected'] = $search_string;
		$data['search_in_field'] = $search_in;
		$data['order'] = $order;
		$data['order_type_selected'] = $order_type;
		$data['permohonans'] = $this->CI->permohonan_model->get_permohonan_disposisi($search_string, $search_in, $order, $order_type, $per_page, $limit_end, $for);
		$data['count_permohonans']= $this->CI->permohonan_model->count_permohonan_disposisi($search_string, $search_in, $order, $for);
		return $data;

	}
}
