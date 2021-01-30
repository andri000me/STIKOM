<?php
	//error_reporting(0);
	
	session_start();

	if(!isset($_SESSION['agent_forum']) || $_SESSION['agent_forum']!=md5($_SERVER['HTTP_USER_AGENT']) || $_SESSION['level']!=='admin') {
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
	include '../../setting/action/aksi_delete.php';
	include '../../setting/action/aksi_download.php';

	if (empty($_GET['page'])) {
		$page = 'dashboard';
	}
	else {
		$page = $_GET['page'];
	}
	
	$id_user   = $_SESSION['id_user'];
	$q_login   = mysqli_query($dbconnect,"SELECT * FROM tbl_admin WHERE id_admin='$id_user'");
	$r_login   = mysqli_fetch_array($q_login);
	
	$namaadmin = explode(" ",$r_login['nama_admin']);	
	$namadepan = $namaadmin[0];
	
	include '../../setting/action/aksi_admin.php';	
	
	if($page == "kelompok"){	
		$q_tdpl1    = mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dpl");
		$jsArray1	= "var dpl1 = new Array();\n"; 
		
		$q_tdpl2    = mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dpl");
		$jsArray2	= "var dpl2 = new Array();\n"; 
		
		$q_tprodi   = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi");		
	}
	elseif($page == "dpl"){	
		$q_tdosen	= mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen");
		$jsArray	= "var dosen = new Array();\n"; 
	}
	elseif($page == "mahasiswa" || $page == "dosen"){
		include '../../setting/action/aksi_import.php';
	}
	elseif($page == "cekberkas"){
		//require_once '../../setting/function/func_mailer.php';
		include '../../setting/action/aksi_sendmail.php';
	}
	
	$r_atur = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_pengaturan WHERE id_pengaturan"));
	
	$tahun_kkn   = $r_atur['tahun_kkn'];
	
	$tkkn        = explode("/",$tahun_kkn);
	
	$thn1        = $tkkn[0];
	$thn2        = $tkkn[1];
	
?>