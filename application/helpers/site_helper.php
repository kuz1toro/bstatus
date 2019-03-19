<?php

if(!function_exists('sqlDate2html'))
{
	function sqlDate2html($value)
	{
		$temp = date('Y-m-d',strtotime("1971-01-01"));
		if($value < $temp){
			$tgl = NULL;
		} else if ($value >= $temp) {
			$tgl = date('d-M-Y',strtotime("$value"));
		} else {
			$tgl = NULL;
		}
		return ($tgl);
	}
}

if(!function_exists('htmlDate2sqlDate'))
{
	function htmlDate2sqlDate($value)
	{
		$temp = date('Y-m-d',strtotime("1971-01-01"));
		$value = date('Y-m-d',strtotime("$value"));
		if($value < $temp){
			$tgl = NULL;
		} else if ($value >= $temp) {
			$tgl = $value;
		} else {
			$tgl = NULL;
		}
		return ($tgl);
	}
}

if(!function_exists('starSetter'))
{
	function starSetter($value)
	{
		$star0 = '<span class="glyphicon glyphicon-star-empty"></span>';
		$star1 = '<span class="glyphicon glyphicon-star"></span>';
		$star2 = '<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>';
		$star3 = '<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>';
		$star4 = '<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>';
		$star5 = '<span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star"></span>';
		if($value=='5'){
			$tgl = $star5;
		} else if ($value=='4'){
			$tgl = $star4;
		} else if ($value=='3'){
			$tgl = $star3;
		} else if ($value=='2'){
			$tgl = $star2;
		} else if ($value=='1'){
			$tgl = $star1;
		} else {
			$tgl = $star0;
		}
		return ($tgl);
	}
}

