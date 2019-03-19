    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("disposisi/home"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
        </li>
        <li>
          <a href="<?php echo site_url("disposisi").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
        </li>
        <li class="active">
          Update
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
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
      echo validation_errors();

      echo form_open('disposisi/permohonan/update/'.$this->uri->segment(4).'', $attributes);
      ?>
	  
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NamaPengelola" class="">Nama Pengelola:</label>
			<textarea type="text" class="form-control" name="NamaPengelola"  placeholder="Nama Pengelola" style="resize: none;" required><?php echo $manufacture[0]['NamaPengelola']; ?></textarea>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="KetPrainspeksi" class="">Keterangan/ Catatan:</label>
			<textarea type="text" class="form-control" name="KetPrainspeksi" id="textarea_form" placeholder="Keterangan/ Catatan" style="resize: none;"><?php echo $manufacture[0]['KetPrainspeksi']; ?></textarea>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NoTelpPengelola" class="">No Telp Pengelola:</label>
			<input type="text" class="form-control" name="NoTelpPengelola" id="" placeholder="No Telp Pengelola" value= "<?php echo $manufacture[0]['NoTelpPengelola']; ?>">
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NoPermhn" class="">No Permohonan:</label>
			<input type="text" class="form-control" name="NoPermhn" id="" placeholder="No Permohonan" value= "<?php echo $manufacture[0]['NoPermhn']; ?>" required>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="TglSuratDiterima" class="">Tanggal Surat Diterima:</label>
			<input type="text" class="form-control" name="TglSuratDiterima" id="Datepicker" placeholder="Tanggal Surat Diterima" value= "<?php echo sqlDate2html($manufacture[0]['TglSuratDiterima']); ?>">
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="TglPermhn" class="">Tanggal Permohonan:</label>
			<input type="text" class="form-control" name="TglPermhn" id="Datepicker1" placeholder="Tanggal Permohonan" value= "<?php echo sqlDate2html($manufacture[0]['TglPermhn']); ?>">
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="SuratPermohonan" class="">Surat Permohonan:</label>
			<select class="form-control" name="SuratPermohonan">
						<option value="<?php echo $manufacture[0]['SuratPermohonan']; ?>"><?php if ($manufacture[0]['SuratPermohonan']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['SuratPermohonan']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['SuratPermohonan']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="SuratPernyataan" class="">Surat Pernyataan:</label>
			<select class="form-control" name="SuratPernyataan" >
						<option value="<?php echo $manufacture[0]['SuratPernyataan']; ?>"><?php if ($manufacture[0]['SuratPernyataan']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['SuratPernyataan']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['SuratPernyataan']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpKTP" class="">Fotocopy KTP:</label>
			<select class="form-control" name="FtcpKTP" >
						<option value="<?php echo $manufacture[0]['FtcpKTP']; ?>"><?php if ($manufacture[0]['FtcpKTP']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpKTP']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpKTP']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpAktaPershn" class="">Fotocopy Akta Perusahaan:</label>
			<select class="form-control" name="FtcpAktaPershn" >
						<option value="<?php echo $manufacture[0]['FtcpAktaPershn']; ?>"><?php if ($manufacture[0]['FtcpAktaPershn']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpAktaPershn']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpAktaPershn']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpSiteplan" class="">Fotocopy Siteplan:</label>
			<select class="form-control" name="FtcpSiteplan" >
						<option value="<?php echo $manufacture[0]['FtcpSiteplan']; ?>"><?php if ($manufacture[0]['FtcpSiteplan']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpSiteplan']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpSiteplan']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpGambarSchematic" class="">Fotocopy Gambar Schematik:</label>
			<select class="form-control" name="FtcpGambarSchematic" >
						<option value="<?php echo $manufacture[0]['FtcpGambarSchematic']; ?>"><?php if ($manufacture[0]['FtcpGambarSchematic']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpGambarSchematic']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpGambarSchematic']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpRkkSlf" class="">Fotocopy RKK SLF:</label>
			<select class="form-control" name="FtcpRkkSlf" >
						<option value="<?php echo $manufacture[0]['FtcpRkkSlf']; ?>"><?php if ($manufacture[0]['FtcpRkkSlf']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpRkkSlf']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpRkkSlf']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpCeklisInternal" class="">Fotocopy Ceklist Internal:</label>
			<select class="form-control" name="FtcpCeklisInternal" >
						<option value="<?php echo $manufacture[0]['FtcpCeklisInternal']; ?>"><?php if ($manufacture[0]['FtcpCeklisInternal']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpCeklisInternal']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpCeklisInternal']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="DokMKKG" class="">Dokumen MKKG:</label>
			<select class="form-control" name="DokMKKG">
						<option value="<?php echo $manufacture[0]['DokMKKG']; ?>"><?php if ($manufacture[0]['DokMKKG']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['DokMKKG']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['DokMKKG']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FormPermohonan" class="">Form Permohonan:</label>
			<select class="form-control" name="FormPermohonan">
						<option value="<?php echo $manufacture[0]['FormPermohonan']; ?>"><?php if ($manufacture[0]['FormPermohonan']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FormPermohonan']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FormPermohonan']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpSrtKuasa" class="">Fotocopy Surat Kuasa:</label>
			<select class="form-control" name="FtcpSrtKuasa">
						<option value="<?php echo $manufacture[0]['FtcpSrtKuasa']; ?>"><?php if ($manufacture[0]['FtcpSrtKuasa']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpSrtKuasa']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpSrtKuasa']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpNPWP" class="">Fotocopy NPWP:</label>
			<select class="form-control" name="FtcpNPWP">
						<option value="<?php echo $manufacture[0]['FtcpNPWP']; ?>"><?php if ($manufacture[0]['FtcpNPWP']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpNPWP']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpNPWP']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpIMB" class="">Fotocopy IMB:</label>
			<select class="form-control" name="FtcpIMB">
						<option value="<?php echo $manufacture[0]['FtcpIMB']; ?>"><?php if ($manufacture[0]['FtcpIMB']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpIMB']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpIMB']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpDenah" class="">Fotocopy Denah:</label>
			<select class="form-control" name="FtcpDenah">
						<option value="<?php echo $manufacture[0]['FtcpDenah']; ?>"><?php if ($manufacture[0]['FtcpDenah']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpDenah']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpDenah']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpBuktiMilikTanah" class="">Fotocopy Bukti Milik Tanah:</label>
			<select class="form-control" name="FtcpBuktiMilikTanah">
						<option value="<?php echo $manufacture[0]['FtcpBuktiMilikTanah']; ?>"><?php if ($manufacture[0]['FtcpBuktiMilikTanah']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpBuktiMilikTanah']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpBuktiMilikTanah']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpSkkAkhir" class="">Fotocopy SKK Akhir:</label>
			<select class="form-control" name="FtcpSkkAkhir">
						<option value="<?php echo $manufacture[0]['FtcpSkkAkhir']; ?>"><?php if ($manufacture[0]['FtcpSkkAkhir']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpSkkAkhir']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpSkkAkhir']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="DokInventarisApar" class="">Dokumen Inventaris APAR:</label>
			<select class="form-control" name="DokInventarisApar">
						<option value="<?php echo $manufacture[0]['DokInventarisApar']; ?>"><?php if ($manufacture[0]['DokInventarisApar']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['DokInventarisApar']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['DokInventarisApar']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="DokTeknisGedung" class="">Dokumen Teknis Gedung:</label>
			<select class="form-control" name="DokTeknisGedung">
						<option value="<?php echo $manufacture[0]['DokTeknisGedung']; ?>"><?php if ($manufacture[0]['DokTeknisGedung']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['DokTeknisGedung']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['DokTeknisGedung']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  
	   	<div class="col-sm-12 col-xs-20" id="appr" >
          <div class="form-actions" style="text-align: center;">
            <button class="btn btn-primary" type="submit" onclick="return confirm('Yakin RUBAH data ini?');">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
		</div>

      <?php echo form_close(); ?>

    </div>
     