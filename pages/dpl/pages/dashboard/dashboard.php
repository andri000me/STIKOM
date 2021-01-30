<?php
	
	
	
	$q_kelompok    = mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE tahun_kkn='$r_atur[tahun_kkn]'");
	$cek_kelompok  = mysqli_num_rows($q_kelompok);
	$jum_kelompok   = str_pad($cek_kelompok, 3, "0", STR_PAD_LEFT);
	
	$q_peserta     = mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE tahun_kkn='$r_atur[tahun_kkn]' AND status_peserta ='sudah'");
	$cek_peserta   = mysqli_num_rows($q_peserta);
	$jum_peserta   = str_pad($cek_peserta, 3, "0", STR_PAD_LEFT);
	
	$q_dpl         = mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dpl");
	$cek_dpl       = mysqli_num_rows($q_dpl);
	$jum_dpl       = str_pad($cek_dpl, 3, "0", STR_PAD_LEFT);
	
	$q_bpeserta    = mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE status_peserta='belum'");
	$cek_bpeserta  = mysqli_num_rows($q_bpeserta);
	
	$q_album       = mysqli_query($dbconnect,"SELECT * FROM tbl_album WHERE status_album='belum'");
	$cek_album     = mysqli_num_rows($q_album);
	
	$q_tkelompok   = mysqli_query($dbconnect,"SELECT tbl_has_dpl.id_has_dpl, tbl_has_dpl.id_kelompok, tbl_has_dpl.id_dpl, tbl_kelompok.id_kelompok, tbl_kelompok.id_lokasi, tbl_kelompok.id_prodi, tbl_kelompok.nama_kelompok, tbl_kelompok.tahun_kkn FROM tbl_has_dpl NATURAL JOIN tbl_kelompok WHERE tbl_has_dpl.id_dpl='$r_dpl[id_dpl]' AND tbl_kelompok.tahun_kkn='$r_atur[tahun_kkn]' AND tbl_kelompok.id_kelompok ORDER BY tbl_kelompok.nama_kelompok ASC");
	$cek_tkelompok = mysqli_num_rows($q_tkelompok);

	$q_tjadwal     = mysqli_query($dbconnect,"SELECT tbl_has_dpl.id_has_dpl, tbl_has_dpl.id_kelompok, tbl_has_dpl.id_dpl, tbl_kelompok.id_kelompok, tbl_kelompok.nama_kelompok, tbl_kelompok.tahun_kkn, tbl_jadwal.id_jadwal, tbl_jadwal.id_kelompok, tbl_jadwal.tgl_jadwal, tbl_jadwal.status_jadwal FROM tbl_has_dpl NATURAL JOIN tbl_kelompok NATURAL JOIN tbl_jadwal WHERE tbl_has_dpl.id_dpl='$r_dpl[id_dpl]' AND tbl_kelompok.tahun_kkn='$r_atur[tahun_kkn]' AND tbl_jadwal.id_jadwal ORDER BY tbl_jadwal.tgl_jadwal ASC");
