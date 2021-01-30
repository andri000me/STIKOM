<?php

include '../connect/config.php';

if(isset($_GET['pemesan'])){
	$pemesan       = $_GET['pemesan'];	
	$array_pemesan = array();	
	
	$q_pemesan = mysqli_query($dbconnect,"SELECT * FROM tbl_pemesan WHERE nama_pemesan LIKE '%{$pemesan}%'");
	while($r_pemesan = mysqli_fetch_assoc($q_pemesan)){
	
		$array_pemesan[] = $r_pemesan['nama_pemesan'];
	
	}
	
	echo json_encode($array_pemesan);
}

if(isset($_GET['ayah'])){
	$ayah       = $_GET['ayah'];	
	$array_ayah = array();	
	
	$q_ayah    = mysqli_query($dbconnect,"SELECT nama_penduduk,status_dlm_keluarga FROM tbl_penduduk WHERE nama_penduduk LIKE '%{$ayah}%' AND status_dlm_keluarga='kepala keluarga'");
	while($r_ayah = mysqli_fetch_assoc($q_ayah)){
	
		$array_ayah[] = $r_ayah['nama_penduduk'];
	
	}
	
	echo json_encode($array_ayah);
}

if(isset($_GET['ibu'])){
	$ibu        = $_GET['ibu'];	
	$array_ibu  = array();	
	
	$q_ibu    = mysqli_query($dbconnect,"SELECT nama_penduduk,status_dlm_keluarga FROM tbl_penduduk WHERE nama_penduduk LIKE '%{$ibu}%' AND status_dlm_keluarga='istri'");
	while($r_ibu = mysqli_fetch_assoc($q_ibu)){
	
		$array_ibu[] = $r_ibu['nama_penduduk'];
	
	}
	
	echo json_encode($array_ibu);
}

if(isset($_GET['nkk'])){
	$nkk        = $_GET['nkk'];	
	$array_kk  = array();	
	
	$q_kk    = mysqli_query($dbconnect,"SELECT nkk FROM tbl_keluarga WHERE nkk LIKE '%{$nkk}%'");
	while($r_kk = mysqli_fetch_assoc($q_kk)){
	
		$array_kk[] = $r_kk['nkk'];
	
	}
	
	echo json_encode($array_kk);
}
	
?>
