<?php
class Gedung_model extends CI_Model {

	/**
	* Responsable for auto load the database
	* @return void
	*/
	public function __construct()
	{
		$this->load->database();
	}

	/**
	* Get product by his is
	* @param int $product_id
	* @return array
	*/
	public function get_gedung_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('tabel_gedung');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	* Fetch manufacturers data from the database
	* possibility to mix search, filter and order
	* @param string $search_string
	* @param strong $order
	* @param string $order_type
	* @param int $limit_start
	* @param int $limit_end
	* @return array
	*/
	public function get_gedung($search_string=null, $search_in='NamaGedung', $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
	{
		//echo 'get gedung';
		$this->db->select('*');
		$this->db->from('tabel_gedung');

		if($search_string){
			$this->db->like($search_in, $search_string);
		}
		$this->db->group_by('id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
			$this->db->order_by('id', $order_type);
		}

		if($limit_start && $limit_end){
			$this->db->limit($limit_start, $limit_end);
		}

		if($limit_start != null){
			$this->db->limit($limit_start, $limit_end);
		}

		$query = $this->db->get();

		return $query->result_array();
	}

	/**
	* Count the number of rows
	* @param int $search_string
	* @param int $order
	* @return int
	*/
	function count_gedung($search_string=null, $search_in='NamaGedung', $order=null)
	{
		//echo 'count gedung';
		$this->db->select('*');
		$this->db->from('tabel_gedung');
		if($search_string){
			$this->db->like($search_in, $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
			$this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();
	}

	/**
	* Store the new item into the database
	* @param array $data - associative array with data to store
	* @return boolean (need work)
	*/
	function store_gedung($data)
	{
		if ($this->db->insert('tabel_gedung', $data)){
			return true;
		}else{
			return false;
		}
	}

	/**
	* Update manufacture
	* @param array $data - associative array with data to store
	* @return boolean
	*/
	function update_gedung($id, $data)
	{
		$this->db->where('id', $id);
		if ($this->db->update('tabel_gedung', $data)){
			return true;
		}else {
			return false;
		}
	}

	/**
	* Delete manufacturer
	* @param int $id - manufacture id
	* @return boolean
	*/
	function delete_gedung($id){
		$this->db->where('id', $id);
		if ($this->db->delete('tabel_gedung')){
			return true;
		}else{
			return false;
		}
	}

	/**
	* cari no id terakhir
	* @param none
	* @return no id terakhir
	*/
	public function last_id()
	{
		$this->db->select_max('id');
		$this->db->from('tabel_gedung');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function find_zero_lantai()
	{
		$this->db->select('id');
		$this->db->from('tabel_gedung');
		$this->db->where('(Lantai IS NULL OR Lantai = "" OR Lantai = "0")');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_gedung_pokja($pokja)
	{
		$this->db->select($pokja);
		$this->db->from('pembagian_gedung');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function find_gedung_pokja($search_string)
	{
		$this->db->select('id');
		$this->db->from('tabel_gedung');
		$this->db->like('NamaGedung', $search_string);
		$query = $this->db->get();
		return $query->result_array();
		//return $query->num_rows();
	}

	public function get_gedung_base_pokja($search_string=null, $search_in='NamaGedung', $order=null, $order_type='Asc', $limit_start=null, $limit_end=null, $inspector, $update_status=NULL)
	{
		//echo 'get gedung';
		$this->db->select('*');
		$this->db->from('tabel_gedung');
		$this->db->where('inspector', $inspector);
		$this->db->where('pokja_updated', $update_status);

		if($search_string){
			$this->db->like($search_in, $search_string);
		}
		$this->db->group_by('id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
			$this->db->order_by('id', $order_type);
		}

		if($limit_start && $limit_end){
			$this->db->limit($limit_start, $limit_end);
		}

		if($limit_start != null){
			$this->db->limit($limit_start, $limit_end);
		}

		$query = $this->db->get();

		return $query->result_array();
	}

	function count_gedung_base_pokja($search_string=null, $search_in='NamaGedung', $order=null, $inspector, $update_status=NULL)
	{
		//echo 'count gedung';
		$this->db->select('*');
		$this->db->from('tabel_gedung');
		$this->db->where('inspector', $inspector);
		$this->db->where('pokja_updated', $update_status);

		if($search_string){
			$this->db->like($search_in, $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
			$this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();
	}

}
