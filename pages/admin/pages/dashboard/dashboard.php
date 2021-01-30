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
	
	$q_dosen       = mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen");
	$cek_dosen     = mysqli_num_rows($q_dosen);
	$jum_dosen     = str_pad($cek_dosen, 3, "0", STR_PAD_LEFT);
	
	$q_mahasiswa   = mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa");
	$cek_mahasiswa = mysqli_num_rows($q_mahasiswa);
	$jum_mahasiswa = str_pad($cek_mahasiswa, 3, "0", STR_PAD_LEFT);
	
	$q_admin       = mysqli_query($dbconnect,"SELECT * FROM tbl_admin WHERE id_admin");
	$cek_admin     = mysqli_num_rows($q_admin);
	$jum_admin   = str_pad($cek_admin, 3, "0", STR_PAD_LEFT);
	
	$q_bpeserta    = mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE status_peserta!='sudah'");
	$cek_bpeserta  = mysqli_num_rows($q_bpeserta);
	
	$q_album       = mysqli_query($dbconnect,"SELECT * FROM tbl_album WHERE status_album='belum'");
	$cek_album     = mysqli_num_rows($q_album);
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
					<a href="?page=peserta">
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
					<a href="?page=dpl">
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
					<a href="?page=kelompok">
						<img src="../../assets/img/icon/kelompok.jpg" style="width:100%; height:150px;" alt="">
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-body">
					<div class="row text-center">
						<div class="col-xs-4">
							<p><i class="fa fa-user-o fa-3x display-inline-block text-info"></i></p>
							<h5 class="text-thin no-margin"><?=$jum_dosen;?></h5>
							<span class="text-size-small">Dosen</span>
						</div>

						<div class="col-xs-4">
							<p><i class="fa fa-user-o fa-3x display-inline-block text-warning"></i></p>
							<h5 class="text-thin no-margin"><?=$jum_mahasiswa;?></h5>
							<span class="text-size-small">Mahasiswa</span>
						</div>

						<div class="col-xs-4">
							<p><i class="fa fa-user-o fa-3x display-inline-block text-success"></i></p>
							<h5 class="text-thin no-margin"><?=$jum_admin;?></h5>
							<span class="text-size-small">Admin</span>
						</div>
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
								<td colspan="2">Pendaftar Baru</td>
								<td class="text-right">
									<span class="label bg-slate-800"><?php if($cek_bpeserta == 0){ echo"Kosong";}else{echo $cek_bpeserta." Pendaftar";}?></span>
								</td>
							</tr>
						</thead>
						<tbody>
						<?php 
							while($r_bpeserta = mysqli_fetch_array($q_bpeserta)): 
							
							$r_pmahasiswa = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_bpeserta[id_mahasiswa]'"));
							
							$namapeserta      = explode(" ",$r_pmahasiswa['nama_mahasiswa']);	
							$namadepanpeserta = $namapeserta[0];
							
							$tgl_daftar = explode("-",$r_bpeserta['tgl_daftar']);
							
							$tgld = $tgl_daftar[2];
							$blnd = $tgl_daftar[1];
							$thnd = $tgl_daftar[0];
							
							$statuspeserta = $r_bpeserta['status_peserta'];
							
							if($statuspeserta == "tidak"){
								$stberkas = "Berkas Belum Diperiksa";
							}
							elseif($statuspeserta == "belum"){
								$stberkas = "Berkas Belum Lengkap";
							}
							elseif($statuspeserta == "ubah"){
								$stberkas = "Berkas Pengganti";
							}
							else{
								$stberkas = "";
							}
							
						?>
							<tr>
								<td class="text-center">
									<h6 class="no-margin"><?=$tgld;?> <small class="display-block text-size-small no-margin"><?=getBulan($blnd)." ".$thnd;?></small></h6>
								</td>
								<td>
									<div class="media-left media-middle">
										<a href="#"><img src="../../setting/save/mahasiswa/<?=cek_foto($r_pmahasiswa['foto_mahasiswa']);?>" class="img-circle img-xs" alt=""></a>
									</div>
									
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=ucwords($r_pmahasiswa['nama_mahasiswa']);?></a>
										<div class="text-muted text-size-small"><span class="status-mark border-red position-left"></span> <?=$stberkas;?></div>
									</div>
								</td>
								<td class="text-center">
									<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Cek Berkas"  href="?page=cekberkas&cek_berkas=<?=$r_bpeserta['id_peserta']?>" type="button" class="label label-default"><i class="fa fa-search-plus"></i> Cek</a>
								</td>
							</tr>
						<?php endwhile; ?>	
						</tbody>
					</table>
				</div>
				<div class="table-responsive">
					<table class="table text-nowrap">
						<thead>
							<tr class="active">
								<td colspan="2">Album Kelompok Baru</td>
								<td class="text-right">
									<span class="label bg-slate-800"><?php if($cek_album == 0){ echo"Kosong";}else{echo $cek_album." Album";}?></span>
								</td>
							</tr>
						</thead>
						<tbody>
						<?php 
							while($r_album = mysqli_fetch_array($q_album)): 
							
							$r_pkelompok = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$r_album[id_kelompok]'"));
							
							$tgl_post = explode("-",$r_album['tgl_post']);
							
							$tglp = $tgl_post[2];
							$blnp = $tgl_post[1];
							$thnp = $tgl_post[0];
							
						?>
							<tr>
								<td class="text-center">
									<h6 class="no-margin"><?=$tglp;?> <small class="display-block text-size-small no-margin"><?=getBulan($blnp)." ".$thnp;?></small></h6>
								</td>
								<td>
									<div class="media-left media-middle">
										<a href="#" style="pointer-events:none;" class="btn bg-teal-400 btn-rounded btn-icon btn-xs">
											<?="<b>Album</b> Kel. ".$r_pkelompok['nama_kelompok']?>
										</a>
									</div>
									<div class="media-body">
										<a href="#" class="display-inline-block text-default text-semibold letter-icon-title"><?=substr(ucwords($r_album['ket_album']),0,30);?>...</a>
										<div class="text-muted text-size-small"><span class="status-mark border-red position-left"></span> Album Belum Dipost</div>
									</div>												
								</td>
								<td class="text-center">												
									<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Cek Album" href="?page=galeri&album=<?=$r_album['id_album']?>" type="button" class="label label-default"><i class="fa fa-search-plus"></i> Cek</a>
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
			<div class="panel-heading">Lokasi KKN
				<div class="heading-elements panel-nav">
					<ul class="nav nav-pills nav-pills-bordered text-right">
						<li class=""><a href="?page=lokasi">Detail <i style="margin-top:-4px;" class="fa fa-chevron-circle-right"></i></a></li>	
					</ul>
				</div>
			</div>
				<div id="map-canvas" style="width:100%; height:300px;"></div>
			</div>
		</div>
	</div>
	</div>
</div>