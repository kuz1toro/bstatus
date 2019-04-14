<?php
//Regex to check date is in YYYY-MM-DD format
if(!function_exists('isValidDate'))
{
	function isValidDate($value)
	{
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value)) {
			return true;
		} else {
			return false;
		}
	}
}

if(!function_exists('msqlDate2html'))
{
	function msqlDate2html($value)
	{
		if(is_null($value) || empty($value) || !isValidDate($value))
		{
			return NULL;
		}else
		{
			$date = date('Y-m-d',strtotime($value));
			$split = explode('-', $date);
            $tanggal = $split[2].'-'.$split[1].'-'.$split[0];
			$temp = date('Y-m-d',strtotime("1500-01-01"));
			if($date < $temp){
				$tgl = NULL;
			} else if ($date >= $temp) {
				$tgl = $tanggal;
			} else {
				$tgl = NULL;
			}
			return ($tgl);
		}
	}
}

if(!function_exists('sqlDate2html'))
{
	function sqlDate2html($value)
	{
		if(is_null($value) || empty($value) || !isValidDate($value))
		{
			return NULL;
		}else
		{
			$bulan = array ('01' => 'Januari',
							'02' => 'Februari',
							'03' => 'Maret',
							'04' => 'April',
							'05' => 'Mei',
							'06' => 'Juni',
							'07' => 'Juli',
							'08' => 'Agustus',
							'09' => 'September',
							'10' => 'Oktober',
							'11' => 'November',
							'12' => 'Desember',
							'00' => NULL
			);
			$date = date('Y-m-d',strtotime($value));
			$split = explode('-', $date);
			$tanggal = $split[2].'-'.$bulan[$split[1]].'-'.$split[0];
			$temp = date('Y-m-d',strtotime("1500-01-01"));
			if($date < $temp){
				$tgl = NULL;
			} else if ($date >= $temp) {
				$tgl = $tanggal;
			} else {
				$tgl = NULL;
			}
			return ($tgl);
		}
	}
}

if(!function_exists('htmlDate2sqlDate'))
{
	function htmlDate2sqlDate($value)
	{
		$bulan = array ('Januari' => '01',
						'Februari' => '02',
						'Maret' => '03',
						'April' => '04',
						'Mei' => '05',
						'Juni' => '06',
						'Juli' => '07',
						'Agustus' => '08',
						'September' => '09',
						'Oktober' => '10',
						'November' => '11',
						'Desember' => '12'
		);
		$split = explode('-', $value);
		$date = $split[0].'-'.$bulan[$split[1]].'-'.$split[2];
		$temp = date('Y-m-d',strtotime("1500-01-01"));
		$value = date('Y-m-d',strtotime("$date"));
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
		$pesan = array('Sukses Ndan', 'Mantab Kali', 'berhasil', 'good job', 'well done', 'nice one', 'very good', 'very nice', 'awesome', 'keep up the good work');
		echo '<div class="modal fade" id="sukses" role="dialog">
			<div class="modal-dialog modal-sm ">
				<div class="modal-content  modal-col-green">
					<div class="modal-body">
						<h3>'.$pesan[rand(0, 9)].'</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
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
				<div class="modal-content modal-col-red">
					<div class="modal-body">
						<h3>Lapor, Data yang terpilih berhasil dihapus</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="updated" role="dialog">
			<div class="modal-dialog modal-sm ">
				<div class="modal-content modal-col-orange">
					<div class="modal-body">
						<h3>Sukses Ndan, data berhasil dirubah</h3>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
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
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
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
		}elseif ($page==='users' && $url1==='admin' && $url2==='index') {
			echo 'active';
		}elseif ($page==='groups' && $url1==='admin' && $url2==='show_groups') {
			echo 'active';
		}elseif ($page==='home' && $url1==='dinas' && $url2==='home') {
			echo 'active';	
		}elseif ($page==='gedung' && $url1==='dinas' && ($url2==='list_gedung' || $url2==='read_gedung' || $url2==='add_gedung' || $url2==='edit_gedung')) {
			echo 'active';
		}elseif ($page==='pemeriksaan' && $url1==='dinas' && ($url2==='list_pemeriksaan' || $url2==='read_pemeriksaan' || $url2==='add_pemeriksaan' || $url2==='edit_pemeriksaan')) {
			echo 'active';
		}elseif ($page==='fsm' && $url1==='dinas' && ($url2==='list_fsm' || $url2==='add_fsm' || $url2==='edit_fsm')) {
			echo 'active';
		}elseif (($page==='setting' || $page==='fungsiGedung') && $url1==='dinas' && ($url2==='list_fungsiGedung' || $url2==='edit_fungsiGedung' || $url2==='add_fungsiGedung')) {
			echo 'active';
		}elseif (($page==='setting' || $page==='kepemilknGedung') && $url1==='dinas' && ($url2==='list_kepemilknGedung' || $url2==='edit_kepemilknGedung' || $url2==='add_kepemilknGedung')) {
			echo 'active';
		}elseif (($page==='setting' || $page==='jalurInfo') && $url1==='dinas' && ($url2==='list_jalurInfo' || $url2==='edit_jalurInfo' || $url2==='add_jalurInfo')) {
			echo 'active';	
		}elseif (($page==='setting' || $page==='hslPemeriksaan') && $url1==='dinas' && ($url2==='list_hslPemeriksaan'|| $url2==='edit_hslPemeriksaan' || $url2==='add_hslPemeriksaan')) {
			echo 'active';
		}elseif (($page==='setting' || $page==='statusGedung') && $url1==='dinas' && ($url2==='list_statusGedung'|| $url2==='edit_statusGedung' || $url2==='add_statusGedung')) {
			echo 'active';
		}elseif (($page==='setting' || $page==='penyebabFire') && $url1==='dinas' && ($url2==='list_penyebabFire'|| $url2==='edit_penyebabFire' || $url2==='add_penyebabFire')) {
			echo 'active';
		}elseif ($page==='pokja' && $url1==='dinas' && ($url2==='list_pokja'|| $url2==='edit_pokja' || $url2==='add_pokja')) {
			echo 'active';
		}elseif ($page==='fireHist' && $url1==='dinas' && ($url2==='list_fireHist'|| $url2==='edit_fireHist' || $url2==='add_fireHist')) {
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

//chek for empty and null post
if(!function_exists('isZonk'))
{
	function isZonk( $post ){
		if (empty($post) || is_null($post))
		{
			return NULL;
		}else
		{
			return $post;
		}
	}
}