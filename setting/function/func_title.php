<?php function title($page){ ?>

	<?php if ($page=='beranda') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Beranda | Sistem Informasi KKN</title>			
	<?php }elseif ($page=='daftar') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Daftar | Sistem Informasi KKN</title>
	<?php }elseif ($page=='dashboard') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dashboard | Sistem Informasi KKN</title>
	<?php }elseif ($page=='mahasiswa') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Mahasiswa | Sistem Informasi KKN</title>		
	<?php }elseif ($page=='dosen' || $page=='dpl') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dosen | Sistem Informasi KKN</title>	
	<?php }elseif ($page=='sk') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Berkas KKN | Sistem Informasi KKN</title>		
	<?php }elseif ($page=='admin' || $page=='profil') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Administrator | Sistem Informasi KKN</title>		
	<?php }elseif ($page=='peserta' || $page=='cekberkas') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Peserta | Sistem Informasi KKN</title>		
	<?php }elseif ($page=='galeri') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Galeri Foto | Sistem Informasi KKN</title>	
	<?php }elseif ($page=='lokasi' || $page=='tampil-lokasi') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lokasi KKN | Sistem Informasi KKN</title>
	<?php }elseif ($page=='pengaturan') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Pengaturan | Sistem Informasi KKN</title>
	<?php }elseif ($page=='nilai-pb' || $page=='nilai-uk' || $page=='nilai-lpk' || $page=='nilai-km' || $page=='nilai-pl' || $page=='nilai-akhir') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Nilai | Sistem Informasi KKN</title>				
	<?php }elseif ($page=='kelompok' || $page=='kelompok-peserta' || $page=='kelompok-dpl' || $page=='detail-kelompok' || $page == 'absen' || $page=='detail-kelompok-dpl' || $page=='absen-peserta' || $page=='absen-dpl' || $page=='absen-mitra' || $page=='kelompok-mitra') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Kelompok | Sistem Informasi KKN</title>			
	<?php }elseif ($page=='profil-peserta') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Profil Peserta | Sistem Informasi KKN</title>
	<?php }elseif ($page=='profil-dpl') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Profil DPL | Sistem Informasi KKN</title>
	<?php }elseif ($page=='profil-mitra') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Profil Mitra | Sistem Informasi KKN</title>		
	<?php }elseif ($page=='jadwal') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Jadwal Monef | Sistem Informasi KKN</title>	
	<?php }elseif ($page=='lbmandiri' || $page=='lbkelompok') { ?>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Logbook | Sistem Informasi KKN</title>		
	<?php } ?>

