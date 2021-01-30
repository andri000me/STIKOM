<?php
include '../connect/config.php';

if(isset($_GET['nim'])){
	
	$r_mahasiswa = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_mahasiswa.id_mahasiswa, tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.pin_krs, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.no_tlp_mahasiswa, tbl_mahasiswa.email_mahasiswa, tbl_mahasiswa.alamat_mahasiswa, tbl_mahasiswa.tahun_angkatan, tbl_prodi.id_prodi, tbl_prodi.nama_prodi FROM tbl_mahasiswa  NATURAL JOIN tbl_prodi WHERE tbl_mahasiswa.nim='$_GET[nim]'"));
	$array_mahasiswa  = array(
																														
				'id_mahasiswa'     =>  $r_mahasiswa['id_mahasiswa'],
				'nama_mahasiswa'   =>  ucwords($r_mahasiswa['nama_mahasiswa']),
				'pin_krs'      	   =>  $r_mahasiswa['pin_krs'],
				'no_tlp_mahasiswa' =>  $r_mahasiswa['no_tlp_mahasiswa'],
				'nama_prodi'       =>  ucwords($r_mahasiswa['nama_prodi']),
				'email_mahasiswa'  =>  ucwords($r_mahasiswa['email_mahasiswa']),
				'alamat_mahasiswa' =>  ucwords($r_mahasiswa['alamat_mahasiswa']),
				'tahun_angkatan'   =>  ucwords($r_mahasiswa['tahun_angkatan']),
																														
				);
	 echo json_encode($array_mahasiswa);
	 
}
?>