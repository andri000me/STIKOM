<?php
	
	$t = date('Y');
	$a = $t-10;
	$j = $t+1;
	
	if(isset($_GET['kelompok'])){
		
		$id_kelompok   = $_GET['kelompok'];
		$r_tkelompok   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$id_kelompok'"));
		
		$r_gprodi      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tkelompok[id_prodi]'"));
		
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
		
		
		$q_peserta   = mysqli_query($dbconnect, "SELECT tbl_mahasiswa.id_mahasiswa,tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.tahun_kkn, tbl_peserta.status_peserta FROM tbl_mahasiswa NATURAL JOIN tbl_peserta WHERE tbl_mahasiswa.id_prodi='$r_gprodi[id_prodi]' AND tbl_peserta.status_peserta='sudah' AND tahun_kkn='$r_atur[tahun_kkn]'");
		
	}
		include '../../setting/action/aksi_map.php';
?>
<div class="navbar navbar-default navbar-component navbar-xs">
	<ul class="nav navbar-nav visible-xs-block">
		<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="fa fa-bars"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-filter">
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li ><a href="?page=kelompok"><i style="margin-top:1px;" class="fa fa-chevron-circle-left"></i> Kembali</a></li>
				<li class="active"><a href="#"><i class="fa fa-search-plus"></i> Detail Kelompok</a></li>
				<li class=""><a href="?page=nilai-pb&kelompok=<?=$id_kelompok;?>"><i class="fa fa-pencil"></i> Penilaian</a></li>
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
					<div class="col-sm-3">
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-white">
								<div class="border-left-warning border-left-lg">
										<div class="panel-heading" style="margin-bottom:-9px;">
										<h6 class="panel-title">Navigasi Menu</h6>
									</div>
									<div class="list-group no-border no-padding-top">
									<div class="list-group-divider"></div>	
										<a href="#anggotak" data-toggle="tab" aria-expanded="false" class="list-group-item"><i class="fa fa-users"></i> Anggota Kelompok</a>
									<div class="list-group-divider"></div>	
										<a href="#pembimbing" data-toggle="tab" aria-expanded="false" class="list-group-item"><i class="fa fa-user-o"></i> Pembimbing Lapangan</a>
									<div class="list-group-divider"></div>	
										<a href="#lokasi" data-toggle="tab" aria-expanded="false" class="list-group-item"><i class="fa fa-map"></i> Lokasi KKN</a>
									<div class="list-group-divider"></div>	
										<a href="#jadwalmonev" data-toggle="tab" aria-expanded="false" class="list-group-item"><i class="fa fa-table"></i> Jadwal</a>
									</div>
								</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-9">
					<div class="row">
					<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade in active" id="anggotak">
					<div class="col-sm-12">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">Anggota Kelompok</h6>
								<div class="heading-elements">
									<button data-toggle="modal" data-target="#anggota" type="button" class="btn btn-default btn-sm heading-btn"><i style="margin-top:-4px;" class="fa fa-user-plus"></i> Tambah</button>
								</div>
							</div>
							<div class="panel-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Foto Peserta</th>
											<th>Status Peserta</th>
											<th>NIM</th>
											<th>Nama Peserta</th>
											<th>Jenis Kelamin</th>
											<th>Program Studi</th>
											<th align="center">Aksi</th>
										</tr>
									</thead>
									
									<tbody>
									<?php
										if($cek_ketua!==0){									
									?>
										<tr>
											<td>1</td>
											<td><center><img src="../../setting/save/mahasiswa/<?=cek_foto($r_bmahasiswa['foto_mahasiswa']);?>" class="resident-picture"></center></td>
											<td><b><?=ucwords($r_bketua['status_has_peserta'])?></b> Kelompok</td>
											<td><?=$r_bmahasiswa['nim']?></td>
											<td><?=ucwords($r_bmahasiswa['nama_mahasiswa'])?></td>
											<td><?=ucwords(jk($r_bmahasiswa['jk_mahasiswa']))?></td>
											<td><?=ucwords($r_bprodi['nama_prodi'])?></td>
											<td><center>								
												<button type="button" class="label label-danger" onclick="datadele(<?=$r_thaspeserta['id_has_peserta'];?>,&#39;anggota&#39;,<?=$id_kelompok;?>)" data-original-title='Hapus' data-toggle='modal' data-target='#myModal2'><i class="fa fa-trash"></i></button>
											</center></td>
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
											<td><center><img src="../../setting/save/mahasiswa/<?=cek_foto($r_gmahasiswa['foto_mahasiswa']);?>" class="resident-picture"></center></td>
											<td><b><?=ucwords($r_banggota['status_has_peserta'])?></b> Kelompok</td>
											<td><?=$r_gmahasiswa['nim']?></td>
											<td><?=ucwords($r_gmahasiswa['nama_mahasiswa'])?></td>
											<td><?=ucwords(jk($r_gmahasiswa['jk_mahasiswa']))?></td>
											<td><?=ucwords($r_bgprodi['nama_prodi'])?></td>
											<td><center>
												<button type="button" class="label label-danger" onclick="datadele(<?=$r_banggota['id_has_peserta'];?>,&#39;anggota&#39;,<?=$id_kelompok;?>)" data-original-title='Hapus' data-toggle='modal' data-target='#myModal2'><i class="fa fa-trash"></i></button>
											</center></td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>			
							</div>			
						</div>		
					</div>
					</div>
					<div class="tab-pane fade in" id="pembimbing">
					<div class="col-sm-12">
						<div class="panel panel-white">
							<div class="panel-heading">
							<h6 class="panel-title">Pembimbing Lapangan</h6>
							</div>
							<div class="table-responsive">
								<table class="table table-noborder table-striped">
									<tr>
										<th colspan="10"><b>PROFIL DOSEN PEMBIMBING LAPANGAN 1</b></th>
									</tr>
									<tr>
										<td rowspan="3" style="padding:0px; width:60px;"><img style="height:134px; border-right:1px solid #dddddd; padding:3px;" src="../../setting/save/dosen/<?=cek_foto($r_tdosen1['foto_dosen'])?>" /></td>
										<th>NIDN</th>
										<th><center>:</center></th>
										<td><?=$r_tdosen1['nidn']?></td>
										<td colspan="4"></td>
									</tr>
									<tr>
										<th>Nama Lengkap DPL 1</th>
										<th><center>:</center></th>
										<td colspan="4"><?=strtoupper(cek_jk($r_tdosen1['jk_dosen'])." ".$r_tdosen1['nama_dosen'])?></td>
									</tr>
									<tr>
										<th>No. Tlp/Hp</th>
										<th><center>:</center></th>
										<td style="border-right:1px solid #ddd;"><?=$r_tdosen1['no_tlp_dosen']?></td>
										<th>Email</th>
										<th><center>:</center></th>
										<td><?=strtoupper($r_tdosen1['email_dosen'])?></td>
									</tr>
									<tr>
										<th colspan="10"><b>PROFIL DOSEN PEMBIMBING LAPANGAN 2</b></th>
									</tr>
									<tr>
										<td rowspan="3" style="padding:0px; width:60px;"><img style="height:134px; border-right:1px solid #dddddd; padding:3px;" src="../../setting/save/dosen/<?=cek_foto($r_tdosen2['foto_dosen'])?>" /></td>
										<th>NIDN</th>
										<th><center>:</center></th>
										<td><?=$r_tdosen2['nidn']?></td>
										<td colspan="4"></td>
									</tr>
									<tr>
										<th>Nama Lengkap DPL 2</th>
										<th><center>:</center></th>
										<td colspan="4"><?=strtoupper(cek_jk($r_tdosen2['jk_dosen'])." ".$r_tdosen2['nama_dosen'])?></td>
									</tr>
									<tr>
										<th>No. Tlp/Hp</th>
										<th><center>:</center></th>
										<td style="border-right:1px solid #ddd;"><?=$r_tdosen2['no_tlp_dosen']?></td>
										<th>Email</th>
										<th><center>:</center></th>
										<td><?=strtoupper($r_tdosen2['email_dosen'])?></td>
									</tr>	
									<tr>
										<th colspan="10"><b>PROFIL MITRA LAPANGAN</b></th>
									</tr>
									<tr>
										<td rowspan="3" style="padding:0px; width:60px;"><img style="height:134px; border-right:1px solid #dddddd; padding:3px;" src="../../setting/save/mitra/<?=cek_foto($r_tmitra['foto_mitra'])?>" /></td>
										<th>NIP</th>
										<th><center>:</center></th>
										<td colspan="4"><?=(($r_tmitra['nip'] == 0 || $r_tmitra['nip'] == "-")?'-':$r_tmitra['nip'])?></td>
									</tr>
									<tr>
										<th>Nama Mitra</th>
										<th><center>:</center></th>
										<td><?=strtoupper(cek_jk($r_tmitra['jk_mitra'])." ".$r_tmitra['nama_mitra'])?></td>
										<td colspan="9"></td>
									</tr>
									<tr>
										<th>No. Tlp/Hp</th>
										<th><center>:</center></th>
										<td><?=strtoupper($r_tmitra['no_tlp_mitra'])?></td>
										<td colspan="9"></td>
									</tr>
								</table>	
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
								<div class="table-responsive">
									<table class="table table-noborder table-striped">
										<tr>
											<th><b>LOKASI KKN : PROV. <?=strtoupper($r_tprov['nama'])?> - <?=strtoupper($r_tkota['nama'])?> - KEC. <?=strtoupper($r_tkec['nama'])?> - KEL. <?=strtoupper($r_tkel['nama'])?></b></th>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade in" id="jadwalmonev">
					<div class="col-sm-12">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">Jadwal <b>Kelompok <?=$r_tkelompok['nama_kelompok'];?></b></h6>
								<div class="heading-elements">
									<button data-toggle="modal" data-target="#jadwal" type="button" class="btn btn-default btn-sm heading-btn"><i style="margin-top:-4px;" class="fa fa-plus-square"></i> Tambah</button>
								</div>
							</div>
							<div class="panel-body">
								<div class="table-info">
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
											
											$q_jadwal = mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal WHERE id_kelompok='$r_tkelompok[id_kelompok]'");
											while($r_jadwal = mysqli_fetch_array($q_jadwal)){
											
											$status_monev = $r_jadwal['status_jadwal'];
											
											if($status_monev == "monev1"){
												$tstatus = "Monev 1 Mahasiswa KKN-PPM";
											}elseif($status_monev == "monev2"){
												$tstatus = "Monev 2 Mahasiswa KKN-PPM";
											}elseif($status_monev == "monev3"){
												$tstatus = "Monev 3 (Penarikan) Mahasiswa KKN-PPM";
											}else{
												$tstatus = "Pembekalan Mahasiswa KKN-PPM";
											}
											
											$no++;										
										?>
											<tr>
												<td><?=$no;?></td>
												<td><?=tgl_indo(ucwords($r_jadwal['tgl_jadwal']))?></td>
												<td><?=ucwords($tstatus)?></td>
												<td width="120" align="center">
													<a href="?page=absen&absen=<?=$r_jadwal['id_jadwal']?>" class="label label-warning" data-placement="left"  data-popup="tooltip" title="" data-original-title="Cek Absen"><i class="fa fa-check-square-o"></i></a>
												
													<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" href='#ubah_jadwal' id='custId' data-toggle='modal' data-id="<?php echo $r_jadwal['id_jadwal']; ?>" type="button" class="label label-primary <?=cek_status4($status_monev);?>"><i class="fa fa-edit"></i></a>
													
													<button type="button" class="label label-danger <?=cek_status4($status_monev);?>" onclick="datadele(<?=$r_jadwal['id_jadwal'];?>,&#39;jadwal&#39;,<?=$id_kelompok;?>)"  data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" data-toggle='modal' data-target='#myModal2'><i class="fa fa-trash"></i></button>
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
			</div>
		</div>
	</div>
</div>