<?php }function breadcrumb($page){ ?>

	<?php if ($page=='beranda') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Beranda</span> - Sistem Informasi <b>KKN</b>
					<small class="display-block">Stikom Uyelindo Kota Kupang</small>
				</h4>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='daftar') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><span class="text-semibold">Pendaftaran</span> - Form Pendaftaran <b>KKN</b></h4>

				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=beranda">Beranda</a></li>
					<li class="active">Pendaftaran</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->	
	<?php }elseif ($page=='pengaturan') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><span class="text-semibold">Data Pengaturan</span> - Pengaturan</h4>

				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=beranda">Beranda</a></li>
					<li class="active">Pengaturan</li>
				</ul>
			</div>
		</div>
	</div>
	<?php }elseif ($page=='dashboard') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Dashboard</span> - Sistem Informasi <b>KKN</b>
					<small class="display-block">Stikom Uyelindo Kota Kupang</small>
				</h4>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='mahasiswa') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Mahasiswa</span> - Data Mahasiswa
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Mahasiswa</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='dosen') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Dosen</span> - Data Dosen
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Dosen</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->	
	<?php }elseif ($page=='dpl') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Dosen</span> - Data DPL
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">DPL</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='sk') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Berkas KKN</span> - Data Berkas KKN
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Berkas KKN</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='admin' || $page=='profil') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Administrator</span> - Data Administrator
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Administrator</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<!-- /page header -->
	<?php }elseif ($page=='profil-dpl' || $page=='profil-peserta' || $page=='profil-mitra') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Profil</span> - <?=(($page=='profil-dpl')?'DPL':(($page == 'profil-mitra')?'Mitra KKN':'Peserta KKN'))?>
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Profil</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='peserta') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Mahasiswa</span> - Data Peserta
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Peserta</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->	
	<?php }elseif ($page=='kelompok') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Mahasiswa</span> - Data Kelompok
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Kelompok</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='lokasi' || $page=='tampil-lokasi') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Lokasi KKN</span> - Data Lokasi KKN
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Lokasi KKN</li>
				</ul>
			</div>
		</div>
	</div>
	<?php }elseif ($page=='nilai-pb') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Penilaian</span> - Data Nilai Presentasi Pembekalan
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Nilai Presentasi Pembekalan</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='nilai-uk') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Penilaian</span> - Data Nilai Usulan Kegiatan
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Nilai Usulan Kegiatan</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
		<?php }elseif ($page=='nilai-pl') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Penilaian</span> - Data Nilai Pelaksanaan Program
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Nilai Pelaksanaan Program</a></li>
				</ul>
			</div>
		</div>
	</div>
	<?php }elseif ($page=='nilai-akhir') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Penilaian</span> - Data Evaluasi Akhir Mahasiswa
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Evaluasi Akhir Mahasiswa</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
		<?php }elseif ($page=='nilai-km') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Penilaian</span> - Data Nilai Kinerja Mahasiswa
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Nilai Kinerja Mahasiswa</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
		<?php }elseif ($page=='nilai-lpk') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Penilaian</span> - Data Nilai Pelaksanaan Kegiatan
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Nilai Pelaksanaan Kegiatan</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='kelompok-dpl' || $page=='absen-mitra' || $page=='kelompok-mitra') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Kelompok</span> - Data Kelompok
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Kelompok</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='detail-kelompok'  || $page == 'absen') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Mahasiswa</span> - Data Detail Kelompok
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li><a href="?page=kelompok">Kelompok</a></li>
					<li class="active">Detail Kelompok</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='detail-kelompok-dpl' || $page=='absen-dpl') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Kelompok</span> - Data Detail Kelompok
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li><a href="?page=kelompok-dpl">Kelompok</a></li>
					<li class="active">Detail Kelompok</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<!-- /page header -->
	<?php }elseif ($page=='kelompok-peserta' || $page=='absen-peserta') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Kelompok</span> - Data Kelompok
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Kelompok</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='cekberkas') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Mahasiswa</span> - Data Peserta
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li><a href="?page=peserta">Peserta</a></li>
					<li class="active">Berkas Peserta</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='galeri') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Galeri Foto</span> - Data Galeri Foto
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Galeri Foto</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='jadwal') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Mahasiswa</span> - Data Jadwal
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Jadwal</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='lbmandiri') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Logbook</span> - Data Logbook Mandiri
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Logbook Mandiri</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php }elseif ($page=='lbkelompok') { ?>
	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-semibold">Logbook</span> - Data Logbook Kelompok
				</h4>
				<ul class="breadcrumb breadcrumb-caret">
					<li><a href="?page=dashboard">Dashboard</a></li>
					<li class="active">Logbook Kelompok</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<?php } ?>
<?php }function pagetitle($page){ ?>
	<?php if ($page=='peserta') { ?>
		<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-bold uppercase">Peserta KKN-PPM Stikom Uyelindo</span>
					<small class="display-block">Stikom Uyelindo Kota Kupang</small>
				</h4>
			</div>
		</div>
	</div>
	<?php }elseif ($page=='daftar') { ?>
		<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-bold uppercase">Pendaftaran Peserta KKN-PPM Stikom Uyelindo</span>
					<small class="display-block">Stikom Uyelindo Kota Kupang</small>
				</h4>
			</div>
		</div>
	</div>
	<?php }elseif ($page=='dpl') { ?>
		<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-bold uppercase">Dosen Pembimbing Lapanagan KKN-PPM Stikom Uyelindo</span>
					<small class="display-block">Stikom Uyelindo Kota Kupang</small>
				</h4>
			</div>
		</div>
	</div>
	<?php }elseif ($page=='kelompok' || $page=='detail-kelompok' ) { ?>
		<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-bold uppercase">Kelompok KKN-PPM Stikom Uyelindo</span>
					<small class="display-block">Stikom Uyelindo Kota Kupang</small>
				</h4>
			</div>
		</div>
	</div>
	<?php }elseif ($page=='galeri' ) { ?>
		<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4>
					<span class="text-bold uppercase">Galeri Foto KKN-PPM UNDANA Kupang</span>
					<small class="display-block">Stikom Uyelindo Kota Kupang</small>
				</h4>
			</div>
		</div>
	</div>
	<?php }?>
<?php }?>