<!-- Jquery Core Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/bootstrap/js/bootstrap.js"></script>



<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/node-waves/waves.js"></script>

 <!-- Jquery DataTable Plugin Js -->
 <?php if (isset($attributeFooter) && $attributeFooter['dataTable']){
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

    <?php if (isset($attributeFooter) && $attributeFooter['jspdf']){
        echo '<script src="'.base_url().'assets/vendor_new/jspdf/jspdf.min.js"></script>';
    } ?>

 <!-- SweetAlert Plugin Js -->
 <script src="<?php echo base_url(); ?>assets/vendor_new/sweetalert/sweetalert.min.js"></script>

<!-- Custom Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/admin.js"></script>

<!-- Chart Plugins Js -->
<!-- Chart Js content -->
<?php if (isset($attributeFooter) && $attributeFooter['chartJS']){
    echo '<script src="'.base_url().'assets/vendor_new/chartjs/Chart.bundle.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/charts/chartjs.js"></script>';
} ?>

<!-- Jquery Validation -->
<?php if (isset($attributeFooter) && $attributeFooter['JqueryValidation']){
    echo '<script src="'.base_url().'assets/vendor_new/jquery-validation/jquery.validate.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/forms/form-validation.js"></script>';
} ?>


<!-- autosize, moment, Bootstrap Material Datetime Picker -->
<?php if (isset($attributeFooter) && $attributeFooter['datetimePicker']){
    echo '<script src="'.base_url().'assets/vendor_new/autosize/autosize.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/momentjs/moment.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/forms/basic-form-elements.js"></script>';
} ?>

<!-- cke editor basic -->
<?php if (isset($attributeFooter) && $attributeFooter['ckeEditorBasic']){
    echo '<script src="'.base_url().'assets/vendor_new/ckeditor-basic/ckeditor.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/forms/editors.js"></script>';
} ?>

<!-- highcharts -->
<?php if (isset($attributeFooter) && $attributeFooter['highcharts']){
    echo "<script> var dataChart = '".$dataPemeriksaan."' </script>";
    echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/charts/highcharts.js"></script>';
} ?>

<!-- bootstrap select -->
<?php if (isset($attributeFooter) && $attributeFooter['bootstrapSelect']){
    echo '<script src="'.base_url().'assets/vendor_new/bootstrap-select/js/bootstrap-select.js"></script>';
    //echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/forms/form-validation.js"></script>';
} ?>

<script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/pages/ui/dialogs.js"></script>

 <!-- tooltips -->
<script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/pages/ui/tooltips-popovers.js"></script>

<!-- kecamatan kelurahan kodepos select -->
<?php if (isset($attributeFooter) && $attributeFooter['kecamatanKelurahan']){
    echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/script.js"></script>';
    //echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/forms/form-validation.js"></script>';
} ?>

<?php 
    //echo '<script src="'.base_url().'assets/vendor/animsition/animsition.min.js"></script>';
?>

<!-- Demo Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/demo.js"></script>
</body>

</html>