<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
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

    <!-- Custom Css -->
    <?php 
        echo '<link href="'.base_url().'assets/vendor_new/adminBSB/css/style.css" rel="stylesheet">';
    ?>
</head>


 
<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>b</b>-STATUS</a>
            <small>Dinas Penanggulangan Kebakaran dan Penyelamatan</small>
        </div>
        <div class="card">
            <div class="body">
            <?php
                $attributes = array('id' => 'sign_in');
                echo form_open('auth/login', $attributes); 
            ?>
                
                    <div class="msg">Login to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="identity" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" id="remember" name="remember" class="filled-in chk-col-pink">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">LOGIN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <?php echo $message; ?>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url(); ?>assets/vendor_new/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url(); ?>assets/vendor_new/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/vendor_new/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <?php
    echo '<script src="'.base_url().'assets/vendor_new/jquery-validation/jquery.validate.js"></script>';
    ?>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/admin.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/pages/examples/sign-in.js"></script>
</body>

</html>