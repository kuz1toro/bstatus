<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo lang('create_group_heading');?>
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
			<li class="active">Here</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<p><?php echo lang('create_group_subheading');?></p>

		<div id="infoMessage"><?php echo $message;?></div>

		<?php echo form_open("auth/create_group");?>

		<p>
			<?php echo lang('create_group_name_label', 'group_name');?> <br />
			<?php echo form_input($group_name);?>
		</p>

		<p>
			<?php echo lang('create_group_desc_label', 'description');?> <br />
			<?php echo form_input($description);?>
		</p>

		<p><?php echo form_submit('submit', lang('create_group_submit_btn'));?></p>

		<?php echo form_close();?>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
