<?php
	
	if(isset($_GET['kelompok'])){
		
		((isset($_GET['monev']))?$monev = $_GET['monev']:'');
		 		
		$id_kelompok  = $_GET['kelompok'];
		$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		
		if(isset($_GET['monev'])){
			$r_tjadwal = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_jadwal='$monev'"));
			
			$status_tjadwal = $r_tjadwal['status_jadwal'];
			
			if($status_tjadwal == "monev1"){
				$mstatus   = "I";
			}
			elseif($status_tjadwal == "monev2"){
				$mstatus   = "II";
			}
			elseif($status_tjadwal == "monev3"){
				$mstatus   = "III";
			}
			else{
				$mstatus   = "Pembekalan";
			}
			
		}else{
			echo "";
		}	
		
		$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
		$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
			
		$r_tdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
			
		$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

		$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
			
		$r_tdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));
		
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
								<a href="?page=nilai-pl&kelompok=<?=$id_kelompok;?>" class="list-group-item active"><i class="fa fa-file-text-o"></i> Pelaksanaan Program</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-lpk&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Laporan Pelaksanaan Kegiatan</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-akhir&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Evaluasi Akhir</a>
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
								<h6 class="panel-title">Nilai Pelaksanaan Program</h6>
								<?php if(isset($monev)){ echo ""; }else{?>
									<div class="heading-elements">
										<a target="_blank" href="../../setting/include/report.php?nplkelompok=<?=$id_kelompok;?>" type="button" class="btn btn-default btn-sm heading-btn"><i class="fa fa-print" style="margin-top:-4px;"></i> Cetak Nilai</a>
									</div>
								<?php }?>
							</div>
							<div class="panel-body">
							<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade <?=((isset($monev))?'':'in active')?>" id="tbljadwal">
							<div class="table-info">
								<table class="table table-nobor-monev marbot10">
									<tr>
										<td>
											<table class="table table-nobor-monev">
												<tr>
													<th colspan="10">EVALUASI KEBERHASILAN PELAKSANAAN PROGRAM KKM-PPM</th>
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
												<th width="10">#</th>
												<th>Hari/Tanggal</th>
												<th>Status Jadwal</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$no=0;
											
											$q_jadwal = mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_jadwal!='pembekalan' ORDER BY status_jadwal ASC");
											while($r_jadwal = mysqli_fetch_array($q_jadwal)){
											
											$status_monev = $r_jadwal['status_jadwal'];
											
												if($status_monev == "monev1"){
													$tstatus = "Monev 1 Mahasiswa KKN-PPM";
													$key     = "monev";
												}
												elseif($status_monev == "monev2"){
													$tstatus = "Monev 2 Mahasiswa KKN-PPM";
													$key     = "monev";
												}
												elseif($status_monev == "monev3"){
													$tstatus = "Monev 3 (Penarikan) Mahasiswa KKN-PPM";
													$key     = "monev";
												}
												else{
													$tstatus = "Pembekalan Mahasiswa KKN-PPM";
													$key     = "pembekalan";
												}
											
											$no++;										
										?>
											<tr>
												<td><?=$no;?></td>
												<td><?=tgl_indo(ucwords($r_jadwal['tgl_jadwal']))?></td>
												<td><?=ucwords($tstatus)?></td>
												<td width="30" align="center">
													<a href="?page=nilai-pl&absen=<?=$r_jadwal['id_jadwal']?>&kelompok=<?=$id_kelompok?>&monev=<?=$status_monev;?>" class="label label-default" data-placement="left"  data-popup="tooltip" title="" data-original-title="Cek Absen"><i class="fa fa-search-plus"></i> Cek</a>
												</td>
											</tr>
										<?php 
											} 
										?>	
										</tbody>
									</table>
							</div>			
							</div>
							<div class="tab-pane fade <?=((isset($monev))?'in active':'')?>" id="tblnilai">	
								<div class="table-info">
									<table class="table table-nobor-monev marbot10">
										<tr>
											<td>
												<table class="table table-nobor-monev">
													<tr>
														<th colspan="10">EVALUASI KEBERHASILAN PELAKSANAAN PROGRAM KKM-PPM</th>
													</tr>
													<tr>
														<th width="100">Monev Ke/Tgl*</th>
														<th width="10">:</th>
														<td><u><?=$mstatus;?></u> / <u><?=strtoupper(tgl_indo($r_tjadwal['tgl_jadwal']))?></u></td>
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
											<th rowspan="2" width="10"><center>No.</center></th>
											<th rowspan="2" width="400"><center>Nama Mahasiswa</center></th>
											<th rowspan="2" width="80"><center>Absen</center></th>
											<th colspan="2"><center>Nilai Pelaksanaan Per Monev</center></th>
										</tr>
										<tr>
											<th><center>DPL 1</center></th>
											<th><center>DPL 2</center></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$no=0;
																						
											$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta,tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
							
											while($r_ypeserta = mysqli_fetch_array($q_ypeserta)){
											
											$r_yjadwal     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_ypeserta[id_kelompok]'"));
											
											$r_yabsen	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_absen WHERE id_peserta='$r_ypeserta[id_peserta]' AND id_jadwal='$r_tjadwal[id_jadwal]'"));
											
											$status_absen  = $r_yabsen['status_absen'];	
											
											$r_nilaipldpl1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pl WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='dpl1' AND id_jadwal='$r_tjadwal[id_jadwal]'"));
											
											$r_nilaipldpl2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pl WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='dpl2' AND id_jadwal='$r_tjadwal[id_jadwal]'"));	
											
											$nilai_dpl1  = $r_nilaipldpl1['nilai_pl'];
											$nilai_dpl2  = $r_nilaipldpl2['nilai_pl'];
										
											
											$no++;	
										?>
										<tr>
											<td><?=$no;?></td>
											<td><?=ucwords($r_ypeserta['nama_mahasiswa'])?></td>
											<td><center>
												<?php 
													if(empty($status_absen)){ 
													?>
													<i class="fa fa-minus-circle" style="margin-top:-3px;"></i>
												<?php 
												}elseif(!empty($status_absen)){
													if($status_absen == "hadir"){
													?>
														<b>H</b>	
												<?php 
													}elseif($status_absen == "ijin"){ 
													?>
														<b>I</b>
												<?php
													}elseif($status_absen == "sakit"){ 
													?>
														<b>S</b>
												<?php
													}elseif($status_absen == "tidak"){ 
													?>
														<b>A</b>	
												<?php 
															}  
														} 
													?>
											</center></td>
											<td><center><?=((empty($nilai_dpl1))?'-':potong_nilai($nilai_dpl1));?></center></td>
											<td><center><?=((empty($nilai_dpl2))?'-':potong_nilai($nilai_dpl2));?></center></td>
										</tr>
										<?php } ?>
									</tbody>	
									</table>
								</div>
								<span class="tfoot-ket">
									<b>Penilaian didasarkan pada :</b>
								</span>
								<div class="table-responsive" style="border:0px;">
									<table class="table table-nobor-monev">
										<tr>
											<td>- Keberhasilan memanfaatkan dan menggali potensi serta mengungkapkan masalah.</td>
										</tr>
										<tr>
											<td>- Keterampilan untuk melaksanakan program pengembangan dan pembangunan yang relevan.</td>
										</tr>
										<tr>
											<td>- Kemampuan mengevaluasi keberhasilan program yang telah dilakukan.</td>
										</tr>
									</table>						
								</div>
								<span class="tfoot-ket">
									<b>Keterangan :</b>
								<span>
								<div class="table-responsive" style="border:0px;">
									<table class="table table-nobor-monev" style="font-size:12px; border-top:0px;">
									<tr>
										<td width="100">
											<table class="table table-nobor-monev" style="font-size:12px;">
												<tr>
													<td width="2"><b>H</b></td>
													<td width="2">:</td>
													<td width="5">Hadir</td>
													<td width="2"><b>I</b></td>
													<td width="2">:</td>
													<td width="5">Ijin</td>
													<td width="2"><i class="fa fa-minus-circle" style="margin-top:-3px;"></i></td>
													<td width="2">:</td>
													<td width="5">Belum Absen</td>
												</tr>
												<tr>
													<td width="2"><b>S</b></td>
													<td width="2">:</td>
													<td width="5">Sakit</td>
													<td width="2"><b>A</b></td>
													<td width="2">:</td>
													<td width="5">Alpa</td>
													<td colspan="3" style="color:#fff;">-</td>
												</tr>
											</table>
										</td>
										<td width="200"></td>
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
	</div>
</div>