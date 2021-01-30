<?php function lib_css($page){ ?>

	<?php if($page == "beranda") { ?>
			<link href="assets/owl-carousel/css/custom.css" rel="stylesheet">
			<link href="assets/owl-carousel/css/owl.carousel.css" rel="stylesheet">
			<link href="assets/owl-carousel/css/owl.theme.css" rel="stylesheet">
			<link href="assets/fontawesome/css/font-awesome-animation.css" rel="stylesheet">
			<link rel="stylesheet" href="assets/lindox-style/css/baguettebox.min.css">
			<style>
			#owl-demo .item img{
				max-height:320px; 
				height:auto; 
				max-width:100%; 
				width:100%; 
				display: block;
				padding:0px;
				border-radius:0px;
			}
			.media-body > span:hover {
				text-decoration:underline;
			}
			.panel-flate{
				border-left:1px solid #ddd;
				height:328px;
				overflow-y:scroll;
			}
			@media (min-width:768px) {
				.panel-flate {
					border-left:0px; 
				}
			}
			.no-gutters {
			  margin-right: 0;
			  margin-left: 0;
			}

			.no-gutters > .col,
			.no-gutters > [class*="col-"] {
			  padding-right: 0;
			  padding-left: 0;
			}
			</style>
	<?php }elseif($page == "nilai-pb" || $page == "nilai-uk" || $page == "nilai-km" || $page == "nilai-pl" || $page == "nilai-lpk" || $page == "nilai-akhir" || $page == "absen-peserta" || $page == "absen-dpl" || $page == "absen-mitra" || $page == "absen"){ ?>
			<style>	
				.line-through {
					 text-decoration: line-through;
				}
				.table-nobor-monev > thead > tr > th,
				.table-nobor-monev > tbody > tr > th,
				.table-nobor-monev > tfoot > tr > th,
				.table-nobor-monev > thead > tr > td,
				.table-nobor-monev > tbody > tr > td,
				.table-nobor-monev > tfoot > tr > td {
				  padding: 4px;
				  vertical-align: middle;
				  border-top: 0px solid #ddd;
				  font-size:12px;
				  border:0px;
				}
				.table-nobor-monev > thead > tr > th,
				.table-nobor-monev > tbody > tr > th,
				.table-nobor-monev > tfoot > tr > th{
					font-weight:550;
				}
				.table-nobor-monev-km > thead > tr > th,
				.table-nobor-monev-km > tbody > tr > th,
				.table-nobor-monev-km > tfoot > tr > th,
				.table-nobor-monev-km > thead > tr > td,
				.table-nobor-monev-km > tbody > tr > td,
				.table-nobor-monev-km > tfoot > tr > td {
				  padding: 0px;
				  vertical-align: middle;
				  border-top: 0px solid #ddd;
				  font-size:11px;
				}
			</style>
	<?php }elseif($page == "pengaturan"){ ?>
		<link href="../../assets/summernote/summernote.css" rel="stylesheet" type="text/css">
	<?php }elseif($page == "profil-mitra"){ ?>
		<style>
			.tooltip {
				white-space: normal;
			}
		</style>
	<?php }elseif($page == "lokasi"){ ?>
		<style>
			#map-canvas {
				width:100%; 
				height:300px; 
				border:solid #ddd 1px;
			}
		</style>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCByPaM4A3Pv79bTxT6u6HCzLk2KuZ19WU&callback=initMap"></script>
		<script type="text/javascript" src="../../assets/lindox-style/js/ajax-daerah.js"></script>
		
	<?php }elseif($page == "galeri"){ ?>
		<style>
			#thumb-output img {
				height:200px ;
				margin-bottom:20px;
			}
			@media (max-width:767px) {
				#thumb-output img {
					width: 100%;
				}
			}
			.galerry2 {
				width: 100%;
				height:200px ;
				margin-bottom:20px;
			}
			button.btn-del-img {
				position:absolute; 
				margin-top:0px; 
				right:10px; 
				border-radius:0px;
			}
		</style>
	<?php }elseif($page == "kelompok"){ ?>
			<script>
			$(document).ready(function() {
				$('#prodi').change(function() { // Jika Select Box id provinsi dipilih
					var prodi = $(this).val(); // Ciptakan variabel provinsi
					$.ajax({
						type: 'POST', // Metode pengiriman data menggunakan POST
						url : '../../setting/action/aksi_select.php', // File yang akan memproses data
						data: 'id_prodi=' + prodi, // Data yang akan dikirim ke file pemroses
						success: function(response) { // Jika berhasil
							$('#peserta').html(response); // Berikan hasil ke id kota
						}
					});
				});
			});
			</script>	
	<?php }elseif($page == "detail-kelompok"){ ?>
			<script>
			$(document).ready(function() {
				$('#aprodi').change(function() { // Jika Select Box id provinsi dipilih
					var aprodi = $(this).val(); // Ciptakan variabel provinsi
					$.ajax({
						type: 'POST', // Metode pengiriman data menggunakan POST
						url : '../../setting/action/aksi_select.php', // File yang akan memproses data
						data: 'aid_prodi=' + aprodi, // Data yang akan dikirim ke file pemroses
						success: function(response) { // Jika berhasil
							$('#apeserta').html(response); // Berikan hasil ke id kota
						}
					});
				});
			});
			</script>
	<?php } ?>
	
