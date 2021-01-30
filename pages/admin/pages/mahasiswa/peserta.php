<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade in active" id="tab1">
						<div class="panel panel-white">
							<div class="panel-heading">
								<h6 class="panel-title">Data Peserta</h6>
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
											<th>Foto</th>
											<th>NIM</th>
											<th>Nama Mahasiswa</th>
											<th>Jenis Kelamin</th>
											<th>Tahun KKN</th>
											<th>Tahun Angkatan</th>
											<th>Program Studi</th>
											<!--<th>Agama</th>
											<th>Tempat/Tgl Lahir</th>-->
											<th>No. Tlp/Hp</th>
											<th>Email</th>
											<!--<th>Alamat</th>-->
											<th>Tanggal Daftar</th>
											<th>Status Peserta</th>
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
										
												$q_tpeserta   = mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_mahasiswa AND tahun_kkn='$tahun_kkn'");
												
											}else{
												
												$q_tpeserta   = mysqli_query($dbconnect,"SELECT * FROM tbl_peserta WHERE id_mahasiswa AND tahun_kkn='$r_atur[tahun_kkn]'");
											
											}
											while($r_tpeserta = mysqli_fetch_array($q_tpeserta)){
											
											$q_tmahasiswa = mysqli_query($dbconnect,"SELECT * FROM tbl_mahasiswa WHERE id_mahasiswa='$r_tpeserta[id_mahasiswa]'");
											$r_tmahasiswa = mysqli_fetch_array($q_tmahasiswa);
												
											$q_tprodi = mysqli_query($dbconnect,"SELECT * FROM tbl_prodi WHERE id_prodi='$r_tmahasiswa[id_prodi]'");	
											$r_tprodi = mysqli_fetch_array($q_tprodi);
											
											$no++;
										?>
										<tr>
											<td><?=$no;?></td>
											<td><center><img src="../../setting/save/mahasiswa/<?=cek_foto($r_tmahasiswa['foto_mahasiswa']);?>" class="resident-picture"></center></td>
											<td><?=$r_tmahasiswa['nim']?></td>
											<td><?=ucwords($r_tmahasiswa['nama_mahasiswa'])?></td>
											<td><?=ucwords(jk($r_tmahasiswa['jk_mahasiswa']))?></td>
											<td><?=$r_tpeserta['tahun_kkn']?></td>
											<td><?=$r_tmahasiswa['tahun_angkatan']?></td>
											<td><?=ucwords($r_tprodi['nama_prodi'])?></td>
											<!--<td><?=ucwords($r_tmahasiswa['agama_mahasiswa'])?></td>
											<td><?=ucwords($r_tmahasiswa['tempat_lahir']).", ".tgl_indo($r_tmahasiswa['tgl_lahir']);?></td>-->
											<td><?=ucwords($r_tmahasiswa['no_tlp_mahasiswa'])?></td>
											<td><?=ucwords($r_tmahasiswa['email_mahasiswa'])?></td>
											<!--<td><?=ucwords($r_tmahasiswa['alamat_mahasiswa'])?></td>-->
											<td><?=ucwords(tgl_indo($r_tpeserta['tgl_daftar']))?></td>
											<td><?=cek_status_peserta($r_tpeserta['status_peserta'])?></td>
											<td align="center">												
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Cek Berkas"  href="?page=cekberkas&cek_berkas=<?=$r_tpeserta['id_peserta']?>" type="button" class="label label-default"><i class="fa fa-check-square-o"></i> Cek</a>
																							
											</td>
										</tr>
										<?php 
										}
											if(mysqli_num_rows($q_tpeserta)==0){
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