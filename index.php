<?php 
	include 'setting/include/user_control.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
	title($page);
?>
		<link rel="shortcut icon" href="setting/save/logo/logo.png">
		<!-- Global stylesheets -->
		<link href="assets/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
		<link href="assets/template/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
		<link href="assets/template/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="assets/template/css/core.css" rel="stylesheet" type="text/css">
		<link href="assets/template/css/components.css" rel="stylesheet" type="text/css">
		<link href="assets/template/css/colors.css" rel="stylesheet" type="text/css">
		<!-- /global stylesheets -->
		
		<link rel="stylesheet" href="assets/lindox-style/css/lindox-style.css">
		<?php 
			lib_css($page); 
			if($page == "detail-kelompok"){
		?>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCByPaM4A3Pv79bTxT6u6HCzLk2KuZ19WU&callback=initMap"></script>
		<?php }elseif($page == "galeri"){ ?>
			<link href="assets/baguetteBox/css/baguetteBox.min.css" rel="stylesheet" type="text/css">
			<link href="assets/baguetteBox/css/gallery-clean.css" rel="stylesheet" type="text/css">
		<?php } ?>
		<style>	
			.line-through {
				 text-decoration: line-through;
			}
			.table-nobor-monev > thead > tr > th,
			.table-nobor-monev > tbody > tr > th,
			.table-nobor-monev > tfoot > tr > th,
			.table-nobor-monev > thead > tr > td,
			.table-nobor-monev > tbody > tr > td,
			.table-nobor-monev > tfoot > tr > td {
			  padding: 5px;
			  vertical-align: middle;
			  border-top: 0px solid #ddd;
			  font-size:12px;
			  border:0px;
			}
			.table-nobor-monev > thead > tr > th,
			.table-nobor-monev > tbody > tr > th,
			.table-nobor-monev > tfoot > tr > th{
				font-weight:550;
			}
			.navbar-inverse {
				box-shadow: 0 0px 5px 0 rgba(0, 0, 0, 0.15), 2px 2px 2px 2px rgba(0, 0, 0, 0.12);
			}
		</style>
</head>
<style>

</style>
<body class="layout-boxed" style="background-color:#fff;">
	<?php 
		include 'setting/include/user_firstnavbar.php';
		
		pagetitle($page);
	?>
	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">
				<?php 
					include 'setting/include/user_set_pages.php';
				?>
				<!--<div class="login-form">
					<center style="font-size:12px; margin-top:10px;">
						<?php 
							//include 'setting/include/message.php';
						?>
					</center>
				</div>-->
			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
		<?php 
			include 'setting/include/footer.php';
			include 'setting/include/modal.php';
			
			if($page == "galeri"){
		
		?>
		<script src="assets/baguetteBox/js/baguetteBox.min.js"></script>
		<script>
			baguetteBox.run('.baguetteBox');
		</script>
		<?php }?>
		<!-- Core JS files -->
		<script type="text/javascript" src="assets/template/js/plugins/loaders/pace.min.js"></script>
		<script type="text/javascript" src="assets/template/js/core/libraries/jquery.min.js"></script>
		<script type="text/javascript" src="assets/template/js/core/libraries/bootstrap.min.js"></script>
		<script type="text/javascript" src="assets/template/js/plugins/loaders/blockui.min.js"></script>
		<script type="text/javascript" src="assets/template/js/plugins/ui/nicescroll.min.js"></script>
		<script type="text/javascript" src="assets/template/js/plugins/ui/drilldown.js"></script>
		<!-- /core JS files -->

		<!-- Theme JS files -->
		<script type="text/javascript" src="assets/template/js/plugins/tables/datatables/datatables.min.js"></script>
		<script type="text/javascript" src="assets/template/js/core/libraries/jquery_ui/interactions.min.js"></script>
		<script type="text/javascript" src="assets/template/js/plugins/forms/selects/select2.min.js"></script>
		<script type="text/javascript" src="assets/template/js/pages/form_select2.js"></script>
			
		<script type="text/javascript" src="assets/template/js/plugins/forms/validation/validate.min.js"></script>
		<script type="text/javascript" src="assets/template/js/plugins/forms/styling/uniform.min.js"></script>
		<script type="text/javascript" src="assets/template/js/core/app.js"></script>
		<script type="text/javascript" src="assets/template/js/pages/login_validation.js"></script>
		
		<script type="text/javascript" src="assets/template/js/pages/datatables_advanced.js"></script>
		<script src="assets/lindox-style/js/lindox-style.js"></script>
		<script src="assets/lindox-style/js/typeahead.min.js"></script>	
		<?php lib_js($page); ?>
</body>
</html>
