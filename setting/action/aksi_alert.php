<?php

	if(isset($_GET["alert"])){
		
		$alert = base64_decode($_GET["alert"]);
		
		if ($alert=="success_save_data") {
			$modal_bg    = "bg-teal-300";
			$modal_btn   = "bg-teal-600";
			$jenis_pesan = "&#9786; Anda berhasil mendaftarkan diri";
			$pesan 		 = "Data dan berkas persyaratan yang sudah Anda masukan masih akan diperiksa, setelah lengkap barulah Anda terdaftar menjadi peserta <b>KKN</b>, informasi tentang kelengkapan berkas akan kami kirim ke Email Anda .";
			$back_link	 = "beranda";
		}
		if ($alert=="error_save_data") {
			$modal_bg    = "bg-danger-300";
			$modal_btn   = "bg-danger-600";
			$jenis_pesan = "&#9785; Anda gagal mendaftarkan diri";
			$pesan		 = "Mungkin ada kesalahan pada data atau berkas persyaratan yang Anda masukan, silahkan perikasa lagi data dan berkas persyaratan Anda.";
			$back_link	 = "daftar";
		}
		if ($alert=="error_empty_pin") {
			$modal_bg    = "bg-danger-300";
			$modal_btn   = "bg-danger-600";
			$jenis_pesan = "&#9785; Anda gagal mendaftarkan diri";
			$pesan		 = "PIN KRS tidak terdaftar, mungkin Anda belum menyelesaikan andministrasi sebaliknya jika sudah harap hubungi panitiaa KKN.";
			$back_link	 = "daftar";
		}
		if ($alert=="error_file_upload") {
			$modal_bg    = "bg-danger-300";
			$modal_btn   = "bg-danger-600";
			$jenis_pesan = "&#9785; Anda gagal mendaftarkan diri";
			$pesan		 = "Data dan berkas persyaratan Anda gagal di upload, periksa kembali data dan berkas persyaratan yang Anda masukan.";
			$back_link	 = "daftar";
		}
		if ($alert=="error_duplicate_data") {
			$modal_bg    = "bg-danger-300";
			$modal_btn   = "bg-danger-600";
			$jenis_pesan = "&#9785; Anda gagal mendaftarkan diri";
			$pesan		 = "Anda mungkin sudah terdaftar atau ada kesamaan data yang Anda masukan, coba perikasa lagi data yang Anda masukan.";
			$back_link	 = "daftar";
		}
		if ($alert=="error_file_type") {
			$modal_bg    = "bg-danger-300";
			$modal_btn   = "bg-danger-600";
			$jenis_pesan = "&#9785; Anda gagal mendaftarkan diri";
			$pesan		 = "Berkas persyaratan yang Anda masukan haruslah file berextensi PDF.";
			$back_link	 = "daftar";
		}	
		if ($alert=="error_empty_file") {
			$modal_bg    = "bg-danger-300";
			$modal_btn   = "bg-danger-600";
			$jenis_pesan = "&#9785; Anda gagal mendaftarkan diri";
			$pesan		 = "Berkas persyaratan belum Anda masukan.";
			$back_link	 = "daftar";
		}
		if ($alert=="login_failed") {
			$modal_bg    = "bg-danger-300";
			$modal_btn   = "bg-danger-600";
			$jenis_pesan = "&#9785; Anda gagal masuk";
			$pesan		 = "Mungkin ada kesalahan dalam memasukan level, username atau password.";
			$back_link	 = "beranda";
		}
		if ($alert=="no_access") {
			$modal_bg    = "bg-danger-300";
			$modal_btn   = "bg-danger-600";
			$jenis_pesan = "&#9785; Anda gagal masuk";
			$pesan		 = "Kemungkinan Anda belum terdaftar sebagai peserta KKN atau berkas Anda belum diperiksa, untuk lebih jelas segera hubungi panitia KKN.";
			$back_link	 = "beranda";
		}
	}

?>