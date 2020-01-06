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

	public function get_list_pemeriksaan_byNoGdg($table_pemeriksaan, $table_jalurInfo, $table_hslPemeriksaan, $table_statusGdg, $table_pokja, $table_fsm, $no_gedung_tblPemeriksaan, $no_gedung)
	{
		$this->db->select('*');
		$this->db->from($table_pemeriksaan.' as tabelPemeriksaan');
		$this->db->select($table_jalurInfo.'.nama_kolom_jalurInfo');
		$this->db->join($table_jalurInfo, 'tabelPemeriksaan.jalur_info ='.$table_jalurInfo.'.id_kolom_jalurInfo', 'left');
		$this->db->select($table_hslPemeriksaan.'.nama_kolom_hslPemeriksaan');
		$this->db->join($table_hslPemeriksaan, 'tabelPemeriksaan.hasil_pemeriksaan ='.$table_hslPemeriksaan.'.id_kolom_hslPemeriksaan', 'left');
		$this->db->select($table_statusGdg.'.nama_kolom_statusGedung');
		$this->db->join($table_statusGdg, 'tabelPemeriksaan.status_gedung ='.$table_statusGdg.'.id_kolom_statusGedung', 'left');
		$this->db->select($table_pokja.'.nama_pokja');
		$this->db->join($table_pokja, 'tabelPemeriksaan.pokjaP  ='.$table_pokja.'.id_pokja', 'left');
		$this->db->select($table_fsm.'.nama_FSM');
		$this->db->join($table_fsm, 'tabelPemeriksaan.fsmP  ='.$table_fsm.'.id_FSM', 'left');
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

	public function get_list_pemeriksaan($table_pemeriksaan, $table_jalurInfo, $table_hslPemeriksaan, $table_statGedung, $table_gedung, $table_fungsiGdg, $table_pokja, $coulum_table_pemeriksaan)
	{
		$this->db->select($coulum_table_pemeriksaan);
		$this->db->from($table_pemeriksaan.' as tabelPemeriksaan');
		$this->db->select($table_jalurInfo.'.nama_kolom_jalurInfo');
		$this->db->join($table_jalurInfo, 'tabelPemeriksaan.jalur_info ='.$table_jalurInfo.'.id_kolom_jalurInfo', 'left');
		$this->db->select($table_hslPemeriksaan.'.nama_kolom_hslPemeriksaan');
		$this->db->join($table_hslPemeriksaan, 'tabelPemeriksaan.hasil_pemeriksaan ='.$table_hslPemeriksaan.'.id_kolom_hslPemeriksaan', 'left');
		$this->db->select($table_statGedung.'.nama_kolom_statusGedung');
		$this->db->join($table_statGedung, 'tabelPemeriksaan.status_gedung  ='.$table_statGedung.'.id_kolom_statusGedung', 'left');
		$this->db->select($table_gedung.'.nama_gedung');
		$this->db->select($table_gedung.'.alamat_gedung');
		$this->db->select($table_gedung.'.fungsi');
		$this->db->join($table_gedung, 'tabelPemeriksaan.no_gedungP  ='.$table_gedung.'.no_gedung', 'left');
		$this->db->select($table_fungsiGdg.'.fungsi_gedung');
		$this->db->join($table_fungsiGdg, $table_gedung.'.fungsi  ='.$table_fungsiGdg.'.id_fungsi_gedung', 'left');
		$this->db->select($table_pokja.'.nama_pokja');
		$this->db->join($table_pokja, 'tabelPemeriksaan.pokjaP  ='.$table_pokja.'.id_pokja', 'left');
		$this->db->where('tabelPemeriksaan.deleted', 0);
		//$this->db->order_by('tabelPemeriksaan.id_pemeriksaan_dinas', 'Desc');
		//$this->db->limit(10);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_list_pemeriksaan_byNoId($table_pemeriksaan, $table_jalurInfo, $table_hslPemeriksaan, $table_statusGdg, $table_gedung, $table_fungsiGdg, $table_pokja, $table_fsm, $id_tblPemeriksaan, $id)
	{
		$this->db->select('*');
		$this->db->from($table_pemeriksaan.' as tabelPemeriksaan');
		$this->db->select($table_jalurInfo.'.nama_kolom_jalurInfo');
		$this->db->join($table_jalurInfo, 'tabelPemeriksaan.jalur_info ='.$table_jalurInfo.'.id_kolom_jalurInfo', 'left');
		$this->db->select($table_hslPemeriksaan.'.nama_kolom_hslPemeriksaan');
		$this->db->join($table_hslPemeriksaan, 'tabelPemeriksaan.hasil_pemeriksaan ='.$table_hslPemeriksaan.'.id_kolom_hslPemeriksaan', 'left');
		$this->db->select($table_statusGdg.'.nama_kolom_statusGedung');
		$this->db->join($table_statusGdg, 'tabelPemeriksaan.status_gedung ='.$table_statusGdg.'.id_kolom_statusGedung', 'left');
		$this->db->select($table_gedung.'.nama_gedung');
		$this->db->select($table_gedung.'.alamat_gedung');
		$this->db->select($table_gedung.'.fungsi');
		$this->db->join($table_gedung, 'tabelPemeriksaan.no_gedungP  ='.$table_gedung.'.no_gedung', 'left');
		$this->db->select($table_fungsiGdg.'.fungsi_gedung');
		$this->db->join($table_fungsiGdg, $table_gedung.'.fungsi  ='.$table_fungsiGdg.'.id_fungsi_gedung', 'left');
		$this->db->select($table_pokja.'.nama_pokja');
		$this->db->join($table_pokja, 'tabelPemeriksaan.pokjaP  ='.$table_pokja.'.id_pokja', 'left');
		$this->db->select($table_fsm.'.nama_FSM');
		$this->db->select($table_fsm.'.no_telp_FSM');
		$this->db->join($table_fsm, 'tabelPemeriksaan.fsmP  ='.$table_fsm.'.id_FSM', 'left');
		$this->db->where('tabelPemeriksaan.'.$id_tblPemeriksaan, $id);
		$this->db->where('tabelPemeriksaan.deleted', 0);
		//$this->db->limit(10);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_masaBerlaku($table_statGedung, $id_statusGedung)
	{
		$this->db->select('masa_berlaku');
		$this->db->from($table_statGedung);
		$this->db->where('id_kolom_statusGedung', $id_statusGedung);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_fireHist_byNoGdg($table_fireHist, $table_penyebabFire, $no_gedung)
	{
		$this->db->select('*');
		$this->db->from($table_fireHist.' as tabelRiwayatFire');
		$this->db->select($table_penyebabFire.'.penyebab');
		$this->db->join($table_penyebabFire, 'tabelRiwayatFire.dugaan_penyebab ='.$table_penyebabFire.'.id_penyebabFire', 'left');
		$this->db->where('tabelRiwayatFire.no_gedung', $no_gedung);
		$this->db->where('tabelRiwayatFire.deleted', 0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_lastStatus($table, $no_gedung)
	{
		$this->db->select('hasil_pemeriksaan, status_gedung, tgl_expired');
		$this->db->from($table);
		$this->db->where('no_gedungP', $no_gedung);
		$this->db->where('deleted', 0);
		$this->db->order_by('tgl_expired', 'Desc');
		$query = $this->db->get();
		return $query->row_array();
	}

	function get_chart_data($parameter, $kepemilikkan)
	{
		//echo 'count gedung';
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->db->select('*');
		$this->db->from($tabelGedung);
		$this->db->where('last_status', $parameter);
		$this->db->where('kepemilikan', $kepemilikkan);
		$query = $this->db->get();
		$jumlah = $query->num_rows();
		$isi = $query->result_array();
		$result = array($jumlah, $isi);
		return $result;
	}

	function get_chart_sum($status, $kepemilikkan, $kategori)
	{
		$tabelPokja = $this->config->item('nama_tabel_pokja');
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$tabelFsm = $this->config->item('nama_tabel_fsm');
		$this->db->select('no_gedung,nama_gedung,alamat_gedung,wilayah,kecamatan,kelurahan,last_status, kepemilikan');
		$this->db->from($tabelGedung.' as joinTable');
		//$this->db->select('tabel_kolom_statusGedung.keterangan_kolom_statusGedung');
		$this->db->select('tabel_kolom_statusGedung.kategori_kolomHslPemeriksaan');
		$this->db->select('tabel_kolom_statusGedung.nama_kolom_statusGedung');
		$this->db->join('tabel_kolom_statusGedung', 'joinTable.last_status =tabel_kolom_statusGedung.id_kolom_statusGedung', 'left');
		$this->db->select('tabel_kolom_kepemilikkan_gedung.kepemilikkan_gedung');
		$this->db->join('tabel_kolom_kepemilikkan_gedung', 'joinTable.kepemilikan =tabel_kolom_kepemilikkan_gedung.id_kepemilikkan_gedung', 'left');
		$this->db->select('tabel_kolom_fungsi_gedung.fungsi_gedung');
		$this->db->join('tabel_kolom_fungsi_gedung', 'joinTable.fungsi =tabel_kolom_fungsi_gedung.id_fungsi_gedung', 'left');
		$this->db->select($tabelFsm.'.nama_FSM');
		$this->db->join($tabelFsm, 'joinTable.fsm ='.$tabelFsm.'.id_FSM', 'left');
		$this->db->select($tabelPokja.'.nama_pokja');
		$this->db->join($tabelPokja, 'joinTable.pokja ='.$tabelPokja.'.id_pokja', 'left');
		if ($kategori !== '%')
		{
			$this->db->where('tabel_kolom_statusGedung.kategori_kolomHslPemeriksaan', $kategori);
		}
		if ($status !== '%')
		{
			$this->db->where('joinTable.last_status', $status);
		}
		if ($kepemilikkan !== '%')
		{
			$this->db->where('joinTable.kepemilikan', $kepemilikkan);
		}
		$this->db->where('joinTable.deleted', 0);
		
		
		//echo 'count gedung';
		//$this->db->select('*');
		//$this->db->from('gedung_dinas');
		//$this->db->where('last_status', $status);
		//$this->db->where('kepemilikan', $kepemilikkan);
		$query = $this->db->get();
		//$jumlah = $query->num_rows();
		//return $jumlah;
		return $query->result_array();
	}


	public function get_ket_status_pemeriksaan($stat_gedung)
	{
		$this->db->select('id_kolom_statusGedung, keterangan_kolom_statusGedung');
		$this->db->from('tabel_kolom_statusGedung');
		$this->db->where('id_kolom_statusGedung', $stat_gedung);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_list_kolom_pemeriksaan()
	{
		$this->db->select('nama_kolom_hslPemeriksaan');
		$this->db->from('tabel_kolom_hslPemeriksaan');
		$query = $this->db->get();
		return $query->result_array();
	}

	function count_all_gedung()
	{
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->db->select('id_gdg_dinas');
		$this->db->from($tabelGedung);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_list_pemilik_gdg()
	{
		$this->db->select('id_kepemilikkan_gedung, kepemilikkan_gedung');
		$this->db->from('tabel_kolom_kepemilikkan_gedung');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_list_status_pemeriksaan($parameter)
	{
		$this->db->select('id_kolom_statusGedung');
		$this->db->from('tabel_kolom_statusGedung');
		$this->db->where('kategori_kolomHslPemeriksaan', $parameter);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_pemeriksaan($coulum_table_pemeriksaan, $tglStart = NULL, $tglEnd = NULL)
	{
		$table_pemeriksaan = $this->config->item('nama_tabel_pemeriksaan');
		$table_hslPemeriksaan = 'tabel_kolom_hslpemeriksaan';
		$table_statGedung = 'tabel_kolom_statusgedung';
		$table_gedung = $this->config->item('nama_tabel_gedung');
		$table_pokja = $this->config->item('nama_tabel_pokja');
		$this->db->select($coulum_table_pemeriksaan);
		$this->db->from($table_pemeriksaan.' as tabelPemeriksaan');
		$this->db->select($table_hslPemeriksaan.'.nama_kolom_hslPemeriksaan');
		$this->db->join($table_hslPemeriksaan, 'tabelPemeriksaan.hasil_pemeriksaan ='.$table_hslPemeriksaan.'.id_kolom_hslPemeriksaan', 'left');
		$this->db->select($table_statGedung.'.nama_kolom_statusGedung');
		$this->db->join($table_statGedung, 'tabelPemeriksaan.status_gedung  ='.$table_statGedung.'.id_kolom_statusGedung', 'left');
		$this->db->select($table_gedung.'.nama_gedung');
		$this->db->select($table_gedung.'.alamat_gedung');
		$this->db->select($table_gedung.'.fungsi');
		$this->db->join($table_gedung, 'tabelPemeriksaan.no_gedungP  ='.$table_gedung.'.no_gedung', 'left');
		$this->db->select($table_pokja.'.nama_pokja');
		$this->db->join($table_pokja, 'tabelPemeriksaan.pokjaP  ='.$table_pokja.'.id_pokja', 'left');
		$this->db->where('tabelPemeriksaan.deleted', 0);
		$this->db->where($table_statGedung.'.deleted', 0);
		$this->db->where($table_gedung.'.nama_gedung !=', NULL);
		$this->db->where('tgl_berlaku >=', $tglStart);
		$this->db->where('tgl_berlaku <=', $tglEnd);
		//$this->db->order_by('tabelPemeriksaan.id_pemeriksaan_dinas', 'Desc');
		//$this->db->limit(10);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function getNoGdgDkGdg()
	{
		$this->db->select('no_gedung');
		$this->db->from('dk_data_gedung');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getAllGdgDkGdg($tblGdg='dk_data_gedung')
	{
		$this->db->select('*');
		$this->db->from($tblGdg);
		$query = $this->db->get();
		return $query->result_array();
	}


	public function getStatP()
	{
		$this->db->select('id_pemeriksaan_dinas, jalur_info1, hasil_pemeriksaan1, status_gedung1');
		$this->db->from('pemeriksaan_dinas_ng');
		$query = $this->db->get();
		return $query->result_array();
	}







	



	

	/**
	* Get product by his is
	* @param int $product_id
	* @return array
	*/

	public function get_migrateData()
	{
		$tabelPemeriksaan = $this->config->item('nama_tabel_pemeriksaan');
		$this->db->select('id_pemeriksaan_dinas');
		$this->db->select('jalur_info1');
		$this->db->select('hasil_pemeriksaan1');
		$this->db->select('status_gedung1');
		$this->db->select('next_status1');
		$this->db->from($tabelPemeriksaan);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_migrateTgl()
	{
		$tabelPemeriksaan = $this->config->item('nama_tabel_pemeriksaan');
		$this->db->select('id_pemeriksaan_dinas');
		$this->db->select('tgl_berlaku1');
		$this->db->select('tgl_expired1');
		$this->db->from($tabelPemeriksaan);
		$query = $this->db->get();
		return $query->result_array();
	}

	function fill_column($id, $data)
	{
		$tabelPemeriksaan = $this->config->item('nama_tabel_pemeriksaan');
		$this->db->where('id_pemeriksaan_dinas', $id);
		$this->db->update($tabelPemeriksaan, $data);
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

	public function get_statusGedung()
	{
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->db->select('id_gdg_dinas,last_status');
		$this->db->from($tabelGedung);
		$query = $this->db->get();
		return $query->result_array();
	}

	function fill_gdg($id, $data)
	{
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->db->where('id_gdg_dinas', $id);
		$this->db->update($tabelGedung, $data);
	}

	public function get_statusPemeriksaan()
	{
		$tabelPemeriksaan = $this->config->item('nama_tabel_pemeriksaan');
		$this->db->select('id_pemeriksaan_dinas');
		$this->db->select('status_gedung');
		$this->db->from($tabelPemeriksaan);
		$query = $this->db->get();
		return $query->result_array();
	}

}
