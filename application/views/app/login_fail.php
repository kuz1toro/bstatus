<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/login.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="wrapper">

      <?php
      $attributes = array('class' => 'form-signin');
      echo form_open('login/validate', $attributes);
      echo  '<h2 class="form-signin-heading">Silahkan login</h2>';
      echo  '<input type="text" class="form-control" name="user_name" placeholder="User name" required="" autofocus="" />';
      echo  '<input type="password" class="form-control" name="password" placeholder="Password" required=""/>';
      echo  '<input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
            <div style="margin-top:20px">';
            echo '<div class="alert alert-error">';
            echo 'salah username atau password';
            echo '</div>';
      echo   '<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>';
      echo  '</div>';

      echo form_close();
      ?>
    </div>


  </body>
  </html>
