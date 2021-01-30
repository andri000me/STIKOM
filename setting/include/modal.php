<!-- MODAL ERROR -->
<div class="modal <?=((!empty($alert))?'show':'hide')?>" id="alert_modal" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content <?=$modal_bg?> martop30ps">
            <div class="modal-body">
				<center>
				<h5><b><?=strtoupper($jenis_pesan);?></b></h5>
				<br><?=$pesan;?><br>
				<br><a href="?page=<?=$back_link;?>" type="button" class="btn <?=$modal_btn;?>">Kembali</a>
				<br>
				</center>
            </div>
        </div>
    </div>
</div>

<!-- MODAL JENIS BARANG-->
<div id="smtp" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="text-bold">Cara Mengaktifkan Less Secure Apps</h4>
					<ol>
						<li class="">Login dulu ke akun <a target="_blank" href="https://accounts.google.com/ServiceLogin/identifier?service=mail&passive=true&rm=false&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1&flowName=GlifWebSignIn&flowEntry=AddSession">Gmail</a> Anda.</li>
						<li class="">
						Untuk mengaktifkan <b>Less Secure Apps</b> akun Anda terlebih dahulu klik pada link <a target="_blank" href="https://myaccount.google.com/u/0/lesssecureapps">berikut</a>.
						<img src="../../assets/img/smtp.gif" style="width:100%;height:200px; border:1px solid #ddd;" /> 
						</li>
					</ol>
					<p>Jika Anda ingin memanfaatkan protokol IMAP dan menyimpan semua email keluar pada folder email terkirim dalam Gmail, silakan ikuti langkah berikut ini.</p>
					<ol>
						<li class="">
						Login ke akun Gmail dan silakan klik pada menu <b>Settings</b>.
						<img src="../../assets/img/langkah1.png" style="width:100%;height:200px; border:1px solid #ddd;" /> 
						</li>
						<li class="">
						Pilih tab <b>Forwarding and POP/IMAP</b> dan klik <b>Enable IMAP</b> seperti yang terlihat pada gambar di bawah ini.
						<img src="../../assets/img/langkah2.png" style="width:100%;height:200px; border:1px solid #ddd;" /> 
						</li>
						<li class="">
						Silakan klik tombol <b>Save Changes</b> pada bagian paling bawah.
						</li>
					</ol>
				</div>
			</div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL JENIS BARANG-->
<div id="caritkkn" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<form action="" class="modal-caritkkn" method="post" enctype="multipart/form-data">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
			<div class="row">
				<div class="col-sm-12 validation">
					<div class="input-group">
						<span class="input-group-addon text-bold" id="basic-addon1">TAHUN KKN</span>
						<input type="number" required class="form-control input-sm pickadate1"  name="thn1" placeholder="<?="*".$thn1?>" /> 
						<span class="input-group-addon" id="basic-addon1">/</span>
						<input type="number" required class="form-control input-sm pickadate2" name="thn2" placeholder="<?="*".$thn2?>" /> 
						<span class="input-group-btn">
							<button class="btn btn-default btn-sm" type="submit" name="caritkkn" value="Cari Data"><i class="fa fa-search" style="margin-top:-1px;"></i> Cari Data</button>
						</span>
					</div>
				</div>
			</div>
      </div>
    </div>
	</form>
  </div>
</div>

