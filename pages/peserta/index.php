<?php include '../../setting/include/peserta_control.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
	title($page);
?>
		<link rel="shortcut icon" href="../../setting/save/logo/logo.png">
		<!-- Global stylesheets 
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">-->
		<link href="../../assets/template/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
		<link href="../../assets/template/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="../../assets/template/css/core.css" rel="stylesheet" type="text/css">
		<link href="../../assets/template/css/components.css" rel="stylesheet" type="text/css">
		<link href="../../assets/template/css/colors.css" rel="stylesheet" type="text/css">
		<!-- /global stylesheets -->

		<!-- Fontawesome CSS files -->
		<link href="../../assets/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css">
		<!-- /fontawesome css files -->
		<script type="text/javascript" src="../../assets/template/js/core/libraries/jquery.min.js"></script>
		<!-- LindoX CSS files -->
		<link href="../../assets/lindox-style/css/lindox-style.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../../assets/lindox-style/js/main.js"></script>
		<script type="text/javascript" src="../../assets/lindox-style/js/select.js"></script>

		<!-- lindox css files -->
		
		<link rel="stylesheet" href="../../assets/dist/css/bootstrap-select.css">
		<script src="../../assets/dist/js/bootstrap-select.js" defer></script>
		
		<?php 
			lib_css($page); 
			if($page == "kelompok-peserta" || $page == "absen-peserta" || $page == "dashboard"){
		?>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCByPaM4A3Pv79bTxT6u6HCzLk2KuZ19WU&callback=initMap"></script>
		<?php } ?>
</head>

<body class="layout-boxed">
	<?php
		include '../../setting/include/peserta_firstnavbar.php';
		
		include '../../setting/include/peserta_secondnavbar.php';
		
		breadcrumb($page);
	?>
	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<?php 
					include '../../setting/include/message.php';
					
					include '../../setting/include/peserta_set_pages.php';
				?>

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
	<?php 
		include '../../setting/include/footer.php';
		
		include '../../setting/include/modal.php';
	?>	
	<!-- Core JS files -->
	<script type="text/javascript" src="../../assets/template/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="../../assets/template/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="../../assets/template/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../assets/template/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="../../assets/template/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="../../assets/template/js/plugins/ui/drilldown.js"></script>	
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="../../assets/template/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="../../assets/template/js/plugins/forms/selects/select2.min.js"></script>
		
	<script type="text/javascript" src="../../assets/template/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="../../assets/template/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="../../assets/template/js/core/app.js"></script>
	<script type="text/javascript" src="../../assets/template/js/pages/login_validation.js"></script>
	
	<script type="text/javascript" src="../../assets/template/js/pages/datatables_advanced.js"></script>
	<script src="../../assets/lindox-style/js/lindox-style.js"></script>
	<script src="../../assets/lindox-style/js/typeahead.min.js"></script>
	<?php lib_js($page); ?>	
</body>
</html>
