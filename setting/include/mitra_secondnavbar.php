<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
	<div class="navbar-boxed">
		<ul class="nav navbar-nav no-border visible-xs-block">
			<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="fa fa-bars"></i></a></li>
		</ul>
		<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav">
				<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=dashboard')){echo "active";}?>"><a href="?page=dashboard"><i class="fa fa-dashboard position-left"></i> Dashboard</a></li>
				<li class="<?php if (stripos($_SERVER['REQUEST_URI'], '?page=kelompok-mitra')){echo "active";}?>"><a href="?page=kelompok-mitra&kelompok=<?=$r_xkelompok['id_kelompok']?>"><i class="fa fa-users position-left"></i> Kelompok</a></li>
			</ul>	
		</div>
	</div>
</div>
<!-- /second navbar -->