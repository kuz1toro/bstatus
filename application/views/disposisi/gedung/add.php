<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Main content -->
<section class="content">

	<?php
		//back page
		$add_session_data = array('search_string_selected' => NULL,
			'search_in_field' => 'NamaGedung',
			'order' => 'id',
			'order_type' => 'Asc' );
		$this->session->set_userdata($add_session_data);
	?>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-solid box-success">
				<!-- /.box-header -->
				<div class="box-header with-border">
				</div>
				<!-- /.box-main -->
				<div class="box-body box1">
					<?php
					//form data
					$attributes = array('class' => 'form-horizontal', 'id' => 'myForm');
					echo form_open('disposisi/add_gedung', $attributes);
					?>
					<!-- Form  -->
					<div class="col-sm-12">
						<div class="form-group" style="">
							<label class="col-sm-4 col-xs-12 control-label" for="NamaGedung" style="">Nama Gedung <a style="color:red">*</a></label>
							<div class="col-sm-7 col-xs-12" style="">
								<textarea type="text" class="form-control" name="NamaGedung" style="resize: none;" required ></textarea>
							</div>
						</div>
					</div>
					<div class="col-sm-12 grey">
						<div class="form-group">
							<label class="col-sm-4 col-xs-12 control-label" for="Alamat">Alamat</label>
							<div class="col-sm-7 col-xs-12" style="">
								<textarea type="text" class="form-control" name="Alamat"  style="resize: none;" required ></textarea>
								<p class="help-block">Nama Jalan <a style="color:red">*</a></p>
							</div>
							<label class="col-sm-4 col-xs-12 control-label" for=""></label>
							<div class="col-sm-2 col-xs-5" id="" style="">
								<select class="form-control" name="Wilayah" value="" id="Wilayah" onchange="selectKec(this.options[this.selectedIndex].value)" >
									<option value="">Pilih Wilayah</option>
									<option value="Pusat">Pusat</option>
									<option value="Utara">Utara</option>
									<option value="Barat">Barat</option>
									<option value="Selatan">Selatan</option>
									<option value="Timur">Timur</option>
									<option value="P1000">P1000</option>
								</select>
								<p class="help-block">Wilayah</p>
							</div>
							<div class="col-sm-5 col-xs-7" id="" style="">
								<select class="form-control" id="kecamatan_dropdown" name="Kecamatan" onchange="selectKel(this.options[this.selectedIndex].value)">
								</select>
								<p class="help-block">Kecamatan</p>
							</div>
							<label class="col-sm-4 col-xs-12 control-label" for=""></label>
							<div class="col-sm-5 col-xs-8" id="" style="">
								<select class="form-control" id="kelurahan_dropdown" name="Kelurahan" onchange="showKodepos(this.options[this.selectedIndex].value)">
								</select>
								<p class="help-block">Kelurahan</p>
							</div>
							<div class="col-sm-2 col-xs-4" id="" style="">
								<input type="text" class="form-control" name="KodePos" id="kodepos_dropdown" value= "">
								<p class="help-block">Kode Pos</p>
							</div>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group" style="">
							<label class="col-sm-4 col-xs-12 control-label" for="Status">Data Gedung</label>
							<div class="col-sm-3 col-xs-7" id="" style="">
								<select class="form-control" name="Status" required >
									<option value="" >Pilih Kepemilikan</option>
									<option value="Swasta" >Swasta</option>
									<option value="Pemda DKI" >Pemda DKI</option>
									<option value="Pemerintah Non-DKI" >Pemerintah Non-DKI</option> </select>
								</select>
								<p class="help-block">Status Kepemilikan <a style="color:red">*</a></p>
							</div>
							<div class="col-sm-3 col-xs-5" id="" style="">
								<select class="form-control" name="Fungsi" required >
									<option value="">Pilih Fungsi Gedung</option>
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
								<p class="help-block">Fungsi <a style="color:red">*</a></p>
							</div>
							<label class="col-sm-4 col-xs-12 control-label" for=""></label>
							<div class="col-sm-2 col-xs-4" style="">
								<input type="number" class="form-control" name="JmlMasaBang" id="" placeholder="" value= "" required >
								<p class="help-block">Jml Tower <a style="color:red">*</a></p>
							</div>
							<div class="col-sm-2 col-xs-4" style="">
								<input type="number" class="form-control" name="Lantai" id="" placeholder="" value= "" required >
								<p class="help-block">Jml Lantai <a style="color:red">*</a></p>
							</div>
							<div class="col-sm-2 col-xs-4" style="">
								<input type="number" class="form-control" name="Basement" id="" placeholder="" value= "" required >
								<p class="help-block">Jml Bismen <a style="color:red">*</a></p>
							</div>
						</div>
					</div>

					<div class="col-sm-12 grey">
						<div class="form-group">
							<label class="col-sm-4 col-xs-12 control-label" for="NoImb">IMB</label>
							<div class="col-sm-4 col-xs-12">
								<input type="text" class="form-control" name="NoImb" id="" value= "">
								<p class="help-block">No IMB</p>
							</div>
							<div class="col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="TglImb" id="Datepicker"  value= "">
								<p class="help-block">Tgl IMB</p>
							</div>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-4 col-xs-12 control-label" for="NoRekomtekAkhir">Rekomtek Terakhir</label>
							<div class="col-sm-4 col-xs-12">
								<input type="text" class="form-control" name="NoRekomtekAkhir" id=""  value= "">
								<p class="help-block">No Rekomtek</p>
							</div>
							<div class="col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="TglRekomtekAkhir" id="Datepicker1" value= "">
								<p class="help-block">Tgl Rekomtek</p>
							</div>
						</div>
					</div>

					<div class="col-sm-12 grey">
						<div class="form-group">
							<label class="col-sm-4 col-xs-12 control-label" for="NoSlfAkhir">SLF Terakhir</label>
							<div class="col-sm-4 col-xs-12">
								<input type="text" class="form-control" name="NoSlfAkhir" id="" value= "">
								<p class="help-block">No SLF</p>
							</div>
							<div class="col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="TglSlfAkhir" id="Datepicker2"  value= "">
								<p class="help-block">Tgl SLF</p>
							</div>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-4 col-xs-12 control-label" for="NoSkkAkhir">SKK Terakhir</label>
							<div class="col-sm-4 col-xs-12">
								<input type="text" class="form-control" name="NoSkkAkhir" id=""  value= "">
								<p class="help-block">No SKK</p>
							</div>
							<div class="col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="TglSkkAkhir" id="Datepicker3" value= "">
								<p class="help-block">Tgl SKK</p>
							</div>
						</div>
					</div>

					<div class="col-sm-12 grey">
						<div class="form-group">
							<label class="col-sm-4 col-xs-12 control-label" for="NoLhp">LHP Terakhir</label>
							<div class="col-sm-4 col-xs-12">
								<input type="text" class="form-control" name="NoLhp" id="" value= "">
								<p class="help-block">No LHP</p>
							</div>
							<div class="col-sm-3 col-xs-12">
								<input type="text" class="form-control" name="TglLhp" id="Datepicker4"  value= "">
								<p class="help-block">Tgl LHP</p>
							</div>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label class="col-sm-4 col-xs-12 control-label" for="Keterangan">Keterangan/ Catatan</label>
							<div class="col-sm-6 col-xs-12" style="">
								<textarea class="form-control" id="Keterangan" name="Keterangan" style="resize: none;"></textarea>
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
							<button class="btn btn-default tbl-batal" val="<?php echo ''.base_url().'disposisi/home'; ?>" type="button">Batal</button>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

</section>
</div>
