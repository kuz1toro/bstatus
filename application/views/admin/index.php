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
			<li class="active">Users</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<p><?php echo lang('index_subheading');?></p>

		<div id="infoMessage"><?php echo $message;?></div>

		<table cellpadding=0 cellspacing=10 class="table table-bordered">
			<tr>
				<th><?php echo lang('index_fname_th');?></th>
				<th><?php echo lang('index_lname_th');?></th>
				<th><?php echo lang('index_email_th');?></th>
				<th><?php echo lang('index_groups_th');?></th>
				<th><?php echo lang('index_status_th');?></th>
				<th><?php echo lang('index_action_th');?></th>
			</tr>
			<?php foreach ($users as $user):?>
				<tr>
					<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
					<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
					<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
					<td>
						<?php foreach ($user->groups as $group):?>
							<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
						<?php endforeach?>
					</td>
					<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
					<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
				</tr>
			<?php endforeach;?>
		</table>

		<a href="create_user" class="btn btn-primary btn-xl" type="button"><?php echo lang('index_create_user_link');?></a> | <a href="create_group" class="btn btn-primary btn-xl" type="button"><?php echo lang('index_create_group_link');?></a>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
