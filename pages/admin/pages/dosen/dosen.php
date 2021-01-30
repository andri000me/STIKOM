<?php

	//$q_prodi = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi");
	
	$t = date('Y');
	$a = $t-10;
	$j = $t+1;
	
	if(isset($_GET['ubah_dosen'])){
		
		$ubah_dosen = $_GET['ubah_dosen']; 
		$q_udosen   = mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$ubah_dosen'");
		$r_udosen   = mysqli_fetch_array($q_udosen);
		
		$tgl_lahir      = $r_udosen['tgl_lahir'];		
		$lahir  	    = explode("-",$tgl_lahir);
		
		$tgl            = $lahir[2];	
		$bln            = $lahir[1];	
		$thn            = $lahir[0];	
		
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
				<li class="<?=((isset($ubah_dosen))?'hide':'active')?>"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-table"></i> Tampil Data Dosen</a></li>
				<li class="<?=((isset($ubah_dosen))?'':'hide')?>"><a href="?page=dosen"><i class="fa fa-chevron-circle-left"></i> Kembali</a></li>
				<li class="<?=((isset($ubah_dosen))?'active':'')?>"><a href="#tab2" data-toggle="tab" aria-expanded="true"><?=((isset($ubah_dosen))?'<i class="fa fa-edit"></i> Ubah Data Dosen':'<i class="fa fa-plus-square"></i> Tambah Data Dosen')?></a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade <?=((isset($ubah_dosen))?'':'in active')?>" id="tab1">
						<div class="panel panel-white">
							<div class="panel-heading">
							<h6 class="panel-title">Data Dosen</h6>
							</div>
							<div class="panel-body">
							<div class="table-info">
								<table class="table table-striped table-bordered table-hover datatable-show-all">
									<thead>
										<tr>
											<th>#</th>
											<th>Foto</th>
											<th>NIDN</th>
											<th>Nama Dosen</th>
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
											
											$q_tdosen = mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen ORDER BY nama_dosen ASC");
											while($r_tdosen = mysqli_fetch_array($q_tdosen)){
											
											$no++;
										?>
										<tr>
											<td><?=$no;?></td>
											<td><center><img src="../../setting/save/dosen/<?=cek_foto($r_tdosen['foto_dosen']);?>" class="resident-picture"></center></td>
											<td><?=$r_tdosen['nidn']?></td>
											<td><?=ucwords($r_tdosen['nama_dosen'])?></td>
											<td><?=ucwords(jk($r_tdosen['jk_dosen']))?></td>
											<td><?=ucwords($r_tdosen['agama_dosen'])?></td>
											<td><?=ucwords($r_tdosen['tempat_lahir']).", ".tgl_indo($r_tdosen['tgl_lahir']);?></td>
											<td><?=ucwords($r_tdosen['no_tlp_dosen'])?></td>
											<td><?=ucwords($r_tdosen['email_dosen'])?></td>
											<td><?=ucwords($r_tdosen['alamat_dosen'])?></td>
											<td align="center">												
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" href="?page=dosen&ubah_dosen=<?=$r_tdosen['id_dosen']?>" type="button" class="label label-primary"><i class="fa fa-edit"></i></a>

												<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" onclick='datadel(<?php echo $r_tdosen['id_dosen']; ?>,&#39;dosen&#39;)'  data-title='Delete' data-toggle='modal' data-target='#myModal' type="button" class="label label-danger"><i class="fa fa-trash"></i></button>
											
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
					<div class="tab-pane fade <?=((isset($ubah_dosen))?'in active':'')?>" id="tab2">
					<form class="dosen-form" method="POST" enctype="multipart/form-data">
					<?php if(isset($ubah_dosen)):?>
						<input type="hidden" name="id_dosen" value="<?=$r_udosen['id_dosen'];?>">
					<?php endif; ?>	
						<div class="row">
							<div class="col-sm-3">
							<!-- User thumbnail -->
								<div class="thumbnail">
									<div class="thumb thumb-rounded thumb-slide" >
										<img src="../../setting/save/dosen/<?=((isset($ubah_dosen))?cek_foto($r_udosen['foto_dosen']):'default.png')?>" class="picture-pass" id='img-upload'/>
									</div>
								
									<div class="caption text-center">
										<div class="form-group row">
											<div class="col-md-12">
											<label class="control-label">Unggah Foto</label>
												<div class="input-group">
													<span class="input-group-btn">
														<span class="btn btn-default btn-sm btn-file">
															<i class="fa fa-folder-open"></i> Ambil<input type="file" name="savefotodosen" id="imgInp" accept="image/*" />
														</span>
													</span>
													<input type="text" value="<?=((isset($ubah_dosen))?$r_udosen['foto_dosen']:'');?>" class="form-control input-sm" readonly>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-9">
								<div class="panel panel-white">
									<div class="panel-heading">
										<h6 class="panel-title">Form Dosen</h6>
										<div class="heading-elements">
											<button data-toggle="modal" data-target="#impor" type="button" class="btn btn-default btn-sm heading-btn text-semibold"><i class="fa fa-folder-open-o" style="margin-top:-4px;"></i> Import Data</button>
										</div>
									</div>
									<div class="panel-body">
									<div class="row">
									<div class="col-md-12">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group row">
												<div class="col-md-4 validation">
													<label class="control-label">NIDN</label>
													<input type="number" name="nidn" required placeholder="Masukan NIDN"  value="<?=((isset($ubah_dosen))?$r_udosen['nidn']:'');?>" class="form-control input-sm typeahead" >
												</div>
											</div>
											<div class="form-group row">
												<div class="col-md-12 validation">
													<label class="control-label">Nama Lengkap Dosen</label>
													<input type="text" name="nama_dosen" required placeholder="Masukan Nama dosen"  value="<?=((isset($ubah_dosen))?$r_udosen['nama_dosen']:'');?>" class="form-control input-sm capitalize">
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
															<input required type="radio" name="jk_dosen" id="radio1" value="laki-laki" <?=((isset($ubah_dosen) AND $r_udosen['jk_dosen']=='laki-laki')?'checked':'checked');?>>
															<label for="radio1">
																Laki-Laki
															</label>
														</div>
													</div>
													<div class="col-xs-6">
														<div class="radio radio-success">
															<input required type="radio" name="jk_dosen" id="radio2" value="perempuan" <?=((isset($ubah_dosen) AND $r_udosen['jk_dosen']=='perempuan')?'checked':'');?>>
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
													<select required name="agama_dosen" class="form-control input-sm">
														<option value="<?=((isset($ubah_dosen))?$r_udosen['agama_dosen']:'');?>"><?=((isset($ubah_dosen))?"✔ ".ucwords($r_udosen['agama_dosen']):'Pilih Agama');?></option>
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
														<input type="text" value="<?=((isset($ubah_dosen))?$r_udosen['tempat_lahir']:'')?>" required name="tempat_lahir" placeholder="Masukan Tempat Lahir" class="form-control input-sm capitalize">
												</div>
												<div class="col-md-6 validation">
													<label class="control-label">Tanggal Lahir</label>
													<div class="row">
														<div class="col-md-4 validation">
															<select name="tgl" required class="form-control input-sm">
																<option value="<?=((isset($ubah_dosen))?$tgl:'');?>"><?=((isset($ubah_dosen))?"✔ ".$tgl:'Pilih Tanggal');?></option>
																<?php for ($n=1; $n <= 31 ; $n++) { ?>
																	<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
																<?php } ?>
															</select>
														</div>
														<div class="col-md-4 validation">
															<select name="bln" required class="form-control input-sm">
																<option value="<?=((isset($ubah_dosen))?$bln:'');?>"><?=((isset($ubah_dosen))?"✔ ".getBulan($bln):'Pilih Bulan');?></option>
																<?php for ($n=1; $n <= 12 ; $n++) { ?>
																	<option value="<?php echo $n; ?>" > <?php echo $namaBulan[$n]; ?> </option>
																<?php } // akhir looping?>
															</select>
														</div>
														<div class="col-md-4 validation">
															<select name="thn" required class="form-control input-sm">
																<option value="<?=((isset($ubah_dosen))?$thn:'');?>"><?=((isset($ubah_dosen))?"✔ ".$thn:'Pilih Tahun');?></option>
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
													<input type="tel" value="<?=((isset($ubah_dosen))?$r_udosen['no_tlp_dosen']:'');?>" required name="no_tlp_dosen" placeholder="Masukan No. Tlp/Hp" class="form-control input-sm"  />
												</div>
												<div class="col-md-6 validation">
													<label class="control-label">Email</label>
													<input type="text" value="<?=((isset($ubah_dosen))?$r_udosen['email_dosen']:'');?>" name="email_dosen"  required placeholder="Masukan Email" class="form-control input-sm capitalize"  />
												</div>
											</div>
											

									<div class="form-group row">
										<div class="col-md-12 validation">
										<label class="control-label">Alamat</label>
											<textarea  type="text" id="" required name="alamat_dosen" placeholder="Masukan Alamat" class="form-control input-sm capitalize"><?=((isset($ubah_dosen))?$r_udosen['alamat_dosen']:'');?></textarea>
										</div>
									</div>
									</div>
										
									</div>
									</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<a href="?page=dosen" class="btn btn-danger btn-sm">Batal Simpan</a>
											<button type="submit" name="simpan_dosen" class="btn btn-sm btn-primary">Simpan Data</button>
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