<!-- MODAL DELETE-->
<div class="modal fade" id="myModal" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Data akan terhapus !</h4>
            </div>
            <div class="modal-body">
                Anda yakin ingin menghapus data ini ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <a id="mylink" href=""><button type="button" class="btn btn-primary">Ya</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal2" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Data akan terhapus !</h4>
            </div>
            <div class="modal-body">
                Anda yakin ingin menghapus data ini ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <a id="mylink2" href=""><button type="button" class="btn btn-primary">Ya</button></a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="album" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Album</h4>
            </div>
			<form class="modal-album" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
			
				<?php if(!empty($r_xkelompok['id_kelompok']) && empty($r_login['id_admin'])){ ?>
					<input type="hidden" name="id_kelompok" value="<?=$r_xkelompok['id_kelompok'];?>" />
				<?php }elseif(empty($r_xkelompok['id_kelompok']) && !empty($r_login['id_admin'])){ ?>
					<input type="hidden" name="id_admin" value="<?=$r_login['id_admin'];?>" />
				<?php }else{ echo ""; } ?>
				
				<div class="content-divider text-muted form-group"><span>Judul Album</span></div>
				<div class="form-group row validation">
					<div class="col-sm-12">
						<input class="form-control input-sm" required="required" name="judul_album" placeholder="Masukan Judul Album">
					</div>
				</div>
				<div class="content-divider text-muted form-group"><span>Keterangan Album</span></div>
				<div class="form-group row validation">
					<div class="col-sm-12">
						<textarea class="form-control input-sm" required="required" name="ket_album" placeholder="Masukan Keterangan Album"></textarea>
					</div>
				</div>
			</div>
            <div class="modal-footer">
				
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=galeri" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_album">Simpan Data</button>
            
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="ubah_album" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Album</h4>
            </div>
			<form class="album-modal" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">	
                <div class="ubah_album"></div>
			</div>
            <div class="modal-footer">
				
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=mahasiswa" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_album">Simpan Data</button>
            
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="pin" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">PIN KRS</h4>
            </div>
			<form class="modal-pin" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">	
                <div class="pin"></div>
			</div>
            <div class="modal-footer">
				
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=mahasiswa" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="ubah_pin">Simpan Data</button>
            
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="kelompok" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Kelompok</h4>
            </div>
			<form class="modal-kelompok" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">	
				<div class="content-divider text-muted form-group"><span>Kelompok</span></div>
				<div class="form-group row">
					<div class="col-sm-6">
					<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Kelompok</span>
						<input type="text" disabled class="form-control input-sm" value="<?=$kode_otomatis?>" placeholder="Masukan Nama Kelompok">
					</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Tahun KKN</span>
							<input type="text" disabled class="form-control input-sm" value="<?=$r_atur['tahun_kkn']?>">
						</div>
					</div>
				</div>
				<div class="form-group row validation">
					<div class="col-sm-12">
						<select class="form-control input-sm" id="prodi" name="id_prodi" required="required">
							<option value="">Pilih Prodi</option>
							<?php while($r_tprodi = mysqli_fetch_array($q_tprodi)):?>
							<option value="<?=$r_tprodi['id_prodi']?>"><?=ucwords($r_tprodi['nama_prodi']);?></option>
							<?php endwhile; ?>
						</select>
					</div>
				</div>
				<div class="form-group row validation">
					<div class="col-sm-8">
						<select type="text" onchange="changeValue(this.value)" class="form-control input-sm" id="peserta"  required="required" name="idpeserta">
							<option selected value="">Pilih Ketua Kelompok</option>
						</select>
					</div>
					<div class="col-sm-4">
						<input type="text" disabled class="form-control input-sm" placeholder="NIM" id="nim" name="nim">
						<input  type="hidden" id="id_peserta" name="id_peserta">
					</div>
				</div>
				<div class="content-divider text-muted form-group"><span>Dosen Pembimbing Lapangan</span></div>
				<div class="form-group row validation">
					<div class="col-sm-8">
						<select class="form-control input-sm" onchange="changeValue1(this.value)" id="dpl1" name="id_dpl_1" required="required">
							<option value="">Pilih DPL 1</option>
							<?php 
								while($r_tdpl1 = mysqli_fetch_array($q_tdpl1)):
								
								$r_bdosen1 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_tdpl1[id_dosen]'"));
							?>
							<option value="<?=$r_tdpl1['id_dpl']?>"><?=ucwords(cek_jk($r_bdosen1['jk_dosen'])." ".$r_bdosen1['nama_dosen'])?></option>
							<?php
								$jsArray1 .= "dpl1['" . $r_tdpl1['id_dpl'] . "'] = {nidn1:'".addslashes($r_bdosen1['nidn'])."'};\n";
								endwhile; 
							?>
						</select>
					</div>
					<div class="col-sm-4">
						<input type="text" disabled id="nidn1" name="nidn" class="form-control input-sm" placeholder="NIDN">
					</div>
				</div>
				<div class="form-group row validation">
					<div class="col-sm-8">
						<select  class="form-control input-sm" onchange="changeValue2(this.value)" id="dpl2" name="id_dpl_2" required="required">
							<option value="">Pilih DPL 2</option>
							<?php 
								while($r_tdpl2 = mysqli_fetch_array($q_tdpl2)):
								
								$r_bdosen2 = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_dosen WHERE id_dosen='$r_tdpl2[id_dosen]'"));
							?>
							<option value="<?=$r_tdpl2['id_dpl']?>"><?=ucwords(cek_jk($r_bdosen2['jk_dosen'])." ".$r_bdosen2['nama_dosen'])?></option>
							<?php
								$jsArray2 .= "dpl2['" . $r_tdpl2['id_dpl'] . "'] = {nidn2:'".addslashes($r_bdosen2['nidn'])."'};\n";
								endwhile; 
							?>
						</select>
					</div>
					<div class="col-sm-4">
						<input type="text" disabled id="nidn2" name="nidn" class="form-control input-sm" placeholder="NIDN">
					</div>
				</div>
				<div class="content-divider text-muted form-group"><span>Lokasi KKN</span></div>
				<div class="form-group row validation">
					<div class="col-sm-12">
						<select name="id_lokasi" class="form-control input-sm" required="required">
							<option value="">Pilih Lokasi</option>
							<?php 
								$q_tlokasi = mysqli_query($dbconnect,"SELECT * FROM tbl_lokasi WHERE id_lokasi");
								while($r_tlokasi = mysqli_fetch_array($q_tlokasi)):
								
								$r_tkota = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kabupaten WHERE id_kab='$r_tlokasi[id_kota]'"));
								
								$r_tkec  = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kecamatan WHERE id_kec='$r_tlokasi[id_kecamatan]'"));
								
								$r_tkel   = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_kelurahan WHERE id_kel='$r_tlokasi[id_kelurahan]'"));
								
							?>
								<option value="<?=$r_tlokasi['id_lokasi']?>"><?=ucwords($r_tkota['nama'])?> - Kec. <?=ucwords($r_tkec['nama'])?> - Kel. <?=ucwords($r_tkel['nama'])?></option>
							<?php endwhile; ?>
						</select>
					</div>
				</div>
			</div>
            <div class="modal-footer">		
				<input type="hidden" value="<?=$kode_otomatis?>" name="nama_kelompok">
				<input type="hidden" value="<?=$r_atur['tahun_kkn']?>" name="tahun_kkn">
				<input type="hidden" value="<?=$r_atur['tgl_pembekalan']?>" name="tgl_pembekalan">
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=kelompok" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_kelompok">Simpan Data</button>
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="ubah_kelompok" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Kelompok</h4>
            </div>
			<form class="modal-kelompok" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">	
				<div class="ubah_kelompok"></div>
			</div>
            <div class="modal-footer">
				<input type="hidden" value="<?=$r_atur['tgl_pembekalan']?>" name="tgl_pembekalan">
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=kelompok" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_kelompok">Simpan Data</button>
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="anggota" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Anggota</h4>
            </div>
			<form class="modal-anggota" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">	
				<div class="content-divider text-muted form-group"><span>Kelompok</span></div>
				<div class="form-group row">
					<div class="col-sm-6">
					<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Kelompok</span>
						<input type="text" disabled required="required" class="form-control input-sm" value="<?=$r_tkelompok['nama_kelompok']?>" placeholder="Masukan Nama Kelompok">
					</div>
					</div>
					<div class="col-sm-6">
						<div class="input-group">
						<span class="input-group-addon" id="basic-addon1">Tahun KKN</span>
							<input type="text" disabled required="required" class="form-control input-sm" value="<?=$r_tkelompok['tahun_kkn']?>">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-12">				
						<input type="text" disabled required="required" class="form-control input-sm" value="<?=ucwords($r_gprodi['nama_prodi'])?>">
					</div>
				</div>
				<div class="content-divider text-muted form-group"><span>Anggota Kelompok</span></div>
				<div class="form-group row validation">
					<div class="col-sm-12">
						<select name="status_has_peserta" class="form-control input-sm" required="required">
							<option value="">Pilih Status</option>
							<option value="ketua">Ketua</option>
							<option value="anggota">Anggota</option>
						</select>
					</div>	
				</div>
				<div class="form-group row validation">
					<div class="col-sm-7">
						<select type="text" onchange="changeValuex(this.value)" class="form-control input-sm" name="id_peserta" id="xpeserta"  required="required">
							<option value="">Pilih Anggota Kelompok</option>
							<?php 
								$jsArrayx        = "var xpeserta = new Array();\n"; 
								while($r_peserta = mysqli_fetch_array($q_peserta)):
								
								$r_hpeserta = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_has_peserta WHERE id_peserta='$r_peserta[id_peserta]'"));

								if($r_peserta['id_peserta'] == $r_hpeserta['id_peserta']){echo "";}else{
							?>
							<option value="<?=$r_peserta['id_peserta']?>"><?=ucwords($r_peserta['nama_mahasiswa'])?></option>
							<?php
									}
								$jsArrayx .= "xpeserta['" . $r_peserta['id_peserta'] . "'] = {xnim:'".addslashes($r_peserta['nim'])."'};\n";								
								endwhile; 
							?>
						</select>
					</div>
					<div class="col-sm-5">
						<input type="text" disabled class="form-control input-sm" placeholder="NIM" id="xnim" name="nim" />
					</div>				
				</div>
			</div>
            <div class="modal-footer">
				<input type="hidden" name="id_kelompok" value="<?=$r_tkelompok['id_kelompok']?>">
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=kelompok" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_anggota">Simpan Data</button>   
			</div>
			</form>
        </div>
    </div>
