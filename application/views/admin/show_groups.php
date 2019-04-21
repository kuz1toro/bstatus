<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo lang('index_heading');?>
			<small></small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
			<li class="active">Groups</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- left column -->
			<div class="col-md-6">
			<!-- general form elements -->
				<div class="box box-primary">

		<p><?php echo lang('index_subheading');?></p>

		

		<table cellpadding=0 cellspacing=10 class="table table-bordered">
			<tr>
				<th><?php echo lang('index_groups_th');?></th>
				<th><?php echo lang('index_status_th');?></th>
			</tr>
			<?php //echo '<pre>'; print_r($groups); echo '</pre>'; ?>
			<?php foreach ($groups as $group):?>
				<tr>
					<td><?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8');?></td>
					<td><?php echo htmlspecialchars($group->description,ENT_QUOTES,'UTF-8');?></td>
					<td>
						<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars('EDIT',ENT_QUOTES,'UTF-8')) ;?><br />
					</td>
				</tr>
			<?php endforeach;?>
		</table>

		<a href="create_group" class="btn btn-primary btn-xl" type="button"><?php echo lang('index_create_group_link');?></a>
		</div></div></div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
