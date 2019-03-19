<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelengkap_model extends CI_Model
{
	public function get_wilayah()
	{
		$this->db->select('*');
		$this->db->from('tabel_wilayah');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_kecamatan_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('tabel_kecamatan');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	function getData($loadType,$loadId)
	{
		if($loadType=="kecamatan"){
			$fieldList='id,Kecamatan as name';
			$table='tabel_kecamatan';
			$fieldName='Wilayah_K';
			$orderByField='Kecamatan';
		}else if($loadType=="kelurahan"){
			$fieldList='id,Kelurahan as name';
			$table='tabel_kelurahan';
			$fieldName='Kec_k';
			$orderByField='Kelurahan';
		}else{
			$fieldList='id,KodePos as name';
			$table='tabel_kelurahan';
			$fieldName='Kelurahan';
			$orderByField='KodePos';
		}
		$this->db->select($fieldList);
		$this->db->from($table);
		$this->db->where($fieldName, $loadId);
		$this->db->order_by($orderByField, 'asc');
		$query=$this->db->get();
		return $query;
	}
}
