<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>CodeIgniter Admin Sample Project</title>
    <meta charset="utf-8">
    <link href="<?php echo base_url(); ?>assets/css/admin/global.css" rel="stylesheet" type="text/css">
  </head>
  <body>

<div class="container login">
<?php
$attributes = array('class' => 'form-signin');
$previlage = "prainspeksi";
// $options_previlage = array('prainspeksi' => 'prainspeksi', 'disposisi' => 'disposisi', 'pokja' => 'pokja', 'umum' => 'damkar');
if(validation_errors()){
         echo '<div class="alert alert-error">';
          // echo '<a class="close" data-dismiss="alert">×</a>';
           echo validation_errors();
         echo '</div>';
     }

echo form_open('admin/create_member', $attributes);
echo '<h2 class="form-signin-heading">Create an account</h2>';
echo form_input('first_name', set_value('first_name'), 'placeholder="First name"');
echo form_input('last_name', set_value('last_name'), 'placeholder="Last name"');
echo form_input('email_address', set_value('email_address'), 'placeholder="Email"');
echo '<div class="input-group">
             <select class="form-control" name="previlage" value="'.set_value($previlage).'">
               <option value="prainspeksi">prainspeksi</option>
               <option value="disposisi">disposisi</option>
               <option value="pokja">pokja</option>
               <option value="damkar">umum</option>
             </select>
           </div>';

echo form_input('username', set_value('username'), 'placeholder="Username"');
echo form_password('password', '', 'placeholder="Password"');
echo form_password('password2', '', 'placeholder="Password confirm"');

echo form_submit('submit', 'submit', 'class="btn btn-large btn-primary"');
echo form_close();
?>


</div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
