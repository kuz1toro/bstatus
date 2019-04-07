<?php
class Dinas_model extends CI_Model {

	/**
	* Responsable for auto load the database
	* @return void
	*/
	public function __construct()
	{
		$this->load->database();
	}

	public function get_all_setting($nama_table)
	{
		$this->db->select('*');
		$this->db->from($nama_table);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_setting_byId($nama_table, $column, $id)
	{
		$this->db->select('*');
		$this->db->from($nama_table);
		$this->db->where($column, $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	function update_setting($nama_table, $id_table, $id, $data)
	{
		$this->db->where($id_table, $id);
		if ($this->db->update($nama_table, $data)){
			return true;
		}else {
			return false;
		}
	}

	function soft_delete_setting($nama_table, $id_table, $id){
		$update_data = array(
			'deleted' => 1
		);
		$this->db->where($id_table, $id);
		if ($this->db->update($nama_table, $update_data)){
			return true;
		}else {
			return false;
		}
	}

	function add_setting($nama_table, $data)
	{
		if ($this->db->insert($nama_table, $data)){
			return true;
		}else{
			return false;
		}
	}

	public function get_hslPemeriksaan($nama_table, $column)
	{
		$this->db->select($column);
		$this->db->from($nama_table);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_list_fireHist($table_fireHist, $table_gedung, $table_penyebabFire)
	{
		$this->db->select('*');
		$this->db->from($table_fireHist.' as riwayat');
		$this->db->select($table_gedung.'.nama_gedung');
		$this->db->join($table_gedung, 'riwayat.no_gedung ='.$table_gedung.'.no_gedung', 'left');
		$this->db->select($table_penyebabFire.'.penyebab');
		$this->db->join($table_penyebabFire, 'riwayat.dugaan_penyebab ='.$table_penyebabFire.'.id_penyebabFire', 'left');
		$this->db->where('riwayat.deleted', 0);
		$query = $this->db->get();
		return $query->result_array();
	}

	function debug_db()
	{
		return $this->db->last_query();
	}

	public function get_list_gedung($table_gedung, $table_fungsi, $table_kepemilikkan, $coulum_table_gedung)
	{
		$this->db->select($coulum_table_gedung);
		$this->db->from($table_gedung.' as tabelGedung');
		$this->db->select($table_fungsi.'.fungsi_gedung');
		$this->db->join($table_fungsi, 'tabelGedung.fungsi ='.$table_fungsi.'.id_fungsi_gedung', 'left');
		$this->db->select($table_kepemilikkan.'.kepemilikkan_gedung');
		$this->db->join($table_kepemilikkan, 'tabelGedung.kepemilikan ='.$table_kepemilikkan.'.id_kepemilikkan_gedung', 'left');
		$this->db->where('tabelGedung.deleted', 0);
		//$this->db->limit(10);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_list_gedung_byId($table_gedung, $table_fungsi, $table_kepemilikkan, $id_gedung, $id)
	{
		$this->db->select('*');
		$this->db->from($table_gedung.' as tabelGedung');
		$this->db->select($table_fungsi.'.fungsi_gedung');
		$this->db->join($table_fungsi, 'tabelGedung.fungsi ='.$table_fungsi.'.id_fungsi_gedung', 'left');
		$this->db->select($table_kepemilikkan.'.kepemilikkan_gedung');
		$this->db->join($table_kepemilikkan, 'tabelGedung.kepemilikan ='.$table_kepemilikkan.'.id_kepemilikkan_gedung', 'left');
		$this->db->where($id_gedung, $id);
		//$this->db->limit(10);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_no_gdg_byId($table_gedung, $id_gedung, $id)
	{
		$this->db->select('no_gedung');
		$this->db->from($table_gedung);
		$this->db->where($id_gedung, $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_list_pemeriksaan_byNoGdg($table_pemeriksaan, $table_jalurInfo, $table_hslPemeriksaan, $table_statusGdg, $no_gedung_tblPemeriksaan, $no_gedung)
	{
		$this->db->select('*');
		$this->db->from($table_pemeriksaan.' as tabelPemeriksaan');
		$this->db->select($table_jalurInfo.'.nama_kolom_jalurInfo');
		$this->db->join($table_jalurInfo, 'tabelPemeriksaan.jalur_info ='.$table_jalurInfo.'.id_kolom_jalurInfo', 'left');
		$this->db->select($table_hslPemeriksaan.'.nama_kolom_hslPemeriksaan');
		$this->db->join($table_hslPemeriksaan, 'tabelPemeriksaan.hasil_pemeriksaan ='.$table_hslPemeriksaan.'.id_kolom_hslPemeriksaan', 'left');
		$this->db->select($table_statusGdg.'.nama_kolom_statusGedung');
		$this->db->join($table_statusGdg, 'tabelPemeriksaan.status_gedung ='.$table_statusGdg.'.id_kolom_statusGedung', 'left');
		$this->db->where('tabelPemeriksaan.'.$no_gedung_tblPemeriksaan, $no_gedung);
		$this->db->where('tabelPemeriksaan.deleted', 0);
		//$this->db->limit(10);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_byNoGdg($table, $no_gedung)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('no_gedung', $no_gedung);
		$this->db->where('deleted', 0);
		//$this->db->limit(10);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_kodeGdg_byId($table, $kodeName, $idName, $id)
	{
		$this->db->select($kodeName);
		$this->db->from($table);
		$this->db->where($idName, $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_listKodeGdg_by1stPart($table, $kode1stP)
	{
		$this->db->select('no_gedung');
		$this->db->from($table);
		$this->db->like('no_gedung', $kode1stP);
		$this->db->order_by('no_gedung', 'Desc');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_id_byWilayah($wilayah)
	{
		$this->db->select('id');
		$this->db->from('tabel_wilayah');
		$this->db->where('Wilayah', $wilayah);
		$query = $this->db->get();
		return $query->row_array();
	}

	function hard_delete($nama_table, $id_table, $id)
	{
		$this->db->where($id_table, $id);
		if ($this->db->delete($nama_table)){
			return true;
		}else{
			return false;
		}
	}




	

	/**
	* Get product by his is
	* @param int $product_id
	* @return array
	*/

	public function get_migrateData()
	{
		$this->db->select('id_pemeriksaan_dinas');
		$this->db->select('jalur_info1');
		$this->db->select('hasil_pemeriksaan1');
		$this->db->select('status_gedung1');
		$this->db->select('next_status1');
		$this->db->from('pemeriksaan_dinas');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_migrateTgl()
	{
		$this->db->select('id_pemeriksaan_dinas');
		$this->db->select('tgl_berlaku1');
		$this->db->select('tgl_expired1');
		$this->db->from('pemeriksaan_dinas');
		$query = $this->db->get();
		return $query->result_array();
	}

	function fill_column($id, $data)
	{
		$this->db->where('id_pemeriksaan_dinas', $id);
		$this->db->update('pemeriksaan_dinas', $data);
	}

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
