<div class="row">
	<form class="register-form" method="POST" enctype="multipart/form-data">
		<div class="col-sm-4">
		<div class="panel panel-flat">
			<a href="#">
					<img src="assets/img/icon/pendaftaran.jpg" style="height:auto; max-height:300px; display:block; max-width:100%; width:100%;">
				</a>
			<div class="border-left-warning border-left-lg">
				<div class="panel-heading">
					<h6 class="panel-title"><span class="text-semibold">Petunjuk </span> Pendaftaran</h6>
				</div>
				
				<div class="panel-body">
					<div class="row" style="text-align:justify;">
					<ol>
						<li class="media">Harap Anda telah menyelesaikan semua administrasi, melengkapi persyaratan dan menyiapkan berkas persyaratan yang akan diupload sebelum mendaftar.</li>
						<li class="media">Jika Anda telah memasukan NIM tapi PIN KRS Anda tidak tampil berarti Anda belum menyelesaikan administrasi sebaliknya jika Anda sudah menyelesaikan administrasi dan PIN KRS Anda tetap tidak tampil segeralah menghubungi Panitia KKN. </li>
						<li class="media">Semua Berkas Persyaratan digabung dalam 1 file PDF kemudian diupload (Maksimal 3MB).</li>
						<li class="media">Data kontak Anda seperti No. Tlp/Hp atau Email yang di masukan haruslah data yang benar karena kami akan mengirim informasi seputar kelengkapan persyaratan yang anda masukan atau username dan password untuk mengakses akun Anda ke kontak tersebut.</li>
					</ol>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="col-sm-8">
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h6 class="panel-title">Form Pendaftaran Peserta <b>KKN</b></h6>
				</div>
				<div class="panel-body">
				<div class="row">
				<div class="col-sm-12">
					<div class="form-group row">
						<div class="col-sm-3 validation">
						<label class="control-label">NIM</label>
							<input type="tel" class="form-control" onfocus="cek_regis()" onkeyup="cek_regis()" id="nim" placeholder="Masukan NIM" name="nim" required="required" />
						</div>
						<div class="col-sm-3 validation">
						<label class="control-label">PIN KRS</label>
							<input type="text" class="form-control" id="pin_krs" name="pin_krs" placeholder="Masukan PIN KRS" required="required" readonly />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-6">
						<label class="control-label">Nama Lengkap Mahasiswa</label>
							<input type="text" class="form-control" placeholder="Nama Mahasiswa" id="nama_mahasiswa" required="required" disabled />
						</div>
						<div class="col-sm-3">
						<label class="control-label">Program Studi</label>
							<input type="text" class="form-control" placeholder="Nama Program Studi" id="nama_prodi" required="required" disabled />
						</div>
						<div class="col-sm-3">
						<label class="control-label">Tahun Angkatan</label>
							<input type="tel" class="form-control" placeholder="Tahun Angkatan" id="tahun_angkatan" required="required" disabled />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-12">
						<label class="control-label">Alamat</label>
							<textarea type="text" class="form-control" placeholder="Alamat Mahasiswa" id="alamat_mahasiswa" required="required" disabled></textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-6 validation">
						<label class="control-label">No. Tlp/Hp</label>
							<input type="tel" class="form-control" placeholder="Masukan No. Tlp/Hp" id="no_tlp_mahasiswa" name="no_tlp_mahasiswa" required="required" />
						</div>
						<div class="col-sm-6 validation">
						<label class="control-label">Email</label>
							<input type="email" class="form-control" placeholder="Masukan Email" id="email_mahasiswa" name="email_mahasiswa" required="required" />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-6 validation">
						<label class="control-label">Kata Sandi</label>
							<input type="password" class="form-control" placeholder="Masukan Kata Sandi" id="password" name="password" required="required" />
						</div>
						<div class="col-sm-6 validation">
						<label class="control-label">Ulang Kata Sandi</label>
							<input type="password" class="form-control" placeholder="Masukan Ulang Kata Sandi" name="confirm_password" required="required" />
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6 validation">
						<label class="control-label">Unggah Persyaratan KKN</label>
							<div class="input-group">
								<span class="input-group-btn">
									<span class="btn btn-default btn-sm btn-file">
										<i class="fa fa-folder-open"></i> Ambil File<input type="file" name="savefilepersyaratan" id="uploadPDF" accept=".pdf" />
									</span>
								</span>
								<input type="text" name="file_pesyaratan" class="form-control input-sm" required="required" readonly><a href="#cekfile" data-toggle="modal" type="button" class="input-group-addon" onclick="PreviewPDF();" id="basic-addon2" >CEK FILE</a>
							</div>
						</div>
					</div>
				</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" id="id_mahasiswa" name="id_mahasiswa"/>
						<input type="hidden" value="<?=$r_atur['tahun_kkn']?>" name="tahun_kkn"/>
						<button type="submit" name="simpan_daftar" class="btn bg-teal btn-block btn-lg"><b>DAFTAR</b></button>
					</div>
				</div>
				</div>
			</div>
		</div>


	</form>	
</div>