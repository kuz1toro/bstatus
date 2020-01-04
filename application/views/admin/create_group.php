<section class="content">
	<div class="row clearfix">
		<div class="col-md-6 col-md-offset-3 col-xs-12">
			<div class="card">
				<div class="header">
					<h1>
						<?php echo lang('create_group_heading');?>
						<small></small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
						<li class="active">Here</li>
					</ol>
				</div>
				<div class="body">
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
				</div>
			</div>
		</div>
	</div>
</section>
