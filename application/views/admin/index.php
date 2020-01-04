<section class="content" >
    <div class="row" >
        <div class="col-lg-12" >
			<div class="card">
				<div class="header">
					<h2>
						<?php echo lang('index_subheading');?>
					</h2>
					<div id="infoMessage"><?php //echo $message;?></div>
					<ul class="header-dropdown m-r--5">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<i class="material-icons">more_vert</i>
							</a>
							<ul class="dropdown-menu pull-right">
								<li><a href="javascript:void(0);">Action</a></li>
								<li><a href="javascript:void(0);">Another action</a></li>
								<li><a href="javascript:void(0);">Something else here</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="body">
					<div class="display">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th>No</th>
									<th><?php echo 'Username/ NRK';?></th>
									<th><?php echo lang('index_fname_th');?></th>
									<th><?php echo lang('index_lname_th');?></th>
									<th><?php echo lang('index_email_th');?></th>
									<th><?php echo lang('index_groups_th');?></th>
									<th><?php echo lang('index_status_th');?></th>
									<th><?php echo 'Password';?></th>
									<th><?php echo lang('index_action_th');?></th>
								</tr>
							</thead>
							<tbody> <?php $i =1; ?>
								<?php foreach ($users as $user):?>
									<tr>
										<td><?php echo $i; $i++;?></td>
										<td><?php echo htmlspecialchars($user->username,ENT_QUOTES,'UTF-8');?></td>
										<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
										<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
										<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
										<td>
											<?php foreach ($user->groups as $group):?>
												<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
											<?php endforeach?>
										</td>
										<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
										<td><?php echo anchor("auth/myResetPassword/".$user->id, 'Reset') ;?></td>
										<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col align-right" style="margin-bottom:15px;">
					<div class="btn-group">
						<a href="create_user" class="btn btn-warning btn-xl" type="button"><?php echo lang('index_create_user_link');?></a> | <a href="create_group" class="btn btn-primary btn-xl" type="button"><?php echo lang('index_create_group_link');?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.content -->
</section>
<!-- /.content-wrapper -->
