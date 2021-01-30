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
								<a href="?page=nilai-pb&kelompok=<?=$id_kelompok;?>" class="list-group-item active"><i class="fa fa-file-text-o"></i> Presentasi Pembekalan</a>
							<div class="list-group-divider"></div>	
								<a href="?page=nilai-uk&kelompok=<?=$id_kelompok;?>" class="list-group-item"><i class="fa fa-file-text-o"></i> Usulan Kegiatan</a>
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
								<h6 class="panel-title">Nilai Presentasi Pembekalan</h6>
								<div class="heading-elements">
									<a target="_blank" href="../../setting/include/report.php?pembekalan=<?=$r_tjadwal['id_jadwal'];?>" type="button" class="btn btn-default btn-sm heading-btn"><i class="fa fa-print" style="margin-top:-4px;"></i> Cetak Nilai</a>
								</div>
							</div>
							<div class="panel-body">
									<div class="table-info">
										<table class="table table-nobor-monev marbot10">
											<tr>
												<td>
													<table class="table table-nobor-monev">
														<tr>
															<th colspan="10">DAFTAR HADIR & NILAI TAHAP PEMBEKALAN MAHASISWA</th>
														</tr>
														<tr>
															<th width="100">Pembekalan</th>
															<th width="10">:</th>
															<td><?=tgl_indo(ucwords($r_tjadwal['tgl_jadwal']))?></td>
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
												<!--<th width="110">Foto Peserta</th>-->
												<th>NIM</th>
												<th width="300">Nama Peserta</th>
												<th width="90" align="center">Absen</th>
												<th width="90">Nilai DPL 1</th>
												<th width="90">Nilai DPL 2</th>
												<th width="95">Total Nilai</th>
												<th width="70">Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$no=0;
											
											$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta,tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
							
											while($r_ypeserta = mysqli_fetch_array($q_ypeserta)){
											
											$r_yjadwal      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_ypeserta[id_kelompok]'"));
											
											$r_yabsen	    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_absen WHERE id_peserta='$r_ypeserta[id_peserta]' AND id_jadwal='$r_tjadwal[id_jadwal]'"));
											
											$status_absen   = $r_yabsen['status_absen'];
											
											$r_nilaipb_dpl	= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pb WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='$status_dpl'"));
											
											$r_nilaipb_dpl1	= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pb WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='dpl1'"));
											
											$r_nilaipb_dpl2	= mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_pb WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='dpl2'"));
											
											$nilaidpl1      = $r_nilaipb_dpl1['nilai_pb'];
											$nilaidpl2      = $r_nilaipb_dpl2['nilai_pb'];
											
											if(empty($nilaidpl1) AND empty($nilaidpl2)){
												$totalnilai = "-";
											}
											elseif(!empty($nilaidpl1) AND empty($nilaidpl2)){
												$totalnilai = "-";
											}	
											elseif(empty($nilaidpl1) AND !empty($nilaidpl2)){
												$totalnilai = "-";
											}	
											elseif(!empty($nilaidpl1) AND !empty($nilaidpl2)){
												$totalnilai = ($nilaidpl1+$nilaidpl2)/2;
											}
											else{
												$totalnilai = "-";
											}
											
											$no++;										
										?>
											<tr>
												<td><?=$no;?></td>
												<td><?=$r_ypeserta['nim']?></td>
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
												<td><center><?=((empty($nilaidpl1))?'-':potong_nilai($nilaidpl1))?></center></td>
												<td><center><?=((empty($nilaidpl2))?'-':potong_nilai($nilaidpl2))?></center></td>
												<td><center><?=potong_nilai($totalnilai);?></center></td>
												<td><center>
												<?php
													if(empty($r_nilaipb_dpl['nilai_pb'])){
												?>
													<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Masukan Nilai" href='#nilaipb' id='custId' data-toggle='modal' data-id="<?php echo $r_ypeserta['id_peserta']; ?>" type="button" class="label label-default <?=cek_status5($status_absen);?>"><i class="fa fa-pencil"></i> Nilai</a>
												<?php }elseif(!empty($r_nilaipb_dpl['nilai_pb'])){ ?>	
													<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah Nilai" href='#ubahnilaipb' id='custId' data-toggle='modal' data-id="<?php echo $r_nilaipb_dpl['id_nilai']; ?>" type="button" class="label label-default"><i class="fa fa-edit"></i> Ubah</a>
												<?php } ?>	
											<center></td>
											</tr>
										<?php 
											} 
										?>	
										</tbody>
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