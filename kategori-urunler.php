<?php  

/*

// 1-) Veritabanı Bağlantısını include et. (baglan.php)
// 2-) fonksiyonlar.php dosyasını include et 
// 3-) Oturum İşlemlerini Kontrol et.
// 4-) Ortak Tanımları İnclude et

*/

include_once("inc/uye-oturum.php");

//------------------------------------------------------------

// Kategoriler tablosundan tıklanan kategorinin kategori_id bilgisini öğren. Sonra Ürünler Tablosuna git o kategori_id ye sahip tüm ürünleri listele
// Linkten gelen kategori_url değişkenini $_GET ile çek

$kategori_bilgileri = $veritabani -> prepare("select * from kategoriler where kategori_url=:kategori_url");
$kategori_bilgileri -> execute( array("kategori_url"=>$_GET['kategori_url']) );
$kategori_dizisi = $kategori_bilgileri -> fetch(PDO::FETCH_ASSOC);

$kategori_id 	= $kategori_dizisi["kategori_id"];
$kategori_adi 	= $kategori_dizisi["kategori_adi"];
$description 	= $kategori_dizisi["description"];



?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="language" content="tr">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> <?php echo $ortak_title." - ".$kategori_adi; ?> </title>
	<meta name="description" content="<?php echo $description; ?>">

<?php include_once("inc/header.php"); ?>

	<div id="page_title">
		<div class="container">
			<div id="page_title_flex">
				<h1><?php echo sayfa_baslik_h1($kategori_adi); ?></h1>
			</div>
		</div>
	</div>	

	<div id="content">
		
		<section id="urun_listele">
			<div class="container">
				<div id="urun_listele_flex">
					
					<?php  
					// Kategorideki Ürünleri Listeme Başladı
					$urunler = $veritabani -> prepare("select urun_id, urun_adi, resim, fiyat from urunler where durum=1 and kategori_id=:kategori_id");
					$urunler -> execute ( array("kategori_id"=>$kategori_id) ); 
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

					<p style="text-align: center;"> <span class="kirmizi"><?php echo $kategori_adi; ?></span> kategorisinde toplam <span class="kirmizi"> <?php echo $urunler -> rowcount(); ?> </span> ürün var. </p>

			</div>
		</section>

	</div>

<?php include_once("inc/footer.php"); ?>
	
</body>
</html>