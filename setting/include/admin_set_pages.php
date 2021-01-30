<?php
	if ($page=='dashboard') {
	
		include "pages/dashboard/dashboard.php";
	
	}
	elseif ($page=='mahasiswa') {
	
		include "pages/mahasiswa/mahasiswa.php";
	
	}
	elseif ($page=='peserta') {
	
		include "pages/mahasiswa/peserta.php";
	
	}
	elseif ($page=='cekberkas') {
	
		include "pages/mahasiswa/cek_berkas.php";
	
	}
	elseif ($page=='dosen') {
	
		include "pages/dosen/dosen.php";
	
	}
	elseif ($page=='sk') {
	
		include "pages/sk/sk.php";
	
	}
	elseif ($page=='admin') {
	
		include "pages/admin/admin.php";
	
	}
	elseif ($page=='kelompok') {
	
		include "pages/mahasiswa/kelompok.php";
	
	}
	elseif ($page=='detail-kelompok') {
	
		include "pages/mahasiswa/detail_kelompok.php";
	
	}
	elseif ($page=='profil') {
	
		include "pages/admin/profil.php";
	
	}
	elseif ($page=='dpl') {
	
		include "pages/dosen/dpl.php";
	
	}
	elseif ($page=='galeri') {
	
		include "pages/galeri/galeri.php";
	
	}
	elseif ($page=='lokasi') {
	
		include "pages/lokasi/lokasi.php";
	
	}
	elseif ($page=='pengaturan') {
	
		include "pages/pengaturan/pengaturan.php";
	
	}
	elseif ($page=='absen') {
	
		include "pages/mahasiswa/absen.php";
	
	}
	elseif ($page=='tampil-lokasi') {
	
		include "pages/lokasi/tampil_lokasi.php";
	
	}
	elseif ($page=='lbmandiri') {
	
		include "pages/logbook/lbmandiri.php";
	
	}
	elseif ($page=='lbkelompok') {
	
		include "pages/logbook/lbkelompok.php";
	
	}
		elseif($page == "nilai-pb"){
		
		include "pages/nilai/nilaipb.php";
		
	}
	elseif($page == "nilai-uk"){
		
		include "pages/nilai/nilaiuk.php";
		
	}
	elseif($page == "nilai-km"){
		
		include "pages/nilai/nilaikm.php";
		
	}
	elseif($page == "nilai-lpk"){
		
		include "pages/nilai/nilailpk.php";
		
	}
	elseif($page == "nilai-pl"){
		
		include "pages/nilai/nilaipl.php";
		
	}
	elseif($page == "nilai-akhir"){
		
		include "pages/nilai/nilaiakhir.php";
		
	}
?>