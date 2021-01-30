<?php
	
	if(isset($_GET['album'])){
		$r_talbum = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_album WHERE id_album='$_GET[album]'"));
		
		$talbum   = $r_talbum['id_album']; 
		
		$q_tfoto  = mysqli_query($dbconnect,"SELECT * FROM tbl_foto WHERE id_album='$r_talbum[id_album]'");
		
		$r_tadmin     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_admin WHERE id_admin='$r_talbum[id_admin]'"));
						
		$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$r_talbum[id_kelompok]'"));
		
		if(empty($r_talbum['id_admin']) || !empty($r_talbum['id_kelompok'])){
			$tpostby = "<span style='font-size:10px; color:#444;'>Post By : Kelompok ".$r_tkelompok['nama_kelompok']."-".$r_tkelompok['tahun_kkn']."</span>";
		}
		elseif(empty($r_talbum['id_kelompok']) || !empty($r_talbum['id_admin'])){
			$tpostby = "<span style='font-size:10px; color:#444;'>Post By : Administrator</span>";
		}
		else{
			$tpostby = "<span style='font-size:10px; color:#444;'>-</span>";
		}
	}
	
?>
<div class="row">
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade <?=((isset($talbum))?'':'in active')?>" id="tab1">
			<div class="col-sm-12">
				<div class="row">
					<?php 
						$q_album     = mysqli_query($dbconnect,"SELECT * FROM tbl_album WHERE id_album AND status_album='sudah' ORDER BY tgl_post DESC");
						while($r_album = mysqli_fetch_array($q_album)){
						
						$r_admin     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_admin WHERE id_admin='$r_album[id_admin]'"));
						
						$r_kelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$r_album[id_kelompok]'"));

						if(empty($r_album['id_admin']) || !empty($r_album['id_kelompok'])){
							$postby = "<span style='font-size:9px; color:#444;'>Post By : Kelompok ".$r_kelompok['nama_kelompok']."-".$r_kelompok['tahun_kkn']."</span>";
						}
						elseif(empty($r_album['id_kelompok']) || !empty($r_album['id_admin'])){
							$postby = "<span style='font-size:9px; color:#444;'>Post By : Administrator</span>";
						}
						else{
							$postby = "<span style='font-size:9px; color:#444;'>-</span>";
						}
						
						$r_xfoto    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_foto WHERE id_album='$r_album[id_album]'"));
					?>
						<div class="col-lg-3">
							<div class="thumbnail">
								<div class="thumb">
									<img style="height:200px;" src="setting/save/galeri/<?=$r_xfoto['foto'];?>" alt="">
									<div class="caption-overflow">
										<span>
											<a href="?page=galeri&album=<?=$r_album['id_album']?>" class="btn btn-link btn-icon text-white"><i class="fa fa-search-plus fa-3x" style="font-size: 3em;"></i></a>
										</span>
									</div>
								</div>
								<div class="caption">
								<div class="row">
									<div class="col-lg-12">
										<h6 class="no-margin-top">
											<a href="?page=galeri&album=<?=$r_album['id_album']?>" style="font-size:12px;"><?=strtoupper(substr($r_album['judul_album'],0,70))?>...</a>
										</h6>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12">
										<?=strtoupper($postby);?> | <span style="font-size:9px;"> <?=strtoupper(tgl_indo($r_album['tgl_post']))?></span>
									</div>
								</div>
								</div>
							</div>																									
						</div>	
					<?php } ?>	
				</div>		
			</div>
		</div>
		<div class="tab-pane fade <?=((isset($talbum))?'in active':'')?>" id="tab2">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-12">
						<div class="pull-left">
							<span style="font-size:16px;" class="text-semibold"><?=strtoupper($r_talbum['judul_album'])?></span>
						</div>
						<div class="pull-right">
							<?=strtoupper($tpostby);?> | <span style="font-size:10px;"> <?=strtoupper(tgl_indo($r_talbum['tgl_post']))?></span>
							<br>
							<br>
						</div>
					</div>
					<div class="baguetteBox">
						<?php while($r_tfoto = mysqli_fetch_array($q_tfoto)):?>
							<div class="col-lg-3">
								<div class="thumbnail">
									<div class="thumb">
										<img style="height:200px;" src="setting/save/galeri/<?=$r_tfoto['foto'];?>" alt="">
										<div class="caption-overflow">
											<span>
												<a href="setting/save/galeri/<?=$r_tfoto['foto'];?>" class="lightbox btn btn-link btn-icon text-white"><i class="fa fa-search-plus fa-3x" style="font-size: 3em;"></i></a>
											</span>
										</div>
									</div>
								</div>																								
							</div>
						<?php endwhile; ?>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>