<?php
include '../connect/config.php';

$r_atur = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_pengaturan WHERE id_pengaturan"));

if(isset($_POST['id_prodi'])){
	
	$q_peserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.tahun_kkn, tbl_peserta.status_peserta FROM tbl_mahasiswa NATURAL JOIN tbl_peserta WHERE tbl_mahasiswa.id_prodi='$_POST[id_prodi]' AND tbl_peserta.status_peserta='sudah' AND tahun_kkn='$r_atur[tahun_kkn]'");
	$cek_peserta = mysqli_num_rows($q_peserta);
	$jsArray     = "var peserta = new Array();\n";  
	if($cek_peserta > 0){
	?>	
		<option selected value="">Pilih Ketua Kelompok</option>
<?php	 
		while($r_peserta = mysqli_fetch_array($q_peserta)){
			 
		$r_hpeserta = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_peserta='$r_peserta[id_peserta]'"));

		if($r_peserta['id_peserta'] == $r_hpeserta['id_peserta']){echo "";}else{
	?>
		<option value="<?=$r_peserta['id_peserta']?>"><?=ucwords($r_peserta['nama_mahasiswa'])?></option>
<?php		
			$jsArray .= "peserta['" . $r_peserta['id_peserta'] . "'] = {id_peserta:'" . addslashes($r_peserta['id_peserta']). "', nim:'" . addslashes($r_peserta['nim']). "'};\n";     
				}
			}
		}else{
	?>
		<option selected value="">Tidak Ada</option>
<?php } ?>
<script type="text/javascript">    
	<?php echo $jsArray; ?>  
	function changeValue(id){  
		document.getElementById('nim').value = peserta[id].nim;  
		document.getElementById('id_peserta').value = peserta[id].id_peserta;  
	};  
</script>
<?php 
	
	}
	
if(isset($_POST['uid_prodi'])){
	
	$q_peserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.tahun_kkn, tbl_peserta.status_peserta FROM tbl_mahasiswa NATURAL JOIN tbl_peserta WHERE tbl_mahasiswa.id_prodi='$_POST[uid_prodi]' AND tbl_peserta.status_peserta='sudah' AND tahun_kkn='$r_atur[tahun_kkn]'");
	$cek_peserta = mysqli_num_rows($q_peserta);
	$jsArray     = "var upeserta = new Array();\n";  
	if($cek_peserta > 0){
	?>	
		 <option selected value="">Pilih Ketua Kelompok</option>
<?php	 
		 while($r_peserta = mysqli_fetch_array($q_peserta)){
			 
			$r_hpeserta = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_peserta='$r_peserta[id_peserta]'"));

			if($r_peserta['id_peserta'] == $r_hpeserta['id_peserta']){echo "";}else{
	?>
		<option value="<?=$r_peserta['id_peserta']?>"><?=ucwords($r_peserta['nama_mahasiswa'])?></option>
<?php		
			$jsArray .= "upeserta['" . $r_peserta['id_peserta'] . "'] = {uid_peserta:'" . addslashes($r_peserta['id_peserta']). "', unim:'" . addslashes($r_peserta['nim']). "'};\n";     
				}
			}
		}else{
	?>
		<option selected value="">Tidak Ada</option>
<?php } ?>
<script type="text/javascript">    
	<?php echo $jsArray; ?>  
	function changeValue(id){  
		document.getElementById('unim').value = upeserta[id].unim;  
		document.getElementById('uid_peserta').value = upeserta[id].uid_peserta;  
	};  
</script>
<?php 
	
		} 

if(isset($_POST['aid_prodi'])){
	
	$q_peserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.tahun_kkn, tbl_peserta.status_peserta FROM tbl_mahasiswa NATURAL JOIN tbl_peserta WHERE tbl_mahasiswa.id_prodi='$_POST[id_prodi]' AND tbl_peserta.status_peserta='sudah' AND tahun_kkn='$r_atur[tahun_kkn]'");
	$cek_peserta = mysqli_num_rows($q_peserta);
	$jsArray     = "var apeserta = new Array();\n";  
	if($cek_peserta > 0){
	?>	
		 <option selected value="">Pilih Ketua Kelompok</option>
<?php	 
		 while($r_peserta = mysqli_fetch_array($q_peserta)){
	?>
		<option value="<?=$r_peserta['id_peserta']?>"><?=ucwords($r_peserta['nama_mahasiswa'])?></option>
<?php		
			$jsArray .= "apeserta['" . $r_peserta['id_peserta'] . "'] = {aid_peserta:'" . addslashes($r_peserta['id_peserta']). "', anim:'" . addslashes($r_peserta['nim']). "'};\n";     
			}
		}else{
	?>
		<option selected value="">Tidak Ada</option>
<?php } ?>
<script type="text/javascript">    
	<?php echo $jsArray; ?>  
	function changeValue(id){  
		document.getElementById('anim').value = apeserta[id].anim;  
		document.getElementById('aid_peserta').value = apeserta[id].aid_peserta;  
	};  
</script>
<?php 
	
		}
		
	if(isset($_GET['prop'])){
		if(ctype_digit($_GET['prop'])){
			$q_sprov = mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_prov='$_GET[prop]' ORDER BY nama");
	?>
		<option value="">Pilih Kota/Kabupaten</option>
<?php
		while($r_sprov = mysqli_fetch_array($q_sprov)){
	?>
		<option value="<?=$r_sprov['id_kab']?>"><?=ucwords($r_sprov['nama'])?></option>
<?php
			}
		}
	}
	
	if(isset($_GET['kab'])){
		if(ctype_digit($_GET['kab'])){
			$q_skab = mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kab='$_GET[kab]' ORDER BY nama");
	?>
		<option value="">Pilih Kecamatan</option>
<?php
		while($r_skab = mysqli_fetch_array($q_skab)){
	?>
		<option value="<?=$r_skab['id_kec']?>">Kec. <?=ucwords($r_skab['nama'])?></option>
<?php
			}
		}
	}
	
	if(isset($_GET['kec'])){
		if(ctype_digit($_GET['kec'])){
			$q_skec = mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kec='$_GET[kec]' ORDER BY nama");
	?>
		<option value="">Pilih Kelurahan/Desa</option>
<?php
		while($r_skec = mysqli_fetch_array($q_skec)){
	?>
		<option value="<?=$r_skec['id_kel']?>">Kel. <?=ucwords($r_skec['nama'])?></option>
<?php
			}
		}
	}
	
	?>