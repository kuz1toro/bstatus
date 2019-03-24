<!-- user information -->
<?php $user = $this->ion_auth->user()->row(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>SIBP--Sistem Informasi Bidang Pencegahan</title>
	<link rel="shortcut icon" type="ico" size="36x36" href="<?php echo base_url(); ?>assets/icon/damkar.ico">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
	<!-- datepicker -->
	<link href="<?php echo base_url(); ?>assets/vendor/datepicker/datepicker3.css" rel="stylesheet" type="text/css">
	<!-- datatable -->
	<link href="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/iCheck/flat/green.css">
	<!-- animsition -->
	<link href="<?php echo base_url(); ?>assets/vendor/animsition/animsition.min.css" rel="stylesheet" type="text/css">
	<!-- step, icon semantic-ui -->
	<link href="<?php echo base_url(); ?>assets/vendor/semantic_ui/step.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url(); ?>assets/vendor/semantic_ui/icon.min.css" rel="stylesheet" type="text/css">
	<!-- jquery-confirm -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/jquery_confirm/jquery-confirm.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/admin_lte/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
	page. However, you can choose any other skin. Make sure you
	apply the skin class to the body tag so the changes take effect.
-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/admin_lte/css/skins/skin-blue.min.css">
<!-- Bootstrap theme -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap-theme.min.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!--costume style-->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/my_style/css/my_style.css">

<!-- set global variable-->
<script>var base_url = '<?php echo base_url() ?>';</script>
<script>var search_result = <?php $gedungs; ?>;</script>

<!-- for tutorial-->
<?php if ($this->uri->segment(2)=='tutorial'){
	echo '<link rel="stylesheet" href="'.base_url().'/assets/vendor/jquery-lightbox/css/lightbox.min.css">
	<link rel="stylesheet" href="'.base_url().'/assets/tutorial/css/blog.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:500" rel="stylesheet">';
} ?>
</head>


<body class="hold-transition skin-blue sidebar-collapse fixed sidebar-mini">
	<div class="wrapper animsition">

		<!-- Main Header -->
		<header class="main-header">

			<!-- Logo -->
			<a href="#" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>SIBP</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg" style=""><b>Bidang Pencegahan</b></span>
			</a>

			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>



				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav" >
						<?php /*
						<!-- Messages: style can be found in dropdown.less-->
						<li class="dropdown messages-menu">
						<!-- Menu toggle button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope-o"></i>
						<span class="label label-success">4</span>
						</a>
						<ul class="dropdown-menu">
						<li class="header">You have 4 messages</li>
						<li>
						<!-- inner menu: contains the messages -->
						<ul class="menu">
						<li><!-- start message -->
						<a href="#">
						<div class="pull-left">
						<!-- User Image -->
						<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
						</div>
						<!-- Message title and timestamp -->
						<h4>
						Support Team
						<small><i class="fa fa-clock-o"></i> 5 mins</small>
						</h4>
						<!-- The message -->
						<p>Why not buy a new awesome theme?</p>
						</a>
						</li>
						<!-- end message -->
						</ul>
						<!-- /.menu -->
						</li>
						<li class="footer"><a href="#">See All Messages</a></li>
						</ul>
						</li>
						<!-- /.messages-menu -->

						<!-- Notifications Menu -->
						<li class="dropdown notifications-menu">
						<!-- Menu toggle button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell-o"></i>
						<span class="label label-warning">10</span>
						</a>
						<ul class="dropdown-menu">
						<li class="header">You have 10 notifications</li>
						<li>
						<!-- Inner Menu: contains the notifications -->
						<ul class="menu">
						<li><!-- start notification -->
						<a href="#">
						<i class="fa fa-users text-aqua"></i> 5 new members joined today
						</a>
						</li>
						<!-- end notification -->
						</ul>
						</li>
						<li class="footer"><a href="#">View all</a></li>
						</ul>
						</li>
						<!-- Tasks Menu -->
						<li class="dropdown tasks-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-flag-o"></i>
						<span class="label label-danger">9</span>
						</a>
						<ul class="dropdown-menu">
						<li class="header">You have 9 tasks</li>
						<li>
						<!-- Inner menu: contains the tasks -->
						<ul class="menu">
						<li><!-- Task item -->
						<a href="#">
						<!-- Task title and progress text -->
						<h3>
						Design some buttons
						<small class="pull-right">20%</small>
						</h3>
						<!-- The progress bar -->
						<div class="progress xs">
						<!-- Change the css width attribute to simulate progress -->
						<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
						<span class="sr-only">20% Complete</span>
						</div>
						</div>
						</a>
						</li>
						<!-- end task item -->
						</ul>
						</li>
						<li class="footer">
						<a href="#">View all tasks</a>
						</li>
						</ul>
						</li>
						*/ ?>
						<!-- User Account Menu -->
						<li class="dropdown user user-menu">
							<!-- Menu Toggle Button -->
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<!-- The user image in the navbar-->
								<img src="<?php echo base_url(); ?>assets/vendor/admin_lte/img/damkar.png" class="user-image" alt="User Image">
								<!-- hidden-xs hides the username on small devices so only the image appears. -->
								<span class="hidden-xs"><?php echo ucfirst($user->username); ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- The user image in the menu -->
								<li class="user-header">
									<img src="<?php echo base_url(); ?>assets/vendor/admin_lte/img/damkar.png" class="img-circle" alt="User Image">

									<p>
										<?php echo ucfirst($user->username); ?>
										<small>Member since Maret 2017</small>
									</p>
								</li>
								<!-- Menu Body -->
								<li class="user-body">
									<!--<div class="row">
									<div class="col-xs-4 text-center">
									<a href="#">Followers</a>
								</div>
								<div class="col-xs-4 text-center">
								<a href="#">Sales</a>
							</div>
							<div class="col-xs-4 text-center">
							<a href="#">Friends</a>
						</div>
					</div>-->
					<!-- /.row -->
				</li>
				<!-- Menu Footer-->
				<li class="user-footer">
					<div class="pull-left">
						<a href="#" class="btn btn-default btn-flat">Profile</a>
					</div>
					<div class="pull-right">
						<a href="<?php echo site_url("auth/logout")?>" class="btn btn-default btn-flat">Sign out</a>
					</div>
				</li>
			</ul>
		</li>
		<!-- Control Sidebar Toggle Button -->
		<!--<li>
		<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
	</li>-->
</ul>
</div>
<!-- judul halaman -->
<?php 	
	$url1=$this->uri->segment(1);
	$url2=$this->uri->segment(2); 
?>
<div style="font-size:20px; text-align: center; color: white; padding-top: 7px">
	<p><?php jdl_hal($url1,$url2); ?></p>
</div>
</nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">

		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo base_url(); ?>assets/vendor/admin_lte/img/damkar.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $user->username; ?></p>
				<!-- Status -->
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<!-- search form (Optional) -->
		<form action="<?php echo base_url(); ?>prainspeksi_permohonan/search" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="search_string" class="form-control" placeholder="Search...">
				<span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		<!-- /.search form -->

		<!-- Sidebar Menu -->
		<ul class="sidebar-menu">
			<li class="header">HEADER</li>
			<!-- Optionally, you can add icons to the links -->
			<li class="<?php trv_state('home', $url1, $url2);?>"><a href="<?php echo site_url("auth/index")?>"><i class="fa fa-home"></i> <span>home</span></a></li>
			<li class="treeview <?php trv_state('gedung', $url1, $url2);?>">
				<a href="#"><i class="fa fa-building"></i> <span>Gedung</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo site_url("prainspeksi_gedung/index")?>">Lihat/ edit</a></li>
					<li><a href="<?php echo site_url("prainspeksi_gedung/add")?>">Tambah Gedung</a></li>
				</ul>
			</li>
			<li class="treeview <?php trv_state('permohonan', $url1, $url2);?>">
				<a href="#"><i class="fa fa-tasks"></i> <span>Permohonan</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="<?php echo site_url("prainspeksi_permohonan/index")?>">Lihat/ edit</a></li>
					<li><a href="<?php echo site_url("prainspeksi_permohonan/Add_step1")?>">Tambah Permohonan</a></li>
				</ul>
			</li>
			<li class="<?php trv_state('tutorial', $url1, $url2);?>"><a href="<?php echo site_url("prainspeksi_gedung/tutorial")?>"><i class="fa fa-question-circle"></i> <span>panduan</span></a></li>
			<li class="treeview">
				<a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#">Link in level 2</a></li>
					<li><a href="#">Link in level 2</a></li>
				</ul>
			</li>
		</ul>
		<!-- /.sidebar-menu -->
	</section>
	<!-- /.sidebar -->
</aside>
