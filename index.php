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
	<meta name="description" content="<?php echo $anasayfa_description; ?>">

<?php include_once("inc/header.php"); ?>

	<div id="slider">
		<div class="container">
			<img src="resimler/sablon-resimleri/e-ticaret-resim.jpg" alt="">
		</div>
	</div>

	<div id="content">
		
		<section id="">
			<div class="container">
				Bölüm 1
			</div>
		</section>

	</div>

<?php include_once("inc/footer.php"); ?>
	
</body>
</html>