<?php

	$t = date('Y');
	$a = $t-3;
	$j = $t+2;
	
	
	if(isset($_GET['peserta'])){
		
		$peserta      = $_GET['peserta'];
		$r_tpeserta   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$peserta'"));
		
		$r_xmahasiswa = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_tpeserta[id_mahasiswa]'"));
		
	}

?>	
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade <?=((isset($peserta))?'':'in active')?>" id="tab1">
				<div class="panel panel-white">
					<div class="panel-heading">
						<h6 class="panel-title">Data Logbook Mandiri</h6>
						<div class="heading-elements panel-nav">
							<ul class="nav nav-pills nav-pills-bordered text-right">
								<li class=""><a href="#caritkkn" data-toggle="modal"><i class="fa fa-search-plus"></i> Cari Tahun KKN</a></li>		
							</ul>
						</div>
					</div>
					<div class="panel-body">
						<div class="table-info">
						<table class="table table-striped table-bordered table-hover datatable-show-all">
							<thead>
								<tr>
									<th width="10">#</th>
									<th>Foto Peserta</th>
									<th>NIM</th>
									<th>Nama Peserta</th>
									<th>Nama Kelompok</th>
									<th>Program Studi</th>
									<th>Tahun KKN</th>
									<th width="150">Status Logbook</th>
									<th width="80" align="center">Aksi</th>
								</tr>
							</thead>
							<tbody>
								
								<?php 
									$no=0;
									
									if(isset($_POST['caritkkn'])){
										
										$tkkn1       = $_POST['thn1'];
										$tkkn2       = $_POST['thn2'];
										
										$tahun_kkn   = $tkkn1."/".$tkkn2;
										
										$q_lbmandiri = mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta IN (SELECT id_peserta FROM tbl_logbook WHERE status_logbook='mandiri' AND tahun_kkn='$tahun_kkn' ORDER BY tgl_pengisian DESC)");
										
									}else{
										$q_lbmandiri = mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta IN (SELECT id_peserta FROM tbl_logbook WHERE status_logbook='mandiri' AND tahun_kkn='$r_atur[tahun_kkn]' ORDER BY tgl_pengisian DESC)");
									}
									
									
									while($r_lbmandiri = mysqli_fetch_array($q_lbmandiri)){
			
									$r_tmahasiswa = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.tahun_kkn, tbl_peserta.status_peserta, tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta, tbl_kelompok.id_kelompok, tbl_kelompok.nama_kelompok, tbl_mahasiswa.id_mahasiswa, tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa,tbl_mahasiswa.foto_mahasiswa, tbl_prodi.id_prodi, tbl_prodi.nama_prodi FROM tbl_peserta NATURAL JOIN tbl_has_peserta NATURAL JOIN tbl_kelompok NATURAL JOIN tbl_mahasiswa NATURAL JOIN tbl_prodi WHERE tbl_peserta.id_peserta='$r_lbmandiri[id_peserta]'"));
									
									$no++;
								?>
								<tr>
									<td><?=$no;?></td>
									<td><center><img src="../../setting/save/mahasiswa/<?=cek_foto($r_tmahasiswa['foto_mahasiswa']);?>" class="resident-picture"></center></td>
									<td><?=ucwords($r_tmahasiswa['nim'])?></td>
									<td><?=ucwords($r_tmahasiswa['nama_mahasiswa'])?></td>
									<td><?=ucwords('Kelompok '.$r_tmahasiswa['nama_kelompok'])?></td>
									<td><?=ucwords($r_tmahasiswa['nama_prodi'])?></td>
									<td><?=ucwords($r_tmahasiswa['tahun_kkn'])?></td>
									<td>Logbook Mandiri</td>
									<td align="center">
										<a href="?page=lbmandiri&peserta=<?=$r_tmahasiswa['id_peserta']?>" class="label label-default" data-placement="left"  data-popup="tooltip" title="" data-original-title="Cek Logbook"><i class="fa fa-search-plus"></i> Cek</a>	
									</td>
								</tr>
								<?php 
								}
									if(mysqli_num_rows($q_lbmandiri)==0){
								?>
								<tr>
									<td colspan="9" align="center"><b>Tidak Ada Data</b></td>
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
			<div class="tab-pane fade <?=((isset($peserta))?'in active':'')?>" id="tab2">
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">Logbook Mandiri <b><?=ucwords($r_xmahasiswa['nama_mahasiswa'])?></b></h6>
								<div class="heading-elements panel-nav">
									<ul class="nav nav-pills nav-pills-bordered text-right">
									<li ><a href="?page=lbmandiri"><i style="margin-top:-2px;" class="fa fa-chevron-circle-left"></i> Kembali</a></li>		
									</ul>
								</div>
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
											
											$q_lbmandiri = mysqli_query($dbconnect,"SELECT * FROM tbl_logbook WHERE id_peserta='$r_tpeserta[id_peserta]' AND status_logbook='mandiri' ORDER BY tgl_pengisian DESC");
											while($r_lbmandiri = mysqli_fetch_array($q_lbmandiri)){
											
											$statuslb     = $r_lbmandiri['status_logbook'];
											
											if($statuslb == "mandiri"): $tstatuslb = "Logbook Mandiri"; endif;
											
											
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
												<a target="_blank" data-placement="left"  data-popup="tooltip" title="" data-original-title="Cetak" href="../../setting/include/report.php?logbook=<?=$r_lbmandiri['id_logbook'];?>&statuslb=<?=$statuslb;?>" type="button" class="label label-default"><i class="fa fa-print"></i> Cetak</a>
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
		</div>
	</div>
</div>