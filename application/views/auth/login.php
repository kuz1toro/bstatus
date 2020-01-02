<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | BSTATUS-NG</title>
    <!-- Favicon-->
    <link rel="shortcut icon" type="ico" size="36x36" href="<?php echo base_url(); ?>assets/icon/damkar.ico">
    <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link href="<?php echo base_url(); ?>assets/login/css/bootstrap.min.css" rel="stylesheet">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
    <?php 
        echo '<link href="'.base_url().'assets/login/css/style.css" rel="stylesheet">';
    ?>
     <!-- set js global variable-->
     <script>var base_url = '<?php echo base_url() ?>';</script>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center h-10" style="border: 1px solid">
        <div class = "kuswantoro">
            <h1>Dinas Penanggulangan Kebakaran</h1>
            <h1>dan Penyelamatan</h1>
            <h1>Provinsi DKI Jakarta</h1>
        </div>
    </div>
	<div class="d-flex justify-content-center h-100" style="border: 1px solid">
       
		<div class="card" style="border: 1px solid">
			<div class="card-header" >
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
                <?php
                    $attributes = array('id' => 'sign_in');
                    echo form_open('auth/login', $attributes); 
                ?>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="identity" placeholder="username" required autofocus>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="password" placeholder="password" required>
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox" name="remember">Remember Me
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
                    <?php echo form_close(); ?>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="#">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<?php echo $message; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Jquery Core Js -->
<script src="<?php echo base_url(); ?>assets/login/js/jquery-3.4.1.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url(); ?>assets/login/js/bootstrap.min.js"></script>

<!-- Validation Plugin Js -->
<?php
    echo '<script src="'.base_url().'assets/vendor_new/jquery-validation/jquery.validate.js"></script>';
    ?>
<!--costum Js -->
<script src="<?php echo base_url(); ?>assets/login/js/sign-in.js"></script>
</body>
</html>

