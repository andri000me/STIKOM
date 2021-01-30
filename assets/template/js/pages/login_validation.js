/* ------------------------------------------------------------------------------
*
*  # Login form with validation
*
*  Specific JS code additions for login_validation.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */
/*
$.validator.addMethod("atLeastOneLowercaseLetter", function (value, element) {
    return this.optional(element) || /[a-z]+/.test(value);
}, "✕ Kata Sandi Harus Memiliki Huruf Kecil");
 

$.validator.addMethod("atLeastOneUppercaseLetter", function (value, element) {
    return this.optional(element) || /[A-Z]+/.test(value);
}, "✕ Kata Sandi Harus Memiliki Huruf Besar");
 

$.validator.addMethod("atLeastOneNumber", function (value, element) {
    return this.optional(element) || /[0-9]+/.test(value);
}, "✕ Kata Sandi Harus Memiliki Angka");
 

$.validator.addMethod("atLeastOneSymbol", function (value, element) {
    return this.optional(element) || /[!@#$%^&*()]+/.test(value);
}, "Must have at least one symbol");
*/

$(function() {
	
	//jquery validation plugin
	$('.register-form').validate({
		rules: {
			password: {
				/*
					atLeastOneLowercaseLetter: true,
					atLeastOneUppercaseLetter: true,
					atLeastOneNumber: false,
					atLeastOneSymbol: false,
				*/
				minlength: 8			
			},
			confirm_password : {
					equalTo : "#password"
			},
			nim: {
				minlength: 8
			}
		},
		messages: {
			no_tlp_mahasiswa: {
				required: false
			},
			pin_krs: {
				required: false
			},
			email_mahasiswa: {
				required: false
			},
			file_pesyaratan:{
				required: false
			},
			password: {
				required: false,
				minlength:false
			},
			confirm_password: {
				required: false,
				equalTo:false
			},
			nim: {
				required: false,
				minlength:false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	//jquery validation plugin
	$('#login-form').validate({
		rules: {
			password: {
				/*
					atLeastOneLowercaseLetter: true,
					atLeastOneUppercaseLetter: true,
					atLeastOneNumber: false,
					atLeastOneSymbol: false,
				*/
				minlength: 5		
			}
		},
		messages: {
			level: {
				required: false
			},
			username: {
				required: false
			},
			password: {
				required: false,
				minlength:false
			}
		},
		highlight: function(element) {
			$(element).parents('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.form-group').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
		//jquery validation plugin
	$('.student-form').validate({
		rules: {
			nim: {
				minlength: 8
			}
		},
		messages: {
			tahun_angkatan: {
				required: false
			},
			id_prodi: {
				required: false
			},
			nama_mahasiswa: {
				required: false
			},
			tempat_lahir: {
				required: false
			},
			tgl: {
				required: false
			},
			bln: {
				required: false
			},
			thn: {
				required: false
			},
			no_tlp_mahasiswa: {
				required: false
			},
			email_mahasiswa: {
				required: false
			},
			agama_mahasiswa: {
				required: false
			},
			alamat_mahasiswa: {
				required: false
			},
			nim: {
				required: false,
				minlength:false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});

		//jquery validation plugin
	$('.sk-form').validate({
		rules: {
			
		},
		messages: {
			file_bk: {
				required: false
			},
			judul_bk: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
			//jquery validation plugin
	$('.dosen-form').validate({
		rules: {
			nidn: {
				minlength: 10
			}
		},
		messages: {
			nama_dosen: {
				required: false
			},
			tempat_lahir: {
				required: false
			},
			tgl: {
				required: false
			},
			bln: {
				required: false
			},
			thn: {
				required: false
			},
			no_tlp_dosen: {
				required: false
			},
			email_dosen: {
				required: false
			},
			agama_dosen: {
				required: false
			},
			alamat_dosen: {
				required: false
			},
			nidn: {
				required: false,
				minlength:false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	//jquery validation plugin
	$('.admin-form').validate({
		rules: {
			password: {
				/*
					atLeastOneLowercaseLetter: true,
					atLeastOneUppercaseLetter: true,
					atLeastOneNumber: false,
					atLeastOneSymbol: false,
				*/
				minlength: 8		
			},
			confirm_password : {
					equalTo : "#password"
			},
			username: {
				minlength: 8
			}
		},
		messages: {
			nama_admin: {
				required: false
			},
			tempat_lahir: {
				required: false
			},
			tgl: {
				required: false
			},
			bln: {
				required: false
			},
			thn: {
				required: false
			},
			no_tlp_admin: {
				required: false
			},
			email_admin: {
				required: false
			},
			agama_admin: {
				required: false
			},
			alamat_admin: {
				required: false
			},
			username: {
				required: false,
				minlength:false
			},
			password: {
				required: false,
				minlength:false
			},
			confirm_password: {
				required: false,
				equalTo:false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.akun-form').validate({
		rules: {
			new_password: {
				/*
					atLeastOneLowercaseLetter: true,
					atLeastOneUppercaseLetter: true,
					atLeastOneNumber: false,
					atLeastOneSymbol: false,
				*/
				minlength: 8			
			},
			new_confirm_password : {
					equalTo : "#new_password"
			}
		},
		messages: {
			new_password: {
				required: false,
				minlength:false
			},
			new_confirm_password: {
				required: false,
				equalTo:false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});

	$('.lokasi-form').validate({
		messages: {
			id_provinsi: {
				required: false
			},
			id_kota: {
				required: false
			},
			id_kecamatan: {
				required: false
			},
			id_kelurahan: {
				required: false
			},
			lat: {
				required: false
			},
			lng: {
				required: false
			},
			nip: {
				required: false
			},
			nama_mitra: {
				required: false
			},
			jk_mitra: {
				required: false
			},
			agama_mitra: {
				required: false
			},
			no_tlp_mitra: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});

	
	$('.modal-kelompok').validate({
		messages: {
			id_dpl_1: {
				required: false
			},
			id_dpl_2: {
				required: false
			},
			id_prodi: {
				required: false
			},
			idpeserta: {
				required: false
			},
			id_lokasi: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-dpl').validate({
		messages: {
			id_dosen: {
				required: false
			},
			no_tlp_dosen: {
				required: false
			},
			email_dosen: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});

	$('.dpl-modal').validate({
		messages: {
			no_tlp_dosen: {
				required: false
			},
			email_dosen: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-anggota').validate({
		messages: {
			status_has_peserta: {
				required: false
			},
			aid_prodi: {
				required: false
			},
			apeserta: {
				required: false
			},
			email_dosen: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-album').validate({
		messages: {
			judul_album: {
				required: false
			},
			ket_album: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.album-modal').validate({
		messages: {
			judul_album: {
				required: false
			},
			ket_album: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-prodi').validate({
		messages: {
			nama_prodi: {
				required: false
			},
			singkatan_prodi: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.prodi-modal').validate({
		messages: {
			nama_prodi: {
				required: false
			},
			singkatan_prodi: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-level').validate({
		messages: {
			level: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.level-modal').validate({
		messages: {
			level: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});

	$('.modal-pin').validate({
		messages: {
			pin_krs: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.import-form').validate({
		messages: {
			file_import: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-paraf').validate({
		messages: {
			click: {
				required: false
			}
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.jadwal-modal').validate({
		messages: {
			status_jadwal: {
				required: false
			},
			tgl: {
				required: false
			},
			bln: {
				required: false
			},
			thn: {
				required: false
			}	
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});

	$('.photo-form').validate({
		messages: {
			foto_mitra: {
				required: false
			}	
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.lbmandiri-form').validate({
		messages: {
			status_waktu1: {
				required: false
			},
			status_waktu2: {
				required: false
			},
			status_waktu3: {
				required: false
			},
			status_waktu4: {
				required: false
			},
			mulai1: {
				required: false
			},
			mulai2: {
				required: false
			},
			mulai3: {
				required: false
			},
			mulai4: {
				required: false
			},
			akhir1: {
				required: false
			},
			akhir2: {
				required: false
			},
			akhir3: {
				required: false
			},
			akhir4: {
				required: false
			},
			kegiatan1: {
				required: false
			},
			kegiatan2: {
				required: false
			},
			kegiatan3: {
				required: false
			},
			kegiatan4: {
				required: false
			},
			catatan: {
				required: false
			}
		/** tgl: {
				required: false
			},
			bln: {
				required: false
			},
			thn: {
				required: false
			} **/
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-nilaipb').validate({
		rules: {
			nilai_pb: {
				min: 1,
				minlength: 2
			}
		},
		messages: {
			nilai_pb: {
				required: false,
				minlength: false,
				min: false
			}	
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-unilaipb').validate({
		rules: {
			nilai_pb: {
				minlength: 2,
				min: 1
			}
		},
		messages: {
			nilai_pb: {
				required: false,
				minlength: false,
				min: false
			}	
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-nilaiuklpk').validate({
		rules: {
			nilai1: {
				minlength: 2,
				min: 1
			},
			nilai2: {
				minlength: 2,
				min: 1
			},
			nilai3: {
				minlength: 2,
				min: 1
			}
		},
		messages: {
			nilai1: {
				required: false,
				minlength: false,
				min: false
			},
			nilai2: {
				required: false,
				minlength: false,
				min: false
			},
			nilai3: {
				required: false,
				minlength: false,
				min: false
			}			
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-unilaiuklpk').validate({
		rules: {
			nilai1: {
				minlength: 2,
				min: 1
			},
			nilai2: {
				minlength: 2,
				min: 1
			},
			nilai3: {
				minlength: 2,
				min: 1
			}
		},
		messages: {
			nilai1: {
				required: false,
				minlength: false,
				min: false
			},
			nilai2: {
				required: false,
				minlength: false,
				min: false
			},
			nilai3: {
				required: false,
				minlength: false,
				min: false
			}			
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-nilaikm').validate({
		rules: {
			nilai_ds: {
				minlength: 2,
				min: 1
			},
			nilai_ks: {
				minlength: 2,
				min: 1
			}
		},
		messages: {
			nilai_ds: {
				required: false,
				minlength: false,
				min: false
			},
			nilai_ks: {
				required: false,
				minlength: false,
				min: false
			}		
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-unilaikm').validate({
		rules: {
			nilai_ds: {
				minlength: 2,
				min: 1
			},
			nilai_ks: {
				minlength: 2,
				min: 1
			}
		},
		messages: {
			nilai_ds: {
				required: false,
				minlength: false,
				min: false
			},
			nilai_ks: {
				required: false,
				minlength: false,
				min: false
			}		
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});	
	
	$('.modal-nilaipl').validate({
		rules: {
			nilai_pl: {
				minlength: 2,
				min: 1
			}
		},
		messages: {
			nilai_pl: {
				required: false,
				minlength: false,
				min: false
			}	
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-unilaipl').validate({
		rules: {
			nilai_pl: {
				minlength: 2,
				min: 1
			}
		},
		messages: {
			nilai_pl: {
				required: false,
				minlength: false,
				min: false
			}	
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-caritkkn').validate({
		rules: {
			thn1: {
				minlength: 4
			},
			thn2: {
				minlength: 4
			}
		},
		messages: {
			thn1: {
				required: false,
				minlength: false
			},
			thn2: {
				required: false,
				minlength: false
			}			
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});
	
	$('.modal-absenlain').validate({
		messages: {
			surat_peserta: {
				required: false
			},
			status_absen: {
				required: false
			}			
		},
		highlight: function(element) {
			$(element).parents('.validation').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).parents('.validation').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'validation-error-message help-block form-helper bold',
		errorPlacement: function(error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			}else{
				error.insertAfter(element);
			}
		}
	});

});

