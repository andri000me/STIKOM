<?php
	include '../connect/config.php'; 
	include '../function/func_media.php'; 
	
	date_default_timezone_set('Asia/Jakarta');
	$tanggal= mktime(date("m"),date("d"),date("Y"));
	$tglsekarang = date("Y-m-d", $tanggal);
	
	$q_atur = mysqli_query($dbconnect,"SELECT * FROM tbl_pengaturan WHERE id_pengaturan");
	$r_atur = mysqli_fetch_array($q_atur);
	
	use Dompdf\Dompdf; 
	
	if(isset($_GET['logbook'])){
		
		$id_logbook     = $_GET['logbook'];
		$status_logbook = $_GET['statuslb'];
		$r_ulbmandiri   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_logbook WHERE id_logbook='$id_logbook' AND status_logbook='$status_logbook'"));

		
		$idlogbook      = $r_ulbmandiri['id_logbook'];
		$tgl_pengisisan = $r_ulbmandiri['tgl_pengisian'];
		$hari 			= date('D', strtotime($tgl_pengisisan));
		
		
		$r_kpagi	    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_logbook WHERE id_logbook='$idlogbook' AND status_waktu='pagi'"));
		
		
		$idhaslogbook1  = $r_kpagi['id_has_logbook'];
		$kegiatan1      = $r_kpagi['kegiatan'];
		$waktukegiatan1 = $r_kpagi['waktu_kegiatan'];
		
		$r_ksiang	    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_logbook WHERE id_logbook='$idlogbook' AND status_waktu='siang'"));

		$idhaslogbook2  = $r_ksiang['id_has_logbook'];
		$kegiatan2      = $r_ksiang['kegiatan'];
		$waktukegiatan2 = $r_ksiang['waktu_kegiatan'];
		
		$r_ksore	    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_logbook WHERE id_logbook='$idlogbook' AND status_waktu='sore'"));
		
		$idhaslogbook3  = $r_ksore['id_has_logbook'];
		$kegiatan3      = $r_ksore['kegiatan'];
		$waktukegiatan3 = $r_ksore['waktu_kegiatan'];
		
		$r_kmalam	    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_logbook WHERE id_logbook='$idlogbook' AND status_waktu='malam'"));

		$idhaslogbook4  = $r_kmalam['id_has_logbook'];
		$kegiatan4      = $r_kmalam['kegiatan'];
		$waktukegiatan4 = $r_kmalam['waktu_kegiatan'];
		
		
		$r_tpeserta   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_ulbmandiri[id_peserta]'"));
											
		$r_tmahasiswa = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa ='$r_tpeserta[id_mahasiswa]'"));

		$r_tprodi	  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tmahasiswa[id_prodi]'"));
		
		$r_tkelompok   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$r_ulbmandiri[id_kelompok]'"));
		
		$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
		$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
		
		$r_tdosen1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
		
		$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

		$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
		
		$r_tdosen2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));
		
		
		$r_tlokasi	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
		
		$r_tprov = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
								
		$r_tkota = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
		
		$r_tkec  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
		
		$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
		
		$r_tmitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
		
	ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../../assets/bootstrap/css/main.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered-dom">
					<tr>
						<th style="width:130px;" >
							<center><img src="../save/logo/logo.png" style="height:80px; width:80%; padding:0px;" /></center>
						</th>
						<th width="280">
							<center style="font-weigth:bold; font-size:13px;">
								<div>LOG BOOK</div>
								<div>KULIAH KERJA NYATA</div>
								<div>UNDANA KUPANG</div>
								<div><?=strtoupper($r_atur['tahun_angkatan'])?></div>
							</center>
						</th width="150">
						<th>
							<table class="table table-nobor">
								<tr>
									<td>Hari Ke</td>
									<td>:</td>
									<td></td>
								</tr>
								<tr>
									<td>Hari</td>
									<td>:</td>
									<td><?=hari_indo($hari);?></td>
								</tr>
								<tr>
									<td>Tanggal</td>
									<td>:</td>
									<td><?=ucwords(tgl_indo($tgl_pengisisan))?></td>
								</tr>
							</table>
						</th>
					</tr>
					<tr>
						<th colspan="3">
							<table class="table table-nobor" style="font-size:12px; margin-bottom:0px;">
								<tr>
									<td width="50"><?=(($status_logbook == "mandiri")?'Nama':'Kelompok')?></td>
									<td width="10">:</td>
									<td><?=(($status_logbook == "mandiri")?ucwords($r_tmahasiswa['nama_mahasiswa']):ucwords($r_tkelompok['nama_kelompok']))?></td>
								</tr>
								<tr>
									<td width="50"><?=(($status_logbook == "mandiri")?'Nim':'Kel/Desa')?></td>
									<td width="10">:</td>
									<td><?=(($status_logbook == "mandiri")?ucwords($r_tmahasiswa['nim']):ucwords($r_tkel['nama']))?></td>
								</tr>
								<tr>
									<td width="50"><?=(($status_logbook == "mandiri")?'Prodi':'Kota/Kab')?></td>
									<td width="10">:</td>
									<td><?=(($status_logbook == "mandiri")?ucwords($r_tprodi['nama_prodi']):ucwords($r_tkota['nama']))?></td>
								</tr>
							</table>
						</th>
					</tr>
					<tr>
						<td colspan="3"><b>A. Jadwal</b></td>
					</tr>
					<tr>
						<td></td>
						<td><center style="font-weigth:bold;">KEGIATAN</center></td>
						<td><center style="font-weigth:bold;">JAM</center></td>
					</tr>
					<tr>
						<td>Pagi</td>
						<td><?=ucfirst($kegiatan1)?></td>
						<td><?=ucwords($waktukegiatan1)?></td>
					</tr>
					<tr>
						<td>Siang</td>
						<td><?=ucfirst($kegiatan2)?></td>
						<td><?=ucwords($waktukegiatan2)?></td>
					</tr>
					<tr>
						<td>Sore</td>
						<td><?=ucfirst($kegiatan3)?></td>
						<td><?=ucwords($waktukegiatan3)?></td>
					</tr>
					<tr>
						<td>Malam</td>
						<td><?=ucfirst($kegiatan4)?></td>
						<td><?=ucwords($waktukegiatan4)?></td>
					</tr>
					<tr>
						<td colspan="3"><b>B. Catanan Penting Harian</b></td>
					</tr>
					<tr>
						<td colspan="3" style="height:50px;"><?=ucfirst($r_ulbmandiri['catatan'])?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row">
			<br><div class="col-sm-12">
				<center style="font-size:12px;">
					<b>Disahkan oleh :</b>
					<p>Kupang, <?=tgl_indo($tglsekarang);?></p>
				</center>
			<br></div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-nobor" style="font-size:12px;">
					<tr>
						<td width="180">
							<p>Dosen Pembimbing Lapangan</p>
							<br><br>
							<u style="font-size:11px;"><?=strtoupper($r_tdosen1['nama_dosen'])?></u>
							<p style="font-size:11px;">NIDN.<?=$r_tdosen1['nidn']?></p>
						</td>
						<td width="170">
							<p>Dosen Pembimbing Lapangan Pendamping</p>
							<br><br>
							<u style="font-size:11px;"><?=strtoupper($r_tdosen2['nama_dosen'])?></u>
							<p style="font-size:11px;">NIDN.<?=$r_tdosen2['nidn']?></p>
						</td>
						<td>
						<div class="pull-right">
							<p>Kepala Desa/Camat</p>
							<br><br>
							<u style="font-size:11px;"><?=strtoupper($r_tmitra['nama_mitra'])?></u>
							<p style="font-size:11px;">NIP.</p>
						</div>	
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php 

		$html = ob_get_clean(); 
		require_once("../../assets/dompdf/autoload.inc.php");
		$dompdf = new Dompdf(); 
		$dompdf->loadHtml($html); 
		$dompdf->setPaper('A4', 'portrait'); 
		$dompdf->render(); 
		$dompdf->stream('Logbook Mandiri.pdf', array("Attachment"=>0));

	}
	
	if(isset($_GET['monev'])){
	
	
	$r_jadwal      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_jadwal='$_GET[monev]'"));
	
	$status_jadwal = $r_jadwal['status_jadwal'];
	
	$id_kelompok   = $r_jadwal['id_kelompok'];
	
	$r_tkelompok   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		
	$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));	
		
	$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
	$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
		
	$r_tdosen1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
		
	$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

	$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
		
	$r_tdosen2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));		

	$r_tlokasi	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
	
	$r_tprov = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
							
	$r_tkota = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
	
	$r_tkec  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
	
	$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
	
	$r_tmitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
	
		if($status_jadwal == "monev1"){
			$mstatus   = "I";
		}
		elseif($status_jadwal == "monev2"){
			$mstatus   = "II";
		}
		elseif($status_jadwal == "monev3"){
			$mstatus   = "III";
		}
		else{
			$mstatus   = "";
		}
	
		if($r_tprodi['singkatan_prodi']=="TIS1"){
			$tprodi = "TIS1 / <span class='line-through'>SIS1</span>";
		}
		elseif($r_tprodi['singkatan_prodi']=="SIS1"){
			$tprodi = "<span class='line-through'>TIS1</span> / SIS1";
		}
		else{
			$tprodi = "TIS1 / SIS1";
		}
	
	ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../../assets/bootstrap/css/main.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="border-kop">
					<img src="../save/logo/logo.png" class="logo-kop-pt" />
					<center class="kop-absen">
						<span><p>UNDANA KUPANG</p><p>UNIVERSITAS NUSA CENDANA</p></span>
						<p><?=ucwords($r_atur['alamat_stikom'])?></p>
						<p>Telp.<?=$r_atur['no_tlp_stikom']?> fax.<?=$r_atur['fax_stikom']?></p>
						<p>website: <?=strtolower($r_atur['website_stikom'])?>; email: <?=strtolower($r_atur['email_stikom'])?></p>
					</center>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="border-kop">
					<center class="kop-absen">
						<span><p>ABSENSI MONEV MAHASISWA KKM-PPM</p></span>
					</center>
					<table class="table table-nobor-monev martop10" style="margin-bottom:-10px;">
						<tr>
							<td>
								<table class="table table-nobor-monev">
									<tr>
										<th width="85">Prodi</th>
										<th width="10">:</th>
										<td><?=$tprodi;?></td>
									</tr>
									<tr>
										<th width="85">Moven Ke/Tgl*</th>
										<th width="10">:</th>
										<td><u><?=$mstatus;?></u> / <u><?=strtoupper(tgl_indo($r_jadwal['tgl_jadwal']))?></u></td>
									</tr>
								</table>
							</td>
							<td width="50"></td>
							<td>
								<table class="table table-nobor-monev">
									<tr>
										<th width="100">ID KKN Kelompok</th>
										<th width="10">:</th>
										<td><?=$r_tkelompok['tahun_kkn']?>-<?=$r_tprodi['kode_prodi']?>-0000002-<?=$r_tkelompok['nama_kelompok']?></td>
									</tr>
									<tr>
										<th width="100">Kelompok Ke-</th>
										<th width="10">:</th>
										<td><?=$r_tkelompok['nama_kelompok']?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-sm-12">
				<table class="table table-nobor-monev martop10">
					<tr>
						<th width="85">Desa/Kelurahan</th>
						<th width="10">:</th>
						<td><?=strtoupper($r_tkel['nama'])?></td>
					</tr>
					<tr>
						<th width="85">Kecamatan</th>
						<th width="10">:</th>
						<td><?=strtoupper($r_tkec['nama'])?></td>
					</tr>
					<tr>
						<th width="85">Kabupaten/Kota</th>
						<th width="10">:</th>
						<td><?=strtoupper($r_tkota['nama'])?></td>
					</tr>
				</table>
			</div>
			<div class="col-sm-12 martop10">
				<table class="table table-bordered-dom-monev" style="margin-bottom:0px;">
					<thead>
						<tr>
							<th width="10">No.</th>
							<th width="110">Nim</th>
							<th width="220">Nama Mahasiswa</th>
							<th width="100">Paraf Mahasiswa</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=0;
						
						$q_ypeserta = mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_kelompok='$id_kelompok'");
						while($r_ypeserta = mysqli_fetch_array($q_ypeserta)){
							
						$r_gpeserta	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_peserta='sudah'"));

						$r_ymahasiswa  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_gpeserta[id_mahasiswa]' ORDER BY nim ASC"));
						
						$r_yjadwal     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_ypeserta[id_kelompok]'"));
						
						$r_yabsen	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_absen WHERE id_peserta='$r_ypeserta[id_peserta]' AND id_jadwal='$r_jadwal[id_jadwal]'"));
						
						$status_absen  = $r_yabsen['status_absen'];
						
						$no++;
					?>
						<tr>
							<td><center><?=$no;?></center></td>
							<td><?=$r_ymahasiswa['nim']?></td>
							<td><?=strtoupper($r_ymahasiswa['nama_mahasiswa'])?></td>
							<td>
								<?php 
									if(!empty($status_absen)){
										
										if($status_absen == "hadir"){
								?>
									<center><img src="<?=$r_gpeserta['paraf_peserta'];?>" style="width:100px; height:50px; position:absolute; margin-top:-23px; margin-left:25px;" /></center>
								<?php 
										}
										elseif($status_absen == "ijin"){ 
											echo "<center><b>IJIN</b></center>"; 
										}
										elseif($status_absen == "sakit"){ 
											echo "<center><b>SAKIT</b></center>"; 
										}
										elseif($status_absen == "tidak"){ 
											echo "<center><b>ALPA</b></center>"; 
										}
									}
									elseif(empty($status_absen)){
										echo "";
									}
								?>
							</td>
						</tr>
					<?php } ?>	
					</tbody>
				</table>
				<span class="tfoot-ket">*Monev dilakukan 3 kali dalam 1 periode KKM-PPM</span>
			</div>
			<div class="col-sm-12">
				<table class="table table-nobor-monev martop20" style="font-size:12px;">
					<tr>
						<td width="170">
							<br>
							Penanggung Jawab KKM-PPM
							<p>Ketua Prodi,</p>
							<br><br>
							<span style="font-size:11px;"><?=strtoupper($r_atur['nama_ketua_prodi'])?></span>
						</td>
						<td width="160">
							<br>
							<p>Dosen Pembimbing Lapangan Utama</p>
							<br><br><br>
							<span style="font-size:11px;"><?=strtoupper($r_tdosen1['nama_dosen']);?></span>
						</td>
						<td>
						<div class="pull-right">
							Kupang, <?=tgl_indo($tglsekarang);?>
							<p>Dosen Pembimbing Lapangan Pendamping</p>
							<br><br><br>
							<span style="font-size:11px;"><?=strtoupper($r_tdosen2['nama_dosen']);?></span>
						</div>	
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php 

	$html = ob_get_clean(); 
	require_once("../../assets/dompdf/autoload.inc.php");
	$dompdf = new Dompdf(); 
	$dompdf->loadHtml($html); 
	$dompdf->setPaper('A4', 'portrait'); 
	$dompdf->render(); 
	$dompdf->stream('Absen '.ucwords($mstatus).'.pdf', array("Attachment"=>0));

		}

	if(isset($_GET['pembekalan'])){
	
	$r_tjadwal = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_jadwal='$_GET[pembekalan]' AND status_jadwal='pembekalan'"));
	
	$id_kelompok  = $r_tjadwal['id_kelompok'];
	
	$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
	
	$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
	
	$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
		
	$r_tdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
		
	$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

	$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
		
	$r_tdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));
	
	$r_tlokasi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
	
	$r_tprov   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
							
	$r_tkota   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
	
	$r_tkec    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
	
	$r_tkel    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
	
	$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
	
	$r_tmitra  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
	
	if($r_tprodi['singkatan_prodi']=="TIS1"){
		$tprodi = "TIS1 / <span class='line-through'>SIS1</span>";
	}
	elseif($r_tprodi['singkatan_prodi']=="SIS1"){
		$tprodi = "<span class='line-through'>TIS1</span> / SIS1";
	}
	else{
		$tprodi = "TIS1 / SIS1";
	}
	
	ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../../assets/bootstrap/css/main.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="border-kop">
					<img src="../save/logo/logo.png" class="logo-kop-ls"/>
					<center class="kop-absen">
					    <span><p>UNDANA KUPANG</p><p>UNIVERSITAS NUSA CENDANA</p></span>
						<p><?=ucwords($r_atur['alamat_stikom'])?></p>
						<p>Telp.<?=$r_atur['no_tlp_stikom']?> fax.<?=$r_atur['fax_stikom']?></p>
						<p>website: <?=strtolower($r_atur['website_stikom'])?>; email: <?=strtolower($r_atur['email_stikom'])?></p>
					</center>
				</div>
			</div>
			<div class="col-sm-12">
				<center class="kop-absen">
					<span>
						<p>DAFTAR HADIR & NILAI TAHAP PEMBEKALAN MAHASISWA</p>
						<p>KKM-PPM STIKOM UYELINDO KUPANG TAHUN <?=date('Y');?></p>
					</span>
				</center>
				<div class="row-dom">
				<table class="table table-nobor-monev martop10" style="margin-bottom:-10px;">
					<tr>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="85">Prodi</th>
									<th width="10">:</th>
									<td><?=$tprodi;?></td>
								</tr>
								<tr>
									<th width="85">Kelompok Ke-</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr>
									<th width="85">Pembekalan</th>
									<th width="10">:</th>
									<td>20 September 2017</td>
								</tr>
							</table>
						</td>
						<td width="50"></td>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">Desa/Kelurahan</th>
									<th width="10">:</th>
										<td><?=strtoupper($r_tkel['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kecamatan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkec['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kabupaten/Kota</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkota['nama'])?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<table class="table table-nobor-monev">
								<tr>
									<th width="85">DPL 1</th>
									<th width="10">:</th>
									<td width="60"><?=$r_tdosen1['nidn'];?></td>
									<th width="10">/*</th>
									<td><?=strtoupper($r_tdosen1['nama_dosen']);?></td>
								</tr>
								<tr>
									<th width="85">DPL 2</th>
									<th width="10">:</th>
									<td width="60"><?=$r_tdosen2['nidn'];?></td>
									<th width="10">/*</th>
									<td><?=strtoupper($r_tdosen2['nama_dosen']);?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</div>
			</div>
			<div class="col-sm-12">
				<table class="table table-bordered-dom-monev martop10">
					<thead>
						<tr>
							<th width="20">No.</th>
							<th width="60">Nim</th>
							<th width="200">Nama Mahasiswa</th>
							<th>Paraf Mhs Materi ke I</th>
							<th>Paraf Mhs Materi ke II</th>
							<th>Paraf Mhs Materi ke III</th>
							<th>Nilai Pembekalan</th>
							<th>Paraf DPL 1</th>
							<th>Paraf DPL 2</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=0;
						
						$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta, tbl_peserta.paraf_peserta, tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
		
						while($r_ypeserta = mysqli_fetch_array($q_ypeserta)):
						
						$r_yjadwal      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_ypeserta[id_kelompok]'"));
						
						$r_yabsen	    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_absen WHERE id_peserta='$r_ypeserta[id_peserta]' AND id_jadwal='$r_tjadwal[id_jadwal]'"));
						
						$status_absen   = $r_yabsen['status_absen'];
						
						$r_nilaipb_dpl1	= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pb WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='dpl1'"));
						
						$r_tdpl1		= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dpl='$r_nilaipb_dpl1[id_dpl]'"));
						
						$r_nilaipb_dpl2	= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pb WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='dpl2'"));
						
						$r_tdpl2		= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dpl='$r_nilaipb_dpl2[id_dpl]'"));
						
						$nilaidpl1      = $r_nilaipb_dpl1['nilai_pb'];
						$nilaidpl2      = $r_nilaipb_dpl2['nilai_pb'];
						
						if(empty($nilaidpl1) AND empty($nilaidpl2)){
							$totalnilai = "";
						}
						elseif(!empty($nilaidpl1) AND empty($nilaidpl2)){
							$totalnilai = "";
						}	
						elseif(empty($nilaidpl1) AND !empty($nilaidpl2)){
							$totalnilai = "";
						}	
						elseif(!empty($nilaidpl1) AND !empty($nilaidpl2)){
							$totalnilai = ($nilaidpl1+$nilaidpl2)/2;
						}
						else{
							$totalnilai = "";
						}
						
						
						$no++;
					?>
						<tr>
							<td><center><?=$no;?></center></td>
							<td><?=$r_ypeserta['nim']?></td>
							<td><?=strtoupper($r_ypeserta['nama_mahasiswa'])?></td>
							<td>
								<?php 
									if(!empty($status_absen)){
										
										if($status_absen == "hadir"){
											if(!empty($r_ypeserta['paraf_peserta'])){
								?>
									<center><img src="<?=$r_ypeserta['paraf_peserta'];?>" style="width:80px; height:50px; position:absolute; margin-top:-23px; margin-left:23px;" /></center>
								<?php 
											}
											elseif(empty($r_ypeserta['paraf_peserta'])){
												echo ""; 
											}
											else{
												echo ""; 
											}
										}
										elseif($status_absen == "ijin"){ 
											echo "<center><b>IJIN</b></center>"; 
										}
										elseif($status_absen == "sakit"){ 
											echo "<center><b>SAKIT</b></center>"; 
										}
										elseif($status_absen == "tidak"){ 
											echo "<center><b>ALPA</b></center>"; 
										}
									}
									elseif(empty($status_absen)){
										echo "";
									}
								?>
							</td>
							<td>
								<?php 
									if(!empty($status_absen)){
										
										if($status_absen == "hadir"){
											if(!empty($r_ypeserta['paraf_peserta'])){
								?>
									<center><img src="<?=$r_ypeserta['paraf_peserta'];?>" style="width:80px; height:50px; position:absolute; margin-top:-23px; margin-left:23px;" /></center>
								<?php 
											}
											elseif(empty($r_ypeserta['paraf_peserta'])){
												echo ""; 
											}
											else{
												echo ""; 
											}
										}
										elseif($status_absen == "ijin"){ 
											echo "<center><b>IJIN</b></center>"; 
										}
										elseif($status_absen == "sakit"){ 
											echo "<center><b>SAKIT</b></center>"; 
										}
										elseif($status_absen == "tidak"){ 
											echo "<center><b>ALPA</b></center>"; 
										}
									}
									elseif(empty($status_absen)){
										echo "";
									}
								?>
							</td>
							<td>
								<?php 
									if(!empty($status_absen)){
										
										if($status_absen == "hadir"){
											if(!empty($r_ypeserta['paraf_peserta'])){
								?>
									<center><img src="<?=$r_ypeserta['paraf_peserta'];?>" style="width:80px; height:50px; position:absolute; margin-top:-23px; margin-left:23px;" /></center>
								<?php 
											}
											elseif(empty($r_ypeserta['paraf_peserta'])){
												echo ""; 
											}
											else{
												echo ""; 
											}
										}
										elseif($status_absen == "ijin"){ 
											echo "<center><b>IJIN</b></center>"; 
										}
										elseif($status_absen == "sakit"){ 
											echo "<center><b>SAKIT</b></center>"; 
										}
										elseif($status_absen == "tidak"){ 
											echo "<center><b>ALPA</b></center>"; 
										}
									}
									elseif(empty($status_absen)){
										echo "";
									}
								?>
							</td>
							<td><center><?=potong_nilai($totalnilai);?></center></td>
							<td>
								<?php
									if(!empty($nilaidpl1) AND !empty($nilaidpl2)){
										if(!empty($r_tdpl1['paraf_dpl'])){
								?>
									<center><img src="<?=$r_tdpl1['paraf_dpl'];?>" style="width:80px; height:50px; position:absolute; margin-top:-23px;" /></center>
								<?php
										}
										elseif(empty($r_tdpl1['paraf_dpl'])){
											echo "";
										}
										else{
											echo "";
										}
									}
									elseif(!empty($nilaidpl1) AND empty($nilaidpl2)){
										echo "";
									}	
									elseif(empty($nilaidpl1) AND !empty($nilaidpl2)){
										echo "";
									}	
									elseif(empty($nilaidpl1) AND empty($nilaidpl2)){
										echo "";
									}
									else{
										echo "";
									}
								?>
							</td>
							<td>
								<?php
									if(!empty($nilaidpl1) AND !empty($nilaidpl2)){
										if(!empty($r_tdpl2['paraf_dpl'])){
								?>
									<center><img src="<?=$r_tdpl2['paraf_dpl'];?>" style="width:80px; height:50px; position:absolute; margin-top:-23px;" /></center>
								<?php
										}
										elseif(empty($r_tdpl2['paraf_dpl'])){
											echo "";
										}
										else{
											echo "";
										}
									}
									elseif(!empty($nilaidpl1) AND empty($nilaidpl2)){
										echo "";
									}	
									elseif(empty($nilaidpl1) AND !empty($nilaidpl2)){
										echo "";
									}	
									elseif(empty($nilaidpl1) AND empty($nilaidpl2)){
										echo "";
									}
									else{
										echo "";
									}
								?>
							</td>
						</tr>
					<?php endwhile; ?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php 

	$html = ob_get_clean(); 
	require_once("../../assets/dompdf/autoload.inc.php");
	$dompdf = new Dompdf(); 
	$dompdf->loadHtml($html); 
	$dompdf->setPaper('A4', 'landscape'); 
	$dompdf->render(); 
	$dompdf->stream('Absen Pembekalan.pdf', array("Attachment"=>0));

		}
	if(isset($_GET['nukkelompok'])){
		
		$id_kelompok  = $_GET['nukkelompok'];
		$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		
		$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
		$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
			
		$r_tdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
			
		$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

		$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
			
		$r_tdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));
		
		$r_tlokasi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
	
		$r_tprov   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
								
		$r_tkota   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
		
		$r_tkec    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
		
		$r_tkel    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
		
		$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
		
		$r_nilaiukd1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl1' AND status_nilai='nilaiuk'"));
	
		$r_nilaiukd2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl2' AND status_nilai='nilaiuk'"));
		
		$d1nilai1  = $r_nilaiukd1['nilai1'];
		$d1hnilai1 = ($d1nilai1*40)/100;
		
		$d2nilai1  = $r_nilaiukd2['nilai1'];
		$d2hnilai1 = ($d2nilai1*40)/100;
		
		$d1nilai2  = $r_nilaiukd1['nilai2'];
		$d1hnilai2 = ($d1nilai2*30)/100;
		
		$d2nilai2  = $r_nilaiukd2['nilai2'];
		$d2hnilai2 = ($d2nilai2*30)/100;
		
		$d1nilai3  = $r_nilaiukd1['nilai3'];
		$d1hnilai3 = ($d1nilai3*30)/100;
		
		$d2nilai3  = $r_nilaiukd2['nilai3'];
		$d2hnilai3 = ($d2nilai3*30)/100;
		
		$d1tnilai  = $d1hnilai1+$d1hnilai2+$d1hnilai3;
		
		$d2tnilai  = $d2hnilai1+$d2hnilai2+$d2hnilai3;
		
		if($d1tnilai==0 AND $d2tnilai==0){
			$gnilai = "";
		}
		elseif($d1tnilai==0 AND $d2tnilai!==0){
			$gnilai = "";
		}
		elseif($d1tnilai!==0 AND $d2tnilai==0){
			$gnilai = "";
		}
		elseif($d1tnilai!== 0 AND $d2tnilai!== 0){
			$gnilai = ($d1tnilai+$d2tnilai)/2;
		}
		else{
			$gnilai = "";
		}
	
	ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../../assets/bootstrap/css/main.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="border-kop">
					<img src="../save/logo/logo.png" class="logo-kop-pt"/>
					<center class="kop-absen">
						<span><p>UNDANA KUPANG</p><p>UNIVERSITAS NUSA CENDANA</p></span>
						<p><?=ucwords($r_atur['alamat_stikom'])?></p>
						<p>Telp.<?=$r_atur['no_tlp_stikom']?> fax.<?=$r_atur['fax_stikom']?></p>
						<p>website: <?=strtolower($r_atur['website_stikom'])?>; email: <?=strtolower($r_atur['email_stikom'])?></p>
					</center>
				</div>
			</div>
			<div class="col-sm-12">
				<center class="kop-absen">
					<span>
						<p>EVALUASI KEBERHASILAN USULAN KEGIATAN KKN-PPM MAHASISWA</p>
						<p>FORMULIR EVALUASI DPL</p>
					</span>
				</center>
				<table class="table table-nobor-monev martop10" style="margin-bottom:-10px;">
					<tr>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">Desa/Kelurahan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkel['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kecamatan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkec['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kabupaten/Kota</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkota['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Usulan Judul Program</th>
									<th width="10">:</th>
									<th style="color:#fff;">-</th>
								</tr>
							</table>
						</td>
						<td width="50"></td>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">ID KKN Kelompok</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['tahun_kkn']?>-<?=$r_tprodi['kode_prodi']?>-0000002-<?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr>
									<th width="100">Kelompok Ke-</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-sm-12">
				<table class="table table-bordered-dom-monev martop10">
					<thead>
						<tr>
							<th width="10">No.</th>
							<th width="110">Nim</th>
							<th width="220">Nama Mahasiswa</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=0;
						
						$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta, tbl_peserta.paraf_peserta, tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
		
						while($r_ypeserta = mysqli_fetch_array($q_ypeserta)):
						
						$no++;
					?>
						<tr>
							<td><center><?=$no;?></center></td>
							<td><?=$r_ypeserta['nim']?></td>
							<td><?=strtoupper($r_ypeserta['nama_mahasiswa'])?></td>
						</tr>
					<?php endwhile; ?>	
					</tbody>
				</table>
			<span class="tfoot-ket">Penilaian :</span>
			<div class="colums-50">
				<table class="table table-bordered-dom-monev martop10">
					<thead>
						<tr>
							<th width="180">Komponent Penilaian</th>
							<th width="50">DPL A(A)</th>
							<th width="50">DPL 2(B)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>(I) Kesesuaian Dengan Tema (40%)</td>
							<td><center><?=((empty($d1nilai1))?'':potong_nilai($d1hnilai1));?></center></td>
							<td><center><?=((empty($d2nilai1))?'':potong_nilai($d2hnilai1));?></center></td>
						</tr>
						<tr>
							<td>(II) Kesesuaian Format (30%)</td>
							<td><center><?=((empty($d1nilai2))?'':potong_nilai($d1hnilai2));?></center></td>
							<td><center><?=((empty($d2nilai2))?'':potong_nilai($d2hnilai2));?></center></td>
						</tr>
						<tr>
							<td>(III) Tata Bahasa/Ragam Bahasa (30%)</td>
							<td><center><?=((empty($d1nilai3))?'':potong_nilai($d1hnilai3));?></center></td>
							<td><center><?=((empty($d2nilai3))?'':potong_nilai($d2hnilai3));?></center></td>
						</tr>
						<tr>
							<td><b>Total Nilai (I + II + III)</b></td>
							<td><center><b><?=((empty($d1nilai1) AND empty($d1nilai2) AND empty($d1nilai3))?'':potong_nilai($d1tnilai));?></b></center></td>
							<td><center><b><?=((empty($d2nilai1) AND empty($d2nilai2) AND empty($d2nilai3))?'':potong_nilai($d2tnilai));?></b></center></td>
						</tr>
						<tr>
							<td><b>Gabungan Nilai DPL 1 & 2 : (A + B)/2</b></td>
							<td colspan="2"><center><b><?=$gnilai;?></b></center></td>
						</tr>
					</tbody>
				</table>
			</div>
			</div>
				<div class="col-sm-12">
				<table class="table table-nobor-monev martop20" style="font-size:12px;">
					<tr>
						<td>
						<div class="">
							<br>
							<p>Dosen Pembimbing Lapangan Utama</p>
							<br><br><br>
							<u style="font-size:11px;"><?=strtoupper($r_tdosen1['nama_dosen'])?></u>
							<p style="font-size:11px;">NIDN.<?=$r_tdosen1['nidn']?></p>
						</div>
						</td>
						<td>
						<div class="pull-right">
							Kupang, <?=tgl_indo($tglsekarang);?>
							<p>Dosen Pembimbing Lapangan Pendamping</p>
							<br><br><br>
							<u style="font-size:11px;"><?=strtoupper($r_tdosen2['nama_dosen'])?></u>
							<p style="font-size:11px;">NIDN.<?=$r_tdosen2['nidn']?></p>
						</div>	
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php 

	$html = ob_get_clean(); 
	require_once("../../assets/dompdf/autoload.inc.php");
	$dompdf = new Dompdf(); 
	$dompdf->loadHtml($html); 
	$dompdf->setPaper('A4', 'portrait'); 
	$dompdf->render(); 
	$dompdf->stream('Nilai Usulan Kegiatan.pdf', array("Attachment"=>0));

		}
	if(isset($_GET['nlpkkelompok'])){
		
		$id_kelompok  = $_GET['nlpkkelompok'];
		$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		
		$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
		$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
			
		$r_tdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
			
		$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

		$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
			
		$r_tdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));
		
		$r_tlokasi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
	
		$r_tprov   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
								
		$r_tkota   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
		
		$r_tkec    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
		
		$r_tkel    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
		
		$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
		
		$r_tmitra  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
		
		if($r_tprodi['singkatan_prodi']=="TIS1"){
			$tprodi = "TIS1 / <span class='line-through'>SIS1</span>";
			}
		elseif($r_tprodi['singkatan_prodi']=="SIS1"){
			$tprodi = "<span class='line-through'>TIS1</span> / SIS1";
		}
		else{
			$tprodi = "TIS1 / SIS1";
		}
	
		$r_nilailpkd1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl1' AND status_nilai='nilailpk'"));
		
		$r_nilailpkd2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl2' AND status_nilai='nilailpk'"));
		
		$d1nilai1  = $r_nilailpkd1['nilai1'];
		$d1hnilai1 = ($d1nilai1*40)/100;
		
		$d2nilai1  = $r_nilailpkd2['nilai1'];
		$d2hnilai1 = ($d2nilai1*40)/100;
		
		$d1nilai2  = $r_nilailpkd1['nilai2'];
		$d1hnilai2 = ($d1nilai2*30)/100;
		
		$d2nilai2  = $r_nilailpkd2['nilai2'];
		$d2hnilai2 = ($d2nilai2*30)/100;
		
		$d1nilai3  = $r_nilailpkd1['nilai3'];
		$d1hnilai3 = ($d1nilai3*30)/100;
		
		$d2nilai3  = $r_nilailpkd2['nilai3'];
		$d2hnilai3 = ($d2nilai3*30)/100;
		
		$d1tnilai  = $d1hnilai1+$d1hnilai2+$d1hnilai3;
		
		$d2tnilai  = $d2hnilai1+$d2hnilai2+$d2hnilai3;
		
		if($d1tnilai==0 AND $d2tnilai==0){
			$gnilai = "";
		}
		elseif($d1tnilai==0 AND $d2tnilai!==0){
			$gnilai = "";
		}
		elseif($d1tnilai!==0 AND $d2tnilai==0){
			$gnilai = "";
		}
		elseif($d1tnilai!== 0 AND $d2tnilai!== 0){
			$gnilai = ($d1tnilai+$d2tnilai)/2;
		}
		else{
			$gnilai = "";
		}
	
	ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../../assets/bootstrap/css/main.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="border-kop">
					<img src="../save/logo/logo.png" class="logo-kop-pt"/>
					<center class="kop-absen">
						<span><p>UNDANA KUPANG</p><p>UNIVERSITAS NUSA CENDANA</p></span>
						<p><?=ucwords($r_atur['alamat_stikom'])?></p>
						<p>Telp.<?=$r_atur['no_tlp_stikom']?> fax.<?=$r_atur['fax_stikom']?></p>
						<p>website: <?=strtolower($r_atur['website_stikom'])?>; email: <?=strtolower($r_atur['email_stikom'])?></p>
					</center>
				</div>
			</div>
			<div class="col-sm-12">
				<center class="kop-absen">
					<span>
						<p>EVALUASI KEBERHASILAN LAPORAN PELAKSANAAN KKN-PPM MAHASISWA</p>
						<p>FORMULIR EVALUASI DPL</p>
					</span>
				</center>
				<table class="table table-nobor-monev martop10" style="margin-bottom:-10px;">
										<tr>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">Desa/Kelurahan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkel['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kecamatan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkec['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kabupaten/Kota</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkota['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Judul Program</th>
									<th width="10">:</th>
									<th style="color:#fff;">-</th>
								</tr>
							</table>
						</td>
						<td width="50"></td>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">ID KKN Kelompok</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['tahun_kkn']?>-<?=$r_tprodi['kode_prodi']?>-0000002-<?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr>
									<th width="100">Kelompok Ke-</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-sm-12">
				<table class="table table-bordered-dom-monev martop10">
					<thead>
						<tr>
							<th width="10">No.</th>
							<th width="110">Nim</th>
							<th width="220">Nama Mahasiswa</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no=0;
						
						$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta, tbl_peserta.paraf_peserta, tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
		
						while($r_ypeserta = mysqli_fetch_array($q_ypeserta)):
						
						$no++;
					?>
						<tr>
							<td><center><?=$no;?></center></td>
							<td><?=$r_ypeserta['nim']?></td>
							<td><?=strtoupper($r_ypeserta['nama_mahasiswa'])?></td>
						</tr>
					<?php endwhile; ?>	
					</tbody>
				</table>
			<span class="tfoot-ket">Penilaian :</span>
			<div class="colums-50 martop10">
				<table class="table table-bordered-dom-monev" style="margin-bottom:0px;">
					<thead>
						<tr>
							<th width="180">Komponent Penilaian</th>
							<th width="50">DPL A(A)</th>
							<th width="50">DPL 2(B)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>(I) Keberhasilan Program(40%)</td>
							<td><center><?=((empty($d1nilai1))?'':potong_nilai($d1hnilai1));?></center></td>
							<td><center><?=((empty($d2nilai1))?'':potong_nilai($d2hnilai1));?></center></td>
						</tr>
						<tr>
							<td>(II) Kesesuaian Format (30%)</td>
							<td><center><?=((empty($d1nilai2))?'':potong_nilai($d1hnilai2));?></center></td>
							<td><center><?=((empty($d2nilai2))?'':potong_nilai($d2hnilai2));?></center></td>
						</tr>
						<tr>
							<td>(III) Tata Bahasa/Ragam Bahasa (30%)</td>
							<td><center><?=((empty($d1nilai3))?'':potong_nilai($d1hnilai3));?></center></td>
							<td><center><?=((empty($d2nilai3))?'':potong_nilai($d2hnilai3));?></center></td>
						</tr>
						<tr>
							<td><b>Total Nilai (I + II + III)</b></td>
							<td><center><b><?=((empty($d1nilai1) AND empty($d1nilai2) AND empty($d1nilai3))?'':potong_nilai($d1tnilai));?></b></center></td>
							<td><center><b><?=((empty($d2nilai1) AND empty($d2nilai2) AND empty($d2nilai3))?'':potong_nilai($d2tnilai));?></b></center></td>
						</tr>
						<tr>
							<td><b>Gabungan Nilai DPL 1 & 2 : (A + B)/2</b></td>
							<td colspan="2"><center><b><?=potong_nilai($gnilai);?></b></center></td>
						</tr>
					</tbody>
				</table>
				<span class="tfoot-ket">*(I) Keberhasilan program yaitu peluang, kendala & solusi</span>
			</div>
			</div>
			<div class="col-sm-12">
				<table class="table table-nobor-monev martop20" style="font-size:12px;">
					<tr>
						<td>
						<div class="">
							<br>
							<p>Dosen Pembimbing Lapangan Utama</p>
							<br><br><br>
							<u style="font-size:11px;"><?=strtoupper($r_tdosen1['nama_dosen'])?></u>
							<p style="font-size:11px;">NIDN.<?=$r_tdosen1['nidn']?></p>
						</div>
						</td>
						<td>
						<div class="pull-right">
							Kupang, <?=tgl_indo($tglsekarang);?>
							<p>Dosen Pembimbing Lapangan Pendamping</p>
							<br><br><br>
							<u style="font-size:11px;"><?=strtoupper($r_tdosen2['nama_dosen'])?></u>
							<p style="font-size:11px;">NIDN.<?=$r_tdosen2['nidn']?></p>
						</div>	
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php 

	$html = ob_get_clean(); 
	require_once("../../assets/dompdf/autoload.inc.php");
	$dompdf = new Dompdf(); 
	$dompdf->loadHtml($html); 
	$dompdf->setPaper('A4', 'portrait'); 
	$dompdf->render(); 
	$dompdf->stream('Nilai Usulan Kegiatan.pdf', array("Attachment"=>0));

		}

	if(isset($_GET['nkmdkelompok'])){
	
		$id_kelompok  = $_GET['nkmdkelompok'];
		$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		
		$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
		$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
			
		$r_tdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
			
		$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

		$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
			
		$r_tdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));
		
		$r_tlokasi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
	
		$r_tprov   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
								
		$r_tkota   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
		
		$r_tkec    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
		
		$r_tkel    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
		
		$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
		
		$r_tmitra  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
		
		if($r_tprodi['singkatan_prodi']=="TIS1"){
			$tprodi = "TIS1 / <span class='line-through'>SIS1</span>";
			}
		elseif($r_tprodi['singkatan_prodi']=="SIS1"){
			$tprodi = "<span class='line-through'>TIS1</span> / SIS1";
		}
		else{
			$tprodi = "TIS1 / SIS1";
		}
	
	ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../../assets/bootstrap/css/main.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="border-kop">
					<img src="../save/logo/logo.png" class="logo-kop-ls"/>
					<center class="kop-absen">
						<<span><p>UNDANA KUPANG</p><p>UNIVERSITAS NUSA CENDANA</p></span>
						<p><?=ucwords($r_atur['alamat_stikom'])?></p>
						<p>Telp.<?=$r_atur['no_tlp_stikom']?> fax.<?=$r_atur['fax_stikom']?></p>
						<p>website: <?=strtolower($r_atur['website_stikom'])?>; email: <?=strtolower($r_atur['email_stikom'])?></p>
					</center>
				</div>
			</div>
			<div class="col-sm-12">
				<center class="kop-absen">
					<span>
						<p>EVALUASI KEBERHASILAN KINERJA MAHASISWA KKM-PPM</p>
						<p>FORMULIR EVALUASI DPL 1 DAN DPL 2</p>
					</span>
				</center>
				<div class="row-dom">
					<table class="table table-nobor-monev martop10" style="margin-bottom:-10px;">
					<tr>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">Desa/Kelurahan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkel['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kecamatan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkec['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kabupaten/Kota</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkota['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Judul Program</th>
									<th width="10">:</th>
									<td></td>
								</tr>
							</table>
						</td>
						<td width="20"></td>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">ID KKN Kelompok</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['tahun_kkn']?>-<?=$r_tprodi['kode_prodi']?>-0000002-<?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr>
									<th width="100">Kelompok Ke-</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
							</table>
						</td>
					</tr>
				</table>
				</div>
			</div>
			<div class="col-sm-12 martop10">
				<table class="table table-bordered-dom-monev">
					<tr>
						<th rowspan="3" width="20">No.</th>
						<th rowspan="3" width="200">Nama Mahasiswa</th>
						<th colspan="3">Nilai Disiplin</th>
						<th colspan="3">Nilain Kerjasama</th>
						<th rowspan="2">Total Disisplin</th>
						<th rowspan="2">Total Kerjasama</th>
					</tr>
					<tr>
						<td><center>Monev 1</center></td>
						<td><center>Monev 2</center></td>
						<td><center>Monev 3</center></td>
						<td><center>Monev 1</center></td>
						<td><center>Monev 2</center></td>
						<td><center>Monev 3</center></td>
					</tr>
					<tr>
						<td width="50"><center>(DPL 1+2)/2</center></td>
						<td width="50"><center>(DPL 1+2)/2</center></td>
						<td width="50"><center>(DPL 1+2)/2</center></td>
						<td width="50"><center>(DPL 1+2)/2</center></td>
						<td width="50"><center>(DPL 1+2)/2</center></td>
						<td width="50"><center>(DPL 1+2)/2</center></td>
						<td><center>(M1 + M2+ M3)/3</center></td>
						<td><center>(M1 + M2+ M3)/3</center></td>
					</tr>
					<?php
						$no=0;
						
						$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta,tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
						while($r_ypeserta = mysqli_fetch_array($q_ypeserta)):
						
						/*****************************************************************************************
							MONEV 1
						******************************************************************************************/
						$r_monev1_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev1'"));
						
						$r_monev1_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev1'"));
						
						
						$m1_nilaids_dpl1 = $r_monev1_dpl1['nilai_ds'];
						$m1_nilaids_dpl2 = $r_monev1_dpl2['nilai_ds'];
											
						$m1_nilaiks_dpl1 = $r_monev1_dpl1['nilai_ks'];
						$m1_nilaiks_dpl2 = $r_monev1_dpl2['nilai_ks'];
						
						/***************** NILAI KM-DS MONEV 1 *****************/
						if(empty($m1_nilaids_dpl1) AND empty($m1_nilaids_dpl2)){
							$tm1_nilaids = "";
						}
						elseif(!empty($m1_nilaids_dpl1) AND empty($m1_nilaids_dpl2)){
							$tm1_nilaids = "";
						}
						elseif(empty($m1_nilaids_dpl1) AND !empty($m1_nilaids_dpl2)){
							$tm1_nilaids = "";
						}
						elseif(!empty($m1_nilaids_dpl1) AND !empty($m1_nilaids_dpl2)){
							$tm1_nilaids = ($m1_nilaids_dpl1+$m1_nilaids_dpl2)/2;
						}
						else{
							$tm1_nilaids = "";
						}
						/***************** NILAI KM-KS MONEV 1 *****************/
						if(empty($m1_nilaiks_dpl1) AND empty($m1_nilaiks_dpl2)){
							$tm1_nilaiks = "";
						}
						elseif(!empty($m1_nilaiks_dpl1) AND empty($m1_nilaiks_dpl2)){
							$tm1_nilaiks = "";
						}
						elseif(empty($m1_nilaiks_dpl1) AND !empty($m1_nilaiks_dpl2)){
							$tm1_nilaiks = "";
						}
						elseif(!empty($m1_nilaiks_dpl1) AND !empty($m1_nilaiks_dpl2)){
							$tm1_nilaiks = ($m1_nilaiks_dpl1+$m1_nilaiks_dpl2)/2;
						}
						else{
							$tm1_nilaiks = "";
						}
						
						/*****************************************************************************************
							MONEV 2
						******************************************************************************************/
						$r_monev2_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev2'"));
						
						$r_monev2_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev2'"));
						
						
						$m2_nilaids_dpl1 = $r_monev2_dpl1['nilai_ds'];
						$m2_nilaids_dpl2 = $r_monev2_dpl2['nilai_ds'];
											
						$m2_nilaiks_dpl1 = $r_monev2_dpl1['nilai_ks'];
						$m2_nilaiks_dpl2 = $r_monev2_dpl2['nilai_ks'];
						
						/***************** NILAI KM-DS MONEV 2 *****************/
						if(empty($m2_nilaids_dpl1) AND empty($m2_nilaids_dpl2)){
							$tm2_nilaids = "";
						}
						elseif(!empty($m2_nilaids_dpl1) AND empty($m2_nilaids_dpl2)){
							$tm2_nilaids = "";
						}
						elseif(empty($m2_nilaids_dpl1) AND !empty($m2_nilaids_dpl2)){
							$tm2_nilaids = "";
						}
						elseif(!empty($m2_nilaids_dpl1) AND !empty($m2_nilaids_dpl2)){
							$tm2_nilaids = ($m2_nilaids_dpl1+$m2_nilaids_dpl2)/2;
						}
						else{
							$tm2_nilaids = "";
						}
						/***************** NILAI KM-KS MONEV 2 *****************/
						if(empty($m2_nilaiks_dpl1) AND empty($m2_nilaiks_dpl2)){
							$tm2_nilaiks = "";
						}
						elseif(!empty($m2_nilaiks_dpl1) AND empty($m2_nilaiks_dpl2)){
							$tm2_nilaiks = "";
						}
						elseif(empty($m2_nilaiks_dpl1) AND !empty($m2_nilaiks_dpl2)){
							$tm2_nilaiks = "";
						}
						elseif(!empty($m2_nilaiks_dpl1) AND !empty($m2_nilaiks_dpl2)){
							$tm2_nilaiks = ($m2_nilaiks_dpl1+$m2_nilaiks_dpl2)/2;
						}
						else{
							$tm2_nilaiks = "";
						}
						
						/*****************************************************************************************
							MONEV 3
						******************************************************************************************/
						$r_monev3_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev3'"));
						
						$r_monev3_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev3'"));
						
						
						$m3_nilaids_dpl1 = $r_monev3_dpl1['nilai_ds'];
						$m3_nilaids_dpl2 = $r_monev3_dpl2['nilai_ds'];
											
						$m3_nilaiks_dpl1 = $r_monev3_dpl1['nilai_ks'];
						$m3_nilaiks_dpl2 = $r_monev3_dpl2['nilai_ks'];
						
						/***************** NILAI KM-DS MONEV 3 *****************/
						if(empty($m3_nilaids_dpl1) AND empty($m3_nilaids_dpl2)){
							$tm3_nilaids = "";
						}
						elseif(!empty($m3_nilaids_dpl1) AND empty($m3_nilaids_dpl2)){
							$tm3_nilaids = "";
						}
						elseif(empty($m3_nilaids_dpl1) AND !empty($m3_nilaids_dpl2)){
							$tm3_nilaids = "";
						}
						elseif(!empty($m3_nilaids_dpl1) AND !empty($m3_nilaids_dpl2)){
							$tm3_nilaids = ($m3_nilaids_dpl1+$m3_nilaids_dpl2)/2;
						}
						else{
							$tm3_nilaids = "";
						}
						/***************** NILAI KM-KS MONEV 3 *****************/
						if(empty($m3_nilaiks_dpl1) AND empty($m3_nilaiks_dpl2)){
							$tm3_nilaiks = "";
						}
						elseif(!empty($m3_nilaiks_dpl1) AND empty($m3_nilaiks_dpl2)){
							$tm3_nilaiks = "";
						}
						elseif(empty($m3_nilaiks_dpl1) AND !empty($m3_nilaiks_dpl2)){
							$tm3_nilaiks = "";
						}
						elseif(!empty($m3_nilaiks_dpl1) AND !empty($m3_nilaiks_dpl2)){
							$tm3_nilaiks = ($m3_nilaiks_dpl1+$m3_nilaiks_dpl2)/2;
						}
						else{
							$tm3_nilaiks = "";
						}
						
						/*****************************************************************************************
							GABUNGAN TOTAL NILAI DS
						******************************************************************************************/
						
						if($tm1_nilaids==0 AND $tm2_nilaids==0 AND $tm3_nilaids==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids!==0 AND $tm2_nilaids==0 AND $tm3_nilaids==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids==0 AND $tm2_nilaids!==0 AND $tm3_nilaids==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids==0 AND $tm2_nilaids==0 AND $tm3_nilaids!==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids!==0 AND $tm2_nilaids!==0 AND $tm3_nilaids==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids==0 AND $tm2_nilaids!==0 AND $tm3_nilaids!==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids!==0 AND $tm2_nilaids==0 AND $tm3_nilaids!==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids!==0 AND $tm2_nilaids==!0 AND $tm3_nilaids!==0){
							$g_nilaids = ($tm1_nilaids+$tm2_nilaids+$tm3_nilaids)/3;
						}
						else{
							$g_nilaids = "";
						}
						
						/*****************************************************************************************
							GABUNGAN TOTAL NILAI KS
						******************************************************************************************/
						
						if($tm1_nilaiks==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks!==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks!==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks!==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks!==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==!0 AND $tm3_nilaiks!==0){
							$g_nilaiks = ($tm1_nilaiks+$tm2_nilaiks+$tm3_nilaiks)/3;
						}
						else{
							$g_nilaiks = "";
						}
						
						
						$no++;	
					?>
					<tr>
						<td><center><?=$no;?></center></td>
						<td><?=strtoupper($r_ypeserta['nama_mahasiswa'])?></td>
						<td><center><?=potong_nilai($tm1_nilaids);?></center></td>
						<td><center><?=potong_nilai($tm2_nilaids);?></center></td>
						<td><center><?=potong_nilai($tm3_nilaids);?></center></td>
						<td><center><?=potong_nilai($tm1_nilaiks);?></center></td>
						<td><center><?=potong_nilai($tm2_nilaiks);?></center></td>
						<td><center><?=potong_nilai($tm3_nilaiks);?></center></td>
						<td><center><?=potong_nilai($g_nilaids);?></center></td>
						<td><center><?=potong_nilai($g_nilaiks);?></center></td>
					</tr>
					<?php endwhile; ?>
				</table>
				<span class="tfoot-ket">
				<p>Ketentuan penilaian :</p>
				</span>
				<table class="table table-nobor-monev-km">
					<tr>
						<td>- Setiap penilaian dilakukan per Monev yang dilakukan (3 kali monev).</td>
					</tr>
					<tr>
						<td>- Rentang nilai berada pada nilai 0-100 mengikuti rentang nilai yang ditetapkan oleh STIKOM Uyeelindo Kupang.</td>
					</tr>
				</table>			
			</div>
			<div class="col-sm-12">
				<table class="table table-nobor-monev martop20" style="font-size:12px;">
					<tr>
						<td width="300">
							<div class="">
								<br>
								<p>Dosen Pembimbing Lapangan Utama</p>
								<br><br><br>
								<u style="font-size:11px;"><?=strtoupper($r_tdosen1['nama_dosen'])?></u>
								<p style="font-size:11px;">NIDN.<?=$r_tdosen1['nidn']?></p>
							</div>
						</td>
						<td width="200">
							<div class="pull-right">
								Kupang, <?=tgl_indo($tglsekarang);?>
								<p>Dosen Pembimbing Lapangan Pendamping</p>
								<br><br><br>
								<u style="font-size:11px;"><?=strtoupper($r_tdosen2['nama_dosen'])?></u>
								<p style="font-size:11px;">NIDN.<?=$r_tdosen2['nidn']?></p>
							</div>	
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php 

	$html = ob_get_clean(); 
	require_once("../../assets/dompdf/autoload.inc.php");
	$dompdf = new Dompdf(); 
	$dompdf->loadHtml($html); 
	$dompdf->setPaper('A4', 'landscape'); 
	$dompdf->render(); 
	$dompdf->stream('Kenerja Mahasiswa.pdf', array("Attachment"=>0));

		}		
	if(isset($_GET['nkmmkelompok'])){
	
		$id_kelompok  = $_GET['nkmmkelompok'];
		$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		
		$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
		$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
			
		$r_tdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
			
		$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

		$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
			
		$r_tdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));
		
		$r_tlokasi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
	
		$r_tprov   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
								
		$r_tkota   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
		
		$r_tkec    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
		
		$r_tkel    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
		
		$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
		
		$r_tmitra  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
		
		if($r_tprodi['singkatan_prodi']=="TIS1"){
			$tprodi = "TIS1 / <span class='line-through'>SIS1</span>";
			}
		elseif($r_tprodi['singkatan_prodi']=="SIS1"){
			$tprodi = "<span class='line-through'>TIS1</span> / SIS1";
		}
		else{
			$tprodi = "TIS1 / SIS1";
		}
	
	ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../../assets/bootstrap/css/main.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="border-kop">
					<img src="../save/logo/logo.png" class="logo-kop-pt"/>
					<center class="kop-absen">
						<span><p>UNDANA KUPANG</p><p>UNIVERSITAS NUSA CENDANA</p></span>
						<p><?=ucwords($r_atur['alamat_stikom'])?></p>
						<p>Telp.<?=$r_atur['no_tlp_stikom']?> fax.<?=$r_atur['fax_stikom']?></p>
						<p>website: <?=strtolower($r_atur['website_stikom'])?>; email: <?=strtolower($r_atur['email_stikom'])?></p>
					</center>
				</div>
			</div>
			<div class="col-sm-12">
				<center class="kop-absen">
					<span>
						<p>EVALUASI KEBERHASILAN KINERJA MAHASISWA KKM-PPM</p>
						<p>FORMULIR EVALUASI MITRA</p>
					</span>
				</center>
				<table class="table table-nobor-monev martop10" style="margin-bottom:-10px;">
										<tr>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">Desa/Kelurahan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkel['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kecamatan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkec['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kabupaten/Kota</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkota['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Judul Program</th>
									<th width="10">:</th>
									<th style="color:#fff;">-</th>
								</tr>
							</table>
						</td>
						<td width="50"></td>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">ID KKN Kelompok</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['tahun_kkn']?>-<?=$r_tprodi['kode_prodi']?>-0000002-<?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr>
									<th width="100">Kelompok Ke-</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-sm-12 martop10">
				<table class="table table-bordered-dom-monev">
					<tr>
						<th width="20">No.</th>
						<th width="80">NIM</th>
						<th width="200">Nama Mahasiswa</th>
						<th>Nilai Disiplin</th>
						<th>Nilain Kerjasama</th>
					</tr>
				<?php
					$no=0;
					$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta,tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
							
					while($r_ypeserta = mysqli_fetch_array($q_ypeserta)):
					
					/*****************************************************************************************
							MONEV 3
					******************************************************************************************/
					
					$r_monev3_mitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='mitra' AND tbl_jadwal.status_jadwal='monev3'"));
							
					$m3_nilaids_mitra = $r_monev3_mitra['nilai_ds'];										
					$m3_nilaiks_mitra = $r_monev3_mitra['nilai_ks'];
				
					
					$no++;
				?>
					<tr>
						<td><center><?=$no;?></center></td>
						<td><?=strtoupper($r_ypeserta['nim'])?></td>
						<td><?=strtoupper($r_ypeserta['nama_mahasiswa'])?></td>
						<td><center><?=((empty($m3_nilaids_mitra))?'':potong_nilai($m3_nilaids_mitra))?></center></td>
						<td><center><?=((empty($m3_nilaiks_mitra))?'':potong_nilai($m3_nilaiks_mitra))?></center></td>
					</tr>
				<?php endwhile; ?>	
				</table>
				<span class="tfoot-ket">
					<table class="table table-nobor-monev">
						<tr>
							<td width="80">Ketentuan Penilaian</td>
							<td width="10">:</th>
							<td></td>
						</tr>
						<tr>
							<td width="80">- Sangat Baik</td>
							<td width="10">:</th>
							<td>86-100</td>
						</tr>
						<tr>
							<td width="80">- Baik</td>
							<td width="10">:</th>
							<td>76-85</td>
						</tr>
						<tr>
							<td width="80">- Cukup</td>
							<td width="10">:</th>
							<td>65-75</td>
						</tr>
						<tr>
							<td width="80">- Kurang</td>
							<td width="10">:</th>
							<td>55-64</td>
						</tr>
						<tr>
							<td width="80">- Kurang Sekali</td>
							<td width="10">:</td>
							<td>&#60; 55</td>
						</tr>
					</table>
				</span>
			</div>
			<div class="col-sm-12">
				<table class="table table-nobor-monev martop20" style="font-size:12px;">
					<tr>
						<td width="300">
							<div class="">
							</div>
						</td>
						<td width="200">
						<div class="pull-right">
							Kupang, <?=tgl_indo($tglsekarang);?>
							<p style="white-space: nowrap;">Mitra Penilai</p>
							<br><br><br>
							<u style="font-size:11px;"><?=strtoupper($r_tmitra['nama_mitra'])?></u>
							<p style="font-size:11px;">NIP.<?=(($r_tmitra['nip']==0 || $r_tmitra['nip']=='' || $r_tmitra['nip']=="-")?'':$r_tmitra['nip'])?></p>
						</div>	
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php 

	$html = ob_get_clean(); 
	require_once("../../assets/dompdf/autoload.inc.php");
	$dompdf = new Dompdf(); 
	$dompdf->loadHtml($html); 
	$dompdf->setPaper('A4', 'portrait'); 
	$dompdf->render(); 
	$dompdf->stream('Kenerja Mahasiswa.pdf', array("Attachment"=>0));

		}		
	if(isset($_GET['nkmgkelompok'])){
	
		$id_kelompok  = $_GET['nkmgkelompok'];
		$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		
		$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
		$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
			
		$r_tdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
			
		$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

		$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
			
		$r_tdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));
		
		$r_tlokasi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
	
		$r_tprov   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
								
		$r_tkota   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
		
		$r_tkec    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
		
		$r_tkel    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
		
		$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
		
		$r_tmitra  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
		
		if($r_tprodi['singkatan_prodi']=="TIS1"){
			$tprodi = "TIS1 / <span class='line-through'>SIS1</span>";
			}
		elseif($r_tprodi['singkatan_prodi']=="SIS1"){
			$tprodi = "<span class='line-through'>TIS1</span> / SIS1";
		}
		else{
			$tprodi = "TIS1 / SIS1";
		}
	
	ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../../assets/bootstrap/css/main.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="border-kop">
					<img src="../save/logo/logo.png" class="logo-kop-ls"/>
					<center class="kop-absen">
						<span><p>UNDANA KUPANG</p><p>UNIVERSITAS NUSA CENDANA</p></span>
						<p><?=ucwords($r_atur['alamat_stikom'])?></p>
						<p>Telp.<?=$r_atur['no_tlp_stikom']?> fax.<?=$r_atur['fax_stikom']?></p>
						<p>website: <?=strtolower($r_atur['website_stikom'])?>; email: <?=strtolower($r_atur['email_stikom'])?></p>
					</center>
				</div>
			</div>
			<div class="col-sm-12">
				<center class="kop-absen">
					<span>
						<p>EVALUASI KEBERHASILAN KINERJA MAHASISWA KKM-PPM</p>
						<p>FORMULIR EVALUASI GABUNGAN</p>
					</span>
				</center>
				<div class="row-dom">
					<table class="table table-nobor-monev martop10" style="margin-bottom:-10px;">
					<tr>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">Desa/Kelurahan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkel['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kecamatan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkec['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kabupaten/Kota</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkota['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Judul Program</th>
									<th width="10">:</th>
									<td></td>
								</tr>
							</table>
						</td>
						<td width="20"></td>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">ID KKN Kelompok</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['tahun_kkn']?>-<?=$r_tprodi['kode_prodi']?>-0000002-<?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr>
									<th width="100">Kelompok Ke-</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
							</table>
						</td>
					</tr>
				</table>
				</div>
			</div>
			<div class="col-sm-12 martop10">
				<table class="table table-bordered-dom-monev">
					<tr>
						<th rowspan="2" width="20">No.</th>
						<th rowspan="2" width="200">Nama Mahasiswa</th>
						<th colspan="2">Nilai Disiplin</th>
						<th colspan="2">Nilai Kerjasama</th>
						<th rowspan="2">Total Disiplin (DS)</th>
						<th rowspan="2">Total Kerjasama (KS)</th>
						<th>Total</th>
					</tr>
					<tr>
						<td width="50"><center>DPL 50%</center></td>
						<td width="50"><center>Mitra 50%</center></td>
						<td width="50"><center>DPL 50%</center></td>
						<td width="50"><center>Mitra 50%</center></td>
						<td width="50"><center>(DS + KS)/2</center></td>
					</tr>
				<?php
					$no=0;
					$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta,tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
							
					while($r_ypeserta = mysqli_fetch_array($q_ypeserta)):
					
					/*****************************************************************************************
						MONEV 1
					******************************************************************************************/
					$r_monev1_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev1'"));
					
					$r_monev1_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev1'"));
					
					
					$m1_nilaids_dpl1 = $r_monev1_dpl1['nilai_ds'];
					$m1_nilaids_dpl2 = $r_monev1_dpl2['nilai_ds'];
										
					$m1_nilaiks_dpl1 = $r_monev1_dpl1['nilai_ks'];
					$m1_nilaiks_dpl2 = $r_monev1_dpl2['nilai_ks'];
					
					/***************** NILAI KM-DS MONEV 1 *****************/
					if(empty($m1_nilaids_dpl1) AND empty($m1_nilaids_dpl2)){
						$tm1_nilaids = "";
					}
					elseif(!empty($m1_nilaids_dpl1) AND empty($m1_nilaids_dpl2)){
						$tm1_nilaids = "";
					}
					elseif(empty($m1_nilaids_dpl1) AND !empty($m1_nilaids_dpl2)){
						$tm1_nilaids = "";
					}
					elseif(!empty($m1_nilaids_dpl1) AND !empty($m1_nilaids_dpl2)){
						$tm1_nilaids = ($m1_nilaids_dpl1+$m1_nilaids_dpl2)/2;
					}
					else{
						$tm1_nilaids = "";
					}
					/***************** NILAI KM-KS MONEV 1 *****************/
					if(empty($m1_nilaiks_dpl1) AND empty($m1_nilaiks_dpl2)){
						$tm1_nilaiks = "";
					}
					elseif(!empty($m1_nilaiks_dpl1) AND empty($m1_nilaiks_dpl2)){
						$tm1_nilaiks = "";
					}
					elseif(empty($m1_nilaiks_dpl1) AND !empty($m1_nilaiks_dpl2)){
						$tm1_nilaiks = "";
					}
					elseif(!empty($m1_nilaiks_dpl1) AND !empty($m1_nilaiks_dpl2)){
						$tm1_nilaiks = ($m1_nilaiks_dpl1+$m1_nilaiks_dpl2)/2;
					}
					else{
						$tm1_nilaiks = "";
					}
					
					/*****************************************************************************************
						MONEV 2
					******************************************************************************************/
					$r_monev2_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev2'"));
					
					$r_monev2_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev2'"));
					
					
					$m2_nilaids_dpl1 = $r_monev2_dpl1['nilai_ds'];
					$m2_nilaids_dpl2 = $r_monev2_dpl2['nilai_ds'];
										
					$m2_nilaiks_dpl1 = $r_monev2_dpl1['nilai_ks'];
					$m2_nilaiks_dpl2 = $r_monev2_dpl2['nilai_ks'];
					
					/***************** NILAI KM-DS MONEV 2 *****************/
					if(empty($m2_nilaids_dpl1) AND empty($m2_nilaids_dpl2)){
						$tm2_nilaids = "";
					}
					elseif(!empty($m2_nilaids_dpl1) AND empty($m2_nilaids_dpl2)){
						$tm2_nilaids = "";
					}
					elseif(empty($m2_nilaids_dpl1) AND !empty($m2_nilaids_dpl2)){
						$tm2_nilaids = "";
					}
					elseif(!empty($m2_nilaids_dpl1) AND !empty($m2_nilaids_dpl2)){
						$tm2_nilaids = ($m2_nilaids_dpl1+$m2_nilaids_dpl2)/2;
					}
					else{
						$tm2_nilaids = "";
					}
					/***************** NILAI KM-KS MONEV 2 *****************/
					if(empty($m2_nilaiks_dpl1) AND empty($m2_nilaiks_dpl2)){
						$tm2_nilaiks = "";
					}
					elseif(!empty($m2_nilaiks_dpl1) AND empty($m2_nilaiks_dpl2)){
						$tm2_nilaiks = "";
					}
					elseif(empty($m2_nilaiks_dpl1) AND !empty($m2_nilaiks_dpl2)){
						$tm2_nilaiks = "";
					}
					elseif(!empty($m2_nilaiks_dpl1) AND !empty($m2_nilaiks_dpl2)){
						$tm2_nilaiks = ($m2_nilaiks_dpl1+$m2_nilaiks_dpl2)/2;
					}
					else{
						$tm2_nilaiks = "";
					}
					
					/*****************************************************************************************
						MONEV 3
					******************************************************************************************/
					$r_monev3_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev3'"));
					
					$r_monev3_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev3'"));
					
					
					$m3_nilaids_dpl1 = $r_monev3_dpl1['nilai_ds'];
					$m3_nilaids_dpl2 = $r_monev3_dpl2['nilai_ds'];
										
					$m3_nilaiks_dpl1 = $r_monev3_dpl1['nilai_ks'];
					$m3_nilaiks_dpl2 = $r_monev3_dpl2['nilai_ks'];
					
					/***************** NILAI KM-DS MONEV 3 *****************/
					if(empty($m3_nilaids_dpl1) AND empty($m3_nilaids_dpl2)){
						$tm3_nilaids = "";
					}
					elseif(!empty($m3_nilaids_dpl1) AND empty($m3_nilaids_dpl2)){
						$tm3_nilaids = "";
					}
					elseif(empty($m3_nilaids_dpl1) AND !empty($m3_nilaids_dpl2)){
						$tm3_nilaids = "";
					}
					elseif(!empty($m3_nilaids_dpl1) AND !empty($m3_nilaids_dpl2)){
						$tm3_nilaids = ($m3_nilaids_dpl1+$m3_nilaids_dpl2)/2;
					}
					else{
						$tm3_nilaids = "";
					}
					/***************** NILAI KM-KS MONEV 3 *****************/
					if(empty($m3_nilaiks_dpl1) AND empty($m3_nilaiks_dpl2)){
						$tm3_nilaiks = "";
					}
					elseif(!empty($m3_nilaiks_dpl1) AND empty($m3_nilaiks_dpl2)){
						$tm3_nilaiks = "";
					}
					elseif(empty($m3_nilaiks_dpl1) AND !empty($m3_nilaiks_dpl2)){
						$tm3_nilaiks = "";
					}
					elseif(!empty($m3_nilaiks_dpl1) AND !empty($m3_nilaiks_dpl2)){
						$tm3_nilaiks = ($m3_nilaiks_dpl1+$m3_nilaiks_dpl2)/2;
					}
					else{
						$tm3_nilaiks = "";
					}
					
					/*****************************************************************************************
						GABUNGAN TOTAL NILAI DS
					******************************************************************************************/
					
					if($tm1_nilaids==0 AND $tm2_nilaids==0 AND $tm3_nilaids==0){
						$g_nilaids = "";
					}
					elseif($tm1_nilaids!==0 AND $tm2_nilaids==0 AND $tm3_nilaids==0){
						$g_nilaids = "";
					}
					elseif($tm1_nilaids==0 AND $tm2_nilaids!==0 AND $tm3_nilaids==0){
						$g_nilaids = "";
					}
					elseif($tm1_nilaids==0 AND $tm2_nilaids==0 AND $tm3_nilaids!==0){
						$g_nilaids = "";
					}
					elseif($tm1_nilaids!==0 AND $tm2_nilaids!==0 AND $tm3_nilaids==0){
						$g_nilaids = "";
					}
					elseif($tm1_nilaids==0 AND $tm2_nilaids!==0 AND $tm3_nilaids!==0){
						$g_nilaids = "";
					}
					elseif($tm1_nilaids!==0 AND $tm2_nilaids==0 AND $tm3_nilaids!==0){
						$g_nilaids = "";
					}
					elseif($tm1_nilaids!==0 AND $tm2_nilaids==!0 AND $tm3_nilaids!==0){
						$g_nilaids = ($tm1_nilaids+$tm2_nilaids+$tm3_nilaids)/3;
					}
					else{
						$g_nilaids = "";
					}
					
					/*****************************************************************************************
						GABUNGAN TOTAL NILAI KS
					******************************************************************************************/
					
					if($tm1_nilaiks==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks==0){
						$g_nilaiks = "";
					}
					elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks==0){
						$g_nilaiks = "";
					}
					elseif($tm1_nilaiks==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks==0){
						$g_nilaiks = "";
					}
					elseif($tm1_nilaiks==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks!==0){
						$g_nilaiks = "";
					}
					elseif($tm1_nilaiks!==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks==0){
						$g_nilaiks = "";
					}
					elseif($tm1_nilaiks==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks!==0){
						$g_nilaiks = "";
					}
					elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks!==0){
						$g_nilaiks = "";
					}
					elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==!0 AND $tm3_nilaiks!==0){
						$g_nilaiks = ($tm1_nilaiks+$tm2_nilaiks+$tm3_nilaiks)/3;
					}
					else{
						$g_nilaiks = "";
					}
					
					/*****************************************************************************************
							MONEV 3
					******************************************************************************************/
					
					$r_monev3_mitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='mitra' AND tbl_jadwal.status_jadwal='monev3'"));
							
					$m3_nilaids_mitra = $r_monev3_mitra['nilai_ds'];										
					$m3_nilaiks_mitra = $r_monev3_mitra['nilai_ks'];
					
					/*****************************************************************************************
							TOTAL DS DPL
					******************************************************************************************/

					$ds_dpl    = ($g_nilaids*50)/100;
					$ds_mitra  = ($m3_nilaids_mitra*50)/100;

					$ks_dpl    = ($g_nilaiks*50)/100;
					$ks_mitra  = ($m3_nilaiks_mitra*50)/100;
					
					if($ds_dpl == 0 AND $ds_mitra == 0){
						$tnilai_ds = "";
					}
					elseif($ds_dpl !== 0 AND $ds_mitra == 0){
						$tnilai_ds = "";
					}
					elseif($ds_dpl == 0 AND $ds_mitra !== 0){
						$tnilai_ds = "";
					}
					elseif($ds_dpl !== 0 AND $ds_mitra !== 0){
						$tnilai_ds = $ds_dpl+$ds_mitra;
					}
					else{
						$tnilai_ds = "";
					}
					
					if($ks_dpl == 0 AND $ks_mitra == 0){
						$tnilai_ks = "";
					}
					elseif($ks_dpl !== 0 AND $ks_mitra == 0){
						$tnilai_ks = "";
					}
					elseif($ks_dpl == 0 AND $ks_mitra !== 0){
						$tnilai_ks = "";
					}
					elseif($ks_dpl !== 0 AND $ks_mitra !== 0){
						$tnilai_ks = $ks_dpl+$ks_mitra;
					}
					else{
						$tnilai_ks = "";
					}
					
					if($tnilai_ds == 0 AND $tnilai_ks == 0){
						$tnilai_km = "";
					}
					elseif($tnilai_ds !== 0 AND $tnilai_ks == 0){
						$tnilai_km = "";
					}
					elseif($tnilai_ds == 0 AND $tnilai_ks !== 0){
						$tnilai_km = "";
					}
					elseif($tnilai_ds !== 0 AND $tnilai_ks !== 0){
						$tnilai_km = ($tnilai_ds+$tnilai_ks)/2;
					}
					else{
						$tnilai_km = "";
					}
					
					$no++;
				?>	
					<tr>
						<td><center><?=$no;?></center></td>
						<td><?=strtoupper($r_ypeserta['nama_mahasiswa'])?></td>
						<td><center><?=(($ds_dpl == 0)?'':potong_nilai($ds_dpl));?></center></td>
						<td><center><?=(($ds_mitra == 0)?'':potong_nilai($ds_mitra));?></center></td>
						<td><center><?=(($ks_dpl == 0)?'':potong_nilai($ks_dpl));?></center></td>
						<td><center><?=(($ks_mitra == 0)?'':potong_nilai($ks_mitra));?></center></td>
						<td><center><?=potong_nilai($tnilai_ds);?></center></td>
						<td><center><?=potong_nilai($tnilai_ks);?></center></td>
						<td><center><?=potong_nilai($tnilai_km);?></center></td>
					</tr>
				<?php endwhile; ?>	
				</table>
			</div>
			<div class="col-sm-12">
				<table class="table table-nobor-monev martop20" style="font-size:12px;">
					<tr>
						<td width="300">
							<div class="">
								<br>
								<p>Dosen Pembimbing Lapangan Utama</p>
								<br><br><br>
								<u style="font-size:11px;"><?=strtoupper($r_tdosen1['nama_dosen'])?></u>
								<p style="font-size:11px;">NIDN.<?=$r_tdosen1['nidn']?></p>
							</div>
						</td>
						<td width="200">
							<div class="pull-right">
								Kupang, <?=tgl_indo($tglsekarang);?>
								<p>Dosen Pembimbing Lapangan Pendamping</p>
								<br><br><br>
								<u style="font-size:11px;"><?=strtoupper($r_tdosen2['nama_dosen'])?></u>
								<p style="font-size:11px;">NIDN.<?=$r_tdosen2['nidn']?></p>
							</div>	
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php 

	$html = ob_get_clean(); 
	require_once("../../assets/dompdf/autoload.inc.php");
	$dompdf = new Dompdf(); 
	$dompdf->loadHtml($html); 
	$dompdf->setPaper('A4', 'landscape'); 
	$dompdf->render(); 
	$dompdf->stream('Kenerja Mahasiswa.pdf', array("Attachment"=>0));

		}
	
	if(isset($_GET['nplkelompok'])){
		 		
		$id_kelompok  = $_GET['nplkelompok'];
		$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
			
		$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
		$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
			
		$r_tdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
			
		$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

		$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
			
		$r_tdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));
		
		$r_tlokasi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
	
		$r_tprov   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
							
		$r_tkota   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
		
		$r_tkec    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
		
		$r_tkel    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
		
		$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
		
		$r_tmitra  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
		
		if($r_tprodi['singkatan_prodi']=="TIS1"){
			$tprodi = "TIS1 / <span class='line-through'>SIS1</span>";
			}
		elseif($r_tprodi['singkatan_prodi']=="SIS1"){
			$tprodi = "<span class='line-through'>TIS1</span> / SIS1";
		}
		else{
			$tprodi = "TIS1 / SIS1";
		}
	
	ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../../assets/bootstrap/css/main.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="border-kop">
					<img src="../save/logo/logo.png" class="logo-kop-pt"/>
					<center class="kop-absen">
						<span><p>UNDANA KUPANG</p><p>UNIVERSITAS NUSA CENDANA</p></span>
						<p><?=ucwords($r_atur['alamat_stikom'])?></p>
						<p>Telp.<?=$r_atur['no_tlp_stikom']?> fax.<?=$r_atur['fax_stikom']?></p>
						<p>website: <?=strtolower($r_atur['website_stikom'])?>; email: <?=strtolower($r_atur['email_stikom'])?></p>
					</center>
				</div>
			</div>
			<div class="col-sm-12">
				<center class="kop-absen">
					<span>
						<p>EVALUASI KEBERHASILAN PELAKSANAAN PROGRAM KKN-PPM MAHASISWA</p>
						<p>FORMULIR EVALUASI DPL 1 DAN DPL 2</p>
					</span>
				</center>
				<table class="table table-nobor-monev martop10" style="margin-bottom:-10px;">
					<tr>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">Desa/Kelurahan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkel['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kecamatan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkec['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kabupaten/Kota</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkota['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Judul Program</th>
									<th width="10">:</th>
									<td></td>
								</tr>
							</table>
						</td>
						<td width="50"></td>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">ID KKN Kelompok</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['tahun_kkn']?>-<?=$r_tprodi['kode_prodi']?>-0000002-<?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr>
									<th width="100">Kelompok Ke-</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-sm-12 martop10">
				<table class="table table-bordered-dom-monev">
					<tr>
						<th rowspan="3" width="20">No.</th>
						<th rowspan="3" width="200">Nama Mahasiswa</th>
						<th colspan="3">Nilai Pelaksanaan Per Monev</th>
						<th>Nilai Akhir</th>
					</tr>
					<tr>
						<td width="50"><center>Monev 1</center></td>
						<td width="50"><center>Monev 2</center></td>
						<td width="50"><center>Monev 3</center></td>
						<td rowspan="2"><center>(M1 + M2 + M3)/3</center></td>
					</tr>
					<tr>
						<td><center>(DPL 1+2)/2</center></td>
						<td><center>(DPL 1+2)/2</center></td>
						<td><center>(DPL 1+2)/2</center></td>
					</tr>
					<?php
						$no=0;												
						$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta,tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
		
						while($r_ypeserta = mysqli_fetch_array($q_ypeserta)):
						
						/*****************************************************************************************
							MONEV 1
						******************************************************************************************/
						
						$r_monev1_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev1'"));
						
						$r_monev1_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev1'"));
						
						/***************** NILAI PL MONEV 1 *****************/
						
						$m1_nilai_dpl1 = $r_monev1_dpl1['nilai_pl'];
						$m1_nilai_dpl2 = $r_monev1_dpl2['nilai_pl'];
						
						if(empty($m1_nilai_dpl1) AND empty($m1_nilai_dpl2)){
							$tm1_nilai = "";
						}
						elseif(!empty($m1_nilai_dpl1) AND empty($m1_nilai_dpl2)){
							$tm1_nilai = "";
						}
						elseif(empty($m1_nilai_dpl1) AND !empty($m1_nilai_dpl2)){
							$tm1_nilai = "";
						}
						elseif(!empty($m1_nilai_dpl1) AND !empty($m1_nilai_dpl2)){
							$tm1_nilai = ($m1_nilai_dpl1+$m1_nilai_dpl2)/2;
						}
						else{
							$tm1_nilai = "";
						}
						
						/*****************************************************************************************
							MONEV 2
						******************************************************************************************/
						
						$r_monev2_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev2'"));
						
						$r_monev2_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev2'"));
						
						/***************** NILAI PL MONEV 2 *****************/
						
						$m2_nilai_dpl1 = $r_monev2_dpl1['nilai_pl'];
						$m2_nilai_dpl2 = $r_monev2_dpl2['nilai_pl'];
						
						if(empty($m2_nilai_dpl1) AND empty($m2_nilai_dpl2)){
							$tm2_nilai = "";
						}
						elseif(!empty($m2_nilai_dpl1) AND empty($m2_nilai_dpl2)){
							$tm2_nilai = "";
						}
						elseif(empty($m2_nilai_dpl1) AND !empty($m2_nilai_dpl2)){
							$tm2_nilai = "";
						}
						elseif(!empty($m2_nilai_dpl1) AND !empty($m2_nilai_dpl2)){
							$tm2_nilai = ($m2_nilai_dpl1+$m2_nilai_dpl2)/2;
						}
						else{
							$tm2_nilai = "";
						}
						
						/*****************************************************************************************
							MONEV 3
						******************************************************************************************/
						
						$r_monev3_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev3'"));
						
						$r_monev3_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev3'"));
						
						/***************** NILAI PL MONEV 3 *****************/
						
						$m3_nilai_dpl1 = $r_monev3_dpl1['nilai_pl'];
						$m3_nilai_dpl2 = $r_monev3_dpl2['nilai_pl'];
						
						if(empty($m3_nilai_dpl1) AND empty($m3_nilai_dpl2)){
							$tm3_nilai = "";
						}
						elseif(!empty($m3_nilai_dpl1) AND empty($m3_nilai_dpl2)){
							$tm3_nilai = "";
						}
						elseif(empty($m3_nilai_dpl1) AND !empty($m3_nilai_dpl2)){
							$tm3_nilai = "";
						}
						elseif(!empty($m3_nilai_dpl1) AND !empty($m3_nilai_dpl2)){
							$tm3_nilai = ($m3_nilai_dpl1+$m3_nilai_dpl2)/2;
						}
						else{
							$tm3_nilai = "";
						}
						
						/*****************************************************************************************
							GABUNGAN TOTAL NILAI PL
						******************************************************************************************/
						
						if($tm1_nilai==0 AND $tm2_nilai==0 AND $tm3_nilai==0){
							$g_nilai = "";
						}
						elseif($tm1_nilai!==0 AND $tm2_nilai==0 AND $tm3_nilai==0){
							$g_nilai = "";
						}
						elseif($tm1_nilai==0 AND $tm2_nilai!==0 AND $tm3_nilai==0){
							$g_nilai = "";
						}
						elseif($tm1_nilai==0 AND $tm2_nilai==0 AND $tm3_nilai!==0){
							$g_nilai = "";
						}
						elseif($tm1_nilai!==0 AND $tm2_nilai==0 AND $tm3_nilai!==0){
							$g_nilai = "";
						}
						elseif($tm1_nilai!==0 AND $tm2_nilai!==0 AND $tm3_nilai==0){
							$g_nilai = "";
						}
						elseif($tm1_nilai==0 AND $tm2_nilai!==0 AND $tm3_nilai!==0){
							$g_nilai = "";
						}
						elseif($tm1_nilai!==0 AND $tm2_nilai!==0 AND $tm3_nilai!==0){
							$g_nilai = ($tm1_nilai+$tm2_nilai+$tm3_nilai)/3;
						}
						else{
							$g_nilai = "";
						}
						
						$no++;	
					?>
					<tr>
						<td><center><?=$no;?></center></td>
						<td><?=strtoupper($r_ypeserta['nama_mahasiswa'])?></td>
						<td><center><?=potong_nilai($tm1_nilai);?></center></td>
						<td><center><?=potong_nilai($tm2_nilai);?></center></td>
						<td><center><?=potong_nilai($tm3_nilai);?></center></td>
						<td><center><?=potong_nilai($g_nilai);?></center></td>
					</tr>
					<?php endwhile; ?>
				</table>
				<span class="tfoot-ket">
				<p>Penilaian didasarkan pada :</p>
					<table class="table table-nobor-monev-km">
						<tr>
							<td>- Keberhasilan memanfaatkan dan menggali potensi serta mengungkapkan masalah.</td>
						</tr>
						<tr>
							<td>- Keterampilan untuk melaksanakan program pengembangan dan pembangunan yang relevan.</td>
						</tr>
						<tr>
							<td>- Kemampuan mengevaluasi keberhasilan program yang telah dilakukan.</td>
						</tr>
					</table>
				</span>
			</div>
			<div class="col-sm-12">
				<table class="table table-nobor-monev martop20" style="font-size:12px;">
					<tr>
						<td>
						<div class="">
							<br>
							<p>Dosen Pembimbing Lapangan Utama</p>
							<br><br><br>
							<u style="font-size:11px;"><?=strtoupper($r_tdosen1['nama_dosen'])?></u>
							<p style="font-size:11px;">NIDN.<?=$r_tdosen1['nidn']?></p>
						</div>
						</td>
						<td>
						<div class="pull-right">
							Kupang, <?=tgl_indo($tglsekarang);?>
							<p>Dosen Pembimbing Lapangan Pendamping</p>
							<br><br><br>
							<u style="font-size:11px;"><?=strtoupper($r_tdosen2['nama_dosen'])?></u>
							<p style="font-size:11px;">NIDN.<?=$r_tdosen2['nidn']?></p>
						</div>	
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php 

	$html = ob_get_clean(); 
	require_once("../../assets/dompdf/autoload.inc.php");
	$dompdf = new Dompdf(); 
	$dompdf->loadHtml($html); 
	$dompdf->setPaper('A4', 'portrait'); 
	$dompdf->render(); 
	$dompdf->stream('Nilai Usulan Kegiatan.pdf', array("Attachment"=>0));

		}
		if(isset($_GET['nakelompok'])){
	
		$id_kelompok  = $_GET['nakelompok'];
		$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		
		$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
		$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
			
		$r_tdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
			
		$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

		$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
			
		$r_tdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));
		
		$r_tjadwal = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_jadwal='pembekalan'"));
		
		$r_tlokasi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
	
		$r_tprov   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
								
		$r_tkota   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
		
		$r_tkec    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
		
		$r_tkel    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
		
		$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
		
		$r_tmitra  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
		
		if($r_tprodi['singkatan_prodi']=="TIS1"){
			$tprodi = "TIS1 / <span class='line-through'>SIS1</span>";
		}
		elseif($r_tprodi['singkatan_prodi']=="SIS1"){
			$tprodi = "<span class='line-through'>TIS1</span> / SIS1";
		}
		else{
			$tprodi = "TIS1 / SIS1";
		}
		
		
	ob_start(); 
