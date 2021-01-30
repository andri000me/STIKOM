<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-white">
		<div class="panel-body">
		<div class="table-info">
			<table class="table table-bordered table-hover datatable-show-all">
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
					</tr>
				</thead>
				<tbody>
					
					<?php 
						$no=0;
						
						$q_tpeserta   = mysqli_query($dbconnect,"SELECT tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa
						, tbl_peserta.tahun_kkn, tbl_peserta.status_peserta, tbl_peserta.tgl_daftar, tbl_mahasiswa.id_mahasiswa, tbl_mahasiswa.id_prodi, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.jk_mahasiswa, tbl_mahasiswa.tempat_lahir, tbl_mahasiswa.tgl_lahir, tbl_mahasiswa.no_tlp_mahasiswa, tbl_mahasiswa.email_mahasiswa, tbl_mahasiswa.tahun_angkatan, tbl_mahasiswa.foto_mahasiswa, tbl_prodi.id_prodi, tbl_prodi.nama_prodi FROM tbl_peserta NATURAL JOIN tbl_mahasiswa NATURAL JOIN tbl_prodi WHERE tbl_peserta.tahun_kkn='$r_atur[tahun_kkn]' AND tbl_peserta.status_peserta='sudah' ORDER BY tbl_mahasiswa.nim ASC");
						while($r_tpeserta = mysqli_fetch_array($q_tpeserta)){						
						
						$no++;
					?>
					<tr>
						<td><?=$no;?></td>
						<td><center><img src="setting/save/mahasiswa/<?=cek_foto($r_tpeserta['foto_mahasiswa']);?>" class="resident-picture"></center></td>
						<td><?=$r_tpeserta['nim']?></td>
						<td><?=ucwords($r_tpeserta['nama_mahasiswa'])?></td>
						<td><?=ucwords(jk($r_tpeserta['jk_mahasiswa']))?></td>
						<td><?=$r_tpeserta['tahun_kkn']?></td>
						<td><?=$r_tpeserta['tahun_angkatan']?></td>
						<td><?=ucwords($r_tpeserta['nama_prodi'])?></td>
						<!--<td><?=ucwords($r_tpeserta['agama_mahasiswa'])?></td>
						<td><?=ucwords($r_tpeserta['tempat_lahir']).", ".tgl_indo($r_tpeserta['tgl_lahir']);?></td>-->
						<td><?=ucwords($r_tpeserta['no_tlp_mahasiswa'])?></td>
						<td><?=ucwords($r_tpeserta['email_mahasiswa'])?></td>
						<!--<td><?=ucwords($r_tpeserta['alamat_mahasiswa'])?></td>-->
						<td><?=ucwords(tgl_indo($r_tpeserta['tgl_daftar']))?></td>
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