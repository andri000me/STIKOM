<?php if(empty($r_mitra['foto_mitra'])){ ?>
	<div class="alert alert-danger nobor norad" style="margin-bottom:0;">
		<div class="alert-boxed">
		  <strong>Peringatan !</strong> Mungkin Foto Anda belum dimasukan, Silahkan melengkapi data profil Anda. <a href="?page=profil-mitra&profil=<?=$r_mitra['id_mitra']?>">Klik disini</a> untuk masuk dihalaman profil agar dapat melengkapi data profil Anda.
		</div>
	</div>
<?php }else{echo "";}?>	
<!-- Main navbar -->
	<div class="navbar navbar-inverse">
	<div class="navbar-boxed">
		<div class="navbar-header">
			<a class="navbar-brand" href="?page=dashboard" style="margin-top:-7px;"><span style="font-size:15px;"><span class="text-thin">Sistem Informasi</span> <b>KKN</b></span><p style="font-size:10px; margin-top:-7px;">#UNDANA KUPANG</p> </a>
			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-bars"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">	
			<p class="navbar-text"><span class="label bg-success-400"><i class='fa fa-user'></i> Mitra Lapangan</span></p>
			<ul class="nav navbar-nav">	
				<li>
					<a href="../../" target="_blank"><i class="fa fa-globe"></i> <span class="position-right">WEBSITE</span></a>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<!--<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell"></i>
						<span class="visible-xs-inline-block position-right">Pemberitahuan</span>
						<?php if($cek_peserta == 0){ echo"";}else{?><span class="badge bg-warning-400"><?=$cek_peserta;?></span><?php } ?>
					</a>
					<?php if($cek_peserta == 0){ echo"";}else{?>
					<div class="dropdown-menu dropdown-content width-350">
						<div class="dropdown-content-heading">
							Pemberitahuan
						</div>
						<ul class="media-list dropdown-content-body">
							<?php 
								while($r_ppeserta = mysqli_fetch_array($q_ppeserta)): 
								
								$r_pmahasiswa = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_ppeserta[id_mahasiswa]'"));
								
								$namapeserta      = explode(" ",$r_pmahasiswa['nama_mahasiswa']);	
								$namadepanpeserta = $namapeserta[0];
							?>
							<li class="media">
								<div class="media-left">
									<img src="../../setting/save/mahasiswa/<?=cek_foto($r_pmahasiswa['foto_mahasiswa']);?>" class="img-circle img-sm" alt="">
								</div>

								<div class="media-body">
									<span class="media-heading">
										<span class="text-semibold"><?=ucwords($r_pmahasiswa['nama_mahasiswa']);?></span>
										<span style="font-size:11px;" class="media-annotation pull-right"><?=tgl_indo($r_ppeserta['tgl_daftar'])?></span>
										<p class="text-muted">Berkas persyaratan <b><?=ucwords($namadepanpeserta);?></b> belum diperiksa, <a href="?page=cekberkas&cek_berkas=<?=$r_ppeserta['id_peserta']?>">Lanjut Cek Berkas...</a></p>
									</span>
								</div>
							</li>
							<?php endwhile; ?>
						</ul>
						<div class="dropdown-content-footer">
							<a href="?page=peserta" data-popup="tooltip" title="" data-original-title="Lihat Semua"><i class="fa fa-ellipsis-h display-block"></i></a>
						</div>						
					</div>
					<?php } ?>
				</li>-->
				<li class="dropdown dropdown-user <?php if (stripos($_SERVER['REQUEST_URI'], '?page=profil')){echo "active";}?>">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="../../setting/save/mitra/<?=cek_foto($r_mitra['foto_mitra']);?>" alt="">
						<span>Hi, <?=ucwords(cek_jk($r_mitra['jk_mitra'])." ".$namadepan)?></span>
						<i class="fa fa-angle-down"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="?page=profil-mitra&profil=<?=$r_mitra['id_mitra']?>"><i class="fa fa-user-circle-o"></i> Profil <?=ucwords(cek_jk($r_mitra['jk_mitra'])." ".$namadepan)?></a></li>
						<li class="divider"></li>
						<li><a href="../../setting/include/logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	</div>
	<!-- /main navbar -->