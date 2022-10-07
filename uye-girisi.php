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
	<title> <?php echo $ortak_title; ?> - Anasayfa</title>
	<meta name="description" content="">

<?php include_once("inc/header.php"); ?>

	<div id="page_title">
		<div class="container">
			<div id="page_title_flex">
				<h1>ÜYE GİRİŞİ</h1>
			</div>
		</div>
	</div>	

	<div id="content">
		
		<section id="uye_girisi">
			<div class="container">

				<?php  
				
				if ( isset($_POST["btn_uyegiris"]) ) {
					// Formdan bilgileri Çek ve Oturum aç işlemi başladı
					$uye_eposta 	= $_POST['uye_eposta'];
					$uye_parola 	= $_POST['uye_parola'];

					$uye_bilgileri  = $veritabani -> prepare ("select * from uyeler where uye_eposta=:uye_eposta and uye_parola=:uye_parola");
					$uye_bilgileri -> execute ( array("uye_eposta"=>$uye_eposta, "uye_parola"=>md5($uye_parola) ) );
					$uye_sayisi = $uye_bilgileri -> rowcount();

					if ( $uye_sayisi == 1 ) {
						// Bilgiler doğru girilmiş ise üye sayısı 1 dönecek ve oturum açtırılacak.
						echo "<p> Oturum açıldı <p>";
						// Üyeye ait tüm bilgileri veritabanından al SESSION olarak ata
						$uye_dizisi = $uye_bilgileri -> fetch(PDO::FETCH_ASSOC);
						$uye_id				= $uye_dizisi["uye_id"];
						$uye_ad_soyad		= $uye_dizisi["uye_ad_soyad"];

						$_SESSION['uye_id'] 		= $uye_id;
						$_SESSION['uye_ad_soyad'] 	= $uye_ad_soyad;
						header("refresh:2;url=index.php");

					} else {
						// Bilgiler doğru girilmemiş ise üye sayısı 0 dönecek ve HATA mesajı verilecek
						echo "<p class='kirmizi'>HATA : Tekrar deneyiniz</p>";
					}

					// Formdan bilgileri Çek ve Oturum aç işlemi bitti
				}

				?>

				<form action="" method="post">

					<p>	
						<strong>Üye Eposta :</strong> <br>	
						<input type="text" name="uye_eposta" required placeholder="Üye Eposta">
					</p>	
					<p>	
						<strong>Üye Parola :</strong> <br>	
						<input type="password" name="uye_parola" required placeholder="Üye Parola">
					</p>	
					<p>	
						<input type="submit" value="Üye Giriş" name="btn_uyegiris">
					</p>	
				</form>
			</div>
		</section>

	</div>

<?php include_once("inc/footer.php"); ?>
	
</body>
</html>