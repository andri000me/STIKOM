<?php

	if(isset($_GET['album'])){
	
		$album    = $_GET['album'];
		$r_talbum = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_album WHERE id_album='$album'"));
	
		$xstatus  = $r_talbum['status_album'];

		if($xstatus == "sudah"){$tampil = "hide";}elseif($xstatus == "tidak" || $xstatus == "belum"){$tampil = "";}else{$tampil = "";}
		
		$q_tfoto  = mysqli_query($dbconnect,"SELECT * FROM tbl_foto WHERE id_album='$r_talbum[id_album]'");
	
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
				<li class="<?=((isset($album))?'':'hide')?>"><a href="?page=galeri"><i class="fa fa-chevron-circle-left"></i> Kembali</a></li>
				<li class="<?=((isset($album))?'active':'hide')?>"><a href="#"><i class="fa fa-table"></i> Tampil Foto</a></li>
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
			<h6 class="panel-title">Album Foto</h6>
			</div>
			<div class="panel-body">
							<div class="table-info">
								<table class="table table-striped table-bordered table-hover datatable-show-all">
									<thead>
										<tr>
											<th>#</th>
											<th>Judul Album</th>
											<th>Keterangan Album</th>
											<th>Tanggal Post</th>
											<th>Post By</th>
											<th align="center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										
										<?php 
											$no=0;
											
											$q_album     = mysqli_query($dbconnect,"SELECT * FROM tbl_album WHERE id_album");
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
											
											$dstatus	= $r_album['status_album'];
											
											if($dstatus == "sudah"){
												$tampil = "<i data-placement='left'  data-popup='tooltip' title='' data-original-title='Sudah Dipost' style='cursor:pointer; color:#00b386; margin-top:-4.5px;' class='fa fa-circle'></i>";
											}elseif($dstatus == "belum"){
												$tampil = "<i data-placement='left'  data-popup='tooltip' title='' data-original-title='Belum Dipost' style='cursor:pointer; color:#ffc926; margin-top:-4.5px;' class='fa fa-circle'></i>";
											}elseif($dstatus == "tidak"){
												$tampil = "<i data-placement='left'  data-popup='tooltip' title='' data-original-title='Tidak Dipost' style='cursor:pointer; color:#f44336; margin-top:-4.5px;' class='fa fa-circle'></i>";
											}
											
												
											$no++;
										?>
										<tr>
											<td><?=$no;?></td>
											<td><?=ucwords($r_album['judul_album'])?></td>
											<td><?=ucwords($r_album['ket_album'])?></td>
											<td><?=$tampil." ".tgl_indo($r_album['tgl_post'])?></td>
											<td><?=ucwords($postby);?></td>
											<td width="20" align="center">	
											<?php if(empty($r_album['id_admin']) || !empty($r_album['id_kelompok'])){ ?>
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Cek Album" href="?page=galeri&album=<?=$r_album['id_album']?>" type="button" class="label label-warning"><i class="fa fa-check-square-o"></i></a>
											<?php }elseif(empty($r_album['id_kelompok']) || !empty($r_album['id_admin'])){ ?>	
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Lihat" href="?page=galeri&album=<?=$r_album['id_album']?>" type="button" class="label label-success"><i class="fa fa-search-plus"></i></a>
											<?php } ?>	
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" href='#ubah_album' id='custId' data-toggle='modal' data-id="<?php echo $r_album['id_album']; ?>" type="button" class="label label-primary"><i class="fa fa-edit"></i></a>
												
												<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" onclick='datadel(<?php echo $r_album['id_album']; ?>,&#39;album&#39;)'  data-title='Delete' data-toggle='modal' data-target='#myModal' type="button" class="label label-danger"><i class="fa fa-trash"></i></button>
											
											</td>
										</tr>
										<?php  
											}
											
										?>	
										
									</tbody>
								</table>
					
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
					<?php if(empty($r_talbum['id_kelompok']) || !empty($r_talbum['id_admin'])){ ?>
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
					<?php }elseif(empty($r_talbum['id_admin']) || !empty($r_talbum['id_kelompok'])){ echo"";} ?>
					<div class="form-group row">
						<div id="thumb-output"></div>
						<?php while($r_tfoto = mysqli_fetch_array($q_tfoto)):?>
						<div class="col-sm-3">
							<a target="_blank" href="../../setting/save/galeri/<?=$r_tfoto['foto'];?>"><img src="../../setting/save/galeri/<?=$r_tfoto['foto'];?>" class="galerry2" /></a>
							<button type="button" class="label label-danger btn-del-img" onclick="datadele(<?=$r_tfoto['id_foto'];?>,&#39;foto&#39;,<?=$album;?>)" data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" data-toggle='modal' data-target='#myModal2'><i class="fa fa-trash"></i></button>
						</div>
						<?php endwhile; ?>
					</div>
					<div class="<?=$tampil;?>">
						<hr>
						<div class="form-group row">
							<div class="col-lg-12">
								<?php if(empty($r_talbum['id_kelompok']) || !empty($r_talbum['id_admin'])){ ?>
									<a href="?page=galeri" type="button" class="btn btn-danger btn-sm"  name="sub" >Batal Simpan</a>
									<input type="submit" class="btn btn-primary btn-sm" value="Simpan Data" name="save_photo" />
								<?php }elseif(empty($r_talbum['id_admin']) || !empty($r_talbum['id_kelompok'])){ ?>
									<a href="?page=galeri&aksi_astatus=ubah_astatus&album=<?=$r_talbum['id_album']?>&status=tidak" class="btn btn-danger btn-sm"><i style="margin-top:-4px;" class="fa fa-close"></i> Tidak Dipost</a>
									<a href="?page=galeri&aksi_astatus=ubah_astatus&album=<?=$r_talbum['id_album']?>&status=sudah" class="btn btn-success btn-sm"><i style="margin-top:-4px;" class="fa fa-check"></i> Dipost</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</form>	
			</div>			
		</div>
		</div>

	</div>
	</div>
</div>