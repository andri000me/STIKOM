<?php

	if(isset($_GET['profil'])){
		$profil         = $_GET['profil'];
		$r_cprofil      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$profil'"));
		
		$status_peserta = $r_cprofil['status_peserta'];
		
		$r_cmahasiswa   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_cprofil[id_mahasiswa]'"));
		
		$r_cprodi       = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_cmahasiswa[id_prodi]'"));
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
				<li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-check-square-o"></i> Profi Peserta <b>KKN</b></a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade in active" id="tab2">
						<div class="row">
							<div class="col-sm-3">
							<div class="row">
							<div class="col-sm-12">
							<!-- User thumbnail -->
								<div class="thumbnail">
									<div class="thumb thumb-rounded thumb-slide" >
										<img src="../../setting/save/mahasiswa/<?=((isset($cek_berkas))?cek_foto($r_cmahasiswa['foto_mahasiswa']):'default.png')?>" class="picture-pass" id='img-upload'/>
									</div>
								
									<div class="caption text-center">
										<div class="form-group row">
											<div class="col-md-12">
											<div class="content-divider text-muted form-group"><span>Peserta KKN</span></span></div>
											<h6 class="text-semibold no-margin" style="font-size:13px;"><?=strtoupper($r_cmahasiswa['nama_mahasiswa'])?> <small class="display-block">NIM. <?=ucwords($r_cmahasiswa['nim'])?></small></h6>
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
								<?php if(empty($r_cprofil['paraf_peserta'])){ ?>
									<a href="#paraf" data-toggle='modal'><img style="width:100%; height:180px;" src="../../setting/save/tdt/default.png" class="picture-pass"/></a>
								<?php }else{?>	
									<img style="width:100%; height:180px;" src="<?=$r_cprofil['paraf_peserta'];?>" class="picture-pass"/>
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
												<h6 class="panel-title">Biodata <b><?=$namadepan?></b></h6>
											</div>
											<div class="table-responsive">
											<table class="table table-noborder table-striped">
												<tr>
													<th>NIM</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_cmahasiswa['nim'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Nama Lengkap Peserta</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_cmahasiswa['nama_mahasiswa'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Jenis Kelamin</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_cmahasiswa['jk_mahasiswa'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Agama</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_cmahasiswa['agama_mahasiswa'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Tempat Lahir</th>
													<th><center>:</center></th>
													<td style="border-right:1px solid #ddd;"><?=strtoupper($r_cmahasiswa['tempat_lahir'])?></td>
													<th>Tanggal Lahir</th>
													<th><center>:</center></th>
													<td><?=strtoupper(tgl_indo($r_cmahasiswa['tgl_lahir']))?></td>
												</tr>
												<tr>
													<th>Program Studi</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_cprodi['nama_prodi'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Tahun Angkatan</th>
													<th><center>:</center></th>
													<td style="border-right:1px solid #ddd;"><?=strtoupper($r_cmahasiswa['tahun_angkatan'])?></td>
													<th>Tahun KKN</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_cprofil['tahun_kkn'])?></td>
												</tr>
												<tr>
													<th>No. Tlp/Hp Peserta</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_cmahasiswa['no_tlp_mahasiswa'])?></td>
													<td colspan="4"></td>
												</tr>
												<tr>
													<th>Email Peserta</th>
													<th><center>:</center></th>
													<td><?=strtoupper($r_cmahasiswa['email_mahasiswa'])?></td>
													<td colspan="4"></td>
												</tr>
											</table>		
											</div>	
											<!--<div class="panel-heading">
												<h6 class="panel-title">Berkas Persyaratan Peserta <b>KKN</b></h6>
												<div class="heading-elements">
													<ul class="list-inline heading-text">
														<li><a href="?page=cekberkas&berkas=<?=$r_cprofil['id_peserta'];?>" class="download_berkas"><i class="fa fa-print"></i> Unduh Berkas</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body">
												<embed src="../../setting/save/persyaratan/<?=((isset($cek_berkas))?cek_file($r_cprofil['file_persyaratan']):'default.pdf')?>" style="width:100%;height:400px; border:1px solid #eee;" type="application/pdf"></embed>
												<div class="<?=(($status_peserta == "sudah")?'hide':'');?>">
												<hr>
												<div class="row">
													<div class="col-md-12">
														<input type="hidden" value="<?=$r_cprofil['id_peserta'];?>" name="id_peserta" />
														
														<a href="" class="btn btn-warning btn-sm">Berkas Belum Lengkap</a>
														<button type="submit" name="ubah_status_peserta" class="btn btn-sm btn-success">Berkas Lengkap</button>
													</div>
												</div>
												</div>
											</div>-->
										</div>					
									</div>
									<div class="col-sm-12">
<form class="akun-form" method="POST" enctype="multipart/form-data">
						<?php if(isset($profil)):?>
							<input type="hidden" name="id_peserta" value="<?=$r_cprofil['id_peserta'];?>">
						<?php endif; ?>	
								<div class="panel panel-white">
									<div class="panel-heading">
									<h6 class="panel-title">Akun <b><?=$namadepan?></b></h6>
									</div>
									<div class="panel-body">
									<div class="row">
									<div class="col-md-12">
									<div class="row">
									<div class="col-md-12">	
										<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Username</label>
												<input disabled type="text" value="<?=((isset($profil))?$r_cmahasiswa['nim']:'');?>" class="form-control input-sm">
											</div>
											<div class="col-md-6">
												<label class="control-label">Old Password</label>
												<input disabled type="text" value="<?=((isset($profil))?$r_cprofil['confirm_password']:'');?>" class="form-control input-sm">
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