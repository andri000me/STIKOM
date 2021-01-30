<?php

	$carikode = mysqli_query($dbconnect, "SELECT nama_kelompok,tahun_kkn FROM tbl_kelompok WHERE tahun_kkn='$r_atur[tahun_kkn]'") or die (mysqli_error());
		// menjadikannya array
	$datakode = mysqli_fetch_array($carikode);
	$jumlah_data = mysqli_num_rows($carikode);
		// jika $datakode
	if ($datakode) {
		// membuat variabel baru untuk mengambil kode barang mulai dari 1
		$nilaikode = substr($jumlah_data[0], 1);
		// menjadikan $nilaikode ( int )
		$kode = (int) $nilaikode;
		// setiap $kode di tambah 1
		$kode = $jumlah_data + 1;
		// hasil untuk menambahkan kode 
		// angka 3 untuk menambahkan tiga angka setelah B dan angka 0 angka yang berada di tengah
		// atau angka sebelum $kode
		$kode_otomatis = str_pad($kode, 3, "0", STR_PAD_LEFT);
	 } else {
		 
		$kode_otomatis = "001";
	 }

?>
<div class="navbar navbar-default navbar-component navbar-xs">
	<ul class="nav navbar-nav visible-xs-block">
		<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="fa fa-bars"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-filter">
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-table"></i> Tampil Data Kelompok</a></li>
				<li ><a href="#kelompok" data-toggle="modal"><i class="fa fa-plus-square"></i> Tambah Kelompok</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- /toolbar -->
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade in active" id="tab1">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">Data Kelompok</h6>
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
											<th>#</th>
											<th>Nama Kelompok</th>
											<th>Program Studi</th>
											<th>Nama Ketua Kelompok</th>
											<th>Dosen Pembimbing Lapangan 1 (DPL 1)</th>
											<th>Dosen Pembimbing Lapangan 2 (DPL 2)</th>
											<th>Lokasi KKN</th>
											<th>Tahun KKN</th>
											<th align="center">Aksi</th>
										</tr>
									</thead>
									
									<tbody>
									<?php
										$no=0;
										
										if(isset($_POST['caritkkn'])){
										
											$tkkn1       = $_POST['thn1'];
											$tkkn2       = $_POST['thn2'];
											
											$tahun_kkn   = $tkkn1."/".$tkkn2;
										
											$q_kelompok = mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok AND tahun_kkn='$tahun_kkn'");
												
										}else{
											$q_kelompok = mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok AND tahun_kkn='$r_atur[tahun_kkn]'");
										
										}
										
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
											<td><?=$r_kelompok['tahun_kkn']?></td>
											<td width="15" class="center">
												
												<!--<a href="?page=jadwal&jadwal=<?=$r_kelompok['id_kelompok']?>" class="label label-warning" data-placement="left"  data-popup="tooltip" title="" data-original-title="Tambah Jadwal Monef"><i class="fa fa-table"></i></a>-->
												
												<a href="?page=detail-kelompok&kelompok=<?=$r_kelompok['id_kelompok']?>" class="label label-success" data-placement="left"  data-popup="tooltip" title="" data-original-title="Detail Kelompok"><i class="fa fa-search-plus"></i></a>
												
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" href='#ubah_kelompok' id='custId' data-toggle='modal' data-id="<?php echo $r_kelompok['id_kelompok']; ?>" type="button" class="label label-primary"><i class="fa fa-edit"></i></a>
												
												<!--<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" onclick='datadel(<?php echo $r_kelompok['id_kelompok']; ?>,&#39;kelompok&#39;)'  data-title='Delete' data-toggle='modal' data-target='#myModal' type="button" class="label label-danger"><i class="fa fa-trash"></i></button>--> 
																								
											</td>
										</tr>
									<?php 
										}
											if(mysqli_num_rows($q_kelompok)==0){
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
			</div>	
		</div>
	</div>