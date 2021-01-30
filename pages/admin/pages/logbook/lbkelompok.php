<?php

	$t = date('Y');
	$a = $t-3;
	$j = $t+2;
	
	
	if(isset($_GET['kelompok'])){
		
		$kelompok     = $_GET['kelompok'];
		$r_xkelompok   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$kelompok'"));
		
	}

?>	
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade <?=((isset($kelompok))?'':'in active')?>" id="tab1">
				<div class="panel panel-white">
					<div class="panel-heading">
						<h6 class="panel-title">Data Logbook kelompok</h6>
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
									<th>Nama Kelompok</th>
									<th>Program Studi</th>
									<th>Nama Ketua Kelompok</th>
									<th>Dosen Pembimbing Lapangan 1 (DPL 1)</th>
									<th>Dosen Pembimbing Lapangan 2 (DPL 2)</th>
									<th>Lokasi KKN</th>
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
										
										$q_lbkelompok = mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok IN (SELECT id_kelompok FROM tbl_logbook WHERE status_logbook='kelompok' AND tahun_kkn='$tahun_kkn' ORDER BY tgl_pengisian DESC)");
										
									}else{
										
										$q_lbkelompok = mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok IN (SELECT id_kelompok FROM tbl_logbook WHERE status_logbook='kelompok' AND tahun_kkn='$r_atur[tahun_kkn]' ORDER BY tgl_pengisian DESC)");
									
									}
									
									
									while($r_lbkelompok = mysqli_fetch_array($q_lbkelompok)){
			
									$r_tkelompok = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.tahun_kkn, tbl_peserta.status_peserta, tbl_has_peserta.id_has_peserta, tbl_has_peserta.id_kelompok, tbl_has_peserta.id_peserta, tbl_has_peserta.status_has_peserta, tbl_kelompok.id_kelompok, tbl_kelompok.nama_kelompok, tbl_mahasiswa.id_mahasiswa, tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa,tbl_mahasiswa.foto_mahasiswa, tbl_prodi.id_prodi, tbl_prodi.nama_prodi FROM tbl_peserta NATURAL JOIN tbl_has_peserta NATURAL JOIN tbl_kelompok NATURAL JOIN tbl_mahasiswa NATURAL JOIN tbl_prodi WHERE  tbl_kelompok.id_kelompok='$r_lbkelompok[id_kelompok]' AND tbl_has_peserta.status_has_peserta='ketua'"));
									
									$id_kelompok  = $r_tkelompok['id_kelompok']; 
									
									$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$id_kelompok' AND `status_has_dpl`='dpl1'"));
									
									$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
									
									$r_dosen1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
									
									$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$id_kelompok' AND status_has_dpl='dpl2'"));	

									$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
									
									$r_dosen2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));										
									
									$r_tlokasi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_lbkelompok[id_lokasi]'"));
									
									$r_tprov = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
									
									$r_tkota = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
									
									$r_tkec  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
									
									$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
									
									$no++;
								?>
								<tr>
									<td><?=$no;?></td>
									<td><?=ucwords('Kelompok '.$r_tkelompok['nama_kelompok'])?></td>
									<td><?=ucwords($r_tkelompok['nama_prodi'])?></td>
									<td><?=ucwords($r_tkelompok['nama_mahasiswa'])?></td>
									<td><?=ucwords(cek_jk($r_dosen1['jk_dosen'])." ".$r_dosen1['nama_dosen'])?></td>
									<td><?=ucwords(cek_jk($r_dosen2['jk_dosen'])." ".$r_dosen2['nama_dosen'])?></td>
									<td>Prov. <?=ucwords($r_tprov['nama'])?> - <?=ucwords($r_tkota['nama'])?> - Kec. <?=ucwords($r_tkec['nama'])?> - Kel. <?=ucwords($r_tkel['nama'])?></td>
									<td><?=ucwords($r_tkelompok['tahun_kkn'])?></td>
									<td>Logbook kelompok</td>
									<td align="center">
										<a href="?page=lbkelompok&kelompok=<?=$r_tkelompok['id_kelompok']?>" class="label label-default" data-placement="left"  data-popup="tooltip" title="" data-original-title="Cek Logbook"><i class="fa fa-search-plus"></i> Cek</a>	
									</td>
								</tr>
								<?php 
								}
									if(mysqli_num_rows($q_lbkelompok)==0){
								?>
								<tr>
									<td colspan="10" align="center"><b>Tidak Ada Data</b></td>
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
			<div class="tab-pane fade <?=((isset($kelompok))?'in active':'')?>" id="tab2">
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">Logbook kelompok <b><?=ucwords($r_xkelompok['nama_kelompok'])?></b></h6>
								<div class="heading-elements panel-nav">
									<ul class="nav nav-pills nav-pills-bordered text-right">
									<li ><a href="?page=lbkelompok"><i style="margin-top:-2px;" class="fa fa-chevron-circle-left"></i> Kembali</a></li>		
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
											
											$q_lbkelompok = mysqli_query($dbconnect,"SELECT * FROM tbl_logbook WHERE id_kelompok='$r_xkelompok[id_kelompok]' AND status_logbook='kelompok' ORDER BY tgl_pengisian DESC");
											while($r_lbkelompok = mysqli_fetch_array($q_lbkelompok)){
											
											$statuslb     = $r_lbkelompok['status_logbook'];
											
											if($statuslb == "kelompok"): $tstatuslb = "Logbook Kelompok"; endif;
											
											/** $r_tkelompok  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$r_lbkelompok[id_kelompok]'")); **/
											
											$r_tpeserta   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_lbkelompok[id_peserta]'"));
											
											$r_tmahasiswa = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa ='$r_tpeserta[id_mahasiswa]'"));
											
											$no++;
										?>
										<tr>
											<td><?=$no;?></td>
											<!--<td><?=ucwords($r_tmahasiswa['nama_mahasiswa'])?></td>-->
											<td><?=ucwords(tgl_indo($r_lbkelompok['tgl_pengisian']))?></td>
											<td><?=ucfirst($r_lbkelompok['catatan'])?></td>
											<td><?=ucwords($tstatuslb)?></td>
											<td align="center">
												<a target="_blank" data-placement="left"  data-popup="tooltip" title="" data-original-title="Cetak" href="../../setting/include/report.php?logbook=<?=$r_lbkelompok['id_logbook'];?>&statuslb=<?=$statuslb;?>" type="button" class="label label-default"><i class="fa fa-print"></i> Cetak</a>
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