<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo lang('deactivate_heading');?>
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
			<li class="active">Here</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Your Page Content Here -->
		<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

		<?php echo form_open("auth/deactivate/".$user->id);?>

		<p>
			<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
			<input type="radio" name="confirm" value="yes" checked="checked" />
			<?php echo lang('deactivate_confirm_n_label', 'confirm');?>
			<input type="radio" name="confirm" value="no" />
		</p>

		<?php echo form_hidden($csrf); ?>
		<?php echo form_hidden(array('id'=>$user->id)); ?>

		<p><?php echo form_submit('submit', lang('deactivate_submit_btn'));?></p>

		<?php echo form_close();?>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
