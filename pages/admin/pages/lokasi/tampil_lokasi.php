<?php

	if(isset($_GET['tampil_lokasi'])){
	
		$tampil_lokasi = $_GET['tampil_lokasi'];
		
		$r_tlokasi	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$tampil_lokasi'"));
		
		$r_mitra	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
		
		$r_tprov = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
								
		$r_tkota = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
		
		$r_tkec  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
		
		$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
		
		include '../../setting/action/aksi_map.php';
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
				<li class=""><a href="?page=lokasi"><i class="fa fa-chevron-circle-left"></i> Kembali</a></li>
				<li class="active"><a href="#"><i class="fa fa-map"></i> Tampil Lokasi</a></li>
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
										<img src="../../setting/save/mitra/<?=((isset($tampil_lokasi))?cek_foto($r_mitra['foto_mitra']):'default.png')?>" class="picture-pass" id='img-upload'/>
									</div>
								
									<div class="caption text-center">
										<div class="form-group row">
											<div class="col-md-12">
											<div class="content-divider text-muted form-group"><span>Mitra Lapangan</span></span></div>
											<h6 class="text-semibold no-margin" style="font-size:13px;"><?=strtoupper(cek_jk($r_mitra['jk_mitra'])." ".$r_mitra['nama_mitra'])?> <small class="display-block">NIP. <?=(($r_mitra['nip'] == 0 || $r_mitra['nip'] == "-")?'-':$r_mitra['nip'])?></small></h6>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-9">
						<div class="panel panel-white">
							<div class="panel-heading">
							<h6 class="panel-title">Lokasi KKN</h6>
							</div>
							<div id="map-canvas" style="width:100%; height:350px; border:solid #ddd 0px;"></div>
							<div class="table-responsive">
								<table class="table table-noborder table-striped">
									<tr>
										<th><b>LOKASI KKN : PROV. <?=strtoupper($r_tprov['nama'])?> - <?=strtoupper($r_tkota['nama'])?> - KEC. <?=strtoupper($r_tkec['nama'])?> - KEL. <?=strtoupper($r_tkel['nama'])?></b></th>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>