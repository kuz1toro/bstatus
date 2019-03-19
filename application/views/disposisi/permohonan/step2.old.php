<br><br><br>
<div class="container">
	<ul class="breadcrumb" style="">
		<li>
			<a >
			<?php echo ucfirst($this->uri->segment(1));?>
			</a> 
		</li>
        <li>
			<a >
            <?php echo ucfirst($this->uri->segment(2));?>
			</a> 
        </li>
        <li>
			<a >Disposisi Permohonan Step 1</a>
		</li>
		<li class="active">
			Disposisi Permohonan Step 2
        </li>
	</ul>
      
	<?php
      //flash messages
		if($this->session->flashdata('flash_message')){
			if($this->session->flashdata('flash_message') == 'updated')
			{
				echo '<div class="alert alert-success">';
				echo '<a class="close" data-dismiss="alert">×</a>';
				echo '<strong>Sukses mas bro!</strong> udah di update datenye.';
				echo '</div>';
			}else{
				echo '<div class="alert alert-error">';
				echo '<a class="close" data-dismiss="alert">×</a>';
				echo '<strong>hmm gagal mas bro!</strong> tanya kenapa?.';
				echo '</div>';          
			}
		}
	?>
      
	<?php
    //form data
	$attributes = array('class' => 'form-horizontal', 'id' => '');

      //form validation
      //echo validation_errors();
	
	  //kalau sukses atau gagal buka ini
      echo form_open('disposisi/permohonan/Add_disposisi_step3', $attributes);
      ?>
	  
	
	<div class="row">
		<div class="col-sm-4">
			<div class="" style="">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					<div class="panel panel-primary">
						<div class="panel-heading" id="headingOne" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							<h4 class="panel-title">
								Data Gedung
							</h4>
						</div>
						<div>
							<div class="panel-body" >
								<div class="col-sm-12" >
									<div class="form-group" style="">
										<label class="control-label" for="NamaGedung" style="">Nama Gedung </label>  
										<div class="" style="">
											<textarea type="text" class="form-control" name="NamaGedung" style="resize: none;" readonly><?php echo $manufacture[0]['NamaGedung']; ?></textarea>  
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group " style="">
										<label class="control-label" for="Alamat">Alamat</label>  
										<div class="" style="">
											<textarea type="text" class="form-control" name="Alamat"  style="resize: none;" readonly><?php echo $manufacture[0]['Alamat']; ?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" >
							<div class="panel-body" >
								<div class="col-sm-12">
									<div class="form-group " style="">
										<div class="row">
											<div class="col-sm-6 col-xs-12" id="" style="" readonly>
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
											<div class="col-sm-6 col-xs-12" id="" style="">
												<select class="form-control" id="kecamatan_dropdown" name="Kecamatan" onchange="selectKel(this.options[this.selectedIndex].value)" disabled>
													<option value="<?php echo $manufacture[0]['Kecamatan']; ?>"><?php echo $manufacture[0]['Kecamatan']; ?></option>
												</select>
												<p class="help-block">Kecamatan</p>
											</div>
											<div class="col-sm-6 col-xs-12" id="" style="">
												<select class="form-control" id="kelurahan_dropdown" name="Kelurahan" onchange="showKodepos(this.options[this.selectedIndex].value)" disabled>
													<option value="<?php echo $manufacture[0]['Kelurahan']; ?>"><?php echo $manufacture[0]['Kelurahan']; ?></option>
												</select>
												<p class="help-block">Kelurahan</p>
											</div>
											<div class="col-sm-6 col-xs-12" id="" style="">
												<input type="text" class="form-control" name="KodePos" id="kodepos_dropdown" value= "<?php echo $manufacture[0]['KodePos']; ?>" readonly>
												<p class="help-block">Kode Pos</p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group" style="">
										<label class="control-label" for="Status">Fisik Gedung</label>
										<div class="row">
											<div class="col-sm-6 col-xs-12" id="" style="">
												<select class="form-control" name="Status" disabled>
															<option value="<?php echo $manufacture[0]['Status']; ?>"><?php echo $manufacture[0]['Status']; ?></option>
															<option value="Swasta" <?php if ($manufacture[0]['Status']=='Swasta'){echo 'hidden';}?>>Swasta</option>
															<option value="Pemda DKI" <?php if ($manufacture[0]['Status']=='Pemda DKI'){echo 'hidden';}?>>Pemda DKI</option>
															<option value="Pemerintah Non-DKI" <?php if ($manufacture[0]['Status']=='Pemerintah Non-DKI'){echo 'hidden';}?>>Pemerintah Non-DKI</option> </select>
												</select>
												<p class="help-block">Status Kepemilikan </p>
											</div>
											<div class="col-sm-6 col-xs-12" id="" style="">
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
											<div class="col-sm-4 col-xs-12" id="" style="">
												<input type="number" class="form-control" name="JmlMasaBang" id="" placeholder="" value= "<?php echo $manufacture[0]['JmlMasaBang']; ?>" readonly>
												<p class="help-block">Jml Tower </p>
											</div>
											<div class="col-sm-4 col-xs-12" id="" style="">
												<input type="number" class="form-control" name="Lantai" id="" placeholder="" value= "<?php echo $manufacture[0]['Lantai']; ?>" readonly>
												<p class="help-block">Jml Lantai </p>
											</div>
											<div class="col-sm-4 col-xs-12" id="" style="">
												<input type="number" class="form-control" name="Basement" id="" placeholder="" value= "<?php echo $manufacture[0]['Basement']; ?>" readonly>
												<p class="help-block">Jml Bismen</p>
											</div>
										</div>
									</div>
								</div>
								
								<div class="col-sm-12">
									<div class="form-group" style="">
										<label class="control-label" for="Status">Administrasi Gedung</label>
										<div class="row">
											<div class="col-sm-6">                     
												<input type="text" class="form-control" name="NoImb" id="" value= "<?php echo $manufacture[0]['NoImb']; ?>" readonly>
												<p class="help-block">No IMB</p>
											</div>
											<div class="col-sm-6">                     
												<input type="text" class="form-control" name="TglImb" id=""  value= "<?php echo sqlDate2html($manufacture[0]['TglImb']); ?>" readonly>
												<p class="help-block">Tgl IMB</p>
											</div>
											<div class="col-sm-6">                     
												<input type="text" class="form-control" name="NoRekomtekAkhir" id=""  value= "<?php echo $manufacture[0]['NoRekomtekAkhir']; ?>" readonly>
												<p class="help-block">No Rekomtek</p>
											</div>
											<div class="col-sm-6">                     
												<input type="text" class="form-control" name="TglRekomtekAkhir" id="" value= "<?php echo sqlDate2html($manufacture[0]['TglRekomtekAkhir']); ?>" readonly>
												<p class="help-block">Tgl Rekomtek</p>
											</div>
											<div class="col-sm-6">                     
												<input type="text" class="form-control" name="NoSlfAkhir" id="" value= "<?php echo $manufacture[0]['NoSlfAkhir']; ?>" readonly>
												<p class="help-block">No SLF</p>
											</div>
											<div class="col-sm-6">                     
												<input type="text" class="form-control" name="TglSlfAkhir" id=""  value= "<?php echo sqlDate2html($manufacture[0]['TglSlfAkhir']); ?>" readonly>
												<p class="help-block">Tgl SLF</p>
											</div>
											<div class="col-sm-6">                     
												<input type="text" class="form-control" name="NoSkkAkhir" id=""  value= "<?php echo $manufacture[0]['NoSkkAkhir']; ?>" readonly>
												<p class="help-block">No SKK</p>
											</div>
											<div class="col-sm-6">                     
												<input type="text" class="form-control" name="TglSkkAkhir" id="" value= "<?php echo sqlDate2html($manufacture[0]['TglSkkAkhir']); ?>" readonly>
												<p class="help-block">Tgl SKK</p>
											</div>
											<div class="col-sm-6">                     
												<input type="text" class="form-control" name="NoLhp" id="" value= "<?php echo $manufacture[0]['NoLhp']; ?>" readonly>
												<p class="help-block">No LHP</p>
											</div>
											<div class="col-sm-6">                     
												<input type="text" class="form-control" name="TglLhp" id=""  value= "<?php echo sqlDate2html($manufacture[0]['TglLhp']); ?>" readonly>
												<p class="help-block">Tgl LHP</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-primary">
						<div class="panel-heading" role="button" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							<h4 class="panel-title">
								Data Permohonan
							</h4>
						</div>
						<div>
							<div class="panel-body" >
								<div class="col-sm-12">
									<div class="form-group " style="">
										<label class="control-label" for="NamaPengelola">Pengelola</label>  
										<input type="text" class="form-control" name="NamaPengelola" value= "<?php echo $manufacture[0]['NamaPengelola']; ?>" readonly >
									</div>
								</div>
							</div>
						</div>
						<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							<div class="panel-body">
								<div class="col-sm-12">
									<div class="form-group " style="">
										<div class="row">
											<div class="col-sm-12 col-xs-12" style="">
												<textarea type="text" class="form-control" name="AlamatPengelola"  style="resize: none;" readonly><?php echo $manufacture[0]['AlamatPengelola']; ?></textarea>
												<p class="help-block">Alamat Pengelola </p>
											</div>
											<div class="col-sm-8 col-xs-12" style="">
												<input type="text" class="form-control" name="NoTelpPengelola" id="" value= "<?php echo $manufacture[0]['NoTelpPengelola']; ?>" readonly>
												<p class="help-block">No. Telp/ Hp </p>
											</div>
											<div class="col-sm-6 col-xs-12" style=" ">
												<input type="text" class="form-control" name="NoPermhn" value= "<?php echo $manufacture[0]['NoPermhn']; ?>" readonly>
												<p class="help-block">No. Permohonan </p>
											</div>
											<div class="col-sm-6 col-xs-12" style=" ">
												<input type="text" class="form-control" name="TglPermhn" id="Datepicker" value= "<?php echo sqlDate2html($manufacture[0]['TglPermhn']); ?>" readonly>
												<p class="help-block">Tgl Permohonan </p>
											</div>
											<div class="col-sm-6 col-xs-12" style=" ">
												<input type="text" class="form-control" name="TglSuratDiterima" id="Datepicker1" value= "<?php echo sqlDate2html($manufacture[0]['TglSuratDiterima']); ?>" readonly>
												<p class="help-block">Tgl Surat Diterima </p>
											</div>
											<div class="col-sm-8 col-xs-12" style=" ">
												<select class="form-control" name="TipePermhn" readonly>
															<option value="<?php echo $manufacture[0]['TipePermhn']; ?>"><?php echo $manufacture[0]['TipePermhn']; ?></option>
															<option value="Sewaktu-waktu" <?php if ($manufacture[0]['TipePermhn']=='Sewaktu-waktu'){echo 'hidden';}?>>Sewaktu-waktu</option>
															<option value="Rekomtek Sistem" <?php if ($manufacture[0]['TipePermhn']=='Rekomtek Sistem'){echo 'hidden';}?>>Rekomtek Sistem</option>
															<option value="Rekomtek SKK" <?php if ($manufacture[0]['TipePermhn']=='Rekomtek SKK'){echo 'hidden';}?>>Rekomtek SKK</option>
															<option value="SLF" <?php if ($manufacture[0]['TipePermhn']=='SLF'){echo 'hidden';}?>>SLF</option>
															<option value="SLFn" <?php if ($manufacture[0]['TipePermhn']=='SLFn'){echo 'hidden';}?>>SLFn</option>									
												</select>
												<p class="help-block">Jenis Permohonan </p>
											</div>
										</div>
									</div>
								
									<div class="form-group">
										<label class="control-label" for="checkboxes">Kelengkapan Dokumen</label>
										<div class="row">
											<div class="col-sm-12">
												<div class="checkbox">
													<label for="SuratPermohonan">
														<input type="checkbox" name="SuratPermohonan" id="SuratPermohonan" value="1" <?php if ($manufacture[0]['SuratPermohonan']=='1'){echo 'checked';}?> disabled>
														Surat Permohonan
													</label>
												</div>
												<div class="checkbox">
													<label for="DokTeknisGedung">
														<input type="checkbox" name="DokTeknisGedung" id="DokTeknisGedung" value="1" <?php if ($manufacture[0]['DokTeknisGedung']=='1'){echo 'checked';}?> disabled>
														Dokumen Teknis Gedung
													</label>
												</div>
												<div class="checkbox">
													<label for="DokInventarisApar">
														<input type="checkbox" name="DokInventarisApar" id="DokInventarisApar" value="1" <?php if ($manufacture[0]['DokInventarisApar']=='1'){echo 'checked';}?> disabled>
														Dokumen Inventaris APAR
													</label>
												</div>
												<div class="checkbox">
													<label for="DokMKKG">
														<input type="checkbox" name="DokMKKG" id="DokMKKG" value="1" <?php if ($manufacture[0]['DokMKKG']=='1'){echo 'checked';}?> disabled>
														Dokumen MKKG
													</label>
												</div>
												<div class="checkbox">
													<label for="FtcpGambarSchematic">
														<input type="checkbox" name="FtcpGambarSchematic" id="FtcpGambarSchematic" value="1" <?php if ($manufacture[0]['FtcpGambarSchematic']=='1'){echo 'checked';}?> disabled>
														Fc Gambar Schematik
													</label>
												</div>
												<div class="checkbox">
													<label for="FtcpSiteplan">
														<input type="checkbox" name="FtcpSiteplan" id="FtcpSiteplan" value="1" <?php if ($manufacture[0]['FtcpSiteplan']=='1'){echo 'checked';}?> disabled>
														Fc Siteplan
													</label>
												</div>
												<div class="checkbox">
													<label for="FtcpRkkSlf">
														<input type="checkbox" name="FtcpRkkSlf" id="FtcpRkkSlf" value="1" <?php if ($manufacture[0]['FtcpRkkSlf']=='1'){echo 'checked';}?> disabled>
														Fotokopi SLF
													</label>
												</div>
												<div class="checkbox">
													<label for="FtcpIMB">
														<input type="checkbox" name="FtcpIMB" id="FtcpIMB" value="1" <?php if ($manufacture[0]['FtcpIMB']=='1'){echo 'checked';}?> disabled>
														Fotokopi IMB
													</label>
												</div>
												<div class="checkbox">
													<label for="FtcpSkkAkhir">
														<input type="checkbox" name="FtcpSkkAkhir" id="FtcpSkkAkhir" value="1" <?php if ($manufacture[0]['FtcpSkkAkhir']=='1'){echo 'checked';}?> disabled>
														Fotokopi SKK
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="row">
				<form class="form-horizontal" >
					<div class="panel panel-primary" style="<?php if (! $this->agent->is_mobile()){echo 'position: fixed; width:57%';} ?> ">
						<div class="panel-heading" id="">
							<h4 class="panel-title">
									Data Disposisi
							</h4>
						</div>
						<div id="DataDisposisi" class="" >
							<div class="panel-body">
								<div class="col-sm-12">
									<div class="form-group" style="">
										<label class="col-sm-2 control-label" for="TglDisKadis" style="">Tanggal Disposisi </label>  
										<div class="col-sm-3 col-xs-12" style=" ">
											<input type="text" class="form-control" name="TglDisKadis" id="Datepicker2" value= "">
											<p class="help-block">Kadis</p>
										</div>
										<div class="col-sm-3 col-xs-12" style=" ">
											<input type="text" class="form-control" name="TglDisKabid" id="Datepicker3" value= "">
											<p class="help-block">Kabid</p>
										</div>
										<div class="col-sm-3 col-xs-12" style="">
											<input type="text" class="form-control" name="TglDisKasi" id="Datepicker4" value= "">
											<p class="help-block">Kasie</p>
										</div>
									</div>
								</div>
								
								<div class="col-sm-12">
									<div class="form-group " >
										<label class="col-sm-2 control-label" for="TglPerbalST">Tgl Perbal Surat Tugas</label>  
										<div class="col-sm-4 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:25%';} ?>">
											<input type="text" class="form-control" name="TglPerbalST" id="Datepicker5" value= "">
										</div>
									</div>
								</div>
								
								<div class="col-sm-12">
									<div class="form-group " >
										<label class="col-sm-2 control-label" for="Pokja">Pokja <a style="color:red">*</a></label>  
										<div class="col-sm-4 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:20%';} ?>">
											<select class="form-control" name="Pokja" onchange="selectKaInsp(this.options[this.selectedIndex].value)" required>
												<option value= "">Pilih Salah Satu</option>
												<option value="pokja 1">Pokja I</option>
												<option value="pokja 2">Pokja II</option>
												<option value="pokja 3">Pokja III</option>
												<option value="pokja 4">Pokja IV</option>
												<option value="pokja 5">Pokja V</option>
											</select>
										</div>
										<div class="col-sm-4 col-xs-12" style=" <?php if (! $this->agent->is_mobile()){echo 'width:35%';} ?>">
											<input type="text" class="form-control" name="KaInsp" id="KaInsp" placeholder="automatic" value= "" readonly>
										</div>
									</div>
								</div>
							</div>
							
							<!--tidak ditampilkan-->
							<input type="text" id="" name="StatusPermhn" value="3" style="display: none;">
							<input type="text" id="" name="No_id" value="<?php echo $manufacture[0]['permhn_id']; ?>" style="display: none;" >
			
							<div class="col-sm-12 col-xs-12" id="" >
								<div class="form-actions" id="" style="text-align: center;">
									<button class="btn btn-primary" type="submit">Simpan</button>
									<button class="btn" type="reset">Cancel</button>
								</div>  <br>  
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
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