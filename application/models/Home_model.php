<?php
class Home_model extends CI_Model {

	/**
	* Responsable for auto load the database
	* @return void
	*/
	public function __construct()
	{
		$this->load->database();
	}

	public function count_all_gedung()
	{
		$this->db->from('gedung_dinas');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_expiredGdg()
	{
		$this->db->from('gedung_dinas');
		$this->db->where('expired', 1);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_list_status_gedung()
	{
		$this->db->select('id_kolom_statusGedung as idGdg,nama_kolom_statusGedung as statGdg');
		$this->db->from('tabel_kolom_statusGedung');
		$this->db->where('deleted', 0);
		$this->db->order_by('kategori_kolomHslPemeriksaan', 'Asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_all_gedung_byLastStatus($lastStatus)
	{
		$this->db->from('gedung_dinas');
		$this->db->where('last_status', $lastStatus);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_expiredGdg_byKepemilikkan($kepemilikkan)
	{
		$this->db->from('gedung_dinas');
		$this->db->where('expired', 1);
		$this->db->where('kepemilikan', $kepemilikkan);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_gedung_byKepemilikkan($kepemilikkan)
	{
		$this->db->from('gedung_dinas');
		$this->db->where('kepemilikan', $kepemilikkan);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_gedung_byLastStatusAndKepemilikkan($lastStatus, $kepemilikkan)
	{
		$this->db->from('gedung_dinas');
		$this->db->where('kepemilikan', $kepemilikkan);
		$this->db->where('expired', 0);
		$this->db->where('last_status', $lastStatus);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_allPokja()
	{
		$this->db->select('id_pokja, nama_pokja');
		$this->db->from('pokja_dinas');
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_pemeriksaan_byMonth($month,$year,$pokja)
	{
		$this->db->from('pemeriksaan_dinas');
		//$this->db->where('tgl_berlaku', $month);
		$this->db->where('MONTH(tgl_berlaku)', $month);
		$this->db->where('YEAR(tgl_berlaku)', $year);
		$this->db->where('pokjaP', $pokja);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->num_rows();
	}

}
