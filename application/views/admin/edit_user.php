<section class="content">
	<div class="row clearfix">
		<div class="col-md-6 col-md-offset-3 col-xs-12">
			<div class="card">
				<div class="header">
					<h1>
						<?php echo lang('edit_user_heading');?>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
						<li class="active">Here</li>
					</ol>
				</div>
				<div class="body">
					<p><?php echo lang('edit_user_subheading');?></p>

					<div id="infoMessage"><?php echo $message;?></div>


					<?php	$attributes = array('id' => 'form_validation form-horizontal');
					 		echo form_open(uri_string(), $attributes);?>

					<?php 
					//print_r($first_name);
					$lang1 = array ('edit_user_fname_label','edit_user_lname_label','edit_user_phone_label','edit_user_email_label','edit_user_password_label','edit_user_password_confirm_label');
					$lang2 = array ('first_name','last_name','phone','email','password','password_confirm');
					$id = array($first_name, $last_name, $phone, $email, $password, $password_confirm);
					$i = 0;
					foreach($lang1 as $row)
					{
						echo '
						<div class="row clearfix">
							<div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
								<label for="'.$id[$i]['id'].'">'.lang($row, $lang2[$i]).'</label>
							</div>
							<div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
								<div class="form-group">
									<div class="form-line">';
						if($i <= 3)
						{
							echo '<input type="text" id="'.$id[$i]['id'].'" name="'.$id[$i]['name'].'" value="'.$id[$i]['value'].'" class="form-control" >';
						}else
						{
							echo '<input type="text" id="'.$id[$i]['id'].'" name="'.$id[$i]['name'].'" class="form-control" >';
						}
						echo '	
									</div>
								</div>
							</div>
						</div>
						';
						$i++;
					}
					?>


					<?php if ($this->ion_auth->is_admin()): ?>
						<?php echo '<div class="demo-checkbox">'; ?>
							<h3><?php echo lang('edit_user_groups_heading');?></h3>
							<?php foreach ($groups as $group):?>
								<?php
								$gID=$group['id'];
								$checked = null;
								$item = null;
								foreach($currentGroups as $grp) {
									if ($gID == $grp->id) {
										$checked= ' checked="checked"';
										break;
									}
								}
								echo '
								<input type="checkbox" name="groups[]" id="'.$gID.'" class="filled-in chk-col-blue" value="'.$group['id'].'" '.$checked.'>
								<label for="'.$gID.'">'; ?> <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
								</label>
							<?php endforeach?>
						<?php echo '</div>'; ?>
					<?php endif ?>

					<?php echo form_hidden('id', $user->id);?>
					<?php echo form_hidden($csrf); ?>
					<div class="col align-right" style="margin-bottom:15px;">
						<div class="btn-group">
							<button class="btn btn-warning btn-xl" type="submit"><?php echo lang('edit_user_submit_btn');?></button>
						</div>
					</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</section>