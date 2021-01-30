<?php
	
	$t = date('Y');
	$a = $t-10;
	$j = $t+1;
	
	$tgl_sekarang = explode("-",$tglsekarang);

	$thns		  = $tgl_sekarang[0];		
	$blns		  = $tgl_sekarang[1];		
	$tgls		  = $tgl_sekarang[2];		

	$r_tlokasi    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_xkelompok[id_lokasi]'"));
		
	$r_tprov  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
							
	$r_tkota  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
	
	$r_tkec   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
	
	$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
	
	$r_cprodi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_mahasiswa[id_prodi]'"));
	
	
	if(isset($_GET['ubah_lb'])){
		$id_logbook     = $_GET['ubah_lb'];
		$r_ulbmandiri   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_logbook WHERE id_logbook='$id_logbook'"));
		
		$idlogbook      = $r_ulbmandiri['id_logbook'];
		
		$tgl_pengisian  = $r_ulbmandiri['tgl_pengisian'];		
		$isi     	    = explode("-",$tgl_pengisian);		
		$tgl            = $isi[2];	
		$bln            = $isi[1];	
		$thn            = $isi[0];
		
		$r_kpagi	    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_logbook WHERE id_logbook='$idlogbook' AND status_waktu='pagi'"));
		
		
		$idhaslogbook1  = $r_kpagi['id_has_logbook'];
		$kegiatan1      = $r_kpagi['kegiatan'];
		$waktukegiatan1 = $r_kpagi['waktu_kegiatan'];		
		$waktu1			= explode(" - ",$waktukegiatan1);	
		$mulai1			= $waktu1[0];
		$akhir1			= $waktu1[1];
		
		$r_ksiang	    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_logbook WHERE id_logbook='$idlogbook' AND status_waktu='siang'"));

		$idhaslogbook2  = $r_ksiang['id_has_logbook'];
		$kegiatan2      = $r_ksiang['kegiatan'];
		$waktukegiatan2 = $r_ksiang['waktu_kegiatan'];		
		$waktu2			= explode(" - ",$waktukegiatan2);	
		$mulai2			= $waktu2[0];
		$akhir2			= $waktu2[1];
		
		$r_ksore	    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_logbook WHERE id_logbook='$idlogbook' AND status_waktu='sore'"));
		
		$idhaslogbook3  = $r_ksore['id_has_logbook'];
		$kegiatan3      = $r_ksore['kegiatan'];
		$waktukegiatan3 = $r_ksore['waktu_kegiatan'];		
		$waktu3			= explode(" - ",$waktukegiatan3);	
		$mulai3			= $waktu3[0];
		$akhir3			= $waktu3[1];
		
		$r_kmalam	    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_logbook WHERE id_logbook='$idlogbook' AND status_waktu='malam'"));

		$idhaslogbook4  = $r_kmalam['id_has_logbook'];
		$kegiatan4      = $r_kmalam['kegiatan'];
		$waktukegiatan4 = $r_kmalam['waktu_kegiatan'];		
		$waktu4			= explode(" - ",$waktukegiatan4);	
		$mulai4			= $waktu4[0];
		$akhir4			= $waktu4[1];
		
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
				<li class="<?=((isset($id_logbook))?'hide':'active')?>"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-table"></i> Tampil Data Logbook</a></li>
				<li class="<?=((isset($id_logbook))?'active':'')?>"><a href="#tab2" data-toggle="tab" aria-expanded="true"><?=((isset($id_logbook))?'<i class="fa fa-edit"></i> Ubah Data Logbook':'<i class="fa fa-plus-square"></i> Tambah Data Logbook')?></a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">	
			<div class="tab-pane fade in <?=((isset($id_logbook))?'':'active')?>" id="tab1">
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">Data Logbook Mandiri</h6>
							</div>
							<div class="panel-body">
								<div class="table-info">
								<table class="table table-striped table-bordered table-hover datatable-show-all">
									<thead>
										<tr>
											<th width="10">#</th>
											<!--<th>Nama Peserta</th>-->
											<th width="150">Tanggal Pengisian Logbook</th>
											<th>Catatan Penting</th>
											<th width="150">Status Logbook</th>
											<th width="80" align="center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										
										<?php 
											$no=0;
											
											$q_lbmandiri = mysqli_query($dbconnect,"SELECT * FROM tbl_logbook WHERE id_peserta='$r_peserta[id_peserta]' AND status_logbook='mandiri' ORDER BY tgl_pengisian DESC");
											while($r_lbmandiri = mysqli_fetch_array($q_lbmandiri)){
											
											$statuslb     = $r_lbmandiri['status_logbook'];
											
											if($statuslb == "mandiri"): $tstatuslb = "Logbook Mandiri"; endif;
											
											/** $r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$r_lbmandiri[id_kelompok]'")); **/
											
											$r_tpeserta   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_lbmandiri[id_peserta]'"));
											
											$r_tmahasiswa = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa ='$r_tpeserta[id_mahasiswa]'"));
											
											$no++;
										?>
										<tr>
											<td><?=$no;?></td>
											<!--<td><?=ucwords($r_tmahasiswa['nama_mahasiswa'])?></td>-->
											<td><?=ucwords(tgl_indo($r_lbmandiri['tgl_pengisian']))?></td>
											<td><?=ucfirst($r_lbmandiri['catatan'])?></td>
											<td><?=ucwords($tstatuslb)?></td>
											<td align="center">
												<a target="_blank" data-placement="left"  data-popup="tooltip" title="" data-original-title="Cetak" href="../../setting/include/report.php?logbook=<?=$r_lbmandiri['id_logbook'];?>&statuslb=<?=$statuslb;?>" type="button" class="label label-default"><i class="fa fa-print"></i></a>
												
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" href="?page=lbmandiri&ubah_lb=<?=$r_lbmandiri['id_logbook']?>" type="button" class="label label-primary"><i class="fa fa-edit"></i></a>
												
												<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" onclick='datadel(<?php echo $r_lbmandiri['id_logbook']; ?>,&#39;lbmandiri&#39;)'  data-title='Delete' data-toggle='modal' data-target='#myModal' type="button" class="label label-danger"><i class="fa fa-trash"></i></button>
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
				</div>
			</div>
			<div class="tab-pane fade in <?=((isset($id_logbook))?'active':'')?>" id="tab2">
			<form class="lbmandiri-form" method="POST" enctype="multipart/form-data">
			<?php if(isset($id_logbook)):?>
				<input type="hidden" name="id_logbook" value="<?=$idlogbook;?>" />
				<input type="hidden" name="id_has_logbook1" value="<?=$idhaslogbook1;?>" />
				<input type="hidden" name="id_has_logbook2" value="<?=$idhaslogbook2;?>" />
				<input type="hidden" name="id_has_logbook3" value="<?=$idhaslogbook3;?>" />
				<input type="hidden" name="id_has_logbook4" value="<?=$idhaslogbook4;?>" />
			<?php endif; ?>
				<div class="row">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-5">
								<div class="panel panel-white">
									<div class="panel-heading">
										<h6 class="panel-title">Detail Data</h6>
									</div>
									<div class="panel-body">
										<div class="form-group row">
											<div class="col-md-4">
												<label class="control-label">NIM Peserta</label>
												<input type="text" disabled class="form-control input-sm" value="<?=ucwords($r_mahasiswa['nim'])?>">
											</div>
											<div class="col-md-8">
												<label class="control-label">Nama Peserta</label>
													<input type="text" disabled class="form-control input-sm" value="<?=ucwords($r_mahasiswa['nama_mahasiswa'])?>">
											</div>
										<!--<div class="col-md-6">
												<label class="control-label">Kelompok</label>
												<div class="input-group">
												<span class="input-group-addon" id="basic-addon1">Kelompok</span>
													<input type="text" disabled class="form-control input-sm" value="<?=$r_xkelompok['nama_kelompok']?>">
												</div>
											</div>-->
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label class="control-label">Program Studi</label>
												<input type="text" disabled class="form-control input-sm" value="<?=ucwords($r_cprodi['nama_prodi'])?>">
											</div>
										<!--<div class="col-md-12">
												<label class="control-label">Lokasi KKN</label>
												<textarea rows="1" class="form-control input-sm" disabled type="text">Kel/Desa. <?=ucwords($r_tkel['nama'])?> - <?=ucwords($r_tkota['nama'])?></textarea>
											</div>-->
										</div>
										<div class="form-group row">
										<div class="col-md-12 validation">
											<label class="control-label">Tanggal Pengisian Logbook</label>
											<div class="row">
												<div class="col-md-4 validation">
													<select name="tgl" class="form-control input-sm">
														<option value="<?=((isset($id_logbook))?$tgl:$tgls);?>"><?=((isset($id_logbook))?"✔ ".$tgl:"✔ ".$tgls);?></option>
														<?php for ($n=1; $n <= 31 ; $n++) { ?>
															<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
														<?php } ?>
													</select>
												</div>
												<div class="col-md-4 validation">
													<select name="bln" class="form-control input-sm">
														<option value="<?=((isset($id_logbook))?$bln:$blns);?>"><?=((isset($id_logbook))?"✔ ".getBulan($bln):"✔ ".ucwords(getBulan($blns)));?></option>
														<?php for ($n=1; $n <= 12 ; $n++) { ?>
															<option value="<?php echo $n; ?>" > <?php echo $namaBulan[$n]; ?> </option>
														<?php } // akhir looping?>
													</select>
												</div>
												<div class="col-md-4 validation">
													<select name="thn" class="form-control input-sm">
														<option value="<?=((isset($id_logbook))?$thn:$thns);?>"><?=((isset($id_logbook))?"✔ ".$thn:"✔ ".$thns);?></option>
														<?php  for ($n= $tahun+0; $n <= $tahun+2 ; $n++) { ?>
															<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
										</div>
										<div class="form-group row validation">
											<div class="col-md-12">
												<label class="control-label">Catatan Penting Harian</label>
												<textarea placeholder="Masukan Catatan Penting Harian" class="form-control input-sm" name="catatan" required="required" type="text"><?=((isset($id_logbook))?ucwords($r_ulbmandiri['catatan']):'')?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-7">
								<div class="panel panel-white">
									<div class="panel-heading">
										<h6 class="panel-title">Data Kegiatan</h6>
									</div>
									<div class="panel-body">
										<div class="form-group row">
											<div class="col-md-3">
											<label class="control-label">Waktu Kegiatan</label>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon1">Kegiatan</span>
													<input class="form-control input-sm" name="status_waktu1" value="Pagi" disabled />
												</div>
											</div>
											<div class="col-md-4 validation">
											<label class="control-label">Jam Kegiatan</label>
												<div class="input-group">
													<input id="anytime-time1" class="form-control input-sm" name="mulai1" required="required" type="text" value="<?=((isset($id_logbook))?$mulai1:'')?>" placeholder="Mulai" />
													<span class="input-group-addon" id="basic-addon1">-</span>
													<input id="anytime-time2" class="form-control input-sm" name="akhir1" required="required" type="text" value="<?=((isset($id_logbook))?$akhir1:'')?>" placeholder="Akhir" />
												</div>
											</div>
										</div>
										<div class="form-group row validation">
											<div class="col-md-12">
												<label class="control-label">Rencana Kegiatan</label>
												<textarea placeholder="Masukan Rencana Kegiatan" rows="1" class="form-control input-sm" name="kegiatan1" required="required" type="text"><?=((isset($id_logbook))?ucwords($kegiatan1):'')?></textarea>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-3">
											<label class="control-label">Waktu Kegiatan</label>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon1">Kegiatan</span>
													<input class="form-control input-sm" name="status_waktu2" value="Siang" disabled />
												</div>
											</div>
											<div class="col-md-4 validation">
											<label class="control-label">Jam Kegiatan</label>
												<div class="input-group">
													<input id="anytime-time3" class="form-control input-sm" name="mulai2" required="required" type="text" value="<?=((isset($id_logbook))?$mulai2:'')?>" placeholder="Mulai" />
													<span class="input-group-addon" id="basic-addon1">-</span>
													<input id="anytime-time4" class="form-control input-sm" name="akhir2" required="required" type="text" value="<?=((isset($id_logbook))?$akhir2:'')?>" placeholder="Akhir" />
												</div>
											</div>
										</div>
										<div class="form-group row validation">
											<div class="col-md-12">
												<label class="control-label">Rencana Kegiatan</label>
												<textarea placeholder="Masukan Rencana Kegiatan" rows="1" class="form-control input-sm" name="kegiatan2" required="required" type="text"><?=((isset($id_logbook))?ucwords($kegiatan2):'')?></textarea>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-3">
											<label class="control-label">Waktu Kegiatan</label>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon1">Kegiatan</span>
													<input class="form-control input-sm" name="status_waktu3" value="Sore" disabled />
												</div>
											</div>
											<div class="col-md-4 validation">
											<label class="control-label">Jam Kegiatan</label>
												<div class="input-group">
													<input id="anytime-time5" class="form-control input-sm" name="mulai3" required="required" type="text" value="<?=((isset($id_logbook))?$mulai3:'')?>" placeholder="Mulai" />
													<span class="input-group-addon" id="basic-addon1">-</span>
													<input id="anytime-time6" class="form-control input-sm" name="akhir3" required="required" type="text" value="<?=((isset($id_logbook))?$akhir3:'')?>" placeholder="Akhir" />
												</div>
											</div>
										</div>
										<div class="form-group row validation">
											<div class="col-md-12">
												<label class="control-label">Rencana Kegiatan</label>
												<textarea placeholder="Masukan Rencana Kegiatan" rows="1" class="form-control input-sm" name="kegiatan3" required="required" type="text"><?=((isset($id_logbook))?ucwords($kegiatan3):'')?></textarea>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-3">
											<label class="control-label">Waktu Kegiatan</label>
												<div class="input-group">
													<span class="input-group-addon" id="basic-addon1">Kegiatan</span>
													<input class="form-control input-sm" name="status_waktu4" value="Malam" disabled />
												</div>
											</div>
											<div class="col-md-4 validation">
											<label class="control-label">Jam Kegiatan</label>
												<div class="input-group">
													<input id="anytime-time7" class="form-control input-sm" name="mulai4" required="required" type="text" value="<?=((isset($id_logbook))?$mulai4:'')?>" placeholder="Mulai" />
													<span class="input-group-addon" id="basic-addon1">-</span>
													<input id="anytime-time8" class="form-control input-sm" name="akhir4" required="required" type="text" value="<?=((isset($id_logbook))?$akhir4:'')?>" placeholder="Akhir" />
												</div>
											</div>
										</div>
										<div class="form-group row validation">
											<div class="col-md-12">
												<label class="control-label">Rencana Kegiatan</label>
												<textarea placeholder="Masukan Rencana Kegiatan" rows="1" class="form-control input-sm" name="kegiatan4" required="required" type="text"><?=((isset($id_logbook))?ucwords($kegiatan4):'')?></textarea>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-12">
												<input type="hidden" value="<?=$r_peserta['id_peserta']?>" name="id_peserta" />
												<input type="hidden" value="<?=$r_xkelompok['id_kelompok']?>" name="id_kelompok" />
												<input type="hidden" value="<?=$r_peserta['tahun_kkn']?>" name="tahun_kkn" />
												<input type="hidden" value="mandiri" name="status_logbook" />
												<a href="?page=lbmandiri" class="btn btn-danger btn-sm">Batal Simpan</a>
												<button type="submit" name="simpan_logbook" class="btn btn-sm btn-primary">Simpan Data</button>
											</div>
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