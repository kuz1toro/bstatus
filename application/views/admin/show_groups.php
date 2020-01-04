<section class="content" >
    <div class="row" >
        <div class="col-lg-8 col-lg-offset-2" >
			<div class="card">
				<div class="header">
					<h2>
						Daftar Groups
					</h2>
					<div id="infoMessage"><?php //echo $message;?> </div>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
						<li class="active">Groups</li>
					</ol>
				</div>
				<div class="body">
					<div class="display">
						<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
							<thead>
								<tr>
									<th><?php echo lang('index_groups_th');?></th>
									<th><?php echo lang('index_status_th');?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($groups as $group):?>
									<tr>
										<td><?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8');?></td>
										<td><?php echo htmlspecialchars($group->description,ENT_QUOTES,'UTF-8');?></td>
										<td>
											<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars('EDIT',ENT_QUOTES,'UTF-8')) ;?><br />
										</td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col align-right" style="margin-bottom:15px;">
					<div class="btn-group">
					<a href="create_group" class="btn btn-primary btn-xl" type="button"><?php echo lang('index_create_group_link');?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.content -->
</section>
<!-- /.content-wrapper -->
