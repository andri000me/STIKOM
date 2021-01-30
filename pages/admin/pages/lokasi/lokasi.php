<?php

	$q_prov = mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov");
		
	if(isset($_GET['ubah_lokasi'])){
		
		$ubah_lokasi   = $_GET['ubah_lokasi'];
		$r_ulokasi     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$ubah_lokasi'"));
		
		$r_uprov 	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_ulokasi[id_provinsi]'"));
								
		$r_ukota 	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_ulokasi[id_kota]'"));
									
		$r_ukec        = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_ulokasi[id_kecamatan]'"));
								
		$r_ukel        = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_ulokasi[id_kelurahan]'"));
							
		$r_umitra      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_ulokasi[id_lokasi]'"));
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
				<li class="<?=((isset($ubah_lokasi))?'hide':(isset($tampil_lokasi))?'hide':'active')?>"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-table"></i> Tampil Lokasi</a></li>
				<li class="<?=((isset($ubah_lokasi))?'':'hide')?>"><a href="?page=lokasi"><i class="fa fa-chevron-circle-left"></i> Kembali</a></li>
				<li class="<?=((isset($ubah_lokasi))?'active':'')?>"><a href="#tab2" data-toggle="tab" aria-expanded="false"><?=((isset($ubah_lokasi))?'<i class="fa fa-edit"></i> Ubah Lokasi':'<i class="fa fa-plus-square"></i> Tambah Lokasi')?></a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
	<div class="tab-content" id="myTabContent">
	
		<div class="tab-pane fade <?=((isset($ubah_lokasi))?'hide':'in active')?>" id="tab1">
		<div class="panel panel-white">
			<div class="panel-heading">
			<h6 class="panel-title">Data Lokasi KKN</h6>
			</div>
			<div class="panel-body">
				<div class="table-info">
					<table class="table table-striped table-bordered table-hover datatable-show-all">
						<thead>
							<tr>
								<th>#</th>
								<th>Lokasi KKN</th>
								<th>Nip</th>
								<th>Nama Mitra</th>
								<th>Agama</th>
								<th>No. Tlp/Hp</th>
								<th>Username</th>
								<th>Confirm Password</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php
						
							$no=0;
							
							$q_tlokasi = mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi");
							while($r_tlokasi = mysqli_fetch_array($q_tlokasi)){
								
								$r_tprov = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
								
								$r_tkota = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
								
								$r_tkec  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
								
								$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
								
								$r_tmitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
								
								$no++;
							
						?>
							<tr>
								<td><?=$no;?></td>
								<td>Prov. <?=ucwords($r_tprov['nama'])?> - <?=ucwords($r_tkota['nama'])?> - Kec. <?=ucwords($r_tkec['nama'])?> - Kel. <?=ucwords($r_tkel['nama'])?></td>
								<td><?=(($r_tmitra['nip'] == 0 || $r_tmitra['nip'] == "-")?'-':$r_tmitra['nip'])?></td>
								<td><?=ucwords(cek_jk($r_tmitra['jk_mitra'])." ".$r_tmitra['nama_mitra'])?></td>
								<td><?=ucwords($r_tmitra['agama_mitra'])?></td>
								<td><?=ucwords($r_tmitra['no_tlp_mitra'])?></td>
								<td><?=ucwords($r_tmitra['username'])?></td>
								<td><?=ucwords($r_tmitra['confirm_password'])?></td>
								<td align="center">
									<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Lihat" href="?page=tampil-lokasi&tampil_lokasi=<?=$r_tlokasi['id_lokasi']?>" type="button" class="label label-success"><i class="fa fa-search-plus"></i></a>
									
									<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" href="?page=lokasi&ubah_lokasi=<?=$r_tlokasi['id_lokasi']?>" type="button" class="label label-primary"><i class="fa fa-edit"></i></a>

									<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" onclick='datadel(<?php echo $r_tlokasi['id_lokasi']; ?>,&#39;lokasi&#39;)'  data-title='Delete' data-toggle='modal' data-target='#myModal' type="button" class="label label-danger"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						<?php } ?>	
						</tbody>
					</table>
				</div>			
			</div>		
		</div>
		</div>
		<div class="tab-pane fade <?=((isset($ubah_lokasi))?'in active':'')?>" id="tab2">
			<form class="lokasi-form" method="post" enctype="multipart/form-data">
			<?php if(isset($ubah_lokasi)):?>
				<input type="hidden" name="id_lokasi" value="<?=$r_ulokasi['id_lokasi'];?>">
				<input type="hidden" name="id_mitra" value="<?=$r_umitra['id_mitra'];?>">
			<?php endif; ?>	
			<div class="row">
				<div class="col-lg-7">
					<div class="panel panel-white">
						<div class="panel-heading">
						<h6 class="panel-title capitalize">Form Lokasi</h6>
						</div>
						<div class="panel-body">	
							<div class="form-group row">
								<div class="col-sm-4 validation">
								<label class="control-label">Provinsi</label>
									<select class="form-control input-sm" name="id_provinsi" id="prop"  onchange="ajaxkota(this.value)" required="required">
										<option value="<?=((isset($ubah_lokasi))?$r_ulokasi['id_provinsi']:'')?>"><?=((isset($ubah_lokasi))?"✔ Prov. ".ucwords($r_uprov['nama']):'Pilih Provinsi')?></option>
										<?php while($r_prov = mysqli_fetch_array($q_prov)):?>
											<option value="<?=$r_prov['id_prov']?>">Prov. <?=ucwords($r_prov['nama'])?></option>
										<?php endwhile; ?>
									</select>							
								</div>	
								<div class="col-sm-4 validation">
								<label class="control-label">Kota/Kabupaten</label>
									<select class="form-control input-sm" name="id_kota" id="kota" onchange="ajaxkec(this.value)" required="required">
										<option value="<?=((isset($ubah_lokasi))?$r_ulokasi['id_kota']:'')?>"><?=((isset($ubah_lokasi))?"✔ ".ucwords($r_ukota['nama']):'Pilih Kota/Kabupaten')?></option>
									</select>							
								</div>	
								<div class="col-sm-4 validation">
								<label class="control-label">Kecamatan</label>
									<select class="form-control input-sm" name="id_kecamatan" id="kec" onchange="ajaxkel(this.value)" required="required">
										<option value="<?=((isset($ubah_lokasi))?$r_ulokasi['id_kecamatan']:'')?>"><?=((isset($ubah_lokasi))?"✔ Kec. ".ucwords($r_ukec['nama']):'Pilih Kecamatan')?></option>
									</select>							
								</div>							
							</div>
							<div class="form-group row validation">
								<div class="col-sm-4">
								<label class="control-label">Kelurahan</label>
									<select class="form-control input-sm" name="id_kelurahan" id="kel" onchange="showCoordinate();" required="required">
									  <option value="<?=((isset($ubah_lokasi))?$r_ulokasi['id_kelurahan']:'')?>"><?=((isset($ubah_lokasi))?"✔ Kel. ".ucwords($r_ukel['nama']):'Pilih Kelurahan/Desa')?></option>
									</select>							
								</div>							
								<div class="col-sm-8">
								<label class="control-label">Latitude - Longitude</label>
									<div class="input-group">
										<input type="text" placeholder="Latitude" readonly required="required" id="lat" name="lat" class="form-control input-sm" value="<?=((isset($ubah_lokasi))?$r_ulokasi['lat']:'')?>">
										<span class="input-group-addon" id="basic-addon1">-</span>
										<input type="text" placeholder="Longitude" readonly required="required" id="lng" name="lng" class="form-control input-sm" value="<?=((isset($ubah_lokasi))?$r_ulokasi['lng']:'')?>">
									</div>								
								</div>							
							</div>
							<div class="form-group row">							
								<div class="col-lg-12">	
									<label class="control-label">Map</label>
									<div id="map-canvas"></div>
								</div>	
							</div>	
						</div>			
					</div>
				</div>
				<div class="col-lg-5">
					<div class="panel panel-white">
						<div class="panel-heading">
						<h6 class="panel-title capitalize">Form Mitra</h6>
						</div>
						<div class="panel-body">	
							<div class="form-group row">	
								<div class="col-lg-6 validation">
								<label class="control-label">NIP</label>
									<input class="form-control input-sm" value="<?=((isset($ubah_lokasi))?ucwords($r_umitra['nip']):'')?>" name="nip" placeholder="Masukan NIP" type="number" required="required" />
								</div>						
							</div>	
							<div class="form-group row">	
								<div class="col-lg-12 validation">
								<label class="control-label">Nama Mitra</label>
									<input class="form-control input-sm" value="<?=((isset($ubah_lokasi))?ucwords($r_umitra['nama_mitra']):'')?>" name="nama_mitra" placeholder="Masukan Nama Pejabat Setempat" type="text" required="required" />
								</div>						
							</div>						
							<div class="form-group row">
								<div class="col-lg-12">
								<label class="control-label">Jenis Kelamin</label>
									<div class="row">
									<div class="col-xs-6">
										<div class="radio radio-danger">
											<input required type="radio" name="jk_mitra" id="radio1" value="laki-laki" <?=((isset($ubah_lokasi) AND $r_umitra['jk_mitra']=='laki-laki')?'checked':'checked');?>>
											<label for="radio1">
												Laki-Laki
											</label>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="radio radio-success">
											<input required type="radio" name="jk_mitra" id="radio2" value="perempuan" <?=((isset($ubah_lokasi) AND $r_umitra['jk_mitra']=='perempuan')?'checked':'');?>>
											<label for="radio2">
												Perempuan
											</label>
										</div>
									</div>
									</div>
								</div>								
							</div>	
							<div class="form-group row">
								<div class="col-md-6 validation">
									<label class="control-label">Agama</label>
									<select required="required" name="agama_mitra" class="form-control input-sm">
										<option value="<?=((isset($ubah_lokasi))?$r_umitra['agama_mitra']:'')?>"><?=((isset($ubah_lokasi))?"✔ ".ucwords($r_umitra['agama_mitra']):'Pilih Agama')?></option>
										<option value="kristen protestan">Kristen Protestan</option>
										<option value="katolik">Katolik</option>
										<option value="islam">Islam</option>
										<option value="hindu">Hindu</option>
										<option value="budha">Budha</option>
										<option value="kong hu chu">Kong Hu Chu</option>
									</select>
								</div>
								<div class="col-lg-6 validation">
								<label class="control-label">No. Tlp/Hp</label>
									<input class="form-control input-sm" name="no_tlp_mitra" placeholder="Masukan No. Tlp/Hp" type="tel" required="required" value="<?=((isset($ubah_lokasi))?ucwords($r_umitra['no_tlp_mitra']):'')?>" />
								</div>							
							</div>						
							<hr>
							<div class="form-group row">
								<div class="col-lg-12">
									<a href="?page=lokasi" type="button" class="btn btn-danger btn-sm"  name="sub" >Batal Simpan</a>
									<input type="submit" class="btn btn-primary btn-sm" value="Simpan Data" name="simpan_lokasi" />
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