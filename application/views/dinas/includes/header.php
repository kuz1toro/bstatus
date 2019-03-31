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
    <?php if ($attributeFooter['bootstrapSelect']){
        echo '<link href="'.base_url().'assets/vendor_new/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">';
    } ?>

    <!-- Custom Css -->
    <link href="<?php echo base_url(); ?>assets/vendor_new/adminBSB/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url(); ?>assets/vendor_new/adminBSB/css/themes/theme-red.min.css" rel="stylesheet" />

    <!-- set global variable-->
    <script>var base_url = '<?php echo base_url() ?>';</script>
</head>

<body class="theme-red" style="background-image: linear-gradient(to left, #BDBBBE 0%, #9D9EA3 100%), radial-gradient(88% 271%, rgba(255, 255, 255, 0.25) 0%, rgba(254, 254, 254, 0.25) 1%, rgba(0, 0, 0, 0.25) 100%), radial-gradient(50% 100%, rgba(255, 255, 255, 0.30) 0%, rgba(0, 0, 0, 0.30) 100%);
 background-blend-mode: normal, lighten, soft-light;">
    <!-- Page Loader -->
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
            <p>Tunggu Bentar Coy...</p>
        </div>
    </div>
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
            <div class=" collapse navbar-collapse navbar-nav navbar-right js-sweetalert" id="navbar-collapse"  style="padding: 5px 7px">
                <button type="button" class="btn bg-red btn-circle-lg waves-effect waves-circle waves-float" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="logout" data-type="confirm_logout">
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
                    <img src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/img/damkar.png" width="48" height="48" alt="User" />    
                </div>
                <div class="col-xs-2">
                    <img src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/img/logo_inspektur.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container col-xs-12">
                    <?php $user = $this->ion_auth->user()->row();?>
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
                    <li class="<?php trv_state('home', $url1, $url2);?>">
                        <a href="<?php echo base_url(); ?>dinas/home">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="../../pages/typography.html">
                            <i class="material-icons">text_fields</i>
                            <span>Typography</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Widgets</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Cards</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="../../pages/widgets/cards/basic.html">Basic</a>
                                    </li>
                                    <li>
                                        <a href="../../pages/widgets/cards/colored.html">Colored</a>
                                    </li>
                                    <li>
                                        <a href="../../pages/widgets/cards/no-header.html">No Header</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Infobox</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="../../pages/widgets/infobox/infobox-1.html">Infobox-1</a>
                                    </li>
                                    <li>
                                        <a href="../../pages/widgets/infobox/infobox-2.html">Infobox-2</a>
                                    </li>
                                    <li>
                                        <a href="../../pages/widgets/infobox/infobox-3.html">Infobox-3</a>
                                    </li>
                                    <li>
                                        <a href="../../pages/widgets/infobox/infobox-4.html">Infobox-4</a>
                                    </li>
                                    <li>
                                        <a href="../../pages/widgets/infobox/infobox-5.html">Infobox-5</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php trv_state('setting', $url1, $url2);?>">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">settings_input_component</i>
                            <span>Setting Input</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="<?php trv_state('jalurInfo', $url1, $url2);?>">
                                <a href="<?php echo base_url(); ?>dinas/list_jalurInfo" class="waves-effect waves-block">
                                    <span>Jalur Informasi</span>
                                </a>
                            </li>
                            <li class="<?php trv_state('hslPemeriksaan', $url1, $url2);?>">
                                <a href="<?php echo base_url(); ?>dinas/list_hslPemeriksaan" class="waves-effect waves-block">
                                    <span>Hasil Pemeriksaan</span>
                                </a>
                            </li>
                            <li class="<?php trv_state('statusGedung', $url1, $url2);?>">
                                <a href="<?php echo base_url(); ?>dinas/list_statusGedung" class="waves-effect waves-block">
                                    <span>Status Gedung</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>dinas/database_operation">
                            <i class="material-icons">text_fields</i>
                            <span>Database</span>
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