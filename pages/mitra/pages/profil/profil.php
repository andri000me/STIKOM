<?php

	//$q_prodi = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi");
	
	$t = date('Y');
	$a = $t-10;
	$j = $t+1;
	
	if(isset($_GET['profil'])){
		
		$profil     = $_GET['profil']; 		
		$q_umitra   = mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_mitra='$profil'");
		$r_umitra   = mysqli_fetch_array($q_umitra);
		
	}

?>
<!-- Toolbar 
<div class="navbar navbar-default navbar-component navbar-xs">
	<ul class="nav navbar-nav visible-xs-block">
		<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="fa fa-bars"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-filter">
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li class="<?=((isset($profil))?'active':'')?>"><a href="#tab2" data-toggle="tab" aria-expanded="true"><?=((isset($profil))?'<i class="fa fa-edit"></i> Data Profi '.ucwords($namadepan).'':'<i class="fa fa-plus-square"></i> Tambah Data mitra')?></a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade <?=((isset($profil))?'in active':'')?>" id="tab2">
					
						<div class="row">
							<div class="col-sm-3">
							<div class="row">
							<div class="col-sm-12">
								<form class="photo-form" method="POST" enctype="multipart/form-data">
							<!-- User thumbnail -->
								<div class="thumbnail">
									<div class="thumb thumb-rounded thumb-slide" >
										<img src="../../setting/save/mitra/<?=((isset($profil))?cek_foto($r_umitra['foto_mitra']):'default.png')?>" class="picture-pass" id='img-upload'/>
									</div>
								
									<div class="caption text-center">
										<div class="form-group row">
										<?php 
											if(empty($r_umitra['foto_mitra'])){
										?>
											<input type="hidden" name="id_mitra" value="<?=$r_umitra['id_mitra'];?>">
											<div class="col-md-12 validation">
											<label class="control-label">Unggah Foto</label>
												<div class="input-group">
													<span class="input-group-btn">
														<span class="btn btn-default btn-sm btn-file">
															<i class="fa fa-folder-open"></i> Ambil<input type="file" name="savefotomitra" id="imgInp" accept="image/*" />
														</span>
													</span>
													<input type="text" name="foto_mitra" class="form-control input-sm" readonly required="required" />
													<span class="input-group-btn">
													<input type="submit" class="btn btn-default btn-sm" value="Simpan Foto" name="simpan_fotomitra" />
													</span>
												</div>
											<div class="text-left" style="margin-top:5px; font-size:10px; color:#d93600">*Foto yang sudah dimasukan tidak dapat diubah</div>
											</div>
										<?php }elseif(!empty($r_umitra['foto_mitra'])){?>
											<div class="col-md-12">
												<div class="content-divider text-muted form-group"><span>Mitra Lapangan</span></span></div>
												<h6 class="text-semibold no-margin" style="font-size:13px;"><?=strtoupper(cek_jk($r_umitra['jk_mitra'])." ".$r_umitra['nama_mitra'])?> <small class="display-block">NIP. <?=(($r_umitra['nip'] == 0 || $r_umitra['nip'] == "-")?'-':$r_umitra['nip'])?></small></h6>
											</div>
										<?php } ?>	
										</div>
									</div>
								</div>
								</form>
							</div>
							<!--<div class="col-sm-12">
								<div class="panel panel-white">
								<div class="panel-heading">
									<h6 class="panel-title">Paraf <b><?=$namadepan?></b></h6>
								</div>
								<?php if(empty($r_udpl['paraf_dpl'])){ ?>
									<a href="#paraf" data-toggle='modal'><img style="width:100%; height:180px;" src="../../setting/save/tdt/default.png" class="picture-pass"/></a>
								<?php }else{?>	
									<img style="width:100%; height:180px;" src="<?=$r_udpl['paraf_dpl'];?>" class="picture-pass"/>
								<?php }?>	
								</div>
							</div>-->
							</div>
							</div>
							<div class="col-sm-9">
							<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-heading">
										<h6 class="panel-title">Biodata <b><?=strtoupper(cek_jk($jk_mitra)." ".$namadepan);?></b></h6>
									</div>
									<div class="table-responsive">
											<table class="table table-noborder table-striped">
												<tr>
													<th width="100">NIP</th>
													<th><center>:</center></th>
													<td><?=(($r_umitra['nip'] == 0 || $r_umitra['nip'] == "-")?'-':$r_umitra['nip'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Nama Lengkap Mitra</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_umitra['nama_mitra'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Jenis Kelamin</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_umitra['jk_mitra'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Agama</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_umitra['agama_mitra'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>No. Tlp/Hp Mitra</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_umitra['no_tlp_mitra'])?></td>
													<td colspan="4"></td>
												</tr>
											</table>		
											</div>	
												
								</div>					
							</div>
							<div class="col-md-12">
								<form class="akun-form" method="POST" enctype="multipart/form-data">
								<?php if(isset($profil)):?>
									<input type="hidden" name="id_mitra" value="<?=$r_umitra['id_mitra'];?>">
								<?php endif; ?>	
								<div class="panel panel-white">
									<div class="panel-heading">
									<h6 class="panel-title">Akun <b><?php echo strtoupper(cek_jk($jk_mitra)." ".$namadepan);?></b></h6>
									</div>
									<div class="panel-body">
									<div class="row">
									<div class="col-md-12">
									<div class="row">
									<div class="col-md-12">	
										<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Username</label>
												<input disabled type="text" value="<?=((isset($profil))?$r_umitra['username']:'');?>" class="form-control input-sm">
											</div>
											<div class="col-md-6">
												<label class="control-label">Old Password</label>
												<input disabled type="text" value="<?=((isset($profil))?$r_umitra['confirm_password']:'');?>" class="form-control input-sm">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-6 validation">
												<label class="control-label">Password</label>
												<input type="password" name="new_password" id="new_password" required placeholder="Masukan Kata Sandi"  class="form-control input-sm">
											</div>
											<div class="col-md-6 validation">
												<label class="control-label">Confirm Password </label>
												<input type="password" name="new_confirm_password" required placeholder="Masukan Ulang Kata Sandi"  class="form-control input-sm">
											</div>
										</div>
									</div>
									</div>
									</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<a href="?page=admin" class="btn btn-danger btn-sm">Batal Simpan</a>
											<button type="submit" name="ubah_profil_akun" class="btn btn-sm btn-primary">Simpan Data</button>
										</div>
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
		</div>
	</div>