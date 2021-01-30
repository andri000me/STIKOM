<?php
	if(isset($_GET['ubah_bk'])){
		$ubah_bk = $_GET['ubah_bk'];
		
		$q_usk	 = mysqli_query($dbconnect,"SELECT * FROM tbl_bk WHERE id_bk='$ubah_bk'");
		$r_usk	 = mysqli_fetch_array($q_usk);
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
				<li class="<?=((isset($ubah_bk))?'hide':'active')?>"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-table"></i> Tampil Data Berkas KKN</a></li>
				<li class="<?=((isset($ubah_bk))?'':'hide')?>"><a href="?page=sk"><i class="fa fa-chevron-circle-left"></i> Kembali</a></li>
				<li class="<?=((isset($ubah_bk))?'active':'')?>"><a href="#tab2" data-toggle="tab" aria-expanded="true"><?=((isset($ubah_bk))?'<i class="fa fa-edit"></i> Ubah Berkas KKN':'<i class="fa fa-plus-square"></i> Tambah Berkas KKN')?></a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade <?=((isset($ubah_bk))?'hide':'in active')?>" id="tab1">
						<div class="panel panel-white">
							<div class="panel-heading">
							<h6 class="panel-title">Data Berkas KKN</h6>
							</div>
							<div class="panel-body">
							<div class="table-info">
								<table class="table table-striped table-bordered table-hover datatable-show-all">
									<thead>
										<tr>
											<th>#</th>
											<th>Judul Berkas KKN</th>
											<th>Tanggal Post</th>
											<th>File Berkas KKN</th>
											<th align="center">Aksi</th>
										</tr>
									</thead>
									
									<tbody>
									<?php
										$no=0;
										$q_bk = mysqli_query($dbconnect,"SELECT * FROM tbl_bk WHERE id_bk");
										while($r_bk = mysqli_fetch_array($q_bk)){
										
										$no++;										
									?>
										<tr>
											<td width="10"><?=$no;?></td>
											<td><?=ucwords($r_bk['judul_bk'])?></td>
											<td><?=ucwords(tgl_indo($r_bk['tgl_post']))?></td>
											<td><a target="_blank" href="../../setting/save/sk/<?=$r_bk['file_bk']?>"><?=$r_bk['file_bk']?></a></td>
											<td width="15" class="center">
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" href="?page=sk&ubah_bk=<?=$r_bk['id_bk']?>" type="button" class="label label-primary"><i class="fa fa-edit"></i></a>

												<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" onclick='datadel(<?php echo $r_bk['id_bk']; ?>,&#39;sk&#39;)'  data-title='Delete' data-toggle='modal' data-target='#myModal' type="button" class="label label-danger"><i class="fa fa-trash"></i></button>
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
					<div class="tab-pane fade <?=((isset($ubah_bk))?'in active':'')?>" id="tab2">
					<form class="sk-form" method="POST" enctype="multipart/form-data">	
					<?php if(isset($ubah_bk)):?>
						<input type="hidden" name="id_bk" value="<?=$r_usk['id_bk'];?>">
					<?php endif; ?>	
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-heading">
									<h6 class="panel-title">Form Berkas KKN</h6>
									</div>
									<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group row">
												<div class="col-md-8 validation">
												<label class="control-label">Judul Berkas KKN</label>
												<input type="text" class="form-control input-sm capitalize" name="judul_bk" value="<?=((isset($ubah_bk))?$r_usk['judul_bk']:'')?>" placeholder="Masukan Judul Berkas KKN" required="required" />
												</div>
												<div class="col-md-4 validation">
												<label class="control-label">Unggah File</label>
													<div class="input-group">
													<span class="input-group-btn">
														<span class="btn btn-default btn-sm btn-file">
															<i class="fa fa-folder-open"></i> Ambil<input type="file" name="savefilebk" id="imgInp" accept=".pdf" />
														</span>
													</span>
													<input type="text" value="<?=((isset($ubah_bk))?$r_usk['file_bk']:'')?>" name="file_bk" required="required" class="form-control input-sm" readonly>
												</div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-md-12">
													<embed src="../../setting/save/sk/<?=((isset($ubah_bk))?cek_file($r_usk['file_bk']):'default.pdf')?>" style="width:100%;height:500px; border:1px solid #eee;" id="img-upload"  type="application/pdf"></embed>
												</div>
											</div>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<a href="?page=sk" class="btn btn-danger btn-sm">Batal Simpan</a>
											<button type="submit" name="simpan_bk" class="btn btn-sm btn-primary">Simpan Data</button>
										</div>
									</div>
									</div>			
								</div>					
							</div>
						</div>
					</form>
					</div>
												

			</div>	
		</div>
	</div>