<?php

	if(isset($_GET['album'])){
	
		$album    = $_GET['album'];
		$r_talbum = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_album WHERE id_album='$album'"));
		
		$q_tfoto   = mysqli_query($dbconnect,"SELECT * FROM tbl_foto WHERE id_album='$r_talbum[id_album]'");
	
		$gstatus   = $r_talbum['status_album'];
	}
	
?>
<!-- Toolbar -->
<div class="navbar navbar-default navbar-component navbar-xs">
	<ul class="nav navbar-nav visible-xs-block">
		<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="fa fa-bars"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-filter">
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li class="<?=((isset($album))?'hide':'active')?>"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-table"></i> Tampil Album</a></li>
				<li class="<?=((isset($album))?'hide':'')?>"><a href="#album" data-toggle="modal"><i class="fa fa-plus-square"></i> Tambah Album</a></li>
				<li class="<?=((isset($album))?'':'hide')?>"><a href="?page=galeri"><i class="fa fa-caret-square-o-left"></i> Kembali</a></li>
				<li class="<?=((isset($album))?'active':'hide')?>"><a href="#"><i class="fa fa-table"></i> Tampil Album Foto</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade <?=((isset($album))?'':'in active')?>" id="tab1">
		<div class="panel panel-white">
			<div class="panel-heading">
			<h6 class="panel-title">Album Foto <b>Kelompok <?=$r_xkelompok['nama_kelompok']?></b></h6>
			</div>
			<div class="panel-body">
				<div class="row">
				<?php 
					$q_album     = mysqli_query($dbconnect,"SELECT * FROM tbl_album WHERE id_kelompok='$r_xkelompok[id_kelompok]'");
					while($r_album = mysqli_fetch_array($q_album)){
					
					$r_admin     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_admin WHERE id_admin='$r_album[id_admin]'"));
					
					$r_kelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$r_album[id_kelompok]'"));

					if(empty($r_album['id_admin']) || !empty($r_album['id_kelompok'])){
						$postby = "Kelompok ".$r_kelompok['nama_kelompok'];
					}elseif(empty($r_album['id_kelompok']) || !empty($r_album['id_admin'])){
						$postby = "Administrator";
					}else{
						$postby = "-";
					}
					
					$status = $r_album['status_album'];
					
					if($status == "sudah"){
						$salbum = "<span style='font-size:10px; color:#00b386;'>Sudah Di Posting</span>";
						$col    = "12";
					}elseif($status == "belum"){
						$salbum = "<span style='font-size:10px; color:#ffc926;'>Belum Di Posting</span>";
						$col    = "8";
					}else{
						$salbum = "<span style='font-size:10px; color:#f44336;'>Tidak Di Posting</span>";
						$col    = "8";
					}
					
					$r_xfoto    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_foto WHERE id_album='$r_album[id_album]'"));
				?>
					<div class="col-lg-3">
						<div class="thumbnail">
							<div class="thumb">
								<img style="height:200px;" src="../../setting/save/galeri/<?=$r_xfoto['foto'];?>" alt="">
								<div class="caption-overflow">
									<span>
										<a href="?page=galeri&album=<?=$r_album['id_album']?>" class="btn btn-link btn-icon text-white"><i class="fa fa-search-plus fa-3x"></i></a>
									</span>
								</div>
							</div>

							<div class="caption">
							<div class="row">
								<div class="col-lg-<?=$col;?>">
									<h6 class="no-margin-top">
										<a href="?page=galeri&album=<?=$r_album['id_album']?>" style="font-size:12px;"><?=strtoupper($r_album['judul_album'])?></a>
									</h6>
								</div>
								<?php if($status == "belum" || $status == "tidak"){?>
									<div class="col-lg-4">
										<div class="pull-right">
											<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" href='#ubah_album' id='custId' data-toggle='modal' data-id="<?php echo $r_album['id_album']; ?>" type="button" class="label label-primary"><i class="fa fa-edit"></i></a>
														
											<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" onclick='datadel(<?php echo $r_album['id_album']; ?>,&#39;album&#39;)'  data-title='Delete' data-toggle='modal' data-target='#myModal' type="button" class="label label-danger"><i class="fa fa-trash"></i></button>
										</div>	
									</div>	
								<?php }elseif($status == "sudah"){echo "";} ?>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="">
										<span style="font-size:11px;"> <?=tgl_indo($r_album['tgl_post'])?></span>
									</div>	
								</div>
								<div class="col-lg-6">
									<div class="pull-right"><b><?=strtoupper($salbum);?></b></div>
								</div>
							</div>
							<?=substr(ucwords($r_album['ket_album']),0,30);?>...
							</div>
						</div>																									
					</div>	
				<?php } ?>	
				</div>	
			</div>	
		</div>
		</div>
		<div class="tab-pane fade <?=((isset($album))?'in active':'')?>" id="tab2">
		<div class="panel panel-white">
			<div class="panel-heading">
			<h6 class="panel-title capitalize">Album Foto <b>" <?=strtoupper($r_talbum['judul_album'])?> "</b></h6>
			</div>
			<div class="panel-body">	
				<form class="form-horizontal" method="post" enctype="multipart/form-data">
					<?php if($gstatus == "belum" || $gstatus == "tidak"){ ?>
						<div class="form-group row">
							<div class="col-lg-12">		
								<label>Unggah Foto</label>
								<div class="input-group">
									<span class="input-group-btn">
									<div class="btn-group" role="group" aria-label="...">
										<span class="btn btn-default btn-sm btn-file">
											<i class="fa fa-folder-open"></i> Ambil Foto<input type="file" id="file-input"  name="foto[]"  multiple="multiple" accept="image/*"/>
										</span>
									</div>	
									</span>
									<input type="text" multiple="multiple" class="form-control input-sm" readonly>
								</div>
							</div>
						</div>
					<?php }elseif($gstatus == "sudah"){echo "";} ?>	
					<div class="form-group row">
						<div id="thumb-output"></div>
						<?php while($r_tfoto = mysqli_fetch_array($q_tfoto)):?>
						<div class="col-sm-3">
							<a target="_blank" href="../../setting/save/galeri/<?=$r_tfoto['foto'];?>"><img src="../../setting/save/galeri/<?=$r_tfoto['foto'];?>" class="galerry2" /></a>
							<?php if($gstatus == "belum" || $gstatus == "tidak"){ ?>
								<button type="button" class="label label-danger btn-del-img" onclick="datadele(<?=$r_tfoto['id_foto'];?>,&#39;foto&#39;,<?=$album;?>)" data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" data-toggle='modal' data-target='#myModal2'><i class="fa fa-trash"></i></button>
							<?php }elseif($gstatus == "sudah"){echo "";} ?>	
						</div>
						<?php endwhile; ?>
					</div>
					<?php if($gstatus == "belum" || $gstatus == "tidak"){ ?>
					<hr>
					<div class="form-group row">
						<div class="col-lg-12">
							<a href="?page=galeri" type="button" class="btn btn-danger btn-sm"  name="sub" >Batal Simpan</a>
							<input type="submit" class="btn btn-primary btn-sm" value="Simpan Data" name="save_photo" />
						</div>
					</div>
					<?php }elseif($gstatus == "sudah"){echo "";} ?>	
				</form>	
			</div>			
		</div>
		</div>

	</div>
	</div>
</div>