	<!-- Main navbar -->
	<div class="navbar navbar-inverse">
	<div class="navbar-boxed">
		<div class="navbar-header">
			<a class="navbar-brand" href="?page=beranda" style="margin-top:-7px;"><span style="font-size:15px;"><span class="text-thin">Sistem Informasi</span> <b>KKN</b></span><p style="font-size:10px; margin-top:-7px;">#UNDANA KUPANG</p> </a>
			<ul class="nav navbar-nav pull-right visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile" class="collapsed" aria-expanded="false"><i class="fa fa-bars"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile" aria-expanded="false" style="height: 1px;">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown active">
						<li>
							<a href="?page=beranda">
								<i class="fa fa-home"></i><span class="position-right"> Beranda</span>
							</a>
						</li>
						<li class="dropdown <?php if (stripos($_SERVER['REQUEST_URI'], '?page=profil')){echo "active";}?>">
							<a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bullhorn"></i><span class="position-right"> Info KKN</span> <i class="fa fa-angle-down"></i></a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="?page=dpl"><i class="fa fa-users"></i> DPL KKN</a></li>
								<li><a href="?page=peserta"><i class="fa fa-users"></i> Peserta KKN</a></li>
								<li><a href="?page=kelompok"><i class="fa fa-users"></i> Kelompok KKN</a></li>
							</ul>
						</li>
						<!--<li>
							<a href="?page=lokasi">
								<i class="fa fa-map-marker"></i><span class="position-right"> Lokasi KKN</span>
							</a>
						</li>-->
						<li>
							<a href="?page=galeri">
								<i class="fa fa-picture-o"></i><span class="position-right"> Galeri Foto</span>
							</a>
						</li>
						<li>
							<a href="#exampleModalLong" data-toggle="modal">
								<i class="fa fa-file-text"></i><span class="position-right"> Syarat & Ketentuan</span>
							</a>
						</li>
						<li>
							<a href="#login" data-toggle="modal">
								<i class="fa fa-lock"></i><span class="position-right"> Login</span>
							</a>
						</li>
				</li>
			</ul>
		</div>
	</div>
	</div>
	<!-- /main navbar -->
