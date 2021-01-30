<?php

	if (isset($_GET['berkas'])) {
	$q_dberkas = mysqli_query ($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$_GET[berkas]'");
	$r_dberkas = mysqli_fetch_array($q_dberkas);

	header("Content-Disposition: attachment; filename=".$r_dberkas['file_persyaratan']);
	$fp 	 = fopen("../../setting/save/persyaratan/".$r_dberkas['file_persyaratan'], 'r');
	$content = fread($fp, filesize('../../setting/save/persyaratan/'.$r_dberkas['file_persyaratan']));
		fclose($fp);
			echo $content;
		exit;
		
	}
	if (isset($_GET['unduh'])) {
	$q_dsk = mysqli_query ($dbconnect,"SELECT * FROM tbl_sk WHERE id_sk='$_GET[unduh]'");
	$r_dsk = mysqli_fetch_assoc($q_dsk);

	header("Content-Disposition: attachment; filename=".$r_dsk['file_sk']);
	$fp1 	 = fopen("setting/save/sk/".$r_dsk['file_sk'], 'r');
	$content1 = fread($fp1, filesize('setting/save/sk/'.$r_dsk['file_sk']));
		fclose($fp1);
			echo $content1;
		exit;
		
	}
	
?>
	
