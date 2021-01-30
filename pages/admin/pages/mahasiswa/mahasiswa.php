<?php

	$q_prodi = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi");
	
	$t = date('Y');
	$a = $t-10;
	$j = $t+1;
	
	if(isset($_GET['ubah_mahasiswa'])){
		
		$ubah_mahasiswa = $_GET['ubah_mahasiswa']; 
		$q_umahasiswa   = mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$ubah_mahasiswa'");
		$r_umahasiswa   = mysqli_fetch_array($q_umahasiswa);
		
		$tgl_lahir      = $r_umahasiswa['tgl_lahir'];		
		$lahir  	    = explode("-",$tgl_lahir);
		
		$tgl            = $lahir[2];	
		$bln            = $lahir[1];	
		$thn            = $lahir[0];	
		
		$q_uprodi       = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_umahasiswa[id_prodi]'");
		$r_uprodi		= mysqli_fetch_array($q_uprodi);
		
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
				<li class="<?=((isset($ubah_mahasiswa))?'hide':'active')?>"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-table"></i> Tampil Data Mahasiswa</a></li>
				<li class="<?=((isset($ubah_mahasiswa))?'':'hide')?>"><a href="?page=mahasiswa"><i class="fa fa-chevron-circle-left"></i> Kembali</a></li>
				<li class="<?=((isset($ubah_mahasiswa))?'active':'')?>"><a href="#tab2" data-toggle="tab" aria-expanded="true"><?=((isset($ubah_mahasiswa))?'<i class="fa fa-edit"></i> Ubah Data Mahasiswa':'<i class="fa fa-plus-square"></i> Tambah Data Mahasiswa')?></a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade <?=((isset($ubah_mahasiswa))?'':'in active')?>" id="tab1">
						<div class="panel panel-white">
							<div class="panel-heading">
							<h6 class="panel-title">Data Mahasiswa</h6>
							</div>
							<div class="panel-body">
							<div class="table-info">
								<table class="table table-striped table-bordered table-hover datatable-show-all">
									<thead>
										<tr>
											<th>#</th>
											<th>Foto</th>
											<th>Tahun Angkatan</th>
											<th>Program Studi</th>
											<th>NIM</th>
											<th>Nama Mahasiswa</th>
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
											
											$q_tmahasiswa = mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa ORDER BY nama_mahasiswa ASC");
											while($r_tmahasiswa = mysqli_fetch_array($q_tmahasiswa)){
												
											$q_tprodi = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tmahasiswa[id_prodi]'");	
											$r_tprodi = mysqli_fetch_array($q_tprodi);
											
											$no++;
										?>
										<tr>
											<td><?=$no;?></td>
											<td><center><img src="../../setting/save/mahasiswa/<?=cek_foto($r_tmahasiswa['foto_mahasiswa']);?>" class="resident-picture"></center></td>
											<td><?=$r_tmahasiswa['tahun_angkatan']?></td>
											<td><?=ucwords($r_tprodi['nama_prodi'])?></td>
											<td><?=$r_tmahasiswa['nim']?></td>
											<td><?=ucwords($r_tmahasiswa['nama_mahasiswa'])?></td>
											<td><?=ucwords(jk($r_tmahasiswa['jk_mahasiswa']))?></td>
											<td><?=ucwords($r_tmahasiswa['agama_mahasiswa'])?></td>
											<td><?=ucwords($r_tmahasiswa['tempat_lahir']).", ".tgl_indo($r_tmahasiswa['tgl_lahir']);?></td>
											<td><?=ucwords($r_tmahasiswa['no_tlp_mahasiswa'])?></td>
											<td><?=ucwords($r_tmahasiswa['email_mahasiswa'])?></td>
											<td><?=ucwords($r_tmahasiswa['alamat_mahasiswa'])?></td>
											<td align="center">
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Cek PIN KRS" href='#pin' id='custId' data-toggle='modal' data-id="<?php echo $r_tmahasiswa['id_mahasiswa']; ?>" type="button" class="label label-success"><i class="fa fa-magic"></i></a>
												
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" href="?page=mahasiswa&ubah_mahasiswa=<?=$r_tmahasiswa['id_mahasiswa']?>" type="button" class="label label-primary"><i class="fa fa-edit"></i></a>
												


												<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" onclick='datadel(<?php echo $r_tmahasiswa['id_mahasiswa']; ?>,&#39;mahasiswa&#39;)'  data-title='Delete' data-toggle='modal' data-target='#myModal' type="button" class="label label-danger"><i class="fa fa-trash"></i></button>
											
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
					<div class="tab-pane fade <?=((isset($ubah_mahasiswa))?'in active':'')?>" id="tab2">
					<form class="student-form" method="POST" enctype="multipart/form-data">
					<?php if(isset($ubah_mahasiswa)):?>
						<input type="hidden" name="id_mahasiswa" value="<?=$r_umahasiswa['id_mahasiswa'];?>">
					<?php endif; ?>	
						<div class="row">
							<div class="col-sm-3">
							<!-- User thumbnail -->
								<div class="thumbnail">
									<div class="thumb thumb-rounded thumb-slide" >
										<img src="../../setting/save/mahasiswa/<?=((isset($ubah_mahasiswa))?cek_foto($r_umahasiswa['foto_mahasiswa']):'default.png')?>" class="picture-pass" id='img-upload'/>
									</div>
								
									<div class="caption text-center">
										<div class="form-group row">
											<div class="col-md-12">
											<label class="control-label">Unggah Foto</label>
												<div class="input-group">
													<span class="input-group-btn">
														<span class="btn btn-default btn-sm btn-file">
															<i class="fa fa-folder-open"></i> Ambil<input type="file" name="savefotomahasiswa" id="imgInp" accept="image/*" />
														</span>
													</span>
													<input type="text" value="<?=((isset($ubah_mahasiswa))?$r_umahasiswa['foto_mahasiswa']:'');?>" class="form-control input-sm" readonly>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-9">
								<div class="panel panel-white">
									<div class="panel-heading">
										<h6 class="panel-title">Form Mahasiswa</h6>
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
													<label class="control-label">Tahun Angkatan</label>
													<select required name="tahun_angkatan" class="form-control input-sm">
														<option value="<?=((isset($ubah_mahasiswa))?$r_umahasiswa['tahun_angkatan']:'');?>"><?=((isset($ubah_mahasiswa))?"✔ ".ucwords($r_umahasiswa['tahun_angkatan']):'Pilih Tahun Angkatan');?></option>
														<?php
														for ($i=$a; $i < $j; $i++): 
															$k=$i+1;
															$taj = $i."/".$k;
														?>
															<option value="<?=$taj;?>"><?=$taj;?></option>
														<?php endfor; ?>
													</select>
												</div>
												<div class="col-md-4 validation">
													<label class="control-label">Program Studi</label>
													<select required name="id_prodi" class="form-control input-sm">
														<option value="<?=((isset($ubah_mahasiswa))?$r_umahasiswa['id_prodi']:'');?>"><?=((isset($ubah_mahasiswa))?"✔ ".ucwords($r_uprodi['nama_prodi']):'Pilih Program Studi');?></option>
														<?php while($r_prodi = mysqli_fetch_array($q_prodi)): ?>
														<option value="<?=$r_prodi['id_prodi']?>"><?=$r_prodi['nama_prodi']?></option>
														<?php endwhile;?>	
													</select>
												</div>
												<div class="col-md-4 validation">
													<label class="control-label">NIM</label>
													<input type="number" id="nim" name="nim" required placeholder="Masukan NIM"  value="<?=((isset($ubah_mahasiswa))?$r_umahasiswa['nim']:'');?>" class="form-control input-sm typeahead" >
												</div>
											</div>
											<div class="form-group row">
												<div class="col-md-12 validation">
													<label class="control-label">Nama Lengkap Mahasiswa</label>
													<input type="text" name="nama_mahasiswa" required placeholder="Masukan Nama Mahasiswa"  value="<?=((isset($ubah_mahasiswa))?$r_umahasiswa['nama_mahasiswa']:'');?>" class="form-control input-sm capitalize">
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
															<input required type="radio" name="jk_mahasiswa" id="radio1" value="laki-laki" <?=((isset($ubah_mahasiswa) AND $r_umahasiswa['jk_mahasiswa']=='laki-laki')?'checked':'checked');?>>
															<label for="radio1">
																Laki-Laki
															</label>
														</div>
													</div>
													<div class="col-xs-6">
														<div class="radio radio-success">
															<input required type="radio" name="jk_mahasiswa" id="radio2" value="perempuan" <?=((isset($ubah_mahasiswa) AND $r_umahasiswa['jk_mahasiswa']=='perempuan')?'checked':'');?>>
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
													<select required name="agama_mahasiswa" class="form-control input-sm">
														<option value="<?=((isset($ubah_mahasiswa))?$r_umahasiswa['agama_mahasiswa']:'');?>"><?=((isset($ubah_mahasiswa))?"✔ ".ucwords($r_umahasiswa['agama_mahasiswa']):'Pilih Agama');?></option>
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
														<input type="text" value="<?=((isset($ubah_mahasiswa))?$r_umahasiswa['tempat_lahir']:'')?>" required name="tempat_lahir" placeholder="Masukan Tempat Lahir" class="form-control input-sm capitalize">
												</div>
												<div class="col-md-6 validation">
													<label class="control-label">Tanggal Lahir</label>
													<div class="row">
														<div class="col-md-4 validation">
															<select name="tgl" required class="form-control input-sm">
																<option value="<?=((isset($ubah_mahasiswa))?$tgl:'');?>"><?=((isset($ubah_mahasiswa))?"✔ ".$tgl:'Pilih Tanggal');?></option>
																<?php for ($n=1; $n <= 31 ; $n++) { ?>
																	<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
																<?php } ?>
															</select>
														</div>
														<div class="col-md-4 validation">
															<select name="bln" required class="form-control input-sm">
																<option value="<?=((isset($ubah_mahasiswa))?$bln:'');?>"><?=((isset($ubah_mahasiswa))?"✔ ".getBulan($bln):'Pilih Bulan');?></option>
																<?php for ($n=1; $n <= 12 ; $n++) { ?>
																	<option value="<?php echo $n; ?>" > <?php echo $namaBulan[$n]; ?> </option>
																<?php } // akhir looping?>
															</select>
														</div>
														<div class="col-md-4 validation">
															<select name="thn" required class="form-control input-sm">
																<option value="<?=((isset($ubah_mahasiswa))?$thn:'');?>"><?=((isset($ubah_mahasiswa))?"✔ ".$thn:'Pilih Tahun');?></option>
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
													<input type="tel" value="<?=((isset($ubah_mahasiswa))?$r_umahasiswa['no_tlp_mahasiswa']:'');?>" required name="no_tlp_mahasiswa" placeholder="Masukan No. Tlp/Hp" class="form-control input-sm"  />
												</div>
												<div class="col-md-6 validation">
													<label class="control-label">Email</label>
													<input type="text" value="<?=((isset($ubah_mahasiswa))?$r_umahasiswa['email_mahasiswa']:'');?>" name="email_mahasiswa"  required placeholder="Masukan Email" class="form-control input-sm capitalize"  />
												</div>
											</div>
											

									<div class="form-group row">
										<div class="col-md-12 validation">
										<label class="control-label">Alamat</label>
											<textarea  type="text" id="" required name="alamat_mahasiswa" placeholder="Masukan Alamat" class="form-control input-sm capitalize"><?=((isset($ubah_mahasiswa))?$r_umahasiswa['alamat_mahasiswa']:'');?></textarea>
										</div>
									</div>
									</div>
										
									</div>
									</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-12">
											<a href="?page=mahasiswa" class="btn btn-danger btn-sm">Batal Simpan</a>
											<button type="submit" name="simpan_mahasiswa" class="btn btn-sm btn-primary">Simpan Data</button>
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