</div>


<div class="modal fade" id="tambah_dpl" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah DPL</h4>
            </div>
			<form class="modal-dpl" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">	
				<div class="content-divider text-muted form-group"><span>Dosen</span></div>
				<div class="form-group row validation">
					<div class="col-sm-7">
						<select  class="form-control input-sm" onchange="changeValue(this.value)" id="dosen" name="id_dosen" required="required">
							<option value="">Pilih Dosen</option>
							<?php 
								while($r_tdosen = mysqli_fetch_array($q_tdosen)):
							?>
							<option value="<?=$r_tdosen['id_dosen']?>"><?=ucwords(cek_jk($r_tdosen['jk_dosen'])." ".$r_tdosen['nama_dosen'])?></option>
							<?php
								$jsArray .= "dosen['" . $r_tdosen['id_dosen'] . "'] = {nidn:'".addslashes($r_tdosen['nidn'])."',email_dosen:'".addslashes($r_tdosen['email_dosen'])."',no_tlp_dosen:'".addslashes($r_tdosen['no_tlp_dosen'])."'};\n";
								endwhile; 
							?>
						</select>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control input-sm" id="nidn" name="nidn" placeholder="NIDN" disabled />
					</div>
				</div>
				<div class="content-divider text-muted form-group"><span>No.Tlp/Hp & Email Dosen</span></div>
				<div class="form-group row">
				<div class="col-sm-12">
					<div class="input-group validation">
						<input type="text" class="form-control input-sm" id="no_tlp_dosen" name="no_tlp_dosen" placeholder="No. Tlp/Hp Dosen" required="required" />
						<span class="input-group-addon" id="basic-addon1">-</span>
						<input type="text" class="form-control input-sm capitalize" id="email_dosen" name="email_dosen" placeholder="Email Dosen" required="required" />
					</div>
				</div>
				</div>
			</div>
            <div class="modal-footer">
				
				<input type="hidden" value="<?=$r_atur['tahun_kkn']?>" name="tahun_kkn"/>
				
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=dpl" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_dpl">Simpan Data</button>
            
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="ubah_dpl" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah DPL</h4>
            </div>
			<form class="dpl-modal" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">	
				<div class="ubah_dpl"></div>
			</div>
            <div class="modal-footer">
								
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=dpl" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_dpl">Simpan Data</button>
            
			</div>
			</form>
        </div>
    </div>
