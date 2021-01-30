<?php
	//error_reporting(0);
	
	session_start();

	if(!isset($_SESSION['agent_forum']) || $_SESSION['agent_forum']!=md5($_SERVER['HTTP_USER_AGENT']) || $_SESSION['level']!=='dpl') {
		header("location: ../../index.php");
		exit();
	}
	
	include '../../setting/function/func_lib.php';
	include '../../setting/function/func_title.php';
	include '../../setting/function/func_media.php';
	
	include '../../setting/connect/config.php';	
	include '../../setting/action/aksi_admin.php';	
//	include '../../setting/action/aksi_delete.php';
//	include '../../setting/action/aksi_download.php';

	if (empty($_GET['page'])) {
		$page = 'dashboard';
	}
	else {
		$page = $_GET['page'];
	}
	
	$id_user = $_SESSION['id_user'];
	
	$r_dpl   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dpl='$id_user'"));
	
	$r_dosen = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl[id_dosen]'"));
	
	
	$r_hdpl  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_dpl='$r_dpl[id_dpl]'"));
	
	$namadpl   = explode(" ",$r_dosen['nama_dosen']);	
	$namadepan = $namadpl[0];

	$jk_dpl    = $r_dosen['jk_dosen'];
	
	$r_atur = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_pengaturan WHERE id_pengaturan"));
?>