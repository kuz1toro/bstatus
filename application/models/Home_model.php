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

	public function getDataPemeriksaan($now)
	{
		$tabelPemeriksaan = $this->config->item('nama_tabel_pemeriksaan');
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$tabelStatusGedung = 'tabel_kolom_statusgedung';
		$tabelFsm = $this->config->item('nama_tabel_fsm');
		$tabelPokja = $this->config->item('nama_tabel_pokja');
		$this->db->select('id_pemeriksaan_dinas, no_gedungP, nama_pengelola, no_telp_pengelola, tgl_expired, joinTable.deleted');
		$this->db->from($tabelPemeriksaan.' as joinTable');
		//$this->db->select('tabel_kolom_statusGedung.keterangan_kolom_statusGedung');
		$this->db->select($tabelGedung.'.nama_gedung');
		$this->db->join($tabelGedung, 'joinTable.no_gedungP ='.$tabelGedung.'.no_gedung', 'left');
		$this->db->select($tabelStatusGedung.'.nama_kolom_statusGedung');
		$this->db->join($tabelStatusGedung, 'joinTable.status_gedung ='.$tabelStatusGedung.'.id_kolom_statusGedung', 'left');
		$this->db->select($tabelFsm.'.nama_FSM');
		$this->db->join($tabelFsm, 'joinTable.fsmP ='.$tabelFsm.'.id_FSM', 'left');
		$this->db->select($tabelPokja.'.nama_pokja');
		$this->db->join($tabelPokja, 'joinTable.pokjaP ='.$tabelPokja.'.id_pokja', 'left');
		$this->db->where('joinTable.deleted', 0);
		$this->db->where($tabelGedung.'.deleted', 0);
		$this->db->where($tabelGedung.'.nama_gedung !=', NULL);
		$this->db->where('tgl_expired <', $now);
		$this->db->group_by('no_gedungP');
		$this->db->order_by('tgl_expired', 'Asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getNoGedung()
	{
		$tabelGedung = $this->config->item('nama_tabel_gedung');
		$this->db->select('no_gedung');
		$this->db->from($tabelGedung);
		$this->db->where('deleted', 0);
		$query = $this->db->get();
		return $query->result_array();
	}

}
