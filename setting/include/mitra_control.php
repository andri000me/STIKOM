<?php
//	error_reporting(0);
	
	session_start();

	if(!isset($_SESSION['agent_forum']) || $_SESSION['agent_forum']!=md5($_SERVER['HTTP_USER_AGENT']) || $_SESSION['level']!=='mitra') {
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
	
	$id_user     = $_SESSION['id_user'];
	
	$r_mitra     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_mitra='$id_user'"));
	
	$namamitra   = explode(" ",$r_mitra['nama_mitra']);	
	$namadepan   = $namamitra[0];

	$jk_mitra    = $r_mitra['jk_mitra'];
	
	$r_atur = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_pengaturan WHERE id_pengaturan"));
	
	$r_xkelompok = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_lokasi='$r_mitra[id_mitra]' AND tahun_kkn='$r_atur[tahun_kkn]'"));
	
	
?>