<?php

	if(isset($_GET['cek_berkas'])){
		$cek_berkas     = $_GET['cek_berkas'];
		$r_cberkas      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$cek_berkas'"));
		
		$status_peserta = $r_cberkas['status_peserta'];
		
		$r_cmahasiswa   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_cberkas[id_mahasiswa]'"));
		
		$r_cprodi       = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_cmahasiswa[id_prodi]'"));
		
		$statuspeserta = $r_cberkas['status_peserta'];
							
		if($statuspeserta == "tidak"){
			$stberkas = "Berkas Belum Diperiksa";
		}
		elseif($statuspeserta == "belum"){
			$stberkas = "Berkas Belum Lengkap";
		}
		elseif($statuspeserta == "ubah"){
			$stberkas = "Berkas Pengganti";
		}
		else{
			$stberkas = "";
		}
							
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
				<li><a href="?page=peserta"><i class="fa fa-chevron-circle-left"></i> Kembali</a></li>
				<li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-check-square-o"></i> Cek Berkas Peserta</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">				
				<div class="tab-pane fade in active" id="tab1">
				
					<form class="form-validate" method="POST" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-3">
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
							<div class="col-sm-9">
								<div class="row">
									<div class="col-sm-12">
										<div class="panel panel-white">
											<div class="panel-heading">
												<h6 class="panel-title">Profi Peserta <b>KKN</b></h6>
											</div>
											<div class="table-responsive">
											<table class="table table-noborder table-hover table-striped">
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
													<td><?=strtoupper($r_cberkas['tahun_kkn'])?></td>
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
											<div class="panel-heading">
												<h6 class="panel-title">Berkas Persyaratan Peserta <b>KKN</b></h6>
												<div class="heading-elements">
													<ul class="list-inline heading-text">
														<li><a href="../../setting/save/persyaratan/<?=$r_cberkas['file_persyaratan'];?>" class="download_berkas"><i class="fa fa-print"></i> Unduh Berkas</a></li>
													</ul>
												</div>
											</div>
											<div class="panel-body">
												<embed src="../../setting/save/persyaratan/<?=((isset($cek_berkas))?cek_file($r_cberkas['file_persyaratan']):'default.pdf')?>" style="width:100%;height:400px; border:1px solid #eee;" type="application/pdf"></embed>
												<?php if($statuspeserta=="sudah"){echo"";}elseif($statuspeserta!=="sudah"){?>
												<div class="form-group row">
												<br>
													<div class="col-md-6">
														<label class="control-label">Status Berkas</label>
														<div class="form-group row">
															<div class="col-md-7">
																<select class="form-control input-sm" name="status_peserta">
																	<option value="">Pilih Status</option>
																	<option value="belum">Berkas Belum Lengkap</option>
																	<option value="sudah">Berkas Sudah Lengkap</option>
																</select>
															</div>
															<div class="col-md-5">
															<input class="form-control input-sm" value="<?=$stberkas;?>" disabled type="text" />
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<label class="control-label">Tanggal Daftar</label>
														<input class="form-control input-sm" value="<?=tgl_indo($r_cberkas['tgl_daftar']);?>" disabled type="text" />
													</div>
												</div>
												<hr>
												<div class="row">
												<div class="col-md-12">
													<input type="hidden" value="<?=$r_cberkas['id_peserta'];?>" name="id_peserta" />
													<a href="?page=peserta" class="btn btn-danger btn-sm">Batal Ubah</a>
													<button type="submit" name="ubah_status_peserta" class="btn btn-sm btn-success">Ubah Status</button>
												</div>
												<?php } ?>
											</div>
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