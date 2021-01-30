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
		
		$r_hdpl     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_dpl='$r_dpl[id_dpl]' AND id_kelompok='$r_tkelompok[id_kelompok]'"));
		
		$status_dpl = $r_hdpl['status_has_dpl'];
	}

	$r_nilaiuk    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_uk_lpk WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND id_dpl='$r_dpl[id_dpl]' AND status_nilai='nilaiuk'"));  	
	
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
		$gnilai = "-";
	}
	elseif($d1tnilai==0 AND $d2tnilai!==0){
		$gnilai = "-";
	}
	elseif($d1tnilai!==0 AND $d2tnilai==0){
		$gnilai = "-";
	}
	elseif($d1tnilai!== 0 AND $d2tnilai!== 0){
		$gnilai = ($d1tnilai+$d2tnilai)/2;
	}
	else{
		$gnilai = "-";
	}
	
?>
<div class="navbar navbar-default navbar-component navbar-xs">
	<ul class="nav navbar-nav visible-xs-block">
		<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="fa fa-bars"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-filter">
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li class=""><a href="?page=detail-kelompok-dpl&kelompok=<?=$id_kelompok;?>"><i class="fa fa-search-plus"></i> Detail Kelompok</a></li>
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
								<a href="?page=nilai-uk&kelompok=<?=$id_kelompok;?>" class="list-group-item active"><i class="fa fa-file-text-o"></i> Usulan Kegiatan</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-km&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Kinerja Mahasiswa</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-pl&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Pelaksanaan Program</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-lpk&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Laporan Pelaksanaan Kegiatan</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-akhir&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Evaluasi Akhir</a>
							</div>
							</div>
							<a href="#">
								<img src="../../assets/img/icon/penilaian.jpg" style="height:auto; max-height:280px; display:block; max-width:100%; width:100%;">
							</a>
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
								<h6 class="panel-title">Nilai Usulan Kegiatan</h6>
								<div class="heading-elements">
									<a target="_blank" href="../../setting/include/report.php?nukkelompok=<?=$id_kelompok;?>" type="button" class="btn btn-default btn-sm heading-btn"><i class="fa fa-print" style="margin-top:-4px;"></i> Cetak Nilai</a>
								</div>
							</div>
							<div class="panel-body">
							<div class="table-info">
								<table class="table table-nobor-monev marbot10">
									<tr>
										<td>
											<table class="table table-nobor-monev">
												<tr>
													<th colspan="10">EVALUASI KEBERHASILAN USULAN KEGIATAN KKN-PPM MAHASISWA</th>
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
												<th width="500">Komponent Penilaian</th>
												<th width="30"><center>
												<?php
													if(empty($r_nilaiuk['nilai1']) AND empty($r_nilaiuk['nilai2']) AND empty($r_nilaiuk['nilai3'])){
												?>
													<a href="#nilaiuklpk" data-toggle="modal" class="label label-default" data-placement="left"  data-popup="tooltip" title="" data-original-title="Masukan Nilai"><i class="fa fa-pencil"></i> Nilai</a>
												<?php }elseif(!empty($r_nilaiuk['nilai1']) AND !empty($r_nilaiuk['nilai2']) AND !empty($r_nilaiuk['nilai3'])){?>	
													<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah Nilai" href='#ubahnilaiuklpk' id='custId' data-toggle='modal' data-id="<?php echo $r_nilaiuk['id_nilai']; ?>" type="button" class="label label-default"><i class="fa fa-edit"></i> Ubah</a>
												<?php }?>	
												</center></th>
												<th width="40">Nilai DPL 1(A)</th>
												<th width="40">Nilai DPL 2(B)</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td colspan="2">(I) Kesesuaian Dengan Tema (40%)</td>
												<td><center><?=((empty($d1nilai1))?'-':potong_nilai($d1hnilai1));?></center></td>
												<td><center><?=((empty($d2nilai1))?'-':potong_nilai($d2hnilai1));?></center></td>
											</tr>
											<tr>
												<td colspan="2">(II) Kesesuaian Format (30%)</td>
												<td><center><?=((empty($d1nilai2))?'-':potong_nilai($d1hnilai2));?></center></td>
												<td><center><?=((empty($d2nilai2))?'-':potong_nilai($d2hnilai2));?></center></td>
											</tr>
											<tr>
												<td colspan="2">(III) Tata Bahasa/Ragam Bahasa (30%)</td>
												<td><center><?=((empty($d1nilai3))?'-':potong_nilai($d1hnilai3));?></center></td>
												<td><center><?=((empty($d2nilai3))?'-':potong_nilai($d2hnilai3));?></center></td>
											</tr>
											<tr>
												<td colspan="2"><b>Total Nilai (I + II + III)</b></td>
												<td><center><b><?=((empty($d1nilai1) AND empty($d1nilai2) AND empty($d1nilai3))?'-':potong_nilai($d1tnilai));?></b></center></td>
												<td><center><b><?=((empty($d2nilai1) AND empty($d2nilai2) AND empty($d2nilai3))?'-':potong_nilai($d2tnilai));?></b></center></td>
											</tr>
											<tr>
												<td colspan="2"><b>Gabungan Nilai DPL 1 & 2 : (A + B)/2</b></td>
												<td colspan="2"><center><b><?=potong_nilai($gnilai);?></b></center></td>
											</tr>
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
				</div>	
			</div>
		</div>
	</div>
</div>