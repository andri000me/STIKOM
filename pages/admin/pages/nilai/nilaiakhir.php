<?php
	
	if(isset($_GET['kelompok'])){
		$id_kelompok  = $_GET['kelompok'];
		$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		
		$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
		$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
			
		$r_tdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
			
		$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

		$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
			
		$r_tdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));
		
		$r_tjadwal = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_jadwal='pembekalan'"));
		
		$r_tlokasi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
	
		$r_tprov   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
								
		$r_tkota   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
		
		$r_tkec    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
		
		$r_tkel    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
		
		$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
		
		$r_tmitra  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
		
		if($r_tprodi['singkatan_prodi']=="TIS1"){
			$tprodi = "TIS1 / <span class='line-through'>SIS1</span>";
		}
		elseif($r_tprodi['singkatan_prodi']=="SIS1"){
			$tprodi = "<span class='line-through'>TIS1</span> / SIS1";
		}
		else{
			$tprodi = "TIS1 / SIS1";
		}
		
	}

?>
<div class="navbar navbar-default navbar-component navbar-xs">
	<ul class="nav navbar-nav visible-xs-block">
		<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="fa fa-bars"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-filter">
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li class=""><a href="?page=detail-kelompok&kelompok=<?=$id_kelompok;?>"><i class="fa fa-search-plus"></i> Detail Kelompok</a></li>
				<li class="active"><a href=""><i class="fa fa-pencil"></i> Penilaian</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade in active" id="tab1">
					<div class="col-sm-3">
						<div class="row">
							<div class="col-sm-12">
										<!-- Navigation -->
				    	<div class="panel panel-white">
							<div class="border-left-warning border-left-lg">
							<div class="panel-heading" style="margin-bottom:-9px;">
								<h6 class="panel-title">Navigasi Menu</h6>
							</div>

							<div class="list-group no-border no-padding-top">
							<div class="list-group-divider"></div>
								<a href="?page=nilai-pb&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Presentasi Pembekalan</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-uk&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Usulan Kegiatan</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-km&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Kinerja Mahasiswa</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-pl&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Pelaksanaan Program</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-lpk&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Laporan Pelaksanaan Kegiatan</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-akhir&kelompok=<?=$id_kelompok;?>" class="list-group-item active"><i class="fa fa-file-text-o"></i> Evaluasi Akhir</a>
							</div>
							</div>
						</div>
							</div>
						</div>
					</div>
					<div class="col-sm-9">
					<div class="row">
					<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade in active" id="anggota">
					<div class="col-sm-12">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1" aria-expanded="false" class="collapsed">Info Kelompok</a>
								</h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li>
											<a data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group1" aria-expanded="false" class="collapsed"><i class="fa fa-chevron-down"></i></a>
										</li>
									</ul>
								</div>
							</div>
							<div id="accordion-control-right-group1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
							<div class="panel-body">
							<div class="table-responsive" style="border:0px;">
								<table class="table table-nobor-monev marbot10">
									<tr>
										<td>
											<table class="table table-nobor-monev">
												<tr>
													<th width="110">Program Studi</th>
													<th width="10">:</th>
													<td><?=$tprodi;?></td>
												</tr>
												<tr>
													<th width="110">Kelompok Ke-</th>
													<th width="10">:</th>
													<td><?=$r_tkelompok['nama_kelompok']?></td>
												</tr>
											</table>
										</td>
										<td>
											<table class="table table-nobor-monev">
												<tr>
													<th width="190">Dosen Pembimbing Lapangan 1</th>
													<th width="10">:</th>
													<td width="80"><?=$r_tdosen1['nidn'];?></td>
													<th width="10">/*</th>
													<td><?=strtoupper($r_tdosen1['nama_dosen']);?></td>
												</tr>
												<tr>
													<th width="190">Dosen Pembimbing Lapangan 2</th>
													<th width="10">:</th>
													<td width="80"><?=$r_tdosen2['nidn'];?></td>
													<th width="10">/*</th>
													<td><?=strtoupper($r_tdosen2['nama_dosen']);?></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table class="table table-nobor-monev">
												<tr>
													<th width="110">Desa/Kelurahan</th>
													<th width="10">:</th>
													<td><?=strtoupper($r_tkel['nama'])?></td>
												</tr>
												<tr>
													<th width="110">Kecamatan</th>
													<th width="10">:</th>
													<td><?=strtoupper($r_tkec['nama'])?></td>
												</tr>
												<tr>
													<th width="110">Kabupaten/Kota</th>
													<th width="10">:</th>
													<td><?=strtoupper($r_tkota['nama'])?></td>
												</tr>
											</table>
										</td>
										<td>
											<table class="table table-nobor-monev">
												<tr>
													<th width="190">Mitra Lapangan</th>
													<th width="10">:</th>
													<td><?=strtoupper($r_tmitra['nama_mitra']);?></td>
												</tr>
												<tr><td colspan="3" style="color:#fff;">-</td></tr>
												<tr><td colspan="3" style="color:#fff;">-</td></tr>
											</table>
										</td>
									</tr>
								</table>
							</div>		
							</div>		
							</div>		
						</div>		
					</div>
					<div class="col-sm-12">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">Nilai Presentasi Pembekalan</h6>
								<div class="heading-elements">
									<a target="_blank" href="../../setting/include/report.php?nakelompok=<?=$id_kelompok;?>" type="button" class="btn btn-default btn-sm heading-btn"><i class="fa fa-print" style="margin-top:-4px;"></i> Cetak Nilai</a>
								</div>
							</div>
							<div class="panel-body">
									<div class="table-info">
										<table class="table table-nobor-monev marbot10">
											<tr>
												<td>
													<table class="table table-nobor-monev">
														<tr>
															<th colspan="10">EVALUASI AKHIR MAHASISWA KKM-PPM</th>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</div>
									<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th rowspan="2" width="20">No.</th>
												<th rowspan="2" width="120">NIM</th>
												<th rowspan="2" width="200">Nama Mahasiswa</th>
												<th colspan="6"><center>Nilai</center></th>
												<th rowspan="2"><center>Total</center></th>
												<th rowspan="3"><center>Nilai Mutu</center></th>
											</tr>
											<tr>
												<th><center>PB</center></th>
												<th><center>UK</center></th>
												<th><center>KM-DS*</center></th>
												<th><center>KM-KS*</center></th>
												<th><center>PL</center></th>
												<th><center>LPK</center></th>
											</tr>
											<tr>
												<th colspan="3"><center>Bobot Nilai (Poin) Maksimum</center></th>
												<th><center>10%</center></th>
												<th><center>10%</center></th>
												<th><center>15%</center></th>
												<th><center>15%</center></th>
												<th><center>30%</center></th>
												<th><center>20%</center></th>
												<th><center>100%</center></th>
											</tr>
										</thead>
										<tbody>
										<?php
											$no=0;
											
											$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta,tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
							
											while($r_ypeserta = mysqli_fetch_array($q_ypeserta)){
											
											/***************** NILAI PB *****************/
											
											$r_nilaipb_dpl1	= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pb WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='dpl1'"));
											
											$r_nilaipb_dpl2	= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pb WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='dpl2'"));
											
											$nilaidpl1      = $r_nilaipb_dpl1['nilai_pb'];
											$nilaidpl2      = $r_nilaipb_dpl2['nilai_pb'];
											
											if(empty($nilaidpl1) AND empty($nilaidpl2)){
												$totalnilai = "";
											}
											elseif(!empty($nilaidpl1) AND empty($nilaidpl2)){
												$totalnilai = "";
											}	
											elseif(empty($nilaidpl1) AND !empty($nilaidpl2)){
												$totalnilai = "";
											}	
											elseif(!empty($nilaidpl1) AND !empty($nilaidpl2)){
												$totalnilai = ($nilaidpl1+$nilaidpl2)/2;
											}
											else{
												$totalnilai = "";
											}
												
											/***************** NILAI UK *****************/
																	
											$r_nilaiukd1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl1' AND status_nilai='nilaiuk'"));

											$r_nilaiukd2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl2' AND status_nilai='nilaiuk'"));
											
											$d1nilai1  = $r_nilaiukd1['nilai1'];
											$d1hnilai1 = ($d1nilai1*40)/100;
											
											$d2nilai1  = $r_nilaiukd2['nilai1'];
											$d2hnilai1 = ($d2nilai1*40)/100;
											
											$d1nilai2  = $r_nilaiukd1['nilai2'];
											$d1hnilai2 = ($d1nilai2*30)/100;
											
											$d2nilai2  = $r_nilaiukd2['nilai2'];
											$d2hnilai2 = ($d2nilai2*30)/100;
											
											$d1nilai3  = $r_nilaiukd1['nilai3'];
											$d1hnilai3 = ($d1nilai3*30)/100;
											
											$d2nilai3  = $r_nilaiukd2['nilai3'];
											$d2hnilai3 = ($d2nilai3*30)/100;
											
											$d1tnilai  = $d1hnilai1+$d1hnilai2+$d1hnilai3;
											
											$d2tnilai  = $d2hnilai1+$d2hnilai2+$d2hnilai3;
											
											if($d1tnilai==0 AND $d2tnilai==0){
												$gnilai = "";
											}
											elseif($d1tnilai==0 AND $d2tnilai!==0){
												$gnilai = "";
											}
											elseif($d1tnilai!==0 AND $d2tnilai==0){
												$gnilai = "";
											}
											elseif($d1tnilai!== 0 AND $d2tnilai!== 0){
												$gnilai = ($d1tnilai+$d2tnilai)/2;
											}
											else{
												$gnilai = "";
											}
																	
											/***************** NILAI KM MONEV 1 *****************/
											
											$r_monev1_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev1'"));
											
											$r_monev1_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev1'"));
											
											
											$m1_nilaids_dpl1 = $r_monev1_dpl1['nilai_ds'];
											$m1_nilaids_dpl2 = $r_monev1_dpl2['nilai_ds'];
																
											$m1_nilaiks_dpl1 = $r_monev1_dpl1['nilai_ks'];
											$m1_nilaiks_dpl2 = $r_monev1_dpl2['nilai_ks'];
											
											/***************** NILAI KM-DS MONEV 1 *****************/
											if(empty($m1_nilaids_dpl1) AND empty($m1_nilaids_dpl2)){
												$tm1_nilaids = "";
											}
											elseif(!empty($m1_nilaids_dpl1) AND empty($m1_nilaids_dpl2)){
												$tm1_nilaids = "";
											}
											elseif(empty($m1_nilaids_dpl1) AND !empty($m1_nilaids_dpl2)){
												$tm1_nilaids = "";
											}
											elseif(!empty($m1_nilaids_dpl1) AND !empty($m1_nilaids_dpl2)){
												$tm1_nilaids = ($m1_nilaids_dpl1+$m1_nilaids_dpl2)/2;
											}
											else{
												$tm1_nilaids = "";
											}
											/***************** NILAI KM-KS MONEV 1 *****************/
											if(empty($m1_nilaiks_dpl1) AND empty($m1_nilaiks_dpl2)){
												$tm1_nilaiks = "";
											}
											elseif(!empty($m1_nilaiks_dpl1) AND empty($m1_nilaiks_dpl2)){
												$tm1_nilaiks = "";
											}
											elseif(empty($m1_nilaiks_dpl1) AND !empty($m1_nilaiks_dpl2)){
												$tm1_nilaiks = "";
											}
											elseif(!empty($m1_nilaiks_dpl1) AND !empty($m1_nilaiks_dpl2)){
												$tm1_nilaiks = ($m1_nilaiks_dpl1+$m1_nilaiks_dpl2)/2;
											}
											else{
												$tm1_nilaiks = "";
											}
											
											/***************** NILAI KM MONEV 2 *****************/
											
											$r_monev2_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev2'"));
											
											$r_monev2_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev2'"));
											
											
											$m2_nilaids_dpl1 = $r_monev2_dpl1['nilai_ds'];
											$m2_nilaids_dpl2 = $r_monev2_dpl2['nilai_ds'];
																
											$m2_nilaiks_dpl1 = $r_monev2_dpl1['nilai_ks'];
											$m2_nilaiks_dpl2 = $r_monev2_dpl2['nilai_ks'];
											
											/***************** NILAI KM-DS MONEV 2 *****************/
											if(empty($m2_nilaids_dpl1) AND empty($m2_nilaids_dpl2)){
												$tm2_nilaids = "";
											}
											elseif(!empty($m2_nilaids_dpl1) AND empty($m2_nilaids_dpl2)){
												$tm2_nilaids = "";
											}
											elseif(empty($m2_nilaids_dpl1) AND !empty($m2_nilaids_dpl2)){
												$tm2_nilaids = "";
											}
											elseif(!empty($m2_nilaids_dpl1) AND !empty($m2_nilaids_dpl2)){
												$tm2_nilaids = ($m2_nilaids_dpl1+$m2_nilaids_dpl2)/2;
											}
											else{
												$tm2_nilaids = "";
											}
											/***************** NILAI KM-KS MONEV 2 *****************/
											if(empty($m2_nilaiks_dpl1) AND empty($m2_nilaiks_dpl2)){
												$tm2_nilaiks = "";
											}
											elseif(!empty($m2_nilaiks_dpl1) AND empty($m2_nilaiks_dpl2)){
												$tm2_nilaiks = "";
											}
											elseif(empty($m2_nilaiks_dpl1) AND !empty($m2_nilaiks_dpl2)){
												$tm2_nilaiks = "";
											}
											elseif(!empty($m2_nilaiks_dpl1) AND !empty($m2_nilaiks_dpl2)){
												$tm2_nilaiks = ($m2_nilaiks_dpl1+$m2_nilaiks_dpl2)/2;
											}
											else{
												$tm2_nilaiks = "";
											}
											
											/***************** NILAI KM MONEV 3 *****************/
											
											$r_monev3_dpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev3'"));
											
											$r_monev3_dpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev3'"));
											
											
											$m3_nilaids_dpl1 = $r_monev3_dpl1['nilai_ds'];
											$m3_nilaids_dpl2 = $r_monev3_dpl2['nilai_ds'];
																
											$m3_nilaiks_dpl1 = $r_monev3_dpl1['nilai_ks'];
											$m3_nilaiks_dpl2 = $r_monev3_dpl2['nilai_ks'];
											
											/***************** NILAI KM-DS MONEV 3 *****************/
											if(empty($m3_nilaids_dpl1) AND empty($m3_nilaids_dpl2)){
												$tm3_nilaids = "";
											}
											elseif(!empty($m3_nilaids_dpl1) AND empty($m3_nilaids_dpl2)){
												$tm3_nilaids = "";
											}
											elseif(empty($m3_nilaids_dpl1) AND !empty($m3_nilaids_dpl2)){
												$tm3_nilaids = "";
											}
											elseif(!empty($m3_nilaids_dpl1) AND !empty($m3_nilaids_dpl2)){
												$tm3_nilaids = ($m3_nilaids_dpl1+$m3_nilaids_dpl2)/2;
											}
											else{
												$tm3_nilaids = "";
											}
											/***************** NILAI KM-KS MONEV 3 *****************/
											if(empty($m3_nilaiks_dpl1) AND empty($m3_nilaiks_dpl2)){
												$tm3_nilaiks = "";
											}
											elseif(!empty($m3_nilaiks_dpl1) AND empty($m3_nilaiks_dpl2)){
												$tm3_nilaiks = "";
											}
											elseif(empty($m3_nilaiks_dpl1) AND !empty($m3_nilaiks_dpl2)){
												$tm3_nilaiks = "";
											}
											elseif(!empty($m3_nilaiks_dpl1) AND !empty($m3_nilaiks_dpl2)){
												$tm3_nilaiks = ($m3_nilaiks_dpl1+$m3_nilaiks_dpl2)/2;
											}
											else{
												$tm3_nilaiks = "";
											}
											
											/***************** TOTAL NILAI KM-DS *****************/
											
											if($tm1_nilaids==0 AND $tm2_nilaids==0 AND $tm3_nilaids==0){
												$g_nilaids = "";
											}
											elseif($tm1_nilaids!==0 AND $tm2_nilaids==0 AND $tm3_nilaids==0){
												$g_nilaids = "";
											}
											elseif($tm1_nilaids==0 AND $tm2_nilaids!==0 AND $tm3_nilaids==0){
												$g_nilaids = "";
											}
											elseif($tm1_nilaids==0 AND $tm2_nilaids==0 AND $tm3_nilaids!==0){
												$g_nilaids = "";
											}
											elseif($tm1_nilaids!==0 AND $tm2_nilaids!==0 AND $tm3_nilaids==0){
												$g_nilaids = "";
											}
											elseif($tm1_nilaids==0 AND $tm2_nilaids!==0 AND $tm3_nilaids!==0){
												$g_nilaids = "";
											}
											elseif($tm1_nilaids!==0 AND $tm2_nilaids==0 AND $tm3_nilaids!==0){
												$g_nilaids = "";
											}
											elseif($tm1_nilaids!==0 AND $tm2_nilaids==!0 AND $tm3_nilaids!==0){
												$g_nilaids = ($tm1_nilaids+$tm2_nilaids+$tm3_nilaids)/3;
											}
											else{
												$g_nilaids = "";
											}
											
											/***************** TOTAL NILAI KM-KS *****************/
											
											if($tm1_nilaiks==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks==0){
												$g_nilaiks = "";
											}
											elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks==0){
												$g_nilaiks = "";
											}
											elseif($tm1_nilaiks==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks==0){
												$g_nilaiks = "";
											}
											elseif($tm1_nilaiks==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks!==0){
												$g_nilaiks = "";
											}
											elseif($tm1_nilaiks!==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks==0){
												$g_nilaiks = "";
											}
											elseif($tm1_nilaiks==0 AND $tm2_nilaiks!==0 AND $tm3_nilaiks!==0){
												$g_nilaiks = "";
											}
											elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==0 AND $tm3_nilaiks!==0){
												$g_nilaiks = "";
											}
											elseif($tm1_nilaiks!==0 AND $tm2_nilaiks==!0 AND $tm3_nilaiks!==0){
												$g_nilaiks = ($tm1_nilaiks+$tm2_nilaiks+$tm3_nilaiks)/3;
											}
											else{
												$g_nilaiks = "";
											}
											
											/***************** NILAI KM MITRA MONEV 1 *****************/
											
											$r_monev1_mitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='mitra' AND tbl_jadwal.status_jadwal='monev1'"));
													
											$m1_nilaids_mitra = $r_monev1_mitra['nilai_ds'];										
											$m1_nilaiks_mitra = $r_monev1_mitra['nilai_ks'];
											
											/***************** NILAI KM MITRA MONEV 2 *****************/
											
											$r_monev2_mitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='mitra' AND tbl_jadwal.status_jadwal='monev2'"));
													
											$m2_nilaids_mitra = $r_monev2_mitra['nilai_ds'];										
											$m2_nilaiks_mitra = $r_monev2_mitra['nilai_ks'];
											
											/***************** NILAI KM MITRA MONEV 3 *****************/
											
											$r_monev3_mitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_km.id_nilai, tbl_nilai_km.id_jadwal, tbl_nilai_km.id_peserta, tbl_nilai_km.nilai_ds, tbl_nilai_km.nilai_ks, tbl_nilai_km.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_km NATURAL JOIN tbl_jadwal WHERE tbl_nilai_km.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_km.status_penilai='mitra' AND tbl_jadwal.status_jadwal='monev3'"));
													
											$m3_nilaids_mitra = $r_monev3_mitra['nilai_ds'];										
											$m3_nilaiks_mitra = $r_monev3_mitra['nilai_ks'];
											
											/***************** NILAI KM-DS MITRA *****************/
											
											if($m1_nilaids_mitra==0 AND $m2_nilaids_mitra==0 AND $m3_nilaids_mitra==0){
												$g_nilaids_mitra = "";
											}
											elseif($m1_nilaids_mitra!==0 AND $m2_nilaids_mitra==0 AND $m3_nilaids_mitra==0){
												$g_nilaids_mitra = "";
											}
											elseif($m1_nilaids_mitra==0 AND $m2_nilaids_mitra!==0 AND $m3_nilaids_mitra==0){
												$g_nilaids_mitra = "";
											}
											elseif($m1_nilaids_mitra==0 AND $m2_nilaids_mitra==0 AND $m3_nilaids_mitra!==0){
												$g_nilaids_mitra = "";
											}
											elseif($m1_nilaids_mitra!==0 AND $m2_nilaids_mitra==0 AND $m3_nilaids_mitra!==0){
												$g_nilaids_mitra = "";
											}
											elseif($m1_nilaids_mitra!==0 AND $m2_nilaids_mitra!==0 AND $m3_nilaids_mitra==0){
												$g_nilaids_mitra = "";
											}
											elseif($m1_nilaids_mitra==0 AND $m2_nilaids_mitra!==0 AND $m3_nilaids_mitra!==0){
												$g_nilaids_mitra = "";
											}
											elseif($m1_nilaids_mitra!==0 AND $m2_nilaids_mitra!==0 AND $m3_nilaids_mitra!==0){
												$g_nilaids_mitra = ($m1_nilaids_mitra+$m2_nilaids_mitra+$m3_nilaids_mitra)/3;
											}else{
												$g_nilaids_mitra = "";
											}
											
											/***************** NILAI KM-KS MITRA *****************/
											
											if($m1_nilaiks_mitra==0 AND $m2_nilaiks_mitra==0 AND $m3_nilaiks_mitra==0){
												$g_nilaiks_mitra = "";
											}
											elseif($m1_nilaiks_mitra!==0 AND $m2_nilaiks_mitra==0 AND $m3_nilaiks_mitra==0){
												$g_nilaiks_mitra = "";
											}
											elseif($m1_nilaiks_mitra==0 AND $m2_nilaiks_mitra!==0 AND $m3_nilaiks_mitra==0){
												$g_nilaiks_mitra = "";
											}
											elseif($m1_nilaiks_mitra==0 AND $m2_nilaiks_mitra==0 AND $m3_nilaiks_mitra!==0){
												$g_nilaiks_mitra = "";
											}
											elseif($m1_nilaiks_mitra!==0 AND $m2_nilaiks_mitra==0 AND $m3_nilaiks_mitra!==0){
												$g_nilaiks_mitra = "";
											}
											elseif($m1_nilaiks_mitra!==0 AND $m2_nilaiks_mitra!==0 AND $m3_nilaiks_mitra==0){
												$g_nilaiks_mitra = "";
											}
											elseif($m1_nilaiks_mitra==0 AND $m2_nilaiks_mitra!==0 AND $m3_nilaiks_mitra!==0){
												$g_nilaiks_mitra = "";
											}
											elseif($m1_nilaiks_mitra!==0 AND $m2_nilaiks_mitra!==0 AND $m3_nilaiks_mitra!==0){
												$g_nilaiks_mitra = ($m1_nilaiks_mitra+$m2_nilaiks_mitra+$m3_nilaiks_mitra)/3;
											}else{
												$g_nilaiks_mitra = "";
											}
											
											/***************** NILAI KM GAMBUNGAN *****************/

											$ds_dpl    = ($g_nilaids*50)/100;
											$ds_mitra  = ($g_nilaids_mitra*50)/100;

											$ks_dpl    = ($g_nilaiks*50)/100;
											$ks_mitra  = ($g_nilaiks_mitra*50)/100;
											
											if($ds_dpl == 0 AND $ds_mitra == 0){
												$tnilai_ds = "";
											}
											elseif($ds_dpl !== 0 AND $ds_mitra == 0){
												$tnilai_ds = "";
											}
											elseif($ds_dpl == 0 AND $ds_mitra !== 0){
												$tnilai_ds = "";
											}
											elseif($ds_dpl !== 0 AND $ds_mitra !== 0){
												$tnilai_ds = $ds_dpl+$ds_mitra;
											}
											else{
												$tnilai_ds = "";
											}
											
											if($ks_dpl == 0 AND $ks_mitra == 0){
												$tnilai_ks = "";
											}
											elseif($ks_dpl !== 0 AND $ks_mitra == 0){
												$tnilai_ks = "";
											}
											elseif($ks_dpl == 0 AND $ks_mitra !== 0){
												$tnilai_ks = "";
											}
											elseif($ks_dpl !== 0 AND $ks_mitra !== 0){
												$tnilai_ks = $ks_dpl+$ks_mitra;
											}
											else{
												$tnilai_ks = "";
											}
											
											/***************** NILAI PL *****************/

											$r_monev1_npl_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev1'"));
												
											$r_monev1_npl_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev1'"));
											
											/***************** NILAI PL MONEV 1 *****************/
											
											$m1_nilaipl_dpl1 = $r_monev1_npl_dpl1['nilai_pl'];
											$m1_nilaipl_dpl2 = $r_monev1_npl_dpl2['nilai_pl'];
											
											if(empty($m1_nilaipl_dpl1) AND empty($m1_nilaipl_dpl2)){
												$tm1_nilaipl = "";
											}
											elseif(!empty($m1_nilaipl_dpl1) AND empty($m1_nilaipl_dpl2)){
												$tm1_nilaipl = "";
											}
											elseif(empty($m1_nilaipl_dpl1) AND !empty($m1_nilaipl_dpl2)){
												$tm1_nilaipl = "";
											}
											elseif(!empty($m1_nilaipl_dpl1) AND !empty($m1_nilaipl_dpl2)){
												$tm1_nilaipl = ($m1_nilaipl_dpl1+$m1_nilaipl_dpl2)/2;
											}
											else{
												$tm1_nilaipl = "";
											}
											
											/*****************************************************************************************
												MONEV 2
											******************************************************************************************/
											
											$r_monev2_npl_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev2'"));
											
											$r_monev2_npl_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev2'"));
											
											/***************** NILAI PL MONEV 2 *****************/
											
											$m2_nilaipl_dpl1 = $r_monev2_npl_dpl1['nilai_pl'];
											$m2_nilaipl_dpl2 = $r_monev2_npl_dpl2['nilai_pl'];
											
											if(empty($m2_nilaipl_dpl1) AND empty($m2_nilaipl_dpl2)){
												$tm2_nilaipl = "";
											}
											elseif(!empty($m2_nilaipl_dpl1) AND empty($m2_nilaipl_dpl2)){
												$tm2_nilaipl = "";
											}
											elseif(empty($m2_nilaipl_dpl1) AND !empty($m2_nilaipl_dpl2)){
												$tm2_nilaipl = "";
											}
											elseif(!empty($m2_nilaipl_dpl1) AND !empty($m2_nilaipl_dpl2)){
												$tm2_nilaipl = ($m2_nilaipl_dpl1+$m2_nilaipl_dpl2)/2;
											}
											else{
												$tm2_nilaipl = "";
											}
											
											/***************** NILAI PL MONEV 2 *****************/
											
											$r_monev3_npl_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl1' AND tbl_jadwal.status_jadwal='monev3'"));
											
											$r_monev3_npl_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_nilai_pl.id_nilai, tbl_nilai_pl.id_jadwal, tbl_nilai_pl.id_peserta, tbl_nilai_pl.nilai_pl, tbl_nilai_pl.status_penilai, tbl_jadwal.id_jadwal, tbl_jadwal.status_jadwal FROM tbl_nilai_pl NATURAL JOIN tbl_jadwal WHERE tbl_nilai_pl.id_peserta='$r_ypeserta[id_peserta]' AND tbl_nilai_pl.status_penilai='dpl2' AND tbl_jadwal.status_jadwal='monev3'"));
											
											/***************** NILAI PL MONEV 3 *****************/
											
											$m3_nilaipl_dpl1 = $r_monev3_npl_dpl1['nilai_pl'];
											$m3_nilaipl_dpl2 = $r_monev3_npl_dpl2['nilai_pl'];
											
											if(empty($m3_nilaipl_dpl1) AND empty($m3_nilaipl_dpl2)){
												$tm3_nilaipl = "";
											}
											elseif(!empty($m3_nilaipl_dpl1) AND empty($m3_nilaipl_dpl2)){
												$tm3_nilaipl = "";
											}
											elseif(empty($m3_nilaipl_dpl1) AND !empty($m3_nilaipl_dpl2)){
												$tm3_nilaipl = "";
											}
											elseif(!empty($m3_nilaipl_dpl1) AND !empty($m3_nilaipl_dpl2)){
												$tm3_nilaipl = ($m3_nilaipl_dpl1+$m3_nilaipl_dpl2)/2;
											}
											else{
												$tm3_nilaipl = "";
											}
											
											/***************** NILAI GABUNGAN PL *****************/
											
											if($tm1_nilaipl==0 AND $tm2_nilaipl==0 AND $tm3_nilaipl==0){
												$g_nilaipl = "";
											}
											elseif($tm1_nilaipl!==0 AND $tm2_nilaipl==0 AND $tm3_nilaipl==0){
												$g_nilaipl = "";
											}
											elseif($tm1_nilaipl==0 AND $tm2_nilaipl!==0 AND $tm3_nilaipl==0){
												$g_nilaipl = "";
											}
											elseif($tm1_nilaipl==0 AND $tm2_nilaipl==0 AND $tm3_nilaipl!==0){
												$g_nilaipl = "";
											}
											elseif($tm1_nilaipl!==0 AND $tm2_nilaipl==0 AND $tm3_nilaipl!==0){
												$g_nilaipl = "";
											}
											elseif($tm1_nilaipl!==0 AND $tm2_nilaipl!==0 AND $tm3_nilaipl==0){
												$g_nilaipl = "";
											}
											elseif($tm1_nilaipl==0 AND $tm2_nilaipl!==0 AND $tm3_nilaipl!==0){
												$g_nilaipl = "";
											}
											elseif($tm1_nilaipl!==0 AND $tm2_nilaipl!==0 AND $tm3_nilaipl!==0){
												$g_nilaipl = ($tm1_nilaipl+$tm2_nilaipl+$tm3_nilaipl)/3;
											}
											else{
												$g_nilaipl = "";
											}
											
											/***************** NILAI LPK *****************/
											
											$r_nilailpkd1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl1' AND status_nilai='nilailpk'"));
											
											$r_nilailpkd2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_penilai='dpl2' AND status_nilai='nilailpk'"));
											
											$d1nilailpk1  = $r_nilailpkd1['nilai1'];
											$d1hnilailpk1 = ($d1nilailpk1*40)/100;
											
											$d2nilailpk1  = $r_nilailpkd2['nilai1'];
											$d2hnilailpk1 = ($d2nilailpk1*40)/100;
											
											$d1nilailpk2  = $r_nilailpkd1['nilai2'];
											$d1hnilailpk2 = ($d1nilailpk2*30)/100;
											
											$d2nilailpk2  = $r_nilailpkd2['nilai2'];
											$d2hnilailpk2 = ($d2nilailpk2*30)/100;
											
											$d1nilailpk3  = $r_nilailpkd1['nilai3'];
											$d1hnilailpk3 = ($d1nilailpk3*30)/100;
											
											$d2nilailpk3  = $r_nilailpkd2['nilai3'];
											$d2hnilailpk3 = ($d2nilailpk3*30)/100;
											
											$d1tnilailpk  = $d1hnilailpk1+$d1hnilailpk2+$d1hnilailpk3;
											
											$d2tnilailpk  = $d2hnilailpk1+$d2hnilailpk2+$d2hnilailpk3;
											
											if($d1tnilailpk==0 AND $d2tnilailpk==0){
												$gnilailpk = "";
											}
											elseif($d1tnilailpk==0 AND $d2tnilailpk!==0){
												$gnilailpk = "";
											}
											elseif($d1tnilailpk!==0 AND $d2tnilailpk==0){
												$gnilailpk = "";
											}
											elseif($d1tnilailpk!== 0 AND $d2tnilailpk!== 0){
												$gnilailpk = ($d1tnilailpk+$d2tnilailpk)/2;
											}
											else{
												$gnilailpk = "";
											}
											
											/***************** TOTAL NILAI *****************/
											
											$pb_nilai    = ($totalnilai*10)/100;
											
											$uk_nilai    = ($gnilai*10)/100;
											
											$km_ds_nilai = ($tnilai_ds*15)/100;
											
											$km_ks_nilai = ($tnilai_ks*15)/100;
											
											$pl_nilai    = ($g_nilaipl*30)/100;
											
											$lpk_nilai   = ($gnilailpk*20)/100;
											
											if($pb_nilai == 0 AND $uk_nilai == 0){
												$tgnilai1 = "";
											}
											elseif($pb_nilai !== 0 AND $uk_nilai == 0){
												$tgnilai1 = "";
											}
											elseif($pb_nilai == 0 AND $uk_nilai !== 0){
												$tgnilai1 = "";
											}
											elseif($pb_nilai !== 0 AND $uk_nilai !== 0){
												$tgnilai1 = $pb_nilai+$uk_nilai;
											}
											else{
												$tgnilai1 = "";
											}
											
											if($km_ds_nilai == 0 AND $km_ks_nilai == 0){
												$tgnilai2 = "";
											}
											elseif($km_ds_nilai !== 0 AND $km_ks_nilai == 0){
												$tgnilai2 = "";
											}
											elseif($km_ds_nilai == 0 AND $km_ks_nilai !== 0){
												$tgnilai2 = "";
											}
											elseif($km_ds_nilai !== 0 AND $km_ks_nilai !== 0){
												$tgnilai2 = $km_ds_nilai+$km_ks_nilai;
											}
											else{
												$tgnilai2 = "";
											}
											
											if($pl_nilai == 0 AND $lpk_nilai == 0){
												$tgnilai3 = "";
											}
											elseif($pl_nilai !== 0 AND $lpk_nilai == 0){
												$tgnilai3 = "";
											}
											elseif($pl_nilai == 0 AND $lpk_nilai !== 0){
												$tgnilai3 = "";
											}
											elseif($pl_nilai !== 0 AND $lpk_nilai !== 0){
												$tgnilai3 = $pl_nilai+$lpk_nilai;
											}
											else{
												$tgnilai3 = "";
											}
											
											if($tgnilai1 == 0 AND $tgnilai2 == 0 AND $tgnilai3 == 0){
												$nilai_akhir = "";
											}
											elseif($tgnilai1 !== 0 AND $tgnilai2 == 0 AND $tgnilai3 == 0){
												$nilai_akhir = "";
											}
											elseif($tgnilai1 == 0 AND $tgnilai2 !== 0 AND $tgnilai3 == 0){
												$nilai_akhir = "";
											}
											elseif($tgnilai1 == 0 AND $tgnilai2 == 0 AND $tgnilai3 !== 0){
												$nilai_akhir = "";
											}
											elseif($tgnilai1 !== 0 AND $tgnilai2 !== 0 AND $tgnilai3 == 0){
												$nilai_akhir = "";
											}
											elseif($tgnilai1 == 0 AND $tgnilai2 !== 0 AND $tgnilai3 !== 0){
												$nilai_akhir = "";
											}
											elseif($tgnilai1 !== 0 AND $tgnilai2 == 0 AND $tgnilai3 !== 0){
												$nilai_akhir = "";
											}
											elseif($tgnilai1 !== 0 AND $tgnilai2 !== 0 AND $tgnilai3 !== 0){
												$nilai_akhir = $tgnilai1+$tgnilai2+$tgnilai3;
											}
											else{
												$nilai_akhir = "";
											}
											
											$no++;	
										?>
											<tr>
												<td><?=$no;?></td>
												<td><?=$r_ypeserta['nim']?></td>
												<td><?=ucwords($r_ypeserta['nama_mahasiswa'])?></td>
												<td><center><?=(($pb_nilai == 0)?'':potong_nilai($pb_nilai))?></center></td>
												<td><center><?=(($uk_nilai == 0)?'':potong_nilai($uk_nilai))?></center></td>
												<td><center><?=(($km_ds_nilai == 0)?'':potong_nilai($km_ds_nilai))?></center></td>
												<td><center><?=(($km_ks_nilai == 0)?'':potong_nilai($km_ks_nilai))?></center></td>
												<td><center><?=(($pl_nilai == 0)?'':potong_nilai($pl_nilai))?></center></td>
												<td><center><?=(($lpk_nilai == 0)?'':potong_nilai($lpk_nilai))?></center></td>
												<td><center><b><?=(($nilai_akhir == 0)?'':potong_nilai($nilai_akhir))?></b></center></td>
												<td><center><b><?=(($nilai_akhir == 0)?'':nilai_mutu($nilai_akhir))?></b></center></td>
											</tr>
										<?php } ?>	
										</tbody>
									</table>
								</div>
								<span class="tfoot-ket">
									<b>Keterangan :</b>
								<span>
								<div class="table-responsive" style="border:0px;">
									<table class="table table-nobor-monev" style="font-size:12px; border-top:0px;">
									<tr>
										<td width="200">
											<table class="table table-nobor-monev" style="font-size:12px;">
												<tr>
													<td colspan="9">*50% nilai diambil dari mitra</td>
												</tr>
												<tr>
													<td width="5">A</td>
													<td width="5">:</td>
													<td width="30">86-100</td>
													<td width="5">C</td>
													<td width="5">:</td>
													<td width="5">67-75</td>
													<td width="5">E</td>
													<td width="5">:</td>
													<td width="30">&#60; 55</td>
												</tr>
												<tr>
													<td width="5">B</td>
													<td width="5">:</td>
													<td width="30">76-85</td>
													<td width="5">D</td>
													<td width="5">:</td>
													<td width="30">55-64</td>
													<td colspan="3" style="color:#fff;">-</td>
												</tr>
											</table>
										</td>
										<td width="230"></td>
										<td>
											<table class="table table-nobor-monev" style="font-size:12px;">
												<tr>
													<td>PB</td>
													<td>:</td>
													<td>Presentasi Pembekalan</td>
													<td>KM-KS</td>
													<td>:</td>
													<td>Kinerja Mahasiswa - Kerjasama</td>
												</tr>
												<tr>
													<td>UK</td>
													<td>:</td>
													<td>Usulan Kegiatan</td>
													<td>PL</td>
													<td>:</td>
													<td>Pelaksanaan Program</td>
												</tr>
												<tr>
													<td>KM-DS</td>
													<td>:</td>
													<td>Kinerja Mahasiswa - Disiplin</td>
													<td>LPK</td>
													<td>:</td>
													<td>Laporan Pelaksanaan Kegiatan</td>
												</tr>
											</table>
										</td>
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
				</div>	
			</div>
		</div>
	</div>
</div>