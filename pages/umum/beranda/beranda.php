<div class="row no-gutters">
	<div class="col-sm-8">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-white norad" >					
					<div id="owl-demo" class="owl-carousel owl-theme">	
					<?php 
						$q_album     = mysqli_query($dbconnect,"SELECT * FROM tbl_album WHERE id_album AND status_album='sudah' ORDER BY tgl_post DESC");
						while($r_album = mysqli_fetch_array($q_album)):
						
						$r_xfoto    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_foto WHERE id_album='$r_album[id_album]'"));
					?>
						 <div class="item"><img src="setting/save/galeri/<?=$r_xfoto['foto'];?>" ></div>
					<?php endwhile; ?> 
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-flate norad">
				<div class="panel-heading">
					<h6 class="panel-title">Berkas Pengurusan <b>KKN</b></h6>
				</div>
				<ul class="media-list media-list-linked media-list-bordered">
				<?php
					$q_bk = mysqli_query($dbconnect,"SELECT * FROM tbl_bk WHERE id_bk");
					while($r_bk = mysqli_fetch_array($q_bk)):
				?>
					<li class="media">
						<a href="setting/save/sk/<?=$r_bk['file_bk']?>" class="media-link" target="_blank">
							<div class="media-body">
								<i class="fa fa-download"></i>&nbsp;&nbsp;&nbsp;<span><b>Unduh</b> <?=ucwords($r_bk['judul_bk']);?></span>
								<p style="font-size:9px; margin-left:22px;">Post By : Adminitrator | <?=ucwords(tgl_indo($r_bk['tgl_post']));?></p>
							</div>
						</a>
					</li>
				<?php endwhile; ?>
				</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
<div class="col-sm-6 col-xs-6">
	<div class="row">
		<div class="col-sm-6">
			<!-- Thumbnail with feed -->
			<div class="panel">
				<a href="?page=daftar">
					<img src="assets/img/icon/pendaftaran.jpg" class="img-responsive" alt="">
				</a>

				<div class="panel-body">
					<div class="caption text-center">
					<h5 class="text-semibold no-margin">Pendaftaran KKN</h5>
					<p class="text-muted mb-15 mt-5">Silahkan lakukan Pendaftaran KKN disini !</p>

					<a href="?page=daftar" class="btn bg-indigo-400">Klik Disini&nbsp;&nbsp;&nbsp;<i style="margin-top:-4px;" class="fa fa-chevron-circle-right"></i></a>
				</div>
				</div>
			</div>
			<!-- /thumbnail with feed -->
		</div>
		<div class="col-sm-6">
		<!-- Thumbnail with feed -->
		<div class="panel">
			<a href="?page=peserta">
				<img src="assets/img/icon/mahasiswa.jpg" class="img-responsive" alt="">
			</a>

			<div class="panel-body">
				<div class="caption text-center">
				<h5 class="text-semibold no-margin">Peserta KKN</h5>
				<p class="text-muted mb-15 mt-5">Data Mahasiswa yang telah terdaftar sebagai Peserta KKN.</p>

				<a href="?page=peserta" class="btn bg-indigo-400">Klik Disini&nbsp;&nbsp;&nbsp;<i style="margin-top:-4px;" class="fa fa-chevron-circle-right"></i></a>
			</div>
			</div>
		</div>
		<!-- /thumbnail with feed -->
		</div>
	</div>
</div>

<div class="col-sm-6 col-xs-6">
	<div class="row">
		<div class="col-sm-6">
			<!-- Thumbnail with feed -->
			<div class="panel">
				<a href="?page=kelompok">
					<img src="assets/img/icon/kelompok.jpg" class="img-responsive" alt="">
				</a>

				<div class="panel-body">
					<div class="caption text-center">
					<h5 class="text-semibold no-margin">Kelompok KKN</h5>
					<p class="text-muted mb-15 mt-5">Informasi Kelompok KKN mengenai Mahasiswa, DPL, Lokasi, dll.</p>

					<a href="?page=kelompok" class="btn bg-indigo-400">Klik Disini&nbsp;&nbsp;&nbsp;<i style="margin-top:-4px;" class="fa fa-chevron-circle-right"></i></a>
				</div>
				</div>
			</div>
			<!-- /thumbnail with feed -->
		</div>
		<div class="col-sm-6">
			<!-- Thumbnail with feed -->
			<div class="panel">
				<a href="?page=dpl">
					<img src="assets/img/icon/pembimbing.jpg" class="img-responsive" alt="">
				</a>

				<div class="panel-body">
					<div class="caption text-center">
					<h5 class="text-semibold no-margin">Dosen Pendamping Lapangan</h5>
					<p class="text-muted mb-15 mt-5">Data Dosen Pendamping Lapangan (DPL).</p>

					<a href="?page=dpl" class="btn bg-indigo-400">Klik Disini&nbsp;&nbsp;&nbsp;<i style="margin-top:-4px;" class="fa fa-chevron-circle-right"></i></a>
				</div>
				</div>
			</div>
			<!-- /thumbnail with feed -->
		</div>
	</div>
</div>
</div>