</div>


<div class="modal fade" id="login" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
		<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
			<form id="login-form" method="POST" enctype="multipart/form-data"> 
            <div class="modal-body">	
			<div class="text-center">
						<img src="setting/save/logo/logo.png" style="height:100px; width:100px;">
							<h5 class="content-group"><span class="text-thin">Login Pengguna</span> KKN 2020 <small class="display-block text-thin">UNDANA KUPANG</small></h5>
						</div>
						<div class="form-group has-feedback has-feedback-left validation">
							<select type="text" class="form-control" name="level" required="required">
								<option value="">Pilih Status</option>
								<?php
									$q_level = mysqli_query($dbconnect,"SELECT * FROM tbl_level WHERE status='aktif'");
									while($r_level = mysqli_fetch_array($q_level)):
									
									$nlevel = $r_level['level'];
									
									if($nlevel == "peserta"){
										$tlevel = $nlevel." KKN";
									}
									elseif($nlevel == "dpl"){
										$tlevel = "Dosen Pembimbing Lapangan (DPL)";		
									}
									elseif($nlevel == "admin"){
										$tlevel = "Administrator";
									}
									elseif($nlevel == "mitra"){
										$tlevel = "Mitra Lapangan";		
									}
									else{
										$tlevel = $nlevel;
									}
									
								?>
									<option value="<?=$nlevel;?>"><?=ucwords($tlevel);?></option>
								<?php endwhile; ?>	
							</select>
							<div class="form-control-feedback">
								<i class="fa fa-check-square-o text-muted"></i>
							</div>
						</div>
						
						<div class="form-group has-feedback has-feedback-left validation">
							<input type="text" class="form-control" placeholder="Masukan Username" name="username" required="required">
							<div class="form-control-feedback">
								<i class="fa fa-user text-muted"></i>
							</div>
						</div>

						<div class="form-group has-feedback has-feedback-left validation">
							<input type="password" class="form-control form-password" placeholder="Masukan Kata Sandi" name="password" required="required">
							<div class="form-control-feedback">
								<i class="fa fa-lock text-muted"></i>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-sm-12">
									 <div class="checkbox text-muted">
										<input id="checkbox1" class="form-checkbox" type="checkbox">
										<label for="checkbox1">
											Menampilkan Kata Sandi
										</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<button type="submit" name="login" class="btn bg-blue btn-block">Masuk</button>
						</div>

						<div class="content-divider text-muted form-group"><span>Belum terdaftar menjadi peserta KKN ?</span></div>
						<a href="?page=daftar" class="btn btn-default btn-block content-group">Daftar</a>
			</div>
			</form>
        </div>
    </div>
