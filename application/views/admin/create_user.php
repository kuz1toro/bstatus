<section class="content">
	<div class="row clearfix">
		<div class="col-md-6 col-md-offset-3 col-xs-12">
			<div class="card">
				<div class="header">
					<h1>
					<p><?php echo lang('create_user_heading');?></p>
				</div>
				<div class="body">
					<p><?php echo lang('edit_user_subheading');?></p>

					<div id="infoMessage"><?php echo $message;?></div>


					<?php	$attributes = array('id' => 'form_validation form-horizontal');
					 		echo form_open('auth/create_user', $attributes);?>

					<?php 
					//print_r($first_name);
					$lang1 = array ('create_user_identity_label','create_user_fname_label','create_user_lname_label','create_user_email_label','create_user_phone_label','create_user_password_label','create_user_password_confirm_label');
					$lang2 = array ('identity','first_name','last_name','email','phone','password','password_confirm');
					$id = array($identity, $first_name, $last_name, $email, $phone, $password, $password_confirm);
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
							echo '<input type="text" id="'.$id[$i]['id'].'" name="'.$id[$i]['name'].'" class="form-control" >';
						echo '	
									</div>
								</div>
							</div>
						</div>
						';
						$i++;
					}
					?>
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

