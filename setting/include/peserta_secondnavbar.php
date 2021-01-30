<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
	<div class="navbar-boxed">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="fa fa-bars"></i></a></li>
		</ul>
		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav">

				<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=dashboard')){echo "active";}?>"><a href="?page=dashboard"><i class="fa fa-dashboard position-left"></i> Dashboard</a></li>
				
				<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=kelompok')){echo "active";}?>"><a href="?page=kelompok-peserta&kelompok=<?=$r_hpeserta['id_kelompok']?>"><i class="fa fa-users position-left"></i> Kelompok</a></li>
				
				<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=lbmandiri')){echo "active";}?>"><a href="?page=lbmandiri"><i class="fa fa-file-text position-left"></i> Logbook Mandiri</a></li>
				
				<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=lbkelompok')){echo "active";}?>"><a href="?page=lbkelompok"><i class="fa fa-file-text position-left"></i> Logbook Kelompok</a></li>
				
				<?php if($status_peserta == "ketua"){ ?>
					<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=galeri')){echo "active";}?>"><a href="?page=galeri"><i class="fa fa-picture-o position-left"></i> Galeri Foto</a></li>
				<?php }elseif($status_peserta == "anggota"){ echo ""; }else{ echo ""; } ?>
				
			</ul>	
		</div>
	</div>
</div>
<!-- /second navbar -->