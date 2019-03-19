<!-- Main Footer -->
<footer class="main-footer">
	<!-- To the right -->
	<div class="pull-right hidden-xs">
		<span> made with <i class="fa fa-heart"></i> </span>
	</div>
	<!-- Default to the left -->
	<strong>Copyright &copy; 2016 <a href="#">Dinas Penanggulangan Kebakaran dan Penyelamatan Provinsi DKI Jakarta</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Create the tabs -->
	<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		<li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
		<li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
	</ul>
	<!-- Tab panes -->
	<div class="tab-content">
		<!-- Home tab content -->
		<div class="tab-pane active" id="control-sidebar-home-tab">
			<h3 class="control-sidebar-heading">Recent Activity</h3>
			<ul class="control-sidebar-menu">
				<li>
					<a href="javascript:;">
						<i class="menu-icon fa fa-birthday-cake bg-red"></i>

						<div class="menu-info">
							<h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

							<p>Will be 23 on April 24th</p>
						</div>
					</a>
				</li>
			</ul>
			<!-- /.control-sidebar-menu -->

			<h3 class="control-sidebar-heading">Tasks Progress</h3>
			<ul class="control-sidebar-menu">
				<li>
					<a href="javascript:;">
						<h4 class="control-sidebar-subheading">
							Custom Template Design
							<span class="pull-right-container">
								<span class="label label-danger pull-right">70%</span>
							</span>
						</h4>

						<div class="progress progress-xxs">
							<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
						</div>
					</a>
				</li>
			</ul>
			<!-- /.control-sidebar-menu -->

		</div>
		<!-- /.tab-pane -->
		<!-- Stats tab content -->
		<div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
		<!-- /.tab-pane -->
		<!-- Settings tab content -->
		<div class="tab-pane" id="control-sidebar-settings-tab">
			<form method="post">
				<h3 class="control-sidebar-heading">General Settings</h3>

				<div class="form-group">
					<label class="control-sidebar-subheading">
						Report panel usage
						<input type="checkbox" class="pull-right" checked>
					</label>

					<p>
						Some information about this general settings option
					</p>
				</div>
				<!-- /.form-group -->
			</form>
		</div>
		<!-- /.tab-pane -->
	</div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- slimScroll -->
<script src="<?php echo base_url(); ?>assets/vendor/slimScroll/jquery.slimscroll.min.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url(); ?>assets/vendor/datepicker/bootstrap-datepicker.js"></script>
<!-- animsition -->
<script src="<?php echo base_url(); ?>assets/vendor/animsition/animsition.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url(); ?>assets/vendor/iCheck/icheck.min.js"></script>
<!-- jquery datatable -->
<script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/vendor/admin_lte/js/app.min.js"></script>
<!-- bootstrap confirmation -->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap-confirmation/bootstrap-confirmation.min.js"></script>
<!-- jquery validator -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery-validator/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/jquery-validator/jquery-validate.bootstrap-tooltip.min.js"></script>
<!-- slide_top thumbnail -->
<script src="<?php echo base_url(); ?>assets/my_style/js/slide_top.js"></script>
<!-- jquery confirm -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery_confirm/jquery-confirm.min.js"></script>

<!-- for tutorial-->
<?php if ($this->uri->segment(2)=='tutorial'){
	echo '<script src="'.base_url().'/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
				<script src="'.base_url().'/assets/vendor/jquery-lightbox/js/lightbox.min.js"></script>
				<script src="'.base_url().'/assets/tutorial/js/tutorial.js"></script>';
}else{
	echo '<script src="'.base_url().'/assets/my_style/js/my_script.js"></script>';
}
//var_dump($this->session->userdata());
?>
</body>
</html>
