<?php

	//$q_prodi = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi");
	
	$t = date('Y');
	$a = $t-10;
	$j = $t+1;
	
	if(isset($_GET['profil'])){
		
		$profil = $_GET['profil']; 
		$r_udpl	   	= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dpl='$profil'"));
		
		$q_udosen   = mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_udpl[id_dosen]'");
		$r_udosen   = mysqli_fetch_array($q_udosen);
		
		$tgl_lahir  = $r_udosen['tgl_lahir'];		
		$lahir  	= explode("-",$tgl_lahir);
		
		$tgl        = $lahir[2];	
		$bln        = $lahir[1];	
		$thn        = $lahir[0];	
		
		
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
				<li class="<?=((isset($profil))?'active':'')?>"><a href="#tab2" data-toggle="tab" aria-expanded="true"><?=((isset($profil))?'<i class="fa fa-edit"></i> Data Profi '.ucwords($namadepan).'':'<i class="fa fa-plus-square"></i> Tambah Data Dosen')?></a></li>
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
							<!-- User thumbnail -->
								<div class="thumbnail">
									<div class="thumb thumb-rounded thumb-slide" >
										<img src="../../setting/save/dosen/<?=((isset($profil))?cek_foto($r_udosen['foto_dosen']):'default.png')?>" class="picture-pass" id='img-upload'/>
									</div>
								
									<div class="caption text-center">
										<div class="form-group row">
											<div class="col-md-12">
											<div class="content-divider text-muted form-group"><span>Dosen Pembimbing Lapangan</span></span></div>
											<h6 class="text-semibold no-margin" style="font-size:13px;"><?=strtoupper(cek_jk($r_udosen['jk_dosen'])." ".$r_udosen['nama_dosen'])?> <small class="display-block">NIDN. <?=ucwords($r_udosen['nidn'])?></small></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
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
							</div>
							</div>
							</div>
							<div class="col-sm-9">
							<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
									<div class="panel-heading">
										<h6 class="panel-title">Biodata <b><?=strtoupper(cek_jk($jk_dpl)." ".$namadepan);?></b></h6>
									</div>
									<div class="table-responsive">
											<table class="table table-noborder table-striped">
												<tr>
													<th>NIDN</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_udosen['nidn'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Nama Lengkap Dosen</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_udosen['nama_dosen'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Jenis Kelamin</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_udosen['jk_dosen'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Agama</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_udosen['agama_dosen'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Tempat Lahir</th>
													<th><center>:</center></th>
													<td style="border-right:1px solid #ddd;"><?=strtoupper($r_udosen['tempat_lahir'])?></td>
													<th>Tanggal Lahir</th>
													<th><center>:</center></th>
													<td><?=strtoupper(tgl_indo($r_udosen['tgl_lahir']))?></td>
												</tr>
												<tr>
													<th>Tahun KKN</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_udpl['tahun_kkn'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>No. Tlp/Hp Dosen</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_udosen['no_tlp_dosen'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Email Dosen</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_udosen['email_dosen'])?></td>
													<td colspan="4"></td>
												</tr>
											</table>		
											</div>	
												
								</div>					
							</div>
							<div class="col-md-12">
								<form class="akun-form" method="POST" enctype="multipart/form-data">
						<?php if(isset($profil)):?>
							<input type="hidden" name="id_dpl" value="<?=$r_udpl['id_dpl'];?>">
						<?php endif; ?>	
								<div class="panel panel-white">
									<div class="panel-heading">
									<h6 class="panel-title">Akun <b><?php echo strtoupper(cek_jk($jk_dpl)." ".$namadepan);?></b></h6>
									</div>
									<div class="panel-body">
									<div class="row">
									<div class="col-md-12">
									<div class="row">
									<div class="col-md-12">	
										<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Username</label>
												<input disabled type="text" value="<?=((isset($profil))?$r_udosen['nidn']:'');?>" class="form-control input-sm">
											</div>
											<div class="col-md-6">
												<label class="control-label">Old Password</label>
												<input disabled type="text" value="<?=((isset($profil))?$r_udpl['confirm_password']:'');?>" class="form-control input-sm">
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