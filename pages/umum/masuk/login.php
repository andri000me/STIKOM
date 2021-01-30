<!-- Form with validation -->
				<form class="form-validate" method="post" >
					<div class="panel panel-body login-form">
						<div class="text-center">
							<img src="setting/save/logo/logo.png" style="height:100px; width:100px;">
							<h5 class="content-group"><span class="text-thin">Login</span> Peserta KKN <small class="display-block text-thin">UNDANA KUPANG</small></h5>
						</div>
						<div class="form-group has-feedback has-feedback-left">
							<select type="text" class="form-control" name="id_level" required="required">
								<option value="">Pilih Status</option>
								<option value="administrator">Administrator</option>
								<option value="dpl">DPL (Dosen Pembimbing Lapangan)</option>
								<option value="mitra">Mitra</option>
								<option value="mahasiswa">Mahasiswa</option>
							</select>
							<div class="form-control-feedback">
								<i class="fa fa-check-square-o text-muted"></i>
							</div>
						</div>
						
						<div class="form-group has-feedback has-feedback-left">
							<input type="text" class="form-control" placeholder="Masukan Username" name="id_anggota" required="required">
							<!--<input type="text" class="form-control" placeholder="Masukan ID Anggota" onfocus="cek_login()" onkeyup="cek_login()" id="id_anggota" name="id_anggota" required="required">-->
							<div class="form-control-feedback">
								<i class="fa fa-user text-muted"></i>
							</div>
						</div>

						<div class="form-group has-feedback has-feedback-left">
							<input type="password" class="form-control form-password" placeholder="Masukan Kata Sandi" name="password" id="password" required="required">
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
				<!-- /form with validation -->