</div>

<!--src="setting/save/persyaratan/default.pdf"-->

<div id="cekfile" class="modal fade" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<embed style="width:100%;height:400px; border:1px solid #eee;" id="viewer"  type="application/pdf"></embed>
			<div class="modal-footer" style="margin-bottom:-10px;">
				<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="tambah_prodi" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Prodi</h4>
            </div>
			<form class="modal-prodi" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
				<div class="content-divider text-muted form-group"><span>Program Studi</span></div>
				<div class="form-group row">
					<div class="col-sm-7 validation">
						<input class="form-control input-sm" name="nama_prodi" placeholder="Masukan Nama Prodi" required="required" />
					</div>
					<div class="col-sm-5 validation">
						<input class="form-control input-sm" name="singkatan_prodi" placeholder="Singkatan Prodi" required="required" />
					</div>
				</div>
			</div>
            <div class="modal-footer">
				
				<input type="hidden" value="<?=$r_atur['id_pengaturan']?>" name="id_pengaturan">
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=pengaturan&atur=<?=$r_atur['id_pengaturan']?>" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_prodi">Simpan Data</button>
            
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="ubah_prodi" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Prodi</h4>
            </div>
			<form class="prodi-modal" method="post" enctype="multipart/form-data"> 
			<input type="hidden" value="<?=$r_atur['id_pengaturan']?>" name="id_pengaturan">
            <div class="modal-body">
				<div class="ubah_prodi"></div>
			</div>
            <div class="modal-footer">
				
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=pengaturan&atur=<?=$r_atur['id_pengaturan']?>" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_prodi">Simpan Data</button>
            
			</div>
			</form>
        </div>
    </div>
</div>

<div id="level" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
	<form  class="modal-level" role="form" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="id_pengaturan" value="<?=$r_atur['id_pengaturan'];?>">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Tambah Level (Hak Akses)</h4>
      </div>
      <div class="modal-body">
		<div class="content-divider text-muted form-group"><span>Level (Hak Akses)</span></div>
		<div class="form-group row validation">
			<div class="col-sm-12">
			<div class="input-group">
			<span class="input-group-addon" id="basic-addon1">Level.</span>
				<input type="text" class="form-control" name="level"  placeholder="Masukan Level" required="required" />
			</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
	  
        <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
		<a href="?page=pengaturan&atur=<?=$r_atur['id_pengaturan'];?>" class="btn btn-danger">Batal</a>
		<button class="btn btn-primary" type="submit" name="simpan_level">Simpan Data</button>
      </div>
	  
    </div>
	</form>
  </div>
</div>

