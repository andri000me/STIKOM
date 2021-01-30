<?php
/***********************************************************************
	TIME SET
***********************************************************************/

	date_default_timezone_set('Asia/Jakarta');
	$tanggal= mktime(date("m"),date("d"),date("Y"));
	$tglsekarang = date("Y-m-d", $tanggal);
/***********************************************************************
	SIMPAN MAHASISWA
***********************************************************************/
if(isset($_POST['simpan_mahasiswa'])){	

	$id_prodi	 	   = $_POST['id_prodi'];
	$nim		 	   = $_POST['nim'];
	$nama_mahasiswa	   = strtolower($_POST['nama_mahasiswa']);
	
	$jk_mahasiswa 	   = $_POST['jk_mahasiswa'];
	$agama_mahasiswa   = strtolower($_POST['agama_mahasiswa']);
	$no_tlp_mahasiswa  = strtolower($_POST['no_tlp_mahasiswa']);
	$email_mahasiswa   = strtolower($_POST['email_mahasiswa']);	
	$alamat_mahasiswa  = strtolower($_POST['alamat_mahasiswa']);
	$tahun_angkatan    = $_POST['tahun_angkatan'];
	
	$tempat_lahir 	   = strtolower($_POST['tempat_lahir']);
	$tgl 			   = $_POST['tgl'];
	$bln 			   = $_POST['bln'];
	$thn	 		   = $_POST['thn'];
	$tgl_lahir		   = $thn."-".$bln."-".$tgl;
	
	$savefotomahasiswa = $_POST ['savefotomahasiswa'];
	$fotomahasiswa     = $_FILES["savefotomahasiswa"]["name"];
	
	$target_dir 		   = "../../setting/save/mahasiswa/";	
	
	$acak       	       = rand(1,999999);
	$acakfotomahasiswa      = 'foto'.$acak.$fotomahasiswa;
	$target_file       	   = $target_dir.$acakfotomahasiswa.basename($_FILES["savefotomahasiswa"]);
	$uploadOk 			   = 1;

	$imageFileType 		   = pathinfo($target_file,PATHINFO_EXTENSION);
	$uploadOk 			   = 1;

	if ($uploadOk == 0) {
		header('location:?page=mahasiswa&error_file_upload');
		exit();
	}else{
	
		if(!empty($_POST['id_mahasiswa'])){
			
			if(!empty($fotomahasiswa)){
				if($imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "jpeg" && $imageFileType != "JPEG") {
					header('location:?page=mahasiswa&error_images_type');
					exit();
					$uploadOk = 0;
				}
				
				$del_foto = mysqli_fetch_row(mysqli_query($dbconnect,"SELECT foto_mahasiswa FROM tbl_mahasiswa WHERE id_mahasiswa='$_POST[id_mahasiswa]'"));
				unlink("../../setting/save/mahasiswa/$del_foto[0]");
				
				if (move_uploaded_file($_FILES["savefotomahasiswa"]["tmp_name"], $target_file)) {
					$up_mahasiswa = mysqli_query($dbconnect,"UPDATE `tbl_mahasiswa` SET `id_prodi`='$id_prodi',`nim`='$nim',`nama_mahasiswa`='$nama_mahasiswa',`jk_mahasiswa`='$jk_mahasiswa',`tempat_lahir`='$tempat_lahir',`tgl_lahir`='$tgl_lahir',`agama_mahasiswa`='$agama_mahasiswa',`no_tlp_mahasiswa`='$no_tlp_mahasiswa',`email_mahasiswa`='$email_mahasiswa',`alamat_mahasiswa`='$alamat_mahasiswa',`tahun_angkatan`='$tahun_angkatan',`foto_mahasiswa`='$acakfotomahasiswa' WHERE `id_mahasiswa`='$_POST[id_mahasiswa]'") or die (mysqli_error());
					if($up_mahasiswa){
						header('location:?page=mahasiswa&success_edit_data');
						exit();
					}else{
						header('location:?page=mahasiswa&error_edit_data');
						exit();
					}
				}else{
					header('location:?page=mahasiswa&error_save_data');
					exit();
				}
				
			}elseif(empty($fotomahasiswa)){
					$up_mahasiswa = mysqli_query($dbconnect,"UPDATE `tbl_mahasiswa` SET `id_prodi`='$id_prodi',`nim`='$nim',`nama_mahasiswa`='$nama_mahasiswa',`jk_mahasiswa`='$jk_mahasiswa',`tempat_lahir`='$tempat_lahir',`tgl_lahir`='$tgl_lahir',`agama_mahasiswa`='$agama_mahasiswa',`no_tlp_mahasiswa`='$no_tlp_mahasiswa',`email_mahasiswa`='$email_mahasiswa',`alamat_mahasiswa`='$alamat_mahasiswa',`tahun_angkatan`='$tahun_angkatan' WHERE `id_mahasiswa`='$_POST[id_mahasiswa]'") or die (mysqli_error());
					if($up_mahasiswa){
						header('location:?page=mahasiswa&success_edit_data');
						exit();
					}else{
						header('location:?page=mahasiswa&error_edit_data');
						exit();
					}
			}else{
				header('location:?page=mahasiswa&error_save_data');
				exit();
			}
			
		}elseif(empty($_POST['id_mahasiswa'])){
			
			$cek_mahasiswa=mysqli_query($dbconnect,"SELECT * FROM `tbl_mahasiswa` WHERE `nim` = '$nim'") or die(mysqli_error($dbconnect));
				if(mysqli_num_rows($cek_mahasiswa)!=0){
					header('location:?page=mahasiswa&error_duplicate_data');
					exit();
				}else{	
					if(!empty($fotomahasiswa)){
						if($imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "jpeg" && $imageFileType != "JPEG") {
							header('location:?page=mahasiswa&error_images_type');
							exit();
							$uploadOk = 0;
						}
						
						if (move_uploaded_file($_FILES["savefotomahasiswa"]["tmp_name"], $target_file)) {
							$in_mahasiswa = mysqli_query($dbconnect,"INSERT INTO `tbl_mahasiswa`(`id_prodi`, `nim`, `nama_mahasiswa`, `jk_mahasiswa`, `tempat_lahir`, `tgl_lahir`, `agama_mahasiswa`, `no_tlp_mahasiswa`, `email_mahasiswa`, `alamat_mahasiswa`, `tahun_angkatan`, `foto_mahasiswa`) VALUES ('$id_prodi','$nim','$nama_mahasiswa','$jk_mahasiswa','$tempat_lahir','$tgl_lahir','$agama_mahasiswa','$no_tlp_mahasiswa','$email_mahasiswa','$alamat_mahasiswa','$tahun_angkatan','$acakfotomahasiswa')") or die (mysqli_error());
							if($in_mahasiswa){
								header('location:?page=mahasiswa&success_save_data');
								exit();
							}else{
								header('location:?page=mahasiswa&error_save_data');
								exit();
							}
						}else{
							header('location:?page=mahasiswa&error_save_data');
							exit();
						}
						
					}elseif(empty($fotomahasiswa)){
							$in_mahasiswa = mysqli_query($dbconnect,"INSERT INTO `tbl_mahasiswa`(`id_prodi`, `nim`, `nama_mahasiswa`, `jk_mahasiswa`, `tempat_lahir`, `tgl_lahir`, `agama_mahasiswa`, `no_tlp_mahasiswa`, `email_mahasiswa`, `alamat_mahasiswa`, `tahun_angkatan`) VALUES ('$id_prodi','$nim','$nama_mahasiswa','$jk_mahasiswa','$tempat_lahir','$tgl_lahir','$agama_mahasiswa','$no_tlp_mahasiswa','$email_mahasiswa','$alamat_mahasiswa','$tahun_angkatan')") or die (mysqli_error());
							if($in_mahasiswa){
								header('location:?page=mahasiswa&success_save_data');
								exit();
							}else{
								header('location:?page=mahasiswa&error_save_data');
								exit();
							}
					}else{
						header('location:?page=mahasiswa&error_save_data');
						exit();
					}
				
				}
				
		}else{
			header('location:?page=mahasiswa&error_save_data');
			exit();
		}

	}	
}
/***********************************************************************
	SIMPAN DOSEN
***********************************************************************/
if(isset($_POST['simpan_dosen'])){	

	$nidn		   = $_POST['nidn'];
	$nama_dosen	   = strtolower($_POST['nama_dosen']);
	
	
	$jk_dosen 	   = $_POST['jk_dosen'];
	$agama_dosen   = strtolower($_POST['agama_dosen']);
	$no_tlp_dosen  = strtolower($_POST['no_tlp_dosen']);
	$email_dosen   = strtolower($_POST['email_dosen']);	
	$alamat_dosen  = strtolower($_POST['alamat_dosen']);

	$tempat_lahir 	   = strtolower($_POST['tempat_lahir']);
	$tgl 			   = $_POST['tgl'];
	$bln 			   = $_POST['bln'];
	$thn	 		   = $_POST['thn'];
	$tgl_lahir		   = $thn."-".$bln."-".$tgl;

	
	$savefotodosen = $_POST ['savefotodosen'];
	$fotodosen     = $_FILES["savefotodosen"]["name"];
	
	$target_dir 		   = "../../setting/save/dosen/";	
	
	$acak       	       = rand(1,999999);
	$acakfotodosen         = 'foto'.$acak.$fotodosen;
	$target_file       	   = $target_dir.$acakfotodosen.basename($_FILES["savefotodosen"]);
	$uploadOk 			   = 1;

	$imageFileType 		   = pathinfo($target_file,PATHINFO_EXTENSION);
	$uploadOk 			   = 1;

	if ($uploadOk == 0) {
		header('location:?page=dosen&error_file_upload');
		exit();
	}else{
	
		if(!empty($_POST['id_dosen'])){
			
			if(!empty($fotodosen)){
				if($imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "jpeg" && $imageFileType != "JPEG") {
					header('location:?page=dosen&error_images_type');
					exit();
					$uploadOk = 0;
				}
				
				$del_foto = mysqli_fetch_row(mysqli_query($dbconnect,"SELECT foto_dosen FROM tbl_dosen WHERE id_dosen='$_POST[id_dosen]'"));
				unlink("../../setting/save/dosen/$del_foto[0]");
				
				if (move_uploaded_file($_FILES["savefotodosen"]["tmp_name"], $target_file)) {
					$up_dosen = mysqli_query($dbconnect,"UPDATE `tbl_dosen` SET `nidn`='$nidn',`nama_dosen`='$nama_dosen',`jk_dosen`='$jk_dosen',`tempat_lahir`='$tempat_lahir',`tgl_lahir`='$tgl_lahir',`agama_dosen`='$agama_dosen',`no_tlp_dosen`='$no_tlp_dosen',`email_dosen`='$email_dosen',`alamat_dosen`='$alamat_dosen',`foto_dosen`='$acakfotodosen' WHERE `id_dosen`='$_POST[id_dosen]'") or die (mysqli_error());
					if($up_dosen){
						header('location:?page=dosen&success_edit_data');
						exit();
					}else{
						header('location:?page=dosen&error_edit_data');
						exit();
					}
				}else{
					header('location:?page=dosen&error_save_data');
					exit();
				}
				
			}elseif(empty($fotodosen)){
					$up_dosen = mysqli_query($dbconnect,"UPDATE `tbl_dosen` SET `nidn`='$nidn',`nama_dosen`='$nama_dosen',`jk_dosen`='$jk_dosen',`tempat_lahir`='$tempat_lahir',`tgl_lahir`='$tgl_lahir',`agama_dosen`='$agama_dosen',`no_tlp_dosen`='$no_tlp_dosen',`email_dosen`='$email_dosen',`alamat_dosen`='$alamat_dosen' WHERE `id_dosen`='$_POST[id_dosen]'") or die (mysqli_error());
					if($up_dosen){
						header('location:?page=dosen&success_edit_data');
						exit();
					}else{
						header('location:?page=dosen&error_edit_data');
						exit();
					}
			}else{
				header('location:?page=dosen&error_save_data');
				exit();
			}
			
		}elseif(empty($_POST['id_dosen'])){
			
			$cek_dosen=mysqli_query($dbconnect,"SELECT * FROM `tbl_dosen` WHERE `nidn` = '$nidn'") or die(mysqli_error($dbconnect));
				if(mysqli_num_rows($cek_dosen)!=0){
					header('location:?page=dosen&error_duplicate_data');
					exit();
				}else{	
					if(!empty($fotodosen)){
						if($imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "jpeg" && $imageFileType != "JPEG") {
							header('location:?page=dosen&error_images_type');
							exit();
							$uploadOk = 0;
						}
						
						if (move_uploaded_file($_FILES["savefotodosen"]["tmp_name"], $target_file)) {
							$in_dosen = mysqli_query($dbconnect,"INSERT INTO `tbl_dosen`(`nidn`, `nama_dosen`, `jk_dosen`, `tempat_lahir`, `tgl_lahir`, `agama_dosen`, `no_tlp_dosen`, `email_dosen`, `alamat_dosen`,`foto_dosen`) VALUES ('$nidn','$nama_dosen','$jk_dosen','$tempat_lahir','$tgl_lahir','$agama_dosen','$no_tlp_dosen','$email_dosen','$alamat_dosen','$acakfotodosen')") or die (mysqli_error());
							if($in_dosen){
								header('location:?page=dosen&success_save_data');
								exit();
							}else{
								header('location:?page=dosen&error_save_data');
								exit();
							}
						}else{
							header('location:?page=dosen&error_save_data');
							exit();
						}
						
					}elseif(empty($fotodosen)){
							$in_dosen = mysqli_query($dbconnect,"INSERT INTO `tbl_dosen`(`nidn`, `nama_dosen`, `jk_dosen`, `tempat_lahir`, `tgl_lahir`, `agama_dosen`, `no_tlp_dosen`, `email_dosen`, `alamat_dosen`) VALUES ('$nidn','$nama_dosen','$jk_dosen','$tempat_lahir','$tgl_lahir','$agama_dosen','$no_tlp_dosen','$email_dosen','$alamat_dosen')") or die (mysqli_error());
							if($in_dosen){
								header('location:?page=dosen&success_save_data');
								exit();
							}else{
								header('location:?page=dosen&error_save_data');
								exit();
							}
					}else{
						header('location:?page=dosen&error_save_data');
						exit();
					}
				
				}
				
		}else{
			header('location:?page=dosen&error_save_data');
			exit();
		}

	}	
}
/***********************************************************************
	UBAH PIN KRS
***********************************************************************/
if(isset($_POST['ubah_pin'])){
		
	$id_mahasiswa  	   = $_POST ['id_mahasiswa'];
	$pin_krs      	   = $_POST ['pin_krs'];
		
	$q_pin=mysqli_query($dbconnect, "UPDATE `tbl_mahasiswa` SET `pin_krs`='$pin_krs' WHERE `id_mahasiswa`='$id_mahasiswa'") or die (mysqli_error());
		
		if($q_pin){
			header('location:?page=mahasiswa&success_edit_data');
			exit();	
		}else{
			header('location:?page=mahasiswa&error_edit_data');
			exit();
		}

}
/***********************************************************************
	SIMPAN SYARAT & KETENTUAN
***********************************************************************/
if(isset($_POST['simpan_bk'])){	


	$judul_bk 	   = $_POST['judul_bk'];
	$tgl_post 	   = $tglsekarang;
	
	$savefilebk    = $_POST ['savefilebk'];
	$filebk        = $_FILES["savefilebk"]["name"];
	
	$target_dir 		   = "../../setting/save/sk/";	
	
	$acak       	       = rand(1,999999);
	$acakfilebk            = 'file'.$acak.$filebk;
	$target_file       	   = $target_dir.$acakfilebk.basename($_FILES["savefilebk"]);
	$uploadOk 			   = 1;

	$imageFileType 		   = pathinfo($target_file,PATHINFO_EXTENSION);
	$uploadOk 			   = 1;

	if ($uploadOk == 0) {
		header('location:?page=sk&error_file_upload');
		exit();
	}else{
	
		if(!empty($_POST['id_bk'])){
			
			if(!empty($filebk)){
				if($imageFileType != "pdf" && $imageFileType != "PDF") {
					header('location:?page=sk&error_file_type');
					exit();
					$uploadOk = 0;
				}
				
				$del_file = mysqli_fetch_row(mysqli_query($dbconnect,"SELECT file_bk FROM tbl_bk WHERE id_bk='$_POST[id_bk]'"));
				unlink("../../setting/save/sk/$del_file[0]");
				
				if (move_uploaded_file($_FILES["savefilebk"]["tmp_name"], $target_file)) {
					$up_bk = mysqli_query($dbconnect,"UPDATE `tbl_bk` SET `judul_bk`='$judul_bk',`tgl_post`='$tgl_post',`file_bk`='$acakfilebk' WHERE `id_bk`='$_POST[id_bk]'") or die (mysqli_error());
					if($up_bk){
						header('location:?page=sk&success_edit_data');
						exit();
					}else{
						header('location:?page=sk&error_edit_data');
						exit();
					}
				}else{
					header('location:?page=sk&error_save_data');
					exit();
				}
				
			}elseif(empty($filebk)){
				$up_bk = mysqli_query($dbconnect,"UPDATE `tbl_bk` SET `judul_bk`='$judul_bk',`tgl_post`='$tgl_post' WHERE `id_bk`='$_POST[id_bk]'") or die (mysqli_error());
					if($up_bk){
						header('location:?page=sk&success_edit_data');
						exit();
					}else{
						header('location:?page=sk&error_edit_data');
						exit();
					}
			}
			
		}elseif(empty($_POST['id_bk'])){
			
			$cek_bk=mysqli_query($dbconnect,"SELECT * FROM `tbl_bk` WHERE `judul_bk` = '$judul_bk'") or die(mysqli_error($dbconnect));
				if(mysqli_num_rows($cek_bk)!=0){
					header('location:?page=sk&error_duplicate_data');
					exit();
				}else{	
					if(!empty($filebk)){
						if($imageFileType != "pdf" && $imageFileType != "PDF") {
							header('location:?page=sk&error_file_type');
							exit();
							$uploadOk = 0;
						}
						
						if (move_uploaded_file($_FILES["savefilebk"]["tmp_name"], $target_file)) {
							$in_bk = mysqli_query($dbconnect,"INSERT INTO `tbl_bk`(`judul_bk`, `tgl_post`,`file_bk`) VALUES ('$judul_bk','$tgl_post','$acakfilebk')") or die (mysqli_error());
							if($in_bk){
								header('location:?page=sk&success_save_data');
								exit();
							}else{
								header('location:?page=sk&error_save_data');
								exit();
							}
						}else{
							header('location:?page=sk&error_save_data');
							exit();
						}
				
					}elseif(empty($filebk)){
						header('location:?page=sk&error_empty_file');
						exit();
					}
				
			}

		}	
	}
}
/***********************************************************************
	SIMPAN ADMIN
***********************************************************************/
if(isset($_POST['simpan_admin'])){	

	$nama_admin	   = strtolower($_POST['nama_admin']);	
	$jk_admin 	   = $_POST['jk_admin'];
	$agama_admin   = strtolower($_POST['agama_admin']);
	$no_tlp_admin  = strtolower($_POST['no_tlp_admin']);
	$email_admin   = strtolower($_POST['email_admin']);	
	$alamat_admin  = strtolower($_POST['alamat_admin']);

	$tempat_lahir 	   = strtolower($_POST['tempat_lahir']);
	$tgl 			   = $_POST['tgl'];
	$bln 			   = $_POST['bln'];
	$thn	 		   = $_POST['thn'];
	$tgl_lahir		   = $thn."-".$bln."-".$tgl;

	$username		   = $_POST['username'];
	
	$password		   = md5($_POST['password']);
	$confirm_password  = $_POST['confirm_password'];
	
	$savefotoadmin = $_POST ['savefotoadmin'];
	$fotoadmin     = $_FILES["savefotoadmin"]["name"];
	
	$target_dir 		   = "../../setting/save/admin/";	
	
	$acak       	       = rand(1,999999);
	$acakfotoadmin         = 'foto'.$acak.$fotoadmin;
	$target_file       	   = $target_dir.$acakfotoadmin.basename($_FILES["savefotoadmin"]);
	$uploadOk 			   = 1;

	$imageFileType 		   = pathinfo($target_file,PATHINFO_EXTENSION);
	$uploadOk 			   = 1;

	if ($uploadOk == 0) {
		header('location:?page=admin&error_file_upload');
		exit();
	}else{
	
		if(!empty($_POST['id_admin'])){
			
			if(!empty($fotoadmin)){
				if($imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "jpeg" && $imageFileType != "JPEG") {
					header('location:?page=admin&error_images_type');
					exit();
					$uploadOk = 0;
				}
				
				$del_foto = mysqli_fetch_row(mysqli_query($dbconnect,"SELECT foto_admin FROM tbl_admin WHERE id_admin='$_POST[id_admin]'"));
				unlink("../../setting/save/admin/$del_foto[0]");
				
				if (move_uploaded_file($_FILES["savefotoadmin"]["tmp_name"], $target_file)) {
					$up_admin = mysqli_query($dbconnect,"UPDATE `tbl_admin` SET `nama_admin`='$nama_admin',`jk_admin`='$jk_admin',`tempat_lahir`='$tempat_lahir',`tgl_lahir`='$tgl_lahir',`agama_admin`='$agama_admin',`no_tlp_admin`='$no_tlp_admin',`email_admin`='$email_admin',`alamat_admin`='$alamat_admin',`foto_admin`='$acakfotoadmin' WHERE `id_admin`='$_POST[id_admin]'") or die (mysqli_error());
					if($up_admin){
						header('location:?page=admin&success_edit_data');
						exit();
					}else{
						header('location:?page=admin&error_edit_data');
						exit();
					}
				}else{
					header('location:?page=admin&error_save_data');
					exit();
				}
				
			}elseif(empty($fotoadmin)){
					$up_admin = mysqli_query($dbconnect,"UPDATE `tbl_admin` SET `nama_admin`='$nama_admin',`jk_admin`='$jk_admin',`tempat_lahir`='$tempat_lahir',`tgl_lahir`='$tgl_lahir',`agama_admin`='$agama_admin',`no_tlp_admin`='$no_tlp_admin',`email_admin`='$email_admin',`alamat_admin`='$alamat_admin' WHERE `id_admin`='$_POST[id_admin]'") or die (mysqli_error());
					if($up_admin){
						header('location:?page=admin&success_edit_data');
						exit();
					}else{
						header('location:?page=admin&error_edit_data');
						exit();
					}
			}else{
				header('location:?page=admin&error_save_data');
				exit();
			}
			
		}elseif(empty($_POST['id_admin'])){
			
			$cek_admin=mysqli_query($dbconnect,"SELECT * FROM `tbl_admin` WHERE `username` = '$username'") or die(mysqli_error($dbconnect));
				if(mysqli_num_rows($cek_admin)!=0){
					header('location:?page=admin&error_duplicate_data');
					exit();
				}else{	
					if(!empty($fotoadmin)){
						if($imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "jpeg" && $imageFileType != "JPEG") {
							header('location:?page=admin&error_images_type');
							exit();
							$uploadOk = 0;
						}
						
						if (move_uploaded_file($_FILES["savefotoadmin"]["tmp_name"], $target_file)) {
							$in_admin = mysqli_query($dbconnect,"INSERT INTO `tbl_admin`(`nama_admin`, `jk_admin`, `tempat_lahir`, `tgl_lahir`, `agama_admin`, `no_tlp_admin`, `email_admin`, `alamat_admin`,`username`,`password`,`confirm_password`,`foto_admin`) VALUES ('$nama_admin','$jk_admin','$tempat_lahir','$tgl_lahir','$agama_admin','$no_tlp_admin','$email_admin','$alamat_admin','$username','$password','$confirm_password','$acakfotoadmin')") or die (mysqli_error());
							if($in_admin){
								header('location:?page=admin&success_save_data');
								exit();
							}else{
								header('location:?page=admin&error_save_data');
								exit();
							}
						}else{
							header('location:?page=admin&error_save_data');
							exit();
						}
						
					}elseif(empty($fotoadmin)){
							$in_admin = mysqli_query($dbconnect,"INSERT INTO `tbl_admin`(`nama_admin`, `jk_admin`, `tempat_lahir`, `tgl_lahir`, `agama_admin`, `no_tlp_admin`, `email_admin`, `alamat_admin`,`username`,`password`,`confirm_password`) VALUES ('$nama_admin','$jk_admin','$tempat_lahir','$tgl_lahir','$agama_admin','$no_tlp_admin','$email_admin','$alamat_admin','$username','$password','$confirm_password')") or die (mysqli_error());
							if($in_admin){
								header('location:?page=admin&success_save_data');
								exit();
							}else{
								header('location:?page=admin&error_save_data');
								exit();
							}
					}else{
						header('location:?page=admin&error_save_data');
						exit();
					}
				
				}
				
		}else{
			header('location:?page=admin&error_save_data');
			exit();
		}

	}	
}
/***********************************************************************
	UBAH AKUN
***********************************************************************/
if(isset($_POST['ubah_akun'])){
	
	$id_admin         = $_POST['id_admin'];
	$password         = md5($_POST['new_password']);
	$confirm_password = $_POST['new_confirm_password'];
	
	$up_akun = mysqli_query($dbconnect,"UPDATE `tbl_admin` SET `password`='$password',`confirm_password`='$confirm_password' WHERE `id_admin`='$id_admin'") or die (mysqli_error());
	
	if($up_akun){
		header('location:?page=admin&success_edit_data');
		exit();
	}else{
		header('location:?page=admin&ubah_admin='.$id_admin.'&error_edit_data');
		exit();
	}
}
/***********************************************************************
	UBAH PROFIL
***********************************************************************/
if(isset($_POST['ubah_profil'])){	

	$nama_admin	   = strtolower($_POST['nama_admin']);	
	$jk_admin 	   = $_POST['jk_admin'];
	$agama_admin   = strtolower($_POST['agama_admin']);
	$no_tlp_admin  = strtolower($_POST['no_tlp_admin']);
	$email_admin   = strtolower($_POST['email_admin']);	
	$alamat_admin  = strtolower($_POST['alamat_admin']);

	$tempat_lahir 	   = strtolower($_POST['tempat_lahir']);
	$tgl 			   = $_POST['tgl'];
	$bln 			   = $_POST['bln'];
	$thn	 		   = $_POST['thn'];
	$tgl_lahir		   = $thn."-".$bln."-".$tgl;

	$username		   = $_POST['username'];
	
	$password		   = md5($_POST['password']);
	$confirm_password  = $_POST['confirm_password'];
	
	$savefotoadmin = $_POST ['savefotoadmin'];
	$fotoadmin     = $_FILES["savefotoadmin"]["name"];
	
	$target_dir 		   = "../../setting/save/admin/";	
	
	$acak       	       = rand(1,999999);
	$acakfotoadmin         = 'foto'.$acak.$fotoadmin;
	$target_file       	   = $target_dir.$acakfotoadmin.basename($_FILES["savefotoadmin"]);
	$uploadOk 			   = 1;

	$imageFileType 		   = pathinfo($target_file,PATHINFO_EXTENSION);
	$uploadOk 			   = 1;

	if ($uploadOk == 0) {
		header('location:?page=profil&ubah_profil='.$_POST['id_admin'].'&error_file_upload');
		exit();
	}else{
	
		if(!empty($_POST['id_admin'])){
			
			if(!empty($fotoadmin)){
				if($imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "jpeg" && $imageFileType != "JPEG") {
					header('location:?page=profil&ubah_profil='.$_POST['id_admin'].'&error_images_type');
					exit();
					$uploadOk = 0;
				}
				
				$del_foto = mysqli_fetch_row(mysqli_query($dbconnect,"SELECT foto_admin FROM tbl_admin WHERE id_admin='$_POST[id_admin]'"));
				unlink("../../setting/save/admin/$del_foto[0]");
				
				if (move_uploaded_file($_FILES["savefotoadmin"]["tmp_name"], $target_file)) {
					$up_admin = mysqli_query($dbconnect,"UPDATE `tbl_admin` SET `nama_admin`='$nama_admin',`jk_admin`='$jk_admin',`tempat_lahir`='$tempat_lahir',`tgl_lahir`='$tgl_lahir',`agama_admin`='$agama_admin',`no_tlp_admin`='$no_tlp_admin',`email_admin`='$email_admin',`alamat_admin`='$alamat_admin',`foto_admin`='$acakfotoadmin' WHERE `id_admin`='$_POST[id_admin]'") or die (mysqli_error());
					if($up_admin){
						header('location:?page=profil&ubah_profil='.$_POST['id_admin'].'&success_edit_data');
						exit();
					}else{
						header('location:?page=profil&ubah_profil='.$_POST['id_admin'].'&error_edit_data');
						exit();
					}
				}else{
					header('location:?page=profil&ubah_profil='.$_POST['id_admin'].'&error_save_data');
					exit();
				}
				
			}elseif(empty($fotoadmin)){
					$up_admin = mysqli_query($dbconnect,"UPDATE `tbl_admin` SET `nama_admin`='$nama_admin',`jk_admin`='$jk_admin',`tempat_lahir`='$tempat_lahir',`tgl_lahir`='$tgl_lahir',`agama_admin`='$agama_admin',`no_tlp_admin`='$no_tlp_admin',`email_admin`='$email_admin',`alamat_admin`='$alamat_admin' WHERE `id_admin`='$_POST[id_admin]'") or die (mysqli_error());
					if($up_admin){
						header('location:?page=profil&ubah_profil='.$_POST['id_admin'].'&success_edit_data');
						exit();
					}else{
						header('location:?page=profil&ubah_profil='.$_POST['id_admin'].'&error_edit_data');
						exit();
					}
			}else{
				header('location:?page=profil&ubah_profil='.$_POST['id_admin'].'&error_save_data');
				exit();
			}
			
		}else{
			header('location:?page=profil&ubah_profil='.$_POST['id_admin'].'&error_save_data');
			exit();
		}

	}	
}
/***********************************************************************
	UBAH PROFIL AKUN
***********************************************************************/
if(isset($_POST['ubah_profil_akun'])){
	
	
	if(isset($_POST['id_admin'])){
		
		$tabel    = "tbl_admin";
		$id_tabel = "id_admin";
		$id_akun  = $_POST['id_admin'];
		$page     = "profil";
		$key	  = "ubah_profil";	
	
	}
	elseif(isset($_POST['id_peserta'])){
		
		$tabel    = "tbl_peserta";
		$id_tabel = "id_peserta";
		$id_akun  = $_POST['id_peserta'];
		$page     = "profil-peserta";
		$key	  = "profil";
		
	}
	elseif(isset($_POST['id_dpl'])){
		
		$tabel    = "tbl_dpl";
		$id_tabel = "id_dpl";
		$id_akun  = $_POST['id_dpl'];
		$page     = "profil-dpl";
		$key	  = "profil";
		
	}
	elseif(isset($_POST['id_mitra'])){
		
		$tabel    = "tbl_mitra";
		$id_tabel = "id_mitra";
		$id_akun  = $_POST['id_mitra'];
		$page     = "profil-mitra";
		$key	  = "profil";
		
	}
	
	$password         = md5($_POST['new_password']);
	$confirm_password = $_POST['new_confirm_password'];
	
	$up_akun = mysqli_query($dbconnect,"UPDATE `$tabel` SET `password`='$password',`confirm_password`='$confirm_password' WHERE `$id_tabel`='$id_akun'") or die (mysqli_error());
	
	if($up_akun){
		header('location:?page='.$page.'&'.$key.'='.$id_akun.'&success_edit_data');
		exit();
	}else{
		header('location:?page='.$page.'&'.$key.'='.$id_akun.'&error_edit_data');
		exit();
	}
}
/***********************************************************************
	SIMPAN PESERTA
***********************************************************************/
if(isset($_POST['simpan_daftar'])){	

	$id_mahasiswa		   = $_POST['id_mahasiswa'];
	$nim    			   = $_POST['nim'];
	$pin_krs			   = $_POST['pin_krs'];
	$tgl_daftar			   = $tglsekarang;
	
	$no_tlp_mahasiswa	   = $_POST['no_tlp_mahasiswa'];
	$email_mahasiswa	   = $_POST['email_mahasiswa'];
	$tahun_kkn      	   = $_POST['tahun_kkn'];
	
	$password		       = md5($_POST['password']);
	$confirm_password  	   = $_POST['confirm_password'];
	
	$savefilepersyaratan   = $_POST ['savefilepersyaratan'];
	$filepersyaratan       = $_FILES["savefilepersyaratan"]["name"];
	
	$target_dir 		   = "setting/save/persyaratan/";	
	
	$acak       	       = rand(1,999999);
	$acakfilepersyaratan   = 'file'.$acak.$filepersyaratan;
	$target_file       	   = $target_dir.$acakfilepersyaratan.basename($_FILES["savefilepersyaratan"]);
	$uploadOk 			   = 1;

	$imageFileType 		   = pathinfo($target_file,PATHINFO_EXTENSION);
	$uploadOk 			   = 1;

	if ($uploadOk == 0) {
		header('location:?page=daftar&alert='.base64_encode("error_file_upload"));
		exit();
	}else{
		$r_mahasiswa = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_mahasiswa='$id_mahasiswa'"));
		
		if(!empty($r_mahasiswa['id_mahasiswa']) AND $r_mahasiswa['status_peserta']=="belum"){
			
			if(!empty($filepersyaratan)){	
					
					if($imageFileType != "pdf" && $imageFileType != "PDF") {
						header('location:?page=daftar&alert='.base64_encode("error_file_type"));
						exit();
						$uploadOk = 0;
					}
					
					$cek_pin = mysqli_query($dbconnect,"SELECT * FROM `tbl_mahasiswa` WHERE `pin_krs`='$pin_krs'");
					$pin     = mysqli_num_rows($cek_pin);
					if ($pin == 0){
						header('location:?page=daftar&alert='.base64_encode("error_empty_pin"));
						exit();
					}else{
						$up_mahasiswa = mysqli_query($dbconnect,"UPDATE `tbl_mahasiswa` SET `no_tlp_mahasiswa`='$no_tlp_mahasiswa',`email_mahasiswa`='$email_mahasiswa' WHERE `id_mahasiswa`='$r_mahasiswa[id_mahasiswa]'") or die (mysqli_error($dbconnect));
					}
					
					if(move_uploaded_file($_FILES["savefilepersyaratan"]["tmp_name"], $target_file)) {
						
						$up_peserta = mysqli_query($dbconnect,"UPDATE `tbl_peserta` SET `id_mahasiswa`='$id_mahasiswa',`password`='$password',`confirm_password`='$confirm_password',`tahun_kkn`='$tahun_kkn',`status_peserta`='ubah',`tgl_daftar`='$tgl_daftar',`file_persyaratan`='$acakfilepersyaratan' WHERE `id_peserta`='$r_mahasiswa[id_peserta]'") or die (mysqli_error());
						if($up_peserta){
							header('location:?page=daftar&alert='.base64_encode("success_save_data"));
							exit();
						}else{
							header('location:?page=daftar&alert='.base64_encode("error_save_data"));
							exit();
						}
						
					}else{
						header('location:?page=daftar&alert='.base64_encode("error_save_data"));
						exit();
					}
			
			}elseif(empty($filepersyaratan)){
					header('location:?page=daftar&alert='.base64_encode("error_empty_file"));
					exit();
			}	
		}
		else{
			$cek_mahasiswa = mysqli_query($dbconnect,"SELECT * FROM `tbl_peserta` WHERE `id_mahasiswa`='$id_mahasiswa'") or die(mysqli_error($dbconnect));
			if(mysqli_num_rows($cek_mahasiswa)!=0){
				header('location:?page=daftar&alert='.base64_encode("error_duplicate_data"));
				exit();
			}else{	
				if(!empty($filepersyaratan)){	
					
					if($imageFileType != "pdf" && $imageFileType != "PDF") {
						header('location:?page=daftar&alert='.base64_encode("error_file_type"));
						exit();
						$uploadOk = 0;
					}
				
					$cek_pin = mysqli_query($dbconnect,"SELECT * FROM `tbl_mahasiswa` WHERE `pin_krs`='$pin_krs'");
					$pin     = mysqli_num_rows($cek_pin);
					if ($pin == 0){
						header('location:?page=daftar&alert='.base64_encode("error_empty_pin"));
						exit();
					}else{
						$up_mahasiswa = mysqli_query($dbconnect,"UPDATE `tbl_mahasiswa` SET `no_tlp_mahasiswa`='$no_tlp_mahasiswa',`email_mahasiswa`='$email_mahasiswa' WHERE `id_mahasiswa`='$id_mahasiswa'") or die (mysqli_error($dbconnect));
					}
					
					if(move_uploaded_file($_FILES["savefilepersyaratan"]["tmp_name"], $target_file)) {								
					$in_peserta = mysqli_query($dbconnect,"INSERT INTO `tbl_peserta`(`id_mahasiswa`,`password`,`confirm_password`, `tahun_kkn`,`status_peserta`,`tgl_daftar`, `file_persyaratan`) VALUES ('$id_mahasiswa','$password','$confirm_password','$tahun_kkn','tidak','$tgl_daftar','$acakfilepersyaratan')") or die (mysqli_error());
						if($in_peserta){
							header('location:?page=daftar&alert='.base64_encode("success_save_data"));
							exit();
						}else{
							header('location:?page=daftar&alert='.base64_encode("error_save_data"));
							exit();
						}
						
					}else{
						header('location:?page=daftar&alert='.base64_encode("error_save_data"));
						exit();
					}
				
				}elseif(empty($filepersyaratan)){
					header('location:?page=daftar&alert='.base64_encode("error_empty_file"));
					exit();
				}	
			}
		}
	}	
}
/***********************************************************************
	UBAH STATUS PESERTA
***********************************************************************
if(isset($_POST['ubah_status_peserta'])){
	
	$id_peserta     = $_POST['id_peserta'];
	
	$up_status = mysqli_query($dbconnect,"UPDATE `tbl_peserta` SET `status_peserta`='sudah' WHERE `id_peserta`='$id_peserta'") or die (mysqli_error());
	if($up_status){
		header('location:?page=peserta&success_edit_data');
		exit();
	}else{
		header('location:?page=peserta&error_edit_data');
		exit();
	}
}
/***********************************************************************
	TAMBAH KELOMPOK
***********************************************************************/
if(isset($_POST['simpan_kelompok'])){
	
	$id_lokasi 	        = $_POST['id_lokasi'];
	$id_dpl_1 	        = $_POST['id_dpl_1'];
	$id_dpl_2 	        = $_POST['id_dpl_2'];
	$id_peserta	        = $_POST['id_peserta'];
	$id_prodi	        = $_POST['id_prodi'];
	$nama_kelompok      = $_POST['nama_kelompok'];
	$tahun_kkn     		= $_POST['tahun_kkn'];
	
	$tgl_pembekalan     = $_POST['tgl_pembekalan'];
	
	if(!empty($_POST['id_kelompok'])){
		$id_has_peserta = $_POST['id_has_peserta'];
		$id_has_dpl_1   = $_POST['id_has_dpl_1'];
		$id_has_dpl_2   = $_POST['id_has_dpl_2'];
		$id_jadwal      = $_POST['id_jadwal'];
		$up_kelompok    = mysqli_query($dbconnect,"UPDATE `tbl_kelompok` SET `id_lokasi`='$id_lokasi',`id_prodi`='$id_prodi' WHERE `id_kelompok`='$_POST[id_kelompok]'") or die(mysqli_error($dbconnect));
		if($up_kelompok){
			$up_dpl_1   = mysqli_query($dbconnect,"UPDATE `tbl_has_dpl` SET `id_dpl`='$id_dpl_1' WHERE `id_has_dpl`='$id_has_dpl_1'") or die (mysqli_error());
			
			$up_dpl_2   = mysqli_query($dbconnect,"UPDATE `tbl_has_dpl` SET `id_dpl`='$id_dpl_2' WHERE `id_has_dpl`='$id_has_dpl_2'") or die (mysqli_error());
			if($up_dpl_1 AND $up_dpl_2){
				$up_hpeserta = mysqli_query($dbconnect,"UPDATE `tbl_has_peserta` SET `id_peserta`='$id_peserta' WHERE `id_has_peserta`='$id_has_peserta'") or die(mysqli_error($dbconnect));
				if($up_hpeserta){
					$up_jadwal  = mysqli_query($dbconnect,"UPDATE `tbl_jadwal` SET `tgl_jadwal`='$tgl_pembekalan' WHERE `id_jadwal`='$id_jadwal'") or die (mysqli_error());
					if($up_jadwal){
						header('location:?page=kelompok&success_edit_data');
						exit();
					}else{
						header('location:?page=kelompok&error_edit_data');
						exit();
					}
				}else{
					header('location:?page=kelompok&error_edit_data');
					exit();
				}
			}else{
				header('location:?page=kelompok&error_edit_data');
				exit();
			}
		}else{
			header('location:?page=kelompok&error_edit_data');
			exit();
		}			
	}elseif(empty($_POST['id_kelompok'])){
		$cek_hpeserta = mysqli_query($dbconnect,"SELECT * FROM `tbl_has_peserta` WHERE `id_peserta`='$id_peserta'") or die(mysqli_error($dbconnect));
		if(mysqli_num_rows($cek_hpeserta)!=0){
			header('location:?page=kelompok&error_duplicate_data');
			exit();
		}else{
			$cek_lokasi = mysqli_query($dbconnect,"SELECT * FROM `tbl_kelompok` WHERE `id_lokasi`='$id_lokasi'") or die(mysqli_error($dbconnect));
			if(mysqli_num_rows($cek_lokasi)!=0){
				header('location:?page=kelompok&error_duplicate_data');
				exit();
			}else{
				$in_kelompok = mysqli_query($dbconnect,"INSERT INTO `tbl_kelompok`(`id_lokasi`, `id_prodi`, `nama_kelompok`, `tahun_kkn`) VALUES ('$id_lokasi','$id_prodi','$nama_kelompok','$tahun_kkn')") or die (mysqli_error());
				$id_kelompok = mysqli_insert_id($dbconnect);
				if($in_kelompok){
					$in_dpl_1  = mysqli_query($dbconnect,"INSERT INTO `tbl_has_dpl`(`id_kelompok`, `id_dpl`, `status_has_dpl`) VALUES ('$id_kelompok','$id_dpl_1','dpl1')") or die (mysqli_error());
					
					$in_dpl_2  = mysqli_query($dbconnect,"INSERT INTO `tbl_has_dpl`(`id_kelompok`, `id_dpl`, `status_has_dpl`) VALUES ('$id_kelompok','$id_dpl_2','dpl2')") or die (mysqli_error());
					if($in_dpl_1 AND $in_dpl_2){
						$in_anggota = mysqli_query($dbconnect,"INSERT INTO `tbl_has_peserta`(`id_kelompok`, `id_peserta`, `status_has_peserta`) VALUES ('$id_kelompok','$id_peserta','ketua')") or die (mysqli_error());
						if($in_anggota){
							$in_jadwal  = mysqli_query($dbconnect,"INSERT INTO `tbl_jadwal`(`id_kelompok`, `tgl_jadwal`, `status_jadwal`) VALUES ('$id_kelompok','$tgl_pembekalan','pembekalan')");
							if($in_jadwal){
								header('location:?page=detail-kelompok&kelompok='.$id_kelompok.'&success_save_data');
								exit();
							}else{
								header('location:?page=kelompok&error_save_data');
								exit();
							}
						}else{
							header('location:?page=kelompok&error_save_data');
							exit();
						}
					}else{
						header('location:?page=kelompok&error_save_data');
						exit();
					}
			}else{
				header('location:?page=kelompok&error_save_data');
				exit();
			}
			}
		}
	}else{
		header('location:?page=kelompok&error_save_data');
		exit();
	}	
		
}
/***********************************************************************
	TAMBAH DPL
***********************************************************************/
if(isset($_POST['simpan_dpl'])){
	
	$tahun_kkn    = $_POST['tahun_kkn'];
	$id_dosen     = $_POST['id_dosen'];
	$no_tlp_dosen = $_POST['no_tlp_dosen'];
	$email_dosen  = $_POST['email_dosen'];
	
	if(!empty($_POST['id_dpl'])){
		$up_kontak = mysqli_query($dbconnect,"UPDATE `tbl_dosen` SET `no_tlp_dosen`='$no_tlp_dosen',`email_dosen`='$email_dosen' WHERE `id_dosen`='$id_dosen'") or die(mysqli_error($dbconnect));
		if($up_kontak){
			header('location:?page=dpl&success_edit_data');
			exit();
		}else{
			header('location:?page=dpl&error_edit_data');
			exit();
		}
	}elseif(empty($_POST['id_dpl'])){
		$cek_kelompok = mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dosen`='$id_dosen' AND tahun_kkn='$tahun_kkn'") or die(mysqli_error($dbconnect));
		if(mysqli_num_rows($cek_kelompok)!=0){
			header('location:?page=dpl&error_duplicate_data');
			exit();
		}else{
			
			$r_dosen = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$id_dosen'"));		
			$confirm_password  	   = $r_dosen['nidn'];
			$password		       = md5($confirm_password);
				
			$in_dpl = mysqli_query($dbconnect,"INSERT INTO `tbl_dpl`(`id_dosen`,`password`, `confirm_password`, `tahun_kkn`) VALUES ('$id_dosen','$password','$confirm_password','$tahun_kkn')") or die(mysqli_error($dbconnect));
			if($in_dpl){
				$up_kontak = mysqli_query($dbconnect,"UPDATE `tbl_dosen` SET `no_tlp_dosen`='$no_tlp_dosen',`email_dosen`='$email_dosen' WHERE `id_dosen`='$id_dosen'") or die(mysqli_error($dbconnect));
				if($up_kontak){
					header('location:?page=dpl&success_save_data');
					exit();
				}else{
					header('location:?page=dpl&error_save_data');
					exit();
				}				
			}else{
				header('location:?page=dpl&error_save_data');
				exit();
			}
		}
	}else{
		header('location:?page=dpl&error_save_data');
		exit();
	}
}
/***********************************************************************
	TAMBAH ANGGOTA KELOMPOK
***********************************************************************/
if(isset($_POST['simpan_anggota'])){
	
	$id_peserta       = $_POST['id_peserta'];
	$id_kelompok      = $_POST['id_kelompok'];
	$status_hpeserta  = $_POST['status_has_peserta'];
	
	if(!empty($_POST['id_has_peserta'])){
		
	}elseif(empty($_POST['id_has_peserta'])){
		$cek_hpeserta = mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_peserta='$id_peserta'");
		if(mysqli_num_rows($cek_hpeserta)!=0){
			header('location:?page=detail-kelompok&kelompok='.$id_kelompok.'&error_duplicate_data');
			exit();
		}else{
			$in_anggota = mysqli_query($dbconnect,"INSERT INTO `tbl_has_peserta`(`id_kelompok`, `id_peserta`, `status_has_peserta`) VALUES ('$id_kelompok','$id_peserta','$status_hpeserta')") or die(mysqli_error($dbconnect));
			if($in_anggota){
				header('location:?page=detail-kelompok&kelompok='.$id_kelompok.'&success_save_data');
				exit();
			}else{
				header('location:?page=detail-kelompok&kelompok='.$id_kelompok.'&error_save_data');
				exit();
			}
			
		}
	}else{
		
	}
	
}
/***********************************************************************
	STATUS ALBUM
***********************************************************************/
if(isset($_GET['aksi_astatus'])=="ubah_astatus"){
	
	$id_album     = $_GET['album'];
	$status       = $_GET['status'];
	$tgl_post     = $tglsekarang;
	
	$q_status  = mysqli_query($dbconnect,"UPDATE `tbl_album` SET `tgl_post`='$tgl_post',`status_album`='$status' WHERE `id_album`='$id_album'")or die (mysqli_error());
	
		if($q_status){
			header('location:?page=galeri&success_edit_data');
			exit();	
		}else{
			header('location:?page=galeri&error_edit_data');
			exit();
		}

}
/***********************************************************************
	TAMBAH ALBUM
***********************************************************************/
if(isset($_POST['simpan_album'])){
	
	$judul_album = strtolower($_POST['judul_album']);
	$ket_album	 = strtolower($_POST['ket_album']);

	if(!empty($_POST['id_album'])){
		$up_album = mysqli_query($dbconnect,"UPDATE `tbl_album` SET `judul_album`='$judul_album', `ket_album`='$ket_album' WHERE `id_album`='$_POST[id_album]'");
		if($up_album){
			header('location:?page=galeri&success_edit_data');
			exit();
		}else{
			header('location:?page=galeri&error_edit_data');
			exit();
		}
	}elseif(empty($_POST['id_album'])){	

		if(!empty($_POST['id_kelompok']) && empty($_POST['id_admin'])){
			$iduser      = $_POST['id_kelompok'];
			$user        = "kelompok";
			$status		 = "belum";
		}elseif(empty($_POST['id_kelompok']) && !empty($_POST['id_admin'])){
			$iduser      = $_POST['id_admin'];
			$user        = "admin";
			$status		 = "sudah";
		}else{
			echo "";
		}
	
		$in_album = mysqli_query($dbconnect,"INSERT INTO `tbl_album`(`id_$user`, `judul_album`, `ket_album`, `tgl_post`, `status_album`) VALUES ('$iduser','$judul_album','$ket_album','$tglsekarang','$status')")or die(mysqli_error($dbconnect));
		$id_album = mysqli_insert_id($dbconnect);
		if($in_album){
			header('location:?page=galeri&album='.$id_album.'');
			exit();
		}else{
			header('location:?page=galeri&error_save_data');
			exit();
		}	
	}else{
		header('location:?page=galeri&error_save_data');
		exit();
	}	
}
/***********************************************************************
	TAMBAH FOTO
***********************************************************************/
if(isset($_GET['album'])): $id_album  	= $_GET['album']; endif;
	$valid_formats  = array("jpg", "png", "gif", "zip", "bmp");
	$max_file_size  = 1024*5000; //100 kb
	$path           = "../../setting/save/galeri/"; // Upload directory
	$count          = 0;

if(isset($_POST['save_photo'])){
	$count++; // Number of successfully uploaded files
	// Loop $_FILES to execute all files
	foreach ($_FILES['foto']['name'] as $f => $name) {     
	if ($_FILES['foto']['error'][$f] == 4) {
		continue; // Skip file if any error found
	}        
	if ($_FILES['foto']['error'][$f] == 0) {            
		if ($_FILES['foto']['size'][$f] > $max_file_size) {
			header('location:?page=galeri&error_images_size&album='.$id_album.'');
			continue; // Skip large files
		}
		elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
			header('location:?page=galeri&error_images_type&album='.$id_album.'');
			continue; // Skip invalid file formats
		}
		 
		else{ // No error found! Move uploaded files 			
			$acak           = rand(1,999999);
			$nama_file_unik = 'foto'.$acak.$name;
			if(move_uploaded_file($_FILES["foto"]["tmp_name"][$f], $path.$nama_file_unik)) {
				$query = mysqli_query($dbconnect,"INSERT INTO `tbl_foto`(`id_album`, `foto`) VALUES ('$id_album','$nama_file_unik')") or die (mysqli_error());
				if(!$query){
					header('location:?page=galeri&error_save_data&album='.$id_album.'');
					continue;
				}
				else{
					header('location:?page=galeri&success_save_data&album='.$id_album.'');
					continue;
				}
			}
		 }
	  }
   }
}
/***********************************************************************
	TAMBAH LOKASI
***********************************************************************/
if(isset($_POST['simpan_lokasi'])){
	
	$id_provinsi  = $_POST['id_provinsi'];
	$id_kota      = $_POST['id_kota'];
	$id_kecamatan = $_POST['id_kecamatan'];
	$id_kelurahan = $_POST['id_kelurahan'];
	
	$lat		  = $_POST['lat'];
	$lng		  = $_POST['lng'];
	
	$nip          = $_POST['nip'];	
	$acak         = rand(1,999999);
	
	if($nip == "-" || $nip == 0){
		$username 		  = "mitra".$acak;
		$confirm_password = $username;
		$password 		  = md5($confirm_password);
	}
	elseif($nip !== "-" || $nip !== 0){
		$username         = $nip;
		$confirm_password = $username;
		$password 		  = md5($confirm_password);
	}
	else{
		$username         = "mitra".$acak;
		$confirm_password = $username;
		$password 		  = md5($confirm_password);
	}
	
	$nama_mitra   = strtolower($_POST['nama_mitra']);
	$jk_mitra     = $_POST['jk_mitra'];
	$agama_mitra  = $_POST['agama_mitra'];
	$no_tlp_mitra = $_POST['no_tlp_mitra'];
	
	if(!empty($_POST['id_lokasi'])){
		$id_mitra = $_POST['id_mitra'];
		$up_lokasi= mysqli_query($dbconnect,"UPDATE `tbl_lokasi` SET `id_provinsi`='$id_provinsi',`id_kota`='$id_kota',`id_kecamatan`='$id_kecamatan',`id_kelurahan`='$id_kelurahan',`lat`='$lat',`lng`='$lng' WHERE `id_lokasi`='$_POST[id_lokasi]'") or die (mysqli_error());
		if($up_lokasi){
			$up_mitra = mysqli_query($dbconnect,"UPDATE `tbl_mitra` SET `id_lokasi`='$_POST[id_lokasi]',`nip`='$nip',`nama_mitra`='$nama_mitra',`jk_mitra`='$jk_mitra',`agama_mitra`='$agama_mitra',`no_tlp_mitra`='$no_tlp_mitra',`username`='$username',`password`='$password',`confirm_password`='$confirm_password' WHERE `id_mitra`='$id_mitra'") or die (mysqli_error());
			if($up_mitra){
				header('location:?page=lokasi&success_edit_data');
				exit();
			}else{
				header('location:?page=lokasi&error_edit_data');
				exit();
			}
		}else{
			header('location:?page=lokasi&error_edit_data');
			exit();
		}	
	}elseif(empty($_POST['id_lokasi'])){
		$in_lokasi = mysqli_query($dbconnect,"INSERT INTO `tbl_lokasi`(`id_provinsi`, `id_kota`, `id_kecamatan`, `id_kelurahan`, `lat`, `lng`) VALUES ('$id_provinsi','$id_kota','$id_kecamatan','$id_kelurahan','$lat','$lng')") or die (mysqli_error());
		$id_lokasi = mysqli_insert_id($dbconnect);
		if($in_lokasi){
			$in_mitra = mysqli_query($dbconnect,"INSERT INTO `tbl_mitra`(`id_lokasi`, `nip`, `nama_mitra`, `jk_mitra`, `agama_mitra`, `no_tlp_mitra`, `username`, `password`, `confirm_password`) VALUES ('$id_lokasi','$nip','$nama_mitra','$jk_mitra','$agama_mitra','$no_tlp_mitra','$username','$password','$confirm_password')") or die (mysqli_error());
			if($in_mitra){
				header('location:?page=lokasi&success_save_data');
				exit();
			}else{
				header('location:?page=lokasi&error_save_data');
				exit();
			}
		}else{
			header('location:?page=lokasi&error_save_data');
			exit();
		}
	}else{
		header('location:?page=lokasi&error_save_data');
		exit();
	}
}
/***********************************************************************
	SIMPAN PRODI
***********************************************************************/
if(isset($_POST['simpan_prodi'])){
	
	$id_pengaturan   = $_POST['id_pengaturan'];
	$nama_prodi      = $_POST['nama_prodi'];
	$singkatan_prodi = $_POST['singkatan_prodi'];
	
	if(!empty($_POST['id_prodi'])){
		$up_prodi = mysqli_query($dbconnect,"UPDATE `tbl_prodi` SET `nama_prodi`='$nama_prodi',`singkatan_prodi`='$singkatan_prodi' WHERE `id_prodi`='$_POST[id_prodi]'") or die (mysqli_error());
		if($up_prodi){
			header('location:?page=pengaturan&atur='.$id_pengaturan.'&success_edit_data');
			exit();
		}else{
			header('location:?page=pengaturan&atur='.$id_pengaturan.'&error_edit_data');
			exit();
		}
	}elseif(empty($_POST['id_prodi'])){
		$in_prodi = mysqli_query($dbconnect,"INSERT INTO `tbl_prodi`(`nama_prodi`,`singkatan_prodi`) VALUES ('$nama_prodi','$singkatan_prodi')") or die (mysqli_error());
		if($in_prodi){
			header('location:?page=pengaturan&atur='.$id_pengaturan.'&success_save_data');
			exit();
		}else{
			header('location:?page=pengaturan&atur='.$id_pengaturan.'&error_save_data');
			exit();
		}
	}else{
		header('location:?page=pengaturan&atur='.$id_pengaturan.'&error_save_data');
		exit();
	}
}
/***********************************************************************
	TAMBAH LEVEL
***********************************************************************/
if(isset($_POST['simpan_level'])){
		
	$id_pengaturan = $_POST['id_pengaturan'];
	$level   	   = strtolower($_POST['level']);
		
	if(!empty($_POST['id_level'])){
		$up_level = mysqli_query($dbconnect,"UPDATE `tbl_level` SET `level`='$level' WHERE `id_level`='$_POST[id_level]'") or die (mysqli_error());		
		if($up_level){
			header('location:?page=pengaturan&atur='.$id_pengaturan.'&success_edit_data');
			exit();	
		}else{
			header('location:?page=pengaturan&atur='.$id_pengaturan.'&error_edit_data');
			exit();
		}
	}elseif(empty($_POST['id_level'])){
		$in_level = mysqli_query($dbconnect, "INSERT INTO `tbl_level`(`level`,`status`) VALUES ('$level','Tidak')") or die (mysqli_error());		
		if($in_level){
			header('location:?page=pengaturan&atur='.$id_pengaturan.'&success_save_data');
			exit();	
		}else{
			header('location:?page=pengaturan&atur='.$id_pengaturan.'&error_save_data');
			exit();
		}
	}else{
		header('location:?page=pengaturan&atur='.$id_pengaturan.'&error_save_data');
		exit();
	}	

}

/***********************************************************************
	STATUS LEVEL
***********************************************************************/
if(isset($_GET['aksi_lstatus'])=="ubah_lstatus"){
	
	$status       = $_GET['status'];
	$id_level     = $_GET['level'];
	$id_atur      = $_GET['atur'];
	
	if($status == "aktif") { $statusl = "tidak"; }elseif($status == "tidak"){ $statusl = "aktif"; }
	
	$q_status  = mysqli_query($dbconnect,"UPDATE `tbl_level` SET `status`='$statusl' WHERE `id_level`='$id_level'")or die (mysqli_error());
	
		if($q_status){
			header('location:?page=pengaturan&atur='.$id_atur.'&success_edit_data');
			exit();	
		}else{
			header('location:?page=pengaturan&atur='.$id_atur.'&error_edit_data');
			exit();
		}

}
/***********************************************************************
	PENGATURAN
***********************************************************************/
if(isset($_POST['simpan_pengaturan'])){
	
	$id_pengaturan  = $_POST['id_pengaturan'];
	$tahun_kkn 		= $_POST['tahun_kkn'];
	$tahun_angkatan = $_POST['tahun_angkatan'];
	$alamat_stikom  = $_POST['alamat_stikom'];
	$no_tlp_stikom 	= $_POST['no_tlp_stikom'];
	$email_stikom 	= $_POST['email_stikom'];
	$website_stikom = $_POST['website_stikom'];
	$fax_stikom 	= $_POST['fax_stikom'];
	
	$tgl1 		    = $_POST['tgl1'];
	$bln1 			= $_POST['bln1'];
	$thn1	 		= $_POST['thn1'];
	$tgl_pembekalan = $thn1."-".$bln1."-".$tgl1;
	
	$tgl2 		    = $_POST['tgl2'];
	$bln2 			= $_POST['bln2'];
	$thn2	 		= $_POST['thn2'];
	$tgl_pelepasan  = $thn2."-".$bln2."-".$tgl2;
	
	$up_pengaturan  = mysqli_query($dbconnect,"UPDATE `tbl_pengaturan` SET 	`tahun_kkn`='$tahun_kkn', `tahun_angkatan`='$tahun_angkatan', `alamat_stikom`='$alamat_stikom', `no_tlp_stikom`='$no_tlp_stikom', `email_stikom`='$email_stikom', `website_stikom`='$website_stikom', `fax_stikom`='$fax_stikom', `tgl_pembekalan`='$tgl_pembekalan', `tgl_pelepasan`='$tgl_pelepasan' WHERE `id_pengaturan`='$id_pengaturan'") or die (mysqli_error());
	if($up_pengaturan){
		header('location:?page=pengaturan&atur='.$id_pengaturan.'&success_edit_data');
		exit();
	}else{
		header('location:?page=pengaturan&atur='.$id_pengaturan.'&error_edit_data');
		exit();
	}
	
}
/***********************************************************************
	SIMPAN KETUA PRODI
***********************************************************************/
if(isset($_POST['simpan_proprodi'])){
	
	$id_pengaturan    = $_POST['id_pengaturan'];
	$nidn		      = $_POST['nidn'];
	$nama_ketua_prodi = strtolower($_POST['nama_ketua_prodi']);
	
	$up_pengaturan  = mysqli_query($dbconnect,"UPDATE `tbl_pengaturan` SET `nidn`='$nidn', `nama_ketua_prodi`='$nama_ketua_prodi' WHERE `id_pengaturan`='$id_pengaturan'") or die (mysqli_error());
	if($up_pengaturan){
		header('location:?page=pengaturan&atur='.$id_pengaturan.'&success_edit_data');
		exit();
	}else{
		header('location:?page=pengaturan&atur='.$id_pengaturan.'&error_edit_data');
		exit();
	}
}
/***********************************************************************
	SIMPAN SMTP EMAIL
***********************************************************************/
if(isset($_POST['simpan_smtp'])){
	
	$id_pengaturan    = $_POST['id_pengaturan'];
	$email_smtp		  = strtolower($_POST['email_smtp']);
	$password_smtp    = $_POST['password_smtp'];
	$form_replay_name = strtolower($_POST['form_replay_name']);
	
	$up_pengaturan  = mysqli_query($dbconnect,"UPDATE `tbl_pengaturan` SET `email_smtp`='$email_smtp', `password_smtp`='$password_smtp', `form_replay_name`='$form_replay_name' WHERE `id_pengaturan`='$id_pengaturan'") or die (mysqli_error());
	if($up_pengaturan){
		header('location:?page=pengaturan&atur='.$id_pengaturan.'&success_edit_data');
		exit();
	}else{
		header('location:?page=pengaturan&atur='.$id_pengaturan.'&error_edit_data');
		exit();
	}
}
/***********************************************************************
	PARAF
***********************************************************************/
if(isset($_POST['simpan_paraf'])){
	
	
	$status = $_POST['status'];
	
	if($status == "peserta"){
		$id_pemaraf = $_POST['id_peserta'];
		$paraf		= $_POST['paraf_peserta'];
		$page       = "profil-peserta";
	}
	elseif($status == "dpl"){
		$id_pemaraf = $_POST['id_dpl'];
		$paraf		= $_POST['paraf_dpl'];
		$page       = "profil-dpl";
	}
	
	$up_paraf      = mysqli_query($dbconnect,"UPDATE `tbl_$status` SET `paraf_$status`='$paraf' WHERE `id_$status`='$id_pemaraf'") or die (mysqli_error());
	if($up_paraf){
		header('location:?page='.$page.'&profil='.$id_pemaraf.'&success_edit_data');
		exit();
	}else{
		header('location:?page='.$page.'&profil='.$id_pemaraf.'&error_edit_data');
		exit();
	}
	
}
/***********************************************************************
	JADWAL
***********************************************************************/
if(isset($_POST['simpan_jadwal'])){
	
	$id_kelompok    = $_POST['id_kelompok'];
	$status_jadwal  = $_POST['status_jadwal'];
	$tgl 		    = $_POST['tgl'];
	$bln 		    = $_POST['bln'];
	$thn	 	    = $_POST['thn'];
	$tgl_jadwal     = $thn."-".$bln."-".$tgl;
	
	if(!empty($_POST['id_jadwal'])){
		$up_jadwal  = mysqli_query($dbconnect,"UPDATE `tbl_jadwal` SET `tgl_jadwal`='$tgl_jadwal',`status_jadwal`='$status_jadwal' WHERE `id_jadwal`='$_POST[id_jadwal]'") or die (mysqli_error());
		if($up_jadwal){
			header('location:?page=detail-kelompok&kelompok='.$id_kelompok.'&success_edit_data');
			exit();
		}else{
			header('location:?page=detail-kelompok&kelompok='.$id_kelompok.'&error_edit_data');
			exit();
		}
	}elseif(empty($_POST['id_jadwal'])){
		$in_jadwal  = mysqli_query($dbconnect,"INSERT INTO `tbl_jadwal`(`id_kelompok`, `tgl_jadwal`, `status_jadwal`) VALUES ('$id_kelompok','$tgl_jadwal','$status_jadwal')");
		if($in_jadwal){
			header('location:?page=detail-kelompok&kelompok='.$id_kelompok.'&success_save_data');
			exit();
		}else{
			header('location:?page=detail-kelompok&kelompok='.$id_kelompok.'&error_save_data');
			exit();
		}
	}else{
		header('location:?page=detail-kelompok&kelompok='.$id_kelompok.'&error_save_data');
		exit();
	}
	
}
/***********************************************************************
	ABSEN
***********************************************************************/
if(isset($_GET['aksi_mstatus'])=="ubah_mstatus"){
	
	$status     = $_GET['status'];
	$id_jadwal  = $_GET['jadwal'];
	$id_peserta = $_GET['peserta'];
	
	$in_absen   = mysqli_query($dbconnect,"INSERT INTO `tbl_absen`(`id_jadwal`, `id_peserta`, `status_absen`) VALUES ('$id_jadwal','$id_peserta','$status')") or die (mysqli_error());
	if($status){
		header('location:?page=absen&absen='.$id_jadwal.'&success_edit_data');
		exit();
	}else{
		header('location:?page=absen&absen='.$id_jadwal.'&error_edit_data');
		exit();
	}
	
}
if(isset($_GET['aksi_pstatus'])=="ubah_pstatus"){
	
	$status     = $_GET['status'];
	$id_jadwal  = $_GET['jadwal'];
	$id_peserta = $_GET['peserta'];
	
	$in_absen   = mysqli_query($dbconnect,"INSERT INTO `tbl_absen`(`id_jadwal`, `id_peserta`, `status_absen`) VALUES ('$id_jadwal','$id_peserta','$status')") or die (mysqli_error());
	if($status){
		header('location:?page=absen-peserta&absen='.$id_jadwal.'&success_edit_data');
		exit();
	}else{
		header('location:?page=absen-peserta&absen='.$id_jadwal.'&error_edit_data');
		exit();
	}
	
}
/***********************************************************************
	LOGBOOK MANDIRI
***********************************************************************/
if(isset($_POST['simpan_logbook'])){
	
	$id_peserta      = $_POST['id_peserta'];
	$id_kelompok     = $_POST['id_kelompok'];
	$catatan         = strtolower($_POST['catatan']);
	$tgl 		     = $_POST['tgl'];
	$bln 		     = $_POST['bln'];
	$thn	 	     = $_POST['thn'];
	$tgl_pengisian   = $thn."-".$bln."-".$tgl;
	$tahun_kkn       = $_POST['tahun_kkn'];
	$status_logbook  = strtolower($_POST['status_logbook']);
	
	if($status_logbook == "mandiri"){
		$page = "lbmandiri";
	}
	elseif($status_logbook == "kelompok"){
		$page = "lbkelompok";
	}else{
		$page = "";
	}

	$waktu_kegiatan1 = $_POST['mulai1']." - ".$_POST['akhir1'];
	$waktu_kegiatan2 = $_POST['mulai2']." - ".$_POST['akhir2'];
	$waktu_kegiatan3 = $_POST['mulai3']." - ".$_POST['akhir3'];
	$waktu_kegiatan4 = $_POST['mulai4']." - ".$_POST['akhir4'];
	
	$kegiatan1       = strtolower($_POST['kegiatan1']);
	$kegiatan2       = strtolower($_POST['kegiatan2']);
	$kegiatan3       = strtolower($_POST['kegiatan3']);
	$kegiatan4       = strtolower($_POST['kegiatan4']);
	
	if(!empty($_POST['id_logbook'])){
		$up_logbook = mysqli_query($dbconnect,"UPDATE `tbl_logbook` SET `catatan`='$catatan',`tgl_pengisian`='$tgl_pengisian' WHERE `id_logbook`='$_POST[id_logbook]'") or die (mysqli_error());
		if($up_logbook){
			$up_kpagi  = mysqli_query($dbconnect,"UPDATE `tbl_has_logbook` SET `kegiatan`='$kegiatan1',`waktu_kegiatan`='$waktu_kegiatan1' WHERE `id_has_logbook`='$_POST[id_has_logbook1]'") or die (mysqli_error($dbconnect));
			
			$up_ksiang = mysqli_query($dbconnect,"UPDATE `tbl_has_logbook` SET `kegiatan`='$kegiatan2',`waktu_kegiatan`='$waktu_kegiatan2' WHERE `id_has_logbook`='$_POST[id_has_logbook2]'") or die (mysqli_error($dbconnect));
			
			$up_ksore  = mysqli_query($dbconnect,"UPDATE `tbl_has_logbook` SET `kegiatan`='$kegiatan3',`waktu_kegiatan`='$waktu_kegiatan3' WHERE `id_has_logbook`='$_POST[id_has_logbook3]'") or die (mysqli_error($dbconnect));
			
			$up_kmalam = mysqli_query($dbconnect,"UPDATE `tbl_has_logbook` SET `kegiatan`='$kegiatan4',`waktu_kegiatan`='$waktu_kegiatan4' WHERE `id_has_logbook`='$_POST[id_has_logbook4]'") or die (mysqli_error($dbconnect));
			if($up_kpagi AND $up_ksiang AND $up_ksore AND $up_kmalam){
				header('location:?page='.$page.'&success_edit_data');
				exit();
			}else{
				header('location:?page='.$page.'&error_edit_data');
				exit();
			}
		}else{
			header('location:?page='.$page.'&error_edit_data');
			exit();
		}
	}elseif(empty($_POST['id_logbook'])){
		$cek_tgl = mysqli_query($dbconnect,"SELECT * FROM tbl_logbook WHERE tgl_pengisian='$tgl_pengisian' AND status_logbook='$status_logbook'");
		if(mysqli_num_rows($cek_tgl)!=0){
			header('location:?page='.$page.'&error_duplicate_data');
			exit();
		}else{
			$in_logbook = mysqli_query($dbconnect,"INSERT INTO `tbl_logbook`(`id_peserta`, `id_kelompok`, `catatan`, `tgl_pengisian`, `status_logbook`, `tahun_kkn`) VALUES ('$id_peserta','$id_kelompok','$catatan','$tgl_pengisian','$status_logbook','$tahun_kkn')") or die (mysqli_error());
			$id_logbook = mysqli_insert_id($dbconnect);
			if($in_logbook){
				$in_has_logbook = mysqli_query($dbconnect,"INSERT INTO `tbl_has_logbook`(`id_logbook`, `kegiatan`, `waktu_kegiatan`, `status_waktu`) VALUES ('$id_logbook','$kegiatan1','$waktu_kegiatan1','pagi'),('$id_logbook','$kegiatan2','$waktu_kegiatan2','siang'),('$id_logbook','$kegiatan3','$waktu_kegiatan3','sore'),('$id_logbook','$kegiatan4','$waktu_kegiatan4','malam')") or die (mysqli_error());
				if($in_has_logbook){
					header('location:?page='.$page.'&success_save_data');
					exit();
				}else{
					header('location:?page='.$page.'&error_save_data');
					exit();
				}
			}else{
				header('location:?page='.$page.'&error_save_data');
				exit();
			}
		}
	}else{
		header('location:?page='.$page.'&error_save_data');
		exit();
	}
	
}
/***********************************************************************
	NILAI PB
***********************************************************************/
if(isset($_POST['simpan_nilaipb'])){
	
	$id_peserta     = $_POST['id_peserta'];
	$id_jadwal      = $_POST['id_jadwal'];
	$id_kelompok    = $_POST['id_kelompok'];
	$id_dpl         = $_POST['id_dpl'];
	$status_penilai = $_POST['status_penilai'];
	$nilai_pb       = $_POST['nilai_pb'];
	
	if(!empty($_POST['id_nilai'])){
		$up_nilaipb  = mysqli_query($dbconnect,"UPDATE `tbl_nilai_pb` SET `nilai_pb`='$nilai_pb' WHERE `id_nilai`='$_POST[id_nilai]'") or die (mysqli_error());
		if($up_nilaipb){
			header('location:?page=nilai-pb&kelompok='.$id_kelompok.'&success_edit_data');
			exit();
		}else{
			header('location:?page=nilai-pb&kelompok='.$id_kelompok.'&error_edit_data');
			exit();
		}
	}elseif(empty($_POST['id_nilai'])){
		$in_nilaipb  = mysqli_query($dbconnect,"INSERT INTO `tbl_nilai_pb`(`id_dpl`, `id_jadwal`, `id_peserta`, `id_kelompok`, `nilai_pb`, `status_penilai`) VALUES ('$id_dpl','$id_jadwal','$id_peserta','$id_kelompok','$nilai_pb','$status_penilai')") or die (mysqli_error());
		if($in_nilaipb){
			header('location:?page=nilai-pb&kelompok='.$id_kelompok.'&success_save_data');
			exit();
		}else{
			header('location:?page=nilai-pb&kelompok='.$id_kelompok.'&error_save_data');
			exit();
		}
	}else{
		header('location:?page=nilai-pb&kelompok='.$id_kelompok.'&error_save_data');
		exit();
	}

	
	/**
	
	if($status_has_dpl=='dpl1'){
		$dpl='dpl2';
	}
	else{
		$dpl='dpl1';
	}
	
	$q_cek		  = mysqli_query($dbconnect,"SELECT * FROM `tbl_nilai_pb` WHERE `id_dpl`='$id_dpl' AND `id_peserta`='$id_peserta' AND `id_kelompok`='$id_kelompok' AND `status`='$dpl'");
	$cek		  = mysqli_fetch_array($q_cek);
	$jcek         = mysqli_num_rows($q_cek);
	
	if($jcek!==0){
		$q_cekn1  = mysqli_query($dbconnect,"SELECT * FROM `tbl_nilai_pb` WHERE `id_dpl`='$id_dpl' AND `id_peserta`='$id_peserta' AND `id_kelompok`='$id_kelompok'");
		$cekn1    = mysqli_fetch_array($q_cekn1);
		
		$ndpl1	  = $cek['nilai_pb'];
		$ndpl2    = $cekn1['nilai_pb'];
		
		$rata2=($ndpl1+$ndpl2)/2;
		$in_rata2 = mysqli_query($dbconnect,"INSERT INTO `tbl_total_nilai`(`id_nilai_pb`, `total_nilai`, `status_nilai`) VALUES ('$')") or die (mysqli_error());
	}
	
	**/
	

	
}
/***********************************************************************
	NILAI UK
***********************************************************************/
if(isset($_POST['simpan_nilaiuklpk'])){
	
	$id_kelompok    = $_POST['id_kelompok'];
	$id_dpl         = $_POST['id_dpl'];
	$status_penilai = $_POST['status_penilai'];
	
	$nilai1         = $_POST['nilai1'];
	$nilai2         = $_POST['nilai2'];
	$nilai3         = $_POST['nilai3'];
	
	$status_nilai   = $_POST['status_nilai'];
	
	if($status_nilai == "nilaiuk"){
		$statusnilai = "nilaiuk";
		$page        = "nilai-uk";
	}
	elseif($status_nilai == "nilailpk"){
		$statusnilai = "nilailpk";
		$page        = "nilai-lpk";
	}
	else{
		$statusnilai = "";
		$page        = "";
	}

	if(!empty($_POST['id_nilai'])){
		$up_nilai = mysqli_query($dbconnect,"UPDATE `tbl_nilai_uk_lpk` SET `nilai1`='$nilai1',`nilai2`='$nilai2',`nilai3`='$nilai3' WHERE `id_nilai`='$_POST[id_nilai]'") or die (mysqli_error());
		if($up_nilai){
			header('location:?page='.$page.'&kelompok='.$id_kelompok.'&success_edit_data');
			exit();
		}else{
			header('location:?page='.$page.'&kelompok='.$id_kelompok.'&error_edit_data');
			exit();
		}
	}elseif(empty($_POST['id_nilai'])){
		$in_nilai = mysqli_query($dbconnect,"INSERT INTO `tbl_nilai_uk_lpk`(`id_dpl`, `id_kelompok`, `nilai1`, `nilai2`, `nilai3`, `status_penilai`,`status_nilai`) VALUES ('$id_dpl','$id_kelompok','$nilai1','$nilai2','$nilai3','$status_penilai','$statusnilai')") or die (mysqli_error());
		if($in_nilai){
			header('location:?page='.$page.'&kelompok='.$id_kelompok.'&success_save_data');
			exit();
		}else{
			header('location:?page='.$page.'&kelompok='.$id_kelompok.'&error_save_data');
			exit();
		}
	}else{
		header('location:?page='.$page.'&kelompok='.$id_kelompok.'&error_save_data');
		exit();
	}
	
}
/***********************************************************************
	NILAI KM
***********************************************************************/
if(isset($_POST['simpan_nilaikm'])){
	
	
	$id_kelompok    = $_POST['id_kelompok'];
	$id_jadwal      = $_POST['id_jadwal'];
	$id_peserta     = $_POST['id_peserta'];
	$status_jadwal  = $_POST['status_jadwal'];
	
	$status_penilai = $_POST['status_penilai'];
	
	if($status_penilai == "dpl1" || $status_penilai == "dpl2" || $status_penilai !== "mitra"){
		$status		= "dpl";
		$id_penilai = $_POST['id_dpl'];	
	}
	elseif($status_penilai !== "dpl1" || $status_penilai !== "dpl2" || $status_penilai == "mitra"){
		$status		= "mitra";
		$id_penilai = $_POST['id_mitra'];	
	}
	
	$nilai_ds       = $_POST['nilai_ds'];
	$nilai_ks       = $_POST['nilai_ks'];

	if(!empty($_POST['id_nilai'])){
		$up_nilai = mysqli_query($dbconnect,"UPDATE `tbl_nilai_km` SET `nilai_ds`='$nilai_ds', `nilai_ks`='$nilai_ks' WHERE `id_nilai`='$_POST[id_nilai]'") or die (mysqli_error());
		if($up_nilai){
			header('location:?page=nilai-km&absen='.$id_jadwal.'&kelompok='.$id_kelompok.'&monev='.$status_jadwal.'&success_edit_data');
			exit();
		}else{
			header('location:?page=nilai-km&absen='.$id_jadwal.'&kelompok='.$id_kelompok.'&monev='.$status_jadwal.'&error_edit_data');
			exit();
		}
	}elseif(empty($_POST['id_nilai'])){
		$in_nilai = mysqli_query($dbconnect,"INSERT INTO `tbl_nilai_km`(`id_jadwal`, `id_$status`, `id_peserta`, `id_kelompok`, `nilai_ds`, `nilai_ks`, `status_penilai`) VALUES ('$id_jadwal','$id_penilai','$id_peserta','$id_kelompok','$nilai_ds','$nilai_ks','$status_penilai')") or die (mysqli_error());
		if($in_nilai){
			header('location:?page=nilai-km&absen='.$id_jadwal.'&kelompok='.$id_kelompok.'&monev='.$status_jadwal.'&success_save_data');
			exit();
		}else{
			header('location:?page=nilai-km&absen='.$id_jadwal.'&kelompok='.$id_kelompok.'&monev='.$status_jadwal.'&error_save_data');
			exit();
		}
	}else{
		header('location:?page=nilai-km&absen='.$id_jadwal.'&kelompok='.$id_kelompok.'&monev='.$status_jadwal.'&error_save_data');
		exit();
	}
	
}

/***********************************************************************
	NILAI PL
***********************************************************************/
if(isset($_POST['simpan_nilaipl'])){
	
	$id_kelompok    = $_POST['id_kelompok'];
	$id_dpl         = $_POST['id_dpl'];
	$id_jadwal      = $_POST['id_jadwal'];
	$id_peserta     = $_POST['id_peserta'];
	$status_penilai = $_POST['status_penilai'];
	$status_jadwal  = $_POST['status_jadwal'];
	
	$nilai_pl        = $_POST['nilai_pl'];

	if(!empty($_POST['id_nilai'])){
		$up_nilai = mysqli_query($dbconnect,"UPDATE `tbl_nilai_pl` SET `nilai_pl`='$nilai_pl' WHERE `id_nilai`='$_POST[id_nilai]'") or die (mysqli_error());
		if($up_nilai){
			header('location:?page=nilai-pl&absen='.$id_jadwal.'&kelompok='.$id_kelompok.'&monev='.$status_jadwal.'&success_edit_data');
			exit();
		}else{
			header('location:?page=nilai-pl&absen='.$id_jadwal.'&kelompok='.$id_kelompok.'&monev='.$status_jadwal.'&error_edit_data');
			exit();
		}
	}elseif(empty($_POST['id_nilai'])){
		$in_nilai = mysqli_query($dbconnect,"INSERT INTO `tbl_nilai_pl`(`id_jadwal`, `id_dpl`, `id_peserta`, `id_kelompok`, `nilai_pl`, `status_penilai`) VALUES ('$id_jadwal','$id_dpl','$id_peserta','$id_kelompok','$nilai_pl','$status_penilai')") or die (mysqli_error());
		if($in_nilai){
			header('location:?page=nilai-pl&absen='.$id_jadwal.'&kelompok='.$id_kelompok.'&monev='.$status_jadwal.'&success_save_data');
			exit();
		}else{
			header('location:?page=nilai-pl&absen='.$id_jadwal.'&kelompok='.$id_kelompok.'&monev='.$status_jadwal.'&error_save_data');
			exit();
		}
	}else{
		header('location:?page=nilai-pl&absen='.$id_jadwal.'&kelompok='.$id_kelompok.'&monev='.$status_jadwal.'&error_save_data');
		exit();
	}
}
/***********************************************************************
	SIMPAN FOTO MITRA
***********************************************************************/
if(isset($_POST['simpan_fotomitra'])){
		
	$savefotomitra = $_POST ['savefotomitra'];
	$fotomitra     = $_FILES["savefotomitra"]["name"];
	
	$target_dir    = "../../setting/save/mitra/";	
	
	$acak       	       = rand(1,999999);
	$acakfotomitra = 'foto'.$acak.$fotomitra;
	$target_file   = $target_dir.$acakfotomitra.basename($_FILES["savefotomitra"]);
	$uploadOk 	   = 1;

	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$uploadOk 	   = 1;

	if ($uploadOk == 0) {
		header('location:?page=profil-mitra&profil='.$_POST['id_mitra'].'&error_file_upload');
		exit();
	}else{
		if(!empty($_POST['id_mitra'])){
			
			if(!empty($fotomitra)){
				if($imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "jpeg" && $imageFileType != "JPEG") {
					header('location:?page=profil-mitra&profil='.$_POST['id_mitra'].'&error_images_type');
					exit();
					$uploadOk = 0;
				}
				
				if (move_uploaded_file($_FILES["savefotomitra"]["tmp_name"], $target_file)) {
					$up_mitra = mysqli_query($dbconnect,"UPDATE `tbl_mitra` SET `foto_mitra`='$acakfotomitra' WHERE `id_mitra`='$_POST[id_mitra]'") or die (mysqli_error());
					if($up_mitra){
						header('location:?page=profil-mitra&profil='.$_POST['id_mitra'].'&success_edit_data');
						exit();
					}else{
						header('location:?page=profil-mitra&profil='.$_POST['id_mitra'].'&error_edit_data');
						exit();
					}
				}else{
					header('location:?page=profil-mitra&profil='.$_POST['id_mitra'].'&error_save_data');
					exit();
				}
				
			}else{
				header('location:?page=profil-mitra&profil='.$_POST['id_mitra'].'&error_save_data');
				exit();
			}

		}else{
			header('location:?page=profil-mitra&profil='.$_POST['id_mitra'].'&error_save_data');
			exit();
		}
	}
}
/***********************************************************************
	SIMPAN SURAT PESERTA
***********************************************************************/
if(isset($_POST['simpan_surat'])){
		
		
	$id_peserta       = $_POST['id_peserta'];	
	$id_jadwal        = $_POST['id_jadwal'];	
	
	$status_absen     = $_POST['status_absen'];	
	$savesuratpeserta = $_POST ['savesuratpeserta'];
	$suratpeserta     = $_FILES["savesuratpeserta"]["name"];
	
	$target_dir       = "../../setting/save/surat/";	
	
	$acak       	  = rand(1,999999);
	$acaksuratpeserta = 'file'.$acak.$suratpeserta;
	$target_file   = $target_dir.$acaksuratpeserta.basename($_FILES["savesuratpeserta"]);
	$uploadOk 	   = 1;

	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$uploadOk 	   = 1;

	if ($uploadOk == 0) {
		header('location:?page=absen-peserta&absen='.$id_jadwal.'&error_file_upload');
		exit();
	}else{			
			if(!empty($suratpeserta)){
				if($imageFileType != "pdf" && $imageFileType != "PDF") {
					header('location:?page=absen-peserta&absen='.$id_jadwal.'&error_images_type');
					exit();
					$uploadOk = 0;
				}
				
				if (move_uploaded_file($_FILES["savesuratpeserta"]["tmp_name"], $target_file)) {
					$in_surta = mysqli_query($dbconnect,"INSERT INTO `tbl_absen`(`id_jadwal`, `id_peserta`, `status_absen`, `surat_peserta`) VALUES ('$id_jadwal','$id_peserta','$status_absen','$acaksuratpeserta')") or die (mysqli_error());
					if($in_surta){
						header('location:?page=absen-peserta&absen='.$id_jadwal.'&success_save_data');
						exit();
					}else{
						header('location:?page=absen-peserta&absen='.$id_jadwal.'&error_save_data');
						exit();
					}
				}else{
					header('location:?page=absen-peserta&absen='.$id_jadwal.'&error_save_data');
					exit();
				}
				
			}else{
				header('location:?page=absen-peserta&absen='.$id_jadwal.'&error_save_data');
				exit();
			}

	}
}
/***********************************************************************
	SIMPAN SYARAT
***********************************************************************/
if(isset($_POST['simpan_syarat'])){
	
	$id_pengaturan    = $_POST['id_pengaturan'];
	$syarat  		  = $_POST['syarat'];
	
	$up_pengaturan  = mysqli_query($dbconnect,"UPDATE `tbl_pengaturan` SET `syarat`='$syarat'  WHERE `id_pengaturan`='$id_pengaturan'") or die (mysqli_error());
	if($up_pengaturan){
		header('location:?page=pengaturan&atur='.$id_pengaturan.'&success_edit_data');
		exit();
	}else{
		header('location:?page=pengaturan&atur='.$id_pengaturan.'&error_edit_data');
		exit();
	}
}
?>