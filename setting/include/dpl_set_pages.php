<?php
	if ($page=='dashboard') {
	
		include "pages/dashboard/dashboard.php";
		
	}
	elseif($page == "profil-dpl"){
		
		include "pages/profil/profil.php";
		
	}
	elseif($page == "kelompok-dpl"){
		
		include "pages/kelompok/kelompok.php";
		
	}
	elseif($page == "detail-kelompok-dpl"){
		
		include "pages/kelompok/detail_kelompok.php";
		
	}
	elseif($page == "absen-dpl"){
		
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
	elseif($page == "nilai-akhir"){
		
		include "pages/nilai/nilaiakhir.php";
		
	}
?>