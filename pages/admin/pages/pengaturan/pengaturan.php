<?php

	$t = date('Y');
	$a = $t-3;
	$j = $t+2;
	
	if(isset($_GET['atur'])){
		$atur    = $_GET['atur'];
		$r_uatur = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_pengaturan WHERE id_pengaturan='$atur'"));
		
		$tgl_pembekalan = $r_uatur['tgl_pembekalan'];		
		$tglpembekalan  = explode("-",$tgl_pembekalan);
		
		$tgl1           = $tglpembekalan[2];	
		$bln1           = $tglpembekalan[1];	
		$thn1           = $tglpembekalan[0];
		
		$tgl_pelepasan  = $r_uatur['tgl_pelepasan'];		
		$tglpelepasan   = explode("-",$tgl_pelepasan);
		
		$tgl2           = $tglpelepasan[2];	
		$bln2           = $tglpelepasan[1];	
		$thn2           = $tglpelepasan[0];

	}

?>
<div class="row">
	<div class="col-sm-7">
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-white">
					<div class="panel-heading">
						<h6 class="panel-title">Atur Profil Ketua Prodi</h6>
						<!--<div class="heading-elements panel-nav">
						<ul class="nav nav-pills nav-pills-bordered text-right">
							<li class=""><a href="#" data-toggle="modal" data-target="#rt_rw">Tambah Data</a></li>
							</ul>
						</div>-->
					</div>
					<div class="panel-body">
					<form method="POST" enctype="multipart/form-data">
						<div class="form-group row">
							<div class="col-md-3">
							<label class="control-label">NIDN</label>
								<input class="form-control input-sm" text="number" name="nidn" value="<?=((!empty($r_uatur['nidn']))?strtolower($r_uatur['nidn']):'-')?>" placeholder="Masukan NIDN" required="required" />
							</div>
							<div class="col-md-9">
							<label class="control-label">Nama Lengkap Ketua Prodi</label>
								<input class="form-control input-sm" text="text" name="nama_ketua_prodi" value="<?=((!empty($r_uatur['nama_ketua_prodi']))?strtoupper($r_uatur['nama_ketua_prodi']):'-')?>" placeholder="Masukan Ketua Prodi" required="required" />
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" value="<?=$r_atur['id_pengaturan']?>" name="id_pengaturan">
								<button type="submit" name="simpan_proprodi" class="btn btn-sm btn-primary">Simpan Data</button>
							</div>
						</div>
					</form>	
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<div class="panel panel-white">
					<div class="panel-heading">
						<h6 class="panel-title">Atur Komponen</h6>
						<!--<div class="heading-elements panel-nav">
						<ul class="nav nav-pills nav-pills-bordered text-right">
							<li class=""><a href="#" data-toggle="modal" data-target="#rt_rw">Tambah Data</a></li>
							</ul>
						</div>-->
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-7">
								<div class="row">
									<div class="col-sm-12">
										<div class="table-responsive">
											<table class="display table table-bor table-striped table-bordered table-hover" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th colspan="4" style="background:#f6f8f8; font-weight:bold; text-transform:uppercase;"><center>DATA PROGRAM STUDI</center></th>
													</tr>
													<tr>
														<th>#</th>
														<th>Nama Prodi</th>
														<th>Singkatan Prodi</th>
														<th><button data-toggle="modal" data-target="#tambah_prodi" class="btn btn-default btn-xs">Tambah</button></th>
													</tr>
												</thead>
												<tbody>
													<?php
														$no=1;
														$q_tprodi = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi");
														while($r_tprodi = mysqli_fetch_array($q_tprodi)):
													?>
														<tr>
															<td><?=$no++;?></td>
															<td><?=ucwords($r_tprodi['nama_prodi'])?></td>
															<td><?=strtoupper($r_tprodi['singkatan_prodi'])?></td>
															<td align="center">
																<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" class="label label-primary"  href='#ubah_prodi' id='custId' data-toggle='modal' data-id="<?=$r_tprodi['id_prodi']; ?>"><i class="fa fa-edit"></i></a>
													
																<!--<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" type="button" onclick="datadele(<?=$r_tprodi['id_prodi'];?>,&#39;prodi&#39;,<?=$r_atur['id_pengaturan'];?>)" data-title='Delete' data-toggle='modal' data-target='#myModal2' class="label label-danger" ><i class="fa fa-trash"></i></button>-->
															</td>
														</tr>
													<?php endwhile; ?>	
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="row">
									<div class="col-sm-12">
										<div class="table-responsive">
											<table class="display table table-bor table-striped table-bordered table-hover" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th colspan="4" style="background:#f6f8f8; font-weight:bold; text-transform:uppercase;"><center>DATA LEVEL (HAK AKSES)</center></th>
													</tr>
													<tr>
														<th>#</th>
														<th>Level</th>
														<th><center><button data-toggle="modal" data-target="#level" class="btn btn-default btn-xs">Tambah</button></center></th>
													</tr>
												</thead>
												<tbody>
												<?php
													$no=0;
													$q_tlevel = mysqli_query($dbconnect,"SELECT * FROM tbl_level WHERE id_level");
													while($r_tlevel = mysqli_fetch_array($q_tlevel)):
													$slevel = $r_tlevel['status'];
													
													$no++;
												?>
													<tr>
														<td><?=$no;?></td>
														<td>Level. <?=ucwords($r_tlevel['level']);?></td>
														<td><center>
															<a data-placement="left"  data-popup="tooltip" title="" data-original-title="<?=cek_status3($slevel);?>" href="?page=pengaturan&aksi_lstatus=ubah_lstatus&atur=<?=$r_atur['id_pengaturan'];?>&level=<?=$r_tlevel['id_level']?>&status=<?=$slevel;?>" class="label label-default"><?=cek_status2($slevel);?></a>
															
															<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" class="label label-primary <?=cek_status1($slevel);?>"  href='#ubah_level' id='custId' data-toggle='modal' data-id="<?php echo $r_tlevel['id_level']; ?>"><i class="fa fa-edit"></i></a>
															
															<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" type="button" onclick="datadele(<?=$r_tlevel['id_level'];?>,&#39;level&#39;,<?=$r_atur['id_pengaturan'];?>)" data-title='Delete' data-toggle='modal' data-target='#myModal2' class="label label-danger <?=cek_status1($slevel);?>" ><i class="fa fa-trash"></i></button>
														</center></td>
													</tr>
												<?php endwhile; ?>	
												<tbody>
												
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<form method="POST" enctype="multipart/form-data">
				<div class="panel panel-white">
					<div class="panel-heading">
						<h6 class="panel-title">Atur Syarat & Ketentuan <b>KKN</b></h6>
						<!--<div class="heading-elements panel-nav">
						<ul class="nav nav-pills nav-pills-bordered text-right">
							<li class=""><a href="#" data-toggle="modal" data-target="#rt_rw">Tambah Data</a></li>
							</ul>
						</div>-->
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12">
								<label for="sk" class="control-label">Syarat & Ketentuan <b>KKN</b></label>
								<textarea name="syarat" class="form-control " placeholder="Masukan Syarat & Ketentuan KKN" required="required" id="summernote" ><?=$r_atur['syarat']?></textarea>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" value="<?=$r_atur['id_pengaturan']?>" name="id_pengaturan">
								<button type="submit" name="simpan_syarat" class="btn btn-sm btn-primary">Simpan Data</button>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="row">
			<div class="col-sm-12">
				<form method="POST" enctype="multipart/form-data">
					<div class="panel panel-white">
						<div class="panel-heading">
							<h6 class="panel-title">Atur Email SMTP</h6>
						</div>
						<div class="panel-body">
						<div class="form-group row">
							<div class="col-md-12">
							<span style="">Jika ingin mengganti <b>Email SMTP</b> ( <b style="color:#d93600;">HARUS GMAIL</b> ) Anda harus mengaktifkan <b>Less Secure Apps</b> pada <b>Email</b> yang baru. <a href="#smtp" data-toggle="modal">Klik disini</a> untuk membaca tutorialnya.</span> 
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
							<label class="control-label">From & Replay Name</label>
								<input class="form-control input-sm" text="text" name="form_replay_name" value="<?=((!empty($r_uatur['form_replay_name']))?ucwords($r_uatur['form_replay_name']):'-')?>" placeholder="Masukan From & Replay Name" required="required" />
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
							<label class="control-label">Email SMTP</label>
								<input class="form-control input-sm" text="text" name="email_smtp" value="<?=((!empty($r_uatur['email_smtp']))?ucfirst($r_uatur['email_smtp']):'-')?>" placeholder="Masukan Email SMTP" required="required" />
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
							<label class="control-label">Password SMTP</label>
								<input class="form-control input-sm" text="text" name="password_smtp" value="<?=((!empty($r_uatur['password_smtp']))?$r_uatur['password_smtp']:'-')?>" placeholder="Masukan Password SMTP" required="required" />
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" value="<?=$r_atur['id_pengaturan']?>" name="id_pengaturan">
								<button type="submit" name="simpan_smtp" class="btn btn-sm btn-primary">Simpan Data</button>
							</div>
						</div>
						</div>
					</div>
				</form>	
			</div>
			<div class="col-sm-12">
			<form method="POST" enctype="multipart/form-data">
				<div class="panel panel-white">
					<div class="panel-heading">
						<h6 class="panel-title">Atur Lainnya</h6>
						<!--<div class="heading-elements panel-nav">
						<ul class="nav nav-pills nav-pills-bordered text-right">
							<li class=""><a href="#" data-toggle="modal" data-target="#rt_rw">Tambah Data</a></li>
							</ul>
						</div>-->
					</div>
					<div class="panel-body">
						<div class="form-group row">
							<div class="col-md-12 validation">
							<label class="control-label">Tanggal Pembekalan KKN</label>
							<div class="row">
								<div class="col-md-4 validation">
									<select name="tgl1" required class="form-control input-sm">
										<option value="<?=((isset($r_uatur))?$tgl1:'');?>"><?=((isset($r_uatur))?"✔ ".$tgl1:'Pilih Tanggal');?></option>
										<?php for ($n=1; $n <= 31 ; $n++) { ?>
											<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-4 validation">
									<select name="bln1" required class="form-control input-sm">
										<option value="<?=((isset($r_uatur))?$bln1:'');?>"><?=((isset($r_uatur))?"✔ ".getBulan($bln1):'Pilih Bulan');?></option>
										<?php for ($n=1; $n <= 12 ; $n++) { ?>
											<option value="<?php echo $n; ?>" > <?php echo $namaBulan[$n]; ?> </option>
										<?php } // akhir looping?>
									</select>
								</div>
								<div class="col-md-4 validation">
									<select name="thn1" required class="form-control input-sm">
										<option value="<?=((isset($r_uatur))?$thn1:'');?>"><?=((isset($r_uatur))?"✔ ".$thn1:'Pilih Tahun');?></option>
										<?php  for ($n= $tahun+0; $n <= $tahun+2 ; $n++) { ?>
											<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						</div>
						<div class="form-group row">
						<div class="col-md-12 validation">
							<label class="control-label">Tanggal Pelepasan KKN</label>
							<div class="row">
								<div class="col-md-4 validation">
									<select name="tgl2" required class="form-control input-sm">
										<option value="<?=((isset($r_uatur))?$tgl2:'');?>"><?=((isset($r_uatur))?"✔ ".$tgl2:'Pilih Tanggal');?></option>
										<?php for ($n=1; $n <= 31 ; $n++) { ?>
											<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-4 validation">
									<select name="bln2" required class="form-control input-sm">
										<option value="<?=((isset($r_uatur))?$bln2:'');?>"><?=((isset($r_uatur))?"✔ ".getBulan($bln2):'Pilih Bulan');?></option>
										<?php for ($n=1; $n <= 12 ; $n++) { ?>
											<option value="<?php echo $n; ?>" > <?php echo $namaBulan[$n]; ?> </option>
										<?php } // akhir looping?>
									</select>
								</div>
								<div class="col-md-4 validation">
									<select name="thn2" required class="form-control input-sm">
										<option value="<?=((isset($r_uatur))?$thn2:'');?>"><?=((isset($r_uatur))?"✔ ".$thn2:'Pilih Tahun');?></option>
										<?php  for ($n= $tahun+0; $n <= $tahun+2 ; $n++) { ?>
											<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-6">
								<label class="control-label">Tahun Angkatan</label>
								<select class="form-control input-sm" name="tahun_angkatan">
									<option value="<?=((isset($atur))?((!empty($r_uatur['tahun_angkatan']))?$r_uatur['tahun_angkatan']:''):'')?>"><?=((isset($atur))?((!empty($r_uatur['tahun_angkatan']))?"✔ ".$r_uatur['tahun_angkatan']:'Pilih Tahun Angkatan'):'')?></option>
									<?php
										for ($i=$a; $i < $j; $i++): 
											$k=$i+1;
											$taj = $i."/".$k;
									?>
										<option value="<?=$taj;?>"><?=$taj;?></option>
									<?php endfor; ?>
								</select>
							</div>
							<div class="col-sm-6">
								<label class="control-label">Tahun KKN</label>
								<select class="form-control input-sm" name="tahun_kkn">
									<option value="<?=((isset($atur))?((!empty($r_uatur['tahun_kkn']))?$r_uatur['tahun_kkn']:''):'')?>"><?=((isset($atur))?((!empty($r_uatur['tahun_kkn']))?"✔ ".$r_uatur['tahun_kkn']:'Pilih Tahun KKN'):'')?></option>
									<?php
										for ($i=$a; $i < $j; $i++): 
											$k=$i+1;
											$taj = $i."/".$k;
									?>
										<option value="<?=$taj;?>"><?=$taj;?></option>
									<?php endfor; ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
							<label class="control-label">Alamat Stikom</label>
								<textarea text="text" class="form-control input-sm" name="alamat_stikom" placeholder="Masukan Alamat Stikom" required="required"><?=((!empty($r_uatur['alamat_stikom']))?ucwords($r_uatur['alamat_stikom']):'-')?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
							<label class="control-label">No. Tlp/Hp - Fax Stikom</label>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone"></i></span>
								<input class="form-control input-sm" text="tel" name="no_tlp_stikom" value="<?=((!empty($r_uatur['no_tlp_stikom']))?ucwords($r_uatur['no_tlp_stikom']):'-')?>" placeholder="Masukan No. Tlp/Hp" required="required" />
								<span class="input-group-addon" id="basic-addon1"><i class="fa fa-fax"></i></span>
								<input class="form-control input-sm" text="tel" name="fax_stikom" value="<?=((!empty($r_uatur['fax_stikom']))?ucwords($r_uatur['fax_stikom']):'-')?>" placeholder="Masukan No. Fax" required="required" />
							</div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
							<label class="control-label">Website</label>
							<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><i class="fa fa-globe"></i></span>	
								<input class="form-control input-sm" text="url" name="website_stikom" value="<?=((!empty($r_uatur['website_stikom']))?strtolower($r_uatur['website_stikom']):'-')?>" placeholder="Masukan Website" required="required" />
							</div>
							</div>
						</div>
						<div class="form-group row">	
							<div class="col-md-12">
							<label class="control-label">Email</label>
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1">@</span>
								<input class="form-control input-sm" text="url" name="email_stikom" value="<?=((!empty($r_uatur['email_stikom']))?strtolower($r_uatur['email_stikom']):'-')?>" placeholder="Masukan Email" required="required" />
							</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" value="<?=$r_atur['id_pengaturan']?>" name="id_pengaturan">
								<button type="submit" name="simpan_pengaturan" class="btn btn-sm btn-primary">Simpan Data</button>
							</div>
						</div>
					</div>
				</div>
				</form>	
			</div>
		</div>
	</div>
</div>