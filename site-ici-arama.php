<?php  

/*

// 1-) Veritabanı Bağlantısını include et. (baglan.php)
// 2-) fonksiyonlar.php dosyasını include et 
// 3-) Oturum İşlemlerini Kontrol et.
// 4-) Ortak Tanımları İnclude et

*/

include_once("inc/uye-oturum.php");

//------------------------------------------------------------

// Site İçi Ara butonuna basınca formdan bilgiyi $_POST ile çek
$urun_ara 		= $_POST['urun_ara']; 


?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="language" content="tr">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> <?php echo $ortak_title." - ".$urun_ara; ?> </title>
	<meta name="description" content="<?php echo $urun_ara; ?>">

<?php include_once("inc/header.php"); ?>

	<div id="page_title">
		<div class="container">
			<div id="page_title_flex">
				<h1> ARANAN ÜRÜN : <?php echo sayfa_baslik_h1($urun_ara); ?></h1>
			</div>
		</div>
	</div>	

	<div id="content">
		
		<section id="urun_listele">
			<div class="container">
				<div id="urun_listele_flex">
					
					<?php  
					// Kategorideki Ürünleri Listeme Başladı
					$urunler = $veritabani -> prepare("select urun_id, urun_adi, resim, fiyat from urunler where durum=1 and urun_adi like '%$urun_ara%' ");
					$urunler -> execute (); 
					while ( $urun_dizisi = $urunler ->  fetch(PDO::FETCH_ASSOC) ) {

						$urun_id 		= $urun_dizisi["urun_id"];
						$urun_adi 		= $urun_dizisi["urun_adi"];
						$resim 			= $urun_dizisi["resim"];
						$fiyat 			= $urun_dizisi["fiyat"];

					?>
						
						<div class="urun">
							<a href="urun-detay.php?urun_id=<?php echo $urun_id; ?>">
								<img src="resimler/urun-resimleri/<?php echo $resim; ?>" alt="<?php echo $urun_adi; ?>">
							</a>
							<h2>
								<a href="urun-detay.php?urun_id=<?php echo $urun_id; ?>"> <?php echo $urun_adi; ?> </a>
							</h2>
							<p> <?php echo number_format($fiyat,2,",","."); ?> <span class="tl">TL.</span> </p>
							<div class="urun_sepet_detay">
								<a href="" title="Sepete Ekle">
									<i class="fas fa-cart-shopping"></i>
								</a>
								<a href="urun-detay.php?urun_id=<?php echo $urun_id; ?>" title="Ürün Detay">
									<i class="fas fa-search"></i>
								</a>
							</div>
						</div>

					<?php
					}  
					// Kategorideki Ürünleri Listeme bitti					
					?>


				</div>

					<p style="text-align: center;"> <span class="kirmizi"><?php echo $urun_ara; ?></span> isimini içeren toplam <span class="kirmizi"> <?php echo $urunler -> rowcount(); ?> </span> ürün var. </p>

			</div>
		</section>

	</div>

<?php include_once("inc/footer.php"); ?>
	
</body>
</html>