<?php  

/*

// 1-) Veritabanı Bağlantısını include et. (baglan.php)
// 2-) fonksiyonlar.php dosyasını include et 
// 3-) Oturum İşlemlerini Kontrol et.
// 4-) Ortak Tanımları İnclude et

*/

include_once("inc/uye-oturum.php");

//------------------------------------------------------------




?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="language" content="tr">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> <?php echo $ortak_title." - ".$iletisim_title; ?> </title>
	<meta name="description" content="<?php echo $iletisim_description; ?>">

<?php include_once("inc/header.php"); ?>

	<div id="page_title">
		<div class="container">
			<div id="page_title_flex">
				<h1>İLETİŞİM</h1>
			</div>
		</div>
	</div>	

	<div id="content">
		
		<section id="iletisim_row1">
			<div class="container">
				<div id="iletisim_row1_flex">
					<div id="iletisim_row1_left">
						<h2>İLETİŞİM BİLGİLERİ</h2>
						<p>
							<strong>ADRES :</strong> <br>
							<?php echo $adres; ?>
						</p>

						<p>
							<strong>TELEFON :</strong> <br>
							<?php echo $telefon; ?>
						</p>

						<p>
							<strong>GSM :</strong> <br>
							<?php echo $gsm; ?>
						</p>

						<p>
							<strong>E-POSTA :</strong> <br>
							<?php echo $eposta; ?> 
						</p>
					</div>
					<div id="iletisim_row1_right">
						<h2>İLETİŞİM FORMU</h2>

						<?php  

						if ( isset($_POST['btn_mesajgonder']) ) {
						// Butona basınca bilgileri çek ve kontrolleri yap başladı
							// Formdan bilgileri $_POST ile çek.
							$ad_soyad 		= $_POST['ad_soyad'];
							$eposta 		= $_POST['eposta'];
							$telefon 		= $_POST['telefon'];
							$konu 			= $_POST['konu'];
							$mesaj 			= $_POST['mesaj'];
							$guvenlik_kodu 	= $_POST['guvenlik_kodu'];
							$uretilen_kod 	= $_POST['uretilen_kod'];

							if ( $guvenlik_kodu != $uretilen_kod ) {
								echo "<p class='kirmizi'> HATA : Güvenlik kodunu tekrar giriniz </p>";
							} else {
								// Mesajı Eposta olarak gönder başladı
								include_once("email-gonder/class.phpmailer.php");
								 
								$mail = new PHPMailer();
								$mail->IsSMTP();
								$mail->IsHTML(true);
								$mail->Host = "mail.phpkursum.com";
								$mail->SMTPAuth = true;
								$mail->Username = "mesaj@phpkursum.com";
								$mail->Password = "Php1234";
								$mail->From = "mesaj@phpkursum.com";
								$mail->Fromname = "phpkursum.com";
								$mail->AddAddress("durmazhasan@hotmail.com","Mail gönderimi");
								$mail->Subject = "Siteden Gelen Mesaj";
								$mail->Body = "
												<p> 
													<strong style='color:red'>Ad Soyad : </strong> <br>
													$ad_soyad 
												</p>

												<p> 
													<strong style='color:red'>Eposta : </strong> <br>
													$eposta 
												</p>

												<p> 
													<strong style='color:red'>Telefon : </strong> <br>
													$telefon 
												</p>

												<p> 
													<strong style='color:red'>Konu : </strong> <br>
													$konu 
												</p>

												<p> 
													<strong style='color:red'>Mesaj : </strong> <br>
													$mesaj 
												</p>										

											  ";
								 
								if(!$mail->Send()) {
								  echo '<font color="#F62217"><b>Gönderim Hatası: ' . $mail->ErrorInfo . '</b></font>';
								  exit;
								}
								echo '<p>Mesaj başarıyla gönderildi</p>';
								// Mesajı Eposta olarak gönder bitti
							}

						// Butona basınca bilgileri çek ve kontrolleri yap bitti	
						}

						?>

						<form action="" method="post">
							<p>
								<input type="text" name="ad_soyad" required placeholder="Ad Soyad" value="<?php echo $ad_soyad; ?>">
							</p>
							<p>
								<input type="email" name="eposta" required placeholder="E-posta" value="<?php echo $eposta; ?>">
							</p>
							<p>
								<input type="text" name="telefon" required placeholder="Telefon" value="<?php echo $telefon; ?>">
							</p>
							<p>
								<input type="text" name="konu" required placeholder="Konu" value="<?php echo $konu; ?>">
							</p>
							<p>
								<textarea name="mesaj" rows="4" required placeholder="Mesajınız..."><?php echo $mesaj; ?></textarea>
							</p>
							<p>	
								<input type="text" name="guvenlik_kodu" required placeholder="Yandaki kodu bu alana giriniz" id="guvenlik_kodu">

								<?php  
								$kod = substr(md5(rand(100,999)),20,3);

								echo "<span class='kirmizi'> $kod </span>";
								?>

								<input type="hidden" name="uretilen_kod" value="<?php echo $kod; ?>">

							</p>
							<p>	
								<input type="submit" value="Mesajı Gönder" name="btn_mesajgonder">
							</p>															
						</form>
					</div>
				</div>
			</div>
		</section>

		<section id="iletisim_row2">
			<?php echo $goole_maps; ?>
		</section>

	</div>

<?php include_once("inc/footer.php"); ?>
	
</body>
</html>