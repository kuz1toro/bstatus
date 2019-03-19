<?php
class Admin_model extends CI_Model {

	/**
	* Responsable for auto load the database
	* @return void
	*/
	public function __construct()
	{
		$this->load->database();
	}

	function store_imported_data($data)
	{
		if ($this->db->insert('imported_tes', $data)){
			return true;
		}else{
			return false;
		}
	}

	/**$sql= "
	ALTER TABLE `imported` 
	ADD `nama_bangunan` VARCHAR(255) NULL DEFAULT NULL AFTER `id_imported`, 
	ADD `pengelola` VARCHAR(255) NULL DEFAULT NULL AFTER `nama_bangunan`,
	ADD `alamat` VARCHAR(255) NULL DEFAULT NULL AFTER `pengelola`,
	ADD `klasif_bang` VARCHAR(255) NULL DEFAULT NULL AFTER `alamat`,
	ADD `tinggi_bang` VARCHAR(255) NULL DEFAULT NULL AFTER `klasif_bang`,
	ADD `luas_bang` VARCHAR(255) NULL DEFAULT NULL AFTER `tinggi_bang`,
	ADD `luas_total` VARCHAR(255) NULL DEFAULT NULL AFTER `luas_bang`,
	ADD `penggunaan` VARCHAR(255) NULL DEFAULT NULL AFTER `luas_total`,
	ADD `no_imb` VARCHAR(255) NULL DEFAULT NULL AFTER `penggunaan`,
	ADD `no_sertikat` VARCHAR(255) NULL DEFAULT NULL AFTER `no_imb`,
	ADD `klasif_sistem` VARCHAR(255) NULL DEFAULT NULL AFTER `no_sertikat`,
	ADD `tanggal` VARCHAR(255) NULL DEFAULT NULL AFTER `klasif_sistem`,
	ADD `mkkg` VARCHAR(255) NULL DEFAULT NULL AFTER `tanggal`,
	ADD `sis_pipa_tegak` VARCHAR(25000) NULL DEFAULT NULL AFTER `mkkg`,
	ADD `sis_springkler` VARCHAR(25000) NULL DEFAULT NULL AFTER `sis_pipa_tegak`,
	ADD `sis_deteksi` VARCHAR(25000) NULL DEFAULT NULL AFTER `sis_springkler`,
	ADD `komunikasi` VARCHAR(25000) NULL DEFAULT NULL AFTER `sis_deteksi`,
	ADD `pencahayaan` VARCHAR(25000) NULL DEFAULT NULL AFTER `komunikasi`,
	ADD `press_fan` VARCHAR(25000) NULL DEFAULT NULL AFTER `pencahayaan`,
	ADD `lift_fire` VARCHAR(25000) NULL DEFAULT NULL AFTER `press_fan`,
	ADD `kadis` VARCHAR(25000) NULL DEFAULT NULL AFTER `lift_fire`,
	ADD `gedung_id` INT(255) NULL DEFAULT NULL AFTER `kadis`,

	ADD `key_val_arr` VARCHAR(65000) NULL DEFAULT NULL AFTER `gedung_id`, 
	ADD `result_arr` VARCHAR(65000) NULL DEFAULT NULL AFTER `key_val_arr`,
	ADD `result_ujicoba_arr` VARCHAR(65000) NULL DEFAULT NULL AFTER `result_arr`,

	ADD `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `result_ujicoba_arr`, 
	ADD `updated` TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created`";
	*/
}
?>