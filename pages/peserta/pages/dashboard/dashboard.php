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
	
	$id_kelompok   = $r_xkelompok['id_kelompok'];
	$r_thaspeserta = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_kelompok='$r_xkelompok[id_kelompok]'"));
									
	$r_tpeserta	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_thaspeserta[id_peserta]' AND status_peserta='sudah'"));
	
	$r_tmahasiswa  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_tpeserta[id_mahasiswa]'"));
	
	$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_xkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
	
	$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
	
	$r_tdosen1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
	
	$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_xkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

	$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
	
	$r_tdosen2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));		
	
	$q_banggota    = mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_kelompok='$id_kelompok' AND status_has_peserta='anggota'");
	
	$q_bketua	   = mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_kelompok='$id_kelompok' AND status_has_peserta='ketua'");
	$cek_ketua     = mysqli_num_rows($q_bketua);
	$r_bketua	   = mysqli_fetch_array($q_bketua);
	
	$r_bpeserta	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_bketua[id_peserta]' AND status_peserta='sudah'"));
	
	$r_bmahasiswa  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_tpeserta[id_mahasiswa]'"));
	
	$r_bprodi      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_bmahasiswa[id_prodi]'"));
	
	$r_tlokasi	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_xkelompok[id_lokasi]'"));
	
	$r_tprov = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
							
	$r_tkota = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
	
	$r_tkec  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
	
	$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
	
	$r_tmitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
	
	include '../../setting/action/aksi_map.php';
	
	$q_tjadwal     = mysqli_query($dbconnect,"SELECT tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta, tbl_kelompok.id_kelompok, tbl_kelompok.nama_kelompok, tbl_kelompok.tahun_kkn, tbl_jadwal.id_jadwal, tbl_jadwal.id_kelompok, tbl_jadwal.tgl_jadwal, tbl_jadwal.status_jadwal FROM tbl_has_peserta NATURAL JOIN tbl_kelompok NATURAL JOIN tbl_jadwal WHERE tbl_has_peserta.id_peserta='$r_peserta[id_peserta]' AND tbl_kelompok.id_kelompok='$r_xkelompok[id_kelompok]' AND tbl_jadwal.id_jadwal ORDER BY tbl_jadwal.tgl_jadwal ASC");
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
								<td colspan="4">Jadwal Monev Kelompok <b><?=$r_xkelompok['nama_kelompok']?></b></td>
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
								<?php if($status_peserta == "ketua"){?>	
									<a href="?page=absen-peserta&absen=<?=$r_tjadwal['id_jadwal']?>" class="label label-default <?=(($r_tjadwal['tgl_jadwal']==$tglsekarang)?'':'nopointer')?>" data-placement="left"  data-popup="tooltip" title="" data-original-title="Absen"><i class="fa fa-check-square-o"></i> Absen</a>
								<?php }else{ echo "";}?>	
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
								<td colspan="5">Anggota Kelompok <b><?=$r_xkelompok['nama_kelompok']?></b></td>
							</tr>
						</thead>
						<tbody>
							<?php
								if($cek_ketua!==0){									
							?>
							<tr>
								<td class="text-center">
									<h6 class="no-margin">1.</h6>
								</td>
								<td>
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=ucwords($r_bmahasiswa['nim']);?></a>
									</div>
								</td>
								<td>
									<div class="media-left media-middle">
										<a href="#"><img src="../../setting/save/mahasiswa/<?=cek_foto($r_bmahasiswa['foto_mahasiswa']);?>" class="img-circle img-xs" alt=""></a>
									</div>
									
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=ucwords($r_bmahasiswa['nama_mahasiswa']);?></a>
										<div class="text-muted text-size-small"><span class="status-mark border-success position-left"></span> <b><?=ucwords($r_bketua['status_has_peserta'])?></b> Kelompok</div>
									</div>
								</td>
								<td>
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=ucwords($r_bprodi['nama_prodi']);?></a>
									</div>
								</td>
								<td>
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=ucwords($r_bmahasiswa['jk_mahasiswa']);?></a>
									</div>
								</td>
							</tr>
							<?php 
								} 
								if(($cek_ketua!==0) || ($cek_ketua==0)) {
									$no=2;
								}
								if($cek_ketua==0) {
									$no=1;
								}
								while($r_banggota = mysqli_fetch_array($q_banggota)){
									
								$r_gpeserta	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_banggota[id_peserta]' AND status_peserta='sudah'"));

								$r_gmahasiswa  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_gpeserta[id_mahasiswa]'"));
								
								$r_bgprodi      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_gmahasiswa[id_prodi]'"));
							?>
								<tr>
								<td class="text-center">
									<h6 class="no-margin"><?=$no++;?></h6>
								</td>
								<td>
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=ucwords($r_gmahasiswa['nim']);?></a>
									</div>
								</td>
								<td>
									<div class="media-left media-middle">
										<a href="#"><img src="../../setting/save/mahasiswa/<?=cek_foto($r_gmahasiswa['foto_mahasiswa']);?>" class="img-circle img-xs" alt=""></a>
									</div>
									
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=ucwords($r_gmahasiswa['nama_mahasiswa']);?></a>
										<div class="text-muted text-size-small"><span class="status-mark border-success position-left"></span> <b><?=ucwords($r_banggota['status_has_peserta'])?></b> Kelompok</div>
									</div>
								</td>
								<td>
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=ucwords($r_bgprodi['nama_prodi']);?></a>
									</div>
								</td>
								<td>
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=ucwords($r_gmahasiswa['jk_mahasiswa']);?></a>
									</div>
								</td>
							</tr>
							<?php } ?>	
						</tbody>
					</table>
				</div>
			</div>			
		</div>
	</div>
		<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
			<div class="panel-heading">Lokasi KKN Kelompok <b><?=$r_xkelompok['nama_kelompok']?></b>
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