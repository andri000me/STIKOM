<div class="row">	
	<div class="col-sm-12">	
		<?php
		if($page){
			if(isset($_GET['error_images_size'])){
				
				echo "<div class='alert hide-alert  alert-warning' role='alert'>Ukuran Gambar Terlalu Besar </div>";
				
			}elseif(isset($_GET['error_images_type'])){
				
				echo "<div class='alert hide-alert alert-warning' role='alert'>Hanya JPG, JPEG, PNG & GIF Yang Di Izinkan </div>";	
				
			}elseif(isset($_GET['error_file_type'])){
				
				echo "<div class='alert hide-alert alert-warning' role='alert'>Hanya PDF Yang Di Izinkan </div>";	
				
			}elseif(isset($_GET['error_file_upload'])){
				
				echo "<div class='alert hide-alert  alert-warning' role='alert'>Data Gagal Di Upload </div>";
				
			}elseif(isset($_GET['success_save_data'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-success' role='alert'>Data Berhasil Terimpan </div>";	
				
			}elseif(isset($_GET['error_save_data'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>Data Tidak Dapat Disimpan </div>";
				
			}elseif(isset($_GET['success_edit_data'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-info' role='alert'>Data Berhasil Diubah </div>";	
				
			}elseif(isset($_GET['error_edit_data'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>Data Gagal Diubah </div>";
				
			}elseif(isset($_GET['success_delete_data'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-success' role='alert'>Data Berhasil Dihapus </div>";	
				
			}elseif(isset($_GET['error_stock_items'])){
				
				echo "<div class='animated slideInDown hide-alert alert-danger' role='alert'>Stok Tersisa Kurang Dari 5, Silikan Melakukan Pemesanan </div>";	
			}elseif(isset($_GET['error_duplicate_data'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>data yang anda masukan sudah ada</div>";	
			}elseif(isset($_GET['error_duplicate_nik'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>NIK yang anda masukan sudah ada</div>";	
			}elseif(isset($_GET['error_duplicate_nkk'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>NKK yang anda masukan sudah ada</div>";	
			}elseif(isset($_GET['registration_failed'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>Anda Gagal Mendaftar, Mungkin Ada Kesalahan</div>";	
			}elseif(isset($_GET['login_failed'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>ID Anggota Atau Kata Sandi Yang Anda Masukan Salah</div>";	
			}elseif(isset($_GET['registration_successful'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-success' role='alert'>Anda Telah Terdaftar, Silahkan Login</div>";	
			}elseif(isset($_GET['error_captcha'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>Gagal, Mohon lengkapi Captcha yang tersedia</div>";	
			}elseif(isset($_GET['access_blocked'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>Untuk Sementara Akses Anda Diblokir</div>";	
			}elseif(isset($_GET['no_access'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>Anda Belum Mempunyai Akses</div>";	
			}elseif(isset($_GET['error_id'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>ID Anggota Yang Anda Masukan Salah</div>";	
			}elseif(isset($_GET['error_empty_file'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>File Belum Dimasukan</div>";	
			}elseif(isset($_GET['error_empty_pin'])){
				
				echo "<div class='animated slideInDown alert hide-alert alert-danger' role='alert'>PIN KRS Tidak Terdaftar</div>";	
			}			
		}else{
			echo "";
		}		
		?>
	</div>
</div>