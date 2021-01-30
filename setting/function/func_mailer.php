<?php
function send_mail($to, $body, $subject)
{	
	
	$r_atur = mysqli_fetch_array(mysqli_query($dbconnect,"SELECT * FROM tbl_pengaturan WHERE id_pengaturan='1'"));
	
	require_once "../../assets/PHPMailer/PHPMailerAutoload.php";
	$mail = new PHPMailer;
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = $r_atur['email_smtp'];                 // SMTP username
	$mail->Password = $r_atur['password_smtp'];                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to
	
	$mail->FromName = ucwords($r_atur['form_replay_name']);
	$mail->addAddress($to);               // Name is optional
	$mail->addReplyTo(ucwords($r_atur['form_replay_name']), 'Reply');
	
	$mail->Subject = $subject;
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Body    = $body;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	
	if(!$mail->send()) {
		header('location:?page=peserta&success_edit_data');
		exit();
	} else {
		header('location:?page=peserta&error_edit_data');
		exit();
	}

}
?>