<?php

	if(isset($_GET['jadwal'])){
		$r_tkelompok = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelompok WHERE id_kelompok='$_GET[jadwal]'"));
	}

?>
<div class="navbar navbar-default navbar-component navbar-xs">
	<ul class="nav navbar-nav visible-xs-block">
		<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="fa fa-bars"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-filter">
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-table"></i> Tampil Data Jadwal</a></li>
				<li ><a href="#jadwal" data-toggle="modal"><i class="fa fa-plus-square"></i> Tambah Jadwal</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="tab-content" id="myTabContent">
			<div class="tab-pane fade in active" id="tab1">
				<div class="panel panel-white">
					<div class="panel-heading">
					<h6 class="panel-title">Data Jadwal</h6>
					</div>
					<div class="panel-body">
						<div class="table-info">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th width="10">#</th>
										<th>Status Monev</th>
										<th>Hari/Tanggal Monev</th>
										<th>Kelompok</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no=0;
									
									$q_jadwal = mysqli_query($dbconnect,"SELECT * FROM tbl_jadwal_monev WHERE id_kelompok='$r_tkelompok[id_kelompok]'");
									while($r_jadwal = mysqli_fetch_array($q_jadwal)){
									
									$status_monev = $r_jadwal['status_jadwal'];
									
									if($status_monev == "monev1"){
										$tstatus = "Monev 1 Mahasiswa KKN-PPM";
									}elseif($status_monev == "monev2"){
										$tstatus = "Monev 2 Mahasiswa KKN-PPM";
									}elseif($status_monev == "monev3"){
										$tstatus = "Monev 3 (Penarikan) Mahasiswa KKN-PPM";
									}else{
										$tstatus = "";
									}
									
									$no++;										
								?>
									<tr>
										<td><?=$no;?></td>
										<td><?=ucwords($tstatus)?></td>
										<td><?=tgl_indo(ucwords($r_jadwal['tgl_jadwal']))?></td>
										<td>Kelompok <?=$r_tkelompok['nama_kelompok'];?></td>
										<td width="10" align="center">
										
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