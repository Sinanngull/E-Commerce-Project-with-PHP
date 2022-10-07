<?php  

/*

// 1-) Veritabanı Bağlantısını include et. (baglan.php)
// 2-) fonksiyonlar.php dosyasını include et 
// 3-) Oturum İşlemlerini Kontrol et.
// 4-) Ortak Tanımları İnclude et

*/

include_once("inc/uye-oturum.php");

//------------------------------------------------------------

// Link ile gönderilen urun_id değişkenini $_GET ile çek. O Ürüne ait bilgileri veritababnından al.

$urun_bilgileri = $veritabani -> prepare ("select * from urunler where urun_id=:urun_id");
$urun_bilgileri -> execute ( array("urun_id"=>$_GET['urun_id']) );
$urun_dizisi = $urun_bilgileri -> fetch(PDO::FETCH_ASSOC);

$urun_adi 		= $urun_dizisi["urun_adi"];
$description 	= $urun_dizisi["description"];
$resim 			= $urun_dizisi["resim"];
$urun_aciklama 	= $urun_dizisi["urun_aciklama"];
$fiyat 			= $urun_dizisi["fiyat"];
$kdv_oran 		= $urun_dizisi["kdv_oran"];
$stok_miktari	= $urun_dizisi["stok_miktari"];

?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="language" content="tr">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> <?php echo $ortak_title." - ".$urun_adi; ?> </title>
	<meta name="description" content="<?php echo $description; ?>">

<?php include_once("inc/header.php"); ?>

	<div id="page_title">
		<div class="container">
			<div id="page_title_flex">
				<h1> <?php echo $urun_adi; ?> </h1>
			</div>
		</div>
	</div>	

	<div id="content">
		
		<section id="urun_detay_row1">
			<div class="container">
				<div id="urun_detay_row1_flex">
					<div id="urun_detay_row1_left">
						<img src="resimler/urun-resimleri/<?php echo $resim; ?>" alt="<?php echo $urun_adi; ?>">
					</div>
					<div id="urun_detay_row1_right">
						<p>
							<strong>Ürün Adı :</strong> <br>
							<?php echo $urun_adi; ?>
						</p>
						<p>
							<strong>Stok Miktarı :</strong> <br>
							<?php echo number_format($stok_miktari,0,",","."); ?>
						</p>
						<p>
							<strong>Fiyat :</strong> <br>
							<?php echo number_format($fiyat,2,",","."); ?> TL.
						</p>
						<p>
							<strong>KDV Oranı :</strong> <br>
							<?php echo $kdv_oran; ?>
						</p>

						<p>
							<a href="">
								Sepete Ekle
							</a>							
						</p>						
					</div>
				</div>
			</div>
		</section>

		<section id="urun_detay_row2">
			<div class="container">
				<?php echo $urun_aciklama; ?>
			</div>
		</section>		

	</div>

<?php include_once("inc/footer.php"); ?>
	
</body>
</html>