<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Permohonan_model extends CI_Model {

    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    public function searchAllGedung($match)
    {
			$this->db->select('*');
			$this->db->from('tabel_gedung');
      $array = array('Alamat'=> $match,'Kelurahan' => $match,'Kecamatan' => $match,'Wilayah' => $match,'KodePos'=> $match,
										'NoImb'=>$match,'NoRekomtekAkhir'=>$match,'NoSlfAkhir'=>$match,'NoSkkAkhir'=>$match,'NoLhp'=>$match,
										'Status'=>$match,'Fungsi'=>$match,'Class'=>$match,'inspector'=>$match);
			$this->db->like('NamaGedung', $match);
			$this->db->or_like($array);
			$query = $this->db->get();
			return $query->result_array();
    }

		public function searchAllPermohonan($match)
    {
			$this->db->select('tabel_permohonan.id');
			$this->db->select('tabel_permohonan.NamaPengelola');
			$this->db->select('tabel_permohonan.AlamatPengelola');
			$this->db->select('tabel_gedung.NamaGedung as Nama_Gedung_Id');
			$this->db->select('tabel_permohonan.NoTelpPengelola');
			$this->db->select('tabel_permohonan.RiskClass');
			$this->db->select('tabel_permohonan.EvalKeslKebakrn');
			$this->db->select('tabel_permohonan.StatusPermhn');
			$this->db->select('tabel_permohonan.TipePermhn');
			$this->db->from('tabel_permohonan');
			$this->db->join('tabel_gedung', 'tabel_permohonan.NamaGedung_id = tabel_gedung.id', 'left');
      $array = array('AlamatPengelola'=> $match,'NoTelpPengelola' => $match,'RiskClass' => $match,'EvalKeslKebakrn' => $match,		'NamaGedung' => $match);
			$this->db->like('NamaPengelola', $match);
			$this->db->or_like($array);
			$query = $this->db->get();
			return $query->result_array();
    }

    /**
    * Get product by his is
    * @param int $product_id
    * @return array
    */
    public function get_permohonan_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('tabel_permohonan');
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
	/**
    public function get_permohonan($search_string=null, $search_in='NamaPengelola', $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    //echo 'get gedung';
		$this->db->select('*');
		$this->db->from('tabel_permohonan');

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
*/
	public function get_permohonan($search_string=null, $search_in='NamaPengelola', $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    //echo 'get permohonan';
		$this->db->select('tabel_permohonan.id');
		$this->db->select('tabel_permohonan.NamaPengelola');
		$this->db->select('tabel_permohonan.NoTelpPengelola');
		$this->db->select('tabel_gedung.NamaGedung as Nama_Gedung_Id');
		$this->db->select('tabel_permohonan.TipePermhn');
		$this->db->select('tabel_permohonan.NoPermhn');
		$this->db->select('tabel_permohonan.TglPermhn');
		$this->db->select('tabel_permohonan.TglSuratDiterima');
    	$this->db->select('tabel_permohonan.StatusPermhn');
		$this->db->from('tabel_permohonan');

		$this->db->join('tabel_gedung', 'tabel_permohonan.NamaGedung_id = tabel_gedung.id', 'left');

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
    function count_permohonan($search_string=null, $search_in='NamaPengelola', $order=null)
    {
		//echo 'count permohonan';
		$this->db->select('tabel_permohonan.id');
		$this->db->select('tabel_permohonan.NamaPengelola');
		$this->db->select('tabel_permohonan.NoTelpPengelola');
		$this->db->select('tabel_gedung.NamaGedung');
		$this->db->select('tabel_permohonan.TipePermhn');
		$this->db->select('tabel_permohonan.NoPermhn');
		$this->db->select('tabel_permohonan.TglPermhn');
		$this->db->select('tabel_permohonan.TglSuratDiterima');
		$this->db->from('tabel_permohonan');

		$this->db->join('tabel_gedung', 'tabel_permohonan.NamaGedung_id = tabel_gedung.id', 'left');
		if($search_string){
			$this->db->like($search_in, $search_string);
		}

		$this->db->group_by('id');

		$query = $this->db->get();
		/**
		$this->db->select('*');
		$this->db->from('tabel_permohonan');
		if($search_string){
			$this->db->like($search_in, $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		*/
		return $query->num_rows();
	}

	public function get_permohonan_prainspeksi($search_string=null, $search_in='NamaPengelola', $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    //echo 'get permohonan';
		$this->db->select('tabel_permohonan.id');
		$this->db->select('tabel_permohonan.NamaPengelola');
		$this->db->select('tabel_permohonan.NoTelpPengelola');
		$this->db->select('tabel_gedung.NamaGedung as Nama_Gedung_Id');
		$this->db->select('tabel_permohonan.TipePermhn');
		$this->db->select('tabel_permohonan.NoPermhn');
		$this->db->select('tabel_permohonan.TglPermhn');
		$this->db->select('tabel_permohonan.TglSuratDiterima');
		$this->db->select('tabel_permohonan.StatusPermhn');
		$this->db->select('tabel_permohonan.KaInsp');
		$this->db->select('tabel_permohonan.EvalKeslKebakrn');
		$this->db->from('tabel_permohonan');

		$this->db->join('tabel_gedung', 'tabel_permohonan.NamaGedung_id = tabel_gedung.id', 'left');

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

		$this->db->where('StatusPermhn', 2);
		
		$query = $this->db->get();

		return $query->result_array();
    }

	function count_permohonan_prainspeksi($search_string=null, $search_in='NamaPengelola', $order=null)
    {
		//echo 'count permohonan';
		$this->db->select('tabel_permohonan.id');
		$this->db->select('tabel_permohonan.NamaPengelola');
		$this->db->select('tabel_permohonan.NoTelpPengelola');
		$this->db->select('tabel_gedung.NamaGedung');
		$this->db->select('tabel_permohonan.TipePermhn');
		$this->db->select('tabel_permohonan.NoPermhn');
		$this->db->select('tabel_permohonan.TglPermhn');
		$this->db->select('tabel_permohonan.TglSuratDiterima');
		$this->db->from('tabel_permohonan');

		$this->db->join('tabel_gedung', 'tabel_permohonan.NamaGedung_id = tabel_gedung.id', 'left');
		if($search_string){
			$this->db->like($search_in, $search_string);
		}

		$this->db->group_by('id');
        $this->db->where('StatusPermhn', 2);
		$query = $this->db->get();
		return $query->num_rows();
	}

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean (need work)
    */
    function store_permohonan($data)
    {
		$insert = $this->db->insert('tabel_permohonan', $data);
	    return $insert;
	}

    /**
    * Update manufacture
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_permohonan($id, $data)
    {
		$this->db->where('id', $id);
    if ($this->db->update('tabel_permohonan', $data)){
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
	function delete_permohonan($id){
		$this->db->where('id', $id);
		if($this->db->delete('tabel_permohonan')){
      return true;
    }else{
      return false;
    }
	}

	public function get_permohonan_disposisi($search_string=null, $search_in='NamaPengelola', $order=null, $order_type='Asc', $limit_start=null, $limit_end=null, $for='disposisi')
    {
	    //echo 'get permohonan';
		$this->db->select('tabel_permohonan.id');
		$this->db->select('tabel_permohonan.NamaPengelola');
		$this->db->select('tabel_permohonan.NoTelpPengelola');
		$this->db->select('tabel_gedung.NamaGedung as Nama_Gedung_Id');
		$this->db->select('tabel_permohonan.TipePermhn');
		$this->db->select('tabel_permohonan.NoPermhn');
		$this->db->select('tabel_permohonan.TglPermhn');
		$this->db->select('tabel_permohonan.TglSuratDiterima');
		$this->db->select('tabel_permohonan.StatusPermhn');
		$this->db->select('tabel_permohonan.KaInsp');
		$this->db->select('tabel_permohonan.EvalKeslKebakrn');
		$this->db->from('tabel_permohonan');

		$this->db->join('tabel_gedung', 'tabel_permohonan.NamaGedung_id = tabel_gedung.id', 'left');

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
		if($for=='disposisi'){
			$this->db->where('StatusPermhn', 2);
		}else if ($for=='monitoring'){
			$this->db->where('(StatusPermhn IS NOT NULL AND StatusPermhn != "")');
		}else if ($for=='validasi'){
			$this->db->where('StatusPermhn', 4);
		}
		$query = $this->db->get();

		return $query->result_array();
    }

	function count_permohonan_disposisi($search_string=null, $search_in='NamaPengelola', $order=null, $for='disposisi')
    {
		//echo 'count permohonan';
		$this->db->select('tabel_permohonan.id');
		$this->db->select('tabel_permohonan.NamaPengelola');
		$this->db->select('tabel_permohonan.NoTelpPengelola');
		$this->db->select('tabel_gedung.NamaGedung');
		$this->db->select('tabel_permohonan.TipePermhn');
		$this->db->select('tabel_permohonan.NoPermhn');
		$this->db->select('tabel_permohonan.TglPermhn');
		$this->db->select('tabel_permohonan.TglSuratDiterima');
		$this->db->from('tabel_permohonan');

		$this->db->join('tabel_gedung', 'tabel_permohonan.NamaGedung_id = tabel_gedung.id', 'left');
		if($search_string){
			$this->db->like($search_in, $search_string);
		}

		$this->db->group_by('id');
        if($for=='disposisi'){
			$this->db->where('StatusPermhn', 2);
		}else if ($for=='monitoring'){
			$this->db->where('(StatusPermhn IS NOT NULL AND StatusPermhn != "")');
		}else if ($for=='validasi'){
			$this->db->where('StatusPermhn', 4);
		}
		$query = $this->db->get();
		return $query->num_rows();
	}

	 public function get_permohonan_dan_gedung_by_id($id)
    {

		$this->db->select('tabel_permohonan.*');
		$this->db->select('tabel_permohonan.id as permhn_id');
		$this->db->select('tabel_gedung.*');

		$this->db->from('tabel_permohonan');
		$this->db->join('tabel_gedung', 'tabel_permohonan.NamaGedung_id = tabel_gedung.id', 'left');
		$this->db->where('tabel_permohonan.id', $id);
		$query = $this->db->get();

		return $query->result_array();
    }

	public function get_permohonan_inspeksi($search_string=null, $search_in='NamaPengelola', $order=null, $order_type='Asc', $limit_start=null, $limit_end=null, $pokja, $status)
    {
	    //echo 'get permohonan';
		$this->db->select('tabel_permohonan.id');
		$this->db->select('tabel_permohonan.NamaPengelola');
		$this->db->select('tabel_permohonan.NoTelpPengelola');
		$this->db->select('tabel_gedung.NamaGedung as Nama_Gedung_Id');
		$this->db->select('tabel_permohonan.TipePermhn');
		$this->db->select('tabel_permohonan.NoPermhn');
		$this->db->select('tabel_permohonan.TglPermhn');
		$this->db->select('tabel_permohonan.TglSuratDiterima');
		$this->db->select('tabel_permohonan.NoBA');
		$this->db->select('tabel_permohonan.TglBA');
		$this->db->select('tabel_permohonan.EvalKeslKebakrn');
		$this->db->from('tabel_permohonan');

		$this->db->join('tabel_gedung', 'tabel_permohonan.NamaGedung_id = tabel_gedung.id', 'left');

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
        $this->db->where('tabel_permohonan.StatusPermhn', $status);
		$this->db->where('tabel_permohonan.Pokja', $pokja);
		$query = $this->db->get();

		return $query->result_array();
    }

	function count_permohonan_inspeksi($search_string=null, $search_in='NamaPengelola', $order=null, $pokja, $status)
    {
		//echo 'count permohonan';
		$this->db->select('tabel_permohonan.id');
		$this->db->select('tabel_permohonan.NamaPengelola');
		$this->db->select('tabel_permohonan.NoTelpPengelola');
		$this->db->select('tabel_gedung.NamaGedung');
		$this->db->select('tabel_permohonan.TipePermhn');
		$this->db->select('tabel_permohonan.NoPermhn');
		$this->db->select('tabel_permohonan.TglPermhn');
		$this->db->select('tabel_permohonan.TglSuratDiterima');
		$this->db->from('tabel_permohonan');

		$this->db->join('tabel_gedung', 'tabel_permohonan.NamaGedung_id = tabel_gedung.id', 'left');
		if($search_string){
			$this->db->like($search_in, $search_string);
		}

		$this->db->group_by('id');
        $this->db->where('tabel_permohonan.StatusPermhn', $status);
		$this->db->where('tabel_permohonan.Pokja', $pokja);
		$query = $this->db->get();
		/**
		$this->db->select('*');
		$this->db->from('tabel_permohonan');
		if($search_string){
			$this->db->like($search_in, $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		*/
		return $query->num_rows();
	}
}
?>
