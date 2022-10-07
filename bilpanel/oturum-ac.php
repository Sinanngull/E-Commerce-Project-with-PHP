<?php  
// Veritabanı bağlantısını include et  
include_once("inc-panel/baglan.php");

?>
<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bilshop - Admin Paneli - Oturum Aç</title>
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	<link rel="icon" href="../favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="font-awesome/css/all.css">

	<style>

		* { box-sizing: border-box; }

		html { height: 100%;  }
		
		body { font-family: tahoma; font-size: 15px; color: #333; background-image: url("../resimler/sablon-resimleri/body-bg.png"); display: flex; justify-content: center; align-items: center; height: 100%; margin: 0;  }

		#oturum_formu { width: 350px; height: 350px;  background-color: #FFF; text-align: center; padding: 20px; border: 1px solid rgb(150,150,150); }

		#oturum_formu h2 { margin: 25px 0; }

		#oturum_formu p {position: relative;}
		#oturum_formu p i {position: absolute; right: 43px;top: 12px; }

		input { width: 80%; padding: 10px; }

		input[type="submit"] { color: #FFF; background-color: #e30000; }

		input[type="submit"]:hover { background-color: #222; }

	</style>

</head>
<body>

	<div id="oturum_formu">
		<img src="../resimler/sablon-resimleri/logo.png" alt="Logo">
		<h2>ADMİN GİRİŞİ</h2>

		<?php  
		if ( isset($_POST['btn_oturum']) ) {
		// Butona basınca bilgileri çek
			$yonetici_email		= $_POST['yonetici_email'];
			$yonetici_parola	= $_POST['yonetici_parola'];

			$kontrol = $veritabani -> prepare ("select * from yoneticiler where yonetici_eposta=:yonetici_eposta and yonetici_sifre=:yonetici_sifre");
			$kontrol -> execute ( array("yonetici_eposta"=>$yonetici_email, "yonetici_sifre"=>md5($yonetici_parola)  ) );

			$uye_sayisi = $kontrol -> rowcount();

			// echo "Üye Sayısı : $uye_sayisi";

			if ( $uye_sayisi == 1 ) {
				echo "<p style='margin-top:80px;'>Oturum açıldı</p>";
				// Üye Adını ve Resimini Veritabanından al
				$dizi = $kontrol -> fetch(PDO::FETCH_ASSOC);
				$yonetici_ad_soyad 			= $dizi["yonetici_ad_soyad"];
				$yonetici_resim				= $dizi["yonetici_resim"];
				$_SESSION['admin']			= $yonetici_ad_soyad;
				$_SESSION["yonetici_resim"] = $yonetici_resim;
				header("refresh:3;url=index.php");
			} else {
				echo "<p style='margin-top:80px;'>HATA : Tekrar deneyiniz</p>";
				header("refresh:3");
			}
			

			


		// ---------------------------------	
		} else {

		?>

			<form action="" method="post">
				<p>
					<input type="email" name="yonetici_email" required="" placeholder="Yönetici Email">
				</p>
				<p>
					<input type="password" name="yonetici_parola" required="" placeholder="Yönetici Parola" id="sifre"> <i class="fas fa-eye" onclick="togglePassword()"></i>
				</p>
				<p>
					<input type="submit" value="Oturum Aç" name="btn_oturum">
				</p>
			</form>
		<?php  
		}
		?>
	</div>

<script src="js-panel/sifre-gizle-goster.js"></script>
	
</body>
</html>