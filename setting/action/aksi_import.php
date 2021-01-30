<?php

include "../../assets/excel-reader/php-excel-reader/excel_reader2.php";

if(isset($_POST['impor_mahasiswa'])){
	
	$data  = new Spreadsheet_Excel_Reader($_FILES['file_import']['tmp_name']);
	$baris = $data->rowcount($sheet_index=0);

	for ($i=2; $i <= $baris; $i++){
			
		$nama_prodi	 	   = strtolower($data->val($i, 1));	
		$r_prodi		   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE nama_prodi='$nama_prodi'"));	
		
		$id_prodi		   = $r_prodi['id_prodi'];	
		$nim		 	   = $data->val($i, 2);
		$nama_mahasiswa	   = strtolower($data->val($i, 3));
		
		$jk_mahasiswa 	   = strtolower($data->val($i, 4));
				
		$tempat_lahir 	   = strtolower($data->val($i, 5));
		$tgl_lahir		   = $data->val($i, 6);

		$lahir	    	   = explode("/",$tgl_lahir);
					  $tgl = $lahir[0];
					  $bln = $lahir[1];
					  $thn = $lahir[2];
		$tgllahir		   = $thn."-".$bln."-".$tgl;
		
		$agama_mahasiswa   = strtolower($data->val($i, 7));
		
		$notlpmahasiswa    = $data->val($i, 8);
		$no_tlp_mahasiswa  = "0".$notlpmahasiswa;
		
		$email_mahasiswa   = strtolower($data->val($i, 9));	
		$alamat_mahasiswa  = strtolower($data->val($i, 10));
		$tahun_angkatan    = $data->val($i, 11);

		$cek_mahasiswa=mysqli_query($dbconnect,"SELECT * FROM `tbl_mahasiswa` WHERE `nim` = '$nim'") or die(mysqli_error($dbconnect));
		if(mysqli_num_rows($cek_mahasiswa)!=0){
			header('location:?page=mahasiswa&error_duplicate_data');
			exit();
		}else{	
			$in_mahasiswa = mysqli_query($dbconnect,"INSERT INTO `tbl_mahasiswa`(`id_prodi`, `nim`, `pin_krs`, `nama_mahasiswa`, `jk_mahasiswa`, `tempat_lahir`, `tgl_lahir`, `agama_mahasiswa`, `no_tlp_mahasiswa`, `email_mahasiswa`, `alamat_mahasiswa`, `tahun_angkatan`) VALUES ('$id_prodi','$nim','','$nama_mahasiswa','$jk_mahasiswa','$tempat_lahir','$tgllahir','$agama_mahasiswa','$no_tlp_mahasiswa','$email_mahasiswa','$alamat_mahasiswa','$tahun_angkatan')") or die (mysqli_error());
		}
		
	} 
	header('location:?page=mahasiswa&success_save_data');
}

if(isset($_POST['impor_dosen'])){
	
	$data  = new Spreadsheet_Excel_Reader($_FILES['file_import']['tmp_name']);
	$baris = $data->rowcount($sheet_index=0);

	for ($i=2; $i <= $baris; $i++){

		$nidn		 	   = $data->val($i, 1);
		$nama_dosen 	   = strtolower($data->val($i, 2));
		
		$jk_dosen 	       = strtolower($data->val($i, 3));
				
		$tempat_lahir 	   = strtolower($data->val($i, 4));
		$tgl_lahir		   = $data->val($i, 5);

		$lahir	    	   = explode("/",$tgl_lahir);
					  $tgl = $lahir[0];
					  $bln = $lahir[1];
					  $thn = $lahir[2];
		$tgllahir		   = $thn."-".$bln."-".$tgl;
		
		$agama_dosen       = strtolower($data->val($i, 6));
		
		$notlpdosen        = $data->val($i, 7);
		$no_tlp_dosen      = "0".$notlpdosen;
		
		$email_dosen       = strtolower($data->val($i, 8));	
		$alamat_dosen      = strtolower($data->val($i, 9));
		
		$cek_dosen=mysqli_query($dbconnect,"SELECT * FROM `tbl_dosen` WHERE `nidn` = '$nidn'") or die(mysqli_error($dbconnect));
		if(mysqli_num_rows($cek_dosen)!=0){
			header('location:?page=dosen&error_duplicate_data');
			exit();
		}else{
			$in_dosen = mysqli_query($dbconnect,"INSERT INTO `tbl_dosen`(`nidn`, `nama_dosen`, `jk_dosen`, `tempat_lahir`, `tgl_lahir`, `agama_dosen`, `no_tlp_dosen`, `email_dosen`, `alamat_dosen`) VALUES ('$nidn','$nama_dosen','$jk_dosen','$tempat_lahir','$tgllahir','$agama_dosen','$no_tlp_dosen','$email_dosen','$alamat_dosen')") or die (mysqli_error());
		}
	}	
	header('location:?page=dosen&success_save_data');
}	
?>