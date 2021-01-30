<?php
	if ($page=='dashboard') {
	
		include "pages/dashboard/dashboard.php";
		
	}
	elseif($page == "profil-peserta"){
		
		include "pages/profil/profil.php";
		
	}
	elseif($page == "kelompok-peserta"){
		
		include "pages/kelompok/kelompok.php";
		
	}
	elseif($page == "galeri"){
		
		include "pages/galeri/galeri.php";
		
	}
	elseif($page == "absen-peserta"){
		
		include "pages/kelompok/absen.php";
		
	}
	elseif($page == "lbmandiri"){
		
		include "pages/logbook/lbmandiri.php";
		
	}
	elseif($page == "lbkelompok"){
		
		include "pages/logbook/lbkelompok.php";
		
	}
?>