<br><br>
<div class="col-sm-12 hidden-xs" style="position: fixed; z-index:0; background:blue;" >
	<h2 style="color:white">
		Updating
	</h2>
	<h2 style="color:white">
		Permohonan
	</h2>
	<p class="pull-right hidden-xs" style="color:white">kolom bertanda <a style="color:red">*</a> wajib di isi</p>
</div>

<!-- mobile page header-->
<div class="col-xs-12 hidden-sm hidden-md hidden-lg" style="background:blue;" >
	<h2 style="color:white">
		Updating Gedung
	</h2>
</div>

<!-- filler-->	 
<div class="col-sm-12 hidden-xs" style="margin: 0 auto; position: fixed; text-align:center; z-index:-5; height: 30%; background: blue " >
</div>

<div class="container">
      
	<!-- Modal alert-->
	<?php pesanModal(); 
	//flash messages
		if($this->session->flashdata('flash_message')=='updated'){
			echo'<script>
				window.onload = function(){
				$("#sukses").modal();
				};
				</script>';
			$this->session->set_flashdata('flash_message', '');
		}
		else if(validation_errors())
			{ echo'<script>
				window.onload = function(){
				$("#gagal").modal();
				};
				</script>';
			}
	?>
      
    <?php
    //form data
    $attributes = array('class' => 'form-horizontal', 'id' => '');

    echo form_open('disposisi/permohonan/update/'.$this->uri->segment(4).'', $attributes);
    ?>
	
	<br>
	<?php $style1 = 'width:65%; margin: 0 auto; position: relative;z-index:0; background:#f2e5f2; box-shadow: 17px 14px 5px 0px rgba(0,0,0,0.75);';
		  $style2 = 'background:#f2e5f2; box-shadow: 17px 14px 5px 0px rgba(0,0,0,0.75);'; ?>
	<form class="form-horizontal" style="">
		<div  class="<?php if ($this->agent->is_mobile()){echo 'col-xs-12';} ?>" id="" style="<?php if (! $this->agent->is_mobile()){echo $style1;} ?>" >
			
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" id="headingOne" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						<h4 class="panel-title">
							Data Gedung
						</h4>
					</div>
					<div>
						<div class="panel-body" >
							<div class="col-sm-12" >
								<div class="form-group" style="">
									<label class="col-sm-4 control-label" for="NamaGedung" style="">Nama Gedung </label>  
									<div class="col-sm-4 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:50%';} ?>">
										<textarea type="text" class="form-control" name="NamaGedung" style="resize: none;" readonly><?php echo $manufacture[0]['NamaGedung']; ?></textarea>  
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group " style="">
									<label class="col-sm-4 control-label" for="Alamat">Alamat</label>  
									<div class="col-sm-4 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:50%';} ?>">
										<textarea type="text" class="form-control" name="Alamat"  style="resize: none;" readonly><?php echo $manufacture[0]['Alamat']; ?></textarea>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="form-group " style="">
									<label class="col-sm-4 control-label" for=""></label>
									<div class="col-sm-2 col-xs-5" id="" style="<?php if (! $this->agent->is_mobile()){echo 'width:19%';} ?>" readonly>
										<select class="form-control" name="Wilayah" value="" id="Wilayah" onchange="selectKec(this.options[this.selectedIndex].value)" disabled>
													<option value="<?php echo $manufacture[0]['Wilayah']; ?>"><?php echo $manufacture[0]['Wilayah']; ?></option>
													<option value="Pusat">Pusat</option>
													<option value="Utara">Utara</option>
													<option value="Barat">Barat</option>
													<option value="Selatan">Selatan</option>
													<option value="Timur">Timur</option>
													<option value="P1000">P1000</option>
										</select>
										<p class="help-block">Wilayah</p>
									</div>
									<div class="col-sm-2 col-xs-7" id="" style="<?php if (! $this->agent->is_mobile()){echo 'width:30%';} ?>">
										<select class="form-control" id="kecamatan_dropdown" name="Kecamatan" onchange="selectKel(this.options[this.selectedIndex].value)" disabled>
											<option value="<?php echo $manufacture[0]['Kecamatan']; ?>"><?php echo $manufacture[0]['Kecamatan']; ?></option>
										</select>
										<p class="help-block">Kecamatan</p>
									</div>
									<label class="col-sm-4 control-label" for=""></label>
									<div class="col-sm-2 col-xs-7" id="" style="<?php if (! $this->agent->is_mobile()){echo 'width:30%';} ?>">
										<select class="form-control" id="kelurahan_dropdown" name="Kelurahan" onchange="showKodepos(this.options[this.selectedIndex].value)" disabled>
											<option value="<?php echo $manufacture[0]['Kelurahan']; ?>"><?php echo $manufacture[0]['Kelurahan']; ?></option>
										</select>
										<p class="help-block">Kelurahan</p>
									</div>
									<div class="col-sm-2 col-xs-4" id="" style="<?php if (! $this->agent->is_mobile()){echo 'width:17%';} ?>">
										<input type="text" class="form-control" name="KodePos" id="kodepos_dropdown" value= "<?php echo $manufacture[0]['KodePos']; ?>" readonly>
										<p class="help-block">Kode Pos</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" >
						<div class="panel-body" >
							<div class="col-sm-12">
								<div class="form-group" style="">
									<label class="col-sm-4 control-label" for="Status">Data Gedung</label>  
									<div class="col-sm-2 col-xs-8" id="" style="<?php if (! $this->agent->is_mobile()){echo 'width:28%';} ?>">
										<select class="form-control" name="Status" disabled>
													<option value="<?php echo $manufacture[0]['Status']; ?>"><?php echo $manufacture[0]['Status']; ?></option>
													<option value="Swasta" <?php if ($manufacture[0]['Status']=='Swasta'){echo 'hidden';}?>>Swasta</option>
													<option value="Pemda DKI" <?php if ($manufacture[0]['Status']=='Pemda DKI'){echo 'hidden';}?>>Pemda DKI</option>
													<option value="Pemerintah Non-DKI" <?php if ($manufacture[0]['Status']=='Pemerintah Non-DKI'){echo 'hidden';}?>>Pemerintah Non-DKI</option> </select>
										</select>
										<p class="help-block">Status Kepemilikan </p>
									</div>
									<div class="col-sm-2 col-xs-7" id="" style="<?php if (! $this->agent->is_mobile()){echo 'width:25%';} ?>">
										<select class="form-control" name="Fungsi" disabled>
													<option value="<?php echo $manufacture[0]['Fungsi']; ?>"><?php echo $manufacture[0]['Fungsi']; ?></option>
													<option value="Perkantoran">Perkantoran</option>
													<option value="Perdagangan">Perdagangan</option>
													<option value="Hotel">Hotel</option>
													<option value="Bisnis Lainnya">Bisnis Lainnya</option>
													<option value="Apartemen">Apartemen</option>
													<option value="Rusun">Rusun</option>
													<option value="Hunian Lainnya">Hunian Lainnya</option>
													<option value="Pendidikan">Pendidikan</option>
													<option value="Kesehatan">Kesehatan</option>
													<option value="SosBud Lainnya">SosBud Lainnya</option>
													<option value="Mix-Use">Mix-Use</option>
										</select>
										<p class="help-block">Fungsi </p>
									</div>
									<label class="col-sm-4 control-label" for=""></label>
									<div class="col-sm-2 col-xs-4" style="<?php if (! $this->agent->is_mobile()){echo 'width:15%';} ?>">
										<input type="number" class="form-control" name="JmlMasaBang" id="" placeholder="" value= "<?php echo $manufacture[0]['JmlMasaBang']; ?>" readonly>
										<p class="help-block">Jml Tower </p>
									</div>
									<div class="col-sm-2 col-xs-4" style="<?php if (! $this->agent->is_mobile()){echo 'width:15%';} ?>">
										<input type="number" class="form-control" name="Lantai" id="" placeholder="" value= "<?php echo $manufacture[0]['Lantai']; ?>" readonly>
										<p class="help-block">Jml Lantai </p>
									</div>
									<div class="col-sm-2 col-xs-4" style="<?php if (! $this->agent->is_mobile()){echo 'width:20%';} ?>">
										<input type="number" class="form-control" name="Basement" id="" placeholder="" value= "<?php echo $manufacture[0]['Basement']; ?>" readonly>
										<p class="help-block">Jml Bismen</p>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group" style="">
									<label class="col-sm-4 control-label" for="NoImb">IMB</label>
									<div class="col-sm-3">                     
										<input type="text" class="form-control" name="NoImb" id="" value= "<?php echo $manufacture[0]['NoImb']; ?>" readonly>
										<p class="help-block">No IMB</p>
									</div>
									<div class="col-sm-3">                     
										<input type="text" class="form-control" name="TglImb" id=""  value= "<?php echo sqlDate2html($manufacture[0]['TglImb']); ?>" readonly>
										<p class="help-block">Tgl IMB</p>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label" for="NoRekomtekAkhir">Rekomtek Terakhir</label>
								<div class="col-sm-3">                     
									<input type="text" class="form-control" name="NoRekomtekAkhir" id=""  value= "<?php echo $manufacture[0]['NoRekomtekAkhir']; ?>" readonly>
									<p class="help-block">No Rekomtek</p>
								</div>
								<div class="col-sm-3">                     
									<input type="text" class="form-control" name="TglRekomtekAkhir" id="" value= "<?php echo sqlDate2html($manufacture[0]['TglRekomtekAkhir']); ?>" readonly>
									<p class="help-block">Tgl Rekomtek</p>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group" style="">
									<label class="col-sm-4 control-label" for="NoSlfAkhir">SLF Terakhir</label>
									<div class="col-sm-3">                     
										<input type="text" class="form-control" name="NoSlfAkhir" id="" value= "<?php echo $manufacture[0]['NoSlfAkhir']; ?>" readonly>
										<p class="help-block">No SLF</p>
									</div>
									<div class="col-sm-3">                     
										<input type="text" class="form-control" name="TglSlfAkhir" id=""  value= "<?php echo sqlDate2html($manufacture[0]['TglSlfAkhir']); ?>" readonly>
										<p class="help-block">Tgl SLF</p>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label" for="NoSkkAkhir">SKK Terakhir</label>
								<div class="col-sm-3">                     
									<input type="text" class="form-control" name="NoSkkAkhir" id=""  value= "<?php echo $manufacture[0]['NoSkkAkhir']; ?>" readonly>
									<p class="help-block">No SKK</p>
								</div>
								<div class="col-sm-3">                     
									<input type="text" class="form-control" name="TglSkkAkhir" id="" value= "<?php echo sqlDate2html($manufacture[0]['TglSkkAkhir']); ?>" readonly>
									<p class="help-block">Tgl SKK</p>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group" style="">
									<label class="col-sm-4 control-label" for="NoLhp">LHP Terakhir</label>
									<div class="col-sm-3">                     
										<input type="text" class="form-control" name="NoLhp" id="" value= "<?php echo $manufacture[0]['NoLhp']; ?>" readonly>
										<p class="help-block">No LHP</p>
									</div>
									<div class="col-sm-3">                     
										<input type="text" class="form-control" name="TglLhp" id=""  value= "<?php echo sqlDate2html($manufacture[0]['TglLhp']); ?>" readonly>
										<p class="help-block">Tgl LHP</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-heading" role="button" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						<h4 class="panel-title">
							Data Permohonan
						</h4>
					</div>
					<div>
						<div class="panel-body" >
							<div class="col-sm-12">
								<div class="form-group " style="">
									<label class="col-sm-4 control-label" for="NamaPengelola">Pengelola</label>  
									<div class="col-sm-6 col-xs-12" style="">
										<input type="text" class="form-control" name="NamaPengelola" value= "<?php echo $manufacture[0]['NamaPengelola']; ?>" required <?php myRequiredMessage();?> >
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							<div class="col-sm-12">
								<div class="form-group " style="">
									<label class="col-sm-4 control-label" for=""></label>
									<div class="col-sm-3 col-xs-12" style="">
										<input type="text" class="form-control" name="NoTelpPengelola" id="" value= "<?php echo $manufacture[0]['NoTelpPengelola']; ?>">
										<p class="help-block">No. Telp/ Hp </p>
									</div>
									<label class="col-sm-4 control-label" for=""></label>
									<div class="col-sm-4 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:50%';} ?>">
										<textarea type="text" class="form-control" name="AlamatPengelola"  style="resize: none;" ><?php echo $manufacture[0]['AlamatPengelola']; ?></textarea>
										<p class="help-block">Alamat Pengelola </p>
									</div>
									<label class="col-sm-4 control-label" for="NoPermhn">Permohonan</label>  
									<div class="col-sm-3 col-xs-12" style=" ">
										<input type="text" class="form-control" name="NoPermhn" value= "<?php echo $manufacture[0]['NoPermhn']; ?>" >
										<p class="help-block">No. Permohonan </p>
									</div>
									<div class="col-sm-3 col-xs-12" style=" ">
										<input type="text" class="form-control" name="TglPermhn" id="Datepicker" value= "<?php echo sqlDate2html($manufacture[0]['TglPermhn']); ?>">
										<p class="help-block">Tgl Permohonan </p>
									</div>
									<label class="col-sm-4 control-label" for=""></label>
									<div class="col-sm-3 col-xs-12" style=" ">
										<input type="text" class="form-control" name="TglSuratDiterima" id="Datepicker1" value= "<?php echo sqlDate2html($manufacture[0]['TglSuratDiterima']); ?>">
										<p class="help-block">Tgl Surat Diterima </p>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group " style="">
									<label class="col-sm-4 control-label" for="TipePermhn">Jenis Permohonan</label>  
									<div class="col-sm-4 col-xs-12" style=" ">
										<select class="form-control" name="TipePermhn" >
													<option value="<?php echo $manufacture[0]['TipePermhn']; ?>"><?php echo $manufacture[0]['TipePermhn']; ?></option>
													<option value="Sewaktu-waktu" <?php if ($manufacture[0]['TipePermhn']=='Sewaktu-waktu'){echo 'hidden';}?>>Sewaktu-waktu</option>
													<option value="Rekomtek Sistem" <?php if ($manufacture[0]['TipePermhn']=='Rekomtek Sistem'){echo 'hidden';}?>>Rekomtek Sistem</option>
													<option value="Rekomtek SKK" <?php if ($manufacture[0]['TipePermhn']=='Rekomtek SKK'){echo 'hidden';}?>>Rekomtek SKK</option>
													<option value="SLF" <?php if ($manufacture[0]['TipePermhn']=='SLF'){echo 'hidden';}?>>SLF</option>
													<option value="SLFn" <?php if ($manufacture[0]['TipePermhn']=='SLFn'){echo 'hidden';}?>>SLFn</option>									
										</select>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label" for="checkboxes">Kelengkapan Dokumen</label>
								<div class="col-sm-4">
									<div class="checkbox">
									<label for="SuratPermohonan">
										<input type="checkbox" name="SuratPermohonan" id="SuratPermohonan" value="1" <?php if ($manufacture[0]['SuratPermohonan']=='1'){echo 'checked';}?> >
										Surat Permohonan
									</label>
									</div>
									<div class="checkbox">
									<label for="DokTeknisGedung">
										<input type="checkbox" name="DokTeknisGedung" id="DokTeknisGedung" value="1" <?php if ($manufacture[0]['DokTeknisGedung']=='1'){echo 'checked';}?> >
										Dokumen Teknis Gedung
									</label>
									</div>
									<div class="checkbox">
									<label for="DokInventarisApar">
										<input type="checkbox" name="DokInventarisApar" id="DokInventarisApar" value="1" <?php if ($manufacture[0]['DokInventarisApar']=='1'){echo 'checked';}?> >
										Dokumen Inventaris APAR
									</label>
									</div>
									<div class="checkbox">
									<label for="DokMKKG">
										<input type="checkbox" name="DokMKKG" id="DokMKKG" value="1" <?php if ($manufacture[0]['DokMKKG']=='1'){echo 'checked';}?> >
										Dokumen MKKG
									</label>
									</div>
									<div class="checkbox">
									<label for="FtcpGambarSchematic">
										<input type="checkbox" name="FtcpGambarSchematic" id="FtcpGambarSchematic" value="1" <?php if ($manufacture[0]['FtcpGambarSchematic']=='1'){echo 'checked';}?> >
										Fc Gambar Schematik
									</label>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="checkbox">
									<label for="FtcpSiteplan">
										<input type="checkbox" name="FtcpSiteplan" id="FtcpSiteplan" value="1" <?php if ($manufacture[0]['FtcpSiteplan']=='1'){echo 'checked';}?> >
										Fc Siteplan
									</label>
									</div>
									<div class="checkbox">
									<label for="FtcpRkkSlf">
										<input type="checkbox" name="FtcpRkkSlf" id="FtcpRkkSlf" value="1" <?php if ($manufacture[0]['FtcpRkkSlf']=='1'){echo 'checked';}?> >
										Fotokopi SLF
									</label>
									</div>
									<div class="checkbox">
									<label for="FtcpIMB">
										<input type="checkbox" name="FtcpIMB" id="FtcpIMB" value="1" <?php if ($manufacture[0]['FtcpIMB']=='1'){echo 'checked';}?> >
										Fotokopi IMB
									</label>
									</div>
									<div class="checkbox">
									<label for="FtcpSkkAkhir">
										<input type="checkbox" name="FtcpSkkAkhir" id="FtcpSkkAkhir" value="1" <?php if ($manufacture[0]['FtcpSkkAkhir']=='1'){echo 'checked';}?> >
										Fotokopi SKK
									</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="panel panel-primary">
					<div class="panel-heading" id="">
						<h4 class="panel-title">
								Data Disposisi
						</h4>
					</div>
					<div id="DataDisposisi" class="" >
						<div class="panel-body">
							<div class="col-sm-12">
								<div class="form-group" style="">
									<label class="col-sm-4 control-label" for="TglDisKadis" style="">Tanggal Disposisi </label>  
									<div class="col-sm-2 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:20%';} ?>">
										<input type="text" class="form-control" name="TglDisKadis" id="Datepicker2" value= "<?php echo sqlDate2html($manufacture[0]['TglDisKadis']); ?>">
										<p class="help-block">Kadis</p>
									</div>
									<div class="col-sm-2 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:20%';} ?>">
										<input type="text" class="form-control" name="TglDisKabid" id="Datepicker3" value= "<?php echo sqlDate2html($manufacture[0]['TglDisKabid']); ?>">
										<p class="help-block">Kabid</p>
									</div>
									<div class="col-sm-2 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:20%';} ?>">
										<input type="text" class="form-control" name="TglDisKasi" id="Datepicker4" value= "<?php echo sqlDate2html($manufacture[0]['TglDisKasi']); ?>">
										<p class="help-block">Kasie</p>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group " >
									<label class="col-sm-4 control-label" for="TglPerbalST">Tanggal Perbal Surat Tugas</label>  
									<div class="col-sm-4 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:25%';} ?>">
										<input type="text" class="form-control" name="TglPerbalST" id="Datepicker5" value= "<?php echo sqlDate2html($manufacture[0]['TglPerbalST']); ?>">
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group " >
									<label class="col-sm-4 control-label" for="Pokja">Pokja</label>  
									<div class="col-sm-4 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:20%';} ?>">
										<select class="form-control" name="Pokja" onchange="selectKaInsp(this.options[this.selectedIndex].value)">
											<option value= "<?php echo $manufacture[0]['Pokja']; ?>"><?php echo $manufacture[0]['Pokja']; ?></option>
											<option value="pokja 1">Pokja I</option>
											<option value="pokja 2">Pokja II</option>
											<option value="pokja 3">Pokja III</option>
											<option value="pokja 4">Pokja IV</option>
											<option value="pokja 5">Pokja V</option>
										</select>
									</div>
									<div class="col-sm-4 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:35%';} ?>">
										<input type="text" class="form-control" name="KaInsp" id="KaInsp" placeholder="automatic" value= "<?php echo $manufacture[0]['KaInsp']; ?>" readonly>
									</div>
								</div>
							</div>
							
							<div class="col-sm-12">
								<div class="form-group " >
									<label class="col-sm-4 control-label" for="StatusPermhn">Posisi Permohonan</label>  
									<div class="col-sm-4 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:25%';} ?>">
										<select class="form-control" name="StatusPermhn">
											<option value= "<?php echo $manufacture[0]['StatusPermhn']; ?>"><?php if ($manufacture[0]['StatusPermhn']=='2'){echo 'Disposisi';}else if ($manufacture[0]['StatusPermhn']=='3') {echo 'Inspeksi';} else if ($manufacture[0]['StatusPermhn']=='4') {echo 'Validasi';} else if ($manufacture[0]['StatusPermhn']=='5') {echo 'Pasca Inspeksi';} else {echo 'Undefine';} ?></option>
											<option value="2">Disposisi</option>
											<option value="3">Inspeksi</option>
											<option value="4">Validasi</option>
											<option value="5">Pasca Inspeksi</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!--tidak ditampilkan-->
				<!--<input type="text" id="" name="StatusPermhn" value="3" style="display: none;">-->
				<input type="text" id="" name="No_id" value="<?php echo $manufacture[0]['permhn_id']; ?>" style="display: none;" >
			
				<div class="col-sm-12 col-xs-20" id="appr" >
					<div class="form-actions" id="" style="text-align: center;">
						<button class="btn btn-primary" type="submit">Simpan</button>
						<button class="btn" type="reset">Cancel</button>
					</div>    
				</div>		  
			</div>
		</div>
      <?php echo form_close(); ?>

    </form>
</div>
     
	<script language="javascript" type="text/javascript">
	function selectKaInsp(val){
		if(val=="pokja 1"){
			$("#KaInsp").val("Udiyono");
		}else if (val=="pokja 2"){
			$("#KaInsp").val("Bambang Andanawari, SST");
		}else if (val=="pokja 3"){
			$("#KaInsp").val("Sidik, S.T.");
		}else if (val=="pokja 4"){
			$("#KaInsp").val("Miyanto, S.E.");
		}else if (val=="pokja 5"){
			$("#KaInsp").val("Suparman");
		}else{
			$("#KaInsp").val("?");
	  }
	}
</script>
     