<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

	<?php
		$attributes = array('method' => 'get', 'class' => 'form-inline reset-margin', 'id' => 'myform');
		echo form_open('disposisi/validasi', $attributes);
	?>

	<!-- Main content -->
	<section class="content">
		<div class="box">
			<div class="box-body">
				<!-- /.box-header -->
				<div class="box-header with-border">
					<div class="col-sm-12 col-xs-12" id="" style="" align="right" >
						<div class="input-group" >
							<span class="input-group-btn hidden-xs">
								<select class="btn btn-default" name="search_in" value="<?php echo $search_in_field; ?>" data-toggle="tooltip" title="Cari di:">
									<option value="NamaGedung" <?php if ($search_in_field=='NamaGedung') {
										echo 'selected';
									}?> >Nama Gedung</option>
									<option value="NamaPengelola" <?php if ($search_in_field=='NamaPengelola') {
										echo 'selected';
									}?> >Nama Pengelola</option>
									<option value="TipePermhn" <?php if ($search_in_field=='TipePermhn') {
										echo 'selected';
									}?> >Tipe Permohonan</option>
									<option value="NoPermhn" <?php if ($search_in_field=='NoPermhn') {
										echo 'selected';
									}?> >No Permohonan</option>
									<option value="TglPermhn" <?php if ($search_in_field=='TglPermhn') {
										echo 'selected';
									}?> >Tgl Permohonan</option>
								</select>
								<select class="btn btn-default" name="order" value="<?php echo $order; ?>" data-toggle="tooltip" title="diurutkan berdasarkan:">
									<option value="id" <?php if ($order=='id') {
										echo 'selected';
									}?> >No</option>
									<option value="NamaGedung" <?php if ($order=='NamaGedung') {
										echo 'selected';
									}?> >Nama Gedung</option>
									<option value="NamaPengelola" <?php if ($order=='NamaPengelola') {
										echo 'selected';
									}?> >Nama Pengelola</option>
									<option value="NoPermhn" <?php if ($order=='NoPermhn') {
										echo 'selected';
									}?> >No Permohonan</option>
									<option value="TipePermhn" <?php if ($order=='TipePermhn') {
										echo 'selected';
									}?> >Tipe Permohonan</option>
									<option value="TglPermhn" <?php if ($order=='TglPermhn') {
										echo 'selected';
									}?> >Tgl Permohonan</option>
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
								<button class="btn btn-primary" onclick="location.href='<?php echo ''.base_url().'disposisi/validasi'; ?>'" type="button" data-toggle="tooltip" title="reset pencarian"><span class="glyphicon glyphicon-refresh"></span></button>
							</span>
						</div>
					</div>
				</div>

				<!-- untuk back page -->
				<?php 
					$page_data['hal_skr'] = base_url().ltrim($_SERVER['PATH_INFO'], '/');
					$this->session->set_userdata($page_data);
					//var_dump($this->session->userdata());
				?>

				<?php echo form_close(); ?>

				<!-- Modal alert-->
				<?php pesanModal();

				//flash messages
				if($this->session->flashdata('flash_message')=='added'){
					echo'<script>
					window.onload = function(){
						$("#sukses").modal();
					};
					</script>';
				}else if(validation_errors())
				{ echo'<script>
					window.onload = function(){
						$("#gagal").modal();
					};
					</script>';
				}else if($this->session->flashdata('flash_message')=='deleted')
				{ echo'<script>
					window.onload = function(){
						$("#deleted").modal();
					};
					</script>';
				}else if($this->session->flashdata('flash_message')=='updated')
				{ echo'<script>
					window.onload = function(){
						$("#updated").modal();
					};
					</script>';
				}else if($this->session->flashdata('flash_message')=='validated_yes')
				{ echo'<script>
					window.onload = function(){
						$("#validated_yes").modal();
					};
					</script>';
				}else if($this->session->flashdata('flash_message')=='validated_no')
				{ echo'<script>
					window.onload = function(){
						$("#validated_no").modal();
					};
					</script>';
				}
				?>

				

				<div class="row">
					<div class="span12 columns">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="crud-actions">Action</th>
									<th class="">No</th>
	                				<th class="">Nama Pengelola</th>
									<th class="hidden-xs">Nama Gedung</th>
									<th class="hidden-xs">Tipe Permohonan</th>
									<th class="hidden-xs">No Permohonan</th>
									<th class="hidden-xs">Tgl Permohonan</th>
									<th class="hidden-xs">Tgl Diterima</th>
									<th class="">Kepala Inspektur</th>
									<th class="">Hasil Evaluasi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$rows=count($permohonans);
								$count = 1;
								foreach($permohonans as $row)
								{
									echo '<tr'; if($this->session->flashdata('flash_message')=='added' && $count==$rows){echo ' class="kedipGrey" >'; $this->session->set_flashdata('flash_message', '');}else{echo '>';}
									echo '<td class="">
										<div class="btn-group" role="group">
											<a href="'.site_url("disposisi").'/validasi_step2/'.$row['id'].'" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Lihat & Validasi"><span class="glyphicon glyphicon-info-sign"></span></a>
											<button type="button" class="btn btn-default btn-sm t-val" val="'.site_url("disposisi/validasi_yes").'/'.$row['id'].'" data-toggle="tooltip" title="Setuju Validasi?"><span class="glyphicon glyphicon-thumbs-up"></span></button>
										</div>
									</td>';
									echo '<td>'.$row['id'].'</td>';
									echo '<td>'.$row['NamaPengelola'].'</td>';
									echo '<td>'.$row['Nama_Gedung_Id'].'</td>';
									echo '<td class="hidden-xs">'.$row['TipePermhn'].'</td>';
									echo '<td class="hidden-xs">'.$row['NoPermhn'].'</td>';
									echo '<td class="hidden-xs">'.sqlDate2html($row['TglPermhn']).'</td>';
									echo '<td class="hidden-xs">'.sqlDate2html($row['TglSuratDiterima']).'</td>';
									echo '<td>'.$row['KaInsp'].'</td>';
									echo '<td class="hidden-xs">'.$row['EvalKeslKebakrn'].'</td>';
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
</div>
