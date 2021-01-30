<?php
	//error_reporting(0);
	
	session_start();

	if(!isset($_SESSION['agent_forum']) || $_SESSION['agent_forum']!=md5($_SERVER['HTTP_USER_AGENT']) || $_SESSION['level']!=='peserta') {
		header("location: ../../index.php");
		exit();
	}
	
	$namaBulan = array(
		1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni",
			"Juli", "Agustus",  "September", "Oktober",  "November", "Desember"
	);
 
	$hariIni = time(); // menyimpan tanggal hari ini
	$tahun   = date("Y", $hariIni); // ambil tahun dari hari ini
	
	include '../../setting/function/func_lib.php';
	include '../../setting/function/func_title.php';
	include '../../setting/function/func_media.php';
	
	include '../../setting/connect/config.php';	
	include '../../setting/action/aksi_admin.php';	
	include '../../setting/action/aksi_delete.php';
//	include '../../setting/action/aksi_download.php';

	if (empty($_GET['page'])) {
		$page = 'dashboard';
	}
	else {
		$page = $_GET['page'];
	}
	
	$id_user     = $_SESSION['id_user'];
	
	$r_peserta   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$id_user'"));
	
	$r_mahasiswa = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_peserta[id_mahasiswa]'"));
	
	$namapeserta = explode(" ",$r_mahasiswa['nama_mahasiswa']);	
	$namadepan   = $namapeserta[0];
	
	$r_hpeserta  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_peserta='$r_peserta[id_peserta]'"));
	
	$status_peserta  = $r_hpeserta['status_has_peserta']; 
	
	$q_xkelompok = mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$r_hpeserta[id_kelompok]'");
	$cek_xkelompok = mysqli_num_rows($q_xkelompok);
	$r_xkelompok = mysqli_fetch_array($q_xkelompok);

	
	$r_atur = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_pengaturan WHERE id_pengaturan"));
	
	
	include '../../setting/action/aksi_admin.php';
?>