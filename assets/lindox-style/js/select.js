	$(document).ready(function() {
		$('#jenis').change(function() { // Jika Select Box id provinsi dipilih
			var jenis = $(this).val(); // Ciptakan variabel provinsi
			$.ajax({
				type: 'POST', // Metode pengiriman data menggunakan POST
				url: '../setting/action/aksi_select.php', // File yang akan memproses data
				data: 'id_jenis=' + jenis, // Data yang akan dikirim ke file pemroses
				success: function(response) { // Jika berhasil
					$('#barang').html(response); // Berikan hasil ke id kota
				}
			});
		});
	});
