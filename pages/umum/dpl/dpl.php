<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-white">
		<div class="panel-body">
		<div class="table-info">
			<table class="table table-bordered table-hover datatable-show-all">
									<thead>
										<tr>
											<th>#</th>
											<th>Foto DPL</th>
											<th>NIDN</th>
											<th>Nama DPL</th>
											<th>Agama</th>
											<th>Tempat/Tgl Lahir</th>
											<th>No. Tlp/Hp DPL</th>
											<th>No. Email DPL</th>
											<th>Alamat DPL</th>
										</tr>
									</thead>
									
									<tbody>
									<?php
										$no=0;										
										$q_dpl = mysqli_query($dbconnect,"SELECT tbl_dpl.id_dpl, tbl_dpl.id_dosen, tbl_dosen.id_dosen, tbl_dosen.nidn, tbl_dosen.nama_dosen, tbl_dosen.jk_dosen, tbl_dosen.tempat_lahir, tbl_dosen.tgl_lahir, tbl_dosen.agama_dosen, tbl_dosen.no_tlp_dosen, tbl_dosen.email_dosen, tbl_dosen.alamat_dosen, tbl_dosen.foto_dosen FROM tbl_dpl NATURAL JOIN tbl_dosen WHERE tbl_dpl.id_dpl ORDER BY tbl_dosen.nama_dosen ASC");
										while($r_dpl = mysqli_fetch_array($q_dpl)){
										
										$no++;										
									?>
										<tr>
											<td width="10"><?=$no;?></td>
											<td><center><img src="setting/save/dosen/<?=cek_foto($r_dpl['foto_dosen']);?>" class="resident-picture"></center></td>
											<td><?=ucwords($r_dpl['nidn'])?></td>
											<td><?=ucwords(cek_jk($r_dpl['jk_dosen'])." ".$r_dpl['nama_dosen'])?></td>
											<td><?=ucwords($r_dpl['agama_dosen'])?></td>
											<td><?=ucwords($r_dpl['tempat_lahir']).", ".tgl_indo($r_dpl['tgl_lahir']);?></td>
											<td><?=ucwords($r_dpl['no_tlp_dosen'])?></td>
											<td><?=ucwords($r_dpl['email_dosen'])?></td>
											<td><?=ucwords($r_dpl['alamat_dosen'])?></td>
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