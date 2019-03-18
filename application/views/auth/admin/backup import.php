<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo lang('index_heading');?>
			<small></small>
		</h1>
		<!--<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
			<li class="active">Users</li>
		</ol>-->
	</section>

	<!-- Main content -->
	<section class="content">
testing 
<br>
<table class="table table-bordered table-hover">
	<!--<caption>Tabel Daftar Gedung</caption>-->
	<thead>
		<tr>
			<th class="header">No</th>
			<th class="">Value 1</th>
			<th class="">Value 1</th>
			<th class="">Value 1</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$lap_ins = array();
		$i=0;
		$xmlReader = new XMLReader();
		$xmlReader->open('xml/tes.html');
		$temp = 'kuswantoro';
		//$key = array (NamaBang);
		while($xmlReader->read()) {
			if($xmlReader->nodeType == XMLReader::ELEMENT) {
				if($xmlReader->localName == 'span') {
					$xmlReader->read();
					//delete spasi
					$output = preg_replace('/\s+/u', ' ', $xmlReader->value);
					//clean up
					$output1 = preg_replace('/^\bI\w\.\w\.\w\W+|^.\bII\w\.\ |^.[A-Z]\w\.*\W|^.\w\.|^\w\.*\W|^\=\s|^([^\w\(]|\_)+|^\w(?![\w\,\.])|\s(?![\:|\w])\W$|\s*[\.\-\:]+\s*$/u', '', $output);
					//filter empty element
					if(!empty($output1) && !is_null($output1) && strlen($output1)>1 ){
						//filter duplicate element
						$comp1 = preg_replace('/\W/u', '', $output1);
						$temp1 = preg_replace('/\W/u', '', $temp);
						/**if (preg_match('/.$temp1./u', $comp1)) {
							$not_d = FALSE;
						} else {
							$not_d = TRUE;
						}*/
						if (stripos($comp1, $temp1) !== false) {
							$not_d = FALSE;
						}else {
							$not_d = TRUE;
						}
						if($not_d){
							$lap_ins[$i]['span'] = $output1;
							$temp = $output1;
						}
					}
				}
				$i++;
			}
		}
		//$val_array = $lap_ins;
		//remove key from val_array
		/**$myRegex = '/^\W*nama bangunan\s*\W*|^\W*Pengelola\s*\W*|^\W*Luas total\s*\W*|^\W*Penggunaan Bangunan\s*\W*|Konstruksi Bangunan|Dinding|Atap|Sistem pasokan daya listrik|Sistem pasokan daya darurat|Nomor IMB|Sertifikat Keselamatan Kebakaran||||||/iu';*/
		$myRegex = array( 'data bangunan', 'nama bangunan', 'pengelola', 'klasifikasi bangunan', 'tinggi bangunan', 'luas bangunan', 'luas total', 'penggunaan bangunan', 'konstruksi bangunan', 'sistem pasokan daya listrik', 'sistem pasokan daya darurat', 'nomor imb', 'imb', 'rekomendasi dinas', 'kmb', 'slf', 'sertifikat keselamatan kebakaran', 'sistem pipa tegak', 'data air', 'data pompa', 'operasi pompa', 'diameter perpipaan', 'hidran gedung', 'kopling pasukan dinas pemadam kebakaran', 'hidran halaman', 'sambungan dinas pemadam', 'sistem springkler otomatis', 'diameter perpipaan', 'katup kendali utama', 'kepala springkler','flow switch & kran pengetesan' ,'sistem deteksi dan alarm kebakaran' ,'panel kontrol' ,'detektor' ,'detektor panas' ,'titik panggil' ,'komunikasi darurat' ,'alat pemadam api ringan' ,'sarana penyelamatan' ,'tangga kebakaran' ,'sistem pengendali asap' ,'kipas penekan asap' ,'kipas penghisap udara' ,'penunjuk arah darurat' ,'exit sign' ,'pencahayaan darurat' ,'lif kebakaran' ,'manajemen keselamatan kebakaran gedung' ,'akses pemadam kebakaran' ,'hasil uji coba' ,'sistem pipa tegak dan slang kebakaran' ,'sistem springkler' ,'sistem deteksi dan alarm kebakaran' ,'komunikasi darurat' ,'pencahayaan darurat' ,'kipas penekan asap' ,'lif kebakaran' ,'catatan' ,'kepala dinas');
		$val_array = array();
		$key_val_array = array();
		$k = 1;
		foreach($lap_ins as $row){
			foreach($myRegex as $row1){
				$val_array [$k]= $row['span'];
				$key_val_array [$k]= $row['span'];
				if (preg_match('/^\W*'.$row1.'\s*\W*/iu', $row['span'])){
					$val_array [$k]= preg_replace( '/^\W*'.$row1.'\s*\W*/iu' , '', $row['span']);
					break;
				}
								
			}
			$k++;
		}
		//save nama jalan
		//print_r($key_val_array);
		$val_array1 = array();
		$key_val_array1 = array();
		$j=1;
		for ($i=1; $i <=count($key_val_array) ; $i++) {
			if (array_key_exists($j, $key_val_array)) {
				if (preg_match('/^\W*jln\s*|^\W*jalan\s*/iu', $key_val_array[$j])){
					$nama_jln = $key_val_array[$j];
					$j++;
						//unset($key_val_array[$i]);
						//unset($val_array[$i]);
						//break;
				}
				if (preg_match('/^\W*Landing Valve\s*/iu', $key_val_array[$j])){
					$j++;
				}
				if (preg_match('/(2012|2013|2014|2015|2016|2017)\W*$/iu', $key_val_array[$j])){
					$tanggal = $key_val_array[$j];
					$j++;
				}
				$val_array1 [$i]= $val_array[$j];
				$key_val_array1 [$i]= $key_val_array[$j];
			}
			$j++;
		}
		//echo '<br><br>';
		//print_r($key_val_array);
		//echo count($val_array);
		
		//print in table
		$j = 1;
		foreach($key_val_array1 as $row){
			echo '<tr>';
			echo '<td>'.$j.'</td>';
			//print_r('<td>'.$output.'</td>');
			echo '<td>'.$key_val_array1[$j].'</td>';
			echo '<td>'.$val_array1[$j].'</td>';
			echo '<td>'.strlen($val_array1[$j]).'</td>';
			echo '</tr>';
			$j++ ;
		}
		//echo $nama_jln;
		//echo $tanggal;
		// build array
		$result_arr = array();
		$key = 0;
		$result_arr = array($key =>array());
		$trash_arr = array();
		$jml_regexs = count($myRegex);
		$sub_regex = array();
		$kons_bang = array ('Kerangka', 'Dinding', 'Atap');
		$data_air = array('Sumber air', 'Volume reservoir');
		$pompa = array('Merk', 'Kapasitas', 'Total head', 'Penggerak', 'Putaran', 'Sistem pengisapan', 'Penempatan', 'Merk', 'Kapasitas', 'Total head', 'Penggerak', 'Putaran', 'Sistem pengisapan', 'Penempatan', 'Merk', 'Kapasitas', 'Total head', 'Penggerak', 'Putaran', 'Sistem pengisapan', 'Penempatan');
		$op_pump = array('Tekanan statis', 'Stand by tekanan', 'hidup', 'mati', 'hidup', 'mati', 'hidup', 'mati');
		$dia_pipa = array('Pipa hisap', 'Pipa penyalur', 'Pipa tegak');
		$hidran_ged = array('Jumlah titik', 'Diameter keluaran', 'Kelengkapan', 'Penempatan');
		$kopling = array('Jumlah titik', 'Diameter keluaran', 'kopling', 'Penempatan');
		$hidran_hal = array('Jumlah titik', 'Diameter keluaran', 'jenis kopling', 'kelengkapan', 'Penempatan');
		$sc = array('Jumlah titik', 'Diameter masukan', 'jenis kopling', 'Penempatan', 'kondisi');
		$dia_pipa1 = array('Pipa hisap', 'Pipa tegak', 'Pipa pembagi', 'Pipa cabang');
		$katup = array('merk', 'Jumlah titik', 'Diameter', 'kelengkapan', 'Penempatan');
		$k_springkler = array('merk', 'Jumlah titik', 'Diameter keluaran', 'temperatur', 'jarak antar', 'Penempatan');
		$flow_swich = array('Jumlah titik', 'Penempatan');
		$panel_ctr = array('merk','kelengkapan', 'Penempatan');
		$detector_smk = array('merk', 'Jumlah titik', 'Penempatan');
		$detector_hot = array('merk', 'Jumlah titik', 'jarak', 'temperatur', 'Penempatan');
		$ttk_pgl = array('Jumlah titik', 'Penempatan');
		$kom_dar = array('Jumlah titik', 'Penempatan');
		$tangga = array('Ukuran', 'Penerangan', 'pintu', 'Penempatan', 'kondisi');
		$pres_fan = array('merk', 'Kapasitas', 'tekanan', 'putaran', 'daya listrik', 'Penempatan');
		$ex_fan = array('merk', 'Kapasitas', 'tekanan', 'putaran', 'daya listrik', 'Penempatan');
		$exit_sign = array('Penempatan', 'warna', 'ukuran', 'sumber daya', 'kondisi');
		$lif_fire = array('merk', 'ukuran', 'kapasitas', 'Penempatan');
		$akses = array('Jumlah akses', 'Lebar akses', 'Tinggi', 'Lebar jalan', 'Radius putaran', 'Perkerasan');

		$sub_regex = array('kerangka', 'dinding', 'atap', 'sumber air', 'volume reservoir', 'merk', 'kapasitas', 'total head', 'penggerak', 'putaran', 'sistem pengisapan', 'penempatan', 'tekanan statis', 'stand by tekanan', 'hidup', 'mati', 'pipa hisap', 'pipa penyalur', 'pipa tegak', 'jumlah titik', 'diameter keluaran', 'kelengkapan', 'kopling', 'jenis kopling', 'diameter masukan', 'kondisi', 'pipa pembagi', 'pipa cabang', 'merk', 'diameter', 'temperatur', 'jarak antar', 'jarak', 'ukuran', 'penerangan', 'pintu', 'tekanan', 'putaran', 'daya listrik', 'warna', 'sumber daya', 'jumlah akses', 'lebar akses', 'tinggi', 'lebar jalan', 'radius putaran', 'perkerasan');
		//$sub_regex = array_merge($kons_bang, $data_air, $pompa, $op_pump, $dia_pipa, $hidran_ged, $kopling, $hidran_hal, $sc, $dia_pipa1, $katup, $k_springkler, $flow_swich, $panel_ctr, $detector_smk, $detector_hot, $ttk_pgl, $kom_dar, $tangga, $pres_fan, $ex_fan, $lif_fire, $katup, $akses);
		$jml_subregexs = count($sub_regex);
		
		/**$i=1;
		$loop = TRUE;
		while ( $loop) {

			if (count($myRegex)<1) {
				$loop = FALSE;
			}
		}
		lihat key_val_array(0) apakah ada yg sama dengan list(0) sampai list(1)?
			yes : lihat result_array (0) ada isi?
				yes: simpan val_array (0) di result_array (0)
				tidak : nothing to do
				result_array (0)++
			tidak : lihat result_array (0) ada isi?
				yes : simpan val_array (0) di result_array (0)(0)
				tidak : nothing to do
		loop

		output:
		nama bangunan => array 
						(
							0 => nama bangunan
							pengelola => array (pengelola)
							Klasifikasi Bangunan => array (klasifikasi)
							.
							.
							Data Air => array(Volume reservoir : 500 m, Persediaan air minimum untuk)
						)
		
		*/
		//console_log('tes');
		$a = 1;
		for ($i=1; $i <=count($key_val_array1) ; $i++) {
			$key_val = $key_val_array1[$i];
			$val = $val_array1[$i];
			$tambah = TRUE;
			//echo "loop $i,";
			for ($j=0; $j <= $jml_regexs ; $j++){
				if (array_key_exists($j, $myRegex)) {
					//echo "array_key_exists,";
					//$current_regex = current($myRegex);
					if (preg_match('/^\W*'.$myRegex[$j].'\s*\W*/iu', $key_val)) {
						//$next_regex = next($myRegex);
						$key = $myRegex[$j];
						$key1 = $myRegex[$j].'.1';
						$key2 = $myRegex[$j].'.2';
						$key3 = $myRegex[$j].'.3';
						if (array_key_exists($myRegex[$j], $result_arr)) {
							$key = $myRegex[$j].'.1';
							$result_arr[$key] = array();
						}else if (array_key_exists($key1, $result_arr)) {
							$key = $key2;
							$result_arr[$key] = array();
						}else if (array_key_exists($key2, $result_arr)) {
							$key = $key3;
							$result_arr[$key] = array();
						}else{
							$result_arr[$key] = array();
						}
						
						//console_log($myRegex[$j]);
						//echo "preg_match,";
						
						unset($myRegex[$j]);
						//d($myRegex);
						
						//$result_arr[$a] = array();
						if (strlen($val)>1) {
							//echo 'strlen,';
							$tambah1 = TRUE;
							for ($k=0; $k <= $jml_subregexs ; $k++){
								if (array_key_exists($k, $sub_regex)) {
									if (preg_match('/^\W*'.$sub_regex[$k].'\s*\W*/iu', $val)) {
										$sub_key = $sub_regex[$k];
										$sub_key1 = $sub_key.'1';
										$sub_key2 = $sub_key.'2';
										$sub_key3 = $sub_key.'3';
										//unset($sub_regex[$k]);
										//echo "preg_match,";
										if (strlen($val)>1) {
											if (array_key_exists($sub_key, $result_arr[$key])) {
												$result_arr[$key][$sub_key.'.1'] = $val;
											}else if( array_key_exists($sub_key1, $result_arr[$key]) ){
												$result_arr[$key][$sub_key2] = $val;
											}else if( array_key_exists($sub_key2, $result_arr[$key]) ){
												$result_arr[$key][$sub_key3] = $val;
											}else{
												$result_arr[$key][$sub_key] = $val;
											}
										}
										$tambah1 = FALSE;
										break;
									}
								}
							}
							if ($tambah1) {
								array_push($result_arr[$key], $val);
							}
							
							//console_log($myRegex[$j]);
							
							//$result_arr [$myRegex[$j]]= $val;
							//$regex_key = array_search($myRegex[$j], $myRegex);
							//unset($myRegex[$j]);
							//d($myRegex);
							//echo count($myRegex);
							//echo 'strlen,';
							
							$tambah = FALSE;
							break;
						}
						break;
					}
				}
				//echo "for loop,";
			}
			if ($tambah) {
				for ($k=0; $k <= $jml_subregexs ; $k++){
					if (array_key_exists($k, $sub_regex)) {
						if (preg_match('/^\W*'.$sub_regex[$k].'\s*\W*/iu', $key_val)) {
							$sub_key = $sub_regex[$k];
							$sub_key1 = $sub_key.'1';
							$sub_key2 = $sub_key.'2';
							$sub_key3 = $sub_key.'3';
							//unset($sub_regex[$k]);
							if (strlen($val)>1) {
								if (array_key_exists($sub_key, $result_arr[$key])) {
									$result_arr[$key][$sub_key.'.1'] = $val;
								}else if( array_key_exists($sub_key1, $result_arr[$key]) ){
									$result_arr[$key][$sub_key2] = $val;
								}else if( array_key_exists($sub_key2, $result_arr[$key]) ){
									$result_arr[$key][$sub_key3] = $val;
								}else{
									$result_arr[$key][$sub_key] = $val;
								}
							}
							$tambah = FALSE;
							break;
						}
					}
				}
			}
			if ($tambah) {
				if (strlen($val)>1) {
						array_push($result_arr[$key], $val);
				}
			}else{
				$trash_arr[$i] = $key_val;
			}
		}
		if (isset($nama_jln)){
			$result_arr['nama jalan'][0] = $nama_jln;
			echo $nama_jln;
		}
		if (isset($tanggal)){
			$result_arr['tanggal'][0] = $tanggal;
			echo $tanggal;
		}
		
		?>
	</tbody>
</table>
<?php 
	echo count($myRegex);
			echo ',';
	echo count($sub_regex);
	//var_dump($lap_ins);
	//echo count($lap_ins);
?> 
<br>
<?php
	//var_dump($bookList[1003]);
	//$output = preg_replace('/\s+/', ' ', $lap_ins);
	//var_dump($output);
	//echo "isi =".$lap_ins[93]['span'].""; 
	//$output = preg_replace('/\s\s+/u', ' ', $lap_ins[93]['span']);
	//echo "isi =".$output."";
	//var_dump($val_array);
	//print_r($result_arr);
	d($result_arr);
	echo '<br>';
	d($trash_arr);
	echo 'Current PHP version: ' . phpversion();
?>

</a>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
