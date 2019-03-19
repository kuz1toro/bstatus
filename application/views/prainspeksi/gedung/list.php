<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<?php /**
	<section class="content-header">
		<h1>
			Daftar Gedung
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a><?php echo ucfirst($this->ion_auth->user()->row()->username); ?></a></li>
			<li><a>Gedung</a></li>
			<li class="active">
				<?php echo ucfirst($this->uri->segment(2));?>
			</li>
		</ol>
	</section> */ ?>

	<?php
		$attributes = array('method' => 'get', 'class' => 'form-inline reset-margin', 'id' => 'myform');
		echo form_open('prainspeksi_gedung/index', $attributes); 
	?>

	<!-- Main content -->
	<section class="content">
		<div class="box">
			<!-- /.box-header -->
			<div class="box-header with-border">
				<div class="col-sm-12 col-xs-12" id="" style="" align="right" >
					<div class="input-group" >
						<span class="input-group-btn hidden-xs">
							<select class="btn btn-default" name="search_in" value="<?php echo $search_in_field; ?>" data-toggle="tooltip" title="Cari di:">
								<option value="NamaGedung" <?php if ($search_in_field=='NamaGedung') {
									echo 'selected';
								}?> >Nama Gedung</option>
								<option value="Alamat" <?php if ($search_in_field=='Alamat') {
									echo 'selected';
								}?> >Alamat</option>
								<option value="Kelurahan" <?php if ($search_in_field=='Kelurahan') {
									echo 'selected';
								}?> >Kelurahan</option>
								<option value="Kecamatan" <?php if ($search_in_field=='Kecamatan') {
									echo 'selected';
								}?> >Kecamatan</option>
								<option value="NoImb" <?php if ($search_in_field=='NoImb') {
									echo 'selected';
								}?> >No IMB</option>
								<option value="TglImb" <?php if ($search_in_field=='TglImb') {
									echo 'selected';
								}?> >Tgl IMB</option>
							</select>
							<select class="btn btn-default" name="order" value="<?php echo $order; ?>" data-toggle="tooltip" title="diurutkan berdasarkan:">
								<option value="id" <?php if ($order=='id') {
									echo 'selected';
								}?> >No</option>
								<option value="NamaGedung" <?php if ($order=='NamaGedung') {
									echo 'selected';
								}?> >Nama Gedung</option>
								<option value="Alamat" <?php if ($order=='Alamat') {
									echo 'selected';
								}?> >Alamat</option>
								<option value="Kelurahan" <?php if ($order=='Kelurahan') {
									echo 'selected';
								}?> >Kelurahan</option>
								<option value="Kecamatan" <?php if ($order=='Kecamatan') {
									echo 'selected';
								}?> >Kecamatan</option>
							</select>
							<select class="btn btn-default" name="order_type" value="<?php echo $order_type_selected; ?>" data-toggle="tooltip" title="pengurutan:">
								<option value="Asc" <?php if ($order_type_selected=='Asc') {
									echo 'selected';
								}?> > terkecil->terbesar </option>
								<option value="Desc" <?php if ($order_type_selected=='Desc') {
									echo 'selected';
								}?> > terbesar->terkecil </option>
							</select>
						</span>
						<input type="text" class="form-control" name="search_string" id="" value="<?php echo $search_string_selected; ?>" placeholder="kata kunci" >
						<span class="input-group-btn" id="">
							<button class="btn btn-primary" type="submit" data-toggle="tooltip" title="cari"><span class="glyphicon glyphicon-search"></span></button>
							<button class="btn btn-primary" onclick="location.href='<?php echo ''.base_url().'prainspeksi_gedung/index'; ?>'" type="button" data-toggle="tooltip" title="reset pencarian"><span class="glyphicon glyphicon-refresh"></span></button>
						</span>
					</div>
				</div>
			</div>

			<?php 
				$page_data['hal_skr'] = base_url().ltrim($_SERVER['PATH_INFO'], '/');
				$this->session->set_userdata($page_data);
				//var_dump($this->session->userdata());
				?>
			<?php echo form_close(); ?>

			<div class="box-body">
				<?php pesanModal();
				//flash messages
				if($this->session->flashdata('flash_message')=='added'){
					echo'<script>
					window.onload = function(){
						$("#sukses").modal();
					};
					</script>';
				}
				else if(validation_errors())
				{ echo'<script>
					window.onload = function(){
						$("#gagal").modal();
					};
					</script>';
				}else if($this->session->flashdata('flash_message')=='updated')
				{ echo'<script>
					window.onload = function(){
						$("#updated").modal();
					};
					</script>';
				}
				?>

				<div class="row">
					<div class="span12 columns">
						

						<table class="table table-bordered table-hover">
							<!--<caption>Tabel Daftar Gedung</caption>-->
							<thead>
								<tr>
									<th class="">Action</th>
									<th class="header">Id</th>
									<th class="">Nama Gedung</th>
									<th class="">Alamat</th>
									<th class="hidden-xs">Kelurahan</th>
									<th class="">Kecamatan</th>
									<th class="hidden-xs" >Wilayah</th>
									<th class="hidden-xs" >Status</th>
									<th class="hidden-xs">Fungsi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$rows=count($gedungs);
								$count = 1;
								foreach($gedungs as $row)
								{
									echo '<tr '; if($this->session->flashdata('flash_message')=='added' && $count==$rows){echo ' class="kedipGrey" >'; $this->session->set_flashdata('flash_message', '');}else{echo '>';}
										echo '<td class="">
										<a href="'.site_url("prainspeksi_gedung/update").'/'.$row['id'].'" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Lihat & Edit"><span class="glyphicon glyphicon-edit"></span></a></td>';
										echo '<td>'.$row['id'].'</td>';
										echo '<td>'.$row['NamaGedung'].'</td>';
										echo '<td>'.$row['Alamat'].'</td>';
										echo '<td class="hidden-xs">'.$row['Kelurahan'].'</td>';
										echo '<td>'.$row['Kecamatan'].'</td>';
										echo '<td class="hidden-xs">'.$row['Wilayah'].'</td>';
										echo '<td class="hidden-xs">'.$row['Status'].'</td>';
										echo '<td class="hidden-xs">'.$row['Fungsi'].'</td>';
									/*<a href="'.site_url("prainspeksi").'/gedung/delete/'.$row['id'].'" onclick="return confirm(\'Yakin HAPUS data ini?\');" class="btn btn-danger" data-toggle="tooltip" title="Hapus"'; if($this->session->userdata('previlage') == 'prainspeksi'){echo 'style="display: none;"';} echo '><span class="glyphicon glyphicon-trash"></span></a>
									</td>*/
									echo '</tr>';
									$count++ ;
								}
								?>
							</tbody>
						</table>

						<div style="text-align: center;">
							<?php echo $this->pagination->create_links(); ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
