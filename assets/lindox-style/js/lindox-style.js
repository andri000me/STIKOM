// MENGUPLOAD GAMBAR SEKALIGUS MENAMPILKAN GAMBAR BESERTA GAMBAR DAN NAMA
$(document).ready( function() {
	$(document).on('change', '.btn-file :file', function() {
	var input = $(this),
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [label]);
	});

	$('.btn-file :file').on('fileselect', function(event, label) {
		
		var input = $(this).parents('.input-group').find(':text'),
			log = label;
		
		if( input.length ) {
			input.val(log);
		} else {
			if( log ) alert(log);
		}
	
	});
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$('#img-upload3').attr('src', e.target.result);
			}
			
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#imgInp3").change(function(){
		readURL(this);
	}); 	
});

$(document).ready( function() {
	$(document).on('change', '.btn-file :file', function() {
	var input = $(this),
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [label]);
	});

	$('.btn-file :file').on('fileselect', function(event, label) {
		
		var input = $(this).parents('.input-group').find(':text'),
			log = label;
		
		if( input.length ) {
			input.val(log);
		} else {
			if( log ) alert(log);
		}
	
	});
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$('#img-upload').attr('src', e.target.result);
			}
			
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#imgInp").change(function(){
		readURL(this);
	}); 	
});

$(document).ready( function() {
	$(document).on('change', '.btn-file :file', function() {
	var input = $(this),
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [label]);
	});

	$('.btn-file :file').on('fileselect', function(event, label) {
		
		var input = $(this).parents('.input-group').find(':text'),
			log = label;
		
		if( input.length ) {
			input.val(log);
		} else {
			if( log ) alert(log);
		}
	
	});
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$('#img-upload1').attr('src', e.target.result);
			}
			
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#imgInp1").change(function(){
		readURL(this);
	}); 	
});	

// COPYRIGHT LINDOX
window.onload = function()
{
   var hasil;
   hasil = '#<b>L</b>INDOX<b>P</b>RODUCTION';
   document.getElementById("footer-navbar").innerHTML=hasil;
}

/* BUTTON DISABLED
$(document).ready(function() {
     $(':input[type="submit"]').prop('disabled', true);
     $('input[type="text"]').keyup(function() {
        if($(this).val() != '') {
           $(':input[type="submit"]').prop('disabled', false);
        }
     });
 });
*/

// MENGHILANGKAN ALERT
window.setTimeout(function() {
	$(".hide-alert").fadeTo(5000, 0).slideUp(500, function(){
		$(this).remove(); 
	});
}, 10000);

// MENAMPILKAN & MENYEMBUNYIKAN PASSWORD LOGIN
$(document).ready(function(){		
	$('.form-checkbox').click(function(){
		if($(this).is(':checked')){
			$('.form-password').attr('type','text');
		}else{
			$('.form-password').attr('type','password');
		}
	});
});

