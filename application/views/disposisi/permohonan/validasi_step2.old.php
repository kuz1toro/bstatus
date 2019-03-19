
	<div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("disposisi/home"); ?>">
            Home
          </a> 
        </li>
        <li>
          <a href="<?php echo site_url("pokja").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
        </li>
        <li class="active">
          Validasi
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
      echo validation_errors();
	
	  //kalau sukses atau gagal buka ini
      echo form_open('disposisi/permohonan/validasi_step3', $attributes);
      ?>
	  
	  
    <div class="col-sm-12 col-xs-20" id="textarea_form" >
          <div class="" style="text-align: center; color:blue;">
            <p class=""><strong>Data Gedung</strong></p>
          </div>
		</div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NamaGedung" class="">Nama Gedung:</label>
			<textarea type="text" class="form-control" name="NamaGedung"  placeholder="Nama Gedung" style="resize: none;" disabled><?php echo $manufacture[0]['NamaGedung']; ?></textarea>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="Alamat" class="">Alamat:</label>
			<textarea type="text" class="form-control" name="Alamat" id="textarea_form" placeholder="Alamat" style="resize: none;" disabled><?php echo $manufacture[0]['Alamat']; ?></textarea>
		</div>
	  </div>
		<div class="col-sm-12 col-xs-20" id="textarea_form">
			<button class="btn btn-info" title="detail" type="button" data-toggle="collapse" data-target="#collapseable1" aria-expanded="false" aria-controls="collapseable1">detail<span class="glyphicon glyphicon-chevron-right"></span></button> 
		</div>
	<div class="collapse" id="collapseable1">
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="Wilayah" class="">Wilayah:</label>
			<select class="form-control" name="Wilayah" value="" id="Wilayah" onchange="selectKec(this.options[this.selectedIndex].value)" disabled>
						<option value="<?php echo $manufacture[0]['Wilayah']; ?>"><?php echo $manufacture[0]['Wilayah']; ?></option>
						<option value="Pusat">Pusat</option>
						<option value="Utara">Utara</option>
						<option value="Barat">Barat</option>
						<option value="Selatan">Selatan</option>
						<option value="Timur">Timur</option>
						<option value="P1000">P1000</option>
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="Kecamatan" class="">Kecamatan:</label>
			<select class="form-control" id="kecamatan_dropdown" name="Kecamatan" onchange="selectKel(this.options[this.selectedIndex].value)" disabled>
				<option value="<?php echo $manufacture[0]['Kecamatan']; ?>"><?php echo $manufacture[0]['Kecamatan']; ?></option>
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="Kelurahan" class="">Kelurahan:</label>
			<select class="form-control" id="kelurahan_dropdown" name="Kelurahan" onchange="showKodepos(this.options[this.selectedIndex].value)" disabled>
				<option value="<?php echo $manufacture[0]['Kelurahan']; ?>"><?php echo $manufacture[0]['Kelurahan']; ?></option>
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="KodePos" class="">Kode Pos:</label>
			<input type="text" class="form-control" name="KodePos" id="kodepos_dropdown" placeholder="Kode Pos" value= "<?php echo $manufacture[0]['KodePos']; ?>" disabled>
		</div>
	  </div>
		<div class="col-sm-12 col-xs-20" id="textarea_form">
			<div class="col-sm-5 col-xs-12" id="textarea_form">
				<label for="NoImb" class="">No IMB:</label>
				<input type="text" class="form-control" name="NoImb" id="" placeholder="No IMB" value= "<?php echo $manufacture[0]['NoImb']; ?>" disabled>
			</div>
			<div class="col-sm-2 hidden-xs" id=""></div>
			<div class="col-sm-5 col-xs-12" id="textarea_form">
				<label for="TglImb" class="">Tgl IMB:</label>
				<input type="text" class="form-control" name="TglImb" id="" placeholder="Tgl IMB" value= "<?php echo sqlDate2html($manufacture[0]['TglImb']); ?>" disabled>
			</div>
	    </div>
		<div class="col-sm-12 col-xs-20" id="textarea_form">
			<div class="col-sm-5 col-xs-12" id="textarea_form">
				<label for="Status" class="">Status Kepemilikan:</label>
				<select class="form-control" name="Status" disabled>
							<option value="<?php echo $manufacture[0]['Status']; ?>"><?php echo $manufacture[0]['Status']; ?></option>
							<option value="Swasta" <?php if ($manufacture[0]['Status']=='Swasta'){echo 'hidden';}?>>Swasta</option>
							<option value="Pemda DKI" <?php if ($manufacture[0]['Status']=='Pemda DKI'){echo 'hidden';}?>>Pemda DKI</option>
							<option value="Pemerintah Non-DKI" <?php if ($manufacture[0]['Status']=='Pemerintah Non-DKI'){echo 'hidden';}?>>Pemerintah Non-DKI</option> </select>
				</select>
			</div>
			<div class="col-sm-2 hidden-xs" id=""></div>
			<div class="col-sm-5 col-xs-12" id="textarea_form">
				<label for="Class" class="">Fungsi Bangunan:</label>
				<select class="form-control" name="Class" disabled>
							<option value="<?php echo $manufacture[0]['Class']; ?>"><?php echo $manufacture[0]['Class']; ?></option>
							<option value="Kantor">Kantor</option>
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
			</div>
		</div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NoRekomtekAkhir" class="">No Rekomtek Sistem Terakhir:</label>
			<input type="text" class="form-control" name="NoRekomtekAkhir" id="" placeholder="No Rekomtek Terakhir" value= "<?php echo $manufacture[0]['NoRekomtekAkhir']; ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="TglRekomtekAkhir" class="">Tanggal Rekomtek Sistem Terakhir:</label>
			<input type="text" class="form-control" name="TglRekomtekAkhir" id="" placeholder="No SLF Terakhir" value= "<?php echo sqlDate2html($manufacture[0]['TglRekomtekAkhir']); ?>" disabled>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NoSlfAkhir" class="">No SLF Terakhir:</label>
			<input type="text" class="form-control" name="NoSlfAkhir" id="" placeholder="No SLF Terakhir" value= "<?php echo $manufacture[0]['NoSlfAkhir']; ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="TglSlfAkhir" class="">Tgl SLF Terakhir:</label>
			<input type="text" class="form-control" name="TglSlfAkhir" id="" placeholder="Tgl SLF Terakhir" value= "<?php echo sqlDate2html($manufacture[0]['TglSlfAkhir']); ?>" disabled>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NoSkkAkhir" class="">No SKK Terakhir:</label>
			<input type="text" class="form-control" name="NoSkkAkhir" id="" placeholder="No SKK Terakhir" value= "<?php echo $manufacture[0]['NoSkkAkhir']; ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="TglSkkAkhir" class="">Tanggal SKK Terakhir:</label>
			<input type="text" class="form-control" name="TglSkkAkhir" id="" placeholder="Tanggal SKK Terakhir" value= "<?php echo sqlDate2html($manufacture[0]['TglSkkAkhir']); ?>" disabled>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="JmlMasaBang" class="">Jumlah Masa Bangunan:</label>
			<input type="number" class="form-control" name="JmlMasaBang" id="" placeholder="Jumlah Masa Bangunan" value= "<?php echo $manufacture[0]['JmlMasaBang']; ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="JmlNamaGedung" class="">Jumlah Nama Gedung:</label>
			<input type="number" class="form-control" name="JmlNamaGedung" id="" placeholder="Jumlah Nama Gedung" value= "<?php echo $manufacture[0]['JmlNamaGedung']; ?>" disabled>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="Lantai" class="">Jumlah Lantai:</label>
			<input type="number" class="form-control" name="Lantai" id="" placeholder="Jumlah Lantai" value= "<?php echo $manufacture[0]['Lantai']; ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
		<label for="search_string" class="">Luas Lantai:</label>
		<div class="input-group" id="textarea_form">
			<input type="number" class="form-control" name="LuasLantai" id="" placeholder="Luas Lantai" value= "<?php echo $manufacture[0]['LuasLantai']; ?>" disabled>
			<span class="input-group-addon" id="basic-addon2">m<sup>2</sup></span>
		</div>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="search_string" class="">Jumlah Basement:</label>
			<input type="number" class="form-control" name="Basement" id="" placeholder="Jumlah Basement" value= "<?php echo $manufacture[0]['Basement']; ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="Class" class="">Kelas Resiko:</label>
			<select class="form-control" name="Class" value="" disabled>
						<option value="<?php echo $manufacture[0]['Class']; ?>"><?php echo $manufacture[0]['Class']; ?></option>
						<option value="Rendah">Rendah</option>
						<option value="Sedang">Sedang</option>
						<option value="Sedang">Tinggi</option>
				</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-8 col-xs-12" id="textarea_form">
			<label for="search_string" class="">Keterangan/ Catatan:</label>
			<textarea type="text" class="form-control" name="Keterangan"  placeholder="Keterangan/ Catatan" style="resize: none;" disabled><?php echo $manufacture[0]['Keterangan']; ?></textarea>
		</div>
		<div class="col-sm-4 hidden-xs" id=""></div>
	</div>
	</div>
	
	<div class="col-sm-12 col-xs-20" id="textarea_form" style="border-top: 2px solid black" >
          <div class="" style="text-align: center; color:blue;">
            <p class=""><strong>Data Permohonan</strong></p>
		  </div>
	</div>
	<div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NamaPengelola" class="">Nama Pengelola:</label>
			<textarea type="text" class="form-control" name="NamaPengelola"  placeholder="Nama Pengelola" style="resize: none;" disabled><?php echo $manufacture[0]['NamaPengelola']; ?></textarea>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="KetPrainspeksi" class="">Keterangan/ Catatan:</label>
			<textarea type="text" class="form-control" name="KetPrainspeksi" id="textarea_form" placeholder="Keterangan/ Catatan" style="resize: none;" disabled><?php echo $manufacture[0]['KetPrainspeksi']; ?></textarea>
		</div>
	  </div>
		<div class="col-sm-12 col-xs-20" id="textarea_form">
			<button class="btn btn-info" title="detail" type="button" data-toggle="collapse" data-target="#collapseable2" aria-expanded="false" aria-controls="collapseable2">detail<span class="glyphicon glyphicon-chevron-right"></span></button> 
		</div>
	<div class="collapse" id="collapseable2">
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NoTelpPengelola" class="">No Telp Pengelola:</label>
			<input type="text" class="form-control" name="NoTelpPengelola" id="" placeholder="No Telp Pengelola" value= "<?php echo $manufacture[0]['NoTelpPengelola']; ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NoPermhn" class="">No Permohonan:</label>
			<input type="text" class="form-control" name="NoPermhn" id="" placeholder="No Permohonan" value= "<?php echo $manufacture[0]['NoPermhn']; ?>" disabled>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="TglSuratDiterima" class="">Tanggal Surat Diterima:</label>
			<input type="text" class="form-control" name="TglSuratDiterima" id="" placeholder="Tanggal Surat Diterima" value= "<?php echo sqlDate2html($manufacture[0]['TglSuratDiterima']); ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="TglPermhn" class="">Tanggal Permohonan:</label>
			<input type="text" class="form-control" name="TglPermhn" id="" placeholder="Tanggal Permohonan" value= "<?php echo sqlDate2html($manufacture[0]['TglPermhn']); ?>" disabled>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="SuratPermohonan" class="">Surat Permohonan:</label>
			<select class="form-control" name="SuratPermohonan" disabled>
						<option value="<?php echo $manufacture[0]['SuratPermohonan']; ?>"><?php if ($manufacture[0]['SuratPermohonan']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['SuratPermohonan']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['SuratPermohonan']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="SuratPernyataan" class="">Surat Pernyataan:</label>
			<select class="form-control" name="SuratPernyataan" disabled>
						<option value="<?php echo $manufacture[0]['SuratPernyataan']; ?>"><?php if ($manufacture[0]['SuratPernyataan']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['SuratPernyataan']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['SuratPernyataan']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpKTP" class="">Fotocopy KTP:</label>
			<select class="form-control" name="FtcpKTP" disabled>
						<option value="<?php echo $manufacture[0]['FtcpKTP']; ?>"><?php if ($manufacture[0]['FtcpKTP']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpKTP']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpKTP']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpAktaPershn" class="">Fotocopy Akta Perusahaan:</label>
			<select class="form-control" name="FtcpAktaPershn" disabled>
						<option value="<?php echo $manufacture[0]['FtcpAktaPershn']; ?>"><?php if ($manufacture[0]['FtcpAktaPershn']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpAktaPershn']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpAktaPershn']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpSiteplan" class="">Fotocopy Siteplan:</label>
			<select class="form-control" name="FtcpSiteplan" disabled>
						<option value="<?php echo $manufacture[0]['FtcpSiteplan']; ?>"><?php if ($manufacture[0]['FtcpSiteplan']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpSiteplan']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpSiteplan']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpGambarSchematic" class="">Fotocopy Gambar Schematik:</label>
			<select class="form-control" name="FtcpGambarSchematic" disabled>
						<option value="<?php echo $manufacture[0]['FtcpGambarSchematic']; ?>"><?php if ($manufacture[0]['FtcpGambarSchematic']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpGambarSchematic']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpGambarSchematic']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpRkkSlf" class="">Fotocopy RKK SLF:</label>
			<select class="form-control" name="FtcpRkkSlf" disabled>
						<option value="<?php echo $manufacture[0]['FtcpRkkSlf']; ?>"><?php if ($manufacture[0]['FtcpRkkSlf']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpRkkSlf']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpRkkSlf']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpCeklisInternal" class="">Fotocopy Ceklist Internal:</label>
			<select class="form-control" name="FtcpCeklisInternal" disabled>
						<option value="<?php echo $manufacture[0]['FtcpCeklisInternal']; ?>"><?php if ($manufacture[0]['FtcpCeklisInternal']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpCeklisInternal']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpCeklisInternal']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="DokMKKG" class="">Dokumen MKKG:</label>
			<select class="form-control" name="DokMKKG" disabled>
						<option value="<?php echo $manufacture[0]['DokMKKG']; ?>"><?php if ($manufacture[0]['DokMKKG']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['DokMKKG']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['DokMKKG']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FormPermohonan" class="">Form Permohonan:</label>
			<select class="form-control" name="FormPermohonan" disabled>
						<option value="<?php echo $manufacture[0]['FormPermohonan']; ?>"><?php if ($manufacture[0]['FormPermohonan']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FormPermohonan']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FormPermohonan']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpSrtKuasa" class="">Fotocopy Surat Kuasa:</label>
			<select class="form-control" name="FtcpSrtKuasa" disabled>
						<option value="<?php echo $manufacture[0]['FtcpSrtKuasa']; ?>"><?php if ($manufacture[0]['FtcpSrtKuasa']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpSrtKuasa']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpSrtKuasa']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpNPWP" class="">Fotocopy NPWP:</label>
			<select class="form-control" name="FtcpNPWP" disabled>
						<option value="<?php echo $manufacture[0]['FtcpNPWP']; ?>"><?php if ($manufacture[0]['FtcpNPWP']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpNPWP']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpNPWP']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpIMB" class="">Fotocopy IMB:</label>
			<select class="form-control" name="FtcpIMB" disabled>
						<option value="<?php echo $manufacture[0]['FtcpIMB']; ?>"><?php if ($manufacture[0]['FtcpIMB']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpIMB']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpIMB']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpDenah" class="">Fotocopy Denah:</label>
			<select class="form-control" name="FtcpDenah" disabled>
						<option value="<?php echo $manufacture[0]['FtcpDenah']; ?>"><?php if ($manufacture[0]['FtcpDenah']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpDenah']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpDenah']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpBuktiMilikTanah" class="">Fotocopy Bukti Milik Tanah:</label>
			<select class="form-control" name="FtcpBuktiMilikTanah" disabled>
						<option value="<?php echo $manufacture[0]['FtcpBuktiMilikTanah']; ?>"><?php if ($manufacture[0]['FtcpBuktiMilikTanah']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpBuktiMilikTanah']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpBuktiMilikTanah']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="FtcpSkkAkhir" class="">Fotocopy SKK Akhir:</label>
			<select class="form-control" name="FtcpSkkAkhir" disabled>
						<option value="<?php echo $manufacture[0]['FtcpSkkAkhir']; ?>"><?php if ($manufacture[0]['FtcpSkkAkhir']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['FtcpSkkAkhir']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['FtcpSkkAkhir']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	  <div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="DokInventarisApar" class="">Dokumen Inventaris APAR:</label>
			<select class="form-control" name="DokInventarisApar" disabled>
						<option value="<?php echo $manufacture[0]['DokInventarisApar']; ?>"><?php if ($manufacture[0]['DokInventarisApar']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['DokInventarisApar']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['DokInventarisApar']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="DokTeknisGedung" class="">Dokumen Teknis Gedung:</label>
			<select class="form-control" name="DokTeknisGedung" disabled>
						<option value="<?php echo $manufacture[0]['DokTeknisGedung']; ?>"><?php if ($manufacture[0]['DokTeknisGedung']=='1'){echo 'Ada';}else{echo 'Tidak ada';} ?></option>
						<option value="0" <?php if ($manufacture[0]['DokTeknisGedung']=='0'){echo 'hidden';}?>>Tidak Ada</option> 
						<option value="1" <?php if ($manufacture[0]['DokTeknisGedung']=='1'){echo 'hidden';}?>>Ada</option> 
			</select>
		</div>
	  </div>
	</div>
	
	<div class="col-sm-12 col-xs-20" id="textarea_form" style="border-top: 2px solid black" >
          <div class="" style="text-align: center; color:blue;">
            <p class=""><strong>Hasil Inspeksi</strong></p>
		  </div>
	</div>
	<div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NoSrtTugas" class="">No Surat Tugas:</label>
			<input type="text" class="form-control" name="NoSrtTugas" id="" placeholder="No Surat Tugas" value="<?php echo $manufacture[0]['NoSrtTugas']; ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NoBA" class="">No Berita Acara:</label>
			<input type="text" class="form-control" name="NoBA" id="" placeholder="No Berita Acara" value="<?php echo $manufacture[0]['NoBA']; ?>" disabled>
		</div>
	</div>
	<div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="TglSrtTugas" class="">Tanggal Surat Tugas:</label>
			<input type="text" class="form-control" name="TglSrtTugas" id="Datepicker" placeholder="Tanggal Surat Tugas" value="<?php echo sqlDate2html($manufacture[0]['TglSrtTugas']); ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="TglBA" class="">Tanggal Berita Acara:</label>
			<input type="text" class="form-control" name="TglBA" id="Datepicker1" placeholder="Tanggal Berita Acara" value="<?php echo sqlDate2html($manufacture[0]['TglBA']); ?>" disabled>
		</div>
	</div>
	<div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="TglJdwlIns" class="">Jadwal Inspeksi:</label>
			<input type="text" class="form-control" name="TglJdwlIns" id="Datepicker2" placeholder="Jadwal Inspeksi" value="<?php echo sqlDate2html($manufacture[0]['TglJdwlIns']); ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="RiskClass" class="">Kelas Resiko Kebakaran:</label>
			<select class="form-control" name="RiskClass" disabled>
				<option value="<?php echo $manufacture[0]['RiskClass']; ?>"><?php echo $manufacture[0]['RiskClass'];?></option>
				<option value="Rendah" <?php if ($manufacture[0]['RiskClass']=='Rendah'){echo 'hidden';}?>>Rendah</option>
				<option value="Sedang" <?php if ($manufacture[0]['RiskClass']=='Sedang'){echo 'hidden';}?>>Sedang</option>
				<option value="Tinggi"<?php if ($manufacture[0]['RiskClass']=='Tinggi'){echo 'hidden';}?>>Tinggi</option> </select>
			</select>
		</div>
	</div>
	<div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="JmlhTower" class="">Jumlah Tower:</label>
			<input type="number" class="form-control" name="JmlhTower" id="" placeholder="Jumlah Tower" value="<?php echo $manufacture[0]['JmlhTower']; ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="JmlhLantai" class="">Jumlah Lantai:</label>
			<input type="number" class="form-control" name="JmlhLantai" id="" placeholder="Jumlah Lantai" value="<?php echo $manufacture[0]['JmlhLantai']; ?>" disabled>
		</div>
	</div>
	<div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="LuasLantai" class="">Luas Lantai:</label>
			<input type="number" class="form-control" name="LuasLantai" id="" placeholder="Luas Lantai" value="<?php echo $manufacture[0]['LuasLantai']; ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="JmlhLapisBismen" class="">Jumlah Lapis Bismen:</label>
			<input type="number" class="form-control" name="JmlhLapisBismen" id="" placeholder="Jumlah Lapis Bismen" value="<?php echo $manufacture[0]['JmlhLapisBismen']; ?>" disabled>
		</div>
	</div>
	<div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="TglPerbalLhp" class="">Tanggal Perbal LHP:</label>
			<input type="text" class="form-control" name="TglPerbalLhp" id="Datepicker3" placeholder="Tanggal Perbal LHP" value="<?php echo sqlDate2html($manufacture[0]['TglPerbalLhp']); ?>" disabled>
		</div>
		<div class="col-sm-2 hidden-xs" id=""></div>
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="NilaiEval" class="">Nilai Evaluasi:</label>
			<input type="number" class="form-control" name="NilaiEval" id="NilaiEval" placeholder="masukkan nilai 0 s/d 100" onchange="getEval(this.value)" value="<?php echo $manufacture[0]['NilaiEval']; ?>" disabled>
		</div>
	</div>
	<div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-5 col-xs-12" id="textarea_form">
			<label for="EvalKeslKebakrn" class="">Evaluasi Keselamatan Kebakaran:</label>
			<input type="text" class="form-control" name="EvalKeslKebakrn" id="Eval" placeholder="Automatic" value="<?php echo $manufacture[0]['EvalKeslKebakrn']; ?>" disabled>
		</div>
		<div class="col-sm-7 hidden-xs" id=""></div>
	</div>
	<div class="col-sm-12 col-xs-20" id="textarea_form">
		<div class="col-sm-8 col-xs-12" id="textarea_form">
			<label for="KetInsp" class="">Keterangan/ Catatan Inspektur:</label>
			<textarea type="text" class="form-control" name="KetInsp"  placeholder="Keterangan/ Catatan Inspektur" style="resize: none;" disabled><?php echo $manufacture[0]['KetInsp']; ?></textarea>
		</div>
		<div class="col-sm-4 hidden-xs" id=""></div>
	</div>
	
	<div class="col-sm-12 col-xs-20" id="textarea_form">
		<label for="" class="">Validasi?</label>
		<div class="btn-group col-sm-12 col-xs-12" data-toggle="buttons" id="textarea_form" required>
			<label class="btn btn-primary">
				<input type="radio" autocomplete="off" name="StatusPermhn" value="5"> Yes
			</label>
			<label class="btn btn-primary">
				<input type="radio" autocomplete="off" name="StatusPermhn" value="3"> No
			</label>
		</div>
	</div>
	
			<!--tidak ditampilkan-->
            <input type="text" id="" name="No_id" value="<?php echo $manufacture[0]['permhn_id']; ?>" style="display: none;" >
		
          <div class="col-sm-12 col-xs-20" id="appr" >
          <div class="form-actions" id="" style="text-align: center;">
            <button class="btn btn-primary" type="submit">Execute</button>
			<button class="btn" type="reset">Cancel</button>
          </div>    
		</div>	 
	
      <?php echo form_close(); ?>

    </div>
     
	<script language="javascript" type="text/javascript">
	function getEval(val){
		if(val>0 && val<=20){
			$("#Eval").val("Sangat Buruk");
		}else if (val>20 && val<=40){
			$("#Eval").val("Buruk");
		}else if (val>40 && val<=60){
			$("#Eval").val("Sedang");
		}else if (val>60 && val<=80){
			$("#Eval").val("Baik");
		}else if (val>80 && val<=100){
			$("#Eval").val("Sangat Baik");
		}else{
			$("#Eval").val("?");
	  }
	}
</script>