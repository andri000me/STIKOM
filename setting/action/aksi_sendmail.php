<?php
/***********************************************************************
	UBAH STATUS PESERTA
***********************************************************************/
if(isset($_POST['ubah_status_peserta'])){
	
	$r_atur = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_pengaturan WHERE id_pengaturan='1'"));
	
	$email_smtp      = strtolower($r_atur['email_smtp']);
	$password_smtp   = $r_atur['password_smtp'];
	$FromName		 = ucwords($r_atur['form_replay_name']);
	
	$status_berkas   = $_POST['status_peserta'];
	$id_peserta      = $_POST['id_peserta'];	
	$r_apeserta      = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT tbl_peserta.id_peserta, tbl_peserta.id_mahasiswa, tbl_peserta.confirm_password, tbl_peserta.tahun_kkn, tbl_mahasiswa.id_mahasiswa, tbl_mahasiswa.nim, tbl_mahasiswa.nama_mahasiswa, tbl_mahasiswa.email_mahasiswa FROM tbl_peserta NATURAL JOIN tbl_mahasiswa WHERE tbl_peserta.id_peserta='$id_peserta'")) or die (mysqli_error($dbconnect));
	
	$nama_mahasiswa  = ucwords($r_apeserta['nama_mahasiswa']);
	$nim             = $r_apeserta['nim'];
	$tahun_kkn       = $r_apeserta['tahun_kkn'];
	$password        = $r_apeserta['confirm_password'];
	$to              = strtolower($r_apeserta['email_mahasiswa']);
	
	if($status_berkas == "belum"){
		$subject = "Hi ".$nama_mahasiswa.", Berkas Belum Lengkap";
		$body	 = "Berkas yang Anda kirim ke kami belum lengkap, silahkan melengkapi berkas Anda dan mendaftarkan diri kembali agar Anda terdaftar sebagai Peserta KKN-PPM ".$tahun_kkn."<br><br><br>Terima Kasih, Administrator.";
	}
	elseif($status_berkas == "sudah"){
		$subject = "Hi ".$nama_mahasiswa.", Anda Terdaftar Menjadi Peserta KKN-PPM ".$tahun_kkn;
		$body	 = "Selamat ".$nama_mahasiswa.", Anda telah terdaftar sebagai Peserta KKN-PPM ".$tahun_kkn.". Berikut username dan password Anda.<p>Username : ".$nim."</p>Password : ".$password."<br><br><br> Terima Kasih, Administrator.";
	}
	
	require_once "../../assets/PHPMailer/PHPMailerAutoload.php";
	$mail = new PHPMailer;
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = $email_smtp;                 // SMTP username
	$mail->Password = $password_smtp;                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to
	
	$mail->FromName = $FromName;
	$mail->addAddress($to);               // Name is optional
	$mail->addReplyTo($FromName, 'Reply');
	
	$mail->Subject = $subject;
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Body    = $body;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		header('location:?page=peserta&error_edit_data');
		exit();
	}
	else{
		$up_status  = mysqli_query($dbconnect,"UPDATE `tbl_peserta` SET `status_peserta`='$status_berkas' WHERE `id_peserta`='$id_peserta'") or die (mysqli_error());
		if($up_status){
			header('location:?page=peserta&success_edit_data');
			exit();	
		}else{
			header('location:?page=peserta&error_edit_data');
			exit();
		}
	}
}
?>