if(!function_exists('pesanModal'))
{
	function pesanModal()
	{
		$pesan = array('Sukses Ndan', 'Mantab Kali', '"86"', 'good job', 'well done', 'nice one', 'very good', 'very nice', 'awesome', 'keep up the good work');
		echo '<div class="modal fade" id="sukses" role="dialog">
			<div class="modal-dialog modal-sm ">
				<div class="modal-content">
					<div class="modal-body">
						<h3>'.$pesan[rand(0, 9)].'</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="gagal" role="dialog">
			<div class="modal-dialog modal-sm ">
				<div class="modal-content">
					<div class="modal-body">
						<h3>Gagal Komandan :(</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="deleted" role="dialog">
			<div class="modal-dialog modal-sm ">
				<div class="modal-content">
					<div class="modal-body">
						<h3>Data yang terpilih berhasil dihapus</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="updated" role="dialog">
			<div class="modal-dialog modal-sm ">
				<div class="modal-content">
					<div class="modal-body">
						<h3>Sukses, data berhasil dirubah</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="not_updated" role="dialog">
			<div class="modal-dialog modal-sm ">
				<div class="modal-content">
					<div class="modal-body">
						<h3>Crap, data tidak berhasil dirubah</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="validated_yes" role="dialog">
			<div class="modal-dialog modal-sm ">
				<div class="modal-content">
					<div class="modal-body">
						<h3>Sukses Ndan, validasi berhasil</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="validated_no" role="dialog">
			<div class="modal-dialog modal-sm ">
				<div class="modal-content">
					<div class="modal-body">
						<h3>Data permohonan dikirim kembali ke pokja</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>';
	}
}

if(!function_exists('myRequiredMessage'))
{
	function myRequiredMessage()
	{
		echo 'oninvalid="this.setCustomValidity('."'Kolom ini wajib diisi'".')" oninput="setCustomValidity('."''".')"';
	}
}

//debuging console_log( 'kusw' );
if(!function_exists('console_log'))
{
	function console_log( $data ){
		echo '<script>';
		echo 'console.log('. json_encode( $data ) .')';
		echo '</script>';
	}
}

if(!function_exists('trv_state'))
{
	function trv_state($page, $url1, $url2){
		if($page=='home' && $url1=='prainspeksi_gedung' && $url2=='home'){
			echo 'active';
		}elseif ($page=='gedung' && $url1=='prainspeksi_gedung' && $url2=='index') {
			echo 'active';
		}elseif ($page=='gedung' && $url1=='prainspeksi_gedung' && $url2=='add') {
			echo 'active';
		}elseif ($page=='gedung' && $url1=='prainspeksi_gedung' && $url2=='update') {
			echo 'active';
		}elseif ($page=='permohonan' && $url1=='prainspeksi_permohonan' && $url2=='index') {
			echo 'active';
		}elseif ($page=='permohonan' && $url1=='prainspeksi_permohonan' && $url2=='update') {
			echo 'active';
		}elseif ($page=='permohonan' && $url1=='prainspeksi_permohonan' && $url2=='Add_step1') {
			echo 'active';
		}elseif ($page=='permohonan' && $url1=='prainspeksi_permohonan' && $url2=='Add_step2') {
			echo 'active';
		}elseif ($page=='tutorial' && $url1=='prainspeksi_gedung' && $url2=='tutorial') {
			echo 'active';
		}elseif ($page=='home' && $url1=='disposisi' && $url2=='home') {
			echo 'active';
		}elseif ($page=='gedung' && $url1=='disposisi' && $url2=='list_gedung') {
			echo 'active';
		}elseif ($page=='gedung' && $url1=='disposisi' && $url2=='update_gedung') {
			echo 'active';
		}elseif ($page=='gedung' && $url1=='disposisi' && $url2=='add_gedung') {
			echo 'active';
		}elseif ($page=='permohonan' && $url1=='disposisi' && $url2=='monitoring') {
			echo 'active';
		}elseif ($page=='permohonan' && $url1=='disposisi' && $url2=='update') {
			echo 'active';
		}elseif ($page=='permohonan' && $url1=='disposisi' && $url2=='Add_disposisi_step1') {
			echo 'active';
		}elseif ($page=='permohonan' && $url1=='disposisi' && $url2=='Add_disposisi_step2') {
			echo 'active';
		}elseif ($page=='permohonan' && $url1=='disposisi' && $url2=='validasi') {
			echo 'active';
		}elseif ($page=='permohonan' && $url1=='disposisi' && $url2=='validasi_step2') {
			echo 'active';
		}else{
			echo '';
		}
	}
}

if(!function_exists('jdl_hal'))
{
	function jdl_hal($url1, $url2){
		if($url1=='prainspeksi_gedung' && $url2=='home'){
			echo 'Dashboard';
		}elseif ($url1=='prainspeksi_gedung' && $url2=='index') {
			echo 'Daftar Gedung';
		}elseif ($url1=='prainspeksi_gedung' && $url2=='add') {
			echo 'Tambah Gedung';
		}elseif ($url1=='prainspeksi_gedung' && $url2=='update') {
			echo 'Edit Data Gedung';
		}elseif ($url1=='prainspeksi_permohonan' && $url2=='index') {
			echo 'Daftar Permohonan';
		}elseif ($url1=='prainspeksi_permohonan' && $url2=='update') {
			echo 'Edit Data Permohonan';
		}elseif ($url1=='prainspeksi_permohonan' && $url2=='Add_step1') {
			echo 'Tambah Permohonan';
		}elseif ($url1=='prainspeksi_permohonan' && $url2=='Add_step2') {
			echo 'Tambah Permohonan';
		}elseif ($url1=='disposisi' && $url2=='home') {
			echo 'Dashboard';
		}elseif ($url1=='disposisi' && $url2=='list_gedung') {
			echo 'Daftar Gedung';
		}elseif ($url1=='disposisi' && $url2=='update_gedung') {
			echo 'Edit Data Gedung';
		}elseif ($url1=='disposisi' && $url2=='add_gedung') {
			echo 'Tambah Gedung';
		}elseif ($url1=='disposisi' && $url2=='monitoring') {
			echo 'Monitoring Permohonan';
		}elseif ($url1=='disposisi' && $url2=='update') {
			echo 'Edit Data Permohonan';
		}elseif ($url1=='disposisi' && $url2=='Add_disposisi_step1') {
			echo 'Disposisi Permohonan';
		}elseif ($url1=='disposisi' && $url2=='Add_disposisi_step2') {
			echo 'Disposisi Permohonan';
		}elseif ($url1=='disposisi' && $url2=='validasi') {
			echo 'Validasi Permohonan';
		}else{
			echo '';
		}
	}
}