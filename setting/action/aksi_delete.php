<?php
if(isset($_GET['del']))
	
	$id = $_GET['del'];

if(isset($_GET['data'])){	
	switch($_GET['data']){
		
		/***********************************************************************
			DELETE LAINNYA
		***********************************************************************/
		
		case 'anggota':
			$id_kelompok=$_GET['id'];
			mysqli_query($dbconnect,"DELETE FROM tbl_has_peserta WHERE id_has_peserta='$id'");
			header('location:?page=detail-kelompok&kelompok='.$id_kelompok.'&success_delete_data');
		break;
		case 'jadwal':
			$id_kelompok=$_GET['id'];
			$q_dabsen = mysqli_query($dbconnect,"SELECT * FROM tbl_absen WHERE id_jadwal='$id'"); 
			while($r_dabsen = mysqli_fetch_array($q_dabsen)){
				mysqli_query($dbconnect,"DELETE FROM tbl_absen WHERE id_absen='$r_dabsen[id_absen]'");
			}
			mysqli_query($dbconnect,"DELETE FROM tbl_jadwal WHERE id_jadwal='$id'");
			header('location:?page=detail-kelompok&kelompok='.$id_kelompok.'&success_delete_data');
		break;
		case 'foto':
			$id_album = $_GET['id'];
			$del_foto = mysqli_fetch_row(mysqli_query($dbconnect,"SELECT foto FROM tbl_foto WHERE id_foto='$id'"));
			unlink("../../setting/save/galeri/$del_foto[0]");
			
			mysqli_query($dbconnect,"DELETE FROM tbl_foto WHERE id_foto='$id'");
			header('location:?page=galeri&album='.$id_album.'&success_delete_data');
		break;
		case 'album':
			mysqli_query($dbconnect,"DELETE FROM tbl_album WHERE id_album='$id'");
			$q_dfoto = mysqli_query($dbconnect,"SELECT * FROM tbl_foto WHERE id_album='$id'");
			while($r_dfoto = mysqli_fetch_row($q_dfoto)){
				$id_foto  = $r_dfoto[0];
				mysqli_query($dbconnect,"DELETE FROM tbl_foto WHERE id_foto='$id_foto'");
				unlink("../../setting/save/galeri/$r_dfoto[2]");
			}
			header('location:?page=galeri&success_delete_data');
		break;
		case 'mahasiswa':
			$del_foto = mysqli_fetch_row(mysqli_query($dbconnect,"SELECT foto_mahasiswa FROM tbl_mahasiswa WHERE id_mahasiswa='$id'"));
			unlink("../../setting/save/mahasiswa/$del_foto[0]");
			
			mysqli_query($dbconnect,"DELETE FROM tbl_mahasiswa WHERE id_mahasiswa='$id'");
			header('location:?page=mahasiswa&success_delete_data');
		break;
		case 'dosen':
			$del_foto = mysqli_fetch_row(mysqli_query($dbconnect,"SELECT foto_dosen FROM tbl_dosen WHERE id_dosen='$id'"));
			unlink("../../setting/save/dosen/$del_foto[0]");
			
			mysqli_query($dbconnect,"DELETE FROM tbl_dosen WHERE id_dosen='$id'");
			header('location:?page=dosen&success_delete_data');
		break;
		case 'sk':
			$del_file = mysqli_fetch_row(mysqli_query($dbconnect,"SELECT file_bk FROM tbl_bk WHERE id_bk='$id'"));
			unlink("../../setting/save/sk/$del_file[0]");
			
			mysqli_query($dbconnect,"DELETE FROM tbl_bk WHERE id_bk='$id'");
			header('location:?page=sk&success_delete_data');
		break;
		case 'admin':
			$del_file = mysqli_fetch_row(mysqli_query($dbconnect,"SELECT foto_admin FROM tbl_admin WHERE id_admin='$id'"));
			unlink("../../setting/save/admin/$del_file[0]");
			
			mysqli_query($dbconnect,"DELETE FROM tbl_admin WHERE id_admin='$id'");
			header('location:?page=admin&success_delete_data');
		break;
		case 'dpl':
			mysqli_query($dbconnect,"DELETE FROM tbl_dpl WHERE id_dpl='$id'");
			header('location:?page=dpl&success_delete_data');
		break;
		case 'lokasi':
			$d_mitra = mysqli_query($dbconnect,"DELETE FROM tbl_mitra WHERE id_lokasi='$id'");
			if($d_mitra):
				mysqli_query($dbconnect,"DELETE FROM tbl_lokasi WHERE id_lokasi='$id'");
				header('location:?page=lokasi&success_delete_data');
			endif;			
		break;	
		
		/***********************************************************************
			DELETE PENGATURAN
		***********************************************************************/
		
		case 'prodi':	
			$id_atur = $_GET['id'];
			mysqli_query($dbconnect,"DELETE FROM tbl_prodi WHERE id_prodi='$id'");
			header("location:?page=pengaturan&success_delete_data&atur=".$id_atur);
		break;
		case 'level':
			$id_atur = $_GET['id'];
			mysqli_query($dbconnect,"DELETE FROM tbl_level WHERE id_level='$id'");
			header("location:?page=pengaturan&success_delete_data&atur=".$id_atur);
		break;		
	}
}
?>