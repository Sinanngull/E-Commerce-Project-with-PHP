<?



	include("../../php-email-gonder/php-email-gonder/class.phpmailer.php");
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.bilgiegitim.com";
	$mail->SMTPAuth = true;
	$mail->Username = "durmazhasan@bilgiegitim.com";
	$mail->Password = "�ifrenizi yaz�n�z";
	$mail->IsHTML(true); 
	$mail->From = "durmazhasan@bilgiegitim.com";
	$mail->Fromname = "bilgiegitim.com";
	$mail->AddAddress("durmazhasan@bilgiegitim.com","Mail g�nderimi");
	$mail->Subject = "�nternetten Gelen Mesaj";
	$mail->Body = $mesaj;

	if(!$mail->Send())
	{
	   echo '<font color="#F62217"><b>G�nderim Hatas�: ' . $mail->ErrorInfo . '</b></font>';
	   exit;
	}
	echo '<center> <font color="#41A317"><b>Mesaj ba�ar�yla g�nderildi. Geri D�nmek i�in <a href="index.html"> T�klay�n�z </a> </b></font> </center> ';
	


?>