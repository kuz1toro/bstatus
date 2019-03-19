<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header" style="padding-top: 2px;">
		<div class="row hidden-xs" style="text-align: right; margin-top: 5px; padding-right: 15px;">
			<div class="ui steps ordered" style="text-align: left;">
				<div class="completed step" style="padding: 0px 50px 0px 13px;">
					<div class="" style="">
						<div class="title" style="">Pilih permohonan</div>
						<div class="description" style="">Pilih data permohonan yang akan di disposisi</div>
					</div>
				</div>
				<div class="active step" style="padding: 0px 50px 0px 13px;">
					<div class="">
						<div class="title">Lengkapi</div>
						<div class="description">Lengkapi data disposisi</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Main content -->
	<section class="content" style="padding-top: 5px;">
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
		echo form_open('disposisi/Add_disposisi_step3', $attributes);
		?>

		<div class="row">
			<!-- /.colom data gedung -->
			<div class="col-md-3 hidden-xs my-col">
				<div class="box box-default">
					<!-- /.box-header -->
					<div class="box-header with-border">
						<h3 class="box-title">Data Gedung</h3>
					</div>
					<!-- /.box-body -->
					<div class="box-body">
						<div class="form-group" style="">
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NamaGedung" id=""  value= "<?php if(!empty($permhn_n_gedung)){echo $permhn_n_gedung[0]['NamaGedung'];} ?>" disabled>
								<p class="help-block">Nama Gedung</p>
							</div>
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NoImb" id="" value= "<?php if(!empty($permhn_n_gedung)){echo $permhn_n_gedung[0]['NoImb'];} ?>" disabled>
								<p class="help-block">No IMB</p>
							</div>
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="TglImb" id=""  value= "<?php if(!empty($permhn_n_gedung)){echo sqlDate2html($permhn_n_gedung[0]['TglImb']);} ?>" disabled>
								<p class="help-block">Tgl IMB</p>
							</div>
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NoSkkAkhir" id=""  value= "<?php if(!empty($permhn_n_gedung)){echo $permhn_n_gedung[0]['NoSkkAkhir'];} ?>" disabled>
								<p class="help-block">No SKK Terakhir</p>
							</div>
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="TglSkkAkhir" id="" value= "<?php if(!empty($permhn_n_gedung)){echo sqlDate2html($permhn_n_gedung[0]['TglSkkAkhir']);} ?>" disabled>
								<p class="help-block">Tgl SKK Terakhir</p>
							</div>
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NoSlfAkhir" id="" value= "<?php if(!empty($permhn_n_gedung)){echo $permhn_n_gedung[0]['NoSlfAkhir'];} ?>" disabled>
								<p class="help-block">No SLF Terakhir</p>
							</div>
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="TglSlfAkhir" id=""  value= "<?php if(!empty($permhn_n_gedung)){echo sqlDate2html($permhn_n_gedung[0]['TglSlfAkhir']);} ?>" disabled>
								<p class="help-block">Tgl SLF Terakhir</p>
							</div>
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NoRekomtekAkhir" id=""  value= "<?php if(!empty($permhn_n_gedung)){echo $permhn_n_gedung[0]['NoRekomtekAkhir'];} ?>" disabled>
								<p class="help-block">No Rekomtek Terakhir</p>
							</div>
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="TglRekomtekAkhir" id="" value= "<?php if(!empty($permhn_n_gedung)){echo sqlDate2html($permhn_n_gedung[0]['TglRekomtekAkhir']);} ?>" disabled>
								<p class="help-block">Tgl Rekomtek Terakhir</p>
							</div>
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="NoLhp" id="" value= "<?php if(!empty($permhn_n_gedung)){echo $permhn_n_gedung[0]['NoLhp'];} ?>" disabled>
								<p class="help-block">No LHP Terakhir</p>
							</div>
							<div class="col-sm-10 col-sm-offset-1" style="padding-bottom:10px;">
								<input type="text" class="form-control" name="TglLhp" id=""  value= "<?php if(!empty($permhn_n_gedung)){echo sqlDate2html($permhn_n_gedung[0]['TglLhp']);} ?>" disabled>
								<p class="help-block">Tgl LHP Terakhir</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.colom data permohonan -->
			<div class="col-md-4 my-col" >
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="box-header with-border">
						<h3 class="box-title">Data Permohonan</h3>
					</div>
					<!-- /.box-body -->
					<div class="box-body">
						<div class="col-sm-12 kotak">
							<div class="form-group " style="">
								<label class="col-sm-12 control-label" for="NamaPengelola">Data Pengelola</label>
								<div class="col-sm-12 col-xs-12" style="">
									<input type="text" class="form-control" name="NamaPengelola" value= "<?php echo $permhn_n_gedung[0]['NamaPengelola']; ?>" required>
									<p class="help-block">Nama Pengelola <a style="color:red">*</a></p>
								</div>
								<div class="col-sm-4 col-xs-12" style="">
									<input type="text" class="form-control" name="NoTelpPengelola" id="" value= "<?php echo $permhn_n_gedung[0]['NoTelpPengelola']; ?>">
									<p class="help-block">No. Telp/ Hp </p>
								</div>
								<div class="col-sm-8 col-xs-12" style="">
									<textarea type="text" class="form-control" name="AlamatPengelola"  style="resize: none;" ><?php echo $permhn_n_gedung[0]['AlamatPengelola']; ?></textarea>
									<p class="help-block">Alamat Pengelola </p>
								</div>
							</div>
						</div>

						<div class="col-sm-12 kotak">
							<div class="form-group ">
								<label class="col-sm-12 control-label" for="NoPermhn">Permohonan</label>
								<div class="col-sm-6 col-xs-12" style=" ">
									<input type="text" class="form-control" name="NoPermhn" value= "<?php echo $permhn_n_gedung[0]['NoPermhn']; ?>" >
									<p class="help-block">No. Permohonan </p>
								</div>
								<div class="col-sm-6 col-xs-12" style=" ">
									<input type="text" class="form-control" name="TglPermhn" id="Datepicker" value= "<?php echo sqlDate2html($permhn_n_gedung[0]['TglPermhn']); ?>">
									<p class="help-block">Tgl Permohonan </p>
								</div>
								<div class="col-sm-6 col-xs-12" style=" ">
									<input type="text" class="form-control" name="TglSuratDiterima" id="Datepicker1" value= "<?php echo sqlDate2html($permhn_n_gedung[0]['TglSuratDiterima']); ?>">
									<p class="help-block">Tgl Surat Diterima </p>
								</div>
							</div>
						</div>

						<div class="col-sm-12 kotak">
							<div class="form-group " style="">
								<label class="col-sm-12 control-label" for="TipePermhn">Jenis Permohonan</label>
								<div class="col-sm-12 col-xs-12" style=" ">
									<select class="form-control" name="TipePermhn" >
										<option value="<?php echo $permhn_n_gedung[0]['TipePermhn']; ?>"><?php echo $permhn_n_gedung[0]['TipePermhn']; ?></option>
										<option value="Sewaktu-waktu" <?php if ($permhn_n_gedung[0]['TipePermhn']=='Sewaktu-waktu'){echo 'hidden';}?>>Sewaktu-waktu</option>
										<option value="Rekomtek Sistem" <?php if ($permhn_n_gedung[0]['TipePermhn']=='Rekomtek Sistem'){echo 'hidden';}?>>Rekomtek Sistem</option>
										<option value="Rekomtek SKK" <?php if ($permhn_n_gedung[0]['TipePermhn']=='Rekomtek SKK'){echo 'hidden';}?>>Rekomtek SKK</option>
										<option value="SLF" <?php if ($permhn_n_gedung[0]['TipePermhn']=='SLF'){echo 'hidden';}?>>SLF</option>
										<option value="SLFn" <?php if ($permhn_n_gedung[0]['TipePermhn']=='SLFn'){echo 'hidden';}?>>SLFn</option>
									</select>
								</div>
							</div>
						</div>

						<div class="col-sm-12 kotak">
							<div class="form-group" style="">
								<label class="col-sm-12 control-label" for="checkboxes">Kelengkapan Dokumen</label>
								<div class="col-sm-6">
									<div class="checkbox">
										<label for="SuratPermohonan">
											<input type="checkbox" class="minimal" name="SuratPermohonan" id="SuratPermohonan" value="1" <?php if ($permhn_n_gedung[0]['SuratPermohonan']=='1'){echo 'checked';}?> >
											Surat Permohonan
										</label>
									</div>
									<div class="checkbox">
										<label for="DokTeknisGedung">
											<input type="checkbox" class="minimal" name="DokTeknisGedung" id="DokTeknisGedung" value="1" <?php if ($permhn_n_gedung[0]['DokTeknisGedung']=='1'){echo 'checked';}?> >
											Dokumen Teknis Gedung
										</label>
									</div>
									<div class="checkbox">
										<label for="DokInventarisApar">
											<input type="checkbox" class="minimal" name="DokInventarisApar" id="DokInventarisApar" value="1" <?php if ($permhn_n_gedung[0]['DokInventarisApar']=='1'){echo 'checked';}?> >
											Dokumen Inventaris APAR
										</label>
									</div>
									<div class="checkbox">
										<label for="DokMKKG">
											<input type="checkbox" class="minimal" name="DokMKKG" id="DokMKKG" value="1" <?php if ($permhn_n_gedung[0]['DokMKKG']=='1'){echo 'checked';}?> >
											Dokumen MKKG
										</label>
									</div>
									<div class="checkbox">
										<label for="FtcpGambarSchematic">
											<input type="checkbox" class="minimal" name="FtcpGambarSchematic" id="FtcpGambarSchematic" value="1" <?php if ($permhn_n_gedung[0]['FtcpGambarSchematic']=='1'){echo 'checked';}?> >
											Fc Gambar Schematik
										</label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="checkbox">
										<label for="FtcpSiteplan">
											<input type="checkbox" class="minimal" name="FtcpSiteplan" id="FtcpSiteplan" value="1" <?php if ($permhn_n_gedung[0]['FtcpSiteplan']=='1'){echo 'checked';}?> >
											Fc Siteplan
										</label>
									</div>
									<div class="checkbox">
										<label for="FtcpRkkSlf">
											<input type="checkbox" class="minimal" name="FtcpRkkSlf" id="FtcpRkkSlf" value="1" <?php if ($permhn_n_gedung[0]['FtcpRkkSlf']=='1'){echo 'checked';}?> >
											Fotokopi SLF
										</label>
									</div>
									<div class="checkbox">
										<label for="FtcpIMB">
											<input type="checkbox" class="minimal" name="FtcpIMB" id="FtcpIMB" value="1" <?php if ($permhn_n_gedung[0]['FtcpIMB']=='1'){echo 'checked';}?> >
											Fotokopi IMB
										</label>
									</div>
									<div class="checkbox">
										<label for="FtcpSkkAkhir">
											<input type="checkbox" class="minimal" name="FtcpSkkAkhir" id="FtcpSkkAkhir" value="1" <?php if ($permhn_n_gedung[0]['FtcpSkkAkhir']=='1'){echo 'checked';}?> >
											Fotokopi SKK
										</label>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-12 kotak">
							<div class="form-group" style="">
								<label class="col-sm-12 control-label" for="KetPrainspeksi">Keterangan/ Catatan Prainspeksi</label>
								<div class="col-sm-12 col-xs-12" style="">
									<textarea type="text" class="form-control" name="KetPrainspeksi"  style="resize: none;" readonly><?php echo $permhn_n_gedung[0]['KetPrainspeksi']; ?></textarea>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

			<!-- /.colom data disposisi -->
			<div class="col-md-5 my-col">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="box-header with-border">
						<h3 class="box-title">Data Disposisi</h3>
					</div>
					<!-- /.box-body -->
					<div class="box-body">
						<div class="col-sm-12 kotak">
							<div class="form-group" style="">
								<label class="col-sm-12 control-label" for="TglDisKadis" style="">Tanggal Disposisi </label>
								<div class="col-sm-4 col-xs-12">
									<input type="text" class="form-control" name="TglDisKadis" id="Datepicker2" value= "<?php echo sqlDate2html($permhn_n_gedung[0]['TglDisKadis']); ?>">
									<p class="help-block">Kadis</p>
								</div>
								<div class="col-sm-4 col-xs-12" >
									<input type="text" class="form-control" name="TglDisKabid" id="Datepicker3" value= "<?php echo sqlDate2html($permhn_n_gedung[0]['TglDisKabid']); ?>">
									<p class="help-block">Kabid</p>
								</div>
								<div class="col-sm-4 col-xs-12">
									<input type="text" class="form-control" name="TglDisKasi" id="Datepicker4" value= "<?php echo sqlDate2html($permhn_n_gedung[0]['TglDisKasi']); ?>">
									<p class="help-block">Kasie</p>
								</div>
							</div>
						</div>

						<div class="col-sm-12 kotak">
							<div class="form-group " >
								<label class="col-sm-4 control-label" for="TglPerbalST">Tanggal Perbal Surat Tugas</label>
								<div class="col-sm-6 col-xs-12" style="margin-top:10px">
									<input type="text" class="form-control" name="TglPerbalST" id="Datepicker5" value= "<?php echo sqlDate2html($permhn_n_gedung[0]['TglPerbalST']); ?>">
								</div>
							</div>
						</div>

						<div class="col-sm-12 kotak">
							<div class="form-group " >
								<label class="col-sm-12 control-label" style="text-align: left; margin-bottom: 10px;" for="Pokja">Disposisi ke</label>
								<div class="checkbox">
									<ul>
										<input type="radio" id="pil_prains" name="demo-radio" class="minimal">
										<label for="pil_prains">Prainspeksi</label>
									</ul>
									<ul>
										<input type="radio" id="pil_pokja" name="demo-radio" class="minimal" checked>
										<label for="pil_pokja">Pokja</label>
									</ul>
								</div>
								<div id="Pokja_box">
									<div class="col-sm-6 col-xs-12">
										<select class="form-control" name="Pokja" id="Pokja" onchange="selectKaInsp(this.options[this.selectedIndex].value)" required >
											<option value= "<?php echo $permhn_n_gedung[0]['Pokja']; ?>"><?php echo $permhn_n_gedung[0]['Pokja']; ?></option>
											<option value="pokja 1">Pokja I</option>
											<option value="pokja 2">Pokja II</option>
											<option value="pokja 3">Pokja III</option>
											<option value="pokja 4">Pokja IV</option>
											<option value="pokja 5">Pokja V</option>
										</select>
										<p class="help-block">Pokja<a style="color:red">*</a></p>
									</div>
									<div class="col-sm-6 col-xs-12" >
										<input type="text" class="form-control" name="KaInsp" id="KaInsp" placeholder="automatic" value= "<?php echo $permhn_n_gedung[0]['KaInsp']; ?>" readonly>
										<p class="help-block">Ka. Inspeksi</p>
									</div>
								</div>
								<div class="col-sm-12">
									<div class="form-group" style="">
										<label class="col-sm-12 control-label" for="KetDisposisi">Keterangan/ Catatan Kasie</label>
										<div class="col-sm-12 col-xs-12" style="">
											<textarea type="text" class="form-control" name="KetDisposisi"  style="resize: none;" placeholder="Catatan atau instruksi untuk prainspeksi dan pokja"><?php echo $permhn_n_gedung[0]['KetDisposisi']; ?></textarea>
										</div>
									</div>
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
								<button class="btn btn-default tbl-back" val="<?php echo $next_page; ?>" type="button">Kembali</button>
								<button class="btn btn-default tbl-batal" val="<?php echo ''.base_url().'disposisi/home'; ?>" type="button">Batal</button>
							</div>
						</div> <br>
					</div>
				</div>
			</div>
			<!--tidak ditampilkan-->
			<input type="text" id="StatusPermhn" name="StatusPermhn" style="display: none;">
			<input type="text" id="" name="No_id" value="<?php echo $permhn_n_gedung[0]['permhn_id']; ?>" style="display: none;" >

			<?php echo form_close(); ?>
		</div>
	</section>
</div>