<div class="modal fade" id="ubah_level" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Level (Hak Akses)</h4>
            </div>
			<form class="level-modal" method="post" enctype="multipart/form-data"> 
			<input type="hidden" name="id_pengaturan" value="<?=$r_atur['id_pengaturan'];?>">
            <div class="modal-body">	
                <div class="ubah_level"></div>
			</div>
            <div class="modal-footer">
			
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=pengaturan&atur=<?=$r_atur['id_pengaturan'];?>" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_level">Simpan Data</button>
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="impor" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Impor Data <?=(($page == "mahasiswa")?'Mahasiswa':'Dosen');?></h4>
            </div>
			<form class="import-form" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">	
				<div class="row">
					<div class="col-md-12">
						<div class="form-group row">
							<div class="col-md-12 validation">
							<label class="control-label">Unggah File <b>*xls</b></label>
								<div class="input-group">
								<span class="input-group-btn">
									<span class="btn btn-default btn-sm btn-file">
										<i class="fa fa-folder-open"></i> Ambil<input type="file" name="file_import" id="imgInp" accept=".xls" />
									</span>
								</span>
								<input type="text" name="file_import" required="required" class="form-control input-sm" readonly>
								</div>
								<span class="help-block" style="color:#d94645;">Sebelum mengimpor file, <a href="../../setting/save/format/<?=(($page == "mahasiswa")?'mahasiswa.xls':'dosen.xls');?>">Klik disini</a> untuk mengunduh contoh format data <?=(($page == "mahasiswa")?'mahasiswa':'dosen');?>.</span>
							</div>
						</div>
						<!--
						<div class="form-group row">
							<div class="col-md-12">
								<embed src="../../setting/save/sk/default.pdf" style="width:100%;height:200px; border:1px solid #eee;" id="img-upload"  type="application/pdf"></embed>
							</div>
						</div>
						-->
					</div>
				</div>
			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=mahasiswa" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="<?=(($page == "mahasiswa")?'impor_mahasiswa':'impor_dosen');?>">Impor Data</button>
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="paraf" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Paraf</h4>
            </div>
			<form class="" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
				<div class="form-group row">
					<div class="col-sm-12 validation">
						<div id="signature" style="width:100%; height:300px; border:1px solid #ddd;">
							<center><canvas id="signature-pad" class="signature-pad" width="300" height="300"></canvas></center>
						</div>
					</div>
				</div>
				<div class="form-group row validation">
					<div class="col-sm-11 col-xs-10">
						Periksa kembali paraf Anda, checklist jika sudah benar, jika belum klik tombol ulang untuk memulai paraf baru. <span style="color:#d94645;">Paraf hanya diinput satu kali saja</span>.
					</div>
					<div class="col-sm-1 col-xs-2">
						<input id="click" class="form-checkbox" name="click" type="checkbox" required="required" />
					</div>
				</div>
			</div>
            <div class="modal-footer">
				<input type="hidden" name="<?=(($page == "profil-peserta")?'id_peserta':(($page == "profil-dpl")?'id_dpl':''))?>" value="<?=(($page == "profil-peserta")?$r_cprofil['id_peserta']:(($page == "profil-dpl")?$r_udpl['id_dpl']:''))?>" />
				
				<input type="hidden" name="status" value="<?=(($page == "profil-peserta")?'peserta':(($page == "profil-dpl")?'dpl':''))?>" />
				
				<input type="hidden" id="output" name="<?=(($page == "profil-peserta")?'paraf_peserta':(($page == "profil-dpl")?'paraf_dpl':''))?>" />
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<button type="reset" id="clear" class="btn btn-danger clear">Ulang</button>
				<button class="btn btn-primary" type="submit" name="simpan_paraf">Simpan Data</button>
			</div>
			</form>
        </div>
    </div>
</div>

