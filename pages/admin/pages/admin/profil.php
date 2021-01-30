<?php

	$q_prodi = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi");
	
	$t = date('Y');
	$a = $t-10;
	$j = $t+1;
	
	if(isset($_GET['ubah_profil'])){
		
		$ubah_profil = $_GET['ubah_profil']; 
		$q_uadmin   = mysqli_query($dbconnect,"SELECT * FROM tbl_admin WHERE id_admin='$ubah_profil'");
		$r_uadmin   = mysqli_fetch_array($q_uadmin);
		
		$tgl_lahir      = $r_uadmin['tgl_lahir'];		
		$lahir  	    = explode("-",$tgl_lahir);
		
		$tgl            = $lahir[2];	
		$bln            = $lahir[1];	
		$thn            = $lahir[0];	
		
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
				<li class="<?=((isset($ubah_profil))?'hide':'active')?>"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-table"></i> Tampil Data Admin</a></li>
				<li class="<?=((isset($ubah_profil))?'active':'')?>"><a href="#tab2" data-toggle="tab" aria-expanded="true"><?=((isset($ubah_profil))?'<i class="fa fa-edit"></i> Ubah Data Admin':'<i class="fa fa-plus-square"></i> Tambah Data Admin')?></a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade <?=((isset($ubah_profil))?'':'in active')?>" id="tab1">
						<div class="panel panel-white">
							<div class="panel-heading">
							<h6 class="panel-title">Data Admin</h6>
							</div>
							<div class="panel-body">
							<div class="table-info">
								<table class="table table-striped table-bordered table-hover datatable-show-all">
									<thead>
										<tr>
											<th>#</th>
											<th>Foto</th>
											<th>Nama Admin</th>
											<th>Jenis Kelamin</th>
											<th>Agama</th>
											<th>Tempat/Tgl Lahir</th>
											<th>No. Tlp/Hp</th>
											<th>Email</th>
											<th>Alamat</th>
											<th align="center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										
										<?php 
											$no=0;
											
											$q_tadmin = mysqli_query($dbconnect,"SELECT * FROM tbl_admin WHERE id_admin");
											while($r_tadmin = mysqli_fetch_array($q_tadmin)){
											
											$no++;
										?>
										<tr>
											<td><?=$no;?></td>
											<td><center><img src="../../setting/save/admin/<?=cek_foto($r_tadmin['foto_admin']);?>" class="resident-picture"></center></td>
											<td><?=ucwords($r_tadmin['nama_admin'])?></td>
											<td><?=ucwords($r_tadmin['jk_admin'])?></td>
											<td><?=ucwords($r_tadmin['agama_admin'])?></td>
											<td><?=ucwords($r_tadmin['tempat_lahir']).", ".tgl_indo($r_tadmin['tgl_lahir']);?></td>
											<td><?=ucwords($r_tadmin['no_tlp_admin'])?></td>
											<td><?=ucwords($r_tadmin['email_admin'])?></td>
											<td><?=ucwords($r_tadmin['alamat_admin'])?></td>
											<td align="center">												
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" href="?page=admin&ubah_profil=<?=$r_tadmin['id_admin']?>" type="button" class="btn btn-primary btn-xs "><i class="fa fa-edit"></i></a>

												<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" onclick='datadel(<?php echo $r_tadmin['id_admin']; ?>,&#39;admin&#39;)'  data-title='Delete' data-toggle='modal' data-target='#myModal' type="button" class="btn btn-danger btn-xs "><i class="fa fa-trash"></i></button>
											
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
					<div class="tab-pane fade <?=((isset($ubah_profil))?'in active':'')?>" id="tab2">
					<form class="admin-form" method="POST" enctype="multipart/form-data">
					<?php if(isset($ubah_profil)):?>
						<input type="hidden" name="id_admin" value="<?=$r_uadmin['id_admin'];?>">
					<?php endif; ?>	
						<div class="row">
							<div class="col-sm-3">
							<!-- User thumbnail -->
								<div class="thumbnail">
									<div class="thumb thumb-rounded thumb-slide" >
										<img src="../../setting/save/admin/<?=((isset($ubah_profil))?cek_foto($r_uadmin['foto_admin']):'default.png')?>" class="picture-pass" id='img-upload'/>
									</div>
								
									<div class="caption text-center">
										<div class="form-group row">
											<div class="col-md-12">
											<label class="control-label">Unggah Foto</label>
												<div class="input-group">
													<span class="input-group-btn">
														<span class="btn btn-default btn-sm btn-file">
															<i class="fa fa-folder-open"></i> Ambil<input type="file" name="savefotoadmin" id="imgInp" accept="image/*" />
														</span>
													</span>
													<input type="text" value="<?=((isset($ubah_profil))?$r_uadmin['foto_admin']:'');?>" class="form-control input-sm" readonly>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-9">
								<div class="panel panel-white">
									<div class="panel-heading">
									<h6 class="panel-title">Form Admin</h6>
									</div>
									<div class="panel-body">
									<div class="row">
									<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group row">
												<div class="col-md-12 validation">
													<label class="control-label">Nama Lengkap admin</label>
													<input type="text" name="nama_admin" required placeholder="Masukan Nama admin"  value="<?=((isset($ubah_profil))?$r_uadmin['nama_admin']:'');?>" class="form-control input-sm capitalize">
												</div>
											</div>
											<div class="form-group row">
											</div>
											<div class="form-group row">
												<div class="col-md-8">
													<label class="control-label">Jenis Kelamin</label>
													<div class="row">
													<div class="col-xs-6">
														<div class="radio radio-danger">
															<input required type="radio" name="jk_admin" id="radio1" value="laki-laki" <?=((isset($ubah_profil) AND $r_uadmin['jk_admin']=='laki-laki')?'checked':'checked');?>>
															<label for="radio1">
																Laki-Laki
															</label>
														</div>
													</div>
													<div class="col-xs-6">
														<div class="radio radio-success">
															<input required type="radio" name="jk_admin" id="radio2" value="perempuan" <?=((isset($ubah_profil) AND $r_uadmin['jk_admin']=='perempuan')?'checked':'');?>>
															<label for="radio2">
																Perempuan
															</label>
														</div>
													</div>
													</div>
												</div>
												
											</div>
											<div class="form-group row">
												<div class="col-md-3 validation">
													<label class="control-label">Agama</label>
													<select required name="agama_admin" class="form-control input-sm">
														<option value="<?=((isset($ubah_profil))?$r_uadmin['agama_admin']:'');?>"><?=((isset($ubah_profil))?"✔ ".ucwords($r_uadmin['agama_admin']):'Pilih Agama');?></option>
														<option value="kristen protestan">Kristen Protestan</option>
														<option value="katolik">Katolik</option>
														<option value="islam">Islam</option>
														<option value="hindu">Hindu</option>
														<option value="budha">Budha</option>
														<option value="kong hu chu">Kong Hu Chu</option>
													</select>
												</div>
												<div class="col-md-3 validation">
													<label class="control-label">Tempat</label>
														<input type="text" value="<?=((isset($ubah_profil))?$r_uadmin['tempat_lahir']:'')?>" required name="tempat_lahir" placeholder="Masukan Tempat Lahir" class="form-control input-sm capitalize">
												</div>
												<div class="col-md-6">
													<label class="control-label">Tanggal Lahir</label>
													<div class="row">
														<div class="col-md-4 validation">
															<select name="tgl" required class="form-control input-sm">
																<option value="<?=((isset($ubah_profil))?$tgl:'');?>"><?=((isset($ubah_profil))?"✔ ".$tgl:'Pilih Tanggal');?></option>
																<?php for ($n=1; $n <= 31 ; $n++) { ?>
																	<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
																<?php } ?>
															</select>
														</div>
														<div class="col-md-4 validation">
															<select name="bln" required class="form-control input-sm">
																<option value="<?=((isset($ubah_profil))?$bln:'');?>"><?=((isset($ubah_profil))?"✔ ".getBulan($bln):'Pilih Bulan');?></option>
																<?php for ($n=1; $n <= 12 ; $n++) { ?>
																	<option value="<?php echo $n; ?>" > <?php echo $namaBulan[$n]; ?> </option>
																<?php } // akhir looping?>
															</select>
														</div>
														<div class="col-md-4 validation">
															<select name="thn" required class="form-control input-sm">
																<option value="<?=((isset($ubah_profil))?$thn:'');?>"><?=((isset($ubah_profil))?"✔ ".$thn:'Pilih Tahun');?></option>
																<?php  for ($n= $tahun -80; $n <= $tahun+1 ; $n++) { ?>
																	<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
																<?php } ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<div class="col-md-6 validation">
													<label class="control-label">No. Tlp/Hp</label>
													<input type="tel" value="<?=((isset($ubah_profil))?$r_uadmin['no_tlp_admin']:'');?>" required name="no_tlp_admin" placeholder="Masukan No. Tlp/Hp" class="form-control input-sm"  />
												</div>
												<div class="col-md-6 validation">
													<label class="control-label">Email</label>
													<input type="text" value="<?=((isset($ubah_profil))?$r_uadmin['email_admin']:'');?>" name="email_admin"  required placeholder="Masukan Email" class="form-control input-sm capitalize"  />
												</div>
											</div>
											

									<div class="form-group row">
										<div class="col-md-12 validation">
										<label class="control-label">Alamat</label>
											<textarea  type="text" id="" required name="alamat_admin" placeholder="Masukan Alamat" class="form-control input-sm capitalize"><?=((isset($ubah_profil))?$r_uadmin['alamat_admin']:'');?></textarea>
										</div>
									</div>
									<div class="<?=((isset($ubah_profil))?'hide':'');?>">
										<hr>
										<div class="form-group row">
											<div class="col-md-12 validation">
												<label class="control-label">Username</label>
												<input type="text" name="username" required placeholder="Masukan Username"  class="form-control input-sm">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-6 validation">
												<label class="control-label">Password</label>
												<input type="password" name="password" id="password" required placeholder="Masukan Kata Sandi"  class="form-control input-sm">
											</div>
											<div class="col-md-6 validation">
												<label class="control-label">Confirm Password </label>
												<input type="password" name="confirm_password" required placeholder="Masukan Ulang Kata Sandi"  class="form-control input-sm">
											</div>
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
											<button type="submit" name="ubah_profil" class="btn btn-sm btn-primary">Simpan Data</button>
										</div>
									</div>
									
								
									</div>			
								</div>					
							</div>
						</div>
					</form>
					<form class="akun-form <?=((isset($ubah_profil))?'':'hide');?>" method="POST" enctype="multipart/form-data">
					<?php if(isset($ubah_profil)):?>
						<input type="hidden" name="id_admin" value="<?=$r_uadmin['id_admin'];?>">
					<?php endif; ?>	
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-sm-9">
								<div class="panel panel-white">
									<div class="panel-heading">
									<h6 class="panel-title">Form Akun</h6>
									</div>
									<div class="panel-body">
									<div class="row">
									<div class="col-md-12">
									<div class="row">
									<div class="col-md-12">	
										<div class="form-group row">
											<div class="col-md-6">
												<label class="control-label">Username</label>
												<input disabled type="text" value="<?=((isset($ubah_profil))?$r_uadmin['username']:'');?>" class="form-control input-sm">
											</div>
											<div class="col-md-6">
												<label class="control-label">Old Password</label>
												<input disabled type="text" value="<?=((isset($ubah_profil))?$r_uadmin['confirm_password']:'');?>" class="form-control input-sm">
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
							</div>
						</div>
						</form>
					</div>
			</div>	
		</div>
	</div>