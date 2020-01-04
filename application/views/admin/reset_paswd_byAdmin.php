<section class="content">
	<div class="row clearfix">
		<div class="col-md-6 col-md-offset-3 col-xs-12">
			<div class="card">
				<div class="header">
					<h1>
						Reset Password
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
						<li class="active">Here</li>
					</ol>
				</div>
				<div class="body">
					<p><?php echo 'Reset Password : '.$user->username.'';?></p>

					<?php echo form_open("auth/myResetPassword/".$user->id);?>

					<div class="demo-radio-button">
						
						<input type="radio" name="confirm" id="radio_1" value="yes" class="radio-col-green" />
						<label for="radio_1"><?php echo lang('deactivate_confirm_y_label', 'confirm');?></label>
						
						<input type="radio" name="confirm" id="radio_2" value="no" checked="checked" class="radio-col-red" checked/>
						<label for="radio_2"><?php echo lang('deactivate_confirm_n_label', 'confirm');?></label>
					</div>

					<?php echo form_hidden($csrf); ?>
					<?php echo form_hidden(array('id'=>$user->id)); ?>

					<p><?php echo form_submit('submit', lang('deactivate_submit_btn'));?></p>

					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</section>


