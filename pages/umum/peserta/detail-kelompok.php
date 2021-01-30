<?php

	if(isset($_GET['kelompok'])){
		
		$id_kelompok   = $_GET['kelompok'];
		$r_tkelompok   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		
		$r_thaspeserta = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_kelompok='$r_tkelompok[id_kelompok]'"));
										
		$r_tpeserta	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_thaspeserta[id_peserta]' AND status_peserta='sudah'"));
		
		$r_tmahasiswa  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_tpeserta[id_mahasiswa]'"));
		
		$r_hdpl_1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_has_dpl` WHERE `id_kelompok`='$r_tkelompok[id_kelompok]' AND `status_has_dpl`='dpl1'"));
		
		$r_dpl1    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_1[id_dpl]'"));
		
		$r_tdosen1  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl1[id_dosen]'"));
		
		$r_hdpl_2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_dpl WHERE id_kelompok='$r_tkelompok[id_kelompok]' AND status_has_dpl='dpl2'"));	

		$r_dpl2    = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM `tbl_dpl` WHERE `id_dpl`='$r_hdpl_2[id_dpl]'"));
		
		$r_tdosen2  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl2[id_dosen]'"));		
		
		$q_banggota    = mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_kelompok='$id_kelompok' AND status_has_peserta='anggota'");
		
		$q_bketua	   = mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_kelompok='$id_kelompok' AND status_has_peserta='ketua'");
		$cek_ketua     = mysqli_num_rows($q_bketua);
		$r_bketua	   = mysqli_fetch_array($q_bketua);
		
		$r_bpeserta	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_bketua[id_peserta]' AND status_peserta='sudah'"));
		
		$r_bmahasiswa  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_tpeserta[id_mahasiswa]'"));
		
		$r_bprodi      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_bmahasiswa[id_prodi]'"));
		
		$r_tlokasi	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi='$r_tkelompok[id_lokasi]'"));
		
		$r_tprov = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_provinsi WHERE id_prov='$r_tlokasi[id_provinsi]'"));
								
		$r_tkota = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
		
		$r_tkec  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
		
		$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
		
		$r_tmitra = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mitra WHERE id_lokasi='$r_tlokasi[id_lokasi]'"));
		
		if($r_bprodi['singkatan_prodi']=="TIS1"){
			$tprodi = "TIS1 / <span class='line-through'>SIS1</span>";
		}
		elseif($r_bprodi['singkatan_prodi']=="SIS1"){
			$tprodi = "<span class='line-through'>TIS1</span> / SIS1";
		}
		else{
			$tprodi = "TIS1 / SIS1";
		}

	}
	
		include 'setting/action/aksi_map.php';
?>
<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade in active" id="tab1">
					<div class="col-sm-3">
						<div class="row">
							<div class="col-sm-12">
										<!-- Navigation -->
				    	<div class="panel panel-flat">
						<a href="#">
							<img src="assets/img/icon/kelompok.jpg" style="height:auto; max-height:280px; display:block; max-width:100%; width:100%;">
						</a>
							<div class="border-left-warning border-left-lg">
							<div class="panel-heading" style="margin-bottom:-9px;">
								<h6 class="panel-title">Navigasi Menu</h6>
							</div>

							<div class="list-group no-border no-padding-top">
							<div class="list-group-divider"></div>
								<a href="#anggotak" data-toggle="tab" aria-expanded="false" class="list-group-item"><i class="fa fa-users"></i> Anggota Kelompok</a>
							<div class="list-group-divider"></div>	
								<a href="#lokasi" data-toggle="tab" aria-expanded="false" class="list-group-item"><i class="fa fa-map"></i> Lokasi KKN</a>
							</div>
							</div>
						</div>
							</div>
						</div>
					</div>
					<div class="col-sm-9">
					<div class="row">
					<div class="tab-content" id="myTabContent">
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
					
					<div class="tab-pane fade in active" id="anggotak">
					<div class="col-sm-12">
						<div class="panel panel-white">
						<div class="panel-heading">
							<h6 class="panel-title">Anggota Kelompok</h6>
						</div>
							<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Foto Peserta</th>
											<th>Status Peserta</th>
											<th>NIM</th>
											<th>Nama Peserta</th>
											<th>Jenis Kelamin</th>
											<th>Program Studi</th>
											<th>No. Tlp/Hp</th>
											<th>Email</th>
										</tr>
									</thead>
									
									<tbody>
									<?php
										if($cek_ketua!==0){									
									?>
										<tr>
											<td>1</td>
											<td><center><img src="setting/save/mahasiswa/<?=cek_foto($r_bmahasiswa['foto_mahasiswa']);?>" class="resident-picture"></center></td>
											<td><b><?=ucwords($r_bketua['status_has_peserta'])?></b> Kelompok</td>
											<td><?=$r_bmahasiswa['nim']?></td>
											<td><?=ucwords($r_bmahasiswa['nama_mahasiswa'])?></td>
											<td><?=ucwords(jk($r_bmahasiswa['jk_mahasiswa']))?></td>
											<td><?=ucwords($r_bprodi['nama_prodi'])?></td>
											<td><?=ucwords($r_bmahasiswa['no_tlp_mahasiswa'])?></td>
											<td><?=ucwords($r_bmahasiswa['email_mahasiswa'])?></td>
										</tr>
									<?php 
										} 
										if(($cek_ketua!==0) || ($cek_ketua==0)) {
											$no=2;
										}
										if($cek_ketua==0) {
											$no=1;
										}
										while($r_banggota = mysqli_fetch_array($q_banggota)){
											
										$r_gpeserta	   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_peserta='$r_banggota[id_peserta]' AND status_peserta='sudah'"));
	
										$r_gmahasiswa  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_gpeserta[id_mahasiswa]'"));
										
										$r_bgprodi      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_gmahasiswa[id_prodi]'"));
									?>
										<tr>
											<td><?=$no++;?></td>
											<td><center><img src="setting/save/mahasiswa/<?=cek_foto($r_gmahasiswa['foto_mahasiswa']);?>" class="resident-picture"></center></td>
											<td><b><?=ucwords($r_banggota['status_has_peserta'])?></b> Kelompok</td>
											<td><?=$r_gmahasiswa['nim']?></td>
											<td><?=ucwords($r_gmahasiswa['nama_mahasiswa'])?></td>
											<td><?=ucwords(jk($r_gmahasiswa['jk_mahasiswa']))?></td>
											<td><?=ucwords($r_bgprodi['nama_prodi'])?></td>
											<td><?=ucwords($r_gmahasiswa['no_tlp_mahasiswa'])?></td>
											<td><?=ucwords($r_gmahasiswa['email_mahasiswa'])?></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>			
							</div>			
						</div>		
					</div>
					</div>
					<div class="tab-pane fade in" id="lokasi">
						<div class="col-sm-12">
							<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">Lokasi KKN</h6>
							</div>
								<div id="map-canvas" style="width:100%; height:350px;"></div>
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