<div class="navbar navbar-default navbar-component navbar-xs">
	<ul class="nav navbar-nav visible-xs-block">
		<li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="fa fa-bars"></i></a></li>
	</ul>

	<div class="navbar-collapse collapse" id="navbar-filter">
		<div class="navbar-right">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="false"><i class="fa fa-table"></i> Tampil Data DPL</a></li>
				<li ><a href="#tambah_dpl" data-toggle="modal"><i class="fa fa-plus-square"></i> Tambah DPL</a></li>
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
							<h6 class="panel-title">Data DPL</h6>
							</div>
							<div class="panel-body">
							<div class="table-info">
								<table class="table table-striped table-bordered table-hover datatable-show-all">
									<thead>
										<tr>
											<th>#</th>
											<th>Foto DPL</th>
											<th>NIDN</th>
											<th>Nama DPL</th>
											<th>No. Tlp/Hp DPL</th>
											<th>No. Email DPL</th>
											<th align="center">Aksi</th>
										</tr>
									</thead>
									
									<tbody>
									<?php
										$no=0;
										$q_dpl = mysqli_query($dbconnect,"SELECT * FROM tbl_dpl WHERE id_dpl");
										while($r_dpl = mysqli_fetch_array($q_dpl)){
										
										$r_dosen	  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_dpl[id_dosen]'"));
										
										$no++;										
									?>
										<tr>
											<td width="10"><?=$no;?></td>
											<td><center><img src="../../setting/save/dosen/<?=cek_foto($r_dosen['foto_dosen']);?>" class="resident-picture"></center></td>
											<td><?=ucwords($r_dosen['nidn'])?></td>
											<td><?=ucwords(cek_jk($r_dosen['jk_dosen'])." ".$r_dosen['nama_dosen'])?></td>
											<td><?=ucwords($r_dosen['no_tlp_dosen'])?></td>
											<td><?=ucwords($r_dosen['email_dosen'])?></td>
											<td width="15" class="center">
												<a data-placement="left"  data-popup="tooltip" title="" data-original-title="Ubah" href='#ubah_dpl' id='custId' data-toggle='modal' data-id="<?php echo $r_dpl['id_dpl']; ?>" type="button" class="label label-primary"><i class="fa fa-edit"></i></a>
												
												<button data-placement="left"  data-popup="tooltip" title="" data-original-title="Hapus" onclick='datadel(<?php echo $r_dpl['id_dpl']; ?>,&#39;dpl&#39;)'  data-title='Delete' data-toggle='modal' data-target='#myModal' type="button" class="label label-danger"><i class="fa fa-trash"></i></button>
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