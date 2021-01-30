<?php include '../../setting/include/dpl_control.php'; ?>
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
			if($page == "detail-kelompok-dpl" || $page == "absen-dpl"){
		?>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCByPaM4A3Pv79bTxT6u6HCzLk2KuZ19WU&callback=initMap"></script>
		<?php 
			}elseif($page == "dashboard"){ 
		?>
			 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCByPaM4A3Pv79bTxT6u6HCzLk2KuZ19WU&callback=initMap"></script>
			<script>
				var marker;
				  function initialize() {
					// Variabel untuk menyimpan informasi (desc)
					var infoWindow = new google.maps.InfoWindow;
					//  Variabel untuk menyimpan peta Roadmap
					var mapOptions = {
					  mapTypeId: google.maps.MapTypeId.ROADMAP
					} 
					// Pembuatan petanya
					var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
					// Variabel untuk menyimpan batas kordinat
					var bounds = new google.maps.LatLngBounds();

					// Pengambilan data dari database
					<?php
						$q_lokasi   = mysqli_query($dbconnect,"SELECT tbl_has_dpl.id_has_dpl, tbl_has_dpl.id_kelompok, tbl_has_dpl.id_dpl, tbl_kelompok.id_kelompok, tbl_kelompok.id_lokasi, tbl_kelompok.id_prodi, tbl_kelompok.nama_kelompok, tbl_kelompok.tahun_kkn, tbl_lokasi.id_lokasi, tbl_lokasi.id_provinsi, tbl_lokasi.id_kota, tbl_lokasi.id_kecamatan, tbl_lokasi.id_kelurahan, tbl_lokasi.lat, tbl_lokasi.lng FROM tbl_has_dpl NATURAL JOIN tbl_kelompok NATURAL JOIN tbl_lokasi WHERE tbl_has_dpl.id_dpl='$r_dpl[id_dpl]' AND tbl_kelompok.tahun_kkn='$r_atur[tahun_kkn]' AND tbl_kelompok.id_kelompok ORDER BY tbl_kelompok.nama_kelompok ASC");					
						while($r_lokasi = mysqli_fetch_array($q_lokasi)){
							
						$r_tprov = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_lokasi[id_provinsi]'"));
								
						$r_tkota = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_lokasi[id_kota]'"));
						
						$r_tkec  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_lokasi[id_kecamatan]'"));
						
						$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_lokasi[id_kelurahan]'"));	
						
						$lat   = $r_lokasi['lat'];
						$lon   = $r_lokasi['lng'];
						$kec   = $r_tkec['nama'];
						$kel   = $r_tkel['nama'];
						$klmpk = $r_lokasi['nama_kelompok'];
						$image = '../../assets/img/icon/small-marker.png';
		
				 		echo ("addMarker($lat, $lon, '$image','Lokasi KKN Kel. $klmpk : <b>Kec</b>. $kec - <b>Kel</b>. $kel');\n");                  
						}
						
					  ?>
					  
					// Proses membuat marker 
					function addMarker(lat, lng, img, info) {
						var lokasi = new google.maps.LatLng(lat, lng);
						bounds.extend(lokasi);
						var marker = new google.maps.Marker({
							map: map,
							zoom: 5,
							position: lokasi,
							icon: img
						});       
						map.fitBounds(bounds);
						bindInfoWindow(marker, map, infoWindow, info);
					 }
					
					// Menampilkan informasi pada masing-masing marker yang diklik
					function bindInfoWindow(marker, map, infoWindow, html) {
					  google.maps.event.addListener(marker, 'click', function() {
						infoWindow.setContent(html);
						infoWindow.open(map, marker);
					  });
					}
			 
					}
				google.maps.event.addDomListener(window, 'load', initialize);
			</script>
		<?php } ?>
</head>

<body class="layout-boxed">
	<?php
		include '../../setting/include/dpl_firstnavbar.php';
		
		include '../../setting/include/dpl_secondnavbar.php';
		
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
					
					include '../../setting/include/dpl_set_pages.php';
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
