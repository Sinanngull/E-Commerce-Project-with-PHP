<?



	include("../../php-email-gonder/php-email-gonder/class.phpmailer.php");
	
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->Host = "mail.bilgiegitim.com";
	$mail->SMTPAuth = true;
	$mail->Username = "durmazhasan@bilgiegitim.com";
	$mail->Password = "þifrenizi yazýnýz";
	$mail->IsHTML(true); 
	$mail->From = "durmazhasan@bilgiegitim.com";
	$mail->Fromname = "bilgiegitim.com";
	$mail->AddAddress("durmazhasan@bilgiegitim.com","Mail gönderimi");
	$mail->Subject = "Ýnternetten Gelen Mesaj";
	$mail->Body = $mesaj;

	if(!$mail->Send())
	{
	   echo '<font color="#F62217"><b>Gönderim Hatasý: ' . $mail->ErrorInfo . '</b></font>';
	   exit;
	}
	echo '<center> <font color="#41A317"><b>Mesaj baþarýyla gönderildi. Geri Dönmek için <a href="index.html"> Týklayýnýz </a> </b></font> </center> ';
	


?>