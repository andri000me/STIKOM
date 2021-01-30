<?php
	
	include 'setting/connect/config.php';
		
	include 'setting/function/func_lib.php';
	include 'setting/function/func_title.php';
	include 'setting/function/func_media.php';
	include 'setting/action/aksi_admin.php';
	
	
	//$site_key   = '6LcFkEgUAAAAAFoiIBupRKlsHQHsvetc0PH-S5ld'; // Diisi dengan site_key API Google reCapthca yang sobat miliki
	//$secret_key = '6LcFkEgUAAAAAPL-WAOvfDnccBlUhbw2Ey6JL3br'; // Diisi dengan secret_key API Google reCapthca yang sobat miliki

	include 'setting/action/aksi_login.php';
	include 'setting/action/aksi_download.php';

	if (empty($_GET['page'])) {
		$page = 'beranda';
	}
	else {
		$page = $_GET['page'];
	}

	$r_atur = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_pengaturan WHERE id_pengaturan"));
	
	include 'setting/action/aksi_alert.php';
	
?>