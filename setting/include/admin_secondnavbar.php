	<!-- Second navbar -->
	<div class="navbar navbar-default" id="navbar-second">
		<div class="navbar-boxed">
			<ul class="nav navbar-nav no-border visible-xs-block">
				<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="fa fa-bars"></i></a></li>
			</ul>
			<div class="navbar-collapse collapse" id="navbar-second-toggle">
				<ul class="nav navbar-nav">
					<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=dashboard')){echo "active";}?>"><a href="?page=dashboard"><i class="fa fa-dashboard position-left"></i> Dashboard</a></li>
					
					<li class="dropdown <?php if (stripos($_SERVER['REQUEST_URI'], '?page=mahasiswa') || stripos($_SERVER['REQUEST_URI'], '?page=peserta') || stripos($_SERVER['REQUEST_URI'], '?page=kelompok')){echo "active";}?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-users position-left"></i> Mahasiswa <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu width-200">	
							<li><a href="?page=mahasiswa"><i class="fa fa-users"></i> Data Mahasiswa</a></li>
							<li><a href="?page=peserta"><i class="fa fa-users"></i> Data Peserta KKN</a></li>
							<li><a href="?page=kelompok"><i class="fa fa-users"></i> Data Kelompok KKN</a></li>
						</ul>
					</li>
					<li class="dropdown <?php if (stripos($_SERVER['REQUEST_URI'], '?page=dosen') || stripos($_SERVER['REQUEST_URI'], '?page=dpl')){echo "active";}?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-users position-left"></i> Dosen <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu width-200">	
							<li><a href="?page=dosen"><i class="fa fa-users"></i> Data Dosen</a></li>
							<li><a href="?page=dpl"><i class="fa fa-users"></i> Data DPL</a></li>
						</ul>
					</li>
					<li class="dropdown <?php if (stripos($_SERVER['REQUEST_URI'], '?page=lbmandiri') || stripos($_SERVER['REQUEST_URI'], '?page=lbkelompok')){echo "active";}?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-book position-left"></i> Logbook <i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu width-200">	
							<li><a href="?page=lbmandiri"><i class="fa fa-file-text"></i> Data Logbook Mandiri</a></li>
							<li><a href="?page=lbkelompok"><i class="fa fa-file-text"></i> Data Logbook Kelompok</a></li>
						</ul>
					</li>
					<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=lokasi')){echo "active";}?>"><a href="?page=lokasi"><i class="fa fa-map position-left"></i> Lokasi KKN</a></li>
					<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=galeri')){echo "active";}?>"><a href="?page=galeri"><i class="fa fa-picture-o position-left"></i> Galeri Foto</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=admin')){echo "active";}?>"><a href="?page=admin"><i class="fa fa fa-user-md position-left"></i> Administrator</a></li>
					<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=sk')){echo "active";}?>"><a href="?page=sk"><i class="fa fa-download position-left"></i> Berkas Unduhan</a></li>
					<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=pengaturan')){echo "active";}?>"><a href="?page=pengaturan&atur=<?=$r_atur['id_pengaturan']?>"><i class="fa fa fa-wrench position-left"></i> Pengaturan</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- /second navbar -->