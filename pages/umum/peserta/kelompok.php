<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-white">
		<div class="panel-body">
		<div class="table-info">
			<table class="table table-bordered table-hover datatable-show-all">
									<thead>
										<tr>
											<th>#</th>
											<th>Nama Kelompok</th>
											<th>Program Studi</th>
											<th>Nama Ketua Kelompok</th>
											<th>Dosen Pembimbing Lapangan 1 (DPL 1)</th>
											<th>Dosen Pembimbing Lapangan 2 (DPL 2)</th>
											<th>Lokasi KKN</th>
											<th align="center">Aksi</th>
										</tr>
									</thead>
									
									<tbody>
									<?php
										$no=0;
										$q_kelompok = mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok AND tahun_kkn='$r_atur[tahun_kkn]' ORDER BY nama_kelompok ASC");
										while($r_kelompok = mysqli_fetch_array($q_kelompok)){
											
										$id_kelompok  = $r_kelompok['id_kelompok']; 
										
										$r_tprodi  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_kelompok[id_prodi]'"));
										
										$r_haspeserta = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_kelompok='$r_kelompok[id_kelompok]'"));
										
										$r_peserta	  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_haspeserta[id_peserta]'"));
										
										$r_mahasiswa  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_peserta[id_mahasiswa]'"));
										
										$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$id_kelompok' AND `status_has_dpl`='dpl1'"));
										
										$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
										
										$r_dosen1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
										
										$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$id_kelompok' AND status_has_dpl='dpl2'"));	

										$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
										
										$r_dosen2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));										
										
										$r_tlokasi = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_kelompok[id_lokasi]'"));
										
										$r_tprov = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
										
										$r_tkota = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
										
										$r_tkec  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
										
										$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
										
										$nama_kelompok  = $r_kelompok['nama_kelompok'];	
																													
										$no++;										
									?>
										<tr>
											<td width="10"><?=$no;?></td>
											<td>Kelompok <?=$nama_kelompok?></td>
											<td><?=ucwords($r_tprodi['nama_prodi'])?></td>
											<td><?=ucwords($r_mahasiswa['nama_mahasiswa'])?></td>
											<td><?=ucwords(cek_jk($r_dosen1['jk_dosen'])." ".$r_dosen1['nama_dosen'])?></td>
											<td><?=ucwords(cek_jk($r_dosen2['jk_dosen'])." ".$r_dosen2['nama_dosen'])?></td>
											<td>Prov. <?=ucwords($r_tprov['nama'])?> - <?=ucwords($r_tkota['nama'])?> - Kec. <?=ucwords($r_tkec['nama'])?> - Kel. <?=ucwords($r_tkel['nama'])?></td>
											<td width="15" class="center">
												<a href="?page=detail-kelompok&kelompok=<?=$r_kelompok['id_kelompok']?>" class="label label-default" data-placement="left"  data-popup="tooltip" title="" data-original-title="Detail Kelompok"><i class="fa fa-search-plus"></i> Detail</a>
																								
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