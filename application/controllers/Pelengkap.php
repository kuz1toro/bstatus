<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pelengkap extends CI_Controller {

	/**
	* name of the folder responsible for the views
	* which are manipulated by this controller
	* @constant string
	*/
	const VIEW_FOLDER = 'prainspeksi/permohonan';

	/**
	* Responsable for auto load the model
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelengkap_model');
	}

	public function loadData()
	{
		$loadType=$_POST['loadType'];
		$loadId=$_POST['loadId'];
		//$this->load->model('model');
		$result=$this->pelengkap_model->getData($loadType,$loadId);
		$HTML=null;

		if($loadType=='kodepos'){
			foreach($result->result() as $list){
				$HTML.="".$list->name.""; }
			}else if($result->num_rows() > 0){
				foreach($result->result() as $list){
					$HTML.="<option value='".$list->name."'>".$list->name."</option>";
				}
			}
			echo $HTML;
		}
	}