<div id="jadwal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
	<form  class="jadwal-modal" role="form" method="POST" enctype="multipart/form-data">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Tambah Jadwal</h4>
      </div>
      <div class="modal-body">
		<div class="content-divider text-muted form-group"><span>Status Monev</span></div>
		<div class="form-group row validation">
			<div class="col-md-12">
				<select name="status_jadwal" class="form-control input-sm" required>
					<option value="">Pilih Status</option>
					<option value="monev1">Monev 1 Mahasiswa KKN-PPM</option>
					<option value="monev2">Monev 2 Mahasiswa KKN-PPM</option>
					<option value="monev3">Monev 3 (Penarikan) Mahasiswa KKN-PPM</option>
				</select>
			</div>
		</div>
		<div class="content-divider text-muted form-group"><span>Jadwal</span></div>
		<div class="form-group row validation">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-4 validation">
							<select name="tgl" required class="form-control input-sm">
								<option value="<?=((isset($ubah_mahasiswa))?$tgl:'');?>"><?=((isset($ubah_mahasiswa))?"✔ ".$tgl:'Pilih Tanggal');?></option>
								<?php for ($n=1; $n <= 31 ; $n++) { ?>
									<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-4 validation">
							<select name="bln" required class="form-control input-sm">
								<option value="<?=((isset($ubah_mahasiswa))?$bln:'');?>"><?=((isset($ubah_mahasiswa))?"✔ ".getBulan($bln):'Pilih Bulan');?></option>
								<?php for ($n=1; $n <= 12 ; $n++) { ?>
									<option value="<?php echo $n; ?>" > <?php echo $namaBulan[$n]; ?> </option>
								<?php } // akhir looping?>
							</select>
						</div>
						<div class="col-md-4 validation">
							<select name="thn" required class="form-control input-sm">
								<option value="<?=((isset($ubah_mahasiswa))?$thn:'');?>"><?=((isset($ubah_mahasiswa))?"✔ ".$thn:'Pilih Tahun');?></option>
								<?php  for ($n= $tahun+0; $n <= $tahun+2 ; $n++) { ?>
									<option value="<?php echo $n; ?>" > <?php echo $n; ?> </option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
											
		</div>
      </div>
      <div class="modal-footer">
		<input type="hidden" value="<?=$_GET['kelompok'];?>" name="id_kelompok" />
        <button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
		<a href="?page=pengaturan&atur=<?=$r_atur['id_pengaturan'];?>" class="btn btn-danger">Batal</a>
		<button class="btn btn-primary" type="submit" name="simpan_jadwal">Simpan Data</button>
      </div>
	  
    </div>
	</form>
  </div>
</div>

<div class="modal fade" id="ubah_jadwal" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Jadwal</h4>
            </div>
			<form class="jadwal-modal" method="post" enctype="multipart/form-data"> 
			<input type="hidden" name="id_kelompok" value="<?=$id_kelompok;?>">
            <div class="modal-body">	
                <div class="ubah_jadwal"></div>
			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="?page=detail-kelompok&kelompok=<?=$id_kelompok;?>" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_jadwal">Simpan Data</button>
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="nilaipb" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Nilai Pembekalan</h4>
            </div>
			<form class="modal-nilaipb" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
				<div class="nilaipb"></div>
			</div>
            <div class="modal-footer">
				<input type="hidden" name="id_jadwal" value="<?=$r_tjadwal['id_jadwal']?>" />
				<input type="hidden" name="id_kelompok" value="<?=$r_tkelompok['id_kelompok']?>" />
				<input type="hidden" name="id_dpl" value="<?=$r_hdpl['id_dpl']?>" />
				<input type="hidden" name="status_penilai" value="<?=$status_dpl;?>"/>
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_nilaipb">Simpan Data</button>
            
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="ubahnilaipb" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Nilai Pembekalan</h4>
            </div>
			<form class="modal-unilaipb" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
				<div class="ubahnilaipb"></div>
			</div>
            <div class="modal-footer">
				<input type="hidden" name="id_kelompok" value="<?=$r_tkelompok['id_kelompok']?>" />
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_nilaipb">Simpan Data</button>
            
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="nilaiuklpk" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Nilai <?=(($page == "nilai-uk")?'Usulan Kegiatan':(($page == "nilai-lpk")?'Keberhasilan Laporan Pelaksanaan':''))?></h4>
            </div>
			<form class="modal-nilaiuklpk" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
				<div class="content-divider text-muted form-group"><span>Penilaian</span></div>
				<div class="form-group row">
					<div class="col-sm-4 validation">
						<input type="number" class="form-control input-sm" name="nilai1" placeholder="Nilai I" required="required" />
					</div>
					<div class="col-sm-4 validation">
						<input type="number" class="form-control input-sm" name="nilai2" placeholder="Nilai II" required="required" />
					</div>
					<div class="col-sm-4 validation">
						<input type="number" class="form-control input-sm" name="nilai3" placeholder="Nilai III" required="required" />
					</div>
				</div>
			</div>
            <div class="modal-footer">
				<input type="hidden" name="id_kelompok" value="<?=$r_tkelompok['id_kelompok']?>" />
				<input type="hidden" name="id_dpl" value="<?=$r_hdpl['id_dpl']?>" />
				<input type="hidden" name="status_penilai" value="<?=$status_dpl;?>"/>
				<input type="hidden" name="status_nilai" value="<?=(($page == "nilai-uk")?'nilaiuk':(($page == "nilai-lpk")?'nilailpk':''))?>"/>
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_nilaiuklpk">Simpan Data</button>
            
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="ubahnilaiuklpk" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Nilai <?=(($page == "nilai-uk")?'Usulan Kegiatan':(($page == "nilai-lpk")?'Keberhasilan Laporan Pelaksanaan':''))?></h4>
            </div>
			<form class="modal-unilaiuklpk" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
            <div class="ubahnilaiuklpk"></div>
			</div>
            <div class="modal-footer">
				<input type="hidden" name="id_kelompok" value="<?=$r_tkelompok['id_kelompok']?>" />
				<input type="hidden" name="status_nilai" value="<?=(($page == "nilai-uk")?'nilaiuk':(($page == "nilai-lpk")?'nilailpk':''))?>"/>
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_nilaiuklpk">Simpan Data</button>      
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="nilaikm" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Nilai Kinerja Mahasiswa</h4>
            </div>
			<form class="modal-nilaikm" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
            <div class="nilaikm"></div>
			</div>
            <div class="modal-footer">
				<input type="hidden" name="status_jadwal" value="<?=$status_tjadwal?>" />
				<input type="hidden" name="id_jadwal" value="<?=$r_tjadwal['id_jadwal']?>" />
				<input type="hidden" name="id_kelompok" value="<?=$r_tkelompok['id_kelompok']?>" />
				<input type="hidden" name="<?=((!empty($r_hdpl['id_dpl']))?'id_dpl':'id_mitra')?>" value="<?=((!empty($r_hdpl['id_dpl']))?$r_hdpl['id_dpl']:$r_tmitra['id_mitra'])?>" />
				<input type="hidden" name="status_penilai" value="<?=((!empty($status_dpl))?$status_dpl:'mitra');?>"/>
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_nilaikm">Simpan Data</button>
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="ubahnilaikm" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Nilai Kinerja Mahasiswa</h4>
            </div>
			<form class="modal-unilaikm" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
            <div class="ubahnilaikm"></div>
			</div>
            <div class="modal-footer">
				<input type="hidden" name="status_jadwal" value="<?=$status_tjadwal?>" />
				<input type="hidden" name="id_jadwal" value="<?=$r_tjadwal['id_jadwal']?>" />
				<input type="hidden" name="id_kelompok" value="<?=$r_tkelompok['id_kelompok']?>" />
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_nilaikm">Simpan Data</button>
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="nilaipl" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Nilai Pelaksanaan Program</h4>
            </div>
			<form class="modal-nilaipl" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
            <div class="nilaipl"></div>
			</div>
            <div class="modal-footer">
				<input type="hidden" name="status_jadwal" value="<?=$status_tjadwal?>" />
				<input type="hidden" name="id_jadwal" value="<?=$r_tjadwal['id_jadwal']?>" />
				<input type="hidden" name="id_kelompok" value="<?=$r_tkelompok['id_kelompok']?>" />
				<input type="hidden" name="id_dpl" value="<?=$r_hdpl['id_dpl']?>" />
				<input type="hidden" name="status_penilai" value="<?=$status_dpl;?>"/>
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_nilaipl">Simpan Data</button>
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="ubahnilaipl" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ubah Nilai Pelaksanaan Program</h4>
            </div>
			<form class="modal-unilaipl" method="post" enctype="multipart/form-data"> 
            <div class="modal-body">
            <div class="ubahnilaipl"></div>
			</div>
            <div class="modal-footer">
				<input type="hidden" name="status_jadwal" value="<?=$status_tjadwal?>" />
				<input type="hidden" name="id_kelompok" value="<?=$r_tkelompok['id_kelompok']?>" />
				<input type="hidden" name="id_jadwal" value="<?=$r_tjadwal['id_jadwal']?>" />
				<input type="hidden" name="status_penilai" value="<?=$status_dpl;?>"/>
				<button type="button" class="btn btn-info" data-dismiss="modal">Kembali</button>
				<a href="" class="btn btn-danger">Batal</a>
				<button class="btn btn-primary" type="submit" name="simpan_nilaipl">Simpan Data</button>
			</div>
			</form>
        </div>
    </div>
</div>

<div class="modal fade" id="absenlainnya" tabadmin="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
		<form class="modal-absenlain" method="post" enctype="multipart/form-data"> 
			<div class="modal-content">
				<div class="modal-body">
					<div class="absenlainnya"></div>
						<div class="row">
						<div class="col-sm-4 validation">
							<select class="form-control input-sm" name="status_absen" required="required">
								<option value="">Pilih Keterangan</option>
								<option value="ijin">Ijin</option>
								<option value="sakit">Sakit</option>
							</select>
						</div>
						<div class="col-sm-8 validation">
						<div class="input-group">
							<span class="input-group-btn">
								<span class="btn btn-default btn-sm btn-file">
									<i class="fa fa-folder-open"></i> Ambil<input type="file" name="savesuratpeserta" id="imgInp" accept="pdf/*" />
								</span>
							</span>
							<input type="text" name="surat_peserta" class="form-control input-sm" readonly required="required" />
							<span class="input-group-btn">
								<input type="submit" class="btn btn-default btn-sm" value="Kirim Surat" name="simpan_surat" />
							</span>
						</div>
						<input type="hidden" name="id_jadwal" value="<?=$r_tjadwal['id_jadwal']?>" />
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>
</div>

<div id="ceksurat" class="modal fade" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div style="margin-top:5px;" class="ceksurat"></div>
		</div>
	</div>
</div>


	
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
     <img src="assets/img/icon/syarat.jpeg" alt="" style="width: 100%; height: 250px;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="font-size:14px;"><b>SYARAT & KETENTUAN KKN</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="margin-bottom: -30px;">
      	<span style="margin-bottom: -10px; font-size: 13px;" class="" align="justify"><?=$r_atur["syarat"];?></span>
      </div>

    </div>
  </div>
</div>