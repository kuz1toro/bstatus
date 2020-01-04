<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- user information -->
<?php $user = $this->ion_auth->user()->row(); ?>
<?php 
        $url1=$this->uri->segment(1);
        $url2=$this->uri->segment(2); 
        //echo trv_state($page, $url1, $url2);
        $attributeFooter = array(
			'chartJS' => FALSE,
			'dataTable' => TRUE,
			'JqueryValidation' => FALSE,
			'bootstrapSelect' => TRUE,
			'datetimePicker' => FALSE,
			'kecamatanKelurahan' => FALSE,
			'ckeEditorBasic' => FALSE,
			'jspdf' => FALSE
		);
      ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>B-Status Dinas Penanggulangan Kebakaran dan Penyelamatan DKI Jakarta</title>
    <!-- Favicon-->
    <link rel="shortcut icon" type="ico" size="36x36" href="<?php echo base_url(); ?>assets/icon/damkar.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>assets/vendor_new/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url(); ?>assets/vendor_new/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url(); ?>assets/vendor_new/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="<?php echo base_url(); ?>assets/vendor_new/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Bootstrap Select -->
    <?php if (isset($attributeFooter) && $attributeFooter['bootstrapSelect']){
        echo '<link href="'.base_url().'assets/vendor_new/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">';
    } ?>

    <!-- Bootstrap Material Datetime Picker Css -->
    <?php if (isset($attributeFooter) && $attributeFooter['datetimePicker']){
        echo '<link href="'.base_url().'assets/vendor_new/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">';
        echo '<link href="'.base_url().'assets/vendor_new/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">';
    } ?>

    <!-- jquery datatable Css -->
    <?php if ($attributeFooter['dataTable']){
         echo '<link href="'.base_url().'assets/vendor_new/jquery-datatable/skin/bootstrap/css/jquery.dataTables.min.css" rel="stylesheet">';
         echo '<link href="'.base_url().'assets/vendor_new/jquery-datatable/skin/bootstrap/css/responsive.dataTables.min.css" rel="stylesheet">';
         echo '<link href="'.base_url().'assets/vendor_new/jquery-datatable/skin/bootstrap/css/buttons.dataTables.min.css" rel="stylesheet">';
    } ?>

    <!-- Custom Css -->
    <?php 
        echo '<link href="'.base_url().'assets/vendor_new/adminBSB/css/style.css" rel="stylesheet">';
    ?>
    <?php 
        echo '<link href="'.base_url().'assets/vendor/animsition/animsition.min.css" rel="stylesheet">';
    ?>

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url(); ?>assets/vendor_new/adminBSB/css/themes/theme-black.min.css" rel="stylesheet" />

    

    <!-- set global variable-->
    <script>var base_url = '<?php echo base_url() ?>';</script>
</head>

<body class="theme-black " style="background-image: linear-gradient(to left, #BDBBBE 0%, #9D9EA3 100%), radial-gradient(88% 271%, rgba(255, 255, 255, 0.25) 0%, rgba(254, 254, 254, 0.25) 1%, rgba(0, 0, 0, 0.25) 100%), radial-gradient(50% 100%, rgba(255, 255, 255, 0.30) 0%, rgba(0, 0, 0, 0.30) 100%);
 background-blend-mode: normal, lighten, soft-light;">
    <!-- Page Loader 
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Tunggu Bentar Ndan...</p>
        </div>
    </div> -->
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar 
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div> -->
    <!-- #END# Search Bar -->
    <!-- Top Bar 
    perlu ditambahkan tooltip dan konfirmasi
    -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand">B-STATUS | Sistem Informasi Status Keselamatan Kebakaran Bangunan Gedung di DKI Jakarta</a>
            </div> 
            <div class=" collapse navbar-collapse navbar-nav navbar-right js-sweetalert" id="navbar-collapse"  style="padding: 10px 7px">
                <button type="button" class="btn bg-blue btn-circle-lg waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="logout" data-type="confirm_logout">
                    <i class="material-icons">logout</i>
                </button>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image col-xs-2">
                    <?php $user = $this->ion_auth->user()->row(); ?>
                    <img src="<?php echo base_url().'upload/'.$user->avatar; ?>" width="52" height="52" alt="User" />    
                </div>
                <div class="image-k col-xs-2">
                    <img src="<?php echo base_url(); ?>assets/icon/inspektur.ico" width="55" height="48" alt="User" />    
                </div>
                <div class="image col-xs-2">
                    <img src="<?php echo base_url(); ?>upload/damkar.png" width="52" height="52" alt="User" />    
                </div>
                <div class="info-container col-xs-12">
                    <?php //$user = $this->ion_auth->user()->row();?>
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo "{$user->first_name} {$user->last_name}" ;?></div>
                    <div class="email"><?php echo $user->email;?></div>
                </div>
            </div>
            <!-- #User Info --> 
            <!-- Menu -->
            <?php 	
	            $url1=$this->uri->segment(1);
                $url2=$this->uri->segment(2); 
            ?>
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="<?php trv_state('admin', $url1, $url2);?>">
                        <a href="<?php echo base_url(); ?>auth/index">
                            <i class="material-icons">person</i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="<?php trv_state('group', $url1, $url2);?>">
                        <a href="<?php echo base_url(); ?>auth/show_groups">
                            <i class="material-icons">group</i>
                            <span>Groups</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 
                </div>
                <a href="javascript:void(0);">Dinas Penanggulangan Kebakaran dan Penyelamatan Provinsi DKI Jakarta</a>
                <div class="version">
                    <b>Version: </b> 1.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