// AUTOCOMPLATE PEMESAN
function cek_regis(){
	var nim = $("#nim").val();
	$.ajax({
		url: 'setting/action/aksi_autocomplate.php',
		data:"nim="+nim ,
	}).success(function (data) {
		var json = data,
		obj = JSON.parse(json);
		$('#id_mahasiswa').val(obj.id_mahasiswa);
		$('#nama_mahasiswa').val(obj.nama_mahasiswa);
		$('#no_tlp_mahasiswa').val(obj.no_tlp_mahasiswa);
		$('#pin_krs').val(obj.pin_krs);
		$('#nama_prodi').val(obj.nama_prodi);
		$('#alamat_mahasiswa').val(obj.alamat_mahasiswa);
		$('#email_mahasiswa').val(obj.email_mahasiswa);
		$('#tahun_angkatan').val(obj.tahun_angkatan);
		
	});
}
// UBAH PIN
$(document).ready(function(){
	$('#pin').on('show.bs.modal', function (e) {
		var idmahasiswa = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idmahasiswa='+ idmahasiswa,
			success : function(data){
			$('.pin').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// UBAH DPL
$(document).ready(function(){
	$('#ubah_dpl').on('show.bs.modal', function (e) {
		var iddpl = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'iddpl='+ iddpl,
			success : function(data){
			$('.ubah_dpl').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// UBAH KELOMPOK
$(document).ready(function(){
	$('#ubah_kelompok').on('show.bs.modal', function (e) {
		var idkelompok = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idkelompok='+ idkelompok,
			success : function(data){
			$('.ubah_kelompok').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// UBAH ALBUM
$(document).ready(function(){
	$('#ubah_album').on('show.bs.modal', function (e) {
		var idalbum = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idalbum='+ idalbum,
			success : function(data){
			$('.ubah_album').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// UBAH ALBUM
$(document).ready(function(){
	$('#ubah_prodi').on('show.bs.modal', function (e) {
		var idprodi = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idprodi='+ idprodi,
			success : function(data){
			$('.ubah_prodi').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// UBAH LEVEL
$(document).ready(function(){
	$('#ubah_level').on('show.bs.modal', function (e) {
		var idlevel = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idlevel='+ idlevel,
			success : function(data){
			$('.ubah_level').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// UBAH JADWAL
$(document).ready(function(){
	$('#ubah_jadwal').on('show.bs.modal', function (e) {
		var idjadwal = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idjadwal='+ idjadwal,
			success : function(data){
			$('.ubah_jadwal').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// TAMBAH NILAI PB
$(document).ready(function(){
	$('#nilaipb').on('show.bs.modal', function (e) {
		var idpesertapb = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idpesertapb='+ idpesertapb,
			success : function(data){
			$('.nilaipb').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// UBAH NILAI PB
$(document).ready(function(){
	$('#ubahnilaipb').on('show.bs.modal', function (e) {
		var idnilaipb = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idnilaipb='+ idnilaipb,
			success : function(data){
			$('.ubahnilaipb').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// UBAH NILAI UK LPK
$(document).ready(function(){
	$('#ubahnilaiuklpk').on('show.bs.modal', function (e) {
		var idnilaiuklpk = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idnilaiuklpk='+ idnilaiuklpk,
			success : function(data){
			$('.ubahnilaiuklpk').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// TAMBAH NILAI KM
$(document).ready(function(){
	$('#nilaikm').on('show.bs.modal', function (e) {
		var idpesertakm = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idpesertakm='+ idpesertakm,
			success : function(data){
			$('.nilaikm').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// UBAH NILAI KM
$(document).ready(function(){
	$('#ubahnilaikm').on('show.bs.modal', function (e) {
		var idnilaikm = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idnilaikm='+ idnilaikm,
			success : function(data){
			$('.ubahnilaikm').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// TAMBAH NILAI PL
$(document).ready(function(){
	$('#nilaipl').on('show.bs.modal', function (e) {
		var idpesertapl = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idpesertapl='+ idpesertapl,
			success : function(data){
			$('.nilaipl').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// UBAH NILAI PL
$(document).ready(function(){
	$('#ubahnilaipl').on('show.bs.modal', function (e) {
		var idnilaipl = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idnilaipl='+ idnilaipl,
			success : function(data){
			$('.ubahnilaipl').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// TAMBAH NILAI KM
$(document).ready(function(){
	$('#absenlainnya').on('show.bs.modal', function (e) {
		var idapeserta = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idapeserta='+ idapeserta,
			success : function(data){
			$('.absenlainnya').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// TAMBAH NILAI KM
$(document).ready(function(){
	$('#ceksurat').on('show.bs.modal', function (e) {
		var idabsen = $(e.relatedTarget).data('id');
		//menggunakan fungsi ajax untuk pengambilan data
		$.ajax({
			type : 'post',
			url : '../../setting/action/aksi_modal.php',
			data :  'idabsen='+ idabsen,
			success : function(data){
			$('.ceksurat').html(data);//menampilkan data ke dalam modal
			}
		});
	 });
});

// HAPUS DATA
function datadel(value,jenis){
	document.getElementById('mylink').href="?del="+value+"&data="+jenis;
}
		
function datadele(value,jenis,id){
   document.getElementById('mylink2').href="?del="+value+"&data="+jenis+"&id="+id;
}

