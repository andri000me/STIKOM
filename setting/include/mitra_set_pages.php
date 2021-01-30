<?php
	if ($page=='dashboard') {
	
		include "pages/dashboard/dashboard.php";
		
	}
	elseif($page == "profil-mitra"){
		
		include "pages/profil/profil.php";
		
	}
	elseif($page == "kelompok-mitra"){
		
		include "pages/kelompok/kelompok.php";
		
	}
	elseif($page == "detail-kelompok-mitra"){
		
		include "pages/kelompok/detail_kelompok.php";
		
	}
	elseif($page == "absen-mitra"){
		
		include "pages/kelompok/absen.php";
		
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
?>