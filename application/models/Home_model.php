<?php
class Home_model extends CI_Model {

	protected $namaDB;
	protected $tabelGedung;
	protected $tabelPemeriksaan;
	protected $tabelPokja;
	protected $tabelFireHist;

	/**
	* Responsable for auto load the database
	* @return void
	*/
	public function __construct()
	{
		$this->load->database();
		$this->namaDB = $this->config->item('nama_database');
		$this->tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->tabelPemeriksaan = $this->config->item('nama_tabel_pemeriksaan');
		$this->tabelPokja = $this->config->item('nama_tabel_pokja');
		$this->tabelFireHist = $this->config->item('nama_tabel_fire_hist');
	}

	public function count_all_gedung()
	{
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->db->from($tabelGedung);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_expiredGdg()
	{
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->db->from($tabelGedung);
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
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->db->from($tabelGedung);
		$this->db->where('last_status', $lastStatus);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_expiredGdg_byKepemilikkan($kepemilikkan)
	{
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->db->from($tabelGedung);
		$this->db->where('expired', 1);
		$this->db->where('kepemilikan', $kepemilikkan);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_gedung_byKepemilikkan($kepemilikkan)
	{
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->db->from($tabelGedung);
		$this->db->where('kepemilikan', $kepemilikkan);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_gedung_byLastStatusAndKepemilikkan($lastStatus, $kepemilikkan)
	{
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->db->from($tabelGedung);
		$this->db->where('kepemilikan', $kepemilikkan);
		$this->db->where('expired', 0);
		$this->db->where('last_status', $lastStatus);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function get_allPokja()
	{
		$tabelPokja = $this->config->item('nama_tabel_pokja');
		$this->db->select('id_pokja, nama_pokja');
		$this->db->from($tabelPokja);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_pemeriksaan_byMonth($month,$year)
	{
		$tabelPemeriksaan = $this->config->item('nama_tabel_pemeriksaan');
		$this->db->from($tabelPemeriksaan);
		//$this->db->where('tgl_berlaku', $month);
		$this->db->where('MONTH(tgl_berlaku)', $month);
		$this->db->where('YEAR(tgl_berlaku)', $year);
		//$this->db->where('pokjaP', $pokja);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function getDataPemeriksaan()
	{
		$tabelPemeriksaan = $this->config->item('nama_tabel_pemeriksaan');
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$tabelStatusGedung = 'tabel_kolom_statusgedung';
		$this->db->select('nama_pengelola, no_telp_pengelola, tgl_expired');
		$this->db->from($tabelPemeriksaan.' as joinTable');
		//$this->db->select('tabel_kolom_statusGedung.keterangan_kolom_statusGedung');
		$this->db->select('tabel_kolom_statusGedung.kategori_kolomHslPemeriksaan');
		$this->db->select('tabel_kolom_statusGedung.nama_kolom_statusGedung');
		$this->db->join('tabel_kolom_statusGedung', 'joinTable.last_status =tabel_kolom_statusGedung.id_kolom_statusGedung', 'left');
		$this->db->select('tabel_kolom_kepemilikkan_gedung.kepemilikkan_gedung');
		$this->db->join('tabel_kolom_kepemilikkan_gedung', 'joinTable.kepemilikan =tabel_kolom_kepemilikkan_gedung.id_kepemilikkan_gedung', 'left');
		$this->db->select('tabel_kolom_fungsi_gedung.fungsi_gedung');
		$this->db->join('tabel_kolom_fungsi_gedung', 'joinTable.fungsi =tabel_kolom_fungsi_gedung.id_fungsi_gedung', 'left');
		$this->db->select('fsm_dinas.nama_FSM');
		$this->db->join('fsm_dinas', 'joinTable.fsm =fsm_dinas.id_FSM', 'left');
		$this->db->select($tabelPokja.'.nama_pokja');
		$this->db->join($tabelPokja, 'joinTable.pokja ='.$tabelPokja.'.id_pokja', 'left');
		$query = $this->db->get();
		return $query->result_array();
	}

}
