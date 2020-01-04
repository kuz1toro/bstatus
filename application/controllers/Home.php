<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
/*	public function index()
	{
		$this->load->view('public/home/home');
	}
}*/

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->load->view('public/welcome_message');
	}
        
	public function find() {
		
		$search_keyword = $this->input->post('search', true);
		
		$arrData = array();
		
		if($search_keyword == "") {
			$arrData['is_success'] = false;
			$arrData['message'] = "Input harus diisi untuk menemukan data.";
		} else {
			
			$getData = $this->_findData($search_keyword);
			
			$arrData['is_success']  = true;
			$arrData['message']     = '';
			$arrData['rownum']      = $getData['rownum'];
			$arrData['lists']       = $getData['rows'];
		}
		
		echo json_encode($arrData);
		exit;
	}
        
        private function _findData($search_keyword) {
            
            $this->load->model('Search_model', 'search');
            
            $find = $this->search->find_status_gedung($search_keyword);
            
            $data = array();
            
            $data['rownum'] = $find['rownum'];
            $data['rows']   = $this->generateView($find['rows']); //$this->test();
            
            return $data;
        }
        
        private function generateView($rows) {
            
            $str = '<div class="container"><table class="table table-hover table-striped"><tr><td class="th">No</td><td class="th">Nama Gedung</td><td  class="th">Alamat Gedung</td><td  class="th">Status  <a href="#" title="Deskripsi Status Gedung" onclick="$(\'#exampleModalStatusLive\').modal(\'show\');"><i class="fa fa-question-circle" style="color:green" aria-hidden="true"></i></a></td><td class="th">Keterangan  <a href="#" title="Deskripsi Keterangan" onclick="$(\'#exampleModalKeteranganLive\').modal(\'show\');"><i class="fa fa-question-circle" style="color:green" aria-hidden="true"></i></a></td></tr>';
            
            if(isset($rows)) {
                $x = 1;
                foreach($rows as $row) {
                    
                    $hasil = ucwords(str_replace("_"," ", $row->hasil_pemeriksaan));
                    $status = ucwords(str_replace("_"," ", $row->status_gedung));
                    
                    $status = ($status == "LHP Plus") ? 'LHP(+)' : $status;
                    $status = ($status == "LHP Min") ? 'LHP(-)' : $status;
                    
                    $str .= '<tr><td>'.$x.'</td><td><span style="font-size:11px;font-weight:bold;">'.$row->no_gedung.'</span><br><strong><a href="'.$row->link_location.'" target="_blank">'.$row->nama_gedung.'</a></td><td>'.$row->alamat_gedung.'</strong></td><td>'.$hasil.'</td><td>'.$status.'</td></tr>';
                
                    $x++;
                }
            }
            
            $str .= '</div>';
            
            return $str;
        }
        
        public function test() {
            return '<div class="container"><table class="table table-hover table-striped"><tr><td class="th">No</td><td  class="th">Nama Gedung</td><td  class="th">Alamat Gedung</td><td  class="th">Status</td><td  class="th">Keterangan</td></tr><tr><td>1</td><td><strong>Ulpan Dimas</strong><br>Jakarta</td><td>C<br>4825122</td><td>Memenuhi</td><td>SLK</td></tr><tr><td>2</td><td><strong>Ulpan Dimas</strong><br>Jakarta</td><td>C<br>4825122</td><td>Memenuhi</td><td>SLK</td></tr><tr><td>3</td><td><strong>Ulpan Dimas</strong><br>Jakarta</td><td>C<br>4825122</td><td>Memenuhi</td><td>SLK</td></tr><tr><td>4</td><td><strong>Ulpan Dimas</strong><br>Jakarta</td><td>C<br>4825122</td><td>Memenuhi</td><td>SLK</td></tr><tr><td>5</td><td><strong>Ulpan Dimas</strong><br>Jakarta</td><td>C<br>4825122</td><td>Memenuhi</td><td>SLK</td></tr></div>';
        }
                                 
}

