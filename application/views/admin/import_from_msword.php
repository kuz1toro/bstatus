<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo lang('index_heading');?>
			<small></small>
		</h1>
		<!--<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
			<li class="active">Users</li>
		</ol>-->
	</section>

	<!-- Main content -->
	<section class="content">
testing 
<br>
<a href="<?php echo site_url("admin/save_imported"); ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" title="import"><span class="glyphicon glyphicon-edit"></span></a>

<?php
	//var_dump($bookList[1003]);
	//$output = preg_replace('/\s+/', ' ', $lap_ins);
	//var_dump($output);
	//echo "isi =".$lap_ins[93]['span'].""; 
	//$output = preg_replace('/\s\s+/u', ' ', $lap_ins[93]['span']);
	//echo "isi =".$output."";
	//var_dump($val_array);
	//print_r($result_arr);
	d($data);
	echo '<br>';
	//d($result_ujicoba);
	//echo '<br>';
	//d($main_result);
	//echo 'Current PHP version: ' . phpversion();

	$files = glob('xml/*.{html}', GLOB_BRACE);
	d($files);
	echo  mb_strlen(serialize((array)$data), '8bit');


?>

</a>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
