<!-- Jquery Core Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/jquery/jquery.min.js"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/bootstrap/js/bootstrap.js"></script>

<!-- Select Plugin Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/bootstrap-select/js/bootstrap-select.js"></script>

<!-- Slimscroll Plugin Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/node-waves/waves.js"></script>

<!-- Jquery DataTable Plugin Js -->
<?php if ($attributeFooter['dataTable']){
    echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/jquery.dataTables.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/buttons.flash.min.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/jszip.min.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/pdfmake.min.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/vfs_fonts.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/buttons.html5.min.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/jquery-datatable/extensions/export/buttons.print.min.js"></script>';
    echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/tables/jquery-datatable.js"></script>';
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

<!-- bootstrap select -->
<?php if ($attributeFooter['bootstrapSelect']){
    echo '<script src="'.base_url().'assets/vendor_new/bootstrap-select/js/bootstrap-select.js"></script>';
    //echo '<script src="'.base_url().'assets/vendor_new/adminBSB/js/pages/forms/form-validation.js"></script>';
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

<script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/pages/ui/dialogs.js"></script>

 <!-- tooltips -->
<script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/pages/ui/tooltips-popovers.js"></script>

<!-- Demo Js -->
<script src="<?php echo base_url(); ?>assets/vendor_new/adminBSB/js/demo.js"></script>
</body>

</html>