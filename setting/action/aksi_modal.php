<?php
	//error_reporting(0);
	
	date_default_timezone_set('Asia/Jakarta');
	
	$namaBulan = array(
		1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni",
			"Juli", "Agustus",  "September", "Oktober",  "November", "Desember"
	);
	
	$hariIni = time(); // menyimpan tanggal hari ini
	$tahun   = date("Y", $hariIni); // ambil tahun dari hari ini
	
	$t = date('Y');
	$a = $t-10;
	$j = $t+1;
	
	include '../connect/config.php';
	include '../function/func_media.php';
	
	$r_atur = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_pengaturan WHERE id_pengaturan"));
	
    if(isset($_POST['idmahasiswa'])) {
		
	$idmahasiswa     = $_POST['idmahasiswa'];
	$q_cek_mahasiswa = mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$idmahasiswa'");
	$r_cek_mahasiswa = mysqli_fetch_array($q_cek_mahasiswa);
	
	$nama_mahasiswa  = ucwords($r_cek_mahasiswa['nama_mahasiswa']);
	$nim		     = $r_cek_mahasiswa['nim'];
	$pin_krs	     = $r_cek_mahasiswa['pin_krs'];
	
	$q_cek_prodi     = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_cek_mahasiswa[id_prodi]'");
	$r_cek_prodi	 = mysqli_fetch_array($q_cek_prodi);
	
	$prodi			 = ucwords($r_cek_prodi['nama_prodi']);
?>
	<div class="row">
	<input type="hidden" name="id_mahasiswa" value="<?=$r_cek_mahasiswa['id_mahasiswa'];?>"/>
		<div class="content-divider text-muted form-group"><span>Profil Mahasiswa</span></div>
		<div class="form-group row">
			<div class="col-sm-12">
				<input class="form-control input-sm" type="text" disabled value="<?=$nim;?>"/>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-12">
				<input class="form-control input-sm" type="text" disabled value="<?=$nama_mahasiswa;?>"/>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-12">
				<input class="form-control input-sm" type="text" disabled value="<?=$prodi;?>"/>
			</div>
		</div>
		<div class="content-divider text-muted form-group"><span>PIN KRS</span></div>
		<div class="form-group row validation">
			<div class="col-sm-12">
				<input class="form-control input-sm" type="text" name="pin_krs" placeholder="Masukan PIN KRS" value="<?=$pin_krs;?>" required="required" />
			</div>
		</div>
	</div>
<?php
	}  	
	if(isset($_POST['iddpl'])){
		
		$iddpl    = $_POST['iddpl'];
		
		$r_udpl   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dpl='$iddpl'"));		
		$r_udosen = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_udpl[id_dosen]'"));
?>
	<div class="content-divider text-muted form-group"><span>Dosen</span></div>
	<div class="form-group row">
		<div class="col-sm-7">
			<input type="text" class="form-control input-sm" value="<?=ucwords(cek_jk($r_udosen['jk_dosen'])." ".$r_udosen['nama_dosen'])?>" disabled />
		</div>
		<div class="col-sm-5">
			<input type="text" class="form-control input-sm" value="<?=$r_udosen['nidn']?>" id="nidn" name="nidn" placeholder="NIDN" disabled />
		</div>
	</div>
	<div class="content-divider text-muted form-group"><span>No.Tlp/Hp & Email Dosen</span></div>
	<div class="form-group row validation">
	<div class="col-sm-12">
	<div class="input-group">
		<input type="text" class="form-control input-sm" id="no_tlp_dosen" value="<?=$r_udosen['no_tlp_dosen']?>" name="no_tlp_dosen" placeholder="No. Tlp/Hp Dosen" required="required" />
		<span class="input-group-addon" id="basic-addon1">-</span>
		<input type="text" class="form-control input-sm capitalize" id="email_dosen" name="email_dosen" placeholder="Email Dosen" value="<?=$r_udosen['email_dosen']?>" required="required" />
	</div>
	</div>
	</div>
	<input type="hidden" value="<?=$r_udpl['id_dosen']?>" name="id_dosen" />
	<input type="hidden" value="<?=$r_udpl['id_dpl']?>" name="id_dpl" />
<?php
	}
	if(isset($_POST['idkelompok'])){
		
		$q_tpeserta = mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta AND status_peserta='sudah' AND tahun_kkn='$r_atur[tahun_kkn]'");
		
		$q_tdpl1    = mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dpl");
		$jsArray1	= "var dpl1 = new Array();\n"; 
		
		$q_tdpl2    = mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dpl");
		$jsArray2	= "var dpl2 = new Array();\n"; 
		
		$q_tprodi   = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi");
		
		$idkelompok    = $_POST['idkelompok'];
		
		$r_ukelompok   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$idkelompok'"));
		
		$id_kelompok  = $r_ukelompok['id_kelompok']; 
		
		$r_uhaspeserta = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_kelompok='$r_ukelompok[id_kelompok]'"));
										
		$r_upeserta	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_uhaspeserta[id_peserta]' AND status_peserta='sudah'"));
		
		$r_umahasiswa  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_upeserta[id_mahasiswa]'"));
		
		$r_uhdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$id_kelompok' AND `status_has_dpl`='dpl1'"));
										
		$r_udpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_uhdpl_1[id_dpl]'"));
		
		$r_udosen1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_udpl1[id_dosen]'"));
		
		$r_uhdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$id_kelompok' AND status_has_dpl='dpl2'"));	

		$r_udpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_uhdpl_2[id_dpl]'"));
		
		$r_udosen2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_udpl2[id_dosen]'"));		
		
		$r_uprodi      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_umahasiswa[id_prodi]'"));
		
		$r_ulokasi     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_ukelompok[id_lokasi]'"));
		
		$r_ukota 	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_ulokasi[id_kota]'"));
									
		$r_ukec        = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_ulokasi[id_kecamatan]'"));
								
		$r_ukel        = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_ulokasi[id_kelurahan]'"));
		
		$r_ujadwal     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$id_kelompok' AND status_jadwal='pembekalan'"));
?>
<script>
	$(document).ready(function() {
		$('#uprodi').change(function() { // Jika Select Box id provinsi dipilih
			var uprodi = $(this).val(); // Ciptakan variabel provinsi
			$.ajax({
				type: 'POST', // Metode pengiriman data menggunakan POST
				url : '../../setting/action/aksi_select.php', // File yang akan memproses data
				data: 'uid_prodi=' + uprodi, // Data yang akan dikirim ke file pemroses
				success: function(response) { // Jika berhasil
					$('#upeserta').html(response); // Berikan hasil ke id kota
				}
			});
		});
	});
</script>
	<div class="content-divider text-muted form-group"><span>Kelompok</span></div>
	<div class="form-group row">
		<div class="col-sm-6">
		<div class="input-group">
		<span class="input-group-addon" id="basic-addon1">Kelompok</span>
			<input type="text" disabled class="form-control input-sm" value="<?=$r_ukelompok['nama_kelompok']?>" placeholder="Masukan Nama Kelompok">
		</div>
		</div>
		<div class="col-sm-6">
			<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Tahun KKN</span>
				<input type="text" disabled class="form-control input-sm" value="<?=$r_ukelompok['tahun_kkn']?>">
			</div>
		</div>
	</div>
		<div class="form-group row validation">
		<div class="col-sm-12">
			<select class="form-control input-sm" id="uprodi" name="id_prodi">
				<option value="<?=$r_umahasiswa['id_prodi']?>">✔ <?=ucwords($r_uprodi['nama_prodi'])?></option>
				<?php while($r_tprodi = mysqli_fetch_array($q_tprodi)):?>
				<option value="<?=$r_tprodi['id_prodi']?>"><?=ucwords($r_tprodi['nama_prodi']);?></option>
				<?php endwhile; ?>
			</select>
		</div>
	</div>
	<div class="form-group row validation">
		<div class="col-sm-8">
			<select type="text" onchange="changeValue(this.value)" class="form-control input-sm" id="upeserta"  required="required" name="idpeserta">
				<option value="<?=$r_uhaspeserta['id_peserta']?>" selected><?=((isset($_POST['idkelompok']))?"✔ ".ucwords($r_umahasiswa['nama_mahasiswa']):'Pilih Ketua Kelompok')?></option>
			</select>
		</div>
		<div class="col-sm-4">
			<input type="text" disabled class="form-control input-sm" value="<?=$r_umahasiswa['nim']?>" placeholder="NIM" id="unim" name="nim">
			<input type="hidden" id="uid_peserta" name="id_peserta"  value="<?=$r_uhaspeserta['id_peserta']?>">
		</div>
	</div>
	<div class="content-divider text-muted form-group"><span>Dosen Pembimbing Lapangan</span></div>
	<div class="form-group row validation">
		<div class="col-sm-8">
			<select class="form-control input-sm" onchange="document.getElementById('unidn1').value = dpl1[this.value]" name="id_dpl_1" required="required">
				<option value="<?=$r_uhdpl_1['id_dpl']?>">✔ <?=ucwords(cek_jk($r_udosen1['jk_dosen'])." ".$r_udosen1['nama_dosen'])?></option>
				<?php 
					while($r_tdpl1 = mysqli_fetch_array($q_tdpl1)):
					
					$r_bdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_tdpl1[id_dosen]'"));
				?>
				<option value="<?=$r_tdpl1['id_dpl']?>"><?=ucwords(cek_jk($r_bdosen1['jk_dosen'])." ".$r_bdosen1['nama_dosen'])?></option>
				<?php
					$jsArray1 .= "dpl1['" . $r_tdpl1['id_dpl'] . "'] = '" . addslashes($r_bdosen1['nidn']) . "';\n";
					endwhile; 
				?>
			</select>
		</div>
		<div class="col-sm-4">
			<input type="text" disabled id="unidn1" name="nidn" value="<?=$r_udosen1['nidn']?>" class="form-control input-sm" placeholder="NIDN">
		</div>
	</div>	
	<div class="form-group row validation">
		<div class="col-sm-8">
			<select class="form-control input-sm" onchange="document.getElementById('unidn2').value = dpl2[this.value]" name="id_dpl_2" required="required">
				<option value="<?=$r_uhdpl_2['id_dpl']?>">✔ <?=ucwords(cek_jk($r_udosen2['jk_dosen'])." ".$r_udosen2['nama_dosen'])?></option>
				<?php 
					while($r_tdpl2 = mysqli_fetch_array($q_tdpl2)):
					
					$r_bdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_tdpl2[id_dosen]'"));
				?>
				<option value="<?=$r_tdpl2['id_dpl']?>"><?=ucwords(cek_jk($r_bdosen2['jk_dosen'])." ".$r_bdosen2['nama_dosen'])?></option>
				<?php
					$jsArray2 .= "dpl2['" . $r_tdpl2['id_dpl'] . "'] = '" . addslashes($r_bdosen2['nidn']) . "';\n";
					endwhile; 
				?>
			</select>
		</div>
		<div class="col-sm-4">
			<input type="text" disabled id="unidn2" name="nidn" value="<?=$r_udosen2['nidn']?>" class="form-control input-sm" placeholder="NIDN">
		</div>
	</div>	
	<div class="content-divider text-muted form-group"><span>Lokasi KKN</span></div>
	<div class="form-group row validation">
		<div class="col-sm-12">
			<select name="id_lokasi" class="form-control input-sm" required="required">
				<option value="<?=$r_ukelompok['id_lokasi']?>"><?=((isset($_POST['idkelompok']))?"✔ ".ucwords($r_ukota['nama'])." - Kec. ".ucwords($r_ukec['nama'])." - Kel. ".ucwords($r_ukel['nama']):'Pilih Lokasi')?></option>
				<?php 
					$q_tlokasi = mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi");
					while($r_tlokasi = mysqli_fetch_array($q_tlokasi)):
					
						$r_tkota = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
						
						$r_tkec  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
						
						$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
						
				?>
					<option value="<?=$r_tlokasi['id_lokasi']?>"><?=ucwords($r_tkota['nama'])?> - Kec. <?=ucwords($r_tkec['nama'])?> - Kel. <?=ucwords($r_tkel['nama'])?></option>
				<?php endwhile; ?>
			</select>
		</div>
	</div>
	<input type="hidden" value="<?=$r_ukelompok['id_kelompok']?>" name="id_kelompok">
	<input type="hidden" value="<?=$r_uhaspeserta['id_has_peserta']?>" name="id_has_peserta">
	<input type="hidden" value="<?=$r_uhdpl_1['id_has_dpl']?>" name="id_has_dpl_1">
	<input type="hidden" value="<?=$r_uhdpl_2['id_has_dpl']?>" name="id_has_dpl_2">
	<input type="hidden" value="<?=$r_ujadwal['id_jadwal']?>" name="id_jadwal">
	<script type="text/javascript">    
		<?php echo $jsArray1; ?>  
		<?php echo $jsArray2; ?>  
	</script>			
<?php
	}  
	if(isset($_POST['idalbum'])){
	
	$id_album = $_POST['idalbum'];
	$r_ualbum = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_album WHERE id_album='$id_album'"));
?>
	<div class="content-divider text-muted form-group"><span>Judul Album</span></div>
	<div class="form-group row validation">
		<div class="col-sm-12">
			<input class="form-control input-sm" name="judul_album" value="<?=ucwords($r_ualbum['judul_album'])?>" placeholder="Masukan Judul Album" required="required" />
		</div>
	</div>
	<div class="content-divider text-muted form-group"><span>Keterangan Album</span></div>
	<div class="form-group row validation">
		<div class="col-sm-12">
			<textarea required="required" class="form-control input-sm" name="ket_album" placeholder="Masukan Keterangan Album"><?=ucwords($r_ualbum['ket_album'])?></textarea>
		</div>
	</div>
	<input type="hidden" value="<?=$r_ualbum['id_album']?>" name="id_album" />
<?php
	}
	if(isset($_POST['idprodi'])){
		
		$id_prodi = $_POST['idprodi'];
		$r_uprodi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$id_prodi'"));
?>
	<input type="hidden" value="<?=$r_uprodi['id_prodi']?>" name="id_prodi" />
	<div class="content-divider text-muted form-group"><span>Program Studi</span></div>
	<div class="form-group row">
		<div class="col-sm-7 validation">
			<input class="form-control input-sm" value="<?=ucwords($r_uprodi['nama_prodi'])?>" name="nama_prodi" placeholder="Masukan Nama Prodi" required="required" />
		</div>
		<div class="col-sm-5 validation">
			<input class="form-control input-sm" value="<?=strtoupper($r_uprodi['singkatan_prodi'])?>" name="singkatan_prodi" placeholder="Singkatan Prodi" required="required" />
		</div>
	</div>
<?php
	}
	if(isset($_POST['idlevel'])){
	$idlevel  = $_POST['idlevel'];
	$q_ulevel = mysqli_query($dbconnect,"SELECT * FROM tbl_level WHERE id_level='$idlevel'");
	$r_ulevel = mysqli_fetch_array($q_ulevel);

?>
	<input type="hidden" name="id_level" value="<?=$r_ulevel['id_level'];?>">
	<div class="content-divider text-muted form-group"><span>Level (Hak Akses)</span></div>
	<div class="form-group row validation">
		<div class="col-sm-12">
			<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Level.</span>
				<input type="text" class="form-control" name="level" value="<?=ucwords($r_ulevel['level'])?>"  placeholder="Masukan Level" required="required" />
			</div>
		</div>
	</div>
<?php
	}
	if(isset($_POST['idjadwal'])){
	$idjadwal  = $_POST['idjadwal'];
	$r_ujadwal = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_jadwal='$idjadwal'"));
	
	$tgljadwal = $r_ujadwal['tgl_jadwal'];
	
	$jadwal    = explode("-",$tgljadwal);
	
	$tgl       = $jadwal[2];	
	$bln       = $jadwal[1];	
	$thn       = $jadwal[0];
	
	
	$ustatus_monev = $r_ujadwal['status_jadwal'];
											
	if($ustatus_monev == "monev1"){
		$tustatus = "Monev 1 Mahasiswa KKN-PPM";
	}elseif($ustatus_monev == "monev2"){
		$tustatus = "Monev 2 Mahasiswa KKN-PPM";
	}elseif($ustatus_monev == "monev3"){
		$tustatus = "Monev 3 (Penarikan) Mahasiswa KKN-PPM";
	}else{
		$tustatus = "Pembekalan Mahasiswa KKN-PPM";
	}
?>
	<input type="hidden" name="id_jadwal" value="<?=$r_ujadwal['id_jadwal'];?>">
	<div class="content-divider text-muted form-group"><span>Status Monev</span></div>
	<div class="form-group row validation">
		<div class="col-md-12">
			<select name="status_jadwal" class="form-control input-sm" required>
				<option value="<?=((isset($idjadwal))?$r_ujadwal['status_jadwal']:'')?>"><?=((isset($idjadwal))?"✔ ".ucwords($tustatus):'Pilih Status')?></option>
				<option value="monev1">Monev 1 Mahasiswa KKN-PPM</option>
				<option value="monev2">Monev 2 Mahasiswa KKN-PPM</option>
				<option value="monev3">Monev 3 (Penarikan) Mahasiswa KKN-PPM</option>
			</select>
		</div>
	</div>
	<div class="content-divider text-muted form-group"><span>Jadwal</span></div>
	<div class="form-group row validation">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-4 validation">
					<select name="tgl" required class="form-control input-sm">
						<option value="<?=((isset($r_ujadwal))?$tgl:'');?>"><?=((isset($r_ujadwal))?"✔ ".$tgl:'Pilih Tanggal');?></option>
						<?php for ($n=1; $n <= 31 ; $n++) { ?>
							<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-4 validation">
					<select name="bln" required class="form-control input-sm">
						<option value="<?=((isset($r_ujadwal))?$bln:'');?>"><?=((isset($r_ujadwal))?"✔ ".getBulan($bln):'Pilih Bulan');?></option>
						<?php for ($n=1; $n <= 12 ; $n++) { ?>
							<option value="<?php echo $n; ?>" > <?php echo $namaBulan[$n]; ?> </option>
						<?php } // akhir looping?>
					</select>
				</div>
				<div class="col-md-4 validation">
					<select name="thn" required class="form-control input-sm">
						<option value="<?=((isset($r_ujadwal))?$thn:'');?>"><?=((isset($r_ujadwal))?"✔ ".$thn:'Pilih Tahun');?></option>
						<?php  for ($n= $tahun+0; $n <= $tahun+2 ; $n++) { ?>
							<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>						
	</div>
<?php
	}
	if(isset($_POST['idpesertapb'])){
	$idpesertapb  = $_POST['idpesertapb'];
	$r_upeserta = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$idpesertapb'"));
	
?>
	<div class="content-divider text-muted form-group"><span>Penilaian</span></div>
	<div class="form-group row">
		<div class="col-sm-12 validation">
			<input type="number" class="form-control input-sm" name="nilai_pb" placeholder="Masukan Nilai Pembekalan" required="required" />
		</div>
	</div>
	<input type="hidden" name="id_peserta" value="<?=$r_upeserta['id_peserta']?>" />
<?php
	}
	if(isset($_POST['idnilaipb'])){
	$idnilaipb  = $_POST['idnilaipb'];
	$r_unilaipb = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pb WHERE id_nilai='$idnilaipb'"));
	
?>
	<input type="hidden" value="<?=((isset($idnilaipb))?$r_unilaipb['id_nilai']:'')?>" name="id_nilai" />
	<div class="content-divider text-muted form-group"><span>Penilaian</span></div>
	<div class="form-group row">
		<div class="col-sm-12 validation">
			<input type="number" class="form-control input-sm" name="nilai_pb" value="<?=((isset($idnilaipb))?$r_unilaipb['nilai_pb']:'')?>" placeholder="Masukan Nilai Pembekalan" required="required" />
		</div>
	</div>
<?php
	}
	if(isset($_POST['idnilaiuklpk'])){
	$idnilaiuklpk  = $_POST['idnilaiuklpk'];
	$r_unilaiuklpk = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_nilai='$idnilaiuklpk'"));
	
?>
	<input type="hidden" value="<?=((isset($idnilaiuklpk))?$r_unilaiuklpk['id_nilai']:'')?>" name="id_nilai" />
	<input type="hidden" value="<?=((isset($idnilaiuklpk))?$r_unilaiuklpk['status_nilai']:'')?>" name="status_nilai" />
	<div class="content-divider text-muted form-group"><span>Penilaian</span></div>
	<div class="form-group row">
		<div class="col-sm-4 validation">
			<input type="number"  value="<?=((isset($idnilaiuklpk))?$r_unilaiuklpk['nilai1']:'')?>" class="form-control input-sm" name="nilai1" placeholder="Nilai I" required="required" />
		</div>
		<div class="col-sm-4 validation">
			<input type="number"  value="<?=((isset($idnilaiuklpk))?$r_unilaiuklpk['nilai2']:'')?>" class="form-control input-sm" name="nilai2" placeholder="Nilai II" required="required" />
		</div>
		<div class="col-sm-4 validation">
			<input type="number"  value="<?=((isset($idnilaiuklpk))?$r_unilaiuklpk['nilai3']:'')?>" class="form-control input-sm" name="nilai3" placeholder="Nilai III" required="required" />
		</div>
	</div>
<?php
	}
	if(isset($_POST['idpesertakm'])){
	$idpesertakm  = $_POST['idpesertakm'];
	$r_upeserta     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$idpesertakm'"));
?>
	<div class="content-divider text-muted form-group"><span>Penilaian</span></div>
	<div class="form-group row">
		<div class="col-sm-6 validation">
			<input type="number" class="form-control input-sm" name="nilai_ds" placeholder="Nilai Disiplin" required="required" />
		</div>
		<div class="col-sm-6 validation">
			<input type="number" class="form-control input-sm" name="nilai_ks" placeholder="Nilai Kerjasama" required="required" />
		</div>
	</div>
	<input type="hidden" name="id_peserta" value="<?=$r_upeserta['id_peserta']?>" />
<?php
	}
	if(isset($_POST['idnilaikm'])){
	$idnilaikm = $_POST['idnilaikm'];
	$r_unilai    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_km WHERE id_nilai='$idnilaikm'"));
?>
	<input type="hidden" value="<?=((isset($idnilaikm))?$r_unilai['id_nilai']:'')?>" name="id_nilai" />
	<div class="content-divider text-muted form-group"><span>Penilaian</span></div>
	<div class="form-group row">
		<div class="col-sm-6 validation">
			<input type="number" value="<?=((isset($idnilaikm))?$r_unilai['nilai_ds']:'')?>" class="form-control input-sm" name="nilai_ds" placeholder="Nilai Disiplin" required="required" />
		</div>
		<div class="col-sm-6 validation">
			<input type="number" value="<?=((isset($idnilaikm))?$r_unilai['nilai_ks']:'')?>" class="form-control input-sm" name="nilai_ks" placeholder="Nilai Kerjasama" required="required" />
		</div>
	</div>
<?php
	}
	if(isset($_POST['idpesertapl'])){
	$idpesertapl  = $_POST['idpesertapl'];
	$r_upeserta   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$idpesertapl'"));
?>
	<div class="content-divider text-muted form-group"><span>Penilaian</span></div>
	<div class="form-group row">
		<div class="col-sm-12 validation">
			<input type="number" class="form-control input-sm" name="nilai_pl" placeholder="Masukan Nilai Pelaksanaan Program" required="required" />
		</div>
	</div>
	<input type="hidden" name="id_peserta" value="<?=$r_upeserta['id_peserta']?>" />
<?php
	}
	if(isset($_POST['idnilaipl'])){
	$idnilaipl = $_POST['idnilaipl'];
	$r_unilai    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pl WHERE id_nilai='$idnilaipl'"));
?>
	<input type="hidden" value="<?=((isset($idnilaipl))?$r_unilai['id_nilai']:'')?>" name="id_nilai" />
	<div class="content-divider text-muted form-group"><span>Penilaian</span></div>
	<div class="form-group row">
		<div class="col-sm-12 validation">
			<input type="number"  value="<?=((isset($idnilaipl))?$r_unilai['nilai_pl']:'')?>" class="form-control input-sm" name="nilai_pl" placeholder="Masukan Nilai Pelaksanaan Program" required="required" />
		</div>
	</div>
<?php
	}	
	if(isset($_POST['idapeserta'])){
		$idapeserta  = $_POST['idapeserta'];
		$r_upeserta  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$idapeserta'"));
?>

	<!--<script src="../../assets/lindox-style/js/uploudpdf.js"></script>
	<div class="row">
		<div class="col-md-12">
			<embed src="../../setting/save/surat/default.pdf" style="width:100%;height:350px; border:1px solid #eee;" id="img-upload"  type="application/pdf"></embed>
		</div>
	</div>-->
	<input type="hidden" name="id_peserta" value="<?=$r_upeserta['id_peserta']?>" />
<?php
	}
		if(isset($_POST['idabsen'])){
		$idabsen  = $_POST['idabsen'];
		$r_absen  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_absen WHERE id_absen='$idabsen'"));
?>
	<div class="row">
		<div class="col-sm-12 validation">
			<embed style="width:100%; height:400px;" src="../../setting/save/surat/<?=$r_absen['surat_peserta']?>"  type="application/pdf"></embed>
		</div>
	</div>
<?php
	}
?>