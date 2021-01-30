<?php
	if ($page=='beranda') {
	
		include "pages/umum/beranda/beranda.php";
	
	}
	elseif ($page=='masuk') {
	
		include "pages/umum/masuk/login.php";
	
	}
	elseif($page=='daftar') {
	
		include "pages/umum/daftar/register.php";
	
	}
	elseif($page=='peserta') {
	
		include "pages/umum/peserta/peserta.php";
	
	}
	elseif($page=='kelompok') {
	
		include "pages/umum/peserta/kelompok.php";
	
	}
	elseif($page=='detail-kelompok') {
	
		include "pages/umum/peserta/detail-kelompok.php";
	
	}
	elseif($page=='dpl') {
	
		include "pages/umum/dpl/dpl.php";
	
	}
	elseif($page=='lokasi') {
	
		include "pages/umum/lokasi/lokasi.php";
	
	}
	elseif($page=='galeri') {
	
		include "pages/umum/galeri/galeri.php";
	
	}
	
?>