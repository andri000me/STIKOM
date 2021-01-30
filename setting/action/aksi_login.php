<?php
	if(isset($_POST['login'])){
		
		$level  	   = $_POST['level'];
		$username      = $_POST['username'];
		$password 	   = md5($_POST['password']);
		
		
		$r_clevel      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_level WHERE level='$level' AND status='aktif'"));
		
		$cek_level     = $r_clevel['level'];
		
		if($cek_level == "admin"){		
			$r_admin   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_admin WHERE username='$username'"));
			
			$id_user       = $r_admin['id_admin'];
			$nama_user     = $r_admin['nama_admin'];
			$password_user = $r_admin['password'];
			$page	       = "pages/admin/";
		}
		elseif($cek_level == "peserta"){				
			$cek_mahasiswa = mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE nim='$username'");
			if(mysqli_num_rows($cek_mahasiswa)!=0){
				$r_mahasiswa = mysqli_fetch_array($cek_mahasiswa);
				$r_peserta	 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_mahasiswa='$r_mahasiswa[id_mahasiswa]' AND password='$password' AND status_peserta='sudah'"));
			
					$status		   = $r_peserta['status_peserta']; 
					$id_user       = $r_peserta['id_peserta'];
					$password_user = $r_peserta['password'];
					$page	       = "pages/peserta/";					
			}
			else{
				header('location:?page=beranda&alert='.base64_encode("login_failed"));
			}			
		}
		elseif($cek_level == "dpl"){
			$cek_dosen = mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE nidn='$username'");
			if(mysqli_num_rows($cek_dosen)!=0){
				$r_dosen = mysqli_fetch_array($cek_dosen);
				$r_dpl	 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dosen='$r_dosen[id_dosen]' AND password='$password'"));
		
					$id_user       = $r_dpl['id_dpl'];
					$password_user = $r_dpl['password'];					
					$page	       = "pages/dpl/";					
			}
			else{
				header('location:?page=beranda&alert='.base64_encode("login_failed"));
			}
		}
		elseif($cek_level == "mitra"){
			$cek_mitra = mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE username='$username' AND password='$password'");
			if(mysqli_num_rows($cek_mitra)!=0){	
				$r_mitra = mysqli_fetch_array($cek_mitra);
					$id_user       = $r_mitra['id_mitra'];
					$password_user = $r_mitra['password'];					
					$page	       = "pages/mitra/";					
			}
			else{
				header('location:?page=beranda&alert='.base64_encode("login_failed"));
			}
		}
		
		if($password  !== $password_user){
			header('location:?page=beranda&alert='.base64_encode("login_failed"));
		}
		elseif($status == "belum"){
			header('location:?page=beranda&alert='.base64_encode("no_access"));
		}		
		else{	
			session_start();
			
				$_SESSION['user_forum']  = $username;
				$_SESSION['id_user']	 = $id_user;
				$_SESSION['level']		 = $cek_level;
				$_SESSION['nama_user']	 = $nama_user;
				$_SESSION['agent_forum'] = md5($_SERVER['HTTP_USER_AGENT']);
			
			header("location: ".$page);
		}
	}
?>