<?php }function lib_js($page){ ?>
	<?php if ($page == "daftar") { ?>
		<script type="text/javascript">
			function PreviewPDF() {
				pdffile=document.getElementById("uploadPDF").files[0];
				pdffile_url=URL.createObjectURL(pdffile);
				$('#viewer').attr('src',pdffile_url);
			}
		</script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	<?php }elseif($page == "pengaturan"){ ?>
		<script src="../../assets/summernote/summernote.min.js"></script>
		<script>
			$('#summernote').summernote({
			  height: 230,                 // set editor height
			  minHeight: null,             // set minimum height of editor
			  maxHeight: null,             // set maximum height of editor
			  focus: true                  // set focus to editable area after initializing summernote
			});
		</script>
	<?php }elseif($page == "galeri"){ ?>
		<script>
		$(document).ready(function(){
			$('#file-input').on('change', function(){ //on file input change
				if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
				{
					$('#thumb-output').html(''); //clear html of output element
					var data = $(this)[0].files; //this file data
				   
					$.each(data, function(index, file){ //loop though each file
						if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
							var fRead = new FileReader(); //new filereader
							fRead.onload = (function(file){ //trigger function on successful read
							return function(e) {
								var img = $('<img/>').addClass('col-sm-3').attr('src', e.target.result); //create image element
								$('#thumb-output').append(img); //append image to output element
							};
							})(file);
							fRead.readAsDataURL(file); //URL representing the file's data.
						}
					});
				   
				}else{
					alert("Your browser doesn't support File API!"); //if File API is absent
				}
			});
		});	
		</script>
	<?php }elseif($page == "profil-peserta" || $page == "profil-dpl"){ ?>
		<script src="../../assets/lindox-style/js/signature_pad.umd.js"></script>
		<script>
			$(document).ready(function() {

				var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
			 
				$('#clear').click(function(){
					signaturePad.clear();
				});
				
				$('#click').click(function(){
				var data = signaturePad.toDataURL('image/png');
					$('#output').val(data);
				});

			})
		 </script>
	<?php }elseif($page == "lbmandiri" || $page == "lbkelompok"){ ?>
		
		<script type="text/javascript" src="../../assets/template/js/plugins/notifications/jgrowl.min.js"></script>
		<script type="text/javascript" src="../../assets/template/js/plugins/ui/moment/moment.min.js"></script>
		<script type="text/javascript" src="../../assets/template/js/plugins/pickers/daterangepicker.js"></script>
		<script type="text/javascript" src="../../assets/template/js/plugins/pickers/anytime.min.js"></script>
		<script type="text/javascript" src="../../assets/template/js/plugins/pickers/pickadate/picker.js"></script>
		<script type="text/javascript" src="../../assets/template/js/plugins/pickers/pickadate/picker.date.js"></script>
		<script type="text/javascript" src="../../assets/template/js/plugins/pickers/pickadate/picker.time.js"></script>
		<script type="text/javascript" src="../../assets/template/js/plugins/pickers/pickadate/legacy.js"></script>
		<script type="text/javascript" src="../../assets/template/js/core/app.js"></script>
		<script type="text/javascript" src="../../assets/template/js/pages/picker_date.js"></script>

	<?php }elseif($page == "beranda"){ ?>
		<script src="assets/owl-carousel/js/owl.carousel.min.js"></script>
			<script>
				
				$(document).ready(function() {
				 
				  $("#owl-demo").owlCarousel({
					autoPlay: 6000,
					navigation : false, // Show next and prev buttons
					slideSpeed : 300,
					paginationSpeed : 400,
					pagination:false,
					singleItem:true
				 
					  // "singleItem:true" is a shortcut for:
					  // items : 1, 
					  // itemsDesktop : false,
					  // itemsDesktopSmall : false,
					  // itemsTablet: false,
					  // itemsMobile : false
				 
				  });
				 
				});

			</script>
			<script src="assets/lindox-style/js/baguettebox.min.js"></script>
			<script>
				baguetteBox.run('.tz-gallery');
			</script>
			<script>
				// A $( document ).ready() block.
				$( document ).ready(function() {
				    $('#exampleModalLong').modal({show:true});
				}); 
			</script>
	<?php } ?>
<?php } ?>