?>
<!DOCTYPE html>
<html lang="en" class="">
<head>
	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="../../assets/bootstrap/css/main.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="border-kop">
					<img src="../save/logo/logo.png" class="logo-kop-ls"/>
					<center class="kop-absen">
						<span><p>UNDANA KUPANG</p><p>UNIVERSITAS NUSA CENDANA</p></span>
						<p><?=ucwords($r_atur['alamat_stikom'])?></p>
						<p>Telp.<?=$r_atur['no_tlp_stikom']?> fax.<?=$r_atur['fax_stikom']?></p>
						<p>website: <?=strtolower($r_atur['website_stikom'])?>; email: <?=strtolower($r_atur['email_stikom'])?></p>
					</center>
				</div>
			</div>
			<div class="col-sm-12">
				<center class="kop-absen">
					<span>
						<p>EVALUASI AKHIR MAHASISWA KKM-PPM STIKOM UYELINDO KUPANG</p>
					</span>
				</center>
				<div class="row-dom">
					<table class="table table-nobor-monev martop10" style="margin-bottom:-10px;">
					<tr>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">Desa/Kelurahan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkel['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kecamatan</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkec['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Kabupaten/Kota</th>
									<th width="10">:</th>
									<td><?=strtoupper($r_tkota['nama'])?></td>
								</tr>
								<tr>
									<th width="100">Judul Program</th>
									<th width="10">:</th>
									<td></td>
								</tr>
							</table>
						</td>
						<td width="20"></td>
						<td>
							<table class="table table-nobor-monev">
								<tr>
									<th width="100">ID KKN Kelompok</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['tahun_kkn']?>-<?=$r_tprodi['kode_prodi']?>-0000002-<?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr>
									<th width="100">Kelompok Ke-</th>
									<th width="10">:</th>
									<td><?=$r_tkelompok['nama_kelompok']?></td>
								</tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
								<tr><th colspan="3" style="color:#fff;">-</th></tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			</div>
			<div class="col-sm-12 martop10">
				<table class="table table-bordered-dom-monev">
					<tr>
						<th rowspan="2" width="20">No.</th>
						<th rowspan="2" width="120">NIM</th>
						<th rowspan="2" width="200">Nama Mahasiswa</th>
						<th colspan="6">Nilai</th>
						<th rowspan="2">Total</th>
						<th rowspan="3">Nilai Mutu</th>
					</tr>
					<tr>
						<td><center>PB</center></td>
						<td><center>UK</center></td>
						<td><center>KM-DS*</center></td>
						<td><center>KM-KS*</center></td>
						<td><center>PL</center></td>
						<td><center>LPK</center></td>
					</tr>
					<tr>
						<td colspan="3"><center>Bobot Nilai (Poin) Maksimum</center></td>
						<td><center>10%</center></td>
						<td><center>10%</center></td>
						<td><center>15%</center></td>
						<td><center>15%</center></td>
						<td><center>30%</center></td>
						<td><center>20%</center></td>
						<td><center>100%</center></td>
					</tr>
					<?php
						$no=0;
						
						$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta,tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
		
						while($r_ypeserta = mysqli_fetch_array($q_ypeserta)):
											
						/*****************************************************************************************
								TOTAL DS DPL
						******************************************************************************************/
						
						$r_nilaipb_dpl1	= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pb WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='dpl1'"));
						
						$r_nilaipb_dpl2	= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pb WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='dpl2'"));
						
						$nilaidpl1      = $r_nilaipb_dpl1['nilai_pb'];
						$nilaidpl2      = $r_nilaipb_dpl2['nilai_pb'];
						
						if(empty($nilaidpl1) AND empty($nilaidpl2)){
							$totalnilai = "";
						}
						elseif(!empty($nilaidpl1) AND empty($nilaidpl2)){
							$totalnilai = "";
						}	
						elseif(empty($nilaidpl1) AND !empty($nilaidpl2)){
							$totalnilai = "";
						}	
						elseif(!empty($nilaidpl1) AND !empty($nilaidpl2)){
							$totalnilai = ($nilaidpl1+$nilaidpl2)/2;
						}
						else{
							$totalnilai = "";
						}
							
						/*****************************************************************************************
								NILAI UK
						******************************************************************************************/
												
						$r_nilaiukd1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl1' AND status_nilai='nilaiuk'"));

						$r_nilaiukd2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl2' AND status_nilai='nilaiuk'"));
						
						$d1nilai1  = $r_nilaiukd1['nilai1'];
						$d1hnilai1 = ($d1nilai1*40)/100;
						
						$d2nilai1  = $r_nilaiukd2['nilai1'];
						$d2hnilai1 = ($d2nilai1*40)/100;
						
						$d1nilai2  = $r_nilaiukd1['nilai2'];
						$d1hnilai2 = ($d1nilai2*30)/100;
						
						$d2nilai2  = $r_nilaiukd2['nilai2'];
						$d2hnilai2 = ($d2nilai2*30)/100;
						
						$d1nilai3  = $r_nilaiukd1['nilai3'];
						$d1hnilai3 = ($d1nilai3*30)/100;
						
						$d2nilai3  = $r_nilaiukd2['nilai3'];
						$d2hnilai3 = ($d2nilai3*30)/100;
						
						$d1tnilai  = $d1hnilai1+$d1hnilai2+$d1hnilai3;
						
						$d2tnilai  = $d2hnilai1+$d2hnilai2+$d2hnilai3;
						
						if($d1tnilai==0 AND $d2tnilai==0){
							$gnilai = "";
						}
						elseif($d1tnilai==0 AND $d2tnilai!==0){
							$gnilai = "";
						}
						elseif($d1tnilai!==0 AND $d2tnilai==0){
							$gnilai = "";
						}
						elseif($d1tnilai!== 0 AND $d2tnilai!== 0){
							$gnilai = ($d1tnilai+$d2tnilai)/2;
						}
						else{
							$gnilai = "";
						}
												
						/*****************************************************************************************
							MONEV 1
						******************************************************************************************/
						$r_monev1_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev1'"));
						
						$r_monev1_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev1'"));
						
						
						$m1_nilaids_dpl1 = $r_monev1_dpl1['nilai_ds'];
						$m1_nilaids_dpl2 = $r_monev1_dpl2['nilai_ds'];
											
						$m1_nilaiks_dpl1 = $r_monev1_dpl1['nilai_ks'];
						$m1_nilaiks_dpl2 = $r_monev1_dpl2['nilai_ks'];
						
						/***************** NILAI KM-DS MONEV 1 *****************/
						if(empty($m1_nilaids_dpl1) AND empty($m1_nilaids_dpl2)){
							$tm1_nilaids = "";
						}
						elseif(!empty($m1_nilaids_dpl1) AND empty($m1_nilaids_dpl2)){
							$tm1_nilaids = "";
						}
						elseif(empty($m1_nilaids_dpl1) AND !empty($m1_nilaids_dpl2)){
							$tm1_nilaids = "";
						}
						elseif(!empty($m1_nilaids_dpl1) AND !empty($m1_nilaids_dpl2)){
							$tm1_nilaids = ($m1_nilaids_dpl1+$m1_nilaids_dpl2)/2;
						}
						else{
							$tm1_nilaids = "";
						}
						/***************** NILAI KM-KS MONEV 1 *****************/
						if(empty($m1_nilaiks_dpl1) AND empty($m1_nilaiks_dpl2)){
							$tm1_nilaiks = "";
						}
						elseif(!empty($m1_nilaiks_dpl1) AND empty($m1_nilaiks_dpl2)){
							$tm1_nilaiks = "";
						}
						elseif(empty($m1_nilaiks_dpl1) AND !empty($m1_nilaiks_dpl2)){
							$tm1_nilaiks = "";
						}
						elseif(!empty($m1_nilaiks_dpl1) AND !empty($m1_nilaiks_dpl2)){
							$tm1_nilaiks = ($m1_nilaiks_dpl1+$m1_nilaiks_dpl2)/2;
						}
						else{
							$tm1_nilaiks = "";
						}
						
						/*****************************************************************************************
							MONEV 2
						******************************************************************************************/
						$r_monev2_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev2'"));
						
						$r_monev2_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev2'"));
						
						
						$m2_nilaids_dpl1 = $r_monev2_dpl1['nilai_ds'];
						$m2_nilaids_dpl2 = $r_monev2_dpl2['nilai_ds'];
											
						$m2_nilaiks_dpl1 = $r_monev2_dpl1['nilai_ks'];
						$m2_nilaiks_dpl2 = $r_monev2_dpl2['nilai_ks'];
						
						/***************** NILAI KM-DS MONEV 2 *****************/
						if(empty($m2_nilaids_dpl1) AND empty($m2_nilaids_dpl2)){
							$tm2_nilaids = "";
						}
						elseif(!empty($m2_nilaids_dpl1) AND empty($m2_nilaids_dpl2)){
							$tm2_nilaids = "";
						}
						elseif(empty($m2_nilaids_dpl1) AND !empty($m2_nilaids_dpl2)){
							$tm2_nilaids = "";
						}
						elseif(!empty($m2_nilaids_dpl1) AND !empty($m2_nilaids_dpl2)){
							$tm2_nilaids = ($m2_nilaids_dpl1+$m2_nilaids_dpl2)/2;
						}
						else{
							$tm2_nilaids = "";
						}
						/***************** NILAI KM-KS MONEV 2 *****************/
						if(empty($m2_nilaiks_dpl1) AND empty($m2_nilaiks_dpl2)){
							$tm2_nilaiks = "";
						}
						elseif(!empty($m2_nilaiks_dpl1) AND empty($m2_nilaiks_dpl2)){
							$tm2_nilaiks = "";
						}
						elseif(empty($m2_nilaiks_dpl1) AND !empty($m2_nilaiks_dpl2)){
							$tm2_nilaiks = "";
						}
						elseif(!empty($m2_nilaiks_dpl1) AND !empty($m2_nilaiks_dpl2)){
							$tm2_nilaiks = ($m2_nilaiks_dpl1+$m2_nilaiks_dpl2)/2;
						}
						else{
							$tm2_nilaiks = "";
						}
						
						/*****************************************************************************************
							MONEV 3
						******************************************************************************************/
						$r_monev3_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev3'"));
						
						$r_monev3_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev3'"));
						
						
						$m3_nilaids_dpl1 = $r_monev3_dpl1['nilai_ds'];
						$m3_nilaids_dpl2 = $r_monev3_dpl2['nilai_ds'];
											
						$m3_nilaiks_dpl1 = $r_monev3_dpl1['nilai_ks'];
						$m3_nilaiks_dpl2 = $r_monev3_dpl2['nilai_ks'];
						
						/***************** NILAI KM-DS MONEV 3 *****************/
						if(empty($m3_nilaids_dpl1) AND empty($m3_nilaids_dpl2)){
							$tm3_nilaids = "";
						}
						elseif(!empty($m3_nilaids_dpl1) AND empty($m3_nilaids_dpl2)){
							$tm3_nilaids = "";
						}
						elseif(empty($m3_nilaids_dpl1) AND !empty($m3_nilaids_dpl2)){
							$tm3_nilaids = "";
						}
						elseif(!empty($m3_nilaids_dpl1) AND !empty($m3_nilaids_dpl2)){
							$tm3_nilaids = ($m3_nilaids_dpl1+$m3_nilaids_dpl2)/2;
						}
						else{
							$tm3_nilaids = "";
						}
						/***************** NILAI KM-KS MONEV 3 *****************/
						if(empty($m3_nilaiks_dpl1) AND empty($m3_nilaiks_dpl2)){
							$tm3_nilaiks = "";
						}
						elseif(!empty($m3_nilaiks_dpl1) AND empty($m3_nilaiks_dpl2)){
							$tm3_nilaiks = "";
						}
						elseif(empty($m3_nilaiks_dpl1) AND !empty($m3_nilaiks_dpl2)){
							$tm3_nilaiks = "";
						}
						elseif(!empty($m3_nilaiks_dpl1) AND !empty($m3_nilaiks_dpl2)){
							$tm3_nilaiks = ($m3_nilaiks_dpl1+$m3_nilaiks_dpl2)/2;
						}
						else{
							$tm3_nilaiks = "";
						}
						
						/*****************************************************************************************
							GABUNGAN TOTAL NILAI DS
						******************************************************************************************/
						
						if($tm1_nilaids==0 AND $tm2_nilaids==0 AND $tm3_nilaids==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids!==0 AND $tm2_nilaids==0 AND $tm3_nilaids==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids==0 AND $tm2_nilaids!==0 AND $tm3_nilaids==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids==0 AND $tm2_nilaids==0 AND $tm3_nilaids!==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids!==0 AND $tm2_nilaids!==0 AND $tm3_nilaids==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids==0 AND $tm2_nilaids!==0 AND $tm3_nilaids!==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids!==0 AND $tm2_nilaids==0 AND $tm3_nilaids!==0){
							$g_nilaids = "";
						}
						elseif($tm1_nilaids!==0 AND $tm2_nilaids==!0 AND $tm3_nilaids!==0){
							$g_nilaids = ($tm1_nilaids+$tm2_nilaids+$tm3_nilaids)/3;
						}
						else{
							$g_nilaids = "";
						}
						
						/*****************************************************************************************
							GABUNGAN TOTAL NILAI KS
						******************************************************************************************/
						
						if($tm1_nilaiks==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks!==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks!==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks!==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks!==0){
							$g_nilaiks = "";
						}
						elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==!0 AND $tm3_nilaiks!==0){
							$g_nilaiks = ($tm1_nilaiks+$tm2_nilaiks+$tm3_nilaiks)/3;
						}
						else{
							$g_nilaiks = "";
						}
						
						/*****************************************************************************************
								MONEV 3
						******************************************************************************************/
						
						$r_monev3_mitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='mitra' AND tbl_jadwal.status_jadwal='monev3'"));
								
						$m3_nilaids_mitra = $r_monev3_mitra['nilai_ds'];										
						$m3_nilaiks_mitra = $r_monev3_mitra['nilai_ks'];
						
						/*****************************************************************************************
								TOTAL DS DPL
						******************************************************************************************/

						$ds_dpl    = ($g_nilaids*50)/100;
						$ds_mitra  = ($m3_nilaids_mitra*50)/100;

						$ks_dpl    = ($g_nilaiks*50)/100;
						$ks_mitra  = ($m3_nilaiks_mitra*50)/100;
						
						if($ds_dpl == 0 AND $ds_mitra == 0){
							$tnilai_ds = "";
						}
						elseif($ds_dpl !== 0 AND $ds_mitra == 0){
							$tnilai_ds = "";
						}
						elseif($ds_dpl == 0 AND $ds_mitra !== 0){
							$tnilai_ds = "";
						}
						elseif($ds_dpl !== 0 AND $ds_mitra !== 0){
							$tnilai_ds = $ds_dpl+$ds_mitra;
						}
						else{
							$tnilai_ds = "";
						}
						
						if($ks_dpl == 0 AND $ks_mitra == 0){
							$tnilai_ks = "";
						}
						elseif($ks_dpl !== 0 AND $ks_mitra == 0){
							$tnilai_ks = "";
						}
						elseif($ks_dpl == 0 AND $ks_mitra !== 0){
							$tnilai_ks = "";
						}
						elseif($ks_dpl !== 0 AND $ks_mitra !== 0){
							$tnilai_ks = $ks_dpl+$ks_mitra;
						}
						else{
							$tnilai_ks = "";
						}
						
						/*****************************************************************************************
								NILAI PL
						******************************************************************************************/

						$r_monev1_npl_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev1'"));
							
						$r_monev1_npl_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev1'"));
						
						/***************** NILAI PL MONEV 1 *****************/
						
						$m1_nilaipl_dpl1 = $r_monev1_npl_dpl1['nilai_pl'];
						$m1_nilaipl_dpl2 = $r_monev1_npl_dpl2['nilai_pl'];
						
						if(empty($m1_nilaipl_dpl1) AND empty($m1_nilaipl_dpl2)){
							$tm1_nilaipl = "";
						}
						elseif(!empty($m1_nilaipl_dpl1) AND empty($m1_nilaipl_dpl2)){
							$tm1_nilaipl = "";
						}
						elseif(empty($m1_nilaipl_dpl1) AND !empty($m1_nilaipl_dpl2)){
							$tm1_nilaipl = "";
						}
						elseif(!empty($m1_nilaipl_dpl1) AND !empty($m1_nilaipl_dpl2)){
							$tm1_nilaipl = ($m1_nilaipl_dpl1+$m1_nilaipl_dpl2)/2;
						}
						else{
							$tm1_nilaipl = "";
						}
						
						/*****************************************************************************************
							MONEV 2
						******************************************************************************************/
						
						$r_monev2_npl_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev2'"));
						
						$r_monev2_npl_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev2'"));
						
						/***************** NILAI PL MONEV 2 *****************/
						
						$m2_nilaipl_dpl1 = $r_monev2_npl_dpl1['nilai_pl'];
						$m2_nilaipl_dpl2 = $r_monev2_npl_dpl2['nilai_pl'];
						
						if(empty($m2_nilaipl_dpl1) AND empty($m2_nilaipl_dpl2)){
							$tm2_nilaipl = "";
						}
						elseif(!empty($m2_nilaipl_dpl1) AND empty($m2_nilaipl_dpl2)){
							$tm2_nilaipl = "";
						}
						elseif(empty($m2_nilaipl_dpl1) AND !empty($m2_nilaipl_dpl2)){
							$tm2_nilaipl = "";
						}
						elseif(!empty($m2_nilaipl_dpl1) AND !empty($m2_nilaipl_dpl2)){
							$tm2_nilaipl = ($m2_nilaipl_dpl1+$m2_nilaipl_dpl2)/2;
						}
						else{
							$tm2_nilaipl = "";
						}
						
						/*****************************************************************************************
							MONEV 3
						******************************************************************************************/
						
						$r_monev3_npl_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev3'"));
						
						$r_monev3_npl_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev3'"));
						
						/***************** NILAI PL MONEV 3 *****************/
						
						$m3_nilaipl_dpl1 = $r_monev3_npl_dpl1['nilai_pl'];
						$m3_nilaipl_dpl2 = $r_monev3_npl_dpl2['nilai_pl'];
						
						if(empty($m3_nilaipl_dpl1) AND empty($m3_nilaipl_dpl2)){
							$tm3_nilaipl = "";
						}
						elseif(!empty($m3_nilaipl_dpl1) AND empty($m3_nilaipl_dpl2)){
							$tm3_nilaipl = "";
						}
						elseif(empty($m3_nilaipl_dpl1) AND !empty($m3_nilaipl_dpl2)){
							$tm3_nilaipl = "";
						}
						elseif(!empty($m3_nilaipl_dpl1) AND !empty($m3_nilaipl_dpl2)){
							$tm3_nilaipl = ($m3_nilaipl_dpl1+$m3_nilaipl_dpl2)/2;
						}
						else{
							$tm3_nilaipl = "";
						}
						
						/*****************************************************************************************
							GABUNGAN TOTAL NILAI PL
						******************************************************************************************/
						
						if($tm1_nilaipl==0 AND $tm2_nilaipl==0 AND $tm3_nilaipl==0){
							$g_nilaipl = "";
						}
						elseif($tm1_nilaipl!==0 AND $tm2_nilaipl==0 AND $tm3_nilaipl==0){
							$g_nilaipl = "";
						}
						elseif($tm1_nilaipl==0 AND $tm2_nilaipl!==0 AND $tm3_nilaipl==0){
							$g_nilaipl = "";
						}
						elseif($tm1_nilaipl==0 AND $tm2_nilaipl==0 AND $tm3_nilaipl!==0){
							$g_nilaipl = "";
						}
						elseif($tm1_nilaipl!==0 AND $tm2_nilaipl==0 AND $tm3_nilaipl!==0){
							$g_nilaipl = "";
						}
						elseif($tm1_nilaipl!==0 AND $tm2_nilaipl!==0 AND $tm3_nilaipl==0){
							$g_nilaipl = "";
						}
						elseif($tm1_nilaipl==0 AND $tm2_nilaipl!==0 AND $tm3_nilaipl!==0){
							$g_nilaipl = "";
						}
						elseif($tm1_nilaipl!==0 AND $tm2_nilaipl!==0 AND $tm3_nilaipl!==0){
							$g_nilaipl = ($tm1_nilaipl+$tm2_nilaipl+$tm3_nilaipl)/3;
						}
						else{
							$g_nilaipl = "";
						}
						
						/*****************************************************************************************
							NILAI LPK
						******************************************************************************************/
						
						$r_nilailpkd1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl1' AND status_nilai='nilailpk'"));
						
						$r_nilailpkd2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl2' AND status_nilai='nilailpk'"));
						
						$d1nilailpk1  = $r_nilailpkd1['nilai1'];
						$d1hnilailpk1 = ($d1nilailpk1*40)/100;
						
						$d2nilailpk1  = $r_nilailpkd2['nilai1'];
						$d2hnilailpk1 = ($d2nilailpk1*40)/100;
						
						$d1nilailpk2  = $r_nilailpkd1['nilai2'];
						$d1hnilailpk2 = ($d1nilailpk2*30)/100;
						
						$d2nilailpk2  = $r_nilailpkd2['nilai2'];
						$d2hnilailpk2 = ($d2nilailpk2*30)/100;
						
						$d1nilailpk3  = $r_nilailpkd1['nilai3'];
						$d1hnilailpk3 = ($d1nilailpk3*30)/100;
						
						$d2nilailpk3  = $r_nilailpkd2['nilai3'];
						$d2hnilailpk3 = ($d2nilailpk3*30)/100;
						
						$d1tnilailpk  = $d1hnilailpk1+$d1hnilailpk2+$d1hnilailpk3;
						
						$d2tnilailpk  = $d2hnilailpk1+$d2hnilailpk2+$d2hnilailpk3;
						
						if($d1tnilailpk==0 AND $d2tnilailpk==0){
							$gnilailpk = "";
						}
						elseif($d1tnilailpk==0 AND $d2tnilailpk!==0){
							$gnilailpk = "";
						}
						elseif($d1tnilailpk!==0 AND $d2tnilailpk==0){
							$gnilailpk = "";
						}
						elseif($d1tnilailpk!== 0 AND $d2tnilailpk!== 0){
							$gnilailpk = ($d1tnilailpk+$d2tnilailpk)/2;
						}
						else{
							$gnilailpk = "";
						}
						
						$pb_nilai    = ($totalnilai*10)/100;
						
						$uk_nilai    = ($gnilai*10)/100;
						
						$km_ds_nilai = ($tnilai_ds*15)/100;
						
						$km_ks_nilai = ($tnilai_ks*15)/100;
						
						$pl_nilai    = ($g_nilaipl*30)/100;
						
						$lpk_nilai   = ($gnilailpk*20)/100;
						
						if($pb_nilai == 0 AND $uk_nilai == 0){
							$tgnilai1 = "";
						}
						elseif($pb_nilai !== 0 AND $uk_nilai == 0){
							$tgnilai1 = "";
						}
						elseif($pb_nilai == 0 AND $uk_nilai !== 0){
							$tgnilai1 = "";
						}
						elseif($pb_nilai !== 0 AND $uk_nilai !== 0){
							$tgnilai1 = $pb_nilai+$uk_nilai;
						}
						else{
							$tgnilai1 = "";
						}
						
						if($km_ds_nilai == 0 AND $km_ks_nilai == 0){
							$tgnilai2 = "";
						}
						elseif($km_ds_nilai !== 0 AND $km_ks_nilai == 0){
							$tgnilai2 = "";
						}
						elseif($km_ds_nilai == 0 AND $km_ks_nilai !== 0){
							$tgnilai2 = "";
						}
						elseif($km_ds_nilai !== 0 AND $km_ks_nilai !== 0){
							$tgnilai2 = $km_ds_nilai+$km_ks_nilai;
						}
						else{
							$tgnilai2 = "";
						}
						
						if($pl_nilai == 0 AND $lpk_nilai == 0){
							$tgnilai3 = "";
						}
						elseif($pl_nilai !== 0 AND $lpk_nilai == 0){
							$tgnilai3 = "";
						}
						elseif($pl_nilai == 0 AND $lpk_nilai !== 0){
							$tgnilai3 = "";
						}
						elseif($pl_nilai !== 0 AND $lpk_nilai !== 0){
							$tgnilai3 = $pl_nilai+$lpk_nilai;
						}
						else{
							$tgnilai3 = "";
						}
						
						if($tgnilai1 == 0 AND $tgnilai2 == 0 AND $tgnilai3 == 0){
							$nilai_akhir = "";
						}
						elseif($tgnilai1 !== 0 AND $tgnilai2 == 0 AND $tgnilai3 == 0){
							$nilai_akhir = "";
						}
						elseif($tgnilai1 == 0 AND $tgnilai2 !== 0 AND $tgnilai3 == 0){
							$nilai_akhir = "";
						}
						elseif($tgnilai1 == 0 AND $tgnilai2 == 0 AND $tgnilai3 !== 0){
							$nilai_akhir = "";
						}
						elseif($tgnilai1 !== 0 AND $tgnilai2 !== 0 AND $tgnilai3 == 0){
							$nilai_akhir = "";
						}
						elseif($tgnilai1 == 0 AND $tgnilai2 !== 0 AND $tgnilai3 !== 0){
							$nilai_akhir = "";
						}
						elseif($tgnilai1 !== 0 AND $tgnilai2 == 0 AND $tgnilai3 !== 0){
							$nilai_akhir = "";
						}
						elseif($tgnilai1 !== 0 AND $tgnilai2 !== 0 AND $tgnilai3 !== 0){
							$nilai_akhir = $tgnilai1+$tgnilai2+$tgnilai3;
						}
						else{
							$nilai_akhir = "";
						}
						
						$no++;	
					?>	
					<tr>
						<td><center><?=$no;?><center></td>
						<td><?=$r_ypeserta['nim']?></td>
						<td><?=strtoupper($r_ypeserta['nama_mahasiswa'])?></td>
						<td><center><?=(($pb_nilai == 0)?'':potong_nilai($pb_nilai))?></center></td>
						<td><center><?=(($uk_nilai == 0)?'':potong_nilai($uk_nilai))?></center></td>
						<td><center><?=(($km_ds_nilai == 0)?'':potong_nilai($km_ds_nilai))?></center></td>
						<td><center><?=(($km_ks_nilai == 0)?'':potong_nilai($km_ks_nilai))?></center></td>
						<td><center><?=(($pl_nilai == 0)?'':potong_nilai($pl_nilai))?></center></td>
						<td><center><?=(($lpk_nilai == 0)?'':potong_nilai($lpk_nilai))?></center></td>
						<td><center><?=(($nilai_akhir == 0)?'':potong_nilai($nilai_akhir))?></center></td>
						<td><center><?=(($nilai_akhir == 0)?'':nilai_mutu($nilai_akhir))?></center></td>
					</tr>
					<?php endwhile; ?>
				</table>
				<span class="tfoot-ket">
				<b>Keterangan :</b>
					<table class="table table-nobor-monev" style="font-size:12px;">
						<tr>
							<td width="200">
								<table class="table table-nobor-monev" style="font-size:12px;">
									<tr>
										<td colspan="9">*50% nilai diambil dari mitra</td>
									</tr>
									<tr>
										<td width="5">A</td>
										<td width="5">:</td>
										<td width="30">86-100</td>
										<td width="5">C</td>
										<td width="5">:</td>
										<td width="5">67-75</td>
										<td width="5">E</td>
										<td width="5">:</td>
										<td width="30">&#60; 55</td>
									</tr>
									<tr>
										<td width="5">B</td>
										<td width="5">:</td>
										<td width="30">76-85</td>
										<td width="5">D</td>
										<td width="5">:</td>
										<td width="30">55-64</td>
										<td colspan="3" style="color:#fff;">-</td>
									</tr>
								</table>
							</td>
							<td width="230"></td>
							<td>
								<table class="table table-nobor-monev" style="font-size:12px;">
									<tr>
										<td>PB</td>
										<td>:</td>
										<td>Presentasi Pembekalan</td>
										<td>KM-KS</td>
										<td>:</td>
										<td>Kinerja Mahasiswa - Kerjasama</td>
									</tr>
									<tr>
										<td>UK</td>
										<td>:</td>
										<td>Usulan Kegiatan</td>
										<td>PL</td>
										<td>:</td>
										<td>Pelaksanaan Program</td>
									</tr>
									<tr>
										<td>KM-DS</td>
										<td>:</td>
										<td>Kinerja Mahasiswa - Disiplin</td>
										<td>LPK</td>
										<td>:</td>
										<td>Laporan Pelaksanaan Kegiatan</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</span>
			</div>
			<div class="col-sm-12">
				<table class="table table-nobor-monev martop20" style="font-size:12px;">
					<tr>
						<td width="300">
							<div class="">
								<br>
								<p>Dosen Pembimbing Lapangan Utama</p>
								<br><br><br>
								<u style="font-size:11px;"><?=strtoupper($r_tdosen1['nama_dosen'])?></u>
								<p style="font-size:11px;">NIDN.<?=$r_tdosen1['nidn']?></p>
							</div>
						</td>
						<td width="200">
							<div class="pull-right">
								Kupang, <?=tgl_indo($tglsekarang);?>
								<p>Dosen Pembimbing Lapangan Pendamping</p>
								<br><br><br>
								<u style="font-size:11px;"><?=strtoupper($r_tdosen2['nama_dosen'])?></u>
								<p style="font-size:11px;">NIDN.<?=$r_tdosen2['nidn']?></p>
							</div>	
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php 

	$html = ob_get_clean(); 
	require_once("../../assets/dompdf/autoload.inc.php");
	$dompdf = new Dompdf(); 
	$dompdf->loadHtml($html); 
	$dompdf->setPaper('A4', 'landscape'); 
	$dompdf->render(); 
	$dompdf->stream('Kenerja Mahasiswa.pdf', array("Attachment"=>0));

		}	
?>