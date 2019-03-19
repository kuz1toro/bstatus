<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<a>Hasil Pencarian</a>
			<small></small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Data Gedung</h3>
					</div>
					<div class="box-body">
						<?php if(empty($gedungs)){
							echo '<h3> No Data </h3>';
						}else{
							echo '
						<table id="fixheader1" class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th class="">Nama Gedung</th>
									<th class="">Alamat</th>
									<th class="hidden-xs" >Kepemilikan</th>
									<th class="hidden-xs">Fungsi</th>
									<th class="hidden-xs">Level</th>
									<th class="hidden-xs">No IMB</th>
									<th class="hidden-xs">No Rekomtek</th>
									<th class="hidden-xs">No SLF</th>
									<th class="hidden-xs">No SKK</th>
									<th class="hidden-xs">No LHP</th>
									<th class="hidden-xs">Kepala Insp</th>
								</tr>
							</thead>
							<tbody>';}

								foreach($gedungs as $row)
								{
									echo '<tr>';
									$link = '<a href="'.site_url("prainspeksi_gedung/update").'/'.$row['id'].'">';
									echo '<td>'.$link.''.$row['NamaGedung'].'</a></td>';
									echo '<td>'.$row['Alamat'].','.$row['Kelurahan'].','.$row['Kecamatan'].','.$row['Wilayah'].','.$row['KodePos'].'</td>';
									echo '<td class="hidden-xs">'.$row['Status'].'</td>';
									echo '<td class="hidden-xs">'.$row['Fungsi'].'</td>';
									echo '<td class="hidden-xs">'.$row['Class'].'</td>';
									echo '<td class="hidden-xs">'.$row['NoImb'].'</td>';
									echo '<td class="hidden-xs">'.$row['NoRekomtekAkhir'].'</td>';
									echo '<td class="hidden-xs">'.$row['NoSlfAkhir'].'</td>';
									echo '<td class="hidden-xs">'.$row['NoSkkAkhir'].'</td>';
									echo '<td class="hidden-xs">'.$row['NoLhp'].'</td>';
									echo '<td class="hidden-xs">'.$row['inspector'].'</td>';
									echo '</tr>';
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="box-footer">
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Data Permohonan</h3>
					</div>
					<div class="box-body">
						<table id="fixheader2" class="table table-bordered table-condensed table-hover">
							<thead>
								<tr>
									<th class="">Nama Pengelola</th>
									<th class="">Nama Gedung</th>
									<th class="">Permohonan</th>
									<th class="">No Telp</th>
									<th class="hidden-xs">Kelas</th>
									<th class="hidden-xs">Hasil Eval</th>
									<th class="hidden-xs">Proggres</th>
								</tr>
							</thead>
							<tbody>
								<?php
								//$rows=count($permohonans);
								foreach($permohonans as $row)
								{
									if($row['StatusPermhn']==1){
										$progress='20%';
										$warna='black';
	                }else if($row['StatusPermhn']==2){
										$progress='40%';
										$warna='orange';
	                }else if($row['StatusPermhn']==3){
										$progress='60%';
										$warna='purple';
	                }else if($row['StatusPermhn']==4){
										$progress='80%';
										$warna='blue';
	                }else if($row['StatusPermhn']==5){
										$progress='100%';
										$warna='red';
	                }else{
										$progress='0%';
										$warna='black';
									}
									echo '<tr>';
									$link1 = '<a href="'.site_url("prainspeksi_permohonan/update").'/'.$row['id'].'">';
										echo '<td>'.$link1.''.$row['NamaPengelola'].'</a></td>';
										echo '<td>'.$row['Nama_Gedung_Id'].'</td>';
										echo '<td>'.$row['TipePermhn'].'</td>';
										echo '<td class="hidden-xs">'.$row['NoTelpPengelola'].'</td>';
										echo '<td class="hidden-xs">'.$row['RiskClass'].'</td>';
										echo '<td class="hidden-xs">'.$row['EvalKeslKebakrn'].'</td>';
										echo '<td><span class="badge bg-'.$warna.'">'.$progress.'</span></td>';
									echo '</tr>';
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="box-footer">
					</div>
				</div>
			</div>
		</div>
</section>
</div>