?>
<div class="row">
	<div class="col-sm-5">
		<div class="row">
			<div class="col-sm-4 col-xs-4">
				<div class="panel">
					<div class="panel-body">
						<div class="row text-center">
							<div class="col-xs-12">
								<h5 class="text-thin no-margin"><?=$jum_peserta;?></h5>
								<span class="text-size-small">Peserta KKN</span>
							</div>
						</div>
					</div>
					<a style="pointer-events:none;" href="?page=peserta">
						<img src="../../assets/img/icon/mahasiswa.jpg" style="width:100%; height:150px;" alt="">
					</a>
				</div>
			</div>
			
			<div class="col-sm-4 col-xs-4">
				<div class="panel">
					<div class="panel-body">
						<div class="row text-center">
							<div class="col-xs-12">
								<h5 class="text-thin no-margin"><?=$jum_dpl;?></h5>
								<span class="text-size-small">DPL</span>
							</div>
						</div>
					</div>
					<a style="pointer-events:none;" href="?page=dpl">
						<img src="../../assets/img/icon/pembimbing.jpg" style="width:100%; height:150px;" alt="">
					</a>
				</div>
			</div>
			
			<div class="col-sm-4 col-xs-4">
				<div class="panel">
					<div class="panel-body">
						<div class="row text-center">
							<div class="col-xs-12">
								<h5 class="text-thin no-margin"><?=$jum_kelompok;?></h5>
								<span class="text-size-small">Kelompok KKN</span>
							</div>
						</div>
					</div>
					<a style="pointer-events:none;" href="?page=kelompok">
						<img src="../../assets/img/icon/kelompok.jpg" style="width:100%; height:150px;" alt="">
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
					<div class="panel panel-flat">
				<div class="table-responsive">
					<table class="table text-nowrap">
						<thead>
							<tr class="active">
								<td colspan="4">Jadwal Monev</td>
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=0;
							while($r_tjadwal = mysqli_fetch_array($q_tjadwal)):
											
							$status_monev = $r_tjadwal['status_jadwal'];
							
							if($status_monev == "monev1"){
								$tstatus = "Monev 1 Mahasiswa KKN-PPM";
								$key     = "monev";
							}elseif($status_monev == "monev2"){
								$tstatus = "Monev 2 Mahasiswa KKN-PPM";
								$key     = "monev";
							}elseif($status_monev == "monev3"){
								$tstatus = "Monev 3 (Penarikan) Mahasiswa KKN-PPM";
								$key     = "monev";
							}else{
								$tstatus = "Pembekalan Mahasiswa KKN-PPM";
								$key     = "pembekalan";
							}
							
							$tgl_jadwal = explode("-",$r_tjadwal['tgl_jadwal']);
							
							$tglj = $tgl_jadwal[2];
							$blnj = $tgl_jadwal[1];
							$thnj = $tgl_jadwal[0];
							
							$no++;
							
							
						?>
							<tr <?=(($r_tjadwal['tgl_jadwal']==$tglsekarang)?'style="background:rgba(255,191,191,0.3);"':'')?>>
								<td class="text-center">
									<h6 class="no-margin"><?=$tglj;?> <small class="display-block text-size-small no-margin"><?=getBulan($blnj)." ".$thnj;?></small></h6>
								</td>
								<td>
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=ucwords($tstatus)?></a>
										<div class="text-muted text-size-small"><span class="status-mark border-primary position-left"></span> Jadwal Kelompok <?=$r_tjadwal['nama_kelompok']?></div>
									</div>
								</td>
								<td class="text-center">
									<a href="?page=absen-dpl&absen=<?=$r_tjadwal['id_jadwal']?>" class="label label-default" data-placement="left"  data-popup="tooltip" title="" data-original-title="Cek Absen"><i class="fa fa-search-plus"></i> Cek</a>
								</td>
							</tr>
						<?php endwhile; ?>	
						</tbody>
					</table>
				</div>
			</div>			
		
			</div>
		</div>
	</div>
	<div class="col-sm-7">
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-flat">
				<div class="table-responsive">
					<table class="table text-nowrap">
						<thead>
							<tr class="active">
								<td colspan="3">Kelompok Bimbingan</td>
								<td class="text-right">
									<span class="label bg-slate-800"><?php if($cek_tkelompok == 0){ echo"Kosong";}else{echo $cek_tkelompok." Kelompok";}?></span>
								</td>
							</tr>
						</thead>
						<tbody>
						<?php 
							$no=0;
							while($r_tkelompok = mysqli_fetch_array($q_tkelompok)): 
							
							$id_kelompok  = $r_tkelompok['id_kelompok']; 
										
							$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
							
							$r_haspeserta = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_kelompok='$r_tkelompok[id_kelompok]'"));
							
							$r_peserta	  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_haspeserta[id_peserta]'"));
							
							$r_pmahasiswa  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_peserta[id_mahasiswa]'"));
							
							$nama_kelompok  = $r_tkelompok['nama_kelompok'];	
							
							
							$no++;
							
						?>
							<tr>
								<td class="text-center">
									<h6 class="no-margin"><?=$no;?>.</h6>
								</td>
								<td>
									<div class="media-left media-middle">
										<a href="#" style="pointer-events:none;" class="btn bg-brown-800 btn-rounded btn-icon btn-xs">
											<?="Kelompok <b>".$nama_kelompok."</b>"?>
										</a>
									</div>											
								</td>
								<td>
									<div class="media-left media-middle">
										<a href="#"><img src="../../setting/save/mahasiswa/<?=cek_foto($r_pmahasiswa['foto_mahasiswa']);?>" class="img-circle img-xs" alt=""></a>
									</div>
									
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=ucwords($r_pmahasiswa['nama_mahasiswa']);?></a>
										<div class="text-muted text-size-small"><span class="status-mark border-success position-left"></span> Ketua Kelompok</div>
									</div>
								</td>
								<td class="text-center">
									<a href="?page=detail-kelompok-dpl&kelompok=<?=$r_tkelompok['id_kelompok']?>" class="label label-default" data-placement="left"  data-popup="tooltip" title="" data-original-title="Detail Kelompok"><i class="fa fa-search-plus"></i> Detail</a>
								</td>
							</tr>
						<?php endwhile; ?>	
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</div>
		<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
			<div class="panel-heading">Lokasi KKN Bimbingan
				<!--<div class="heading-elements panel-nav">
					<ul class="nav nav-pills nav-pills-bordered text-right">
						<li class=""><a href="?page=lokasi">Detail <i style="margin-top:-4px;" class="fa fa-chevron-circle-right"></i></a></li>	
					</ul>
				</div>-->
			</div>
				<div id="map-canvas" style="width:100%; height:300px;"></div>
			</div>
		</div>
	</div>
	</div>
</div>