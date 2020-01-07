<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Daftar Gedung Hasil Pemeriksaan</title>
    <!-- Favicon-->
    <link rel="shortcut icon" type="ico" size="36x36" href="<?php echo base_url(); ?>assets/icon/damkar.ico">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url(); ?>assets/my_style/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/my_style/css/list_gdg_rekap.css" rel="stylesheet">

    <!-- Bootstrap Select -->
    <?php if ($attributeFooter['bootstrapSelect']){
        echo '<link href="'.base_url().'assets/vendor_new/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">';
    } ?>

    <!-- Bootstrap Material Datetime Picker Css -->
    <?php if ($attributeFooter['datetimePicker']){
        echo '<link href="'.base_url().'assets/vendor_new/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">';
        echo '<link href="'.base_url().'assets/vendor_new/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet">';
    } ?>

    <!-- jquery datatable Css -->
    <?php if ($attributeFooter['dataTable']){
        echo '<link href="'.base_url().'assets/vendor_new/jquery-datatable/skin/bootstrap/css/jquery.dataTables.min.css" rel="stylesheet">';
        echo '<link href="'.base_url().'assets/vendor_new/jquery-datatable/skin/bootstrap/css/responsive.dataTables.min.css" rel="stylesheet">';
        echo '<link href="'.base_url().'assets/vendor_new/jquery-datatable/skin/bootstrap/css/buttons.dataTables.min.css" rel="stylesheet">';
    } ?>

    <!-- set global variable-->
    <script>var base_url = '<?php echo base_url() ?>';</script>
</head>

    <body>
        <div class="container">
            <div class="jumbotron p-4 p-md-5 text-white rounded" style="background-color:blue;">
                <div class="col-md-12">
                    <h1 style="text-align: center;">Dinas Penanggulangan Kebakaran dan Penyelamatan</h1>
                    <h1 style="text-align: center;">Provinsi DKI Jakarta</h1>
                </div>
            </div>
            <div class="col-md-12">
                <h2 style="text-align: center;">Daftar Gedung Hasil Pemeriksaan Sistem Keselamatan Kebakaran</h2>
            </div>
            <?php //print_r($pdfFile[$key]['array']); ?>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <?php
                    $thead = array('No', 'Nomor Gedung', 'Nama Gedung', 'Alamat', 'Wilayah','Kecamatan','Kelurahan','Fungsi','Kepemilikan','Status');
                    $dhead = array('no_gedung','nama_gedung','alamat_gedung','wilayah','kecamatan','kelurahan','fungsi_gedung','kepemilikkan_gedung','nama_kolom_statusGedung');
                    echo '<p>Kepemilikan : '.$pdfFile[$key]['kepemilikkan'].'</p>';
                    echo '<p>Status : '.$pdfFile[$key]['status'].'</p>';
                    echo '<p>Tanggal : '.$tgl.'</p>';
                        echo '
                    <div class="display" >
                        <table class="table table-bordered table-striped table-hover table-condensed dataTable dataTable-rekap" >
                            <thead>
                                <tr>
                                    ';
                                    foreach($thead as $row)
                                            {
                                                echo '<th>'.$row.'</th>';
                                            }
                        echo '
                                </tr>
                            </thead>
                            <tbody>
                        ';
                                $count = 1;
                                $i = 0;
                                foreach($pdfFile[$key]['array'] as $row)
                                {
                                    echo '<tr>';
                                        echo '<td>'.$count.'</td>';
                                        foreach($dhead as $cell)
                                        {
                                            echo '<td>'.$row[$cell].'</td>';
                                        }
                                        //echo '<td><span class="text-white bg-dark">'.$row[$dhead[0]].'</span></td>';
                                        $count++;
                                    echo '</tr>';
                                }
                        echo '
                            </tbody>
                        </table>
                    </div>
                        ';
                    ?>
                </div>
            </div>
        </div>
<footer class="blog-footer">
  <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
  <p>
    <a href="#">Back to top</a>
  </p>
</footer>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url(); ?>assets/vendor_new/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url(); ?>assets/my_style/js/bootstrap.min.js"></script>



    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/vendor_new/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/vendor_new/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <?php if ($attributeFooter['dataTable']){
        echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/jquery.dataTables.min.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/dataTables.responsive.min.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/jszip.min.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/pdfmake.min.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/vfs_fonts.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/buttons.html5.min.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/buttons.print.min.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/tables/jquery-datatable.js"></script>';
    } ?>

    <?php if ($attributeFooter['jspdf']){
        echo '<script src="'.base_url().'assets/vendor_new/jspdf/jspdf.min.js"></script>';
    } ?>

    <!-- SweetAlert Plugin Js -->
    <script src="<?php echo base_url(); ?>assets/vendor_new/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/admin.js"></script>

    <!-- Chart Plugins Js -->
    <!-- Chart Js content -->
    <?php if ($attributeFooter['chartJS']){
        echo '<script src="'.base_url().'assets/vendor_new/chartjs/Chart.bundle.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/charts/chartjs.js"></script>';
    } ?>

    <!-- Jquery Validation -->
    <?php if ($attributeFooter['JqueryValidation']){
        echo '<script src="'.base_url().'assets/vendor_new/jquery-validation/jquery.validate.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/forms/form-validation.js"></script>';
    } ?>


    <!-- autosize, moment, Bootstrap Material Datetime Picker -->
    <?php if ($attributeFooter['datetimePicker']){
        echo '<script src="'.base_url().'assets/vendor_new/autosize/autosize.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/momentjs/moment.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/forms/basic-form-elements.js"></script>';
    } ?>

    <!-- cke editor basic -->
    <?php if ($attributeFooter['ckeEditorBasic']){
        echo '<script src="'.base_url().'assets/vendor_new/ckeditor-basic/ckeditor.js"></script>';
        echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/forms/editors.js"></script>';
    } ?>

    <!-- bootstrap select -->
    <?php if ($attributeFooter['bootstrapSelect']){
        echo '<script src="'.base_url().'assets/vendor_new/bootstrap-select/js/bootstrap-select.js"></script>';
        //echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/forms/form-validation.js"></script>';
    } ?>


    <script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/pages/ui/dialogs.js"></script>

    <!-- tooltips -->
    <script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/pages/ui/tooltips-popovers.js"></script>

    <!-- kecamatan kelurahan kodepos select -->
    <?php if ($attributeFooter['kecamatanKelurahan']){
        echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/script.js"></script>';
        //echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/forms/form-validation.js"></script>';
    } ?>

    <?php 
        echo '<script src="'.base_url().'assets/vendor/animsition/animsition.min.js"></script>';
    ?>

    <!-- Demo Js -->
    <script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/demo.js"></script>
    </body>
</html>
