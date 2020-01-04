<section class="content">
	<div class="row clearfix">
		<div class="col-md-6 col-md-offset-3 col-xs-12">
			<div class="card">
				<div class="header">
					<h1><?php echo lang('edit_group_heading');?></h1>
				</div>
				<div class="body">
					<p><?php echo lang('edit_group_subheading');?></p>

					<div id="infoMessage"><?php echo $message;?></div>

					<?php echo form_open(current_url());?>
		
					<p>
						<?php echo lang('edit_group_name_label', 'group_name');?> <br />
						<?php echo form_input($group_name);?>
					</p>

					<p>
						<?php echo lang('edit_group_desc_label', 'group_description');?> <br />
						<?php echo form_input($group_description);?>
					</p>

					<p><?php echo form_submit('submit', lang('edit_group_submit_btn'));?></p>

					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</section>
