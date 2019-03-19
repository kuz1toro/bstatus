<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<?php /**
	<section class="content-header">
		<h1>
			Edit Permohonan
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a><?php echo ucfirst($this->ion_auth->user()->row()->username); ?></a></li>
			<li><a>Permohonan</a></li>
			<li class="active">
				<?php echo ucfirst($this->uri->segment(2));?>
			</li>
		</ol>
	</section> */ ?>

	<!-- Main content -->
	<section class="content">
		<?php
		//Modal alert
		pesanModal();
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
		//form data
		$attributes = array('class' => 'form-horizontal', 'id' => 'myForm');
		echo form_open('prainspeksi_permohonan/update/'.$this->uri->segment(3).'', $attributes);
		?>

		<div class="row">
			<!-- /.colom data gedung -->
			<div class="col-md-4 hidden-xs hidden-sm">
				<div class="box box-solid box-default">
					<!-- /.box-header -->
					<div class="box-header with-border">
						<h3 class="box-title">Data Gedung</h3>
					</div>
					<!-- /.box-body -->
					<div class="box-body">
						<div class="form-group" style="">
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NamaGedung" id=""  value= "<?php if(!empty($gedungs)){echo $gedungs[0]['NamaGedung'];} ?>" disabled>
								<p class="help-block">Nama Gedung</p>
							</div>
							<div class="col-sm-3 col-sm-offset-1" style="">
								<input type="number" class="form-control" name="JmlMasaBang" id="" placeholder="" value= "<?php if(!empty($gedungs)){echo $gedungs[0]['JmlMasaBang'];} ?>" >
								<p class="help-block">Jml Tower</p>
							</div>
							<div class="col-sm-3" style="">
								<input type="number" class="form-control" name="Basement" id="" placeholder="" value= "<?php if(!empty($gedungs)){echo $gedungs[0]['Basement'];} ?>" >
								<p class="help-block">Jml Bismen</p>
							</div>
							<div class="col-sm-3" style="">
								<input type="number" class="form-control" name="Lantai" id="" placeholder="" value= "<?php if(!empty($gedungs)){echo $gedungs[0]['Lantai'];} ?>" >
								<p class="help-block">Jml Lantai </p>
							</div>
							<div class="col-sm-6 col-sm-offset-1" style="padding-bottom:10px;">
								<div class="input-group">
									<input type="number" class="form-control" name="LuasLantai" id="" placeholder="" value= "<?php if(!empty($gedungs)){echo $gedungs[0]['LuasLantai'];} ?>" >
									<span class="input-group-addon default">m<sup>2</sup></span>
								</div>
								<p class="help-block">Luas Lantai</p>
							</div>
							<div class="col-sm-5 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NoImb" id="" value= "<?php if(!empty($gedungs)){echo $gedungs[0]['NoImb'];} ?>" >
								<p class="help-block">No IMB</p>
							</div>
							<div class="col-sm-5" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="TglImb" id="Datepicker6"  value= "<?php if(!empty($gedungs)){echo sqlDate2html($gedungs[0]['TglImb']);} ?>" >
								<p class="help-block">Tgl IMB</p>
							</div>
							<div class="col-sm-5 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NoSkkAkhir" id=""  value= "<?php if(!empty($gedungs)){echo $gedungs[0]['NoSkkAkhir'];} ?>" >
								<p class="help-block">No SKK Terakhir</p>
							</div>
							<div class="col-sm-5" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="TglSkkAkhir" id="Datepicker2" value= "<?php if(!empty($gedungs)){echo sqlDate2html($gedungs[0]['TglSkkAkhir']);} ?>" >
								<p class="help-block">Tgl SKK Terakhir</p>
							</div>
							<div class="col-sm-5 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NoSlfAkhir" id="" value= "<?php if(!empty($gedungs)){echo $gedungs[0]['NoSlfAkhir'];} ?>" >
								<p class="help-block">No SLF Terakhir</p>
							</div>
							<div class="col-sm-5" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="TglSlfAkhir" id="Datepicker3"  value= "<?php if(!empty($gedungs)){echo sqlDate2html($gedungs[0]['TglSlfAkhir']);} ?>" >
								<p class="help-block">Tgl SLF Terakhir</p>
							</div>
							<div class="col-sm-5 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NoRekomtekAkhir" id=""  value= "<?php if(!empty($gedungs)){echo $gedungs[0]['NoRekomtekAkhir'];} ?>" >
								<p class="help-block">No Rekomtek Terakhir</p>
							</div>
							<div class="col-sm-5" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="TglRekomtekAkhir" id="Datepicker4" value= "<?php if(!empty($gedungs)){echo sqlDate2html($gedungs[0]['TglRekomtekAkhir']);} ?>" >
								<p class="help-block">Tgl Rekomtek Terakhir</p>
							</div>
							<div class="col-sm-5 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NoLhp" id="" value= "<?php if(!empty($gedungs)){echo $gedungs[0]['NoLhp'];} ?>" >
								<p class="help-block">No LHP Terakhir</p>
							</div>
							<div class="col-sm-5" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="TglLhp" id="Datepicker5"  value= "<?php if(!empty($gedungs)){echo sqlDate2html($gedungs[0]['TglLhp']);} ?>" >
								<p class="help-block">Tgl LHP Terakhir</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.colom data permohonan -->
			<div class="col-md-8">
				<div class="box box-solid box-success">
					<!-- /.box-header -->
					<div class="box-header with-border">
						<h3 class="box-title">Data Permohonan</h3>
					</div>
					<!-- /.box-body -->
					<div class="box-body box1">
						<div class="col-sm-12">
							<div class="form-group " style="">
								<label class="col-sm-4 control-label" for="NamaPengelola">Data Pengelola</label>
								<div class="col-sm-6 col-xs-12" style="">
									<input type="text" class="form-control" name="NamaPengelola" value= "<?php echo $permohonans[0]['NamaPengelola']; ?>" required >
									<p class="help-block">Nama Pengelola <a style="color:red">*</a></p>
								</div>
								<label class="col-sm-4 control-label" for=""></label>
								<div class="col-sm-3 col-xs-12" style="">
									<input type="text" class="form-control" name="NoTelpPengelola" id="" value= "<?php echo $permohonans[0]['NoTelpPengelola']; ?>">
									<p class="help-block">No. Telp/ Hp </p>
								</div>
								<div class="col-sm-4 col-xs-12" style="">
									<textarea type="text" class="form-control" name="AlamatPengelola"  style="resize: none;" ><?php echo $permohonans[0]['AlamatPengelola']; ?></textarea>
									<p class="help-block">Alamat Pengelola </p>
								</div>
							</div>
						</div>

						<div class="col-sm-12 grey">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="NoPermhn">Permohonan</label>
								<div class="col-sm-3 col-xs-12" style=" ">
									<input type="text" class="form-control" name="NoPermhn" value= "<?php echo $permohonans[0]['NoPermhn']; ?>" >
									<p class="help-block">No. Permohonan </p>
								</div>
								<div class="col-sm-3 col-xs-12" style=" ">
									<input type="text" class="form-control" name="TglPermhn" id="Datepicker" value= "<?php echo sqlDate2html($permohonans[0]['TglPermhn']); ?>">
									<p class="help-block">Tgl Permohonan </p>
								</div>
								<label class="col-sm-4 control-label" for=""></label>
								<div class="col-sm-3 col-xs-12" style=" ">
									<input type="text" class="form-control" name="TglSuratDiterima" id="Datepicker1" value= "<?php echo sqlDate2html($permohonans[0]['TglSuratDiterima']); ?>" required>
									<p class="help-block">Tgl Surat Diterima <a style="color:red">*</a></p>
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group " style="">
								<label class="col-sm-4 control-label" for="TipePermhn">Jenis Permohonan</label>
								<div class="col-sm-4 col-xs-12" style=" ">
									<select class="form-control" name="TipePermhn" >
										<option value="<?php echo $permohonans[0]['TipePermhn']; ?>"><?php echo $permohonans[0]['TipePermhn']; ?></option>
										<option value="Sewaktu-waktu" <?php if ($permohonans[0]['TipePermhn']=='Sewaktu-waktu'){echo 'hidden';}?>>Sewaktu-waktu</option>
										<option value="Rekomtek Sistem" <?php if ($permohonans[0]['TipePermhn']=='Rekomtek Sistem'){echo 'hidden';}?>>Rekomtek Sistem</option>
										<option value="Rekomtek SKK" <?php if ($permohonans[0]['TipePermhn']=='Rekomtek SKK'){echo 'hidden';}?>>Rekomtek SKK</option>
										<option value="SLF" <?php if ($permohonans[0]['TipePermhn']=='SLF'){echo 'hidden';}?>>SLF</option>
										<option value="SLFn" <?php if ($permohonans[0]['TipePermhn']=='SLFn'){echo 'hidden';}?>>SLFn</option>
									</select>
								</div>
							</div>
						</div>

						<div class="col-sm-12 grey">
							<div class="form-group">
								<label class="col-sm-4 control-label" for="checkboxes">Kelengkapan Dokumen</label>
								<div class="col-sm-4">
									<div class="checkbox">
										<label for="SuratPermohonan">
											<input type="checkbox" class="minimal" name="SuratPermohonan" id="SuratPermohonan" value="1" <?php if ($permohonans[0]['SuratPermohonan']=='1'){echo 'checked';}?> >
											Surat Permohonan
										</label>
									</div>
									<div class="checkbox">
										<label for="DokTeknisGedung">
											<input type="checkbox" class="minimal" name="DokTeknisGedung" id="DokTeknisGedung" value="1" <?php if ($permohonans[0]['DokTeknisGedung']=='1'){echo 'checked';}?> >
											Dokumen Teknis Gedung
										</label>
									</div>
									<div class="checkbox">
										<label for="DokInventarisApar">
											<input type="checkbox" class="minimal" name="DokInventarisApar" id="DokInventarisApar" value="1" <?php if ($permohonans[0]['DokInventarisApar']=='1'){echo 'checked';}?> >
											Dokumen Inventaris APAR
										</label>
									</div>
									<div class="checkbox">
										<label for="DokMKKG">
											<input type="checkbox" class="minimal" name="DokMKKG" id="DokMKKG" value="1" <?php if ($permohonans[0]['DokMKKG']=='1'){echo 'checked';}?> >
											Dokumen MKKG
										</label>
									</div>
									<div class="checkbox">
										<label for="FtcpGambarSchematic">
											<input type="checkbox" class="minimal" name="FtcpGambarSchematic" id="FtcpGambarSchematic" value="1" <?php if ($permohonans[0]['FtcpGambarSchematic']=='1'){echo 'checked';}?> >
											Fc Gambar Schematik
										</label>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="checkbox">
										<label for="FtcpSiteplan">
											<input type="checkbox" class="minimal" name="FtcpSiteplan" id="FtcpSiteplan" value="1" <?php if ($permohonans[0]['FtcpSiteplan']=='1'){echo 'checked';}?> >
											Fc Siteplan
										</label>
									</div>
									<div class="checkbox">
										<label for="FtcpRkkSlf">
											<input type="checkbox" class="minimal" name="FtcpRkkSlf" id="FtcpRkkSlf" value="1" <?php if ($permohonans[0]['FtcpRkkSlf']=='1'){echo 'checked';}?> >
											Fotokopi SLF
										</label>
									</div>
									<div class="checkbox">
										<label for="FtcpIMB">
											<input type="checkbox" class="minimal" name="FtcpIMB" id="FtcpIMB" value="1" <?php if ($permohonans[0]['FtcpIMB']=='1'){echo 'checked';}?> >
											Fotokopi IMB
										</label>
									</div>
									<div class="checkbox">
										<label for="FtcpSkkAkhir">
											<input type="checkbox" class="minimal" name="FtcpSkkAkhir" id="FtcpSkkAkhir" value="1" <?php if ($permohonans[0]['FtcpSkkAkhir']=='1'){echo 'checked';}?> >
											Fotokopi SKK
										</label>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group " style="">
								<label class="col-sm-4 control-label" for="KetPrainspeksi">Keterangan/ Catatan</label>
								<div class="col-sm-6 col-xs-12" style="">
									<textarea type="text" class="form-control" name="KetPrainspeksi"  style="resize: none;" ><?php echo $permohonans[0]['KetPrainspeksi']; ?></textarea>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-footer -->
					<div class="box-footer clearfix">
						<div class="form-actions" style="text-align: center;">
							<div class="btn-group pull-right" role="group" aria-label="...">
								<button class="btn btn-success tbl-simpan" type="button">Simpan</button>
								<button class="btn btn-default tbl-reset" type="button">Reset</button>
								<?php if (strlen($_SESSION['search_string_selected'])==0){
									$next_page = $_SESSION['hal_skr'];
								} else {
									$next_page = ''.$_SESSION['hal_skr'].'?search_string='.$_SESSION['search_string_selected'].'&search_in='.$_SESSION['search_in_field'].'&order='.$_SESSION['order'].'&order_type='.$_SESSION['order_type'].'';
								} ?>
								<button class="btn btn-default tbl-batal" val="<?php echo $next_page; ?>" type="button">Batal</button>
							</div>
						</div> <br>
					</div>
				</div>
			</div>
		</div>
		<!--tidak ditampilkan-->
		<input type="text" id="" name="NamaGedung_id" value="<?php echo $permohonans[0]['NamaGedung_id']; ?>" style="display: none;">

		<?php echo form_close(); ?>
	</section>
</div>
