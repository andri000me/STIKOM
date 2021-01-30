<?php
	
	$t = date('Y');
	$a = $t-10;
	$j = $t+1;
	
	if(isset($_GET['absen'])){
		
		
		$r_tjadwal    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_jadwal='$_GET[absen]'")); 
		
		$statusmonev  = $r_tjadwal['status_jadwal'];
											
		if($statusmonev == "monev1"){
			$mstatus  = "Monev 1";
		}elseif($statusmonev == "monev2"){
			$mstatus  = "Monev 2";
		}elseif($statusmonev == "monev3"){
			$mstatus  = "Monev 3";
		}else{
			$mstatus  = "Pembekalan";
		}
		
		$id_kelompok   = $r_tjadwal['id_kelompok'];
		$r_tkelompok   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));

	}
?>
<div class="navbar navbar-default navbar-component navbar-xs">
	<ul class="nav navbar-nav visible-xs-block">
		<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="fa fa-bars"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-filter">
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li ><a href="?page=detail-kelompok&kelompok=<?=$id_kelompok ;?>"><i class="fa fa-chevron-circle-left"></i> Kembali</a></li>
				<li class="active"><a href=""><i class="fa fa-search-plus"></i> Absen Kelompok</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade in active" id="tab1">
					<div class="col-sm-12">
					<div class="row">
					<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade in active" id="absenmonev">
					<div class="col-sm-12">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">Absen <b><?=$mstatus;?> Kelompok <?=$r_tkelompok['nama_kelompok'];?></b></h6>
								<div class="heading-elements">
								<?php 
									if($statusmonev == "monev1" || $statusmonev == "monev2" || $statusmonev == "monev3" || $statusmonev !== "pembekalan" ){
								?>
									<a target="_blank" href="../../setting/include/report.php?monev=<?=$r_tjadwal['id_jadwal'];?>" type="button" class="btn btn-default btn-sm heading-btn"><i class="fa fa-print" style="margin-top:-4px;"></i> Cetak Absen</a>
								<?php }elseif($statusmonev !== "monev1" || $statusmonev !== "monev2" || $statusmonev !== "monev3" || $statusmonev == "pembekalan") {?>
									<a href="?page=nilai-pb&kelompok=<?=$id_kelompok?>" type="button" class="btn btn-default btn-sm heading-btn"><i class="fa fa-search-plus" style="margin-top:-4px;"></i> Cek Nilai</a>
								<?php } ?>		
								</div>
							</div>
							<div class="panel-body">
									<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<th width="10">#</th>
												<!--<th width="110">Foto Peserta</th>-->
												<th>NIM</th>
												<th>Nama Peserta</th>
												<th>Jenis Kelamin</th>
												<th>Program Studi</th>
												<th width="80" align="center">Keterangan</th>
												<th width="80" align="center">Aksi</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$no=0;
											
											$q_ypeserta = mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_kelompok='$id_kelompok'");
											
											// $q_ypeserta   = mysqli_query($dbconnect, "SELECT tbl_has_peserta.id_peserta,tbl_has_peserta.id_has_peserta,tbl_has_peserta.id_kelompok, tbl_absen.id_jadwal, tbl_absen.id_peserta, tbl_absen.status_absen FROM tbl_has_peserta NATURAL JOIN tbl_absen WHERE tbl_has_peserta.id_kelompok='$id_kelompok'");
											
											while($r_ypeserta = mysqli_fetch_array($q_ypeserta)){
												
											$r_gpeserta	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_ypeserta[id_peserta]' AND status_peserta='sudah'"));
	
											$r_ymahasiswa  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_gpeserta[id_mahasiswa]'"));
											
											$r_yjadwal     = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_ypeserta[id_kelompok]'"));
											
											$r_yabsen	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_absen WHERE id_peserta='$r_ypeserta[id_peserta]' AND id_jadwal='$r_tjadwal[id_jadwal]'"));
											
											$status_absen  = $r_yabsen['status_absen'];
											
											$r_tkelompok   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$r_ypeserta[id_kelompok]'"));
											
											$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
											
											$no++;										
										?>
											<tr>
												<td><?=$no;?></td>
												<!--<td><center><img src="../../setting/save/mahasiswa/<?=cek_foto($r_ymahasiswa['foto_mahasiswa']);?>" class="resident-picture"></center></td>-->
												<td><?=$r_ymahasiswa['nim']?></td>
												<td><?=ucwords($r_ymahasiswa['nama_mahasiswa'])?></td>
												<td><?=ucwords(jk($r_ymahasiswa['jk_mahasiswa']))?></td>
												<td><?=ucwords($r_tprodi['nama_prodi'])?></td>
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
												<td><center>
												<?php 
													if(empty($status_absen)){ echo "-";}elseif(!empty($status_absen)){
														if($status_absen == "hadir" || $status_absen == "tidak"){echo "-";
														}
														elseif($status_absen == "ijin" || $status_absen == "sakit"){ 
													?>
														<a data-placement="left" data-popup="tooltip" title="" data-original-title="Cek Surat" href='#ceksurat' id='custId' data-toggle='modal' data-id="<?php echo $r_yabsen['id_absen']; ?>" type="button" class="label label-default"><i class="fa fa-search-plus"></i> Cek</a>
												<?php 
															}  
														} 
													?>
												</center></td>
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
