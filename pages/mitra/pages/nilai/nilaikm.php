<?php
	
	if(isset($_GET['kelompok'])){
		
		((isset($_GET['monev']))?$monev = $_GET['monev']:'');
		 		
		$id_kelompok  = $_GET['kelompok'];
		$r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		

		if(isset($_GET['monev'])){
			$r_tjadwal = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_jadwal='monev3'"));
			
			$status_tjadwal = $r_tjadwal['status_jadwal'];
			
			if($status_tjadwal == "monev3"){
				$mstatus   = "III";
			}
			else{
				$mstatus   = "";
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
				<li class=""><a href="?page=kelompok-mitra&kelompok=<?=$id_kelompok;?>"><i class="fa fa-search-plus"></i> Detail Kelompok</a></li>
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
								<a href="?page=nilai-km&kelompok=<?=$id_kelompok;?>" class="list-group-item active"><i class="fa fa-file-text-o"></i> Kinerja Mahasiswa</a>
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
								<h6 class="panel-title">Nilai Kinerja Mahasiswa</h6>
								<?php if(isset($monev)){ echo ""; }else{?>
									<div class="heading-elements">										
										<div class="btn-group heading-btn">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-print" style="margin-top:-4px;"></i> Cetak Nilai <i class="fa fa-angle-down"></i></button>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a target="_blank" href="../../setting/include/report.php?nkmmkelompok=<?=$id_kelompok;?>"><i class="fa fa-print" ></i> Nilai Mitra</a></li>
											<li><a target="_blank" href="../../setting/include/report.php?nkmgkelompok=<?=$id_kelompok;?>"><i class="fa fa-print" ></i> Nilai Gabungan</a></li>
										</ul>
										</div>
									</div>
								<?php }?>
							</div>
							<div class="panel-body">
							<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade in active" id="tblnilai">	
								<div class="table-info">
									<table class="table table-nobor-monev marbot10">
										<tr>
											<td>
												<table class="table table-nobor-monev">
													<tr>
														<th colspan="10">EVALUASI KEBERHASILAN KINERJA MAHASISWA KKM-PPM</th>
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
											<th width="10"><center>No.</center></th>
											<th width="400"><center>Nama Mahasiswa</center></th>
											<th width="80"><center>Absen</center></th>
											<th><center>Nilai Disiplin</center></th>
											<th><center>Nilai Kerjasama</center></th>
											<th width="40"><center>Aksi</center></th>
										</tr>
									</thead>
									<tbody>
										<?php
											$no=0;
																						
											$q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.status_peserta,tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta  FROM tbl_mahasiswa NATURAL JOIN tbl_peserta NATURAL JOIN tbl_has_peserta WHERE tbl_has_peserta.id_kelompok='$r_tkelompok[id_kelompok]' ORDER BY tbl_mahasiswa.nim ASC");
							
											while($r_ypeserta = mysqli_fetch_array($q_ypeserta)){
											
											$r_yjadwal     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_ypeserta[id_kelompok]'"));
											
											$r_yabsen	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_absen WHERE id_peserta='$r_ypeserta[id_peserta]' AND id_jadwal='$r_tjadwal[id_jadwal]'"));
											
											$status_absen   = $r_yabsen['status_absen'];
																						
											$r_nilaikmmitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_nilai_km WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_penilai='mitra' AND id_jadwal='$r_tjadwal[id_jadwal]' AND id_mitra='$r_tmitra[id_mitra]'"));
											
											
											$nilaids_mitra = $r_nilaikmmitra['nilai_ds'];
											$nilaiks_mitra = $r_nilaikmmitra['nilai_ks'];
											
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
											<td><center><?=((empty($nilaids_mitra))?'-':potong_nilai($nilaids_mitra))?></center></td>
											<td><center><?=((empty($nilaiks_mitra))?'-':potong_nilai($nilaiks_mitra))?></center></td>
											<td><center>
											<?php
												if(empty($nilaids_mitra) AND empty($nilaiks_mitra)){
											?>
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Masukan Nilai" href='#nilaikm' id='custId' data-toggle='modal' data-id="<?php echo $r_ypeserta['id_peserta']; ?>" type="button" class="label label-default <?=cek_status5($status_absen);?>"><i class="fa fa-pencil"></i> Nilai</a>
											<?php
												}elseif(!empty($nilaids_mitra) AND !empty($nilaiks_mitra)){
											?>	
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah Nilai" href='#ubahnilaikm' id='custId' data-toggle='modal' data-id="<?php echo $r_nilaikmmitra['id_nilai']; ?>" type="button" class="label label-default"><i class="fa fa-edit"></i> Ubah</a>
											<?php } ?>
											</center></td>
										</tr>
										<?php } ?>
									</tbody>	
									</table>
								</div>
								<span class="tfoot-ket">
									<b>Ketentuan penilaian :</b>
								</span>								
								<div class="table-responsive" style="border:0px;">
									<table class="table table-nobor-monev">
										<tr>
											<td>- Setiap penilaian dilakukan per Monev yang dilakukan (3 kali monev).</td>
										</tr>
										<tr>
											<td>- Rentang nilai berada pada nilai 0-100 mengikuti rentang nilai yang ditetapkan oleh STIKOM Uyeelindo Kupang.</td>
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